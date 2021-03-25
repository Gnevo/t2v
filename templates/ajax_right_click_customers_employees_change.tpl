<script>
function submitForm(username){
        var url = {if $source_type eq 1 or $source_type eq 3} "customer={$page_user}" {else if $source_type eq 2} "employee={$page_user}" {/if};
        url += "{if $source_type eq 1 or $source_type eq 2}&week_num={$year_week}{else if $source_type eq 3}&sel_year={$selected_year}&sel_month={$selected_month}{/if}&method=1&ids={$ids}";
        url += {if $method eq 1} "&employee_username="+username {else if $method eq 2} "&customer_select="+username {/if};
        
        var atl_req_data = url+'&type_check=17&right_click=1';
        var process_url = '{$url_path}ajax_alter_slot_employee_customer.php?'+url;
        check_atl_warning(atl_req_data, function(this_url){ 
                            $('#right_click_change_type').dialog('close');
                            navigatePage(this_url, 1); 
                        }, process_url, '#scrolling');
}

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
                                    {if $privilages_main['contract_override'] eq 1}
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
                            {if $privilages_main.atl_override eq 1}
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
                                                        {if $privilages_main['contract_override'] eq 1}
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
                            {if $privilages_main['contract_override'] eq 1}
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

function assign_users(username){
        {if $method == 1}
            wrapLoader('#scrolling');
            $.ajax({
                url:    "{$url_path}ajax_customers_employees_change.php",
                type:   "POST",
                data:   "employee_username="+username+"&ids={$ids}&action=check_overlap",
                success:function(data){
                        uwrapLoader('#scrolling');
                        if(data == 'sucess'){
                            submitForm(username);
                        }else{
                            alert("{$translate.overlapped} " + data);
                        }
                }
            });
        {else if $method == 2}
            submitForm(username);
        {/if}
}

$(document).ready(function (){
    $('#scrolling').jScrollPane();

});
</script>

{if $method == 1}
    <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="padding-bottom: 7px; margin-bottom: 0px;">
                <div class="select_skill_title">{$translate.select_employee}</div>
                <div id="scrolling_area"> 
                    <div id="scrolling" style="max-height: 270px;">
                        <ul>
                            {foreach $list_employees AS $empl}
                                <li id="a" onclick="assign_users('{$empl.username}')">{if $sort_by_name == 1}{$empl.name_ff}{elseif $sort_by_name == 2}{$empl.name}{/if}</li>
                            {foreachelse}
                                <div class="message">{$translate.no_data_available}</div>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div> 
            <div style="clear:both;"></div>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#right_click_change_type').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
    </div>
{else if $method == 2}
    
    <div class="cstmr_wk_main">
        <div class="select_skill_scroller" style="padding-bottom: 7px; margin-bottom: 0px;">
            <div class="select_skill_title">{$translate.select_customer}</div>
            <div id="scrolling_area"> 
                <div id="scrolling" style="max-height: 270px;">
                    <ul>
                        {foreach $list_customers AS $cust}
                            <li id="a" onclick="assign_users('{$cust.username}')">{if $sort_by_name == 1}{$cust.first_name} {$cust.last_name}{elseif $sort_by_name == 2}{$cust.last_name} {$cust.first_name}{/if}</li>
                        {foreachelse}
                            <div class="message">{$translate.no_data_available}</div>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div> 
        <div style="clear:both;"></div>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#right_click_change_type').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
    </div>
{/if}