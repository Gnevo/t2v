{block name='script'}
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
$(document).ready(function (){
     
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-271});
    else
        $('.tab-content-con').css({ height: $(window).height()});
});
    
function warning_delete(){
    bootbox.dialog('Do you want to delete the current salary', [{
        label : "{$translate.no}",
        class : "btn-danger",
        callback: function() {
                bootbox.hideAll();
                return false;
            }
        }, {
        label : "{$translate.yes}",
        class : "btn-success",
        callback: function() {
                bootbox.hideAll();
                return true;
            }
    }]);
}

function submit_form(){
    $('#forms').submit();
}
function backForm(){
    //document.location.href = "{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/";
    //document.referrer;
    //history.go(-1)
    window.history.back();
} 
function makeChange(){
    $("#new").val('1');
    
}

function redirectConfirm(mode){
        var change = $("#new").val();
        var redirectURL = mode.replace("%%C-UNAME%%", "{$employee_username}");
        if(redirectURL != ''){
            if(change == 1){
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
                                    document.location.href = redirectURL;
                            }
                        }
                });
            }
            else{
                document.location.href = redirectURL;
            }
        }
    }

/*function loadAddEmployee(){
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

function loadSalary(){
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
                                document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

function loadSkills(){
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
                                document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}

function loadDocumentation(){
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
                                document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
        }
        else{
            document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
        }
}*/

