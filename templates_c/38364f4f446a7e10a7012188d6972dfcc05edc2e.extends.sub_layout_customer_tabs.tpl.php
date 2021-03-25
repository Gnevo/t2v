<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 07:07:22
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8085789915fcdd4aac827c4-63922616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38364f4f446a7e10a7012188d6972dfcc05edc2e' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/sub_layout_customer_tabs.tpl',
      1 => 1536921822,
      2 => 'file',
    ),
    '85714872e0f1900b16da11227868c9baed6d3b03' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/customer_add.tpl',
      1 => 1548915504,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8085789915fcdd4aac827c4-63922616',
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
  'unifunc' => 'content_5fcdd4ab3b78e0_72855057',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcdd4ab3b78e0_72855057')) {function content_5fcdd4ab3b78e0_72855057($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
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
        
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <style>
        .underline_link { text-decoration: underline;}
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
" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['want_save_changes'];?>
</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
 
        <div class="row-fluid">
            <div style="margin: 0px; overflow: hidden !important; padding: 0 !important;" class="span12 main-left" sty>
                <div  class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_information'];?>
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

                            <div class="tab-content-switch-con <?php if ($_smarty_tpl->tpl_vars['customer_username']->value==''){?>no-mt<?php }?>" >
                                <?php if ($_smarty_tpl->tpl_vars['customer_username']->value!=''){?>
                                    
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

                                <?php }?>

                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                        <button id = "btn_save" class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()" <?php if ($_smarty_tpl->tpl_vars['customer_username']->value!=''){?>disabled="disabled"<?php }?>><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                        <?php if ($_smarty_tpl->tpl_vars['customer_username']->value!=''){?><button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button"><span class="icon-pencil"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_edit_customer_personal'];?>
</button><?php }?>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                        <?php if ($_smarty_tpl->tpl_vars['customer_username']->value!=''){?>
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data();"><span class="icon-print"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                                            <?php if ($_smarty_tpl->tpl_vars['privilege_general']->value['add_customer']){?><button class="btn btn-default btn-normal pull-right" type="button" onclick="document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/add/'"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_customer'];?>
</button><?php }?>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content-con">

                                <div class="tab-content span12 no-padding" style="margin:0;">
                                    <!--///////////////////////////////////TAB1 BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                                    <div role="tabpanel" class="tab-pane active" id="1">
                                        <form name="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/add/<?php if ($_smarty_tpl->tpl_vars['customer_username']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
/<?php }?>" class="pull-left span12">
                                            <input type="hidden" name="hdn_url" id="hdn_url" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" />
                                            <input type="hidden" name="username" id="username_1" value="<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
" />
                                            <input type="hidden" name="tl" id="tl" value="<?php echo $_smarty_tpl->tpl_vars['team_leader']->value;?>
" />
                                            <input type="hidden" name="stl" id="stl" value="<?php echo $_smarty_tpl->tpl_vars['super_team_leader']->value;?>
" />
                                            <input type="hidden" name="tmp_allocate" id="tmp_allocate" value="<?php echo $_smarty_tpl->tpl_vars['team_members']->value;?>
" />
                                            <input type="hidden" name="new_team_member" id="new_team_member" value="" />
                                            <input type="hidden" name="remove_member" id="remove_member" value="" />
                                            <input type="hidden" name="to_allocate" id="to_allocate" value="" />
                                            <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                            <input type="hidden" name="new" id="new" value="<?php if (isset($_smarty_tpl->tpl_vars['new']->value)){?><?php echo $_smarty_tpl->tpl_vars['new']->value;?>
<?php }?>" />
                                            <!--OPTION PANEL BEGIN-->

                                            <div style="" class="span12 widget-body-section input-group">
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <div style="margin: 0px;" class="widget">
                                                            <div class="widget-header span12">
                                                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_information'];?>
</h1>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                            <label style="float: left;" class="span12" for="century"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
*</label>
                                                                            <div class="input-prepend span12" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select name="century" id="century"  class="form-control span2 date-list">
                                                                                    <option value="19" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['century']==19){?> selected="selected" <?php }?> >19</option>
                                                                                    <option value="20" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['century']==20){?> selected="selected" <?php }?> >20</option>
                                                                                </select>
                                                                                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['social_security'];?>
" id="social_security" name="social_security" maxlength="11" onchange="markChange()" class="form-control span7 date-list">
                                                                                <input type="hidden"  value="<?php if ($_smarty_tpl->tpl_vars['social_security_check']->value){?>1<?php }?>" id="social_flag" name="social_flag">
                                                                            </div>
                                                                            <div id="soc_sec" style="color: red"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="padding: 0px; margin: 0px;" class="span6 form-left">
                                                                    <div style="margin: 0px;" class="span12">
                                                                        <label style="float: left;" class="span12" for="first_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['first_name'];?>
" id="first_name" name="first_name" onchange="markChange()" > 
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin: 5px 0px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="last_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['last_name'];?>
" id="last_name" name="last_name" onchange="markChange()"> </div>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">    

                                                                        <label style="width:100%; float:left;" for="gender"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
</label> 

                                                                        <ol class="radio-group">
                                                                            <li>  <input type="radio" name="gender" id="gender_male" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['gender']==1){?>checked="checked"<?php }?> value="1" onclick="makeChange()" ><label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
</label></li>
                                                                            <li>  <input type="radio" name="gender" id="gender_female" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['gender']==2){?>checked="checked"<?php }?> value="2" onclick="makeChange()" ><label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
</label></li>
                                                                        </ol>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">    
                                                                        <label style="float: left;" class="span12" for="code"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_code'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_code'];?>
" type="text"<?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['code']){?> value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['code'];?>
"<?php }else{ ?> value="<?php echo $_smarty_tpl->tpl_vars['cust_code']->value;?>
"<?php }?> id="code" name="code" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>

                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['address'];?>
" id="adress" name="adress" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>

                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="post"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['post'];?>
" id="post" name="post" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="" class="span6 form-right">
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['city'];?>
" id="city" name="city" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>    
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['phone'];?>
" id="phone" name="phone" onchange="markChange()"> </div>
                                                                    </div>    

                                                                    <div style="margin: 0px;" class="span12">
                                                                        <label style="float: left;" class="span12" for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
