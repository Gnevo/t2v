<?php /* Smarty version Smarty-3.1.8, created on 2021-03-18 05:23:21
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_employee_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12978491476052e3c94822e3-10436773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08b51bf95d2ba0eb3baa32e7740544df30156664' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_employee_list.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
    '20cfd39a22270b7c60ddb8b63f5f419f0a1f105d' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/ajax_popup.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12978491476052e3c94822e3-10436773',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6052e3c95c2ba6_68595385',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6052e3c95c2ba6_68595385')) {function content_6052e3c95c2ba6_68595385($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
?>


<script type="text/javascript">
    
</script>                    



<?php if ($_smarty_tpl->tpl_vars['listtype']->value=='toadd'){?>
    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
        <div id="a<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" class="span12 child-slots-profile">
            <span class="glyphicons icon-plus pull-right remove-child-slots cursor_hand" onclick="assignEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['assign_employee'];?>
"></span>
            <span class="cursor_hand underline_link" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/employee/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/CUST_ADD/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
<?php }?></span>
            <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==2){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['team_leader'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['substitute']==1){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>
            <?php }?>

        </div><!--CHILD SLOT END-->
    <?php } ?>
<?php }elseif($_smarty_tpl->tpl_vars['listtype']->value=='listed'){?>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
        <li class="clearfix">
            <input type="checkbox" name="na<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" id="na<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" onclick="addToAssign('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
')" checked="true" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" />
            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
            <div style="float: left;"><label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
</label></div>
            <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
            <div style="float: left;"><label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
</label></div>
             
            <?php }?><span style="margin-right: 5px;float: right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
            <div style="float: left;clear: left;margin-top: 5px"> 
               
            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==2){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==3){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
)
            <?php }?>
            </div>
        </li>
    <?php } ?>
    </ul>
<?php }elseif($_smarty_tpl->tpl_vars['listtype']->value=='toalloc'){?>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
        <li class="clearfix">
            <input type="checkbox" name="na<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" id="na<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" checked="true" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" />
            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                <div style="float: left;"><label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
</label></div>
            <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                <div style="float: left;"><label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
</label></div>
            <?php }?>
            
            <span style="margin-right: 5px;float: right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
            <div style="float: left;clear: left;margin-top: 5px"> 
                
            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==2){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==3){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
)
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7){?>
                (<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
)
            <?php }?>
            </div>
        </li>
    <?php } ?>
    </ul>
<?php }elseif($_smarty_tpl->tpl_vars['listtype']->value=='allocated'){?>
    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
        <div id="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
"  class="span12 child-slots-profile-two">
            <span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand" onclick="removeEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_employee'];?>
"></span>
            <span>
                <span class="cursor_hand underline_link" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/employee/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/CUST_ADD/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['name_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['name'];?>
<?php }?></span>
                <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
            </span>
            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==1){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['substitute']==1){?>
                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>
            <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['employee']->value['tl']==1){?><span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['team_leader'];?>
</span><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==2&&$_smarty_tpl->tpl_vars['employee']->value['tl']==0){?>
            <a href="javascript:void(0);" class="maketl" onclick="makeTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_team_leader'];?>
</a>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==0){?>
            <a href="javascript:void(0);" class="maketl" onclick="makeSTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_super_team_leader'];?>
</a>
        <?php }?>

    </div>
    <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
    <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
    <?php } ?>
<?php }else{ ?>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
        <li class="clearfix">
            <input type="checkbox" name="employees" id="employees" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" />
            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                <label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
</label>
            <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                <label for="name"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
</label>
            <?php }?>
        </li>
    <?php } ?>
    </ul>
<?php }?>


<?php }} ?>