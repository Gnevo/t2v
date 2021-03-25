{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}

{block name="content"}
<div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
	<br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
</div>    
<div class="row-fluid">
    <div class="span12 main-left">
        {$message}
        <div id="dialog-confirm_change" title="" style="display:none;">
              <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.different_privileges}</p>
        </div>       
    
        <div style="margin: 0px 15px 0px 0px;" class="widget-header span12">
            <div class="span4 day-slot-wrpr-header-left span6">
                <h1 style="margin: 5px ! important;">{$translate.employee_privilege}</h1>
            </div>
            <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                <button style="" class="btn btn-default btn-normal pull-right" type="button" onclick="setPrivilege()"><span class="icon-save"></span> {$translate.save}</button>
                <button style="" class="btn btn-default btn-normal pull-right" type="button" onclick="privilegeEmployeeSelect()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
            </div>
            <form id="empls_select" name="empls_select" method="post" action="{$url_path}privilege/employee/">
                <input type="hidden" name="selected_emp" id="selected_emp" value="{$selected_emp}" />
                
                <input type="hidden" name="select_all" id="select_all" value="{$select_all}" />
                <input type="hidden" name="pre_role" id="pre_role" value="{$pre_role}" />
            </form>
        </div>
        <div style="margin-left: 0px;" class="span12">
            <div class="span12">
                <div class="widget" style="margin: 0px ! important;">
                    <!--WIDGET BODY BEGIN-->
                    <div class="span12 widget-body-section input-group">
                        <div style="margin: 0px 0px 20px ! important;" class="span12 day-deatiles-employee">
                            <div class="row-fluid customer-names-pills-wrpr" id="privilege_selected_employee">
                            <ul class="selected-previlege-list">
                                {if $select_all == '1'}
                                    {if $pre_role == 3}
                                     <li class="child-slots-profile-two">{$translate.all_employees}</li>
                                    {/if}
                                    {if $pre_role == 2}
                                     <li class="child-slots-profile-two">{$translate.all_teamleaders}</li>
                                    {/if}
                                    {if $pre_role == 7}
                                     <li class="child-slots-profile-two">{$translate.all_super_tl}</li>
                                    {/if}
                                {else}
                                     {foreach from=$employees item=employee}
                                         {if $employee != ""}
                                             <li class="child-slots-profile-two"><a href="{$url_path}employee/privileges/{$employee.username}/" >{$employee.last_name} {$employee.first_name}</a><a href="javascript:void(0);" onclick="removeEmployee('{$employee.username}')" style="float: right; margin-left:5px;" title="{$translate.remove_employee_tooltip}"><img border="0" align="right" src="{$url_path}images/remove_pink.png" alt=""><!--remove--></a></li>
                                         {/if}
                                     {/foreach}
                                 {/if}

                            </ul>
                            <div class="row-fluid customer-names-pills-wrpr"></div>
                          
                          
                          
                            
                            <div class="relativeWrap"  style="overflow: visible;">
                                <div class="widget widget-tabs widget-tabs-double-2 no-mt">
                                    <div class="widget-head privilege-tabs">
                                        <ul>
                                            <li class="active"><a id="privilage_link" href="javascript:void(0)" onclick="loadPrivileges()" data-toggle="tab"><span class="privilege-tab-timeallocation"></span>{$translate.time_allocation}</a> </li>
                                            <li><a id="report_link" href="javascript:void(0)" onclick="loadReports()" data-toggle="tab"><span class="privilege-tab-reporter"></span> {$translate.reports}</a> </li>
                                            <li><a id="form_link" href="javascript:void(0)" onclick="loadForms()"><span class="privilege-tab-blankletter"></span> {$translate.forms}</a> </li>
                                            <li><a id="general_link" href="javascript:void(0)" onclick="loadGeneral()"><span class="privilege-tab-generaladmin"></span> {$translate.general}</a> </li>
                                            <li><a id="mc_link" href="javascript:void(0)" onclick="loadMC()" data-toggle="tab"><span class="privilege-tab-messagecenter"></span> {$translate.message_centre}</a> </li>
                                        </ul>
                                    </div>
                                    <div style="float: left; width: 99%;" class="widget-body input-group" >
                                        <div style="background: none repeat scroll 0% 0% transparent; border: 0px none ! important; float:left;" class="tab-content span12" id="tabDetails"></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                    </div>
                </div>
            </div>
        </div>
    
      </div>
