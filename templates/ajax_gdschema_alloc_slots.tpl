 <style type="text/css">
        .scroll-pane, .scroll-pane-arrows{
                width: 100%;
                height: 200px;
                overflow: auto;
        }
        .horizontal-only{
                height: auto;
                max-height: 200px;
        }
        .scroll_content .jspPane{
            width: 485px;
        }
</style>
<script type="text/javascript">
$(document).ready(function(){
            type_selector_init();
            //scroller();
            $('.scroll_content').jScrollPane();
            {if $slot_entries_for_first_column|count gt 0 or $slot_entries_for_second_column|count gt 0}
                    $('#assigned_slots .option_head').html('{$translate.assigned_slots}  <a href="javascript:void(0);" class="btn_add_worker checkings" style="float: right;" onclick="check_all_work_slots()">{$translate.check_all}</a>');
            {/if}
                
            {if $dont_show_popup_delete_flag eq 1}
                $('#remove_dont_show_btn_span').html('<a href="javascript:void(0);" class="btn_add_worker" style="clear: none;min-width: 25px;" onclick="remove_dont_show_flag()">{$translate.remove_dont_show_again_button}</a>');
            {else}
                $('#remove_dont_show_btn_span').html('');
            {/if}
                
{*          change the status global button on top bar *}
            {if $flag_copy eq 1}
                $('.days_section #right_buttons a#gd_btn_copy').css('display', 'block');
                $('.days_section #right_buttons a#gd_btn_copy_multiple').css('display', 'block');
                
                {if $flag_sign eq 0}
                    $('.days_section #right_buttons a#gd_btn_delete').css('display', 'block');
                    $('.days_section #right_buttons a#gd_btn_delete_multiple').css('display', 'block');
                {/if}
            {/if}
            {if $flag_paste eq 1 and $flag_sign eq 0}
                $('.days_section #right_buttons a#gd_btn_past').css('display', 'block');
            {/if}
                
});
</script>
    
