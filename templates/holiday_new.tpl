{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/cirrus.css" media="all" />    *}
<link rel="stylesheet" href="{$url_path}css/jquery-ui-new.css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="{$url_path}css/inconvenient-timings.css" media="all" />    
{*        <link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.ui.datepicker.css" />*}
<style type="text/css">
    #format .ui-button-text{
        width: 20px;
        }
    /*#format .red_box{
        background-color: #F00;
        background-image: none;
	color:#FFF
        }*/
    .ui-datepicker-year{
{*        display:none;*}
    }
</style>
{/block}

{block name="script"}
<script src="{$url_path}js/jquery-ui.js"></script>
{*<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>*}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
            //datepicker
            $(".datepicker").datepicker({
                autoclose: true,
                format: "mm-dd",
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
            });
            
            $( "#datefrom, #dateto" ).datepicker({
                autoclose: true,
                format: "mm-dd",
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}',
                
                beforeShow: function(input, inst) {
                    setTimeout(function(){
                        var year_from = $("#year_from").val();
                        if($.trim(year_from) != ''){
                            var current_month_day = '{$current_month_day}';
                            var current_date_from = $.trim($( input ).val());
                            if(current_date_from != '')
                                current_month_day = current_date_from;
                                
                            var d = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+current_month_day);
                            
                            //change Year values of 'date-to' if date-from month > date-to-month
                            if($( input ).attr('id') == 'dateto' && $.trim($('#datefrom').val()) != '' && $.trim($('#dateto').val()) != ''){
                                var tmp_full_from_date = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+$.trim($('#datefrom').val()));
                                var tmp_full_to_date = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+$.trim($('#dateto').val()));
                                if(tmp_full_from_date.getMonth() > tmp_full_to_date.getMonth()){
                                    var d = $.datepicker.parseDate('yy-mm-dd', (parseInt(year_from)+1)+'-'+current_month_day);
                                }
                            }
                            
                            $( input ).datepicker('setDate', d);
                        }
                    }, 50);
                },
                
                onSelect: function(dateText) {
                    $(this).change();
                }
            }).on('changeDate', function(ev){
                var year_from = $("#year_from").val();
                if($.trim(year_from) != '' && $.trim($('#datefrom').val()) != '' && $.trim($('#dateto').val()) != ''){
                    var current_month_day = '{$current_month_day}';
                    var current_date_from = $.trim($( this ).val());
                    if(current_date_from != '')
                        current_month_day = current_date_from;

                    var d = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+current_month_day);
                    
                    var year_to = year_from;

                    var tmp_full_from_date = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+$.trim($('#datefrom').val()));
                    var tmp_full_to_date = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+$.trim($('#dateto').val()));
                    if(tmp_full_from_date.getMonth() > tmp_full_to_date.getMonth()){
                        year_to = parseInt(year_from)+1;
                    }
                    
                    var calc_full_from_date = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+$.trim($('#datefrom').val()));
                    var calc_full_to_date = $.datepicker.parseDate('yy-mm-dd', year_to+'-'+$.trim($('#dateto').val()));
                    
                    var diff = Math.floor((calc_full_to_date.getTime() - calc_full_from_date.getTime()) / 86400000); // ms per day
                    var total_days = Math.abs(diff) + 1;
                    updateDaysCatelogList(total_days);
                } else {
                    $("#format").html('');
                    $("#format").css('display','none');
                }
            });
            
            
            //replace ',' => '.' while entering time
            $(document).off('keyup', "#timefrom, #timeto")
                .on('keyup', "#timefrom, #timeto", function() {
                        $(this).val($(this).val().replace(/,/g,"."));
            });
           
            
            
            /*$( "#datefrom, #dateto, .ui-datepicker-trigger" ).click( function( ) {
                //hideYear( );
            });  */
            
            /*$( "#year_from" ).change( function() {
                //$(".ui-datepicker-year").css( 'display', 'block' );
                var year_from = $(this).val();
                if($.trim(year_from) != ''){
                    var current_month_day = '01-01';
                    var current_date_from = $.trim($( "#datefrom" ).val());
                    if(current_date_from != '')
                        current_month_day = current_date_from;
                    var d = $.datepicker.parseDate('yy-mm-dd', year_from+'-'+current_month_day);
                    $( "#datefrom" ).datepicker('setDate', d);
                }
            });  */

                
             $("#holi_form").validate({
                rules: {
                        new_name: {
                                required: true
                        },
                        holiday_type: {
                                required: true
                        },
                        year_from: {
                                required: true
                        },
                        nos_days: {
                                required: true
                        },
                        datefrom: {
                                required: true
                        },
                        timefrom: {
                                required: true
                        },
                        dateto: {
                                required: true
                        },
                        timeto: {
                                required: true
                        }
                }
            });

            $( "#format" ).buttonset();
