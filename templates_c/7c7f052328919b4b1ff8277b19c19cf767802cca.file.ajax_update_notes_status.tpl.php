<?php /* Smarty version Smarty-3.1.8, created on 2021-03-12 10:53:47
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_update_notes_status.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1296967157604b483be26888-98499171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c7f052328919b4b1ff8277b19c19cf767802cca' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_update_notes_status.tpl',
      1 => 1613804739,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1296967157604b483be26888-98499171',
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
  'unifunc' => 'content_604b483be65ef0_80072011',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_604b483be65ef0_80072011')) {function content_604b483be65ef0_80072011($_smarty_tpl) {?><!--<td><?php if ($_smarty_tpl->tpl_vars['status']->value==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
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