<?php
declare(strict_types=1);

/**
 * inc/resultdata-validator.php
 *
 * ResultData（meta/raw/traits/highlights/extras）の「形」だけを検証する共通バリデータ。
 * shichu-engine.php・tarot-engine.php・seiza-engine.php すべてで共通利用する。
 *
 * 占術の意味（偏官とは何か、カードの意味は何か等）は一切知らない。
 * キーの存在・型だけを確認する（docs/sansei-engine-design.md §4 の責務定義に対応）。
 *
 * @throws InvalidArgumentException 形式が不正な場合
 */
function validateResultData(array $result): void {
    foreach (['meta', 'raw', 'traits', 'highlights', 'extras'] as $key) {
        if (!array_key_exists($key, $result)) {
            throw new InvalidArgumentException("ResultData is missing required key: '{$key}'");
        }
    }

    if (!is_array($result['meta']) || !isset($result['meta']['title'], $result['meta']['subtitle'])) {
        throw new InvalidArgumentException("ResultData.meta must be an array with 'title' and 'subtitle'");
    }
    if (!is_string($result['meta']['title']) || !is_string($result['meta']['subtitle'])) {
        throw new InvalidArgumentException("ResultData.meta.title / subtitle must be strings");
    }

    if (!is_array($result['raw'])) {
        throw new InvalidArgumentException("ResultData.raw must be an array");
    }

    if (!is_array($result['traits'])) {
        throw new InvalidArgumentException("ResultData.traits must be an array");
    }
    foreach ($result['traits'] as $traitName => $trait) {
        if (!is_array($trait) || !isset($trait['score'], $trait['type'])
            || !is_int($trait['score']) || !is_string($trait['type'])) {
            throw new InvalidArgumentException("ResultData.traits['{$traitName}'] must be array{score:int, type:string}");
        }
    }

    if (!is_array($result['highlights'])) {
        throw new InvalidArgumentException("ResultData.highlights must be an array");
    }
    foreach ($result['highlights'] as $h) {
        if (!is_string($h)) {
            throw new InvalidArgumentException("ResultData.highlights must contain only strings");
        }
    }

    if (!is_array($result['extras'])) {
        throw new InvalidArgumentException("ResultData.extras must be an array");
    }
}
