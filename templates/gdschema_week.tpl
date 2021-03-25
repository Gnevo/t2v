{block name='style'}
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.css" media="all" />
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.lozenge.css" media="all" />
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
{block name='script'}


<script type="text/javascript">

$(function(){        
    $('.company_names, .unassigned_names').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane({
        showArrows: true,
        horizontalGutter: 10
    });
});
function reload_content(){

    wrapLoader(".fixedArea");
    wrapLoader(".worker_wrapper");
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_week_work_slot_section.php",
        data:"year_week={$year_week}&page_key={$page_key}&page_start={$page_start}",
        type:"POST",
        success:function(data){
                $(".fixedContainer .fixedTable").html(data);
                uwrapLoader(".fixedArea");
                var tempRaw = $('div.fixedContainer .fixedTable tr').map(function(){
                    return this;
                });


                $('div.fixedTable').scroll(function(){
                            $('div.fixedHead').scrollLeft(($(this).scrollLeft()));
                            $('div.fixedFoot').scrollLeft(($(this).scrollLeft()));
                            $('div.fixedTable').scrollTop(($(this).scrollTop()));
                    });
                    
                $('input#search_customer').quicksearch('div.fixedColumn .fixedTable table tr td', { 'rawTest' : true });
                $('input#search_employee').quicksearch('div.fixedContainer .fixedHead table tr td' , { 'columnTest' : true });
                
            }
    });
    
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_worker_wrapper_section.php",
        data:"year_week={$year_week}&week=",
        type:"POST",
        success:function(data){
                $(".worker_wrapper").html(data);
                uwrapLoader(".worker_wrapper");
                $('.company_names, .unassigned_names').jScrollPane();
                }
    });
    
}

$(document).ready(function(){
     // $("#cust_tr").height(cust_name_tr);
      
    $('a.popup').click(function() {
            
            var url = this.href;
            $('html').animate({
              scrollTop:0
                }, 10, function(){
            
            var dialog_box = $("#timetable_assign" );
            dialog_box.html('<div class="popup_first_loading" style="height: 500px;"></div>');
            // load remote content
            dialog_box.load(url);
            // open the dialog
            dialog_box.dialog({
                
                title: '{$translate.slots_allocation}',
                position: 'top',
                modal: true,
                minWidth: 1050,
                minHeight: 650,
                resizable: false,
                closeOnEscape: false,
                dialogClass: 'no-close',
                
                close: function(event, ui) {
                        
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                        if($('#chk_status').val() == 1){
                        
    //                      location.href='{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position}/{$page_key}/';
                            reload_content();
    //                        $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_assign"]').remove();
    //                        $('#timetable_assign').remove();
                            $('#chk_status').val('0');
                            
                        }
                }
        });
       });
        //prevent the browser to follow the link
       return false;
    });

    
    var tempRaw = $('div.fixedContainer .fixedTable tr').map(function(){
        return this;
    });
	
	
	$('div.fixedTable').scroll(function(){
		$('div.fixedHead').scrollLeft(($(this).scrollLeft()));
		$('div.fixedFoot').scrollLeft(($(this).scrollLeft()));
		$('div.fixedTable').scrollTop(($(this).scrollTop()));
    });
	
	$('input#search_customer').quicksearch('div.fixedColumn .fixedTable table tr td', { 'rawTest' : true });
	$('input#search_employee').quicksearch('div.fixedContainer .fixedHead table tr td' , { 'columnTest' : true });


    });
