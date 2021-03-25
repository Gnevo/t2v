<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 12:25:24
         compiled from "/home/time2view/public_html/cirrus/templates/employee_administration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4287635885fcb7c340c2807-40789639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf441b73cc78d53dfa02406f12c48cba0693b820' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/employee_administration.tpl',
      1 => 1589256278,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4287635885fcb7c340c2807-40789639',
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
  'unifunc' => 'content_5fcb7c3493cb39_30969993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb7c3493cb39_30969993')) {function content_5fcb7c3493cb39_30969993($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_checkboxes')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_checkboxes.php';
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
        
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/employee-profile.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
        .downFile{ text-overflow: ellipsis; overflow: hidden; white-space: nowrap; display: block; }
        .terms_section { font-size: 12px; padding: 4px 2px 0px 0px; }
        .btn-precise{
            padding : 5px !important;
            margin  : 5px !important;
        }
        table tbody tr td > .day-report{ height: auto !important;}
        #day_wrapper .toggler-class:before{ content: "\f077"; }
        #day_wrapper .collapsed .toggler-class:before { content: "\f078"; }
        #email_option{ margin: 0 0 10px; border: thin solid #ccc}
        #email_option dt{ background: #ddd; padding: 5px;}
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
                                
    <div id="dialog-confirm" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>
    </div>
    <div id="dialog-confirm_delete" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm'];?>
" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
</p>
    </div>
    <div id="dialog-confirm_pass" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_enter_your_password'];?>
" style="display:none;">
        <p style="margin-left: 10px"><br> <form style="margin-left: 10px"><input type="password" name="pass1" id="pass1" value=""></input></form></p>
</div>
<div id="dialog" title="" style="display:none;">
    <p style="margin-left: 40px; margin-top: 40px; font-size: 22px; color: red;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sorry_wrong_password'];?>
</p>
</div>
<div id="dialog_popup" style="display:none;"></div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
<div class="row-fluid">
    <form id="form" name="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/">
        <input type="hidden" name="tab" id="tab"  value="<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
" />
        <input type="hidden" name="work" id="work"  <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['works']){?> value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['works'];?>
" <?php }else{ ?> value=""<?php }?>/>
        <input type="hidden" name="rand_pass" id="rand_pass"  value="<?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
" />
        <input type="hidden" name="team" id="team"  value="<?php echo $_smarty_tpl->tpl_vars['current_team']->value[0]['id'];?>
" />
        <input type="hidden" name="cur_team" id="cur_team" value="<?php echo $_smarty_tpl->tpl_vars['current_team']->value[0]['id'];?>
" />
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
" />
        <input type="hidden" name="cur_role" id="cur_role" value="<?php echo $_smarty_tpl->tpl_vars['employee_role']->value;?>
" />
        <input type="hidden" name="global_check" id="global_check" value="0" />
        <div style="width: 99%; margin-left: 0px;" class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="saveForm()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                        <button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button" onclick="resetForm()><span class="icon-pencil"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_edit_employee_personal'];?>
</button>
                        <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                    <div id="error_pass" style="color: red"></div>
                </div>
                <div class="row-fluid">
                    <div class="span4" style="">
                        <div style="margin: 0px;" class="widget">
                            <div class="widget-header span12">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_information'];?>
</h1>
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group exception">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span12" style="margin: 5px 0px 0px;">
                                            <label style="float: left;" class="span12" for="social_security"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
*</label>
                                            <div style="margin-left: 0px; float: left;">
                                                <div class="input-prepend span12 hasDatepicker">
                                                    <span class="add-on icon-pencil"></span>
                                                    <select class="form-control span3 non_editable" name="century" id="century" readonly="readonly">
                                                        <option value="19" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['century']==19){?> selected="selected" <?php }?> >19</option>
                                                        <option value="20" <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['century']==20){?> selected="selected" <?php }?> >20</option>
                                                    </select>
                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['social_security'];?>
" class="form-control span7 non_editable" name="social_security" id="social_security" type="text" maxlength="11" onchange="makeChange()" style="margin-left: 2px;" readonly="readonly" /> 
                                                    <input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['social_security_check']->value){?>1<?php }?>" id="social_flag" name="social_flag">
                                                </div>
                                                <div id="soc_sec" style="color: red"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 0px; margin: 0px;" class="span6 form-left">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="first_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> 
                                            <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name'];?>
" class="form-control span10 non_editable" name="first_name" id="first_name" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="code"><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input <?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['code']){?> value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['code'];?>
"<?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['emp_code']->value;?>
"<?php }?> class="form-control span10 non_editable" name="code" id="code" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="post"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['post'];?>
" class="form-control span10" id="post" name="post" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['phone'];?>
" class="form-control span10" id="phone" name="phone" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['email'];?>
" class="form-control span10" id="email" name="email" type="email" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                </div>
                                <div style="" class="span6 form-right">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="last_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> 
                                            <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name'];?>
" class="form-control span10 non_editable" name="last_name" id="last_name" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['address'];?>
" class="form-control span10" name="adress" id="adress" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['city'];?>
" class="form-control span10" id="city" name="city" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['mobile'];?>
" class="form-control span10" id="mobile" name="mobile" maxlength="17" type="text" onchange="makeChange()" /> 
                                            <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                        </div>
                                        <div id="mobs" style="color: red"></div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_of_joining'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input value="<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value){?><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['date'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['today']->value;?>
