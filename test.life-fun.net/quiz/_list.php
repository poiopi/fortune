<?php
declare(strict_types=1);
// みつぼしの4択：クイズの一覧と区分名を返す共通部品（一覧ページ・解説ページの「同じ区分の4択」で使う）
// - quiz/<slug>/data.php をフォルダから読み、'listed' => true のものだけを返す（作りかけのフォルダが一覧に出ないように）
// - 「_」で始まるフォルダ（テンプレート・見本）は読まない
// - 新しいクイズを出すときは、data.php に 'listed' => true を書けば一覧に載る（slug の手書きの並びは不要）

if (!function_exists('quiz_theme_labels')) {
    /** 区分（data.php の themes）の表示名と説明。並び順＝一覧での表示順 */
    function quiz_theme_labels(): array
    {
        // 結婚・学業・仕事などの区分は、該当する問題が増えたら足す（DAILY_QUIZ_OPERATIONS.md 18-1）
        return [
            'kinun'   => ['label' => '金運・開運日',     'desc' => '財布を新しくする日、何かを始める日など、暦の上の吉日にまつわる4択です。'],
            'renai'   => ['label' => '恋愛・人づきあい', 'desc' => '初対面、気になる人、仲間との場面。人とのつきあい方にまつわる4択です。'],
            'jibun'   => ['label' => '自分を知る',       'desc' => '正解のない「あなたはどれ？」で、自分の選び方をふり返る4択です。'],
            'kisetsu' => ['label' => '季節・行事',       'desc' => '年末年始や季節の行事にまつわる4択です。'],
            'mame'    => ['label' => '占いの豆知識',     'desc' => 'タロット・五行・九星・星座など、占いの基本を当てる4択です。'],
        ];
    }

    /** 一覧に載せるクイズ（新しい順） */
    function quiz_all_listed(): array
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }
        $list = [];
        foreach (glob(__DIR__ . '/*/data.php') ?: [] as $file) {
            if (str_starts_with(basename(dirname($file)), '_')) {
                continue;
            }
            $q = require $file;
            if (is_array($q) && ($q['listed'] ?? false) === true) {
                $list[] = $q;
            }
        }
        usort($list, fn($a, $b) => $b['number'] <=> $a['number']);
        return $cache = $list;
    }

    /**
     * 同じ主な区分の別の問題を最大 $max 件。
     * 一覧の並び（新しい順）で、今の問題の次から順に取り、最後まで行ったら先頭に戻る
     * （どの問題から来ても同じ3問にならないように）
     */
    function quiz_related(array $quiz, int $max = 3): array
    {
        $main = $quiz['themes'][0] ?? null;
        if ($main === null) {
            return [];
        }
        $same = array_values(array_filter(quiz_all_listed(), fn($q) => in_array($main, $q['themes'] ?? [], true)));
        $pos  = 0;
        foreach ($same as $i => $q) {
            if ($q['slug'] === $quiz['slug']) {
                $pos = $i + 1;
                break;
            }
        }
        $out = [];
        $n   = count($same);
        for ($k = 0; $k < $n && count($out) < $max; $k++) {
            $q = $same[($pos + $k) % $n];
            if ($q['slug'] !== $quiz['slug']) {
                $out[] = $q;
            }
        }
        return $out;
    }
}
