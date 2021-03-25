{block name='style'}
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.css" media="all" />
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.lozenge.css" media="all" />*}
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<style type="text/css">
        .scroll-pane, .scroll-pane-arrows {
                width: 100%;
                height: 200px;
                overflow: auto;
        }
        .horizontal-only {
                height: auto;
                max-height: 200px;
        }
</style>
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script  type="text/javascript">
$(document).ready(function(){
    

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
        $('.tab-content-con').css({ height: $(window).height()-271});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    
    $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
    });

    {if $clone == 'clone_n'} 	
    $("#increment").change(function(){
        var inc = $("#increment").val();
        if(inc != "" && inc != null){
            inc = parseFloat(inc);
            var normal = '{$normals.normal}';
            normal = parseFloat(normal);
            normal = normal + ((normal * inc)/100);
            $("#normal").val(parseFloat(normal).toFixed(2));

            var travel = '{$normals.travel}';
            travel = parseFloat(travel);
            travel = travel + ((travel * inc)/100);
            $("#travel").val(parseFloat(travel).toFixed(2));

            var breaks = '{$normals.break}';
            breaks = parseFloat(breaks);
            breaks = breaks + ((breaks * inc)/100);
            $("#break").val(parseFloat(breaks).toFixed(2));

            var oncall = '{$normals.oncall}';
            oncall = parseFloat(oncall);
            oncall = oncall + ((oncall * inc)/100);
            $("#oncall").val(parseFloat(oncall).toFixed(2));

            var overtime = '{$normals.overtime}';
            overtime = parseFloat(overtime);
            overtime = overtime + ((overtime * inc)/100);
            $("#overtime").val(parseFloat(overtime).toFixed(2));

            var qual_overtime = '{$normals.quality_overtime}';
            qual_overtime = parseFloat(qual_overtime);
            qual_overtime = qual_overtime + ((qual_overtime * inc)/100);
            $("#qual_overtime").val(parseFloat(qual_overtime).toFixed(2));

            var more_time = '{$normals.more_time}';
            more_time = parseFloat(more_time);
            more_time = more_time + ((more_time * inc)/100);
            $("#more_time").val(parseFloat(more_time).toFixed(2));

            var some_other_time = '{$normals.some_other_time}';
            some_other_time = parseFloat(some_other_time);
            some_other_time = some_other_time + ((some_other_time * inc)/100);
            $("#some_other_time").val(parseFloat(some_other_time).toFixed(2));

            var training_time = '{$normals.training_time}';
            training_time = parseFloat(training_time);
            training_time = training_time + ((training_time * inc)/100);
            $("#training_time").val(parseFloat(training_time).toFixed(2));

            var call_training = '{$normals.call_training}';
            call_training = parseFloat(call_training);
            call_training = call_training + ((call_training * inc)/100);
            $("#call_training").val(parseFloat(call_training).toFixed(2));

            var personal_meeting = '{$normals.personal_meeting}';
            personal_meeting = parseFloat(personal_meeting);
            personal_meeting = personal_meeting + ((personal_meeting * inc)/100);
            $("#personal_meeting").val(parseFloat(personal_meeting).toFixed(2));

            var holiday_big = '{$normals.holiday_big}';
            holiday_big = parseFloat(holiday_big);
            holiday_big = holiday_big + ((holiday_big * inc)/100);
            $("#holiday_big").val(parseFloat(holiday_big).toFixed(2));

            var holiday_big_oncall = '{$normals.holiday_big_oncall}';
            holiday_big_oncall = parseFloat(holiday_big_oncall);
            holiday_big_oncall = holiday_big_oncall + ((holiday_big_oncall * inc)/100);
            $("#holiday_big_oncall").val(parseFloat(holiday_big_oncall).toFixed(2));

            var holiday_red = '{$normals.holiday_red}';
            holiday_red = parseFloat(holiday_red);
            holiday_red = holiday_red + ((holiday_red * inc)/100);
            $("#holiday_red").val(parseFloat(holiday_red).toFixed(2));

            var holiday_red_oncall = '{$normals.holiday_red_oncall}';
            holiday_red_oncall = parseFloat(holiday_red_oncall);
            holiday_red_oncall = holiday_red_oncall + ((holiday_red_oncall * inc)/100);
            $("#holiday_red_oncall").val(parseFloat(holiday_red_oncall).toFixed(2));

            var insurance = '{$normals.insurance}';
            insurance = parseFloat(insurance);
            insurance = insurance + ((insurance * inc)/100);
            $("#insurance").val(parseFloat(insurance).toFixed(2));

        } else{
            var normal = '{$normals.normal}';
            $("#normal").val(normal);

            var travel = parseFloat('{$normals.travel}');
            $("#travel").val(travel);

            var breaks = '{$normals.break}';
            $("#break").val(breaks);

            var oncall = '{$normals.oncall}';
            $("#oncall").val(oncall);

            var overtime = '{$normals.overtime}';
            $("#overtime").val(overtime);

            var qual_overtime = '{$normals.quality_overtime}';
            $("#qual_overtime").val(qual_overtime);

            var more_time = '{$normals.more_time}';
            $("#more_time").val(more_time);

            var some_other_time = '{$normals.some_other_time}';
            $("#some_other_time").val(some_other_time);

            var training_time = '{$normals.training_time}';
            $("#training_time").val(training_time);

            var call_training = '{$normals.call_training}';
            $("#call_training").val(call_training);

            var personal_meeting = '{$normals.personal_meeting}';
            $("#personal_meeting").val(personal_meeting);

            var holiday_big = '{$normals.holiday_big}';
            $("#holiday_big").val(holiday_big);

            var holiday_big_oncall = '{$normals.holiday_big_oncall}';
            $("#holiday_big_oncall").val(holiday_big_oncall);

            var holiday_red = '{$normals.holiday_red}';
            $("#holiday_red").val(holiday_red);

            var holiday_red_oncall = '{$normals.holiday_red_oncall}';
            $("#holiday_red_oncall").val(holiday_red_oncall);

            var insurance = '{$normals.insurance}';
            $("#insurance").val(insurance);
        }
        
    });{/if}
    {if $clone == 'clone_i'} 
        $("#increment_i").blur(function(){
            var inc = $("#increment_i").val();
            if(inc != "" && inc != null){
                inc = parseFloat(inc);
                {assign i 1}
                {foreach $inconvs as $inconv}
                    var insurance = $('#amt_{$i}').val();
                    insurance = parseFloat(insurance);
                    insurance = insurance + ((insurance * inc)/100);
                    $('#amt_{$i}').parent('.td_raw').children(".amount").val(parseFloat(insurance).toFixed(2));
                   {assign i $i+1}
                {/foreach}
            }else{
            {assign i 1}
                {foreach $inconvs as $inconv}
                    var insurance = $('#amt_{$i}').val();
                    $('#amt_{$i}').parent('.td_raw').children(".amount").val(parseFloat(insurance).toFixed(2));
                   {assign i $i+1}
                {/foreach}
            }
        });
    {/if}
     //$("#inconv").hide();
    var hides = '{$hides}';
    if(hides == 'n'){
       $('.worker_left').hide(); 
       $('#relative_list').hide(); 
       $('#information').show(); 
    }else if(hides == 'i'){
       $('#information').hide();
       $('#relative_list').hide(); 
       $('.worker_left').show();
    }else if(hides == 'm'){
       $('#information').hide();
       $('.worker_left').hide();
       $('#relative_list').show(); 
    }else{
        $('#information').show();
       $('.worker_left').show();
       $('#relative_list').show(); 
    }
    /*$( "#effect_from,#effect_to,#effect_from_normal,#effect_to_normal,#effect_to_monthly,#effect_from_monthly" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
    });*/
    $( "#effect_from" ).change(function(){
        //loadInconvTimes();
    });
    
});


