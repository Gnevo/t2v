<?php /* Smarty version Smarty-3.1.8, created on 2021-01-11 12:53:19
         compiled from "/home/time2view/public_html/cirrus/templates/gdschema_month_apply_update_schedule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4146369195ffc4a3fe91d90-11722667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fd16c3cf2002de46288fa77896cc4911b90c55a' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/gdschema_month_apply_update_schedule.tpl',
      1 => 1566035960,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4146369195ffc4a3fe91d90-11722667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'flag_cust_access' => 0,
    'message' => 0,
    'template_name' => 0,
    'sort_by_name' => 0,
    'customer_detail' => 0,
    'schedule_id' => 0,
    'customer' => 0,
    'year' => 0,
    'month' => 0,
    'translate' => 0,
    'month_label' => 0,
    'prv_year' => 0,
    'prv_month' => 0,
    'today_year' => 0,
    'today_month' => 0,
    'next_year' => 0,
    'next_month' => 0,
    'weeks' => 0,
    'week_day' => 0,
    'month_weeks' => 0,
    'month_week' => 0,
    'today_date' => 0,
    'login_user_role' => 0,
    'privileges_gd' => 0,
    'slot' => 0,
    'login_user' => 0,
    'customer_name' => 0,
    'no_of_weeks' => 0,
    'customer_details' => 0,
    'selected_customer' => 0,
    'privileges_mc' => 0,
    'leave_types' => 0,
    'leave_type_key' => 0,
    'leave_type' => 0,
    'righclick_employees_for_goto' => 0,
    'selected_year' => 0,
    'selected_month' => 0,
    'empl' => 0,
    'search_customers' => 0,
    'custl' => 0,
    'translate_json' => 0,
    'lang' => 0,
    'swap_copied_slot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5ffc4a40a0ff22_54124913',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffc4a40a0ff22_54124913')) {function content_5ffc4a40a0ff22_54124913($_smarty_tpl) {?>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/contextMenu.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/print.css" type="text/css" />
    <style type="text/css">
        .cursor_hand{ cursor: pointer; }
        .font-bold{ font-weight:bold; }
        .col_numeric{ text-align: right; }
        .col_left_align{ text-align: left; }
        .overflow_contract { color: red; }
        .underflow_contract { color: blue; }
        .template_label { min-height: 0px !important;}
        #available_memory_slots .child-slots, #available_memory_slots .remove-memory-slot { cursor: pointer;}
        #right_click_action_options .panel-title { margin-bottom: 0px !important; border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;}
        .time_slots_theme .close_btn_wrpr{ height: 13px;position: relative;right: -5px;top: -14px;}
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-leave,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-candg,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-candg-accept,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-pm,
        #monthlyviewtbl.show_unmanned_slot_only .slot.slot-theme-complete{ display: none;}
        .slot_bountery{ position: relative; }
        .small-icon { width: 12px;
            height: 12px !important;
            position: absolute;
            right: 0;
            bottom: 0;
            background-size: 27px !important;
            background-position: 0 -103px !important;}

        @media screen and (max-width: 767px){ 

         .small-icon { width: 7px;
min-height: 1px !important;
background-size: 20px !important;
background-position: 0px -75px !important;
right: 1px;
bottom: 0px; }

            .table-responsive { height: auto !important; }
            .slot { font-size: 6px; }
            .slot-calender thead th:first-child { /*display: none !important;*/ }
            .notification-info-customer {
                white-space: normal !important; margin-left: 0 !important; text-overflow:clip !important; overflow: hidden !important;line-height: 8px;
            }
            .table-responsive-clear { width: 100% !important; overflow: hidden !important;  }
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
            .spn-slot-emp-name{ width: 80%; float: left;}
        }

        .week-slottype-employe {  position: relative; overflow: hidden;}
        .visible-only-small-devices { display: none ; }
        .spn-slot-emp-name{ width: 100%;}
        @media print{
            /*#schedule_det{ width: 100% !important; }*/
            /*#schedule_det .template-customize-wrpr{ background-color: yellow !important; }*/
            .table-responsive { height: auto !important;  }
            .table-responsive-clear {
                 width: 100% !important; 
                 overflow: visible !important; 
                 display:table !important;
                table-layout:auto !important;
            }
            .main-left { width: 100% !important; height: auto; overflow: visible !important; display:table !important;
                table-layout:auto !important; }
            /*#navigation-main-table, .fixed-scrolling-tbl { width: 100% !important; }*/
            .spn-slot-emp-name {
                width: 80% !important;
                float: left;
            }
            .slot {
                /*font-size: 6px;*/
            }
            #schedule_det, body
            {
                display:table !important;
                table-layout:auto !important;
                /*padding-top:2.5cm;*/
                /*padding-bottom:2.5cm;*/
                height:auto;
                width: 98% !important;
                /*margin: -.5in; */
                /*mso-header-margin:.1in; */
                /*mso-footer-margin:.1in; */
            }
            #monthlyviewtbl, .slot-calender { width: 100% !important; display:table !important; table-layout:auto !important; min-width: 50px; }
            /*#monthlyviewtbl td.monthly_day { width: 60px !important;  }*/
            .slot-calender colgroup, #monthlyviewtbl colgroup { display: none;}
            .slot-calender td.week_no_td, #monthlyviewtbl td.week_no_td { width: 30px !important;}
            /*.floatThead-container { display: none; }*/
            .table { table-layout:auto !important; }
        }
        #count-info-switch .tu-marker i{ display: block; vertical-align: middle; top: 5px; position: relative; line-height: 2px; }
        #count-info-switch .tu-marker i:before{ color: red; font-size: 10px; }
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
    <div class="row-fluid" id="gdmonth_wraper">
         <div class="span12 main-left">
            <div id="div_alloc_action" class='hide'></div>
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
                <div id="schedule_det">
                <div class="row-fluid theme-add-wrpr">
                <div class="span12 template-customize-wrpr" style="margin-bottom:10px;">
                    <div style="" class="panel panel-default">
                        <div style="" class="panel-heading">
                            <h4  class="panel-title clearfix">
                                <?php echo $_smarty_tpl->tpl_vars['template_name']->value;?>
 
                               
                                    <i style="margin-left: 3%;"><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']);?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo (($_smarty_tpl->tpl_vars['customer_detail']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer_detail']->value['first_name']);?>
<?php }?></i>
                              
                                <ul class="pull-right  no-print">

                                  <li onclick="reload_content('<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
');"><span class="icon-refresh"></span><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['refresh'];?>
</span></a></li>
                                  <li onclick="printSchedule();"><i class="icon-print"></i><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a></li>
                                  <li onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
/',1);"><i class="icon-arrow-left"></i><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</span></a></li>

                                </ul>
                            </h4>
                        </div>
                    </div>
                </div>
                </div>
                <!-- table starting -->
                <div class="row-fluid">
                <div class="span12">
                    <table style="margin:0;" class="table table-bordered table-white table-responsive table-primary table-Anställda template_top">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th class="table-col-center no-print" style="border: 0 none;"><span class="btn btn-block btn-default span12 template_top"><i class="icon-calendar monthPicker" data-date="<?php echo (($_smarty_tpl->tpl_vars['year']->value).('-')).($_smarty_tpl->tpl_vars['month']->value);?>
" data-date-format="yyyy-mm" ></i></span></th>
                                <th class="table-col-center no-print" style="width:30px; border: 0 none;"></th>
                                <th colspan="4" style="border:0;" class="table-col-center"><span class="btn btn-block btn-default span12 template_top"><span class="cur_month_header" data-year-month="<?php echo (($_smarty_tpl->tpl_vars['year']->value).('|')).($_smarty_tpl->tpl_vars['month']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['month_label']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</span></span></th>
                                <th class="table-col-center no-print" style="border: 0 none;"><span class="btn no-print btn-default template_top" id="add-slots"  title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tooltip_new_slot'];?>
"><i class="icon-plus"></i></span></th>
                                <th class="table-col-center no-print">
                                    <span class="btn btn-block btn-default span12 template_top no-print">
                                        <div class="squaredThree monthly_control">
                                            <input type="checkbox" name="all_check" id="all_check" class="hide-small-devices" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['check_all'];?>
" />
                                        </div>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <thead class="no-print">
                            <tr>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12 template_top" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['year']->value-1;?>
