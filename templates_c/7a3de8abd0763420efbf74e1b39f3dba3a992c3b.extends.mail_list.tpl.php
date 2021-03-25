<?php /* Smarty version Smarty-3.1.8, created on 2021-03-17 12:54:00
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/mail_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11249653886051fbe8c9dea6-58007182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a3de8abd0763420efbf74e1b39f3dba3a992c3b' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/mail_list.tpl',
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
  'nocache_hash' => '11249653886051fbe8c9dea6-58007182',
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
  'unifunc' => 'content_6051fbe9235fc8_59176442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6051fbe9235fc8_59176442')) {function content_6051fbe9235fc8_59176442($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_truncate')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.truncate.php';
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
    <style type="text/css" >
        
    	.ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        * html .ui-autocomplete {
            height: 200px;
        }
        
        #mailing_list .mailing_group ul .mail_grup_customer, #mailing_list .mailing_group ul .mail_grup_customer_unasigned,#unsigned_employee .mailing_group ul .mail_grup_customer_unasigned{
            background: none repeat scroll 0 0 #e3f2f6;
              padding: 5px 4px;
        }
        #mailing_list .mailing_group ul .mail_grup_customer_unasigned, #unsigned_employee .mailing_group ul .mail_grup_customer_unasigned {
            background: none repeat scroll 0 0 #feeded;
            padding: 5px 4px;
        }
        #mailing_list .mailing_group ul , #unsigned_employee .mailing_group ul {
            /*border-color: -moz-use-text-color #e8eff1 #e8eff1;
            border-style: none solid solid;
            border-width: medium 1px 1px;
            list-style: none outside none;*/
            border: solid thin #ddd;
            margin: 0 auto;
            padding: 4px 3px 4px 5px;
        }
              #mailing_list .mailing_group ul li > ul > li{ border: 0 !important; }
        #mailing_list li.mail_grup_employees,#unsigned_employee li.mail_grup_employees{
            /*padding-left: 0 !important;*/
            border: none;
           
        }

        #mail-recipient-list .nav-tabs>li>a { font-size: 11px; }
	   .main-right{ padding: 10px 8px 10px 8px; }
       .show_main_right .main-right{ width:38%; }
       .show_main_right .main-left{ width:60%; }
       .uploaded-files-box { height: auto; overflow-y: auto; }
       .uploaded-files-box li {
            background-color: #c0c0e6;
            padding: 3px 5px !important;
            border-radius: 17px;
            vertical-align: bottom !important;
            text-align: left;
       }
       .uploaded-files-box li a i.icon-download{
            margin: auto 4px auto 5px !important;
            padding: 4px 0px;
            width: auto;
       }
       .uploaded-files-box li a .down-file-name{
            text-overflow: ellipsis; 
            max-width: 100%; 
            overflow: hidden; 
       }
       .attachment_row input[type=file].mail_attach_file {
            height: auto;
            line-height: initial;
            vertical-align: middle !important;
        }
        .input-append .add-on, .input-prepend .add-on { min-width: 5.9251741293% !important; }
        .content-col-style { max-width: calc(100vw - 57vw); }
        .content-col-style p.limit-mail-subject { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%; }
        .content-col-style p.limit-mail-subject.have_attachment { width: 95% !important; }
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

    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="day-slot-wrpr-header-left pull-left">
                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['mail'];?>
</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button style="" class="btn btn-default btn-normal pull-right btn-addnew-mail ml" type="button"><i class="icon-plus"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_mail'];?>
</button>
                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['sms_general']==1){?>
                        <button class="btn btn-default btn-normal pull-right btn-swich-sms" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['switch_sms'];?>
</button>
                    <?php }?>
                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget" style="margin-top:0;margin-bottom: 7px !important;">
                        <div class="span12 widget-body-section input-group">
                            <form name="form" id="form" method="post">
                                <div class="span2 cmb-month" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_month"><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_month' id='cmb_month' class="form-control span11">
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</option>
                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['report_month']->value==0){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</option>
                                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_month']->value,'output'=>$_smarty_tpl->tpl_vars['month_option_output']->value),$_smarty_tpl);?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-year" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_year"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_year' id='cmb_year' class="form-control span11">
                                            <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_year'];?>
</option>
                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['report_year']->value==0){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</option>
                                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['report_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values']->value),$_smarty_tpl);?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-category" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_category"><?php echo $_smarty_tpl->tpl_vars['translate']->value['category'];?>
:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_category' id='cmb_category' class="form-control span11">
                                            <option value=1 <?php if ($_smarty_tpl->tpl_vars['report_category']->value==1){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['inbox'];?>
</option>
                                            <option value=2 <?php if ($_smarty_tpl->tpl_vars['report_category']->value==2){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['send_items'];?>
</option>
                                            <option value=3 <?php if ($_smarty_tpl->tpl_vars['report_category']->value==3){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['draft'];?>
</option>
                                        </select>
                                    </div>
                                </div>
                                <button name="go" id="go" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
" onclick="get_report();"  class="btn btn-default span2 btn-margin-set" style="margin: 15px 0 0 0; text-align: center;" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['show'];?>
</button>
                            </form>
                            <input type="hidden" id="selected_mail_category" value="<?php echo $_smarty_tpl->tpl_vars['report_category']->value;?>
" />
                        </div>
                    </div>
                        
                    <div class="row-fluid">
                        <div class="span12 no-min-height no-ml">
                            <div class="pagination pagination-mini pagination-right pagin margin-none">
                                <?php if ($_smarty_tpl->tpl_vars['pagination']->value!=''){?><ul id="pagination"><?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
</ul><?php }?>
                            </div>
                        </div>
                    </div>
                            

                    <div class="row-fluid">
                        <div class="span12 table-responsive">
                            <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 10px 0px 0px; top: 0px;">
                                <thead>
                                    <tr>
                                        <?php if ($_smarty_tpl->tpl_vars['report_category']->value==1){?>
                                            <th class="table-col-center center" style="width: 30px;"></th>
                                        <?php }?>
                                        <th></th>
                                        <?php if ($_smarty_tpl->tpl_vars['report_category']->value==1){?>
                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
</th>
                                        <?php }elseif($_smarty_tpl->tpl_vars['report_category']->value==2||$_smarty_tpl->tpl_vars['report_category']->value==3){?>
                                            <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</th>
                                        <?php }?>

                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['message'];?>
</th>
                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mail_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                        <tr class="gradeX mail-row <?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['list']->value['status']==1){?>style="font-weight: bold"<?php }?> data-id='<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
'>
                                            <?php if ($_smarty_tpl->tpl_vars['report_category']->value==1){?>
                                                <td class="center">
                                                    <i class="icon-mail-reply cursor_hand open_as_reply_mode" data-mail-id="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['reply'];?>
"></i>
                                                </td>
                                            <?php }?>
                                            <td style="width: 30px;" class="center">
                                                <i class="icon-mail-forward cursor_hand open_as_forward_mode"  data-mail-id="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['forward'];?>
"></i>
                                            </td>
                                            <?php if ($_smarty_tpl->tpl_vars['report_category']->value==1){?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <td style="width: 23%;"><?php echo $_smarty_tpl->tpl_vars['list']->value['from_name'];?>
</td>
                                                <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                                    <td style="width: 23%;"><?php echo $_smarty_tpl->tpl_vars['list']->value['from_name_lf'];?>
</td>
                                                <?php }?>
                                            <?php }elseif(($_smarty_tpl->tpl_vars['report_category']->value==2)||($_smarty_tpl->tpl_vars['report_category']->value==3)){?>
                                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                                    <td style="width: 23%;"><?php echo $_smarty_tpl->tpl_vars['list']->value['to_name'];?>
</td>
                                                <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                                    <td style="width: 23%;"><?php echo $_smarty_tpl->tpl_vars['list']->value['to_name_lf'];?>
</td>
                                                <?php }?>
                                            <?php }?>
                                            <td class="content-col-style">
                                                <p class="mail-open limit-mail-subject pull-left no-mb cursor_hand <?php if ($_smarty_tpl->tpl_vars['list']->value['attachments']!=''){?>have_attachment<?php }?>">
                                                    <span class="mr" style="font-size: 15px; <?php if ($_smarty_tpl->tpl_vars['list']->value['status']==1){?>font-weight: bold;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['list']->value['subject'];?>
</span> 
                                                    <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['list']->value['message'],120,"...",true);?>
</p>
                                                <?php if ($_smarty_tpl->tpl_vars['list']->value['attachments']!=''){?><span class=""><i class="icon-paper-clip icon-large pull-right "></i></span><?php }?>
                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['list']->value['mail_date'];?>
</td>
                                        </tr>
                                    <?php }
