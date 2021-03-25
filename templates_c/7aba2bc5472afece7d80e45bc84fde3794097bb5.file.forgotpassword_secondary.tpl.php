<?php /* Smarty version Smarty-3.1.8, created on 2021-01-08 13:32:42
         compiled from "/home/time2view/public_html/cirrus/templates/forgotpassword_secondary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19058709415ff85efadfe317-91368057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7aba2bc5472afece7d80e45bc84fde3794097bb5' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/forgotpassword_secondary.tpl',
      1 => 1517651998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19058709415ff85efadfe317-91368057',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'message' => 0,
    'translate' => 0,
    'company_details' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5ff85efb0d85f4_37911075',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff85efb0d85f4_37911075')) {function content_5ff85efb0d85f4_37911075($_smarty_tpl) {?><!DOCTYPE html>
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
        <style type="text/css">
            .block-or:before {
                border-top: 16px solid #000000;
                content: "";
                margin: 0px auto;
                position: absolute;
                top: 2px;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: -1;
                padding: 4px;
            }
            .control-group .control-btn{ padding: 1px 0px; height: auto; margin: 0; border: 0; float: none; }
            @media screen and (max-width: 767px){
                .control-group .control-btn{ float: left; }
                .control-group .span7, .control-group .span5, .control-group input#email, .control-group input#mobile{ width: 100% }
            }
        </style>
        
    </head>
    <body class="login ">
        <div id="login">
            <div class="container">
                <h1><i class="icon-lock icon-lare"></i> TIDSREDOVISNING Cirrus</h1>
                <div class="wrapper">
                    <div class="widget widget-heading-simple widget-body-gray">
                        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                        <div class="widget-body">
                            <form id="form" name="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
send_secondary_password_reset_link/">
                                <?php if ($_SESSION['user_role']!=0){?>
                                    <div class="control-group">
                                        <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['selected_company'];?>
</label>
                                        <label class="input-block-level medium"><strong><?php echo $_smarty_tpl->tpl_vars['company_details']->value['name'];?>
</strong></label>
                                        <input name="sel_company" id="sel_company" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_details']->value['id'];?>
"/>
                                    </div>
                                <?php }?>
                                <div class="control-group">
                                    <input type="hidden" name="method" id="method" value="" />
                                    <label class="control-label" for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                    <div class="controls"><input name="username" id="username" tabindex="1" autofocus="true" class="input-block-level required medium" type="text" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_username'];?>
" style="margin-bottom: 0px;"/> </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                    <div class="row-fluid">
                                        <div class="input-append span7">
                                            <input name="email" id="email" type="text" tabindex="2" class="span12" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_username_email'];?>
"/>
                                        </div>
                                        <div class="input-append span5 no-ml">
                                            <div class="span12 control-btn"><button name="login" id="loginbtn" class="btn btn-block btn-inverse logn_btn" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['get_password'];?>
" type="button" onclick="mailRecovery()" style="padding: 5px 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['get_password'];?>
</button></div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($_smarty_tpl->tpl_vars['company_details']->value['recovery_pw_by_mobile']!=0){?>
                                    <div class="center no-mb block-or" style="position: relative; font-size: 15px;"><b><?php echo $_smarty_tpl->tpl_vars['translate']->value['or'];?>
</b></div>
                                    

                                    <div class="control-group">
                                        <label class="control-label" for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                        <div class="row-fluid">
                                            <div class="input-append span7">
                                                <input name="mobile" id="mobile" type="text" tabindex="2" class="span12" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_username_mobile'];?>
"/>
                                            </div>
                                            <div class="input-append span5 no-ml">
                                                <div class="span12 control-btn"><button name="login" id="loginbtn" class="btn btn-block btn-inverse logn_btn" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['get_password'];?>
" type="button" onclick="smsRecovery()" style="padding: 5px 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['send_OTP'];?>
</button></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="separator bottom"></div> 
                                <div class="row-fluid">
                                    <div class="span6 pl">
                                        <a style="text-decoration: none;" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
secondary/login/" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_to_login'];?>
</a>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="login_notification" class="innerT center" style="margin-bottom: 10px;">
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_3'];?>
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
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script><!-- Uniform Forms Plugin -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script><!-- Uniform Forms Plugin -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
        <?php if ($_smarty_tpl->tpl_vars['company_details']->value['recovery_pw_by_mobile']!=0){?>
            <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js"></script>
        <?php }?>
        <script>
            // $(document).ready(function() { 
            //     $("#form").submit(function (event) {
            //         var error = 0;
            //         if($('#username'). val() == ''){
            //             error = 1;
            //             bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_username'];?>
', function(result){  });
            //         }
            //         <?php if ($_smarty_tpl->tpl_vars['company_details']->value['recovery_pw_by_mobile']!=0){?>
            //             else if($('#email').val() == '' && $('#mobile').val() == ''){
            //                 error = 1;
            //                 bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_email'];?>
 / <?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_mobile'];?>
', function(result){  });
            //             }
            //         <?php }else{ ?>
            //             else if($('#email').val() == ''){
            //                 error = 1;
            //                 bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_email'];?>
', function(result){  });
            //             }
            //         <?php }?>
               
            //         if (error == 1) {
            //             event.preventDefault();
            //         }
            //     });
            // });

            function mailRecovery(){
                var error = 0;
                if($('#username'). val() == ''){
                    error = 1;
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_username'];?>
', function(result){  });
                }
                else if($('#email').val() == ''){
                    error = 1;
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_email'];?>
', function(result){  });
                }
                if (error == 0) {
                    $("#method").val('MAIL-RECOVERY');
                    $("#form").submit();
                }
            }

            <?php if ($_smarty_tpl->tpl_vars['company_details']->value['recovery_pw_by_mobile']!=0){?>
                function smsRecovery(){
                    var error = 0;
                    var filtered_mobile = $("#mobile").val();
                    if(filtered_mobile == "+46") filtered_mobile = '';
                    filtered_mobile = removeCharas(filtered_mobile);
                    filtered_mobile = trimMobileNumber(filtered_mobile);
                    if(isNaN(filtered_mobile)) filtered_mobile = '';

                    if($('#username'). val() == ''){
                        error = 1;
                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_username'];?>
', function(result){  });
                    }
                    else if(filtered_mobile == ''){
                        error = 1;
                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fp_fill_mobile'];?>
', function(result){  });
                    }
                    if (error == 0) {
                        $("#method").val('SMS-RECOVERY');
                        $("#form").submit();
                    }
                }

                $(document).ready(function() { 
                    $.mask.definitions['~']='[1-9]';
                    $("#mobile").mask("+46?~99 99 99 99 99", { placeholder:" " });
                });

                function removeCharas(s) {
                    var i=0;
                    var temp_mobile = '';
                    while(i<s.length){
                        if(s.substr(i,1) == " " || s.substr(i,1) == "." || s.substr(i,1) == "," || s.substr(i,1) == "-" || s.substr(i,1) == "_"){
                            i++;
                        }else{
                            temp_mobile = temp_mobile+s.substr(i,1);
                            i++;
                        }
                    }
                    return temp_mobile;
                }

                function trimMobileNumber(s) {
                    while (s.substr(0,3) == '+46' && s.length>1) { s = s.substr(3,9999); }
                    return s;
                }
            <?php }?>
        </script>
        
    </body>
</html><?php }} ?>