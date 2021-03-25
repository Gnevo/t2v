<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 12:20:53
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/sub_layout_employee_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19640531235fce1e25c83c93-38329290%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90f79cc5c9695d16138f5656fd5148276275d93a' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/sub_layout_employee_tabs.tpl',
      1 => 1588177878,
      2 => 'file',
    ),
    '73ea2037c02ee0c80cf750b08d9f745d8dc0d6e3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/employee_privileges.tpl',
      1 => 1543219300,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19640531235fce1e25c83c93-38329290',
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
  'unifunc' => 'content_5fce1e261401e7_31300319',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fce1e261401e7_31300319')) {function content_5fce1e261401e7_31300319($_smarty_tpl) {?><!DOCTYPE html>
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
css/administration.css" rel="stylesheet" type="text/css" />

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
                <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                        <div class="widget option-panel-widget" style="margin:0 !important;">
                            <div class="widget-body" style="">
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

                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                     <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['privilege'];?>
</h1>
                                    </div>
                                       <div class="span2" style="margin: 10px 0px 0px;">
                                    <div style="margin: 0px !important;" class="input-prepend span11" id="customer_select_div">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="customer_select" onchange="loadPrivileges()">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_customers'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['cust'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cust']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers_to_employee']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cust']->key => $_smarty_tpl->tpl_vars['cust']->value){
$_smarty_tpl->tpl_vars['cust']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['cust']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['customer_selected']->value==$_smarty_tpl->tpl_vars['cust']->value['username']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['cust']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['cust']->value['first_name'];?>
</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                    <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 0px 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="setPrivilege()"><span class="icon-save" style="color:#000;"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left" style="color:#000"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                 </div>
                                </div>
                            </div>
                            </div>
                        <?php }?>
                        <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="5">
                                    <form class="pull-left">
                                        <input type="hidden" id="selected_emp" name="selected_emp"  value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
"/>
                                        <input type="hidden" id="change_comp" name="change_comp"  value="1"/>
                                        <input type="hidden" id="pre_role" name="pre_role"  value="<?php echo $_smarty_tpl->tpl_vars['pre_role']->value;?>
"/>
                                    </form>
                                    <div role="tabpanel" class="tab-pane active" id="5">

                                        <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                <div class="relativeWrap"  style="overflow: visible;">
                                                    <div class="widget widget-tabs widget-tabs-double-2 no-mt">
                                                        <div class="widget-head privilege-tabs">
                                                            <ul>
                                                                <li class="active"><a id="privilage_link" href="javascript:void(0)" onclick="loadPrivileges()" data-toggle="tab"><span class="privilege-tab-timeallocation"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_allocation'];?>
</a> </li>
                                                                <li><a id="report_link" href="javascript:void(0)" onclick="loadReports()" data-toggle="tab"><span class="privilege-tab-reporter"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reports'];?>
</a> </li>
                                                                <li><a id="form_link" href="javascript:void(0)" onclick="loadForms()"><span class="privilege-tab-blankletter"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['forms'];?>
</a> </li>
                                                                <li><a id="general_link" href="javascript:void(0)" onclick="loadGeneral()"><span class="privilege-tab-generaladmin"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['general'];?>
</a> </li>
                                                                <li><a id="mc_link" href="javascript:void(0)" onclick="loadMC()" data-toggle="tab"><span class="privilege-tab-messagecenter"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_centre'];?>
</a> </li>
                                                            </ul>
                                                        </div>
                                                        <div style="float: left; width: 99%;" class="widget-body input-group" >
                                                            <div style="background: none repeat scroll 0% 0% transparent; border: 0px none ! important; float:left;" class="tab-content span12" id="tabDetails">
                                                                
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
    
