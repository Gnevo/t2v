<?php /* Smarty version Smarty-3.1.8, created on 2021-02-24 07:00:23
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/customer_week_month_report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12482254176035f987b8d2d7-96383526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce1ce3acb713400a55a19b93a8705fd7bb7d1dd4' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/customer_week_month_report.tpl',
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
  'nocache_hash' => '12482254176035f987b8d2d7-96383526',
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
  'unifunc' => 'content_6035f9899c4d68_63234912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035f9899c4d68_63234912')) {function content_6035f9899c4d68_63234912($_smarty_tpl) {?><!DOCTYPE html>
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
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
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
                                
    <div class="row-fluid">
        <div class="span12 main-left">    
            <div class="tbl_hd"><span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_monthly_report'];?>
</span>
                <a onclick="exceldownload()" href="javascript:void(0)" class="excel-print"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_excel'];?>
</span></a>
                <a onclick="printForm()" href="javascript:void(0)" class="print"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
reports/" class="back"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</a>
                <div style="float: right;margin: 10px 5px 0 0;">
                    <input type="radio" name="print_method" id="portrait" value="1" checked="checked" style="float: left;" /><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['portrait'];?>
</span>
                    <input type="radio" name="print_method" id="landscape" value="2" style="float: left;"/><span style="margin-left: 4px;margin-right: 5px;float: left;margin-top: -3px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['landscape'];?>
</span>
                </div>
            </div>

            <div id="tble_list">
                <div class="row-fluid">
                    <div class="option_strip span12" style="padding:0px 0px;">
                        <form id="employee_report" action="" method="post">
                            <input type="hidden" value="" id="action" name="action">
                            <input type="hidden" value="1" id="print_method_input" name="print_method_input">
                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['check_values']->value;?>
" id="check_values" name="check_values">
                            <div class="selected_report span6">
                                <div class="redgarea_block span12">
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-item_img" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></div>
                                        <div ><input name="normal_check" id="normal_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[0]==1||$_smarty_tpl->tpl_vars['start']->value==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-travel" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"></div>
                                        <div ><input name="travel_check" id="travel_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[1]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-lunch" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"></div>
                                        <div ><input name="break_check" id="break_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[2]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"></div>
                                        <div ><input name="oncall_check" id="oncall_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[3]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"></div>
                                        <div ><input name="overtime_check" id="overtime_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[4]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_quality_overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"></div>
                                        <div ><input name="quality_overtime_check"id="quality_overtime_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[5]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_more_overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"></div>
                                        <div ><input name="moretime_check" id="moretime_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[6]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_some_other_time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
"></div>
                                        <div ><input name="some_other_check" id="some_other_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[7]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_training_org" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"></div>
                                        <div ><input name="training_check" id="training_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[8]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_caltraining" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
"></div>
                                        <div ><input name="call_training_check" id="call_training_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[9]==1){?>checked="checked"<?php }?>></div>
                                    </div>

                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_personalmeeting" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
" ></div>
                                        <div ><input name="personal_meeting_check" id="personal_meeting_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[10]==1){?>checked="checked"<?php }?>></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_voluntary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
" ></div>
                                        <div ><input name="voluntary_check" id="voluntary_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[11]==1){?>checked="checked"<?php }?>></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_complementary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
" ></div>
                                        <div ><input name="complementary_check" id="complementary_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[12]==1){?>checked="checked"<?php }?>></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_complementary_oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
" ></div>
                                        <div ><input name="complementary_oncall_check" id="complementary_oncall_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[13]==1){?>checked="checked"<?php }?>></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_more_oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
" ></div>
                                        <div ><input name="more_oncall_check" id="more_oncall_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[14]==1){?>checked="checked"<?php }?>></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_oncall_standby" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
" ></div>
                                        <div ><input name="oncall_standby_check" id="oncall_standby_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[15]==1){?>checked="checked"<?php }?>></div>
                                    </div>
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_dismissal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
" ></div>
                                        <div><input name="work_for_dismissal_check" id="work_for_dismissal_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[16]==1){?>checked="checked"<?php }?>></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div class="sprite_week_report_icons sprite-ico_dismissal_oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
" ></div>
                                        <div><input name="work_for_dismissal_oncall_check" id="work_for_dismissal_oncall_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
" value="1" onclick="typesSelectionForReport()" <?php if ($_smarty_tpl->tpl_vars['checks']->value[17]==1){?>checked="checked"<?php }?>></div>
                                    </div> 
                                    <div class="redgarea_icon clearfix" style="width: 18px;">
                                        <div style="margin-left: 0px;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_all_type'];?>
" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['check'];?>
</div>
                                        <div  style="margin-left: 8px;"><input style="margin-top: 5px;" name="select_all_check" id="select_all_check" type="checkbox" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_all_type'];?>
" value="1" onclick="select_all_types()" <?php if ($_smarty_tpl->tpl_vars['check_values']->value=='1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'){?>checked="checked"<?php }?>></div>
                                    </div>

                                </div>
                                <div class="assist span12 no-ml">
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=4){?>
                                        <select name="customer" id="customer" style="width: 155px" class="pull-left mr">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['cust']->value==$_smarty_tpl->tpl_vars['customer']->value['username']){?> selected="selected" <?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
<?php }?></option>
                                            <?php } ?>
                                        </select>
                                    <?php }else{ ?>
                                        <input type="hidden" name="customer" id="customer" value="<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
"/>
                                    <?php }?>

                                    <div class="input-prepend date datepicker pull-left no-pt" id="start_date_div" style="width: 93px; float: left;">
                                        <span class="add-on icon-calendar"></span>
                                        <input type="text" name="start_date" id="start_date" value="<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
" class="form-control span12">
                                    </div>
                                    <div class="input-prepend date datepicker pull-left no-pt" id="end_date_div" style="width: 93px; float: left;">
                                        <span class="add-on icon-calendar"></span>
                                        <input type="text" name="end_date" id="end_date" value="<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
" class="form-control span12">
                                    </div>
                                    
                                    
                                    <input type="submit" name="add" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
" />
                                </div>
                            </div>
                            <div class="result_report span6 no-ml" style="margin-top: 5px; float: right;">
                                <!--<div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;"></span> <span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['contract_hours']->value;?>
</span></div>-->
                                <div class="reportemploye_contactlft" style="margin-right: 3px;">
                                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_hour'];?>
</span>
                                    <div class="fk_kn" style="width: 100px">
                                        <div style="height:25px; padding-left:11px; border-bottom:1px solid #E4E4E4;">
                                            <span>FK</span><span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['contract_fk']->value;?>
</span>
                                        </div> 
                                        <div style="height:25px; padding-left:11px;">
                                            <span>KN</span><span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['contract_kn']->value;?>
</span>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="reportemploye_contact"><span style="border-right:1px solid #E4E4E4;">Worked Hours</span> <span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['time_sum']->value;?>
</span></div>-->
                                <div class="reportemploye_contactlft">
                                    <span><?php echo $_smarty_tpl->tpl_vars['translate']->value['worked_hour'];?>
</span>
                                    <div class="fk_kn" style="width: 100px">
                                        <div style="height:25px; padding-left:11px; border-bottom:1px solid #E4E4E4;">
                                            <span>FK</span><span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['time_fk']->value;?>
</span>
                                        </div> 
                                        <div style="height:25px; padding-left:11px;">
                                            <span>KN</span><span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['time_kn']->value;?>
</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                        
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_variable(0, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['report'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['report']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reports']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['report']->key => $_smarty_tpl->tpl_vars['report']->value){
$_smarty_tpl->tpl_vars['report']->_loop = true;
?>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="week_num"><?php echo $_smarty_tpl->tpl_vars['translate']->value['week'];?>
 <?php echo $_smarty_tpl->tpl_vars['report']->value['week'];?>
</div>
                            <!--<div id="div_fix_<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['scroll_lengths']->value[$_smarty_tpl->tpl_vars['j']->value]['sum']<=5){?>style="overflow-x: hidden; overflow-y: hidden" <?php }else{ ?>style="overflow-x: scroll; overflow-y: hidden" <?php }?>>-->
                            <div id="div_fix_<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
">
                                <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_variable($_smarty_tpl->tpl_vars['j']->value+1, null, 0);?>
                                <table  class="table_list tbl_padding_fix" style="width: 100%;">
                                    <?php $_smarty_tpl->tpl_vars['sun_sum'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_mon'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_tue'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_wed'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_thu'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_fri'] = new Smarty_variable(0.0, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['sun_sat'] = new Smarty_variable(0.0, null, 0);?>
                                    <tr><th width="110px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['mon'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['mon'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['mon'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['mon'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['mon'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['tue'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['tue'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['tue'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tue'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['tue'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['wed'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['wed'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['wed'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['wed'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['wed'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?> onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['thu'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['thu'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['thu'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['thu'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['thu'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['fri'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['fri'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['fri'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['fri'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['fri'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['sat'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['sat'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['sat'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sat'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['sat'][0];?>
</a></th><th width="110px"><a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['report']->value['sun'][2];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['sun'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['report']->value['sun'][0];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['cust']->value;?>
&return_page=cust_report&rep_start_date=<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
&rep_end_date=<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
', 1)" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slots'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sun'];?>
  <?php echo $_smarty_tpl->tpl_vars['report']->value['sun'][0];?>
</a></th><th width="80px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['total'];?>
</th></tr>
                                    
                                    <?php  $_smarty_tpl->tpl_vars['emp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['emp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value['employee']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['emp']->key => $_smarty_tpl->tpl_vars['emp']->value){
$_smarty_tpl->tpl_vars['emp']->_loop = true;
?>
                                        <tr class="odd"> 
                                            <td style="padding-left: 5px;border-left:3px solid <?php echo $_smarty_tpl->tpl_vars['emp']->value['color'];?>
;"><?php echo $_smarty_tpl->tpl_vars['emp']->value['name'];?>
</td>
                                            <td>
                                                <?php  $_smarty_tpl->tpl_vars['mon'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mon']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Mon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mon']->key => $_smarty_tpl->tpl_vars['mon']->value){
$_smarty_tpl->tpl_vars['mon']->_loop = true;
?>
                                                    <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['mon']->value), null, 0);?>
                                                    <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                        <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                        <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                        <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                        <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;" > <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?>  </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_time"  style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?> 
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                    <?php }?>
                                                <?php }
if (!$_smarty_tpl->tpl_vars['mon']->_loop) {
?>
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                <?php } ?>
                                            </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['tue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Tue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tue']->key => $_smarty_tpl->tpl_vars['tue']->value){
$_smarty_tpl->tpl_vars['tue']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['tue']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_tue'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_tue']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['row'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value+$_smarty_tpl->tpl_vars['man']->value[0], null, 0);?><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_tue'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_tue']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['row'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value+$_smarty_tpl->tpl_vars['man']->value[0], null, 0);?><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_tue'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_tue']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['row'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value+$_smarty_tpl->tpl_vars['man']->value[0], null, 0);?><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_tue'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_tue']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?> 
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?> 
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?> 
                                                    <?php }?>
                                                <?php }
if (!$_smarty_tpl->tpl_vars['tue']->_loop) {
?>
                                                <div   style="padding: 4px 0 4px 1px;" ></div>
                                            <?php } ?>
                                        </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['wed'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wed']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Wed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wed']->key => $_smarty_tpl->tpl_vars['wed']->value){
$_smarty_tpl->tpl_vars['wed']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['wed']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_wed'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_wed']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_wed'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_wed']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_wed'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_wed']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_wed'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_wed']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?> 
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }?>
                                                <?php }
if (!$_smarty_tpl->tpl_vars['wed']->_loop) {
?>
                                                <div   style="padding: 4px 0 4px 1px;" ></div>
                                            <?php } ?>
                                        </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['thu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['thu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Thu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['thu']->key => $_smarty_tpl->tpl_vars['thu']->value){
$_smarty_tpl->tpl_vars['thu']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['thu']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_thu'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_thu']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_thu'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_thu']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_thu'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_thu']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_thu'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_thu']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['thu']->_loop) {
?>
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    <?php } ?>
                                            </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['fri'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fri']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Fri']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fri']->key => $_smarty_tpl->tpl_vars['fri']->value){
$_smarty_tpl->tpl_vars['fri']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['fri']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_fri'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_fri']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_fri'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_fri']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_fri'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_fri']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_fri'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_fri']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['fri']->_loop) {
?>
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    <?php } ?>
                                            </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['sat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Sat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sat']->key => $_smarty_tpl->tpl_vars['sat']->value){
$_smarty_tpl->tpl_vars['sat']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['sat']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sat'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sat']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sat'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sat']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sat'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sat']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sat'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sat']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['sat']->_loop) {
?>
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    <?php } ?>
                                                </td>
                                            <td><?php  $_smarty_tpl->tpl_vars['sun'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sun']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emp']->value['Sun']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sun']->key => $_smarty_tpl->tpl_vars['sun']->value){
$_smarty_tpl->tpl_vars['sun']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['sun']->value), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                    <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                    <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?></div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sun'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sun']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sun'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sun']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sun'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sun']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php $_smarty_tpl->tpl_vars['time'] = new Smarty_variable(explode("-",$_smarty_tpl->tpl_vars['man']->value[0]), null, 0);?> <?php $_smarty_tpl->tpl_vars['sun_sun'] = new Smarty_variable($_smarty_tpl->tpl_vars['sun_sun']->value+($_smarty_tpl->tpl_vars['time']->value[1]-$_smarty_tpl->tpl_vars['time']->value[0]), null, 0);?>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                    <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
 <?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                        <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?>
                                                        <div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?>
                                                        <div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }else{ ?>
                                                        <div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['sun']->_loop) {
?>
                                                    <div   style="padding: 4px 0 4px 1px;" ></div>
                                                    <?php } ?></td>
                                            <th><?php echo $_smarty_tpl->tpl_vars['emp']->value['sum'];?>
</th>
                                        </tr>
                                    <?php } ?>

                                    
                                    <?php if (isset($_smarty_tpl->tpl_vars['report']->value['unmanned'])&&!empty($_smarty_tpl->tpl_vars['report']->value['unmanned'])){?>
                                        <tr class="odd"> 
                                            <td style="padding-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned'];?>
</td>
                                            <?php  $_smarty_tpl->tpl_vars['day_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_name']->_loop = false;
 $_from = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_name']->key => $_smarty_tpl->tpl_vars['day_name']->value){
$_smarty_tpl->tpl_vars['day_name']->_loop = true;
?>
                                                <td>
                                                    <?php if (isset($_smarty_tpl->tpl_vars['report']->value['unmanned'][$_smarty_tpl->tpl_vars['day_name']->value])&&!empty($_smarty_tpl->tpl_vars['report']->value['unmanned'][$_smarty_tpl->tpl_vars['day_name']->value])){?>
                                                        <?php  $_smarty_tpl->tpl_vars['mon'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mon']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value['unmanned'][$_smarty_tpl->tpl_vars['day_name']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mon']->key => $_smarty_tpl->tpl_vars['mon']->value){
$_smarty_tpl->tpl_vars['mon']->_loop = true;
?>
                                                            <?php $_smarty_tpl->tpl_vars['man'] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['mon']->value), null, 0);?>
                                                            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                                <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[5], null, 0);?>
                                                                <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['man']->value[6], null, 0);?>
                                                                <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[5] = $_smarty_tpl->tpl_vars['temp2']->value;?>
                                                                <?php $_smarty_tpl->createLocalArrayVariable('man', null, 0);
$_smarty_tpl->tpl_vars['man']->value[6] = $_smarty_tpl->tpl_vars['temp']->value;?>
                                                            <?php }?>
                                                            <?php if ($_smarty_tpl->tpl_vars['man']->value[1]=="0"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;" > <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="1"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="2"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="3"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?>  </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
) J <?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="4"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="5"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_time"  style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="6"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_quality_overtime" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="7"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_some_other_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="8"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="9"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"><?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="10"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?> 
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="11"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="12"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="13"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_training_time" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="14"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="15"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="16"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }elseif($_smarty_tpl->tpl_vars['man']->value[1]=="17"){?>
                                                                <?php if ($_smarty_tpl->tpl_vars['man']->value[2]=="1"){?><div  class="mini_time_slot_more_oncall" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['man']->value[2]=="2"){?><div  class="mini_time_slot_leave" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div>
                                                                <?php }else{ ?><div  class="mini_time_slot_unassign" style="padding: 4px 0 4px 1px;"> <?php echo $_smarty_tpl->tpl_vars['man']->value[0];?>
(<?php echo $_smarty_tpl->tpl_vars['man']->value[3];?>
)<?php if ($_smarty_tpl->tpl_vars['cust']->value==''){?><br><?php echo $_smarty_tpl->tpl_vars['man']->value[5];?>
 <?php echo $_smarty_tpl->tpl_vars['man']->value[6];?>
<?php }?> </div><?php }?>
                                                            <?php }?>
                                                        <?php }
if (!$_smarty_tpl->tpl_vars['mon']->_loop) {
?>
                                                            <div   style="padding: 4px 0 4px 1px;" ></div>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <div style="padding: 4px 0 4px 1px;" ></div>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            
                                            <th><?php echo $_smarty_tpl->tpl_vars['report']->value['unmanned']['sum'];?>
</th>
                                        </tr>
                                    <?php }?>
                                    <tr>
                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['total'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['mon'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['tue'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['wed'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['thu'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['fri'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['sat'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['sun'];?>
</th>
                                        <th><?php echo sprintf('%.02f',round($_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['mon']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['tue']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['wed']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['thu']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['fri']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['sat']+$_smarty_tpl->tpl_vars['sums']->value[$_smarty_tpl->tpl_vars['i']->value]['sun'],2));?>
</th>
                                    </tr>
                                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                </table>
                            </div>
                        </div>
                    </div>    
                    <br>
                <?php } ?>
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
<script type="text/javascript">
    function printForm(){
        if(/*$("#customer").val() != "" && */$("#start_date").val() != "" && $("#end_date").val() != ""){
            //        var f = $("#customer_report");
            //        f.attr('target', '_BLANK');
            //        $('#action').val('print');
            //        f.submit();
            //        f.attr('target', '_SELF');
            //        $('#action').val('');
            var start_date= $("#start_date").val();
            var end_date= $("#end_date").val();
            var customer= $("#customer").val();
            var method_print= $("#print_method_input").val();
            var check_values= $("#check_values").val();
            if(customer == '')
                customer = '-';
            //        alert(month + ' ' + year + ' ' + customer);
            window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/month/week/customer/'+customer+'/'+start_date+'/'+end_date+'/'+method_print+'/'+check_values+'/');
        }
    }

    function exceldownload(){
        if($("#start_date").val() != "" && $("#end_date").val() != ""){
            var start_date= $("#start_date").val();
            var end_date= $("#end_date").val();
            var customer= $("#customer").val();
            var method_print= 'EXCEL';
            var check_values= $("#check_values").val();
            if(customer == '')
                customer = '-';
            window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/month/week/customer/'+customer+'/'+start_date+'/'+end_date+'/'+method_print+'/'+check_values+'/');
        }
    }
    
