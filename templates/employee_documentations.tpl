{block name='script'}
<script type="text/javascript">
    
    $(document).ready(function(){
    
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-271});
        else
            $('.tab-content-con').css({ height: $(window).height()});
    });
    
    
    
    function addNewSkill(){
        $("#new_skill").toggle();
    }
    
    function deleteDocument(doc_id){
        $( "#dialog-confirm_delete" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $('#action').val("2");
                            $('#doc_id').val(doc_id);
                            $("#form").submit();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                //document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }
            });
    }
    
    function saveForm(){
        var error = 0;
        if($.trim($("#file").val()) == ''){
            $("#file").addClass('error');
            error = 1;
        }else{
            $("#file").removeClass('error');
        }
        if(error == 0){
            $('#action').val("1");
            $("#form").submit();
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
}*/

function makeChange(){
    //alert($("#new").val());
    //alert("done");
    $("#change").val("1");
    //alert($("#new").val());
}

function downloadFile(filename){
    document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
}

function backForm() {
    //document.location.href = '{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/';
    window.history.back();
}
function document_visibility(doc_id){
    $( "#dialog-confirm_status" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $('#action').val("3");
                            $('#doc_id').val(doc_id);
                            $("#form").submit();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                        }
                    }
            });

}
</script>
{/block}

{block name="content"}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px;">
        <p><span class="error_msg_icon" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
    </div>
    <div id="dialog-confirm_delete" title="{$translate.status_confirm_title_msg}" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_delete}</p> 
    </div>
    <div id="dialog-confirm_status" title="Status Change" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.status_confirm_msg}</p> 
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
                        <div class="widget-body" >
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
                                      <h1>{$translate.documents}</h1>
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
                    <div role="tabpanel" class="tab-pane active" id="tab-7">
                        <form action="" method="post" name="form" id="form" enctype="multipart/form-data" style="float:left; width:100%;" >
                            <input type="hidden" value="" id="action" name="action">
                            <input type="hidden" value="" id="doc_id" name="doc_id">
                            <input type="hidden" value="" id="work" name="work">
                            <div style="" class="span12 widget-body-section input-group">
                                <div class="row-fluid">
                                    {$message}
                                    {if $documents}
                                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin:0;">
                                            <thead>
                                                <tr>
                                                    <th class="thead-light" style="width:40%">{$translate.files}</th>
                                                     <th class="thead-light small-col">{$translate.upload_user}</th>
                                                    <th class="thead-light" style="width:15%">{$translate.date_on_emp_doc}</th>
                                                    <th class="thead-light small-col">{$translate.delete}</th>
                                                    <th class="thead-light small-col">{$translate.status}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {foreach $documents AS $document}
                                                    {if $user_roles_login == 7 or $user_roles_login == 1 or $document.alloc_emp == $user_id}
                                                        {assign var=check value=1}
                                                    {/if}
                                                    {if $user_roles_login == 7 or $user_roles_login == 1 or $document.status == 1 or $document.alloc_emp == $user_id}
                                                        <tr>
                                                            <td ><a href="javascript:void(0)" onclick="downloadFile('{$document.documents}')">{$document.documents}</a></td>
                                                            <td >{$document.alloc_emp}</td>
                                                            <td >{$document.date}</td>
                                                            
                                                            <td class="small-col">{if $check == 1}<a href="javascript:void(0);" class="btn btn-default" onclick="deleteDocument('{$document.id}')"><i class="icon-trash"></i></a>{/if}</td>
                                                            <td>{if $check == 1}<a href="javascript:void(0);" {if $document.status == 1} class="btn btn-default"{else} class="btn btn-danger" {/if}onclick="document_visibility('{$document.id}')">
                                                                {if $document.status == 1}{$translate.hide_status}{else}{$translate.show_status}{/if}</a>{/if}</td>
                                                            
                                                        </tr>
                                                    {/if}
                                                {/foreach}
                                            </tbody>
                                        </table>
                                    {else}
                                        <div style="margin: 0px 0px 10px;" class="alert alert-error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong><i class="icon-ban-circle"></i></strong> {$translate.no_data_available}
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            <div class="widget input-group" style="margin:0px 0px 20px 0px !important;">
                                <div class="widget-body" style="padding:5px;">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left;" class="btn btn-default btn-file">
                                                <span style="margin-right: 8px;" class="fileupload-new">{$translate.upload_document}</span>
                                                <input name="file" id="file" class="margin-none" type="file">
                                            </span>
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