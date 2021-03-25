<?php /* Smarty version Smarty-3.1.8, created on 2020-12-08 12:38:32
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_get_time_table_dates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18040598105fcf73c8494b33-31655223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c527b77b1b11a91a7b84bda9944a6461e6434d7f' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_get_time_table_dates.tpl',
      1 => 1498131954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18040598105fcf73c8494b33-31655223',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'company' => 0,
    'translate' => 0,
    'dates' => 0,
    'entries' => 0,
    'certificate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcf73c8507d75_66604104',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcf73c8507d75_66604104')) {function content_5fcf73c8507d75_66604104($_smarty_tpl) {?><script type="text/javascript">
function show_certificate(){
    var c_name = $("#cmb_certificate").val();
    if(c_name != "")
        {
            //window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['company']->value;?>
/created_pdf_files/"+c_name);
            window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_viewer.php?name="+c_name);
            //alert("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['company']->value;?>
/created_pdf_files/"+c_name);
        }
}
</script>
<div class="span12 no-ml">
    <span class="span2">Arbetad tid avser:</span>
    <select name="lstTidStart" id="lstTidStart" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-right: 15px;"  onchange="generate_section_3()">
        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['entries']->value['val'];?>
"><?php echo $_smarty_tpl->tpl_vars['entries']->value['disp'];?>
</option>
        <?php } ?>
    </select>
    till
    <select name="lstTidSlut" id="lstTidSlut" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-left: 15px;" onchange="generate_section_3()">
        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['entries']->value['val'];?>
"><?php echo $_smarty_tpl->tpl_vars['entries']->value['disp'];?>
</option>
        <?php } ?>
    </select>
</div>
<?php if ($_smarty_tpl->tpl_vars['certificate']->value){?>
    <div class="span12 no-ml">
        <span class="span2">Tidigare arbetsgivarintyg:</span>
        <select name='cmb_certificate' id="cmb_certificate" onchange="show_certificate()">
            <option value=""  selected ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
            <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['certificate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <option value=<?php echo $_smarty_tpl->tpl_vars['entries']->value['file'];?>
><?php echo $_smarty_tpl->tpl_vars['entries']->value['date'];?>
</option>
            <?php } ?>
        </select>
    </div>
<?php }?><?php }} ?>