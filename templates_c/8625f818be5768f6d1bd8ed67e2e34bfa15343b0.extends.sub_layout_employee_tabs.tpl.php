<?php /* Smarty version Smarty-3.1.8, created on 2021-03-23 11:50:39
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/sub_layout_employee_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11090331676033932b6fcb94-35738886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8625f818be5768f6d1bd8ed67e2e34bfa15343b0' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/sub_layout_employee_tabs.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
    'a51fe7d4fa7926f295c3beed968c5cf1943172c3' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/employee_add.tpl',
      1 => 1616499600,
      2 => 'file',
    ),
    '155ef44d21124b6a12721a0ce0a1b854e2116a35' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/dashboard.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11090331676033932b6fcb94-35738886',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6033932bf3d080_63222604',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6033932bf3d080_63222604')) {function content_6033932bf3d080_63222604($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
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
        
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/color-wheel.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->

    <style type="text/css">
        .underline_link { text-decoration: underline;}
        .btn-help{
                    margin: 5px;
                    cursor: pointer;}
        /* */
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
                                
<!--   -->
<?php if ($_smarty_tpl->tpl_vars['access_flag']->value==1){?>
<div id="dialog-confirm" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none; padding-top: 20px;padding-left: 13px;">
    <p><span class="error_msg_icon" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>
</div>
<div id="dialog-confirm_delete" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
</p>
</div>
<div class="clearfix" id="dialog_popup" style="display:none;"></div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
<div class="row-fluid">
    <div class="span12 main-left">
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div class="widget-header span12">
                <div class="span6">
                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                </div>
                
                <div class="span6">
                    <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft btn-help" onclick="showHelp(this);"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_checklist'];?>
</a>
                </div>
                
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
            <div class="widget option-panel-widget" style="margin: 0 !important;">
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
 : </strong><?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['social_security'];?>
<?php }?></div>
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
 : </strong><?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['code'];?>
<?php }?></div>
                        <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 : </strong><?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name']);?>
<?php }?></div>
                        <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                        <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 : </strong><?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name']);?>
<?php }?></div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="tab-content-switch-con <?php if ($_smarty_tpl->tpl_vars['employee_username']->value==''){?>no-mt<?php }?>" >
                        <div class="span12">
                            <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                                
    <div style="display: none;" class="scroller scroller-left"><span class="icon-chevron-left"></span></div>
    <div style="display: block;" class="scroller scroller-right"><span class="icon-chevron-right"></span></div>
    <div class="wrapper no-margin">
        <ul class="nav nav-tabs list" role="tablist" id="myTab" style="left: 0px;">
            <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value!=3&&$_smarty_tpl->tpl_vars['user_roles_login']->value!=4){?><li role="presentation" <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_add'){?>class="active"<?php }?>><a href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/%%C-UNAME%%/')" aria-controls="1" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_contract']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_contract_pdf'){?>class="active"<?php }?> role="presentation"><a aria-controls="2" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_salary']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_list_salary'){?>class="active"<?php }?> role="presentation"><a aria-controls="3e" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_notification']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_notification'){?>class="active"<?php }?> role="presentation"><a aria-controls="4" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/notification/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_notification'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_privileges']==1&&$_smarty_tpl->tpl_vars['employee_role']->value!=1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_privileges'){?>class="active"<?php }?> role="presentation"><a aria-controls="5" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_previlege'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_cv']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_skills'){?>class="active"<?php }?> role="presentation"><a aria-controls="6" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/skills/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skills'];?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_documentation']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_documentations'){?>class="active"<?php }?> role="presentation"><a aria-controls="7" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/documentations/%%C-UNAME%%/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</a></li><?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_preference']==1){?><li <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabmenu']=='employee_non_prefered_timing'){?>class="active"<?php }?> role="presentation"><a aria-controls="8" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/non-prefered/timing/%%C-UNAME%%/1/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_non_preferred_time'];?>
</a></li><?php }?>
        </ul>
    </div>

                            <?php }?>
                            <div class="widget-header widget-header-options tab-option">
                                <div class="span4 day-slot-wrpr-header-left span3">
                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                    <button id = "btn_save" class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?>disabled="disabled"<?php }?>><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button"><span class="icon-pencil"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_edit_employee_personal'];?>
</button><?php }?>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                    <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm()"><span class="icon-print"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['add_employee']){?><button class="btn btn-default btn-normal pull-right" type="button" onclick="addNewForm()"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_employee'];?>
</button><?php }?>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content-con">
                        <div class="tab-content span12 no-padding" style="margin:0;">
                            <div role="tabpanel" class="tab-pane active" id="tab-1">
                                <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                                <form id="formPrint" name="formPrint" method="post" target="blank">
                                    <input type="hidden" name="action" id="action" value="print" />
                                    <input type="hidden" name="print_user" id="print_user" value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
<?php }?>" />
                                </form>
                                <?php }?>
                                <form id="form" name="form" method="post" action="" style="float: left;">
                                    
                                    <input type="hidden" name="rand_pass" id="rand_pass"  value="<?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
" />
                                    <input type="hidden" name="team" id="team"  value="<?php if (isset($_smarty_tpl->tpl_vars['current_team']->value[0])&&isset($_smarty_tpl->tpl_vars['current_team']->value[0]['id'])){?><?php echo $_smarty_tpl->tpl_vars['current_team']->value[0]['id'];?>
<?php }?>" />
                                    <input type="hidden" name="cur_team" id="cur_team" value="<?php if (isset($_smarty_tpl->tpl_vars['current_team']->value[0])&&isset($_smarty_tpl->tpl_vars['current_team']->value[0]['id'])){?><?php echo $_smarty_tpl->tpl_vars['current_team']->value[0]['id'];?>
<?php }?>" />
                                    <input type="hidden" name="user_id" id="user_id" value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
<?php }?>" />
                                    <input type="hidden" name="cur_role" id="cur_role" value="<?php echo $_smarty_tpl->tpl_vars['employee_role']->value;?>
" />
                                    <input type="hidden" name="global_check" id="global_check" value="0" />
                                    <input type="hidden" name="not_assign" id="not_assign" value="<?php echo $_smarty_tpl->tpl_vars['not_assign']->value;?>
" />
                                    <input type="hidden" name="assign" id="assign" value="<?php echo $_smarty_tpl->tpl_vars['assign']->value;?>
" />
                                    <input type="hidden" name="assign_emp" id="assign_emp" value="<?php echo $_smarty_tpl->tpl_vars['assign_emp']->value;?>
" />
                                    <input type="hidden" name="add_cust" id="add_cust" value="" />
                                    <input type="hidden" name="remove_cust" id="remove_cust" value="" />
                                    <input type="hidden" name="cust_username_team" id="cust_username_team" value="" />
                                    <input type="hidden" name="emp_username_team" id="emp_username_team" value="" />
                                    <input type="hidden" name="action_change" id="action_change" value="" />
                                    <input type="hidden" name="new" id="new" value="" />
                                    <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                    <input type="hidden" name="role_val" id="role_val" value="" />
                                    <input type="hidden" name="role_change" id="role_change" value="" />
                                    <div class="tab-content span12 no-padding" style="margin:0;">
                                        <!--////////////////////////////////////////TAB 1 BEGIN///////////////////////////////////////////////-->
                                        <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                                                <div id="error_error" style="color: white;"></div>
                                                <div id="error_pass" style="color: white;"></div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <div class="span6">
                                                        <!--PERSONAL INFORMATION BEGIN-->
                                                        <div class="span12">
                                                            <div class="widget" style="margin-top:0;">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_information'];?>
