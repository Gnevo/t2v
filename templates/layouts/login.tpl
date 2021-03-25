<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full"><!-- <![endif]-->
    <head>
        <title>{$app_name} {block name='title'}{/block}</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="{$url_path}images/favicon.ico" />

        <link rel="stylesheet" href="{$url_path}css/bootstrap.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="{$url_path}css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="{$url_path}fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome.min.css">
        <!--[if IE 7]><link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        
        <link rel="stylesheet" href="{$url_path}css/style-flat.css?1372280934" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="{$url_path}css/style.css" type="text/css" /><!-- CHILD THEME -->
        {block name='style'}{/block}
    </head>
    <body class="login ">
        <div id="login">
            <div class="container">
                <h1><i class="icon-lock icon-lare"></i> TIDSREDOVISNING Cirrus</h1>
                {block name="content"}{/block}
                
                <div id="login_notification" class="innerT center" style="margin-bottom: 10px;">
                    <p>{$translate.notification_message_1}</p>
                    <p>{$translate.notification_message_2}</p>
                    <p>{$translate.notification_message_link}</p>
                </div>
            </div>
        </div>

        <script src="{$url_path}js/jquery-1.10.1.min.js"></script><!-- JQuery -->
        <script src="{$url_path}js/jquery-migrate-1.2.1.min.js"></script>
        <script src="{$url_path}js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="{$url_path}js/demo/common.js?1372280934"></script><!-- Common Demo Script -->
        <script src="{$url_path}js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
        {block name='script'}{/block}
    </body>
</html>