{$message}
{assign var = 'url_val' value='' scope='global'}
{assign var = 'url_val_popup' value='' scope='global'}
{assign var = 'url_val_slot' value='' scope='global'}
{if $employee.name != '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc_window.php?employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc_window.php?&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc_window.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc_window.php?customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}


<div class="scroll_content clearfix" style="width: 497px; overflow: hidden;">
        <div id="pop_up_themes">
            <div id="timetable_slot_assign" style="display:none;"></div>
            <div id="timetable_process" style="display:none;"></div>
            <div id="timetable_process_main" style="display:none;"></div>
            <div id="timetable_process_copy" style="display:none;"></div>
            <div id="timetable_assign" style="display:none;"></div>
            <div id="alloc_action" style="display:none;"></div>
            <div id="allocate_cusempwork" style="display: none;"></div>
            <div id="employee_slots" style="display: none;"></div>
        </div>
        {assign i 0}
        <div style="width: 242px;float: left">
            {foreach $slot_entries_for_first_column as $slot_det}
                
                <div id="d{$slot_det.id}" {if $slot_det.type == 10 &&  $slot_det.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if} class="{if $slot_det.status eq 1 and $slot_det.created_status eq 1}custom_time_slots_cng_accept clearfix{elseif $slot_det.status eq 1}custom_time_slots clearfix{else if $slot_det.status eq 2}custom_time_slots_leave clearfix{elseif $slot_det.status eq 4}custom_time_slots_cg clearfix{else}custom_time_slots_incomplete clearfix{/if}" >
                <div class="left_col" {if $slot_det.status == 2} style="width: 80%;" {else} style="width: 175px;" {/if}>
                    <div class="time">
                        <a class="duration" href="javascript:void(0);" {if $slot_det.signed_in == 0 and $slot_det.status != 2}{if $slot_det.privileges_gd.change_time == 1 && $slot_det.tl_flag == 1  and $slot_det.status != 4}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type={$slot_det.type}&action=edit_duration')"{/if}{if $slot_det.type == 10 &&  $slot_det.status == 1 && $slot_det.privileges_gd.change_time == 1}style="background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3"{elseif $slot_det.type == 10 &&  $slot_det.status == 1 && $slot_det.privileges_gd.change_time == 0}style="background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3;cursor: default"{elseif $slot_det.privileges_gd.change_time == 0} style="cursor: default;"{/if}{else} style="cursor: default;{if $slot_det.type == 10 &&  $slot_det.status == 1} background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3{/if}"{/if} >{$slot_det.slot} ({$slot_det.slot_hour})</a>
                            <span class="duration_btn">
                                {if ($slot_det.status != 2 && $slot_det.status != 4)  && $slot_det.signed_in == 0}    
                                    {if $slot_det.status == 3}<a href="javascript:void(0);" {if $emp_role == 1 || $emp_role == 6}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=direct')"{/if}><img src="{$url_path}images/unlocked.jpg"/></a>
                                    {else}
                                        {if $emp_role == 1 || $emp_role == 6}<a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=3&action=direct')"><img src="{$url_path}images/locked.jpg"/></a>{/if}
                                    {/if}
                                {/if}
                            </span>
                            {if $slot_det.customer and $slot_det.status neq 2}
                                    <div class="fk_kn_selected">
                                        <ul class="fk_kn_dmenu">
                                            <li style="margin-bottom:2px; display:block;">
                                                {if $slot_det.fkkn eq 1}<a style="display:block;" class="fk_style border_fkkn">{$translate.fk}</a>
                                                {else if $slot_det.fkkn eq 2}<a style="display:block;" class="border_fkkn">{$translate.kn}</a>
                                                {else if $slot_det.fkkn eq 3}<a style="display:block;" class="border_fkkn">{$translate.tu}</a>{/if}
                                                <ul class="sub-menu">
                                                    {if $slot_det.fkkn neq 1}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=1&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="fk_style border_fkkn">{$translate.fk}</a>{/if}
                                                    {if $slot_det.fkkn neq 2}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.kn}</a></li>{/if}
                                                    {if $slot_det.fkkn neq 3}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=3&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.tu}</a></li>{/if}
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                            {/if}

                            <span class="custom_slot"></span>
                            {if $slot_det.status == 2}
                                <div id="leave_slot_description" class="leave_sick">{$slot_det.leave_data.leave_name}</div>
                            {/if}
                            {if htmlspecialchars($slot_det.comment) != '' || htmlspecialchars($slot_det.comment) != null}<img src="{$url_path}images/icon_comment.png" title="{htmlspecialchars($slot_det.comment)}" style="cursor: default; padding-left: 2px">{/if}
                    </div>
                    <div class="company clearfix">
                        {if $slot_det.customer neq ''}
                            <span class="company_name">{if $slot_det.status == 1}<a href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&customer={$slot_det.customer}',1)">{$slot_det.cust_name}</a>{else}{$slot_det.cust_name}{/if}
                                {if $slot_det.privileges_gd.remove_customer eq 1 and $slot_det.signed_in eq 0}
                                    {if $slot_det.tl_flag ==1 and $slot_det.status != 4}
                                        <a href="javascript:void(0);" onclick="custRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=cust_remove'}')" class="remove" title="{$translate.boka_pass_customer_remove}"></a>
                                    {/if}
                                {/if}
                            </span>
                        {else}<span class="add_company"><a href="javascript:void(0);" class="btn_add_company" {if $slot_det.privileges_gd.add_customer eq 1 and $customers_to_assign|count eq 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_cust')"title="{$translate.boka_pass_customer_add}"{elseif $slot_det.privileges_gd.add_customer eq 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_cust')"title="{$translate.boka_pass_customer_add}"{else}onclick="messagePrivilege()"{/if}>{$translate.add_company}</a></span>{/if}
                    </div>
                    <div class="worker clearfix" {if $slot_det.status eq 2}style="margin-top:4px;"{/if}>
                        {if $slot_det.employee neq ''}
                            <span class="worker_name">{if $slot_det.status == 1}<a href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&employee={$slot_det.employee}',1)">{$slot_det.emp_name}</a>{else}{$slot_det.emp_name}{/if}
                                {if $slot_det.privileges_gd.remove_employee eq 1 and $slot_det.signed_in eq 0}
                                    {if $slot_det.tl_flag ==1  and $slot_det.status != 4}
                                        <a href="javascript:void(0);" onclick="empRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=emp_remove'}')" class="remove" title="{$translate.boka_pass_employee_remove}"></a>
                                    {/if}
                                {/if}
                            </span>
                        {else}<span class="add_worker"><a href="javascript:void(0);" class="btn_add_worker" {if $slot_det.privileges_gd.add_employee eq 1 and $emp_role eq 3}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_emp')" title="{$translate.boka_pass_employee_add}" {elseif $slot_det.privileges_gd.add_employee eq 1 and $employees_to_assign|count eq 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_emp')" title="{$translate.boka_pass_employee_add}"{elseif $slot_det.privileges_gd.add_employee eq 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_emp')" title="{$translate.boka_pass_employee_add}"{else}onclick="messagePrivilege()"{/if}>{$translate.add_worker}</a></span>{/if}
                    </div>
                </div>
                <div class="time_option" {if $slot_det.status == 4}style="width: 42px"{/if}>
                    {if $slot_det.privileges_gd.delete_slot eq 1 and $slot_det.signed_in eq 0 and $slot_det.tl_flag ==1}
                       <a title="{$translate.delete}" href="javascript:void(0);" class="close" onclick="slotRemove('{$url_val}&id={$slot_det.id}&action=slot_remove')" {if $slot_det.status == 4}style="background: url({$url_path}images/slotes_close.png) no-repeat; margin-right:2px"{/if}></a>
                    {/if}

                    {if $slot_det.status == 2 && $slot_det.signed_in == 0 && $slot_det.tl_flag ==1}
                        {if $slot_det.leave_data.status == 0}
                            {if $privileges_mc.leave_approval == 1}
                                <div id="leave_slot_approve_{$slot_det.id}" align="center" style="padding-bottom:6px;cursor: pointer;" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&status=1'}', 1);"><img width="25" border="0" src="{$url_path}images/icon_approve.png" alt="" title="{$translate.approve}"/></div>
                            {/if}
                            {if $privileges_mc.leave_rejection == 1}
                                <div id="leave_slot_reject_{$slot_det.id}" align="center" style="padding-bottom:6px;cursor: pointer;" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&employee='|cat:$slot_det.employee|cat:'&date='|cat:$slot_det.date|cat:'&t_from='|cat:$slot_det.leave_data.time_from|cat:'&t_to='|cat:$slot_det.leave_data.time_to|cat:'&status=2'}', 2);" ><img width="25" border="0" src="{$url_path}images/cirrus_icon_reject.png" alt="" title="{$translate.reject}" /></div>
                            {/if}
                        {elseif $slot_det.leave_data.status == 1 && $privileges_mc.leave_edit == 1}
                            <div id="leave_slot_edit_{$slot_det.id}" align="center" style="padding-bottom:6px; cursor: pointer;" onclick="edit_leave_slot('{'slotid='|cat:$slot_det.id|cat:'&id='|cat:$slot_det.leave_data.id|cat:'&employee='|cat:$slot_det.employee|cat:'&date='|cat:$slot_det.date|cat:'&t_from='|cat:$slot_det.leave_data.time_from|cat:'&t_to='|cat:$slot_det.leave_data.time_to|cat:'&status=-1'}');" ><img width="25" border="0" src="{$url_path}images/leave_cancel.png" alt="" title="{$translate.back_to_work}" /></div>
                            {if $slot_det.privileges_gd.add_slot == 1 and $slot_det.leave_data.is_exist_relation eq 0}<div id="leave_slot_clone_{$slot_det.id}" align="center" style="padding-bottom:6px; cursor: pointer;" onclick="loadAjax('{$url_val|cat:'&slotid='|cat:$slot_det.id|cat:'&action=clone_leaveslot'}');" ><img width="25" border="0" src="{$url_path}images/clone_pic.png" alt="" title="{$translate.clone_relation}" /></div>{/if}
                        {/if}
                    {/if}

                    {if ($slot_det.status != 2 && $slot_det.status != 4) && $slot_det.signed_in == 0}  
                        {*{if ($privileges_gd.leave == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1 || $privileges_gd.swap == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1) && $slot_det.signed_in == 0 and (($emp_role eq 3 and $slot_det.employee eq $emp_alloc) or ($emp_role neq 3))}*}
                        {if ($slot_det.privileges_gd.leave == 1 || $slot_det.privileges_gd.copy_single_slot == 1 || $slot_det.privileges_gd.copy_single_slot_option == 1 || $slot_det.privileges_gd.swap == 1 || $slot_det.privileges_gd.delete_slot == 1 || $slot_det.privileges_gd.split_slot == 1 || $slot_det.privileges_gd.add_customer == 1 || $slot_det.privileges_gd.add_employee == 1 || $slot_det.privileges_gd.fkkn == 1 || $slot_det.privileges_gd.slot_type == 1) && $slot_det.signed_in == 0}
                                <a title="{$translate.manage}" href="javascript:void(0);" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$slot_det.date}&slot={$slot_det.id}', '{$url_val_reload}')" class="settings"></a>
                        {else}
                                <a title="{$translate.manage}" href="javascript:void(0);" onclick="messagePrivilege()" class="settings"></a>
                        {/if}
                    {elseif $slot_det.status == 4}
                        <a title="{$translate.manage}" href="javascript:void(0);" onclick="acceptCandGSlot('{$url_val}&id={$slot_det.id}&action=slot_approve_candg')" class="accept_candg"></a>
                    {/if}

                    {if $slot_det.status neq 2}
                        <div class="type_selector clearfix">
                            {if $slot_det.status != 4 && $slot_det.privileges_gd.slot_type eq 1  and $slot_det.tl_flag ==1}<span class="type_open" data-close-flag='close'><a href="#"></a></span>
                                <ul class="clearfix">
                                    <li {if $slot_det.type eq 1}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=1&action=type')"{/if}><a title="{$translate.travel}" href="javascript:void(0);" class="travel"></a></li>
                                    <li {if $slot_det.type eq 0}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=0&action=type')"{/if}><a title="{$translate.normal}" href="javascript:void(0);" class="work"></a></li>
                                    <li {if $slot_det.type eq 2}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=2&action=type')"{/if}><a title="{$translate.break}" href="javascript:void(0);" class="lunch"></a></li>
                                    <li {if $slot_det.type eq 3}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=3&action=type')"{/if}><a title="{$translate.oncall}" href="javascript:void(0);" class="oncall"></a></li>
                                    <li {if $slot_det.type eq 4}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=4&action=type')"{/if}><a title="{$translate.overtime}" href="javascript:void(0);" class="overtime"></a></li>
                                    <li {if $slot_det.type eq 5}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=5&action=type')"{/if}><a title="{$translate.qual_overtime}" href="javascript:void(0);" class="qual_overtime"></a></li>
                                    <li {if $slot_det.type eq 6}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=6&action=type')"{/if}><a title="{$translate.more_time}" href="javascript:void(0);" class="more_time"></a></li>
                                    <li {if $slot_det.type eq 14}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=14&action=type')"{/if}><a title="{$translate.more_oncall}" href="javascript:void(0);" class="more_oncall"></a></li>
                                    <li {if $slot_det.type eq 7}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=7&action=type')"{/if}><a title="{$translate.some_other_time}" href="javascript:void(0);" class="some_other_time"></a></li>
                                    <li {if $slot_det.type eq 8}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=8&action=type')"{/if}><a title="{$translate.training_time}" href="javascript:void(0);" class="training_time"></a></li>
                                    <li {if $slot_det.type eq 9}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=9&action=type')"{/if}><a title="{$translate.call_training}" href="javascript:void(0);" class="call_training"></a></li>
                                    <li {if $slot_det.type eq 10}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=10&action=type')"><a title="{$translate.personal_meeting}" href="javascript:void(0);" class="personal_meeting"></a></li>
                                    <li {if $slot_det.type eq 11}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=11&action=type')"{/if}><a title="{$translate.voluntary}" href="javascript:void(0);" class="voluntary"></a></li>
                                    <li {if $slot_det.type eq 12}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=12&action=type')"{/if}><a title="{$translate.complementary}" href="javascript:void(0);" class="complementary"></a></li>
                                    <li {if $slot_det.type eq 13}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=13&action=type')"{/if}><a title="{$translate.complementary_oncall}" href="javascript:void(0);" class="complementary_oncall"></a></li>
                                </ul>
                            {else}
                               <ul class="clearfix">
                                    <li class="selected">
                                        {if $slot_det.type eq 1}<a title="{$translate.travel}" href="javascript:void(0);"  class="travel"></a>
                                        {elseif $slot_det.type eq 0}<a title="{$translate.normal}" href="javascript:void(0);"  class="work"></a>
                                        {elseif $slot_det.type eq 2}<a title="{$translate.break}" href="javascript:void(0);"  class="lunch"></a>
                                        {elseif $slot_det.type eq 3}<a title="{$translate.oncall}" href="javascript:void(0);"  class="oncall"></a>
                                        {elseif $slot_det.type eq 4}<a title="{$translate.overtime}" href="javascript:void(0);"  class="overtime"></a>
                                        {elseif $slot_det.type eq 5}<a title="{$translate.qual_overtime}" href="javascript:void(0);"  class="qual_overtime"></a>
                                        {elseif $slot_det.type eq 6}<a title="{$translate.more_time}" href="javascript:void(0);"  class="more_time"></a>
                                        {elseif $slot_det.type eq 14}<a title="{$translate.more_oncall}" href="javascript:void(0);"  class="more_oncall"></a>
                                        {elseif $slot_det.type eq 7}<a title="{$translate.some_other_time}" href="javascript:void(0);"  class="some_other_time"></a>
                                        {elseif $slot_det.type eq 8}<a title="{$translate.training_time}" href="javascript:void(0);"  class="training_time"></a>
                                        {elseif $slot_det.type eq 9}<a title="{$translate.call_training}" href="javascript:void(0);"  class="call_training"></a>
                                        {elseif $slot_det.type eq 10}<a title="{$translate.personal_meeting}" href="javascript:void(0);"  class="personal_meeting"></a>
                                        {elseif $slot_det.type eq 11}<a title="{$translate.voluntary}" href="javascript:void(0);"  class="voluntary"></a>
                                        {elseif $slot_det.type eq 12}<a title="{$translate.complementary}" href="javascript:void(0);"  class="complementary"></a>
                                        {elseif $slot_det.type eq 13}<a title="{$translate.complementary_oncall}" href="javascript:void(0);"  class="complementary_oncall"></a>{/if}
                                    </li>
                                </ul>  
                             {/if}
                        </div>
                    {/if}
                </div>
                {if $slot_det.status neq 2 and $slot_det.tl_flag ==1}
                   {if $slot_det.signed_in == 0 && $slot_det.status != 4} <input type="checkbox" class="slot_assign_check get_slot_check" value="{$slot_det.id}" id="slot_{$i}" data-slot-no="{$i}" data-slot-time-range="{$slot_det.slot}"  style="margin-top: 5px;margin-left: 2px;float: right;" {if ($slot_det.privileges_gd.add_employee eq 1 or $slot_det.privileges_gd.copy_day_slot eq 1 or $slot_det.privileges_gd.delete_day_slot eq 1) and $slot_det.employee eq ''}onclick="employee_assign_slot('{$i}','{$slot_det.slot}','{$slot_det.id}')"{elseif $slot_det.customer eq ''}onclick="customer_assign_slot('{$i}','{$slot_det.slot}','{$slot_det.id}')"{/if} />{/if}
                    {assign i $i+1}
                {/if}
                {if $slot_det.signed_in != 0} <div class="notworking_time_slot" style="width: 239px; height: 67px;background: url('{$url_path}images/signed_slot_allot.png') no-repeat scroll 0 0 transparent"></div>{/if}
            </div>
            
        {/foreach}
    </div>
    <div style="width: 242px;float: left">
        {foreach $slot_entries_for_second_column as $slot_det}
            
            <div id="d{$slot_det.id}" {if $slot_det.type == 10 &&  $slot_det.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if} class="{if $slot_det.status eq 1 and $slot_det.created_status eq 1}custom_time_slots_cng_accept clearfix{elseif $slot_det.status eq 1}custom_time_slots clearfix{else if $slot_det.status eq 2}custom_time_slots_leave clearfix{elseif $slot_det.status eq 4}custom_time_slots_cg clearfix{else}custom_time_slots_incomplete clearfix{/if}" >
                <div class="left_col" {if $slot_det.status == 2} style="width: 80%;" {else} style="width: 175px;"{/if}>
                    <div class="time">
                            <a class="duration" href="javascript:void(0);" {if $slot_det.signed_in == 0 and $slot_det.status != 2}{if $slot_det.privileges_gd.change_time == 1 && $slot_det.tl_flag ==1  and $slot_det.status != 4}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type={$slot_det.type}&action=edit_duration')"{/if}{if $slot_det.type == 10 &&  $slot_det.status == 1 && $slot_det.privileges_gd.change_time == 1}style="background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3" {elseif $slot_det.type == 10 &&  $slot_det.status == 1 && $slot_det.privileges_gd.change_time == 0}style="background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3"{elseif $slot_det.privileges_gd.change_time == 0} style="cursor: default;"{/if}{else} style="cursor: default;{if $slot_det.type == 10 &&  $slot_det.status == 1} background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3{/if}"{/if} >{$slot_det.slot} ({$slot_det.slot_hour})</a>
                            <span class="duration_btn">
                                {if ($slot_det.status != 2 && $slot_det.status != 4)  && $slot_det.signed_in == 0}    
                                    {if $slot_det.status == 3}<a href="javascript:void(0);" {if $emp_role == 1 || $emp_role == 6}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=direct')"{/if}><img src="{$url_path}images/unlocked.jpg"/></a>
                                    {else}
                                        {if $emp_role == 1 || $emp_role == 6}<a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=3&action=direct')"><img src="{$url_path}images/locked.jpg"/></a>{/if}
                                    {/if}
                                {/if}
                            </span>
                            {if $slot_det.customer and $slot_det.status neq 2}
                                    <div class="fk_kn_selected">
                                        <ul class="fk_kn_dmenu">
                                            <li style="margin-bottom:2px; display:block;">
                                                {if $slot_det.fkkn eq 1}<a style="display:block;" class="fk_style border_fkkn">{$translate.fk}</a>
                                                {else if $slot_det.fkkn eq 2}<a style="display:block;" class="border_fkkn">{$translate.kn}</a>
                                                {else if $slot_det.fkkn eq 3}<a style="display:block;" class="border_fkkn">{$translate.tu}</a>{/if}
                                                <ul class="sub-menu">
                                                    {if $slot_det.fkkn neq 1}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=1&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="fk_style border_fkkn">{$translate.fk}</a>{/if}
                                                    {if $slot_det.fkkn neq 2}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.kn}</a></li>{/if}
                                                    {if $slot_det.fkkn neq 3}<li><a href="javascript:void(0);" {if $slot_det.privileges_gd.fkkn eq 1 and $slot_det.tl_flag == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=3&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.tu}</a></li>{/if}
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                            {/if}

                            <span class="custom_slot"></span>
                            {if $slot_det.status == 2}
                                <div id="leave_slot_description" class="leave_sick">{$slot_det.leave_data.leave_name}</div>
                            {/if}
                            {if htmlspecialchars($slot_det.comment) != '' || htmlspecialchars($slot_det.comment) != null}<img src="{$url_path}images/icon_comment.png" title="{htmlspecialchars($slot_det.comment)}" style="cursor: default; padding-left: 2px">{/if}
                    </div>
                    <div class="company clearfix">
                        {if $slot_det.customer neq ''}
                             <span class="company_name">{if $slot_det.status == 1}<a href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&customer={$slot_det.customer}',1)">{$slot_det.cust_name}</a>{else}{$slot_det.cust_name}{/if}
                                {if $slot_det.privileges_gd.remove_customer eq 1 and $slot_det.signed_in eq 0}
                                    {if $slot_det.tl_flag ==1 and $slot_det.status != 4}
                                        <a href="javascript:void(0);" onclick="custRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=cust_remove'}')" class="remove"></a>
                                    {/if}
                                {/if}
                            </span>
                        {else}<span class="add_company"><a href="javascript:void(0);" class="btn_add_company" {if $slot_det.privileges_gd.add_customer eq 1 and $customers_to_assign|count eq 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_cust')"{elseif $slot_det.privileges_gd.add_customer eq 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_cust')"{else}onclick="messagePrivilege()"{/if}>{$translate.add_company}</a></span>{/if}
                    </div>
                    <div class="worker clearfix" {if $slot_det.status eq 2}style="margin-top:4px;"{/if}>
                        {if $slot_det.employee neq ''}
                            <span class="worker_name">{if $slot_det.status == 1}<a href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$cur_date}&employee={$slot_det.employee}',1)">{$slot_det.emp_name}</a>{else}{$slot_det.emp_name}{/if}
                                {if $slot_det.privileges_gd.remove_employee eq 1 and $slot_det.signed_in eq 0}
                                    {if $slot_det.tl_flag ==1  and $slot_det.status != 4}
                                        <a href="javascript:void(0);" onclick="empRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=emp_remove'}')" class="remove"></a>
                                    {/if}
                                {/if}
                            </span>
                        {else}<span class="add_worker"><a href="javascript:void(0);" class="btn_add_worker" {if $slot_det.privileges_gd.add_employee eq 1 and $emp_role eq 3}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_emp')"{elseif $slot_det.privileges_gd.add_employee eq 1 and $employees_to_assign|count eq 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&action=add_emp')"{elseif $slot_det.privileges_gd.add_employee eq 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_emp')"{else}onclick="messagePrivilege()"{/if}>{$translate.add_worker}</a></span>{/if}
                    </div>
                </div>
                <div class="time_option" {if $slot_det.status == 4}style="width: 42px"{/if}>
                    {if $slot_det.privileges_gd.delete_slot eq 1 and $slot_det.signed_in eq 0 and $slot_det.tl_flag ==1}
                        <a title="{$translate.delete}" href="javascript:void(0);" class="close" onclick="slotRemove('{$url_val}&id={$slot_det.id}&action=slot_remove')" {if $slot_det.status == 4}style="background: url({$url_path}images/slotes_close.png) no-repeat; margin-right:2px"{/if}></a>
                    {/if}
                    
                    {if $slot_det.status == 2 && $slot_det.signed_in == 0 && $slot_det.tl_flag ==1}
                        {if $slot_det.leave_data.status == 0}
                            {if $privileges_mc.leave_approval == 1}
                                <div id="leave_slot_approve_{$slot_det.id}" align="center" style="padding-bottom:6px;cursor: pointer;" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&status=1'}', 1);"><img width="25" border="0" src="{$url_path}images/icon_approve.png" alt="" title="{$translate.approve}"/></div>
                            {/if}
                            {if $privileges_mc.leave_rejection == 1}
                                <div id="leave_slot_reject_{$slot_det.id}" align="center" style="padding-bottom:6px;cursor: pointer;" onclick="update_leave_status('{'id='|cat:$slot_det.leave_data.id|cat:'&employee='|cat:$slot_det.employee|cat:'&date='|cat:$slot_det.date|cat:'&t_from='|cat:$slot_det.leave_data.time_from|cat:'&t_to='|cat:$slot_det.leave_data.time_to|cat:'&status=2'}', 2);" ><img width="25" border="0" src="{$url_path}images/cirrus_icon_reject.png" alt="" title="{$translate.reject}" /></div>
                            {/if}
                        {elseif $slot_det.leave_data.status == 1 && $privileges_mc.leave_edit == 1}
                            <div id="leave_slot_edit_{$slot_det.id}" align="center" style="padding-bottom:6px; cursor: pointer;" onclick="edit_leave_slot('{'slotid='|cat:$slot_det.id|cat:'&id='|cat:$slot_det.leave_data.id|cat:'&employee='|cat:$slot_det.employee|cat:'&date='|cat:$slot_det.date|cat:'&t_from='|cat:$slot_det.leave_data.time_from|cat:'&t_to='|cat:$slot_det.leave_data.time_to|cat:'&status=-1'}');" ><img width="25" border="0" src="{$url_path}images/leave_cancel.png" alt="" title="{$translate.back_to_work}" /></div>
                            {if $slot_det.privileges_gd.add_slot == 1 and $slot_det.leave_data.is_exist_relation eq 0}<div id="leave_slot_clone_{$slot_det.id}" align="center" style="padding-bottom:6px; cursor: pointer;" onclick="loadAjax('{$url_val|cat:'&slotid='|cat:$slot_det.id|cat:'&action=clone_leaveslot'}');" ><img width="25" border="0" src="{$url_path}images/clone_pic.png" alt="" title="{$translate.clone_relation}" /></div>{/if}
                        {/if}
                    {/if}

                    {if ($slot_det.status != 2 && $slot_det.status != 4) && $slot_det.signed_in == 0}  
                        {*{if ($privileges_gd.leave == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1 || $privileges_gd.swap == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1) && $slot_det.signed_in == 0 and (($emp_role eq 3 and $slot_det.employee eq $emp_alloc) or ($emp_role neq 3))}*}
                        {if ($slot_det.privileges_gd.leave == 1 || $slot_det.privileges_gd.copy_single_slot == 1 || $slot_det.privileges_gd.copy_single_slot_option == 1 || $slot_det.privileges_gd.swap == 1 || $slot_det.privileges_gd.delete_slot == 1 || $slot_det.privileges_gd.split_slot == 1 || $slot_det.privileges_gd.add_customer == 1 || $slot_det.privileges_gd.add_employee == 1 || $slot_det.privileges_gd.fkkn == 1 || $slot_det.privileges_gd.slot_type == 1) && $slot_det.signed_in == 0}
                                <a title="{$translate.manage}" href="javascript:void(0);" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$slot_det.date}&slot={$slot_det.id}', '{$url_val_reload}')" class="settings"></a>
                        {else}
                                <a title="{$translate.manage}" href="javascript:void(0);" onclick="messagePrivilege()" class="settings"></a>
                        {/if}
                    {elseif $slot_det.status == 4}
                        <a title="{$translate.manage}" href="javascript:void(0);" onclick="acceptCandGSlot('{$url_val}&id={$slot_det.id}&action=slot_approve_candg')" class="accept_candg"></a>
                    {/if}

                    {if $slot_det.status neq 2}
                        <div class="type_selector clearfix">
                            {if $slot_det.status != 4 && $slot_det.privileges_gd.slot_type eq 1  and $slot_det.tl_flag ==1}<span class="type_open" data-close-flag='close'><a href="#"></a></span>
                                <ul class="clearfix">
                                    <li {if $slot_det.type eq 1}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=1&action=type')"{/if}><a title="{$translate.travel}" href="javascript:void(0);" class="travel"></a></li>
                                    <li {if $slot_det.type eq 0}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=0&action=type')"{/if}><a title="{$translate.normal}" href="javascript:void(0);" class="work"></a></li>
                                    <li {if $slot_det.type eq 2}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=2&action=type')"{/if}><a title="{$translate.break}" href="javascript:void(0);" class="lunch"></a></li>
                                    <li {if $slot_det.type eq 3}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=3&action=type')"{/if}><a title="{$translate.oncall}" href="javascript:void(0);" class="oncall"></a></li>
                                    <li {if $slot_det.type eq 4}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=4&action=type')"{/if}><a title="{$translate.overtime}" href="javascript:void(0);" class="overtime"></a></li>
                                    <li {if $slot_det.type eq 5}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=5&action=type')"{/if}><a title="{$translate.qual_overtime}" href="javascript:void(0);" class="qual_overtime"></a></li>
                                    <li {if $slot_det.type eq 6}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=6&action=type')"{/if}><a title="{$translate.more_time}" href="javascript:void(0);" class="more_time"></a></li>
                                    <li {if $slot_det.type eq 14}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=14&action=type')"{/if}><a title="{$translate.more_oncall}" href="javascript:void(0);" class="more_oncall"></a></li>
                                    <li {if $slot_det.type eq 7}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=7&action=type')"{/if}><a title="{$translate.some_other_time}" href="javascript:void(0);" class="some_other_time"></a></li>
                                    <li {if $slot_det.type eq 8}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=8&action=type')"{/if}><a title="{$translate.training_time}" href="javascript:void(0);" class="training_time"></a></li>
                                    <li {if $slot_det.type eq 9}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=9&action=type')"{/if}><a title="{$translate.call_training}" href="javascript:void(0);" class="call_training"></a></li>
                                    <li {if $slot_det.type eq 10}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=10&action=type')"><a title="{$translate.personal_meeting}" href="javascript:void(0);" class="personal_meeting"></a></li>
                                    <li {if $slot_det.type eq 11}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=11&action=type')"{/if}><a title="{$translate.voluntary}" href="javascript:void(0);" class="voluntary"></a></li>
                                    <li {if $slot_det.type eq 12}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=12&action=type')"{/if}><a title="{$translate.complementary}" href="javascript:void(0);" class="complementary"></a></li>
                                    <li {if $slot_det.type eq 13}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=13&action=type')"{/if}><a title="{$translate.complementary_oncall}" href="javascript:void(0);" class="complementary_oncall"></a></li>
                                </ul>
                            {else}
                               <ul class="clearfix">
                                    <li class="selected">
                                        {if $slot_det.type eq 1}<a title="{$translate.travel}" href="javascript:void(0);"  class="travel"></a>
                                        {elseif $slot_det.type eq 0}<a title="{$translate.normal}" href="javascript:void(0);"  class="work"></a>
                                        {elseif $slot_det.type eq 2}<a title="{$translate.break}" href="javascript:void(0);"  class="lunch"></a>
                                        {elseif $slot_det.type eq 3}<a title="{$translate.oncall}" href="javascript:void(0);"  class="oncall"></a>
                                        {elseif $slot_det.type eq 4}<a title="{$translate.overtime}" href="javascript:void(0);"  class="overtime"></a>
                                        {elseif $slot_det.type eq 5}<a title="{$translate.qual_overtime}" href="javascript:void(0);"  class="qual_overtime"></a>
                                        {elseif $slot_det.type eq 6}<a title="{$translate.more_time}" href="javascript:void(0);"  class="more_time"></a>
                                        {elseif $slot_det.type eq 14}<a title="{$translate.more_oncall}" href="javascript:void(0);"  class="more_oncall"></a>
                                        {elseif $slot_det.type eq 7}<a title="{$translate.some_other_time}" href="javascript:void(0);"  class="some_other_time"></a>
                                        {elseif $slot_det.type eq 8}<a title="{$translate.training_time}" href="javascript:void(0);"  class="training_time"></a>
                                        {elseif $slot_det.type eq 9}<a title="{$translate.call_training}" href="javascript:void(0);"  class="call_training"></a>
                                        {elseif $slot_det.type eq 10}<a title="{$translate.personal_meeting}" href="javascript:void(0);"  class="personal_meeting"></a>
                                        {elseif $slot_det.type eq 11}<a title="{$translate.voluntary}" href="javascript:void(0);"  class="voluntary"></a>
                                        {elseif $slot_det.type eq 12}<a title="{$translate.complementary}" href="javascript:void(0);"  class="complementary"></a>
                                        {elseif $slot_det.type eq 13}<a title="{$translate.complementary_oncall}" href="javascript:void(0);"  class="complementary_oncall"></a>{/if}
                                    </li>
                                </ul>  
                             {/if}
                        </div>
                    {/if}
                </div>
                {if $slot_det.status neq 2 and $slot_det.tl_flag ==1} 
                   {if $slot_det.signed_in == 0  && $slot_det.status != 4} <input type="checkbox" class="slot_assign_check get_slot_check" value="{$slot_det.id}" id="slot_{$i}" data-slot-no="{$i}" data-slot-time-range="{$slot_det.slot}"  style="margin-top: 5px;margin-left: 2px;float: right;" {if ($slot_det.privileges_gd.add_employee eq 1 or $slot_det.privileges_gd.copy_day_slot eq 1 or $slot_det.privileges_gd.delete_day_slot eq 1) and $slot_det.employee eq ''}onclick="employee_assign_slot('{$i}','{$slot_det.slot}','{$slot_det.id}')"{elseif $slot_det.customer eq ''}onclick="customer_assign_slot('{$i}','{$slot_det.slot}','{$slot_det.id}')"{/if} />{/if}
                    {assign i $i+1}
                {/if}
                {if $slot_det.signed_in != 0} <div class="notworking_time_slot" style="width: 239px; height: 67px;background: url('{$url_path}images/signed_slot_allot.png') no-repeat scroll 0 0 transparent"></div>{/if}
            </div>
        {/foreach}
    </div>
</div>