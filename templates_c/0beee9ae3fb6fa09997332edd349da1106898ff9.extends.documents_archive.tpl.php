<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 12:25:43
         compiled from "/home/time2view/public_html/cirrus/templates/documents_archive.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14378077715fcb7c470e4346-36044643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0beee9ae3fb6fa09997332edd349da1106898ff9' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/documents_archive.tpl',
      1 => 1563970990,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14378077715fcb7c470e4346-36044643',
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
  'unifunc' => 'content_5fcb7c475e4aa9_31343649',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb7c475e4aa9_31343649')) {function content_5fcb7c475e4aa9_31343649($_smarty_tpl) {?><!DOCTYPE html>
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
css/cirrus.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/message-center.css" rel="stylesheet" type="text/css" />
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/bootstrap.min.css">
        <!-- Generic page styles -->
        
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/blueimp-gallery.min.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/jquery.fileupload.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>
    <style type="text/css">

        #mailing_list .mailing_group ul .mail_grup_customer, #mailing_list .mailing_group ul .mail_grup_customer_unasigned{
            background: none repeat scroll 0 0 #e3f2f6;
        }
        #mailing_list .mailing_group ul .mail_grup_customer_unasigned {
            background: none repeat scroll 0 0 #feeded;
        }
        #mailing_list .mailing_group ul li{
            border-color: -moz-use-text-color #e8eff1 #e8eff1;
            border-style: none solid solid;
            border-width: medium 1px 1px;
            list-style: none outside none;
            margin: 0 auto;
            padding: 4px 3px 4px 5px;
        }
        #mailing_list li.mail_grup_employees{
            /*padding-left: 0 !important;*/
            border: none;
            padding-right: 15px !important;
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
                                
    <div style="display:none; padding-top: 20px;padding-left: 13px;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" id="dialog-confirm">
        <p><span style="float:left; margin:0 7px 20px 0;" class="error_msg_icon"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>
    </div>
    <div style="display:none;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" id="dialog-confirm_delete">
        <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
</p>

    </div>

    <div style="display:none;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" id="dialog-confirm_move">
        <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_move_file'];?>
</p>

    </div>

    <div style="display:none;" id="dialog_popup" class="clearfix"></div>
    <div style="display:none;" id="dialog_hidden" class="clearfix"></div>
    <form method="POST" id="common_form" action="">
        <div class="row-fluid" id="main_container">
        <div class="span12 main-left">


            <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <!-- <form action="" method="post" name="form" id="fileupload" enctype="multipart/form-data" > -->
                
            

            <!-- <div class="row fileupload-buttonbar" style="margin-top: 10px;">
            <div  --><!-- class="col-lg-9"> -->
                <!-- The fileinput-button span is used to style the file input field as button -->
                <!-- <span class="btn btn-success fileinput-button" style="margin: 10px;">
                    <i class="icon icon-plus"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_files'];?>
</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start" id="up">
                    <i class="icon icon-upload"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['start_upload'];?>
</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon icon-remove"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancell_upload'];?>
</span>
                </button>
                
                <button type="button" class="btn btn-danger" id="manage_contacts">
                    <i class="icon icon-cog"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['privilge_doc_archive'];?>
</span>
                </button>
                 -->
                <!--  -->
                <!-- The global file processing state -->
                <!-- <span class="fileupload-process"></span>
            </div>
            <div class="col-lg-3 fileupload-progress fade"> -->
                <!-- The global progress bar -->
                <!-- <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div> -->
                <!-- The extended global progress state -->
                <!-- <div class="progress-extended">&nbsp;</div>
            </div>    
        </div>   -->   

        <!-- <div class="category_listing span12">
            <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                <button class="btn btn-success focus_btn" id="category<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" name="category_type" value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
" onclick="focus_btn('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
')" type="submit"><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</button>
                <!-- <input type="hidden" name="category_type" id="categorytype<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
"> -->
           <!--  <?php } ?>
        </div> --> 


        
        <!-- The table listing the files available for upload/download -->
       <!--  <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
        <script id="template-upload" type="text/x-tmpl">
            
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="icon icon-upload"></i>
                    <span>Ladda upp</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon icon-ban-circle"></i>
                    <span>Avbryt</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}

</script>
<!-- The template to display files available for download -->
<!-- <script id="template-download" type="text/x-tmpl">

</script> -->        
                
 <!-- main-left -->        
            <div class="span12" style="margin:5px 0px 0px 0px;">

                    <div class="row-fluid">
                        <div class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['Document_Archieves'];?>
</h1>
                        </div>
                            <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?>
                                    <button class="btn btn-default pull-right" onclick="category_form()" type="button" style="margin-left:5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['Manage_Category'];?>
</button>
                                    <?php if ($_smarty_tpl->tpl_vars['category_id']->value==-1&&($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6)){?>
                                        <button class="btn btn-default pull-right" type="button" onclick="upload_form('<?php echo $_smarty_tpl->tpl_vars['document']->value['category'];?>
')" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['Upload_Files'];?>
</button>
                                    <?php }elseif($_smarty_tpl->tpl_vars['category_id']->value!=-1){?>
                                        <button class="btn btn-default pull-right" type="button" onclick="upload_form('<?php echo $_smarty_tpl->tpl_vars['document']->value['category'];?>
')" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['Upload_Files'];?>
</button>
                                    <?php }?>
                                    <select name="move_category" class="pull-right" style="display: none;margin-left:5px;" id="move_category" onchange="move_category_confirm()" >
                                        <option selected="true" disabled="disabled" id="option_category_move"><?php echo $_smarty_tpl->tpl_vars['translate']->value['Move_Category'];?>
