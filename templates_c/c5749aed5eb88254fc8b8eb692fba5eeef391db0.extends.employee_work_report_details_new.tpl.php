<?php /* Smarty version Smarty-3.1.8, created on 2021-03-01 05:23:01
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/employee_work_report_details_new.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1750043507603c7a355537f3-67094446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5749aed5eb88254fc8b8eb692fba5eeef391db0' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/employee_work_report_details_new.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
    '155ef44d21124b6a12721a0ce0a1b854e2116a35' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/dashboard.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1750043507603c7a355537f3-67094446',
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
  'unifunc' => 'content_603c7a35bb5337_94894792',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603c7a35bb5337_94894792')) {function content_603c7a35bb5337_94894792($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
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
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/cirrus.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/TableCSSCode.css" rel="stylesheet" type="text/css" />
    
    <style type="text/css">
        .signing_for_main{ width:234px;  padding:0px;  border:solid 1px #c9f2fb; }
        .signing_for_inner{ padding-right:10px; padding-top:5px; }
        .signing_remove_main{ padding-bottom:3px; width:234px; float:right; height:30px; border-bottom:solid 1px #c9f2fb; }
        .signing_form_label{ width:92px; float:left; display:block; padding-left:8px; }
        .signing_form_text{ float:left; width: 122px; }
        .signing_button{ padding-bottom:2px; padding-top:2px; }
        span.signed_user{ color: green; float: left; }
        span.signed_user.bankID{ color: #510080 !important; }
        span.signing_delete { color: red; float: left; font-weight: bold; padding-right: 20px; padding-top: 5px; }
        span.signing_bug { color: red; float: left; font-weight: bold; padding: 5px 20px; }
        .signing_bug_main{ padding-bottom:3px; /*width:234px;*/ float:right; height:auto; border-bottom:solid 1px #c9f2fb; }
        #kunder_info_strip .info_name { width: 31.7% !important }
        #kunder_info_strip .info_name b { margin-left: 5px; }
        ul.weeks li:hover { background-image: none; }
        .cursor_hand { cursor: pointer; }
        .box-wrpr { margin-top: 10px; background: #BEEAFF none repeat scroll 0% 0%;float: left;height: 160px;overflow: auto;overflow-x: hidden;padding: 5px;border: solid thin #7FD0EA; }
        ul.list-bank-id>li { margin: 10px; }
        ul.list-bank-id>li:nth-of-type(odd) { background-color: #FFF;}
        .box-wrpr.success-bg { background: #E4FFDA none repeat scroll 0% 0% !important;border: solid thin #A6E7A6;}
        .highlight-link { color: #2D2DCE;cursor: pointer;text-decoration: underline; }
        
        .highlight-link:hover, .highlight-link:focus { color:red; }

        .box-wrpr.type { background: #FFDBC7 none repeat scroll 0% 0% !important;border: thin solid #FFC3A1; } 

        @media screen and (max-width: 767px) { .height-auto { height: auto !important; min-height: auto !important; } }
        #leave_comments { padding: 13px 10px 5px 10px; margin: 0px; }
        #leave_comments ul li{ color: #bb5858; margin-bottom: 10px;border-bottom: 1px dashed #ccc; }
        #leave_comments ul li b{ color: #826e6e; }
        #leave_comments h4{ text-decoration: underline !important; margin-bottom: 12px; }
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
        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
    
        <?php if ($_smarty_tpl->tpl_vars['flag_emp_access']->value==1){?>
            <div class="tbl_hd height-auto" ><span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_monthly_report'];?>
</span>
            <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/<?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['report_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/" class="back pull-right"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['old_rpt_button'];?>
</span></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['back_url']->value;?>
" class="back pull-right"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a>
                <a onclick="printForm()" href="javascript:void(0)" class="print pull-right"><span class="btn_name">
                 <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a>
                
                <div class="clearfix"></div>
            </div>

            <div class="monthly_customerdetails span12 clearfix" style="padding:0px; margin:0px;">
                <div style="float:left; margin-top: 9px;">
                    <p class="ml"> 
                        <?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>

                        <select style="width: 183px" id="cmb_customer" name="cmb_customer">
                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['s_customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s_customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s_customer']->key => $_smarty_tpl->tpl_vars['s_customer']->value){
$_smarty_tpl->tpl_vars['s_customer']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['s_customer']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['s_customer']->value['username']==$_smarty_tpl->tpl_vars['customer_id']->value){?>selected='selected'<?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['s_customer']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['s_customer']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['s_customer']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['s_customer']->value['first_name']);?>
<?php }?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
                <div style="float:right;margin-top: 9px;">
                    <div style="border-radius:7px;" class="week_strip clearfix">
                        <div style="float:left;" class="arrow_left cursor_hand" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_previous_month'];?>
"><a style="border-radius:5px 0 0 5px;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['prv_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prv_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/"></a> </div>
                        <ul style="float:left;" class="weeks"><li style="width:auto; padding:2px 30px;" class="week_class"><a><?php echo $_smarty_tpl->tpl_vars['month_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
</a></li></ul>
                        <div style="float:left;" class="arrow_right cursor_hand" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_next_month'];?>
"><a style="border-radius:0 5px 5px 0;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['next_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/"></a> </div>
                    </div>
                </div>
                <div class="clearfix" colspan="1" style="float:right; width: 44px; text-align: center;" >
                    <span id="dp3" class="cursor_hand clearfix"  data-date="<?php echo (($_smarty_tpl->tpl_vars['report_year']->value).('-')).($_smarty_tpl->tpl_vars['report_month']->value);?>
" data-date-format="yyyy-mm" style="margin-top: 9px;"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/calendar_btstrap.png" alt='calendar' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_select_year_month'];?>
"/></span>
                    
                </div>
            </div>
            
            <?php if (($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6||$_smarty_tpl->tpl_vars['login_user_role']->value==2||$_smarty_tpl->tpl_vars['login_user_role']->value==3||$_smarty_tpl->tpl_vars['login_user_role']->value==7)&&($_smarty_tpl->tpl_vars['rpt_content_normal']->value||$_smarty_tpl->tpl_vars['rpt_content_travel']->value||$_smarty_tpl->tpl_vars['rpt_content_break']->value||$_smarty_tpl->tpl_vars['rpt_content_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave']->value||$_smarty_tpl->tpl_vars['rpt_content_over']->value||$_smarty_tpl->tpl_vars['rpt_content_quality']->value||$_smarty_tpl->tpl_vars['rpt_content_more']->value||$_smarty_tpl->tpl_vars['rpt_content_some']->value||$_smarty_tpl->tpl_vars['rpt_content_training']->value||$_smarty_tpl->tpl_vars['rpt_content_personal']->value||$_smarty_tpl->tpl_vars['rpt_content_calltraining']->value||$_smarty_tpl->tpl_vars['rpt_content_voluntary']->value||$_smarty_tpl->tpl_vars['rpt_content_complementary']->value||$_smarty_tpl->tpl_vars['rpt_content_standby']->value||$_smarty_tpl->tpl_vars['rpt_content_complementary_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_more_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_standby_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_travel']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_break']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_over']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_quality']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_more']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_some']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_training']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_personal']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_voluntary']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_calltraining']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_more_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_standby_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_standby']->value||$_smarty_tpl->tpl_vars['rpt_content_dismissal']->value||$_smarty_tpl->tpl_vars['rpt_content_dismissal_oncall']->value)){?>    

                <div class="row-fluid">
                <div id="emp_login" name="emp_login" class="span12" style="overflow: hidden;">

                    <div class="span5" id="signed_list">
                        <div class="box-wrpr type span12">
                        <span id="span_emp_sign"  class="span12 clearfix no-ml mb">
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
                        <span id="span_TL_sign"  class="span12 clearfix no-ml mb">
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
                                            <?php if ($_smarty_tpl->tpl_vars['allow_ordinary_signing']->value){?>
                                            <div style="float:left; margin-bottom:5px;">
                                                <label for="password" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                                <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                                            </div>
                                            <?php }?>
                                            <div style="float:left; padding:0px 0px 10px 10px; width:100%;" class="clearfix">
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
                                    <div class="signing_remove_main"> 
                                        <span class="signing signing_for_inner">
                                            
                                            <span class="signing_delete"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_signin'];?>
</span>
                                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
"></a>
                                             <input type="hidden" id="sign_sutl_id" value="<?php echo $_smarty_tpl->tpl_vars['signin_sutl']->value;?>
">
                                        </span>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }elseif($_smarty_tpl->tpl_vars['sign_status']->value=='both'){?> 
                            <div class="box-wrpr span12">
                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                                 
                                <div class="signing_remove_main"> 
                                    <span class="signing signing_for_inner">
                                        
                                            <span class="signing_delete"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_signin'];?>
</span>
                                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
"></a>
                                             <input type="hidden" id="sign_sutl_id" value="<?php echo $_smarty_tpl->tpl_vars['signin_sutl']->value;?>
">
                                            
                                    </span>
                                </div>
                                 
                            <?php }?>
                             
                            <?php if (($_smarty_tpl->tpl_vars['report_year']->value<$_smarty_tpl->tpl_vars['now_year']->value)||($_smarty_tpl->tpl_vars['report_month']->value<=$_smarty_tpl->tpl_vars['now_month']->value&&$_smarty_tpl->tpl_vars['report_year']->value==$_smarty_tpl->tpl_vars['now_year']->value)){?>    
                                <span class="signing_form clearfix">
                                    <div style="float:left; margin-bottom:5px; padding-top:3px;">
                                        <label for="username" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                        <input type="text" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
" disabled="disabled" style="background-color:  #D9D9D9; margin-left: 25px;" class="signing_form_text"/>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['allow_ordinary_signing']->value){?>
                                    <div style="float:left; margin-bottom:5px;">
                                        <label for="password" class="signing_form_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                        <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                                    </div>
                                    <?php }?>
                                    <div style="float:left; padding:0px 0px 10px 10px; width:100%;" class="clearfix">
                                        <?php if ($_smarty_tpl->tpl_vars['allow_ordinary_signing']->value){?><a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signin'];?>
</a><?php }?>
                                        <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                                    </div>    
                                    <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                                </span>
                            <?php }?>
                            </div>
                        <?php }?>
                        
                    </div>
                </div>
                </div>
            <?php }?>
            <div id="tble_list"> 
                <?php if ($_smarty_tpl->tpl_vars['show_sem_leave']->value){?>
                    <div id="kunder_info_strip" class="span12 no-ml" style="margin: 0 4px 4px 4px;">
                        <div class="info_name"><b><?php echo $_smarty_tpl->tpl_vars['translate']->value['earned_days'];?>
 : </b><?php echo $_smarty_tpl->tpl_vars['sem_leave_details']->value['this_fyear_earned_days'];?>
  </div>
                        <div class="info_name"><b><?php echo $_smarty_tpl->tpl_vars['translate']->value['taken_vacation_days'];?>
 : </b><?php echo $_smarty_tpl->tpl_vars['sem_leave_details']->value['this_fyear_takens_sem_leave_days'];?>
</div>
                        <div class="info_name"><b><?php echo $_smarty_tpl->tpl_vars['translate']->value['former_year_remain_days'];?>
 : </b><?php echo $_smarty_tpl->tpl_vars['sem_leave_details']->value['former_year_remaining_days'];?>
</div>
                    </div>
                <?php }?>
                <div class="span12" style="padding: 0px; margin: 0px;">
                    <?php if ($_smarty_tpl->tpl_vars['report_month']->value==''){?><?php $_smarty_tpl->tpl_vars['report_month'] = new Smarty_variable((smarty_modifier_date_format(time(),"%m"))+0, null, 0);?><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['report_year']->value==''){?><?php $_smarty_tpl->tpl_vars['report_year'] = new Smarty_variable(smarty_modifier_date_format(time(),"%Y"), null, 0);?><?php }?>
                    <div class="alphbts pagention" style="width: 99.5%; margin-top: 5px; height: auto !important;">
                        
                        <form id="form_report" method="post" class='no-mb mt'>
                            
                            <div class="span2">
                                 <?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
