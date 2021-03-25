{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <style>
        .employe_contractdetail {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: #D6D6D6 #D6D6D6 -moz-use-text-color;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 1px 0;
            margin: 0 7px;
            padding: 11px 6px;
        }
        #employe_contractdetail .info_name {
            background: none repeat scroll 0 0 #F7F4CD;
            color: #383838;
            float: left;
            font-size: 13px;
            margin-right: 4px;
            padding: 5px;
            width: 190px;
        }
    </style>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd"><span class="titles_tab">{$employee_details.last_name} {$employee_details.first_name}</span>
        <a class="back" href="{$url_path}employee/report/contract/{$year}/{$page}/">{$translate.backs}</a>
    </div>
    {*foreach $contract_reports AS $report}
    <div id="tble_list" class="clearfix">
    {if $report.date_from neq ""}
    <div class="clearfix employe_contractdetail" id="employe_contractdetail">
    <div class="info_name" style="width:  auto"><b>{$translate.contract_from} : </b>{$report.date_from}</div>
    <div class="info_name"><b>{$translate.contract_to} :</b>{$report.date_to}</div>
    <div class="info_name"><b>{$translate.contract_hour} : </b>{$report.hour}</div>
    <div class="info_name"><b>{$translate.monthly_hour} : </b>{$report.monthly}</div>
    </div>
    {/if}
    <div id="showdata">
    <div style="display: block;" id="showmain5">
    <input type="hidden" value="6" id="pages" name="pages">
    <div style="float:left; width:871px; margin-left:6px;">
    <table border="1" style="width:869px;" class="table_list ">               
    <tbody><tr>
    <th>{$translate.week}</th>
    <th>{$translate.employee_worked_hour}</th>
    <th>{$translate.weekly_hour}</th>
    <th>{$translate.remaining_hour}</th>
    </tr>
    {foreach $report.weeks AS $week}
    <tr class="odd">
    <td align="center">&nbsp;{$week.num}</td>
    <td align="center">&nbsp;{$week.time_emp}</td>	
    <td align="center">&nbsp;{$week.contract_time}</td>
    <td align="center">&nbsp;<span {if $week.excess == 1}style="color: red"{/if}>{$week.excess_val}</span></td>
    </tr>
    {/foreach}
    <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    </tr>	
    </tbody>
    </table></div>
    </div>
    </div>
    </div>
    {/foreach*}
    <div id="tble_list" class="clearfix">
        <div id="showdata">
            <div style="display: block;" id="showmain5">
                <input type="hidden" value="6" id="pages" name="pages">
{*                weekly details*}
                <div class="span12" style="margin:0px;">
                    <table border="1" class="table_list" style="width:100%">               
                        <tbody>
                            <tr>
                                <th>{$translate.week}</th>
                                <th>{$translate.weekly_hour}</th>
                                <th>{$translate.employee_worked_hour}</th>
                                <th>{$translate.remaining_hour}</th>
                            </tr>
                            {foreach $normal_contract_details AS $week}
                                <tr class="odd">
                                    <td align="center">&nbsp;{$week.year}/ {$week.week_no}</td>
                                    <td align="center">&nbsp;{$week.contract_hour}</td>
                                    <td align="center">&nbsp;{$week.work_hour}</td>
                                    <td align="center">&nbsp;<span {if $week.excess_flag eq 1}style="color: red"{/if}>{$week.difference}</span></td>
                                </tr>
                            {/foreach}	
                        </tbody>
                    </table>
                </div>
{*                monthly details*}
                <div class="span12" style="margin:0px;">
                    <table border="1" style="width:100%;" class="table_list ">               
                        <tbody>
                            <tr>
                                <th>{$translate.type}</th>
                                <th>{$translate.monthly_hour}</th>
                                <th>{$translate.employee_worked_hour}</th>
                                <th>{$translate.remaining_hour}</th>
                            </tr>
                            <tr class="odd">
                                <td align="center">{$translate.monthly} {$translate.normal} {$translate.hour}</td>
                                <td align="center">&nbsp;{$monthly_details.contract_hours.normal}</td>
                                <td align="center">&nbsp;{$monthly_details.work_hours.normal}</td>
                                <td align="center">&nbsp;<span {if $monthly_details.excess_flag_normal eq 1}style="color: red"{/if}>{$monthly_details.normal_difference}</span></td>
                            </tr>	
                            <tr class="odd">
                                <td align="center">{$translate.monthly} {$translate.oncall} {$translate.hour}</td>
                                <td align="center">&nbsp;{$monthly_details.contract_hours.oncall}</td>
                                <td align="center">&nbsp;{$monthly_details.work_hours.oncall}</td>
                                <td align="center">&nbsp;<span {if $monthly_details.excess_flag_oncall eq 1}style="color: red"{/if}>{$monthly_details.oncall_difference}</span></td>
                            </tr>	
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>                            
{/block}