" type="text"  value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['mobile'];?>
" id="mobile" name="mobile" maxlength="17" onchange="markChange()"> </div>
                                                                        <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                                                    </div>


                                                                    <div style="margin: 5px 0 0 0 !important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['email'];?>
" id="email" name="email" onchange="markChange()"> </div>
                                                                    </div>                          




                                                                    <?php if ($_smarty_tpl->tpl_vars['company_id']->value!=5){?>

                                                                    <div style="margin: 10px 0px 5px;" class="span12">

                                                                        <label style="margin-bottom:10px 0px 5px 0 !important; float:left; width:100%;" for="fkkn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk_kn'];?>
</label>
                                                                        <ol class="radio-group">
                                                                            <li><input type="radio" name="fkkn" id="fk" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['fkkn']=='1'){?>checked="checked"<?php }else{ ?> checked="checked" <?php }?> value="1" onclick="makeChange()"><label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
      </label>   </li>
                                                                            <li>
                                                                                <input type="radio" name="fkkn"  id="kn" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['fkkn']=='2'){?>checked="checked"<?php }?> value="2" onclick="makeChange()"><label class="dv_cntnt label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</span></label>
                                                                            </li>
                                                                        </ol>
                                                                    </div> 

                                                                    <?php }?>        





                                                                    <div style="margin:  5px 0 0 0 !important;" class="span12">
                                                                        <label for="date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</label>
                                                                        <div class="input-prepend date hasDatepicker datepicker span12 no-ml no-padding">
                                                                            <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span10" type="text" value="<?php echo $_smarty_tpl->tpl_vars['dates']->value;?>
" id="date" name="date" onchange="markChange()">
                                                                        </div>
                                                                    </div>   
                                                                    


                                                                    <input  type="hidden" value="" id="date_inactive" name="date_inactive" onchange="markChange()">
                                                                </div>

                                                            </div>

                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['account_information'];?>
</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="username"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
" class="form-control span11"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
" id="username" name="username" readonly="readonly"> </div>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                                                        <div id="pass"> <input type="button" onclick="generate_password()" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
" id="password" name="password" class="bttn" ></div>
                                                                    </div>

                                                                    <div class="span12">
                                                                        <label  label for="status"><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</label>

                                                                        <ol class="radio-group" >
                                                                            <li>
                                                                                <input type="radio" name="status" id="status" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='1'){?>checked="checked"<?php }else{ ?> checked="checked" <?php }?> value="1" onclick="giveActivation()">
                                                                                <label class="label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
   </label> 
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="status" id="status" <?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='0'){?>checked="checked" <?php }?> value="0" onclick="giveInactive()">
                                                                                <label class="dv_cntnt label-option-and-checkbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inactive'];?>
</label>
                                                                            </li>
                                                                        </ol>
                                                                    </div>





                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                            <!--WIDGET BODY END-->

                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['administrator_behalf'];?>
</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="row-fluid">
                                                                       <div class="span6">
                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_name'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10"  type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_name'];?>
"  onchange="markchange()" /> 
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="bbox"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_box'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12" > <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10" type="text" name="bbox" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_box'];?>
" id="bbox"  onchange="markchange()" /> 
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="kn_postno"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_postno'];?>
</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10" type="text" name="kn_postno"  value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_postno'];?>
" id="kn_postno" onchange="markchange()" maxlength="5" /> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                            <div class="span6">
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="breference_no"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_reference_no'];?>
</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="breference_no" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_reference_no'];?>
" id="breference_no" onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="address_kn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_address'];?>
</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="address_kn" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_address'];?>
" id="address_kn"  onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="bocity"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn_form_city'];?>
</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="bocity" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['kn_city'];?>
" id="bocity" onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>



                                                    </div>

                                                    <div class="span8" style="">
                                            <div class="row-fluid">
                                                         <div class="span6">
                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['relatives'];?>
</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN-->
                                                                <div class="span12" style="margin:0;">
                                                                    <div id="relatives_list">
                                                                        <ul class="span12 list-group list-group-form input-group" style="float: left;">
                                                                            <?php  $_smarty_tpl->tpl_vars['relative'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relative']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_relatives']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relative']->key => $_smarty_tpl->tpl_vars['relative']->value){
$_smarty_tpl->tpl_vars['relative']->_loop = true;
?>    
                                                                                <li class="list-group-item span12 no-ml">
                                                                                    <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['relative']->value['name'];?>
</a></div>
                                                                                    <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['relative']->value['relation'];?>
</a></div>
                                                                                    <div class="span1 pull-right"><button style="text-align: center;" class="btn btn-default btn-normal span12 pull-right include_edit" type="button" onclick="deleteRelative('<?php echo $_smarty_tpl->tpl_vars['relative']->value['id'];?>
')">x</button></div>
                                                                                </li>
                                                                            <?php }