&month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);"  title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_previous_year'];?>
"><<</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12 template_top" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['prv_year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['prv_month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_previous_month'];?>
"><</span></th>
                                <th class="table-col-center" colspan="4"><span class="btn btn-block btn-default span12 calender-today template_top" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['today_year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['today_month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_todays_month'];?>
"><i></i><?php echo $_smarty_tpl->tpl_vars['translate']->value['today'];?>
</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12 template_top" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['next_year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_next_month'];?>
">></span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12 template_top" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['year']->value+1;?>
&month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_next_year'];?>
">>></span></th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-responsive table-responsive-clear fixed-scrolling-tbl" style="height: 450px;">
                    <table class="table table-bordered table-white table-responsive table-primary table-Anställda template_top clearfix slot-calender" id="monthlyviewtbl">
                        <thead>
                            <tr class="">
                                <th  style=" width:30px; border-radius: 0px;" class="table-col-center clearfix">V</th>
                                <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                                    <th class="table-col-center clearfix"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['week_day']->value['label']];?>
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
                                <tr class="gradeX expandable week_row "  style="height: 150px;">
                                    <td class="week_no_td" data-yearweek='<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
|<?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
' style="background:linear-gradient(to bottom, rgba(220, 225, 227, 1) 0%, rgba(221, 228, 230, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;">
                                        <ul class="calender-col-header span12" id="toggle-view" style="border-bottom: none; background: none;">
                                            <li class="no-print hide-small-devices" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_mini_maxi_week'];?>
"><input class="btn-mini btn-default btn-collapse-table-row" type="button" value="-" style="background-color: #cfd2d7;" /></li>
                                            <li class=" cursor_hand"><?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
</li>
                                            <li class="span3 chaeckbox-day pull-right chk_all_week_slot_ctrl no-print hide-small-devices"><input type="checkbox" class="all_check_week" name="all_check_week"></li>

                                        </ul>
                                        <ul style="bottom:0 !important;"></ul>
                                    </td>
                                     <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_week']->value['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['week_day']->value['type']=='old'){?>
                                            <td  data-date='<?php echo $_smarty_tpl->tpl_vars['week_day']->value['date'];?>
'></td>
                                        <?php }else{ ?>
                                            <td class="monthly_day <?php if ($_smarty_tpl->tpl_vars['week_day']->value['date']==$_smarty_tpl->tpl_vars['today_date']->value){?> selected_date<?php }?> clearfix" data-date='<?php echo $_smarty_tpl->tpl_vars['week_day']->value['date'];?>
' style="padding:2px;">
                                                <ul class="template_center calender-col-header monthlyslot_date span12  clearfix" >
                                                    <li class=" cursor_hand" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['enter_into_day_slots'];?>
"><?php echo $_smarty_tpl->tpl_vars['week_day']->value['day'];?>
</li>
                                                    <li class="span3 chaeckbox-day pull-right chk_all_day_slot_ctrl hide-small-devices"><input type="checkbox" class="all_check_day" name="all_check_day" /></li>
                                                </ul>
                                                <div class="monthly_strips clearfix">
                                                    <?php  $_smarty_tpl->tpl_vars['slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['week_day']->value['slots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot']->key => $_smarty_tpl->tpl_vars['slot']->value){
$_smarty_tpl->tpl_vars['slot']->_loop = true;
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3||($_smarty_tpl->tpl_vars['login_user_role']->value==3&&($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==0||($_smarty_tpl->tpl_vars['privileges_gd']->value['not_show_employees']==1&&$_smarty_tpl->tpl_vars['slot']->value['employee']==$_smarty_tpl->tpl_vars['login_user']->value)))){?>
                                                            <span class="collapse-slot clearfix" id="slot_thread_<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
">
                                                                <div class="slot monthlyslotview span12 <?php if ($_smarty_tpl->tpl_vars['slot']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==4){?>slot-theme-candg<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==0||$_smarty_tpl->tpl_vars['slot']->value['status']==3){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==1&&$_smarty_tpl->tpl_vars['slot']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==10){?>slot-theme-pm<?php }else{ ?>slot-theme-complete<?php }?> <?php if ($_smarty_tpl->tpl_vars['slot']->value['signed']==1){?>signed_slot<?php }?>"  
                                                                     onmouseover="tooltip.pop(this, '#slot_details_<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
', { position:1, offsetX:-20, effect:'slade' });" data-slot-id="<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
" >
                                                                    
                                                                     <input type="hidden" class="slot_details_hub" 
                                                                                data-tid=<?php echo $_smarty_tpl->tpl_vars['slot']->value['tid'];?>
 
                                                                               data-id='<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
'
                                                                               data-type='<?php echo $_smarty_tpl->tpl_vars['slot']->value['type'];?>
'
                                                                               data-date='<?php echo $_smarty_tpl->tpl_vars['slot']->value['date'];?>
'
                                                                               data-status='<?php echo $_smarty_tpl->tpl_vars['slot']->value['status'];?>
'
                                                                               data-time-from='<?php echo $_smarty_tpl->tpl_vars['slot']->value['time_from'];?>
'
                                                                               data-time-to='<?php echo $_smarty_tpl->tpl_vars['slot']->value['time_to'];?>
'
                                                                               data-total_hours='<?php echo $_smarty_tpl->tpl_vars['slot']->value['slot_hour'];?>
'
                                                                               data-customer-id='<?php echo $_smarty_tpl->tpl_vars['slot']->value['customer'];?>
'
                                                                               data-customer-name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slot']->value['cust_name'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                                               data-employee-id='<?php echo $_smarty_tpl->tpl_vars['slot']->value['employee'];?>
'
                                                                               data-employee-name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slot']->value['emp_name'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                                               data-fkkn='<?php echo $_smarty_tpl->tpl_vars['slot']->value['fkkn'];?>
'
                                                                               data-signed='<?php echo $_smarty_tpl->tpl_vars['slot']->value['signed'];?>
'
                                                                               data-comment='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slot']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
'
                                                                               />
                                                                        <?php if ($_smarty_tpl->tpl_vars['slot']->value['status']==2){?>
                                                                            <input type="hidden" class="slot_leave_details_hub" 
                                                                                    data-leave-id='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['id'];?>
'
                                                                                    data-leave-status='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['status'];?>
'
                                                                                    data-leave-group-id='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['group_id'];?>
'
                                                                                    data-leave-time-from='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['time_from'];?>
'
                                                                                    data-leave-time-to='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['time_to'];?>
'
                                                                                    data-leave-is-exist-relation='<?php echo $_smarty_tpl->tpl_vars['slot']->value['leave_data']['is_exist_relation'];?>
'
                                                                                    />
                                                                        <?php }?>

                                                                    <div class="<?php if ($_smarty_tpl->tpl_vars['slot']->value['signed']==1){?>striped<?php }?> span12 slot_bountery">
                                                                        <div class="slot-notification-wrpr" style="background-color: <?php echo $_smarty_tpl->tpl_vars['slot']->value['emp_color'];?>
;">
                                                                            <div class="slot-notification"><?php if ($_smarty_tpl->tpl_vars['slot']->value['comment']!=''){?><span class="slot-notification-comment"></span><?php }?></div>
                                                                        </div>
                                                                        <div class="notification-info-customer"><?php echo $_smarty_tpl->tpl_vars['slot']->value['slot'];?>
 (<?php echo $_smarty_tpl->tpl_vars['slot']->value['slot_hour'];?>
)<?php if (trim($_smarty_tpl->tpl_vars['slot']->value['emp_name'])!=''){?><br/><span title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slot']->value['emp_name']);?>
" style="white-space: normal;"><?php echo $_smarty_tpl->tpl_vars['slot']->value['emp_name'];?>
</span><?php }?></div>
                                                                        <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
" class="check-box pull-right m_check hide-small-devices" />
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        <?php }?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        <?php }?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <!-- // Table body END -->
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div id="slot_expanded_views" >
            <?php  $_smarty_tpl->tpl_vars['month_week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month_week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month_week']->key => $_smarty_tpl->tpl_vars['month_week']->value){
$_smarty_tpl->tpl_vars['month_week']->_loop = true;
?>
                <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_week']->value['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                    <?php  $_smarty_tpl->tpl_vars['slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['week_day']->value['slots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot']->key => $_smarty_tpl->tpl_vars['slot']->value){
$_smarty_tpl->tpl_vars['slot']->_loop = true;
?>
                        <div style="display:none;" data-id="<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
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
                                            <span class="slot-type pull-left df" id="<?php echo $_smarty_tpl->tpl_vars['slot']->value['fkkn'];?>
">
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
                    <?php } ?>
                <?php } ?>
            <?php } ?>
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
<!-- div for add slots -->
    <div class="span4 main-right hide no-print"  style="margin-top: 8px; padding: 10px;"  id="stickyPanelParent">
       
            

            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>

                <div id="slot_creation_main_wraper_group" class="clearfix hide">
                    
                    <div class="add-new-slots-month  clearfix">
                        <div id="btnGroupStickyPanel" class="span12">
                            <div class="row-fluid" style="margin-bottom: 5px;">
                               <!--  <div class="span12">
                                    <button type="button" class="btn btn-default-special span12 btn-large" id="show-memory-slots-btn"><span class="icon-level-down"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['memory_slots'];?>
</button>
                                </div> -->
                            </div>
                            <div class="slot-wrpr-buttons span12 no-ml mb" style="margin-top:5px;">
                                <button type="button" class="btn btn-success span6" onclick="manEntry();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</button>
                                <input type="hidden" class="template_id" value="<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
">
                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons" id="slot-create-cancel"><span class="icon-chevron-left"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                            </div>
                        </div>
                        <div style="margin-top: 0px; margin-bottom: 5px ! important; " class="widget">
                            <div class="widget-body" style="padding:5px;">
                                <div class="row-fluid">
                                    <div class="span8 customer-name mt no-min-height" style="margin-left:5px;"> 
                                        <span style="margin-right: 5px;" class="icon-group"></span><?php echo $_smarty_tpl->tpl_vars['customer_name']->value;?>

                                    </div>
                                    <div class="pull-right"> 
                                        <button type="button" class="btn btn-default-special span12" onclick="popupAddSlotMore();"  tabindex="-1" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['add_more_slot'];?>
"><span class="icon-plus"></span></button>
                                    </div>
                                    <div class="span12" style="margin-left: 0px;">
                                        <div class="input-prepend date hasDatepicker datepicker" id="dtPickerNewSlotDate">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span12 slot_date" id="new_slot_date" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" onblur="load_avail_emps_within_period_for_new_slot(this,'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
');" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span12 create-slotes-panel no-pb" style="margin-left: 0px;"></div>            
                            <!-- <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                <div class="close_btn_wrpr pull-right">
                                    <button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="remove slot" type="button" onclick="close_slot_template(this);" tabindex="-1">×</button>
                                </div>
                            </div> -->
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
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
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
                       

                    </div>
                    
                </div>
            <?php }?>

            
            <div id="slot_details_main_wraper_group" class="hide">
                <div class="slot-wrpr span12" id="slot-wrpr-slots">

                    <input class="this_slot_id" id="sdID" type="hidden" value=""/>
                    <input type="hidden" id="hidden_tid" value="">
                    <input id="this_slot_actual_date" type="hidden" value=""/>
                    <input id="this_slot_actual_timefrom" type="hidden" value=""/>
                    <input id="this_slot_actual_timeto" type="hidden" value=""/>
                    <input id="this_slot_actual_customer" type="hidden" value=""/>
                    <input id="this_slot_actual_employee" type="hidden" value=""/>
                    <input id="this_slot_actual_employee_name" type="hidden" value=""/>
                    <input id="this_slot_actual_fkkn" type="hidden" value=""/>
                    <input id="this_slot_actual_type" type="hidden" value=""/>
                    <input id="this_slot_actual_template_id" type="hidden" name="" value="">

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
                    <h2 class="span12 no-mb"><span class="icon-user" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
"></span> 
                        <span id="sdCustomer"><?php echo (($_smarty_tpl->tpl_vars['customer_details']->value['first_name']).(' ')).($_smarty_tpl->tpl_vars['customer_details']->value['last_name']);?>
