<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 14:10:50
         compiled from "/home/time2view/public_html/cirrus/templates/message_center_leave.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6548876995fcb94ea505e27-91234627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cf841083cb6542cfffa0297ae326963980b3c23' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/message_center_leave.tpl',
      1 => 1561455074,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6548876995fcb94ea505e27-91234627',
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
  'unifunc' => 'content_5fcb94ea8cec71_19123991',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb94ea8cec71_19123991')) {function content_5fcb94ea8cec71_19123991($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_replace')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.replace.php';
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
css/message-center.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css" >
        #leave_details_tbl tr.dynamicRows td{ background-color: #e3edf0; }
        .contracts img, .settings img{ max-width: inherit; }
        .valign-top{ vertical-align: top !important; }
        .cancel-leave { margin-top:20px !important; }
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
                                
<div class="row-fluid" id="main_container">


    <div class="span12 main-left slot-form">
        <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['message_center'];?>
</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['approve_all_leave']==1&&$_smarty_tpl->tpl_vars['has_untreated_leaves']->value){?><button onclick="approve_all_leaves();" class="btn btn-default btn-normal pull-right" name="approve_all_leaves" id="approve_all_leaves" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve_all_leave'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['approve_all_leave'];?>
 </button><?php }?>
                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget" style="margin:0 0 10px 0 !important;">
                        <div class="span12 widget-body-section input-group"  id="search-section">

                                <div class="span2 cmb-year" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_year"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span10">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span9" name='cmb_year' id='cmb_year'>
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_year'];?>
</option>
                                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values']->value),$_smarty_tpl);?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-month" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span11" name='cmb_month' id='cmb_month'>
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</option>
                                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_month']->value,'output'=>$_smarty_tpl->tpl_vars['month_option_output']->value),$_smarty_tpl);?>

                                        </select>
                                    </div>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
                                    <div class="span3 employee-search-list" style="margin: 0px;">
                                        <label style="float: left;" class="span12" for="employee_search_list"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend span11">
                                            <span class="add-on icon-pencil"></span>
                                            <input name="employee_search_list" id="employee_search_list" value="<?php echo $_smarty_tpl->tpl_vars['sel_emp_label']->value;?>
" class="form-control span9" type="text" maxlength="100"/> 
                                            <input type="hidden" name="employee_selected" id="employee_selected" value="<?php echo $_smarty_tpl->tpl_vars['sel_emp']->value;?>
" />
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="span3 txt-search-word" style="margin:0;">
                                    <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
: </label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="txt_search_word" id="txt_search_word" value="<?php echo $_smarty_tpl->tpl_vars['sel_search_text']->value;?>
" class="form-control span9" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
" type="text" maxlength="100" /> 
                                    </div>
                                </div>
                                <button onclick="reload();" class="btn btn-default pull-left btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
 </button>
                                <input type="hidden" name="h_leave_from" id="h_leave_from" value="" />
                                <input type="hidden" name="h_leave_to" id="h_leave_to" value="" />
                                <form name="frm_mark_read" id="frm_mark_read" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/leave/" style="margin: 0px;">
                                    <button type="submit" class="btn btn-default pull-right btn-margin-set" style="margin-top: 15px; text-align: center;" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_read'];?>
" name="mark_read"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_read'];?>
</button>
                                </form>
                                <div class="span12 no-ml mt no-min-height">
                                    <label>
                                        <input type="checkbox" id="show_untreated_leaves_only" value="1" class="pull-left" <?php if ($_smarty_tpl->tpl_vars['this_show_untreated_leave_only_flag_check_label_val']->value=='Y'){?>checked="checked"<?php }?>>
                                        <span class="ml"><?php echo $_smarty_tpl->tpl_vars['translate']->value['show_untreated_leaves_only'];?>
</span>
                                    </label>
                                </div>

                        </div>
                    </div>
                        
                    <div class="span12 no-min-height no-ml">
                        
                        <div class="pagination pagination-mini pagination-right pagin margin-none span12">
                            <?php if ($_smarty_tpl->tpl_vars['pagination']->value!=''){?><ul id="pagination"><?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
</ul><?php }?>
                        </div>
                    </div>
                   
                    <input type="hidden" id="vikarie_delete_key" value="1" />
                      <div class="span12 no-ml table-responsive">
                    <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-primary t span12" style="margin: 0px 0px 0px; top: 0px;">
                        <thead>
                            <tr>
                                <th class="table-col-center" style="width:1%">#</th>
                                <th style="width:1%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_type'];?>
