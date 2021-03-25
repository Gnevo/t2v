<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 13:35:24
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9205094095fce218c392815-23421026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0337efd25960c6dd1fa311caa6d719e58fbef1b' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl',
      1 => 1536921822,
      2 => 'file',
    ),
    'f56bd38f863d90029d9893de6daaf868b060648c' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/customer_documentation.tpl',
      1 => 1560344726,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9205094095fce218c392815-23421026',
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
  'unifunc' => 'content_5fce218c8967e9_04551945',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce218c8967e9_04551945')) {function content_5fce218c8967e9_04551945($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_truncate')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.truncate.php';
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
css/date-picker.css" /><!-- DATE PICKER -->

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/css/summernote.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/css/codemirror.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/css/blackboard.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/css/monokai.min.css" />
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
    .btn-toolbar .colour_strip{
        width: 50px; height: 20px;
    }
    .note_block_head {
        background-color: #D8E0F0;
        border-color: #DBD8F0;
        color: #7C4688;
        margin-bottom: 1px;
        padding: 9px 3px;
    }
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
                                
    <?php if ($_smarty_tpl->tpl_vars['access_flag']->value==1){?>
        <div id="autosave"></div>
        <div id="dialog-confirm" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>

        </div>
        <div id="dialog-confirm-delete" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['are_you_sure'];?>
</p>

        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
 
        <div class="row-fluid">
            <div style="" class="span12 main-left">
                <div style="margin: 0px;" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                        <?php if (!empty($_smarty_tpl->tpl_vars['customer_detail']->value)){?>
                            <div class="widget-body" style="padding:4px;">
                                <div class="row-fluid">
                                    <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
</strong> : <?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['social_security'];?>
</div>
                                    <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_code'];?>
 :</strong> <?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['code'];?>
</div>
                                    <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 :</strong> <?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']);?>
</div>
                                    <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 :</strong> <?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']);?>
</div>     
                                    <?php }?>
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
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                        <?php if (!$_smarty_tpl->tpl_vars['data']->value[0]['writable']){?><button class="btn btn-default btn-normal pull-right ml" type="button" <?php if (isset($_smarty_tpl->tpl_vars['new']->value)){?> onclick="saveForm('newsave')" <?php }else{ ?> onclick="saveForm('edit')" <?php }?>><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button><?php }?>
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')"><span class="icon-print"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                                        <?php if (!$_smarty_tpl->tpl_vars['data']->value[0]['writable']){?><button class="btn btn-default btn-normal pull-right rm" type="button" onclick="saveLock()"><span class="icon-lock"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_lock'];?>
</button><?php }?>
                                    </div>
                                </div>
                            </div>
                                
                                
                                
                            <div class="tab-content-con boxscroll1">
                            <div class="tab-content span12" style="margin:0;">
                                 <div role="tabpanel" class="tab-pane active" id="tab-7">
                                     <form name="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
/" class="pull-left span12">
                                <input type="hidden" name="username" id="username" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
" />
                                <input type="hidden" name="saves" id="saves" value="<?php echo $_smarty_tpl->tpl_vars['new']->value;?>
" />
                                <input type="hidden" name="vals" id="vals" value="vals" />
                                <input type="hidden" name="ids" id="ids" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['id'];?>
" />
                                <input type="hidden" name="new" id="new" value="<?php echo $_smarty_tpl->tpl_vars['new']->value;?>
" />
                                <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                <input type="hidden" name="file_delete" id="file_delete" value="0" />
                                <input type="hidden" name="read_write" id="read_write" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['writable'];?>
" />
                                   <div style="" class="span12 widget-body-section input-group">
                                        <div class="row-fluid">
                                             <div class="span12"><div style="margin: 0px ! important;" class="widget-header span12">
                                            <div class="widget" style="margin: 0px ! important;">
                                                <!--WIDGET BODY BEGIN-->
                                                <div class="span12 widget-body-section input-group no-padding">
                                                    <div class="row-fluid">
                                                        <div style="margin: 0px ! important;" class="widget-header span12">
                                                            <div class="span3">
                                                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_existing_data'];?>
