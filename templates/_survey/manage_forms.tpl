{block name="sub_style"}
    <style type="text/css">
       
    </style>
{/block}

{block name="sub_script"}
<script src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.sortable.js"></script>
<script type="text/javascript">
pageBreakDroppableOptions = {
    accept: "#page_break_btn",
    hoverClass: "hover",
    drop: function(event,ui){
            $(this).after('<div class="span12 no-ml selected_question_wrpr is_page_breaker drop-zone mb">\n\
                                <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                    <hr/> \n\
                                    <input type="hidden" name="quest_ids[]" value="null" id="quest_id[]"  class="quest_id" />\n\
                                </div>\n\
                            </div>');

    }
}
$(document).ready(function() {
    $(".dragdrop-box").sortable({
        items: "div.selected_question_wrpr", 
        cursor: 'move'
    });
    $(".dragdrop-box").disableSelection();
	 
    $("#connected_parent_details .remove_selected_survey").click(function(event){
        window.location.href = "{$url_path}manage/forms/{$form_id}/";
        event.preventDefault();
        event.stopPropagation();
        return false;
    });
    
    $("#draggable-questions .draggable-question").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    $("#page_break_btn").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '110px', 'opacity': '1'}); } 
    });
    
    $(".selected_question_wrpr").droppable(pageBreakDroppableOptions);
    
    // remove ctrl_option
    $(".ctrlstrip-close").live("click",function(){
            //var quest = $(this).parents('.selected_question_wrpr').find('.question_title_data').html();
            if($(this).parents('.selected_question_wrpr').hasClass('is_page_breaker'))
                $(this).parents('.selected_question_wrpr').remove();
            else{
                var quest_id = $(this).parents('.selected_question_wrpr').find('input.quest_id').val();
                $(this).parents('.selected_question_wrpr').remove();
                {foreach $questions_list AS $question}
                    if(quest_id == "{$question.id}"){
                        $("#draggable-questions").append('<div class="row-fluid draggable-question">\n\
                                                    <div class="span12 quest-block">\n\
                                                        <div class="row-fluid">\n\
                                                            <div class="span2 quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>\n\
                                                            <div class="span8 quest-block-center">\n\
                                                                <input name="question_id" class="question_id" type="hidden" value="{$question.id}" />\n\
                                                                <input type="hidden" value="{$question.answer_type}" class="question-type">\n\
                                                                <p class="question_title_data no-mb">{$question.question|escape:'html'}</p>\n\
                                                            </div>\n\
                                                            <div class="span2">\n\
                                                                <input name="check_{$question.id}" id="check_{$question.id}" type="checkbox" value="{$question.question|escape:'html'}" style="margin: 0px 5px 0px 10px ! important;" class="check-box">\n\
                                                                <div class="quastion-input-types pull-left \n\
                                                                    {if $question.answer_type eq 1}survey-quation-input-types-radio \n\
                                                                    {elseif $question.answer_type eq 2}survey-quation-input-types-check \n\
                                                                    {elseif $question.answer_type eq 3}survey-quation-input-types-combo \n\
                                                                    {elseif $question.answer_type eq 4}survey-quation-input-types-textbox \n\
                                                                    {elseif $question.answer_type eq 5}survey-quation-input-types-textarea \n\
                                                                    {elseif $question.answer_type eq 6}survey-quation-input-types-starrating \n\
                                                                    {elseif $question.answer_type eq 7}survey-quation-input-types-customrating \n\
                                                                    {elseif $question.answer_type eq 8}survey-quation-input-types-date \n\
                                                                    {elseif $question.answer_type eq 9}survey-quation-input-types-fileupload \n\
                                                                    {elseif $question.answer_type eq 10}survey-quation-input-types-likertmatrix{/if}"></div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>');
                    }
                {/foreach}
                $("#draggable-questions .draggable-question").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
                        function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
                });
            }

    });
    
    $(".dragdrop-box").droppable({
            accept: ".draggable-question",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                var question = ui.draggable.find(".question_title_data").html();
                var question_id = ui.draggable.find("input.question_id").val();
                var question_type = ui.draggable.find("input.question-type").val();
                ui.draggable.remove();
                var question_type_class = '';
                switch(question_type){
                    case '1': question_type_class = 'survey-quation-input-types-radio'; break;
                    case '2': question_type_class = 'survey-quation-input-types-check'; break;
                    case '3': question_type_class = 'survey-quation-input-types-combo'; break;
                    case '4': question_type_class = 'survey-quation-input-types-textbox'; break;
                    case '5': question_type_class = 'survey-quation-input-types-textarea'; break;
                    case '6': question_type_class = 'survey-quation-input-types-starrating'; break;
                    case '7': question_type_class = 'survey-quation-input-types-customrating'; break;
                    case '8': question_type_class = 'survey-quation-input-types-date'; break;
                    case '9': question_type_class = 'survey-quation-input-types-fileupload'; break;
                    case '10': question_type_class = 'survey-quation-input-types-likertmatrix'; break;
                }
                $('.dragdrop-box').append('<div class="span12 no-ml selected_question_wrpr drop-zone mb">\n\
                                                <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                                <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                                    <div class="quastion-input-types pull-left mr '+question_type_class+' "></div>\n\
                                                    <span class="question_title_data">'+ question +'</span>\n\
                                                    <input type="hidden" class="quest_id" name="quest_ids[]" id="quest_ids[]" value="'+question_id+'" />\n\
                                                </div>\n\
                                            </div>');
    
                $(".selected_question_wrpr").droppable(pageBreakDroppableOptions);
            }
    });
    
    $(".accordion_head").click(function () {
        if ($('.accordion_body').is(':visible')) {
            $(".accordion_body").slideUp(300);
            $(".plusminus").text('+');
        }
        if ($(this).next(".accordion_body").is(':visible')) {
            $(this).next(".accordion_body").slideUp(300);
            $(this).children(".plusminus").text('+');
        } else {
            $(this).next(".accordion_body").slideDown(300);
            $(this).children(".plusminus").text('-');
        }
    });
});