//            $( "#format" ).buttonset().click(function(){
//                $(this).find(':checked').next('label').toggleClass('red_box', this.checked);
//            });
            stylish_holiday_days();


            $('#nos_days').bind('keypress', function(){
                    setTimeout(updateDaysCatelogList, 1);
            });
            
            $( "#format" ).buttonset();
	
    });
    
    function hideYear( ) {
       //$(".ui-datepicker-year").css( 'display', 'none' );
    }

    function updateDaysCatelogList(total){
        //var total = $("#nos_days").val();
        $('#format').buttonset('destroy');
        var new_html = '';
        for(var i = 0 ; i< total; i++){
//                    $("#format").append('<input type="checkbox" id="check"'+(i+1)+' name="day_cat['+(i+1)+']" value="1" /><label for="check'+(i+1)+'">'+(i+1)+'</label>');
            new_html += '<input type="checkbox" id="check'+(i+1)+'" name="day_cat['+(i+1)+']" value="1" /><label for="check'+(i+1)+'">'+(i+1)+'</label>';
        }
        $("#format").html(new_html);
        $("#format").buttonset();
        stylish_holiday_days();
        $("#format").css('display','block');

    }
    
    function stylish_holiday_days(){
//        $( "#format .ui-button" ).click(function(){
////            $(this).toggleClass('red_box', this.checked);
//            $(this).toggleClass('red_box');
//            if($(this).hasClass('red_box'))
//                $(this).prev('input.checkbox').attr("checked","checked");
//            else
//                $(this).prev('input.checkbox').attr("checked","");
//        });
        
        
        /*$("input[type='checkbox']").click(function() {
            //if you want to add on checked
            if($(this).is(":checked")) {
                $(this).next('label.ui-button').addClass("red_box");
            }else {
                $(this).next('label.ui-button').removeClass("red_box");
            }
        });*/

//
//        $('#format').bind("click",function() {
//            var text = "";
//            $('#format').find('label.ui-state-active').each(function() {
//                text += $(this).attr("for") + "-";
//            });
//            $('#selected').html(text);
//          });
    }
    function  validate_form(){
        
    }
    
    function submit_form() {
//        if(validate_form())
            $("#holi_form").submit();
    }

    function reset_form() {
            document.getElementById("holi_form").reset();
            var total = $("#nos_days").val();
            if(parseInt(total) > 0)
                $("#format").css('display','block');
            else
                $("#format").css('display','none');
    }        

//    function update_yearto(year_from)
//    {
//        var yearTo_limit = parseInt(year_from)+20;
////        var saved_yearTo = {$holi_data.effect_to};
//        var new_yearto = '<option value="">{$translate.select_year}</option>';
//        if(year_from != ""){
//            for(var i = year_from ; i<yearTo_limit ; i++){
////                if(saved_yearTo == i)
////                    new_yearto += '<option value="'+i+'" selected="TRUE">'+i+'</option>';
////                else
//                    new_yearto += '<option value="'+i+'">'+i+'</option>';
//            }
//        }
//        $("#year_to").html(new_yearto);
//    }        
	
</script>
{/block}

