<?php /* Smarty version Smarty-3.1.8, created on 2020-12-15 08:25:56
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5495063445fd873147b70d6-21238848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c7288cecd0e9e6f47e61168271a300b1602b2d0' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl',
      1 => 1536921822,
      2 => 'file',
    ),
    '8bf65724968766955962791fa261f56f04bc1602' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/customer_inconvenient_timing_list.tpl',
      1 => 1536921928,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5495063445fd873147b70d6-21238848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'user_role' => 0,
    'translate' => 0,
    'user_companies' => 0,
    'user_company' => 0,
    'company_id' => 0,
    'redirect_form' => 0,
    'privileges_mc' => 0,
    'unread_leaves_count_top' => 0,
    'user_ticket_count' => 0,
    'unread_notes_count_top' => 0,
    'mail_count_top' => 0,
    'surveys_count' => 0,
    'unread_document' => 0,
    'languages' => 0,
    'lang' => 0,
    'language' => 0,
    'user_display_name' => 0,
    'picture' => 0,
    'menu' => 0,
    'privileges_general' => 0,
    'candg' => 0,
    'privileges_forms' => 0,
    'user_id' => 0,
    'chat_users' => 0,
    'chat_service_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd87314baa2e9_03704051',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd87314baa2e9_03704051')) {function content_5fd87314baa2e9_03704051($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_options.php';
?><!DOCTYPE html>
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=2.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/favicon.ico" />
        <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>
" />
        <link rel="manifest" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manifest.json">
        
        
        
        
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/bootstrap.css" type="text/css" async/><!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/responsive.css" type="text/css" async/>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/glyphicons/css/glyphicons.css" async/><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome.min.css" async>
        <!--[if IE 7]><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" /><!-- Uniform Pretty Checkboxes -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-select/bootstrap-select.css" /><!-- Bootstrap Extended -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style-flat.css" type="text/css" async/><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css?v=<?php echo filemtime('css/style.css');?>
" type="text/css" async/><!-- CHILD THEME -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/jquery.mCustomScrollbar.css"><!-- custom scrollbar stylesheet -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/tooltip.css" type="text/css" /><!--TOOLTIP BEGIN-->
       <!-- <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/font-icons.css" type="text/css" />--><!--FONT ICON BEGIN-->
       <!-- <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/icons.css" type="text/css" />--><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/google-font.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/message.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/contextMenu.css?v=<?php echo filemtime('css/contextMenu.css');?>
" type="text/css" media="all" />
        <!--[if IE 8]><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/ie.css"><![endif]-->
        <!--[if IE 11]><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/ie.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/arabic/css/style-arabic.css" type="text/css" media="all" />
        <style type="text/css">
            .people_list_fixed_content {
                position: fixed;
                top: 49px;
                background: #fff;
                max-width: 238px;
                width: 80%;
                height: 94vh;
                border-left: #ccc solid 1px;
                left: 100%;
                z-index: 9;
                transition: right .3s ease-in-out;
            }
            .panel-closed { display: none; }
            #people .list-group-item.active, #people .list-group-item.active:hover, #people .list-group-item.active:focus {
                z-index: 2;
                color: #fff;
                background-color: #855023;
                border-color: #63340d;
            }
            #people .list-group-item:first-child {
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
            }
            #people .list-group-item {
                position: relative;
                display: block;
                padding: 3px 15px;
                margin-bottom: -1px;
                background-color: #fff;
                border: 1px solid #ddd;
            }
            #people .btn-xs, .btn-group-xs > .btn {
                padding: 1px 5px;
                font-size: 12px;
                line-height: 1.5;
                border-radius: 3px;
            }
            #people .btn {
                display: inline-block;
                padding: 6px 0 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
                text-shadow: unset;
                text-overflow: ellipsis;
                width: 84%;
                overflow: hidden;
                white-space: nowrap;
                text-align: left;
            }
            #people a {
                background-color: transparent;
            }
            #chat_thread, #chat_thread i.icon:before{ cursor: pointer; }
            #people i.icon.icon-comments { color: #137e13; }
            .chat-display{
                position: absolute;
                bottom: 0;
                /*z-index: 9000;*/
                width: auto;/*100%;*/
                margin-left: 0px;
                right: 0;   /*new*/
                max-height: 500px;/*new*/
            }
            .chat-pop {
                width: 229px;
                height: 344px;
                float: right;
                margin-right: 9px;
                z-index: 9990 !important;/*new*/
                position: relative;       /*new*/
            }
            .chat-pop.collapsed {
                height: auto !important;
            }
            .chat-pop .box.box-primary {
                border-top-color: #3c8dbc;
                box-shadow: -2px 8px 20px 2px #736f6f;
            }
            .chat-pop .box {
                position: relative;
                border-radius: 3px;
                background: #ffffff;
                border-top: 3px solid #d2d6de;
                margin-bottom: 0px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
                padding: 0px;
                /*height: inherit;*/
            }
            .chat-pop .box-header.with-border {
                border-bottom: 1px solid #f4f4f4;
            }
            .chat-pop .box-header {
                color: #444;
                display: block;
                padding: 10px;
                position: relative;
                text-align: left;
            }
            .chat-pop .box-header>.fa, .chat-pop .box-header>.glyphicon, .chat-pop .box-header>.ion, .chat-pop .box-header .box-title {
                display: inline-block;
                font-size: 15px;
                margin: 0;
                line-height: 1;
            }
            .chat-pop .box-header h3{
                font-weight: 500;
                text-overflow: ellipsis;
                max-width: 160px;
                overflow: hidden;
                white-space: nowrap;
            }
            .chat-pop .box-header>.box-tools {
                position: absolute;
                right: 10px;
                top: 5px;
            }
            .chat-pop .btn-box-tool {
                padding: 5px 2px;
                font-size: 12px;
                background: transparent;
                color: #97a0b3;
            }
            .chat-pop .direct-chat .box-body {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                position: relative;
                overflow-x: hidden;
                padding: 0;
            }
            .chat-pop .box-body {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                padding: 10px;
            }
            .chat-pop .box-header:before, .chat-pop .box-body:before, .chat-pop .box-footer:before, .chat-pop .box-header:after, .chat-pop .box-body:after, .chat-pop .box-footer:after {
                content: " ";
                display: table;
            }
            .chat-pop .direct-chat-messages, .chat-pop .direct-chat-contacts {
                -webkit-transition: -webkit-transform .5s ease-in-out;
                -moz-transition: -moz-transform .5s ease-in-out;
                -o-transition: -o-transform .5s ease-in-out;
                transition: transform .5s ease-in-out;
            }
            .chat-pop .direct-chat-messages {
                -webkit-transform: translate(0, 0);
                -ms-transform: translate(0, 0);
                -o-transform: translate(0, 0);
                transform: translate(0, 0);
                padding: 10px;
                height: 230px;
                overflow: auto;
            }
            .chat-pop .direct-chat-msg {
                margin-bottom: 10px;
            }
            .chat-pop .direct-chat-msg, .chat-pop .direct-chat-text {
                display: block;
            }
            .chat-pop .direct-chat-info {
                display: block;
                margin-bottom: 2px;
                font-size: 12px;
            }
            .chat-pop .direct-chat-name {
                font-weight: 600;
                color: #333;
            }
            .chat-pop .direct-chat-timestamp {
                color: #999;
                font-weight: normal;
            }
            .chat-pop .direct-chat-text {
                border-radius: 5px;
                position: relative;
                padding: 5px 10px;
                background: #d2d6de;
                border: 1px solid #d2d6de;
                /*margin: 5px 0 0 50px;*/
                color: #444;
                font-size: 12px;
                font-weight: normal;
                text-align: left;
                width: 76%;
            }
            .chat-pop .direct-chat-msg, .chat-pop .direct-chat-text {
                display: block;
            }
            .chat-pop .direct-chat-text:before {
                border-width: 6px !important;
                margin-top: -6px;
            }
            .chat-pop .direct-chat-text:after, .chat-pop .direct-chat-text:before {
                position: absolute;
                right: 100%;
                top: 15px;
                border: solid transparent;
                border-right-color: #d2d6de;
                content: ' ';
                height: 0;
                width: 0;
                pointer-events: none;
            }
            .chat-pop .direct-chat-primary .right>.direct-chat-text {
                background: #3c8dbc;
                border-color: #3c8dbc;
                color: #fff;
                float: right;
            }
            .chat-pop .right .direct-chat-text {
                /*margin-right: 50px;*/
                margin-left: 0;
            }
            .chat-pop .direct-chat-primary .right>.direct-chat-text:after, .chat-pop .direct-chat-primary .right>.direct-chat-text:before {
                border-left-color: #3c8dbc;
            }
            .chat-pop .right .direct-chat-text:after, .chat-pop .right .direct-chat-text:before {
                right: auto;
                left: 100%;
                border-right-color: transparent;
                border-left-color: #d2d6de;
            }
            .chat-pop .box-footer {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                border-top: 1px solid #f4f4f4;
                padding: 6px;
                background-color: #fff;
            }
            .chat-pop .input-group {
                position: relative;
                display: table;
                border-collapse: separate;
            }
            .chat-pop .input-group .form-control:first-child, .chat-pop .input-group-addon:first-child, .chat-pop .input-group-btn:first-child>.btn, .chat-pop .input-group-btn:first-child>.btn-group>.btn, .chat-pop .input-group-btn:first-child>.dropdown-toggle, .chat-pop .input-group-btn:last-child>.btn-group:not(:last-child)>.btn, .chat-pop .input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }
            .chat-pop .input-group .form-control, .chat-pop .input-group-addon, .chat-pop .input-group-btn {
                display: table-cell;
            }
            .chat-pop .input-group .form-control {
                position: relative;
                z-index: 2;
                float: left;
                width: 86% !important;
                margin-bottom: 0;
                letter-spacing: 0px;
                height: 16px;
            }
            .chat-pop .form-control:not(select) {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
            .chat-pop .form-control {
                border-radius: 0;
                box-shadow: none;
                border-color: #d2d6de;
                display: block;
                width: 100%;
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                /*border-radius: 4px;*/
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                /*box-shadow: inset 0 1px 1px rgba(0,0,0,.075);*/
                -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            }
            .chat-pop .input-group-btn {
                position: relative;
                font-size: 0;
                white-space: nowrap;
            }
            .chat-pop .input-group-addon, .chat-pop .input-group-btn {
                width: 1%;
                white-space: nowrap;
                vertical-align: middle;
            }
            .chat-pop .input-group-btn:last-child>.btn, .chat-pop .input-group-btn:last-child>.btn-group {
                z-index: 2;
                margin-left: -1px;
            }
            .chat-pop .input-group .form-control:last-child, .chat-pop .input-group-addon:last-child, .chat-pop .input-group-btn:first-child>.btn-group:not(:first-child)>.btn, .chat-pop .input-group-btn:first-child>.btn:not(:first-child), .chat-pop .input-group-btn:last-child>.btn, .chat-pop .input-group-btn:last-child>.btn-group>.btn, .chat-pop .input-group-btn:last-child>.dropdown-toggle {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }
            .chat-pop .btn.btn-flat {
                border-radius: 0;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                border-width: 1px;
            }
            .chat-pop .input-group-btn>.btn {
                position: relative;
            }
            .chat-pop .btn-primary {
                background-color: #3c8dbc;
                border-color: #367fa9;
            }
            .chat-pop .btn {
                border-radius: 3px;
                -webkit-box-shadow: none;
                box-shadow: none;
                border: 1px solid transparent;
                margin: 0;
            }
            .chat-pop .btn-primary {
                color: #fff;
                background-color: #337ab7;
                border-color: #2e6da4;
            }
            .chat-pop .icon:before {
                cursor: pointer;
            }
            .chat-pop .typing_indicator {
                /*bottom: 0;*/
                position: absolute;
                font-size: 12px;
                color: #5e2f07;
                min-height: 0px;
                font-weight: normal;
            }
            .hide_chat_people_entry { display: none !important; }
            .peoples_list .list-group-item-header .icon-change.icon:before{ content: "\f078"; }
            .peoples_list .list-group-item-header.icon-toggle-up .icon-change.icon:before{ content: "\f077" !important; }
         </style>
        
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/jquery-ui-new.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/inconvenient-timings.css" media="all" />  
    <style type="text/css">
        .scroll-pane, .scroll-pane-arrows{
            width: 100%;
            height: 200px;
            overflow: auto;
        }
        .horizontal-only{
            height: auto;
            max-height: 200px;
        }
        .holidayinc_wrapper {
            border: 1px solid #DCDCDC;
        }
        .holidayinc_main {
            /*border: 1px solid #DCDCDC;*/
            margin: 5px;
        }
        .holidayinc_coloum {
            float: left;
            height: 16px;
            padding: 10px 10px;
            text-align: center;
            border-right: 1px solid #DCDCDC;
        }
        .holidayinc_row, .holidayinc_rowinner {
            border-bottom: 1px solid #DCDCDC;
        }
        .holidayinc_row .col_header {
            height:20px; 
            padding-top:18px;
            font-weight: bold;
        }

        .inconveniant_title_head{
            background-color:#A4DEEA;
            padding:5px;
        }
        .divTable {
            display: table;
            width: 100%;
            background-color: #E3EDF0;
            border: 1px solid #DCDCDC;
            border-right:none;
            border-bottom:none;
            border-spacing: 0px;/*cellspacing:poor IE support for  this*//* border-collapse:separate;*/
        }
        .headRow {
            display: table-row;
            text-align: center;
            background: #DAF2F7;
            font-weight: bold;
        }
        .headRow .divCell { /*padding: 20px 10px;*/ }
        .row_group { display: table-row-group; background: #F7FBFB; }
        .divRow { display: table-row; width: auto; text-align: center; }
        .divCell { /*float: left;fix for  buggy browsers*/ display: table-cell; min-width: 10px; border-right: 1px solid #DCDCDC; border-bottom: 1px solid #DCDCDC; padding: 8px; vertical-align: middle; }
        .option_cell { /*float: left;fix for  buggy browsers*/ padding: 5px 0 2px; }
        .tb_opt ul li { display: inline; list-style: none; margin-left: 2px;}
        .subhead_titles_tab { display: block;float: left;font: bold 12px Arial,Helvetica,sans-serif;padding-top: 4px;margin-left: 5px;}
        .scrol_down_image_pointer { background: url("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
/images/downarrow_icon.png") no-repeat scroll 39px 29px;}
        .scrol_down_image_pointer_inconv { background: url("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
/images/downarrow_icon.png") no-repeat;background-position: bottom right;}
        .inconv_table .days_inner_tbl td{ border: 1px solid #D6D6D6;padding: 3px 8px;}
        table tbody tr td > .day-report{ height: auto !important;}
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
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?><span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['menu_admin'];?>

                                    <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==2){?> <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['menu_al'];?>

                                    <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==3){?> <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['menu_employee'];?>

                                    <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==4){?> <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['menu_customer'];?>
<?php }?>
                                </li>
                                <li class="dropdown dd-1" style="padding-right:10px; ">
                                    <span class="icon-home hidden-phone" style="font-size:18px;"></span>
                                    
                                    <form name="user_company_selection" id="user_company_selection" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
change_company.php" style="display: inline-block;">
                                        <select style="display: none;" class="selectpicker"  name="user_company" id="user_company"  onchange="this.form.submit();">
                                            <?php  $_smarty_tpl->tpl_vars['user_company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user_company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['user_companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user_company']->key => $_smarty_tpl->tpl_vars['user_company']->value){
$_smarty_tpl->tpl_vars['user_company']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['user_company']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['company_id']->value==$_smarty_tpl->tpl_vars['user_company']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['user_company']->value['name'];?>
</option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="redirect_form" value="<?php echo $_smarty_tpl->tpl_vars['redirect_form']->value;?>
"/>    
                                    </form>
                                </li>
                            </ul>
                            <ul class="topnav pull-right">
                                <?php if ((($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_notification']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1)&&$_smarty_tpl->tpl_vars['unread_leaves_count_top']->value!=0)||($_smarty_tpl->tpl_vars['privileges_mc']->value['support']==1&&$_smarty_tpl->tpl_vars['user_ticket_count']->value!=0)||(($_smarty_tpl->tpl_vars['privileges_mc']->value['notes']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_rejection']==1)&&$_smarty_tpl->tpl_vars['unread_notes_count_top']->value!=0)||($_smarty_tpl->tpl_vars['privileges_mc']->value['cirrus_mail']==1&&$_smarty_tpl->tpl_vars['mail_count_top']->value!=0)||($_smarty_tpl->tpl_vars['surveys_count']->value!=0)||($_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1&&$_smarty_tpl->tpl_vars['unread_document']->value!=0)){?>
                                    <li title="" data-original-title="" class="glyphs" data-toggle="tooltip" data-placement="bottom" style="margin-right: -1px;">
                                        <ul>
                                            <?php if (($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_notification']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1)&&$_smarty_tpl->tpl_vars['unread_leaves_count_top']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_leave'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/leave/" class="glyphicons user" ><i style="color: red !important;"></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['unread_leaves_count_top']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['support']==1&&$_smarty_tpl->tpl_vars['user_ticket_count']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_support'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
supporttickets/list/" class="glyphicons life_preserver"><i></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['user_ticket_count']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                            <?php if (($_smarty_tpl->tpl_vars['privileges_mc']->value['notes']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_rejection']==1)&&$_smarty_tpl->tpl_vars['unread_notes_count_top']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_notes'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/list/" class="glyphicons notes"><i></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['unread_notes_count_top']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['cirrus_mail']==1&&$_smarty_tpl->tpl_vars['mail_count_top']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_mail'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mail/list/" class="glyphicons message_full"><i></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['mail_count_top']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['surveys_count']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_survey'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
user/survey/" class="glyphicons charts"><i></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['surveys_count']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1&&$_smarty_tpl->tpl_vars['unread_document']->value!=0){?>
                                                <li data-title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['dashboard_notofication_doc_archive'];?>
" data-placement="bottom" data-toggle="tooltip"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
documents/archive/" class="glyphicons file"><i></i>
                                                        <span class="notification-info" ><?php echo $_smarty_tpl->tpl_vars['unread_document']->value;?>
</span>
                                                    </a></li>
                                            <?php }?>
                                        </ul>
                                    </li>
                                <?php }?>
                                <li style="border-right: 1px solid #CCC; border-left: 1px solid #CCC; padding-right:10px;" id="clock" class="hidden-phone hidden-tablet"></li>
                                <!--DATE AND TIME END	-->		
                                
                                
                                <!-- Language menu -->
                                <li class="dropdown dd-1 dd-flags" id="lang_nav">
                                    <form name="user_language_selection" id="user_language_selection" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
change_language.php" style="display: inline-block;">
                                        <a href="javascript:void(0);" data-toggle="dropdown">
                                            <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['lang']->value==$_smarty_tpl->tpl_vars['language']->value['short']){?>
                                                    <img src="<?php if ($_smarty_tpl->tpl_vars['language']->value['short']=='se'){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/lang/sw.png<?php }elseif($_smarty_tpl->tpl_vars['language']->value['short']=='en'){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/lang/us.png<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
">
                                                <?php }?>
                                            <?php } ?>
                                        </a>
                                        
                                        
                                        <ul class="dropdown-menu pull-left" id="lang_drop_down_menu">
                                            <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
                                                <li class="lang_options <?php if ($_smarty_tpl->tpl_vars['lang']->value==$_smarty_tpl->tpl_vars['language']->value['short']){?>active<?php }?>" data-val="<?php echo $_smarty_tpl->tpl_vars['language']->value['short'];?>
">
                                                    <a href="#" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
">
                                                        <img src="<?php if ($_smarty_tpl->tpl_vars['language']->value['short']=='se'){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/lang/sw.png<?php }elseif($_smarty_tpl->tpl_vars['language']->value['short']=='en'){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/lang/us.png<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
"> <?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>

                                                    </a>
                                                </li>
                                            <?php } ?>
                                            
                                        </ul>
                                        <input type="hidden" name="redirect_form" value="<?php echo $_smarty_tpl->tpl_vars['redirect_form']->value;?>
"/>
                                        <input type="hidden" id="user_language" name="user_language" value=""/>
                                    </form>
                                </li>
                                
                                <!-- // Language menu END -->
                                
                                
                                
                                
                                <!-- Profile / Logout menu -->
                                <li class="account dropdown dd-1">
                                    <a data-toggle="dropdown" href="javascript:void(0);" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1"><?php echo $_smarty_tpl->tpl_vars['user_display_name']->value;?>
</span><i></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <!--<li><a href="javascript:void(0);" class="glyphicons cogwheel">Settings<i></i></a></li>
                                        <li><a href="javascript:void(0);" class="glyphicons camera">My Photos<i></i></a></li>!-->
                                        <li class="profile">
                                            <span>
                                                <span class="heading">Profile 
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/" class="pull-right">Edit</a>
                                                </span>
                                                <span>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
profile_photo.php">
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['picture']->value;?>
?v=<?php echo filemtime($_smarty_tpl->tpl_vars['picture']->value);?>
" alt="Avatar" width="50" height="50" />
                                                    </a>
                                                </span>
                                                <span class="details">
                                                    <a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['user_display_name']->value;?>
</a>
                                                    
                                                </span>
                                                <span class="clearfix"></span>
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <a class="btn btn-default btn-mini pull-right" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
logout/"><?php echo $_smarty_tpl->tpl_vars['translate']->value['logout'];?>
</a>
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                                <!-- // Profile / Logout menu END -->
                                
                                <li id="chat_thread">
                                    <a href="javascript:void(0);" data-toggle="control-sidebar"><i class="icon icon-comments"></i></a>
                                </li>
                                <li>
                            <a href="#" class="faq"><?php echo $_smarty_tpl->tpl_vars['translate']->value['faq'];?>
</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="menu" class="hidden-phone no-print">
                    <a href="javascript:void(0)" class="appbrand"></a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
profile_photo.php">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['picture']->value;?>
?v=<?php echo filemtime($_smarty_tpl->tpl_vars['picture']->value);?>
" alt="Avatar" class="img-user-thumb-image" />
                            </a>
                        </span>
                        <ul class="side_links">
                            <li id="side_menu_li_1" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==1){?>class="active"<?php }?>>
                                <a href="<?php if (isset($_COOKIE['startup_summery_view'])&&$_COOKIE['startup_summery_view']=='employee'){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all/employee/gdschema/l/<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all/gdschema/l/<?php }?>" class="icon-calendar"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_basic_schedule'];?>
</span></a>
                            </li>
                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=4){?>
                                <li id="side_menu_li_2" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==2){?>class="active"<?php }?>>
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['edit_employee']==1){?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/employee/act/" class="icon-group"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_employee'];?>
</span></a>
                                    <?php }else{ ?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/" class="icon-group"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_mydata'];?>
</span></a>
                                    <?php }?>
                                </li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['add_customer']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['edit_customer']==1){?>
                                <li id="side_menu_li_3" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==3){?>class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/customer/act/" class="icon-user"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_customer'];?>
</span></a>
                                </li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['candg']->value==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_notification']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['notes_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['cirrus_mail']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['external_mail']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['sms']==1||$_smarty_tpl->tpl_vars['surveys_count']->value>0||($_smarty_tpl->tpl_vars['user_role']->value==4)){?>
                                <li id="side_menu_li_5" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==5){?>class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/" class="icon-envelope"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_msg_center'];?>
</span></a>
                                </li>
                            <?php }?>
                            <li id="side_menu_li_6" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==6){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
reports/" class=" icon-pencil"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_reports'];?>
</span></a>
                            </li>

                            

                            <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['inconvenient_timing']==1){?>
                                <li id="side_menu_li_7" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==7){?>class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timings/list/" class=" icon-bar-chart"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_inconvenient_time'];?>
</span></a>
                                </li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['fkkn']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['employer_signing']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['leave']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['certificate']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_1']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_2']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_3']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_1_report']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_2_report']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_3_report']==1||$_smarty_tpl->tpl_vars['user_role']->value==4){?>
                                <li id="side_menu_li_8" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==8){?>class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
forms/" class="icon-file"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_forms'];?>
</span></a>
                                </li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['administration']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['administration_fk_export']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['recruitment']==1){?> 
                                <li id="side_menu_li_9" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==9){?>class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
administration/" class="icon-key"><i></i> <span class="hidden-label"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['administration'];?>
</span></a>
                                </li>
                            <?php }?>
                        </ul>


                        <div class="clearfix"></div>
                    </div>
                    <!-- // Scrollable Menu wrapper with Maximum Height END -->
                </div>
                <!-- // Sidebar Menu END -->
                <div class="row">
                    <div class="span12 row-width-set">
                    </div>
                </div>
                <div class="row">
                    <div class="span12 main-center" id="main_content" style="width: 100%; margin-top:50px;">
                        <!-- Content -->
                        <div id="content">
                            <div class="innerLR" id="external_wrapper">
                                
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height no-ml"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div style="margin: 15px 0px 0px;" class="widget-header span12">
            <div class="day-slot-wrpr-header-left pull-left">
                <h1 style="margin: 5px ! important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h1>
            </div>
        </div>

        <div class="span12 widget-body-section input-group">
            <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                <?php if (!empty($_smarty_tpl->tpl_vars['customer_detail']->value)){?>
                <div class="widget-body" style="padding:4px;">
                    <div class="row-fluid">
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
 : </strong><?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['social_security'];?>
</div>
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_code'];?>
 : </strong><?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['code'];?>
</div>
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 : </strong> <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']);?>
<?php }?></div>
                    </div>
                </div>
                <?php }?>
            </div>
            
            
            
        <div class="row-fluid">
                    <div class="span12">
                        <div class="tab-content-switch-con" >
                            
    <div style="display: none;" class="scroller scroller-left"><span class="icon-chevron-left"></span></div>
    <div style="display: block;" class="scroller scroller-right"><span class="icon-chevron-right"></span></div>
    <div class="wrapper no-margin">
        <ul class="nav nav-tabs list" role="tablist" id="myTab" style="left: 0px;">
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['edit_customer']==1){?><li role="presentation" <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='REGISTER'){?>class="active"<?php }?>><a href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/add/%%C-UNAME%%/')" aria-controls="1" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['register'];?>
</a></li><?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_insurance_fk']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='INSURANCE-FK'){?>class="active"<?php }?> role="presentation"><a aria-controls="2" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/insurance/fk/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_insurance_kn']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='INSURANCE-KN'){?>class="active"<?php }?> role="presentation"><a aria-controls="3e" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/insurance/kn/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['municipality'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_insurance_tu']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='INSURANCE-TE'){?>class="active"<?php }?> role="presentation"><a aria-controls="4" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/insurance/te/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance_te'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_implan']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='IMPLAN'){?>class="active"<?php }?> role="presentation"><a aria-controls="5" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/implan/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['implementation_plan'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_deswork']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='DESWORK'){?>class="active"<?php }?> role="presentation"><a aria-controls="6" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/deswork/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description_of_work'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_documentation']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='DOCUMENT'){?>class="active"<?php }?> role="presentation"><a aria-controls="7" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_equipment']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='EQUIPMENT'){?>class="active"<?php }?> role="presentation"><a aria-controls="8" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/equipment/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['equipment'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_privileges']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='PRIVILEGE'){?>class="active"<?php }?> role="presentation"><a aria-controls="9" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/privilege/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['privilege'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_appointment']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='APPOINMENT'){?>class="active"<?php }?> role="presentation"><a aria-controls="10" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/appoiments/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['appoiments'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_oncall']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='INCONVINIENCE'){?>class="active"<?php }?> role="presentation"><a aria-controls="11" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/inconvenient/timings/list/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_oncall_settings'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_3066']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='F-3066'){?>class="active"<?php }?> role="presentation"><a aria-controls="12" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/to/employee/3066/%%C-UNAME%%/')">3066</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_sick_form_defaults']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='SICK-DEFAULT'){?>class="active"<?php }?> role="presentation"><a aria-controls="13" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/defaults/sick/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sick_form_defaults'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['customer_settings_location']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='LOCATION'){?>class="active"<?php }?> role="presentation"><a aria-controls="14" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/locations/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location'];?>
</a></li><?php }?>
            
        </ul>
    </div>

                            <div class="widget-header widget-header-options tab-option">
                                <div class="span4 day-slot-wrpr-header-left span3">
                                         <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient_timings'];?>
