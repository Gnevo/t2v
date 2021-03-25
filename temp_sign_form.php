<?php
require_once('configs/config.inc.php');
global $db;

$db_name = $message = NULL;
if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == 'update' && $_POST['record_id'] != '' && $_POST['db_name'] != '') {

//    echo "<pre>" . print_r($_POST, 1) . "</pre>";
//    exit();
    
    $db_name = trim($_POST['db_name']);
    $sign_id = trim($_POST['record_id']);
    $sign_response = trim($_POST['sign_response']);
    $sign_ocsp = trim($_POST['sign_ocsp']);
    
    $new_updation_query = "";
    $dbHandle = mysql_connect("localhost", $db['username'], $db['password']);
//    $dbSel = mysql_select_db($db_name, $dbHandle);
    $dbSel = mysql_select_db($db['database_master'], $dbHandle);
//    var_dump($dbSel); 
//    echo mysql_error();
//    exit();
    if(mysql_error() != NULL){
//        $res = mysql_query($new_updation_query, $dbHandle);
        if($res || true){
            $message_class = 'alert-success';
            $message = 'Updated successfully';
        }else{
            $message_class = 'alert-danger';
            $message = 'Updation failed : <br/>Query: '.$new_updation_query;

        }
    }
    else {
        $message_class = 'alert-danger';
        $message = 'DB connect error';
    }
    
    
    $message = 'Updated successfully';
    
}
?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full sticky-sidebar"><!-- <![endif]-->
    <!-- <![endif]-->
    <head>
        <title>t2v Cirrus </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=2.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="http://192.168.0.234/works/app/t2v/cirrus-r/images/favicon.ico" />

        <link rel="stylesheet" href="http://192.168.0.234/works/app/t2v/cirrus-r/css/bootstrap.css" type="text/css" async/><!-- Bootstrap -->
        <link rel="stylesheet" href="http://192.168.0.234/works/app/t2v/cirrus-r/fonts/glyphicons/css/glyphicons.css" async/><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="http://192.168.0.234/works/app/t2v/cirrus-r/fonts/font-awesome/css/font-awesome.min.css" async>
        <link rel="stylesheet" href="http://192.168.0.234/works/app/t2v/cirrus-r/css/style-flat.css" type="text/css" async/><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="http://192.168.0.234/works/app/t2v/cirrus-r/css/style.css?v=1471864281" type="text/css" async/><!-- CHILD THEME -->


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
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="menu" class="hidden-phone">
                    <a href="javascript:void(0)" class="appbrand"></a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="">
                                <img src="http://192.168.0.234/works/app/t2v/cirrus-r/comp1/profile/dodo001.jpg" alt="Avatar" />
                            </a>
                        </span>
                        <ul class="side_links" style="visibility: hidden;">
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
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
                                        <div class="span12 no-ml" style="margin-left: 0px;">
                                            <div style="margin: 15px 0px 0px ! important;" class="widget">
                                                <div style="" class="widget-header span12">
                                                    <div class="span4 day-slot-wrpr-header-left span6">
                                                        <h1 style="">Update Sign details <span class="subtitle"></span></h1>
                                                    </div>
                                                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                                        <button class="btn btn-default btn-normal pull-right"  onclick="$('#sign_form').submit();" type="button"><i class=' icon-save'></i> Spara</button>
                                                    </div>
                                                </div>
                                                <div class="span12 widget-body-section input-group">
                                                    <?php if($message != NULL){ ?>
                                                        <div style="min-height: 0px; margin-left: 0;" class="span12" id="left_message_wraper">
                                                            <div class="alert <?php echo $message_class; ?> alert-dismissable no-ml no-mr">
                                                                <a class="close" data-dismiss="alert" href="#">×</a>
                                                                <strong><i class="icon-ok-sign icon-large"></i> Success</strong>:  <?php echo $message; ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row-fluid">
                                                        <form method="post" id="sign_form" name="sign_form">
                                                            <input type="hidden" id="action" name="action" value="update">
                                                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">

                                                                <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                                                    <label style="float: left;" class="span3" for="db_name">DB Name</label>
                                                                    <div class="span9" style="margin: 0px;">
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input id="db_name" name="db_name" value="<?php echo $db_name; ?>"  class="form-control span11" type="text" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                                                    <label style="float: left;" class="span3" for="record_id">Sign Record ID</label>
                                                                    <div class="span9" style="margin: 0px;">
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input id="record_id" name="record_id" value=""  class="form-control span11" type="text" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                                                    <label style="float: left;" class="span3" for="sign_response">Sign Response</label>
                                                                    <div class="span9" style="margin: 0px;">
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <textarea id="sign_response" name="sign_response" class="form-control span11"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="margin: 10px 0px ! important;" class="span12 no-ml">
                                                                    <label style="float: left;" class="span3" for="sign_ocsp">Sign OCSP</label>
                                                                    <div class="span9" style="margin: 0px;">
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <textarea id="sign_ocsp" name="sign_ocsp" class="form-control span11"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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


        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/jquery-1.10.1.min.js"></script><!-- JQuery -->
        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/demo/common.js"></script><!-- Common Demo Script -->
        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/plugins/system/jquery.cookie.js"></script><!-- Cookie Plugin -->
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
        </script>

        <script src="http://192.168.0.234/works/app/t2v/cirrus-r/js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->

    </body>
</html>