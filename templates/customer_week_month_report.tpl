{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}
{block name="script"}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    function printForm(){
        if(/*$("#customer").val() != "" && */$("#start_date").val() != "" && $("#end_date").val() != ""){
            //        var f = $("#customer_report");
            //        f.attr('target', '_BLANK');
            //        $('#action').val('print');
            //        f.submit();
            //        f.attr('target', '_SELF');
            //        $('#action').val('');
            var start_date= $("#start_date").val();
            var end_date= $("#end_date").val();
            var customer= $("#customer").val();
            var method_print= $("#print_method_input").val();
            var check_values= $("#check_values").val();
            if(customer == '')
                customer = '-';
            //        alert(month + ' ' + year + ' ' + customer);
            window.open('{$url_path}report/month/week/customer/'+customer+'/'+start_date+'/'+end_date+'/'+method_print+'/'+check_values+'/');
        }
    }

    function exceldownload(){
        if($("#start_date").val() != "" && $("#end_date").val() != ""){
            var start_date= $("#start_date").val();
            var end_date= $("#end_date").val();
            var customer= $("#customer").val();
            var method_print= 'EXCEL';
            var check_values= $("#check_values").val();
            if(customer == '')
                customer = '-';
            window.open('{$url_path}report/month/week/customer/'+customer+'/'+start_date+'/'+end_date+'/'+method_print+'/'+check_values+'/');
        }
    }
    