</h1>
                                                            </div>
                                                            <div style="padding-top: 8px; margin: 0px ! important;" class="span3">
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <select class="form-control span12" name="date" id="date" onchange="load_documentation()">
                                                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                        <?php  $_smarty_tpl->tpl_vars['date'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['date']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['date']->key => $_smarty_tpl->tpl_vars['date']->value){
$_smarty_tpl->tpl_vars['date']->_loop = true;
?>
                                                                            <option  value="<?php echo $_smarty_tpl->tpl_vars['date']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['created_date']==$_smarty_tpl->tpl_vars['date']->value['created_date']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['date']->value['created_date'];?>
<?php if ($_smarty_tpl->tpl_vars['date']->value['subject']!=''){?> - <?php echo $_smarty_tpl->tpl_vars['date']->value['subject'];?>
<?php }?></option>
                                                                        <?php } ?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value=="3"){?>
                                                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['msg_notes']->value!="0"){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['message_centre_notes'];?>
</option>
                                                                        <?php }?>
                                                                    </select>
                                                                    <input name="person_num" type="hidden" id="person_num" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
" />
                                                                    <input name="id" type="hidden" id="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['id'];?>
"  />
                                                                </div>
                                                            </div>
                                                            <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                                                <button class="btn btn-default btn-normal pull-right" type="button" onclick="new_docs()"><span class="icon-plus"></span> <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_documentation'];?>
<?php }elseif($_smarty_tpl->tpl_vars['documentation_type']->value==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_protocol'];?>
<?php }elseif($_smarty_tpl->tpl_vars['documentation_type']->value==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_note_to_self'];?>
<?php }?></button>
                                                                <button class="btn btn-default btn-normal pull-right" type="button" onclick="toggles_form()"><span class="icon-search"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['search'];?>
</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="widget" style="margin: 0px ! important;">
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div style="margin: 0px 0px 15px ! important; display: none;" class="span12 widget-body-section input-group search-implimentation-wrpr">       
                                                                <div class="span12">
                                                                    <div class="span2" style="margin-top: 10px;">
                                                                        <label style="float: left;" class="span12" for="search_element"><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_element'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span9" name="search_element" type="text" id="search_element_search" value="" /> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input class="check-box" type="radio" name="radio_search" id="search_element_all" value="1" onclick="display_byall()" checked="checked" />
                                                                        <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</span>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="radio" name="radio_search" id="search_element_bydate" value="3" onclick="display_bydate()" />
                                                                        <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['by_date'];?>
</span>
                                                                        <div class="search_element_col_expand" id="search_by_date" style="display: none;">
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_from'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                    <input class="form-control span9" name="search_element" type="text" id="search_element_fromdate" value="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
" />
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_to'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                    <input class="form-control span9" name="search_element" type="text" id="search_element_todate" value="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input style="margin-left: 10px ! important;" type="radio" name="radio_search" id="search_element_bymonth" value="2" onclick="display_bymonth()" />
                                                                        <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['by_month'];?>