if (!$_smarty_tpl->tpl_vars['relative']->_loop) {
?>    
                                                                                <li class="list-group-item">
                                                                                    <div class="span5"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_relatives'];?>
</div>
                                                                                    <div class="span5"></div>
                                                                                    <div class="span1 pull-right"></div>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                    <?php if (!empty($_smarty_tpl->tpl_vars['customer_detail']->value)){?>
                                                                        <div class="span12" style="margin-left:0;">
                                                                            <div style="margin-top: 0px; border: 0px none ! important; margin-bottom: 0px ! important;" class="widget">
                                                                                <div style="border-radius: 0px ! important; margin: 0px ! important;" class="widget-header span12">
                                                                                    <div class="span3">  <h1 class="pull-left"><?php echo $_smarty_tpl->tpl_vars['translate']->value['relatives'];?>
</h1></div>
                                                                                    <div style="padding: 5px;" class="span9 pull-right">
                                                                                        <button class="btn btn-default btn-normal pull-right ml" id="add" name="add" onclick="addRelative()" type="button"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_relative'];?>
</button>
                                                                                        <button class="btn btn-default btn-normal pull-right" id="save" name="save" onclick="saveRelative()" type="button"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                                                                    </div>
                                                                                </div>
                                                                                <!--WIDGET BODY BEGIN-->
                                                                                <div class="span12 widget-body-section input-group" id="relatives_add">
                                                                                    <div class="span6 form-left">
                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
" type="text" name="relative_name" id="relative_name" value="" onchange="markChange()" />
                                                                                                <input name="relative_id" id="relative_id" type="hidden" value="" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_relation"><?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['relation'];?>
" type="text" name="relative_relation" id="relative_relation" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                        <div style="margin: 5px 0px 0px;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
" type="text" name="relative_address" id="relative_address" value="" onchange="markChange()"/></div>
                                                                                        </div>

                                                                                        
                                                                                        <div style="margin: 5px 0px;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
" type="text" name="relative_city" id="relative_city" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="span6 form-right">

                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
" type="text" name="relative_phone" id="relative_phone" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_work_phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['phone_work'];?>
" type="text" name="relative_work_phone" id="relative_work_phone" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
" type="text" name="relative_mobile" id="relative_mobile" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" type="email" name="relative_email" id="relative_email" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="span12" style="margin:0">
                                                                                        <label class="span12" style="margin-top:0;" for="relative_other"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</label>
                                                                                        <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()"></textarea>
                                                                                    </div>
                                                                                </div><!--WIDGET BODY END-->
                                                                            </div>
                                                                        </div>
                                                                    <?php }?>                
                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                            <div class="row-fluid"></div>
                                                        </div>

                                                        <div class="span6">



                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['additional_information'];?>
</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                                                                    <div class="span12">

                                                                        <label class="span12" style="margin-top:0;" for="health_care"><?php echo $_smarty_tpl->tpl_vars['translate']->value['health_care'];?>
</label>
                                                                        <textarea rows="2" class="form-control span12" name="health_care" id="health_care" onchange="markChange()"><?php if (isset($_smarty_tpl->tpl_vars['customer_health']->value['health_care'])){?><?php echo $_smarty_tpl->tpl_vars['customer_health']->value['health_care'];?>
<?php }?></textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="occupational_therapists"><?php echo $_smarty_tpl->tpl_vars['translate']->value['occupational_therapists'];?>
</label>
                                                                        <textarea rows="2" class="form-control span12" name="occupational_therapists" id="occupational_therapists" onchange="markChange()"><?php if (isset($_smarty_tpl->tpl_vars['customer_health']->value['occupational_therapists'])){?><?php echo $_smarty_tpl->tpl_vars['customer_health']->value['occupational_therapists'];?>
<?php }?></textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="physiotherapists"><?php echo $_smarty_tpl->tpl_vars['translate']->value['physiotherapists'];?>
</label>
                                                                        <textarea rows="2" class="form-control span12" name="physiotherapists" id="physiotherapists" onchange="markChange()"><?php if (isset($_smarty_tpl->tpl_vars['customer_health']->value['physiotherapists'])){?><?php echo $_smarty_tpl->tpl_vars['customer_health']->value['physiotherapists'];?>
<?php }?></textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="aiother"><?php echo $_smarty_tpl->tpl_vars['translate']->value['other'];?>
</label>
                                                                        <textarea rows="2" class="form-control span12" name="aiother" id="aiother" onchange="markChange()"><?php if (isset($_smarty_tpl->tpl_vars['customer_health']->value['other'])){?><?php echo $_smarty_tpl->tpl_vars['customer_health']->value['other'];?>
<?php }?></textarea>

                                                                    </div>
                                                                </div><!--WIDGET BODY END-->
                                                            </div>

                                                            <div class="row-fluid">




                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="span12">
                                                                <div style="margin: 11px 0px ! important;" class="widget">
                                                                    <div class="widget-header span12">
                                                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['relax_assistant_to_customer'];?>
</h1>
                                                                    </div>


                                                                    <div class="span12 widget-body-section input-group">
                                                                        <div class="span6">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1 class="span4"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_assistants'];?>
</h1>



                                                                                    <input class="form-control span7 excluded_edit" type="text" name="searchkey_text" id="searchkey_text" onkeyup="loadNotAllocatedWorkers()" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_employee'];?>
" style="min-height: 15px; height: 20px;margin: 5px;" >




                                                                                    <input style="float: right;margin-right: 10px; width: 150px; margin-bottom: 0px;"  type="hidden" name="searchkey" id="searchkey"/>

                                                                                </div>
                                                                                <div class="div-height-fix" id="nwoekers_list" style="height: 253px;">

                                                                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['to_allocate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                                                        <div id="a<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" class="span12 child-slots-profile">
                                                                                            <span class="glyphicons icon-plus pull-right remove-child-slots cursor_hand" onclick="assignEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['assign_employee'];?>
"></span>
                                                                                            <span class="cursor_hand underline_link" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/employee/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/CUST_ADD/<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['employee']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['first_name']);?>
<?php }?></span>
                                                                                            <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
                                                                                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==2){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['team_leader'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['substitute']==1){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>
                                                                                            <?php }?>

                                                                                        </div><!--CHILD SLOT END-->
                                                                                    <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
                                                                                        <div id="no_data" class="message" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                                                    <?php } ?>



                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php if ($_smarty_tpl->tpl_vars['loggedin_user']->value==1){?>
                                                                            <div class="span6">
                                                                                <div class="widget-body table-1">
                                                                                    <div class="table-head-min"> <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['attached_assistants'];?>
</h1></div>
                                                                                    <div class="div-height-fix" id="tosave_workers" style="height: 253px;">
                                                                                        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_team']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                                                            <div id="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
"  class="span12 child-slots-profile-two">
                                                                                                <span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"  title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_employee'];?>
" onclick="removeEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"></span>
                                                                                                <span>
                                                                                                    <span class="cursor_hand underline_link" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/employee/<?php echo smarty_modifier_date_format(time(),"%Y/%m");?>
/<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
/CUST_ADD/<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
/',1);"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['name_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['name'];?>
<?php }?></span>
                                                                                                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span>
                                                                                                </span>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                                                                                                    <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</span>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                                                                                                    <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
