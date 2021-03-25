{block name='style'}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" href="{$url_path}css/contextMenu.css" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/notifications/Gritter/css/jquery.gritter.css" type="text/css" />
    <style type="text/css">
        .slots-full-view-body{ overflow-y: auto;}
        .time_slots_theme .close_btn_wrpr{ height: 13px;position: relative;right: -5px;top: -14px;}
        .slot-time { 
            font-size: 14px !important;
        }
        .day-customer-name { 
            font-size: 14px !important;
        }
        @media screen and (max-width: 767px){ 
            .slots-full-view-body { height: auto !important;}
            .slots-full-view-body .colpanels { min-height: 0 !important;}
        }
        .comment_day_area {
            padding: 2px 5px 7px;font-size: 11px;white-space: pre;text-overflow: ellipsis;overflow: hidden;
        }
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

{block name='content'}
{assign var = 'url_val' value='' scope='global'}
{assign var = 'url_val_slot' value='' scope='global'}
{$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:'&emp_alloc='|cat:$emp_alloc}
{$url_val_reload = $url_path|cat:'gdschema_alloc_window_employee.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{$url_val_self = $url_path|cat:'gdschema_alloc_window_employee.php?&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{$atl_warning_check = 0}
<input type="hidden" name="have_updation" id="have_updation" value="0"/>
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="row-fluid">
            <div class="span12">
                <div id="div_alloc_action" class='hide'></div>
                <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">
                    {if $message instanceof stdClass and $message->message neq ''}
                        <script>
                            $(document).ready(function() {
                                $.gritter.add({
                                    title: '{$message->subject}',
                                    text: '{$message->message}',
                                    image_class: true,
                                    sticky: true,
                                    time: '',
                                    class_name: '{$message->message_class}'
                                });
                            });
                        </script>
                    {else}{$message}{/if}
                </div>
                
                <div style="margin: 0px !important;" class="widget">
{*                   main header panel*}
                    <div class="widget-header widget-header-employee span12">
                        <h1 class="pull-left"> 
                            {$translate.slots_allocation} 
                            <span class="icon-group" style="margin-left:50px;font-size: 13px;vertical-align: text-bottom;"></span>
                            {$translate.employee}: {*$employee.name*}
                            <select class="ml" id="cmb_employee" name="cmb_employee" style="height: 28px;">
                                {foreach $search_employees as $s_employee}
                                    <option value="{$s_employee.username}" {if $s_employee.username eq $employee.userid}selected='selected'{/if}>{if $sort_by_name == 1}{$s_employee.first_name|cat:' '|cat:$s_employee.last_name}{elseif $sort_by_name == 2}{$s_employee.last_name|cat:' '|cat:$s_employee.first_name}{/if}</option>
                                {/foreach}
                            </select>
                        </h1>
                        <div class="pull-right" style="margin: 5px;">
                            {if $back_button_url != '' || $back_button_url != null}<a class="btn btn-normal pull-right" href="{$back_button_url}" style="margin-left: 5px;"><span style="margin: 0px 5px 0px 0px;" class="icon-arrow-left"></span>{if $from_page == 'mc_leave'}{$translate.back_mc_leave}{else}{$translate.back_report}{/if}</a>{/if}
                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="navigatePage('{$url_path}month/gdschema/employee/{$selected_year}/{$selected_month}/{$employee.userid}/', 1);" style="margin-left: 5px;">{$translate.monthly_view}</button>
                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="navigatePage('{$url_path|cat:$back_url}', 1);" style="margin-left: 5px;">{$translate.weekly_view}</button>
                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="navigatePage('{$url_path}gdschema_day_employee.php?date={$cur_date}&employee={$employee.userid}&action=1',1)" style="margin-left: 5px;">{$translate.timeline_view}</button>
                            <button class="btn btn-default pull-right cursor_hand" type="button"  onclick="reload_content();" title="{$translate.refresh}"><i class="icon-refresh cursor_hand"></i></button>
                        </div>
                    </div>

                    <div class="span12 widget-body-section input-group" style="padding: 8px;">
                        <div class="row-fluid">
                            <div class="span12">
                                
{*                                navigation panel*}
                                <div style="margin-bottom: 5px;" class="span12">
                                    <div class="span2">
                                        <div class="table-responsive">
                                            <table class="footable table table-striped table-bordered table-white table-primary slot-calender slot-calender-employee" style="margin:0">
                                                <thead>
                                                    <tr>
                                                        <th class="table-col-center week-select" title="{$translate.prev}" onclick="navigatePage('{$url_val_self}&date={$alloc_prev_week_day}', 1)"><i class=" icon-angle-left icon-large "></i></th>
                                                        <th class="table-col-center week-select" title="{$translate.back}" onclick="navigatePage('{$url_path|cat:$back_url}', 1);">V{$cur_week}</th>
                                                        <th class="table-col-center week-select" title="{$translate.next}" onclick="navigatePage('{$url_val_self}&date={$alloc_next_week_day}', 1)"><i class=" icon-angle-right icon-large "></i></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="span10">
                                        <div class="table-responsive">
                                            <table class="footable footable-employee  table table-striped table-bordered table-white table-primary slot-calender" style="margin:0">
                                                <thead>
                                                    <tr>
                                                        {foreach $alloc_week_days as $week_day}
                                                            <th class="table-col-center week-select {if $week_day.active}active-week{/if}" onclick="navigatePage('{$url_val_self}&date={$week_day.date}', 1)" title="{$week_day.date}" {if (($week_day.date|date_format:'%u') eq 7) || ($week_day.date|in_array:$holidays_week)} style="color:red !important; font-weight: bold;"{/if}>{$translate.{$week_day.label}}</th>
                                                        {/foreach}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

{*                                main content panels*}
                                <div class="row-fluid">
                                    <div class="widget slot-section-wrpr span12" style="margin-top:0 !important;">
                                        
{*                                        left panel*}
                                        <div class="span8 sloat-full-view">
                                            <div class="widget-header widget-header-employee span12">
                                                <div class="day-slot-wrpr-header-left pull-left"> 
                                                    <h1 {if (($cur_date|date_format:'%u') eq 7) || ($cur_date|in_array:$holidays)} style="color:red; font-weight: bold;"{/if}> {$translate.assigned_slots} | {$cur_date}
                                                        {if $employee_running_tasks|count gt 0 and $today_date eq $cur_date}
                                                            {assign employee_running_task_title ''}
                                                            {foreach $employee_running_tasks as $crt}
                                                                {assign employee_running_task_title $employee_running_task_title|cat:$crt.dag|cat:' '|cat:$crt.start_time|cat:' => '|cat:$crt.customer_first_name|cat:' '|cat:$crt.customer_last_name}
                                                                {if !$smarty.foreach.employee_running_tasks.last}{assign employee_running_task_title $employee_running_task_title|cat:'&#10;'}{/if} 
                                                            {/foreach}
                                                            <div class="cursor_help pull-right ml" title="{$employee_running_task_title}"><img src='{$url_path}images/clock.gif'/></div>
                                                        {/if}
                                                    </h1>
                                                </div>
                                                <div style="margin: 5px 0 0 0;" class="pull-right day-slot-wrpr-header-right">
                                                    <button class="btn btn-default btn-normal pull-right mr ml add-new-sl" type="button" onclick="openCreateNewSlotPanel()" title="{$translate.add_new_slot}">+</button>
                                                    {if $slot_entries_for_first_column|count gt 0 or $slot_entries_for_second_column|count gt 0}
                                                        <button id="mark_all" class="btn btn-default btn-normal pull-right" type="button" onclick="check_all_work_slots()" title="{$translate.boka_pass_select_all}">{$translate.check_all}</button>
                                                    {/if}
                                                </div>
                                            </div>
                                            
{*                                            slots display*}
                                            <div tabindex="2" class="span12 slots-full-view-body input-group no-min-height" id="slot_display_wraper" data-date='{$cur_date}'>
                                                <div class="row-fluid">
                                                    {assign i 0}
                                                    {foreach [$slot_entries_for_first_column, $slot_entries_for_second_column] as $slot_entries_for_each_column}
                                                        <div class="span6 colpanels">
                                                            {foreach $slot_entries_for_each_column as $slot_det}
                                                                {if $login_user_role neq 3 or ($login_user_role eq 3 and ($privileges_gd.not_show_employees eq 0 || ($privileges_gd.not_show_employees eq 1 and $slot_det.employee eq $login_user)))}
                                                                    <div class="row-fluid">
                                                                        <div class="span12" id="slot_thread_{$slot_det.id}">
                                                                            <div id="d{$slot_det.id}" class="slot-day {if $slot_det.type == 10 &&  $slot_det.status == 1}slot-theme-pm{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.status eq 1}slot-theme-complete{elseif $slot_det.status eq 2}slot-theme-leave{elseif $slot_det.status eq 4}slot-theme-candg{else}slot-theme-incomplete{/if} {if $slot_det.signed_in eq 1}signed_slot{/if} span12{if $swap_copied_slot eq $slot_det.id} objblink{/if} {if $slot_det.show_details neq 1}donot_show_slot{/if}">
                                                                                <input type="hidden" class="slot_details_hub" 
                                                                                    data-id='{$slot_det.id}'
                                                                                    data-type='{$slot_det.type}'
                                                                                    data-date='{$slot_det.date}'
                                                                                    data-status='{$slot_det.status}'
                                                                                    data-time-from='{$slot_det.slot_from}'
                                                                                    data-time-to='{$slot_det.slot_to}'
                                                                                    data-total_hours='{$slot_det.slot_hour}'
                                                                                    data-customer-id='{$slot_det.customer}'
                                                                                    data-customer-name='{$slot_det.cust_name|escape:'html'}'
                                                                                    data-employee-id='{$slot_det.employee}'
                                                                                    data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                                    data-fkkn='{$slot_det.fkkn}'
                                                                                    data-signed='{$slot_det.signed_in}'
                                                                                    data-comment='{$slot_det.comment|escape:'html'}'
                                                                                    />
                                                                                <div class="row-fluid day-slot-inner-wrpr {if $slot_det.signed_in eq 1}striped{/if}">
                                                                                    <div class="span7">
                                                                                        <div class="slot-time span12">{$slot_det.slot} ({$slot_det.slot_hour})</div>
                                                                                        <div class="row-fluid">
                                                                                            <div class="span12 customer-names-wrpr">
                                                                                                <span class="span12 day-customer-name">{if $slot_det.cust_name neq ''}{$slot_det.cust_name}{/if} <i style="display: none;" class="glyphicons icon-remove pull-right delete-customer"></i></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span5">
                                                                                        <div class="row-fluid">
                                                                                            <ul class="day-slot-info-icons pull-right">
                                                                                                {if $slot_det.status eq 2}<li><div class="week-slot-badge-wrpr" style="margin-top: 3px;"><span class="label label-important" style="font-size: 10px;">{$slot_det.leave_data.leave_name}</span></div></li>{/if}
                                                                                                <li class="slot-icon-day slot-icon-small 
                                                                                                    {if $slot_det.type eq 1}slot-icon-small-travel
                                                                                                    {elseif $slot_det.type eq 0}slot-icon-small-normal
                                                                                                    {elseif $slot_det.type eq 2}slot-icon-small-break
                                                                                                    {elseif $slot_det.type eq 3}slot-icon-small-oncall
                                                                                                    {elseif $slot_det.type eq 4}slot-icon-small-over-time
                                                                                                    {elseif $slot_det.type eq 5}slot-icon-small-qualtiy-overtime
                                                                                                    {elseif $slot_det.type eq 6}slot-icon-small-more-time
                                                                                                    {elseif $slot_det.type eq 14}slot-icon-small-oncall-moretime
                                                                                                    {elseif $slot_det.type eq 7}slot-icon-small-some-other-time
                                                                                                    {elseif $slot_det.type eq 8}slot-icon-small-training
                                                                                                    {elseif $slot_det.type eq 9}slot-icon-small-call-training
                                                                                                    {elseif $slot_det.type eq 10}slot-icon-small-personal-meeting
                                                                                                    {elseif $slot_det.type eq 11}slot-icon-small-voluntary
                                                                                                    {elseif $slot_det.type eq 12}slot-icon-small-complimentary
                                                                                                    {elseif $slot_det.type eq 13}slot-icon-small-complimentary-oncall
                                                                                                    {elseif $slot_det.type eq 15}slot-icon-small-standby
                                                                                                    {elseif $slot_det.type eq 16}slot-icon-small-dismissal 
                                                                                                    {elseif $slot_det.type eq 17}slot-icon-small-dismissal-oncall{/if}"     
                                                                                                    style="width: 24px; height: 27px; margin: 3px 0px 0px;"></li>
                                                                                                    {if $slot_det.customer}
                                                                                                        <li>
                                                                                                            <div class="day-slottype">
                                                                                                                {if $slot_det.fkkn eq 1}{$translate.fk}
                                                                                                                {else if $slot_det.fkkn eq 2}{$translate.kn}
                                                                                                                {else if $slot_det.fkkn eq 3}{$translate.tu}
                                                                                                                {/if}
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    {/if}
                                                                                                <li></li>
                                                                                                {if $slot_det.status neq 2 and $slot_det.tl_flag == 1 and $slot_det.signed_in eq 0 and $slot_det.status neq 4}
                                                                                                    <li style=""><input class="check-box get_slot_check m_check" type="checkbox" value="{$slot_det.id}" id="slot_{$i}" data-slot-no="{$i}" data-slot-time-range="{$slot_det.slot}" {if ($slot_det.privileges_gd.add_customer eq 1 or $slot_det.privileges_gd.copy_day_slot eq 1 or $slot_det.privileges_gd.delete_day_slot eq 1) and $slot_det.customer eq ''}onclick="cust_assign_slot('{$i}','{$slot_det.slot}','{$slot_det.id}');"{/if}></li>
                                                                                                {/if}
                                                                                            </ul>

                                                                                            {assign i $i+1}
                                                                                            <div class="day-slot-option-wrpr">
                                                                                                {if $slot_det.status == 2 && $slot_det.signed_in == 0 && $slot_det.tl_flag == 1}
                                                                                                    <input type="hidden" class="slot_leave_details_hub" 
                                                                                                            data-leave-id='{$slot_det.leave_data.id}'
                                                                                                            data-leave-group-id='{$slot_det.leave_data.group_id}'
                                                                                                            data-leave-time-from='{$slot_det.leave_data.time_from}'
                                                                                                            data-leave-time-to='{$slot_det.leave_data.time_to}'
                                                                                                            data-leave-is-exist-relation='{$slot_det.leave_data.is_exist_relation}'
                                                                                                            />
                                                                                                    {if $slot_det.leave_data.status == 0}
                                                                                                        {if $privileges_mc.leave_approval == 1}
                                                                                                            <div id="leave_slot_approve_{$slot_det.id}" class="no-default-action" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&status=1'}', 1);"><img width="25" border="0" src="{$url_path}images/icon_approve.png" title="{$translate.approve}"/></div>
                                                                                                        {/if}
                                                                                                        {if $privileges_mc.leave_rejection == 1}
                                                                                                            <div id="leave_slot_reject_{$slot_det.id}" class="no-default-action" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&employee='|cat:$slot_det.employee|cat:'&date='|cat:$slot_det.date|cat:'&t_from='|cat:$slot_det.leave_data.time_from|cat:'&t_to='|cat:$slot_det.leave_data.time_to|cat:'&status=2'}', 2);" ><img width="25" border="0" src="{$url_path}images/cirrus_icon_reject.png" title="{$translate.reject}" /></div>
                                                                                                        {/if}
                                                                                                    {elseif $slot_det.leave_data.status == 1 && $privileges_mc.leave_edit == 1}

                                                                                                        <div id="leave_slot_edit_{$slot_det.id}" class="no-default-action" onclick="edit_leave_slot(this);" ><img width="25" border="0" src="{$url_path}images/leave_cancel.png"  title="{$translate.back_to_work}" /></div>
                                                                                                        <div id="leave_slot_cancel_{$slot_det.id}" class="no-default-action" onclick="cancel_leave_slot(this);" ><img width="25" border="0" src="{$url_path}images/slotes_close.png"  title="{$translate.cancel_leave}" /></div>
                                                                                                        {if $slot_det.privileges_gd.add_slot == 1 and $slot_det.leave_data.is_exist_relation eq 0}
                                                                                                            <div id="leave_slot_clone_{$slot_det.id}" class="no-default-action" onclick="cloneLeaveSlot('{$slot_det.id}');" ><img width="25" border="0" src="{$url_path}images/clone_pic.png" title="{$translate.clone_relation}" /></div>
                                                                                                        {/if}
                                                                                                    {/if}
                                                                                                {elseif $slot_det.status == 4 && $privileges_gd.candg_approve == 1}
                                                                                                    <div>
                                                                                                        {if $slot_det.privileges_gd.delete_slot eq 1 and $slot_det.signed_in eq 0 and $slot_det.tl_flag ==1}
                                                                                                            <a title="{$translate.delete}" href="javascript:void(0);" onclick="slotRemove('{$url_val}&id={$slot_det.id}&action=slot_remove')" >
                                                                                                                <img width="18" border="0" src="{$url_path}images/slotes_close.png"  title="{$translate.back_to_work}" />
                                                                                                            </a>
                                                                                                        {/if}
                                                                                                    </div>
                                                                                                    <div><a title="{$translate.manage}" href="javascript:void(0);" onclick="acceptCandGSlot('{$url_val}&id={$slot_det.id}&action=slot_approve_candg')" class="accept_candg"></a></div>
                                                                                                {else}
                                                                                                    <div></div><div></div>
                                                                                                {/if}
                                                                                                <div> </div><div></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row-fluid"></div>
                                                                                    </div>
                                                                                    {if htmlspecialchars($slot_det.comment) != '' || htmlspecialchars($slot_det.comment) != null}
                                                                                        <div class="span12 no-ml no-min-height">
                                                                                          <div class="row-fluid">
                                                                                              <div class="span12 no-min-height comment_day_area" title="{$slot_det.comment|escape:'html'}"><i class="icon-comment"/> {$slot_det.comment|escape:'html'}</div>
                                                                                          </div>
                                                                                        </div>
                                                                                    {/if}
                                                                                </div>
                                                                            </div>
                                                                            <!--SLOT END-->
                                                                        </div>
                                                                    </div>
                                                                {/if}
                                                            {/foreach}
                                                        </div>    
                                                    {/foreach} 
                                                </div>
                                            </div>
                                        </div>
                                                
