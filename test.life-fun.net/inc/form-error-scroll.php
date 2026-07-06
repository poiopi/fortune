<script>
(function(){
  function tryScrollToError(){
    var el = document.querySelector('.error-box') || document.querySelector('.error-list');
    if (!el) return;
    el.scrollIntoView({behavior:'smooth', block:'center'});
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', tryScrollToError);
  } else {
    tryScrollToError();
  }
})();
</script>
