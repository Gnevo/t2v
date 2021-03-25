<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:55:40
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_employee_signing_remove.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7943343005fcb672c227a25-22738531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d3930a3e118e6cda8304049c79786b76cadaaee' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_employee_signing_remove.tpl',
      1 => 1531465772,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7943343005fcb672c227a25-22738531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'signing_details' => 0,
    'translate' => 0,
    'sort_by_name' => 0,
    'url_path' => 0,
    'sign_status' => 0,
    'flg' => 0,
    'message' => 0,
    'report_year' => 0,
    'now_year' => 0,
    'report_month' => 0,
    'now_month' => 0,
    'untreated_leaves' => 0,
    'untreated_candg_slots' => 0,
    'is_able_to_sign' => 0,
    'login_user_role' => 0,
    'have_after_slots' => 0,
    'login_user' => 0,
    'allow_ordinary_signing' => 0,
    'isGLorAdmin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb672c2fe5a4_12249292',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb672c2fe5a4_12249292')) {function content_5fcb672c2fe5a4_12249292($_smarty_tpl) {?>


    <div class="span5" id="signed_list">
        <div class="box-wrpr type span12">
            <span id="span_emp_sign" class="span12 clearfix no-ml mb">
                <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['signin_employee']!=''){?>
                    <span class="signed_user <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['employee_sign']!=''){?>bankID<?php }?>"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_wr'];?>
): <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_employee_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_employee_name_lf'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_date'];?>
<?php if ($_smarty_tpl->tpl_vars['signing_details']->value['employee_sign']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['sign_through_bankID'];?>
&nbsp;&nbsp;<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/banck_id_signing.jpg" style="height: 18px;"><?php }?></span>
                    
                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_wr'];?>
)
                <?php }?>
            </span>
            <hr class="span12 no-min-height no-ml"/>
            <span id="span_TL_sign" class="span12 clearfix no-ml mb">
                <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['signin_tl']!=''){?>
                    <span class="signed_user <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['tl_sign']!=''){?>bankID<?php }?>"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl_wr'];?>
): <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?> <?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_tl_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_tl_name_lf'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_tl_date'];?>
<?php if ($_smarty_tpl->tpl_vars['signing_details']->value['tl_sign']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['sign_through_bankID'];?>
&nbsp;&nbsp;<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/banck_id_signing.jpg" style="height: 18px;"><?php }?></span>
                    
                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl_wr'];?>
)
                <?php }?>
            </span>
            <hr class="span12 no-min-height no-ml"/>
            <span id="span_suTL_sign" class="span12 clearfix no-ml mb">
                <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['signin_sutl']!=''){?>
                    <span class="signed_user <?php if ($_smarty_tpl->tpl_vars['signing_details']->value['sutl_sign']!=''){?>bankID<?php }?>"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl_wr'];?>
): <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_sutl_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_sutl_name_lf'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_details']->value['signin_sutl_date'];?>
<?php if ($_smarty_tpl->tpl_vars['signing_details']->value['sutl_sign']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['sign_through_bankID'];?>
&nbsp;&nbsp;<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/banck_id_signing.jpg" style="height: 18px;"><?php }?></span>
                    
                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
 (<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl_wr'];?>
)
                <?php }?>
            </span>
        </div>
    </div>
    <div class="span3" >
        <div class="box-wrpr success-bg span12">
            <ul class="list-bank-id">
                <li><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_id_text1'];?>
</li>
                <li><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_id_text2'];?>
</li>
                <li><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_id_text3'];?>
</li>
                <li><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_id_text4'];?>
</li>
                <li style="background: none !important; padding: 0 !important;"><a class="highlight-link" href="https://www.support.bankid.com/sv/bankid/vad-aer-bankid" target="_blank"><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_id_text_link'];?>