</th>
                                <th style="width:3%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_from'];?>
</th>
                                <th style="width:4%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_to'];?>
</th>
                                <th style="width:10%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_name'];?>
</th>
                                <th style="width:10%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['processed_name'];?>
</th>
                                <th style="width:5%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['processed_date'];?>
</th>
                                <th style="width:10%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</th>
                                <th style="width:0.1%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</th>
                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?><th style="width:1%">&nbsp;</th><?php }?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['leave_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value){
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['record_no'] = new Smarty_variable($_smarty_tpl->tpl_vars['this_page_no']->value*$_smarty_tpl->tpl_vars['per_page']->value+$_smarty_tpl->tpl_vars['i']->value, null, 0);?>
                                <tr id="status_<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
" class="gradeX <?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
 <?php if ($_smarty_tpl->tpl_vars['entry']->value['status']=='1'){?>col-highlight-primary<?php }?>" <?php if ($_smarty_tpl->tpl_vars['flag']->value==1){?>style="font-weight: bold"<?php }?>>
                                    <td class="table-col-center" style="width:20px;"><?php echo $_smarty_tpl->tpl_vars['record_no']->value;?>
</td>
                                    <td><?php if ($_smarty_tpl->tpl_vars['entry']->value['type']==1){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[1];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==2){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[2];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==3){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[3];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==4){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[4];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==5){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[5];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==6){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[6];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==7){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[7];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['type']==8){?><?php echo $_smarty_tpl->tpl_vars['leave_type']->value[8];?>
<?php }?></td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['entry']->value['From_date'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['entry']->value['To_date'];?>
</td>
                                    <td><a style="text-decoration: underline;" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/employee/<?php echo substr($_smarty_tpl->tpl_vars['entry']->value['From_date'],0,4);?>
/<?php echo substr($_smarty_tpl->tpl_vars['entry']->value['From_date'],5,2);?>
/<?php echo $_smarty_tpl->tpl_vars['entry']->value['employee'];?>
/mc_leave/',1)"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['entry']->value['empname'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['entry']->value['empname_lf'];?>
<?php }?></a></td>
                                    <td <?php if ($_smarty_tpl->tpl_vars['entry']->value['comment']!=''&&$_smarty_tpl->tpl_vars['user_role']->value==1){?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['entry']->value['comment']);?>
" style="cursor: help;"<?php }?>>
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['comment']!=''&&$_smarty_tpl->tpl_vars['user_role']->value==1){?><span style="float: left; padding-right: 5px;"><i class='icon-comment'></i></span><?php }?>
                                        <span class='treated_username'><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['entry']->value['appr_empname'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['entry']->value['appr_empname_lf'];?>
<?php }?></span>
                                    </td>
                                    <td ><?php echo $_smarty_tpl->tpl_vars['entry']->value['appr_date'];?>
 </td>
                                    <td>
                                        <?php  $_smarty_tpl->tpl_vars['cust_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cust_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entry']->value['customer_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cust_data']->key => $_smarty_tpl->tpl_vars['cust_data']->value){
$_smarty_tpl->tpl_vars['cust_data']->_loop = true;
?>
                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['entry']->value['employee']==$_smarty_tpl->tpl_vars['user_id']->value||in_array($_smarty_tpl->tpl_vars['cust_data']->value['customer'],$_smarty_tpl->tpl_vars['tl_accessible_customers']->value)){?>
                                                <a style="text-decoration: underline;" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo substr($_smarty_tpl->tpl_vars['cust_data']->value['slot_date'],0,4);?>
/<?php echo substr($_smarty_tpl->tpl_vars['cust_data']->value['slot_date'],5,2);?>
/<?php echo $_smarty_tpl->tpl_vars['cust_data']->value['customer'];?>
//<?php echo $_smarty_tpl->tpl_vars['entry']->value['employee'];?>
/mc_leave/',1)"><?php echo $_smarty_tpl->tpl_vars['cust_data']->value['name'];?>
</a><br>
                                            <?php }else{ ?>
                                                <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['works_on_another_customer'];?>
</label><br>
                                            <?php }?>

                                        <?php } ?>    
                                    </td>
                                    <td <?php if ($_smarty_tpl->tpl_vars['entry']->value['status']=='0'){?> title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['pending'];?>
" style="background: #000" <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['status']=='1'){?> title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['approved'];?>
" style="background: #00CC00" <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['status']=='2'){?> title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['rejected'];?>
" style="background:#FF0000 "<?php }?>>
                                        
                                    </td>
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>
                                        <td class="table-col-center center valign-top" style="width:50px;">
                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                                <?php if ($_smarty_tpl->tpl_vars['entry']->value['status']=='0'){?>
                                                    <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
)"><img width="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/icon_approve.png"></a>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status_reject(2,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
,'<?php echo $_smarty_tpl->tpl_vars['entry']->value['From_date'];?>
','<?php echo $_smarty_tpl->tpl_vars['entry']->value['To_date'];?>
','<?php echo $_smarty_tpl->tpl_vars['entry']->value['employee'];?>
')"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/cirrus_icon_reject.png"></a>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>
                                                <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['status']=='1'){?>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>
                                                <?php }else{ ?>&nbsp;<?php }?>
                                            <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==2){?>
                                                <?php if ($_smarty_tpl->tpl_vars['entry']->value['status']=='0'&&$_smarty_tpl->tpl_vars['entry']->value['privilege']=='1'){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1){?><a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
)"><img width="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/icon_approve.png"></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status_reject(2,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
,'<?php echo $_smarty_tpl->tpl_vars['entry']->value['From_date'];?>
','<?php echo $_smarty_tpl->tpl_vars['entry']->value['To_date'];?>
','<?php echo $_smarty_tpl->tpl_vars['entry']->value['employee'];?>
')"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/cirrus_icon_reject.png"></a><?php }?>         
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a><?php }?>
                                                <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['status']=='1'&&$_smarty_tpl->tpl_vars['entry']->value['privilege']=='1'){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a><?php }?>
                                                <?php }else{ ?>&nbsp;<?php }?>
                                            <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==7){?>
                                                <?php if ($_smarty_tpl->tpl_vars['entry']->value['status']=='0'&&$_smarty_tpl->tpl_vars['entry']->value['privilege']=='1'){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1){?><a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
)"><img width="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/icon_approve.png"></a><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(2,<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/cirrus_icon_reject.png"></a><?php }?>         
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a><?php }?>
                                                <?php }elseif($_smarty_tpl->tpl_vars['entry']->value['status']=='1'&&$_smarty_tpl->tpl_vars['entry']->value['privilege']=='1'){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>
'}, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a><?php }?>
                                                <?php }else{ ?>&nbsp;<?php }?>
                                            <?php }?>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php }
