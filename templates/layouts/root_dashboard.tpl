<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full sticky-sidebar"><!-- <![endif]-->
    <!-- <![endif]-->
    <head>
        <title>{$app_name} {block name='title'}{/block}</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="{$url_path}images/favicon.ico" />
        
        <link rel="stylesheet" href="{$url_path}css/bootstrap.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="{$url_path}css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="{$url_path}fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome.min.css">
        <!--[if IE 7]><link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        <link rel="stylesheet" href="{$url_path}js/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" /><!-- Uniform Pretty Checkboxes -->
        <link rel="stylesheet" href="{$url_path}js/bootstrap-select/bootstrap-select.css" /><!-- Bootstrap Extended -->
        <link rel="stylesheet" href="{$url_path}js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        <link rel="stylesheet" href="{$url_path}css/style-flat.css" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="{$url_path}css/style.css" type="text/css" /><!-- CHILD THEME -->
        <link rel="stylesheet" href="{$url_path}css/google-font.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="{$url_path}css/message.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        {block name='style'}{/block}
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
                                    <a data-toggle="dropdown" href="javascript:void(0);" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1">{$user_display_name}</span><i></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <span>
                                                <a class="btn btn-default btn-mini pull-right" href="{$url_path}logout/">{$translate.logout}</a>
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
                    <a href="javascript:void(0)" class="appbrand">{*{$translate.quick_admin_side_menu}*}</a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="javascript:void(0);"><img src="{$url_path}{$picture}" alt="Avatar" /></a>
                        </span>
                        <ul class="side_links">
                            <li id="side_menu_li_1" {if $menu.submenu == 1}class="active"{/if}>
                                <a href="{$url_path}dashboard/" class="icon-building"><i></i> <span class="hidden-label">{$translate.submenu_company}</span></a>
                            </li>
                            <li id="side_menu_li_2" {if $menu.submenu == 2}class="active"{/if}>
                                <a href="{$url_path}users_list_for_root.php" class="icon-group"><i></i> <span class="hidden-label">All Users</span></a>
                            </li>
                            <li id="side_menu_li_3" {if $menu.submenu == 3}class="active"{/if}>
                                <a href="{$url_path}user_company_find_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Find User</span></a>
                            </li>
                            <li id="side_menu_li_4" {if $menu.submenu == 4}class="active"{/if}>
                                <a href="{$url_path}fake_users_list_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Fake User</span></a>
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
                                {block name="content"}{/block}
                            </div>
                        </div>
                    </div>
                </div>
                            
                {*<div class="clearfix"></div>
                <div id="footer" class="hidden-print">
                    <div class="copy">&copy; 2015 - <a href="http://www.entraze.com">Entraze</a> - All Rights Reserved.</div>
                </div>*}
            </div>
        </div>

    
    <script src="{$url_path}js/jquery-1.10.1.min.js"></script><!-- JQuery -->
    <script src="{$url_path}js/jquery-migrate-1.2.1.min.js"></script>
    <script src="{$url_path}js/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script><!-- JQueryUI -->
    <!-- JQueryUI Touch Punch --><!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
    <script src="{$url_path}js/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="{$url_path}js/plugins/system/modernizr.js"></script><!-- Modernizr -->
    <script src="{$url_path}js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="{$url_path}js/demo/common.js"></script><!-- Common Demo Script -->
    <script src="{$url_path}js/plugins/other/holder/holder.js"></script><!-- Holder Plugin -->
    <script src="{$url_path}js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
    <script src="{$url_path}js/bootstrap-select/bootstrap-select.js"></script><!-- Bootstrap Extended -->
    <script src="{$url_path}js/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
    <script src="{$url_path}js/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
    <script src="{$url_path}js/plugins/system/jquery.cookie.js"></script><!-- Cookie Plugin -->
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
    <script src="{$url_path}js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->
    <script type="text/javascript" src="{$url_path}js/clock.js"></script>

    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.droppable.js"></script>
    {block name='script'}{/block}
    </body>
</html>