</span>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                                                                                                    <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</span>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==1){?>
                                                                                                    <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
                                                                                                <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['substitute']==1){?>
                                                                                                    <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>
                                                                                                <?php }?>

                                                                                                <?php if ($_smarty_tpl->tpl_vars['employee']->value['tl']==1){?><span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['team_leader'];?>
</span><?php }?>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==2&&$_smarty_tpl->tpl_vars['employee']->value['tl']==0){?>
                                                                                                    <a href="javascript:void(0);" class="maketl" onclick="makeTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_team_leader'];?>
</a>
                                                                                                <?php }?>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==0){?>
                                                                                                    <a href="javascript:void(0);" class="maketl" onclick="makeSTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_super_team_leader'];?>
</a>
                                                                                                <?php }?>
                                                                                            </div>
                                                                                        <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
                                                                                            <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
                                                                                        <?php } ?>




                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php }else{ ?>
                                                                        <div class="span6">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min"> <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['attached_assistants'];?>
</h1></div>
                                                                                <div class="div-height-fix" id="tosave_workers" style="height: 253px;">
                                                                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_team']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                                                        <div id="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
"  class="span12 child-slots-profile-two">
                                                                                            <input class="check-box" type="checkbox">
                                                                                            <span class="glyphicons icon-minus pull-right remove-child-slots" onclick="removeEmployee('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_employee'];?>
"></span>
                                                                                            <span><?php echo $_smarty_tpl->tpl_vars['employee']->value['name'];?>
<span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</span></span> 
                                                                                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==1){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==5){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==6){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['economy'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==1){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>
</span>
                                                                                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['substitute']==1){?>
                                                                                                <span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>
                                                                                            <?php }?>

                                                                                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['tl']==1){?><span class="slots-position pull-right"><?php echo $_smarty_tpl->tpl_vars['translate']->value['team_leader'];?>
</span><?php }?>
                                                                                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==2&&$_smarty_tpl->tpl_vars['employee']->value['tl']==0){?>
                                                                                                <a href="javascript:void(0);" class="maketl" onclick="makeTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_team_leader'];?>
</a>
                                                                                            <?php }?>
                                                                                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['user_role']==7&&$_smarty_tpl->tpl_vars['employee']->value['stl']==0){?>
                                                                                                <a href="javascript:void(0);" class="maketl" onclick="makeSTl('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value['make_super_team_leader'];?>
</a>
                                                                                            <?php }?>

                                                                                        </div>
                                                                                    <?php }
if (!$_smarty_tpl->tpl_vars['employee']->_loop) {
?>
                                                                                        <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }?>                
                                                                </div>

                                                            </div>
                                                        </div>

                                                        

                                                    </div>
                                                </div>
                                            </div>




                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div style="margin: 0px ! important;" class="widget">
                                                        <div class="widget-header span12">
                                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['the_customers_order'];?>
</h1>
                                                        </div>
                                                        <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">
                                                            <div class="table-responsive div-height-fix">  
                                                                <table class="footable table table-striped table-bordered table-white table-primary">
                                                                    <thead>
                                                                        <tr>
                                                                            <th data-class="expand"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_from'];?>
</th>
                                                                            <th data-hide="phone,tablet"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_to'];?>
</th>
                                                                            <th data-hide="phone,tablet"><?php echo $_smarty_tpl->tpl_vars['translate']->value['granded_hours'];?>
</th>
                                                                            <th data-hide="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk_kn'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['remaining_from_grant_hours'];?>
</th>
                                                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['exercised_call_hour'];?>