if (!$_smarty_tpl->tpl_vars['list']->_loop) {
?>
                                        <tr ><td colspan=8><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td></tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="span4 main-right hide">
        <div id="right_message_wraper" class="span12 no-min-height"></div>
        

        <div class="row-fluid hide" id="mail-create-template">
            <div class="span12 addnew-mail-visible" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="day-slot-wrpr-header-left pull-left">
                            <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['compose_mail'];?>
</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="SendMail()" style="" type="button"><i class=' icon-location-arrow'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send'];?>
</button>
                            <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <input type="hidden" id="operational_mail_id" name="operational_mail_id" value="" />
                        <input type="hidden" id="operational_mail_mode" name="operational_mail_mode" value="" />
                        <div class="row-fluid">
                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                <div style="margin: 0px 0px 10px ! important;" class="span12 hide no-ml" id="normal_to_wrpr">
                                    <label style="float: left;" for="mail_send_to"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 :</label>
                                    <span class="pull-right clearfix">
                                        <span class="clearfix pull-left hide" style="padding-top: 5px; font-size: 11px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_recipients'];?>
</span>
                                        <button id="btn_load_recipient_list" class="btn btn-default pull-right ml mb" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_recipients'];?>
" style="font-size: 9px !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_recipients'];?>
 <i class="icon-plus cursor_hand "></i></button>
                                    </span>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_to" id="mail_send_to" class="form-control span11" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12 hide no-ml" id="reply_to_wrpr">
                                    <label style="float: left;" class="span12" for="mail_send_to_for_reply"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 :</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_to_for_reply" id="mail_send_to_for_reply" class="form-control span11" type="text" readonly="readonly" /> 
                                        <input name="mail_send_to_id_for_reply" id="mail_send_to_id_for_reply" type="hidden" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="mail_send_subject"><?php echo $_smarty_tpl->tpl_vars['translate']->value['subject'];?>
:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_subject" id="mail_send_subject" class="form-control span11" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="mail_send_body"><?php echo $_smarty_tpl->tpl_vars['translate']->value['message'];?>
:</label>
                                    <textarea name="mail_send_body" id="mail_send_body" style="margin: 0px 0px 10px;" rows="1" class="form-control span12"></textarea>
                                </div>
                                <div class="span12 no-ml mt" style="overflow-x: auto;">
                                    <label style="float: left;" class="span12 mt pb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
 <button class="btn btn-default" id="btn_add_attachment" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_attachments'];?>
"><i class="icon-plus cursor_hand "></i></button></label>
                                    <div class="row-fluid span12 no-ml hide" id="mail_attachment_old_group">
                                    </div>
                                    <div style="margin: 10px 0px ! important; display: block ! important;" class="row-fluid mail-upload" id="mail_attachment_group">
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span5 form-right no-min-height" style="">
                                        <div style="margin: 0px;" class="span12 no-min-height">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row-fluid hide" id="mail-recipient-list">
            <div class="span12" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="day-slot-wrpr-header-left pull-left">
                            <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="select_multi_recipients()" style="" type="button"><i class=' icon-ok'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_recipient'];?>
</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-recipient-list" type="button"><i class='icon-arrow-left'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#mailing_list" aria-controls="mailing_list" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_all'];?>
</a></li>
                            <li role="presentation"><a href="#unsigned_employee" aria-controls="unsigned_employee" role="tab" data-toggle = "tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned_employees'];?>
</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div  role="tabpanel" class="tab-pane active no-ml" id="mailing_list">
                                <div class="span12" id="options_panel">
                                    <div class="pull-right mt">
                                        <label class="pull-left" for="select_all"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_all'];?>
</label>&nbsp
                                        <input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all">
                                    </div>
                                </div>
                               <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['employee']->value['customer_name']!='ALL'){?>
                                        <div class="mailing_group no-ml">
                                            <ul class="span12 no-ml">
                                                <li class="mail_grup_customer span12">
                                                    <label for="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" class="pull-left"><?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_name'];?>
</label>
                                                    <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" id="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" class="pull-right check_recipient_groups">
                                                </li>            
                                                <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                    <ul class="span12">
                                                        <?php  $_smarty_tpl->tpl_vars['empl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['empl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee']->value['employees_customer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empl']->key => $_smarty_tpl->tpl_vars['empl']->value){
$_smarty_tpl->tpl_vars['empl']->_loop = true;
?>
                                                        <li class=" span12 no-ml">
                                                            <label class="pull-left" for="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
"><?php echo $_smarty_tpl->tpl_vars['empl']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['empl']->value['last_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
)</label>
                                                            <input type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['empl']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['empl']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
(<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
)" class="pull-right check_recipient_emp" id="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
_<?php echo $_smarty_tpl->tpl_vars['employee']->value['customer_username'];?>
">
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php }?>
                                <?php } ?>
                                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                                    <div class="mailing_group span12 no-ml">
                                        <ul class="span12 no-ml">
                                            <li class="mail_grup_customer_unasigned span12">
                                                <label for="cch_unassigned_emps" class="pull-left"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unassigned_employees'];?>