if (!$_smarty_tpl->tpl_vars['entry']->_loop) {
?>
                                <tr>
                                    <td <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>colspan="10"<?php }else{ ?>colspan="9"<?php }?>><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="span4 main-right hide" style="margin-top: 8px; padding: 10px;">
        <div id="cancel_leave_wraper" class="hide">
            <div id="right_message_wraper" class="span12 no-min-height"></div>
            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['applied_leaves'];?>
</h1>
            <hr>
            <div class="row-fluid">
                <div class="panel-group span12">
                    <div class="span12 header-panel">
                        <h1 class="leave_emp_name" style=" font-size:16px; float:left;"></h1>
                        <button class="btn btn-default btn-normal pull-right" onclick="changeLeaveDate();" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_multiple_leave'];?>
</button>
                   <div class="clearfix"></div>
                    </div>
                </div>
                <div class="panel-body span12" style="padding: 0px 10px 10px !important;">
                    <div class="span12" style=" margin: 0px 0px 0px;">
                        
                        <div class="cancel-leave span12 widget-body-section input-group" style="margin-top: 20px; display: none;">
<div class="span5">
                                    <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_from'];?>
:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input  value="" class="form-control span9 datepicker"  type="text" id="delete_date_from" autocomplete="off"> 
                                    </div>
                                </div>
                                <div class="span5">
                                    <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_to'];?>
:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input  class="form-control span9 datepicker"  type="text" id="delete_date_to" autocomplete="off"> 
                                    </div>
                                </div>
                                 <div class="span2">
                                       <button class="btn btn-danger btn-sm pull-right" style="font-size: 9px !important;margin-top: 19px;padding: 4px 10px;line-height: 12px;" type="button" data-attr="" id="btn_multi_leave" onclick="loadAjaxSlotConfirm({ 'action': 'leave_slot_remove_multiple' })"><?php echo $_smarty_tpl->tpl_vars['translate']->value['apply_multiple_leave'];?>
