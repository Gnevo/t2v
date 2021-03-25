{block name='style'}
    <style type="text/css">
        .height-fix-inner-panel { height: 75px !important;;  }
        .height-set { height: auto !important;}
        .width-set { width:auto !important; }
        .time-box { font-size: 10px; height: auto !important;line-height: 20px; }
         .btn-stop{ margin-top: 25px;  }
        .slot-info{ font-size: 12px;
line-height: 18px; }
        @media screen and (max-width: 767px){ 
            .height-fix-inner-panel { height: 130px !important;;  }
         .height-fix-slot { height: auto !important; float: left !important; }
         .time-box { text-align: left !important; }
         .btn-stop { margin-top: 0px !important; }
        }
        

        
           @media screen and (max-width: 500px){ .btn-stop { margin-top: 25px; } } 
         @media screen and (max-width: 1238px){ .height-fix-slot { width:100% !important; }  }
       
    </style>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div style="height: 609px;" class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.comengo_head}</h1>
                </div>
                {$message}
            </div>
             <form id="form_list" name="form_list" method="post" >
                <input type="hidden" name="status" id="status" />
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="action_id" id="action_id" />
                <input type="hidden" name="task_id" id="task_id" value="{$task_id}" />
                <input type="hidden" name="candg_flag" id="candg_flag" value="{$candg_flag}" />
                <input type="hidden" name="candg_start" id="candg_start" value="{$candg_start}" />
                <input type="hidden" name="candg_break" id="candg_break" value="{$candg_break}" />
                <input type="hidden" name="candg_customer" id="candg_customer" value="{$running_message_customer}" />
                <input type="hidden" name="candg_employee" id="candg_employee" value="{$running_message_employee}" />
                <input type="hidden" name="admins_employee" id="admins_employee" value="" />
                <input type="hidden" name="admins_customer" id="admins_customer" value="" />
                <input type="hidden" name="msg_7" id="msg_7" value="{$msg_7}">
            <div class="span12 widget-body-section input-group">
                    {*
                    {if $show_start != 2 && $show_start != 5 && $show_start != 4}
                        <div class="span12 text-center">
                            <div class="widget" style="margin-top: 0px ! important;">
                                <!--WIDGET BODY BEGIN-->
                                
                                <div class="span12 widget-body-section text-center">
                                    {if $show_start == 1}
                                        <div class="row-fluid" style="">
                                            <div class="span12 text-center" style="">
                                                <div class="input-prepend" style="width: 30%;"> <span class="add-on icon-pencil"></span>
                                                    <select class="form-control span11" id="customer" name="customer">
                                                        <option value="">{$translate.select_customer}</option>
                                                        {foreach $customers as $customer}
                                                            <option value="{$customer['username']}">{$customer['last_name']} {$customer['first_name']}</option>
                                                        {/foreach}    
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    {else if $show_start == 6}
                                        <div class="row-fluid" style="">
                                            <div class="span12 text-center" style="">
                                                <div class="input-prepend" style="width: 30%;"> <span class="add-on icon-pencil"></span>
                                                    <select class="form-control span11" id="employee" name="employee">
                                                        <option value="">{$translate.select_employee}</option>
                                                        {foreach $employees as $employee}
                                                            <option value="{$employee['username']}">{$employee['ordered_name']}</option>
                                                        {/foreach}    
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    {/if}

                                    <div class="row-fluid" style="">
                                        <div class="span12" style="">
                                            <button class="btn btn-success btn-large btn-margin-set" style="text-align: center; width: 29%;" type="button" onclick="comengof(0, '', '', '', '', '', '')">{$translate.candg_start_button}</button>
                                        </div>  
                                    </div>

                                </div>
                                
                                <!--WIDGET BODY END-->
                            </div>
                        </div>
                    {/if}     
                    *}         
                    <div class="row-fluid">
                        <div class="span12">
                            {if $show_start != 5 && $show_start != 7}
                                <div class="widget" style="margin: 0px ! important;">
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section" style="">
                                        <div class="row-fluid">
                                            {if $running_message_flag}
                                                <div class="span12 text-center">
                                                    <ul>
                                                        <li><span style="color: rgb(4, 139, 237);"><strong>{$translate.customer} </strong></span>{$running_message_customer}</li>
                                                        <li><span style="color: rgb(4, 139, 237);"><strong>{$translate.employee} </strong></span>{$running_message_employee}</li>
                                                        <li><span style="color: rgb(4, 139, 237);"><strong>{$translate.date} </strong></span>{$running_message_date}</li>
                                                        <li><span style="color: rgb(4, 139, 237);"><strong>{$translate.candg_start} </strong></span> {$running_message_start_time}</li>
                                                    </ul>
                                                    <hr>
                                                    <div id="dur_div">03:25:60</div>
                                                    <hr>
                                                    <button class="btn btn-danger btn-large btn-margin-set" style="text-align: center; float:none !important;" type="button" onclick="comengof(1, '', '', '', '', '', '')">{$translate.candg_stop_button}</button>
                                                    <br><br><br>
                                                </div>
                                            {/if}
                                            <!--    
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    {foreach $slot_dets as $slot_det}
                                                        <div style="width: 100%;" class="slot-day {if $slot_det['status'] == 1}slot-theme-complete{else if $slot_det['status'] == 0}slot-theme-incomplete{else if $slot_det['status'] == 4}slot-theme-candg{/if} ui-droppable" id="" {if $show_start == 4}style="cursor: pointer" onclick="candgUserAdd('{$slot_det['id']}')"{/if}>
                                                            <div class="row-fluid day-slot-inner-wrpr ">

                                                                <div class="span10">
                                                                    <div class="slot-time span12"><strong>{$translate.date} </strong><br>{$slot_det['date']}</div>
                                                                    <div class="slot-time span12"><strong>{$translate.slot} </strong><br>{$slot_det['time_from']} - {$slot_det['time_to']}</div>
                                                                    <div class="slot-time span12"><strong>{$translate.customer} </strong><br>{$slot_det['cust_name']}</div>
                                                                    <div class="slot-time span12"><strong>{$translate.employee} </strong><br>{$slot_det['emp_name']}</div>
                                                                    <div class="row-fluid">
                                                                    </div>
                                                                </div>
                                                                <div class="span2">
                                                                    <div class="row-fluid">
                                                                        <ul class="day-slot-info-icons pull-right">
                                                                            <li class="slot-icon-day slot-icon-small 
                                                                                slot-icon-small-{$type_class[$slot_det['type']]}
                                                                                " style="width: 24px; height: 27px; margin: 3px 0px 0px;"></li>
                                                                            <li>
                                                                                <div class="day-slottype">
                                                                                    {if $slot_det['fkkn'] == 1}FK
                                                                                    {else if $slot_det['fkkn'] == 2}KN
                                                                                    {/if}    
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                        <div class="day-slot-option-wrpr">
                                                                            <div></div><div></div>
                                                                            <div> </div><div></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row-fluid"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {/foreach}

                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div></div>
                            {/if}                

                            {if $show_start == 5}            
                                <div class="widget" style="margin: 0px ! important;">
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section" style="">
                                        <div class="row-fluid">
                                            



                                        </div>
                                    </div>
                                </div>
                                {/if}

                        </div>
                    </div>
                    
                    <div class="row-fluid">
                        <div class="span12">
                            {$msg_7}
                            <div class="widget">
                                {if !empty($all_running)}            
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section" style="">

                                    <div class="slots-list-wrpr">
                                        {$i = 0}
                                        {foreach $all_running as $slot_det}
                                            {$i = $i+1}
                                            <div class="slot slot-week slot_bountery slot-theme-candg span4  slot-week-draggable ui-draggable height-fix-slot" style="margin: 5px !important;" >
                                                {if $user_role == 1 || $user_role == 6}<a href="javascript:void(0);" onclick = 'comengoClose("{$slot_det['id']}")' class="icon icon-remove-circle" style="float: right; font-size: 20px;position: relative;top: -11px;right:-8px" title="{$translate.cancel_candg}"></a>{/if}
                                                <div class="inner-panel span12 height-fix-inner-panel" style="margin-top: -22px;">
                                                    <div class="week-slot-notification-wrpr" style="background:{$slot_det['emp_color']};"> </div>
                                                   
                                                    <div class="week-slot-time width-set height-set slot-info span6" style="padding-left: 15px !important;">
                                                            {$slot_det['dag']}<br/>
                                                            {$slot_det['start_time']}<br/>
                                                            {$slot_det['cust_name']}<br/>
                                                            {$slot_det['emp_name']}
                                                        </div>

                                                        <div class="pull-right span6 text-right">
                                                            <div style="float:none !important;" class="week-slot-time time-box width-set pull-right" id="time_{$i}" data-time="{$slot_det['dag']|cat:' '|cat:$slot_det['start_time']}"></div>
                                                    <div style="padding:3px !important; float: none !important; ">
                                                        <button style="font-size:8px !important; padding: 3px 6px;line-height: 14px;" type="button" class="btn btn-default btn-xs btn-danger btn-stop" onclick = 'comengof(1,"{$slot_det['id']}", "{$slot_det['userid']}", "{$slot_det['customer']}", "{$slot_det['emp_name']}", "{$slot_det['cust_name']}", "{$slot_det['dag']|cat:' '|cat:$slot_det['start_time']}")'>{$translate.candg_stop_button}</button>
                                                    </div>
                                                        </div>
                                                </div>
                                            </div>
                                        {/foreach}    
                                        
                                    </div>

                                </div>
                                {/if}        
                            </div>
                        </div>
                    </div>
            </div>
             </form>
        </div>
    </div>
{/block}