</span>
                        <input class="this_slot_customer_id" id="sdCustomerID" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
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
                    <br>
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
                    <div class="row-fluid form-wrpr hide" id="Franvaro-box" style="margin: 0 0 15px 0;">
                    <div class="span12 ">
                        <h1 style="margin: 10px 0px !important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['leave'];?>
</h1>
                        <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                        <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                        <div class="btn-group leave-type">
                            <?php  $_smarty_tpl->tpl_vars['leave_type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['leave_type']->_loop = false;
 $_smarty_tpl->tpl_vars['leave_type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['leave_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['leave_type']->key => $_smarty_tpl->tpl_vars['leave_type']->value){
$_smarty_tpl->tpl_vars['leave_type']->_loop = true;
 $_smarty_tpl->tpl_vars['leave_type_key']->value = $_smarty_tpl->tpl_vars['leave_type']->key;
?>
                                <a unselectable="on" href="javascript:void(0);" id="leave_type<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
" class="btn btn-default" name="leave_type" value="<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
" onclick="setLeaveType(<?php echo $_smarty_tpl->tpl_vars['leave_type_key']->value;?>
);"><?php echo $_smarty_tpl->tpl_vars['leave_type']->value;?>
</a>
                            <?php } ?>
                        </div>
                        <div id="karense_notify" class="" style="display: none;"></div>
                        <div class="widget widget-tabs widget-tabs-double-2 no-mb" style="margin-top: 9px;">
                            <div class="widget-head">
                                <ul>
                                    <li id="date_time_time" class="active"><a class="glyphicons clock" href="#tabLeaveTimePeriod" data-toggle="tab"  onclick="leaveTab('time');" ><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
</span></a></li>
                                    <li id="date_time_date"><a class="glyphicons calendar" href="#tabLeaveDatePeriod" data-toggle="tab" onclick="leaveTab('date');"><i></i><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
</span></a></li>
                                </ul>
                            </div>
                            <div class="widget-body">
                                <div class="tab-content">
                                    
                                    <div id="tabLeaveTimePeriod" class="tab-pane widget-body-regular active clearfix" style="background:#fff;">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_day" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
:</label>
                                                <div class="input-prepend date hasDatepicker datepicker no-pt" id="dp_leave_date_day" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span6" name="leave_date_day" id="leave_date_day" value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin: 0px;" class="span12">
                                            <label for="leave_time_from" class='no-mb'><?php echo $_smarty_tpl->tpl_vars['translate']->value['time_range'];?>
:</label>
                                            <div class="input-prepend">
                                                <span class="add-on  icon-time "></span>
                                                <input class="form-control span5" name="leave_time_from" id="leave_time_from" value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text" />
                                                <input class="form-control span5" name="leave_time_to" id="leave_time_to"  value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
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
                                            <div class="span12 no_pay_sick_check_div  no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
</span>
                                                </label>
                                            </div>
                                        <?php }?>
                                    </div>
                                    
                                    
                                    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" id="tabLeaveDatePeriod" class="tab-pane widget-body-regular clearfix">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_from" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_from" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_from" id="leave_date_from" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_to" class="no-mb"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_to" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_to" id="leave_date_to" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['date'];?>
" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                                
                                        <div id="leave_date_replacement_emps" style="margin-top: 9px;">
                                            <?php if ($_smarty_tpl->tpl_vars['login_user_role']->value!=3){?>
                                                <label style="padding: 0px;" class="checkbox">
                                                    <input class="checkbox" name="send_sms_date" id="send_sms_date" value="1" type="checkbox" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['send_sms'];?>

                                                </label>
                                                
                                                <div id="date_replacer_nosms_tbl">
                                                    <div class="span12">
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
                                            <div class="span12 no_pay_sick_check_div no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label"><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense'];?>
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
                            <button type="button" class="btn btn-success span6" id="btn_save_leave" onclick="saveLeave();"><i class="icon-save"></i>  <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_leave'];?>
</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="Franvaro-box-close">x <?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</button>
                        </div>
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
                        <form name="frm_copy" id="frm_copy" method="post">
                            <div class="span12" style="margin-left: 0px;">
                      
                               
                               
                               <!-- <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_with_user">
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['with_user'];?>

                                </label>
                                -->
                                
                                     <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user">
                                    <li>
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" >
                                    <label class="label-option-and-checkbox">   <?php echo $_smarty_tpl->tpl_vars['translate']->value['with_user'];?>
 </label>
                                    </li>
                                    
                                    </ol>
                                
                                
                                <!--<label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_without_user">
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> <?php echo $_smarty_tpl->tpl_vars['translate']->value['without_user'];?>

                                </label>-->
                                
                                
                                 <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_without_user" >
                                    <li>
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" >
                                    <label class="label-option-and-checkbox">  <?php echo $_smarty_tpl->tpl_vars['translate']->value['without_user'];?>
 </label>
                                    </li>
                                    
                                    </ol>
                                
                                
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
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['week']['index'];?>
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
                            <button type="button" class="btn btn-success span6" onclick="save_copy();"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
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
month/gdschema/employee/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['empl']->value['username'];?>
/',1);">
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
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['custl']->value['username'];?>
/',1);">
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






    <script type="text/javascript">
        $(function(){
            $.contextMenu( 'destroy' );
        });
    </script>

     <script>
        // var $translate = <?php echo $_smarty_tpl->tpl_vars['translate_json']->value;?>
;
        
        var $demo1 = $('table#monthlyviewtbl');
        if($(window).height() > 600){
            $demo1.floatThead({
                    scrollContainer: function($demo1){
                            return $demo1.closest('.fixed-scrolling-tbl');
                    }
            });
        }
    </script>

    <script async type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.contextmenu.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            window.get_day_refresh = function(date, customer, employee, get_transaction_message){
                                        console.log(customer);
            //function get_day_refresh(date, customer){
                var obj_process = { action: 'get_day_slots', 'date': date, 'pCustomer': customer,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
'}
                // console.log(obj_process);
                // console.log('sdfgvfgfgfg');
                if(typeof get_transaction_message !== 'undefined' && get_transaction_message)
                    obj_process['show_message'] = 'true';
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data: obj_process,
                    success:function(data){
                        console.log(data);
                        console.log(date);

                        make_day_refresh(data, date, $translate);
                        
                        if(typeof get_transaction_message !== 'undefined' && get_transaction_message && typeof data.message !== 'undefined'){
                            $('#left_message_wraper').html(data.message).delay(60000).html();
                        }
                    }
                }).always(function(data) {
                    
                });
            }

            $('#check_created_slot_copy_to_weeks').click(function(){
                    $('#created_slot_copy_to_weeks')[$(this).is(':checked') ? 'removeClass' : 'addClass']('hide');
                    if($(this).is(':checked')){
                        var new_slot_date = $.trim($('.add-new-slots-month #new_slot_date').val());
                        if(new_slot_date != ''){
                            reset_cscm_params(new_slot_date);
                        }
                    }
            });

            $('.monthly_control #all_check').click(function () { // all checkbox checked.
                $('#monthlyviewtbl .slot').find('.m_check:checkbox').attr('checked', this.checked);
                $('#monthlyviewtbl .all_check_week').attr('checked', this.checked);
                $('#monthlyviewtbl .week_row .all_check_day').attr('checked', this.checked);
            });

            $('#monthlyviewtbl .all_check_week').click(function () { //all checkbox  in a week checked. 
                $(this).parents('.week_row').find('.m_check:checkbox').attr('checked', this.checked);
                $(this).parents('.week_row').find('.all_check_day').attr('checked', this.checked);
            });

            $('.monthly_day .chk_all_day_slot_ctrl .all_check_day').click(function () { // all checkbox in a day is checked.
                $(this).parents('.monthly_day').find('.m_check:checkbox').attr('checked', this.checked);
            });

            function make_day_refresh(data, date, $local_translate){
                var main_reference = $('.monthly_day[data-date='+date+']');
                var main_reference_content_part = main_reference.find('.monthly_strips');
                main_reference_content_part.html('');

                var $login_user      = data.login_user;
                var $login_user_role = data.login_user_role;
                var $privileges_gd   = data.privileges_gd;
                var $swap_copied_slot= data.swap_copied_slot;
                console.log(data.selected_day_slots.length);

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

                            new_content += '<span class="collapse-slot clearfix" id="slot_thread_'+$slot.id+'">\n\
                                                <div class="slot monthlyslotview span12 '+special_slot_class_name+' '+($slot.signed == 1 ? 'signed_slot' : '')+' '+($swap_copied_slot == $slot.id ? 'objblink' : '')+'" \n\
                                                     onmouseover="tooltip.pop(this, \'#slot_details_'+$slot.id+'\', { position:1, offsetX:-20, effect:\'slade\' });" data-slot-id="'+$slot.id+'" >\n\
                                                    <input type="hidden" class="slot_details_hub" \n\
                                                            data-tid="'+$slot.tid+'"\n\
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
                                                    <div class="'+($slot.signed == 1 ? 'striped' : '')+' span12 slot_bountery">\n\
                                                        <div class="slot-notification-wrpr" style="background-color: '+$slot.emp_color+';">\n\
                                                            <div class="slot-notification">'+($slot.comment != '' && $slot.comment != null ? '<span class="slot-notification-comment"></span>' : '')+'</div>\n\
                                                        </div>\n\
                                                        <div class="notification-info-customer">'+$slot.slot+' '+( $.trim($slot.emp_name) != '' && $slot.emp_name != null ? '| <span title="'+$slot.emp_name+'" style="white-space: normal;">'+$slot.emp_name+'</span>' : '')+'</div>\n\
                                                        <input type="checkbox" value="'+$slot.id+'" class="check-box pull-right m_check" />\n\
                                                    </div>\n\
                                                </div>\n\
                                            </span>';
                            //--------------for tooltip------------------------------

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
                                                            new_content_tooltip += '<span class="slot-type pull-left">'+fkkn_text+' ';
                                                            new_content_tooltip += '</span>\n\
                                                            <span class="pull-left">\n\
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
                        $('#slot_expanded_views').find('#slot_details_'+$slot.id).parent().remove();
                        // console.log('fgfgfdg');
                        // $('#slot_expanded_views').find('#slot_details_'+$slot.id).parents('.slot_expand_view_parent').remove();
                    });

                }
                main_reference_content_part.html(new_content);
                $('#slot_expanded_views').append(new_content_tooltip);

                rebind_events();
            }

            function rebind_events(){
                bind_slot_click_event();
            }


            var bind_slot_click_event = function() {
                $(".slot").click(function() {
                    close_right_panel();
                    show_right_panel();
                        $("#slot_details_main_wraper_group").removeClass('hide');
                        $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
                        var slot_data        = $(this).find('.slot_details_hub');
                        var slot_id          = slot_data.attr('data-id');
                        var slot_tid         = slot_data.attr('data-tid');
                        var slot_date        = slot_data.attr('data-date');
                        var slot_timefrom    = $.trim(slot_data.attr('data-time-from'));
                        var slot_time_to     = $.trim(slot_data.attr('data-time-to'));
                        var slot_customer_id = slot_data.attr('data-customer-id');
                        var slot_employee_id = slot_data.attr('data-employee-id');
                        var slot_fkkn        = slot_data.attr('data-fkkn');
                        var slot_type        = slot_data.attr('data-type');
                        var slot_status      = slot_data.attr('data-status');
                        var slot_signed      = slot_data.attr('data-signed') == 1 ? true : false;
                        console.log(slot_id);
                         $('html, body').animate({
                            scrollTop: $(".main-right").offset().top
                         }, 2000);
                         $('#slot_details_main_wraper_group #sdID').val(slot_data.attr('data-id'));  //id
                         $('#slot_details_main_wraper_group #hidden_tid').val(slot_data.attr('data-tid'));  //id
                        //$('#slot_details_main_wraper_group #sdDate').val(slot_data.attr('data-date'));  //date
                        $('#slot_details_main_wraper_group #slot_details_date').datepicker('update', slot_data.attr('data-date'));  //date
                        $('#slot_details_main_wraper_group #sdTFrom').val(slot_data.attr('data-time-from'));  //from-time
                        $('#slot_details_main_wraper_group #sdTTo').val(slot_data.attr('data-time-to'));  //from-time
                        $('#slot_details_main_wraper_group #sdCustomerID').val(slot_data.attr('data-customer-id'));  //customer-id
                        $('#slot_details_main_wraper_group #sdCustomer').html(slot_data.attr('data-customer-name'));  //customer-name

                        $('#slot_details_main_wraper_group #sdFKKN').val(slot_data.attr('data-fkkn'));  //fkkn
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
                                    'slot_tid' : slot_tid,
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
                        console.log(1);
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_month.php",
                            type:"POST",
                            dataType: 'json',
                            data: { action: 'check_slot_credentials', 'slot_id': slot_id,'slot_tid':slot_tid},
                            success:function(data){
                                console.log(data);
                                <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['leave']==1){?>
                                    if(slot_employee_id != '' && data.tl_flag && slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17)
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
                                if( (privileges_add_employee == '1' || privileges_remove_employee == '1') && ((loggedin_userrole == '3' && (slot_employee_id == loggedin_user || slot_employee_id =='')) || (loggedin_userrole != '3'))){
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
                    $('#Franvaro-box #leave_type_val').val('');
                    $('.no_pay_sick_check_div').addClass('hide');

                });
                    
                    <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_slot']==1){?>
                    $(".monthlyslotview-draggable").draggable({ revert: "invalid", appendTo: "#monthlyviewtbl", helper: 'clone', cancel: ".signed_slot,.slot-theme-leave,.slot-theme-candg", delay: 300, start: 
                            function (event, ui) { ui.helper.css({ 'width': '163px', 'opacity': '1'}); } 
                    });  //helper: "original"
                    <?php }?>

                    $(".m_check, .all_check_day, .all_check_week").click(function(e){
                      e.stopPropagation();
                    });
            }
            rebind_events();

            /*MAIN-RIGHT COLLPASE*/
            $(".slot-confirm-buttons").click(function() {
                close_right_panel();
            });

            // height Fit
            $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
            $('.fixed-scrolling-tbl').css({ height: Math.max($(window).innerHeight()- 130- $('#navigation-main-table').innerHeight()- $('.theme-add-wrpr').innerHeight(), 250) });
            $(window).resize(function(){
              $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
              $('.fixed-scrolling-tbl').css({ height: Math.max($(window).innerHeight()- 130- $('#navigation-main-table').innerHeight()- $('.theme-add-wrpr').innerHeight(), 250) });
            }).resize();


            $(".monthPicker").datepicker({
                format: "yyyy-mm",
                changeMonth: true,
                changeYear: true,
                viewMode: "months", //1
                minViewMode: "months",
                autoclose: true,
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
',
                onClose: function (dateText, inst) { }
            }).on('changeDate', function(ev){
                var month = $.datepicker.formatDate('mm', ev.date);
                var year = $.datepicker.formatDate('yy', ev.date);
                $(".monthPicker").datepicker('hide');
                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year='+year+'&month='+month+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);
            });

        });

        $("#add-slots").click(function(e,right_click_add = null, date = null) {
            close_right_panel();
            show_right_panel();
            $("#slot_creation_main_wraper_group").removeClass('hide');
            $(".add-new-slots-month").removeClass('hide');
            $(".add-new-slots-month .create-slotes-panel").html(get_slot_add_theme());
            $('#new_slot_date').datepicker('update','<?php echo ((($_smarty_tpl->tpl_vars['year']->value).('-')).($_smarty_tpl->tpl_vars['month']->value)).('-01');?>
');
            $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
            }, 3000);
            if (right_click_add != null && date != null){
                $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', date);
            }

        });

        $("#slot-create-cancel").click(function() {
            $(".add-new-slots-month").addClass('hide');
            close_right_panel();
        });
            
        function reload_content(schedule_id,customer,year,month){
            console.log('<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
');
            console.log('<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
');
            console.log('<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
');
            console.log('<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
');
             navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1);
        }

        function show_right_panel(){
            $('#gdmonth_wraper').addClass('show_main_right');
            $('.main-right').removeClass('hide');
            //$(window).resize();
            if($(window).height() > 600)
                $demo1.floatThead('reflow');
        }
        
        function close_right_panel(){
            $('#gdmonth_wraper').removeClass('show_main_right');
            $(".main-right").addClass('hide');
            
            $("#slot_creation_main_wraper_group").addClass('hide');
            $("#slot_details_main_wraper_group").addClass('hide');
            $("#right_click_action_options").addClass('hide');
            $(".add-new-slots-month, #memory-slots").addClass('hide');
            $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
            $("#change-employee-customer-options, #replace-employee-week-basis, #sms-for-emp-allocation, #goto-employees-options, #goto-customers-options").addClass('hide');
            //$(window).resize();
            if($(window).height() > 600)
                $demo1.floatThead('reflow');
        }

         function get_slot_add_theme(){
            var slot_theme = '<div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">\n\
                                <div class="close_btn_wrpr pull-right"><button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['remove_slot'];?>
" type="button" onclick="close_slot_template(this);"  tabindex="-1">×</button></div>\n\
                                <div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend">\n\
                                        <span class="add-on  icon-time " title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['time'];?>
"></span>\n\
                                        <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="" oninput="load_avail_emps_within_period_for_new_slot(this,<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
);" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['from'];?>
" type="text"  style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>\n\
                                        <span class="add-on"><?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
</span>\n\
                                        <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="" oninput="load_avail_emps_within_period_for_new_slot(this,<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
);" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['to'];?>
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
                                </div> ' ;
                                slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                    <div class="input-prepend span11">\n\
                                        <span class="add-on icon-star"></span>\n\
                                        <select class="form-control custom_slot_fkkn span12" name="custom_slot_fkkn">\n\
                                            <option <?php if ($_smarty_tpl->tpl_vars['customer_details']->value['fkkn']==1){?>selected="selected"<?php }?> value="1"><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>
</option>\n\
                                            <option <?php if ($_smarty_tpl->tpl_vars['customer_details']->value['fkkn']!=1){?>selected="selected"<?php }?> value="2"><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>
</option>\n\
                                            <option value="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>
</option>\n\
                                        </select>\n\
                                    </div>\n\
                                </div> ';
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

        function load_avail_emps_within_period_for_new_slot(this_obj,$schedule_id){

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
                                'schedule_id': '<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
',
                                'selected_customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                'action': 'new_slot_add',
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
                console.log(main_obj);

                //wrapLoader('.time_slots_theme');
                //wrapLoader($(this_obj).parents('.time_slots_theme'));
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_a_period_on_template.php",
                    type:"POST",
                    dataType: 'json',
                    data: main_obj,
                    success:function(data){
                        // console.log(data);
                        
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

                    //TABLE ROW EXPANDER
        $(".btn-collapse-table-row").click(function() {
            var week_collapse_action = '';
            if ($(this).val() === "+"){
                $(this).val("-");
                week_collapse_action = 'EXPAND';
            }else{
                $(this).val("+");
                week_collapse_action = 'COLLAPSE';
            }

            if (week_collapse_action === 'COLLAPSE') {
                $(this).parents('.week_row').find(".collapse-slot").hide();
                $(this).parents('.week_row').find("li.chk_all_week_slot_ctrl").hide();
                $(this).parents('.week_row').css('height', 'auto');
            } else if (week_collapse_action === 'EXPAND') {
                $(this).parents('.week_row').find(".collapse-slot").show();
                $(this).parents('.week_row').find("li.chk_all_week_slot_ctrl").show();
                $(this).parents('.week_row').css('height', '150px');
            }
        });

        function manEntry(){
            var slot_date    = $.trim($('.add-new-slots-month .slot_date').val());
            var proceed_flag = true;
            var have_slots   = false;

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
                from_week   = $('.add-new-slots-month #cscm_from_wk').val();
                to_week     = $('.add-new-slots-month #cscm_to_wk').val();
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
            else{
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
                }
                else{
                    if(weekly_past_value){
                        main_obj['from_week']   = from_week;
                        main_obj['to_week']     = to_week;
                        main_obj['from_option'] = from_option;
                        main_obj['days']        = week_days;
                    }

                    wrapLoader('#slot_creation_main_wraper_group');
                    $.ajax({
                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_check_inconv_time_with_slot_time_for_template.php",
                        type: "POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            // console.log(data);
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
                // console.log(main_obj);
                // console.log(collid_emp_obj);

            }
            // return false;
            // console.log('d');
        }

        function manEntry_proceed(data_obj){
            var slot_date    = $.trim($('.add-new-slots-month .slot_date').val());
            var saveTimeslot = $('.add-new-slots-month input:checkbox[name=saveTimeslot]:checked').val();
            var template_id  = $('.template_id').val();
            var saveTimeslot_value = 0;
            if (saveTimeslot) saveTimeslot_value = 1;

            // getting weekly value
            var weekly_past       = $('.add-new-slots-month input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            var from_week         = to_week = from_option = '';
            if(weekly_past_value){
                from_week = $('.add-new-slots-month #cscm_from_wk').val();
                to_week = $('.add-new-slots-month #cscm_to_wk').val();
                from_option = $('.add-new-slots-month #cscm_from_option').val();
                
                var week_days = $('.add-new-slots-month input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }
            // getting weekly value end.

            var main_obj = { 'template_id': template_id ,
                            'selected_date': slot_date,
                            'selected_customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                            'action': 'man_slot_entry',
                            'sub_action': 'multiple_add',
                            'req_from': 'monthly_view',
                            'gd_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
',
                            'gd_year' : '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
',
                            'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                            'emp_alloc': '<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
',
                            'saveTimeslot': saveTimeslot_value,
                            'stop_if_any_error': true,
                            'time_slots': [ ] };
            // console.log(main_obj);
            // return false;
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
            var need_atl_checking    = false;
            var normal_slot_types    = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
            var oncall_slot_types    = ['3', '9', '13', '14', '17'];
            var have_normal_slots    = false;
            var have_oncall_slots    = false;
            url_atl__                = { 'time_slots': [ ] };  
            var url_atl_slot_count   = 0;
            var slot_enters_next_day = false;
            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {
                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to   = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;
                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to   = parseFloat(tmp_slot_to);
                    if(tmp_slot_from >= tmp_slot_to) slot_enters_next_day = true;
                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                    var tmp_comment       = $.trim($(this).find('.comment_textarea').val());
                    var tmp_fkkn          = $(this).find('.custom_slot_fkkn').val();
                    var tmp_slot_type     = $(this).find('ul.single-slot-icon-list').find('li.active').attr('data-value');

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
            }); // for getting all details and store in an object.
            url_atl += '&' + serialize_json_as_url(url_atl__['time_slots'], 'time_slots');
            var base_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action.php?';
            console.log(main_obj);

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
                            // if(need_atl_checking){
                            //     check_atl_warning(url_atl, function(this_url){ 
                            //         return false;
                            //                     if(weekly_past_value)
                            //                         navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                            //                     else{
                            //                         var _fn_callbak = function() {
                            //                             get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             if(slot_enters_next_day){
                            //                                 var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                            //                                 get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             }
                            //                             close_right_panel();
                            //                         }
                            //                         excecute_request(this_url, main_obj, _fn_callbak);
                            //                     }
                            //                 }, base_url);
                            // }

                            // else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
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
                                    // return false;
                                    
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            // }
                        }
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['convert_to_oncall'] ='yes';
                            // if(need_atl_checking){
                            //     check_atl_warning(url_atl, function(this_url){ 
                            //                     if(weekly_past_value)
                            //                         navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                            //                     else{
                            //                         var _fn_callbak = function() {
                            //                             get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             if(slot_enters_next_day){
                            //                                 var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                            //                                 get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             }
                            //                             close_right_panel();
                            //                         }
                            //                         excecute_request(this_url, main_obj, _fn_callbak);
                            //                     }
                            //                 }, base_url);
                            // }

                            // else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
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
                            // }
                        }
                }]);
            }
            else if(have_normal_slots && (data_obj.slot_split_time_flag == 1 || data_obj.slot_split_time_flag_next == 1)){
                // alert('second');
                // return false;
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_seperate_oncall_hours'];?>
', [{
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                        "class" : "btn-danger",
                        "callback": function() {
                            // if(need_atl_checking){ //atl and contract checking.
                            //     check_atl_warning(url_atl, function(this_url){ 
                            //                         if(weekly_past_value)
                            //                             navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                            //                         else{
                            //                             var _fn_callbak = function() {
                            //                                 get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                                 if(slot_enters_next_day){
                            //                                     var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                            //                                     get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                                 }
                            //                                 close_right_panel();
                            //                             }
                            //                             excecute_request(this_url, main_obj, _fn_callbak);
                            //                         }
                            //                 }, base_url);
                            // }

                            // else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            // }
                        }
                    }, {
                        "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['split_slots'] = 'yes';
                            // if(need_atl_checking){ //atl and contract checking.
                            //     check_atl_warning(url_atl, function(this_url){ 
                            //                     if(weekly_past_value)
                            //                         navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                            //                     else{
                            //                         var _fn_callbak = function() {
                            //                             get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             if(slot_enters_next_day){
                            //                                 var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                            //                                 get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                            //                             }
                            //                             close_right_panel();
                            //                         }
                            //                         excecute_request(this_url, main_obj, _fn_callbak);
                            //                     }
                            //                 }, base_url);
                            // }

                            // else {
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                        if(slot_enters_next_day){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            // }
                        }
                }]);
            }
            else {
                // alert(3)
                // return false;
                // if(need_atl_checking){ //atl and contract checking.
                //     check_atl_warning(url_atl, function(this_url){ 
                //                                 if(weekly_past_value)
                //                                     navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                //                                 else{
                //                                     var _fn_callbak = function() {
                //                                         get_day_refresh(main_obj.selected_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                //                                         if(slot_enters_next_day){
                //                                             var next_day = date('Y-m-d', strtotime('+1 day', strtotime(main_obj.selected_date)));
                //                                             get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                //                                         }
                //                                         close_right_panel();
                //                                     }
                //                                     excecute_request(this_url, main_obj, _fn_callbak);
                //                                 }
                //                     }, base_url);
                // }

                // else {
                    if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
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
                // }
            }
            // console.log(url_atl);

            return false;
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

        function navigatePageWithMaintainScrollPosition(path,sidemenu, post_data, scroll_top){
            var scoll_position_calendar = $('.fixed-scrolling-tbl').scrollTop();
            var _fn_callbak = function() {
                $('.fixed-scrolling-tbl').animate({
                    scrollTop: scoll_position_calendar
                });
            }
            
            navigatePage(path,sidemenu, post_data, scroll_top, _fn_callbak);
        }

        function load_avail_emps_for_slot(slot_details_obj, this_obj){
        
            var slot_id          = slot_details_obj.slot_id;
            var slot_date        = slot_details_obj.slot_date;
            var slot_timefrom    = slot_details_obj.slot_timefrom;
            var slot_time_to     = slot_details_obj.slot_time_to;
            var slot_customer_id = slot_details_obj.slot_customer_id;
            var slot_employee_id = slot_details_obj.slot_employee_id;
            var slot_tid         = slot_details_obj.slot_tid;
            
            $('#slot_details_main_wraper_group #sdEmployee').html('<option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_employee'];?>
</option>');  //employee
            
            //get available employees for this time period
            if(slot_timefrom != '' && slot_time_to != '' && slot_customer_id != '' && slot_date != ''){
                var slot_from = time_to_sixty(slot_timefrom);
                var slot_to = time_to_sixty(slot_time_to);
                if(slot_to == 0) slot_to = 24;

                //get all other slot details
                var main_obj = { 'selected_date': slot_date,
                                'slot_tid': slot_tid,
                                'selected_customer': slot_customer_id,
                                'current_slot_id': slot_id,
                                'action': 'change_slot_employees',
                                'current_slot': { 'time_from': slot_from, 'time_to': slot_to }};


                ///wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_a_period_on_template.php",
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

        function load_avail_emps_within_period(this_obj){
        
            var slot_id            = $('#slot_details_main_wraper_group #sdID').val();
            
            var slot_date          = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom      = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to       = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_customer_id   = $('#slot_details_main_wraper_group #sdCustomerID').val();
            var slot_tid           = $('#slot_details_main_wraper_group #hidden_tid').val();
            //var slot_employee_id = $('#slot_details_main_wraper_group #sdEmployee').val();
            var slot_employee_id   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

            var slot_details_obj = { 'slot_id': slot_id,
                                'slot_tid': slot_tid,
                                'slot_date': slot_date,
                                'slot_timefrom': slot_timefrom,
                                'slot_time_to': slot_time_to,
                                'slot_customer_id': slot_customer_id,
                                'slot_employee_id': slot_employee_id};
            
            load_avail_emps_for_slot(slot_details_obj, this_obj);
        }


        // ****** Function for prime member slot time creation ********
        // function load_pm_special_employees_confirm_type(){
        //     var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
        //     if(slot_type == 10){
        //         load_pm_special_employees();
        //     } else 
        //         $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');
        // }

        // function load_pm_special_employees(){
        //     var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
        //     var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
        //     var timefrom        = time_to_sixty($('#slot_details_main_wraper_group #sdTFrom').val());
        //     var timeto          = time_to_sixty($('#slot_details_main_wraper_group #sdTTo').val());
        //     if(timeto == 0) timeto = 24;
            
        //     $.ajax({
        //         url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_get_avail_employees_for_PM.php",
        //         type:"POST",
        //         dataType: 'json',
        //         data: { 'slot_id': slot_id, 'slot_date': slot_date, 'time_from': timefrom, 'time_to': timeto},
        //         success:function(data){
        //             //console.log(data);
        //             $('#slot_details_main_wraper_group #PM-special-empls').removeClass('hide');
        //             $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails').html('');
        //             $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails').html('');
        //             if(data.available_employees.length > 0){
        //                 $.each(data.available_employees, function(i, value) {
        //                     $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails').append('<input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="'+value.username+'">'+value.name+'<br>');
        //                 });
        //             }
        //             if(data.unavailable_employees.length > 0){
        //                 $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails-div').removeClass('hide');
        //                 $.each(data.unavailable_employees, function(i, value) {
        //                     $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails').append(value.last_name+ ' ' + value.first_name +'<br>');
        //                 });
        //             }else
        //                 $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-unavails-div').addClass('hide');

        //         }
        //     }).always(function(data) {
        //         //uwrapLoader('#slot_details_main_wraper_group');
        //     });
        // }

       function modify_slot_details(){ // modify the saved slot 

            var slot_date        = $('#slot_details_main_wraper_group #sdDate').val();
            var slot_timefrom    = $('#slot_details_main_wraper_group #sdTFrom').val();
            var slot_time_to     = $('#slot_details_main_wraper_group #sdTTo').val();
            var slot_employee_id = $('#slot_details_main_wraper_group #sdEmployee').val();
            var old_employee_id  = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            
            var proceed_flag     = true;
            if(slot_date == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['invalid_date'];?>
', function(result){  });
                proceed_flag = false;
                return false;
            }
            else if(slot_timefrom == '' || slot_time_to == ''){
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['incomplete_slot_times'];?>
', function(result){  });
                proceed_flag = false;
                return false;
            } 
            else if(old_employee_id != '' && slot_employee_id == ''){
                bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_you_want_to_reset_previous_employee'];?>
', [{
                                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                                "class" : "btn-danger"
                                                            }, {
                                                                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                                "class" : "btn-success",
                                                                "callback": function() {
                                                                    modify_slot_details_confirm();
                                                                }
                                                        }]);
            }
            else {
                modify_slot_details_confirm();
            }
            
       }
       function  modify_slot_details_confirm(){

            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_tid        = $('#slot_details_main_wraper_group #hidden_tid').val();
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

            var need_atl_checking = false;
            console.log(slot_tid);
            slot_timefrom = time_to_sixty(slot_timefrom);
            slot_time_to  = time_to_sixty(slot_time_to);
            if(slot_time_to == 0) slot_time_to = 24;
            
            var slot_details_obj = { 'slot_id': slot_id,
                                'slot_tid' :slot_tid,
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

            //  ***********   for personal meeting   **********       
            // if(slot_type == 10){
            //     var permeeting_emps = $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails input:checkbox:checked[name=PM-special-empl-check]').map(function () {
            //             return this.value;
            //     }).get().join('||');
            //     slot_details_obj['personal_meeting_emps']= permeeting_emps;
            // }

            if(slot_employee_id != '' && (slot_employee_id != old_employee_id || slot_timefrom != old_time_from || slot_time_to != old_time_to )){
                var url_atl = slot_details_params =  serialize_json_as_url(slot_details_obj);
                var base_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_month.php?';

                if(need_atl_checking == true){
                    // check_atl_warning(url_atl, function(this_url){ 
                    //                                     //navigatePage(this_url,1, main_obj);
                    //                                     wrapLoader('#slot_details_main_wraper_group');
                    //                                     $.ajax({
                    //                                         url:this_url,
                    //                                         type:"POST",
                    //                                         data:slot_details_obj,
                    //                                         success:function(data){
                    //                                             close_right_panel();
                    //                                             //reload_content();
                    //                                             get_day_refresh(slot_details_obj.slot_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                    //                                             if(slot_timefrom >= slot_time_to){
                    //                                                 var next_day = date('Y-m-d', strtotime('+1 day', strtotime(slot_details_obj.slot_date)));
                    //                                                 get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                    //                                             }
                    //                                         }
                    //                                     }).always(function(data) { 
                    //                                         uwrapLoader('#slot_details_main_wraper_group');
                    //                                     });
                    //                 }, base_url);
                }
                else{
                    var _fn_callbak = function() {
                                        get_day_refresh(slot_details_obj.slot_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);

                                        if(slot_timefrom >= slot_time_to){
                                            var next_day = date('Y-m-d', strtotime('+1 day', strtotime(slot_details_obj.slot_date)));
                                            get_day_refresh(next_day, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        close_right_panel();
                                    }
                                    // return false;
                                    
                                    excecute_request(base_url, slot_details_obj, _fn_callbak);
                }
            }
            else{
                // alert();
        // return false;
                wrapLoader('#slot_details_main_wraper_group');
                $.ajax({
                    url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_month.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        console.log(data);
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

        function check_atl_warning(){
            return true;
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
ajax_template_alloc_action_slot.php",
                                type:"POST",
                                data:slot_details_obj,
                                success:function(data){
                                    // console.log(data);
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

        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['split_slot']==1){?>
            function splitSlot(){
                var new_tfrom   = $("#slot-dela-pass #split_slot_timefrom").val();
                var new_tto     = $("#slot-dela-pass #split_slot_timeto").val();
                if(new_tfrom != '' && new_tto != ''){
                
                    var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                    var slot_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                    
                    var process_details_obj = { 'id': slot_id,
                                'slot_from' : slot_from,
                                'slot_to'   : slot_to,
                                'time_from' : new_tfrom,
                                'time_to'   : new_tto,
                                'action'    : 'split'
                    };
                    wrapLoader('#slot_details_main_wraper_group');
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_slot.php",
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
            function save_copy(){
                var days = "";
                var with_user = 1;
                for(var i=0; i < document.frm_copy.slot_copy_multiple_days.length; i++){
                if(document.frm_copy.slot_copy_multiple_days[i].checked)
                    days += document.frm_copy.slot_copy_multiple_days[i].value+'-';
                }
                if(days == '')
                    alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_days'];?>
');
                else{
                    if($('#kopierapass-box #slot_copy_multiple_withoutuser').attr("checked") == "checked")
                        with_user = 0;
                    
                    var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                    var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                    var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                    var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                    
                    var from_week   = $("#kopierapass-box #slot_copy_multiple_from_wk").val();
                    var from_option = $("#kopierapass-box #slot_copy_multiple_from_option").val();
                    var to_week     = $("#kopierapass-box #slot_copy_multiple_to_wk").val();
                    
                    var additional_urldata = 'customer='+slot_customer+'&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&employee='+slot_employee+'&date='+slot_date+
                            '&from_week='+from_week+'&from_option='+from_option+'&to_week='+to_week+'&id='+slot_id+
                            '&days='+days+'&with_user='+with_user+'&action=copy_multiple&user=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
';
                    if(with_user == 1){
                        var atl_req_data = additional_urldata + '&to_single_slot=TRUE&type_check=11';
                        var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_slot.php?' + additional_urldata;
     
                                    wrapLoader('#slot_details_main_wraper_group');
                                    $('#div_alloc_action').load(process_url, function(response, status, xhr){ 
                                        uwrapLoader('#slot_details_main_wraper_group'); reload_content(); 
                                    });
                                       
                    }else{
                        wrapLoader('#slot_details_main_wraper_group');
                        $.ajax({
                            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alloc_action_slot.php",
                            type:"POST",
                            data:additional_urldata,
                            success:function(data){
                                //console.log(data);
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

        /*kopiera pass*/
        $("#btn_slot_copy_multiple").click(function() {
            $("#Franvaro-box, #slot-dela-pass").addClass('hide');
            $('html, body').animate({
        scrollTop: $("#kopierapass-box").offset().top
            }, 3000);

            
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
    </script>

    <script>
        function navigatePageWithMaintainScrollPosition(path,sidemenu, post_data, scroll_top){
            var scoll_position_calendar = $('.fixed-scrolling-tbl').scrollTop();
            var _fn_callbak = function() {
                $('.fixed-scrolling-tbl').animate({
                    scrollTop: scoll_position_calendar
                });
            }
            
            navigatePage(path,sidemenu, post_data, scroll_top, _fn_callbak);
            // reload_content('<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
');
            // location.reload();  
        }
    </script>


    
    <script>
        $(document).ready(function() {
            /**************************************************
             * Context-Menu with Sub-Menu
             **************************************************/
            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?>
                $.contextMenu({
                    selector: '.cur_month_header', 
                    build: function($trigger, e) {

                        var options = {
                            callback: function(key, options) {
                                switch(key){
                                   case "paste_month" :
                                        var year_month = $(this).attr('data-year-month');
                                        var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_slot_process.php?date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&sub_action=past_in_month'; 
                                        var url_data = 'date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&sub_action=past_in_month';
                                        var atl_req_data = 'date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&sub_action=past_in_month';
                                        check_atl_warning(atl_req_data, function(this_url){ 
                                                            wrapLoader("#external_wrapper");
                                                            $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader("#external_wrapper"); navigatePageWithMaintainScrollPosition('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/',1); });
                                                        }, url, "#external_wrapper");
                                        break;
                                }
                            },
                            items: {
                                    "paste_month": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
"},
                            }
                        }
                        return options;
                    }
                });
            <?php }?>

            $.contextMenu({
                selector: '.monthly_day, .monthlyslotview, .week_no_td', 
                build: function($trigger, e) {
                    //console.log($trigger);
                    //console.log(e);

                    var included_candg_slots = false;
                    var included_none_candg_slots = false;
                    var included_incomplete_slots = false;
                    var included_non_incomplete_slots = false;
                    $( '#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.monthlyslotview').hasClass('slot-theme-candg'))
                            included_candg_slots = true;
                        else
                            included_none_candg_slots = true;
                    });
                    $( '#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                        if($(this).parents('.monthlyslotview').hasClass('slot-theme-incomplete'))
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

                    var ids_temp = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check').map(function () {
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
                                    temp_single_day_date = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                    if(single_day_date != '' && temp_single_day_date != single_day_date){
                                        is_single_day_operation = false;
                                        return false;
                                    }
                                    single_day_date = temp_single_day_date;
                                });
                            }
                            //console.log(single_day_date);
                            //console.log(is_single_day_operation);
                    
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
month/gdschema/employee/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/'+temp_empl_id+'/',1);
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
                                    var temp_cust_id = '';
                                    /*if(ids_temp.length == 1){
                                        var slot_details_hub = $('#slot_thread_'+ids_temp[0]).find('.slot_details_hub');
                                        if(slot_details_hub.length == 1){
                                            temp_cust_id = slot_details_hub.attr('data-customer-id');
                                            if(temp_cust_id != ''){
                                                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/'+temp_cust_id+'/',1);
                                            }
                                        }
                                    }*/
                                    if(temp_cust_id == ''){
                                        close_right_panel();
                                        show_right_panel();
                                        $("#right_click_action_options, #goto-customers-options").removeClass('hide');
                                    }
                                   break;
                                case "delete_slot":
                                   if(ids != ''){
                                        var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action' : 'multiple_slots_remove', 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
','template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
' };
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
                                                        navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
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
                                       var url_post_data = { 'ids': ids, 'action': 'delete_customers', 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
' };
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
                                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                                        }
                                                        excecute_request(urls, url_post_data, _fn_callbak);
                                                    }else
                                                        navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;

                               case 'delete_employee':
                                   if(ids != ''){
                                       var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                       var url_post_data = { 'ids': ids, 'action': 'delete_employees', 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
','template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
' };
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
                                                    }else{
                                                        navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                    }
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
ajax_template_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action': slot_fkkn_change, 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
','template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
'};
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
                                                        navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                }
                                        }]);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "change_employee":
                                   if(ids != ''){
                                       var process_details_obj = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
',
                                        'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
',
                                        'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
',
                                        'template_id': '<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
',
                                        'ids': ids,
                                        'action': 'avail_employees_for_multiple_slot_change',
                                        'method': '1'};
                                       changeEmployeeCustomer(process_details_obj,1);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "change_customer":
                                   if(ids != ''){
                                       var process_details_obj = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
',
                                        'sel_month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
',
                                        'customer': '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
',
                                        'ids': ids,
                                        'action': 'avail_customers_for_multiple_slot_change',
                                        'method': '2'};
                                       changeEmployeeCustomer(process_details_obj,2);
                                   } else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "copy": 
                                   if(ids != '')
                                       copyMonthlySlot();
                                   else
                                       bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_atleast_one_slot'];?>
', function(result){ });
                                   break;
                               case "paste" :
                                    if($(this).hasClass('week_no_td')){
                                        var dates = $(this).attr('data-yearweek');
                                        pasteSlot('', '', dates);
                                    }else if($(this).hasClass('monthly_day')){
                                        var dates = $(this).attr('data-date');
                                        //console.log('monthly_day'+dates);
                                        pasteSlot('TRUE',dates,'');
                                    }else if($(this).hasClass('slot') || $(this).hasClass('monthlyslot_date')){
                                        var dates = $(this).parents('td.monthly_day').attr('data-date');
                                        pasteSlot('TRUE',dates,'');
                                    }else
                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['cannot_paste'];?>
', function(result){ });
                                    break;
                              case "paste_day" :
                                    if($(this).hasClass('week_no_td')){
                                        var dates = $(this).attr('data-yearweek');
                                        pasteSlotDay('','',dates);
                                    }else if($(this).hasClass('monthly_day')){
                                        var dates = $(this).attr('data-date');
                                        pasteSlotDay('TRUE',dates,'');
                                    }else if($(this).hasClass('slot') || $(this).hasClass('monthlyslot_date')){
                                        var dates = $(this).parents('td.monthly_day').attr('data-date');
                                        pasteSlotDay('TRUE',dates,'');
                                    }else
                                        bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['cannot_paste'];?>
', function(result){ });
                                    break;      
                               case "add_slot" :
                                    if($(this).hasClass('monthly_day')){
                                        var dates = $(this).attr('data-date');
                                        popupAddSlot(dates);
                                    }else if($(this).hasClass('slot') || $(this).hasClass('monthlyslot_date')){
                                        var dates = $(this).parents('td.monthly_day').attr('data-date');
                                        popupAddSlot(dates);
                                    }else
                                        popupAddSlot();
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
                                                $( '#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                                                    tmp_this_slot_type = $(this).parents('.monthlyslotview').find('input.slot_details_hub').attr('data-type');
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
ajax_template_check_oncall_inconve_range.php",
                                                                       type: "POST",
                                                                       data: 'ids='+ids,
                                                                       success:function(data){
                                                                           if(data == 'success'){


                                                                               var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                                                               var url_post_data = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
' };
                                                                               if(is_single_day_operation){
                                                                                   var _fn_callbak = function() {

                                                                                       get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                                   }
                                                                                   excecute_request(urls, url_post_data, _fn_callbak);
                                                                               }else
                                                                                   navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                                           }else
                                                                               bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_outside_oncall'];?>
', function(result){ });
                                                                       }
                                                                     });
                                                               }else{
                                                                   var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                                                   var url_post_data = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
' };
                                                                   if(is_single_day_operation){
                                                                       var _fn_callbak = function() {
                                                                           get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                       }
                                                                       excecute_request(urls, url_post_data, _fn_callbak);
                                                                   }else
                                                                       navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                               }
                                                            }
                                                        },{
                                                            "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                            "class" : "btn-success",
                                                            "callback": function() {
                                                                var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                                                var url_post_data = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'normal_oncall_auto_change': true ,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
'};
                                                                if(is_single_day_operation){
                                                                    var _fn_callbak = function() {
                                                                        get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                    }
                                                                    excecute_request(urls, url_post_data, _fn_callbak);
                                                                }else
                                                                    navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                            }
                                                    }]);
                                            }
                                            else if(slot_type_change == 14 || slot_type_change == 3 || slot_type_change == 9 || slot_type_change == 13 || slot_type_change == 17){
                                                 $.ajax({
                                                    url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_check_oncall_inconve_range.php",
                                                    type: "POST",
                                                    data: 'ids='+ids,
                                                    success:function(data){
                                                        if(data == 'success'){
                                                            var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                                            var url_post_data = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
' };
                                                            if(is_single_day_operation){
                                                                var _fn_callbak = function() {
                                                                    get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                                }
                                                                excecute_request(urls, url_post_data, _fn_callbak);
                                                            }else
                                                                navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                        }else
                                                            bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['time_outside_oncall'];?>
', function(result){ });
                                                    }
                                                  });
                                            }else{
                                                var urls = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_right_click_actions.php';
                                                var url_post_data = { 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change ,'template_id':'<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
'};
                                                if(is_single_day_operation){
                                                    var _fn_callbak = function() {
                                                        get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                                    }
                                                    excecute_request(urls, url_post_data, _fn_callbak);
                                                }else
                                                    navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
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
", disabled: (included_candg_slots ? true : false)},
                                "paste": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste'];?>
", disabled: (included_candg_slots ? true : false)},
                                "paste_day": { "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste_day'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['paste_day'];?>
", disabled: (included_candg_slots ? true : false)},
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['process']==1){?> "sep11": "---------", <?php }?>
                            // "goto": {   
                            //             "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
", 
                            //             accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['go_to'];?>
", 
                            //             "items": {
                            //                 "go_to_employee":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>
" },
                            //                 "go_to_customer":{ "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
", accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
" }
                            //             }
                            //     },
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
", disabled: (included_candg_slots ? true : false) },
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_customer']==1){?>
                                                
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['fkkn']==1){?>
                                                "change_contract": { 
                                                    "name": "<?php echo $_smarty_tpl->tpl_vars['translate']->value['right_click_menu_contract'];?>
",
                                                    disabled: (included_candg_slots ? true : false),
                                                    accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['right_click_menu_contract'];?>
", 
                                                    "items" : {
                                                        "change_fk": { "name": "FK", accesskey: "FK", disabled: (included_candg_slots ? true : false) },
                                                        "change_kn": { "name": "KN", accesskey: "KN", disabled: (included_candg_slots ? true : false) },
                                                        "change_tu": { "name": "TU", accesskey: "TU", disabled: (included_candg_slots ? true : false) },
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
                                                }
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
", disabled: (included_candg_slots ? true : false) },<?php }?>
                                          
                                        }

                                },
                            <?php }?>
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
                                            var url_post_data = { 'ids': ids, 'action': 'slot_approve_candg', 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
', 'customer': '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
' };
                                            
                                            var processed_emp_names = [ ];
                                            $.each(ids_temp, function( index, value ) {
                                                var temp_sel_data_obj   = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub');
                                                processed_emp_names.push(temp_sel_data_obj.attr('data-employee-name'));

                                            });
                                            //console.log(processed_emp_names);
                                            //console.log(arrayUnique(processed_emp_names));
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
                                                        //url_post_data['yes_to_all'] = true;
                                                        var other_ids = [ ];
                                                        var processed_emps = [ ];
                                                            
                                                        $.each(ids_temp, function( index, value ) {
                                                            var temp_sel_data_obj   = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub');
                                                            var temp_sel_data_emp   = temp_sel_data_obj.attr('data-employee-id');
                                                            var temp_sel_data_cust  = temp_sel_data_obj.attr('data-customer-id');
                                                            
                                                            if($.inArray( temp_sel_data_emp, processed_emps ) == -1){

                                                                if(temp_sel_data_emp != '' && temp_sel_data_cust != ''){
                                                                    $( '#monthlyviewtbl .monthly_strips .slot-theme-candg input.slot_details_hub' ).each(function( index ) {
                                                                        if($(this).attr('data-employee-id') == temp_sel_data_emp && $(this).attr('data-customer-id') == temp_sel_data_cust && $(this).attr('data-id') != value){
                                                                            other_ids.push($(this).attr('data-id'));
                                                                        }
                                                                    });

                                                                    processed_emps.push(temp_sel_data_emp);
                                                                    //processed_emp_names.push(temp_sel_data_obj.attr('data-employee-name'));
                                                                }
                                                            }
                                                                
                                                        });
                                                        
                                                        var final_ids = ids_temp.concat(other_ids);
                                                        //console.log(url_post_data);
                                                        url_post_data['ids'] = final_ids.join('-');
                                                        //console.log(url_post_data);
                                                        /*console.log(other_ids);
                                                        console.log(final_ids);
                                                        console.log(processed_emps);
                                                        console.log(processed_emp_names);*/
                                                        navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                    }
                                                },{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        var is_single_day_operation = true;
                                                        var single_day_date = temp_single_day_date = '';
                                                        $.each(ids_temp, function( index, value ) {
                                                            //console.log( index + ": " + value );
                                                            temp_single_day_date = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                                            if(single_day_date != '' && temp_single_day_date != single_day_date){
                                                                is_single_day_operation = false;
                                                                return false;
                                                            }
                                                            single_day_date = temp_single_day_date;
                                                        });
                                                        if(is_single_day_operation){
                                                            var _fn_callbak = function() {
                                                                get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                                            }
                                                            excecute_request(urls, url_post_data, _fn_callbak);
                                                        }else
                                                            navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
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
                                            var url_post_data = { 'ids': ids, 'action': 'multiple_slots_remove', 'sel_year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
', 'sel_month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
', 'customer' : '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
' };
                                            bootbox.dialog( '<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_reject_candg'];?>
', [{
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                                                    "class" : "btn-danger"
                                                }, {
                                                    "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        var is_single_day_operation = true;
                                                        var single_day_date = temp_single_day_date = '';
                                                        $.each(ids_temp, function( index, value ) {
                                                            //console.log( index + ": " + value );
                                                            temp_single_day_date = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                                                            if(single_day_date != '' && temp_single_day_date != single_day_date){
                                                                is_single_day_operation = false;
                                                                return false;
                                                            }
                                                            single_day_date = temp_single_day_date;
                                                        });
                                                        if(is_single_day_operation){
                                                            var _fn_callbak = function() {
                                                                get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', null, true);
                                                            }
                                                            excecute_request(urls, url_post_data, _fn_callbak);
                                                        }else
                                                            navigatePageWithMaintainScrollPosition(urls, 1, url_post_data);
                                                    }
                                            }]);
                                    }
                            };
                        <?php }?>
                    }
                    
                     //repalce context menu option.
            
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
                        // if(ids_temp.length == 2 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                        //      options.items.swap_switch = { 
                        //              "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
