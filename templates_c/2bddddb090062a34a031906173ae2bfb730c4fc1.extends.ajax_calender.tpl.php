<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 12:21:16
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_calender.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10427752945fcb7b3c917ec8-76801954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bddddb090062a34a031906173ae2bfb730c4fc1' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_calender.tpl',
      1 => 1565163068,
      2 => 'file',
    ),
    'ce4febf4e508230689026b0cffa9751d916fb1c3' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/ajax_popup.tpl',
      1 => 1425363384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10427752945fcb7b3c917ec8-76801954',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb7b3c9b9931_36444787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb7b3c9b9931_36444787')) {function content_5fcb7b3c9b9931_36444787($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
?>




    <script>
        function navigateCalender(path) {
            $('#calendar-container').load(path);
        }
    </script>


    <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">
        <thead>
            <tr>
                <th style="width: 40px;" onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['year']->value-1;?>
/<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-left"></i></span></th>
                <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['prv_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prv_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>')"><span class="btn btn-block btn-default span12"><i class="icon-angle-left"></i></span></th>
                <th colspan="4" class="table-col-center center" onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['cur_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['cur_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['cur_day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>')"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['month_label']->value];?>
, <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</th>
                <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['next_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>')"><span class="btn btn-block btn-default span12"><i class="icon-angle-right"></i></span></th>
                <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['year']->value+1;?>
/<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-right"></i></span></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 40px;" class="table-col-center">V</th>
                    <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                    <th class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week_day']->value['label']];?>
</th>
                    <?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['month_week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month_week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month_week']->key => $_smarty_tpl->tpl_vars['month_week']->value){
$_smarty_tpl->tpl_vars['month_week']->_loop = true;
?>
                <tr>
                    <td onclick ="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['year'];?>
/<?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>1/<?php }?>');" class="table-col-center weeks-small-calender" style="width:40px;"><?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
</td>
                    <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_week']->value['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                        <td onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all<?php if ($_smarty_tpl->tpl_vars['is_employee_starup_page']->value){?>/employee<?php }?>/gdschema/<?php echo $_smarty_tpl->tpl_vars['week_day']->value['year'];?>
|<?php echo $_smarty_tpl->tpl_vars['week_day']->value['week'];?>
/<?php echo $_smarty_tpl->tpl_vars['week_day']->value['date'];?>
/', 1);"class="table-col-center <?php if ($_smarty_tpl->tpl_vars['week_day']->value['type']=='old'){?>coming-days<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='current'){?>today-small-calender<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='holiday'){?>off-days<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='redday'){?>off-days<?php }elseif((smarty_modifier_date_format($_smarty_tpl->tpl_vars['week_day']->value['date'],'%u'))==7){?>off-days<?php }?>"><?php echo $_smarty_tpl->tpl_vars['week_day']->value['day'];?>
</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
        <thead>
            <tr>
                <th colspan="8">
        <ul>
            <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
                <li onclick="monthReloadCalendar('<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['month']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
');"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['month']->value['label']];?>
</li>
            <?php } ?>
        </ul></th>
</tr>
</thead>
</table>

<?php }} ?>