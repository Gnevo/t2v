{block name='style'}
{/block}

{block name='script'} 
<script language="javascript">
function saveForm(){
    $("#action").val("save");
     $("#forms").submit();
}
$(document).ready(function () {
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-271});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    
    nofifyLeave();
    
    $("#sjuk_mob").attr("checked", true);
    $("#sjuk_mail").attr("checked", true);
    $("#sjuk_mob").attr("disabled", true);
    $("#sjuk_mail").attr("disabled", true);
    
    $(".side_links li a").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
        var new_var = $("#change").val();
        if(new_var == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = href_val;
                        }
                    }
            });
        }
        else{
            document.location.href = href_val;
        }
     });
    
});
function nofifyLeave(){
    var mobile = $("#phone").val();
    var mails = $("#mails").val();
     if ($('#phone').attr('checked')) {     
        $("#sjuk_mob").attr("checked", true); 
        $("#sjuk_mob").attr("disabled", true);
        $("#sjuk_mob").show();
        $("#sem_mob").show(); 
        $("#vab_mob").show();
        $("#fp_mob").show();
        $("#pmote_mob").show();
        $("#utbild_mob").show();
        $("#byte_mob").show();
        $("#atl_mob").show();
        $("#emp_overtime_mob").show();
        $("#cust_overtime_mob").show(); 
        $("#ovright_mob").show();
        $("#leave_permission_mob").show();
        //$("#sem_mob").show();        
    }
    else{
        //$("#sjuk_mob").attr("checked", false);
        $("#sjuk_mob").hide();
        //$("#sem_mob").attr("checked", false);
        $("#sem_mob").hide(); 
        //$("#vab_mob").attr("checked", false);
        $("#vab_mob").hide();
        //$("#fp_mob").attr("checked", false);
        $("#fp_mob").hide();
        //$("#pmote_mob").attr("checked", false);
        $("#pmote_mob").hide();
        //$("#utbild_mob").attr("checked", false);
        $("#utbild_mob").hide();
        //$("#byte_mob").attr("checked", false);
        $("#byte_mob").hide();
        $("#atl_mob").hide();
        $("#emp_overtime_mob").hide();
        $("#cust_overtime_mob").hide();
        //$("#ovright_mob").attr("checked", false);
        $("#ovright_mob").hide();
        $("#leave_permission_mob").hide();
    }
     if ($('#mails').attr('checked')) {
        $("#sjuk_mail").attr("checked", true);
        $("#sjuk_mail").attr("disabled", true);
        $("#sjuk_mail").show();
        $("#sem_mail").show(); 
        $("#vab_mail").show();
        $("#fp_mail").show();
        $("#pmote_mail").show();
        $("#utbild_mail").show();
        $("#byte_mail").show();
        $("#atl_mail").show();
        $("#emp_overtime_mail").show();
        $("#cust_overtime_mail").show();
        $("#ovright_mail").show(); 
        $("#leave_permission_mail").show();
        $("#employee_profile_mail").show();
        $("#customer_profile_mail").show();
        $("#employee_non_preferred_time_mail").show(); 
        $("#employee_contract_mail").show(); 
    }
    else{
        //$("#sjuk_mail").attr("checked", false);
        $("#sjuk_mail").hide();
        //$("#sem_mail").attr("checked", false);
        $("#sem_mail").hide(); 
        //$("#vab_mail").attr("checked", false);
        $("#vab_mail").hide();
        //$("#fp_mail").attr("checked", false);
        $("#fp_mail").hide();
        //$("#pmote_mail").attr("checked", false);
        $("#pmote_mail").hide();
        //$("#utbild_mail").attr("checked", false);
        $("#utbild_mail").hide();
        //$("#byte_mail").attr("checked", false);
        $("#byte_mail").hide();
        $("#atl_mail").hide();
        $("#emp_overtime_mail").hide();
        $("#cust_overtime_mail").hide();
        //$("#ovright_mail").attr("checked", false);
        $("#ovright_mail").hide();
        $("#leave_permission_mail").hide();
        $("#employee_profile_mail").hide();
        $("#customer_profile_mail").hide();
        $("#employee_non_preferred_time_mail").hide();
        $("#employee_contract_mail").hide(); 
    }
}

