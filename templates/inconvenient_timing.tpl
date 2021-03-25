{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/cirrus.css" media="all" />      *}
<link rel="stylesheet" href="{$url_path}css/jquery-ui-new.css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="{$url_path}css/inconvenient-timings.css" media="all" />  
<style type="text/css">
    .new{
        display:none;
    }
    .remove_padding{
        padding-left: 0px;
    }
    .incnvnt_dtl_dvs_right{
        padding-top: 2px;
    }
</style>
{/block}
{block name="script"}
<script src="{$url_path}js/jquery-ui.js"></script>
{*<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>*}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.validate.js"></script>
{*<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.button.min.js"></script>*}
<script type="text/javascript">
$(document).ready(function() {
    $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'        
    }).on('changeDate', function(ev){
        check_from_date();
    });
    
    //replace ',' => '.' while entering time
    $(document).off('keyup', "#time_from, #time_to")
        .on('keyup', "#time_from, #time_to", function() {
                $(this).val($(this).val().replace(/,/g,"."));
    });

    $( "#intype" ).buttonset();
    $( "#ltype" ).buttonset();
    
    {if $flag eq 1}
        $(".oncalls_dsip").hide();
        $( "label.salary_type_name" ).each(function( index ) {
            $(this).html($(this).attr('label-normal'));
        });
        toggme('new');
    {/if}
        
    //DAYS
    var hide_show_flag = 0;
    $("#intype2").click(function(){
        $(".oncalls_dsip").show();
        $( "label.salary_type_name" ).each(function( index ) {
            $(this).html($(this).attr('label-oncall'));
        });
        hide_show_flag = 1;
    });
    $("#intype1").click(function(){
        $(".oncalls_dsip").hide();
        $( "label.salary_type_name" ).each(function( index ) {
            $(this).html($(this).attr('label-normal'));
        });
        hide_show_flag = 0;
    });
    $( "#format" ).buttonset();
    //////////////////////////// Validation  ////////////////////////////////////////////////////
    $("#timing").validate({
                rules: {
                        name: {
                                required: function(element){
                                        return ($("#new_name").css("display") == "none") ? true : false
                                }
                        },
                        new_name: {
                                required: function(element){
                                        return ($("#name").css("display") == "none") ? true : false
                                }
                        },
                        date_from: {
                                required: true
                        },
                        range: {
                                required: true
                        }
                }
        });
        
    $(".btn.adding-as-new, .btn.adding-as-exist").click(function(e){
        e.preventDefault();
    });

});

function submit_form(){
    var action = '{$action}';
    if(action == 'edit'){
        {if $flag == 1}
            if(hide_show_flag == 0){
                $(".oncalls_dsip .time_fld_dt_pick").val('0.00');
            }
        {/if}
        var count_check = parseInt('{$change_check_count}');
        var time_from = $("#time_from").val();
        var time_to = $("#time_to").val();
        var time_from_old = '{$timing.time_from}';
        var time_to_old = '{$timing.time_to}';
        var date_from = new Date($("#date_from").val());
        var date_from_old = new Date('{$timing.effect_from}');
        
        if(count_check != 0){
            //check any of changes made in selected days
            var new_sel_days = $('#format input.check:checkbox:checked').map(function () {
                            return this.value;
            }).get();
            var old_days = '{$json_old_days}';
            var json_old_days = JSON.parse(old_days);
            //console.log(json_old_days);

            days_violated = false;
            $.each(json_old_days, function(i, value) {
                    if(!days_violated){
                        if($.inArray( value, new_sel_days ) > -1){

                        }else{
                            days_violated = true;
                            return false;
                        }
                    } else
                        return false;
            });
            
            //check any of changes made in ob type (descrete/contigeous)
            var sel_type = $('#ltype input:radio[name=ltype]:checked').val();
            var type_changed = (sel_type != '{$timing.nature}' ? true : false);
        }
        
        {if $timing.effect_to != ""}
            var date_to = new Date($("#date_to").val());
            var date_to_old = new Date('{$timing.effect_to}');
            if(count_check != 0){
                if((parseFloat(time_from) > parseFloat(time_from_old)) || (parseFloat(time_to) < parseFloat(time_to_old))|| (date_from > date_from_old) || (date_to < date_to_old) || days_violated || type_changed)
                    alert("{$translate.caution}: {$translate.it_affect_previous_added_timetable}");
                else
                    $("#timing").submit();
            }else
                $("#timing").submit();
        {else}
            if(count_check != 0){
                if((parseFloat(time_from) > parseFloat(time_from_old)) || (parseFloat(time_to) < parseFloat(time_to_old))|| (date_from > date_from_old) || days_violated || type_changed)
                    alert("{$translate.caution}: {$translate.it_affect_previous_added_timetable}");
                else
                     $("#timing").submit();
            }else
                $("#timing").submit();
        {/if}
    }else
        $("#timing").submit();
}

function reset_form(){
        document.getElementById("timing").reset();
}

