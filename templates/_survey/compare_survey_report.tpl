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
    $(document).ready(function(){
    
    
    });
    function addVersions(){
    
        var versions = $("#versions_report").val();
        var selected_version = new Array();
        var selected_version_id = new Array();
        var selected_version_var = versions.split(",");
        $('.reportdetail_groups input:checked').each(function() {
            selected_version.push($(this).attr('value'));
            selected_version_id.push($(this).attr('id'));
        });
        for(var i = 0;i < selected_version.length;i++){
            var temp_version_id = selected_version_id[i].split("_")
            var version_id = temp_version_id[1];
            for(var j=0; j<selected_version_var.length;j++){
                if(selected_version_var[j] == version_id){
                    break;
                }
            }
            if(j == selected_version_var.length){
                if(versions == ""){
                    versions = version_id;
                }else{
                    versions = versions+","+version_id;
                }
                $("#versions_report").val(versions);
                $('.reportdetail_groupsanswer').append('<div class="report_selectedgroups" style="margin-left:20px">'+selected_version[i]+'<a href="javascript:void(0);" onclick="removeVersion('+version_id+')"></a><input type="hidden" name="grp_id" id="grp_id_'+version_id+'" value="'+selected_version[i]+'" /></div>');
            }
            
        }
       /* $('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
        //scroller();*/
    }
    
    
    function removeVersion(ids){
         var versions = $("#versions_report").val();
         var versions_array = versions.split(",");
         var temp_version = "";
         for(var i = 0;i < versions_array.length;i++){
            if(versions_array[i] != ids){
                if(temp_version == ""){
                    temp_version = versions_array[i];
                }else{
                    temp_version = temp_version+","+versions_array[i];
                }
            }
         }
         $("#versions_report").val(temp_version);
         $('#grp_id_'+ids).parent().remove();
         /*$('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });*/
         //alert(className);
    }
    
    
    function getReport(){
        var age_from = $("#age_from").val();
        var age_to = $("#age_to").val();
        var gender = 3;
        var survey_id = $("#survey_id").val();
        if($("#male_select").attr('checked') && $("#female_select").attr('checked')){
            gender = 3;
        }else{
            if($("#male_select").attr('checked')){
                gender = 1;
            }
            if($("#female_select").attr('checked')){
                gender = 2;
            }
        }
        var filter = '';
        filter = $("#versions_report").val();
        document.location.href = "{$url_path}S_compare_survey_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter="+filter+"&survey_id="+survey_id;
       /* }else if(filter_type == 2){
            filter = $("#quests_report").val();
            var selected_quest = new Array();
            var selected_quest_id = new Array();
            $('.reportdetail_qustionsanswer input:checked').each(function() {
                selected_quest.push($(this).attr('value'));
                selected_quest_id.push($(this).attr('name'));
                
            });
            var filter_condition_quest = '';
            var filter_condition_answer = '';
            for(var i=0;i < selected_quest_id.length;i++){
                if(filter_condition_quest == ""){
                    filter_condition_quest = selected_quest_id[i];
                    filter_condition_answer = selected_quest[i];
                }else{
                    filter_condition_quest = filter_condition_quest+","+selected_quest_id[i];
                    filter_condition_answer = filter_condition_answer+","+selected_quest[i];
                }
            }
            document.location.href = "{$url_path}S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id+"&quest_ans="+filter_condition_quest+"&ans="+filter_condition_answer;
        }else{
            document.location.href = "{$url_path}S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id;
        }*/
        
        
        
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
                            <div class="report_group">
                                <div class="reportdetail_qusthdr">Versions</div>
                                <div class="reportdetail_groups">
                                    {foreach $survey_versions AS $versions}
                                    <div class="report_questblock clearfix">
                                        <div class="quest_check">
                                            <input name="version_{$versions.id}"  id="group_{$versions.id}" type="checkbox" value="{$versions.survey_title}">
                                        </div>
                                        
                                        <div class="group_cnt">{$versions.survey_title}</div>
                                    </div>
                                    {/foreach}
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="report_selectgroup">
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