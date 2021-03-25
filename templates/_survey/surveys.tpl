{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1>{$translate.survey}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                    <button onclick="javascript:location='{$url_path}administration/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="row-fluid">
                <div class="span12 icons-group">
                    <div class="span12 icons-group">
                        <ul>
                            <li><a href="{$url_path}manage/surveys/list/"><div class="administration-survey-manage-survey"></div><label>{$translate.manage_survey}</label></a></li>
                            <li><a href="{$url_path}user/survey/"><div class="administration-survey-attend-survey"></div><label>{$translate.attend_survey}<br></label></a></li>
{*                                <li><a href="{$url_path}report/survey/list/"><div class="administration-survey-attend-survey"></div><label>{$translate.survey_report}<br></label></a></li>*}
                            <li><a href="{$url_path}S_survey_report_types.php"><div class="administration-survey-survey-report"></div><label>{$translate.survey_report}<br></label></a></li>
                        </ul>               
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>
{/block}