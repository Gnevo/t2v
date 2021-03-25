<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 12:37:19
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_support_ticket_category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3714521645fcb7effa8e2a3-29432746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aea1f4e98e6a5ed820ee987497375c4351de7278' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_support_ticket_category.tpl',
      1 => 1436164510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3714521645fcb7effa8e2a3-29432746',
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
  'unifunc' => 'content_5fcb7effabf284_82775401',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb7effabf284_82775401')) {function content_5fcb7effabf284_82775401($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_options.php';
?><span class="add-on icon-pencil"></span>
<select name="sprt_category" id="sprt_category" class="span10 form-control">
    <?php if ($_smarty_tpl->tpl_vars['selected_category']->value=='0'){?>
        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_ticket_category'];?>
</option>
    <?php }?>
    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['support_categories']->value,'selected'=>$_smarty_tpl->tpl_vars['selected_category']->value),$_smarty_tpl);?>

</select><?php }} ?>