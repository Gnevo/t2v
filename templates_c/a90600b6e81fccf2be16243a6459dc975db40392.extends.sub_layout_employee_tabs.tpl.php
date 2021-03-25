<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 09:19:50
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/sub_layout_employee_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7022696235fcdf3b6efb154-23602189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a90600b6e81fccf2be16243a6459dc975db40392' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/sub_layout_employee_tabs.tpl',
      1 => 1588177878,
      2 => 'file',
    ),
    '43db775ede5ee328688121d5c377d247650ee3ae' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/employment_contract_pdf_form.tpl',
      1 => 1547883282,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7022696235fcdf3b6efb154-23602189',
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
  'unifunc' => 'content_5fcdf3b741bae1_18837423',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcdf3b741bae1_18837423')) {function content_5fcdf3b741bae1_18837423($_smarty_tpl) {?><!DOCTYPE html>
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
            <div class="span12 main-left">
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_profile'];?>
</h1>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <?php if ($_smarty_tpl->tpl_vars['employee_username']->value!=''){?>
                        <div class="widget option-panel-widget" style="margin: 0 !important;">
                            <div class="widget-body" >
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
                                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract'];?>
</h1>
                                    </div>
                                       <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                           <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick='backForm()'><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm()"><span class="icon-print"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="newContract()"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
</button>
                                       </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        
                           <div class="tab-content-con boxscroll">
                                
                               <div class="tab-content span12" style="margin:0;">
                                   <div role="tabpanel" class="tab-pane active" id="tab-2">
                                       <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['date_from']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
/<?php }?>" style="float:left; width:100%;">
                                           <input type="hidden" name="action" id="action" value="" />
                                           <input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
" />
                                           <input type="hidden" name="hiden_val" id="hiden_val" value="" />
                                           <input type="hidden" name="social_flag" id="social_flag" value="" />
                                           <input type="hidden" name="new" id="new" value="" />
                                           <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                           <div class="tab-content span12" style="margin:0; padding: 0;">

                                               <div style="" class="span12 widget-body-section input-group">
                                                    <div class="row-fluid no-min-height">
                                                        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                                                    </div>
                                                   <div class="row-fluid">
                                                       <div style="padding: 0px;" class="span12 widget-body-section">
                                                           <div class="span6 form-left">
                                                               <label style="float: left;" class="span12" for="date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_contract'];?>
</label>
                                                               <div style="margin-left: 0px; float: left;">
                                                                   <div class="input-prepend span10">
                                                                       <span class="add-on icon-pencil"></span>
                                                                       <select class="form-control span12" name="date" id="date" onchange="load_documentation()">
                                                                           <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                                           <?php  $_smarty_tpl->tpl_vars['date'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['date']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['date']->key => $_smarty_tpl->tpl_vars['date']->value){
$_smarty_tpl->tpl_vars['date']->_loop = true;
?>
                                                                               <option value="<?php echo $_smarty_tpl->tpl_vars['date']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['date']->value['id']==$_smarty_tpl->tpl_vars['date_from']->value){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['date']->value['date_from'];?>
 <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['date']->value['customer_first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['date']->value['customer_last_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['date']->value['customer_last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['date']->value['customer_first_name'];?>
<?php }?></option>
                                                                           <?php } ?>
                                                                       </select>
                                                                       <?php if ($_smarty_tpl->tpl_vars['contracts']->value['sign_date']!=''||$_smarty_tpl->tpl_vars['contracts']->value['sign_date']!=null){?>
                                                                           <button class="btn btn-default btn-normal" type="button" name="remove_sign" id="remove_sign" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_sign'];?>
" style="float: right;margin-right: 40px;margin-top: 10px;" onclick="removeSign('<?php echo $_smarty_tpl->tpl_vars['contracts']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_sign'];?>
</button>
                                                                       <?php }?>
                                                                   </div>
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>&Ouml;verenskommelse har tr&auml;ffats om:</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div class="span12 widget-body-section input-group">
                                                                        <div class="span12">
                                                                            <ol class="radio-group span12 no-ml" style="float:left; width: 100%;">
                                                                               <li class="span12 no-ml"><input name="have_been_agreed" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['have_been_agreed']!=2){?>checked="checked"<?php }?> onclick="makeChange()" type="radio"><label class="label-option-and-checkbox">ny anställning</label></li>
                                                                               <li class="span12 no-ml"><input name="have_been_agreed" value="2" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['have_been_agreed']==2){?>checked="checked"<?php }?> onclick="makeChange()" type="radio"><label class="label-option-and-checkbox">ändrade anställningsvillkor</label></li>
                                                                           </ol>
                                                                        </div>
                                                                        <div class="span12 no-ml">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtOverenskommelseBefDatum">&Auml;ndrade anst&auml;llningsvillkor fr o m</label>
                                                                               <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker datepicker span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtOverenskommelseBefDatum" id="txtOverenskommelseBefDatum" type="text" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['date_from'];?>
