<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 14:00:47
         compiled from "/home/time2view/public_html/cirrus/templates/employee_salary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20240352555fce358fa32b47-24153598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f369a9eae39a920dfac29c4321aa899b7641ced' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/employee_salary.tpl',
      1 => 1517480416,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20240352555fce358fa32b47-24153598',
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
  'unifunc' => 'content_5fce358fe590d8_06465765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce358fe590d8_06465765')) {function content_5fce358fe590d8_06465765($_smarty_tpl) {?><!DOCTYPE html>
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
css/jquery.jscrollpane.css" media="all" />

<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
<style type="text/css">
        .scroll-pane, .scroll-pane-arrows {
                width: 100%;
                height: 200px;
                overflow: auto;
        }
        .horizontal-only {
                height: auto;
                max-height: 200px;
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
        <div class="span12 main-left boxscroll">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                    <div class="widget option-panel-widget" style="margin: 0 !important;">
                        <div class="widget-body">
                            <div class="row-fluid">
                                <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
 : </strong><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['social_security'];?>
</div>
                                <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['code'];?>
 : </strong><?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['code'];?>
</div>
                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                    <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 : </strong><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name']);?>
</div>
                                <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                    <div class="span4 top-customer-info"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
 : </strong><?php echo (($_smarty_tpl->tpl_vars['employee_detail']->value[0]['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee_detail']->value[0]['last_name']);?>
</div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
                
                
                 <div class="row-fluid">
                <div class="span12">
                  <div class="tab-content-switch-con" >
                    <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?> 
                        <div class="span12">
                            <div style="display: none;" class="scroller scroller-left"><span class="icon-chevron-left"></span></div>
                            <div style="display: none;" class="scroller scroller-right"><span class="icon-chevron-right"></span></div>
                            <div style="margin: 0px ! important;" class="wrapper">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs list" role="tablist" id="myTab" style="left:0 !important;">
                                    <?php if ($_smarty_tpl->tpl_vars['user_roles_login']->value!=3&&$_smarty_tpl->tpl_vars['user_roles_login']->value!=4){?><li role="presentation"><a href="javascript:void(0)" onclick="loadAddEmployee()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_contract']==1){?><li role="presentation"><a href="javascript:void(0)" onclick="loadContract()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_salary']==1){?><li role="presentation" class="active"><a href="javascript:void(0)" onclick="loadSalary()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_notification']==1){?><li role="presentation"><a href="javascript:void(0)" onclick="loadNotification()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_notification'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_privileges']==1&&$_smarty_tpl->tpl_vars['employee_role']->value!=1){?><li class="" role="presentation"><a href="javascript:void(0)" onclick="loadPrivilege()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_previlege'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_cv']==1){?><li role="presentation"><a href="javascript:void(0)" onclick="loadSkills()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skills'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_documentation']==1){?><li role="presentation"><a href="javascript:void(0)" onclick="loadDocumentation()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['documentation'];?>
</a></li><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['employee_settings_preference']==1){?><li role="presentation"><a href="javascript:void(0)" onclick="loadPrifferedTime()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_preferredtime'];?>
</a></li><?php }?>
                                </ul>
                            </div>
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                          <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                      <button class="btn btn-default btn-normal span2 pull-right" type="button" onclick="saveForm()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                        <button class="btn btn-default btn-normal span2 pull-right" type="button" onclick="backForm()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                     </div>
                                </div>
                        </div>
                        <?php }?>
                    </div>
                      <div class="tab-content-con boxscroll">
                        <div class="tab-content span12" style="margin:0;">
                        <div role="tabpanel" class="tab-pane active">
                        <form id="form" name="form" method="post" action="" style="float:left; width:100%;">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail']->value[0]['username'];?>
" />
                        <input type="hidden" name="cur_role" id="cur_role" value="<?php echo $_smarty_tpl->tpl_vars['employee_role']->value;?>
" />
                        <input type="hidden" name="new" id="new" value="0" />
                        <input type="hidden" name="action" id="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <input type="hidden" name="clone_type" id="clone_type" value="<?php echo $_smarty_tpl->tpl_vars['clone']->value;?>
" />
                        <div class="tab-content span12" style="margin:0;">
                            <div id="left_message_wraper" class="span12 no-min-height no-ml"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
                            <!--////////////////////////////////////////TAB 1 BEGIN///////////////////////////////////////////////-->
                        
                                <div class="span12 widget-body-section input-group">
                                    <div class="row-fluid">
                                        <div class="span4 worker_left" <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>id="employee_tab_content_emp"<?php }else{ ?>id="employee_tab_content" <?php }?>>
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient_salaries'];?>
</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_from'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from" id="effect_from" type="text" onchange="makeChange()" <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_i'){?> value="<?php echo $_smarty_tpl->tpl_vars['effect_from']->value;?>
"<?php }else{ ?>value="<?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_from'];?>
"<?php }?> /> 
                                                        </div>
                                                        <input type="hidden" name="effect_from_inconv_old"   style="width: 40%" id="effect_from_inconv_old" value="<?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_from'];?>
" onchange="makeChange()"/>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['action']->value=='edit'&&$_smarty_tpl->tpl_vars['effects']->value['effect_to']!="0000-00-00"){?>   
                                                        <div style="margin: 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_to'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span11" name="effect_to" id="effect_to" type="text" <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_i'){?> <?php if ($_smarty_tpl->tpl_vars['effect_to']->value=='0000-00-00'){?>value ="" <?php }else{ ?>value="<?php echo $_smarty_tpl->tpl_vars['effect_to']->value;?>
"<?php }?><?php }else{ ?> <?php if ($_smarty_tpl->tpl_vars['effects']->value['effect_to']=='0000-00-00'){?>value="" <?php }else{ ?>value="<?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_to'];?>
"<?php }?> <?php }?> onchange="makeChange()" /> 
                                                            </div>
                                                            <input type="hidden" name="effect_to_inconv_old"  id="effect_to_inconv_old" style="width: 40%" <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_i'){?> value="<?php echo $_smarty_tpl->tpl_vars['effect_to']->value;?>
" <?php }else{ ?>value="<?php echo $_smarty_tpl->tpl_vars['effects']->value['effect_to'];?>
"<?php }?>  onchange="makeChange()"/>
                                                        </div>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_i'){?>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['translate']->value['increment'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> 
                                                                <span class="add-on icon-pencil"></span>
                                                                <input value="" class="form-control span11" name="increment_i" id="increment_i" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable(1, null, 0);?>
                                                    <?php  $_smarty_tpl->tpl_vars['inconv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['inconv']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inconvs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['inconv']->key => $_smarty_tpl->tpl_vars['inconv']->value){
$_smarty_tpl->tpl_vars['inconv']->_loop = true;
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['inconv']->value['type']==3){?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['amount'];?>
" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['amount'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_call_training'];?>
" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_call_training'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="care_of"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_complementary_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_complementary_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_more_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_more_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_dismissal_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_dismissal_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                        <?php }else{ ?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['amount'];?>
" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['amount'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_call_training'];?>
" class="form-control span11 comma_dec" name="amount[]" id="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_call_training'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="care_of"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_complementary_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_complementary_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12 hide">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_more_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_more_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                            <div style="margin: 10px 0px 0px;" class="span12">
                                                                <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['inconv']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
</label>
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <input value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_dismissal_oncall'];?>
" class="form-control span11 comma_dec" id="amount[]" name="amount[]" type="text" onchange="makeChange()" /> 
                                                                    <input type="hidden" name="group_id[]" id="group_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['inconvenient_group_id'];?>
" onchange="makeChange()"/>
                                                                    <input type="hidden" name="saved_id[]" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['id_i'];?>
"/>
                                                                    <input type="hidden" name="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" id="amt_<?php echo $_smarty_tpl->tpl_vars['inc']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inconv']->value['sal_dismissal_oncall'];?>
"/>
                                                                </div>
                                                            </div>
                                                            <?php $_smarty_tpl->tpl_vars['inc'] = new Smarty_variable($_smarty_tpl->tpl_vars['inc']->value+1, null, 0);?>
                                                        <?php }?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4"  id="information">
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['hourly_salary'];?>
</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_from'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from_normal" id="effect_from_normal" type="text" onchange="makeChange()" <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_n'){?> value="<?php echo $_smarty_tpl->tpl_vars['effect_from_normal']->value;?>
"<?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['effect_from'];?>
" <?php }?> /> 
                                                        </div>
                                                        <input type="hidden" name="effect_from_normal_old"   style="width: 40%" id="effect_from_normal_old"   value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['effect_from'];?>
"  onchange="makeChange()"/>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['action']->value=='edit'&&$_smarty_tpl->tpl_vars['normals']->value['effect_to']!='0000-00-00'){?>
                                                        <div style="margin: 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to_normal"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_to'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span11" name="effect_to_normal" id="effect_to_normal" type="text" <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_n'){?> <?php if ($_smarty_tpl->tpl_vars['effect_to_normal']->value=='0000-00-00'){?> value=""<?php }else{ ?>value="<?php echo $_smarty_tpl->tpl_vars['effect_to_normal']->value;?>
"<?php }?> <?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['normals']->value['effect_to']=='0000-00-00'){?>value=""<?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['effect_to'];?>
" <?php }?><?php }?> onchange="makeChange()" /> 
                                                            </div>
                                                            <input type="hidden" name="effect_to_normal_old"  id="effect_to_normal_old" style="width: 40%"  value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['effect_to'];?>
"   onchange="makeChange()"/>
                                                        </div>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_n'){?>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['translate']->value['increment'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> 
                                                                <span class="add-on icon-pencil"></span>
                                                                <input value="" class="form-control span11" name="increment" id="increment" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="normal"><?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['normal'];?>
" class="form-control span11 comma_dec" name="normal" id="normal" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="travel"><?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['travel'];?>
" class="form-control span11 comma_dec" name="travel" id="travel" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="wkend_travel"><?php echo $_smarty_tpl->tpl_vars['translate']->value['week_end_travel'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['week_end_travel'];?>
" class="form-control span11 comma_dec" id="wkend_travel" name="wkend_travel" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="break"><?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['break'];?>
" class="form-control span11 comma_dec" id="break" name="break" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="overtime"><?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['overtime'];?>
" class="form-control span11 comma_dec" id="overtime" name="overtime" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="qual_overtime"><?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['quality_overtime'];?>
" class="form-control span11 comma_dec" id="qual_overtime" name="qual_overtime" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="more_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['more_time'];?>
" class="form-control span11 comma_dec" id="more_time" name="more_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="some_other_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['some_other_time'];?>
" class="form-control span11 comma_dec" id="some_other_time" name="some_other_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="training_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['training_time'];?>
" class="form-control span11 comma_dec" id="training_time" name="training_time" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['salary_system']->value==3){?>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="call_training"><?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['call_training'];?>
" class="form-control span11 comma_dec" id="call_training" name="call_training" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="personal_meeting"><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['personal_meeting'];?>
" class="form-control span11 comma_dec" id="personal_meeting" name="personal_meeting" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="voluntary"><?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['voluntary'];?>
" class="form-control span11 comma_dec" id="voluntary" name="voluntary" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div> 
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="complementary"><?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['complementary'];?>
" class="form-control span11 comma_dec" id="complementary" name="complementary" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['salary_system']->value==3){?>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="complementary_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['complementary_oncall'];?>
" class="form-control span11 comma_dec" id="complementary_oncall" name="complementary_oncall" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="more_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['more_oncall'];?>
" class="form-control span11 comma_dec" id="more_oncall" name="more_oncall" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="standby"><?php echo $_smarty_tpl->tpl_vars['translate']->value['standby'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['standby'];?>
" class="form-control span11 comma_dec" id="standby" name="standby" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="work_for_dismissal"><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['w_dismissal'];?>
" class="form-control span11 comma_dec" id="work_for_dismissal" name="work_for_dismissal" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="work_for_dismissal_oncall"><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['w_dismissal_oncall'];?>
" class="form-control span11 comma_dec" id="work_for_dismissal_oncall" name="work_for_dismissal_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_big"><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday_big'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big'];?>
" class="form-control span11 comma_dec" id="holiday_big" name="holiday_big" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_big_oncall"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['holiday_big']).(' ')).($_smarty_tpl->tpl_vars['translate']->value['oncall']);?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big_oncall'];?>
" class="form-control span11 comma_dec" id="holiday_big_oncall" name="holiday_big_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_red"><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red'];?>
" class="form-control span11 comma_dec" id="holiday_red" name="holiday_red" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="holiday_red_oncall"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['holiday']).(' ')).($_smarty_tpl->tpl_vars['translate']->value['oncall']);?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red_oncall'];?>
" class="form-control span11 comma_dec" id="holiday_red_oncall" name="holiday_red_oncall" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="amount"><?php echo $_smarty_tpl->tpl_vars['translate']->value['global_setting_insurance_personal'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['normals']->value['insurance'];?>
" class="form-control span11 comma_dec" id="insurance" name="insurance" type="text" onchange="makeChange()" /> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4"  id="relative_list">
                                            <div class="widget no-mb" style="margin-top:0;">
                                                <div class="widget-header span12">
                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_salary'];?>
