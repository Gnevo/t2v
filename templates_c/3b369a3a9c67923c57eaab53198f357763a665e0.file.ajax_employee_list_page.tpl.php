<?php /* Smarty version Smarty-3.1.8, created on 2021-02-22 11:18:59
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_employee_list_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32404771660339323a00434-27239028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b369a3a9c67923c57eaab53198f357763a665e0' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_employee_list_page.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32404771660339323a00434-27239028',
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
  'unifunc' => 'content_60339323a5aad5_43919548',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60339323a5aad5_43919548')) {function content_60339323a5aad5_43919548($_smarty_tpl) {?><ul id="pagination"> 
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