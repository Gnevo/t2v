{block name="style"}
    <link href="{$url_path}css/survey.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}
{block name="script"}
    <script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    $(document).ready(function(){	
        $(".datepicker").datepicker({
            autoclose: true
        });
          
        $('.btn_survey_start').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
        
        var availableTags = [
            {foreach from=$surveys item=surve}
                 "{$surve.survey_title}",       
                {/foreach}
                    ""
        ];
        $( "#search_text" ).autocomplete({
            source: availableTags,
            select: function( event, ui ) {
                 this.value = ui.item.value;
        }
        });
        
        var availableTags = [
            {foreach from=$surveys item=surve}  
                    {
                    value: "{$surve.id}",
                    label: "{$surve.survey_title}"
                    },
            {/foreach}
                
                
        ];
        $( "#search_text" ).autocomplete({
            minLength: 0,
            source: availableTags,
            focus: function( event, ui ) {
                $( "#search_text" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#search_text" ).val( ui.item.label );
                $( "#search_id" ).val( ui.item.value );
                return false;
            }
        });
    });
    
    function getSurveys(){
        var error = 0;
        if($('#expired').attr("checked") && $('#valued').attr("checked")){
            $('#status').val('3');
            var x = 3;
        }else if($('#expired').attr("checked")){
            var x= $('#expired').val();
            $('#status').val(x);
        }else if($('#valued').attr("checked")){
            var x= $('#valued').val();
            $('#status').val(x);
        }else{
            $('#status').val('3');
             var x = 3;
        }
        var search_text = $("#search_text").val();
        if(search_text == '' || search_text == null){
            $("#search_id").val('');
        }
        var date_from = $("#textfield1").val();
        var date_to = $("#textfield2").val();
        //alert(date_from + ' === '+ date_to);
        if((date_from != "" && date_to == "") || (date_from == "" && date_to != "")){
            if(date_from == ""){
                error = 1;
                alert("{$translate.please_enter_date_from}");
                $("#textfield1").focus();
            }
            if(date_to == ""){
                error = 1;
                alert("{$translate.please_enter_date_to}");
                $("#textfield2").focus();
            }
        }
        if(error == 0)
            $("#search_survey_form").submit();
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
                        <h1 style="">{$translate.surveys}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button onclick="javascript:location='{$url_path}S_survey_report_types.php';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                    </div>
                </div>
            </div>
            
            <div class="span12 widget-body-section input-group">
                <div class="widget-body pb">
                    <div class="row-fluid">
                        <div class="span12 widget-body-section input-group">
                            <form method="post" id="search_survey_form" action="{$url_path}S_surveys_list.php"  class=''>
                                <div style="margin: 0px ! important; padding: 0px;" class="pull-left span3">
                                    <label for="search_emp" style="float: left;" class="span12">{$translate.search_surveys}</label>
                                    <div class="input-prepend span10" style="margin: 0px; float:left;"> <span class="add-on icon icon-search"></span>
                                        <input type="text" name="search_text" id="search_text" class="form-control span12 text-box ui-autocomplete-input" autocomplete="off">
                                        <input name="search_id"  id="search_id" type="hidden"/>
                                    </div>
                                </div>
                                <div class="pull-left span2">
                                    <label for="search_emp" style="float: left;" class="span12 no-mb">{$translate.date_range}</label>
                                    <div class="input-prepend span10" style="margin: 0px; float:left;"> 
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker no-pt no-pl"> 
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" name="date_from" id="textfield1" value="{$date_from}" class="form-control span12 text-box" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-left span2">
                                    <label for="search_emp" style="float: left;" class="span12 no-mb">{$translate.to}</label>
                                    <div class="input-prepend span10" style="margin: 0px; float:left;"> 
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker no-pt no-pl"> 
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" name="date_to" id="textfield2" value="{$date_to}" class="form-control span12 text-box" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-left">
                                    <label for="search_emp" style="float: left;" class="span12 no-mb">{$translate.survey_status}</label>
                                    <ol class="radio-group">
                                        <li><input name="expired" id="expired" type="checkbox" value="1" {if $expire == 1}checked="checked"{/if} class="check-box" />
                                            <label class="radio label-option-and-checkbox">{$translate.expired} </label></li>
                                        <li>  
                                            <input name="valued" id="valued" type="checkbox" value="2" {if $valid == 1}checked="checked"{/if} class="check-box" />
                                            <label class="radio label-option-and-checkbox">{$translate.valued}</label></li>
                                    </ol>
                                </div> 
                                <div style="padding-top: 15px;" class="pull-right">
                                    <input type="hidden" name="status" id="status" value="" />
                                    <button name="get_survey" id="get_survey" onclick="getSurveys()" class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft" type="button"> {$translate.get_survey}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                                
                {if $surveys|count gt 0}
                    <div class="accordion accordion-2" id="tabAccountAccordion">
                        {foreach $surveys AS $survey}
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle glyphicons right_arrow" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-{$survey.id}">
                                        <i></i>{$survey.survey_title}
                                        <button onclick="javascript:location='{$url_path}custom/survey/report/{$survey.id}/';" class="btn btn-success btn-normal pull-right btn_survey_start" style="margin: 5px; padding-left: 5px; padding-right: 5px;" type="button">
                                            {$translate.go_to_report} <span class="icon-arrow-right"></span>
                                        </button>
                                        <div class="pull-right mr">{if $smarty.now|date_format:'%Y-%m-%d' > $survey.expire_date|date_format:'%Y-%m-%d'}<span class="badge badge-important " style="">{$translate.expired_1}</span>{else}<span class="badge badge-success " style="">{$translate.valid}</span>{/if}</div>
                                    </a>
                                </div>
                                <div style="height: 0px;" id="collapse-{$survey.id}" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <div class="margin-none">
                                            <span class="label label-success">{$translate.created_on}: {$survey.created_date|date_format:'%A, %B %d , %Y'}</span>
                                            <span class="label label-important">{$translate.expiry_date}: {$survey.expire_date|date_format:'%Y-%m-%d'}</span>
                                            <span class="label label-info">{$translate.number_of_forms}: {$survey.form_count}</span>
                                            <span class="label label-inverse">{$translate.survey_status}: {if $smarty.now|date_format:'%Y-%m-%d' > $survey.expire_date|date_format:'%Y-%m-%d'}{$translate.expired_1}{else}{$translate.valid}{/if}</span>
                                            <span class="label label-warning">{$translate.response_count}: {$survey.user_count}</span><br> 
                                            {if $survey.description neq ''}<p style="margin: 10px 0px 0px;" class=""><strong>{$translate.description}</strong><br>{$survey.description}</p>{/if}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <div class="message">{$translate.no_surveys}</div>
                {/if}
            </div>
        </div>
    </div>       
{/block}