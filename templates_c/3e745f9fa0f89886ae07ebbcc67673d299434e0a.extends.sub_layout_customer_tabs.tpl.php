<?php /* Smarty version Smarty-3.1.8, created on 2021-02-26 15:16:44
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/sub_layout_customer_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:696760904603910dc8bbdc7-14160613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e745f9fa0f89886ae07ebbcc67673d299434e0a' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/sub_layout_customer_tabs.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
    'a1ca24c6f67ef5eddae341aced3c604529163d45' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/customer_insurance.tpl',
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
  'nocache_hash' => '696760904603910dc8bbdc7-14160613',
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
  'unifunc' => 'content_603910dcd2ff44_15348640',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603910dcd2ff44_15348640')) {function content_603910dcd2ff44_15348640($_smarty_tpl) {?><!DOCTYPE html>
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
        <div id="dialog-confirm" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
 
        <div class="row-fluid">
            <div style="" class="span12 main-left boxscroll">
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
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data('<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['fkkn']->value;?>
')"><span class="icon-print"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="2">
                                    <form name="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/insurance/<?php echo $_smarty_tpl->tpl_vars['fkkn']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
/" style="float:left;">
                                    <input type="hidden" name="username" id="username" value="<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
" />
                                    <input type="hidden" name="tdocs" id="tdocs" value="<?php echo $_smarty_tpl->tpl_vars['documents_string']->value;?>
" />
                                    <input type="hidden" name="delfile" id="delfile" value="" />
                                    <input type="hidden" name="file_count" id="file_count" value="1"/>
                                    <input type="hidden" name="new" id="new" value="<?php echo $_smarty_tpl->tpl_vars['new']->value;?>
"/>
                                    <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                   <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                <div class="span12"><div style="margin: 0px ! important;" class="widget-header span12">
                                                        <div class="pull-left">
                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_existing_data'];?>
</h1>
                                                        </div>
                                                        <div style="padding: 5px;" class="pull-right">
                                                            <button class="btn btn-default btn-normal pull-right" name="add" id="add" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
 <?php if ($_smarty_tpl->tpl_vars['fkkn']->value=='fk'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance'];?>
<?php }elseif($_smarty_tpl->tpl_vars['fkkn']->value=='kn'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['municipality'];?>
<?php }elseif($_smarty_tpl->tpl_vars['fkkn']->value=='te'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance_te'];?>
<?php }?>" type="button" onclick="addNew()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
 <?php if ($_smarty_tpl->tpl_vars['fkkn']->value=='fk'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance'];?>
<?php }elseif($_smarty_tpl->tpl_vars['fkkn']->value=='kn'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['municipality'];?>
<?php }elseif($_smarty_tpl->tpl_vars['fkkn']->value=='te'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['insurance_te'];?>
<?php }?></button>
                                                        </div>
                                                        <div class="pull-right" style="padding: 8px; margin: 0px ! important;">
                                                            <div class="input-prepend pull-right" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                <select class="form-control" id="date" name="date" onchange="selectDate()">
                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                    <?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['periods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value){
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['period']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['contract_id']->value==$_smarty_tpl->tpl_vars['period']->value['id']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['period']->value['date_from'];?>
 - <?php echo $_smarty_tpl->tpl_vars['period']->value['date_to'];?>
</option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" name="action" id="action" value=""/>
                                                            </div>
                                                        </div>
                                                       
                                                       
                                                <?php if ($_smarty_tpl->tpl_vars['fkkn']->value=='kn'||$_smarty_tpl->tpl_vars['fkkn']->value=='te'){?>
                                                <ol class="radio-group pull-left" style="margin:5px !important;">
                                                <li>   <input  type="checkbox" name="iss" id="iss" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['iss']==1){?> checked="checked" <?php }?> />
                                                <label class="label-option-and-checkbox">LSS</label></li>
                                                <li>  <input  type="checkbox" name="sol" id="sol" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['sol']==1){?> checked="checked" <?php }?> />
                                               <label class="label-option-and-checkbox">SOL</label>
                                                </li>
                                                </ol>
                                                <?php }?>
</div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="widget input-group" style="margin: 0px ! important;">
                                                            <div class="span12 widget-body-section">
                                                                <div style="" class="row-fluid">
                                                                    <div class="span4">
                                                                        <div style="margin: 0px;" class="row-fluid">
                                                                            <div id="decision" class="widget header-margin-set" style="margin: 0px 0px 15px ! important;">
                                                                                <div class="widget-header span12">
                                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['administrator_decision'];?>
</h1>
                                                                                </div>
                                                                                <div class="span12 widget-body-section input-group">
                                                                                    <div class="row-fluid">
                                                                                        <div class="span6">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dofname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dofname" id="dofname" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['first'];?>
" onblur="addLog(this,'<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['first'];?>
')" onchange="markchange()" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dolname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dolname" id="dolname" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['last'];?>
" onblur="addLog(this,'<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['last'];?>
')" onchange="markchange()" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dophone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dophone" id="dophone" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mob'];?>
" onblur="addLog(this,'<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mob'];?>
')" onchange="markchange()" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="doemail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="email" name="doemail" id="doemail" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mail'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mail'];?>
')" onchange="markchange()" /> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span6">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="docity"><?php echo $_smarty_tpl->tpl_vars['translate']->value['location'];?>
</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="docity" id="docity" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['cities'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['cities'];?>
')" onchange="markchange()" /> </div>
                                                                                            </div>
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="bidrag"><?php echo $_smarty_tpl->tpl_vars['translate']->value['granded_hours'];?>
*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="bidrag" id="bidrag" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['hour'];?>
" onchange="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onkeyup="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['hour'];?>
')" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_from'];?>
*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                                    <input class="form-control span10"  name="fromdate" type="text" class="date_pick_input" id="fromdate" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['date_from'];?>
" onchange="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onkeyup="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['date_from'];?>
')" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_to'];?>
*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                                    <input class="form-control span10" name="todate" type="text" class="date_pick_input" id="todate" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['date_to'];?>
" onchange="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onkeyup="calculate('<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
')" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['date_to'];?>
')" /> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span3">
                                                                        <div style="" class="widget-header span12">
                                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['decision_authorization_agreement'];?>
</h1>
                                                                        </div>
                                                                        <ul id="file_list" class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                                            <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['documents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
$_smarty_tpl->tpl_vars['document']->_loop = true;
?>
                                                                                <li class="list-group-item">
                                                                                    <a id="lic_1"  href="javascript:void(0)" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['document']->value['file'];?>
')"><?php echo $_smarty_tpl->tpl_vars['document']->value['name'];?>
</a>
                                                                                    <a href="javascript:void(0);"  onclick="docRemove('<?php echo $_smarty_tpl->tpl_vars['document']->value['file'];?>
')" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_file'];?>
"><i class="icon-trash"></i></a>
                                                                                </li>
                                                                            <?php }
if (!$_smarty_tpl->tpl_vars['document']->_loop) {
?>
                                                                                <li class="list-group-item"><span class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['there_are_no_files'];?>
</span></li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                        <div style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file span12 trusteeship_file_attach">
                                                                            <input type="hidden" name="log_field" id="log_field" value=""/>
                                                                            <input type="hidden" name="log_old" id="log_old" value=""/>
                                                                            <div id="file_attach" class="file_attach_row">
                                                                               <input type="file" name="file_1" id="file_1" size="12" onchange="markchange()"/>
                                                                            </div>
                                                                            <div class="row-fluid" style="margin:10px 0 0 0 !important">
                                                                                <div class="pull-left">
                                                                                    <label><a href='javascript:void(0);' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick='removeFile()' class="btn btn-danger span12"><i class="icon-trash"></i></a></label>
                                                                                </div>
                                                                                <div class="pull-left">
                                                                                    <label><a href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_new_file'];?>
" onclick="attachAnother()" class="btn btn-success span12"><i class="icon-plus"></i></a></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span5">
                                                                        <?php if ($_smarty_tpl->tpl_vars['fkkn']->value=='kn'||$_smarty_tpl->tpl_vars['fkkn']->value=='te'){?>
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin-top:0;">
                                                                                    <div class="widget-header span12">
                                                                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_administrator_behalf'];?>
</h1>
                                                                                    </div>
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <div class="row-fluid">
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_name'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="name" id="name" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_name']!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_name'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_name'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_name'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_box'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12" > <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bbox" id="bbox" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_box']!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_box'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_box'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_box'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="kn_postno"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_postno'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="kn_postno" id="kn_postno" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_postno']!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_postno'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_postno'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_postno'];?>
')" onchange="markchange()" maxlength="5" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="breference_no"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_reference_no'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="breference_no" id="breference_no" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_reference_no']!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_reference_no'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_reference_no'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_reference_no'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="address_kn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_address'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="address_kn" id="address_kn" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_address']!=''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_address'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_address'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_address'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bocity"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_city'];?>
*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bocity" id="bocity" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['kn_city']==''){?> value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['city'];?>
" <?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['customer_kn_details']->value['kn_city'];?>
" <?php }?> onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['city'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style="margin: 10px 0px;" class="widget-header span12">
                                                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['night'];?>
</h1>
                                                                                        </div>
                                                                                        <input class="check-box" type="checkbox" name="oncall" id="oncall" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emergency'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="awake" id="awake" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['awake']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['awake'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['alert'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="oncall2" id="oncall2" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall2']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall2'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['preparedness'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="something" id="something" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['something']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['something'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }else{ ?>
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin-top:0;">
                                                                                    <div class="widget-header span12">
                                                                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['administrator_behalf'];?>
</h1>
                                                                                    </div>
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <div class="row-fluid">
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bofname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="bofname" id="bofname" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['first_name'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['first_name'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bophone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bophone" id="bophone" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mobile'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['mobile'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bocity"><?php echo $_smarty_tpl->tpl_vars['translate']->value['location'];?>
</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bocity" id="bocity" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['city'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['city'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bolname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bolname" id="bolname" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['last_name'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['last_name'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="boemail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="boemail" id="boemail" value="<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['email'];?>
" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['email'];?>
')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style="margin: 10px 0px;" class="widget-header span12">
                                                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['night'];?>
</h1>
                                                                                        </div>
                                                                                        <input class="check-box" type="checkbox" name="oncall" id="oncall" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emergency'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="awake" id="awake" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['awake']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['awake'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['alert'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="oncall2" id="oncall2" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall2']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['oncall2'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['preparedness'];?>
</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="something" id="something" value="1" <?php if ($_smarty_tpl->tpl_vars['contract_details']->value[0]['something']=="1"){?> checked="checked" <?php }?> onclick="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['something'];?>
')" /><span style="margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="row-fluid">
                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                                                                    <div id="houres" style="background: none repeat scroll 0% 0% rgb(255, 255, 226); border: 1px solid rgb(246, 246, 171);" class="span12 widget-body-section">
                                                                                        <ul class="time-date-info">
                                                                                            <li>
                                                                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>

                                                                                                <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['no_of_days']->value;?>
</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly'];?>

                                                                                                <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['monthly_hrs']->value;?>
</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['weekly'];?>

                                                                                                <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['weekly_hrs']->value;?>
</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['granded_hours'];?>

                                                                                                <div class="pull-right"><?php echo $_smarty_tpl->tpl_vars['hrs']->value;?>
</div>
                                                                                            </li>

                                                                                            <li>
                                                                                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['remaining_hours'];?>

                                                                                                <div class="pull-right" <?php if ($_smarty_tpl->tpl_vars['remaining_hrs']->value<0){?>style="color: red;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['remaining_hrs']->value;?>
</div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin-left: 0px;" class="span12">
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin: 0px ! important;">
                                                                                    <!--WIDGET BODY BEGIN-->
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <label style="margin-left: 0px;" class="span12" for="comhours"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comment_decision_hour'];?>
</label>
                                                                                        <textarea rows="1" class="form-control span12" name="comhours" id="comhours" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['comments_time'];?>
')" onchange="markchange()"><?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['comments_time'];?>
</textarea>

                                                                                        <label style="margin-left: 0px;" class="span12" for="comdecision"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comment_decision_management_others'];?>
</label>
                                                                                        <textarea rows="1" class="form-control span12" name="comdecision" id="comdecision" onblur="addLog(this, '<?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['comments_other'];?>
')" onchange="markchange()"><?php echo $_smarty_tpl->tpl_vars['contract_details']->value[0]['comments_other'];?>
</textarea>
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
<script type="text/javascript">
$(document).ready(function(){
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-254});
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
    

});
</script>
<script language="javascript">
            var change = 0; 
            $(document).ready(function () { 
                $(".side_links li a").click(function(event){
                event.preventDefault();
                var href_val = $(this).attr('href');
                if(change == 1){
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
                                        document.location.href = href_val;
                                }
                            }
                    });
                }
                else{
                    document.location.href = href_val;
                }
             });
             
            /*$( "#fromdate, #todate" ).datepicker({
                showOn: "button",
                dateFormat: "yy-mm-dd",
                buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
                buttonImageOnly: true
            });*/
            $(".datepicker").datepicker({
                    autoclose: true,
                    weekStart: 1,
                    calendarWeeks: true, 
                    language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
            });
  
               
            });
           
