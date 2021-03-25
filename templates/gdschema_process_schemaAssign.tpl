{block name='style'}
    <link rel="stylesheet" type="text/css" href="{$url_path}css/cirrus_gdschema.css?v={filemtime('css/cirrus_gdschema.css')}" />
    <style type="text/css">
        .assign_multi_week_op_div{
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #DCDCDC;
            margin: 0 4px 4px;
            padding-top: 5px;
        }
    </style>
{/block}
{block name='script'}
<script type="text/javascript">
    $(document).ready(function() {
        getAfterDates();
        {if $this_slot_info.customer != '' && $this_slot_info.employee == ""}
        getAvailableEmployees(1);
        {/if}
        
        $(".check_days").click(function(){
            getAvailableEmployees(2);
        });
        
        
    });

    function getAfterDates(){
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
        
        getAvailableEmployees(2);
    }
    
    function save_schema_assign(){
    
        {if $atl_warning_check_flag}
            var atl_warming_check = 1;
        {else}
            var atl_warming_check = 0;
        {/if}
        
        var days = "";
        for (var i = 0; i < document.frm_assign.days.length; i++) {
            if (document.frm_assign.days[i].checked)
                days += document.frm_assign.days[i].value + '-';
        }
        if (days == '') {
            alert('select days');
        } else {
            var url = '{$url_data}';
            
            var from_week = $('#from_wk').val();
            var to_week = $('#to_wk').val();
            var from_option = $('#from_option').val();
            
            var dnt_chk = $('input:checkbox:checked#dnt_show_again').val();
            var dnt_chk_val = 0;
            if (dnt_chk) dnt_chk_val = 1;
            
            
           {if $action eq 'employee_assignment'}  //for direct employee assignment
                var selected_ids = $('#assigned_inner .custom_time_slots_incomplete input:checkbox:checked.get_slot_check').map(function () {
                                return this.value;
                }).get().join(',');
{*                url += '&ids='+$('#multi_slot_id').val();*}
                url += '&ids='+ selected_ids;
            {/if}
            var select_employee = $('#select_employee').val();
            if(select_employee != "")
                atl_warming_check = 1;
            var additional_urldata = url + '&from_week=' + from_week + '&from_option=' + from_option + '&to_week=' + to_week + '&days=' + days+'&select_employee='+select_employee;
            additional_urldata += '&dnt_show_flag='+dnt_chk_val;
/*
//            var additional_url_split = additional_urldata.split("&");
//            var new_urldata = '';
//            for(var i=0;i<additional_url_split.length;i++){
//               var temp_additional_url = additional_url_split[i].split("=");
//               if(temp_additional_url[0] == "employee"){
//                   if(temp_additional_url[1] == ""){
//                        if(select_employee == ''){
//                            if(new_urldata == ''){
//                                new_urldata = additional_url_split[i];
//                            }else{
//                                new_urldata = new_urldata+"&"+additional_url_split[i];
//                            }
//                            
//                        }else{
//                           if(new_urldata == ''){
//                                new_urldata =temp_additional_url[0]+"="+select_employee;
//                            }else{
//                                new_urldata = new_urldata+"&"+temp_additional_url[0]+"="+select_employee;
//                                atl_warming_check = 1;
//                            } 
//                        }
//                   }else{
//                        if(new_urldata == ''){
//                            new_urldata = additional_url_split[i];
//                        }else{
//                            new_urldata = new_urldata+"&"+additional_url_split[i];
//                        }
//                   }
//               }else{
//                    if(new_urldata == ''){
//                        new_urldata = additional_url_split[i];
//                    }else{
//                        new_urldata = new_urldata+"&"+additional_url_split[i];
//                    }
//               }
//            }
            
//            additional_urldata = new_urldata;
*/
            var full_url = '{$url_path|cat:'ajax_alloc_action.php?'}' + additional_urldata;
            
            {if $action eq 'employee_assignment'}  //for direct employee assignment
                var contract_param = '13';
                if(atl_warming_check == 1){
                    var atl_req_data = additional_urldata + "&schemaAssign=employee&type_check="+contract_param;

                    check_atl_warning(atl_req_data, function(this_url){
                                        navigatePage(this_url, 1);
                                    }, full_url, '#timetable_process_copy',select_employee);
                }else{
                    $( this ).dialog( "close" );
                    navigatePage(full_url, 1);
                    $('#allocate_cusempwork').dialog('close');
                }
            {else if $action eq 'drop'}
                var contract_param = '14';
                var atl_req_data = additional_urldata + "&schemaAssign=employee&type_check="+contract_param;
                dropSlot_Weekly_proceed('{$this_slot_info.time_from}', '{$this_slot_info.time_to}', '{$this_slot_info.fkkn}', '{$this_slot_info.type}', days, from_week, to_week, from_option, dnt_chk_val, full_url, atl_req_data);
            {/if}
                
{*            alert(additional_urldata + '&type_check='+contract_param); *}
{*            return false;*}
        }
    }
    
    function save_schema_man_entry(){
        var days = "";
        for (var i = 0; i < document.frm_assign.days.length; i++) {
            if (document.frm_assign.days[i].checked)
                days += document.frm_assign.days[i].value + '-';
        }
        if (days == '') {
            alert('{$translate.select_days}');
        } else {
            var from_week = $('#from_wk').val();
            var to_week = $('#to_wk').val();
            var from_option = $('#from_option').val();
            
            var dnt_chk = $('input:checkbox:checked#dnt_show_again').val();
            var dnt_chk_val = 0;
            if (dnt_chk) dnt_chk_val = 1;
            
            manEntry_Weekly_proceed(days, from_week, to_week, from_option, dnt_chk_val);
        }
    }
    
    function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element,select_employee){

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
                            $('#timetable_process_copy').dialog('close');
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
                            $('#timetable_process_copy').dialog('close');
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
                $('#timetable_process_copy').dialog('close');
                _fn_success_call_back(_call_back_data);
            {/if}
    }

    function op_close(){
        if($('#schema_delete_process_status').val() ==  1)
            reload_content();
        $("#timetable_process_copy").dialog('destroy').remove();
        reload_popup_themes_copy();
    }

    function schema_assign_no(){
        var dnt_chk = $('input:checkbox:checked#dnt_show_again').val();
        var dnt_chk_val = 0;
        if(dnt_chk) dnt_chk_val = 1;
{*        alert(dnt_chk_val); return false;*}
        $("#timetable_process_copy").dialog( "close" );
        //second parameter specifies, whether action is drop or employee assignment
        {if $action eq 'employee_assignment'}  //for direct employee assignment
                AssignEmployeesMultiple('{$url_data}'+'&dnt_show_flag='+dnt_chk_val);
        {else if $action eq 'drop'} //time slot dropping
                drop_time_slot({$time_from}, {$time_to}, {$slot_type}, dnt_chk_val);
        {else if $action eq 'man_slot_entry'}   //time slot manually enter
                manEntry(dnt_chk_val);
        {/if}
    }

    function schema_assign_yes(){
        $("#slot_manage_copy_multiple").toggle();
    }
    
    function getAvailableEmployees(method){
        if(method == 1){
            var slot_from = time_to_sixty('{$this_slot_info.time_from}');
            var slot_to = time_to_sixty('{$this_slot_info.time_to}');
            var main_obj = { 'selected_date': '{$cur_date}',
                                'selected_customer': '{$this_slot_info.customer}',
                                'action': 'multiple_add',
                                'current_slot': { 'time_from': slot_from, 'time_to': slot_to },
                                'other_time_slots': [ ] };
            var tmp_slot_from = time_to_sixty('{$this_slot_info.time_from}');
            var tmp_slot_to = time_to_sixty('{$this_slot_info.time_to}');
            if(tmp_slot_to == 0) tmp_slot_to = 24;

            if(tmp_slot_from !== false && tmp_slot_to !== false){
                var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to };
                main_obj['other_time_slots'].push(temp_obj);
            }
            $.ajax({
                url:"{$url_path}ajax_get_avail_employees_for_a_period.php",
                type:"POST",
                dataType: 'json',
                data: main_obj,
                //data:'time_from='+slot_from+'&time_to='+slot_to+'&selected_date={$cur_date}&selected_customer={$customer.userid}',
                success:function(data){
                    $('#select_employee').html('');
                    $('#select_employee').append($('<option>').text('{$translate.select_employee}').attr('value', ''));
                    $.each(data, function(i, value) {
                        
                        $('#select_employee').append($('<option>').text(value.name).attr('value', value.username));
                    });
                }
            }).always(function(data) { 
               // uwrapLoader($(this_obj).parents('.time_slots_theme'));
            }); 
        }else if(method == 2){
            var days = "";
            for (var i = 0; i < document.frm_assign.days.length; i++) {
                if (document.frm_assign.days[i].checked)
                    days += document.frm_assign.days[i].value + '-';
            }
            if (days == '') {
                alert('select days');
            } else {
                var slot_from = time_to_sixty('{$this_slot_info.time_from}');
                var slot_to = time_to_sixty('{$this_slot_info.time_to}');
                var main_obj = { 'from_week': $('#from_wk').val(),
                                'selected_customer': '{$this_slot_info.customer}',
                                'from_option': $('#from_option').val(),
                                'to_week': $('#to_wk').val(),
                                'slot_from': slot_from,
                                'slot_to': slot_to,
                                'date': '{$cur_date}',
                                'days':days };
                var url = '{$url_data}';
                $.ajax({
                url:"{$url_path}ajax_alloc_available_employees.php",
                type:"POST",
                dataType: 'json',
                data: main_obj,
                //data:'time_from='+slot_from+'&time_to='+slot_to+'&selected_date={$cur_date}&selected_customer={$customer.userid}',
                    success:function(data){
                        $('#select_employee').html('');
                        $('#select_employee').append($('<option>').text('{$translate.select_employee}').attr('value', ''));
                        $.each(data, function(i, value) {
                            $('#select_employee').append($('<option>').text(value.name).attr('value', value.username));
                        });
                    }
                }).always(function(data) { 
                   // uwrapLoader($(this_obj).parents('.time_slots_theme'));
                }); 
//                var additional_urldata = url + '&from_week=' + $('#from_wk').val() + '&from_option=' + $('#from_option').val() + '&to_week=' + $('#to_wk').val() + '&days=' + days;
//                var dnt_chk = $('input:checkbox:checked#dnt_show_again').val();
//                var dnt_chk_val = 0;
//                if(dnt_chk) dnt_chk_val = 1;
//                var full_url = '{$url_path|cat:'ajax_alloc_available_employees.php?'}' + additional_urldata;
            }
        }
    }

