<?php /* Smarty version Smarty-3.1.8, created on 2021-03-03 09:15:25
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/pdf_customer_work_report_summery_editing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:202890749603f53adb4eb65-56786847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4257c984a92b65fe71193c85b0bf7f513c77e53b' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/pdf_customer_work_report_summery_editing.tpl',
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
  'nocache_hash' => '202890749603f53adb4eb65-56786847',
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
  'unifunc' => 'content_603f53ae0150c6_57752794',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603f53ae0150c6_57752794')) {function content_603f53ae0150c6_57752794($_smarty_tpl) {?><!DOCTYPE html>
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
css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
<style type="text/css">
    #samsida_hold input[type=checkbox], #samsida_hold input[type=radio] { vertical-align: text-top; }
    #samsida_hold input[type=radio] { margin-top: 2px !important; }
    .secondary-font { font-size: 11px;}
    table tbody tr td div { height: auto !important;}
    block-sub-heading { font-size: 12px;}
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
                                
<?php if ($_smarty_tpl->tpl_vars['flag_cust_access']->value==1){?>
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    Räkning - Assistansersättning
                    <ul class="pull-right">
                        <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm(0);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <div id="tble_list" class=" span12 no-ml">
            <div id="samsida_hold">
                
                <form id="input_form" name="input_form" method="post" action="">
                    <input type="hidden" name="customer" id="customer" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
" />
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                        <tbody>

                            <tr>
                                <th align="left" width="50%" valign="top" scope="col"> Period <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['month_name']->value];?>
 </th>
                                <td align="left" width="50%" valign="top" scope="col"> Räkningen ska ha inkommit till Försäkringskassan senast<br>
                                    den 5:e i andra månaden efter den månad som du ska<br>
                                    redovisa.
                                </td>
                            </tr>

                            <tr>
                                <th align="left" valign="bottom"> 1. Du som har personlig assistans </th>
                                <th align="left" width="50%" valign="top" scope="col">&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="75%" align="left" valign="top" scope="col">Förnamn och efternamn 
                                                <span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['cust_full_name']->value;?>
</span></td>
                                            <td width="25%" align="left" valign="top" scope="col"> Personnummer 
                                                <span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['SSN']->value;?>
</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom" scope="col"> 2.  Redovisning av all utförd assistans under månaden </th>
                                            <td width="50%" align="left" valign="top" scope="col"> Tidsredovisning assistansersättning (3059)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td width="33%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Aktiv tid</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['normal_parts'] = new Smarty_variable(explode('.',$_smarty_tpl->tpl_vars['Tot_normal']->value), null, 0);?>
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['normal_parts']->value[0];?>
</span><span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['normal_parts']->value[1];?>
</span>
                                                            </div></td>
                                                        <td width="33%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-min-height">Väntetid, faktiska timmar</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['oncall_parts'] = new Smarty_variable(explode('.',$_smarty_tpl->tpl_vars['Tot_onCall']->value), null, 0);?>
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['oncall_parts']->value[0];?>
</span><span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['oncall_parts']->value[1];?>
</span>
                                                            </div></td>
                                                        <td width="33%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Beredskapstid, faktiska timmar</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['beredskap_parts'] = new Smarty_variable(explode('.',$_smarty_tpl->tpl_vars['Tot_beredskap']->value), null, 0);?>
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['beredskap_parts']->value[0];?>
</span><span class="span4 no-min-height special_spn"><?php echo $_smarty_tpl->tpl_vars['beredskap_parts']->value[1];?>
</span>
                                                            </div></td>
                                                        
                                                    </tr>
                                                    
                                                </table> 
                                                &nbsp;* Väntetiden räknas om till assistanstid genom att antalet faktiska timmar delas med 4.<br />
                                                ** Beredskapstiden räknas om till assistanstid genom att antalet faktiska timmar delas med 7
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'> 3. Har assistans utförts i barnomsorg, skola eller daglig verksamhet</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" align="left" valign="top" style="padding:0px;">
                                                            <table class="tbl_border" style="border-top:0px;" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                                
                                                                <tr>
                                                                    <td colspan="3" >
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="12%" align="left" valign="middle"><label><input type="radio" name="rd_has_assistance_in_other_activities" value="1" <?php if ($_smarty_tpl->tpl_vars['reports']->value['has_assistance_in_other_activities']==1){?>checked="checked"<?php }?> /> &nbsp;Ja</label></td>
                                                                                <td width="88%" align="left" valign="middle"><label><input type="radio" name="rd_has_assistance_in_other_activities" value="0" <?php if ($_smarty_tpl->tpl_vars['reports']->value['has_assistance_in_other_activities']==='0'){?>checked="checked"<?php }?> /> &nbsp;Nej</label><br /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2" class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr> -->

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom">4. Har du vårdats på sjukhus den här månaden?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr></tr>
                                                    <tr>
                                                        <td colspan="5"><label><input type="radio" name="did_u_hostpilized_this_month" <?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==='0'){?>checked="checked"<?php }?> value="0" /> &nbsp;Nej</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td rowspan="3">&nbsp;<label><input type="radio" name="did_u_hostpilized_this_month" style="float:left;" value="1" <?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?>checked="checked"<?php }?>/> &nbsp;Ja</label><br /></td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_from">Från och med (år, månad, dag)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_from'];?>
<?php }?>" name="hospital_date_from" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Klockslag</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from']);?>
<?php }?>" name="hospital_time_from"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_to">Till och med (år, månad, dag)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker ">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_to'];?>
<?php }?>" id="hospital_date_to" name="hospital_date_to" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Klockslag</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to']);?>
<?php }?>" name="hospital_time_to"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from2" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_from2'];?>
<?php }?>" name="hospital_date_from2" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from2']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from2']);?>
<?php }?>" name="hospital_time_from2"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_to2'];?>
<?php }?>" id="hospital_date_to2" name="hospital_date_to2" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to2']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to2']);?>
<?php }?>" name="hospital_time_to2"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from3" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_from3'];?>
<?php }?>" name="hospital_date_from3" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from3']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_from3']);?>
<?php }?>" name="hospital_time_from3"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['hostpilized_date_to3'];?>
<?php }?>" id="hospital_date_to3" name="hospital_date_to3" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="<?php if ($_smarty_tpl->tpl_vars['reports']->value['did_u_hostpilized_this_month']==1&&$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to3']!=null){?><?php echo sprintf('%05.02f',$_smarty_tpl->tpl_vars['reports']->value['hostpilized_time_to3']);?>
<?php }?>" name="hospital_time_to3"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom">5. Har du vistats i ett land utanför EES-området och anlitat en assistent på plats?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td width="10%" align="left" valign="top"><label>
                                                            <p style="float:left"><input type="checkbox" name="section_3_choice_4" value="1" <?php if (($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['sec3_check_values']->value[3]==1)||($_smarty_tpl->tpl_vars['edit']->value!='true'&&$_smarty_tpl->tpl_vars['prev_sec3_check_values']->value[3]==1)){?>checked="checked"<?php }?>/></p>
                                                            <p style="float:left; margin-left:3px;">&nbsp;Ja</p>
                                                        </label></td>
                                                        <td align="left" valign="top">Bifoga en förklaring till varför du behövde anlita en assistent på plats. Skicka också in handlingar som styrker dina uppgifter.</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom"> 6. Fyll i här om du har köpt assistans och fått ersättning i efterskott<br /></th>
                                        </tr>
                                        <tr>
                                            <td class="minus_padding ">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="3"><p>Har du använt föregående månads utbetalning till köp av personlig assistans?</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_1" value="1" <?php if ($_smarty_tpl->tpl_vars['reports']->value['have_money_left_not_to_purchase1']==1){?>checked="checked"<?php }?> /> &nbsp;Ja</label></td>
                                                                    <td width="14%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_1" value="0" <?php if ($_smarty_tpl->tpl_vars['reports']->value['have_money_left_not_to_purchase1']==='0'){?>checked="checked"<?php }?> /> &nbsp;Nej, det finns</label><br /></td>
                                                                    <td align="left" valign="middle"><input type="text" style="width: 100px; " maxlength="10" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['have_money_left_not_to_purchase1']==='0'){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['money_left1'];?>
<?php }?>" name="txt_money_left_1" /> &nbsp;kronor kvar </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom"> &nbsp;7. Underskrift</th>
                                            <td width="35%" align="left">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="4">Jag försäkrar på heder och samvete att uppgifterna i blanketten är riktiga och fullständiga.<br/>
                                                                    När uppgifterna förändras måste jag meddela Försäkringskassan. Jag vet att det är straffbart att lämna felaktiga uppgifter, <br/>
                                                                    att utelämna något eller att inte meddela Försäkringskassan när uppgifterna jag lämnat förändras.</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="22%">
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_to">Datum</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['sign_date'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['today_date']->value;?>
<?php }?>" id="sign_date" name="sign_date" type="text" maxlength="10" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="42%" align="left" valign="top">&nbsp;Namnteckning<br /></td>
                                                        <td width="36%" align="left" valign="top">&nbsp;Telefon, även riktnummer<br />
                                                            <input type="text" style="vertical-align: bottom;" maxlength="100" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&($_smarty_tpl->tpl_vars['reports']->value['signature_options']==1||$_smarty_tpl->tpl_vars['reports']->value['signature_options']==2||$_smarty_tpl->tpl_vars['reports']->value['signature_options']==3)){?><?php echo $_smarty_tpl->tpl_vars['section6_phone']->value;?>
<?php }?>" name="section6_phone" id="section6_phone" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th width="61%" align="left" valign="bottom"> &nbsp;8. Fyll i här om du som skrivit under är ställföreträdare</th>
                                            <td width="39%" align="left">Om du som undertecknat ansökan är vårdnadshavare,<br /> god man eller förvaltare vill vi ha uppgifter om dig.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3">
                                                            <p>Jag är</p>
                                                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    
                                                                    <td width="20%" align="left" valign="top"><label><input type="radio" name="who_signed" value="1" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['signature_options']==1){?>checked="checked"<?php }?> data-phone="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['mobile3'];?>
" data-name="<?php echo (($_smarty_tpl->tpl_vars['customer_gardian_details']->value['first_name3']).(' ')).($_smarty_tpl->tpl_vars['customer_gardian_details']->value['last_name3']);?>
" data-ssn="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['ssn3_formated'];?>
" /> &nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian3_samsida'];?>
</label></td>
                                                                    <td width="20%"><label><input type="radio" name="who_signed"  value="2" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['signature_options']==2){?>checked="checked"<?php }?> data-phone="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['mobile'];?>
" data-name="<?php echo (($_smarty_tpl->tpl_vars['customer_gardian_details']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_gardian_details']->value['last_name']);?>
" data-ssn="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['ssn_formated'];?>
" /> &nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian1_samsida'];?>
</label></td>
                                                                    <td><label><input type="radio" name="who_signed"  value="3" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['signature_options']==3){?>checked="checked"<?php }?> data-phone="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['mobile2'];?>
" data-name="<?php echo (($_smarty_tpl->tpl_vars['customer_gardian_details']->value['first_name2']).(' ')).($_smarty_tpl->tpl_vars['customer_gardian_details']->value['last_name2']);?>
" data-ssn="<?php echo $_smarty_tpl->tpl_vars['customer_gardian_details']->value['ssn2_formated'];?>
" /> &nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian2_samsida'];?>
</label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='70%'><p>Namnförtydligande</p>
                                                            <p><input class="span12" type="text" style="vertical-align: bottom;" maxlength="100" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['signed_employer_name'];?>
<?php }?>" name="signed_customer_name" id="signed_customer_name" /></p></td>
                                                        <td width="162"><p>Personnummer (12 siffror)</p>
                                                            <p><input class="span12" type="text" style="vertical-align: bottom;" maxlength="100" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['signed_employer_ssn'];?>
<?php }?>" name="signed_customer_ssn" id="signed_customer_ssn" /></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">&nbsp;&nbsp;Uppgifterna hanteras i Försäkringskassans datasystem. Läs mer i broschyren &quot;Försäkringskassans personregister&quot;.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom"> 9. Redovisa dina kostnader<br /></th>
                                            <td width="35%" align="left">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['translate']->value['type_of_cost'];?>
</td>
                                            <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cost_per_hour'];?>
</td>
                                            <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cost_for_period'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td width="33%"><p>Lön (utom OB-tillägg) och lönebikostnader<br /></p></td>
                                            <td width="31%" align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['salary_excl_OB_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['salary_excl_OB_cost'];?>
<?php }?>" name="excl_ob_cost" id="excl_ob_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td width="36%" align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['salary_excl_OB_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['salary_excl_OB_period'];?>
<?php }?>" name="excl_ob_period" id="excl_ob_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Lön i form av OB-tillägg</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['salary_OB_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['salary_OB_cost'];?>
<?php }?>" name="ob_cost" id="ob_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['salary_OB_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['salary_OB_period'];?>
<?php }?>" name="ob_period" id="ob_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Assistansomkostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['assist_expenses_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['assist_expenses_cost'];?>
<?php }?>" name="asst_exp_cost" id="asst_exp_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['assist_expenses_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['assist_expenses_period'];?>
<?php }?>" name="asst_exp_period" id="asst_exp_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Utbildningskostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['training_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['training_cost'];?>
<?php }?>" name="training_cost" id="training_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['training_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['training_period'];?>
<?php }?>" name="training_period" id="training_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Arbetsmiljöinsatser och personalomkostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['staff_expense_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['staff_expense_cost'];?>
<?php }?>" name="staff_expense_cost" id="staff_expense_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['staff_expense_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['staff_expense_period'];?>
<?php }?>" name="staff_expense_period" id="staff_expense_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Administrationskostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['administration_cost']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['administration_cost'];?>
<?php }?>" name="admin_cost" id="admin_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['administration_period']!=0.00){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['administration_period'];?>
<?php }?>" name="admin_period" id="admin_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Summa kostnad för assistansen:</td>
                                            <td align="left" valign="top"><span id="total_cost" class="special_spn"><?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'){?><?php echo $_smarty_tpl->tpl_vars['total_cost_hour']->value;?>
<?php }?></span></td>
                                            <td align="left" valign="top"><span id="total_period" class="special_spn"><?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'){?><?php echo $_smarty_tpl->tpl_vars['total_cost_for_period']->value;?>
<?php }?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Antal utförda timmar under perioden<br />som kostnaden är beräknad på*:<br /></td>
                                            <td align="left" valign="top"><input type="text" style="width: 100px; " maxlength="6" value="<?php if ($_smarty_tpl->tpl_vars['total_customer_no_of_hours']->value!=0){?><?php echo $_smarty_tpl->tpl_vars['total_customer_no_of_hours']->value;?>
<?php }?>" name="customer_hours" id="customer_hours" /></td>
                                            <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">* Beräkna kostnaden på de använda timmarna men inte på fler än det antal timmar som beviljats.</td></tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>

                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom"> 10. Fyll i här om du får ersättning i förskott</th></tr>
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'>10.a Uppgift om perioden</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table id="account_dates" class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td style=" border-right: 1px solid #DCDCDC;">
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="acc_date_from">Från och med (månad och år)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span5 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span12" value="<?php if ($_smarty_tpl->tpl_vars['start_date']->value!=''&&$_smarty_tpl->tpl_vars['start_date']->value!='0000-00-00'&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?><?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
<?php }?>" maxlength="12" id="acc_date_from" name="acc_date_from" type="text" />
                                                                </div>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-append">
                                                                    <a href=""><span class="icon-calendar"></span></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="acc_date_to">Till och med (månad och år)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span5" value="<?php if ($_smarty_tpl->tpl_vars['end_date']->value!=''&&$_smarty_tpl->tpl_vars['end_date']->value!='0000-00-00'&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?><?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
<?php }?>" maxlength="12" id="acc_date_to" name="acc_date_to" type="text"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'> 10.b Finns det pengar kvar som du inte har använt för att köpa personlig assistans?</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" align="left" valign="top" style="padding:0px;">
                                                            <table class="tbl_border" style="border-top:0px;" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                                
                                                                <tr>
                                                                    <td colspan="3" >
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_2" value="0" <?php if ($_smarty_tpl->tpl_vars['reports']->value['money_left_not_to_purchase2']==='0'&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?>checked="checked"<?php }?> /> &nbsp;Nej</label><br /></td>
                                                                                <td width="14%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_2" value="1" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['money_left_not_to_purchase2']==1&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?>checked="checked"<?php }?> /> &nbsp;Ja, det finns</label></td>
                                                                                <td align="left" valign="middle"><input type="text" style="width: 100px; " maxlength="5" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['money_left_not_to_purchase2']==1&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?><?php echo $_smarty_tpl->tpl_vars['reports']->value['money_left2'];?>
<?php }?>" name="txt_money_left_2" /> &nbsp;kronor kvar </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2" class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'>10.c Hur vill du betala tillbaka eventuellt för mycket utbetald ersättning?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3" align="left" valign="top" scope="col">
                                                            <label><input type="radio" name="section_9_choice" value="1" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['compensation_payback']==1&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?>checked="checked"<?php }?>/>
                                                                &nbsp;Jag vill att Försäkringskassan drar av eventuellt för mycket utbetald ersättning för den här perioden på kommande utbetalningar.</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="left" valign="top">
                                                            <label><input type="radio" name="section_9_choice" value="2" <?php if ($_smarty_tpl->tpl_vars['edit']->value=='true'&&$_smarty_tpl->tpl_vars['reports']->value['compensation_payback']==2&&$_smarty_tpl->tpl_vars['company_id']->value!=10){?>checked="checked"<?php }?>/>
                                                            &nbsp;Jag vill att Försäkringskassan prövar om jag är återbetalningsskyldig om det har utbetalats för mycket ersättning för den här perioden.</label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <input type="hidden"  id="save_print" value="0" name="save_print"  />
                                <td style=" margin-bottom:10px; margin-top:10px;" align="left" valign="top" class="minus_padding" colspan="2">
                                    <span class="span12">
                                        <button type="button" onclick="return saveForm(1);" class="btn btn-primary pull-right mr ml"  id=""><i class='icon-print'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_and_print'];?>
</button>
                                        <button type="button" onclick="return saveForm(0);" class="btn btn-primary pull-right mr"  id=""><i class='icon-save'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right; padding-right:10px;" ><div style="color:#BB5613;font-weight:bold;" id="error_data" ></div></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="alert alert-danger alert-dismissable">
            <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  <?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>

        </div>
    </div>
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
js/jquery.formatCurrency-1.4.0.js" type="text/javascript" ></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js" type="text/javascript" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker({
                    autoclose: true
        });
        
        /*$("#hospital_date_from, #hospital_date_to").datepicker({ 
                autoclose: true,
                startDate: "<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
-01",
                endDate: "<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
"
            })
        .on('changeDate', function(ev){
            var cur_event_id = $(ev.currentTarget).attr('id');
            var selectedDate = ev.date;
            //console.log(selectedDate);
            if(cur_event_id == 'hospital_date_from')
                $( "#hospital_date_to" ).datepicker("setStartDate", selectedDate );
            else if(cur_event_id == 'hospital_date_to')
                $( "#hospital_date_from" ).datepicker("setEndDate", selectedDate );
        });*/
        $(".hospital_dates").datepicker({ 
            autoclose: true,
            startDate: "<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
-01",
            endDate: "<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
"
        });
        $("#acc_date_from, #acc_date_to").datepicker({ 
            autoclose: true,
            clearBtn: true,
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
        })
        .on('changeDate', function(ev){
            var cur_event_id = $(ev.currentTarget).attr('id');
            var selectedDate = ev.date;
            //console.log(selectedDate);
            if(cur_event_id == 'acc_date_from')
                $( "#acc_date_to" ).datepicker("setStartDate", selectedDate );
            else if(cur_event_id == 'acc_date_to')
                $( "#acc_date_from" ).datepicker("setEndDate", selectedDate );
            
            var acc_from = $("#acc_date_from").val().trim();
            var acc_to = $("#acc_date_to").val().trim();
            
            if(acc_from != '' && acc_to != ''){
                var customer = $("#customer").val().trim();
                if(acc_from > acc_to){
                    alert('Choose correct date interval..');
                }else if(customer != ''){
                    wrapLoader("#account_dates");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_customer_work_hours.php",
                        type:"POST",
                        data:'customer='+customer+'&acc_from='+acc_from+'&acc_to='+acc_to+'&fkkn=<?php echo $_smarty_tpl->tpl_vars['rpt_type']->value;?>
',
                        success:function(data){
                            $("#customer_hours").val(data);
                            uwrapLoader("#account_dates");
                        }
                    });
                }
            }
        });
        
        

        $.mask.definitions['~']='[1-9]';
        $("#signed_customer_telephone").mask("0?~9-999 99 99 99", { placeholder:" " });
        $("#signed_customer_ssn").mask("?99999999-9999", { placeholder:" " });
        $("#section6_phone").mask("0?~9-999 99 99 99", { placeholder:" " });
        
        $('#section_3_choice_2').change(function(){
            var org_no = '';
            if($('#section_3_choice_2:checked').val() == 1){
                org_no = $('#section_3_org_no').attr('data-org-no');
            }else{
                org_no = '';
                var reseted_orgno = $('#section_3_org_no').val();
                $('#section_3_org_no').attr('data-org-no', reseted_orgno);
            }
            $('#section_3_org_no').val(org_no);
        });
        
        $('[name=who_signed]').change(function(){
            var phno = $(this).attr('data-phone');
            var name = $(this).attr('data-name');
            var ssn = $(this).attr('data-ssn');
            $('#section6_phone').val(phno);
            $('#signed_customer_telephone').val(phno);
            $('#signed_customer_ssn').val(ssn);
            $('#signed_customer_name').val(name);
            $.mask.definitions['~']='[1-9]';
            $("#section6_phone").mask("0?~9-999 99 99 99", { placeholder:" " });
            $("#signed_customer_telephone").mask("0?~9-999 99 99 99", { placeholder:" " });
            $("#signed_customer_ssn").mask("?99999999-9999", { placeholder:" " });
        });

        $(".format_time_field").mask("99.99", { placeholder:"0" });
        
        //to format currency on page load
        $('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9  });
        $('#excl_ob_period, #ob_period, #asst_exp_period, #training_period, #staff_expense_period, #admin_period').formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9  });
        $("#total_cost").formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
        $("#total_period").formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
        
        // Format cost column input values(2nd column) while typing & warn on decimals entered, 2 decimal places 
        $('#excl_ob_period, #ob_period, #asst_exp_period, #training_period, #staff_expense_period, #admin_period').blur(function() {
                $(this).parent().find('.this_error_notify').html(null);
                $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9 });
        })
        .keyup(function(e) {
                var e = window.event || e;
                var keyUnicode = e.charCode || e.keyCode;
                if (e !== undefined) {
                        switch (keyUnicode) {
                                case 16: break; // Shift
                                case 17: break; // Ctrl
                                case 18: break; // Alt
                                case 27: this.value = ''; break; // Esc: clear entry
                                case 35: break; // End
                                case 36: break; // Home
                                case 37: break; // cursor left
                                case 38: break; // cursor up
                                case 39: break; // cursor right
                                case 40: break; // cursor down
                                case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                                case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                                case 190: break; // .
                                default: $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true, numberMaxLength: 9 });
                        }
                }
        })
        .bind('decimalsEntered', function(e, cents) {
                if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
        })
        .bind('checkMaxSize', function(e, intPart, cents) {
                
                if(intPart.length > 9){
                        var errorMsg = 'Maximum 9 digits decimal value';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                else if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                sum2();
        });
        
        //-------------------------------------------------------------------------------------------------------------------------------
        // Format time column input values(1st column) while typing & warn on decimals entered, 2 decimal places 
        $('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').blur(function() {
                $(this).parent().find('.this_error_notify').html(null);
                $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9 });
        })
        .keyup(function(e) {
                var e = window.event || e;
                var keyUnicode = e.charCode || e.keyCode;
                if (e !== undefined) {
                        switch (keyUnicode) {
                                case 16: break; // Shift
                                case 17: break; // Ctrl
                                case 18: break; // Alt
                                case 27: this.value = ''; break; // Esc: clear entry
                                case 35: break; // End
                                case 36: break; // Home
                                case 37: break; // cursor left
                                case 38: break; // cursor up
                                case 39: break; // cursor right
                                case 40: break; // cursor down
                                case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                                case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                                case 190: break; // .
                                default: $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true, numberMaxLength: 9 });
                        }
                }
        })
        .bind('decimalsEntered', function(e, cents) {
                if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
        })
        .bind('checkMaxSize', function(e, intPart, cents) {
                if(intPart.length > 9){
                        var errorMsg = 'Maximum 9 digits decimal value';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                else if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                sum1();
        });
        
    });

    (function( $ ){

        $.fn.uncheckableRadio = function() {

            return this.each(function() {
                $(this).mousedown(function() {
                    $(this).data('wasChecked', this.checked);
                });

                $(this).click(function() {
                    if ($(this).data('wasChecked'))
                        this.checked = false;
                });
            });

        };

        $('input[type=radio]').uncheckableRadio();

    })( jQuery );

        
    function saveForm(type){
        $('#save_print').val(type);
        if(type == 1)
                $("#input_form").attr('target','_blank');
         else
                $("#input_form").attr('target','_self');
         $("#input_form").submit();
         
        
    }
    /*            
        function sum1__(){
        	var excl_ob_cost = parseFloat($("#excl_ob_cost").val());
                if($.isNumeric(excl_ob_cost) === false){
                    excl_ob_cost = 0.00;
                    $("#excl_ob_cost").val('0.00');
                }
        	var ob_cost = parseFloat($("#ob_cost").val());
                if($.isNumeric(ob_cost) === false){
                    ob_cost = 0.00;
                    $("#ob_cost").val('0.00');
                }
        	var asst_exp_cost = parseFloat($("#asst_exp_cost").val());
                if($.isNumeric(asst_exp_cost) === false){
                    asst_exp_cost = 0.00;
                    $("#asst_exp_cost").val('0.00');
                }
        	var training_cost = parseFloat($("#training_cost").val());
                if($.isNumeric(training_cost) === false){
                    training_cost = 0.00;
                    $("#training_cost").val('0.00');
                }
        	var staff_expense_cost = parseFloat($("#staff_expense_cost").val());
                if($.isNumeric(staff_expense_cost) === false){
                    staff_expense_cost = 0.00;
                    $("#staff_expense_cost").val('0.00');
                }
        	var admin_cost = parseFloat($("#admin_cost").val());
                if($.isNumeric(admin_cost) === false){
                    admin_cost = 0.00;
                    $("#admin_cost").val('0.00');
                }	
        	var total_cost_hour = parseFloat(excl_ob_cost) + parseFloat(ob_cost)
                                        + parseFloat(asst_exp_cost) + parseFloat(training_cost)
                                        + parseFloat(staff_expense_cost) + parseFloat(admin_cost); 
                total_cost_hour = parseFloat(total_cost_hour).toFixed(2);
        	$("#total_cost").html(total_cost_hour);
        }  


        function sum2__(){ 
                var excl_ob_period = parseFloat($("#excl_ob_period").val());
                
                if($.isNumeric(excl_ob_period) === false){
                    excl_ob_period = 0.00;
                    $("#excl_ob_period").val('0.00');
                }
                var ob_period = parseFloat($("#ob_period").val());
                if($.isNumeric(ob_period) === false){
                    ob_period = 0.00;
                    $("#ob_period").val('0.00');
                }
                var asst_exp_period = parseFloat($("#asst_exp_period").val());
                if($.isNumeric(asst_exp_period) === false){
                    asst_exp_period = 0.00;
                    $("#asst_exp_period").val('0.00');
                }
                var training_period = parseFloat($("#training_period").val());
                if($.isNumeric(training_period) === false){
                    training_period = 0.00;
                    $("#training_period").val('0.00');
                }
                var staff_expense_period = parseFloat($("#staff_expense_period").val());
                if($.isNumeric(staff_expense_period) === false){
                    staff_expense_period = 0.00;
                    $("#staff_expense_period").val('0.00');
                }
                var admin_period = parseFloat($("#admin_period").val());
                if($.isNumeric(admin_period) === false){
                    admin_period = 0.00;
                    $("#admin_period").val('0.00');
                }
                
        	var total_cost_for_period = parseFloat(excl_ob_period) + parseFloat(ob_period)
                                        + parseFloat(asst_exp_period) + parseFloat(training_period)
                                        + parseFloat(staff_expense_period) + parseFloat(admin_period); 
                total_cost_for_period = parseFloat(total_cost_for_period).toFixed(2);
        	$("#total_period").html(total_cost_for_period);
        }*/          
                
    function sum1(){
    	var excl_ob_cost = ($("#excl_ob_cost").val());
            excl_ob_cost =  excl_ob_cost.replace(/\s/g, '');
            excl_ob_cost =  excl_ob_cost.replace(/,/g, '.');
            if($.isNumeric(excl_ob_cost) === false){
                excl_ob_cost = 0.00;
            }
    	var ob_cost = ($("#ob_cost").val());
            ob_cost =  ob_cost.replace(/\s/g, '');
            ob_cost =  ob_cost.replace(/,/g, '.');
            if($.isNumeric(ob_cost) === false){
                ob_cost = 0.00;
            }
    	var asst_exp_cost = ($("#asst_exp_cost").val());
            asst_exp_cost =  asst_exp_cost.replace(/\s/g, '');
            asst_exp_cost =  asst_exp_cost.replace(/,/g, '.');
            if($.isNumeric(asst_exp_cost) === false){
                asst_exp_cost = 0.00;
            }
    	var training_cost = ($("#training_cost").val());
            training_cost =  training_cost.replace(/\s/g, '');
            training_cost =  training_cost.replace(/,/g, '.');
            if($.isNumeric(training_cost) === false){
                training_cost = 0.00;
            }
    	var staff_expense_cost = ($("#staff_expense_cost").val());
            staff_expense_cost =  staff_expense_cost.replace(/\s/g, '');
            staff_expense_cost =  staff_expense_cost.replace(/,/g, '.');
            if($.isNumeric(staff_expense_cost) === false){
                staff_expense_cost = 0.00;
            }
    	var admin_cost = ($("#admin_cost").val());
            admin_cost =  admin_cost.replace(/\s/g, '');
            admin_cost =  admin_cost.replace(/,/g, '.');
            if($.isNumeric(admin_cost) === false){
                admin_cost = 0.00;
            }
            
    	var total_cost_hour = parseFloat(excl_ob_cost) + parseFloat(ob_cost)
                                    + parseFloat(asst_exp_cost) + parseFloat(training_cost)
                                    + parseFloat(staff_expense_cost) + parseFloat(admin_cost); 
            total_cost_hour = parseFloat(total_cost_hour).toFixed(2);
    	$("#total_cost").html(total_cost_hour).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
    }            

    function sum2(){ 
        var excl_ob_period = $("#excl_ob_period").val();
        excl_ob_period =  excl_ob_period.replace(/\s/g, '');
        excl_ob_period =  excl_ob_period.replace(/,/g, '.');
        if($.isNumeric(excl_ob_period) === false){
            excl_ob_period = 0.00;
        }
        var ob_period = ($("#ob_period").val());
        ob_period =  ob_period.replace(/\s/g, '');
        ob_period =  ob_period.replace(/,/g, '.');
        if($.isNumeric(ob_period) === false){
            ob_period = 0.00;
        }
        var asst_exp_period = ($("#asst_exp_period").val());
        asst_exp_period =  asst_exp_period.replace(/\s/g, '');
        asst_exp_period =  asst_exp_period.replace(/,/g, '.');
        if($.isNumeric(asst_exp_period) === false){
            asst_exp_period = 0.00;
        }
        var training_period = ($("#training_period").val());
        training_period =  training_period.replace(/\s/g, '');
        training_period =  training_period.replace(/,/g, '.');
        
        if($.isNumeric(training_period) === false){
            training_period = 0.00;
        }
        var staff_expense_period = ($("#staff_expense_period").val());
        staff_expense_period =  staff_expense_period.replace(/\s/g, '');
        staff_expense_period =  staff_expense_period.replace(/,/g, '.');
        if($.isNumeric(staff_expense_period) === false){
            staff_expense_period = 0.00;
        }
        var admin_period =$("#admin_period").val();
        admin_period =  admin_period.replace(/\s/g, '');
        admin_period =  admin_period.replace(/,/g, '.');
        if($.isNumeric(admin_period) === false){
            admin_period = 0.00;
        }
    	var total_cost_for_period = parseFloat(excl_ob_period) + parseFloat(ob_period)
                                    + parseFloat(asst_exp_period) + parseFloat(training_period)
                                    + parseFloat(staff_expense_period) + parseFloat(admin_period); 
            total_cost_for_period = parseFloat(total_cost_for_period).toFixed(2);
    	$("#total_period").html(total_cost_for_period).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
    }
</script>

    </body>
</html><?php }} ?>