</option>
                                        <option value="0"  id="option_category0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
</option> 
                                        <!-- <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" id="option_category<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" > <?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</option>
                                        <?php } ?> -->
                                    </select>
                                <?php }?>
                                    <button onclick="backform('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
')" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> Tillbaka</button>
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid" style="margin-top: 5px;">
                        <div class="widget-header span12">
                            <!-- <div class="span12"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['path'];?>
</h1></div> -->
                            <!-- <div class="span12 day-slot-wrpr-header-left span6"> -->
                                    <label><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['path'];?>
</h1></label>
                                    <span>
                                        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['path_name']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                                           <a href="javascript:void(0);" onclick="goto_page('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
')"> <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
/<?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
/ <?php }?></a>
                                        <?php } ?>
                                    </span>
                                    <?php if ($_smarty_tpl->tpl_vars['category_id']->value==-1&&$_smarty_tpl->tpl_vars['sign_flag']->value){?>
                                        <div class="pull-right day-slot-wrpr-header-left span2" style="padding: 5px;">
                                            <a style="float: right; width: 95px !important; height: 30px !important;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="document_sign()"></a>
                                        </div>
                                    <?php }?>
                            <!-- </div> -->
                        </div>
                    </div>
                   

                <div class="span12 widget-body-section input-group">
                    
                    <!-- <div class="row-fluid">
                        <iframe data=<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/A11.pdf src='https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true' frameborder='0'></iframe> 

                        <div class="category_listing span12" style="padding:0 0 10px 5px;">
                            <ul style="display: inline;">
                                <?php if ($_smarty_tpl->tpl_vars['count_of_categorys']->value[0]['count']>0||$_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?>
                                    <li style="display: inline;">
                                        <a class="btn no-bg focus_btn" id="category0"  value="0" onclick="focus_btn(0)" type="button" selection="" ><i  id="category_icon0" <?php if ($_smarty_tpl->tpl_vars['category_id']->value==0){?> class="icon-folder-open folder" style="font-size: 50px;" <?php }else{ ?> class="icon-folder-close folder" style="font-size: 35px;" <?php }?> ></i><span style="display: block;">Root</span></a>
                                    </li>
                                <?php }?>
                                <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['count_of_categorys']->value[$_smarty_tpl->tpl_vars['key']->value+1]['count']>0||$_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?>
                                        <li style="display: inline;" >
                                            <a class="btn no-bg focus_btn" id="category<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
"   value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" onclick="focus_btn('<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
')" type="button" selection=""><i id="category_icon<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['category_id']->value==$_tmp1){?> class="icon-folder-open folder" style="font-size: 50px;" <?php }else{ ?> class="icon-folder-close folder" style="font-size: 35px;" <?php }?>></i><span style="display: block;"><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</span></a>
                                        </li>
                                    <?php }?>
                                <?php } ?>
                            </ul> 
                        </div>
                    </div> -->
                    <div class="row-fluid">
                        <!-- <ifsrame data=<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/A11.pdf src='https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true' frameborder='0'></iframe>  -->

                        <div class="category_listing span12" style="padding:0 0 0px 5px;">
                            <ul style="display: inline;">
                                <!-- <?php if ($_smarty_tpl->tpl_vars['count_of_categorys']->value[$_smarty_tpl->tpl_vars['key']->value+1]['count']>0||$_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?> -->
                                    <li style="display: inline;">
                                        <a class="btn no-bg focus_btn" id="category0"  value=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
 onclick="focus_btn('<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
')" type="button" selection="" style="padding: 0px;"><i  id="category_icon<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
" class="icon-folder-open folder" style="font-size: 50px;" ></i><span style="display: block;"><?php if ($_smarty_tpl->tpl_vars['category_names']->value['parent']['id']==0){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
 <?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['category_names']->value['parent']['name'];?>
<?php }?></span></a>
                                    </li>

                                <!-- <?php }?> -->
                                
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span1">
                        </div>
                        <div class="span11">
                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6){?>
                                <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                     
                                        <li style="display: inline;" >
                                            <a class="btn no-bg focus_btn" id="category<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
"   value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" onclick="focus_btn('<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
')" type="button" selection=""><i id="category_icon<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" class="icon-folder-close folder" style="font-size: 35px;" ></i><span style="display: block;"><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</span></a>
                                        </li>
                                     
                                    <!-- <?php if ($_smarty_tpl->tpl_vars['count_of_categorys']->value[$_smarty_tpl->tpl_vars['key']->value+1]['count']>0||$_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?> -->
                                       
                                    <!-- <?php }?> -->
                                <?php } ?>
                            <?php }else{ ?>
                                <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                     
                                        <?php if (in_array($_smarty_tpl->tpl_vars['category_name']->value['id'],$_smarty_tpl->tpl_vars['last_parent_id']->value)){?>
                                            <li style="display: inline;" >
                                                <a class="btn no-bg focus_btn" id="category<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
"   value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" onclick="focus_btn('<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
')" type="button" selection=""><i id="category_icon<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" class="icon-folder-close folder" style="font-size: 35px;" ></i><span style="display: block;"><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</span></a>
                                            </li>
                                        <!-- <?php if ($_smarty_tpl->tpl_vars['count_of_categorys']->value[$_smarty_tpl->tpl_vars['key']->value+1]['count']>0||$_smarty_tpl->tpl_vars['privileges_mc']->value['document_archive']==1){?> -->
                                           
                                        <!-- <?php }?> -->
                                        <?php }?>
                                    
                                <?php } ?>
                            <?php }?>
                            </ul> 
                        </div>
                    </div>

                <div class="row-fluid">

                    <div id="forms_container_new" style=" max-height: 408px;">
                        <!--- edit here 17/05/2012 -->

                        <!-- edit here -->
                        <div class="employe_skill" >
                         <!--   <div class="skilname"><div class="skill_document" style="width: 225px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['document'];?>