function delete_monthly(emp,ids){

    bootbox.dialog('{$translate.do_you_want_delete}', [{
        label : "{$translate.no}",
        class : "btn-danger",
        callback: function() {
                bootbox.hideAll();
            }
        }, {
        label : "{$translate.yes}",
        class : "btn-success",
        callback: function() {
                bootbox.hideAll();
                document.location.href = '{$url_path}employee/list/salary/'+emp+'/delete/'+ids+'/m/';
            }
    }]);
}
function delete_inconv(emp,ids){

    bootbox.dialog('{$translate.do_you_want_delete}', [{
        label : "{$translate.no}",
        class : "btn-danger",
        callback: function() {
                bootbox.hideAll();
            }
        }, {
        label : "{$translate.yes}",
        class : "btn-success",
        callback: function() {
                bootbox.hideAll();
                document.location.href = '{$url_path}employee/list/salary/'+emp+'/delete/'+ids+'/i/';
            }
    }]);
}
function delete_normal(emp,ids){

    bootbox.dialog('{$translate.do_you_want_delete}', [{
        label : "{$translate.no}",
        class : "btn-danger",
        callback: function() {
                bootbox.hideAll();
            }
    }, {
        label : "{$translate.yes}",
        class : "btn-success",
        callback: function() {
                bootbox.hideAll();
                document.location.href = '{$url_path}employee/list/salary/'+emp+'/delete/'+ids+'/n/';
            }
    }]);
}
function add_new_sal_both() {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/new/both/';
}
function edit_sal_detail(id) {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/edit/' + id + '/m/';
}
function add_new_monthly_sal() {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/new/m/';
}
function add_new_ord_sal() {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/new/n/';
}
function add_new_incon_sal() {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/new/i/';
}
function new_sal_clone(id) {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/clone/' + id + '/n/';
}
function new_sal_incon_clone(id) {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/clone/' + id + '/i/';
}
function new_sal_edit_details(id) {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/edit/' + id + '/n/';
}
function new_sal_incon_edit_details(id) {
    document.location.href = '{$url_path}employee/salary/{$employee_username}/edit/' + id + '/i/';
}
</script>
{/block}
{block name="content"}
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
                    <div class="widget option-panel-widget" style="margin: 0px !important;">
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
                            {block name="employee_manage_tab_content"}{/block}
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.salary}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick='backForm()'><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="add_new_sal_both()"><span class="icon-plus"></span> {$translate.add_new}</button>
                                 </div>
                                </div>
                        </div>
                        </div>
                    {/if}
                    <div class="tab-content-con boxscroll">
                              <div class="tab-content span12" style="margin:0;">
                        <div role="tabpanel" class="tab-pane active" id="tab-3">
                            <form action="" method="post" id="forms" name="forms" style="float:left;" class="pull-left span12">
                        {if $employee_normal_dates || $employee_inconvenient_dates || $employee_monthly_dates}
                        
                            <div style="" class="span12 widget-body-section input-group">
                                <div class="row-fluid"></div>
                                <div class="row-fluid">
                                    <div style="padding: 5px;" class="widget-header span12">
                                      
                                        <div class="span4">
                                        <div class="row-fluid">
                                        	<div class="span4">
                                            <label style="float: left;"  for="monthly_select">{$translate.monthly_effect_from}</label>
                                            </div>
                                            <div class="span7">
                                             <div style="margin: 0px; float: left;" class="input-prepend span11">
                                                <span class="add-on icon-pencil"></span>
                                                <select class="form-control span12" onchange="submit_form()" name="monthly_select">
                                                    <option value="0">{$translate.select}</option>
                                                    {foreach $employee_monthly_dates as $dates}
                                                        <option value="{$dates.salaryId}" {if $monthly_last_id == $dates.salaryId}selected="selected"{/if}>{$dates.date_from}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                          </div>
                                           </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="pull-right day-slot-wrpr-header-left span7" >
                                            <button class="btn btn-default btn-normal pull-right ml"  type="button" onclick="add_new_monthly_sal()"><span class="icon-plus"></span>  {$translate.add_new_monthly_sal}</button>
                                            <button class="btn btn-default btn-normal pull-right"  type="button" onclick="edit_sal_detail('{$monthly_salaries.salaryId}')"><span class="icon-edit"></span> {$translate.edit}</button>
                                            <button class="btn btn-default btn-normal pull-right"  type="button" onclick="delete_monthly('{$employee_username}','{$monthly_salaries.salaryId}')"><span class="icon-trash"></span> {$translate.delete}</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin: 0px;" class="span12">
                                    <div style="margin: 0px 0 10px 0 !important;" class="widget">
                                        <!--WIDGET BODY BEGIN-->
                                        <div class="span12 widget-body-section" style="padding: 0 ! important;">
                                            <div style="position: relative; overflow: visible;" class="mCustomScrollbar _mCS_4 mCS_no_scrollbar" data-mcs-theme="minimal">
                                                <div tabindex="0" id="mCSB_4" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside">
                                                    <div id="mCSB_4_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin:0;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="thead-light table-col-center"></th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_from}</th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_to}</th>
                                                                    <th class="thead-light table-col-center">{$translate.salary}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="table-col-center"></td>
                                                                    <td class="table-col-center">{$monthly_salaries.date_from}</td>
                                                                    <td class="table-col-center">{if $monthly_salaries.date_to == null}{if $monthly_salaries.date_from != null}---{/if}{else}{$monthly_salaries.date_to}{/if}</td>
                                                                    <td class="table-col-center">{$monthly_salaries.salary_per_month}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin: 0px;" class="span12">
                                    <div style="padding: 5px;" class="widget-header span12">
                                        <div class="day-slot-wrpr-header-left pull-right">
                                            {if $employee_normal_dates}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="delete_normal('{$employee_username}','{$normal_salaries.id}')"><span class="icon-trash"></span> {$translate.delete}</button>
                                                {if $normal_salaries.effect_to == '0000-00-00'} 
                                                    <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="new_sal_clone('{$normal_salaries.id}')"><span class="icon-shield"></span> {$translate.clone}</button>
                                                {/if}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="new_sal_edit_details('{$normal_salaries.id}')"><span class="icon-edit"></span> {$translate.edit}</button>
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="add_new_ord_sal()"><span class="icon-plus"></span> {$translate.add_new_ord_sal}</button>
                                                <div style="float: left;margin-right: 3px;"><span>{$translate.normal_effect_from} </span>
                                                    <select class="form-control" onchange="submit_form()" name="normal_select">
                                                        <option value="0">{$translate.select}</option>
                                                        {foreach $employee_normal_dates as $dates}
                                                            <option value="{$dates.id}" {if $normal_last_id == $dates.id}selected="selected"{/if}>{$dates.effect_from}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            {else}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal span12" type="button" onclick="add_new_ord_sal()">{$translate.add_new_ord_sal}</button>
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="widget" style="margin-top: 0px; margin-bottom: 0px ! important;">
                                        <!--WIDGET BODY BEGIN-->
                                        <div class="span12 widget-body-section" style="padding: 0 ! important;">
                                            <div style="position: relative; overflow: visible;" class="mCustomScrollbar _mCS_6 mCS_no_scrollbar" data-mcs-theme="minimal">
                                                <div tabindex="0" id="mCSB_6" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside">
                                                    <div id="mCSB_6_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin:0;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="thead-light table-col-center">{$translate.type}</th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_from}</th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_to}</th>
                                                                    <th class="thead-light table-col-center">{$translate.salary}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{$translate.normal}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.normal}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.travel}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.travel}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.week_end_travel}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.week_end_travel}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.break}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.break}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.overtime}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.overtime}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.qual_overtime}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.quality_overtime}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.more_time}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.more_time}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.some_other_time}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.some_other_time}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.training_time}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.training_time}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.call_training}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.call_training}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.personal_meeting}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.personal_meeting}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.personal_meeting}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.personal_meeting}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.voluntary}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.voluntary}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.complementary}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.complementary}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.complementary_oncall}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.complementary_oncall}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.more_oncall}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.more_oncall}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.standby}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.standby}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.work_for_dismissal}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.w_dismissal}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.work_for_dismissal_oncall}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.w_dismissal_oncall}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.holiday_big}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.holiday_big}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.holiday_big|cat:' '|cat:$translate.oncall}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.holiday_big_oncall}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.holiday}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.holiday_red}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.holiday|cat:' '|cat:$translate.oncall}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.holiday_red_oncall}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{$translate.global_setting_insurance_personal}</td>
                                                                    <td>{$normal_salaries.effect_from}</td>
                                                                    <td>{if $normal_salaries.effect_to == '0000-00-00'}---{else}{$normal_salaries.effect_to}{/if}</td>
                                                                    <td>{$normal_salaries.insurance}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>              
                                
                                <div style="margin: 10px 0 0 0;" class="span12">
                                    <div style="padding: 5px;" class="widget-header span12">
                                        <div class="day-slot-wrpr-header-left pull-right">
                                            {if $employee_inconvenient_dates}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="delete_inconv('{$employee_username}','{$inconvenient_salaries[0]['id_i']}')"><span class="icon-trash"></span> {$translate.delete}</button>
                                                {if $normal_salaries.effect_to == '0000-00-00'} 
                                                    <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="new_sal_incon_clone('{$inconvenient_salaries[0]['id_i']}')"><span class="icon-shield"></span> {$translate.clone}</button>
                                                {/if}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="new_sal_incon_edit_details({$inconvenient_salaries[0]['id_i']})"><span class="icon-edit"></span> {$translate.edit}</button>
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal" type="button" onclick="add_new_incon_sal()"><span class="icon-plus"></span> {$translate.add_new_inconv_sal}</button>
                                                <div style="float: left;margin-right: 3px;"><span>{$translate.inconv_effect_from} </span>
                                                    <select class="form-control" onchange="submit_form()" name="inconv_select">
                                                        <option value="0">{$translate.select}</option>
                                                        {foreach $employee_inconvenient_dates as $dates}
                                                            <option value="{$dates.id}" {if $inconv_last_id == $dates.id}selected="selected"{/if}>{$dates.effect_from}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            {else}
                                                <button style="margin: 0px ! important;" class="btn btn-default btn-normal span12" type="button" onclick="add_new_incon_sal()">{$translate.add_new_inconv_sal}</button>
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="widget" style="margin-top: 0px; margin-bottom: 0px ! important;">
                                        <!--WIDGET BODY BEGIN-->
                                        <div class="span12 widget-body-section" style="padding: 0 ! important;">
                                            <div style="position: relative; overflow: visible;" class="mCustomScrollbar _mCS_6 mCS_no_scrollbar" data-mcs-theme="minimal">
                                                <div tabindex="0" id="mCSB_6" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside">
                                                    <div id="mCSB_6_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin:0;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="thead-light table-col-center">{$translate.inconvenient}</th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_from}</th>
                                                                    <th class="thead-light table-col-center">{$translate.effect_to}</th>
                                                                    <th class="thead-light table-col-center">{$translate.salary}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {foreach $inconvenient_salaries as $inconv}
                                                                    {if $inconv.type == 3 || $inconv.type == '3'}
                                                                        <tr>
                                                                            <td>{$inconv.name}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.amount}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.call_training}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_call_training}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.complementary_oncall}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_complementary_oncall}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.more_oncall}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_more_oncall}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.work_for_dismissal_oncall}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_dismissal_oncall}</td>
                                                                        </tr>
                                                                    {else}
                                                                        <tr>
                                                                            <td>{$inconv.name}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.amount}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.training_time}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_call_training}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.complementary}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_complementary_oncall}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{$inconv.name} {$translate.work_for_dismissal}</td>
                                                                            <td>{$effects.effect_from}</td>
                                                                            <td>{if $effects.effect_to == '0000-00-00'}---{else}{$effects.effect_to}{/if}</td>
                                                                            <td>{$inconv.sal_dismissal_oncall}</td>
                                                                        </tr>
                                                                    {/if}
                                                                {/foreach}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        {else}
                            <div role="tabpanel" class="tab-pane active" id="tab-3">
                                <div class="widget-header span12">
                                    <div class="span4 day-slot-wrpr-header-left span6">
                                        <h1>{$translate.salary}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span3" style="margin: 5px 0px 0px;">
                                        <button class="btn btn-default btn-normal span12" type="button" onclick="add_new_sal_both()">{$translate.add_new}</button>
                                    </div>
                                </div>
                                <div class="message fail">{$translate.no_alary_added}</div>
                            </div>
                        {/if}
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}