</label>
                                                <input type="checkbox" value="" name="cch_unassigned_emps" id="cch_unassigned_emps" class="pull-right check_recipient_groups">
                                            </li>            
                                            <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                <ul class="span12">
                                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['employee']->value['customer_name']=='ALL'){?>
                                                            <li class=" span12 no-ml">
                                                                <label class="pull-left" for="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
"><?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['last_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
)</label>
                                                                <input type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['employee']->value['employees']['first_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['employee']->value['employees']['last_name'], ENT_QUOTES, 'UTF-8', true);?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
)" class="pull-right check_recipient_emp" id="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
">
                                                            </li>
                                                        <?php }?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }?>
                                </div>

                                <div role="tabpanel" class="tab-pane ml mt " id="unsigned_employee">
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
</label>
                                        </div>
                                        <div class="span8">
                                            <select id="unsigned_employee_year" class="span12">
                                                <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values_full']->value,'selected'=>$_smarty_tpl->tpl_vars['current_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values_full']->value),$_smarty_tpl);?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
</label>
                                        </div>
                                        <div class="span8">
                                            <select id="unsigned_employee_month" class="span12">
                                                <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</option>
                                                    <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['prev_month']->value,'output'=>$_smarty_tpl->tpl_vars['month_option_output_full']->value),$_smarty_tpl);?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- <div class="span4"></div> -->
                                        <div class="span6">
                                            <button type="button" class="btn btn-primary" onclick="get_unsigned_employee()"><?php echo $_smarty_tpl->tpl_vars['translate']->value['get_employee'];?>
</button>
                                        </div>
                                        <div class="span6 mt">
                                            <div style="float: right;">
                                                <label  for="select_all"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_all'];?>
</label>&nbsp
                                                <input type="checkbox" class="ml" value="all" id="recipient_check_all_unsigned" name="recipient_check_all">
                                            </div>
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="row-fluid mailing_group" >
                                        <ul id="employee_show" class="span12 no-ml">
                                            <?php if ($_smarty_tpl->tpl_vars['current_unsigned_employees']->value['status']==true){?>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['current_unsigned_employees']->value['data'])){?>
                                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['current_unsigned_employees']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                        <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                            <label class="pull-left"><?php if ('sort_by_name'==1){?> <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
<?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
<?php }?><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</label>
                                                            <input type="checkbox" class="pull-right check_recipient_emp" value="<?php if ('sort_by_name'==1){?> <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
<?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
<?php }?>(<?php echo $_smarty_tpl->tpl_vars['employee']->value['user_name'];?>
)" >
                                                        </li>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <div class="span12 message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                <?php }?>
                                            <?php }?>
                                        </ul>
                                    </div>

                                </div>
                        </div>


        







                      <!--   <div class="row-fluid">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">tab1</a></li>
                                <li role="presentation"><a href="#unsigned_employee" aria-controls="unsigned_employee" role="tab" data-toggle = "tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned_employees'];?>
</a></li>
                            </ul>

                        </div> -->






   <!--
                        <div  class="tab-content row-fluid">
                          <div  role="tabpanel" class="tab-pane active span12 no-ml" id="mailing_list">
                                <div class="span12" id="options_panel">
                                    <label class="pull-left" for="select_all"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_all'];?>
</label>
                                    <input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all" class="pull-right">
                                </div>
                               
                                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                                    <div class="mailing_group span12 no-ml">
                                        <ul class="span12 no-ml">
                                            <li class="mail_grup_customer_unasigned span12">
                                                <label for="cch_unassigned_emps" class="pull-left"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unassigned_employees'];?>
