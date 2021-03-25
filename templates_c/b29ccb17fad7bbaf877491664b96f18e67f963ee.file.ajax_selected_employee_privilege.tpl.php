<?php /* Smarty version Smarty-3.1.8, created on 2020-12-14 14:00:34
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_selected_employee_privilege.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15711105575fd77002428091-20160436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b29ccb17fad7bbaf877491664b96f18e67f963ee' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_selected_employee_privilege.tpl',
      1 => 1487749590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15711105575fd77002428091-20160436',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'select_all' => 0,
    'pre_role' => 0,
    'translate' => 0,
    'cust' => 0,
    'selected' => 0,
    'employees' => 0,
    'employee' => 0,
    'url_path' => 0,
    'sort_by_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd770024bdc78_54913251',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd770024bdc78_54913251')) {function content_5fd770024bdc78_54913251($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['select_all']->value!=''){?>
   <ul class="selected-previlege-list">
       <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==3){?>
        <li class="child-slots-profile-two"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_employees'];?>
</li>
       <?php }?>
       <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==2){?>
        <li class="child-slots-profile-two"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_teamleaders'];?>
</li>
       <?php }?>
       <?php if ($_smarty_tpl->tpl_vars['pre_role']->value==7){?>
        <li class="child-slots-profile-two"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_super_tl'];?>
</li>
       <?php }?>
    </ul> 
<?php }else{ ?>    
    <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>
        <form style="margin: 0px;">
            <input type="hidden" name="selected_emp" id="selected_emp" value="<?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
" />
        </form>
        <ul class="selected-previlege-list">
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['employee']->value!=''){?>
                <li class="child-slots-profile-two"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
<?php }?></a></li>
            <?php }?>
        <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
            <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>

        <?php } ?> 
        </ul>
    <?php }else{ ?>
    <ul class="selected-previlege-list">
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['employee']->value!=''){?>
                <li class="child-slots-profile-two"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
<?php }?></a><a href="javascript:void(0);" onclick="removeEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
')" style="float: right; margin-left:5px;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_employee_tooltip'];?>
"><img border="0" align="right" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/remove_pink.png" alt=""><!--remove--></a></li>
            <?php }?>
        <?php } ?>

    </ul>
    <?php }?>
<?php }?><?php }} ?>