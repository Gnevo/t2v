<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:43:22
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_get_employees_for_customer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17915459195fcb644a652637-47446541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94b642a19c267d2ec0a717c16dceb792af76b6be' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_get_employees_for_customer.tpl',
      1 => 1552642208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17915459195fcb644a652637-47446541',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'samsida_pdf_files' => 0,
    'user_role' => 0,
    'translate' => 0,
    'pdf_file' => 0,
    'singing_employers' => 0,
    'flg' => 0,
    'employees' => 0,
    'entries' => 0,
    'sort_by_name' => 0,
    'general_privileges' => 0,
    'superAccess' => 0,
    'signing_mode' => 0,
    'default_employer_role' => 0,
    'employee_signing_data' => 0,
    'url_path' => 0,
    'signin_sutl' => 0,
    'not_sign_emp' => 0,
    'signed_emps' => 0,
    'form_defaults' => 0,
    'company_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb644a7756d6_83225921',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb644a7756d6_83225921')) {function content_5fcb644a7756d6_83225921($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['samsida_pdf_files']->value)>0&&$_smarty_tpl->tpl_vars['user_role']->value==1){?>
    <div class="allassistans_pdf_files">
        <label class="allassistans_pdf_files_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn_forms'];?>
</label>
        <select name=cmb_pdf_files class="list_detail_assistance cmb_pdf_files">
            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
            <?php  $_smarty_tpl->tpl_vars['pdf_file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pdf_file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['samsida_pdf_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pdf_file']->key => $_smarty_tpl->tpl_vars['pdf_file']->value){
$_smarty_tpl->tpl_vars['pdf_file']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['pdf_file']->value['file_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['pdf_file']->value['generated_date'];?>
</option>
            <?php } ?>
        </select>
    </div>
<?php }?>

<div class="employee_allassistans_div employee_allassistans span12 no-ml">
    <div style="float:left;">
         <input type="hidden" value='<?php echo $_smarty_tpl->tpl_vars['singing_employers']->value;?>
' id="all_employers">
        <label class="employee_allassistans_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn_employee'];?>
</label>
        <select name="cmb_employee" id="cmb_employee" class="list_detail_assistance" <?php if ($_smarty_tpl->tpl_vars['flg']->value=="false"){?>disabled="disabled"<?php }?>> 
            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_assistents'];?>
</option>

            <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['entries']->value['empID'];?>
" data-employer-sign="<?php echo $_smarty_tpl->tpl_vars['entries']->value['employer_sign'];?>
" data-sutl-sign="<?php echo $_smarty_tpl->tpl_vars['entries']->value['sutl_sign'];?>
" ><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['entries']->value['empName_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['entries']->value['empName'];?>
<?php }?></option>
            <?php } ?>
        </select>
    </div>
</div>
        