</div>     
    </div>     
</div>     


{/block}

{block name='script'}
<script src="{$url_path}js/nice-scroll.js"></script>
<script>
    var made_change = 0;
    $(document).ready(function(){
    var tabs = '{$tab}';
    if(tabs == 1){
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#privilage_link").parent().addClass("active");
        loadPrivileges();
    }else if(tabs == 2){
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#report_link").parent().addClass("active");
        //$("#report_link").parent().css("background", "yellow");
        
        loadReports();
    }else if(tabs == 3){
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#form_link").parent().addClass("active");
        loadForms();
    }else if(tabs == 4){
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#general_link").parent().addClass("active");
        loadGeneral();
    }else if(tabs == 5){
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#mc_link").parent().addClass("active");
        loadMC();
    }
    });
    
    
    function loadPrivileges(){
        var tab = "1";
        var curr_tab = $("#curr_tab").val();
        var pre_role = $("#pre_role").val();
        var selected_emp = $("#selected_emp").val();
        
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#privilage_link").parent().addClass("active");
        
        if(curr_tab == tab){
            $.ajax({
            async:true,
            cache: true,
            url:"{$url_path}ajax_privileges.php",
            data:"selected="+selected_emp+"&role="+pre_role,
            type:"POST",
            success:function(data){
                    $("#tabDetails").html(data);
                    }
        });
             //$("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
        }else if(made_change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            $("#roles").val(pre_role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                 $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privileges.php",
                                    data:"selected="+selected_emp+"&role="+pre_role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                                //$("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
                        }
                    }
            });
        }else{
            $.ajax({
               async:true,
               cache: true,
               url:"{$url_path}ajax_privileges.php",
               data:"selected="+selected_emp+"&role="+pre_role,
               type:"POST",
               success:function(data){
                       $("#tabDetails").html(data);
                       }
           });
             ///$("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
        }
    }
    
    function loadReports(){
        var tab = "2";
        var curr_tab = $("#curr_tab").val();
        var pre_role = $("#pre_role").val();
        var selected_emp = $("#selected_emp").val();
        
        
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#report_link").parent().addClass("active");
        if(curr_tab == tab){
        $.ajax({
            async:true,
            cache: true,
            url:"{$url_path}ajax_privilege_report.php",
            data:"selected="+selected_emp+"&role="+pre_role,
            type:"POST",
            success:function(data){
                    $("#tabDetails").html(data);
                    }
        });
            //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role);
        }else if(made_change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            $("#roles").val(pre_role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privilege_report.php",
                                    data:"selected="+selected_emp+"&role="+pre_role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                                //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role)
                        }
                    }
            });
        }else{
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_report.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
             //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role)
        }
       /* $("#tabDetails").load("{$url_path}ajax_privilege_report.php?curr="+curr_tab+"&new_tab="+new_tab);*/
    }
    
    
    function loadForms(){
        var tab = "3";
        
        var curr_tab = $("#curr_tab").val();
        var pre_role = $("#pre_role").val();
        var selected_emp = $("#selected_emp").val();
        
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#form_link").parent().addClass("active");
        
        if(curr_tab == tab){
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_forms.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
             //$("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
        }else if(made_change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            $("#roles").val(pre_role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privilege_forms.php",
                                    data:"selected="+selected_emp+"&role="+pre_role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                                 //$("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
                        }
                    }
            });
        }else{
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_forms.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
            //$("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
        }
        /*var curr_tab = $("#curr_tab").val();
        $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?curr="+curr_tab+"&new_tab="+new_tab);*/
    }
    function loadGeneral(){
    var tab = "4";
    
        var curr_tab = $("#curr_tab").val();
        var pre_role = $("#pre_role").val();
        var selected_emp = $("#selected_emp").val();

        console.log(selected_emp);
        
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#general_link").parent().addClass("active");   
        
        if(curr_tab == tab){
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_general.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
            //$("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
        }else if(made_change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            $("#roles").val(pre_role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privilege_general.php",
                                    data:"selected="+selected_emp+"&role="+pre_role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                               // $("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
                        }
                    }
            });
        }else{
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_general.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
            //$("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
        }
        }
       /* var curr_tab = $("#curr_tab").val();
        $("#tabDetails").load("{$url_path}ajax_privilege_general.php?curr="+curr_tab+"&new_tab="+new_tab);*/

    function madeChange(){
      made_change = 1;
    }
    function loadMC(){
        var tab = "5";
        
        var curr_tab = $("#curr_tab").val();
        var pre_role = $("#pre_role").val();
        var selected_emp = $("#selected_emp").val();
        
        $("#privilage_link").parent().removeClass("active");
        $("#report_link").parent().removeClass("active");
        $("#form_link").parent().removeClass("active");
        $("#general_link").parent().removeClass("active");
        $("#mc_link").parent().removeClass("active");
        $("#mc_link").parent().addClass("active");
        
        if(curr_tab == tab){
            $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_mc.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
            // $("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
        }else if(made_change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            $("#roles").val(pre_role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                 $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privilege_mc.php",
                                    data:"selected="+selected_emp+"&role="+pre_role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                               // $("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
                        }
                    }
            });
        }
        else{
         $.ajax({
                async:true,
                cache: true,
                url:"{$url_path}ajax_privilege_mc.php",
                data:"selected="+selected_emp+"&role="+pre_role,
                type:"POST",
                success:function(data){
                        $("#tabDetails").html(data);
                        }
            });
            //$("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
        }
    }
    
    
    function setPrivilege(){
        var curr_tab = $("#curr_tab").val();
        var selected_emp = $("#selected_emp").val();
        var pre_role = $("#pre_role").val();
        if(selected_emp != ""){
            $("#employees").val(selected_emp);
            $("#new_tab").val(curr_tab);
            $("#roles").val(pre_role);
            $("#form").submit();
        }else{
            $( "#dialog-cantsave" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            var role = $("#pre_role").val();
                            $("#roles").val(role);
                            $("#form").submit();

                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                 $.ajax({
                                    async:true,
                                    cache: true,
                                    url:"{$url_path}ajax_privileges.php",
                                    data:"selected="+selected_emp+"tab={$tab}"+"&role="+role,
                                    type:"POST",
                                    success:function(data){
                                            $("#tabDetails").html(data);
                                            }
                                });
                                //$("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"tab={$tab}"+"&role="+role);
                        }
                    }
            });
        }
    }

    function privilegeEmployeeSelect(){
        $("#empls_select").submit(); 
    }
    function removeEmployee(username){
        var tmp_emp = $('#selected_emp').val();
        var tmp_emp_array = tmp_emp.split(",");
        var new_tmp_emp = '';
        var j=0;

        for(var i=0; i < tmp_emp_array.length; i++) {

            if(tmp_emp_array[i] != username) {
                if(tmp_emp_array[i] != ""){
                   if(new_tmp_emp == ""){
                    new_tmp_emp = tmp_emp_array[i];
                   }
                    else{
                        new_tmp_emp = new_tmp_emp+","+tmp_emp_array[i];
                    }
                }
            }
        }
        $("#selected_emp").val(new_tmp_emp);
        $("#privilege_selected_employee").load("{$url_path}ajax_selected_employee_privilege.php?empl="+new_tmp_emp);

    }
    
    function giveFullPrivilegeForm(){
    madeChange();
    $('#basic_previllage_form').attr('checked',false);
    if($('#full_previllage_form').attr('checked')){
        // $('#form_fkkn').attr('checked',true);
        // $('#form_leave').attr('checked',true);
        // $('#form_certificate').attr('checked',true);
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',true);
    }else{
        // $('#form_fkkn').attr('checked',false);
        // $('#form_leave').attr('checked',false);
        // $('#form_certificate').attr('checked',false);
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',false);
    }
}


