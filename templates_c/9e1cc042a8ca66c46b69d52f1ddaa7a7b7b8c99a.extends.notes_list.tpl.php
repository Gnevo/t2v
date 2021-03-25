<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 08:18:38
         compiled from "/home/time2view/public_html/cirrus/templates/notes_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19382251215fcde55e610111-51786745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e1cc042a8ca66c46b69d52f1ddaa7a7b7b8c99a' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/notes_list.tpl',
      1 => 1574750110,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19382251215fcde55e610111-51786745',
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
  'unifunc' => 'content_5fcde55e9e6e88_19067345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcde55e9e6e88_19067345')) {function content_5fcde55e9e6e88_19067345($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_truncate')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.truncate.php';
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
css/date-picker.css" type="text/css" /><!-- DATE PICKER -->
    <style type="text/css" >
        #table_list tr.active .note_number{ border-left: 5px solid;}
        #table_list tr.bolding_letters{ font-weight: bold;}
        
        #table_list.open-note-mode tr.active{ opacity: 1}
        #table_list.open-note-mode tr:not(.active){ opacity: 0.5}
        
        .btn-group{ white-space:normal !important;}
        .btn-visibility-types{ /*background: #90DCEB;*/border: 1px solid #116296; text-shadow:none !important; color: #000 !important;font-weight: 100;}
        .btn-visibility-types.active, .btn-visibility-types:hover{ background:#fff !important; color:#000 !important; }

        .contracts img, .settings img{ max-width: inherit; }
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

    <div class="span12 main-left slot-form" >
        <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes_list'];?>
</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button  class="btn btn-default btn-normal ml pull-right btn-addnew-notes" type="button" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_note'];?>
"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
</button>
                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget no-mb" style="margin-top:0;">
                        <div class="span12 widget-body-section input-group" id="search-section">

                                <div class="span6">
                                    <div class="span12">
                                        <div class="span4 cmb-year" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="cmb_year"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12">
                                                <span class="add-on icon-pencil"></span>
                                                <select class="form-control span11" name='cmb_year' id='cmb_year'>
                                                    <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_year'];?>
</option>
                                                    <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values']->value),$_smarty_tpl);?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4 cmb-month" >
                                            <label style="float: left;" class="span12" for="cmb_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12">
                                                <span class="add-on icon-pencil"></span>
                                                <select class="form-control span11" name='cmb_month' id='cmb_month'>
                                                    <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</option>
                                                    <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_month']->value,'output'=>$_smarty_tpl->tpl_vars['month_option_output']->value),$_smarty_tpl);?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_date_search'];?>
</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-calendar"></span>
                                                <input name="datepicker" id="datepicker"  value="<?php echo $_smarty_tpl->tpl_vars['search_date']->value;?>
" class="form-control span11 datepicker" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
" type="text" maxlength="100" /> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="span12 no-ml">

                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
                                            <div class="span4 employee-search-list" >
                                                <label style="float: left;" class="span12" for="cust_search_list"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
:</label>
                                                <div style="margin: 0px;" class="input-prepend span12">
                                                    <span class="add-on icon-pencil"></span>
                                                    <input name="cust_search_list" id="cust_search_list" value="<?php echo $_smarty_tpl->tpl_vars['sel_cust_label']->value;?>
" class="form-control span11" type="text"/> 
                                                    <input type="hidden" name="cust_selected" id="cust_selected" value="<?php echo $_smarty_tpl->tpl_vars['sel_cust']->value;?>
" />
                                                </div>
                                            </div>
                                        <?php }?>

                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_auther_search'];?>
</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="txt_auther_search" id="txt_auther_search" value="<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
" class="form-control span11" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
" type="text" maxlength="100" /> 
                                                <input type="hidden" name="emp_user_id" id="emp_user_id" value="<?php echo $_smarty_tpl->tpl_vars['emp_user_id']->value;?>
" />
                                            </div>
                                        </div>

                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word"><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
: </label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="txt_search_word" id="txt_search_word" value="<?php echo $_smarty_tpl->tpl_vars['sel_search_text']->value;?>
" class="form-control span11" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_comment'];?>
" type="text" maxlength="100" /> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="span6 mt">
                                    <button onclick="get_report();" class="btn btn-default btn-margin-set" style="margin-top: 15px; margin-left: 2em; text-align: center;" name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
 </button>
                                
                                    <button onclick="mark_all_read();" class="btn btn-default  btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_notes_read'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_notes_read'];?>
 </button>
                                </div>
                                <!-- <div class="span2"><button onclick="get_report();" class="btn btn-default btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
 </button>
                                
                                <button onclick="mark_all_read();" class="btn btn-default pull-right btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_notes_read'];?>
"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_all_notes_read'];?>
 </button>
                                </div> -->

                        </div>
                    </div>
                    <div class="span12 no-min-height no-ml mt">
                        <div class="pagination pagination-mini pagination-right pagin margin-none">
                            <?php if ($_smarty_tpl->tpl_vars['pagination']->value!=''){?><ul id="pagination"><?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
</ul><?php }?>
                        </div>
                    </div>
                    <input type="hidden" id="vikarie_delete_key" value="1" />
                    <div class="span12 no-ml table-responsive">
                        <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-responsive table-primary t no-mt" style="margin: 10px 0px 0px; top: 0px;">
                            <thead>
                                <tr>
                                    <th class="table-col-center" style="width:20px;">#</th>
                                    <th style="width: 15%;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['writer'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['title'];?>
</th>
                                    <th style="width:20%;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['discription'];?>
</th>
                                    <th width="10%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_written'];?>
</th>
                                    <th width="10%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['visibility'];?>
</th>
                                    <th width="7%"><?php echo $_smarty_tpl->tpl_vars['translate']->value['view'];?>
</th>
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?><th colspan="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</th><?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['record_no'] = new Smarty_variable($_smarty_tpl->tpl_vars['this_page_no']->value*$_smarty_tpl->tpl_vars['per_page']->value+$_smarty_tpl->tpl_vars['i']->value, null, 0);?>
                                    <tr id="status_<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" class="gradeX note_row <?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
 <?php if ($_smarty_tpl->tpl_vars['list']->value['status']=='1'){?>col-highlight-primary<?php }elseif($_smarty_tpl->tpl_vars['list']->value['status']==0){?>notes-highlight<?php }?><?php if ($_smarty_tpl->tpl_vars['list']->value['is_unread']==1){?> bolding_letters<?php }?>">
                                        <td class="table-col-center note_number" style="width:20px;"><?php echo $_smarty_tpl->tpl_vars['record_no']->value;?>
</td>
                                        <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['list']->value['emp_name'];?>
</td>
                                            <td class="entry-customer"><?php echo $_smarty_tpl->tpl_vars['list']->value['cust_name'];?>
</td>
                                        <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['list']->value['emp_name_lf'];?>
</td>
                                            <td class="entry-customer"><?php echo $_smarty_tpl->tpl_vars['list']->value['cust_name_lf'];?>
</td>
                                        <?php }?>
                                        <td class="entry-title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</td>
                                        <?php $_smarty_tpl->tpl_vars["cnt"] = new Smarty_variable(strlen(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['list']->value['description'])), null, 0);?>
                                        <td class="entry-description" ><?php if ($_smarty_tpl->tpl_vars['cnt']->value>35){?><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['list']->value['description']),35);?>
