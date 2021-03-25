{block name='style'}
    <style type="text/css">
    .member_checkbox{
        padding: 2px 6px 1px;
    }
    #slot_edit2 span.times{
        width: 41px;
        display: block;
        float: left;
        padding-top: 5px;
        margin-left: 8px;
    }
    </style>
{/block}
{block name='content'}
{assign var = 'url_val' value='' scope='global'}
{if $employee.name != '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}{$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}{$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}
{if $action == 'type'}

    <form id="slot_edit2" name="slot_edit" method="post" action="" class="cust_slot_frm clearfix">
        <span class="times">{$translate.from_time}</span> <input style="width:170px; margin:3px 0px; height: 20px; float: left" type="text" name="from" id="from"  class="custom_slot" value="{$slot_det.time_from}" {if $type eq 10}oninput="avail_time_range_emps()" onemptied="avail_time_range_emps()"{/if}/>
        <span class="times">{$translate.to_time}</span> <input style="width:170px; margin:0px 0px 8px;height: 20px;float: left" type="text" name="to" id="to"  class="custom_slot" value="{$slot_det.time_to}" {if $type eq 10}oninput="avail_time_range_emps()" onemptied="avail_time_range_emps()"{/if}/>
        
        {if $type eq 10}
            <div id="PM_emp_mangage_div" class="clearfix">
                {*<div id="PM_emp_check_div" style="height: 20px;">{if $slot_det.employee neq '' or $customer_members|count gt 0}<a href="javascript:void(0);" class="btn_add_worker checkings_PM_empls" style="float: right;margin-right: 10px;" onclick="check_all_PM_emps()">{$translate.check_all}</a>{/if}</div>
                <div id="nwoekers_list" class="PM_employees_list" style="clear: both; margin-bottom: 5px;">
                    <ul>
                        {if $slot_det.employee neq ''}<li  style="width: 204px;"><label><span class="member_checkbox"><input type="checkbox" name="sel_employees" value="{$slot_det.employee}" checked="checked" disabled="disabled" /></span>{$slot_employee_details.last_name|cat:' '|cat:$slot_employee_details.first_name}</label></li>{/if}
                        {foreach $customer_members as $member}
                            {if $member.employee neq $slot_det.employee}<li  style="width: 204px;"><label><span class="member_checkbox"><input class="member_checkbox_input" type="checkbox" name="sel_employees" value="{$member.employee}" /></span>{$member.last_name|cat:' '|cat:$member.first_name}</label></li>{/if}
                        {/foreach}
                    </ul>
                </div>*} 
                <div id="PM_emp_check_div" style="height: 20px;">{if $available_employees|count gt 0}<a href="javascript:void(0);" class="btn_add_worker checkings_PM_empls" style="float: right;margin-right: 10px;" onclick="check_all_PM_emps()">{$translate.check_all}</a>{/if}</div>
                <div id="tosave_workers" class="PM_employees_list clearfix" style="clear: both; margin-bottom: 5px;">
                    <div class="clsScrolling" style="max-height: 180px;">
                        <ul>
                            {if $slot_det.employee neq '' and in_array($slot_det.employee, $avail_employee_ids)}<li  style="width: 201px;"><label><span class="member_checkbox"><input type="checkbox" name="sel_employees" value="{$slot_det.employee}" checked="checked" disabled="disabled" /></span>{$slot_employee_details.last_name|cat:' '|cat:$slot_employee_details.first_name}</label></li>{/if}
                            {foreach $available_employees as $member}
                                {if $member.username neq $slot_det.employee}<li  style="width: 201px;"><label><span class="member_checkbox"><input class="member_checkbox_input" type="checkbox" name="sel_employees" value="{$member.username}" /></span>{$member.name}</label></li>{/if}
                            {/foreach}
                        </ul>
                    </div>
                </div>

                {if $unavailable_employees|count gt 0}
                    <div class="sub_hd" style="margin: 12px 5px 5px; width: 91%;">{$translate.unavailable_employees}</div>
                    <div id="nwoekers_list" style="clear: both; margin-bottom: 5px;">
                        <div class="clsScrolling" style="max-height: 100px;">
                            <ul> 
                                {foreach $unavailable_employees as $member}
                                    <li  style="width: 201px;"><label>{$member.last_name|cat:' '|cat:$member.first_name}</label></li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                {/if}
            </div>
        {/if}
        
        <div style="margin: 0px 0px 10px 51px;">
            <a style="margin-right: 10px;width: 43px;padding: 3px 0px 0px 6px;height: 20px" href="javascript:void(0);" onclick="loadType('{$url_val}&id={$slot_det.id}&slot_from={$slot_det.time_from}&slot_to={$slot_det.time_to}&type={$type}&action={$action}')" class="alocation_lvbtn" id="save_button">{$translate.save}</a>
            <a style="width: 44px;padding: 3px 0px 0px 10px;height: 20px"href="javascript:void(0);" onclick="$('#allocate_cusempwork').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
        </div>
        <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
    </form>

{elseif $action == 'edit_duration'}
     <form id="slot_edit2" name="slot_edit" method="post" action="" class="cust_slot_frm clearfix">
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.from_time}</span> <input style="width:170px; margin:3px 0px; height: 20px; float: left" type="text" name="from" id="from"  class="custom_slot" value="{$slot_det.time_from}"/>
        <span style="width: 50px;display: block;float: left;padding-top: 5px">{$translate.to_time}</span> <input style="width:170px; margin:0px 0px 8px;height: 20px;float: left" type="text" name="to" id="to"  class="custom_slot" value="{$slot_det.time_to}" />
        <div style="margin: 0px 0px 10px 51px;">
            <a style="margin-right: 10px;width: 43px;padding: 3px 0px 0px 6px;height: 20px" href="javascript:void(0);" onclick="editDuration()" class="alocation_lvbtn" id="save_button">{$translate.save}</a>
            <a style="width: 44px;padding: 3px 0px 0px 10px;height: 20px"href="javascript:void(0);" onclick="$('#allocate_cusempwork').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
        </div>
        <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
    </form>
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
                <div id="scrolling_area"> 
                    <div id="scrolling" style="max-height: 350px;">
                        <ul>
                            {foreach $emp_details as $emp_det}
                                <li id="a" onclick="loadAdd('{$url_val}&id={$slot_det.id}&select_emp={$emp_det.username}&action=add_emp')">{if $sort_by_name == 1}{$emp_det.name_ff|cat:' '|cat:$emp_det.contract_hour|cat:'('|cat:$emp_det.worked_hour|cat:')'}{elseif $sort_by_name == 2}{$emp_det.name|cat:' '|cat:$emp_det.contract_hour|cat:'('|cat:$emp_det.worked_hour|cat:')'}{/if}</li>
                            {/foreach}
                            {foreach $unavail_emp_details as $emp_det}
                                <li class="unavailable">{$emp_det.name|cat:' '|cat:$emp_det.contract_hour|cat:'('|cat:$emp_det.worked_hour|cat:')'}<span style="font-style: italic;float:right;">{$emp_det.msg_status}</span></li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>


        </div> 
        <div style="clear:both;"></div> 
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div> 
    {/if}                    
{elseif $action == 'add_cust'}

    {if $work == 'error_emp'}
        <div class="message">{$translate.{'no_customer_available'}}</div> 
        <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
            <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#allocate_cusempwork').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
        </div>
    {else}    
        <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="max-height: 380px;">
                <div class="select_skill_title">{$translate.select_customer}</div>
                <div id="scrolling_area"> 
                    <div id="scrolling" style="max-height: 350px;">
                        <ul>
                            {foreach $cust_details as $cust_det}
                                <li id="a" onclick="loadAdd('{$url_val}&id={$slot_det.id}&select_cust={$cust_det.username}&action=add_cust')">{if $sort_by_name == 1}{$cust_det.name|cat:' '|cat:$cust_det.contract_hour|cat:'('|cat:$cust_det.worked_hour|cat:')'}{elseif $sort_by_name == 2}{$cust_det.name_lf|cat:' '|cat:$cust_det.contract_hour|cat:'('|cat:$cust_det.worked_hour|cat:')'}{/if}</li>
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
{block name='script'}
    <script type="text/javascript">
    $(document).ready(function() {
        $("#scrolling, .clsScrolling").jScrollPane();
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
        loadType('{$url_path}ajax_alloc_action.php?employee={$employee.userid}&customer={$customer.userid}&date={$cur_date}&id={$slot_det.id}&slot_cust={$slot_det.customer}&slot_emp={$slot_det.employee}&slot_ctfrom={$slot_det.time_from}&slot_ctto={$slot_det.time_to}&slot_from='+from+'&slot_to='+to+'&type={$type}&action={$action}')
    }
    
    {if $action eq 'type' and $type eq 10}
        function check_all_PM_emps(){
            var count = 0;
            $('#slot_edit2 .PM_employees_list input:checkbox.member_checkbox_input').each(function(index, element) {
                    count ++;
                    $(this).attr('checked','checked');
            });
            if(count > 0)
                $('#slot_edit2 #PM_emp_check_div a.checkings_PM_empls').attr('onclick', 'uncheck_all_PM_emps()').html('{$translate.uncheck_all}');
        }

        function uncheck_all_PM_emps(){
            var count = 0;
            $('#slot_edit2 .PM_employees_list input:checkbox.member_checkbox_input').each(function(index, element) {
                    count ++;
                    $(this).prop('checked','');
            });
            if(count > 0)
                $('#slot_edit2 #PM_emp_check_div a.checkings_PM_empls').attr('onclick', 'check_all_PM_emps()').html('{$translate.check_all}');
        }
        
        function avail_time_range_emps(){
            //$.ajaxQ.abortAll();
            var time_from = $.trim($('form#slot_edit2 #from').val());
            var time_to = $.trim($('form#slot_edit2 #to').val());
            if(time_from != '' && time_to != ''){
                time_from = parseFloat(time_from);
                time_to = parseFloat(time_to);
                
                wrapLoader('#PM_emp_mangage_div');
                $.ajax({
                    url:"{$url_path}ajax_get_avail_employees_for_PM.php",
                    type:"POST",
                    data:'slot_id={$slot_det.id}&time_from='+time_from+'&time_to='+time_to,
                    success:function(data){
                        $('#PM_emp_mangage_div').html(data);
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader('#PM_emp_mangage_div');
                });
            } else {
                $('#PM_emp_mangage_div').html('');
            }
        }
    {/if}
</script>
{/block}