</a></li>
            </ul>
       </div>
    </div>    
    <div id="signing" class="signing signing_for_main span4">
        <?php if ($_smarty_tpl->tpl_vars['sign_status']->value=="false"){?>
             <div class="box-wrpr span12">
                <?php if (($_smarty_tpl->tpl_vars['flg']->value=="1"||$_smarty_tpl->tpl_vars['flg']->value=="2")&&$_smarty_tpl->tpl_vars['message']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
<?php }?>
                <?php if (($_smarty_tpl->tpl_vars['report_year']->value<$_smarty_tpl->tpl_vars['now_year']->value)||($_smarty_tpl->tpl_vars['report_month']->value<=$_smarty_tpl->tpl_vars['now_month']->value&&$_smarty_tpl->tpl_vars['report_year']->value==$_smarty_tpl->tpl_vars['now_year']->value)){?>
                    <?php if ($_smarty_tpl->tpl_vars['untreated_leaves']->value){?>
                        <div class="signing_bug_main"> 
                            <span class="signing signing_for_inner">
                                <span class="signing_bug"><?php echo $_smarty_tpl->tpl_vars['translate']->value['untreated_leave_exists_contact_TL'];?>
</span>
                            </span>
                        </div>
                    <?php }elseif($_smarty_tpl->tpl_vars['untreated_candg_slots']->value){?>
                        <div class="signing_bug_main"> 
                            <span class="signing signing_for_inner">
                                <span class="signing_bug"><?php echo $_smarty_tpl->tpl_vars['translate']->value['untreated_candg_slot_exists'];?>
</span>
                            </span>
                        </div>
                    <?php }elseif(!$_smarty_tpl->tpl_vars['is_able_to_sign']->value&&$_smarty_tpl->tpl_vars['login_user_role']->value!=1){?>
                        <div class="signing_bug_main"> 
                            <span class="signing signing_for_inner">
                                <span class="signing_bug"><?php echo $_smarty_tpl->tpl_vars['translate']->value['report_employee_should_be_sign_before_others_do'];?>
</span>
                            </span>
                        </div>
                    <?php }elseif($_smarty_tpl->tpl_vars['have_after_slots']->value){?>
                        <div class="signing_bug_main"> 
                            <span class="signing signing_for_inner">
                                <span class="signing_bug"><?php echo $_smarty_tpl->tpl_vars['translate']->value['future_slots_exist_in_this_month'];?>
</span>
                            </span>
                        </div>
                    <?php }else{ ?>
                        <span class="signing_form clearfix">
                            <div style="float:left; margin-bottom:5px; padding-top:3px;">
                                <label for="username" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                <input type="text" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
" disabled="disabled" style="background-color:  #D9D9D9;margin-left: 25px;" class="signing_form_text"/>
                            </div>
                            <div style="float:left; margin-bottom:5px;">
                                <label for="password" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                            </div>
                            <div style="float:left; padding:0px 0px 10px 60px; width:100%;" class="clearfix">
                                <?php if ($_smarty_tpl->tpl_vars['allow_ordinary_signing']->value){?><a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signin'];?>
</a><?php }?>
                                <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                            </div>
                            <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                            
                        </span>
                    <?php }?>
                <?php }?>
            </div>
        <?php }elseif($_smarty_tpl->tpl_vars['sign_status']->value=="true"){?>
            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                <div class="box-wrpr span12">
                    <?php if (($_smarty_tpl->tpl_vars['flg']->value=="1"||$_smarty_tpl->tpl_vars['flg']->value=="2")&&$_smarty_tpl->tpl_vars['message']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
<?php }?>
                    <div class="signing_remove_main"> 
                        <span class="signing signing_for_inner">
                            
                            <span class="signing_delete"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_signin'];?>
</span>
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
"></a>
                        </span>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['flg']->value=="3"){?>
                        <div class="span12 text-error mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employer_already_signed_cant_remove'];?>
</div>
                    <?php }?>
                </div>
            <?php }?>
        <?php }elseif($_smarty_tpl->tpl_vars['sign_status']->value=='both'){?> 
            <div class="box-wrpr span12">
                <?php if (($_smarty_tpl->tpl_vars['flg']->value=="1"||$_smarty_tpl->tpl_vars['flg']->value=="2")&&$_smarty_tpl->tpl_vars['message']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['isGLorAdmin']->value==true){?>
                    <div class="signing_remove_main"> 
                        <span class="signing signing_for_inner">
                            
                                <span class="signing_delete"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_signin'];?>
</span>
                                <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
"></a>
                        </span>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['flg']->value=="3"){?>
                        <div class="span12 text-error mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employer_already_signed_cant_remove'];?>
</div>
                    <?php }?>
                <?php }?>

                <?php if (($_smarty_tpl->tpl_vars['report_year']->value<$_smarty_tpl->tpl_vars['now_year']->value)||($_smarty_tpl->tpl_vars['report_month']->value<=$_smarty_tpl->tpl_vars['now_month']->value&&$_smarty_tpl->tpl_vars['report_year']->value==$_smarty_tpl->tpl_vars['now_year']->value)){?>    
                    <span class="signing_form clearfix">
                        <div style="float:left; margin-bottom:5px; padding-top:3px;">
                            <label for="username" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                            <input type="text" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
" disabled="disabled" style="background-color:  #D9D9D9; margin-left: 25px;" class="signing_form_text"/>
                        </div>
                        <div style="float:left; margin-bottom:5px;">
                            <label for="password" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                            <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                        </div>
                        <div style="float:left; padding:0px 0px 10px 60px; width:100%;" class="clearfix">
                            <?php if ($_smarty_tpl->tpl_vars['allow_ordinary_signing']->value){?><a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signin'];?>
</a><?php }?>
                            <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                        </div>    
                        <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                    </span>
                <?php }?>

        <?php }?>
        </div>
    </div>
<?php }} ?>