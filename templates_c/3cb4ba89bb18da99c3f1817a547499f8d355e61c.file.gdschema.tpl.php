<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:38:36
         compiled from "/home/time2view/public_html/cirrus/templates/gdschema.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20057099195fcb632c601714-48316434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cb4ba89bb18da99c3f1817a547499f8d355e61c' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/gdschema.tpl',
      1 => 1565163064,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20057099195fcb632c601714-48316434',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'employees' => 0,
    'year_week' => 0,
    'cur_year' => 0,
    'cur_month' => 0,
    'translate' => 0,
    'message' => 0,
    'expire_days' => 0,
    'expire_days_actual' => 0,
    'user_role' => 0,
    'cur_week' => 0,
    'customers_to_allocate' => 0,
    'customer_to_allocate' => 0,
    'sort_by_name' => 0,
    'user_slots' => 0,
    'slot_det' => 0,
    'year' => 0,
    'month' => 0,
    'day' => 0,
    'prv_year' => 0,
    'prv_month' => 0,
    'cur_day' => 0,
    'month_label' => 0,
    'next_year' => 0,
    'next_month' => 0,
    'weeks_days' => 0,
    'week_day' => 0,
    'month_weeks' => 0,
    'month_week' => 0,
    'months' => 0,
    'week_shedules' => 0,
    'weeks' => 0,
    'week' => 0,
    'user_id' => 0,
    'tbl_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb632c75d712_39604230',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb632c75d712_39604230')) {function content_5fcb632c75d712_39604230($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
