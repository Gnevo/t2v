<?php /* Smarty version Smarty-3.1.8, created on 2021-01-13 21:54:34
         compiled from "/home/time2view/public_html/cirrus/templates/recruitment_applicant_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19917894215fff6c1a1620a6-00869104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '466ad62c03f738e75971a1c9104b93c26c2eed49' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/recruitment_applicant_view.tpl',
      1 => 1526636998,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19917894215fff6c1a1620a6-00869104',
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
  'unifunc' => 'content_5fff6c1a481ab2_26002956',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fff6c1a481ab2_26002956')) {function content_5fff6c1a481ab2_26002956($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus/libs/plugins/function.cycle.php';
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
css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin --> 
    <style>
        .recruitment_forms {
            background-color: #E1ECF0;
            padding: 10px 14px;
        }
        .recruitmentprofile_main {
            background-color:#fff;
            padding:5px;
        }
        .profile_pic, .profile_details {
            float:left;
        }
        .profile_pic {
            margin-right:10px;
        }
        .recruitment_name {
            font-size:18px;
            color:#474747;
            font-weight:bold;
            text-transform:uppercase;
        }
        .recruitment_Secondname {
            text-transform:uppercase;
            font-size:12px;
            margin-top:3px;
        }
        .recruitment_firstrow, .recruitment_second, .recruitment_therd, .recruit_address, .recruit_aditionelinfor, .recruitments_firstrow, .recruitments_secondrow, .recruitments_therdrow {
            float:left;
        }
        .recruitment_firstrow {
            width:110px;
        }
        .recruitment_second {
            margin:0px 10px;
        }
        .deati_recruitment {
            margin-top:7px;
        }
        .recruitment {
            margin-top:10px;
        }
        .recruit_address{
            width:384px;
        }
        .recruit_aditionelinfor {
            width:448px;
        }
        .recruitments_firstrow {
            width:130px;
        }
        .recruitments_secondrow {
            margin:0px 10px;
        }
        .recruitment_detailsss {
            margin-top:13px;
        }
        .recruitment h3, .recruitment h4 {
            margin-top:10px;
            text-transform:uppercase;
        }
        .recruitment p {
            margin-top:10px;
        }
        .recruitment_coments {
            margin-top:30px;
        }
        .recruitment_coments textarea {
            margin-top:10px;
        }
        .resumedownload_btn {
            float:right;
            margin:2px 3px;
            background-color:#0072c6;
            color:#fff;
            padding:7px 5px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .resumedownload_btn a {
            color:#fff;
        }

        .recruitment_status{
            background: #7BB9C7;
            display: inline-block;
            font-weight: bold;
            color: #FFFFFF;
            margin-left: 10px;
            padding: 3px;
            text-align: center;
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

        .skill_hold p{
            word-break: normal;
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
                                
<div class="row-fluid">
    <div class="span12 main-left">    
    <div class="tbl_hd">
        <span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['recruitment_applicant_detail'];?>
</span>
        <a <?php if ($_smarty_tpl->tpl_vars['show_all']->value=="1"){?>href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
recruitment/interview/add/"<?php }else{ ?>href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
recruitment/interview/add/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['status'];?>
/"<?php }?>class="back"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</span></a>

<a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</span></a>
</div>
<div id="pop_up_themes">
    <div id="previous_slot" style="display:none;"></div>
    <div id="comment_popup" style="display:none;"></div>
</div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<div class="row-fluid">
    <div id="tble_list" class="span12">
    <div class="recruitment_forms">
        <form method="post" name="form1" id="form1" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
/">
            
            <div class="recruitment span12">
                
                <div class="recruitmentprofile_main span12">
                    <input type="hidden" name="action" id="action" value="" />
                    <div class="profile_pic">
                        <img <?php if ($_smarty_tpl->tpl_vars['applicant']->value['photo']!=''){?> src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/recruitment/photo/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['photo'];?>
"<?php }else{ ?>src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/pre_general.png"<?php }?> width="126" height="120">
                    </div>
                    <div class="profile_details">
                        <div class="recruitment_name"><?php echo $_smarty_tpl->tpl_vars['applicant']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['applicant']->value['first_name'];?>
</div>
                        <div class="recruitment_Secondname"></div>
                        <div class="recruitment_maindetail">

                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_number'];?>
</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd"><?php echo $_smarty_tpl->tpl_vars['applicant']->value['century'];?>
 <?php echo substr($_smarty_tpl->tpl_vars['applicant']->value['personal_number'],0,6);?>
-<?php echo substr($_smarty_tpl->tpl_vars['applicant']->value['personal_number'],6);?>
</div>
                            </div>

                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd"><?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>
</div>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['applicant']->value['created_date']!=''){?>
                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['created_date'];?>
</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['applicant']->value['created_date'],'Y-m-d');?>
</div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="recruitment_status"><?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']==0){?>
                        <?php echo $_smarty_tpl->tpl_vars['translate']->value['applied'];?>

                        <?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['status']==1){?>
                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_called'];?>

                            <?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['status']==2){?>
                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_attended'];?>
   
                                <?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['status']==3){?>
                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['shortlisted'];?>

                                    <?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['status']==4){?>
                                        <?php echo $_smarty_tpl->tpl_vars['translate']->value['offer_letter_send'];?>

                                        <?php }elseif($_smarty_tpl->tpl_vars['applicant']->value['status']==5){?>
                                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>

                                            <?php }?>
                                            </div>
                                            <div class="resumedownload_btn">
                                                <a href="javascript:void(0);" onclick="downloadFile('<?php echo $_smarty_tpl->tpl_vars['applicant']->value['attach_resume'];?>
')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['download_resume'];?>
</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">        
                                    <div class="recruitment span12">
                                        <div class="recruit_address span6">
                                            <div class="row-fluid">
                                            <div class="span12">    
                                            <h3 style="margin-top: 10px; background:#DAF2F7;  padding:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['recruitment_applicant_detail'];?>
</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:12px 10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="first_name" id="first_name" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['first_name'];?>
" required="true" /> </div>
                                                </div>
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="last_name" id="last_name" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['last_name'];?>
" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['century'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="century" id="century" required="true">
                                                            <option value="19" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['century']===19){?>selected<?php }?>>19</option>
                                                            <option value="20" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['century']===20){?>selected<?php }?>>20</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_number'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="personal_number" id="personal_number" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['personal_number'];?>
" maxlength="11" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['gender'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="gender" id="gender" required="true">
                                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['gender']==1){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['male'];?>
</option>
                                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['gender']==0){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['female'];?>
</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>            
                                            <div class="row-fluid">
                                            <div class="span12">            
                                            <h3 style="background:#DAF2F7;  padding:10px;">Address</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <textarea name="address" id="address" style="height: 40px; color: #646363; font-size: 12px;" required="true"><?php echo $_smarty_tpl->tpl_vars['applicant']->value['address'];?>
</textarea>
                                                    </div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post_no'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="post_no" id="post_no" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['post_no'];?>
" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="city" id="city" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['city'];?>
" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['telephone'];?>
</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="telephone" id="telephone" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['telephone'];?>
" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="mobile" id="mobile" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['mobile'];?>
" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="email" id="email" required="true" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['email'];?>
" /></div>
                                                </div>
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['experience'];?>
</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="experience" id="experience">
                                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="0"){?>selected<?php }?>>Mindre än 1 År</option>
                                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="1"){?>selected<?php }?>>2-3 År</option>
                                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="2"){?>selected<?php }?>>4-5 År</option>
                                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="3"){?>selected<?php }?>>6-7 År</option>
                                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="4"){?>selected<?php }?>>8-9 År</option>
                                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['applicant']->value['experience']=="5"){?>selected<?php }?>>Mer än 10 År</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div> 
                                            <div class="row-fluid">
                                            <div class="span12">       
                                            <h3 style="margin-top: 20px; background:#DAF2F7;  padding:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reference_information'];?>
</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:12px 10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="ref_name" id="ref_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['ref_name'];?>
" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="ref_mobile" id="ref_mobile" type="text" value="<?php echo $_smarty_tpl->tpl_vars['applicant']->value['ref_mobile'];?>
" /></div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>    
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']==1||$_smarty_tpl->tpl_vars['applicant']->value['status']==0){?>
                                            <div class="recruit_aditionelinfor span6" style="margin-left: 10px">
                                                <div class="row-fluid">
                                                <div class="span12">
                                                <h3 style="background:#DAF2F7;  padding:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_information'];?>
</h3>
                                                <div class="recruit_bg" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;" >
                                                    <?php if ($_smarty_tpl->tpl_vars['applicant']->value['status']!=0){?>
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_date'];?>
</div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow"><?php echo $_smarty_tpl->tpl_vars['applicant']->value['date_of_interview'];?>
 </div>
                                                        </div>
                                                    <?php }?>
                                                    <input type="hidden" value="" id="reschedule" name="reschedule" />
                                                    <div class="recruitment_detailsss clearfix" style="width: auto;">
                                                        <div class="recruitments_firstrow" style="width: auto;"><input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview"> </div>
                                                        <div class="recruitments_secondrow clearfix" style="width: auto;">: </div>
                                                        <div class="recruitments_therdrow" style="width: auto;">
                                                            <input name="save_new_date" type="button" id="save_new_date" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reschedule_date'];?>
" onclick="rescheduleInterview()" /><br/>
                                                            <?php if ($_smarty_tpl->tpl_vars['show_prev']->value==1){?><input type="button" name="previous_schedule" id="previous_schedule" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['previous_schedules'];?>
" onclick="popupPreviousSchedule('<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
');" style="margin-top: 10px;" /><?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>        
                                            </div>
                                        <?php }?>
                                        <div class="recruit_aditionelinfor span6" style="margin-left:10px;">
                                            <div class="row-fluid">
                                            <div class="span12">
                                            <h3 style="background:#DAF2F7;  padding:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['skills'];?>
</h3>
                                            <div class="recruit_bg span12" id="skills_div" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;height: 262px;margin-left:0px;" >
                                                <div class="skill_hold">
                                                    <?php  $_smarty_tpl->tpl_vars['skill'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['skill']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['applicant_skills']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['skill']->key => $_smarty_tpl->tpl_vars['skill']->value){
$_smarty_tpl->tpl_vars['skill']->_loop = true;
?>
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['title'];?>
 </div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow"><input type="text" name="skill_title[]" value="<?php echo $_smarty_tpl->tpl_vars['skill']->value['title'];?>
" /></div>
                                                        </div>
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow"><?php echo $_smarty_tpl->tpl_vars['translate']->value['description'];?>
   </div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow">
                                                                <textarea name="skill_desc[]" id="address"  style="height: 40px; color: #646363; font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['skill']->value['description'];?>
</textarea>
                                                            </div>
                                                        </div>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['skill']->_loop) {
?>
                                                        <h4><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_skills'];?>
</h4>   
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            </div>
                                            </div>    
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row-fluid">            
                                    <div class="recruitment span12">
                                        <div class="recruitment_coments">
                                            <h3 style=" margin-bottom:2px; background:#DAF2F7;  padding:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
</h3>
                                            <div class="comment_hold">
                                                <table class="table_list" style="width: 100%;text-align: center">
                                                    <tr><th style="width: 71px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
</th><th style="width: 169px"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['status'];?>
</th><th style="width: 52px"></th></tr>
                                                            <?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
                                                        <tr class="<?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
">
                                                            <td><?php echo $_smarty_tpl->tpl_vars['comment']->value['date'];?>
</td>
                                                            <td><?php echo $_smarty_tpl->tpl_vars['comment']->value['comment'];?>
</td>
                                                            <td>
                                                                <?php if ($_smarty_tpl->tpl_vars['comment']->value['application_status']==0){?>
                                                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['applied'];?>

                                                                <?php }elseif($_smarty_tpl->tpl_vars['comment']->value['application_status']==1){?>
                                                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['interview_called'];?>

                                                                <?php }elseif($_smarty_tpl->tpl_vars['comment']->value['application_status']==5){?>
                                                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>

                                                                <?php }?>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0);" class="settings" onclick="popupComment('2', '<?php echo $_smarty_tpl->tpl_vars['comment']->value['id'];?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/settings.png" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" width="25" /></a>
                                                                <a href="javascript:void(0);" class="contracts"onclick="deleteComment('3', '<?php echo $_smarty_tpl->tpl_vars['comment']->value['id'];?>
')" ><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/dlt_btn_icn.png" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" width="25" /></a>
                                                            </td>
                                                        </tr>
                                                    <?php }
if (!$_smarty_tpl->tpl_vars['comment']->_loop) {
?>
                                                        <tr><td colspan="4"> <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td></tr>
                                                            <?php } ?>

                                                </table>
                                                <div style="clear:both; margin-top:15px; "><br />
                                                    <input type="button" name="submit_form" id="submit_form" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_comment'];?>
" onclick="popupComment('1', '0')"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>            
                                </form>
                            </div>
                        </div>
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
js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    
    <script type="text/javascript">

        $(document).ready(function () {
            /*$("#date").datetimepicker({
                showOn: "button",
                buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
                buttonImageOnly: true,
                dateFormat: "yy-mm-dd"
            });*/
              

            $('#date').datetimepicker({
                format: "yyyy-mm-dd hh:ii:ss",
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'/*,
                minView: 'month',
                minuteStep: 30,
                todayBtn: true,
                startDate: "2013-02-14 10:00",
                pickerPosition: "bottom-left"*/

            });

            $("#form1").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    personal_number: "required",
                    address: "required",
                    post_no: "required",
                    city: "required",
                    mobile: "required",
                    email: "required email"
                },
                messages: {
                    first_name: "",
                    last_name: "",
                    personal_number: "",
                    address: "",
                    post_no: "",
                    city: "",
                    mobile: "",
                    email: {
                        required: "",
                        email: ""
                    }
                }
            });
            $.mask.definitions['~'] = '[1-9]';
            $('#personal_number').mask("?999999-9999", { placeholder: " "});
            /*$('#skills_div').jScrollPane();
            $('.scroll-pane-arrows').jScrollPane({
                showArrows: true,
                horizontalGutter: 10
            });*/

            $('#personal_number').blur(function () {
                
                var last = $('#personal_number').val().substr($('#personal_number').val().indexOf("-") + 1);
                if (last.length == 6) {
                    var move = $('#personal_number').val().substr($('#personal_number').val().indexOf("-") - 1, 1);
                    var lastfour = move + last;

                    var first = $('#personal_number').val().substr(0, 9);

                    $('#personal_number').val(first + '-' + lastfour);
                }
                var security = $('#personal_number').val();
                security = security.replace("-", "");
                $.ajax({
                    url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
recruits.php",
                    data: "personal_number=" + security + "&app_id=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
",
                    success: function (data) {
                        if ($.trim(data) === "false") {
                            $("#personal_number").css('background', '#FF5252');
                            $("#personal_number").focus();
                        } else {
                            $("#personal_number").css('background', '#FFFFFF');
                        }
                    }
                });
            });
        });

        function rescheduleInterview() {
            if ($("#date").val() == '') {
                alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_the_interview_date'];?>
");
            } else {
                $('#reschedule').val('reschedule');
                $("#form1").submit();
            }

        }

        function downloadFile(filename) {
            if (filename != '')
                document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['download_folder']->value;?>
/recruitment/resume/" + filename;
            else
                alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_uploaded_resume'];?>
");
        }
        <?php if ($_smarty_tpl->tpl_vars['show_prev']->value==1){?>
        function popupPreviousSchedule(app_id) {
            var dialog_box_new = $("#previous_slot");
            dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_recruitment_previous_schedules.php?app_id=' + app_id);
            dialog_box_new.dialog({
                title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['previous_schedules'];?>
',
                // position: 'top,left',
                modal: true,
                width: 516,
                minWidth: 300,
                minHeight: 100,
                closeOnEscape: true,
                sticky: true,
                dialogClass: 'fixed-dialog',
                resizable: false,
                close: function (event, ui) {
                    $(this).dialog('destroy').remove();
                    $("#external_wrapper #pop_up_themes").append('<div id="previous_slot" style="display:none;"></div>');
                },
                hide: 'slide',
                show: {
                    effect: 'slide',
                    duration: 500
                }
            });
        }



        <?php }?>

        function popupComment(action, comment_id) {
            var dialog_box_new = $("#comment_popup");
            dialog_box_new.load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_recruitment_comment.php?app_id=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
&status=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['status'];?>
&action=' + action + "&comment_id=" + comment_id + '&show_all=<?php echo $_smarty_tpl->tpl_vars['show_all']->value;?>
');
            dialog_box_new.dialog({
                title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
',
                position: 'middle',
                modal: true,
                resizable: true,
                width: 630,
                height: 250
            });
            return false;
        }


        function deleteComment(action, comment_id) {
            $.ajax({
                url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_recruitment_comment.php",
                type: "GET",
                data: 'app_id=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
&status=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['status'];?>
&action=' + action + '&comment_id=' + comment_id + '&show_all=<?php echo $_smarty_tpl->tpl_vars['show_all']->value;?>
',
                success: function (data_process) {
                    if (data_process == 'deleted') {
                        location.reload();
                    }
                }
            })
        }

        function submit_form() {
            var security = $('#personal_number').val();
            security = security.replace("-", "");
            $.ajax({
                url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
recruits.php",
                data: "personal_number=" + security + "&app_id=<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
",
                success: function (data) {
                    if ($.trim(data) === "true") {
                        $('#action').val('update');
                        $('#form1').submit();
                    } else {
                        $("#personal_number").css('background', '#FF5252');
                        $("#personal_number").focus();
                        return false;
                    }
                }
            });
        }
        

        function changeStatus() {
            var success_url = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['show_all']->value;?>
-1/";
            var success_url_exist = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['show_all']->value;?>
-1-1/";
            var fail_url = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
view/recruitment/applicant/<?php echo $_smarty_tpl->tpl_vars['applicant']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['show_all']->value;?>
/";
            var security = $('#personal_number').val();
            $('#dialog_hidden').load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_global_check_ssno.php?ssno=" + security + "&success_url=" + success_url + "&fail_url=" + fail_url + "&success_url_exist=" + success_url_exist);
        }
    </script>

    </body>
</html><?php }} ?>