</script>
{/block}

{block name='content'}
<div id="status_msg">{$message}</div>
<div id="assign_multiple_save"></div>
<input type="hidden" id="schema_delete_process_status" value="0" />
<div style="border: 1px solid #DCDCDC; background: none repeat scroll 0 0 #FFFFFF; margin: 5px 4px;">
    {if $this_slot_info|count gt 0}
        <div class="popup_time_slot_hold clearfix {if $this_slot_info.status eq 1}popup_time_slot_hold_complete{else}popup_time_slot_hold_incomplete{/if}">
            <div class="ptsh_hold_left">
                <div class="ptsh_time {if $this_slot_info.status eq 1}ptsh_time_complete{else}ptsh_time_incomplete{/if}">{$this_slot_info.time_from|cat:'-'|cat:$this_slot_info.time_to} ({$this_slot_info.slot_hour})</div>
                <div class="sprite_alloc_popup_icons {if $this_slot_info.fkkn eq 1}ptsh_fk{else if $this_slot_info.fkkn eq 2}ptsh_kn{else if $this_slot_info.fkkn eq 3}ptsh_tu{/if}"></div>
            </div>
            <div class="ptsh_hold_center">
                <div class="ptsh_en">{if $this_slot_info.employee neq ''}{$this_slot_info.emp_name}{else}{$translate.no_employee}{/if}</div>
                <div class="ptsh_wn">{if $this_slot_info.customer neq ''}{$this_slot_info.cust_name}{else}{$translate.no_customer}{/if}</div>
            </div>     
            <div class="ptsh_hold_right">
                <div class="ptsh_time_icons 
                        {if $this_slot_info.type == 1}travel
                        {else if $this_slot_info.type == 0}work
                        {else if $this_slot_info.type == 2}lunch
                        {else if $this_slot_info.type == 3}oncall
                        {else if $this_slot_info.type == 4}overtime
                        {else if $this_slot_info.type == 5}qual_overtime
                        {else if $this_slot_info.type == 6}more_time
                        {else if $this_slot_info.type == 7}some_other_time
                        {else if $this_slot_info.type == 8}training_time
                        {else if $this_slot_info.type == 9}call_training
                        {else if $this_slot_info.type == 10}personal_meeting
                        {else if $this_slot_info.type == 11}voluntary
                        {else if $this_slot_info.type == 12}complementary
                        {else if $this_slot_info.type == 13}complementary_oncall
                        {else if $this_slot_info.type == 14}more_oncall{/if}" 
                    title={if $this_slot_info.type == 1}{$translate.travel}
                        {else if $this_slot_info.type == 0}{$translate.normal}
                        {else if $this_slot_info.type == 2}{$translate.break}
                        {else if $this_slot_info.type == 3}{$translate.oncall}
                        {else if $this_slot_info.type == 4}{$translate.overtime}
                        {else if $this_slot_info.type == 5}{$translate.qual_overtime}
                        {else if $this_slot_info.type == 6}{$translate.more_time}
                        {else if $this_slot_info.type == 7}{$translate.some_other_time}
                        {else if $this_slot_info.type == 8}{$translate.training_time}
                        {else if $this_slot_info.type == 9}{$translate.call_training}
                        {else if $this_slot_info.type == 10}{$translate.personal_meeting}
                        {else if $this_slot_info.type == 11}{$translate.voluntary}
                        {else if $this_slot_info.type == 12}{$translate.complementary}
                        {else if $this_slot_info.type == 13}{$translate.complementary_oncall}
                        {else if $this_slot_info.type == 14}{$translate.more_oncall}{/if}><!--clock--></div>
            </div>

        </div>
    {/if}
    {if $multiple_slot_input_flag}
        <div class="message" style="margin:auto;">{$translate.and_more_slots_found}</div>
    {/if}
