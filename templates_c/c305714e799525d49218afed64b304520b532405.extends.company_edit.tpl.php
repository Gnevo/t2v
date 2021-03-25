<?php /* Smarty version Smarty-3.1.8, created on 2021-02-24 06:44:53
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/company_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4467022236035f5e5a9ec24-47724741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c305714e799525d49218afed64b304520b532405' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/company_edit.tpl',
      1 => 1613804739,
      2 => 'file',
    ),
    '155ef44d21124b6a12721a0ce0a1b854e2116a35' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/dashboard.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4467022236035f5e5a9ec24-47724741',
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
  'unifunc' => 'content_6035f5e6125e54_24771009',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035f5e6125e54_24771009')) {function content_6035f5e6125e54_24771009($_smarty_tpl) {?><!DOCTYPE html>
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
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/jquery-ui-new.css" />
    <style>
        .form-group-gray{ overflow-y: auto !important;}
        #vacation_perc_slots .ui-button-text{ width: 20px; }
        #vacation_perc_slots .ui-button-text-only .ui-button-text{ padding: 0.4em 1.1em 0.4em 0.6em !important;}
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
                                
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 5px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="pull-left"> <h1 ><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_information'];?>
</h1></div>
                    <div class="pull-right">
                        <button class="btn btn-default pull-right btn-default-border"  type="button" onclick="save_form()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                        <button class="btn btn-default pull-right btn-default-border"  type="button" onclick="back_button()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                    </div>
                </div>
            </div>
                   <div class="tab-content-con tab-content-con-companysetting">
            <div class="span12 widget-body-section input-group">
                <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                <div class="span12 input-group-wrpr no-ml">
                    <form method="post" action="" name="company_form" id="company_form" class='no-mb' enctype="multipart/form-data">
                        <div class="row-fluid" style="float:left !important; margin:0 0 15px 0">
                            <div class="span4  form-group-gray">
                                <div class="span3">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
company_logo/<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['logo'];?>
"/>
                                </div>
                                <div style="margin:10px 0px 10px 10px !important" class="span5">
                                    <label style="float: left;" class="span12" for="file"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_logo'];?>
</label>
                                    <div class="btn-file" style="padding:0;"> <i class="glyphicon glyphicon-folder-open"></i><input name="file" id="file" onchange="putFilePath()" class="file" multiple data-show-upload="false" data-show-caption="true" type="file"></div>
                                </div>

                                <div style="margin: 0 ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_name'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_name'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['name'];?>
"  id="name" name="name" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0 !important;" class="span12">
                                    <label style="float: left;" class="span12" for="org_no"><?php echo $_smarty_tpl->tpl_vars['translate']->value['organization_number'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['organization_number'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['org_no'];?>
"  id="org_no" name="org_no" type="text"> 
                                    </div>
                                </div>

                            </div>

                            <div class="span4  form-group-gray">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_1'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_1'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contact_person1'];?>
"  id="contact_person1" name="contact_person1" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person1_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_email_1'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_email_1'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contact_person1_email'];?>
"  id="contact_person1_email" name="contact_person1_email" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_2'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_2'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contact_person2'];?>
"  id="contact_person2" name="contact_person2" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person2_email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_email_2'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_person_email_2'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contact_person2_email'];?>
"  id="contact_person2_email" name="contact_person2_email" type="email"> 
                                    </div>
                                </div>

                            </div>

                            <div  class="span4  form-group-gray ">
                                <div class="span12" style="margin: 0 !important;">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_system'];?>
</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" name="salary_system" id="salary_system">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="1"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type1'];?>
</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="2"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type2'];?>
</option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="3"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type3'];?>
</option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="4"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type4'];?>
</option>
                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="5"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type5'];?>
</option>
                                            <option value="6" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="6"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type6'];?>
</option>
                                             <option value="7" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['salary_system']=="7"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type7'];?>
</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="price_per_customer"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_customer'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_customer'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['price_per_customer'];?>
"  id="price_per_customer" name="price_per_customer" type="text" readonly="readonly" /> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="price_per_sms"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sms'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sms'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['price_per_sms'];?>
"  id="price_per_sms" name="price_per_sms" type="text" readonly="readonly" /> 
                                    </div>
                                </div>
                                   
                                <div class="span12 form-left">
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['SEM_in_days'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="sem_leave_days">
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['sem_leave_days'];?>
" id="sem_leave_days" name="sem_leave_days"/>
                                    </div>
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['VAB_in_days'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="vab_leave_days">
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['vab_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['vab_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['vab_leave_days'];?>
" id="vab_leave_days" name="vab_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['FP_in_days'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="fp_leave_days">
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['fp_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['fp_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['fp_leave_days'];?>
" id="fp_leave_days" name="fp_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['NOPAY_in_days'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="nopay_leave_days">
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['nopay_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['nopay_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['nopay_leave_days'];?>
" id="nopay_leave_days" name="nopay_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['OTHER_in_days'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="other_leave_days">
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['other_leave_days']!=1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button type="button" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['other_leave_days']==1){?>active btn-primary<?php }else{ ?> btn-default<?php }?>" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['other_leave_days'];?>
" id="other_leave_days" name="other_leave_days"/>
                                    </div>    
                                </div>    
                            </div>
                        </div>

                        <div class="row-fluid" style="float:left !important; margin:0 0 15px 0">
                            <div class="span4  form-group-gray ">
                                <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['check_atl'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="atl">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['atl_check']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['atl_check']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['atl_check'];?>
" id="check_atl" name="check_atl"/>
                                </div>
                                <div class="span12" style="margin: 0 !important;">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_start_day'];?>
</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" name="start_day" id="start_day">
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
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="start_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_start_time'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_start_time'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['vals']->value[1];?>
" id="start_time" name="start_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['split_fkkn_for_export'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="fkkn_split">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['fkkn_split']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['fkkn_split']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['fkkn_split'];?>
" id="fkkn_split" name="fkkn_split"/>
                                </div>
                            </div>

                            <div  class="span4  form-group-gray ">
                                <div style="margin: 0px 0px 10px 0 !important;" class="span12" id="advance_leave" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==''||$_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==null){?>style="display: none;"<?php }?>>
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_in_advance'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="leave">
                                        <button id="off_btn" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['leave_in_advance']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button id="on_btn" class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['leave_in_advance']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['leave_in_advance'];?>
" id="leave_in_advance" name="leave_in_advance"/>
                                </div>
                                <div class="span12" style="margin: 0 !important;" id="start_month">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sem_start_month'];?>
</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="sem_start_month" name="sem_start_month" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['leave_in_advance']==0){?> disabled <?php }?>>
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <option value="01" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==1){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['january'];?>
</option>
                                            <option value="02" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==2){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['february'];?>
</option>
                                            <option value="03" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==3){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['march'];?>
</option>
                                            <option value="04" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==4){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['april'];?>
</option>
                                            <option value="05" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==5){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
                                            <option value="06" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==6){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['june'];?>
</option>
                                            <option value="07" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==7){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['july'];?>
</option>
                                            <option value="08" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==8){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['august'];?>
</option>
                                            <option value="09" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==9){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['september'];?>
</option>
                                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==10){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['october'];?>
</option>
                                            <option value="11" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==11){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['november'];?>
</option>
                                            <option value="12" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sem_year_start_month']==12){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['december'];?>
</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="vacation_perc"><?php echo $_smarty_tpl->tpl_vars['translate']->value['vacation_percentage'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['vacation_percentage'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['vacation_percentage'];?>
" class="form-control span11" id="vacation_perc" name="vacation_perc" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="vacation_perc_slots"><?php echo $_smarty_tpl->tpl_vars['translate']->value['vacation_percentage_slots'];?>
</label>
                                    <div style="margin: 0px;" class="span12">
                                        <div id="vacation_perc_slots" style="padding-left: 0px;">
                                            <input type="checkbox" id="chkVacationPercSlot0" name="vacation_perc_slots[0]" value="1" <?php if (in_array(0,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot0"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-0 slot-icon-small-normal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot1" name="vacation_perc_slots[1]" value="1" <?php if (in_array(1,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot1"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-1 slot-icon-small-travel active" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot2" name="vacation_perc_slots[2]" value="1" <?php if (in_array(2,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot2"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-2 slot-icon-small-break" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot3" name="vacation_perc_slots[3]" value="1" <?php if (in_array(3,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot3"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot4" name="vacation_perc_slots[4]" value="1" <?php if (in_array(4,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot4"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot5" name="vacation_perc_slots[5]" value="1" <?php if (in_array(5,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot5"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot6" name="vacation_perc_slots[6]" value="1" <?php if (in_array(6,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot6"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot14" name="vacation_perc_slots[14]" value="1" <?php if (in_array(14,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot14"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot7" name="vacation_perc_slots[7]" value="1" <?php if (in_array(7,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot7"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot8" name="vacation_perc_slots[8]" value="1" <?php if (in_array(8,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot8"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-8 slot-icon-small-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot9" name="vacation_perc_slots[9]" value="1" <?php if (in_array(9,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot9"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot10" name="vacation_perc_slots[10]" value="1" <?php if (in_array(10,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot10"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot11" name="vacation_perc_slots[11]" value="1" <?php if (in_array(11,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot11"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot12" name="vacation_perc_slots[12]" value="1" <?php if (in_array(12,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot12"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot13" name="vacation_perc_slots[13]" value="1" <?php if (in_array(13,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot13"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot15" name="vacation_perc_slots[15]" value="1" <?php if (in_array(15,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot15"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-15 slot-icon-small-standby" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot16" name="vacation_perc_slots[16]" value="1" <?php if (in_array(16,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot16"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot17" name="vacation_perc_slots[17]" value="1" <?php if (in_array(17,$_smarty_tpl->tpl_vars['vacation_percentage_slots']->value)){?>checked="TRUE"<?php }?> />
                                            <label for="chkVacationPercSlot17"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
"></li></ul></label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div style="margin: 0 0 10px !important;" class="span12" id="include_sick_in_sem">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['include_sick_in_sem_calculation'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="include_sick">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_sick']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_sick']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['include_sick'];?>
" id="include_sick" name="include_sick"/>
                                </div>    
                                <div style="margin: 0 0 10px !important;" class="span12" id="sick_annex_calculation">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sick_annex_calculation_mode'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="sick_annex_calculation_mode">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sick_annex_calculation_mode']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['calculation_mode_1'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sick_annex_calculation_mode']==2||$_smarty_tpl->tpl_vars['company_detail']->value['sick_annex_calculation_mode']==''){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['calculation_mode_2'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['sick_annex_calculation_mode'];?>
" id="sick_annex_calculation_mode" name="sick_annex_calculation_mode"/>
                                </div>        
                            </div>   

                            <div class="span4  form-group-gray">
                                <div class="span12" style="margin: 0px 0px 10px 0px !important;">
                                    <div style="margin: 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['use_inconvenient'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="inconvenient">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['inconvenient_on']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['inconvenient_on']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['inconvenient_on'];?>
"  id="chk_inconvenient_on" name="chk_inconvenient_on"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['candg_on_off'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="candg_on">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg_on']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg_on']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg_on'];?>
"  id="candg_on" name="candg_on"/>
                                    </div>
                                </div>
                               
                                
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12 ">
                                    <div style="margin: 0px 0px 0px 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_by'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left; margin: 0px !important;" purpose="sort">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sort_name_by']==2){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name_sort_by'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sort_name_by']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button" value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name_sort_by'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['sort_name_by'];?>
" id="sortby_fn" name="sort_by"/>
                                    </div>    

                                    <div style="margin: 0px !important;" class="span6 candg_status">
            
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['come_and_go_break'];?>
</label>
                                        <div class="btn-group btn-toggle span6" style="float: left; margin: 0px !important;" purpose="candg_break">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg_break']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg_break']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg_break'];?>
" id="candg_break_switch" name="candg_break_switch"/>
                                        </div>
                                        
                                        <div class="span6 count-slider" style="margin:0px !important" id="sliderdiv">
                                            <div class="span9" style="padding: 8px 0px 0px 5px;"><div id="slider"></div></div>                           
                                            <div class="span3"><input type="textbox" id="sliderValue" name="slider_txt_candg_break" class="textboxes count-slider-value" style="width: 100%" value="<?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg_break']){?><?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg_break'];?>
<?php }else{ ?>4<?php }?>"></div> 
                                        </div>
                                        
                                    </div>

                                </div>
                                
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">

                                    <div style="margin: 0px 0px 0px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['include_karense_salary'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="include_karense_salary">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_karense_salary']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_karense_salary']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['include_karense_salary'];?>
"  id="chk_include_karense_salary" name="chk_include_karense_salary"/>
                                    </div>

                                    <div style="margin: 0px 0px 0px 0!important;" class="span6 candg_status">
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['candg_with_slots'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="candg">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['candg']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg'];?>
"  id="candg" name="candg"/>
                                    </div>
                                </div> 
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">   
                                    <div style="margin: 0px 0px 0px 0!important;" class="span12" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['include_sem_2_14_oncall_salary'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="include_sem_2_14_oncall_salary">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_sem_2_14_oncall_salary']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['include_sem_2_14_oncall_salary']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['include_sem_2_14_oncall_salary'];?>
"  id="chk_include_sem_2_14_oncall_salary" name="chk_include_sem_2_14_oncall_salary"/>
                                    </div>
                                </div>    
                                <div style="margin: 0px 0px 10px 0!important;" class="span12" >
                                    <div style="margin: 0px 0px 0px 0!important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sick_15_90_oncall'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="sick_15_90_oncall">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sick_15_90_oncall']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['sick_15_90_oncall']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['sick_15_90_oncall'];?>
"  id="sick_15_90_oncall" name="sick_15_90_oncall"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kfo'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="kfo">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['kfo']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['kfo']==1){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['kfo'];?>
"  id="kfo" name="kfo"/>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0!important;" class="span12" >
                                    <div style="margin: 0px 0px 0px 0!important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karens_full'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="karens_full">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['karens_full']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['karens_full']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['karens_full'];?>
"  id="karens_full" name="karens_full"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karens'];?>
</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="karens">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['karens']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['karens']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['karens'];?>
"  id="karens" name="karens"/>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row-fluid">                              

                            <div class="span4  form-group-gray " id="1">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="company_box"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_box'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_box'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['box'];?>
"  id="company_box" name="company_box" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="address"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_address_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_address_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['address'];?>
"  id="address" name="address" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_city_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_city_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['city'];?>
"  id="city" name="city" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="zipcode"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_zipcode_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_zipcode_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['zipcode'];?>
"  id="zipcode" name="zipcode" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="land_code"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_land_code_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_land_code_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['land_code'];?>
"  id="land_code" name="land_code" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_phone_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_phone_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['phone'];?>
"  id="phone" name="phone" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_mobile_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_mobile_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['mobile'];?>
"  id="mobile" name="mobile" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_email_new'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_email_new'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['email'];?>
"  id="email" name="email" type="email"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="website"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_website'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_website'];?>
" class="form-control span11" id="website" name="website" type="text" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['website'];?>
"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_account'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['bank_account'];?>
" class="form-control span11" id="bank_account" name="bank_account" type="text" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['bank_account'];?>
"> 
                                    </div>
                                </div>

                            </div>

                            <div  class="span4  form-group-gray">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="fk_kr_per_time">FK <?php echo $_smarty_tpl->tpl_vars['translate']->value['kr_per_time'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="FK <?php echo $_smarty_tpl->tpl_vars['translate']->value['kr_per_time'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['fk_kr_per_time'];?>
"  id="fk_kr_per_time" name="fk_kr_per_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="kn_kr_per_time">KN <?php echo $_smarty_tpl->tpl_vars['translate']->value['kr_per_time'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="KN <?php echo $_smarty_tpl->tpl_vars['translate']->value['kr_per_time'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['kn_kr_per_time'];?>
"  id="kn_kr_per_time" name="kn_kr_per_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="weekly_hour"><?php echo $_smarty_tpl->tpl_vars['translate']->value['weekly_hour'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>

                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['weekly_hour'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['weekly_hour'];?>
"  id="weekly_hour" name="weekly_hour" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="montly_oncall_hour"><?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_oncall_hour'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_oncall_hour'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['monthly_oncall_hour'];?>
"  id="montly_oncall_hour" name="montly_oncall_hour" type="text"> 
                                    </div>
                                </div>



                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="max_daily_hour"><?php echo $_smarty_tpl->tpl_vars['translate']->value['max_daily_hour'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['max_daily_hour'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['max_daily_hour'];?>
"  id="max_daily_hour" name="max_daily_hour" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="max_daily_hour"><?php echo $_smarty_tpl->tpl_vars['translate']->value['min_daily_rest'];?>
</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['min_daily_rest'];?>
" class="form-control span11" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['min_daily_rest'];?>
"  id="min_daily_rest" name="min_daily_rest" type="text"> 
                                    </div>
                                </div>

                            </div>


                            <div class="span4  form-group-gray">
                                <div class="span12" style="margin: 0px !important;" id="contract_start_month_div">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract_start_month'];?>
</label>
                                    <div class="input-prepend span5" style="margin:0 !important; float: left;"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="contract_start_month" name="contract_start_month">
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <option value="01" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==1){?> selected = "selected" <?php }?> >1. <?php echo $_smarty_tpl->tpl_vars['translate']->value['january'];?>
</option>
                                            <option value="02" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==2){?> selected = "selected" <?php }?>>2. <?php echo $_smarty_tpl->tpl_vars['translate']->value['february'];?>
</option>
                                            <option value="03" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==3){?> selected = "selected" <?php }?>>3. <?php echo $_smarty_tpl->tpl_vars['translate']->value['march'];?>
</option>
                                            <option value="04" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==4){?> selected = "selected" <?php }?>>4. <?php echo $_smarty_tpl->tpl_vars['translate']->value['april'];?>
</option>
                                            <option value="05" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==5){?> selected = "selected" <?php }?>>5. <?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
                                            <option value="06" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==6){?> selected = "selected" <?php }?>>6. <?php echo $_smarty_tpl->tpl_vars['translate']->value['june'];?>
</option>
                                            <option value="07" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==7){?> selected = "selected" <?php }?>>7. <?php echo $_smarty_tpl->tpl_vars['translate']->value['july'];?>
</option>
                                            <option value="08" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==8){?> selected = "selected" <?php }?>>8. <?php echo $_smarty_tpl->tpl_vars['translate']->value['august'];?>
</option>
                                            <option value="09" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==9){?> selected = "selected" <?php }?>>9. <?php echo $_smarty_tpl->tpl_vars['translate']->value['september'];?>
</option>
                                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==10){?> selected = "selected" <?php }?>>10. <?php echo $_smarty_tpl->tpl_vars['translate']->value['october'];?>
</option>
                                            <option value="11" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==11){?> selected = "selected" <?php }?>>11. <?php echo $_smarty_tpl->tpl_vars['translate']->value['november'];?>
</option>
                                            <option value="12" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_start_month']==12){?> selected = "selected" <?php }?>>12. <?php echo $_smarty_tpl->tpl_vars['translate']->value['december'];?>
</option>
                                        </select>
                                    </div>

                                    <div class="input-prepend span5" style="margin: 0px !important; float: right;"> 
                                        <select class="form-control span5" id="contract_month_start_date" name="contract_month_start_date">
                                            <?php $_smarty_tpl->tpl_vars['month_date'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['month_date']->step = 1;$_smarty_tpl->tpl_vars['month_date']->total = (int)ceil(($_smarty_tpl->tpl_vars['month_date']->step > 0 ? 31+1 - (1) : 1-(31)+1)/abs($_smarty_tpl->tpl_vars['month_date']->step));
if ($_smarty_tpl->tpl_vars['month_date']->total > 0){
for ($_smarty_tpl->tpl_vars['month_date']->value = 1, $_smarty_tpl->tpl_vars['month_date']->iteration = 1;$_smarty_tpl->tpl_vars['month_date']->iteration <= $_smarty_tpl->tpl_vars['month_date']->total;$_smarty_tpl->tpl_vars['month_date']->value += $_smarty_tpl->tpl_vars['month_date']->step, $_smarty_tpl->tpl_vars['month_date']->iteration++){
$_smarty_tpl->tpl_vars['month_date']->first = $_smarty_tpl->tpl_vars['month_date']->iteration == 1;$_smarty_tpl->tpl_vars['month_date']->last = $_smarty_tpl->tpl_vars['month_date']->iteration == $_smarty_tpl->tpl_vars['month_date']->total;?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['month_date']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_date']==$_smarty_tpl->tpl_vars['month_date']->value){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['month_date']->value;?>
</option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="span12" style="margin: 0 !important;" id="emp_contract_period_length_div">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract_period_length'];?>
</label>
                                    <div style="margin-left: 0px; float: left; width: 50%;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="emp_contract_period_length" name="emp_contract_period_length">
                                            <option value="01" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==1){?> selected = "selected" <?php }?>>1</option>
                                            <option value="02" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==2){?> selected = "selected" <?php }?>>2</option>
                                            <option value="03" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==3){?> selected = "selected" <?php }?>>3</option>
                                            <option value="04" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==4){?> selected = "selected" <?php }?>>4</option>
                                            <option value="05" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==5){?> selected = "selected" <?php }?>>5</option>
                                            <option value="06" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==6||$_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==''){?> selected = "selected" <?php }?>>6</option>
                                            <option value="07" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==7){?> selected = "selected" <?php }?>>7</option>
                                            <option value="08" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==8){?> selected = "selected" <?php }?>>8</option>
                                            <option value="09" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==9){?> selected = "selected" <?php }?>>9</option>
                                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==10){?> selected = "selected" <?php }?>>10</option>
                                            <option value="11" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==11){?> selected = "selected" <?php }?>>11</option>
                                            <option value="12" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['employee_contract_period_length']==12){?> selected = "selected" <?php }?>>12</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['check_contract'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="contract">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_exceed_check']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_exceed_check']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contract_exceed_check'];?>
" id="check_contract" name="check_contract"/>
                                </div>        
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signing_mail'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="signing">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['signing_mail']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['signing_mail']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['signing_mail'];?>
" id="signing_mail" name="signing_mail"/>
                                </div>        
                                <!-- <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['apply_max_karens'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="apply_max_karens">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['apply_max_karens']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['apply_max_karens']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['apply_max_karens'];?>
" id="apply_max_karens" name="apply_max_karens"/>
                                </div>    --> 
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_auto_renewal'];?>
</label>
                                    <div class="no-ml">
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="contract_auto_renewal">
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                            <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                        </div>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal'];?>
" id="contract_auto_renewal" name="contract_auto_renewal"/>
                                    </div>
                                        <div class="span6 ml div_contract_auto_renewal_mail" id="div_contract_auto_renewal_mail" <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal']!=1){?>style="display: none;"<?php }?>>
                                        <input type="email" id="contract_auto_renewal_mail" name="contract_auto_renewal_mail" class="span12" value="<?php if ($_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal']==1){?><?php echo $_smarty_tpl->tpl_vars['company_detail']->value['contract_auto_renewal_mail'];?>
<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['day_light_saving'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="day_light_saving">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['day_light_saving']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['day_light_saving']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['day_light_saving'];?>
" id="day_light_saving" name="day_light_saving"/>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sms_pw_recovery'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="sms_pw_recovery">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['recovery_pw_by_mobile']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['recovery_pw_by_mobile']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['recovery_pw_by_mobile'];?>
" id="sms_pw_recovery" name="sms_pw_recovery"/>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contact_mail_send'];?>
</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="contact_mail_send">
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['mail_send_to_contact_person']==0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="OFF"><?php echo $_smarty_tpl->tpl_vars['translate']->value['off'];?>
</button>
                                        <button class="btn <?php if ($_smarty_tpl->tpl_vars['company_detail']->value['mail_send_to_contact_person']!=0){?>active btn-primary<?php }else{ ?>btn-default<?php }?>" type="button"  value="ON"><?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
</button>
                                    </div>
                                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['mail_send_to_contact_person'];?>
" id="contact_mail_send" name="contact_mail_send"/>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <label style="margin-bottom:10px !important;"> </label>
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
js/nice-scroll.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
    <script>
        function save_form() {

            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['company_edit_save_alert_message'];?>
', [
            {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
            },
             {                          //// bootbox alert /////
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                    save_form_proceed();
                }
             }
          ]);
        }

        function save_form_proceed(){
            var error = 0;
            if($('#contract_auto_renewal').val() == 1){
                if(!isEmail($.trim($('#contract_auto_renewal_mail').val()))){
                    error = 1;
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_valid_email'];?>
');
                    $('#contract_auto_renewal_mail').focus();
                }
            }
            if(error == 0){
                $("#company_form").submit();
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        function back_button() {
            document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
administration/";
        }

        function putFilePath() {
            var file_path = $("#file").val();
            $("#browsed").val(file_path);
        }
                            
        $(document).ready(function() {
            $('.success, .message, .fail, .error').delay(10000).fadeOut();
            $(".atgargslista").hide();
            $(".btn-Utrustning").click(function() {
                $(".Utrustning").css('display', 'block');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '38%%');
                $(".main-right").css('display', 'block');
            });
            $("#on_btn").click(function(){
                $("#sem_start_month").prop("disabled", false);
            });
        
            $("#off_btn").click(function(){
                $("#sem_start_month").prop("disabled", true);
                $('#sem_start_month').prop('selectedIndex',0);
            });
        });

        $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-primary').size() > 0) {
                $(this).find('.btn').toggleClass('btn-primary');

                if ($(this).find('.btn-primary').val() == "ON") {
                    if ($(this).attr("purpose") == "atl")
                        $('#check_atl').val(1);
                    else if ($(this).attr("purpose") == "fkkn_split")
                        $('#fkkn_split').val(1);
                    else if ($(this).attr("purpose") == "leave")
                        $('#leave_in_advance').val(1);
                    else if ($(this).attr("purpose") == "inconvenient")
                        $('#chk_inconvenient_on').val(1);
                    else if ($(this).attr("purpose") == "include_karense_salary")
                        $('#chk_include_karense_salary').val(1);
                    else if ($(this).attr("purpose") == "include_sem_2_14_oncall_salary")
                        $('#chk_include_sem_2_14_oncall_salary').val(1);
                    else if ($(this).attr("purpose") == "candg")
                        $('#candg').val(1);
                    else if ($(this).attr("purpose") == "candg_on"){
                        $('#candg_on').val(1);
                        $(".candg_status").show();
                    }
                    else if ($(this).attr("purpose") == "candg_break"){
                        $('#candg_break_switch').val(1);
                        $("#sliderdiv").show();
                    }
                    else if ($(this).attr("purpose") == "sort")
                        $('#sortby_fn').val(2);
                    else if ($(this).attr("purpose") == "contract")
                        $('#check_contract').val(1);
                    else if ($(this).attr("purpose") == "signing")
                        $('#signing_mail').val(1);
                    else if ($(this).attr("purpose") == "apply_max_karens")
                        $('#apply_max_karens').val(1);
                    else if ($(this).attr("purpose") == "day_light_saving")
                        $('#day_light_saving').val(1);
                    else if ($(this).attr("purpose") == "sms_pw_recovery")
                        $('#sms_pw_recovery').val(1);
                    else if ($(this).attr("purpose") == "contact_mail_send")
                        $('#contact_mail_send').val(1);
                    else if ($(this).attr("purpose") == "sick_15_90_oncall")
                        $('#sick_15_90_oncall').val(1);
                    else if ($(this).attr("purpose") == "contract_auto_renewal"){
                        $('#contract_auto_renewal').val(1);
                        $('#div_contract_auto_renewal_mail').show();
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
                    else if ($(this).attr("purpose") == "include_sick") {
                        $('#include_sick').val(1);
                    }
                    else if ($(this).attr("purpose") == "sick_annex_calculation_mode") {
                        $('#sick_annex_calculation_mode').val(2);
                    }else if ($(this).attr("purpose") == "kfo") {
                        $('#kfo').val(1);
                    }else if ($(this).attr("purpose") == "karens_full") {
                        $('#karens_full').val(1);
                    }else if ($(this).attr("purpose") == "karens") {
                        $('#karens').val(1);
                    }
                }
                else if ($(this).find('.btn-primary').val() == "OFF") {
                    if ($(this).attr("purpose") == "atl")
                        $('#check_atl').val(0);
                    else if ($(this).attr("purpose") == "fkkn_split")
                        $('#fkkn_split').val(0);
                    else if ($(this).attr("purpose") == "leave")
                        $('#leave_in_advance').val(0);
                    else if ($(this).attr("purpose") == "inconvenient")
                        $('#chk_inconvenient_on').val(0);
                    else if ($(this).attr("purpose") == "include_karense_salary")
                        $('#chk_include_karense_salary').val(0);
                    else if ($(this).attr("purpose") == "include_sem_2_14_oncall_salary")
                        $('#chk_include_sem_2_14_oncall_salary').val(0);
                    else if ($(this).attr("purpose") == "candg")
                        $('#candg').val(0);
                    else if ($(this).attr("purpose") == "candg_on"){
                        $('#candg_on').val(0);
                        $(".candg_status").hide();
                    }
                    else if ($(this).attr("purpose") == "candg_break"){
                        $('#candg_break_switch').val(0);
                        $("#sliderdiv").hide();
                    }    
                    else if ($(this).attr("purpose") == "sort")
                        $('#sortby_fn').val(1);
                    else if ($(this).attr("purpose") == "contract")
                        $('#check_contract').val(0);
                    else if ($(this).attr("purpose") == "signing")
                        $('#signing_mail').val(0);
                    else if ($(this).attr("purpose") == "apply_max_karens")
                        $('#apply_max_karens').val(0);
                    else if ($(this).attr("purpose") == "day_light_saving")
                        $('#day_light_saving').val(0);
                    else if ($(this).attr("purpose") == "sms_pw_recovery")
                        $('#sms_pw_recovery').val(0);
                    else if ($(this).attr("purpose") == "contact_mail_send")
                        $('#contact_mail_send').val(0);
                    else if ($(this).attr("purpose") == "sick_15_90_oncall")
                        $('#sick_15_90_oncall').val(0);
                    else if ($(this).attr("purpose") == "contract_auto_renewal"){
                        $('#contract_auto_renewal').val(0);
                        $('#div_contract_auto_renewal_mail').hide();
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
                    else if ($(this).attr("purpose") == "include_sick") {
                        $('#include_sick').val(0);
                    }
                    else if ($(this).attr("purpose") == "sick_annex_calculation_mode") {
                        $('#sick_annex_calculation_mode').val(1);
                    }else if ($(this).attr("purpose") == "kfo") {
                        $('#kfo').val(0);
                    }else if ($(this).attr("purpose") == "karens_full") {
                        $('#karens_full').val(0);
                    }else if ($(this).attr("purpose") == "karens") {
                        $('#karens').val(0);
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
            //alert($('#apply_max_karens').val());
            $(this).find('.btn').toggleClass('btn-default');

        });

        $(document).ready(function() {
            var candg_on_show_option = '<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg_on'];?>
';
            var slider_show_option = '<?php echo $_smarty_tpl->tpl_vars['company_detail']->value['candg_break'];?>
';
            var slider_init_val = 4;
            if (slider_show_option != 0){
                slider_init_val = slider_show_option;
                $("#sliderValue").val(slider_init_val);
            }
            
            $("#slider").slider({
                range: "min",
                value: slider_init_val,
                min: 1,
                max: 24,
                step: 1,
                slide: function(event, ui) {
                    $("#sliderValue").val(ui.value);

                }
            });
            
            if(candg_on_show_option == 0){
                $(".candg_status").hide();
            }else{
                $(".candg_status").show();
                
            }

            if(slider_show_option == 0){
                $("#sliderdiv").hide();
            }else{
                $("#sliderdiv").show();
                
            }
            
            $( "#vacation_perc_slots" ).buttonset();
            
            if($(window).height() > 350)
                $('.tab-content-con-companysetting').css({ height: $(window).innerHeight()-95 });
            
            $(window).resize(function(){
                if($(window).height() > 350)
                    $('.tab-content-con-companysetting').css({ height: $(window).innerHeight()-95 });
            });
        });
    </script>

    </body>
</html><?php }} ?>