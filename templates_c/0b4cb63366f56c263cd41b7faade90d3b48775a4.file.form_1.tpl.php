<?php /* Smarty version Smarty-3.1.8, created on 2020-12-25 08:05:31
         compiled from "/home/time2view/public_html/cirrus/templates/forms/form_1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17674108875fe59d4be95087-60419174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b4cb63366f56c263cd41b7faade90d3b48775a4' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/forms/form_1.tpl',
      1 => 1539176062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17674108875fe59d4be95087-60419174',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'customerid' => 0,
    'lang' => 0,
    'translate' => 0,
    'message' => 0,
    'employee_username' => 0,
    'customers' => 0,
    'customer' => 0,
    'sort_by_name' => 0,
    'form_datas' => 0,
    'form_data' => 0,
    'reviewid' => 0,
    'company_details' => 0,
    'review_data' => 0,
    'created_user_name' => 0,
    'employees' => 0,
    'employee' => 0,
    'login_user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fe59d4c107739_83445342',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fe59d4c107739_83445342')) {function content_5fe59d4c107739_83445342($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
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
form_1.php?customer=' + customer_id, 8);
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
        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fill_required_fields'];?>
');
    }
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_1.php?review=' + reviewid +'&customer=' + customer, 8);
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_1.php?customer=' + customerid, 8);
    }
}
</script>




    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_1.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['form_1'];?>

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
                                        <select class="form-control" id="review" name="review" onchange="selectReview()">
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
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer_forms.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a></li>
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_1.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Arbetsmiljöbedömning hos uppdragsgivare</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Skapad av:</td>
                                            <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['company_details']->value['name'];?>
</td>
                                            <td rowspan="3" width="10%"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company_logo/<?php echo $_smarty_tpl->tpl_vars['company_details']->value['logo'];?>
" class="responsive" width="150px" style="max-width: 150px;" /></td>
                                        </tr>
                                        <tr>
                                            <td>Ändrad av:</td>
                                            <td colspan="3"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['created_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['created_user_name']->value;?>
<?php }?></td>
                                            <td>R</td>
                                            <td>S</td>
                                        </tr>
                                        <tr>
                                            <td>Datum:</td>
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
                                            <td colspan="4">Bedömning sker vid nystart, årligen eller vid förändring av bostad.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens fullständiga namn:</td>
                                            <td colspan="2"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['customer_name'];?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['last_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['first_name'];?>
<?php }?><?php }?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens personnummer:</td>
                                            <td colspan="2"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['customer_century'];?>
<?php echo $_smarty_tpl->tpl_vars['review_data']->value['customer_social_security'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['century'];?>
<?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['social_security'];?>
<?php }?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens fullständiga adress:</td>
                                            <td colspan="2"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['customer_address'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['address'];?>
<?php }?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Bedömning utförd av:</td>
                                            <td colspan="2">
                                                <div class="input-prepend" style="margin: 0px;">
                                                    <span class="add-on icon-pencil"></span>
                                                    <select class="form-control" id="review_employee" name="review_employee">
                                                        <option value="">Välj</option>
                                                        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php if ($_smarty_tpl->tpl_vars['review_data']->value['review_employee']==$_smarty_tpl->tpl_vars['employee']->value['username']){?>selected<?php }?><?php }else{ ?>selected<?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
<?php }else{ ?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
<?php }?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dagens datum:</td>
                                            <td>
                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span10" name="review_date" type="text" id="review_date" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['review_date'];?>
" maxlength="10" /> 
                                                </div>
                                            </td>
                                            <td>Planerat uppföljnings datum:</td>
                                            <td>
                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span10" name="review_next_date" type="text" id="review_next_date" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['review_next_date'];?>
" maxlength="10" /> 
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">1. FYSISK och PSYKISK ARBETSMILJÖ</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Har information givits till personliga assistenter och anhöriga om vikten av en fungerande arbetsmiljö?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_1" id="field_r_1_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_1_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_1" id="field_r_1_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_1_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_1" id="field_1_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_1_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Är uppdragsgivarens hem lokal- och utrymmesmässigt anpassad så att såväl dennes behov liksom
arbetstagarens arbetsmiljö kan tillgodoses på ett lämpligt sätt?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_2" id="field_r_1_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_2_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_2" id="field_r_1_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_2_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_2" id="field_1_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_2_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Är belysningen tillräcklig för alla arbetsuppgifter?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_3" id="field_r_1_3" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_3_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_3" id="field_r_1_3" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_3_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_3_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_3" id="field_1_3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_3_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Ges information till UG och anhöriga om arbetsmiljöaspekter, t.ex. rökning, husdjur, städning m.m.?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_4" id="field_r_1_4" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_4_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_4" id="field_r_1_4" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_4_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_4_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_4" id="field_1_4" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_4_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">5. Ges information till UG och anhöriga om vikten av utrymme och hjälpmedel vid tunga lyft?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_5" id="field_r_1_5" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_5_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_5" id="field_r_1_5" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_5_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_5_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_5" id="field_1_5" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_5_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">6. Är UG och anhöriga delaktiga i besluten om vilka uppgifter som ska respektive inte ska utföras?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_6" id="field_r_1_6" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_6_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_6" id="field_r_1_6" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_6_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_6_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_6" id="field_1_6" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_6_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">7. Är el-utrustning säker?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_7" id="field_r_1_7" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_7_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_1_7" id="field_r_1_7" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_7_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_7_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_7" id="field_1_7" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_7_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">8. Finns allergirisker? t.ex. rökning, husdjur, växter, undermålig ventilation eller dåligt klimat</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_8" id="field_r_1_8" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_8_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_8_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td><input type="radio" name="field_r_1_8" id="field_r_1_8" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_8_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_8" id="field_1_8" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_8_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">9. Är det ofta för varm, kallt eller dragit i bostaden?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_9" id="field_r_1_9" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_9_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_9_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td><input type="radio" name="field_r_1_9" id="field_r_1_9" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_9_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_9" id="field_1_9" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_9_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">10. Finns det något övrigt i den fysiska eller den psykiska arbetsmiljön som kan bli ett problem?
t.ex. olustkänsla, rädsla, trakasserier, ilska, irritation eller buller</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_10" id="field_r_1_10" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_10_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_1_10_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td><input type="radio" name="field_r_1_10" id="field_r_1_10" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_1_10_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_10" id="field_1_10" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_1_10_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">2. ERGONOMI</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns tillräckligt med utrymme vid förflyttning av UG?
t.ex. runt toalett, runt säng, i badrum, i hiss eller annat</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_1" id="field_r_2_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_1_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_2_1" id="field_r_2_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_2_1_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_1" id="field_2_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_2_1_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns behov av utrustning eller förflyttningshjälpmedel för att arbetsuppgifterna ska kunna
utföras på ett säkert sätt och utan risk för skador? t.ex. förflyttning i säng, säng-stol eller stol-toalett</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_2" id="field_r_2_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_2_2_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_2_2" id="field_r_2_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_2_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_2" id="field_2_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_2_2_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det något övrigt vad gäller ergonomi som kan bli ett problem?
t.ex. möbler, utrymmen, golvbeläggning, trösklar eller dörröppningar</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_3" id="field_r_2_3" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_3_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_2_3_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td><input type="radio" name="field_r_2_3" id="field_r_2_3" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_3_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_3" id="field_2_3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_2_3_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Finns behov av individanpassad utbildning, utöver grundutbildningen, av ergonomi och arbetsteknik?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_4" id="field_r_2_4" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_4_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_2_4_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td><input type="radio" name="field_r_2_4" id="field_r_2_4" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_4_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_4" id="field_2_4" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_2_4_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">5. Finns tillgång till råd och stöd för arbetstagaren när kroppen signalerar överbelastning?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_5" id="field_r_2_5" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_5_radio']==1){?>checked="true"<?php }?> />Ja</td>
                                            <td><input type="radio" name="field_r_2_5" id="field_r_2_5" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_2_5_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_2_5_radio']!=''){?>checked="true"<?php }?> />Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_5" id="field_2_5" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_2_5_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">3. KEMIKALIEHANTERING</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Om farliga kemikalier förekommer, finns skyddsutrustning? t.ex. rengörings- och desinfektionsmedel</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_3_1" id="field_r_3_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_3_1_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_3_1" id="field_r_3_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_3_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_3_1_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_3_1" id="field_3_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_3_1_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns det något övrigt som kan bli problem vad gäller kemikaliehantering? t.ex. eksem eller allergi</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_3_2" id="field_r_3_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_3_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_3_2_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_3_2" id="field_r_3_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_3_2_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_3_2" id="field_3_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_3_2_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">4. HYGIEN OCH SMITTSKYDD</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns det plastförkläde och handskar?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_1" id="field_r_4_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_1_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_4_1" id="field_r_4_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_4_1_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_1" id="field_4_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_4_1_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns möjlighet till god handhygien och handsprit?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_2" id="field_r_4_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_2_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_4_2" id="field_r_4_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_4_2_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_2" id="field_4_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_4_2_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det något som kan bli problem vad gäller hygien och smittskydd? t.ex. risk för turbekulos, gulsot, HIV</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_3" id="field_r_4_3" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_3_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_4_3_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_4_3" id="field_r_4_3" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_4_3_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_3" id="field_4_3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_4_3_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">5. SÄKERHET</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns det risk för hot, våld eller hot om våld hos UG?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_1" id="field_r_5_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_5_1_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_5_1" id="field_r_5_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_1_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_1" id="field_5_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_5_1_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Är hanteringen av uppdragsgivarens mediciner säker?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_2" id="field_r_5_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_2_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_5_2" id="field_r_5_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_5_2_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_2" id="field_5_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_5_2_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns trafiksäkerhetsaspekter som bör beaktas vid transporter till och från UG? t.ex. dålig belysning</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_3" id="field_r_5_3" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_3_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_5_3_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_5_3" id="field_r_5_3" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_3_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_3" id="field_5_3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_5_3_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Finns det något i övrigt som kan bli problem vad gäller säkerheten?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_4" id="field_r_5_4" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_4_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_5_4_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_5_4" id="field_r_5_4" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_5_4_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_4" id="field_5_4" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_5_4_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">6. ÖVRIGT</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns språk- eller kultursvårigheter?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_1" id="field_r_6_1" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_1_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_6_1_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_6_1" id="field_r_6_1" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_1_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_1" id="field_6_1" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_6_1_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns det något i övrigt som kan bli problem vad gäller arbetsmiljön?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_2" id="field_r_6_2" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_2_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_6_2_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td><input type="radio" name="field_r_6_2" id="field_r_6_2" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_2_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_2" id="field_6_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_6_2_val'];?>
" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det under jourtjänstgöring möjlighet till avskildhet så medarbetare får erforderlig vila,
samt närhet till kök, toalett och dusch?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_3" id="field_r_6_3" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_3_radio']==1){?>checked="true"<?php }?>/>Ja</td>
                                            <td><input type="radio" name="field_r_6_3" id="field_r_6_3" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['field_6_3_radio']!=1&&$_smarty_tpl->tpl_vars['review_data']->value['field_6_3_radio']!=''){?>checked="true"<?php }?>/>Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_3" id="field_6_3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['field_6_3_val'];?>
" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
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