{block name="style"}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget no-ml">
            <div style="" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="">Types Of Report</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                    <button onclick="javascript:location='{$url_path}surveys/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12 icons-group">
                        <div class="span12 icons-group">
                            <ul>
                                <li><a href="{$url_path}report/survey/list/"><div class="administration-survey-survey-report-custome-report"></div><label>Custom Report</label></a></li>
{*                                <li><a href="{$url_path}S_compare_survey_report.php?survey_id={$survey_id}"><div class="administration-survey-survey-report"></div><label>Comparison Surveys</label></a></li>*}
{*                                <li><a href="{$url_path}S_summery_report.php?survey_id={$survey_id}"><div class="administration-survey-survey-report"></div><label>Summary Report</label></a></li>*}
{*                                <li><a href="{$url_path}S_compare_questions.php?survey_id={$survey_id}"><div class="administration-survey-survey-report"></div><label>Comparison Questions</label></a></li>*}
                            </ul>  
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
{/block}