</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php  $_smarty_tpl->tpl_vars['contract'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contract']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contracts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contract']->key => $_smarty_tpl->tpl_vars['contract']->value){
$_smarty_tpl->tpl_vars['contract']->_loop = true;
?>
                                                                            <tr>
                                                                                <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['date_from'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['contract']->value['date_to'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['contract']->value['hour'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['contract']->value['fkkn'];?>
</td><td <?php if ($_smarty_tpl->tpl_vars['contract']->value['remaining_hour']<0){?>style="color:red;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['contract']->value['remaining_hour'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['contract']->value['oncall'];?>
</td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><!--WIDGET BODY END-->


                                                    </div>
                                                    <div class="row-fluid">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="row-fluid"> 
                                    <div class="span4">
                                        <div class="widget">
                                            <div class="widget-header span12">

                                                    <label class="label-option-and-checkbox ml">
                                                        <h1><input name="rb_guardian_type" value="3" onchange="markChange()" type="radio" class="ml" <?php if ($_smarty_tpl->tpl_vars['customer_guardian']->value['type']==3){?>checked="checked"<?php }?>>&nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian3'];?>
</h1>
                                                    </label>
                                                    <label class="label-option-and-checkbox mr">
                                                        <h1><input name="rb_guardian_type" value="1" onchange="markChange()" type="radio" class="ml" <?php if ($_smarty_tpl->tpl_vars['customer_guardian']->value['type']==1||$_smarty_tpl->tpl_vars['customer_guardian']->value['type']==''){?>checked="checked"<?php }?>>&nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian'];?>
</h1>
                                                    </label>
                                                    <label class="label-option-and-checkbox mr ml">
                                                        <h1><input name="rb_guardian_type" value="2" onchange="markChange()" type="radio" class="ml" <?php if ($_smarty_tpl->tpl_vars['customer_guardian']->value['type']==2){?>checked="checked"<?php }?>>&nbsp;<?php echo $_smarty_tpl->tpl_vars['translate']->value['guardian2'];?>
</h1>
                                                    </label>
                                                    
                                            </div>
                                            <div class="span12 widget-body-section input-group">
                                                <div class="span6 form-left">
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_fname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
" type="text" name="guardian_fname" id="guardian_fname" value="<?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['first_name'];?>
" onchange="markChange()"/> </div>
                                                    </div>
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_lname"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
" type="text" name="guardian_lname" id="guardian_lname" value="<?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['last_name'];?>
" onchange="markChange()"/> </div>
                                                    </div>
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_ssn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
" type="text" name="guardian_ssn" id="guardian_ssn" value="<?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['ssn'];?>
" onchange="markChange()" maxlength="12"/> </div>
                                                    </div>
                                                </div>
                                                <div class="span6 form-right">

                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
" type="text" name="guardian_mobile" id="guardian_mobile" value="<?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['mobile'];?>
" onchange="markChange()"/> </div>
                                                    </div>


                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input type="email" class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" name="guardian_email" id="guardian_email" value="<?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['email'];?>
" onchange="markChange()"> 

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span12" style="margin:0">

                                                    <label class="span12" style="margin-top:0;" for="guardian_address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                                    <textarea name="guardian_address" id="guardian_address" onchange="markChange()" class="form-control span12"><?php echo $_smarty_tpl->tpl_vars['customer_guardian']->value['address'];?>
</textarea>
                                                </div>
                                            </div>
                                            <div class="span12 no-min-height" style="margin:0;">
                                                <div class="span12 no-min-height" style="margin-left:0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span8">
                                        <div style="border: 0px none ! important; margin-bottom: 0px ! important;" class="widget">
                                            <div style="border-radius: 0px ! important; padding:3px;" class="widget-header span12">
                                                <div class="span12"> <h1></h1> </div>
                                            </div>

                                            <div class="span12 widget-body-section input-group">
                                                <input type="hidden" name="tdocs" id="tdocs" value="<?php echo $_smarty_tpl->tpl_vars['customer_document_string']->value;?>
" />
                                                <input type="hidden" name="del_doc" id="del_doc" value="" />
                                                <div class="span12" style="margin:0">
                                                    <ul class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                        <?php if ($_smarty_tpl->tpl_vars['customer_document_string']->value!=''){?>
                                                            <?php  $_smarty_tpl->tpl_vars['customer_document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_documents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_document']->key => $_smarty_tpl->tpl_vars['customer_document']->value){
$_smarty_tpl->tpl_vars['customer_document']->_loop = true;
?>
                                                                <li class="list-group-item" onchange="markChange()">
                                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['icon'];?>
" width="14" height="17" />
                                                                    <a id="lic_1" href="javascript:void(0)" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
')" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 70% ! important; display: inline-block; vertical-align: text-top;" title="<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
"><?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
</a>
                                                                    <a href="javascript:void(0);" style="float: right;"  onclick="docRemove('<?php echo $_smarty_tpl->tpl_vars['customer_document']->value['file'];?>
', this)"  class="btn btn-danger btn-lg"><span class="icon-trash"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_file'];?>
</span></a>
                                                                    <div class="clearfix"></div>
                                                                </li>
                                                            <?php }
if (!$_smarty_tpl->tpl_vars['customer_document']->_loop) {
?>
                                                                <li class="list-group-item"><?php echo $_smarty_tpl->tpl_vars['translate']->value['there_are_no_files'];?>
</li>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                            <li class="list-group-item"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['there_are_no_files'];?>
</span></li>
                                                                <?php }?>
                                                    </ul>
                                                    <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file">
                                                        <input type="hidden" name="file_count" id="file_count" value="1" />
                                                        <div id="file_attach">
                                                            <input class="margin-none" type="file" name="file_1" id="file_1" size="12" onchange="markChange()"/>
                                                        </div>
                                                    </span>


                                                    <div style="margin-top: 3px">
                                                        <label><a id="attach_file" href="javascript:void(0);" class="btn btn-default" onclick="attachAnother()" style="margin-top:15px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['upload_new_file'];?>
</a></label>
                                                        <label><a id="remove_file" href='javascript:void(0);' class="btn btn-default" style="margin-top:15px" onclick='removeFile()' ><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_file'];?>
</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--WIDGET BODY BEGIN--><!--WIDGET BODY END-->
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row-fluid hide"> 
                                    <div class="span12">
                                        <div style="border: 0px none !important;" class="widget no-margin">
                                            <div style="border-radius: 0px !important; padding:3px;" class="widget-header span12">
                                                <div class="span12"> <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location'];?>
</h1> </div>
                                            </div>

                                            <div class="span12 widget-body-section input-group">
                                                <div class="span12 no-min-height">
                                                    <div class="span12 form-left">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['location'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-search"></span>
                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['location'];?>
" type="text" id="map_location_name"/> </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6 form-left no-ml">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location_lat'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-map-marker"></span>
                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location_lat'];?>
" type="text" name="location_lat" id="location_lat" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['location_lat'];?>
" onchange="markChange()"/> </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6 form-left">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location_lon'];?>
</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-map-marker"></span>
                                                                <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['map_location_lon'];?>
" type="text" name="location_lon" id="location_lon" value="<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['location_lon'];?>
" onchange="markChange()"/> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="map-block" class="span12 no-min-height no-ml" style="height: 250px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-fluid"></div>
                            <div class="row-fluid"></div>
                            </form>              
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
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js" type="text/javascript" ></script>



<script type="text/javascript">

 /*var elementPosition = $('.tab-option').offset();
    $('.tab-content-con').scroll(function () {
        if ($('.tab-content-con').scrollTop() > elementPosition.top) {
            $('.tab-option').addClass('fix-tab-option');
           
        } else {
             $('.tab-option').removeClass('fix-tab-option');
        }
 });*/
 
 
var change = 0;
var confirm_ask = 0;
var edit_mod = 0;
$(document).ready(function() {
    /*$('#map-block').locationpicker({
        location: {
            latitude: '<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['location_lat'];?>
',
            longitude: '<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['location_lon'];?>
'
        },
        radius: 100,
        zoom: 15,
        inputBinding: {
            latitudeInput: $('#location_lat'),
            longitudeInput: $('#location_lon'),
            // radiusInput: $('#us2-radius'),
            locationNameInput: $('#map_location_name')
        },
        enableAutocomplete: true,
        autocompleteOptions: {
            types: ['(cities)'],
            // componentRestrictions: { country: 'fr'}
        }
    });*/

    if($(window).height() > 600) {
        <?php if (empty($_smarty_tpl->tpl_vars['customer_detail']->value)){?>
            $('.tab-content-con').css({ height: $(window).height()-168});  
        <?php }else{ ?>
            $('.tab-content-con').css({ height: $(window).height()-253});
        <?php }?>
    }
    else
        $('.tab-content-con').css({ height: $(window).height()});
        
    $("#remove_file").hide();
    $("#searchkey_text").click(function(){
        if($("#searchkey_text").val() == "<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_employee'];?>
"){
            $("#searchkey_text").val('');
        }
    });
    $("#searchkey_text").blur(function(){
        if($("#searchkey_text").val() == ""){
            $("#searchkey_text").val('<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_employee'];?>
');
        }
    });
    // Added by viteb solution 

    $(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()  {
			var url = $('#hdn_url').val();
			var customer = $('#username_1').val();
			//alert(url+customer);
			
			var ids = new Array();
			//var hrefs = new Array();
			$('#sortable li').each(function(){
				ids.push($(this).attr('id'));
				//hrefs.push($(this).find('a').attr('href'));
			});			
			$('#tmp_allocate').val(ids);
		}	
		});
    });
	
    
    $(".side_links li a,.logout").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
        var new_var = $("#new").val();
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
                                document.location.href = href_val;
                        }
                    }
            });
        }
        else{
            document.location.href = href_val;
        }
    
    });     
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
           var security = $('#social_security').val();
           security = security.replace("-","");
           $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/", { social_security : security },
                                                   function(data){
                                                       $('#soc_sec').html(data);
                                                       if(data!= ""){
                                                           $("#social_security").addClass("error");
                                                           $('#social_security').focus();
                                                           $('#social_flag').val('');  
                                                       }else{
                                                           $('#social_flag').val('1');
                                                           $("#social_security").removeClass("error");
                                                           var last_digit = security.substring(8,9);
                                                           if(last_digit % 2 == 0){
                                                                   $('#gender_male').prop('checked',false);
                                                                   $('#gender_female').prop('checked', true);
                                                           } else {
                                                                   $('#gender_male').prop('checked', true);
                                                                   $('#gender_female').prop('checked', false);
                                                           }
                                                       }
                                                   });
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


    $("#post").blur(function() {
        if($("#post").val()==""){
                 $("#post").addClass("error");
           }
           else{
                 $("#post").removeClass("error");
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

        
    /*$( "#date" ).datepicker({
        showOn: "button",
        buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
        buttonImageOnly: true
    });*/
    

    //generating username w.r.t lastname blur
    if($('#username').val() ==""){
        $('#last_name').blur(function() {
            if($('#last_name').val() != "" && $('#first_name').val() != ""){
                var name_first =  $('#first_name').val();
                var name_last =  $('#last_name').val();
                name_first = name_first.replace(/\Ä/g, "A");
                name_first = name_first.replace(/\Å/g, "A");
                name_first = name_first.replace(/\É/g, "E");
                name_first = name_first.replace(/\Ö/g, "O");
                name_first = name_first.replace(/\ä/g, "a");
                name_first = name_first.replace(/\å/g, "a");
                name_first = name_first.replace(/\é/g, "e");
                name_first = name_first.replace(/\ö/g, "o");
                name_last = name_last.replace(/\Ä/g, "A");
                name_last = name_last.replace(/\Å/g, "A");
                name_last = name_last.replace(/\É/g, "E");
                name_last = name_last.replace(/\Ö/g, "O");
                name_last = name_last.replace(/\ä/g, "a");
                name_last = name_last.replace(/\å/g, "a");
                name_last = name_last.replace(/\é/g, "e");
                name_last = name_last.replace(/\ö/g, "o");
                $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : name_first , last_name : name_last },
                                        function(data){
                                            $('#username').val(data);
                                            //if(parseInt(data.substring(4,7)) > 1)
                                            var security = $('#social_security').val();
                                            security = security.replace("-","");
                                            $('#dialog_hidden').load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_global_check.php?ssno=" + security);
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
ajax_generate_username/", { first_name : name_first , last_name : name_last },
        function(data){
        $('#username').val(data);	
    });
    }
    });
    }

        
        
       $('#mobile').blur(function() {
            var mobiles = $('#mobile').val();
         if($('#mobile').val() != "" ||  $('#mobile').val() != "+46"){
            mobiles = removeCharas(mobiles);
            mobiles =trimMobileNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
                error = error + 1;
            }else{
                $("#mobile").removeClass("error");
            }
        }
       
    //$('#mobs').hide();
   
    });
 
});


