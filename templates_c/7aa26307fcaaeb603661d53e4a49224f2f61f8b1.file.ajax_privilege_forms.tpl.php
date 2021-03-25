<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:40:30
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_forms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7710933895fce22be82c137-10360488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7aa26307fcaaeb603661d53e4a49224f2f61f8b1' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_forms.tpl',
      1 => 1556166992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7710933895fce22be82c137-10360488',
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
  'unifunc' => 'content_5fce22be8b6039_43401665',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce22be8b6039_43401665')) {function content_5fce22be8b6039_43401665($_smarty_tpl) {?><script>
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
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_form" <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>onclick="giveBasicPrivilegeFormAl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==7){?>onclick="giveBasicPrivilegeFormGl()" <?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==3){?>onclick="giveBasicPrivilegeFormEmp()"<?php }?>/>
                <span style="margin-left: 5px;" for="basic_previllage"><?php echo $_smarty_tpl->tpl_vars['translate']->value['basic_privilege'];?>
</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_form" onclick="giveFullPrivilegeForm()" />
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
                    <input class="check-box" name="form_fkkn" type="checkbox" id="form_fkkn" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[0]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn'];?>
</span><br/>
                    <input class="check-box" name="form_leave" type="checkbox" id="form_leave" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[1]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_form'];?>
</span><br/>
                    <input class="check-box" name="form_certificate" type="checkbox" id="form_certificate" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[2]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['certificate'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="form_form_1" type="checkbox" id="form_form_1" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[3]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_1'];?>
</span><br/>
                    <input class="check-box" name="form_form_2" type="checkbox" id="form_form_2" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[4]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2'];?>
</span><br/>
                    <input class="check-box" name="form_form_3" type="checkbox" id="form_form_3" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[5]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_3'];?>
</span><br/>
                    <input class="check-box" name="form_form_4" type="checkbox" id="form_form_4" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[9]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_4'];?>
</span><br/>
                    <input class="check-box" name="form_form_5" type="checkbox" id="form_form_5" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[10]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_5'];?>
</span><br/>
                    <input class="check-box" name="form_form_6" type="checkbox" id="form_form_6" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[11]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_6'];?>
</span><br/>
                    <input class="check-box" name="form_form_7" type="checkbox" id="form_form_7" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[12]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_7'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="form_form_1_report" type="checkbox" id="form_form_1_report" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[6]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_1_report'];?>
</span><br/>
                    <input class="check-box" name="form_form_2_report" type="checkbox" id="form_form_2_report" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[7]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2_report'];?>
</span><br/>
                    <input class="check-box" name="form_form_3_report" type="checkbox" id="form_form_3_report" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[8]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_3_report'];?>
</span><br/>
                    <input class="check-box" name="employee_termination" type="checkbox" id="employee_termination" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[13]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['privilege_employee_termination'];?>
</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div>
            
<?php }} ?>