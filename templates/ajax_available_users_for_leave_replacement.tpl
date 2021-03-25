{if $leave_format eq 2}
    {*if $avail_replace_employees|count gt 0*}
        <table>
            <tr>
                <td>{$translate.replacement_employee} </td>
                <td>
                    <select name="rep_employees" class="replace_employees_list">
                        <option value="">{$translate.none}</option>
                        {foreach $avail_replace_employees as $member}
                            <option value="{$member.username}">{$member.name}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
        </table>
    {*/if*}
{else if $leave_format eq 1}
    {*if $avail_replace_employees_date|count gt 0*}
        <table style="margin-top: 10px;">
            <tr  height="25">
                <td>{$translate.replacement_employee} </td>
                <td> 
                    <select name="rep_date_employees" class="replace_employees_list_date">
                        <option value="">{$translate.none}</option>
                        {foreach $avail_replace_employees_date as $member}
                            <option value="{$member.username}">{$member.name}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
        </table>
    {*/if*}
{/if}