function validate_email(email){ // function to validate email
    
    var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     return email_regex.test(email);

    
}

// generating password
function generate_password(){
    $("#pass").html('<input type="text"  id="password" name="password" value ="<?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
" />');
    //$('#send_mail_yes:radio').prop("checked", true).attr('checked', 'checked');
}

function loadNotAllocatedWorkers() {
    if($('#searchkey_text').val() == "<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_employee'];?>
" || $('#searchkey_text').val() == ""){
        $('#searchkey').val('');
    }else{
        $('#searchkey').val($('#searchkey_text').val());
    }
    var employee_list = '';         
    var customer = $('#username').val();
    var key = $('#searchkey').val();
    var tmp_allocate = $('#tmp_allocate').val();
    if(tmp_allocate != ''){
        employee_list = tmp_allocate;
    }
    $('#nwoekers_list').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_list.php",
        type:"POST",
        data:encodeURI("listtype=toadd&customer=" + customer  + "&searchkey=" + key + "&employees=" + employee_list),
        success:function(data){
            $("#nwoekers_list").html(data);
            scroller();
        }
    });
}

function assignEmployee(username) {
    markChange(); 
    var tmp_allocate = $('#tmp_allocate').val();
    var new_members = $('#new_team_member').val();
    var remove_members = $('#remove_member').val();
    var tmp_allocate_array = remove_members.split(",");
    var tl = $('#tl').val();
    var stl = $('#stl').val();
    var rem_mem_allocate = '';
    var new_user_list = '';
    var j = 0;
    for(var i=0; i < tmp_allocate_array.length; i++) {
        if(tmp_allocate_array[i] != username) {
            if(j > 0){
                rem_mem_allocate += ",";
            }
            rem_mem_allocate += tmp_allocate_array[i];
            j++;
        }
    }
    if(new_members != ''){
        new_members = new_members + ',' + username
    }else{
        new_members = username;
    }
    if(tmp_allocate != '') {
        new_user_list = tmp_allocate + ',' + username;
    } else {
        new_user_list = username;
    }
    $('#remove_member').val(rem_mem_allocate);
    $('#new_team_member').val(new_members);
    $('#tmp_allocate').val(new_user_list);
    $('#naddwoekers_list').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_list.php",
        type:"POST",
        data:"listtype=allocated&employees=" + new_user_list + "&tl="+tl+"&stl="+stl+"&customer=<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
",
        success:function(data){
            $("#tosave_workers").html(data);
            loadNotAllocatedWorkers();
            scroller();
        }
    });
}

