{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/surveys/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/surveys/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
        .scroll-pane, .scroll-pane-arrows { width: 100% !important; height: 250px; overflow: auto; }
        .horizontal-only { height: auto; max-height: 250px; }
</style>
{/block}
{block name="script"}
<script type="text/javascript" src="{$url_path}js/surveys/jquery.jscrollpane.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        $(".servaqustion_button").hide();    
        $(".customerview_serveylist").click(function(event) {
            if(event.target != "javascript:void(0);"){
                if($(this).parent('.customerview_surveylisting').attr('data-section-name') === 'report_group'){
                    $('#selected').val(1);
                    $(this).parents('.customerview_surveylisting').find(".customerviewserva_listeddetails").slideToggle("slow");
                    $("#quest_custom").hide();
                    $('.reportdetail_groups').data('jsp').reinitialise();
                    $('.reportdetail_groups').jScrollPane();
                    $('.scroll-pane-arrows').jScrollPane({
                                showArrows: true
                    });
                }else{
                    $('#selected').val(2);
                    $(this).parents('.customerview_surveylisting').find(".customerviewserva_listeddetails").slideToggle("slow");
                    $("#groups_custom").hide();
                    $('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
                    $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
                    $('.scroll-pane-arrows').jScrollPane({
                                showArrows: true
                    });
                }
                $('#question_block, .reportdetail_groups').data('jsp').reinitialise();
            }
        });
        $('#question_block, .reportdetail_qustionsanswer, .reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
        
        
        $(".report_questanswerblock .cnt_answerbtn").live('click', function(){
            $(this).parents(".report_questanswerblock").find(".checkbox_answer").toggle();
            $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
        });
        
        $('.quest_check .question_check:checkbox').change(function(){
            var quest_id = $(this).val();
            //console.log(quest_id);
            
            var quest_name = $("#quest_"+quest_id).parents('.report_questblock').find('.quest_cnt').html();
            //var quests = $("#quests_report").val(); //- removed by smsdn
            /*if($(this).prop('checked'))
                $("#quest_"+quest_id).attr('checked', true);
            else
                $("#quest_"+quest_id).attr('checked', false);*/

            /*var selected_quest_var = $( 'input:checkbox:checked.question_check' ).map(function () {
                return this.value;
            }).get();
            console.log(selected_quest_var);
            //var quests = $("#quests_report").val();
            //var selected_quest_var = quests.split(",");
            for(var j=0; j<selected_quest_var.length;j++){
                if(selected_quest_var[j] == quest_id){
                    break;
                }
            }
            console.log(j + '==' + selected_quest_var.length);*/

            //add to list
            if($(this).prop('checked')/*j == selected_quest_var.length*/){

                    //$("#quests_report").val(quests);//- removed by smsdn
                    {foreach $questions AS $quest1}
                        var temp_id = parseInt('{$quest1.id}');
                        var type = parseInt('{$quest1.answer_type}');
                        if(temp_id == quest_id){
                            var class_div='checkbox_answer';
                            var div_val_temp = '';

                            {if in_array($quest1.answer_type, array(1,2,3,6))}
                                {foreach $quest1.answers AS $ans}
                                    div_val_temp += '<div class="answer_row">';
                                    div_val_temp += '<input name="quest_{$quest1.id}_{$ans.id}" type="checkbox" value="{$ans.answer_text}" data-input="{$quest1.id}">';
                                    div_val_temp += '{$ans.answer_text}</div>';
                                {/foreach}
                            {/if}
                             $('.reportdetail_qustionsanswer .jspPane').append('\
                                <div class="report_questanswerblock clearfix">\
                                    <div class="cnt_questionanswer" '+ (type != 1 && type != 2 && type != 3 && type != 6 ? 'style="width: auto;"' : '')+'>\
                                       <div class="question">'+quest_name+'</div>\
                                       '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                            '<div class="answer">\
                                               <div class="'+class_div+'">'+div_val_temp+'</div>\
                                           </div>' : '')
                                    +'</div>\
                                    <div class="">\
                                        '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                            '<input type="button" name="ans" class="cnt_answerbtn" value="answer" />' : '')
                                        +'<input type="hidden" class="shows" name="shows" value=""/>\n\
                                    </div>\n\
                                    <a href="javascript:void(0)" onclick="removeQuest(\''+quest_id+'\');"></a>\n\
                                    <input type="hidden" id="quest_id_'+quest_id+'"/>\n\
                                </div>');
                        }
                    {/foreach}
            }
            //remove from list
            else{
                $('#quest_id_'+quest_id).parents('.report_questanswerblock').remove();
                /*$('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
                $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
                $('.scroll-pane-arrows').jScrollPane({
                            showArrows: true
                });*/
            }
            $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
        });
        
        $('.chk_question_ctrl #all_check_questions').click(function () {
            //remove all already selected questions
            if($(this).prop('checked')){
                $('.coustomerreport_selectquestion .report_questanswerblock').remove();
            }
            
            $('#question_block .report_questblock').find('.question_check:checkbox').attr('checked', this.checked).trigger('change');
{*            $('#question_block .report_questblock').find('.question_check:checkbox').prop('checked', this.checked);*}
        });
        
        
    });
    
    function addGroups(group_id,group_name){
        var groups = $("#groups_report").val();
        var selected_group = new Array();
        var selected_group_id = new Array();
        var selected_group_var = groups.split(",");
//        $('.reportdetail_groups input:checked').each(function() {
//            selected_group.push($(this).attr('value'));
//            selected_group_id.push($(this).attr('id'));
//        });
//        for(var i = 0;i < selected_group.length;i++){
//            var temp_group_id = selected_group_id[i].split("_")
//            var group_id = temp_group_id[1];
        for(var j=0; j<selected_group_var.length;j++){
            if(selected_group_var[j] == group_id){
                break;
            }
        }
        if(j == selected_group_var.length){
            if(groups == ""){
                groups = group_id;
            }else{
                groups = groups+","+group_id;
            }
            $("#groups_report").val(groups);
            $('.reportdetail_groupsanswer').append('<div class="report_selectedgroups" style="margin-left:20px">'+group_name+'<a href="javascript:void(0);" onclick="removeGroup('+group_id+')"></a><input type="hidden" name="grp_id" id="grp_id_'+group_id+'" value="'+group_name+'" /></div>');
        }
        $('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
    
    function removeGroup(ids){
         var groups = $("#groups_report").val();
         var groups_array = groups.split(",");
         var temp_group = "";
         for(var i = 0;i < groups_array.length;i++){
            if(groups_array[i] != ids){
                if(temp_group == ""){
                    temp_group = groups_array[i];
                }else{
                    temp_group = temp_group+","+groups_array[i];
                }
            }
         }
         $("#groups_report").val(temp_group);
         $('#grp_id_'+ids).parent().remove();
         $('#group_'+ids).prop("checked",false);
         $('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
    
    function addQuests(quest_id){
    
        return false;
        var quest_name = $("#quest_"+quest_id).parents('.report_questblock').find('.quest_cnt').html();
        //var quests = $("#quests_report").val(); //- removed by smsdn
        
        console.log($("#quest_"+quest_id).attr('checked'));
        if($("#quest_"+quest_id).attr('checked'))
            $("#quest_"+quest_id).attr('checked', true);
        else
            $("#quest_"+quest_id).attr('checked', false);
        
        var selected_quest_var = $( 'input:checkbox:checked.question_check' ).map(function () {
            return this.value;
        }).get();
        //var quests = $("#quests_report").val();
        //var selected_quest_var = quests.split(",");
        for(var j=0; j<selected_quest_var.length;j++){
            if(selected_quest_var[j] == quest_id)
                break;
        }
        console.log(j + '==' + selected_quest_var.length);
        if(j == selected_quest_var.length){
                
                //$("#quests_report").val(quests);//- removed by smsdn
                {foreach $questions AS $quest1}
                    var temp_id = parseInt('{$quest1.id}');
                    var type = parseInt('{$quest1.answer_type}');
                    if(temp_id == quest_id){
                        var class_div='checkbox_answer';
                        var div_val_temp = '';
                         
                        {if in_array($quest1.answer_type, array(1,2,3,6))}
                            {foreach $quest1.answers AS $ans}
                                div_val_temp += '<div class="answer_row">';
                                div_val_temp += '<input name="quest_{$quest1.id}_{$ans.id}" type="checkbox" value="{$ans.answer_text}" data-input="{$quest1.id}">';
                                div_val_temp += '{$ans.answer_text}</div>';
                            {/foreach}
                        {/if}
                         $('.reportdetail_qustionsanswer .jspPane').append('\
                            <div class="report_questanswerblock clearfix">\
                                <div class="cnt_questionanswer" '+ (type != 1 && type != 2 && type != 3 && type != 6 ? 'style="width: auto;"' : '')+'>\
                                   <div class="question">'+quest_name+'</div>\
                                   '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                        '<div class="answer">\
                                           <div class="'+class_div+'">'+div_val_temp+'</div>\
                                       </div>' : '')
                                +'</div>\
                                <div class="">\
                                    '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                        '<input type="button" name="ans" class="cnt_answerbtn" value="answer" />' : '')
                                    +'<input type="hidden" class="shows" name="shows" value=""/>\n\
                                </div>\n\
                                <a href="javascript:void(0)" onclick="removeQuest(\''+quest_id+'\');"></a>\n\
                                <input type="hidden" id="quest_id_'+quest_id+'"/>\n\
                            </div>');
                    }
                {/foreach}
        }
        $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
    }
    
    function getReport(){
        
        var gender = 3;
        if($("#male_select").attr('checked') && $("#female_select").attr('checked')){
            gender = 3;
        }else{
            if($("#male_select").attr('checked'))
                gender = 1;
            if($("#female_select").attr('checked'))
                gender = 2;
        }
        $("#gender").val(gender);
        var filter_type = $("#selected").val();
        var filter = '';
        if(filter_type == 1){
            var css_div = $('#groups_custom').css('display');
            if(css_div == 'none'){
                $("#selected").val('');
                $("#report_form").submit();
            }else{
            filter = $("#groups_report").val();
            $("#filter").val(filter);
            //document.location.href = "{$url_path}S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id;
            $("#report_form").submit();
        }
            
        }
        else if(filter_type == 2){
            var css_div = $('#quest_custom').css('display');
            if(css_div == 'none'){
            $("#selected").val('');
                $("#report_form").submit();
            }else{
                var filter = $( 'input:checkbox:checked.question_check' ).map(function () {
                    return this.value;
                }).get().join(',');

                //filter = $("#quests_report").val();
                var selected_quest = new Array();
                var selected_quest_id = new Array();
                var selected_question = new Array();
                $('.reportdetail_qustionsanswer input:checked').each(function() {
                    selected_quest.push($(this).attr('value'));
                    selected_quest_id.push($(this).attr('name'));
                    selected_question.push($(this).attr('data-input'));
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
                    if(selected_question[i] != selected_question[i+1] && i+1 != selected_quest_id.length)
                       filter_condition_answer = filter_condition_answer+"-"; 
                }
                $("#ans").val(filter_condition_answer);

                $("#filter").val(filter);
                 $("#report_form").submit();
    //            document.location.href = "{$url_path}S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id+"&quest_ans="+filter_condition_quest+"&ans="+filter_condition_answer;
            }
        }else{
            $("#report_form").submit();
//            document.location.href = "{$url_path}S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id;
        }
    }
    
    function removeQuest(ids){
        ids = parseInt(ids);
        /*var quests = $("#quests_report").val();
        var quests_array = quests.split(",");
        var temp_quests = "";
        for(var i = 0;i < quests_array.length;i++){
           if(quests_array[i] != ids){
               if(temp_quests == ""){
                   temp_quests = quests_array[i];
               }else{
                   temp_quests = temp_quests+","+quests_array[i];
               }
           }
        }
        $("#quests_report").val(temp_quests);*/
        $('#quest_id_'+ids).parent().remove();
        $('#quest_'+ids).prop("checked",false);
        $('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
        $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
</script>
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <form name="report_form" id="report_form" method="post" action="{$url_path}S_custom_final_report.php" class="clearfix">
            <div class="Surveys_block clearfix" style="height: auto; padding: 0px;">
                <input type="hidden" name="groups_report" id="groups_report" value="" />
                <input type="hidden" name="ans" id="ans" value="" />
                <input type="hidden" name="filter" id="filter" value="" />
{*                <input type="hidden" name="quests_report" id="quests_report" value="" />*}
                <div class="typeof_reporthd clearfix">
                    <div class="report_name">{$translate.custom_report}</div>
                    <div class="reportdetails_agerange">
                        <div class="reportdetails_agerangecnt no-mt">{$translate.age_range} :</div>
                        <div class="result_fromdate">
                            <input type="text" class="result_agebox" name="age_from" id="age_from">
                        </div>
                        <div class="result_todate">
                            <div class="reportdetails_to no-mt">{$translate.to}</div>
                            <input type="text" class="result_agebox" name="age_to" id="age_to">
                        </div>
                    </div>
                    <div class="reports_gender">
                        <div class="reportgender_cnt no-mt">{$translate.gender} :</div>
                        <div class="surveystatus_exp no-mt">
                            <input name="male_select" type="checkbox" value="1" id="male_select">
                        </div>
                        <div class="surveystatus_experd no-mt">{$translate.male} </div>
                        <div class="surveystatus_exp no-mt">
                            <input name="female_select" type="checkbox" value="2" id="female_select">
                        </div>
                        <div class="surveystatus_experd no-mt">{$translate.female} </div>
                        <input type="hidden"  name="gender" id="gender" value="">
                    </div>
                        
                    <button onclick="javascript:location='{$url_path}report/survey/list/';" style="margin: 0px 5px;" class="btn btn-primary btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                </div>

                <div style="clear:both">
                    <div class="surveyresult_qustblock" style="padding:0px;"> </div>
                    <div class="survey_caption clearfix">
                        <div class="selectsurvey_name">{$survey[0].survey_title}</div>

                        <div class="selectsurvey_date">
                            <div class="reportdetails_date">{$translate.date}: {$survey[0].created_date|date_format:'%Y-%m-%d'}</div>
                        </div>
                        <div class="creat_reportbtn" style="float: right; font-weight:normal;margin-right: 5px;">
                            <a href="javascript:void(0)" onclick="getReport()">{$translate.create_report}</a>
                        </div>
                    </div>
{*                    group block*}
                    <div class="customerview_surveylisting clearfix" data-section-name='report_group'>
                        <input type="hidden" name="selected" id="selected" value="" />
                        <input type="hidden" name="survey_id" id="survey_id" value="{$survey_id}" />
                        <div class="customerview_serveylist clearfix ">
                            <div class="customerview_servaname clearfix"><a>{$translate.groups}</a></div>
                            <div class="customerview_selectbutton clearfix">
                                <a href="javascript:void(0);" onclick="addGroups()" id="add_groups" style="display: none">{$translate.add_groups} </a>
                            </div>
                        </div>
                        <div style="display:none;" class="customerviewserva_listeddetails" id="groups_custom">
                            <div class="coustomerview_discription clearfix">
                                {if $groups|count gt 0}
                                    <div class="report_questionblock">
                                        <div class="report_group">
                                            <div class="reportdetail_qusthdr">{$translate.groups}</div>
                                            <div class="reportdetail_groups">
                                                {foreach $groups AS $group}
                                                    <div class="report_questblock clearfix">
                                                        <div class="quest_check">
                                                            <input name="group_{$group.group_id}"  id="group_{$group.group_id}" type="checkbox" value="{$group.group_name}" onclick="addGroups('{$group.group_id}','{$group.group_name}')">
                                                        </div>
                                                        <div class="group_cnt">{$group.group_name}</div>
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>
                                        <div class="report_selectgroup">
                                            <div class="reportdetail_qusthdr">{$translate.selected_groups}</div>
                                            <div class="reportdetail_groupsanswer clearfix">
                                                <!-- <div class="report_selectedgroups">maneesh <a></a></div>-->
                                            </div>
                                        </div>
                                    </div>
                                {else}
                                    {$translate.no_group_founds_for_survey}
                                {/if}
                            </div>
                        </div>
                    </div>
                            
{*                    questions block*}
                    <div class="customerview_surveylisting clearfix"  data-section-name='report_questions'>
                        <div class="customerview_serveylist clearfix">
                            <div class="customerview_servaname clearfix">
                                <a>{$translate.questions}</a>
                            </div>
{*                            <div class="customerview_selectbutton clearfix"><a onclick="addQuests()" href="javascript:void(0);" id="add_quests" style="display: none">{$translate.add_questions}</a></div>*}
                        </div>
                        <div style="display:none;" class="customerviewserva_listeddetails" id="quest_custom">
                            <div class="coustomerview_discription">
                                {if $questions|count gt 0}
                                    <div class="report_questionblock clearfix">
                                        <div class="coustomerreport_question">
                                            <div class="reportdetail_qusthdr">
                                                {$translate.questions}
                                                <span class="chk_question_ctrl" style="float: right; font-size: 12px;"><input type="checkbox" name="all_check" id="all_check_questions"><span class="pull-right ml"><label for="all_check_questions">{$translate.check_all}</label></span></span>
                                            </div>
                                            <div class="reportdetail_qustions" id="question_block" style="height: 348px; ">
                                                {foreach $questions AS $quest}
                                                    <div class="report_questblock  span12 no-ml">
                                                        <div class="quest_check">
                                                            <input {*name="quest_{$quest.id}"*}  id="quest_{$quest.id}" type="checkbox" value="{$quest.id}" onclick="addQuests('{$quest.id}')" class="question_check">
                                                        </div>
                                                        <div class="quest_img"><img src="{$url_path}images/surveys/report_quest.jpg" width="7" height="13"></div>
                                                        <div class="quest_cnt">{$quest.question}</div>
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>
                                        <div class="coustomerreport_selectquestion clearfix" >
                                            <div class="reportdetail_qusthdr">{$translate.selected_questions}</div>
                                            <div class="reportdetail_qustionsanswer">
                                            </div>
                                        </div>
                                    </div>
                                {else}
                                    {$translate.no_questions_founds_for_survey}
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}