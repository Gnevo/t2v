<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full sticky-sidebar"><!-- <![endif]-->
    <!-- <![endif]-->
    <head>
        <title>{$app_name} {block name='title'}{/block}</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=2.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="{$url_path}images/favicon.ico" />
        <meta property="og:title" content="{$app_name}" />
        <link rel="manifest" href="{$url_path}manifest.json">
        {* <meta name="description" content="Also want these pretty website previews?" /> *}
        {* <meta property="og:description" content="Also want these pretty website previews?" /> *}
        {* <meta property="og:image" content="https://richpreview.com/richpreview.png" /> *}
        
        <link rel="stylesheet" href="{$url_path}css/bootstrap.css" type="text/css" async/><!-- Bootstrap -->
        <link rel="stylesheet" href="{$url_path}css/responsive.css" type="text/css" async/>
        <link rel="stylesheet" href="{$url_path}fonts/glyphicons/css/glyphicons.css" async/><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome.min.css" async>
        <!--[if IE 7]><link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        <link rel="stylesheet" href="{$url_path}js/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" /><!-- Uniform Pretty Checkboxes -->
        <link rel="stylesheet" href="{$url_path}js/bootstrap-select/bootstrap-select.css" /><!-- Bootstrap Extended -->
        <link rel="stylesheet" href="{$url_path}js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        <link rel="stylesheet" href="{$url_path}css/style-flat.css" type="text/css" async/><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="{$url_path}css/style.css?v={filemtime('css/style.css')}" type="text/css" async/><!-- CHILD THEME -->
        <link rel="stylesheet" href="{$url_path}css/jquery.mCustomScrollbar.css"><!-- custom scrollbar stylesheet -->
        <link rel="stylesheet" href="{$url_path}css/tooltip.css" type="text/css" /><!--TOOLTIP BEGIN-->
       <!-- <link rel="stylesheet" href="{$url_path}css/font-icons.css" type="text/css" />--><!--FONT ICON BEGIN-->
       <!-- <link rel="stylesheet" href="{$url_path}css/icons.css" type="text/css" />--><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="{$url_path}css/google-font.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="{$url_path}css/message.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="{$url_path}css/contextMenu.css?v={filemtime('css/contextMenu.css')}" type="text/css" media="all" />
        <!--[if IE 8]><link rel="stylesheet" href="{$url_path}css/ie.css"><![endif]-->
        <!--[if IE 11]><link rel="stylesheet" href="{$url_path}css/ie.css"><![endif]-->
        <link rel="stylesheet" href="{$url_path}css/arabic/css/style-arabic.css" type="text/css" media="all" />
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
        {block name='style'}{/block}
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
                                    {if $user_role eq 1}<span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span>{$translate.menu_admin}
                                    {else if $user_role eq 2} <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span>{$translate.menu_al}
                                    {else if $user_role eq 3} <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span> {$translate.menu_employee}
                                    {else if $user_role eq 4} <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span> {$translate.menu_customer}{/if}
                                </li>
                                <li class="dropdown dd-1" style="padding-right:10px; ">
                                    <span class="icon-home hidden-phone" style="font-size:18px;"></span>
                                    {*<span>{$user_display_name}</span>*}
                                    <form name="user_company_selection" id="user_company_selection" method="post" action="{$url_path}change_company.php" style="display: inline-block;">
                                        <select style="display: none;" class="selectpicker"  name="user_company" id="user_company" {*onchange="changeCompany();"*} onchange="this.form.submit();">
                                            {foreach $user_companies as $user_company}
                                                <option value="{$user_company.id}" {if $company_id == $user_company.id}selected="selected"{/if}>{$user_company.name}</option>
                                            {/foreach}
                                        </select>
                                        <input type="hidden" name="redirect_form" value="{$redirect_form}"/>    
                                    </form>
                                </li>
                            </ul>
                            <ul class="topnav pull-right">
                                {if (($privileges_mc.leave_notification == 1 || $privileges_mc.leave_approval == 1 || $privileges_mc.leave_rejection == 1 || $privileges_mc.leave_edit == 1) and $unread_leaves_count_top != 0) or
                                    ($privileges_mc.support == 1 and $user_ticket_count != 0) or
                                    (($privileges_mc.notes == 1 || $privileges_mc.notes_approval == 1 || $privileges_mc.notes_rejection == 1) and $unread_notes_count_top != 0) or
                                    ($privileges_mc.cirrus_mail == 1 and $mail_count_top != 0) or
                                    ($surveys_count != 0) or ($privileges_mc.document_archive == 1 && $unread_document != 0)}
                                    <li title="" data-original-title="" class="glyphs" data-toggle="tooltip" data-placement="bottom" style="margin-right: -1px;">
                                        <ul>
                                            {if ($privileges_mc.leave_notification == 1 || $privileges_mc.leave_approval == 1 || $privileges_mc.leave_rejection == 1 || $privileges_mc.leave_edit == 1) and $unread_leaves_count_top != 0}
                                                <li data-title="{$translate.dashboard_notofication_leave}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}message/center/leave/" class="glyphicons user" ><i style="color: red !important;"></i>
                                                        <span class="notification-info" >{$unread_leaves_count_top}</span>
                                                    </a></li>
                                            {/if}
                                            {if $privileges_mc.support == 1 and $user_ticket_count != 0}
                                                <li data-title="{$translate.dashboard_notofication_support}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}supporttickets/list/" class="glyphicons life_preserver"><i></i>
                                                        <span class="notification-info" >{$user_ticket_count}</span>
                                                    </a></li>
                                            {/if}
                                            {if ($privileges_mc.notes == 1 || $privileges_mc.notes_approval == 1 || $privileges_mc.notes_rejection == 1) and $unread_notes_count_top != 0}
                                                <li data-title="{$translate.dashboard_notofication_notes}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}notes/list/" class="glyphicons notes"><i></i>
                                                        <span class="notification-info" >{$unread_notes_count_top}</span>
                                                    </a></li>
                                            {/if}
                                            {if $privileges_mc.cirrus_mail == 1 and $mail_count_top != 0}
                                                <li data-title="{$translate.dashboard_notofication_mail}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}mail/list/" class="glyphicons message_full"><i></i>
                                                        <span class="notification-info" >{$mail_count_top}</span>
                                                    </a></li>
                                            {/if}
                                            {if $surveys_count != 0}
                                                <li data-title="{$translate.dashboard_notofication_survey}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}user/survey/" class="glyphicons charts"><i></i>
                                                        <span class="notification-info" >{$surveys_count}</span>
                                                    </a></li>
                                            {/if}
                                            {if $privileges_mc.document_archive == 1 && $unread_document != 0}
                                                <li data-title="{$translate.dashboard_notofication_doc_archive}" data-placement="bottom" data-toggle="tooltip"><a href="{$url_path}documents/archive/" class="glyphicons file"><i></i>
                                                        <span class="notification-info" >{$unread_document}</span>
                                                    </a></li>
                                            {/if}
                                        </ul>
                                    </li>
                                {/if}
                                <li style="border-right: 1px solid #CCC; border-left: 1px solid #CCC; padding-right:10px;" id="clock" class="hidden-phone hidden-tablet"></li>
                                <!--DATE AND TIME END	-->		
                                
                                
                                <!-- Language menu -->
                                <li class="dropdown dd-1 dd-flags" id="lang_nav">
                                    <form name="user_language_selection" id="user_language_selection" method="post" action="{$url_path}change_language.php" style="display: inline-block;">
                                        <a href="javascript:void(0);" data-toggle="dropdown">
                                            {foreach $languages as $language}
                                                {if $lang eq $language.short}
                                                    <img src="{if $language.short eq 'se'}{$url_path}images/lang/sw.png{else if $language.short eq 'en'}{$url_path}images/lang/us.png{/if}" alt="{$language.name}" title="{$language.name}">
                                                {/if}
                                            {/foreach}
                                        </a>
                                        
                                        
                                        <ul class="dropdown-menu pull-left" id="lang_drop_down_menu">
                                            {foreach $languages as $language}
                                                <li class="lang_options {if $lang eq $language.short}active{/if}" data-val="{$language.short}">
                                                    <a href="#" title="{$language.name}">
                                                        <img src="{if $language.short eq 'se'}{$url_path}images/lang/sw.png{else if $language.short eq 'en'}{$url_path}images/lang/us.png{/if}" alt="{$language.name}"> {$language.name}
                                                    </a>
                                                </li>
                                            {/foreach}
                                            {*<li><a href="" title="English"><img src="{$url_path}images/lang/us.png" alt="English"> English</a></li>*}
                                        </ul>
                                        <input type="hidden" name="redirect_form" value="{$redirect_form}"/>
                                        <input type="hidden" id="user_language" name="user_language" value=""/>
                                    </form>
                                </li>
                                {*<li class="hidden-tablet hidden-phone hidden-desktop-1 dropdown dd-1 dd-flags" id="lang_nav">
                                    <a href="#" data-toggle="dropdown"><img src="{$url_path}images/lang/en.png" alt="en" /></a>
                                    <ul class="dropdown-menu pull-left">
                                        <li class="active"><a href="" title="English"><img src="{$url_path}images/lang/en.png" alt="English"> English</a></li>
                                        <li><a href="" title="Romanian"><img src="{$url_path}images/lang/ro.png" alt="Romanian"> Romanian</a></li>
                                        <li><a href="" title="Italian"><img src="{$url_path}images/lang/it.png" alt="Italian"> Italian</a></li>
                                        <li><a href="" title="French"><img src="{$url_path}images/lang/fr.png" alt="French"> French</a></li>
                                        <li><a href="" title="Polish"><img src="{$url_path}images/lang/pl.png" alt="Polish"> Polish</a></li>
                                    </ul>
                                </li>*}
                                <!-- // Language menu END -->
                                
                                
                                
                                
                                <!-- Profile / Logout menu -->
                                <li class="account dropdown dd-1">
                                    <a data-toggle="dropdown" href="javascript:void(0);" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1">{$user_display_name}</span><i></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <!--<li><a href="javascript:void(0);" class="glyphicons cogwheel">Settings<i></i></a></li>
                                        <li><a href="javascript:void(0);" class="glyphicons camera">My Photos<i></i></a></li>!-->
                                        <li class="profile">
                                            <span>
                                                <span class="heading">Profile 
                                                    <a href="{$url_path}employee/administration/" class="pull-right">Edit</a>
                                                </span>
                                                <span>
                                                    <a href="{$url_path}profile_photo.php">
                                                        <img src="{$url_path}{$picture}?v={filemtime($picture)}" alt="Avatar" width="50" height="50" />
                                                    </a>
                                                </span>
                                                <span class="details">
                                                    <a href="javascript:void(0);">{$user_display_name}</a>
                                                    {*{if $user_display_email neq ''}{$user_display_email}{/if}
                                                    {if $user_display_phone neq ''}<br/>{$user_display_phone}{/if}*}
                                                </span>
                                                <span class="clearfix"></span>
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <a class="btn btn-default btn-mini pull-right" href="{$url_path}logout/">{$translate.logout}</a>
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                                <!-- // Profile / Logout menu END -->
                                {* <li class="account dropdown dd-1" style="border-left: 1px solid #ccc !important;">
                                    <a data-toggle="control-"><i></i></a>

                                    <!-- Right sidebar Toggle Button -->
                                    <button type="button"  class="side-bar-btn" id="right-sidebar-button">
                                        <span class="icon-bar icon-reorder"></span></button>
                                    <!-- // Right sidebar Toggle Button  END -->
                                </li> *}
                                <li id="chat_thread">
                                    <a href="javascript:void(0);" data-toggle="control-sidebar"><i class="icon icon-comments"></i></a>
                                </li>
                                <li>
                            <a href="#" class="faq">{$translate.faq}</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="menu" class="hidden-phone no-print">
                    <a href="javascript:void(0)" class="appbrand">{*{$translate.quick_admin_side_menu}*}</a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="{$url_path}profile_photo.php">
                                <img src="{$url_path}{$picture}?v={filemtime($picture)}" alt="Avatar" class="img-user-thumb-image" />
                            </a>
                        </span>
                        <ul class="side_links">
                            <li id="side_menu_li_1" {if $menu.submenu == 1}class="active"{/if}>
                                <a href="{if isset($smarty.cookies.startup_summery_view) and $smarty.cookies.startup_summery_view eq 'employee'}{$url_path}all/employee/gdschema/l/{else}{$url_path}all/gdschema/l/{/if}" class="icon-calendar"><i></i> <span class="hidden-label">{$translate.submenu_basic_schedule}</span></a>
                            </li>
                            {if $user_role != 4}
                                <li id="side_menu_li_2" {if $menu.submenu == 2}class="active"{/if}>
                                    {if $privileges_general.add_employee == 1 || $privileges_general.edit_employee == 1}
                                        <a href="{$url_path}list/employee/act/" class="icon-group"><i></i> <span class="hidden-label">{$translate.submenu_employee}</span></a>
                                    {else}
                                        <a href="{$url_path}employee/administration/" class="icon-group"><i></i> <span class="hidden-label">{$translate.submenu_mydata}</span></a>
                                    {/if}
                                </li>
                            {/if}
                            {if $privileges_general.add_customer == 1 || $privileges_general.edit_customer == 1}
                                <li id="side_menu_li_3" {if $menu.submenu == 3}class="active"{/if}>
                                    <a href="{$url_path}list/customer/act/" class="icon-user"><i></i> <span class="hidden-label">{$translate.submenu_customer}</span></a>
                                </li>
                            {/if}
                            {if $candg == 1 || $privileges_mc.leave_notification == 1 || $privileges_mc.leave_approval == 1 ||  $privileges_mc.leave_rejection == 1 || $privileges_mc.leave_edit == 1 || $privileges_mc.notes == 1 || $privileges_mc.notes_approval == 1 || $privileges_mc.notes_rejection == 1 || $privileges_mc.cirrus_mail == 1 || $privileges_mc.external_mail == 1 || $privileges_mc.sms == 1 || $surveys_count >0 || ($user_role eq 4)}{* ($privileges_mc.document_archive == 1 || $user_role eq 4) *}
                                <li id="side_menu_li_5" {if $menu.submenu == 5}class="active"{/if}>
                                    <a href="{$url_path}message/center/" class="icon-envelope"><i></i> <span class="hidden-label">{$translate.submenu_msg_center}</span></a>
                                </li>
                            {/if}
                            <li id="side_menu_li_6" {if $menu.submenu == 6}class="active"{/if}>
                                <a href="{$url_path}reports/" class=" icon-pencil"><i></i> <span class="hidden-label">{$translate.submenu_reports}</span></a>
                            </li>

                            

                            {if $privileges_general.inconvenient_timing == 1}
                                <li id="side_menu_li_7" {if $menu.submenu == 7}class="active"{/if}>
                                    <a href="{$url_path}inconvenient/timings/list/" class=" icon-bar-chart"><i></i> <span class="hidden-label">{$translate.submenu_inconvenient_time}</span></a>
                                </li>
                            {/if}
                            {if $privileges_forms.fkkn == 1 || $privileges_general.employer_signing == 1 || $privileges_forms.leave == 1 || $privileges_forms.certificate == 1 || $privileges_forms.form_1 == 1 || $privileges_forms.form_2 == 1 || $privileges_forms.form_3 == 1 || $privileges_forms.form_1_report == 1 || $privileges_forms.form_2_report == 1 || $privileges_forms.form_3_report == 1 || $user_role == 4}
                                <li id="side_menu_li_8" {if $menu.submenu == 8}class="active"{/if}>
                                    <a href="{$url_path}forms/" class="icon-file"><i></i> <span class="hidden-label">{$translate.submenu_forms}</span></a>
                                </li>
                            {/if}
                            {if $privileges_general.administration == 1 || $privileges_general.administration_fk_export == 1 || $privileges_general.recruitment == 1} {*|| $privileges_general.survey == 1*}
                                <li id="side_menu_li_9" {if $menu.submenu == 9}class="active"{/if}>
                                    <a href="{$url_path}administration/" class="icon-key"><i></i> <span class="hidden-label"> {$translate.administration}</span></a>
                                </li>
                            {/if}
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
                                {block name="content"}{/block}
                                
                            </div>

                        </div>
                    </div>
                </div>
                            
                {*<div class="clearfix"></div>
                <div id="footer" class="hidden-print">
                    <div class="copy">&copy; 2015 - <a href="http://www.entraze.com">Entraze</a> - All Rights Reserved.</div>
                </div>*}

                <div id="chat_panel_wraper">
                    <div id="chat_list_main_wraper_group" class="people_list_fixed_content right_block_section panel-closed" style="overflow-y: auto; right: 0px; left: 190px;">
                        <div style="margin: 0px 0px 7px !important;" class="widget clearfix">
                            <div class="widget-header span12 no-ml" style="width: inherit;">
                                <h1>{$translate.chats_header}</h1>
                            </div>
                        </div>
                        <div style="margin: 0px 10px 5px;" class="peoples_list clearfix">
                            <div class="span12 no-ml clearfix mb" style="width: 100%;">
                                <div style="width: 100%;" class="input-prepend no-ml"> 
                                    <span class="add-on icon icon-search" style="height: 16px;"></span>
                                    <input class="form-control" placeholder="{$translate.search}" id="chat-people-search" type="text" style="width: 86%;">
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


        

    
    <script src="{$url_path}js/jquery-1.10.1.min.js"></script><!-- JQuery -->
    <script src="{$url_path}js/jquery-migrate-1.2.1.min.js"></script>
    <script src="{$url_path}js/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script><!-- JQueryUI -->
    <!-- JQueryUI Touch Punch --><!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
    <script src="{$url_path}js/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="{$url_path}js/plugins/system/modernizr.js"></script><!-- Modernizr -->
    <script src="{$url_path}js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="{$url_path}js/demo/common.js"></script><!-- Common Demo Script -->
    <script src="{$url_path}js/plugins/other/holder/holder.js"></script><!-- Holder Plugin -->
    <script src="{$url_path}js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
    <script src="{$url_path}js/bootstrap-select/bootstrap-select.js"></script><!-- Bootstrap Extended -->
    <script src="{$url_path}js/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
    <script src="{$url_path}js/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
    <script src="{$url_path}js/plugins/system/jquery.cookie.js"></script><!-- Cookie Plugin -->
    <script src="{$url_path}js/tooltip.js" type="text/javascript"></script><!--TOOLTIP BEGIN-->
    <script src="{$url_path}js/jquery.mCustomScrollbar.concat.min.js"></script>   <!--scroll bar-->
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
        var user = '{$user_id}';
        var name = '{$user_display_name}';    
        var user_current_company = '{$company_id}';
        var chatListPeoples = {$chat_users};   
        // console.log('A', JSON.stringify(chatListPeoples));
        var chat_service_url = '{$chat_service_url}';
    </script>
{*    <script src="{$url_path}js/demo/themer.js"></script>*}
    <script src="{$url_path}js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->
    <script type="text/javascript" src="{$url_path}js/clock.js"></script>
    <script type="text/javascript" src="{$url_path}js/nice-scroll.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.contextmenu.js"></script>

    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.droppable.js"></script>
    <script src="{$chat_service_url}/socket.io/socket.io.js"></script>  
    <script type="text/javascript" src="{$url_path}js/client.js?v={filemtime('js/client.js')}"></script>
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
        navigator.serviceWorker.register('{$url_path}firebase-messaging-sw.js')
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
                        window.open('http://docs.google.com/viewer?url={$url_path}downloads/'+filename+'&embedded=true');
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
                                                            <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  ' + thrownError + '\n\
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
                                                            <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  ' + thrownError + '\n\
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
                                                            <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  ' + thrownError + '\n\
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
                                                            <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  ' + thrownError + '\n\
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
    {block name='script'}{/block}
    </body>
</html>