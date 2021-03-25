<?php /* Smarty version Smarty-3.1.8, created on 2020-12-08 15:43:10
         compiled from "/home/time2view/public_html/cirrus/templates/dashboard_company.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10689155175fcf9f0e84f718-38555637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a3d3eed26c9d6c7e233a8d75865eacc8edc7ad0' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/dashboard_company.tpl',
      1 => 1547544476,
      2 => 'file',
    ),
    '8e143e5444276d3c78214cb03ab6ff91d537b3ce' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/root_dashboard.tpl',
      1 => 1547530922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10689155175fcf9f0e84f718-38555637',
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
  'unifunc' => 'content_5fcf9f0e9648d1_90125208',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcf9f0e9648d1_90125208')) {function content_5fcf9f0e9648d1_90125208($_smarty_tpl) {?><!DOCTYPE html>
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
                                
<?php if ($_smarty_tpl->tpl_vars['privilege']->value){?>
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1 class='pull-left'><?php echo $_smarty_tpl->tpl_vars['translate']->value['company'];?>
</h1>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company/add/';" class="btn btn-default btn-normal pull-right" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['create_new'];?>
</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="span12">
                            <div class="widget" style="margin: 0px ! important;">
                                <div style="" class="span12 widget-body-section input-group">
                                    <div class="row-fluid">
                                        <div class="row-fluid">
                                            <div id="table_val" class="table-responsive">
                                                <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['logo'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['database'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['language'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</th>
                                                            <th class="table-col-center small-col"></th>
                                                            <th class="table-col-center small-col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $_smarty_tpl->tpl_vars['company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company']->key => $_smarty_tpl->tpl_vars['company']->value){
$_smarty_tpl->tpl_vars['company']->_loop = true;
?>
                                                            <tr class="gradeX">
                                                                <td><img style='height: 60px;' src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company_logo/<?php if ($_smarty_tpl->tpl_vars['company']->value['logo']){?><?php echo $_smarty_tpl->tpl_vars['company']->value['logo'];?>
<?php }else{ ?>defalt.png<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['company']->value['name'];?>
"/></td>
                                                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['name'];?>
</td>
                                                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['db_name'];?>
</td>
                                                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['language'];?>
</td>
                                                                <td><?php echo (($_smarty_tpl->tpl_vars['company']->value['address']).('<br/>')).($_smarty_tpl->tpl_vars['company']->value['city']);?>
</td>
                                                                <td><?php echo (($_smarty_tpl->tpl_vars['company']->value['phone']).('<br/>')).($_smarty_tpl->tpl_vars['company']->value['mobile']);?>
</td>
                                                                <td class="table-col-center small-col"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
dashboard/<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
/" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['deactivate'];?>
"><i class="icon-off"></i></a></td>
                                                                <td class="table-col-center small-col"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company/add/<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
/" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
"><i class="icon-wrench"></i></a></td>
                                                            </tr>
                                                        <?php }
if (!$_smarty_tpl->tpl_vars['company']->_loop) {
?>
                                                            <tr><td colspan="8">
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
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="row-fluid" id="main_container">
        <div class="span12 main-left">
            <div class="fail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>
</div> 
        </div>   
    </div>   
<?php }?>

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
    


    </body>
</html><?php }} ?>