" onchange="makeChange()" autocomplete="off" /> 
                                                                               </div>
                                                                               <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker datepicker span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to_date'];?>
" class="form-control span8" name="to_date" id="to_date" type="text" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['date_to'];?>
" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>B. Arbetsuppgifter/arbetsplats</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="margin: 10px 0px 10px 14px;" class="span12">
                                                                       <label style="float: left;" class="span12" for="exampleInputEmail1"><strong>Personlig assistent f&ouml;r brukaren d&auml;r brukare befinner sig</strong> </label>
                                                                   </div>
                                                                   <div class="span12 widget-body-section input-group" style="padding: 5px 15px ! important;">
                                                                       <table class="table table-bordered" style="width: 100%; margin:10px 0 10px 0">
                                                                           <thead>
                                                                               <tr>
                                                                                    <th style="width: 10%;">&nbsp;</th>
                                                                                    <th style="width: 55%;">Namn</th>
                                                                                    <th style="width: 35%;">Personnummer</th>
                                                                               </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                               <?php  $_smarty_tpl->tpl_vars['assigned'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['assigned']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['assigned_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['assigned']->key => $_smarty_tpl->tpl_vars['assigned']->value){
$_smarty_tpl->tpl_vars['assigned']->_loop = true;
?>
                                                                                   <tr>
                                                                                        <td><input type="radio" name="customer_group" value="<?php echo $_smarty_tpl->tpl_vars['assigned']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['customer_name']==$_smarty_tpl->tpl_vars['assigned']->value['username']){?>checked="checked"<?php }?> onchange="makeChange()"/></td>
                                                                                        <td>
                                                                                           <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['assigned']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['assigned']->value['last_name'];?>

                                                                                           <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['assigned']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['assigned']->value['first_name'];?>
<?php }?>
                                                                                        </td>
                                                                                        <td><?php echo $_smarty_tpl->tpl_vars['assigned']->value['century'];?>
<?php echo substr_replace($_smarty_tpl->tpl_vars['assigned']->value['social_security'],'-',6,0);?>
</td>
                                                                                   </tr>
                                                                               <?php } ?>
                                                                           </tbody>
                                                                       </table>
                                                                       <ol class="radio-group">
                                                                               <li>
                                                                                   <input name="other_customer" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['other_customer']=='1'){?> checked="checked"<?php }?> onchange="makeChange()"  type="checkbox" style="margin: 3px 5px 0px 0px !important;" class="pull-left" />
                                                                                   <label class="label-option-and-checkbox label-phone"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['other_customer'];?>
</label>
                                                                               </li>
                                                                           </ol>
                                                                       <input type="hidden" name="txtnamn" id="txtnamn" style="width:320px" value="<?php echo $_smarty_tpl->tpl_vars['cust_name']->value;?>
