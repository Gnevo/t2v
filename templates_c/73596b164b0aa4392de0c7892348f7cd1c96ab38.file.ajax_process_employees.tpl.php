<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 15:12:35
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_process_employees.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13802781765fce4663eae856-65730864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73596b164b0aa4392de0c7892348f7cd1c96ab38' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_process_employees.tpl',
      1 => 1425305594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13802781765fce4663eae856-65730864',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type' => 0,
    'employee_details' => 0,
    'employee_detail' => 0,
    'translate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fce4663f02584_64535321',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce4663f02584_64535321')) {function content_5fce4663f02584_64535321($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['type']->value=='rep'){?>
    <?php  $_smarty_tpl->tpl_vars['employee_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee_detail']->key => $_smarty_tpl->tpl_vars['employee_detail']->value){
$_smarty_tpl->tpl_vars['employee_detail']->_loop = true;
?>

        <input type="radio" class = "rep_radio" name="employees" value = "<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value['username'];?>
" onclick="loadEmployee()"><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value['last_name']);?>
<br />
    <?php } ?>
<?php }else{ ?>
    
    
        <?php if (count($_smarty_tpl->tpl_vars['employee_details']->value)>0){?>
            <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['type']->value==''){?>name="all_check"  id="all_check"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='del'){?>name="all_check1"  id="all_check1"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='atl'){?>name="all_check2"  id="all_check2"<?php }?>  <?php if ($_smarty_tpl->tpl_vars['type']->value==''){?>onclick="empCheckAll()"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='del'){?>onclick="empCheckAll1()"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='atl'){?>onclick="empCheckAll2()"<?php }?>><span style="font-weight:bold; margin: 0 0 0 10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>
</span><br />
        <?php }?>
        <?php  $_smarty_tpl->tpl_vars['employee_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee_detail']->key => $_smarty_tpl->tpl_vars['employee_detail']->value){
$_smarty_tpl->tpl_vars['employee_detail']->_loop = true;
?>
            
            <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['type']->value==''){?>class="emp_check"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='del'){?>class="emp_check1"<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='atl'){?>class="emp_check2"<?php }?> name="employees" value = <?php echo $_smarty_tpl->tpl_vars['employee_detail']->value['username'];?>
><span style="margin: 0 0 0 10px;"><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value['last_name']);?>
</span><br />
   
        <?php } ?>      

<?php }?><?php }} ?>