<script language="javascript">
var made_change = 0;
function madeChange(){
  made_change = 1;
}
$(document).ready(function(){ 

       
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-281});
        else
            $('.tab-content-con').css({ height: $(window).height()});

        $(".side_links li a").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
        var new_var = $("#new").val();
        if(new_var == "1"){
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
        var tabs = '<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
';
        //alert(tabs);
        if(tabs == 1){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#privilage_link").addClass("active");
            loadPrivileges();
             $("#customer_select_div").show();
        }else if(tabs == 2){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#report_link").addClass("active");
            loadReports();
            $("#customer_select_div").hide();
        }else if(tabs == 3){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#form_link").addClass("active");
            loadForms();
            $("#customer_select_div").hide();
        }else if(tabs == 4){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#general_link").addClass("active");
            loadGeneral();
            $("#customer_select_div").hide();
        }else if(tabs == 5){
            $("#privilage_link").removeClass("active");
            $("#report_link").removeClass("active");
            $("#form_link").removeClass("active");
            $("#general_link").removeClass("active");
            $("#mc_link").removeClass("active");
            $("#mc_link").addClass("active");
            loadMC();
            $("#customer_select_div").hide();
        }
    });
    
function giveFullPrivilegeForm(){
    madeChange();
    $('#basic_previllage_form').attr('checked',false);
    if($('#full_previllage_form').attr('checked')){
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',true);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report,#form_form_4,#form_form_5,#form_form_6,#form_form_7').attr('checked',false);
    }
}

function giveBasicPrivilegeFormAl(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',true);
        $('#form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }
}

function giveBasicPrivilegeFormEmp(){
    madeChange()
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage_form').attr('checked')){
        $('#form_fkkn').attr('checked',true);
        $('#form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }else{
        $('#form_fkkn, #form_leave, #form_certificate, #form_form_1, #form_form_2, #form_form_3, #form_form_1_report, #form_form_2_report, #form_form_3_report').attr('checked',false);
    }
}

function giveFullPrivilegeReport(){
    madeChange();
    $('#basic_previllage_report').attr('checked',false);
    if($('#full_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',true);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',true);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',true);
        $('#employee_leave').attr('checked',true);
        $('#employee_percentage').attr('checked',true);
        $('#atl_warning').attr('checked',true);
        $('#customer_overlapping').attr('checked',true);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
        $('#customer_overlapping').attr('checked',false);
    }
}