function giveBasicPrivilegeFormAl(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',true);
        $('#form_leave').attr('checked',false);
        $('#form_certificate').attr('checked',false);
    }else{
        $('#form_fkkn').attr('checked',false);
        $('#form_leave').attr('checked',false);
        $('#form_certificate').attr('checked',false);
    }
}
function giveBasicPrivilegeFormEmp(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',false);
        $('#form_leave').attr('checked',false);
        $('#form_certificate').attr('checked',false);
    }else{
        $('#form_fkkn').attr('checked',false);
        $('#form_leave').attr('checked',false);
        $('#form_certificate').attr('checked',false);
    }
}

function giveFullPrivilegeReport(){
    madeChange();
    $('#basic_previllage_report').attr('checked',false);
    if($('#full_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',true);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',true);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',true);
        $('#employee_leave').attr('checked',true);
        $('#employee_percentage').attr('checked',true);
        $('#atl_warning').attr('checked',true);
        $('#customer_overlapping').attr('checked',true);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
        $('#customer_overlapping').attr('checked',false);
    }
}

function giveBasicPrivilegeReportAl(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveBasicPrivilegeReportEmp(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveBasicPrivilegeReportGl(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',true);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',true);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',true);
        $('#employee_leave').attr('checked',true);
        $('#employee_percentage').attr('checked',true);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveFullPrivilegeGeneral(){
    madeChange();
    $('#basic_previllage_general').attr('checked',false);
    if($('#full_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',true);
        $('#general_edit_employee').attr('checked',true);
        $('#general_add_customer').attr('checked',true);
        $('#general_edit_customer').attr('checked',true);
        $('#general_inconvenient_timing').attr('checked',true);
        $('#general_export').attr('checked',true);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',true);
        $('#create_template').attr('checked',true);
        $('#use_template').attr('checked',true);
        $('#general_candg').attr('checked',true);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',true);

        $('input.PrivilegeCheck').attr('checked',true);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralAL(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralEmp(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralGl(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',true);
        $('#general_edit_employee').attr('checked',true);
        $('#general_add_customer').attr('checked',true);
        $('#general_edit_customer').attr('checked',true);
        $('#general_inconvenient_timing').attr('checked',true);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);

        $('input.PrivilegeCheck').attr('checked',false);
    }
}

function giveFullPrivilegeMC(){
    madeChange()
    $('#basic_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#full_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',true);
        $('#mc_document_archive').attr('checked',true);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveBasicPrivilegeMCAl(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',true);
        $('#mc_document_archive').attr('checked',true);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveBasicPrivilegeMCEmp(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
} 

function giveBasicPrivilegeMCGl(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveFullPrivilege(){
    madeChange()
    $('#basic_previllage').attr('checked',false);
    if($('#full_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',true);
        $('#add_customer').attr('checked',true);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',true);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#delete_multiple_slots').attr('checked',true);
        $('#contract_override').attr('checked',true);
        $('#atl_override').attr('checked',true);
        $('#change_time').attr('checked',true);
        $('#no_pay_leave').attr('checked',true);
        $('#candg_approve').attr('checked',true);
        $('#show_percentage_month').attr('checked',true);
        $('#not_show_employees').attr('checked',false);
        $('#not_show_employees').attr('checked',true);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }
}

function giveBasicPrivilegeAL(){
    madeChange();
    $('#full_previllage').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }
}

function giveBasicPrivilegeEmp(){
    madeChange();
    $('#full_previllage').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }
}

function giveBasicPrivilegeGl(){
    madeChange();
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',true);
        $('#add_customer').attr('checked',true);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',true);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }
}
 </script>
{/block}    

