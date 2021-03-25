<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 12:51:06
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_customer_list_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:493282615fcb823a09b5f0-41420165%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ac8544496a5a3d35b3bdd2f1291d212519743bb' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_customer_list_page.tpl',
      1 => 1460024060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '493282615fcb823a09b5f0-41420165',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'count' => 0,
    'page' => 0,
    'url_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb823a0f7589_11765290',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb823a0f7589_11765290')) {function content_5fcb823a0f7589_11765290($_smarty_tpl) {?><ul id="pagination"> 
    <?php if ($_smarty_tpl->tpl_vars['count']->value>1){?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value>=2&&$_smarty_tpl->tpl_vars['page']->value!=$_smarty_tpl->tpl_vars['count']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/first.png"  /></a></li>
                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/prev.png"  /></a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/nxt.png"  /></a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/last.png"  /></a></li>
        <?php }elseif($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['count']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/first.png"  /></a></li>
                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/prev.png"  /></a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
        <?php }elseif($_smarty_tpl->tpl_vars['page']->value==1){?>
            <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/nxt.png"  /></a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/last.png"  /></a></li>
        
        <?php }?>
    <?php }?>
 </ul><?php }} ?>