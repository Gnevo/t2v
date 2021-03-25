<?php /* Smarty version Smarty-3.1.8, created on 2020-12-06 15:17:52
         compiled from "/home/time2view/public_html/cirrus/templates/gdschema_month_apply_schedule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8458020325fccf6202e98f9-97836856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da448700692d46f627a859602337257056005325' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/gdschema_month_apply_schedule.tpl',
      1 => 1566035956,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8458020325fccf6202e98f9-97836856',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'flag_cust_access' => 0,
    'message' => 0,
    'translate' => 0,
    'selected_year' => 0,
    'selected_month' => 0,
    'selected_customer' => 0,
    'privileges_general' => 0,
    'customer_details' => 0,
    'customer_schedules' => 0,
    'schedule' => 0,
    'selected_schedule' => 0,
    'template_start_date' => 0,
    'mIndex' => 0,
    'no_of_times' => 0,
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
    'slot' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fccf6204b6550_46276620',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fccf6204b6550_46276620')) {function content_5fccf6204b6550_46276620($_smarty_tpl) {?>
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
                                <?php echo $_smarty_tpl->tpl_vars['translate']->value['template_view'];?>

                                <ul class="pull-right no-print">

                                    <li onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/',1);"><i class="icon-arrow-left"></i><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['back'];?>
</span></a></li>
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['create_template']==1){?>
                                        <li onclick="delete_template();"><i class="icon-trash "></i></span><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['delete_template'];?>
</span></a></li>
                                    <?php }?>
                                    <li onclick="printSchedule();"><i class="icon-print"></i><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</span></a></li>
                                    <li onclick="conformScheduleSave()"><i class=" icon-save "></i></span><a href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['translate']->value['apply_template'];?>
</span></a></li>
                                </ul>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="span12 option-panel-wrpr" style="margin-left: 0px;">
                    <div style="margin-top: 0px; margin-bottom: 10px;" class="widget">
                        <div class="widget-body" style="padding:9px 5px">
                            <div class="row-fluid">
                                <div class="span12" style="margin-left: 1.49254%; margin-bottom: 4px;">
                                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
: <b><?php echo (($_smarty_tpl->tpl_vars['customer_details']->value['last_name']).(' ')).($_smarty_tpl->tpl_vars['customer_details']->value['first_name']);?>
</b>
                                </div>
                                <div class="span12 no-print">
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="cmb_template_name"><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_template'];?>
</label>
                                        <select class="span12" id="cmb_template_name" name="cmb_template_name">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <?php  $_smarty_tpl->tpl_vars['schedule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['schedule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer_schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['schedule']->key => $_smarty_tpl->tpl_vars['schedule']->value){
$_smarty_tpl->tpl_vars['schedule']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value['tid'];?>
" <?php if ($_smarty_tpl->tpl_vars['schedule']->value['tid']==$_smarty_tpl->tpl_vars['selected_schedule']->value){?>selected='selected'<?php }?>><?php echo stripslashes($_smarty_tpl->tpl_vars['schedule']->value['temp_name']);?>
</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="templatePrvStartDate"><?php echo $_smarty_tpl->tpl_vars['translate']->value['copy_start_date'];?>
</label>
                                        <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11" id="templatePrvStartDate" value="<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
" name="templatePrvStartDate" type="text" />
                                        </div>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label" for="cmb_no_of_times"><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_of_times'];?>
</label>
                                        <select class="span12" id="cmb_no_of_times" name="cmb_no_of_times">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                            <?php $_smarty_tpl->tpl_vars['mIndex'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['mIndex']->step = 1;$_smarty_tpl->tpl_vars['mIndex']->total = (int)ceil(($_smarty_tpl->tpl_vars['mIndex']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['mIndex']->step));
if ($_smarty_tpl->tpl_vars['mIndex']->total > 0){
for ($_smarty_tpl->tpl_vars['mIndex']->value = 1, $_smarty_tpl->tpl_vars['mIndex']->iteration = 1;$_smarty_tpl->tpl_vars['mIndex']->iteration <= $_smarty_tpl->tpl_vars['mIndex']->total;$_smarty_tpl->tpl_vars['mIndex']->value += $_smarty_tpl->tpl_vars['mIndex']->step, $_smarty_tpl->tpl_vars['mIndex']->iteration++){
$_smarty_tpl->tpl_vars['mIndex']->first = $_smarty_tpl->tpl_vars['mIndex']->iteration == 1;$_smarty_tpl->tpl_vars['mIndex']->last = $_smarty_tpl->tpl_vars['mIndex']->iteration == $_smarty_tpl->tpl_vars['mIndex']->total;?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['mIndex']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['no_of_times']->value==$_smarty_tpl->tpl_vars['mIndex']->value){?>selected='selected'<?php }?>><?php echo $_smarty_tpl->tpl_vars['mIndex']->value;?>
</option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <div class="pull-left" style="margin-right: 10px;">
                                        <label style="float: left;" class="span12 template_label">&nbsp;</label>
                                        <button type="button" class="btn btn-success" onclick="applySchedule()"><span class="icon-save"></span> <?php echo $_smarty_tpl->tpl_vars['translate']->value['preview_template'];?>
</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                    
            <!-- Table -->
            <div class="row-fluid">
                <div class="span12">
                    <table style="margin:0;" class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th class="table-col-center no-print" style="border: 0 none;"><span class="btn btn-block btn-default span12"><i class="icon-calendar monthPicker" data-date="<?php echo (($_smarty_tpl->tpl_vars['selected_year']->value).('-')).($_smarty_tpl->tpl_vars['selected_month']->value);?>
" data-date-format="yyyy-mm" ></i></span></th>
                                <th class="table-col-center no-print" style="width:30px; border: 0 none;"></th>
                                <th colspan="4" style="border:0;" class="table-col-center"><span class="btn btn-block btn-default span12 calender-month"><span class="cur_month_header" data-year-month="<?php echo (($_smarty_tpl->tpl_vars['selected_year']->value).('|')).($_smarty_tpl->tpl_vars['selected_month']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['month_label']->value];?>
 <?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
</span></span></th>
                                <th class="table-col-center no-print" colspan="2" style="border: 0 none;"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr class="no-print">
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value-1;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);"  title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_previous_year'];?>
"><<</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['prv_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prv_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_previous_month'];?>
"><</span></th>
                                <th class="table-col-center" colspan="4"><span class="btn btn-block btn-default span12 calender-today" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['today_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['today_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_todays_month'];?>
"><i></i><?php echo $_smarty_tpl->tpl_vars['translate']->value['today'];?>
</span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['next_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_next_month'];?>
">></span></th>
                                <th class="table-col-center"><span class="btn btn-block btn-default span12" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value+1;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_next_year'];?>
">>></span></th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender clearfix" id="monthlyviewtbl">
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
                                    <td class="week_no_td" data-yearweek='<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
|<?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
' style="background:linear-gradient(to bottom, rgba(194, 234, 234, 1) 0%, rgba(164, 218, 221, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;">
                                        <ul class="calender-col-header span12" id="toggle-view" style="border-bottom: none; background: none;">
                                            <li title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_mini_maxi_week'];?>
"><input class="btn-mini btn-default btn-collapse-table-row no-print" type="button" value="-" /></li>
                                            <li><?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
</li>
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
                                            <td class="monthly_day<?php if ($_smarty_tpl->tpl_vars['week_day']->value['date']==$_smarty_tpl->tpl_vars['today_date']->value){?> selected_date<?php }?> clearfix" data-date='<?php echo $_smarty_tpl->tpl_vars['week_day']->value['date'];?>
'>
                                                <ul class="calender-col-header span12 monthlyslot_date clearfix">
                                                    <li><?php echo $_smarty_tpl->tpl_vars['week_day']->value['day'];?>
</li>
                                                </ul>
                                                <div class="monthly_strips clearfix">
                                                    <?php  $_smarty_tpl->tpl_vars['slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['week_day']->value['slots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot']->key => $_smarty_tpl->tpl_vars['slot']->value){
$_smarty_tpl->tpl_vars['slot']->_loop = true;
?>
                                                        <span class="collapse-slot clearfix">
                                                            <div class="slot monthlyslotview span12 <?php if ($_smarty_tpl->tpl_vars['slot']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==4){?>slot-theme-candg<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==0||$_smarty_tpl->tpl_vars['slot']->value['status']==3){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['status']==1&&$_smarty_tpl->tpl_vars['slot']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['slot']->value['type']==10){?>slot-theme-pm<?php }else{ ?>slot-theme-complete<?php }?> <?php if ($_smarty_tpl->tpl_vars['slot']->value['signed']==1){?>signed_slot<?php }?>"  
                                                                 onmouseover="tooltip.pop(this, '#slot_details_<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
', { position:1, offsetX:-20, effect:'slade' });" data-slot-id="<?php echo $_smarty_tpl->tpl_vars['slot']->value['id'];?>
" >
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
                                                                </div>
                                                            </div>
                                                        </span>
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
            <!-- // Table END -->
            <!-- // CALENDER END -->
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
js/date-picker.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/time_formats.js" type="text/javascript" ></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
    <script type="text/javascript">
        //didn't remove this js block from this location
        $(function(){
            $.contextMenu( 'destroy' );
        });
    </script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.contextmenu.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
'
            });
            
            //HEIGHT FIT
            $('.main-left').css({ height: $(window).innerHeight()-50 });
            $(window).resize(function(){
              $('.main-left').css({ height: $(window).innerHeight()-50 });
            });
            
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
            
            //datepicker_btstrap
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
schedule/month/gdschema/'+year+'/'+month+'/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['template_start_date']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['no_of_times']->value;?>
/',1);
            });
        });
        
        function applySchedule(){
            var schedule_id = $('#cmb_template_name').val();
            var PreviewStartDate = $.trim($('#templatePrvStartDate').val());
            var no_of_times = $.trim($('#cmb_no_of_times').val());
            if(schedule_id == ''){
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_template'];?>
');
                $('#cmb_template_name').focus();
            } 
            else if(PreviewStartDate == ''){
                alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['select_template_preview_start_date'];?>
');
                $('#templatePrvStartDate').focus();
            }
            else {
                //navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/'+schedule_id+'/'+PreviewStartDate+'/'+no_of_times+'/', 1);
                var objPreviewStartDate = new Date(PreviewStartDate);
                var PreviewDateYear = objPreviewStartDate.getFullYear();
                var PreviewDateMonth = (objPreviewStartDate.getMonth()+1);
                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
schedule/month/gdschema/'+PreviewDateYear+'/'+PreviewDateMonth+'/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/'+schedule_id+'/'+PreviewStartDate+'/'+no_of_times+'/', 1);
            }
        }
        function conformScheduleSave(){
            var PreviewStartDate = $.trim($('#templatePrvStartDate').val());
            var no_of_times = $.trim($('#cmb_no_of_times').val());

            var main_obj = { 'customer': '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', 'month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
', 'year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
', 'template': <?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
, 'PreviewStartDate': PreviewStartDate, 'no_of_times': no_of_times };

            wrapLoader('#external_wrapper');
            $.ajax({
                url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_apply_monthly_customer_schedule.php",
                type:"POST",
                dataType: 'json',
                data: main_obj,
                success:function(data){
                    if(data.transaction){
                        navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/', 1);
                    }else if(data.full_message !== undefined && data.full_message != ''){
                        $('#left_message_wraper').html(data.full_message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) { 
                uwrapLoader('#external_wrapper');
            });
        }

        <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['create_template']==1){?>
            function delete_template(){
                if(confirm('<?php echo $_smarty_tpl->tpl_vars['translate']->value['confirm_delete_template'];?>
')){
                    var main_obj = { 'customer': '<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
', 'month': '<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
', 'year': '<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
', 'template': <?php echo $_smarty_tpl->tpl_vars['selected_schedule']->value;?>
, 'action': 'delete' };

                    wrapLoader('#external_wrapper');
                    $.ajax({
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_apply_monthly_customer_schedule.php",
                        type:"POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            if(data.transaction){
                                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['selected_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selected_customer']->value;?>
/', 1);
                            }else if(data.full_message !== undefined && data.full_message != ''){
                                $('#left_message_wraper').html(data.full_message);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) { 
                        uwrapLoader('#external_wrapper');
                    });
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