" onblur="checkSocialSecuroty()" onchange="makeChange()"/>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top: 0px; margin-bottom: 0px ! important;">
                                                                   <div class="widget-header span12">
                                                                       <h1>C. Anst&auml;llningsform, upps&auml;gningstider och kollektivavtal</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="margin: 10px 0px 10px 15px;" class="span12">
                                                                       <label style="float: left;" class="span12" for="exampleInputEmail1"><strong>Tidsbegr&auml;nsad anst&auml;llning</strong> </label>
                                                                   </div>
                                                                   <div style="padding: 5px 0px 15px 15px ! important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">

                                                                           <ol class="radio-group">
                                                                               <li>
                                                                                   <input name="assistanceChecked" id="chkAnstFormVisstid" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['assistanceChecked']=='1'){?> checked="checked"<?php }?> onchange="makeChange()"  type="checkbox" style="margin: 3px 5px 0px 0px !important;" class="pull-left" />
                                                                                   <label class="label-option-and-checkbox label-phone"> F&ouml;r viss tid s&aring; l&auml;nge assistens-uppdraget varar</label>
                                                                               </li>
                                                                           </ol>


                                                                       </div>
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVisstidFrom" type="text" id="txtAnstFormVisstidFrom" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['tmp_long_assistance_from'];?>
" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">eventuellt längst t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVisstidTom" type="text" id="txtAnstFormVisstidTom" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['tmp_long_assistance_to'];?>
" onchange="makeChange()" autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="padding: 15px 0px 15px 15px ! important;" class="span12 widget-body-section input-group">
                                                                       <div class="span3">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label class="checkbox checkbox-inline" style="margin: 0px; padding: 0px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkAnstFormVikarieFor" type="checkbox" id="chkAnstFormVikarieFor" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['tmp_assistance_for']!=''){?>checked="checked"<?php }?> onchange="makeChange()" /> Vikarie för:
                                                                               </label>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span9">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                   <input class="form-control span11" name="txtAnstFormVikarieNamn" type="text" id="txtAnstFormVikarieNamn" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['tmp_assistance_for'];?>
" onchange="makeChange()" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="span12 widget-body-section input-group">
                                                                       <div class="span12"> under dennes frånvaro </div>
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtAnstFormVikarieFranvaroFrom">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVikarieFranvaroFrom" type="text" id="txtAnstFormVikarieFranvaroFrom" size="12" value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['absence_from']!='0000-00-00'){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['absence_from'];?>
<?php }?>" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtAnstFormVikarieFranvaroTom">längst t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVikarieFranvaroTom" type="text" id="txtAnstFormVikarieFranvaroTom" size="12" value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['absence_to']!='0000-00-00'){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['absence_to'];?>
<?php }?>"  onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="padding-top: 10px;" class="span12 widget-body-section input-group">
                                                                       <div style="" class="span12">

                                                                           <ol class="radio-group span12 no-ml">
                                                                               <li style="margin-bottom: 5px;" class="span12 no-ml">
                                                                                   <input type="radio" name="assistance" value="2" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['employmentType']=="2"){?> checked="checked" <?php }?> onclick="makeChange()"  />
                                                                                   <label class="label-option-and-checkbox"> För särskilt avtalade tillfällen sk. Timanställning </label>(se bilaga)
                                                                               </li>
                                                                               <li style="margin-bottom: 6px;" class="span12 no-ml">
                                                                                   <input type="radio" name="assistance" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['employmentType']=="1"){?> checked="checked" <?php }?> onclick="makeChange()"  />
                                                                                   <label class="label-option-and-checkbox"> Provanställning </label>
                                                                               </li>
                                                                           </ol>


                                                                       </div>
                                                                       <!-- <div class="row-fluid">Provanställning</div> -->
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormProvanstallningFrom" type="text" id="txtAnstFormProvanstallningFrom" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['probationary_from'];?>
" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormProvanstallningTom" type="text" id="txtAnstFormProvanstallningTom" size="12" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['probationary_to'];?>
" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="" class="span12 widget-body-section input-group">
                                                                       <div class="span12">Endast i samband med Tillsvidareanställning</div>
                                                                       <label class="checkbox checkbox-inline" style="padding-left:0 !important;">
                                                                           <input style="margin: 3px 5px 0px 0px ! important;" name="chkAnstFormTillsvidareanstallning" type="checkbox" id="chkAnstFormTillsvidareanstallning" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['open_ended_appointment']!=''&&$_smarty_tpl->tpl_vars['contracts']->value['open_ended_appointment']!='0'){?> checked="checked" <?php }?> onclick="makeChange()" /> Tillsvidareanställning Tillträdesdag </label>
                                                                       <div class="row-fluid">
                                                                           <div style="margin: 10px 0 0 0;" class="span12">
                                                                               <div style="margin: 0px;" class="input-prepend span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control date hasDatepicker datepicker span8" name="txtAnstFormTillsvidareanstallningTilltradesdag" type="text" id="txtAnstFormTillsvidareanstallningTilltradesdag" size="10" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['prevailing_collective'];?>
" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div style="padding: 10px 0px 0px;" class="span12 widget-body-section">
                                                                           <div class="span12">
                                                                               <div style="margin: 0px;" class="span12">
                                                                                   <label style="float: left;" class="span12" for="txtAnstFormTillsvidareanstallningTilltradesdag">Uppsägningstid: enligt vid var tid gällande kollektivavtal</label>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                           </div>
                                                           <div class="span6 form-right">
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>D. Arbetstid, lön (se gällande kollektivavtal)</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="" class="span12">
                                                                           <div class="span12" style="margin:0 0 5px 0;">

                                                                               <ol class="para-inputs-list">

                                                                                   <li>         
                                                                                       <ol class="radio-group" style="float:left;">
                                                                                           <li>
                                                                                               <input name="work_type" type="radio" id="chkArbetstidHeltid" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['fulltime']==1||$_smarty_tpl->tpl_vars['date_from']->value==''){?> checked="checked" <?php }?> onclick="makeChange()"  /><label class="label-option-and-checkbox">Heltid</label>
                                                                                           </li>
                                                                                       </ol>
                                                                                       <!-- <div  class="input-prepend pull-left"> 
                                                                                           <input class="form-control span12" name="normal_week_hr" type="text" id="normal_week_hr" size="4" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['fulltime']!=2){?> value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['hour']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['hour'];?>
<?php }?>"<?php }else{ ?>value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['normal_week_hr']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['normal_week_hr'];?>
<?php }?>"<?php }?> onchange="makeChange()" /> 
                                                                                       </div> -->
                                                                                       <label class="radio pull-left" style="margin:0px 5px;">40 tim i genomsnitt per vecka &nbsp;&nbsp;&nbsp;&nbsp;</label>

                                                                                       <!-- <div  class="input-prepend pull-left"> 
                                                                                           <input class="form-control span12" name="oncall_hr" type="text" id="oncall_hr" size="4" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['fulltime']!=2){?>value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['monthly_oncall_hour']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['monthly_oncall_hour'];?>
<?php }?>"<?php }else{ ?>value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['oncall_week_hr']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['oncall_week_hr'];?>
<?php }?>"<?php }?> onchange="makeChange()" /> 
                                                                                       </div>
                                                                                       <label class="radio" style="margin:0px 0 10px 0;"> &nbsp;tim jour per månad</label></li> -->
                                                                               </ol>
                                                                           </div>
                                                                       </div>

                                                                       <div class="span12" style="margin:0 0 5px 0">
                                                                           <?php $_smarty_tpl->tpl_vars['part'] = new Smarty_variable(explode(".",$_smarty_tpl->tpl_vars['contracts']->value['part_time']), null, 0);?>


                                                                           <ol class="para-inputs-list">
                                                                               <li>  
                                                                                   <ol class="radio-group" style="width: 100%;">
                                                                                       <li>
                                                                                           <input name="work_type" type="radio" id="chkArbetstidDeltid" value="2" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['fulltime']==2){?>checked="checked"<?php }?> onclick="makeChange()"  /><label class="label-option-and-checkbox">Deltid</label>
                                                                                       </li>
                                                                                   </ol><br/>
                                                                                   <div class="input-prepend pull-left">
                                                                                       <input class="form-control span12" name="txtArbetstidDeltidTim" type="text" id="txtArbetstidDeltidTim" size="4" maxlength="2" value="<?php if ($_smarty_tpl->tpl_vars['part']->value[0]>0){?><?php echo $_smarty_tpl->tpl_vars['part']->value[0];?>
<?php }?>" onchange="makeChange()" /> 
                                                                                   </div>
                                                                                   <label class="radio pull-left"  style="margin:0">&nbsp;tim&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                   <div class="input-prepend pull-left"> 
                                                                                       <input class="form-control span12" name="txtArbetstidDeltidMin" type="text" id="txtArbetstidDeltidMin" size="4" maxlength="2" value="<?php if ($_smarty_tpl->tpl_vars['part']->value[1]>0){?><?php echo $_smarty_tpl->tpl_vars['part']->value[1];?>
