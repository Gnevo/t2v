{block name='script'}
<script type="text/javascript">
    function printForm(){
        var f = $("#form_list");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
        f.attr('target', '_SELF');
        $('#action').val('');
    }
</script>
{/block}
{block name="content"}
<div class="tbl_hd"><span class="titles_tab">{$translate.atl_warning}</span>
    <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    <a onclick="printForm()" href="javascript:void(0)" class="print"><span class="btn_name">{$translate.print}</span></a>
    <div class="titlebar_chekbox" style="margin-top: 4px; margin-right: 12px;"> 
        <form id="form_list" name="form_list" method="post" action="{$url_path}atl/warning/">
            <input type="hidden" name="action" id="action" value="" />
            {$translate.month}:
            <select id="month" name="month">
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
            </select>
            {$translate.year}:
            <select id="year" name="year">

                {foreach $years_report AS $yrs}
                    <option value="{$yrs.year}" {if $yrs.year == $year}selected="selected"{/if}>{$yrs.year}</option>
                {/foreach}
            </select>
            <input type="submit" name="get_report" id="get_report" value="{$translate.get_report}" />
        </form>


    </div>
</div>
<div id="tble_list">


    <div id="table_val">

        <table class="table_list">
            <tr>
                
                <th>{$translate.date}</th>
                <th>{$translate.name}</th>
                <th>{$translate.time_from}</th>
                <th>{$translate.time_to}</th>
            </tr>
            {foreach from=$reports item=report}
                <tr  class="{cycle values='even,odd'}">
                    
                    <td style="text-align: center">{$report.date}</td>
                    <td style="text-align: center">{$report.last_name} {$report.first_name}</td>
                    <td style="text-align: center">{$report.time_from}</td>
                    <td style="text-align: center">{$report.time_to}</td>

                </tr>
            {foreachelse}
                <tr><td colspan="8">
                        <div class="message">{$translate.no_data_available}</div>
                    </td></tr>
                {/foreach}
        </table></div></div>        
{/block}