<?php }else{ ?><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['list']->value['description']);?>
<?php }?></td>
                                        <td><?php echo date('Y-m-d',strtotime($_smarty_tpl->tpl_vars['list']->value['date']));?>
</td>
                                        <td class="entry-visibility"><?php if ($_smarty_tpl->tpl_vars['list']->value['visibility']==1){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>

                                            <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==2){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['private'];?>

                                            <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==3){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>

                                            <?php }elseif($_smarty_tpl->tpl_vars['list']->value['visibility']==4){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only'];?>
<?php }?></td>
                                        <td class="table-col-center center">
                                            <span title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['note_details'];?>
" class="mr cursor_hand book-open" data-id='<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
'><i class='cursor_hand icon-eye-open icon-large'></i><?php if ($_smarty_tpl->tpl_vars['list']->value['is_unread']==1){?> <span class="unread_indication">*</span><?php }?></span>
                                            <input type="hidden" id="current_usr" value="<?php echo $_smarty_tpl->tpl_vars['current_usr']->value;?>
">
                                            <span class="entry-attachment-indication"><?php if ($_smarty_tpl->tpl_vars['list']->value['attachment']!=''){?><span title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
"><i class='icon-paper-clip icon-large'></i></span><?php }?></span>
                                        </td>
                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                            <td  class="table-col-center center" style="width:15px;">
                                                <?php if ($_smarty_tpl->tpl_vars['list']->value['status']==1){?>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(0,<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
)">
                                                        <img width="20" height="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['set_as_forbidden'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/cirrus_icon_reject.png">
                                                    </a>
                                                <?php }elseif($_smarty_tpl->tpl_vars['list']->value['status']==0){?>
                                                    <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
)">
                                                        <img width="20" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['set_as_active'];?>
" alt="" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/icon_approve.png">
                                                    </a>
                                                <?php }else{ ?>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/add/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/" class="settings" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
"><i class=" icon-cog icon-large cursor_hand"></i></a>
                                                <?php }?>
                                            </td> 
                                        <?php }?>
                                    </tr>
                                <?php }
