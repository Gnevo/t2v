
{block name='script'}

<script type="text/javascript">
/*function change_assign(id,fname,lname){ldelim}
var member = $('#members').val();
member_id = id+",";
new_member = member.replace (member_id, "");
$('#members').val(new_member);

    $('#available').append("<tr id="+id+"><td><a href='javascript:void(0)' onclick=\"change_avail('"+id+"','"+fname+"','"+lname+"')\"><img class='img_ops' src='{$url_path}images/add.png' style='border:none; text-decoration:none' /></a>"+fname+ " "+lname+"</td></tr>");
	$('#assigned tr#'+id).remove();
{rdelim}

function change_avail(id,fname,lname){ldelim}
var member = $('#members').val();
new_member=member+id+",";
$('#members').val(new_member);
   $('#assigned').append("<tr id="+id+"><td><a href='javascript:void(0)' onclick=\"change_assign('"+id+"','"+fname+"','"+lname+"')\"><img class='img_ops' src='{$url_path}images/minus.png' style='border:none; text-decoration:none' /></a>"+fname+ " "+lname+"</td></tr>");
	$('#available tr#'+id).remove();
{rdelim}*/
function save_team(base_url){
            var name = $('#name').val();
            var team_leader = $('#team_leader').val();
            var role = $('#role').val();
   var url = base_url + 'team_add.php?name=' + name + '&team_leader=' + team_leader + '&role=' + role ;
 
              team_action(url);
			  load_team();
                $("#dialog_popup" ).dialog('close');
           
}
function team_action(url){
		$.ajax({
         type: "POST",
        url: url,
         async: false,
         success: function(content){
		 }
    });
   }
 function load_team(){
	$.ajax({
         type: "POST",
        url: "{$url_path}ajax_get_team/",
         async: false,
         success: function(content){
		           $("#chatlist_right").html(content);
				 }
    });
   }
$(document).ready(function() {ldelim}
 var validator = $("#form").validate({ldelim}

        rules: {ldelim}
            
           name: {ldelim}
                required: true
            {rdelim},
			team_leader: {ldelim}
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
    <form id="form" name="form" method="post" >
    <input type="hidden" name="members" id="members" {if $team_detail.members}value="{$team_detail.members},"{else} value=""{/if} />
    <input type="hidden" name="team_id" id="team_id" value="{$team_detail.id}" />
    
        <table  style="float:left;">
            <tr>
                <td width="82">{$translate.name}</td>
                <td width="237"><input name="name" id="name" type="text" value="{$team_detail.name}" /></td>
                
            </tr>{if $smarty.request.role=='3'}
            <tr>
                <td>{$translate.team_leader}</td>
                <td><select name="team_leader" id="team_leader">
                <option value="">{$translate.select_tl}</option>
                {html_options options=$available_teamleaders selected = {$team_detail.tl}}
                </select> </td>

            </tr>{/if}
            <tr>
                
                <td><a href="javascript:void(0);" onclick="save_team('{$url_path}')" class="alocation_lvbtn">{$translate.save}</a></td>
            </tr>
        </table>
       <!-- <table style="float:left;"><tr><td>
       <div id="assigned"><table ><tr>
        <th>{$translate.assigned_members}</th></tr>
        {foreach from=$assigned_members item=row}<tr id="{$row.username}"><td>
        <a href="javascript:void(0);" onclick="change_assign('{$row.username}','{$row.first_name}','{$row.last_name}');"><img class="img_ops" src="{$url_path}images/minus.png" style="border:none; text-decoration:none" title="" /></a>{$row.first_name} {$row.last_name}
        </td></tr>{/foreach}
       </table></div></td></tr><tr><td><div id="available"><table style="">
        <tr><th>
        {$translate.available_members}</th></tr>
       {foreach from=$available_members item=row}<tr id="{$row.username}"><td>
        <a href="javascript:void(0);" onclick="change_avail('{$row.username}','{$row.first_name}','{$row.last_name}');"><img class="img_ops" src="{$url_path}images/add.png" style="border:none; text-decoration:none" title="" /></a>{$row.first_name} {$row.last_name}
        </td></tr>{/foreach}
        
        </table></div></td></tr></table>-->
     </form>
     
</div>
{/block}
