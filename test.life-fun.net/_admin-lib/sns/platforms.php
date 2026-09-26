<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/platforms.php
 *
 * SNSの一覧と、SNS部品の共通の入口。
 * SNSを追加するときは ADMIN_SNS_PLATFORMS に1行足し、自動投稿できるなら
 * sns/<platform>.php に admin_sns_<platform>_publish() を作る（アカウント作成後、Phase 3 以降）。
 * 自動投稿の部品が無い・未連携のSNSは「手動投稿」として扱う（キューで「手動投稿待ち」になる）。
 */

const ADMIN_SNS_PLATFORMS = [
    // Threads：本文上限500文字（Meta公式ドキュメントとされる値。数え方の詳細は連携時に公式で再確認：ADMIN_IMPL_PLAN.md 9-6）
    'threads' => [
        'label'       => 'Threads',
        'max_chars'   => 500,
        'needs_title' => false,
        'rotation'    => true,
        'open_url'    => 'https://www.threads.com/',
    ],
    // note：公式の投稿APIが無いため常に手動投稿（ADMIN_PLAN.md 2章）。ストックにnote用本文があるときだけ投稿枠に加える
    'note' => [
        'label'       => 'note',
        'max_chars'   => null,
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

/**
 * 自動投稿できる状態か（部品がある かつ 連携済み）。MVPでは部品が無いので常に false。
 */
function admin_sns_is_connected(string $platform): bool
{
    if (!function_exists('admin_sns_' . $platform . '_publish')) {
        return false;
    }
    $stmt = admin_db()->prepare("SELECT status FROM sns_accounts WHERE platform = ?");
    $stmt->execute([$platform]);
    return $stmt->fetchColumn() === 'connected';
}
