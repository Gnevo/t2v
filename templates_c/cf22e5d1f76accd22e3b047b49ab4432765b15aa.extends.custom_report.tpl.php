<?php /* Smarty version Smarty-3.1.8, created on 2021-02-24 06:46:45
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/survey/custom_report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7207776246035f65585e240-83311489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf22e5d1f76accd22e3b047b49ab4432765b15aa' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/survey/custom_report.tpl',
      1 => 1613804739,
      2 => 'file',
    ),
    '155ef44d21124b6a12721a0ce0a1b854e2116a35' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/dashboard.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7207776246035f65585e240-83311489',
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
  'unifunc' => 'content_6035f655ad0190_24097211',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035f655ad0190_24097211')) {function content_6035f655ad0190_24097211($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
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
        
<link type="text/css" rel="stylesheet"  href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/surveys/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/surveys/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
        .scroll-pane, .scroll-pane-arrows { width: 100% !important; height: 250px; overflow: auto; }
        .horizontal-only { height: auto; max-height: 250px; }
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
        <form name="report_form" id="report_form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
S_custom_final_report.php" class="clearfix">
            <div class="Surveys_block clearfix" style="height: auto; padding: 0px;">
                <input type="hidden" name="groups_report" id="groups_report" value="" />
                <input type="hidden" name="ans" id="ans" value="" />
                <input type="hidden" name="filter" id="filter" value="" />

                <div class="typeof_reporthd clearfix">
                    <div class="report_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['custom_report'];?>
</div>
                    <div class="reportdetails_agerange">
                        <div class="reportdetails_agerangecnt no-mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['age_range'];?>
 :</div>
                        <div class="result_fromdate">
                            <input type="text" class="result_agebox" name="age_from" id="age_from">
                        </div>
                        <div class="result_todate">
                            <div class="reportdetails_to no-mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</div>
                            <input type="text" class="result_agebox" name="age_to" id="age_to">
                        </div>
                    </div>
                    <div class="reports_gender">
                        <div class="reportgender_cnt no-mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
 :</div>
                        <div class="surveystatus_exp no-mt">
                            <input name="male_select" type="checkbox" value="1" id="male_select">
                        </div>
                        <div class="surveystatus_experd no-mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
 </div>
                        <div class="surveystatus_exp no-mt">
                            <input name="female_select" type="checkbox" value="2" id="female_select">
                        </div>
                        <div class="surveystatus_experd no-mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
 </div>
                        <input type="hidden"  name="gender" id="gender" value="">
                    </div>
                        
                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/survey/list/';" style="margin: 0px 5px;" class="btn btn-primary btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                </div>

                <div style="clear:both">
                    <div class="surveyresult_qustblock" style="padding:0px;"> </div>
                    <div class="survey_caption clearfix">
                        <div class="selectsurvey_name"><?php echo $_smarty_tpl->tpl_vars['survey']->value[0]['survey_title'];?>
</div>

                        <div class="selectsurvey_date">
                            <div class="reportdetails_date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['survey']->value[0]['created_date'],'%Y-%m-%d');?>
</div>
                        </div>
                        <div class="creat_reportbtn" style="float: right; font-weight:normal;margin-right: 5px;">
                            <a href="javascript:void(0)" onclick="getReport()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['create_report'];?>
</a>
                        </div>
                    </div>

                    <div class="customerview_surveylisting clearfix" data-section-name='report_group'>
                        <input type="hidden" name="selected" id="selected" value="" />
                        <input type="hidden" name="survey_id" id="survey_id" value="<?php echo $_smarty_tpl->tpl_vars['survey_id']->value;?>
" />
                        <div class="customerview_serveylist clearfix ">
                            <div class="customerview_servaname clearfix"><a><?php echo $_smarty_tpl->tpl_vars['translate']->value['groups'];?>
</a></div>
                            <div class="customerview_selectbutton clearfix">
                                <a href="javascript:void(0);" onclick="addGroups()" id="add_groups" style="display: none"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_groups'];?>
 </a>
                            </div>
                        </div>
                        <div style="display:none;" class="customerviewserva_listeddetails" id="groups_custom">
                            <div class="coustomerview_discription clearfix">
                                <?php if (count($_smarty_tpl->tpl_vars['groups']->value)>0){?>
                                    <div class="report_questionblock">
                                        <div class="report_group">
                                            <div class="reportdetail_qusthdr"><?php echo $_smarty_tpl->tpl_vars['translate']->value['groups'];?>
</div>
                                            <div class="reportdetail_groups">
                                                <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
                                                    <div class="report_questblock clearfix">
                                                        <div class="quest_check">
                                                            <input name="group_<?php echo $_smarty_tpl->tpl_vars['group']->value['group_id'];?>
"  id="group_<?php echo $_smarty_tpl->tpl_vars['group']->value['group_id'];?>
" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
" onclick="addGroups('<?php echo $_smarty_tpl->tpl_vars['group']->value['group_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
')">
                                                        </div>
                                                        <div class="group_cnt"><?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
</div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="report_selectgroup">
                                            <div class="reportdetail_qusthdr"><?php echo $_smarty_tpl->tpl_vars['translate']->value['selected_groups'];?>
</div>
                                            <div class="reportdetail_groupsanswer clearfix">
                                                <!-- <div class="report_selectedgroups">maneesh <a></a></div>-->
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_group_founds_for_survey'];?>

                                <?php }?>
                            </div>
                        </div>
                    </div>
                            

                    <div class="customerview_surveylisting clearfix"  data-section-name='report_questions'>
                        <div class="customerview_serveylist clearfix">
                            <div class="customerview_servaname clearfix">
                                <a><?php echo $_smarty_tpl->tpl_vars['translate']->value['questions'];?>
</a>
                            </div>

                        </div>
                        <div style="display:none;" class="customerviewserva_listeddetails" id="quest_custom">
                            <div class="coustomerview_discription">
                                <?php if (count($_smarty_tpl->tpl_vars['questions']->value)>0){?>
                                    <div class="report_questionblock clearfix">
                                        <div class="coustomerreport_question">
                                            <div class="reportdetail_qusthdr">
                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['questions'];?>

                                                <span class="chk_question_ctrl" style="float: right; font-size: 12px;"><input type="checkbox" name="all_check" id="all_check_questions"><span class="pull-right ml"><label for="all_check_questions"><?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>
</label></span></span>
                                            </div>
                                            <div class="reportdetail_qustions" id="question_block" style="height: 348px; ">
                                                <?php  $_smarty_tpl->tpl_vars['quest'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quest']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quest']->key => $_smarty_tpl->tpl_vars['quest']->value){
$_smarty_tpl->tpl_vars['quest']->_loop = true;
?>
                                                    <div class="report_questblock  span12 no-ml">
                                                        <div class="quest_check">
                                                            <input   id="quest_<?php echo $_smarty_tpl->tpl_vars['quest']->value['id'];?>
" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['quest']->value['id'];?>
" onclick="addQuests('<?php echo $_smarty_tpl->tpl_vars['quest']->value['id'];?>
')" class="question_check">
                                                        </div>
                                                        <div class="quest_img"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/surveys/report_quest.jpg" width="7" height="13"></div>
                                                        <div class="quest_cnt"><?php echo $_smarty_tpl->tpl_vars['quest']->value['question'];?>
</div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="coustomerreport_selectquestion clearfix" >
                                            <div class="reportdetail_qusthdr"><?php echo $_smarty_tpl->tpl_vars['translate']->value['selected_questions'];?>
</div>
                                            <div class="reportdetail_qustionsanswer">
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_questions_founds_for_survey'];?>

                                <?php }?>
                            </div>
                        </div>
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
    
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/surveys/jquery.jscrollpane.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        $(".servaqustion_button").hide();    
        $(".customerview_serveylist").click(function(event) {
            if(event.target != "javascript:void(0);"){
                if($(this).parent('.customerview_surveylisting').attr('data-section-name') === 'report_group'){
                    $('#selected').val(1);
                    $(this).parents('.customerview_surveylisting').find(".customerviewserva_listeddetails").slideToggle("slow");
                    $("#quest_custom").hide();
                    $('.reportdetail_groups').data('jsp').reinitialise();
                    $('.reportdetail_groups').jScrollPane();
                    $('.scroll-pane-arrows').jScrollPane({
                                showArrows: true
                    });
                }else{
                    $('#selected').val(2);
                    $(this).parents('.customerview_surveylisting').find(".customerviewserva_listeddetails").slideToggle("slow");
                    $("#groups_custom").hide();
                    $('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
                    $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
                    $('.scroll-pane-arrows').jScrollPane({
                                showArrows: true
                    });
                }
                $('#question_block, .reportdetail_groups').data('jsp').reinitialise();
            }
        });
        $('#question_block, .reportdetail_qustionsanswer, .reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
        
        
        $(".report_questanswerblock .cnt_answerbtn").live('click', function(){
            $(this).parents(".report_questanswerblock").find(".checkbox_answer").toggle();
            $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
        });
        
        $('.quest_check .question_check:checkbox').change(function(){
            var quest_id = $(this).val();
            //console.log(quest_id);
            
            var quest_name = $("#quest_"+quest_id).parents('.report_questblock').find('.quest_cnt').html();
            //var quests = $("#quests_report").val(); //- removed by smsdn
            /*if($(this).prop('checked'))
                $("#quest_"+quest_id).attr('checked', true);
            else
                $("#quest_"+quest_id).attr('checked', false);*/

            /*var selected_quest_var = $( 'input:checkbox:checked.question_check' ).map(function () {
                return this.value;
            }).get();
            console.log(selected_quest_var);
            //var quests = $("#quests_report").val();
            //var selected_quest_var = quests.split(",");
            for(var j=0; j<selected_quest_var.length;j++){
                if(selected_quest_var[j] == quest_id){
                    break;
                }
            }
            console.log(j + '==' + selected_quest_var.length);*/

            //add to list
            if($(this).prop('checked')/*j == selected_quest_var.length*/){

                    //$("#quests_report").val(quests);//- removed by smsdn
                    <?php  $_smarty_tpl->tpl_vars['quest1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quest1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quest1']->key => $_smarty_tpl->tpl_vars['quest1']->value){
$_smarty_tpl->tpl_vars['quest1']->_loop = true;
?>
                        var temp_id = parseInt('<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
');
                        var type = parseInt('<?php echo $_smarty_tpl->tpl_vars['quest1']->value['answer_type'];?>
');
                        if(temp_id == quest_id){
                            var class_div='checkbox_answer';
                            var div_val_temp = '';

                            <?php if (in_array($_smarty_tpl->tpl_vars['quest1']->value['answer_type'],array(1,2,3,6))){?>
                                <?php  $_smarty_tpl->tpl_vars['ans'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ans']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quest1']->value['answers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ans']->key => $_smarty_tpl->tpl_vars['ans']->value){
$_smarty_tpl->tpl_vars['ans']->_loop = true;
?>
                                    div_val_temp += '<div class="answer_row">';
                                    div_val_temp += '<input name="quest_<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['ans']->value['id'];?>
" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['ans']->value['answer_text'];?>
" data-input="<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
">';
                                    div_val_temp += '<?php echo $_smarty_tpl->tpl_vars['ans']->value['answer_text'];?>
</div>';
                                <?php } ?>
                            <?php }?>
                             $('.reportdetail_qustionsanswer .jspPane').append('\
                                <div class="report_questanswerblock clearfix">\
                                    <div class="cnt_questionanswer" '+ (type != 1 && type != 2 && type != 3 && type != 6 ? 'style="width: auto;"' : '')+'>\
                                       <div class="question">'+quest_name+'</div>\
                                       '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                            '<div class="answer">\
                                               <div class="'+class_div+'">'+div_val_temp+'</div>\
                                           </div>' : '')
                                    +'</div>\
                                    <div class="">\
                                        '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                            '<input type="button" name="ans" class="cnt_answerbtn" value="answer" />' : '')
                                        +'<input type="hidden" class="shows" name="shows" value=""/>\n\
                                    </div>\n\
                                    <a href="javascript:void(0)" onclick="removeQuest(\''+quest_id+'\');"></a>\n\
                                    <input type="hidden" id="quest_id_'+quest_id+'"/>\n\
                                </div>');
                        }
                    <?php } ?>
            }
            //remove from list
            else{
                $('#quest_id_'+quest_id).parents('.report_questanswerblock').remove();
                /*$('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
                $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
                $('.scroll-pane-arrows').jScrollPane({
                            showArrows: true
                });*/
            }
            $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
        });
        
        $('.chk_question_ctrl #all_check_questions').click(function () {
            //remove all already selected questions
            if($(this).prop('checked')){
                $('.coustomerreport_selectquestion .report_questanswerblock').remove();
            }
            
            $('#question_block .report_questblock').find('.question_check:checkbox').attr('checked', this.checked).trigger('change');

        });
        
        
    });
    
    function addGroups(group_id,group_name){
        var groups = $("#groups_report").val();
        var selected_group = new Array();
        var selected_group_id = new Array();
        var selected_group_var = groups.split(",");
//        $('.reportdetail_groups input:checked').each(function() {
//            selected_group.push($(this).attr('value'));
//            selected_group_id.push($(this).attr('id'));
//        });
//        for(var i = 0;i < selected_group.length;i++){
//            var temp_group_id = selected_group_id[i].split("_")
//            var group_id = temp_group_id[1];
        for(var j=0; j<selected_group_var.length;j++){
            if(selected_group_var[j] == group_id){
                break;
            }
        }
        if(j == selected_group_var.length){
            if(groups == ""){
                groups = group_id;
            }else{
                groups = groups+","+group_id;
            }
            $("#groups_report").val(groups);
            $('.reportdetail_groupsanswer').append('<div class="report_selectedgroups" style="margin-left:20px">'+group_name+'<a href="javascript:void(0);" onclick="removeGroup('+group_id+')"></a><input type="hidden" name="grp_id" id="grp_id_'+group_id+'" value="'+group_name+'" /></div>');
        }
        $('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
    
    function removeGroup(ids){
         var groups = $("#groups_report").val();
         var groups_array = groups.split(",");
         var temp_group = "";
         for(var i = 0;i < groups_array.length;i++){
            if(groups_array[i] != ids){
                if(temp_group == ""){
                    temp_group = groups_array[i];
                }else{
                    temp_group = temp_group+","+groups_array[i];
                }
            }
         }
         $("#groups_report").val(temp_group);
         $('#grp_id_'+ids).parent().remove();
         $('#group_'+ids).prop("checked",false);
         $('.reportdetail_groups').data('jsp').reinitialise();
        $('.reportdetail_groups').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
    
    function addQuests(quest_id){
    
        return false;
        var quest_name = $("#quest_"+quest_id).parents('.report_questblock').find('.quest_cnt').html();
        //var quests = $("#quests_report").val(); //- removed by smsdn
        
        console.log($("#quest_"+quest_id).attr('checked'));
        if($("#quest_"+quest_id).attr('checked'))
            $("#quest_"+quest_id).attr('checked', true);
        else
            $("#quest_"+quest_id).attr('checked', false);
        
        var selected_quest_var = $( 'input:checkbox:checked.question_check' ).map(function () {
            return this.value;
        }).get();
        //var quests = $("#quests_report").val();
        //var selected_quest_var = quests.split(",");
        for(var j=0; j<selected_quest_var.length;j++){
            if(selected_quest_var[j] == quest_id)
                break;
        }
        console.log(j + '==' + selected_quest_var.length);
        if(j == selected_quest_var.length){
                
                //$("#quests_report").val(quests);//- removed by smsdn
                <?php  $_smarty_tpl->tpl_vars['quest1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quest1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quest1']->key => $_smarty_tpl->tpl_vars['quest1']->value){
$_smarty_tpl->tpl_vars['quest1']->_loop = true;
?>
                    var temp_id = parseInt('<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
');
                    var type = parseInt('<?php echo $_smarty_tpl->tpl_vars['quest1']->value['answer_type'];?>
');
                    if(temp_id == quest_id){
                        var class_div='checkbox_answer';
                        var div_val_temp = '';
                         
                        <?php if (in_array($_smarty_tpl->tpl_vars['quest1']->value['answer_type'],array(1,2,3,6))){?>
                            <?php  $_smarty_tpl->tpl_vars['ans'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ans']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quest1']->value['answers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ans']->key => $_smarty_tpl->tpl_vars['ans']->value){
$_smarty_tpl->tpl_vars['ans']->_loop = true;
?>
                                div_val_temp += '<div class="answer_row">';
                                div_val_temp += '<input name="quest_<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['ans']->value['id'];?>
" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['ans']->value['answer_text'];?>
" data-input="<?php echo $_smarty_tpl->tpl_vars['quest1']->value['id'];?>
">';
                                div_val_temp += '<?php echo $_smarty_tpl->tpl_vars['ans']->value['answer_text'];?>
</div>';
                            <?php } ?>
                        <?php }?>
                         $('.reportdetail_qustionsanswer .jspPane').append('\
                            <div class="report_questanswerblock clearfix">\
                                <div class="cnt_questionanswer" '+ (type != 1 && type != 2 && type != 3 && type != 6 ? 'style="width: auto;"' : '')+'>\
                                   <div class="question">'+quest_name+'</div>\
                                   '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                        '<div class="answer">\
                                           <div class="'+class_div+'">'+div_val_temp+'</div>\
                                       </div>' : '')
                                +'</div>\
                                <div class="">\
                                    '+ (type == 1 || type == 2 || type == 3 || type == 6 ? 
                                        '<input type="button" name="ans" class="cnt_answerbtn" value="answer" />' : '')
                                    +'<input type="hidden" class="shows" name="shows" value=""/>\n\
                                </div>\n\
                                <a href="javascript:void(0)" onclick="removeQuest(\''+quest_id+'\');"></a>\n\
                                <input type="hidden" id="quest_id_'+quest_id+'"/>\n\
                            </div>');
                    }
                <?php } ?>
        }
        $('.reportdetail_qustionsanswer').data('jsp').reinitialise();
    }
    
    function getReport(){
        
        var gender = 3;
        if($("#male_select").attr('checked') && $("#female_select").attr('checked')){
            gender = 3;
        }else{
            if($("#male_select").attr('checked'))
                gender = 1;
            if($("#female_select").attr('checked'))
                gender = 2;
        }
        $("#gender").val(gender);
        var filter_type = $("#selected").val();
        var filter = '';
        if(filter_type == 1){
            var css_div = $('#groups_custom').css('display');
            if(css_div == 'none'){
                $("#selected").val('');
                $("#report_form").submit();
            }else{
            filter = $("#groups_report").val();
            $("#filter").val(filter);
            //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id;
            $("#report_form").submit();
        }
            
        }
        else if(filter_type == 2){
            var css_div = $('#quest_custom').css('display');
            if(css_div == 'none'){
            $("#selected").val('');
                $("#report_form").submit();
            }else{
                var filter = $( 'input:checkbox:checked.question_check' ).map(function () {
                    return this.value;
                }).get().join(',');

                //filter = $("#quests_report").val();
                var selected_quest = new Array();
                var selected_quest_id = new Array();
                var selected_question = new Array();
                $('.reportdetail_qustionsanswer input:checked').each(function() {
                    selected_quest.push($(this).attr('value'));
                    selected_quest_id.push($(this).attr('name'));
                    selected_question.push($(this).attr('data-input'));
                });
                var filter_condition_quest = '';
                var filter_condition_answer = '';
                for(var i=0;i < selected_quest_id.length;i++){
                    if(filter_condition_quest == ""){
                        filter_condition_quest = selected_quest_id[i];
                        filter_condition_answer = selected_quest[i];
                    }else{
                        filter_condition_quest = filter_condition_quest+","+selected_quest_id[i];
                        filter_condition_answer = filter_condition_answer+","+selected_quest[i];
                    }
                    if(selected_question[i] != selected_question[i+1] && i+1 != selected_quest_id.length)
                       filter_condition_answer = filter_condition_answer+"-"; 
                }
                $("#ans").val(filter_condition_answer);

                $("#filter").val(filter);
                 $("#report_form").submit();
    //            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id+"&quest_ans="+filter_condition_quest+"&ans="+filter_condition_answer;
            }
        }else{
            $("#report_form").submit();
//            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
S_custom_final_report.php?age_from="+age_from+"&age_to="+age_to+"&gender="+gender+"&filter_type="+filter_type+"&filter="+filter+"&survey_id="+survey_id;
        }
    }
    
    function removeQuest(ids){
        ids = parseInt(ids);
        /*var quests = $("#quests_report").val();
        var quests_array = quests.split(",");
        var temp_quests = "";
        for(var i = 0;i < quests_array.length;i++){
           if(quests_array[i] != ids){
               if(temp_quests == ""){
                   temp_quests = quests_array[i];
               }else{
                   temp_quests = temp_quests+","+quests_array[i];
               }
           }
        }
        $("#quests_report").val(temp_quests);*/
        $('#quest_id_'+ids).parent().remove();
        $('#quest_'+ids).prop("checked",false);
        $('#question_block, .reportdetail_qustionsanswer').data('jsp').reinitialise();
        $('#question_block, .reportdetail_qustionsanswer').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                    showArrows: true
        });
    }
</script>

    </body>
</html><?php }} ?>