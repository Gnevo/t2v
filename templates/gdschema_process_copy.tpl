{block name='script'}
<!--<script type="text/javascript" src="{$url_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.validate.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>-->
<script>
        $(document).ready(function() {
            getAfterDates();
        });

        function getAfterDates() {
            var max_week_number = 52;
            var year_week = '{$cur_date}';
            var year = parseInt({$cur_year_of_week}, 10);
            var to_week = parseInt($("#from_wk").val()) + (parseInt($("#from_option").val()));
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('#to_wk').find('option').remove();
            for (i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#to_wk");
                to_week = to_week + 1;
            }
        }


        function save_copy() {
            
            var days = "";
            var with_user = 1;
            for (var i = 0; i < document.frm_copy.days.length; i++) {
                if (document.frm_copy.days[i].checked)
                    days += document.frm_copy.days[i].value + '-';
            }
            if (days == '') {
                alert('select days');
            } else {
                if ($('#withoutuser').attr("checked") == "checked")
                    with_user = 0;
                $('#chk_status').val('1');
                var additional_urldata = 'customer={$customer}&employee={$employee}&date={$cur_date}' + '&from_week=' + $('#from_wk').val() + '&from_option=' + $('#from_option').val() + '&to_week=' + $('#to_wk').val() + '&days=' + days + '&id={$slot_details.id}&with_user=' + with_user + '&action=copy_multiple&user={$in_user}';
{*                alert(additional_urldata+'&type_check=11');*}
                var process_url = '{$url_path}ajax_process_copy.php?' + additional_urldata;
                if(with_user == 1){
                    var atl_req_data = additional_urldata+'&type_check=11';
                    check_atl_warning(atl_req_data, function(this_url){
                                        wrapLoader("#slot_manage_copy_multiple");
                                        $('#copy_multiple_save').load(this_url, function(response, status, xhr) { uwrapLoader("#slot_manage_copy_multiple"); });
                                    }, process_url, "#slot_manage_copy_multiple");

                }else{
                    wrapLoader("#slot_manage_copy_multiple");
                    $('#copy_multiple_save').load(process_url, function(response, status, xhr) { uwrapLoader("#slot_manage_copy_multiple"); });
                }
            }
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

        function op_close() {
            $("#timetable_process_copy").dialog('destroy').remove();
            reload_popup_themes_copy();
        }

    </script>
{/block}

{block name='content'}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div id="status_msg">{$message}</div>

    {assign var = 'url_val' value='' scope='global'}

    {if $employee.name != '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_process_copy.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}

    {elseif $employee.name != '' && $customer.name ==''}{$url_val = $url_path|cat:'ajax_process_copy.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}

    {elseif $employee.name == '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_process_copy.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}

    {/if}

    <div id="copy_multiple_save" ></div>
    <div id="slot_manage_copy_multiple" >
        <fieldset style="width: 504px;"><legend>{$translate.copy_multiple}</legend>
            <form name="frm_copy" id="frm_copy" method="post">
                <div class="title_strip">
                    {$translate.copy_options}
                    <div style="float:right;padding-top: 1px;">V{$cur_week}:&nbsp;{$cur_date}</div>
                </div>
                <div>
                    <p>
                        {if $slots_with_user}

                            <label>
                                <input type="radio" name="withuser" value="radio" id="withuser"  checked="checked"/>
                                {$translate.with_user}</label>
                            {/if}    
                            {if $slots_without_user}
                            <label>
                                <input type="radio" name="withuser" value="radio" id="withoutuser" {if $slots_with_user == 0}checked="checked"{/if}/>
                                {$translate.without_user}</label>
                            {/if}


                    </p>
                </div>
                <div id="radio">
                    <input type="checkbox"  name="days" value="1" checked="checked"/><label for="radio">M</label>
                    <input type="checkbox"  name="days" value="2" checked="checked"/><label for="radio">T</label>
                    <input type="checkbox"  name="days" value="3" checked="checked"/><label for="radio">W</label>
                    <input type="checkbox"  name="days" value="4" checked="checked"/><label for="radio">T</label>
                    <input type="checkbox"  name="days" value="5" checked="checked"/><label for="radio">F</label>
                    <input type="checkbox"  name="days" value="6" checked="checked"/><label for="radio">S</label>
                    <input type="checkbox"  name="days" value="0" checked="checked"/><label for="radio">S</label>

                </div>

                <div class="from_to_week">
                    <div>
                        {$translate.from_week}
                        <select class="frm_wk_selct" id="from_wk" onchange="getAfterDates()">
                            {section name=week start={$cur_week+1} loop={$no_of_weeks+1} step=1}
                                <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week+1} selected="selected"{/if}>{$smarty.section.week.index}</option>

                            {/section}

                        </select>
                        <select name="from_option" id="from_option" onchange="getAfterDates()">
                            <option value="0">{$translate.every_week}</option>
                            <option value="1">{$translate.every_2}</option>
                            <option value="2">{$translate.every_3}</option>
                            <option value="3">{$translate.every_4}</option>
                        </select>
                        {$translate.copy_to}
                        <select name="to_wk" id="to_wk">

                        </select>

                    </div>

                </div>
                <div style="clear:both; text-align:center; margin-top: 10px; float: right;">
                    <a style="margin-right: 10px;width: 63px;padding: 3px 0px 0px 0px;height: 20px" href="javascript:void(0);" onclick="save_copy()" class="alocation_lvbtn">{$translate.copy}</a>
                    <a style="width: 63px;padding: 3px 0px 0px 0px;height: 20px"href="javascript:void(0);" onclick="op_close()" class="alocation_lvbtn">{$translate.close}</a>
                </div>
            </form>
        </fieldset></div> 
{/block}