</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN-->
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span6 form-left">
                                                                        <label style="float: left;" class="span12" for="social_security"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
*</label>
                                                                        <div style="margin-left: 0px; float: left;">
                                                                            <div class="input-prepend span12 date-list">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span3" name="century" id="century">
                                                                                    <option value="19" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['century']==19){?> selected="selected" <?php }?> >19</option>
                                                                                    <option value="20" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['century']==20){?> selected="selected" <?php }?> >20</option>
                                                                                </select>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['social_security'];?>
<?php }?>" class="form-control span8" name="social_security" id="social_security" type="text" maxlength="11" onchange="makeChange()" style="margin-left: 2px;" required="true" />
                                                                                <input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['social_security_check']->value){?>1<?php }?>" id="social_flag" name="social_flag">
                                                                            </div>
                                                                            <div id="soc_sec" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="first_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name'];?>
<?php }?>" class="form-control span11" name="first_name" id="first_name" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="last_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name'];?>
<?php }?>" class="form-control span11" name="last_name" id="last_name" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="gender"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
</label>
                                                                            <ol class="radio-group">
                                                                                <li> <input  type="radio" name="gender" id="gender_male" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['gender']==1){?>checked="checked"<?php }?> value="1" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
</label> </li>
                                                                                <li>  <input type="radio" name="gender" id="gender_female" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['gender']==2){?>checked="checked"<?php }?> value="2" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
</label> </li>
                                                                            </ol>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="code"><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?> value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['code'];?>
"<?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['emp_code']->value;?>
"<?php }?> class="form-control span11" name="code" id="code" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['address'];?>
<?php }?>" class="form-control span11" name="address" id="address" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 32px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="care_of"><?php echo $_smarty_tpl->tpl_vars['translate']->value['care_off'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['care_of'];?>
<?php }?>" class="form-control span11" id="care_of" name="care_of" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="span6 form-right">
                                                                        <div class="span12">
                                                                            <label style="float: left;" class="span12" for="post"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['post'];?>
<?php }?>" class="form-control span11" id="post" name="post" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['city'];?>
<?php }?>" class="form-control span11" id="city" name="city" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['phone'];?>
<?php }?>" class="form-control span11" id="phone" name="phone" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px 0;" class="span12">
                                                                            <label style="float: left;" class="span12" for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['mobile'];?>
<?php }?>" class="form-control span11" id="mobile" name="mobile" maxlength="17" type="text" onchange="makeChange()" />
                                                                                <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                                                            </div>
                                                                            <div id="mobs" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['email'];?>
<?php }?>" class="form-control span11" id="email" name="email" type="email" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 3px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['date'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['today']->value;?>
<?php }?>" class="form-control span11" id="date" name="date" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin:15px 0 0 0;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date_inactive"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_inactive'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['date_inactive'];?>
<?php }?>" class="form-control span11" id="date_inactive" name="date_inactive" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--PERSONAL INFORMATION END-->
                                                        
                                                        <div class="span12" style="margin:-11px 0 0 0;">
                                                            <div class="clearfix list_kunder list_customer" id="list_kunder" >
                                                                <div class="widget" style="margin-top:0;">
                                                                    <div class="widget-header span12">
                                                                        <div class="span6">
                                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['relax_customer_to_assistant'];?>
</h1>
                                                                        </div>
                                                                        <div class="span6" style="padding-top: 10px;">
                                                                            <span style="float:right; padding-right: 4px;"><input type="checkbox" name="office_personal" id="office_personal" value="1" <?php if ($_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['office_personal']==1){?>checked="checked"<?php }?>></span>
                                                                            <span style="float:right; padding-right: 4px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['office_personal'];?>
</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span12 widget-body-section input-group" >
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1||$_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                        <div class="span6" style="margin-top:-10px">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_customers'];?>
</h1>
                                                                                </div>
                                                                                <div class="div-height-fix" style="height: 270px;">
                                                                                    <div id="nwoekers_list">
                                                                                        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['to_assign']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                                                        <div id="a<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" class="span12 nwoekers_list_entry child-slots-profile" data-username="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
">
                                                                                            <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1||$_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                                            <a href="javascript:void(0);" class="assign_link" onclick="assignCustomer('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
', this);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['assign_customer'];?>
"><i class="glyphicons icon-plus pull-right remove-child-slots cursor_hand"></i></a>
                                                                                            <?php }?>
                                                                                            <span>
                                                                                                <span class="cursor_hand underline_link emp_name assign_link" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/EMP_ADD/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
<?php }?></span>
                                                                                                <span class="pull-right emp_code"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
                                                                                                <span class="emp_role" data-old-role-val="3"></span>
                                                                                            </span>
                                                                                        </div>
                                                                                        <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
                                                                                        <div id="no_data" class="span12 message no_emp_msg" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php }?>
                                                                        <div class="span6" style="margin-top:-10px">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['attached_customers'];?>
</h1>
                                                                                </div>
                                                                                <div class="div-height-fix" style="height: 270px;">
                                                                                    <div id="tosave_workers">
                                                                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                                                                        <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['assigned']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['i']->value==0&&$_smarty_tpl->tpl_vars['customer']->value['username']==''){?>
                                                                                        <div id="no_data" class="span12 message no_emp_msg"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                                                        <?php break 1?>
                                                                                        <?php }?>
                                                                                        <div id="a<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
" class="span12 child-slots-profile-two attached_emp_entry" data-username="<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
">
                                                                                            <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1||$_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                                            <a href="javascript:void(0);" class="assign_link" onclick="removeCustomer('<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
', this);" style="float: right;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_customer'];?>
"><span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"></span></a>
                                                                                            <?php }?>
                                                                                            <span>
                                                                                                <span class="cursor_hand underline_link emp_name_exact" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/EMP_ADD/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
<?php }?></span>
                                                                                                <span class="pull-right emp_code"><?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
</span>
                                                                                            </span>
                                                                                            <span class="slots-position pull-right emp_role_name">
                                                                                                <?php if ($_smarty_tpl->tpl_vars['customer']->value['role']==3){?>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['user_roles']->value==2){?>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1||$_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                                                <a href="javascript:void(0);" class="maket2 assign_link" onclick="makeTl('<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
','<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
', this);"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_team_leader'];?>
</a><?php }?>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['user_roles']->value==7){?>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1||$_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                                                <a href="javascript:void(0);" class="maket2 assign_link" onclick="makeSTl('<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
','<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
', this);"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_super_team_leader'];?>
</a><?php }?>
                                                                                                <?php }else{ ?>
                                                                                                <span class="tl"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</span>
                                                                                                <?php }?>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['role']==7){?><span class="tl"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['role']==2){?><span class="tl"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</span>
                                                                                                <?php }?>
                                                                                            </span>
                                                                                            <input type="hidden" name="team_cust_uname[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
" />
                                                                                            <input type="hidden" name="team_cust_role[]" class="emp_role_val" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['role'];?>
" />
                                                                                        </div>
                                                                                        <?php }