?>
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/widget-timeline.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #header-fixed { 
            position: fixed; 
            top: 0px; display:none;
            background-color:white;
        }
        .tooltip.top { margin-top: -10px; }
        .expiry{
            background: #7d7e7d; /* Old browsers */
            background: -moz-linear-gradient(top,  #7d7e7d 0%, #0e0e0e 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7d7e7d), color-stop(100%,#0e0e0e)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* IE10+ */
            background: linear-gradient(to bottom,  #7d7e7d 0%,#0e0e0e 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#0e0e0e',GradientType=0 ); /* IE6-9 */

            width: 300px;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            z-index: 1000;
            border-radius: 3px;
            padding: 7px;
            color: #fff;
            font-size: 13px;
            text-align:center;
            letter-spacing: 1px;
            -webkit-box-shadow: -3px 4px 5px -3px rgba(0,0,0,0.75);
            -moz-box-shadow: -3px 4px 5px -3px rgba(0,0,0,0.75);
            box-shadow: -3px 4px 5px -3px rgba(0,0,0,0.75);
            vertical-align:middle;

        }
        .expiry .close{
            background: none repeat scroll 0% 0% #F00;
            color: #FFF;
            float: right;
            border-radius: 4px;
            font-size: 9px;
            width: 13px;
            padding: 2px 0px 1px 0px;
            height: auto;
            font-weight: bold;
            border: solid 1px #F28080;
            text-align: center;
            cursor: pointer;
        }
        .scroll-pane, .scroll-pane-arrows { width: 100%; height: 250px; overflow: auto; }
        .horizontal-only { height: auto; max-height: 250px; }
        .customer_search_wrapper { padding: 5px; background-color: #c4c4c4; margin-right: 9px; }
        .customer_search_wrapper input#customer_search{ width: 233px !important; padding: 2px; }
        #gdschema_kund table tr.hidden_row{ display: none; }
        ::-ms-clear, ::-ms-reveal {
            display: none;
            width : 0;
            height: 0;
        }
        .ui-autocomplete.ui-menu.ui-widget{ max-height: 120px; overflow-y: auto;}
    </style>




   <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery.floatThead.min.js" type="text/javascript" ></script>
   

    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/time_formats.js?v=<?php echo filemtime('js/time_formats.js');?>
" type="text/javascript" ></script>
       
<script>
    $(document).ready(function(){
        //alert($(window).height());
        if($(window).height() > 600)
            $('#gdschema_kund').css({ height: $(window).height()-305}); 
        else
            $('#gdschema_kund').css({ height: $(window).height()});    

        $(window).resize(function(){
            if($(window).height() > 600)
                $('#gdschema_kund').css({ height: $(window).height()-305}); 
            else
                $('#gdschema_kund').css({ height: $(window).height()});  
        });  
        
        $(".time-devider").mouseover(function(){
            var view_id = $(this).attr('data-id');
            $(".slot-timeline").each(function(){
                
                if($(this).attr('data-id') == view_id){
                    $(this).addClass("active-time-devider");
                }
            });
        });


        $(".time-devider").mouseout(function(){
            var view_id = $(this).attr('data-id');
            $(".slot-timeline").each(function(){
                
                if($(this).attr('data-id') == view_id){
                    $(this).removeClass("active-time-devider");
                }
            });
        });
        
        $(".slot-timeline").mouseover(function(){
            var view_id = $(this).attr('data-id');
            //var s = $(this);
            $(".time-devider").each(function(){
                
                if($(this).attr('data-id') == view_id){
                    $(this).addClass("active-time-slot");
                    $(this).find('.innerInfo').tooltip('show');
                }
            });
            
        });

        $(".slot-timeline").mouseout(function(){
            var view_id = $(this).attr('data-id');
            $(".time-devider").each(function(){
                    if($(this).attr('data-id') == view_id){
                        $(this).removeClass("active-time-slot");
                        $(this).find('.innerInfo').tooltip('hide');
                }
            });
        });
        
        $( "#employee_search" ).autocomplete({
            source: <?php echo $_smarty_tpl->tpl_vars['employees']->value;?>
,
            select: function( event, ui ) {
                 //this.value = ui.item.value;
                //$("#selected_affected_user").val(ui.item.id);
                var selected_user = ui.item.uname;
                //console.log(selected_user);
                if(selected_user != ''){
                    filter_summery_data(selected_user);
                }
            }
        });
        
        $.extend( $.ui.autocomplete, {
            escapeRegex: function( value ) {
                return value.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
            },
            escapeRegexPhone: function( value ) {
                return value.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "").replace(/^0+/, '');
            },
            filter: function(array, term) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
                var matcherPhone = new RegExp( $.ui.autocomplete.escapeRegexPhone(term), "i" );
                return $.grep( array, function(value) {
                    return (matcher.test( value.label ) || matcher.test(value.uname) || matcher.test(value.code) || matcher.test(value.ssn) || matcherPhone.test(value.mobile) || matcherPhone.test(value.phone));
                });
            }
        });
    });
    
    function filter_summery_data(user){
        var obj_process = { action: 'get_customers', related_employee: user, view: 'customer', 'year_week': '<?php echo $_smarty_tpl->tpl_vars['year_week']->value;?>
'};
        
        wrapLoader("#gdschema_kund");
        $.ajax({
            url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_customer_employee_gdschema_summery.php",
            type:"POST",
            dataType: 'json',
            data: obj_process,
            success:function(data){
                //console.log(data);
                update_summery_data(data);
            }
        }).always(function(data) {
            uwrapLoader("#gdschema_kund");
        });
    }
    
    function update_summery_data(data){
        var $tbl_data = '';
        if(data.length > 0){
            $.each(data, function(i, $data) {
                $tbl_data += '<tr class="cust_name1">';
                    $tbl_data += '<td class="col-fixed-width-customersname cust_name">';
                    $tbl_data += '<a onclick="navigatePage(\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
month/gdschema/<?php echo $_smarty_tpl->tpl_vars['cur_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['cur_month']->value;?>
/'+$data.username+'/\',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_go_to_monthly_view'];?>
">'+$data.full_name+'</a>';
                    $tbl_data += '<span class="hide row-data" data-username="'+$data.username+'" data-code="'+$data.code+'" data-SSN="'+$data.ssn+'" ></span>';
                    $tbl_data += '</td>';
                    if($data.summery_values.length > 0){
                        $.each($data.summery_values, function(i, $summery) {
                            $tbl_data += '<td class="table-col-center '+$summery.highlight_class+'">';
                            $tbl_data += '<a onclick="navigatePage(\'<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/'+$summery.year_week+'/'+$data.username+'/\',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_goto_week'];?>
">';
                                if ($summery.total_hours != 0)
                                    $tbl_data += $summery.allocation + ($summery.allocation != $summery.total_hours ? (' / '+$summery.total_hours) : '');
                                else
                                    $tbl_data += '---';
                            $tbl_data += '</a></td>';
                        });
                    }
                $tbl_data += '</tr>';
            });
        }
        $('.gdschema-summery-content').html($tbl_data);
    }
        
    function refresh_summery(){
        var emp_search_qry = $( "#employee_search" ).val();
        if(emp_search_qry == ''){
            filter_summery_data(emp_search_qry);
        }
    }
    
    function go_to_emp_gdschema_summary(){
        $.cookie("startup_summery_view", 'employee', { path: '/', expires: 7});
        document.location = '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all/employee/gdschema/l/';
    }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.expiry').delay(30000).fadeOut();

            $('#customer_search').on('keyup', function(e) {
                //if( e.which == 8 || e.which == 46 ) 
                fetch_customers();
            });
        });
        function navigateCalender(path) {

            $('#calendar-container').load(path);
        }
        function fetch_customers() {
            var search_val = $("#customer_search").val();
            search_val = search_val.toLowerCase().replace(/[+]/g, "");

            var phone_search_val = search_val.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "").replace(/^0+/, '');
            // console.log(phone_search_val);
            if (search_val == '') {
                //console.log('no val');
                $('#gdschema_kund table tr').each(function() {
                    $(this).removeClass('hidden_row');
                });
            } else {
                $('#gdschema_kund table tr.cust_name1').each(function() {
                    var obj_ref = $(this).find('td.cust_name');
                    var obj_ref_data_set = $(obj_ref).find('span.row-data');
                    
                    var row_name = $(obj_ref).find('a').html().toLowerCase();
                    var row_uname = $(obj_ref_data_set).attr('data-username').toLowerCase();
                    var row_code = $(obj_ref_data_set).attr('data-code').toLowerCase();
                    var row_ssn = $(obj_ref_data_set).attr('data-ssn').toLowerCase();
                    var row_mobile = $(obj_ref_data_set).attr('data-mobile').toLowerCase();
                    var row_phone = $(obj_ref_data_set).attr('data-phone').toLowerCase();
                    
                    var regExp = new RegExp(search_val, 'i');
                    var regExpPhone = new RegExp(phone_search_val, 'i');
                    if (regExp.test(row_name) || regExp.test(row_uname) || regExp.test(row_code) || regExp.test(row_ssn) || regExpPhone.test(row_mobile) || regExpPhone.test(row_phone))
                        $(this).removeClass('hidden_row');
                    else
                        $(this).addClass('hidden_row');
                });
            }
        }
    </script>
    <script>
        var $demo1 = $('table.table-list-customers');
        $demo1.floatThead({
                scrollContainer: function($demo1){
                        return $demo1.closest('#gdschema_kund');
                }
        });
        
        function pad2number(number) {
            return (number < 10 ? '0' : '') + number;
        }
        
        function monthReloadCalendar(year, month, day){
            var month_first_date = year+'-'+pad2number(month)+'-01';
            var week = pad2number(date('W', strtotime(month_first_date)));
            //console.log(month_first_date);
            //console.log(week);
            navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all/gdschema/'+year+'|'+week+'/'+month_first_date+'/',1);
            
        }
    </script>


    <div class="row-fluid">
        <div class="span12 main-left slot-form">


            <div class="row-fluid">
                <div class="span12 tablet-column-reset">
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                    <?php if ($_smarty_tpl->tpl_vars['expire_days']->value<=$_smarty_tpl->tpl_vars['expire_days_actual']->value){?>
                        <div class="expiry">
                            <div class="close" onclick="this.parentNode.parentNode.removeChild(this.parentNode); return false;">X</div>
                            <?php echo $_smarty_tpl->tpl_vars['translate']->value['password_expiry_message_left'];?>
 <?php echo $_smarty_tpl->tpl_vars['expire_days']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['password_expiry_message_right'];?>

                        </div>
                    <?php }?>
                    <div class="row-fluid" id="upper_customer_list">
                        <div class="span7" style="padding-bottom:0;">
                            <!-- widget 1 -->
                            
                            <div class="widget widget-heading-simple widget-body-white" data-toggle="collapse-widget " style="margin-bottom: 0px !important">
                                <div class="widget-body table-1">
                                    <?php if ($_smarty_tpl->tpl_vars['user_role']->value!=3){?>
                                        <div class="table-head-min"> <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer_list'];?>
 <?php echo $_smarty_tpl->tpl_vars['cur_year']->value;?>
 v<?php echo $_smarty_tpl->tpl_vars['cur_week']->value;?>
</h1></div>
                                        <div class="table-height-fix customer-list-table-height-fix slot-form" style="height: 189px ! important;">
                                            <table class="footable table table-striped table-bordered table-white table-primary">
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
                                                        <td style="width:100px;"><a onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['first_date'];?>
/<?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['customer_id'];?>
/',1);" href="javascript:void(0);"><span><?php echo $_smarty_tpl->tpl_vars['customer_to_allocate']->value['total_hours'];?>
h</span></a></td>
                                                    </tr>
                                                    <?php } ?>
                                               </tbody>
                                            </table>
                                        </div>
                                    <?php }else{ ?>
                                        
                                        <div class="table-head-min"> <h1><?php echo $_smarty_tpl->tpl_vars['translate']->value['timeline'];?>
</h1></div>
                                        <div tabindex="1" style="overflow: auto;" class="timeline-table-height-fix">
                 
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <div class="span12 time-line-slots-wrpr">
                                                            <ul class="time-line-slots">
                                                                <?php  $_smarty_tpl->tpl_vars['slot_det'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot_det']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['user_slots']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot_det']->key => $_smarty_tpl->tpl_vars['slot_det']->value){
$_smarty_tpl->tpl_vars['slot_det']->_loop = true;
?>
                                                                <li>
                                                                    <div data-id="<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['id'];?>
" class="slot-timeline <?php if ($_smarty_tpl->tpl_vars['slot_det']->value['status']==0){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==1){?>slot-theme-complete<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==1&&$_smarty_tpl->tpl_vars['slot_det']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==4){?>slot-theme-candg<?php }?> ">
                                                                        <div class="slot-timeline-icon slot-icon-small 
                                                                            <?php if ($_smarty_tpl->tpl_vars['slot_det']->value['type']==1){?>slot-icon-small-travel
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==0){?>slot-icon-small-normal
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==2){?>slot-icon-small-break
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==3){?>slot-icon-small-oncall
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==4){?>slot-icon-small-over-time
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==5){?>slot-icon-small-qualtiy-overtime
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==6){?>slot-icon-small-more-time
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==14){?>slot-icon-small-oncall-moretime
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==7){?>slot-icon-small-some-other-time
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==8){?>slot-icon-small-training
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==9){?>slot-icon-small-call-training
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==10){?>slot-icon-small-personal-meeting
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==11){?>slot-icon-small-voluntary
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==12){?>slot-icon-small-complimentary
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==13){?>slot-icon-small-complimentary-oncall
                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['type']==15){?>slot-icon-small-standby<?php }?>
                                                                             ">
                                                                        </div>
                                                                        <div class="slot-timeline-time-name"><?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot'];?>
 (<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot_hour'];?>
)<br>
                                                                           <?php echo $_smarty_tpl->tpl_vars['slot_det']->value['cust_name'];?>
</div>
                                                                        <div class="slot-timeline-type">
                                                                            <?php if ($_smarty_tpl->tpl_vars['slot_det']->value['fkkn']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['fk'];?>

                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['fkkn']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['kn'];?>

                                                                            <?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['fkkn']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['tu'];?>
<?php }?>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="row-fluid">
                                                                <div class="span1 timeline-wrpr timeline-wrpr-label" style="border-right:0; margin-left:3px;">
                                                                    <ul class="time-line-label">
                                                                            <li style="border-bottom: solid thin #ccc; padding-bottom: 3px;"><i class="icon-suitcase"></i>
                                                                            </li>
                                                                        <li ><i class="icon-time"></i></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="span11 timeline-wrpr" style="margin:0; float:left;">
                                                                    <div class="row-fluid">
                                                                        <div class="span12 min-height-15">
                                                                            <ul class="span12 time-set">
                                                                            <?php  $_smarty_tpl->tpl_vars['slot_det'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot_det']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['user_slots']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot_det']->key => $_smarty_tpl->tpl_vars['slot_det']->value){
$_smarty_tpl->tpl_vars['slot_det']->_loop = true;
?>
                                                                                <?php if ($_smarty_tpl->tpl_vars['slot_det']->value['slot_difference']!=0){?>
                                                                                    <li style="width:<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot_difference']*4.16;?>
%"></li>
                                                                                <?php }?>    
                                                                                <li data-id="<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['id'];?>
" class="time-devider <?php if ($_smarty_tpl->tpl_vars['slot_det']->value['status']==0){?>slot-theme-incomplete<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==1){?>slot-theme-complete<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==2){?>slot-theme-leave<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==1&&$_smarty_tpl->tpl_vars['slot_det']->value['created_status']==1){?>slot-theme-candg-accept<?php }elseif($_smarty_tpl->tpl_vars['slot_det']->value['status']==4){?>slot-theme-candg<?php }?>" style=" width:<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot_hour']*4.16;?>
%"><div class="innerInfo" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 100%;" data-title="<?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot'];?>
" data-placement="top" data-toggle="tooltip"><?php echo $_smarty_tpl->tpl_vars['slot_det']->value['slot'];?>
</div></li>
                                                                            <?php } ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row-fluid time-count-wrpr">
                                                                        <div class="span12 min-height-15">
                                                                            <ul class="span12 timeline">
                                                                                <li style="border-left:solid thin #ccc;"></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                                <li></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row-fluid time-count-wrpr">
                                                                        <div class="span12">
                                                                            <ul class="span12 timeline-number">
                                                                                <li ><span style="float:left; margin:0;">0</span><span>1</span></li>
                                                                                <li><span>2</span></li>
                                                                                <li><span>3</span></li>
                                                                                <li><span>4</span></li>
                                                                                <li><span>5</span></li>
                                                                                <li><span>6</span></li>
                                                                                <li><span>7</span></li>
                                                                                <li><span>8</span></li>
                                                                                <li><span>9</span></li>
                                                                                <li><span>10</span></li>
                                                                                <li><span>11</span></li>
                                                                                <li><span>12</span></li>
                                                                                <li><span>13</span></li>
                                                                                <li><span>14</span></li>
                                                                                <li><span>15</span></li>
                                                                                <li><span>16</span></li>
                                                                                <li><span>17</span></li>
                                                                                <li><span>18</span></li>
                                                                                <li><span>19</span></li>
                                                                                <li><span>20</span></li>
                                                                                <li><span>21</span></li>
                                                                                <li><span>22</span></li>
                                                                                <li><span>23</span></li>
                                                                                <li><span>24</span></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                    <?php }?>      
                                </div>
                            </div>
                        </div>
                        <div class="span5 calender-small" id="calendar-container" style="overflow:visible">
                            <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">

                                <thead>
                                    <tr>
                                        <th style="width: 40px;" onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['year']->value-1;?>
