{block name='style'}
    <link rel="stylesheet" type="text/css" href="{$url_path}css/message-center.css" media="all" />
    <style type="text/css">
        .scroll-pane,
        .scroll-pane-arrows
        {
            width: 100%;
            height: 200px;
            overflow: auto;
        }
        .horizontal-only
        {
            height: auto;
            max-height: 200px;
        }
    </style>
{/block}
{block name="script"}

   
    
    <script>
        $(document).ready(function(){
            $(".sms-slot-selected").click(function() {
			
                     $(this).toggleClass('sms-slot-selected-active');
					 
					 		  $('html, body').animate({
                    scrollTop: $("#leave_slots").offset().top
                }, 1000);
				
				
			
                     });
                     
                     
                     
                     	  $(".sms-slot-completed").click(function() {
                     $(this).toggleClass('sms-slot-completed-active');
                     });
        });
        function loadLeaveSlots(url, id, status) {
            //alert("hu");
            wrapLoader(".add_contract_main_2");
            $('#leave_slots').load(url, function(response, status, xhr) {
                uwrapLoader(".add_contract_main_2");
            });
            $('#avail_users').html('&nbsp;');

            if (status == 1) {
                var n = {count($leave_details)};
                for (i = 0; i < n; i++) {
                    if ($('#sms_slot_btn' + i).attr('class') == "sms_slot_btn_selected")
                        $('#sms_slot_btn' + i).removeClass('sms_slot_btn_selected').addClass('sms_slot_btn');

                }
                $('#sms_slot_btn' + id).removeClass('sms_slot_btn').addClass('sms_slot_btn_selected');
            }
        }
        function loadAvailUsers(url) {
            wrapLoader(".add_contract_main_2");
            $('#avail_users').load(url, function(response, status, xhr) {
                uwrapLoader(".add_contract_main_2");
            });
            $('html, body').animate({
                    scrollTop: $("#avail_users").offset().top+400
                }, 500);
        }
        function smsSend(url) {

            var users = '';
            var conf = 0;
            var sender = 0;
            var rejection = 0;
            if (document.user_accept.chk_confirmation.checked) {
                conf = 1;
                if (document.user_accept.chk_sender.checked)
                    sender = 1;
            }
            if (!document.user_accept.chk_confirmation.checked) {
                if (document.user_accept.chk_sender.checked)
                    sender = 1;
                if (document.user_accept.chk_rejection.checked)
                    rejection = 1;
            }
            for (var i = 0; i < document.user_accept.chk_sms.length; i++) {
                if (document.user_accept.chk_sms[i].checked)
                    users += document.user_accept.chk_sms[i].value + '-';
            }
            if (users == '') {
                alert('Select Users');
            }
            else {
                url = url + '&conf=' + conf + '&sender=' + sender + '&rejection=' + rejection + '&users=' + users + '&message=' + encodeURIComponent(document.user_accept.user_msg.value) + '&action=action_sms';
                wrapLoader(".add_contract_main_2");
                $('#sms_action').load(url, function(response, status, xhr) {
                    uwrapLoader(".add_contract_main_2");
                });
            }

        }
        function actionAccept(url) {
            var rejection = 0;
            var sender = 0;
            var users = '';
            if (document.user_accept.chk_rejection.checked)
                rejection = 1;
            if (document.user_accept.chk_sender.checked)
                sender = 1;

            url = url + '&rejection=' + rejection + '&sender=' + sender;
            $('#sms_action').load(url);
        }

        function manageConf() {

            if (document.user_accept.chk_confirmation.checked) {
                document.user_accept.chk_rejection.disabled = true;
                document.user_accept.chk_rejection.checked = false;
                document.user_accept.chk_sender.checked = true;
            } else {
                document.user_accept.chk_rejection.disabled = false;

            }

        }

        function deleteSlots(url) {
            if (confirm('{$translate.confirm_delete_slot}')) {
                wrapLoader(".add_contract_main_2");
                $('#leave_slots').load(url, function(response, status, xhr) {
                    uwrapLoader(".add_contract_main_2");
                });
                $('#avail_users').html('&nbsp;');
            }



        }
    </script>    
{/block}


