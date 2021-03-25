{block name='script'}
<script>
$(document).ready(function() {
    $("#scrolling").jScrollPane();
    $('#allocate_cusempwork').live('keypress',function(e){
            var p = e.which;
            if(p==13){
            {if $action == 'type'}
                $("#save_button").click();
                $('#allocate_cusempwork').dialog('close');
            {elseif $action == 'edit_duration'}
                $("#save_button").click();
                $('#allocate_cusempwork').dialog('close');
            {/if}
        }
    });
});
function editDuration(){
    var from = $("#from").val();
    var to = $("#to").val();
    loadTypeSlot('{$url_path}ajax_alloc_action_slot.php?date={$cur_date}&employee={$employee.userid}&customer={$customer.userid}&emp_alloc={$emp_alloc}&id={$slot_det.id}&slot_cust={$slot_det.customer}&slot_emp={$slot_det.employee}&slot_ctfrom={$slot_det.time_from}&slot_ctto={$slot_det.time_to}&slot_from='+from+'&slot_to='+to+'&type={$type}&action=edit_duration');
}
</script>

{/block}

{block name='content'}

{assign var = 'url_val' value='' scope='global'}
{if $employee.name != '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}{$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}

{if $action == 'type'}

    <form id="slot_edit2" name="slot_edit" method="post" action="" class="cust_slot_frm clearfix">
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.from_time}</span><input style="width:170px; margin:3px 0px; height: 20px;float: left;" type="text"  name="from" id="from"  class="custom_slot" value="{$slot_det.time_from}"/>
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.to_time}</span><input style="width:170px; margin:0px 0px 8px;height: 20px;float: left;"type="text" name="to" id="to"  class="custom_slot" value="{$slot_det.time_to}" /><br />
        <div style="margin: 0px 0px 10px 51px;">
            <a style="margin-right: 10px;width: 43px;padding: 3px 0px 0px 6px;height: 20px" href="javascript:void(0);" onclick="loadTypeSlot('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&type={$type}&action=type')" class="alocation_lvbtn" id="save_button">{$translate.save}</a>
            <a style="width: 44px;padding: 3px 0px 0px 10px;height: 20px"href="javascript:void(0);" onclick="$('#allocate_cusempwork').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
       <!-- <input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.save}" onclick="loadTypeSlot('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&type={$type}&action=type')"/>
        <input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.cancel}" onclick="$('#allocate_cusempwork').dialog('close');"/> -->
        </div>
        <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
    </form>
{elseif $action == 'edit_duration'}

    <form id="slot_edit2" name="slot_edit" method="post" action="" class="cust_slot_frm clearfix">
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.from_time}</span><input style="width:170px; margin:3px 0px; height: 20px;float: left;" type="text"  name="from" id="from"  class="custom_slot" value="{$slot_det.time_from}"/>
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.to_time}</span><input style="width:170px; margin:0px 0px 8px;height: 20px;float: left;"type="text" name="to" id="to"  class="custom_slot" value="{$slot_det.time_to}" /><br />
        <div style="margin: 0px 0px 10px 51px;">
            <a style="margin-right: 10px;width: 43px;padding: 3px 0px 0px 6px;height: 20px" href="javascript:void(0);" onclick="editDuration()" class="alocation_lvbtn" id="save_button">{$translate.save}</a>
            <a style="width: 44px;padding: 3px 0px 0px 10px;height: 20px"href="javascript:void(0);" onclick="$('#allocate_cusempwork').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
       <!-- <input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.save}" onclick="loadTypeSlot('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&type={$type}&action=type')"/>
        <input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.cancel}" onclick="$('#allocate_cusempwork').dialog('close');"/> -->
        </div>
        <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
    </form>

{elseif $action == 'split'}

    <form id="slot_edit2" name="slot_edit" method="post" action="" class="cust_slot_frm clearfix">
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.from_time}</span><input style="width:170px; margin:3px 0px; height: 20px;float: left;" type="text" name="from" id="from"  class="custom_slot" value="{$slot_det.time_from}"/>
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.to_time}</span><input style="width:170px; margin:0px 0px 8px;height: 20px;float: left;" type="text" name="to" id="to"  class="custom_slot" value="{$slot_det.time_to}" /><br />
        <div style="margin: 0px 0px 10px 51px;">
            <a style="margin-right: 10px;width: 43px;padding: 3px 0px 0px 6px;height: 20px" href="javascript:void(0);" onclick="loadTypeSlot('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&action=split')" class="alocation_lvbtn" id="save_button">{$translate.save}</a>
            <a style="width: 44px;padding: 3px 0px 0px 10px;height: 20px"href="javascript:void(0);" onclick="$('#allocate_cusempwork').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
            <!--<input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.save}" onclick="loadTypeSlot('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&action=split')"/>
        <input type="button" name="btn_save" id="btn_save"  class="" value="{$translate.cancel}" onclick="$('#allocate_cusempwork').dialog('close');"/>-->
        </div>
        <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
    </form>

{elseif $action == 'add_skill'}

    <div class="cstmr_wk_main">
        <div class="select_skill_scroller">
            <div class="select_skill_title">{$translate.select_skill}</div>
            <div id="scrolling_area"> <div id="scrolling"><ul>
                        {foreach $work_details as $work_det}
                            <li id="a" onclick="loadAdd('{$url_val}&id={$slot_det.id}&work={$work_det.id}&action=add_skill')">{$work_det.name}</li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div> 
    </div>

{elseif $action == 'add_emp'}

    {if $work == 'error_emp'}
        <div class="message">{$translate.{'no_employee_available'}}</div> 
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>
    {else}    
        <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="max-height: 380px;">
                <div class="select_skill_title">{$translate.select_employee}</div>
                <div id="scrolling_area"> <div id="scrolling" style="max-height: 350px;"><ul>
                            {foreach $emp_details as $emp_det}
                                <li id="a" onclick="loadAdd('{$url_val}&id={$slot_det.id}&select_emp={$emp_det.username}&work={$work}&action=add_emp')">{$emp_det.name|cat:' '|cat:$emp_det.contract_hour|cat:'('|cat:$emp_det.worked_hour|cat:')'}</li>
                            {/foreach}
                            {foreach $unavail_emp_details as $emp_det}
                                <li class="unavailable">{$emp_det.name|cat:' '|cat:$emp_det.contract_hour|cat:'('|cat:$emp_det.worked_hour|cat:')'}<span style="font-style: italic;float:right;">{$emp_det.msg_status}</span></li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div> 
        </div>
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>
    {/if}                    
{elseif $action == 'add_cust'}

    {if $work == 'error'}
        <div class="message">{$translate.{'multiple_skills'}}</div>
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>
    {elseif $work == 'error_emp'}
        <div class="message">{$translate.{'no_customer_available'}}</div> 
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>
    {else}    
        <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="max-height: 380px;">
                <div class="select_skill_title">{$translate.select_customer}</div>
                <div id="scrolling_area"> <div id="scrolling" style="max-height: 350px;"><ul>
                            {foreach $cust_details as $cust_det}
                                <li id="a" onclick="loadAdd('{$url_val}&id={$slot_det.id}&select_cust={$cust_det.username}&work={$work}&action=add_cust')">{$cust_det.name|cat:' '|cat:$cust_det.contract_hour|cat:'('|cat:$cust_det.worked_hour|cat:')'}</li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div> 
        </div>
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>               
    {/if}
{/if}
{/block}