: <?php echo $_smarty_tpl->tpl_vars['month_name']->value;?>

                            </div>
                            <div class="span4">  Period: <?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['rpt_month']->value;?>
-01 -- <?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['rpt_month']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['cur_month_last_date']->value;?>
</div>
                            
                        
                            
                            <input type="hidden" id="sel_month" name="sel_month" value="<?php echo $_smarty_tpl->tpl_vars['report_month']->value;?>
">
                            
                            
                            <input type="hidden" id="sel_year" name="sel_year" value="<?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
">
                            
                            <div class="span2 pull-right">
                                <i class="icon icon-group"></i> 
                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
: <?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>

                                <input type="hidden" id="sel_employee" name="sel_employee" value="<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
">
                           </div>
                               <div class="span2 pull-right">
                                <i class="icon icon-user"></i> 
                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
: <?php echo $_smarty_tpl->tpl_vars['customer_name']->value;?>

                                <input type="hidden" id="sel_customer" name="sel_customer" value="<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
">
                            </div>
                            
                            
                            
                            <input type="hidden" name="action" id="action" value="" />
                        </form>
                    </div>

                </div>
                <?php if (!empty($_smarty_tpl->tpl_vars['heads']->value)||!empty($_smarty_tpl->tpl_vars['heads_leave']->value)){?>
                <div id="content_table" class="no-ml" name="content_table" style="width:100%; overflow: scroll; min-height: 400px; margin-left:6px">
                       
                        <table class="table_list" width="100%" id="cont_table">
                            <thead>
                            <tr align="center">
                                <th></th>
                                <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
?>
                                    <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                        <th colspan="<?php echo count($_smarty_tpl->tpl_vars['ordered_types']->value,1)-(count($_smarty_tpl->tpl_vars['ordered_types']->value)*2-1);?>
"><?php if ($_smarty_tpl->tpl_vars['type_key']->value=='normal'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['normal_main_head_signing_report'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['type_key']->value];?>
<?php }?></th>
                                    <?php } ?>                                    
                                <?php } ?>
                                <?php  $_smarty_tpl->tpl_vars['heads_main'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['heads_main']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_leave']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['heads_main']->key => $_smarty_tpl->tpl_vars['heads_main']->value){
$_smarty_tpl->tpl_vars['heads_main']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type']->value = $_smarty_tpl->tpl_vars['heads_main']->key;
?>
                                    <?php $_smarty_tpl->tpl_vars['sub_count'] = new Smarty_variable(0, null, 0);?>
                                    <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['heads_main']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
?>
                                        <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>

                                            <?php $_smarty_tpl->tpl_vars['sub_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['sub_count']->value+count($_smarty_tpl->tpl_vars['ordered_types']->value,1)-(count($_smarty_tpl->tpl_vars['ordered_types']->value)*2-1), null, 0);?>
                                            <?php if ($_smarty_tpl->tpl_vars['leave_type']->value==100){?><?php $_smarty_tpl->tpl_vars['sub_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['sub_count']->value-1, null, 0);?><?php }?>
                                        <?php } ?>
                                    <?php } ?>
                                    <th colspan="<?php echo $_smarty_tpl->tpl_vars['sub_count']->value;?>
" style="background:#f9dddd"><?php if ($_smarty_tpl->tpl_vars['leave_type']->value==100){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_sum'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['leave_types']->value[$_smarty_tpl->tpl_vars['leave_type']->value];?>
<?php }?></th>
                                <?php } ?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)){?>
                                    <?php $_smarty_tpl->tpl_vars['fkkn_colspan'] = new Smarty_variable(0, null, 0);?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)&&strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"1\":")>0){?><?php $_smarty_tpl->tpl_vars['fkkn_colspan'] = new Smarty_variable(1, null, 0);?><?php }?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)&&(strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"2\":")>0||strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"3\":")>0)){?><?php $_smarty_tpl->tpl_vars['fkkn_colspan'] = new Smarty_variable($_smarty_tpl->tpl_vars['fkkn_colspan']->value+1, null, 0);?><?php }?>
                                    <th colspan="<?php echo $_smarty_tpl->tpl_vars['fkkn_colspan']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkntu_sum'];?>
