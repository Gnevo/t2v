
{block name='script'}

<script type="text/javascript">
function save_work(base_url){
            var name = $('#name').val();
            var root_id = $('#root_id').val();
            var description = $('#description').val();
            var image = $('#image').val();
   var url = base_url + 'works_add.php?name=' + name + '&root_id=' + root_id + '&description=' + description + '&image=' + image ;
  
              work_action(url);
			  load_work();
                $("#dialog_popup" ).dialog('close');
           
}
function work_action(url){
		$.ajax({
         type: "POST",
        url: url,
         async: false,
         success: function(content){
		 }
    });
   }
 function load_work(){
	$.ajax({
         type: "POST",
        url: "{$url_path}ajax_get_available_works/",
         async: false,
         success: function(content){
		           $("#available").html(content);
				 }
    });
   }
$(document).ready(function() {ldelim}
    
   var validator = $("#form").validate({ldelim}

        rules: {ldelim}
            
           name: {ldelim}
                required: true
            {rdelim},
			root_id: {ldelim}
                required: true
            {rdelim},
			description: {ldelim}
                required: true
            {rdelim}
		{rdelim}
    {rdelim});
    
    {rdelim});
</script>
{/block}

{block name="content"}
{$message}
<div id="log_hd"></div>
<div id="log_form">
    <form id="form" name="form"   enctype="multipart/form-data">
        <table >
            <tr>
                <td width="82">{$translate.name}</td>
                <td width="237"><input name="name" id="name" type="text" /></td>
            </tr>
            <tr>
                <td>{$translate.root_id}</td>
                <td><select name="root_id" id="root_id">
                <option value="0">&lt;root&gt;</option>
                {$works}
                </select> 
                </td>

            </tr>
            
            <tr>
                <td>{$translate.description}</td>
                <td><input name="description" id="description" type="text" /></td>

            </tr>
          <!--  <tr>
            <td>{$translate.image}</td><td><input type="file" name="image" id="image" /></td>
            </tr>-->
           
            <tr>
                <td></td>
                <td><a href="javascript:void(0);" onclick="save_work('{$url_path}')" class="alocation_lvbtn">{$translate.save}</a></td>
            </tr>
        </table>
    </form>
</div>
{/block}
