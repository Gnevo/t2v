<?php /* Smarty version Smarty-3.1.8, created on 2020-12-25 08:04:10
         compiled from "/home/time2view/public_html/cirrus/templates/forms/form_4.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15491889245fe59cfa42f696-23790918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b41c8bf4f62160a167f738599d069810e3bc3533' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/forms/form_4.tpl',
      1 => 1539176062,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15491889245fe59cfa42f696-23790918',
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
  'unifunc' => 'content_5fe59cfac37ca1_43501375',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fe59cfac37ca1_43501375')) {function content_5fe59cfac37ca1_43501375($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
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
css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/jquery-editable.css" />

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
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
<div id="error_error" style="color: white;"></div></div>
            <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['form_4'];?>

                            <ul class="pull-right">
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="customer" name="customer">
                                            <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['customerid']->value==$_smarty_tpl->tpl_vars['customer']->value['username']){?>selected<?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['customer']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer']->value['last_name']);?>
<?php }else{ ?><?php echo (($_smarty_tpl->tpl_vars['customer']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer']->value['first_name']);?>
<?php }?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="review" name="review" onchange="selectReview()">
                                            <option data-group="0" value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_review'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['form_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form_datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form_data']->key => $_smarty_tpl->tpl_vars['form_data']->value){
$_smarty_tpl->tpl_vars['form_data']->_loop = true;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['customerid']->value==$_smarty_tpl->tpl_vars['form_data']->value['customer']){?>
                                                    <option data-group="<?php echo $_smarty_tpl->tpl_vars['form_data']->value['customer'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['form_data']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['reviewid']->value==$_smarty_tpl->tpl_vars['form_data']->value['id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['form_data']->value['created_date'];?>
</option>
                                                <?php }?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <!--<li><i class="icon-plus"></i><a href="javascript:void(0);" onclick="addNew()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</span></a></li>-->
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer_forms.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a></li>
                                <li><i class="icon-refresh"></i><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</span></a></li>
                                <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</span></a></li>
                                <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="downloadForm()"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a></li>
                            </ul>
                        </h4>
                    </div>
                </div>
                <div id="forms_container" class="span12 no-ml">
                    <div id="samsida_hold" style="overflow:auto; background-color: #FFFFFF;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Genomförandeplan - myndig</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <th colspan="6">Uppgift om uppdragsgivaren</th>
                                        </tr>
                                        <tr>
                                            <td>Datum för upprättandet av GP:</td>
                                            <td colspan="3"><?php if ($_smarty_tpl->tpl_vars['review_data']->value){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['created_date'];?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %T");?>
<?php }?></td>
                                            <td class="center">R</td>
                                            <td class="center">S</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Fullständigt namn:</td>
                                            <td width="25%"><input type="text" class="span12" name="fullname" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['fullname']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['fullname'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['last_name'];?>
<?php }?>" /></td>
                                            <td width="15%">Personnummer:</td>
                                            <td width="25%"><input type="text" class="span11" name="social_security" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['social_security']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['social_security'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['century'];?>
<?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['social_security'];?>
<?php }?>" /></td>
                                            <td width="5%" class="center"><input type="checkbox" name="check_r" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['check_r']){?>checked="true"<?php }?> /></td>
                                            <td width="5%" class="center"><input type="checkbox" name="check_s" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['check_s']){?>checked="true"<?php }?> /></td>
                                        </tr>
                                        <tr>
                                            <td>Fullständig adress:</td>
                                            <td colspan="5"><input type="text" class="span12" name="address" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['address']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['address'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['address'];?>
<?php }?>" /></td>
                                        </tr>
                                        <tr>
                                            <td>E-post :</td>
                                            <td><input type="text" class="span12" name="email" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['email']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['email'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['email'];?>
<?php }?>" /></td>
                                            <td>Telefon/Mobil:</td>
                                            <td colspan="3"><input type="text" class="span12" name="phone" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['phone']){?><?php if (substr($_smarty_tpl->tpl_vars['review_data']->value['phone'],0,1)!='0'){?>0<?php echo $_smarty_tpl->tpl_vars['review_data']->value['phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['phone'];?>
<?php }?><?php }else{ ?><?php if (substr($_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['phone'],0,1)!='0'){?>0<?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['customers']->value[$_smarty_tpl->tpl_vars['customerid']->value]['phone'];?>
<?php }?><?php }?>" /></td>
                                        </tr>
                                        <tr>
                                            <td>Önskemål angående kontakter</td>
                                            <td colspan="5"><input type="text" class="span12" name="onskemal_angaende_kontakter" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['onskemal_angaende_kontakter'];?>
" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td></td>
                                            <td class="center">Ny uppdragsgivare</td>
                                            <td class="center">Uppföljning</td>
                                            <td class="center">Förändring</td>
                                            <td class="center">Schemalagd</td>
                                        </tr>
                                        <tr>
                                            <td>Orsak till GP</td>
                                            <td class="center"><input type="checkbox" name="ny_uppdragsgivare" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['ny_uppdragsgivare']){?>checked="true"<?php }?> /></td>
                                            <td class="center"><input type="checkbox" name="uppfoljning" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['uppfoljning']){?>checked="true"<?php }?> /></td>
                                            <td class="center"><input type="checkbox" name="forandring" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['forandring']){?>checked="true"<?php }?> /></td>
                                            <td class="center"><input type="checkbox" name="schemalagd" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['schemalagd']){?>checked="true"<?php }?> /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="center">&nbsp;Ja</td>
                                            <td class="center">&nbsp;Nej</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Samtycker till genomförandeplan</td>
                                            <td class="center"><input type="radio" name="samtycker_till_genomforandeplan" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['samtycker_till_genomforandeplan']){?>checked="true"<?php }?> style="float: none;" /></td>
                                            <td class="center"><input type="radio" name="samtycker_till_genomforandeplan" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['samtycker_till_genomforandeplan']==0&&$_smarty_tpl->tpl_vars['review_data']->value['samtycker_till_genomforandeplan']!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <div class="employee_details_inner clearfix">
                            <div class="list_contnts clearfix">
                                <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
                                    <div id="employee_block" name="employee_block" style="border:solid 1px #8fc6d3;" class="clearfix"><!--collaps this fold-->
                                        <div class="entity_list list clearfix">
                                            <div class="span12"><h5><?php echo utf8_encode($_smarty_tpl->tpl_vars['group']->value['name']);?>
</h5></div>
                                        </div>
                                        <div  class="listed_details" style="display:none;height:auto;">
                                            <div class="tidsredov_block clearfix">
                                                <div class="ar_block clearfix span12">
                                                    <div class="anställd_block span12 no-ml">
                                                        <?php if ($_smarty_tpl->tpl_vars['group']->value['caption']){?><div class="span12"><h6><?php echo utf8_encode($_smarty_tpl->tpl_vars['group']->value['caption']);?>
</h6></div><?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==1){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td colspan="4"></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2">Om Ja</td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][6]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][7]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2">Om Ja</td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][9]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][11]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][10]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][12]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][13]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][13]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][13]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==2){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][6]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][7]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][9]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==3){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==4){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <th colspan="4" class="left">Försäkringskassa</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <th colspan="4" class="left">Kommun</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][6]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][7]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][9]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==5){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==6){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][0]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][1]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][1]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][2]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][2]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][3]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][3]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][4]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][4]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][5]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][5]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][6]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][6]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][7]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][7]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][8]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][8]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][9]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][9]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][10]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][10]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][11]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][11]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][12]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][12]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][13]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][13]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][14]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][14]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][14]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][14]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][14]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][15]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][15]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][15]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][15]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][15]['id']];?>
" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][16]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][16]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][16]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][16]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][16]['id']];?>
" /></td>
                                                                    <td>
                                                                        <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                            <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][17]['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][17]['name'];?>
</a>
                                                                        <?php }else{ ?>
                                                                            <?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][17]['name'];?>

                                                                        <?php }?>
                                                                    </td>
                                                                    <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['group']->value['fields'][17]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['group']->value['fields'][17]['id']];?>
" /></td>
                                                                </tr>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==7){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                            <textarea name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']]){?>
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;"><?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']];?>
</pre>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }?>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==8){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                            <textarea name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']]){?>
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;"><?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']];?>
</pre>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }?>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==9){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                            <textarea name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']]){?>
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;"><?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field']->value['id']];?>
</pre>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }?>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==11){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]){?>checked="true"<?php }?> style="float: none;" style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]!=''){?>checked="true"<?php }?> style="float: none;" style="float: none;" /></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==12){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]){?>checked="true"<?php }?> style="float: none;" style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]!=''){?>checked="true"<?php }?> style="float: none;" style="float: none;" /></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==13){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                        </td>
                                                                        <td><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value];?>
" /></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==14){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;1a hand</td>
                                                                    <td class="center">&nbsp;2a hand</td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="2" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==2){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="3" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==3){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==1){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['group_id']->value==15){?>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['key_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['key_id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php if ($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6){?>
                                                                                <a href="#" data-type="text" data-pk="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="labelval editable editable-click" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</a>
                                                                            <?php }else{ ?>
                                                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>

                                                                            <?php }?>
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]==0&&$_smarty_tpl->tpl_vars['review_data']->value['answers'][$_smarty_tpl->tpl_vars['field_id']->value]!=''){?>checked="true"<?php }?> style="float: none;" /></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Planerad uppföljning av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td></td>
                                            <td class="center">Bokad</td>
                                            <td class="center">Genomförd</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Datum för uppföljning:</td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_uppfoljning_bokad" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['datum_for_uppfoljning_bokad'];?>
" /></td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_uppfoljning_genomford" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['datum_for_uppfoljning_genomford'];?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Datum för ordinarie:</td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_ordinarie_bokad" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['datum_for_ordinarie_bokad'];?>
" /></td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_ordinarie_genomford" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['datum_for_ordinarie_genomford'];?>
" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                             <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Datum för upprättandet av GP</td>
                                            <td><input type="text" class="span6 datepicker required" name="datum_for_upprattandet_av_gp" id="datum_for_upprattandet_av_gp" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['datum_for_upprattandet_av_gp']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['datum_for_upprattandet_av_gp'];?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
<?php }?>" required="true" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Deltagare vid upprättandet av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Namn</td>
                                            <td>Befattning / Roll</td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name1" id="deltagare_vid_upprattandet_av_gp_name1" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name1']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name1'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['user_fullname']->value;?>
<?php }?>" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll1" id="deltagare_vid_upprattandet_av_gp_roll1" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll1']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll1'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['user_rolename']->value;?>
<?php }?>" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name2'];?>
" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll2'];?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name3'];?>
" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll3" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll3'];?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name4" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name4'];?>
" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll4" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll4'];?>
" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name5" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_name5'];?>
" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll5" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['deltagare_vid_upprattandet_av_gp_roll5'];?>
" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Godkännande av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="25%">Dagens datum</td>
                                            <td width="25%">Befattning / Roll</td>
                                            <td width="25%">Namnförtydligande</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="span12 datepicker" name="dagens_datum_1" id="dagens_datum_1" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['dagens_datum_1']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['dagens_datum_1'];?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
<?php }?>" /></td>
                                            <td><input type="text" class="span12" name="befattning_roll_1" id="befattning_roll_1" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['befattning_roll_1']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['befattning_roll_1'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['user_rolename']->value;?>
<?php }?>" /></td>
                                            <td><input type="text" class="span12" name="namnfortydligande_1" id="namnfortydligande_1" value="<?php if ($_smarty_tpl->tpl_vars['review_data']->value['namnfortydligande_1']){?><?php echo $_smarty_tpl->tpl_vars['review_data']->value['namnfortydligande_1'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['user_fullname']->value;?>
<?php }?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="span12 datepicker" name="dagens_datum_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['dagens_datum_2'];?>
" /></td>
                                            <td><input type="text" class="span12" name="befattning_roll_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['befattning_roll_2'];?>
" /></td>
                                            <td><input type="text" class="span12" name="namnfortydligande_2" value="<?php echo $_smarty_tpl->tpl_vars['review_data']->value['namnfortydligande_2'];?>
" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-top: 25px" class="span12 no-ml mb">
                                        <button class="btn btn-primary mr" onclick="saveForm();" type="button"><i class="icon-save"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
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
js/jquery-1.10.1.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-ui-1.10.3.custom.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.poshytip.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-editable-poshytip.js"></script>
<script>
$.fn.editable.defaults.url = 'form_4_update_label.php';
$.fn.editable.defaults.mode = 'inline';
$(function(){
    $('.labelval').editable({
        validate: function(value) {
            if($.trim(value) == '') return 'Value shoud not empty'; 
        }
    });
});
</script>
<script type="text/javascript">
    
    $(document).ready(function(){
        var sel_customer = '<?php echo $_smarty_tpl->tpl_vars['customerid']->value;?>
';
        if($(window).height() > 400){
            $('#samsida_hold').css({ height: $(window).height()-109}); 
            $('#form_data').css({ height: $(window).height()-50});
        } else {
            $('#samsida_hold').css({ height: $(window).height()});
            $('#form_data').css({ height: $(window).height()});  
        }

        $(window).resize(function(){
           if($(window).height() > 400){
                $('#samsida_hold').css({ height: $(window).height()-109}); 
                $('#form_data').css({ height: $(window).height()-50});
           } else {
                $('#samsida_hold').css({ height: $(window).height()});
                $('#form_data').css({ height: $(window).height()});  
           }
        });  

        $(".list").click(function() {
            var thisparent = $(this).parent().children(".listed_details");
            $(".listed_details").slideUp("slow");
            if (thisparent.css("display") == 'none'){
                thisparent.slideToggle("slow");
            }
        });


        $("#customer").change(function() {
            var customer_id = $(this).val();
            if(customer_id != "" && customer_id != 0){
                document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php?customer=' + customer_id;
            }
        });

        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
    });
    
    
function saveForm(){
    var error = 0;
    var errors = 0;
    var customer = document.getElementById("customer").value;
    var datum_for_upprattandet_av_gp = $('#datum_for_upprattandet_av_gp').val();
    var deltagare_vid_upprattandet_av_gp_name1 = $('#deltagare_vid_upprattandet_av_gp_name1').val();
    var deltagare_vid_upprattandet_av_gp_roll1 = $('#deltagare_vid_upprattandet_av_gp_roll1').val();
    var dagens_datum_1 = $('#dagens_datum_1').val();
    var befattning_roll_1 = $('#befattning_roll_1').val();
    var namnfortydligande_1 = $('#namnfortydligande_1').val();
    if (customer == 0){
        $("#customer").addClass("error");
        error = 1;
    }
    if (datum_for_upprattandet_av_gp == ""){
        $("#datum_for_upprattandet_av_gp").addClass("error");
        error = 1;
    }
    if (deltagare_vid_upprattandet_av_gp_name1 == ""){
        $("#deltagare_vid_upprattandet_av_gp_name1").addClass("error");
        error = 1;
    }
    if (deltagare_vid_upprattandet_av_gp_roll1 == ""){
        $("#deltagare_vid_upprattandet_av_gp_roll1").addClass("error");
        error = 1;
    }
    if (dagens_datum_1 == ""){
        $("#dagens_datum_1").addClass("error");
        error = 1;
    }
    if (befattning_roll_1 == ""){
        $("#befattning_roll_1").addClass("error");
        error = 1;
    }
    if (namnfortydligande_1 == ""){
        $("#namnfortydligande_1").addClass("error");
        error = 1;
    }
    if(error < 1){ 
        $('#action').val('save');
        $("#forms").submit();
    } else {
        if(error != 0){
            $("#error_error").addClass('message');
            $("#error_error").html("<?php echo $_smarty_tpl->tpl_vars['translate']->value['required_missing'];?>
");
        }
    }
}

function downloadForm(){
    $('#action').val('pdf');
    $("#forms").submit();
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php?review=' + reviewid +'&customer=' + customer;
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php?customer=' + customerid;
    }
}
</script>


    </body>
</html><?php }} ?>