{*                                        right panel*}
                                        <div class="span4 slot-edit-view">
                                            <div class="widget-header widget-header-employee span12">
                                                <div class="pull-left day-slot-wrpr-header-left"><h1>{$translate.options}</h1></div>
                                                <div class="pull-right day-slot-wrpr-header-left" style="margin: 5px 0px 0px;"></div>
                                            </div>
                                            <div tabindex="3" style="position: relative;" class="span12 slots-full-view-body slot-form input-group" id="stickyPanelParent">
{*                                                employee allocation/slot create/memory slots*}
                                                <div class="span12 {*tab-content-wrpr tab-content-wrpr-show*}" id="tab_emp_slotcreate_memoryslots_sections">
                                                    <div class="box-generic">
                                                        <div class="tabsbar tabsbar-2" style="margin: -5px 0 7px;">
                                                            <ul class="row-fluid row-merge">
                                                                <li class="span4{if !isset($right_panel) || $right_panel eq '' || $right_panel eq 'emp_assign_list'} active{/if}"><a href="#tab-assign-emp-list" data-toggle="tab" id="tb_assign_emp_list"> {$translate.customer}</a></li>
                                                                {if $privileges_gd.add_slot == 1}
                                                                    <li class="span4 circle_info {if isset($right_panel) and $right_panel eq 'create_new_slot'} active{/if}"><a href="#tab-create-new-slot" data-toggle="tab" onclick="clicked_tab_create_slots();" id="tb_create_slot"> <span>{$translate.add_new_slot}</span></a></li>
                                                                    <li class="span4 cart_in{if isset($right_panel) and $right_panel eq 'memory_slots'} active{/if}"><a href="#tab-memory-slots" data-toggle="tab" onclick="clicked_tab_memory_slots();" id="tb_mem_slots"> <span>{$translate.memory_slots} </span></a></li>
                                                                {/if}
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content" style="background:none;padding: 0px;overflow: initial;">
                                                            <div class="tab-pane{if !isset($right_panel) || $right_panel eq '' || $right_panel eq 'emp_assign_list'} active{/if}" id="tab-assign-emp-list" style="background:none !important;">
                                                                <div tabindex="1" style="overflow: auto;" class="span12 day-deatiles-employee input-group" >
                                                                    <div class="row-fluid customer-names-pills-wrpr" id="assignment-employees-wrpr">
                                                                        {foreach from=$customers_to_assign item=cust}
                                                                            <div class="customer-name-slots" data-cust-name='{$cust.username}' style="float: none;">
                                                                                <span class="widget-stats-emplyee widget-stats-2 employees" onclick="loadPopupSchemaCustomerAssignment('{$url_val_slot}&cust={$cust.username}&action=multiple_slot_assign_cust');">
                                                                                    <span>{if $sort_by_name == 1}{$cust.first_name|cat:' '|cat:$cust.last_name}{elseif $sort_by_name == 2}{$cust.last_name|cat:' '|cat:$cust.first_name}{/if} ({$cust.code})</span>
                                                                                </span>
                                                                            </div>
                                                                        {/foreach}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {if $privileges_gd.add_slot == 1}
                                                                <div class="tab-pane {if isset($right_panel) and $right_panel eq 'create_new_slot'} active{/if}" id="tab-create-new-slot" style="background:none !important;">
                                                                    <div class="add-new-slots-month">
                                                                        
                                                                        <div class="slot-wrpr-buttons span12 no-mt" style="margin:5px 0;" id="btnGroupStickyPanel">
                                                                            <button type="button" class="btn btn-success span12" onclick="manEntry();"><span class="icon-save"></span> {$translate.save}</button>
                                                                        </div> 
                                                                        
                                                                        <div style="margin-top: 0px; margin-bottom: 5px ! important; " class="widget">
                                                                            <div class="widget-body" style="padding:5px;">
                                                                                <div class="row-fluid">
                                                                                    <div class="span8 customer-name no-mb no-min-height" style="margin:5px;"> 
                                                                                        <span style="margin-right: 5px;" class="icon-group"></span>{$employee.name}
                                                                                    </div>
                                                                                    <div class="span1 pull-right"> 
                                                                                        <button type="button" class="btn btn-default-special pull-right" onclick="popupAddSlotMore();" tabindex="-1"><span class="icon-plus"></span></button>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend date hasDatepicker datepicker" id="dtPickerNewSlotDate">
                                                                                            <span class="add-on icon-calendar"></span>
                                                                                            <input class="form-control span12 slot_date" id="new_slot_date" value="{$cur_date}" placeholder="{$translate.date}" type="text"/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="span12 create-slotes-panel no-pb" style="margin-left: 0px;"></div>                                
                                                                        
                                                                        <br/>
{*                                                                        copy to weeks options*}
                                                                        <span class="span12 no-min-height no-ml" style="margin-top:5px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="check_created_slot_copy_to_weeks" id="check_created_slot_copy_to_weeks" /> <label for="check_created_slot_copy_to_weeks" class="template_label">{$translate.copy_multiple}</label></span>
                                                                        <div class="span12 form-wrpr mt no-ml hide" id="created_slot_copy_to_weeks">
                                                                            <h1 style="margin:10px 0 10px 0 !important;">{$translate.copy_multiple}</h1>
                                                                            
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="1" checked="checked" style="margin-right: 4px !important;"> {$translate.monday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="2" checked="checked" style="margin-right: 4px !important;"> {$translate.tuesday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="3" checked="checked" style="margin-right: 4px !important;"> {$translate.wednesday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="4" checked="checked" style="margin-right: 4px !important;"> {$translate.thursday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="5" checked="checked" style="margin-right: 4px !important;"> {$translate.friday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="6" checked="checked" style="margin-right: 4px !important;"> {$translate.saturday_first_charecter}
                                                                                </label>
                                                                                <label class="checkbox checkbox-inline mr no-pl">
                                                                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="0" checked="checked" style="margin-right: 4px !important;"> {$translate.sunday_first_charecter}
                                                                                </label>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <label for="cscm_from_wk">{$translate.copy_from}</label>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12 cscm_frm_wk_selct" id="cscm_from_wk" onchange="getAfterDates_for_cscm()">
                                                                                        {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                                                                            <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>
                                                                                        {/section}
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12" name="cscm_from_option" id="cscm_from_option" onchange="getAfterDates_for_cscm()">
                                                                                        <option value="0">{$translate.every_week}</option>
                                                                                        <option value="1">{$translate.every_2}</option>
                                                                                        <option value="2">{$translate.every_3}</option>
                                                                                        <option value="3">{$translate.every_4}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <label for="cscm_to_wk"> {$translate.copy_upto}</label>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-pencil"></span>
                                                                                    <select name="cscm_to_wk" id="cscm_to_wk" class="form-control span12"></select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <span class="span12 no-min-height no-ml" style="margin-top:5px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="saveTimeslot" id="saveTimeslot" /> <label for="saveTimeslot" class="template_label">{$translate.save_timeslot}</label></span>
                                                                    </div>

                                                                </div>


                                                                <div class="tab-pane {if isset($right_panel) and $right_panel eq 'memory_slots'}active{/if}" id="tab-memory-slots">
                                                                    <div class="row-fluid span12 form-section-highlight">
                                                                        <div class="pull-right day-slot-wrpr-header-left " style="margin: 5px 0px 0px;">
                                                                            <button class="btn btn-default-special btn-normal span12" onclick="multipleMemorySlotAdd();" type="button" title="{$translate.boka_pass_multi_slot_add}">{$translate.add_selected}</button>
                                                                         </div>
                                                                        <div class="row-fluid span12" id="available_memory_slots">
                                                                            <ol class="memory-slots-list-wrpr">
                                                                                {foreach [$memory_slots1, $memory_slots2, $memory_slots3] as $memory_slots}
                                                                                    {foreach $memory_slots as $mem_slot}
                                                                                        <li class="memory_time">
                                                                                            <div class="child-slots" style="padding:2px !important;"{*draggable="true" ondragstart="drag(event)"*}>
                                                                                                <input type="checkbox" name="mem_slot_{$mem_slot.id}" id="mem_slot_{$mem_slot.id}" value="{$mem_slot.time_from|cat:'-'|cat:$mem_slot.time_to|cat:'-'|cat:$mem_slot.type}" class="check-box this_mslot" data-id="{$mem_slot.id}" data-timefrom='{$mem_slot.time_from}' data-timeto='{$mem_slot.time_to}' data-type='{$mem_slot.type}' />
                                                                                                <span style="font-size:8px;">{$mem_slot.time_from|cat:'-'|cat:$mem_slot.time_to} {if $mem_slot.type eq '3'}J{/if}</span> 
                                                                                                <span class="glyphicons icon-remove pull-right remove-memory-slot cursor_hand" style="padding-left: 0; font-size: 7px;"></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    {/foreach}
                                                                                {/foreach}
                                                                            </ol>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {/if}

                                                        </div>
                                                    </div>
                                                </div>
                                                {if $privileges_gd.change_time == 1}
                                                    <div id="change_time_of_slots" class="span12 hide">
                                                        <div class="span12 panel-heading">
                                                            <h4 class="panel-title clearfix">{$translate.change_time}</h4>
                                                        </div>
                                                        <div class="span12 slots-full-view-body">
                                                            <div class="span12" style="margin:0;">
                                                                <div class="input-prepend">
                                                                    <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                    <input class="form-control span5 time-input-text" id="change_time_from" placeholder="{$translate.time_from}" type="text"   style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                                                                    <span class="add-on">{$translate.to}</span>
                                                                    <input class="form-control span5 time-input-text" id="change_time_to" placeholder="{$translate.time_to}" type="text"   style="margin-left: -1px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="slot-wrpr-buttons span12">
                                                            <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangetimes();"><span class="icon-save"></span> {$translate.save}</button>
                                                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                                                        </div>
                                                    </div>
                                                {/if}
                                                
                                    {*            slot manage options*}
                                                <div id="slot_details_main_wraper_group" class="hide">
                                                    <div class="slot-wrpr span12" id="slot-wrpr-slots">

                                                        <input class="this_slot_id" id="sdID" type="hidden" value=""/>
                                                        <input id="this_slot_actual_date" type="hidden" value=""/>
                                                        <input id="this_slot_actual_timefrom" type="hidden" value=""/>
                                                        <input id="this_slot_actual_timeto" type="hidden" value=""/>
                                                        <input id="this_slot_actual_customer" type="hidden" value=""/>
                                                        <input id="this_slot_actual_employee" type="hidden" value=""/>
                                                        <input id="this_slot_actual_employee_name" type="hidden" value=""/>
                                                        <input id="this_slot_actual_fkkn" type="hidden" value=""/>
                                                        <input id="this_slot_actual_type" type="hidden" value=""/>
                                    {*                    <input id="this_tl_flag" type="hidden" value=""/>*}

                                                        <div class="span12" style="margin:0;">
                                                            <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date" style="padding-left: 0px;">
                                                                <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                <input class="form-control span12" id="sdDate" placeholder="{$translate.date}" type="text"/>
                                                            </div>
                                                        </div>

                                                        <div class="span12" style="margin:0;">
                                                            <div class="input-prepend">
                                                                <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                <input class="form-control span5 time-input-text" id="sdTFrom" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                                                                <span class="add-on">{$translate.to}</span>
                                                                <input class="form-control span5 time-input-text" id="sdTTo" placeholder="{$translate.to}" type="text" style="margin-left: -1px;"/>
                                                            </div>
                                                        </div>
                                                        <h2 class="span12 no-mb"><span class="icon-group" title="{$translate.employee}"></span> 
                                                            <span id="sdEmployee">{$employee.name}</span>
                                                            <input class="this_slot_employee_id" id="sdEmployeeID" type="hidden" value="{$employee.userid}"/>
                                                        </h2>
                                                        <div class="span12" style="margin-left: 0px;">
                                                            <div class="input-prepend span11">
                                                                <span class="add-on icon-user" title="{$translate.customer}"></span>
                                                                <select class="form-control span12" id="sdCustomer">
                                                                    <option value="">{$translate.select}</option>
                                                                    {foreach from=$all_customers_of_employee item=cust}
                                                                        <option value="{$cust.username}">{$cust.last_name} {$cust.first_name}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin-left: 0px;">
                                                            <div class="input-prepend span11">
                                                                <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                                                                <select class="form-control span12" id="sdFKKN">
                                                                    <option value="1">{$translate.fk}</option>
                                                                    <option value="2">{$translate.kn}</option>
                                                                    <option value="3">{$translate.tu}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="span12" style="margin-left: 0px;">
                                                            <div class="input-prepend span11">
                                                                <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                                                            </div>
                                                        </div>

                                                        <button type="button" class="btn btn-default span1 hide" id="btn_direct_lock_slot"><span class="icon-lock"></span></button>
                                                        {if $privileges_gd.candg_approve eq 1}
                                                            <span id="candg_action_btn_group" class="hide">
                                                                <button class="btn btn-success" type="button" onclick="acceptCandGSlot();"><i class="icon-ok-sign icon-large"></i> {$translate.accept}</button>
                                                                <button class="btn btn-danger" type="button" onclick="delete_single_slot();"><i class="icon-remove-sign icon-large"></i> {$translate.reject}</button>
                                                            </span>
                                                        {/if}
                                                        {if $privileges_gd.add_slot eq 1}
                                                            <span id="clone_leave_action_btn_group" class="hide">
                                                                <button class="btn btn-success" type="button" onclick="clone_relation_leave_slot();"><i class="icon-copy icon-large"></i> {$translate.btn_clone_relation}</button>
                                                            </span>
                                                        {/if}


                                                        <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" id="sdTypes" style="width: 27px; height: 30px; overflow: hidden;">
                                                            <li class="slot-icon slot-icon-type-1 slot-icon-small-travel active" data-value='1' title="{$translate.travel}"></li>
                                                            <li class="slot-icon slot-icon-type-0 slot-icon-small-normal" data-value='0' title="{$translate.normal}"></li>
                                                            <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}"></li>
                                                            <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}"></li>
                                                            <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}"></li>
                                                            <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}"></li>
                                                            <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}"></li>
                                                            <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}"></li>
                                                            <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}"></li>
                                                            <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}"></li>
                                                            <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}"></li>
                                                            <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}"></li>
                                                            <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}"></li>
                                                            <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}"></li>
                                                            <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}"></li>
                                                            <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}"></li>
                                                            <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}"></li>
                                                            <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}"></li>
                                                        </ul>
                                                        <div class="slot-wrpr-buttons span12  btn-group btn-group-justified" style="margin:0; margin-top:5px;" >
                                                            <a href="javascript:void(0);" class="btn btn-success" id="btn_slot_details_save" onclick="modify_slot_details()"><i class="icon-save"></i> {$translate.save}</a>
                                                            <a href="javascript:void(0);" class="btn btn-danger slot-confirm-buttons">X {$translate.cancel}</a>
                                                        </div>
                                                    </div>

                                                    {if $privileges_gd.leave eq 1 || $privileges_gd.copy_single_slot eq 1 || $privileges_gd.copy_single_slot_option eq 1 || $privileges_gd.swap eq 1 || $privileges_gd.delete_slot eq 1 || $privileges_gd.split_slot eq 1}
                                                        <div class="row-fluid btn-group-slots pull-left" style=" margin: 0 0 15px 0;">
                                                            <div class="{*slot-wrpr-buttons span12 *}span12 widget-body-section input-group btn-set" id="slot_action_buttons">
                                                                {if $privileges_gd.leave eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_franvaro" title="{$translate.leave}"><span class="icon-user"></span> {$translate.leave}</button>{/if}
                                                                {if $privileges_gd.copy_single_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy" title="{$translate.boka_pass_slots_copy}" onclick="copy_single_slot();"><span class="icon-copy"></span> {$translate.copy}</button>{/if}
                                                                {if $privileges_gd.delete_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_delete" onclick="delete_single_slot();" title="{$translate.boka_pass_slots_delete}"><span class="icon-remove"></span> {$translate.delete}</button>{/if}
                                                                {if $privileges_gd.split_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_split" title="{$translate.boka_pass_slots_split}"><span class="icon-level-up"></span> {$translate.split}</button>{/if}
                                                                {if $privileges_gd.copy_single_slot_option eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy_multiple" title="{$translate.boka_pass_slots_copy_weekly}"><span class="icon-level-down"></span> {$translate.copy_multiple}</button>{/if}
                                                            </div>
                                                        </div>
                                                    {/if}

                                    {*                leave section starts*}
                                                    {if $privileges_gd.leave eq 1}
                                                        <div class="span12 form-wrpr hide" id="Franvaro-box" style="margin: 0 0 15px 0;">
                                                            <h1 style="margin: 10px 0px !important;">{$translate.leave}</h1>
                                                            <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                                                            <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                                                            <div class="btn-group leave-type">
                                                                {foreach from=$leave_types key=leave_type_key item=leave_type}
                                                                    <a unselectable="on" href="javascript:void(0);" id="leave_type{$leave_type_key}" class="btn btn-default" name="leave_type" value="{$leave_type_key}" onclick="setLeaveType({$leave_type_key});">{$leave_type}</a>
                                                                {/foreach}
                                                            </div>
                                                            
                                                            <div id="karense_notify" class="" style="display: none;"></div>
                                                            <div id="karense_notify1" class="" style="display: none;">
                                                                <div class="message">{$translate.karense_turned_off}</div>
                                                            </div>
                                                            {if $privileges_mc.leave_approval == 1}
                                                                <div class="widget mt no-mb" id="approve_leave_on_apply">
                                                                    <label><input type="checkbox" id="leave_approve_on_apply" name="leave_approve_on_apply" checked="checked" > {$translate.approve}</label>
                                                                </div>
                                                            {/if}
                                                            <div class="widget widget-tabs widget-tabs-double-2 no-mb" style="margin-top: 9px;">
                                                                <div class="widget-head">
                                                                    <ul>
                                                                        <li id="date_time_time" class="active"><a class="glyphicons clock" href="#tabLeaveTimePeriod" data-toggle="tab"  onclick="leaveTab('time');" ><i></i><span>{$translate.time}</span></a></li>
                                                                        <li id="date_time_date"><a class="glyphicons calendar" href="#tabLeaveDatePeriod" data-toggle="tab" onclick="leaveTab('date');"><i></i><span>{$translate.date}</span></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="widget-body">
                                                                    <div class="tab-content">
                                    {*                                    tabLeaveTimePeriod*}
                                                                        <div id="tabLeaveTimePeriod" class="tab-pane widget-body-regular active clearfix" style="background:#fff;">
                                                                            <div class="span12" style="margin:0">
                                                                                <div class="form-group">
                                                                                    <label for="leave_date_day" class="no-mb">{$translate.date}:</label>
                                                                                    <div class="input-prepend date hasDatepicker datepicker no-pt" id="dp_leave_date_day" style="padding-left: 0px;">
                                                                                        <span class="add-on icon-calendar"></span>
                                                                                        <input class="form-control span6" name="leave_date_day" id="leave_date_day" value="" placeholder="{$translate.date}" type="text" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label for="leave_time_from" class="no-mb">{$translate.time_range}:</label>
                                                                                <div class="input-prepend">
                                                                                    <span class="add-on  icon-time "></span>
                                                                                    <input class="form-control span5 time-input-text" name="leave_time_from" id="leave_time_from" value="" placeholder="{$translate.from}" type="text" />
                                                                                    <input class="form-control span5 time-input-text" name="leave_time_to" id="leave_time_to"  value="" placeholder="{$translate.to}" type="text" />
                                                                                </div>
                                                                            </div>

                                                                            <div id="leave_time_replacement_emps" class="span12 no-ml mt">
                                                                                {if $login_user_role neq 3}
                                                                                    <label style="padding: 0px;" class="checkbox">
                                                                                        <input name="send_sms_time" id="send_sms_time" class="checkbox" value="1" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_sms}
                                                                                    </label>

                                                                                    <div id="time_replacer_nosms_tbl">
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="float: left;font-weight: bold;" class="span12" for="replace_employees_list_time">{$translate.replacement_employee}:</label>
                                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                                <span class="add-on icon-group"></span>
                                                                                                <select name="rep_employees" id="replace_employees_list_time" class="form-control span12 replace_employees_list">
                                                                                                    <option value="">{$translate.none}</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="time_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="float: left;font-weight: bold;" class="span12" for="rep_employees_sms">{$translate.replacement_employee}:</label>
                                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                                <span class="add-on icon-group"></span>
                                                                                                <select name="rep_employees_sms" id="rep_employees_sms" class="form-control span11 replace_employees_list_sms" multiple="multiple">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_confirmation" class="checkbox" onclick="manageConf('time');" value="" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmatoin}
                                                                                            </label>
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_rejection" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_rejection}
                                                                                            </label>
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_sender" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmation_to_sender}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                {/if}
                                                                            </div>
                                                                            {if $privileges_gd.no_pay_leave eq 1}
                                                                                <div class="span12 no_pay_sick_check_div no-min-height mt hide">
                                                                                    <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                        <input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                                                                    </label>
                                                                                </div>
                                                                            {/if}

                                                                        </div>

                                    {*                                    tabLeaveDatePeriod*}
                                                                        <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" id="tabLeaveDatePeriod" class="tab-pane widget-body-regular clearfix">
                                                                            <div class="span12" style="margin:0">
                                                                                <div class="form-group">
                                                                                    <label for="leave_date_from" class="no-mb">{$translate.date}:</label>
                                                                                    <div class="input-prepend date datepicker no-pt" id="dp_leave_date_from" style="padding-left: 0px;">
                                                                                        <span class="add-on icon-calendar"></span>
                                                                                        <input class="form-control span8 dte_fld" name="leave_date_from" id="leave_date_from" placeholder="{$translate.date}" type="text" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span12" style="margin:0">
                                                                                <div class="form-group">
                                                                                    <label for="leave_date_to" class="no-mb">{$translate.to}:</label>
                                                                                    <div class="input-prepend date datepicker no-pt" id="dp_leave_date_to" style="padding-left: 0px;">
                                                                                        <span class="add-on icon-calendar"></span>
                                                                                        <input class="form-control span8 dte_fld" name="leave_date_to" id="leave_date_to" placeholder="{$translate.date}" type="text" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="leave_date_replacement_emps" class="span12 no-ml mt">
                                                                                {if $login_user_role neq 3}
                                                                                    <label style="padding: 0px;" class="checkbox">
                                                                                        <input class="checkbox" name="send_sms_date" id="send_sms_date" value="1" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_sms}
                                                                                    </label>

                                                                                    <div id="date_replacer_nosms_tbl">
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="float: left;" class="span12 template_label" for="replace_employees_list_date">{$translate.replacement_employee}:</label>
                                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                                <span class="add-on icon-group"></span>
                                                                                                <select name="rep_date_employees" id="replace_employees_list_date" class="form-control span12 replace_employees_list_date">
                                                                                                    <option value="">{$translate.none}</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="date_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="float: left;" class="span12 template_label" for="rep_employees_sms">{$translate.replacement_employee}:</label>
                                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                                <span class="add-on icon-group"></span>
                                                                                                <select name="rep_employees_sms" class="form-control span11 replace_employees_list_date_sms" multiple="multiple">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_confirmation_date" class="checkbox" onclick="manageConf('date');" value="" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmatoin}
                                                                                            </label>
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_rejection_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_rejection}
                                                                                            </label>
                                                                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                                <input name="chk_sender_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmation_to_sender}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                {/if}
                                                                            </div>
                                                                            {if $privileges_gd.no_pay_leave eq 1}
                                                                                <div class="span12 no_pay_sick_check_div no-min-height mt hide">
                                                                                    <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                                                        <input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                                                                    </label>
                                                                                </div>
                                                                            {/if}
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span12 mt">
                                                                <label style="float: left;" class="span12 template_label" for="leave_comments">{$translate.comments}:</label>
                                                                <div class="input-prepend span12" style="margin: 0px;">
                                                                    <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                    <textarea class="form-control span11"  name="leave_comments" id="leave_comments" rows="1" placeholder="{$translate.comment}"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="span12 no-ml mt">
                                                                <button type="button" class="btn btn-success span6" id="btn_save_leave" onclick="saveLeave();"><i class="icon-save"></i>  {$translate.save_leave}</button>
                                                                <button type="button" class="btn btn-danger span6 no-ml" id="Franvaro-box-close">x {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                    {/if}

                                    {*                slot split starts*}
                                                    {if $privileges_gd.split_slot eq 1}
                                                        <div class="span12 form-wrpr hide" id="slot-dela-pass" style="margin: 0 0 15px 0;">
                                                            <h1 style="margin:10px 0 10px 0 !important;">{$translate.split}</h1>
                                                            <label>{$translate.from_time}</label>
                                                            <input id="split_slot_timefrom" name="split_slot_timefrom" type="text" class="span12" placeholder="{$translate.from_time}" />
                                                            <label>{$translate.to_time}</label>
                                                            <input id="split_slot_timeto" name="split_slot_timeto" type="text" class="span12" placeholder="{$translate.to_time}" />
                                                            <div class="span12 no-ml">
                                                                <button type="button" class="btn btn-success span6" onclick="splitSlot();"><span class="icon-save"></span> {$translate.save}</button>
                                                                <button type="button" class="btn btn-danger span6 no-ml" id="slot-dela-pass-close">x {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                    {/if}

                                    {*                copy multiple starts*}
                                                    {if $privileges_gd.copy_single_slot_option eq 1}
                                                        <div class="span12 form-wrpr hide" id="kopierapass-box" style="margin: 0 0 15px 0;">
                                                            <h1 style="margin:10px 0 10px 0 !important;">{$translate.copy_multiple}</h1>
                                                            <form name="frm_copy" id="frm_copy" method="post">
                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_with_user">
                                                                        <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> {$translate.with_user}
                                                                    </label>
                                                                    <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_without_user">
                                                                        <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> {$translate.without_user}
                                                                    </label>
                                                                </div>
                                                                <br>

                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="1" checked="checked" style="margin-right: 4px !important;"> {$translate.monday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="2" checked="checked" style="margin-right: 4px !important;"> {$translate.tuesday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="3" checked="checked" style="margin-right: 4px !important;"> {$translate.wednesday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="4" checked="checked" style="margin-right: 4px !important;"> {$translate.thursday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="5" checked="checked" style="margin-right: 4px !important;"> {$translate.friday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="6" checked="checked" style="margin-right: 4px !important;"> {$translate.saturday_first_charecter}
                                                                    </label>
                                                                    <label class="checkbox checkbox-inline mr no-pl">
                                                                        <input type="checkbox"  name="slot_copy_multiple_days" value="0" checked="checked" style="margin-right: 4px !important;"> {$translate.sunday_first_charecter}
                                                                    </label>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <label style="margin-top:10px;" for="from_wk">{$translate.copy_from}</label>
                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <div class="input-prepend span11">
                                                                        <span class="add-on icon-pencil"></span>
                                                                        <select class="form-control span12 frm_wk_selct" id="slot_copy_multiple_from_wk" onchange="getAfterDates_for_slotcopy_multiple()">
                                                                            {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                                                                <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>
                                                                            {/section}
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <div class="input-prepend span11">
                                                                        <span class="add-on icon-pencil"></span>
                                                                        <select class="form-control span12" name="slot_copy_multiple_from_option" id="slot_copy_multiple_from_option" onchange="getAfterDates_for_slotcopy_multiple()">
                                                                            <option value="0">{$translate.every_week}</option>
                                                                            <option value="1">{$translate.every_2}</option>
                                                                            <option value="2">{$translate.every_3}</option>
                                                                            <option value="3">{$translate.every_4}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <label style="margin-top:10px;" for="slot_copy_multiple_to_wk"> {$translate.copy_upto}</label>
                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <div class="input-prepend span11">
                                                                        <span class="add-on icon-pencil"></span>
                                                                        <select name="slot_copy_multiple_to_wk" id="slot_copy_multiple_to_wk" class="form-control span12"></select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <br>
                                                            <div class="span12 no-ml">
                                                                <button type="button" class="btn btn-success span6" onclick="save_copy();"><span class="icon-save"></span> {$translate.save}</button>
                                                                <button type="button" class="btn btn-danger span6 no-ml" id="kopierapass-box-close">x {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                    {/if}
                                                </div>
                                                
{*                                                edit leave*}
                                                {if $privileges_mc.leave_edit == 1}
                                                    <div class="slot-wrpr span12 hide" id="leave_edit_wrpr">
                                                        <h4 class='right-panel-sub-heading' style="margin-top:10px;">{$translate.applied_leaves}</h4>
                                                        <hr/>
                                                        <input type="hidden" name="hdn_unsick_leave_id" id="hdn_unsick_leave_id"  value="" />
                                                        <input type="hidden" name="hdn_unsick_slot_id" id="hdn_unsick_slot_id"  value="" />
                                                        <input type="hidden" name="hdn_unsick_employee_id" id="hdn_unsick_employee_id"  value="" />
                                                        <input type="hidden" name="hdn_unsick_leave_date" id="hdn_unsick_leave_date"  value="" />
                                                        <input type="hidden" name="hdn_unsick_time_from" id="hdn_unsick_time_from"  value="" />
                                                        <input type="hidden" name="hdn_unsick_time_to" id="hdn_unsick_time_to"  value="" />
                                                        <div class="span12" style="margin:0;">
                                                            <div class="span12">
                                                                <label style="font-weight: bold;display: inline;">{$translate.employee}:</label>
                                                                <span class="leave_taken_employee_name"> </span>
                                                            </div>
                                                            <div class="span12 no-ml">
                                                                <label style="font-weight: bold;display: inline;">{$translate.date}:</label>
                                                                <span class="leave_taken_date"></span>
                                                            </div>
                                                            <div class="span12 no-ml">
                                                                <label style="font-weight: bold;">{$translate.unsick_from}:</label>
                                                                <input id="unsick_time_from" name="unsick_time_from" type="text" value="" class="span12" placeholder="{$translate.from_time}" />
                                                            </div>
                                                            <button type="button" class="btn btn-success" onclick="edit_leave_slotConfirm();"><span class="icon-save"></span> {$translate.save}</button>
                                                            <button type="button" class="btn btn-danger slot-confirm-buttons">x {$translate.cancel}</button>
                                                        </div>
                                                    </div>
                                                {/if}
                                                
                                    {*            right_click_action_options*}
                                                <div id="right_click_action_options" class="hide">
                                    {*                goto employees*}
                                                    <div id="goto-employees-options" class="span12 hide">
                                                        <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.go_to} {$translate.employee}</h4></div>
                                                        <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                                                            <div id="goto-employees-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                                                                {foreach $search_employees AS $empl}
                                                                    <div style="margin-left: 0px;" class="span12">
                                                                        <div style="margin-top: 4px;" class="span12 child-slots">
                                                                            <label onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$cur_date}&employee={$empl.username}',1);">
                                                                                <span>{if $sort_by_name == 1}{$empl.first_name} {$empl.last_name}{elseif $sort_by_name == 2}{$empl.last_name} {$empl.first_name}{/if}</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                {foreachelse}
                                                                    <div style="margin-left: 0px;" class="span12"><div class="message">{$translate.no_employee_available}</div></div>
                                                                {/foreach}
                                                            </div>
                                                        </div>
                                                        <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                                                            <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                                                        </div>
                                                    </div>

                                    {*                goto customer*}
                                                    <div id="goto-customers-options" class="span12 hide">
                                                        <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.go_to} {$translate.customer}</h4></div>
                                                        <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                                                            <div id="goto-customers-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                                                                {foreach $righclick_customers_for_goto AS $rcust}
                                                                    <div style="margin-left: 0px;" class="span12">
                                                                        <div style="margin-top: 4px;" class="span12 child-slots">
                                                                            <label onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&customer={$rcust.username}',1);">
                                                                                <span>{if $sort_by_name == 1}{$rcust.first_name} {$rcust.last_name}{elseif $sort_by_name == 2}{$rcust.last_name} {$rcust.first_name}{/if}</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                {foreachelse}
                                                                    <div style="margin-left: 0px;" class="span12"><div class="message">{$translate.no_customer}</div></div>
                                                                {/foreach}
                                                            </div>
                                                        </div>
                                                        <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                                                            <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                                                        </div>
                                                    </div>
                                                        
                                    {*                change employee/customer*}
                                                    {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1}
                                                        <div id="change-employee-customer-options" class="span12 hide">
                                                            <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.change}</h4></div>
                                                            <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                                                                <input type="hidden" name="slots_to_change_users" id="slots_to_change_users" value="" />
                                                                <input type="hidden" name="change_usertype_to_change_users" id="change_usertype_to_change_users" value="" />
                                                                <div id="available_users_for_change" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;"></div>
                                                            </div>
                                                            <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                                                                <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangeUserMultiple();"><span class="icon-save"></span> {$translate.save}</button>
                                                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                    {/if}

                                    {*                replace employee*}
                                                    {if $privileges_gd.add_employee eq 1}
                                                        <div id="replace-employee-week-basis" class="manage-form span12 hide">
                                                            <div class="span12">
                                                                <h4 style="margin-top:20px;font-weight: bold;">{$translate.replace_user}</h4>
                                                                <hr>
                                                                <div class='row-fluid'>
                                                                    <div class="span12" style="margin-left: 1.49254%;">
                                                                        <span style="font-weight: bold;">{$translate.replacing_employee}:</span> <span id="spn_replacing_employee"></span>
                                                                    </div>
                                                                    <div class="span12">
                                                                        <span style="font-weight: bold;">{$translate.customer}:</span> 
                                                                        <input type="checkbox" class="checkbox" name="repl_infocus" value="radio" id="repl_infocus" onchange="loadEmployeesForReplacement();" checked="checked">
                                                                        <span id="spn_replace_customer"></span>
                                                                    </div>
                                                                    <input type="hidden" name="slot_customer" class='slot_customer' value="" />
                                                                    <input type="hidden" name="slot_employee" class='slot_employee' value="" />
                                                                </div>
                                                                <div class="form-section-highlight">
                                                                    <div class="row-fluid">
                                                                        <div class="form-group">
                                                                            <div class="input-prepend date hasDatepicker datepicker" id="replace_emp_date_from_div">
                                                                                <span class="add-on icon-calendar"></span>
                                                                                <input type="text" placeholder="{$translate.from_date}" id="replace_emp_date_from" name="replace_emp_date_from" {*onblur="loadEmployeesForReplacement();"*} class="form-control span12">
                                                                            </div>
                                                                            <div class="input-prepend date datepicker" id="replace_emp_date_to_div">
                                                                                <span class="add-on icon-calendar"></span>
                                                                                <input type="text" placeholder="{$translate.to_date}" id="replace_emp_date_to" name="replace_emp_date_to" {*onblur="loadEmployeesForReplacement();"*} class="form-control span12">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <h4>{$translate.replacer_employees}</h4>
                                                                    <div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>
                                                                </div>
                                                            </div>
                                                            <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                                                                <button type="button" class="btn btn-success span6" id="btnReplaceEmpMultiple" onclick="saveReplaceMultipleConfirm();"><span class="icon-save"></span> {$translate.replace}</button>
                                                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.close}</button>
                                                            </div>
                                                        </div>
                                                    {/if}

                                    {*                sms section*}
                                                    {if $login_user_role eq 1}
                                                        <div id="sms-for-emp-allocation" class="manage-form span12 hide">
                                                            <div class="span12">
                                                                <h4 style="margin-top:20px;font-weight: bold;">{$translate.sms}</h4>
                                                                <hr>
                                                                <div class="form-section-highlight">

                                                                    <h4>{$translate.replacement_employee}</h4>
                                                                    <input type="hidden" name="slot_ids" class="slot_ids" value="" />
                                                                    <select multiple="multiple" class="form-control span11 send_employees_list_sms" id="send_employees_list_sms" name="send_employees_list_sms"></select>
                                        {*                            <div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>*}

                                                                    <div class="row-fluid">
                                                                        <div style="margin: 5px 0px 0px;" class="span12">
                                                                            <label class="checkbox confirmation_slot" style="padding: 0px;">
                                                                                <input type="checkbox" style="margin-right: 4px !important;" value="" onclick="manageSmsAllotmentConf()" class="checkbox" name="chk_confirmation_allotment"> {$translate.confirmatoin}
                                                                            </label>
                                                                            <label class="checkbox confirmation_slot" style="padding: 0px;">
                                                                                <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_rejection_allotment"> {$translate.send_rejection}
                                                                            </label>
                                                                            <label class="checkbox confirmation_slot" style="padding: 0px;">
                                                                                <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_sender_allotment"> {$translate.confirmation_to_sender}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                                                                <button type="button" class="btn btn-success span6" id="btnEmpAllotSMS" onclick="sendSmsForAllotment()"><span class="icon-save"></span> {$translate.send}</button>
                                                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                    {/if}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid"></div>
        </div>
    </div>
</div>

{/block}

{block name='script'}
    <script src="{$url_path}js/date-picker.js"></script>
    <script src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
    <script src="{$url_path}js/bootbox.js"></script>
    <script src="{$url_path}js/plugins/notifications/Gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.stickyPanel.js"></script>
    <script type="text/javascript">
        //didn't remove this js block from this location
        $(function(){
            $.contextMenu( 'destroy' );
        });
    </script>
    <script type="text/javascript" src="{$url_path}js/jquery.contextmenu.js"></script>
    <script type="text/javascript">
        
        var json_employees_to_assign = {$json_employees_to_assign};
        //console.log(json_employees_to_assign);
        $(document).ready(function() {
            $('.alert-dismissable').delay(60000).fadeOut();
            
            $('#tb_assign_emp_list, #tb_create_slot, #tb_mem_slots').click(function(){
                $.cookie("day_view_active_side_tab", $(this).attr('id'), { path: '/', expires: 1});
            });
                
            if($(window).height() > 600){
                $('.slots-full-view-body').css({ height: Math.max($(window).innerHeight()- ($('.slots-full-view-body').length > 0 ? $('.slots-full-view-body').offset().top : 0), 250) });
                $(window).resize(function(){
                    $('.slots-full-view-body').css({ height: Math.max($(window).innerHeight()- ($('.slots-full-view-body').length > 0 ? $('.slots-full-view-body').offset().top : 0), 250) });
                });
            }
            
            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
            });
            
            //replace ',' => '.' while entering time
            $(document).off('keyup', "#sdTFrom, #sdTTo, #leave_time_from, #leave_time_to, #split_slot_timefrom, #split_slot_timeto,\n\
                #new_slot_from, #new_slot_to, .slot_from, .slot_to")
                .on('keyup', "#sdTFrom, #sdTTo, #leave_time_from, #leave_time_to, #split_slot_timefrom, #split_slot_timeto,\n\
                    #new_slot_from, #new_slot_to, .slot_from, .slot_to", function(e) {
                        // get keycode of current keypress event
                        var code = (e.keyCode || e.which);

                        // do nothing if it's an arrow key
                        if(code == 37 || code == 38 || code == 39 || code == 40) {
                            return;
                        }
                        var this_val = $(this).val();
                        var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                        $(this).val(new_val);
            });
            
            $(".slot-day:not(.donot_show_slot)").click(function() {
                close_right_panel(false);
                $("#slot_details_main_wraper_group").removeClass('hide');
                $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
                
                //---------------add data-----------------------
                var slot_data       = $(this).find('.slot_details_hub');
                var slot_id         = slot_data.attr('data-id');
                var slot_date       = slot_data.attr('data-date');
                var slot_timefrom   = $.trim(slot_data.attr('data-time-from'));
                var slot_time_to    = $.trim(slot_data.attr('data-time-to'));
                var slot_customer_id= slot_data.attr('data-customer-id');
                var slot_employee_id= slot_data.attr('data-employee-id');
                var slot_fkkn       = slot_data.attr('data-fkkn');
                var slot_type       = slot_data.attr('data-type');
                var slot_status     = slot_data.attr('data-status');
                var slot_signed     = slot_data.attr('data-signed') == 1 ? true : false;
				
                $('html, body').animate({
                    scrollTop: $("#slot-wrpr-slots").offset().top
                }, 3000);
			
                $('#slot_details_main_wraper_group #sdID').val(slot_data.attr('data-id'));  //id
                //$('#slot_details_main_wraper_group #sdDate').val(slot_data.attr('data-date'));  //date
                $('#slot_details_main_wraper_group #slot_details_date').datepicker('update', slot_data.attr('data-date'));  //date
                $('#slot_details_main_wraper_group #sdTFrom').val(slot_data.attr('data-time-from'));  //from-time
                $('#slot_details_main_wraper_group #sdTTo').val(slot_data.attr('data-time-to'));  //from-time
                $('#slot_details_main_wraper_group #sdEmployeeID').val(slot_data.attr('data-employee-id'));  //employee-id
                $('#slot_details_main_wraper_group #sdEmployee').html(slot_data.attr('data-employee-name'));  //employee-name
                
                $('#slot_details_main_wraper_group #sdFKKN').val(slot_data.attr('data-fkkn'));  //fkkn
                $('#slot_details_main_wraper_group #sdComment').val(slot_data.attr('data-comment'));  //comment
                
                $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon').removeClass("active").css("display", 'none');
                $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon-type-'+slot_data.attr('data-type')).addClass("active").css("display", 'block');
                
                
                //set actual slot values to hidden fields
                $('#slot_details_main_wraper_group #this_slot_actual_date').val(slot_date);
                $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val(slot_timefrom);
                $('#slot_details_main_wraper_group #this_slot_actual_timeto').val(slot_time_to);
                $('#slot_details_main_wraper_group #this_slot_actual_customer').val(slot_customer_id);
                $('#slot_details_main_wraper_group #this_slot_actual_employee').val(slot_employee_id);
                $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val(slot_data.attr('data-employee-name'));
                $('#slot_details_main_wraper_group #this_slot_actual_fkkn').val(slot_fkkn);
                $('#slot_details_main_wraper_group #this_slot_actual_type').val(slot_type);
                
                $('.karense_label').html('{$translate.karense} - '+slot_data.attr('data-employee-name'));
                
                var slot_details_obj = { 'slot_id': slot_id,
                                'slot_date': slot_date,
                                'slot_timefrom': slot_timefrom,
                                'slot_time_to': slot_time_to,
                                'slot_customer_id': slot_customer_id,
                                'slot_employee_id': slot_employee_id};
                
                {if $privileges_gd.candg_approve eq 1}
                    //hide candg action buttons
                    $('#slot_details_main_wraper_group #candg_action_btn_group').addClass('hide');
                {/if}
                
                //block all features as first time
                $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom,\n\
                    #slot_details_main_wraper_group #sdTTo, #slot_details_main_wraper_group #sdCustomer,\n\
                    #slot_details_main_wraper_group #sdFKKN, #slot_details_main_wraper_group #sdComment').attr('disabled', 'disabled');
    
                $('#slot_action_buttons, #btn_slot_details_save').addClass('hide');//#btn_direct_lock_slot
                $('#slot_details_main_wraper_group #sdTypes').addClass('disabled_types');   //to disable open event of slot types
                $('#slot_details_main_wraper_group #sdTypes').removeClass('can_change');   //to disable open event of slot types

                //check privileges to slot_action_buttons
                $('#btn_slot_franvaro, #btn_slot_copy, #btn_slot_swap_copy, #btn_slot_swap, #btn_slot_delete, #btn_slot_split, #btn_slot_copy_multiple').addClass('hide');  //hide all action button as first
                
                {if $privileges_gd.add_slot eq 1}
                    //clone leave relation slot
                    $('#slot_details_main_wraper_group #clone_leave_action_btn_group').addClass('hide');
                {/if}
                //leave details 
                var slot_leave_data = { };
                if(slot_status == 2){
                    slot_leave_data       = $(this).find('.slot_leave_details_hub');
                }
                
                //block edit of signed/leave/candg slots
                if(slot_signed || slot_status == 2 || slot_status == 4){
                    //customer section
                    $('#slot_details_main_wraper_group #sdCustomer').val((slot_data.attr('data-customer-id') !== '' ? slot_data.attr('data-customer-id') : ''));
                    
                    {if $privileges_gd.candg_approve eq 1}
                        if(slot_status == 4 && slot_employee_id != ''){
                            $('#slot_details_main_wraper_group #candg_action_btn_group').removeClass('hide');
                            $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                        }
                    {/if}
                        
                    if(slot_status == 2){
                        {if $privileges_gd.add_slot eq 1}
                            if(slot_leave_data.attr('data-leave-is-exist-relation') == '0')
                                $('#slot_details_main_wraper_group #clone_leave_action_btn_group').removeClass('hide');
                        {/if}
                    }
                }
                else{
                    wrapLoader('#slot_details_main_wraper_group');
                    $.ajax({
                        url:"{$url_path}ajax_alloc_action_month.php",
                        type:"POST",
                        dataType: 'json',
                        data: { action: 'check_slot_credentials', 'slot_id': slot_id},
                        success:function(data){
                            //console.log(data);
                            {if $privileges_gd.leave eq 1}
                                if(slot_employee_id != '' && data.tl_flag && slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17)
                                    $('#btn_slot_franvaro').removeClass('hide');
                            {/if}
                            
                            {if $privileges_gd.copy_single_slot eq 1}
                            if(data.tl_flag)
                                $('#btn_slot_copy').removeClass('hide');
                            {/if}
                            
                            {if $privileges_gd.delete_slot eq 1}
                                if(data.tl_flag)
                                    $('#btn_slot_delete').removeClass('hide');
                            {/if}
                            
                            {if $privileges_gd.split_slot eq 1}
                                if(data.tl_flag)
                                    $('#btn_slot_split').removeClass('hide');
                            {/if}
                            
                            {if $privileges_gd.copy_single_slot_option eq 1}
                                if( (slot_employee_id != '' || slot_customer_id != '') && data.tl_flag)
                                    $('#btn_slot_copy_multiple').removeClass('hide');
                            {/if}
                            
                            
                            var privileges_change_time = '{$privileges_gd.change_time}';
                            if( privileges_change_time == '1' && data.tl_flag)
                                $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo').removeAttr('disabled');
                            
                            var privileges_fkkn     = '{$privileges_gd.fkkn}';
                            var loggedin_userrole   = '{$login_user_role}';
                            var loggedin_user       = '{$login_user}';
                            if( privileges_fkkn == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3')))
                                $('#slot_details_main_wraper_group #sdFKKN').removeAttr('disabled');
                            
                            var privileges_add_customer     = '{$privileges_gd.add_customer}';
                            var privileges_remove_customer  = '{$privileges_gd.remove_customer}';
                            $('#slot_details_main_wraper_group #sdCustomer').val((slot_customer_id !== '' ? slot_customer_id : ''));
                            if( (privileges_add_customer == '1' || privileges_remove_customer == '1') && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3'))){
                                $('#slot_details_main_wraper_group #sdCustomer').removeAttr('disabled');
                            }

                            var privileges_slot_type = '{$privileges_gd.slot_type}';
                            if( privileges_slot_type == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3'))){
                                $('#slot_details_main_wraper_group #sdTypes').removeClass('disabled_types');
                                $('#slot_details_main_wraper_group #sdTypes').addClass('can_change');   //to disable open event of slot types
                            }
                            
                            {if $login_user_role neq 3}
                                $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                                $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');  // #btn_direct_lock_slot
                            {else}
                                if(slot_employee_id == loggedin_user || slot_employee_id ==''){
                                    $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                                }
                                
                                if(slot_employee_id == loggedin_user ||
                                    (privileges_change_time == '1' && data.tl_flag) ||
                                    (privileges_add_customer == '1' || privileges_remove_customer == '1') ||
                                    privileges_slot_type == '1'){
                                        $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');
                                }
                                
                            {/if}
                        }
                    }).always(function(data) { 
                        uwrapLoader('#slot_details_main_wraper_group');
                        $('#slot_details_main_wraper_group #sdTFrom').focus();
                    });
                }
                
                $('#Franvaro-box #leave_type_val').val('');
                $('.no_pay_sick_check_div').addClass('hide');
                
            });
            
            $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo, \n\
            #slot_details_main_wraper_group #sdCustomer, #slot_details_main_wraper_group #sdFKKN, #slot_details_main_wraper_group #sdComment').keypress(function(e) {
                if(e.which == 13) {
                    if(!$('#slot_details_main_wraper_group .slot-wrpr-buttons #btn_slot_details_save').hasClass('hide'))
                        modify_slot_details();
                }
            });

            $(".slot-confirm-buttons").click(function() {
                close_right_panel(true);
            });
            
            /*Franvaro*/
            $("#btn_slot_franvaro").click(function() {
                $("#kopierapass-box, #slot-dela-pass").addClass('hide');
                $('#karense_notify').html('');
                $('#Franvaro-box').find('.btn-group.leave-type').find('.btn').removeClass('active');
                //load leave replacement employees
                if($("#Franvaro-box").hasClass('hide')){
                    //var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                    $('#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day').datepicker('update', slot_date);
                    $('#Franvaro-box #dp_leave_date_from, #Franvaro-box #dp_leave_date_to, #Franvaro-box #dp_leave_date_day').datepicker('update', slot_date);

                    $("#Franvaro-box #leave_time_from").val(slot_timefrom);
                    $("#Franvaro-box #leave_time_to").val(slot_timeto);
                    {if $login_user_role neq 3}
                        load_replacement_employees('get_for_2_modes');
                    {/if}
                }
                $("#Franvaro-box").toggleClass('hide');
                if(!$("#Franvaro-box").hasClass('hide')){
                    $('.slot-edit-view .slots-full-view-body').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
                
            });

            $("#Franvaro-box-close").click(function() {
                $("#Franvaro-box").addClass('hide');
            });

            /*kopiera pass*/
            $("#btn_slot_copy_multiple").click(function() {
                $("#Franvaro-box, #slot-dela-pass").addClass('hide');
                
                //load slot from week- to week as default
                if($("#kopierapass-box").hasClass('hide')){
                    var slot_date   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var cur_week    = date('W',  strtotime(slot_date));
                    $("#kopierapass-box #slot_copy_multiple_from_wk").val(parseInt(cur_week));
                    getAfterDates_for_slotcopy_multiple();
                    
                    var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    
                    if(slot_employee != ''){
                        $('#kopierapass-box #lbl_copy_slot_with_user').removeClass('hide');
                        $('#kopierapass-box #slot_copy_multiple_withuser').attr('checked', 'checked');
                    }else
                        $('#kopierapass-box #lbl_copy_slot_with_user').addClass('hide');
                    
                    if(slot_customer != ''){
                        $('#kopierapass-box #lbl_copy_slot_without_user').removeClass('hide');
                        if(slot_employee == ''){
                            $('#kopierapass-box #slot_copy_multiple_withoutuser').attr('checked', 'checked');
                        }
                    }else
                        $('#kopierapass-box #lbl_copy_slot_without_user').addClass('hide');
                }
                $("#kopierapass-box").toggleClass('hide');
                if(!$("#kopierapass-box").hasClass('hide')){
                    $('.slot-edit-view .slots-full-view-body').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
            });

            $("#kopierapass-box-close").click(function() {
                $("#kopierapass-box").addClass('hide');
            });
            
            $("#btn_slot_split").click(function() {
                $("#Franvaro-box, #kopierapass-box").addClass('hide');
                
                //load slot timefrom - timeto as default
                if($("#slot-dela-pass").hasClass('hide')){
                    var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                    
                    $("#slot-dela-pass #split_slot_timefrom").val(slot_timefrom);
                    $("#slot-dela-pass #split_slot_timeto").val(slot_timeto);
                }
                
                $("#slot-dela-pass").toggleClass('hide');
                if(!$("#slot-dela-pass").hasClass('hide')){
                    $('.slot-edit-view .slots-full-view-body').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
            });
            
            $("#slot-dela-pass-close").click(function() {
                $("#slot-dela-pass").addClass('hide');
            });
            
            $(".m_check, .all_check_day, .all_check_week, .no-default-action").click(function(e){
                e.stopPropagation();
            });
            
            $(document).off('click', ".slot-icons-day.can_change .slot-icon").on('click', ".slot-icons-day.can_change .slot-icon", function() {
                $(".slot-icons-day").css('width', 'auto');
                $(".slot-icons-day").css('height', 'auto');
                $(".slot-icons-day").css('overflow', 'block');
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon').css("display", 'block');
            });
            $(document).off('dblclick', ".slot-icons-day .slot-icon").on('dblclick', ".slot-icons-day .slot-icon", function() {
                $(".slot-icons-day").css('width', '27px');
                $(".slot-icons-day").css('height', '30px');
                $(".slot-icons-day").css('overflow', 'hidden');
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon:not(.active)').css("display", 'none');
            });
            $(document).off('click', ".single-slot-icon-list li.slot-icon").on('click', ".single-slot-icon-list li.slot-icon", function() {
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon').removeClass("active");
                $(this).addClass("active");
            });

            //change event of customer combo box
            $("#cmb_employee").change(function(){
                var selected_employee = $.trim($(this).val());
                if(selected_employee != ''){
                    navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$cur_date}&employee='+selected_employee+'&emp_alloc={$emp_alloc}',1);
                }
            });
            
        });
        
        function close_right_panel(show_default){
            
            if(typeof show_default === 'undefined')
                show_default = true;
            
            if(show_default == true){
                $('#tab_emp_slotcreate_memoryslots_sections').removeClass('hide');
            } else {
                $('#tab_emp_slotcreate_memoryslots_sections').addClass('hide');
            }
            
            $("#slot_details_main_wraper_group").addClass('hide');
            $("#right_click_action_options").addClass('hide');
            $("#leave_edit_wrpr").addClass('hide');
            $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
            $("#change-employee-customer-options, #replace-employee-week-basis, #sms-for-emp-allocation, #goto-customers-options, #goto-employees-options,#change_time_of_slots").addClass('hide');
        }
        
        function clicked_tab_create_slots(){
            close_right_panel();
            $("#slot_creation_main_wraper_group").removeClass('hide');
            $(".add-new-slots-month .create-slotes-panel").html(get_slot_add_theme());
            $(".add-new-slots-month").removeClass('hide');
            setTimeout(function() {
                $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
            }, 700);
        }
        
        function clicked_tab_memory_slots(){
            close_right_panel();
            $("#slot_creation_main_wraper_group").removeClass('hide');
            $("#memory-slots").removeClass('hide');
        }
            
        function reload_content(data_values){
            var passing_data_object = { };
            if(typeof data_values !== 'undefined')
                passing_data_object = data_values;
            
            navigatePage('{$url_val_reload}',1, passing_data_object);
        }

        function modify_slot_details(){
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom   = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to    = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_customer_id= $('#slot_details_main_wraper_group #sdCustomer').val();
            var slot_employee_id= $('#slot_details_main_wraper_group #sdEmployeeID').val();
            var slot_fkkn       = $('#slot_details_main_wraper_group #sdFKKN').val();
            var slot_comment    = $('#slot_details_main_wraper_group #sdComment').val();
            var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
            
            var old_customer_id = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
            var old_time_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
            var old_time_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
            
            slot_timefrom = time_to_sixty(slot_timefrom);
            slot_time_to = time_to_sixty(slot_time_to);
            if(slot_time_to == 0) slot_time_to = 24;

            var slot_details_obj = { 'slot_id': slot_id,
                                'slot_date': slot_date,
                                'slot_timefrom': slot_timefrom,
                                'slot_time_to': slot_time_to,
                                'slot_customer': slot_customer_id,
                                'slot_employee': slot_employee_id,
                                'slot_type': slot_type,
                                'slot_fkkn': slot_fkkn,
                                'slot_comment': slot_comment,
                                'action': 'modify_slot',
                                'req_from': 'employee_alloc_window'
                    };
            
            // if(slot_timefrom != old_time_from || slot_time_to != old_time_to){
            if(slot_customer_id != '' && (slot_customer_id != old_customer_id || slot_timefrom != old_time_from || slot_time_to != old_time_to)){
                var url_atl = slot_details_params =  serialize_json_as_url(slot_details_obj);
                var base_url = '{$url_path}ajax_alloc_action_month.php?';
                check_atl_warning(url_atl, function(this_url){ 
                                                    //navigatePage(this_url,1, main_obj);
                                                    wrapLoader('#slot_details_main_wraper_group');
                                                    $.ajax({
                                                        url:this_url,
                                                        type:"POST",
                                                        data:slot_details_obj,
                                                        success:function(data){
                                                            close_right_panel();
                                                            reload_content();
                                                        }
                                                    }).always(function(data) { 
                                                        uwrapLoader('#slot_details_main_wraper_group');
                                                    });
                                }, base_url);
            }
            else{
                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                        reload_content();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
            //console.log(slot_details_obj);
        }
        
        {if $privileges_gd.candg_approve eq 1}
            function acceptCandGSlot(){
                bootbox.dialog( '{$translate.confirm_approval_candg}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                            var textarea_value = $("#slot_details_main_wraper_group #sdComment").val();
                             $.ajax({ 
                                async:true,
                                cache: true,
                                url:"{$url_path}ajax_alloc_action_slot.php",
                                data: 'id='+slot_id+'&action=slot_approve_candg_new&comment_text='+textarea_value,
                                type:"POST",
                                success:function(data){
                                    if(data == 'sucess'){
                                        close_right_panel();
                                        reload_content();
                                    }
                                }
                            });
                        }
                }]);
             }
        {/if}

        {if $privileges_gd.add_slot eq 1}
            function clone_relation_leave_slot(){
                bootbox.dialog( '{$translate.confirm_clone_leave_relation}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                            var url = '{$url_val}&slotid='+slot_id+'&action=clone_leaveslot';
                            navigatePage(url, 1);
                        }
                }]);
             }
        {/if}

        function check_all_work_slots(){
            //var tmp = '';
            var count = 0;
            $('#slot_display_wraper .slot-theme-incomplete input:checkbox.get_slot_check').each(function(index, element) {
                    count ++;
                    $(this).attr('checked','checked');
                    var num = $(this).attr('data-slot-no');
                    var slot_range = $(this).attr('data-slot-time-range');
                    var sID = $(this).val();
            });
            $('#slot_display_wraper .slot-day:not(.slot-theme-incomplete) input:checkbox.get_slot_check').each(function(index, element) {
                    count ++;
                    $(this).attr('checked','checked');
            });
            //<div class="option_head" style="height: 20px;">{$translate.assigned_slots} <a href="javascript:void(0);" class="btn_add_worker" style="float: right;" onclick="check_all_work_slots()">{$translate.check_all}</a></div>
            if(count > 0)
                $('.day-slot-wrpr-header-right #mark_all').attr('onclick', 'uncheck_all_work_slots()').html('{$translate.uncheck_all}');
            
            close_right_panel();
            $('#tb_assign_emp_list').trigger('click');
        }
        
        function uncheck_all_work_slots(){
            var count = 0;
            $('#slot_display_wraper .slot-theme-incomplete input:checkbox.get_slot_check').each(function(index, element) {
                    count ++;
                    $(this).prop('checked','');
                    var num = $(this).attr('data-slot-no');
                    var slot_range = $(this).attr('data-slot-time-range');
                    var sID = $(this).val();
            });
            $('#slot_display_wraper .slot-day:not(.slot-theme-incomplete) input:checkbox.get_slot_check').each(function(index, element) {
                    count ++;
                    $(this).prop('checked','');
            });
            if(count > 0)
                $('.day-slot-wrpr-header-right #mark_all').attr('onclick', 'check_all_work_slots()').html('{$translate.check_all}');
            
            $('#tb_assign_emp_list').trigger('click');
        }
        
        function cust_assign_slot(num,slot,slot_id){
            console.log('abc');
            close_right_panel();
            $('#tb_assign_emp_list').trigger('click');
        }
        
        function loadPopupSchemaCustomerAssignment(url) {
            var slots_array = $('#slot_display_wraper .slot-theme-incomplete input:checkbox:checked.get_slot_check').map(function () {
                        return $(this).attr('data-slot-time-range');
                    }).get();
                    
            var over_lap = 0;

            for(var i=0;i<slots_array.length;i++){
                var check = slots_array[i].split("-");
                for(var j=i+1;j<slots_array.length;j++){
                       var slots_check = slots_array[j].split("-");
                       if((parseFloat(check[0]) >= parseFloat(slots_check[0]) && parseFloat(check[0]) <  parseFloat(slots_check[1])) ||(parseFloat(check[1]) > parseFloat(slots_check[0]) && parseFloat(check[1]) <=  parseFloat(slots_check[1])) || (parseFloat(check[0]) < parseFloat(slots_check[0]) && parseFloat(check[1]) >  parseFloat(slots_check[1]) ) ){
                            over_lap = 1;
                            break;
                       }
                }
                if(over_lap == 1)
                    break;
            }

            if(slots_array.length == 0){
                alert("{$translate.select_one_slot}");
            }else if(over_lap == 1){
                alert("Slots Overlapped");
            }else{
                var multi_slot_ids = $('#slot_display_wraper .slot-theme-incomplete input:checkbox:checked.get_slot_check').map(function () {
                        return this.value;
                    }).get().join(',');

                url += "&ids=" + multi_slot_ids;
                var full_url = '{$url_path|cat:'ajax_alloc_action.php?'}'+url;
                var atl_req_data = url+"&multi=1&type_check=1";
                check_atl_warning(atl_req_data, function(this_url){ 
                                    navigatePage(this_url, 1);
                                }, full_url, "#main_content #external_wrapper");
            }
        }
        
        function openCreateNewSlotPanel(){
            $('#tb_create_slot').trigger('click');
            $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
        }
    </script>
    