function redirectConfirm(mode){
        var change = $("#change").val();
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
    var change = $("#change").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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
    var change = $("#change").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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
    var change = $("#change").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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
    var change = $("#change").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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
    var change = $("#change").val();
    if(change == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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
    var change = $("#change").val();
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
    var change = $("#change").val();
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
    var change = $("#change").val();
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

function makeChange(){
    //alert($("#new").val());
    //alert("done");
    $("#change").val("1");
    //alert($("#new").val());
}
function backForm(){
    //document.location.href = "{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/";
    //document.referrer;
    //history.go(-1)
    window.history.back();
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
                    <div class="row-fluid">
                        {$message}
                    </div>
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
                                {block name="employee_manage_tab_content"}{/block}
                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.notification}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                         <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()"><span class="icon-save"></span> {$translate.save}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick='backForm()'><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        {/if}
                        <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="tab-4">
                                    <form name="forms" id="forms" method="post" action="{$url_path}employee/notification/{$employee_username}/" style="float:left;" >
                                        <input type="hidden" name="username" id="username" value="{$employee_username}" />
                                        <input type="hidden" name="ation" id="action" value="" />
                                        <input type="hidden" name="new" id="new" value="{$new}" />
                                        <input type="hidden" name="change" id="change" value="" />
                                        <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                        <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                <div style="position: relative; overflow: visible;" class="mCustomScrollbar _mCS_7 mCS_no_scrollbar" data-mcs-theme="minimal">
                                                    <div tabindex="0" id="mCSB_7" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside">
                                                        <div id="mCSB_7_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                            <table class="footable table table-striped table-bordered table-white table-primary" style="margin:0;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="thead-light table-col-center" style="width:350px;"></th>

                                                                        <th class="thead-light table-col-center">
                                                                            <input style="margin: 3px 5px 0px ! important;" type="checkbox" name="mails"id="mails" onclick="nofifyLeave()" value="1" {if $total == 2}checked="checked"{/if} /><br/>
                                                                            {$employee_detail[0].email}
                                                                        </th>

                                                                        <th class="thead-light table-col-center" style="width: 140px;">
                                                                            <input style="margin: 3px 5px 0px ! important;" type="checkbox" name="phone" id="phone" onclick="nofifyLeave()" value="1" {if $notification.sjuk_mob == 1}checked="checked"{/if} onclick="makeChange()"/><br/>
                                                                            {$employee_detail[0].mobile}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.sickness}
                                                                        </td>
                                                                        <td class="center">
                                                                            <input type="checkbox" name="sjuk_mail" id="sjuk_mail"  value="1" {if $notification.sjuk_mail == 1}checked="checked"{/if} onclick="makeChange()"/>
                                                                        </td>
                                                                        <td class="center">
                                                                            <input type="checkbox" name="sjuk_mob" id="sjuk_mob"  value="1" {if $notification.sjuk_mob == 1}checked="checked"{/if} onclick="makeChange()"/>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.sem}
                                                                        </td>
                                                                        <td class="center">
                                                                            <input type="checkbox" name="sem_mail" id="sem_mail" value="2" {if $notification.sem_mail == 1}checked="checked"{/if} onclick="makeChange()"/>
                                                                        </td>
                                                                        <td class="center">
                                                                            <input type="checkbox" name="sem_mob" id="sem_mob" value="2" {if $notification.sem_mob == 1}checked="checked"{/if} onclick="makeChange()"/>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.vab}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="vab_mail" id="vab_mail" value="3" {if $notification.vab_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="vab_mob" id="vab_mob" value="3" {if $notification.vab_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.fp}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="fp_mail" id="fp_mail" value="4" {if $notification.fp_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="fp_mob" id="fp_mob" value="4" {if $notification.fp_mob == 1}checked="checked"{/if}/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.p_mote}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="pmote_mail" id="pmote_mail" value="5" {if $notification.pmote_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="pmote_mob" id="pmote_mob" value="5" {if $notification.pmote_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.education}
                                                                        </td>
                                                                         <td class="center"><input type="checkbox" name="utbild_mail" id="utbild_mail" value="6" {if $notification.utbild_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                          <td class="center"><input type="checkbox" name="utbild_mob" id="utbild_mob" value="6" {if $notification.utbild_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.other}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="ovright_mail" id="ovright_mail" value="7" {if $notification.ovrigt_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="ovright_mob" id="ovright_mob" value="7" {if $notification.ovrigt_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.leave_permission}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="leave_permission_mail" id="leave_permission_mail" value="12" {if $notification.leave_permission_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="leave_permission_mob" id="leave_permission_mob" value="12" {if $notification.leave_permission_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.bandwidth}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="byte_mail" id="byte_mail" value="8" {if $notification.byte_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="byte_mob" id="byte_mob" value="8" {if $notification.byte_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.atl_fail}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="atl_mail" id="atl_mail" value="9" {if $notification.atl_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="atl_mob" id="atl_mob" value="9" {if $notification.atl_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.employee_hour_overflow}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="emp_overtime_mail" id="emp_overtime_mail" value="10" {if $notification.emp_overtime_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="emp_overtime_mob" id="emp_overtime_mob" value="10" {if $notification.emp_overtime_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.customer_hour_overflow}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="cust_overtime_mail" id="cust_overtime_mail" value="11" {if $notification.cust_overtime_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td class="center"><input type="checkbox" name="cust_overtime_mob" id="cust_overtime_mob" value="11" {if $notification.cust_overtime_mob == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.employee_profile}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="employee_profile_mail" id="employee_profile_mail" value="25" {if $notification.employee_profile_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.customer_profile}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="customer_profile_mail" id="customer_profile_mail" value="26" {if $notification.customer_profile_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.employee_non_preferred_time}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="employee_non_preferred_time_mail" id="employee_non_preferred_time_mail" value="27" {if $notification.employee_non_preferred_time_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {$translate.employee_contract_mail}
                                                                        </td>
                                                                        <td class="center"><input type="checkbox" name="employee_contract_mail" id="employee_contract_mail" value="28" {if $notification.employee_contract_mail == 1}checked="checked"{/if} onclick="makeChange()"/></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    {else}
        <div class="message fail">{$translate.permission_denied}</div>      
    {/if}
{/block}