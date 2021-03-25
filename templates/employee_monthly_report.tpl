{block name="script"}
<script type="text/javascript">
   

function print_form(){ldelim}
//window.print();
var empid=document.getElementById("cmb_employee").value;
var m=document.getElementById("cmb_month").value;
var y=document.getElementById("cmb_year").value;
cll = document.getElementById('cmb_employee');
cl2 = document.getElementById('cmb_month');
cl3 = document.getElementById('cmb_year');
var empname=cll.options[cll.selectedIndex].text;
var month=cl2.options[cl2.selectedIndex].text;
var year=cl3.options[cl3.selectedIndex].text;
//alert(custname);
if (empid != "")
    window.open('{$url_path}report/monthly/employee/print&' + empid + '&' + m + '&' + y + '&' + empname + '&' + month + '/');
else
    return false;
{rdelim} 
</script>
{/block}
{block name="content"}

<div class="tbl_hd"><span class="titles_tab">{$translate.employee_monthly_report}</span>
    <!--a onclick="print_form()" href="javascript:void(0)"><img width="77" height="25" src="{$url_path}images/btn_print.gif"></a-->
    <a href="javascript:void(0)" class="print"><span class="btn_name">{$translate.print}</span></a>
        <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    
</div>

    
<div id="tble_list"> 

    <div class="pagention">

        {if $report_month == ""}  
                {$report_month = $smarty.now|date_format:"%m"}
        {/if}
        {if $report_year == ""}  
                {$report_year = $smarty.now|date_format:"%Y"}
        {/if}

        <div class="alphbts">
            <form id="cust_report" action="{$url_path}report/monthly/employee/" method="post">
                {$translate.month}:
                <select name=cmb_month id=cmb_month>
                    {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                </select>

                {$translate.year}:
                <select name=cmb_year id=cmb_year>
                    {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                </select>

                {$translate.employee}:
                <select name='cmb_employee' id="cmb_employee" >
                    <option value="" >{$translate.select_employee}</option>
                    {foreach from=$E_combo item=entries}
                        <option value={$entries.username} {if $employee_name == $entries.username} selected {/if} >{$entries.first_name} {$entries.last_name}</option>
                    {/foreach}
                </select>                     
                <input type="submit" value="Submit" />
            </form>
        </div>

    </div>
    <h1></h1>

    <table class="table_list">
            <tr>
                <th>{$translate.date}</th>
                <th>{$translate.time_slot}</th>
                <th>{$translate.customer}</th>
                <th>{$translate.normal}</th>
                <th>{$translate.oncall}</th>
            </tr>

            {$flag=true}
            {assign Normal_total 0}
            {assign oncall_total 0}

            {foreach from=$employee_report_entries item=entries}  
                <tr class="{cycle values="even,odd"}">
                    <td>{$entries.date}</td>
                    <td>{$entries.time_from} - {$entries.time_to}</td>
                    <td>{$entries.customer_name}</td>
                    <td>
                        {if $entries.type eq 0 OR $entries.type eq 1 OR $entries.type eq 2}
                            {$entries.time_to-$entries.time_from}
                            {assign Normal_total $Normal_total+($entries.time_to-$entries.time_from)}
                        {/if}
                    </td>
                    <td>
                        {if $entries.type eq 3 }
                            {$entries.time_to-$entries.time_from}
                            {assign oncall_total $oncall_total+($entries.time_to-$entries.time_from)}
                        {/if}
                    </td>
                </tr>
            {foreachelse}
                    <tr ><td colspan=7><div class="message">{$translate.no_data_available}</div></td></tr>  
                    {$flag=false}
            {/foreach}
            {if $flag }
            <tr>
                <th colspan=3>{$translate.total}</th>
                <th>{$Normal_total}</th>
                <th>{$oncall_total}</th>
            </tr>
            {/if}
    </table>


</div>

{/block}