function giveBasicPrivilegeReportAl(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveBasicPrivilegeReportEmp(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveBasicPrivilegeReportGl(){
    madeChange()
    $('#full_previllage_report').attr('checked',false);
    if($('#basic_previllage_report').attr('checked')){
        $('#customer_schedule').attr('checked',true);
        $('#employee_schedule').attr('checked',true);
        $('#employee_work_report').attr('checked',true);
        $('#customer_data').attr('checked',true);
        $('#customer_leave').attr('checked',true);
        $('#customer_granded_vs_used').attr('checked',true);
        $('#customer_employee_connection').attr('checked',true);
        $('#customer_horizontal').attr('checked',true);
        $('#customer_overview').attr('checked',true);
        $('#customer_vacation_planning').attr('checked',true);
        $('#employee_data').attr('checked',true);
        $('#employee_leave').attr('checked',true);
        $('#employee_percentage').attr('checked',true);
        $('#atl_warning').attr('checked',false);
    }else{
        $('#customer_schedule').attr('checked',false);
        $('#employee_schedule').attr('checked',false);
        $('#employee_work_report').attr('checked',false);
        $('#customer_data').attr('checked',false);
        $('#customer_leave').attr('checked',false);
        $('#customer_granded_vs_used').attr('checked',false);
        $('#customer_employee_connection').attr('checked',false);
        $('#customer_horizontal').attr('checked',false);
        $('#customer_overview').attr('checked',false);
        $('#customer_vacation_planning').attr('checked',false);
        $('#employee_data').attr('checked',false);
        $('#employee_leave').attr('checked',false);
        $('#employee_percentage').attr('checked',false);
        $('#atl_warning').attr('checked',false);
    }
}

function giveFullPrivilegeGeneral(){
    madeChange();
    $('#basic_previllage_general').attr('checked',false);
    if($('#full_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',true);
        $('#general_edit_employee').attr('checked',true);
        $('#general_add_customer').attr('checked',true);
        $('#general_edit_customer').attr('checked',true);
        $('#general_inconvenient_timing').attr('checked',true);
        $('#general_export').attr('checked',true);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',true);
        $('#create_template').attr('checked',true);
        $('#use_template').attr('checked',true);
        $('#general_candg').attr('checked',true);
        $('#general_candg_wo').attr('checked',true);
        $('#mobile_search').attr('checked',true);
        $('input.PrivilegeCheck').attr('checked',true);
        
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',true);
        $('input.PrivilegeCheck').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralAL(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralEmp(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }
}

function giveBasicPrivilegeGeneralGl(){
    madeChange()
    $('#full_previllage_general').attr('checked',false);
    if($('#basic_previllage_general').attr('checked')){
        $('#general_add_employee').attr('checked',true);
        $('#general_edit_employee').attr('checked',true);
        $('#general_add_customer').attr('checked',true);
        $('#general_edit_customer').attr('checked',true);
        $('#general_inconvenient_timing').attr('checked',true);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',true);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }else{
        $('#general_add_employee').attr('checked',false);
        $('#general_edit_employee').attr('checked',false);
        $('#general_add_customer').attr('checked',false);
        $('#general_edit_customer').attr('checked',false);
        $('#general_inconvenient_timing').attr('checked',false);
        $('#general_export').attr('checked',false);
        $('#general_chat').attr('checked',false);
        $('#survey').attr('checked',false);
        $('#create_template').attr('checked',false);
        $('#use_template').attr('checked',false);
        $('#general_candg').attr('checked',false);
        $('#general_candg_wo').attr('checked',false);
        $('#mobile_search').attr('checked',false);
    }
}

function giveFullPrivilegeMC(){
    madeChange()
    $('#basic_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#full_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',true);
        $('#mc_document_archive').attr('checked',true);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveBasicPrivilegeMCAl(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',true);
        $('#mc_document_archive').attr('checked',true);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveBasicPrivilegeMCEmp(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',flase);
    }
} 

function giveBasicPrivilegeMCGl(){
    madeChange()
    $('#full_previllage_mc').attr('checked',false);
   /*mc_leave_notification mc_leave_approval mc_leave_rejection mc_leave_edit cirrus_mail external_mail*/
    if($('#basic_previllage_mc').attr('checked')){
        $('#mc_leave_notification').attr('checked',true);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',true);
        $('#mc_leave_rejection').attr('checked',true);
        $('#mc_leave_edit').attr('checked',true);
        $('#cirrus_mail').attr('checked',true);
        $('#external_mail').attr('checked',true);
        $('#mc_notes').attr('checked',true);
        $('#mc_notes_approval').attr('checked',true);
        $('#mc_notes_rejection').attr('checked',true);
        $('#mc_sms, #mc_sms_general').attr('checked',true);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',true);
    }else{
        $('#mc_leave_notification').attr('checked',false);
        $('#mc_leave_approval, #mc_approve_all_leave').attr('checked',false);
        $('#mc_leave_rejection').attr('checked',false);
        $('#mc_leave_edit').attr('checked',false);
        $('#cirrus_mail').attr('checked',false);
        $('#external_mail').attr('checked',false);
        $('#mc_notes').attr('checked',false);
        $('#mc_notes_approval').attr('checked',false);
        $('#mc_notes_rejection').attr('checked',false);
        $('#mc_sms, #mc_sms_general').attr('checked',false);
        $('#mc_notes_attchment').attr('checked',false);
        $('#mc_document_archive').attr('checked',false);
        $('#mc_support').attr('checked',false);
    }
}

function giveFullPrivilege(){
    madeChange()
    $('#basic_previllage').attr('checked',false);
    if($('#full_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',true);
        $('#add_customer').attr('checked',true);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',true);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#delete_multiple_slots').attr('checked',true);
        $('#contract_override').attr('checked',true);
        $('#atl_override').attr('checked',true);
        $('#change_time').attr('checked',true);
        $('#no_pay_leave').attr('checked',true);
        $('#candg_approve').attr('checked',true);
        $('#show_percentage_month').attr('checked',true);
        $('#not_show_employees').attr('checked',true);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
        $('#not_show_employees').attr('checked',false);
    }
}

function giveBasicPrivilegeAL(){
    madeChange();
    $('#full_previllage').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }
}

function giveBasicPrivilegeEmp(){
    madeChange();
    $('#full_previllage').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }
}

function giveBasicPrivilegeGl(){
    madeChange();
    $('#full_previllage_form').attr('checked',false);
    if($('#basic_previllage').attr('checked')){
        $('#swap').attr('checked',true);
        $('#process').attr('checked',true);
        $('#add_slot').attr('checked',true);
        $('#fkkn').attr('checked',true);
        $('#slot_type').attr('checked',true);
        $('#add_customer').attr('checked',true);
        $('#add_employee').attr('checked',true);
        $('#remove_customer').attr('checked',true);
        $('#remove_employee').attr('checked',true);
        $('#leave').attr('checked',true);
        $('#copy_single_slot').attr('checked',true);
        $('#copy_single_slot_option').attr('checked',true);
        $('#copy_day_slot').attr('checked',true);
        $('#copy_day_slot_option').attr('checked',true);
        $('#split_slot').attr('checked',true);
        $('#delete_slot').attr('checked',true);
        $('#delete_day_slot').attr('checked',true);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }else{
        $('#swap').attr('checked',false);
        $('#process').attr('checked',false);
        $('#add_slot').attr('checked',false);
        $('#fkkn').attr('checked',false);
        $('#slot_type').attr('checked',false);
        $('#add_customer').attr('checked',false);
        $('#add_employee').attr('checked',false);
        $('#remove_customer').attr('checked',false);
        $('#remove_employee').attr('checked',false);
        $('#leave').attr('checked',false);
        $('#copy_single_slot').attr('checked',false);
        $('#copy_single_slot_option').attr('checked',false);
        $('#copy_day_slot').attr('checked',false);
        $('#copy_day_slot_option').attr('checked',false);
        $('#split_slot').attr('checked',false);
        $('#delete_slot').attr('checked',false);
        $('#delete_day_slot').attr('checked',false);
        $('#delete_multiple_slots').attr('checked',false);
        $('#contract_override').attr('checked',false);
        $('#atl_override').attr('checked',false);
        $('#change_time').attr('checked',false);
        $('#no_pay_leave').attr('checked',false);
        $('#candg_approve').attr('checked',false);
        $('#show_percentage_month').attr('checked',false);
    }
}

function loadReports(){
    var tab = "2";
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    $("#privilage_link").parent().removeClass("active");
    $("#report_link").parent().removeClass("active");
    $("#form_link").parent().removeClass("active");
    $("#general_link").parent().removeClass("active");
    $("#mc_link").parent().removeClass("active");
    $("#report_link").parent().addClass("active");
    if(curr_tab == tab){
    
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                
                }
                
        });
        
        
        //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
                            //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role)
                    }
                }
        });
    }else{
    
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                
                }
        });
        // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php?selected="+selected_emp+"&role="+pre_role)
    }
   /* $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_report.php?curr="+curr_tab+"&new_tab="+new_tab);*/
}
function loadForms(){
    var tab = "3";
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    
    $("#privilage_link").parent().removeClass("active");
    $("#report_link").parent().removeClass("active");
    $("#form_link").parent().removeClass("active");
    $("#general_link").parent().removeClass("active");
    $("#mc_link").parent().removeClass("active");
    $("#form_link").parent().addClass("active");
    
    if(curr_tab == tab){
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
        // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
                             //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
                    }
                }
        });
    }else{
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
       // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php?selected="+selected_emp+"&role="+pre_role);
    }
    /*var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_forms.php?curr="+curr_tab+"&new_tab="+new_tab);*/
}
function loadGeneral(){
    var tab = "4";
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    
    $("#privilage_link").parent().removeClass("active");
    $("#report_link").parent().removeClass("active");
    $("#form_link").parent().removeClass("active");
    $("#general_link").parent().removeClass("active");
    $("#mc_link").parent().removeClass("active");
    $("#general_link").parent().addClass("active");   
    
    if(curr_tab == tab){
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
         //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
                           // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
                    }
                }
        });
    }else{
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
        //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php?selected="+selected_emp+"&role="+pre_role);
    }
    }
   /* var curr_tab = $("#curr_tab").val();
    $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_general.php?curr="+curr_tab+"&new_tab="+new_tab);*/