if (!$_smarty_tpl->tpl_vars['list']->_loop) {
?>
                                    <tr>
                                        <td <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>colspan=10<?php }else{ ?>colspan=8<?php }?>><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
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
        <div id="right_message_wraper" class="span12 no-min-height"></div>
        

        <div class="span12 addnew-notes-box hide no-ml">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes'];?>
 <span class="note_process_action" style="font-size: 11px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_notes'];?>
</span></h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default btn-normal pull-right btn-save-notes" type="button" onclick="save_note()"><i class='icon-save'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                        <button class="btn btn-default btn-normal pull-right" style="margin-right: 5px;" type="button" onclick="refresh_note_edit()"><i class='icon-refresh'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right no-ml" type="button"><i class='icon-power-off'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="row-fluid">
                        <form method="post" name="note_form" id="note_form" >
                        <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                            <input type="hidden" id="edit_note_id" name="edit_note_id" value="" />
                            <div class="span12" style="margin: 0px;">
                                <label class="span12" style="float: left;" for="cmb_customer"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
:</label>
                                <div style="float: left; margin: 0px;" class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name='cmb_customer' id="cmb_customer" class="form-control span11 <?php if ($_smarty_tpl->tpl_vars['user_role']->value!='1'&&$_smarty_tpl->tpl_vars['user_role']->value!='6'){?>required<?php }?>">
                                        <?php if (count($_smarty_tpl->tpl_vars['combo_customers']->value)!=1||$_smarty_tpl->tpl_vars['user_role']->value!='3'){?><option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
</option><?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['combo_customers']->value){?>
                                            <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['combo_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><option value=<?php echo $_smarty_tpl->tpl_vars['entries']->value['username'];?>
 <?php if ($_smarty_tpl->tpl_vars['notes_detail']->value['cust_name']==$_smarty_tpl->tpl_vars['entries']->value['username']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['entries']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['entries']->value['last_name'];?>
</option>
                                                <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><option value=<?php echo $_smarty_tpl->tpl_vars['entries']->value['username'];?>
 <?php if ($_smarty_tpl->tpl_vars['notes_detail']->value['cust_name']==$_smarty_tpl->tpl_vars['entries']->value['username']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['entries']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['entries']->value['first_name'];?>
</option><?php }?>
                                            <?php } ?>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div style="margin: 10px 0px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="save_title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['title'];?>
:</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                    <input name="save_title" id="save_title" class="form-control span11" type="text" />
                                </div>
                            </div>
                            <div style="margin: 0px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="save_description"><?php echo $_smarty_tpl->tpl_vars['translate']->value['discription'];?>
:</label>
                                <textarea name="save_description" id="save_description" rows="1" class="form-control span12" style="margin: 0px 0px 10px;"></textarea>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value!='3'){?> 
                                <div class="span12 no-ml note_visibility_options">
                                    <div class="span12" style="margin: 0px ! important;">
                                        <label class="span12" style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['visibility'];?>
:</label>
                                        
                                        <div class="btn-group visibility_types" data-toggle="buttons">
                                            <label class="btn btn-primary btn-visibility-types" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['private_tooltip'];?>
">
                                                <input id="radio1" type="radio" value="2" class="hide" name="save_type"><?php echo $_smarty_tpl->tpl_vars['translate']->value['private'];?>

                                            </label>
                                            <label class="btn btn-primary btn-visibility-types" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['public_tooltip'];?>
">
                                                <input id="radio3" type="radio" value="1" class="hide" name="save_type"><?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>

                                            </label>
                                            <label class="btn btn-primary btn-visibility-types" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only_tooltip'];?>
">
                                                <input id="radio4" type="radio" value="4" class="hide" name="save_type"><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only'];?>

                                            </label>
                                        </div>
                                    </div>
                                </div>

                            <?php }?>
                                <div class="span12 mt no-ml">
                                    <label>
                                        <input type="checkbox" id="editable" name="editable" checked="checked">
                                        <?php echo $_smarty_tpl->tpl_vars['translate']->value['note_editable'];?>

                                    </label>
                                </div>
                            <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
                                <div class="span12 no-ml mt" style="overflow-x: auto;">
                                    <label style="float: left;" class="span12 mt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
 <button class="btn btn-default pull-right" id="btn_add_attachment"><i class="icon-plus cursor_hand "></i></button></label>
                                    <div style="margin: 10px 0px ! important; display: block ! important;" class="row-fluid notes-upload" id="note_attachment_group">
                                        
                                    </div>
                                </div>

                            <?php }?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="span12 view-notes-visible no-ml hide">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="pull-left day-slot-wrpr-header-left ">
                        <h1 style="padding-right: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['notes_detail'];?>
