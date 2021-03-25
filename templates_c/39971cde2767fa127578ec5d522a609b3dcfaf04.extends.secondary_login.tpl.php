<?php /* Smarty version Smarty-3.1.8, created on 2021-01-13 08:32:12
         compiled from "/home/time2view/public_html/cirrus/templates/secondary_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19161903655fcb60e8af7997-86172826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39971cde2767fa127578ec5d522a609b3dcfaf04' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/secondary_login.tpl',
      1 => 1610526699,
      2 => 'file',
    ),
    '56af5fa2ccbeb80e335e33c45ec5543716218193' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/login.tpl',
      1 => 1456404684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19161903655fcb60e8af7997-86172826',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb60e8bab046_22344340',
  'variables' => 
  array (
    'app_name' => 0,
    'url_path' => 0,
    'translate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb60e8bab046_22344340')) {function content_5fcb60e8bab046_22344340($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sidebar sidebar-full"><!-- <![endif]-->
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
css/style-flat.css?1372280934" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css" type="text/css" /><!-- CHILD THEME -->
        
    </head>
    <body class="login ">
        <div id="login">
            <div class="container">
                <h1><i class="icon-lock icon-lare"></i> TIDSREDOVISNING Cirrus</h1>
                
<div class="wrapper">
    
    <div class=""><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
    <div class="widget widget-heading-simple widget-body-gray clearfix">
        <div class="widget-body no-ml">
            <form id="form" name="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
secondary/login/<?php if (isset($_smarty_tpl->tpl_vars['redirect']->value)&&$_smarty_tpl->tpl_vars['redirect']->value!=''){?>?redirect=<?php echo $_smarty_tpl->tpl_vars['redirect']->value;?>
<?php }?>">
                
                
                <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['username_login_secondary'];?>
</label>
                <input name="username" id="username" value="<?php echo $_SESSION['user_id'];?>
" class="input-block-level required medium" type="text" readonly="readonly" /> 
                
                <?php if ($_smarty_tpl->tpl_vars['current_user_role']->value!=0){?>
                    <?php if ($_smarty_tpl->tpl_vars['user_have_multiple_company']->value){?>
                        <label for="company">2. <?php echo $_smarty_tpl->tpl_vars['translate']->value['company_login'];?>
</label>
                        <select name="user_company" id="user_company" class="input-block-level mb">
                            <?php  $_smarty_tpl->tpl_vars['user_company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user_company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['user_companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user_company']->key => $_smarty_tpl->tpl_vars['user_company']->value){
$_smarty_tpl->tpl_vars['user_company']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['user_company']->value['id'];?>
" <?php if (isset($_POST['user_company'])&&$_POST['user_company']==$_smarty_tpl->tpl_vars['user_company']->value['id']){?>selected="selected"<?php }elseif(isset($_SESSION['db_name'])&&$_SESSION['db_name']==$_smarty_tpl->tpl_vars['user_company']->value['db_name']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['user_company']->value['name'];?>
</option>
                            <?php } ?>
                        </select> 
                    <?php }else{ ?>

                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sel_company_id']->value;?>
" name="user_company" />
                    <?php }?>
                <?php }?>
                <label for="password"><?php if ($_smarty_tpl->tpl_vars['user_have_multiple_company']->value){?>3<?php }else{ ?>2<?php }?>. <?php echo $_smarty_tpl->tpl_vars['translate']->value['password_login'];?>
</label>
                <input name="password" id="password" type="password" tabindex="2" class="input-block-level margin-none required medium"/>
                <div class="separator bottom"></div>

                
                
                <div class="row-fluid" style="margin-bottom: 15px">
                        <input type="checkbox" id="chk_terms" style="margin: -1px 5px 0 0 !important" <?php if ($_smarty_tpl->tpl_vars['login_cookie']->value){?> checked <?php }?>><label for="chk_terms" style="display: contents;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['accept_terms_conditions'];?>
</label><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
GDPRTime2viewAB.pdf" target="_blank"><?php echo $_smarty_tpl->tpl_vars['translate']->value['user_terms_conditions'];?>
</a>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" id="loginbtn" class="btn btn-inverse logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['login'];?>
" type="submit" <?php if ($_smarty_tpl->tpl_vars['agreement']->value){?>disabled="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['login'];?>
</button>
                        <?php if ($_smarty_tpl->tpl_vars['cancel_button']->value){?>
                            <button name="btnCancel" id="btnCancel" class="btn btn-danger logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
" type="button" onclick="cancel_selection();"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        <?php }else{ ?>
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
" type="button" onclick="document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
';"><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</button>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['current_user_role']->value!=0){?><a class="password pull-left" onclick="forget_password();" href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['translate']->value['forgot_password'];?>
</a><?php }?>
                    </div>
                </div>
            </form>
            <?php if ($_smarty_tpl->tpl_vars['cancel_button']->value){?>
                <form id="user_company_selection_cancel" class="hide" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
change_company.php" method="post" name="user_company_selection_cancel">
                    <input type="hidden" name="action" value="cancel_selection" />
                </form>
            <?php }?>
                            
        </div>
    </div>
            
</div>
            

                
                <div id="login_notification" class="innerT center" style="margin-bottom: 10px;">
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_1'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_2'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['translate']->value['notification_message_link'];?>
</p>
                </div>
            </div>
        </div>

        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-1.10.1.min.js"></script><!-- JQuery -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/demo/common.js?1372280934"></script><!-- Common Demo Script -->
        <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
        
<script async src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
<script type="text/javascript">
function forget_password(){
    <?php if ($_smarty_tpl->tpl_vars['user_have_multiple_company']->value){?>
        var company_id = $('#user_company').val();
        if(typeof company_id == 'undefined') company_id = '';
    <?php }else{ ?>
        var company_id = '<?php echo $_smarty_tpl->tpl_vars['sel_company_id']->value;?>
';
    <?php }?>
    document.location = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
secondary/login/forgotpassword/'+company_id+'/';
}
<?php if ($_smarty_tpl->tpl_vars['cancel_button']->value){?>
    function cancel_selection(){
        $("#user_company_selection_cancel").submit();
    }
<?php }?>
$(document).ready(function (){
    $("#password").focus();
    $('#chk_terms').click(function() {
        if(<?php echo $_smarty_tpl->tpl_vars['agreement']->value;?>
)
                $("#loginbtn").prop('disabled',!this.checked);
    });  
    <?php if ($_smarty_tpl->tpl_vars['login_cookie']->value){?>
        $("#loginbtn").prop('disabled',false);
    <?php }?>
});
 //bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){  });
</script>

    </body>
</html><?php }} ?>