function madeChange(){
  made_change = 1;
  $("#new").val("1");
}
function loadMC(){
    var tab = "5";
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    
    $("#privilage_link").parent().removeClass("active");
    $("#report_link").parent().removeClass("active");
    $("#form_link").parent().removeClass("active");
    $("#general_link").parent().removeClass("active");
    $("#mc_link").parent().removeClass("active");
    $("#mc_link").parent().addClass("active");
    
    if(curr_tab == tab){
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
        // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                            $( this ).dialog( "close" );
                            $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
                           // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
                    }
                }
        });
    }
    else{
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php",
        data:"selected="+selected_emp+"&role="+pre_role,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").hide();
                }
        });
        //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privilege_mc.php?selected="+selected_emp+"&role="+pre_role);
    }
}
function loadPrivileges(){

    var tab = "1";
    var customer_username = $("#customer_select").val();
    var curr_tab = $("#curr_tab").val();
    var pre_role = $("#pre_role").val();
    var selected_emp = $("#selected_emp").val();
    $("#privilage_link").parent().removeClass("active");
    $("#report_link").parent().removeClass("active");
    $("#form_link").parent().removeClass("active");
    $("#general_link").parent().removeClass("active");
    $("#mc_link").parent().removeClass("active");
    $("#privilage_link").parent().addClass("active");
    if(curr_tab == tab){
    $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
    $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
                }
        });
         //$("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
    }else if(made_change == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                        $( this ).dialog( "close" );
                        $("#employees").val(selected_emp);
                        $("#new_tab").val(tab);
                        var role = $("#pre_role").val();
                        $("#roles").val(role);
                        var cust = $("#customer_select").val();
                        $("#cust").val(cust);
                        $("#form").submit();
                        
                    },
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
                            $.ajax({
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
                }
        });
                           // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php?selected="+selected_emp+"tab=<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