if (!$_smarty_tpl->tpl_vars['customer']->_loop) {
?>
                                                                                        <div id="no_data" class="span12 message no_emp_msg" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6">
                                                        <div class="widget" style="margin-top:0; margin-bottom: 12px !important;">
                                                            <div class="widget-header span12">
                                                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['color_code'];?>
</h1>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <input id="color_code" name="color_code" value="<?php echo $_smarty_tpl->tpl_vars['color_code']->value;?>
" class="sp-replacer sp-light full-spectrum" type="hidden" />
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:2px 0 0 0;">
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['account_information'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div style="margin: 0 0 10px 0 !important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
" class="form-control span11" id="username" name="username" readonly="readonly" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <div id="pass"><button type="button" onclick="generate_password()" id="password" name="password" class="btn btn-default btn-normal" onchange="makeChange()" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
</button></div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: -4px 0 0 0" class="span12">
                                                                            <label style="float: left;" class="span12" for="status"><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</label>
                                                                            <ol class="radio-group">
                                                                                <li>
                                                                                    <input  type="radio"  name="status" id="status" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['status']=='1'){?>checked="checked"<?php }else{ ?> checked="checked" <?php }?> value="1" onclick="giveActivation()" />
                                                                                    <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
</label>
                                                                                </li>
                                                                                <li>  
                                                                                    <input  type="radio" name="status"  id="status"  <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['status']=='0'){?>checked="checked" <?php }?> value="0" onclick="giveDeactivation()" />
                                                                                    <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inactive'];?>
</label>
                                                                                </li>
                                                                            </ol>
                                                                        </div>
                                                                        
                                                                        <div style="margin:14px 0 0 0 !important" class="span12">
                                                                            <label style="float: left;" class="span12" for="role"><?php echo $_smarty_tpl->tpl_vars['translate']->value['role'];?>
</label>
                                                                            <div style="margin: 0px; float: left;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value==1){?>
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_role'];?>
</option>
                                                                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='1'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</option>
                                                                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option>
                                                                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='6'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</option>
                                                                                    <option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option>
                                                                                </select>
                                                                                <?php }elseif($_smarty_tpl->tpl_vars['user_roles_login']->value==2){?>
                                                                                <select <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1||$_smarty_tpl->tpl_vars['selected_employee_role']->value==7){?> disabled <?php }?> class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_role'];?>
</option>
                                                                                    <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1){?><option value="1" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='1'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</option><?php }?>
                                                                                    <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==7){?><option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option><?php }?>
                                                                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option>
                                                                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='6'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</option>
                                                                                </select>
                                                                                <?php }elseif($_smarty_tpl->tpl_vars['user_roles_login']->value==3){?>
                                                                                <select  <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1||$_smarty_tpl->tpl_vars['selected_employee_role']->value==7||$_smarty_tpl->tpl_vars['selected_employee_role']->value==2){?> disabled <?php }?> class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_role'];?>
</option>
                                                                                    <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1){?><option value="1" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='1'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</option><?php }?>
                                                                                    <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==7){?><option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option><?php }?>
                                                                                    <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==2){?><option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option><?php }?>
                                                                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                </select>
                                                                                <?php }elseif($_smarty_tpl->tpl_vars['user_roles_login']->value==6){?>
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option>
                                                                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='6'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</option>
                                                                                    <option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option>
                                                                                </select>
                                                                                <?php }elseif($_smarty_tpl->tpl_vars['user_roles_login']->value==7){?>
                                                                                    <select <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1){?> disabled <?php }?> class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_role'];?>
</option>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['selected_employee_role']->value==1){?><option value="1" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='1'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</option><?php }?>
                                                                                        <option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option>
                                                                                        <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                        <option value="6" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='6'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</option>
                                                                                        <option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option>
                                                                                    </select>
                                                                                <?php }else{ ?>
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()" onclick="alert('Cannot Change ');" disabled="TRUE">
                                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_role'];?>
</option>
                                                                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='1'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</option>
                                                                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='2'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
</option>
                                                                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='3'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</option>
                                                                                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='6'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</option>
                                                                                    <option value="7" <?php if ($_smarty_tpl->tpl_vars['employee_role']->value=='7'){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</option>
                                                                                </select>
                                                                                <?php }?>
                                                                            </div>
                                                                            <div id="role_error" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 39px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="substitute">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['substitute']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['substitute']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['substitute'];?>
" id="substitute_fn" name="substitute">
                                                                            </div>
                                                                        </div>
                                                                        <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['inconvenient_on']==1){?>
                                                                            <div style="margin: 10px 0px 29px 0px !important;" class="span6">
                                                                                <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['use_inconvenient'];?>
</label>
                                                                                <div class="btn-group btn-toggle" style="float: left;" purpose="inconvenient_on">
                                                                                    <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on']==0&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on']!=''){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                    <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on']==1||$_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on']==''){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                    <input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on']==''){?>1<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['inconvenient_on'];?>
<?php }?>" id="chk_inconvenient_on" name="chk_inconvenient_on"/>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                         <div  class="span6" style="float: none;">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['candg_follow'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="candg_follow">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['candg_follow']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['candg_follow']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['candg_follow'];?>
" id="candg_follow" name="candg_follow">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['other_employee_information'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div class="" style="margin: 0px;">
                                                                            <label style="float: left; " class="span12" for="max_hours"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_max_hours'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['max_hours']>0){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['max_hours'];?>
<?php }?>" maxlength="5" class="form-control span11" name="max_hours" id="max_hours"  type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <span style="float: left; margin: -10px 0 0 0;" class="input-tips">(<?php echo $_smarty_tpl->tpl_vars['translate']->value['max_15_hours'];?>
)</span>
                                                                        <div style="margin: 10px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="remaining_sem_leave"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remaining_sem_leave'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['remaining_sem_leave'];?>
" maxlength="17" class="form-control span11"  id="remaining_sem_leave" name="remaining_sem_leave" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="sem_leave_todate"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sem_leave_todate'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['sem_leave_todate']!='0000-00-00'){?>value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['sem_leave_todate'];?>
"<?php }else{ ?>value=""<?php }?> class="form-control span11" id="sem_leave_todate" name="sem_leave_todate" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;margin-right: 7px;" for="leave_in_advance"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_in_advance'];?>
</label>
                                                                            <input type="checkbox" value="1" id="leave_in_advance" name="leave_in_advance" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['leave_in_advance']==1){?>checked="checked"<?php }?> style="width: auto;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tooltip_leave_in_advance_employee'];?>
" />
                                                                        </div>
                                                                        
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="txt_ice"><?php echo $_smarty_tpl->tpl_vars['translate']->value['ice'];?>
</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <textarea class="form-control span12" id="txt_ice" name="txt_ice"><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['ice'];?>
</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:12px 0 0 0;">
                                                            <div style="margin: 0px 0 15px 0 ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['working_hours_calculation'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div class="span6 widget-body-section input-group" >
                                                                            <div class="span12">
                                                                            <label style="float: left;" class="span12" for="contract_start_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract_start_month'];?>
