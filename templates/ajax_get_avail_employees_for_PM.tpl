<div id="PM_emp_check_div" style="height: 20px;">{if $available_employees|count gt 0}<a href="javascript:void(0);" class="btn_add_worker checkings_PM_empls" style="float: right;margin-right: 10px;" onclick="check_all_PM_emps()">{$translate.check_all}</a>{/if}</div>
<div id="tosave_workers" class="PM_employees_list clearfix" style="clear: both; margin-bottom: 5px;">
    <ul>
        {if $slot_det.employee neq '' and in_array($slot_det.employee, $avail_employee_ids)}<li  style="width: 204px;"><label><span class="member_checkbox"><input type="checkbox" name="sel_employees" value="{$slot_det.employee}" checked="checked" disabled="disabled" /></span>{$slot_employee_details.last_name|cat:' '|cat:$slot_employee_details.first_name}</label></li>{/if}
        {foreach $available_employees as $member}
            {if $member.username neq $slot_det.employee}<li  style="width: 204px;"><label><span class="member_checkbox"><input class="member_checkbox_input" type="checkbox" name="sel_employees" value="{$member.username}" /></span>{$member.name}</label></li>{/if}
        {/foreach}
    </ul>
</div>

{if $unavailable_employees|count gt 0}
<div class="sub_hd" style="margin: 12px 5px 5px; width: 91%;">{$translate.unavailable_employees}</div>
<div id="nwoekers_list" style="clear: both; margin-bottom: 5px;">
    <ul>
        {foreach $unavailable_employees as $member}
            <li  style="width: 204px;"><label>{$member.last_name|cat:' '|cat:$member.first_name}</label></li>
        {/foreach}
    </ul>
</div>
{/if}