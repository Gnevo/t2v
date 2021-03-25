<script>
    $(document).ready(function(){


    var change = $("#change").val();
    if(change == 1){
        bootbox.alert('{$translate.different_privileges}'); 
    }else{
        var pre_role_check = '{$pre_role}';
        var priv_check = '{$privilege_check}';
        if((pre_role_check == 2 && priv_check == '1,1,1,1,0,0,1,0,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0') || (pre_role_check == 3 && priv_check == '1,0,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0')){
            $('#basic_previllage').attr('checked',true);
        } else if(priv_check == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0'){
            $('#full_previllage').attr('checked',true);
        }
     }   
    });
    $("#privilage_link").removeClass("active");
    $("#report_link").removeClass("active");
    $("#form_link").removeClass("active");
    $("#general_link").removeClass("active");
    $("#mc_link").removeClass("active");
    $("#privilage_link").addClass("active");
</script>
<div class="tab-pane active" id="tab-1">
    <div class="row-fluid">
        <div class="span12">
            <div class="span12 highlight-checkbox-group-alert" style="margin-left:0 !important;">
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage" {if $pre_role == 2}onclick="giveBasicPrivilegeAL()"{elseif $pre_role ==7}onclick="giveBasicPrivilegeGl()"{elseif $pre_role == 3}onclick="giveBasicPrivilegeEmp()"{/if} />
                <span style="margin-left: 5px;">{$translate.basic_privilege}</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage" onclick="giveFullPrivilege()" />
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
                    <input class="check-box" name="swap" type="checkbox" id="swap" value="1" {if $change == 0 && $privilege[0]==1} checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.swap}</span><br/>
                    <input class="check-box" name="process" type="checkbox" id="process" value="1" {if $privilege[1] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.process}</span>
                </div>
                <div style="margin-left: 0px;" class="span12 highlight-checkbox-group">
                    <input class="check-box" name="add_slot" id="add_slot" type="checkbox" value="1" {if $privilege[2] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.add_slot}</span><br/>
                    <input class="check-box" name="fkkn" id="fkkn" type="checkbox" value="1" {if $privilege[3] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.fkkn}</span><br/>
                    <input class="check-box" name="slot_type" id="slot_type" type="checkbox" value="1" {if $privilege[4] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.slot_type}</span><br/>
                    <input class="check-box" name="add_customer" id="add_customer" type="checkbox" value="1" {if $privilege[5] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.add_customer}</span><br/>
                    <input class="check-box" name="add_employee" id="add_employee" type="checkbox" value="1" {if $privilege[6] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.add_employee}</span><br/>
                    <input class="check-box" name="leave" id="leave" type="checkbox" value="1" {if $privilege[9] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave}</span><br/>
                    <input class="check-box" name="no_pay_leave" id="no_pay_leave" type="checkbox" value="1" {if $privilege[21] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.no_pay_leave}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="copy_single_slot" id="copy_single_slot" type="checkbox" value="1" {if $privilege[10] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.copy_single_slot}</span><br/>
                    <input class="check-box" name="copy_single_slot_option" id="copy_single_slot_option" type="checkbox" value="1" {if $privilege[11] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.copy_single_slot_option}</span><br/>
                    <input class="check-box" name="copy_day_slot" id="copy_day_slot" type="checkbox" value="1" {if $privilege[12] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.copy_day_slot}</span><br/>
                    <input class="check-box" name="copy_day_slot_option" id="copy_day_slot_option" type="checkbox" value="1" {if $privilege[13] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.copy_day_slot_option}</span><br/>
                </div>
                <div style="margin-left: 0px;" class="span12 highlight-checkbox-group">
                    <input class="check-box" name="delete_slot" id="delete_slot" type="checkbox" value="1" {if $privilege[15] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.delete_slot}</span><br/>
                    <input class="check-box" name="delete_day_slot" id="delete_day_slot" type="checkbox" value="1" {if $privilege[16] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.delete_day_slot}</span><br/>
                    <input class="check-box" name="delete_multiple_slots" id="delete_multiple_slots" type="checkbox" value="1" {if $privilege[17] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.delete_multiple_slots}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="split_slot" id="split_slot" type="checkbox" value="1" {if $privilege[14] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.split_slot}</span><br/>
                    <input class="check-box" name="remove_customer" id="remove_customer" type="checkbox" value="1" {if $privilege[7] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.remove_customer}</span><br/>
                    <input class="check-box" name="remove_employee" id="remove_employee" type="checkbox" value="1" {if $privilege[8] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.remove_employee}</span><br/>
                    <input class="check-box" name="contract_override" id="contract_override" type="checkbox" value="1" {if $privilege[18] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.contract_override}</span><br/>
                    <input class="check-box" name="atl_override" id="atl_override" type="checkbox" value="1" {if $privilege[19] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.atl_override}</span><br/>
                    <input class="check-box" name="change_time" id="change_time" type="checkbox" value="1" {if $privilege[20] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.change_time}</span><br/>
                    <input class="check-box" name="candg_approve" id="candg_approve" type="checkbox" value="1" {if $privilege[22] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.candg_approve}</span><br/>
                    <input class="check-box" name="show_percentage_month" id="show_percentage_month" type="checkbox" value="1" {if $privilege[23] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.show_percentage_monthly}</span><br/>
                    <input class="check-box" name="not_show_employees" id="not_show_employees" type="checkbox" value="1" {if $privilege[24] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.not_show_other_employees}</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>