</span>
                                                                        <div class="search_element_col_expand_month"  id="search_by_month" style="display: none;">
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="search_element_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" name="search_element_month" id="search_element_month" name="month">
                                                                                        <option value="01" <?php if (smarty_modifier_date_format(time(),"%m")==1){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['january'];?>
</option>
                                                                                        <option value="02" <?php if (smarty_modifier_date_format(time(),"%m")==2){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['february'];?>
</option>
                                                                                        <option value="03" <?php if (smarty_modifier_date_format(time(),"%m")==3){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['march'];?>
</option>
                                                                                        <option value="04" <?php if (smarty_modifier_date_format(time(),"%m")==4){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['april'];?>
</option>
                                                                                        <option value="05" <?php if (smarty_modifier_date_format(time(),"%m")==5){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
                                                                                        <option value="06" <?php if (smarty_modifier_date_format(time(),"%m")==6){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['june'];?>
</option>
                                                                                        <option value="07" <?php if (smarty_modifier_date_format(time(),"%m")==7){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['july'];?>
</option>
                                                                                        <option value="08" <?php if (smarty_modifier_date_format(time(),"%m")==8){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['august'];?>
</option>
                                                                                        <option value="09" <?php if (smarty_modifier_date_format(time(),"%m")==9){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['september'];?>
</option>
                                                                                        <option value="10" <?php if (smarty_modifier_date_format(time(),"%m")==10){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['october'];?>
</option>
                                                                                        <option value="11" <?php if (smarty_modifier_date_format(time(),"%m")==11){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['november'];?>
</option>
                                                                                        <option value="12" <?php if (smarty_modifier_date_format(time(),"%m")==12){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['december'];?>
</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="Search Element_year"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" name="search_element_year" id="search_element_year" name="year">
                                                                                        <?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
?> 
                                                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['year']->value['year'];?>
"><?php echo $_smarty_tpl->tpl_vars['year']->value['year'];?>
</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input class="check-box" type="radio" name="radio_search" id="search_element_mc" value="4" onclick="display_byall()" />
                                                                        <span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['message_centre_notes'];?>
</span>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 17px;">
                                                                        <button class="btn btn-default btn-margin-set btn-search-implimenation pull-right" style="margin: 0px;" type="button" name="search_element_get" id="search_element_get" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['get'];?>
" onclick="get_search()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['get'];?>
</button>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        
                                                                        <?php if ($_smarty_tpl->tpl_vars['note_display']->value!="yes"){?>
                                                                            <div class="span6">
                                                                                <label style="float: left;" class="span12" for="employed"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employed'];?>
</label>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12" name="employed" id="employed" onchange="makeChange()" <?php if ($_smarty_tpl->tpl_vars['data']->value){?>disabled="disabled"<?php }?>>
                                                                                        <option value=""  ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                                        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
"<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['employee']!=''||$_smarty_tpl->tpl_vars['data']->value[0]['employee']!=null){?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['employee']==$_smarty_tpl->tpl_vars['employee']->value['username']){?> selected="selected" <?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['default_user']->value==$_smarty_tpl->tpl_vars['employee']->value['username']){?> selected="selected" <?php }?><?php }?> ><?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                        <div class="span6" style="margin:20px 0px 0px 0px;">

                                                                            <label style="margin: 0px;" for="exampleInputEmail1"></label>
                                                                            <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['note_type']!=''){?>
                                                                                <ol class="radio-group"> 
                                                                                    <li><input  name="note_type" type="radio" class="opt" id="dokumentation" value="dokumentation" onclick="load_document_particular('1')" <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==1){?> checked="checked" <?php }?>   <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> />
                                                                                        <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</label></li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="protokoll" value="protokoll" onclick="load_document_particular('2')"  <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==2){?> checked="checked'" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>  />
                                                                                        <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['protocol'];?>
</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="minnesanteckning" value="minnesanteckning" onclick="load_document_particular('3')"  <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==3){?> checked="checked'" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> />
                                                                                        <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_to_self'];?>
</label>

                                                                                    </li>
                                                                                </ol>
                                                                            <?php }else{ ?>
                                                                                <ol class="radio-group"> 
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="dokumentation" value="dokumentation" <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==1){?> checked="checked" <?php }?> onclick="load_document_particular('1')"  />
                                                                                        <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="protokoll" value="protokoll" onclick="load_document_particular('2')" <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==2){?> checked="checked" <?php }?> />
                                                                                        <label class="label-option-and-checkbox" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['protocol'];?>
</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input name="note_type" type="radio" class="opt" id="minnesanteckning" value="minnesanteckning" onclick="load_document_particular('3')" <?php if ($_smarty_tpl->tpl_vars['documentation_type']->value==3){?> checked="checked" <?php }?> />
                                                                                        <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_to_self'];?>
</label>

                                                                                    </li>
                                                                                </ol> 
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span12 no-ml">
                                                                        <?php if ($_smarty_tpl->tpl_vars['note_display']->value!="yes"){?>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject"><?php echo $_smarty_tpl->tpl_vars['translate']->value['subject'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span11" name="subject" type="text"  class="textarea_amne" id="subject" onchange="makeChange()" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['subject'];?>
" /> 
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                        <div class="span12 no-ml">
                                                                            <div class="document_strip" id="notes_display_normal">
                                                                                <label style="float: left;" class="span12" for="notes"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note'];?>
</label>
                                                                                <div class="pull-left span11 no-ml">
                                                                                    <textarea class="form-control span11" name="notes" id="notes" onchange="makeChange()" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['notes']!=''){?>
                                                                        <div class="row-fluid">
                                                                            <div class="span11 no-ml">
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;">
                                                                                    <?php echo $_smarty_tpl->tpl_vars['data']->value[0]['notes'];?>

                                                                                </pre>
                                                                            </div>
                                                                        </div>
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                    
                                                <div style="margin: 10px 0px 0px;" class="row-fluid action-list-wrpr">
                                                    <div class="span12">
                                                        <div class="widget" style="margin: 0px ! important;">
                                                            <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
                                                                <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
                                                                    <div class="widget-header span12">
                                                                        <div class="span4 day-slot-wrpr-header-left span6">
                                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['action_list'];?>
</h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span4">
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date_created"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_created'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-calendar"></span>
                                                                                <input class="form-control span9" name="date_created" type="text" id="date_created" onchange="makeChange()" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['created_date'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> /> 
                                                                            </div>
                                                                        </div>

                                                                        <div style="margin: 10px 0px ! important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_completed'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-calendar"></span>
                                                                                <input class="form-control span9" name="date_last" type="text" id="date_last"  onchange="makeChange()" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['completed_date']!='0000-00-00 00:00:00'){?><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['completed_date'];?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> /> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="span12" style="margin:0;">
                                                                        
                                                                        <label style="margin: 0px;" for="status">
                                                                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
 : 
                                                                            <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['status']!=''){?>
                                                                              
                                                                                   <ol class="radio-group">
                                                                              
                                                                               <li> <input  name="status" type="radio" class="sta" id="paborjad" value="paborjad" onclick="makeChange()"  <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['status']=='paborjad'){?> checked="checked" <?php }?><?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['begun'];?>
</label></li>
                                                                                <li><input  type="radio" name="status" class="sta" id="fardig" value="slutfort" onclick="makeChange()"  <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['status']=="slutfort"){?> checked="checked" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?> />
                                                                                <label class="label-option-and-checkbox" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['completed'];?>
</label></li>
                                                                                
                                                                                </ol>
                                                                                
                                                                            <?php }else{ ?>
                                                                               <ol class="radio-group">
                                                                              
                                                                               <li>
                                                                                <input name="status" type="radio" class="sta" id="paborjad" value="paborjad" onclick="makeChange()"  checked="checked"/>
                                                                               <label class="label-option-and-checkbox" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['begun'];?>
</label></li>
                                                                               <li> <input  type="radio" name="status" class="sta" id="fardig" value="slutfort"  onclick="makeChange()"  />
                                                                                <label class="label-option-and-checkbox" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['completed'];?>
</label></li>
                                                                            <?php }?>
                                                                        </label>
                                                                        </ol>
                                                                     </div>   
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                            <label style="float: left;" class="span12" for="priority"><?php echo $_smarty_tpl->tpl_vars['translate']->value['priority'];?>
:</label>
                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?>
                                                                                    <input class="form-control span11" name="data_priority" type="text" id="data_priority" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['priority'];?>
" onchange="makeChange()" readonly="readonly"/>
                                                                                <?php }else{ ?>
                                                                                    <select class="form-control span11" name="priority" id="priority" onchange="makeChange()">
                                                                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                                        <option value="Låg" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['priority']=="Låg"){?> selected="selected" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['low'];?>
</option>
                                                                                        <option value="Medel" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['priority']=="Medel"){?> selected="selected" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['medium'];?>
</option>
                                                                                        <option value="Hög" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['priority']=="Hög"){?> selected="selected" <?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['high'];?>
</option>
                                                                                    </select>
                                                                                <?php }?>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="margin: 0px ! important;" class="span12 no-ml">
                                                                            <div class="document_strip" id="notes_display_normal">
                                                                                <label style="float: left;" class="span12" for="notes"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note'];?>
</label>
                                                                                <div class="pull-left span11 no-ml">
                                                                                        <textarea class="form-control span11" name="more_notes" id="more_note" onchange="makeChange()" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['writable']){?> readonly="readonly"<?php }?>><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['description'];?>
</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <input type="hidden" name="tdocs" id="tdocs" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['document'];?>
" />
                                                                        <input type="hidden" name="del_doc" id="del_doc" value="" />
                                                                        <div class="span12" style="margin:0">
                                                                            <div id="file_list">
                                                                                <ul class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                                                    <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['document']!=''){?>
                                                                                        <?php  $_smarty_tpl->tpl_vars['customer_document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_documents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_document']->key => $_smarty_tpl->tpl_vars['customer_document']->value){
$_smarty_tpl->tpl_vars['customer_document']->_loop = true;
?>
                                                                                            <li class="list-group-item">
                                                                                                <img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['icon'];?>
" width="14" height="17" />
                                                                                                <a id="lic_1" href="javascript:void(0)" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
')"><?php echo $_smarty_tpl->tpl_vars['customer_document']->value['name'];?>
</a>
                                                                                                <a href="javascript:void(0);" style="float: right;" onclick="docRemove('<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
')" class="btn btn-danger"><span class="icon-trash"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_file'];?>
</span></a>
                                                                                                <div class="clearfix"></div>
                                                                                            </li>
                                                                                        <?php }
if (!$_smarty_tpl->tpl_vars['customer_document']->_loop) {
?>
                                                                                            <li class="list-group-item"><?php echo $_smarty_tpl->tpl_vars['translate']->value['there_are_no_files'];?>
</li>
                                                                                        <?php } ?>
                                                                                    <?php }else{ ?>
                                                                                    <li class="list-group-item"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['there_are_no_files'];?>
</span></li>
                                                                                    <?php }?>
                                                                                </ul>
                                                                            </div>
                                                                            <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file">
                                                                                <input type="hidden" name="file_count" id="file_count" value="1" />
                                                                                <div id="file_attach" class="span12 no-ml">
                                                                                    <input class="no-ml span12 pull-left" type="file" name="file_1" id="file_1" size="12"/>
                                                                                </div>
                                                                                <label>.doc, .docx, .pdf, .odt</label>
                                                                            </span>
                                                                            <div style="margin-top: 3px" class="row-fluid">
                                                                                <label class="span6"><a id="attach_file" href="javascript:void(0);" class="btn btn-default" onclick="attachAnother()" style="margin-top:15px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_new_file'];?>
</a></label>
                                                                                <label class="span6"><a id="remove_file" href='javascript:void(0);' class="btn btn-default" style="margin-top:15px" onclick='removeFile()' ><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_file'];?>
</a></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($_smarty_tpl->tpl_vars['note_display']->value=="yes"){?>                        
                                                    <div style="margin: 10px 0px 0px;" class="row-fluid">
                                                        <div class="span12">
                                                            <div class="widget" style="margin: 0px ! important;">
                                                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                                                <table class="table table-white table-bordered table-hover table-responsive swipe-horizontal table-primary">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['writer'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['title'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['discription'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_written'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['visibility'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['view'];?>
</th>
                                                                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                                                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</th>
                                                                                <?php }?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['all_notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                                                            <tr class="<?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
<?php if ($_smarty_tpl->tpl_vars['i']->value==0){?> first<?php }?>" id="status_<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">

                                                                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['emp_name'];?>
</td>
                                                                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['cust_name'];?>
</td>
                                                                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['title']);?>
</td>
                                                                                <?php $_smarty_tpl->tpl_vars["cnt"] = new Smarty_variable(strlen($_smarty_tpl->tpl_vars['list']->value['description']), null, 0);?>
                                                                                <td><?php if ($_smarty_tpl->tpl_vars['cnt']->value>100){?><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['list']->value['description'],100));?>
<?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['description']);?>
<?php }?></td>
                                                                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</td>
                                                                                <td><?php if ($_smarty_tpl->tpl_vars['list']->value['visibility']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>

                                                                                    <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['private'];?>

                                                                                        <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>

                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==4){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only'];?>
<?php }?></td>
                                                                                                <td style="width:50px;text-align:center;">
                                                                                                    <?php if ($_smarty_tpl->tpl_vars['list']->value['attachment']!=''){?>
                                                                                                        <a style="float:left;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/detail/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/1/" class="btn btn-default"><i class="icon-wrench"></i></a>&nbsp;&nbsp;
                                                                                                        <?php }else{ ?>
                                                                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/detail/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/1/" class="btn btn-default"><i class="icon-wrench"></i></a>
                                                                                                        <?php }?> 
                                                                                                        <?php if ($_smarty_tpl->tpl_vars['list']->value['attachment']!=''){?><a href="javascript:void(0);" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
"><i class="icon-wrench"></i></a><?php }?>
                                                                                                </td>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                                                                                    <td><?php if ($_smarty_tpl->tpl_vars['list']->value['status']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
<?php }elseif($_smarty_tpl->tpl_vars['list']->value['status']==0){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['forbidden'];?>
<?php }?></td>
                                                                                                <?php }?>
                                                                                            </tr>
                                                                                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                                                                            <?php }
if (!$_smarty_tpl->tpl_vars['list']->_loop) {
?>
                                                                                            <td colspan="8"><div id="no_data" class="message" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td>
                                                                                                <?php } ?>

                                                                                                </tbody>
                                                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/demo/form_validator.js"></script>



<!-- include libraries BS3 -->
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/codemirror.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/xml.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/formatting.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/wysiwyg/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-254});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    var hidWidth;
    var scrollBarWidths = 40;

    $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
    });
    
    $('#date_created, #date_last').datetimepicker({
        format: "yyyy-mm-dd  hh:ii:ss",
        autoclose: true,
        todayBtn: true/*,
        startDate: "2013-02-14 10:00",
        pickerPosition: "bottom-left"*/

    }); 
    var now = new Date();
    /*$('#date_created, #date_last').datetimepicker($.extend($.timepicker.regional["<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
"],{
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm:ss',
            hour:   now.getHours(),
            minute: now.getMinutes(),
            second: now.getSeconds(), 
            showOn: "button",                    
            buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
            buttonImageOnly: true,
            regional: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
    }));*/
    
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
    

});
</script>
<script type="text/javascript">
    
