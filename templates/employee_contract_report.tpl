{block name='style'}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .odd_bottom_seperator {
            height: 58px; 
            border-bottom: 2px solid #FFFFFF
        }
    </style>
{/block}

{block name='script'}
<script language="javascript">
function displayNonContract(){
    if($('#include_rest').attr('checked')){
        $("#no_report").show();
    }else{
        $("#no_report").hide();
    }
}

function select_employee(alph){
   var year = $("#cmb_year").val();
    document.location.href = "{$url_path}employee/report/contract/"+year+"/1/"+alph+"/";
}

function getContractLists(){
    var year = $("#cmb_year").val();
    document.location.href = "{$url_path}employee/report/contract/"+year+"/1/";
}

function detailReport(month,user){
    var year = $("#cmb_year").val();
    document.location.href = "{$url_path}employee/report/detail/contract/"+user+"/"+month+"-"+year+"-{$page}/";
}
function paginateDisplay(page,alph){
    var year = $("#cmb_year").val();
    if(alph == "" || alph == null){
        document.location.href = "{$url_path}employee/report/contract/"+year+"/"+page+"/";
    }else{
        document.location.href = "{$url_path}employee/report/contract/"+year+"/"+page+"/"+alph+"/";;
    }
}

</script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">

    <div class="tbl_hd"><span class="titles_tab">{$translate.employee_contract_report}</span>
        <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    <div id="tble_list"> 
        <div class="option_strip">
            <form id="List_form" name="List_form" action="" method="post">
                <div class="workreportform_left">
                    {$translate.year}:
                    <select name=cmb_year id=cmb_year>
                        {html_options values=$year_option_values selected=$list_year output=$year_option_values}
                    </select>
                    <span style="padding-left: 15px">
                        <input type="button" value="{$translate.get}" onclick="getContractLists();"/>
                    </span>
                </div>
            </form>  

        </div>

        <div class="pagention">
            {if $user_role eq 1}
                {assign var='alphabets' value=','|explode:$translate.alphabets}
                <div class="alphbts span8" style="padding-top: 0px;">
                    <ul>
                        {foreach from=$alphabets item=row}
                            <li><a href="javascript:void(0)" onclick="select_employee('{$row}')">{$row}</a></li>
                            {/foreach}
                    </ul>
                </div>
            {/if}
            <div class="pagention_dv span4">
                <div class="pagination" style="margin:0px; float: right; padding-top: 0px;">
                    <ul id="pagination"> 
                        {if $count > 1}
                            {if $page >= 2 && $page != $count}
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('1', '{$alph}')"><img src="{$url_path}images/first.png"  /></a></li>
                                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}', '{$alph}')"><img src="{$url_path}images/prev.png"  /></a></li>
                                <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}', '{$alph}')">{$page-1}</a></li>
                                <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}', '{$alph}')">{$page}</a></li>
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}', '{$alph}')">{$page+1}</a></li>
                                <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}', '{$alph}')"><img src="{$url_path}images/nxt.png"  /></a></li>
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}')"><img src="{$url_path}images/last.png"  /></a></li>
                            {elseif $page == $count}
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('1')"><img src="{$url_path}images/first.png"  /></a></li>
                                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}', '{$alph}')"><img src="{$url_path}images/prev.png"  /></a></li>
                                <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}', '{$alph}')">{$page-1}</a></li>
                                <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}', '{$alph}')">{$page}</a></li>
                            {elseif $page == 1}
                                <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}', '{$alph}')">{$page}</a></li>
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}', '{$alph}')">{$page+1}</a></li>
                                <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}', '{$alph}')"><img src="{$url_path}images/nxt.png"  /></a></li>
                                <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}', '{$alph}')"><img src="{$url_path}images/last.png"  /></a></li>

                            {/if}
                        {/if}
                    </ul>
                </div>
            </div>
        </div>

        <table class="table_list work_report">
            <tbody><tr>
                    <th width="113" height="50">{$translate.employee}</th>
                    <th width="10"></th>
                    {foreach from=$month_option_output item=title_months}
                        <th width="55">{$title_months}</th> 
                    {/foreach}
                </tr>
                {foreach $contract_reports AS $report}
                    <tr class="even customer_reportbg" style="height: 58px;">
                        <td class="usertdname" rowspan="2"><span class="workreport_name">{if $sort_by_name == 1}{$report.first_name} {$report.last_name}{elseif $sort_by_name == 2}{$report.last_name} {$report.first_name}{/if}</span></td>
                        
                        <td class="usertdname" style="text-align: center;">{$translate.normal_report_short}</td>
                        {foreach from=$month_option_output item=title_months key=k}
                            <td>
                                <a onclick ="detailReport('{($k+1)}', '{$report.username}');" href="javascript:void(0);">
                                    <span class="userlevel_2" style="color: #0090ff; {if $report.work_hours.normal[{$k+1}] eq 0.00} margin-bottom: 12px;{/if}">{$report.contract_hours.normal[{$k+1}]}</span>
                                    <span class="userlevel_2">{if $report.work_hours.normal[{$k+1}] neq 0.00}{$report.work_hours.normal[{$k+1}]}{/if}</span></a>
                            </td>
                        {/foreach}
                    </tr>
                    <tr class="odd customer_reportbg odd_bottom_seperator">
                        <td class="usertdname" style="text-align: center;">{$translate.oncall_report_short}</td>
                        {foreach from=$month_option_output item=title_months key=k}
                            <td>
                                <a onclick ="detailReport('{($k+1)}', '{$report.username}');" href="javascript:void(0);">
                                    <span class="userlevel_2" style="color: #0090ff; {if $report.work_hours.oncall[{$k+1}] eq 0.00} margin-bottom: 12px;{/if}">{$report.contract_hours.oncall[{$k+1}]}</span>
                                    <span class="userlevel_2">{if $report.work_hours.oncall[{$k+1}] neq 0.00}{$report.work_hours.oncall[{$k+1}]}{/if}</span></a>
                            </td>
                        {/foreach}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    </div>
                    </div>
{/block}