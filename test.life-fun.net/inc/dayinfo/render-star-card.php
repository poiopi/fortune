<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 「今日の星回り」グループ（calendar-day.php）用の共通カードレンダラー。
//
// 月齢・星座・年九星・月九星のカードがほぼ同一構造のマークアップとして
// 個別にコピペされていたのを、この1関数に集約する。将来、誕生花・誕生石・
// 誕生星等をこのグループへ追加する際も、この関数をそのまま再利用する想定。
//
// HTMLは一切自前で持たず、既存の.star-card系CSS（calendar-day.php内）を
// そのまま使う。DayInfoService本体・各Providerのロジックには関与しない。
// ══════════════════════════════════════════════════════════════════

function renderStarCard(array $card): string {
    $label     = $card['label'] ?? '';
    $available = (bool)($card['available'] ?? false);
    $url       = $card['url'] ?? null;

    $tag      = !empty($url) ? 'a' : 'div';
    $hrefAttr = !empty($url) ? ' href="'.htmlspecialchars($url).'"' : '';

    $html = "<{$tag} class=\"star-card\"{$hrefAttr}>\n";

    if ($available) {
        $html .= '  <div class="star-card-symbol">'.htmlspecialchars((string)($card['symbol'] ?? '')).'</div>'."\n";
        $html .= '  <div class="star-card-label">'.htmlspecialchars($label).'</div>'."\n";
        $html .= '  <div class="star-card-name">'.htmlspecialchars((string)($card['name'] ?? '')).'</div>'."\n";

        if (!empty($card['meta'])) {
            $html .= '  <div class="star-card-meta">'.htmlspecialchars($card['meta']).'</div>'."\n";
        }
        if (!empty($card['desc'])) {
            $html .= '  <div class="star-card-desc">'.htmlspecialchars($card['desc']).'</div>'."\n";
        }
        if (!empty($url)) {
            $html .= '  <span class="star-card-arrow">&#8594;</span>'."\n";
        }
    } else {
        $html .= '  <div class="star-card-label">'.htmlspecialchars($label).'</div>'."\n";
        $html .= '  <div class="unavailable">情報がありません</div>'."\n";
    }

    $html .= "</{$tag}>\n";

    return $html;
}