</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default pull-right ml" id="edit_btn" type="button" onclick="edit_note();"><i class='icon-pencil'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
</button>
                        <button class="btn btn-danger pull-right mr" id="delete_btn" type="button" onclick="delete_note();" ><i class='icon-trash' ></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                        <button class="" type="button" onclick="print_note()"><i class="icon-print"></i><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                        <form id="print_form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes_list/">
                            <input type="hidden" name="action_print" id="action_print" value="">
                            <input type="hidden" name="note_id" id="note_id" value="">
                            
                        </form>

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="row-fluid hide" id="view_note_content_wrpr"  style="overflow-x: auto;">
                        <table class="table table-white table-bordered table-hover table-responsive table-primary t" style="margin: 0px ! important; top: 0px; border-top: thin solid rgb(204, 204, 204);">
                            <tbody>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['writer'];?>
</td><td class="nt_writer"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</td><td class="nt_customer"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['title'];?>
</td><td class="nt_title"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['discription'];?>
</td><td class="nt_description" style="white-space: pre-wrap; overflow: hidden;display: block; "></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_written'];?>
</td><td class="nt_date"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['visibility'];?>
</td><td class="nt_visibility"></td>
                                </tr>
                                <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                                    <tr class="gradeX">
                                        <td><?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</td><td class="nt_status"></td>
                                    </tr>
                                <?php }?>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
