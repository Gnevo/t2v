{block name='script'}
<script type="text/javascript">
$(document).ready(function(){
    {if $action != "delete"}  $( "#contract_from, #contract_to" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
    });{/if}
});

function saveFormPopup(){
    var errors = 0;
    if($("#contract_from").val() == "" || $("#contract_from").val() == null){
        $("#contract_from").addClass("error");
        errors = 1;
    }else{
        $("#contract_from").removeClass("error");
    }
    if($("#contract_to").val() == "" || $("#contract_to").val() == null){
        $("#contract_to").addClass("error");
        errors = 1;
    }else{
        $("#contract_to").removeClass("error");
    }
    if($("#price_sms").val() == "" || $("#price_sms").val() == null){
        $("#price_sms").addClass("error");
        errors = 1;
    }else{
        $("#price_sms").removeClass("error");
    }
    if($("#price_cust").val() == "" || $("#price_cust").val() == null){
        $("#price_cust").addClass("error");
        errors = 1;
    }else{
        $("#price_cust").removeClass("error");
    }
    if(errors == 0){
        $("#forms_popup").submit();
    }
}

function deleteFormPopup(){
    $('#delete_popup').submit();
}
</script>
{/block}
{block name='content'}
{if $action != "delete"}
<form name="forms_popup" id="forms_popup" method="post" enctype="multipart/form-data" action="{$url_path}ajax_add_company_contract.php" style="margin-top: 5px">
    
    <input type="hidden" name="hiden_val" id="hiden_val" value="" />
    <input type="hidden" name="company" id="company" value="{$company_id}" />
    <input type="hidden" name="contract_id" id="contract_id" value="{$contract_id}" />
    <input type="hidden" name="action" id="action" value="{$action}" />
    <div class="equi_raw">
        <label for="contract_from">{$translate.company_contract_from}</label>
        <input type="text" value="{$contract_detail[0].contract_from}" id="contract_from" name="contract_from" {if $action != "delete"} style="width:40%"{/if} {if $action == "delete"}readonly="readonly"{/if}>
   </div>
    <div class="equi_raw">
        <label for="contract_to">{$translate.company_contract_to}</label>
         <input type="text" value="{$contract_detail[0].contract_to}" id="contract_to" name="contract_to"{if $action != "delete"} style="width:40%"{/if} {if $action == "delete"}readonly="readonly"{/if}>
    </div>
    <div class="equi_raw">
        <label for="price_sms">{$translate.price_per_sms}</label>
        <input type="text" name="price_sms" id="price_sms" value="{$contract_detail[0].price_per_sms}" {if $action == "delete"}readonly="readonly"{/if}/>
    </div> 
    <div class="equi_raw">
        <label for="price_cust">{$translate.price_per_customer}</label>
        <input type="text" name="price_cust" id="price_cust" value="{$contract_detail[0].price_per_customer}" {if $action == "delete"}readonly="readonly"{/if}/>
    </div>
    <div class="equi_raw">
        <label for="price_sign">{$translate.price_per_sign}</label>
        <input type="text" name="price_sign" id="price_sign" value="{$contract_detail[0].price_per_sign}" {if $action == "delete"}readonly="readonly"{/if}/>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#issue_popup').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;" onclick="saveFormPopup()" href="javascript:void(0)">{$translate.save}</a>
    </div> 
</form>{else}
<div style="margin:17px 37px 30px 35px;">{$translate.delete_conform_company_contract}</div>
<form name="delete_popup" id="delete_popup" method="post" action="{$url_path}ajax_add_company_contract.php">
    <input type="hidden" name="company" id="company" value="{$company_id}" />
    <input type="hidden" name="contract_id" id="contract_id" value="{$contract_id}" />
    <input type="hidden" name="action" id="action" value="{$action}" />
</form>
<div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
    <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#issue_popup').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
    <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;" onclick="deleteFormPopup()" href="javascript:void(0)">{$translate.delete}</a>
</div>    
        {/if}
{/block}