<?php /* Smarty version Smarty-3.1.8, created on 2020-12-10 07:24:24
         compiled from "/home/time2view/public_html/cirrus/templates/customer_equipment_issue_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10479957375fd1cd28b42d96-49060809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d6136dc78c502a68d91b1820f1d85b8fa12af90' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/customer_equipment_issue_popup.tpl',
      1 => 1425305616,
      2 => 'file',
    ),
    'ce4febf4e508230689026b0cffa9751d916fb1c3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/ajax_popup.tpl',
      1 => 1425363384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10479957375fd1cd28b42d96-49060809',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd1cd28bed0e6_96852518',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd1cd28bed0e6_96852518')) {function content_5fd1cd28bed0e6_96852518($_smarty_tpl) {?>


<script type="text/javascript">
       $(function() {
		$( "#issued_dates" ).datepicker({
		showOn: "button",
		buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
		buttonImageOnly: true
		});
		$( "#returned_dates" ).datepicker({
		showOn: "button",
		buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
		buttonImageOnly: true
		});
	});
         $(function() {
		var availableTags1 = [
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['itemss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['equipments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemss']->key => $_smarty_tpl->tpl_vars['itemss']->value){
$_smarty_tpl->tpl_vars['itemss']->_loop = true;
?>
                     "<?php echo $_smarty_tpl->tpl_vars['itemss']->value['equipment'];?>
",       
                    <?php } ?>
                        ""
                                
                            
		];
                var availableTags2 = [
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['serial_number'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['serial_number']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['serial_numbers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['serial_number']->key => $_smarty_tpl->tpl_vars['serial_number']->value){
$_smarty_tpl->tpl_vars['serial_number']->_loop = true;
?>
                     "<?php echo $_smarty_tpl->tpl_vars['serial_number']->value['serial_number'];?>
",       
                    <?php } ?>
                        ""
                                
                            
		];
                
		$( "#equipment_names" ).autocomplete({
			source: availableTags1,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_names").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                $( "#equipment_nums" ).autocomplete({
			source: availableTags2,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val1").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val1").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_nums").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                   
	});
   
function submitForm(){
    var errors = 0;
    if($("#equipment_names").val() == "" || $("#equipment_names").val() == null){
        $("#equipment_names").addClass("error");
        errors = 1;
    }else{
        $("#equipment_names").removeClass("error");
    }
    if($("#equipment_nums").val() == "" || $("#equipment_nums").val() == null){
        $("#equipment_nums").addClass("error");
        errors = 1;
    }else{
        $("#equipment_nums").removeClass("error");
    }
    if($("#issued_dates").val() == "" || $("#issued_dates").val() == null){
        $("#issued_dates").addClass("error");
        errors = 1;
    }else{
        $("#issued_dates").removeClass("error");
    }
    if($("#returned_dates").val() != ""){
        if($("#issued_dates").val() > $("#returned_dates").val()){
            alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['return_date_greater'];?>
");
            $("#returned_dates").addClass("error");
            errors = 1;
        }
    }else{
        $("#returned_dates").removeClass("error");
    }
    
    if(errors == 0){
      $("#forms").submit();
    }
    
}
        
</script>


<div>
    <form name="forms" id="forms" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer_equipment_issue_popup.php">
            <input type="hidden" name="username" id="username" value="<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
" />
            <input type="hidden" name="hiden_val" id="hiden_val" value="" />
            <input type="hidden" name="hiden_val1" id="hiden_val1" value="" />
            
                       
                            <div class="equi_raw">
                                <label for="equipment_names"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</label>
                                <input autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" type="text" name="equipment_names" id="equipment_names" class="clear required" <?php if ($_smarty_tpl->tpl_vars['names']->value!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['names']->value;?>
" <?php }else{ ?> value="" <?php }?> />
                                
                            </div>
                            <div class="equi_raw">
                                <label for="equipment_nums"><?php echo $_smarty_tpl->tpl_vars['translate']->value['serial_number'];?>
</label>
                                <input type="text" name="equipment_nums" id="equipment_nums" class="clear required"  <?php if ($_smarty_tpl->tpl_vars['serials']->value!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['serials']->value;?>
" <?php }else{ ?> value="" <?php }?>  />
                            </div>
                        
                          
                       
                            <div class="equi_date">
                                <label for="issueddate"><?php echo $_smarty_tpl->tpl_vars['translate']->value['issue_date'];?>
</label>
                                <input type="text" name="issued_dates" id="issued_dates" class="clear required issued_date" <?php if ($_smarty_tpl->tpl_vars['issues']->value!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['issues']->value;?>
" <?php }else{ ?> value="" <?php }?> />
                            </div>
                             <div class="equi_date">
                                <label for="returneddate"><?php echo $_smarty_tpl->tpl_vars['translate']->value['return_date'];?>
</label>
                                <input type="text" name="returned_dates" id="returned_dates" class="clear returned_date"  <?php if ($_smarty_tpl->tpl_vars['returns']->value!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['returns']->value;?>
" <?php }else{ ?> value="" <?php }?> />
                                <input type="hidden" name="id_equipment" id="id_equipment" class="clear returned_date"  <?php if ($_smarty_tpl->tpl_vars['ids']->value!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['ids']->value;?>
" <?php }else{ ?> value="" <?php }?> />
                                <!-- <div id="err" class="form_error" style="font-weight:normal; color:#FF0000; line-height:18px;"></div> -->
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['names']->value==''){?>
                            
                                <div class="equipment_bu_add"><input name="add" type="button" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
" onclick="submitForm()" /></div>
                                <input type="hidden" name="method" id="method" value="add" />
                            
                             
                        
                        <?php }else{ ?> 
                            <div class="equipment_bu_add"><input name="edit" type="button" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
" onclick="submitForm()" /></div>
                            <input type="hidden" name="method" id="method" value="edit" />
                        <?php }?>
                        
                        <div id="form_err" class="form_error"></div>              
                     
    </form>
</div>

<?php }} ?>