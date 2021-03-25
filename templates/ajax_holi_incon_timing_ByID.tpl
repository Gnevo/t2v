<table class="table_list_inconv_holi" >
    <tr>
        <th>{$translate.date}</th>
        <th>{$translate.time_from}</th>
        <th>{$translate.time_to}</th>
        <th>{$translate.red_big_day}</th>
    </tr>
    {assign var="counter" value=0}
    {foreach from=$rb_days item=entries}
    <tr class="{cycle values="even,odd"}">
        <td>{$date[$counter][0]}/&nbsp;{$date[$counter][1]}</td>
        <td>{if $entries.day eq 1}{$times[0][0]}{else}0.00{/if}</td>
        <td>{if $entries.day eq count($rb_days)}{$times[0][1]}{else}24.00{/if}</td>
        <td>{if $entries.type eq 1}{$translate.red_day}{else}{$translate.big_day}{/if}</td>
        {$counter=$counter+1}
    </tr>
    {/foreach}
</table>