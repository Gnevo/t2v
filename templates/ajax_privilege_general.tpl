<script>
    $(document).ready(function(){
    if($('#come_and_go_on').is(':checked') == false){
        $('.hide_privilege').css('display','none');
    }
    else{
        $('.hide_privilege').show();
    }
    var change = $("#change").val();
    if(change == 1){
        bootbox.alert('{$translate.different_privileges}'); 
    }else{
        var priv_check = '{$privilege_check}';
        if(priv_check == '0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0'){
            $('#basic_previllage_general').attr('checked',true);
        } else if(priv_check == '1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1' || priv_check == '1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1' || priv_check == '1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1' || priv_check == '1,1,1,1,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'){
            $('#full_previllage_general').attr('checked',true);
        }
    }
    
    
        $("#general_candg").click(function() {
            if($('#general_candg').attr('checked')){
                if($('#general_candg_wo').attr('checked')){
                    $('#general_candg_wo').attr('checked',false);
                }
            }
            
        });
        $("#general_candg_wo").click(function() {
            if($('#general_candg_wo').attr('checked')){
                if($('#general_candg').attr('checked')){
                    $('#general_candg').attr('checked',false);
                }
            }

        });

        $('#come_and_go_on').click(function(){
            $('.hide_privilege').toggle();
        });
    });
    $("#privilage_link").removeClass("active");
    $("#report_link").removeClass("active");
    $("#form_link").removeClass("active");
    $("#general_link").removeClass("active");
    $("#mc_link").removeClass("active");
    $("#general_link").addClass("active");