<?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||($_smarty_tpl->tpl_vars['general_privileges']->value['employer_signing']==1&&$_smarty_tpl->tpl_vars['superAccess']->value==true)){?>
    <div class="employee_allassistans_signing span12 no-ml mb no-min-height">
        <?php if ($_smarty_tpl->tpl_vars['flg']->value=="true"){?>
            <div class="Anställd_postions clearfix">
                <?php if ($_smarty_tpl->tpl_vars['signing_mode']->value=="remove"){?>
                    <a href="javascript:void(0)" class="signin_delet" id="login" name="login"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_all_employer_signings'];?>
</a>
                <?php }elseif($_smarty_tpl->tpl_vars['signing_mode']->value=="both"){?>
                    <label class="employer_role_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn_employer_role'];?>
</label>
                    <input type="text" name="employer_role" class="employer_role" value="<?php echo $_smarty_tpl->tpl_vars['default_employer_role']->value;?>
"/>
                    <a href="javascript:void(0)" class="signin" data_mtd="normal" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['signin'];?>
</a> 
                    <a style="margin-left: 8px; float: left; height: 22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>
                    <a href="javascript:void(0)" class="signin_delet" id="login" name="login"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_all_employer_signings'];?>
</a>
                <?php }elseif($_smarty_tpl->tpl_vars['signing_mode']->value=="signing"){?>
                    <label class="employer_role_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn_employer_role'];?>
</label>
                    <input type="text" name="employer_role" class="employer_role" value="<?php echo $_smarty_tpl->tpl_vars['default_employer_role']->value;?>
"/>
                    <a href="javascript:void(0)" class="signin" data_mtd="normal"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signin'];?>
</a> 
                    <a style="margin-left: 8px; float: left; height: 22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>
                <?php }?>
            </div>
        <?php }?>
    </div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['flg']->value=="true"){?> 
    <div class="sign_personlist span12 no-ml no-min-height">
        <?php if (count($_smarty_tpl->tpl_vars['employee_signing_data']->value)>0){?> <div class="sign_personlist_caption"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employer_signed_employees'];?>
&nbsp;</div><?php }?>
        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_signing_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <div class="sign_box <?php if ($_smarty_tpl->tpl_vars['entries']->value['employer_sign']!=''){?>bankID<?php }?>">
                <?php if ($_smarty_tpl->tpl_vars['entries']->value['employer_sign']!=''){?><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['entries']->value['employee_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['entries']->value['employee_name_lf'];?>
<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||($_smarty_tpl->tpl_vars['general_privileges']->value['employer_signing']==1&&$_smarty_tpl->tpl_vars['superAccess']->value==true)){?><a data-attrib-emp="<?php echo $_smarty_tpl->tpl_vars['entries']->value['employee'];?>
" data_employer = "<?php echo $_smarty_tpl->tpl_vars['entries']->value['employer'];?>
" data_sutl = "<?php echo $_smarty_tpl->tpl_vars['signin_sutl']->value[$_smarty_tpl->tpl_vars['entries']->value['employee']];?>
"></a><?php }?>
            </div>
        <?php } ?>
    </div>
<?php }?>

<div class="not_signed_emp span12 no-ml no-min-height" name="not_signed_emp" id="not_signed_emp">
    <?php if (count($_smarty_tpl->tpl_vars['not_sign_emp']->value)>0){?>
        <b><?php echo $_smarty_tpl->tpl_vars['translate']->value['not_signed_report'];?>
</b>&nbsp;
        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['not_sign_emp']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <span class="label label-default"><?php echo $_smarty_tpl->tpl_vars['entries']->value['emp'];?>
</span>
        <?php } ?>
    <?php }?>
</div>

<div class="signed_emp span12 no-ml no-min-height" name="signed_emp" id="signed_emp">
    <?php if (count($_smarty_tpl->tpl_vars['signed_emps']->value)>0){?>
        <b><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_report'];?>
</b>&nbsp;
        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['signed_emps']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
            <span class="label label-default"><?php if ($_smarty_tpl->tpl_vars['entries']->value['employee_sign']!=''){?><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['entries']->value['emp'];?>
</span>
        <?php } ?>
    <?php }?>
</div>


||||


