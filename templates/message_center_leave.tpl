{block name='style'}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css" >
        #leave_details_tbl tr.dynamicRows td{ background-color: #e3edf0; }
        .contracts img, .settings img{ max-width: inherit; }
        .valign-top{ vertical-align: top !important; }
        .cancel-leave { margin-top:20px !important; }
    </style>
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
<script async src="{$url_path}js/bootbox.js"></script>
<script async src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
<script type="text/javascript" >
$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $('#leave_details_tbl').css({ 'max-height': $(window).innerHeight()-150 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
      $('#leave_details_tbl').css({ 'max-height': $(window).innerHeight()-150 });
    });
    
    $(".rm-leave").click(function(e){
        e.stopPropagation();
    });
    
    $('.dynamicRows').click(function() {
        $(this).parent().next('tbody').toggle('slow');
    });

    $(document).on('keyup', "#search-section #cmb_month, #search-section #cmb_year, #search-section #employee_search_list, #search-section #txt_search_word", function(e) {
        
        var code = e.keyCode || e.which;
         if(code == 13) { //Enter keycode
            reload();
         }
    });
});
$(function() {
    var search_employees = [
            {foreach from=$search_emp_array item=employee}
                {
                    value: "{$employee.eID}",
                    label: "{$employee.eName}({$employee.eID})"
                },
            {/foreach}
    ];
    $( "#employee_search_list" ).autocomplete({
        minLength: 0,
        source: search_employees,
        focus: function( event, ui ) {
                    $( "#employee_search_list" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;
                    $("#employee_selected").val(sel_value);
                    $("#employee_search_list").val(sel_label);
                    return false;
                }
    })
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    };

});

function set_status(status,id){
    wrapLoader(".main-left");
    $('#left_message_wraper').html('');
    bootbox.dialog('{$translate.do_u_want_approve_leave}', [
         {
            "label" : "{$translate.no}",
            "class" : "btn-danger",
            "callback": function() {
                uwrapLoader(".main-left");
                bootbox.hideAll();
            }
        },
        {
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                $.ajax({
                    async   :false,
                    url     :"{$url_path}ajax_update_leave_status.php",
                    data    :"id="+id+"&status="+status,
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            if(data.result !== undefined && data.result){
                                {if $user_role eq 1 or $user_role eq 2 or $user_role eq 7}
                                    if(data.status != 1)    //not accept status
                                        $("#table_list #status_"+id).children("td:eq(9)").html('');
                                    else{
                                        var new_column_content = '';
                                        {if $user_role eq 1}
                                            new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>';
                                        {else if $user_role eq 2 or $user_role eq 7}
                                            {if $privileges_mc.leave_edit == 1}new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>';{/if}
                                        {/if}
                                        $("#table_list #status_"+id).children("td:eq(9)").html(new_column_content);
                                    }
                                {/if}
                                var new_status = (data.status == 1 ? '{$translate.approved}' : '{$translate.rejected}');
                                $("#table_list #status_"+id).children("td:eq(8)").html(new_status);
                                $("#table_list #status_"+id).children("td:eq(6)").html((data.status == 1 ? data.leave_details.appr_date : ''));
                                $("#table_list #status_"+id).children("td:eq(5)").find('.treated_username').html((data.status == 1 ? data.leave_details.appr_empname : ''));
                                
                                if(data.status == 1)    //change row_colour
                                    $("#table_list #status_"+id).addClass('col-highlight-primary');
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#left_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-left");
                });
            }
        }
    ]);
}

function set_status_reject(status,id,date_from,date_to,employee){
   bootbox.dialog('{$translate.do_u_want_reset_substitute_slots}', [
         {
            "label" : "{$translate.cancel}",
            "class" : "btn-primary",
         },
         {
            "label" : "{$translate.no}",
            "class" : "btn-danger",
            "callback": function() {
                var delete_flag = 0;
                set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag);
            }
         },
         {
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                var delete_flag = 1;
                set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag);
            }
         }
         
    ]);   
    // var delete_flag;
    // if(confirm('{$translate.do_u_want_reset_substitute_slots}'))
    //     delete_flag = 1;
    // else
    //     delete_flag = 0;
}