/<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-left"></i></span></th>
                                        <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['prv_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prv_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/')"><span class="btn btn-block btn-default span12"><i class="icon-angle-left"></i></span></th>
                                        <th colspan="4" class="table-col-center center" onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['cur_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['cur_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['cur_day']->value;?>
/')"><?php echo $_smarty_tpl->tpl_vars['translate']->value[$_smarty_tpl->tpl_vars['month_label']->value];?>
, <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</th>
                                        <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['next_year']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/')"><span class="btn btn-block btn-default span12"><i class="icon-angle-right "></i></span></th>
                                        <th onclick="navigateCalender('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax/calender/<?php echo $_smarty_tpl->tpl_vars['year']->value+1;?>
/<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
/')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-right"></i></span></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="table-col-center">V</th>
                                        <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks_days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
/');" class="table-col-center weeks-small-calender" style="width:40px;"><?php echo $_smarty_tpl->tpl_vars['month_week']->value['week']['week'];?>
</td>
                                            <?php  $_smarty_tpl->tpl_vars['week_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month_week']->value['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week_day']->key => $_smarty_tpl->tpl_vars['week_day']->value){
$_smarty_tpl->tpl_vars['week_day']->_loop = true;
?>
                                                <td onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
all/gdschema/<?php echo $_smarty_tpl->tpl_vars['week_day']->value['year'];?>
|<?php echo $_smarty_tpl->tpl_vars['week_day']->value['week'];?>
/<?php echo $_smarty_tpl->tpl_vars['week_day']->value['date'];?>
/',1);" class="table-col-center <?php if ($_smarty_tpl->tpl_vars['week_day']->value['type']=='old'){?>coming-days<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='current'){?>today-small-calender<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='holiday'){?>off-days<?php }elseif($_smarty_tpl->tpl_vars['week_day']->value['type']=='redday'){?>off-days<?php }elseif((smarty_modifier_date_format($_smarty_tpl->tpl_vars['week_day']->value['date'],'%u'))==7){?>off-days<?php }?>"><?php echo $_smarty_tpl->tpl_vars['week_day']->value['day'];?>
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
                                            </ul>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div> 

                        <!--//////////////////////////////////////////////////TOP WIDGETS END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

                    </div>     
                    <div class="row-fluid">
                        <div class="span12 customer-dtls-home" style="height: auto !important;">
                                <div class="widget widget-heading-simple widget-body-white no-mb" data-toggle="collapse-widget " style="padding-top:0; margin-top:0 !important;">
                                    <div  id="gdschema_kund" style=" overflow-y: auto;">
                                        <div class="span12 ">
                                            <table class="footable table table-striped table-bordered table-white table-primary table-list-customers">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $_smarty_tpl->tpl_vars['translate']->value['customer'];?>
&nbsp;(<?php echo count($_smarty_tpl->tpl_vars['week_shedules']->value);?>
 st)
                                                            <span class="btn btn-mini btn-info pull-right mr" onclick="go_to_emp_gdschema_summary();"><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee_summary_view'];?>
</span>
                                                        </th>
                                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                                        <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
?>
                                                        <th><?php if ($_smarty_tpl->tpl_vars['user_role']->value==4||$_smarty_tpl->tpl_vars['user_role']->value==3){?><a onclick="navigatePage('<?php if ($_smarty_tpl->tpl_vars['user_role']->value==4){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
customer/gdschema/<?php echo $_smarty_tpl->tpl_vars['week']->value['year_week'];?>
/<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
/<?php }elseif($_smarty_tpl->tpl_vars['user_role']->value==3){?><?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/gdschema/<?php echo $_smarty_tpl->tpl_vars['week']->value['year_week'];?>
/<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
/<?php }?>',1);" href="javascript:void(0);" title="<?php echo $_smarty_tpl->tpl_vars['translate']->value['tltp_go_to_customer_employee_week_page'];?>
">V<?php echo $_smarty_tpl->tpl_vars['week']->value['week'];?>
</a><?php }else{ ?>V<?php echo $_smarty_tpl->tpl_vars['week']->value['week'];?>
<?php }?></th>
                                                        <?php } ?>
                                                    </tr>
                                                
                                                    <tr>
                                                        <th class="search-table" colspan="6">
                                                            <input id="customer_search" class="span3" data-key-placeholder="placeholder_search" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_customer'];?>
" type="text" style="min-height: 20px;" />
                                                            <input id="employee_search" class="span3" data-key-placeholder="placeholder_search" placeholder="<?php echo $_smarty_tpl->tpl_vars['translate']->value['search_employee'];?>
" type="text" onemptied="refresh_summery()" oninput="refresh_summery()" style="min-height: 20px;margin-left: 10px;" />
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody class='gdschema-summery-content'>
                                                    <?php echo $_smarty_tpl->tpl_vars['tbl_data']->value;?>

                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- // Wwidget 1 END -->

                            </div>
                        </div>




                    
                </div>
            </div>



            

        </div></div>
<?php }} ?>