", 
                        //              accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
",
                        //              callback: function(key, opt){ 
                        //                         process_swap_switch_2_slots(ids);
                        //              }
                        //      };
                        // }
                        
                        //slot copy for swap
                        // if(ids_temp.length == 1 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                        //      options.items.swap_copy = { 
                        //              "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap_copy'];?>
", 
                        //              accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap_copy'];?>
",
                        //              callback: function(key, opt){ 
                        //                         process_swap_copy_first_slot(ids);
                        //              }
                        //      };
                        // }
                        
                        //slot swap past from copied slot
                        // if(ids_temp.length == 1 && '<?php echo $_smarty_tpl->tpl_vars['swap_copied_slot']->value;?>
' != '' && ids_temp != '<?php echo $_smarty_tpl->tpl_vars['swap_copied_slot']->value;?>
' && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                        //      options.items.swap_past = { 
                        //              "name":"<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
", 
                        //              accesskey: "<?php echo $_smarty_tpl->tpl_vars['translate']->value['swap'];?>
",
                        //              callback: function(key, opt){ 
                        //                         process_swap_past_with_second_slot(ids);
                        //              }
                        //      };
                        //  }
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
                                        var slot_obj = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox.m_check[value='+ids+']').parents('.monthlyslotview').find('input.slot_details_hub');
                                        var from_time = slot_obj.attr('data-time-from');
                                        var to_time = slot_obj.attr('data-time-to');

                                        $( '#monthlyviewtbl .monthly_strips input.slot_details_hub' ).each(function( index ) {
                                            if($(this).attr('data-time-from') == from_time && $(this).attr('data-time-to') == to_time && $(this).attr('data-id') != selected_id){
                                                $(this).parents('.monthlyslotview.slot:not(:hidden)').find('input:checkbox.m_check').attr('checked', true);
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
                                        $('#monthlyviewtbl .monthly_strips .monthlyslotview input:checkbox.m_check').attr('checked', false);
                                        $('#monthlyviewtbl .all_check_week').attr('checked', false);
                                        $('#monthlyviewtbl .week_row .all_check_day').attr('checked', false);
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
ajax_template_alloc_action_month.php",
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
ajax_template_customers_employees_change.php",
                        type:   "POST",
                        data:   "employee_username="+selected_user+"&ids="+selected_slots+"&action=check_overlap",
                        success:function(data){
                            console.log(data);
                                if($.trim(data) == 'sucess'){
                                    saveChangeUserMultipleConfirm();
                                }else
                                    bootbox.alert("<?php echo $_smarty_tpl->tpl_vars['translate']->value['overlapped'];?>
 " + data, function(result){ });
                        }
                    }).always(function(data) { 
                        uwrapLoader('#right_click_action_options');
                    });
                }
                else if(change_usertype == 'customer')
                    saveChangeUserMultipleConfirm();
            }

            function saveChangeUserMultipleConfirm(){ 
                var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
                var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
                var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

                var url = "customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&sel_year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&sel_month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&method=1&ids="+selected_slots;
                if(change_usertype == 'employee') url += "&employee_username="+selected_user;
                else if(change_usertype == 'customer') url += "&customer_select="+selected_user;

                var is_single_day_operation = true;
                var single_day_date = temp_single_day_date = '';
                if(selected_slots != ''){
                    var ids_temp = selected_slots.split("-");
                    //console.log(ids_temp);
                    $.each(ids_temp, function( index, value ) {
                        //console.log( index + ": " + value );
                        temp_single_day_date = $('#monthlyviewtbl #slot_thread_'+value).find('.slot_details_hub').attr('data-date');
                        if(single_day_date != '' && temp_single_day_date != single_day_date){
                            is_single_day_operation = false;
                            return false;
                        }
                        single_day_date = temp_single_day_date;
                    });
                }

                var atl_req_data = url+'&type_check=17&right_click=1';
                var process_url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_alter_slot_employee_customer.php?'+url;
                
                                    close_right_panel();
                                    //navigatePageWithMaintainScrollPosition(this_url, 1);
                                    if(is_single_day_operation && single_day_date != ''){
                                        process_url += '&no_refresh_whole=TRUE'
                                        var _fn_callbak = function() {
                                            get_day_refresh(single_day_date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                                        }
                                        excecute_request(process_url, { }, _fn_callbak);
                                    }else
                                        navigatePageWithMaintainScrollPosition(process_url, 1);
            }
        <?php }?>
        
        function copyMonthlySlot(){
            var ids = '';
            var values = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check').map(function () {
                    return this.value;
            }).get();    

            for(var i=0; i < values.length; i++)
                ids += values[i]+'-';

            if(ids != ''){
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php?sel_year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&sel_month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&action=copy_select&slots='+ids;
                var url_data = 'sel_year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&sel_month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&action=copy_select&slots='+ids;
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                        url: "<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php",
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
ajax_template_slot_process.php?date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&action=paste_select';
                    var url_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8'
                    var atl_req_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8';
                }else{
                    var year_month = '<?php echo (($_smarty_tpl->tpl_vars['selected_year']->value).('|')).($_smarty_tpl->tpl_vars['selected_month']->value);?>
';
                    var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php?date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&action=paste_select&sub_action=past_in_month'; 
                    var url_data = 'date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&sub_action=past_in_month';
                    var atl_req_data = 'date='+year_month+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&sub_action=past_in_month';
                }
            }
            else{
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php?date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&action=paste_select&to_single_day='+action_type; 
                var url_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&to_single_day='+action_type;
                var atl_req_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select&type_check=8&to_single_day='+action_type;
            }
           
                    wrapLoader("#external_wrapper");
                    $('#div_alloc_action').load(url,function(response, status, xhr){ 
                        uwrapLoader("#external_wrapper"); 
                        if(action_type == 'TRUE'){

                            get_day_refresh(date, '<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', null, true);
                        } 
                        else
                            navigatePageWithMaintainScrollPosition('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1); });
        }
        
        function pasteSlotDay(action_type, date, week_year){
            action_type = action_type || 'FALSE';
            date = date || '';
            week_year = week_year || '';
            if(date == ''){
                if(week_year != ''){
                    var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php?date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&action=paste_select_day';
                    var url_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8'
                    var atl_req_data = 'date='+week_year+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8';
                }else
                    return false;
            }
            else{
                var url = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_template_slot_process.php?date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&template_id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&action=paste_select_day&to_single_day='+action_type; 
                var url_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8&to_single_day='+action_type;
                var atl_req_data = 'date='+date+'&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
&emp_alloc=<?php echo $_smarty_tpl->tpl_vars['login_user']->value;?>
&action=paste_select_day&type_check=8&to_single_day='+action_type;
            }
                    
                                wrapLoader("#external_wrapper");
                                $('#div_alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#external_wrapper");
                                    navigatePageWithMaintainScrollPosition('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_month_apply_update_schedule.php?id=<?php echo $_smarty_tpl->tpl_vars['schedule_id']->value;?>
&year=<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
', 1); });
        }
        
        function popupAddSlot(date) {
            date = (typeof date != 'undefined' ? date : '');
            
            if(date != ''){

                $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', date);
                $('.add-new-slots-month #new_slot_from').focus();
            }
            
            $("#add-slots").trigger('click',['right_click_add',date]);
        }
        
        <?php if ($_smarty_tpl->tpl_vars['privileges_gd']->value['add_employee']==1){?>
            function loadPopupReplaceProcessMain(ids) {
                //loadPopupReplaceProcessMain('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
gdschema_process_main_4_month.php?year=<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
&month=<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
&customer=<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
&slot_id='+ids);


                var slot_obj = $('#monthlyviewtbl .monthlyslotview input:checkbox.m_check[value='+ids+']').parents('.monthlyslotview');
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
                                            'request_from': 'monthly_view',
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
                                    scrollTop: 0
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
                    var rep_emp = $('#sms-for-emp-allocation .send_employees_list_sms[name=send_employees_liSt_sms]').val();
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
                         'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection, 'request_from': 'monthly_view' };

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
                                scrollTop: 0
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
                    var slot_data = $('#monthlyviewtbl #slot_thread_'+ids).find('.slot_details_hub');
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

        function printSchedule() {
            $('.fixed-scrolling-tbl').removeClass('fixed-scrolling-tbl');
             if($(window).height() > 600)
                 $('table#monthlyviewtbl').floatThead('destroy');
            $('.fixed-scrolling-tbl').css('height', 'auto').css('overflow-y', 'auto');
            setTimeout(function(){ $('#schedule_det').print();},1000);
            window.onfocus = function() {
                $('.fixed-scrolling-tbl').css('height', '450px').css('overflow-y', '');
                if($(window).height() > 600){
                    $demo1.floatThead({
                            scrollContainer: function($demo1){
                                    return $demo1.closest('.fixed-scrolling-tbl');
                            }
                    });
                    $demo1.floatThead('reflow');
                }
            };
        }
    </script>
    

<?php }} ?>