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
{block name= "script"}
{/block}
{block name= "content"}
{if $action == "slots"}
    <div class="span3">
        <div style="margin: 0px ! important;" class="widget">
            <div class="widget-header span12">
                <h1>{$translate.slots_of_leave}</h1>
            </div>
            <!--WIDGET BODY BEGIN--><!--WIDGET BODY END-->
        </div>
        <div style="" class="span12 widget-body-section input-group sms-widget-body-height-fixed">
            {foreach $slots as $slot}
            <div class="slot-sms slot_bountery {if $slot.status == 0}slot-theme-incomplete{else if $slot.status == 1 || $slot.status == 2}slot-theme-complete{/if} span12" {if $slot.status == 0 || $slot.sms_status == 1}onclick="loadAvailUsers('{$url_path}ajax_leave_sms.php?start_date={$start_date}&end_date={$end_date}&date={$slot.date}&id={$slot.id}&time_from={$slot.time_from}&time_to={$slot.time_to}&customer={$slot.customer}&action=avail&leave_employee={$leave_employee}&leave_time_from={$leave_time_from}&leave_time_to={$leave_time_to}&sms_process_status={$slot.sms_status}')"{/if}>
                <div class="inner-panel span12">
                    <div class="sms-slottype-wrpr">
                        <div class="sms-slot-time">{$slot.time_from} - {$slot.time_to}</div>
                    </div>
                    {if $slot.status == 0}
                    <div class="time-slot-btn-close" onclick="deleteSlots('{$url_path}ajax_leave_sms.php?start_date={$start_date}&end_date={$end_date}&date={$slot.date}&id={$slot.id}&time_from={$slot.time_from}&time_to={$slot.time_to}&customer={$slot.customer}&action=delete&leave_employee={$leave_employee}&leave_time_from={$leave_time_from}&leave_time_to={$leave_time_to}&sms_process_status={$slot.sms_status}')">
                        X
                    </div>
                    {/if}
                    <div class="sms-slottype">
                        {if $slot.fkkn == 1}FK{else}KN{/if}
                    </div>
                    {if $slot.sms_status == 1} <span class="sms_type"> <img src="{$url_path}images/sms.png"> </span>{/if}
                    <div class="span12 sms-slottype-employe" style="margin:0;">
                        <div class="sms-slot-name" style="margin: -5px 0px 0px 3px; width: 106px;
overflow: auto;

height: 32px;">
                            {if $sort_by_name == 1}
                                {$translate.customer}: {$slot.cust_name_ff}
                                <br>
                                {$translate.employee}: {if $slot.status == 0}{$translate.pending}{else if $slot.status == 1 || $slot.status == 2}{$slot.emp_name_ff}{/if}
                            {elseif $sort_by_name == 2}
                                {$translate.customer}: {$slot.cust_name}
                                <br>
                                {$translate.employee}: {if $slot.status == 0}{$translate.pending}{else if $slot.status == 1 || $slot.status == 2}{$slot.emp_name}{/if}
                            {/if}    
                        </div>
                        <div class="sms-slot-type" style="float:right !important; width:30px;">
                            <ul class="slot-type-small-icons-group slot-week-types-icon">
                                {if $day_slot.type eq 1}<li class="slot-icon-small-travel" title="{$translate.travel}"></li>
                                {elseif $day_slot.type eq 0}<li class="slot-icon-small-normal" title="{$translate.normal}"></li>
                                {elseif $day_slot.type eq 2}<li class="slot-icon-small-break" title="{$translate.break}"></li>
                                {elseif $day_slot.type eq 3}<li class="slot-icon-small-oncall" title="{$translate.oncall}"></li>
                                {elseif $day_slot.type eq 4}<li class="slot-icon-small-over-time" title="{$translate.overtime}"></li>
                                {elseif $day_slot.type eq 5}<li class="slot-icon-small-qualtiy-overtime" title="{$translate.qual_overtime}"></li>
                                {elseif $day_slot.type eq 6}<li class="slot-icon-small-more-time" title="{$translate.more_time}"></li>
                                {elseif $day_slot.type eq 14}<li class="slot-icon-small-oncall-moretime" title="{$translate.more_oncall}"></li>
                                {elseif $day_slot.type eq 7}<li class="slot-icon-small-some-other-time" title="{$translate.some_other_time}"></li>
                                {elseif $day_slot.type eq 8}<li class="slot-icon-small-training" title="{$translate.training_time}"></li>
                                {elseif $day_slot.type eq 9}<li class="slot-icon-small-call-training" title="{$translate.call_training}"></li>
                                {elseif $day_slot.type eq 10}<li class="slot-icon-small-personal-meeting" title="{$translate.personal_meeting}"></li>
                                {elseif $day_slot.type eq 11}<li class="slot-icon-small-voluntary" title="{$translate.voluntary}"></li>
                                {elseif $day_slot.type eq 12}<li class="slot-icon-small-complimentary" title="{$translate.complementary}"></li>
                                {elseif $day_slot.type eq 13}<li class="slot-icon-small-complimentary-oncall" title="{$translate.complementary_oncall}"></li>
                                {elseif $day_slot.type eq 15}<li class="slot-icon-small-standby" title="{$translate.oncall_standby}"></li>{/if}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           {foreachelse}
            {$translate.no_slots_found}
           {/foreach}
        </div>
    </div>   
{/if}

