<?php /* Smarty version Smarty-3.1.8, created on 2021-03-03 11:48:38
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/change_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1657511533603f7796c72198-94069161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '931c43fb86ec497ae78b0be91130a98c51d3bdd8' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/change_password.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
    '7f4735742598b2e710385d88b9b06069f498d30a' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/login.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1657511533603f7796c72198-94069161',
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
  'unifunc' => 'content_603f7796cf0ce6_82725751',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603f7796cf0ce6_82725751')) {function content_603f7796cf0ce6_82725751($_smarty_tpl) {?><!DOCTYPE html>
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
change/password/" autocomplete="off" novalidate="novalidate">
                <div class="control-group">
                    <label for="old_password" class="control-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['current_password'];?>
</label>
                    <div class="controls"><input name="old_password" id="old_password" type="password" tabindex="1" autofocus="true" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="control-group">
                    <label for="new_password" class="control-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['new_password'];?>
</label>
                    <div class="controls"><input name="new_password" id="new_password" type="password" tabindex="2" minlength="8" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="control-group">
                    <label for="re_password" class="control-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['retype_new_password'];?>
</label>
                    <div class="controls"><input name="re_password" id="re_password" type="password" tabindex="3" minlength="8" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="separator bottom"></div> 
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" class="btn btn-inverse pull-right go" type="submit"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
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
        

<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
                
       $("#form").submit(function (event) {
            
           if($("#old_password").val().trim().length  == 0){
               bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fill_old_password'];?>
', function(result){ $("#old_password").focus(); });
               
               event.preventDefault();
           }
           else if($("#new_password").val().trim().length < 8){
               bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_new_minimum_length'];?>
', function(result){ setTimeout(function(){ $("#new_password").focus()},500);});
               event.preventDefault();
           }else if($("#re_password").val().trim().length < 8){
               bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_re_minimum_length'];?>
', function(result){ setTimeout(function(){ $("#re_password").focus()},500);});
               event.preventDefault();
           }else if($("#new_password").val() != $("#re_password").val()){
               bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_must_match'];?>
', function(result){ $("#re_password").focus(); });
               event.preventDefault();
           }
           
       });
    });
</script>

    </body>
</html><?php }} ?>