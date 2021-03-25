
{block name='script'}
<script type="text/javascript"></script>

{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.inconvenient_report}</span>
       <!-- <a onclick="print_form()" href="javascript:void(0)"><img width="77" height="25" src="{$url_path}images/btn_print.gif"></a>-->
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
            <form method="post" name="form" action="{$url_path}report/inconvenient/detail/">
    
   {$translate.year} : <select id="cmb_year" name="year">
       {html_options values=$year_option_values selected=$report_year output=$year_option_values}
       </select>
   {$translate.month} : <select id="cmb_month" name="month">
            {if $month == ''}
            <option value="01" {if  $smarty.now|date_format:"%m" == 01} selected = "selected" {/if} >{$translate.jan}</option>
            <option value="02" {if  $smarty.now|date_format:"%m" == 02} selected = "selected" {/if}>{$translate.feb}</option>
            <option value="03" {if  $smarty.now|date_format:"%m" == 03} selected = "selected" {/if}>{$translate.mar}</option>
            <option value="04" {if  $smarty.now|date_format:"%m" == 04} selected = "selected" {/if}>{$translate.apr}</option>
            <option value="05" {if  $smarty.now|date_format:"%m" == 05} selected = "selected" {/if}>{$translate.may}</option>
            <option value="06" {if  $smarty.now|date_format:"%m" == 06} selected = "selected" {/if}>{$translate.jun}</option>
            <option value="07" {if  $smarty.now|date_format:"%m" == 07} selected = "selected" {/if}>{$translate.jul}</option>
            <option value="08" {if  $smarty.now|date_format:"%m" == 08} selected = "selected" {/if}>{$translate.aug}</option>
            <option value="09" {if  $smarty.now|date_format:"%m" == 09} selected = "selected" {/if}>{$translate.sep}</option>
            <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.oct}</option>
            <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.nov}</option>
            <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.dec}</option>
            {else}
            <option value="01" {if  $month == 01} selected = "selected" {/if} >{$translate.jan}</option>
            <option value="02" {if  $month == 02} selected = "selected" {/if}>{$translate.feb}</option>
            <option value="03" {if  $month == 03} selected = "selected" {/if}>{$translate.mar}</option>
            <option value="04" {if  $month == 04} selected = "selected" {/if}>{$translate.apr}</option>
            <option value="05" {if  $month == 05} selected = "selected" {/if}>{$translate.may}</option>
            <option value="06" {if  $month == 06} selected = "selected" {/if}>{$translate.jun}</option>
            <option value="07" {if  $month == 07} selected = "selected" {/if}>{$translate.jul}</option>
            <option value="08" {if  $month == 08} selected = "selected" {/if}>{$translate.aug}</option>
            <option value="09" {if  $month == 09} selected = "selected" {/if}>{$translate.sep}</option>
            <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
            <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
            <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
            {/if}
            </select>
   {$translate.employee} : <select id="cmb_customer" name="employee">
            {if $emp == ''}
            {foreach from=$employees item=data}
                <option value="{$data.username}">{$data.first_name} {$data.last_name}</option>
            {/foreach}
            {else}
             {foreach from=$employees item=data}
                <option value="{$data.username}" {if $emp == $data.username}selected = "selected" {/if}>{$data.first_name} {$data.last_name}</option>
            {/foreach}
            {/if}
            </select>
   <input type="submit" name="report" value="{$translate.generate}" />

    </form>
            
        </div>

    </div> <h1></h1>
            
    <div style="width: 871px; overflow-x:scroll; margin: 0 auto">       
  <table class="table_list">
        <tr><th>{$translate.date}</th><th>{$translate.work}</th><th>{$translate.normals}</th><th>{$translate.holiday_big}</th><th>{$translate.holiday_red}</th><th>{$translate.inconvenient_big}</th><th>{$translate.inconvenient_red}</th>{foreach from=$reports item=report} 
                                {foreach from=$report.inconvenience item=inconv}<th>{$inconv.name}</th>{/foreach}{break}{/foreach}</tr>
      {foreach from=$reports item=report}<tr class="{cycle values="even,odd"}"><td>{$report.date}</td><td>{$report.work_name}</td><td>{$report.normal}</td><td>{$report.holiday_big}</td><td>{$report.holiday_red}</td><td>{$report.inconvenient_big}</td><td>{$report.inconvenient_red}</td>
                                {foreach from=$report.inconvenience item=inconv}<td>{$inconv.value}</td>{/foreach} </tr> {/foreach}         
      
              </table>
    </div>
{/block}
