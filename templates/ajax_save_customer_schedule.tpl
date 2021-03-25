{literal}
<script>
function savedata()
{	
	var template_name = $("#template_name").val();
	var new_tempate_name = $("#new_tempate_name").val();
	if(new_tempate_name.trim() == '' && template_name == ""){
		document.getElementById("temp_error").style.display="block";
		return false;
	}else{
		document.getElementById("temp_error").style.display="none";
	}
	
			document.getElementById("frm").submit();
}
</script>    
{/literal}    
{block name="content"}
<body>
<form name="frm" id="frm" action="" method="post" >
<div class="ui-widget">
<input type="hidden" id="sdate" value="{$sdate}" name="sdate" size="60" />
<input type="hidden" id="template" value="save" name="template" size="60" />
<input type="hidden" id="customer" value="{$customer_username}" name="customer" size="60" />
<input type="hidden" id="edate" value="{$edate}" name="edate" size="60" />
<table cellsapacing="0" cellpadding="2" >
<tr>
	<td>{$translate.exist_template} : </td>
    <td>
    	<select name="template_name" id="template_name"style="width:150px;border:1px solid #DDDDDD;"  >
            <option value="" >-- {$translate.select_template} --</option>
  
  	  	    {foreach from=$customer_temp item=temp}         
	
                <option value="{$temp.tid}" >{$temp.temp_name|stripslashes}</option>
                
            {/foreach}
            
        </select>
    </td>
</tr>
<tr>
	<td colspan="2" style="text-align:center;" >{$translate.label_or}</td>
</tr>
<tr>
	<td valign="top">{$translate.template_name} : </td>
    <td valign="top">
    	<input type="text" id="new_tempate_name" value="" name="new_tempate_name" size="30" /><br/>
        <span class="error" id="temp_error" style="color: red; display: none;" >{$translate.enter_template_name}</span><br/>
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td valign="top">
    	<div onClick="return savedata();" style="cursor: pointer; text-align: center; width: 200px;" class="week_num">{$translate.save_template}</div>
    </td>
</tr>

</table>
</div>
</form>
{/block}