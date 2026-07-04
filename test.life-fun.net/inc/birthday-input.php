<?php
/**
 * Birthday Input — 生年月日入力（年/月/日プルダウン）共通コンポーネント
 *
 * 呼び出し例：
 *   <?php render_birthdate_input([
 *     'prefix'       => 'birth',        // 必須。id接頭辞（birth-year / birth-month / birth-day）
 *     'hiddenName'    => 'birthday',    // 必須。送信用hidden inputのname属性（既存のPHP側 $_GET/$_POST 名に合わせる）
 *     'startYear'    => 1920,           // 任意（デフォルト1920）
 *     'endYear'      => date('Y'),      // 任意（デフォルト今年）
 *     'defaultYear'  => 1990,           // 任意（デフォルト1990、空欄にしたい場合はnull）
 *     'defaultMonth' => null,           // 任意（デフォルトnull＝未選択）
 *     'defaultDay'   => null,           // 任意（デフォルトnull＝未選択）
 *     'required'     => true,           // 任意（見た目の必須マーク表示のみ。バリデーション自体は呼び出し側JSで行う）
 *   ]); ?>
 *
 * 出力するHTML：
 *   <span class="date-input-group">
 *     <select id="{prefix}-year">（name属性なし、表示専用）</select>
 *     <select id="{prefix}-month">（同上）</select>
 *     <select id="{prefix}-day">（同上）</select>
 *     <input type="hidden" id="{prefix}-hidden" name="{hiddenName}">
 *   </span>
 *
 * hidden inputには常に「YYYY-MM-DD」形式（旧<input type="date">と同一フォーマット）が同期される。
 * 呼び出し側JSは、従来 `.value.split('-')` していた対象を
 * `document.getElementById('{prefix}-hidden').value.split('-')` に変えるだけで移行できる。
 *
 * 複数フォーム（相性診断の本人＋相手など）は prefix を変えて複数回呼び出すことで衝突を回避する。
 */