function set_status_reject_proceed(status,id,date_from,date_to,employee,delete_flag){
    var month = $("#cmb_month").val();
    var year = $("#cmb_year").val();
    $('#left_message_wraper').html('');
    wrapLoader(".main-left");
    $.ajax({
        async:false,
        url:"{$url_path}ajax_update_leave_status.php",
        data:"id="+id+"&status="+status+"&date_from="+date_from+"&date_to="+date_to+"&employee="+employee+"&year="+year+"&month="+month+"&vikarie_delete="+delete_flag,
        type:"POST",
        dataType: 'json',
        success:function(data){
                    if(data.result !== undefined && data.result){
                    {if $user_role eq 1 or $user_role eq 2 or $user_role eq 7}
                        if(data.status != 1)    //not accept status
                            $("#table_list #status_"+id).children("td:eq(9)").html('');
                        else{
                            var new_column_content = '';
                            {if $user_role eq 1}
                                new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>';
                            {else if $user_role eq 2 or $user_role eq 7}
                                {if $privileges_mc.leave_edit == 1}new_column_content += '<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ \'gid\': \''+data.leave_details.gid+'\' }, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>';{/if}
                            {/if}
                            $("#table_list #status_"+id).children("td:eq(9)").html(new_column_content);
                        }
                    {/if}
                    var new_status = (data.status == 1 ? '{$translate.approved}' : '{$translate.rejected}');
                    $("#table_list #status_"+id).children("td:eq(8)").html(new_status);
                    $("#table_list #status_"+id).children("td:eq(6)").html((data.status == 1 ? data.leave_details.appr_date : ''));
                    $("#table_list #status_"+id).children("td:eq(5)").find('.treated_username').html((data.status == 1 ? data.leave_details.appr_empname : ''));
                    
                    if(data.status == 1)    //change row_colour
                        $("#table_list #status_"+id).addClass('col-highlight-primary');
                }

                if(data.message !== 'undefined' && data.message != ''){
                    $('#left_message_wraper').html(data.message);
                }
                
                $('#main_container').removeClass('show_main_right');
                $(".main-right, #cancel_leave_wraper").addClass('hide');
        }
    }).always(function(data) { 
        uwrapLoader(".main-left");
    });
}

