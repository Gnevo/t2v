<?php /* Smarty version Smarty-3.1.8, created on 2021-01-16 03:09:49
         compiled from "/home/time2view/public_html/cirrus/templates/sms_pword_reset.tpl" */ ?>
<?php /*%%SmartyHeaderCode:515001174600258fd4a8272-44271816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dde6b678d2053ab13ed7437b1f5c1c336856cbe6' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/sms_pword_reset.tpl',
      1 => 1516272494,
      2 => 'file',
    ),
    '56af5fa2ccbeb80e335e33c45ec5543716218193' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/login.tpl',
      1 => 1456404684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '515001174600258fd4a8272-44271816',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'translate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_600258fd5444d9_33734534',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600258fd5444d9_33734534')) {function content_600258fd5444d9_33734534($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full"><!-- <![endif]-->
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>
 </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/favicon.ico" />

        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/bootstrap.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome.min.css">
        <!--[if IE 7]><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style-flat.css?1372280934" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css" type="text/css" /><!-- CHILD THEME -->
        
    </head>
    <body class="login ">
        <div id="login">
            <div class="container">
                <h1><i class="icon-lock icon-lare"></i> TIDSREDOVISNING Cirrus</h1>
                

<div class="wrapper">
    <div class=""><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
    <div class="widget widget-heading-simple widget-body-gray clearfix">
        <div class="widget-body no-ml">
            <?php if ($_smarty_tpl->tpl_vars['allow_pword_reset']->value=='YES'){?>
                <form id="otpform" name="otpform" method="post" action="">

                    <input name="sel_company" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sel_company_id']->value;?>
"/>
                    <input name="username" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sel_username']->value;?>
"/> 
                    <input name="otp" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sel_otp']->value;?>
"/> 

                    <div class="control-group">
                        <label class="control-label" for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['new_password'];?>
</label>
                        <div class="controls"><input name="password" id="password" type="password" tabindex="1" autocomplete="off" autofocus="true" value = "" class="input-block-level required medium" style="margin-bottom: 0px;"/> </div>
                    </div>
                    <div class="control-group">
                        <label  class="control-label" for="cpassword"><?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_password'];?>
</label>
                        <div class="controls"><input name="cpassword" id="cpassword" type="password" tabindex="2" autocomplete="off" class="input-block-level margin-none required medium"/></div>
                    </div>
                    <div class="separator bottom"></div> 
                    <div class="row-fluid">
                        <div class="span12">
                            <input name="action" id="action" type="hidden" value="RESET-PASSWORD" />
                            <button name="btnUpdate" id="btnUpdate" class="btn btn-inverse logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reset_password'];?>
" type="submit"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset_password'];?>
</button>
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
" type="button" onclick="document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
';"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_to_login'];?>
</button>
                            
                        </div>
                    </div>
                </form>   
            <?php }else{ ?>
                <form id="otpform" name="otpform" method="post" action="">
                    <div class="control-group">
                        <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['selected_company'];?>
</label>
                        <label class="input-block-level medium"><strong><?php echo $_smarty_tpl->tpl_vars['company_details']->value['name'];?>
</strong></label>
                        <input name="sel_company" id="sel_company" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_details']->value['id'];?>
"/>
                    </div>

                    <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['username_login_secondary'];?>
</label>
                    <input name="username" id="username" value="<?php echo $_SESSION['user_id'];?>
" class="input-block-level required medium" type="text" readonly="readonly" /> 
                    
                    <label for="otp"><?php echo $_smarty_tpl->tpl_vars['translate']->value['otp'];?>
</label>
                    <input name="otp" id="otp" type="text" tabindex="2" class="input-block-level margin-none required medium"/>
                    <div class="separator bottom"></div> 
                    <div class="row-fluid">
                        <div class="span12">
                            <input name="action" id="action" type="hidden" value="OTP-VALIDATION" />
                            <button name="btnOtp" id="btnOtp" class="btn btn-inverse logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_validate'];?>
" type="submit"><?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_validate'];?>
</button>
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
" type="button" onclick="document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
';"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_to_login'];?>
</button>
                            
                        </div>
                    </div>
                </form>  
            <?php }?>   
        </div>
    </div>
</div>

                
                <div id="login_notification" class="innerT center" style="margin-bottom: 10px;">
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_1'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_2'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_link'];?>
</p>
                </div>
            </div>
        </div>

        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-1.10.1.min.js"></script><!-- JQuery -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/demo/common.js?1372280934"></script><!-- Common Demo Script -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
        
<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script type="text/javascript">
$(document).ready(function (){
    $("#otp").focus(); 
    
     $("#otpform").submit(function (event) {
            var error = 0;
            if($('#otp'). val() == ''){
                error = 1;
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_valid_otp'];?>
', function(result){  });
            }
       
            if (error == 1) {
                event.preventDefault();
            }
        });
});
<?php if ($_smarty_tpl->tpl_vars['cancel_button']->value){?>
    function cancel_selection(){
        $("#user_company_selection_cancel").submit();
    }
<?php }?>
 //bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){  });

</script>

    </body>
</html><?php }} ?>