<?php }?>" onchange="makeChange()" /> 
                                                                                   </div>
                                                                                   <label class="radio pull-left" style="margin:0;">&nbsp;min &nbsp;&nbsp;i genomsnitt per vecka&nbsp;</label> 
                                                                               </li>
                                                                           </ol>                                   
                                                                       </div>


                                                                       <div style="margin: 0px; margin-top: 20px;" class="input-prepend span12"> 
                                                                           <label style="float: left; margin: 0px 10px 0 0;" for="txtArbetstidLonPerManad">Lön vid anställningstillfället</label>
                                                                       </div>
                                                                       <div style="margin: 0px;" class="input-prepend span12">
                                                                           <input style="float: left;" class="form-control span3" name="txtArbetstidLonPerManad" type="text" id="txtArbetstidLonPerManad" size="15" value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['salary_month']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['salary_month'];?>
<?php }?>" onchange="makeChange()" />
                                                                           <label style="float: left;" for="txtArbetstidLonPerTimme">&nbsp;&nbsp;kronor per månad</label>
                                                                       </div>
                                                                       <div style="margin: 0px;" class="input-prepend span12">                                                                   
                                                                           <input style="float: left;" class="form-control span3" name="txtArbetstidLonPerTimme" type="text" id="txtArbetstidLonPerTimme" size="15" value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['salary_hour']>0){?><?php echo $_smarty_tpl->tpl_vars['contracts']->value['salary_hour'];?>
<?php }?>" onchange="makeChange()" />
                                                                           <label style="float: left;" for="txtArbetstidLonPerTimme">&nbsp;&nbsp;kronor per timme</label>
                                                                       </div>


                                                                       <div style="margin:0 0 5px 0" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span4">
                                                                               <input style="float: left; margin-top: 4px !important;" name="chkArbetstidLonInklSemLon" type="checkbox" id="chkArbetstidLonInklSemLon" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['incl_salary']!=''&&$_smarty_tpl->tpl_vars['contracts']->value['incl_salary']!='0'){?> checked="checked" <?php }?> />
                                                                               <label class="checkbox checkbox-inline" style="padding-left:5px !important;">inkl. sem.lön&nbsp;&nbsp;&nbsp;</label>
                                                                           </div>
                                                                           <div style="margin: 0px;" class="input-prepend span8"> 
                                                                               <input style="float: left; margin-top: 4px !important;" name="chkArbetstidLonExklSemLon" type="checkbox" id="chkArbetstidLonExklSemLon" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['excl_salary']!=''&&$_smarty_tpl->tpl_vars['contracts']->value['excl_salary']!='0'){?> checked="checked" <?php }?> onclick="makeChange()" />
                                                                               <label class="checkbox checkbox-inline" style="padding-left:5px !important;">exkl. sem.lön</label>
                                                                           </div>


                                                                           <div class="row-fluid">
                                                                               <div class="span12" style="margin:10px 0 0 0;">
                                                                                   <div class="input-prepend pull-left" style="margin-top: 4px;"> 
                                                                                       <input style="width: auto;" name="chkArbetstidLonUtbetalasManadsvis" type="checkbox" id="chkArbetstidLonUtbetalasManadsvis" value="1"  <?php if ($_smarty_tpl->tpl_vars['contracts']->value['incl_wages']!=''&&$_smarty_tpl->tpl_vars['contracts']->value['incl_wages']!='0'){?> checked="checked" <?php }?> onclick="makeChange()" />
                                                                                   </div>
                                                                                   <label style="float: left; margin: 0px;">&nbsp;Lönen utbetalas månadsvis</label>
                                                                               </div>
                                                                               <div style="margin: 0px;" class="input-prepend span12"> 
                                                                                   <label style="float: left; ">Lönen inkluderar &nbsp;</label>
                                                                                   <input class="form-control span2" style="float: left;" name="txtArbetstidLonInkluderarLonerevision" type="text" id="txtArbetstidLonInkluderarLonerevision" size="4" value="<?php if ($_smarty_tpl->tpl_vars['contracts']->value['act_salary']>0){?><?php echo (int)$_smarty_tpl->tpl_vars['contracts']->value['act_salary'];?>