</label>
                                                                            <div class="input-prepend span7" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span10" id="contract_start_month" name="contract_start_month">
                                                                                    <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                                    <option value="01" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==1){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['january'];?>
</option>
                                                                                    <option value="02" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==2){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['february'];?>
</option>
                                                                                    <option value="03" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==3){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['march'];?>
</option>
                                                                                    <option value="04" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==4){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['april'];?>
</option>
                                                                                    <option value="05" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==5){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==6){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['june'];?>
</option>
                                                                                    <option value="07" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==7){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['july'];?>
</option>
                                                                                    <option value="08" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==8){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['august'];?>
</option>
                                                                                    <option value="09" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==9){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['september'];?>
</option>
                                                                                    <option value="10" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==10){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['october'];?>
</option>
                                                                                    <option value="11" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==11){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['november'];?>
</option>
                                                                                    <option value="12" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_start_month']==12){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['december'];?>
</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="input-prepend span5" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span10" id="contract_month_start_date" name="contract_month_start_date">
                                                                                    <?php $_smarty_tpl->tpl_vars['month_date'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['month_date']->step = 1;$_smarty_tpl->tpl_vars['month_date']->total = (int)ceil(($_smarty_tpl->tpl_vars['month_date']->step > 0 ? 31+1 - (1) : 1-(31)+1)/abs($_smarty_tpl->tpl_vars['month_date']->step));
if ($_smarty_tpl->tpl_vars['month_date']->total > 0){
for ($_smarty_tpl->tpl_vars['month_date']->value = 1, $_smarty_tpl->tpl_vars['month_date']->iteration = 1;$_smarty_tpl->tpl_vars['month_date']->iteration <= $_smarty_tpl->tpl_vars['month_date']->total;$_smarty_tpl->tpl_vars['month_date']->value += $_smarty_tpl->tpl_vars['month_date']->step, $_smarty_tpl->tpl_vars['month_date']->iteration++){
$_smarty_tpl->tpl_vars['month_date']->first = $_smarty_tpl->tpl_vars['month_date']->iteration == 1;$_smarty_tpl->tpl_vars['month_date']->last = $_smarty_tpl->tpl_vars['month_date']->iteration == $_smarty_tpl->tpl_vars['month_date']->total;?>
                                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['month_date']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_date']==$_smarty_tpl->tpl_vars['month_date']->value){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['month_date']->value;?>
</option>
                                                                                    <?php }} ?>
                                                                                </select>
                                                                            </div>
                                                                            </div>
                                                                            <div class="span12" style="margin:10px 0 0 0;"> 
                                                                                <label style="float: left;" class="span12" for="emp_contract_period_length"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract_period_length'];?>
</label>
                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span11" id="emp_contract_period_length" name="emp_contract_period_length">
                                                                                    <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                                    <option value="01" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==1){?> selected = "selected" <?php }?>>1</option>
                                                                                    <option value="02" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==2){?> selected = "selected" <?php }?>>2</option>
                                                                                    <option value="03" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==3){?> selected = "selected" <?php }?>>3</option>
                                                                                    <option value="04" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==4){?> selected = "selected" <?php }?>>4</option>
                                                                                    <option value="04" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==5){?> selected = "selected" <?php }?>>5</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==6){?> selected = "selected" <?php }?>>6</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==7){?> selected = "selected" <?php }?>>7</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==8){?> selected = "selected" <?php }?>>8</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==9){?> selected = "selected" <?php }?>>9</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==10){?> selected = "selected" <?php }?>>10</option>
                                                                                    <option value="06" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==11){?> selected = "selected" <?php }?>>11</option>
                                                                                    <option value="12" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['employee_contract_period_length']==12){?> selected = "selected" <?php }?>>12</option>
                                                                                </select>
                                                                            </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="span6 pull-right widget-body-section input-group">
                                                                            <div class="span12">
                                                                                <label style="float: left;" class="span12" for="start_day"><?php echo $_smarty_tpl->tpl_vars['translate']->value['start_day'];?>
