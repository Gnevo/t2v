<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:42:01
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_general.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16143405265fce23190e8b76-00534592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99a8e413378c349813422fbbda0f12adb4373c36' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_general.tpl',
      1 => 1550739190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16143405265fce23190e8b76-00534592',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'translate' => 0,
    'privilege_check' => 0,
    'pre_role' => 0,
    'tab' => 0,
    'change' => 0,
    'select_all' => 0,
    'privilege' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fce2319210951_17293447',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce2319210951_17293447')) {function content_5fce2319210951_17293447($_smarty_tpl) {?><script>
    $(document).ready(function(){
    if($('#come_and_go_on').is(':checked') == false){
        $('.hide_privilege').css('display','none');
    }
    else{
        $('.hide_privilege').show();
    }
    var change = $("#change").val();
    if(change == 1){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['different_privileges'];?>
'); 
    }else{
        var priv_check = '<?php echo $_smarty_tpl->tpl_vars['privilege_check']->value;?>
';
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
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_general" <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>onclick="giveBasicPrivilegeGeneralAL()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==7){?>onclick="giveBasicPrivilegeGeneralGl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==3){?>onclick="giveBasicPrivilegeGeneralEmp()"<?php }?>/>
                <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['basic_privilege'];?>
</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_general" onclick="giveFullPrivilegeGeneral()"/>
                <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['full_privilege'];?>
</span>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <form id="form" name="form" method="post" action="">
        <div class="span12">
        <div class="row-fluid">
        	<div class="span12" style="min-height:0 !important;">
            <input type="hidden" name="curr_tab" id="curr_tab" value="<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
" />
            <input type="hidden" name="new_tab" id="new_tab" value="" />
            <input type="hidden" name="employees" id="employees" value="" />
            <input type="hidden" name="change" id="change" value="<?php echo $_smarty_tpl->tpl_vars['change']->value;?>
" />
            <input type="hidden" name="roles" id="roles" value="" />
            <input type="hidden" name="new" id="new" value="" />
            <input type="hidden" name="basic_prev" id="basic_prev" value="" />
            <input type="hidden" name="select_all" id="select_all" value="<?php echo $_smarty_tpl->tpl_vars['select_all']->value;?>
" />
            <input type="hidden" name="cust" id="cust" value="" />
            </div>
        </div>
            
            <div class="row-fluid">   
                <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="general_add_employee" type="checkbox" id="general_add_employee" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[0]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gen_add_employee'];?>
</span><br/>
                    <input class="check-box" name="general_add_customer" type="checkbox" id="general_add_customer" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[1]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gen_add_customer'];?>
</span><br/>
                    <input class="check-box" name="general_edit_employee" type="checkbox" id="general_edit_employee" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[5]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_employee'];?>
</span><br/>
                    <input class="check-box" name="general_edit_customer" type="checkbox" id="general_edit_customer" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[6]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_customer'];?>
</span><br/>
                    <input class="check-box " name="come_and_go_on" type="checkbox" id="come_and_go_on"  value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[35]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span  style="margin-left: 5px;" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['come_and_go_on'];?>
</span><br/>
                    <input class="check-box hide_privilege " name="general_candg" type="checkbox" id="general_candg" value="1"  <?php if ($_smarty_tpl->tpl_vars['privilege']->value[10]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"  />
                    <span class="hide_privilege" style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['come_n_go_with'];?>
</span><br class="hide_privilege" >
                    <input class="check-box hide_privilege " name="general_candg_wo" type="checkbox" id="general_candg_wo"  value="1"  <?php if ($_smarty_tpl->tpl_vars['privilege']->value[11]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"  />
                    <span class="hide_privilege" style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['come_n_go_without'];?>
</span><br class="hide_privilege" >
                    <input class="check-box" name="general_candg_stop_for_other_employees" type="checkbox" id="general_candg_stop_for_other_employees" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[14]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['candg_stop_for_other_employees'];?>
</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="general_inconvenient_timing" type="checkbox" id="general_inconvenient_timing" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[2]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient_timing'];?>
</span><br/>
                    <input class="check-box" name="create_template" type="checkbox" id="create_template" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[8]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['create_schedule_template'];?>
</span><br/>
                    <input class="check-box" name="use_template" type="checkbox" id="use_template" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[9]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['use_template_schedule'];?>
</span><br/>
                    <input class="check-box" name="mobile_search" type="checkbox" id="mobile_search" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[12]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile_search'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employer_signing" type="checkbox" id="general_employer_signing" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[13]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employer_signing'];?>
</span><br/>
                    <input class="check-box" name="general_export" type="checkbox" id="general_export" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[3]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['administration'];?>
</span><br/>
                    <input class="check-box" name="survey" type="checkbox" id="survey" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[7]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['survey'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="administration_fk_export" type="checkbox" id="administration_fk_export" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[34]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['administration_fk_export'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="recruitment" type="checkbox" id="recruitment" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[36]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['recruitment'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_fk" type="checkbox" id="general_customer_settings_insurance_fk" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[22]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_insurance_fk'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_kn" type="checkbox" id="general_customer_settings_insurance_kn" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[23]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_insurance_kn'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_insurance_tu" type="checkbox" id="general_customer_settings_insurance_tu" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[24]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_insurance_tu'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_implan" type="checkbox" id="general_customer_settings_implan" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[25]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_implan'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_deswork" type="checkbox" id="general_customer_settings_deswork" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[26]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_deswork'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_documentation" type="checkbox" id="general_customer_settings_documentation" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[27]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_documentation'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_equipment" type="checkbox" id="general_customer_settings_equipment" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[28]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_equipment'];?>
</span><br/>
                    
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_appointment" type="checkbox" id="general_customer_settings_appointment" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[30]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_appointment'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_oncall" type="checkbox" id="general_customer_settings_oncall" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[31]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_oncall'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_3066" type="checkbox" id="general_customer_settings_3066" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[32]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_3066'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_sick_form_defaults" type="checkbox" id="general_customer_settings_sick_form_defaults" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[33]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"/>
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_sick_form_defaults'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_customer_settings_location" type="checkbox" id="general_customer_settings_location" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[37]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"/>
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_settings_map_locations'];?>
</span><br/>

                    <input class="check-box PrivilegeCheck" name="general_customer_doc_field" type="checkbox" id="general_customer_doc_field" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[38]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"/>
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['general_customer_doc_field'];?>
</span><br/>

                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_contract" type="checkbox" id="general_employee_settings_contract" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[15]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_contract'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_salary" type="checkbox" id="general_employee_settings_salary" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[16]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_salary'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_notification" type="checkbox" id="general_employee_settings_notification" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[17]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"  />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_notification'];?>
</span><br/>
                    
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_cv" type="checkbox" id="general_employee_settings_cv" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[19]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"  />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_cv'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_documentation" type="checkbox" id="general_employee_settings_documentation" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[20]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()"  />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_documentation'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_settings_preference" type="checkbox" id="general_employee_settings_preference" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[21]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_settings_preference'];?>
</span><br/>
                    <input class="check-box PrivilegeCheck" name="general_employee_checklist_preference" type="checkbox" id="general_employee_checklist_preference" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[39]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_checklist_preference'];?>
</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div><?php }} ?>