function loadAjaxSlotConfirm(url_data){
    //console.log(url_data);
    /*if(confirm('{$translate.confirm_cancel_leave}')){
        if(confirm('{$translate.do_you_want_to_reset_substitute_slots}\n\n{$translate.note_shortcode} {$translate.date_passed_substitute_slots_cant_remove|replace:"'":"\'"}')){
            url_data.vikarie_delete = '1';
            loadPopup_leave(url_data);
        }else{
            url_data.vikarie_delete = '0';
            loadPopup_leave(url_data);
        }
    }*/
    
    var slot_remove_multiple = true;
    if(url_data.action == 'leave_slot_remove_multiple'){
        var leave_from = strtotime($('#h_leave_from').val());
        var leave_to = strtotime($('#h_leave_to').val());
        var date_from = strtotime($('#delete_date_from').val() + ' 00:00:00');
        var date_to = strtotime($('#delete_date_to').val() + ' 00:00:00');
        if((date_from >= leave_from && date_from <= date_to) && date_to <= leave_to) {
            if($('#delete_date_from').val() == ''){
                bootbox.alert('{$translate.please_enter_date_from}', function(result){  });
                slot_remove_multiple = false;
            }else if($('#delete_date_from').val() == ''){
                slot_remove_multiple = false;
                bootbox.alert('{$translate.please_enter_date_to}', function(result){  });
            }
            else if(Date.parse($('#delete_date_to').val()) < Date.parse($('#delete_date_from').val())){
                bootbox.alert('{$translate.to_date_greaterthan_from_date}', function(result){  });
            }
            url_data = $('#btn_multi_leave').data('attr');
            url_data.date = $('#delete_date_from').val();
            url_data.date_to = $('#delete_date_to').val();
            url_data.tfrom = 0;
            url_data.tto = 24;
        } else {
             bootbox.alert('{$translate.invalid_date}', function(result){  });
        }
    }
    
    var today_date_time = strtotime('{$today_date} 00:00:00'+ ' -90 days');
    var slot_start_date_time = strtotime(url_data.date+" 00:00:00");
    var minute_diff = Math.round((today_date_time - slot_start_date_time) / 60);
    var is_past_slot = minute_diff > 0 ? true : false;
    
    if(is_past_slot){
        bootbox.alert('{$translate.date_is_passed_cant_cancel_leave}', function(result){  });
    }
    else if(slot_remove_multiple){
        bootbox.dialog( '{$translate.confirm_cancel_leave}', [{
            "label" : "{$translate.no}",
            "class" : "btn-danger"
        }, {
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                bootbox.dialog( '{$translate.do_you_want_to_reset_substitute_slots} <br/><br/>{$translate.note_shortcode} {$translate.date_passed_substitute_slots_cant_remove|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_2|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_3|replace:"'":"\'"}', [{
                    "label" : "{$translate.cancel}",
                    "class" : "btn-primary"
                }, {
                    "label" : "{$translate.btn_leave_substitute_reset_no}",
                    "class" : "btn-danger",
                    "callback": function() {
                        url_data.vikarie_delete = '0';
                        loadPopup_leave(url_data);
                    }
                }, {
                    "label" : "{$translate.btn_leave_substitute_reset_yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        url_data.vikarie_delete = '1';
                        loadPopup_leave(url_data);
                    }
                }]);
            }
        }]);
    }
}

function loadPopup_leave(url_data, basic_load) {

    //{$url_path}mc_leave_popup.php?gid={$entry.gID}
    
    
    if(url_data.gid != ''){
        
        if(basic_load !== 'undefined' && basic_load){
            $('#cancel_leave_wraper #have_updation').val('0');
    
            $('#main_container').addClass('show_main_right');
            $('.main-right').removeClass('hide');
            $("#cancel_leave_wraper").addClass('hide');
        }
        
        wrapLoader('.main-right');

        $.ajax({
            url:"{$url_path}mc_leave_popup.php",
            type:"POST",
            dataType: 'json',
            data: url_data,
            success:function(data){
                $("#cancel_leave_wraper").removeClass('hide');
                //console.log(data);
                $('#h_leave_from').val(data.leave_date_from);
                $('#h_leave_to').val(data.leave_date_to);
                $("#cancel_leave_wraper .header-panel .leave_emp_name").html(data.employee_name);
                $("#cancel_leave_wraper #leave_details_tbl tr.dynamicRows, #leave_details_tbl tbody, #leave_details_tbl #sub_grouping").remove();
                
                if(data.leave_details !== 'undefined' && data.leave_details.length > 0){
                    $.each(data.leave_details, function(i, value) {
                        $('#cancel_leave_wraper #leave_details_tbl').append(
                            $('<tbody>')
                                .append(
                                    $('<tr class="gradeX dynamicRows" id="row_status_'+value.gid+'">')
                                        .append('<td class="table-col-center" style="width:15px;"><button onclick=\'loadAjaxSlotConfirm({ "action": "leave_remove", "id":"'+value.id+'", "gid": "'+value.gid+'", "user" : "'+value.emp_id+'", "date" : "'+value.leave_date+'", "tfrom" : "'+value.time_from+'", "tto": "'+value.time_to+'"} );\' title="{$translate.cancel_leave}" type="button" class="btn btn-danger btn-small rm-leave"><i class="icon-trash"></i></button></td>')
                                        .append('<td style="cursor: pointer;">'+value.leave_date+'</td>')
                                        .append('<td style="cursor: pointer;">'+(data.leave_type[value.type] !== 'undefined' ? data.leave_type[value.type] : '')+'</td>')
                                        .append('<td style="cursor: pointer;">'+value.time_from+'</td>')
                                        .append('<td style="cursor: pointer;">'+value.time_to+'</td>')
                                )
                        )
                        .append($('<tbody id="sub_grouping" style="display: none;">')
                                .append( make_leave_slots_string(value) )
                            );

                    });
                    data_array = { 'action':'leave_slot_remove_multiple','gid':data.leave_details[0].gid, 'user':data.leave_details[0].emp_id }
                    $('#btn_multi_leave').attr('data-attr' ,JSON.stringify(data_array));             
                    
                }
                
                if(data.message !== 'undefined' && data.message != ''){
                    $('#cancel_leave_wraper #right_message_wraper').html(data.message);
                }
                
                if(data.process_result !== 'undefined' && data.process_result){
                    $('#cancel_leave_wraper #have_updation').val('1');
                }
                
                $('.dynamicRows').click(function() {
                    $(this).parent().next('tbody').toggle('slow');
                });
                
                $(".rm-leave").click(function(e){
                    e.stopPropagation();
                });
                
            }
        }).always(function(data) { 
            uwrapLoader('.main-right');
        });
    }
    return false;
}

