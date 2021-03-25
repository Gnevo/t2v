<?php /* Smarty version Smarty-3.1.8, created on 2020-12-14 15:02:24
         compiled from "/home/time2view/public_html/cirrus/templates/company_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13672501845fd77e8073ff00-00485120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a3b768c9b6b614ba1d0f57cce3a4003e16cec77' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/company_add.tpl',
      1 => 1564568668,
      2 => 'file',
    ),
    '8e143e5444276d3c78214cb03ab6ff91d537b3ce' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/root_dashboard.tpl',
      1 => 1547530922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13672501845fd77e8073ff00-00485120',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'user_display_name' => 0,
    'translate' => 0,
    'picture' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fd77e8095c438_61025499',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd77e8095c438_61025499')) {function content_5fd77e8095c438_61025499($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/home/time2view/public_html/cirrus/libs/plugins/function.cycle.php';
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/favicon.ico" />
        
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/bootstrap.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome.min.css">
        <!--[if IE 7]><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" /><!-- Uniform Pretty Checkboxes -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap-select/bootstrap-select.css" /><!-- Bootstrap Extended -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style-flat.css" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css" type="text/css" /><!-- CHILD THEME -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/google-font.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/message.css" type="text/css" /><!--ICONS FONTS BEGIN-->
        
<link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/cirrus.css" rel="stylesheet" type="text/css" />
<style>
    .ui-dialog{ z-index: 5001 !important;}
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
                                    <span style="margin-right:5px; color:#505050;font-size: 18px;" class="icon-dashboard"></span>Root
                                </li>
                            </ul>
                            <ul class="topnav pull-right">
                                <li style="border-right: 1px solid #CCC; border-left: 1px solid #CCC; padding-right:10px;" id="clock" class="hidden-phone hidden-tablet"></li>
                                
                                <li class="account dropdown dd-1">
                                    <a data-toggle="dropdown" href="javascript:void(0);" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1"><?php echo $_smarty_tpl->tpl_vars['user_display_name']->value;?>
</span><i></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <span>
                                                <a class="btn btn-default btn-mini pull-right" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
logout/"><?php echo $_smarty_tpl->tpl_vars['translate']->value['logout'];?>
</a>
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="menu" class="hidden-phone">
                    <a href="javascript:void(0)" class="appbrand"></a>
                    <div class="slim-scroll" data-scroll-height="800px">
                        <span class="profile center">
                            <a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['picture']->value;?>
" alt="Avatar" /></a>
                        </span>
                        <ul class="side_links">
                            <li id="side_menu_li_1" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==1){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
dashboard/" class="icon-building"><i></i> <span class="hidden-label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['submenu_company'];?>
</span></a>
                            </li>
                            <li id="side_menu_li_2" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==2){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
users_list_for_root.php" class="icon-group"><i></i> <span class="hidden-label">All Users</span></a>
                            </li>
                            <li id="side_menu_li_3" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==3){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
user_company_find_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Find User</span></a>
                            </li>
                            <li id="side_menu_li_4" <?php if ($_smarty_tpl->tpl_vars['menu']->value['submenu']==4){?>class="active"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fake_users_list_for_root.php" class="icon-user"><i></i> <span class="hidden-label">Fake User</span></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 row-width-set"></div>
                </div>
                <div class="row">
                    <div class="span12 main-center" id="main_content" style="width: 100%; margin-top:50px;">
                        <!-- Content -->
                        <div id="content">
                            <div class="innerLR" id="external_wrapper">
                                
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="tbl_hd"><span class="titles_tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company'];?>
</span>
                <div class="pull-right day-slot-wrpr-header-left" style="padding: 3px;">
                    <button class="btn btn-default btn-normal" type="button" onclick="javascript:location='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
dashboard/';"><span class="icon-arrow-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                    <button class="btn btn-default btn-normal" type="button" onclick="resetForm()"><span class="icon-refresh"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</button>
                    <button class="btn btn-default btn-normal" type="button" onclick="saveForm()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                </div>
            </div>
            <div class="clearfix" id="issue_popup" style="display:none;"></div>
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

            <form action="" method="post" name="company_register_form" id="company_register_form" enctype="multipart/form-data">
                <input type="hidden" name="setup" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value;?>
" id="setup">
                <input type="hidden" name="dir" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['upload_dir'];?>
" id="dir">
                <div class="span12 no-ml" id="forms_container_new">
                    <div class="span12 no-ml" id="employee_tab_content1" style="padding: 5px;">
                        <div class="worker_left span4"> 
                            <div id="kund" style="width: 100%;">
                                <div class="sub_hd"><span class="titles"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_information'];?>
</span></div>

                                <div class="td_raw">
                                    <label for="company_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_name_comp'];?>
*</label>
                                    <input type="text" name="company_name" id="company_name" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['name']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['name'];?>
<?php }?>" />
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['setup']->value==1){?>
                                    <div class="td_raw">
                                        <label for="datab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['database'];?>
*</label>
                                        <input type="text" name="datab" id="datab" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['db_name']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['db_name'];?>
<?php }?>" readonly="readonly">
                                    </div>
                                <?php }else{ ?>
                                    <div class="td_raw">
                                        <label for="database"><?php echo $_smarty_tpl->tpl_vars['translate']->value['database'];?>
*</label>
                                        <select name="database" id="database" style="width: 51%;">
                                            <option value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['database'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['database']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['databases']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['database']->key => $_smarty_tpl->tpl_vars['database']->value){
$_smarty_tpl->tpl_vars['database']->_loop = true;
?>
                                                <option value=<?php echo $_smarty_tpl->tpl_vars['database']->value;?>
><?php echo $_smarty_tpl->tpl_vars['database']->value;?>
</option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php }?> 
                                <div class="td_raw">
                                    <label for="org_no"><?php echo $_smarty_tpl->tpl_vars['translate']->value['organization_number'];?>
</label>
                                    <input type="text" name="org_no" id="org_no" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['org_no']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['org_no'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="company_box"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_box'];?>
</label>
                                    <input type="text" id="company_box" name="company_box" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['box']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['box'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_address_new'];?>
</label>
                                    <input type="text" name="adress" id="adress" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['address']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['address'];?>
<?php }?>">
                                </div>

                                <div class="td_raw">
                                    <label for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_zipcode_new'];?>
</label>
                                    <input type="text" name="zipcode" id="zipcode" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['zipcode']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['zipcode'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_city_new'];?>
</label>
                                    <input type="text" name="comp_city" id="comp_city" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['city']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['city'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="land_code"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_land_code_new'];?>
</label>
                                    <input type="text" name="land_code" id="land_code" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['land_code']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['land_code'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_phone_new'];?>
</label>
                                    <input type="text" name="phone" id="phone" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['phone']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['phone'];?>
<?php }?>">
                                </div><div class="td_raw">
                                    <label for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_mobile_new'];?>
</label>
                                    <input type="text" maxlength="10" name="mobile" id="mobile" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['mobile']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['mobile'];?>
<?php }?>">
                                </div><div class="td_raw">
                                    <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_email_new'];?>
</label>
                                    <input type="text" name="email" id="email" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['email']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['email'];?>
<?php }?>">
                                </div>
                                <div class="td_raw">
                                    <label for="website"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_website'];?>
</label>
                                    <input type="text" name="website" id="website" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['website']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['website'];?>
<?php }?>">
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['setup']->value!=1){?>
                                    <div class="td_raw">
                                        <label for="price"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_customer'];?>
</label>
                                        <input type="text" name="price" id="price" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['price_per_customer']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['price_per_customer'];?>
<?php }?>">
                                    </div>
                                    <div class="td_raw">
                                        <label for="price"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sms'];?>
</label>
                                        <input type="text" name="price_per_sms" id="price_per_sms" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['price_per_sms']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['price_per_sms'];?>
<?php }?>">
                                    </div>
                                <?php }?>
                                    <div class="td_raw">
                                        <label for="salary_system"><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_system'];?>
</label>
                                        <select name="salary_system" id="salary_system"  style="width: 51%;">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['company']->value['salary_system']=="1"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type1'];?>
</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['company']->value['salary_system']=="2"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type2'];?>
</option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['company']->value['salary_system']=="3"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type3'];?>
</option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['company']->value['salary_system']=="4"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type4'];?>
</option>
                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['company']->value['salary_system']=="5"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['salary_type5'];?>
</option>
                                        </select>

                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['setup']->value==1){?>
                                        <div class="td_raw">
                                            <label for="logo"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_logo'];?>
</label>
                                            <input type="text" name="logo" id="logo" value="<?php if ($_smarty_tpl->tpl_vars['company']->value['logo']!=''){?><?php echo $_smarty_tpl->tpl_vars['company']->value['logo'];?>
<?php }?>" readonly="readonly">
                                        </div>
                                    <?php }else{ ?>
                                        <div class="td_raw">                        
                                            <label for="file"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_logo'];?>
</label>
                                            <div class="fakefile_container">
                                                <div class="fakefile" style="width: 170px;">
                                                    <input name="" type="text" class="image_path" id="browsed"/>
                                                    <input name="" type="button" value="Browse"  class="image_browse"/>
                                                </div>
                                            </div>
                                            <div class="fileupload_container">
                                                <div class="fileupload">
                                                    <input type="file" name="file" id="file" class="logo_browse" onchange="putFilePath();">
                                                </div>
                                            </div>  
                                        </div>
                                    <?php }?>
                                    <div class="td_raw">
                                        <label for="status"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_billing_status'];?>
</label>
                                        <div class="radio_dv_main" style="margin-top: 5px;"><div class="radio_dv_a">  <input type="radio" name="bill_status" id="bill_active"  value="1" <?php if ($_smarty_tpl->tpl_vars['company']->value['billing_status']=="1"){?>checked="checked"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['active_company'];?>
</div>
                                            <div class="radio_dv_b"><input type="radio" name="bill_status" id="bill_inactive" value="0" <?php if ($_smarty_tpl->tpl_vars['company']->value['billing_status']=="0"||$_smarty_tpl->tpl_vars['company']->value['billing_status']==''){?>checked="checked"<?php }?>><span class="dv_cntnt"><?php echo $_smarty_tpl->tpl_vars['translate']->value['inactive_company'];?>
</span></div> 
                                        </div>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['setup']->value!=1){?>
                                        <div class="td_raw">
                                            <label for="price"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_contract_from'];?>
</label>
                                            <input type="text" value="" id="contract_from" name="contract_from" style="width:40%">
                                        </div>
                                        <div class="td_raw">
                                            <label for="price"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_contract_to'];?>
</label>
                                            <input type="text" value="" id="contract_to" name="contract_to" style="width:40%">
                                        </div>
                                    <?php }?>
                                        <div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_start_day'];?>
</label>
                                            <select onchange="makeChange()" name="start_day" id="start_day"  style="width: 51%;">
                                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==1){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['monday'];?>
</option>
                                                <option value="2" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==2){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday'];?>
</option>
                                                <option value="3" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==3){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday'];?>
</option>
                                                <option value="4" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==4){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday'];?>
</option>
                                                <option value="5" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==5){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['friday'];?>
</option>
                                                <option value="6" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==6){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday'];?>
</option>
                                                <option value="7" <?php if ($_smarty_tpl->tpl_vars['vals']->value[0]==7){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday'];?>
</option>
                                            </select>
                                        </div>
                                        <div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_start_time'];?>
</label>
                                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['vals']->value[1];?>
" id="start_time" name="start_time" onchange="makeChange()">  
                                        </div>

                                    </div>                                                                                                  
                                </div>

                                <div class="control_users-right span8">
                                    <div class="sub_hd span12"><span class="titles"><?php echo $_smarty_tpl->tpl_vars['translate']->value['control_users'];?>
</span></div>
                                    <div class="control_user_kund span5">
                                        <div class="sub_hd"><span class="titles"><?php echo $_smarty_tpl->tpl_vars['translate']->value['control_user_1'];?>
</span></div>

                                        <div class="td_raw">
                                            <label for="first_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
*</label>
                                            <input type="text" name="first_name1" id="first_name1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['first_name'];?>
">
                                        </div>

                                        <div class="td_raw">
                                            <label for="last_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
*</label>
                                            <input type="text" name="last_name1" id="last_name1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['last_name'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="social_security1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
*</label>
                                            <input type="text" name="social_security1" id="social_security1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['social_security'];?>
" maxlength="10">

                                        </div>
                                        <div id="soc_sec1" style="color: red"></div>
                                        <div class="td_raw">
                                            <label for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                            <input type="text" name="address1" id="address1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['address'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                            <input type="text" name="city1" id="city1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['city'];?>
">
                                        </div><div class="td_raw">
                                            <label for="post"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
</label>
                                            <input type="text" name="post1" id="post1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['post'];?>
">
                                        </div><div class="td_raw">
                                            <label for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                            <input type="text" name="phone1" id="phone1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['phone'];?>
">
                                        </div><div class="td_raw">
                                            <label for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                            <input type="text" maxlength="10" name="mobile1" id="mobile1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['mobile'];?>
">
                                        </div><div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                            <input type="text" name="email1" id="email1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['email'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                            <input type="text" name="username1" id="username1" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['username'];?>
" readonly="readonly">
                                        </div>
                                        <div class="td_raw">
                                            <label for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                            <div id="pass"> <input type="button" onclick="generate_password('1')" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
" id="password" name="password" class="bttn" onchange="makeChange()"></div>
                                        </div>
                                    </div>
                                    <div class="control_user_kund span5">
                                        <div class="sub_hd"><span class="titles"><?php echo $_smarty_tpl->tpl_vars['translate']->value['control_user_2'];?>
</span></div>
                                        <div class="td_raw">
                                            <label for="first_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['first_name'];?>
</label>
                                            <input type="text" name="first_name2" id="first_name2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['first_name'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="last_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['last_name'];?>
</label>
                                            <input type="text" name="last_name2" id="last_name2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['last_name'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="social_security2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['social_security'];?>
</label>
                                            <input type="text" name="social_security2" id="social_security2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['social_security'];?>
" maxlength="10">

                                        </div>
                                        <div id="soc_sec2" style="color: red"></div>
                                        <div class="td_raw">
                                            <label for="adress"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</label>
                                            <input type="text" name="address2" id="address2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['address'];?>
">
                                        </div>
                                        <div class="td_raw">
                                            <label for="city"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
</label>
                                            <input type="text" name="city2" id="city2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['city'];?>
">
                                        </div><div class="td_raw">
                                            <label for="post"><?php echo $_smarty_tpl->tpl_vars['translate']->value['post'];?>
</label>
                                            <input type="text" name="post2" id="post2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['post'];?>
">
                                        </div><div class="td_raw">
                                            <label for="phone"><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</label>
                                            <input type="text" name="phone2" id="phone2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['phone'];?>
">
                                        </div><div class="td_raw">
                                            <label for="mobile"><?php echo $_smarty_tpl->tpl_vars['translate']->value['mobile'];?>
</label>
                                            <input type="text"maxlength="10" name="mobile2" id="mobile2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['mobile'];?>
">
                                        </div><div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</label>
                                            <input type="text" name="email2" id="email2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['email'];?>
">
                                        </div><div class="td_raw">
                                            <label for="email"><?php echo $_smarty_tpl->tpl_vars['translate']->value['username'];?>
</label>
                                            <input type="text" name="username2" id="username2" value="<?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['username'];?>
"readonly="readonly">
                                        </div>
                                        <div class="td_raw">
                                            <label for="password"><?php echo $_smarty_tpl->tpl_vars['translate']->value['password'];?>
</label>
                                            <div id="pass2"> <input type="button" onclick="generate_password('2')" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['generate_password'];?>
" id="password2" name="password2" class="bttn" ></div>
                                        </div>
                                    </div>                                                                                                 
                                </div>

                                <?php if ($_smarty_tpl->tpl_vars['setup']->value==1){?>
                                    <div id="company_contrat" style="float: left" class="control_users-right span8">
                                        <div class="sub_hd" style="padding-bottom: 7px"><span class="titles"><?php echo $_smarty_tpl->tpl_vars['translate']->value['control_users'];?>
</span>
                                            <a href="javascript:void(0);" class="add" style="margin-right: 4px" onclick="popup('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_add_company_contract.php?company_id=<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
&action=add')"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new'];?>
</a>
                                        </div>
                                        <div class="" style="padding-left: 5px; padding-right: 5px;">
                                            <table class="table_list span12 table table-white table-bordered table-hover table-responsive table-primary table-Anställda recruitment-table" style="margin-top: 5px">
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_from'];?>
</th>
                                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_to'];?>
</th>
                                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sms'];?>
</th>
                                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_customer'];?>
</th>
                                                    <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_per_sign'];?>
</th>
                                                    <th width="10%"></th>
                                                </tr>
                                                <?php $_smarty_tpl->tpl_vars['val'] = new Smarty_variable(1, null, 0);?>
                                                <?php  $_smarty_tpl->tpl_vars['contract'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contract']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_contracts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contract']->key => $_smarty_tpl->tpl_vars['contract']->value){
$_smarty_tpl->tpl_vars['contract']->_loop = true;
?>
                                                    <tr class="<?php echo smarty_function_cycle(array('values'=>"even,odd"),$_smarty_tpl);?>
">
                                                        <td><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['contract_from'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['contract_to'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['price_per_sms'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['price_per_customer'];?>
</td>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['contract']->value['price_per_sign'];?>
</td>
                                                        <td style="padding: 3px 4px;">
                                                            <a href="javascript:void(0);" class="settings" onclick="popup('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_add_company_contract.php?company_id=<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
&action=edit&contract_id=<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
')"><img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/settings.png" border="0" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['edit'];?>
" width="25"/></a>
                                                            <a href="javascript:void(0);"  class="delete" style="width: 3px; height: 3px;" onclick="popup_delete('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_add_company_contract.php?company_id=<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
&action=delete&contract_id=<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
')" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
"></a>
                                                        </td>

                                                    </tr>
                                                    <?php $_smarty_tpl->tpl_vars['val'] = new Smarty_variable($_smarty_tpl->tpl_vars['val']->value+1, null, 0);?>
                                                <?php }
if (!$_smarty_tpl->tpl_vars['contract']->_loop) {
?>
                                                    <tr><td colspan="6">
                                                            <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
</div>
                                                        </td></tr>
                                                    <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                <?php }?>
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
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/other/jquery.ba-resize.js"></script><!-- Ba-Resize Plugin -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/clock.js"></script>

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
    
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.maskedinput.js"></script>
<script type="text/javascript">


$(document).ready(function(){
$.mask.definitions['~']='[1-9]';
    $("#org_no").mask("?~99999-9999", { placeholder:" " });
//$("#org_no").mask("~999999-9999");
if($('#username1').val() == ''){
        $( "#contract_from, #contract_to" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/date_pic.gif",
            buttonImageOnly: true
    });
}
//generating username w.r.t lastname blur
        $('#database').blur(function() {
            var data_val = $('#database').val();
            if(data_val == "1"){
                 $('#database').addClass("error");
            }else{
                 $('#database').removeClass("error");
            }
        });
        
        $('#company_name').blur(function() {
            var data_val = $('#company_name').val();
            if(data_val == ""){
                 $('#company_name').addClass("error");
            }else{
                 $('#company_name').removeClass("error");
            }
        });
        if($('#username1').val() == ''){
        $('#last_name1').blur(function() {
                var last1 = $('#last_name1').val();
                if(last1 != ""){
                     $('#last_name1').removeClass("error");
                }
                if($('#last_name1').val() != "" && $('#first_name1').val() != ""){
                $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : $('#first_name1').val() , last_name : $('#last_name1').val() },
                        function(data){
                                //$('#username1').val(data);
                                var username1 = $("#username2").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username1').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username1').val(data);
                            }
                                //if(parseInt(data.substring(4,7)) > 1)
                                // $('#dialog_hidden').load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_global_check.php?ssno=" + $('#social_security').val());
        });
        }
        });
        
			
			
 //generating username w.r.t firstname blur
 //if($('#username1').val() =="") {
         $('#first_name1').blur(function() {
            var first1 = $('#first_name1').val();
                if(first1 != ""){
                    $('#first_name1').removeClass("error");
                }
             if($('#last_name1').val() != "" && $('#first_name1').val() != ""){
                  $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : $('#first_name1').val() , last_name : $('#last_name1').val() },
                      function(data){
                            ///$('#username1').val(data);
                            var username1 = $("#username2").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username1').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username1').val(data);
                            }
    });
    }
    });
    }
   // }
   // if($('#username2').val() =="") {
   
    $('#last_name2').blur(function() {
    var username2 = $('#username2').val();
    var setup = '<?php echo $_smarty_tpl->tpl_vars['setup']->value;?>
';
    if (setup != '1' || username2 == '' || username2 === null){
        var last2 = $('#last_name2').val();
                if(last2 != ""){
                    $('#last_name2').removeClass("error");
                }
            if($('#last_name2').val() != "" && $('#first_name2').val() != ""){
               $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : $('#first_name2').val() , last_name : $('#last_name2').val() },
                    function(data){
                             //$('#username2').val(data);
                             var username1 = $("#username1").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username2').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username2').val(data);
                            }
                             //if(parseInt(data.substring(4,7)) > 1)
                                //$('#dialog_hidden').load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_global_check.php?ssno=" + $('#social_security').val());
    });
    }
    }
    });
    //}
			
			
 //generating username w.r.t firstname blur
 //if($('#username2').val() =="") {
         $('#first_name2').blur(function() {
         var username2 = $('#username2').val();
        var setup = '<?php echo $_smarty_tpl->tpl_vars['setup']->value;?>
';
        if (setup != '1' || username2 == '' || username2 === null){
         var first2 = $('#first_name2').val();
                if(first2 != ""){
                    $('#first_name2').removeClass("error");
                }
             if($('#last_name2').val() != "" && $('#first_name2').val() != ""){
                  $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_generate_username/", { first_name : $('#first_name2').val() , last_name : $('#last_name2').val() },
                      function(data){
                            //$('#username2').val(data);
                            var username1 = $("#username1").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username2').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username2').val(data);
                            }
    });
    }
    }
    });
    
    $('#social_security1').blur(function() {
    var ss1 = $('#social_security1').val();
    var ss2 = $('#social_security2').val();
    if(ss2 != ss1){
        if($('#last_name1').val() != "" || $('#first_name1').val() != ""){
            $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/", { social_security : $('#social_security1').val() },
                function(data){
                    $('#soc_sec1').html(data);
                    if(data!= ""){
                        $("#social_security1").addClass("error");
                        $('#social_security1').focus();

                    }else{
                        $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_socialsecurity_present.php", { social_security : $('#social_security1').val(), 'except_uname': '<?php if ($_smarty_tpl->tpl_vars['employee_detail1']->value[0]['username']!=''){?><?php echo $_smarty_tpl->tpl_vars['employee_detail1']->value[0]['username'];?>
<?php }?>' },
                            function(data1){
                                $('#soc_sec1').html(data1);
                                if(data1 != ""){
                                    $("#social_security1").addClass("error");
                                    $('#social_security1').focus();

                                }else{
                                    $("#social_security1").removeClass("error");
                                }

                        });
                    }

            });
        }}else{
            $("#social_security1").addClass("error");
            $('#social_security1').focus();
        }
        });
        
        $('#social_security2').blur(function() {
        var ss1 = $('#social_security1').val();
    var ss2 = $('#social_security2').val();
    if(ss1 != ss2){
    if($('#last_name2').val() != "" || $('#first_name2').val() != ""){
        $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/", { social_security : $('#social_security2').val() },
            function(data){
                $('#soc_sec2').html(data);
                            if(data!= ""){
                                $("#social_security2").addClass("error");
                                $('#social_security2').focus();

                            }else{
                                $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_socialsecurity_present.php", { social_security : $('#social_security2').val(), 'except_uname': '<?php if ($_smarty_tpl->tpl_vars['employee_detail2']->value[0]['username']!=''){?><?php echo $_smarty_tpl->tpl_vars['employee_detail2']->value[0]['username'];?>
<?php }?>' },
                                    function(data1){
                                        $('#soc_sec2').html(data1);
                                        if(data1 != ""){
                                        $("#social_security2").addClass("error");
                                        $('#social_security2').focus();

                                        }else{
                                            $("#social_security2").removeClass("error");
                                        }

                                });
                            }
                            

        });
        } }else{
            $("#social_security2").addClass("error");
            $('#social_security2').focus();
        }
        });
   // }
});

function checking_required(){
    var company_name = $("#company_name").val();
      var database_name = $("#database").val();
      var first_name1 = $("#first_name1").val();
      var first_name2 = $("#first_name2").val();
      var last_name1 = $("#last_name1").val();
      var last_name2 = $("#last_name2").val();
     /* var social_security1 = $("#social_security1").val();
      var social_security2 = $("#social_security2").val();*/
            var error = 0;
            if(company_name == "" || company_name == null){
                $("#company_name").addClass("error");
                $('#company_name').focus();
                error = 1;
            }
            if(database_name == "1" ){
                $("#database").addClass("error");
                error = 1;
            }
            
            <?php if ($_smarty_tpl->tpl_vars['setup']->value!=1){?>
            if($('#price_per_sms').val() != '' || $('#price').val() != '' || $('#contract_from').val() != '' || $('#contract_to').val() != ''){
                if($('#price_per_sms').val() == ''){
                    $("#price_per_sms").addClass("error");
                    error = 1;
                }else{
                    $("#price_per_sms").removeClass("error");
                    error = 0;
                }
                if($('#price').val() == ''){
                    $("#price").addClass("error");
                    error = 1;
                }else{
                    $("#price").removeClass("error");
                    error = 0;
                }
                if($('#contract_from').val() == ''){
                    $("#contract_from").addClass("error");
                    error = 1;
                }else{
                    $("#contract_from").removeClass("error");
                    error = 0;
                }
                if($('#contract_to').val() == ''){
                    $("#contract_to").addClass("error");
                    error = 1;
                }else{
                    $("#contract_to").removeClass("error");
                    error = 0;
                }
            }
            <?php }?>
            
                if(first_name1 == "" || first_name1 == null){
                    $("#first_name1").addClass("error");
                    $('#first_name1').focus();
                    error = 1;
                }
                else{
                    $("#first_name1").removeClass("error");
                    error = 0;
                }
                if(last_name1 == "" || last_name1 == null){
                    $("#last_name1").addClass("error");
                    $('#last_name1').focus();
                    error = 1;
                }
                if($("#social_security1").val() == "" || $("#social_security1").val() == null){
                    $("#social_security1").addClass("error");
                    error = 1;
                }
                else{
                    $("#social_security1").removeClass("error");
                    error = 0;
                }
                
                Class_security1 = $("#social_security1").prop("class");
                if(Class_security1 == "error"){
                    error = 1;
                }  
                
              /*/  $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/", { social_security : $('#social_security1').val() },
                   function(data){
                       $('#soc_sec1').html(data);
                           if(data!= ""){
                           $("#social_security1").addClass("error");
                           error = 1

                           }else{
                               $("#social_security1").removeClass("error");
                           }


               });*/
                
            
            if(first_name2 != "" || last_name2 != ""){
                if(first_name2 == "" || first_name2 == null){
                    $("#first_name2").addClass("error");
                    $('#first_name2').focus();
                    error = 1;
                }
                
                if(last_name2 == "" || last_name2 == null){
                    $("#last_name2").addClass("error");
                    $('#last_name2').focus();
                    error = 1;
                }
                Class_security2 = $("#social_security2").prop("class");
                if(Class_security2 == "error"){
                    error = 1;
                }

               /* $.post("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_social_security/", { social_security : $('#social_security2').val() },
                   function(data){
                       $('#soc_sec2').html(data);
                           if(data!= ""){
                           $("#social_security2").addClass("error");
                           error = 1

                           }else{
                               $("#social_security2").removeClass("error");
                           }


               });*/
            }
            
            if(error == 0){
              return 1;
                }else{
                return 0;
                }
}
function saveForm(type){
    var error = checking_required();
    if(error == 1){
        $("#company_register_form").submit();
    }
   // $("#form").submit();
}

function putFilePath(){
    var file_path = $("#file").val();
    $("#browsed").val(file_path);
}

function popup(url) {
    //var error = checking_required();
   // if(error == 1){
        var dialog_box_new = $("#issue_popup");
        dialog_box_new.load(url);
        dialog_box_new.dialog({
            title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
',
            position: 'top',
            modal: true,
            resizable: false,
            minWidth: 10,
            close:function(event, ui) {
                $(this).dialog('close');
            }
        });
        return false;
    //}
    
}
function popup_delete(url) {
    var dialog_box_new = $("#issue_popup");
    dialog_box_new.load(url);
    dialog_box_new.dialog({
        title: '<?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 10,
        minHeight: 30
    });
    return false;
    
}

function generate_password(method){
    if(method == "1"){
        $("#pass").html('<input type="text"  id="password" name="password" value ="<?php echo $_smarty_tpl->tpl_vars['pass1']->value;?>
" >');
    }else{
        $("#pass2").html('<input type="text"  id="password2" name="password2" value ="<?php echo $_smarty_tpl->tpl_vars['pass2']->value;?>
" >');
    }
      
}


		
</script>

    </body>
</html><?php }} ?>