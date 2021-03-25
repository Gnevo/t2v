{block name='style'}
    <link href="{$url_path}css/TableCSSCode.css" rel="stylesheet" type="text/css" />
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/gdschema.css?v={filemtime('css/gdschema.css')}" media="all" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/datepicker_btstrap.css?v={filemtime('css/datepicker_btstrap.css')}" media="all" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/contextMenu.css?v={filemtime('css/contextMenu.css')}" media="all" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/contract_tooltip_info.css?v={filemtime('css/contract_tooltip_info.css')}" media="all" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.css?v={filemtime('css/jquery.jscrollpane.css')}" media="all" />
    <link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.lozenge.css?v={filemtime('css/jquery.jscrollpane.lozenge.css')}" media="all" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="http://192.168.0.234/works/app/t2v/cirrus/css/all-ie-only.css?v=1411202493" />
<![endif]-->
<style type="text/css">
    .scroll-pane, .scroll-pane-arrows{ width: 100%; height: 200px; overflow: auto; }
    .horizontal-only{ height: auto; max-height: 200px; }
    .scroll_content .jspPane{ width: 485px; }
    .cursor_hand{ cursor: pointer; }
    .reportemploye_contactlft .contract_block{ padding-left:11px; padding-right:11px; float:left; }
    .reportemploye_contactlft .fk_contract{ border-right:1px solid #E4E4E4; }
    .font-bold{ font-weight:bold; }
    .reportemploye_contactlft .fkkn_contract_label{ padding:8px 5px !important; }
    .reportemploye_contactlft .fkkn_value{ padding:8px 5px !important; }
    .reportemploye_contactlft .fkkn_contract_value{ padding:8px 0px !important; }
    .headrow .today_btn{ border: 1px solid #8FC9FF; border-radius: 6px; padding: 2px 52px; }
    .working_summery_btn { float: left; margin: 4px 5px 0 0; }
    {*.fixed-dialog{ position: fixed; top: 50px; left: 50px; }*}
    .overlay-hidden { opacity: 0.0; filter: alpha(opacity=0);  /* IE8 and lower */ }
    .ui-widget-overlay { background: none; }
    #working_summery { overflow-y: auto; max-height: 340px; }

    .summery_popup { margin: 7px 3px; border:solid 1px #daf2f7; width: 99%; }
    .summery_popup td {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        background-color: #daf2f7;
        padding: 5px 4px;
        margin-bottom: 3px;
    }
    .summery_popup th {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        font-weight: bold;
        background-color: #daf2f7;
        padding: 5px;
        border-bottom: solid 1px #fff;
    } 
    .col_numeric{ text-align: right; }
    .col_left_align{ text-align: left; }
    .overflow_contract { color: red; }
    .underflow_contract { color: blue; }
    #theNotif_customer {
        left: auto !important;
        right: 0 !important;
    }
    #theNotif_customer .contract_arrow, .monthlyslot .contract_arrow {
        left: auto !important;
        right: 35px !important;
    }
    .duration #slot_from, .duration #slot_to { font-size: 12px; }
    .fk_kn_selected .fk_style{ background:#fff !important; color:#000 !important; }
    .border_fkkn { border: 1px solid #C9C9C9; }
    .slot_header { background:#F7F4CD !important; border:1px solid #D3D0A1 !important; }
    #slot_add_group { height: 220px; padding: 2px !important; border: 1px solid #FFF; width: 272px !important; }
    #slot_add_group .time_slots_theme { max-height: 850px; padding: 2px !important; border: 1px solid #FFF; margin-right: 13px !important; width: auto !important; margin-bottom: 13px !important; }
    .addSlotMore { float: right; margin-top: 14px; }
    #slot_add_group .time_slots_theme .close {
        background-image: url("{$url_path}images/close_icons_small.png");
        background-repeat: no-repeat;
        cursor: pointer;
        height: 16px;
        position: absolute;
        right: -4px;
        top: -8px;
        width: 16px;
    }
    #slot_add_group .jspPane{
        padding-top: 9px !important;
    }
    #slot_add_group .jspContainer{
        width: auto !important;
    }
    .slot_calendar .left_section{ float:left; margin-top: -4px; width: 25%; }
    .slot_calendar .middle_section{ float:left; text-align: center; margin-top: 3px; width: 50%; }
    .slot_calendar .right_section{ float:right; width: 25%; text-align: center; margin-top: 3px; }
    .chk_all_slot_ctrl { float:right; padding-right: 9px; color: #666666; }
    .add_slot_btn_div { float:right; padding-right: 11px; }
    .chk_all_day_slot_ctrl { float:left; padding-left: 2px; color: #666666; }
    .chk_all_week_slot_ctrl { float: right; padding-right: 2px; padding-top: 3px; color: #666666; }
    
    .hourly_time li {
float:left;
list-style:none;
margin-right:7px;

}
.hourly_time li:last-child {
margin-right:0px;
}
.employe_color li {
display:block;
margin-bottom:2px;
height:5px;
}

.time_slot_table > td {
padding: 10px 0px 10px 10px!important;
}

.ui-dialog{
    z-index: 10000;
}
</style>

{/block}
{block name='script'}
<script src="{$url_path}js/time_formats.js" type="text/javascript" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        get_colliding_customers();
        $('#year').change(function () {
            if($('#year').val() != ''){
                get_colliding_customers();
            }else{
                alert('{$translate.select_year}');
            }
        });
        $('#months').change(function () {
            if($('#months').val() != ''){
                get_colliding_customers();
            }else{
                alert('{$translate.select_month}');
            }
        });
        
        $('#form').submit(function() {
            $(':submit',this).attr('disabled','disabled');
            $('#loading').show(); // show animation
            return true; // allow regular form submission
        });
        
    });
    
    
    
    function get_colliding_customers(){
        //wrapLoader();
            year = $('#year').val();
            month = $('#months').val();
            $.ajax({
                        async:true,
                        url:"{$url_path}ajax_customers_overlapping.php",
                        data:"month="+month+"&year="+year,
                        type:"POST",
                        dataType: 'json',
                        success:function(data){
                            $('#cmb_customer').html('');
                            $('#cmb_customer').append($('<option>').text('{$translate.select_customer}').attr('value', ''));
                            $.each(data, function(i, value) {
                                if('{$sort_by_name}' == 1)
                                    name = value.first_name+" "+value.last_name;
                                else
                                    name = value.last_name+" "+value.first_name;
                                if('{$select_customer}' == value.customers)
                                    $('#cmb_customer').append($('<option>').text(name).attr('value', value.customers).attr('selected','selected'));
                                else    
                                    $('#cmb_customer').append($('<option>').text(name).attr('value', value.customers));
                            });
                            //uwrapLoader(thisparent);
                        }
            });
    }
    function move_next_year(){
        var month = parseInt($("#months").val());
        var year = parseInt($("#year").val());
        if(year != 2015){
            year = year+1;
            $("#year").val(year);
            $("#form").submit();
        }
        
    }
    function move_next_month(){
        var month = parseInt($("#months").val());
        var year = parseInt($("#year").val());
        if(month == 12 && year != 2015){
           year = year+1;
           month = 1;
            $("#months").val(month); 
            $("#year").val(year);
            $("#form").submit();
        }else{
            month = month+1;
            $("#months").val(month); 
            $("#form").submit();
        }
    }
    function move_prev_year(){
        var month = parseInt($("#months").val());
        var year = parseInt($("#year").val());
        if(year != 2012){
            year = year - 1;
            $("#form").submit();
        }
    }
    function move_prev_month(){
        var month = parseInt($("#months").val());
        var year = parseInt($("#year").val());
        if(month == 1 && year != 2012){
            year = year - 1;
            month = 12;
            $("#months").val(month); 
            $("#year").val(year);
            $("#form").submit();
        }else{
            month = month - 1;
            $("#months").val(month); 
            $("#form").submit();
        }
    }
    function popupWorkingSummery(date,cust) {
        var dialog_box_new = $("#working_summery" );
        /*var selected_insurances = []; //selected_insurances_merged
        if ($('.add-new-slots-month input:checkbox#fk_check:checked').val())
            selected_insurances.push(1);
        if ($('.add-new-slots-month input:checkbox#kn_check:checked').val())
            selected_insurances.push(2);
        if ($('.add-new-slots-month input:checkbox#tu_check:checked').val())
            selected_insurances.push(3);*/

        var selected_insurances = $("#selected_insurances_merged" ).val();
        dialog_box_new.load('{$url_path}ajax_customer_overlap_report.php?date='+date+'&cust='+cust+'&insurances='+selected_insurances);
        dialog_box_new.dialog({
            title: '{$translate.overlap_slot_report_detail}:&nbsp '+date,
            position: 'top,right',
            modal: true,
            //width: 'auto',
            //maxHeight: 150,
            //height: 150,
            width: 1100,
            minWidth: 600,
            minHeight: 100,
            closeOnEscape: true,
            sticky: true,
            resizable: false,
            //dialogClass: 'no-close',
            //show: { effect: "blind", duration: 800 },
            close: function(event, ui) {
                    $(this).dialog('destroy').remove();
                    $("#external_wrapper #pop_up_themes").append('<div id="working_summery" style="display:none;"></div>');
            },
            hide: 'slide',
            show: { effect: 'slide', duration: 500 }
            //open: function(event,ui){ $('.ui-widget-overlay').addClass('overlay-hidden'); },
            //beforeClose: function(event,ui){ $('.ui-widget-overlay').removeClass('overlay-hidden'); }
        });
        $('.ui-dialog').css('zIndex',9999);
        //prevent the browser to follow the link
        return false;
    }
</script>
{/block}
{block name='content'}
<div class="row-fluid">
    <div class="span12 main-left">
<span id="outside_message_span"></span>
<div style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;" title="Bekräfta" id="dialog-confirm"><p><span class="error_msg_icon"></span></p></div>
<div style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;" title="Bekräfta" id="dialog-confirm-contract"><p><span class="error_msg_icon"></span></p></div>

<div class="tbl_hd">
    <span class="titles_tab">{$translate.monthly_overlap_report}</span>
    
</div>
<input type="hidden" value="0" id="chk_status">
<div id="pop_up_themes">
    <div style="display:none;" id="timetable_slot_assign"></div>
    <div style="display:none;" id="alloc_action"></div>
    <div style="display:none;" id="timetable_assign"></div>
    <div style="display: none; max-height: 300px;" id="right_click_change_type"></div>
    <div style="display: none;" id="allocate_cusempwork"></div>
    <div style="display: none;" id="working_summery"></div>
    <div style="display: none;" id="pop_add_new_slot"></div>
    <div style="display: none;" id="timetable_process_main"></div>
    <div style="display: none;" id="right_click_send_sms"></div>
</div>
<div class="row-fluid">
    <div style="padding:4px 0px;" id="tble_list" class="span12">

    

    
    <div class="monthly_customerdetails span12">
        <center>  
            <span style="display:none; position:absolute; left: 600px; top: 214px; z-index: 1000" id="loading">
            <img src="{$url_path}images/sgo-loading.gif"  />
            </span>
         </center>
        <form id="form" name="form" method="post" action="{$url_path}customer/overlap/report/">
            
            <div style="float:left; margin-top: 4px; padding-left:25px;" class="mr">
            {$translate.year}
                <select name="year" id="year" style="width:60px;">
                        <option value="">{$translate.select}</option>
                            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                </select>
            </div>
            <div id="select_month" style="float:left; margin-top: 4px;" class="mr">
                {$translate.month}
                <select name="months" id="months" style="width:60px;">
                    <option value="">{$translate.select}</option>
                    {foreach $months AS $month}
                        <option value="{$month.id}" {if $month.id == $selected_month}selected="selected"{/if} >{$translate.{$month.label}}</option>
                    {/foreach}
                </select>
            </div>
            <div id="select_year" style="float:left; margin-top: 4px; margin-right: 10px">
                {$translate.customer}
                <select name="cmb_customer" id="cmb_customer" style="width: 150px;">
                </select>
            </div>
            <div id="fkkn_types" style="float:left; margin-top: 4px;" class="mr">
                <div class="clearfix mr pull-left">
                    <label><input type="checkbox" name="fk_check" id="fk_check" {if in_array(1, $filter_insurance)}checked="checked"{/if} value="1" title="{$translate.fk}" class="leave_type"> {$translate.fk}</label>
                </div>
                <div class="clearfix mr pull-left">
                    <label><input type="checkbox" name="kn_check" id="kn_check" {if in_array(2, $filter_insurance)}checked="checked"{/if} value="1" title="{$translate.kn}" class="leave_type"> {$translate.kn}</label>
                </div>
                <div class="clearfix mr pull-left">
                    <label><input type="checkbox" name="tu_check" id="tu_check" {if in_array(3, $filter_insurance)}checked="checked"{/if} value="1" title="{$translate.tu}" class="leave_type"> {$translate.tu}</label>
                </div>
                <input type="hidden" id="selected_insurances_merged" value="{implode(',', $filter_insurance)}" />
            </div>

            <div style="float:left; margin-top: 6px;" class="span1">
                <input type="submit" name="get_data" value="{$translate.show}" id="get_data" />
            </div>
             <div style="float:right; margin-top: 6px;" class="span4">
                 <h1>{$translate.total_colliding_hours_month}{$tot_colliding_hours}{$translate.hrs}</h1>
            </div>
        </form>
    </div>
</div>
</div>
<div class="row-fluid">            
<div style="cursor: default;" class="monthlyslot slot_calendar span12">

    <div class="monthyear_block span12">
        <div class="left_section span4">
            <div class="span8" colspan="1" id="dp3"  data-date-format="yyyy-mm">
            </div>
        </div>
        <div class="middle_section span8"><span data-year-month="2014|9" class="cur_month_header">{$translate.{$month_label}} {$selected_year}</span></div>
    </div>
</div>
</div>
    <div class="row-fluid">    
<div class="today_next span12">
    <table width="100%">
        <tbody><tr class="headrow">
                <td colspan="1" class="button nav cursor_hand">
                    <div style="text-align:center;" unselectable="on"><span title="{$translate.prev_year}" class="Calender_header_btns" onclick="move_prev_year()">«</span></div>
                </td>
                <td colspan="1" class="button nav cursor_hand">
                    <div unselectable="on"><span title="{$translate.prev_month}" class="Calender_header_btns" onclick="move_prev_month()">‹</span></div>
                </td>
                <td colspan="4" style="text-align:center;" class="today cursor_hand">
                    {*<div unselectable="on"><span title="Gå till nuvarande månad" onclick="navigatePage('http://192.168.0.234/works/app/t2v/cirrus/month/gdschema/2014/09/abef001/', 1);" class="today_btn">Idag</span></div>*}
                </td>
                <td style="text-align:right;" colspan="1" class="button nav cursor_hand">
                    <div unselectable="on"><span title="{$translate.next_month}" class="Calender_header_btns" onclick="move_next_month()">›</span></div>
                </td>
                <td  style="text-align:center;" colspan="1" class="button nav cursor_hand">
                    <div unselectable="on"><span title="{$translate.next_year}" class="Calender_header_btns" onclick="move_next_year()">»</span></div>
                </td>
            </tr>
        </tbody></table>
</div>
</div>                
<div class="row-fluid">                
<div id="monthlyviewtbl" class="CSSTableGenerator span12"><table cellspacing="0" cellpadding="0" style="width:100%; border-collapse: separate">
        <tbody>
            {*<tr>
                <td>V</td>
                <td class="day name">Mån</td>
                <td class="day name">Tis</td>
                <td class="day name">Ons</td>
                <td class="day name">Tors</td>
                <td class="day name">Fre</td>
                <td class="day name">Lör</td>
                <td class="day name">Sön</td>
            </tr>*}
            <tr>
                <td>V</td>
                {foreach $weeks as $week_day}
                    <td class="day name">{$translate.{$week_day.label}}</td>
                {/foreach}
            </tr>
            {foreach $month_weeks as $month_week}
                <tr class="week_row">
                    <td class="week_no_td" data-yearweek='{$selected_year}|{$month_week.week.week}'>
                        <div class="slote_plusicon cursor_hand"><img src="{$url_path}images/monthly_slot_minus.png" width="13" height="13" title=""></div>
                        <div class="slote_date cursor_hand"  title="">{$month_week.week.week}</div>
                        {*<div class="chk_all_week_slot_ctrl"><input type="checkbox" class="all_check_week" name="all_check_week"></div>*}
                    </td>

                    {foreach $month_week.days as $week_day}
                        {*if $week_day.date|date_format:"%m" neq $selected_month*}
                        {if $week_day.type eq 'old'}
                            <td {*class="monthly_day"*} class="monthly_day" style="position: relative;background: url('{$url_path}images/ui-bg_glass_100_e4f1fb_1x400.png') repeat-x scroll 50% 50% #E4F1FB;" data-date='{$week_day.date}'>
                            <div class="monthlyslot_date cursor_hand {if $week_day.type eq 'normal'}day{else if $week_day.type eq 'old'}disabled{else if $week_day.type eq 'current'}selected{else if $week_day.type eq 'holiday'}holiday{else if $week_day.type eq 'redday'}redday{else if $week_day.type eq 'bigday'}bigday{/if}"  title="">
                                    {*<div class="chk_all_day_slot_ctrl"><input type="checkbox" class="all_check_day" name="all_check_day"></div>*}
                                    {$week_day.day}
                                </div></td>
                        {else}
                            <td class="monthly_day{if $week_day.date eq $today_date} selected_date{/if}" style="position: relative;background: url('{$url_path}images/ui-bg_glass_100_e4f1fb_1x400.png') repeat-x scroll 50% 50% #E4F1FB;" data-date='{$week_day.date}' onclick="popupWorkingSummery('{$week_day.date}','{$selected_cust}')">
                                <div class="monthlyslot_date cursor_hand {if $week_day.type eq 'normal'}day{else if $week_day.type eq 'old'}disabled{else if $week_day.type eq 'current'}selected{else if $week_day.type eq 'holiday'}holiday{else if $week_day.type eq 'redday'}redday{else if $week_day.type eq 'bigday'}bigday{/if}"  title="">
                                    {*<div class="chk_all_day_slot_ctrl"><input type="checkbox" class="all_check_day" name="all_check_day"></div>*}
                                    {$week_day.day}
                                </div>
                                <div class="monthly_strips clearfix" onclick="popupWorkingSummery()">
                                    {if count($week_day.slots) > 0}
                                    <div style="height:15px; margin-bottom:3px;">
                                        <ul class="hourly_time">
                                            <li>0</li>
                                            <li>4</li>
                                            <li>8</li>
                                            <li>12</li>
                                            <li>16</li>
                                            <li>20</li>
                                            <li>24</li>
                                        </ul>
                                    </div>
                                    
                                        <div style="width:102px;"> 
                                            <ul class="employe_color"> 
                                                {foreach $week_day.slots as $slot}
                                                    <li style="background-color:{$slot.color};width:{$slot.width}px;margin-left: {$slot.margin_left}px;" title="{if $sort_by_name == 1}{$slot.first_name} {$slot.last_name}{elseif $sort_by_name == 2}{$slot.last_name} {$slot.first_name}{/if} "></li> 
                                                {/foreach}
                                                {*<li style="background-color:#ffaaff;"></li>*}
                                            </ul>
                                        </div>
                                   {/if} 
                                </div>
                            </td>
                        {/if}
                    {/foreach}
                </tr>
            {/foreach}

        </tbody>
    </table>
</div></div>
</div></div>
<div id="slot_expanded_views">
</div>
{/block}
