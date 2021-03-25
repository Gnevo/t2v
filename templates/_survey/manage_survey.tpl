{block name="sub_style"}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
       
    </style>
{/block}

{block name="sub_script"}
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.sortable.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".datepicker").datepicker({
        autoclose: true
    });
           
    // survay form functions
    $(".dragdrop-box").sortable({
    //items: "div.ctrloption, div:not(.drop_zone_inner)", 
        items: "div.selected_form_wrpr", 
        cursor: 'move'
    });
    $(".dragdrop-box").disableSelection();
    
    $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    // remove ctrl_option
    $(".ctrlstrip-close").live("click",function(){
        var form_selected = $(this).parents('.selected_form_wrpr').find('.form_title_data').html();
        var hidden_ids = $('#hidden_survey_ids').val();
        var delete_ids = $(this).parents('.selected_form_wrpr').find('input.form_id').val();
        var temp_hidden = hidden_ids.split(',');
        var temp = '';
        for(var i=0;i<temp_hidden.length;i++){
            if(temp_hidden[i] != delete_ids){
                if(temp == '')
                    temp = temp_hidden[i];
                else
                    temp = temp+","+temp_hidden[i];
            }
        }
        $('#hidden_survey_ids').val(temp);
        {foreach $forms_list AS $form}
            if(form_selected == '{$form.title}'){
                $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="{$form.id}" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_{$form.id}" id="check_{$form.id}" type="checkbox" value="{$form.title|escape:'html'}" class="pull-right span1" /><label class="form_title_data">{$form.title}</label></div>\n\
                                                </div>\n\
                                            </div>');
            }
        {/foreach}
        $(this).parents('.selected_form_wrpr').remove();
        $(".dragdrop-box").sortable();
        $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
                function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
        });
    });
    
    $(".dragdrop-box").droppable({
        accept: ".draggable-form",
        activeClass: "active",
        hoverClass: "hover",
        drop: function(event,ui){
            var form = ui.draggable.find(".form_title_data").html();
            var form_id = ui.draggable.find("input.form_id").val();
            var hidden_ids = $('#hidden_survey_ids').val();
            ui.draggable.remove();
            $('.dragdrop-box').append('<div class="span12 no-ml selected_form_wrpr drop-zone mb">\n\
                                                        <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                                        <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                                            <span class="form_title_data">'+ form +'</span>\n\
                                                            <input type="hidden" class="form_id" name="survey_ids[]" id="survey_ids[]" value="'+ form_id +'" />\n\
                                                        </div>\n\
                                                    </div>');
            if(hidden_ids != '')
                $('#hidden_survey_ids').val($('#hidden_survey_ids').val()+","+form_id);
            else
                $('#hidden_survey_ids').val(form_id);
        }
    });
});

