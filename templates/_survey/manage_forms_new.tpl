{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
    .scroll-pane,  .scroll-pane-arrows {
            width: 100%;
            height: 200px;
            overflow: auto;
    }
    .horizontal-only {
            height: auto;
            max-height: 200px;
    }
    .answer-hold-attrib {
            width: 95%; 
            height: 274px;
    }
</style>
{/block}

{block name="script"}
<script type="text/javascript">
$(document).ready(function() {
    $("#title").click(function(){
        var form_name = $("#title").val();
        if(form_name == 'Enter Form Name'){
            $("#title").val("");
        }
    });
    $("#title").blur(function(){
        var form_name = $("#title").val();
        if(form_name == ''){
            $("#title").val("Enter Form Name");
        }
    });
    
     $("#form_discription").click(function(){
        var form_name = $("#form_discription").val();
        if(form_name == 'Give Description'){
            $("#form_discription").val("");
        }
    });
    $("#form_discription").blur(function(){
        var form_name = $("#form_discription").val();
        if(form_name == ''){
            $("#form_discription").val("Give Description");
        }
    });
    
    
    $(".drop_zone").sortable();
    $('.manage_forms, #tools_rack, .answer_hold ,#categories_box').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane({
            showArrows: true,
            horizontalGutter: 10
    });

    $(".search_icon").click(function(){
            $(this).parent().parent().find(".searchclose_section").show();
            $(this).parent().parent().find('.search_click').hide();
            $(this).parent().parent().find("input").focus();
     });
		 
    $(".search_close").click(function(){
           $(this).parent().parent().find(".search_click").show();
           $(this).parent().parent().find('.searchclose_section').hide();
           if($(this).parent().find("input").attr('id') == 'search_box_question'){
                $(this).parent().children("#search_box_question").val('');
                displayQuestions();
            }
            if($(this).parent().find("input").attr('id') == 'search_forms'){
                $(this).parent().children("#search_forms").val('');
                displaySearchForms();
            }
           
    });
});

function reinitScroll(){
    var settings = {
                showArrows: true
    };
    var pane = $('.answer_hold');
    pane.jScrollPane(settings);
    var api = pane.data('jsp');
    api.reinitialise();
    $(".drop_zone").sortable();
}
function reinitScrollQuest(){
    
    var settings1 = {
                showArrows: true
    };
    var pane1 = $('#tools_rack');
    pane1.jScrollPane(settings1);
    var api1 = pane1.data('jsp');
    api1.reinitialise();
    $(".drop_zone").sortable();
}

function reinitScrollForms(){
    
    var settings2 = {
                showArrows: true
    };
    var pane2 = $('.manage_forms');
    pane2.jScrollPane(settings2);
    var api2 = pane2.data('jsp');
    api2.reinitialise();
    $(".drop_zone").sortable();
}
// survay form functions
$(".tool").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
$("#page_breaker").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
$(".drop_zone").droppable({
        accept: ".tool",
        activeClass: "active",
        hoverClass: "hover",
        drop: function(event,ui){
                var question = ui.draggable.find("a").html();
                var question_id = ui.draggable.find("p").html();
                ui.draggable.remove();
                $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'><div class='ctrlstrip-close'></div><div class='ctrl-option-inner'><div class='ctrl-strip clearfix'>"+ question +"</div><input type='hidden' name='quest_ids[]' value='"+question_id+"' id='quest_id[]' /></div><div class='questian_toolboxsettings clearfix'></div></div>");
                reinitScroll();
                reinitScrollQuest();
                $(".ctrloption").droppable({
                        accept: "#page_breaker",
                        hoverClass: "hover",
                        drop: function(event,ui){
                                $(this).after('<div class="line_break clearfix"><div class="ctrlstrip-close"><input type="hidden" name="quest_ids[]" value="null" id="quest_id[]" /></div></div>');

                        }
                });
        }
});

$(".ctrloption").droppable({
        accept: "#page_breaker",
        hoverClass: "hover",
        drop: function(event,ui){
                $(this).after('<div class="line_break clearfix"><div class="ctrlstrip-close"><input type="hidden" name="quest_ids[]" value="null" id="quest_id[]" /></div></div>');
               
        }
});
	
// remove ctrl_option
$(".ctrlstrip-close").live("click",function(){
        var quest = $(this).parent().children('.ctrl-option-inner').children().html();
        $(this).parent().remove();
        {foreach $questions_list AS $question}
            if(quest == '{htmlspecialchars($question.question)}'){
                $("#tools_rack .jspPane").append('<div class="formquest_block tool clearfix"><input id="check_{$question.id}" type="checkbox" value="{htmlspecialchars($question.question)}" name="check_{$question.id}"><span><img src="{$url_path}images/questains.png" width="7" height="13"></span><a href="javascript:void(0)">{htmlspecialchars($question.question)}</a><p style="display:none;">{$question.id}</p></div>');
            }
        {/foreach}
        $(".tool").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
        $(".drop_zone").droppable({
                accept: ".tool",
                activeClass: "active",
                hoverClass: "hover",
                drop: function(event,ui){
                        var question = ui.draggable.find("a").html();
                		var question_id = ui.draggable.find("p").html();
                        ui.draggable.remove();
                        $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'><div class='ctrlstrip-close'></div><div class='ctrl-option-inner'><div class='ctrl-strip clearfix'>"+ question +"</div><input type='hidden' name='quest_ids[]' value='"+question_id+"' id='quest_id[]' /></div><div class='questian_toolboxsettings clearfix'></div></div>");
                        $('.scroll-pane-arrows').jScrollPane({
                            showArrows: true,
                            horizontalGutter: 10
                        });
                        reinitScroll();
                        reinitScrollQuest();
                }
        });
        reinitScroll();
        reinitScrollQuest();
        
});

function addToForm(){
    var selected = new Array();
    var selected_id = new Array();
    $('#tools_rack input:checked').each(function() {
        selected.push($(this).attr('value'));
        selected_id.push($(this).attr('id'));
        
    });
    for(var i=0;i<selected.length;i++){
        var val = selected_id[i].split("check_");
        $('.drop_zone').children(".drop_zone_inner").before("<div class='ctrloption clearfix'><div class='ctrlstrip-close'></div><div class='ctrl-option-inner'><div class='ctrl-strip clearfix'>"+ selected[i] +"</div><input type='hidden' name='quest_ids[]' value='"+val[1]+"' id='quest_id[]' /></div><div class='questian_toolboxsettings clearfix'></div></div>");
        $('#'+selected_id[i]).parent().remove();
        reinitScrollQuest();
        reinitScroll();
    }
    $(".ctrloption").droppable({
            accept: "#page_breaker",
            hoverClass: "hover",
            drop: function(event,ui){
                    $(this).after('<div class="line_break clearfix"><div class="ctrlstrip-close"><input type="hidden" name="quest_ids[]" value="null" id="quest_id[]" /></div></div>');

            }
    });
}
function saveFormSurvey(){
    
    var selected_questions = new Array();
    $('.drop_zone .ctrloption').each(function() {
    	selected_questions.push($(this).children('.ctrl-option-inner').find("input").attr('value'));
    });
    
    if(selected_questions.length == 0){
        alert("No questions selected");
    } else if($("#title").val() == "" || $("#title").val() == "Enter Form Name"){
        alert("Enter the form name");
    }else{
		$('#form_create').submit();
    }
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
    {foreach $questions_list AS $question}
        selected.push('{htmlspecialchars($question.question)}');
        selected_id.push('{$question.id}');
    {/foreach}
    $('.drop_zone .ctrloption').each(function() {
    	selected_questions.push($(this).children('.ctrl-option-inner').find("input").attr('value'));
    });
    $("#tools_rack .jspContainer .jspPane .formquest_block").remove();
    for(var i=0;i<selected.length;i++){
        var temp_search = selected[i];
        for(var j=0;j<selected_questions.length;j++){
            if(selected_questions[j] == selected_id[i]){
                break;
            }
        }
        if(j == selected_questions.length){
            if(search_val.length != 0){
                var x = temp_search.substring(0, search_val.length)
                    x=x.toLowerCase();
                if(x == search_val){
                    $("#tools_rack .jspPane").append('<div class="formquest_block tool clearfix"><input id="check_{$question.id}" type="checkbox" value="'+selected[i]+'" name="check_'+selected_id[i]+'"><span><img src="{$url_path}images/questains.png" width="7" height="13"></span><a href="javascript:void(0)">'+selected[i]+'</a><p style="display:none;">'+selected_id[i]+'</p></div>');
                }
            }else{
                 $("#tools_rack .jspPane").append('<div class="formquest_block tool clearfix"><input id="check_{$question.id}" type="checkbox" value="'+selected[i]+'" name="check_'+selected_id[i]+'"><span><img src="{$url_path}images/questains.png" width="7" height="13"></span><a href="javascript:void(0)">'+selected[i]+'</a><p style="display:none;">'+selected_id[i]+'</p></div>');
            }
        }
        
    }
    reinitScrollQuest();
    $(".tool").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
    $("#page_breaker").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
    $(".drop_zone").droppable({
            accept: ".tool",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                    var question = ui.draggable.find("a").html();
                    var question_id = ui.draggable.find("p").html();
                    ui.draggable.remove();
                    $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'><div class='ctrlstrip-close'></div><div class='ctrl-option-inner'><div class='ctrl-strip clearfix'>"+ question +"</div><input type='hidden' name='quest_ids[]' value='"+question_id+"' id='quest_id[]' /></div><div class='questian_toolboxsettings clearfix'></div></div>");
                    reinitScroll();
                    reinitScrollQuest();
            }
    });

}

