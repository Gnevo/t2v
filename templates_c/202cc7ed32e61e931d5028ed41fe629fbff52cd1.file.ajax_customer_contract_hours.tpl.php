<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 09:54:16
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_customer_contract_hours.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13167986155fcdfbc87cf666-58892351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '202cc7ed32e61e931d5028ed41fe629fbff52cd1' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_customer_contract_hours.tpl',
      1 => 1429180174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13167986155fcdfbc87cf666-58892351',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'translate' => 0,
    'no_of_days' => 0,
    'monthly_hrs' => 0,
    'weekly_hrs' => 0,
    'hrs' => 0,
    'remaining_hrs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcdfbc8819663_95836895',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcdfbc8819663_95836895')) {function content_5fcdfbc8819663_95836895($_smarty_tpl) {?><ul class="time-date-info">
    <li>
        <?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>

        <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['no_of_days']->value;?>
</div>
    </li>
    <li>
        <?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly'];?>

        <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['monthly_hrs']->value;?>
</div>
    </li>
    <li>
        <?php echo $_smarty_tpl->tpl_vars['translate']->value['weekly'];?>

        <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['weekly_hrs']->value;?>
</div>
    </li>
    <li>
        <?php echo $_smarty_tpl->tpl_vars['translate']->value['granded_hours'];?>

        <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['hrs']->value;?>
</div>
    </li>

    <li>
        <?php echo $_smarty_tpl->tpl_vars['translate']->value['remaining_hours'];?>

        <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['remaining_hrs']->value;?>
</div>
    </li>
</ul><?php }} ?>