function loadInconvTimes(){
    var effect_from = $("#effect_from").val();
    var effect_to = $("#effect_to").val();
    $.ajax({
        url:"{$url_path}ajax_select_inconvenient_times.php",
        type:"GET",
        data:"effect_from="+effect_from+"&effect_to="+effect_to,
        success:function(data){
            $("#inconv").html(data);
        }
    });
}

function saveForm(){
    var error = 0;
    var effect_from_inconv = $("#effect_from").val();
    var effect_to_inconv = $("#effect_to").val();
    var effect_from_inconv_old = $("#effect_from_inconv_old").val();
    var effect_from_normal = $("#effect_from_normal").val();
    var effect_to_normal = $("#effect_to_normal").val();
    var effect_from_normal_old = $("#effect_from_normal_old").val();
    var effect_from_monthly = $("#effect_from_monthly").val();
    var effect_to_monthly = $("#effect_to_monthly").val();
    var hides = '{$hides}';
//alert(effect_from_inconv+"  "+effect_from_inconv_old+ "  "+effect_from_normal+"  "+effect_from_normal_old);
    if(effect_from_inconv < effect_from_inconv_old && hides == 'i'){
        alert("{$translate.inconv_effect_from_greater}");
        error = 1;
    }
    if(effect_from_normal < effect_from_normal_old && hides == 'n'){
        alert("{$translate.normal_effect_from_greater}");
        error = 1;
    }
    if(effect_to_monthly < effect_from_monthly && effect_to_monthly != '0000-00-00' && effect_to_monthly != '' && hides == 'm'){
        alert("{$translate.monthly_effect_to_greaterthan}");
        error = 1;
    }
    if(hides == 'm' && (effect_from_monthly == null || effect_from_monthly == "")){
        alert("{$translate.enter_effect_from}");
        error = 1;
    }
    if(hides == 'n' && (effect_from_normal == null || effect_from_normal == "")){
        alert("{$translate.enter_effect_from}");
        error = 1;
    }
    if(hides == 'i' && (effect_from_inconv == null || effect_from_inconv == "")){
        alert("{$translate.enter_effect_from}");
        error = 1;
    }
    if(effect_to_inconv < effect_from_inconv && effect_to_inconv != '0000-00-00' && effect_to_inconv != '' && hides == 'i'){
        alert("{$translate.inconv_effect_to_greaterthan}");
        error = 1;
    }
    if(effect_to_normal < effect_from_normal && effect_to_normal != '0000-00-00' && effect_to_normal != '' && hides == 'n'){
        alert("{$translate.normal_effect_to_greaterthan}");
        error = 1;
    }
    if(error == 0){
        $("#form").submit();
    }
   // $("#form").submit();
}