</th>
                                <?php }?>                                
                            </tr>
                            <tr align="center">
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</th>
                                <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
?>
                                    <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                        <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
?>
                                            <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>
                                                    <th <?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>style="background:#F5BE87"<?php }?>><?php if ($_smarty_tpl->tpl_vars['head_item']->value==$_smarty_tpl->tpl_vars['type_key']->value||$_smarty_tpl->tpl_vars['head_item']->value=='sum'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['head_item']->value];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['head_item']->value;?>
<?php }?></th>
                                                <?php } ?>   
                                            <?php } ?>
                                        <?php } ?>   
                                    <?php } ?>
                                <?php } ?>

                                <?php  $_smarty_tpl->tpl_vars['heads_main'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['heads_main']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_leave']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['heads_main']->key => $_smarty_tpl->tpl_vars['heads_main']->value){
$_smarty_tpl->tpl_vars['heads_main']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type']->value = $_smarty_tpl->tpl_vars['heads_main']->key;
?>
                                    <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_smarty_tpl->tpl_vars['order_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_main']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
 $_smarty_tpl->tpl_vars['order_key']->value = $_smarty_tpl->tpl_vars['ordered_heads']->key;
?>
                                        <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                            <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
?>
                                                <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                    <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>
                                                        <th style="background:<?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>#F5BE87<?php }else{ ?>#f9dddd<?php }?>"><?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'||($_smarty_tpl->tpl_vars['order_key']->value==2&&$_smarty_tpl->tpl_vars['main_head']->value=='base_normal')){?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['head_item']->value];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['head_item']->value;?>
<?php }?></th>
                                                    <?php } ?>   
                                                <?php } ?>
                                            <?php } ?>   
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>  
                                <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)&&strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"1\":")>0){?><th style="background:#F5BE87"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk_sum'];?>
<?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)&&(strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"2\":")>0||strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"3\":")>0)){?><th style="background:#F5BE87"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kntu_sum'];?>
<?php }?>
                            </tr>
                            </thead>
                            
                            <tbody align="right">
                                <?php $_smarty_tpl->tpl_vars['tot_fk'] = new Smarty_variable(0, null, 0);?> 
                                <?php $_smarty_tpl->tpl_vars['tot_kntu'] = new Smarty_variable(0, null, 0);?> 
                                <?php  $_smarty_tpl->tpl_vars['date_key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['date_key']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['days_in_month']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['date_key']->key => $_smarty_tpl->tpl_vars['date_key']->value){
$_smarty_tpl->tpl_vars['date_key']->_loop = true;
?>
                                    
                                    <tr>
                                    <td><a style="border-bottom: 1px dashed #999;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['date_key']->value;?>
&employee=<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
&return_page=emp_work_report_new',1)"><?php echo substr($_smarty_tpl->tpl_vars['date_key']->value,5);?>
 <?php echo substr($_smarty_tpl->tpl_vars['translate']->value[mb_strtolower(smarty_modifier_date_format($_smarty_tpl->tpl_vars['date_key']->value,"%a"), 'UTF-8')],0,3);?>
<?php if (in_array($_smarty_tpl->tpl_vars['date_key']->value,$_smarty_tpl->tpl_vars['comment_dates']->value)){?><span style="color: red;">*</span><?php }?></a></td>
                                        <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable(array(), null, 0);?>
                                        <?php if (array_key_exists($_smarty_tpl->tpl_vars['date_key']->value,$_smarty_tpl->tpl_vars['results']->value)){?>
                                            <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable($_smarty_tpl->tpl_vars['results']->value[$_smarty_tpl->tpl_vars['date_key']->value], null, 0);?>
                                        <?php }?>    
                                        <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_smarty_tpl->tpl_vars['heads_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
 $_smarty_tpl->tpl_vars['heads_key']->value = $_smarty_tpl->tpl_vars['ordered_heads']->key;
?>
                                            <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                                <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_order_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_order_key']->value = $_smarty_tpl->tpl_vars['types']->key;
?>
                                                    <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                        <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>
                                                            
                                                            <?php if (array_key_exists($_smarty_tpl->tpl_vars['heads_key']->value,$_smarty_tpl->tpl_vars['contents']->value)&&array_key_exists($_smarty_tpl->tpl_vars['type_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_order_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['main_head']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['head_item']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['main_head']->value])){?>

                                                                <td <?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>style="background:#F5BE87"<?php }?>><?php echo number_format($_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['main_head']->value][$_smarty_tpl->tpl_vars['head_item']->value],2,'.','');?>

                                                                
                                                                </td>
                                                            <?php }else{ ?>
                                                                <td <?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>style="background:#F5BE87"<?php }?>></td>
                                                            <?php }?>   
                                                            
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>        
                                            <?php } ?>
                                        <?php } ?>

                                        <?php if (array_key_exists($_smarty_tpl->tpl_vars['date_key']->value,$_smarty_tpl->tpl_vars['results_leave']->value)){?>
                                            <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable($_smarty_tpl->tpl_vars['results_leave']->value[$_smarty_tpl->tpl_vars['date_key']->value], null, 0);?>
                                        <?php }?>


                                        <?php  $_smarty_tpl->tpl_vars['heads_main'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['heads_main']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_leave']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['heads_main']->key => $_smarty_tpl->tpl_vars['heads_main']->value){
$_smarty_tpl->tpl_vars['heads_main']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type']->value = $_smarty_tpl->tpl_vars['heads_main']->key;
?>
                                            <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_smarty_tpl->tpl_vars['heads_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_main']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
 $_smarty_tpl->tpl_vars['heads_key']->value = $_smarty_tpl->tpl_vars['ordered_heads']->key;
?>
                                                <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                                    <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_order_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_order_key']->value = $_smarty_tpl->tpl_vars['types']->key;
?>
                                                        <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                            <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>                                                                                                         
                                                                <?php if (array_key_exists($_smarty_tpl->tpl_vars['leave_type']->value,$_smarty_tpl->tpl_vars['contents']->value)&&array_key_exists($_smarty_tpl->tpl_vars['heads_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_order_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['main_head']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['head_item']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['main_head']->value])){?>
                                                                    
                                                                    <td style="background:<?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>#F5BE87<?php }else{ ?>#f9dddd<?php }?>"><?php echo number_format($_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['main_head']->value][$_smarty_tpl->tpl_vars['head_item']->value],2,'.','');?>

                                                                    
                                                                    </td>
                                                                <?php }else{ ?>
                                                                    <td style="background:<?php if ($_smarty_tpl->tpl_vars['head_item']->value=='sum'){?>#F5BE87<?php }else{ ?>#f9dddd<?php }?>"></td>
                                                                <?php }?>   
                                                                
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>        
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?> 
                                        <?php if (!empty($_smarty_tpl->tpl_vars['fkkn_slots']->value)){?>
                                                <?php if (strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"1\":")>0){?>

                                                    <td style="background:#F5BE87"><?php if ($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][1]){?><?php echo number_format($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][1],2,'.','');?>
<?php }else{ ?>&nbsp;<?php }?></td>
                                                    <?php if ($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][1]){?><?php $_smarty_tpl->tpl_vars['tot_fk'] = new Smarty_variable($_smarty_tpl->tpl_vars['tot_fk']->value+$_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][1], null, 0);?><?php }?>
                                                <?php }?>
                                                <?php if (strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"2\":")>0||strpos(json_encode($_smarty_tpl->tpl_vars['fkkn_slots']->value),"\"3\":")>0){?>
                                                    <td style="background:#F5BE87"><?php if ($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][2]||$_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][3]){?><?php echo number_format($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][2]+$_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][3],2,'.','');?>