</label>
                                                <input type="checkbox" value="" name="cch_unassigned_emps" id="cch_unassigned_emps" class="pull-right check_recipient_groups">
                                            </li>            
                                            <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                <ul class="span12">
                                                    <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['employee']->value['customer_name']=='ALL'){?>
                                                            <li class=" span12 no-ml">
                                                                <label class="pull-left" for="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
"><?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['last_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
)</label>
                                                                <input type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['employee']->value['employees']['first_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['employee']->value['employees']['last_name'], ENT_QUOTES, 'UTF-8', true);?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
)" class="pull-right check_recipient_emp" id="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
" name="cch_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employees']['username'];?>
">
                                                            </li>
                                                        <?php }?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }?>
                            </div> 
                            
                            <div  role="tabpanel" class="tab-pane active span12 no-ml" id="unsigned_employee">
                                fbfdhbh h
                            </div>-->

                    </div>
                </div>
            </div>
        </div>
        

        <div class="span12 view-mail-visible no-ml hide">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="day-slot-wrpr-header-left pull-left">
                        <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['mail'];?>
</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default pull-right ml  open_as_forward_mode" type="button" data-mail-id=""><i class='icon-mail-forward'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['forward'];?>
</button>
                        <button class="btn btn-default pull-right mr open_as_reply_mode" type="button" data-mail-id=""><i class='icon-mail-reply'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reply'];?>
</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <input type="hidden" id="opened_mail_id" value=""/>
                    <input type="hidden" id="opened_mail_subject" value=""/>
                    <input type="hidden" id="opened_mail_message" value=""/>
                    <div class="row-fluid hide" id="view_mail_content_wrpr"  style="overflow-x: auto;">
                        <table class="table table-white table-bordered table-hover table-responsive swipe-horizontal table-primary t" style="margin: 0px ! important; top: 0px; border-top: thin solid rgb(204, 204, 204);">
                            <tbody>
                                <tr class="gradeX">
                                    <td class="view-mail-from-to-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