</button>
                                 </div>
                        </div>

                        <table id="leave_details_tbl" class="table table-white table-bordered table-hover table-responsive table-primary t span12" style="margin:10px 0 0 0;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_type'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_from'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_to'];?>
</th>
                                </tr>
                            </thead>
                            
                        </table>
                        <input type="hidden" id="have_updation" value="0"/>
                        <button type="button" class="btn btn-default pull-right" style="margin-top:10px;" onclick="save_cancel_leave();"><span class="icon icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
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
<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/time_formats.js?v=<?php echo filemtime('js/time_formats.js');?>
" type="text/javascript" ></script>
<script type="text/javascript" >
$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $('#leave_details_tbl').css({ 'max-height': $(window).innerHeight()-150 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
      $('#leave_details_tbl').css({ 'max-height': $(window).innerHeight()-150 });
    });
    
    $(".rm-leave").click(function(e){
        e.stopPropagation();
    });
    
    $('.dynamicRows').click(function() {
        $(this).parent().next('tbody').toggle('slow');
    });

    $(document).on('keyup', "#search-section #cmb_month, #search-section #cmb_year, #search-section #employee_search_list, #search-section #txt_search_word", function(e) {
        
        var code = e.keyCode || e.which;
         if(code == 13) { //Enter keycode
            reload();
         }
    });
});
$(function() {
    var search_employees = [
            <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_emp_array']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                {
                    value: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['eID'];?>
",
                    label: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['eName'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['eID'];?>
)"
                },
            <?php } ?>
    ];
    $( "#employee_search_list" ).autocomplete({
        minLength: 0,
        source: search_employees,
        focus: function( event, ui ) {
                    $( "#employee_search_list" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;
                    $("#employee_selected").val(sel_value);
                    $("#employee_search_list").val(sel_label);
                    return false;
                }
    })
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    };

});

function set_status(status,id){
    wrapLoader(".main-left");
    $('#left_message_wraper').html('');
    bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_approve_leave'];?>
', [
         {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            "class" : "btn-danger",
            "callback": function() {
                uwrapLoader(".main-left");
                bootbox.hideAll();
            }
        },
        {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            "class" : "btn-success",
            "callback": function() {
                $.ajax({
                    async   :false,
                    url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_update_leave_status.php",
                    data    :"id="+id+"&status="+status,
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            if(data.result !== undefined && data.result){
                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>
                                    if(data.status != 1)    //not accept status
                                        $("#table_list #status_"+id).children("td:eq(9)").html('');
                                    else{
                                        var new_column_content = '';
                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                            new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>';
                                        <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>';<?php }?>
                                        <?php }?>
                                        $("#table_list #status_"+id).children("td:eq(9)").html(new_column_content);
                                    }
                                <?php }?>
                                var new_status = (data.status == 1 ? '<?php echo $_smarty_tpl->tpl_vars['translate']->value['approved'];?>
' : '<?php echo $_smarty_tpl->tpl_vars['translate']->value['rejected'];?>
');
                                $("#table_list #status_"+id).children("td:eq(8)").html(new_status);
                                $("#table_list #status_"+id).children("td:eq(6)").html((data.status == 1 ? data.leave_details.appr_date : ''));
                                $("#table_list #status_"+id).children("td:eq(5)").find('.treated_username').html((data.status == 1 ? data.leave_details.appr_empname : ''));
                                
                                if(data.status == 1)    //change row_colour
                                    $("#table_list #status_"+id).addClass('col-highlight-primary');
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#left_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-left");
                });
            }
        }
    ]);
}

function set_status_reject(status,id,date_from,date_to,employee){
   bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_reset_substitute_slots'];?>
', [
         {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
",
            "class" : "btn-primary",
         },
         {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            "class" : "btn-danger",
            "callback": function() {
                var delete_flag = 0;
                set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag);
            }
         },
         {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            "class" : "btn-success",
            "callback": function() {
                var delete_flag = 1;
                set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag);
            }
         }
         
    ]);   
    // var delete_flag;
    // if(confirm('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_reset_substitute_slots'];?>