</label>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                    <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12" onchange="makeChange()" name="start_day" id="start_day">
                                                                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==1){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['monday'];?>
</option>
                                                                                        <option value="2" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==2){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday'];?>
</option>
                                                                                        <option value="3" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==3){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday'];?>
</option>
                                                                                        <option value="4" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==4){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday'];?>
</option>
                                                                                        <option value="5" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==5){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['friday'];?>
</option>
                                                                                        <option value="6" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==6){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday'];?>
</option>
                                                                                        <option value="7" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==7){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday'];?>
</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin:  10px 0 0 0;" class="span12">
                                                                                <label style="float: left;" class="span12" for="start_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['start_time'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-time"></span>
                                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['vals']->value[1];?>
" class="form-control span11" id="start_time" name="start_time" type="text" onchange="makeChange()" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:0;">
                                                            <div class="span6">
                                                                <div class="span12 widget-header" style="margin-left: 0px;">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['export_information'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['SEM_in_days'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="sem_leave_days">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['sem_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['sem_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['sem_leave_days'];?>
" id="sem_leave_days" name="sem_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['VAB_in_days'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="vab_leave_days">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['vab_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['vab_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['vab_leave_days'];?>
" id="vab_leave_days" name="vab_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['FP_in_days'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="fp_leave_days">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['fp_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['fp_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['fp_leave_days'];?>
" id="fp_leave_days" name="fp_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['NOPAY_in_days'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="nopay_leave_days">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['nopay_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['nopay_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['nopay_leave_days'];?>
" id="nopay_leave_days" name="nopay_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 8px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['OTHER_in_days'];?>
</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="other_leave_days">
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['other_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                                                                <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['other_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                                                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['other_leave_days'];?>
" id="other_leave_days" name="other_leave_days">
                                                                            </div>
                                                                        </div>

                                                                         

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_type'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <ol class="radio-group">
                                                                            <li style="margin-right: 0px; float: none;"><input  type="radio" name="salary_type"  value="1" checked="checked" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_hour_saving_holiday'];?>
</label></li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px; float: none;"><input  type="radio" name="salary_type" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==2||($_smarty_tpl->tpl_vars['employee_username']->value==''&&$_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==''&&$_smarty_tpl->tpl_vars['company_id']->value==8)){?>checked="checked"<?php }?> value="2" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_hour_paid_vacation'];?>
</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==3){?>checked="checked"<?php }?> value="3"  />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_monthly'];?>
</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==4){?>checked="checked"<?php }?> value="4" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_monthly_office'];?>
</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==5){?>checked="checked"<?php }?> value="5" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_hour_office'];?>
</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['salary_type']==6){?>checked="checked"<?php }?> value="6" />
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_salary_type_6'];?>
</label> </li>
                                                                        </ol>
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
                            <div class="message fail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>
</div>
                        <?php }?>
                    </div>
                </form>
            </div>
        </div>
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
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/nice-scroll.js"></script>  
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/color-wheel.js"></script>
 <!--   -->
<script type="text/javascript">
     $( ".inner" ).draggable();

        window.onload = function() {
            if('<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
' == '')
                showHelp();
        };
    $( function() {
        // window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_checklist.php',' ','width=1000,height=600,top=50,left=200');
            $( ".main-list" ).sortable();
            $( ".main-list" ).disableSelection();
          } );
    var after_sort_id     = [];
        $( ".main-list" ).sortable({
            // change: function(e, ui) {
            //     before_sort_order = [];
            //     $("#checklist_list li").not('.additem-list').each(function( index ) {

            //       if($(this).data('sortable') != undefined){
            //          before_sort_order.push($(this).data('sortable'));
            //       }
            //     });
            // },
            update: function( event, ui ) {
                after_sort_id     = [];
                 $("#checklist_list li").not('.additem-list').each(function( index ) {
                  after_sort_id.push($(this).data('id'));
                });
                // console.log(before_sort_order,after_sort_id); 
                dataObj = {
                    // before_sort_order : before_sort_order,
                    after_sort_id     : after_sort_id,
                    action            : 'changing_sort_order'
                }
                $.ajax({
                    method  : 'post',
                    url     : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_checklist.php',
                    data    : dataObj,
                    success : function(data){
                        data = JSON.parse(data);
                        // console.log(data);
                        // for (var key in data) {
                        //     $('#cheklist_'+key).attr('data-sortable',data[key]);
                        // }

                    }
                });
            // console.log(ui.item.index());
            // var oldIndex = ui.item.sortable.index;
            // var newIndex = ui.item.index();
            // console.log(oldIndex,newIndex);
          }
        });
    $("#color_code").spectrum({
       color: "<?php echo $_smarty_tpl->tpl_vars['color_code']->value;?>
",
       showInput: true,
        className: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        maxPaletteSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.demo",
        cancelText: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_colorbox'];?>
",
        chooseText: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['choose'];?>
",
        move: function (color) {

        },
        show: function () {

        },
        beforeShow: function () {

        },
        hide: function () {

        },
        change: function () {

        },
        palette: [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
                "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
                "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
                "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
                "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
                "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
                "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
                "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
                "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
                "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
                "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
                "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
        ]
    });

    $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-primary').size() > 0) {
                $(this).find('.btn').toggleClass('btn-primary');

                if ($(this).find('.btn-primary').val() == "ON") {
                    
                    if ($(this).attr("purpose") == "substitute") {
                        $('#substitute_fn').val(1);
                    }
                    else if ($(this).attr("purpose") == "inconvenient_on") {
                        $('#chk_inconvenient_on').val(1);
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "candg_follow") {
                        $('#candg_follow').val(1);
                    }
                }
                else if ($(this).find('.btn-primary').val() == "OFF") {
                    if ($(this).attr("purpose") == "substitute") {
                        $('#substitute_fn').val(0);
                    }
                    else if ($(this).attr("purpose") == "inconvenient_on") {
                        $('#chk_inconvenient_on').val(0);
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "candg_follow") {
                        $('#candg_follow').val(0);
                    }
                }
            }
            if ($(this).find('.btn-danger').size() > 0) {
                $(this).find('.btn').toggleClass('btn-danger');
            }
            if ($(this).find('.btn-success').size() > 0) {
                $(this).find('.btn').toggleClass('btn-success');
            }
            if ($(this).find('.btn-info').size() > 0) {
                $(this).find('.btn').toggleClass('btn-info');
            }
            $(this).find('.btn').toggleClass('btn-default');

        });

    /*function assignCustomer(username) {
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_list.php",
            type:"GET",
            data:"listtype=allocate&customers="+username+"&username=<?php echo $_smarty_tpl->tpl_vars['users_in']->value;?>
",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
    }
         
    function removeCustomer(username) {
      
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_list.php",
            type:"GET",
            data:"listtype=del&customers="+username+"&username=<?php echo $_smarty_tpl->tpl_vars['users_in']->value;?>
",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
        
    }
    */

    function showHelp(e){
        console.log('<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
');
        
            window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/checklist/',' ','width=800,height=600,top=50,left=200');
        // $('.help').removeClass('hide');
    }

    function assignCustomer(username, this_obj) {

        var main_reference = $(this_obj).parents('.nwoekers_list_entry');
        
        var cust_uname = main_reference.attr('data-username');
        var cust_name = main_reference.find('.emp_name').html();
        var cust_role_old = $.trim(main_reference.find('.emp_role').attr('data-old-role-val'));
        var cust_code = main_reference.find('.emp_code').html();
        
        if($('#tosave_workers').find('.no_emp_msg').length > 0){
            $('#tosave_workers').find('.no_emp_msg').remove();
        }
        var role_label = '';
        switch(cust_role_old){
            case '2' : role_label = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
'; break;
            case '7' : role_label = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
'; break;
            default : role_label = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
'; 
        }
        $('#tosave_workers').append('<div id="'+cust_uname+'"  class="span12 child-slots-profile-two attached_emp_entry" data-username="'+cust_uname+'">\n\
                            <a href="javascript:void(0);" onclick="removeCustomer(\''+cust_uname+'\', this);" style="float: right;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_customer'];?>
"><span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"></span></a>\n\
                            <span>\n\
                                <span class="cursor_hand underline_link emp_name_exact" onclick="navigatePage(\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/'+cust_uname+'/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/EMP_ADD/\',1);">'+cust_name+'</span>\n\
                                <span class="pull-right emp_code">'+cust_code+'</span>\n\
                            </span>\n\
                            <span class="slots-position pull-right emp_role_name">\n\
                                <span class="tl">'+role_label+'</span>\n\
                            </span> \n\
                            <input type="hidden" name="team_cust_uname[]" value="'+cust_uname+'" />\n\
                            <input type="hidden" name="team_cust_role[]" class="emp_role_val" value="'+cust_role_old+'" />\n\
                        </div>');
        main_reference.remove();
        if($('#nwoekers_list').find('.nwoekers_list_entry').length == 0){
            $('#nwoekers_list').html('<div id="no_data" class="span12 message no_emp_msg" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>');
        }
    }


    function removeCustomer(username, this_obj) {
        var main_reference = $(this_obj).parents('.attached_emp_entry');
        
        var cust_uname = main_reference.attr('data-username');
        var cust_name = main_reference.find('.emp_name_exact').html();
        var cust_role_val = $.trim(main_reference.find('.emp_role_val').val());
        var cust_code = main_reference.find('.emp_code').html();
        
        if($('#nwoekers_list').find('.no_emp_msg').length > 0){
            $('#nwoekers_list').find('.no_emp_msg').remove();
        }
        $('#nwoekers_list').append('<div id="a'+cust_uname+'" class="span12 nwoekers_list_entry child-slots-profile" data-username="'+cust_uname+'">\n\
                            <a href="javascript:void(0);" onclick="assignCustomer(\''+cust_uname+'\', this);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['assign_customer'];?>
"><i class="glyphicons icon-plus pull-right remove-child-slots cursor_hand"></i></a>\n\
                            <span>\n\
                                <span class="cursor_hand underline_link emp_name" onclick="navigatePage(\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/'+cust_uname+'/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/EMP_ADD/\',1);">'+cust_name+'</span>\n\
                                <span class="pull-right emp_code">'+cust_code+'</span>\n\
                                <span class="emp_role" data-old-role-val="'+cust_role_val+'"></span>\n\
                            </span>\n\
                        </div>');
                
        main_reference.remove();
        if($('#tosave_workers').find('.attached_emp_entry').length == 0){
            $('#tosave_workers').html('<div id="no_data" class="span12 message no_emp_msg" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>');
        }
    }

    function loadNotAllocatedCustomers() { 
        var key = $('#searchkey').val();
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_list.php",
            type:"GET",
            data:"listtype=toadd&searchkey="+key+"&username=<?php echo $_smarty_tpl->tpl_vars['users_in']->value;?>
",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
        //$("#list_kunder").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_list.php?listtype=toadd&searchkey="+key+"&username=<?php echo $_smarty_tpl->tpl_vars['users_in']->value;?>
");
    }

    //save form
    function saveForm(){
        
        var error = 0;
        var errors = 0;
        var email_check = $('#email').val();
        var proceed;
        if(email_check == ''){
            proceed = true;
        }
        else{
            if(!validate_email(email_check)){
                $('#email').addClass('error');
                proceed = false;
            }
            else{
                $('#email').removeClass('error');
                proceed = true;
            }
        }
        if(proceed == true){
            if($("#phone").val() == "0")
                $("#phone").val('');
            if($('#mobile').val() == "+46")
                $("#mobile").val('');
            var social = $('#social_security').val();
            social = social.replace("-", "");
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security.php",
                type:"POST",
                data:"social_security="+social,
                success: function(data){
                    $('#soc_sec').html(data);
                    if(data == "<?php echo $_smarty_tpl->tpl_vars['translate']->value['this_social_security_number_is_wrong'];?>
"){
                        $("#social_security").addClass("error");
                        $('#social_security').focus();
                        $('#social_flag').val(''); 
                    }else{
                        $('#social_flag').val('1'); 
                        $("#social_security").removeClass("error");
                    }
                    if($('#social_flag').val() == ""){
                        $("#social_security").addClass("error");
                        errors =  1;
                    }
                    if($('#social_security').val() == ""){
                        $("#social_security").addClass("error");
                        error =  1;
                    }
                    var error_pass = 0;
                    var error_deact = 0;
                    var error_new = 0;
                    var dates_inactive = $("#date_inactive").val();
                    var dates = $("#date").val();
                    if(dates_inactive != "" | dates_inactive != null){
                        if (dates == dates_inactive){
                            error_deact = 1;
                        }
                    }
                    var pass = $("#password").val();
                    if(pass.length < 8){
                        $("#password").addClass("error");
                        error_pass = 1;
                    }
                
                    var mobiles = $('#mobile').val();
                    mobiles = removeCharas(mobiles);
                    mobiles = trimMobileNumber(mobiles);
                    if(isNaN(mobiles)){
                        $("#mobile").addClass("error");
                        error = error + 1;
                    }else{
                        $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mobile_check.php/", { mobile : mobiles, ids : $('#username').val() , method : 1 }, function(data){
                            $('#mobs').html(data);
                            if(data!= ""){
                                $("#mobile").addClass("error");
                                //$('#mobile').focus();
                                $('#mobile_flag').val('');
                                error_new = 1;
                            }else{
                                $('#mobile_flag').val('1'); 
                                $("#mobile").removeClass("error");
                                if ($("#first_name").val() == ""){
                                    $("#first_name").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#first_name").removeClass("error");
                                }
                                if($("#last_name").val()==""){
                                    $("#last_name").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#last_name").removeClass("error");
                                }

                                if($("#role").val()==""){
                                    $("#role").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#role").removeClass("error");
                                }
                                if($("#date").val()==""){
                                    $("#date").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#date").removeClass("error");
                                }
                                // var mail_send = $('input:radio[name=send_mail]:checked').val();
                                // if(mail_send == 1){
                                //     if($("#email").val()== ""){
                                //         $("#email").addClass("error");
                                //         error = error + 1;
                                //     }
                                //     else{
                                //         $("#email").removeClass("error");
                                //     }
                                // }else{
                                //     $("#email").removeClass("error");
                                // }

                                if(error == 0 && error_pass == 0 && error_deact == 0 && errors == 0 && error_new == 0){
                                            
                                    if(confirm_ask == 0){
                                        //set message warning if employee will deactivate
                                        var diactivation_warning = '';
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            diactivation_warning = '<br/> <?php echo $_smarty_tpl->tpl_vars['translate']->value['caution'];?>
: <?php echo $_smarty_tpl->tpl_vars['translate']->value['slots_after_inactivation_date_will_be_delete'];?>
';
                                        }
                                        bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
 '+diactivation_warning, [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger",
                                                "callback": function() {
                                                    bootbox.hideAll();
                                                }
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                        bootbox.hideAll();
                                                        $("#form").submit();
                                                }
                                        }]);
                                    }else{
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['caution'];?>
: <?php echo $_smarty_tpl->tpl_vars['translate']->value['slots_after_inactivation_date_will_be_delete'];?>
', [{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                    "class" : "btn-danger",
                                                    "callback": function() {
                                                        bootbox.hideAll();
                                                    }
                                                }, {
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                            bootbox.hideAll();
                                                            $("#form").submit();
                                                    }
                                            }]); 
                                        } else
                                            $("#form").submit();

                                    }
                                }
                                else{
                                    if(error != 0){
                                        $("#error_error").addClass('message');
                                        $("#error_error").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['required_missing'];?>
");
                                    }
                                    if(error_pass != 0){
                                        $("#error_pass").addClass('message');
                                        $("#error_pass").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_minimum'];?>
");
                                    }
                                    if(error_deact != 0){
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            $("#error_pass").addClass('message');
                                            $("#error_pass").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['deactive_date_less'];?>
");
                                        }else{
                                            $("#error_pass").addClass('message');
                                            $("#error_pass").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['active_date_less'];?>
");
                                        }
                                    }
                                }
                            }

                        });
        //$("#mobile").removeClass("error");
                    }
                }
            });
        }
    }	



    //reset form
    function resetForm(){
        $('#form').get(0).reset();
        $('.btn-group').button('reset');
        <?php if ($_smarty_tpl->tpl_vars['access_flag']->value==1&&$_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?>
            edit_mod = 0;
            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', true);
            $("#form input:not(.excluded_edit input), #form textarea").prop('readonly', true);
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            $(".sp-container").hide();
        <?php }?>
    } 

    //print form
    function printForm(){
        //window.print();
        //$('#formPrint').attr('target','_blank');
        $('#formPrint').submit();
    } 	
    
    //back form
    function backForm(){
        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/employee/<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/";
        //document.referrer;
        //history.go(-1)
        window.history.back();
    } 	
        
    function addNewForm(){
    var url = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/";
        document.location.href = url;
        } 
    var confirm_ask = 0;
    var edit_mod    = 1;	
    var change      = 0;
    $(document).ready(function() {

        
        <?php if ($_smarty_tpl->tpl_vars['access_flag']->value==1&&$_smarty_tpl->tpl_vars['employee_action']->value=='EDIT'){?>
            edit_mod = 0;
            //$("#password, .btn-group button:not(.excluded_edit button), #form select,  #form input:not(.excluded_edit input), #form textarea").prop('disabled', true);
            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', true);
            $("#form input:not(.excluded_edit input), #form textarea").prop('readonly', true);
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            $(".sp-container").hide();
            //$(".sp-container").remove();
            
            

            $("#btn_edit").click(function() {
                
                bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_employee_personal_data_mail_go'];?>
', [
                    {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }, 
                    {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                    "class" : "btn-success",
                    "callback": function() {
                            edit_mod = 1;
                            
                            // $('#form input:not(#username)').attr('readonly', false);
                            // $('#form option:not(:selected)').attr('disabled', false);
                            // $("#btn_save, #password").prop('disabled', false);
                            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', false);
                            $("#form input:not(.excluded_edit input, #username), #form textarea").prop('readonly', false);
                            $(':radio,:checkbox').unbind('click');
                            $('.icon-plus, .icon-minus').show();
                            $(".sp-container").show();

                            $(".datepicker").datepicker({
                                autoclose: true,
                                weekStart: 1,
                                calendarWeeks: true, 
                                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
                            });

                            $.mask.definitions['~']='[1-9]';
                            $("#mobile").mask("+46?99 999 99 99", { placeholder:" " });
                            $("#phone").mask("0?~9-99999999999", { placeholder:" " });

                            $("#btn_save").removeAttr('disabled');
                            
                        }
                    }
                ]);    
                     
            });
        <?php }else{ ?>
            $.mask.definitions['~']='[1-9]';
            $("#mobile").mask("+46?99 999 99 99", { placeholder:" " });
            $("#phone").mask("0?~9-99999999999", { placeholder:" " });

            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
            });
        <?php }?>
        if($(window).height() > 600) {
            <?php if (empty($_smarty_tpl->tpl_vars['employee_detail']->value)){?>
                $('.tab-content-con').css({ height: $(window).height()-180});  
            <?php }else{ ?>
                $('.tab-content-con').css({ height: $(window).height()-271});
            <?php }?>
        }
        else
            $('.tab-content-con').css({ height: $(window).height()});

        
        /*$(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
        $(".datepicker").datepicker('disable');*/
        /*$( "#date, #date_inactive, #sem_leave_todate" ).datepicker({
                showOn: "button",
                dateFormat: "yy-mm-dd",
                buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
                buttonImageOnly: true
        });*/
        
        var tab = '<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