function render_birthdate_input(array $opts = []): void {
    $prefix       = $opts['prefix']       ?? 'birth';
    $hiddenName   = $opts['hiddenName']   ?? ($prefix . 'date');
    $startYear    = $opts['startYear']    ?? 1920;
    $endYear      = $opts['endYear']      ?? (int)date('Y');
    $defaultYear  = array_key_exists('defaultYear', $opts) ? $opts['defaultYear'] : 1990;
    $defaultMonth = $opts['defaultMonth'] ?? null;
    $defaultDay   = $opts['defaultDay']   ?? null;
    $required     = $opts['required']     ?? true;

    $p = htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8');
    $hn = htmlspecialchars($hiddenName, ENT_QUOTES, 'UTF-8');
    ?>
    <span class="date-input-group"
      data-start-year="<?= (int)$startYear ?>"
      data-end-year="<?= (int)$endYear ?>"
      data-default-year="<?= $defaultYear === null ? '' : (int)$defaultYear ?>"
      data-default-month="<?= $defaultMonth === null ? '' : (int)$defaultMonth ?>"
      data-default-day="<?= $defaultDay === null ? '' : (int)$defaultDay ?>"
    >
      <select id="<?= $p ?>-year" class="form-input date-input-year" aria-label="年"<?= $required ? ' data-required="1"' : '' ?>></select>
      <select id="<?= $p ?>-month" class="form-input date-input-month" aria-label="月"<?= $required ? ' data-required="1"' : '' ?>></select>
      <select id="<?= $p ?>-day" class="form-input date-input-day" aria-label="日"<?= $required ? ' data-required="1"' : '' ?>></select>
      <input type="hidden" id="<?= $p ?>-hidden" name="<?= $hn ?>">
    </span>
    <?php
    // 同一ページに複数回呼び出されてもJS初期化は1回だけ行う
    static $scriptEmitted = false;
    if (!$scriptEmitted) {
        $scriptEmitted = true;
        ?>
        <style>
        .date-input-group{display:flex;gap:.6rem;width:100%}
        .date-input-group select{
          padding:.85rem 1.6rem .85rem .6rem;
          min-height:50px;
          text-align:center;
          background-image:linear-gradient(45deg,transparent 50%,currentColor 50%),linear-gradient(135deg,currentColor 50%,transparent 50%);
          background-position:calc(100% - 16px) center,calc(100% - 11px) center;
          background-size:5px 5px,5px 5px;
          background-repeat:no-repeat;
          color:inherit;
          opacity:.85;
          transition:opacity .2s,border-color .35s,box-shadow .35s;
        }
        .date-input-group select:hover{opacity:.95}
        .date-input-group select:focus{
          opacity:1;
          border-color:var(--violet);
          box-shadow:0 0 0 3px rgba(155,114,239,.12),0 0 16px rgba(201,168,76,.18);
        }
        .date-input-group .date-input-year{flex:1.45}
        .date-input-group .date-input-month,.date-input-group .date-input-day{flex:1}
        </style>
        <script>
        window.BirthdayInput = window.BirthdayInput || (function(){
          function pad(n){ return String(n).padStart(2,'0'); }

          function daysInMonth(year, month){
            if(!year || !month) return 31;
            return new Date(year, month, 0).getDate();
          }

          function syncHidden(prefix){
            const y = document.getElementById(prefix + '-year').value;
            const m = document.getElementById(prefix + '-month').value;
            const d = document.getElementById(prefix + '-day').value;
            const hidden = document.getElementById(prefix + '-hidden');
            if(y && m && d){
              hidden.value = y + '-' + pad(m) + '-' + pad(d);
            } else {
              hidden.value = '';
            }
          }

          function refreshDayOptions(prefix, keepValue){
            const yearEl  = document.getElementById(prefix + '-year');
            const monthEl = document.getElementById(prefix + '-month');
            const dayEl   = document.getElementById(prefix + '-day');
            const year  = parseInt(yearEl.value, 10) || null;
            const month = parseInt(monthEl.value, 10) || null;
            const maxDay = daysInMonth(year, month);
            const current = keepValue ? parseInt(dayEl.value, 10) : null;

            dayEl.innerHTML = '<option value="">日</option>';
            for(let d = 1; d <= maxDay; d++){
              const o = document.createElement('option');
              o.value = d;
              o.textContent = d + '日';
              dayEl.appendChild(o);
            }
            if(current && current <= maxDay){
              dayEl.value = current;
            }
          }

          function init(prefix, opts){
            opts = opts || {};
            const group = document.getElementById(prefix + '-year').closest('.date-input-group');
            const startYear    = opts.startYear    ?? parseInt(group.dataset.startYear, 10);
            const endYear      = opts.endYear      ?? parseInt(group.dataset.endYear, 10);
            const defaultYear  = opts.defaultYear  ?? (group.dataset.defaultYear  ? parseInt(group.dataset.defaultYear, 10)  : null);
            const defaultMonth = opts.defaultMonth ?? (group.dataset.defaultMonth ? parseInt(group.dataset.defaultMonth, 10) : null);
            const defaultDay   = opts.defaultDay   ?? (group.dataset.defaultDay   ? parseInt(group.dataset.defaultDay, 10)   : null);

            const yearEl  = document.getElementById(prefix + '-year');
            const monthEl = document.getElementById(prefix + '-month');

            var _started = false;
            function _markFortuneStart(){
              if(_started) return;
              _started = true;
              if(typeof trackEvent === 'function') trackEvent('fortune_start', {});
            }

            yearEl.innerHTML = '<option value="">年</option>';
            for(let y = endYear; y >= startYear; y--){
              const o = document.createElement('option');
              o.value = y;
              o.textContent = y + '年';
              yearEl.appendChild(o);
            }
            if(defaultYear) yearEl.value = defaultYear;

            monthEl.innerHTML = '<option value="">月</option>';
            for(let m = 1; m <= 12; m++){
              const o = document.createElement('option');
              o.value = m;
              o.textContent = m + '月';
              monthEl.appendChild(o);
            }
            if(defaultMonth) monthEl.value = defaultMonth;

            refreshDayOptions(prefix, false);
            if(defaultDay){
              const dayEl = document.getElementById(prefix + '-day');
              dayEl.value = defaultDay;
            }
            syncHidden(prefix);

            yearEl.addEventListener('change', function(){ _markFortuneStart(); refreshDayOptions(prefix, true); syncHidden(prefix); });
            monthEl.addEventListener('change', function(){ _markFortuneStart(); refreshDayOptions(prefix, true); syncHidden(prefix); });
            document.getElementById(prefix + '-day').addEventListener('change', function(){ _markFortuneStart(); syncHidden(prefix); });
          }

          function getValue(prefix){
            return document.getElementById(prefix + '-hidden').value;
          }

          return { init: init, getValue: getValue };
        })();

        document.addEventListener('DOMContentLoaded', function(){
          document.querySelectorAll('.date-input-group').forEach(function(group){
            const yearSelect = group.querySelector('.date-input-year');
            if(!yearSelect) return;
            const prefix = yearSelect.id.replace(/-year$/, '');
            window.BirthdayInput.init(prefix);
          });
        });
        </script>
        <?php
    }
}