'))
    //     delete_flag = 1;
    // else
    //     delete_flag = 0;
}

function set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag){
    var month = $("#cmb_month").val();
    var year = $("#cmb_year").val();
    $('#left_message_wraper').html('');
    wrapLoader(".main-left");
    $.ajax({
        async:false,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_update_leave_status.php",
        data:"id="+id+"&status="+status+"&date_from="+date_from+"&date_to="+date_to+"&employee="+employee+"&year="+year+"&month="+month+"&vikarie_delete="+delete_flag,
        type:"POST",
        dataType: 'json',
        success:function(data){
                    if(data.result !== undefined && data.result){
                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>
                        if(data.status != 1)    //not accept status
                            $("#table_list #status_"+id).children("td:eq(9)").html('');
                        else{
                            var new_column_content = '';
                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>';
                            <?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==2||$_smarty_tpl->tpl_vars['user_role']->value==7){?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/leave_cancel.png"></a>';<?php }?>
                            <?php }?>
                            $("#table_list #status_"+id).children("td:eq(9)").html(new_column_content);
                        }
                    <?php }?>
                    var new_status = (data.status == 1 ? '<?php echo $_smarty_tpl->tpl_vars['translate']->value['approved'];?>
' : '<?php echo $_smarty_tpl->tpl_vars['translate']->value['rejected'];?>
');
                    $("#table_list #status_"+id).children("td:eq(8)").html(new_status);
                    $("#table_list #status_"+id).children("td:eq(6)").html((data.status == 1 ? data.leave_details.appr_date : ''));
                    $("#table_list #status_"+id).children("td:eq(5)").find('.treated_username').html((data.status == 1 ? data.leave_details.appr_empname : ''));
                    
                    if(data.status == 1)    //change row_colour
                        $("#table_list #status_"+id).addClass('col-highlight-primary');
                }

                if(data.message !== 'undefined' && data.message != ''){
                    $('#left_message_wraper').html(data.message);
                }
                
                $('#main_container').removeClass('show_main_right');
                $(".main-right, #cancel_leave_wraper").addClass('hide');
        }
    }).always(function(data) { 
        uwrapLoader(".main-left");
    });
}

function loadAjaxSlotConfirm(url_data){
    //console.log(url_data);
    /*if(confirm('<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_cancel_leave'];?>
')){
        if(confirm('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_reset_substitute_slots'];?>
\n\n<?php echo $_smarty_tpl->tpl_vars['translate']->value['note_shortcode'];?>
 <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove'],"'","\'");?>
')){
            url_data.vikarie_delete = '1';
            loadPopup_leave(url_data);
        }else{
            url_data.vikarie_delete = '0';
            loadPopup_leave(url_data);
        }
    }*/
    
    var slot_remove_multiple = true;
    if(url_data.action == 'leave_slot_remove_multiple'){
        var leave_from = strtotime($('#h_leave_from').val());
        var leave_to = strtotime($('#h_leave_to').val());
        var date_from = strtotime($('#delete_date_from').val() + ' 00:00:00');
        var date_to = strtotime($('#delete_date_to').val() + ' 00:00:00');
        if((date_from >= leave_from && date_from <= date_to) && date_to <= leave_to) {
            if($('#delete_date_from').val() == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_enter_date_from'];?>
', function(result){  });
                slot_remove_multiple = false;
            }else if($('#delete_date_from').val() == ''){
                slot_remove_multiple = false;
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_enter_date_to'];?>
', function(result){  });
            }
            else if(Date.parse($('#delete_date_to').val()) < Date.parse($('#delete_date_from').val())){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['to_date_greaterthan_from_date'];?>
', function(result){  });
            }
            url_data = $('#btn_multi_leave').data('attr');
            url_data.date = $('#delete_date_from').val();
            url_data.date_to = $('#delete_date_to').val();
            url_data.tfrom = 0;
            url_data.tto = 24;
        } else {
             bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){  });
        }
    }
    
    var today_date_time = strtotime('<?php echo $_smarty_tpl->tpl_vars['today_date']->value;?>
 00:00:00'+ ' -90 days');
    var slot_start_date_time = strtotime(url_data.date+" 00:00:00");
    var minute_diff = Math.round((today_date_time - slot_start_date_time) / 60);
    var is_past_slot = minute_diff > 0 ? true : false;
    
    if(is_past_slot){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['date_is_passed_cant_cancel_leave'];?>
', function(result){  });
    }
    else if(slot_remove_multiple){
        bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_cancel_leave'];?>
', [{
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            "class" : "btn-danger"
        }, {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            "class" : "btn-success",
            "callback": function() {
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_reset_substitute_slots'];?>
 <br/><br/><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_shortcode'];?>
 <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove'],"'","\'");?>
<br/><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove_2'],"'","\'");?>
<br/><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove_3'],"'","\'");?>
', [{
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
",
                    "class" : "btn-primary"
                }, {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_leave_substitute_reset_no'];?>
",
                    "class" : "btn-danger",
                    "callback": function() {
                        url_data.vikarie_delete = '0';
                        loadPopup_leave(url_data);
                    }
                }, {
                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_leave_substitute_reset_yes'];?>
",
                    "class" : "btn-success",
                    "callback": function() {
                        url_data.vikarie_delete = '1';
                        loadPopup_leave(url_data);
                    }
                }]);
            }
        }]);
    }
}

