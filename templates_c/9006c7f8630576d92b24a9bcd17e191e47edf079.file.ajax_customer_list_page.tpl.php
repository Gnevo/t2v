<?php /* Smarty version Smarty-3.1.8, created on 2021-03-02 06:02:28
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_list_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:742926848603dd4f461dcb7-10228994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9006c7f8630576d92b24a9bcd17e191e47edf079' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_list_page.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '742926848603dd4f461dcb7-10228994',
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
  'unifunc' => 'content_603dd4f468fe64_41718962',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603dd4f468fe64_41718962')) {function content_603dd4f468fe64_41718962($_smarty_tpl) {?><ul id="pagination"> 
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