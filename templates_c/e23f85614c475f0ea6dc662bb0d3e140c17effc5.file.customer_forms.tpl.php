<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 06:34:29
         compiled from "/home/time2view/public_html/cirrus/templates/customer_forms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9746230145fcdccf55c17e1-56484159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e23f85614c475f0ea6dc662bb0d3e140c17effc5' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/customer_forms.tpl',
      1 => 1499168204,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9746230145fcdccf55c17e1-56484159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'message' => 0,
    'translate' => 0,
    'privileges_forms' => 0,
    'url_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcdccf5649e24_06044674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcdccf5649e24_06044674')) {function content_5fcdccf5649e24_06044674($_smarty_tpl) {?>


    <script type="text/javascript">
        $(document).ready(function(){
            $(window).resize(function(){
                $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
            }).resize();
        });
    </script>

 
<div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_forms'];?>
</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12 icons-group">
                        <div class="span12 icons-group">
                            <ul>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_1']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_1_report']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_1.php',8);">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_1'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_1_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_2']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_2_report']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_2.php',8);">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_2_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_3']==1||$_smarty_tpl->tpl_vars['privileges_forms']->value['form_3_report']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_3.php',8);">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_3'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_3_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_4']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_4.php">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_4'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_4_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_5']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_5.php">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_5'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_5_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_6']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_6.php">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_6'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_6_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
				<?php if ($_smarty_tpl->tpl_vars['privileges_forms']->value['form_7']==1){?>
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
form_7.php">
                                            <h4 class="title"><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_7'];?>
</h4>
                                            <h5 class="sub-title"><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['form_7_desc'];?>
</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                <?php }?>
                            </ul>               
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>

<?php }} ?>