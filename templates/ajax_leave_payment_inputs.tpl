{$translate.year}:
<select id="year" name="year" style="border:solid 1px #d9d9d9">
    <option value="">{$translate.select}</option>
    {html_options values=$years_combo selected=$report_year output=$years_combo}
</select>
    
{$translate.month}: 
<select name="month" id="month" onchange="loadCustomers()" style="border:solid 1px #d9d9d9"> 

    <option value="" >{$translate.select}</option>
    {if $month == ''}
        <option value="01" {if  $smarty.now|date_format:"%m" == 1} selected = "selected" {/if} >{$translate.jan}</option>
        <option value="02" {if  $smarty.now|date_format:"%m" == 2} selected = "selected" {/if}>{$translate.feb}</option>
        <option value="03" {if  $smarty.now|date_format:"%m" == 3} selected = "selected" {/if}>{$translate.mar}</option>
        <option value="04" {if  $smarty.now|date_format:"%m" == 4} selected = "selected" {/if}>{$translate.apr}</option>
        <option value="05" {if  $smarty.now|date_format:"%m" == 5} selected = "selected" {/if}>{$translate.may}</option>
        <option value="06" {if  $smarty.now|date_format:"%m" == 6} selected = "selected" {/if}>{$translate.jun}</option>
        <option value="07" {if  $smarty.now|date_format:"%m" == 7} selected = "selected" {/if}>{$translate.jul}</option>
        <option value="08" {if  $smarty.now|date_format:"%m" == 8} selected = "selected" {/if}>{$translate.aug}</option>
        <option value="09" {if  $smarty.now|date_format:"%m" == 9} selected = "selected" {/if}>{$translate.sep}</option>
        <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.oct}</option>
        <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.nov}</option>
        <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.dec}</option>
    {else}
        <option value="01" {if  $month == 1} selected = "selected" {/if} >{$translate.jan}</option>
        <option value="02" {if  $month == 2} selected = "selected" {/if}>{$translate.feb}</option>
        <option value="03" {if  $month == 3} selected = "selected" {/if}>{$translate.mar}</option>
        <option value="04" {if  $month == 4} selected = "selected" {/if}>{$translate.apr}</option>
        <option value="05" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>
        <option value="06" {if  $month == 6} selected = "selected" {/if}>{$translate.jun}</option>
        <option value="07" {if  $month == 7} selected = "selected" {/if}>{$translate.jul}</option>
        <option value="08" {if  $month == 8} selected = "selected" {/if}>{$translate.aug}</option>
        <option value="09" {if  $month == 9} selected = "selected" {/if}>{$translate.sep}</option>
        <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
        <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
        <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
    {/if}
</select>

{$translate.choose_user}
<select id="customer" name="customer" onchange="loadEmployees()" style="border:solid 1px #d9d9d9">

    <option value="">{$translate.select}</option>
    {foreach from=$customers item=customer}
        <option value="{$customer.customer_id}" {if $cust== $customer.customer_id}selected="selected" {/if} >{$customer.cust}</option>
    {/foreach}
</select>

{$translate.choose_assistant}
<select id="employee" name="employee" onchange="submitForm()" style="border:solid 1px #d9d9d9">

    <option value="">{$translate.select}</option>
    {foreach from=$employees item=employee}
        <option value="{$employee.employee_id}" {if $emp == $employee.employee_id}selected="selected" {/if} >{$employee.employee}</option>
    {/foreach}
</select>



<br><br>
{if $sicks}
    Tidigare Sjukblanketter:
    <select name="old_pdf" id="old_pdf" onchange="show_sicks()" style="border:solid 1px #d9d9d9">
        <option value=""  selected >{$translate.select}</option>
        {foreach from=$sicks item=entries}
            <option value={$entries.file}>{$entries.date}</option>
        {/foreach}
    </select>
    <br /><br />
{/if}

<br />
{if $relations}
    <b>Sjukperiod: {$relations[0]['date']} till {$relations[($relations|@count)-1]['date']}</b><br /><br />
    <table width="700" border="1px solid" cellspacing="0" cellpadding="5" style="font-size:10px; border-color: #e4e4e4; text-align: center;" >
        <tr>
            <td width="265"><strong>Namn p&aring; vikarie</strong></td>
            <td width="113"><strong>Datum</strong></td>
            <td width="98"><strong>Klockslag</strong></td>
            <td width="39"><strong>L&ouml;ntyp</strong></td>
            <td width="49"><strong>Ant tim</strong></td>
            {*<td width="25"><strong>Timl&ouml;n</strong></td>*}
            <td width="25"><strong>Soc.</strong></td>
        </tr>
        {assign i 0}
        {assign vikarie_total_leave_hours 0}
        {foreach from=$relations item=relation}
            <tr>
                <td>{$relation.employee}</td>
                <td>{$relation.date}</td>
                <td>{$relation.time_from} - {$relation.time_to}</td>
                <td>{$relation.inconv}</td>
                <td>{$relation.tot_time}</td>
                {*assign style_input ''}
                {if $relation.repeat eq '1'} {assign style_input 'border:solid 1px #d9d9d9; display: none;'}{else}{assign style_input 'border:solid 1px #d9d9d9;'} {/if*}
                {*<td style="padding-left: 8px"><input type="text" name="time_{$i}" id="time_{$i}" size="6" style="{$style_input}"/></td>*}
                <td style="padding-left: 8px"><input type="text" name="soc_{$i}" id="soc_{$i}" size="6" style="border:solid 1px #d9d9d9;" value="{if $relation.age < 25}{$below_25}{else if $relation.age < 65}{$btwn_25_65}{else if $relation.age >= 65}{$above_65}{/if}"/></td>
            </tr>
            {assign i $i+1}
            {assign vikarie_total_leave_hours $vikarie_total_leave_hours+$relation.tot_time}
        {/foreach}
        <input type="hidden" name="tot_rows" id="tot_rows" value="{$i}" />
    </table>
    <p>Summering hela m&aring;naden: {$vikarie_total_leave_hours} tim</p>
{/if}