</h1>
                                </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                         <button class="btn btn-default btn-normal pull-right ml" onclick="backForm()" type="button"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                                   <button class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming" type="button"><span class="icon-plus" ></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
</button>
                               </div>
                            </div>
                        </div>
                    
                                   
                                       <div class="tab-content-con boxscroll">
                                           <div class="tab-content span12" style="margin:0;">
                                               <div role="tabpanel" class="tab-pane active" id="11">
                                                   
                                                   <div style="margin: 20px 0px 0px;" class="widget">
                                                       <div class="span12 widget-body-section input-group">
                                                           <div class="table-responsive">
                                                               <table id="inconv_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                                                   <thead>
                                                                       <tr>
                                                                           <th class="table-col-center" style="width:20px">#</th>
                                                                           <th style="width: 100px;"><?php echo utf8_encode($_smarty_tpl->tpl_vars['translate']->value['name']);?>
</th>

                                                                           <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effect_from'];?>
</th>
                                                                           <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>
</th>
                                                                           <th style="width:124px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary'];?>
</th>
                                                                           <th style="width:124px;">&nbsp;</th>
                                                                       </tr>
                                                                   </thead>
                                                                   <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                                                   <?php if (!empty($_smarty_tpl->tpl_vars['timing_list']->value)){?>
                                                                       <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['timing_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                                                           <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                                                           <tbody class="holiday_main">
                                                                               <tr class="gradeX<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child<?php }?>">
                                                                                   <td style="width: 20px;" class="center<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> table-row-collapse-switch-timings  have_child row-expander cursor_hand<?php }?>" <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td>
                                                                                   <td class="table-col-center center<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child cursor_hand<?php }?>" <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>

                                                                                   <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['list']->value['effect_from'];?>
<?php if ($_smarty_tpl->tpl_vars['list']->value['effect_to']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value['effect_to'];?>
<?php }?></td>

                                                                                   <td class="center">
                                                                                       	
                                                                                       <?php  $_smarty_tpl->tpl_vars['day_time'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_time']->_loop = false;
 $_smarty_tpl->tpl_vars['day_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value['day_time_merged']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_time']->key => $_smarty_tpl->tpl_vars['day_time']->value){
$_smarty_tpl->tpl_vars['day_time']->_loop = true;
 $_smarty_tpl->tpl_vars['day_key']->value = $_smarty_tpl->tpl_vars['day_time']->key;
?>
                                                                                           <div class="day-report"><h1><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['day_key']->value-1;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[$_tmp1]['label']];?>
</h1>
                                                                                                   <?php echo implode('<br/>',$_smarty_tpl->tpl_vars['day_time']->value);?>

                                                                                           </div>
                                                                                       <?php } ?>
                                                                                   </td>
                                                                                   <td class="table-col-center center salary_col">
                                                                                       <ol class="span12">
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['amount'];?>
</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_call_training'];?>
</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_complementary_oncall'];?>
</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_more_oncall'];?>
</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                                       </ol>
                                                                                   </td>
                                                                                   <td class="center" style="width: 130px;">
                                                                                       <button type="button" class="btn btn-default btn_edit" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" user_id="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" user_name="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
"><span class="icon-wrench"></span></button>
                                                                                       <?php if ($_smarty_tpl->tpl_vars['list']->value['effect_to']==''){?><button type="button" class="btn btn-default btn_clone" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" user_id="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" user_name="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
"><span class="icon-share"></span></button><?php }?>
                                                                                       <button type="button"  class="btn btn-default btn_delete" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete_inconvenient(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
');"><span class="icon-trash"></span></button>
                                                                                   </td>
                                                                               </tr>
                                                                           </tbody>
                                                                           <tbody class="child_holi">
                                                                               <?php  $_smarty_tpl->tpl_vars['version'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['version']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['privious_versions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['version']->key => $_smarty_tpl->tpl_vars['version']->value){
$_smarty_tpl->tpl_vars['version']->_loop = true;
?>
                                                                                   <tr class="gradeX table-row-collapse-Timings-wrpr item_row hide">
                                                                                       <td class="center" style="width: 20px;">* </td>
                                                                                       <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['version']->value['name'];?>
</td>

                                                                                       <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['version']->value['effect_from'];?>
<?php if ($_smarty_tpl->tpl_vars['version']->value['effect_to']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['version']->value['effect_to'];?>
<?php }?></td>
                                                                                       <td class="center">
                                                                                           <?php  $_smarty_tpl->tpl_vars['day_time'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_time']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['version']->value['day_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_time']->key => $_smarty_tpl->tpl_vars['day_time']->value){
$_smarty_tpl->tpl_vars['day_time']->_loop = true;
?>
                                                                                               <div class="day-report"><h1><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['day_time']->value['day']-1;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[$_tmp2]['label']];?>
</h1><?php echo $_smarty_tpl->tpl_vars['day_time']->value['time'];?>
</div>
                                                                                                   <?php } ?>
                                                                                       </td>
                                                                                       <td class="table-col-center center salary_col">

                                                                                           <ol class="span12">
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['amount'];?>
</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_call_training'];?>
</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_complementary_oncall'];?>
</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_more_oncall'];?>
</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                                           </ol>

                                                                                       </td>
                                                                                       <td class="center">

                                                                                           <button type="button" class="btn btn-default btn_edit" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" user_id="<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
" user_name="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
"><span class="icon-wrench"></span></button>
                                                                                           <?php if ($_smarty_tpl->tpl_vars['version']->value['effect_to']==''){?><button type="button" class="btn btn-default btn_clone" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" user_id="<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
" user_name="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
" ><span class="icon-share"></span></button><?php }?>
                                                                                           <button type="button" class="btn btn-default btn_delete" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete_inconvenient(<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
');"><span class="icon-trash"></span></button>
                                                                                       </td>
                                                                                   </tr>
                                                                               <?php } ?>
                                                                           </tbody>
                                                                       <?php } ?>
                                                                   <?php }?>
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
    <div style="display: block;  margin-top: 5px;margin-left: 5px;" class="span4 main-right" id="stickyPanelParent">
        <form name="timing" id="timing" method="post">
            <div class="span12 oncall-box" style="margin-left: 0px; display: block;">
                <div style="margin: 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_timing_norm'];?>
</h1>
                        <input type="hidden" name="type_sal" id="type_sal" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['type'];?>
" />
                        <input type="hidden" name="action" id="hidden_action" value="" />
                        <input type="hidden" name="cust_id" id="hidden_cust_id" value="" />
                        <input type="hidden" name="cust_code" id="hidden_cust_code" value="" />
                    </div>
                    <div class="span12 widget-body-section input-group">

                        <div class="row-fluid mb" id="btnGroupStickyPanel">
                            <div class="span12" style="margin: 0px ! important;"> 
                                <button class="btn btn-success span6" style="text-align: center;" type="button" onclick="validate();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                <button class="btn btn-danger span6 cancel-new-equipment no-ml" style="text-align: center;" type="button"><span class="icon-chevron-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                            </div>
                        </div>
                        <div class="row-fluid" id="edit_form_section">
                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                <div class="span12" style="margin: 0px;">
                                    <label class="span12" style="float: left;" for="name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 </label>
                                    <div style="float: left; margin: 0px;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>

                                        <select name="name" id="name" class="form-control span11" onchange="markChange()">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['nam'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nam']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['timing_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nam']->key => $_smarty_tpl->tpl_vars['nam']->value){
$_smarty_tpl->tpl_vars['nam']->_loop = true;
?>
                                                <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['nam']->value['name'],'output'=>$_smarty_tpl->tpl_vars['nam']->value['name'],'selected'=>$_smarty_tpl->tpl_vars['timing']->value['name']),$_smarty_tpl);?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                
                                <div style="margin: 0px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="date_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effect_from'];?>
</label>
                                    <div class="span12" style="margin: 0px;">
                                        <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11"  name="date_from" id="date_from" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['effect_from'];?>
" type="text" readonly="readonly"/>
                                        </div>
                                    </div>
                                </div> 


                             <div style="margin: 0px ! important;" class="span12 no-ml date_to">
                                <label style="float: left;" class="span12" for="date_to"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effect_to'];?>
</label>
                                <div class="span12" style="margin: 0px;">
                                    <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                        <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11"  name="date_to" id="date_to" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['effect_to'];?>
" type="text" readonly="readonly"/>
                                    </div>
                                </div>
                             </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['type'];?>
</label>
                                    <div id="ltype">
                                        <input type="radio" id="ltype1" name="ltype"  value="0" onchange="markChange()"/><label for="ltype1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['discrete'];?>
</label>
                                        <input type="radio" id="ltype2" name="ltype"  value="1" onchange="markChange()" /><label for="ltype2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['continus'];?>
</label>
                                    </div>
                                </div>
                                <div style="margin: 0px;" class="span12">
                                    <label style="float: left;" class="span12" for="time_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_range'];?>
</label>
                                    <div class="span12" style="margin:0;">
                                        <div class="input-prepend date">
                                            <span class="add-on icon-time"></span>
                                            <input type="text" name="time_from" id="time_from" class="form-control span5" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['time_from'];?>
" onchange="markChange()"/>
                                            <span class="add-on icon-time"></span>
                                            <input type="text" name="time_to" id="time_to" class="form-control span5" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['time_to'];?>
" onchange="markChange()"/>

                                        </div>
                                    </div>
                                </div>

                                <div style="margin: 0px;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>
</label>
                                    <div id="format">
                                        <input type="checkbox" id="check1" class="check" name="mon" value="1" <?php if ($_smarty_tpl->tpl_vars['days']->value['mon']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mon'];?>
</label>
                                        <input type="checkbox" id="check2" class="check" name="tue" value="2" <?php if ($_smarty_tpl->tpl_vars['days']->value['tue']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tue'];?>
</label>
                                        <input type="checkbox" id="check3" class="check" name="wed" value="3" <?php if ($_smarty_tpl->tpl_vars['days']->value['wed']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['wed'];?>
</label>
                                        <input type="checkbox" id="check4" class="check" name="thu" value="4" <?php if ($_smarty_tpl->tpl_vars['days']->value['thu']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check4"><?php echo $_smarty_tpl->tpl_vars['translate']->value['thu'];?>
</label>
                                        <input type="checkbox" id="check5" class="check" name="fri" value="5"  <?php if ($_smarty_tpl->tpl_vars['days']->value['fri']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check5"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fri'];?>
</label>
                                        <input type="checkbox" id="check6" class="check" name="sat" value="6"  <?php if ($_smarty_tpl->tpl_vars['days']->value['sat']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check6"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sat'];?>
</label>
                                        <input type="checkbox" id="check7" class="check" name="sun" value="7"  <?php if ($_smarty_tpl->tpl_vars['days']->value['sun']==1){?>checked="checked"<?php }?> onchange="markChange()"/><label for="check7"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sun'];?>
</label>
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary"><?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_salary'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date  span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary" id="salary" type="text" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['amount'];?>
" onchange="markChange()"/>
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_call_training"><?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training_salary'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date  span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_call_training" id="salary_call_training" type="text" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['sal_call_training'];?>
" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_complimentary_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['complimentary_oncall_salary'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date span12" > <span class="add-on icon-pencil"></span>
                                        <input name="salary_complimentary_oncall" class="form-control span11" id="salary_complimentary_oncall" type="text" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['sal_complementary_oncall'];?>
" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_more_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall_salary'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_more_oncall" id="salary_more_oncall" type="text"  class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['sal_more_oncall'];?>
" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_dismissal_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_dismissal_oncall" id="salary_dismissal_oncall" type="text"  class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['timing']->value['sal_dismissal_oncall'];?>
" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                </div>
                <div class="row-fluid">
                    <div class="span12"></div>
                </div>
            </div>
        </form>
    </div>
</div>

                                
                            </div>

                        </div>
                    </div>
                </div>
                            
                

                <div id="chat_panel_wraper">
                    <div id="chat_list_main_wraper_group" class="people_list_fixed_content right_block_section panel-closed" style="overflow-y: auto; right: 0px; left: 190px;">
                        <div style="margin: 0px 0px 7px !important;" class="widget clearfix">
                            <div class="widget-header span12 no-ml" style="width: inherit;">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['chats_header'];?>
</h1>
                            </div>
                        </div>
                        <div style="margin: 0px 10px 5px;" class="peoples_list clearfix">
                            <div class="span12 no-ml clearfix mb" style="width: 100%;">
                                <div style="width: 100%;" class="input-prepend no-ml"> 
                                    <span class="add-on icon icon-search" style="height: 16px;"></span>
                                    <input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search'];?>
" id="chat-people-search" type="text" style="width: 86%;">
                                </div>
                            </div>

                            <ul id="people" class="list-group span12" style="width: 100%;"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-display span12 no-min-height" id="chats">
            
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
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/tooltip.js" type="text/javascript"></script><!--TOOLTIP BEGIN-->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.mCustomScrollbar.concat.min.js"></script>   <!--scroll bar-->
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
        var user = '<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
';
        var name = '<?php echo $_smarty_tpl->tpl_vars['user_display_name']->value;?>
';    
        var user_current_company = '<?php echo $_smarty_tpl->tpl_vars['company_id']->value;?>
';
        var chatListPeoples = <?php echo $_smarty_tpl->tpl_vars['chat_users']->value;?>
;   
        // console.log('A', JSON.stringify(chatListPeoples));
        var chat_service_url = '<?php echo $_smarty_tpl->tpl_vars['chat_service_url']->value;?>
';
    </script>

    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/clock.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/nice-scroll.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.contextmenu.js"></script>

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
    <script src="<?php echo $_smarty_tpl->tpl_vars['chat_service_url']->value;?>
/socket.io/socket.io.js"></script>  
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/client.js?v=<?php echo filemtime('js/client.js');?>
"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyCpNQnWGAj2z4cpzfqcOYgQ-V8mC2scVkE",
            authDomain: "t2v-cirrus.firebaseapp.com",
            databaseURL: "https://t2v-cirrus.firebaseio.com",
            projectId: "t2v-cirrus",
            storageBucket: "t2v-cirrus.appspot.com",
            messagingSenderId: "744149347141"
        };
        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        navigator.serviceWorker.register('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
firebase-messaging-sw.js')
        .then((registration) => {
            messaging.useServiceWorker(registration);

            messaging.requestPermission().then(function() {
              console.log('Notification permission granted.');
              return messaging.getToken();
            }).then(function(token) {
                console.log('token', token);
            }).catch(function(err) {
              console.log('Unable to get permission to notify.', err);
            });

            messaging.onMessage(function(payload){
                console.log('onMessage', payload);
                return registration.showNotification(payload.notification.title, { body: payload.notification.body});
            });
        });
    
    </script>
    <script type="text/javascript">

                $(document).ready(function(){
                    $(".faq").click(function(e){
                        var filename = "faq.pdf";
                        window.open('http://docs.google.com/viewer?url=<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
downloads/'+filename+'&embedded=true');
                    });
                    $('.alert-dismissable').delay(60000).fadeOut(); //1minute
                    
                    $('ul#lang_drop_down_menu li.lang_options:not(.active)').click(function(){
                        var sel_language = $(this).attr('data-val');
                        //alert(sel_language);
                        $('#user_language').val(sel_language);
                        $('#user_language_selection').submit();
                    });

                    $("#overlap_error").hide();
                  
                    $("#chat_thread").click(function(e) {
                        
                        if($("#chat_list_main_wraper_group").hasClass('panel-closed')){
                            $("#chat_list_main_wraper_group").css({
                                "right": "0px",
                                "left": "auto"
                            }, 'slow');
                            $("#chat_list_main_wraper_group").removeClass('panel-closed');
                        } else {
                            $("#right_panels, #chat_list_main_wraper_group").css({
                                "right": "auto",
                                "left": "100%"
                            }, 'slow');
                            $("#chat_list_main_wraper_group").addClass('panel-closed');
                        }
                    });
                });

                function wrapLoader(divID){
                        $(divID).wrap("<div id='outer_loader' class='clearfix'>");
                        $(divID).parent().append("<div id='load_overlay'>");
                        $(divID).parent().find("#load_overlay").append("<div id='load_anime'>");
                        $(divID).parent().find("#load_overlay, #load_anime").css("height",$(divID).parent().innerHeight())

                } 
                function uwrapLoader(divID){
                        $(divID).parent().find("#load_overlay").remove();
                        $(divID).parent().find("#load_anime").remove();
                        $(divID).unwrap();
                } 
                function navigatePage(path,sidemenu, post_data, scroll_top, _callback_fn) {
                    wrapLoader("#main_content #external_wrapper");
                    //$('ul.side_links li').each(function(index) {
                            //$(this).removeClass('active');
                    //});
                    $("ul.side_links").children('li').removeClass('active');
                    $('ul.side_links li#side_menu_li_'+sidemenu).addClass('active');
                    
                    $.ajaxSetup({ 'cache':true});
                    if(!$.isEmptyObject(post_data)){
                        $.ajax({
                            async:true,
                            cache: true,
                            url: path,
                            type: "POST",
                            data: post_data,
                            contentType: "application/x-www-form-urlencoded;charset=utf-8",
                            success:function(data){
                                    $("#main_content #external_wrapper").html(data);
                                    $('.alert-dismissable').delay(60000).fadeOut();
                            },
                            error: function (xhr, ajaxOptions, thrownError){
                                if(xhr.status == 527){
                                    var msg_content = '<div class="alert alert-danger alert-dismissable no-ml no-mr">\n\
                                                            <a href="#" data-dismiss="alert" class="close">×</a>\n\
                                                            <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  ' + thrownError + '\n\
                                                        </div>';
                                    $('#left_message_wraper').html(msg_content);
                                }
                                else 
                                    alert(thrownError);
                            }
                        }).always(function(data) { 
                            uwrapLoader("#main_content #external_wrapper");
                            $('.ui-dialog-content').dialog('close');
                            
                            /*if(typeof scroll_top !== 'undefined' && scroll_top === true){
                                $('.main-left').animate({
                                    scrollTop: 0
                                });
                            }*/
    
                            if(typeof _callback_fn !== 'undefined'){
                                _callback_fn();
                            }
                        });

                    }else {
                        $.ajax({
                            async:true,
                            cache: true,
                            url:path,
                            contentType: "application/x-www-form-urlencoded;charset=utf-8",
                            success:function(data){
                                    //history.replaceState(null, document.title, "www.google.com");
                                    //window.history.pushState("object or string", "Title", "www.google.com");
                                   //alert(data);
                                    $("#main_content #external_wrapper").html(data);
                                    $('.alert-dismissable').delay(60000).fadeOut();
                            },
                            error: function (xhr, ajaxOptions, thrownError){
                                if(xhr.status == 527){
                                    var msg_content = '<div class="alert alert-danger alert-dismissable no-ml no-mr">\n\
                                                            <a href="#" data-dismiss="alert" class="close">×</a>\n\
                                                            <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  ' + thrownError + '\n\
                                                        </div>';
                                    $('#left_message_wraper').html(msg_content);
                                }
                                else 
                                    alert(thrownError);
                            }
                        }).always(function(data) { 
                            uwrapLoader("#main_content #external_wrapper");
                            $('.ui-dialog-content').dialog('close');
                            
                            if(typeof _callback_fn !== 'undefined'){
                                _callback_fn();
                            }
                        });
                    }
                }

                
                function excecute_request(path, post_data, _callback_fn) {

                    wrapLoader("#main_content #external_wrapper");
                    $.ajaxSetup({ 'cache':true});
                    if(!$.isEmptyObject(post_data)){
                        $.ajax({
                            async:true,
                            cache: true,
                            url: path,
                            type: "POST",
                            data: post_data,
                            contentType: "application/x-www-form-urlencoded;charset=utf-8",
                            success:function(data){
                                    //$("#main_content #external_wrapper").html(data);
                                    //$('.alert-dismissable').delay(10000).fadeOut();
                            },
                            error: function (xhr, ajaxOptions, thrownError){
                                if(xhr.status == 527){
                                    var msg_content = '<div class="alert alert-danger alert-dismissable no-ml no-mr">\n\
                                                            <a href="#" data-dismiss="alert" class="close">×</a>\n\
                                                            <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  ' + thrownError + '\n\
                                                        </div>';
                                    $('#left_message_wraper').html(msg_content);
                                }
                                else 
                                    alert(thrownError);
                            }
                        }).always(function(data) { 
                            uwrapLoader("#main_content #external_wrapper");

                            if(typeof _callback_fn !== 'undefined'){
                                _callback_fn();
                            }
                        });

                    }else {
                        $.ajax({
                            async:true,
                            cache: true,
                            url:path,
                            contentType: "application/x-www-form-urlencoded;charset=utf-8",
                            success:function(data){
                                    //$("#main_content #external_wrapper").html(data);
                                    //$('.alert-dismissable').delay(10000).fadeOut();
                            },
                            error: function (xhr, ajaxOptions, thrownError){
                                if(xhr.status == 527){
                                    var msg_content = '<div class="alert alert-danger alert-dismissable no-ml no-mr">\n\
                                                            <a href="#" data-dismiss="alert" class="close">×</a>\n\
                                                            <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  ' + thrownError + '\n\
                                                        </div>';
                                    $('#left_message_wraper').html(msg_content);
                                }
                                else 
                                    alert(thrownError);
                            }
                        }).always(function(data) { 
                            uwrapLoader("#main_content #external_wrapper");

                            if(typeof _callback_fn !== 'undefined'){
                                _callback_fn();
                            }
                        });
                    }
                }
    </script>
    
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-ui.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
    <!--RESPOSNIVE TABS-->
    <script>
        
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-279});
    else
        $('.tab-content-con').css({ height: $(window).height()});    
        
        
    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function(){
      var itemsWidth = 0;
      $('.list li').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
      });
      return itemsWidth;
    };

    var widthOfHidden = function(){
      return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
      return $('.list').position().left;
    };

    var reAdjust = function(){
      if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
      }
      else {
        $('.scroller-right').hide();
      }
  
      if (getLeftPosi()<0) {
        $('.scroller-left').show();
      }
      else {
        $('.item').animate({ left:"-="+getLeftPosi()+"px" },'slow');
            $('.scroller-left').hide();
      }
    }
    reAdjust();

    $(window).on('resize',function(e){  
            reAdjust();
    });

    $('.scroller-right').click(function() {
  
      $('.scroller-left').fadeIn('slow');
      $('.scroller-right').fadeOut('slow');
  
      $('.list').animate({ left:"+="+widthOfHidden()+"px" },'slow',function(){

      });
    });
    $('.scroller-left').click(function() {
  
            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');
  
            $('.list').animate({ left:"-="+getLeftPosi()+"px" },'slow',function(){
  	
            });
    });    
    </script>
<script type="text/javascript">
    
    $(document).ready(function() {
    
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
            
        /*$( "#date_from, #date_to" ).datepicker({
            dateFormat: "yy-mm-dd"
        });*/

    //replace ',' => '.' while entering time
    $(document).off('keyup', "#time_from, #time_to")
        .on('keyup', "#time_from, #time_to", function() {
                $(this).val($(this).val().replace(/,/g,"."));
    });
     
    <?php if ($_smarty_tpl->tpl_vars['flag']->value==1){?>
        $(".oncalls_dsip").hide();
        toggme('new');
    <?php }?>
    //DAYS
    var hide_show_flag = 0;
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });
        
    $("table#holidayinc_main .holiday_main td.have_child, table#inconv_table .holiday_main td.have_child").click(function() {
            $(this).parents('.holiday_main').next('.child_holi').find('tr.item_row').toggleClass('hide');
    });
    
    $(".cancel-new-equipment").click(function() {
         $(".main-left").css('width', '99%');
        $(".main-right").css('display', 'none');
    });
    
    $(".btn-addnew-inconvtiming").click(function() {  
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right, .oncall-box").css('display', 'block');
        $('#hidden_action').val('newentry');
        
        $("#hidden_cust_id").val('');
        $("#hidden_cust_code").val('');
        $("#name").val('');
        $("#date_from").val('');
        $(".date_to").hide();
        $("#time_from").val('');
        $("#time_to").val('');
        $("#salary").val('');
        $("#salary_call_training").val('');
        $("#salary_complimentary_oncall").val('');
        $("#salary_more_oncall").val('');
        $("#salary_dismissal_oncall").val('');
        $("#ltype1").prop( "checked", false );
        $("#ltype2").prop( "checked", false );
        $("#ltype" ).buttonset();
        $("#check1").prop( "checked", false );    
        $("#check2").prop( "checked", false );   
        $("#check3").prop( "checked", false );    
        $("#check4").prop( "checked", false );    
        $("#check5").prop( "checked", false );   
        $("#check6").prop( "checked", false );    
        $("#check7").prop( "checked", false ); 
        $( "#format" ).buttonset();
						
        $('html, body').animate({
            scrollTop: $(".main-right").offset().top
        }, 3000);
    });
    $(".btn_edit").click(function() {  
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right").css('display', 'block');
        $(".oncall-box").css('display', 'block');
        $('#hidden_action').val('edit');
        
        ///////////////////////////ajax////////////////////////
        
         var user_id = $(this).attr('user_id');
         var code = $(this).attr('user_name');
         //console.log(user_name);
        wrapLoader('#edit_form_section');
        $.ajax({ 
            async   :false,
            url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_callsettings.php",
            data    : { "user_id" : user_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    //console.log(data);
                        $("#hidden_cust_id").val('');
                        $("#hidden_cust_code").val('');
                        $("#name").val('');
                        $("#date_from").val('');
                        $("#date_to").prop('disabled', true);
                        $(".date_to").hide();
                        $("#time_from").val('');
                        $("#time_to").val('');
                        $("#salary").val('');
                        $("#salary_call_training").val('');
                        $("#salary_complimentary_oncall").val('');
                        $("#salary_more_oncall").val('');
                        $("#salary_dismissal_oncall").val('');
                        $("#ltype1").prop( "checked", false );
                        $("#ltype2").prop( "checked", false );
                        
                        $("#check1").prop( "checked", false );    
                        $("#check2").prop( "checked", false );   
                        $("#check3").prop( "checked", false );    
                        $("#check4").prop( "checked", false );    
                        $("#check5").prop( "checked", false );   
                        $("#check6").prop( "checked", false );    
                        $("#check7").prop( "checked", false ); 
                    
                    if(data.transaction_flag !== undefined && data.transaction_flag){    
                        $("#hidden_cust_id").val(user_id);
                        $("#hidden_cust_code").val(code);
                        $("#name").val(data.inconvenient_detail.name);
                        $("#date_from").val(data.inconvenient_detail.effect_from);
                        if(data.inconvenient_detail.effect_to != null && data.inconvenient_detail.effect_to != ''){
                        $("#date_to").prop('disabled', false);
                        $(".date_to").show();
                        $("#date_to").val(data.inconvenient_detail.effect_to);
                        }else{
                        $("#date_to").prop('disabled', true);
                        }
                        $("#time_from").val(data.inconvenient_detail.time_from);
                        $("#time_to").val(data.inconvenient_detail.time_to);
                        $("#salary").val(data.inconvenient_detail.amount);
                        $("#salary_call_training").val(data.inconvenient_detail.sal_call_training);
                        $("#salary_complimentary_oncall").val(data.inconvenient_detail.sal_complementary_oncall);
                        $("#salary_more_oncall").val(data.inconvenient_detail.sal_more_oncall);
                        $("#salary_dismissal_oncall").val(data.inconvenient_detail.sal_dismissal_oncall);
                        if(data.inconvenient_detail.nature=='0')
                        $("#ltype1").prop( "checked", true );
                        if(data.inconvenient_detail.nature=='1')
                        $("#ltype2").prop( "checked", true );
                        $( "#ltype" ).buttonset();
                        
                        if(data.inconvenient_detail.days.mon==1)
                        $("#check1").prop( "checked", true );    
                        if(data.inconvenient_detail.days.tue==1)
                        $("#check2").prop( "checked", true );    
                        if(data.inconvenient_detail.days.wed==1)
                        $("#check3").prop( "checked", true );    
                        if(data.inconvenient_detail.days.thu==1)
                        $("#check4").prop( "checked", true );    
                        if(data.inconvenient_detail.days.fri==1)
                        $("#check5").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sat==1)
                        $("#check6").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sun==1)
                        $("#check7").prop( "checked", true );    
                        //id="check1" class="check" name="mon" value="1" 
                        $( "#format" ).buttonset();
                    }     
            }
            
        }).always(function(data) { 
            uwrapLoader("#edit_form_section");
        });
        
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
    });
    $(".btn_clone").click(function() {   
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right").css('display', 'block');
        $(".oncall-box").css('display', 'block');
        $('#hidden_action').val('clone');
        
        ///////////////////////////ajax////////////////////////
        
         var user_id = $(this).attr('user_id');
         var code = $(this).attr('user_name');
         //console.log(user_name);
        wrapLoader('#edit_form_section');
        $.ajax({ 
            async   :false,
            url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_callsettings.php",
            data    : { "user_id" : user_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    //console.log(data);
                    $("#hidden_cust_id").val('');
                        $("#hidden_cust_code").val('');
                        $("#name").val('');
                        $("#date_from").val('');
                        $("#date_to").prop('disabled', true);
                        $(".date_to").hide();
                        $("#time_from").val('');
                        $("#time_to").val('');
                        $("#salary").val('');
                        $("#salary_call_training").val('');
                        $("#salary_complimentary_oncall").val('');
                        $("#salary_more_oncall").val('');
                        $("#salary_dismissal_oncall").val('');
                        $("#ltype1,#ltype2").prop( "checked", false );
                        
                        $("#check1").prop( "checked", false );    
                        $("#check2").prop( "checked", false );   
                        $("#check3").prop( "checked", false );    
                        $("#check4").prop( "checked", false );    
                        $("#check5").prop( "checked", false );   
                        $("#check6").prop( "checked", false );    
                        $("#check7").prop( "checked", false ); 
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        
                        $("#hidden_cust_id").val(user_id);
                        $("#hidden_cust_code").val(code);
                        $("#name").val(data.inconvenient_detail.name);
                        $("#date_from").val(data.inconvenient_detail.effect_from);
                        if(data.inconvenient_detail.effect_to != null && data.inconvenient_detail.effect_to != ''){
                            $("#date_to").prop('disabled', false);
                            $(".date_to").show();
                            $("#date_to").val(data.inconvenient_detail.effect_to);
                        }
                        else{
                            $("#date_to").prop('disabled', true);
                        }
                        $("#time_from").val(data.inconvenient_detail.time_from);
                        $("#time_to").val(data.inconvenient_detail.time_to);
                        $("#salary").val(data.inconvenient_detail.amount);
                        $("#salary_call_training").val(data.inconvenient_detail.sal_call_training);
                        $("#salary_complimentary_oncall").val(data.inconvenient_detail.sal_complementary_oncall);
                        $("#salary_more_oncall").val(data.inconvenient_detail.sal_more_oncall);
                        $("#salary_dismissal_oncall").val(data.inconvenient_detail.sal_dismissal_oncall);
                        if(data.inconvenient_detail.nature=='0')
                        $("#ltype1").prop( "checked", true );
                        if(data.inconvenient_detail.nature=='1')
                        $("#ltype2").prop( "checked", true );
                        $( "#ltype" ).buttonset();
                        
                        
                        if(data.inconvenient_detail.days.mon==1)
                        $("#check1").prop( "checked", true );    
                        if(data.inconvenient_detail.days.tue==1)
                        $("#check2").prop( "checked", true );    
                        if(data.inconvenient_detail.days.wed==1)
                        $("#check3").prop( "checked", true );    
                        if(data.inconvenient_detail.days.thu==1)
                        $("#check4").prop( "checked", true );    
                        if(data.inconvenient_detail.days.fri==1)
                        $("#check5").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sat==1)
                        $("#check6").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sun==1)
                        $("#check7").prop( "checked", true );  
                        $( "#format" ).buttonset();
                    }     
            }
            
        }).always(function(data) { 
            uwrapLoader("#edit_form_section");
        });
        
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
    });
});