{block name='script'}
    <script src="{$url_path}js/bootbox.js"></script>


    <script>
        $("#serach_slots").keyup(function () {
            var value = this.value;

            $(".slots-list-wrpr").find(".slot").each(function (index) {
                if (index === 0)
                    return;

                $(this).toggle(id.indexOf(value) !== -1);
            });
        });
    </script>
    <script>
        // $('html, body').css('overflow', 'auto');
        // $("#menu").hide();
        var x_time, y_time, admin_user_cout;
        admin_user_cout = '{count($all_running)}';
        x_time = setInterval('updateClock1()', 1000);
        y_time = setInterval('updateClock2()', 1000);
        function updateClock1( )

        {
            var str = $("#candg_start").val();

            var st_year = str.substr(0, 4);

            var st_month = str.substr(5, 2);

            var st_day = str.substr(8, 2);

            var st_hour = str.substr(11, 2);

            var st_minute = str.substr(14, 2);

            var st_second = str.substr(17, 2);

            var start_time = new Date(st_year, st_month - 1, st_day, st_hour, st_minute, st_second, 0);

            //var start_time = new Date('7/11/2010');

            var now_time = new Date();

            var difference = Math.abs(now_time.getTime() - start_time.getTime());



            var hoursDifference = Math.floor(difference / (1000 * 60 * 60));

            difference -= hoursDifference * 1000 * 60 * 60;

            var currentHours = hoursDifference;



            var minutesDifference = Math.floor(difference / (1000 * 60));

            difference -= minutesDifference * 1000 * 60;

            var currentMinutes = minutesDifference;



            var secondsDifference = Math.floor(difference / 1000);

            var currentSeconds = secondsDifference;



            var hourDisplay = currentHours;

            if (("" + currentHours).length <= 1)
                hourDisplay = '0' + currentHours;

            var minutesDisplay = currentMinutes;

            if (("" + currentMinutes).length <= 1)
                minutesDisplay = '0' + currentMinutes;

            if (("" + currentSeconds).length <= 1)
                currentSeconds = '0' + currentSeconds;







            var currentTimeString = hourDisplay + ":" + minutesDisplay + ":" + currentSeconds;



            $("#dur_div").html("<h1 style='font-size: 37px; margin: 28px 0px;'>Varaktighet:" + '<br/><br/><br/>' + currentTimeString + "</h1>");

        }
        
        
        function updateClock2()

        {
            for( var i=1; i <= admin_user_cout; i++){
                var str = $("#time_"+i).attr("data-time");
               
                var st_year = str.substr(0, 4);

                var st_month = str.substr(5, 2);

                var st_day = str.substr(8, 2);

                var st_hour = str.substr(11, 2);

                var st_minute = str.substr(14, 2);

                var st_second = str.substr(17, 2);

                var start_time = new Date(st_year, st_month - 1, st_day, st_hour, st_minute, st_second, 0);

                //var start_time = new Date('7/11/2010');

                var now_time = new Date();

                var difference = Math.abs(now_time.getTime() - start_time.getTime());



                var hoursDifference = Math.floor(difference / (1000 * 60 * 60));

                difference -= hoursDifference * 1000 * 60 * 60;

                var currentHours = hoursDifference;



                var minutesDifference = Math.floor(difference / (1000 * 60));

                difference -= minutesDifference * 1000 * 60;

                var currentMinutes = minutesDifference;



                var secondsDifference = Math.floor(difference / 1000);

                var currentSeconds = secondsDifference;



                var hourDisplay = currentHours;

                if (("" + currentHours).length <= 1)
                    hourDisplay = '0' + currentHours;

                var minutesDisplay = currentMinutes;

                if (("" + currentMinutes).length <= 1)
                    minutesDisplay = '0' + currentMinutes;

                if (("" + currentSeconds).length <= 1)
                    currentSeconds = '0' + currentSeconds;


                var currentTimeString = hourDisplay + ":" + minutesDisplay + ":" + currentSeconds;



                $("#time_"+i).html("Varaktighet:" + '<i class="icon-time" style="margin-right:3px; margin-left:3px;"></i>' + currentTimeString);
            }

        }
        
        
        $(document).ready(function () {

        });

        function comengof(status, task_id, employee, customer, emp_name, cust_name, start_time) {
            var action = '';
            if(task_id){
                action = 'admin_stop';
                $('#task_id').val(task_id);
                $('#admins_employee').val(employee);
                $('#admins_customer').val(customer);
                $('#candg_employee').val(emp_name);
                $('#candg_customer').val(cust_name);
                $("#candg_start").val(start_time);
            }
            else{
                action = 'start_stop';
                task_id = '{$task_id}';
            }
            // alert(status);
            // alert($('#task_id').val());
            // alert($('#admins_employee').val());
            // alert($('#admins_customer').val());
            if ((task_id == '' && status == 0) || (task_id != null && status == 1)) {
                var candg = '{$candg}';
                var candg_flag = '{$candg_flag}';
                var show_start = '{$show_start}';
                var candg_break = parseFloat('{$candg_break}');
                if (status == 0 && candg == 1 && candg_flag == 0 && $("#customer").val() == '' && show_start == 1) {
                    bootbox.alert('{$translate.select_customer}', function (result) {
                    });
                } else if (status == 0 && candg == 1 && candg_flag == 0 && $("#employee").val() == '' && show_start == 6) {
                    bootbox.alert('{$translate.select_employee}', function (result) {
                    });
                } else {
                    if (status == 1) {
                        clearInterval(x_time);

                        var str = $("#candg_start").val();

                        var st_year = str.substr(0, 4);

                        var st_month = str.substr(5, 2);

                        var st_day = str.substr(8, 2);

                        var st_hour = str.substr(11, 2);

                        var st_minute = str.substr(14, 2);

                        var st_second = str.substr(17, 2);

                        var start_time = new Date(st_year, st_month - 1, st_day, st_hour, st_minute, st_second, 0);

                        var now_time = new Date();

                        var difference = Math.abs(now_time.getTime() - start_time.getTime());

                        difference = Math.round(difference / (5 * 60 * 1000)) * (5 * 60 * 1000);



                        var hoursDifference = Math.floor(difference / (1000 * 60 * 60));

                        difference -= hoursDifference * 1000 * 60 * 60;

                        var currentHours = hoursDifference;



                        var minutesDifference = Math.floor(difference / (1000 * 60));

                        difference -= minutesDifference * 1000 * 60;

                        var currentMinutes = minutesDifference;

                        currentMinutes = currentMinutes * 100 / 60;

                        var duration = (currentHours + (currentMinutes / 100)).toFixed(2);//makes it to 100 and then give to decimal places
                        var candg_break_time = 0;
                        if (candg_break) {
                            candg_break_time = parseInt((duration / candg_break), 10) * 30;
                        }

                        var temp_time = candg_break_time;

                        var temp_hours = Math.floor(temp_time / (60));

                        temp_time -= temp_hours * 60;

                        var temp_minutes = temp_time;

                        var hourDisplay = temp_hours;

                        if (("" + temp_hours).length <= 1)
                            hourDisplay = '0' + temp_hours;

                        var minutesDisplay = temp_minutes;

                        if (("" + temp_minutes).length <= 1)
                            minutesDisplay = '0' + temp_minutes;

                        if (candg_break && parseFloat(duration) >= candg_break) {
                            bootbox.confirm('Total arbetstid : ' + duration + '.<br>Har du en rast emellan?<br>Arbtestiden kommer att minska med ' + hourDisplay + ":" + minutesDisplay, function (result) {
                                if (result) {
                                    $('#status').val(status);
                                    $('#action').val(action);
                                    $('#form_list').submit();
                                } else {
                                    $('#status').val(status);
                                    $('#action').val(action);
                                    $('#candg_break').val(0);
                                    $('#form_list').submit();
                                }

                            });

                        } else {    
                            $('#status').val(status);
                            $('#action').val(action);
                            $('#candg_break').val(0);
                            $('#form_list').submit();

                        }
                    }
                    else {
                        
                        $('#status').val(status);
                        $('#action').val("start_stop");
                        $('#form_list').submit();
                    }

                }
            }
        }

        function comengoClose(task_id) {

            bootbox.dialog( '{$translate.do_you_want_to_cancel_candg}', [{
                                        "label" : "{$translate.no}",
                                        "class" : "btn-danger"
                                    }, {
                                        "label" : "{$translate.yes}",
                                        "class" : "btn-success",
                                        "callback": function() {
                                            $('#task_id').val(task_id);
                                            $('#action').val('cancel_candg');
                                            $('#form_list').submit();
                                        }
                                }]);
        }

        function candgUserAdd(action_id) {
            bootbox.confirm('Vill du ha arbetspasset?', function (result) {
                if (result) {
                    $('#action').val('UserAdd');
                    $('#action_id').val(action_id);
                    $('#form_list').submit();
                }

            });
        }
    </script>
{/block}