{block name="script"}
<script type="text/javascript">
function select_customer(name){ldelim}
   window.location.href = '{$url_path}list/customer/'+name+'/';
{rdelim}
    
function print_form(){ldelim}
//window.print();
var custid=document.getElementById("cmb_customer").value;
var m=document.getElementById("cmb_month").value;
var y=document.getElementById("cmb_year").value;
cll = document.getElementById('cmb_customer');
cl2 = document.getElementById('cmb_month');
cl3 = document.getElementById('cmb_year');
var custname=cll.options[cll.selectedIndex].text;
var month=cl2.options[cl2.selectedIndex].text;
var year=cl3.options[cl3.selectedIndex].text;
//alert(custname);
window.open('{$url_path}report/monthly/customer/print&' + custid + '&' + m + '&' + y + '&' + custname + '&' + month + '&' + year + '/');
{rdelim} 
</script>
{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.customer_monthly_report}</span>
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
            <form id="cust_report" action="{$url_path}report/monthly/customer/" method="post">
            {$translate.month}:
            <select name=cmb_month id=cmb_month>
            {html_options values=$month_option_values selected=$report_month output=$month_option_output}
            </select>
            
            {$translate.year}:
            <select name=cmb_year id=cmb_year>
            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
            </select>
            
            {$translate.customer}:
            <select name='cmb_customer' id="cmb_customer" >
                <option value="" >{$translate.select_customer}</option>
            {foreach from=$C_combo item=entries}
                <option value={$entries.uname} {if $customer_name == $entries.uname} selected {/if} >{$entries.fullname}</option>
            {/foreach}
            </select>

            <input type="submit" value="Generate" />
            </form>
        </div>

    </div>
            <h1></h1>
  <table class="table_list">
        <tr>
            <th>{$translate.date}</th>
            <th>{$translate.employee}</th>
            <th>{$translate.normal}</th>
            <th>{$translate.travel}</th>
            <th>{$translate.break}</th>
            <th>{$translate.oncall}</th>
            <th>{$translate.total_hour}</th>
        </tr>

        {$flag=true}
        {$Normal_total=0}
        {$Travel_total=0}
        {$break_total=0}
        {$onCall_total=0}

        {foreach from=$customer_report_entries item=entries}
                {if $entries.t0 eq ""}  
                    {$entries.t0=0.00}
                {/if}
                {if $entries.t1 eq ""}  
                    {$entries.t1=0.00}
                {/if}
                {if $entries.t2 eq ""}  
                    {$entries.t2=0.00}
                {/if}            
                {if $entries.t3 eq ""}  
                    {$entries.t3=0.00}
                {/if}            
            <tr class="{cycle values="even,odd"}">
                <td>{$entries.d1}</td>
                <td>{$entries.emp_name}</td>
                <td>{$entries.t0}</td>
                <td>{$entries.t1}</td>
                <td>{$entries.t2}</td>
                <td>{$entries.t3}</td>
                <td>{$entries.t0+$entries.t1+$entries.t2+$entries.t3}</td>
            </tr>
            {$Normal_total=$Normal_total+$entries.t0}
            {$Travel_total=$Travel_total+$entries.t1}
            {$break_total=$break_total+$entries.t2}
            {$onCall_total=$onCall_total+$entries.t3}
      {foreachelse}
                <tr ><td colspan=7><div class="message">{$translate.no_data_available}</div></td></tr> 
                {$flag=false}
      {/foreach}
      {if $flag }
        <tr>
            <th colspan=2>{$translate.total}</th>
            <th>{$Normal_total}</th>
            <th>{$Travel_total}</th>
            <th>{$break_total}</th>
            <th>{$onCall_total}</th>
            <th>{$Normal_total+$Travel_total+$break_total+$onCall_total}</th>
        </tr>
       {/if}
    </table>
    </div>
{/block}