<?php }?>" onchange="makeChange()" />
                                                                                   <label style="float: left; margin: 0px 5px 0 5px;"> &nbsp;års lönerevision</label>
                                                                               </div>
                                                                               <div style="margin: 0px;" class="input-prepend span12"> 
                                                                                   <label style="float: left;" for="txtBankkonto">Bank/Kontonr &nbsp;</label>
                                                                                   <input style="float: left;" class="form-control span8" name="txtBankkonto" type="text" id="txtBankkonto" size="60" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['bank_account'];?>
" onchange="makeChange()" /> 
                                                                               </div>





                                                                           </div>
                                                                       </div>

                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>E. Semesterrätt</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12" > 
                                                                               <label class="radio">Semester utges enligt lag och kollektivavtal med

                                                                                   <input class="form-control span2" name="txtSemesterSemesterdagar" type="text" id="txtSemesterSemesterdagar" size="4" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['leave_per_year'];?>
" onchange="makeChange()" />
                                                                                   semesterdagar<br /> per år vid fullt intjänade
                                                                               </label>
                                                                           </div>
                                                                           <div  class="span12" style="margin:0 !important;">

                                                                               <ol class="radio-group" style="margin:10px 0 0 0 !important">
                                                                                   <li>

                                                                                       <input  name="chkSemesterLonIngarTimlon" type="checkbox" id="chkSemesterLonIngarTimlon" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['incl_holiday_pay']!=''){?>checked="checked"<?php }?> onchange="makeChange()" /><label class="label-option-and-checkbox">Semesterlön ingår i överenskommen timlön&nbsp;</label></li>

                                                                                   <li>
                                                                                       <input  name="chkSemesterLonIngarEjTimlon" type="checkbox" id="chkSemesterLonIngarEjTimlon" value="1" <?php if ($_smarty_tpl->tpl_vars['contracts']->value['excl_holiday_pay']!=''&&$_smarty_tpl->tpl_vars['contracts']->value['excl_holiday_pay']!='0'){?>checked="checked"<?php }?> onchange="makeChange()" />
                                                                                       <label class="label-option-and-checkbox">  Semesterlön ingår ej i överenskommen timlön&nbsp;</label>

                                                                                   </li>
                                                                               </ol>  



                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>F. Övertid, restid, ob, jour, beredskap</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <label class="radio">
                                                                               <label class="span12" style="float: left;" for="exampleInputEmail1">I lönen ingår kompensation för </label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtOvertid" type="checkbox" id="chkOvrigtOvertid" value="1" <?php if (is_array($_smarty_tpl->tpl_vars['opt']->value)&&in_array("1",$_smarty_tpl->tpl_vars['opt']->value)){?>checked="checked"<?php }?> onclick="makeChange()" />övertid&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtRestid" type="checkbox" id="chkOvrigtRestid" value="1" <?php if (is_array($_smarty_tpl->tpl_vars['opt']->value)&&in_array("2",$_smarty_tpl->tpl_vars['opt']->value)){?>checked="checked"<?php }?> onclick="makeChange()" />restid&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtBeredskap" type="checkbox" id="chkOvrigtBeredskap" value="1" <?php if (is_array($_smarty_tpl->tpl_vars['opt']->value)&&in_array("3",$_smarty_tpl->tpl_vars['opt']->value)){?>checked="checked"<?php }?> onclick="makeChange()" />beredskap&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtOb" type="checkbox" id="chkOvrigtOb" value="1" <?php if (is_array($_smarty_tpl->tpl_vars['opt']->value)&&in_array("4",$_smarty_tpl->tpl_vars['opt']->value)){?>checked="checked"<?php }?> onclick="makeChange()" />ob&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtJour" type="checkbox" id="chkOvrigtJour" value="1" <?php if (is_array($_smarty_tpl->tpl_vars['opt']->value)&&in_array("5",$_smarty_tpl->tpl_vars['opt']->value)){?>checked="checked"<?php }?> onclick="makeChange()" />jour</label>
                                                                           </label>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>G. S&auml;rskilda villkor, noteringar</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                               <input class="form-control span8" name="txtNotering1" type="text" id="txtNotering1" style="width:90%"  value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['special_condition'];?>
