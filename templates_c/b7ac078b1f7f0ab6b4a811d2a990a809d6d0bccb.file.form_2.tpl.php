<?php /* Smarty version Smarty-3.1.8, created on 2021-02-11 15:33:22
         compiled from "/home/time2view/public_html/cirrus/templates/forms/form_2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177177555360254e424f6bd8-46388592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7ac078b1f7f0ab6b4a811d2a990a809d6d0bccb' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/forms/form_2.tpl',
      1 => 1539176060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177177555360254e424f6bd8-46388592',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'customerid' => 0,
    'lang' => 0,
    'message' => 0,
    'employee_username' => 0,
    'translate' => 0,
    'customers' => 0,
    'customer' => 0,
    'sort_by_name' => 0,
    'form_datas' => 0,
    'form_data' => 0,
    'reviewid' => 0,
    'privileges_forms' => 0,
    'user_role' => 0,
    'company_details' => 0,
    'review_data' => 0,
    'form_questions' => 0,
    'i' => 0,
    'question' => 0,
    'question_id' => 0,
    'employees' => 0,
    'created_user_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_60254e426223b8_68880555',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60254e426223b8_68880555')) {function content_60254e426223b8_68880555($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
?>

<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->



<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        var sel_customer = '<?php echo $_smarty_tpl->tpl_vars['customerid']->value;?>
';
        if($(window).height() > 400){
            $('#samsida_hold').css({ height: $(window).height()-109}); 
            $('#form_data').css({ height: $(window).height()-50});
        } else {
            $('#samsida_hold').css({ height: $(window).height()});
            $('#form_data').css({ height: $(window).height()});  
        }

        $(window).resize(function(){
           if($(window).height() > 400){
                $('#samsida_hold').css({ height: $(window).height()-109}); 
                $('#form_data').css({ height: $(window).height()-50});
           } else {
                $('#samsida_hold').css({ height: $(window).height()});
                $('#form_data').css({ height: $(window).height()});  
           }
        });  
        $("#customer").change(function() {
            var customer_id = $(this).val();
            if(customer_id != "" && customer_id != 0){
                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php?customer=' + customer_id, 8);
            }
        });
        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
        $.datepicker.formatDate('yy-mm-dd', ev.date);
    });
    
    
function saveForm(){
    var customer = document.getElementById("customer").value;
    if(customer != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        $('#action').val('save');
        f.submit();
    } else {
        alert('All Fields are required');
    }
}

function downloadForm(){
    var customer = document.getElementById("customer").value;
    var review = document.getElementById("review").value;
    if(customer != "" && review != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        $('#action').val('pdf');
        f.submit();
    } else {
        alert('All Fields are required');
    }
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php?review=' + reviewid +'&customer=' + customer, 8);
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php?customer=' + customerid, 8);
    }
}

function goToReport() {
    var customer_id = $('#customer').val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2_report.php?customer=' + customer_id,8);
}

function goToQuesions() {
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2_questions.php', 8);
}
</script>




    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2'];?>

                            <ul class="pull-right">
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="customer" name="customer">
                                            <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['customerid']->value==$_smarty_tpl->tpl_vars['customer']->value['username']){?>selected<?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['customer']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer']->value['last_name']);?>
<?php }else{ ?><?php echo (($_smarty_tpl->tpl_vars['customer']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer']->value['first_name']);?>
<?php }?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span10" id="review" name="review" onchange="selectReview()">
                                            <option data-group="0" value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_review'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['form_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form_datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form_data']->key => $_smarty_tpl->tpl_vars['form_data']->value){
$_smarty_tpl->tpl_vars['form_data']->_loop = true;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['customerid']->value==$_smarty_tpl->tpl_vars['form_data']->value['customer']){?>
                                                    <option data-group="<?php echo $_smarty_tpl->tpl_vars['form_data']->value['customer'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['form_data']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['reviewid']->value==$_smarty_tpl->tpl_vars['form_data']->value['id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['form_data']->value['created_date'];?>
</option>
                                                <?php }?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <!--<li><i class="icon-plus"></i><a href="javascript:void(0);" onclick="addNew()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</span></a></li>-->
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_2_report']==1||$_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                    <li><i class="icon-filter"></i><a href="javascript:void(0);" onclick="goToReport();"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['report'];?>
</span></a></li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                    <li><i class="icon-wrench"></i><a href="javascript:void(0);" onclick="goToQuesions();"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['questions'];?>
</span></a></li>
                                <?php }?>
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer_forms.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a></li>
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</span></a></li>
                                <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</span></a></li>
                                <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="downloadForm()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a></li>
                            </ul>
                        </h4>
                    </div>
                </div>
                <div id="forms_container" class="span12 no-ml">
                    <div id="samsida_hold" style="overflow:auto;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2'];?>
</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Skapad av :</td>
                                            <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['company_details']->value['name'];?>
</td>
                                            <td rowspan="3" width="10%"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company_logo/<?php echo $_smarty_tpl->tpl_vars['company_details']->value['logo'];?>
" class="responsive" width="150px" style="max-width: 150px;" /></td>
                                        </tr>
                                        <tr>
                                            <td>Ändrad av :</td>
                                            <td colspan="3"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['customer_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['customerid']->value){?><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['last_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['first_name'];?>
<?php }?><?php }?></td>
                                            <td>R</td>
                                            <td>S</td>
                                        </tr>
                                        <tr>
                                            <td>Datum :</td>
                                            <td><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['created_date'];?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %T");?>
<?php }?></td>
                                            <td>Utgåva :</td>
                                            <td><input type="text" class="form-control" name="version" id="version" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['version']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['version'];?>
<?php }else{ ?>1<?php }?>" placeholder="" maxlength="6" /></td>
                                            <td><input type="checkbox" name="check_r" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['check_r']){?>checked="true"<?php }?> /></td>
                                            <td><input type="checkbox" name="check_s" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['check_s']){?>checked="true"<?php }?> /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Vi strävar efter att leverera bästa möjliga personliga assistans med en hög kvalitetsnivå. Nedan följer ett antal frågor med betygsättning 1-6 där 1 är sämst och 6 är bäst.
Kryssa för det betyg som du tycker stämmer med det du har upplevt som kund hos oss på <?php echo $_smarty_tpl->tpl_vars['company_details']->value['name'];?>
.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th class="center">1</th>
                                            <th class="center">2</th>
                                            <th class="center">3</th>
                                            <th class="center">4</th>
                                            <th class="center">5</th>
                                            <th class="center">6</th>
                                        </tr>
                                        <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable(1, null, 0);?>
                                        <?php  $_smarty_tpl->tpl_vars['question'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['question']->_loop = false;
 $_smarty_tpl->tpl_vars['question_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['form_questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['question']->key => $_smarty_tpl->tpl_vars['question']->value){
$_smarty_tpl->tpl_vars['question']->_loop = true;
 $_smarty_tpl->tpl_vars['question_id']->value = $_smarty_tpl->tpl_vars['question']->key;
?>
                                            <tr>
                                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['question']->value['question'];?>
<input type="hidden" name="questions[]" value="<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="1" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp1]==1){?>checked="true"<?php }?> style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="2" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp2]==2){?>checked="true"<?php }?> style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="3" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp3]==3){?>checked="true"<?php }?> style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="4" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp4]==4){?>checked="true"<?php }?> style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="5" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp5]==5){?>checked="true"<?php }?> style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" id="question_<?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
" value="6" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['question_id']->value;?>
<?php $_tmp6=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_tmp6]==6){?>checked="true"<?php }?> style="float: none;" /></td>
                                            </tr>
                                            <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                        <?php }
if (!$_smarty_tpl->tpl_vars['question']->_loop) {
?>
                                            <tr>
                                                <td colspan="8"><div class='message'><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_responds_found'];?>
</div></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Övriga synpunkter:</td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_description" id="field_description" rows="3" style="width: 90%"><?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_description']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_description'];?>
<?php }?></textarea></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Personnummer:</td>
                                            <td><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['employees']->value[$_smarty_tpl->tpl_vars['review_data']->value['created_by']]['century'];?>
<?php echo $_smarty_tpl->tpl_vars['employees']->value[$_smarty_tpl->tpl_vars['review_data']->value['created_by']]['social_security'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['century'];?>
<?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['social_security'];?>
<?php }?></td>
                                            <td>Namn:</td>
                                            <td><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['created_name'];?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['last_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['created_user_data']->value['first_name'];?>
<?php }?><?php }?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Tack för din medverkan!</strong></td> 
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-top: 25px" class="span12 no-ml mb">
                                        <button class="btn btn-primary mr" onclick="saveForm();" type="button"><i class="icon-save"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php }} ?>