<?php }?>" class="form-control span10 non_editable" id="date" name="date" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                </div>
                                <div class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="txt_ice"><?php echo $_smarty_tpl->tpl_vars['translate']->value['ice'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend span12">
                                        <textarea class="form-control span12" id="txt_ice" name="txt_ice"><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['ice'];?>
</textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="margin: 0px ! important;" class="widget exception">
                                <div class="widget-header span12">
                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['account_information'];?>
</h1>
                                </div>
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section input-group">
                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" > <span class="add-on icon-pencil"></span>
                                            <input class="form-control span10 non_editable" type="text" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
" id="username" name="username" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker">
                                            <div id="pass"><button type="button" onclick="generate_password()" id="password" name="password" class="btn btn-default btn-normal" onchange="makeChange()" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
</button></div>
                                            <input type="hidden" id="action" value="" name="action"/>
                                        </div>
                                    </div>
                                </div>
                                <!--WIDGET BODY END-->
                            </div>
                            <!--WIDGET BODY END-->
                        </div>
                        <div class="row-fluid">
                        </div>
                    </div>
                    <div class="span4" style="">
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span4 day-slot-wrpr-header-left span6">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-upload-document" style="margin: 0px 5px;" type="button"><span class="icon-upload"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-documentaion-height-fix">
                                        <div class="row-fluid" id="document_upload" style="display: none;">
                                            <div class="span12 upload-document-visible" style="margin-left: 0px;">
                                                <div style="margin: 0px ! important;" class="widget">
                                                    <form method="post" action="" name="form"></form>
                                                    <form method="post" name="doc_form" action="" enctype="multipart/form-data">
                                                        <div style="" class="widget-header span12">
                                                            <div class="span5 day-slot-wrpr-header-left span6">
                                                                <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</h1>
                                                            </div>
                                                            <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                                                <button class="btn btn-default btn-normal pull-right btn-upload-file" name="save_doc" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                                                <button class="btn btn-default btn-normal  pull-right btn-cancel-upload btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                                                            </div>
                                                        </div>
                                                        <div class="span12 widget-body-section input-group email-list-box">
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin:0">
                                                                    <div style="background: none repeat scroll 0px center transparent; margin: 0px ! important; padding: 0px;" class="btn btn-default btn-file">
                                                                        <span style="margin-right: 8px;" class="fileupload-new">Select file</span>
                                                                        <input class="margin-none span9 chrome_pad" type="file" name="file" style="line-height: 0;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                          </div>
                                        </div>
                                        <!-- Document upload end -->




                                        <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['documents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
$_smarty_tpl->tpl_vars['document']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['document']->value['status']==1){?>
                                            <div class="row-fluid">
                                                <div class="span12 profile-documentaion-list">
                                                    <div class="row-fluid">
                                                        <div class="span12 profile-documentation-list-header">
                                                         <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['document']->value['alloc_emp']==$_tmp1){?> 
                                                          <a href="javascript:void(0);" class="btn btn-default btn-normal pull-right" onclick="delAttachment('<?php echo $_smarty_tpl->tpl_vars['document']->value['id'];?>
')"><i class="icon-remove"></i></a>
                                                          <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 profile-documentation-list-left">
                                                            <ul>
                                                                <li><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['document'];?>
</strong></li>
                                                                <li><a href="javascript:void(0)" class="downFile" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['document']->value['documents'];?>
')" title="<?php echo $_smarty_tpl->tpl_vars['document']->value['documents'];?>
"><?php echo $_smarty_tpl->tpl_vars['document']->value['documents'];?>
</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="span6 profile-documentation-list-right">
                                                            <ul>
                                                                <li><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['dates'];?>
</strong></li>
                                                                <li><?php echo $_smarty_tpl->tpl_vars['document']->value['date'];?>
</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <?php }
if (!$_smarty_tpl->tpl_vars['document']->_loop) {
?>
                                            <div class="row-fluid">
                                                <div class="span12 profile-documentaion-list">
                                                    <div class="row-fluid">
                                                        
                                                            <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>

			</div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div class="widget-header span12">
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h1>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-customer-height-fix">
                                       
                                       
                                       
                                       
                                       
                                     
                                                             
                                       
                                       
                                     
                              
<?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
<div class="span12 child-slots-profile-two">
<span><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
</span>
<span class="slots-position pull-right">
    <?php if ($_smarty_tpl->tpl_vars['customer']->value['role']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>

    <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['role']==7){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>

    <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['role']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>

    <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['role']==1||$_smarty_tpl->tpl_vars['customer']->value['role']==6){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>

    <?php }?>

</span>
</div>
<?php } ?>

                                               
                                    
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4" style="">
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span4 day-slot-wrpr-header-left">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['education'];?>
</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                            <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="printSkill()"><i class="icon-print"></i></button>
                                            <button class="btn btn-default btn-normal pull-right btn-addskill" style="margin: 0px 5px;" type="button"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_skill'];?>
</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-documentaion-height-fix">
                                       
                                      <div class="row-fluid" id="add_new_skill" style="display: none;margin-bottom: 10px;">
                                        <div class="span12 " style="margin-left: 0px;">
                                            <form name="form" id="form" method="post" action="" enctype="multipart/form-data">
                                                <div style="margin: 0px ! important;" class="widget">
                                                    <div style="" class="widget-header span12">
                                                        <div class="span5 day-slot-wrpr-header-left span6">
                                                            <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['skill'];?>
</h1>
                                                        </div>
                                                        <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                                            <button class="btn btn-default btn-normal pull-right btn-addnew-skill" name="add_skills" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                                            <button class="btn btn-default btn-normal pull-right btn-cancel-addskill  btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                                                        </div>
                                                    </div>
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group email-list-box">
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;" class="span12" for="skills"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skill'];?>
</label>
                                                                <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                                                    <input class="form-control span10 non_editable" type="text" name="skills" id="skills" /> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;" class="span12" for="description"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
</label>
                                                                <textarea class="form-control span12 non_editable" name="description" id="description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;margin-bottom: 5px;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</label>
                                                                <div id="attachment1"><input type="file" name="file[]" id="file1"  style="line-height:0;"> </div>
                                                                <div id="attachment2"><input type="file" name="file[]" id="file2" style="line-height:0;"></div>
                                                                <div id="attachment3"><input type="file" name="file[]" id="file3" style="line-height:0;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--WIDGET BODY END-->
                                                </div>
                                            </form>
                                        </div>
                                     </div>


                                        <?php  $_smarty_tpl->tpl_vars['skil'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['skil']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skills']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['skil']->key => $_smarty_tpl->tpl_vars['skil']->value){
$_smarty_tpl->tpl_vars['skil']->_loop = true;
?>
                                            <dl class="profile-education-list" id="edit_skill_main<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
">
                                                <dt>

                                                 <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['skil']->value['alloc_emp']==$_tmp2){?>  <a href="javascript:void(0);"  title="Edit" id="skill_title<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
"   onclick="toggle_edit('<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
')" style="text-decoration: underline;"> <?php }?> <?php echo $_smarty_tpl->tpl_vars['skil']->value['skill'];?>
</a>
                                          
                                                <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['skil']->value['alloc_emp']==$_tmp3){?>
                                                    <a href="javascript:void(0);" onclick="delSkill('<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
')"  class="btn btn-default btn-normal pull-right"><i class="icon-remove"></i></a>
                                                <?php }?>
                                                </dt>
                                                <?php  $_smarty_tpl->tpl_vars['descr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['descr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skil']->value['description']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['descr']->key => $_smarty_tpl->tpl_vars['descr']->value){
$_smarty_tpl->tpl_vars['descr']->_loop = true;
?>
                                                    <dd id="skill_description<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['descr']->value['desc'];?>
</dd>
                                                <?php } ?>
                                                <?php if ($_smarty_tpl->tpl_vars['skil']->value['attachment1']!=''||$_smarty_tpl->tpl_vars['skil']->value['attachment2']!=''||$_smarty_tpl->tpl_vars['skil']->value['attachment3']!=''){?>
                                                    <dd style="text-indent: 0px;margin-left: 10px;">
                                                    <?php if ($_smarty_tpl->tpl_vars['skil']->value['attachment1']!=''){?>
                                                        <label title="<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment1'];?>
" class="text_overflow" id="attachment1<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
" onclick="download_skill('<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment1'];?>
')" >
                                                                <i class="icon icon-download"></i><?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment1'];?>

                                                        </label>
                                                        </br>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['skil']->value['attachment2']!=''){?>
                                                        <label title="<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment2'];?>
" class="text_overflow" id="attachment2<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
" onclick="download_skill('<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment2'];?>
')">
                                                                <i class="icon icon-download"></i><?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment2'];?>

                                                        </label>
                                                        </br>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['skil']->value['attachment3']!=''){?>
                                                        <label title="<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment3'];?>
" class="text_overflow" id="attachment3<?php echo $_smarty_tpl->tpl_vars['skil']->value['id'];?>
" onclick="download_skill('<?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment2'];?>
')">
                                                                <i class="icon icon-download"></i><?php echo $_smarty_tpl->tpl_vars['skil']->value['attachment3'];?>

                                                        </label>    
                                                        </br>
                                                    <?php }?>
                                                    </dd>
                                                <?php }?>
                                            </dl>
                                            
                                         

                                        <?php }
if (!$_smarty_tpl->tpl_vars['skil']->_loop) {
?>
                                        <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>

			</div>
                                          <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span12">
                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                    <div class="widget-header span12">
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['email_option'];?>
</h1>
                                    </div>
                                    <div class="span12 widget-body-section input-group widget-body-profile-customer-height-fix">
                                         <dl id="email_option">
                                            <dt><?php echo $_smarty_tpl->tpl_vars['translate']->value['email_option'];?>
</dt>
                                            <dd style="text-indent: 0px;margin-left: 10px;">
                                                <div class="form-check">
                                                    <div class="row-fluid">
                                                        <label>
                                                        <input type="checkbox" value="25"   name="email_option[]" id="email_check_emp_profile" <?php if (in_array(25,$_smarty_tpl->tpl_vars['selected_email_options']->value)){?> checked="checked" <?php }?> >
                                                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>

                                                        </label>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <label>
                                                        <input type="checkbox" value="27" name="email_option[]" id="email_check_emp_preferred_time"  <?php if (in_array(27,$_smarty_tpl->tpl_vars['selected_email_options']->value)){?> checked="checked" <?php }?> >
                                                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_non_preferred_time'];?>

                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6" style="">
                        <div style="margin: 0px;" class="widget">
                            <div class="widget-header span12">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_administration_contract_head'];?>
</h1>
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group widget-body-arvode-height-fix">
                                <dl class="profile-education-list">
                                    <dt><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_sign'];?>
</dt>
                                    <?php  $_smarty_tpl->tpl_vars['contract'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contract']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contracts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contract']->key => $_smarty_tpl->tpl_vars['contract']->value){
$_smarty_tpl->tpl_vars['contract']->_loop = true;
?>
                                        <dd>
                                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['Signed_documents'];?>
<a id="contract_<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
" href="javascript:void(0);" onclick="contractDownload('<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
')" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_to_show'];?>
" style="text-decoration: underline;text-shadow: 1px 0 0 #1a0dab;"><?php echo $_smarty_tpl->tpl_vars['contract']->value['customer_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['contract']->value['alloc_date'];?>
</a>
                                            <?php if ($_smarty_tpl->tpl_vars['contract']->value['sign_date']==null||$_smarty_tpl->tpl_vars['contract']->value['alloc_date']==''){?>
                                                <input class="btn btn-default pull-right btn-danger btn-sign icon icon-thumbs-up-al" type="button" name="sign_<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
" id="sign_<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
" onclick="signContract('<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
')" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sign'];?>
" />
                                            <?php }else{ ?>
                                                <span style="margin-right: 5px;" class="label label-success pull-right"><span class="icon-thumbs-up-alt"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['signed'];?>
</span>
                                            <?php }?>

                                            <?php if ($_smarty_tpl->tpl_vars['contract']->value['sign_date']==null||$_smarty_tpl->tpl_vars['contract']->value['alloc_date']==''){?><div class="terms_section"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['signing_button_agree_company_rules_and_terms'];?>
</i></div><?php }?>
                                        </dd>
                                    <?php }
if (!$_smarty_tpl->tpl_vars['contract']->_loop) {
?>
                                        <dd>
                                            <div class="alert alert-primary">
                                				<strong><i class="icon-question-sign"></i></strong> <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>

                                			</div>
                                       </dd>
                                    <?php } ?>
                                    <form>
                                        <input type="hidden" name="contract_ids" id="contract_ids" value="<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
" />
                                    </form>
                                </dl>
                                <dl class="profile-education-list">
                                    <dt>
                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['normal_effect_from'];?>

                                    <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span10" onchange="load_salary()" name="normal_select" id="normal_select">
                                            <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['dates'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dates']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_normal_dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dates']->key => $_smarty_tpl->tpl_vars['dates']->value){
$_smarty_tpl->tpl_vars['dates']->_loop = true;
?>
                                                <option <?php if ($_smarty_tpl->tpl_vars['dates']->value['id']==$_smarty_tpl->tpl_vars['normal_last_id']->value){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['dates']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['dates']->value['effect_from'];?>
</option> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                    </dt>
                                    <dt>
                                    <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                    <?php if ($_smarty_tpl->tpl_vars['normal_salaries']->value['effect_to']=='0000-00-00'){?><?php }else{ ?> - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['effect_to'];?>
<?php }?><br/>
                                    <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['effect_from'];?>

                                </div>
                                </dt>
                                <?php if ($_smarty_tpl->tpl_vars['employee_normal_dates']->value){?>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['normal'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['travel'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['week_end_travel'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['week_end_travel'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['break'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['overtime'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['quality_overtime'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['more_time'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['some_other_time'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['training_time'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['call_training'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['personal_meeting'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['voluntary'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['complementary'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['complementary_oncall'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['more_oncall'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['standby'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['standby'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['w_dismissal'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['w_dismissal_oncall'];?>
</dd>
                                    
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday_big'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['holiday_big'];?>
</dd>
                                    <dd><?php echo (($_smarty_tpl->tpl_vars['translate']->value['holiday_big']).(' ')).($_smarty_tpl->tpl_vars['translate']->value['oncall']);?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['holiday_big_oncall'];?>
</dd>
                                    <dd><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['holiday_red'];?>
</dd>
                                    <dd><?php echo (($_smarty_tpl->tpl_vars['translate']->value['holiday']).(' ')).($_smarty_tpl->tpl_vars['translate']->value['oncall']);?>
 - <?php echo $_smarty_tpl->tpl_vars['normal_salaries']->value['holiday_red_oncall'];?>
</dd>
                                <?php }else{ ?>
                                    <dd>
                                    
                                     <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong> <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>

			</div> </dd>
                                <?php }?>
                            </dl>
                            <div class="clearfix"></div>
                            <dl class="profile-education-list">
                                <dt><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_effect_from'];?>

                                <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span10" onchange="load_salary()" name="inconv_select" id="inconv_select">
                                        <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                        <?php  $_smarty_tpl->tpl_vars['inconv_dates'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['inconv_dates']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_inconvenient_dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['inconv_dates']->key => $_smarty_tpl->tpl_vars['inconv_dates']->value){
$_smarty_tpl->tpl_vars['inconv_dates']->_loop = true;
?>
                                            <option <?php if ($_smarty_tpl->tpl_vars['inconv_last_id']->value==$_smarty_tpl->tpl_vars['inconv_dates']->value['id']){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['inconv_dates']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['inconv_dates']->value['effect_from'];?>
</option>
                                        <?php } ?>         
                                    </select>
                                </div>
                                </dt>
                                <dt>
                                <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                <?php if ($_smarty_tpl->tpl_vars['effects']->value['effect_to']=='0000-00-00'){?><?php }else{ ?> - <?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_to'];?>
<?php }?><br/>
                                <?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_from'];?>

                            </div>
                            </dt>
                            <?php if ($_smarty_tpl->tpl_vars['employee_inconvenient_dates']->value){?>
                                <?php  $_smarty_tpl->tpl_vars['salaries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['salaries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inconveninet_salaries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['salaries']->key => $_smarty_tpl->tpl_vars['salaries']->value){
$_smarty_tpl->tpl_vars['salaries']->_loop = true;
?>
                                    <dd>
                                        <?php echo $_smarty_tpl->tpl_vars['salaries']->value['name'];?>

                                        <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['salaries']->value['amount'];?>
</span>
                                    </dd>
                                <?php } ?>
                            <?php }else{ ?>
                                <dd>
                                <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>

			</div>
                                </dd>
                                <?php }?>
                        </dl>
                    </div>
                    <!--WIDGET BODY END-->
                </div>
                <div class="row-fluid">
                </div>
            </div>
            <div class="span6" gdhgdfghfd>

                <div style="margin: 0px;" class="widget">
                    <div class="widget-header span12">
                        <div class="span6">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_non_preferred_time'];?>
</h1>
                        </div>
                        <div class="span6">

                            <button type="button" class="btn btn-default btn-precise btn-add-new pull-right mr">
                                <span class="icon-plus"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_addnew'];?>

                            </button>
                            <button id="save_btn" class="btn btn-default btn-normal btn-precise pull-right mr"   type="button" onclick="handleTimeInterval()" style="display: none;"><i class=' icon-save'></i><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_save'];?>
</button>
                            <button id="close_btn" class="btn btn-default btn-normal btn-precise pull-right mr  btn-cancel-right" type="button" style="display: none;"><i class='icon-power-off'></i><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_close'];?>
</button>
                        </div>
                    </div>
                    <form method="post">
                    <div class="widget-header span12" style="margin-top: 3px !important; margin-left: 0px !important; padding-top: 5px;">
                        
                        <span style="padding-left: 4px; margin-top: 3px !important; float: left;"><input class="non_editable" type="radio" name="pref_selection" value="1" <?php if ($_smarty_tpl->tpl_vars['preference_mode']->value==1){?>checked = "checked"<?php }?> onclick="this.form.submit()"></span>
                        <span style="padding-left: 4px; float: left;<?php if ($_smarty_tpl->tpl_vars['preference_mode']->value==1){?>font-weight: bold;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['translate']->value['preferred_time'];?>
</span>
                        <span style="margin-top: 3px !important; float: left; margin-left:10px;"><input class="non_editable" type="radio" name="pref_selection" value="0" <?php if ($_smarty_tpl->tpl_vars['preference_mode']->value==0){?>checked = "checked"<?php }?> onclick="this.form.submit()"></span>
                        <span style="padding-left: 4px; float: left;<?php if ($_smarty_tpl->tpl_vars['preference_mode']->value==0){?>font-weight: bold;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['translate']->value['non_preferred_time'];?>
</span>
                        
                    </div>
                    </form>
                    <!--WIDGET BODY BEGIN-->
                    <div class="span12 widget-body-section input-group widget-body-arvode-height-fix">
                        <div class="span12 " id="new_non_prefered_time" style="display: none;">
                            <div class="widget">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_non_preferred_time'];?>
</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                                        
                                    </div>
                                    <div class="span12 widget-body-section input-group">
                                        <div class="span6">
                                            <div class="row-fluid" id="error_message">
                                            </div>
                                            <div class="row-fluid span12">
                                                <div class="span12">
                                                        <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from_date'];?>
</label>
                                                </div>
                                                <div class="span12 no-ml">
                                                    <input type="text" class="datepicker span12"  id="from_date" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="row-fluid sapn12">
                                                <div class="span12">
                                                    <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to_date'];?>
</label>
                                                </div>
                                                <div class="span12 no-ml">
                                                    <input type="text" class="datepicker span12" id="to_date" autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="row-fluid sapn12">
                                                <div class="span12">
                                                    <input type="checkbox" id="copy_to_week">
                                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['non_prefered_copy_to_week'];?>

                                                </div>
                                                <div class="span12 no-ml" id="copy_to_week_times" style="display: none;">
                                                    <div class="span12 row-fluid">
                                                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                        <div class="span2"><input type="text" id="from_date_week"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                        <div class="span2"><input type="text" id="to_date_week" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                        <div class="span2"><button id="set_copy_time" class="btn btn-primary" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['non_prefered_set'];?>
</button></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="group_id" value="">
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid mt" id="day_wrapper">
                                                <div class="row-fluid day-show"  id="day_show1">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day1" aria-expanded="false" aria-controls="day1"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[0]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day1">
                                                        <div class="panel-body span12" data-day="1">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show2">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day2" aria-expanded="false" aria-controls="day2"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[1]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day2">
                                                        <div class="panel-body span12" data-day="2">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show3">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day3" aria-expanded="false" aria-controls="day3"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[2]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day3">
                                                        <div class="panel-body span12" data-day="3">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show4">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day4" aria-expanded="false" aria-controls="day4"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[3]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day4">
                                                        <div class="panel-body span12" data-day="4">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show5">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day5" aria-expanded="false" aria-controls="day5"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[4]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day5">
                                                        <div class="panel-body span12 " data-day="5">
                                                            <div class="span12 row-fluid interval-div" >
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show6">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day6" aria-expanded="false" aria-controls="day6"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[5]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day6" >
                                                        <div class="panel-body span12 " data-day="6">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show7">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day7" aria-expanded="false" aria-controls="day7"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[6]['day']];?>
<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day7">
                                                        <div class="panel-body span12" data-day="7">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
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
                        <div class="span12 widget-body-section input-group" id="saved_non_preferd_time">
                            <div id="inconve_message_wraper" class="span12 no-min-height no-ml"></div>
                            <div class="table-responsive span12 no-ml">
                                <table id="non_preferd_time_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;" class="table-col-center">#</th>
                                            <th style="width: 10em;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_range'];?>
</th>
                                            <th style="width: 25em;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['timing'];?>
</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['prev_day'] = new Smarty_variable('', null, 0);?>
                                        <?php  $_smarty_tpl->tpl_vars['date_range'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['date_range']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderdAllNonPreferedTime']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['date_range']->key => $_smarty_tpl->tpl_vars['date_range']->value){
$_smarty_tpl->tpl_vars['date_range']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['date_range']->key;
?>
                                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                            <tr>
                                                <td style="width: 20px;" class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td>
                                                <td class="center"><?php echo $_smarty_tpl->tpl_vars['date_range']->value[0]['date_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['date_range']->value[0]['date_to'];?>
</td>
                                                <td>
                                                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['date_range']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['prev_day']->value!=$_smarty_tpl->tpl_vars['value']->value['day']){?>
                                                            <?php if ($_smarty_tpl->tpl_vars['prev_day']->value!=$_smarty_tpl->tpl_vars['value']->value['day']&&$_smarty_tpl->tpl_vars['key']->value!=0){?></div><?php }?>

                                                            <div class="day-report" style="width:auto;">
                                                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[$_smarty_tpl->tpl_vars['value']->value['day']-1]['day']];?>

                                                                    
                                                                </h1>
                                                                <?php echo $_smarty_tpl->tpl_vars['value']->value['time_from'];?>
-<?php echo $_smarty_tpl->tpl_vars['value']->value['time_to'];?>

                                                                <a href="javascript:void(0);" onclick="handleSingleDelete(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)">
                                                                        <i class="icon-remove ml mr"></i>
                                                                </a>
                                                                <?php $_smarty_tpl->tpl_vars['prev_day'] = new Smarty_variable($_smarty_tpl->tpl_vars['value']->value['day'], null, 0);?>
                                                        <?php }else{ ?>
                                                            <?php $_smarty_tpl->tpl_vars['prev_day'] = new Smarty_variable($_smarty_tpl->tpl_vars['value']->value['day'], null, 0);?>
                                                                <br/><?php echo $_smarty_tpl->tpl_vars['value']->value['time_from'];?>
-<?php echo $_smarty_tpl->tpl_vars['value']->value['time_to'];?>

                                                                <a href="javascript:void(0);" onclick="handleSingleDelete(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)">
                                                                        <i class="icon-remove ml mr"></i>
                                                                </a>
                                                        <?php }?>
                                                    <?php } ?>
                                                    <?php $_smarty_tpl->tpl_vars['prev_day'] = new Smarty_variable('', null, 0);?>
                                                </td>
                                                <td class="table-col-center">
                                                    <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick='edit_non_prefered_time(<?php echo json_encode($_smarty_tpl->tpl_vars['date_range']->value);?>
,<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
)'><span class="icon-wrench"></span></button>
                                                    <button type="button" class="btn btn-default no-ml" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="delete_non_prefered_time('<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
')" style="margin-top: 5px;"><span class="icon-trash"></span></button>
                                                </td>
                                            </tr>
                                        <?php }
if (!$_smarty_tpl->tpl_vars['date_range']->_loop) {
?>
                                            <tr class="gradeX">
                                                <td class="text-center" colspan="6">
                                                    <div class="alert alert-info no-ml no-mr">
                                                        <strong><i class="icon-info-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_information'];?>
</strong>:  <?php echo $_smarty_tpl->tpl_vars['translate']->value['no_non_preferred_data_found'];?>

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
        <!-- non_preferred_time ends -->

        <div class="row-fluid">
            <div class="span6" style="">
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px 0px 15px ! important;" class="widget">
                            <div style="" class="widget-header span12">
                                <div class="day-slot-wrpr-header-left">
                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_preference'];?>
</h1>
                                </div>
                              
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group widget-body-profile-time-preference-height-fix">
                                <form method="post" action=""  id="time_preference_form" name="time_preference_form">
                                    <input type="hidden" name="url" id="url" value="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
" />    
                                    <div class="span12 widget-body-section input-group" style="display:none;">
                                        <div class="row-fluid">
                                            <div style="color:red; display:none;" align="center" id="errormsg" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['todate_greaterthan_fromdate_error'];?>
</div>
                                            <?php if ($_smarty_tpl->tpl_vars['errorMessage']->value!=''){?><div style="color:red; " align="center" id="posterrormsg" ><?php echo $_smarty_tpl->tpl_vars['errorMessage']->value;?>
</div><?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['deleteMessage']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['deleteMessage']->value;?>
 <?php }?>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span5">
                                                <div style="margin: 0px;" class="span10">
                                                    <label style="float: left;" class="span10" for="exampleInputEmail1">Från datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span7" type="text" name="frmdate" id="frmdate" data-date-format="yyyy-mm-dd" maxlength="11" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span5">
                                                <div style="margin: 0px;" class="span10">
                                                    <label style="float: left;" class="span10" for="exampleInputEmail1">Till Datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span7" type="text" name="todate" id="todate" maxlength="11" data-date-format="yyyy-mm-dd" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span1" style="margin-top: 17px;">
                                                <input class="btn btn-default btn-option-panel" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
" id="submit" name="submit" />
                                                <input type="hidden" id="hdn_employee" name="hdn_employee" value="<?php echo $_smarty_tpl->tpl_vars['employees_username']->value;?>
" />
                                                <input type="hidden" id="hdn_tot_employee" name="hdn_tot_employee" value="<?php echo $_smarty_tpl->tpl_vars['emp_count']->value;?>
" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action=""  id="myform" name="myform" >
                                    <input type="hidden" name="hdn_delete" id="hdn_delete" value="" />                
                                </form>
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <div style="margin: 15px 0px 0px ! important;" class="span12">
                                            <div id="datashow"></div>
                                            <?php $_smarty_tpl->tpl_vars['number'] = new Smarty_variable(0, null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars['emp_counter'] = new Smarty_variable($_smarty_tpl->tpl_vars['emp_count']->value, null, 0);?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['employee'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['name'] = 'employee';
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['preferred_time']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['employee']['total']);
?>
                                                <form name="editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" action="" method="post" >
                                                    <input type="hidden" name="hdn_editform" id="hdn_editform" value="1" />
                                                    <input type="hidden" id="hdn_employee" name="hdn_employee" value="<?php echo $_smarty_tpl->tpl_vars['employees_username']->value;?>
" />
                                                    <input type="hidden" id="hdn_slot" name="hdn_slot" value="" />
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0;">
                                                        <thead>
                                                            <tr>
                                                                <th align="right" style="border-bottom:none;display:none;">             
                                                                    <input type="button" name="edit<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="edit<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick="document.getElementById('showtable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'none'; document.getElementById('edittable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'block';  document.getElementById('submitslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = ''; document.getElementById('cancelslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = ''; document.getElementById('edit<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'none'; "/>
                                                                    <input type="button" name="delete" id="delete" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="delrec(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['timeid'];?>
);"  />
                                                                    &nbsp;&nbsp;<input type="button" name="submitslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="submitslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
" style="display:none;" onclick="checkthis('<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['timeid'];?>
'); return false;document.editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
.hdn_slot.value = '<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['timeid'];?>
'; if(document.editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
.editfrmdate.value > document.editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
.edittodate.value){ document.getElementById('errormsg').style.display = 'block'; return false; } else { document.getElementById('errormsg').style.display = 'none'; }  document.editform<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
.submit();" />
                                                                    &nbsp;&nbsp;<input type="button" name="cancelslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="cancelslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
" onclick="document.getElementById('showtable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'block'; document.getElementById('edittable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'none'; document.getElementById('edit<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = ''; document.getElementById('submitslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'none'; document.getElementById('cancelslot<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
').style.display = 'none';" style="display:none;" />    
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0;" id="showtable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="8" class="table-col-center center">
                                                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['from_date'];?>
 : <?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['fromdate'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_date'];?>
 : <?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['todate'];?>

                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="gradeX">
                                                            <th class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['day'];?>
</th>
                                                            <th class="table-col-center center" colspan="6"><?php echo $_smarty_tpl->tpl_vars['translate']->value['preferred_time'];?>
<br /> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_for_preferred_time_format'];?>
</th>
                                                            <th class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['book_overtime'];?>
</th>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['monday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][0]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][0]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][1]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][1]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][2]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][2]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][3]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][3]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['friday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][4]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][4]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][5]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][5]['overtime'];?>
</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday'];?>
</td>
                                                            <td class="table-col-center left" colspan="6"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][6]['preferredtime'];?>
</td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][6]['overtime'];?>
</td>
                                                        </tr>       
                                                    </table>
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0; display:none;" id="edittable<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
">
                                                        <input type="hidden" name="table[]" id="table<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="table<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" />
                                                        <thead>
                                                            <tr>
                                                                <th class="table-col-center left" colspan="8">
                                                                    <div class="span5">
                                                                        <label style="float: left;" class="span10" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['from_date'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span7" type="text"  name="hdn_fromdate" id="editfrmdate<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['fromdate'];?>
" maxlength="11" /> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="span5">
                                                                        <label style="float: left;" class="span10" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to_date'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span7" type="text" name="hdn_todate" id="edittodate<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']]['todate'];?>
" maxlength="11" /> 
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="gradeX">
                                                            <th class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['day'];?>
</th>
                                                            <th class="table-col-center center" colspan="6"><?php echo $_smarty_tpl->tpl_vars['translate']->value['preferred_time'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['translate']->value['message_for_preferred_time_format'];?>
</th>
                                                            <th class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['book_overtime'];?>
</th>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['monday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday0" id="txtday0" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][0]['preferredtime'];?>
" tabindex="1"  />
                                                                <input type="text" name="error0" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red !important; border:none; display:none; " readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][0]['overtimeval'],'output'=>'','name'=>"chkday0",'id'=>"chkday0"),$_smarty_tpl);?>
                    
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6" >
                                                                <input type="text" name="txtday1" id="txtday1" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][1]['preferredtime'];?>
" tabindex="2" />
                                                                <input type="text" name="error1" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][1]['overtimeval'],'output'=>'','name'=>"chkday1",'id'=>"chkday1"),$_smarty_tpl);?>
 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday2" id="txtday2" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][2]['preferredtime'];?>
" tabindex="3" />
                                                                <input type="text" name="error2" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][2]['overtimeval'],'output'=>'','name'=>"chkday2",'id'=>"chkday2"),$_smarty_tpl);?>
 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday3" id="txtday3" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][3]['preferredtime'];?>
" tabindex="4" />
                                                                <input type="text" name="error3" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][3]['overtimeval'],'output'=>'','name'=>"chkday3",'id'=>"chkday3"),$_smarty_tpl);?>
 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['friday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday4" id="txtday4" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][4]['preferredtime'];?>
" tabindex="5" />
                                                                <input type="text" name="error4" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][4]['overtimeval'],'output'=>'','name'=>"chkday4",'id'=>"chkday4"),$_smarty_tpl);?>
                     
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday5" id="txtday5" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][5]['preferredtime'];?>
" tabindex="6" />
                                                                <input type="text" name="error5" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][5]['overtimeval'],'output'=>'','name'=>"chkday5",'id'=>"chkday5"),$_smarty_tpl);?>
                     
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday'];?>
</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday6" id="txtday6" value="<?php echo $_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][6]['preferredtime'];?>
" tabindex="7" />
                                                                <input type="text" name="error6" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_time_slot'];?>
" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                <?php echo smarty_function_html_checkboxes(array('values'=>1,'selected'=>$_smarty_tpl->tpl_vars['preferred_time']->value[$_smarty_tpl->getVariable('smarty')->value['section']['employee']['index']][6]['overtimeval'],'output'=>'','name'=>"chkday6",'id'=>"chkday6"),$_smarty_tpl);?>
 
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php $_smarty_tpl->tpl_vars['emp_counter'] = new Smarty_variable($_smarty_tpl->tpl_vars['emp_counter']->value-1, null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars["number"] = new Smarty_variable($_smarty_tpl->tpl_vars['number']->value+1, null, 0);?>
                                                </form>
                                            <?php endfor; endif; ?>
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
        <!--////////////////////////////////////MAIN LEFT END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <!--////////////////////////////////////MAIN RIGHT BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <div class="span4 main-right" style="margin: 0px 0px 0px 5px; padding: 5px; display: block; width: 32%;">
          
             <!-- <div class="row-fluid">
                <div class="span12 upload-document-visible" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <form method="post" name="doc_form" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/" enctype="multipart/form-data">
                            <div style="" class="widget-header span12">
                                <div class="span5 day-slot-wrpr-header-left span6">
                                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal pull-right btn-upload-file" name="save_doc" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    <button class="btn btn-default btn-normal  pull-right btn-cancel-upload btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group email-list-box">
                                <div class="row-fluid">
                                    <div class="span12" style="margin:0">
                                        <div style="background: none repeat scroll 0px center transparent; margin: 0px ! important; padding: 0px;" class="btn btn-default btn-file">
                                            <span style="margin-right: 8px;" class="fileupload-new">Select file</span>
                                            <input class="margin-none" type="file" name="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="row-fluid">
                <div class="span12 sigin-box" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="span6 day-slot-wrpr-header-left span6">
                                <h1 style="">Enter your password</h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right btn-upload-file" style="" type="button">Signin</button>
                                <button class="btn btn-default btn-normal pull-right btn-cancel-upload" style="" type="button">Cancel</button>
                            </div>
                        </div>
                        <!--WIDGET BODY BEGIN-->
                        <div class="span12 widget-body-section input-group email-list-box">
                            <div class="row-fluid">
                                <div style="margin: 0px 0px 10px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="exampleInputEmail1">Password</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                        <input placeholder="Förnamn*" class="form-control span10" id="exampleInputEmail1" type="password"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--WIDGET BODY END-->
                    </div>
                </div>
            </div>
           <!--  <div class="row-fluid">
                 <div class="span12 edit_skill_right" style="margin-left: 0px; display: none;">
                    <div style="margin: 0px ! important;" class="widget">
                        <form method="post" name="doc_form" action="" enctype="multipart/form-data">
                             <div style="" class="widget-header span12">
                                <div class="span5 day-slot-wrpr-header-left span6">
                                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</h1>
                                </div>

                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal pull-right" name="save_edit_doc" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
" ><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    <button class="btn btn-default btn-normal  pull-right btn-edit-back" type="button"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                                </div>
                                <div class="span12 widget-body-section input-group email-list-box">
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="skills"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skill'];?>
</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span10 non_editable" type="text" name="skills" id="skills_edit" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="description"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
</label>
                                            <textarea class="form-control span12 non_editable" name="description" id="description_edit"></textarea>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</label>
                                            <div class="attachment1" style="margin-top: 25px;"></div>
                                            <div class="attachment2" style="padding-top: 10px;"></div>
                                            <div class="attachment3" style="padding-top: 10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div> -->
        </div>
</form>
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
js/md5.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js" type="text/javascript" ></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.validate.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/time_formats.js?v=<?php echo filemtime('js/time_formats.js');?>
" type="text/javascript" ></script>
<script type="text/javascript">
function resetForm(){
    $('#form').get(0).reset();
    $('.btn-group').button('reset');
} 
$(document).ready( function (){
    $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', true);
    $("#form .exception input:not(.non_editable), #form textarea:not(.non_editable)").prop('readonly', true);
    var edit_mod = 0;   
    $(':radio,:checkbox').not('.non_editable').click(function(){
        return false;
    });
    $('.icon-plus, .icon-minus').hide();

    $("#btn_edit").click(function() {
        if(edit_mod == 1){
            edit_mod = 0;
            resetForm();
            $(this).html('<span class="icon-pencil"></span> ' + '<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_edit_employee_personal'];?>
');
            $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', true);
            $("#form .exception input:not(.non_editable input), #form textarea:not(.non_editable)").prop('readonly', true);
            //$('#form .exception input[type="checkbox"][readonly]').off('.readonly').removeAttr("readonly").css("opacity", "1");
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            
        }else{
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_employee_personal_data_mail_go'];?>
', [
                {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
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
                        $('#btn_edit').html('<span class="icon-pencil"></span> ' + '<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_cancell_edit_employee_personal'];?>
');
                        // $('#form input:not(#username)').attr('readonly', false);
                        // $('#form option:not(:selected)').attr('disabled', false);
                        // $("#btn_save, #password").prop('disabled', false);
                        $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', false);
                        $("#form .exception input:not(.non_editable), #form textarea:not(.non_editable)").prop('readonly', false);
                        $(':radio,:checkbox').unbind('click');
                        $('.icon-plus, .icon-minus').show();
                    }
                }
            ]);    
        }
    });
    
    $("#frmdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "button",
        buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
        buttonImageOnly: true
    });
        
    <?php if ($_smarty_tpl->tpl_vars['tab']->value==02){?>
    
        skillLoad();
   <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['tab']->value==03){?>
     
        documentationLoad()
   <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['tab']->value==04){?>
        arvodeLoad();
        <?php }?>
    $.mask.definitions['~']='[1-9]';
    $("#mobile").mask("0?~9-999 99 99 99", { placeholder:" " });
    $("#phone").mask("0?~9-99999999999", { placeholder:" " }); 
    $('#pass1').keypress(function (event){
    
    if(event.which == '13'){
    event.preventDefault();
        var password = $("#pass1").val();
        var id = $("#contract_ids").val();
                              $( "#dialog-confirm_pass" ).dialog( "close" );
                             var hash = CryptoJS.MD5("<?php echo $_smarty_tpl->tpl_vars['hash']->value;?>
"+password);
                             
                            if (hash == "<?php echo $_smarty_tpl->tpl_vars['passwrd']->value;?>
")
                            {
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/sign/";
                            } 
                            else if(password != null)
                            {
                                //alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['sorry_wrong_password'];?>
");
                                $( "#dialog" ).dialog({
                                closeOnEscape: true,
                                maxHeight: 150,
                                maxWidth: 150,
                                 buttons: { "<?php echo $_smarty_tpl->tpl_vars['translate']->value['ok'];?>
": function() { $(this).dialog("close"); } } 
                            });
                            }
    }
});
     
   $('#mobile').blur(function() {
   var mobiles = $('#mobile').val();
            
            mobiles = removeCharas(mobiles);
            mobiles = trimNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
                error = error + 1;
            }else{
                $("#mobile").removeClass("error");
                $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mobile_check/", { mobile : mobiles, ids : $('#user_id').val() , method : 1 },
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
            }
        
       
        
    });
    
});

function saveForm(){
    var error = 0;
    var error_mob = 0;
    var pass = $("#password").val();
    if(pass.length < 8){
        $("#password").addClass("error");
        error = 1;
    }
    var mobiles = $('#mobile').val(); 
    //alert(mobiles);
        mobiles = removeCharas(mobiles);
        mobiles = trimNumber(mobiles);
        
        if(isNaN(mobiles)){
            $("#mobile").addClass("error");
            error_mob = error_mob + 1;
        }else{
            $("#mobile").removeClass("error");
        }
        $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mobile_check/", { mobile : mobiles, ids : $('#user_id').val() , method : 1 },
        function(data){
            $('#mobs').html(data);
            if(data!= ""){
              $("#mobile").addClass("error");
               error_mob = error_mob + 1;
              $('#mobile_flag').val('');  
            }else{
              $('#mobile_flag').val('1'); 
              if(error == 0 && error_mob == 0){ 

                    $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height:140,
                            modal: true,
                            buttons: {
                                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {

                                            $( this ).dialog( "close" );
                                            $("#form").submit();
                                            },
                                                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                                                            $( this ).dialog( "close" );
                                                    }
                                            }
                                    });
                     }else{
                        if(error != 0){
                            $("#error_pass").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_minimum'];?>
");
                        }
                     }
            }

        });
    }
   

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
function signContract(id){
   /* var name = prompt("<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_enter_your_password'];?>
");
    var hash = CryptoJS.MD5("<?php echo $_smarty_tpl->tpl_vars['hash']->value;?>
"+name);
    if (hash == "<?php echo $_smarty_tpl->tpl_vars['passwrd']->value;?>
")
    {
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/sign/";
    } 
    else if(name != null)
    {
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['sorry_wrong_password'];?>
");
    }
    //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/sign/"; 
    //$( "#dialog:ui-dialog" ).dialog( "destroy" );*/
   
    $( "#dialog-confirm_pass" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['ok'];?>
": function() {
                            $( this ).dialog( "close" );
                             var password = $("#pass1").val();
                             var hash = CryptoJS.MD5("<?php echo $_smarty_tpl->tpl_vars['hash']->value;?>
"+password);
                            if (hash == "<?php echo $_smarty_tpl->tpl_vars['passwrd']->value;?>
")
                            {
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/4/"+id+"/<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
/sign/";
                            } 
                            else if(password != null)
                            {
                                //alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['sorry_wrong_password'];?>
");
                                $( "#dialog" ).dialog({
                                closeOnEscape: true,
                                maxHeight: 150,
                                maxWidth: 150,
                                buttons: { "<?php echo $_smarty_tpl->tpl_vars['translate']->value['ok'];?>
": function() { $(this).dialog("close"); } } 
                            });
                            }
                        },
                        "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
": function() {
                                $( this ).dialog( "close" );
                        }
                    }
		});
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
$( "#dialog-confirm_delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {

                        $( this ).dialog( "close" );
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/1/"+id+"/";
                        documentationLoad();
                        },
				"<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    
    
}