{if $action == "avail"}
    <form name= "user_accept">
    <div class="span3" id="sms_replace_icon">
        <div style="margin: 0px ! important;" class="widget">
            <div class="widget-header span12">
                <h1>SMS Detailes</h1>
            </div>
            <!--WIDGET BODY BEGIN--><!--WIDGET BODY END-->
        </div>
        <div style="" class="span12 widget-body-section input-group sms-widget-body-height-fixed">
    {foreach $users as $user}
        <div class="row-fluid">
            <div class="slot-sms-deatiles slot_bountery span12">
                <div class="row-fluid sms-slottype-employe-wrpr">
                    <div class="sms-slottype-employe">
                        <div class="sms-slot-name" >
                            <div class="">
                                {if $sort_by_name == 1}
                                    {$user.name_ff}
                                {elseif $sort_by_name == 2}
                                    {$user.name}
                                {/if}
                            </div>
                            <div class="sms-mobile-numbr span12" style="margin:0; margin: 0px;height: 14px;min-height: 14px;">({$user.mobile})</div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="sms-send-deatiles" style="">
                        <ul>
                            {if $user.sms_send}
                            <li>
                                <img src="{$url_path}images/leave-sms-sent_icon.png">
                                <span>{$user.sms_send}</span>
                            </li>
                            {/if}
                            {if $user.sms_receive != "0-00 00:00" && $user.sms_receiv != ''}
                            <li>
                                <img src="{$url_path}images/leave-sms-recieved_icon.png">
                                <span>{$user.sms_receive}</span>
                            </li>
                            {/if}
                            {if $user.sms_status == ''}
                            <li>
                                <input name="chk_sms" type="checkbox" class="sms_ckeckbox" value="{$user.username}" />
                            </li>
                            {/if}
                            {if $user.sms_status == '3'}
                            <li>
                                <input name="btn_accept" type="button" class="sms_btn_accept btn btn-default btn-normal btn-accept-sms pull-right" value="{$translate.accept}" onclick="actionAccept('{$url_path}ajax_leave_sms.php?start_date={$start_date}&end_date={$end_date}&date={$sms_date}&id={$sms_id}&slot_time={$sms_slot}&customer={$sms_customer}&employee={$user.username}&action=accept&leave_employee={$leave_employee}&leave_time_from={$leave_time_from}&leave_time_to={$leave_time_to}')"/>
                            </li>
                            {/if}
                        </ul>
                    </div>
                </div>
            </div>
        </div>      
     {foreachelse}
        {$translate.no_users_available}
     {/foreach}
     </div>
     </div>
     <input type= "hidden" name=hd_btn_press>
     
     {if $sms_process_status == ''}
     <div class="span3">
        {if $sms_status == 3 || $sms_status == ''} 
        <div class="row-fluid">
            <div class="widget-header widget-header-light span12">
                <div class="span6">
                    <h1>{$translate.confirmatoin}</h1>
                </div>
                <div class="span6">
                    <input class="pull-right" name="chk_confirmation" type="checkbox" value="" onclick="manageConf()">
                </div>
            </div>
        </div>
        {/if}
        {if $sms_status == 3 || $sms_status == ''}
        <div class="row-fluid">
            <div class="widget-header widget-header-light span12">
                <div class="span6">
                    <h1>{$translate.send_rejection}</h1>
                </div>
                <div class="span6">
                    <input class="pull-right" name="chk_rejection" type="checkbox" value="0">
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="widget-header widget-header-light span12">
                <div class="span9">
                    <h1>{$translate.confirmation_to_sender}</h1>
                </div>
                <div class="span3">
                    <input class="pull-right" name="chk_sender" type="checkbox" value="0">
                </div>
            </div>
        </div>
        {/if}
        <div style="" class="span12 widget-body-section input-group text-confirmation">
            <h1><strong>{$translate.outgoing_message}:</strong></h1>
            <ul>
                <li>{$translate.customer}: {$sms_customer}</li>
                <li>{$translate.date}: {$sms_date}</li>
                <li>{$translate.shift}: {$sms_slot}</li>
                <li>{$translate.answer_yes}.</li>
            </ul>
            <h1><strong>{$translate.manual_message}:</strong></h1>
            <ul>
                <li>60 {$translate.char_max}
                    ( {$translate.total_160} )
                </li>
            </ul>
            <div class="row-fluid">
                <textarea rows="1" maxlength="60" class="form-control span12" name="user_msg" placeholder="{$translate.manual_message}"></textarea>
            </div>
            <div class="row-fluid">
                <button style="text-align: center;" type="button" class="btn btn-default span12" value="{$translate.send}" onclick="smsSend('{$url_path}ajax_leave_sms.php?date={$sms_date}&id={$sms_id}&slot_time={$sms_slot}&customer={$sms_customer}&leave_employee={$leave_employee}&leave_time_from={$leave_time_from}&leave_time_to={$leave_time_to}')">{$translate.send}</button>
            </div>
        </div>
    </div>
      {/if} 
     </form>       
{/if}    
{/block}


            
            