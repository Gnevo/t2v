{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
        .scroll-pane,
        .scroll-pane-arrows
        {
			width: 100%;
			height: 250px;
			overflow: auto;
        }
        .horizontal-only
        {
			height: auto;
			max-height: 250px;
        }
</style>
{/block}
{block name="script"}
<script src="{$url_path}js/amcharts.js" type="text/javascript" ></script>
<script type="text/javascript" >
    var chart;
    var legend;

    var chartData = [{
        country: "Completed",
        litres: {$completed},
        colors: '#A2E2FF'
    }, {
        country: "Not Started",
        litres: {$not_started},
        colors: '#FF8574'
    }, {
    
        country: "Incomplete",
        litres: {$not_completed},
        colors: '#71F79F'
    }
    ];

    AmCharts.ready(function () {
        // PIE CHART
        chart = new AmCharts.AmPieChart();
        chart.dataProvider = chartData;
        chart.titleField = "country";
        chart.colorField = "colors";
        //chart.labelColorField = "colors_label";
        chart.valueField = "litres";
        chart.outlineColor = "#FFFFFF";
        chart.outlineAlpha = 0.2;
        chart.outlineThickness = 2;
        chart.labelRadius = -30;
        chart.labelText = "[[percents]]%";

        // WRITE
        chart.write("chartdiv");
    });
</script>
{/block}

{block name="content"}
<div id="wrapper">
    <div class="tbl_hd"><span class="titles_tab">Survey  Reports</span>
    </div>
    <div class="Surveys_block clearfix">
        <div class="survey_caption">
            <div class="selectsurvey_name">{$survey_detail[0].survey_title}</div>
            <div class="selectsurvey_date"><div class="reportdetails_date">Date: {$survey_detail[0].created_date|date_format:'%Y-%m-%d'}</div></div>
        </div>
        <div class="final_report">
            <div class="survey_graph">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="graph_hdr">Survey Report : Sample Survey - Sample Reports </td>
                    </tr>
                    <tr class="graph_heading graph_heading_top">
                        <td><div> <div id="chartdiv" style="width: 100%; height: 400px;"></div></div>
                            <div><table width="100%" cellspacing="0" cellpadding="0">
                                    <tr class="graph_heading">
                                        <td width="9%" align="center" valign="middle"><div class="report_hd">Total</div>
                                            <div>{$total_users} </div></td>
                                        <td width="10%" align="center" valign="middle"><div class="report_hd">Started</div>
                                            <div>{$not_completed} </div></td>
                                        <td width="11%" align="center" valign="middle"><div class="report_hd">Completed</div>
                                            <div>{$completed}</div></td>
                                       <!-- <td width="14%" align="center" valign="middle"><div class="report_hd">Completion Rate</div>
                                            <div>1678 </div></td>
                                        <td width="9%" align="center" valign="middle"><div class="report_hd">Drop Outs</div>
                                            <div>1678 </div></td>
                                        <td width="27%" align="center" valign="middle"><div class="report_hd">Average Time to Complete Survey</div>
                                            <div>1678 </div></td>-->
                                    </tr>
                                </table> </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
              
        <div class="final_report">
            <div class="survey_graph">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    
                    <tr>
                        <td colspan="5" class="graph_hdr">{$survey_report[0].question}</td>
                    </tr>
                    <tr class="graph_heading">
                        <td width="3%">&nbsp;</td>
                        <td width="32%">Answer</td>
                        <td width="8%">Count</td>
                        <td width="9%">Percent</td>
                        <td class="percentage" width="48%"><table class="percentage_number" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="22%" align="right" valign="middle">20</td>
                                    <td width="19%" align="right" valign="middle">40</td>
                                    <td width="20%" align="right" valign="middle">60</td>
                                    <td width="18%" align="right" valign="middle">80</td>
                                    <td width="21%" align="right" valign="middle">100</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    {assign i 1}
                    {foreach $survey_report AS $answer}
                    <tr class="graph_question">
                        <td align="center" valign="middle" >{$i}</td>{assign i $i+1}
                        <td>{$answer.answer_text}</td>
                        <td>{if isset($answer.count)}{$answer.count}{else}0{/if}</td>
                        <td>{if isset($answer.count)}{($answer.count/$totol_count)*100}{else}{(0/$totol_count)*100}{/if}%</td>
                        <td><div class="finalreport_percentage" style="width:{if isset($answer.count)}{($answer.count/$totol_count)*100}{else}{(0/$totol_count)*100}{/if}%;"></div></td>
                    </tr>
                    {/foreach}
                   
                    <tr class="graph_totalblock">
                        <td colspan="2" >Total</td>
                        <td>{$totol_count}</td>
                        <td>100%</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="graph_survey_result">
                        <td colspan="5"><table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="15%">Meam : {$report.mean}</td>
                                    <td width="35%">Confidence Interval @ 95% :   [{$report.confidence_low_limit} - {$report.confidence_high_limit}] </td>
                                    <td width="25%">Standard Deviation :   {$report.standerd_deviation}</td>
                                    <td width="25%">Standard Error :  0.039</td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
              
            </div>
        </div>
             
        
              
    </div>
</div>
{/block}