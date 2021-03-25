<div class="widget" style="margin-top:0;">
    <div class="widget-header span12">
        <h1>{$translate.relax_customer_to_assistant}</h1>
    </div>
    <div class="span12 widget-body-section input-group">
        <div class="span6">
            <div class="widget-body table-1">
                    <div class="table-head-min">
                        <h1>{$translate.all_customers}</h1>
                    </div>
                    <div class="div-height-fix">
                        <div id="nwoekers_list">
                            {foreach $to_assign as $employee}
                                <div id="a{$employee.username}" class="span12 child-slots-profile">
                                    <a href="javascript:void(0);" onclick="assignCustomer('{$employee.username}');" title="{$translate.assign_customer}"><i class="glyphicons icon-plus pull-right remove-child-slots cursor_hand"></i></a>
                                    <span>
                                        <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/{$employee_detail[0].username}/EMP_ADD/',1);">{if $sort_by_name == 1}{$employee.first_name|cat: ' '|cat: $employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name|cat: ' '|cat: $employee.first_name}{/if}</span>
                                        <span class="pull-right">{$employee.code}</span>
                                    </span>
                                </div>
                            {foreachelse}
                                <div id="no_data" class="span12 message" >{$translate.no_data_available}</div>
                            {/foreach}
                    </div>
                </div>
        </div>
    </div>
    <div class="span6">
        <div class="widget-body table-1">
            <div class="table-head-min">
                <h1>{$translate.attached_customers}</h1>
            </div>
            <div class="div-height-fix">
                <div id="tosave_workers">
                    {assign i 0}
                    {foreach $assigned as $customer}
                        {if $i == 0 && $customer.username == ""}
                            <div id="no_data" class="span12 message">{$translate.no_data_available}</div>
                            {break}
                        {/if}
                        <div id="a{$customer.username}" class="span12 child-slots-profile-two">
                            {if $user_role_login == 1 || $user_role_login == 6}
                                <a href="javascript:void(0);" onclick="removeCustomer('{$customer.username}');" style="float: right;" title="{$translate.remove_customer}"><span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"></span></a>
                            {/if}
                            <span>
                                <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/{$customer.username}/{$employee_detail[0].username}/EMP_ADD/',1);">{if $sort_by_name == 1}{$customer.first_name} {$customer.last_name}{elseif $sort_by_name == 2}{$customer.last_name} {$customer.first_name}{/if}</span>
                                <span class="pull-right">{$customer.code}</span>
                            </span>
                            <span class="slots-position pull-right">
                                {if $customer.role == 3}
                                    {if $user_roles == 2}
                                        {if $user_role_login == 1 || $user_role_login == 6}
                                            <a href="javascript:void(0);" class="maket2" onclick="makeTl('{$employee_detail[0].username}', '{$customer.username}');">{$translate.make_team_leader}</a>{/if}
                                        {else if $user_roles == 7}
                                            {if $user_role_login == 1 || $user_role_login == 6}
                                                <a href="javascript:void(0);" class="maket2" onclick="makeSTl('{$employee_detail[0].username}', '{$customer.username}');">{$translate.make_super_team_leader}</a>{/if}
                                            {else}
                                                <span class="tl">{$translate.employee}</span>
                                            {/if}
                                        {else if $customer.role == 7}<span class="tl">{$translate.super_tl}</span>
                                        {else if $customer.role == 2}<span class="tl">{$translate.tl}</span>
                                        {/if}
                                    </span> 
                                </div>
                                {foreachelse}
                                    <div id="no_data" class="span12 message" >{$translate.no_data_available}</div>
                                    {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>