$(document).ready(function(){
    $("input:radio[name=print_method]").click(function() {
        var value = $(this).val();
        $("#print_method_input").val(value);
    });
    
    /*$( "#start_date, #end_date" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
            buttonImageOnly: true
    });*/
    $( ".datepicker" ).datepicker({
            autoclose: true,
            calendarWeeks: true,
            weekStart: 1
    });
});
   /* $(document).ready(function(event)
    {
         event.preventDefault() 
    });*/

function typesSelectionForReport(){
    var report = new Array();
    if($("#normal_check").attr('checked')){
        report[0] = 1;
    }else{
        report[0] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#travel_check").attr('checked')){
        report[1] = 1;
    }else{
        report[1] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#break_check").attr('checked')){
        report[2] = 1;
    }else{
        report[2] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#oncall_check").attr('checked')){
        report[3] = 1;
    }else{
        report[3] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#overtime_check").attr('checked')){
        report[4] = 1;
    }else{
        report[4] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#quality_overtime_check").attr('checked')){
        report[5] = 1;
    }else{
        report[5] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#moretime_check").attr('checked')){
        report[6] = 1;
    }else{
        report[6] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#some_other_check").attr('checked')){
        report[7] = 1;
    }else{
        report[7] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#training_check").attr('checked')){
        report[8] = 1;
    }else{
        report[8] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#call_training_check").attr('checked')){
        report[9] = 1;
    }else{
        report[9] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#personal_meeting_check").attr('checked')){
        report[10] = 1;
    }else{
        report[10] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#voluntary_check").attr('checked')){
        report[11] = 1;
    }else{
        report[11] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#complementary_check").attr('checked')){
        report[12] = 1;
    }else{
        report[12] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#complementary_oncall_check").attr('checked')){
        report[13] = 1;
    }else{
        report[13] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#more_oncall_check").attr('checked')){
        report[14] = 1;
    }else{
        report[14] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#oncall_standby_check").attr('checked')){
        report[15] = 1;
    }else{
        report[15] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#work_for_dismissal_check").attr('checked')){
        report[16] = 1;
    }else{
        report[16] = 0;
        $("#select_all_check").prop('checked',false);
    }
    if($("#work_for_dismissal_oncall_check").attr('checked')){
        report[17] = 1;
    }else{
        report[17] = 0;
        $("#select_all_check").prop('checked',false);
    }
    var temp_string = "";
    for(var i=0;i <report.length;i++){
        if(i == 0){
            temp_string = report[0];
        }else{
            temp_string = temp_string+","+report[i];
        }
    }
    if(temp_string == '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1')
        $("#select_all_check").prop('checked',true);
    $("#check_values").val(temp_string);
    
}

function select_all_types(){
    if($("#select_all_check").attr('checked')){
        $('.selected_report input:checkbox').each(function() {
            $(this).prop('checked',true)
        });
    }else{
        $('.selected_report input:checkbox').each(function() {
            $(this).prop('checked',false)
        });
    }
    typesSelectionForReport();
}
      
</script>

    </body>
</html><?php }} ?>