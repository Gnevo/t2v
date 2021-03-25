{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}
{block name='script'}
<script language="javascript">
var made_change = 0;
function madeChange(){
  made_change = 1;
}
$(document).ready(function(){ 

       
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-281});
        else
            $('.tab-content-con').css({ height: $(window).height()});

        $(".side_links li a").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
        var new_var = $("#new").val();
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
        var tabs = '{$tab}';
        //alert(tabs);
        if(tabs == 1){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#privilage_link").addClass("active");
            loadPrivileges();
             $("#customer_select_div").show();
        }else if(tabs == 2){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#report_link").addClass("active");
            loadReports();
            $("#customer_select_div").hide();
        }else if(tabs == 3){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#form_link").addClass("active");
            loadForms();
            $("#customer_select_div").hide();
        }else if(tabs == 4){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#general_link").addClass("active");
            loadGeneral();
            $("#customer_select_div").hide();
        }else if(tabs == 5){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#mc_link").addClass("active");
            loadMC();
            $("#customer_select_div").hide();
        }
    });
    
function giveFullPrivilegeForm(){
    madeChange();
    $('#basic_previllage_form').attr('checked',false);
    if($('#full_previllage_form').attr('checked')){
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',true);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',false);
    }
}

function giveBasicPrivilegeFormAl(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',true);
        $('#form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }
}

function giveBasicPrivilegeFormEmp(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',true);
        $('#form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
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
        $('#general_candg_wo').attr('checked',true);
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
        $('#mobile_search').attr('checked',true);
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
        $('#mc_support').attr('checked',flase);
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
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
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
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
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
                $("#customer_select_div").hide();
                
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
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
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
                $("#customer_select_div").hide();
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
                $("#customer_select_div").hide();
                
                }
        });
        // $("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role)
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
                $("#customer_select_div").hide();
                }
        });
        // $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
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
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
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
                $("#customer_select_div").hide();
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
                $("#customer_select_div").hide();
                }
        });
       // $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
    }
    /*var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?curr="+curr_tab+"&new_tab="+new_tab);*/
}
function loadGeneral(){
    var tab = "4";
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    
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
                $("#customer_select_div").hide();
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
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
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
                $("#customer_select_div").hide();
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
                $("#customer_select_div").hide();
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
    }
    }
   /* var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("{$url_path}ajax_privilege_general.php?curr="+curr_tab+"&new_tab="+new_tab);*/

function madeChange(){
  made_change = 1;
  $("#new").val("1");
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
                $("#customer_select_div").hide();
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
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
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
                $("#customer_select_div").hide();
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
                $("#customer_select_div").hide();
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
    }
}
function loadPrivileges(){

    var tab = "1";
    var customer_username = $("#customer_select").val();
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
    $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
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
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
                            $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
                }
        });
                           // $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"tab={$tab}"+"&role="+pre_role);
                    }
                }
        });
    }else{
    $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
    $.ajax({
        
        async:true,
        cache: true,
        url:"{$url_path}ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
                }
        });
        // $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
    }
}

function saveForm(){
    //$("#action").val("save");
    var tab = $("#curr_tab").val();
    var selected_emp = $("#selected_emp").val();
    $("#employees").val(selected_emp);
    $("#new_tab").val(tab);
    var role = $("#pre_role").val();
    $("#roles").val(role);
    $("#form").submit();
     
}

function setPrivilege(){
    var curr_tab = $("#curr_tab").val();
    var selected_emp = $("#selected_emp").val();
    var cust = $("#customer_select").val();
    $("#cust").val(cust);
    $("#employees").val(selected_emp);
    $("#new_tab").val(curr_tab);
    $("#form").submit();
    
}

function backForm() {
    //document.location.href = '{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/';
    window.history.back();
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
   var made_change = $("#change").val();
    if(made_change == 1){
            var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
   var made_change = $("#change").val();
    if(made_change == 1){
    var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
    var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
        var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
            var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
                {$message}
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1>{$translate.employee_profile}</h1>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    {if $employee_username != ""}
                        <div class="widget option-panel-widget" style="margin:0 !important;">
                            <div class="widget-body" style="">
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
                                     <h1>{$translate.privilege}</h1>
                                    </div>
                                       <div class="span2" style="margin: 10px 0px 0px;">
                                    <div style="margin: 0px !important;" class="input-prepend span11" id="customer_select_div">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="customer_select" onchange="loadPrivileges()">
                                            <option value="">{$translate.all_customers}</option>
                                            {foreach $customers_to_employee AS $cust}
                                                <option value="{$cust.username}" {if $customer_selected == $cust.username} selected="selected" {/if}>{$cust.last_name} {$cust.first_name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>
                                    <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 0px 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="setPrivilege()"><span class="icon-save" style="color:#000;"></span> {$translate.save}</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left" style="color:#000"></span> {$translate.backs}</button>
                                 </div>
                                </div>
                            </div>
                            </div>
                        {/if}
                        <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="5">
                                    <form class="pull-left">
                                        <input type="hidden" id="selected_emp" name="selected_emp"  value="{$employee_username}"/>
                                        <input type="hidden" id="change_comp" name="change_comp"  value="1"/>
                                        <input type="hidden" id="pre_role" name="pre_role"  value="{$pre_role}"/>
                                    </form>
                                    <div role="tabpanel" class="tab-pane active" id="5">

                                        <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
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
                                                            <div style="background: none repeat scroll 0% 0% transparent; border: 0px none ! important; float:left;" class="tab-content span12" id="tabDetails">
                                                                
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
        </div>                                        
        {else}
            <div class="message fail">{$translate.permission_denied}</div>      
        {/if}
{/block}