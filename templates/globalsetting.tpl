{block name="style"}
    <style>
        .glob_inp { border-color: #cfcfcf; text-align: right; padding-right: 3px; width: 143px; }
        .form-group-gray .fixed-body-height{ overflow-y: scroll; max-height: 268px;}
    </style>
    <link rel="stylesheet" href="{$url_path}css/administration.css" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <!--link rel="stylesheet" href="{$url_path}css/font-awesome.min.css" type="text/css" /-->
    
{/block}
{block name="script"}
   
   <script src="{$url_path}js/date-picker.js"></script>
   <script type="text/javascript" src="{$url_path}js/bootbox.js"></script>

<script>

function is_int(value) { 
        if((parseFloat(value) == parseInt(value)) && !isNaN(value))
                return true;
        else 
                return false;
}
		  
$(document).ready(function() {

    $(document).off('keyup', ".comma_dec")
                .on('keyup', ".comma_dec", function(e) {
                        // get keycode of current keypress event
                        var code = (e.keyCode || e.which);

                        // do nothing if it's an arrow key
                        if(code == 37 || code == 38 || code == 39 || code == 40) {
                            return;
                        }
                        var this_val = $(this).val();
                        var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                        $(this).val(new_val);
            });
    
    if($(window).height() > 600)
        $('.tab-content-con-companysetting').css({ height: $(window).height()-120}); 
    else
        $('tab-content-con-companysetting').css({ height: $(window).height()});
    
    {if $clone_action == 'clone'} 	
        $("#increment").change(function(){
            var inc = $("#increment").val();
            if(inc != "" && inc != null){
                inc = parseFloat(inc);
                var normal = '{$salary_main.normal}';
                normal = parseFloat(normal);
                normal = normal + ((normal * inc)/100);
                $("#normal").val(parseFloat(normal).toFixed(2));

                var travel = '{$salary_main.travel}';
                travel = parseFloat(travel);
                travel = travel + ((travel * inc)/100);
                $("#travel").val(parseFloat(travel).toFixed(2));

                var breaks = '{$salary_main.break}';
                breaks = parseFloat(breaks);
                breaks = breaks + ((breaks * inc)/100);
                $("#break").val(parseFloat(breaks).toFixed(2));

                var oncall = '{$salary_main.oncall}';
                oncall = parseFloat(oncall);
                oncall = oncall + ((oncall * inc)/100);
                $("#oncall").val(parseFloat(oncall).toFixed(2));

                var overtime = '{$salary_main.overtime}';
                overtime = parseFloat(overtime);
                overtime = overtime + ((overtime * inc)/100);
                $("#overtime").val(parseFloat(overtime).toFixed(2));

                var qual_overtime = '{$salary_main.quality_overtime}';
                qual_overtime = parseFloat(qual_overtime);
                qual_overtime = qual_overtime + ((qual_overtime * inc)/100);
                $("#qual_overtime").val(parseFloat(qual_overtime).toFixed(2));

                var more_time = '{$salary_main.more_time}';
                more_time = parseFloat(more_time);
                more_time = more_time + ((more_time * inc)/100);
                $("#more_time").val(parseFloat(more_time).toFixed(2));

                var some_other_time = '{$salary_main.some_other_time}';
                some_other_time = parseFloat(some_other_time);
                some_other_time = some_other_time + ((some_other_time * inc)/100);
                $("#some_other_time").val(parseFloat(some_other_time).toFixed(2));

                var training_time = '{$salary_main.training_time}';
                training_time = parseFloat(training_time);
                training_time = training_time + ((training_time * inc)/100);
                $("#training_time").val(parseFloat(training_time).toFixed(2));

                var call_training = '{$salary_main.call_training}';
                call_training = parseFloat(call_training);
                call_training = call_training + ((call_training * inc)/100);
                $("#call_training").val(parseFloat(call_training).toFixed(2));

                var personal_meeting = '{$salary_main.personal_meeting}';
                personal_meeting = parseFloat(personal_meeting);
                personal_meeting = personal_meeting + ((personal_meeting * inc)/100);
                $("#personal_meeting").val(parseFloat(personal_meeting).toFixed(2));

                var holiday_big = '{$salary_main.holiday_big}';
                holiday_big = parseFloat(holiday_big);
                holiday_big = holiday_big + ((holiday_big * inc)/100);
                $("#holiday_big").val(parseFloat(holiday_big).toFixed(2));

                var holiday_big_oncall = '{$salary_main.holiday_big_oncall}';
                holiday_big_oncall = parseFloat(holiday_big_oncall);
                holiday_big_oncall = holiday_big_oncall + ((holiday_big_oncall * inc)/100);
                $("#holiday_big_oncall").val(parseFloat(holiday_big_oncall).toFixed(2));

                var holiday_red = '{$salary_main.holiday_red}';
                holiday_red = parseFloat(holiday_red);
                holiday_red = holiday_red + ((holiday_red * inc)/100);
                $("#holiday_red").val(parseFloat(holiday_red).toFixed(2));

                var holiday_red_oncall = '{$salary_main.holiday_red_oncall}';
                holiday_red_oncall = parseFloat(holiday_red_oncall);
                holiday_red_oncall = holiday_red_oncall + ((holiday_red_oncall * inc)/100);
                $("#holiday_red_oncall").val(parseFloat(holiday_red_oncall).toFixed(2));

                var insurance = '{$salary_main.insurance}';
                insurance = parseFloat(insurance);
                insurance = insurance + ((insurance * inc)/100);
                $("#insurance").val(parseFloat(insurance).toFixed(2));

            } else{
                var normal = '{$salary_main.normal}';
                $("#normal").val(normal);

                var travel = parseFloat('{$salary_main.travel}');
                $("#travel").val(travel);

                var breaks = '{$salary_main.break}';
                $("#break").val(breaks);

                var oncall = '{$salary_main.oncall}';
                $("#oncall").val(oncall);

                var overtime = '{$salary_main.overtime}';
                $("#overtime").val(overtime);

                var qual_overtime = '{$salary_main.quality_overtime}';
                $("#qual_overtime").val(qual_overtime);

                var more_time = '{$salary_main.more_time}';
                $("#more_time").val(more_time);

                var some_other_time = '{$salary_main.some_other_time}';
                $("#some_other_time").val(some_other_time);

                var training_time = '{$salary_main.training_time}';
                $("#training_time").val(training_time);

                var call_training = '{$salary_main.call_training}';
                $("#call_training").val(call_training);

                var personal_meeting = '{$salary_main.personal_meeting}';
                $("#personal_meeting").val(personal_meeting);

                var holiday_big = '{$salary_main.holiday_big}';
                $("#holiday_big").val(holiday_big);
                
                var holiday_big_oncall = '{$salary_main.holiday_big_oncall}';
                $("#holiday_big_oncall").val(holiday_big_oncall);

                var holiday_red = '{$salary_main.holiday_red}';
                $("#holiday_red").val(holiday_red);
                
                var holiday_red_oncall = '{$salary_main.holiday_red_oncall}';
                $("#holiday_red_oncall").val(holiday_red_oncall);

                var insurance = '{$salary_main.insurance}';
                $("#insurance").val(insurance);
            }

        });
    {/if}

    $("#normal").focus();
      
    
    $(".hasDatepicker").datepicker({
               autoclose: true
           });
    
    
    
});

function save_form(){
    $("#action").val('');
     $('#selected').val('');
     var effect_from = $("#efffect_from").val();
     var time = $("#start_time").val();
     var error = 0;
     if(error == 0){
       if(effect_from != ""){ 
          $("#globalsettingform").submit();
         }else{
            alert("{$translate.enter_effect_from}");
         }
    }
}

function edit_form(){
    bootbox.dialog('{$translate.company_edit_save_alert_message}', [
        {
            "label" : "{$translate.no}",
            "class" : "btn-danger",
        },
         {                          //// bootbox alert /////
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                edit_form_proceed();
            }
         }
      ]);

}