function markchange(){
    change = 1;
    $("#new").val("1");
}
function attachAnother() {
    markchange();
    var file_count = parseInt($('#file_count').val()) + 1;
    $('#file_count').val(file_count);
    $('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' /></div>");
}
function removeFile(id){
    markchange();
    var id = $('#file_count').val();
    var file_count = parseInt(id) - 1;
    $('#file_count').val(file_count);
    $('div').remove('.file_attach_row' + id);
}
function calculate(username) {
    markchange();
    var hours = $('#bidrag').val();
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    
    //wrapLoader('div#houres');

    $("#houres").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_contract_hours.php?hours=" + hours + "&sdate=" + date_from + "&edate=" + to_date + "&customer=" + username + "&fkkn=<?php echo $_smarty_tpl->tpl_vars['fkkn']->value;?>
");
    
}
function checkDates(){
    var check_date = "";
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    var user = $("#username").val();
    var hours = $('#bidrag').val();
    //var user_id = $("#user_id").val();
    if(hrs != "" & date_from != "" & date_to != "")
    {
        $.ajax({
            async:false,
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_cust_contract_check_date.php",
            data:"date_from="+date_from+"&date_to="+to_date+"&hrs="+hours+"&user="+user,
            type:"POST",
            success:function(data){
                check_date = data;
                if(data != "")
                {
                    $("#err_msg").html(data);
                    $("#err_msg").addClass("message");
                }
                else
                {
                    $("#err_msg").html("");
                    $("#err_msg").removeClass("message");
                }                        
            }
        });
                //alert(check_date);
        if(check_date != "")
            return false
        else return true;
    }
}

function saveForm() {
    var error = 0;
    
    $('#action').val('save');
    if($("#bidrag").val() == ""){
       
        $("#bidrag").addClass("error"); 
        error = 1;
        
    }else{
        $("#bidrag").removeClass("error"); 
    }
    if($("#fromdate").val() == ""){
        $("#fromdate").addClass("error");
        error = 1;
    }else{
        $("#fromdate").removeClass("error"); 
    }
    if($("#todate").val() == ""){
       $("#todate").addClass("error");
       error = 1;
    }else{
        $("#todate").removeClass("error"); 
    }
    <?php if ($_smarty_tpl->tpl_vars['fkkn']->value=="kn"||$_smarty_tpl->tpl_vars['fkkn']->value=='te'){?>
    
        if($("#name").val() == ""){
            $("#name").addClass("error");
            error = 1;
        }else{
            $("#name").removeClass("error");
        }
        
        if($("#breference_no").val() == ""){
            $("#breference_no").addClass("error");
            error = 1;
        }else{
            $("#breference_no").removeClass("error");
        }
        if($("#kn_postno").val() == ""){
           $("#kn_postno").addClass("error");
           error = 1;
        }else{
            var postno = $("#kn_postno").val();
            if(isNaN(postno)){
                $("#kn_postno").addClass("error");
                $("#error1").html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['give_numeric_value'];?>
');
            }else if(postno.length != 5){
                $("#kn_postno").addClass("error");
                $("#error1").html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['give_five_numeric_characters'];?>
');
            }else{
                $("#kn_postno").removeClass("error");
                $("#error1").html('');
            }
        }
        if($("#bocity").val() == ""){
            $("#bocity").addClass("error");
            error = 1;
        }else{
            $("#bocity").removeClass("error");
        }
        if($("#bbox").val() == '' && $("#address_kn").val() == ""){ 
            $("#bbox").addClass("error");
            $("#address_kn").addClass("error");
           error = 1;
        }else{
             $("#bbox").removeClass("error");
             $("#address_kn").removeClass("error");
        }
    <?php }?>

    if($("#bidrag").val() != "" && $("#fromdate").val() != "" && $("#ftodate").val() != "" && error == 0) {    
        $('#form').submit();
    }
}
function selectDate() {
   $('#action').val('dates');
   $('#form').submit();
}

function print_data(username,fkkn){
    var date=document.getElementById('date').value;
    
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_customer_insurance.php?username="+username+"&fkkn="+fkkn+"&date="+date+'&_'+Date.now());
 }

function docRemove(docs) { 
    markchange()
    var old_docs = $('#tdocs').val();
    var del_file = $('#delfile').val();
    
    var doc_array = old_docs.split(",");
    for(var i=0; i < doc_array.length; i++) {
        if(doc_array[i] == docs) {
            doc_array.splice(i, 1);
            break;
        }
    }
    var new_array = doc_array.toString();
    $('#tdocs').val(new_array);
    
    wrapLoader('#file_list');
    $("#file_list").load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_attatchments_insurence.php?docs='+ new_array, function(){ uwrapLoader('#file_list');});
}
            
function addLog(val,old) {
                if(val.value != old)
                {
                    markchange();
                    var tmp = document.getElementById("log_field").value.split(val.name);
                    if(tmp[1] == "" || tmp[1] == undefined)
                    {
                        document.getElementById("log_old").value = document.getElementById("log_old").value + old + ";";
                        document.getElementById("log_field").value = document.getElementById("log_field").value + val.name + ";";
    }
                }
            }
function resetForm() {
    $('#action').val('');
    $('#form').submit();
}
function backForm() {
    //document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/customer/<?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/';
    window.history.back();
}
function addNew() {
    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/insurance/<?php echo $_smarty_tpl->tpl_vars['fkkn']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
/new/";
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
");
    if(redirectURL != ''){
        var new_var = $("#new").val();
        if(new_var == "new" || change == 1){
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



function downloadFile(filename){
    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
}


</script>

    </body>
</html><?php }} ?>