var hides = 0;
var hide = 0;
var change_var = 0; 

$(document).ready(function() {
    
        $('.success, .message, .fail, .error').delay(10000).fadeOut();

        $("#search_element").hide();
                
        if($("#date_created").val() =='')$("#date_created").datetimepicker('setDate', new Date($.now()));  
        //if($("#date_created").val() == '') $("#date_created").datetimepicker('setDate', new Date('<?php echo date('Y-m-d H:i:s');?>
'));     
            
            $(".toggme").hide(400);
            $("#date_created").removeClass("required");
            $("#priority").removeClass("required");
            hide = 1;
            hides = 1;
            $("#kunder").validate({
                    rules: {
                            subject: {
                                    required: true
                            },
                            employed: {
                                    required: true
                            },
                            notes: {
                                    required: true
                            }
                    }
            });
        
     <?php if ($_smarty_tpl->tpl_vars['data']->value['created_date']==''){?>
        $(".toggme").hide();
        hide = 1;
      <?php }?>
          
    });
    
    function load_documentation()
    {
            var date_ids = $("#date").val();
            if(date_ids != ''){
                if(date_ids == "0"){
                    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/"+$('#person_num').val()+"//get/m2/";

                }else{
                    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/";
                }
            }else{
                new_docs();
            }
            
               
        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/";
    }
    
    function new_docs()
    {
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
/new/";
    }
    
    function toggle_form()
    {
        $(".action-list-wrpr").toggle();
    }
    function saveForm()
    {   
        if($("#subject").val() != "" || $("#employed").val() != "" || $.trim($("#notes").val()) != "" || $("#more_note").val() != ""){
            //$("#form").attr('target','self').submit();
            $("#form").submit();
        }else{

            alert("Data Not Found");
        }
    }
        
    function resetForm() {
        
        //var loc = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
/new/";
        document.location.reload();
    }
    function backForm() {
            //document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/customer/<?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/';
            window.history.back();
        }
    function validate() {
         if($("#date_created").val() > $("#date_last").val())
         {
             $(".form_err").show();
             $("#form_err").html("&nbsp;&nbsp;&nbsp;Datum slutf�rt skall vara st�rre eller lika med Datum skapat");
            return false;
         }
    }
        function toggles_form() {
        $(".search-implimentation-wrpr").toggle();
    }   
        function get_search(){
            var search_radio = $('input:radio[name=radio_search]:checked').val();
            var month = $("#search_element_month").val();
            var year = $("#search_element_year").val();
            var search_text = $("#search_element_search").val();
            var dates_from = $("#search_element_fromdate").val();
            var dates_to = $("#search_element_todate").val();
            var username = '<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
';
            window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer_documentation_print.php?search_val="+search_radio+"&month="+month+"&year="+year+"&date_from="+dates_from+"&date_to="+dates_to+"&username="+username+"&search_text="+search_text+"&type=<?php echo $_smarty_tpl->tpl_vars['documentation_type']->value;?>
","_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=800, height=440");

        }
        