function validate(){
    
    var inc_name        = $.trim($('#edit_form_section #name').val());
    var inc_start_date  = $.trim($('#edit_form_section #date_from').val());
    var inc_time_from   = $.trim($('#edit_form_section #time_from').val());
    var inc_time_to     = $.trim($('#edit_form_section #time_to').val());
    var inc_type        = $.trim($('#edit_form_section input:radio[name=ltype]:checked').val());
    //var inc_days        = $.trim($('#edit_form_section #format input:checkbox[name=ltype]:checked').val());
    
    var inc_days_selected = false;
    for(var i=1;i<=7;i++){
        if($("#check"+i).is(":checked") != false)
            inc_days_selected = true;
    }
    
    if(inc_name == '' || inc_start_date == '' ||inc_time_from == '' || inc_time_to == '' || inc_type == '' || !inc_days_selected)
        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fill_required_fields'];?>
');
    else
        $('#timing').submit();
}
function check_from_date(){
    return true;    
}
function warning_delete(){
    if(confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_delete_holiday'];?>
"))
        return true;
    else
        return false;
}
function warning_delete_inconvenient(id,code){
    if(confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
")){

        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/inconvenient/timing/"+code+"/"+id+"/delete/";
    }
}
var change = 0;
var confirm_ask = 0;
function markChange(){
    change = 1;
    $("#new").val("1");
}
///////////////////////////MENU FUNCTIONS///////////////////////////////////
function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
");
    if(redirectURL != ''){
        if(change == 1){ 
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                                $( this ).dialog( "close" );
                                document.location.href = redirectURL;
                        }
                    }
            });
        }
        else{ 
            document.location.href = redirectURL;
        }
    }
}

function giveInactive(){
    var inact = $("#date_inactive").val();
    if(inact == "" || inact == null){
        $("#date_inactive").val("<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
");
    }
    markChange();

}   
function giveActivation(){
    var inact = $("#date_inactive").val();
    if(inact != "" || inact != null){
        $("#date_inactive").val("");
    }
    
    markChange();
}

function backForm() {
    //document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/customer/<?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/';
    window.history.back();
}
</script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.stickyPanel.js"></script>
<script>
	$(document).ready(function() {
            var stickyPanelOptions = {
                topPadding: 3,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };
            
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
        });
</script>

    </body>
</html><?php }} ?>