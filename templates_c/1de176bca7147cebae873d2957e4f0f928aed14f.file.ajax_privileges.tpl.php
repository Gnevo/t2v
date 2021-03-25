<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:20:56
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privileges.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13194561875fce1e28a85a89-23493108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1de176bca7147cebae873d2957e4f0f928aed14f' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privileges.tpl',
      1 => 1495025428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13194561875fce1e28a85a89-23493108',
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
  'unifunc' => 'content_5fce1e28b4a3f9_71163028',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce1e28b4a3f9_71163028')) {function content_5fce1e28b4a3f9_71163028($_smarty_tpl) {?><script>
    $(document).ready(function(){


    var change = $("#change").val();
    if(change == 1){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['different_privileges'];?>
'); 
    }else{
        var pre_role_check = '<?php echo $_smarty_tpl->tpl_vars['pre_role']->value;?>
';
        var priv_check = '<?php echo $_smarty_tpl->tpl_vars['privilege_check']->value;?>
';
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
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage" <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>onclick="giveBasicPrivilegeAL()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==7){?>onclick="giveBasicPrivilegeGl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==3){?>onclick="giveBasicPrivilegeEmp()"<?php }?> />
                <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['basic_privilege'];?>
</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage" onclick="giveFullPrivilege()" />
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
                    <input class="check-box" name="swap" type="checkbox" id="swap" value="1" <?php if ($_smarty_tpl->tpl_vars['change']->value==0&&$_smarty_tpl->tpl_vars['privilege']->value[0]==1){?> checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
</span><br/>
                    <input class="check-box" name="process" type="checkbox" id="process" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[1]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['process'];?>
</span>
                </div>
                <div style="margin-left: 0px;" class="span12 highlight-checkbox-group">
                    <input class="check-box" name="add_slot" id="add_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[2]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_slot'];?>
</span><br/>
                    <input class="check-box" name="fkkn" id="fkkn" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[3]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn'];?>
</span><br/>
                    <input class="check-box" name="slot_type" id="slot_type" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[4]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['slot_type'];?>
</span><br/>
                    <input class="check-box" name="add_customer" id="add_customer" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[5]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_customer'];?>
</span><br/>
                    <input class="check-box" name="add_employee" id="add_employee" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[6]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_employee'];?>
</span><br/>
                    <input class="check-box" name="leave" id="leave" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[9]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</span><br/>
                    <input class="check-box" name="no_pay_leave" id="no_pay_leave" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[21]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_pay_leave'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="copy_single_slot" id="copy_single_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[10]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_single_slot'];?>
</span><br/>
                    <input class="check-box" name="copy_single_slot_option" id="copy_single_slot_option" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[11]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_single_slot_option'];?>
</span><br/>
                    <input class="check-box" name="copy_day_slot" id="copy_day_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[12]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_day_slot'];?>
</span><br/>
                    <input class="check-box" name="copy_day_slot_option" id="copy_day_slot_option" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[13]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_day_slot_option'];?>
</span><br/>
                </div>
                <div style="margin-left: 0px;" class="span12 highlight-checkbox-group">
                    <input class="check-box" name="delete_slot" id="delete_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[15]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_slot'];?>
</span><br/>
                    <input class="check-box" name="delete_day_slot" id="delete_day_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[16]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_day_slot'];?>
</span><br/>
                    <input class="check-box" name="delete_multiple_slots" id="delete_multiple_slots" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[17]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_multiple_slots'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="split_slot" id="split_slot" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[14]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['split_slot'];?>
</span><br/>
                    <input class="check-box" name="remove_customer" id="remove_customer" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[7]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_customer'];?>
</span><br/>
                    <input class="check-box" name="remove_employee" id="remove_employee" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[8]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_employee'];?>
</span><br/>
                    <input class="check-box" name="contract_override" id="contract_override" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[18]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_override'];?>
</span><br/>
                    <input class="check-box" name="atl_override" id="atl_override" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[19]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['atl_override'];?>
</span><br/>
                    <input class="check-box" name="change_time" id="change_time" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[20]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['change_time'];?>
</span><br/>
                    <input class="check-box" name="candg_approve" id="candg_approve" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[22]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['candg_approve'];?>
</span><br/>
                    <input class="check-box" name="show_percentage_month" id="show_percentage_month" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[23]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['show_percentage_monthly'];?>
</span><br/>
                    <input class="check-box" name="not_show_employees" id="not_show_employees" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[24]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['not_show_other_employees'];?>
</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div><?php }} ?>