</div> <div class="skill_document" style="width: 225px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</div><div class="skill_document" style="width: 225px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['dates'];?>
</div> </div>-->
                            <div class="table-responsive">
                                <table id="table_list" name="table_list" class="table table-left table-bordered table-condensed table-hover table-responsive table-primary no-margin "  >
                                    <thead>
                                        <tr>
                                            <th style="width: 2%;"></th>
                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['document'];?>
</th>
                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['mc_da_doc_owner'];?>
</th>
                                            <?php if ($_smarty_tpl->tpl_vars['category_id']->value==-1){?><th><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed'];?>
</th><?php }?>
                                            <th style="width:13%;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['dates'];?>
</th>
                                            <th style="width:5%;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mc_da_delete_head'];?>
</th>
                                            <?php if ($_smarty_tpl->tpl_vars['category_id']->value!=-1){?>
                                                <th style="width:5%;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mc_da_edit_head'];?>
</th>
                                            <?php }?>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                        <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['documents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
$_smarty_tpl->tpl_vars['document']->_loop = true;
?>
                                            <tr class="check" >
                                                <td>
                                                    <input type="checkbox" name="categorys_to_move[]" onclick="checkbox_check('<?php echo $_smarty_tpl->tpl_vars['document']->value['category'];?>
')" value="<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
" >
                                                </td>

                                                <td>
                                                    <div class="skilldocument_pdf notification-info-customer span6">
                                                        <a href="javascript:void(0)" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['document']->value['file_name'];?>
')" title="<?php echo $_smarty_tpl->tpl_vars['document']->value['file_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['document']->value['file_name'];?>
</a>
                                                    </div> 
                                                    <div class="pull-right">
                                                       <button type="button" class="btn btn-xs btn-primary" title="Download" onclick="download_doc('<?php echo $_smarty_tpl->tpl_vars['document']->value['file_name'];?>
')"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['download'];?>
 <i class="icon-download" ></i></button>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['document']->value['users']=='*'){?><div class="notification-info-customer span3"><div class="label label-warning" style="display: inline-block;max-width: 330px;height:15px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>
</div></div><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==7||$_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['document']->value['users']!=''&&$_smarty_tpl->tpl_vars['document']->value['users']!='*'){?><div class="notification-info-customer span3" ><div class="label label-warning" title= "<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['document']->value['priv_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?> <?php echo substr($_smarty_tpl->tpl_vars['value']->value,0,7);?>
 <?php } ?>" style="display: inline-block;max-width: 330px;height:15px;"> <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['document']->value['priv_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?> <?php echo substr($_smarty_tpl->tpl_vars['value']->value,0,7);?>
 <?php } ?></div></div><?php }?>
                                                    <?php }?>

                                                </td>
                                               
                                                <td>
                                                    <div >
                                                        <?php echo $_smarty_tpl->tpl_vars['document']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['document']->value['first_name'];?>

                                                    </div>
                                                </td>
                                                <?php if ($_smarty_tpl->tpl_vars['category_id']->value==-1){?>
                                                    <td>
                                                        <?php if ($_smarty_tpl->tpl_vars['document']->value['signed_date']){?>
                                                        <div class="pull-right">
                                                        <a href="javascript:void(0);" style="float: right;" onclick="deleteSign(<?php echo $_smarty_tpl->tpl_vars['document']->value['signed_id'];?>
)" class="btn btn-normal"><span class="icon-trash"></span></a>
                                                        </div>
                                                        <div class="pull-right">
                                                            <?php echo $_smarty_tpl->tpl_vars['document']->value['signed_date'];?>
 through BankID&nbsp;&nbsp;<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/banck_id_signing.jpg" style="height: 18px;">
                                                        </div>
                                                        <?php }?>
                                                    </td>
                                                <?php }?>
                                                <td>
                                                    <div>
                                                        <?php echo $_smarty_tpl->tpl_vars['document']->value['date'];?>
 </div> 
                                                </td>
                                                
                                                
                                                <td class="center">
                                                    <?php if ($_smarty_tpl->tpl_vars['document']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value||$_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6||$_smarty_tpl->tpl_vars['login_user_role']->value==7){?>  
                                                    <div>
                                                        <a class="btn btn-danger span12" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mc_da_delete_tool_tip'];?>
" onclick="deleteDocument('<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['document']->value['file_name'];?>
')">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </div>
                                                    <?php }?>        
                                                </td>
                                                <?php if ($_smarty_tpl->tpl_vars['category_id']->value!=-1){?>
                                                    <td class="center">
                                                        <?php if ($_smarty_tpl->tpl_vars['document']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value||$_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6||$_smarty_tpl->tpl_vars['login_user_role']->value==7){?>
                                                        <div>

                                                            <a class="btn btn-danger span12" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mc_da_edit_tool_tip'];?>
" onclick="editPrivilege('<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['document']->value['users'];?>
', '<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
',this)">
                                                                <i class="icon-fixed-width icon-cogs"></i>
                                                            </a>
                                                        </div>
                                                        <?php }?>
                                                    </td>
                                                <?php }?>
                                            </tr>
                                        <?php }
if (!$_smarty_tpl->tpl_vars['document']->_loop) {
?>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                            <input type="hidden" id="action_common" name="action_common">
                            <input type="hidden" value="" id="sign_id" name="sign_id">
                            <input type="hidden" value="" id="doc_id" name="doc_id">
                            <input type="hidden" value="" id="file_name_delete" name="file_name_delete">
                            <input type="hidden" value="" id="user_privilege" name="user_privilege">

                    </div>
                </div>
                </div>
            </div>
            <!-- </form>                         -->
        </div>        
                                    
    <div class="span4 main-right hide" id="mail-recipient" style="padding: 0; border:0; background: none; overflow: hidden">
        <div class="row-fluid hide" id="mail-recipient-list">
            <div class="span12 addnew-mail-visible" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span5 day-slot-wrpr-header-left span6">
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right" id="btn_priv"  onclick="select_multi_recipients()" style="" type="button"><i class=' icon-ok'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['inserts'];?>
</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-arrow-left'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group email-list-box">
                        <div class="row-fluid">
                            <div class="span12 no-ml" id="mailing_list" style="width: 100% !important;">
                                <div class="span12" id="options_panel">
                                    <label class="pull-left"><input type="checkbox" value="public" id="chk_public" name="chk_public" class="mr" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>
</label>
                                    <label class="pull-right"><input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all" class="mr" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>
</label>
                                </div>
                                
                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['employee']->value['customer_name']!='ALL'){?>

                                            <div class="mailing_group span12 no-ml" >

                                            <div class="mail_grup_customer span12" style="background: #BFF4FF;  padding: 0px 0 0 10px !important; border-bottom:solid 1px #fff;">
                                                <div style="padding: 10px 0px 0px !important; min-height: 33px;">
                                                    <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" id="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" class="pull-left check_recipient_groups check_recipient_emp">
                                                    <label for="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" class="pull-left" style="margin-left: 10px;width: 90%;"><?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_name'];?>
</label>
                                                </div>
                                            </div>   

                                            <div  class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt" style="background: #DEE793; padding: 10px 10px 0px !important;">
                                                <?php  $_smarty_tpl->tpl_vars['empl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['empl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee']->value['employees_customer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empl']->key => $_smarty_tpl->tpl_vars['empl']->value){
$_smarty_tpl->tpl_vars['empl']->_loop = true;
?>
                                                    <div class=" span12 no-ml" style="border-bottom:solid 1px #fff;padding: 0px 0px 0px !important;min-height: 24px;margin-bottom: 5px;">
                                                        <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
-<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" class="pull-left check_recipient_emp" id="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
">

                                                        <label class="pull-left" style="margin-left: 10px; width: 90%;" for="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
"><?php echo $_smarty_tpl->tpl_vars['empl']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['empl']->value['last_name'];?>
 </label>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                            </div>    
                                        <?php }?>
                                    <?php } ?>
                                
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6){?>
                                <div class="mailing_group span12 no-ml">
                                    <ul class="span12 no-ml">
                                        <li class="mail_grup_customer_unasigned span12">
                                            <label for="cch_unassigned_emps" class="pull-left"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unassigned_employees'];?>
</label>
                                            <input type="checkbox" value="" name="cch_unassigned_emps" id="cch_unassigned_emps" class="pull-right check_recipient_groups">
                                        </li>            
                                        <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                            <ul class="span12">
                                                <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                    <?php if ($_smarty_tpl->tpl_vars['employee']->value['customer_name']=='ALL'){?>
                                                        <li class=" span12 no-ml">
                                                            <label class="pull-left" for="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
"><?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['last_name'];?>
</label>
                                                            <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
" class="pull-right check_recipient_emp" id="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
">
                                                        </li>
                                                    <?php }?>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
                        <!-- main right create category form begins -->
            <form method="POST" action="" id="category_form">
                <div class="span4 main-right category" style="width: 45%;display: none;">
                    <div class="row-fluid">
                            <div class="span12 sigin-box" style="margin-left: 0px;">
                                <div style="margin: 0px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span6 day-slot-wrpr-header-left span6">
                                            <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['Manage_Category'];?>
</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-cancel-category" type="button" style="margin-left: 2px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                                            <button class = "btn btn-default pull-right mr-3" id="add_new_category">
                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_category'];?>

                                            </button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section">


                                        <div id="add_new_category_div" class="row-fluid" style="margin-bottom: 10px;display: none;">
                                            <div style="margin: 0px ! important;" class="widget">
                                                <div class=" widget-header span12">
                                                    <div class="span4 day-slot-wrpr-header-left span6">
                                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['Create_Category'];?>

                                                    </div>
                                                    <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                                        <button class="btn btn-default btn-normal pull-right "  name="category_save" type="submit"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                                    </div>
                                                </div>
                                                <div class="span12 widget-body-section">
                                                    <div style="margin: 10px 0px 0px ! important;" class="row span12">
                                                        <label style="float: left;" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_parent'];?>
</label>
                                                        <select style="margin-left: 5px;width: 206px;" name="parent_cat">
                                                            <option data-space = 2  id="parent_0" value="0" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
</option>
                                                        </select>
                                                    </div>
                                                    <div class="row span12" style="margin: 10px 0px 0px ! important;">
                                                        <label  style="float: left;" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['Category'];?>
 </label>
                                                        <input type="text" name="category" id="category" class="ml" style="margin-left: 33px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row-fluid manage-cat-table-height">
                                                  <div class="tbl-responsive cat-height" style="overflow-y: auto;overflow-x: hidden;">
                                                <?php if (count($_smarty_tpl->tpl_vars['all_level_child_names']->value)>0){?>
                                                    <table class="table table-bordered table-condensed table-hover table-primary no-margin table-manage-catt" style="table-layout: auto;" >
                                                        <thead>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['Category'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
</th>
                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</th>
                                                        </thead>                                              
                                                        <tbody>
                                                             <?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['all_level_child_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                                                    <tr>
                                                                        <td><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</td>
                                                                        <td style="width: 10%"><a class="btn btn-danger span12" name="edit_category_btn"  title="Edit" onclick="edit_category('<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
',this,'<?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
')"><i class="icon-edit"></i></a></td>
                                                                        <td style="width: 10%"><a class="btn btn-danger span12" name="delete_category_btn"  title="Delete" onclick="delete_category('<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
')"><i class="icon-trash"></i></a></td>
                                                                    </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php }?>
                                            </div>
</div>
                                    </div>
                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                    </div>
                </div>
                        <input type="hidden" name="action_cat" id="action_cat">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <input type="hidden"  id="delete_category_id" name="delete_category_id" value="">

            </form>

            <form action="" method="post" name="form" id="fileupload" enctype="multipart/form-data" >
                <div class="span4 main-right upload_form" style="width: 45%;display: none;">
                        <div class="row-fluid">
                            <div class="span12 sigin-box" style="margin-left: 0px;">
                                <div style="margin: 0px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span6 day-slot-wrpr-header-left span6">
                                            <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['Upload_Files'];?>
</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-cancel-upload" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section">
                                        <div class="row-fluid">
                                             <select name="category_select" id="category_select">
                                                <option id="upfile_0" value="0" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
</option>
                                                 <!--<?php  $_smarty_tpl->tpl_vars['category_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_name']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_names']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category_name']->key => $_smarty_tpl->tpl_vars['category_name']->value){
$_smarty_tpl->tpl_vars['category_name']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category_name']->key;
?>
                                                    <?php if (($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6)&&$_smarty_tpl->tpl_vars['category_id']->value==-1){?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['category_name']->value['id']==$_smarty_tpl->tpl_vars['category_id']->value){?> selected="true" <?php }?>><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</option>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['category_id']->value!=-1){?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['category_name']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['category_name']->value['id']==$_smarty_tpl->tpl_vars['category_id']->value){?> selected="true" <?php }?>><?php echo $_smarty_tpl->tpl_vars['category_name']->value['name'];?>
</option>
                                                    <?php }?>
                                                 <?php } ?>-->
                                             </select>
                                        </div>

                                        <div class="row-fluid">
                                            <div class="row fileupload-buttonbar" style="margin-top: 10px;">
                                                <div class="col-lg-12">
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                         <span class="btn btn-success fileinput-button no-ml no-mr mb" style="margin: 10px;">
                                                            <i class="icon icon-plus"></i>
                                                            <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_files'];?>
