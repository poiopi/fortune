<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/platforms.php
 *
 * SNSの一覧と、SNS部品の共通の入口。
 * SNSを追加するときは ADMIN_SNS_PLATFORMS に1行足し、自動投稿できるなら
 * sns/<platform>.php に admin_sns_<platform>_publish(array $queueRow, DateTimeImmutable $now): string を作る。
 *   - 投稿時刻が来た行（scheduled）と、送信中で次の処理時刻が来た行（sending）に対して、毎分1段階ずつ進める（1回のcronで待たない）
 *   - 戻り値は処理後の状態（'sending' / 'posted' / 'failed' / 'skipped' など。scheduler は記録に使うだけ）
 * 自動投稿の部品が無いSNS（note）は「手動投稿」として扱う（キューで「手動投稿待ち」になる）。
 * 部品があるのに未連携・連携エラーのSNSは、その枠をスキップする（ADMIN_IMPL_PLAN.md 14-6 Q4）。
 */

const ADMIN_SNS_PLATFORMS = [
    // Threads：本文上限500文字・本文中のURL（重複は1つ）5個まで（Meta公式。数え方は admin_sns_text_length() の説明を参照）
    'threads' => [
        'label'       => 'Threads',
        'max_chars'   => 500,
        'max_links'   => 5,
        'needs_title' => false,
        'rotation'    => true,
        'open_url'    => 'https://www.threads.com/',
    ],
    // note：公式の投稿APIが無いため常に手動投稿（ADMIN_PLAN.md 2章）。ストックにnote用本文があるときだけ投稿枠に加える
    'note' => [
        'label'       => 'note',
        'max_chars'   => null,
        'max_links'   => null,
        'needs_title' => true,
        'rotation'    => false,
        'open_url'    => 'https://note.com/',
    ],
];

function admin_sns_label(string $platform): string
{
    return ADMIN_SNS_PLATFORMS[$platform]['label'] ?? $platform;
}

/** ローテーションの投稿先として選べるSNS（note は本文があるときに自動で加わるので含めない） */
function admin_sns_rotation_platforms(): array
{
    return array_keys(array_filter(ADMIN_SNS_PLATFORMS, static fn (array $p): bool => $p['rotation']));
}

/** 自動投稿の部品（sns/<platform>.php の admin_sns_<platform>_publish）があるか */
function admin_sns_has_publisher(string $platform): bool
{
    return function_exists('admin_sns_' . $platform . '_publish');
}

/**
 * 自動投稿できる状態か（部品がある かつ 連携済み）。
 * Threads は sns/threads.php が部品。連携状態は sns_accounts.status（connected / error / disconnected）で、
 * 「SNS連携」画面での連携（OAuth）で connected、認証エラー・トークン失効で error、解除で disconnected になる。
 */
function admin_sns_is_connected(string $platform): bool
{
    if (!admin_sns_has_publisher($platform)) {
        return false;
    }
    $stmt = admin_db()->prepare("SELECT status FROM sns_accounts WHERE platform = ?");
    $stmt->execute([$platform]);
    return $stmt->fetchColumn() === 'connected';
}

/**
 * 絵文字を見分ける正規表現。
 * 根拠：Unicode の Extended_Pictographic 属性（UTS #51・UAX #29 で絵文字の書記素クラスタの判定に使う属性）。
 * PCRE2 10.40 以上なら \p{Extended_Pictographic} が使える。古いPCREでは使えないため、主な絵文字の範囲で代用する
 * （代用の範囲は Extended_Pictographic の主要部分。完全には一致しない）。
 * 国旗（Regional Indicator 2文字）とキーキャップ（数字＋U+20E3）は Extended_Pictographic に含まれないので別に足す。
 */
