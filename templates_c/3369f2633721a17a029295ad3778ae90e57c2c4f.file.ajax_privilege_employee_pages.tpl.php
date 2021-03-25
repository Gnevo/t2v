<?php /* Smarty version Smarty-3.1.8, created on 2021-01-27 14:30:49
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_employee_pages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4884191560117919859c15-03544412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3369f2633721a17a029295ad3778ae90e57c2c4f' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_employee_pages.tpl',
      1 => 1425305592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4884191560117919859c15-03544412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_601179198c0e98_43178197',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601179198c0e98_43178197')) {function content_601179198c0e98_43178197($_smarty_tpl) {?>
<ul id="pagination">
    <?php if ($_smarty_tpl->tpl_vars['total']->value>1){?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value>=2&&$_smarty_tpl->tpl_vars['page']->value!=$_smarty_tpl->tpl_vars['total']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&lt;&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&lt;</a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
</a></li>
             <li class="active"><a  href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&gt;&gt;</a></li>
        <?php }elseif($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['total']->value){?>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&lt;&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
</a></li>
             <li class="active"><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
        <?php }elseif($_smarty_tpl->tpl_vars['page']->value==1){?>
             <li class="active"><a  href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
')">&gt;&gt;</a></li>
        
        <?php }?>
    <?php }?>
</ul>

           <?php }} ?>