<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:24:19
         compiled from "/home/time2view/public_html/cirrus/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1015151455fcb5fd3ec1658-37481935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b627c63cec8f0c717141085400901d5578c9d9c6' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/index.tpl',
      1 => 1527246216,
      2 => 'file',
    ),
    '56af5fa2ccbeb80e335e33c45ec5543716218193' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/login.tpl',
      1 => 1456404684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1015151455fcb5fd3ec1658-37481935',
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
  'unifunc' => 'content_5fcb5fd3f05307_62334844',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb5fd3f05307_62334844')) {function content_5fcb5fd3f05307_62334844($_smarty_tpl) {?><!DOCTYPE html>
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
<?php if (isset($_smarty_tpl->tpl_vars['redirect']->value)&&$_smarty_tpl->tpl_vars['redirect']->value!=''){?>?redirect=<?php echo $_smarty_tpl->tpl_vars['redirect']->value;?>
<?php }?>">
                <label for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username_login'];?>
</label>
                <input name="username" id="username" tabindex="1" autofocus="true" class="input-block-level required medium" type="text"/> 


                <div class="separator bottom"></div> 
                
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" id="loginbtn" class="btn btn-inverse logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['login_continue'];?>
" type="submit" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['login_continue'];?>
</button>


                    </div>
                </div>
            </form>
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
        

<script type="text/javascript">
$(document).ready(function (){
    $("#username").focus();
});
</script>
        <!--SNOW RAINING-->

    </body>
</html><?php }} ?>