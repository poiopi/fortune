<script>
function clearBirthdate(prefix){
  var y = document.getElementById(prefix+'-year');
  var m = document.getElementById(prefix+'-month');
  var d = document.getElementById(prefix+'-day');
  var h = document.getElementById(prefix+'-hidden');
  if(y) y.value = '';
  if(m) m.value = '';
  if(d) d.value = '';
  if(h) h.value = '';
}
function clearName(id){
  var el = document.getElementById(id);
  if(el) el.value = '';
}
function resetRadioGroup(name, defaultValue){
  var radios = document.getElementsByName(name);
  for(var i=0;i<radios.length;i++){
    radios[i].checked = (radios[i].value === defaultValue);
  }
}
function resetResultView(formId, resultId){
  var form = document.getElementById(formId);
  var result = document.getElementById(resultId);
  if(form) form.style.display = 'block';
  if(result) result.style.display = 'none';
  window.scrollTo({top:0, behavior:'smooth'});
}
</script>
