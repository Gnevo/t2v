<?php /* Smarty version Smarty-3.1.8, created on 2021-02-17 11:20:14
         compiled from "/home/time2view/public_html/cirrus/templates/survey/manage_survey.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1014037320602cfbee185d76-88916497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fa51a5eff4053104ed70d5106bbbdfc5ad257e6' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/survey/manage_survey.tpl',
      1 => 1427690804,
      2 => 'file',
    ),
    '43e50b5820fd158471ea856061485ae5df826e63' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/survey/surveys_manage_sub_layout.tpl',
      1 => 1435212158,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1014037320602cfbee185d76-88916497',
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
  'unifunc' => 'content_602cfbee4709f5_24573139',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602cfbee4709f5_24573139')) {function content_602cfbee4709f5_24573139($_smarty_tpl) {?><!DOCTYPE html>
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
css/survey.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
       
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
            <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <div style="margin: 15px 0px 0px;" class="widget-header span12 no-ml">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['manage_survey'];?>
</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
surveys/';" class="btn btn-default btn-normal span2 pull-right" type="button"><i class="icon-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div style="margin: 0px;" class="widget widget-tabs widget-tabs-double">
                    <div class="widget-head widget-head-survey-tab">
                        <ul>
                            <li class="step-one <?php if ($_smarty_tpl->tpl_vars['survey_tab']->value==1){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/questions/list/"><div class="survey-tab-icon survey-tab-managequstions"></div><div class="survey-step-info"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['step'];?>
 1</h1> <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['manage_questions'];?>
</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/questions/';" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</button></a></li>
                            <li class="step-two <?php if ($_smarty_tpl->tpl_vars['survey_tab']->value==2){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/forms/list/"><div class="survey-tab-icon survey-tab-manageforms"></div><div class="survey-step-info"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['step'];?>
 2</h1> <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['manage_forms'];?>
</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/forms/';" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</button></a></li>
                            <li class="step-three <?php if ($_smarty_tpl->tpl_vars['survey_tab']->value==3){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/list/"><div class="survey-tab-icon survey-tab-managesurveys"></div><div class="survey-step-info"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['step'];?>
 3</h1> <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['manage_surveys'];?>
</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/';" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</button></a></li>
                            <li class="step-four <?php if ($_smarty_tpl->tpl_vars['survey_tab']->value==4){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/groups/list/"><div class="survey-tab-icon survey-tab-managegroups"></div><div class="survey-step-info"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['step'];?>
 4</h1> <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['manage_groups'];?>
</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/groups/';" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</button></a></li>
                            <li class="step-five <?php if ($_smarty_tpl->tpl_vars['survey_tab']->value==5){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/invitations/list/"><div class="survey-tab-icon survey-tab-manageinvitation"></div><div class="survey-step-info"><h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['step'];?>
 5</h1> <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['invitation'];?>
</p></div><button class="btn btn-default btn-normal pull-right add-new-survey" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/invitations/';" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</button></a></li>
                        </ul>
                    </div>

                    <div class="widget-body no-padding">
                        <div class="tab-content">
                            
    <div id="tab3-2" class="tab-pane active">
        <div class="row-fluid">
            <div class="span12 widget-body-section input-group" id="tab-working-panel">

                <?php if ($_smarty_tpl->tpl_vars['display_page']->value!='list'){?>
                    <div class="span12">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['forms'];?>
</h1>
                                    </div>
                                    <div class="pull-right" style="padding: 5px;">
                                        <button class="btn btn-info pull-right" onclick="addFormToSurvey();" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_to_survey'];?>
</button>
                                    </div>
                                </div>
                                <div class="span12 padding-set" id="forms_section">
                                    <div class="span12">
                                        <label style="float: left;" class="span12" for="search_box_forms"><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_forms'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_forms'];?>
" id="search_box_forms" type="text"  oninput="displayForms()"  onemptied="displayForms()" /> 
                                        </div>
                                        <div tabindex="0" id="draggable-forms" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;">
                                            <?php  $_smarty_tpl->tpl_vars['form'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form']->key => $_smarty_tpl->tpl_vars['form']->value){
$_smarty_tpl->tpl_vars['form']->_loop = true;
?>
                                                <div class="span12 answer-tool draggable-form">
                                                    <input name="form_id" class="form_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" />
                                                    <div class="span12 answer-tool-right no-ml">
                                                        <div class="span2"><div class="survey-quation-input-types-form"></div></div>
                                                        <div class="span10 edit-form-label"><input name="check_<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" id="check_<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
" class="pull-right span1" /><label class="form_title_data"><?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
</label></div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/';"  type="button"><i class='icon-plus'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['new_survey'];?>
</button>
                                        <?php if ($_smarty_tpl->tpl_vars['status']->value!=0){?>
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveSurvey(1)" type="button"><i class='icon-save'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveSurvey(0)" type="button"><i class='icon-save'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_finalaise'];?>
</button>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['survey_id']->value!=''){?><button class="btn btn-default btn-normal pull-right" onClick="deleteSurvey()" type="button"><i class='icon-trash'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</button><?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['status']->value==0){?><button class="btn btn-default btn-normal pull-right" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/<?php echo $_smarty_tpl->tpl_vars['survey_id']->value;?>
/new_version/';" type="button"><i class='icon-copy'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['new_version'];?>
</button><?php }?>
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">

                                    <div class="widget" style="margin-top:0;">
                                        <form name="form_survey" id="form_survey" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/<?php echo $_smarty_tpl->tpl_vars['survey_id']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['version']->value=='1'){?>new_version/<?php }?>">
                                            <input type="hidden" id="action" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"/>
                                            <input type="hidden" id="finalise" name="finalise" value=""/>
                                            <input type="hidden" id="survey_id" name="survey_id" value="<?php echo $_smarty_tpl->tpl_vars['survey_id']->value;?>
"/>
                                            <input type="hidden" id="forms_selected" name="forms_selected"/>
                                            <input type="hidden" id="forms_order" name="forms_order"/>
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="survey_title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['survey_name'];?>
</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['survey_name'];?>
" id="survey_title" name="survey_title" type="text" value="<?php echo $_smarty_tpl->tpl_vars['selected_survey']->value['survey_title'];?>
" /> 
                                                    </div>
                                                </div>

                                                <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                    <label style="float: left;" class="span12" for="survey_discription"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
</label>
                                                    <textarea id="survey_discription" name="survey_discription" style="margin: 0px;" class="form-control span12" rows="1" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
"><?php echo $_smarty_tpl->tpl_vars['selected_survey']->value['description'];?>
</textarea>
                                                </div>

                                                <div style="margin: 5px 0px 0px ! important;" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="expire_date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['expiry_date'];?>
</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12 datepicker"> 
                                                        <span class="add-on icon icon-calendar"></span>
                                                        <input class="form-control span10" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['expiry_date'];?>
" name="expire_date" id="expire_date" type="text" value="<?php if ($_smarty_tpl->tpl_vars['selected_survey']->value['expire_date']!=''){?><?php echo $_smarty_tpl->tpl_vars['selected_survey']->value['expire_date'];?>
<?php }?>" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height"><?php echo $_smarty_tpl->tpl_vars['translate']->value['drag_drop_forms'];?>
</div>
                                                <div class="span12 dragdrop-box no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    <input type="hidden" name="hidden_survey_ids" id="hidden_survey_ids" value="<?php echo $_smarty_tpl->tpl_vars['hidden_form_ids']->value;?>
"/>
                                                    <?php  $_smarty_tpl->tpl_vars['form'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['survey_forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form']->key => $_smarty_tpl->tpl_vars['form']->value){
$_smarty_tpl->tpl_vars['form']->_loop = true;
?>
                                                        <div class="span12 no-ml selected_form_wrpr drop-zone mb">
                                                            <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>
                                                            <div class="span11 no-min-height text-left" style="margin:0;">
                                                                <span class="form_title_data"><?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
</span>
                                                                <span class="label label-info pull-right cursor_hand" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/forms/<?php echo $_smarty_tpl->tpl_vars['form']->value['form_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['survey_id']->value;?>
/';"><?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_form'];?>
</span>
                                                                <input type='hidden' class="form_id" name='survey_ids[]' id='survey_ids[]' value='<?php echo $_smarty_tpl->tpl_vars['form']->value['form_id'];?>
' />
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>
                                            

                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['surveys'];?>
</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button type="button" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/';" class="btn btn-default btn-normal pull-right ml"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['new_survey'];?>
</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="search_surveys"><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_surveys'];?>
</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_surveys'];?>
" id="search_surveys" name="search_surveys" oninput="displaySurveys()"  onemptied="displaySurveys()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="surveys_list_wrpr">
                                    <?php  $_smarty_tpl->tpl_vars['survey'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['survey']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['surveys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['survey']->key => $_smarty_tpl->tpl_vars['survey']->value){
$_smarty_tpl->tpl_vars['survey']->_loop = true;
?>
                                        <div class="row-fluid single_survey_block" id="survey_block_<?php echo $_smarty_tpl->tpl_vars['survey']->value['id'];?>
">
                                            <div class="span12 quest-block <?php if ($_smarty_tpl->tpl_vars['survey']->value['id']==$_smarty_tpl->tpl_vars['survey_id']->value){?>active<?php }?>" onClick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
manage/surveys/<?php echo $_smarty_tpl->tpl_vars['survey']->value['id'];?>
/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="survey-quation-input-types-manageform pull-left"></div></div>
                                                    <div class="span10 quest-block-center">
                                                        <p class="survey_title_data"><?php echo $_smarty_tpl->tpl_vars['survey']->value['survey_title'];?>
</p>
                                                    </div>
                                                    <?php if ($_smarty_tpl->tpl_vars['survey']->value['status']==0){?>
                                                        <div class="span1 pull-right">
                                                            <div class="survey-quation-input-types-lock pull-right"></div>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
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
    
    <script>
        $(document).ready(function() {
            $('.widget-head-survey-tab .btn').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                return false;
            });
        });
    </script>
    
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.sortable.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".datepicker").datepicker({
        autoclose: true
    });
           
    // survay form functions
    $(".dragdrop-box").sortable({
    //items: "div.ctrloption, div:not(.drop_zone_inner)", 
        items: "div.selected_form_wrpr", 
        cursor: 'move'
    });
    $(".dragdrop-box").disableSelection();
    
    $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    // remove ctrl_option
    $(".ctrlstrip-close").live("click",function(){
        var form_selected = $(this).parents('.selected_form_wrpr').find('.form_title_data').html();
        var hidden_ids = $('#hidden_survey_ids').val();
        var delete_ids = $(this).parents('.selected_form_wrpr').find('input.form_id').val();
        var temp_hidden = hidden_ids.split(',');
        var temp = '';
        for(var i=0;i<temp_hidden.length;i++){
            if(temp_hidden[i] != delete_ids){
                if(temp == '')
                    temp = temp_hidden[i];
                else
                    temp = temp+","+temp_hidden[i];
            }
        }
        $('#hidden_survey_ids').val(temp);
        <?php  $_smarty_tpl->tpl_vars['form'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form']->key => $_smarty_tpl->tpl_vars['form']->value){
$_smarty_tpl->tpl_vars['form']->_loop = true;
?>
            if(form_selected == '<?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
'){
                $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" id="check_<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
" type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
" class="pull-right span1" /><label class="form_title_data"><?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
</label></div>\n\
                                                </div>\n\
                                            </div>');
            }
        <?php } ?>
        $(this).parents('.selected_form_wrpr').remove();
        $(".dragdrop-box").sortable();
        $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
                function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
        });
    });
    
    $(".dragdrop-box").droppable({
        accept: ".draggable-form",
        activeClass: "active",
        hoverClass: "hover",
        drop: function(event,ui){
            var form = ui.draggable.find(".form_title_data").html();
            var form_id = ui.draggable.find("input.form_id").val();
            var hidden_ids = $('#hidden_survey_ids').val();
            ui.draggable.remove();
            $('.dragdrop-box').append('<div class="span12 no-ml selected_form_wrpr drop-zone mb">\n\
                                                        <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                                        <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                                            <span class="form_title_data">'+ form +'</span>\n\
                                                            <input type="hidden" class="form_id" name="survey_ids[]" id="survey_ids[]" value="'+ form_id +'" />\n\
                                                        </div>\n\
                                                    </div>');
            if(hidden_ids != '')
                $('#hidden_survey_ids').val($('#hidden_survey_ids').val()+","+form_id);
            else
                $('#hidden_survey_ids').val(form_id);
        }
    });
});

function addFormToSurvey(){
    var selected = new Array();
    var selected_id = new Array();
    $('#draggable-forms input:checked').each(function() {
        selected.push($(this).attr('value'));
        selected_id.push($(this).attr('id'));

    });
    for(var i=0;i<selected.length;i++){
        var val = selected_id[i].split("check_");
        $('.dragdrop-box').append('<div class="span12 no-ml selected_form_wrpr drop-zone mb">\n\
                                                        <div class="span1 pull-right no-mb no-min-height"><span class="pl pr pull-right"><i class="icon-trash cursor_hand ctrlstrip-close"></i></span></div>\n\
                                                        <div class="span11 no-min-height text-left" style="margin:0;">\n\
                                                            <span class="form_title_data">'+ selected[i] +'</span>\n\
                                                            <input type="hidden" class="form_id" name="survey_ids[]" id="survey_ids[]" value="'+ val[1] +'" />\n\
                                                        </div>\n\
                                                    </div>');
        $('#'+selected_id[i]).parents('.draggable-form').remove();
    }   
    $(".dragdrop-box").sortable();
}
function saveSurvey(finalise){
    var expiry_date = $("#expire_date").val();
    $("#finalise").val(finalise)
    var selected_forms = new Array();
    $('.dragdrop-box .selected_form_wrpr').each(function() {
        selected_forms.push($(this).find('.form_title_data').html());
    });
    if(selected_forms.length == 0){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_forms_selected'];?>
");
    }
    else if($("#survey_title").val() == "" || $("#survey_title").val() == null){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_survey_name'];?>
");
    }
    else if(expiry_date == "" || expiry_date == null || expiry_date == "<?php echo $_smarty_tpl->tpl_vars['translate']->value['expiry_date'];?>
"){
        alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['expiry_date'];?>
"); 
    }else{
        var current = new Date('<?php echo $_smarty_tpl->tpl_vars['current_date']->value;?>
');
        var exp_date = new Date(expiry_date);
        if(exp_date < current){
            alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_expire_date_greater_than_currrent_date'];?>
");
        }else{
            $(".dragdrop-box").sortable();
            $('#form_survey').submit();
        }
    }
    
}
function deleteSurvey(){
    $('#action').val('2');
    $('#form_survey').submit();
}
function displayForms(){
    var search_val = $("#search_box_forms").val();
    search_val = search_val.toLowerCase();
    var selected_questions = new Array();
    
    var selected = new Array();
    var selected_id = new Array();
    <?php  $_smarty_tpl->tpl_vars['form'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['form']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['form']->key => $_smarty_tpl->tpl_vars['form']->value){
$_smarty_tpl->tpl_vars['form']->_loop = true;
?>
        selected.push('<?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
');
        selected_id.push('<?php echo $_smarty_tpl->tpl_vars['form']->value['id'];?>
');
    <?php } ?>
    
    $("#draggable-forms .draggable-form").remove();
    for(var i=0;i<selected.length;i++){
        var temp_search = selected[i];
        for(var j=0;j<selected_questions.length;j++){
            if(selected_questions[j] == selected_id[i]){
                break;
            }
        }
        if(j == selected_questions.length){
            if(search_val.length != 0){
                var regExp = new RegExp(search_val, 'i');
                var x = temp_search.toLowerCase();
                if(regExp.test(x)){
                    $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" class="pull-right span1" /><label class="form_title_data">'+selected[i]+'</label></div>\n\
                                                </div>\n\
                                            </div>');
                }
            }else{
                $("#draggable-forms").append('<div class="span12 answer-tool draggable-form">\n\
                                                <input name="form_id" class="form_id" type="hidden" value="'+selected_id[i]+'" />\n\
                                                <div class="span12 answer-tool-right no-ml">\n\
                                                    <div class="span2"><div class="survey-quation-input-types-form"></div></div>\n\
                                                    <div class="span10 edit-form-label"><input name="check_'+selected_id[i]+'" id="check_'+selected_id[i]+'" type="checkbox" value="'+selected[i]+'" class="pull-right span1" /><label class="form_title_data">'+selected[i]+'</label></div>\n\
                                                </div>\n\
                                            </div>');
            }
        }
        
    }
    
    $(".dragdrop-box").sortable();
    $("#draggable-forms .draggable-form").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
                function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
        });
}
function displaySurveys(){
    var search_val = $("#search_surveys").val();
    search_val = search_val.toLowerCase();
    if(search_val.length != 0){
        $("#surveys_list_wrpr .single_survey_block").addClass('hide');
        $('#surveys_list_wrpr .single_survey_block').each(function( index ) {
            var temp_search = $(this).find('.survey_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(temp_search))
                $(this).removeClass('hide');
        });
    }else
        $("#surveys_list_wrpr .single_survey_block").removeClass('hide');
    
}
</script> 


    </body>
</html><?php }} ?>