function removeEmployee(username) {
    markChange();  
    var tmp_allocate = $('#tmp_allocate').val();
    var new_members = $('#new_team_member').val();
    var remove_members = $('#remove_member').val();
    var tl = $('#tl').val();
    var stl = $('#stl').val();
    var tmp_allocate_array = tmp_allocate.split(",");
    var tmp_new_member_array = new_members.split(",");
    var new_tmp_allocate = "";
    var new_mem_allocate = "";
    if(remove_members == ""){
        remove_members = username;
    }else{
        remove_members = remove_members+","+username;
    }
    var j = 0;
    for(var i=0; i < tmp_new_member_array.length; i++) {
        if(tmp_new_member_array[i] != username) {
            if(j > 0){
                new_mem_allocate += ",";
            }
            new_mem_allocate += tmp_new_member_array[i];
            j++;
        }
    }
    j=0;
    for(var i=0; i < tmp_allocate_array.length; i++) {
        if(tmp_allocate_array[i] != username) {
            if(j > 0){
                new_tmp_allocate += ",";
            }
            new_tmp_allocate += tmp_allocate_array[i];
            j++;
        }
    }
    $('#remove_member').val(remove_members);
    $('#tmp_allocate').val(new_tmp_allocate);
    $('#new_team_member').val(new_mem_allocate );
    $('#tosave_workers').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_list.php",
        type:"POST",
        data:"listtype=allocated&employees=" + new_tmp_allocate + "&tl="+tl+"&stl="+stl,
        success:function(data){
            $("#tosave_workers").html(data);
            loadNotAllocatedWorkers();
            scroller();
        }
    });
}

function makeTl(user) {

    if(edit_mod == 1){
        var tls = $('#tl').val();
        if(tls == ""){
            tls = user;
            $('#tl').val(user);
        }else{
           tls = tls+","+user;
           $('#tl').val(tls);
        }

        var stl_user = $('#stl').val();
        var temp_tls = $('#tl').val();
        var tmp_allocate = $('#tmp_allocate').val();
        $('#tosave_workers').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
        console.log(111);
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_list.php",
            type:"POST",
            data:"listtype=allocated&employees=" + tmp_allocate + "&tl="+temp_tls+"&stl="+stl_user,
            success:function(data){
                $("#tosave_workers").html(data);
                scroller();
            }
        });
    }
}

function makeSTl(user) {
    if(edit_mod == 1){
        var stls = $('#stl').val();
        if(stls == ""){
            stls = user;
            $('#stl').val(user);
        }else{
           stls = stls+","+user;
           $('#stl').val(stls);
        }

        //$('#stl').val(user);
        var tl_user = $('#tl').val();
        var tmp_allocate = $('#tmp_allocate').val();
        $('#tosave_workers').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_list.php",
            type:"POST",
            data:"listtype=allocated&employees=" + tmp_allocate + "&stl="+stls+"&tl="+tl_user,
            success:function(data){
                $("#tosave_workers").html(data);
                scroller();
            }
        });
    }
}

function showTemp(){
    //alert($('#tmp_allocate').val());
}
//save form
function saveForm(){
    var error_pass = 0;                                   
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
        if($("#phone").val() == "0"){
            $("#phone").val('');
        }
        if($("#mobile").val() == "+46"){
            $("#mobile").val('');
        }
        if($("#relative_phone").val() == "0"){
            $("#relative_phone").val('');
        }
        if($("#relative_work_phone").val() == "0"){
            $("#relative_work_phone").val('');
        }
        if($("#relative_mobile").val() == "+46"){
            $("#relative_mobile").val('');
        }
        if($("#guardian_mobile").val() == "+46"){
            $("#guardian_mobile").val('');
        }
        if($("#guardian_mobile2").val() == "+46"){
            $("#guardian_mobile2").val('');
        }
        var security = $('#social_security').val();
        security = security.replace("-","");
         $.ajax({
         url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/",  
        type:"POST",
        data:"social_security="+security,
        success:function(data){
                //$('#soc_sec').html(data);
                if(data == "<?php echo $_smarty_tpl->tpl_vars['translate']->value['this_social_security_number_is_wrong'];?>
"){
                    $("#social_security").addClass("error");
                    $('#social_security').focus();
                    $('#social_flag').val(''); 
                } else {
                    $('#social_flag').val('1');
                    $("#social_security").removeClass("error");
                }
                if($('#social_flag').val() == ""){
                         $("#social_security").addClass("error");
                         errors =  1;
                }
        
                var pass = $("#password").val();
                if(pass.length < 8){
                    $("#password").addClass("error");
                    error_pass = 1;
                }      
                
                if($('#mobile').val() != ""){
                        var mobiles = $('#mobile').val();
                        mobiles = removeCharas(mobiles);
                        mobiles = trimMobileNumber(mobiles);
                        if(isNaN(mobiles)){
                            $("#mobile").addClass("error");
                            error = error + 1;
                        }else{
                            $("#mobile").removeClass("error");
                        }
                }
        
        
                //$("#mobile").removeClass("error");

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

                if($("#date").val()==""){
                        $("#date").addClass("error");
                        error = error + 1;
                }
                else{
                        $("#date").removeClass("error");
                }
                // mail_send = $('input:radio[name=send_mail]:checked').val();
                // if(mail_send == 1){
                //         if($("#email").val()== ""){
                //             $("#email").addClass("error");
                //             error = error + 1;
                //     }
                //     else{
                //             $("#email").removeClass("error");
                //     }
                // }else{
                //             $("#email").removeClass("error");
                // }
                if(error == 0 && error_pass == 0 && errors == 0){
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
                            $("#error_error").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['required_missing'];?>
");
                        }
                        if(error_pass != 0){
                            $("#error_pass").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['password_minimum'];?>
");
                        }
                    }
            }
                    
        });
        
	}		
       
}

//reset form
function resetForm(){

document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/add/<?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
/';
} 

//print form
function printForm(){

}

