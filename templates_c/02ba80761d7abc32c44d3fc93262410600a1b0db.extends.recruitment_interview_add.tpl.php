<?php /* Smarty version Smarty-3.1.8, created on 2021-02-24 06:46:58
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/recruitment_interview_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11924439086035f662714bd2-06310401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02ba80761d7abc32c44d3fc93262410600a1b0db' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/recruitment_interview_add.tpl',
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
  'nocache_hash' => '11924439086035f662714bd2-06310401',
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
  'unifunc' => 'content_6035f662a26591_68905842',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035f662a26591_68905842')) {function content_6035f662a26591_68905842($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
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
css/cirrus.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" />

<style>
    .search_section, .search_ssn, .search_criteria {
    	float: left;
    }
    .search_section{
    	padding:8px 0 0 13px;
    }
    .search_criteria {
    	margin-left:10px;
    	
    }
    .search_options {
    	margin:0px 6px 1px 6px;
    	background-color:#e1ecf0;
    	padding:15px 14px;
    }
    #search_meddcentr table:first-child td:first-child {
    	width:15px;
    }
    .interview_submit {
    	background-color:#a0dae6;
    	margin:0px 6px 5px 6px;
    	padding:10px 0px;
    }
    #search_meddcentr table.table_list {
    	margin-bottom:0px;	
    }
    .interview_dates a, .med_searchsubmit a {
    	background-color:#dddddd;
    	padding:4px 6px;
    	display:block;
    	float:left;
    	border:solid 1px #cccccc;	
    }
    .interview_dates p {
    	float:left;
    	margin-right:10px;
    	margin-left:9px;
    	padding:4px 0px;
    }
    .search_filed {
    	margin:0px 14px;
    }
    .med_searchsubmit {
    	margin-top:6px;
    }
    .error{
        background: #f8dbdb;
        border-color: #e77776;
    }

    .search_column {
    	border-right:solid 1px #9fd9e5;
    	float:left;
    	padding:0px 10px;
    }
    .search_column:last-child {
    	border-right:none;
    	margin-right:0px;
    }
    .search_column:first-child {
    	padding-left:0px;
    }

    .summery_popup { 
        margin: 7px 3px; 
        border:solid 1px #daf2f7; 
        width: 99%; 
        text-align: center;
    }
    .summery_popup td {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        background-color: #daf2f7;
        padding: 5px 4px;
        margin-bottom: 3px;
        text-align: center;
    }
    .summery_popup th {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        font-weight: bold;
        background-color: #daf2f7;
        padding: 5px;
        border-bottom: solid 1px #fff;
        text-align: center;
    } 

    .ui-widget-overlay{
           background:none; 
        }
    .fixed-dialog{ position: fixed; top: 50px; left: 50px; }
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
    <div class="tbl_hd">
        <span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['recruitment'];?>
<span style="padding-left: 10px;"></span></span>  
        <a class="add" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
add/recruitment/applicant/"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_applicant'];?>
</span></a>
        <a class="back" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
administration/"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</span></a>
    </div>
    <div id="pop_up_themes">
        <div id="previous_slot" style="display:none;"></div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

    <div id="tble_list">
        <form method="post" enctype="multipart/form-data" name="form2" id="form2" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
recruitment/interview/add/">
            <div class="row-fluid">
            <div class="pagention span12">
                <select name="type_recruitment" id="type_recruitment" style="margin-left: 8px; margin-top: 3px;height: 23px;">
                    <option value="5" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='5'){?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['all_candicates'];?>
</option>
                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='0'){?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['applied_candicates'];?>
</option>
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='1'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_called'];?>
</option>
                    <!--<option value="2" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='2'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_attended'];?>
</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='3'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['shortlisted_candidates'];?>
</option>
                    <option value="4" <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='4'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['offer_letter_send'];?>
</option>
                    <!--                <option value="5">Select</option>-->
                </select>
                <div class="search_section">
                    <div class="search_ssn"><input name="selection_search" type="radio" value="1"id="ssn"<?php if ($_smarty_tpl->tpl_vars['search_type']->value=="1"){?>checked="checked"<?php }?> onclick="viewSearch('1')" style="margin-right: 5px;"/><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_by_ssn'];?>
</div>

                    <div class="search_criteria"><input name="selection_search" type="radio" value="0"id="criteria"  <?php if ($_smarty_tpl->tpl_vars['search_type']->value=="0"){?>checked="checked"<?php }?> onclick="viewSearch('2')" style="margin-right: 5px;"/><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_by_criteria'];?>
</div>
                    <div class="search_criteria"><input name="selection_search" type="radio" value="2"id="search_name"  <?php if ($_smarty_tpl->tpl_vars['search_type']->value=="2"){?>checked="checked"<?php }?>onclick="viewSearch('1')"  style="margin-right: 5px;"/><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_by_name'];?>
</div>

                </div>
            </div>
            </div>        
            <div class="row-fluid">
            <div class="search_options span12">
                <input type ="hidden" name="action" id="action" value="">
                <input type ="hidden" name="selected_per_num" id="selected_per_num" value="">
                <div class="search_filed" id="ssn_search" <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='0'){?>style="display: none"<?php }?>>
                    <div class="search_column">
                        <input name="serach_key" type="text"  id="serach_key"    style="width:115px; height:18px;" value="<?php echo $_smarty_tpl->tpl_vars['ssn_num']->value;?>
">
                        <input type="hidden" name="temp_search_cust" id="temp_search_cust" />


                    </div>
                    <div class="search_column">
                        <input name="Submit" type="button" id="Submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search'];?>
" class="submit_btn" onclick="submit_form('1');" >


                    </div>
                    <!--                <div class="med_searchfiled"><input name="serach_key" type="text"  id="serach_key"    style="width:240px; height:25px;">
                                        <input type="hidden" name="temp_search_cust" id="temp_search_cust" />
                                    </div>
                                    <div class="med_searchsubmit">
                                        <input name="Submit" type="button" id="Submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search'];?>
" class="submit_btn" onclick="submit_form('1');" >

                                    </div>-->
                </div>
                <div class="search_filed" id="criteria_search" <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='1'||$_smarty_tpl->tpl_vars['search_type']->value=='2'){?>style="display: none"<?php }?>>
                    <div class="search_column">
                        <select id="gender" name="gender">
                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
</option>
                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['value_filter_gender']->value=="1"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
</option>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['value_filter_gender']->value=="0"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
</option>
                        </select>


                    </div>
                    <div class="search_column">

                        <div style="display: block;" id="filter_age" class="filtering" >
                            <input type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['age_from'];?>
..." value="<?php echo $_smarty_tpl->tpl_vars['value_filter_age_from']->value;?>
" id="age_from" name="age_from" style="width:90px; height:20px;"> 
                            <input type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['age_to'];?>
..." value="<?php echo $_smarty_tpl->tpl_vars['value_filter_age_to']->value;?>
" id="age_to" name="age_to" style="width:90px; height:20px;"> 
                        </div>
                    </div>
                    <div class="search_column"><div style="display: block;" id="filter_qual" class="filtering">
                            <select name="qual" id="qual" style="width:120px;">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['qualification'];?>
</option>
                                <?php  $_smarty_tpl->tpl_vars['qualification'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['qualification']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['qualifications']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['qualification']->key => $_smarty_tpl->tpl_vars['qualification']->value){
$_smarty_tpl->tpl_vars['qualification']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['qualification']->value['qualification'];?>
" <?php if ($_smarty_tpl->tpl_vars['value_filter_qual']->value==$_smarty_tpl->tpl_vars['qualification']->value['qualification']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['qualification']->value['qualification'];?>
</option> 
                                <?php } ?>
                            </select>
                        </div></div>
                    <div class="search_column"><div style="display: block;" id="filter_lang" class="filtering">
                            <select name="lang" id="lang" style="width:120px;">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['language'];?>
</option>
                                <?php  $_smarty_tpl->tpl_vars['lng'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lng']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages_applicant']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lng']->key => $_smarty_tpl->tpl_vars['lng']->value){
$_smarty_tpl->tpl_vars['lng']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['lng']->value['language_known'];?>
" <?php if ($_smarty_tpl->tpl_vars['value_filter_lang']->value==$_smarty_tpl->tpl_vars['lng']->value['language_known']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['lng']->value['language_known'];?>
</option> 
                                <?php } ?>
                            </select>
                        </div></div>
                    <div class="search_column"><div style="display: block;" id="filter_city" class="filtering">
                            <select name="city" id="city" style="width:120px;">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</option>
                                <?php  $_smarty_tpl->tpl_vars['city'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['city']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['city']->key => $_smarty_tpl->tpl_vars['city']->value){
$_smarty_tpl->tpl_vars['city']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['city']->value['city'];?>
" <?php if ($_smarty_tpl->tpl_vars['value_filter_city']->value==$_smarty_tpl->tpl_vars['city']->value['city']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['city']->value['city'];?>
</option> 
                                <?php } ?>
                            </select>
                        </div></div>
                    <div class="search_column"> <div class="med_searchsubmit" style="margin-top: 2px;">
                            <input name="Submit" type="button" id="Submit" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search'];?>
" class="submit_btn" onclick="submit_form('3');" >

                        </div></div>

                </div>
            </div>
            </div>
            <div class="row-fluid">                            
            <div id="search_meddcentr">
                <table class="table_list" style="text-align:left; font-size:12px; width: 100%">
                    <tbody>
                        <tr style="text-align: center">
                            <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value!='5'){?><th>&nbsp;</th><?php }?>
                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security_number'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</th>
                            <th style="width: 100px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile_phone'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</th>
                            <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value!='0'){?>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_of_interview'];?>
</th>
                            <?php }?>
                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['created_date'];?>
</th>
                            <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='5'){?>
                                <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('0')" style="text-decoration: underline;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['applied'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['applied_short'];?>
</a></th>
                                <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('1')" style="text-decoration: underline;" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_called'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_called_short'];?>
</a></th>
                                 <!-- <th><a href="javascript:void(0);" onclick="loadSortedCandidates('2')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_attended'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_attended_short'];?>
</a></th>
                              <th><a href="javascript:void(0);" onclick="loadSortedCandidates('3')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['shortlisted'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['shortlisted_short'];?>
</a></th>
                                <th><a href="javascript:void(0);" onclick="loadSortedCandidates('4')" style="text-decoration: underline" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['offer_letter_send'];?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value['offer_letter_send_short'];?>
</a></th>-->
                            <?php }?>
                            
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['applicant'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['applicant']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['applicants']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['applicant']->key => $_smarty_tpl->tpl_vars['applicant']->value){
$_smarty_tpl->tpl_vars['applicant']->_loop = true;
?>

                            <tr class="<?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
" >
                                <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value!='5'){?> <td><input type="checkbox" name="check_pernumber" class="check_pernumber"  value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
" > </td><?php }?>
                                <td><?php echo $_smarty_tpl->tpl_vars['applicant']->value['personal_number'];?>
</td>
                                <td><a <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value!='5'){?>href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
/"<?php }else{ ?>href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
-1/"<?php }?> style="border-bottom: 1px dashed #999;"><?php echo $_smarty_tpl->tpl_vars['applicant']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['applicant']->value['first_name'];?>
</a></td> 
                                <td><?php if ($_smarty_tpl->tpl_vars['applicant']->value['mobile']!=''){?><?php echo $_smarty_tpl->tpl_vars['applicant']->value['mobile'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['applicant']->value['telephone'];?>
<?php }?></td>
                                <td><?php if ($_smarty_tpl->tpl_vars['applicant']->value['gender']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
<?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['gender']==0){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
<?php }?></td>
                                <td ><?php echo $_smarty_tpl->tpl_vars['applicant']->value['city'];?>
</td>
                                <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value!='0'){?> <td ><?php echo $_smarty_tpl->tpl_vars['applicant']->value['date_of_interview'];?>
</td><?php }?>
                                <td ><?php if ($_smarty_tpl->tpl_vars['applicant']->value['created_date']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['applicant']->value['created_date'],'Y-m-d');?>
<?php }?></td>
                                <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='5'){?>
                                    <?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']==''){?><td style="text-align: center"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/recruitment_tick.png" /></td><td></td><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']==1){?><td></td><td style="text-align: center"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/recruitment_tick.png" /></td><?php }?>
                                    
                                    <?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']==5){?><td colspan="2" style="text-align: center;color: #CA226B"><?php echo $_smarty_tpl->tpl_vars['translate']->value['selected_employee'];?>
</td><?php }?>
                                <?php }?>
                                
                            </tr>   
                        <?php }
if (!$_smarty_tpl->tpl_vars['applicant']->_loop) {
?>
                            <td <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='0'){?>colspan="7"<?php }elseif($_smarty_tpl->tpl_vars['type_recruitment']->value==5){?>colspan="9"<?php }else{ ?>colspan="8"<?php }?>><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            </div>
<div class="row-fluid">
<div class="interview_submit span12">
    <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='0'){?>
        <div class="interview_dates">
            <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_of_interview'];?>
 </p>
            <div style="float:left; margin-right:3px; margin-top:3px;">
                <input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview">
            </div> 
            <div style="float:left;">
                <input name="save" type="button" id="save_recut" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['give_interview_date'];?>
" class="submit_btn" onclick="submit_form('2');" style="margin-top:3px;margin-left:3px;padding: 2px;">
            </div>
        </div>
    <?php }elseif($_smarty_tpl->tpl_vars['type_recruitment']->value!='0'&&$_smarty_tpl->tpl_vars['type_recruitment']->value!='5'){?>
        <div style="float:left;">
            <!--<input style="padding: 2px 4px;margin-left: 20px" name="save" type="button" id="save_recut"<?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='1'){?>value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_attended'];?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='2'){?>value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_shortlisted'];?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='3'){?>value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_offer_letter_send'];?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='4'){?>value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_employee'];?>
"<?php }?> class="submit_btn" onclick="submit_form('5');"> -->
            <input style="padding: 2px 4px;margin-left: 20px" name="save" type="button" id="save_recut"<?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value=='1'){?>value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_employee'];?>
"<?php }?> class="submit_btn" onclick="submit_form('5');">
        </div>
        <?php if ($_smarty_tpl->tpl_vars['type_recruitment']->value==1){?>
            <div style="float: left;margin-left: 18px;display: none;" id="re_date">
                <input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview">
            </div>
            <div style="float: left">
                <input style="padding: 2px 4px;margin-left: 20px" name="save_new_date" type="button" id="save_new_date" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reschedule_date'];?>
" onclick="rescheduleInterview()"/>
            </div>
        <?php }?>
        
    <?php }?>
</div>
</div>
</form>
</div>
    </div></div>

                                
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
js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(".search_options").keypress(function(e) {
            if(e.which == 13) {
                var search_enter = $('input:radio[name=selection_search]:checked').val();
                if(search_enter == 1 || search_enter == 2){
                    submit_form('1');
                }else{
                    submit_form('3');
                }
            }
        }); 

    $(document).ready(function(){
        var myVar = '';
        
       //  $( "#date" ).datepicker({
       //     showOn: "button",
       //     buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
       //     buttonImageOnly: true,
       //     dateFormat :"yy-mm-dd"
       // });

        $('#date').datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
       
        $("#type_recruitment").change(function (){
            $("#action").val('4');
            $("#form2").submit(); 
        });
  


    });
    
        function viewSearch(type){
            if(type == 1){
                $("#criteria_search").hide();
                $("#ssn_search").show();
            }else if(type == 2){
                $("#ssn_search").hide();
                $("#criteria_search").show();
                
            }
        
        }
     
     function submit_form(type_action){
            var error = 0;
            if(type_action ==2 || type_action ==5 || type_action ==6){
                var recut_emp="";
                $('.check_pernumber:checked').each(function() {
                    if(recut_emp == ''){
                        recut_emp=$(this).attr("value");
                    }else{
                        recut_emp=recut_emp+','+($(this).attr("value"));
                    }
                });
                if(recut_emp == ''){
                    alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_applicants'];?>
");
                    error = 1;
                }
                else if($("#date").val() == '' && type_action == 2){
                    alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_interview_date'];?>
");
                    error = 1;
                }
                $("#selected_per_num").val(recut_emp);
            }else if(type_action == 1){
                var search = $('input:radio[name=selection_search]:checked').val();
                if($("#serach_key").val() == "" && search == 1){
                   alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_ssn'];?>
"); 
                   error = 1;
                }
                if($("#serach_key").val() == "" && search == 2){
                   alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_name'];?>
"); 
                   error = 1;
                }
            }
                $("#action").val(type_action);
                if(error == 0)
                    $("#form2").submit(); 
        }   
        
        
        
        function loadSortedCandidates(type_recruitment){
            $("#search_meddcentr").load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_recruitment_sorted_list.php?status_type='+type_recruitment);
        
        }
        
        function rescheduleInterview(){
            if ($('#re_date').css('display') == 'none') {
                $('#re_date').show();
            }else{
                if($("#date").val() == ""){
                    $('#re_date').hide();
                }else{
                    submit_form('6')
                }
            }
        }
        
        
        
        function popupPreviousSchedule(app_id){
            var dialog_box_new = $("#previous_slot");
            dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_recruitment_previous_schedules.php?app_id='+app_id);
            dialog_box_new.dialog({
                title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['previous_schedules'];?>
',
                position: 'top,left',
                modal: true,
                //width: 'auto',
                //maxHeight: 150,
                //height: 150,
                width: 516,
                minWidth: 300,
                minHeight: 100,
                closeOnEscape: true,
                sticky: true,
                dialogClass: 'fixed-dialog',
                resizable: false,
                //dialogClass: 'no-close',
                //show: { effect: "blind", duration: 800 },
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        $("#external_wrapper #pop_up_themes").append('<div id="previous_slot" style="display:none;"></div>');
                },
                hide: 'slide',
                show: { effect: 'slide', duration: 500 }
//                
         });
        }
       
       
    </script>

    </body>
</html><?php }} ?>