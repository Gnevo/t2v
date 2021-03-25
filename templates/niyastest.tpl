{block name='script'}
<script>
$(document).ready(function(){ 
  $('#first').oncontextmenu = function() { return false; };

  $('#first').mousedown(function(e){ 
    if( e.button == 2 ) { 
      alert('Right mouse button!'); 
      return false; 
    } 
    return true; 
  }); 
});
</script>

{/block}
{block name='content'}
<div style="width: 200px;height: 200px; border: solid 2px #000000" id="first">asd</div>
<div style="width: 100px;height: 100px; border: solid 2px #000000" id="second">dd</div>
<div></div>
{/block}