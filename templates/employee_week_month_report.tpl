{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}    
{block name="script"}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("input:radio[name=print_method]").click(function() {
        var value = $(this).val();
        $("#print_method_input").val(value);
    });
    /*$( "#start_date, #end_date" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            showWeek: true,
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
    });*/
    $( ".datepicker" ).datepicker({
            autoclose: true,
            calendarWeeks: true,
            weekStart: 1
    });
    
    
    
});
function exceldownload(){
    if($("#month").val() != "" && $("#cmb_year").val() != ""){
        var f = $("#employee_report");
        f.attr('target', '_BLANK');
        $('#action').val('EXCEL-PRINT');
        f.submit();
        f.attr('target', '_SELF');
        $('#action').val('');
    }
}

function printForm(){
    if($("#month").val() != "" && $("#cmb_year").val() != ""){
        var f = $("#employee_report");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
        f.attr('target', '_SELF');
        $('#action').val('');
    }
}

function typesSelectionForReport(){
    var report = new Array();
    
    if($("#normal_check").attr('checked')){
        report[0] = 1;
    }else{
        report[0] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#travel_check").attr('checked')){
        report[1] = 1;
    }else{
        report[1] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#break_check").attr('checked')){
        report[2] = 1;
    }else{
        report[2] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#oncall_check").attr('checked')){
        report[3] = 1;
    }else{
        report[3] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#overtime_check").attr('checked')){
        report[4] = 1;
    }else{
        report[4] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#quality_overtime_check").attr('checked')){
        report[5] = 1;
    }else{
        report[5] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#moretime_check").attr('checked')){
        report[6] = 1;
    }else{
        report[6] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#some_other_check").attr('checked')){
        report[7] = 1;
    }else{
        report[7] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#training_check").attr('checked')){
        report[8] = 1;
    }else{
        report[8] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#call_training_check").attr('checked')){
        report[9] = 1;
    }else{
        report[9] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#personal_meeting_check").attr('checked')){
        report[10] = 1;
    }else{
        report[10] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#voluntary_check").attr('checked')){
        report[11] = 1;
    }else{
        report[11] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#complementary_check").attr('checked')){
        report[12] = 1;
    }else{
        report[12] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#complementary_oncall_check").attr('checked')){
        report[13] = 1;
    }else{
        report[13] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#more_oncall_check").attr('checked')){
        report[14] = 1;
    }else{
        report[14] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#oncall_standby_check").attr('checked')){
        report[15] = 1;
    }else{
        report[15] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#work_for_dismissal_check").attr('checked')){
        report[16] = 1;
    }else{
        report[16] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#work_for_dismissal_oncall_check").attr('checked')){
        report[17] = 1;
    }else{
        report[17] = 0;
        $("#select_all_check").prop('checked',false);
    }
    var temp_string = "";
    for(var i=0;i <report.length;i++){
        if(i == 0){
            temp_string = report[0];
        }else{
            temp_string = temp_string+","+report[i];
        }
    }
    if(temp_string == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1')
        $("#select_all_check").prop('checked',true);
    $("#check_values").val(temp_string);
    
}



function addToCalender() {
    if($("#employee").val() != "" && $("#month").val() != "" && $("#cmb_year").val() != ""){
   
        var emp = $("#employee").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        //document.location.href  = "{$url_path}simple.php?emp="+emp+"&month="+month+"&year="+year;        
        var temp_time_zone = new Date().getTimezoneOffset()/60;
        var time_zone = temp_time_zone.toString();
        var array_tz = time_zone.split(".");
        if(array_tz[1] == '5'){
           array_tz[1] = '30';
        }
        time_zone = array_tz[0]+":"+array_tz[1];
        //alert("{$url_path}simple.php?emp="+emp+"&start_date="+start_date+"&end_date="+end_date+"&time_zone="+time_zone);
      window.open("{$url_path}simple.php?emp="+emp+"&start_date="+start_date+"&end_date="+end_date+"&time_zone="+time_zone,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=768,height=500,directories=no,location=no');
        
    }else{
        alert('{$translate.employee_not_select}');
    }
}

function select_all_types(){
    if($("#select_all_check").attr('checked')){
        $('.selected_report input:checkbox').each(function() {
            $(this).prop('checked',true)
        });
    }else{
        $('.selected_report input:checkbox').each(function() {
            $(this).prop('checked',false)
        });
    }
    typesSelectionForReport();
}
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="tbl_hd"><span class="titles_tab">{$translate.employee_monthly_report}</span>
                <a onclick="exceldownload()" href="javascript:void(0)" class="excel-print"><span class="btn_name">{$translate.btn_excel}</span></a>
                <a onclick="printForm()" href="javascript:void(0)" class="print"><span class="btn_name">{$translate.print}</span></a>
                <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
                <div style="float: right;margin: 10px 5px 0 0;">
                    <input type="radio" name="print_method" id="portrait" value="1" checked="checked" style="float: left;"/><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px">{$translate.portrait}</span>
                    <input type="radio" name="print_method" id="landscape" value="2" style="float: left;"/><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px">{$translate.landscape}</span>
                </div>
                {if $open_calender == 1 && $login_user == $emp} <a style="margin-right: 22px" onclick="addToCalender()" href="javascript:void(0)" class="upload_calender"><span class="btn_name">{$translate.upload_to_calender}</span></a>{/if}

            </div>
            <div id="timetable_slot_assign" style="display:none;"></div>  
            <div id="tble_list">
   
   
       
            <div class="option_strip span12" style="padding:0px 0px;">
    <form id="employee_report" action="" method="post">
    <input type="hidden" value="" id="action" name="action">
    <input type="hidden" value="1" id="print_method_input" name="print_method_input">
    <input type="hidden" value="{$check_values}" id="check_values" name="check_values">
        <div class="selected_report span6">
            <div class="redgarea_block span12">
                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-item_img" title="{$translate.normal}"></div>
                    <div><input name="normal_check" id="normal_check" type="checkbox" title="{$translate.normal}" value="1" onclick="typesSelectionForReport()" {if $checks[0] == 1 || $start == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-travel" title="{$translate.travel}"></div>
                    <div><input name="travel_check" id="travel_check" type="checkbox" title="{$translate.travel}" value="1" onclick="typesSelectionForReport()" {if $checks[1] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-lunch" title="{$translate.break}"></div>
                    <div><input name="break_check" id="break_check" type="checkbox" title="{$translate.break}" value="1" onclick="typesSelectionForReport()" {if $checks[2] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_oncall" title="{$translate.oncall}"></div>
                    <div><input name="oncall_check" id="oncall_check" type="checkbox" title="{$translate.oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[3] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_overtime" title="{$translate.overtime}"></div>
                    <div><input name="overtime_check" id="overtime_check" type="checkbox" title="{$translate.overtime}" value="1" onclick="typesSelectionForReport()" {if $checks[4] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_quality_overtime" title="{$translate.qual_overtime}"></div>
                    <div><input name="quality_overtime_check"id="quality_overtime_check" type="checkbox" title="{$translate.qual_overtime}" value="1" onclick="typesSelectionForReport()" {if $checks[5] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_more_overtime" title="{$translate.more_time}"></div>
                    <div><input name="moretime_check" id="moretime_check" type="checkbox" title="{$translate.more_time}" value="1" onclick="typesSelectionForReport()" {if $checks[6] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_some_other_time" title="{$translate.some_other_time}"></div>
                    <div><input name="some_other_check" id="some_other_check" type="checkbox" title="{$translate.some_other_time}" value="1" onclick="typesSelectionForReport()" {if $checks[7] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_training_org" title="{$translate.training_time}"></div>
                    <div><input name="training_check" id="training_check" type="checkbox" title="{$translate.training_time}" value="1" onclick="typesSelectionForReport()" {if $checks[8] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_caltraining" title="{$translate.call_training}"></div>
                    <div><input name="call_training_check" id="call_training_check" type="checkbox" title="{$translate.call_training}" value="1" onclick="typesSelectionForReport()" {if $checks[9] == 1}checked="checked"{/if}></div>
                </div>

                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_personalmeeting" title="{$translate.personal_meeting}" ></div>
                    <div><input name="personal_meeting_check" id="personal_meeting_check" type="checkbox" title="{$translate.personal_meeting}" value="1" onclick="typesSelectionForReport()" {if $checks[10] == 1}checked="checked"{/if}></div>
                </div>
                 <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_voluntary" title="{$translate.voluntary}" ></div>
                    <div><input name="voluntary_check" id="voluntary_check" type="checkbox" title="{$translate.voluntary}" value="1" onclick="typesSelectionForReport()" {if $checks[11] == 1}checked="checked"{/if}></div>
                </div>
                 <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_complementary" title="{$translate.complementary}" ></div>
                    <div><input name="complementary_check" id="complementary_check" type="checkbox" title="{$translate.complementary}" value="1" onclick="typesSelectionForReport()" {if $checks[12] == 1}checked="checked"{/if}></div>
                </div>
                 <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_complementary_oncall" title="{$translate.complementary_oncall}" ></div>
                    <div><input name="complementary_oncall_check" id="complementary_oncall_check" type="checkbox" title="{$translate.complementary_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[13] == 1}checked="checked"{/if}></div>
                </div>
                 <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_more_oncall" title="{$translate.more_oncall}" ></div>
                    <div><input name="more_oncall_check" id="more_oncall_check" type="checkbox" title="{$translate.more_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[14] == 1}checked="checked"{/if}></div>
                </div> 
                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_oncall_standby" title="{$translate.oncall_standby}" ></div>
                    <div><input name="oncall_standby_check" id="oncall_standby_check" type="checkbox" title="{$translate.oncall_standby}" value="1" onclick="typesSelectionForReport()" {if $checks[15] == 1}checked="checked"{/if}></div>
                </div> 
                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_dismissal" title="{$translate.work_for_dismissal}" ></div>
                    <div><input name="work_for_dismissal_check" id="work_for_dismissal_check" type="checkbox" title="{$translate.work_for_dismissal}" value="1" onclick="typesSelectionForReport()" {if $checks[16] == 1}checked="checked"{/if}></div>
                </div> 
                <div class="redgarea_icon clearfix">
                    <div class="sprite_week_report_icons sprite-ico_dismissal_oncall" title="{$translate.work_for_dismissal_oncall}" ></div>
                    <div><input name="work_for_dismissal_oncall_check" id="work_for_dismissal_oncall_check" type="checkbox" title="{$translate.work_for_dismissal_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[17] == 1}checked="checked"{/if}></div>
                </div> 
                <div class="redgarea_icon clearfix">
                    <div  title="{$translate.select_all_type}" style="margin-left: 12px;">{$translate.check}</div>
                    <div style="margin-left: 25px;"><input style="margin-top: 5px;" name="select_all_check" id="select_all_check" type="checkbox" title="{$translate.select_all_type}" value="1" onclick="select_all_types()" {if $check_values == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'}checked="checked"{/if}></div>
                </div>

            </div>
            <div class="assist span12 no-ml">
                {if $user_role != 3}{*$translate.employee*} 
                    <select name="employee" id="employee" style="width: 155px" class="pull-left mr">
                        <option value="">{$translate.select_employee}</option>
                        {foreach from=$employees item=employee}
                            <option value="{$employee.username}" {if $emp == $employee.username} selected="selected" {/if}>{if $sort_by_name == 1}{$employee.first_name} {$employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name} {$employee.first_name}{/if}</option>
                        {/foreach}
                    </select>
                {else}<input type="hidden" name="employee" value="{$employees[0].username}" id="employee" /> {/if}

                <div class="input-prepend date datepicker pull-left no-pt" id="start_date_div" style="width: 93px; float: left;">
                    <span class="add-on icon-calendar"></span>
                    <input type="text" name="start_date" id="start_date" value="{$start_date}" class="form-control span12">
                </div>
                <div class="input-prepend date datepicker pull-left no-pt" id="end_date_div" style="width: 93px; float: left;">
                    <span class="add-on icon-calendar"></span>
                    <input type="text" name="end_date" id="end_date" value="{$end_date}" class="form-control span12">
                </div>

        {*         <input type="text" name="start_date" id="start_date" value="{$start_date}" style="margin-top: 7px;width: 72px;height: 18px;"/>   *}
        {*         <input type="text" name="end_date" id="end_date" value="{$end_date}" style="margin-top: 7px; width: 72px;height: 18px;"/>   *}
                <input type="submit" name="add" value="{$translate.show}" />
                </div>
        </div>
        {*<div class="report_sepration" style="margin-left: 8px;margin-right: 6px;"><img src="{$url_path}images/line.png" width="1" height="85"  alt=""/></div>*}
        <div class="result_report span6 no-ml" style="margin-top: 5px;float:right">
            <div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">{$translate.contract_hour}</span> <span style="font-weight:bold;">{$contract_hours}</span></div>
            <div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">{$translate.worked_hour}</span> <span style="font-weight:bold;">{$time_sum}</span></div>
            <div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">{$translate.oncall_worked_hour}</span> <span style="font-weight:bold;">{$jour_time_sum}{*$oncall_worked*}</span></div>
            {*if $checks[0] eq 1*}<div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">{$translate.normal_worked_hour}</span> <span style="font-weight:bold;">{$ordinary_time_sum}</span></div>{*/if*}
        </div>
        </form>
    </div>
        

        {assign i 0}
        {foreach from=$reports item=report}
            
            <div class="row-fluid"><div class="span12"><div class="week_num">{$translate.week}{$report.week}</div></div></div>
            <div class="row-fluid">
                <div class="span12">
            <div style="overflow:auto;">
                <table  class="table_list tbl_padding_fix" style="width:100%;">
                <tr><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.mon[2]}-{$report.mon[1]}-{$report.mon[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.mon} {$report.mon[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.tue[2]}-{$report.tue[1]}-{$report.tue[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.tue} {$report.tue[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.wed[2]}-{$report.wed[1]}-{$report.wed[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.wed} {$report.wed[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.thu[2]}-{$report.thu[1]}-{$report.thu[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.thu} {$report.thu[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.fri[2]}-{$report.fri[1]}-{$report.fri[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.fri} {$report.fri[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.sat[2]}-{$report.sat[1]}-{$report.sat[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)"style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.sat} {$report.sat[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $emp != ""}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$report.sun[2]}-{$report.sun[1]}-{$report.sun[0]}&employee={$emp}&return_page=emp_report&rep_start_date={$start_date}&rep_end_date={$end_date}',1)"style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.sun} {$report.sun[0]}</a></th><th>{$translate.total}</th></tr>
                
                    <tr class="odd">  
                        
                        <td>{foreach from=$report.data.mon item=mon}
                            {assign var=man value=","|explode:$mon.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                             
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                    <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if} <br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if} <br>{$mon.customer}</div>
                                {else}
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if} <br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div> 
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}) J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if} <br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if}
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$mon.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                        <td>{foreach from=$report.data.tue item=tue}
                            {assign var=man value=","|explode:$tue.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if}
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                    <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {elseif $man[2] == "2"}
                                    <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {else}                                
                                    <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$tue.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                        <td>{foreach from=$report.data.wed item=wed}
                            {assign var=man value=","|explode:$wed.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if}
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if} 
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$wed.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                        <td>{foreach from=$report.data.thu item=thu}
                            {assign var=man value=","|explode:$thu.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if}
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$thu.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                        <td>{foreach from=$report.data.fri item=fri}
                            {assign var=man value=","|explode:$fri.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if}
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$fri.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                       <td>{foreach from=$report.data.sat item=sat}
                            {assign var=man value=","|explode:$sat.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if} 
                            {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if}
                            {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if} 
                            {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if} 
                            {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sat.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                            <td>{foreach from=$report.data.sun item=sun}
                            {assign var=man value=","|explode:$sun.time}
                            {if $sort_by_name == 1}
                                {assign temp $man[4]}
                                {assign temp2 $man[5]}
                                {$man[4] = $temp2}
                                {$man[5] = $temp}
                            {/if}
                            {if $man[1] == "0"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div> 
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "1"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "2"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "3"}
                                <!-- oncall -->
                                {if $man[2] == "1"}
                                <div class="mini_time_slot" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]})J{if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "4"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "5"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_more_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "6"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_quality_overtime" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                               
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                            {elseif $man[1] == "7"}
                                {if $man[2] == "1"}
                                <div class="mini_time_slot_some_other_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "8"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "9"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "10"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "11"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "12"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "13"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_training_time" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "14"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if}
                             {elseif $man[1] == "15"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if} 
                             {elseif $man[1] == "16"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if} 
                             {elseif $man[1] == "17"}
                                {if $man[2] == "1"}
                                 <div class="mini_time_slot_more_oncall" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {elseif $man[2] == "2"}
                                <div class="mini_time_slot_leave" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {else}                                
                                <div class="mini_time_slot_unassign" >{$man[0]}({$man[3]}){if $emp == ''}<br>{if $man[4] != ''}{$man[4]} {$man[5]}{else}{$translate.no_employee}{/if}{/if}<br>{$sun.customer}</div>
                                {/if} 
                            {/if}
                            {foreachelse}
                                <div style="width: 110px;"></div>
                            {/foreach}</td>
                            <th>{if $report.data.sum != "" || $report.data.sum != ".00"}{$report.data.sum}{else} 0.00 {/if}</th> </tr>
                
                            <tr><th>{$sums[$i]['mon']}</th><th>{$sums[$i]['tue']}</th><th>{$sums[$i]['wed']}</th><th>{$sums[$i]['thu']}</th><th>{$sums[$i]['fri']}</th><th>{$sums[$i]['sat']}</th><th>{$sums[$i]['sun']}</th><th></th></tr>
                              {assign i $i+1}
            </table>
             </div>  
            </div>
            </div>
           <br />
           
        {/foreach}
        </div>
        </div>
        </div>
 
{/block}