<?php }else{ ?>&nbsp;<?php }?></td>
                                                    <?php if ($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][2]){?><?php $_smarty_tpl->tpl_vars['tot_kntu'] = new Smarty_variable($_smarty_tpl->tpl_vars['tot_kntu']->value+$_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][2], null, 0);?><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][3]){?><?php $_smarty_tpl->tpl_vars['tot_kntu'] = new Smarty_variable($_smarty_tpl->tpl_vars['tot_kntu']->value+$_smarty_tpl->tpl_vars['fkkn_slots']->value[$_smarty_tpl->tpl_vars['date_key']->value][3], null, 0);?><?php }?>
                                                <?php }?>
                                        <?php }?>
                                    </tr>
                                <?php } ?>
                                <tr style="background: green; color: white;">
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['total'];?>
</td>
                                    

                                    <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable($_smarty_tpl->tpl_vars['total']->value, null, 0);?>
                                    <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_smarty_tpl->tpl_vars['heads_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
 $_smarty_tpl->tpl_vars['heads_key']->value = $_smarty_tpl->tpl_vars['ordered_heads']->key;
?>
                                        <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                            <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_order_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_order_key']->value = $_smarty_tpl->tpl_vars['types']->key;
?>
                                                <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                    <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>
                                                        
                                                        <?php if (array_key_exists($_smarty_tpl->tpl_vars['heads_key']->value,$_smarty_tpl->tpl_vars['contents']->value)&&array_key_exists($_smarty_tpl->tpl_vars['type_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_order_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['head_item']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value])){?>

                                                            <td ><?php echo number_format($_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['head_item']->value],2,'.','');?>

                                                            
                                                            </td>
                                                        <?php }else{ ?>
                                                            <td></td>
                                                        <?php }?>   
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>        
                                        <?php } ?>
                                    <?php } ?>

                                    <!-- <?php if (array_key_exists($_smarty_tpl->tpl_vars['date_key']->value,$_smarty_tpl->tpl_vars['results_leave']->value)){?>
                                            <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable($_smarty_tpl->tpl_vars['total_leave']->value, null, 0);?>
                                        <?php }?> -->
                                    <?php $_smarty_tpl->tpl_vars['contents'] = new Smarty_variable($_smarty_tpl->tpl_vars['total_leave']->value, null, 0);?>
                                    <?php  $_smarty_tpl->tpl_vars['heads_main'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['heads_main']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_leave']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['heads_main']->key => $_smarty_tpl->tpl_vars['heads_main']->value){
$_smarty_tpl->tpl_vars['heads_main']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type']->value = $_smarty_tpl->tpl_vars['heads_main']->key;
?>
                                        <?php  $_smarty_tpl->tpl_vars['ordered_heads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_heads']->_loop = false;
 $_smarty_tpl->tpl_vars['heads_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['heads_main']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_heads']->key => $_smarty_tpl->tpl_vars['ordered_heads']->value){
$_smarty_tpl->tpl_vars['ordered_heads']->_loop = true;
 $_smarty_tpl->tpl_vars['heads_key']->value = $_smarty_tpl->tpl_vars['ordered_heads']->key;
?>
                                            <?php  $_smarty_tpl->tpl_vars['ordered_types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ordered_types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_heads']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ordered_types']->key => $_smarty_tpl->tpl_vars['ordered_types']->value){
$_smarty_tpl->tpl_vars['ordered_types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_key']->value = $_smarty_tpl->tpl_vars['ordered_types']->key;
?>
                                                <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_smarty_tpl->tpl_vars['type_order_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ordered_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
 $_smarty_tpl->tpl_vars['type_order_key']->value = $_smarty_tpl->tpl_vars['types']->key;
?>
                                                    <?php  $_smarty_tpl->tpl_vars['head'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head']->_loop = false;
 $_smarty_tpl->tpl_vars['main_head'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head']->key => $_smarty_tpl->tpl_vars['head']->value){
$_smarty_tpl->tpl_vars['head']->_loop = true;
 $_smarty_tpl->tpl_vars['main_head']->value = $_smarty_tpl->tpl_vars['head']->key;
?>
                                                        <?php  $_smarty_tpl->tpl_vars['head_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['head_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['head_item']->key => $_smarty_tpl->tpl_vars['head_item']->value){
$_smarty_tpl->tpl_vars['head_item']->_loop = true;
?>  
                                                            <!-- <?php echo $_smarty_tpl->tpl_vars['leave_type']->value;?>
 -- <?php echo $_smarty_tpl->tpl_vars['heads_key']->value;?>
===<?php echo $_smarty_tpl->tpl_vars['type_key']->value;?>
---<?php echo $_smarty_tpl->tpl_vars['type_order_key']->value;?>
--<?php echo $_smarty_tpl->tpl_vars['head_item']->value;?>
--<br> -->
                                                            <?php if (array_key_exists($_smarty_tpl->tpl_vars['leave_type']->value,$_smarty_tpl->tpl_vars['contents']->value)&&array_key_exists($_smarty_tpl->tpl_vars['heads_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['type_order_key']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value])&&array_key_exists($_smarty_tpl->tpl_vars['head_item']->value,$_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value])){?>

                                                                <td><?php echo number_format($_smarty_tpl->tpl_vars['contents']->value[$_smarty_tpl->tpl_vars['leave_type']->value][$_smarty_tpl->tpl_vars['heads_key']->value][$_smarty_tpl->tpl_vars['type_key']->value][$_smarty_tpl->tpl_vars['type_order_key']->value][$_smarty_tpl->tpl_vars['head_item']->value],2,'.','');?>

                                                                
                                                                </td>
                                                            <?php }else{ ?>
                                                                <td>&nbsp;</td>
                                                            <?php }?>   
                                                            
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>        
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if ($_smarty_tpl->tpl_vars['tot_fk']->value){?><td><?php echo number_format($_smarty_tpl->tpl_vars['tot_fk']->value,2,'.','');?>
</td><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['tot_kntu']->value){?><td><?php echo number_format($_smarty_tpl->tpl_vars['tot_kntu']->value,2,'.','');?>
</td><?php }?>
                                </tr>
                                
                            </tbody>

                        </table>
                    
                </div>
                <?php }?>

                <?php if (count($_smarty_tpl->tpl_vars['leave_comments']->value)>0){?>
                    <div id="leave_comments" class="span12">
                        <h4><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_comments'];?>
</h4>
                        <ul class="span12 no-ml">
                        <?php  $_smarty_tpl->tpl_vars['lc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['leave_comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lc']->key => $_smarty_tpl->tpl_vars['lc']->value){
$_smarty_tpl->tpl_vars['lc']->_loop = true;
?>
                            <li><b><i class="icon icon-comment"></i> <?php echo $_smarty_tpl->tpl_vars['lc']->value['date'];?>
 :</b> <?php echo $_smarty_tpl->tpl_vars['lc']->value['comment'];?>
</li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php }?>
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
js/date-picker.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.floatThead.min.js" type="text/javascript" ></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
    <script type="text/javascript">

    function printForm(){
        if($("#sel_month").val() != "" && $("#sel_year").val() != "" && $("#sel_employee").val() != ""){
            var f = $("#form_report");
            f.attr('target', '_BLANK');
            $('#action').val('print');
            f.submit();
        }
    //    $('#action').val('print');
    //    $('#forms').submit();
    //    if($("#cmb_employee").val() != "" && $("#lstTidStart").val() != "" && $("#lstTidSlut").val() != ""){
    //        var f = $("#forms");
    //        f.attr('target', '_BLANK');
    //        $('#action').val('print');
    //        f.submit();
    //    }
    }

    <?php if (($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6||$_smarty_tpl->tpl_vars['login_user_role']->value==2||$_smarty_tpl->tpl_vars['login_user_role']->value==3||$_smarty_tpl->tpl_vars['login_user_role']->value==7)&&($_smarty_tpl->tpl_vars['rpt_content_normal']->value||$_smarty_tpl->tpl_vars['rpt_content_travel']->value||$_smarty_tpl->tpl_vars['rpt_content_break']->value||$_smarty_tpl->tpl_vars['rpt_content_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave']->value||$_smarty_tpl->tpl_vars['rpt_content_over']->value||$_smarty_tpl->tpl_vars['rpt_content_quality']->value||$_smarty_tpl->tpl_vars['rpt_content_more']->value||$_smarty_tpl->tpl_vars['rpt_content_some']->value||$_smarty_tpl->tpl_vars['rpt_content_training']->value||$_smarty_tpl->tpl_vars['rpt_content_personal']->value||$_smarty_tpl->tpl_vars['rpt_content_calltraining']->value||$_smarty_tpl->tpl_vars['rpt_content_voluntary']->value||$_smarty_tpl->tpl_vars['rpt_content_complementary']->value||$_smarty_tpl->tpl_vars['rpt_content_complementary_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_travel']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_break']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_over']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_quality']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_more']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_some']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_training']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_personal']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_voluntary']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_oncall']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_calltraining']->value||$_smarty_tpl->tpl_vars['rpt_content_standby']->value||$_smarty_tpl->tpl_vars['rpt_content_leave_standby']->value||$_smarty_tpl->tpl_vars['rpt_content_dismissal']->value||$_smarty_tpl->tpl_vars['rpt_content_dismissal_oncall']->value)){?>

        function sign_remove(){
            var signin_sutl_id  = $("#sign_sutl_id").val();
            
            if (signin_sutl_id == ''){
                sign_remove_update();
            }
            else if ('<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
' == signin_sutl_id){
                  bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_delete_report'];?>
', [
                        {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                            "class" : "btn-danger",
                        },
                         {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                            "class" : "btn-success",
                            "callback": function() {
                                sign_remove_update('own_delete');
                            }
                         }
                  ]);
            }
            else if ('<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
' != signin_sutl_id ){
                 bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_delete_report_singed_other_admin'];?>
', [
                        {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                            "class" : "btn-danger",
                        },
                         {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                            "class" : "btn-success",
                            "callback": function() {
                                sign_remove_update('other_delete');
                            }
                         }
                  ]);
            }
            
        }

        function sign_remove_update(_type_delete){
            var type_delete = typeof _type_delete != "undefined" ? _type_delete : null;
            var month = $("#sel_month").val();
            var year = $("#sel_year").val();
            var employee = $("#sel_employee").val();
            var customer = $("#sel_customer").val();
            if(month != "" && year != "" && employee != "" && customer != ""){
                $("#signing_message").html("");
                wrapLoader('#emp_login');
                $.ajax({
                        async:false,
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_signing_remove.php",
                        data:"type_delete="+type_delete+"&month="+month+"&year="+year+"&emp="+employee+"&customer="+customer,
                        type:"POST",
                        success:function(data){
                                $("#emp_login").html(data);
                                uwrapLoader('#emp_login');
                        }
                    });
            }
        }

        
        function check(flag){           
            var uname = $("#username").val();
            var pword = $("#password").val();
            var month = $("#sel_month").val();
            var year = $("#sel_year").val();
            var employee = $("#sel_employee").val();
            var customer = $("#sel_customer").val();

            if((uname == "" || pword == "") && flag == 0){
                $("#signing_message").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['username_or_password_missing'];?>
").addClass("signing_error").removeClass("signing_success");
            }else if(employee == ""){
                $("#signing_message").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_one_employee'];?>
").addClass("signing_error").removeClass("signing_success");
            }else if(customer == ""){
                $("#signing_message").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_one_customer'];?>
").addClass("signing_error").removeClass("signing_success");
            }
            else if(month != "" && year != "" && employee != "" && customer != ""){
                $("#signing_message").html("");
                wrapLoader('#emp_login');
                $.ajax({
                        async:false,
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_signing.php",
                        data:"UN="+uname+"&PW="+pword+"&month="+month+"&year="+year+"&emp="+employee+"&customer="+customer+"&consolidated="+'<?php echo $_smarty_tpl->tpl_vars['rpt_consolidated']->value;?>
'+'&bank_id_flag='+flag,
                        type:"POST",
                        success:function(data){
                                console.log(data);

                                if(flag == 1){
                                    $("#signing_message").html(data);
                                }
                                else{
                                    var invalid_pword = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_username_or_password'];?>
';
                                    if(data.trim().toString() == invalid_pword.trim().toString()){
                                        $("#signing_message").html(data);
                                        $("#signing_message").parents('.box-wrpr').animate({ scrollTop: $("#signing_message").parents('.box-wrpr').height()}, 800);
                                    }else
                                        $("#emp_login").html(data);
                                }
                                uwrapLoader('#emp_login');
                        }

                });
            }

        }

        $(document).ready(function(){
            $(".signing_form #username, .signing_form #password").live("keyup", function(event) {
                if(event.keyCode == 13){
                    $(".signing_form .signing_button").click();
                }
            });

        });
    <?php }?>
    $(document).ready(function(){
            $("#cmb_customer").change(function(){
                var selected_customer = $.trim($(this).val());
                if(selected_customer != ''){
                    location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['report_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
/'+selected_customer+'/';
                }
            });
            
            $("#dp3").datepicker({
                format: "yyyy-mm",
                changeMonth: true,
                changeYear: true,
                viewMode: "months", //1
                minViewMode: "months",
                autoclose: true,
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
                //defaultDate: '2014-05',//new Date(), 
                onClose: function (dateText, inst) { }
            }).on('changeDate', function(ev){
                //if(ev.viewMode == 'months'){
                    var month = $.datepicker.formatDate('mm', ev.date);
                    var year = $.datepicker.formatDate('yy', ev.date);
                    $("#dp3").datepicker('hide');
                    location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/'+year+'/'+month+'/<?php echo $_smarty_tpl->tpl_vars['employee_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
/';
                //}
            });

            if($(window).height() > 600){
                $('#content_table').css({ height: Math.max($(window).innerHeight()- ($('#content_table').length > 0 ? $('#content_table').offset().top : 0), 250) });
                $(window).resize(function(){
                    $('#content_table').css({ height: Math.max($(window).innerHeight()- ($('#content_table').length > 0 ? $('#content_table').offset().top : 0), 250) });
                });

                var $demo1 = $('table#cont_table');
                $demo1.floatThead({
                        scrollContainer: function($demo1){
                                return $demo1.closest('#content_table');
                        }
                });
            }

    });
    </script>
    

    </body>
</html><?php }} ?>