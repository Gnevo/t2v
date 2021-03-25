{block name='style'}
{*    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />*}
    <link href="{$url_path}css/survey.css" rel="stylesheet" type="text/css" />
    {block name="sub_style"}{/block}
{/block}
{block name="script"}
    <script>
        $(document).ready(function() {
            $('.widget-head-survey-tab .btn').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                return false;
            });
        });
    </script>
    {block name="sub_script"}{/block}
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px;" class="widget-header span12 no-ml">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.manage_survey}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button onclick="javascript:location='{$url_path}surveys/';" class="btn btn-default btn-normal span2 pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div style="margin: 0px;" class="widget widget-tabs widget-tabs-double">
                    <div class="widget-head widget-head-survey-tab">
                        <ul>
                            <li class="step-one {if $survey_tab eq 1}active{/if}"><a href="{$url_path}manage/questions/list/"><div class="survey-tab-icon survey-tab-managequstions"></div><div class="survey-step-info"><h1>{$translate.step} 1</h1> <p>{$translate.manage_questions}</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='{$url_path}manage/questions/';" type="button"><i class="icon-plus"></i> {$translate.add}</button></a></li>
                            <li class="step-two {if $survey_tab eq 2}active{/if}"><a href="{$url_path}manage/forms/list/"><div class="survey-tab-icon survey-tab-manageforms"></div><div class="survey-step-info"><h1>{$translate.step} 2</h1> <p>{$translate.manage_forms}</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='{$url_path}manage/forms/';" type="button"><i class="icon-plus"></i> {$translate.add}</button></a></li>
                            <li class="step-three {if $survey_tab eq 3}active{/if}"><a href="{$url_path}manage/surveys/list/"><div class="survey-tab-icon survey-tab-managesurveys"></div><div class="survey-step-info"><h1>{$translate.step} 3</h1> <p>{$translate.manage_surveys}</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='{$url_path}manage/surveys/';" type="button"><i class="icon-plus"></i> {$translate.add}</button></a></li>
                            <li class="step-four {if $survey_tab eq 4}active{/if}"><a href="{$url_path}manage/groups/list/"><div class="survey-tab-icon survey-tab-managegroups"></div><div class="survey-step-info"><h1>{$translate.step} 4</h1> <p>{$translate.manage_groups}</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='{$url_path}manage/groups/';" type="button"><i class="icon-plus"></i> {$translate.add}</button></a></li>
                            <li class="step-five {if $survey_tab eq 5}active{/if}"><a href="{$url_path}manage/invitations/list/"><div class="survey-tab-icon survey-tab-manageinvitation"></div><div class="survey-step-info"><h1>{$translate.step} 5</h1> <p>{$translate.invitation}</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='{$url_path}manage/invitations/';" type="button"><i class="icon-plus"></i> {$translate.add}</button></a></li>
                        </ul>
                    </div>

                    <div class="widget-body no-padding">
                        <div class="tab-content">
                            {block name="survey_manage_inner_content"}{/block}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}