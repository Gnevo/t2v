<script>
 function manageConf(type){
    if(type == 'time'){
        if($('input:checkbox[name=chk_confirmation]:checked').prop('checked')){
           $('input:checkbox[name=chk_rejection]').attr('disabled', 'disabled');
           $('input:checkbox[name=chk_rejection]').prop('checked', false);
           $('input:checkbox[name=chk_sender]').prop('checked', true);
        }else
            $('input:checkbox[name=chk_rejection]').attr('disabled', false);
    }
}

function saveSms(){
//    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=slot_approve_candg&week_num={$year_week}&customer={$customer}';
//    navigatePage(urls, 1);
    
    var slot_id = $("#slot_id").val();
    var opt_sms_conformation = 0;
    var opt_sms_sender = 0;
    var opt_sms_rejection = 0;
        {if $user_role neq 3}
            var rep_emp = $('.replace_employees_list_sms[name=rep_employees_sms]').val();
            if(typeof rep_emp == 'undefined') rep_emp = '';
            sms_emps = $('.replace_employees_list_sms').val();

            if($('input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                opt_sms_conformation = 1;
                if($('input:checkbox[name=chk_sender]:checked').prop('checked'))
                    opt_sms_sender = 1;
            }    
            else {
                if($('input:checkbox[name=chk_sender]:checked').prop('checked'))
                    opt_sms_sender = 1;
                if($('input:checkbox[name=chk_rejection]:checked').prop('checked'))
                    opt_sms_rejection = 1;    
            }
        {else}
            var rep_emp = '';
        {/if}
        var rep_emp = $('.replace_employees_list_sms[name=rep_employees_sms]').val();
        if(typeof rep_emp == 'undefined') rep_emp = '';
            //var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&leave_date=' + leave_date_day + '&leave_range_from=' + leave_time_from + '&leave_range_to=' + leave_time_to + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&leave_replacer=' + rep_emp + '&comments=' + leave_comments;
        var url_data_obj = { 'slots': slot_id, 'sms_send_employees' : rep_emp,
                 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection };
        //console.log(url_data_obj);
        wrapLoader(".slot_alocation_main");
        $.ajax({
            url:  '{$url_path}employee_sms_alert_send.php',
            type:"POST",
            data: $.param(url_data_obj),
            success:function(data){
{*                                        $('#alloc_action').html(data);*}
                        uwrapLoader(".slot_alocation_main");
                        $('.ui-dialog-content').dialog('close');
                    }
        });
    
}
$(document).ready(function (){
    $('#scroll').jScrollPane();
});
</script>
<div id="time_replacer_sms_tbl">
    <input type="hidden" name="slot_id" id="slot_id" value="{$slot_id}" />
    <table width="100%" style="border: 1px solid #ccc; margin-top: 6px;">
        <tr>
            <td>
                <table width="100%">
                    <tr><td><b>{$translate.replacement_employee}:</b></td></tr>
                    <tr>
                        <td>
                            <select name="rep_employees_sms" class="replace_employees_list_sms" multiple="multiple" style="width: 100%;">
                                {foreach $employees as $member}
                                    <option value="{$member.username}">{$member.name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            <td width=50 style="padding-left: 50px;">
                <table>
                    <tr>
                        <td>
                            <span class="confirmation_slot"> {$translate.confirmatoin} <span class="confirmation_slot_radio"><input name="chk_confirmation" type="checkbox" value="" onclick="manageConf('time');"/></span></span>
                            <span class="confirmation_slot"> {$translate.send_rejection} <span class="confirmation_slot_radio"><input name="chk_rejection" type="checkbox" value="0" /></span></span>
                            <span class="confirmation_slot"> {$translate.confirmation_to_sender}<span class="confirmation_slot_radio"><input name="chk_sender" type="checkbox" value="0" /></span></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
    <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;cursor: pointer" onclick="$('#right_click_send_sms').dialog('close');" href="javascript:void(0)" href="javascript:void(0)">{$translate.cancel}</a>
    <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;cursor: pointer" onclick="saveSms()">{$translate.send}</a>
</div> 