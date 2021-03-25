{block name="style"}
    <link href="{$url_path}css/survey.css" rel="stylesheet" type="text/css" />
    <link href="{$url_path}css/star-rating/starrr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{*    <link href="{$url_path}css/star-rating/font-awesome.min.css" rel="stylesheet">*}
{/block}
{block name="script"}
    <script src="{$url_path}js/star-rating/starrr.min.js"></script>
    <script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".datepicker").datepicker({
        autoclose: true
    });

    var persentage_complete = '{$percentage_complete}';
    $(".currentpercentage").css("width",persentage_complete+"%");
    $(".hindbutton").click(function(){
        $(".surveyview_selectquestions").show();
        $(".surveyview_selectquestions").hide();
        var hint_toggle = $(this).parent().parent().children(".surveyview_selectquestions").children('.hint_val').val();
        if(hint_toggle == 1){
            $(this).parent().parent().children(".surveyview_selectquestions").hide();
            $(this).parent().parent().children(".surveyview_selectquestions").children('.hint_val').val('');
        }else{
            $(this).parent().parent().children(".surveyview_selectquestions").show();
            $(this).parent().parent().children(".surveyview_selectquestions").children('.hint_val').val('1');
        }
    }); 
        
    $(".customerview_serveylist").click(function() {
        $(".customerviewserva_listeddetails").slideUp("slow");
        $(this).parent().children(".customerviewserva_listeddetails").slideToggle("slow");
    });
        
    $(".datepick").datepicker({
        showOn: "button",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
});

function saveForm(){
    $("#survey_question_form").submit();
}

function checkboxVal(value,ids){
//ar check = $(this).parent().children('.answer_text').val();
    if($(ids).attr("checked")){
        $(ids).siblings('.answer_text').val(value);
    }else{
        $(ids).siblings('.answer_text').val('');
    }
}

function MatrixView(ids,value){
    $("#answer_text_"+ids).val(value);
}

