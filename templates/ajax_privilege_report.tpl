<script>
     $(document).ready(function(){
     var change = $("#change").val();
    if(change == 1){
        bootbox.alert('{$translate.different_privileges}'); 
    }
    else{
        var pre_role_check = '{$pre_role}';
        var priv_check = '{$privilege_check}';
        if((pre_role_check == 2 && priv_check == '0,1,1,0,1,1,1,1,0,0,0,1,1,0,0') || (pre_role_check == 3 && priv_check == '0,0,0,0,1,1,1,1,0,0,0,1,1,0,0')){
            $('#basic_previllage_report').attr('checked',true);
        }else if( priv_check == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'){
            $('#full_previllage_report').attr('checked',true);
        }
    }
    });
    $("#privilage_link").removeClass("active");
    $("#report_link").removeClass("active");
    $("#form_link").removeClass("active");
    $("#general_link").removeClass("active");
    $("#mc_link").removeClass("active");
    $("#report_link").addClass("active");
</script>
<div class="tab-pane active" id="tab-1">
    <div class="row-fluid">
        <div class="span12">
            <div class="span12 highlight-checkbox-group-alert" style="margin-left:0 !important;">
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_report" {if $pre_role == 2}onclick="giveBasicPrivilegeReportAl()"{elseif $pre_role == 7}onclick="giveBasicPrivilegeReportGl()"{elseif $pre_role == 3}onclick="giveBasicPrivilegeReportEmp()"{/if}/>
                <span style="margin-left: 5px;" for="basic_previllage">{$translate.basic_privilege}</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_report" onclick="giveFullPrivilegeReport()" />
                <span style="margin-left: 5px;" for="basic_previllage">{$translate.full_privilege}</span>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <form id="form" name="form" method="post" action="">
            
        <div class="span12">
        <div class="row-fluid">
        	<div class="span12" style="min-height:0 !important;">
            <input type="hidden" name="curr_tab" id="curr_tab" value="{$tab}" />
            <input type="hidden" name="new_tab" id="new_tab" value="" />
            <input type="hidden" name="employees" id="employees" value="" />
            <input type="hidden" name="change" id="change" value="{$change}" />
            <input type="hidden" name="roles" id="roles" value="" />
            <input type="hidden" name="new" id="new" value="" />
            <input type="hidden" name="basic_prev" id="basic_prev" value="" />
            <input type="hidden" name="select_all" id="select_all" value="{$select_all}" />
            <input type="hidden" name="cust" id="cust" value="" />
        </div>
             </div>
            
            <div class="row-fluid">
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="customer_data" type="checkbox" id="customer_data" value="1" {if $privilege[0] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_data}</span><br/>
                    <input class="check-box" name="customer_leave" type="checkbox" id="customer_leave" value="1" {if $privilege[1] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_leave}</span><br/>
                    <input class="check-box" name="customer_granded_vs_used" type="checkbox" id="customer_granded_vs_used" value="1" {if $privilege[2] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_granded_vs_used}</span><br/>
                    <input class="check-box" name="customer_employee_connection" type="checkbox" id="customer_employee_connection" value="1" {if $privilege[3] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_employee_connection}</span><br/>
                    <input class="check-box" name="customer_schedule" type="checkbox" id="customer_schedule" value="1" {if $privilege[4] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_schedule}</span><br/>
                    <input class="check-box" name="customer_horizontal" type="checkbox" id="customer_horizontal" value="1" {if $privilege[5] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_horizontal}</span><br/>
                    <input class="check-box" name="customer_overview" type="checkbox" id="customer_overview" value="1" {if $privilege[6] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_overview}</span><br/>
                    <input class="check-box" name="customer_vacation_planning" type="checkbox" id="customer_vacation_planning" value="1" {if $privilege[7] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_vacation_planning}</span><br/>
                    <input class="check-box" name="customer_overlapping" type="checkbox" id="customer_overlapping" value="1" {if $privilege[14] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.overlapp_report}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="employee_data" type="checkbox" id="employee_data" value="1" {if $privilege[8] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_data}</span><br/>
                    <input class="check-box" name="employee_leave" type="checkbox" id="employee_leave" value="1" {if $privilege[9] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_leave}</span><br/>
                    <input class="check-box" name="employee_percentage" type="checkbox" id="employee_percentage" value="1" {if $privilege[10] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_percentage}</span><br/>
                    <input class="check-box" name="employee_schedule" type="checkbox" id="employee_schedule" value="1" {if $privilege[11] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_schedule}</span><br/>
                    <input class="check-box" name="employee_work_report" type="checkbox" id="employee_work_report" value="1" {if $privilege[12] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.monthly_work}</span><br/>
                    <input class="check-box" name="atl_warning" type="checkbox" id="atl_warning" value="1" {if $privilege[13] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.atl_warning}</span><br/>
                    <input class="check-box" name="employee_skill_report_privilege" type="checkbox" id="employee_skill_report_privilege" value="1" {if $privilege[15] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_skill_report_privilege}</span><br/>
                    <input class="check-box" name="employee_available_report" type="checkbox" id="employee_available_report" value="1" {if $privilege[16] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.available_employees_report}</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>