" onchange="makeChange()" /> 
                                                                           </div>
                                                                       </div>
                                                                       <div style="margin: 0" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                               <input class="form-control span8" name="txtNotering2" type="text" id="txtNotering2" style="width:90%" value="<?php echo $_smarty_tpl->tpl_vars['contracts']->value['notes'];?>
" onchange="makeChange()" /> 
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
                    </form>
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
    
<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
         
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-271});
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
         $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
        
        $('#chkArbetstidHeltid').click(function() { 
            var checked = $(this).attr('checked', true);
            if(checked){ 
                $('#txtArbetstidDeltidTim').val('');
                $('#txtArbetstidDeltidMin').val('');
                $("#txtArbetstidDeltidTim").removeClass("error");
                $("#txtArbetstidDeltidMin").removeClass("error");
            }
        });
        $('#chkArbetstidDeltid').click(function() { 
            var checked = $(this).attr('checked', true);
            if(checked){ 
                $('#normal_week_hr').val('');
                $('#oncall_hr').val('');
                $("#normal_week_hr").removeClass("error");
                $("#oncall_hr").removeClass("error");
            }
        });

        <?php if ($_smarty_tpl->tpl_vars['date_from']->value!=''&&$_smarty_tpl->tpl_vars['contracts']->value['employmentType']==2){?>
            $('input[type=radio][name=work_type]').uncheckableRadio();
        <?php }?>

        $(document).off('keyup', "#txtArbetstidLonPerManad, #txtArbetstidLonPerTimme")
            .on('keyup', "#txtArbetstidLonPerManad, #txtArbetstidLonPerTimme", function(e) {
                    // get keycode of current keypress event
                    var code = (e.keyCode || e.which);
                    //console.log(code);
                    

                    // do nothing if it's an arrow key  || (code >=65 && code <= 90)
                    if(code == 37 || code == 38 || code == 39 || code == 40) {
                        return;
                    }
                    var this_val = $(this).val();
                    var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                    $(this).val(new_val);
                    /*$(this).val($(this).val().replace(/[^0-9.,]+/g,''));
                    $(this).val($(this).val().replace(/,/g,"."));*/
        });
            
        // if(<?php echo $_smarty_tpl->tpl_vars['count_of_dates']->value;?>
 == 0){
        //         window.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/new/"
        // }

    });

    // window.onload = function() {
    //     // similar behavior as clicking on a link
    //     window.location.href = "http://stackoverflow.com";
    // }
		
    $(function() {
		var availableTags1 = [
                        <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?>
                                "<?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
",    
                            <?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                                "<?php echo $_smarty_tpl->tpl_vars['customer']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value['first_name'];?>
",    
                            <?php }?>
                               
                        <?php } ?>
		];
               
                
		$( "#txtnamn" ).autocomplete({
                            source: availableTags1,
                            open: function(event, ui) { 
                                            $("#hiden_val").val(1);        
                                    },
                            close: function(event, ui) { 
                                            $("#hiden_val").val(0);
                                    },
                            focus:function(event, ui ){
                                            $("#txtnamn").val(ui.item.item);
                                    }
		});
    });
           
    function removeSign(id){
        $('#action').val('unsign');
        $('#forms').submit();
    }

    function saveForm(){
        var error = 0;
        var j =0 ;
        //var social_flag = $("#social_flag").val();
        var social = $("#txtpersonalnummer").val();
        $('#action').val('save');
        $('#forms').attr('target','_self');
       /* if(social == ""){
            $("#txtpersonalnummer").addClass("error");
            error = 1;
        }*/
        var value1 = $("input:radio[name=assistanceChecked]:checked").val();
        var value = $("input:radio[name=assistance]:checked").val();

        var customer_value = $("input:radio[name=customer_group]:checked").val();

        if (typeof customer_value == 'undefined' || customer_value == ''){
             error = 1;
             alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_a_customer'];?>
');
             
        }
       
        /*if(value1 == 1){
            var from_month = $("#txtAnstFormVisstidFrom").val();
            
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").addClass("error");
                $("#txtAnstFormProvanstallningFrom").removeClass("error");
                $("#txtOverenskommelseBefDatum").removeClass("error");
                error = 1;
            }
            
        }*/
        /*if(value == 2){
            var from_month = $("#txtAnstFormProvanstallningFrom").val();
            
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").removeClass("error");
                $("#txtAnstFormProvanstallningFrom").addClass("error");
                $("#txtOverenskommelseBefDatum").removeClass("error");
                error = 1;
            }
            
        }
        else{
            var from_month = $("#txtOverenskommelseBefDatum").val();
            
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").removeClass("error");
                $("#txtAnstFormProvanstallningFrom").removeClass("error");
                $("#txtOverenskommelseBefDatum").addClass("error");
                error = 1;
            }
            
        }*/
        if ($('#social_flag').val() == '1'){
             j=1;
             error = 1;
        }
        var val = $('input:radio[name=work_type]:checked').val();
        if(val == 1){
            /*if($("#normal_week_hr").val() == ''){
                $("#normal_week_hr").addClass("error");
                error = 1;
            }else{
                $("#normal_week_hr").removeClass("error");
                // error = 0;
            }*/
            /*if($("#oncall_hr").val() == '' || $("#oncall_hr").val() =='0.00'){
                $("#oncall_hr").addClass("error");
                error = 1;
            }else{
                $("#oncall_hr").removeClass("error");
                error = 0;
            }*/
        }
         /*if(val == 2){
            if($("#txtArbetstidDeltidTim").val() == ''){
                $("#txtArbetstidDeltidTim").addClass("error");
                error = 1;
            } else {
             $("#txtArbetstidDeltidTim").removeClass("error");
                error = 0;
            }
            if($("#txtArbetstidDeltidMin").val() == ''){
                $("#txtArbetstidDeltidMin").addClass("error");
                error = 1;
            } else {
             $("#txtArbetstidDeltidMin").removeClass("error");
                error = 0;
            }
        }*/


        if(error == 0 && (val == '' || typeof val === 'undefined') && value != 2){
            error = 1;
            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_working_hours'];?>
');
        }
        
        
        //social_flag = $("#social_flag").val();
        if(error == 0){
           $('#forms').submit();
        }
    }
    function printForm(){
        $('#action').val('print');
        $('#forms').attr('target','_blank');
        $('#forms').submit();
    }

    function newContract(){
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/new/";
    }

    function load_documentation(){               
        document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employment/contract/pdf/<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
/"+$('#date').val()+"/";
    }


    function redirectConfirm(mode){
        var change = $("#new").val();
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
        var change = $("#new").val();
        if(change == "1"){
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
        var change = $("#new").val();
        if(change == "1"){
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
        var change = $("#new").val();
        if(change == "1"){
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
        var change = $("#new").val();
        if(change == "1"){
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
        var change = $("#new").val();
        if(change == "1"){
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
        var change = $("#new").val();
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
        var change = $("#new").val();
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
        var change = $("#new").val();
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

    function makeChange(){
        $("#new").val('1');
    }
    function backForm(){
        //document.location.href = "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
list/employee/<?php if ($_smarty_tpl->tpl_vars['employee_detail']->value[0]['status']=='0'){?>inact<?php }else{ ?>act<?php }?>/";
        //document.referrer;
        //history.go(-1)
        window.history.back();
    } 
    (function( $ ){

        $.fn.uncheckableRadio = function() {

            return this.each(function() {
                $(this).mousedown(function() {
                    $(this).data('wasChecked', this.checked);
                });

                $(this).click(function() {
                    if ($(this).data('wasChecked'))
                        this.checked = false;
                });
            });

        };

        $('input[type=radio][name=assistance]').uncheckableRadio();

        $('input[type=radio][name=assistance]').click(function(){

            $( "input[type=radio][name=work_type]").unbind( "click" ).unbind( "mousedown" );
            if($(this).val() == 2 && $(this).data('wasChecked') == false){
                $('input[type=radio][name=work_type]').uncheckableRadio();
            }
        });

    })( jQuery );
</script>

    </body>
</html><?php }} ?>