function displaySearchForms(){
    var search_val = $("#search_forms").val();
    search_val = search_val.toLowerCase();
    var selected = new Array();
    var selected_id = new Array();
    {foreach $forms as $form}
        selected.push('{$form.title}');
        selected_id.push('{$form.id}');
    {/foreach}
        $(".manage_forms").height(0);
        $(".manage_forms").height("auto");
    $(".manage_forms .jspContainer .jspPane .manageform_block").remove();
    for(var i=0;i<selected.length;i++){
        var temp_search = selected[i];
        if(search_val.length != 0){
            var x = temp_search.substring(0, search_val.length)
                x=x.toLowerCase();
            if(x == search_val){
                $(".manage_forms .jspContainer .jspPane").append('<div class="manageform_block clearfix"><span><img src="{$url_path}images/manageform_icon.jpg" width="17" height="16"></span><a href="{$url_path}S_manage_forms.php?'+selected_id[i]+'">'+selected[i]+'</a></div>');
            }else{
                continue;
            }   
        }else{
             $(".manage_forms .jspContainer .jspPane").append('<div class="manageform_block clearfix"><span><img src="{$url_path}images/manageform_icon.jpg" width="17" height="16"></span><a href="{$url_path}S_manage_forms.php?'+selected_id[i]+'">'+selected[i]+'</a></div>');
        }
    }
    reinitScrollForms();
    $(".tool").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
    $("#page_breaker").draggable({ revert: true, appendTo: "#toolbox", helper: 'clone' });
    $(".drop_zone").droppable({
            accept: ".tool",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                    var question = ui.draggable.find("a").html();
                    var question_id = ui.draggable.find("p").html();
                    ui.draggable.remove();
                    $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'><div class='ctrlstrip-close'></div><div class='ctrl-option-inner'><div class='ctrl-strip clearfix'>"+ question +"</div><input type='hidden' name='quest_ids[]' value='"+question_id+"' id='quest_id[]' /></div><div class='questian_toolboxsettings clearfix'></div></div>");
                    reinitScroll();
                    reinitScrollQuest();
            }
    });

    
}
</script>
{/block}