</td><td class="view-mail-from-to-value"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['subject'];?>
</td><td class="view-mail-subject"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['message'];?>
</td><td class="view-mail-message"  style="white-space: pre-wrap;"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['attachments'];?>
</td><td class="view-mail-attachments"></td>
                                </tr>
                            </tbody>
                        </table>
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
js/bootbox.js"></script>
<script type="text/javascript">
    jQuery.fn.removeInlineCss = (function(){
        var rootStyle = document.documentElement.style;
        var remover = 
            rootStyle.removeProperty    // modern browser
            || rootStyle.removeAttribute   // old browser (ie 6-8)
        return function removeInlineCss(properties){
            if(properties == null)
                return this.removeAttr('style');
            proporties = properties.split(/\s+/);
            return this.each(function(){
                for(var i = 0 ; i < proporties.length ; i++)
                    remover.call(this.style, proporties[i]);
            });
        };
    })();

    $(function() {
        var availableTags = [
            <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mailable_employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                     <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                        "<?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
)",       
                    <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                        "<?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
)",       
                    <?php }?>      
            <?php } ?>
            
        ];
        function split( val ) {
                return val.split( /,\s*/ );
        }
        function extractLast( term ) {
                return split( term ).pop();
        }

        $( "#mail-create-template #mail_send_to" )
                // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB &&
                            $( this ).data( "autocomplete" ).menu.active ) {
                            event.preventDefault();
                    }
            })
            .autocomplete({
                    minLength: 0,
                    source: function( request, response ) {
                            // delegate back to autocomplete, but extract the last term
                            response( $.ui.autocomplete.filter(
                                    availableTags, extractLast( request.term ) ) );
                    },
                    focus: function() {
                            // prevent value inserted on focus
                            return false;
                    },
                    select: function( event, ui ) {
                            var terms = split( this.value );
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push( ui.item.value );
                            // add placeholder to get the comma-and-space at the end
                            terms.push( "" );
                            this.value = terms.join( ", " );
                            return false;
                    }
            });
    });
    
    $(document).ready(function() {
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        });
        
        $(".btn-cancel-right").click(function() {
            close_right_panel();
        });
        
        $(".btn-cancel-recipient-list").click(function() {
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');
        });
        
        $('#mail-create-template #btn_add_attachment').click(function(e){
            $('#mail-create-template #mail_attachment_group').append('<div class="span12 no-ml attachment_row">\n\
                                                <button class="btn btn-default pull-left span1 btn_attachment_remove no-padding no-min-height" style="text-align: center;" type="button" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_attachment'];?>
"><i class="icon-trash"></i></button>\n\
                                                <div class="pull-left span11 no-ml" style=""><input type="file" name="attachments[]" class="mail_attach_file margin-none"></div></div>');
            e.preventDefault();
        });
        
        $('#mail-create-template #btn_load_recipient_list').click(function(e){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right #mail-recipient-list").removeClass('hide');
            
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);

            $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);
            e.preventDefault();
        });
        
        $(document).on('click', ".btn_attachment_remove", function(e) {
            $(this).parents('.attachment_row').remove();
            e.preventDefault();
        });
        
        $('.mail-open').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right .view-mail-visible").removeClass('hide');
            $(this).parents('tr.mail-row').removeInlineCss("font-weight");
            $(this).find('span.mr').removeInlineCss("font-weight");

            var mail_id = $(this).parents('tr.mail-row').attr('data-id');
            var mail_category = $('#selected_mail_category').val();
            $(".view-mail-visible #opened_mail_id").val('');
            
            $('.main-right .view-mail-visible #view_mail_content_wrpr').addClass('hide');
            $(".view-mail-visible .open_as_reply_mode, .view-mail-visible .open_as_forward_mode").addClass('hide');
            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mail_actions.php",
                data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                dataType: 'json',
                type    :"POST",
                success:function(data){
                        //console.log(data);
                        
                        if(data.transaction_flag !== undefined && data.transaction_flag){
                            $('.main-right .view-mail-visible #view_mail_content_wrpr').removeClass('hide');
                            
                            $(".view-mail-visible #opened_mail_id").val(mail_id);
                            $(".view-mail-visible .open_as_reply_mode").attr('data-mail-id', mail_id);
                            $(".view-mail-visible .open_as_forward_mode").attr('data-mail-id', mail_id);
                            $(".view-mail-visible .open_as_reply_mode, .view-mail-visible .open_as_forward_mode").removeClass('hide');
                            
                            $("#view_mail_content_wrpr .view-mail-from-to-label").html(mail_category == 1 ? '<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
' : '<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
');
                            
                            if(mail_category != 1){
                                $(".view-mail-visible .open_as_reply_mode").addClass('hide');
                            }

                            $("#view_mail_content_wrpr .view-mail-from-to-value").html(<?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>data.mail_details.from_name<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>data.mail_details.from_name_lf<?php }?>);
                            $("#view_mail_content_wrpr .view-mail-subject").html(data.mail_details.subject);
                            $("#view_mail_content_wrpr .view-mail-message").html(data.mail_details.message);
                            $("#view_mail_content_wrpr .view-mail-attachments").html(data.mail_details.date);

                            if(data.attachments.length > 0){
                                var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                        <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12 no-padding">';
                                $.each(data.attachments, function(i, value) {
                                    new_attachment_html += '<li class="list-group-item mb span12 no-ml no-min-height" style="padding-left: 0px;"><span class="span11 ml no-min-height"> <a href="javascript:void(0);"  onclick="downloadFile(\''+value.replace(/'/g, "\'")+'\')"><i class="icon icon-download span1 no-min-height"></i><span class="span10 no-min-height down-file-name" title="'+value+'">'+value+'</span></a> </span></li>';
                                });

                                new_attachment_html += '</ul>';
                                $("#view_mail_content_wrpr .view-mail-attachments").html(new_attachment_html);
                            }
                            else
                                $("#view_mail_content_wrpr .view-mail-attachments").html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_attachment'];?>
');

                        }

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
            
            /*$('.addnew-notes-box #edit_note_id, .addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
            $('.addnew-notes-box #note_attachment_group').html('');

            $('.addnew-notes-box .widget-header .note_process_action').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_notes'];?>
');*/
        });
        
        $('.btn-addnew-mail').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_group').html('');
            
            $('#mail-create-template #normal_to_wrpr').removeClass('hide');
            $('#mail-create-template #reply_to_wrpr').addClass('hide');
            $('#mail-create-template #operational_mail_id, #mail-create-template #operational_mail_mode').val('');
            
            $('#mail-create-template #mail_attachment_old_group').addClass('hide');
            $('#mail-create-template #mail_attachment_group').removeClass('hide');
         
		 		  $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
				
		 
		    
        });

        $('.btn-swich-sms').click(function(){
            location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
sms/';
        });
        
        $("#recipient_check_all, .check_recipient_groups").click(function(e){
                e.stopPropagation();
        });
        $('#mail-recipient-list #recipient_check_all').click(function () {
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);

            // $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            // $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });

        $('#mail-recipient-list #recipient_check_all_unsigned').click(function () {
            $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });


        $('#mail-recipient-list .check_recipient_groups').click(function () {
            $(this).parents('.mailing_group').find('li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });
        
        $('.open_as_reply_mode').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_group').html('');

            $('#mail-create-template #mail_attachment_old_group').addClass('hide');
            $('#mail-create-template #mail_attachment_group').removeClass('hide');

            var mail_id = $.trim($(this).attr('data-mail-id'));
            if(mail_id != ''){
                $('#mail-create-template #normal_to_wrpr').addClass('hide');
                $('#mail-create-template #reply_to_wrpr').removeClass('hide');
                $('#mail-create-template #operational_mail_id').val(mail_id);
                $('#mail-create-template #operational_mail_mode').val('1');
                
                var mail_category = $('#selected_mail_category').val();
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mail_actions.php",
                    data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);

                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_for_reply').val(data.mail_details.from_name);
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_id_for_reply').val(data.mail_details.from);
                                $('#mail-create-template #mail_send_subject').val('RE: '+data.mail_details.subject);
                                $('#mail-create-template #mail_send_body').val(data.mail_details.message);
                                $('#mail-create-template #mail_attachment_group').html('');
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#right_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-right");
                });
            }
        });
        
        $('.open_as_forward_mode').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_old_group, #mail-create-template #mail_attachment_group').html('');

            $('#mail-create-template #mail_attachment_old_group, #mail-create-template #mail_attachment_group').removeClass('hide');
            
            var mail_id = $.trim($(this).attr('data-mail-id'));
            if(mail_id != ''){
                $('#mail-create-template #normal_to_wrpr').removeClass('hide');
                $('#mail-create-template #reply_to_wrpr').addClass('hide');
                $('#mail-create-template #operational_mail_id').val(mail_id);
                $('#mail-create-template #operational_mail_mode').val('2');
                
                var mail_category = $('#selected_mail_category').val();
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mail_actions.php",
                    data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);

                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_for_reply').val(data.mail_details.from_name);
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_id_for_reply').val(data.mail_details.from);
                                $('#mail-create-template #mail_send_subject').val('FWD: '+data.mail_details.subject);
                                $('#mail-create-template #mail_send_body').val(data.mail_details.message);
                                $('#mail-create-template #mail_attachment_group').html('');
                                
                                if(data.attachments.length >0){
                                    var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                                <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12 no-padding">';
                                        $.each(data.attachments, function(i, value) {
                                            new_attachment_html += '<li class="list-group-item mb span12 no-ml no-min-height" style="padding-left: 0px;"><span class="span1 no-min-height"><input type="checkbox" checked="checked" value="'+value.replace(/'/g, "\'")+'" class="old_attachments"></span><span class="span11 no-ml no-min-height"> <a href="javascript:void(0);"  onclick="downloadFile(\''+value.replace(/'/g, "\'")+'\')"><i class="icon icon-download span1 no-min-height"></i><span class="span10 no-min-height down-file-name" title="'+value+'">'+value+'</span></a> </span></li>';
                                        });

                                        new_attachment_html += '</ul>';
                                        $("#mail-create-template #mail_attachment_old_group").html(new_attachment_html);
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
        });
    });
    
    function close_right_panel(){
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right #mail-create-template, .main-right .view-mail-visible, .main-right #mail-recipient-list").addClass('hide');
        $('.main-right #right_message_wraper, #left_message_wraper').html('');
    }
    
    function get_report(){
        $('#form').submit();
    }
    
    function downloadFile(filename){
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
download.php?<?php echo $_smarty_tpl->tpl_vars['mail_attachment_folder']->value;?>
"+filename;
    }
    
    function select_multi_recipients(){
        //var new_to_val = '';
        //if(old_to_val != '') new_to_val = old_to_val + ', ';
        
        var selected_recipients = $('#mail-recipient-list input:checkbox:checked.check_recipient_emp').map(function () {
            return this.value;
        }).get(); 
        
        if(selected_recipients.length == 0){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_user_selected'];?>
', function(result){ });
        }
        
        else{
            var old_to_val = $.trim($('#mail-create-template #mail_send_to').val());
            
            if(old_to_val != ''){
                var old_splitted = old_to_val.split(',');
                var old_splitted_array = [];
                $.each(old_splitted, function(i, el){
                                if($.trim(el) !== '') old_splitted_array.push($.trim(el));
                            });
                //console.log(old_splitted_array);
                selected_recipients = $.merge( old_splitted_array, selected_recipients );

            }
            //removing dublicate employee values from different customers
            var uniqueRecipients = [];
            $.each(selected_recipients, function(i, el){
                if($.inArray($.trim(el), uniqueRecipients) === -1) uniqueRecipients.push($.trim(el));
            });
            //console.log(uniqueRecipients);

            var new_to_val = uniqueRecipients.join(', ');
            $('#mail-create-template #mail_send_to').val(new_to_val);
            
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');
        }
    }
    
    function reset_form(){
        $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
        $('#mail-create-template #mail_attachment_group').html('');
    }
    
    function SendMail(){
        $('#right_message_wraper').html('');
        
        var operational_mail_id = '';
        var operational_mail_mode = $('#mail-create-template #operational_mail_mode').val();    //1-reply, 2-fwd, null-new
        var action = '';
                
        //var edit_note_id= $('.addnew-notes-box #edit_note_id').val();
        var mail_to     = '';
        
        if(operational_mail_mode == 1){
            mail_to     = $.trim($('#mail-create-template #mail_send_to_id_for_reply').val());
            operational_mail_id = $('#mail-create-template #operational_mail_id').val();
            action = 'reply';
        }else if(operational_mail_mode == 2){
            mail_to     = $.trim($('#mail-create-template #mail_send_to').val());
            operational_mail_id = $('#mail-create-template #operational_mail_id').val();
            action = 'forward';
        }else{
            var mail_to  = $.trim($('#mail-create-template #mail_send_to').val());
            action = 'new';
        }
        
        var mail_subject= $.trim($('#mail-create-template #mail_send_subject').val());
        var mail_body   = $.trim($('#mail-create-template #mail_send_body').val());

        var proceed_flag = true;

        if(mail_to == ''){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_mail_recipients'];?>
', function(result){ });
            $('#mail-create-template #mail_send_to').focus();
            proceed_flag = false;
        }
        else if(mail_subject == ''){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_mail_subject'];?>
', function(result){ });
            $('#mail-create-template #mail_send_subject').focus();
            proceed_flag = false;
        }
        else if(mail_body == ''){
            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_mail_message'];?>
', function(result){ });
            $('#mail-create-template #mail_send_body').focus();
            proceed_flag = false;
        }

        if(proceed_flag){
            var form_data = new FormData();  
            form_data.append('action', 'mail_send');
            form_data.append('sub_action', action);
            form_data.append('method', operational_mail_mode);     //1-reply, 2-forward
            form_data.append('to', mail_to);
            form_data.append('subject', mail_subject);
            form_data.append('mail_body', mail_body);
            form_data.append('id_mail', operational_mail_id);        //only for forward/replay modes
            //form_data.append('file_names', '');     //old attached file names (only for forward/replay modes)
            
            //set old files names
            if(operational_mail_mode == 2){
                
                var old_file_names_selected = [];
                $( "#mail-create-template #mail_attachment_old_group input:checkbox:checked.old_attachments" ).each(function( index, element ) {
                    if($(this).val() != ''){
                        old_file_names_selected.push($(this).val());
                    }
                });
                
                old_file_names_selected = old_file_names_selected.join(',');
                form_data.append('file_names', old_file_names_selected);
            }


            $( "#mail-create-template .mail_attach_file" ).each(function( index, element ) {
                if($(this).val() != ''){
                    var file_data = $(this).prop('files')[0];   
                    //process_data.attachments.push(file_data);
                    form_data.append('attachments[]', file_data);
                }
            });


            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_mail_actions.php",
                data    : form_data,
                dataType: 'json',
                type    :"POST",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success:function(data){
                        //console.log(data);
                        $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
                        $('#mail-create-template #mail_attachment_group').html('');

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
        }
    }

    function get_unsigned_employee(){
        var year = $("#unsigned_employee_year").val();
        var month = $("#unsigned_employee_month").val();
        if(year && month ){
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mail_list.php",
                type:"POST",
                dataType: 'json',
                data: { 'year': year, 'month': month, 'action': 'get_unsigned_employee'},
                success:function(data){
                    $('#unsignde_emp_div').empty();
                    if(data.status == true){
                        $('#employee_show').empty();
                        if(Object.keys(data.data).length > 0){
                            $.each(data.data , function (index, value){
                                var name = <?php echo $_smarty_tpl->tpl_vars['sort_by_name']->value;?>
 == 1 ? value.first_name+' '+value.last_name : value.last_name+' '+value.first_name ; 
                                $('#employee_show').append('<li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">\n\
                                        <label class="pull-left">'+name+'</label>\n\
                                        <input type="checkbox" class="pull-right check_recipient_emp" value="'+name+'('+index+')" >\n\
                                    </li>');
                             
                            });
                        }
                        else{
                            $('#employee_show').append('<div class= message><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>');
                        }
                    }
                }
            });
        }
        else{
            return false;
        }
        
    }
    
</script>

    </body>
</html><?php }} ?>