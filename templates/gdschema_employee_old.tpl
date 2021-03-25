{block name='script'}
<script type="text/javascript" src="{$url_path}js/jquery.table_search.js"></script>
<script type="text/javascript">
$(document).ready(function(){ldelim}
	
	var tempRaw = $('div.fixedContainer .fixedTable tr').map(function(){ldelim}
		return this;
    {rdelim});
	
	
	$('div.fixedTable').scroll(function(){ldelim}
		$('div.fixedHead').scrollLeft(($(this).scrollLeft()));
		$('div.fixedFoot').scrollLeft(($(this).scrollLeft()));
		$('div.fixedTable').scrollTop(($(this).scrollTop()));
    {rdelim});
	
	$('input#search_customer').quicksearch('div.fixedColumn .fixedTable table tr td', {ldelim}'rawTest' : true{rdelim});

    {rdelim});
</script>
{/block}

{block name="content"}
<div class="worker_wrapper clearfix">
    <div class="unassigned_customers">
        <div class="search_hd"><div class="unassign_hd">Companies to be assigned </div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $customers_to_allocate as $customer_to_allocate}
                    <tr>
                        <td width="162">{$customer_to_allocate.name}</td>
                        <td width="140">{$customer_to_allocate.allocate} ({$customer_to_allocate.allocated})</td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="unassigned_workers">
        <div class="search_hd"><div class="unassign_hd">Workers to be assigned </div></div>
        <div class="unassigned_names">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $employees_to_allocate as $employee_to_allocate}
                    <tr>
                        <td width="162">{$employee_to_allocate.name}</td>
                        <td width="140">{$employee_to_allocate.allocate} ({$employee_to_allocate.allocated})</td>
                    </tr>
                {foreachelse}
                    <tr><td></td></tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="company_req">
        <div class="search_hd"><div class="comp_hd">Workers On Leave </div><div class="requ_dat_hd">Date</div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $leave_employees as $leave_employee}
                    <tr>
                        <td width="162">{$leave_employee.name} - {$leave_employee.type}</td>
                        <td width="140">{$leave_employee.date|date_format:"%e %b,%Y"}</td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>

</div>

<div class="table_workers">
    <div class="tableDiv" id="tableDiv_General">
        <form id="search_table" name="form1" method="post" action="">
            <label for="search_customer">Customer</label>
            <input type="text" name="search_customer" id="search_customer" />
        </form>
        <div class="week_strip clearfix">
            <div class="arrow_left">
                <a href="{$url_path}employee/gdschema/{$year_week}/{$employee}/{$week_position + 1}/"></a>
            </div>
            <ul class="weeks">
                {foreach $week_numbers as $week_number}
                    {if $week_number.selected}
                        <li class="active"><a href="{$url_path}week/gdschema/{$week_number.id}/">{$week_number.value}</a></li>
                    {else}
                        <li><a href="{$url_path}employee/gdschema/{$week_number.id}/{$employee}/8/">{$week_number.value}</a></li>
                    {/if}

                {/foreach}
            </ul>
            <div class="arrow_right">
                <a href="{$url_path}employee/gdschema/{$year_week}/{$employee}/{$week_position - 1}/"></a>
            </div>
        </div>
        <div class="fixedArea">

            <div style="float: left; width: 140px; height: 360px;" class="fixedColumn">
                <div class="fixedHead">
                    <table cellspacing="0">
                        <tbody>
                            <tr><td id="" style="width: 130px;">{$employee_data.first_name} {$employee_data.last_name}</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="fixedTable" style="width: 140px; overflow: hidden; border-collapse: separate; padding: 0pt; height: 312px;">
                    <table cellspacing="0">
                        <tbody>
                            {foreach $customers as $customer}
                                <tr>
                                    <td style="height: 96px;">
                                        {if $privileges.{$customer.username}.link}
                                            <a href="#">{$customer.first_name} {$customer.last_name}</a>
                                        {else}
                                            {$customer.first_name} {$customer.last_name}
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="fixedContainer" style="width: 742px; float: left;">
                <div class="fixedHead" style="width: 743px; float: left; overflow: hidden;">
                    <table cellspacing="0" style="width: 1120px;">
                        <tbody>
                            <tr>
                                {foreach $week as $day}
                                    <td width="110px">{$translate.{$day.day}}</td>
                                {/foreach}
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="fixedTable" style="float: left; width: 743px; overflow: auto; height: 312px;">
                    <table cellspacing="0" cellpadding="0" id="Open_Text_General" class="FixedTables">
                        <tbody>
                            {foreach $employee_datas as $week_data}
                                <tr>
                                    {foreach $week_data as $day_data}
                                        <td width="110px" valign="top" style="height: 96px;">
                                            <ul class="td_days">
                                                {foreach $day_data.slots as $slot}
                                                    {if $day_data.leave}
                                                        <li class="for_lv_day">{$slot.slot}</li>
                                                    {else}
                                                        <li>{$slot.slot}</li>
                                                    {/if}
                                                {/foreach}
                                                <li class="add_time">add</li>
                                            </ul>
                                        </td>
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}