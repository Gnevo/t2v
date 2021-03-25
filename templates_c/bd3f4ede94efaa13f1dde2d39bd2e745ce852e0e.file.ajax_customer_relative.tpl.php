<?php /* Smarty version Smarty-3.1.8, created on 2020-12-15 14:56:04
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_customer_relative.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8610265515fd8ce8403d2a9-46013909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd3f4ede94efaa13f1dde2d39bd2e745ce852e0e' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_customer_relative.tpl',
      1 => 1454059276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8610265515fd8ce8403d2a9-46013909',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type' => 0,
    'translate' => 0,
    'relative_details' => 0,
    'customer_relatives' => 0,
    'relative' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd8ce840c2074_12581214',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd8ce840c2074_12581214')) {function content_5fd8ce840c2074_12581214($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['type']->value=='add'){?>
<div class="span6 form-left">
    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
" type="text" name="relative_name" id="relative_name" value="" onchange="markChange()" />
            <input name="relative_id" id="relative_id" type="hidden"/>
        </div>
    </div>

    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_relation"><?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
</label>
        <div style="margin: 0px;" class="input-prepend span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
" type="text" name="relative_relation" id="relative_relation" value="" onchange="markChange()"/> </div>
    </div>

    <div style="margin: 10px 0px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
" type="text" name="relative_address" id="relative_address" value="" onchange="markChange()"/></div>
    </div>

    <div style="margin: 10px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
" type="text" name="relative_city" id="relative_city" value="" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span6 form-right">

    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
" type="text" name="relative_phone" id="relative_phone" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_work_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
" type="text" name="relative_work_phone" id="relative_work_phone" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
" type="text" name="relative_mobile" id="relative_mobile" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" type="email" name="relative_email" id="relative_email" value="" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span12" style="margin:0">
    <label class="span12" style="margin-top:0;" for="relative_other"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</label>
    <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()"><?php echo $_smarty_tpl->tpl_vars['relative_details']->value['other'];?>
</textarea>
</div>            
<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='load'){?>
    <div class="span6 form-left">
    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
" type="text" name="relative_name" id="relative_name" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['name'];?>
" onchange="markChange()" />
	    <input name="relative_id" id="relative_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['id'];?>
" />		
	</div>
    </div>

    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_relation"><?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
</label>
        <div style="margin: 0px;" class="input-prepend span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
" type="text" name="relative_relation" id="relative_relation" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['relation'];?>
" onchange="markChange()"/> </div>
    </div>

    <div style="margin: 10px 0px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
" type="text" name="relative_address" id="relative_address" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['address'];?>
" onchange="markChange()"/></div>
    </div>

    <div style="margin: 10px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
" type="text" name="relative_city" id="relative_city" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['city'];?>
" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span6 form-right">

    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
" type="text" name="relative_phone" id="relative_phone" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['phone'];?>
" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_work_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
" type="text" name="relative_work_phone" id="relative_work_phone" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['work_phone'];?>
" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
" type="text" name="relative_mobile" id="relative_mobile" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['mobile'];?>
" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" type="email" name="relative_email" id="relative_email" value="<?php echo $_smarty_tpl->tpl_vars['relative_details']->value['email'];?>
" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span12" style="margin:0">
    <label class="span12" style="margin-top:0;" for="relative_other"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</label>
    <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()"><?php echo $_smarty_tpl->tpl_vars['relative_details']->value['other'];?>
</textarea>
</div>
<?php }elseif($_smarty_tpl->tpl_vars['type']->value=='list'){?>
    <ul class="span12 list-group list-group-form input-group" style="float: left;">
        <?php  $_smarty_tpl->tpl_vars['relative'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relative']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_relatives']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relative']->key => $_smarty_tpl->tpl_vars['relative']->value){
$_smarty_tpl->tpl_vars['relative']->_loop = true;
?>    
            <li class="list-group-item span12 no-ml">
                <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['relative']->value['name'];?>
</a></div>
                <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['relative']->value['relation'];?>
</a></div>
                <div class="span1 pull-right"><button style="text-align: center;" class="btn btn-default btn-normal span12 pull-right" type="button" onclick="deleteRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')">x</button></div>
            </li>
        <?php }
if (!$_smarty_tpl->tpl_vars['relative']->_loop) {
?>    
            <li class="list-group-item">
                <div class="span5"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_relatives'];?>
</div>
                <div class="span5"></div>
                <div class="span1 pull-right"></div>
            </li>
        <?php } ?>
    </ul>
<?php }?>
<?php }} ?>