</h1>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <div style="margin: 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="effect_from_monthly"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_from'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                            <span class="add-on icon-calendar"></span>
                                                            <input class="form-control span11" name="effect_from_monthly" id="effect_from_monthly" type="text" onchange="makeChange()" value="<?php echo $_smarty_tpl->tpl_vars['monthly']->value['date_from'];?>
" /> 
                                                        </div>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['action']->value=='edit'&&$_smarty_tpl->tpl_vars['monthly']->value['date_to']!=null){?>
                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                            <label style="float: left;" class="span12" for="effect_to_monthly"><?php echo $_smarty_tpl->tpl_vars['translate']->value['effect_to'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-pencil"></span>
                                                                <input value="<?php echo $_smarty_tpl->tpl_vars['monthly']->value['date_to'];?>
" class="form-control span11" id="effect_to_monthly" name="effect_to_monthly" type="text" onchange="makeChange()" /> 
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="" for="is_monthly_sal"><?php echo $_smarty_tpl->tpl_vars['translate']->value['is_monthly_salary'];?>
</label>
                                                        <div style="float: left; margin: 0px; text-align: left;" class="pl pt">
                                                            <input style="float: left;" class="form-control" type="checkbox" name="is_monthly_sal" id="is_monthly_sal" value="1" <?php if ($_smarty_tpl->tpl_vars['monthly_sals']->value==1){?>checked="checked"<?php }?> />
                                                        </div>
                                                    </div>
                                                    <div style="margin: 10px 0px 0px;" class="span12">
                                                        <label style="float: left;" class="span12" for="salary_per_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_per_month'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input value="<?php echo $_smarty_tpl->tpl_vars['monthly']->value['salary_per_month'];?>
" class="form-control span11 comma_dec" id="salary_per_month" name="salary_per_month" type="text" /> 
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
    <?php }else{ ?>
        <div class="message fail"><?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>
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
<script  type="text/javascript">
$(document).ready(function(){
    

    $(document).off('keyup', ".comma_dec")
                .on('keyup', ".comma_dec", function(e) {
                        // get keycode of current keypress event
                        var code = (e.keyCode || e.which);

                        // do nothing if it's an arrow key
                        if(code == 37 || code == 38 || code == 39 || code == 40) {
                            return;
                        }
                        var this_val = $(this).val();
                        var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                        $(this).val(new_val);
            });

    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-271});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    
    $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
    });

    <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_n'){?> 	
    $("#increment").change(function(){
        var inc = $("#increment").val();
        if(inc != "" && inc != null){
            inc = parseFloat(inc);
            var normal = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['normal'];?>
';
            normal = parseFloat(normal);
            normal = normal + ((normal * inc)/100);
            $("#normal").val(parseFloat(normal).toFixed(2));

            var travel = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['travel'];?>
';
            travel = parseFloat(travel);
            travel = travel + ((travel * inc)/100);
            $("#travel").val(parseFloat(travel).toFixed(2));

            var breaks = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['break'];?>
';
            breaks = parseFloat(breaks);
            breaks = breaks + ((breaks * inc)/100);
            $("#break").val(parseFloat(breaks).toFixed(2));

            var oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['oncall'];?>
';
            oncall = parseFloat(oncall);
            oncall = oncall + ((oncall * inc)/100);
            $("#oncall").val(parseFloat(oncall).toFixed(2));

            var overtime = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['overtime'];?>
';
            overtime = parseFloat(overtime);
            overtime = overtime + ((overtime * inc)/100);
            $("#overtime").val(parseFloat(overtime).toFixed(2));

            var qual_overtime = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['quality_overtime'];?>
';
            qual_overtime = parseFloat(qual_overtime);
            qual_overtime = qual_overtime + ((qual_overtime * inc)/100);
            $("#qual_overtime").val(parseFloat(qual_overtime).toFixed(2));

            var more_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['more_time'];?>
';
            more_time = parseFloat(more_time);
            more_time = more_time + ((more_time * inc)/100);
            $("#more_time").val(parseFloat(more_time).toFixed(2));

            var some_other_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['some_other_time'];?>
';
            some_other_time = parseFloat(some_other_time);
            some_other_time = some_other_time + ((some_other_time * inc)/100);
            $("#some_other_time").val(parseFloat(some_other_time).toFixed(2));

            var training_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['training_time'];?>
';
            training_time = parseFloat(training_time);
            training_time = training_time + ((training_time * inc)/100);
            $("#training_time").val(parseFloat(training_time).toFixed(2));

            var call_training = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['call_training'];?>
';
            call_training = parseFloat(call_training);
            call_training = call_training + ((call_training * inc)/100);
            $("#call_training").val(parseFloat(call_training).toFixed(2));

            var personal_meeting = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['personal_meeting'];?>
';
            personal_meeting = parseFloat(personal_meeting);
            personal_meeting = personal_meeting + ((personal_meeting * inc)/100);
            $("#personal_meeting").val(parseFloat(personal_meeting).toFixed(2));

            var holiday_big = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big'];?>
';
            holiday_big = parseFloat(holiday_big);
            holiday_big = holiday_big + ((holiday_big * inc)/100);
            $("#holiday_big").val(parseFloat(holiday_big).toFixed(2));

            var holiday_big_oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big_oncall'];?>
';
            holiday_big_oncall = parseFloat(holiday_big_oncall);
            holiday_big_oncall = holiday_big_oncall + ((holiday_big_oncall * inc)/100);
            $("#holiday_big_oncall").val(parseFloat(holiday_big_oncall).toFixed(2));

            var holiday_red = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red'];?>
';
            holiday_red = parseFloat(holiday_red);
            holiday_red = holiday_red + ((holiday_red * inc)/100);
            $("#holiday_red").val(parseFloat(holiday_red).toFixed(2));

            var holiday_red_oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red_oncall'];?>
';
            holiday_red_oncall = parseFloat(holiday_red_oncall);
            holiday_red_oncall = holiday_red_oncall + ((holiday_red_oncall * inc)/100);
            $("#holiday_red_oncall").val(parseFloat(holiday_red_oncall).toFixed(2));

            var insurance = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['insurance'];?>
';
            insurance = parseFloat(insurance);
            insurance = insurance + ((insurance * inc)/100);
            $("#insurance").val(parseFloat(insurance).toFixed(2));

        } else{
            var normal = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['normal'];?>
';
            $("#normal").val(normal);

            var travel = parseFloat('<?php echo $_smarty_tpl->tpl_vars['normals']->value['travel'];?>
');
            $("#travel").val(travel);

            var breaks = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['break'];?>
';
            $("#break").val(breaks);

            var oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['oncall'];?>
';
            $("#oncall").val(oncall);

            var overtime = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['overtime'];?>
';
            $("#overtime").val(overtime);

            var qual_overtime = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['quality_overtime'];?>
';
            $("#qual_overtime").val(qual_overtime);

            var more_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['more_time'];?>
';
            $("#more_time").val(more_time);

            var some_other_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['some_other_time'];?>
';
            $("#some_other_time").val(some_other_time);

            var training_time = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['training_time'];?>
';
            $("#training_time").val(training_time);

            var call_training = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['call_training'];?>
';
            $("#call_training").val(call_training);

            var personal_meeting = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['personal_meeting'];?>
';
            $("#personal_meeting").val(personal_meeting);

            var holiday_big = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big'];?>
';
            $("#holiday_big").val(holiday_big);

            var holiday_big_oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_big_oncall'];?>
';
            $("#holiday_big_oncall").val(holiday_big_oncall);

            var holiday_red = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red'];?>
';
            $("#holiday_red").val(holiday_red);

            var holiday_red_oncall = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['holiday_red_oncall'];?>
';
            $("#holiday_red_oncall").val(holiday_red_oncall);

            var insurance = '<?php echo $_smarty_tpl->tpl_vars['normals']->value['insurance'];?>
';
            $("#insurance").val(insurance);
        }
        
    });<?php }?>
    <?php if ($_smarty_tpl->tpl_vars['clone']->value=='clone_i'){?> 
        $("#increment_i").blur(function(){
            var inc = $("#increment_i").val();
            if(inc != "" && inc != null){
                inc = parseFloat(inc);
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['inconv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['inconv']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inconvs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['inconv']->key => $_smarty_tpl->tpl_vars['inconv']->value){
$_smarty_tpl->tpl_vars['inconv']->_loop = true;
?>
                    var insurance = $('#amt_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
').val();
                    insurance = parseFloat(insurance);
                    insurance = insurance + ((insurance * inc)/100);
                    $('#amt_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
').parent('.td_raw').children(".amount").val(parseFloat(insurance).toFixed(2));
                   <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                <?php } ?>
            }else{
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['inconv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['inconv']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inconvs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['inconv']->key => $_smarty_tpl->tpl_vars['inconv']->value){
$_smarty_tpl->tpl_vars['inconv']->_loop = true;
?>
                    var insurance = $('#amt_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
').val();
                    $('#amt_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
').parent('.td_raw').children(".amount").val(parseFloat(insurance).toFixed(2));
                   <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                <?php } ?>
            }
        });
    <?php }?>
     //$("#inconv").hide();
    var hides = '<?php echo $_smarty_tpl->tpl_vars['hides']->value;?>
';
    if(hides == 'n'){
       $('.worker_left').hide(); 
       $('#relative_list').hide(); 
       $('#information').show(); 
    }else if(hides == 'i'){
       $('#information').hide();
       $('#relative_list').hide(); 
       $('.worker_left').show();
    }else if(hides == 'm'){
       $('#information').hide();
       $('.worker_left').hide();
       $('#relative_list').show(); 
    }else{
        $('#information').show();
       $('.worker_left').show();
       $('#relative_list').show(); 
    }
    /*$( "#effect_from,#effect_to,#effect_from_normal,#effect_to_normal,#effect_to_monthly,#effect_from_monthly" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
            buttonImageOnly: true
    });*/
    $( "#effect_from" ).change(function(){
        //loadInconvTimes();
    });
    
});


function loadInconvTimes(){
    var effect_from = $("#effect_from").val();
    var effect_to = $("#effect_to").val();
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_select_inconvenient_times.php",
        type:"GET",
        data:"effect_from="+effect_from+"&effect_to="+effect_to,
        success:function(data){
            $("#inconv").html(data);
        }
    });
}

