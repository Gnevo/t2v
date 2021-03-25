{block name='style'}
 <link rel="stylesheet" href="{$url_path}css/autoSuggest.css" type="text/css" media="screen" />
 {/block}
{block name="script"} 
<script src="{$url_path}js/jquery.autoSuggest.packed.js" type="text/javascript" ></script>
<script src="{$url_path}js/jquery.autoSuggest.js" type="text/javascript" ></script>
<script src="{$url_path}js/jquery.autoSuggest.minified.js" type="text/javascript" ></script>
{literal}
<script>
var data = {items:[
            {/literal}{foreach from=$customerlist item=customer}  
                    {
                     value: "{$customer.username}",
                     name: "{$customer.last_name} {$customer.first_name}"
                    },
            {/foreach} {literal}
        ]};
$("#tags").autoSuggest(data.items,{selectedItemProp: "name", searchObjProps: "name", selectedValuesProp:"value"}); 

function getSubmit(){
	var tags = jQuery(".as-values").val();
	var new_tempate_name = jQuery("#new_tempate_name_copy").val();
            
	//var tags = document.getElementById("tags").value; alert(tags); 
	if(new_tempate_name == ''){
		document.getElementById("temp_add_error").style.display="block";
		return false;
	}else{
		document.getElementById("temp_add_error").style.display="none";
        }
	
   if(tags == '' || tags == "Ange namn har"){
		document.getElementById("temp_error").style.display="block";
		return false;
	}else{
		document.getElementById("temp_error").style.display="none";
	}
	
	document.getElementById("frm").submit();
}

</script>
{/literal}
{/block}

{block name="content"}
<body> 
<form name="frm" id="frm" action="" method="post" >
<input type="hidden" id="customers_ids" value="cust" name="customers_ids" size="60" />
<input type="hidden" id="sdate" value="{$sdate}" name="sdate" size="60" />
<input type="hidden" id="customer" value="{$customer_username}" name="customer" size="60" />
<input type="hidden" id="edate" value="{$edate}" name="edate" size="60" />
<table cellsapacing="0" cellpadding="2" style="padding-top:5px;padding-left:5px;" >

<tr>
	<td width="38%" valign="top">{$translate.template_name} </td>
    <td valign="top">
    	 <input type="text" id="new_tempate_name_copy" value="" name="new_tempate_name_copy" size="30" /><br/>
        <span  id="temp_add_error" style="color: red; display: none;" >{$translate.enter_template_name}</span>
    </td>
</tr>
<tr>
 <td width="38%" style="vertical-align:text-top;padding-top:3px;" >{$translate.select_customers} </td>
 <td valign="top">
     <div class="ui-widget">
		<input type="text" id="tags" value="" name="customers_name"  />
		<label id="temp_error" style="color:red;display:none;" >{$translate.enter_name_here}</label>
     </div>   
</td>
</tr>
<tr>
	<td valign="top" colspan="2" >
    	<div onClick="return getSubmit();" style="cursor: pointer; text-align: center; width: 200px;margin-top:7px;" class="week_num">{$translate.copy_schedule}</div>
    </td>
</tr>

</table>
</form>
{/block}