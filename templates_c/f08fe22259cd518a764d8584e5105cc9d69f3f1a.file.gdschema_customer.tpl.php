<?php /* Smarty version Smarty-3.1.8, created on 2021-03-18 14:01:18
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/gdschema_customer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10975566406035fb94d2a8a7-60857053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f08fe22259cd518a764d8584e5105cc9d69f3f1a' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/gdschema_customer.tpl',
      1 => 1616076061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10975566406035fb94d2a8a7-60857053',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6035fb959ba6a5_49599449',
  'variables' => 
  array (
    'url_path' => 0,
    'flag_cust_access' => 0,
    'show_right_panel' => 0,
    'message' => 0,
    'translate' => 0,
    'customers_to_allocate' => 0,
    'customer_to_allocate' => 0,
    'sort_by_name' => 0,
    'employees_to_allocate' => 0,
    'year_week' => 0,
    'employee_to_allocate' => 0,
    'leave_employees' => 0,
    'leave_employee' => 0,
    'privileges_gd' => 0,
    'search_customers' => 0,
    's_customer' => 0,
    'customer_data' => 0,
    'first_date_year' => 0,
    'first_date_month' => 0,
    'customer' => 0,
    'process_previlege' => 0,
    'rpt_page_url' => 0,
    'from_page' => 0,
    'contract_exist_flag' => 0,
    'work_hours' => 0,
    'contract_hours' => 0,
    'contract_period_hours' => 0,
    'period' => 0,
    'week_numbers' => 0,
    'week_number' => 0,
    'customer_week' => 0,
    'i' => 0,
    'customer_day' => 0,
    'holidays' => 0,
    'today_date' => 0,
    'customer_running_tasks' => 0,
    'customer_running_task_title' => 0,
    'crt' => 0,
    'login_user_role' => 0,
    'day_slot' => 0,
    'login_user' => 0,
    'swap_copied_slot' => 0,
    'slot' => 0,
    'right_panel' => 0,
    'no_of_weeks' => 0,
    'cur_week' => 0,
    'memory_slots' => 0,
    'mem_slot' => 0,
    'in_user_role' => 0,
    'week_day_names' => 0,
    'week_i' => 0,
    'in_user_details' => 0,
    'leave_types' => 0,
    'leave_type_key' => 0,
    'leave_type' => 0,
    'employee_details' => 0,
    'employee' => 0,
    'months' => 0,
    'month' => 0,
    'privileges_mc' => 0,
    'righclick_employees_for_goto' => 0,
    'empl' => 0,
    'custl' => 0,
    'translate_json' => 0,
    'privileges_gd_json' => 0,
    'week_start_date' => 0,
    'lang' => 0,
    'company_contract_checking_flag' => 0,
    'company_atl_checking_flag' => 0,
    'week_end_date' => 0,
    'cur_year_week' => 0,
    'in_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035fb959ba6a5_49599449')) {function content_6035fb959ba6a5_49599449($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.replace.php';
?>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/scrolltabs.css"><!--PAGINATION-->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/contextMenu.css" rel="stylesheet" type="text/css" /><!--RIGHT CLICK BEGIN-->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/print.css" type="text/css" />
    <style type="text/css">
        .time_slots_theme .close_btn_wrpr{ height: 13px;position: relative;right: -5px;top: -14px;}
        #week-slot-calender.show_unmanned_slot_only .slot-week.slot-theme-leave,
        #week-slot-calender.show_unmanned_slot_only .slot-week.slot-theme-candg,
        #week-slot-calender.show_unmanned_slot_only .slot-week.slot-theme-candg-accept,
        #week-slot-calender.show_unmanned_slot_only .slot-week.slot-theme-pm,
        #week-slot-calender.show_unmanned_slot_only .slot-week.slot-theme-complete{ display: none;}
        .footable th.floatThead-col, .footable tr.size-row { height: 46px !important; }
        @media screen and (max-width: 767px){ 
            .table-responsive-clear { width: 100% !important;
                                      overflow: hidden !important;  }

            .scroll_tabs_container div.scroll_tab_inner span {
                padding-left: 1%;
                padding-right: 1%;
                font-size: 10px !important;
            }
            .hj { white-space:pre-wrap ; word-wrap:break-word; }
            .visibility-hidden { visibility: hidden; }
            .week-slot-type {
                margin: 10px 0 0 !important;
            }
            .visible-only-small-devices { display: block !important; }
            .hide-small-devices { display: none !important; }
            .text-limit-small-devices {  white-space: nowrap; 
                                         width: 20px;   font-size: 5px; 
                                         overflow: hidden;
                                         text-overflow: ellipsis; }
        }

        .week-slottype-employe {  position: relative; overflow: hidden;}

        .visible-only-small-devices { display: none ; }
        #approve_leave_on_apply{
            padding: 5px;
            background: #ffeded;
            border: solid 1px #ffc8c8 !important;
            max-width: 100%;
            color: red;
            margin: 13px 0 5px 0 !important;
        }
        #approve_leave_on_apply label{
            color: #dc7c7c;
        }
       
    </style>



<?php if ($_smarty_tpl->tpl_vars['flag_cust_access']->value==1){?>
    <div class="row-fluid<?php if ($_smarty_tpl->tpl_vars['show_right_panel']->value){?> show_main_right<?php }?>" id="gdweek_wraper">


        <div class="span12 main-left">
            <div id="div_alloc_action" class='hide'></div>
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
            <div id="main_process_save"></div>

            <div class="accordion span12 no-mb" id="accordion2" style="margin-left: 0px;">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle <?php if (!(isset($_COOKIE['opened_weekly_top_widget'])&&$_COOKIE['opened_weekly_top_widget']==true)){?>collapsed<?php }?>" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                            <span style="margin-right: 1px;" class="span12"><span style="margin-right: 1px;" class="pull-right"><i class="icon-angle-down icon-large"></i></span></span>
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse span12 <?php if (isset($_COOKIE['opened_weekly_top_widget'])&&$_COOKIE['opened_weekly_top_widget']==true){?>in<?php }?>" style="margin-left: 0px; min-height: 0px;<?php if (!(isset($_COOKIE['opened_weekly_top_widget'])&&$_COOKIE['opened_weekly_top_widget']==true)){?>height: 0px;<?php }?>">
                        <div class="accordion-inner">
                            <div class="row-fluid <?php if (isset($_COOKIE['opened_weekly_top_widget'])&&$_COOKIE['opened_weekly_top_widget']){?>loaded<?php }?>" data-toggle="collapse-widget" id="check1">
                                <?php if (isset($_COOKIE['opened_weekly_top_widget'])&&$_COOKIE['opened_weekly_top_widget']==true){?>
                                    <div class="span4">
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
                                    </div>
                                    <div class="span4">
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
                                    </div>
                                    <div class="span4">
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
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="schedule_det" style="position: relative; display: inline-block;">
            <div class="widget mt" style="margin-bottom: 5px !important;" id="cust_details_header_panel">
                <div class="widget-body" style="padding:5px;">
                    <div class="row-fluid">
                        <div class="ml pull-left weekly_control no-print" style="margin: 5px 5px 0px 5px;">
                            <label class="checkbox" style="padding:0 !important">
                                <input type="checkbox" name="chk_show_unmanned_slot_only" type="checkbox" style="margin-right: 5px !important;" id="chk_show_unmanned_slot_only" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show_unmanned_slots_only'];?>
" class="checkbox" /> <?php echo $_smarty_tpl->tpl_vars['translate']->value['show_unmanned_slots_only'];?>

                            </label>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?>
                            <div class="ml pull-left weekly_control no-print hide-small-devices" style="margin: 5px 15px 0px 5px">
                                <label class="checkbox" style="padding:0 !important">
                                    <input id="all_check" class="checkbox" value="1" type="checkbox" style="margin-right: 5px !important;"/><?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>

                                </label>
                            </div>
                        <?php }?>
                        <div class="pull-left customer-name" style="margin:5px 5px 0px 5px;"> 
                            <span class="icon-group"></span>
                            
                            
                            <span class="pull-right text-warning show_contract_btn" style="font-size: 17px;margin-left: 8px;" onclick="get_customer_contract_details()"><i class="icon icon-exclamation-sign cursor_hand"></i></span>

                            <select class="pull-right ml" id="cmb_customer" name="cmb_customer" style="height: 28px; margin-top: -3px; width: auto !important;">
                                <?php  $_smarty_tpl->tpl_vars['s_customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s_customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s_customer']->key => $_smarty_tpl->tpl_vars['s_customer']->value){
$_smarty_tpl->tpl_vars['s_customer']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['s_customer']->value['username'];?>
" <?php if ($_smarty_tpl->tpl_vars['s_customer']->value['username']==$_smarty_tpl->tpl_vars['customer_data']->value['username']){?>selected='selected'<?php }?>><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['s_customer']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['s_customer']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['s_customer']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['s_customer']->value['first_name']);?>
<?php }?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="pull-right no-print">

                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?><span class="btn  btn-default pull-right ml no-print" id="add-slots"  title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tooltip_new_slot'];?>
"><i class="icon-plus"></i></span><?php }?>
                            <button type="button" class="btn btn-default btn-normal pull-right no-print" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_view'];?>
" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['first_date_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['first_date_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/', 1);"><i class="icon-calendar"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['monthly_view'];?>
</button>
                            <?php if ($_smarty_tpl->tpl_vars['process_previlege']->value){?><button type="button" class="btn btn-default btn-normal  btn-manage pull-right ml no-print" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['show_actions'];?>
" ><i class="icon-ok"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['big_process'];?>
</button><?php }?>
                            <button  type="button" class="btn btn-default pull-right ml cursor_hand"  onclick="printSchedule();" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['print_schedule'];?>
"><i class="icon-print icon-large cursor_hand"></i></button>
                            <button  type="button" class="btn btn-default pull-right ml no-print cursor_hand"  onclick="reload_content();" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['refresh'];?>
"><i class="icon-refresh cursor_hand"></i></button>
                            
                            <?php if ($_smarty_tpl->tpl_vars['rpt_page_url']->value!=''){?><a class="btn btn-default pull-right ml no-print" href="<?php echo $_smarty_tpl->tpl_vars['rpt_page_url']->value;?>
"><span class="icon-arrow-left"></span><?php if ($_smarty_tpl->tpl_vars['from_page']->value=='emp_work_report'){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_report'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['translate']->value['back_mc_leave'];?>
<?php }?></a><?php }?>
                        </div>

                    </div>
                </div>
            </div>


            <?php if ($_smarty_tpl->tpl_vars['contract_exist_flag']->value){?>
                <div class="row-fluid customer-info no-print">
                    
                    <div class="span12 no-ml">
                        <?php if ($_smarty_tpl->tpl_vars['work_hours']->value['fk']['week']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['fk']['week']!='0'||$_smarty_tpl->tpl_vars['work_hours']->value['kn']['week']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['kn']['week']!='0'){?>
                            <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 1px;">
                                <thead>
                                    <tr>
                                        <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_weekly_hours'];?>
</th> 
                                        <?php if ($_smarty_tpl->tpl_vars['work_hours']->value['fk']['week']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['fk']['week']!='0'){?>
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
 <?php echo $_smarty_tpl->tpl_vars['work_hours']->value['fk']['week'];?>
h (<?php echo $_smarty_tpl->tpl_vars['contract_hours']->value['fk']['week'];?>
h)</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['work_hours']->value['kn']['week']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['kn']['week']!='0'){?>
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
 <?php echo $_smarty_tpl->tpl_vars['work_hours']->value['kn']['week'];?>
h (<?php echo $_smarty_tpl->tpl_vars['contract_hours']->value['kn']['week'];?>
h)</th> 
                                        <?php }?>
                                    </tr>
                                </thead>
                            </table>
                        <?php }?>
                        <?php if (isset($_smarty_tpl->tpl_vars['work_hours']->value['fk']['month'])&&isset($_smarty_tpl->tpl_vars['work_hours']->value['kn']['month'])&&($_smarty_tpl->tpl_vars['work_hours']->value['fk']['month']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['fk']['month']!='0'||$_smarty_tpl->tpl_vars['work_hours']->value['kn']['month']!='0'&&$_smarty_tpl->tpl_vars['contract_hours']->value['kn']['month']!='0')){?>
                            <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 1px;">
                                <thead>
                                    <tr>
                                        <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_monthly_hours'];?>
</th> 
                                        <?php if ($_smarty_tpl->tpl_vars['work_hours']->value['fk']['month']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['fk']['month']!='0'){?>
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
 <?php echo $_smarty_tpl->tpl_vars['work_hours']->value['fk']['month'];?>
h (<?php echo $_smarty_tpl->tpl_vars['contract_hours']->value['fk']['month'];?>
h)</th>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['work_hours']->value['kn']['month']!='0'||$_smarty_tpl->tpl_vars['contract_hours']->value['kn']['month']!='0'){?>
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
 <?php echo $_smarty_tpl->tpl_vars['work_hours']->value['kn']['month'];?>
h (<?php echo $_smarty_tpl->tpl_vars['contract_hours']->value['kn']['month'];?>
h)</th> 
                                        <?php }?>
                                    </tr>
                                </thead>
                            </table>
                        <?php }?>
                        <?php if (count($_smarty_tpl->tpl_vars['contract_period_hours']->value['fk'])>0||count($_smarty_tpl->tpl_vars['contract_period_hours']->value['kn'])>0){?>
                            <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_type'];?>
</th> 
                                        <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_period_gd_schema'];?>
</th>
                                        <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_period_hours'];?>
</th> 
                                        <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_hour'];?>
 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contract_period_hours']->value['fk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value){
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
                                        <tr>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
</td>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['period']->value['period_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
 <?php echo $_smarty_tpl->tpl_vars['period']->value['period_to'];?>
</td>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['period']->value['work_hours'];?>
h (<?php echo $_smarty_tpl->tpl_vars['period']->value['contract_hours'];?>
h)
                                                <?php if ($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours']>0){?>(<span style="color: green;"><?php echo number_format($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours'],2);?>
h</span>)
                                                <?php }elseif($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours']<0){?>(<span style="color: red;"><?php echo number_format($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours'],2);?>
h</span>)
                                                <?php }?>
                                            </td>
                                             <td  class="table-col-center"><?php if ($_smarty_tpl->tpl_vars['period']->value['unmanned_hour']!=''){?><?php echo $_smarty_tpl->tpl_vars['period']->value['unmanned_hour'];?>
h<?php }?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contract_period_hours']->value['kn']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value){
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
                                        <tr>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</td>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['period']->value['period_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
 <?php echo $_smarty_tpl->tpl_vars['period']->value['period_to'];?>
</td>
                                            <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['period']->value['work_hours'];?>
h (<?php echo $_smarty_tpl->tpl_vars['period']->value['contract_hours'];?>
h)
                                                <?php if ($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours']>0){?>(<span style="color: green;"><?php echo number_format($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours'],2);?>
h</span>)
                                                <?php }elseif($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours']<0){?>(<span style="color: red;"><?php echo number_format($_smarty_tpl->tpl_vars['period']->value['contract_hours']-$_smarty_tpl->tpl_vars['period']->value['work_hours'],2);?>
h</span>)
                                                <?php }?>
                                            </td>
                                            <td  class="table-col-center"><?php if ($_smarty_tpl->tpl_vars['period']->value['unmanned_hour']!=''){?><?php echo $_smarty_tpl->tpl_vars['period']->value['unmanned_hour'];?>
h<?php }?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php }?>
                    </div>
                </div>
            <?php }?>


            <div class="row-fluid table-info hide table-info-mobile no-print" id="customer-contract-popup" style="margin-bottom:15px;">
                <div class="panel-body collapse-panel span12">
                    <div class="row-fluid">
                        <!-- <div class="span1 pull-right"><button id="close-customer-contract-popup" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> -->
                    </div>
                    <div class="row-fluid" id="all_contract_details">
                    </div>
                </div>
            </div>



            <div  class="span12" style="margin-left:0 ; ">
                 
                <table class="footable table table-striped table-bordered table-white table-primary slot-calender no-print" style="margin:0;" >
                    <thead>
                        <tr>
                            <th>   
                                <div id="tabs2" class="scroll_tabs_theme_light">
                                    
                                    <?php  $_smarty_tpl->tpl_vars['week_number'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_number']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['week_numbers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_number']->key => $_smarty_tpl->tpl_vars['week_number']->value){
$_smarty_tpl->tpl_vars['week_number']->_loop = true;
?>
                                        <span class="week_no_spn<?php if ($_smarty_tpl->tpl_vars['week_number']->value['selected']){?> active-week<?php }?>" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['week_number']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to_slot_page_week'];?>
 <?php echo $_smarty_tpl->tpl_vars['week_number']->value['value'];?>
" data-yearweek="<?php echo $_smarty_tpl->tpl_vars['week_number']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['week_number']->value['value'];?>
</span>
                                    <?php } ?> 
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="table-responsive table-responsive-clear print-responsive-tbl fixed-scrolling-tbl" style="height: 450px;">
                    <table class="footable table table-striped table-bordered table-white table-primary  week-slot-calender" style="margin:0 " id="week-slot-calender">
                        <thead>
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                            <tr class="gradeX expandable" id="table-row-1">
                            <?php  $_smarty_tpl->tpl_vars['customer_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_week']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_day']->key => $_smarty_tpl->tpl_vars['customer_day']->value){
$_smarty_tpl->tpl_vars['customer_day']->_loop = true;
?>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>    
                                <td class="no-padding weekly_day" data-date="<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
">
                                    <div class="day-select no-mb">
                                       
                                        <span class="hide-small-devices" <?php if (($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1)){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer_data']->value['username'];?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_into_day_slots'];?>
" <?php if (((smarty_modifier_date_format($_smarty_tpl->tpl_vars['customer_day']->value['date'],'%u'))==7)||(in_array($_smarty_tpl->tpl_vars['customer_day']->value['date'],$_smarty_tpl->tpl_vars['holidays']->value))){?> style="color:red; font-weight: bold;"<?php }elseif(($_smarty_tpl->tpl_vars['customer_day']->value['date']==$_smarty_tpl->tpl_vars['today_date']->value)){?> style="font-weight: bold;"<?php }?> <?php }else{ ?> <?php if (((smarty_modifier_date_format($_smarty_tpl->tpl_vars['customer_day']->value['date'],'%u'))==7)||(in_array($_smarty_tpl->tpl_vars['customer_day']->value['date'],$_smarty_tpl->tpl_vars['holidays']->value))){?> style="cursor: default; color:red; font-weight: bold;"<?php }elseif(($_smarty_tpl->tpl_vars['customer_day']->value['date']==$_smarty_tpl->tpl_vars['today_date']->value)){?> style=" cursor: default; font-weight: bold;"<?php }?> onclick="messagePrivilege()"<?php }?>>  <?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['customer_day']->value['day']['day']];?>
<br/><?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
</span>
                                        <div class="visible-only-small-devices" <?php if (($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1)){?>onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_alloc_window.php?date=<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer_data']->value['username'];?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_into_day_slots'];?>
" <?php }else{ ?>style="cursor: default;" onclick="messagePrivilege()"<?php }?>>
                                            <input style="width:100%; font-size: 7px !important; padding: 0; text-align: center; margin: 0; background: none !important; border: 0; color: #000 !important;" disabled="" type="text" value="<?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['customer_day']->value['day']['day']];?>
">
                                            <input style="width:96%; margin: 0 auto; background: none !important; border: 0; text-indent: -36px;font-size: 10px !important; color: #000 !important;"  disabled="" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
">
                                        </div>
                                        <?php if (count($_smarty_tpl->tpl_vars['customer_running_tasks']->value)>0&&$_smarty_tpl->tpl_vars['today_date']->value==$_smarty_tpl->tpl_vars['customer_day']->value['date']){?>
                                            <?php $_smarty_tpl->tpl_vars['customer_running_task_title'] = new Smarty_variable('', null, 0);?>
                                            <?php  $_smarty_tpl->tpl_vars['crt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['crt']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_running_tasks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['crt']->key => $_smarty_tpl->tpl_vars['crt']->value){
$_smarty_tpl->tpl_vars['crt']->_loop = true;
?>
                                                <?php $_smarty_tpl->tpl_vars['customer_running_task_title'] = new Smarty_variable(((((((($_smarty_tpl->tpl_vars['customer_running_task_title']->value).($_smarty_tpl->tpl_vars['crt']->value['dag'])).(' ')).($_smarty_tpl->tpl_vars['crt']->value['start_time'])).(' => ')).($_smarty_tpl->tpl_vars['crt']->value['employee_first_name'])).(' ')).($_smarty_tpl->tpl_vars['crt']->value['employee_last_name']), null, 0);?>
                                                <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['customer_running_tasks']['last']){?><?php $_smarty_tpl->tpl_vars['customer_running_task_title'] = new Smarty_variable(($_smarty_tpl->tpl_vars['customer_running_task_title']->value).('&#10;'), null, 0);?><?php }?> 
                                            <?php } ?>
                                            <div class="cursor_help pull-right" title="<?php echo $_smarty_tpl->tpl_vars['customer_running_task_title']->value;?>
"><img src='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/clock.gif'/></div>
                                        <?php }?>
                                        <div onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_day_customer.php?date=<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer_data']->value['username'];?>
&action=1',1)" class="cursor_hand pull-left" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['timeline_view'];?>
"><i class="icon-bar-chart cursor_hand"/></div>
                                    </div>
                                </td>    
                            <?php } ?>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr class="gradeX expandable" id="table-row-1">
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['customer_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_week']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_day']->key => $_smarty_tpl->tpl_vars['customer_day']->value){
$_smarty_tpl->tpl_vars['customer_day']->_loop = true;
?>
                                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>    
                                    <td id="td<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" class="weekly_day weekly_day_slots" style="height: 450px !important;" data-date="<?php echo $_smarty_tpl->tpl_vars['customer_day']->value['date'];?>
">
    
                                        <?php  $_smarty_tpl->tpl_vars['day_slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_day']->value['slots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_slot']->key => $_smarty_tpl->tpl_vars['day_slot']->value){
$_smarty_tpl->tpl_vars['day_slot']->_loop = true;
?>
                                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3||($_smarty_tpl->tpl_vars['login_user_role']->value==3&&($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==0||($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==1&&$_smarty_tpl->tpl_vars['day_slot']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value)))){?>
                                                <span class="collapse-slot-2 clearfix" id="slot_thread_<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['id'];?>
">
                                                    <div 
                                                        class="slot-week slot_bountery <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['status']==0||$_smarty_tpl->tpl_vars['day_slot']->value['status']==3){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['status']==1&&$_smarty_tpl->tpl_vars['day_slot']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['status']==4){?>slot-theme-candg<?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==10){?>slot-theme-pm<?php }else{ ?>slot-theme-complete<?php }?> span12 <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['signed']==1){?>signed_slot<?php }?><?php if ($_smarty_tpl->tpl_vars['swap_copied_slot']->value==$_smarty_tpl->tpl_vars['day_slot']->value['id']){?> objblink<?php }?> <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3||($_smarty_tpl->tpl_vars['login_user_role']->value==3&&$_smarty_tpl->tpl_vars['day_slot']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value)){?>slot-week-draggable<?php }?>" 
                                                        onmouseover="tooltip.pop(this, '#slot_details_<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['id'];?>
', { position:0, offsetX:-20, effect:'slade', smartPosition: true });"
                                                        data-slot-id="<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['id'];?>
">
                                                        <input type="hidden" class="slot_details_hub" 
                                                            data-id='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['id'];?>
'
                                                            data-type='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['type'];?>
'
                                                            data-date='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['date'];?>
'
                                                            data-status='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['status'];?>
'
                                                            data-time-from='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['time_from'];?>
'
                                                            data-time-to='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['time_to'];?>
'
                                                            data-total_hours='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['slot_hour'];?>
'
                                                            data-customer-id='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['customer'];?>
'
                                                            data-customer-name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['day_slot']->value['cust_name'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                            data-employee-id='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['employee'];?>
'
                                                            data-employee-name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['day_slot']->value['emp_name'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                            data-fkkn='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['fkkn'];?>
'
                                                            data-signed='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['signed'];?>
'
                                                            data-comment='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['day_slot']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                            />
                                                        <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['status']==2){?>
                                                            <input type="hidden" class="slot_leave_details_hub" 
                                                                    data-leave-id='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['id'];?>
'
                                                                    data-leave-status='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['status'];?>
'
                                                                    data-leave-group-id='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['group_id'];?>
'
                                                                    data-leave-time-from='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['time_from'];?>
'
                                                                    data-leave-time-to='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['time_to'];?>
'
                                                                    data-leave-is-exist-relation='<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['is_exist_relation'];?>
'
                                                                    />
                                                        <?php }?>
                                                        <div class="inner-panel span12<?php if ($_smarty_tpl->tpl_vars['day_slot']->value['signed']==1){?> striped<?php }?>">
                                                            <div class="week-slot-notification-wrpr" style="background:<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['emp_color'];?>
;">
                                                                <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['day_slot']->value['comment'])!=''||htmlspecialchars($_smarty_tpl->tpl_vars['day_slot']->value['comment'])!=null){?>
                                                                    <div class="week-slot-notification">
                                                                        <div class="week-slot-notification-comment"></div>
                                                                    </div>
                                                                <?php }?>
                                                            </div>
                                                            <div class="week-slottype-wrpr" style="position: relative; ">
                                                                <div class="week-slot-time text-limit-small-devices" style="font-size: 12px;"><p class="hj"><?php echo $_smarty_tpl->tpl_vars['day_slot']->value['slot'];?>
(<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['slot_hour'];?>
)</p></div>
                                                            </div>
                                                            <div class="week-slottype visibility-hidden">
                                                                <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['fkkn']==1){?>FK
                                                                <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['fkkn']==2){?>KN
                                                                <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['fkkn']==3){?>TU
                                                                <?php }?>    
                                                            </div>  
                                                            <div class="span12 week-slottype-employe" style="margin:0;">
                                                                <div class="week-slot-name " style="position: absolute;margin: -2px 0 0 12px;"><?php echo $_smarty_tpl->tpl_vars['day_slot']->value['emp_name'];?>
</div>
                                                                <div class="week-slot-type">
                                                                    <ul class="slot-type-small-icons-group slot-week-types-icon">
                                                                        <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['type']==1){?><li class="slot-icon-small-travel" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==0){?><li class="slot-icon-small-normal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==2){?><li class="slot-icon-small-break" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==3){?><li class="slot-icon-small-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==4){?><li class="slot-icon-small-over-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==5){?><li class="slot-icon-small-qualtiy-overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==6){?><li class="slot-icon-small-more-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==14){?><li class="slot-icon-small-oncall-moretime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==7){?><li class="slot-icon-small-some-other-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==8){?><li class="slot-icon-small-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==9){?><li class="slot-icon-small-call-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==10){?><li class="slot-icon-small-personal-meeting" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==11){?><li class="slot-icon-small-voluntary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==12){?><li class="slot-icon-small-complimentary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==13){?><li class="slot-icon-small-complimentary-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==15){?><li class="slot-icon-small-standby" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==16){?><li class="slot-icon-small-dismissal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
"></li>
                                                                        <?php }elseif($_smarty_tpl->tpl_vars['day_slot']->value['type']==17){?><li class="slot-icon-small-dismissal-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
"></li><?php }?>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="slot-week-checkbox-wrpr hide-small-devices">

                                                                <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['status']==2){?>
                                                                    <div class="week-slot-badge-wrpr"><span class="label week-slot-badge"><?php echo $_smarty_tpl->tpl_vars['day_slot']->value['leave_data']['leave_name'];?>
</span></div>
                                                                <?php }?>    
                                                                <?php if ($_smarty_tpl->tpl_vars['day_slot']->value['tl_flag']==1&&$_smarty_tpl->tpl_vars['day_slot']->value['signed']==0&&$_smarty_tpl->tpl_vars['day_slot']->value['status']!=2&&($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_customer']==1)){?>
                                                                    <input type="checkbox" class="check-box pull-right m_check no-print" value="<?php echo $_smarty_tpl->tpl_vars['day_slot']->value['id'];?>
" />
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                </span>
                                            <?php }?>
                                        <?php } ?>
                                    </td>
                                <?php } ?>

                            </tr>
                        </tbody>
                        <!-- // Table body END -->
                    </table>
                </div>
            </div>
            </div>
        </div>


        <div id="slot_expanded_views" >
            <?php  $_smarty_tpl->tpl_vars['customer_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_week']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer_day']->key => $_smarty_tpl->tpl_vars['customer_day']->value){
$_smarty_tpl->tpl_vars['customer_day']->_loop = true;
?>
                <?php  $_smarty_tpl->tpl_vars['slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_day']->value['slots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot']->key => $_smarty_tpl->tpl_vars['slot']->value){
$_smarty_tpl->tpl_vars['slot']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3||($_smarty_tpl->tpl_vars['login_user_role']->value==3&&($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==0||($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==1&&$_smarty_tpl->tpl_vars['slot']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value)))){?>
                        <div class="slot_expand_view_parent" style="display:none;" data-id="<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
">
                            <div id="slot_details_<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
" class="clearfix slot-hover-popup span4 <?php if ($_smarty_tpl->tpl_vars['slot']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==4){?>slot-theme-candg<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==0||$_smarty_tpl->tpl_vars['slot']->value['status']==3){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==1&&$_smarty_tpl->tpl_vars['slot']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==10){?>slot-theme-pm<?php }else{ ?>slot-theme-complete<?php }?>">
                                <div class="clearfix <?php if ($_smarty_tpl->tpl_vars['slot']->value['signed']==1){?>striped<?php }?>" style="padding: 15px;">
                                    <ul class="clearfix">
                                        <li><h1><?php echo $_smarty_tpl->tpl_vars['slot']->value['slot'];?>
 (<?php echo $_smarty_tpl->tpl_vars['slot']->value['slot_hour'];?>
)</h1></li>
                                        <li><span class="icon-group"></span> <?php if ($_smarty_tpl->tpl_vars['slot']->value['customer']!=''){?><?php echo $_smarty_tpl->tpl_vars['slot']->value['cust_name'];?>
<?php }else{ ?>[<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_customer'];?>
]<?php }?></li>
                                        <li><span class="icon-user"></span> <?php if ($_smarty_tpl->tpl_vars['slot']->value['employee']!=''){?><?php echo $_smarty_tpl->tpl_vars['slot']->value['emp_name'];?>
<?php }else{ ?>[<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
]<?php }?></li>
                                        <?php if ($_smarty_tpl->tpl_vars['slot']->value['comment']!=''){?><li class="hover-popup-comment"><span class="icon-comment"></span><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['slot']->value['comment']));?>
</li><?php }?>
                                        <hr>
                                        <li class="clearfix">
                                            <span class="slot-type pull-left">
                                                <?php if ($_smarty_tpl->tpl_vars['slot']->value['fkkn']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['fkkn']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>

                                                <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['fkkn']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>

                                                <?php }?>
                                            </span>
                                            <span class='pull-left'>
                                                <ul class="slot-type-small-icons-group clearfix">
                                                    <?php if ($_smarty_tpl->tpl_vars['slot']->value['type']==1){?><li class="slot-icon-small-travel" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==0){?><li class="slot-icon-small-normal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==2){?><li class="slot-icon-small-break" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==3){?><li class="slot-icon-small-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==4){?><li class="slot-icon-small-over-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==5){?><li class="slot-icon-small-qualtiy-overtime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==6){?><li class="slot-icon-small-more-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==14){?><li class="slot-icon-small-oncall-moretime" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==7){?><li class="slot-icon-small-some-other-time" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==8){?><li class="slot-icon-small-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==9){?><li class="slot-icon-small-call-training" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==10){?><li class="slot-icon-small-personal-meeting" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==11){?><li class="slot-icon-small-voluntary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==12){?><li class="slot-icon-small-complimentary" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==13){?><li class="slot-icon-small-complimentary-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==15){?><li class="slot-icon-small-standby" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==16){?><li class="slot-icon-small-dismissal" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
"></li>
                                                    <?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==17){?><li class="slot-icon-small-dismissal-oncall" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
"></li><?php }?>
                                                </ul>
                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['slot']->value['status']==2){?>
                                                <span class="label label-important" style="padding: 5px;"><?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['leave_name'];?>
</span>
                                            <?php }?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php } ?>
            <?php } ?>
        </div>
            

        <div class="span4 main-right slot-form<?php if (!$_smarty_tpl->tpl_vars['show_right_panel']->value){?> hide<?php }?>" style="margin-top: 8px; padding: 10px;" id="stickyPanelParent">
            

            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                <div id="slot_creation_main_wraper_group" class="clearfix <?php if (!($_smarty_tpl->tpl_vars['show_right_panel']->value&&$_smarty_tpl->tpl_vars['right_panel']->value=='memory_slots')){?> hide<?php }?>">
    
                    <div class="add-new-slots-month hide">
                        <div id="btnGroupStickyPanel" class="span12">
                            <div class="row-fluid" style="margin-bottom: 5px;">
                                <div class="span12">
                                    <button type="button" class="btn btn-default-special span12 btn-large" id="show-memory-slots-btn"><span class="icon-level-down"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['memory_slots'];?>
</button>
                                </div>
                            </div>

                            <div class="slot-wrpr-buttons span12" style="margin:5px 0 7px;">
                                <button type="button" class="btn btn-success span6" onclick="manEntry();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons" id="slot-create-cancel"><span class="icon-chevron-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                            </div>
                        </div>
                        <div style="margin-top: 0px; margin-bottom: 5px ! important;" class="widget">
                            <div class="widget-body" style="padding:5px;">
                                <div class="row-fluid">
                                    <div class="span8 customer-name no-min-height" style="margin:5px;"> 
                                        <span style="margin-right: 5px;" class="icon-group"></span><?php echo (($_smarty_tpl->tpl_vars['customer_data']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_data']->value['last_name']);?>

                                    </div>
                                    <div class="span1 pull-right"> 
                                        <button type="button" class="btn btn-default-special span12" onclick="popupAddSlotMore();"  tabindex="-1"><span class="icon-plus"></span></button>
                                    </div>
                                    <div class="span12" style="margin-left: 0px;">
                                        <div class="input-prepend date hasDatepicker datepicker" id="dtPickerNewSlotDate">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span12 slot_date" id="new_slot_date" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" onblur="load_avail_emps_within_period_for_new_slot(this);" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="span12 create-slotes-panel no-pb" style="margin-left: 0px;"></div>  
                        
                        <br/>

                        <span class="span12 no-min-height no-ml" style="margin-top:5px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="check_created_slot_copy_to_weeks" id="check_created_slot_copy_to_weeks" /> <label for="check_created_slot_copy_to_weeks" class="template_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_multiple'];?>
</label></span>
                        <div class="span12 form-wrpr mt no-ml hide" id="created_slot_copy_to_weeks">
                            <h1 style="margin:10px 0 10px 0 !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_multiple'];?>
</h1>

                            <div class="span12" style="margin-left: 0px;">
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="1" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['monday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="2" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="3" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="4" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="5" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['friday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="6" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="0" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday_first_charecter'];?>

                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <label for="cscm_from_wk"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_from'];?>
</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12 cscm_frm_wk_selct" id="cscm_from_wk" onchange="getAfterDates_for_cscm()">
                                        <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value+1;?>
<?php $_tmp1=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['week'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['week']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['name'] = 'week';
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] = is_array($_loop=$_tmp1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['week']['index']==$_smarty_tpl->tpl_vars['cur_week']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12" name="cscm_from_option" id="cscm_from_option" onchange="getAfterDates_for_cscm()">
                                        <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_week'];?>
</option>
                                        <option value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_2'];?>
</option>
                                        <option value="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_3'];?>
</option>
                                        <option value="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_4'];?>
</option>
                                    </select>
                                </div>
                            </div>
                            <label for="cscm_to_wk"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_upto'];?>
</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name="cscm_to_wk" id="cscm_to_wk" class="form-control span12"></select>
                                </div>
                            </div>
                        </div>
                        <span class="span12 no-ml mb" style="margin-top:7px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="saveTimeslot" id="saveTimeslot" /> <label for="saveTimeslot" class="template_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_timeslot'];?>
</label></span>



                    </div>

    
                    <div id="memory-slots">
                        <div class="row-fluid">
                            <div class="span12 no-ml">
                                <button type="button" class="btn btn-default-special span12 btn-large" id="create-slot"><span class="icon-level-down"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['click_to_add_new_time_slot'];?>
</button>
                            </div>
                        </div>
                        <div style="margin-top: 5px ! important;margin-bottom: 5px ! important;" class="span12 slots-full-view-body">   
                            <div class="row-fluid">
                                <div class="span12">
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span11 datepicker" id="dp_memslot_throw_date">
                                        <span class="add-on icon-calendar"></span>
                                        <input class="form-control span12" id="memslot_throw_date" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                    </div>
                                </div>
                            </div>      
                            <div class="row-fluid span12 no-ml" id="available_memory_slots">
                                <ol class="memory-slots-list-wrpr">
                                    <?php  $_smarty_tpl->tpl_vars['mem_slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mem_slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['memory_slots']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mem_slot']->key => $_smarty_tpl->tpl_vars['mem_slot']->value){
$_smarty_tpl->tpl_vars['mem_slot']->_loop = true;
?>
                                        <li class="memory_time">
                                            <div class="child-slots" style="padding:2px !important;">
                                                <input type="checkbox" name="mem_slot_<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['id'];?>
" id="mem_slot_<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['id'];?>
" value="<?php echo (((($_smarty_tpl->tpl_vars['mem_slot']->value['time_from']).('-')).($_smarty_tpl->tpl_vars['mem_slot']->value['time_to'])).('-')).($_smarty_tpl->tpl_vars['mem_slot']->value['type']);?>
" class="check-box this_mslot" data-id="<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['id'];?>
" data-timefrom='<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['time_from'];?>
' data-timeto='<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['time_to'];?>
' data-type='<?php echo $_smarty_tpl->tpl_vars['mem_slot']->value['type'];?>
' />
                                                <span style="font-size:8px;"><?php echo (($_smarty_tpl->tpl_vars['mem_slot']->value['time_from']).('-')).($_smarty_tpl->tpl_vars['mem_slot']->value['time_to']);?>
 <?php if ($_smarty_tpl->tpl_vars['mem_slot']->value['type']=='3'){?>J<?php }?></span> 
                                                <span class="glyphicons icon-remove pull-right remove-memory-slot cursor_hand" style="padding-left: 0; font-size: 7px;"></span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ol>
                            </div>
                        </div>
                        <div class="row-fluid no-ml">
                            <div class="span12 no-ml">
                                <button type="button" class="btn btn-default-special span12 mb" onclick="multipleMemorySlotAdd();"><span class="icon-plus"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['add_multiple_timeslots'];?>
</button>
                                <button type="button" class="btn btn-danger span12 slot-confirm-buttons no-ml"><span class="icon-chevron-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            

            <div class="manage-form span12 hide">
                <div class="span12">
                    <div class="tabsbar tabsbar-2" style="margin:0 !important;">
                        <ul class="row-fluid row-merge">
                            <li class="span3 active"><a href="#tab1-4" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
</a></li>
                            <li class="span3" id="deltab"><a href="#tab2-4" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</a></li>
                            <li class="span2" id="reptab"><a href="#tab3-4" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
</a></li>
                            <li class="span2"><a href="#tab4-4" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</a></li>
                            <li class="span2" id="atltab"><a href="#tab5-4" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['translate']->value['atl'];?>
</a></li>
                        </ul>
                    </div>

                    <div style="background: none;" class="tab-content">
                        <div class="tab-pane active" id="tab1-4">
                            <form name="frm_copy" method="post" class="span12 mt">
                                <h4 class="span6"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
</h4>
                                <?php if ($_smarty_tpl->tpl_vars['in_user_role']->value==4){?>
                                    <div class="span6" id="div_chk_unmanned">
                                        <input class="checkbox" value="1" type="checkbox" id="chk_unmanned" checked="checked">
                                        <?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned'];?>

                                    </div>
                                <?php }?>
                                <br />
                                
                                <div class="span12 no-ml no-min-height">
                                    <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user" style="margin-bottom:15px;">
                                        <li>
                                            <label class="label-option-and-checkbox" for="withuser">
                                                <input class="radio no-min-height" name="withuser" value="radio" id="withuser"  checked="checked" type="radio" onclick="display_unmammed(1)">
                                                <span class='ml'><?php echo $_smarty_tpl->tpl_vars['translate']->value['with_user'];?>
</span> 
                                            </label>
                                        </li>
                                    </ol>

                                    <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user" style="margin-bottom:15px;">
                                        <li>
                                            <label class="label-option-and-checkbox" for="withoutuser">
                                                <input class="radio no-min-height" name="withuser" value="radio" id="withoutuser" type="radio" onclick="display_unmammed(0)">
                                                <span class='ml'><?php echo $_smarty_tpl->tpl_vars['translate']->value['without_user'];?>
 </span>
                                            </label>
                                        </li>
                                    </ol>
                                </div>
                                
                                <div class="form-section-highlight span12 no-ml">
                                    <h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_from'];?>
</h5>
                                    <hr>

                                    <div class="row-fluid">
                                        <div class="span6" style="margin-left: 0px;">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['from_week'];?>
</h1>
                                            <div class="input-prepend span11 hasDatepicker" id="datepicker">
                                                <span class="add-on icon-group"></span>

                                                <select class="form-control span8" id="from_wk" onchange="getAfterDates(<?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value;?>
)">
                                                    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value+1;?>
<?php $_tmp2=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['week'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['week']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['name'] = 'week';
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] = is_array($_loop=$_tmp2) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total']);
?>
                                                        <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['week']['index']==$_smarty_tpl->tpl_vars['cur_week']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
</option>
                                                    <?php endfor; endif; ?>
                                                </select>
                                                <div style="display: block;" class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></div>
                                        </div>
                                        <div class="span6" style="margin-left: 0px;">
                                            <h1>Ant. veckor</h1>
                                            <div class="input-prepend span11" id="datepicker">
                                                <span class="add-on icon-group"></span>
                                                <select class="form-control span8" id="no_of_wks" onchange="getAfterDates(<?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value;?>
)">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>            

                                    <input class="checkbox" name="days" value="1" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[0];?>
</span>
                                    <input class="checkbox" name="days" value="2" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[1];?>
</span>
                                    <input class="checkbox" name="days" value="3" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[2];?>
</span>
                                    <input class="checkbox" name="days" value="4" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[3];?>
</span>
                                    <input class="checkbox" name="days" value="5" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[4];?>
</span>
                                    <input class="checkbox" name="days" value="6" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[5];?>
</span>
                                    <input class="checkbox" name="days" value="0" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[6];?>
</span>
                                </div> 
                                <div class="form-section-highlight span12 no-ml" style="margin-top:10px;">
                                    <h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_of_weeks'];?>
</h5>
                                    <hr>

                                    <div class="row-fluid">
                                        <div class="span6" style="margin-left: 0px;">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['from_week'];?>
</h1>
                                            <div class="input-prepend span11" id="datepicker">
                                                <span class="add-on icon-group"></span>
                                                <select class="form-control span8" id="to_wk">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="span6" style="margin-left: 0px;">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_of_times'];?>
</h1>
                                            <div class="input-prepend span11" id="datepicker">
                                                <span class="add-on icon-group"></span>

                                                <select class="form-control span8"id="no_of_times">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkboxes-wrpr span12 no-ml" id="copy_list"></div>
                                <div class="slot-wrpr-buttons span12 no-ml" style=" margin: 10px 0px 0px;">
                                    <button type="button" class="btn btn-success btn-copy span6" onclick="save_copy()"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
</button>
                                    <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab2-4">
                            <form name="frm_delete" method="post" class="span12 mt">
                                <h4 class="span12" style="margin-top:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_slots'];?>
</h4>
                                
                                <div class="span12 no-ml no-min-height">     
                                    <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user" style="margin-bottom:15px;">
                                        <li>
                                            <label class="label-option-and-checkbox" for="infocus"> 
                                                <input class="radio no-min-height" name="infocus" value="radio" id="infocus"  checked="checked" type="radio">
                                                <span class='ml'><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_processmain_delete'];?>
</span>
                                            </label>
                                        </li>
                                    </ol>
                                    <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user" style="margin-bottom:15px;">
                                        <li>
                                            <label class="label-option-and-checkbox" for="outfocus">
                                                <input class="radio no-min-height" name="infocus" value="radio" id="outfocus" type="radio">
                                                <span class='ml'><?php echo $_smarty_tpl->tpl_vars['translate']->value['schedule'];?>
</span>
                                            </label>
                                        </li>
                                    </ol>
                                </div>
                                
                                
                                <div class="form-section-highlight span12 no-ml">
                                    <div class="row-fluid">
                                        <div class="span6" style="margin-left: 0px;">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['from_week'];?>
</h1>
                                            <div class="input-prepend span8" id="datepicker">
                                                <span class="add-on icon-group"></span>

                                                <select class="form-control span12" id="from_wk_del"  onchange="getProcessEmployees('del_list')">
                                                    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value+1;?>
<?php $_tmp3=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['week'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['week']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['name'] = 'week';
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] = is_array($_loop=$_tmp3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total']);
?>
                                                        <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['week']['index']==$_smarty_tpl->tpl_vars['cur_week']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
</option>
                                                    <?php endfor; endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="span6" style="margin-left: 0px;">
                                            <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_of_weeks'];?>
</h1>
                                            <div class="input-prepend span8" id="datepicker">
                                                <span class="add-on icon-group"></span>

                                                <select class="form-control span12" id="no_of_wks_del"  onchange="getProcessEmployees('del_list')">
                                                    <?php $_smarty_tpl->tpl_vars['week_i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['week_i']->step = 1;$_smarty_tpl->tpl_vars['week_i']->total = (int)ceil(($_smarty_tpl->tpl_vars['week_i']->step > 0 ? 52+1 - (1) : 1-(52)+1)/abs($_smarty_tpl->tpl_vars['week_i']->step));
if ($_smarty_tpl->tpl_vars['week_i']->total > 0){
for ($_smarty_tpl->tpl_vars['week_i']->value = 1, $_smarty_tpl->tpl_vars['week_i']->iteration = 1;$_smarty_tpl->tpl_vars['week_i']->iteration <= $_smarty_tpl->tpl_vars['week_i']->total;$_smarty_tpl->tpl_vars['week_i']->value += $_smarty_tpl->tpl_vars['week_i']->step, $_smarty_tpl->tpl_vars['week_i']->iteration++){
$_smarty_tpl->tpl_vars['week_i']->first = $_smarty_tpl->tpl_vars['week_i']->iteration == 1;$_smarty_tpl->tpl_vars['week_i']->last = $_smarty_tpl->tpl_vars['week_i']->iteration == $_smarty_tpl->tpl_vars['week_i']->total;?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['week_i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['week_i']->value;?>
</option>
                                                    <?php }} ?>
                                                    <!-- <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="checkbox" name="days" value="1" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[0];?>
</span>
                                    <input class="checkbox" name="days" value="2" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[1];?>
</span>
                                    <input class="checkbox" name="days" value="3" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[2];?>
</span>
                                    <input class="checkbox" name="days" value="4" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[3];?>
</span>
                                    <input class="checkbox" name="days" value="5" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[4];?>
</span>
                                    <input class="checkbox" name="days" value="6" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[5];?>
</span>
                                    <input class="checkbox" name="days" value="0" checked="checked" type="checkbox">
                                    <span style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['week_day_names']->value[6];?>
</span>
                                </div> 


                                <div class="checkboxes-wrpr span12 no-ml" id="del_list"></div>
                                <div class="slot-wrpr-buttons span12 no-ml" style=" margin: 10px 0px 0px;">
                                    <button type="button" class="btn btn-success btn-copy span6" onclick="save_delete()"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</button>
                                    <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                                </div>
                            </form>        
                        </div>

                        <div class="tab-pane" id="tab3-4">
                            <h4 style="margin-top:20px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
</h4>
                            <hr>
                            <?php if ($_smarty_tpl->tpl_vars['in_user_role']->value==4){?>
                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
: 
                                <input class="checkbox" type="checkbox" name="repl_infocus" value="radio" id="repl_infocus"  checked="checked">
                                <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['last_name'];?>

                                <?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['first_name'];?>
<?php }?>
                            <?php }?>
                            <div class="form-section-highlight" style="margin-top:10px;">
                                <div class="row-fluid">
                                    <div class="form-group">
                                        <div class="input-prepend date hasDatepicker" id="datepicker">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span7" name="replace_date_from" id="replace_date_from" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <!--CHECK BOXES WRPR BEGIN-->
                                <div class="checkboxes-wrpr" style="margin-top:0;" id="rep_list"></div><!--CHECK BOXES WRPR END-->
                            </div> 
                            <div class="form-section-highlight" style="margin-top:10px;">
                                <div class="row-fluid">
                                    <div class="form-group">
                                        <div class="input-prepend date" id="datepicker">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span7" name="replace_date_to" type="text" id="replace_date_to" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
">
                                        </div>
                                    </div>
                                </div>
                                <!--CHECK BOXES WRPR BEGIN-->
                                <div id="rep_list_emp" class="checkboxes-wrpr" style="margin-top:0;">
                                </div><!--CHECK BOXES WRPR END-->
                            </div> <!--FORM SECTION HIGHLIGHT END-->
                            <div class="slot-wrpr-buttons span12" style=" margin: 10px 0px 0px;">
                                <button type="button" class="btn btn-success btn-copy span6" onclick="save_replace()"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
</button>
                                <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab4-4">
                            <form name="leave_form" id="leave_form" method="post">
                                <input type="hidden" name="slot_id" id="slot_id" value="" />
                                <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                                <h4 style="margin-top:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</h4>
                                <hr>
                                <div class="btn-group leave-type">
                                    <?php  $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['leave_type']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['leave_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['leave_type']->key => $_smarty_tpl->tpl_vars['leave_type']->value){
$_smarty_tpl->tpl_vars['leave_type']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type_key']->value = $_smarty_tpl->tpl_vars['leave_type']->key;
?>
                                        <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" onclick="setLeaveType(<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
)" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_leave'];?>
"><?php echo $_smarty_tpl->tpl_vars['leave_type']->value;?>
</a>
                                    <?php } ?>
                                    <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                                </div>
                                <div class="row-fluid" style="margin-top:10px;">
                                    <div class="span12" style="margin-left: 0px;">
                                        <div class="input-prepend span11" id="datepicker">
                                            <span class="add-on icon-group"></span>

                                            <select class="form-control span12" name="leave_employee" id="leave_employee">
                                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                                <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employee_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
"><?php echo (($_smarty_tpl->tpl_vars['employee']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['employee']->value['last_name']);?>
</option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="widget widget-tabs widget-tabs-double-2" style="margin-top:0">
                                        <!-- Tabs Heading -->
                                        <div class="widget-head">
                                            <ul>
                                                <li class="active"><a class="glyphicons clock" href="#tabAll" data-toggle="tab" onclick="leaveTab('time')"><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
</span></a></li>
                                                <li class=""><a class="glyphicons calendar" href="#tabAccount" data-toggle="tab" onclick="leaveTab('date')"><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</span></a></li>

                                            </ul>
                                        </div>
                                        <!-- // Tabs Heading END -->
                                        <div class="widget-body">
                                            <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" class="tab-content">
                                                <!-- Tab content -->
                                                <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" id="tabAll" class="tab-pane widget-body-regular active">
                                                    <div class="span12" style="margin:0">
                                                        <div class="form-group">
                                                            <label for="leave_date_day"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
: </label>
                                                            <div class="input-prepend date" id="datepicker">
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span6" name="leave_date_day" id="leave_date_day" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-prepend date hasDatepicker" id="datepicker">
                                                        <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span5" name="leave_time_from_main" id="leave_time_from_main" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text" value="0">
                                                        <input class="form-control span5" name="leave_time_to_main" id="leave_time_to_main" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" type="text" value="24">
                                                    </div>




                                                    <div class="span12" style="margin:0; ">
                                                        <div class="form-group">
                                                            <label for="leave_comments"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
:</label>
                                                            <div class="input-prepend date hasDatepicker" id="datepicker">
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span5" name="leave_comments" id="leave_comments" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="slot-wrpr-buttons span12" style=" margin: 10px 0px 10px 0px;">
                                                        <button type="button" class="btn btn-success btn-copy span6" onclick="saveLeave('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
')"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_leave'];?>
</button>
                                                        <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                                                    </div>
                                                </div>
                                                <!-- // Tab content END -->
                                                <!-- Tab content -->
                                                <div id="tabAccount" class="tab-pane widget-body-regular">
                                                    <div class="span12" style="margin:0">
                                                        <div class="form-group">
                                                            <label for="leave_date_from"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
:</label>
                                                            <div class="input-prepend date" id="datepicker">
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span8" name="leave_date_from" id="leave_date_from" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin:0">
                                                        <div class="form-group">
                                                            <label for="leave_date_to"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
 </label>
                                                            <div class="input-prepend date" id="datepicker">
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span8" name="leave_date_to" id="leave_date_to" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin:0; ">
                                                        <div class="form-group">
                                                            <label for="leave_comments_date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
:</label>
                                                            <div class="input-prepend date hasDatepicker" id="datepicker">
                                                                <span class="add-on icon-calendar"></span>
                                                                <input class="form-control span10" name="leave_comments_date" id="leave_comments_date" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="slot-wrpr-buttons span12" style=" margin: 10px 0px 10px 0px;">
                                                        <button type="button" class="btn btn-success btn-copy span6" onclick="saveLeave('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
')"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_leave'];?>
</button>
                                                        <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                                                    </div>
                                                </div>
                                                <!-- // Tab content END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab5-4">
                            <form name="frm_atl" method="post">
                                <h4 style="margin-top:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['atl'];?>
</h4>
                                <div class="form-section-highlight" style="margin-top:10px;">
                                    <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_month'];?>
</h1>
                                    <div class="row-fluid">
                                        <div class="span12" style="margin-left: 0px;">
                                            <div class="input-prepend span11" id="datepicker">
                                                <span class="add-on icon-group"></span>

                                                <select class="form-control span12" id="year_month"  onchange="getProcessEmployeesAtl('atl_list')">
                                                    <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>  
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['month']->value['month_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['month']->value['month_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkboxes-wrpr" style="margin-top:0px;" id="atl_list">

                                    </div>
                                    <div class="checkboxes-wrpr" style="margin-top:0px; display: none;" id="atl_result">

                                    </div>            
                                </div>
                                <div class="slot-wrpr-buttons span12" style=" margin: 10px 0px 0px;">
                                    <button type="button" class="btn btn-success btn-copy span6" onclick="save_atl()"><span class="icon-copy"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['atl_check'];?>
</button>
                                    <button type="button" class="btn btn-danger btn-cancel span6"><span class="icon-remove"></span><?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['change_time']==1){?>
                <div id="change_time_of_slots" class="span12 hide">
                    <div class="span12 panel-heading">
                        <h4 class="panel-title clearfix"><?php echo $_smarty_tpl->tpl_vars['translate']->value['change_time'];?>
</h4>
                    </div>
                    <div class="span12 slots-full-view-body">
                        <div class="span12" style="margin:0;">
                            <div class="input-prepend">
                                <span class="add-on  icon-time " title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
"></span>
                                <input class="form-control span5 time-input-text" id="change_time_from" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_from'];?>
" type="text"   style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                                <span class="add-on"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</span>
                                <input class="form-control span5 time-input-text" id="change_time_to" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_to'];?>
" type="text"   style="margin-left: -1px;"/>
                            </div>
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12">
                        <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangetimes();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                        <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                    </div>
                </div>
            <?php }?>

                                
            
            <div id="slot_details_main_wraper_group" class="hide">
                <div class="slot-wrpr span12" id="slot-wrpr-slots">

                    <input class="this_slot_id" id="sdID" type="hidden" value=""/>
                    <input id="this_slot_actual_date" type="hidden" value=""/>
                    <input id="this_slot_actual_timefrom" type="hidden" value=""/>
                    <input id="this_slot_actual_timeto" type="hidden" value=""/>
                    <input id="this_slot_actual_customer" type="hidden" value=""/>
                    <input id="this_slot_actual_employee" type="hidden" value=""/>
                    <input id="this_slot_actual_employee_name" type="hidden" value=""/>
                    <input id="this_slot_actual_fkkn" type="hidden" value=""/>
                    <input id="this_slot_actual_type" type="hidden" value=""/>
                    
                    <input id="this_slot_leave_id" type="hidden" value=""/>
                    <input id="this_slot_leave_status" type="hidden" value=""/>
                    <input id="this_slot_leave_group_id" type="hidden" value=""/>
                    <input id="this_slot_leave_time_from" type="hidden" value=""/>
                    <input id="this_slot_leave_time_to" type="hidden" value=""/>
                    
                    <div class="span12" style="margin:0;">
                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date" style="padding-left: 0px;">
                            <span class="add-on icon-calendar" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
"></span>
                            <input class="form-control span12" id="sdDate" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text"/>
                        </div>
                    </div>

                    <div class="span12" style="margin:0;">
                        <div class="input-prepend">
                            <span class="add-on  icon-time " title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
"></span>
                            <input class="form-control span5 time-input-text" id="sdTFrom" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text"  oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                            <span class="add-on"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</span>
                            <input class="form-control span5 time-input-text" id="sdTTo" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" type="text"  oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="margin-left: -1px;"/>
                        </div>
                    </div>
                    <h2 class="span12 no-ml no-mb"><span class="icon-user" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
"></span> 
                        <span id="sdCustomer"><?php echo (($_smarty_tpl->tpl_vars['customer_data']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_data']->value['last_name']);?>
</span>
                        <input class="this_slot_customer_id" id="sdCustomerID" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
"/>
                    </h2>
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-group" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
"></span>
                            <select class="form-control span12" id="sdEmployee">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                            </select>
                        </div>
                    </div>
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-star" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['fkkn'];?>
"></span>
                            <select class="form-control span12"  id="sdFKKN">
                                <option value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
</option>
                                <option value="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</option>
                                <option value="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>
</option>
                            </select>
                        </div>
                    </div>     
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-comment" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></span>
                            <textarea class="form-control span12" id="sdComment" rows="1" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></textarea>
                        </div>
                    </div>

                    <button type="button" class="btn btn-default span1 hide" id="btn_direct_lock_slot"><span class="icon-lock"></span></button>
                    

                    <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" id="sdTypes" style="width: 27px; height: 30px; overflow: hidden;">
                        <li class="slot-icon slot-icon-type-1 slot-icon-small-travel active" data-value='1' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"></li>
                        <li class="slot-icon slot-icon-type-0 slot-icon-small-normal" data-value='0' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></li>
                        <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"></li>
                        <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"></li>
                        <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"></li>
                        <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"></li>
                        <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"></li>
                        <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
"></li>
                        <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
"></li>
                        <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"></li>
                        <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
"></li>
                        <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
"></li>
                        <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
"></li>
                        <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
"></li>
                        <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
"></li>
                        <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
"></li>
                        <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
"></li>
                        <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
"></li>
                    </ul>
                    
                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
                        <span id="candg_action_btn_group" class="hide span12 no-ml">
                            <button class="btn btn-success" type="button" onclick="acceptCandGSlot();"><i class="icon-ok-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['accept'];?>
</button>
                            <button class="btn btn-danger" type="button" onclick="delete_single_slot();"><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
</button>
                        </span>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                        <span id="clone_leave_action_btn_group" class="hide">
                            <button class="btn btn-success" type="button" onclick="clone_relation_leave_slot();"><i class="icon-copy icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_clone_relation'];?>
</button>
                        </span>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
                        <span id="leave_quick_action_btn_group" class="hide span12 no-ml">
                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1){?><button class="btn btn-success leave_accept_btn hide span12 no-ml" type="button" onclick="update_leave_status(1);" style="margin-top: 3px;"><i class="icon-ok-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
</button><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1){?><button class="btn btn-inverse leave_reject_btn hide span12 no-ml" type="button" onclick="update_leave_status(2);" style="margin-top: 3px;"><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
</button><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
                                <button class="btn btn-inverse leave_cancel_btn hide span12 no-ml" type="button" onclick="cancel_leave_slot();" style="margin-top: 3px;"><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel_leave'];?>
</button>
                                <button class="btn btn-info leave_edit_btn hide span12 no-ml" type="button" onclick="edit_leave_slot();" style="margin-top: 3px;"><i class="icon-edit icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['back_to_work'];?>
</button>
                            <?php }?>
                        </span>
                    <?php }?>
                    
                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
                        <div class="span12 no-ml mt hide" id="leave_edit_wrpr">
                            <div class="slot-wrpr span12">
                                <h4 class="right-panel-sub-heading" style="margin-top:10px;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['applied_leaves'];?>
</h4>
                                <hr>
                                <div class="span12" style="margin:0;">
                                    <div class="span12 no-ml">
                                        <label style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unsick_from'];?>
:</label>
                                        <input type="text" id="unsick_time_from" name="unsick_time_from" value="" class="span12" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from_time'];?>
">
                                    </div>
                                    <button type="button" class="btn btn-info" onclick="edit_leave_slotConfirm();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                    <button type="button" class="btn btn-danger leave_edit_btn" onclick="edit_leave_slot();"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                    <div class="span12 no-ml hide" id="PM-special-empls">
                        <div class="span12 no-ml form-section-highlight">
                            <h4 style="background-color: #DEFAEB; border: 1px solid #C1E3D0;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['pm_available_employees'];?>
</h4>
                            <div class="checkboxes-wrpr mb" id="PM-special-empls-avails">
                                
                            </div>
                            <div class="span12 no-ml hide" id="PM-special-empls-unavails-div">
                                <h4 style="background-color: #feeded;border: 1px solid #e8c6c6;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unavailable_employees'];?>
</h4>
                                <div class="checkboxes-wrpr" id="PM-special-empls-unavails">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                                
                    <div class="slot-wrpr-buttons span12  btn-group btn-group-justified" style="margin:0; margin-top:5px;" >
                        <a href="javascript:void(0);" class="btn btn-success" id="btn_slot_details_save" onclick="modify_slot_details()"><i class="icon-save"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</a>
                        <a href="javascript:void(0);" class="btn btn-danger slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</a>
                    </div>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot_option']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['swap']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
                    <div class="row-fluid btn-group-slots pull-left" style=" margin: 0 0 15px 0;">
                        <div class=" span12 widget-body-section input-group btn-set" id="slot_action_buttons">
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1){?><button type="button" class="btn btn-info no-ml span6" id="btn_slot_franvaro" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
"><span class="icon-user"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</button><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot']==1){?><button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['boka_pass_slots_copy'];?>
" onclick="copy_single_slot();"><span class="icon-copy"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
</button><?php }?>


                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1){?><button type="button" class="btn btn-info no-ml span6" id="btn_slot_delete" onclick="delete_single_slot();" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['boka_pass_slots_delete'];?>
"><span class="icon-remove"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['delete'];?>
</button><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?><button type="button" class="btn btn-info no-ml span6" id="btn_slot_split" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['boka_pass_slots_split'];?>
"><span class="icon-level-up"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['split'];?>
</button><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot_option']==1){?><button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy_multiple" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['boka_pass_slots_copy_weekly'];?>
"><span class="icon-level-down"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_multiple'];?>
</button><?php }?>
                        </div>
                    </div>
                <?php }?>


                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1){?>
                    <div class="span12 form-wrpr hide" id="Franvaro-box" style="margin: 0 0 15px 0;">
                        <h1 style="margin: 10px 0px !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</h1>
                        <input type="hidden" name="leave_type_daySingleSlot" id="leave_type_daySingleSlot" value="2" />
                        <input type="hidden" name="leave_type_valSingleSlot" id="leave_type_valSingleSlot" value="" />
                        <div class="btn-group leave-type">
                            <?php  $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['leave_type']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['leave_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['leave_type']->key => $_smarty_tpl->tpl_vars['leave_type']->value){
$_smarty_tpl->tpl_vars['leave_type']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type_key']->value = $_smarty_tpl->tpl_vars['leave_type']->key;
?>
                                <a  href="javascript:void(0);" id="leave_type<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
" class="btn btn-default" name="leave_type" value="<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
" onclick="setLeaveTypeSingleSlot(<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
);"><?php echo $_smarty_tpl->tpl_vars['leave_type']->value;?>
</a>
                            <?php } ?>
                        </div>
                        
                        <div id="karense_notify" class="" style="display: none;"></div>
                        <div id="karense_notify1" class="" style="display: none;">
                            <div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense_turned_off'];?>
</div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1){?>
                            <div class="widget mt no-mb" id="approve_leave_on_apply">
                                <label><input type="checkbox" id="leave_approve_on_apply" name="leave_approve_on_apply" checked="checked" > <?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
</label>
                            </div>
                        <?php }?>
                        <div class="widget widget-tabs widget-tabs-double-2 no-mb" style="margin-top: 9px;">
                            <div class="widget-head">
                                <ul>
                                    <li id="date_time_time" class="active"><a class="glyphicons clock" href="#tabLeaveTimePeriod" data-toggle="tab"  onclick="leaveTabSingleSlot('time');" ><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
</span></a></li>
                                    <li id="date_time_date"><a class="glyphicons calendar" href="#tabLeaveDatePeriod" data-toggle="tab" onclick="leaveTabSingleSlot('date');"><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</span></a></li>
                                </ul>
                            </div>
                            <div class="widget-body">
                                <div class="tab-content">

                                    <div id="tabLeaveTimePeriod" class="tab-pane widget-body-regular active clearfix" style="background:#fff;">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_daySingleSlot" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
:</label>
                                                <div class="input-prepend date hasDatepicker datepicker no-pt" id="dp_leave_date_daySingleSlot" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span6" name="leave_date_daySingleSlot" id="leave_date_daySingleSlot" value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin: 0px;" class="span12">
                                            <label for="leave_time_from" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_range'];?>
:</label>
                                            <div class="input-prepend">
                                                <span class="add-on  icon-time"></span>
                                                <input class="form-control span5 time-input-text" name="leave_time_from" id="leave_time_from" value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text" />
                                                <input class="form-control span5 time-input-text" name="leave_time_to" id="leave_time_to"  value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" type="text" />
                                            </div>
                                        </div>
                                        
                                        <div id="leave_time_replacement_emps" class="span12 no-ml mt">
                                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                                <label style="padding: 0px;" class="checkbox">
                                                    <input name="send_sms_time" id="send_sms_time" class="checkbox" value="1" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_sms'];?>

                                                </label>
                                                
                                                <div id="time_replacer_nosms_tbl">
                                                    <div class="span12" style="margin: 0px;">
                                                        <label style="float: left;font-weight: bold;" class="span12" for="replace_employees_list_time"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_employee'];?>
:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees" id="replace_employees_list_time" class="form-control span12 replace_employees_list">
                                                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="time_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="float: left;font-weight: bold;" class="span12" for="rep_employees_sms"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_employee'];?>
:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees_sms" id="rep_employees_sms" class="form-control span11 replace_employees_list_sms" multiple="multiple">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_confirmation" class="checkbox" onclick="manageConf('time');" value="" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmatoin'];?>

                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_rejection" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_rejection'];?>

                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_sender" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmation_to_sender'];?>

                                                        </label>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['no_pay_leave']==1){?>
                                            <div class="span12 no_pay_sick_check_divSingleSlot no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
</span>
                                                </label>
                                            </div>
                                        <?php }?>
                                            
                                    </div>
                                    

                                    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" id="tabLeaveDatePeriod" class="tab-pane widget-body-regular clearfix">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_fromSingleSlot" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_fromSingleSlot" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_fromSingleSlot" id="leave_date_fromSingleSlot" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_toSingleSlot" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_toSingleSlot" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_toSingleSlot" id="leave_date_toSingleSlot" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                                
                                        <div id="leave_date_replacement_emps" class="span12 no-ml mt">
                                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                                <label style="padding: 0px;" class="checkbox">
                                                    <input class="checkbox" name="send_sms_date" id="send_sms_date" value="1" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_sms'];?>

                                                </label>
                                                
                                                <div id="date_replacer_nosms_tbl">
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="float: left;" class="span12 template_label" for="replace_employees_list_date"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_employee'];?>
:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_date_employees" id="replace_employees_list_date" class="form-control span12 replace_employees_list_date">
                                                                <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="date_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="float: left;" class="span12 template_label" for="rep_employees_sms"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_employee'];?>
:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees_sms" class="form-control span11 replace_employees_list_date_sms" multiple="multiple">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_confirmation_date" class="checkbox" onclick="manageConf('date');" value="" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmatoin'];?>

                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_rejection_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_rejection'];?>

                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_sender_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmation_to_sender'];?>

                                                        </label>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['no_pay_leave']==1){?>
                                            <div class="span12 no_pay_sick_check_divSingleSlot no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
</span>
                                                </label>
                                            </div>
                                        <?php }?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="span12 mt">
                            <label style="float: left;" class="span12 template_label" for="leave_comments"><?php echo $_smarty_tpl->tpl_vars['translate']->value['comments'];?>
:</label>
                            <div class="input-prepend span12" style="margin: 0px;">
                                <span class="add-on icon-comment" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></span>
                                <textarea class="form-control span11"  name="leave_comments" id="leave_comments" rows="1" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></textarea>
                            </div>
                        </div>
                        <div class="span12 no-ml mt">
                            <button type="button" class="btn btn-success span6" id="btn_save_leave" onclick="saveLeaveSingleSlot();"><i class="icon-save"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_leave'];?>
</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="Franvaro-box-close">x <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                <?php }?>


                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
                    <div class="span12 form-wrpr hide" id="slot-dela-pass" style="margin: 0 0 15px 0;">
                        <h1 style="margin:10px 0 10px 0 !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['split'];?>
</h1>
                        <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['from_time'];?>
</label>
                        <input id="split_slot_timefrom" name="split_slot_timefrom" type="text" class="span12" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from_time'];?>
" />
                        <label><?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
</label>
                        <input id="split_slot_timeto" name="split_slot_timeto" type="text" class="span12" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
" />
                        <div class="span12 no-ml">
                            <button type="button" class="btn btn-success span6" onclick="splitSlot();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="slot-dela-pass-close">x <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                <?php }?>


                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot_option']==1){?>
                    <div class="span12 form-wrpr hide" id="kopierapass-box" style="margin: 0 0 15px 0;">
                        <h1 style="margin:10px 0 10px 0 !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_multiple'];?>
</h1>
                        <form name="frm_copySingleSlot" id="frm_copySingleSlot" method="post">
                            <div class="span12" style="margin-left: 0px;">
                                <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_with_user">
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['with_user'];?>

                                </label>
                                <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_without_user">
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['without_user'];?>

                                </label>
                            </div>
                            <br>

                            <div class="span12" style="margin-left: 0px;">
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="1" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['monday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="2" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['tuesday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="3" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['wednesday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="4" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['thursday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="5" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['friday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="6" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['saturday_first_charecter'];?>

                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="0" checked="checked" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['sunday_first_charecter'];?>

                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <label style="margin-top:10px;" for="from_wk"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_from'];?>
</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12 frm_wk_selct" id="slot_copy_multiple_from_wk" onchange="getAfterDates_for_slotcopy_multiple()">
                                        <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value+1;?>
<?php $_tmp4=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['week'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['week']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['name'] = 'week';
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] = is_array($_loop=$_tmp4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['week']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['week']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['week']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['week']['index']==$_smarty_tpl->tpl_vars['cur_week']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
</option>
                                        <?php endfor; endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12" name="slot_copy_multiple_from_option" id="slot_copy_multiple_from_option" onchange="getAfterDates_for_slotcopy_multiple()">
                                        <option value="0"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_week'];?>
</option>
                                        <option value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_2'];?>
</option>
                                        <option value="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_3'];?>
</option>
                                        <option value="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['every_4'];?>
</option>
                                    </select>
                                </div>
                            </div>
                            <label style="margin-top:10px;" for="slot_copy_multiple_to_wk"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_upto'];?>
</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name="slot_copy_multiple_to_wk" id="slot_copy_multiple_to_wk" class="form-control span12"></select>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="span12 no-ml">
                            <button type="button" class="btn btn-success span6" onclick="save_copySingleSlot();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="kopierapass-box-close">x <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                <?php }?>
            </div>
            

            <div id="right_click_action_options" class="hide">

                <div id="goto-employees-options" class="span12 hide">
                    <div class="span12 panel-heading"><h4 class="panel-title clearfix"><?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
</h4></div>
                    <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                        <div id="goto-employees-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                            <?php  $_smarty_tpl->tpl_vars['empl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['empl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['righclick_employees_for_goto']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empl']->key => $_smarty_tpl->tpl_vars['empl']->value){
$_smarty_tpl->tpl_vars['empl']->_loop = true;
?>
                                <div style="margin-left: 0px;" class="span12">
                                    <div style="margin-top: 4px;" class="span12 child-slots">
                                        <label onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
/8/',1);">
                                            <span><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['empl']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['empl']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['empl']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['empl']->value['first_name'];?>
<?php }?></span>
                                        </label>
                                    </div>
                                </div>
                            <?php }
if (!$_smarty_tpl->tpl_vars['empl']->_loop) {
?>
                                <div style="margin-left: 0px;" class="span12"><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['this_customer_have_no_employees'];?>
</div></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                        <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                    </div>
                </div>
                        

                <div id="goto-customers-options" class="span12 hide">
                    <div class="span12 panel-heading"><h4 class="panel-title clearfix"><?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
</h4></div>
                    <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                        <div id="goto-customers-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                            <?php  $_smarty_tpl->tpl_vars['custl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['custl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['search_customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['custl']->key => $_smarty_tpl->tpl_vars['custl']->value){
$_smarty_tpl->tpl_vars['custl']->_loop = true;
?>
                                <div style="margin-left: 0px;" class="span12">
                                    <div style="margin-top: 4px;" class="span12 child-slots">
                                        <label onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['custl']->value['username'];?>
/8/',1);">
                                            <span><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['custl']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['custl']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['custl']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['custl']->value['first_name'];?>
<?php }?></span>
                                        </label>
                                    </div>
                                </div>
                            <?php }
if (!$_smarty_tpl->tpl_vars['custl']->_loop) {
?>
                                <div style="margin-left: 0px;" class="span12"><div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_customer_available'];?>
</div></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                        <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                    </div>
                </div>
                        

                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1){?>
                    <div id="change-employee-customer-options" class="span12 hide">
                        <div class="span12 panel-heading"><h4 class="panel-title clearfix"><?php echo $_smarty_tpl->tpl_vars['translate']->value['change'];?>
</h4></div>
                        <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                            <input type="hidden" name="slots_to_change_users" id="slots_to_change_users" value="" />
                            <input type="hidden" name="change_usertype_to_change_users" id="change_usertype_to_change_users" value="" />
                            <div id="available_users_for_change" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;"></div>
                        </div>
                        <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                            <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangeUserMultiple();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                <?php }?>
                

                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
                    <div id="replace-employee-week-basis" class="manage-form span12 hide">
                        <div class="span12">
                            <h4 style="margin-top:20px;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replace_user'];?>
</h4>
                            <hr>
                            <div class='row-fluid'>
                                <div class="span12" style="margin-left: 1.49254%;">
                                    <span style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacing_employee'];?>
:</span> <span id="spn_replacing_employee"></span>
                                </div>
                                <div class="span12">
                                    <span style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
:</span> 
                                    <input type="checkbox" class="checkbox" name="repl_infocus" value="radio" id="repl_infocus" onchange="loadEmployeesForReplacement();" checked="checked">
                                    <span id="spn_replace_customer"></span>
                                </div>
                                <input type="hidden" name="slot_customer" class='slot_customer' value="" />
                                <input type="hidden" name="slot_employee" class='slot_employee' value="" />
                            </div>
                            <div class="form-section-highlight">
                                <div class="row-fluid">
                                    <div class="form-group">
                                        <div class="input-prepend date hasDatepicker datepicker" id="replace_emp_date_from_div">
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from_date'];?>
" id="replace_emp_date_from" name="replace_emp_date_from"  class="form-control span12">
                                        </div>
                                        <div class="input-prepend date datepicker" id="replace_emp_date_to_div">
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to_date'];?>
" id="replace_emp_date_to" name="replace_emp_date_to"  class="form-control span12">
                                        </div>
                                    </div>
                                </div>

                                <h4><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacer_employees'];?>
</h4>
                                <div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>
                            </div>
                        </div>
                        <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                            <button type="button" class="btn btn-success span6" id="btnReplaceEmpMultiple" onclick="saveReplaceMultipleConfirm();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['close'];?>
</button>
                        </div>
                    </div>
                <?php }?>
                

                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                    <div id="sms-for-emp-allocation" class="manage-form span12 hide">
                        <div class="span12">
                            <h4 style="margin-top:20px;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['sms'];?>
</h4>
                            <hr>
                            <div class="form-section-highlight">

                                <h4><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_employee'];?>
</h4>
                                <input type="hidden" name="slot_ids" class="slot_ids" value="" />
                                <select multiple="multiple" class="form-control span11 send_employees_list_sms" id="send_employees_list_sms" name="send_employees_list_sms"></select>
    

                                <div class="row-fluid">
                                    <div style="margin: 5px 0px 0px;" class="span12">
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="" onclick="manageSmsAllotmentConf()" class="checkbox" name="chk_confirmation_allotment"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmatoin'];?>

                                        </label>
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_rejection_allotment"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_rejection'];?>

                                        </label>
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_sender_allotment"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['confirmation_to_sender'];?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                            <button type="button" class="btn btn-success span6" id="btnEmpAllotSMS" onclick="sendSmsForAllotment()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send'];?>
</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="alert alert-danger alert-dismissable">
                <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  <?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>

            </div>
        </div>
    </div>
<?php }?> 

    



    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.scrolltabs.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.mousewheel.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/date-picker.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/time_formats.js?v=<?php echo filemtime('js/time_formats.js');?>
" type="text/javascript" ></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jQuery.print.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.floatThead.js" type="text/javascript" ></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.floatThead.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.stickyPanel.js"></script>
    
    <script>
        var $translate = <?php echo $_smarty_tpl->tpl_vars['translate_json']->value;?>
;
        var $privileges_gd = <?php echo $_smarty_tpl->tpl_vars['privileges_gd_json']->value;?>
;
        
        //didn't remove this js block from this location
        $(function(){
            $.contextMenu( 'destroy' );
        });
        function printSchedule(container) {
            $('table#monthlyviewtbl').floatThead('destroy');
            $('.fixed-scrolling-tbl').css('height', 'auto').css('overflow-y', 'auto');
            $('#schedule_det').print();
 
            window.onfocus = function() {
                $('.fixed-scrolling-tbl').css('height', '450px').css('overflow-y', '');
                $demo1.floatThead({
                        scrollContainer: function($demo1){
                                return $demo1.closest('.fixed-scrolling-tbl');
                        }
                });
                $demo1.floatThead('reflow');
            };
        }
    </script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.contextmenu.js"></script>
    

    <script type="text/javascript">

        var $demo1 = $('table.week-slot-calender');
        $demo1.floatThead({
                scrollContainer: function($demo1){
                        return $demo1.closest('.fixed-scrolling-tbl');
                }
        });
        
        $(document).ready(function() {
            window.get_day_refresh = function(date, customer, employee, get_transaction_message){
            //function get_day_refresh(date, customer){
                var obj_process = { action: 'get_day_slots', 'date': date, 'pCustomer': customer}
                if(typeof get_transaction_message !== 'undefined' && get_transaction_message)
                    obj_process['show_message'] = 'true';
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data: obj_process,
                    success:function(data){
                        //console.log(data);
                        make_day_refresh(data, date, $translate);
                        
                        if(typeof get_transaction_message !== 'undefined' && get_transaction_message && typeof data.message !== 'undefined'){
                            $('#left_message_wraper').html(data.message).delay(10000).html();
                        }
                    }
                }).always(function(data) {
                    
                });
            }
            function make_day_refresh(data, date, $local_translate){
                var main_reference = $('.weekly_day.weekly_day_slots[data-date='+date+']');
                var main_reference_content_part = main_reference;
                main_reference_content_part.html('');

                var $login_user      = data.login_user;
                var $login_user_role = data.login_user_role;
                var $privileges_gd   = data.privileges_gd;
                var $swap_copied_slot= data.swap_copied_slot

                var new_content = '';
                var new_content_tooltip = '';
                if(data.selected_day_slots.length > 0){
                    $.each(data.selected_day_slots, function(i, $slot) {
                        if($login_user_role != 3 || ($login_user_role == 3 && ($privileges_gd.not_show_employees == 0 || ($privileges_gd.not_show_employees == 1 && $slot.employee == $login_user)))){
                            var special_slot_class_name = '';
                            if($slot.status == 2) special_slot_class_name = 'slot-theme-leave';
                            else if($slot.status == 4) special_slot_class_name = 'slot-theme-candg';
                            else if($slot.status == 0 || $slot.status == 3) special_slot_class_name = 'slot-theme-incomplete';
                            else if($slot.status == 1 && $slot.created_status == 1) special_slot_class_name = 'slot-theme-candg-accept';
                            else if($slot.type == 10) special_slot_class_name = 'slot-theme-pm';
                            else special_slot_class_name = 'slot-theme-complete';
                            
                            var fkkn_text = '';
                            if($slot.fkkn == '1') fkkn_text = $local_translate.fk;
                            else if($slot.fkkn == '2') fkkn_text = $local_translate.kn;
                            else if($slot.fkkn == '3') fkkn_text = $local_translate.tu;
                            
                            var slot_type_class = slot_type_label = '';
                            switch($slot.type){
                                case '1': slot_type_class = 'slot-icon-small-travel'; slot_type_label = $local_translate.travel; break;
                                case '0': slot_type_class = 'slot-icon-small-normal'; slot_type_label = $local_translate.normal; break;
                                case '2': slot_type_class = 'slot-icon-small-break'; slot_type_label = $local_translate.break; break;
                                case '3': slot_type_class = 'slot-icon-small-oncall'; slot_type_label = $local_translate.oncall; break;
                                case '4': slot_type_class = 'slot-icon-small-over-time'; slot_type_label = $local_translate.overtime; break;
                                case '5': slot_type_class = 'slot-icon-small-qualtiy-overtime'; slot_type_label = $local_translate.qual_overtime; break;
                                case '6': slot_type_class = 'slot-icon-small-more-time'; slot_type_label = $local_translate.more_time; break;
                                case '14': slot_type_class = 'slot-icon-small-oncall-moretime'; slot_type_label = $local_translate.more_oncall; break;
                                case '7': slot_type_class = 'slot-icon-small-some-other-time'; slot_type_label = $local_translate.some_other_time; break;
                                case '8': slot_type_class = 'slot-icon-small-training'; slot_type_label = $local_translate.training_time; break;
                                case '9': slot_type_class = 'slot-icon-small-call-training'; slot_type_label = $local_translate.call_training; break;
                                case '10': slot_type_class = 'slot-icon-small-personal-meeting'; slot_type_label = $local_translate.personal_meeting; break;
                                case '11': slot_type_class = 'slot-icon-small-voluntary'; slot_type_label = $local_translate.voluntary; break;
                                case '12': slot_type_class = 'slot-icon-small-complimentary'; slot_type_label = $local_translate.complementary; break;
                                case '13': slot_type_class = 'slot-icon-small-complimentary-oncall'; slot_type_label = $local_translate.complementary_oncall; break;
                                case '15': slot_type_class = 'slot-icon-small-standby'; slot_type_label = $local_translate.oncall_standby; break;
                                case '16': slot_type_class = 'slot-icon-small-dismissal'; slot_type_label = $local_translate.work_for_dismissal; break;
                                case '17': slot_type_class = 'slot-icon-small-dismissal-oncall'; slot_type_label = $local_translate.work_for_dismissal_oncall; break;
                            }
                            
                            new_content += '<span class="collapse-slot-2 clearfix" id="slot_thread_'+$slot.id+'">\n\
                                                    <div \n\
                                                        class="slot-week slot-week-draggable slot_bountery '+special_slot_class_name+' span12 '+($slot.signed == 1 ? 'signed_slot' : '')+' '+($swap_copied_slot == $slot.id ? 'objblink' : '')+'" \n\
                                                        onmouseover="tooltip.pop(this, \'#slot_details_'+$slot.id+'\', { position:0, offsetX:-20, effect:\'slade\'});"\n\
                                                        data-slot-id="'+$slot.id+'">\n\
                                                        <input type="hidden" class="slot_details_hub" \n\
                                                           data-id="'+$slot.id+'"\n\
                                                           data-type="'+$slot.type+'"\n\
                                                           data-date="'+$slot.date+'"\n\
                                                           data-status="'+$slot.status+'"\n\
                                                           data-time-from="'+$slot.time_from+'"\n\
                                                           data-time-to="'+$slot.time_to+'"\n\
                                                           data-total_hours="'+$slot.slot_hour+'"\n\
                                                           data-customer-id="'+$slot.customer+'"\n\
                                                           data-customer-name="'+$slot.cust_name+'"\n\
                                                           data-employee-id="'+$slot.employee+'"\n\
                                                           data-employee-name="'+$slot.emp_name+'"\n\
                                                           data-fkkn="'+$slot.fkkn+'"\n\
                                                           data-signed="'+$slot.signed+'"\n\
                                                           data-comment="'+$slot.comment+'"\n\
                                                           />\n\
                                                        '+($slot.status == 2 ? '<input type="hidden" class="slot_leave_details_hub" \n\
                                                                data-leave-id="'+$slot.leave_data.id+'"\n\
                                                                data-leave-status="'+$slot.leave_data.status+'"\n\
                                                                data-leave-group-id="'+$slot.leave_data.group_id+'"\n\
                                                                data-leave-time-from="'+$slot.leave_data.time_from+'"\n\
                                                                data-leave-time-to="'+$slot.leave_data.time_to+'"\n\
                                                                data-leave-is-exist-relation="'+$slot.leave_data.is_exist_relation+'"\n\
                                                                />' : '') +'\n\
                                                        <div class="inner-panel span12 '+($slot.signed == 1 ? 'striped' : '')+'">\n\
                                                            <div class="week-slot-notification-wrpr" style="background:'+$slot.emp_color+';">\n\
                                                                '+($slot.comment != '' && $slot.comment != null ? '<div class="week-slot-notification"><div class="week-slot-notification-comment"></div></div>' : '')+'\n\
                                                            </div>\n\
                                                            <div class="week-slottype-wrpr" style="position: relative; ">\n\
                                                                <div class="week-slot-time text-limit-small-devices" style="font-size:12px;">'+$slot.slot+'('+$slot.slot_hour+')</div>\n\
                                                            </div>';
                                                            new_content += '<div class="week-slottype visibility-hidden">'+fkkn_text+'</div> ';
                                                            new_content += '<div class="span12 week-slottype-employe" style="margin:0;">\n\
                                                                <div class="week-slot-name" style="position: absolute;margin: -3px 0 0 12px;">'+$slot.emp_name+'</div>\n\
                                                                <div class="week-slot-type">\n\
                                                                    <ul class="slot-type-small-icons-group slot-week-types-icon">\n\
                                                                        <li class="'+slot_type_class+'" title="'+slot_type_label+'"></li>\n\
                                                                    </ul>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                            <div class="slot-week-checkbox-wrpr hide-small-devices" >\n\
                                                                '+($slot.status == 2 ? '<div class="week-slot-badge-wrpr"><span class="label week-slot-badge">'+$slot.leave_data.leave_name+'</span></div>' : '')+'\n\
                                                                '+($slot.tl_flag == 1 && $slot.signed == 0 && $slot.status != 2 && ($privileges_gd.process == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.remove_employee == 1 || $privileges_gd.remove_customer == 1) ? '<input type="checkbox" class="check-box pull-right m_check no-print" value="'+$slot.id+'" />' : '')+'\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </span>';

                            //--------------for tooltip------------------------------

                            new_content_tooltip += '<div class="slot_expand_view_parent" style="display:none;" data-id="'+$slot.id+'">\n\
                                            <div id="slot_details_'+$slot.id+'" class="clearfix slot-hover-popup span4 '+special_slot_class_name+'">\n\
                                                <div class="clearfix '+($slot.signed == 1 ? 'striped' : '')+'" style="padding: 15px;">\n\
                                                    <ul class="clearfix">\n\
                                                        <li><h1>'+$slot.slot+' ('+$slot.slot_hour+')</h1></li>\n\
                                                        <li><span class="icon-group"></span> '+($slot.customer != '' && $slot.customer != null  ? $slot.cust_name : '['+$local_translate.no_customer+']')+'</li>\n\
                                                        <li><span class="icon-user"></span> '+($slot.employee != '' && $slot.employee != null ? $slot.emp_name : '['+$local_translate.no_employee+']')+'</li>\n\
                                                        '+($slot.comment != '' && $slot.comment != null ? '<li class="hover-popup-comment"><span class="icon-comment"></span>'+nl2br($slot.comment)+'</li>' : '')+'\n\
                                                        <hr>\n\
                                                        <li class="clearfix"> ';
                                                        new_content_tooltip += '<span class="slot-type pull-left">'+fkkn_text+'</span> ';
                                                        new_content_tooltip += '<span class="pull-left">\n\
                                                                <ul class="slot-type-small-icons-group clearfix">\n\
                                                                    <li class="'+slot_type_class+'" title="'+slot_type_label+'"></li>\n\
                                                                </ul>\n\
                                                            </span>\n\
                                                            '+($slot.status == '2' ? '<span class="label label-important" style="padding: 5px;">'+$slot.leave_data.leave_name+'</span>' : '')+'\n\
                                                        </li>\n\
                                                    </ul>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                        }
                        $('#slot_expanded_views').find('#slot_details_'+$slot.id).parents('.slot_expand_view_parent').remove();
                    });

                }
                main_reference_content_part.html(new_content);
                $('#slot_expanded_views').append(new_content_tooltip);
                $(".slot-week-draggable").draggable({ revert: "invalid", appendTo: "#week-slot-calender", helper: 'clone', cancel: ".signed_slot,.slot-theme-leave,.slot-theme-candg", delay: 300, start: 
                        function (event, ui) { ui.helper.css({ 'width': '163px', 'opacity': '1'}); } 
                });
                rebind_events();

            }
            function rebind_events(){
                bind_slot_click_event();
            }
            
            $('.refresh_day').click(function(){
                var this_day = $(this).parents('.weekly_day').attr('data-date');
                get_day_refresh(this_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
');
            });
            
            $('.alert-dismissable').delay(10000).fadeOut();
            
            $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
            $('.fixed-scrolling-tbl').css({ height: Math.max($(window).innerHeight()- 50- $('.accordion-heading').innerHeight()- $('#cust_details_header_panel').innerHeight(), 250) });
            $(window).resize(function(){
                $demo1.floatThead('reflow');
                $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
                $('.fixed-scrolling-tbl').css({ height: Math.max($(window).innerHeight()- 50- $('.accordion-heading').innerHeight()- $('#cust_details_header_panel').innerHeight(), 250) });
            }).resize();
            
            $(document).off('click', ".slot-icons-day.can_change .slot-icon").on('click', ".slot-icons-day.can_change .slot-icon", function() {
                $(".slot-icons-day").css('width', 'auto');
                $(".slot-icons-day").css('height', 'auto');
                $(".slot-icons-day").css('overflow', 'block');
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon').css("display", 'block');
            });
            $(document).off('dblclick', ".slot-icons-day .slot-icon").on('dblclick', ".slot-icons-day .slot-icon", function() {
                $(".slot-icons-day").css('width', '27px');
                $(".slot-icons-day").css('height', '30px');
                $(".slot-icons-day").css('overflow', 'hidden');
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon:not(.active)').css("display", 'none');
            });
            $(document).off('click', ".single-slot-icon-list li.slot-icon").on('click', ".single-slot-icon-list li.slot-icon", function() {
                $(this).parents('.single-slot-icon-list').find(' li.slot-icon').removeClass("active");
                $(this).addClass("active");
            });
            
            $('.weekly_control #all_check').click(function () {
                $('#week-slot-calender .slot-week').find('.m_check:checkbox').attr('checked', this.checked);
            });
            
            $("#add-slots, #show-memory-slots-btn").click(function() {
                close_right_panel();
                show_right_panel();
                $("#slot_creation_main_wraper_group").removeClass('hide');
                $("#memory-slots").removeClass('hide');
				
                $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
                
                $('#memory-slots #dp_memslot_throw_date').datepicker('update', '<?php echo $_smarty_tpl->tpl_vars['week_start_date']->value;?>
');
            });
            
            var stickyPanelOptions = {
                //topPadding: 0,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };
            
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
            
            $("#create-slot").click(function() {
                close_right_panel();
                show_right_panel();
                $("#slot_creation_main_wraper_group").removeClass('hide');
                $(".add-new-slots-month .create-slotes-panel").html(get_slot_add_theme());
                $(".add-new-slots-month").removeClass('hide');
                
                $("#btnGroupStickyPanel").stickyPanel('unstick');
                $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
                
                var date = $('.add-new-slots-month #new_slot_date').val();
                date = (typeof date != 'undefined' ? date : '');
                if(date == '')
                    $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', '<?php echo $_smarty_tpl->tpl_vars['week_start_date']->value;?>
');
                
                
                $('.add-new-slots-month .slot_date').focus();
                
            });
            
            
            var bind_slot_click_event = function() {
                $(".slot-week").click(function() {
                    close_right_panel();
                    show_right_panel();
                    $(".hide-add-new-slot-form").removeClass('hide');
                    $("#slot_details_main_wraper_group").removeClass('hide');

                    //---------------add data-----------------------
                    var slot_data       = $(this).find('.slot_details_hub');
                    var slot_id         = slot_data.attr('data-id');
                    var slot_date       = slot_data.attr('data-date');
                    var slot_timefrom   = $.trim(slot_data.attr('data-time-from'));
                    var slot_time_to    = $.trim(slot_data.attr('data-time-to'));
                    var slot_customer_id= slot_data.attr('data-customer-id');
                    var slot_employee_id= slot_data.attr('data-employee-id');
                    var slot_fkkn       = slot_data.attr('data-fkkn');
                    var slot_type       = slot_data.attr('data-type');
                    var slot_status     = slot_data.attr('data-status');
                    var slot_signed     = slot_data.attr('data-signed') == 1 ? true : false;

                                    $('html, body').animate({
                                    scrollTop: $(".main-right").offset().top
                                    }, 3000);




                    $('#slot_details_main_wraper_group #sdID').val(slot_id);  //id
                    $('#slot_details_main_wraper_group #slot_details_date').datepicker('update', slot_date);  //date
                    $('#slot_details_main_wraper_group #sdTFrom').val(slot_timefrom);  //from-time
                    $('#slot_details_main_wraper_group #sdTTo').val(slot_time_to);  //from-time
                    $('#slot_details_main_wraper_group #sdCustomerID').val(slot_customer_id);  //customer-id
                    $('#slot_details_main_wraper_group #sdCustomer').html(slot_data.attr('data-customer-name'));  //customer-name

                    $('#slot_details_main_wraper_group #sdFKKN').val(slot_fkkn);  //fkkn
                    $('#slot_details_main_wraper_group #sdComment').val(slot_data.attr('data-comment'));  //comment

                    //
                    $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon').removeClass("active").css("display", 'none');
                    $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon-type-'+slot_data.attr('data-type')).addClass("active").css("display", 'block');


                    //set actual slot values to hidden fields
                    $('#slot_details_main_wraper_group #this_slot_actual_date').val(slot_date);
                    $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val(slot_timefrom);
                    $('#slot_details_main_wraper_group #this_slot_actual_timeto').val(slot_time_to);
                    $('#slot_details_main_wraper_group #this_slot_actual_customer').val(slot_customer_id);
                    $('#slot_details_main_wraper_group #this_slot_actual_employee').val(slot_employee_id);
                    $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val(slot_data.attr('data-employee-name'));
                    $('#slot_details_main_wraper_group #this_slot_actual_fkkn').val(slot_fkkn);
                    $('#slot_details_main_wraper_group #this_slot_actual_type').val(slot_type);
                    
                    $('.karense_label').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
 - '+slot_data.attr('data-employee-name'));
                    
                    //hide pm-special employee section 
                    $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');

                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                        //clone leave relation slot
                        $('#slot_details_main_wraper_group #clone_leave_action_btn_group').addClass('hide');
                    <?php }?>

                    //leave details 
                    var slot_leave_data = { };
                    if(slot_status == 2){
                        slot_leave_data       = $(this).find('.slot_leave_details_hub');

                        $('#slot_details_main_wraper_group #this_slot_leave_id').val(slot_leave_data.attr('data-leave-id'));
                        $('#slot_details_main_wraper_group #this_slot_leave_group_id').val(slot_leave_data.attr('data-leave-group-id'));
                        $('#slot_details_main_wraper_group #this_slot_leave_time_from').val(slot_leave_data.attr('data-leave-time-to'));
                        $('#slot_details_main_wraper_group #this_slot_leave_time_to').val(slot_leave_data.attr('data-leave-time-to'));
                        $('#slot_details_main_wraper_group #this_slot_leave_status').val(slot_leave_data.attr('data-leave-status'));
                    }
                    else {
                        $('#slot_details_main_wraper_group #this_slot_leave_id, #slot_details_main_wraper_group #this_slot_leave_group_id, #slot_details_main_wraper_group #this_slot_leave_time_from, #slot_details_main_wraper_group #this_slot_leave_time_to, #slot_details_main_wraper_group #this_slot_leave_status').val('');
                    }

                    var slot_details_obj = { 'slot_id': slot_id,
                                    'slot_date': slot_date,
                                    'slot_timefrom': slot_timefrom,
                                    'slot_time_to': slot_time_to,
                                    'slot_customer_id': slot_customer_id,
                                    'slot_employee_id': slot_employee_id};

                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
                        //hide candg action buttons
                        $('#slot_details_main_wraper_group #candg_action_btn_group').addClass('hide');
                    <?php }?>

                    $('#slot_details_main_wraper_group #leave_quick_action_btn_group, #slot_details_main_wraper_group .leave_accept_btn, #slot_details_main_wraper_group .leave_reject_btn, #slot_details_main_wraper_group .leave_cancel_btn, #slot_details_main_wraper_group .leave_edit_btn, #slot_details_main_wraper_group #leave_edit_wrpr').addClass('hide');

                    //block all features as first time
                    $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom,\n\
                        #slot_details_main_wraper_group #sdTTo, #slot_details_main_wraper_group #sdEmployee,\n\
                        #slot_details_main_wraper_group #sdFKKN, #slot_details_main_wraper_group #sdComment').attr('disabled', 'disabled');

                    $('#slot_action_buttons, #btn_slot_details_save').addClass('hide');//#btn_direct_lock_slot
                    $('#slot_details_main_wraper_group #sdTypes').addClass('disabled_types');   //to disable open event of slot types
                    $('#slot_details_main_wraper_group #sdTypes').removeClass('can_change');   //to disable open event of slot types

                    //check privileges to slot_action_buttons
                    $('#btn_slot_franvaro, #btn_slot_copy, #btn_slot_swap_copy, #btn_slot_swap, #btn_slot_delete, #btn_slot_split, #btn_slot_copy_multiple').addClass('hide');  //hide all action button as first

                    //block edit of signed/leave/candg slots
                    if(slot_signed || slot_status == 2 || slot_status == 4){
                        //employee section
                        $('#slot_details_main_wraper_group #sdEmployee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
</option>');  //employee
                        if(slot_data.attr('data-employee-id') !== '')
                            $('#slot_details_main_wraper_group #sdEmployee').append('<option value="'+slot_data.attr('data-employee-id')+'" selected="selected">'+slot_data.attr('data-employee-name')+'</option>');

                        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
                            if(slot_status == 4 && slot_employee_id != ''){
                                $('#slot_details_main_wraper_group #candg_action_btn_group').removeClass('hide');
                                $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                            }
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
                            if(slot_status == 2){
                                $('#slot_details_main_wraper_group #leave_quick_action_btn_group').removeClass('hide');
                                if(slot_leave_data.attr('data-leave-status') == '0' || slot_leave_data.attr('data-leave-status') == 0){
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1){?>$('#slot_details_main_wraper_group .leave_accept_btn').removeClass('hide');<?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1){?>$('#slot_details_main_wraper_group .leave_reject_btn').removeClass('hide');<?php }?>
                                }
                                else if(slot_leave_data.attr('data-leave-status') == '1' || slot_leave_data.attr('data-leave-status') == 1){
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
                                        $('#slot_details_main_wraper_group .leave_cancel_btn, #slot_details_main_wraper_group .leave_edit_btn').removeClass('hide');
                                        //$('#slot_details_main_wraper_group #leave_edit_wrpr').removeClass('hide');
                                    <?php }?>
                                }
                            }
                        <?php }?>
                        if(slot_status == 2){
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                                if(slot_leave_data.attr('data-leave-is-exist-relation') == '0')
                                    $('#slot_details_main_wraper_group #clone_leave_action_btn_group').removeClass('hide');
                            <?php }?>
                        }
                    }
                    else{
                        wrapLoader('#slot_details_main_wraper_group');
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                            type:"POST",
                            dataType: 'json',
                            data: { action: 'check_slot_credentials', 'slot_id': slot_id},
                            success:function(data){
                                //console.log(data);
                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1){?>
                                    if(slot_employee_id != '' && data.tl_flag && slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17 )
                                        $('#btn_slot_franvaro').removeClass('hide');
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot']==1){?>
                                if(data.tl_flag)
                                    $('#btn_slot_copy').removeClass('hide');
                                <?php }?>

                                

                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1){?>
                                    if(data.tl_flag)
                                        $('#btn_slot_delete').removeClass('hide');
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
                                    if(data.tl_flag)
                                        $('#btn_slot_split').removeClass('hide');
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot_option']==1){?>
                                    if( (slot_employee_id != '' || slot_customer_id != '') && data.tl_flag)
                                        $('#btn_slot_copy_multiple').removeClass('hide');
                                <?php }?>


                                


                                var privileges_change_time = '<?php echo $_smarty_tpl->tpl_vars['privileges_gd']->value['change_time'];?>
';
                                if( privileges_change_time == '1' && data.tl_flag)
                                    $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo').removeAttr('disabled');

                                var privileges_fkkn     = '<?php echo $_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn'];?>
';
                                var loggedin_userrole   = '<?php echo $_smarty_tpl->tpl_vars['login_user_role']->value;?>
';
                                var loggedin_user       = '<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
';
                                if( privileges_fkkn == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3')))
                                    $('#slot_details_main_wraper_group #sdFKKN').removeAttr('disabled');

                                var privileges_add_employee     = '<?php echo $_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee'];?>
';
                                var privileges_remove_employee  = '<?php echo $_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee'];?>
';
                                if( (privileges_add_employee == '1' || privileges_remove_employee == '1') && ((loggedin_userrole == '3' && (slot_employee_id == loggedin_user || slot_employee_id == '')) || (loggedin_userrole != '3'))){
                                    $('#slot_details_main_wraper_group #sdEmployee').removeAttr('disabled');
                                    load_avail_emps_for_slot(slot_details_obj, $('#slot_details_main_wraper_group #sdTFrom'));
                                } else {
                                    $('#slot_details_main_wraper_group #sdEmployee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
</option>');  //employee
                                    if(slot_employee_id !== '')
                                        $('#slot_details_main_wraper_group #sdEmployee').append('<option value="'+slot_employee_id+'" selected="selected">'+slot_data.attr('data-employee-name')+'</option>');
                                }

                                var privileges_slot_type = '<?php echo $_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type'];?>
';
                                if( privileges_slot_type == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3'))){
                                    $('#slot_details_main_wraper_group #sdTypes').removeClass('disabled_types');
                                    $('#slot_details_main_wraper_group #sdTypes').addClass('can_change');   //to disable open event of slot types
                                }

                                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                    $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                                    $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');  // #btn_direct_lock_slot
                                <?php }else{ ?>
                                    if(slot_employee_id == loggedin_user || slot_employee_id ==''){
                                        $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                                    }

                                    if(slot_employee_id == loggedin_user || slot_employee_id == '' ||
                                        (privileges_change_time == '1' && data.tl_flag) ||
                                        (privileges_add_employee == '1' || privileges_remove_employee == '1') ||
                                        privileges_slot_type == '1'){
                                            $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');
                                    }

                                <?php }?>
                            }
                        }).always(function(data) { 
                            uwrapLoader('#slot_details_main_wraper_group');
                            $('#slot_details_main_wraper_group #sdTFrom').focus();
                        });
                    }

                    //by default leave type day set as 2 (leave as timeperiod)
                    //$('#leave_type_day').val(2);
                    $('#Franvaro-box #leave_type_valSingleSlot').val('');
                    $('#slot_details_main_wraper_group #Franvaro-box .no_pay_sick_check_divSingleSlot').addClass('hide');

                });
                
                $(".m_check, #all_check").click(function(e){
                    e.stopPropagation();
                });
                
                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                    $(".slot-week-draggable").draggable({ revert: "invalid", appendTo: "#week-slot-calender", helper: 'clone', cancel: ".signed_slot,.slot-theme-leave,.slot-theme-candg", delay: 300, start: 
                            function (event, ui) { ui.helper.css({ 'width': '163px', 'opacity': '1'}); } 
                    });  //helper: "original"
                <?php }?>
            }
            rebind_events();
            
            $('#chk_show_unmanned_slot_only').click(function() {
                if($(this).is(':checked'))
                    $('#week-slot-calender').addClass('show_unmanned_slot_only');
                else
                    $('#week-slot-calender').removeClass('show_unmanned_slot_only');
            });


            //change event of customer combo box
            $("#cmb_customer").change(function(){
                var selected_customer = $.trim($(this).val());
                if(selected_customer != ''){
                    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/'+selected_customer+'/8/', 1);
                }
            });
        });
        
        function split_slot_event() {
            close_right_panel();
            show_right_panel();
            $("#slot_details_main_wraper_group").removeClass('hide');
            $("#slot-wrpr-slots, #slot_action_buttons, #Franvaro-box, #kopierapass-box").addClass('hide');
            $("#slot-dela-pass-close").click(function(){ close_right_panel(); });
            var ids_temp = $('#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check').map(function () {
                return this.value;
            }).get();
            var ids = ids_temp.join('-');
            var included_slots = false;
            var slot_timefrom = null;
            var slot_timeto = null;
            $('#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                included_slots = true;
                var slot_data = $(this).parents('.slot-week').find('.slot_details_hub');
                slot_timefrom = $.trim(slot_data.attr('data-time-from'));
                slot_timeto = $.trim(slot_data.attr('data-time-to'));
            });
            $("#split_slot_timefrom").val(slot_timefrom);
            $("#split_slot_timeto").val(slot_timeto);
            $("#this_slot_actual_timefrom").val(slot_timefrom);
            $("#this_slot_actual_timeto").val(slot_timeto);
            //load slot timefrom - timeto as default
            if($("#slot-dela-pass").hasClass('hide')){
                $("#split_slot_timefrom").val(slot_timefrom);
                $("#split_slot_timeto").val(slot_timeto);
            }
            $('#slot_details_main_wraper_group #sdID').val(ids);
            //alert(slot_timefrom);
            $("#slot-dela-pass").toggleClass('hide');
            if(!$("#slot-dela-pass").hasClass('hide')){
                $('.main-right').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }

        }
        
        function show_right_panel(){
            $('#gdweek_wraper').addClass('show_main_right');
            $('.main-right').removeClass('hide');
            //$('.week-slot-name, .customer-name, .week-slot-time').addClass('limit-text');
            //$(window).resize();
            $demo1.floatThead('reflow');
        }
        
        function close_right_panel(){
            $('#gdweek_wraper').removeClass('show_main_right');
            //$('.week-slot-name, .customer-name, .week-slot-time').removeClass('limit-text');
            $(".main-right").addClass('hide');
            $(".manage-form, #slot_details_main_wraper_group, #right_click_action_options, #slot_creation_main_wraper_group").addClass('hide');
            $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
            $("#change-employee-customer-options, #replace-employee-week-basis, #sms-for-emp-allocation, #goto-customers-options, #goto-employees-options,#change_time_of_slots").addClass('hide');
            $(".add-new-slots-month, #memory-slots").addClass('hide');
            //$(window).resize();
            $demo1.floatThead('reflow');
        }
    </script>
    

    <script type="text/javascript">
        $(document).ready(function() {
        
            //replace ',' => '.' while entering time
            $(document).off('keyup', "#sdTFrom, #sdTTo, #leave_time_from, #leave_time_to, #split_slot_timefrom, #split_slot_timeto,\n\
                #new_slot_from, #new_slot_to, .slot_from, .slot_to")
                .on('keyup', "#sdTFrom, #sdTTo, #leave_time_from, #leave_time_to, #split_slot_timefrom, #split_slot_timeto,\n\
                    #new_slot_from, #new_slot_to, .slot_from, .slot_to", function(e) {
                        // get keycode of current keypress event
                        var code = (e.keyCode || e.which);

                        // do nothing if it's an arrow key
                        if(code == 37 || code == 38 || code == 39 || code == 40) {
                            return;
                        }
                        var this_val = $(this).val();
                        var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                        $(this).val(new_val);
            });
            
            $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo, \n\
            #slot_details_main_wraper_group #sdEmployee, #slot_details_main_wraper_group #sdFKKN, #slot_details_main_wraper_group #sdComment').keypress(function(e) {
                if(e.which == 13) {
                    if(!$('#slot_details_main_wraper_group .slot-wrpr-buttons #btn_slot_details_save').hasClass('hide'))
                        modify_slot_details();
                }
            });
            
            $('#slot_details_main_wraper_group #slot_details_date').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
            .on('changeDate', function(ev){
                load_avail_emps_within_period(this);
              
                var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
                if(slot_type == 10){
                    load_pm_special_employees();
                } else 
                    $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');
            });
            
            $('.add-new-slots-month #dtPickerNewSlotDate').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
            .on('changeDate', function(ev){
                $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
            });
            
            /*Franvaro*/
            $("#btn_slot_franvaro").click(function() {
                $("#kopierapass-box, #slot-dela-pass").addClass('hide');
                $('#karense_notify').html('');
                $('#Franvaro-box').find('.btn-group.leave-type').find('.btn').removeClass('active');
                //load leave replacement employees
                if($("#Franvaro-box").hasClass('hide')){
                    //var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                    $('#Franvaro-box #leave_date_fromSingleSlot, #Franvaro-box #leave_date_toSingleSlot, #Franvaro-box #leave_date_daySingleSlot').datepicker('update', slot_date);
                    $('#Franvaro-box #dp_leave_date_fromSingleSlot, #Franvaro-box #dp_leave_date_toSingleSlot, #Franvaro-box #dp_leave_date_daySingleSlot').datepicker('update', slot_date);

                    $("#Franvaro-box #leave_time_from").val(slot_timefrom);
                    $("#Franvaro-box #leave_time_to").val(slot_timeto);
                    <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                        load_replacement_employees('get_for_2_modes');
                    <?php }?>
                    
                }
                $("#Franvaro-box").toggleClass('hide');
                
                if(!$("#Franvaro-box").hasClass('hide')){
                    $('.main-right').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
                
            });

            $("#Franvaro-box-close").click(function() {
                $("#Franvaro-box").addClass('hide');
            });

            /*kopiera pass*/
            $("#btn_slot_copy_multiple").click(function() {
                $("#Franvaro-box, #slot-dela-pass").addClass('hide');
                
                //load slot from week- to week as default
                if($("#kopierapass-box").hasClass('hide')){
                    var slot_date   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var cur_week    = date('W',  strtotime(slot_date));
                    $("#kopierapass-box #slot_copy_multiple_from_wk").val(parseInt(cur_week));
                    getAfterDates_for_slotcopy_multiple();
                    
                    var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    
                    if(slot_employee != ''){
                        $('#kopierapass-box #lbl_copy_slot_with_user').removeClass('hide');
                        $('#kopierapass-box #slot_copy_multiple_withuser').attr('checked', 'checked');
                    }else
                        $('#kopierapass-box #lbl_copy_slot_with_user').addClass('hide');
                    
                    if(slot_customer != ''){
                        $('#kopierapass-box #lbl_copy_slot_without_user').removeClass('hide');
                        if(slot_employee == ''){
                            $('#kopierapass-box #slot_copy_multiple_withoutuser').attr('checked', 'checked');
                        }
                    }else
                        $('#kopierapass-box #lbl_copy_slot_without_user').addClass('hide');
                }
                $("#kopierapass-box").toggleClass('hide');
                if(!$("#kopierapass-box").hasClass('hide')){
                    $('.main-right').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
            });

            $("#kopierapass-box-close").click(function() {
                $("#kopierapass-box").addClass('hide');
            });
            
            $("#btn_slot_split").click(function() {
                $("#Franvaro-box, #kopierapass-box").addClass('hide');
                
                //load slot timefrom - timeto as default
                if($("#slot-dela-pass").hasClass('hide')){
                    var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                    
                    $("#slot-dela-pass #split_slot_timefrom").val(slot_timefrom);
                    $("#slot-dela-pass #split_slot_timeto").val(slot_timeto);
                }
                
                $("#slot-dela-pass").toggleClass('hide');
                if(!$("#slot-dela-pass").hasClass('hide')){
                    $('.main-right').animate({
                        scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                    });
                }
            });
            
            $("#slot-dela-pass-close").click(function() {
                $("#slot-dela-pass").addClass('hide');
            });
            
            //for loading available employees for Personal meeting
            $(document).off('dblclick', "#slot_details_main_wraper_group .slot-icons-day.can_change .slot-icon")
                .on('dblclick', "#slot_details_main_wraper_group .slot-icons-day.can_change .slot-icon", function() {
                //get available employees for PM
                if($(this).attr('data-value') == 10){
                    load_pm_special_employees();
                } else 
                    $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');
            });
        });
        
        function load_pm_special_employees_confirm_type(){
            var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
            if(slot_type == 10){
                load_pm_special_employees();
            } else 
                $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');
        }
        
        function load_pm_special_employees(){
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
            var timefrom        = time_to_sixty($('#slot_details_main_wraper_group #sdTFrom').val());
            var timeto          = time_to_sixty($('#slot_details_main_wraper_group #sdTTo').val());
            if(timeto == 0) timeto = 24;
            
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_PM.php",
                type:"POST",
                dataType: 'json',
                data: { 'slot_id': slot_id, 'slot_date': slot_date, 'time_from': timefrom, 'time_to': timeto},
                success:function(data){
                    //console.log(data);
                    $('#slot_details_main_wraper_group #PM-special-empls').removeClass('hide');
                    $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails').html('');
                    $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails').html('');
                    if(data.available_employees.length > 0){
                        $.each(data.available_employees, function(i, value) {
                            $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails').append('<input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="'+value.username+'">'+value.name+'<br>');
                        });
                    }
                    if(data.unavailable_employees.length > 0){
                        $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails-div').removeClass('hide');
                        $.each(data.unavailable_employees, function(i, value) {
                            $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails').append(value.last_name+ ' ' + value.first_name +'<br>');
                        });
                    }else
                        $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails-div').addClass('hide');

                }
            }).always(function(data) {
                //uwrapLoader('#slot_details_main_wraper_group');
            });
        }
        
        function reload_content(data_values){
            var passing_data_object = { };
            if(typeof data_values !== 'undefined')
                passing_data_object = data_values;
            
            navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1, passing_data_object);
        }
        
        function load_avail_emps_within_period(this_obj){
        
            var slot_id = $('#slot_details_main_wraper_group #sdID').val();

            var slot_date = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_customer_id = $('#slot_details_main_wraper_group #sdCustomerID').val();
            //var slot_employee_id = $('#slot_details_main_wraper_group #sdEmployee').val();
            var slot_employee_id = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

            var slot_details_obj = { 'slot_id': slot_id,
                                'slot_date': slot_date,
                                'slot_timefrom': slot_timefrom,
                                'slot_time_to': slot_time_to,
                                'slot_customer_id': slot_customer_id,
                                'slot_employee_id': slot_employee_id};
            load_avail_emps_for_slot(slot_details_obj, this_obj);
        }
        
        function load_avail_emps_for_slot(slot_details_obj, this_obj){
        
            var slot_id = slot_details_obj.slot_id;
            var slot_date = slot_details_obj.slot_date;
            var slot_timefrom = slot_details_obj.slot_timefrom;
            var slot_time_to = slot_details_obj.slot_time_to;
            var slot_customer_id = slot_details_obj.slot_customer_id;
            var slot_employee_id = slot_details_obj.slot_employee_id;
            
            $('#slot_details_main_wraper_group #sdEmployee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
</option>');  //employee
            
            //get available employees for this time period
            if(slot_timefrom != '' && slot_time_to != '' && slot_customer_id != '' && slot_date != ''){
                var slot_from = time_to_sixty(slot_timefrom);
                var slot_to = time_to_sixty(slot_time_to);
                if(slot_to == 0) slot_to = 24;

                //get all other slot details
                var main_obj = { 'selected_date': slot_date,
                                'selected_customer': slot_customer_id,
                                'current_slot_id': slot_id,
                                'action': 'change_slot_employees',
                                'current_slot': { 'time_from': slot_from, 'time_to': slot_to }};


                //wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_a_period.php",
                    type:"POST",
                    dataType: 'json',
                    data: main_obj,
                    success:function(data){
                        //console.log(data);
                        $('#slot_details_main_wraper_group #sdEmployee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
</option>');  //employee
                        $.each(data, function(i, value) {
                            $('#slot_details_main_wraper_group #sdEmployee').append($('<option '+(value.username == slot_employee_id ? ' selected="selected"' : '')+'>').text(value.ordered_name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                        });
                    }
                }).always(function(data) { 
                    //uwrapLoader('#slot_details_main_wraper_group');
                    /*if($(this_obj).attr('id') == 'slot_details_date')
                        $('#slot_details_main_wraper_group #sdTFrom').focus();
                    else
                        $(this_obj).focus();*/
                });
            }
            if($(this_obj).attr('id') == 'slot_details_date')
                $('#slot_details_main_wraper_group #sdTFrom').focus();
            else
                $(this_obj).focus();
        }
        
        function modify_slot_details(){
            var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom   = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to    = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_employee_id= $('#slot_details_main_wraper_group #sdEmployee').val();
            var old_employee_id   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

            var proceed_flag = true;
            if(slot_date == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){  });
                proceed_flag = false;
                return false;
            }else if(slot_timefrom == '' || slot_time_to == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['incomplete_slot_times'];?>
', function(result){  });
                proceed_flag = false;
                return false;
            } 
            // else if(old_employee_id != '' && slot_employee_id == ''){
            //     bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_reset_previous_employee'];?>
', [{
            //                                                     "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
            //                                                     "class" : "btn-danger"
            //                                                 }, {
            //                                                     "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
            //                                                     "class" : "btn-success",
            //                                                     "callback": function() {
            //                                                         modify_slot_details_confirm();
            //                                                     }
            //                                             }]);
            // } 
            else {
                modify_slot_details_confirm();
            }
        }
        
        function modify_slot_details_confirm(){
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom   = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to    = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_customer_id= $('#slot_details_main_wraper_group #sdCustomerID').val();
            var slot_employee_id= $('#slot_details_main_wraper_group #sdEmployee').val();
            var slot_fkkn       = $('#slot_details_main_wraper_group #sdFKKN').val();
            var slot_comment    = $('#slot_details_main_wraper_group #sdComment').val();
            var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
            
            var old_employee_id = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            var old_time_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
            var old_time_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
            
            slot_timefrom = time_to_sixty(slot_timefrom);
            slot_time_to = time_to_sixty(slot_time_to);
            if(slot_time_to == 0) slot_time_to = 24;
            
            var slot_details_obj = { 'slot_id': slot_id,
                                'slot_date': slot_date,
                                'slot_timefrom': slot_timefrom,
                                'slot_time_to': slot_time_to,
                                'slot_customer': slot_customer_id,
                                'slot_employee': slot_employee_id,
                                'slot_type': slot_type,
                                'slot_fkkn': slot_fkkn,
                                'slot_comment': slot_comment,
                                'action': 'modify_slot'
                    };
                    
            if(slot_type == 10){
                var permeeting_emps = $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails input:checkbox:checked[name=PM-special-empl-check]').map(function () {
                        return this.value;
                }).get().join('||');
                slot_details_obj['personal_meeting_emps']= permeeting_emps;
            }
            
            if(slot_employee_id != '' && (slot_employee_id != old_employee_id || slot_timefrom != old_time_from || slot_time_to != old_time_to || (typeof permeeting_emps != "undefined" && permeeting_emps != ''))){
                var url_atl = slot_details_params =  serialize_json_as_url(slot_details_obj);
                var base_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php?';
                check_atl_warning(url_atl, function(this_url){ 
                                                    //navigatePage(this_url,1, main_obj);
                                                    wrapLoader('#slot_details_main_wraper_group');
                                                    $.ajax({
                                                        url:this_url,
                                                        type:"POST",
                                                        data:slot_details_obj,
                                                        success:function(data){
                                                            close_right_panel();
                                                            //reload_content();
                                                            get_day_refresh(slot_details_obj.slot_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            if(slot_timefrom >= slot_time_to){
                                                                var next_day = date('Y-m-d', strtotime('+1 day', strtotime(slot_details_obj.slot_date)));
                                                                get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            }
                                                        }
                                                    }).always(function(data) { 
                                                        uwrapLoader('#slot_details_main_wraper_group');
                                                    });
                                }, base_url);
            }
            else{
                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                        //reload_content();
                        get_day_refresh(slot_details_obj.slot_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                        if(slot_timefrom >= slot_time_to){
                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(slot_details_obj.slot_date)));
                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                        }
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
        }
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
            function acceptCandGSlot(){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_approval_candg'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger"
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                            var textarea_value = $("#slot_details_main_wraper_group #sdComment").val();
                             $.ajax({ 
                                async:true,
                                cache: true,
                                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                                data: 'id='+slot_id+'&action=slot_approve_candg_new&comment_text='+textarea_value,
                                type:"POST",
                                success:function(data){
                                    if(data == 'sucess'){
                                        close_right_panel();
                                        reload_content();
                                    }
                                }
                            });
                        }
                }]);
             }
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
            function clone_relation_leave_slot(){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_clone_leave_relation'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger"
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                            var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action.php?customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&week_num=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&req_from=gd_customer&slotid='+slot_id+'&action=clone_leaveslot';
                            navigatePage(url, 1);
                        }
                }]);
             }
        <?php }?>
    </script>
    

    <script>
        <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_approval']==1||$_smarty_tpl->tpl_vars['privileges_mc']->value['leave_rejection']==1){?>
            function update_leave_status(flag){
                //flag == 1 -> accept, flag == 2 -> reject
                var delete_flag;
                if (flag == 1){
                    bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_approve_leave'];?>
', [
                    {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger",
                        
                    },
                     {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            update_leave_status_proceed(flag);
                        }
                     }
                     
                ]); 
                }
                else if (flag == 2){
                    bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_reset_substitute_slots'];?>
', [
                    {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
",
                        "class" : "btn-primary",
                    },
                    {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger",
                        "callback": function() {
                            delete_flag = 0;
                            update_leave_status_proceed(flag,delete_flag);
                        }
                        
                     },
                     {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            delete_flag = 1;
                            update_leave_status_proceed(flag,delete_flag);
                        }
                     }
                     
                    ]);
                }
                
            }
            function update_leave_status_proceed(flag,delete_flag = undefined){
                var slot_leave_status   = $('#slot_details_main_wraper_group #this_slot_leave_status').val();
                if(slot_leave_status != '0') //check already treated leave
                    return false;

                var slot_leave_id         = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
                var process_details_obj = { 'id': slot_leave_id,
                                            'status': flag};

                var process_flag = (flag == 1 || flag == 2 ? true : false);

                if(flag == 2){ //reject operation

                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_leave_time_from    = $('#slot_details_main_wraper_group #this_slot_leave_time_from').val();
                    var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();

                    process_details_obj.employee= slot_employee;
                    process_details_obj.date    = slot_date;
                    process_details_obj.t_from  = slot_leave_time_from;
                    process_details_obj.t_to    = slot_leave_time_to;

                    process_details_obj.vikarie_delete    = delete_flag;
                }
                if(process_flag){
                    wrapLoader("#main_content #external_wrapper");
                    $.ajax({
                        async:false,
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_gdschema_alloc_update_leave_status.php",
                        data:process_details_obj,
                        type:"POST",
                        success:function(data){
                                    reload_content();
                                }
                    }).always(function(data) { 
                        uwrapLoader("#main_content #external_wrapper");
                    });
                }
            }
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['privileges_mc']->value['leave_edit']==1){?>
            function cancel_leave_slot(this_obj){
                //return false;
                //{ "action": "leave_slot_remove", "leave_id": "'+value.id+'", "gid": "'+value.gid+'", "slot_id": "'+day_slot.id+'", "employee": "'+day_slot.employee+'", "date": "'+value.leave_date+'", "tfrom": "'+day_slot.time_from+'", "tto": "'+day_slot.time_to+'"}
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_time_from  = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                var slot_time_to    = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                
                var splitted_slot_start_time = slot_time_from.split('.');

                var today_date_time = strtotime('<?php echo $_smarty_tpl->tpl_vars['today_date']->value;?>
 00:00:00'+ ' -90 days');
                var slot_start_date_time = strtotime(slot_date+" "+splitted_slot_start_time[0]+":"+splitted_slot_start_time[1]+":00");
                var minute_diff = Math.round((today_date_time - slot_start_date_time) / 60);
                var is_past_slot = minute_diff > 0 ? true : false;

                if(is_past_slot){
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['date_is_passed_cant_cancel_leave'];?>
', function(result){  });
                }
                else{
                    bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_cancel_leave'];?>
', [{
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                            "class" : "btn-danger"
                        }, {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                            "class" : "btn-success",
                            "callback": function() {
                                var slot_leave_id           = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
                                var slot_leave_group_id     = $('#slot_details_main_wraper_group #this_slot_leave_group_id').val();
                                var slot_leave_time_from    = $('#slot_details_main_wraper_group #this_slot_leave_time_from').val();
                                var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();
                                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                                var slot_time_from  = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                                var slot_time_to    = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                                var process_details_obj = { 'action': 'leave_slot_remove',
                                                        'leave_id': slot_leave_id,
                                                        'gid': slot_leave_group_id,
                                                        'slot_id': slot_id,
                                                        'employee': slot_employee,
                                                        'date': slot_date,
                                                        'tfrom': slot_time_from,
                                                        'tto': slot_time_to };

                                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_reset_substitute_slots'];?>
 <br/><br/><?php echo $_smarty_tpl->tpl_vars['translate']->value['note_shortcode'];?>
 <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove'],"'","\'");?>
<br/><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove_2'],"'","\'");?>
<br/><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['translate']->value['date_passed_substitute_slots_cant_remove_3'],"'","\'");?>
', [{
                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
",
                                    "class" : "btn-primary"
                                }, {
                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_leave_substitute_reset_no'];?>
",
                                    "class" : "btn-danger",
                                    "callback": function() {
                                        process_details_obj.vikarie_delete = '0';
                                        cancel_leave_slot_confirm(process_details_obj)
                                    }
                                }, {
                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['btn_leave_substitute_reset_yes'];?>
",
                                    "class" : "btn-success",
                                    "callback": function() {
                                        process_details_obj.vikarie_delete = '1';
                                        cancel_leave_slot_confirm(process_details_obj)
                                    }
                                }]);
                        }
                    }]);
                }
            }
            
            function cancel_leave_slot_confirm(process_details_obj){
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                    async:false,
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
mc_leave_popup.php",
                    data:process_details_obj,
                    dataType: 'json',
                    type:"POST",
                    success:function(data_process){
                                if(data_process.process_result){    //excute if successfully done transactions
                                    reload_content();
                                } else if(typeof data_process.message !== "undefined" && data_process.message != '' && data_process.message != null) {
                                    $('#left_message_wraper').html(data_process.message).removeClass('hide');
                                    $('.main-left').animate({
                                        scrollTop: 0
                                    });
                                } else {
                                    reload_content();
                                }
                            }
                }).always(function(data) { 
                    uwrapLoader("#main_content #external_wrapper");
                });
            }
            
            function edit_leave_slot(){
                $("#slot_details_main_wraper_group #leave_edit_wrpr").toggleClass('hide');
                var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();
                $("#slot_details_main_wraper_group #unsick_time_from").val(slot_leave_time_to);
            }
            
            function edit_leave_slotConfirm(){
                var toval = parseFloat($('#leave_edit_wrpr #unsick_time_from').val());
                if(toval == 0 || toval == 24 ){
                    alert('Enter Time except 0 & 24');
                }else if($('#leave_edit_wrpr #unsick_time_from').val() != ''){
                    bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_back_to_work'];?>
', [{
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                            "class" : "btn-danger"
                        }, {
                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                            "class" : "btn-success",
                            "callback": function() {
                                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                                var leave_id        = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
                                var leave_employee  = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                                var leave_date      = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                                var leave_time_from = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                                var leave_time_to   = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                                var process_details_obj = { 'slotid': slot_id,
                                                'id': leave_id,
                                                'employee': leave_employee,
                                                'date': leave_date,
                                                't_from': leave_time_from,
                                                't_to': leave_time_to,
                                                'status': '-1',
                                                'edited_from': $('#leave_edit_wrpr #unsick_time_from').val()};
                                //console.log(process_details_obj);
                                wrapLoader("#main_content #external_wrapper");
                                $.ajax({
                                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_gdschema_alloc_update_leave_status.php",
                                    type:"POST",
                                    //dataType: "json",
                                    data:process_details_obj,
                                    success:function(data){
                                            reload_content();
                                    },
                                    error: function (xhr, ajaxOptions, thrownError){
                                        alert(thrownError);
                                    }
                                }).always(function(data) {
                                    uwrapLoader("#main_content #external_wrapper");
                                });
                            }
                    }]);
                }else{
                    alert('Please Enter Time');
                    $('#leave_edit_wrpr #unsick_time_from').focus();
                }
            }
        <?php }?>
    
        function setLeaveTypeSingleSlot(val) {
            $('#Franvaro-box #leave_type_valSingleSlot').val(val);
            
            check_is_karense_day();
            if(val == 1)
                $('#Franvaro-box .no_pay_sick_check_divSingleSlot').removeClass('hide');
            else
                $('#Franvaro-box .no_pay_sick_check_divSingleSlot').addClass('hide');
        }
        
        function check_is_karense_day(){
            var leave_type          = $('#Franvaro-box #leave_type_valSingleSlot').val();
            var no_pay_check_value  = 0;
            if(leave_type == 1){
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var employee        = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                var leave_type_day  = $('#Franvaro-box #leave_type_daySingleSlot').val();
                var leave_date      = '';
                var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_day' : leave_type_day };

                
                if (leave_type_day == '1') {
                    leave_date = $('#Franvaro-box #leave_date_fromSingleSlot').val();

                    url_data_obj['date'] = leave_date;
                    url_data_obj['leave_taken_beween'] = 'dates';

                    var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                    if(no_pay_check) no_pay_check_value = 1;

                }
                else if (leave_type_day == '2') { 
                    leave_date          = $('#Franvaro-box #leave_date_daySingleSlot').val();
                    var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                    var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                    url_data_obj['date'] = leave_date;
                    url_data_obj['leave_taken_beween'] = 'time';
                    url_data_obj['leave_time_from'] = leave_time_from;
                    url_data_obj['leave_time_to'] = leave_time_to;

                    var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                    if(no_pay_check) no_pay_check_value = 1;
                }
                
                url_data_obj['slot_type'] = $("#sdTypes li").filter('.active').attr('data-value');
                url_data_obj['time_from'] = $("#sdTFrom").val();
                
                $.ajax({
                    url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_karense_exist.php",
                    type: "POST",
                    dataType: 'json',
                    data: $.param(url_data_obj),
                    success:function(data){
                        $('#karense_notify').html('');
                        if(data.transaction == true){
                            /*if(data.karense == true){
                                if(no_pay_check_value == 1){
                                    $('#karense_notify').hide().html('<div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense_included'];?>
</div>').fadeIn('slow');
                                }
                                else{
                                    $('#karense_notify').hide().html('<div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense_not_included'];?>
</div>').fadeIn('slow');
                                }
                                $('.no_pay_sick_check_divSingleSlot').show();
                            } else{
                                $('#karense_notify').hide().html('<div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense_not_possible'];?>
 '+data.karense_date+'</div>').fadeIn('slow');
                                $('.no_pay_sick_check_divSingleSlot').hide();
                                
                            }*/
                            if(typeof data.karense != "undefined" && data.karense !== false && typeof data.karense.karens != "undefined" && data.karense.karens > 0){
                                $('#karense_notify').hide().html('<div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['total_karense_deduction'];?>
: '+data.karense.deduction+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['hour_short'];?>
<br/><?php echo $_smarty_tpl->tpl_vars['translate']->value['deduction_sick_day'];?>
: '+data.karense.karens+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['hour_short'];?>
('+data.karense.remaining+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['hour_short'];?>
)</div>').fadeIn('slow');
                                $('#date_no_pay_sick_check, #time_no_pay_sick_check').prop('checked', false);
                            }
                            else{
                                $('#karense_notify').hide().html('<div class="message"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_karense_deduction'];?>
</div>').fadeIn('slow');
                            }
                        } else{
                            $('#karense_notify').html('');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        //alert(thrownError);
                    }
                });
            } else
                $('#karense_notify').html('');

        }
        
        function leaveTabSingleSlot(tab){
                if (tab == 'time') {
                    $('#Franvaro-box #leave_type_daySingleSlot').val(2);
                    check_is_karense_day();
                } else {
                    $('#Franvaro-box #leave_type_daySingleSlot').val(1);
                    check_is_karense_day();
                }
        }
        
        function manageConf(type){
            if(type == 'time'){
                if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', 'disabled');
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').prop('checked', false);
                    $('#Franvaro-box input:checkbox[name=chk_sender]').prop('checked', true);
                }else
                    $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', false);
            }
            else if(type == 'date'){
                if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', 'disabled');
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').prop('checked', false);
                    $('#Franvaro-box input:checkbox[name=chk_sender_date]').prop('checked', true);
                }else
                    $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', false);
            }
        }
        
        <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
            function load_replacement_employees(action){
                var leave_type_day  = $.trim($('#leave_type_daySingleSlot').val());
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                
                if(typeof action !== "undefined" && action == 'get_for_2_modes'){
                    wrapLoader("#leave_date_replacement_emps");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_available_users_for_leave_replacement.php",
                        type:"POST",
                        dataType: "json",
                        data:'id='+slot_id+'&leave_format=&action=get_avail_emps_for_2_methods',
                        success:function(data){
                                        
                                    //set for date period users
                                    $('#replace_employees_list_date').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>');
                                    $('.replace_employees_list_date_sms').html('');
                                    $.each(data.date_users, function(i, value) {
                                        $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                        $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                    });
                                    
                                    //set for timeperiod users
                                    $('#replace_employees_list_time').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>');
                                    $('.replace_employees_list_sms').html('');
                                    $.each(data.time_users, function(i, value) {
                                        $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                        $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                    });
                                },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) {
                        uwrapLoader("#leave_date_replacement_emps");
                    });
                }
                else if(leave_type_day == 2){
                    var leave_date_day  = $.trim($('#Franvaro-box #leave_date_daySingleSlot').val());
                    var leave_time_from = time_to_sixty($.trim($('#Franvaro-box #leave_time_from').val()));
                    var leave_time_to   = time_to_sixty($.trim($('#Franvaro-box #leave_time_to').val()));
                    if(leave_time_to == 0) leave_time_to = 24;
                    if(slot_id != '' && leave_time_from != '' && leave_time_to != '' && leave_date_day != ''){
                        wrapLoader("#leave_time_replacement_emps");
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_available_users_for_leave_replacement.php",
                            type:"POST",
                            dataType: "json",
                            data:'date='+leave_date_day+'&time_from='+leave_time_from+'&time_to='+leave_time_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                            success:function(data){
                                        $('#replace_employees_list_time').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>');
                                        $('.replace_employees_list_sms').html('');
                                        $.each(data, function(i, value) {
                                            //rep_list_options += '<option value="'+value.username+'">'+value.name+'</option>';
                                            $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                            $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                        });
                                    },
                            error: function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
                            }
                        }).always(function(data) {
                            uwrapLoader("#leave_time_replacement_emps");
                        });
                    }
                } 
                else if(leave_type_day == 1){
                    var leave_date_from = $.trim($('#Franvaro-box #leave_date_fromSingleSlot').val());
                    var leave_date_to   = $.trim($('#Franvaro-box #leave_date_toSingleSlot').val());
                    var date1 = NewDate(leave_date_from)
                    var date2 = NewDate(leave_date_to);
                    if (date1 > date2) 
                        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_the_from_and_to_date'];?>
');
                    else if(slot_id != '' && leave_date_from != '' && leave_date_to != ''){
                        wrapLoader("#leave_date_replacement_emps");
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_available_users_for_leave_replacement.php",
                            type:"POST",
                            dataType: "json",
                            data:'date_from='+leave_date_from+'&date_to='+leave_date_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                            success:function(data){
                                        $('#replace_employees_list_date').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['none'];?>
</option>');
                                        $('.replace_employees_list_date_sms').html('');
                                        $.each(data, function(i, value) {
                                            $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                            $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                                        });
                                    },
                            error: function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
                            }
                        }).always(function(data) {
                            uwrapLoader("#leave_date_replacement_emps");
                        });
                    }
                }
            }
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1){?>
            function saveLeaveSingleSlot(){
                 var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
                 var slot_type   = $('#slot_details_main_wraper_group #this_slot_actual_type').val();
                 var employee    = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                 var leave_approve_on_apply = $('#leave_approve_on_apply').is(":checked") === true ? 1 : 0 ; 
                
                if(slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17){
                    var leave_type = $('#Franvaro-box #leave_type_valSingleSlot').val();
                    if (leave_type != '') {
                        var leave_date_from = $('#Franvaro-box #leave_date_fromSingleSlot').val();
                        var leave_date_to   = $('#Franvaro-box #leave_date_toSingleSlot').val();
                        var leave_type_day  = $('#Franvaro-box #leave_type_daySingleSlot').val();
                        var leave_comments  = $('#Franvaro-box #leave_comments').val();
                        var no_pay_check_value = 0;
                        var sms_emps = [ ];
                        var need_sms = false;

                        var opt_sms_conformation = 0;
                        var opt_sms_sender = 0;
                        var opt_sms_rejection = 0;

                        
                        if (leave_type_day == '1') {
                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                var rep_emp = $('#Franvaro-box .replace_employees_list_date[name=rep_date_employees]').val();
                                if(typeof rep_emp == 'undefined') rep_emp = '';

                                need_sms = $('#Franvaro-box #send_sms_date').prop('checked');
                                if(need_sms){
                                    sms_emps = $('#Franvaro-box .replace_employees_list_date_sms').val();

                                    if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                                        opt_sms_conformation = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                    }    
                                    else {
                                        if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_rejection_date]:checked').prop('checked'))
                                            opt_sms_rejection = 1;    
                                    }
                                }
                            <?php }else{ ?>
                                var rep_emp = '';
                            <?php }?>

                            if (leave_date_from != '' && leave_date_to != '') {
                                var date1 = NewDate(leave_date_from);
                                var date2 = NewDate(leave_date_to);
                                if (date1 <= date2) {

                                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['no_pay_leave']==1){?>
                                        var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                                        if(no_pay_check) no_pay_check_value = 1;
                                    <?php }else{ ?>
                                        no_pay_check_value = 1;
                                    <?php }?>

                                    var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'date_from': leave_date_from, 'date_to': leave_date_to, 'leave_type': leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                            'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                                
                                    wrapLoader('#slot_details_main_wraper_group');
                                    $.ajax({
                                        url: '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
save_leave.php',
                                        type:"POST",
                                        data: $.param(url_data_obj),
                                        success:function(data){
                                            //console.log(data);
                                            close_right_panel();
                                            reload_content();
                                        }
                                    }).always(function(data) { 
                                        uwrapLoader('#slot_details_main_wraper_group');
                                    });
                                } else
                                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_the_from_and_to_date'];?>
');
                            }else
                                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_the_from_and_to_date'];?>
');
                        } else if (leave_type_day == '2') { 
                            var leave_date_day  = $('#Franvaro-box #leave_date_daySingleSlot').val();
                            var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                            var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['no_pay_leave']==1){?>
                                var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                                if(no_pay_check) no_pay_check_value = 1;
                            <?php }else{ ?>
                                no_pay_check_value = 1;
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                                if(typeof rep_emp == 'undefined') rep_emp = '';

                                need_sms = $('#Franvaro-box #send_sms_time').prop('checked');
                                if(need_sms){
                                    sms_emps = $('#Franvaro-box .replace_employees_list_sms').val();

                                    if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                                        opt_sms_conformation = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                    }    
                                    else {
                                        if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                            opt_sms_sender = 1;
                                        if($('#Franvaro-box input:checkbox[name=chk_rejection]:checked').prop('checked'))
                                            opt_sms_rejection = 1;    
                                    }
                                }
                            <?php }else{ ?>
                                var rep_emp = '';
                            <?php }?>
                            var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                            if(typeof rep_emp == 'undefined') rep_emp = '';
                            if (leave_date_day != '') {
                                var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_date': leave_date_day, 'leave_range_from': leave_time_from, 'leave_range_to': leave_time_to, 'leave_type' : leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                        'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                                        
                                wrapLoader('#slot_details_main_wraper_group');
                                $.ajax({
                                    url: '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
save_leave.php',
                                    type:"POST",
                                    data: $.param(url_data_obj),
                                    success:function(data){
                                        //console.log(data);
                                        close_right_panel();
                                        reload_content();
                                    }
                                }).always(function(data) { 
                                    uwrapLoader('#slot_details_main_wraper_group');
                                });
                            } else
                                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
