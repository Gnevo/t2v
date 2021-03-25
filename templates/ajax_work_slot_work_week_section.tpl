<script type="text/javascript" src="{$url_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.mousewheel_1.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    jQuery.noConflict();
});
$(".chk_slots").click(function(e){
    e.stopPropagation();
});
</script>

{if $user_type eq 'employee'}
    {foreach $employee_week as $employee_day} 
        <div class="customer_week">
            <a href="javascript:void(0);" {if $employee_day.signed == 0 && ($privileges_gd.delete_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.add_slot == 1)} title="{$translate.enter_into_day_slots}" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$employee_day.date}&employee={$employee_data.username}',1)"{else} style="cursor: default;" onclick="messagePrivilege()"{/if} data-date="{$employee_day.date}" class="customer_week_days">{$translate.{$employee_day.day.day}}<br/>{$employee_day.date}</a>
            {foreach $employee_day.slots as $day_slot}
                <a href="javascript:void(0);" {if $day_slot.status != 2 &&  $day_slot.signed == 0 && ($privileges.{$day_slot.customer}.link == 1 || {$day_slot.customer} == '')&& $privileges.{$day_slot.employee}.link == 1 && ($privileges_gd.leave == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.swap == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1)} title="{$translate.slot_view}" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$employee_day.date}&slot={$day_slot.id}')" {if $day_slot.type == 10 &&  $day_slot.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if}{else}style="cursor: default; {if $day_slot.type == 10 &&  $day_slot.status == 1} background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3{/if}" onclick="messagePrivilege()"{/if} 
                   class="{if $day_slot.status == 2}time_slot_leave{elseif $day_slot.status == 0}time_slot_incomplete{elseif $day_slot.status eq 1 and $day_slot.created_status eq 1}time_slot_candg_accept{elseif $day_slot.status == 4}time_slot_candg{else}time_slot_btn{/if}">
                   <div class="block_left_color">
                        <span class="fkkn_type">
                            {if $day_slot.fkkn eq 1}<img src="{$url_path}images/icon_fk.gif"/>
                            {else if $day_slot.fkkn eq 2}<img src="{$url_path}images/icon_kn.gif"/>
                            {else if $day_slot.fkkn eq 3}<img src="{$url_path}images/tu.gif"/>{/if}
                        </span>
                        <span class="color_code" style="background-color: {$day_slot.emp_color};">{if  $day_slot.signed != 0} <img src="{$url_path}images/cross_line.png"/>{/if}</span>
                    </div>
                    <div class="single_sloat_detail">
                        <span class="customer_week_time">{$day_slot.slot}({$day_slot.slot_hour})</span>
                        {if $day_slot.type eq 0}<span class="work"></span>
                        {else if $day_slot.type eq 1}<span class="travel"></span>
                        {else if $day_slot.type eq 2}<span class="lunch"></span>
                        {else if $day_slot.type eq 3}<span class="oncall"></span>
                        {else if $day_slot.type eq 4}<span class="overtime"></span>    
                        {else if $day_slot.type eq 5}<span class="qualityovertime"></span>
                        {else if $day_slot.type eq 6}<span class="moreovertime"></span>
                        {else if $day_slot.type eq 7}<span class="someothertime"></span>
                        {else if $day_slot.type eq 8}<span class="trainingtime"></span>
                        {else if $day_slot.type eq 9}<span class="calltraining"></span>
                        {else if $day_slot.type eq 10}<span class="personalmeeting"></span>
                        {else if $day_slot.type eq 11}<span class="voluntary"></span>
                        {else if $day_slot.type eq 12}<span class="complementary"></span>
                        {else if $day_slot.type eq 13}<span class="complementary_oncall"></span>
                        {else if $day_slot.type eq 14}<span class="more_oncall"></span>
                        {else if $day_slot.type eq 15}<span class="oncall_standby"></span>{/if}
                        
                        <span class="customer_used_item" {if $day_slot.status eq 2}style="margin-bottom: 4px;"{/if}>
                            {if $privileges.{$day_slot.customer}.link == 1}<span>{$day_slot.cust_name|truncate:10:'...'}</span>{/if}
                        </span>
                        {if $day_slot.status neq 2 and ($privileges_gd.process eq 1 or $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1 or $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1)}
                            <span class="chk_slot_hold clearfix" style="bottom: 2px;width: 92px;margin-top:2px;">
                                {if htmlspecialchars($day_slot.comment) != '' || htmlspecialchars($day_slot.comment) != null}<img src="{$url_path}images/icon_comment.png" title="{htmlspecialchars($day_slot.comment)}" style="cursor: default;">{/if}
                               <input type="checkbox" name="chk_wk_slots" class="chk_slots" value="{$day_slot.id}" style="float: right">
                            </span>
                        {/if}
                        {if $day_slot.status == 2}
                            <div id="leave_slot_description" class="leave_sick" style="margin: 0 0 0 0;padding: 0 1px; ">{$day_slot.leave_data.leave_name}</div>
                        {/if}
                    </div>
                    <!--{if  $day_slot.signed != 0} <div class="notworking_time_slot"></div>{/if}-->
                </a>
            {/foreach}
            {if ($privileges_gd.copy_day_slot == 1 || $privileges_gd.delete_day_slot == 1 || $privileges_gd.copy_day_slot_option == 1 || $privileges_gd.add_slot == 1)}    
                <a href="javascript:void(0);" onclick="loadPopupProcess('{$url_path}gdschema_slot_process.php?date={$employee_day.date}&employee={$employee_data.username}')" class="time_slot_btn_add" title="{$translate.show_actions}">{$translate.process}</a>
            {else}
                <a href="javascript:void(0);" onclick="messagePrivilege()" class="time_slot_btn_add">{$translate.process}</a>
            {/if}
        </div>
    {/foreach}
        
        
{elseif $user_type eq 'customer'}
    
    {foreach $customer_week as $customer_day}

            <div class="customer_week" >
                <a href="javascript:void(0);" {if $customer_day.signed == 0 && ($privileges_gd.delete_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.add_slot == 1)}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$customer_day.date}&customer={$customer_data.username}',1)" title="{$translate.enter_into_day_slots}"{else}style="cursor: default;" onclick="messagePrivilege()"{/if} data-date="{$customer_day.date}" class="customer_week_days">{$translate.{$customer_day.day.day}}<br/>{$customer_day.date}</a>
                {foreach $customer_day.slots as $day_slot}
                    <a href="javascript:void(0);" {if ($privileges.{$day_slot.customer}.link == 1 || $day_slot.employee == '') &&  $day_slot.signed == 0 && ( $privileges.{$day_slot.employee}.link == 1 || {$day_slot.employee} == '') && $day_slot.status != 2 && ($privileges_gd.leave == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.swap == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1)} title="{$translate.slot_view}" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$customer_day.date}&slot={$day_slot.id}')"{if $day_slot.type == 10 &&  $day_slot.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if}{else}style="cursor: default;{if $day_slot.type == 10 &&  $day_slot.status == 1}background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3{/if}" onclick="messagePrivilege()"{/if} 
                       class="{if $day_slot.status == 2}time_slot_leave{elseif $day_slot.status == 0 || $day_slot.status == 3}time_slot_incomplete{elseif $day_slot.status eq 1 and $day_slot.created_status eq 1}time_slot_candg_accept{elseif $day_slot.status == 4}time_slot_candg{else}time_slot_btn{/if} ">
                       <div class="block_left_color">
                            <span class="fkkn_type">
                                {if $day_slot.fkkn eq 1}<img src="{$url_path}images/icon_fk.gif"/>
                                {else if $day_slot.fkkn eq 2}<img src="{$url_path}images/icon_kn.gif"/>
                                {else if $day_slot.fkkn eq 3}<img src="{$url_path}images/tu.gif"/>{/if}
                            </span>
                            <span class="color_code" style="background-color: {$day_slot.emp_color};">{if  $day_slot.signed != 0}<img src="{$url_path}images/cross_line.png"/>{/if}</span>
                        </div>
                        <div class="single_sloat_detail">
                            <span class="customer_week_time">{$day_slot.slot}({$day_slot.slot_hour})</span>
                            {if $day_slot.type eq 0}<span class="work"></span>
                            {else if $day_slot.type eq 1}<span class="travel"></span>
                            {else if $day_slot.type eq 2}<span class="lunch"></span>
                            {else if $day_slot.type eq 3}<span class="oncall"></span>
                            {else if $day_slot.type eq 4}<span class="overtime"></span>    
                            {else if $day_slot.type eq 5}<span class="qualityovertime"></span>
                            {else if $day_slot.type eq 6}<span class="moreovertime"></span>
                            {else if $day_slot.type eq 7}<span class="someothertime"></span>
                            {else if $day_slot.type eq 8}<span class="trainingtime"></span>
                            {else if $day_slot.type eq 9}<span class="calltraining"></span>
                            {else if $day_slot.type eq 10}<span class="personalmeeting"></span>
                            {else if $day_slot.type eq 11}<span class="voluntary"></span>
                            {else if $day_slot.type eq 12}<span class="complementary"></span>
                            {else if $day_slot.type eq 13}<span class="complementary_oncall"></span>
                            {else if $day_slot.type eq 14}<span class="more_oncall"></span>
                            {else if $day_slot.type eq 15}<span class="oncall_standby"></span>{/if}
                            <span class="customer_used_item" {if $day_slot.status eq 2}style="margin-bottom: 4px;"{/if}>
                                <span>{$day_slot.emp_name|truncate:10:'...'}</span>
                            </span>
                            {if $day_slot.status neq 2 and ($privileges_gd.process eq 1 or $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1 or $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1)}
                                <span class="chk_slot_hold clearfix" style="bottom: 2px;width: 92px;margin-top:2px;">
                                   {if htmlspecialchars($day_slot.comment) != '' || htmlspecialchars($day_slot.comment) != null} <img src="{$url_path}images/icon_comment.png" title="{htmlspecialchars($day_slot.comment)}" style="cursor: default;float: left">{/if}
                                    <input type="checkbox" name="chk_wk_slots" class="chk_slots" value="{$day_slot.id}" style="float: right">
                                </span>
                            {/if}
                            {if $day_slot.status == 2}
                                <div id="leave_slot_description" class="leave_sick" style="margin: 0 0 0 0;padding: 0 1px;">{$day_slot.leave_data.leave_name}</div>
                            {/if}   
                        </div>
                            <!--{if  $day_slot.signed != 0} <div class="notworking_time_slot"></div>{/if}-->
                    </a>
                {/foreach}
                {if $privileges_gd.copy_day_slot == 1 || $privileges_gd.delete_day_slot == 1 || $privileges_gd.copy_day_slot_option == 1 || $privileges_gd.add_slot == 1}
                    <a href="javascript:void(0);" onclick="loadPopupProcess('{$url_path}gdschema_slot_process.php?date={$customer_day.date}&customer={$customer_data.username}')" class="time_slot_btn_add" title="{$translate.show_actions}">{$translate.process}</a>
                {else}
                    <a href="javascript:void(0);" onclick="messagePrivilege()" class="time_slot_btn_add">{$translate.process}</a>
                {/if}
            </div>
        {/foreach}
 {elseif $user_type eq 'employee_customer'}
    {foreach $employee_week as $employee_day}
        <div class="customer_week">
            <a href="javascript:void(0);" {if $employee_day.signed == 0 && ($privileges_gd.delete_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.add_slot == 1)} title="{$translate.enter_into_day_slots}" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$employee_day.date}&employee={$employee_data.username}&customer={$customer}',1)"{else} style="cursor: default;" onclick="messagePrivilege()"{/if} data-date="{$employee_day.date}" class="customer_week_days">{$translate.{$employee_day.day.day}}<br/>{$employee_day.date}</a>
            {foreach $employee_day.slots as $day_slot}
                <a href="javascript:void(0);" {if $day_slot.status != 2 &&  $day_slot.signed == 0 && ($privileges.{$day_slot.customer}.link == 1 || {$day_slot.customer} == '')&& $privileges.{$day_slot.employee}.link == 1 && ($privileges_gd.leave == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.swap == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1)} title="{$translate.slot_view}" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$employee_day.date}&slot={$day_slot.id}')" {if $day_slot.type == 10 &&  $day_slot.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if}{else}style="cursor: default;{if $day_slot.type == 10 &&  $day_slot.status == 1}background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3{/if}" onclick="messagePrivilege()"{/if} 
                   class="{if $day_slot.status == 2}time_slot_leave{elseif $day_slot.status == 0}time_slot_incomplete{elseif $day_slot.status eq 1 and $day_slot.created_status eq 1}time_slot_candg_accept{elseif $day_slot.status == 4}time_slot_candg{else}time_slot_btn{/if}">
                   <div class="block_left_color">
                        <span class="fkkn_type">
                            {if $day_slot.fkkn eq 1}<img src="{$url_path}images/icon_fk.gif"/>
                            {else if $day_slot.fkkn eq 2}<img src="{$url_path}images/icon_kn.gif"/>
                            {else if $day_slot.fkkn eq 3}<img src="{$url_path}images/tu.gif"/>  
                            {/if}
                        </span>
                        <span class="color_code" style="background-color: {$day_slot.emp_color};">{if  $day_slot.signed != 0}<img src="{$url_path}images/cross_line.png"/>{/if}</span>
                    </div>
                    <div class="single_sloat_detail">
                        <span class="customer_week_time">{$day_slot.slot}({$day_slot.slot_hour})</span>
                        {if $day_slot.type eq 0}<span class="work"></span>
                        {else if $day_slot.type eq 1}<span class="travel"></span>
                        {else if $day_slot.type eq 2}<span class="lunch"></span>
                        {else if $day_slot.type eq 3}<span class="oncall"></span>
                        {else if $day_slot.type eq 4}<span class="overtime"></span>    
                        {else if $day_slot.type eq 5}<span class="qualityovertime"></span>
                        {else if $day_slot.type eq 6}<span class="moreovertime"></span>
                        {else if $day_slot.type eq 7}<span class="someothertime"></span>
                        {else if $day_slot.type eq 8}<span class="trainingtime"></span>
                        {else if $day_slot.type eq 9}<span class="calltraining"></span>
                        {else if $day_slot.type eq 10}<span class="personalmeeting"></span>
                        {else if $day_slot.type eq 11}<span class="voluntary"></span>
                        {else if $day_slot.type eq 12}<span class="complementary"></span>
                        {else if $day_slot.type eq 13}<span class="complementary_oncall"></span>
                        {else if $day_slot.type eq 14}<span class="more_oncall"></span>
                        {else if $day_slot.type eq 15}<span class="oncall_standby"></span>{/if}
                        <span class="customer_used_item" {if $day_slot.status eq 2}style="margin-bottom: 4px;"{/if}>
                            {if $privileges.{$day_slot.customer}.link == 1}<span>{$day_slot.cust_name|truncate:10:'...'}</span>{/if}
                        </span>
                        {if $day_slot.status neq 2 and ($privileges_gd.process eq 1 or $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1 or $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1)}
                            <span class="chk_slot_hold clearfix" style="bottom: 2px;width: 92px;margin-top:2px;">
                               <input type="checkbox" name="chk_wk_slots" class="chk_slots" value="{$day_slot.id}">
                            </span>
                        {/if}
                        {if $day_slot.status == 2}
                            <div id="leave_slot_description" class="leave_sick" style="margin: 0 0 0 0;padding: 0 1px; ">{$day_slot.leave_data.leave_name}</div>
                        {/if}
                    </div>
                </a>
            {/foreach}
            {if ($privileges_gd.copy_day_slot == 1 || $privileges_gd.delete_day_slot == 1 || $privileges_gd.copy_day_slot_option == 1 || $privileges_gd.add_slot == 1)}    
                <a href="javascript:void(0);" onclick="loadPopupProcess('{$url_path}gdschema_slot_process.php?date={$employee_day.date}&employee={$employee_data.username}&customer={$customer}')" class="time_slot_btn_add" title="{$translate.show_actions}">{$translate.process}</a>
                {else}
                <a href="javascript:void(0);" onclick="messagePrivilege()" class="time_slot_btn_add">{$translate.process}</a>
            {/if}
        </div>
    {/foreach}
{/if}