function edit_form_proceed(){
     var id_val = $("#select_date").val();
     $("#action").val('edit');
     $('#selected').val(id_val);
     var error = 0;
     
     if(error == 0){
        $("#globalsettingform").submit();
    }
}

function delete_form(){
    var r=confirm("{$translate.do_you_want_delete}");
    if (r==true)
      {
        var id_val = $("#select_date").val();
        document.location.href = '{$url_path}globalsettings/del/'+id_val+'/';
      }
    
   /* var id_val = $("#select_date").val();
    document.location.href = '{$url_path}globalsettings/del/'+id_val+'/';*/
}

function clone_form(){
    var id_val = $("#select_date").val();
    document.location.href = '{$url_path}globalsettings/clone/'+id_val+'/';
}
function get_form(){
    var id_val = $("#select_date").val();
    if(id_val!= 'Välj'){
        document.location.href = '{$url_path}globalsettings/get/'+id_val+'/';
    }
}
function add_form(){
    //var id_val = $("#select_date").val();
    document.location.href = '{$url_path}globalsettings/add/';
}
function back_button(){
    document.location.href = '{$url_path}administration/';
}
</script>
{/block}
{block name="content"}
    {$message}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="pull-left"><h1>{$translate.global_setting}</h1>
                    </div>
                    
                    <div class="pull-left" style="margin: 10px 0px;">
                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-calendar"></span>
                            <!--input placeholder="{*$translate.select_date*}" class="form-control span11" id="exampleInputEmail1" type="email"--> 
                            <select name="select_date" id="select_date" class="form-control span11" onselect="get_form()" onchange="get_form()">
                                <option>{$translate.select}</option>
                                {foreach $salary_main_dates as $dates}
                                    <option value='{$dates.id}' {if $salary_main.id == $dates.id}selected="selected"{/if}>{$dates.effect_from}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div style="" class="pull-right">
                    {if $action == 'add'}<button onclick="save_form()" class="btn btn-default btn-normal btn-manage pull-right" tabindex="21" style="margin: 8px;" type="button">{$translate.save}</button>{/if}
                    {if $action != 'add'}
                        <button onclick="edit_form()" class="btn btn-default btn-normal btn-manage pull-right" tabindex="21" style="margin: 8px;" type="button">{$translate.save}</button>
                        <button onclick="delete_form()" class="btn btn-default btn-normal btn-manage pull-right" style="margin: 8px;" type="button">{$translate.delete}</button>
                    {/if}
                    {if $salary_main.effect_to == '0000-00-00' && $clone_action != 'clone'} 
                        <button onclick="clone_form()" class="btn btn-default btn-normal btn-manage pull-right" style="margin: 8px;" type="button">{$translate.clone}</button>
                    {/if}
                    <button onclick="back_button()" class="btn btn-default btn-normal btn-manage pull-right" style="margin: 8px;" type="button">{$translate.back}</button>
                    <button onclick="add_form()" class="btn btn-default btn-normal btn-manage pull-right" style="margin: 8px;" type="button">{$translate.add_new}</button>

                </div>
            </div>
        </div>



        {if $errormessage == 1}
            <div style="color:red;" align="center">{$translate.no_access_error_message} </div>
        {else}
              <div class="tab-content-con tab-content-con-companysetting boxscroll">
            <div class="span12 widget-body-section input-group">

                <form method="post" action="" name="globalsettingform" id="globalsettingform" class="no-mb" >
                    <input type="hidden" name="action" id="action" value="{$action}" />
                    <input type="hidden" name="selected" id="selected" value="" />

                    <div style="margin: 0px 0px 15px;" class="row-fluid">
                        <div class="span3 form-group-gray">
                            
                            <div style="margin: 0px 0px 5px;" class="span12">
                                <label style="float: left;" class="span12" for="efffect_from">{$translate.effect_from}</label>
                                <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-calendar"></span>
                                    <input placeholder="{$translate.effect_from}" class="form-control span11" type="text" value="{$salary_main.effect_from}" id="efffect_from" name="effect_from">
                                </div>
                            </div>
                            {if $salary_main.effect_to!= '0000-00-00' && $action != 'add'}  

                                <div style="margin: 0px 0px 5px;" class="span12">
                                    <label style="float: left;" class="span12" for="effect_to">{$translate.effect_to}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-calendar"></span>
                                        <input placeholder="{$translate.effect_to}" class="form-control span11" type="text" value="{$salary_main.effect_to}" id="effect_to" name="effect_to"/> 
                                    </div>
                                </div>  

                            {/if}
                            {if $clone_action == 'clone'}

                                <div style="margin: 0px 0px 5px;" class="span12">
                                    <label style="float: left;" class="span12" for="increment">{$translate.increment_percentage}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-calendar"></span>
                                        <input placeholder="{$translate.increment_percentage}" class="form-control span11 comma_dec" type="text" value="" id="increment" name="increment"/>%
                                    </div>
                                </div>  
                            {/if}

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="normal">{$translate.normal}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.normal}" type="text" id="normal" name="normal" class="form-control span11 comma_dec"  value="{$salary_main.normal}" tabindex="1"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="travel">{$translate.travel}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.travel}" class="form-control span11 comma_dec" type="text" value="{$salary_main.travel}" id="travel" name="travel" tabindex="2"> 
                                </div>
                            </div>




                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="wkend_travel">{$translate.week_end_travel}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.week_end_travel}" class="form-control span11 comma_dec" type="text" value="{$salary_main.week_end_travel}" id="wkend_travel" name="wkend_travel" tabindex="3"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="break">{$translate.break}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.break}" class="form-control span11 comma_dec" type="text" value="{$salary_main.break}" id="break" name="break" class="glob_inp" tabindex="4"> 
                                </div>
                            </div>
                        </div>
                        <div class="span3 form-group-gray">

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="overtime">{$translate.overtime}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.overtime}" class="form-control span11 comma_dec" type="text" value="{$salary_main.overtime}" id="overtime" name="overtime" tabindex="6"> 
                                </div>
                            </div> 

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="qual_overtime1">{$translate.qual_overtime}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.qual_overtime}" class="form-control span11 comma_dec" type="text" value="{$salary_main.quality_overtime}" id="qual_overtime" name="qual_overtime" class="glob_inp"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="more_time">{$translate.more_time}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.more_time}" class="form-control span11 comma_dec" type="text" value="{$salary_main.more_time}" id="more_time" name="more_time" tabindex="8"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="some_other_time">{$translate.some_other_time}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.some_other_time}" class="form-control span11 comma_dec" type="text" value="{$salary_main.some_other_time}" id="some_other_time" name="some_other_time" tabindex="9"> 
                                </div>
                            </div>

                        </div>
                        {if $salary_system == 3}   
                            <div class="span3 form-group-gray">

                                <div style="margin: 0px 0px 5px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="oncall">{$translate.oncall}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.oncall}" class="form-control span11 comma_dec" type="text" value="{$salary_main.oncall}" id="oncall" name="oncall" tabindex="5"> 
                                    </div>
                                </div> 


                                <div style="margin: 0px 0px 5px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="call_training">{$translate.call_training}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.call_training}" class="form-control span11 comma_dec" type="text" value="{$salary_main.call_training}" id="call_training" name="call_training" tabindex="11"> 
                                    </div>
                                </div> 


                                <div style="margin: 0px 0px 5px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="complementary_oncall">{$translate.complementary_oncall}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.complementary_oncall}" class="form-control span11 comma_dec" type="text" value="{$salary_main.complementary_oncall}" id="complementary_oncall" name="complementary_oncall" tabindex="15"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 5px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="more_oncall">{$translate.more_oncall}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.more_oncall}" class="form-control span11 comma_dec" type="text" value="{$salary_main.more_oncall}" id="more_oncall" name="more_oncall" tabindex="16"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 5px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="work_for_dismissal_oncall">{$translate.work_for_dismissal_oncall}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.work_for_dismissal_oncall}" class="form-control span11 comma_dec" type="text" value="{$salary_main.w_dismissal_oncall}" id="work_for_dismissal_oncall" name="work_for_dismissal_oncall" tabindex="16"> 
                                    </div>
                                </div>

                            </div>  
                        {/if}
                        <div class="span3 form-group-gray" style="">

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="training_time">{$translate.training_time}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.training_time}" class="form-control span11 comma_dec" type="text" value="{$salary_main.training_time}" id="training_time" name="training_time" tabindex="10"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="personal_meeting">{$translate.personal_meeting}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.personal_meeting}" class="form-control span11 comma_dec" type="text" value="{$salary_main.personal_meeting}" id="personal_meeting" name="personal_meeting" tabindex="12"> 
                                </div>
                            </div>

                        </div>
                    </div>
                                
                    <div class="row-fluid" style="margin: 0px 0px 15px;">
                        <div class="span3 form-group-gray" style="">
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="voluntary">{$translate.voluntary}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.voluntary}" class="form-control span11 comma_dec" type="text" value="{$salary_main.voluntary}" id="voluntary" name="voluntary" tabindex="13"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="complementary">{$translate.complementary}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.complementary}" class="form-control span11 comma_dec" type="text" value="{$salary_main.complementary}" id="complementary" name="complementary" tabindex="14"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="standby">{$translate.standby}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.standby}" class="form-control span11 comma_dec" type="text" value="{$salary_main.standby}" id="standby" name="standby" tabindex="17"> 
                                </div>
                            </div>

                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="work_for_dismissal">{$translate.work_for_dismissal}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.work_for_dismissal}" class="form-control span11 comma_dec" type="text" value="{$salary_main.w_dismissal}" id="work_for_dismissal" name="work_for_dismissal" tabindex="17"> 
                                </div>
                            </div>
                        </div>
                        <div class="span3 form-group-gray">
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="holiday_big">{$translate.holiday_big}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.holiday_big}" class="form-control span11 comma_dec" type="text" value="{$salary_main.holiday_big}" id="holiday_big" name="holiday_big" tabindex="18"> 
                                </div>
                            </div>
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="holiday_big_oncall">{$translate.holiday_big|cat:' '|cat:$translate.oncall}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.holiday_big|cat:' '|cat:$translate.oncall}" class="form-control span11 comma_dec" type="text" value="{$salary_main.holiday_big_oncall}" id="holiday_big_oncall" name="holiday_big_oncall" tabindex="18"> 
                                </div>
                            </div>
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="holiday_red">{$translate.holiday}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.holiday}" class="form-control span11 comma_dec"  type="text" value="{$salary_main.holiday_red}" id="holiday_red" name="holiday_red" tabindex="19"> 
                                </div>
                            </div>
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="holiday_red_oncall">{$translate.holiday|cat:' '|cat:$translate.oncall}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.holiday|cat:' '|cat:$translate.oncall}" class="form-control span11 comma_dec"  type="text" value="{$salary_main.holiday_red_oncall}" id="holiday_red_oncall" name="holiday_red_oncall" tabindex="19"> 
                                </div>
                            </div>
                            <div style="margin: 0px 0px 5px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="insurance">{$translate.global_setting_insurance_personal}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                    <input placeholder="{$translate.global_setting_insurance_personal}" class="form-control span11 comma_dec" type="text" value="{$salary_main.insurance}" id="insurance" name="insurance" tabindex="20"> 
                                </div>
                            </div>

                        </div>
                        {*if $ob_inconvenient_timings|count gt 0} 
                            <div class="span3 form-group-gray">
                                {foreach $ob_inconvenient_timings as $ob_inconv}
                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                        <label style="float: left;" class="span12">{$ob_inconv.name}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                            <input id="ob_inconv-{$ob_inconv.id}" name="ob_inconv[{$ob_inconv.id}]" value="{$ob_inconv.amount}" placeholder="{$ob_inconv.name}" class="form-control span11 comma_dec" type="text" /> 
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        {/if*}
                    </div>
                    
                    {if $ob_inconvenient_timings|count gt 0} 
                        <div class="row-fluid" style="margin: 0px 0px 15px;">
                            {foreach $ob_inconvenient_timings as $ob_inconv}
                                <div class="span3 form-group-gray no-padding">
                                    <div class="widget-header span12 pl pt">{$ob_inconv.name}</div>
                                    <div class="span12 no-ml fixed-body-height" style="padding: 10px;">

                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="ob_inconv-{$ob_inconv.id}_normal">{$ob_inconv.name}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="ob_inconv-{$ob_inconv.id}_normal" name="ob_inconv[{$ob_inconv.id}][normal]" value="{$ob_inconv.amount}" placeholder="{$ob_inconv.name}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div> 


                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="ob_inconv-{$ob_inconv.id}_training">{$translate.training_time}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="ob_inconv-{$ob_inconv.id}_training_time" name="ob_inconv[{$ob_inconv.id}][training_time]" value="{$ob_inconv.sal_call_training}" placeholder="{$translate.training_time}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div> 


                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="ob_inconv-{$ob_inconv.id}_complementary">{$translate.complementary}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="ob_inconv-{$ob_inconv.id}_complementary" name="ob_inconv[{$ob_inconv.id}][complementary]" value="{$ob_inconv.sal_complementary_oncall}" placeholder="{$translate.complementary}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div>

                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="ob_inconv-{$ob_inconv.id}_dismissal">{$translate.work_for_dismissal}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="ob_inconv-{$ob_inconv.id}_dismissal" name="ob_inconv[{$ob_inconv.id}][work_for_dismissal]" value="{$ob_inconv.sal_dismissal_oncall}" placeholder="{$translate.work_for_dismissal}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                    
                    {if $jour_inconvenient_timings|count gt 0} 
                        <div class="row-fluid">
                            {foreach $jour_inconvenient_timings as $jour_inconv}
                                <div class="span3 form-group-gray no-padding">
                                    <div class="widget-header span12 pl pt">{$jour_inconv.name}</div>
                                    <div class="span12 no-ml fixed-body-height" style="padding: 10px;">

                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="jour_inconv_{$jour_inconv.id}_oncall">{$translate.oncall}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="jour_inconv_{$jour_inconv.id}_oncall" name="jour_inconv[{$jour_inconv.id}][oncall]" value="{$jour_inconv.amount}" placeholder="{$translate.oncall}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div> 


                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="jour_inconv_{$jour_inconv.id}_call_training">{$translate.call_training}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="jour_inconv_{$jour_inconv.id}_call_training" name="jour_inconv[{$jour_inconv.id}][call_training]" value="{$jour_inconv.sal_call_training}" placeholder="{$translate.call_training}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div> 


                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="jour_inconv_{$jour_inconv.id}_complementary_oncall">{$translate.complementary_oncall}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="jour_inconv_{$jour_inconv.id}_complementary_oncall" name="jour_inconv[{$jour_inconv.id}][complementary_oncall]" value="{$jour_inconv.sal_complementary_oncall}" placeholder="{$translate.complementary_oncall}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div>

                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="jour_inconv_{$jour_inconv.id}_more_oncall">{$translate.more_oncall}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="jour_inconv_{$jour_inconv.id}_more_oncall" name="jour_inconv[{$jour_inconv.id}][more_oncall]" value="{$jour_inconv.sal_more_oncall}" placeholder="{$translate.more_oncall}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div>

                                        <div style="margin: 0px 0px 5px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="jour_inconv_{$jour_inconv.id}_dismissal_oncall">{$translate.work_for_dismissal_oncall}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                                <input id="jour_inconv_{$jour_inconv.id}_dismissal_oncall" name="jour_inconv[{$jour_inconv.id}][work_for_dismissal_oncall]" value="{$jour_inconv.sal_dismissal_oncall}" placeholder="{$translate.work_for_dismissal_oncall}" class="form-control span11 comma_dec" type="text"/> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                </form>
            </div>
        </div>
        {/if}
       
    </div>
</div>

{/block}



