{block name="content"}  

    <div id="sms_action" style="display:none;"></div>
    <div class="row-fluid">
        <!--////////////////////////////////////MAIN LEFT BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.sms_leave}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button style="" class="btn btn-default btn-normal span2 pull-right" type="button" onclick="javascript:location='{$url_path}message/center/';">{$translate.back}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="widget" style="margin-top:0;">
                    <!--WIDGET BODY BEGIN-->
                    <div class="span12 widget-body-section input-group">
                        <form method="post" action="" >
                        <div class="span2 sms-month" style="margin: 0px;">
                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.month}:</label>
                            <div style="margin-left: 0px; float: left;" class="input-prepend span9 hasDatepicker" id="datepicker">
                                <span class="add-on icon-pencil"></span>
                                <select class="form-control span11" name="month">
                                    <option value="">{$translate.select}</option>
                                    <option value="01" {if  $month == 1} selected = "selected" {/if} >{$translate.jan}</option>
                                    <option value="02" {if  $month == 2} selected = "selected" {/if}>{$translate.feb}</option>
                                    <option value="03" {if  $month == 3} selected = "selected" {/if}>{$translate.mar}</option>
                                    <option value="04" {if  $month == 4} selected = "selected" {/if}>{$translate.apr}</option>
                                    <option value="05" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                    <option value="06" {if  $month == 6} selected = "selected" {/if}>{$translate.jun}</option>
                                    <option value="07" {if  $month == 7} selected = "selected" {/if}>{$translate.jul}</option>
                                    <option value="08" {if  $month == 8} selected = "selected" {/if}>{$translate.aug}</option>
                                    <option value="09" {if  $month == 9} selected = "selected" {/if}>{$translate.sep}</option>
                                    <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
                                    <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
                                    <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
                                </select>
                            </div>
                        </div>
                        <div class="span2 sms-year" style="margin: 0px;">
                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.year}:</label>
                            <div style="margin-left: 0px; float: left;" class="input-prepend span11 hasDatepicker" id="datepicker">
                                <span class="add-on icon-pencil"></span>
                                <select class="form-control span9" id="cmb_year" name="year">
                                    <option value="">{$translate.select}</option>
                                    {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                </select>
                                {if $report_year == ""}
                                    {$report_year = $smarty.now|date_format:"%Y"}
                                {/if}
                                
                            </div>
                        </div>
                        <button class="btn btn-default btn-margin-set" style="margin-top: 15px; text-align: center;" type="submit" name="add" value="{$translate.show}">{$translate.show}</button>
                        </form>
                    </div>
                    <!--WIDGET BODY END-->
                </div>
                <div class="row-fluid">
                    <div class="span3 slotsms">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.workers_on_leave}</h1>
                            </div>
                            <!--WIDGET BODY BEGIN--><!--WIDGET BODY END-->
                        </div>
                        <div style="" class="span12 widget-body-section input-group sms-widget-body-height-fixed">
                            {$i=0}
                            {foreach $leave_details as $leave_detail}
                            <div class="row-fluid sms_slot_bt" id="sms_slot_btn{$i}" onclick="loadLeaveSlots('{$url_path}ajax_leave_sms.php?start_date={$leave_detail.start_date}&end_date={$leave_detail.end_date}&employee={$leave_detail.employee}&time_from={$leave_detail.time_from}&time_to={$leave_detail.time_to}&action=slots','{$i}','{$leave_detail.process_status}')">
                                <div class="span12">
                                    <ul class="workers-on-leave-list-wrpr {if $leave_detail.process_status == 0}sms-slot-completed{else}sms-slot-selected{/if}">
                                        <li>
                                            <strong>
                                            {if $sort_by_name == 1}{$leave_detail.empname_ff}{elseif $sort_by_name == 2}{$leave_detail.empname}{/if}
                                            </strong>
                                        </li>
                                        <li>
                                            {if $leave_detail.start_date == $leave_detail.end_date}
                                                {$leave_detail.start_date}&nbsp;{$leave_detail.time_from} - {$leave_detail.time_to}
                                            {else}
                                                {$leave_detail.start_date}&nbsp;{$leave_detail.time_from} - {$leave_detail.end_date}&nbsp;{$leave_detail.time_to}
                                            {/if}    
                                        </li>
                                        <li>
                                            {if $leave_detail.type == 1}Sjuk
                                            {else if $leave_detail.type == 2}Sem
                                            {else if $leave_detail.type == 3}VAB
                                            {else if $leave_detail.type == 4}FP
                                            {else if $leave_detail.type == 5}möte
                                            {else if $leave_detail.type == 6}Utbild
                                            {else if $leave_detail.type == 7}Övrigt
                                            {else if $leave_detail.type == 8}Byte
                                            {/if}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {/foreach}    
                            
                        </div>
                    </div>
                    <div id="leave_slots">
                    </div>
                    <div id="avail_users">    
            
            
                    </div>  
                    
                </div>
            </div>
        </div>
        
    </div>
{/block}               