</span>
                                                            <input type="file" name="files[]" multiple>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary start no-ml" id="up">
                                                            <i class="icon icon-upload"></i>
                                                            <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['start_upload'];?>
</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning cancel no-ml">
                                                            <i class="icon icon-remove"></i>
                                                            <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancell_upload'];?>
</span>
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-danger no-ml" id="manage_contacts">
                                                            <i class="icon icon-cog"></i>
                                                            <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['privilge_doc_archive'];?>
</span>
                                                        </button>
                                                        
                                                        
                                                        <!-- The global file processing state -->
                                                        <span class="fileupload-process"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row-fluid">
                                                         <!-- The table listing the files available for upload/download -->
                                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                                <script id="template-upload" type="text/x-tmpl">
                                                    
                                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                                            <tr class="template-upload fade">
                                                <td>
                                                    <span class="preview"></span>
                                                </td>
                                                <td>
                                                    <p class="name">{%=file.name%}</p>
                                                    <strong class="error text-danger"></strong>
                                                </td>
                                                <td>
                                                    <p class="size">Processing...</p>
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                                    
                                                </td>
                                                <td>
                                                    {% if (!i && !o.options.autoUpload) { %}
                                                        <button class="btn btn-primary start" disabled id="up" style="margin-bottom:5px;">
                                                            <i class="icon icon-upload"></i>
                                                            <span>Ladda upp</span>
                                                        </button>
                                                    {% } %}
                                                    {% if (!i) { %}
                                                        <button class="btn btn-warning cancel" style="margin-bottom:5px;">
                                                            <i class="icon icon-ban-circle"></i>
                                                            <span>Avbryt</span>
                                                        </button>
                                                    {% } %}
                                                </td>
                                            </tr>
                                        {% } %}
                                        
                                        </script>
                                         
                                        <!-- The template to display files available for download -->
                                        <script id="template-download" type="text/x-tmpl">

                                        </script>

                                            <input type="hidden" value="" id="action" name="action">
                                             <input type="hidden" value="" id="user_privilege_add" name="user_privilege_add">
                                        </div>

                                        <div class="row-fluid">
                                             <div id="set_privilege_up"  style="display: none;">
                                             </div>
                                        </div>

                                    </div>
                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



               
                  

                                
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
    