{*    leave scripts*}
    <script>

        function update_leave_status(url_data , flag){
            //flag == 1 -> accept, flag == 2 -> reject
            var delete_flag;
            if (flag == 1){
                bootbox.dialog('{$translate.do_u_want_approve_leave}', [
                {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    
                },
                {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        update_leave_status_proceed(url_data, flag);
                    }
                }
                 
            ]); 
            }
            else if (flag == 2){
                bootbox.dialog('{$translate.do_u_want_reset_substitute_slots}', [
                {
                    "label" : "{$translate.cancel}",
                    "class" : "btn-primary",
                },
                {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                        delete_flag = 0;
                        update_leave_status_proceed(url_data, flag, delete_flag);
                    }
                    
                 },
                 {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        delete_flag = 1;
                        update_leave_status_proceed(url_data, flag, delete_flag);
                    }
                 }
                 
                ]);
            }
            return false;
        }


        function update_leave_status_proceed(url_data, flag , delete_flag = undefined ){
            if(flag == 2){
                url_data = url_data + "&vikarie_delete="+delete_flag;
            }
            wrapLoader("#main_content #external_wrapper");
            $.ajax({
                async:false,
                url:"{$url_path}ajax_gdschema_alloc_update_leave_status.php",
                data:url_data,
                type:"POST",
                success:function(data){
                            uwrapLoader("#main_content #external_wrapper");
                            //$("#process_area").html(data);
                            reload_content();
                        }
            });
        }
        
        function edit_leave_slot(this_obj){
            close_right_panel(false);
            $("#leave_edit_wrpr").removeClass('hide');
            
            var slot_data       = $(this_obj).parents('.slot-day').find('input.slot_details_hub');
            var slot_id         = slot_data.attr('data-id');
            var slot_date       = slot_data.attr('data-date');
            var slot_employee_id= slot_data.attr('data-employee-id');
            var slot_employee_name= slot_data.attr('data-employee-name');
            
            var slot_leave_data = $(this_obj).parents('.slot-day').find('input.slot_leave_details_hub');
            var leave_id        = slot_leave_data.attr('data-leave-id');
            var leave_time_from   = slot_leave_data.attr('data-leave-time-from');
            var leave_time_to   = slot_leave_data.attr('data-leave-time-to');
                
            $('#leave_edit_wrpr .leave_taken_employee_name').html(slot_employee_name);
            $('#leave_edit_wrpr .leave_taken_date').html(slot_date);
            $('#leave_edit_wrpr #unsick_time_from').val(leave_time_to);
            $('#leave_edit_wrpr #hdn_unsick_leave_id').val(leave_id);
            $('#leave_edit_wrpr #hdn_unsick_slot_id').val(slot_id);
            $('#leave_edit_wrpr #hdn_unsick_employee_id').val(slot_employee_id);
            $('#leave_edit_wrpr #hdn_unsick_leave_date').val(slot_date);
            $('#leave_edit_wrpr #hdn_unsick_time_from').val(leave_time_from);
            $('#leave_edit_wrpr #hdn_unsick_time_to').val(leave_time_to);
            return false;
        }
        
        function edit_leave_slotConfirm(){
            var toval = parseFloat($('#leave_edit_wrpr #unsick_time_from').val());
            if(toval == 0 || toval == 24 ){
                alert('Enter Time except 0 & 24');
            }else if($('#leave_edit_wrpr #unsick_time_from').val() != ''){
                bootbox.dialog( '{$translate.confirm_back_to_work}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id         = $('#leave_edit_wrpr #hdn_unsick_slot_id').val();
                            var leave_id        = $('#leave_edit_wrpr #hdn_unsick_leave_id').val();
                            var leave_employee  = $('#leave_edit_wrpr #hdn_unsick_employee_id').val();
                            var leave_date      = $('#leave_edit_wrpr #hdn_unsick_leave_date').val();
                            var leave_time_from = $('#leave_edit_wrpr #hdn_unsick_time_from').val();
                            var leave_time_to   = $('#leave_edit_wrpr #hdn_unsick_time_to').val();

                            var process_details_obj = { 'slotid': slot_id,
                                            'id': leave_id,
                                            'employee': leave_employee,
                                            'date': leave_date,
                                            't_from': leave_time_from,
                                            't_to': leave_time_to,
                                            'status': '-1',
                                            'edited_from': $('#leave_edit_wrpr #unsick_time_from').val()};
                            //console.log(process_details_obj);
                            wrapLoader("#leave_edit_wrpr");
                            $.ajax({
                                url:"{$url_path}ajax_gdschema_alloc_update_leave_status.php",
                                type:"POST",
                                //dataType: "json",
                                data:process_details_obj,
                                success:function(data){
                                        close_right_panel();
                                        reload_content();
                                },
                                error: function (xhr, ajaxOptions, thrownError){
                                    alert(thrownError);
                                }
                            }).always(function(data) {
                                uwrapLoader("#leave_edit_wrpr");
                            });
                        }
                }]);
            }else{
                alert('Please Enter Time');
                $('#leave_edit_wrpr #unsick_time_from').focus();
            }
        }
        
        function cancel_leave_slot(this_obj){
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var slot_time_from  = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
            var slot_time_to    = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

            var splitted_slot_start_time = slot_time_from.split('.');

            var today_date_time = strtotime('{$today_date} 00:00:00'+ ' -90 days');
            var slot_start_date_time = strtotime(slot_date+" "+splitted_slot_start_time[0]+":"+splitted_slot_start_time[1]+":00");
            var minute_diff = Math.round((today_date_time - slot_start_date_time) / 60);
            var is_past_slot = minute_diff > 0 ? true : false;

            if(is_past_slot){
                bootbox.alert('{$translate.date_is_passed_cant_cancel_leave}', function(result){  });
            }
            else{
                bootbox.dialog( '{$translate.confirm_cancel_leave}', [{
                            "label" : "{$translate.no}",
                            "class" : "btn-danger"
                        }, {
                            "label" : "{$translate.yes}",
                            "class" : "btn-success",
                            "callback": function() {
                                var slot_data       = $(this_obj).parents('.slot-day').find('input.slot_details_hub');
                                var slot_id         = slot_data.attr('data-id');
                                var slot_date       = slot_data.attr('data-date');
                                var slot_employee_id= slot_data.attr('data-employee-id');
                                var slot_time_from  = slot_data.attr('data-time-from');
                                var slot_time_to    = slot_data.attr('data-time-to');

                                var slot_leave_data = $(this_obj).parents('.slot-day').find('input.slot_leave_details_hub');
                                var leave_id        = slot_leave_data.attr('data-leave-id');
                                var leave_group_id  = slot_leave_data.attr('data-leave-group-id');
                                var leave_time_from = slot_leave_data.attr('data-leave-time-from');
                                var leave_time_to   = slot_leave_data.attr('data-leave-time-to');

                                var process_details_obj = { 'action': 'leave_slot_remove',
                                                        'leave_id': leave_id,
                                                        'gid': leave_group_id,
                                                        'slot_id': slot_id,
                                                        'employee': slot_employee_id,
                                                        'date': slot_date,
                                                        'tfrom': slot_time_from,
                                                        'tto': slot_time_to };

                                bootbox.dialog( '{$translate.do_you_want_to_reset_substitute_slots} <br/><br/>{$translate.note_shortcode} {$translate.date_passed_substitute_slots_cant_remove|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_2|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_3|replace:"'":"\'"}', [{
                                    "label" : "{$translate.cancel}",
                                    "class" : "btn-primary"
                                }, {
                                    "label" : "{$translate.btn_leave_substitute_reset_no}",
                                    "class" : "btn-danger",
                                    "callback": function() {
                                        process_details_obj.vikarie_delete = '0';
                                        cancel_leave_slot_confirm(process_details_obj)
                                    }
                                }, {
                                    "label" : "{$translate.btn_leave_substitute_reset_yes}",
                                    "class" : "btn-success",
                                    "callback": function() {
                                        process_details_obj.vikarie_delete = '1';
                                        cancel_leave_slot_confirm(process_details_obj)
                                    }
                                }]);
                            }
                        }]);
            }
        }
        
        function cancel_leave_slot_confirm(process_details_obj){
            wrapLoader("#main_content #external_wrapper");
            $.ajax({
                async:false,
                url:"{$url_path}mc_leave_popup.php",
                data:process_details_obj,
                dataType: 'json',
                type:"POST",
                success:function(data_process){
                            if(data_process.process_result){    //excute if successfully done transactions
                                    reload_content();
                                } else if(typeof data_process.message !== "undefined" && data_process.message != '' && data_process.message != null) {
                                    $('#left_message_wraper').html(data_process.message).removeClass('hide');
                                    $('.main-left').animate({
                                        scrollTop: 0
                                    });
                                } else {
                                    reload_content();
                                }
                        }
            }).always(function(data) { 
                uwrapLoader("#main_content #external_wrapper");
            });
        }

        function cloneLeaveSlot(slot_id){
            var url = '{$url_val}&slotid='+slot_id+'&action=clone_leaveslot';
            navigatePage(url, 1);
        }
        
        function setLeaveType(val) {
            $('#leave_type_val').val(val);
            check_is_karense_day();
            if(val == 1)
                $('.no_pay_sick_check_div').removeClass('hide');
            else
                $('.no_pay_sick_check_div').addClass('hide');
        }
        
        function check_is_karense_day(){
            var leave_type          = $('#Franvaro-box #leave_type_val').val();
            var no_pay_check_value  = 0;
            if(leave_type == 1){
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var employee        = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                var leave_type_day  = $('#Franvaro-box #leave_type_day').val();
                var leave_date      = '';
                var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_day' : leave_type_day };

                {*leave on between date*}
                if (leave_type_day == '1') {
                    leave_date = $('#leave_date_from').val();

                    url_data_obj['date'] = leave_date;
                    url_data_obj['leave_taken_beween'] = 'dates';

                    var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                    if(no_pay_check) no_pay_check_value = 1;

                }
                else if (leave_type_day == '2') { {*leave on time*}
                    leave_date          = $('#Franvaro-box #leave_date_day').val();
                    var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                    var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                    url_data_obj['date'] = leave_date;
                    url_data_obj['leave_taken_beween'] = 'time';
                    url_data_obj['leave_time_from'] = leave_time_from;
                    url_data_obj['leave_time_to'] = leave_time_to;

                    var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                    if(no_pay_check) no_pay_check_value = 1;
                }
                url_data_obj['slot_type'] = $("#sdTypes li").filter('.active').attr('data-value');
                url_data_obj['time_from'] = $("#sdTFrom").val();
                $.ajax({
                    url: "{$url_path}ajax_check_karense_exist.php",
                    type: "POST",
                    dataType: 'json',
                    data: $.param(url_data_obj),
                    success:function(data){
                       // console.log(data);
                        $('#karense_notify').html('');
                        if(data.transaction == true){
                            /*if(data.karense == true){
                                if(no_pay_check_value == 1){
                                    $('#karense_notify').hide().html('<div class="message">{$translate.karense_included}</div>').fadeIn('slow');
                                }
                                else{
                                    $('#karense_notify').hide().html('<div class="message">{$translate.karense_not_included}</div>').fadeIn('slow');
                                }
                                $('.no_pay_sick_check_div').show();
                            } else{
                                $('#karense_notify').hide().html('<div class="message">{$translate.karense_not_possible}'+data.karense_date+'</div>').fadeIn('slow');
                                $('.no_pay_sick_check_div').hide();
                                
                            }*/
                            if(typeof data.karense != "undefined" && data.karense !== false && typeof data.karense.karens != "undefined" && data.karense.karens > 0){
                                $('#karense_notify').hide().html('<div class="message">{$translate.total_karense_deduction}: '+data.karense.deduction+' {$translate.hour_short}<br/>{$translate.deduction_sick_day}: '+data.karense.karens+' {$translate.hour_short}('+data.karense.remaining+' {$translate.hour_short})</div>').fadeIn('slow');
                                $('#date_no_pay_sick_check, #time_no_pay_sick_check').prop('checked', false);
                            }
                            else{
                                $('#karense_notify').hide().html('<div class="message">{$translate.no_karense_deduction}</div>').fadeIn('slow');
                            }
                        } else{
                            $('#karense_notify').html('');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        //alert(thrownError);
                    }
                });
            } else
                $('#karense_notify').html('');
        }
        
        function leaveTab(tab){
                if (tab == 'time') {
                    $('#leave_type_day').val(2);
                    check_is_karense_day();
                } else {
                    $('#leave_type_day').val(1);
                    check_is_karense_day();
                }
        }
        
        function manageConf(type){
            if(type == 'time'){
                if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', 'disabled');
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').prop('checked', false);
                    $('#Franvaro-box input:checkbox[name=chk_sender]').prop('checked', true);
                }else
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', false);
            }
            else if(type == 'date'){
                if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', 'disabled');
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').prop('checked', false);
                    $('#Franvaro-box input:checkbox[name=chk_sender_date]').prop('checked', true);
                }else
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', false);
            }
        }
        
        function NewDate(str){
            str=str.split('-');
            var date=new Date();
            date.setUTCFullYear(str[0], str[1]-1, str[2]);
            date.setUTCHours(0, 0, 0, 0);
            return date;
        }
        
        {if $login_user_role neq 3}
            function load_replacement_employees(action){
                var leave_type_day  = $.trim($('#leave_type_day').val());
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                
                if(typeof action !== "undefined" && action == 'get_for_2_modes'){
                    wrapLoader("#leave_date_replacement_emps");
                    $.ajax({
                        url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                        type:"POST",
                        dataType: "json",
                        data:'id='+slot_id+'&leave_format=&action=get_avail_emps_for_2_methods',
                        success:function(data){
                                        
                                    //set for date period users
                                    $('#replace_employees_list_date').html('<option value="">{$translate.none}</option>');
                                    $('.replace_employees_list_date_sms').html('');
                                    $.each(data.date_users, function(i, value) {
                                        $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    });
                                    
                                    //set for timeperiod users
                                    $('#replace_employees_list_time').html('<option value="">{$translate.none}</option>');
                                    $('.replace_employees_list_sms').html('');
                                    $.each(data.time_users, function(i, value) {
                                        $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    });
                                },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) {
                        uwrapLoader("#leave_date_replacement_emps");
                    });
                }
                else if(leave_type_day == 2){
                    var leave_date_day  = $.trim($('#leave_date_day').val());
                    var leave_time_from = time_to_sixty($.trim($('#leave_time_from').val()));
                    var leave_time_to   = time_to_sixty($.trim($('#leave_time_to').val()));
                    if(leave_time_to == 0) leave_time_to = 24;
                    if(slot_id != '' && leave_time_from != '' && leave_time_to != '' && leave_date_day != ''){
                        wrapLoader("#leave_time_replacement_emps");
                        $.ajax({
                            url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                            type:"POST",
                            dataType: "json",
                            data:'date='+leave_date_day+'&time_from='+leave_time_from+'&time_to='+leave_time_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                            success:function(data){
                                        $('#replace_employees_list_time').html('<option value="">{$translate.none}</option>');
                                        $('.replace_employees_list_sms').html('');
                                        $.each(data, function(i, value) {
                                            //rep_list_options += '<option value="'+value.username+'">'+value.name+'</option>';
                                            $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                            $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        });
                                    },
                            error: function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
                            }
                        }).always(function(data) {
                            uwrapLoader("#leave_time_replacement_emps");
                        });
                    }
                } 
                else if(leave_type_day == 1){
                    var leave_date_from = $.trim($('#leave_date_from').val());
                    var leave_date_to   = $.trim($('#leave_date_to').val());
                    var date1 = NewDate(leave_date_from)
                    var date2 = NewDate(leave_date_to);
                    if (date1 > date2) 
                        alert('{$translate.check_the_from_and_to_date}');
                    else if(slot_id != '' && leave_date_from != '' && leave_date_to != ''){
                        wrapLoader("#leave_date_replacement_emps");
                        $.ajax({
                            url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                            type:"POST",
                            dataType: "json",
                            data:'date_from='+leave_date_from+'&date_to='+leave_date_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                            success:function(data){
                                        $('#replace_employees_list_date').html('<option value="">{$translate.none}</option>');
                                        $('.replace_employees_list_date_sms').html('');
                                        $.each(data, function(i, value) {
                                            $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                            $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        });
                                    },
                            error: function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
                            }
                        }).always(function(data) {
                            uwrapLoader("#leave_date_replacement_emps");
                        });
                    }
                }
            }
        {/if}
        
        {if $privileges_gd.leave eq 1}
            function saveLeave(){
                var slot_id                = $('#slot_details_main_wraper_group #sdID').val();
                var slot_type              = $('#slot_details_main_wraper_group #this_slot_actual_type').val();
                var employee               = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                var leave_approve_on_apply = $('#leave_approve_on_apply').is(":checked") === true ? 1 : 0 ; 
                
                if(slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17){
                    var leave_type = $('#leave_type_val').val();
                    if (leave_type != '') {
                        var leave_date_from = $('#Franvaro-box #leave_date_from').val();
                        var leave_date_to   = $('#Franvaro-box #leave_date_to').val();
                        var leave_type_day  = $('#Franvaro-box #leave_type_day').val();
                        var leave_comments  = $('#Franvaro-box #leave_comments').val();
                        var no_pay_check_value = 0;
                        var sms_emps = [ ];
                        var need_sms = false;

                        var opt_sms_conformation = 0;
                        var opt_sms_sender = 0;
                        var opt_sms_rejection = 0;

                        {*leave on between date*}
                        if (leave_type_day == '1') {
                            {if $login_user_role neq 3}
                                var rep_emp = $('#Franvaro-box .replace_employees_list_date[name=rep_date_employees]').val();
                                if(typeof rep_emp == 'undefined') rep_emp = '';

                                need_sms = $('#Franvaro-box #send_sms_date').prop('checked');
                                if(need_sms){
                                    sms_emps = $('#Franvaro-box .replace_employees_list_date_sms').val();

                                    if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                                        opt_sms_conformation = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                    }    
                                    else {
                                        if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_rejection_date]:checked').prop('checked'))
                                            opt_sms_rejection = 1;    
                                    }
                                }
                            {else}
                                var rep_emp = '';
                            {/if}

                            if (leave_date_from != '' && leave_date_to != '') {
                                var date1 = NewDate(leave_date_from);
                                var date2 = NewDate(leave_date_to);
                                if (date1 <= date2) {

                                    {if $privileges_gd.no_pay_leave eq 1}
                                        var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                                        if(no_pay_check) no_pay_check_value = 1;
                                    {else}
                                        no_pay_check_value = 1;
                                    {/if}

                                    var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'date_from': leave_date_from, 'date_to': leave_date_to, 'leave_type': leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                            'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                                
                                    wrapLoader('#slot_details_main_wraper_group');
                                    $.ajax({
                                        url: '{$url_path}save_leave.php',
                                        type:"POST",
                                        data: $.param(url_data_obj),
                                        success:function(data){
                                            //console.log(data);
                                            close_right_panel();
                                            reload_content();
                                        }
                                    }).always(function(data) { 
                                        uwrapLoader('#slot_details_main_wraper_group');
                                    });
                                } else
                                    alert('{$translate.check_the_from_and_to_date}');
                            }else
                                alert('{$translate.check_the_from_and_to_date}');
                        } else if (leave_type_day == '2') { {*leave on time*}
                            var leave_date_day  = $('#Franvaro-box #leave_date_day').val();
                            var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                            var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                            {if $privileges_gd.no_pay_leave eq 1}
                                var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                                if(no_pay_check) no_pay_check_value = 1;
                            {else}
                                no_pay_check_value = 1;
                            {/if}

                            {if $login_user_role neq 3}
                                var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                                if(typeof rep_emp == 'undefined') rep_emp = '';

                                need_sms = $('#Franvaro-box #send_sms_time').prop('checked');
                                if(need_sms){
                                    sms_emps = $('#Franvaro-box .replace_employees_list_sms').val();

                                    if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                                        opt_sms_conformation = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                    }    
                                    else {
                                        if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_rejection]:checked').prop('checked'))
                                            opt_sms_rejection = 1;    
                                    }
                                }
                            {else}
                                var rep_emp = '';
                            {/if}
                            var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                            if(typeof rep_emp == 'undefined') rep_emp = '';
                            if (leave_date_day != '') {
                                var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_date': leave_date_day, 'leave_range_from': leave_time_from, 'leave_range_to': leave_time_to, 'leave_type' : leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                        'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                                        
                                wrapLoader('#slot_details_main_wraper_group');
                                $.ajax({
                                    url: '{$url_path}save_leave.php',
                                    type:"POST",
                                    data: $.param(url_data_obj),
                                    success:function(data){
                                        //console.log(data);
                                        close_right_panel();
                                        reload_content();
                                    }
                                }).always(function(data) { 
                                    uwrapLoader('#slot_details_main_wraper_group');
                                });
                            } else
                                alert('{$translate.please_select_one_date}');
                        }
                    } else
                        alert('{$translate.please_select_a_leave_type}');
                }
            }
        {/if}
    
        $(document).ready(function() {
            {if $login_user_role neq 3}
                /*$( "#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day" ).change(function(){
                    load_replacement_employees();
                });*/
                $('#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
                .on('changeDate', function(ev){
                  load_replacement_employees();
                });

                $( "#Franvaro-box #leave_time_from, #Franvaro-box #leave_time_to" ).keyup(function(){
                    load_replacement_employees();
                });
            {/if}
            
            {if $privileges_gd.no_pay_leave eq 1}
                $('#time_no_pay_sick_check, #date_no_pay_sick_check').click(function(){
                    if($(this).is(':checked')){
                        var kerense_employee = $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val();
                        $(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.karense} - '+kerense_employee).css('color', 'red');
                        $("#karense_notify").hide();
                        $("#karense_notify1").show();

                    }else{
                        //$(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.no_karense}').css('color', '');
                        $("#karense_notify").show();
                        $("#karense_notify1").hide();
                    }
                });
            {/if}
        
            $('#send_sms_time').click(function(){
                    if($(this).is(':checked')){
                        $('#time_replacer_sms_tbl').removeClass('hide');
                        $('#time_replacer_nosms_tbl').addClass('hide');
                    }else{
                        $('#time_replacer_sms_tbl').addClass('hide');
                        $('#time_replacer_nosms_tbl').removeClass('hide');
                    }
            });
            $('#send_sms_date').click(function(){
                    if($(this).is(':checked')){
                        $('#date_replacer_sms_tbl').removeClass('hide');
                        $('#date_replacer_nosms_tbl').addClass('hide');
                    }else{
                        $('#date_replacer_sms_tbl').addClass('hide');
                        $('#date_replacer_nosms_tbl').removeClass('hide');
                    }
            });

            /*$('#leave_date_day, #leave_date_from, #leave_date_to').change(function(){
                check_is_karense_day();
            });*/
            $('#leave_date_day, #leave_date_from, #leave_date_to').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
            .on('changeDate', function(ev){
              check_is_karense_day();
            });
        });
    </script>
    
{*    single slot actions*}
    <script>
        {if $privileges_gd.split_slot eq 1}
            function splitSlot(){
                var new_tfrom   = $("#slot-dela-pass #split_slot_timefrom").val();
                var new_tto     = $("#slot-dela-pass #split_slot_timeto").val();
                if(new_tfrom != '' && new_tto != ''){
                
                    var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                    if(slot_id.includes('-')) {
                        var process_details_obj = { 'id': slot_id,
                            'slot_from' : slot_from,
                            'slot_to'   : slot_to,
                            'time_from' : new_tfrom,
                            'time_to'   : new_tto,
                            'action'    : 'splitmultiple'
                        };
                    } else {
                        var process_details_obj = { 'id': slot_id,
                            'slot_from' : slot_from,
                            'slot_to'   : slot_to,
                            'time_from' : new_tfrom,
                            'time_to'   : new_tto,
                            'action'    : 'split'
                        };
                    }
                    
                    wrapLoader('#slot_details_main_wraper_group');
                    $.ajax({
                        url:"{$url_path}ajax_alloc_action_slot.php",
                        type:"POST",
                        data:process_details_obj,
                        success:function(data){
                            //console.log(data);
                            close_right_panel();
                            reload_content();
                        }
                    }).always(function(data) { 
                        uwrapLoader('#slot_details_main_wraper_group');
                    });
                }else
                    alert('{$translate.please_enter_time}');
            }
        {/if}
        
        function getAfterDates_for_slotcopy_multiple(){
            var max_week_number = 52;
            var year_week   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var cur_slot_year_of_week = date('o',strtotime(year_week));
            var year = parseInt(cur_slot_year_of_week, 10);
            var to_week = parseInt($("#kopierapass-box #slot_copy_multiple_from_wk").val()) + (parseInt($("#kopierapass-box #slot_copy_multiple_from_option").val()));
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('#kopierapass-box #slot_copy_multiple_to_wk').find('option').remove();
            for (var i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#kopierapass-box #slot_copy_multiple_to_wk");
                to_week = to_week + 1;
            }
        }
        
        {if $privileges_gd.copy_single_slot_option eq 1}
            function save_copy(){
                var days = "";
                var with_user = 1;
                for(var i=0; i < document.frm_copy.slot_copy_multiple_days.length; i++){
                if(document.frm_copy.slot_copy_multiple_days[i].checked)
                    days += document.frm_copy.slot_copy_multiple_days[i].value+'-';
                }
                if(days == '')
                    alert('select days');
                else{
                    if($('#kopierapass-box #slot_copy_multiple_withoutuser').attr("checked") == "checked")
                        with_user = 0;
                    
                    var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    
                    var from_week   = $("#kopierapass-box #slot_copy_multiple_from_wk").val();
                    var from_option = $("#kopierapass-box #slot_copy_multiple_from_option").val();
                    var to_week     = $("#kopierapass-box #slot_copy_multiple_to_wk").val();
                    
                    var additional_urldata = 'customer='+slot_customer+'&employee='+slot_employee+'&date='+slot_date+
                            '&from_week='+from_week+'&from_option='+from_option+'&to_week='+to_week+'&id='+slot_id+
                            '&days='+days+'&with_user='+with_user+'&action=copy_multiple&user={$login_user}';
                    //console.log(additional_urldata);
                    
                    if(with_user == 1){
                        var atl_req_data = additional_urldata + '&to_single_slot=TRUE&type_check=11';
                        var process_url = '{$url_path}ajax_alloc_action_slot.php?' + additional_urldata;
                        check_atl_warning(atl_req_data, function(this_url){
                                            wrapLoader('#slot_details_main_wraper_group');
                                            $('#div_alloc_action').load(this_url, function(response, status, xhr){ uwrapLoader('#slot_details_main_wraper_group'); reload_content(); });
                                        }, process_url, '#slot_details_main_wraper_group');
                    }else{
                        wrapLoader('#slot_details_main_wraper_group');
                        $.ajax({
                            url:"{$url_path}ajax_alloc_action_slot.php",
                            type:"POST",
                            data:additional_urldata,
                            success:function(data){
                                //console.log(data);
                                close_right_panel();
                                reload_content();
                            }
                        }).always(function(data) { 
                            uwrapLoader('#slot_details_main_wraper_group');
                        });
                    }
                }
            }
        {/if}
    
        function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){

                {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
                    if(typeof animation_element !== "undefined")
                        wrapLoader(animation_element);
                    else 
                        wrapLoader("#external_wrapper");

                    $.ajax({
                        url: "{$url_path}ajax_check_atl_and_contract.php",
                        type: "POST",
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
                                            {if $privileges_gd['contract_override'] eq 1}
                                                bootbox.dialog( data.contract_params.error_msg, [{
                                                        "label" : "{$translate.no}",
                                                        "class" : "btn-danger"
                                                    }, {
                                                        "label" : "{$translate.yes}",
                                                        "class" : "btn-success",
                                                        "callback": function() {
                                                            _fn_success_call_back(_call_back_data);
                                                        }
                                                }]);
                                            {else}
                                                bootbox.alert(data.contract_params.error_msg, function(result){ });
                                            {/if}
                                        }
                                    {/if}
                                }
                                else{
                                    _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                                    {if $privileges_gd.atl_override eq 1}
                                        bootbox.dialog( data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}", [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                        _fn_success_call_back(_call_back_data);
                                                    {else}
                                                        if(data.contract == 'success'){
                                                             _fn_success_call_back(_call_back_data);
                                                        }else{
                                                            {if $privileges_gd['contract_override'] eq 1}
                                                                bootbox.dialog( data.contract_params.error_msg, [{
                                                                        "label" : "{$translate.no}",
                                                                        "class" : "btn-danger"
                                                                    }, {
                                                                        "label" : "{$translate.yes}",
                                                                        "class" : "btn-success",
                                                                        "callback": function() {
                                                                            _fn_success_call_back(_call_back_data);
                                                                        }
                                                                }]);
                                                            {else}
                                                                bootbox.alert(data.contract_params.error_msg, function(result){ });
                                                            {/if}
                                                        }
                                                    {/if}
                                                }
                                        }]);
                                    {else} 
                                        bootbox.alert(data.atl, function(result){ });
                                    {/if}
                                }
                            {else if $company_contract_checking_flag eq 1}
                                if(data.contract == 'success'){
                                    _fn_success_call_back(_call_back_data);
                                }else{
                                    {if $privileges_gd['contract_override'] eq 1}
                                        bootbox.dialog( data.contract_params.error_msg, [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    _fn_success_call_back(_call_back_data);
                                                }
                                        }]);
                                    {else}
                                        bootbox.alert(data.contract_params.error_msg, function(result){ });
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
                            uwrapLoader("#external_wrapper");
                    });
                {else}
                    _fn_success_call_back(_call_back_data);
                {/if}
        }

        {if $privileges_gd.copy_single_slot eq 1}
            function copy_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'copy'
                    };

                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_slot.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
        {/if}
    
        {if $privileges_gd.swap eq 1}
            function swap_copy_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'swap'
                    };

                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_slot.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
            
            function swap_past_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

                /*var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'swap',
                                'swap': '1'
                    };*/
                    
                var atl_req_data = 'date='+slot_date+'&employee='+slot_employee+'&customer='+slot_customer+
                            '&id='+slot_id+'&action=swap&swap=1&type_check=15';
                    
                var slot_details_obj = 'id='+slot_id+'&date='+slot_date+'&customer='+slot_customer+'&action=swap&swap=1';
                var process_url = '{$url_path}ajax_alloc_action_slot.php?' + slot_details_obj;
                    
                check_atl_warning(atl_req_data, function(this_url){
                                    wrapLoader('#slot_details_main_wraper_group');
                                    $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader('#slot_details_main_wraper_group'); reload_content(); });
                                }, process_url, '#slot_details_main_wraper_group');
            }
        {/if}
    
        {if $privileges_gd.delete_slot eq 1 or $privileges_gd.candg_approve eq 1}
            function delete_single_slot(){
                bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                            var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                            var slot_details_obj = { 'id': slot_id,
                                            'date': slot_date,
                                            'customer': slot_customer,
                                            'action': 'slot_remove'
                                };

                            wrapLoader('#slot_details_main_wraper_group');
                            $.ajax({
                                url:"{$url_path}ajax_alloc_action_slot.php",
                                type:"POST",
                                data:slot_details_obj,
                                success:function(data){
                                    //console.log(data);
                                    close_right_panel();
                                    reload_content();
                                }
                            }).always(function(data) { 
                                uwrapLoader('#slot_details_main_wraper_group');
                            });
                        }
                }]);
            }
        {/if}
    </script>
    