function datePick(ids){
    $("#datefrom_"+ids).datepicker({
        showOn: "button",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
}

function makerate(this_obj, qid, star_num, star_count, low_limit, up_limit){
    star_num = parseInt(star_num);
    star_count = parseInt(star_count);
    low_limit = parseInt(low_limit);
    up_limit = parseInt(up_limit);
    var x = parseInt(star_num)  + 1;
    var rate = '';
    var star_rate = '';
    if(star_num == 1){
        star_rate = low_limit;
    }else if(star_num == star_count){
        star_rate = up_limit;
    }else{
        rate = parseFloat((up_limit-low_limit)/(star_count-1));
        star_rate = parseFloat(low_limit + (rate * (star_num-1)));
    }
    $(this_obj).parents('.question_group').find('.answer_text').val(star_rate) ;
    
}
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget no-ml">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$survey_details[0].survey_title}</h1>
                    </div>
                    {if $no_page == 1}
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button onclick="javascript:location='{$url_path}user/survey/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                        </div>
                    {/if}
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div style="" class="span12 widget-body-section input-group">
                    {if $no_page neq 1}
                        <div class="row-fluid">
                            <div class="span11">
                                <div style="margin: 0px;" class="widget-head progress progress-primary attend-survey-progressbar-loader" id="bar">
                                    <div class="bar attend-survey-progressbar" style="width: {$percentage_complete}%;"><strong class="step-current">{$percentage_complete}%</strong></div>
                                </div>
                            </div>
                            <div class="span1">
                                <button onclick="saveForm();" class="btn btn-danger btn-normal pull-right span12" type="button">{$translate.next}</button>
                            </div>
                        </div>
                    {/if}
                    <div class="row-fluid"><div class="widget-body"></div></div>
                </div>
                    
                <div class="span12 widget-body-section input-group survey-attend-quastions-wrpr">
                    {if $no_page neq 1}
                        <div class="row-fluid">
                            <form name="survey_question_form" id="survey_question_form" method="post" enctype="multipart/form-data">
                                <div class="span12">
                                    <div class="widget-body">
                                        <div class="letter">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <h2 class="form-header"><div class="survey-quation-input-types-form pull-left"></div>&nbsp;{$questions_forms.form}</h2>
                                                </div>
                                            </div>
{*                                            <div class="ribbon-wrapper small"><div class="ribbon success">{$translate.survey}</div></div>*}
                                            <input type="hidden" name="page_num" id="page_num" value="{$page_num}" />
                                            <input type="hidden" name="form_id" id="form_id" value="{$form_id}" />
                                            {assign q_number 0}
                                            {foreach $questions_forms.questions AS $quest}
                                                {assign q_number $q_number+1}
                                                <div class="row-fluid">
                                                    <div class="span12 quastions-wrpr">
                                                        <h5 class="strong separator bottom">{$q_number}. {$quest.question}{if $quest.answer_hint neq ''}<i data-title="{$quest.answer_hint|escape:'html'}" class="icon-info-sign ml" data-toggle="tooltip" data-placement="bottom" data-original-title="" title=""></i>{/if}</h5>
                                                        <input type="hidden" name="hint_val" value="" class="hint_val" />
{*                                                        radio type*}
                                                        {if $quest.answer_type eq 1}
                                                            {if $quest.display_style eq 1} {*horizontal display style*}
                                                                <div class="row-fluid question_group">
                                                                    <div class="span12" style="margin: 0px;">
                                                                        <ol class="radio-group">
                                                                            {foreach $quest.answers AS $answer}
                                                                                <li>
                                                                                    <input name="radio_{$quest.q_id}" id="radio_{$quest.q_id}_{$answer.answer_id}" value="{$answer.answer_id}" onclick="$(this).parents('.question_group').find('input.answer_text').val($(this).val());" type="radio" />
                                                                                    <label class="label-option-and-checkbox" for="radio_{$quest.q_id}_{$answer.answer_id}">{$answer.answer_text}  </label>
                                                                                </li>
                                                                            {/foreach}
                                                                        </ol>
                                                                    </div>
                                                                    <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                    <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="span12" style="margin: 10px 0px 0px;">
                                                                        <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                        <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                    </div>
                                                                </div>
                                                            {else if $quest.display_style eq 2} {*vertical display style*}
                                                                <div class="row-fluid question_group">
                                                                    <div style="margin: 0px;" class="span12">
                                                                        <ol class="vertical-input-list">
                                                                            {foreach $quest.answers AS $answer}
                                                                                <li>
                                                                                    <input name="radio_{$quest.q_id}" value="{$answer.answer_id}" type="radio" class="vertical-radio-and-checkbox" onclick="$(this).parents('.question_group').find('input.answer_text').val($(this).val());" id="radio_{$quest.q_id}_{$answer.answer_id}"/>
                                                                                    <label class="" for="radio_{$quest.q_id}_{$answer.answer_id}">{$answer.answer_text}  </label>
                                                                                </li>
                                                                            {/foreach}
                                                                        </ol>
                                                                    </div>
                                                                    <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                    <input type="hidden" name="answer[]" value="" class="answer_text"/>  
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="span12" style="margin: 10px 0px 0px;">
                                                                        <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                        <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        
{*                                                        check box type*}
                                                        {elseif $quest.answer_type eq 2}
                                                            {if $quest.display_style eq 1} {*horizontal display style*}
                                                                <div class="row-fluid question_group">
                                                                    <div class="span12" style="margin: 0px;">
                                                                        <ol class="radio-group">
                                                                            {foreach $quest.answers AS $answer}
                                                                                <li class="answer_block_group">
                                                                                    <input name="checkbox[]" id="checkbox_{$quest.q_id}_{$answer.answer_id}" value="{$answer.answer_id}" onclick="$(this).parents('li.answer_block_group').find('input.answer_text').val($(this).val());" type="checkbox" />
                                                                                    <label class="label-option-and-checkbox" for="checkbox_{$quest.q_id}_{$answer.answer_id}">{$answer.answer_text}  </label>
                                                                                    <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                                    <input type="hidden" name="textarea[]" value="{$quest.q_id}" />
                                                                                    <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                                                </li>
                                                                            {/foreach}
                                                                        </ol>
                                                                    </div>
                                                                </div>
                                                            {else if $quest.display_style eq 2} {*vertical display style*}
                                                                <div class="row-fluid question_group">
                                                                    <div style="margin: 0px;" class="span12">
                                                                        <ol class="vertical-input-list">
                                                                            {foreach $quest.answers AS $answer}
                                                                                <li class="answer_block_group">
                                                                                    <input name="checkbox[]" id="checkbox_{$quest.q_id}_{$answer.answer_id}" value="{$answer.answer_id}" type="checkbox" class="vertical-radio-and-checkbox" onclick="$(this).parents('li.answer_block_group').find('input.answer_text').val($(this).val());"/>
                                                                                    <label for="checkbox_{$quest.q_id}_{$answer.answer_id}">{$answer.answer_text}  </label>
                                                                                    <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                                    <input type="hidden" name="textarea[]" value="{$quest.q_id}" />
                                                                                    <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                                                </li>
                                                                            {/foreach}
                                                                        </ol>
                                                                    </div> 
                                                                </div>
                                                            {/if}
                                                        
{*                                                        combobox type*}
                                                        {elseif $quest.answer_type eq 3}
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px ! important;" class="span12">
                                                                    <div class="input-prepend" style="margin-left: 0px; float: left;">
                                                                        <span class="add-on icon-pencil"></span>
                                                                        <select onclick="$(this).parents('.question_group').find('input.answer_text').val($(this).val());" class="form-control span12">
                                                                            {foreach $quest.answers AS $answer}
                                                                                <option value="{$answer.answer_id}">{$answer.answer_text}</option>
                                                                            {/foreach}
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                                
{*                                                        textbox type*}
                                                        {elseif $quest.answer_type eq 4} 
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px;" class="span12">
                                                                    <div style="margin: 0px;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                        <input type="text" name="answer[]" id="textfield" value="" class="form-control span12"/> 
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                                
{*                                                        textarea type*}
                                                        {elseif $quest.answer_type eq 5} 
                                                            <div class="row-fluid question_group">
                                                                <div class="span12">
                                                                    <textarea name="answer[]" class="form-control span12" rows="2"></textarea>
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                        
{*                                                        star rating*}
                                                        {elseif $quest.answer_type eq 6}
                                                            {assign var=ans value="||"|explode:$quest.answers[0].answer_text}
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px;" class="span12">
                                                                    <div style="margin-left:-5px" class="acidjs-rating-stars">
                                                                        {for $loop=$ans[2] to 1 step=-1}
                                                                            <input type="radio" value="1" id="star_{$quest.q_id}_{$loop}" name="group-star-{$quest.q_id}"><label for="star_{$quest.q_id}_{$loop}" onclick="makerate(this, '{$quest.q_id}','{$loop}','{$ans[2]}','{$ans[0]}','{$ans[1]}');"></label>
                                                                        {/for}
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                               
{*                                                        custom rating*}
                                                        {elseif $quest.answer_type eq 7}
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px;" class="span12">
                                                                    <div class="control-group pull-left no-padding">
                                                                        <div style="margin: 0px;" class="input-prepend"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input name="answer[]" id="custome_rate_{$quest.q_id}" onblur="$(this).parents('.control-group').removeClass('error');if($.isNumeric($(this).val()) ){ if($(this).val() < 1 || $(this).val() > parseInt('{$quest.answers[0].answer_text}')){ $(this).parents('.control-group').addClass('error');alert('{$translate.enter_value_between_the_limits}'); $(this).val('');   } } else{ alert('{$translate.enter_numeric_value}'); $(this).val(''); $(this).parents('.control-group').addClass('error')}" class="form-control" type="text" />
                                                                            <span class="add-on" style="border-radius: 0px 5px 5px 0px;">/ {$quest.answers[0].answer_text}</span> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                               
{*                                                        datepicker*}
                                                        {elseif $quest.answer_type eq 8} 
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px;" class="span12">
                                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker"> 
                                                                        <span class="add-on icon-calendar"></span>
                                                                        <input name="answer[]" id="datefrom_{$quest.q_id}" class="form-control" type="text" />
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                                
{*                                                        file upload*}
                                                        {elseif $quest.answer_type eq 9}
                                                            <div class="row-fluid question_group">
                                                                <div style="margin: 0px;" class="span12">
                                                                    <input name="attachments[{$quest.q_id}]" type="file" onchange="$(this).parents('.question_group').find('.answer_text').val($(this).val())">
                                                                </div>
                                                                <input type="hidden" name="quest[]" value="{$quest.q_id}" />
                                                                <input type="hidden" name="answer[]" value="" class="answer_text"/>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin: 10px 0px 0px;">
                                                                    <label style="float: left;" class="span12">{$translate.type_comment}</label>
                                                                    <textarea name="textarea[]" class="form-control span12" rows="1" placeholder="{$translate.type_comment}..."></textarea>
                                                                </div>
                                                            </div>
                                                                
{*                                                        Likert metrix*}
                                                        {elseif $quest.answer_type eq 10}
                                                            {if $quest.display_style eq 1}{*horizontal*}
                                                                    <div class="row-fluid">
                                                                        <div class="table-responsive">
                                                                            <table style="top: 0px; margin: 0px; border-top: thin solid rgb(204, 204, 204);" class="table table-bordered table-condensed table-hover table-responsive swipe-horizontal table-primary t">
                                                                                <tbody style="">
                                                                                    <tr class="gradeX" style="">
                                                                                        <td>&nbsp;</td>
                                                                                        {foreach $quest.answers AS $answer}
                                                                                            <td class="center">{$answer.answer_text}</td>
                                                                                        {/foreach}
                                                                                    </tr>
                                                                                    {assign k 0}
                                                                                    {foreach $quest.child_quest AS $child_quest}
                                                                                        {assign cycle_class {cycle values="td-gray,"}}
                                                                                        <input type="hidden" name="quest[]" value="{$child_quest.q_id_forchild}" />
                                                                                        <input type="hidden" name="answer[]" value="" class="answer_text" id="answer_text_{$child_quest.q_id_forchild}"/>
                                                                                        <input type="hidden" name="textarea[]" value="" class="textarea" />
                                                                                        <tr class="gradeX">
                                                                                            <td>{$child_quest.question}</td>
                                                                                            {for $i=1 to $quest.answers|@count}
                                                                                                <td class="center {$cycle_class}"><input name="radio_{$k}" id="radio_{$k}" value="{$quest.answers[$i-1].answer_id}" onclick="MatrixView('{$quest.child_quest[{$k}]['q_id_forchild']}',$(this).val())" type="radio" /></td>
                                                                                            {/for}
                                                                                        </tr>
                                                                                        {assign k $k+1}
                                                                                    {/foreach}
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                            {elseif $quest.display_style eq 2} {*vertical*}
                                                                <div class="row-fluid">
                                                                    <div class="table-responsive">
                                                                        <table style="top: 0px; margin: 0px; border-top: thin solid rgb(204, 204, 204);" class="table table-bordered table-condensed table-responsive swipe-horizontal table-primary t">
                                                                            <tbody style="">
                                                                                <tr class="gradeX">
                                                                                    <td>&nbsp;</td>
                                                                                    {foreach $quest.child_quest AS $child_quest}
                                                                                        <td class="center">{$child_quest.question}
                                                                                            <input type="hidden" name="quest[]" value="{$child_quest.q_id_forchild}" />
                                                                                            <input type="hidden" name="answer[]" value="" class="answer_text" id="answer_text_{$child_quest.q_id_forchild}"/>
                                                                                            <input type="hidden" name="textarea[]" value="" class="textarea"/>
                                                                                        </td>
                                                                                    {/foreach}
                                                                                </tr>
                                                                                {foreach $quest.answers AS $answer}
                                                                                    {assign k 0}
                                                                                    <tr class="gradeX">
                                                                                        <td>{$answer.answer_text}</td>
                                                                                        {for $i=1 to $quest.child_quest|@count}
                                                                                            {assign cycle_class {cycle values="td-gray,"}}
                                                                                            <td class="center {$cycle_class}"><input name="radio{$k}" id="radio{$k}" value="{$answer.answer_id}" onclick="MatrixView('{$quest.child_quest[{$k}]['q_id_forchild']}',$(this).val())" type="radio"/></td>
                                                                                            {assign k $k+1}
                                                                                        {/for}
                                                                                        {if $quest.child_quest|@count % 2 neq 0}
                                                                                            {assign cycle_class {cycle values="td-gray,"}}
                                                                                        {/if}
                                                                                    </tr>
                                                                                {/foreach}
                                                                            </tbody>
                                                                        </table>
                                                                    </div> 
                                                                </div>
                                                            {/if}
                                                        {/if}
                                                    </div>
                                                </div>
                                            {/foreach}
                                        </div>


                                        <div class="row-fluid">
                                            <div class="span12">
                                                <p class="margin-none strong"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row-fluid">
                            <div style="" class="widget-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="row-fluid"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
{/block}