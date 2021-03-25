<?php /* Smarty version Smarty-3.1.8, created on 2021-03-11 10:33:43
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_support_ticket_category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18788523326049f20786b103-11269960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57f9795627e976bb03f99f015b8b8d82c4c54ba9' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_support_ticket_category.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18788523326049f20786b103-11269960',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'selected_category' => 0,
    'translate' => 0,
    'support_categories' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6049f20789d1f4_84732177',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6049f20789d1f4_84732177')) {function content_6049f20789d1f4_84732177($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.html_options.php';
?><span class="add-on icon-pencil"></span>
<select name="sprt_category" id="sprt_category" class="span10 form-control">
    <?php if ($_smarty_tpl->tpl_vars['selected_category']->value=='0'){?>
        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_ticket_category'];?>
</option>
    <?php }?>
    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['support_categories']->value,'selected'=>$_smarty_tpl->tpl_vars['selected_category']->value),$_smarty_tpl);?>

</select><?php }} ?>