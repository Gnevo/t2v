<?php /* Smarty version Smarty-3.1.8, created on 2020-12-07 10:07:48
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_customer_employee_work_summary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9742542895fcdfef4596202-70623656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '461e525c9d6947d3d953ab4f0db282436016d9af' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_customer_employee_work_summary.tpl',
      1 => 1429621910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9742542895fcdfef4596202-70623656',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'translate' => 0,
    'customers_to_allocate' => 0,
    'url_path' => 0,
    'customer_to_allocate' => 0,
    'sort_by_name' => 0,
    'employees_to_allocate' => 0,
    'year_week' => 0,
    'employee_to_allocate' => 0,
    'leave_employees' => 0,
    'leave_employee' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcdfef4607d92_96176827',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcdfef4607d92_96176827')) {function content_5fcdfef4607d92_96176827($_smarty_tpl) {?>
        <!--TABLE 1--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['companies_to_be_assigned'];?>
</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars['customer_to_allocate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_to_allocate']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers_to_allocate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_to_allocate']->key => $_smarty_tpl->tpl_vars['customer_to_allocate']->value){
$_smarty_tpl->tpl_vars['customer_to_allocate']->_loop = true;
?>
                                <tr>
                                    <td><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['first_date'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['customer_id'];?>
/',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['code'];?>
"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['customer_name_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['customer_name'];?>
<?php }?></a></td>
                                    <td style="width:127px"><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['first_date'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['customer_id'];?>
/',1);" href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['total_hours'];?>
h</span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 1 END-->
        <!--TABLE 2--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['workers_to_be_assigned'];?>
</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars['employee_to_allocate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee_to_allocate']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_to_allocate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee_to_allocate']->key => $_smarty_tpl->tpl_vars['employee_to_allocate']->value){
$_smarty_tpl->tpl_vars['employee_to_allocate']->_loop = true;
?>
                                <tr>
                                    <td><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['username'];?>
/',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['code'];?>
"><?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['name'];?>
</a></td>
                                    <td style="width:127px"><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['username'];?>
/',1);" href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['allocated'];?>
h <?php if ($_smarty_tpl->tpl_vars['employee_to_allocate']->value['monthly_hour']){?> / <?php echo $_smarty_tpl->tpl_vars['employee_to_allocate']->value['monthly_hour'];?>
h<?php }?></span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 2 END-->
        <!--TABLE 3--><div class="span4">
            <div class="widget widget-heading-simple widget-body-white no-mt no-mb">
                <div class="widget-body table-1">
                    <table class="footable table table-bordered table-white table-primary" style="margin:0">
                        <thead>
                            <tr>
                                <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['workers_on_leave'];?>
</th>
                                <th style="width:117px"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="week-table-height-fix boxscroll">
                        <table class="footable table table-bordered table-white table-primary" style="margin:0">
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars['leave_employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['leave_employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['leave_employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['leave_employee']->key => $_smarty_tpl->tpl_vars['leave_employee']->value){
$_smarty_tpl->tpl_vars['leave_employee']->_loop = true;
?>
                                <tr>
                                    <td><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['employee'];?>
/',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['code'];?>
"><?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['type'];?>
</a></td>
                                    <td style="width:127px"><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['employee'];?>
/',1);" href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['leave_employee']->value['date'];?>
</span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--TABLE 3 END-->
   <?php }} ?>