<script type="text/javascript">

    function parent_child_show(){
        var level;
        var category_names = <?php echo json_encode($_smarty_tpl->tpl_vars['all_category']->value);?>
;
            $.each(category_names, function (index, value) {
                if(value.parent_category == 0 ){
                    // level = 10 ;
                    <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1||$_smarty_tpl->tpl_vars['login_user_role']->value==6){?>
                        var space = $('#parent_'+value.parent_category).data('space');
                        space = space + 2;
                        w_space  = "&nbsp".repeat(space);
                        $('#parent_0').after('<option data-space = '+space+'  value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                        $('#upfile_0').after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                        $('#option_category0').after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                    <?php }else{ ?>
                        if(value.id != -1) {
                            var space = $('#parent_'+value.parent_category).data('space');
                            space = space + 2;
                            w_space  = "&nbsp".repeat(space);
                            $('#parent_0').after('<option data-space = '+space+'  value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                            $('#upfile_0').after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                            $('#option_category0').after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                        }
                    <?php }?>
                }
                else{
                    for (var i = 0; i <index; i++) {
                        if(value.parent_category == category_names[i].id){
                             var space = $('#parent_'+value.parent_category).data('space');
                             space = space + 4;
                             w_space  = "&nbsp".repeat(space);
                             $('#parent_'+value.parent_category).after('<option data-space = '+space+' value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                             $('#upfile_'+value.parent_category).after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                             $('#option_category'+value.parent_category).after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                        }
                    }
                }
            });
    }

    $(document).ready(function(){

// height set
//var windowHeight = $(window).height();
//$('.table-manage-catt').height(windowHeight);
//add_new_category

    var windowHeight = $(window).height();
    $('.cat-height').height(windowHeight);
    $(window).resize(function(){
        $('.cat-height').height(windowHeight);
     });

         // $("#add_new_category").click(function() {
         //    var manageCatAdd = $('#add_new_category_div').height();
         //    $('.manage-cat-table-height').height()-200;
         //     });




        // $('#forms_container_new').css({ height: $(window).height()-208}); 
        parent_child_show();
        var folder_id = '<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
' == '' ? folder_id = 0 : folder_id = '<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
' ;
        $('#upfile_'+folder_id).prop('selected','selected');
        $('#parent_'+folder_id).prop('selected','selected');
        // $( "#category_select option:selected" ).html($( "#category_select option:selected" ).html().replace(/&nbsp;/g, ''));

        $('.tbl-responsive').css({ height: $(window).height()-140});
        if($(window).height() > 600){
            $('#forms_container_new').css({ height: $(window).height()-300}); 
            $('#table_list').css({ height: 'auto'}); 
            $('.row-fluid .table-responsive').css({ height: $(window).height()-300});
            $('.main-right').css({ height: $(window).height()}); 
            $('.email-list-box').css({ height: $(window).height()-124}); 
        } else {
            $('#table_list').css({ height: 'auto'}); 
            $('#forms_container_new').css({ height: $(window).height()});    
            $('.main-right').css({ height: $(window).height()});    
            $('.email-list-box').css({ height: $(window).height()});    
        }

        $(window).resize(function(){
            $('.tbl-responsive').css({ height: $(window).height()-140});
            if($(window).height() > 600){
                $('#forms_container_new').css({ height: $(window).height()-208}); 
                $('#table_list').css({ height: 'auto'}); 
                $('.main-right').css({ height: $(window).height()}); 
                $('.email-list-box').css({ height: $(window).height()-124}); 
            }
            else{
                $('#table_list').css({ height: 'auto'}); 
                $('#forms_container_new').css({ height: $(window).height()});  
                $('.main-right').css({ height: $(window).height()});  
                $('.email-list-box').css({ height: $(window).height()});  
            }
        });  
        
       var $demo1 = $('table#table_list');
        $demo1.floatThead({
                scrollContainer: function($demo1){
                        return $demo1.closest('#forms_container_new');
                }
        });


         var $demo2 = $('table.table-manage-catt');
        $demo2.floatThead({
                scrollContainer: function($demo2){
                        return $demo2.closest('.manage-cat-table-height');
                }
        });
        
        
        var height = $("#scroll_doc").height();
        
         $("#manage_contacts").click(function(e) {
            $('#mail-recipient-list').appendTo('#set_privilege_up');
            $('#set_privilege_up').toggle();
            //close_right_panel();
            // $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-recipient-list").removeClass('hide');

            
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#mailing_list').find('.mailing_group mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);
            //e.preventDefault();
        });
        
        $(".btn-cancel-right").click(function() {
            var $demo1 = $('table#table_list');
            $demo1.floatThead();
            $demo1.floatThead('reflow');
            $('#mailing_list').find('input:checkbox').attr('checked', false);
            close_right_panel();
            $('#action').val("");
            $('.span4.main-right.category').removeClass('hide');
            $('.span4.main-right.upload_form').removeClass('hide');

        });
    });
    
    
    function editPrivilege(id, users, doc_id, elem){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $('#mail-recipient-list').appendTo('#mail-recipient');
        $(".check").children('td').css('background-color','#ffffff');
        $(elem).parent().parent().parent().children('td').css('background-color','#ccffff');

        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right #mail-recipient-list").removeClass('hide');

        $('#mailing_list').find('input:checkbox').attr('checked', false);
        if(users == '*'){
            $('#chk_public').attr('checked', false).trigger('click');
        } else {
            $('#chk_public').attr('checked', true).trigger('click');
            user_array = users.split(",");
            $('#mailing_list').find('input:checkbox').each(function(){
                if((ind = user_array.indexOf($(this).val())) != -1){
                    if(user_array[ind] == $(this).val())
                        $(this).attr('checked', true);
                }
            });

        }

        
        $('#btn_priv').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['alter_privilege'];?>
');
        $('#action_common').val("3");
        $('#doc_id').val(doc_id);
    }
    
    
    function close_right_panel(){
        $(".check").children('td').css('background-color','#ffffff');
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right #mail-recipient-list").addClass('hide');
        $('.main-right #right_message_wraper, #left_message_wraper').html('');
    }
    
    function saveForm(){
        var error = 0;
        if($.trim($("#file").val()) == ''){
            $("#file").addClass('error');
            error = 1;
        }else{
            $("#file").removeClass('error');
        }
        if(error == 0){
//            $("#scroll_doc").html('<div class="popup_first_loading" style="height: 500px;"></div>');
            wrapLoader("#scroll_doc");
            $('#action').val("1");
            $("#form").submit();
        }
    }
    
    function downloadFile(document_id,filename){
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
documents/archive/",
            type:"POST",
            dataType: 'json',
            data: { 'document_id': document_id,'filename' : filename,'action': 'mark_read'},
            success:function(data){
                var file_array = filename.split('.');
                var extension  = file_array[(file_array.length-1)].toLowerCase();
                var image_type =['jpg','jpeg','png'];
                if(jQuery.inArray(extension, image_type) !== -1){
                    window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/'+filename);
                }
                else{
                    window.open('http://docs.google.com/viewer?url=<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/'+filename+'&embedded=true');
                }




                // document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
            }
        });
        
    }

    function download_doc(filename){
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
    }
    
    function deleteDocument(doc_id,file_name){
        $( "#dialog-confirm_delete" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                    $( this ).dialog( "close" );
                    wrapLoader("#scroll_doc");
                    $('#action_common').val("2");
                    $('#doc_id').val(doc_id);
                    $('#file_name_delete').val(file_name);
                    $("#common_form").submit();
                },
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                        $( this ).dialog( "close" );
                }
            }
        });
    }

    function document_sign() {
        $('#action_common').val("document_sign");
        $("#common_form").submit();
    }

    function deleteSign(sign_id){
        $( "#dialog-confirm_delete" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                    $( this ).dialog( "close" );
                    wrapLoader("#scroll_doc");
                    $('#sign_id').val(sign_id);
                    $('#action_common').val("document_sign_delete");
                    $("#common_form").submit();
                },
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    }
   
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload.js"></script>


