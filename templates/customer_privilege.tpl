{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .pvlge-wrpr { height: 233px; }
    </style>
{/block}
    
{block name="content"}
{if $access_flag == 1}
<div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
	<br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
</div>
<div id="dialog-confirm-emp" title="{$translate.confirm}" style="display:none;">
	<br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.no_employee}</p>
</div>
<div id="dialog-confirm_change" title="" style="display:none;">
    <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.different_privileges}</p>
</div>
<div id="dialog-cantsave" title="{$translate.confirm}" style="display:none;">
	<br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.no_employee}</p>
</div>
<div class="clearfix" id="dialog_popup" style="display:none;"></div>


<div class="row-fluid">
    <div style="" class="span12 main-left">
        {$message}
        <div style="margin: 0px;" class="widget-header span12">
            <div class="span4 day-slot-wrpr-header-left span6">
                <h1>{$translate.personal_information}</h1>
            </div>
            <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                {if !empty($customer_detail)}
                    <div class="widget-body" style="padding:4px;">
                        <div class="row-fluid">
                            <div class="span4 top-customer-info"><strong>{$translate.social_security}</strong> : {$customer_detail.social_security}</div>
                            <div class="span4 top-customer-info"><strong>{$translate.customer_code} :</strong> {$customer_detail.code}</div>
                            {if $sort_by_name == 1}
                                <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
                            {elseif $sort_by_name == 2}
                                <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>     
                            {/if}
                        </div>
                    </div>
                {/if}
            </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="tab-content-switch-con" >
                            {block name="customer_manage_tab_content"}{/block}

                            <div class="widget-header widget-header-options tab-option">
                                <div class="span4 day-slot-wrpr-header-left span3">
                                    <h1>{$translate.employee}</h1>
                                </div>
                                 <div class="span4 day-slot-wrpr-header-left span3">
                                        <div style="margin: 8px 0px 0px ! important;" class="input-prepend span2 pull-right"> <span class="add-on icon-pencil"></span>
                                            <select class="" name="pre_role" id="pre_role" onchange="selectEmployee()">
                                                <option value="3" {if $role == 3}selected="selected" {/if}>{$translate.employee}</option>
                                                <option value="2" {if $role == 2}selected="selected" {/if}>{$translate.tl}</option>
                                                <option value="7" {if $role == 7}selected="selected" {/if}>{$translate.super_tl}</option>
                                            </select>
                                        </div>

                                        <form style="margin: 0px !important">
                                            <input type="hidden" name="selected_emp" id="selected_emp" value="{$selected_emp}" />
                                            <input type="hidden" name="role_privilage" id="role_privilage" value="{$pre_role}" />

                                        </form> 
                                    </div>  
                                
                                <div class="pull-right day-slot-wrpr-header-left span5" style="padding: 0px 5px;">
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="setPrivilege()"><span class="icon-wrench" style="color:#000;"></span> {$translate.set_privilege}</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm();"><span class="icon-arrow-left" style="color:#000;"></span> {$translate.backs}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            <div role="tabpanel" class="tab-pane" id="9">
              
                <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
                <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
               
                </div>
                </div>
              <div style="margin-left: 0px;" class="span12">
              <div class="span12">
              <div class="widget" style="margin: 0px ! important;">
              <!--WIDGET BODY BEGIN-->
              <div class="span12 widget-body-section input-group">
              <div style="margin: 0px 0px 20px ! important; height: 80px;" class="span12 day-deatiles-employee">
             
              <div class="row-fluid customer-names-pills-wrpr" id="privilege_selected_employee">
  
                <ul class="sidget-stats-list-wrpr">
                    {foreach from=$employees item=employee}
                        {if $employee != ""}
                            <li class="widget-stats-emplyee-green widget-stats-2 employees">{$employee.last_name} {$employee.first_name}</li>
                        {/if}    
                    {/foreach}
                </ul>
              <div class="span2"> 
              </div>
              
              </div>
              </div>
                   <div class="tab-content-con boxscroll pvlge-wrpr">
                        <div style="" class="span12 widget-body-section input-group" >
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
                                        <div class="tabDetails" id="tabDetails">
                                            <form>
                                                <input type="hidden" name="curr_tab" id="curr_tab" value="{$tab}" />
                                            </form>
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
    </div>