<?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||($_smarty_tpl->tpl_vars['general_privileges']->value['employer_signing']==1&&$_smarty_tpl->tpl_vars['superAccess']->value==true)){?>
    <div style="padding-bottom:10px; margin-top:4px;"  class="bargaining_group">
        <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">3. Omfattas assistenten av kollektivavtal?</div>
        <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
            <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td height="30">Omfattas assistenten av kollektivavtal?</td></tr>
                <tr>
                    <td width="11%" height="30">
                        <span style="margin-right:10px;" class='pull-left'>
                            <label>
                                <input type="radio" <?php if ((!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['bargaining_new']==1)||empty($_smarty_tpl->tpl_vars['form_defaults']->value)){?>checked="checked"<?php }?> value="1" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Ja
                            </label>
                        </span>
                        <span style="margin-right:10px;" class='pull-left'>
                            <label>
                                <input type="radio" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['bargaining_new']==2){?>checked="checked"<?php }?> value="2" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Nej
                            </label>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="agreements_group clearfix" style="background-color:#f6f9f9; margin:6px 0;">
        <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">5. Anordnaren av personlig assistans </div>
        <div style="border: 1px solid rgb(184, 183, 183); margin: 0px 7px;">
            <div class="box-form" style="margin: 9px 7px;">
                <div class="row-fluid">
                    <div class="span12">
                        <label style="margin-left: 5px;" class="pull-left no-ml">
                            <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="1" <?php if ((!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1)){?>checked="checked"<?php }?>/>&nbsp;
                            Jag har själv anställt assistenten (Fyll inte i något mer under den här punkten)
                        </label>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <label style="margin-left: 5px;" class="pull-left no-ml">
                            <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="2" <?php if ((!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==2)||empty($_smarty_tpl->tpl_vars['form_defaults']->value)){?>checked="checked"<?php }?>/>&nbsp;
                            Personen anlitar en assistans-anordnare
                        </label>
                    </div>
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span8">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height">Namn på anordnaren</label>
                                    <div class="span12 fixed-font" style="margin: 0px;"><strong><?php echo $_smarty_tpl->tpl_vars['company_data']->value['name'];?>
</strong></div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height">Organisationsnummer</label>
                                    <div style="margin: 0px;" class="span12 fixed-font"><strong><?php echo $_smarty_tpl->tpl_vars['company_data']->value['org_no'];?>
</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div style="margin: 0px 0px 10px;" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="company_cp_name">Kontaktperson</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" class="form-control span10" name="company_cp_name" id="company_cp_name" value="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['company_cp_name']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['company_cp_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['company_data']->value['cp_name'];?>
<?php }?>" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>> </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="margin: 0px 0px 10px;" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="company_cp_phone">Telefon, även riktnummer</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" class="form-control span10" name="company_cp_phone" id="company_cp_phone" value="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['company_cp_phone']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['company_cp_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['company_data']->value['contact_number'];?>
<?php }?>" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label style="float: left;" class="span12 no-min-height">Är anordnaren arbetsgivare för assistenten?</label>
                                <label style="margin-left: 5px;" class="no-ml"><input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="1" <?php if ((!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==1)||empty($_smarty_tpl->tpl_vars['form_defaults']->value)){?>checked="checked"<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>>&nbsp;Ja </label>
                            </div>
                        </div>
                        <div style="margin: 12px 0px;" class="row-fluid">
                            <div class="span4">
                                <label class="no-ml" style="margin-left: 5px;">
                                    <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="2" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==2){?>checked="checked"<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>>&nbsp;
                                    Nej, anordnaren är
                                        uppdragsgivare åt
                                        assistenten som har
                                        en annan arbetsgivare</label>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="name_of_another_employer">Namn på arbetsgivaren</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" value="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_company']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_company'];?>
<?php }?>" name="agreement_type2_company" data-company="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_company']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_company'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['company_data']->value['name'];?>
<?php }?>" class="form-control span10 agreement_type2_company" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>/></div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="another_employer_org_no">Organisationsnummer</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" value="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_orgNo']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_orgNo'];?>
<?php }?>" name="agreement_type2_orgno" data-org-no="<?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==2&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_company']!=''){?><?php echo $_smarty_tpl->tpl_vars['form_defaults']->value['agreement_type2_orgNo'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['company_data']->value['org_no'];?>
<?php }?>" class="form-control span10 agreement_type2_orgno" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>/></div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="no-ml" style="margin-left: 5px;">
                                    <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="3" <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['agreement_types_new']==3){?>checked="checked"<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['form_defaults']->value)&&$_smarty_tpl->tpl_vars['form_defaults']->value['provider_of_pa_flag']==1){?>disabled="disabled"<?php }?>>&nbsp;
                                    Nej, anordnaren är uppdragsgivare åt assistenten som är egenföretagare.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?><?php }} ?>