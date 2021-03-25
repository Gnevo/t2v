{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/survey.css"/>
<style type="text/css">
        .horizontal-only {
            height: auto;
            max-height: 250px;
        }
        .textarea-responds ol li {
            border-bottom: 1px dashed brown;
            line-height: 1.5;
            padding-bottom: 4px;
            padding-top: 4px;
            white-space: pre-wrap;
        }
        .special_count_persentage{
            font-size: 10px;
            font-style: italic;
            float: right;
        }
        .graph_heading td {
            border: 1px solid #e1e1e1;
            color: #6c6c6c;
            font-size: 13px;
        }
        .report_hd {
            font-weight: bold;
        }
        .selectsurvey_date {
            font-size: 11px;
            font-style: italic;
            padding: 9px;
        }
        ol.textarea-responds li{ white-space: pre-wrap;}
</style>
{/block}
{block name="script"}
    <script src="{$url_path}js/surveys/amcharts.js" type="text/javascript" ></script>
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

        $(document).ready(function(){
            $('.download_survey_file').click(function(){
                var file_name = $(this).html();
                if(file_name != ''){
                    $('#download_form #file_name').val(file_name);
                    $('#download_form').submit();
                }
            });
        });
    </script>
  
{/block}

{block name="content"}
    <div class="row-fluid">
        <div style="width: 99%; position: relative;" class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget no-ml">
                <div style="" class="widget-header span12">
                    <div class="pull-left day-slot-wrpr-header-left">
                        <h1>{$survey_detail[0].survey_title}</h1>
                    </div>
                    <div class="selectsurvey_date pull-left">-&nbsp;&nbsp;{$survey_detail[0].created_date|date_format:'%Y-%m-%d'}</div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button onclick="javascript:location='{$url_path}custom/survey/report/{$survey_detail[0].id}/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span3">
                        <div id="chartContainer" class="span12" style="width: 100%; border: thin solid rgb(204, 204, 204); background-color: white;">
                            <div class="widget-header span12" style="background: none repeat scroll 0% 0% white;">
                                <div class="day-slot-wrpr-header-left">
                                    <h1 style="text-align: center; font-weight: 800; font-size: 20px ! important;">{$translate.survey_reports}</h1>
                                </div>
                            </div>
                            <div id="chartdiv" style="height: 250px; width: 100%;"></div>
                            <div class="span12 no-ml" style="padding: 4px;"><table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody><tr class="graph_heading">
                                            <td width="9%" align="center" valign="middle"><div class="report_hd">{$translate.total}</div>
                                                <div>{$total_users} </div></td>
                                            <td width="10%" align="center" valign="middle"><div class="report_hd">{$translate.started}</div>
                                                <div>{$not_completed} </div></td>
                                            <td width="11%" align="center" valign="middle"><div class="report_hd">{$translate.completed}</div>
                                                <div>{$completed}</div></td>
                                        </tr>
                                    </tbody></table> 
                            </div>
                        </div>
                                        
                        <form name="download_form" id="download_form" method="post" class="no-mb">
                            <input type="hidden" name="action" value="download"/>
                            <input type="hidden" name="file_name" id="file_name" value=""/>
                        </form>
                    </div>
                    <div class="span9">
                        <div class="accordion accordion-2" id="tabAccountAccordion">
                            {foreach $question_reports AS $report}
                                {if $report.ans_count == 0}{$report.ans_count =  1}{/if}
                                <div class="accordion-group{if $filter_type == 2 && !in_array($report.id, $questions)} hide{/if}" data-question={$report.id}>
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle glyphicons right_arrow collapsed" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-{$report.id}">
                                            <i></i>{$report.question}
                                            {if in_array($report.answer_type, [1,2,3,4,5,6,7,8,9])}<span style="margin: 9px;" class="label label-success pull-right">{$translate.user_responds} ({$report.ans_count})</span>{/if}
                                        </a>
                                    </div>
                                    <div style="height: 0px;" id="collapse-{$report.id}" class="accordion-body collapse">
                                        <div class="accordion-inner span12">
                                            {if in_array($report.answer_type, [1,2,3,6,7])}
                                                <div style="padding: 10px;" class="table-responsive">
                                                    <table class="table table-bordered table-condensed table-hover table-primary " style="top: 0px; margin: 0px;">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-col-center" style="width: 30px;">&nbsp;</th>
                                                                <th>{$translate.answer}</th>
                                                                <th>{$translate.count}</th>
                                                                <th>{$translate.percent}</th>
                                                                <th><ul class="table-progress-report-list-label">
                                                                        <li><span class="pull-left">0</span>20</li>
                                                                        <li>40</li>
                                                                        <li>60</li>
                                                                        <li>80</li>
                                                                        <li>100</li>
                                                                    </ul>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        {assign i 1}
                                                        {assign j 0}
                                                        <tbody>
                                                            {foreach $report.answers AS $answer}
                                                                {assign ans_key 0}
                                                                {for $j=0 to count($questions)-1}
                                                                    {if $questions[$j] == $report.id}
                                                                        {assign var=ans value=","|explode:$answers[$j]}
                                                                        {assign j 0}
                                                                        {for $j = 0 to count($ans) - 1}
                                                                            {if $ans[$j] == $answer.answer_text}
                                                                                {assign ans_key 1}  
                                                                                {break}
                                                                            {/if}
                                                                        {/for}
                                                                    {/if}
                                                                {/for}
                                                                <tr class="gradeX">
                                                                    <td class="center">{$i}</td>{assign i $i+1}
                                                                    <td>{$answer.answer_text}</td>
                                                                    <td class="center" style="width: 5%;">{if isset($answer.count)}{$answer.count}{else}0{/if}</td>
                                                                    <td style="width: 5%;" class="center">{if isset($answer.count)}{round(($answer.count/$report.ans_count)*100 , 2)}{else}0{/if}%</td>
                                                                    <td style="padding: 5px;">
                                                                        <ul class="table-progress-report-list-progressbar">
                                                                            <li style="width:{if isset($answer.count)}{round(($answer.count/$report.ans_count)*100 , 2)}{else}0{/if}%;"></li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            {/foreach}
                                                            <tr class="gradeX">
                                                                <td colspan="2" class="child_holi "><strong>{$translate.total}</strong></td>
                                                                <td style="width: 5%;" class="center"><strong>{$report.ans_count}</strong></td>
                                                                <td class="center" style="width: 5%;"><strong>100%</strong></td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <span class="label label-primary pull-left" style="margin: 9px;">{$translate.mean} ({$report.mean})</span>
                                                <span class="label label-warning left" style="margin: 9px;">{$translate.standard_deviation} ({$report.standerd_deviation})</span>
                                                <span class="label label-important pull-left" style="margin: 9px;">{$translate.confidence_interval} (@ 95% :  [{$report.confidence_low_limit} - {$report.confidence_high_limit}]) </span>
                                            {else if $report.answer_type eq 10}
                                                {if $report.answers|count gt 0}
                                                    <div style="padding: 10px;" class="table-responsive">
                                                        <table class="table table-bordered table-condensed table-hover table-primary " style="top: 0px; margin: 0px;overflow-x: auto;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-col-center" style="width: 30px;" rowspan="2">&nbsp;</th>
                                                                    <th rowspan="2" style="vertical-align: middle;">{$translate.questions}</th>
                                                                    <th colspan="{$report.answers|count}" style="text-align: center;">{$translate.answer} {$translate.count}</th>
                                                                    <th rowspan="2" style="vertical-align: middle;" width='48%'><ul class="table-progress-report-list-label">
                                                                            <li><span class="pull-left">0</span>20</li>
                                                                            <li>40</li>
                                                                            <li>60</li>
                                                                            <li>80</li>
                                                                            <li>100</li>
                                                                        </ul>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    {foreach $report.answers AS $answer}
                                                                        <th  style="vertical-align: middle;">{$answer.answer_text}</th>
                                                                    {/foreach}
                                                                </tr>
                                                            </thead>
                                                            {if $report.sub_questions|count gt 0}
                                                                {assign i 1}
                                                                {assign j 0}
                                                                <tbody>
                                                                    {foreach $report.sub_questions AS $subquestion}
                                                                        <tr class="gradeX">
                                                                            <td class="center">{$i}</td>
                                                                            <td>{$subquestion.question}</td>
                                                                            {foreach $subquestion.answers AS $answer}
                                                                                <td>{if isset($answer.count)}{$answer.count} <span class="special_count_persentage">({round(($answer.count/$subquestion.ans_count)*100 , 2)}%)</span>
                                                                                    {else}0{/if}</td>
                                                                            {/foreach}
                                                                            <td style="padding: 5px;">
                                                                                {foreach $subquestion.answers AS $answer}
                                                                                    <ul class="table-progress-report-list-progressbar span12 no-ml no-min-height no-mt" style="margin-top: 0px !important;background-color: rgb(244,241,226)">
                                                                                        <li style="cursor: help;width:{if isset($answer.count)}{round(($answer.count/$subquestion.ans_count)*100 , 2)}{else}0{/if}%;" title="{$answer.answer_text} ({if isset($answer.count)}{round(($answer.count/$subquestion.ans_count)*100 , 2)}{else}0{/if}%)"></li>
                                                                                    </ul>
                                                                                {/foreach}
                                                                            </td>
                                                                        </tr>
                                                                        {assign i $i+1}
                                                                    {/foreach}
                                                                </tbody>
                                                            {/if}
                                                        </table>
                                                    </div>
                                                {/if}
                                            {else}
                                                {if $report.user_responds|count gt 0}
                                                    <ol class="span12 user-respond-list{if $report.answer_type eq 5} textarea-responds{/if}"  style="margin-left: 15px ! important; list-style: decimal outside none ! important;">
                                                        {foreach $report.user_responds AS $user_responds}
                                                            {if $report.answer_type eq 9}{*file upload*}
                                                                <li><a href="javascript:void(0)" class="download_survey_file">{$user_responds}</a></li>
                                                            {else}
                                                                <li>{$user_responds}</li>
                                                            {/if}
                                                        {/foreach}
                                                    </ol> 
                                                {else}
                                                    <div class='message'>{$translate.no_responds_found}</div>
                                                {/if}
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                            {/foreach}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

{/block}