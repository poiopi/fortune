<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 日別詳細ページへのURL生成を一本化する関数。
// DayInfoService本体はURLの形式を知らない。将来公開URL形式を変える場合は
// この1関数だけを直せばよい。
// ══════════════════════════════════════════════════════════════════

function dayUrl(DateTimeImmutable $date): string {
    return '/calendar-day?date=' . $date->format('Y-m-d');
}

function calendarUrl(int $year, int $month): string {
    return "/calendar?y={$year}&m={$month}";
}