"+"&role="+pre_role);
                    }
                }
        });
    }else{
    $("#tabDetails").html('<div class="popup_first_loading" style="height: 100px;"></div>');
    $.ajax({
        
        async:true,
        cache: true,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php",
        data:"selected="+selected_emp+"&role="+pre_role+"&cust_username="+customer_username,
        type:"POST",
        success:function(data){
                $("#tabDetails").html(data);
                $("#customer_select_div").show();
                }
        });
        // $("#tabDetails").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_privileges.php?selected="+selected_emp+"&role="+pre_role);
    }
}

function saveForm(){
    //$("#action").val("save");
    var tab = $("#curr_tab").val();
    var selected_emp = $("#selected_emp").val();
    $("#employees").val(selected_emp);
    $("#new_tab").val(tab);
    var role = $("#pre_role").val();
    $("#roles").val(role);
    $("#form").submit();
     
}

function setPrivilege(){
    var curr_tab = $("#curr_tab").val();
    var selected_emp = $("#selected_emp").val();
    var cust = $("#customer_select").val();
    $("#cust").val(cust);
    $("#employees").val(selected_emp);
    $("#new_tab").val(curr_tab);
    $("#form").submit();
    
}

function backForm() {
    //document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/employee/<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/';
    window.history.back();
}

function redirectConfirm(mode){
        var change = $("#change").val();
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
   var made_change = $("#change").val();
    if(made_change == 1){
            var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
   var made_change = $("#change").val();
    if(made_change == 1){
    var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
    var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
        var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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
    var made_change = $("#change").val();
    if(made_change == 1){
            var tab = $("#curr_tab").val();
            var selected_emp = $("#selected_emp").val();
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
": function() {
                            $( this ).dialog( "close" );
                            $("#employees").val(selected_emp);
                            $("#new_tab").val(tab);
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

function loadSalary(){
    var change = $("#change").val();
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
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/list/salary/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
}

function loadSkills(){
    var change = $("#change").val();
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
employee/skills/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/skills/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
}

function loadDocumentation(){
    var change = $("#change").val();
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
employee/documentations/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
                        }
                    }
            });
        }
        else{
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/documentations/<?php if (isset($_smarty_tpl->tpl_vars['employee_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php }?>";
        }
}*/



</script>

    </body>
</html><?php }} ?>