function addToForm(){
    $('#draggable-questions input:checked').each(function() {
        var question_id = $(this).parents('.draggable-question').find('input.question_id').val();
        var question = $(this).parents('.draggable-question').find('.question_title_data').html();
        var question_type = $(this).parents('.draggable-question').find("input.question-type").val();
        var question_type_class = '';
        switch(question_type){
            case '1': question_type_class = 'survey-quation-input-types-radio'; break;
            case '2': question_type_class = 'survey-quation-input-types-check'; break;
            case '3': question_type_class = 'survey-quation-input-types-combo'; break;
            case '4': question_type_class = 'survey-quation-input-types-textbox'; break;
            case '5': question_type_class = 'survey-quation-input-types-textarea'; break;
            case '6': question_type_class = 'survey-quation-input-types-starrating'; break;
            case '7': question_type_class = 'survey-quation-input-types-customrating'; break;
            case '8': question_type_class = 'survey-quation-input-types-date'; break;
            case '9': question_type_class = 'survey-quation-input-types-fileupload'; break;
            case '10': question_type_class = 'survey-quation-input-types-likertmatrix'; break;
        }
        $('.dragdrop-box').append('<div class="span12 no-ml selected_question_wrpr drop-zone mb">\n\
                                        <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                        <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                            <div class="quastion-input-types pull-left mr '+question_type_class+' "></div>\n\
                                            <span class="question_title_data">'+ question +'</span>\n\
                                            <input type="hidden" class="quest_id" name="quest_ids[]" id="quest_ids[]" value="'+question_id+'" />\n\
                                        </div>\n\
                                    </div>');
        $(this).parents('.draggable-question').remove();
    });
    $(".selected_question_wrpr").droppable(pageBreakDroppableOptions);
}
function saveFormSurvey(finalise){
    $('#finalise').val(finalise);
    var selected_category = new Array();
    var categories = "";
    $('#categories_box input:checked.catagory_entry').each(function() {
        selected_category.push($(this).attr('value'));
    });
    for(var i=0;i<selected_category.length;i++){
        if(categories == ""){
            categories = selected_category[i];
        }else{
            categories = categories+","+selected_category[i];
        }
    }
    $("#categores").val(categories);
    var selected_questions = new Array();
    $('.dragdrop-box .selected_question_wrpr').each(function() {
    	selected_questions.push($(this).find("input.quest_id").val());
    });
    
    if(selected_questions.length == 0){
        alert("{$translate.no_question_selected}");
    } else if($("#title").val() == ""){
        alert("{$translate.enter_form_name}");
    }else
        $('#form_create').submit();
}
function deleteFormSurvey(){
	$('#action').val('2');
	$('#form_create').submit();
}
function displayQuestions(){
    var search_val = $("#search_box_question").val();
    search_val = search_val.toLowerCase();
    var selected_questions = new Array();
    
    var selected = new Array();
    var selected_id = new Array();
    var selected_question_type = new Array();
    {foreach $questions_list AS $question}
        selected.push("{htmlspecialchars($question.question)}");
        selected_id.push('{$question.id}');
        selected_question_type.push('{$question.answer_type}');
    {/foreach}
    $('.dragdrop-box .selected_question_wrpr').each(function() {
    	selected_questions.push($(this).find("input.quest_id").val());
    });
    $("#draggable-questions .draggable-question").remove();
    for(var i=0;i<selected.length;i++){
        var temp_search = selected[i];
        for(var j=0;j<selected_questions.length;j++){
            if(selected_questions[j] == selected_id[i]){
                break;
            }
        }
        if(j == selected_questions.length){
            if(search_val.length != 0){
                var regExp = new RegExp(search_val, 'i');
                var x = temp_search.toLowerCase();
                if(regExp.test(x)){
                    var question_type_class = '';
                    switch(selected_question_type[i]){
                        case '1': question_type_class = 'survey-quation-input-types-radio'; break;
                        case '2': question_type_class = 'survey-quation-input-types-check'; break;
                        case '3': question_type_class = 'survey-quation-input-types-combo'; break;
                        case '4': question_type_class = 'survey-quation-input-types-textbox'; break;
                        case '5': question_type_class = 'survey-quation-input-types-textarea'; break;
                        case '6': question_type_class = 'survey-quation-input-types-starrating'; break;
                        case '7': question_type_class = 'survey-quation-input-types-customrating'; break;
                        case '8': question_type_class = 'survey-quation-input-types-date'; break;
                        case '9': question_type_class = 'survey-quation-input-types-fileupload'; break;
                        case '10': question_type_class = 'survey-quation-input-types-likertmatrix'; break;
                    }
                    $("#draggable-questions").append('<div class="row-fluid draggable-question">\n\
                                                    <div class="span12 quest-block">\n\
                                                        <div class="row-fluid">\n\
                                                            <div class="span2 quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>\n\
                                                            <div class="span8 quest-block-center">\n\
                                                                <input name="question_id" class="question_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                                <input type="hidden" value="'+selected_question_type[i]+'" class="question-type">\n\
                                                                <p class="question_title_data no-mb">'+selected[i]+'</p>\n\
                                                            </div>\n\
                                                            <div class="span2">\n\
                                                                <input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" style="margin: 0px 5px 0px 10px ! important;" class="check-box">\n\
                                                                <div class="quastion-input-types pull-left '+question_type_class+'"></div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>');
                }
            }else{
                 var question_type_class = '';
                    switch(selected_question_type[i]){
                        case '1': question_type_class = 'survey-quation-input-types-radio'; break;
                        case '2': question_type_class = 'survey-quation-input-types-check'; break;
                        case '3': question_type_class = 'survey-quation-input-types-combo'; break;
                        case '4': question_type_class = 'survey-quation-input-types-textbox'; break;
                        case '5': question_type_class = 'survey-quation-input-types-textarea'; break;
                        case '6': question_type_class = 'survey-quation-input-types-starrating'; break;
                        case '7': question_type_class = 'survey-quation-input-types-customrating'; break;
                        case '8': question_type_class = 'survey-quation-input-types-date'; break;
                        case '9': question_type_class = 'survey-quation-input-types-fileupload'; break;
                        case '10': question_type_class = 'survey-quation-input-types-likertmatrix'; break;
                    }
                    $("#draggable-questions").append('<div class="row-fluid draggable-question">\n\
                                                    <div class="span12 quest-block">\n\
                                                        <div class="row-fluid">\n\
                                                            <div class="span2 quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>\n\
                                                            <div class="span8 quest-block-center">\n\
                                                                <input name="question_id" class="question_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                                <input type="hidden" value="'+selected_question_type[i]+'" class="question-type">\n\
                                                                <p class="question_title_data no-mb">'+selected[i]+'</p>\n\
                                                            </div>\n\
                                                            <div class="span2">\n\
                                                                <input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" style="margin: 0px 5px 0px 10px ! important;" class="check-box">\n\
                                                                <div class="quastion-input-types pull-left '+question_type_class+'"></div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>');
            }
        }
        
    }
    $("#draggable-questions .draggable-question").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });

}
function displaySearchForms(){
    var search_val = $("#search_forms").val();
    search_val = search_val.toLowerCase();
    if(search_val.length != 0){
        $("#forms_list_wrpr .single_form_block").addClass('hide');
        $('#forms_list_wrpr .single_form_block').each(function( index ) {
            var temp_search = $(this).find('.form_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(temp_search))
                $(this).removeClass('hide');
        });
    }else
        $("#forms_list_wrpr .single_form_block").removeClass('hide');
}
function addCategory(){
    var newCategory = $("#categery_text").val();
    if(newCategory == ""){
        alert("{$translate.enter_category_name}");
    }else{
        $("#categery_create").submit();
    }
}
</script>
{/block}

{block name="survey_manage_inner_content"}
    <div class="tab-pane active">
        <div class="row-fluid">
            <div class="span12 widget-body-section input-group" id="tab-working-panel">
{*                form create/edit section*}
                {if $display_page neq 'list'}
                    {if $selected_survey neq NULL}
                        <div class="span12 filter-bar input-group" id="connected_parent_details">
                            <form>
                                <div class="" style="">
                                    <label>{$translate.survey}:</label>
                                    <div class="badge badge-success badge-survey cursor_hand" onClick="javascript:location='{$url_path}manage/surveys/{$selected_survey}/';">{$selected_survey_title} <span class="icon-remove cursor_hand remove_selected_survey"></span></div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    {/if}
                    <div class="span12 no-ml">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1>{$translate.questions}</h1>
                                    </div>
                                    <div class="pull-right" style="padding: 5px;">
                                        <button class="btn btn-info pull-right" onClick="addToForm();" type="button"><i class="icon-plus"></i> {$translate.add_to_form}</button>
                                    </div>
                                </div>
                                <div class="span12 padding-set" id="forms_section">
                                    <div class="span12 pull-right" style="padding: 5px;">
                                        <a id="page_break_btn" class="btn btn-info pull-right draggable-page-breaker" href="javascript:void(0);" style="cursor: move;"><i class="icon-copy"></i> {$translate.page_break}</a>
                                    </div>
                                    <div class="span12 no-ml">
                                        <label style="float: left;" class="span12" for="search_box_question">{$translate.search_questions}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_questions}" id="search_box_question" type="text"  oninput="displayQuestions()"  onemptied="displayQuestions()" /> 
                                        </div>
                                        <div tabindex="0" id="draggable-questions" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;">
                                            {foreach $questions AS $question}
                                                <div class="row-fluid draggable-question">
                                                    <div class="span12 quest-block">
                                                        <div class="row-fluid">
                                                            <div class="span2 quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>
                                                            <div class="span8 quest-block-center">
                                                                <input name="question_id" class="question_id" type="hidden" value="{$question.id}" />
                                                                <input type="hidden" value="{$question.answer_type}" class="question-type">
                                                                <p class="question_title_data no-mb">{$question.question}</p>
                                                            </div>
                                                            <div class="span2">
                                                                <input name="check_{$question.id}" id="check_{$question.id}" type="checkbox" value="{$question.question|escape:'html'}" style="margin: 0px 5px 0px 10px ! important;" class="check-box">
                                                                <div class="quastion-input-types pull-left 
                                                                    {if $question.answer_type eq 1}survey-quation-input-types-radio
                                                                    {elseif $question.answer_type eq 2}survey-quation-input-types-check
                                                                    {elseif $question.answer_type eq 3}survey-quation-input-types-combo
                                                                    {elseif $question.answer_type eq 4}survey-quation-input-types-textbox
                                                                    {elseif $question.answer_type eq 5}survey-quation-input-types-textarea
                                                                    {elseif $question.answer_type eq 6}survey-quation-input-types-starrating
                                                                    {elseif $question.answer_type eq 7}survey-quation-input-types-customrating
                                                                    {elseif $question.answer_type eq 8}survey-quation-input-types-date
                                                                    {elseif $question.answer_type eq 9}survey-quation-input-types-fileupload
                                                                    {elseif $question.answer_type eq 10}survey-quation-input-types-likertmatrix{/if}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/foreach}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {if $selected_survey neq NULL}            
                                <div class="row-fluid">
                                    <div class="accordion_container"> 
                                        <div class="accordion_head">{$translate.forms}<span class="plusminus">+</span></div> 
                                        <div style="display: none;" class="accordion_body"> 
                                            <div class="row-fluid">
                                                <label style="float: left;" class="span12" for="search_forms">{$translate.search_forms}</label>
                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                    <input type="text" class="form-control span11" placeholder="{$translate.search_forms}" id="search_forms" name="search_forms" oninput="displaySearchForms()"  onemptied="displaySearchForms()" /> 
                                                </div>
                                            </div>
                                            <div class="row-fluid mt">
                                                <div class="span12" id="forms_list_wrpr">
                                                    {foreach $forms as $form}
                                                        <div class="span12 quest-block single_form_block {if $form.id == $form_id}active{/if}">
                                                            <div class="row-fluid" onClick="javascript:location='{$url_path}manage/forms/{$form.id}/{$selected_survey}/';">
                                                                <div class="span2 quest-block-left">
                                                                    <div class="survey-quation-input-types-form pull-left"></div>
                                                                </div>
                                                                <div class="span8 quest-block-center">
                                                                    <p class="form_title_data">{$form.title}</p>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/forms/{if $selected_survey neq NULL}NULL/{$selected_survey|cat:'/'}{/if}';"  type="button"><i class='icon-plus'></i> {$translate.new_form}</button>
                                        {if $status != 0}
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveFormSurvey(1)" type="button"><i class='icon-save'></i> {$translate.save}</button>
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveFormSurvey(0)" type="button"><i class='icon-save'></i> {$translate.save_finalaise}</button>
                                        {/if}
                                        {if $form_id != ""}<button class="btn btn-default btn-normal pull-right" onClick="deleteFormSurvey()" type="button"><i class='icon-trash'></i> {$translate.delete}</button>{/if}
                                        {if $status == 0}<button class="btn btn-default btn-normal pull-right" onClick="javascript:location='{$url_path}manage/forms/{$form_id}/clone/';" type="button"><i class='icon-copy'></i> clone</button>{/if}
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">

                                    <div class="widget" style="margin-top:0;">
                                        <form name="form_create" id="form_create" method="post">
                                            <input type="hidden" id="action" name="action" value="{$action}"/>
                                            <input type="hidden" id="finalise" name="finalise" value=""/>
                                            <input type="hidden" id="form_id" name="form_id" value="{$form_id}"/>
                                            <input type="hidden" id="questions_selected" name="questions_selected"/>
                                            <input type="hidden" id="questions_order" name="questions_order"/>
                                            <input type="hidden" id="categores" name="categores"/>
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="title">{$translate.form_name}</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" placeholder="{$translate.form_name}" id="title" name="title" type="text" value="{if $clone != 'clone'}{$selected_form.title}{/if}" /> 
                                                    </div>
                                                </div>

                                                <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                    <label style="float: left;" class="span12" for="form_discription">{$translate.description}</label>
                                                    <textarea id="form_discription" name="form_discription" style="margin: 0px;" class="form-control span12" rows="1" placeholder="{$translate.description}">{$selected_form.description}</textarea>
                                                </div>
                                            </div>
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_question}</div>
                                                <div class="span12 dragdrop-box no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    {foreach $form_questions AS $question}
                                                        {if $question.question_id == "null"}    {*page break*}
                                                            <div class="span12 no-ml selected_question_wrpr is_page_breaker drop-zone mb">
                                                                <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>
                                                                <div class="span11 no-min-height text-left" style="margin:0;">
                                                                    <hr/> 
                                                                    <input type="hidden" name="quest_ids[]" value="null" id="quest_id[]"  class="quest_id" />
                                                                </div>
                                                            </div>
                                                        {else}
                                                            <div class="span12 no-ml selected_question_wrpr drop-zone mb">
                                                                <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>
                                                                <div class="span11 no-min-height text-left" style="margin:0;">
                                                                    <div class="quastion-input-types pull-left mr 
                                                                                {if $question.answer_type eq 1}survey-quation-input-types-radio
                                                                                {elseif $question.answer_type eq 2}survey-quation-input-types-check
                                                                                {elseif $question.answer_type eq 3}survey-quation-input-types-combo
                                                                                {elseif $question.answer_type eq 4}survey-quation-input-types-textbox
                                                                                {elseif $question.answer_type eq 5}survey-quation-input-types-textarea
                                                                                {elseif $question.answer_type eq 6}survey-quation-input-types-starrating
                                                                                {elseif $question.answer_type eq 7}survey-quation-input-types-customrating
                                                                                {elseif $question.answer_type eq 8}survey-quation-input-types-date
                                                                                {elseif $question.answer_type eq 9}survey-quation-input-types-fileupload
                                                                                {elseif $question.answer_type eq 10}survey-quation-input-types-likertmatrix{/if}
                                                                                "></div>
                                                                    <span class="question_title_data">{$question.question}</span>
                                                                    <span class="label label-info pull-right cursor_hand" onClick="javascript:location='{$url_path}manage/questions/{$question.question_id}/{$form_id}/{if $selected_survey neq NULL}{$selected_survey|cat:'/'}{/if}';">Tillbaka frågan</span>
                                                                    <input type='hidden' class="quest_id" name="quest_ids[]" id='quest_ids[]' value='{$question.question_id}' />
                                                                </div>
                                                            </div>
                                                        {/if}
                                                    {/foreach}
                                                </div>
                                            </div>
                                        </form>
                                                        