</td>
                                    <td class="nt_attachment">
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                        <form name="details_form" id="details_form" method="post">
                            <input type="hidden" name="file_id" id="file_id" value="" />
                        </form>
                    <?php }?>
                    <input type="hidden" id="opened_note_id" value=""/>
                    <input type="hidden" id="opened_note_customer" value=""/>
                    <input type="hidden" id="opened_note_title" value=""/>
                    <input type="hidden" id="opened_note_description" value=""/>
                    <input type="hidden" id="opened_note_visibility" value=""/>
                    <div class="row-fluid notes-upload" style="margin: 10px 0px ! important;">
                        <div class="span6" style="margin: 0px ! important;">
                            <input style="" class="margin-none" type="file">
                        </div>
                        <div class="span6" style="margin: 0px ! important;">
                            <button class="btn btn-default span10 pull-right btn-remove-upload" style="text-align: center;" type="button">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid"> </div>
            <div class="row-fluid"><div class="span12"></div></div>
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
js/bootbox.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });

    $(document).on('keyup', "#search-section #cmb_month, #search-section #cmb_year, #search-section #cust_search_list, #search-section #txt_search_word", function(e) {
        
        var code = e.keyCode || e.which;
         if(code == 13) { //Enter keycode
            get_report();
         }
    });
    
    $(".btn-cancel-right").click(function() {
        close_right_panel();
        $('#table_list tr.note_row').removeClass('active');
        $('#table_list').removeClass('open-note-mode');
        $('#delete_btn,#edit_btn').show();
    });
    
    $(".book-open").click(function() {
        close_right_panel();
        // $('.sapn12 .main-left').width("50%");
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right .view-notes-visible").removeClass('hide');
        $(".main-right .view-notes-visible #view_note_content_wrpr").addClass('hide');

        var note_id = $(this).attr('data-id');
        var current_usr =$('#current_usr').val();
        $('#note_id').val(note_id);
        $(".view-notes-visible #opened_note_id").val('');
        wrapLoader(".main-right");
        $.ajax({
            async   :false,
            url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_note_actions.php",
            data    : { "note_id" : note_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    $('#delete_btn,#edit_btn').show();
                    // console.log(data);

                    if(data.notes_detail.editable == 1 || current_usr == data.notes_detail.created_user){
                        console.log(current_usr);
                        $('#delete_btn,#edit_btn').show();
                    }
                    else{
                        $('#delete_btn,#edit_btn').hide();
                    }
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        $(".main-right .view-notes-visible #view_note_content_wrpr").removeClass('hide');
                        
                        //hightlight opened-note from table list
                        $('#table_list').addClass('open-note-mode');
                        $('#table_list tr.note_row').removeClass('active');
                        $('#table_list tr#status_'+note_id).addClass('active');
                        
                        //remove unread indication * if exists
                        $('#table_list tr#status_'+note_id).find('.unread_indication').remove();
                        $('#table_list tr#status_'+note_id).removeClass('bolding_letters');
                        
                        $(".view-notes-visible #opened_note_id").val(note_id);
                        $(".view-notes-visible #opened_note_customer").val(data.notes_detail.cust_name);
                        $(".view-notes-visible #opened_note_title").val(data.notes_detail.title);
                        $(".view-notes-visible #opened_note_description").val(data.notes_detail.description);
                        $(".view-notes-visible #opened_note_visibility").val(data.notes_detail.visibility);
                        
                        $(".view-notes-visible #view_note_content_wrpr .nt_writer").html(data.notes_detail.emp_name);
                        $(".view-notes-visible #view_note_content_wrpr .nt_customer").html(data.customer_name);
                        $(".view-notes-visible #view_note_content_wrpr .nt_title").html(data.notes_detail.title);
                        $(".view-notes-visible #view_note_content_wrpr .nt_description").html(data.notes_detail.description);
                        $(".view-notes-visible #view_note_content_wrpr .nt_date").html(data.notes_detail.date);
                        
                        var note_visibility = '';
                        switch(data.notes_detail.visibility){
                            case '1': note_visibility = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>
'; break;
                            case '2': note_visibility = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['private'];?>
'; break;
                            case '3': note_visibility = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
'; break;
                            case '4': note_visibility = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only'];?>
'; break;
                        }
                        $(".view-notes-visible #view_note_content_wrpr .nt_visibility").html(note_visibility);
                        $(".view-notes-visible #view_note_content_wrpr .nt_date").html(data.notes_detail.date);
                        
                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
                            var note_status = '';
                            switch(data.notes_detail.status){
                                case '1': note_status = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['active'];?>
'; break;
                                case '0': note_status = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['forbidden'];?>
'; break;
                            }
                            $(".view-notes-visible #view_note_content_wrpr .nt_status").html(note_status);
                        <?php }?>
                        
                        if(data.attachment_arr.length > 0){
                            var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                    <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12">';
                            $.each(data.attachment_arr, function(i, value) {
                                new_attachment_html += '<li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?><i class="icon-trash pull-left cursor_hand delete_attachment" data-file-name="'+value.replace(/'/g, "\'")+'"></i><?php }?><span class="span11 ml"> <a href="javascript:window.location.href=\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/attachment/download/<?php echo $_SESSION['user_id'];?>
/'+value.replace(/'/g, "\'")+'/\'">'+value+'</a> </span></li>';
                            });
                            
                            new_attachment_html += '</ul>\n\
                                <div style="margin-top: 3px" class="span12">\n\
                                        <label><a href="javascript:window.location.href=\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/allattachment/download/<?php echo $_SESSION['user_id'];?>
/'+note_id+'/\'" style="float: left;margin-left: 5px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['download_all'];?>
</a></label>\n\
                                </div>';
                            $(".view-notes-visible #view_note_content_wrpr .nt_attachment").html(new_attachment_html);
                        }
                        else
                            $(".view-notes-visible #view_note_content_wrpr .nt_attachment").html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_attachment'];?>
');
                        
                    }

                    if(data.message !== 'undefined' && data.message != ''){
                        $('#right_message_wraper').html(data.message);
                    }
            }
        }).always(function(data) { 
            uwrapLoader(".main-right");
        });
    });
    
    $('.btn-addnew-notes').click(function(){
        close_right_panel();
        $('#table_list').removeClass('open-note-mode');
        $('#table_list tr.note_row').removeClass('active');
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right .addnew-notes-box").removeClass('hide');
		
				  $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
				
				
        
        $('.addnew-notes-box #edit_note_id, .addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
        <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
            $('.addnew-notes-box #note_attachment_group').html('');
        <?php }?>
        
        $('.addnew-notes-box .widget-header .note_process_action').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_notes'];?>
');
    });
    
    <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
        $('.addnew-notes-box #btn_add_attachment').click(function(e){
            $('.addnew-notes-box #note_attachment_group').append('<div class="span12 no-ml attachment_row">\n\
                                                <button class="btn btn-default pull-left span1 btn_attachment_remove" style="text-align: center;" type="button"><i class="icon-trash"></i></button>\n\
                                                <div class="pull-left span11 no-ml" style=""><input type="file" name="attachments[]" class="note_attach_file margin-none"></div></div>');
            e.preventDefault();
        });
        
        $(document).on('click', ".btn_attachment_remove", function(e) {
            $(this).parents('.attachment_row').remove();
            e.preventDefault();
        });
    <?php }?>
    
    $(document).on('click', ".delete_attachment", function(e) {
        if (confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
")) {
            $('#right_message_wraper').html();
            var file_name = $(this).attr('data-file-name');
            if(file_name != ''){
                var note_id = $(".view-notes-visible #opened_note_id").val();
                var this_obj = this;
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_note_actions.php",
                    data    : { "note_id": note_id, 'action': 'delete_note_attachment', 'file_id': file_name },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);
                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $(this_obj).parent('li.list-group-item').remove();
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#right_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-right");
                });
            }
        }
        e.preventDefault();
    });
    
    $('input[name=save_type]').change(function(){
        $(this).attr('checked', 'checked');
        $(this).prop('checked', 'checked');
    });

    $(document).ready(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
    });
});

