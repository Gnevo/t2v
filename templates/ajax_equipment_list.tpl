<table style="margin-left: 5px" width="843" cellpadding="0" cellspacing="0" >
    <tr class="td_hd">
        <td width="253" height="26">{$translate.equipment}</td><td width="284">{$translate.serial_number}</td><td width="152">{$translate.issue_date}</td><td width="152">{$translate.return_date}</td>{if $equipments}<td></td>{/if}
        <!--  <td width="20">&nbsp;</td>  -->
    </tr>
    {foreach from=$equipments item=equipment}
        <tr class="td_conte">
            <td width="253" height="20"><a href="#">{$equipment.equipment}</a></td>
            <td width="284">{$equipment.serial_number}</td>
            <td width="152">{$equipment.issue_date}</td>
            <td width="152">{$equipment.return_date}</td>
            <td><a href="javascript:void(0)" onclick="popup_edit('{$url_path}customer_equipment_issue_popup.php?id={$equipment.id}&cust={$customer_detail.username}&name={$equipment.equipment}&serial={$equipment.serial_number}&issue={$equipment.issue_date}&return={$equipment.return_date}')"><img style="margin-right: 15px" src="{$url_path}images/edit.png" border="0" alt="" width="25" title="{$translate.edit}"/></a></td>
            <!--    <td style="padding:0;" width="20" align="center"><a style="text-decoration:none; font-weight:bold;" href="customer_admin_equipment.php?personnr=<?php echo $person_num;?>&del_id=<?php echo $row['id'];?>">X</a></td>   -->
        </tr>
    {foreachelse}	
        <tr><td height="25" style="color:#F00;" colspan="5">{$translate.no_data}</td></tr>
    {/foreach}
</table>