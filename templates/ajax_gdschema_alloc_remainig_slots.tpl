{if $employee.name != '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}
{*{if $privileges_gd.add_slot == 1}
    <div id="add_new_slot"><a href="javascript:void(0);" onclick="processEntry()" title="{$translate.boka_pass_add_new_slot}">{$translate.click_to_add_new_time_slot}</a></div>
{/if}    
<div id="slot_entry" style="display: none;margin-bottom: 5px">
    <form id="frm_slot_entry_new" name="frm_slot_entry_new" method="post" action="" class="cust_slot_frm clearfix" >
        <div class="time_slots_theme clearfix" >
            <div class="left_col" style="width: 80%;">
                <div class="company time">
                    <img title="{$translate.time}" alt="{$translate.time}" style="float: left; padding-top: 4px;" src="{$url_path}images/clock_icon.png">
                    <span class="duration">
                        <input type="text" name="slot_from" id="slot_from" class="custom_slot" tabindex="1" placeholder="{$translate.time_from}" onblur="load_avail_emps_within_period(this);" />
                        -
                        <input type="text" name="slot_to" id="slot_to" class="custom_slot" tabindex="2" placeholder="{$translate.time_to}" onblur="load_avail_emps_within_period(this);"/>
                    </span>
                </div>
                <div class="company clearfix">
                    <img title="{$translate.customer}" alt="{$translate.customer}" src="{$url_path}images/customer_icon_small.png">
                    {if $customer.name neq ''}
                        <span class="company_name">{$customer.name}</span>
                        <input type="hidden" id="custom_slot_customer" name="custom_slot_customer" value="{$customer.userid}" />
                    {else}
                        <span>
                            <select style="width:85%" id="custom_slot_customer" name="custom_slot_customer">
                                <option value="">{$translate.select}</option>
                            </select>                                        
                        </span>
                    {/if}
                </div>
                <div class="worker clearfix">
                    <img title="{$translate.employee}" alt="{$translate.employee}" src="{$url_path}images/employee_icon_small.png">
                    {if $employee.name neq ''}
                        <span class="worker_name">{$employee.name}</span>
                        <input type="hidden" id="custom_slot_employee" name="custom_slot_employee" value="{$employee.userid}" />
                    {else}
                        <span>
                            <select style="width:85%" id="custom_slot_employee" name="custom_slot_employee">
                                <option value="">{$translate.select}</option>
                            </select>                                        
                        </span>
                    {/if}
                </div>
                <div class="worker clearfix">
                    <img title="{$translate.comment}" src="{$url_path}images/icon_comment.png" style="vertical-align: top;">
                    <textarea style="width: 85%;height: 50px; margin-top: 1px;" id="comment_textarea" tabindex="3" placeholder="{$translate.comment}"></textarea>
                </div>
            </div>
            <div class="time_option clearfix">
                <div class="fk_kn_selected">
                    <ul class="fk_kn_dmenu">
                        <li style="margin-bottom:2px; display:block;">
                            {if $customer.name eq '' or ($customer.name neq '' and $customer.fkkn eq 1)}<a style="display:block;" class="selected_fkkn fk_style border_fkkn" data-value="1">FK</a>
                        {else}<a style="display:block;" class="selected_fkkn border_fkkn" data-value="2">KN</a>{/if}
                        <ul class="sub-menu">
                        {if !($customer.name eq '' or ($customer.name neq '' and $customer.fkkn eq 1))}<li><a href="javascript:void(0);" onclick="select_fkkn(1);" class="fk_style border_fkkn">FK</a></li>{/if}
                    {if $customer.name eq '' or ($customer.name neq '' and $customer.fkkn eq 1)}<li><a href="javascript:void(0);" onclick="select_fkkn(2);" class="border_fkkn">KN</a></li>{/if}
                    <li><a href="javascript:void(0);" onclick="select_fkkn(3);" class="border_fkkn">TE</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="type_selector clearfix">
        <span class="type_open" data-close-flag='close'><a href="#"></a></span>
        <ul class="clearfix">
            <li data-value="1" class="type_selector_li"><a title="{$translate.travel}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="travel"></a></li>
            <li data-value="0" class="type_selector_li selected"><a title="{$translate.normal}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="work"></a></li>
            <li data-value="2" class="type_selector_li"><a title="{$translate.break}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="lunch"></a></li>
            <li data-value="3" class="type_selector_li"><a title="{$translate.oncall}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="oncall"></a></li>
            <li data-value="4" class="type_selector_li"><a title="{$translate.overtime}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="overtime"></a></li>
            <li data-value="5" class="type_selector_li"><a title="{$translate.qual_overtime}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="qual_overtime"></a></li>
            <li data-value="6" class="type_selector_li"><a title="{$translate.more_time}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="more_time"></a></li>
            <li data-value="14" class="type_selector_li"><a title="{$translate.more_oncall}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="more_oncall"></a></li>
            <li data-value="7" class="type_selector_li"><a title="{$translate.some_other_time}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="some_other_time"></a></li>
            <li data-value="8" class="type_selector_li"><a title="{$translate.training_time}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="training_time"></a></li>
            <li data-value="9" class="type_selector_li"><a title="{$translate.call_training}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="call_training"></a></li>
            <li data-value="10" class="type_selector_li"><a title="{$translate.personal_meeting}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="personal_meeting"></a></li>
            <li data-value="11" class="type_selector_li"><a title="{$translate.voluntary}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="voluntary"></a></li>
            <li data-value="12" class="type_selector_li"><a title="{$translate.complementary}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="complementary"></a></li>
            <li data-value="13" class="type_selector_li"><a title="{$translate.complementary_oncall}" href="javascript:void(0);" onclick="seletct_type_selector(this);" class="complementary_oncall"></a></li>
        </ul>
    </div>
</div>
</div>
<table style="width: 100%; float: left;" class="clearfix">
    <tr>
        <td colspan="3" style="padding-bottom: 5px;">
            <p style="float:left;"><input type="checkbox" name="saveTimeslot" id="saveTimeslot" value="1" style="float:left; margin-right:5px;" checked="checked"/><label for="saveTimeslot">{$translate.save_timeslot}</label></p>
        </td>
    </tr>
    <tr>
        <td style="padding-top: 3px"><input type="button" name="btn_slot_entry" id="btn_slot_entry" value="{$translate.save}" onclick="manEntryPopup('{$url_val}&type=0&action=man_slot_entry')" tabindex="4"/>
            <input type="button" name="btn_slot_entry_back" id="btn_slot_entry_back" value="{$translate.back}" onclick="processDrag()" tabindex="5" style="margin-left: 4px"/></td>
    </tr>
</table>
</form>
</div>*}
            
{*<div id="memory_slot_grouping" class="clearfix" style="height: 395px; overflow: hidden; padding: 0px; width: 333px;">*}
    <div class="scroll_memory_inner">
        {foreach $memory_slots1 as $available_slots}
            <div class='memory_time clearfix'>
                <div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to|cat:'-'|cat:$available_slots.type}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to} {if $available_slots.type eq '3'}J{/if}</span></div>
                <a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -145px; width: 16px; height: 18px;"></div></a>
            </div>
        {/foreach}
    </div>
    <div class="scroll_memory_inner">
        {foreach $memory_slots2 as $available_slots}
            <div class='memory_time clearfix'>
                <div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to|cat:'-'|cat:$available_slots.type}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to} {if $available_slots.type eq '3'}J{/if}</span></div>
                <a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -145px; width: 16px; height: 18px;"></div></a>
            </div>
        {/foreach}
    </div>
    <div class="scroll_memory_inner">
        {foreach $memory_slots3 as $available_slots}
            <div class='memory_time clearfix'>
                <div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to|cat:'-'|cat:$available_slots.type}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to} {if $available_slots.type eq '3'}J{/if}</span></div>
                <a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -145px; width: 16px; height: 18px;"></div></a>
            </div>
        {/foreach}
    </div>
{*</div>*}

