<script>
     $(document).ready(function(){

    var change = $("#change").val();
    if(change == 1){
        
        bootbox.alert('{$translate.different_privileges}'); 
    }else{
        var pre_role_check = '{$pre_role}';
        var priv_check = '{$privilege_check}';
        if(pre_role_check == 2 && priv_check == '1,0,0,0,0,0,0,0,0'){
            $('#basic_previllage_form').attr('checked',true);
        } else if(priv_check == '1,1,1,1,1,1,1,1,1'){
            $('#full_previllage_form').attr('checked',true);
        }
    }
         
    });
        
    $("#privilage_link").removeClass("active");
    $("#report_link").removeClass("active");
    $("#form_link").removeClass("active");
    $("#general_link").removeClass("active");
    $("#mc_link").removeClass("active");
    $("#form_link").addClass("active");
    
</script>
<div class="tab-pane active" id="tab-1">
    <div class="row-fluid">
        <div class="span12">
            <div class="span12 highlight-checkbox-group-alert" style="margin-left:0 !important;">
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_form" {if $pre_role == 2}onclick="giveBasicPrivilegeFormAl()"{elseif $pre_role == 7}onclick="giveBasicPrivilegeFormGl()" {elseif $pre_role == 3}onclick="giveBasicPrivilegeFormEmp()"{/if}/>
                <span style="margin-left: 5px;" for="basic_previllage">{$translate.basic_privilege}</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_form" onclick="giveFullPrivilegeForm()" />
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
                    <input class="check-box" name="form_fkkn" type="checkbox" id="form_fkkn" value="1" {if $privilege[0] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.fkkn}</span><br/>
                    <input class="check-box" name="form_leave" type="checkbox" id="form_leave" value="1" {if $privilege[1] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_form}</span><br/>
                    <input class="check-box" name="form_certificate" type="checkbox" id="form_certificate" value="1" {if $privilege[2] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.certificate}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="form_form_1" type="checkbox" id="form_form_1" value="1" {if $privilege[3] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_1}</span><br/>
                    <input class="check-box" name="form_form_2" type="checkbox" id="form_form_2" value="1" {if $privilege[4] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_2}</span><br/>
                    <input class="check-box" name="form_form_3" type="checkbox" id="form_form_3" value="1" {if $privilege[5] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_3}</span><br/>
                    <input class="check-box" name="form_form_4" type="checkbox" id="form_form_4" value="1" {if $privilege[9] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_4}</span><br/>
                    <input class="check-box" name="form_form_5" type="checkbox" id="form_form_5" value="1" {if $privilege[10] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_5}</span><br/>
                    <input class="check-box" name="form_form_6" type="checkbox" id="form_form_6" value="1" {if $privilege[11] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_6}</span><br/>
                    <input class="check-box" name="form_form_7" type="checkbox" id="form_form_7" value="1" {if $privilege[12] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_7}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="form_form_1_report" type="checkbox" id="form_form_1_report" value="1" {if $privilege[6] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_1_report}</span><br/>
                    <input class="check-box" name="form_form_2_report" type="checkbox" id="form_form_2_report" value="1" {if $privilege[7] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_2_report}</span><br/>
                    <input class="check-box" name="form_form_3_report" type="checkbox" id="form_form_3_report" value="1" {if $privilege[8] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.form_3_report}</span><br/>
                    <input class="check-box" name="employee_termination" type="checkbox" id="employee_termination" value="1" {if $privilege[13] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.privilege_employee_termination}</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>
            