{*    add new slot functions*}
    <script>
        //not used in this module - due to collision checks
        function multipleMemorySlotAdd(){

            var time_ranges = $('#tab_emp_slotcreate_memoryslots_sections #tab-memory-slots #available_memory_slots li.memory_time input:checkbox:checked').map(function () {
                            return this.value;
            }).get();
            
            var selected_date = '{$cur_date}';

            if(time_ranges.length == 0)
                alert("{$translate.no_elements_selected}");
            else{
                var multiple_time = time_ranges.join(',');
                var process_details_obj = { 'date': selected_date,
                            'employee'  : '{$employee.userid}',
                            'customer'  : '',
                            'emp_alloc' : '{$login_user}',
                            'multiple'  : multiple_time,
                            'action'    : 'drag_memory_slots'
                };
                process_drop_time_slot(process_details_obj);
            }
                
        }
        
        function process_drop_time_slot(process_details_obj){
            wrapLoader('#slot_details_main_wraper_group');
            $.ajax({
                url:"{$url_path}ajax_alloc_action_month.php",
                type:"POST",
                dataType: 'json',
                data:process_details_obj,
                success:function(data_process){
                    //console.log(data_process);
                    if(data_process.result){    //excute if successfully created slot
                        //close_right_panel();
                        $.gritter.removeAll();
                        reload_content({ 'right_panel': 'memory_slots'/*, 'gritter_msg' : true*/ });
                    } else if(typeof data_process.message !== "undefined" && data_process.message != '') {
                        $('#left_message_wraper').html(data_process.message).removeClass('hide');
                        $('.main-left').animate({
                            scrollTop: $('#left_message_wraper').offset().top
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            })
            .always(function(data) {
                uwrapLoader('#slot_details_main_wraper_group');
            });
        }
        
        $(document).ready(function(){
        
            {if isset($right_panel) and $right_panel eq 'create_new_slot'}
                    clicked_tab_create_slots();
            {/if}
                
            $(document).off('keypress', "#tab-create-new-slot #new_slot_date, #tab-create-new-slot .slot_from, #tab-create-new-slot .slot_to, \n\
            #tab-create-new-slot .custom_slot_customer, #tab-create-new-slot .custom_slot_fkkn, #tab-create-new-slot .comment_textarea")
                .on('keypress', "#tab-create-new-slot #new_slot_date, #tab-create-new-slot .slot_from, #tab-create-new-slot .slot_to, \n\
            #tab-create-new-slot .custom_slot_customer, #tab-create-new-slot .custom_slot_fkkn, #tab-create-new-slot .comment_textarea", function(e) {
                if(e.which == 13) {
                    manEntry();
                }
            });
            
            $('#available_memory_slots li.memory_time .remove-memory-slot').click(function(){
        
                var ms_id = $(this).parents('.memory_time').find('.this_mslot').attr('data-id');
                var this_mem_slot_dom = $(this).parents('.memory_time');
                var process_details_obj = { 'id': ms_id, 'action': 'memory_slot_remove'};

                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        if(data_process.result){    //excute if successfully removed memory slot
                            this_mem_slot_dom.fadeOut('slow', function() { $(this).remove(); });
                        }
                        if(typeof data_process.message !== "undefined" && data_process.message != '') {
                            $('#left_message_wraper').html(data_process.message).removeClass('hide').fadeIn("slow", function() {
                                $('.main-left').animate({
                                    scrollTop: $('#left_message_wraper').offset().top
                                });
                            });
                            
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                });
            });
            
            // .child-slots
            $(".memory_time").draggable({ revert: true, appendTo: ".slot-section-wrpr", helper: 'clone', 
                        start: function (event, ui) { ui.helper.css({ 'width': '83px', 'z-index': '900', 'list-style': 'none'});} });
                    
            $("#slot_display_wraper").droppable({
                    accept: ".memory_time",
                    hoverClass: "dropover",
                    drop: function( event, ui ) {
                        //console.log(ui.draggable.attr('class'));
                        
                        var target_day = $(this);
                        
                        var params      = ui.draggable.find('input[type=checkbox]');

                        var time_from   = parseFloat(params.attr("data-timefrom"));
                        var time_to     = parseFloat(params.attr("data-timeto"));
                        var slot_type   = parseFloat(params.attr("data-type"));
                        var selected_date = target_day.attr('data-date');

                        var process_details_obj = { 'date': selected_date,
                                    'employee'  : '{$employee.userid}',
                                    'customer'  : '',
                                    'emp_alloc' : '{$login_user}',
                                    'time_from' : time_from,
                                    'time_to'   : time_to,
                                    'slotType'  : slot_type,
                                    'dnt_show_flag': 0,
                                    'action'    : 'drag_memory_slots'
                        };
                        process_drop_time_slot(process_details_obj);
                    }
            }); 
            
            $('#check_created_slot_copy_to_weeks').click(function(){
                    $('#created_slot_copy_to_weeks')[$(this).is(':checked') ? 'removeClass' : 'addClass']('hide');
                    if($(this).is(':checked')){
                        var new_slot_date = $.trim($('#tab-create-new-slot #new_slot_date').val());
                        if(new_slot_date != ''){
                            reset_cscm_params(new_slot_date);
                        }
                    }
            });
            
            $('#tab-create-new-slot #dtPickerNewSlotDate').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
            .on('changeDate', function(ev){
                if(typeof ev.date != 'undefined' && ev.date != ''){
                    reset_cscm_params($.datepicker.formatDate('yy-mm-dd', ev.date));
                }
            });
        });
        
        function close_slot_template(this_obj){
            $(this_obj).parents('.time_slots_theme').remove();
        }
        
        function popupAddSlotMore(){
            $('.add-new-slots-month .create-slotes-panel').prepend(get_slot_add_theme());
            $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
        }
        
        function get_slot_add_theme(){
            var slot_theme = '<div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:15px !important;">\n\
                                <div class="close_btn_wrpr pull-right"><button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="{$translate.remove_slot}" type="button" onclick="close_slot_template(this);" tabindex="-1">×</button></div>\n\
                                <div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend">\n\
                                        <span class="add-on  icon-time " title="{$translate.time}"></span>\n\
                                        <input class="form-control span5 custom_slot slot_from time-input-text " id="new_slot_from" name="slot_from" value="" placeholder="{$translate.from}" type="text"  style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>\n\
                                        <span class="add-on">{$translate.to}</span>\n\
                                        <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="" placeholder="{$translate.to}" type="text"  style="margin-left: -1px;"/>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-user" title="{$translate.customer}"></span>\n\
                                        <select id="custom_slot_customer" name="custom_slot_customer" class="form-control custom_slot_customer span12">\n\
                                            <option value="">{$translate.select}</option>\n\
                                            {foreach from=$customers_to_assign item=cust}\n\
                                                <option value="{$cust.username}">{$cust.last_name} {$cust.first_name}</option>\n\
                                            {/foreach}\n\
                                        </select>\n\
                                    </div>\n\
                                </div>';              
                                slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-star"></span>\n\
                                        <select class="form-control custom_slot_fkkn span12" name="custom_slot_fkkn">\n\
                                            <option selected="selected" value="1">{$translate.fk}</option>\n\
                                            <option value="2">{$translate.kn}</option>\n\
                                            <option value="3">{$translate.tu}</option>\n\
                                        </select>\n\
                                    </div>\n\
                                </div> ';
    
                                slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-comment" title="{$translate.comment}"></span>\n\
                                        <textarea id="comment_textarea"  class="comment_textarea form-control span12" rows="1" placeholder="{$translate.comment}"></textarea>\n\
                                    </div>\n\
                                </div>\n\
                                <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">\n\
                                    <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value=1 title="{$translate.travel}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value=0 title="{$translate.normal}"></li>\n\
                                    <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value=2 title="{$translate.break}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value=3 title="{$translate.oncall}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value=4 title="{$translate.overtime}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value=5 title="{$translate.qual_overtime}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value=6 title="{$translate.more_time}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value=14 title="{$translate.more_oncall}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value=7 title="{$translate.some_other_time}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value=8 title="{$translate.training_time}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value=9 title="{$translate.call_training}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value=10 title="{$translate.personal_meeting}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value=11 title="{$translate.voluntary}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value=12 title="{$translate.complementary}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value=13 title="{$translate.complementary_oncall}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value=15 title="{$translate.oncall_standby}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value=16 title="{$translate.work_for_dismissal}" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value=17 title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>\n\
                                </ul>\n\
                            </div>';
                return slot_theme;
        }
        
        function manEntry(){
            var proceed_flag = true;

            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
            var have_slots = false;

            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {
                have_slots = true;
                if($.trim($(this).find('.slot_from').val()) == '' || $.trim($(this).find('.slot_to').val()) == ''){
                    proceed_flag = false;
                }
            });
            
            var weekly_past = $('#tab-create-new-slot input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = week_days = '';
            if(weekly_past_value){
                from_week = $('#tab-create-new-slot #cscm_from_wk').val();
                to_week = $('#tab-create-new-slot #cscm_to_wk').val();
                from_option = $('#tab-create-new-slot #cscm_from_option').val();
                
                week_days = $('#tab-create-new-slot input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }

            if(slot_date == ''){
                bootbox.alert('{$translate.invalid_date}', function(result){ });
                $('.add-new-slots-month .slot_date').focus();
            }
            else if(!proceed_flag){
                bootbox.alert('{$translate.incomplete_slot_times}', function(result){ });
            }
            else if(!have_slots){
                bootbox.alert('{$translate.please_add_slots}', function(result){ });
            }
            else if (weekly_past_value == true && week_days == '') {
                alert('{$translate.select_days}');
            }
            else {
                var main_obj = { 'selected_date': slot_date,
                                'action': 'multiple_add',
                                'time_slots': [ ] }; 
                    
                var collid_emp_obj = [ ];
                $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                    var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                    var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                    if(tmp_slot_to == 0) tmp_slot_to = 24;

                    if(tmp_slot_from !== false)  $(this).find('.slot_from').val(tmp_slot_from);
                    if(tmp_slot_to !== false)    $(this).find('.slot_to').val(tmp_slot_to);

                    var tmp_slot_customer = $(this).find('.custom_slot_customer').val();

                    if(tmp_slot_from !== false && tmp_slot_to !== false){
                        tmp_slot_from = parseFloat(tmp_slot_from);
                        tmp_slot_to = parseFloat(tmp_slot_to);
                        var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'employee': '{$employee.userid}', 'customer': tmp_slot_customer};
                        main_obj['time_slots'].push(temp_obj);
                        collid_emp_obj.push({ 
                                'time_from': tmp_slot_from, 
                                'time_to': tmp_slot_to, 
                                'customer': tmp_slot_customer
                            });
                    }
                });

                var flag_employee_slots_collided = false;
                //check employee slot collided or not
                var count_slots = collid_emp_obj.length;
                for(var i = 1 ; i < count_slots ; i++){
                    for(var j = 0 ; j < i ; j++){

                        if((collid_emp_obj[j]['time_from'] >= collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_from'] <  collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] <= collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_from'] < collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_to'])){
                                flag_employee_slots_collided = true;
                                break;
                        }
                    }
                    if(flag_employee_slots_collided) break;
                }
                
                if(flag_employee_slots_collided){
                    bootbox.alert('{$translate.employee_slots_collided_within_entered_slots}', function(result){ });
                } else {
                
                    if(weekly_past_value){
                        main_obj['from_week']   = from_week;
                        main_obj['to_week']     = to_week;
                        main_obj['from_option'] = from_option;
                        main_obj['days']        = week_days;
                    }
                    
                    wrapLoader('#slot_creation_main_wraper_group');                    
                    $.ajax({
                        url: "{$url_path}ajax_check_inconv_time_with_slot_time.php",
                        type: "POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            //console.log(data);
                            
                            if(data.transaction)
                                manEntry_proceed(data);
                            else if(data.transaction == false && data.error_reason != ''){
                                alert(data.error_reason);
                                
                                }
                            else
                                bootbox.alert('{$translate.enter_date_and_time}', function(result){ });
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                            
                        }
                    }).always(function(data) { 
                            uwrapLoader('#slot_creation_main_wraper_group');
                    });
                }
            }
        }
        
        function manEntry_proceed(data_obj){
            
            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());

            var saveTimeslot = $('.add-new-slots-month input:checkbox[name=saveTimeslot]:checked').val();
            var saveTimeslot_value = 0;
            if (saveTimeslot) saveTimeslot_value = 1;
            
            var weekly_past = $('#tab-create-new-slot input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = '';
            if(weekly_past_value){
                from_week = $('#tab-create-new-slot #cscm_from_wk').val();
                to_week = $('#tab-create-new-slot #cscm_to_wk').val();
                from_option = $('#tab-create-new-slot #cscm_from_option').val();
                
                var week_days = $('#tab-create-new-slot input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }

            //get all other slot details
            var main_obj = { 'selected_date': slot_date,
                            'selected_employee': '{$employee.userid}',
                            'action': 'man_slot_entry',
                            'sub_action': 'multiple_add',
                            'req_from': 'gd_alloc_window',
                            'gd_page_date': '{$cur_date}',
                            'employee': '{$employee.userid}',
                            'emp_alloc': '{$login_user}',
                            'saveTimeslot': saveTimeslot_value,
                            'stop_if_any_error': true,
                            'time_slots': [ ] };

            var url_atl = 'date='+slot_date+'&employee={$employee.userid}&customer=&emp_alloc={$login_user}&action=man_slot_entry&sub_action=multiple_add&type_check=18';
            if(weekly_past_value){
                url_atl += '&from_week=' + from_week + '&from_option=' + from_option + '&to_week=' + to_week + '&days=' + week_days;
                
                main_obj['from_week']   = from_week;
                main_obj['to_week']     = to_week;
                main_obj['from_option'] = from_option;
                main_obj['days']        = week_days;
            }

            var need_atl_checking = false;

            var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12','15', '16'];
            var oncall_slot_types = ['3', '9', '13', '14', '17'];

            var have_normal_slots = false;
            var have_oncall_slots = false;

            url_atl__ = { 'time_slots': [ ] };  
            var url_atl_slot_count = 0;
            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {
                
                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to = parseFloat(tmp_slot_to);
                    var tmp_slot_customer = $(this).find('.custom_slot_customer').val();
                    var tmp_comment = $.trim($(this).find('.comment_textarea').val());
                    var tmp_fkkn = $(this).find('.custom_slot_fkkn').val();
                    var tmp_slot_type = $(this).find('ul.single-slot-icon-list').find('li.active').attr('data-value');

                    if(tmp_slot_customer != '') need_atl_checking = true;
                    if($.inArray( tmp_slot_type, normal_slot_types ) > -1) //check if normal slot type
                        have_normal_slots = true;
                    if($.inArray( tmp_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                        have_oncall_slots = true;

                    var temp_obj = { 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'customer': tmp_slot_customer,
                            'comment': tmp_comment,
                            'fkkn': tmp_fkkn,
                            'type': tmp_slot_type
                        };
                    main_obj['time_slots'].push(temp_obj);
                    url_atl__['time_slots'].push({ 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'customer': tmp_slot_customer,
                            'type': tmp_slot_type
                        });
                }
            });
            url_atl += '&' + serialize_json_as_url(url_atl__['time_slots'], 'time_slots');
            //main_obj.push( { 'convert_to_oncall': 'yes'});
            //----------------------------------------------------------------


            var base_url = '{$url_path}ajax_alloc_action.php?1';

            if(have_oncall_slots && (data_obj.time_flag == 0 || data_obj.time_flag_next == 0))
                alert('{$translate.time_outside_oncall}');

            else if(have_normal_slots && (data_obj.time_flag == 1 && data_obj.time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_you_want_to_change_as_oncall_slot}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                                    navigatePage(this_url,1, main_obj);
                                                }, base_url);
                            }else{
                                navigatePage(base_url,1, main_obj);
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['convert_to_oncall'] ='yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                                navigatePage(this_url,1, main_obj);
                                                            }, base_url);
                            }else{
                                navigatePage(base_url,1, main_obj);
                            }
                        }
                }]);
            }
            else if(have_normal_slots && (data_obj.slot_split_time_flag == 1 || data_obj.slot_split_time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_seperate_oncall_hours}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                                    navigatePage(this_url,1, main_obj);
                                                }, base_url);
                            }else{
                                navigatePage(base_url,1, main_obj);
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['split_slots'] = 'yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                                    navigatePage(this_url,1, main_obj);
                                                    }, base_url);
                            }else {
                                navigatePage(base_url,1, main_obj);
                            }
                        }
                }]);
            }
            else {
                if(need_atl_checking){
                    check_atl_warning(url_atl, function(this_url){ 
                                                        navigatePage(this_url,1, main_obj);
                                    }, base_url);
                } else 
                    navigatePage(base_url, 1, main_obj);
            }
        }
        
        function serialize_json_as_url(data, array_name){

            var url = '';
            if(typeof array_name !== "undefined"){      //create as array
                url += Object.keys(data).map(function(k) {
                    if(typeof data[k] == 'object'){
                        return serialize_json_as_url(data[k], array_name+'['+k+']');
                    } 
                    else
                        return encodeURIComponent(array_name+'['+k+']') + '=' + encodeURIComponent(data[k]);
                }).join('&');
            } else {
                    url += Object.keys(data).map(function(k) {

                        if(typeof data[k] == 'object'){
                            return serialize_json_as_url(data[k], array_name+'['+k+']');
                        } else {
                            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);

                        }
                    }).join('&');
            }
            return url;
        }
        
