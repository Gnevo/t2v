{block name='style'}
    <link href="{$url_path}css/widget-timeline.css" rel="stylesheet" type="text/css" />
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
{/block}
{block name='script'}
{*    <script src="{$url_path}js/timeline-min.js" type="text/javascript" ></script>*}
{*   <script src="{$url_path}js/jquery.floatThead.js" type="text/javascript" ></script>*}
   <script src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script>
   {*<script src="{$url_path}js/jquery.floatThead-slim.min.js" type="text/javascript" ></script>*}
{*    <script src="{$url_path}js/script.js" type="text/javascript" ></script>*}
    <script src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
       
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
            source: {$employees},
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
                return value.replace(/[-[\]{ldelim}{rdelim}()*+?.,\\^$|#\s]/g, "\\$&");
            },
            escapeRegexPhone: function( value ) {
                return value.replace(/[-[\]{ldelim}{rdelim}()*+?.,\\^$|#\s]/g, "").replace(/^0+/, '');
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
        var obj_process = { action: 'get_customers', related_employee: user, view: 'customer', 'year_week': '{$year_week}'};
        
        wrapLoader("#gdschema_kund");
        $.ajax({
            url:"{$url_path}ajax_customer_employee_gdschema_summery.php",
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
                    $tbl_data += '<a onclick="navigatePage(\'{$url_path}month/gdschema/{$cur_year}/{$cur_month}/'+$data.username+'/\',1);" href="javascript:void(0);" title="{$translate.tltp_go_to_monthly_view}">'+$data.full_name+'</a>';
                    $tbl_data += '<span class="hide row-data" data-username="'+$data.username+'" data-code="'+$data.code+'" data-SSN="'+$data.ssn+'" ></span>';
                    $tbl_data += '</td>';
                    if($data.summery_values.length > 0){
                        $.each($data.summery_values, function(i, $summery) {
                            $tbl_data += '<td class="table-col-center '+$summery.highlight_class+'">';
                            $tbl_data += '<a onclick="navigatePage(\'{$url_path}customer/gdschema/'+$summery.year_week+'/'+$data.username+'/\',1);" href="javascript:void(0);" title="{$translate.tltp_goto_week}">';
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
        document.location = '{$url_path}all/employee/gdschema/l/';
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

            var phone_search_val = search_val.replace(/[-[\]{ldelim}{rdelim}()*+?.,\\^$|#\s]/g, "").replace(/^0+/, '');
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
            navigatePage('{$url_path}all/gdschema/'+year+'|'+week+'/'+month_first_date+'/',1);
            
        }
    </script>
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left slot-form">


            <div class="row-fluid">
                <div class="span12 tablet-column-reset">
                    {$message}
                    {if $expire_days <= $expire_days_actual}
                        <div class="expiry">
                            <div class="close" onclick="this.parentNode.parentNode.removeChild(this.parentNode); return false;">X</div>
                            {$translate.password_expiry_message_left} {$expire_days} {$translate.password_expiry_message_right}
                        </div>
                    {/if}
                    <div class="row-fluid" id="upper_customer_list">
                        <div class="span7" style="padding-bottom:0;">
                            <!-- widget 1 -->
                            
                            <div class="widget widget-heading-simple widget-body-white" data-toggle="collapse-widget " style="margin-bottom: 0px !important">
                                <div class="widget-body table-1">
                                    {if $user_role != 3}
                                        <div class="table-head-min"> <h1>{$translate.customer_list} {$cur_year} v{$cur_week}</h1></div>
                                        <div class="table-height-fix customer-list-table-height-fix slot-form" style="height: 189px ! important;">
                                            <table class="footable table table-striped table-bordered table-white table-primary">
                                               <tbody>
                                                    {foreach $customers_to_allocate as $customer_to_allocate}
                                                    <tr>
                                                        <td><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);" title="{$customer_to_allocate.code}">{if $sort_by_name == 1}{$customer_to_allocate.customer_name_ff}{elseif $sort_by_name == 2}{$customer_to_allocate.customer_name}{/if}</a></td>
                                                        <td style="width:100px;"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);"><span>{$customer_to_allocate.total_hours}h</span></a></td>
                                                    </tr>
                                                    {/foreach}
                                               </tbody>
                                            </table>
                                        </div>
                                    {else}
                                        
                                        <div class="table-head-min"> <h1>{$translate.timeline}</h1></div>
                                        <div tabindex="1" style="overflow: auto;" class="timeline-table-height-fix">
                 
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <div class="span12 time-line-slots-wrpr">
                                                            <ul class="time-line-slots">
                                                                {foreach $user_slots as $slot_det}
                                                                <li>
                                                                    <div data-id="{$slot_det['id']}" class="slot-timeline {if $slot_det.status == 0}slot-theme-incomplete{elseif $slot_det.status == 1}slot-theme-complete{elseif $slot_det.status == 2}slot-theme-leave{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.status == 4}slot-theme-candg{/if} ">
                                                                        <div class="slot-timeline-icon slot-icon-small 
                                                                            {if $slot_det.type eq 1}slot-icon-small-travel
                                                                            {elseif $slot_det.type eq 0}slot-icon-small-normal
                                                                            {elseif $slot_det.type eq 2}slot-icon-small-break
                                                                            {elseif $slot_det.type eq 3}slot-icon-small-oncall
                                                                            {elseif $slot_det.type eq 4}slot-icon-small-over-time
                                                                            {elseif $slot_det.type eq 5}slot-icon-small-qualtiy-overtime
                                                                            {elseif $slot_det.type eq 6}slot-icon-small-more-time
                                                                            {elseif $slot_det.type eq 14}slot-icon-small-oncall-moretime
                                                                            {elseif $slot_det.type eq 7}slot-icon-small-some-other-time
                                                                            {elseif $slot_det.type eq 8}slot-icon-small-training
                                                                            {elseif $slot_det.type eq 9}slot-icon-small-call-training
                                                                            {elseif $slot_det.type eq 10}slot-icon-small-personal-meeting
                                                                            {elseif $slot_det.type eq 11}slot-icon-small-voluntary
                                                                            {elseif $slot_det.type eq 12}slot-icon-small-complimentary
                                                                            {elseif $slot_det.type eq 13}slot-icon-small-complimentary-oncall
                                                                            {elseif $slot_det.type eq 15}slot-icon-small-standby{/if}
                                                                             ">
                                                                        </div>
                                                                        <div class="slot-timeline-time-name">{$slot_det.slot} ({$slot_det.slot_hour})<br>
                                                                           {$slot_det.cust_name}</div>
                                                                        <div class="slot-timeline-type">
                                                                            {if $slot_det.fkkn eq 1}{$translate.fk}
                                                                            {else if $slot_det.fkkn eq 2}{$translate.kn}
                                                                            {else if $slot_det.fkkn eq 3}{$translate.tu}{/if}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                {/foreach}
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
                                                                            {foreach $user_slots as $slot_det}
                                                                                {if $slot_det['slot_difference'] != 0}
                                                                                    <li style="width:{$slot_det['slot_difference']*4.16}%"></li>
                                                                                {/if}    
                                                                                <li data-id="{$slot_det['id']}" class="time-devider {if $slot_det.status == 0}slot-theme-incomplete{elseif $slot_det.status == 1}slot-theme-complete{elseif $slot_det.status == 2}slot-theme-leave{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.status == 4}slot-theme-candg{/if}" style=" width:{$slot_det.slot_hour*4.16}%"><div class="innerInfo" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 100%;" data-title="{$slot_det.slot}" data-placement="top" data-toggle="tooltip">{$slot_det.slot}</div></li>
                                                                            {/foreach}
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
                    
                                    {/if}      
                                </div>
                            </div>
                        </div>
                        <div class="span5 calender-small" id="calendar-container" style="overflow:visible">
                            <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">

                                <thead>
                                    <tr>
                                        <th style="width: 40px;" onclick="navigateCalender('{$url_path}ajax/calender/{$year - 1}/{$month}/{$day}/')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-left"></i></span></th>
                                        <th onclick="navigateCalender('{$url_path}ajax/calender/{$prv_year}/{$prv_month}/{$day}/')"><span class="btn btn-block btn-default span12"><i class="icon-angle-left"></i></span></th>
                                        <th colspan="4" class="table-col-center center" onclick="navigateCalender('{$url_path}ajax/calender/{$cur_year}/{$cur_month}/{$cur_day}/')">{$translate.{$month_label}}, {$year}</th>
                                        <th onclick="navigateCalender('{$url_path}ajax/calender/{$next_year}/{$next_month}/{$day}/')"><span class="btn btn-block btn-default span12"><i class="icon-angle-right "></i></span></th>
                                        <th onclick="navigateCalender('{$url_path}ajax/calender/{$year + 1}/{$month}/{$day}/')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-right"></i></span></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="table-col-center">V</th>
                                        {foreach $weeks_days as $week_day}
                                            <th class="table-col-center">{$translate.{$week_day.label}}</th>
                                        {/foreach}
                                        
                                    </tr>
                                </thead>
                               <tbody>
                                    {foreach $month_weeks as $month_week}
                                        <tr>
                                            <td onclick ="navigateCalender('{$url_path}ajax/calender/{$month_week.week.year}/{$month_week.week.month}/{$day}/');" class="table-col-center weeks-small-calender" style="width:40px;">{$month_week.week.week}</td>
                                            {foreach $month_week.days as $week_day}
                                                <td onclick="navigatePage('{$url_path}all/gdschema/{$week_day.year}|{$week_day.week}/{$week_day.date}/',1);" class="table-col-center {if $week_day.type == 'old'}coming-days{else if $week_day.type == 'current'}today-small-calender{else if $week_day.type == 'holiday'}off-days{else if $week_day.type == 'redday'}off-days{else if ($week_day.date|date_format:'%u') eq 7}off-days{/if}">{$week_day.day}</td>
                                            {/foreach}
                                        </tr>
                                    {/foreach}
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="8">
                                            <ul>
                                                {foreach $months as $month}
{*                                                    <li onclick="navigateCalender('{$url_path}ajax/calender/{$year}/{$month.id}/{$day}/')">{$translate.{$month.label}}</li>*}
                                                    <li onclick="monthReloadCalendar('{$year}', '{$month.id}', '{$day}');">{$translate.{$month.label}}</li>
                                                {/foreach}
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
                                    <div {*class="table-head"*} id="gdschema_kund" style=" overflow-y: auto;">
                                        <div class="span12 {*customer-table-height-fix*}">
                                            <table class="footable table table-striped table-bordered table-white table-primary table-list-customers">
                                                <thead>
                                                    <tr>
                                                        <th>{$translate.customer}&nbsp;({count($week_shedules)} st)
                                                            <span class="btn btn-mini btn-info pull-right mr" onclick="go_to_emp_gdschema_summary();">{$translate.employee_summary_view}</span>
                                                        </th>
                                                        {assign var = 'i' value=0}
                                                        {foreach $weeks as $week}
                                                        <th>{if $user_role eq 4 or $user_role eq 3}<a onclick="navigatePage('{if $user_role eq 4}{$url_path}customer/gdschema/{$week.year_week}/{$user_id}/{else if $user_role eq 3}{$url_path}employee/gdschema/{$week.year_week}/{$user_id}/{/if}',1);" href="javascript:void(0);" title="{$translate.tltp_go_to_customer_employee_week_page}">V{$week.week}</a>{else}V{$week.week}{/if}</th>
                                                        {/foreach}
                                                    </tr>
                                                
                                                    <tr>
                                                        <th class="search-table" colspan="6">
                                                            <input id="customer_search" class="span3" data-key-placeholder="placeholder_search" placeholder="{$translate.search_customer}" type="text" style="min-height: 20px;" />
                                                            <input id="employee_search" class="span3" data-key-placeholder="placeholder_search" placeholder="{$translate.search_employee}" type="text" onemptied="refresh_summery()" oninput="refresh_summery()" style="min-height: 20px;margin-left: 10px;" />
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody class='gdschema-summery-content'>
                                                    {$tbl_data}
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
{/block}