function delSkill(id){
$( "#dialog-confirm_delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {

                        $( this ).dialog( "close" );
                        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/2/"+id+"/";
                        skillLoad();
                        },
				"<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    
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
function printSkill() {
    window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_employee_information.php?id=<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
');
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
ajax_employee_attachment.php");
}

function checkSecurity()
{
        var security = $("#social_security").val();
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
function popup_skill(url)
     {
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
      $("#pass").html('<span class="add-on icon-pencil"></span><input type="text" id="password" class="form-control span10" name="password" value ="<?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
" >');
    }
    
    
   function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
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
</script>
<script type="text/javascript">
	function validaddform() {
            
		var globalerror = 0;
		var correctstr = '';
		var myform = document.getElementById('week_form');
		
		for(var from_counter = 0 ; from_counter < 7 ; from_counter++)
		{
			correctstr = '';
			error = 0;
			var myvalue = $.trim(myform.elements["txtday"+from_counter].value);
                        myform.elements["txtday"+from_counter].value = myvalue;
			var chunks = myvalue.split(","); 
			var ArrayLen = chunks.length;
                        if($.trim(myvalue) != ''){
                            for(var array_counter = 0 ; array_counter < ArrayLen ; array_counter++)
                                {						
                                    var chunk0 = chunks[array_counter];	
                                    var chunks0 = chunk0.split("-");

                                    var string_first = chunks0[0];
                                    var string_second = chunks0[1];

                                    if(chunks0.length == 2)
                                    {
                                            var mycnk0 = string_first.replace(/\s+$/, "");
                                            var mycnk1 = string_second.replace(/\s+$/, "");			

                                            if(mycnk0.indexOf(' ') > -1 || mycnk1.indexOf(' ') > -1)
                                            {
                                                    //alert('Spce not allowed');
                                                    error = 1;
                                            }

                                            mycnk0 = mycnk0.replace(/\s/g, '');
                                            mycnk1 = mycnk1.replace(/\s/g, '');

                                            if(mycnk0 < 0 || mycnk0 > 2400 || mycnk0%5 != 0)
                                                    error = 1;
                                            if(mycnk1 < 0 || mycnk1 > 2400 || mycnk1%5 != 0)
                                                    error = 1;

                                            if(mycnk0.length == 1)
                                                    var num0 = '000'+mycnk0;
                                            else if(mycnk0.length == 2)
                                                    var num0 = '00'+mycnk0;
                                            else if(mycnk0.length == 3)
                                                    var num0 = '0'+mycnk0;
                                            else if(mycnk0.length == 4)
                                                    var num0 = mycnk0;
                                            else
                                                    error = 1;

                                            if(mycnk1.length == 1)
                                                    var num1 = '000'+mycnk1;
                                            else if(mycnk1.length == 2)
                                                    var num1 = '00'+mycnk1;
                                            else if(mycnk1.length == 3)
                                                    var num1 = '0'+mycnk1;
                                            else if(mycnk1.length == 4)
                                                    var num1 = mycnk1;
                                            else
                                                    error = 1;
                                            correctstr += num0+'-'+num1+',';

                                    }
                                    else
                                    {					
                                            error = 1;
                                    }	
                            }	
                        }
			
			if(error == 1)
			{
				globalerror = 1;
				myform.elements["txtday"+from_counter].style.border = '1px solid red';
				myform.elements["error"+from_counter].style.display = 'block';
				
			}	
			else
			{
				myform.elements["txtday"+from_counter].style.border = '1px solid #ccc';
				myform.elements["error"+from_counter].style.display = 'none';
			}
			//alert(correctstr);
			//return false;
		}
		if(globalerror == 1)
		{	
		return false;
		}			
	
		myform.submit();
		
	}
	
	function checkthis(formobj,slotid)	
	{		
		var globalerror = 0;
		var correctstr = '';
		var myform = document.getElementById('editform'+formobj);
		for(var from_counter = 0 ; from_counter < 7 ; from_counter++)
		{
			correctstr = '';
			error = 0;
                        var myvalue = $.trim(myform.elements["txtday"+from_counter].value);
                        myform.elements["txtday"+from_counter].value = myvalue;
                        
			var chunks = myvalue.split(","); 
			var ArrayLen = chunks.length;				
			
                        if($.trim(myvalue) != ''){
                            for(var array_counter = 0 ; array_counter < ArrayLen ; array_counter++)
                            {					
                                    var chunk0 = chunks[array_counter];					
                                    var chunks0 = chunk0.split("-");

                                    var string_first = chunks0[0];
                                    var string_second = chunks0[1];

                                    if(chunks0.length == 2)
                                    {
                                            var mycnk0 = string_first.replace(/\s+$/, "");
                                            var mycnk1 = string_second.replace(/\s+$/, "");			

                                            if(mycnk0.indexOf(' ') > -1 || mycnk1.indexOf(' ') > -1)
                                            {
                                                    //alert('Spce not allowed');
                                                    error = 1;
                                            }

                                            mycnk0 = mycnk0.replace(/\s/g, '');
                                            mycnk1 = mycnk1.replace(/\s/g, '');

                                            if(mycnk0 < 0 || mycnk0 > 2400 || mycnk0%5 != 0)
                                            {
                                                    error = 1;
                                            }
                                            if(mycnk1 < 0 || mycnk1 > 2400 || mycnk1%5 != 0)
                                            {
                                                    error = 1;
                                            }

                                            if(mycnk0.length == 1)					
                                            {
                                                    var num0 = '000'+mycnk0;
                                            }
                                            else if(mycnk0.length == 2)

                                            {
                                                    var num0 = '00'+mycnk0;
                                            }
                                            else if(mycnk0.length == 3)
                                            {
                                                    var num0 = '0'+mycnk0;
                                            }
                                            else if(mycnk0.length == 4)
                                            {
                                                    var num0 = mycnk0;
                                            }
                                            else
                                            {
                                                    error = 1;
                                            }

                                            if(mycnk1.length == 1)
                                            {
                                                    var num1 = '000'+mycnk1;
                                            }
                                            else if(mycnk1.length == 2)
                                            {
                                                    var num1 = '00'+mycnk1;
                                            }
                                            else if(mycnk1.length == 3)
                                            {
                                                    var num1 = '0'+mycnk1;
                                            }
                                            else if(mycnk1.length == 4)
                                            {
                                                    var num1 = mycnk1;
                                            }
                                            else
                                            {
                                                    error = 1;
                                            }		
                                            correctstr += num0+'-'+num1+',';

                                    }
                                    else
                                    {					
                                            error = 1;
                                    }	
                            }	
			}
			if(error == 1)
			{
				globalerror = 1;
				myform.elements["txtday"+from_counter].style.border = '1px solid red';
				myform.elements["error"+from_counter].style.display = 'block';
				
			}	
			else
			{
				myform.elements["txtday"+from_counter].style.border = '1px solid #ccc';
				myform.elements["error"+from_counter].style.display = 'none';
			}
			//alert(correctstr);
			//return false;
		}
		
		if(globalerror == 1)
		{	
			return false;
		}	
		
		myform.elements["hdn_slot"].value = slotid; 
		if(myform.elements["editfrmdate"+formobj].value > myform.elements["edittodate"+formobj].value)
		{ 
			document.getElementById('errormsg').style.display = 'block';
		 	return false; 
		} 
		else 
		{ 
			document.getElementById('errormsg').style.display = 'none';
		}  
	
		myform.submit();		
	}
	
	function delrec(formid,timeid)
	{
		document.getElementById('hdn_delete').value = timeid;	
		document.forms['myform'].submit();
		return false;
	}
	
	

	//var phoneNumberPattern = /(\d<?php echo 4;?>
)?[-]?(\d<?php echo 4;?>
)?[,].*/;  
	//$res = phoneNumberPattern.test(elementValue);  
	

   $(document).ready(function() {	
	
	$(".btn-addskill").click(function() {
            $('#add_new_skill').toggle();

            // $('.addnew-skill').addClass('addnew-skill-visible');
            // $('.addnew-skill').removeClass('addnew-skill');
            // $('.upload-document-visible').addClass('upload-document');
            // $('.upload-document-visible').removeClass('upload-document-visible');
            // $('.sigin-box-visible').addClass('sigin-box');
            // $('.sigin-box-visible').removeClass('sigin-box-visible');
            // $(".main-left").css('width', '66%');
            // $(".main-right").css('width', '32%');
            // $(".main-right").css('display', 'block');
            // $('.edit_skill_right').hide();
        });
                     
        $(".btn-upload-document").click(function() {
            $('#document_upload').toggle();
            // $('.upload-document').addClass('upload-document-visible');
            // $('.upload-document').removeClass('upload-document');
            // $('.addnew-skill-visible').addClass('addnew-skill');
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            // $('.sigin-box-visible').addClass('sigin-box');
            // $('.sigin-box-visible').removeClass('sigin-box-visible');
        });
        
        $(".btn-cancel-upload").click(function() {
            // $('.upload-document-visible').removeClass('upload-document-visible');
            // $('.upload-document-visible').addClass('upload-document');
            $('#document_upload').hide();
            // $('.addnew-skill-visible').addClass('addnew-skill');
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            $('.edit_skill_right').show();
            // $(".main-left").css('width', '99%');
            // $(".main-right").css('display', 'none');
        });
                     
        $(".btn-cancel-addskill, .btn-addnew-skill").click(function() {
            $('#add_new_skill').hide();
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            // $('.addnew-skill-visible').addClass('addnew-skill');
            $('#edit_skill_right').show();
            // $(".main-left").css('width', '99%');
            // $(".main-right").css('display', 'none');
        });
       
       
        
	$('#email').click(function() {		
	
	$('#emailaddress').val('');
		$('#emailpopup').slideDown('slow');
	});
	
	$('#send').click(function() {		
		$('#emailpopup').slideUp('slow');
	});
	
	$('#closeemail').click(function() {		
		$('#emailpopup').slideUp('slow');
	});
	
	
		
	$('#emailform').submit(function() {
		
		var email 		= $('#emailaddress').val();
		var hdn_url		= $("#url").val();
		var employee	= $("#hdn_employee").val();
		var  url = hdn_url+'emptimepreference/sendemail/';
		var error = 0;
		
		if(email == '')
		{
			error = 1;				
		}
			
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test(email))
		{         
			error = 1;
		}
		
		if(error == 1)
		{
			$("#errormsg").html('');
			$("#errormsg").html('Invalid Email Address');
			$("#errormsg").show();
			return false;
		}
		
	
		$.ajax({
		type: "POST",
		url: url,
		data: { email: email, employee:employee }
		}).done(function( html ) {
		//alert( "Data Saved: " + html );
		$("#errormsg").html('');
		$("#errormsg").html(html);
		$("#errormsg").show();
		});
	
		return false;
	});
		
	
	$('#submit').click(function() {
			$('#posterrormsg').html(' ');
			var fromdate	= $("#frmdate").val();
			var todate		= $("#todate").val();
			var employee		= $("#hdn_employee").val();
			
			var hdn_url		= $("#url").val();
			//$.post("test.php", { name: "John", time: "2pm" } );
			var  url = hdn_url+'ajax_employee_time_preference_new.php';
			var error = 0;
			
			if(fromdate == '')
			{
				$("#frmdate").css('border-color','red');
				error = 1;
			}
			else
			{
				$("#frmdate").css('border-color','1px solid #D9D9D9');	
			}
			if(todate == '')
			{
				$("#todate").css('border-color','red');			
				error = 1;
			}
			else
			{
				$("#todate").css('border-color','1px solid #D9D9D9');	
			}
			
			if(todate < fromdate)
			{				
				$("#errormsg").show();
				error = 1;			
			}
			else
			{
				$("#errormsg").hide();
			}		
		
			if(error == 1)
			{
				return false;	
			}
				
			$.ajax({
			type: "POST",
			url: url,
			data: { fromdate: fromdate, todate: todate, employee: employee }
			}).done(function( html ) {
			//alert( "Data Saved: " + msg );
			$("#datashow").html('');
			$("#datashow").html(html);
	
			});
			return false;

	});
	
	
	var tot_employee = $("#hdn_tot_employee").val();
	for(var employee_counter = 0 ; employee_counter < tot_employee ; employee_counter++)
	{
		$("#editfrmdate"+employee_counter).datepicker({
		showOn: "button",
		buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
		buttonImageOnly: true
		});
		
		$("#edittodate"+employee_counter).datepicker({
		showOn: "button",
		buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
		buttonImageOnly: true
		});
	}
	
});
function formBack() {
    document.location.href = '<?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_general']->value['edit_employee']==1){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php echo $_smarty_tpl->tpl_vars['employees_username']->value;?>
/<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/<?php echo $_smarty_tpl->tpl_vars['employees_username']->value;?>
/<?php }?>';
}
</script>
<script type="text/javascript">
function pdfdownload(){	
	var emp = document.getElementById("hdn_employee").value;	
	var host = document.getElementById("url").value;	
	var url = host+"emptimepreference/pdfdwonload/emp/";
	url += emp+'/';
	
	myWindow=window.open(url,'Employee Preference Time Data PDF','width=200,height=100');
	myWindow.focus();
	return false;	
}
</script>
<script type="text/javascript">
    function downloadFile(filename){
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
    }
    function download_skill(file){
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+file;
    }

    function toggle_edit(id){
       
        if($('#edit_skill_form'+id).length == 0){
            $('#edit_skill_main'+id).after(edit_form(id));
        }
        else{
            $('#edit_skill_form'+id).remove();
        }        
        $('.attachment1,.attachment2,.attachment3').empty();
        // $('.upload-document-visible').addClass('upload-document');
        // $('.upload-document-visible').removeClass('upload-document-visible');
        // $('.addnew-skill-visible').addClass('addnew-skill');
        // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
        // $(".main-left").css('width', '66%');
        // $(".main-right").css('width', '32%');
        // $(".main-right").css('display', 'block');
        $('.edit_skill_right').show();
        var title = $('#skill_title'+id).text().trim();
        var description = $('#skill_description'+id).text().trim();
        $('#skills_edit').val(title);
        $('#skills_edit').append('<input type=hidden name=skill_h_id value='+id+'>');
        $('#description_edit').val(description);
        if($('#attachment1'+id).text().trim() != ''){
            $('.attachment1').append('<label class=edit_label>'+$('#attachment1'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick="delete_skill_doc(\'attachment1\')"><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment1").append('<input type=file name=file[]> style=line-height:0;');
        } 
        if($('#attachment2'+id).text().trim() != ''){
            $('.attachment2').append('<label class=edit_label>  '+$('#attachment2'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick=delete_skill_doc(\'attachment2\')><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment2").append('<input type=file name=file[]>  style=line-height:0;');

        }
        if($('#attachment3'+id).text().trim() != ''){
            $('.attachment3').append('<label class=edit_label>'+$('#attachment3'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick=delete_skill_doc(\'attachment3\')><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment3").append('<input type=file name=file[]>  style=line-height:0;');
        }  
    }

    function delete_skill_doc(db_column){
        $('.'+db_column).empty();
        var html = '<input type=file  name=file[] style=line-height:20px; ><input type=hidden name=db_column[] value='+db_column+'>';
        $('.'+db_column).append(html);
    }
    function edit_form(id){
         var html = '<div class="row-fluid" id=edit_skill_form'+id+' style="margin-bottom:10px;">\n\
                 <div class="span12 edit_skill_right" style="margin-left: 0px; display: none;">\n\
                    <div style="margin: 0px ! important;" class="widget">\n\
                        <form method="post" name="doc_form" action="" enctype="multipart/form-data">\n\
                             <div style="" class="widget-header span12">\n\
                                <div class="span5 day-slot-wrpr-header-left span6">\n\
                                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</h1>\n\
                                </div>\n\
                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">\n\
                                    <button class="btn btn-default btn-normal pull-right" name="save_edit_doc" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
" ><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>\n\
                                    <button class="btn btn-default btn-normal  pull-right " type="button" onclick=edit_form_back('+id+')><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>\n\
                                </div>\n\
                                <div class="span12 widget-body-section input-group email-list-box">\n\
                                    <div class="row-fluid">\n\
                                        <div style="margin: 0px ! important;" class="span12">\n\
                                            <label style="float: left;" class="span12" for="skills"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skill'];?>
</label>\n\
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>\n\
                                                <input class="form-control span10 non_editable" type="text" name="skills" id="skills_edit"/></div></div></div>'; 
        var html1 =         '<div class="row-fluid"><div style="margin: 0px" class="span12">\n\
                                            <label style="float: left;" class="span12" for="description"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
</label>\n\
                                            <textarea class="form-control span12 non_editable" name="description" id="description_edit"></textarea>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row-fluid">\n\
                                        <div style="margin: 0px" class="span12">\n\
                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_document'];?>
</label>\n\
                                            <div class="attachment1" style="margin-top: 25px;"></div>\n\
                                            <div class="attachment2" style="padding-top: 10px;"></div>\n\
                                            <div class="attachment3" style="padding-top: 10px;"></div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                         </form>\n\
                    </div>\n\
                </div>\n\
            </div>';
        var html2 = html+html1;
            return html2;
    }
    function edit_form_back(id){
        $('#edit_skill_form'+id).hide();
    }

    // non prefered functions start

    $('.btn-add-new').click(function(){
        $('#new_non_prefered_time').show();
        $('.day-show .panel-title:not(.collapsed)').trigger('click');
        $('#save_btn,#close_btn').show();
        // $('.day-show').removeClass('hide');
        // $('.empty-all,#from_date,#to_date').val('');
        // $('.remove-intervals').trigger('click');

    });

    $('.btn-cancel-right').click(function(){
        $('#copy_to_week').prop('checked', false);
        $('#new_non_prefered_time,#save_btn,#close_btn').hide();
        $('.empty-all,#from_date,#to_date').val('');
        $('.remove-intervals').trigger('click');
        $('#group_id').val('');
        $('#copy_to_week_times').hide();

        // $('.collapse').collapse();
        // $('.collapse').collapse({
        //     toggle: false
        // })
        // $('.collapse').collapse('hide');
    });

    $('.add-new-intervals').click(function(){
        var day  = $(this).closest('.panel-body').data('day');
        var html = '<div class="span12 row-fluid no-ml interval-div">\n\
                        <div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>\n\
                        <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>\n\
                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>\n\
                        <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>\n\
                    <div>';
        $(this).closest('.panel-body').append(html);
    });

    $(document).on("click",".remove-intervals",function() {
        $(this).closest('.row-fluid').remove();
    });

    $(function(){
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        }).on('changeDate', function(ev){
            var fromDate = $('#from_date').val();
            var toDate   = $('#to_date').val();
            var daysForshow = [7,1,2,3,4,5,6]; // 7 -sunday ... 6-saturday
            
            if(fromDate != '' && toDate == ''){
                var dayObj = new Date(fromDate);
                var day = daysForshow[dayObj.getDay()];
                // $('.day-show').hide();
                $('.day-show').addClass('hide');
                // $('#day_show'+day).show();
                $('#day_show'+day).removeClass('hide');
            }
            else{
                // $('.day-show').hide();
                $('.day-show').addClass('hide');
                var startDate = new Date(fromDate); //YYYY-MM-DD
                var endDate   = new Date(toDate);
                var dates     = getDateArray(startDate, endDate);
                if(dates.length >= 7){
                    // $('.day-show').show();
                    $('.day-show').removeClass('hide');
                }
                else{
                    dates.forEach(function(value, key){
                        // $('#day_show'+daysForshow[value]).show();
                        $('#day_show'+daysForshow[value]).removeClass('hide');
                    });
                }
            }
            /*if(typeof ev.date != 'undefined' && ev.date != ''){
                console.log($.datepicker.formatDate('yy-mm-dd', ev.date));
            }*/
        });
    });

    function getDateArray(start, end) {
        var days = new Array();
        var dt  = new Date(start);
        while (dt <= end) {
            days.push(new Date(dt).getDay());
            dt.setDate(dt.getDate() + 1);
        }
        return days;
    }

    function handleTimeInterval(){
        var interval           = [];
        var dayInterval        = {}; 
        var dayIntervalVisible = {};
        var isOverlape         = 0 ;
        var fromDate           = $('#from_date').val();
        var toDate             = $('#to_date').val(); 
        if(fromDate == ''){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['from_date_is_mandatory'];?>
', function(result){ });
        }
        else{
            toDate != '' ? toDate : toDate = fromDate ;
            $('#new_non_prefered_time .day-show:not(.hide) .interval-div').each(function( index ) {
                var timeFrom = time_to_sixty($(this).find('.time-from').val());
                var timeTo   = time_to_sixty($(this).find('.time-to').val());
                var day      = $(this).closest('.panel-body').data('day'); // 1 = monday ... 7 = sunday 
                if(timeFrom !== false && timeTo !== false){
                    timeFrom = parseFloat(timeFrom);
                    timeTo   = parseFloat(timeTo);
                    if(timeFrom < timeTo){
                        if(typeof dayInterval[day] == "undefined")
                            dayInterval[day] = [];
                        dayInterval[day].push({ 'timeFrom':timeFrom, 'timeTo' : timeTo});
                    }
                }
            });
            // console.log(dayInterval);
            
            if(Object.keys(dayInterval).length > 0){
            
                for (var key in dayInterval) { 
                    dayInterval[key].sort(function(a, b){ // sorting each day increasing order of timeFrom.
                        return a.timeFrom-b.timeFrom;
                    });
                    for (var i = 1; i < dayInterval[key].length; i++) { // checking for overlapping time periods.
                        if(dayInterval[key][i].timeFrom < dayInterval[key][i-1].timeTo){
                            isOverlape = 1;
                            break;
                        }
                    }
                    if(isOverlape == 1)
                        break;
                }
                if(isOverlape == 1){
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_intervals_are_overlapping'];?>
', function(result){ });
                }
                else{
                    var data;
                    var preference_mode = $("input[name='pref_selection']:checked"). val();
                    if($('#group_id').val() != ''){ // edit
                        data = { 'group_id':$('#group_id').val(),'dayInterval':dayInterval ,'username':'<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
' ,'fromDate':fromDate, 'toDate':toDate,'action':'edit_time_interval', 'preference_mode' : preference_mode}
                    }
                    else{
                        data = { 'dayInterval':dayInterval ,'username':'<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
' ,'fromDate':fromDate, 'toDate':toDate,'action':'save_time_interval', 'preference_mode' : preference_mode}
                    }
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee_administration.php",
                        type:'POST',
                        datetype:'json',
                        data:data,
                        success:function(data){
                            data = JSON.parse(data);
                            // console.log(data);
                            // return false;
                            if(data.result_flag == false){
                                $('#error_message').html(data.error_message);
                            }
                            else{
                                location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/';
                            }
                        }
                    });
                }
            }
            else{
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_time_interval_is_selected'];?>
', function(result){ });
            }
        }
    }

    function handleSingleDelete(id){
        bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_delete'];?>
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
              if(id){
                var preference_mode = $("input[name='pref_selection']:checked"). val();
                $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee_administration.php",
                type:'POST',
                datetype:'json',
                data:{ 'id':id , 'action':'delete_single_time_interval', 'preference_mode': preference_mode},
                success:function(data){
                    // console.log(data);
                    // console.log(JSON.parse(data));
                    data = JSON.parse(data);
                    if(data.result_flag == true){
                        location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/';
                    }
                    else{
                        $('#main_message').html(data.error_message);
                    }
                }
            });
              }
            }
         }
      ]);
    }

    function delete_non_prefered_time(group_id){
        bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_delete'];?>
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
                if(group_id){
                    var preference_mode = $("input[name='pref_selection']:checked"). val();
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee_administration.php",
                        type:'POST',
                        datetype:'json',
                        data:{ 'group_id':group_id , 'action':'delete_time_interval', 'preference_mode': preference_mode},
                        success:function(data){
                            // console.log(data);
                            // console.log(JSON.parse(data));
                            data = JSON.parse(data);
                            if(data.result_flag == true){
                                location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/administration/';
                            }
                            else{
                                $('#main_message').html(data.error_message);
                            }
                        }
                    });
                }
               }
            }
        ]);
    }

    function edit_non_prefered_time(dateRange,groupId){
        // $('.day-show .panel-title:not(.collapsed)').trigger('click');
        // $('.panel-title.collapsed').siblings('.in.collapse').prev('.panel-title.collapsed').trigger('click');
        
        // $('.collapse').collapse('hide');
        var prevDay = '';
        $('.panel-body').find('.no-ml.interval-div').remove();
        $('.btn-add-new').trigger('click');
        // $('.day-show .panel-title:not(.collapsed)').trigger('click');
        // $('.day-show').show();
        $('.day-show').removeClass('hide');
        $('#group_id').val(groupId);
        $('#from_date').val(dateRange[0].date_from);
        $('#to_date').val(dateRange[0].date_to);
        setTimeout(function(){
            dateRange.forEach(function(value ,key){
                 // console.log($('#day'+value.day).collapse('show'));
                 
                $('.day-show#day_show'+value.day+' .panel-title').trigger('click');
                if(prevDay != value.day){
                    $('#day'+value.day).find('.time-from').val(value.time_from);
                    $('#day'+value.day).find('.time-to').val(value.time_to);
                }
                else{
                    var html = append_new_interval(value.time_from,value.time_to);
                    $('#day'+value.day).find('.panel-body').append(html);
                    
                }
                prevDay = value.day;
            });
        }, 1000);
    }

    function append_new_interval(timeForm, timeTo){
        var html = '<div class="span12 row-fluid no-ml interval-div">\n\
                        <div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_from'];?>