function loadPopupSlot(url,relod_url) {
    
    var dialog_box = $("#timetable_slot_assign" );
    dialog_box.html('<div class="popup_first_loading" style="height: 100px;"></div>');
    // load remote content
    dialog_box.load(url);
    // open the dialog
    dialog_box.dialog({
        title: '{$translate.slots_management}',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 515,
        closeOnEscape: false,
        dialogClass: 'no-close',
        buttons: {
            '{$translate.cancel}': function() {
                $(this).dialog("close");
            },
            '{$translate.save}': function() {
                $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
            $("#timetable_assign" ).load(relod_url);
        }
    });
    
}
function popup(url) {
    
    var dialog_box_new = $("#allocate_cusempwork" );
    dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>');
    // load remote content
    dialog_box_new.load(url);
    // open the dialog
    dialog_box_new.dialog({

        title: '{$translate.slots_allocation}',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 460,
        closeOnEscape: false,
        dialogClass: 'no-close',
        buttons: {
            '{$translate.cancel}': function() {
                $(this).dialog("close");
            },
            '{$translate.save}': function() {
                $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
        }
    });
 
    //prevent the browser to follow the link
    return false;
}
function popup_inner(url) {
    
    var dialog_box_new = $("#allocate_cusempwork" );
    dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>');
    // load remote content
    dialog_box_new.load(url);
    // open the dialog
    dialog_box_new.dialog({

        title: '{$translate.slots_allocation}',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 230,
        width: 230,
        minHeight: 100,
        closeOnEscape: false,
        dialogClass: 'no-close',
        buttons: {
            '{$translate.cancel}': function() {
                $(this).dialog("close");
            },
            '{$translate.save}': function() {
                $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
        }
    });
    //prevent the browser to follow the link
    return false;
} 

function reload_popup_themes(){
    $(".worker_wrapper #pop_up_themes").html('');
   $(".worker_wrapper #pop_up_themes").append('<div id="timetable_slot_assign" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="timetable_process" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="timetable_process_main" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="timetable_process_copy" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="timetable_assign" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="alloc_action" style="display:none;"></div>');
   $(".worker_wrapper #pop_up_themes").append('<div id="allocate_cusempwork" style="display: none;"></div>');
}

function closePopup(url){
    
    wrapLoader("#timetable_assign");
    $('#timetable_assign').load(url,function(response, status, xhr){ uwrapLoader("#timetable_assign"); });
    $('#timetable_slot_assign').dialog('close');
    }
function select_employee(val){
//    window.location.href = '{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position}/'+val+'/' ;
    navigatePage('{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position}/'+val+'/',1);
}
</script>
{/block}

{block name="content"}
<input type="hidden" value="0" id="chk_status">
<div class="worker_wrapper clearfix">
    <div id="pop_up_themes">
        <div id="timetable_slot_assign" style="display:none;"></div>
        <div id="timetable_process" style="display:none;"></div>
        <div id="timetable_process_main" style="display:none;"></div>
        <div id="timetable_process_copy" style="display:none;"></div>
        <div id="timetable_assign" style="display:none;"></div>
        <div id="alloc_action" style="display:none;"></div>
        <div id="allocate_cusempwork" style="display: none;"></div>
    </div>
    {$message}
    <div class="unassigned_customers">
        <div class="search_hd"><div class="unassign_hd">{$translate.companies_to_be_assigned} </div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $customers_to_allocate as $customer_to_allocate}
                    <tr>
                        <td width="340"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);" title="{$customer_to_allocate.code}">{$customer_to_allocate.customer_name}</a></td>
                        <td width="200" style="text-align: right; padding-right: 20px;"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);">{$customer_to_allocate.total_hours}h</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="unassigned_workers">
        <div class="search_hd"><div class="unassign_hd">{$translate.workers_to_be_assigned} </div></div>
        <div class="unassigned_names">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $employees_to_allocate as $employee_to_allocate}
                    <tr>
                        <td width="172"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);" title="{$employee_to_allocate.code}">{$employee_to_allocate.name}</a></td>
                        <td width="130"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);">{$employee_to_allocate.allocated}h {if $employee_to_allocate.allocate}({$employee_to_allocate.allocate}h){/if}</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div class="company_req">
        <div class="search_hd"><div class="comp_hd">{$translate.workers_on_leave}</div><div class="requ_dat_hd">{$translate.date}</div></div>
        <div class="company_names clearfix">
            <table class="pending" cellspacing="0" cellpadding="0">
                {foreach $leave_employees as $leave_employee}
                    <tr>
                        <td width="162"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);" title="{$leave_employee.code}">{$leave_employee.name} - {$leave_employee.type}</a></td>
                        <td width="127"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);">{$leave_employee.date}</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