</div>
</div>
</div>    
     
{/if}
{/block}
{block name='script'}
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-392});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    
    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function(){
      var itemsWidth = 0;
      $('.list li').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
      });
      return itemsWidth;
    };

    var widthOfHidden = function(){
      return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
      return $('.list').position().left;
    };
    var reAdjust = function(){
      if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
      }
      else {
        $('.scroller-right').hide();
      }

      if (getLeftPosi()<0) {
        $('.scroller-left').show();
      }
      else {
        $('.item').animate({ left:"-="+getLeftPosi()+"px" },'slow');
            $('.scroller-left').hide();
      }
    }


    reAdjust();

    $(window).on('resize',function(e){  
            reAdjust();
    });

    $('.scroller-right').click(function() {

      $('.scroller-left').fadeIn('slow');
      $('.scroller-right').fadeOut('slow');

      $('.list').animate({ left:"+="+widthOfHidden()+"px" },'slow',function(){

      });
    });

    $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.list').animate({ left:"-="+getLeftPosi()+"px" },'slow',function(){

            });
    });   
    

});
</script>
<script type="text/javascript">
    var made_change = 0;
    $(document).ready(function (){

       
         $(".side_links li a").click(function(event){
                var new_var = $("#new").val();
                var emp = $("#selected_emp").val();
                event.preventDefault();
                var href_val = $(this).attr('href');
                if(made_change  == 1){
                    $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.yes}": function() {
                                    $( this ).dialog( "close" );
                                    if(emp == ""){
                                        $( "#dialog-confirm-emp" ).dialog({
                                        resizable: false,
                                        height:140,
                                        modal: true,
                                        buttons: {
                                            "{$translate.ok}": function() {
                                                    $( this ).dialog( "close" );
                                                    document.location.href = href_val;
                                              }
                                          }
                                       });
                                    }else{
                                        saveForm();
                                    }
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
        var selected = $("#selected_emp").val();
        $("#privilege_selected_employee").load("{$url_path}ajax_selected_employee_privilege.php?empl="+selected+"&cust={$customer_detail.username}'");
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
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }
}

function saveForm(){
    var selected_emp = $("#selected_emp").val();
    var tab = $("#curr_tab").val();
    //var pre_role = $("#role_privilage").val();
    $("#employees").val(selected_emp);
    $("#new_tab").val(tab);
    var role = $("#pre_role").val();
    $("#roles").val(role);
    $("#form").submit();
}
function loadReports(){
    var tab = "2";
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
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
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                    $( this ).dialog( "close" );
                    if(selected_emp == ""){
                        $( "#dialog-confirm-emp" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.ok}": function() {
                                    $( this ).dialog( "close" );
                                    
                              }
                          }
                       });
                    }else{
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        $("#form").submit();
                    }
                        
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
                                async:true,
                                cache: true,
                                url:"{$url_path}ajax_privilege_report.php",
                                data:"selected="+selected_emp+"&role="+role,
                                type:"POST",
                                success:function(data){
                                        $("#tabDetails").html(data);
                                        }
                                });
                            //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+role)
                    }
                }
        });
    }else{
        $.ajax({
            async:true,
            cache: true,
            url:"{$url_path}ajax_privilege_report.php",
            data:"selected="+selected_emp+"&role="+role,
            type:"POST",
            success:function(data){
                    $("#tabDetails").html(data);
                    }
            });
         //$("#tabDetails").load("{$url_path}ajax_privilege_report.php?selected="+selected_emp+"&role="+role)
    }
   /* $("#tabDetails").load("{$url_path}ajax_privilege_report.php?curr="+curr_tab+"&new_tab="+new_tab);*/
}
function loadForms(){
    var tab = "3";
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
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
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
         //$("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        if(selected_emp == ""){
                        $( "#dialog-confirm-emp" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.ok}": function() {
                                    $( this ).dialog( "close" );
                                    
                              }
                          }
                       });
                    }else{
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        $("#form").submit();
                    }
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_forms.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
                            // $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+role);
                    }
                }
        });
    }else{
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_forms.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_forms.php?selected="+selected_emp+"&role="+role);
    }
    /*var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("{$url_path}ajax_privilege_forms.php?curr="+curr_tab+"&new_tab="+new_tab);*/
}
function loadGeneral(){
var tab = "4";
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
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
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
         //$("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        if(selected_emp == ""){
                        $( "#dialog-confirm-emp" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.ok}": function() {
                                    $( this ).dialog( "close" );
                                   
                              }
                          }
                       });
                    }else{
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        $("#form").submit();
                    }
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_general.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
                           // $("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+role);
                    }
                }
        });
    }else{
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_general.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_general.php?selected="+selected_emp+"&role="+role);
    }
    }
   /* var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("{$url_path}ajax_privilege_general.php?curr="+curr_tab+"&new_tab="+new_tab);*/


