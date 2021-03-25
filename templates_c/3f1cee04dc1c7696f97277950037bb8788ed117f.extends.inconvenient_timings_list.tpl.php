<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 13:38:59
         compiled from "/home/time2view/public_html/cirrus/templates/inconvenient_timings_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5882605255fcb8d73945710-51697952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f1cee04dc1c7696f97277950037bb8788ed117f' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/inconvenient_timings_list.tpl',
      1 => 1508213894,
      2 => 'file',
    ),
    '0d4abeabee1891ef694ffc18349540bcef29c0f3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/dashboard.tpl',
      1 => 1578583316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5882605255fcb8d73945710-51697952',
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
  'unifunc' => 'content_5fcb8d73d434e6_81892825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb8d73d434e6_81892825')) {function content_5fcb8d73d434e6_81892825($_smarty_tpl) {?><!DOCTYPE html>
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
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
        .scrol_down_image_pointer {
            background: url("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/downarrow_icon.png") no-repeat scroll 39px 29px !important;
        }
        .scrol_down_image_pointer_inconv {
            background: url("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/downarrow_icon.png") no-repeat !important;
            background-position: bottom right;
        }
        #holidayinc_main .child_holi td, #inconv_table .child_holi td{ background: none repeat scroll 0% 0% rgb(247, 244, 205); }
        /*#holidayinc_main .active_rows td{ background: none repeat scroll 0% 0% rgb(247, 244, 205); }*/
        #holidayinc_main .active_rows td.index-column{ border-left: 5px solid #9BE19B; }
        #holidayinc_main .active_rows td.action-column{ border-right: 5px solid #9BE19B; }
        td.salary_col{ padding: 5px !important;}
        table tbody tr td > .day-report{ height: auto !important;}
        .icon_disabled{ color: #ccc;}
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
            <div id="left_message_wraper" class="span12 no-min-height no-ml"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <div class="span12 no-ml">
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient_timings'];?>
</h1>
                    </div>
                    <div class="span12 widget-body-section input-group">

                        <div style="margin: 0px ! important;" class="widget">
                            <div style="" class="widget-header span12">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/';" class="btn btn-default btn-normal pull-right btn-addnew-holiday" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
 - <?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group">
                                <div class="table-responsive span12">
                                    <table id="holidayinc_main" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                        <thead>
                                            <tr>
                                                <th class="table-col-center" style="width:20px">#</th>
                                                <th><?php echo utf8_encode($_smarty_tpl->tpl_vars['translate']->value['name']);?>
</th>
                                                <th><?php echo utf8_encode($_smarty_tpl->tpl_vars['translate']->value['type']);?>
</th>
                                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effect_from'];?>
</th>
                                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>
</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                        <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['holi_timing_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                            <tbody class="holiday_main <?php if ($_smarty_tpl->tpl_vars['list']->value['active_flag']){?>active_rows<?php }?>">
                                                <tr class="gradeX<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child<?php }?>">
                                                    <td style="width: 20px;" class="table-row-collapse-switch index-column center<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child row-expander cursor_hand<?php }?>" <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td>
                                                    <td <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>class="have_child cursor_hand" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['num_days'];?>
</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['year_from'];?>
<?php if ($_smarty_tpl->tpl_vars['list']->value['year_to']!=null){?> - <?php echo $_smarty_tpl->tpl_vars['list']->value['year_to'];?>
<?php }?></td>
                                                    <td style="min-width: 40px;"><?php echo $_smarty_tpl->tpl_vars['list']->value['date_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value['start_time'];?>
  <b> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
  </b><?php echo $_smarty_tpl->tpl_vars['list']->value['date_to'];?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value['end_time'];?>
</td>
                                                    <td style="width: 130px;"  class="table-col-center action-column">
                                                        <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/edit/';"><i class="icon-wrench"></i></button>
                                                        <?php if ($_smarty_tpl->tpl_vars['list']->value['year_to']==null){?><button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/clone/';"><i class="icon-share"></i></button><?php }?>
                                                        <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/delete/');"><i class="icon-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody class="child_holi">
                                                <?php  $_smarty_tpl->tpl_vars['version'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['version']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['privious_versions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['version']->key => $_smarty_tpl->tpl_vars['version']->value){
$_smarty_tpl->tpl_vars['version']->_loop = true;
?>
                                                    <tr class="gradeX  table-row-collapse-wrpr item_row hide">
                                                        <td style="width: 20px;" class="center">*</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['version']->value['name'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['version']->value['num_days'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['version']->value['year_from'];?>
<?php if ($_smarty_tpl->tpl_vars['version']->value['year_to']!=null){?> - <?php echo $_smarty_tpl->tpl_vars['version']->value['year_to'];?>
<?php }?></td>
                                                        <td style="min-width: 40px;"><?php echo $_smarty_tpl->tpl_vars['version']->value['date_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['version']->value['start_time'];?>
  <b> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
  </b><?php echo $_smarty_tpl->tpl_vars['version']->value['date_to'];?>
 <?php echo $_smarty_tpl->tpl_vars['version']->value['end_time'];?>
</td>
                                                        <td style="width: 130px;" class="table-col-center">
                                                            <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/edit/';"><i class="icon-wrench"></i></button>
                                                            <?php if ($_smarty_tpl->tpl_vars['version']->value['year_to']==null){?><button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/clone/';"><i class="icon-share"></i></button><?php }?>
                                                            <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
holiday/new/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/delete/');"><i class="icon-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                                    

                        <div style="margin: 20px 0px 0px;" class="widget">
                            <div class="span12" id="wpr_inconv_table">
                            <div style="" class="widget-header span12">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient_timings'];?>
</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <button onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/newentry/';" class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming ml" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
</button>
                                    <button onclick="save_inconvenients_order();" class="btn btn-default btn-normal pull-right" type="button"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_sort_order'];?>
</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group">
                                <div id="inconve_message_wraper" class="span12 no-min-height no-ml"></div>
                                <div class="table-responsive span12 no-ml">
                                    <table id="inconv_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                        <thead>
                                            <tr>
                                                <th class="table-col-center" style="width:20px">#</th>
                                                <th style="width: 100px;"><?php echo utf8_encode($_smarty_tpl->tpl_vars['translate']->value['inconv_name']);?>
</th>
                                                <th style="width: 20px;"><?php echo utf8_encode($_smarty_tpl->tpl_vars['translate']->value['inconv_type']);?>
</th>
                                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_date_effect_from'];?>
</th>
                                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_timing'];?>
</th>
                                                <th style="width:124px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconv_salary'];?>
</th>
                                                <th style="width:124px;">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['timing_list']->value)&&($_SERVER['QUERY_STRING']==''||$_smarty_tpl->tpl_vars['type']->value=='t1')){?>
                                            <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['timing_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                                <tbody class="holiday_main">
                                                    <tr class="gradeX<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child<?php }?>">
                                                        <td style="width: 20px;" class="table-row-collapse-switch-timings center<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child row-expander cursor_hand<?php }?>" <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>>
                                                            <div class="row_index_val pull-left"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</div> 
                                                            <div class="span1 pull-right sort-tools">
                                                                <i class="icon icon-arrow-up cursor_hand <?php if ($_smarty_tpl->tpl_vars['i']->value==1){?>icon_disabled<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_to_move_up'];?>
"></i>
                                                                <i class="icon icon-arrow-down cursor_hand <?php if ($_smarty_tpl->tpl_vars['i']->value==count($_smarty_tpl->tpl_vars['timing_list']->value)){?>icon_disabled<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['sort_to_move_down'];?>
"></i>
                                                            </div>
                                                            <input type="hidden" class="gid" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['group_id'];?>
" />
                                                        </td>
                                                        <td class="table-col-center center<?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?> have_child cursor_hand<?php }?>" <?php if (count($_smarty_tpl->tpl_vars['list']->value['privious_versions'])>0){?>title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['click_here_to_see_previous_versions'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>
                                                        <td class="table-col-center center">
                                                            <?php if ($_smarty_tpl->tpl_vars['list']->value['type']==0||$_smarty_tpl->tpl_vars['list']->value['type']==3){?>
                                                            <ul class="slot-icons-day">
                                                                <?php if ($_smarty_tpl->tpl_vars['list']->value['type']==0){?><li class="slot-icon-normal active"></li>
                                                                <?php }elseif($_smarty_tpl->tpl_vars['list']->value['type']==3){?><li class="slot-icon-oncall active"></li><?php }?>
                                                            </ul>
                                                            <?php }?>
                                                        </td>
                                                        <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['list']->value['effect_from'];?>
<?php if ($_smarty_tpl->tpl_vars['list']->value['effect_to']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value['effect_to'];?>
<?php }?></td>
                                                        <td class="center">
                                                            
                                                            <?php  $_smarty_tpl->tpl_vars['day_time'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_time']->_loop = false;
 $_smarty_tpl->tpl_vars['day_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value['day_time_merged']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_time']->key => $_smarty_tpl->tpl_vars['day_time']->value){
$_smarty_tpl->tpl_vars['day_time']->_loop = true;
 $_smarty_tpl->tpl_vars['day_key']->value = $_smarty_tpl->tpl_vars['day_time']->key;
?>
                                                                <div class="day-report"><h1><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['day_key']->value-1;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[$_tmp1]['label']];?>
</h1>
                                                                    <?php echo implode('<br/>',$_smarty_tpl->tpl_vars['day_time']->value);?>

                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="table-col-center center salary_col">
                                                            <?php if ($_smarty_tpl->tpl_vars['list']->value['type']==3||$_smarty_tpl->tpl_vars['list']->value['type']=='3'){?>
                                                                <ol class="span12">
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['amount'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_call_training'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_complementary_oncall'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_more_oncall'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                </ol>
                                                            <?php }else{ ?>
                                                                
                                                                <ol class="span12">
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-normal"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['amount'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_call_training'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_complementary_oncall'];?>
</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['list']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                </ol>
                                                            <?php }?>
                                                        </td>
                                                        <td class="table-col-center" style="width: 200px;">
                                                            <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/edit/';"><span class="icon-wrench"></span></button>
                                                            <?php if ($_smarty_tpl->tpl_vars['list']->value['effect_to']==''){?><button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/clone/';"><span class="icon-share"></span></button><?php }?>
                                                            <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete_inconvenient('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
/delete/');"><span class="icon-trash"></span></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="child_holi">
                                                    <?php  $_smarty_tpl->tpl_vars['version'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['version']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['privious_versions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['version']->key => $_smarty_tpl->tpl_vars['version']->value){
$_smarty_tpl->tpl_vars['version']->_loop = true;
?>
                                                        <tr class="gradeX table-row-collapse-Timings-wrpr item_row hide">
                                                            <td class="center" style="width: 20px;">* </td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['version']->value['name'];?>
</td>
                                                            <td class="table-col-center center">
                                                                <?php if ($_smarty_tpl->tpl_vars['version']->value['type']==0||$_smarty_tpl->tpl_vars['version']->value['type']==3){?>
                                                                <ul class="slot-icons-day">
                                                                    <?php if ($_smarty_tpl->tpl_vars['version']->value['type']==0){?><li class="slot-icon-normal active"></li>
                                                                    <?php }elseif($_smarty_tpl->tpl_vars['version']->value['type']==3){?><li class="slot-icon-oncall active"></li><?php }?>
                                                                </ul>
                                                                <?php }?>
                                                            </td>
                                                            <td class="table-col-center center"><?php echo $_smarty_tpl->tpl_vars['version']->value['effect_from'];?>
<?php if ($_smarty_tpl->tpl_vars['version']->value['effect_to']!=''){?> <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 <?php echo $_smarty_tpl->tpl_vars['version']->value['effect_to'];?>
<?php }?></td>
                                                            <td class="center">
                                                                
                                                                <?php  $_smarty_tpl->tpl_vars['day_time'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_time']->_loop = false;
 $_smarty_tpl->tpl_vars['day_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['version']->value['day_time_merged']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_time']->key => $_smarty_tpl->tpl_vars['day_time']->value){
$_smarty_tpl->tpl_vars['day_time']->_loop = true;
 $_smarty_tpl->tpl_vars['day_key']->value = $_smarty_tpl->tpl_vars['day_time']->key;
?>
                                                                    <div class="day-report"><h1><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['day_key']->value-1;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week']->value[$_tmp2]['label']];?>
</h1>
                                                                        <?php echo implode('<br/>',$_smarty_tpl->tpl_vars['day_time']->value);?>

                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="table-col-center center salary_col">
                                                                <?php if ($_smarty_tpl->tpl_vars['version']->value['type']==3||$_smarty_tpl->tpl_vars['version']->value['type']=='3'){?>
                                                                    <ol class="span12">
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['amount'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_call_training'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_complementary_oncall'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_more_oncall'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                    </ol>
                                                                <?php }else{ ?>
                                                                    
                                                                    <ol class="span12">
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-normal"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['amount'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-training"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_call_training'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_complementary_oncall'];?>
</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal"></li></ul><div class="pull-left ml"> <?php echo $_smarty_tpl->tpl_vars['version']->value['sal_dismissal_oncall'];?>
</div></li>
                                                                    </ol>
                                                                <?php }?>
                                                            </td>
                                                            <td class="center">
                                                                <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/edit/';"><span class="icon-wrench"></span></button>
                                                                <?php if ($_smarty_tpl->tpl_vars['version']->value['effect_to']==''){?><button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['clone'];?>
" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/clone/';"><span class="icon-share"></span></button><?php }?>
                                                                <button type="button" class="btn btn-default" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
" onclick="warning_delete_inconvenient('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient/timing/<?php echo $_smarty_tpl->tpl_vars['version']->value['id'];?>
/delete/');"><span class="icon-trash"></span></button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php } ?>
                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="span4 main-right hide" style="margin-top: 8px; padding: 10px;">
            <div id="right_message_wraper" class="span12 no-min-height"></div>
            

            <div class="row-fluid addnew-hoiliday hide" id="holiday_form">
                <div class="span12" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="span4 day-slot-wrpr-header-left span6">
                                <h1 style=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
 <span class="subtitle"></span></h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right"  onclick="SaveHoliday()" type="button"><i class=' icon-save'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                <button class="btn btn-default btn-normal pull-right" onclick="ResetHolidayForm()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                                <button class="btn btn-default btn-normal pull-right btn-cancel-right" type="button"><i class='icon-power-off'></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <input type="hidden" id="operational_holiday_id" name="operational_holiday_id" value="" />
                            <input type="hidden" id="operational_holiday_mode" name="operational_holiday_mode" value="" />
                            <div class="row-fluid">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div class="span12" style="margin: 0px;">
                                        <label class="span12" style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['type'];?>
</label>
                                        <input name="holiday_type" value="1" id="holi_normal" style="margin: 0px 7px 0px 0px ! important;" type="radio"><?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>

                                        <input name="holiday_type" value="2" id="holi_inconv" style="margin: 0px 7px ! important;" type="radio"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inconvenient'];?>

                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['holiday'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input id="holiday_name" name="holiday_name" class="form-control span11" type="text" />
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_year_from">Year</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_year_from" id="holiday_year_from" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text"/>
                                                <span class="add-on"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</span>
                                                <input class="form-control span5" name="holiday_year_to" id="holiday_year_to" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_datefrom"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effected'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend date hasDatepicker">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span5 datepicker" name="holiday_datefrom" id="holiday_datefrom" type="text"/>
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_timefrom" id="holiday_timefrom" type="text"/>
                                            </div>
                                        </div>
                                        <label style="float: left;" class="span12" for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date_effected'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend date hasDatepicker">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span5 datepicker" name="holiday_dateto" id="holiday_dateto" type="text"/>
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_timeto" id="holiday_timeto" type="text"/>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <div class="btn-group holiday-days"> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">1</a> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">2</a> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">3</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12" style=" margin: 10px 0px 0px ! important;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <ul class="day-info-list">
                                                        <li class="day-big">Big Day</li>
                                                        <li class="day-red">Red Day</li>
                                                    </ul>
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


            <div class="row-fluid addnew-timing hide"  id="inconvenient_form">
                <div class="span12" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="row-fluid">
                                <div class="span12 day-slot-wrpr-header-left">
                                    <h1 style="padding: 3px ! important;">Inconvenient Timings - Normal</h1>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="day-slot-wrpr-header-left span12" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal span4 btn-addnew-notes" style="" type="button">Save</button>
                                    <button class="btn btn-default btn-normal span4" style="" type="button">Reset</button>
                                    <button class="btn btn-default btn-normal span3 btn-cancel-right" style="" type="button">Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="row-fluid">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Name</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Effect From</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
                                        </div>
                                    </div>


                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Inconvenient Type</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Normal</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">On call</a>
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Type</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Normal</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">On call</a>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Time Range</label>
                                        <div class="span12" style="margin:0;">
                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker" id="datepicker">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" id="exampleInputEmail1" placeholder="Enter email" type="email">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" id="exampleInputEmail1" placeholder="Enter email" type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 10px 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Days</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Mon</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Tue</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Wed</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Thu</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Fri</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Sat</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Sun</a>
                                        </div>
                                    </div>

                                    <div style="margin: 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Salary</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
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
js/bootbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });

    $('.sort-tools .icon').click(function(e){
        e.stopPropagation();

        var sort_direction = null;
        if($(this).hasClass('icon-arrow-up')){
            sort_direction = 'up'
        }
        else if($(this).hasClass('icon-arrow-down')){
            sort_direction = 'down'
        }

        var current_position = $(this).parents('tbody.holiday_main').index('#inconv_table tbody.holiday_main');
        // console.log(sort_direction, current_position);
        if(sort_direction == 'up'){
            if(!isNaN(current_position) && current_position != 0){
                // $('#inconv_table tbody.holiday_main');

                var this_holiday_main = $(this).parents('tbody.holiday_main');
                var this_holiday_child = $(this).parents('tbody.holiday_main').next('.child_holi');
                this_holiday_main.prev().prev().before(this_holiday_main);
                this_holiday_child.prev().prev().before(this_holiday_child);
                renumbering_inconv_index_col();
            }
        }
        else if(sort_direction == 'down'){
            var total_rows = $('#inconv_table tbody.holiday_main').length;
            if(!isNaN(current_position) && current_position != total_rows - 1){
                // $('#inconv_table tbody.holiday_main');

                var this_holiday_main = $(this).parents('tbody.holiday_main');
                var this_holiday_child = $(this).parents('tbody.holiday_main').next('.child_holi');
                this_holiday_child.next().next().after(this_holiday_child);
                this_holiday_main.next().next().after(this_holiday_main);
                renumbering_inconv_index_col();
            }
        }
    });
        
    $("table#holidayinc_main .holiday_main td.have_child, table#inconv_table .holiday_main td.have_child").click(function() {
            $(this).parents('.holiday_main').next('.child_holi').find('tr.item_row').toggleClass('hide');
    });
    
    
});

function renumbering_inconv_index_col(){

    $('#inconv_table tbody.holiday_main .sort-tools .icon').removeClass('icon_disabled');
    var total_rows = $('#inconv_table tbody.holiday_main').length;
    $('#inconv_table tbody.holiday_main').each(function (i, el) {
        $(this).find('.row_index_val').html(i+1);
        if(i == 0)
            $(this).find('.sort-tools .icon-arrow-up').addClass('icon_disabled');
        if(i+1 == total_rows)
            $(this).find('.sort-tools .icon-arrow-down').addClass('icon_disabled');

    });
}



function warning_delete(url){
    if(confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_delete_holiday'];?>
")){
        document.location = url;
        return true;
    }else
        return false;
}

function warning_delete_inconvenient(url){
    if(confirm("<?php echo $_smarty_tpl->tpl_vars['translate']->value['want_delete'];?>
")){
        document.location = url;
        return true;
    }else
        return false;
}

function save_inconvenients_order(){
    bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_ordering_inconvenient_entries'];?>
', [{
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            "class" : "btn-danger"
        }, {
            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            "class" : "btn-success",
            "callback": function() {
                var sort_data = [];
                $('#inconv_table tbody.holiday_main').each(function (i, el) {
                    var gid = $(this).find('input.gid').val();
                    sort_data.push({ 'gid': gid, 'order': i+1 });
                });
                // console.log(sort_data);

                wrapLoader("#wpr_inconv_table");
                $('#inconve_message_wraper').html('');
                $.ajax({
                    async:false,
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
inconvenient_timings_list.php",
                    data: { 'action': 'sort_inconvenient_entries', 'sort_data': sort_data},
                    type:"POST",
                    dataType: 'json',
                    success:function(data){
                            // console.log(data);

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#inconve_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader("#wpr_inconv_table");
                });
            }
    }]);
}
</script>

    </body>
</html><?php }} ?>