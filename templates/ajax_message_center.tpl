
    <table class="table_list">
        <tr>
            <th>{$translate.leave_type}</th>
            <th>{$translate.applied_date}</th>
            <th>{$translate.employee_name}</th>
            <th>{$translate.approved_name}</th>
            <th>{$translate.approved_date}</th>
            <th>{$translate.status}</th>
           
        </tr>
        {foreach from=$leave_list item=employee}
            <tr class="{cycle values="even,odd"}">
                <td>{if $employee.type == '1'}Sjuk{elseif $employee.type == '2' }Sem {elseif $employee.type == '3' }VAB {elseif $employee.type == '4' }FP{elseif $employee.type == '5' }P-möte{elseif $employee.type == '6' }Utbild{elseif $employee.type == '7' }Övrigt{elseif $employee.type == '8' }Byte{/if} </td>
                <td>{$employee.apply_date}</td>
                <td>{$emp_name}</td>
                <td>{$employee.appr_emp}</td>
                <td>{$employee.appr_date} </td>
                <td>{if $employee.status =='0'} {$translate.pending} {elseif $employee.status =='1'} {$translate.approved}{elseif $employee.status =='2'} {$translate.rejected}{/if}</td>
                
               </tr>
       {foreachelse}<div class="message">{$translate.no_data_available}</div> {/foreach}
    </table>