</div>\n\
                        <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" value = '+timeForm+' ></div>\n\
                        <div class="span2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['emp_non_prefr_time_to'];?>
</div>\n\
                        <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" value = '+timeTo+' ></div>\n\
                    <div>';
        return html;
    }

    $('#copy_to_week').click(function(){
        if ($(this).is (':checked')){
            $('#copy_to_week_times').show();
        }
        else{
            $('#copy_to_week_times').hide();
        }
        
    });

    $('#set_copy_time').click(function(){

            var proceed = true;
            var dayArray = [];
            // console.log(dayArray);
            var from_time_week = $('#from_date_week').val();
            var to_time_week   = $('#to_date_week').val();
            if(from_time_week != '' && to_time_week != ''){
                
                // $('.day-show').find('.panel-title').trigger('click');
                // $('.day-show .single-day:not(.in)').prev('.panel-title').trigger('click');
                $('.day-show .panel-title:not(.collapsed)').trigger('click');
                var interval    = [];
                var dayInterval = {}; 
                $('.day-show').each(function( index ) {
                    if ($(this).css('display') == 'block'){
                         dayArray.push($(this).find('.panel-body').data('day'));
                    }
                });
                $('#new_non_prefered_time .interval-div').each(function( index ) {
                    var timeFrom = time_to_sixty($(this).find('.time-from').val());
                    var timeTo   = time_to_sixty($(this).find('.time-to').val());
                    var day      = $(this).closest('.panel-body').data('day'); // 1 = monday ... 7 = sunday 
                    // var dayArray = dayArray.push(day);
                    if(timeFrom != false && timeTo != false){
                        timeFrom = parseFloat(timeFrom);
                        timeTo   = parseFloat(timeTo);
                        if(timeFrom < timeTo){
                            if(typeof dayInterval[day] == "undefined")
                                dayInterval[day] = [];
                            dayInterval[day].push({ 'timeFrom':timeFrom, 'timeTo' : timeTo});
                        }
                    }
                });
                // console.log(dayInterval);
                if(Object.keys(dayInterval).length == 0){
                    // $('.day-show .panel-title:not(.collapsed)').trigger('click');
                     setTimeout(function(){
                        dayArray.forEach(function(value,key){
                            $('#day'+value).find('.time-from').val(from_time_week);
                            $('#day'+value).find('.time-to').val(to_time_week);
                            $('.day-show#day_show'+value+' .panel-title').trigger('click');
                        });
                    }, 1000);  
                        // $('.interval-div').find('.time-from').val(from_time_week);
                        // $('.interval-div').find('.time-to').val(to_time_week);
                }
                else{

                    setTimeout(function(){
                        dayArray.forEach(function(value,key){
                            proceed = true;
                            if(typeof dayInterval[value] !== 'undefined'){
                                // $('.day-show .panel-title:not(.collapsed)').trigger('click');
                                dayInterval[value].forEach(function(value, key){
                                    if(value.timeFrom == from_time_week  && value.timeTo == to_time_week){
                                        proceed = false;
                                        return false;
                                    }
                                });
                            }
                            if(proceed){
                                if(dayInterval.hasOwnProperty(value)){
                                    var html = append_new_interval(from_time_week,to_time_week);
                                    $('#day'+value).find('.panel-body').append(html);
                                    $('.day-show#day_show'+value+' .panel-title').trigger('click');
                                }
                                else{
                                    $('#day'+value).find('.interval-div').find('.time-from').val(from_time_week);
                                    $('#day'+value).find('.interval-div').find('.time-to').val(to_time_week);
                                    $('.day-show#day_show'+value+' .panel-title').trigger('click');
                                }
                            }
                        });
                    }, 1000);
                }
                // $('.collapse').collapse('show');
            }
        // }
    });

    $(document).off('keyup', ".time-from, .time-to")
        .on('keyup', ".time-from,.time-to", function(e) {
                // get keycode of current keypress event
                var code = (e.keyCode || e.which);
                //console.log(code);
                // do nothing if it's an arrow key  || (code >=65 && code <= 90)
                if(code == 37 || code == 38 || code == 39 || code == 40) {
                    return;
                }
                var this_val = $(this).val();
                var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                $(this).val(new_val);
                /*$(this).val($(this).val().replace(/[^0-9.,]+/g,''));
                $(this).val($(this).val().replace(/,/g,"."));*/
    });


</script>

    </body>
</html><?php }} ?>