{*        created slot copy multiple*}
        function reset_cscm_params(selected_date){
            if(selected_date != ''){
                var total_weeks_in_a_year = total_weeks_in_date_year(selected_date);

                $('#tab-create-new-slot #created_slot_copy_to_weeks #cscm_from_wk').find('option[value="53"]').remove();
                if(total_weeks_in_a_year == 53){
                    $('<option value="53">53</option>').appendTo("#tab-create-new-slot #created_slot_copy_to_weeks #cscm_from_wk");
                }

                var selected_date_week = $.datepicker.iso8601Week(new Date(selected_date));
                $("#tab-create-new-slot #created_slot_copy_to_weeks #cscm_from_wk").val(selected_date_week);
                getAfterDates_for_cscm();
            }
        }
        
        function getAfterDates_for_cscm(){
            //var max_week_number = 52;
            var year_week   = $('#tab-create-new-slot #new_slot_date').val();
            var max_week_number = total_weeks_in_date_year(year_week);
            var cur_slot_year_of_week = date('o',strtotime(year_week));
            var year = parseInt(cur_slot_year_of_week, 10);
            var to_week = parseInt($("#tab-create-new-slot #created_slot_copy_to_weeks #cscm_from_wk").val()) + (parseInt($("#tab-create-new-slot #created_slot_copy_to_weeks #cscm_from_option").val()));
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('#tab-create-new-slot #created_slot_copy_to_weeks #cscm_to_wk').find('option').remove();
            for (var i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#tab-create-new-slot #created_slot_copy_to_weeks #cscm_to_wk");
                to_week = to_week + 1;
            }
        }
    </script>
    