function print_data(username){
    var dt=$("#date option:selected").text();    
    var date=$("#date option:selected").val();    
    
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_customer_documentation.php?username="+username+"&date="+dt+"&date_id="+date+'&_'+Date.now());
    /*var obj=document.getElementById('form');
    obj.target = '_blank';
    obj.action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_customer_documentation.php?username="+username+"&date="+dt+"&date_id="+date;
    obj.submit();*/
}
 
function display_bydate(){
    $("#search_by_date").show();
    $("#search_by_month").hide();
}

function display_bymonth(){
    $("#search_by_date").hide();
    $("#search_by_month").show();
}

function display_byall(){
    $("#search_by_date").hide();
    $("#search_by_month").hide();
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
");
    if(redirectURL != ''){
        if(change_var == "1"){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
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



function makeChange(){
    change_var = 1;
}


function load_document_particular(type_num){
   
    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/"+type_num+"/";
}

function saveLock() {
    $('#read_write').val(1);
    //alert($('#read_write').val());
    saveForm();   
}

function deleteDocumentFile() {
    $('#file_delete').val(1);
    saveForm();     
}

function attachAnother() {
    var file_count = parseInt($('#file_count').val()) + 1;
    if(file_count > 1){
        $("#remove_file").show();
    }
    $('#file_count').val(file_count);
    $('#file_attach').append("<div class='span12 no-ml file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' class='pull-left' /></div>");
}

function removeFile(id){
    var id = $('#file_count').val();
    var file_count = parseInt(id) - 1;
    if(file_count == 1){
        $("#remove_file").hide();
    }
    $('#file_count').val(file_count);
    $('div').remove('.file_attach_row' + id);
}
function docRemove(doc) {
    $( "#dialog-confirm-delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                $( this ).dialog( "close" );
                var old_del = $("#del_doc").val();               
                var old_docs = $('#tdocs').val();
                var doc_array = old_docs.split(",");
                for(var i=0; i < doc_array.length; i++) {
                    if(doc_array[i] == doc) {
                        doc_array.splice(i, 1);
                        if(old_del == ""){
                            $("#del_doc").val(doc);
                        }else{
                            $("#del_doc").val(old_del+","+doc);
                        }
                        break;
                    }
                }
                var new_array = doc_array.toString();
                $('#tdocs').val(new_array);
                $('#file_list').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
                $("#file_list").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_documents.php?type=customer_document&docs=" + new_array);
            },
            "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                $( this ).dialog( "close" );
            }
        }
    });
}
function downloadFile(filename){
    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
}


</script>
<script type="text/javascript">
    $(function () {
        $('#notes').summernote({
            height: 70,
            tabsize: 2,
            codemirror: {
              theme: 'monokai'
            },
            defaultFontName: 'Times New Roman',
            fontNamesIgnoreCheck: ['Times New Roman'],
            lang: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
            toolbar: [
                //[groupname, [button list]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link',  'hr']],
                ['view', ['fullscreen', 'codeview']]
              ]
          });
        $('#more_note').summernote({
            height: 130,
            tabsize: 2,
            codemirror: {
              theme: 'monokai'
            },
            defaultFontName: 'Times New Roman',
            fontNamesIgnoreCheck: ['Times New Roman'],
            lang: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
            toolbar: [
                //[groupname, [button list]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link',  'hr']],
                ['view', ['fullscreen', 'codeview']]
              ]
          });
        
    });
</script>

    </body>
</html><?php }} ?>