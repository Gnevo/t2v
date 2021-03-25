{block name="style"}
{*    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />*}
    <link href="{$url_path}css/survey.css" rel="stylesheet" type="text/css" />
{/block}
{block name="script"}
<script type="text/javascript">
    $(document).ready(function(){	  
        /*$("#tabAccountAccordion .accordion-group").click(function() {
            $(".btn_survey_start").addClass('hide');
            $(this).find(".btn_survey_start").removeClass('hide');
        });*/
        
        $('.btn_survey_start').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
    });
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget no-ml">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.survey}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button onclick="javascript:location='{if $user_role == 1}{$url_path}surveys/{else}{$url_path}message/center/{/if}';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                {if $surveys|count gt 0}
                    <div class="accordion accordion-2" id="tabAccountAccordion">
                        {foreach $surveys AS $survey}
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle glyphicons right_arrow" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-{$survey.id}">
                                        <i></i>{$survey.survey_title}
                                        <button onclick="javascript:location='{$url_path}user/question/survey/{$survey.id}/';" class="btn btn-success btn-normal pull-right btn_survey_start" style="margin: 5px; padding-left: 5px; padding-right: 5px;" type="button">
                                            {$translate.go_to_questions} <span class="icon-arrow-right"></span>
                                        </button>
                                    </a>
                                </div>
                                <div style="height: 0px;" id="collapse-{$survey.id}" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <div class="margin-none">
                                            <span class="label label-success">{$translate.created_on}: {$survey.created_date}</span>
                                            <span class="label label-important">{$translate.expiry_date}: {$survey.expire_date}</span>
                                            <span class="label label-info">{$translate.number_of_forms}: {$survey.form_count}</span><br> 
                                            {if $survey.description neq ''}<p style="margin: 10px 0px 0px;" class=""><strong>{$translate.description}</strong><br>{$survey.description}</p>{/if}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <div class="message">{$translate.no_surveys_to_attend}</div>
                {/if}
            </div>
        </div>
    </div>               
{/block}