function make_leave_slots_string(value){
    var str_slot_rows = '';
    //loadAjaxSlotConfirm(\'{$url_path}mc_leave_popup.php?action=leave_remove&id='+value.id+'&gid='+value.gid+'&user='+value.emp_id+'&date='+value.leave_date+'&tfrom='+value.time_from+'&tto='+value.time_to+'\')
    if(value.day_slots !== 'undefined' && value.day_slots.length > 0){
        $.each(value.day_slots, function(j, day_slot) {
            str_slot_rows += '<tr id="sub_slots"> \n\
                <td class="table-col-center" style="width:15px;"><button onclick=\''+ (day_slot.signed == 1 ? 'already_signed();' : 'loadAjaxSlotConfirm({ "action": "leave_slot_remove", "leave_id": "'+value.id+'", "gid": "'+value.gid+'", "slot_id": "'+day_slot.id+'", "employee": "'+day_slot.employee+'", "date": "'+value.leave_date+'", "tfrom": "'+day_slot.time_from+'", "tto": "'+day_slot.time_to+'"});' ) +'\' title="{$translate.cancel_leave}" type="button" class="btn btn-danger btn-small rm-leave"><i class="icon-remove"></i></button></td>\n\
                <td colspan="4">'+day_slot.time_from+' - '+day_slot.time_to+'</td>\n\
                </tr>';
        });
    }else
        str_slot_rows += '<tr id="sub_slots"><td colspan="5" style="color: red; text-align: center;">{$translate.no_time_slot_exists}</td></tr>';
        
    return str_slot_rows;
}

function already_signed(){
    alert("Report Already signed.");
}

function reload(){
    var month = $("#cmb_month").val();
    var year = $("#cmb_year").val();
    
    {if $user_role neq 3}
        var sel_emp = $("#employee_selected").val();
        var sel_emp_label = $("#employee_search_list").val();
        
        if($.trim(sel_emp) == '' || $.trim(sel_emp_label) == '')
            sel_emp = 'NULL';
    {else}
        var sel_emp = 'NULL';
    {/if}
        
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));
    
    var show_only_untreated_leave_flag = $("input:checkbox:checked#show_untreated_leaves_only").val();
    if(typeof show_only_untreated_leave_flag == 'undefined' || show_only_untreated_leave_flag != '1')
        show_only_untreated_leave_flag = 'N';
    else
        show_only_untreated_leave_flag = 'Y';
        
    if($.trim(year) == '') year = 'NULL';
    if($.trim(month) == '') month = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '{$url_path}message/center/leave/'+month+'/'+year+'/'+sel_emp+'/'+search_text+'/'+show_only_untreated_leave_flag+'/';
}

