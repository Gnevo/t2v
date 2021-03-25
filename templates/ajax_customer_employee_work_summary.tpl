
        <!--TABLE 1--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th>{$translate.companies_to_be_assigned}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                {foreach $customers_to_allocate as $customer_to_allocate}
                                <tr>
                                    <td><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);" title="{$customer_to_allocate.code}">{if $sort_by_name == 1}{$customer_to_allocate.customer_name_ff}{elseif $sort_by_name == 2}{$customer_to_allocate.customer_name}{/if}</a></td>
                                    <td style="width:127px"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);"><span>{$customer_to_allocate.total_hours}h</span></a></td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 1 END-->
        <!--TABLE 2--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th>{$translate.workers_to_be_assigned}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                {foreach $employees_to_allocate as $employee_to_allocate}
                                <tr>
                                    <td><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);" title="{$employee_to_allocate.code}">{$employee_to_allocate.name}</a></td>
                                    <td style="width:127px"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);"><span>{$employee_to_allocate.allocated}h {if $employee_to_allocate.monthly_hour} / {$employee_to_allocate.monthly_hour}h{/if}</span></a></td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 2 END-->
        <!--TABLE 3--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th>{$translate.workers_on_leave}</th>
                                <th style="width:117px">{$translate.date}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                {foreach $leave_employees as $leave_employee}
                                <tr>
                                    <td><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);" title="{$leave_employee.code}">{$leave_employee.name} - {$leave_employee.type}</a></td>
                                    <td style="width:127px"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);"><span>{$leave_employee.date}</span></a></td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 3 END-->
   