$(function() {
    var search_customers = [
            <?php  $_smarty_tpl->tpl_vars['cust'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cust']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_cust_array']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cust']->key => $_smarty_tpl->tpl_vars['cust']->value){
$_smarty_tpl->tpl_vars['cust']->_loop = true;
?>
                    {
                    value: "<?php echo $_smarty_tpl->tpl_vars['cust']->value['cID'];?>
",
                    label: "<?php echo $_smarty_tpl->tpl_vars['cust']->value['cName'];?>
"
                    },
            <?php } ?>
    ];
    $( "#cust_search_list" ).autocomplete({
        minLength: 0,
        source: search_customers,
        focus: function( event, ui ) {
                    $( "#cust_search_list" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;

                    $("#cust_selected").val(sel_value);
                    $("#cust_search_list").val(sel_label);
                    return false;
                }
    })/*
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    }*/;

});

$(function() { // auto_complete for authers.
    var authers = [
        <?php  $_smarty_tpl->tpl_vars['emp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['emp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['emp']->key => $_smarty_tpl->tpl_vars['emp']->value){
$_smarty_tpl->tpl_vars['emp']->_loop = true;
?>
            {
            value: "<?php echo $_smarty_tpl->tpl_vars['emp']->value['username'];?>
",
            label: <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?> "<?php echo $_smarty_tpl->tpl_vars['emp']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['emp']->value['last_name'];?>
" <?php }else{ ?> "<?php echo $_smarty_tpl->tpl_vars['emp']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['emp']->value['first_name'];?>
" <?php }?>
            },
        <?php } ?>
    ];
    $( "#txt_auther_search" ).autocomplete({
        source: authers,
        focus: function( event, ui ) {
                    $( "#txt_auther_search" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;

                    $("#emp_user_id").val(sel_value);
                    $("#txt_auther_search").val(sel_label);
                    return false;
        }
    });
});

function get_report(){

    var year        = $('#cmb_year').val();
    var month       = $('#cmb_month').val();
    var cust        = $('#cust_selected').val();
    var cust_name   = $('#cust_search_list').val();
    var emp_user_id = $('#emp_user_id').val();
    var emp_name    = $('#txt_auther_search').val();
    var date        = $('#datepicker').val();
    //double encode is used for escaping auto decoding this query param in php (avoid & param exploading)
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));


    if(date == '' ) date = 'NULL';
    if(year == '') year = 'NULL';
    if(month == '') month = 'NULL';
    if(cust == '' || cust_name == '' || typeof cust == 'undefined' || typeof cust_name == 'undefined') cust = 'NULL';
    if(emp_user_id == '' || emp_name == '' || typeof emp_user_id == 'undefined' || typeof emp_name == 'undefined') emp_user_id = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/list/'+month+'/'+year+'/'+cust+'/'+search_text+'/'+emp_user_id+'/'+date+'/';
}