function saveForm(){
    var error = 0;
    var effect_from_inconv = $("#effect_from").val();
    var effect_to_inconv = $("#effect_to").val();
    var effect_from_inconv_old = $("#effect_from_inconv_old").val();
    var effect_from_normal = $("#effect_from_normal").val();
    var effect_to_normal = $("#effect_to_normal").val();
    var effect_from_normal_old = $("#effect_from_normal_old").val();
    var effect_from_monthly = $("#effect_from_monthly").val();
    var effect_to_monthly = $("#effect_to_monthly").val();
    var hides = '<?php echo $_smarty_tpl->tpl_vars['hides']->value;?>
';
//alert(effect_from_inconv+"  "+effect_from_inconv_old+ "  "+effect_from_normal+"  "+effect_from_normal_old);
    if(effect_from_inconv < effect_from_inconv_old && hides == 'i'){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_effect_from_greater'];?>
");
        error = 1;
    }
    if(effect_from_normal < effect_from_normal_old && hides == 'n'){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal_effect_from_greater'];?>
");
        error = 1;
    }
    if(effect_to_monthly < effect_from_monthly && effect_to_monthly != '0000-00-00' && effect_to_monthly != '' && hides == 'm'){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_effect_to_greaterthan'];?>
");
        error = 1;
    }
    if(hides == 'm' && (effect_from_monthly == null || effect_from_monthly == "")){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_effect_from'];?>
");
        error = 1;
    }
    if(hides == 'n' && (effect_from_normal == null || effect_from_normal == "")){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_effect_from'];?>
");
        error = 1;
    }
    if(hides == 'i' && (effect_from_inconv == null || effect_from_inconv == "")){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_effect_from'];?>
");
        error = 1;
    }
    if(effect_to_inconv < effect_from_inconv && effect_to_inconv != '0000-00-00' && effect_to_inconv != '' && hides == 'i'){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_effect_to_greaterthan'];?>
");
        error = 1;
    }
    if(effect_to_normal < effect_from_normal && effect_to_normal != '0000-00-00' && effect_to_normal != '' && hides == 'n'){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal_effect_to_greaterthan'];?>
");
        error = 1;
    }
    if(error == 0){
        $("#form").submit();
    }
   // $("#form").submit();
}

function backForm() {
    document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/';
}

function makeChange(){
    $("#new").val('1');
}

function loadAddEmployee(){
    var change = $("#new").val();
    if(change == "1"){
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
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/add/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
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
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
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
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/notification/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
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
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/privileges/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
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
                                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
emptime/preference/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
emptime/preference/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
}

</script>

    </body>
</html><?php }} ?>