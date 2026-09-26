// life-fun 管理画面の補助スクリプト（CSP によりインラインスクリプトは使えないため外部ファイル）
// - [data-copy-target]：指定したテキストエリアの内容をクリップボードへコピー
// - [data-confirm]：送信前に確認ダイアログ
// - textarea[data-count]：文字数の表示（上限を超えたら強調）
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('[data-copy-target]').forEach(function (button) {
    button.addEventListener('click', function () {
      var source = document.getElementById(button.getAttribute('data-copy-target'));
      if (!source) { return; }
      var original = button.textContent;
      var done = function () {
        button.textContent = 'コピーしました';
        setTimeout(function () { button.textContent = original; }, 2000);
      };
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(source.value).then(done, function () { source.select(); document.execCommand('copy'); done(); });
      } else {
        source.select();
        document.execCommand('copy');
        done();
      }
    });
  });

  document.querySelectorAll('[data-confirm]').forEach(function (el) {
    el.addEventListener('click', function (event) {
      if (!window.confirm(el.getAttribute('data-confirm'))) { event.preventDefault(); }
    });
  });

  document.querySelectorAll('textarea[data-count]').forEach(function (area) {
    var max = parseInt(area.getAttribute('data-count'), 10) || 0;
    var counter = document.createElement('p');
    counter.className = 'counter';
    area.insertAdjacentElement('afterend', counter);
    var update = function () {
      var length = Array.from(area.value).length;
      counter.textContent = length + ' 文字' + (max > 0 ? ' / ' + max + '（{link} 置換前）' : '');
      counter.classList.toggle('counter--over', max > 0 && length > max);
    };
    area.addEventListener('input', update);
    update();
  });
});