$(document).ready(function(){
    $("input:radio[name=print_method]").click(function() {
        var value = $(this).val();
        $("#print_method_input").val(value);
    });
    
    /*$( "#start_date, #end_date" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
    });*/
    $( ".datepicker" ).datepicker({
            autoclose: true,
            calendarWeeks: true,
            weekStart: 1
    });
});
   /* $(document).ready(function(event)
    {
         event.preventDefault() 
    });*/

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
            <div class="tbl_hd"><span class="titles_tab">{$translate.customer_monthly_report}</span>
                <a onclick="exceldownload()" href="javascript:void(0)" class="excel-print"><span class="btn_name">{$translate.btn_excel}</span></a>
                <a onclick="printForm()" href="javascript:void(0)" class="print"><span class="btn_name">{$translate.print}</span></a>
                <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
                <div style="float: right;margin: 10px 5px 0 0;">
                    <input type="radio" name="print_method" id="portrait" value="1" checked="checked" style="float: left;" /><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px">{$translate.portrait}</span>
                    <input type="radio" name="print_method" id="landscape" value="2" style="float: left;"/><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px">{$translate.landscape}</span>
                </div>
            </div>

            <div id="tble_list">
                <div class="row-fluid">
                    <div class="option_strip span12" style="padding:0px 0px;">
                        <form id="employee_report" action="" method="post">
                            <input type="hidden" value="" id="action" name="action">
                            <input type="hidden" value="1" id="print_method_input" name="print_method_input">
                            <input type="hidden" value="{$check_values}" id="check_values" name="check_values">
                            <div class="selected_report span6">
                                <div class="redgarea_block span12">
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-item_img" title="{$translate.normal}"></div>
                                        <div ><input name="normal_check" id="normal_check" type="checkbox" title="{$translate.normal}" value="1" onclick="typesSelectionForReport()" {if $checks[0] == 1 || $start == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-travel" title="{$translate.travel}"></div>
                                        <div ><input name="travel_check" id="travel_check" type="checkbox" title="{$translate.travel}" value="1" onclick="typesSelectionForReport()" {if $checks[1] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-lunch" title="{$translate.break}"></div>
                                        <div ><input name="break_check" id="break_check" type="checkbox" title="{$translate.break}" value="1" onclick="typesSelectionForReport()" {if $checks[2] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_oncall" title="{$translate.oncall}"></div>
                                        <div ><input name="oncall_check" id="oncall_check" type="checkbox" title="{$translate.oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[3] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_overtime" title="{$translate.overtime}"></div>
                                        <div ><input name="overtime_check" id="overtime_check" type="checkbox" title="{$translate.overtime}" value="1" onclick="typesSelectionForReport()" {if $checks[4] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_quality_overtime" title="{$translate.qual_overtime}"></div>
                                        <div ><input name="quality_overtime_check"id="quality_overtime_check" type="checkbox" title="{$translate.qual_overtime}" value="1" onclick="typesSelectionForReport()" {if $checks[5] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_more_overtime" title="{$translate.more_time}"></div>
                                        <div ><input name="moretime_check" id="moretime_check" type="checkbox" title="{$translate.more_time}" value="1" onclick="typesSelectionForReport()" {if $checks[6] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_some_other_time" title="{$translate.some_other_time}"></div>
                                        <div ><input name="some_other_check" id="some_other_check" type="checkbox" title="{$translate.some_other_time}" value="1" onclick="typesSelectionForReport()" {if $checks[7] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_training_org" title="{$translate.training_time}"></div>
                                        <div ><input name="training_check" id="training_check" type="checkbox" title="{$translate.training_time}" value="1" onclick="typesSelectionForReport()" {if $checks[8] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_caltraining" title="{$translate.call_training}"></div>
                                        <div ><input name="call_training_check" id="call_training_check" type="checkbox" title="{$translate.call_training}" value="1" onclick="typesSelectionForReport()" {if $checks[9] == 1}checked="checked"{/if}></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_personalmeeting" title="{$translate.personal_meeting}" ></div>
                                        <div ><input name="personal_meeting_check" id="personal_meeting_check" type="checkbox" title="{$translate.personal_meeting}" value="1" onclick="typesSelectionForReport()" {if $checks[10] == 1}checked="checked"{/if}></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_voluntary" title="{$translate.voluntary}" ></div>
                                        <div ><input name="voluntary_check" id="voluntary_check" type="checkbox" title="{$translate.voluntary}" value="1" onclick="typesSelectionForReport()" {if $checks[11] == 1}checked="checked"{/if}></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_complementary" title="{$translate.complementary}" ></div>
                                        <div ><input name="complementary_check" id="complementary_check" type="checkbox" title="{$translate.complementary}" value="1" onclick="typesSelectionForReport()" {if $checks[12] == 1}checked="checked"{/if}></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_complementary_oncall" title="{$translate.complementary_oncall}" ></div>
                                        <div ><input name="complementary_oncall_check" id="complementary_oncall_check" type="checkbox" title="{$translate.complementary_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[13] == 1}checked="checked"{/if}></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_more_oncall" title="{$translate.more_oncall}" ></div>
                                        <div ><input name="more_oncall_check" id="more_oncall_check" type="checkbox" title="{$translate.more_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[14] == 1}checked="checked"{/if}></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_oncall_standby" title="{$translate.oncall_standby}" ></div>
                                        <div ><input name="oncall_standby_check" id="oncall_standby_check" type="checkbox" title="{$translate.oncall_standby}" value="1" onclick="typesSelectionForReport()" {if $checks[15] == 1}checked="checked"{/if}></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_dismissal" title="{$translate.work_for_dismissal}" ></div>
                                        <div><input name="work_for_dismissal_check" id="work_for_dismissal_check" type="checkbox" title="{$translate.work_for_dismissal}" value="1" onclick="typesSelectionForReport()" {if $checks[16] == 1}checked="checked"{/if}></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_dismissal_oncall" title="{$translate.work_for_dismissal_oncall}" ></div>
                                        <div><input name="work_for_dismissal_oncall_check" id="work_for_dismissal_oncall_check" type="checkbox" title="{$translate.work_for_dismissal_oncall}" value="1" onclick="typesSelectionForReport()" {if $checks[17] == 1}checked="checked"{/if}></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div style="margin-left: 0px;" title="{$translate.select_all_type}" >{$translate.check}</div>
                                        <div  style="margin-left: 8px;"><input style="margin-top: 5px;" name="select_all_check" id="select_all_check" type="checkbox" title="{$translate.select_all_type}" value="1" onclick="select_all_types()" {if $check_values == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'}checked="checked"{/if}></div>
                                    </div>

                                </div>
                                <div class="assist span12 no-ml">
                                    {if $user_role != 4}
                                        <select name="customer" id="customer" style="width: 155px" class="pull-left mr">
                                            <option value="">{$translate.select_customer}</option>
                                            {foreach from=$customers item=customer}
                                                <option value="{$customer.username}" {if $cust == $customer.username} selected="selected" {/if}>{if $sort_by_name == 1}{$customer.first_name} {$customer.last_name}{elseif $sort_by_name == 2}{$customer.last_name} {$customer.first_name}{/if}</option>
                                            {/foreach}
                                        </select>
                                    {else}
                                        <input type="hidden" name="customer" id="customer" value="{$cust}"/>
                                    {/if}

                                    <div class="input-prepend date datepicker pull-left no-pt" id="start_date_div" style="width: 93px; float: left;">
                                        <span class="add-on icon-calendar"></span>
                                        <input type="text" name="start_date" id="start_date" value="{$start_date}" class="form-control span12">
                                    </div>
                                    <div class="input-prepend date datepicker pull-left no-pt" id="end_date_div" style="width: 93px; float: left;">
                                        <span class="add-on icon-calendar"></span>
                                        <input type="text" name="end_date" id="end_date" value="{$end_date}" class="form-control span12">
                                    </div>
                                    {*        <input type="text" name="start_date" id="start_date" value="{$start_date}" style="width: 72px;height: 18px; margin-bottom: 0px;"/>   *}
                                    {*         <input type="text" name="end_date" id="end_date" value="{$end_date}" style="width: 72px;height: 18px;margin-bottom: 0px;"/>    *}
                                    <input type="submit" name="add" value="{$translate.show}" />
                                </div>
                            </div>
                            <div class="result_report span6 no-ml" style="margin-top: 5px; float: right;">
                                <!--<div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;"></span> <span style="font-weight:bold;">{$contract_hours}</span></div>-->
                                <div class="reportemploye_contactlft" style="margin-right: 3px;">
                                    <span>{$translate.contract_hour}</span>
                                    <div class="fk_kn" style="width: 100px">
                                        <div style="height:25px; padding-left:11px; border-bottom:1px solid #E4E4E4;">
                                            <span>FK</span><span style="font-weight:bold;">{$contract_fk}</span>
                                        </div> 
                                        <div style="height:25px; padding-left:11px;">
                                            <span>KN</span><span style="font-weight:bold;">{$contract_kn}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">Worked Hours</span> <span style="font-weight:bold;">{$time_sum}</span></div>-->
                                <div class="reportemploye_contactlft">
                                    <span>{$translate.worked_hour}</span>
                                    <div class="fk_kn" style="width: 100px">
                                        <div style="height:25px; padding-left:11px; border-bottom:1px solid #E4E4E4;">
                                            <span>FK</span><span style="font-weight:bold;">{$time_fk}</span>
                                        </div> 
                                        <div style="height:25px; padding-left:11px;">
                                            <span>KN</span><span style="font-weight:bold;">{$time_kn}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                        
                {assign i 0}
                {assign j 0}
                {foreach from=$reports item=report}

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="week_num">{$translate.week} {$report.week}</div>
                            <!--<div id="div_fix_{$j}" {if $scroll_lengths[$j]['sum'] <= 5}style="overflow-x: hidden; overflow-y: hidden" {else}style="overflow-x: scroll; overflow-y: hidden" {/if}>-->
                            <div id="div_fix_{$j}">
                                {assign j $j+1}
                                <table  class="table_list tbl_padding_fix" style="width: 100%;">
                                    {assign sun_sum 0.0}
                                    {assign sun_mon 0.0}
                                    {assign sun_tue 0.0}
                                    {assign sun_wed 0.0}
                                    {assign sun_thu 0.0}
                                    {assign sun_fri 0.0}
                                    {assign sun_sat 0.0}
                                    <tr><th width="110px">{$translate.employee}</th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.mon[2]}-{$report.mon[1]}-{$report.mon[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.mon}  {$report.mon[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.tue[2]}-{$report.tue[1]}-{$report.tue[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.tue}  {$report.tue[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.wed[2]}-{$report.wed[1]}-{$report.wed[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.wed}  {$report.wed[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''} onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.thu[2]}-{$report.thu[1]}-{$report.thu[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.thu}  {$report.thu[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.fri[2]}-{$report.fri[1]}-{$report.fri[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.fri}  {$report.fri[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.sat[2]}-{$report.sat[1]}-{$report.sat[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.sat}  {$report.sat[0]}</a></th><th width="110px"><a href="javascript:void(0);" {if $cust != ''}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$report.sun[2]}-{$report.sun[1]}-{$report.sun[0]}&customer={$cust}&return_page=cust_report&rep_start_date={$start_date}&rep_end_date={$end_date}', 1)" style="text-decoration: underline" title="{$translate.go_to_slots}"{/if}>{$translate.sun}  {$report.sun[0]}</a></th><th width="80px">{$translate.total}</th></tr>
                                    {* manned slots *}
                                    {foreach from=$report.employee item=emp}
                                        <tr class="odd"> 
                                            <td style="padding-left: 5px;border-left:3px solid {$emp.color};">{$emp.name}</td>
                                            <td>
                                                {foreach from=$emp.Mon item=mon}
                                                    {assign var=man value=","|explode:$mon}
                                                    {if $sort_by_name == 1}
                                                        {assign temp $man[5]}
                                                        {assign temp2 $man[6]}
                                                        {$man[5] = $temp2}
                                                        {$man[6] = $temp}
                                                    {/if}
                                                    {if $man[1] == "0"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;" > {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}  </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_more_time"  style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "8"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if} 
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                    {/if}
                                                {foreachelse}
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                {/foreach}
                                            </td>
                                            <td>{foreach from=$emp.Tue item=tue}
                                                {assign var=man value=","|explode:$tue}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_tue $sun_tue+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign row $row+$man[0]}{assign var=time value="-"|explode:$man[0]} {assign sun_tue $sun_tue+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign row $row+$man[0]}{assign var=time value="-"|explode:$man[0]} {assign sun_tue $sun_tue+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign row $row+$man[0]}{assign var=time value="-"|explode:$man[0]} {assign sun_tue $sun_tue+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if} 
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if} 
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if} 
                                                    {/if}
                                                {foreachelse}
                                                <div   style="padding: 4px 0 4px 1px;" ></div>
                                            {/foreach}
                                        </td>
                                            <td>{foreach from=$emp.Wed item=wed}
                                                {assign var=man value=","|explode:$wed}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_wed $sun_wed+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_wed $sun_wed+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_wed $sun_wed+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_wed $sun_wed+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if} 
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {/if}
                                                {foreachelse}
                                                <div   style="padding: 4px 0 4px 1px;" ></div>
                                            {/foreach}
                                        </td>
                                            <td>{foreach from=$emp.Thu item=thu}
                                                {assign var=man value=","|explode:$thu}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_thu $sun_thu+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_thu $sun_thu+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_thu $sun_thu+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_thu $sun_thu+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {/if}
                                                    {foreachelse}
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    {/foreach}
                                            </td>
                                            <td>{foreach from=$emp.Fri item=fri}
                                                {assign var=man value=","|explode:$fri}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_fri $sun_fri+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_fri $sun_fri+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_fri $sun_fri+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_fri $sun_fri+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {/if}
                                                    {foreachelse}
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    {/foreach}
                                            </td>
                                            <td>{foreach from=$emp.Sat item=sat}
                                                {assign var=man value=","|explode:$sat}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sat $sun_sat+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sat $sun_sat+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sat $sun_sat+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_sat $sun_sat+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {/if}
                                                    {foreachelse}
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    {/foreach}
                                                </td>
                                            <td>{foreach from=$emp.Sun item=sun}
                                                {assign var=man value=","|explode:$sun}
                                                {if $sort_by_name == 1}
                                                    {assign temp $man[5]}
                                                    {assign temp2 $man[6]}
                                                    {$man[5] = $temp2}
                                                    {$man[6] = $temp}
                                                {/if}
                                                {if $man[1] == "0"}
                                                    {if $man[2] == "1"}
                                                        <div class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if}</div>{assign var=time value="-"|explode:$man[0]} {assign sun_sun $sun_sun+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "1"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sun $sun_sun+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "2"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sun $sun_sun+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "3"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J{if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{assign var=time value="-"|explode:$man[0]} {assign sun_sun $sun_sun+($time[1]-$time[0])}
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                    {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]} {/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "4"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "5"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "6"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "7"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}

                                                {elseif $man[1] == "8"}
                                                    {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "9"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "10"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "11"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "12"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "13"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "14"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "15"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "16"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {elseif $man[1] == "17"}
                                                        {if $man[2] == "1"}
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {elseif $man[2] == "2"}
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {else}
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                        {/if}
                                                    {/if}
                                                    {foreachelse}
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    {/foreach}</td>
                                            <th>{$emp.sum}</th>
                                        </tr>
                                    {/foreach}

                                    {* unmanned slots *}
                                    {if isset($report.unmanned) and !empty($report.unmanned)}
                                        <tr class="odd"> 
                                            <td style="padding-left: 5px;">{$translate.unmanned}</td>
                                            {foreach from=['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] item=day_name}
                                                <td>
                                                    {if isset($report.unmanned.$day_name) and !empty($report.unmanned.$day_name)}
                                                        {foreach from=$report.unmanned.$day_name item=mon}
                                                            {assign var=man value=","|explode:$mon}
                                                            {if $sort_by_name == 1}
                                                                {assign temp $man[5]}
                                                                {assign temp2 $man[6]}
                                                                {$man[5] = $temp2}
                                                                {$man[6] = $temp}
                                                            {/if}
                                                            {if $man[1] == "0"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;" > {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "1"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "2"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "3"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if}  </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}) J {if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "4"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "5"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_more_time"  style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "6"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "7"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "8"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "9"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;">{$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "10"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if} 
                                                            {elseif $man[1] == "11"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "12"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "13"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "14"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "15"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "16"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {elseif $man[1] == "17"}
                                                                {if $man[2] == "1"}<div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {elseif $man[2] == "2"}<div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>
                                                                {else}<div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> {$man[0]}({$man[3]}){if $cust == ''}<br>{$man[5]} {$man[6]}{/if} </div>{/if}
                                                            {/if}
                                                        {foreachelse}
                                                            <div   style="padding: 4px 0 4px 1px;" ></div>
                                                        {/foreach}
                                                    {else}
                                                        <div style="padding: 4px 0 4px 1px;" ></div>
                                                    {/if}
                                                </td>
                                            {/foreach}
                                            
                                            <th>{$report.unmanned.sum}</th>
                                        </tr>
                                    {/if}
                                    <tr>
                                        <th>{$translate.total}</th>
                                        <th>{$sums[$i]['mon']}</th>
                                        <th>{$sums[$i]['tue']}</th>
                                        <th>{$sums[$i]['wed']}</th>
                                        <th>{$sums[$i]['thu']}</th>
                                        <th>{$sums[$i]['fri']}</th>
                                        <th>{$sums[$i]['sat']}</th>
                                        <th>{$sums[$i]['sun']}</th>
                                        <th>{sprintf('%.02f', round($sums[$i]['mon']+$sums[$i]['tue']+$sums[$i]['wed']+$sums[$i]['thu']+$sums[$i]['fri']+$sums[$i]['sat']+$sums[$i]['sun'], 2))}</th>
                                    </tr>
                                    {assign i $i+1}
                                </table>
                            </div>
                        </div>
                    </div>    
                    <br>
                {/foreach}
            </div>
        </div>
    </div>
{/block}
