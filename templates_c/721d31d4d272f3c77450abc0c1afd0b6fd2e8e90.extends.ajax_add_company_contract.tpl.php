<?php /* Smarty version Smarty-3.1.8, created on 2020-12-14 15:02:48
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_add_company_contract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13298186955fd77e987b1a08-59445611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '721d31d4d272f3c77450abc0c1afd0b6fd2e8e90' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_add_company_contract.tpl',
      1 => 1564567962,
      2 => 'file',
    ),
    'ce4febf4e508230689026b0cffa9751d916fb1c3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/ajax_popup.tpl',
      1 => 1425363384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13298186955fd77e987b1a08-59445611',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd77e98878309_06731701',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd77e98878309_06731701')) {function content_5fd77e98878309_06731701($_smarty_tpl) {?>


<script type="text/javascript">
$(document).ready(function(){
    <?php if ($_smarty_tpl->tpl_vars['action']->value!="delete"){?>  $( "#contract_from, #contract_to" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
            buttonImageOnly: true
    });<?php }?>
});

function saveFormPopup(){
    var errors = 0;
    if($("#contract_from").val() == "" || $("#contract_from").val() == null){
        $("#contract_from").addClass("error");
        errors = 1;
    }else{
        $("#contract_from").removeClass("error");
    }
    if($("#contract_to").val() == "" || $("#contract_to").val() == null){
        $("#contract_to").addClass("error");
        errors = 1;
    }else{
        $("#contract_to").removeClass("error");
    }
    if($("#price_sms").val() == "" || $("#price_sms").val() == null){
        $("#price_sms").addClass("error");
        errors = 1;
    }else{
        $("#price_sms").removeClass("error");
    }
    if($("#price_cust").val() == "" || $("#price_cust").val() == null){
        $("#price_cust").addClass("error");
        errors = 1;
    }else{
        $("#price_cust").removeClass("error");
    }
    if(errors == 0){
        $("#forms_popup").submit();
    }
}

function deleteFormPopup(){
    $('#delete_popup').submit();
}
</script>


<?php if ($_smarty_tpl->tpl_vars['action']->value!="delete"){?>
<form name="forms_popup" id="forms_popup" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_add_company_contract.php" style="margin-top: 5px">
    
    <input type="hidden" name="hiden_val" id="hiden_val" value="" />
    <input type="hidden" name="company" id="company" value="<?php echo $_smarty_tpl->tpl_vars['company_id']->value;?>
" />
    <input type="hidden" name="contract_id" id="contract_id" value="<?php echo $_smarty_tpl->tpl_vars['contract_id']->value;?>
" />
    <input type="hidden" name="action" id="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
    <div class="equi_raw">
        <label for="contract_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_contract_from'];?>
</label>
        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['contract_detail']->value[0]['contract_from'];?>
" id="contract_from" name="contract_from" <?php if ($_smarty_tpl->tpl_vars['action']->value!="delete"){?> style="width:40%"<?php }?> <?php if ($_smarty_tpl->tpl_vars['action']->value=="delete"){?>readonly="readonly"<?php }?>>
   </div>
    <div class="equi_raw">
        <label for="contract_to"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_contract_to'];?>
</label>
         <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['contract_detail']->value[0]['contract_to'];?>
" id="contract_to" name="contract_to"<?php if ($_smarty_tpl->tpl_vars['action']->value!="delete"){?> style="width:40%"<?php }?> <?php if ($_smarty_tpl->tpl_vars['action']->value=="delete"){?>readonly="readonly"<?php }?>>
    </div>
    <div class="equi_raw">
        <label for="price_sms"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sms'];?>
</label>
        <input type="text" name="price_sms" id="price_sms" value="<?php echo $_smarty_tpl->tpl_vars['contract_detail']->value[0]['price_per_sms'];?>
" <?php if ($_smarty_tpl->tpl_vars['action']->value=="delete"){?>readonly="readonly"<?php }?>/>
    </div> 
    <div class="equi_raw">
        <label for="price_cust"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_customer'];?>
</label>
        <input type="text" name="price_cust" id="price_cust" value="<?php echo $_smarty_tpl->tpl_vars['contract_detail']->value[0]['price_per_customer'];?>
" <?php if ($_smarty_tpl->tpl_vars['action']->value=="delete"){?>readonly="readonly"<?php }?>/>
    </div>
    <div class="equi_raw">
        <label for="price_sign"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sign'];?>
</label>
        <input type="text" name="price_sign" id="price_sign" value="<?php echo $_smarty_tpl->tpl_vars['contract_detail']->value[0]['price_per_sign'];?>
" <?php if ($_smarty_tpl->tpl_vars['action']->value=="delete"){?>readonly="readonly"<?php }?>/>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#issue_popup').dialog('close');" href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</a>
        <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;" onclick="saveFormPopup()" href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</a>
    </div> 
</form><?php }else{ ?>
<div style="margin:17px 37px 30px 35px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_conform_company_contract'];?>
</div>
<form name="delete_popup" id="delete_popup" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_add_company_contract.php">
    <input type="hidden" name="company" id="company" value="<?php echo $_smarty_tpl->tpl_vars['company_id']->value;?>
" />
    <input type="hidden" name="contract_id" id="contract_id" value="<?php echo $_smarty_tpl->tpl_vars['contract_id']->value;?>
" />
    <input type="hidden" name="action" id="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</form>
<div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
    <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#issue_popup').dialog('close');" href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</a>
    <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;" onclick="deleteFormPopup()" href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</a>
</div>    
        <?php }?>

<?php }} ?>