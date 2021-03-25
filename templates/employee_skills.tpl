{block name="style"}
     <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
         $("#date_of_qualification,#date_of_qualification_edit").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
        });
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-271});
        else
            $('.tab-content-con').css({ height: $(window).height()});
    });
    
    
    function addNewSkill(){
        $("#new_skill").toggle();
        if($('#error_div').length > 0){
            $('#error_div').toggle();
        }
       
    }
    
    function deleteSkill(id_skill){
         $( "#dialog-confirm_delete" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $('#action').val("2");
                            $('#skill_id').val(id_skill);
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
        // alert();
        var error = 0;
        if($.trim($("#title").val()) == ''){
            $("#title").addClass('error');
            error = 1;
        }else{
            $("#title").removeClass('error');
        }
        if($.trim($("#skill_desc").val()) == ''){
            $("#skill_desc").addClass('error');
            error = 1;
        }else{
            $("#skill_desc").removeClass('error');
        }
        if($.trim($("#date_of_qualification").val()) == ''){
            $("#date_of_qualification").addClass('error');
            error = 1;
        }else{
            $("#date_of_qualification").removeClass('error');
        }
        if(error == 0){
            
            $('#action').val("1");
            $("#form").submit();
        }
    }

    function save_edit_form(id){
         var error = 0;
        if($.trim($("#edit_title").val()) == ''){
            $("#edit_title").addClass('error');
            error = 1;
        }else{
            $("#edit_title").removeClass('error');
        }
        if($.trim($("#edit_skill_desc").val()) == ''){
            $("#edit_skill_desc").addClass('error');
            error = 1;
        }else{
            $("#edit_skill_desc").removeClass('error');
        }
        if(error == 0){
            
            $('#action'+id).val("3");
            $("#edit"+id).submit();
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
function backForm() {
    //document.location.href = '{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/';
    window.history.back();
}

function toggle_edit(id){
    $('#edit_skill'+id).toggle();
}
function delete_skill_doc(id,name,db_column){
    $('#'+id).empty();
    var html = '<td><input type=file  name=file[]  style=width:200px><input type=hidden name=db_column[] value='+db_column+'></td>';
    $('#'+id).append(html);
    
}
function hide_form(type,id = null) {
    if(type == 'new'){
        $('#new_skill').hide();
    }
    else if(type == 'edit'){
        $('#edit_skill'+id).hide();
    }
}
function download_skill(file){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+file;
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
                    <h1>{$translate.skills}</h1>
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
                                        <h1>{$translate.skills}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick='backForm()'><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="addNewSkill()"><span class="icon-plus" s></span> {$translate.add_new}</button>
                                 </div>
                                </div>
                        </div>
                        </div>
                    {/if}
                      <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                       <div role="tabpanel" class="tab-pane active" id="tab-6">
                                           <form action="" method="post" name="form" id="form" enctype="multipart/form-data" style="float:left; width:100%;">
                        <input type="hidden" value="" id="change" name="change">
                        <input type="hidden" value="" id="action" name="action">
                        <input type="hidden" value="" id="skill_id" name="skill_id">
                      <div style="" class="span12 widget-body-section input-group">
                                <div class="row-fluid">
                                    {$message}
                                    <div class="clearfix" id="forms_container_new">
                                        <div class="new_skill" id="new_skill" style="display: none;">
                                            <div class="widget" style="width:500px; height:380px;">
                                            <div class="widget-header span12">
                                                <div class="skill_botton" style="padding:5px 10px 5px 0;float: right;"><button type="button" class="btn btn-success" name="save_skill" id="save_skill" value="{$translate.save}" onclick="saveForm()"><span class="icon-save"> {$translate.save}</span></button></div>
                                                <div style="padding:5px 10px 5px 0;float: right;"><button class="btn btn-default" onclick="hide_form('new')" type="button">{$translate.cancel}</button></div>
                                                
                                            </div>
                                                <div class="clearfix"><span style="float: left;display: block;padding-top: 20px; margin-bottom: 20px;margin-left: 38px;">{$translate.skill_title}</span><span style="padding-top: 20px; padding-left: 27px; display: block; float: left;margin-left: 102px;"><input type="text" name="title" id="title" onchange="makeChange()"  required="true" style="width: 212px;" /></span></div>
                                                <div class="clearfix"><span style="float: left;display: block;margin-left: 34px;">{$translate.skill_description}</span><span style="float: right;display: block;margin:auto;margin-bottom: 13px;width: 61.5%"><textarea name="skill_desc" id="skill_desc" onchange="makeChange()" required="true" /></textarea></span></div>
                                                <div class="clearfix"><span style="float: left;display: block;padding-top: 20px; margin-bottom: 20px;margin-left: 38px;">{$translate.skill_date_of_exam}</span><span style="padding-top: 20px; display: block; float: left;margin-left: 85px;"><input type="text" name="date_of_qualification" value="{$current_date}" data-date-format="yyyy-mm-dd"  id="date_of_qualification" onchange="makeChange()"  required="true" style="width: 212px;" /></span></div>
                                                <div class="clearfix"></div><div id="attachment1" ><label style="margin-left: 38px;">{$translate.upload_document}</label><input type="file" name="file[]" id="file1" style="margin:auto;line-height: 25px;float: right;width: 61%"> </div>
                                                <div class="clearfix"></div><div id="attachment2" style="padding: 10px 0 0 0 ;"><label style="margin-left: 38px;">{$translate.upload_document}</label><input type="file" name="file[]" id="file2" style="margin:auto;line-height: 25px;float: right;width: 61%"></div>
                                                <div class="clearfix"></div><div id="attachment3" style="padding: 10px 0 0 0 ;"><label style="margin-left: 38px;">{$translate.upload_document}</label><input type="file" name="file[]" id="file3" style="margin:auto;line-height: 25px;float: right;width: 61%"></div>
                                                <div class="clearfix"></div>
                                                <div class="span12" style="padding:10px 0 0 10px;">{$translate.upload_doc_tyepe_on_emp_skills}</div>
                                                
                                            </div>
                                        </div>
                                        {foreach $skills AS $skill}
                                            <table class="footable table table-striped table-bordered table-white table-primary " style="margin-top:5px;">
                                                <thead>
                                                    <tr>
                                                        <th class="thead-light"  title="Edit Skill"><a href="javascript:void(0);" onclick="toggle_edit('{$skill.id}')">{$skill.skill}</a></th>
                                                        <th class="thead-light table-col-center"><a href="javascript:void(0);" class="btn btn-default" onclick="deleteSkill('{$skill.id}')"><i class="icon-trash"></i></a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach $skill.description AS $desc}
                                                        <tr>
                                                            <td >{$desc.desc}</td>
                                                            <td></td>
                                                        </tr>
                                                    {/foreach}
                                                        {if $skill.attachment1 != '' || $skill.attachment2 != '' || $skill.attachment3 != ''}
                                                        <tr><td>
                                                            {if $skill.attachment1 != ''}
                                                                    <label onclick="download_skill('{$skill.attachment1}')"><i class="icon icon-download"></i>{$skill.attachment1}</label>
                                                            </br>
                                                            {/if}
                                                            {if $skill.attachment2 != ''}
                                                             <label onclick="download_skill('{$skill.attachment1}')"><i class="icon icon-download"></i>{$skill.attachment2}</label>
                                                              </br>
                                                            {/if}
                                                            {if $skill.attachment3 != ''}
                                                                    <label onclick="download_skill('{$skill.attachment1}')"><i class="icon icon-download"></i>{$skill.attachment3}</label>
                                                             </br>
                                                            {/if}
                                                             <td></td>
                                                        {/if}
                                                       
                                                     </td></tr>
                                                </tbody>
                                            </table>

                                        

                                    </form>
                                   
                                    <div id="edit_skill{$skill.id}" style="display: none;" >
                                        <form action=""  method="post" name="edit{$skill.id}" id="edit{$skill.id}" enctype="multipart/form-data">   
                                        <input type="hidden" value="" id="action{$skill.id}" name="action">
                                           <div class="widget" style="width:500px;height:380px;">
                                                <div class="widget-header span12">
                                                    <div class="skill_botton" style="padding:5px 10px 5px 0;float: right;"><button type="button" class="btn btn-success" name="edit_skill" id="edit_skill" value="{$translate.save}" onclick="save_edit_form('{$skill.id}')"><span class="icon-save"></span>{$translate.save}</button></div>
                                                    <div style="padding:5px 10px 5px 0;float: right;"><button class="btn btn-default" onclick="hide_form('edit','{$skill.id}')" type="button">{$translate.cancel}</button></div>
                                                </div>
                                                <div class="clearfix"><span style="float: left;display: block;padding-top: 20px;margin-left: 38px;">{$translate.skill_title}</span><span style="padding-top: 20px; padding-left: 27px; display: block;float: left;margin-left: 92px;"><input type="text" name="title" id="edit_title" onchange="makeChange()" value="{$skill.skill}" required="true" style="width:212px;"></span></div>
                                                {foreach $skill.description AS $desc}
                                                    <div class="clearfix"><span style="float: left;display: block;margin-left: 38px;">{$translate.skill_description}</span><span style="float: right;display: block;margin:auto;margin-bottom: 13px;width: 63.5%"><textarea name="skill_desc" id="edit_skill_desc" onchange="makeChange()" required="true" />{$desc.desc}</textarea></span></div>
                                                {/foreach}
                                                    <div class="clearfix"><span style="float: left;display: block;padding-top: 20px; margin-bottom: 20px;margin-left: 38px;">{$translate.skill_date_of_exam}</span><span style="padding-top: 20px; display: block; float: left;margin-left: 75px;"><input type="text" name="date_of_qualification" value="{$skill.exam_date}" data-date-format="yyyy-mm-dd"  id="date_of_qualification_edit" onchange="makeChange()"  required="true" style="width: 212px;" /></span></div>
                                                    <div class="clearfix"><span style="float: left;display: block;padding-top: 5px; margin-bottom: 20px;margin-left: 38px;">{$translate.upload_document}</span>
                                                   
                                                   <div  style="padding-left:183px;width: 300px;"> 
                                                   <table >
                                                        <tr id="first_del_{$skill.id}">
                                                            {if $skill.attachment1 != ''}
                                                                <td>{$skill.attachment1}</td>
                                                                <td ><a href="javascript:void(0);" class="btn btn-default" onclick="delete_skill_doc('first_del_{$skill.id}','{$skill.attachment1}','attachment1')"><i class="icon-trash"></i></a></td>
                                                            {else}
                                                                <td colspan="2"><input type="file" name="file[]"></td>
                                                            {/if}
                                                        </tr>
                                                
                                                    <tr id="second_del_{$skill.id}">
                                                        {if  $skill.attachment2 != ''}
                                                            <td>{$skill.attachment2}</td>
                                                            <td ><a  href="javascript:void(0);" class="btn btn-default" onclick="delete_skill_doc('second_del_{$skill.id}','{$skill.attachment2}','attachment2')"><i class="icon-trash"></i></a></td>
                                                        {else}
                                                             <td colspan="2"><input type="file" name="file[]"></td>
                                                        {/if}
                                                    </tr>
                                                    <tr id="third_del_{$skill.id}">
                                                        {if $skill.attachment3 !=''}
                                                            <td>{$skill.attachment3} </td>
                                                            <td><a  href="javascript:void(0);" class="btn btn-default" onclick="delete_skill_doc('third_del_{$skill.id}','{$skill.attachment3}','attachment3')"><i class="icon-trash"></i></a></td>
                                                        {else}
                                                            <td colspan="2"><input type="file" name="file[]"></td>
                                                        {/if}
                                                    <tr>
                                               
                                                    </table></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div style="padding:10px 0 0 10px; ">{$translate.upload_doc_tyepe_on_emp_skills}</div>
                                                    <input type="hidden" name="skill_h_id" value="{$skill.id}">
                                                </div> 
                                        </div>
                                         
                                        {foreachelse}
                                            <div class="alert alert-error" id="error_div">{$translate.no_data_available}</div>
                                        {/foreach}

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
{/block}