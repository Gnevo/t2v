<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:42:10
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_mc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6750682145fce2322e328a5-08176105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a5cd121eefd7b3cee32c3a48e24e5c30b264086' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_mc.tpl',
      1 => 1539777100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6750682145fce2322e328a5-08176105',
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
  'unifunc' => 'content_5fce2322eec891_67521694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce2322eec891_67521694')) {function content_5fce2322eec891_67521694($_smarty_tpl) {?><script type="text/javascript">
    $(document).ready(function () {
        var change = $("#change").val();
        if (change == 1) {
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['different_privileges'];?>
'); 
        } else {
            var pre_role_check = '<?php echo $_smarty_tpl->tpl_vars['pre_role']->value;?>
';
            var priv_check = '<?php echo $_smarty_tpl->tpl_vars['privilege_check']->value;?>
';
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
                <input class="check-box" type="checkbox" name="basic_previllage" id="basic_previllage_mc" <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>onclick="giveBasicPrivilegeMCAl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==7){?>onclick="giveBasicPrivilegeMCGl()"<?php }elseif($_smarty_tpl->tpl_vars['pre_role']->value==3){?>onclick="giveBasicPrivilegeMCEmp()"<?php }?> />
                <span style="margin-left: 5px;" for="basic_previllage"><?php echo $_smarty_tpl->tpl_vars['translate']->value['basic_privilege'];?>
</span>
                <input class="check-box" type="checkbox" name="full_previllage" id="full_previllage_mc"  onclick="giveFullPrivilegeMC()" />
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
            <input type="hidden" name="new" id="new" value="" />
            <input type="hidden" name="basic_prev" id="basic_prev" value="" />
            <input type="hidden" name="roles" id="roles" value="" />
            <input type="hidden" name="select_all" id="select_all" value="<?php echo $_smarty_tpl->tpl_vars['select_all']->value;?>
" />
            <input type="hidden" name="cust" id="cust" value="" />
        </div>
             </div>
             <div class="row-fluid">   
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_leave_notification" type="checkbox" id="mc_leave_notification" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[0]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_notification'];?>
</span><br/>
                    <input class="check-box" name="mc_leave_approval" type="checkbox" id="mc_leave_approval" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[1]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_approval'];?>
</span><br/>
                    <input class="check-box" name="mc_leave_rejection" type="checkbox" id="mc_leave_rejection" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[2]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_rejection'];?>
</span><br/>
                    <input class="check-box" name="mc_leave_edit" type="checkbox" id="mc_leave_edit" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[3]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_edit'];?>
</span><br/>
                    <input class="check-box" name="mc_approve_all_leave" type="checkbox" id="mc_approve_all_leave" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[14]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_approve_all'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="cirrus_mail" id="cirrus_mail" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[5]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cirrus_mail'];?>
</span><br/>
                    <input class="check-box" name="external_mail" id="external_mail" type="checkbox" value="1"<?php if ($_smarty_tpl->tpl_vars['privilege']->value[6]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['external_mail'];?>
</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_notes" id="mc_notes" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[4]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes'];?>
</span><br/>
                    <input class="check-box" name="mc_notes_approval" id="mc_notes_approval" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[8]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes_approval'];?>
</span><br/>
                    <input class="check-box" name="mc_notes_rejection" id="mc_notes_rejection" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[9]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes_rejection'];?>
</span><br/>
                    <input class="check-box" name="mc_notes_attchment" id="mc_notes_attchment" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[10]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes_attchments'];?>
</span><br/>
                </div>
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_sms" id="mc_sms" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[7]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sms'];?>
</span><br/>
                    <input class="check-box" name="mc_document_archive" id="mc_document_archive" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[11]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['document_archive'];?>
</span><br/>
                    <input class="check-box" name="mc_sms_general" id="mc_sms_general" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[13]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sms_general'];?>
</span><br/>
                </div>
            </div>
            <div class="span4">
                <div class="span12 highlight-checkbox-group" style="margin-left:0 !important;">
                    <input class="check-box" name="mc_support" id="mc_support" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['privilege']->value[12]==1&&$_smarty_tpl->tpl_vars['change']->value==0){?>checked="checked"<?php }?> onclick="madeChange()" />
                    <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['support'];?>
</span><br/>
                </div>
            </div>
            </div></div>
        </form>
    </div>
</div><?php }} ?>