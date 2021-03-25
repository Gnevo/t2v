<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:22:11
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4585447275fce1e734c9b44-41084192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18035c48ff297b830b5b8c0c6d84d7a900c693b1' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_report.tpl',
      1 => 1589181974,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4585447275fce1e734c9b44-41084192',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'translate' => 0,
    'pre_role' => 0,
    'privilege_check' => 0,
    'tab' => 0,
    'change' => 0,
    'select_all' => 0,
    'privilege' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fce1e73565b58_88688300',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce1e73565b58_88688300')) {function content_5fce1e73565b58_88688300($_smarty_tpl) {?><script>
     $(document).ready(function(){
     var change = $("#change").val();
    if(change == 1){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['different_privileges'];?>
'); 
    }
    else{
        var pre_role_check = '<?php echo $_smarty_tpl->tpl_vars['pre_role']->value;?>
';
        var priv_check = '<?php echo $_smarty_tpl->tpl_vars['privilege_check']->value;?>
';
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
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_report" <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>onclick="giveBasicPrivilegeReportAl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==7){?>onclick="giveBasicPrivilegeReportGl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==3){?>onclick="giveBasicPrivilegeReportEmp()"<?php }?>/>
                <span style="margin-left: 5px;" for="basic_previllage"><?php echo $_smarty_tpl->tpl_vars['translate']->value['basic_privilege'];?>
</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_report" onclick="giveFullPrivilegeReport()" />
                <span style="margin-left: 5px;" for="basic_previllage"><?php echo $_smarty_tpl->tpl_vars['translate']->value['full_privilege'];?>
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
                    <input class="check-box" name="customer_data" type="checkbox" id="customer_data" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[0]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_data'];?>
</span><br/>
                    <input class="check-box" name="customer_leave" type="checkbox" id="customer_leave" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[1]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_leave'];?>
</span><br/>
                    <input class="check-box" name="customer_granded_vs_used" type="checkbox" id="customer_granded_vs_used" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[2]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_granded_vs_used'];?>
</span><br/>
                    <input class="check-box" name="customer_employee_connection" type="checkbox" id="customer_employee_connection" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[3]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_employee_connection'];?>
</span><br/>
                    <input class="check-box" name="customer_schedule" type="checkbox" id="customer_schedule" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[4]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_schedule'];?>
</span><br/>
                    <input class="check-box" name="customer_horizontal" type="checkbox" id="customer_horizontal" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[5]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_horizontal'];?>
</span><br/>
                    <input class="check-box" name="customer_overview" type="checkbox" id="customer_overview" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[6]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_overview'];?>
</span><br/>
                    <input class="check-box" name="customer_vacation_planning" type="checkbox" id="customer_vacation_planning" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[7]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_vacation_planning'];?>
</span><br/>
                    <input class="check-box" name="customer_overlapping" type="checkbox" id="customer_overlapping" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[14]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['overlapp_report'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="employee_data" type="checkbox" id="employee_data" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[8]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_data'];?>
</span><br/>
                    <input class="check-box" name="employee_leave" type="checkbox" id="employee_leave" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[9]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_leave'];?>
</span><br/>
                    <input class="check-box" name="employee_percentage" type="checkbox" id="employee_percentage" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[10]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_percentage'];?>
</span><br/>
                    <input class="check-box" name="employee_schedule" type="checkbox" id="employee_schedule" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[11]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_schedule'];?>
</span><br/>
                    <input class="check-box" name="employee_work_report" type="checkbox" id="employee_work_report" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[12]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_work'];?>
</span><br/>
                    <input class="check-box" name="atl_warning" type="checkbox" id="atl_warning" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[13]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['atl_warning'];?>
</span><br/>
                    <input class="check-box" name="employee_skill_report_privilege" type="checkbox" id="employee_skill_report_privilege" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[15]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_skill_report_privilege'];?>
</span><br/>
                    <input class="check-box" name="employee_available_report" type="checkbox" id="employee_available_report" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[16]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['available_employees_report'];?>
</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div><?php }} ?>