function backForm() {
    document.location.href = '{$url_path}employee/list/salary/{$employee_username}/';
}

function makeChange(){
    $("#new").val('1');
}

function loadAddEmployee(){
    var change = $("#new").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

function loadContract(){
    var change = $("#new").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

function loadNotification(){
    var change = $("#new").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

function loadPrivilege(){
    var change = $("#new").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}
function loadPrifferedTime(){
    var change = $("#new").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

</script>
{/block}

{block name="content"}
    {if $access_flag == 1}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px;">
        <p><span class="error_msg_icon" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
    </div>
    <div id="dialog-confirm_delete" title="{$translate.confirm}" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_delete}</p> 
    </div>
    <div class="clearfix" id="dialog_popup" style="display:none;"></div>
    <div class="clearfix" id="dialog_hidden" style="display:none;"></div>

    <div class="row-fluid">
        <div class="span12 main-left boxscroll">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.employee_profile}</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                {if $employee_username != ""}
                    <div class="widget option-panel-widget" style="margin: 0 !important;">
                        <div class="widget-body">
                            <div class="row-fluid">
                                <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{$employee_detail[0].social_security}</div>
                                <div class="span4 top-customer-info"><strong>{$translate.code} : </strong>{$employee_detail[0].code}</div>
                                {if $sort_by_name == 2}
                                    <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{$employee_detail[0].last_name|cat: ' '|cat: $employee_detail[0].first_name}</div>
                                {elseif $sort_by_name == 1}
                                    <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{$employee_detail[0].first_name|cat: ' '|cat: $employee_detail[0].last_name}</div>
                                {/if}
                            </div>
                        </div>
                    </div>
                {/if}
                
                
                 <div class="row-fluid">
                <div class="span12">
                  <div class="tab-content-switch-con" >
                    {if $employee_username != ""} 
                        <div class="span12">
                            <div style="display: none;" class="scroller scroller-left"><span class="icon-chevron-left"></span></div>
                            <div style="display: none;" class="scroller scroller-right"><span class="icon-chevron-right"></span></div>
                            <div style="margin: 0px ! important;" class="wrapper">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs list" role="tablist" id="myTab" style="left:0 !important;">
                                    {if $user_roles_login neq 3 and $user_roles_login neq 4}<li role="presentation"><a href="javascript:void(0)" onclick="loadAddEmployee()">{$translate.employee_profile}</a></li>{/if}
                                    {if $privilege_general.employee_settings_contract eq 1}<li role="presentation"><a href="javascript:void(0)" onclick="loadContract()">{$translate.employee_contract}</a></li>{/if}
                                    {if $privilege_general.employee_settings_salary eq 1}<li role="presentation" class="active"><a href="javascript:void(0)" onclick="loadSalary()">{$translate.salary}</a></li>{/if}
                                    {if $privilege_general.employee_settings_notification eq 1}<li role="presentation"><a href="javascript:void(0)" onclick="loadNotification()">{$translate.employee_notification}</a></li>{/if}
                                    {if $privilege_general.employee_settings_privileges eq 1 and $employee_role != 1}<li class="" role="presentation"><a href="javascript:void(0)" onclick="loadPrivilege()">{$translate.employee_previlege}</a></li>{/if}
                                    {if $privilege_general.employee_settings_cv eq 1}<li role="presentation"><a href="javascript:void(0)" onclick="loadSkills()">{$translate.skills}</a></li>{/if}
                                    {if $privilege_general.employee_settings_documentation eq 1}<li role="presentation"><a href="javascript:void(0)" onclick="loadDocumentation()">{$translate.documentation}</a></li>{/if}
                                    {if $privilege_general.employee_settings_preference eq 1}<li role="presentation"><a href="javascript:void(0)" onclick="loadPrifferedTime()">{$translate.employee_preferredtime}</a></li>{/if}
                                </ul>
                            </div>
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                          <h1>{$translate.employee_profile}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                      <button class="btn btn-default btn-normal span2 pull-right" type="button" onclick="saveForm()">{$translate.save}</button>
                                        <button class="btn btn-default btn-normal span2 pull-right" type="button" onclick="backForm()">{$translate.backs}</button>
                                     </div>
                                </div>
                        </div>
                        {/if}
                    </div>
                      <div class="tab-content-con boxscroll">
                        <div class="tab-content span12" style="margin:0;">
                        <div role="tabpanel" class="tab-pane active">
                        <form id="form" name="form" method="post" action="" style="float:left; width:100%;">
                        <input type="hidden" name="user_id" id="user_id" value="{$employee_detail[0].username}" />
                        <input type="hidden" name="cur_role" id="cur_role" value="{$employee_role}" />
                        <input type="hidden" name="new" id="new" value="0" />
                        <input type="hidden" name="action" id="action" value="{$action}" />
                        <input type="hidden" name="clone_type" id="clone_type" value="{$clone}" />
                        <div class="tab-content span12" style="margin:0;">
                            <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
                            <!--////////////////////////////////////////TAB 1 BEGIN///////////////////////////////////////////////-->
                        
                                <div class="span12 widget-body-section input-group">
                                    <div class="row-fluid">
                                        <div class="span4 worker_left" {if $employee_username != ""}id="employee_tab_content_emp"{else}id="employee_tab_content" {/if}>
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1>{$translate.inconvenient_salaries}</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from">{$translate.effect_from}</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from" id="effect_from" type="text" onchange="makeChange()" {if $clone == 'clone_i'} value="{$effect_from}"{else}value="{$effects.effect_from}"{/if} /> 
                                                        </div>
                                                        <input type="hidden" name="effect_from_inconv_old"   style="width: 40%" id="effect_from_inconv_old" value="{$effects.effect_from}" onchange="makeChange()"/>
                                                    </div>
                                                    {if $action == 'edit' && $effects.effect_to != "0000-00-00"}   
                                                        <div style="margin: 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to">{$translate.effect_to}</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span11" name="effect_to" id="effect_to" type="text" {if $clone == 'clone_i'} {if $effect_to == '0000-00-00'}value ="" {else}value="{$effect_to}"{/if}{else} {if $effects.effect_to == '0000-00-00'}value="" {else}value="{$effects.effect_to}"{/if} {/if} onchange="makeChange()" /> 
                                                            </div>
                                                            <input type="hidden" name="effect_to_inconv_old"  id="effect_to_inconv_old" style="width: 40%" {if $clone == 'clone_i'} value="{$effect_to}" {else}value="{$effects.effect_to}"{/if}  onchange="makeChange()"/>
                                                        </div>
                                                    {/if}
                                                    {if $clone == 'clone_i'}
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="amount">{$translate.increment}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> 
                                                                <span class="add-on icon-pencil"></span>
                                                                <input value="" class="form-control span11" name="increment_i" id="increment_i" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    {/if}
                                                    {assign inc 1}
                                                    {foreach $inconvs as $inconv}
                                                        {if $inconv.type == 3}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.amount}" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.amount}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.call_training}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_call_training}" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_call_training}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="care_of">{$inconv.name} {$translate.complementary_oncall}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_complementary_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_complementary_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.more_oncall}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_more_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_more_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.work_for_dismissal_oncall}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_dismissal_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_dismissal_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                        {else}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.amount}" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.amount}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.training_time}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_call_training}" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_call_training}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="care_of">{$inconv.name} {$translate.complementary}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_complementary_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_complementary_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12 hide">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.more_time}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_more_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_more_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount">{$inconv.name} {$translate.work_for_dismissal}</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="{$inconv.sal_dismissal_oncall}" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="{$inconv.inconvenient_group_id}" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="{$inconv.id_i}"/>
                                                                    <input type="hidden" name="amt_{$inc}" id="amt_{$inc}" value="{$inconv.sal_dismissal_oncall}"/>
                                                                </div>
                                                            </div>
                                                            {assign inc $inc+1}
                                                        {/if}
                                                    {/foreach}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4"  id="information">
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1>{$translate.hourly_salary}</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from">{$translate.effect_from}</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from_normal" id="effect_from_normal" type="text" onchange="makeChange()" {if $clone == 'clone_n'} value="{$effect_from_normal}"{else} value="{$normals.effect_from}" {/if} /> 
                                                        </div>
                                                        <input type="hidden" name="effect_from_normal_old"   style="width: 40%" id="effect_from_normal_old"   value="{$normals.effect_from}"  onchange="makeChange()"/>
                                                    </div>
                                                    {if $action == 'edit' && $normals.effect_to != '0000-00-00'}
                                                        <div style="margin: 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to_normal">{$translate.effect_to}</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span11" name="effect_to_normal" id="effect_to_normal" type="text" {if $clone == 'clone_n'} {if $effect_to_normal == '0000-00-00'} value=""{else}value="{$effect_to_normal}"{/if} {else}{if $normals.effect_to == '0000-00-00'}value=""{else} value="{$normals.effect_to}" {/if}{/if} onchange="makeChange()" /> 
                                                            </div>
                                                            <input type="hidden" name="effect_to_normal_old"  id="effect_to_normal_old" style="width: 40%"  value="{$normals.effect_to}"   onchange="makeChange()"/>
                                                        </div>
                                                    {/if}
                                                    {if $clone == 'clone_n'}
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="amount">{$translate.increment}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> 
                                                                <span class="add-on icon-pencil"></span>
                                                                <input value="" class="form-control span11" name="increment" id="increment" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    {/if}
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="normal">{$translate.normal}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.normal}" class="form-control span11 comma_dec" name="normal" id="normal" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="travel">{$translate.travel}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.travel}" class="form-control span11 comma_dec" name="travel" id="travel" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="wkend_travel">{$translate.week_end_travel}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.week_end_travel}" class="form-control span11 comma_dec" id="wkend_travel" name="wkend_travel" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="break">{$translate.break}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.break}" class="form-control span11 comma_dec" id="break" name="break" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="overtime">{$translate.overtime}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.overtime}" class="form-control span11 comma_dec" id="overtime" name="overtime" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="qual_overtime">{$translate.qual_overtime}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.quality_overtime}" class="form-control span11 comma_dec" id="qual_overtime" name="qual_overtime" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="more_time">{$translate.more_time}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.more_time}" class="form-control span11 comma_dec" id="more_time" name="more_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="some_other_time">{$translate.some_other_time}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.some_other_time}" class="form-control span11 comma_dec" id="some_other_time" name="some_other_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="training_time">{$translate.training_time}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.training_time}" class="form-control span11 comma_dec" id="training_time" name="training_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    {if $salary_system == 3}
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="call_training">{$translate.call_training}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="{$normals.call_training}" class="form-control span11 comma_dec" id="call_training" name="call_training" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    {/if}
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="personal_meeting">{$translate.personal_meeting}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.personal_meeting}" class="form-control span11 comma_dec" id="personal_meeting" name="personal_meeting" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="voluntary">{$translate.voluntary}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.voluntary}" class="form-control span11 comma_dec" id="voluntary" name="voluntary" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div> 
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="complementary">{$translate.complementary}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.complementary}" class="form-control span11 comma_dec" id="complementary" name="complementary" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    {if $salary_system == 3}
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="complementary_oncall">{$translate.complementary_oncall}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="{$normals.complementary_oncall}" class="form-control span11 comma_dec" id="complementary_oncall" name="complementary_oncall" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="more_oncall">{$translate.more_oncall}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="{$normals.more_oncall}" class="form-control span11 comma_dec" id="more_oncall" name="more_oncall" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    {/if}
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="standby">{$translate.standby}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.standby}" class="form-control span11 comma_dec" id="standby" name="standby" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="work_for_dismissal">{$translate.work_for_dismissal}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.w_dismissal}" class="form-control span11 comma_dec" id="work_for_dismissal" name="work_for_dismissal" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="work_for_dismissal_oncall">{$translate.work_for_dismissal_oncall}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.w_dismissal_oncall}" class="form-control span11 comma_dec" id="work_for_dismissal_oncall" name="work_for_dismissal_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_big">{$translate.holiday_big}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.holiday_big}" class="form-control span11 comma_dec" id="holiday_big" name="holiday_big" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_big_oncall">{$translate.holiday_big|cat:' '|cat:$translate.oncall}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.holiday_big_oncall}" class="form-control span11 comma_dec" id="holiday_big_oncall" name="holiday_big_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_red">{$translate.holiday}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.holiday_red}" class="form-control span11 comma_dec" id="holiday_red" name="holiday_red" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_red_oncall">{$translate.holiday|cat:' '|cat:$translate.oncall}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.holiday_red_oncall}" class="form-control span11 comma_dec" id="holiday_red_oncall" name="holiday_red_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="amount">{$translate.global_setting_insurance_personal}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$normals.insurance}" class="form-control span11 comma_dec" id="insurance" name="insurance" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4"  id="relative_list">
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1>{$translate.monthly_salary}</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from_monthly">{$translate.effect_from}</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from_monthly" id="effect_from_monthly" type="text" onchange="makeChange()" value="{$monthly.date_from}" /> 
                                                        </div>
                                                    </div>
                                                    {if $action == 'edit' && $monthly.date_to != null}
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to_monthly">{$translate.effect_to}</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="{$monthly.date_to}" class="form-control span11" id="effect_to_monthly" name="effect_to_monthly" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    {/if}
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="" for="is_monthly_sal">{$translate.is_monthly_salary}</label>
                                                        <div style="float: left; margin: 0px; text-align: left;" class="pl pt">
                                                            <input style="float: left;" class="form-control" type="checkbox" name="is_monthly_sal" id="is_monthly_sal" value="1" {if $monthly_sals == 1}checked="checked"{/if} />
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="salary_per_month">{$translate.salary_per_month}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="{$monthly.salary_per_month}" class="form-control span11 comma_dec" id="salary_per_month" name="salary_per_month" type="text" /> 
                                                        </div>
                                                    </div>
                                                </div>
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
    {else}
        <div class="message fail">{$translate.permission_denied}</div>      
    {/if}
{/block}