');
                        }
                    } else
                        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_a_leave_type'];?>
');
                }
            }
        <?php }?>
    
        $(document).ready(function() {
            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                $('#Franvaro-box #leave_date_fromSingleSlot, #Franvaro-box #leave_date_toSingleSlot, #Franvaro-box #leave_date_daySingleSlot').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
                .on('changeDate', function(ev){
                  load_replacement_employees();
                });

                $( "#Franvaro-box #leave_time_from, #Franvaro-box #leave_time_to" ).keyup(function(){
                    load_replacement_employees();
                });
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['no_pay_leave']==1){?>
                $('#time_no_pay_sick_check, #date_no_pay_sick_check').click(function(){
                    if($(this).is(':checked')){
                        var kerense_employee = $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val();
                        $(this).parents('.no_pay_sick_check_divSingleSlot').find('span').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
 - '+kerense_employee).css('color', 'red');
                        $("#karense_notify").hide();
                        $("#karense_notify1").show();

                    }else{
                        //$(this).parents('.no_pay_sick_check_divSingleSlot').find('span').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_karense'];?>
').css('color', '');
                        $("#karense_notify").show();
                        $("#karense_notify1").hide();
                    }
                });
            <?php }?>
        
            $('#Franvaro-box #send_sms_time').click(function(){
                    if($(this).is(':checked')){
                        $('#Franvaro-box #time_replacer_sms_tbl').removeClass('hide');
                        $('#Franvaro-box #time_replacer_nosms_tbl').addClass('hide');
                    }else{
                        $('#Franvaro-box #time_replacer_sms_tbl').addClass('hide');
                        $('#Franvaro-box #time_replacer_nosms_tbl').removeClass('hide');
                    }
            });
            $('#Franvaro-box #send_sms_date').click(function(){
                    if($(this).is(':checked')){
                        $('#Franvaro-box #date_replacer_sms_tbl').removeClass('hide');
                        $('#Franvaro-box #date_replacer_nosms_tbl').addClass('hide');
                    }else{
                        $('#Franvaro-box #date_replacer_sms_tbl').addClass('hide');
                        $('#Franvaro-box #date_replacer_nosms_tbl').removeClass('hide');
                    }
            });

            $('#leave_date_daySingleSlot, #leave_date_fromSingleSlot, #leave_date_toSingleSlot').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
            .on('changeDate', function(ev){
              check_is_karense_day();
            });
        });
    </script>
    

    <script>
        function makeInterestIn(){
            var ids_temp = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check').map(function () {
                return this.value;
            }).get();
            var ids = ids_temp.join('-');
            $('#slot_details_main_wraper_group #sdID').val(ids);
            var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
            var process_details_obj = { 
                'id': slot_id,
                'action'    : 'interestedin'
            };
            wrapLoader('#slot_details_main_wraper_group');
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                type:"POST",
                data:process_details_obj,
                success:function(data){
                    //console.log(data);
                    reload_content();
                }
            }).always(function(data) { 
                uwrapLoader('#slot_details_main_wraper_group');
            });
        }
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
            function splitSlot(){
                //var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
                //var type = url_obj.type;
                var new_tfrom   = $("#slot-dela-pass #split_slot_timefrom").val();
                var new_tto     = $("#slot-dela-pass #split_slot_timeto").val();
                if(new_tfrom != '' && new_tto != ''){
                
                    var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                    
                    if(slot_id.includes('-')) {
                        var process_details_obj = { 'id': slot_id,
                            'slot_from' : slot_from,
                            'slot_to'   : slot_to,
                            'time_from' : new_tfrom,
                            'time_to'   : new_tto,
                            'action'    : 'splitmultiple'
                        };
                    } else {
                        var process_details_obj = { 'id': slot_id,
                            'slot_from' : slot_from,
                            'slot_to'   : slot_to,
                            'time_from' : new_tfrom,
                            'time_to'   : new_tto,
                            'action'    : 'split'
                        };
                    }
                    
                    wrapLoader('#slot_details_main_wraper_group');
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                        type:"POST",
                        data:process_details_obj,
                        success:function(data){
                            //console.log(data);
                            close_right_panel();
                            reload_content();
                        }
                    }).always(function(data) { 
                        uwrapLoader('#slot_details_main_wraper_group');
                    });
                }else
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_enter_time'];?>
');
            }
        <?php }?>
        
        function getAfterDates_for_slotcopy_multiple(){
            var max_week_number = 52;
            var year_week   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var cur_slot_year_of_week = date('o',strtotime(year_week));
            var year = parseInt(cur_slot_year_of_week, 10);
            var to_week = parseInt($("#kopierapass-box #slot_copy_multiple_from_wk").val()) + (parseInt($("#kopierapass-box #slot_copy_multiple_from_option").val()));
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('#kopierapass-box #slot_copy_multiple_to_wk').find('option').remove();
            for (var i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#kopierapass-box #slot_copy_multiple_to_wk");
                to_week = to_week + 1;
            }
        }
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot_option']==1){?>
            function save_copySingleSlot(){
                var with_user = 1;
                var days = $('#kopierapass-box #frm_copySingleSlot input[name=slot_copy_multiple_days]:checkbox:checked').map(function () {
                                return this.value;
                }).get().join('-');
                
                if(days == '')
                    alert('select days');
                else{
                    days += '-';    //to remove last value after '-' in php
                    if($('#kopierapass-box #slot_copy_multiple_withoutuser').attr("checked") == "checked")
                        with_user = 0;
                    
                    var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    
                    var from_week   = $("#kopierapass-box #slot_copy_multiple_from_wk").val();
                    var from_option = $("#kopierapass-box #slot_copy_multiple_from_option").val();
                    var to_week     = $("#kopierapass-box #slot_copy_multiple_to_wk").val();
                    
                    var additional_urldata = 'customer='+slot_customer+'&employee='+slot_employee+'&date='+slot_date+
                            '&from_week='+from_week+'&from_option='+from_option+'&to_week='+to_week+'&id='+slot_id+
                            '&days='+days+'&with_user='+with_user+'&action=copy_multiple&user=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
';
                    //console.log(additional_urldata);
                    
                    if(with_user == 1){
                        var atl_req_data = additional_urldata + '&to_single_slot=TRUE&type_check=11';
                        var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php?' + additional_urldata;
                        check_atl_warning(atl_req_data, function(this_url){
                                            wrapLoader('#slot_details_main_wraper_group');
                                            $('#div_alloc_action').load(this_url, function(response, status, xhr){ uwrapLoader('#slot_details_main_wraper_group'); reload_content(); });
                                        }, process_url, '#slot_details_main_wraper_group');
                    }else{
                        wrapLoader('#slot_details_main_wraper_group');
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                            type:"POST",
                            data:additional_urldata,
                            success:function(data){
                                close_right_panel();
                                reload_content();
                            }
                        }).always(function(data) { 
                            uwrapLoader('#slot_details_main_wraper_group');
                        });
                    }
                }
            }
        <?php }?>
    
        function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){

                <?php if ($_smarty_tpl->tpl_vars['company_contract_checking_flag']->value==1||$_smarty_tpl->tpl_vars['company_atl_checking_flag']->value==1){?>    
                    if(typeof animation_element !== "undefined")
                        wrapLoader(animation_element);
                    else 
                        wrapLoader("#external_wrapper");

                    $.ajax({
                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_atl_and_contract.php",
                        type: "POST",
                        data: check_url_data,
                        dataType: "json",
                        success:function(data){
                            <?php if ($_smarty_tpl->tpl_vars['company_atl_checking_flag']->value==1){?>
                                if(data.atl == 'success'){
                                    <?php if ($_smarty_tpl->tpl_vars['company_contract_checking_flag']->value==0){?>  /*not checking contract*/
                                        _fn_success_call_back(_call_back_data);
                                    <?php }else{ ?>  /*checking contract*/
                                        if(data.contract == 'success'){
                                            _fn_success_call_back(_call_back_data);
                                        }else{
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['contract_override']==1){?>
                                                bootbox.dialog( data.contract_params.error_msg, [{
                                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                        "class" : "btn-danger"
                                                    }, {
                                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                        "class" : "btn-success",
                                                        "callback": function() {
                                                            _fn_success_call_back(_call_back_data);
                                                        }
                                                }]);
                                            <?php }else{ ?>
                                                bootbox.alert(data.contract_params.error_msg, function(result){ });
                                            <?php }?>
                                        }
                                    <?php }?>
                                }
                                else{
                                    _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['atl_override']==1){?>
                                        bootbox.dialog( data.atl + ".<br/><br/><?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_continue'];?>
", [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    <?php if ($_smarty_tpl->tpl_vars['company_contract_checking_flag']->value==0){?>  /*not checking contract*/
                                                        _fn_success_call_back(_call_back_data);
                                                    <?php }else{ ?>
                                                        if(data.contract == 'success'){
                                                             _fn_success_call_back(_call_back_data);
                                                        }else{
                                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['contract_override']==1){?>
                                                                bootbox.dialog( data.contract_params.error_msg, [{
                                                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                                        "class" : "btn-danger"
                                                                    }, {
                                                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                                        "class" : "btn-success",
                                                                        "callback": function() {
                                                                            _fn_success_call_back(_call_back_data);
                                                                        }
                                                                }]);
                                                            <?php }else{ ?>
                                                                bootbox.alert(data.contract_params.error_msg, function(result){ });
                                                            <?php }?>
                                                        }
                                                    <?php }?>
                                                }
                                        }]);
                                    <?php }else{ ?> 
                                        bootbox.alert(data.atl, function(result){ });
                                    <?php }?>
                                }
                            <?php }elseif($_smarty_tpl->tpl_vars['company_contract_checking_flag']->value==1){?>
                                if(data.contract == 'success'){
                                    _fn_success_call_back(_call_back_data);
                                }else{
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['contract_override']==1){?>
                                        bootbox.dialog( data.contract_params.error_msg, [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    _fn_success_call_back(_call_back_data);
                                                }
                                        }]);
                                    <?php }else{ ?>
                                        bootbox.alert(data.contract_params.error_msg, function(result){ });
                                    <?php }?>
                                }
                            <?php }?>
                         },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                     })
                     .always(function(data) {
                        if(typeof animation_element !== "undefined")
                            uwrapLoader(animation_element);
                        else 
                            uwrapLoader("#external_wrapper");
                    });
                <?php }else{ ?>
                    _fn_success_call_back(_call_back_data);
                <?php }?>
        }

        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['copy_single_slot']==1){?>
            function copy_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'copy'
                    };

                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
        <?php }?>
    
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['swap']==1){?>
            function swap_copy_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'swap'
                    };

                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_group');
                });
            }
            
            function swap_past_single_slot(){
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

                /*var slot_details_obj = { 'id': slot_id,
                                'date': slot_date,
                                'customer': slot_customer,
                                'action': 'swap',
                                'swap': '1'
                    };*/
                    
                var atl_req_data = 'date='+slot_date+'&employee='+slot_employee+'&customer='+slot_customer+
                            '&id='+slot_id+'&action=swap&swap=1&type_check=15';
                    
                var slot_details_obj = 'id='+slot_id+'&date='+slot_date+'&customer='+slot_customer+'&action=swap&swap=1';
                var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php?' + slot_details_obj;
                    
                check_atl_warning(atl_req_data, function(this_url){
                                    wrapLoader('#slot_details_main_wraper_group');
                                    $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader('#slot_details_main_wraper_group'); reload_content(); });
                                }, process_url, '#slot_details_main_wraper_group');
            }
        <?php }?>
    
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
            function delete_single_slot(){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_delete_slot'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger"
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                            var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                            var slot_details_obj = { 'id': slot_id,
                                            'date': slot_date,
                                            'customer': slot_customer,
                                            'action': 'slot_remove'
                                };

                            wrapLoader('#slot_details_main_wraper_group');
                            $.ajax({
                                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                                type:"POST",
                                data:slot_details_obj,
                                success:function(data){
                                    //console.log(data);
                                    close_right_panel();
                                    reload_content();
                                }
                            }).always(function(data) { 
                                uwrapLoader('#slot_details_main_wraper_group');
                            });
                        }
                }]);
            }
        <?php }?>
    </script>
    

    <script>
        function multipleMemorySlotAdd(){

            var time_ranges = $('#slot_creation_main_wraper_group #memory-slots #available_memory_slots li.memory_time input:checkbox:checked').map(function () {
                            return this.value;
            }).get();
            
            var selected_date = $.trim($('#slot_creation_main_wraper_group #memory-slots #memslot_throw_date').val());

            if(time_ranges.length == 0)
                alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_elements_selected'];?>
");
            else if(selected_date == '')
                alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
");
            else{
                var multiple_time = time_ranges.join(',');
                var process_details_obj = { 'date': selected_date,
                            'employee'  : '',
                            'customer'  : '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                            'emp_alloc' : '<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
',
                            'multiple'  : multiple_time,
                            'action'    : 'drag_memory_slots'
                };
                process_drop_time_slot(process_details_obj);
            }
                
        }
        
        function process_drop_time_slot(process_details_obj){
            wrapLoader('#slot_details_main_wraper_group');
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                type:"POST",
                dataType: 'json',
                data:process_details_obj,
                success:function(data_process){
                    //console.log(data_process);
                    if(data_process.result){    //excute if successfully created slot
                        //close_right_panel();
                        //reload_content({ 'show_right_panel': true, 'right_panel': 'memory_slots' });
                        get_day_refresh(process_details_obj.date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
');
                    } else if(typeof data_process.message !== "undefined" && data_process.message != '') {
                        $('#left_message_wraper').html(data_process.message).removeClass('hide');
                        $('.main-left').animate({
                            scrollTop: $('#left_message_wraper').offset().top
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            })
            .always(function(data) {
                uwrapLoader('#slot_details_main_wraper_group');
            });
        }
        
        $(document).ready(function(){
            
            $(document).off('keypress', ".add-new-slots-month #new_slot_date, .add-new-slots-month .slot_from, .add-new-slots-month .slot_to, \n\
            .add-new-slots-month .custom_slot_employee, .add-new-slots-month .custom_slot_fkkn, .add-new-slots-month .comment_textarea")
                .on('keypress', ".add-new-slots-month #new_slot_date, .add-new-slots-month .slot_from, .add-new-slots-month .slot_to, \n\
            .add-new-slots-month .custom_slot_employee, .add-new-slots-month .custom_slot_fkkn, .add-new-slots-month .comment_textarea", function(e) {
                if(e.which == 13) {
                    manEntry();
                }
            });
            
            $('#available_memory_slots li.memory_time .remove-memory-slot').click(function(){
        
                var ms_id = $(this).parents('.memory_time').find('.this_mslot').attr('data-id');
                var this_mem_slot_dom = $(this).parents('.memory_time');
                var process_details_obj = { 'id': ms_id, 'action': 'memory_slot_remove'};

                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        if(data_process.result){    //excute if successfully removed memory slot
                            this_mem_slot_dom.fadeOut('slow', function() { $(this).remove(); });
                        }
                        if(typeof data_process.message !== "undefined" && data_process.message != '') {
                            $('#left_message_wraper').html(data_process.message).removeClass('hide').fadeIn("slow", function() {
                                $('.main-left').animate({
                                    scrollTop: $('#left_message_wraper').offset().top
                                });
                            });
                            
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                });
            });
            
            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                // .child-slots
                $(".memory_time").draggable({ revert: true, appendTo: "#gdweek_wraper", helper: 'clone', 
                            start: function (event, ui) { ui.helper.css({ 'width': '83px', 'z-index': '10', 'list-style': 'none'});} });

                $("#week-slot-calender td.weekly_day").droppable({
                        accept: ".memory_time, .slot-week-draggable",
                        hoverClass: "dropover",
                        drop: function( event, ui ) {
                            //console.log(ui.draggable.attr('class'));
                            var target_day = $(this);

                            //memory slot dragging
                            if(ui.draggable.hasClass('memory_time')){
                                var params      = ui.draggable.find('input[type=checkbox]');

                                var time_from   = parseFloat(params.attr("data-timefrom"));
                                var time_to     = parseFloat(params.attr("data-timeto"));
                                var slot_type   = parseFloat(params.attr("data-type"));
                                var selected_date = target_day.attr('data-date');

                                var process_details_obj = { 'date': selected_date,
                                            'employee'  : '',
                                            'customer'  : '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                            'emp_alloc' : '<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
',
                                            'time_from' : time_from,
                                            'time_to'   : time_to,
                                            'slotType'  : slot_type,
                                            'dnt_show_flag': 0,
                                            'action'    : 'drag_memory_slots'
                                };
                                process_drop_time_slot(process_details_obj);
                            }

                            //slot dragging
                            else if(ui.draggable.hasClass('slot-week-draggable')){
                                var source_slot = ui.draggable;

                                var this_slot_date = source_slot.find('input.slot_details_hub').attr('data-date');
                                var target_date = target_day.attr('data-date');

                                if(this_slot_date != target_date){
                                    //$(ui.draggable).parents('.collapse-slot-2').fadeOut('slow', function() {
                                        /*$(this).remove();
                                        target_day.append( $('<span>').addClass('collapse-slot-2 clearfix').html(source_slot) );
                                        source_slot.fadeIn();*/

                                        var source_data_slot = ui.draggable.attr('data-slot-id');
                                        var target_date = target_day.attr('data-date');

                                        var data_post = 'slot_id='+source_data_slot+'&to_date='+target_date+'&action=drop&week_num=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&pCustomer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&request_from=gd_customer&return_type=json'
                                        //navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php?'+data_post, 1);

                                        $.ajax({
                                                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                                                type:"POST",
                                                dataType: 'json',
                                                data: data_post,
                                                success:function(data){
                                                    //console.log(data);
                                                    if(typeof data.result !== 'undefined' && data.result === true){
                                                        $(this).remove();
                                                        target_day.append( $('<span>').addClass('collapse-slot-2 clearfix').html(source_slot) );
                                                        source_slot.fadeIn();

                                                        get_day_refresh(this_slot_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
');
                                                        get_day_refresh(target_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
');
                                                    }
                                                    if(typeof data.message !== 'undefined'){
                                                        $('#left_message_wraper').html(data.message).delay(10000).html();
                                                    }
                                                }
                                            }).always(function(data) {

                                            });
                                    //});
                                }
                            }
                        }
                });
            <?php }?>
            
            $('#check_created_slot_copy_to_weeks').click(function(){
                    $('#created_slot_copy_to_weeks')[$(this).is(':checked') ? 'removeClass' : 'addClass']('hide');
                    if($(this).is(':checked')){
                        var new_slot_date = $.trim($('.add-new-slots-month #new_slot_date').val());
                        if(new_slot_date != ''){
                            reset_cscm_params(new_slot_date);
                        }
                    }
            });
            
            $('.add-new-slots-month #dtPickerNewSlotDate').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
            .on('changeDate', function(ev){
                if(typeof ev.date != 'undefined' && ev.date != ''){
                    reset_cscm_params($.datepicker.formatDate('yy-mm-dd', ev.date));
                }
            });
        });
        
        function close_slot_template(this_obj){
            $(this_obj).parents('.time_slots_theme').remove();
        }
        
        function popupAddSlotMore(){
            $('.add-new-slots-month .create-slotes-panel').prepend(get_slot_add_theme());
            $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
        }
        
        function get_slot_add_theme(){
            var slot_theme = '<div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:15px !important;">\n\
                                <div class="close_btn_wrpr pull-right"><button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_slot'];?>
" type="button" onclick="close_slot_template(this);"  tabindex="-1">×</button></div>\n\
                                <div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend">\n\
                                        <span class="add-on  icon-time " title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
"></span>\n\
                                        <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text"  style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>\n\
                                        <span class="add-on"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</span>\n\
                                        <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
" type="text"  style="margin-left: -1px;"/>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-group" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
"></span>\n\
                                        <select id="custom_slot_employee" name="custom_slot_employee" class="form-control custom_slot_employee span12">\n\
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>\n\
                                        </select>\n\
                                    </div>\n\
                                </div>';
                                slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-star"></span>\n\
                                        <select class="form-control custom_slot_fkkn span12" name="custom_slot_fkkn">\n\
                                            <option <?php if ($_smarty_tpl->tpl_vars['customer_data']->value['fkkn']==1){?>selected="selected"<?php }?> value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
</option>\n\
                                            <option <?php if ($_smarty_tpl->tpl_vars['customer_data']->value['fkkn']!=1){?>selected="selected"<?php }?> value="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</option>\n\
                                            <option value="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>
</option>\n\
                                        </select>\n\
                                    </div>\n\
                                </div>';
                                slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-comment" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></span>\n\
                                        <textarea id="comment_textarea"  class="comment_textarea form-control span12" rows="1" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['comment'];?>
"></textarea>\n\
                                    </div>\n\
                                </div>\n\
                                <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">\n\
                                    <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value=1 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value=0 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"></li>\n\
                                    <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value=2 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value=3 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value=4 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value=5 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value=6 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value=14 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value=7 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value=8 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value=9 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value=10 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value=11 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value=12 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value=13 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value=15 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value=16 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal'];?>
" style="display: none;"></li>\n\
                                    <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value=17 title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['work_for_dismissal_oncall'];?>
" style="display: none;"></li>\n\
                                </ul>\n\
                            </div>';
                return slot_theme;
        }
        
        function load_avail_emps_within_period_for_new_slot(this_obj){

            /*console.log(this_obj);
            console.log( $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee'));
            return false;*/
            $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>');
            if($.trim($('.add-new-slots-month .slot_date').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()) != ''){
                var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
                var slot_from = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()));
                var slot_to = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()));
                if(slot_to == 0) slot_to = 24;
                var cur_time_slot_theme = $(this_obj).parents('.time_slots_theme');

                //get all other slot details
                var main_obj = { 'selected_date': slot_date,
                                'selected_customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                'action': 'multiple_add',
                                'current_slot': { 'time_from': slot_from, 'time_to': slot_to },
                                'other_time_slots': [ ] }; 
                $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                    var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                    var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                    if(tmp_slot_to == 0) tmp_slot_to = 24;

                    if(tmp_slot_from !== false && tmp_slot_to !== false && !cur_time_slot_theme.is(this)){
                        var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                        var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'employee': tmp_slot_employee };
                        main_obj['other_time_slots'].push(temp_obj);
                    }
                });
                //console.log(main_obj);

                //wrapLoader($(this_obj).parents('.time_slots_theme'));
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_a_period.php",
                    type:"POST",
                    dataType: 'json',
                    data: main_obj,
                    success:function(data){
                        $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>');
                        $.each(data, function(i, value) {
                            $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').append($('<option>').text(value.ordered_name+(value.substitute == 1 ? ' (<?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
)' : '')).attr('value', value.username));
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }).always(function(data) { 
                    //uwrapLoader($(this_obj).parents('.time_slots_theme'));

                    //keep tab order
                    var this_obj_id = $(this_obj).attr('id');
                    if(this_obj_id == 'new_slot_date') $(this_obj).parents('.time_slots_theme').find('.slot_from').focus();
                    /*else if(this_obj_id == 'new_slot_from') $(this_obj).focus();
                    else if(this_obj_id == 'new_slot_to') $(this_obj).focus();*/
                });
            }
        }
        
        function manEntry(){
            var proceed_flag = true;

            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
            var have_slots = false;

            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {
                have_slots = true;
                if($.trim($(this).find('.slot_from').val()) == '' || $.trim($(this).find('.slot_to').val()) == ''){
                    proceed_flag = false;
                }
            });
            
            var weekly_past = $('.add-new-slots-month input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = week_days = '';
            if(weekly_past_value){
                from_week = $('.add-new-slots-month #cscm_from_wk').val();
                to_week = $('.add-new-slots-month #cscm_to_wk').val();
                from_option = $('.add-new-slots-month #cscm_from_option').val();
                
                week_days = $('.add-new-slots-month input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }

            if(slot_date == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){ });
                $('.add-new-slots-month .slot_date').focus();
            }
            else if(!proceed_flag){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['incomplete_slot_times'];?>
', function(result){ });
            }
            else if(!have_slots){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_add_slots'];?>
', function(result){ });
            }
            else if (weekly_past_value == true && week_days == '') {
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_days'];?>
');
            }
            else {
                var main_obj = { 'selected_date': slot_date,
                                'action': 'multiple_add',
                                'time_slots': [ ] }; 

                var collid_emp_obj = [ ];
                $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                    var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                    var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                    if(tmp_slot_to == 0) tmp_slot_to = 24;

                    if(tmp_slot_from !== false)  $(this).find('.slot_from').val(tmp_slot_from);
                    if(tmp_slot_to !== false)    $(this).find('.slot_to').val(tmp_slot_to);

                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();

                    if(tmp_slot_from !== false && tmp_slot_to !== false){
                        tmp_slot_from = parseFloat(tmp_slot_from);
                        tmp_slot_to = parseFloat(tmp_slot_to);
                        var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
'};
                        main_obj['time_slots'].push(temp_obj);
                        collid_emp_obj.push({ 
                                'time_from': tmp_slot_from, 
                                'time_to': tmp_slot_to, 
                                'employee': tmp_slot_employee
                            });
                    }
                });

                var flag_employee_slots_collided = false;
                //check employee slot collided or not
                var count_slots = collid_emp_obj.length;
                for(var i = 1 ; i < count_slots ; i++){

                    if (collid_emp_obj[i]['employee'] == '') continue;
                    for(var j = 0 ; j < i ; j++){

                        if (collid_emp_obj[j]['employee'] == '') continue;
                        if (collid_emp_obj[j]['employee'] != collid_emp_obj[i]['employee']) continue;

                        if((collid_emp_obj[j]['time_from'] >= collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_from'] <  collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] <= collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_from'] < collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_to'])){
                                flag_employee_slots_collided = true;
                                break;
                        }
                    }
                    if(flag_employee_slots_collided) break;
                }

                if(flag_employee_slots_collided){
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_slots_collided_within_entered_slots'];?>
', function(result){ });
                } else {
                    if(weekly_past_value){
                        main_obj['from_week']   = from_week;
                        main_obj['to_week']     = to_week;
                        main_obj['from_option'] = from_option;
                        main_obj['days']        = week_days;
                    }
                    
                    wrapLoader('#slot_creation_main_wraper_group');
                    $.ajax({
                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_inconv_time_with_slot_time.php",
                        type: "POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            //console.log(data);
                            if(data.transaction)
                                manEntry_proceed(data);
                            else if(data.transaction == false && data.error_reason != '')
                                alert(data.error_reason);
                            else
                                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_date_and_time'];?>
', function(result){ });
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) { 
                            uwrapLoader('#slot_creation_main_wraper_group');
                    });
                }
            }
        }
        
        function manEntry_proceed(data_obj){
    
            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());

            var saveTimeslot = $('.add-new-slots-month input:checkbox[name=saveTimeslot]:checked').val();
            var saveTimeslot_value = 0;
            if (saveTimeslot) saveTimeslot_value = 1;

            var weekly_past = $('.add-new-slots-month input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = '';
            if(weekly_past_value){
                from_week = $('.add-new-slots-month #cscm_from_wk').val();
                to_week = $('.add-new-slots-month #cscm_to_wk').val();
                from_option = $('.add-new-slots-month #cscm_from_option').val();
                
                var week_days = $('.add-new-slots-month input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }
            //get all other slot details
            var main_obj = { 'selected_date': slot_date,
                            'selected_customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                            'action': 'man_slot_entry',
                            'sub_action': 'multiple_add',
                            'req_from': 'gd_customer',
                            'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
',
                            'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                            'emp_alloc': '<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
',
                            'saveTimeslot': saveTimeslot_value,
                            'stop_if_any_error': true,
                            'time_slots': [ ] };

            var url_atl = 'date='+slot_date+'&employee=&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=man_slot_entry&sub_action=multiple_add&type_check=18';
            if(weekly_past_value){
                url_atl += '&from_week=' + from_week + '&from_option=' + from_option + '&to_week=' + to_week + '&days=' + week_days;
                
                main_obj['from_week']   = from_week;
                main_obj['to_week']     = to_week;
                main_obj['from_option'] = from_option;
                main_obj['days']        = week_days;
            }
            
            var need_atl_checking = false;

            var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12','15', '16'];
            var oncall_slot_types = ['3', '9', '13', '14', '17'];

            var have_normal_slots = false;
            var have_oncall_slots = false;

            url_atl__ = { 'time_slots': [ ] };  
            var url_atl_slot_count = 0;
            var slot_enters_next_day = false;
            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to = parseFloat(tmp_slot_to);
                    if(tmp_slot_from >= tmp_slot_to) slot_enters_next_day = true;
                    
                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                    var tmp_comment = $.trim($(this).find('.comment_textarea').val());
                    var tmp_fkkn = $(this).find('.custom_slot_fkkn').val();
                    var tmp_slot_type = $(this).find('ul.single-slot-icon-list').find('li.active').attr('data-value');

                    if(tmp_slot_employee != '') need_atl_checking = true;
                    if($.inArray( tmp_slot_type, normal_slot_types ) > -1) //check if normal slot type
                        have_normal_slots = true;
                    if($.inArray( tmp_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                        have_oncall_slots = true;

                    var temp_obj = { 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'employee': tmp_slot_employee,
                            'comment': tmp_comment,
                            'fkkn': tmp_fkkn,
                            'type': tmp_slot_type
                        };
                    main_obj['time_slots'].push(temp_obj);
                    url_atl__['time_slots'].push({ 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'employee': tmp_slot_employee,
                            'type': tmp_slot_type
                        });
                }
            });
            url_atl += '&' + serialize_json_as_url(url_atl__['time_slots'], 'time_slots');
            //main_obj.push( { 'convert_to_oncall': 'yes'});
            //----------------------------------------------------------------


            var base_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action.php?';
            
            if(!weekly_past_value) main_obj['reload'] = 'stop';

            if(have_oncall_slots && (data_obj.time_flag == 0 || data_obj.time_flag_next == 0))
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_outside_oncall'];?>
');

            else if(have_normal_slots && (data_obj.time_flag == 1 && data_obj.time_flag_next == 1)){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_change_as_oncall_slot'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePage(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        if(slot_enters_next_day){
                                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        close_right_panel();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePage(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['convert_to_oncall'] ='yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePage(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        if(slot_enters_next_day){
                                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        close_right_panel();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePage(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                }]);
            }
            else if(have_normal_slots && (data_obj.slot_split_time_flag == 1 || data_obj.slot_split_time_flag_next == 1)){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_seperate_oncall_hours'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                    if(weekly_past_value)
                                                        navigatePage(this_url,1, main_obj);
                                                    else{
                                                        var _fn_callbak = function() {
                                                            get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            if(slot_enters_next_day){
                                                                var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                                                get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            }
                                                            close_right_panel();
                                                        }
                                                        excecute_request(this_url, main_obj, _fn_callbak);
                                                    }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePage(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['split_slots'] = 'yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePage(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        if(slot_enters_next_day){
                                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        close_right_panel();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else {
                                if(weekly_past_value)
                                    navigatePage(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                }]);
            }
            else {
                if(need_atl_checking){
                    check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePage(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        if(slot_enters_next_day){
                                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        close_right_panel();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                    }, base_url);
                } else {
                    if(weekly_past_value)
                            navigatePage(base_url,1, main_obj);
                    else{
                        var _fn_callbak = function() {
                            get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                            if(slot_enters_next_day){
                                var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                            }
                            close_right_panel();
                        }
                        excecute_request(base_url, main_obj, _fn_callbak);
                    }
                }
            }
        }
        
        function serialize_json_as_url(data, array_name){

            var url = '';
            if(typeof array_name !== "undefined"){      //create as array
                url += Object.keys(data).map(function(k) {
                    if(typeof data[k] == 'object'){
                        return serialize_json_as_url(data[k], array_name+'['+k+']');
                    } 
                    else
                        return encodeURIComponent(array_name+'['+k+']') + '=' + encodeURIComponent(data[k]);
                }).join('&');
            } else {
                    url += Object.keys(data).map(function(k) {

                        if(typeof data[k] == 'object'){
                            return serialize_json_as_url(data[k], array_name+'['+k+']');
                        } else {
                            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);

                        }
                    }).join('&');
            }
            return url;
        }
        

        function reset_cscm_params(selected_date){
            if(selected_date != ''){
                var total_weeks_in_a_year = total_weeks_in_date_year(selected_date);

                $('.add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk').find('option[value="53"]').remove();
                if(total_weeks_in_a_year == 53){
                    $('<option value="53">53</option>').appendTo(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk");
                }

                var selected_date_week = $.datepicker.iso8601Week(new Date(selected_date));
                $(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk").val(selected_date_week);
                getAfterDates_for_cscm();
            }
        }
        
        function getAfterDates_for_cscm(){
            //var max_week_number = 52;
            var year_week   = $('.add-new-slots-month #new_slot_date').val();
            var max_week_number = total_weeks_in_date_year(year_week);
            var cur_slot_year_of_week = date('o',strtotime(year_week));
            var year = parseInt(cur_slot_year_of_week, 10);
            var to_week = parseInt($(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk").val()) + (parseInt($(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_option").val()));
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('.add-new-slots-month #created_slot_copy_to_weeks #cscm_to_wk').find('option').remove();
            for (var i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo(".add-new-slots-month #created_slot_copy_to_weeks #cscm_to_wk");
                to_week = to_week + 1;
            }
        }
    </script>
    

   <script>
        $(document).ready(function() {
            /**************************************************
             * Context-Menu with Sub-Menu
             **************************************************/
            $.contextMenu({
                selector: '.weekly_day, .slot-week, .week_no_spn', 
                build: function($trigger, e) {
                    //console.log($trigger);
                    //console.log(e);

                    var included_candg_slots = false;
                    var included_none_candg_slots = false;
                    var included_incomplete_slots = false;
                    var included_non_incomplete_slots = false;
                    var included_selected_slots = false;
                    var included_notonly_incomplete_slots = true;
                    $( '#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.slot-week').hasClass('slot-theme-candg'))
                            included_candg_slots = true;
                        else
                            included_none_candg_slots = true;
                    });
                    $( '#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.slot-week').hasClass('slot-theme-incomplete'))
                            included_incomplete_slots = true;
                        else
                            included_non_incomplete_slots = true;
                    });
                    //console.log('included_candg_slots: '+included_candg_slots);
                    //console.log('included_not_candg_slots: '+included_none_candg_slots);

                    if(included_candg_slots && included_none_candg_slots){
                        //$trigger.contextMenu(false);
                        return false;
                    }

                    if(included_incomplete_slots || included_non_incomplete_slots){
                        included_selected_slots = true;
                    }

                    if(included_incomplete_slots && !included_non_incomplete_slots){
                        included_notonly_incomplete_slots = false;
                    }

                    var ids_temp = $('#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check').map(function () {
                        return this.value;
                    }).get(); 

                    var ids = ids_temp.join('-');

                    // this callback is executed every time the menu is to be shown
                    // its results are destroyed every time the menu is hidden
                    // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
                    var options = {
                        callback: function(key, options) {
                            //window.console && console.log(m) || alert(m);
                            if(ids != ''){
                                var is_single_day_operation = true;
                                //console.log(ids_temp);
                                var single_day_date = temp_single_day_date = '';
                                $.each(ids_temp, function( index, value ) {
                                    //console.log( index + ": " + value );
                                    temp_single_day_date = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                    if(single_day_date != '' && temp_single_day_date != single_day_date){
                                        is_single_day_operation = false;
                                        return false;
                                    }
                                    single_day_date = temp_single_day_date;
                                });
                            }
                            
                            var slot_type_change = '';
                            var slot_fkkn_change = '';
                            switch(key){
                                case "go_to_employee":
                                    var temp_empl_id = '';
                                    if(ids_temp.length == 1){
                                        var slot_details_hub = $('#slot_thread_'+ids_temp[0]).find('.slot_details_hub');
                                        if(slot_details_hub.length == 1){
                                            temp_empl_id = slot_details_hub.attr('data-employee-id');
                                            if(temp_empl_id != ''){
                                                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
/'+temp_empl_id+'/8/',1);
                                            }
                                        }
                                    }
                                    if(temp_empl_id == ''){
                                        close_right_panel();
                                        show_right_panel();
                                        $("#right_click_action_options, #goto-employees-options").removeClass('hide');
                                    }
                                   break;
                                case "go_to_customer":
                                    close_right_panel();
                                    show_right_panel();
                                    $("#right_click_action_options, #goto-customers-options").removeClass('hide');
                                   break;
                                case "delete_slot":
                                   if(ids != ''){
                                        var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action' : 'multiple_slots_remove', 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer' };
                                        bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_delete_slot'];?>
', [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    if(is_single_day_operation){
                                                        var _fn_callbak = function() {
                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                    }else
                                                        navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;

                               case 'delete_customer':
                                   if(ids != ''){
                                       var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': 'delete_customers', 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer' };
                                       bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_delete_customer'];?>
', [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    if(is_single_day_operation){
                                                        var _fn_callbak = function() {
                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                    }else
                                                        navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;

                               case 'delete_employee':
                                   if(ids != ''){
                                       var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': 'delete_employees', 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer' };
                                       bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_delete'];?>
', [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    if(is_single_day_operation){
                                                        var _fn_callbak = function() {
                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                    }else
                                                        navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case 'change_fk':
                               case 'change_kn':
                               case 'change_tu':
                                   switch(key){
                                       case "change_fk" : slot_fkkn_change = 'change_fk'; break;
                                       case "change_kn" : slot_fkkn_change = 'change_kn'; break;
                                       case "change_tu" : slot_fkkn_change = 'change_tu'; break;
                                   }

                                   if(ids != ''){
                                       var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': slot_fkkn_change, 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer'};
                                       bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_changes'];?>
', [{
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                "class" : "btn-danger"
                                            }, {
                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    if(is_single_day_operation){
                                                        var _fn_callbak = function() {
                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                        }
                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                    }else
                                                        navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "change_employee":
                                   if(ids != ''){
                                       var process_details_obj = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
',
                                        'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                        'ids': ids,
                                        'request_from': 'gd_customer',
                                        'action': 'avail_employees_for_multiple_slot_change',
                                        'method': '1'};
                                       changeEmployeeCustomer(process_details_obj,1);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "change_customer":
                                   if(ids != ''){
                                       var process_details_obj = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
',
                                        'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                        'ids': ids,
                                        'request_from': 'gd_customer',
                                        'action': 'avail_customers_for_multiple_slot_change',
                                        'method': '2'};
                                       changeEmployeeCustomer(process_details_obj,2);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "change_time":
                                   if(ids != ''){
                                    changeEmployeeTime();
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "copy": 
                                   if(ids != '')
                                       copyWeeklySlot();
                                   else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "paste" :
                                    if($(this).hasClass('week_no_spn')){
                                        var dates = $(this).attr('data-yearweek');
                                        pasteSlot('', '', dates);
                                    }else if($(this).hasClass('weekly_day')){
                                        var dates = $(this).attr('data-date');
                                        //console.log('monthly_day'+dates);
                                        pasteSlot('TRUE',dates,'');
                                    }else if($(this).hasClass('slot-week')){
                                        var dates = $(this).parents('td.weekly_day').attr('data-date');
                                        pasteSlot('TRUE',dates,'');
                                    }else
                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['cannot_paste'];?>
', function(result){ });
                                    break;
                              case "paste_day" :
                                    if($(this).hasClass('week_no_spn')){
                                        var dates = $(this).attr('data-yearweek');
                                        pasteSlotDay('','',dates);
                                    }else if($(this).hasClass('weekly_day')){
                                        var dates = $(this).attr('data-date');
                                        pasteSlotDay('TRUE',dates,'');
                                    }else if($(this).hasClass('slot-week')){
                                        var dates = $(this).parents('td.weekly_day').attr('data-date');
                                        pasteSlotDay('TRUE',dates,'');
                                    }else
                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['cannot_paste'];?>
', function(result){ });
                                    break;      
                               case "add_slot" :
                                    if($(this).hasClass('weekly_day')){
                                        var dates = $(this).attr('data-date');
                                        popupAddSlot(dates);
                                    }else if($(this).hasClass('slot-week')){
                                        var dates = $(this).parents('td.weekly_day').attr('data-date');
                                        popupAddSlot(dates);
                                    }else
                                        popupAddSlot();
                                    break;
                                case "split_slot" :
                                    split_slot_event();
                                    break;
                                case "mark_interest_in" :
                                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['interested_confirm_changes'];?>
', [{
                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                        "class" : "btn-danger"
                                    }, {
                                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                        "class" : "btn-success",
                                        "callback": function() {

                                            makeInterestIn();
                                        }
                                }]);
                               break;
                               case "change_type_normal" :
                               case "change_type_travel" :
                               case "change_type_oncall" :
                               case "change_type_break" :
                               case "change_type_overtime" :
                               case "change_type_qual_overtime" :
                               case "change_type_more_time" :
                               case "change_type_some_other_time" :
                               case "change_type_training_time" :
                               case "change_type_call_training" :
                               case "change_type_personal_meeting" :
                               case "change_type_more_oncall" :
                               case "change_type_voluntary" :
                               case "change_type_complementary" :
                               case "change_type_complementary_oncall" :
                               case "change_type_oncall_standby":     
                                   switch(key){
                                       case "change_type_normal" : slot_type_change = 0; break;
                                       case "change_type_travel" : slot_type_change = 1; break;
                                       case "change_type_break" : slot_type_change = 2; break;
                                       case "change_type_oncall" : slot_type_change = 3; break;
                                       case "change_type_overtime" : slot_type_change = 4; break;
                                       case "change_type_qual_overtime" : slot_type_change = 5; break;
                                       case "change_type_more_time" : slot_type_change = 6; break;
                                       case "change_type_some_other_time" : slot_type_change = 7; break;
                                       case "change_type_training_time" : slot_type_change = 8; break;
                                       case "change_type_call_training" : slot_type_change = 9; break;
                                       case "change_type_personal_meeting" : slot_type_change = 10; break;
                                       case "change_type_voluntary" : slot_type_change = 11; break;
                                       case "change_type_complementary" : slot_type_change = 12; break;
                                       case "change_type_complementary_oncall" : slot_type_change = 13; break;
                                       case "change_type_more_oncall" : slot_type_change = 14; break;
                                       case "change_type_oncall_standby" : slot_type_change = 15; break;    
                                   }
                                   if(ids != ''){
                                        bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_changes'];?>
', [{
                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                            "class" : "btn-danger"
                                        },{
                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                            "class" : "btn-success",
                                            "callback": function() {
                                            var mixed_normal_oncall_types = false;
                                            //special check for complementary and complementary-oncall
                                            if(slot_type_change == 12 || slot_type_change == 13){
                                                var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
                                                var oncall_slot_types = ['3', '9', '13', '14', '17'];
                                                var have_normal_slots = false, have_oncall_slots = false;
                                                var tmp_this_slot_type = '';
                                                $( '#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                                                    tmp_this_slot_type = $(this).parents('.slot-week').find('input.slot_details_hub').attr('data-type');
                                                    if($.inArray( tmp_this_slot_type, normal_slot_types ) > -1) //check if normal slot type
                                                        have_normal_slots = true;
                                                    else if($.inArray( tmp_this_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                                                        have_oncall_slots = true;
                                                });
                                                mixed_normal_oncall_types = (have_normal_slots == true && have_oncall_slots == true ? true : false);
                                            }
                                            if((slot_type_change == 12 || slot_type_change == 13) && mixed_normal_oncall_types == true){
                                                var prompt_msg = null;
                                                if(slot_type_change == 12) //complementary
                                                    prompt_msg = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_change_oncall_to_comp_oncall'];?>
';
                                                else if(slot_type_change == 13) //complementary-oncall
                                                    prompt_msg = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_change_normal_to_complementary'];?>
';
                                                
                                                    bootbox.dialog( prompt_msg, [{
                                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
",
                                                            "class" : "btn-primary"
                                                        },{
                                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                            "class" : "btn-danger",
                                                            "callback": function() {
                                                                if(slot_type_change == 13){
                                                                    $.ajax({
                                                                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_oncall_inconve_range.php",
                                                                        type: "POST",
                                                                        data: 'ids='+ids,
                                                                        success:function(data){
                                                                            if(data == 'success'){
                                                                                var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                                                                var url_post_data = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_customer' };

                                                                                if(is_single_day_operation){
                                                                                    var _fn_callbak = function() {
                                                                                        get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                                    }
                                                                                    excecute_request(urls, url_post_data, _fn_callbak);
                                                                                }else
                                                                                    navigatePage(urls,1, url_post_data); 
                                                                            }else
                                                                                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_outside_oncall'];?>
', function(result){ });
                                                                        }
                                                                      });
                                                               }else{
                                                                    var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                                                    var url_post_data = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_customer' };

                                                                    if(is_single_day_operation){
                                                                        var _fn_callbak = function() {
                                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                        }
                                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                                    }else
                                                                        navigatePage(urls,1, url_post_data);
                                                               }
                                                            }
                                                        },{
                                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                            "class" : "btn-success",
                                                            "callback": function() {
                                                                var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                                                var url_post_data = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_customer', 'normal_oncall_auto_change': true };

                                                                if(is_single_day_operation){
                                                                    var _fn_callbak = function() {
                                                                        get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                    }
                                                                    excecute_request(urls, url_post_data, _fn_callbak);
                                                                }else
                                                                    navigatePage(urls,1, url_post_data);
                                                            }
                                                    }]);
                                            }
                                            else if(slot_type_change == 14 || slot_type_change == 3 || slot_type_change == 9 || slot_type_change == 13 || slot_type_change == 17){
                                                $.ajax({
                                                    url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_oncall_inconve_range.php",
                                                    type: "POST",
                                                    data: 'ids='+ids,
                                                    success:function(data){
                                                        if(data == 'success'){
                                                            var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                                            var url_post_data = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_customer' };
                                                            
                                                            if(is_single_day_operation){
                                                                var _fn_callbak = function() {
                                                                    get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                }
                                                                excecute_request(urls, url_post_data, _fn_callbak);
                                                            }else
                                                                navigatePage(urls,1, url_post_data); 
                                                        }else
                                                            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_outside_oncall'];?>
', function(result){ });
                                                    }
                                                  });
                                            }
                                            else{
                                                var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                                var url_post_data = { 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_customer' };
                                                
                                                if(is_single_day_operation){
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                    }
                                                    excecute_request(urls, url_post_data, _fn_callbak);
                                                }else
                                                    navigatePage(urls,1, url_post_data);
                                            }
                                       }
                                       }]);
                                   } else
                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                            }
                        },
                        items: {
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?>
                                "copy": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['copy'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                                "paste": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
", disabled: ((included_candg_slots) ? true : false)},
                                "paste_day": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste_day'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste_day'];?>
", disabled: ((included_candg_slots) ? true : false)},
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?> "sep11": "---------", <?php }?>
                            "goto": {   
                                        "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
", 
                                        accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
", 
                                        "items": {
                                            "go_to_employee":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
" },
                                            "go_to_customer":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
" }
                                        }
                                },
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type']==1){?>
                                "sep121": "---------",
                                "change": {   
                                        "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_action'];?>
", 
                                        disabled: (included_candg_slots ? true : false),
                                        accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_action'];?>
", 
                                        "items": {
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
                                                "change_employee":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1){?>
                                                "change_customer": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1){?>
                                                "change_contract": { 
                                                    "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['right_click_menu_contract'];?>
",
                                                    disabled: (included_candg_slots ? true : false),
                                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['right_click_menu_contract'];?>
", 
                                                    "items" : {
                                                        "change_fk": { "name": "FK", accesskey: "FK", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                                        "change_kn": { "name": "KN", accesskey: "KN", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                                        "change_tu": { "name": "TU", accesskey: "TU", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                                    }
                                                },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['slot_type']==1){?>
                                                "change_type": { 
                                                    "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['slot_type'];?>
",
                                                    disabled: (included_candg_slots ? true : false),
                                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['slot_type'];?>
", 
                                                    "items" : {
                                                    'change_type_oncall_standby':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall_standby'];?>
"},

                                                            'change_type_training_time':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['training_time'];?>
"},
                                                            'change_type_call_training':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['call_training'];?>
" },
                                                            'change_type_complementary':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary'];?>
"},
                                                            'change_type_complementary_oncall':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['complementary_oncall'];?>
"},
                                                            'change_type_qual_overtime':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['qual_overtime'];?>
"},
                                                            'change_type_normal':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['normal'];?>
"},
                                                            'change_type_personal_meeting':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['personal_meeting'];?>
"},
                                                             'change_type_break':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['break'];?>
"},
                                                             'change_type_travel':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['travel'];?>
"},
                                                            'change_type_more_time':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_time'];?>
"},
                                                            'change_type_more_oncall':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['more_oncall'];?>
"},
                                                            'change_type_some_other_time':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['some_other_time'];?>
" },
                                                            'change_type_voluntary':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['voluntary'];?>
"},
                                                            'change_type_oncall':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['oncall'];?>
"},
                                                            'change_type_overtime':{ "name" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['overtime'];?>
"}
                                                    } 
                                                },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['change_time']==1){?>
                                                "change_time":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_time'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_time'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
                                                "split_slot": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['split_slot'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['split_slot'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                                            <?php }?>
                                        }
                                },
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['remove_customer']==1){?>
                                "delete": {
                                        "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_action'];?>
",
                                        accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_action'];?>
", 
                                        "items": {
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['delete_slot']==1){?> "delete_slot": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['slot'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['slot'];?>
" },<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['remove_employee']==1){?> "delete_employee": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['remove_customer']==1){?> "delete_customer": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) }<?php }?>
                                        }

                                },
                            <?php }?>
                            "sep12": "---------",
                            "mark_interest_in": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_interest_in'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['mark_interest_in'];?>
", disabled: (included_notonly_incomplete_slots ? true : false)},
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                                "sep12": "---------",
                                "add_slot": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_slot'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_new_slot'];?>
"},
                            <?php }?>
                            
                        }
                    }

                    if(included_candg_slots && !included_none_candg_slots){
                        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['candg_approve']==1){?>
                            options.items.candg_approve = { 
                                    "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
", 
                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['approve'];?>
",
                                    callback: function(key, opt){ 
                                            var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                            var url_post_data = { 'ids': ids, 'action': 'slot_approve_candg', 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer' };
                                            
                                            var processed_emp_names = [ ];
                                            $.each(ids_temp, function( index, value ) {
                                                var temp_sel_data_obj   = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub');
                                                processed_emp_names.push(temp_sel_data_obj.attr('data-employee-name'));

                                            });
                                            processed_emp_names = arrayUnique(processed_emp_names);

                                            bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_approval_candg'];?>
 <br/><br/><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
: '+processed_emp_names.join(', '), [{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                    "class" : "btn-danger"
                                                },{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes_to_all'];?>
",
                                                    "class" : "btn-primary",
                                                    "callback": function() {
                                                        var other_ids = [ ];
                                                        var processed_emps = [ ];
                                                            
                                                        $.each(ids_temp, function( index, value ) {
                                                            var temp_sel_data_obj   = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub');
                                                            var temp_sel_data_emp   = temp_sel_data_obj.attr('data-employee-id');
                                                            var temp_sel_data_cust  = temp_sel_data_obj.attr('data-customer-id');
                                                            
                                                            if($.inArray( temp_sel_data_emp, processed_emps ) == -1){

                                                                if(temp_sel_data_emp != '' && temp_sel_data_cust != ''){
                                                                    $( '#week-slot-calender .slot-theme-candg input.slot_details_hub' ).each(function( index ) {
                                                                        if($(this).attr('data-employee-id') == temp_sel_data_emp && $(this).attr('data-customer-id') == temp_sel_data_cust && $(this).attr('data-id') != value){
                                                                            other_ids.push($(this).attr('data-id'));
                                                                        }
                                                                    });

                                                                    processed_emps.push(temp_sel_data_emp);
                                                                }
                                                            }
                                                                
                                                        });
                                                        
                                                        var final_ids = ids_temp.concat(other_ids);
                                                        url_post_data['ids'] = final_ids.join('-');
                                                        navigatePage(urls, 1, url_post_data);
                                                    }
                                                },{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        var is_single_day_operation = true;
                                                        //console.log(ids_temp);
                                                        var single_day_date = temp_single_day_date = '';
                                                        $.each(ids_temp, function( index, value ) {
                                                            //console.log( index + ": " + value );
                                                            temp_single_day_date = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                                            if(single_day_date != '' && temp_single_day_date != single_day_date){
                                                                is_single_day_operation = false;
                                                                return false;
                                                            }
                                                            single_day_date = temp_single_day_date;
                                                        });

                                                        if(is_single_day_operation){
                                                            var _fn_callbak = function() {
                                                                get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            }
                                                            excecute_request(urls, url_post_data, _fn_callbak);
                                                        }else
                                                            navigatePage(urls, 1, url_post_data);
                                                    }
                                            }]);
                                    }
                            };

                            options.items.candg_reject = { 
                                    "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
", 
                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['reject'];?>
",
                                    callback: function(key, opt){ 
                                            var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_right_click_actions.php';
                                            var url_post_data = { 'ids': ids, 'action': 'multiple_slots_remove', 'week_num': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', 'customer' : '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'request_from': 'gd_customer' };
                                            bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_reject_candg'];?>
', [{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                    "class" : "btn-danger",
                                                    "callback": function() {
                                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                                    }
                                                }, {
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        var is_single_day_operation = true;
                                                        var single_day_date = temp_single_day_date = '';
                                                        $.each(ids_temp, function( index, value ) {
                                                            //console.log( index + ": " + value );
                                                            temp_single_day_date = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                                            if(single_day_date != '' && temp_single_day_date != single_day_date){
                                                                is_single_day_operation = false;
                                                                return false;
                                                            }
                                                            single_day_date = temp_single_day_date;
                                                        });
                                                        if(is_single_day_operation){
                                                            var _fn_callbak = function() {
                                                                get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                            }
                                                            excecute_request(urls, url_post_data, _fn_callbak);
                                                        }else
                                                            navigatePage(urls, 1, url_post_data);
                                                    }
                                            }]);
                                    }
                            };
                        <?php }?>
                    }
                    
                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
                        if(ids_temp.length == 1 && !included_candg_slots){
                            options.items.pmain_replace = { 
                                        "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
", 
                                        accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['replace'];?>
",
                                        callback: function(key, opt){ 
                                                loadPopupReplaceProcessMain(ids);
                                        }
                            };
                        }
                    <?php }?>
            
                    <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
                        if(included_incomplete_slots && !included_non_incomplete_slots){
                             options.items.sms = { 
                                     "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['sms'];?>
", 
                                     accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['sms'];?>
",
                                     callback: function(key, opt){ 
                                                loadSMSProcessMain(ids);
                                     }
                             };
                         }
                     <?php }?>
             
                     <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['swap']==1){?>
                        //swap 2 slots at a single action
                        if(ids_temp.length == 2 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                             options.items.swap_switch = { 
                                     "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
", 
                                     accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
",
                                     callback: function(key, opt){ 
                                                process_swap_switch_2_slots(ids);
                                     }
                             };
                        }
                        
                        //slot copy for swap
                        if(ids_temp.length == 1 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                             options.items.swap_copy = { 
                                     "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap_copy'];?>
", 
                                     accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap_copy'];?>
",
                                     callback: function(key, opt){ 
                                                process_swap_copy_first_slot(ids);
                                     }
                             };
                        }
                        
                        //slot swap past from copied slot
                        if(ids_temp.length == 1 && '<?php echo $_smarty_tpl->tpl_vars['swap_copied_slot']->value;?>
' != '' && ids_temp != '<?php echo $_smarty_tpl->tpl_vars['swap_copied_slot']->value;?>
' && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                             options.items.swap_past = { 
                                     "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
", 
                                     accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
",
                                     callback: function(key, opt){ 
                                                process_swap_past_with_second_slot(ids);
                                     }
                             };
                         }
                    <?php }?>

                    if(ids_temp.length >= 1){
                        // "sep122": "---------",
                        options.items.sep122 = "---------";
                    }

                    if(ids_temp.length == 1){
                        options.items.find_similar = { 
                                    "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['find_similar'];?>
", 
                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['find_similar'];?>
",
                                    callback: function(key, opt){ 
                                        var selected_id = ids;
                                        var slot_obj = $('#week-slot-calender .slot-week:not(:hidden) input:checkbox.m_check[value='+ids+']').parents('.slot-week').find('input.slot_details_hub');
                                        var from_time = slot_obj.attr('data-time-from');
                                        var to_time = slot_obj.attr('data-time-to');

                                        $( '#week-slot-calender .slot-week input.slot_details_hub' ).each(function( index ) {
                                            if($(this).attr('data-time-from') == from_time && $(this).attr('data-time-to') == to_time && $(this).attr('data-id') != selected_id){
                                                $(this).parents('.slot-week:not(:hidden)').find('input:checkbox.m_check').attr('checked', true);
                                            }
                                        });
                                    }
                        };
                    }

                    if(ids_temp.length >= 1){
                        options.items.unmark_all = { 
                                    "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['uncheck_all'];?>
", 
                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['uncheck_all'];?>
",
                                    callback: function(key, opt){ 
                                        $('#week-slot-calender .slot-week').find('.m_check:checkbox').attr('checked', false);
                                        $('.weekly_control #all_check').attr('checked', false);
                                    }
                        };
                    }

                    return options;
                }
            });
            
            
            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
                $('#replace-employee-week-basis #replace_emp_date_from_div, #replace-employee-week-basis #replace_emp_date_to_div').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'})
                .on('changeDate', function(ev){
                  //console.log(ev.date.valueOf());
                  loadEmployeesForReplacement();
                });
            <?php }?>
        });

        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['change_time']==1){?>
            function changeEmployeeTime(){
                close_right_panel();
                show_right_panel();
                $('#change_time_of_slots,#slot_creation_main_wraper_group').removeClass('hide');
            } 

            function saveChangetimes(){
                var time_from =  $('#change_time_from').val();
                var time_to   =  $('#change_time_to').val();
                if(time_from > time_to){
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['fromtime_should_be_lessthan_totime'];?>
', function(result){  });
                    return false;
                }
                var ids_temp = $('#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check').map(function () {
                    return this.value;
                }).get(); 

                var data_obj = {
                    'time_from' : time_from, 
                    'time_to' : time_to,
                    'ids': ids_temp.join(','),
                    'action':'change_slot_time',
                }
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:data_obj,
                    success:function(data){
                        console.log(data);
                        if(data.result_flag == false){
                            $('#left_message_wraper').html(data.error_message);
                        }
                        else{
                            reload_content();
                        }
                    }
                });

            }           
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1||$_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1){?>
            function changeEmployeeCustomer(process_details_obj, method){

                close_right_panel();
                show_right_panel();
                $("#right_click_action_options, #change-employee-customer-options").removeClass('hide');

                var popup_title = '';
                if(method == 1){
                    popup_title = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_employee'];?>
';
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('employee');
                }else if(method == 2){
                    popup_title = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['change_customer'];?>
';
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('customer');
                }else 
                    $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('');

                $('#right_click_action_options #change-employee-customer-options .panel-title').html(popup_title);
                $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('');
                $('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val(process_details_obj.ids);

                wrapLoader('#right_click_action_options');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        //console.log(data_process);
                        var avail_users = [];
                        if(method == 1)
                            avail_users = data_process.avail_employees;
                        else if(method == 2)
                            avail_users = data_process.avail_customers;

                        //console.log(avail_users.length);
                        if(avail_users.length > 0){
                            $.each(avail_users, function(i, value) {
                                $('#right_click_action_options #change-employee-customer-options #available_users_for_change').append('<div class="span12 available_user" style="margin-left: 0px;">\n\
                                                <div class="span12 child-slots" style="margin-top: 4px;">\n\
                                                    <label>\n\
                                                        <input type="radio" name="rd_change_user" value="'+value.username+'" class="check-box this_avail_user" />\n\
                                                        <span>'+value.ordered_name+'</span>'+(method == 1 && value.substitute == 1 ? '<span class="pull-right label label-info"><?php echo $_smarty_tpl->tpl_vars['translate']->value['substitute'];?>
</span>' : '')+'\n\
                                                    </label>\n\
                                                </div>\n\
                                            </div>');
                            });
                            $('#change-employee-customer-options #btnChangeUserMultiple').removeClass('hide');
                        } else if(typeof data_process.message !== 'undefined'){
                            $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('<div class="message">'+data_process.message+'</div>');
                            $('#change-employee-customer-options #btnChangeUserMultiple').addClass('hide');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader('#right_click_action_options');
                });
            }

            function saveChangeUserMultiple(){

                var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
                var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
                var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

                //console.log(selected_user);

                if(typeof selected_user === 'undefined' || selected_user == '')
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_user_selected'];?>
', function(result){ });
                else if(selected_slots == '')
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_slot_selected'];?>
', function(result){ });
                else if(change_usertype == 'employee'){
                    wrapLoader('#right_click_action_options');
                    $.ajax({
                        url:    "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customers_employees_change.php",
                        type:   "POST",
                        data:   "employee_username="+selected_user+"&ids="+selected_slots+"&action=check_overlap",
                        success:function(data){
                                if(data == 'sucess'){
                                    saveChangeUserMultipleConfirm();
                                }else
                                    bootbox.alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['overlapped'];?>
 " + data, function(result){ });
                        }
                    }).always(function(data) { 
                        uwrapLoader('#right_click_action_options');
                    });
                }else if(change_usertype == 'customer')
                    saveChangeUserMultipleConfirm();
            }

            function saveChangeUserMultipleConfirm(){
                var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
                var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
                var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

                var url = "customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&week_num=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&request_from=gd_customer&method=1&ids="+selected_slots;
                if(change_usertype == 'employee') url += "&employee_username="+selected_user;
                else if(change_usertype == 'customer') url += "&customer_select="+selected_user;
                
                var is_single_day_operation = true;
                var single_day_date = temp_single_day_date = '';
                if(selected_slots != ''){
                    var ids_temp = selected_slots.split("-");
                    //console.log(ids_temp);
                    $.each(ids_temp, function( index, value ) {
                        //console.log( index + ": " + value );
                        temp_single_day_date = $('#week-slot-calender #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                        if(single_day_date != '' && temp_single_day_date != single_day_date){
                            is_single_day_operation = false;
                            return false;
                        }
                        single_day_date = temp_single_day_date;
                    });
                }
                
                var atl_req_data = url+'&type_check=17&right_click=1';
                var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alter_slot_employee_customer.php?'+url;
                check_atl_warning(atl_req_data, function(this_url){
                                    close_right_panel();
                                    
                                    if(is_single_day_operation && single_day_date != ''){
                                        this_url += '&no_refresh_whole=TRUE'
                                        var _fn_callbak = function() {
                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        excecute_request(this_url, { }, _fn_callbak);
                                    }else
                                        navigatePage(this_url, 1);
                                }, process_url, '#right_click_action_options');
            }
        <?php }?>
        
        function copyWeeklySlot(){
            var ids = '';
            var values = $('#week-slot-calender .slot-week:not(:hidden) input:checkbox:checked.m_check').map(function () {
                    return this.value;
            }).get();    
            for(var i=0; i < values.length; i++)
                ids += values[i]+'-';

            if(ids != ''){
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?week_num=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&action=copy_select&request_from=gd_customer&slots='+ids;
                var url_data = 'week_num=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&action=copy_select&request_from=gd_customer&slots='+ids;
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php",
                        type: "POST",
                        data: url_data,
                        dataType: "json",
                        success:function(data){
                            uwrapLoader("#main_content #external_wrapper");
                        }
                });
            }else
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
        }

        function pasteSlot(action_type, date, week_year){
            action_type = action_type || 'FALSE';
            date = date || '';
            week_year = week_year || '';
            if(date == ''){
                if(week_year != ''){
                    var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&request_from=gd_customer&action=paste_select';
                    var url_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&request_from=gd_customer&type_check=8'
                    var atl_req_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&request_from=gd_customer&type_check=8';
                }else{
                    var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&request_from=gd_customer&action=paste_select';
                    var url_data = 'date=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&request_from=gd_customer&action=paste_select&type_check=8'
                    var atl_req_data = 'date=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&request_from=gd_customer&type_check=8';
                }
            }
            else{
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&request_from=gd_customer&to_single_day='+action_type; 
                var url_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&request_from=gd_customer&to_single_day='+action_type;
                var atl_req_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&request_from=gd_customer&to_single_day='+action_type;
            }
            check_atl_warning(atl_req_data, function(this_url){ 
                                wrapLoader("#external_wrapper");
                                $('#div_alloc_action').load(this_url,function(response, status, xhr){ 
                                    uwrapLoader("#external_wrapper"); 
                                    if(action_type == 'TRUE'){
                                        get_day_refresh(date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                    } 
                                    else
                                        reload_content(); 
                                });
                            }, url, "#external_wrapper");
        }
        
        function pasteSlotDay(action_type, date, week_year){
            action_type = action_type || 'FALSE';
            date = date || '';
            week_year = week_year || '';
            if(date == ''){
                if(week_year != ''){
                    var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&request_from=gd_customer&action=paste_select_day';
                    var url_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&request_from=gd_customer&type_check=8'
                    var atl_req_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&request_from=gd_customer&type_check=8';
                }else
                    return false;
            }
            else{
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&request_from=gd_customer&to_single_day='+action_type; 
                var url_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8&request_from=gd_customer&to_single_day='+action_type;
                var atl_req_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8&request_from=gd_customer&to_single_day='+action_type;
            }
            check_atl_warning(atl_req_data, function(this_url){ 
                                wrapLoader("#external_wrapper");
                                $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader("#external_wrapper"); reload_content(); });
                            }, url, "#external_wrapper");

        }
        
        function popupAddSlot(date) {
            date = (typeof date != 'undefined' ? date : '');
            
            close_right_panel();
            show_right_panel();
            $("#slot_creation_main_wraper_group").removeClass('hide');
            $(".add-new-slots-month .create-slotes-panel").html(get_slot_add_theme());
            $(".add-new-slots-month").removeClass('hide');

            if(date != ''){
                $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', date);
                $('.add-new-slots-month #new_slot_from').focus();
            }
        }
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
            function loadPopupReplaceProcessMain(ids) {

                var slot_obj = $('#week-slot-calender .slot-week input:checkbox.m_check[value='+ids+']').parents('.slot-week');
                var slot_customer_id = slot_obj.find('input.slot_details_hub').attr('data-customer-id');
                var slot_customer_name = slot_obj.find('input.slot_details_hub').attr('data-customer-name');
                var slot_employee_id = slot_obj.find('input.slot_details_hub').attr('data-employee-id');
                var slot_employee_name = slot_obj.find('input.slot_details_hub').attr('data-employee-name');
                var slot_date = slot_obj.find('input.slot_details_hub').attr('data-date');

                //console.log(slot_obj);

                if(slot_employee_id == '')
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_a_non_empty_employee_slot'];?>
', function(result){ });
                else{
                    close_right_panel();
                    show_right_panel();
                    $("#right_click_action_options, #replace-employee-week-basis").removeClass('hide');

                    $('#replace-employee-week-basis #spn_replacing_employee').html(slot_employee_name);
                    $('#replace-employee-week-basis #spn_replace_customer').html(slot_customer_name);
                    $('#replace-employee-week-basis #replace_emp_date_from_div').datepicker('update', slot_date);
                    $('#replace-employee-week-basis .slot_customer').val(slot_customer_id);
                    $('#replace-employee-week-basis .slot_employee').val(slot_employee_id);
                    $('#replace-employee-week-basis #replacement_employee_list').html('');
                }

            }

            function loadEmployeesForReplacement() {
                var dfrom = $('#replace-employee-week-basis #replace_emp_date_from').val();
                var dto = $('#replace-employee-week-basis #replace_emp_date_to').val();
                var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
                var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

                var customer_checked = $('#replace-employee-week-basis input:checkbox[name=repl_infocus]:checked').val();
                var is_customer_checked = 0;
                if (customer_checked) is_customer_checked = 1;

                $('#replace-employee-week-basis #replacement_employee_list').html('');
                if(dfrom != '' && dto != ''){

                    //&is_customer_checked='+is_customer_checked+'&type=rep_emp_load'
                    var process_details_obj = { 'start_date': dfrom,
                                            'end_date': dto,
                                            'selected_emp': slot_employee,
                                            'sel_customer': slot_customer,
                                            'is_customer_checked': is_customer_checked,
                                            'action': 'rep_emp_load'};

                    wrapLoader("#replace-employee-week-basis");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                        type:"POST",
                        dataType: 'json',
                        data:process_details_obj,
                        success:function(data_process){
                            //console.log(data_process);
                            if(data_process.avail_employees.length > 0){
                                $.each(data_process.avail_employees, function(i, value) {
                                    //$employee['username'].'">'.$employee['name']
                                    $('#replace-employee-week-basis #replacement_employee_list').append('<input type="radio" value="'+value.username+'" name="week_rep_emp_radio" class="week_rep_emp_radio">'+value.ordered_name+'<br>');
                                });
                                $('#replace-employee-week-basis #btnReplaceEmpMultiple').removeClass('hide');
                            } else if(typeof data_process.message !== 'undefined'){
                                $('#replace-employee-week-basis #replacement_employee_list').html('<div class="message">'+data_process.message+'</div>');
                                $('#replace-employee-week-basis #btnReplaceEmpMultiple').addClass('hide');
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    })
                    .always(function(data) {
                        uwrapLoader("#replace-employee-week-basis");
                    });

                }
            }

            function saveReplaceMultipleConfirm(){

                var dfrom   = $.trim($('#replace-employee-week-basis #replace_emp_date_from').val());
                var dto     = $.trim($('#replace-employee-week-basis #replace_emp_date_to').val());

                var emp_rep = "";
                var emp_rep_values = $('#replace-employee-week-basis input:radio:checked.week_rep_emp_radio').map(function() {
                    return this.value;
                }).get();
                if (emp_rep_values.length) emp_rep = emp_rep_values[0];

                if(dfrom == '' || dto == '')
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
', function(result){ });
                else if (emp_rep == '') 
                    bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_replace_employee'];?>
', function(result){ });
                else{
                    var in_focus = 0;
                    if ($('#replace-employee-week-basis #repl_infocus').attr("checked") == "checked")
                        in_focus = 1;

                    var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
                    var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

                    var process_details_obj = { 'from_date': dfrom,
                                            'to_date': dto,
                                            'employee': slot_employee,
                                            'employee_rep': emp_rep,
                                            'user': slot_customer,
                                            'focus': in_focus,
                                            'request_from': 'gd_customer',
                                            'type': 'replace'};

                    wrapLoader("#replace-employee-week-basis");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php",
                        type:"POST",
                        dataType: 'json',
                        data:process_details_obj,
                        success:function(data_process){
                            //console.log(data_process);
                            if(data_process.result){
                                close_right_panel();
                                reload_content();
                            } else if(typeof data_process.message !== 'undefined'){
                                $('#left_message_wraper').html(data_process.message);
                                $('.main-left').animate({
                                    scrollTop: $('#left_message_wraper').offset().top
                                });
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    })
                    .always(function(data) {
                        uwrapLoader("#replace-employee-week-basis");
                    });
                }
            }
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value==1){?>
            function loadSMSProcessMain(ids){
                close_right_panel();
                show_right_panel();
                $("#right_click_action_options, #sms-for-emp-allocation").removeClass('hide');

                var splitted_ids = ids.split('-');
                var ids_comma_seperated = splitted_ids.join(',');

                $('#sms-for-emp-allocation .slot_ids').val(ids_comma_seperated);
                $('#sms-for-emp-allocation #send_employees_list_sms').html('');

                var process_details_obj = { 'ids': ids,
                                            'action': 'avail_emps_for_sms_allotment'};

                wrapLoader("#sms-for-emp-allocation");
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: "json",
                    data:process_details_obj,
                    success:function(data){
                                //console.log(data)
                                $.each(data.avail_employees, function(i, value) {
                                    $('#sms-for-emp-allocation #send_employees_list_sms').append($('<option>').text(value.ordered_name).attr('value', value.username));
                                });

                                if(data.avail_employees.length > 0)
                                    $('#sms-for-emp-allocation #btnEmpAllotSMS').removeClass('hide');
                                else
                                    $('#sms-for-emp-allocation #btnEmpAllotSMS').addClass('hide');
                            },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }).always(function(data) {
                    uwrapLoader("#sms-for-emp-allocation");
                });
            }

            function sendSmsForAllotment(){
                var slot_id = $("#sms-for-emp-allocation .slot_ids").val();
                var opt_sms_conformation = 0;
                var opt_sms_sender = 0;
                var opt_sms_rejection = 0;
                <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                    var rep_emp = $('#sms-for-emp-allocation .send_employees_list_sms[name=send_employees_list_sms]').val();
                    if(typeof rep_emp == 'undefined') rep_emp = '';
                    sms_emps = $('#sms-for-emp-allocation .send_employees_list_sms').val();

                    if($('#sms-for-emp-allocation input:checkbox[name=chk_confirmation_allotment]:checked').prop('checked')){
                        opt_sms_conformation = 1;
                        if($('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]:checked').prop('checked'))
                            opt_sms_sender = 1;
                    }    
                    else {
                        if($('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]:checked').prop('checked'))
                            opt_sms_sender = 1;
                        if($('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]:checked').prop('checked'))
                            opt_sms_rejection = 1;    
                    }
                <?php }else{ ?>
                    var rep_emp = '';
                <?php }?>

                var url_data_obj = { 'slots': slot_id, 'sms_send_employees' : rep_emp,
                         'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection, 'request_from': 'gd_customer' };

                //console.log(url_data_obj);

                wrapLoader("#sms-for-emp-allocation");
                $.ajax({
                    url:  '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee_sms_alert_send.php',
                    type:"POST",
                    dataType: 'json',
                    data:$.param(url_data_obj),
                    success:function(data_process){
                        //console.log(data_process);
                        close_right_panel();
                        if(typeof data_process.message !== 'undefined'){
                            $('#left_message_wraper').html(data_process.message);
                            $('.main-left').animate({
                                scrollTop: $('#left_message_wraper').offset().top
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader("#sms-for-emp-allocation");
                });
            }

            function manageSmsAllotmentConf(){
                if($('#sms-for-emp-allocation input:checkbox[name=chk_confirmation_allotment]:checked').prop('checked')){
                    $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').attr('disabled', 'disabled');
                    $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').prop('checked', false);
                    $('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]').prop('checked', true);
                }else
                    $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').attr('disabled', false);

            }
        <?php }?>
    
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['swap']==1){?>
            function process_swap_switch_2_slots(ids){
                if(ids != ''){
                    var process_details_obj = { 'ids': ids,
                                            'action': 'swap_switch_2_slots'};

                    wrapLoader("#main_content #external_wrapper");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_month.php",
                        type:"POST",
                        dataType: 'json',
                        data:process_details_obj,
                        success:function(data_process){
                            if(data_process.result !== 'undefined' && data_process.result){
                                reload_content();
                            }
                            else if(data_process.message !== undefined && data_process.message != ''){
                                $('#left_message_wraper').html(data_process.message);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    })
                    .always(function(data) {
                        uwrapLoader("#main_content #external_wrapper");
                    });
                }
            }
            
            function process_swap_copy_first_slot(ids){
                if(ids != ''){
                    var slot_details_obj = { 'id': ids,
                                    'action': 'swap'
                        };

                    wrapLoader("#main_content #external_wrapper");
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php",
                        type:"POST",
                        data:slot_details_obj,
                        success:function(data){
                            reload_content();
                        }
                    }).always(function(data) { 
                        uwrapLoader("#main_content #external_wrapper");
                    });
                }
            }
            
            function process_swap_past_with_second_slot(ids){
                if(ids != ''){
                    var slot_data = $('#week-slot-calender #slot_thread_'+ids).find('.slot_details_hub');
                    var slot_id         = ids;
                    var slot_date       = slot_data.attr('data-date');
                    var slot_customer   = slot_data.attr('data-customer-id');
                    var slot_employee   = slot_data.attr('data-employee-id');

                    var atl_req_data = 'date='+slot_date+'&employee='+slot_employee+'&customer='+slot_customer+
                                '&id='+slot_id+'&action=swap&swap=1&type_check=15';

                    var slot_details_obj = 'id='+slot_id+'&date='+slot_date+'&customer='+slot_customer+'&action=swap&swap=1';
                    var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_alloc_action_slot.php?' + slot_details_obj;

                    check_atl_warning(atl_req_data, function(this_url){
                                        wrapLoader('#main_content #external_wrapper');
                                        $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader('#main_content #external_wrapper'); reload_content(); });
                                    }, process_url, '#main_content #external_wrapper');
                }
            }
        <?php }?>

        function get_customer_contract_details(){
             $("#customer-contract-popup").toggleClass('hide');
             $.ajax({
                type : 'post',
                url : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_contract_on_gdschema_customer.php',
                data : { customer : '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',year_week:'<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
', action : 'get_contract_details_gdschema_customer'},
                success :function(data){
                    data = JSON.parse(data);
                    var html = '';
                    html += '<div class="row-fluid no-print" >\n\
                                <div class="span12" >';

                    if(data.work_hours.fk.week != 0 || data.contract_hours.fk.week != 0 || data.work_hours.kn.week != 0 || data.contract_hours.kn.week != 0){
                        html += '<table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 1px;">\n\
                                <thead>\n\
                                    <tr>\n\
                                        <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_weekly_hours'];?>
</th>';
                                        if(data.work_hours.fk.week != 0 || data.contract_hours.fk.week != 0){
                                            html += '<th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
 '+data.work_hours.fk.week+'h ('+data.contract_hours.fk.week+'h)</th>';
                                        }
                                        if(data.work_hours.kn.week != 0 || data.contract_hours.kn.week != 0){
                                            html += '<th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
 '+data.work_hours.kn.week+'h ('+data.contract_hours.kn.week+'h)</th>';
                                        }
                        html +=         ' </tr>\n\
                                    </thead>\n\
                                </table>';    
                    }

                    if(data.work_hours.fk.month && data.work_hours.kn.month && (data.work_hours.fk.month != 0 || data.contract_hours.fk.month != 0 || data.work_hours.kn.month != 0 && data.contract_hours.kn.month != 0)){
                        html += '<table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 1px;">\n\
                                <thead>\n\
                                    <tr>\n\
                                        <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_monthly_hours'];?>
</th>';
                                        if(data.work_hours.fk.month != 0 || data.contract_hours.fk.month != 0){
                                            html += '<th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
 '+data.work_hours.fk.month+'h ('+data.contract_hours.fk.month+'h)</th>'
                                        }
                                        if(data.work_hours.kn.month != 0 || data.contract_hours.kn.month != 0){
                                            html += '<th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
 '+data.work_hours.kn.month+'h ('+data.contract_hours.kn.month+'h)</th> ';
                                        }
                        html +=         ' </tr>\n\
                                    </thead>\n\
                                </table>';
                    }

                    if(data.contract_period_hours.fk.length > 0 || data.contract_period_hours.kn.length  > 0){
                        html += '<table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 0px;">\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_type'];?>
</th> \n\
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_period_gd_schema'];?>
</th>\n\
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['contract_period_hours'];?>
</th> \n\
                                            <th data-hide="phone,tablet"  class="table-col-center" style=" background:#fff; color:#7C7C7C;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_hour'];?>
 </th>\n\
                                        </tr>\n\
                                    </thead>';
                        html += '<tbody>';
                    }
                    //     
                    data.contract_period_hours.fk.forEach(function(entry) {
                        html += '<tr>\n\
                                    <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
</td>\n\
                                    <td  class="table-col-center">'+entry.period_from+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
 '+entry.period_to+'</td>\n\
                                    <td  class="table-col-center">'+entry.work_hours+'h ('+entry.contract_hours+'h)\n\
                                         '+(entry.contract_hours - entry.work_hours > 0 ? '(<span style="color: green;">'+(entry.contract_hours - entry.work_hours).toFixed(2)+'h</span>)' : '(<span style="color: red;">'+entry.contract_hours - entry.work_hours+'h</span>)') +'\n\
                                    </td>\n\
                                     <td  class="table-col-center">'+(entry.unmanned_hour != null ? entry.unmanned_hour+'h' : '')+'</td>\n\
                                </tr>';
                    });

                    data.contract_period_hours.kn.forEach(function(entry) {
                        html += '<tr>\n\
                                    <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</td>\n\
                                    <td  class="table-col-center">'+entry.period_from+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
 '+entry.period_to+'</td>\n\
                                    <td  class="table-col-center">'+entry.work_hours+'h ('+entry.contract_hours+'h)\n\
                                         '+(entry.contract_hours - entry.work_hours > 0 ? '(<span style="color: green;">'+(entry.contract_hours - entry.work_hours).toFixed(2)+'h</span>)' : '(<span style="color: red;">'+(entry.contract_hours - entry.work_hours).toFixed(2)+'h</span>)') +'\n\
                                     </td>\n\
                                    <td  class="table-col-center">'+(entry.unmanned_hour != null ? entry.unmanned_hour+'h' : '')+'</td>\n\
                                </tr>';
                    });

                    data.contract_period_hours.tu.forEach(function(entry) {
                        html += '<tr>\n\
                                    <td  class="table-col-center"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>
</td>\n\
                                    <td  class="table-col-center">'+entry.period_from+' <?php echo $_smarty_tpl->tpl_vars['translate']->value['to_time'];?>
 '+entry.period_to+'</td>\n\
                                    <td  class="table-col-center">'+entry.work_hours+'h ('+entry.contract_hours+')\n\
                                        '+(entry.contract_hours - entry.work_hours > 0 ? '(<span style="color: green;">'+(entry.contract_hours - entry.work_hours)+'h</span>)' : '(<span style="color: red;">'+entry.contract_hours - entry.work_hours+'h</span>)') +'\n\
                                    </td>  \n\
                                    <td  class="table-col-center">'+(entry.unmanned_hour != null ? entry.unmanned_hour+'h' : '')+'</td>\n\
                                </tr>';
                    });
                    

                    if(data.contract_exist_flag === true){
                        $('#all_contract_details').html(html);
                    }else{
                        var html = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_time_to_show'];?>
';
                                $('#all_contract_details').html(html);
                    }


                }
             });
        }

        $("#close-customer-contract-popup").click(function() {
             $("#customer-contract-popup").addClass('hide');
        });



    </script> 
    

    <script>
        $(document).ready(function() {
            $('#tabs2').scrollTabs();   //week number sroll 
            
            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
            });
            
            $(".btn-manage").click(function() {
			
                close_right_panel();
                show_right_panel();
                $(".manage-form").removeClass('hide');
                
                getAfterDates('<?php echo $_smarty_tpl->tpl_vars['no_of_weeks']->value;?>
');
				
					$('html, body').animate({
				scrollTop: $(".main-right").offset().top
				}, 3000);
				
     
			
			
            });
            $(".btn-cancel, #slot-confirm-buttons, .slot-confirm-buttons, #slot-cancell-buttons").click(function() {
                close_right_panel();
            });
            
            /*$(".customer-name").mouseover(function() {
                $(".customer-info").toggle(200);
            });

            $(".customer-name").mouseout(function() {
                $(".customer-info").toggle(500);
            });*/
            // $(".show_contract_btn").click(function() {
            //     $(".customer-info").toggle(500);
            // });
            // $(".show_contract_btn").click(function() {
            //     $("#customer-contract-popup").show();
            // });

            $(".show_contract_btn").mouseover(function() {
                $(".customer-info").show();
            });

            $(".show_contract_btn").mouseout(function() {
                $(".customer-info").hide();
            }); 
            

			
		
			
        });
    </script>


    <script>
        $(document).ready(function() {
            //$('.success, .message, .fail, .error').delay(10000).fadeOut();
            //$('#accordion2 a').click(function() {
            
            $('#accordion2').on('show', function (e) {
                if(!$('#check1').hasClass('loaded')){
                    $('#check1').css('min-height', '140px');
                    wrapLoader('#check1');
                    $('#check1').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_employee_work_summary.php?year_week=<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', function(response, status, xhr) { $('#check1').css('min-height', ''); uwrapLoader('#check1'); $('#check1').addClass('loaded'); });
                }
                $.cookie("opened_weekly_top_widget", true, { path: '/', expires: 7});
            }).on('hide', function (e) {
                $.removeCookie("opened_weekly_top_widget", { path: '/' });
            });
                               
            
            $('#deltab').click(function(){
                getProcessEmployees('del_list');
            });
            
            $('#reptab').click(function(){
                getProcessEmployees('rep_list');
            });
            
            $('#atltab').click(function(){
                getProcessEmployeesAtl('atl_list');
            });
            
            $('.manage-form #repl_infocus').change(function(){
                loadEmployee();
            });
        $('#rep_list').delegate('.rep_radio', 'change', function(){
            if($('#replace_date_from').val() == '' || $('#replace_date_to').val() == ''){
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_dates_before_employee'];?>
');
            }
        });
        $("#replace_date_from, #replace_date_to").datepicker({
                dateFormat: "yy-mm-dd",
                autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
                onClose: function(){
                            getProcessEmployees1('rep_list');
                        }
        });
        $("#leave_date_day, #leave_date_from, #leave_date_to").datepicker({
                dateFormat: "yy-mm-dd",
                autoclose: true, weekStart: 1, calendarWeeks: true, language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
        });
         
        
        $("#replace_date_from").datepicker('setDate', '<?php echo $_smarty_tpl->tpl_vars['week_start_date']->value;?>
');
        $("#replace_date_to").datepicker('setDate', '<?php echo $_smarty_tpl->tpl_vars['week_end_date']->value;?>
');
        });
        function getAfterDates(max_week_number) {
            var year_week = '<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
';
            var year = parseInt(year_week.substring(0, 4), 10);
            var to_week = parseInt($("#from_wk").val()) + parseInt($("#no_of_wks").val());
            if (to_week > max_week_number) {
                to_week = to_week - max_week_number;
                year = year + 1;
            }
            $('#to_wk').find('option').remove();
            for (i = 0; i < 40; i++) {
                if (to_week > max_week_number) {
                    to_week = 1;
                    year = year + 1;
                }
                $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#to_wk");
                to_week = to_week + 1;
            }
            wrapLoader("#copy_list");

            $('#copy_list').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_employees.php?from_week=' + $('#from_wk').val() + '&no_of_weeks=' + $('#no_of_wks').val() + '&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['username'];?>
', function(response, status, xhr) {
                uwrapLoader("#copy_list");
            });


        }

        function display_unmammed(val) {
            if (<?php echo $_smarty_tpl->tpl_vars['in_user_role']->value;?>
 == 4) {
                if (val == 1) {
                    $('#div_chk_unmanned').show();
                    $('#copy_list').show();
                } else {
                    $('#copy_list').hide();
                    $('#div_chk_unmanned').hide();
                }
            }
        }
        
        function  getProcessEmployeesAtl(div_id) {
            wrapLoader("#" + div_id);
            $('#' + div_id).load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_employees.php?year_month=' + $('#year_month').val() + '&user=<?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['username'];?>
&type=' + div_id, function(response, status, xhr) {
                uwrapLoader("#" + div_id);
            });
        }
        function  getProcessEmployees(div_id) {
            wrapLoader("#" + div_id);
            $('#' + div_id).load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_employees.php?from_week=' + $('#from_wk_del').val() + '&no_of_weeks=' + $('#no_of_wks_del').val() + '&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['username'];?>
&type=' + div_id, function(response, status, xhr) {
                uwrapLoader("#" + div_id);
                check_is_employee_checked();
            });
        }
        function  getProcessEmployees1(div_id) {

            if ($('#replace_date_from').val() != '' && $('#replace_date_to').val() != '') {
                wrapLoader("#" + div_id);
                $('#' + div_id).load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_employees.php?start_date=' + $('#replace_date_from').val() + '&end_date=' + $('#replace_date_to').val() + '&user=<?php echo $_smarty_tpl->tpl_vars['in_user_details']->value['username'];?>
&type=rep', function(response, status, xhr) {
                    uwrapLoader("#" + div_id);
                    $('#rep_list_emp').html('');
                });
            }
        }

        function empCheckAll() {
            //alert('hi');
            if (document.frm_copy.all_check.checked) {
                $('input:checkbox.emp_check').each(function() {
                    $(this).attr('checked', true);
                });
            } else {
                $('input:checkbox.emp_check').each(function() {
                    $(this).attr('checked', false);
                });
            }
        }
        function empCheckAll1() {
            if (document.frm_delete.all_check1.checked) {
                $('input:checkbox.emp_check1').each(function() {
                    $(this).attr('checked', true);
                });
            } else {
                $('input:checkbox.emp_check1').each(function() {
                    $(this).attr('checked', false);
                });
            }
            check_is_employee_checked();
        }
        function empCheckAll2() {

            if (document.frm_atl.all_check2.checked) {
                $('input:checkbox.emp_check2').each(function() {
                    $(this).attr('checked', true);
                });
            } else {
                $('input:checkbox.emp_check2').each(function() {
                    $(this).attr('checked', false);
                });
            }
        }
        
        
        function save_atl() {
            var emp = "";
            var values = $('input:checkbox:checked.emp_check2').map(function() {
                return this.value;
            }).get();

            for (var i = 0; i < values.length; i++) {
                emp += values[i] + "-";
            }

            if (emp == '' && ($('#infocus').attr("checked") == "checked" || ($('#outfocus').attr("checked") == "checked" && <?php echo $_smarty_tpl->tpl_vars['in_user_role']->value;?>
 != 4))) {
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
            }else{

                var months=new Array(); 
                months[0] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_1'];?>
';
                months[1] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_2'];?>
';
                months[2] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_3'];?>
';
                months[3] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_4'];?>
';
                months[4] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_5'];?>
';
                months[5] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_6'];?>
';
                months[6] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_7'];?>
';
                months[7] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_8'];?>
';
                months[8] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_9'];?>
';
                months[9] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_10'];?>
';
                months[10] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_11'];?>
';
                months[11] = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['month_12'];?>
';


                var month_num = parseInt(($('#year_month').val()).substring(5));

                txt = '<?php echo $_smarty_tpl->tpl_vars['translate']->value['atl_check'];?>
' + '<span style="padding-left:10px;">' + ($('#year_month').val()).substring(0,4) + "-" + months[month_num-1] + '</span>';
                $('#process_title').html(txt);
                wrapLoader("div.selected");
                $('#inner_tab_contnt').hide();
                $('#atl_result').show();
                $('#atl_result').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?year_month=' + $('#year_month').val() + '&employees=' + emp + '&type=atl&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
', function(response, status, xhr) {
                    uwrapLoader("div.selected");
                    //$('#chk_status').val('1');
                });
                $('#atl_buttons').show();
        
            }
        }
        
        function saveLeave(base_url) {
            //    $('#loading').show();
            //    $('#loading #load_anime').html('<img src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/ajax-loader.gif" />');
            var employee = $('#leave_form #leave_employee').val();
            if (employee != '') {

                var leave_type = $('#leave_form #leave_type_val').val();
                if (leave_type != '') {
                    
                    var leave_type_day = $('#leave_form #leave_type_day').val();
                    var slot_id = $('#slot_id').val();
                    
                    if (leave_type_day == '1') {
                        var leave_date_from = $('#leave_form #leave_date_from').val();
                        var leave_date_to = $('#leave_form #leave_date_to').val();
                        if (leave_date_from != '' && leave_date_to != '') {
        

                            var leave_comments = $('#leave_form #leave_comments_date').val();
                            var date1 = NewDate(leave_date_from);
                            var date2 = NewDate(leave_date_to);
                            if (date1 <= date2) {

                                var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&date_from=' + leave_date_from + '&date_to=' + leave_date_to + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&comments=' + leave_comments + "&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_week']->value;?>
" + "&act=process";
                                var a = base_url + 'gdschema_process_main.php?type=leave&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
';

                                wrapLoader(".manage-form");
                                $('#main_process_save').load(url, function(response, status, xhr) {
                                    uwrapLoader("div.selected");
                                    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1);
                                });
                                //loadContent(a);

                            } else {

                                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_the_from_and_to_date'];?>
');
                            }
                        } else {

                            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
');
                        }
                    } else if (leave_type_day == '2') {

                        var leave_date_day = $('#leave_form #leave_date_day').val();
                        var leave_time_from_main = $('#leave_form #leave_time_from_main').val();
                        var leave_time_to_main = $('#leave_form #leave_time_to_main').val();
                        var leave_comments = $('#leave_form #leave_comments').val();
                        if (leave_date_day != '' && leave_time_from_main != '' && leave_time_to_main != '') {


                            var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&leave_date=' + leave_date_day + '&leave_range_from=' + leave_time_from_main + '&leave_range_to=' + leave_time_to_main + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&comments=' + leave_comments + "&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_week']->value;?>
" + "&act=process";
                            var a = base_url + 'gdschema_process_main.php?type=leave&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
';

                            wrapLoader(".manage-form");
                            $('#main_process_save').load(url, function(response, status, xhr) {
                                uwrapLoader("div.selected");
                                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1);
                            });

                            //loadContent(a);

                        } else {

                            alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
');
                            //                    $('#loading').hide();
                        }
                    }
                } else {

                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_a_leave_type'];?>
');
                    //            $('#loading').hide();
                }
            } else {

                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
                //        $('#loading').hide();
            }
        }
        
        function save_replace() {

            var in_focus = 0;
            if ($('#replace_date_from').val() != '' && $('#replace_date_to').val() != '') {

                var values = $('input:radio:checked.rep_radio').map(function() {
                    return this.value;
                }).get();


                var emp = '';
                if (values.length)
                    emp = values[0];

                if (emp == '') {
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
                    //            $('#loading').hide();
                } else {
                    var emp_rep = "";
                    var values = $('input:radio:checked.rep_radio_rep').map(function() {
                        return this.value;
                    }).get();

                    if (values.length)
                        emp_rep = values[0];


                    if (emp_rep == '') {
                        alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_replace_employee'];?>
');
                        //                $('#loading').hide();
                    } else {
                        if ($('.manage-form #repl_infocus').attr("checked") == "checked")
                            in_focus = 1;

                        wrapLoader(".manage-form");
                        $('#main_process_save').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?from_date=' + $('#replace_date_from').val() + '&to_date=' + $('#replace_date_to').val() + '&employee=' + emp + '&employee_rep=' + emp_rep + '&type=replace&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
&focus=' + in_focus, function(response, status, xhr) {
                            //uwrapLoader("manage-form");
                            navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1);
                            
                        });
                        //$('#loading').hide();
                    }
                }

            }
            else {
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['please_select_one_date'];?>
');
                //        $('#loading').hide();
            }
        }

        function save_delete() {
            var days = "";
            var in_focus = 1;
            unmanned = 0;
            if ($('#unmanned_del').attr("checked") == "checked")
                unmanned = 1;
            for (var i = 0; i < document.frm_delete.days.length; i++) {
                if (document.frm_delete.days[i].checked)
                    days += document.frm_delete.days[i].value + '-';
            }
            if (days == '') {
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_days'];?>
');
                //            $('#loading').hide();
            } else {
                var emp = "";
                var values = $('input:checkbox:checked.emp_check1').map(function() {
                    return this.value;
                }).get();

                for (var i = 0; i < values.length; i++) {
                    emp += values[i] + "-";
                }

                if (emp == '' && ($('#infocus').attr("checked") == "checked" || ($('#outfocus').attr("checked") == "checked" && <?php echo $_smarty_tpl->tpl_vars['in_user_role']->value;?>
 != 4))) {
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
                    //                $('#loading').hide();
                } else {
                    if ($('#outfocus').attr("checked") == "checked")
                        in_focus = 0;

                    wrapLoader(".manage-form");
                    $('#main_process_save').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?from_week=' + $('#from_wk_del').val() + '&no_of_weeks=' + $('#no_of_wks_del').val() + '&employees=' + emp + '&days=' + days + '&type=delet&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
&focus=' + in_focus + '&unmanned=' + unmanned, function(response, status, xhr) {
                        uwrapLoader(".manage-form");
                        navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/8/', 1);
                    });
                    //$('#loading').hide();
                }
            }
        }

        function save_copy() {
            var days = "";
            var with_user = 1;
            var unmanned = 0;
            if ($('#chk_unmanned').attr("checked") == "checked")
                unmanned = 1;
            for (var i = 0; i < document.frm_copy.days.length; i++) {
                if (document.frm_copy.days[i].checked)
                    days += document.frm_copy.days[i].value + '-';
            }
            if (days == '') {
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_days'];?>
');
            } else {
                var emp = "";
                var values = $('input:checkbox:checked.emp_check').map(function() {
                    return this.value;
                }).get();
                for (var i = 0; i < values.length; i++) {
                    emp += values[i] + "-";
                }
                if (emp == '' && unmanned == 0) {
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_employee'];?>
');
                } else {
                    
                    if ($('#withoutuser').attr("checked") == "checked")
                        with_user = 0;
                    var additional_urldata = 'from_week=' + $('#from_wk').val() + '&no_of_weeks=' + $('#no_of_wks').val() + '&to_week=' + $('#to_wk').val() + '&no_of_times=' + $('#no_of_times').val() + '&employees=' + emp + '&days=' + days + '&type=copy&cur_week=<?php echo $_smarty_tpl->tpl_vars['cur_year_week']->value;?>
&user=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
&with_user=' + with_user + '&unmanned=' + unmanned;
                    if (with_user == 1) {
                        var atl_req_data = additional_urldata + '&type_check=12';
                        var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?' + additional_urldata;
                        check_atl_warning(atl_req_data, function(this_url) {
                            wrapLoader(".manage-form");
                           
                            $('#main_process_save').load(this_url, function(response, status, xhr) {
                                uwrapLoader(".manage-form");
                                close_right_panel();
                            });
                        }, process_url, '.pannel_holder div.selected');
                    } else {
                        wrapLoader(".manage-form");
                        $('#main_process_save').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?' + additional_urldata, function(response, status, xhr) {
                            uwrapLoader(".manage-form");
                            close_right_panel();
                        });
                    }
                }
            }

        }

        function check_is_employee_checked(){
            var values = $('.selected #del_list #copy_list input:checkbox:checked.emp_check1').map(function () {
                            return this.value;
            }).get();
            if($.isEmptyObject(values))
                $('#outfocus').parent().find('label').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_process_delete'];?>
');
            else
                $('#outfocus').parent().find('label').html('<?php echo $_smarty_tpl->tpl_vars['translate']->value['schedule'];?>
');
        }
        
        function loadEmployee() {

            if($('.tabs_holder').find('.selected').attr('data-tab') == 'replace'){

                var dfrom = $('#replace_date_from').val();
                var dto = $('#replace_date_to').val();

                var values = $('input:radio:checked.rep_radio').map(function() {
                    return this.value;
                }).get();
                var emp = values[0];

                var customer_checked = $('.manage-form input:checkbox[name=repl_infocus]:checked').val();
                var is_customer_checked = 0;
                if (customer_checked) is_customer_checked = 1;

                if(dfrom != '' && dto != '' && emp != '' && typeof emp != 'undefined'){
                    wrapLoader("#rep_list_emp");
                    $('#rep_list_emp').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?start_date=' + dfrom + '&end_date=' + dto + '&selected_emp=' + emp + '&sel_customer=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
&is_customer_checked='+is_customer_checked+'&type=rep_emp_load', function(response, status, xhr) {
                        uwrapLoader("#rep_list_emp");
                    });

                }
            }
            else{
                var values = $('input:radio:checked.rep_radio').map(function() {
                    return this.value;
                }).get();
                var emp = values[0];

                wrapLoader("#rep_list_emp");
                $('#rep_list_emp').load('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_process_main.php?employee=<?php echo $_smarty_tpl->tpl_vars['in_user']->value;?>
&type=load', function(response, status, xhr) {
                    uwrapLoader("#rep_list_emp");
                });
            }
        }
        function setLeaveType(val) {
            $('#leave_form #leave_type_val').val(val);
        }
        
        function NewDate(temp){
            var str=temp.split('-');
            var date=new Date();
            date.setUTCFullYear(str[0], str[1]-1, str[2]);
            date.setUTCHours(0, 0, 0, 0);
            return date;
        }
        
        function leaveTab(tab) {
            if (tab == 'time') {
                $('#leave_form #leave_type_day').val(2);
            } else {
                $('#leave_form #leave_type_day').val(1);
            }
        }
    </script>
    

<?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.shortcuts.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.shortcuts.min.js"></script>
    <script type="text/javascript">
        $.Shortcuts.stop();
        $.Shortcuts.remove({
            mask: 'Ctrl+C'
        });
        $.Shortcuts.remove({
            mask: 'Ctrl+V'
        });
        $.Shortcuts.add({
            type: 'down',
            mask: 'Ctrl+C',
            handler: copyWeeklySlot
        });
        $.Shortcuts.add({
            type: 'down',
            mask: 'Ctrl+V',
            handler: pasteSlot
        });
        $.Shortcuts.start();//commented to stop ctrl c and ctrl v
    </script>
<?php }?>
   
<?php }} ?>