<script>
function showInlineError(elementId, message){
  var el = document.getElementById(elementId);
  if (!el) return;
  el.textContent = message;
  el.style.display = 'block';
}
function hideInlineError(elementId){
  var el = document.getElementById(elementId);
  if (!el) return;
  el.textContent = '';
  el.style.display = 'none';
}
</script>
