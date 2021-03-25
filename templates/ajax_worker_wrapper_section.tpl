<div id="pop_up_themes">
    <div id="timetable_slot_assign" style="display:none;"></div>
    <div id="timetable_process" style="display:none;"></div>
    <div id="timetable_process_main" style="display:none;"></div>
    <div id="timetable_process_copy" style="display:none;"></div>
    <div id="timetable_assign" style="display:none;"></div>
    <div id="alloc_action" style="display:none;"></div>
    <div id="allocate_cusempwork" style="display: none;"></div>
    <div id="right_click_change_type" style="display: none; max-height: 300px;"></div>
</div>

{$message}
<div class="unassigned_customers">
        <div class="search_hd"><div class="unassign_hd">{$translate.companies_to_be_assigned} </div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $customers_to_allocate as $customer_to_allocate}
                    <tr>
                        <td width="340"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);" title="{$customer_to_allocate.code}">{if $sort_by_name == 1}{$customer_to_allocate.customer_name_ff}{elseif $sort_by_name == 2}{$customer_to_allocate.customer_name}{/if}</a></td>
                        <td width="200" style="text-align: right; padding-right: 20px;"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);">{$customer_to_allocate.total_hours}h</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="unassigned_workers">
        <div class="search_hd"><div class="unassign_hd">{$translate.workers_to_be_assigned} </div></div>
        <div class="unassigned_names">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $employees_to_allocate as $employee_to_allocate}
                    <tr>
                        <td width="172"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);" title="{$employee_to_allocate.code}">{$employee_to_allocate.name}</a></td>
                        <td width="130"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);">{$employee_to_allocate.allocated}h {if $employee_to_allocate.monthly_hour} / {$employee_to_allocate.monthly_hour}h{/if}</a></td>
                        <!--<td width="130"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);">{$employee_to_allocate.allocated}h {if $employee_to_allocate.allocate}({$employee_to_allocate.allocate}h){/if}</a></td>-->
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="company_req">
        <div class="search_hd"><div class="comp_hd">{$translate.workers_on_leave} </div><div class="requ_dat_hd">{$translate.date}</div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $leave_employees as $leave_employee}
                    <tr>
                        <td width="162"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);" title="{$leave_employee.code}">{$leave_employee.name} - {$leave_employee.type}</a></td>
                        <td width="127"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);">{$leave_employee.date}</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>