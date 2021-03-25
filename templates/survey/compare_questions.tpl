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
<script type="text/javascript" src="{$url_path}js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript">
$(document).ready(function (){
    $('.report_group').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane({
                showArrows: true
    });
    
  /*  $(".survey_radio").click(function(){
        var survey_id = $(this).val();
       $(".reportdetail_groupsanswer").load('{$url_path}S_ajax_compare_questions.php?survey_id={$survey_id}&selected_survey='+survey_id);
        //alert(survey_id);
    });*/
})

function getReport(){
    var selected = $("input[type='radio'][name='question_id']:checked");
    var question_id = selected.val();
    document.location.href = "{$url_path}S_compare_question_final_report.php?question_id="+question_id;
    //alert(selected.val());
}
</script>
{/block}
{block name="content"}
<div id="wrapper">
    <div class="Surveys_block clearfix">
        <div class="typeof_reporthd clearfix">
            <div class="report_name">Compare Report</div>
            <div class="reportdetails_agerange">
                <div class="reportdetails_agerangecnt">Age Range :</div>
                <div class="result_fromdate">
                    <input type="text" class="result_agebox" name="textfield" id="age_from">
                </div>
                <div class="result_todate">
                    <div class="reportdetails_to">To</div>
                    <input type="text" class="result_agebox" name="textfield" id="age_to">
                </div>
            </div>
            <div class="reports_gender">
                <div class="reportgender_cnt">Gender :</div>
                <div class="surveystatus_exp">
                    <input name="male_select" type="checkbox" value="1" id="male_select">
                </div>
                <div class="surveystatus_experd">Male </div>
                <div class="surveystatus_exp">
                    <input name="female_select" type="checkbox" value="2" id="female_select">
                </div>
                <div class="surveystatus_experd">Female </div>
                <input type="hidden"  name="gender" id="gender" value="">
            </div>
            <div class="creat_reportbtn"><a href="javascript:void(0)" onclick="getReport()">Creat Report</a></div>
        </div>
        <div style="clear:both">
            <div class="surveyresult_qustblock" style="padding:0px;"> </div>
            <div class="survey_caption clearfix">
                <div class="selectsurvey_name">{$survey_detail[0].survey_title}</div>
                <div class="selectsurvey_date">
                    <div class="reportdetails_date">Date: {$survey_detail[0].created_date|date_format:'%Y-%m-%d'}</div>
                </div>
            </div>
            <div class="customerview_surveylisting clearfix">
                <input type="hidden" name="selected" id="selected" value="" />
                <input type="hidden" name="survey_id" id="survey_id" value="{$survey_id}" />
                <div class="customerview_serveylist clearfix " onclick="">
                    <div class="customerview_servaname clearfix">
                        <a>Versions</a>
                        <input type="hidden" name="versions_report" id="versions_report" value="" />
                    </div>
                    <div class="customerview_selectbutton clearfix"><a href="javascript:void(0);" onclick="addVersions()" id="add_groups">ADD Version </a></div>
                </div>
                <div  class="customerviewserva_listeddetails">
                    <div class="coustomerview_discription clearfix">
                        <div class="report_questionblock">
                            <div class="report_group" style="width: 407px">
                                <div class="reportdetail_qusthdr">Surveys</div>
                                <div class="reportdetail_groups">
                                    {foreach $survey_questions AS $quest}
                                            <div class="report_questblock clearfix" style="width: 380px;">
                                        <div class="quest_check">
                                            <input name="question_id"  id="question_{$quest.id}" type="radio" value="{$quest.id}" class="question_radio">
                                        </div>
                                        
                                        <div class="group_cnt">{$quest.question}</div>
                                    </div>
                                    {/foreach}
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="report_selectgroup" style="width: 407px">
                                <div class="reportdetail_qusthdr">Selected Versions</div>
                                <div class="reportdetail_groupsanswer clearfix">
                                   <!-- <div class="report_selectedgroups">maneesh <a></a></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
{/block}