function mark_all_read(){
    var year        = $('#cmb_year').val();
    var month       = $('#cmb_month').val();
    var cust        = $('#cust_selected').val();
    var cust_name   = $('#cust_search_list').val();
    var emp_user_id = $('#emp_user_id').val();
    var emp_name    = $('#txt_auther_search').val();
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));
    var date        = $('#datepicker').val();

    if(date == '' ) date = 'NULL';
    if(emp_user_id == '' || emp_name == '' || typeof emp_user_id == 'undefined' || typeof emp_name == 'undefined') emp_user_id = 'NULL';
    if(year == '') year = 'NULL';
    if(month == '') month = 'NULL';
    if(cust == '' || cust_name == '' || typeof cust == 'undefined' || typeof cust_name == 'undefined') cust = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/list/'+month+'/'+year+'/'+cust+'/'+search_text+'/'+emp_user_id+'/'+date+'/read/';

}

function set_status(status,id){
    $.ajax({
        async:false,
        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_update_notes_status.php",
        data:"id="+id+"&status="+status,
        type:"POST",
        success:function(data){
                $("#table_list tr#status_"+id).children("td:eq(9)").remove();
                $("#table_list tr#status_"+id).children("td:eq(8)").remove();
                $("#table_list tr#status_"+id).append(data);
                if(status == 1)
                    $("#table_list tr#status_"+id).removeClass('notes-highlight').addClass('col-highlight-primary');
                else
                    $("#table_list tr#status_"+id).removeClass('col-highlight-primary').addClass('notes-highlight');
        }
    });
}

function close_right_panel(){
    $('#main_container').removeClass('show_main_right');
    $(".main-right, .main-right .addnew-notes-box, .main-right .view-notes-visible").addClass('hide');
    $('.main-right #right_message_wraper').html('');
}

<?php if ($_smarty_tpl->tpl_vars['user_role']->value==1){?>
    function delete_note(note_id) {
        if (confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['sure_to_delete_note_data'];?>
")) {
            //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
notes/detail/" + note_id + "/delete/";
            
            $('#right_message_wraper').html('');
            var note_id = $(".view-notes-visible #opened_note_id").val();
            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_note_actions.php",
                data    : { "note_id" : note_id, 'action': 'delete' },
                dataType: 'json',
                type    :"POST",
                success:function(data){
                        //console.log(data);
                        if(data.transaction_flag !== undefined && data.transaction_flag){
                            close_right_panel();
                            $(".view-notes-visible #opened_note_id").val('');
                            
                            $('#table_list tr#status_'+note_id).remove();
                            renumbering_notes_table();
                        }

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
        }
    }
    
    function edit_note(){
        close_right_panel();
        var note_id = $(".view-notes-visible #opened_note_id").val();
        if(note_id == ''){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_note'];?>
', function(result){ });
        }else {
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right .addnew-notes-box").removeClass('hide');
            $('.addnew-notes-box .widget-header .note_process_action').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit_note'];?>
');
        
            var note_customer   = $(".view-notes-visible #opened_note_customer").val();
            var note_title      = $(".view-notes-visible #opened_note_title").val();
            var note_description= $(".view-notes-visible #opened_note_description").val();
            var note_visibility = $(".view-notes-visible #opened_note_visibility").val();
        
            $('.addnew-notes-box #edit_note_id').val(note_id);
            $('.addnew-notes-box #cmb_customer').val(note_customer);
            $('.addnew-notes-box #save_title').val(note_title);
            $('.addnew-notes-box #save_description').val(note_description);
            <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
                $('.addnew-notes-box #note_attachment_group').html('');
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['user_role']->value!='3'){?> 
                switch(note_visibility){
                    case '1': $('.addnew-notes-box .note_visibility_options #radio3').parent('label').trigger('click'); break;
                    case '2': $('.addnew-notes-box .note_visibility_options #radio1').parent('label').trigger('click'); break;
                    case '4': $('.addnew-notes-box .note_visibility_options #radio4').parent('label').trigger('click'); break;
                }
            <?php }?>
        }
    }
<?php }?>

function reload_content(){
    window.location.href = '<?php echo $_smarty_tpl->tpl_vars['current_url']->value;?>
';
}