function loadPopup_leave(url_data, basic_load) {

    //<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mc_leave_popup.php?gid=<?php echo $_smarty_tpl->tpl_vars['entry']->value['gID'];?>

    
    
    if(url_data.gid != ''){
        
        if(basic_load !== 'undefined' && basic_load){
            $('#cancel_leave_wraper #have_updation').val('0');
    
            $('#main_container').addClass('show_main_right');
            $('.main-right').removeClass('hide');
            $("#cancel_leave_wraper").addClass('hide');
        }
        
        wrapLoader('.main-right');

        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mc_leave_popup.php",
            type:"POST",
            dataType: 'json',
            data: url_data,
            success:function(data){
                $("#cancel_leave_wraper").removeClass('hide');
                //console.log(data);
                $('#h_leave_from').val(data.leave_date_from);
                $('#h_leave_to').val(data.leave_date_to);
                $("#cancel_leave_wraper .header-panel .leave_emp_name").html(data.employee_name);
                $("#cancel_leave_wraper #leave_details_tbl tr.dynamicRows, #leave_details_tbl tbody, #leave_details_tbl #sub_grouping").remove();
                
                if(data.leave_details !== 'undefined' && data.leave_details.length > 0){
                    $.each(data.leave_details, function(i, value) {
                        $('#cancel_leave_wraper #leave_details_tbl').append(
                            $('<tbody>')
                                .append(
                                    $('<tr class="gradeX dynamicRows" id="row_status_'+value.gid+'">')
                                        .append('<td class="table-col-center" style="width:15px;"><button onclick=\'loadAjaxSlotConfirm({ "action": "leave_remove", "id":"'+value.id+'", "gid": "'+value.gid+'", "user" : "'+value.emp_id+'", "date" : "'+value.leave_date+'", "tfrom" : "'+value.time_from+'", "tto": "'+value.time_to+'"} );\' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" type="button" class="btn btn-danger btn-small rm-leave"><i class="icon-trash"></i></button></td>')
                                        .append('<td style="cursor: pointer;">'+value.leave_date+'</td>')
                                        .append('<td style="cursor: pointer;">'+(data.leave_type[value.type] !== 'undefined' ? data.leave_type[value.type] : '')+'</td>')
                                        .append('<td style="cursor: pointer;">'+value.time_from+'</td>')
                                        .append('<td style="cursor: pointer;">'+value.time_to+'</td>')
                                )
                        )
                        .append($('<tbody id="sub_grouping" style="display: none;">')
                                .append( make_leave_slots_string(value) )
                            );

                    });
                    data_array = { 'action':'leave_slot_remove_multiple','gid':data.leave_details[0].gid, 'user':data.leave_details[0].emp_id }
                    $('#btn_multi_leave').attr('data-attr' ,JSON.stringify(data_array));             
                    
                }
                
                if(data.message !== 'undefined' && data.message != ''){
                    $('#cancel_leave_wraper #right_message_wraper').html(data.message);
                }
                
                if(data.process_result !== 'undefined' && data.process_result){
                    $('#cancel_leave_wraper #have_updation').val('1');
                }
                
                $('.dynamicRows').click(function() {
                    $(this).parent().next('tbody').toggle('slow');
                });
                
                $(".rm-leave").click(function(e){
                    e.stopPropagation();
                });
                
            }
        }).always(function(data) { 
            uwrapLoader('.main-right');
        });
    }
    return false;
}