{block name="content"}
    <div class="row-fluid" id="main_container">
{*        main left*}
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
            <div class="span12 no-ml" style="margin-left: 0px;">
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                            <h1 style="">{$translate.holiday} <span class="subtitle"></span></h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="submit_form()" type="button"><i class=' icon-save'></i> {$translate.save}</button>
                            <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:location='{$url_path}inconvenient/timings/list/';"><i class='icon-arrow-left'></i> {$translate.backs}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="row-fluid">
                            <form method="post" id="holi_form" name="holi_form">
                                <input type="hidden" id="bm_id" name="bm_id" value="{$holi_data.id}">
                                <input type="hidden" id="grp_id" name="grp_id" value="{$holi_data.group_id}">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div class="span12" style="margin: 0px;">
                                        <label class="span3" style="float: left;">{$translate.type}</label>
                                        <div class="span9" style="margin: 0px;">
                                            <label class="pull-left"><input name="holiday_type" value="1" id="holi_normal" {if $holi_data.type eq 1}checked="checked"{/if} style="margin: 0px 7px 0px 0px ! important;" type="radio"> {$translate.normal}</label> 
                                            <label class="pull-left"><input name="holiday_type" value="2" id="holi_inconv" {if $holi_data.type eq 2}checked="checked"{/if} style="margin: 0px 7px ! important;" type="radio"> {$translate.inconvenient}</label>
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                        <label style="float: left;" class="span3" for="holiday_name">{$translate.holiday} {$translate.name}</label>
                                        <div class="span9" style="margin: 0px;">
                                            <div style="margin: 0px;" class="input-prepend"> <span class="add-on icon-pencil"></span>
                                                <input id="new_name" name="new_name" value="{$holi_data.name}" {if $action == 'clone'} readonly="readonly" {/if} class="form-control span11" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span3" for="year_from">{$translate.year}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on">{$translate.from}</span>
                                                <select name="year_from" id="year_from" class="form-control span5 mr">
                                                    <option value="">{$translate.select_year}</option>
                                                    {for $y_from=$cur_year-10 to $cur_year+10}
                                                        <option value="{$y_from}" {if $holi_data.effect_from eq $y_from} selected="TRUE"{else if $action__ eq 'new' and $cur_year eq $y_from} selected="TRUE"{/if}>{$y_from}</option>
                                                    {/for}
                                                </select>
                                                <span class="add-on">{$translate.to}</span>
                                                <select name="year_to" id="year_to" class="form-control span5">
                                                    <option value="">{$translate.select_year}</option>
                                                    {for $y_to=$cur_year-10 to $cur_year+10}
                                                        <option value="{$y_to}" {if $holi_data.effect_to eq $y_to} selected="TRUE"{/if}>{$y_to}</option>
                                                    {/for}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span3">{$translate.date_effected}</label>
                                        <div class="span9" style="margin:0;">
                                            <label class="pull-left span2">{$translate.from}</label>
                                            <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr" style="padding: 0px;">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span11"  name="datefrom" id="datefrom" value="{$holi_data.date_from}" type="text"/>
                                            </div>
                                            <div class="input-prepend">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="timefrom" id="timefrom" value="{if $holi_data.start_time != ''}{$holi_data.start_time}{else}0.00{/if}" type="text"/>
                                            </div>
                                        </div>
                                        <label style="float: left;" class="span3 no-ml">&nbsp;</label>
                                        <div class="span9" style="margin:0;">
                                            <label class="pull-left span2">{$translate.to}</label>
                                            <div class="input-prepend hasDatepicker date datepicker no-pr no-mr" style="padding: 0px;">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span11"  name="dateto" id="dateto" value="{$holi_data.date_to}" type="text"/>
                                            </div>
                                            <div class="input-prepend">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="timeto" id="timeto" value="{if $holi_data.end_time != ''}{$holi_data.end_time}{else}0.00{/if}" type="text"/>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <label style="float: left;" class="span3">&nbsp;</label>
                                            <div class="span9 form-left" style="padding: 0px; margin: 0px;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <div id="format" style="padding-left: 0px;">
                                                        {foreach $holi_data.day_data as $hdata}
                                                            <input type="checkbox" id="check{$hdata.day}" name="day_cat[{$hdata.day}]" value="1" {if $hdata.type eq 1}checked="TRUE"{/if} /><label for="check{$hdata.day}" {*if $hdata.type eq 1}class="red_box"{/if*}>{$hdata.day}</label>
                                                        {/foreach}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <label style="float: left;" class="span3">&nbsp;</label>
                                            <div class="span9" style=" margin: 10px 0px 0px ! important;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <ul class="day-info-list">
                                                        <li class="day-big">{$translate.big_day}</li>
                                                        <li class="day-red">{$translate.red_day}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                          
{/block}
