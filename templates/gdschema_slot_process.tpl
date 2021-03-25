{block name='script'}
<script>
    
function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){

        {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
            if(typeof animation_element !== "undefined")
                wrapLoader(animation_element);
            else 
                wrapLoader("#assigned_inner");

            $.ajax({
                url: "{$url_path}ajax_check_atl_and_contract.php",
                type: "GET",
                data: check_url_data,
                dataType: "json",
                success:function(data){
    {*                console.log(data);*}
                    {if $company_atl_checking_flag eq 1}
                        if(data.atl == 'success'){
                            {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                _fn_success_call_back(_call_back_data);
                            {else}  /*checking contract*/
                                if(data.contract == 'success'){
                                    _fn_success_call_back(_call_back_data);
                                }else{
                                    {if $privilages['contract_override'] eq 1}
                                        $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                        $( "#dialog-confirm-contract" ).dialog({
                                                resizable: false,
                                                width: 350,
                                                modal: true,
                                                buttons: {
                                                    "{$translate.yes}": function() {
                                                            $( this ).dialog( "close" );
                                                            _fn_success_call_back(_call_back_data);
                                                    },
                                                    "{$translate.no}": function() {
                                                        $( this ).dialog( "close" );
                                                    }
                                                }
                                        });
                                    {else}
                                        $("#overlap_error").remove();
                                        $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                    {/if}
                                }
                            {/if}
                        }
                        else{
                            _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                            {if $privilages.atl_override eq 1}
                                $("#dialog-confirm p").html("<span class='error_msg_icon'></span>" + data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}");
                                $( "#dialog-confirm" ).dialog({
                                    resizable: false,
                                    width: 350,
                                    modal: true,
                                    buttons: {
                                        "{$translate.yes}": function() {
                                                $( this ).dialog( "close" );
                                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                    _fn_success_call_back(_call_back_data);
                                                {else}
                                                    if(data.contract == 'success'){
                                                         _fn_success_call_back(_call_back_data);
                                                    }else{
                                                        {if $privilages['contract_override'] eq 1}
                                                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                                                $( "#dialog-confirm-contract" ).dialog({
                                                                    resizable: false,
                                                                    width: 350,
                                                                    modal: true,
                                                                    buttons: {
                                                                        "{$translate.yes}": function() {
                                                                                $( this ).dialog( "close" );
                                                                                _fn_success_call_back(_call_back_data);
                                                                        },
                                                                        "{$translate.no}": function() {
                                                                            $( this ).dialog( "close" );
                                                                        }
                                                                    }
                                                                });
                                                        {else}
                                                                $("#overlap_error").remove();
                                                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                                        {/if}
                                                    }
                                                {/if}
                                            },
                                        "{$translate.no}": function() {
                                            $( this ).dialog( "close" );
                                        }
                                    }
                                }); 
                            {else} 
                                 alert(data.atl);
                            {/if}
                        }
                    {else if $company_contract_checking_flag eq 1}
                        if(data.contract == 'success'){
                            _fn_success_call_back(_call_back_data);
                        }else{
                            {if $privilages['contract_override'] eq 1}
                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                $( "#dialog-confirm-contract" ).dialog({
                                        resizable: false,
                                        width: 350,
                                        modal: true,
                                        buttons: {
                                            "{$translate.yes}": function() {
                                                    $( this ).dialog( "close" );
                                                    _fn_success_call_back(_call_back_data);
                                            },
                                            "{$translate.no}": function() {
                                                $( this ).dialog( "close" );
                                            }
                                        }
                                });
                            {else}
                                $("#overlap_error").remove();
                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                            {/if}
                        }
                    {/if}
                 },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
             })
             .always(function(data) {
                if(typeof animation_element !== "undefined")
                    uwrapLoader(animation_element);
                else 
                    uwrapLoader("#assigned_inner");
            });
        {else}
            _fn_success_call_back(_call_back_data);
        {/if}
}

function loadAdd(url){
    var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
    if(url_obj.action == "paste"){
{*                alert(url  + '&type_check=8'); return false;*}
        var atl_req_data = url.substring(url.indexOf('?')+1) + '&type_check=8';
        check_atl_warning(atl_req_data, function(this_url){
                            $('#alloc_action').load(this_url,function(response, status, xhr){ $("#timetable_process" ).dialog("close"); });
                        }, url, '#timetable_process');
    }else{
        $('#alloc_action').load(url,function(response, status, xhr){ $("#timetable_process" ).dialog("close"); });
    }
}
function loadAddConfirm(url){
    if(confirm('{$translate.confirm_delete}')){
    //    $('#timetable_process').dialog('close');
        $('#alloc_action').load(url,function(response, status, xhr){ $("#timetable_process" ).dialog("close"); });
    }
}
function loadContentSlot(url){
    $('#timetable_process').load(url);
    }
function loadContentCopy(url){
    $('#timetable_process_copy').load(url);
}        
        
</script>
{/block}

{block name='content'}
{$message}
{assign var = 'url_val' value='' scope='global'}
{assign var = 'url_val_popup' value='' scope='global'}
{assign var = 'url_val_copy' value='' scope='global'}
{if $employee.name != '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_slot_process.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_copy = $url_path|cat:'gdschema_process_copy.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}
    {$url_val = $url_path|cat:'ajax_slot_process.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_copy = $url_path|cat:'gdschema_process_copy.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_slot_process.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_copy = $url_path|cat:'gdschema_process_copy.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}
<div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
<div class="detail_process_btns">
    {if $flag_copy == 1}
        {if $privileges_gd.copy_day_slot == 1}<a href="javascript:void(0);" onclick="loadAdd('{$url_val}&action=copy')" class="alocation_btn">{$translate.copy}</a>
        {if $privileges_gd.delete_day_slot == 1 && $flag_sign == 0}<a href="javascript:void(0);" onclick="loadAddConfirm('{$url_val}&id={$slot_details.id}&action=slot_remove')" class="alocation_btn">{$translate.delete}</a>{/if}{/if}
        {if $privileges_gd.copy_day_slot_option == 1}<a href="javascript:void(0);" onclick="loadPopupProcessCopy('{$url_val_copy}')" class="alocation_btn">{$translate.copy_multiple}</a>{/if}
    {/if}    
    {if $flag_paste == 1}
        {if $privileges_gd.copy_day_slot == 1 && $flag_sign == 0}<a href="javascript:void(0);" onclick="loadAdd('{$url_val}&action=paste')" class="alocation_btn">{$translate.paste}</a>{/if}
    {/if}
{if ($privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.add_slot == 1) && $flag_sign == 0}<a href="javascript:void(0);" onclick="navigatePage('{$url_val_popup}',1)" class="alocation_btn">{$translate.add_new_slot}</a>{/if}
    
</div>
<div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
    <a class="alocation_btn" style="float:right; display:block; margin:8px 35px 0px 0px; padding: 4px 0 5px;" onclick="$('#timetable_process').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
</div>
{/block}