function make_leave_slots_string(value){
    var str_slot_rows = '';
    //loadAjaxSlotConfirm(\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mc_leave_popup.php?action=leave_remove&id='+value.id+'&gid='+value.gid+'&user='+value.emp_id+'&date='+value.leave_date+'&tfrom='+value.time_from+'&tto='+value.time_to+'\')
    if(value.day_slots !== 'undefined' && value.day_slots.length > 0){
        $.each(value.day_slots, function(j, day_slot) {
            str_slot_rows += '<tr id="sub_slots"> \n\
                <td class="table-col-center" style="width:15px;"><button onclick=\''+ (day_slot.signed == 1 ? 'already_signed();' : 'loadAjaxSlotConfirm({ "action": "leave_slot_remove", "leave_id": "'+value.id+'", "gid": "'+value.gid+'", "slot_id": "'+day_slot.id+'", "employee": "'+day_slot.employee+'", "date": "'+value.leave_date+'", "tfrom": "'+day_slot.time_from+'", "tto": "'+day_slot.time_to+'"});' ) +'\' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
" type="button" class="btn btn-danger btn-small rm-leave"><i class="icon-remove"></i></button></td>\n\
                <td colspan="4">'+day_slot.time_from+' - '+day_slot.time_to+'</td>\n\
                </tr>';
        });
    }else
        str_slot_rows += '<tr id="sub_slots"><td colspan="5" style="color: red; text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_time_slot_exists'];?>
</td></tr>';
        
    return str_slot_rows;
}

function already_signed(){
    alert("Report Already signed.");
}

function reload(){
    var month = $("#cmb_month").val();
    var year = $("#cmb_year").val();
    
    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
        var sel_emp = $("#employee_selected").val();
        var sel_emp_label = $("#employee_search_list").val();
        
        if($.trim(sel_emp) == '' || $.trim(sel_emp_label) == '')
            sel_emp = 'NULL';
    <?php }else{ ?>
        var sel_emp = 'NULL';
    <?php }?>
        
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));
    
    var show_only_untreated_leave_flag = $("input:checkbox:checked#show_untreated_leaves_only").val();
    if(typeof show_only_untreated_leave_flag == 'undefined' || show_only_untreated_leave_flag != '1')
        show_only_untreated_leave_flag = 'N';
    else
        show_only_untreated_leave_flag = 'Y';
        
    if($.trim(year) == '') year = 'NULL';
    if($.trim(month) == '') month = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/leave/'+month+'/'+year+'/'+sel_emp+'/'+search_text+'/'+show_only_untreated_leave_flag+'/';
}

function save_cancel_leave(){
    var have_updation = $('#cancel_leave_wraper #have_updation').val();
        
    $('#main_container').removeClass('show_main_right');
    $(".main-right, #cancel_leave_wraper").addClass('hide');
            
    if(have_updation == '1'){
        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['current_url']->value;?>
';
    }
}

<?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['approve_all_leave']==1){?>
    function approve_all_leaves(){
        wrapLoader(".main-left");
        $('#left_message_wraper').html('');
        bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_approve_all_leave'];?>
', [
             {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                    uwrapLoader(".main-left");
                    bootbox.hideAll();
                }
            },
            {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        async   :false,
                        url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_update_leave_status.php",
                        data    :"action=APPROVE_ALL&month=<?php echo $_smarty_tpl->tpl_vars['report_month']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['report_year']->value;?>
",
                        dataType:'json',
                        type    :"POST",
                        success:function(data){
                            console.log(data);
                            if(data.result !== undefined && data.result){
                                reload();
                            }
                            else if(data.message !== 'undefined' && data.message != ''){
                                $('#left_message_wraper').html(data.message);
                            }
                        }
                    }).always(function(data) { 
                        uwrapLoader(".main-left");
                    });
                }
            }
        ]);
    }
<?php }?>

  $(".datepicker").datepicker({
                            autoclose: true,
                            weekStart: 1,
                            calendarWeeks: true
                
                        });

  function changeLeaveDate(){
    //$('.cancel-leave').css('display','block');
    $('.cancel-leave').toggle();
    toggle
  }

</script>

    </body>
</html><?php }} ?>