</div>
<div id="wrapper">
    <div class="block_head"><span class="titles_tab">{$translate.basic_schedule_week}</span></div>
    <div id="tble_list">            
        <div class="table_workers">
            <div class="tableDiv" id="tableDiv_General grundschema_vecka_bg_null">
                <div class="pagention grundschema_vecka_pagention">
                {assign var='alphabets' value=','|explode:$translate.alphabets}
                    <div class="alphbts">
                        <ul>
                            {foreach from=$alphabets item=row}
                                <li><a href="javascript:void(0)" onclick="select_employee('{$row}')">{$row}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                    <div class="pagention_dv">
                        <div class="pagination">
                            <ul id="pagination">
                                {foreach $pagination as $pg}{$pg}{/foreach}    
                            </ul>
                        </div>
                   </div>
                </div>
                <div class="week_strip clearfix">
                    <div class="arrow_left">
                        <a onclick="navigatePage('{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position + 1}/{$page_key}/',1);" href="javascript:void(0);" title="{$translate.increase_week_position}"></a>
                    </div>
                    <ul class="weeks">
                        {foreach $week_numbers as $week_number}
                            {assign var=exp_week_year value="|"|explode:$week_number.id}
                            {if $week_number.selected}
                                <li class="active"><a onclick="navigatePage('{$url_path}day/gdschema/{$week_number.id}/1/8/1/',1);" href="javascript:void(0);"title="{$translate.enter_the_week} {$exp_week_year[1]}">{$week_number.value}</a></li>
                            {else}
                                <li><a onclick="navigatePage('{$url_path}week/gdschema/{$week_number.id}/{$page_start}/8/{$page_key}/',1);" href="javascript:void(0);" title="{$translate.go_to_week} {$exp_week_year[1]}">{$week_number.value}</a></li>
                            {/if}
                        {/foreach}
                    </ul>
                    <div class="arrow_right">
                        <a onclick="navigatePage('{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position - 1}/{$page_key}/',1);" href="javascript:void(0);" title="{$translate.reduce_week_position}"></a>
                    </div>
                </div>
                <div class="fixedArea clearfix">
                    {if $values != ""}
                    <div style="float: left; width: 140px; height: 360px;" class="fixedColumn">
                        <div class="fixedHead">
                            <table cellspacing="0">
                                <tbody>
                                    <tr id="cust_tr"><td id="" style="width: 130px;">{$translate.customer}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="fixedTable" style="width: 140px; overflow: hidden; border-collapse: separate; padding: 0pt; height: 335px;">
                            <table cellspacing="0" width="100%">
                                <tbody>
                                    {foreach $customers as $customer}
                                        <tr><td style="height: 93px;">
                                                {if $privileges.{$customer.username}.link}
                                                    <a onclick="navigatePage('{$url_path}customer/gdschema/{$year_week}/{$customer.username}/',1);" title="{$translate.go_to_customer}" href="javascript:void(0);">
                                                        {if $customer.ch == 1 && !empty($customer.company)}
                                                            {$customer.company.name}
                                                        {else}
                                                            {if $sort_by_name == 1}
                                                                {$customer.first_name} {$customer.last_name}
                                                            {elseif $sort_by_name == 2}
                                                                {$customer.last_name} {$customer.first_name}
                                                            {/if}
                                                            
                                                        {/if}
                                                    </a>
                                                {else}
                                                    {if $customer.ch == 1 && !empty($customer.company)}
                                                        {$customer.company.name}
                                                    {else}  
                                                        {if $sort_by_name == 1}
                                                                {$customer.first_name} {$customer.last_name}
                                                            {elseif $sort_by_name == 2}
                                                                {$customer.last_name} {$customer.first_name}
                                                            {/if}
                                                    {/if}
                                                {/if}
                                            </td></tr>
                                        {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="fixedContainer" style="width: 743px; float: left;">
                        <div class="fixedHead" style="width: 726px; float: left; overflow: hidden;">
                            <table cellspacing="0" style="width: 2080px;">
                                <tbody>
                                    <tr id="cust_name_tr">
                                        {foreach $employees as $employee}
                                            <td width="110px">
                                                {if $privileges.{$employee.username}.link}
                                                    <a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee.username}/',1);" href="javascript:void(0);" title="{$translate.go_to_employee}">{if $sort_by_name == 1}
                                                        {$employee.first_name} {$employee.last_name}
                                                    {elseif $sort_by_name == 2}
                                                        {$employee.last_name} {$employee.first_name}
                                                    {/if}</a>
                                                {else}
                                                    {if $sort_by_name == 1}
                                                        {$employee.first_name} {$employee.last_name}
                                                    {elseif $sort_by_name == 2}
                                                        {$employee.last_name} {$employee.first_name}
                                                    {/if}
                                                {/if}
                                            </td>
                                        {/foreach}
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="fixedTable" style="float: left; width: 743px; overflow: auto; height: 352px;">
                            <table cellspacing="0" cellpadding="0" id="Open_Text_General" class="FixedTables" style="width: 2080px;">
                                <tbody>
                                    {foreach $week_datas as $week_data}
                                        <tr>
                                            {foreach $week_data as $employee_data}
                                                <td width="110px" valign="top" style="height: 96px;">
                                                    <ul class="td_data">
                                                        {if !empty($employee_data.week)}
                                                            {foreach $employee_data.week as $week_data}
                                                                <li {if $week_data.leave}class="for_lv_day"{/if}>
                                                                    {if $privileges.{$employee_data.customer.username}.link && $privileges.{$employee_data.employee.username}.link && $week_data.signed == 0}
                                                                        <!--<a class="popup" href="{$url_path}gdschema_alloc.php?date={$week_data.date}&customer={$employee_data.customer.username}&employee={$employee_data.employee.username}">{$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span></a>-->
                                                                        <a onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$week_data.date}&customer={$employee_data.customer.username}&employee={$employee_data.employee.username}',1)" href="javascript:void();" title="{$translate.go_to_slots}">{$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span></a>
                                                                    {else}
                                                                        {$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span>
                                                                    {/if}
                                                                </li>
                                                            {/foreach}
                                                        {/if}
                                                    </ul>
                                                </td>
                                            {/foreach}
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>{/if}
                </div>

            </div>
        </div>
    </div>
</div>
{/block}