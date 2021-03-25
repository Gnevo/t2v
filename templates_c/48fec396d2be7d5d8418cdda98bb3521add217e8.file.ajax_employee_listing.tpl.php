<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:42:24
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_employee_listing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6494478305fcb64100b1920-65273205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48fec396d2be7d5d8418cdda98bb3521add217e8' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_employee_listing.tpl',
      1 => 1574676520,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6494478305fcb64100b1920-65273205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'json_employees' => 0,
    'translate' => 0,
    'action' => 0,
    'count_log' => 0,
    'employee_list' => 0,
    'url_path' => 0,
    'employee' => 0,
    'sort_by_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb64101328f6_59609146',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb64101328f6_59609146')) {function content_5fcb64101328f6_59609146($_smarty_tpl) {?><script>
    $(document).ready(function() {
        $( "#search_emp" ).autocomplete({
                source: <?php echo $_smarty_tpl->tpl_vars['json_employees']->value;?>
,
                select: function( event, ui ) {
                     this.value = ui.item.value;
                     $("#temp_search_emp").val(this.value);
                     paginateDisplay('1');
                }
        });
    });
</script>
<table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda recruitment-table" id="header-fixed">
   <thead>
        <tr>
            <th><a href="javascript:void(0);" onclick="sortBy('n')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</a></th>
            <th><a href="javascript:void(0);" onclick="sortBy('ec')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
</a></th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['signature'];?>
</th>
            <th>
            <?php if ($_smarty_tpl->tpl_vars['action']->value=='act'){?>
            <a href="javascript:void(0);" onclick="sortBy('lg')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_login'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['loggedin'];?>
 (<?php echo $_smarty_tpl->tpl_vars['count_log']->value;?>
)</a>
            <?php }else{ ?>
            <?php echo $_smarty_tpl->tpl_vars['translate']->value['inactive_date'];?>

            <?php }?>
            </th>
            <th><a href="javascript:void(0);" onclick="sortBy('r')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_role'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['role'];?>
</a></th>
            <th><a href="javascript:void(0);" onclick="sortBy('el')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_error_login'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['error_login'];?>
</a></th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</th>
            <th class="table-col-center small-col"></th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            <tr class="gradeX" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/';" style="cursor: pointer;">
                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                    <td class="large-col"><?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
</td> 
                <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                    <td class="large-col"><?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
</td>
                <?php }?>
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['social_security'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
</td>
                <td>
                <?php if ($_smarty_tpl->tpl_vars['action']->value=='act'){?>
                    <?php if ($_smarty_tpl->tpl_vars['employee']->value['login']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
<?php }?>
                <?php }elseif($_smarty_tpl->tpl_vars['action']->value=='inact'){?>
                    <?php echo $_smarty_tpl->tpl_vars['employee']->value['date_inactive'];?>

                <?php }?>
                </td>
                <td><?php if ($_smarty_tpl->tpl_vars['employee']->value['role']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
<?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
<?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
<?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==5){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
<?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==6){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
<?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==7){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
<?php }?></td>
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['error_login'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['mobile'];?>
</td>
                <td class="table-col-center small-col"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/" class="btn btn-default"><i class="icon-wrench"></i></a></td>
            </tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
            <tr><td colspan="8">
                    <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table><?php }} ?>