function save_cancel_leave(){
    var have_updation = $('#cancel_leave_wraper #have_updation').val();
        
    $('#main_container').removeClass('show_main_right');
    $(".main-right, #cancel_leave_wraper").addClass('hide');
            
    if(have_updation == '1'){
        window.location.href = '{$current_url}';
    }
}

{if $privileges_mc.approve_all_leave == 1}
    function approve_all_leaves(){
        wrapLoader(".main-left");
        $('#left_message_wraper').html('');
        bootbox.dialog('{$translate.do_u_want_approve_all_leave}', [
             {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                    uwrapLoader(".main-left");
                    bootbox.hideAll();
                }
            },
            {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        async   :false,
                        url     :"{$url_path}ajax_update_leave_status.php",
                        data    :"action=APPROVE_ALL&month={$report_month}&year={$report_year}",
                        dataType:'json',
                        type    :"POST",
                        success:function(data){
                            console.log(data);
                            if(data.result !== undefined && data.result){
                                reload();
                            }
                            else if(data.message !== 'undefined' && data.message != ''){
                                $('#left_message_wraper').html(data.message);
                            }
                        }
                    }).always(function(data) { 
                        uwrapLoader(".main-left");
                    });
                }
            }
        ]);
    }
{/if}

  $(".datepicker").datepicker({
                            autoclose: true,
                            weekStart: 1,
                            calendarWeeks: true
                
                        });

  function changeLeaveDate(){
    //$('.cancel-leave').css('display','block');
    $('.cancel-leave').toggle();
    toggle
  }

</script>
{/block}

