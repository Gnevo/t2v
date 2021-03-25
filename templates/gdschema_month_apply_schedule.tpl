{block name='style'}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" href="{$url_path}css/contextMenu.css" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/print.css" type="text/css" />
    <style type="text/css">
        .cursor_hand{ cursor: pointer; }
        .font-bold{ font-weight:bold; }
        .col_numeric{ text-align: right; }
        .col_left_align{ text-align: left; }
        .overflow_contract { color: red; }
        .underflow_contract { color: blue; }
        .template_label { min-height: 0px !important;}
        #available_memory_slots .child-slots, #available_memory_slots .remove-memory-slot { cursor: pointer;}
        #right_click_action_options .panel-title { margin-bottom: 0px !important; border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;}
        .time_slots_theme .close_btn_wrpr{ height: 13px;position: relative;right: -5px;top: -14px;}
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-leave,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-candg,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-candg-accept,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-pm,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-complete{ display: none;}
        .slot_bountery{ position: relative; }
        .small-icon { width: 12px;
            height: 12px !important;
            position: absolute;
            right: 0;
            bottom: 0;
            background-size: 27px !important;
            background-position: 0 -103px !important;}

        @media screen and (max-width: 767px){ 

         .small-icon { width: 7px;
min-height: 1px !important;
background-size: 20px !important;
background-position: 0px -75px !important;
right: 1px;
bottom: 0px; }

            .table-responsive { height: auto !important; }
            .slot { font-size: 6px; }
            .slot-calender thead th:first-child { /*display: none !important;*/ }
            .notification-info-customer {
                white-space: normal !important; margin-left: 0 !important; text-overflow:clip !important; overflow: hidden !important;line-height: 8px;
            }
            .table-responsive-clear { width: 100% !important; overflow: hidden !important;  }
            .scroll_tabs_container div.scroll_tab_inner span {
                padding-left: 1%;
                padding-right: 1%;
                font-size: 10px !important;
            }
            .hj { white-space:pre-wrap ; word-wrap:break-word; }
            .visibility-hidden { visibility: hidden; }
            .week-slot-type {
                margin: 10px 0 0 !important;
            }
            .visible-only-small-devices { display: block !important; }
            .hide-small-devices { display: none !important; }
            .text-limit-small-devices {  white-space: nowrap; 
                                         width: 20px;   font-size: 5px; 
                                         overflow: hidden;
                                         text-overflow: ellipsis; }
            .spn-slot-emp-name{ width: 80%; float: left;}
        }

        .week-slottype-employe {  position: relative; overflow: hidden;}
        .visible-only-small-devices { display: none ; }
        .spn-slot-emp-name{ width: 100%;}
        @media print{
            /*#schedule_det{ width: 100% !important; }*/
            /*#schedule_det .template-customize-wrpr{ background-color: yellow !important; }*/
            .table-responsive { height: auto !important;  }
            .table-responsive-clear {
                 width: 100% !important; 
                 overflow: visible !important; 
                 display:table !important;
                table-layout:auto !important;
            }
            .main-left { width: 100% !important; height: auto; overflow: visible !important; display:table !important;
                table-layout:auto !important; }
            /*#navigation-main-table, .fixed-scrolling-tbl { width: 100% !important; }*/
            .spn-slot-emp-name {
                width: 80% !important;
                float: left;
            }
            .slot {
                /*font-size: 6px;*/
            }
            #schedule_det, body
            {
                display:table !important;
                table-layout:auto !important;
                /*padding-top:2.5cm;*/
                /*padding-bottom:2.5cm;*/
                height:auto;
                width: 98% !important;
                /*margin: -.5in; */
                /*mso-header-margin:.1in; */
                /*mso-footer-margin:.1in; */
            }
            #monthlyviewtbl, .slot-calender { width: 100% !important; display:table !important; table-layout:auto !important; min-width: 50px; }
            /*#monthlyviewtbl td.monthly_day { width: 60px !important;  }*/
            .slot-calender colgroup, #monthlyviewtbl colgroup { display: none;}
            .slot-calender td.week_no_td, #monthlyviewtbl td.week_no_td { width: 30px !important;}
            /*.floatThead-container { display: none; }*/
            .table { table-layout:auto !important; }
        }
        #count-info-switch .tu-marker i{ display: block; vertical-align: middle; top: 5px; position: relative; line-height: 2px; }
        #count-info-switch .tu-marker i:before{ color: red; font-size: 10px; }
        #approve_leave_on_apply{
            padding: 5px;
            background: #ffeded;
            border: solid 1px #ffc8c8 !important;
            max-width: 100%;
            color: red;
            margin: 13px 0 5px 0 !important;
        }
        #approve_leave_on_apply label{
            color: #dc7c7c;
        }
    </style>
{/block}

