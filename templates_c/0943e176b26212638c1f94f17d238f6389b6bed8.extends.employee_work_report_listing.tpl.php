<?php /* Smarty version Smarty-3.1.8, created on 2021-03-24 11:26:18
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/employee_work_report_listing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1805433778603c7a815a8a66-17154064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0943e176b26212638c1f94f17d238f6389b6bed8' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/employee_work_report_listing.tpl',
      1 => 1616577581,
      2 => 'file',
    ),
    '155ef44d21124b6a12721a0ce0a1b854e2116a35' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/layouts/dashboard.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1805433778603c7a815a8a66-17154064',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_603c7a81927b24_64062002',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_603c7a81927b24_64062002')) {function content_603c7a81927b24_64062002($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.cycle.php';
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
<style type="text/css">
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    * html .ui-autocomplete {
        height: 200px;
    }
    .search_types {
            margin-top: 12px;
    }
    .search_selected {
            margin-top: 5px;
    }
    .customer_block, .employ_block, .selected_textfiled, .unsigned_rb_div {
            float: left;
            margin-right: 8px;
    }
    .padd_column {
            padding-left: 8px !important;
    }
    .txt_align_center {
            text-align: center;
    }
    .ui-autocomplete.ui-widget-content{ z-index: 5 !important;}
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
    <div class="tbl_hd"><span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_reporting'];?>
</span>
        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
reports/" class="back"><span class="btn_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a>
    </div>
    <div id="tble_list">
        <div class="option_strip clearfix" style="padding-bottom: 10px;">
            <form id="List_form" name="List_form" action="" method="post">
                <div class="workreportform_left"  style="float:inherit;">
                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:
                    <select name=cmb_year id=cmb_year>
                        <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['list_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values']->value),$_smarty_tpl);?>

                    </select>

                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
:<?php echo $_smarty_tpl->tpl_vars['list_month']->value;?>

                    <select name=cmb_month id=cmb_month>
                        <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</option>
                        <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_option_values']->value,'selected'=>intval($_smarty_tpl->tpl_vars['list_month']->value),'output'=>$_smarty_tpl->tpl_vars['month_option_output_full']->value),$_smarty_tpl);?>

                    </select>
                    <span style="padding-left: 15px"></span> 
                </div>
                <div class="search_types">
                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['search_with'];?>
</h1>
                    <div class="search_selected span12"  id="search_type_div" >
                        <div class="clearfix" style="padding-top: 3px; float: left;">
                            <div class="unsigned_rb_div" style="display: none;">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>checked="checked"<?php }?> id="rb_unsigned_emps" name="search_type" class="search_type" value="3" /></p>
                                    <p style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned_employees'];?>
</p>
                                </label>
                            </div>
                                    
                            <div class="customer_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?>checked="checked"<?php }?> id="search_type_customer" name="search_type" class="search_type" value="1" /></p>
                                    <p style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</p>
                                </label>
                            </div>
                            <div class="selected_textfiled search_type_customer_div" style="<?php if ($_smarty_tpl->tpl_vars['search_type']->value!='customer'||$_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>display: none;<?php }?>">
                                
                                <input type="text" id="txt_customer" name="txt_customer" value="<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?><?php echo $_smarty_tpl->tpl_vars['search_user_name']->value;?>
<?php }?>" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
"/>
                                <input type="hidden" id="customer-id" value="<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?><?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
<?php }?>"/>
                            </div>
                            
                            <div class="employ_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?>checked="checked"<?php }?> id="search_type_employee" name="search_type" class="search_type" value="2" /></p>
                                    <p style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</p>
                                </label>
                            </div>
                            <div  class="selected_textfiled search_type_employee_div" style="<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'||$_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>display: none;<?php }?>">
                                
                                <input type="text" id="txt_employee" name="txt_employee" value="<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?><?php echo $_smarty_tpl->tpl_vars['search_user_name']->value;?>
<?php }?>" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
"/>
                                <input type="hidden" id="employee-id" value="<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?><?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
<?php }?>"/>
                            </div>
                            <div class="selected_textfiled search_type_customer_div" style="margin-left: 25px;<?php if ($_smarty_tpl->tpl_vars['search_type']->value!='customer'||$_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>display: none;<?php }?>">
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
                                        <label>
                                            <p style="float: left;"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['flag_show_previous_connections']->value=='Y'){?>checked="checked"<?php }?> id="show_prev_emps" style="margin-right: 3px;"/></p>
                                            <p style="float: left; width: 282px;margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['show_all_connected_employees'];?>
</p>
                                        </label>
                                    <?php }?>
                            </div>
                            <div  class="selected_textfiled search_type_employee_div" style="margin-left: 25px;<?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'||$_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>display: none;<?php }?>">
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
                                        <label>
                                            <p style="float: left;"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['flag_show_previous_connections']->value=='Y'){?>checked="checked"<?php }?> id="show_prev_custs" style="margin-right: 3px;"/></p>
                                            <p style="float: left; width: 272px;margin-left: 5px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['show_all_connected_customers'];?>
</p>
                                        </label>
                                    <?php }?>
                                
                            </div>
                        </div>
                            
                        <span style="margin: 0 3px 0 2px;">
                            <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['get'];?>
" onclick="getList();"/>
                        </span> 
                    </div>
                </div>
            </form>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['request_access']->value){?>
            <div class="pagention span12 no-ml clearfix">
                <?php if ($_smarty_tpl->tpl_vars['search_type']->value!='unsigned'){?>
                    <?php $_smarty_tpl->tpl_vars['alphabets'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['translate']->value['alphabets']), null, 0);?>
                    <div class="alphbts">
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['alphabets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                <li><a href="javascript:void(0)" onclick="select_employee('<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
')"><?php echo $_smarty_tpl->tpl_vars['row']->value;?>
</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }?>
                <div class="pagention_dv clearfix"><div class="pagination clearfix no-mt no-mb"><ul id="pagination"><?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
</ul></div></div>
            </div>
            
            <?php if ($_smarty_tpl->tpl_vars['search_type']->value!='unsigned'){?>
                <table class="table_list work_report" style="width:100%">
                    <tbody>
                        <tr>
                            <th height="50" colspan="<?php if ($_smarty_tpl->tpl_vars['list_month']->value==''){?>13<?php }else{ ?>6<?php }?>"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['total_records']).(': ')).($_smarty_tpl->tpl_vars['total_records_count']->value);?>
 /<?php echo $_smarty_tpl->tpl_vars['total_records_count_including_connected']->value;?>
</th>
                        </tr>
                        <tr>
                            <th height="50"><?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
<?php }elseif($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
<?php }?></th>
                            <?php  $_smarty_tpl->tpl_vars['title_months'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title_months']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['month_option_output_short']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title_months']->key => $_smarty_tpl->tpl_vars['title_months']->value){
$_smarty_tpl->tpl_vars['title_months']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['title_months']->key;
?>
                                <?php if ($_smarty_tpl->tpl_vars['list_month']->value==''||($_smarty_tpl->tpl_vars['list_month']->value!=''&&$_smarty_tpl->tpl_vars['list_month']->value==$_smarty_tpl->tpl_vars['k']->value+1)){?>
                                <th ><?php echo $_smarty_tpl->tpl_vars['title_months']->value;?>
</th>
                                <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['list_month']->value!=''){?>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['total_working_days'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_sum_ord'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_sum_jour'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['work_sum'];?>
</th>
                            <?php }?>
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['full_entry_list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['full_entry_list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['full_entry_list']->key => $_smarty_tpl->tpl_vars['full_entry_list']->value){
$_smarty_tpl->tpl_vars['full_entry_list']->_loop = true;
?>  
                            <tr class="<?php echo smarty_function_cycle(array('values'=>"even usertd,odd usertd"),$_smarty_tpl);?>
">
                                <td height="38" class="usertdname" <?php if ($_smarty_tpl->tpl_vars['list_month']->value!=''){?>style="padding-left: 15px;"<?php }?>><span class="workreport_name"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['first_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['last_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['first_name'];?>
<?php }?></span></td>

                                <?php  $_smarty_tpl->tpl_vars['signing_month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['signing_month']->_loop = false;
 $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['full_entry_list']->value['Sign_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['signing_month']->key => $_smarty_tpl->tpl_vars['signing_month']->value){
$_smarty_tpl->tpl_vars['signing_month']->_loop = true;
 $_smarty_tpl->tpl_vars['m']->value = $_smarty_tpl->tpl_vars['signing_month']->key;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['list_month']->value==''||($_smarty_tpl->tpl_vars['list_month']->value!=''&&$_smarty_tpl->tpl_vars['list_month']->value==$_smarty_tpl->tpl_vars['m']->value)){?>
                                        <?php if ($_smarty_tpl->tpl_vars['list_year']->value<$_smarty_tpl->tpl_vars['now_year']->value||($_smarty_tpl->tpl_vars['m']->value<=$_smarty_tpl->tpl_vars['now_month']->value&&$_smarty_tpl->tpl_vars['list_year']->value==$_smarty_tpl->tpl_vars['now_year']->value)){?>
                                            <td <?php if ($_smarty_tpl->tpl_vars['list_month']->value!=''){?>style="text-align: center;"<?php }?>>
                                                <?php if ($_smarty_tpl->tpl_vars['full_entry_list']->value['have_work'][$_smarty_tpl->tpl_vars['m']->value]==1){?>
                                                   
                                                    <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['username'];?>
/<?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
/">
                                                    <?php }elseif($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['username'];?>
/">
                                                    <?php }else{ ?>
                                                        <a href="#">
                                                    <?php }?>
                                                           
                                                    <?php if ($_smarty_tpl->tpl_vars['signing_month']->value['signin_employee']!=''){?>
                                                        <span class="userlevel_1" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_employee_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_date'];?>
"><?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_employee'];?>
1</span>
                                                    <?php }else{ ?>
                                                        <span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span>
                                                    <?php }?>
                                                   
                                                    <?php if ($_smarty_tpl->tpl_vars['signing_month']->value['signin_tl']!=''){?>
                                                        <span class="userlevel_1" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_tl_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_tl_date'];?>
"><?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_tl'];?>
2</span>
                                                    <?php }else{ ?>
                                                        <span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['signing_month']->value['signin_sutl']!=''){?>
                                                        <span class="userlevel_1" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_sutl_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_sutl_date'];?>
"><?php echo $_smarty_tpl->tpl_vars['signing_month']->value['signin_sutl'];?>
3</span>
                                                    <?php }else{ ?>
                                                        <span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span>
                                                    <?php }?>
                                                    
                                                    </a>
                                                    
                                                <?php }else{ ?>
                                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_work'];?>
</span>
                                                <?php }?>
                                            </td>
                                        <?php }else{ ?>
                                            <td <?php if ($_smarty_tpl->tpl_vars['list_month']->value!=''){?>style="text-align: center;"<?php }?>>
                                                <?php if ($_smarty_tpl->tpl_vars['full_entry_list']->value['have_work'][$_smarty_tpl->tpl_vars['m']->value]==1){?>
                                                    <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['username'];?>
/<?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
/">
                                                    <?php }elseif($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['username'];?>
/">
                                                    <?php }else{ ?>
                                                        <a href="#">
                                                    <?php }?>
                                                            <span class="userlevel_1">- - - - </span>
                                                            <span class="userlevel_2">- - - - -  </span>
                                                            <span class="userlevel_3">- - - - - - </span>
                                                        </a>
                                                <?php }else{ ?>
                                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_work'];?>
</span>
                                                <?php }?>
                                            </td>
                                        <?php }?>
                                    <?php }?>
                                <?php }
if (!$_smarty_tpl->tpl_vars['signing_month']->_loop) {
?>
                                    <td></td>
                                <?php } ?>
                                
                                <?php if ($_smarty_tpl->tpl_vars['list_month']->value!=''){?>
                                    <th><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['work_hours']['total_working_days'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['work_hours']['total_normal'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['work_hours']['total_oncall'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['full_entry_list']->value['work_hours']['total'];?>
</th>
                                <?php }?>
                            </tr>
                        <?php }
if (!$_smarty_tpl->tpl_vars['full_entry_list']->_loop) {
?>
                            <tr><td colspan="<?php if ($_smarty_tpl->tpl_vars['list_month']->value==''){?>13<?php }else{ ?>6<?php }?>"><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }else{ ?>
                <table class="table_list work_report no-ml table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <th width="113" height="50" colspan="1" style="text-align: center;"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['not_signed_employee_count']).(': ')).($_smarty_tpl->tpl_vars['not_signed_employee_count']->value);?>
</th>
                            <th width="113" height="50" colspan="1" style="text-align: center;"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['not_signed_gl_count']).(': ')).($_smarty_tpl->tpl_vars['not_signed_gl_count']->value);?>
</th>
                            <th width="113" height="50" colspan="2" style="text-align: center;"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['not_signed_admin_count']).(': ')).($_smarty_tpl->tpl_vars['not_signed_admin_count']->value);?>
</th>
                            <th width="113" height="50" colspan="1" style="text-align: center;"><?php echo (($_smarty_tpl->tpl_vars['translate']->value['total_records']).(': ')).($_smarty_tpl->tpl_vars['total_records_count']->value);?>
</th>
                        </tr>
                        <tr>
                            <th width="150px" height="50" rowspan="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</th>
                            <th width="150px" height="50" rowspan="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</th>
                            <th colspan="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['signed_by'];?>
</th>
                        </tr>
                        <tr>
                            <th width='15%'><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_wr'];?>
</th>
                            <th width='15%'><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl_wr'];?>
</th>
                            <th width='15%'><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl_wr'];?>
</th>
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['employees'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employees']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employees']->key => $_smarty_tpl->tpl_vars['employees']->value){
$_smarty_tpl->tpl_vars['employees']->_loop = true;
?>  
                            <tr class="<?php echo smarty_function_cycle(array('values'=>"even usertd,odd usertd"),$_smarty_tpl);?>
">
                                <?php $_smarty_tpl->tpl_vars['customers_count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['employees']->value['customers']), null, 0);?>
                                <td height="38" class="padd_column usertdname" rowspan="<?php echo $_smarty_tpl->tpl_vars['customers_count']->value;?>
"><span class="workreport_name"><?php echo $_smarty_tpl->tpl_vars['employees']->value['employee_details']['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employees']->value['employee_details']['first_name'];?>
</span></td>

                                <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['employees']->value['customers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['customer']->key;
?>
                                    <td height="38" class="padd_column usertdname"><span class="workreport_name"><?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
</span></td>
                                    <td class="txt_align_center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['list_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employees']->value['employee_details']['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value['user_name'];?>
/">
                                            <?php if ($_smarty_tpl->tpl_vars['customer']->value['signing_details']['employee']!=''){?><span class="userlevel_1"><?php echo $_smarty_tpl->tpl_vars['customer']->value['signing_details']['employee'];?>
</span><?php }else{ ?><span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span><?php }?>
                                        </a>
                                    </td>
                                    <td class="txt_align_center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['list_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employees']->value['employee_details']['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value['user_name'];?>
/">
                                            <?php if ($_smarty_tpl->tpl_vars['customer']->value['signing_details']['tl']!=''){?><span class="userlevel_1"><?php echo $_smarty_tpl->tpl_vars['customer']->value['signing_details']['tl'];?>
</span><?php }else{ ?><span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span><?php }?>
                                        </a>
                                    </td>
                                    <td class="txt_align_center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/detail/new/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['list_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employees']->value['employee_details']['user_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value['user_name'];?>
/">
                                            <?php if ($_smarty_tpl->tpl_vars['customer']->value['signing_details']['sutl']!=''){?><span class="userlevel_1"><?php echo $_smarty_tpl->tpl_vars['customer']->value['signing_details']['sutl'];?>
</span><?php }else{ ?><span class="userlevel_2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsigned'];?>
</span><?php }?>
                                        </a>
                                    </td>
                                    <?php if ($_smarty_tpl->tpl_vars['k']->value+1<$_smarty_tpl->tpl_vars['customers_count']->value){?></tr><tr class="<?php echo smarty_function_cycle(array('values'=>"even usertd,odd usertd"),$_smarty_tpl);?>
"><?php }?>
                                <?php }
if (!$_smarty_tpl->tpl_vars['customer']->_loop) {
?>
                                    <td></td><td></td><td></td><td></td>
                                <?php } ?>
                            </tr>
                        <?php }
if (!$_smarty_tpl->tpl_vars['employees']->_loop) {
?>
                            <tr><td colspan="5"><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }?>
        <?php }?>
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
    
<script type="text/javascript">
    

function select_employee(alpha){
    <?php if ($_smarty_tpl->tpl_vars['search_user_id']->value!=''){?>
        var search_type = '';
        <?php if ($_smarty_tpl->tpl_vars['search_type']->value=='customer'){?>
            search_type = '1';
        <?php }elseif($_smarty_tpl->tpl_vars['search_type']->value=='employee'){?>
            search_type = '2';
        <?php }elseif($_smarty_tpl->tpl_vars['search_type']->value=='unsigned'){?>
            search_type = '3';
        <?php }?>
        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/list/<?php echo $_smarty_tpl->tpl_vars['list_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month_pg_label']->value;?>
/'+search_type+'/<?php echo $_smarty_tpl->tpl_vars['search_user_id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['flag_show_previous_connections']->value;?>
/'+alpha+'/';
    <?php }?>
}



function getList(){
    var year = $("#cmb_year").val();
    var month_selected = $("#cmb_month").val();
    var month_label = 'M-'+ month_selected;
    
    var search_type = "";
    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
    if (search_type_rd.length > 0)
        search_type = search_type_rd.val();
    
    var search_user_id = '';
    var search_user_name = '';
    var prev_connection_flag = 'N';
    if(search_type == 1){
        search_user_id = $.trim($("#customer-id").val());
        search_user_name = $.trim($("#txt_customer").val());
        prev_connection_flag = $("input:checkbox:checked#show_prev_emps").val();
        if(typeof prev_connection_flag == 'undefined' || prev_connection_flag != 'Y')
            prev_connection_flag = 'N';
    }else if(search_type == 2){
        search_user_id = $.trim($("#employee-id").val());
        search_user_name = $.trim($("#txt_employee").val());
        prev_connection_flag = $("input:checkbox:checked#show_prev_custs").val();
        if(typeof prev_connection_flag == 'undefined' || prev_connection_flag != 'Y')
            prev_connection_flag = 'N';
    }
    
    if(search_type == ''){
        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_a_search_type'];?>
');
    } else if(search_type == 3){
        if(year == '')
            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_year'];?>
');
        else if(month_label == 'M-')
            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
');
        else
            window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/list/'+year+'/'+month_label+'/'+search_type+'/-/';
        
    } else if(search_user_name == '' && (search_type == 1 || search_type == 2)){
        if(search_type == 1){
            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_customer'];?>
');
            $("#txt_customer").focus();
        }else if(search_type == 2){
            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
            $("#txt_employee").focus();
        }
    } else if(search_user_name != "" && search_user_id != "" && typeof(search_user_id) != 'undefined'){
        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/list/'+year+'/'+month_label+'/'+search_type+'/'+search_user_id+'/'+prev_connection_flag+'/';
    } else{
        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_search_values'];?>
');
        //window.location.href = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
report/work/employee/list/'+year+'/'+month_label+'/1/';
    }
}

function form_submit(){
    $("#sign_form").submit();
}

$(function() {
        var availableCustomers = [
            <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>  
                    <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                        {
                        value: "<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
",
                        label: "<?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
"
                        },
                    <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                        {
                        value: "<?php echo $_smarty_tpl->tpl_vars['customer']->value['username'];?>
",
                        label: "<?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
"
                        },
                    <?php }?>
            <?php } ?>
        ];
        var availableEmployees = [
            <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>  
                    <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                        {
                        value: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
",
                        label: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
"
                        },
                    <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                        {
                        value: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
",
                        label: "<?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
"
                        },
                    <?php }?>
            <?php } ?>
        ];
        console.log(availableEmployees);
        $( "#txt_customer" ).autocomplete({
            minLength: 0,
            source: availableCustomers,
            focus: function( event, ui ) {
                $( "#txt_customer" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#txt_customer" ).val( ui.item.label );
                $( "#customer-id" ).val( ui.item.value );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };
        
        $( "#txt_employee" ).autocomplete({
            minLength: 0,
            source: availableEmployees,
            focus: function( event, ui ) {
                $( "#txt_employee" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#txt_employee" ).val( ui.item.label );
                $( "#employee-id" ).val( ui.item.value );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };

        $.extend( $.ui.autocomplete, {
            escapeRegex: function( value ) {
                return value.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
            },
            filter: function(array, term) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
                return $.grep( array, function(value) {
                    return (matcher.test( value.label ) || matcher.test(value.value));
                });
            }
        });
        
        $('#search_type_div').delegate('.search_type', 'change', function () {
                var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                if (search_type_rd.length > 0)
                    search_type = search_type_rd.val();

                if(search_type == 1){   
                    $('.search_type_customer_div').css('display', 'block');
                    $('.search_type_employee_div').css('display', 'none');
                    $('#txt_customer').focus();
                }else if(search_type == 2){ 
                    $('.search_type_employee_div').css('display', 'block');
                    $('.search_type_customer_div').css('display', 'none');
                    $('#txt_employee').focus();
                }else if(search_type == 3){ 
                    $('.search_type_employee_div').css('display', 'none');
                    $('.search_type_customer_div').css('display', 'none');
                }
        });
        
        $('#cmb_month').change(function () {
                if($("#cmb_month").val() != '')
                    $('.unsigned_rb_div').css('display', 'block');
                else{
                    $('.unsigned_rb_div').css('display', 'none');
                    
                    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                    if (search_type_rd.length > 0)
                        search_type = search_type_rd.val();
                    if(search_type == 3) 
                        $('#search_type_customer').trigger('click');
                }
        });
        
        if($("#cmb_month").val() != ''){
            $('.unsigned_rb_div').css('display', 'block');
        }
        $(function () {
            $("#cmb_month").change();
        });

        $('input').keypress(function (e) {
          if (e.which == 13) {
            getList();
            return false;    //<---- Add this line
          }
        });_
    });
</script>

    </body>
</html><?php }} ?>