{*                                            categories*}
                                        <div class="span12 input-group" style="margin: 0px; padding: 10px 0px 0px;">
                                            <div class="span12" id="categories_box" style="overflow-y: auto; max-height: 100px;">
                                                {foreach $categories as $category}
                                                    <label class="checkbox-inline"><input name="input" type="checkbox" value="{$category.id}" {if in_array($category.id, $category_forms)} checked="checked" {/if} class="check-box catagory_entry" style="margin: 0px 5px 0px 10px ! important;"> {$category.category_name}</label>
                                                {/foreach}
                                            </div>
                                            <div class="span12 padding-set">
                                                <form name="categery_create" id="categery_create" method="post">
                                                    <div style="" class="span8">
                                                        <label for="categery_text" class="span12" style="float: left;">{$translate.add_new_categary}</label>
                                                        <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon icon-plus"></span>
                                                            <input type="text" name="categery_text" id="categery_text" placeholder="{$translate.add_new_categary}" class="form-control span11"> 
                                                        </div>
                                                    </div>
                                                    <div class="span4">
                                                        <button type="button" onclick="addCategory();" style="margin: 25px 0px 0px ! important;" class="btn btn-default span12 btn-margin-set"><i class="icon-plus"></i> {$translate.add}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {else}
                                            
{*                forms listing section*}
                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1>{$translate.forms}</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/forms/{if $selected_survey neq NULL}NULL/{$selected_survey|cat:'/'}{/if}';"  type="button"><i class='icon-plus'></i> {$translate.new_form}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="search_forms">{$translate.search_forms}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="{$translate.search_forms}" id="search_forms" name="search_forms" oninput="displaySearchForms()"  onemptied="displaySearchForms()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="forms_list_wrpr">
                                    {foreach $forms as $form}
                                        <div class="row-fluid single_form_block" id="form_block_{$form.id}">
                                            <div class="span12 quest-block {if $form.id == $form_id}active{/if}" onClick="javascript:location='{$url_path}manage/forms/{$form.id}/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="survey-quation-input-types-form pull-left"></div></div>
                                                    <div class="span10 quest-block-center">
                                                        <p class="form_title_data">{$form.title}</p>
                                                    </div>
                                                    {if $form.status eq 0}
                                                        <div class="span1 pull-right">
                                                            <div class="survey-quation-input-types-lock pull-right"></div>
                                                        </div>
                                                    {/if}
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}