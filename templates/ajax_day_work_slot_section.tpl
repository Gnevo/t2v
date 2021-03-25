<table cellspacing="0" cellpadding="0" id="Open_Text_General" class="FixedTables" style="width: 2080px;">
    <tbody>
        {foreach $day_datas as $day_data}
            <tr>
                {foreach $day_data as $employee_data}
                    <td width="110px" valign="top" style="height: 96px;">
                        <ul class="td_time_slot">
                            {foreach $employee_data.slots as $sloat_data}
                                <li {if $employee_data.leave || $sloat_data.status != 1}class="for_lv_day"{/if}><a href="javascript:void(0);" {if $employee_data.signed == 0 && ($privileges_gd.leave == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.swap == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1)}onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$employee_data.date}&slot={$sloat_data.id}')"{else}onclick="messagePrivilege()"{/if}>{$sloat_data.slot} ({$sloat_data.slot_hour})</a></li>
                            {/foreach}
                            {if $privileges.{$employee_data.employee.username}.link && $privileges.{$employee_data.customer.username}.link}
                                <li><a href="javascript:void(0);" {if $employee_data.signed == 0 && ($privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.remove_customer == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.add_slot == 1)}onclick="loadPopupProcess('{$url_path}gdschema_slot_process.php?date={$employee_data.date}&employee={$employee_data.employee.username}&customer={$employee_data.customer.username}')"{else}onclick="messagePrivilege()"{/if}>{$translate.process}</a></li>
                            {/if}
                        </ul>
                    </td>
                {/foreach}
            </tr>
        {/foreach}
    </tbody>
</table>