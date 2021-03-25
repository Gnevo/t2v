<?php /* Smarty version Smarty-3.1.8, created on 2021-03-18 12:29:08
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_contract_hours.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200193435160534794886598-09992573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3743ba45f0cbec246dcb933413ad65be1ed74944' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_contract_hours.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200193435160534794886598-09992573',
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
  'unifunc' => 'content_605347948c4122_39785525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_605347948c4122_39785525')) {function content_605347948c4122_39785525($_smarty_tpl) {?><ul class="time-date-info">
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