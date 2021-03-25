{block name='script'}
<script type="text/javascript">

$(document).ready(function() {
    
    $("#replace_date_from, #replace_date_to").datepicker({
        showOn: "button",
        dateFormat: "yy-mm-dd",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true,
        defaultDate: '{$slot_detail.date}',
        onClose: function(){ 
                loadEmployee();
        }
    });

    $('#repl_infocus').change(function(){
        loadEmployee();
    });
});
    
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
        
function save_replace() {

    var in_focus = 0;
    var dfrom = $('#replace_date_from').val();
    var dto = $('#replace_date_to').val();
    if(dfrom != '' && dto != ''){

        var emp_rep = "";
        var values = $('input:radio:checked.rep_radio_rep').map(function() {
            return this.value;
        }).get();

        if (values.length)
            emp_rep = values[0];


        if (emp_rep == '') {
            alert('{$translate.select_replace_employee}');
        } else {
            if ($('#repl_infocus').attr("checked") == "checked")
                in_focus = 1;

            wrapLoader(".copy_contnts");
            $('#main_process_save').load('{$url_path}ajax_process_main.php?from_date=' + dfrom + '&to_date=' + dto + '&employee={$slot_detail.employee}&employee_rep=' + emp_rep + '&type=replace&cur_week={$cur_week}&user={$slot_detail.customer}&focus=' + in_focus, function(response, status, xhr) {
                uwrapLoader(".copy_contnts");
                $('#chk_status').val('1');
            });
        }
    }
    else
        alert('{$translate.please_select_one_date}');
}

function loadEmployee() {

    var dfrom = $('#replace_date_from').val();
    var dto = $('#replace_date_to').val();

    var customer_checked = $('input:checkbox[name=repl_infocus]:checked').val();
    var is_customer_checked = 0;
    if (customer_checked) is_customer_checked = 1;

    if(dfrom != '' && dto != ''){
        wrapLoader("#rep_list_emp");
        $('#rep_list_emp').load('{$url_path}ajax_process_main.php?start_date=' + dfrom + '&end_date=' + dto + '&selected_emp={$slot_detail.employee}&sel_customer={$slot_detail.customer}&is_customer_checked='+is_customer_checked+'&type=rep_emp_load', function(response, status, xhr) {
            uwrapLoader("#rep_list_emp");
        });

    } else {
        $('#rep_list_emp').html('');
    }
}
function op_close() {
    $(this).dialog('destroy').remove();
    $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_process_main"]').remove();
    $('#timetable_process_main').remove();

    reload_popup_themes();
    if ($('#chk_status').val() == 1) {
        reload_content();
    }
    $('#chk_status').val('0');
}
</script>
{/block}

{block name='content'}
    {$message}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div id="main_process_save"></div>
        <div class="copy_contnts">
            <div id="tabbed_pannel">
                {if $slot_detail.employee neq '' and !empty($slot_detail)}
                    <div class="pannel_holder" id="pannel_holder">
                        <div class="pannel selected" style="width: auto;">
                            <form name="frm_rep" method="post">
                                <div class="copy_frm_title">
                                    <div style="float:left;">
                                            <label style="font-weight: bold;">{$translate.replacing_employee}: </label>
                                            {$slot_detail.emp_first_name|cat: ' '|cat:$slot_detail.emp_last_name}
                                    </div>
                                    <div style="float:right;">
                                            <label style="font-weight: bold;">{$translate.customer}: </label>
                                            <input type="checkbox" name="repl_infocus" value="radio" id="repl_infocus"  checked="checked"/>
                                            {$customer_details.first_name} {$customer_details.last_name}
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="replace_right">
                                        <div class="right_search" style="height: 94%; padding: 5px;">
                                            <input name="replace_date_from" id="replace_date_from" value="{$slot_detail.date}" type="text" class="right_search_fld" />
                                            <input name="replace_date_to" type="text"id="replace_date_to" class="right_search_fld" value=""/>
                                        </div>
                                    </div>
                                    <div class="replace_right">
                                        <div class="right_search"><div style="padding: 9px; font-weight: bold;">{$translate.replacer_employees}</div></div> 
                                        <div  id="rep_list_emp" style="float:left; height:138px; width:230px; overflow: auto; padding: 5px;"></div>
                                    </div>
                                    <input name="btn_rep_close" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                                    <input name="btn_rep" type="button" class="tabbed_btn" value="{$translate.replace}" onclick="save_replace()"/>
                                </div>
                            </form>        
                        </div>         
                    </div>
                {else if empty($slot_detail)}
                    <div class="info_name" style="width: 98%;">{$translate.invalid_slot}</div>
                {else}
                    <div class="info_name" style="width: 98%;">{$translate.select_a_non_empty_employee_slot}</div>
                {/if}

                <div style="clear:both"></div>
        </div>
    </div>
{/block}