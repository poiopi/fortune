// プレイログJSONに埋め込むバージョン情報。EVENTS.md/TraitCalculatorのロジックを変更したら
// ここも更新する。DECISIONS.mdのD番号を参照することで「このデータはどのロジックで生成されたか」を追跡できる。

export const SCHEMA_VERSION = '1.3'; // D-0073：fortuneResultにscore（総合運%）を追加
export const EVENTS_VERSION = 'D-0017'; // GameEngineのObservation記録ロジックの最終更新
export const TRAITS_VERSION = 'D-0017'; // TraitCalculatorの最終更新
export const DIAGNOSIS_VERSION = 'D-0045'; // diagnosisBands.js/diagnosisTemplates.js/diagnosis.jsの最終更新（3ファイルを1論理単位として扱う）。
// 較正データの出自（diagnosis.bandEdgesSourceLabel、D-0044）とは意図的に分離する（D-0046）。
// D-0064以降、これらのファイルはUIの主経路からは外れている（ファイル自体は削除せず残置、別途クリーンアップ判断）。
export const HIGHLIGHT_VERSION = 'D-0065'; // highlightAlgorithms.js（ZScore採用・DEFAULT_REFERENCE_STD）/highlightText.jsの最終更新