';
        if(tab == '03'){
            documentationLoad();
        }
        else if(tab == '02'){
            skillLoad();
        }
        $("#role_val").val("<?php echo $_smarty_tpl->tpl_vars['employee_role']->value;?>
");
     $(".side_links li a").click(function(event){
            event.preventDefault();
            var path = $(this).attr('href');
            
            var new_var = $("#new").val();
            if(new_var == "1"){
                
                bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = path;
                        }
                    }, {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                    
                }]);
            }
            else{
                document.location.href = path;
            }
         });

    $("#first_name").blur(function() {
        if ($("#first_name").val() == ""){
                 $("#first_name").addClass("error");
           }
           else{
                 $("#first_name").removeClass("error");
           }
    });
    $("#last_name").blur(function() {
        if($("#last_name").val()==""){
                 $("#last_name").addClass("error");
           }
           else{
                 $("#last_name").removeClass("error");
           }
    });

    $("#role").blur(function() {
        if($("#role").val()==""){
                 $("#role").addClass("error");
           }
           else{
                 $("#role").removeClass("error");
           }
    });
    $("#date").blur(function() {
        if($("#date").val()==""){
                 $("#date").addClass("error");
           }
           else{
                 $("#date").removeClass("error");
           }
    });
    $("#email").blur(function() {
        $('#email').removeClass('error');
        // if($("#email").val()== "" && $('input:radio[name=send_mail]:checked').val() == 1){
        //          $("#email").addClass("error");
        //    }
        //    else{
        //          $("#email").removeClass("error");
        //    }
    });

    $("#max_hours").blur(function() {
        if($("#max_hours").val()=="" || $("#max_hours").val() > 15){
                 $("#max_hours").addClass("error");
           }
           else{
                 $("#max_hours").removeClass("error");
           }
    });


    //generating username w.r.t lastname blur
    if($('#username').val() =="") {
        
        $('#last_name').blur(function() {
                if($('#last_name').val() != "" && $('#first_name').val() != ""){
                   var name_first =  $('#first_name').val();
                   var name_last =  $('#last_name').val();
                   var social_sec = $('#social_security').val();
                   social_sec = social_sec.replace("-","");
                   name_first = name_first.replace(/\Ä/g, "A")
                   name_first = name_first.replace(/\Å/g, "A")
                   name_first = name_first.replace(/\É/g, "E")
                   name_first = name_first.replace(/\Ö/g, "O")
                   name_first = name_first.replace(/\ä/g, "a")
                   name_first = name_first.replace(/\å/g, "a")
                   name_first = name_first.replace(/\é/g, "e")
                   name_first = name_first.replace(/\ö/g, "o")
                   name_last = name_last.replace(/\Ä/g, "A")
                   name_last = name_last.replace(/\Å/g, "A")
                   name_last = name_last.replace(/\É/g, "E")
                   name_last = name_last.replace(/\Ö/g, "O")
                   name_last = name_last.replace(/\ä/g, "a")
                   name_last = name_last.replace(/\å/g, "a")
                   name_last = name_last.replace(/\é/g, "e")
                   name_last = name_last.replace(/\ö/g, "o")
                   $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : name_first , last_name : name_last },
                        function(data){
                                 $('#username').val(data);
                                 //if(parseInt(data.substring(4,7)) > 1)
                                    $('#dialog_hidden').load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_global_check.php?ssno=" + social_sec);
        });
        }
        });
        }
    		
    			
     //generating username w.r.t firstname blur
     if($('#username').val() =="") {
             $('#first_name').blur(function() {
                 if($('#last_name').val() != "" && $('#first_name').val() != ""){
                 var name_first =  $('#first_name').val();
                   var name_last =  $('#last_name').val();
                   name_first = name_first.replace(/\Ä/g, "A")
                   name_first = name_first.replace(/\Å/g, "A")
                   name_first = name_first.replace(/\É/g, "E")
                   name_first = name_first.replace(/\Ö/g, "O")
                   name_first = name_first.replace(/\ä/g, "a")
                   name_first = name_first.replace(/\å/g, "a")
                   name_first = name_first.replace(/\é/g, "e")
                   name_first = name_first.replace(/\ö/g, "o")
                   name_last = name_last.replace(/\Ä/g, "A")
                   name_last = name_last.replace(/\Å/g, "A")
                   name_last = name_last.replace(/\É/g, "E")
                   name_last = name_last.replace(/\Ö/g, "O")
                   name_last = name_last.replace(/\ä/g, "a")
                   name_last = name_last.replace(/\å/g, "a")
                   name_last = name_last.replace(/\é/g, "e")
                   name_last = name_last.replace(/\ö/g, "o")
                      $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : $('#first_name').val() , last_name : $('#last_name').val() },
                          function(data){
                                $('#username').val(data);	
        });
        }
        });
        }
    		
    //set century asper SSN	
    $( "#social_security" ).keyup(function() {
        var tmp_val = $(this).val();
        tmp_val = tmp_val.replace(/-/g, "");
        tmp_val = tmp_val.replace(/ /g, "");
        if(tmp_val.length >= 2){
            var temp_first_2_digit = parseInt(tmp_val.substring(0, 2));
            if(temp_first_2_digit >= 0 && temp_first_2_digit <= parseInt(<?php echo $_smarty_tpl->tpl_vars['year_in_2_digit']->value;?>
)){
                $('#century').val(20);
            } else {
                $('#century').val(19);
            }
        }
    });
    //validate social security number
    $('#social_security').blur(function() {
        var social_sec = $('#social_security').val();
        social_sec = social_sec.replace("-","");
        $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security.php",
        type:"POST",
        data:"social_security="+social_sec,
        success:
            function(data){
                $('#soc_sec').html(data);
                            if(data!= ""){
                              $("#social_security").addClass("error");
                              $('#social_security').focus();
                              $('#social_flag').val('');  
                            }else{
                              $('#social_flag').val('1'); 
                              $("#social_security").removeClass("error");
                              var last_digit = social_sec.substring(8,9);
                              if(last_digit % 2 == 0){
                                $('#gender_male').prop('checked',false);
                                $('#gender_female').prop('checked',true);
                              }else{
                                $('#gender_male').prop('checked',true);
                                $('#gender_female').prop('checked',false);
                              }
                            }
         }
                        
        });
        });	
            
    $('#mobile').blur(function() {
        if($('#mobile').val() == "+46"){
            $("#mobile").val('');
        }
        var mobiles = $('#mobile').val();
            //var mobiles = $('#mobile').val();
            mobiles = removeCharas(mobiles);
            mobiles = trimMobileNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
            }else{
                $("#mobile").removeClass("error");
            }

            $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mobile_check/", { mobile : mobiles, ids : $('#username').val() , method : 1 },
                function(data){
                    $('#mobs').html(data);
                                if(data!= ""){
                                  $("#mobile").addClass("error");
                                  //$('#mobile').focus();
                                  $('#mobile_flag').val('');
                                }else{
                                  $('#mobile_flag').val('1');  
                                }

            });
        
    });

    $('#phone').blur(function() {
        if($('#phone').val() == "0"){
            $("#phone").val('');
        }
    });
         
        		
    				
    });


    function makeSTl(emp, cust, this_obj) {
        /*$("#cust_username_team").val(cust);
        $("#emp_username_team").val(emp);
        $("#action_change").val("1");
        $("#form").submit();*/
        if(edit_mod == 1){
            $(this_obj).parents('.attached_emp_entry').find('input.emp_role_val').val('7');
            $(this_obj).parents('.attached_emp_entry').find('.emp_role_name').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
');
        }
    }

    function makeTl(emp, cust, this_obj) {
        /*$("#cust_username_team").val(cust);
        $("#emp_username_team").val(emp);
        $("#action_change").val("2");
        $("#form").submit();*/
        if(edit_mod == 1){
            $(this_obj).parents('.attached_emp_entry').find('input.emp_role_val').val('2');
            $(this_obj).parents('.attached_emp_entry').find('.emp_role_name').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>
');
        }
    }

    function giveDeactivation(){
        makeChange();
        var inactive_date = $("#date_inactive").val();
        if(inactive_date == "" || inactive_date == null){
            $("#date_inactive").val("<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
");
        }else{
            var date = new Date($("#date").val());
            var date_in = new Date($("#date_inactive").val());
            if(date > date_in){
                $("#date_inactive").val("<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
");
            }
        }
    }

    function giveActivation(){  
        makeChange();
        var inactive_date = $("#date_inactive").val();
        
        if(inactive_date != "" || inactive_date != null){
            var date = new Date($("#date").val());
            var date_in = new Date($("#date_inactive").val());
            if(date_in < date){
                $("#date_inactive").val('');
            }
        }
    }

    function makeChange(){
        change = 1;
        $("#new").val('1');   
    }

    function redirectConfirm(mode){
        var redirectURL = mode.replace("%%C-UNAME%%", "<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
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

    /*function loadAddEmployee(){
        var change = $("#new").val();
        if(change == "1"){
                
                bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }, {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                }]);
                
            }
            else{
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
            }
    }

    function loadContract(){
        var change = $("#new").val();
        if(change == "1"){
                
                bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }, {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                }]);
                
            }
            else{
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
            }
    }

    function loadNotification(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/notification/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
                
                
            }
            else{
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/notification/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
            }
    }

    function loadPrivilege(){
        var change = $("#new").val();
        if(change == "1"){
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
                
            }
            else{
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
            }
    }
    function loadPrifferedTime(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
emptime/preference/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            }
            else{
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
emptime/preference/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
            }
    }

    function loadSalary(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
    }

    function loadAdministration(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
    }

    function loadSkills(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/skills/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/skills/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }

    }

    function loadDocumentation(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
', [{
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/documentations/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                    }
                }, {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/documentations/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }

    }*/

    function arvodeLoad(){
            $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#arvode_link").parent().addClass("active");
            $("#skill_div").hide();
            $("#Kunder").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_contract_sign.php");
    }

    
    function contractDownload(id){
        $('#action').val('print');
        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/print/";
        window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/print/");
    }
    function delAttachment(id){
        
        bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
', [{
            label: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            class: "btn-danger",
            callback: function() {
                bootbox.hideAll();
            }
        }, {
            label: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            class: "btn-success",
            callback: function() {
                bootbox.hideAll();
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/del1/"+id+"/";
                documentationLoad();
            }
        }]);

    }
    function delSkill(id){

        bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
', [{
            label: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            class: "btn-danger",
            callback: function() {
                bootbox.hideAll();
            }
        }, {
            label: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            class: "btn-success",
            callback: function() {
                bootbox.hideAll();
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/del2/"+id+"/";
                            skillLoad();
            }
        }]);
        
    }    
    function employeeLoad(){
        $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#kunder_link").parent().addClass("active");
        $("#skill_div").hide();
        $("#Kunder").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_role.php");
    }
    function skillLoad(){

       $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#utbildning_link").parent().addClass("active");
            $("#skill_div").show();
        $("#Kunder").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_skill.php");    
    }
    function PreferedTime(){
    	$("#PreferedTime").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_skill.php");
    }
    function documentationLoad(){
    $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().addClass("active");
            $("#skill_div").hide();
        $("#Kunder").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_attachment.php?move=1");
    }

    function checkSecurity(){
            var security = $("#social_security").val();
            security = security.replace("-","");
                    $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security.php",
                            data:"social_security="+security,
                            type:"POST",
                            success:function(data){
                                   $('#soc_sec').html(data);
                                        if(data!= ""){
                                        $("#social_security").addClass("error");
                                        $('#social_security').focus();
                                        $('#social_flag').val('');  
                                    }else{
                                        $('#social_flag').val('1');  
                            }
                            }
                            });
            
    }
    function popup_skill(url) {
             
            var dialog_box_new = $("#dialog_popup");
                dialog_box_new.load(url);
                // open the dialog
                dialog_box_new.dialog({

            title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_skill'];?>
',
            position: 'top',
            modal: true,
            minWidth: 420,
            resizable: false
            
        });
           skillLoad(); 
           return false;
        }
    function generate_password(){
        $("#pass").html('<span class="add-on icon-pencil"></span><input type="text" id="password" class="form-control span11" name="password" value ="<?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
" >');
        //$('#send_mail_yes:radio').prop("checked", true).attr('checked', 'checked');
    }
    function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
        return s;
    }
    function trimMobileNumber(s) {
        while (s.substr(0,3) == '+46' && s.length>1) { s = s.substr(3,9999); }
        return s;
    }
    function removeCharas(s) {
        var i=0;
        var temp_mobile = '';
        while(i<s.length){
            if(s.substr(i,1) == " " || s.substr(i,1) == "." || s.substr(i,1) == "," || s.substr(i,1) == "-" || s.substr(i,1) == "_"){
                i++;
            }else{
                temp_mobile = temp_mobile+s.substr(i,1);
                i++;
            }
        }
        return temp_mobile;
    }

    function validate_email(email){ // function to validate email
        
        var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return email_regex.test(email);

        
    }
</script>


    </body>
</html><?php }} ?>