<!-- The File Upload processing plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/uploadjs/main.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.floatThead.min.js" type="text/javascript" ></script>

<script>
    $(document).ready(function(){ 
    $('#table_list').css({ height: 'auto'}); 
    var fileCount = 0, fails = 0, successes = 0;
 
    $('#fileupload').fileupload({
        url: '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
documents/archive/'
    }).bind('fileuploaddone', function(e, data) {
      fileCount++;
      successes++;
      console.log('fileuploaddone');
      // alert("1");
      if (fileCount === data.getNumberOfFiles()) {
        console.log('all done, successes: ' + successes + ', fails: ' + fails);
        // refresh page
        location.reload();
      }
    }).bind('fileuploadfail', function(e, data) {
        // this is not upload fail // shaju
      fileCount++;
      fails++;
      
      console.log('fileuploadfail');
      if($("#action").val() == "1"){
          location.reload();
      }
      
    }).on('fileuploadsubmit', function(e, data) {
        //alert("1"); 
        $("#action").val("1");
        select_multi_recipients();
    });                                                                                                                                                                                                                                                         

    $("#recipient_check_all, .check_recipient_groups, #chk_public").click(function(e){
            e.stopPropagation();
    });
    $('#mail-recipient-list #recipient_check_all').click(function () {
        $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
        $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    $('#mail-recipient-list .check_recipient_groups').click(function () {
        $(this).parents('.mailing_group').find('.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    $('#chk_public').click(function () {
        if(this.checked){
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false).attr('disabled', 'disabled');
            $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false).attr('disabled', 'disabled');
            $('#recipient_check_all').attr('checked', false).attr('disabled', 'disabled');
        } else {
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').removeAttr('disabled');
            $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').removeAttr('disabled');
            $('#recipient_check_all').removeAttr('disabled');
        }
    });
});
    
    function select_multi_recipients(){
        
            var is_public_visibility = $('#chk_public:checkbox:checked').val();
            var is_public_visibility_value = (is_public_visibility ? true : false);
            if(is_public_visibility_value){
                $("#user_privilege").val('*');
                $("#user_privilege_add").val('*');
                close_right_panel();
            }
            else{
                var selected_recipients = $('#mail-recipient-list input:checkbox:checked.check_recipient_emp').map(function () {
                    return this.value;
                }).get(); 
                if(selected_recipients.length > 0){
                    $("#user_privilege").val(selected_recipients);
                    $("#user_privilege_add").val(selected_recipients);
                    close_right_panel();
                }
            }
            if($('#action_common').val() == 3){
                $("#common_form").submit();
            }
        
    }

    function category_form(){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        var $demo2 = $('table.table-manage-catt');
        $demo2.floatThead();
        $demo2.floatThead('reflow');
        $('.category').removeClass('hide');
        $("#main_container").css('width', '55%');
        $('.category').show();
        $('.upload_form').hide();
    }

    function upload_form(id){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $('#upfile_'+id).prop('selected','selected');
        $('.upload_form').removeClass('hide');
        $("#main_container").css('width', '55%');
        $('.upload_form').show();
        $('.category').hide();
        var val = $('.focus_btn[selection="yes"]').val();
        $('select option[value='+val+']').attr("selected",true);
    }

    $('.btn-cancel-category').click(function(){
         $('.tbl-responsive').css({ height: $(window).height()-140});
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $("#main_container").css('width', '99%');
        $('.category').hide();
        $('#add_new_category_div').hide();
    });

    $('.btn-cancel-upload').click(function(){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $("#main_container").css('width', '99%');
        $('.upload_form').hide();
        $('#set_privilege_up').hide();
    });

    function focus_btn(id){
            $('#move_category').hide();
            // $('.folder').css("font-size","35px");
            // $('.folder').removeClass('icon-folder-open');
            // $('.folder').addClass('icon-folder-close')
            $('#category_icon'+id).css("font-size","50px");
            // $('#category_icon'+id).addClass('icon-folder-open');
            $('.focus_btn').attr('selection','no');
            $('#category'+id).attr('selection','yes');
            $('#category_select option[value='+id+']').attr("selected",true);

            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
documents/archive/"+id+'/';
           
            // $('#category0').append('<input type=hidden name=folder_id value='+id+'>');
            // $('#action_common').val('5');
            // $('#common_form').submit();




                        //..............ajax old method...............//
            // $.ajax({
            //     url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
documents/archive/",
            //     type:"POST",
            //     dataType: 'json',
            //     data: { 'key':id,'action': 'category_filter' },
            //     success:function(data){
            //         // console.log(data);
            //         $('#table_body').empty();
            //         jQuery.each(data, function(index, value) {
            //                 var html = '<tr class=check>\n\
            //                 <td><input type="checkbox" name="categorys_to_move[]" onclick="checkbox_check()" value='+value.id+'></td>\n\
            //                 <td><div class=skilldocument_pdf><a href="javascript:void(0)" onclick="downloadFile(\''+value.id+'\',\''+value.file_name+'\')"">'+value.file_name+'</a></div></td>\n\
            //                 <td><div>'+value.last_name+' '+value.first_name+'</div></td>\n\
            //                 <td class=center><div>'+value.date+'</div></td>\n\
            //                 <td><div><a class="btn btn-danger span12" href="javascript:void(0);" title="Delete" onclick="deleteDocument(\''+value.id+'\', \''+value.file_name+'\')">\n\
            //                 <i class="icon-trash"></i>\n\
            //                 </a></div></td>\n\
            //                 <td class=center><div><a class="btn btn-danger span12" href="javascript:void(0);" title="Edit" onclick="editPrivilege(\''+value.id+'\', \''+value.users+'\', \''+value.id+'\',this)">\n\
            //                                                     <i class="icon-fixed-width icon-cogs"></i>\n\
            //                                                 </a></div></td>\n\
            //                 </tr>';
            //                 $('#table_body').append(html);
            //     });
            //     }
            // });
         
    }

    function delete_category(id){
        $( "#dialog-confirm_delete" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $('#action_cat').val("1");
                             $('#delete_category_id').val(id);
                            $("#category_form").submit();
                        },
                        "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                                $( this ).dialog( "close" );
                            }
                    }
            });
    }
    function checkbox_check(id){
        if($('#common_form input[type=checkbox]:checked').length > 0){
            $('#move_category').show();
            $('#option_category'+id).prop('disabled','disabled');
        }
        else{
            $('#move_category').hide();
        }
    }
    function move_category_confirm(){
        $( "#dialog-confirm_move" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $('#action_common').val('4');
                        $('#common_form').submit();
                    },
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                        $( this ).dialog( "close" );
                        $('#option_category_move').attr('selected','true');
                    }
                }
        });
    }

    function edit_category(id,elem,name){
        var element = $(elem).parent().prev();
        var root_name = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['root'];?>
';
        element.html('');
        var parent_change = '<select name = "parent_change['+id+']" style="width:206px;"><option id="parent_change_0" value="0">'+root_name+'</option></select>';
        element.append('<div  id=edit_category_div'+id+' style = "height:55px;"><input type=text value='+name+' name=edit_category>\n\
            <button class="btn btn-sm btn-success pull-right"   type="button" onclick="edit_category_save('+id+')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>\n\
            <input type=hidden name=edit_category_id id=edit_category_id value=>\n\
            <button class="btn btn-sm btn-danger pull-right " onclick="cancel_edit(\''+id+'\',\''+name+'\')"   type="button" style="margin-right:1px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>\n\
            '+parent_change+'\n\
            </div>');
        // $('#edit_category_div'+id).find('#parent_change_0')
        var category_names = <?php echo json_encode($_smarty_tpl->tpl_vars['all_category']->value);?>
;
        category_names = category_names.sort((a, b) => parseFloat(a.parent_category) - parseFloat(b.parent_category));
        // console.log(category_names);
        $.each(category_names, function (index, value) {
            if(value.parent_category == 0 ){
                $('#edit_category_div'+id).find('#parent_change_0').after('<option value ='+value.id+' id = parent_change_'+value.id+'>&nbsp&nbsp&nbsp'+value.name+'</option>');
            }
            else{
                for (var i = 0; i <index; i++) {
                    if(value.parent_category == category_names[i].id){
                         var length = $('#parent_change_'+value.parent_category).text().length;
                         var space  = "&nbsp".repeat(length);
                         $('#edit_category_div'+id).find('#parent_change_'+value.parent_category).after('<option value ='+value.id+' id = parent_change_'+value.id+'>'+space+''+value.name+'</option>');
                    }
                }
            }
        });

    }

    function cancel_edit(id,name){
        $('#edit_category_div'+id).parent().text(name);
        $('#edit_category_div'+id).remove();
        // element.text(name);
    }

    function edit_category_save(id) {
        $('#edit_id').val(id);
        $('#action_cat').val('2');
        $("#category_form").submit();
    }

    function backform(url) {
        var id_of_folder = $(".icon-folder-open").attr('id');
        if(id_of_folder == 'category_icon0'){
            window.location = url+'message/center/';
        }
        else{
            window.history.back();
        }
    }

    $('#add_new_category').click(function(event){
        event.preventDefault();
        $('#add_new_category_div').show();
        $('.tbl-responsive').css({ height: $(window).height()-292});
    });

    function goto_page(id,url){
        // console.log(id,url);
        window.location = url+'documents/archive/'+id+'/';
    }




</script>    

    </body>
</html><?php }} ?>