{*    right click functions*}
    <script>
        $(document).ready(function() {
            /**************************************************
             * Context-Menu with Sub-Menu
             **************************************************/
            $.contextMenu({
                selector: '#slot_display_wraper', 
                build: function($trigger, e) {
                    //console.log($trigger);
                    //console.log(e);

                    var included_candg_slots = false;
                    var included_none_candg_slots = false;
                    var included_incomplete_slots = false;
                    var included_non_incomplete_slots = false;
                    var included_selected_slots = false;
                    $( '#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.slot-day').hasClass('slot-theme-candg'))
                            included_candg_slots = true;
                        else
                            included_none_candg_slots = true;
                    });
                    $( '#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.slot-day').hasClass('slot-theme-incomplete'))
                            included_incomplete_slots = true;
                        else
                            included_non_incomplete_slots = true;
                    });
                    //console.log('included_candg_slots: '+included_candg_slots);
                    //console.log('included_not_candg_slots: '+included_none_candg_slots);

                    if(included_candg_slots && included_none_candg_slots){
                        //$trigger.contextMenu(false);
                        return false;
                    }

                    if(included_incomplete_slots || included_non_incomplete_slots){
                        included_selected_slots = true;
                    }

                    var ids_temp = $('#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check').map(function () {
                        return this.value;
                    }).get(); 

                    var ids = ids_temp.join('-');

                    // this callback is executed every time the menu is to be shown
                    // its results are destroyed every time the menu is hidden
                    // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
                    var options = {
                        callback: function(key, options) {
                            //window.console && console.log(m) || alert(m);
                            var slot_type_change = '';
                            var slot_fkkn_change = '';
                            switch(key){
                                case "go_to_employee":
                                    close_right_panel(false);
                                    show_right_panel();
                                    $("#right_click_action_options, #goto-employees-options").removeClass('hide');
                                   break;
                                case "go_to_customer":
                                    var temp_cust_id = '';
                                    if(ids_temp.length == 1){
                                        var slot_details_hub = $('#slot_thread_'+ids_temp[0]).find('.slot_details_hub');
                                        if(slot_details_hub.length == 1){
                                            temp_cust_id = slot_details_hub.attr('data-customer-id');
                                            if(temp_cust_id != ''){
                                                navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&customer='+temp_cust_id,1);
                                            }
                                        }
                                    }
                                    if(temp_cust_id == ''){
                                        close_right_panel(false);
                                        show_right_panel();
                                        $("#right_click_action_options, #goto-customers-options").removeClass('hide');
                                    }
                                   break;
                                case "delete_slot":
                                   if(ids != ''){
                                        var urls = '{$url_path}ajax_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action' : 'multiple_slots_remove', 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                        bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;

                               case 'delete_customer':
                                   if(ids != ''){
                                       var urls = '{$url_path}ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': 'delete_customers', 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                       bootbox.dialog( '{$translate.confirm_delete_customer}', [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;

                               case 'delete_employee':
                                   if(ids != ''){
                                       var urls = '{$url_path}ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': 'delete_employees', 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                       bootbox.dialog( '{$translate.confirm_delete}', [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                               case 'change_fk':
                               case 'change_kn':
                               case 'change_tu':
                                   switch(key){
                                       case "change_fk" : slot_fkkn_change = 'change_fk'; break;
                                       case "change_kn" : slot_fkkn_change = 'change_kn'; break;
                                       case "change_tu" : slot_fkkn_change = 'change_tu'; break;
                                   }

                                   if(ids != ''){
                                       var urls = '{$url_path}ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': slot_fkkn_change, 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                       bootbox.dialog( '{$translate.confirm_changes}', [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                               case "change_employee":
                                   if(ids != ''){
                                       var process_details_obj = { 'page_date': '{$cur_date}',
                                        'pEmployee': '{$employee.userid}',
                                        'ids': ids,
                                        'action': 'avail_employees_for_multiple_slot_change',
                                        'method': '1'};
                                       changeEmployeeCustomer(process_details_obj,1);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                               case "change_customer":
                                   if(ids != ''){
                                       var process_details_obj = { 'page_date': '{$cur_date}',
                                        'pEmployee': '{$employee.userid}',
                                        'ids': ids,
                                        'action': 'avail_customers_for_multiple_slot_change',
                                        'method': '2'};
                                       changeEmployeeCustomer(process_details_obj,2);
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                                case "change_time":
                                   if(ids != ''){
                                    changeEmployeeTime();
                                   } else
                                       bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                               case "add_slot" :
                                    if($(this).attr('id') == 'slot_display_wraper'){
                                        var dates = $(this).attr('data-date');
                                        popupAddSlot(dates);
                                    }else
                                        popupAddSlot();
                                    break;
                               case "split_slot" :
                                    split_slot_event();
                                    break;
                               case "change_type_normal" :
                               case "change_type_travel" :
                               case "change_type_oncall" :
                               case "change_type_break" :
                               case "change_type_overtime" :
                               case "change_type_qual_overtime" :
                               case "change_type_more_time" :
                               case "change_type_some_other_time" :
                               case "change_type_training_time" :
                               case "change_type_call_training" :
                               case "change_type_personal_meeting" :
                               case "change_type_more_oncall" :
                               case "change_type_voluntary" :
                               case "change_type_complementary" :
                               case "change_type_complementary_oncall" :
                               case "change_type_oncall_standby":     
                                   switch(key){
                                       case "change_type_normal" : slot_type_change = 0; break;
                                       case "change_type_travel" : slot_type_change = 1; break;
                                       case "change_type_break" : slot_type_change = 2; break;
                                       case "change_type_oncall" : slot_type_change = 3; break;
                                       case "change_type_overtime" : slot_type_change = 4; break;
                                       case "change_type_qual_overtime" : slot_type_change = 5; break;
                                       case "change_type_more_time" : slot_type_change = 6; break;
                                       case "change_type_some_other_time" : slot_type_change = 7; break;
                                       case "change_type_training_time" : slot_type_change = 8; break;
                                       case "change_type_call_training" : slot_type_change = 9; break;
                                       case "change_type_personal_meeting" : slot_type_change = 10; break;
                                       case "change_type_voluntary" : slot_type_change = 11; break;
                                       case "change_type_complementary" : slot_type_change = 12; break;
                                       case "change_type_complementary_oncall" : slot_type_change = 13; break;
                                       case "change_type_more_oncall" : slot_type_change = 14; break;
                                       case "change_type_oncall_standby" : slot_type_change = 15; break;    
                                   }
                                   if(ids != ''){
                                       bootbox.dialog( '{$translate.confirm_changes}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        },{
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                            var mixed_normal_oncall_types = false;
                                            //special check for complementary and complementary-oncall
                                            if(slot_type_change == 12 || slot_type_change == 13){
                                                var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
                                                var oncall_slot_types = ['3', '9', '13', '14', '17'];
                                                var have_normal_slots = false, have_oncall_slots = false;
                                                var tmp_this_slot_type = '';
                                                $( '#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                                                    tmp_this_slot_type = $(this).parents('.slot-day').find('input.slot_details_hub').attr('data-type');
                                                    if($.inArray( tmp_this_slot_type, normal_slot_types ) > -1) //check if normal slot type
                                                        have_normal_slots = true;
                                                    else if($.inArray( tmp_this_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                                                        have_oncall_slots = true;
                                                });
                                                mixed_normal_oncall_types = (have_normal_slots == true && have_oncall_slots == true ? true : false);
                                            }
                                            if((slot_type_change == 12 || slot_type_change == 13) && mixed_normal_oncall_types == true){
                                                var prompt_msg = null;
                                                if(slot_type_change == 12) //complementary
                                                    prompt_msg = '{$translate.do_you_want_to_change_oncall_to_comp_oncall}';
                                                else if(slot_type_change == 13) //complementary-oncall
                                                    prompt_msg = '{$translate.do_you_want_to_change_normal_to_complementary}';
                                                
                                                    bootbox.dialog( prompt_msg, [{
                                                            "label" : "{$translate.cancel}",
                                                            "class" : "btn-primary"
                                                        },{
                                                            "label" : "{$translate.no}",
                                                            "class" : "btn-danger",
                                                            "callback": function() {
                                                                if(slot_type_change == 13){
                                                                    $.ajax({
                                                                        url: "{$url_path}ajax_check_oncall_inconve_range.php",
                                                                        type: "POST",
                                                                        data: 'ids='+ids,
                                                                        success:function(data){
                                                                            if(data == 'success'){
                                                                                var url = '{$url_path}ajax_right_click_actions.php';
                                                                                var url_post_data = { 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_alloc_window' };
                                                                                navigatePage(url,1, url_post_data); 
                                                                            }else
                                                                                bootbox.alert('{$translate.time_outside_oncall}', function(result){ });
                                                                        }
                                                                      });
                                                               }else{
                                                                    var url = '{$url_path}ajax_right_click_actions.php';
                                                                    var url_post_data = { 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_alloc_window' };
                                                                    navigatePage(url,1, url_post_data); 
                                                               }
                                                            }
                                                        },{
                                                            "label" : "{$translate.yes}",
                                                            "class" : "btn-success",
                                                            "callback": function() {
                                                                var url = '{$url_path}ajax_right_click_actions.php';
                                                                var url_post_data = { 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_alloc_window', 'normal_oncall_auto_change': true };
                                                                navigatePage(url,1, url_post_data);
                                                            }
                                                    }]);
                                            }
                                            else if(slot_type_change == 14 || slot_type_change == 3 || slot_type_change == 9 || slot_type_change == 13 || slot_type_change == 17){
                                                $.ajax({
                                                    url: "{$url_path}ajax_check_oncall_inconve_range.php",
                                                    type: "POST",
                                                    data: 'ids='+ids,
                                                    success:function(data){
                                                        if(data == 'success'){
                                                            var url = '{$url_path}ajax_right_click_actions.php';
                                                            var url_post_data = { 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_alloc_window' };
                                                            navigatePage(url,1, url_post_data); 
                                                        }else
                                                            bootbox.alert('{$translate.time_outside_oncall}', function(result){ });
                                                    }
                                                });
                                            }
                                            else{
                                                var url = '{$url_path}ajax_right_click_actions.php';
                                                var url_post_data = { 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_alloc_window' };
                                                navigatePage(url,1, url_post_data); 
                                            }
                                       }
                                       }]);
                                   } else
                                        bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                   break;
                            }
                        },
                        items: {
                            "goto": {   
                                        "name": "{$translate.go_to}", 
                                        accesskey: "{$translate.go_to}", 
                                        "items": {
                                            "go_to_employee":{ "name":"{$translate.employee}", accesskey: "{$translate.employee}" },
                                            "go_to_customer":{ "name":"{$translate.customer}", accesskey: "{$translate.customer}" }
                                        }
                                },
                            {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1}
                                {if $privileges_gd.process eq 1} "sep11": "---------", {/if}
                                "change": {   
                                        "name": "{$translate.change_action}", 
                                        disabled: ((included_candg_slots || !included_selected_slots) ? true : false),
                                        accesskey: "{$translate.change_action}", 
                                        "items": {
                                            {if $privileges_gd.add_employee eq 1}
                                                "change_employee":{ "name":"{$translate.employee}", accesskey: "{$translate.employee}", disabled: (included_candg_slots ? true : false) },
                                            {/if}
                                            {if $privileges_gd.add_customer eq 1}
                                                "change_customer": { "name": "{$translate.customer}", accesskey: "{$translate.customer}", disabled: (included_candg_slots ? true : false) },
                                            {/if}
                                            {if $privileges_gd.fkkn eq 1}
                                                "change_contract": { 
                                                    "name": "{$translate.right_click_menu_contract}",
                                                    disabled: ((included_candg_slots || !included_selected_slots) ? true : false),
                                                    accesskey: "{$translate.right_click_menu_contract}", 
                                                    "items" : {
                                                        "change_fk": { "name": "FK", accesskey: "FK", disabled: (included_candg_slots ? true : false) },
                                                        "change_kn": { "name": "KN", accesskey: "KN", disabled: (included_candg_slots ? true : false) },
                                                        "change_tu": { "name": "TU", accesskey: "TU", disabled: (included_candg_slots ? true : false) },
                                                    }
                                                },
                                            {/if}
                                            {if $privileges_gd.slot_type eq 1}
                                                "change_type": { 
                                                    "name": "{$translate.slot_type}",
                                                    disabled: ((included_candg_slots || !included_selected_slots) ? true : false),
                                                    accesskey: "{$translate.slot_type}", 
                                                    "items" : {
                                                    'change_type_oncall_standby':{ "name" : "{$translate.oncall_standby}"},

                                                            'change_type_training_time':{ "name" : "{$translate.training_time}"},
                                                            'change_type_call_training':{ "name" : "{$translate.call_training}" },
                                                            'change_type_complementary':{ "name" : "{$translate.complementary}"},
                                                            'change_type_complementary_oncall':{ "name" : "{$translate.complementary_oncall}"},
                                                            'change_type_qual_overtime':{ "name" : "{$translate.qual_overtime}"},
                                                            'change_type_normal':{ "name" : "{$translate.normal}"},
                                                            'change_type_personal_meeting':{ "name" : "{$translate.personal_meeting}"},
                                                             'change_type_break':{ "name" : "{$translate.break}"},
                                                             'change_type_travel':{ "name" : "{$translate.travel}"},
                                                            'change_type_more_time':{ "name" : "{$translate.more_time}"},
                                                            'change_type_more_oncall':{ "name" : "{$translate.more_oncall}"},
                                                            'change_type_some_other_time':{ "name" : "{$translate.some_other_time}" },
                                                            'change_type_voluntary':{ "name" : "{$translate.voluntary}"},
                                                            'change_type_oncall':{ "name" : "{$translate.oncall}"},
                                                            'change_type_overtime':{ "name" : "{$translate.overtime}"}
                                                    } 
                                                },
                                            {/if}
                                            {if $privileges_gd.change_time eq 1 }
                                                "change_time":{ "name":"{$translate.change_time}", accesskey: "{$translate.change_time}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                            {/if}
                                            {if $privileges_gd.split_slot eq 1}
                                                "split_slot": { "name": "{$translate.split_slot}", accesskey: "{$translate.split_slot}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                                            {/if}
                                        }
                                },
                            {/if}
                            {if $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1}
                                "delete": {
                                        "name": "{$translate.delete_action}",
                                        accesskey: "{$translate.delete_action}", 
                                        "items": {
                                            {if $privileges_gd.delete_slot eq 1} "delete_slot": { "name": "{$translate.slot}", accesskey: "{$translate.slot}" },{/if}
                                            {if $privileges_gd.remove_employee eq 1} "delete_employee": { "name": "{$translate.employee}", accesskey: "{$translate.employee}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },{/if}
                                            {if $privileges_gd.remove_customer eq 1} "delete_customer": { "name": "{$translate.customer}", accesskey: "{$translate.customer}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) }{/if}
                                        }

                                },
                            {/if}
                            {if $privileges_gd.add_slot eq 1}
                                "sep12": "---------",
                                "add_slot": { "name": "{$translate.add_new_slot}", accesskey: "{$translate.add_new_slot}"},
                            {/if}
                        }
                    }

                    if(included_candg_slots && !included_none_candg_slots){
                        {if $privileges_gd.candg_approve eq 1}
                            options.items.candg_approve = { 
                                    "name":"{$translate.approve}", 
                                    accesskey: "{$translate.approve}",
                                    callback: function(key, opt){ 
                                            var urls = '{$url_path}ajax_right_click_actions.php';
                                            var url_post_data = { 'ids': ids, 'action': 'slot_approve_candg', 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                            
                                            var processed_cust_names = [ ];
                                            $.each(ids_temp, function( index, value ) {
                                                var temp_sel_data_obj   = $('#slot_display_wraper #slot_thread_'+value).find('.slot_details_hub');
                                                processed_cust_names.push(temp_sel_data_obj.attr('data-customer-name'));

                                            });
                                            processed_cust_names = arrayUnique(processed_cust_names);
                                            
                                            bootbox.dialog( '{$translate.confirm_approval_candg} <br/><br/>{$translate.customer}: '+processed_cust_names.join(', '), [{
                                                    "label" : "{$translate.no}",
                                                    "class" : "btn-danger"
                                                },{
                                                    "label" : "{$translate.yes_to_all}",
                                                    "class" : "btn-primary",
                                                    "callback": function() {
                                                        var other_ids = [ ];
                                                        var processed_custs = [ ];
                                                            
                                                        $.each(ids_temp, function( index, value ) {
                                                            var temp_sel_data_obj   = $('#slot_display_wraper #slot_thread_'+value).find('.slot_details_hub');
                                                            var temp_sel_data_emp   = temp_sel_data_obj.attr('data-employee-id');
                                                            var temp_sel_data_cust  = temp_sel_data_obj.attr('data-customer-id');
                                                            
                                                            if($.inArray( temp_sel_data_cust, processed_custs ) == -1){

                                                                if(temp_sel_data_emp != '' && temp_sel_data_cust != ''){
                                                                    $( '#slot_display_wraper .slot-theme-candg input.slot_details_hub' ).each(function( index ) {
                                                                        if($(this).attr('data-employee-id') == temp_sel_data_emp && $(this).attr('data-customer-id') == temp_sel_data_cust && $(this).attr('data-id') != value){
                                                                            other_ids.push($(this).attr('data-id'));
                                                                        }
                                                                    });
                                                                    processed_custs.push(temp_sel_data_cust);
                                                                }
                                                            }
                                                                
                                                        });
                                                        
                                                        var final_ids = ids_temp.concat(other_ids);
                                                        url_post_data['ids'] = final_ids.join('-');
                                                        navigatePage(urls, 1, url_post_data);
                                                    }
                                                },{
                                                    "label" : "{$translate.yes}",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        navigatePage(urls, 1, url_post_data);
                                                    }
                                            }]);
                                    }
                            };

                            options.items.candg_reject = { 
                                    "name":"{$translate.reject}", 
                                    accesskey: "{$translate.reject}",
                                    callback: function(key, opt){ 
                                            var urls = '{$url_path}ajax_right_click_actions.php';
                                            var url_post_data = { 'ids': ids, 'action': 'multiple_slots_remove', 'page_date': '{$cur_date}', 'employee': '{$employee.userid}', 'request_from': 'gd_alloc_window' };
                                            bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                                                    "label" : "{$translate.no}",
                                                    "class" : "btn-danger",
                                                    "callback": function() {
                                                        bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                                    }
                                                }, {
                                                    "label" : "{$translate.yes}",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        navigatePage(urls, 1, url_post_data);
                                                    }
                                            }]);
                                    }
                            };
                        {/if}
                    }
                    
                    {if $privileges_gd.add_employee eq 1}
                        if(ids_temp.length == 1 && !included_candg_slots){
                            options.items.pmain_replace = { 
                                        "name":"{$translate.replace}", 
                                        accesskey: "{$translate.replace}",
                                        callback: function(key, opt){ 
                                                loadPopupReplaceProcessMain(ids);
                                        }
                            };
                        }
                    {/if}

                    if(ids_temp.length >= 1){
                        // "sep122": "---------",
                        options.items.sep122 = "---------";
                    }

                    if(ids_temp.length == 1){
                        options.items.find_similar = { 
                                    "name":"{$translate.find_similar}", 
                                    accesskey: "{$translate.find_similar}",
                                    callback: function(key, opt){ 
                                        var selected_id = ids;
                                        var slot_obj = $('#slot_display_wraper .slot-day input:checkbox.m_check[value='+ids+']').parents('.slot-day').find('input.slot_details_hub');
                                        var from_time = slot_obj.attr('data-time-from');
                                        var to_time = slot_obj.attr('data-time-to');

                                        $( '#slot_display_wraper .slot-day input.slot_details_hub' ).each(function( index ) {
                                            if($(this).attr('data-time-from') == from_time && $(this).attr('data-time-to') == to_time && $(this).attr('data-id') != selected_id){
                                                $(this).parents('.slot-day:not(:hidden)').find('input:checkbox.m_check').attr('checked', true);
                                            }
                                        });
                                    }
                        };
                    }

                    if(ids_temp.length >= 1){
                        options.items.unmark_all = { 
                                    "name":"{$translate.uncheck_all}", 
                                    accesskey: "{$translate.uncheck_all}",
                                    callback: function(key, opt){ 
                                        uncheck_all_work_slots();
                                    }
                        };
                    }

                    return options;
                }
            });
            
            {if $privileges_gd.add_employee eq 1}
                $('#replace-employee-week-basis #replace_emp_date_from_div, #replace-employee-week-basis #replace_emp_date_to_div').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
                .on('changeDate', function(ev){
                  loadEmployeesForReplacement();
                });
            {/if}
        });

        {if $privileges_gd.change_time eq 1}
            function changeEmployeeTime(){
                close_right_panel(false);
                show_right_panel();
                $('#change_time_of_slots,#slot_creation_main_wraper_group').removeClass('hide');
            } 

            function saveChangetimes(){
                var time_from =  $('#change_time_from').val();
                var time_to   =  $('#change_time_to').val();
                if(time_from > time_to){
                    bootbox.alert('{$translate.fromtime_should_be_lessthan_totime}', function(result){  });
                    return false;
                }
                
                var ids_temp = $('#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check').map(function () {
                    return this.value;
                }).get(); 

                var data_obj = {
                    'time_from' : time_from, 
                    'time_to' : time_to,
                    'ids': ids_temp.join(','),
                    'action':'change_slot_time',
                }
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:data_obj,
                    success:function(data){
                        if(data.result_flag == false){
                            $('#left_message_wraper').html(data.error_message);
                        }
                        else{
                            reload_content();
                        }
                    }
                });

            }           
        {/if}
        
        {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1}
            function changeEmployeeCustomer(process_details_obj, method){

                close_right_panel(false);
                $("#right_click_action_options, #change-employee-customer-options").removeClass('hide');

                var popup_title = '';
                if(method == 1){
                    popup_title = '{$translate.change_employee}';
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('employee');
                }else if(method == 2){
                    popup_title = '{$translate.change_customer}';
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('customer');
                }else 
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('');

                $('#right_click_action_options #change-employee-customer-options .panel-title').html(popup_title);
                $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('');
                $('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val(process_details_obj.ids);

                wrapLoader('#right_click_action_options');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        //console.log(data_process);
                        var avail_users = [];
                        if(method == 1)
                            avail_users = data_process.avail_employees;
                        else if(method == 2)
                            avail_users = data_process.avail_customers;

                        //console.log(avail_users.length);
                        if(avail_users.length > 0){
                            $.each(avail_users, function(i, value) {
                                $('#right_click_action_options #change-employee-customer-options #available_users_for_change').append('<div class="span12 available_user" style="margin-left: 0px;">\n\
                                                <div class="span12 child-slots" style="margin-top: 4px;">\n\
                                                    <label>\n\
                                                        <input type="radio" name="rd_change_user" value="'+value.username+'" class="check-box this_avail_user" />\n\
                                                        <span>'+value.ordered_name+'</span>'+(method == 1 && value.substitute == 1 ? '<span class="pull-right label label-info">{$translate.substitute}</span>' : '')+'\n\
                                                    </label>\n\
                                                </div>\n\
                                            </div>');
                            });
                            $('#change-employee-customer-options #btnChangeUserMultiple').removeClass('hide');
                        } else if(typeof data_process.message !== 'undefined'){
                            $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('<div class="message">'+data_process.message+'</div>');
                            $('#change-employee-customer-options #btnChangeUserMultiple').addClass('hide');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader('#right_click_action_options');
                });
            }

            function saveChangeUserMultiple(){

                var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
                var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
                var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

                //console.log(selected_user);

                if(typeof selected_user === 'undefined' || selected_user == '')
                    bootbox.alert('{$translate.no_user_selected}', function(result){ });
                else if(selected_slots == '')
                    bootbox.alert('{$translate.no_slot_selected}', function(result){ });
                else if(change_usertype == 'employee'){
                    wrapLoader('#right_click_action_options');
                    $.ajax({
                        url:    "{$url_path}ajax_customers_employees_change.php",
                        type:   "POST",
                        data:   "employee_username="+selected_user+"&ids="+selected_slots+"&action=check_overlap",
                        success:function(data){
                                if(data == 'sucess'){
                                    saveChangeUserMultipleConfirm();
                                }else
                                    bootbox.alert("{$translate.overlapped} " + data, function(result){ });
                        }
                    }).always(function(data) { 
                        uwrapLoader('#right_click_action_options');
                    });
                }else if(change_usertype == 'customer')
                    saveChangeUserMultipleConfirm();
            }

            function saveChangeUserMultipleConfirm(){
                var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
                var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
                var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

                var url = "employee={$employee.userid}&page_date={$cur_date}&method=1&request_from=gd_alloc_window&ids="+selected_slots;
                if(change_usertype == 'employee') url += "&employee_username="+selected_user;
                else if(change_usertype == 'customer') url += "&customer_select="+selected_user;

                var atl_req_data = url+'&type_check=17&right_click=1';
                var process_url = '{$url_path}ajax_alter_slot_employee_customer.php?'+url;
                check_atl_warning(atl_req_data, function(this_url){
                                close_right_panel();
                                navigatePage(this_url, 1);
                            }, process_url, '#right_click_action_options');
            }
        {/if}
        
        function popupAddSlot(date) {
            close_right_panel(true);
            date = (typeof date != 'undefined' ? date : '');
            if(date != ''){
                $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', date);
                $('.add-new-slots-month #new_slot_from').focus();
            }
            $('#tb_create_slot').trigger('click');
        }
        
        {if $privileges_gd.add_employee eq 1}
            function loadPopupReplaceProcessMain(ids) {
                
                var slot_obj = $('#slot_display_wraper .slot-day input:checkbox.m_check[value='+ids+']').parents('.slot-day');
                var slot_customer_id = slot_obj.find('input.slot_details_hub').attr('data-customer-id');
                var slot_customer_name = slot_obj.find('input.slot_details_hub').attr('data-customer-name');
                var slot_employee_id = slot_obj.find('input.slot_details_hub').attr('data-employee-id');
                var slot_employee_name = slot_obj.find('input.slot_details_hub').attr('data-employee-name');
                var slot_date = slot_obj.find('input.slot_details_hub').attr('data-date');

                //console.log(slot_obj);

                if(slot_employee_id == '')
                    bootbox.alert('{$translate.select_a_non_empty_employee_slot}', function(result){ });
                else{
                    close_right_panel(false);
                    $("#right_click_action_options, #replace-employee-week-basis").removeClass('hide');

                    $('#replace-employee-week-basis #spn_replacing_employee').html(slot_employee_name);
                    $('#replace-employee-week-basis #spn_replace_customer').html(slot_customer_name);
                    $('#replace-employee-week-basis #replace_emp_date_from_div').datepicker('update', slot_date);
                    $('#replace-employee-week-basis .slot_customer').val(slot_customer_id);
                    $('#replace-employee-week-basis .slot_employee').val(slot_employee_id);
                    $('#replace-employee-week-basis #replacement_employee_list').html('');
                }

            }

            function loadEmployeesForReplacement() {
                var dfrom = $('#replace-employee-week-basis #replace_emp_date_from').val();
                var dto = $('#replace-employee-week-basis #replace_emp_date_to').val();
                var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
                var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

                var customer_checked = $('#replace-employee-week-basis input:checkbox[name=repl_infocus]:checked').val();
                var is_customer_checked = 0;
                if (customer_checked) is_customer_checked = 1;

                $('#replace-employee-week-basis #replacement_employee_list').html('');
                if(dfrom != '' && dto != ''){

                    //&is_customer_checked='+is_customer_checked+'&type=rep_emp_load'
                    var process_details_obj = { 'start_date': dfrom,
                                            'end_date': dto,
                                            'selected_emp': slot_employee,
                                            'sel_customer': slot_customer,
                                            'is_customer_checked': is_customer_checked,
                                            'action': 'rep_emp_load'};

                    wrapLoader("#replace-employee-week-basis");
                    $.ajax({
                        url:"{$url_path}ajax_alloc_action_month.php",
                        type:"POST",
                        dataType: 'json',
                        data:process_details_obj,
                        success:function(data_process){
                            //console.log(data_process);
                            if(data_process.avail_employees.length > 0){
                                $.each(data_process.avail_employees, function(i, value) {
                                    //$employee['username'].'">'.$employee['name']
                                    $('#replace-employee-week-basis #replacement_employee_list').append('<input type="radio" value="'+value.username+'" name="week_rep_emp_radio" class="week_rep_emp_radio">'+value.ordered_name+'<br>');
                                });
                                $('#replace-employee-week-basis #btnReplaceEmpMultiple').removeClass('hide');
                            } else if(typeof data_process.message !== 'undefined'){
                                $('#replace-employee-week-basis #replacement_employee_list').html('<div class="message">'+data_process.message+'</div>');
                                $('#replace-employee-week-basis #btnReplaceEmpMultiple').addClass('hide');
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    })
                    .always(function(data) {
                        uwrapLoader("#replace-employee-week-basis");
                    });

                }
            }

            function saveReplaceMultipleConfirm(){

                var dfrom   = $.trim($('#replace-employee-week-basis #replace_emp_date_from').val());
                var dto     = $.trim($('#replace-employee-week-basis #replace_emp_date_to').val());

                var emp_rep = "";
                var emp_rep_values = $('#replace-employee-week-basis input:radio:checked.week_rep_emp_radio').map(function() {
                    return this.value;
                }).get();
                if (emp_rep_values.length) emp_rep = emp_rep_values[0];

                if(dfrom == '' || dto == '')
                    bootbox.alert('{$translate.please_select_one_date}', function(result){ });
                else if (emp_rep == '') 
                    bootbox.alert('{$translate.select_replace_employee}', function(result){ });
                else{
                    var in_focus = 0;
                    if ($('#replace-employee-week-basis #repl_infocus').attr("checked") == "checked")
                        in_focus = 1;

                    var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
                    var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

                    var process_details_obj = { 'from_date': dfrom,
                                            'to_date': dto,
                                            'employee': slot_employee,
                                            'employee_rep': emp_rep,
                                            'user': slot_customer,
                                            'focus': in_focus,
                                            'request_from': 'gd_alloc_window',
                                            'type': 'replace'};

                    wrapLoader("#replace-employee-week-basis");
                    $.ajax({
                        url:"{$url_path}ajax_process_main.php",
                        type:"POST",
                        dataType: 'json',
                        data:process_details_obj,
                        success:function(data_process){
                            //console.log(data_process);
                            if(data_process.result){
                                close_right_panel();
                                reload_content();
                            } else if(typeof data_process.message !== 'undefined'){
                                $('#left_message_wraper').html(data_process.message);
                                $('.main-left').animate({
                                    scrollTop: $('#left_message_wraper').offset().top
                                });
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    })
                    .always(function(data) {
                        uwrapLoader("#replace-employee-week-basis");
                    });
                }
            }
        {/if}

        function split_slot_event() {
            close_right_panel();
            show_right_panel();
            $("#slot_details_main_wraper_group").removeClass('hide');
            $("#tab_emp_slotcreate_memoryslots_sections, #slot-wrpr-slots, .btn-group-slots").addClass('hide');
            $("#slot-dela-pass-close").click(function(){ close_right_panel(); });
            var ids_temp = $('#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check').map(function () {
                return this.value;
            }).get();
            var ids = ids_temp.join('-');
            var included_slots = false;
            var slot_timefrom = null;
            var slot_timeto = null;
            $('#slot_display_wraper .slot-day:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                included_slots = true;
                var slot_data = $(this).parents('.slot-day').find('.slot_details_hub');
                slot_timefrom = $.trim(slot_data.attr('data-time-from'));
                slot_timeto = $.trim(slot_data.attr('data-time-to'));
            });
            $("#split_slot_timefrom").val(slot_timefrom);
            $("#split_slot_timeto").val(slot_timeto);
            $("#this_slot_actual_timefrom").val(slot_timefrom);
            $("#this_slot_actual_timeto").val(slot_timeto);
            //load slot timefrom - timeto as default
            if($("#slot-dela-pass").hasClass('hide')){
                $("#split_slot_timefrom").val(slot_timefrom);
                $("#split_slot_timeto").val(slot_timeto);
            }
            $('#slot_details_main_wraper_group #sdID').val(ids);
            //alert(slot_timefrom);
            $("#slot-dela-pass").toggleClass('hide');
            if(!$("#slot-dela-pass").hasClass('hide')){
                $('.main-right').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }
        }
    </script>

     <script>
	$(document).ready(function() {
	   $(".add-new-sl").click(function() {
			  $('html, body').animate({
                    scrollTop: $(".slot-section-wrpr").offset().top
                }, 2000);
	   });
           
           $('#tab-assign-emp-list #assignment-employees-wrpr .customer-name-slots').mousedown(function(e){ 
                    if( e.button == 2 ) { 
                        var slots_array = $('#slot_display_wraper .slot-theme-incomplete input:checkbox:checked.get_slot_check').map(function () {
                            return $(this).attr('data-slot-time-range');
                        }).get();

                        if(slots_array.length == 0){
                            var customer_id = $(this).attr('data-cust-name');
                            navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&customer='+customer_id,1);
                        }
                        return false; 
                    }
                    return false;  
               });
					 	
	    }).bind("contextmenu", function(e) {
                return false; 
            });
            
            $('#tab-assign-emp-list #assignment-employees-wrpr .customer-name-slots').hover(function(){
                var slots_array = $('#slot_display_wraper .slot-theme-incomplete input:checkbox:checked.get_slot_check').map(function () {
                    return $(this).attr('data-slot-time-range');
                }).get();
                if(slots_array.length == 0)
                    $(this).attr('title', '{$translate.right_click_to_go}');
                else
                    $(this).removeAttr('title');
            });
				
	</script>
        
{*    shortcut functions*}
{if $privileges_gd.process == 1}
    <script type="text/javascript" src="{$url_path}js/jquery.shortcuts.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.shortcuts.min.js"></script>
    <script type="text/javascript">
        $.Shortcuts.stop();
        $.Shortcuts.remove({ mask: 'Ctrl+C' });
        $.Shortcuts.remove({ mask: 'Ctrl+V' });
    </script>
{/if} 

<script>
	$(document).ready(function() {
            var stickyPanelOptions = {
                topPadding: 0,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };
            
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
        });
</script>
{/block}