<script type="text/javascript">
$(document).ready(function(){
	dont_show_popup_flag = '{$dont_show_popup_flag}';
        
        
        $(".memory_time,.memory_time_black").draggable({ revert: true, appendTo: "#memory_slots", helper: 'clone' });
        $("#add_new_slot").droppable({
                hoverClass: "dropover",
                drop: function( event, ui ) {
                    var params = ui.draggable.find('input[type=checkbox]').val().split("-");
                    var time_from = parseFloat(params[0].replace(' ',''));
                    var time_to = parseFloat(params[1].replace(' ',''));
                    var slot_type = parseFloat(params[2].replace(' ',''));
                    var url_data = "&time_from="+time_from+"&time_to="+time_to+"&slotType="+slot_type+"&action=drop";
                    var url_slot_remain = '{$url_value_slot_remain}'+url_data;
                    var url = url_slot_remain;
                    
                    if (dont_show_popup_flag == '1')
                        drop_time_slot(time_from, time_to, slot_type, 0);
                    else{
                        var full_url = '{$url_path|cat:'gdschema_process_schemaAssign.php?'}'+ url.substring(url.indexOf('?')+1);
                        var dialog_box_copy = $("#timetable_process_copy");
                        dialog_box_copy.html('<div class="popup_first_loading" style="height: 100px;"></div>');

                        dialog_box_copy.load(full_url);
                        dialog_box_copy.dialog({
                            title: '{$translate.slots_process}',
                            position: 'top',
                            dialogClass: "special_popup_style",
                            modal: true,
                            resizable: false,
                            minWidth: 515,
                            minHeight: 100,
                            closeOnEscape: true,

                            close: function(event, ui) {
                                        $(this).dialog('destroy').remove();
                                        reload_popup_themes_copy();
                            }
                        });
                    }
                }
        }); 
                
});
</script>