function attachAnother() {
 markChange()               
var file_count = parseInt($('#file_count').val()) + 1;
if(file_count > 1){
    $("#remove_file").show();
}
$('#file_count').val(file_count);
$('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' /></div>");
}

function removeFile(id){
markChange()
var id = $('#file_count').val();
var file_count = parseInt(id) - 1;
if(file_count == 1){
    $("#remove_file").hide();
}
$('#file_count').val(file_count);
$('div').remove('.file_attach_row' + id);
}
function docRemove(doc, this_obj) {
markChange()
 var old_del = $("#del_doc").val();               
var old_docs = $('#tdocs').val();
var doc_array = old_docs.split(",");
for(var i=0; i < doc_array.length; i++) {
if(doc_array[i] == doc) {
doc_array.splice(i, 1);
if(old_del == ""){
    $("#del_doc").val(doc);
}else{
$("#del_doc").val(old_del+","+doc);
}
break;
}
}
var new_array = doc_array.toString();
$('#tdocs').val(new_array);
    //$('#file_list').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
    //$("#file_list").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_attachments.php?type=customer_attachment&docs=" + new_array);

    $(this_obj).parents('li.list-group-item').remove();
}

function listAllRelatives(){
    
    var username = $('#username').val();
    $('#relatives_list').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php",
        type:"POST",
        data:"action=list&customer="+username,
        success:function(data){
            $("#relatives_list").html(data);
            if($("#relatives_list table tr").length > 12)
            $("#relatives_list").css("overflow-y","scroll");
            $('#relatives_add').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
            $("#relatives_add").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php?action=add");
        }
    });
}
			
function deleteRelative(id) {
      
    if(confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['are_you_sure'];?>
")) {

        var username = $('#username').val();
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php",
            type:"POST",
            data:"action=delete&id="+id+"&customer="+username,
            success:function(data){
                listAllRelatives()
            }
        });
    }
}

function loadRelative(id){
       
    var username = $('#username').val();
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php",
        type:"POST",
        data:"action=load&id="+id+"&customer="+username,
        success:function(data){
            $("#relatives_add").html(data);
        }
    });
}
function addRelative(){
    var username = $('#username').val();
    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php",
        type:"POST",
        data:"action=add&customer="+username,
        success:function(data){
            $("#relatives_add").html(data);
        }
    });
}

function saveRelative(){

    var username = $('#username').val();
    var relative_id = $("#relative_id").val();
    var relative_name = $("#relative_name").val();
    var relative_address = $("#relative_address").val();
    var relative_city = $("#relative_city").val();
    var relative_relation = $("#relative_relation").val();
    var relative_phone = $("#relative_phone").val();
    var relative_work_phone = $("#relative_work_phone").val();
    var relative_mobile = $("#relative_mobile").val();
    var relative_email = $("#relative_email").val();
    var relative_other = $("#relative_other").val();

    var data_set = {
        'action' : 'save',
        'customer' : username,
        'name' : relative_name,
        'address' : relative_address,
        'city' : relative_city,
        'relation' : relative_relation,
        'phone' : relative_phone,
        'work_phone' : relative_work_phone,
        'mobile' : relative_mobile,
        'email' : relative_email,
        'other' : relative_other,
        'id' : relative_id
    };

    $.ajax({
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_relative.php",
        type:"POST",
        data: data_set,
        success:function(data){
            listAllRelatives();
        }
    });

}

function markChange(){
    change = 1;
    $("#new").val("1");
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
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


function giveInactive(){
    var inact = $("#date_inactive").val();
    if(inact == "" || inact == null){
        $("#date_inactive").val("<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
");
    }
    markChange();

}   

function giveActivation(){
    var inact = $("#date_inactive").val();
    if(inact != "" || inact != null){
        $("#date_inactive").val("");
    }
    
    markChange();

} 
function downloadFile(filename){
    document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/"+filename;
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

function scroller(){
    return true;
}
</script>
<script>
$(document).ready(function(){

    <?php if ($_smarty_tpl->tpl_vars['access_flag']->value==1&&$_smarty_tpl->tpl_vars['customer_username']->value!=''){?>
        edit_mod = 0;
        //$("#password, .btn-group button:not(.excluded_edit button), #form select,  #form input:not(.excluded_edit input), #form textarea").prop('disabled', true);
        $("#password, #save, #add, .include_edit, .btn-group button:not(.excluded_edit button), #form select:not(.excluded_edit) option:not(:selected)").attr('disabled', true);
        $("#form input:not(.excluded_edit), #form textarea:not(.excluded_edit)").prop('readonly', true);
        $(':radio:not(.excluded_edit),:checkbox:not(.excluded_edit)').click(function(){
            return false;
        });
        $('.icon-plus, .icon-minus').hide();
        
        //$(':radio,:checkbox').unbind('click');

        $("#btn_edit").click(function() {
            
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_customer_personal_data_mail_go'];?>
', [
                {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/add/<?php if (isset($_smarty_tpl->tpl_vars['customer_username']->value)){?><?php echo $_smarty_tpl->tpl_vars['customer_username']->value;?>
/<?php }?>";
                    }
                }, 
                {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                        edit_mod = 1;
                        
                        $("#password, #save, #add, .include_edit, .btn-group button:not(.excluded_edit button), #form select:not(.excluded_edit) option:not(:selected)").attr('disabled', false);
                        $("#form input:not(.excluded_edit, #username), #form textarea:not(.excluded_edit)").prop('readonly', false);
                        $(':radio:not(.excluded_edit),:checkbox:not(.excluded_edit)').unbind('click');
                        $('.icon-plus, .icon-minus').show();


                        $(".datepicker").datepicker({
                            autoclose: true,
                            weekStart: 1,
                            calendarWeeks: true, 
                            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
                        });

                        $.mask.definitions['~']='[1-9]';
                        $("#mobile, #guardian_mobile, #guardian_mobile2, #relative_mobile").mask("+46?~99 99 99 99 99", { placeholder:" "});
                        $("#phone, #relative_phone, #relative_work_phone").mask("0?~9-99999999999", { placeholder:" "});
                        
                        $("#btn_save").removeAttr('disabled');
                    }
                }
            ]);      
        });
    <?php }else{ ?>

    $.mask.definitions['~']='[1-9]';
    $("#mobile, #guardian_mobile, #guardian_mobile2, #relative_mobile").mask("+46?~99 99 99 99 99", { placeholder:" "});
    $("#phone, #relative_phone, #relative_work_phone").mask("0?~9-99999999999", { placeholder:" "});

        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
    <?php }?>



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
      return $('.list').length > 0 ? $('.list').position().left : 0;
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
function backForm() {
    //document.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/customer/<?php if ($_smarty_tpl->tpl_vars['customer_detail']->value['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/';
    window.history.back();
}

function print_data(){
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_customer_information.php?username=<?php echo $_smarty_tpl->tpl_vars['customer_detail']->value['username'];?>
&_'+Date.now());
}
</script>

    </body>
</html><?php }} ?>