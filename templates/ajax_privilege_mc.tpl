<script type="text/javascript">
    $(document).ready(function () {
        var change = $("#change").val();
        if (change == 1) {
            bootbox.alert('{$translate.different_privileges}'); 
        } else {
            var pre_role_check = '{$pre_role}';
            var priv_check = '{$privilege_check}';
            if ((pre_role_check == 2 && priv_check == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1') || (pre_role_check == 3 && priv_check == '0,0,0,0,1,1,1,0,0,0,0,0,1,0,0')) {
                $('#basic_previllage_mc').attr('checked', true);
            } else if (priv_check == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1') {
                $('#full_previllage_mc').attr('checked', true);
            }
        }
    });
    $("#privilage_link").removeClass("active");
    $("#report_link").removeClass("active");
    $("#form_link").removeClass("active");
    $("#general_link").removeClass("active");
    $("#mc_link").removeClass("active");
    $("#mc_link").addClass("active");
</script>
<div class="tab-pane active" id="tab-1">
    <div class="row-fluid">
        <div class="span12">
            <div class="span12 highlight-checkbox-group-alert" style="margin-left:0 !important;">
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_mc" {if $pre_role == 2}onclick="giveBasicPrivilegeMCAl()"{elseif $pre_role == 7}onclick="giveBasicPrivilegeMCGl()"{elseif $pre_role == 3}onclick="giveBasicPrivilegeMCEmp()"{/if} />
                <span style="margin-left: 5px;" for="basic_previllage">{$translate.basic_privilege}</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_mc"  onclick="giveFullPrivilegeMC()" />
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
            <input type="hidden" name="new" id="new" value="" />
            <input type="hidden" name="basic_prev" id="basic_prev" value="" />
            <input type="hidden" name="roles" id="roles" value="" />
            <input type="hidden" name="select_all" id="select_all" value="{$select_all}" />
            <input type="hidden" name="cust" id="cust" value="" />
        </div>
             </div>
             <div class="row-fluid">   
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_leave_notification" type="checkbox" id="mc_leave_notification" value="1" {if $privilege[0] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_notification}</span><br/>
                    <input class="check-box" name="mc_leave_approval" type="checkbox" id="mc_leave_approval" value="1" {if $privilege[1] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_approval}</span><br/>
                    <input class="check-box" name="mc_leave_rejection" type="checkbox" id="mc_leave_rejection" value="1" {if $privilege[2] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_rejection}</span><br/>
                    <input class="check-box" name="mc_leave_edit" type="checkbox" id="mc_leave_edit" value="1" {if $privilege[3] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_edit}</span><br/>
                    <input class="check-box" name="mc_approve_all_leave" type="checkbox" id="mc_approve_all_leave" value="1" {if $privilege[14] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.leave_approve_all}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="cirrus_mail" id="cirrus_mail" type="checkbox" value="1" {if $privilege[5] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.cirrus_mail}</span><br/>
                    <input class="check-box" name="external_mail" id="external_mail" type="checkbox" value="1"{if $privilege[6] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.external_mail}</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_notes" id="mc_notes" type="checkbox" value="1" {if $privilege[4] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.notes}</span><br/>
                    <input class="check-box" name="mc_notes_approval" id="mc_notes_approval" type="checkbox" value="1" {if $privilege[8] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.notes_approval}</span><br/>
                    <input class="check-box" name="mc_notes_rejection" id="mc_notes_rejection" type="checkbox" value="1" {if $privilege[9] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.notes_rejection}</span><br/>
                    <input class="check-box" name="mc_notes_attchment" id="mc_notes_attchment" type="checkbox" value="1" {if $privilege[10] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.notes_attchments}</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_sms" id="mc_sms" type="checkbox" value="1" {if $privilege[7] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.sms}</span><br/>
                    <input class="check-box" name="mc_document_archive" id="mc_document_archive" type="checkbox" value="1" {if $privilege[11] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.document_archive}</span><br/>
                    <input class="check-box" name="mc_sms_general" id="mc_sms_general" type="checkbox" value="1" {if $privilege[13] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.sms_general}</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_support" id="mc_support" type="checkbox" value="1" {if $privilege[12] == 1 && $change ==0}checked="checked"{/if} onclick="madeChange()" />
                    <span style="margin-left: 5px;">{$translate.support}</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>