function toggme(cl){
        if(cl == "new"){
            $('.adding-as-exist').addClass('hide');
            $('.adding-as-new').removeClass('hide');
        }else{
            $('.adding-as-exist').removeClass('hide');
            $('.adding-as-new').addClass('hide');
        }
}

function check_from_date(){
        {*var date_from = $("#date_from").val();
        var name = $("#name").val();

        if(name != "" && date_from != "" && $("#name").is(":visible") != false){
                var v;
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_incon_timing_from_date_check.php",
                        data:"name="+name+"&date_from="+date_from,
                        type:"POST",
                        success:function(data){
                                $("#err_msg").html(data);
                                if(data != "")
                                    v = false;
                                else
                                    v = true;	
                        }
                });
                return v;
        }*}
        return true;
}

function validate(){
            var err = 1;
            for(var i=1;i<=7;i++){
                    if($("#check"+i).is(":checked") != false)
                        err = 0;
            }
            if(err){
                    $("#check_err").html("{$translate.select_one_day}");
                    return false;
            }
            else
                    $("#check_err").html("");

            if(!check_from_date())
                return false;

            return true;
    }
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
                            <h1 style="">{$translate.inconv_timing} <span class="subtitle"></span></h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="submit_form()" type="button"><i class=' icon-save'></i> {$translate.save}</button>
                            <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:location='{$url_path}inconvenient/timings/list/';"><i class='icon-arrow-left'></i> {$translate.backs}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="row-fluid">
                            <form name="timing" id="timing" method="post" onsubmit="return validate()">
                                <input type="hidden" name="type_sal" id="type_sal" value="{$timing.type}" />
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div class="span12" style="margin: 0px;">
                                        <label class="span3" style="float: left;">{$translate.name}</label>
                                        <div class="span9" style="margin: 0px;">
                                            <select name="name" id="name" class="form-control pull-left adding-as-exist" {if $action eq 'clone'}disabled="disabled"{/if}>
                                                <option value="">Select</option>
                                                {foreach $timing_names as $nam}
                                                    {html_options  values=$nam output=$nam selected=$timing.name}
                                                {/foreach}
                                            </select>
                                            {if $action neq 'clone'}<input name="new_name" id="new_name" type="text" value="{if $action eq 'new'}{$timing.name}{/if}" class="form-control  pull-left adding-as-new hide"/>{/if}
                                            {if $action neq 'clone'}
                                                <div class="add_img pull-left">
                                                    <button class="btn btn-default old adding-as-exist no-ml" onclick="toggme('new');"><i class="icon-plus"></i></button>
                                                    <button class="btn btn-default hide adding-as-new no-ml" onclick="toggme('old');"><i class="icon-remove"></i></button>
                                                </div>
                                            {/if}
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                        <label style="float: left;" class="span3" for="date_from">{$translate.date_effect_from}</label>
                                        <div class="span9" style="margin: 0px;">
                                            <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr" style="padding: 0px;">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span11"  name="date_from" id="date_from" value="{$timing.effect_from}" type="text" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>
                                    {if $timing.effect_to neq ''}
                                        <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                            <label style="float: left;" class="span3" for="date_to">{$translate.date_effect_to}</label>
                                            <div class="span9" style="margin: 0px;">
                                                <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr" style="padding: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span11"  name="date_to" id="date_to" value="{$timing.effect_to}" type="text" readonly="readonly"/>
                                                </div>
                                            </div>
                                        </div>
                                    {/if}
                                    <div class="row-fluid">
                                        <label style="float: left;" class="span3">{$translate.inconvenient_type}</label>
                                        <div class="span9 form-left" style="padding: 0px; margin: 0px;">
                                            <div style="margin: 0px ! important;" class="span12">
                                                <div id="intype" style="padding-left: 0px;">
                                                    <input type="radio" id="intype1" name="intype" {if $timing.type neq 3}checked="checked"{/if} value="0" /><label for="intype1">{$translate.normal}</label>
                                                    <input type="radio" id="intype2" name="intype" {if $timing.type eq 3}checked="checked"{/if} value="3" /><label for="intype2">{$translate.oncall}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <label style="float: left;" class="span3">{$translate.type}</label>
                                        <div class="span9 form-left" style="padding: 0px; margin: 0px;">
                                            <div style="margin: 0px ! important;" class="span12">
                                                <div id="ltype" style="padding-left: 0px;">
                                                    <input type="radio" id="ltype1" name="ltype" {if $timing.nature neq 1}checked="checked"{/if} value="0" /><label for="ltype1">{$translate.discrete}</label>
                                                    <input type="radio" id="ltype2" name="ltype" {if $timing.nature eq 1}checked="checked"{/if} value="1" /><label for="ltype2">{$translate.continus}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span3" for="time_from">{$translate.time_range}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on">{$translate.from}</span>
                                                <input type="text" name="time_from" id="time_from"  class="form-control span5 mr" value="{$timing.time_from}" />
                                                <span class="add-on">{$translate.to}</span>
                                                <input type="text" name="time_to" id="time_to" class="form-control span5" value="{$timing.time_to}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <label style="float: left;" class="span3">{$translate.days}</label>
                                        <div class="span9 form-left" style="padding: 0px; margin: 0px;">
                                            <div style="margin: 0px ! important;" class="span12">
                                                <div id="format">
                                                    <input type="checkbox" id="check1" class="check" name="mon" value="1" {if $days.mon eq 1}checked="checked"{/if} /><label for="check1">{$translate.mon}</label>
                                                    <input type="checkbox" id="check2" class="check" name="tue" value="2" {if $days.tue eq 1}checked="checked"{/if} /><label for="check2">{$translate.tue}</label>
                                                    <input type="checkbox" id="check3" class="check" name="wed" value="3" {if $days.wed eq 1}checked="checked"{/if} /><label for="check3">{$translate.wed}</label>
                                                    <input type="checkbox" id="check4" class="check" name="thu" value="4" {if $days.thu eq 1}checked="checked"{/if} /><label for="check4">{$translate.thu}</label>
                                                    <input type="checkbox" id="check5" class="check" name="fri" value="5"  {if $days.fri eq 1}checked="checked"{/if} /><label for="check5">{$translate.fri}</label>
                                                    <input type="checkbox" id="check6" class="check" name="sat" value="6"  {if $days.sat eq 1}checked="checked"{/if} /><label for="check6">{$translate.sat}</label>
                                                    <input type="checkbox" id="check7" class="check" name="sun" value="7"  {if $days.sun eq 1}checked="checked"{/if} /><label for="check7">{$translate.sun}</label>
                                                    &nbsp;&nbsp;&nbsp;<span id="check_err"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12 incnvnt_dtl_dvs_right">{*salary field oncall*}
                                        <label style="float: left;" class="span3 salary_type_name" for="salary" label-normal="{$translate.inconvenient_time_salary}" label-oncall="{$translate.inconvenient_time_oncall_salary}">{if $timing.type != 0 || $flag == 1}{$translate.inconvenient_time_oncall_salary}{else}{$translate.inconvenient_time_salary}{/if}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-edit"></span>
                                                <input name="salary" id="salary" type="text" class="form-control" value="{$timing.amount}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12 {*oncalls_dsip*}">{*salary field call training*}
                                        <label style="float: left;" class="span3 salary_type_name" for="salary_call_training" label-normal="{$translate.inconvenient_time_training_time_salary}" label-oncall="{$translate.inconvenient_time_call_training_salary}">{if $timing.type != 0 || $flag == 1}{$translate.inconvenient_time_call_training_salary}{else}{$translate.inconvenient_time_training_time_salary}{/if}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-edit"></span>
                                                <input name="salary_call_training" id="salary_call_training" value="{$timing.sal_call_training}" type="text" class="form-control time_fld_dt_pick" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12 {*oncalls_dsip*}">{*salary field complimentary oncall*}
                                        <label style="float: left;" class="span3 salary_type_name" for="salary_complimentary_oncall" label-normal="{$translate.inconvenient_time_complimentary_salary}" label-oncall="{$translate.inconvenient_time_complimentary_oncall_salary}">{if $timing.type != 0 || $flag == 1}{$translate.inconvenient_time_complimentary_oncall_salary}{else}{$translate.inconvenient_time_complimentary_salary}{/if}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-edit"></span>
                                                <input name="salary_complimentary_oncall" id="salary_complimentary_oncall" value="{$timing.sal_complementary_oncall}" type="text" class="form-control time_fld_dt_pick" />
                                            </div>
                                        </div>
                                    </div>
                                    {if $timing.type != 0 || $flag == 1} 
                                        <div style="margin: 0px;" class="span12 oncalls_dsip">{*salary field more oncall*}
                                            <label style="float: left;" class="span3" for="salary_more_oncall">{$translate.inconvenient_time_more_oncall_salary}</label>
                                            <div class="span9" style="margin:0;">
                                                <div class="input-prepend">
                                                    <span class="add-on icon-edit"></span>
                                                    <input name="salary_more_oncall" id="salary_more_oncall" value="{$timing.sal_more_oncall}" type="text" class="form-control time_fld_dt_pick" />
                                                </div>
                                            </div>
                                        </div>
                                    {/if}
                                    <div style="margin: 0px;" class="span12 {*oncalls_dsip*}">{*salary field dismissal oncall*}
                                        <label style="float: left;" class="span3 salary_type_name" for="salary_dismissal_oncall" label-normal="{$translate.inconvenient_time_dismissal_salary}" label-oncall="{$translate.inconvenient_time_dismissal_oncall_salary}">{if $timing.type != 0 || $flag == 1}{$translate.inconvenient_time_dismissal_oncall_salary}{else}{$translate.inconvenient_time_dismissal_salary}{/if}</label>
                                        <div class="span9" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-edit"></span>
                                                <input name="salary_dismissal_oncall" id="salary_dismissal_oncall" value="{$timing.sal_dismissal_oncall}" type="text" class="form-control time_fld_dt_pick" />
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