function admin_sns_emoji_pattern(): string
{
    static $pattern = null;
    if ($pattern === null) {
        $extra = '\x{1F1E6}-\x{1F1FF}\x{20E3}';
        $pattern = @preg_match('/\p{Extended_Pictographic}/u', '') !== false
            ? '/[\p{Extended_Pictographic}' . $extra . ']/u'
            : '/[\x{00A9}\x{00AE}\x{203C}\x{2049}\x{2122}\x{2139}\x{2194}-\x{2199}\x{21A9}\x{21AA}\x{231A}\x{231B}\x{2328}\x{23CF}\x{23E9}-\x{23F3}\x{23F8}-\x{23FA}'
              . '\x{24C2}\x{25AA}\x{25AB}\x{25B6}\x{25C0}\x{25FB}-\x{25FE}\x{2600}-\x{27BF}\x{2934}\x{2935}\x{2B05}-\x{2B07}\x{2B1B}\x{2B1C}\x{2B50}\x{2B55}'
              . '\x{3030}\x{303D}\x{3297}\x{3299}\x{1F000}-\x{1FAFF}' . $extra . ']/u';
    }
    return $pattern;
}

/**
 * SNSの数え方での本文の長さ。
 * Threads：【Meta公式】「絵文字は UTF-8 のバイト数で数える」。それ以外（日本語を含む）の数え方は公式に記載が無いため1文字＝1（不明・ADMIN_IMPL_PLAN.md 14-1）。
 *   絵文字は書記素クラスタ（\X：肌の色・ZWJ でつないだ家族・国旗などを1つの絵文字として扱う単位）ごとに見て、
 *   絵文字を含むクラスタはそのクラスタ全体の UTF-8 バイト数、含まないクラスタは文字数（コードポイント数＝mb_strlen と同じ）で数える。
 *   つないだ絵文字をクラスタ全体のバイト数で数えるかは公式に記載なし（【AIの推論】多めに数える側に倒している）。
 * それ以外のSNS：mb_strlen。
 */
function admin_sns_text_length(string $platform, string $text): int
{
    if ($platform !== 'threads') {
        return mb_strlen($text);
    }
    if (preg_match_all('/\X/u', $text, $m) === false) {
        return mb_strlen($text);
    }
    $length = 0;
    foreach ($m[0] as $cluster) {
        $length += preg_match(admin_sns_emoji_pattern(), $cluster) === 1 ? strlen($cluster) : mb_strlen($cluster);
    }
    return $length;
}

/** 本文中のURL（http/https）。重複は1つにまとめる。末尾の句読点・閉じかっこはURLに含めない */
function admin_sns_text_links(string $text): array
{
    preg_match_all('~https?://[^\s<>"\'）」』】〕、。]+~iu', $text, $m);
    $links = [];
    foreach ($m[0] as $url) {
        $url = rtrim($url, '.,;:!?)]}\'"');
        if ($url !== '') {
            $links[$url] = true;
        }
    }
    return array_keys($links);
}

/**
 * 本文がSNSの上限に収まるか。問題が無ければ空配列。ストックの検証（取り込み・手書き・編集）と、自動投稿の直前の確認で同じものを使う。
 * $text は {link} を置換した後の、実際に投稿する本文。
 */
function admin_sns_text_errors(string $platform, string $text): array
{
    $def = ADMIN_SNS_PLATFORMS[$platform] ?? null;
    if ($def === null) {
        return ['未対応のSNSです：' . $platform];
    }
    $errors = [];
    if ($def['max_chars'] !== null) {
        $length = admin_sns_text_length($platform, $text);
        if ($length > $def['max_chars']) {
            $errors[] = $def['label'] . '：本文がリンク込みで' . $length . '文字です（上限' . $def['max_chars'] . '文字'
                . ($platform === 'threads' ? '。絵文字はUTF-8のバイト数で数えます' : '') . '）';
        }
    }
    if (($def['max_links'] ?? null) !== null) {
        $links = count(admin_sns_text_links($text));
        if ($links > $def['max_links']) {
            $errors[] = $def['label'] . '：本文のURLが' . $links . '個です（同じURLは1つと数えて' . $def['max_links'] . '個まで）';
        }
    }
    return $errors;
}
