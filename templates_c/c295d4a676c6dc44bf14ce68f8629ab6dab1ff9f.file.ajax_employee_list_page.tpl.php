<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:42:23
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_employee_list_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19781401545fcb640fdb0d22-43594038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c295d4a676c6dc44bf14ce68f8629ab6dab1ff9f' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_employee_list_page.tpl',
      1 => 1460024090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19781401545fcb640fdb0d22-43594038',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'count' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb640fe02d16_97576082',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb640fe02d16_97576082')) {function content_5fcb640fe02d16_97576082($_smarty_tpl) {?><ul id="pagination"> 
    <?php if ($_smarty_tpl->tpl_vars['count']->value>1){?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value>=2&&$_smarty_tpl->tpl_vars['page']->value!=$_smarty_tpl->tpl_vars['count']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')">&lt;&lt;</a></li>
             <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')">&lt;</a></li>
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
')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
')">&gt;&gt;</a></li>
        <?php }elseif($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['count']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')">&lt;&lt;</a></li>
             <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
')">&lt;</a></li>
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
')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
')">&gt;&gt;</a></li>
        
        <?php }?>
    <?php }?>
 </ul><?php }} ?>