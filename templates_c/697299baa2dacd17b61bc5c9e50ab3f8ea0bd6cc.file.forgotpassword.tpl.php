<?php /* Smarty version Smarty-3.1.8, created on 2020-12-09 15:56:26
         compiled from "/home/time2view/public_html/cirrus/templates/forgotpassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3853394755fd0f3aa7d0717-16636052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '697299baa2dacd17b61bc5c9e50ab3f8ea0bd6cc' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/forgotpassword.tpl',
      1 => 1427439572,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3853394755fd0f3aa7d0717-16636052',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'message' => 0,
    'translate' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd0f3aa809c94_19113759',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd0f3aa809c94_19113759')) {function content_5fd0f3aa809c94_19113759($_smarty_tpl) {?><!DOCTYPE html>
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
                    <div class="widget widget-heading-simple widget-body-gray">
                        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                        <div class="widget-body">
                            <form id="form" name="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
send_password_reset_link/">
                                <div class="control-group">
                                    <label class="control-label" for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                    <div class="controls"><input name="username" id="username" tabindex="1" autofocus="true" class="input-block-level required medium" type="text" title="Enter Username" style="margin-bottom: 0px;"/> </div>
                                </div>
                                <div class="control-group">
                                    <label  class="control-label" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                    <div class="controls"><input name="email" id="email" type="text" tabindex="2" class="input-block-level margin-none required medium" title="Please enter a valid email address."/></div>
                                </div>
                                <div class="separator bottom"></div> 
                                <div class="row-fluid">
                                    <div class="span6 pl">
                                        <a style="text-decoration: none;" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_to_login'];?>
</a>
                                    </div>
                                    <div class="span6 center pull-right">
                                        <button name="login" id="loginbtn" class="btn btn-block btn-inverse logn_btn" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['get_password'];?>
" type="submit"><?php echo $_smarty_tpl->tpl_vars['translate']->value['get_password'];?>
</button>
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
js/demo/form_validator.js"></script><!-- Uniform Forms Plugin -->
        <script>
            $(document).ready(function() { 
             $("#form").validate({
                    rules: {
                                    username: {
                                            required: true
                                    },
                                    email: {
                                            required: true,
                                            email: true
                                    }
                            },
                            messages: {
                                    username: {
                                            required: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_username'];?>
"
                                    },
                                    email: {
                                            required: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_email'];?>
",
                                            email: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_valid_email'];?>
"
                                    }
                            },
                            submitHandler: function() {
                                $("#form").submit();
                            }
                    });
            });
        </script>
        
    </body>
</html><?php }} ?>