{block name="content"}
    <div style="display:none;" title="Bekräfta" id="dialog-confirm">
        <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span>Ska uppgifterna sparas?</p>
    </div>
    <div style="display:none;" id="dialog_popup" class="clearfix"></div>
    <div style="display:none;" id="dialog_hidden" class="clearfix"></div>
    <div id="menu">
        <ul>
            <li><a href="{$url_path}manage/questions/">Manage Questions</a></li>
            <li class="active"><a href="javascript:void(0)">Manage Forms</a></li>
            <li><a href="{$url_path}S_manage_survey.php">Manage Surveys</a></li>
            <li><a href="{$url_path}manage/groups/">Manage Groups</a></li>
            <li><a href="{$url_path}manage/invitations/">Invitations</a></li>
        </ul>
    </div>

    <div id="main_tab" class="clearfix"> 
        <div id="tab_menu">
            <div class="managequestions_row">
                <div class="questions" style="max-height: 595px">
                    <div class="menubar_title clearfix">

                        <div class="search_click">
                            <div class="menu_title">Form Creations</div>
                            <a class="search_icon"><span class="icon"></span></a>
                        </div>
                        <div class="searchclose_section">
                             
                            <input class="serchbox" id="search_forms" type="text" data-key-placeholder="placeholder_search" placeholder="Search..." oninput="displaySearchForms()" onemptied="displaySearchForms()">
                            <a class="search_close"><span class="icon"></span></a>
                            
                        </div>
                    </div>
                    <div class="manage_forms">
                    	{foreach $forms as $form}
{*                          <div class="manageform_block clearfix">*}
                            <div class="manageform_block clearfix {if $form.id == $form_id}active{/if}">
                                <span><img src="{$url_path}images/manageform_icon.jpg" width="17" height="16"></span>
                                <a href="{$url_path}S_manage_forms.php?{$form.id}">{$form.title}</a>
                            </div>
                        {foreachelse}
                            No available forms
                        {/foreach}
                    </div>
                </div>
            </div>
            <div class="managequestions_row">
                <div class="creatquestion_box" style="height: 595px;"><div class="answermenubar_title"></div>
                    <div class="scrol">
                        <form name="form_create" id="form_create" method="post" action="{$url_path}S_manage_forms.php?{$form_id}">
                        <div class="question_hold">
                            
                            <input type="hidden" id="action" name="action" value="{$action}"/>
                            <input type="hidden" id="form_id" name="form_id" value="{$form_id}"/>
                            <input type="hidden" id="questions_selected" name="questions_selected"/>
                            <input type="hidden" id="questions_order" name="questions_order"/>
                            <input id="title" name="title" type="text" class="quest_textbox" {if $selected_form.title != ""}value="{$selected_form.title}" {else} value="Enter Form Name"{/if} style="margin-bottom: 4px;">
                            <textarea  class="quest_textbox" id="form_discription" name="form_discription" style=" height: 40px; resize: none">{if $selected_form.description != ""}{$selected_form.description}{else}Give Description{/if}</textarea>
                            
                        </div>

                        <div class="answer_hold answer-hold-attrib">
                            <div class="drop_zone">
                            	{foreach $form_questions AS $question}
                                    {if $question.question_id == "null"}
                                       <div class="line_break clearfix">
                                           <div class="ctrlstrip-close"><input type="hidden" name="quest_ids[]" value="null" id="quest_id[]" />
                                           </div>
                                       </div> 
                                     {else}
                                <div class="ctrloption clearfix">
                                	<div class="ctrlstrip-close"></div>
                                    <div class="ctrl-option-inner">
                                    	<div class="ctrl-strip clearfix">{$question.question}</div>
                                        <input type="hidden" name="quest_ids[]" value="{$question.question_id}" id="quest_id[]" />
                                    	<!--<div class="ctrl-questions_selected clearfix" style="visibility:hidden;">{$question.question_id}</div>-->
                                    </div>
                                    <div class="questian_toolboxsettings clearfix"></div>
                                </div>
                                  {/if}
                                {/foreach}
                                <div class="drop_zone_inner" id="dropper_place">"Content for  class "drag_dropbox" Goes Here</div>
                            </div>
                        </div>
                        </form>        
                    </div>
                    <div class="catagery"  style="height: 104px;">
                        <div id="categories_box" style="height: 80px;">
                        <ul>
                            {foreach $categories as $category}
                                <li> <label><input name="input" type="checkbox" value="{$category.id}">{$category.category_name}</label></li>
                            {/foreach} 
                        </ul>
                            </div>
                            <div style="bottom: 0px;margin-bottom: 5px;">
                            <form name="categery_create" id="categery_create" method="post" action="{$url_path}S_manage_forms.php?{$form_id}"> <input name="categery_text" class="catagery_name clearfix" type="text"> <input name="categery_add" value="Add New Category" class="catagery_btn" type="submit"></form>
                    
                        </div>
                    </div>
                    <div class="settings_box clearfix">
                        <a class="save" href="javascript:void(0)" onClick="saveFormSurvey()"><span class="btn_name">Save</span></a>
                       {if $form_id != ""} <a class="delet" href="javascript:void(0)" onClick="deleteFormSurvey()"><span class="btn_name">Delete</span></a>{/if}
                        <a class="add new" href="{$url_path}S_manage_forms.php"><span class="btn_name">{$translate.new_form}</span></a>
                    </div>
                </div>
            </div>

            <div class="managequestions_row">
                <div id="toolbox" style="height: 595px;">
                    <div class="menubar_title clearfix">
                        <div class="search_click">
                            <div class="menu_title">Questions</div>
                            <a class="search_icon"><span class="icon"></span></a>
                        </div>
                        <div class="searchclose_section">
                            <input class="serchboxrgt" id="search_box_question" type="text" data-key-placeholder="placeholder_search" placeholder="Search..." oninput="displayQuestions()"  onemptied="displayQuestions()">
                            <a class="search_close"><span class="icon"></span></a>
                        </div>
                    </div>
                  <!-- <div id="tool_rack_inner" style="height:392px">-->
                  <div id="tools_rack" style="height: 537px;">
                        
                            {foreach $questions AS $question}
                            <div class="formquest_block tool clearfix">
                                <input name="check_{$question.id}" id="check_{$question.id}"  type="checkbox" value="{$question.question}"><span><img src="{$url_path}images/questains.png" width="7" height="13"></span>
                                <a href="javascript:void(0)">{$question.question}</a>
                                <p style="display: none;">{$question.id}</p>
                            </div>
                            {foreachelse}
                                No available questions
                            {/foreach}

                       <!-- </div>-->
                    </div>
                    <div class="pagesettings clearfix">
                        <a class="addto_form" href="javascript:void(0)" onClick="addToForm()"><span class="btn_name">{$translate.add_to_form}</span></a>
                        <a class="form_delet" href="javascript:void(0)" onClick="saveForm()"><span class="btn_name"></span></a>
                        <a class="page_break" id="page_breaker" href="javascript:void(0)" onClick="saveForm()"><span class="btn_name"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}