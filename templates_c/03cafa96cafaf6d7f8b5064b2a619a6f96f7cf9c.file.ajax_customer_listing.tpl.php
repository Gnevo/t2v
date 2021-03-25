<?php /* Smarty version Smarty-3.1.8, created on 2021-03-02 06:02:28
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_listing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:620708090603dd4f472a498-11265389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03cafa96cafaf6d7f8b5064b2a619a6f96f7cf9c' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/ajax_customer_listing.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '620708090603dd4f472a498-11265389',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'json_customers' => 0,
    'translate' => 0,
    'action' => 0,
    'customer_list' => 0,
    'customer' => 0,
    'sort_by_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_603dd4f479ca79_16364253',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603dd4f479ca79_16364253')) {function content_603dd4f479ca79_16364253($_smarty_tpl) {?><script>
$(document).ready(function(){
    $( "#search_cust" ).autocomplete({
        source: <?php echo $_smarty_tpl->tpl_vars['json_customers']->value;?>
,
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#temp_search_cust").val(this.value);
             paginateDisplay('1');
    }
    });
});
</script>

<table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
    <!-- Table heading -->
    <thead>
        <tr>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</th>
            <th><a href="javascript:void(0);" onclick="sortBy('CC');" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
</a></th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</th>
            <?php if ($_smarty_tpl->tpl_vars['action']->value=='inact'){?>
                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['inactive_date'];?>
</th>
            <?php }?>
            <th class="table-col-center small-col"></th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
            <tr class="gradeX" onclick="edit_btn('<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
')" style="cursor: pointer;">
                <td class="large-col">
                    <?php if ($_smarty_tpl->tpl_vars['customer']->value['ch']==1&&!empty($_smarty_tpl->tpl_vars['customer']->value['company'])){?>
                        <?php echo $_smarty_tpl->tpl_vars['customer']->value['company']['name'];?>

                    <?php }else{ ?>
                        <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                            <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>

                        <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                            <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>

                        <?php }?>
                    <?php }?></td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['social_security'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
</td>
                <td><?php if ($_smarty_tpl->tpl_vars['customer']->value['mobile']==''){?>----<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customer']->value['mobile'];?>
<?php }?> </td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['city'];?>
</td>
                <?php if ($_smarty_tpl->tpl_vars['action']->value=='inact'){?>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['date_inactive'];?>
</td>
                <?php }?>
                <td class="table-col-center small-col"><button type="button" onclick="edit_btn('<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
')" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
"><span class="icon-wrench"></span></button></td>
            </tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['customer']->_loop) {
?>
            <tr><td colspan="7">
                    <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                </td></tr>
            <?php } ?>
    </tbody>
</table><?php }} ?>