function renumbering_notes_table(){
    var count = 0;
    var record_base_no = parseInt('<?php echo $_smarty_tpl->tpl_vars['this_page_no']->value*$_smarty_tpl->tpl_vars['per_page']->value;?>
');
    $( "table#table_list tr.note_row" ).each(function( index, element ) {
        count++;
        var row_record_no = parseInt(record_base_no + count);
        $(this).find('td.note_number').html(row_record_no);
    });
}

function save_note(){

    $('#right_message_wraper').html('');
    var edit_note_id= $('.addnew-notes-box #edit_note_id').val();
    var customer    = $.trim($('.addnew-notes-box #cmb_customer').val());
    var title       = $.trim($('.addnew-notes-box #save_title').val());
    var description = $.trim($('.addnew-notes-box #save_description').val());
    var visibility  = $('.addnew-notes-box .note_visibility_options input:radio[name=save_type]:checked').val();
    
    /*var process_data = {
        'action'    : 'create',
        'customer'  : customer,
        'title'     : title,
        'description': description,
        'visibility': visibility,
        'attachments': []
    };*/

    var proceed_flag = true;
    
    if(title == ''){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_note_title'];?>
', function(result){ });
        $('.addnew-notes-box #save_title').focus();
        proceed_flag = false;
    }
    else if(description == ''){
        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_note_description'];?>
', function(result){ });
        $('.addnew-notes-box #save_description').focus();
        proceed_flag = false;
    }
    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!='3'){?>
        if(proceed_flag){
            if(typeof visibility === 'undefined' || visibility == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_a_note_visibility_type'];?>
', function(result){ });
                proceed_flag = false;
            }
            else if(visibility == '2' && customer == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_note_customer'];?>
', function(result){ });
                $('.addnew-notes-box #cmb_customer').focus();
                proceed_flag = false;
            }
        }
    <?php }?>

    if(proceed_flag){
        var form_data = new FormData();  
        var editable = '';
        $('#editable').is(':checked') ? editable = 1 : editable = 0;
        form_data.append('action', 'create');
        form_data.append('customer', customer);
        form_data.append('title', title);
        form_data.append('description', description);
        form_data.append('visibility', visibility);
        form_data.append('status', '');
        form_data.append('editable', editable);

        if(edit_note_id != ''){
            form_data.append('note_id', edit_note_id);
            form_data.append('action', 'update');
        } else
            form_data.append('action', 'create');
        
        $( ".addnew-notes-box .note_attach_file" ).each(function( index, element ) {
            if($(this).val() != ''){
                var file_data = $(this).prop('files')[0];   
                //process_data.attachments.push(file_data);
                form_data.append('attachment[]', file_data);
            }
        });
        //console.log(form_data);
        //console.log(process_data);


        //return false;
        wrapLoader(".main-right");
        $.ajax({
            async   :false,
            url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_note_actions.php",
            data    : form_data,
            dataType: 'json',
            type    :"POST",
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success:function(data){
                    console.log(data);
                    if(edit_note_id == ''){
                        reload_content();
                        $('.addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
                    }
                    
                    <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
                        $('.addnew-notes-box #note_attachment_group').html('');
                    <?php }?>
                        
                    //updated notedetails shows on table
                    if(edit_note_id != '' && typeof data.notes_detail !== 'undefined'){
                        $('#table_list tr#status_'+edit_note_id).find('.entry-customer').html(data.customer_name);
                        $('#table_list tr#status_'+edit_note_id).find('.entry-title').html(data.notes_detail.title);
                        $('#table_list tr#status_'+edit_note_id).find('.entry-description').html(data.notes_detail.description);
                        
                        var visibility_name = '';
                        switch(data.notes_detail.visibility){
                            case '1' : visibility_name = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['public'];?>
'; break;
                            case '2' : visibility_name = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['private'];?>
'; break;
                            case '3' : visibility_name = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
'; break;
                            case '4' : visibility_name = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['admin_only'];?>
'; break;
                        }
                        $('#table_list tr#status_'+edit_note_id).find('.entry-visibility').html(visibility_name);
                        
                        if(data.attachment_arr.length > 0){
                            $('#table_list tr#status_'+edit_note_id).find('.entry-attachment-indication').html('<span title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
"><i class="icon-paper-clip icon-large"></i></span>');
                        }
                    }

                    if(data.message !== 'undefined' && data.message != ''){
                        $('#right_message_wraper').html(data.message);
                    }
            }
        }).always(function(data) { 
            uwrapLoader(".main-right");
        });
    }
}

function refresh_note_edit(){
    $('.addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
    <?php if (($_smarty_tpl->tpl_vars['user_role']->value=='1')||($_smarty_tpl->tpl_vars['user_role']->value=='3'&&$_smarty_tpl->tpl_vars['attachment_add_permission']->value==1)){?> 
        $('.addnew-notes-box #note_attachment_group').html('');
    <?php }?>
}

function print_note(){
    $('#action_print').val('print');
    $('#print_form').attr('target', '_BLANK');
    $('#print_form').submit();
}
</script>

    </body>
</html><?php }} ?>