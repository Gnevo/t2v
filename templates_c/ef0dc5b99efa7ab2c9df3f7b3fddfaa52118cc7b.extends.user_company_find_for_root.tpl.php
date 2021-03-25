<?php /* Smarty version Smarty-3.1.8, created on 2020-12-31 22:21:00
         compiled from "/home/time2view/public_html/cirrus/templates/user_company_find_for_root.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5516436895fee4ecc35f900-17679821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef0dc5b99efa7ab2c9df3f7b3fddfaa52118cc7b' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/user_company_find_for_root.tpl',
      1 => 1432898368,
      2 => 'file',
    ),
    '8e143e5444276d3c78214cb03ab6ff91d537b3ce' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/root_dashboard.tpl',
      1 => 1547530922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5516436895fee4ecc35f900-17679821',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'user_display_name' => 0,
    'translate' => 0,
    'picture' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fee4ecc461ed6_38588601',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fee4ecc461ed6_38588601')) {function content_5fee4ecc461ed6_38588601($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full sticky-sidebar"><!-- <![endif]-->
    <!-- <![endif]-->
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
js/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" /><!-- Uniform Pretty Checkboxes -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-select/bootstrap-select.css" /><!-- Bootstrap Extended -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style-flat.css" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css" type="text/css" /><!-- CHILD THEME -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/google-font.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/message.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        
<link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/cirrus.css" rel="stylesheet" type="text/css" />
<style>
    .incon2 td { color: #ff6f54 !important;}
</style>

    </head>
    <body class="">
        <div class="container-fluid fluid menu-left">
            <div id="wrapper">
                <div class="row">
                    <div class="span12 top-fixed-navigation-wrpr">
                        <div class="navbar main hidden-print">
                            <button type="button" class="btn btn-navbar left-collapse-menu">
                                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                            </button>
                            <ul class="topnav pull-left company-select">
                                <li class="active hidden-phone hidden-tablet" style="padding-right:10px;">
                                    <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span>Root
                                </li>
                            </ul>
                            <ul class="topnav pull-right">
                                <li style="border-right: 1px solid #CCC; border-left: 1px solid #CCC; padding-right:10px;" id="clock" class="hidden-phone hidden-tablet"></li>
                                
                                <li class="account dropdown dd-1">
                                    <a data-toggle="dropdown" href="javascript:void(0);" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1"><?php echo $_smarty_tpl->tpl_vars['user_display_name']->value;?>
</span><i></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <span>
                                                <a class="btn btn-default btn-mini pull-right" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
logout/"><?php echo $_smarty_tpl->tpl_vars['translate']->value['logout'];?>
</a>
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="menu" class="hidden-phone">
                    <a href="javascript:void(0)" class="appbrand"></a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['picture']->value;?>
" alt="Avatar" /></a>
                        </span>
                        <ul class="side_links">
                            <li id="side_menu_li_1" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==1){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
dashboard/" class="icon-building"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_company'];?>
</span></a>
                            </li>
                            <li id="side_menu_li_2" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==2){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
users_list_for_root.php" class="icon-group"><i></i> <span class="hidden-label">All Users</span></a>
                            </li>
                            <li id="side_menu_li_3" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==3){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
user_company_find_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Find User</span></a>
                            </li>
                            <li id="side_menu_li_4" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==4){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fake_users_list_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Fake User</span></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 row-width-set"></div>
                </div>
                <div class="row">
                    <div class="span12 main-center" id="main_content" style="width: 100%; margin-top:50px;">
                        <!-- Content -->
                        <div id="content">
                            <div class="innerLR" id="external_wrapper">
                                

<div class="row-fluid">
    <div class="span12 main-left">
        <?php if ($_smarty_tpl->tpl_vars['privilege']->value){?>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1 class='pull-left'>Find User</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget" style="margin: 0px ! important;">
                            <div class="span12 widget-body-section input-group">
                                <div class="widget-body no-padding mb">
                                    <div class="row-fluid">
                                        <div class="span12 widget-body-section input-group">
                                            <form id="form_list" name="form_list" method="post">
                                                <div class="pull-left" style="margin: 0px ! important; padding: 0px;">
                                                    <label class="span12" style="float: left;" for="search_name">Name *</label>
                                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                                        <input name="search_name" id="search_name" value="<?php echo $_smarty_tpl->tpl_vars['search_name']->value;?>
" type="text" class="form-control span12" placeholder="Find Name"/> 
                                                    </div>
                                                </div>
                                                <div class="pull-right" style="padding-top: 15px;">
                                                    <button type="submit" name="submit" class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft"><span class="icon-search"></span> Go</button>
                                                </div>
                                            </form></div>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <div id="table_val" class="table-responsive">
                                            <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['company'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['role'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</th>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  $_smarty_tpl->tpl_vars['company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company']->key => $_smarty_tpl->tpl_vars['company']->value){
$_smarty_tpl->tpl_vars['company']->_loop = true;
?>
                                                        <?php  $_smarty_tpl->tpl_vars['company_users'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company_users']->_loop = false;
 $_from = array($_smarty_tpl->tpl_vars['company']->value['customers'],$_smarty_tpl->tpl_vars['company']->value['employees']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company_users']->key => $_smarty_tpl->tpl_vars['company_users']->value){
$_smarty_tpl->tpl_vars['company_users']->_loop = true;
?>
                                                            <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
                                                                <tr class="gradeX <?php if ($_smarty_tpl->tpl_vars['user']->value['status']==0){?> incon2 <?php }?>">
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['company']->value['name'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
                                                                    <td><?php if ($_smarty_tpl->tpl_vars['user']->value['role']==1){?>Admin
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==2){?>TL
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==3){?>Employee
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==4){?>Customer
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==5){?>Trainee
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==6){?>Economy
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['user']->value['role']==7){?>SuperTL<?php }?></td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['social_security'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['code'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['city'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['phone'];?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['mobile'];?>
</td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['company']->_loop) {
?>
                                                        <tr><td colspan="9">
                                                                <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="fail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>
</div>    
        <?php }?>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
                            
                
            </div>
        </div>

    
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-1.10.1.min.js"></script><!-- JQuery -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script><!-- JQueryUI -->
    <!-- JQueryUI Touch Punch --><!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/modernizr.js"></script><!-- Modernizr -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/demo/common.js"></script><!-- Common Demo Script -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/other/holder/holder.js"></script><!-- Holder Plugin -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-select/bootstrap-select.js"></script><!-- Bootstrap Extended -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery.cookie.js"></script><!-- Cookie Plugin -->
    <!-- Colors -->
    <script>
        var primaryColor = '#4a8bc2',
                dangerColor = '#b55151',
                successColor = '#609450',
                warningColor = '#ab7a4b',
                inverseColor = '#45484d';
            var basePath = '',
               commonPath = 'common/';
            var themerPrimaryColor = primaryColor;
    </script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/clock.js"></script>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.droppable.js"></script>
    
<script type="text/javascript">

$(document).ready(function(){
    
});


 </script>

    </body>
</html><?php }} ?>