function loadMC(){
    var tab = "5";
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
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
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
         //$("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        if(selected_emp == ""){
                        $( "#dialog-confirm-emp" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.ok}": function() {
                                    $( this ).dialog( "close" );
                                    
                              }
                          }
                       });
                    }else{
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        $("#form").submit();
                    }
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_mc.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
                            //$("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+role);
                    }
                }
        });
    }
    else{
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privilege_mc.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        //$("#tabDetails").load("{$url_path}ajax_privilege_mc.php?selected="+selected_emp+"&role="+role);
    }
}
function loadPrivileges(){

    var tab = "1";
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
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
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        // $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        if(selected_emp == ""){
                            $( "#dialog-confirm-emp" ).dialog({
                            resizable: false,
                            height:140,
                            modal: true,
                            buttons: {
                                "{$translate.ok}": function() {
                                        $( this ).dialog( "close" );

                                  }
                              }
                           });
                        }else{
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            var role = $("#pre_role").val();
                            $("#roles").val(role);
                            $("#form").submit();
                        }
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
                           // $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"tab={$tab}"+"&role="+role);
                    }
                }
        });
    }else{
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                }
        });
        // $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"&role="+role);
    }
}

function setPrivilege(){
    var tab = '1';
    var curr_tab = $("#curr_tab").val();
    var role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    if(selected_emp != ""){ 
        $("#employees").val(selected_emp);
        $("#new_tab").val(curr_tab);
        $("#roles").val(role);
        $("#form").submit();
    }
    else{
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
                            $("#tabDetails").load("{$url_path}ajax_privileges.php?selected="+selected_emp+"tab={$tab}"+"&role="+role);
                    }
                }
        });
    }
}

function selectEmployee(){
    var customer = '{$customer_detail.username}';
    var role = $("#pre_role").val();
    var curr_tab = $("#curr_tab").val(); 
    $.ajax({
        url:"{$url_path}ajax_selected_employee_privilege.php",
        type:"GET",
        data:"cust="+customer+"&role="+role,
        success:function(data){
            $("#privilege_selected_employee").html(data);
            if(curr_tab == 1){
                loadPrivileges();
            }
            if(curr_tab == 2){
                loadReports();
            }
            if(curr_tab == 3){
                loadForms();
            }
            if(curr_tab == 4){
                loadGeneral();
            }
            if(curr_tab == 5){
                loadMC();
            }
            
        }
    });
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        if(made_change  == 1){
            var tab = $("#curr_tab").val();
            var curr_tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            if(selected_emp == ""){
                            $( "#dialog-confirm-emp" ).dialog({
                            resizable: false,
                            height:140,
                            modal: true,
                            buttons: {
                                "{$translate.ok}": function() {
                                        $( this ).dialog( "close" );
                                        document.location.href = redirectURL;
                                  }
                              }
                           });
                        }else{
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
                            var role = $("#pre_role").val();
                            $("#roles").val(role);
                            $("#form").submit();
                        }
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


function madeChange(){
    made_change = 1;
    $("#new").val(1);
    
}
function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}
</script>

{/block}