{block name="script"}
<script type="text/javascript">
   
function print_form(){ldelim}

{rdelim} 
</script>
{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.employee_log_report}</span>
        <!--a onclick="print_form()" href="javascript:void(0)"><img width="77" height="25" src="{$url_path}images/btn_print.gif"></a-->
    </div> 
    
    
    <div id="tble_list"> 

        <div class="pagention">
        <div class="pagention_dv"><div class="pagination"><ul id="pagination">{$pagination}</ul></div></div>

            {if $report_month == ""}  
                    {$report_month = $smarty.now|date_format:"%m"}
            {/if}
            {if $report_year == ""}  
                    {$report_year = $smarty.now|date_format:"%Y"}
            {/if}

        <div class="alphbts">
            <form id="cust_report" action="{$url_path}login/log/report/" method="post">
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
                <option value="all" {if $employee_name == 'all'} selected {/if}>{$translate.all}</option>
            {foreach from=$E_combo item=entries}
                <option value={$entries.uname} {if $employee_name == $entries.uname} selected {/if} >{$entries.fullname}</option>
            {/foreach}
            </select>

            <!--a href="customer_monthly_report.php" value="go"/-->
            <input type="submit" value="Submit" name="submit" />
            </form>
        </div>

    </div>
            <h1></h1>
  <table class="table_list">
        <tr>
            <th>{$translate.Login_date}</th>            
            {if $employee_name eq "all" }<th>{$translate.employee}</th>{/if}
            <th>{$translate.ip}</th>
            <th>{$translate.browser}</th>
            <th>{$translate.Login_time}</th>
            <th>{$translate.Logoff_time}</th>
            <th>{$translate.Log_tot_time}</th>
        </tr>
        <!-- table body  -->
        {foreach from=$employee_log_entries item=entries} 
            <tr class="{cycle values="even,odd"}">
                <td>{$entries.lin_date}</td>
                {if $employee_name eq "all" }<td>{$entries.empname}</td>{/if}
                <td>{$entries.ip}</td>
                <td>{$entries.browser}</td>
                <td>{$entries.lin_time}</td>
                <td>{$entries.lof_time}</td>
                <td>{$entries.total_time}</td>
            </tr>
        {foreachelse}
                <tr ><td colspan=7><div class="message">{$translate.no_data_available}</div></td></tr>  
        {/foreach}
        <!-- end of table body  -->
    </table>
    </div>
{/block}