function addFormToSurvey(){
    var selected = new Array();
    var selected_id = new Array();
    $('#draggable-forms input:checked').each(function() {
        selected.push($(this).attr('value'));
        selected_id.push($(this).attr('id'));

    });
    for(var i=0;i<selected.length;i++){
        var val = selected_id[i].split("check_");
        $('.dragdrop-box').append('<div class="span12 no-ml selected_form_wrpr drop-zone mb">\n\
                                                        <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                                        <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                                            <span class="form_title_data">'+ selected[i] +'</span>\n\
                                                            <input type="hidden" class="form_id" name="survey_ids[]" id="survey_ids[]" value="'+ val[1] +'" />\n\
                                                        </div>\n\
                                                    </div>');
        $('#'+selected_id[i]).parents('.draggable-form').remove();
    }   
    $(".dragdrop-box").sortable();
}
function saveSurvey(finalise){
    var expiry_date = $("#expire_date").val();
    $("#finalise").val(finalise)
    var selected_forms = new Array();
    $('.dragdrop-box .selected_form_wrpr').each(function() {
        selected_forms.push($(this).find('.form_title_data').html());
    });
    if(selected_forms.length == 0){
        alert("{$translate.no_forms_selected}");
    }
    else if($("#survey_title").val() == "" || $("#survey_title").val() == null){
        alert("{$translate.enter_survey_name}");
    }
    else if(expiry_date == "" || expiry_date == null || expiry_date == "{$translate.expiry_date}"){
        alert("{$translate.select} {$translate.expiry_date}"); 
    }else{
        var current = new Date('{$current_date}');
        var exp_date = new Date(expiry_date);
        if(exp_date < current){
            alert("{$translate.select_expire_date_greater_than_currrent_date}");
        }else{
            $(".dragdrop-box").sortable();
            $('#form_survey').submit();
        }
    }
    
}
function deleteSurvey(){
    $('#action').val('2');
    $('#form_survey').submit();
}
function displayForms(){
    var search_val = $("#search_box_forms").val();
    search_val = search_val.toLowerCase();
    var selected_questions = new Array();
    
    var selected = new Array();
    var selected_id = new Array();
    {foreach $forms_list AS $form}
        selected.push('{$form.title}');
        selected_id.push('{$form.id}');
    {/foreach}
    
    $("#draggable-forms .draggable-form").remove();
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
                    $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" class="pull-right span1" /><label class="form_title_data">'+selected[i]+'</label></div>\n\
                                                </div>\n\
                                            </div>');
                }
            }else{
                $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" class="pull-right span1" /><label class="form_title_data">'+selected[i]+'</label></div>\n\
                                                </div>\n\
                                            </div>');
            }
        }
        
    }
    
    $(".dragdrop-box").sortable();
    $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
                function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
        });
}
function displaySurveys(){
    var search_val = $("#search_surveys").val();
    search_val = search_val.toLowerCase();
    if(search_val.length != 0){
        $("#surveys_list_wrpr .single_survey_block").addClass('hide');
        $('#surveys_list_wrpr .single_survey_block').each(function( index ) {
            var temp_search = $(this).find('.survey_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(temp_search))
                $(this).removeClass('hide');
        });
    }else
        $("#surveys_list_wrpr .single_survey_block").removeClass('hide');
    
}
</script> 
{/block}
{block name="survey_manage_inner_content"}
    <div id="tab3-2" class="tab-pane active">
        <div class="row-fluid">
            <div class="span12 widget-body-section input-group" id="tab-working-panel">
{*                survey create/edit section*}
                {if $display_page neq 'list'}
                    <div class="span12">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1>{$translate.forms}</h1>
                                    </div>
                                    <div class="pull-right" style="padding: 5px;">
                                        <button class="btn btn-info pull-right" onclick="addFormToSurvey();" type="button"><i class="icon-plus"></i> {$translate.add_to_survey}</button>
                                    </div>
                                </div>
                                <div class="span12 padding-set" id="forms_section">
                                    <div class="span12">
                                        <label style="float: left;" class="span12" for="search_box_forms">{$translate.search_forms}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_forms}" id="search_box_forms" type="text"  oninput="displayForms()"  onemptied="displayForms()" /> 
                                        </div>
                                        <div tabindex="0" id="draggable-forms" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;">
                                            {foreach $forms as $form}
                                                <div class="span12 answer-tool draggable-form">
                                                    <input name="form_id" class="form_id" type="hidden" value="{$form.id}" />
                                                    <div class="span12 answer-tool-right no-ml">
                                                        <div class="span2"><div class="survey-quation-input-types-form"></div></div>
                                                        <div class="span10 edit-form-label"><input name="check_{$form.id}" id="check_{$form.id}" type="checkbox" value="{$form.title|escape:'html'}" class="pull-right span1" /><label class="form_title_data">{$form.title}</label></div>
                                                    </div>
                                                </div>
                                            {/foreach}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/surveys/';"  type="button"><i class='icon-plus'></i> {$translate.new_survey}</button>
                                        {if $status != 0}
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveSurvey(1)" type="button"><i class='icon-save'></i> {$translate.save}</button>
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveSurvey(0)" type="button"><i class='icon-save'></i> {$translate.save_finalaise}</button>
                                        {/if}
                                        {if $survey_id != ""}<button class="btn btn-default btn-normal pull-right" onClick="deleteSurvey()" type="button"><i class='icon-trash'></i> {$translate.delete}</button>{/if}
                                        {if $status == 0}<button class="btn btn-default btn-normal pull-right" onClick="javascript:location='{$url_path}manage/surveys/{$survey_id}/new_version/';" type="button"><i class='icon-copy'></i> {$translate.new_version}</button>{/if}
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">

                                    <div class="widget" style="margin-top:0;">
                                        <form name="form_survey" id="form_survey" method="post" action="{$url_path}manage/surveys/{$survey_id}/{if $version == '1'}new_version/{/if}">
                                            <input type="hidden" id="action" name="action" value="{$action}"/>
                                            <input type="hidden" id="finalise" name="finalise" value=""/>
                                            <input type="hidden" id="survey_id" name="survey_id" value="{$survey_id}"/>
                                            <input type="hidden" id="forms_selected" name="forms_selected"/>
                                            <input type="hidden" id="forms_order" name="forms_order"/>
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="survey_title">{$translate.survey_name}</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" placeholder="{$translate.survey_name}" id="survey_title" name="survey_title" type="text" value="{$selected_survey.survey_title}" /> 
                                                    </div>
                                                </div>

                                                <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                    <label style="float: left;" class="span12" for="survey_discription">{$translate.description}</label>
                                                    <textarea id="survey_discription" name="survey_discription" style="margin: 0px;" class="form-control span12" rows="1" placeholder="{$translate.description}">{$selected_survey.description}</textarea>
                                                </div>

                                                <div style="margin: 5px 0px 0px ! important;" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="expire_date">{$translate.expiry_date}</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12 datepicker"> 
                                                        <span class="add-on icon icon-calendar"></span>
                                                        <input class="form-control span10" placeholder="{$translate.expiry_date}" name="expire_date" id="expire_date" type="text" value="{if $selected_survey.expire_date neq ''}{$selected_survey.expire_date}{/if}" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_forms}</div>
                                                <div class="span12 dragdrop-box no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    <input type="hidden" name="hidden_survey_ids" id="hidden_survey_ids" value="{$hidden_form_ids}"/>
                                                    {foreach $survey_forms AS $form}
                                                        <div class="span12 no-ml selected_form_wrpr drop-zone mb">
                                                            <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>
                                                            <div class="span11 no-min-height text-left" style="margin:0;">
                                                                <span class="form_title_data">{$form.title}</span>
                                                                <span class="label label-info pull-right cursor_hand" onClick="javascript:location='{$url_path}manage/forms/{$form.form_id}/{$survey_id}/';">{$translate.go_to_form}</span>
                                                                <input type='hidden' class="form_id" name='survey_ids[]' id='survey_ids[]' value='{$form.form_id}' />
                                                            </div>
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {else}
                                            
{*                surveys listing section*}
                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1>{$translate.surveys}</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button type="button" onclick="javascript:location='{$url_path}manage/surveys/';" class="btn btn-default btn-normal pull-right ml"><i class="icon-plus"></i> {$translate.new_survey}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="search_surveys">{$translate.search_surveys}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="{$translate.search_surveys}" id="search_surveys" name="search_surveys" oninput="displaySurveys()"  onemptied="displaySurveys()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="surveys_list_wrpr">
                                    {foreach $surveys as $survey}
                                        <div class="row-fluid single_survey_block" id="survey_block_{$survey.id}">
                                            <div class="span12 quest-block {if $survey.id == $survey_id}active{/if}" onClick="javascript:location='{$url_path}manage/surveys/{$survey.id}/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="survey-quation-input-types-manageform pull-left"></div></div>
                                                    <div class="span10 quest-block-center">
                                                        <p class="survey_title_data">{$survey.survey_title}</p>
                                                    </div>
                                                    {if $survey.status eq 0}
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