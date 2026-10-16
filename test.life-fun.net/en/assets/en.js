/* en/assets/en.js — shared JS for the English section (/en/).
   GA4 events used in this section (only these three): en_omikuji_draw, en_official_link, en_share. */
(function () {
  'use strict';

  function enTrack(name, params) {
    if (typeof gtag === 'function') gtag('event', name, params || {});
  }
  window.enTrack = enTrack;

  // Clicks on links to a shrine's or temple's official site: <a data-official="key">
  document.addEventListener('click', function (ev) {
    var t = ev.target;
    var el = t && t.closest ? t.closest('a[data-official]') : null;
    if (el) enTrack('en_official_link', { site: el.dataset.official });
  });
})();