{block name="content"}
<div class="row-fluid" id="main_container">
{*    main left*}

    <div class="span12 main-left slot-form">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="">{$translate.message_center}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    {if $privileges_mc.approve_all_leave == 1 && $has_untreated_leaves}<button onclick="approve_all_leaves();" class="btn btn-default btn-normal pull-right" name="approve_all_leaves" id="approve_all_leaves" value="{$translate.approve_all_leave}"> {$translate.approve_all_leave} </button>{/if}
                    <button onclick="javascript:location='{$url_path}message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.backs}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget" style="margin:0 0 10px 0 !important;">
                        <div class="span12 widget-body-section input-group"  id="search-section">
{*                            <form name="form" id="form" method="post" action="{$url_path}message/center/leave/">*}
                                <div class="span2 cmb-year" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_year">{$translate.year}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span10">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span9" name='cmb_year' id='cmb_year'>
                                            <option value="" >{$translate.select_year}</option>
                                            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-month" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_month">{$translate.month}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span11" name='cmb_month' id='cmb_month'>
                                            <option value="" >{$translate.select_month}</option>
                                            {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                        </select>
                                    </div>
                                </div>
                                {if $user_role neq 3}
                                    <div class="span3 employee-search-list" style="margin: 0px;">
                                        <label style="float: left;" class="span12" for="employee_search_list">{$translate.employee}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend span11">
                                            <span class="add-on icon-pencil"></span>
                                            <input name="employee_search_list" id="employee_search_list" value="{$sel_emp_label}" class="form-control span9" type="text" maxlength="100"/> 
                                            <input type="hidden" name="employee_selected" id="employee_selected" value="{$sel_emp}" />
                                        </div>
                                    </div>
                                {/if}
                                <div class="span3 txt-search-word" style="margin:0;">
                                    <label style="float: left;" class="span12" for="txt_search_word">{$translate.search_comment}: </label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="txt_search_word" id="txt_search_word" value="{$sel_search_text}" class="form-control span9" title="{$translate.search_comment}" type="text" maxlength="100" /> 
                                    </div>
                                </div>
                                <button onclick="reload();" class="btn btn-default pull-left btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="{$translate.show}"> {$translate.show} </button>
                                <input type="hidden" name="h_leave_from" id="h_leave_from" value="" />
                                <input type="hidden" name="h_leave_to" id="h_leave_to" value="" />
                                <form name="frm_mark_read" id="frm_mark_read" method="post" action="{$url_path}message/center/leave/" style="margin: 0px;">
                                    <button type="submit" class="btn btn-default pull-right btn-margin-set" style="margin-top: 15px; text-align: center;" value="{$translate.mark_all_read}" name="mark_read">{$translate.mark_all_read}</button>
                                </form>
                                <div class="span12 no-ml mt no-min-height">
                                    <label>
                                        <input type="checkbox" id="show_untreated_leaves_only" value="1" class="pull-left" {if $this_show_untreated_leave_only_flag_check_label_val eq 'Y'}checked="checked"{/if}>
                                        <span class="ml">{$translate.show_untreated_leaves_only}</span>
                                    </label>
                                </div>
{*                            </form>*}
                        </div>
                    </div>
                        
                    <div class="span12 no-min-height no-ml">
                        
                        <div class="pagination pagination-mini pagination-right pagin margin-none span12">
                            {if $pagination neq ''}<ul id="pagination">{$pagination}</ul>{/if}
                        </div>
                    </div>
                   
                    <input type="hidden" id="vikarie_delete_key" value="1" />
                      <div class="span12 no-ml table-responsive">
                    <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-primary t span12" style="margin: 0px 0px 0px; top: 0px;">
                        <thead>
                            <tr>
                                <th class="table-col-center" style="width:1%">#</th>
                                <th style="width:1%">{$translate.leave_type}</th>
                                <th style="width:3%">{$translate.date_from}</th>
                                <th style="width:4%">{$translate.date_to}</th>
                                <th style="width:10%">{$translate.employee_name}</th>
                                <th style="width:10%">{$translate.processed_name}</th>
                                <th style="width:5%">{$translate.processed_date}</th>
                                <th style="width:10%">{$translate.customer}</th>
                                <th style="width:0.1%">{$translate.status}</th>
                                {if $user_role eq 1 or $user_role eq 2 or $user_role eq 7}<th style="width:1%">&nbsp;</th>{/if}
                            </tr>
                        </thead>
                        <tbody>
                            {assign i 0}
                            {foreach from=$leave_list item=entry}
                                {assign i $i+1}
                                {assign record_no $this_page_no * $per_page + $i}
                                <tr id="status_{$entry.gID}" class="gradeX {cycle values="even,odd"} {if $entry.status =='1'}col-highlight-primary{/if}" {if $flag eq 1}style="font-weight: bold"{/if}>
                                    <td class="table-col-center" style="width:20px;">{$record_no}</td>
                                    <td>{if $entry.type eq 1}{$leave_type[1]}
                                        {elseif $entry.type eq 2}{$leave_type[2]}
                                        {elseif $entry.type eq 3}{$leave_type[3]}
                                        {elseif $entry.type eq 4}{$leave_type[4]}
                                        {elseif $entry.type eq 5}{$leave_type[5]}
                                        {elseif $entry.type eq 6}{$leave_type[6]}
                                        {elseif $entry.type eq 7}{$leave_type[7]}
                                        {elseif $entry.type eq 8}{$leave_type[8]}
                                        {elseif $entry.type eq 9}{$leave_type[9]}
                                        {elseif $entry.type eq 10}{$leave_type[10]}
                                        {elseif $entry.type eq 11}{$leave_type[11]}{/if}</td>
                                    <td>{$entry.From_date}</td>
                                    <td>{$entry.To_date}</td>
                                    <td><a style="text-decoration: underline;" href="javascript:void(0);" onclick="navigatePage('{$url_path}month/gdschema/employee/{substr($entry.From_date,0,4)}/{substr($entry.From_date,5,2)}/{$entry.employee}/mc_leave/',1)">{if $sort_by_name == 1}{$entry.empname}{elseif $sort_by_name == 2}{$entry.empname_lf}{/if}</a></td>
                                    <td {if $entry.comment neq '' and $user_role eq 1}title="{htmlspecialchars($entry.comment)}" style="cursor: help;"{/if}>
                                        {if $entry.comment neq '' and $user_role eq 1}<span style="float: left; padding-right: 5px;"><i class='icon-comment'></i></span>{/if}
                                        <span class='treated_username'>{if $sort_by_name == 1}{$entry.appr_empname}{elseif $sort_by_name == 2}{$entry.appr_empname_lf}{/if}</span>
                                    </td>
                                    <td >{$entry.appr_date} </td>
                                    <td>
                                        {foreach from=$entry.customer_data item=cust_data}
                                            {if $user_role eq 1 or $user_role eq 6 or $entry.employee eq $user_id or in_array($cust_data.customer,$tl_accessible_customers)}
                                                <a style="text-decoration: underline;" href="javascript:void(0);" onclick="navigatePage('{$url_path}month/gdschema/{substr($cust_data.slot_date,0,4)}/{substr($cust_data.slot_date,5,2)}/{$cust_data.customer}//{$entry.employee}/mc_leave/',1)">{$cust_data.name}</a><br>
                                            {else}
                                                <label>{$translate.works_on_another_customer}</label><br>
                                            {/if}

                                        {/foreach}    
                                    </td>
                                    <td {if $entry.status =='0'} title="{$translate.pending}" style="background: #000" {elseif $entry.status =='1'} title="{$translate.approved}" style="background: #00CC00" {elseif $entry.status =='2'} title="{$translate.rejected}" style="background:#FF0000 "{/if}>
                                        
                                    </td>
                                    {if $user_role eq 1 or $user_role eq 2 or $user_role eq 7}
                                        <td class="table-col-center center valign-top" style="width:50px;">
                                            {if $user_role eq 1}
                                                {if $entry.status eq '0'}
                                                    <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$entry.gID})"><img width="20" border="0" title="{$translate.approve}" alt="" src="{$url_path}images/icon_approve.png"></a>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status_reject(2,{$entry.gID},'{$entry.From_date}','{$entry.To_date}','{$entry.employee}')"><img width="20" height="20" border="0" title="{$translate.reject}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a>
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>
                                                {elseif $entry.status eq '1'}
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>
                                                {else}&nbsp;{/if}
                                            {else if $user_role eq 2}
                                                {if $entry.status eq '0' and $entry.privilege eq '1'}
                                                    {if $privileges_mc.leave_approval == 1}<a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$entry.gID})"><img width="20" border="0" title="{$translate.approve}" alt="" src="{$url_path}images/icon_approve.png"></a>{/if}
                                                    {if $privileges_mc.leave_rejection == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status_reject(2,{$entry.gID},'{$entry.From_date}','{$entry.To_date}','{$entry.employee}')"><img width="20" height="20" border="0" title="{$translate.reject}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a>{/if}         
                                                    {if $privileges_mc.leave_edit == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>{/if}
                                                {else if $entry.status eq '1' and $entry.privilege eq '1'}
                                                    {if $privileges_mc.leave_edit == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>{/if}
                                                {else}&nbsp;{/if}
                                            {else if $user_role eq 7}
                                                {if $entry.status eq '0' and $entry.privilege eq '1'}
                                                    {if $privileges_mc.leave_approval == 1}<a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$entry.gID})"><img width="20" border="0" title="{$translate.approve}" alt="" src="{$url_path}images/icon_approve.png"></a>{/if}
                                                    {if $privileges_mc.leave_rejection == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(2,{$entry.gID})"><img width="20" height="20" border="0" title="{$translate.reject}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a>{/if}         
                                                    {if $privileges_mc.leave_edit == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>{/if}
                                                {else if $entry.status eq '1' and $entry.privilege eq '1'}
                                                    {if $privileges_mc.leave_edit == 1}<a id="active_inactive" class="settings" href="javascript:void(0);" onclick="loadPopup_leave({ 'gid': '{$entry.gID}'}, true)"><img width="20" height="20" border="0" title="{$translate.cancel_leave}" alt="" src="{$url_path}images/leave_cancel.png"></a>{/if}
                                                {else}&nbsp;{/if}
                                            {/if}
                                        </td>
                                    {/if}
                                </tr>
                            {foreachelse}
                                <tr>
                                    <td {if $user_role eq 1 or $user_role eq 2 or $user_role eq 7}colspan="10"{else}colspan="9"{/if}><div class="message">{$translate.no_data_available}</div></td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{*    main right*}
    <div class="span4 main-right hide" style="{*margin: 20px 0px 0px 5px; *}margin-top: 8px; padding: 10px;">
        <div id="cancel_leave_wraper" class="hide">
            <div id="right_message_wraper" class="span12 no-min-height"></div>
            <h1>{$translate.applied_leaves}</h1>
            <hr>
            <div class="row-fluid">
                <div class="panel-group span12">
                    <div class="span12 header-panel">
                        <h1 class="leave_emp_name" style=" font-size:16px; float:left;"></h1>
                        <button class="btn btn-default btn-normal pull-right" onclick="changeLeaveDate();" type="button">{$translate.cancel_multiple_leave}</button>
                   <div class="clearfix"></div>
                    </div>
                </div>
                <div class="panel-body span12" style="padding: 0px 10px 10px !important;">
                    <div class="span12" style=" margin: 0px 0px 0px;">
                        
                        <div class="cancel-leave span12 widget-body-section input-group" style="margin-top: 20px; display: none;">
<div class="span5">
                                    <label style="float: left;" class="span12" for="txt_search_word">{$translate.date_from}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input  value="" class="form-control span9 datepicker"  type="text" id="delete_date_from" autocomplete="off"> 
                                    </div>
                                </div>
                                <div class="span5">
                                    <label style="float: left;" class="span12" for="txt_search_word">{$translate.date_to}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input  class="form-control span9 datepicker"  type="text" id="delete_date_to" autocomplete="off"> 
                                    </div>
                                </div>
                                 <div class="span2">
                                       <button class="btn btn-danger btn-sm pull-right" style="font-size: 9px !important;margin-top: 19px;padding: 4px 10px;line-height: 12px;" type="button" data-attr="" id="btn_multi_leave" onclick="loadAjaxSlotConfirm({ 'action': 'leave_slot_remove_multiple' })">{$translate.apply_multiple_leave}</button>
                                 </div>
                        </div>

                        <table id="leave_details_tbl" class="table table-white table-bordered table-hover table-responsive table-primary t span12" style="margin:10px 0 0 0;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{$translate.date}</th>
                                    <th>{$translate.leave_type}</th>
                                    <th>{$translate.time_from}</th>
                                    <th>{$translate.time_to}</th>
                                </tr>
                            </thead>
                            {*<tbody>
                                <tr class="gradeX dynamicRows">
                                    <td class="table-col-center">2013-07-01 </td>
                                    <td>Sjuk</td>
                                    <td>0.00</td>
                                    <td>2.00</td>
                                    <td class="table-col-center" style="width:15px;">
                                        <button type="button" class="btn btn-danger span1"><i class="icon-remove"></i></button>
                                    </td>
                                </tr>
                            </tbody>*}
                        </table>
                        <input type="hidden" id="have_updation" value="0"/>
                        <button type="button" class="btn btn-default pull-right" style="margin-top:10px;" onclick="save_cancel_leave();"><span class="icon icon-save"></span> {$translate.close}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{/block}
