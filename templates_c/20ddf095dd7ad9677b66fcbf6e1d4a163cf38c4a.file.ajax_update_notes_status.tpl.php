<?php /* Smarty version Smarty-3.1.8, created on 2020-12-16 07:12:24
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_update_notes_status.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13248766005fd9b358405531-01440415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20ddf095dd7ad9677b66fcbf6e1d4a163cf38c4a' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_update_notes_status.tpl',
      1 => 1425305600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13248766005fd9b358405531-01440415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'translate' => 0,
    'id' => 0,
    'url_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd9b35843c028_21289017',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd9b35843c028_21289017')) {function content_5fd9b35843c028_21289017($_smarty_tpl) {?><!--<td><?php if ($_smarty_tpl->tpl_vars['status']->value==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
<?php }elseif($_smarty_tpl->tpl_vars['status']->value==0){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['forbidden'];?>
<?php }?></td>-->
<?php if ($_smarty_tpl->tpl_vars['status']->value==1){?>
    <td  class="table-col-center center" style="width:15px;">
        <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(0,<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
)">
            <img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['set_as_forbidden'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/cirrus_icon_reject.png">
        </a>
    </td>

<?php }elseif($_smarty_tpl->tpl_vars['status']->value==0){?>
    <td  class="table-col-center center" style="width:15px;">
        <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
)">
            <img width="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['set_as_active'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/icon_approve.png">
        </a>
    </td>

<?php }?><?php }} ?>