</div>
<div class="clearfix" style="border: 1px solid #DCDCDC; background: none repeat scroll 0 0 #FFFFFF; margin: 5px 4px;">
    <div id="dialog-confirm-schema-assignment" title="{$translate.confirm}" style="padding-top: 20px;padding-left: 13px; margin-bottom: 5px;">
        <p><span class='error_msg_icon' style="display: block;float: left;margin-bottom: 32px"></span><span style="display: block;float: left">{$translate.do_you_want_schema_assignment}</span></p>
    </div>
    <div class="clearfix" id="cancel_button_div" style="height:38px;margin-bottom: 5px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="schema_assign_no();" href="javascript:void(0)">{$translate.no}</a>
        <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;" onclick="schema_assign_yes();" href="javascript:void(0)">{$translate.yes}</a>
    </div>
</div>
<div id="slot_manage_copy_multiple" style="display: none;" class="assign_multi_week_op_div">
    <fieldset style="margin: 0 9px 7px; padding-top: 7px; width: auto;"><legend style="font-weight: bold;">{$translate.assign_multiple_slots}</legend>
        <form name="frm_assign" id="frm_assign" method="post">
            <div class="title_strip">
                {$translate.employee}:{if $sort_by_name == 1}{$assign_employee_details.first_name|cat: ' '|cat:$assign_employee_details.last_name}{elseif $sort_by_name == 2}{$assign_employee_details.first_name|cat: ' '|cat:$assign_employee_details.last_name}{/if}
                <div style="float:right;padding-top: 1px;">V{$cur_week}:&nbsp;{$cur_day}&nbsp;{$cur_date}</div>
            </div>
           {if $this_slot_info.employee == ''} 
               <div id="select_employee_div">
                    <select id="select_employee"></select>
                </div>
           {/if}
            <div id="radio">
                <label><input type="checkbox" class="check_days" name="days" value="1" {if $cur_day_figure eq 1}checked="checked"{/if}/>{$translate.mon}</label>
                <label><input type="checkbox" class="check_days" name="days" value="2" {if $cur_day_figure eq 2}checked="checked"{/if}/>{$translate.tue}</label>
                <label><input type="checkbox" class="check_days" name="days" value="3" {if $cur_day_figure eq 3}checked="checked"{/if}/>{$translate.wed}</label>
                <label><input type="checkbox" class="check_days" name="days" value="4" {if $cur_day_figure eq 4}checked="checked"{/if}/>{$translate.thu}</label>
                <label><input type="checkbox" class="check_days" name="days" value="5" {if $cur_day_figure eq 5}checked="checked"{/if}/>{$translate.fri}</label>
                <label><input type="checkbox" class="check_days" name="days" value="6" {if $cur_day_figure eq 6}checked="checked"{/if}/>{$translate.sat}</label>
                <label><input type="checkbox" class="check_days" name="days" value="0" {if $cur_day_figure eq 0}checked="checked"{/if}/>{$translate.sun}</label>
            </div>

            <div class="from_to_week">
                <div>
                    {$translate.from_week}
                    <select class="frm_wk_selct" id="from_wk" onchange="getAfterDates()">
                        {section name=week start={$cur_week} loop={$no_of_weeks+1} step=1}
                            <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>
                        {/section}
                    </select>
                    <select name="from_option" id="from_option" onchange="getAfterDates()">
                        <option value="0">{$translate.every_week}</option>
                        <option value="1">{$translate.every_2}</option>
                        <option value="2">{$translate.every_3}</option>
                        <option value="3">{$translate.every_4}</option>
                    </select>
                    {$translate.copy_to}
                    <select name="to_wk" id="to_wk" onchange="getAvailableEmployees(2)"></select>
                </div>
            </div>
            <div style="clear:both; text-align:center; margin-top: 10px; float: right;">
                <a style="margin-right: 10px;width: 63px;padding: 3px 0px 0px 0px;height: 20px" href="javascript:void(0);" onclick="{if $action eq 'man_slot_entry'}save_schema_man_entry(){else}save_schema_assign(){/if}" class="alocation_lvbtn">{$translate.assign}</a>
                <a style="width: 63px;padding: 3px 0px 0px 0px;height: 20px"href="javascript:void(0);" onclick="op_close()" class="alocation_lvbtn">{$translate.close}</a>
            </div>
        </form>
    </fieldset>
</div>           
<div style="border: 1px solid #DCDCDC; background: none repeat scroll 0 0 #FFFFFF; margin: 1px 4px;">
    <div id="show_again" style="padding-top: 5px;padding-left: 13px; margin-bottom: 5px;">
        <p><span style='vertical-align: middle;'><input type="checkbox" id="dnt_show_again" value="1" /></span><label for="dnt_show_again" style='margin-left: 5px;'>{$translate.dont_show_again}</label></p>
    </div>
</div>
{/block}