{block name="content"}
{if $flag_cust_access eq 1}
    <div class="row-fluid" id="gdmonth_wraper">
        
{*        main-left*}
        <div class="span12 main-left">
            <div id="div_alloc_action" class='hide'></div>
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">{$message}</div>
            <div id="schedule_det">
            <div class="row-fluid theme-add-wrpr">
                <div class="span12 template-customize-wrpr" style="margin-bottom:10px;">
                    <div style="" class="panel panel-default">
                        <div style="" class="panel-heading">
                            <h4  class="panel-title clearfix">
                                {$translate.template_view}
                                <ul class="pull-right no-print">
{*                                    <li onclick="reload_content();"><span class="icon-refresh"></span><a href="javascript:void(0);"><span>{$translate.refresh}</span></a></li>*}
                                    <li onclick="navigatePage('{$url_path}month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/',1);"><i class="icon-arrow-left"></i><a href="javascript:void(0);"><span>{$translate.back}</span></a></li>
                                    {if $privileges_general.create_template eq 1}
                                        <li onclick="delete_template();"><i class="icon-trash "></i></span><a href="javascript:void(0);"><span>{$translate.delete_template}</span></a></li>
                                    {/if}
                                    <li onclick="printSchedule();"><i class="icon-print"></i><a href="javascript:void(0);"><span>{$translate.print}</span></a></li>
                                    <li onclick="conformScheduleSave()"><i class=" icon-save "></i></span><a href="javascript:void(0);"><span>{$translate.apply_template}</span></a></li>
                                </ul>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="span12 option-panel-wrpr" style="margin-left: 0px;">
                    <div style="margin-top: 0px; margin-bottom: 10px;" class="widget">
                        <div class="widget-body" style="padding:9px 5px">
                            <div class="row-fluid">
                                <div class="span12" style="margin-left: 1.49254%; margin-bottom: 4px;">
                                    {$translate.customer}: <b>{$customer_details.last_name|cat:' '|cat:$customer_details.first_name}</b>
                                </div>
                                <div class="span12 no-print">
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="cmb_template_name">{$translate.select_template}</label>
                                        <select class="span12" id="cmb_template_name" name="cmb_template_name">
                                            <option value="">{$translate.select}</option>
                                            {foreach $customer_schedules as $schedule}
                                                <option value="{$schedule.tid}" {if $schedule.tid eq $selected_schedule}selected='selected'{/if}>{$schedule.temp_name|stripslashes}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="templatePrvStartDate">{$translate.copy_start_date}</label>
                                        <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11" id="templatePrvStartDate" value="{$template_start_date}" name="templatePrvStartDate" type="text" />
                                        </div>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="cmb_no_of_times">{$translate.no_of_times}</label>
                                        <select class="span12" id="cmb_no_of_times" name="cmb_no_of_times">
                                            <option value="">{$translate.select}</option>
                                            {for $mIndex=1 to 5}
                                                <option value="{$mIndex}" {if $no_of_times eq $mIndex}selected='selected'{/if}>{$mIndex}</option>
                                            {/for}
                                        </select>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label">&nbsp;</label>
                                        <button type="button" class="btn btn-success" onclick="applySchedule()"><span class="icon-save"></span> {$translate.preview_template}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                    
            <!-- Table -->
            <div class="row-fluid">
                <div class="span12">
                    <table style="margin:0;" class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th class="table-col-center no-print" style="border: 0 none;"><span class="btn btn-block btn-default span12"><i class="icon-calendar monthPicker" data-date="{$selected_year|cat:'-'|cat:$selected_month}" data-date-format="yyyy-mm" ></i></span></th>
                                <th class="table-col-center no-print" style="width:30px; border: 0 none;"></th>
                                <th colspan="4" style="border:0;" class="table-col-center"><span class="btn btn-block btn-default span12 calender-month"><span class="cur_month_header" data-year-month="{$selected_year|cat:'|'|cat:$selected_month}">{$translate.{$month_label}} {$selected_year}</span></span></th>
                                <th class="table-col-center no-print" colspan="2" style="border: 0 none;"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="no-print">
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('{$url_path}schedule/month/gdschema/{$selected_year-1}/{$selected_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);"  title="{$translate.tltp_goto_previous_year}"><<</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('{$url_path}schedule/month/gdschema/{$prv_year}/{$prv_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);" title="{$translate.tltp_goto_previous_month}"><</span></th>
                                <th class="table-col-center" colspan="4"><span class="btn btn-block btn-default span12 calender-today" onclick="navigatePage('{$url_path}schedule/month/gdschema/{$today_year}/{$today_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);" title="{$translate.tltp_goto_todays_month}"><i></i>{$translate.today}</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('{$url_path}schedule/month/gdschema/{$next_year}/{$next_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);" title="{$translate.tltp_goto_next_month}">></span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('{$url_path}schedule/month/gdschema/{$selected_year+1}/{$selected_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);" title="{$translate.tltp_goto_next_year}">>></span></th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender clearfix" id="monthlyviewtbl">
                        <thead>
                            <tr class="">
                                <th  style=" width:30px; border-radius: 0px;" class="table-col-center clearfix">V</th>
                                {foreach $weeks as $week_day}
                                    <th class="table-col-center clearfix">{$translate.{$week_day.label}}</th>
                                {/foreach}
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $month_weeks as $month_week}
                                <tr class="gradeX expandable week_row "  style="height: 150px;">
                                    <td class="week_no_td" data-yearweek='{$selected_year}|{$month_week.week.week}' style="background:linear-gradient(to bottom, rgba(194, 234, 234, 1) 0%, rgba(164, 218, 221, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;">
                                        <ul class="calender-col-header span12" id="toggle-view" style="border-bottom: none; background: none;">
                                            <li title="{$translate.tltp_mini_maxi_week}"><input class="btn-mini btn-default btn-collapse-table-row no-print" type="button" value="-" /></li>
                                            <li>{$month_week.week.week}</li>
                                        </ul>
                                        <ul style="bottom:0 !important;"></ul>
                                    </td>
                                    {foreach $month_week.days as $week_day }
                                        {if $week_day.type eq 'old'}
                                            <td {*class="monthly_day"*} data-date='{$week_day.date}'></td>
                                        {else}
                                            <td class="monthly_day{if $week_day.date eq $today_date} selected_date{/if} clearfix" data-date='{$week_day.date}'>
                                                <ul class="calender-col-header span12 monthlyslot_date clearfix">
                                                    <li>{$week_day.day}</li>
                                                </ul>
                                                <div class="monthly_strips clearfix">
                                                    {foreach $week_day.slots as $slot}
                                                        <span class="collapse-slot clearfix">
                                                            <div class="slot monthlyslotview span12 {if $slot.status eq 2}slot-theme-leave{elseif $slot.status eq 4}slot-theme-candg{elseif $slot.status eq 0 or $slot.status eq 3}slot-theme-incomplete{elseif $slot.status eq 1 and $slot.created_status eq 1}slot-theme-candg-accept{elseif $slot.type eq 10}slot-theme-pm{else}slot-theme-complete{/if} {if $slot.signed eq 1}signed_slot{/if}"  
                                                                 onmouseover="tooltip.pop(this, '#slot_details_{$slot.id}', { position:1, offsetX:-20, effect:'slade'{*, overlay:true*} });" data-slot-id="{$slot.id}" >
                                                                <div class="{if $slot.signed eq 1}striped{/if} span12 slot_bountery">
                                                                    <div class="slot-notification-wrpr" style="background-color: {$slot.emp_color};">
                                                                        <div class="slot-notification">{if $slot.comment neq ''}<span class="slot-notification-comment"></span>{/if}</div>
                                                                    </div>
                                                                    <div class="notification-info-customer">{$slot.slot} ({$slot.slot_hour}){if trim($slot.emp_name) neq ''}<br/><span title="{htmlspecialchars($slot.emp_name)}" style="white-space: normal;">{$slot.emp_name}</span>{/if}</div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    {/foreach}
                                                </div>
                                            </td>
                                        {/if}
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </tbody>
                        <!-- // Table body END -->
                    </table>
                </div>
            </div>
        </div>
            <!-- // Table END -->
            <!-- // CALENDER END -->
        </div>

{*    slot_expanded_views*}
        <div id="slot_expanded_views" >
            {foreach $month_weeks as $month_week}
                {foreach $month_week.days as $week_day}
                    {foreach $week_day.slots as $slot}
                        <div style="display:none;" data-id="{$slot.id}">
                            <div id="slot_details_{$slot.id}" class="clearfix slot-hover-popup span4 {if $slot.status eq 2}slot-theme-leave{elseif $slot.status eq 4}slot-theme-candg{elseif $slot.status eq 0 or $slot.status eq 3}slot-theme-incomplete{elseif $slot.status eq 1 and $slot.created_status eq 1}slot-theme-candg-accept{elseif $slot.type eq 10}slot-theme-pm{else}slot-theme-complete{/if}">
                                <div class="clearfix {if $slot.signed eq 1}striped{/if}" style="padding: 15px;">
                                    <ul class="clearfix">
                                        <li><h1>{$slot.slot} ({$slot.slot_hour})</h1></li>
                                        <li><span class="icon-group"></span> {if $slot.customer neq ''}{$slot.cust_name}{else}[{$translate.no_customer}]{/if}</li>
                                        <li><span class="icon-user"></span> {if $slot.employee neq ''}{$slot.emp_name}{else}[{$translate.no_employee}]{/if}</li>
                                        {if $slot.comment neq ''}<li class="hover-popup-comment"><span class="icon-comment"></span>{nl2br(htmlspecialchars($slot.comment))}</li>{/if}
                                        <hr>
                                        <li class="clearfix">
                                            <span class="slot-type pull-left">
                                                {if $slot.fkkn eq 1}{$translate.fk}
                                                {else if $slot.fkkn eq 2}{$translate.kn}
                                                {else if $slot.fkkn eq 3}{$translate.tu}
                                                {/if}
                                            </span>
                                            <span class='pull-left'>
                                                <ul class="slot-type-small-icons-group clearfix">
                                                    {if $slot.type eq 1}<li class="slot-icon-small-travel" title="{$translate.travel}"></li>
                                                    {elseif $slot.type eq 0}<li class="slot-icon-small-normal" title="{$translate.normal}"></li>
                                                    {elseif $slot.type eq 2}<li class="slot-icon-small-break" title="{$translate.break}"></li>
                                                    {elseif $slot.type eq 3}<li class="slot-icon-small-oncall" title="{$translate.oncall}"></li>
                                                    {elseif $slot.type eq 4}<li class="slot-icon-small-over-time" title="{$translate.overtime}"></li>
                                                    {elseif $slot.type eq 5}<li class="slot-icon-small-qualtiy-overtime" title="{$translate.qual_overtime}"></li>
                                                    {elseif $slot.type eq 6}<li class="slot-icon-small-more-time" title="{$translate.more_time}"></li>
                                                    {elseif $slot.type eq 14}<li class="slot-icon-small-oncall-moretime" title="{$translate.more_oncall}"></li>
                                                    {elseif $slot.type eq 7}<li class="slot-icon-small-some-other-time" title="{$translate.some_other_time}"></li>
                                                    {elseif $slot.type eq 8}<li class="slot-icon-small-training" title="{$translate.training_time}"></li>
                                                    {elseif $slot.type eq 9}<li class="slot-icon-small-call-training" title="{$translate.call_training}"></li>
                                                    {elseif $slot.type eq 10}<li class="slot-icon-small-personal-meeting" title="{$translate.personal_meeting}"></li>
                                                    {elseif $slot.type eq 11}<li class="slot-icon-small-voluntary" title="{$translate.voluntary}"></li>
                                                    {elseif $slot.type eq 12}<li class="slot-icon-small-complimentary" title="{$translate.complementary}"></li>
                                                    {elseif $slot.type eq 13}<li class="slot-icon-small-complimentary-oncall" title="{$translate.complementary_oncall}"></li>
                                                    {elseif $slot.type eq 15}<li class="slot-icon-small-standby" title="{$translate.oncall_standby}"></li>
                                                    {elseif $slot.type eq 16}<li class="slot-icon-small-dismissal" title="{$translate.work_for_dismissal}"></li>{/if}
                                                </ul>
                                            </span>
                                            {if $slot.status eq 2}
                                                <span class="label label-important" style="padding: 5px;">{$slot.leave_data.leave_name}</span>
                                            {/if}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                {/foreach}
            {/foreach}
            </div>
    </div>
{else}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="alert alert-danger alert-dismissable">
                <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  {$translate.permission_denied}
            </div>
        </div>
    </div>
{/if} 
{/block}



{block name='script'}
    <script src="{$url_path}js/date-picker.js"></script>
    <script src="{$url_path}js/time_formats.js" type="text/javascript" ></script>
    <script src="{$url_path}js/bootbox.js"></script>
    <script type="text/javascript">
        //didn't remove this js block from this location
        $(function(){
            $.contextMenu( 'destroy' );
        });
    </script>
    <script type="text/javascript" src="{$url_path}js/jquery.contextmenu.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
            });
            
            //HEIGHT FIT
            $('.main-left').css({ height: $(window).innerHeight()-50 });
            $(window).resize(function(){
              $('.main-left').css({ height: $(window).innerHeight()-50 });
            });
            
            //TABLE ROW EXPANDER
            $(".btn-collapse-table-row").click(function() {
                var week_collapse_action = '';
                if ($(this).val() === "+"){
                    $(this).val("-");
                    week_collapse_action = 'EXPAND';
                }else{
                    $(this).val("+");
                    week_collapse_action = 'COLLAPSE';
                }

                if (week_collapse_action === 'COLLAPSE') {
                    $(this).parents('.week_row').find(".collapse-slot").hide();
                    $(this).parents('.week_row').find("li.chk_all_week_slot_ctrl").hide();
                    $(this).parents('.week_row').css('height', 'auto');
                } else if (week_collapse_action === 'EXPAND') {
                    $(this).parents('.week_row').find(".collapse-slot").show();
                    $(this).parents('.week_row').find("li.chk_all_week_slot_ctrl").show();
                    $(this).parents('.week_row').css('height', '150px');
                }
            });
            
            //datepicker_btstrap
            $(".monthPicker").datepicker({
                format: "yyyy-mm",
                changeMonth: true,
                changeYear: true,
                viewMode: "months", //1
                minViewMode: "months",
                autoclose: true,
                language: '{$lang}',
                onClose: function (dateText, inst) { }
            }).on('changeDate', function(ev){
                var month = $.datepicker.formatDate('mm', ev.date);
                var year = $.datepicker.formatDate('yy', ev.date);
                $(".monthPicker").datepicker('hide');
                navigatePage('{$url_path}schedule/month/gdschema/'+year+'/'+month+'/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/',1);
            });
        });
        
        function applySchedule(){
            var schedule_id = $('#cmb_template_name').val();
            var PreviewStartDate = $.trim($('#templatePrvStartDate').val());
            var no_of_times = $.trim($('#cmb_no_of_times').val());
            if(schedule_id == ''){
                alert('{$translate.select_template}');
                $('#cmb_template_name').focus();
            } 
            else if(PreviewStartDate == ''){
                alert('{$translate.select_template_preview_start_date}');
                $('#templatePrvStartDate').focus();
            }
            else {
                //navigatePage('{$url_path}schedule/month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/'+schedule_id+'/'+PreviewStartDate+'/'+no_of_times+'/', 1);
                var objPreviewStartDate = new Date(PreviewStartDate);
                var PreviewDateYear = objPreviewStartDate.getFullYear();
                var PreviewDateMonth = (objPreviewStartDate.getMonth()+1);
                navigatePage('{$url_path}schedule/month/gdschema/'+PreviewDateYear+'/'+PreviewDateMonth+'/{$selected_customer}/'+schedule_id+'/'+PreviewStartDate+'/'+no_of_times+'/', 1);
            }
        }
        function conformScheduleSave(){
            var PreviewStartDate = $.trim($('#templatePrvStartDate').val());
            var no_of_times = $.trim($('#cmb_no_of_times').val());

            var main_obj = { 'customer': '{$selected_customer}', 'month': '{$selected_month}', 'year': '{$selected_year}', 'template': {$selected_schedule}, 'PreviewStartDate': PreviewStartDate, 'no_of_times': no_of_times };

            wrapLoader('#external_wrapper');
            $.ajax({
                url:"{$url_path}ajax_apply_monthly_customer_schedule.php",
                type:"POST",
                dataType: 'json',
                data: main_obj,
                success:function(data){
                    if(data.transaction){
                        navigatePage('{$url_path}month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/', 1);
                    }else if(data.full_message !== undefined && data.full_message != ''){
                        $('#left_message_wraper').html(data.full_message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) { 
                uwrapLoader('#external_wrapper');
            });
        }

        {if $privileges_general.create_template eq 1}
            function delete_template(){
                if(confirm('{$translate.confirm_delete_template}')){
                    var main_obj = { 'customer': '{$selected_customer}', 'month': '{$selected_month}', 'year': '{$selected_year}', 'template': {$selected_schedule}, 'action': 'delete' };

                    wrapLoader('#external_wrapper');
                    $.ajax({
                        url:"{$url_path}ajax_apply_monthly_customer_schedule.php",
                        type:"POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            if(data.transaction){
                                navigatePage('{$url_path}month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/', 1);
                            }else if(data.full_message !== undefined && data.full_message != ''){
                                $('#left_message_wraper').html(data.full_message);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) { 
                        uwrapLoader('#external_wrapper');
                    });
                }
            }
        {/if}
            
        {*function reload_content(){
            navigatePage('{$url_path}schedule/month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/{$selected_schedule}/{$template_start_date}/{$no_of_times}/', 1);
        }*}

        function printSchedule() {
            $('.fixed-scrolling-tbl').removeClass('fixed-scrolling-tbl');
             if($(window).height() > 600)
                 $('table#monthlyviewtbl').floatThead('destroy');
            $('.fixed-scrolling-tbl').css('height', 'auto').css('overflow-y', 'auto');
            setTimeout(function(){ $('#schedule_det').print();},1000);
            window.onfocus = function() {
                $('.fixed-scrolling-tbl').css('height', '450px').css('overflow-y', '');
                if($(window).height() > 600){
                    $demo1.floatThead({
                            scrollContainer: function($demo1){
                                    return $demo1.closest('.fixed-scrolling-tbl');
                            }
                    });
                    $demo1.floatThead('reflow');
                }
            };
        }
    </script>
{/block}