</script>
<div class="tab-pane active" id="tab-1">
    <div class="row-fluid">
        <div class="span12">
            <div class="span12 highlight-checkbox-group-alert" style="margin-left:0 !important;">
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_general" {if $pre_role == 2}onclick="giveBasicPrivilegeGeneralAL()"{elseif $pre_role == 7}onclick="giveBasicPrivilegeGeneralGl()"{elseif $pre_role == 3}onclick="giveBasicPrivilegeGeneralEmp()"{/if}/>
                <span style="margin-left: 5px;">{$translate.basic_privilege}</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_general" onclick="giveFullPrivilegeGeneral()"/>
                <span style="margin-left: 5px;">{$translate.full_privilege}</span>
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
                    <input class="check-box" name="general_add_employee" type="checkbox" id="general_add_employee" value="1" {if $privilege[0] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.gen_add_employee}</span><br/>
                    <input class="check-box" name="general_add_customer" type="checkbox" id="general_add_customer" value="1" {if $privilege[1] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.gen_add_customer}</span><br/>
                    <input class="check-box" name="general_edit_employee" type="checkbox" id="general_edit_employee" value="1" {if $privilege[5] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.edit_employee}</span><br/>
                    <input class="check-box" name="general_edit_customer" type="checkbox" id="general_edit_customer" value="1" {if $privilege[6] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.edit_customer}</span><br/>
                    <input class="check-box " name="come_and_go_on" type="checkbox" id="come_and_go_on"  value="1" {if $privilege[35] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span  style="margin-left: 5px;" >{$translate.come_and_go_on}</span><br/>
                    <input class="check-box hide_privilege " name="general_candg" type="checkbox" id="general_candg" value="1"  {if $privilege[10] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"  />
                    <span class="hide_privilege" style="margin-left: 5px;">{$translate.come_n_go_with}</span><br class="hide_privilege" >
                    <input class="check-box hide_privilege " name="general_candg_wo" type="checkbox" id="general_candg_wo"  value="1"  {if $privilege[11] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"  />
                    <span class="hide_privilege" style="margin-left: 5px;">{$translate.come_n_go_without}</span><br class="hide_privilege" >
                    <input class="check-box" name="general_candg_stop_for_other_employees" type="checkbox" id="general_candg_stop_for_other_employees" value="1" {if $privilege[14] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.candg_stop_for_other_employees}</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="general_inconvenient_timing" type="checkbox" id="general_inconvenient_timing" value="1" {if $privilege[2] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.inconvenient_timing}</span><br/>
                    <input class="check-box" name="create_template" type="checkbox" id="create_template" value="1" {if $privilege[8] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.create_schedule_template}</span><br/>
                    <input class="check-box" name="use_template" type="checkbox" id="use_template" value="1" {if $privilege[9] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.use_template_schedule}</span><br/>
                    <input class="check-box" name="mobile_search" type="checkbox" id="mobile_search" value="1" {if $privilege[12] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.mobile_search}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employer_signing" type="checkbox" id="general_employer_signing" value="1" {if $privilege[13] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employer_signing}</span><br/>
                    <input class="check-box" name="general_export" type="checkbox" id="general_export" value="1" {if $privilege[3] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.administration}</span><br/>
                    <input class="check-box" name="survey" type="checkbox" id="survey" value="1" {if $privilege[7] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.survey}</span><br/>
                    <input class="check-box PrivilegeCheck" name="administration_fk_export" type="checkbox" id="administration_fk_export" value="1" {if $privilege[34] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.administration_fk_export}</span><br/>
                    <input class="check-box PrivilegeCheck" name="recruitment" type="checkbox" id="recruitment" value="1" {if $privilege[36] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.recruitment}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_fk" type="checkbox" id="general_customer_settings_insurance_fk" value="1" {if $privilege[22] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_insurance_fk}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_kn" type="checkbox" id="general_customer_settings_insurance_kn" value="1" {if $privilege[23] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_insurance_kn}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_tu" type="checkbox" id="general_customer_settings_insurance_tu" value="1" {if $privilege[24] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_insurance_tu}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_implan" type="checkbox" id="general_customer_settings_implan" value="1" {if $privilege[25] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_implan}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_deswork" type="checkbox" id="general_customer_settings_deswork" value="1" {if $privilege[26] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_deswork}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_documentation" type="checkbox" id="general_customer_settings_documentation" value="1" {if $privilege[27] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_documentation}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_equipment" type="checkbox" id="general_customer_settings_equipment" value="1" {if $privilege[28] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_equipment}</span><br/>
                    {*<input class="check-box PrivilegeCheck" name="general_customer_settings_privileges" type="checkbox" id="general_customer_settings_privileges" value="1" {if $privilege[29] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_privileges}</span><br/>*}
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_appointment" type="checkbox" id="general_customer_settings_appointment" value="1" {if $privilege[30] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_appointment}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_oncall" type="checkbox" id="general_customer_settings_oncall" value="1" {if $privilege[31] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_oncall}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_3066" type="checkbox" id="general_customer_settings_3066" value="1" {if $privilege[32] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.customer_settings_3066}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_sick_form_defaults" type="checkbox" id="general_customer_settings_sick_form_defaults" value="1" {if $privilege[33] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"/>
                    <span style="margin-left: 5px;">{$translate.customer_settings_sick_form_defaults}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_location" type="checkbox" id="general_customer_settings_location" value="1" {if $privilege[37] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"/>
                    <span style="margin-left: 5px;">{$translate.customer_settings_map_locations}</span><br/>

                    <input class="check-box PrivilegeCheck" name="general_customer_doc_field" type="checkbox" id="general_customer_doc_field" value="1" {if $privilege[38] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"/>
                    <span style="margin-left: 5px;">{$translate.general_customer_doc_field}</span><br/>

                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_contract" type="checkbox" id="general_employee_settings_contract" value="1" {if $privilege[15] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_settings_contract}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_salary" type="checkbox" id="general_employee_settings_salary" value="1" {if $privilege[16] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_settings_salary}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_notification" type="checkbox" id="general_employee_settings_notification" value="1" {if $privilege[17] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"  />
                    <span style="margin-left: 5px;">{$translate.employee_settings_notification}</span><br/>
                    {*<input class="check-box PrivilegeCheck" name="general_employee_settings_privileges" type="checkbox" id="general_employee_settings_privileges" value="1" {if $privilege[18] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_settings_privileges}</span><br/>*}
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_cv" type="checkbox" id="general_employee_settings_cv" value="1" {if $privilege[19] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"  />
                    <span style="margin-left: 5px;">{$translate.employee_settings_cv}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_documentation" type="checkbox" id="general_employee_settings_documentation" value="1" {if $privilege[20] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()"  />
                    <span style="margin-left: 5px;">{$translate.employee_settings_documentation}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_preference" type="checkbox" id="general_employee_settings_preference" value="1" {if $privilege[21] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_settings_preference}</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_checklist_preference" type="checkbox" id="general_employee_checklist_preference" value="1" {if $privilege[39] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.employee_checklist_preference}</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>