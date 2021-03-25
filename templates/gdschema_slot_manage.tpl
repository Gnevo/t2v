{block name='style'}
    <style type="text/css">
        .no_pay_sick_check_div{ margin-top: 5px; padding-left: 3px; }
        .border_fkkn { border: 1px solid #C9C9C9; }
        li.selected_fkkn{ margin-bottom:2px; display:block; width: 26px; }
        .fkkn_btn .fk_kn_selected ul li{ width: 30px !important; }
        .fkkn_btn .fk_style{ background:#fff !important; color:#000 !important; }
    </style>
{/block}
{block name='script'}
<script src="{$url_path}js/time_formats.js" type="text/javascript" ></script>
<script>

$(document).ready(function() {
   
    $("#leave_types").buttonset();
    $( "#leave_date_from, #leave_date_to, #leave_date_day" ).datepicker({
        showOn: "button",
        dateFormat: "yy-mm-dd",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
    
    {if $user_role neq 3}
        $( ".leav #leave_date #leave_date_from, .leav #leave_date #leave_date_to" ).change(function(){
            load_replacement_employees();
        });

        $( ".leav #leave_time #leave_date_day" ).change(function(){
            load_replacement_employees();
        });

        $( ".leav #leave_time #leave_time_from, .leav #leave_time #leave_time_to" ).keyup(function(){
            load_replacement_employees();
        });
    {/if}
    
    function type_selector_init(){
        $('.type_selector li').unbind("click").on('click', function() {
            if ($(this).parent().parent().find('.type_open').attr('data-close-flag') == 'open') {
                $(this).parent().find('li').each(function(index, element) {
                    if (!($(this).parent().find('li').eq(index).hasClass('selected'))) {
                        $(this).parent().find('li').eq(index).css('display', 'none');
                    }
                });

                $(this).parents('.type_selector').animate({
                    height: 35,
                    width: 30
                }, 500);
                $(this).parent().parent().find('.type_open').attr('data-close-flag', 'close');
            }
        });
        $('.type_selector span.type_open').unbind("click").on('click',function(){
            $(this).parent().find('li').css('display', 'block');
            if ($(this).attr('data-close-flag') == 'close') {
                $(this).parents('.type_selector').animate({
                    height: $(this).parent().parent().parent().innerHeight() - 4,
                    width: $(this).parent().parent().parent().innerWidth() - 7
                }, 500);
                $(this).attr('data-close-flag', 'open');
            } else {
                $(this).parent().find('li').each(function(index, element) {
                    if (!($(this).parent().find('li').eq(index).hasClass('selected'))) {
                        $(this).parent().find('li').eq(index).css('display', 'none');
                    }
                });

                $(this).parents('.type_selector').animate({
                    height: 35,
                    width: 30
                }, 500);
                $(this).attr('data-close-flag', 'close');
            }
        });
    }
    type_selector_init();
    getAfterDates();
    
    {if $privileges_gd.no_pay_leave eq 1}
        $('#time_no_pay_sick_check, #date_no_pay_sick_check').click(function(){
            if($(this).is(':checked')){
                $(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.karense}').css('color', 'red');
            }else{
                $(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.no_karense}').css('color', '');
            }
        });
    {/if}

    $('#send_sms_time').click(function(){
            if($(this).is(':checked')){
                $('#time_replacer_sms_tbl').show();
                $('#time_replacer_nosms_tbl').hide();
            }else{
                $('#time_replacer_sms_tbl').hide();
                $('#time_replacer_nosms_tbl').show();
            }
    });
    $('#send_sms_date').click(function(){
            if($(this).is(':checked')){
                $('#date_replacer_sms_tbl').show();
                $('#date_replacer_nosms_tbl').hide();
            }else{
                $('#date_replacer_sms_tbl').hide();
                $('#date_replacer_nosms_tbl').show();
            }
    });

    $('#leave_date_day, #leave_date_from, #leave_time_from').change(function(){
        check_is_karense_day();
    });
});

function NewDate(str){
        str=str.split('-');
        var date=new Date();
        date.setUTCFullYear(str[0], str[1]-1, str[2]);
        date.setUTCHours(0, 0, 0, 0);
        return date;
}

{if $user_role neq 3}
function load_replacement_employees(){
    var leave_type_day  = $.trim($('#leave_type_day').val());
    var slot_id         = $.trim($('#slot_id').val());
    
    if(leave_type_day == 2){
        var leave_date_day  = $.trim($('#leave_date_day').val());
        var leave_time_from = $.trim($('#leave_time_from').val());
        var leave_time_to   = $.trim($('#leave_time_to').val());
{*        alert('date='+leave_date_day+'&time_from='+leave_time_from+'&time_to='+leave_time_to+'&id='+slot_id+'&leave_format='+leave_type_day);return  false;*}
        if(slot_id != '' && leave_time_from != '' && leave_time_to != '' && leave_date_day != ''){
            wrapLoader("#leave_time_replacement_emps");
            $.ajax({
                url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                type:"POST",
                dataType: "json",
                data:'date='+leave_date_day+'&time_from='+leave_time_from+'&time_to='+leave_time_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                success:function(data){
                            //$('#time_replacer_nosms_tbl').html(data);
                            //console.log(data);
                            //var rep_list_options = '';
                            $('#replace_employees_list_time').html('<option value="">{$translate.none}</option>');
                            $('.replace_employees_list_sms').html('');
                            $.each(data, function(i, value) {
                                //rep_list_options += '<option value="'+value.username+'">'+value.name+'</option>';
                                $('#replace_employees_list_time').append($('<option>').text(value.name).attr('value', value.username));
                                $('.replace_employees_list_sms').append($('<option>').text(value.name).attr('value', value.username));
                            });
                            /*$('#time_replacer_nosms_tbl').html('<table>\n\
                                    <tr>\n\
                                        <td>{$translate.replacement_employee}</td>\n\
                                        <td>\n\
                                            <select name="rep_employees" class="replace_employees_list">\n\
                                                    <option value="">{$translate.none}</option>\n\
                                                '+rep_list_options+'</select>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>');
                            $('.replace_employees_list_sms').html(rep_list_options);*/
                        },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) {
                uwrapLoader("#leave_time_replacement_emps");
            });
        }
    } else if(leave_type_day == 1){
        var leave_date_from = $.trim($('#leave_date_from').val());
        var leave_date_to   = $.trim($('#leave_date_to').val());
        //var date1 = new Date(leave_date_from);
        //var date2 = new Date(leave_date_to);
{*        var date1 = NewDate(leave_date_from).toGMTString();*}
        var date1 = NewDate(leave_date_from)
        var date2 = NewDate(leave_date_to);
{*        alert('date_from='+leave_date_from+'&date_to='+leave_date_to+'&id='+slot_id+'&leave_format='+leave_type_day);return  false;*}
{*        alert('date_from='+leave_date_from+'&date_to='+leave_date_to+'&date1='+date1+'&date2='+date2+'&leave_format='+leave_type_day);*}
        if (date1 > date2) 
            alert('{$translate.check_the_from_and_to_date}');
        else if(slot_id != '' && leave_date_from != '' && leave_date_to != ''){
            wrapLoader("#leave_date_replacement_emps");
            $.ajax({
                url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                type:"POST",
                dataType: "json",
                data:'date_from='+leave_date_from+'&date_to='+leave_date_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                success:function(data){
                            //$('#date_replacer_nosms_tbl').html(data);
                            //var rep_list_options = '';
                            $('#replace_employees_list_date').html('<option value="">{$translate.none}</option>');
                            $('.replace_employees_list_date_sms').html('');
                            $.each(data, function(i, value) {
                                //rep_list_options += '<option value="'+value.username+'">'+value.name+'</option>';
                                $('#replace_employees_list_date').append($('<option>').text(value.name).attr('value', value.username));
                                $('.replace_employees_list_date_sms').append($('<option>').text(value.name).attr('value', value.username));
                            });
                            /*$('#date_replacer_nosms_tbl').html('<table>\n\
                                    <tr>\n\
                                        <td>{$translate.replacement_employee}</td>\n\
                                        <td>\n\
                                            <select name="rep_employees" class="replace_employees_list">\n\
                                                    <option value="">{$translate.none}</option>\n\
                                                '+rep_list_options+'</select>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>');
                            $('.replace_employees_list_date_sms').html(rep_list_options);*/
                        },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) {
                uwrapLoader("#leave_date_replacement_emps");
            });
        }
    }
}
{/if}

function getAfterDates(){
        max_week_number = 52;
        var year_week = '{$slot_details.date}';
        var year = parseInt({$cur_slot_year_of_week}, 10);
        var to_week = parseInt($("#from_wk").val()) + (parseInt($("#from_option").val()));
        if (to_week > max_week_number) {
            to_week = to_week - max_week_number;
            year = year + 1;
        }
        $('#to_wk').find('option').remove();
        for (i = 0; i < 40; i++) {
            if (to_week > max_week_number) {
                to_week = 1;
                year = year + 1;
            }
            $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#to_wk");
            to_week = to_week + 1;
        }
}

function loadAjax(url){
    $('#alloc_action').load(url);
}

function leaveTab(tab){
        $('#leave_date').hide();
        $('#leave_time').hide();
        if (tab == 'time') {
            $('#leave_type_day').val(2);
            $('#date_time_date').removeClass("selected");
            $("#date_time_time").addClass("selected");
            $('#leave_time').show();
            check_is_karense_day();
        } else {
            $('#date_time_time').removeClass("selected");
            $("#date_time_date").addClass("selected");
            $('#leave_type_day').val(1);
            $('#leave_date').show();
            check_is_karense_day();
        }
}
    
function slotAction(type) {
    
        if(type == 'leave') {
            if ($('#slot_manage_copy_multiple').css('display') == 'block') {
                $('#slot_manage_copy_multiple').toggle();
            }
            $('#slot_action_leave').toggle();
            if ($('#slot_action_leave').css('display') == 'none') {
                $('#cancel_button_div').show();
            } else {
                $('#cancel_button_div').hide();
            }
        }
        else if (type == 'mult_copy') {
            if ($('#slot_action_leave').css('display') == 'block') {
                $('#slot_action_leave').toggle();
            }
            $('#slot_manage_copy_multiple').toggle();
            if ($('#slot_manage_copy_multiple').css('display') == 'none') {
                $('#cancel_button_div').show();
            } else {
                $('#cancel_button_div').hide();
            }
        }
}


{if $slot_details.type neq 12 and $slot_details.type neq 13}
    function saveLeave(base_url){
    
            var leave_type = $('#leave_type_val').val();
            if (leave_type != '') {
                var leave_date_from = $('#leave_date_from').val();
                var leave_date_to = $('#leave_date_to').val();
                var leave_type_day = $('#leave_type_day').val();
                var slot_id = $('#slot_id').val();
                var employee = $('#leave_employee').val();
                var leave_comments = $('#leave_comments').val();
                var no_pay_check_value = 0;
                var sms_emps = [ ];
                var need_sms = false;
                
                var opt_sms_conformation = 0;
                var opt_sms_sender = 0;
                var opt_sms_rejection = 0;
                
                {*leave on between date*}
                if (leave_type_day == '1') {
    {*                var rep_emp = $('.replace_employees_list_date input:radio:checked[name=rep_date_employees]').val();*}
                    {if $user_role neq 3}
                        var rep_emp = $('.replace_employees_list_date[name=rep_date_employees]').val();
                        if(typeof rep_emp == 'undefined') rep_emp = '';
                        
                        need_sms = $('#send_sms_date').prop('checked');
                        if(need_sms){
                            sms_emps = $('.replace_employees_list_date_sms').val();
                            
                            if($('input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                                opt_sms_conformation = 1;
                                if($('input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                    opt_sms_sender = 1;
                            }    
                            else {
                                if($('input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                    opt_sms_sender = 1;
                                if($('input:checkbox[name=chk_rejection_date]:checked').prop('checked'))
                                    opt_sms_rejection = 1;    
                            }
                        }
                    {else}
                        var rep_emp = '';
                    {/if}
                        
                    if (leave_date_from != '' && leave_date_to != '') {
{*                        var date1 = NewDate(leave_date_from).toGMTString();*}
                        var date1 = NewDate(leave_date_from);
                        var date2 = NewDate(leave_date_to);
                        //alert(date1 +' - '+date2);
                        if (date1 <= date2) {
                            
                            {if $privileges_gd.no_pay_leave eq 1}
                                var no_pay_check = $('input:checkbox[name=date_no_pay_sick_check]:checked').val();
                                if(no_pay_check) no_pay_check_value = 1;
                            {else}
                                no_pay_check_value = 1;
                            {/if}

                            //var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&date_from=' + leave_date_from + '&date_to=' + leave_date_to + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&leave_replacer=' + rep_emp + '&comments=' + leave_comments;
                            var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'date_from': leave_date_from, 'date_to': leave_date_to, 'leave_type': leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                    'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection };
                        
                            wrapLoader(".slot_alocation_main");
                            $.ajax({
                                url: base_url + 'save_leave.php',
                                type:"POST",
                                data: $.param(url_data_obj),
                                success:function(data){
{*                                            $('#alloc_action').html(data);*}
                                            uwrapLoader(".slot_alocation_main");
                                            $('.ui-dialog-content').dialog('close');
                                        }
                            });
                            $('#chk_status').val('1');
                            $("#have_updation").val('1');
                        } else
                            alert('{$translate.check_the_from_and_to_date}');
                    }else
                        alert('{$translate.check_the_from_and_to_date}');
                } else if (leave_type_day == '2') { {*leave on time*}
                    var leave_date_day = $('#leave_date_day').val();
                    var leave_time_from = $('#leave_time_from').val();
                    var leave_time_to = $('#leave_time_to').val();
                    
                    {if $privileges_gd.no_pay_leave eq 1}
                        var no_pay_check = $('input:checkbox[name=time_no_pay_sick_check]:checked').val();
                        if(no_pay_check) no_pay_check_value = 1;
                    {else}
                        no_pay_check_value = 1;
                    {/if}
                            
    {*                var rep_emp = $('.replace_employees_list input:radio:checked[name=rep_employees]').val();*}
                    {if $user_role neq 3}
                        var rep_emp = $('.replace_employees_list[name=rep_employees]').val();
                        if(typeof rep_emp == 'undefined') rep_emp = '';
                        
                        need_sms = $('#send_sms_time').prop('checked');
                        if(need_sms){
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
                        }
                    {else}
                        var rep_emp = '';
                    {/if}
                    var rep_emp = $('.replace_employees_list[name=rep_employees]').val();
                    if(typeof rep_emp == 'undefined') rep_emp = '';
                    if (leave_date_day != '') {
                        //var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&leave_date=' + leave_date_day + '&leave_range_from=' + leave_time_from + '&leave_range_to=' + leave_time_to + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&leave_replacer=' + rep_emp + '&comments=' + leave_comments;
                        var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_date': leave_date_day, 'leave_range_from': leave_time_from, 'leave_range_to': leave_time_to, 'leave_type' : leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection };
                        //console.log(url_data_obj);
                        wrapLoader(".slot_alocation_main");
                        $.ajax({
                            url: base_url + 'save_leave.php',
                            type:"POST",
                            data: $.param(url_data_obj),
                            success:function(data){
{*                                        $('#alloc_action').html(data);*}
                                        uwrapLoader(".slot_alocation_main");
                                        $('.ui-dialog-content').dialog('close');
                                    }
                        });
                        $('#chk_status').val('1');
                        $("#have_updation").val('1');
                    } else {
                        alert('{$translate.please_select_one_date}');
                    }
                }
            } else {
                alert('{$translate.please_select_a_leave_type}');
            }
    }
{/if}

function setLeaveType(val) {
    $('#leave_type_val').val(val);
    check_is_karense_day();
    if(val == 1){
        $('.no_pay_sick_check_div').css('display', 'block');
    }else
        $('.no_pay_sick_check_div').css('display', 'none');
    
    //check is sem leave to remove time tab
    /*if(val == 2){
        $('.date_time #date_time_time').removeClass("selected").hide();
        $('.date_time #date_time_date').addClass("selected");
        $('#leave_type_day').val(1);
        $('#leave_time').hide();
        $('#leave_date').show();
    } else {
        $('.date_time #date_time_time').show();
    }*/
}
function loadContentSlot(url){
    wrapLoader("#timetable_slot_assign");
    $('#timetable_slot_assign').load(url,function(response, status, xhr){ uwrapLoader("#timetable_slot_assign"); });
}

function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){
        
        {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
            if(typeof animation_element !== "undefined")
                wrapLoader(animation_element);
            else 
                wrapLoader("#assigned_inner");

            $.ajax({
                url: "{$url_path}ajax_check_atl_and_contract.php",
                type: "GET",
                data: check_url_data,
                dataType: "json",
                success:function(data){
                
                {*                console.log(data);*}
                    {if $company_atl_checking_flag eq 1}
                        
                        if(data.atl == 'success'){
                            {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                _fn_success_call_back(_call_back_data);
                            {else}  /*checking contract*/
                                if(data.contract == 'success'){
                                    _fn_success_call_back(_call_back_data);
                                }else{
                                    {if $privilages['contract_override'] eq 1}
                                        $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                        $( "#dialog-confirm-contract" ).dialog({
                                                resizable: false,
                                                width: 350,
                                                modal: true,
                                                buttons: {
                                                    "{$translate.yes}": function() {
                                                            $( this ).dialog( "close" );
                                                            _fn_success_call_back(_call_back_data);
                                                    },
                                                    "{$translate.no}": function() {
                                                        $( this ).dialog( "close" );
                                                    }
                                                }
                                        });
                                    {else}
                                        $("#overlap_error").remove();
                                        $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                    {/if}
                                }
                            {/if}
                        }
                        else{
                            _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                            {if $privilages.atl_override eq 1}
                                $("#dialog-confirm p").html("<span class='error_msg_icon'></span>" + data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}");
                                $( "#dialog-confirm" ).dialog({
                                    resizable: false,
                                    width: 350,
                                    modal: true,
                                    buttons: {
                                        "{$translate.yes}": function() {
                                                $( this ).dialog( "close" );
                                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                    _fn_success_call_back(_call_back_data);
                                                {else}
                                                    if(data.contract == 'success'){
                                                         _fn_success_call_back(_call_back_data);
                                                    }else{
                                                        {if $privilages['contract_override'] eq 1}
                                                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                                                $( "#dialog-confirm-contract" ).dialog({
                                                                    resizable: false,
                                                                    width: 350,
                                                                    modal: true,
                                                                    buttons: {
                                                                        "{$translate.yes}": function() {
                                                                                $( this ).dialog( "close" );
                                                                                _fn_success_call_back(_call_back_data);
                                                                        },
                                                                        "{$translate.no}": function() {
                                                                            $( this ).dialog( "close" );
                                                                        }
                                                                    }
                                                                });
                                                        {else}
                                                                $("#overlap_error").remove();
                                                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                                        {/if}
                                                    }
                                                {/if}
                                            },
                                        "{$translate.no}": function() {
                                            $( this ).dialog( "close" );
                                        }
                                    }
                                }); 
                            {else} 
                                 alert(data.atl);
                            {/if}
                        }
                    {else if $company_contract_checking_flag eq 1}
                        if(data.contract == 'success'){
                            _fn_success_call_back(_call_back_data);
                        }else{
                            {if $privilages['contract_override'] eq 1}
                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                $( "#dialog-confirm-contract" ).dialog({
                                        resizable: false,
                                        width: 350,
                                        modal: true,
                                        buttons: {
                                            "{$translate.yes}": function() {
                                                    $( this ).dialog( "close" );
                                                    _fn_success_call_back(_call_back_data);
                                            },
                                            "{$translate.no}": function() {
                                                $( this ).dialog( "close" );
                                            }
                                        }
                                });
                            {else}
                                $("#overlap_error").remove();
                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                            {/if}
                        }
                    {/if}
                 },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
             })
             .always(function(data) {
                if(typeof animation_element !== "undefined")
                    uwrapLoader(animation_element);
                else 
                    uwrapLoader("#assigned_inner");
            });
        {else}
            _fn_success_call_back(_call_back_data);
        {/if}
}

function loadAjaxSlot(url){
    var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
    if(url_obj.action == "swap" && url_obj.swap == "1"){
{*        alert(url.substring(url.indexOf('?')+1)+'&type_check=15'); return false;*}
        {if $swap_var neq ''}
            var atl_req_data = url.substring(url.indexOf('?')+1) + '&type_check=15';
            check_atl_warning(atl_req_data, function(this_url){
                                //$('#alloc_action').load(this_url);
                                wrapLoader("#timetable_slot_assign");
                                $('#timetable_slot_assign').load(this_url,function(response, status, xhr){ uwrapLoader("#timetable_slot_assign"); });
                            }, url, '#timetable_slot_assign');
        {else}
            wrapLoader("#timetable_slot_assign");
            $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#timetable_slot_assign"); });
             //$('#timetable_slot_assign').load(url,function(response, status, xhr){ uwrapLoader("#timetable_slot_assign"); });
        {/if}
    }else{
        //$('#alloc_action').load(url);
        wrapLoader("#timetable_slot_assign");
            $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#timetable_slot_assign"); });
    }
   
}
function loadAjaxSlotConfirm(url,method){
    var confirm_message = '';
    if(method == 1){
        confirm_message = '{$translate.confirm_delete}';
    }else if(method == 2){
        confirm_message = '{$translate.confirm_delete_customer}';
    }else{
        confirm_message = '{$translate.confirm_delete_slot}';
    }
    if(confirm(confirm_message)){
        wrapLoader(".slot_alocation_main"); 
        $('#alloc_action').load(url, function(response, status, xhr) {
                uwrapLoader(".slot_alocation_main");
                $("#have_updation").val('1');
                var coming = '{$coming}';
                if(coming == 'customer' && confirm_message == '{$translate.confirm_delete_customer}'){
                    $('.ui-dialog-content').dialog('close');
                }
                else if(confirm_message == '{$translate.confirm_delete}' && coming == 'employee'){
                    $('.ui-dialog-content').dialog('close');
                }else if(confirm_message == '{$translate.confirm_delete_slot}'){
                    $('.ui-dialog-content').dialog('close');
                }
        });
    }
}

function process_edit_duration(url){
    wrapLoader("#slot_edit2");
    $('#alloc_action').load(url,function(response, status, xhr){ 
        uwrapLoader("#slot_edit2"); 
        $("#have_updation").val('1');
        $("#chk_status").val("1");
        glob.dialog('close');
    });
}
function loadTypeSlot(url){
    var time_flag = 1;
    var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
{*    var type = url.slice(url.search('&type=')+6,url.search('&action='));*}
    var type = url_obj.type;
    if($('#from').val()!='' && $('#to').val()!=''){
        if(type == 3|| type == 9 || type == 13 || type == 14){
            $('#from').val(time_to_sixty($('#from').val()));
            $('#to').val(time_to_sixty($('#to').val()));
            if($('#to').val() == 0){
                $('#to').val(24);
            }
            time_flag = 0;
            {foreach from=$inconv_timings item=inconv_timing}
                if((parseFloat($('#from').val()) >= parseFloat("{$inconv_timing.time_from}") && parseFloat($('#from').val()) < parseFloat("{$inconv_timing.time_to}"))
                    && 
                   (parseFloat($('#to').val()) > parseFloat("{$inconv_timing.time_from}") && parseFloat($('#to').val()) <= parseFloat("{$inconv_timing.time_to}"))){ldelim}
                    time_flag = 1;
                {rdelim}
            {/foreach}
        }
        if(time_flag == 1){
            var new_tfrom = $('#from').val();
            var new_tto = $('#to').val();
            url = url + '&time_from='+new_tfrom+'&time_to='+new_tto;
            if(url_obj.action == 'edit_duration' && $.trim(url_obj.slot_cust) != '' && $.trim(url_obj.slot_emp) != '' && (parseFloat(url_obj.slot_ctfrom) < parseFloat(new_tfrom) || parseFloat(url_obj.slot_ctto) < parseFloat(new_tto))) {
                {*for edit duration*}
                var atl_req_data = url.substring(url.indexOf('?')+1) + '&type_check=9';
                check_atl_warning(atl_req_data, function(this_url){
                                    process_edit_duration(this_url);
                                }, url, '#slot_edit2');
            } else {
                process_edit_duration(url);
            }
         }else{
            alert('{$translate.time_outside_oncall}');
         }
    }else{
        alert('{$translate.please_enter_time}');
    }
}
function loadAdd(url){
    {*    alert(url);*}
    var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
    if(url_obj.action == "add_emp" || url_obj.action == "add_cust"){
        var type_check = url_obj.action == "add_emp" ? 2 : 6;
        var atl_req_data = url.substring(url.indexOf('?')+1)+"&type_check="+type_check;
        check_atl_warning(atl_req_data, function(this_url){
                            $('#allocate_cusempwork').dialog('close');
                            wrapLoader(".slot_alocation_main"); 
                            $('#alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader(".slot_alocation_main"); });
                        }, url, '#timetable_slot_assign, #allocate_cusempwork');
    }else{
        wrapLoader(".slot_alocation_main"); 
        $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader(".slot_alocation_main"); });
        $('#allocate_cusempwork').dialog('close');
    }
}

function save_copy(){
    var days = "";
    var with_user = 1;
    for(var i=0; i < document.frm_copy.days.length; i++){
    if(document.frm_copy.days[i].checked)
        days += document.frm_copy.days[i].value+'-';
    }
    if(days == '') {
        alert('select days');
    }else{
        if($('#withoutuser').attr("checked") == "checked")
            with_user = 0;
        var additional_urldata = 'customer={$slot_details.customer}&employee={$slot_details.employee}&date={$slot_details.date}&from_week=' + $('#from_wk').val() + '&from_option=' + $('#from_option').val() + '&to_week=' + $('#to_wk').val() + '&id={$slot_details.id}&days=' + days + '&with_user=' + with_user + '&action=copy_multiple&user={$in_user}';
        if(with_user == 1){
            var atl_req_data = additional_urldata + '&to_single_slot=TRUE&type_check=11';
            var process_url = '{$url_path}ajax_alloc_action_slot.php?' + additional_urldata;
            check_atl_warning(atl_req_data, function(this_url){
                                wrapLoader("div.selected");
                                $('#copy_multiple_save').load(this_url, function(response, status, xhr){ uwrapLoader("div.selected"); });
                            }, process_url, '.slot_alocation_main');
        }else{
            wrapLoader("div.selected");
            $('#copy_multiple_save').load('{$url_path}ajax_alloc_action_slot.php?' + additional_urldata, function(response, status, xhr){ uwrapLoader("div.selected"); });
        }    
    }
}

function check_is_karense_day(){
    
    var leave_type = $('#leave_type_val').val();
    var no_pay_check_value = 0;
    if(leave_type == 1){
        var leave_type_day = $('#leave_type_day').val();
        var slot_id = $('#slot_id').val();
        var employee = $('#leave_employee').val();
        var leave_date  = '';
        var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_day' : leave_type_day };
                
        {*leave on between date*}
        if (leave_type_day == '1') {
            leave_date = $('#leave_date_from').val();
            
            url_data_obj['date'] = leave_date;
            url_data_obj['leave_taken_beween'] = 'dates';
            
            var no_pay_check = $('input:checkbox[name=date_no_pay_sick_check]:checked').val();
            if(no_pay_check) no_pay_check_value = 1;
            
        }
        else if (leave_type_day == '2') { {*leave on time*}
            leave_date = $('#leave_date_day').val();
            var leave_time_from = $('#leave_time_from').val();
            var leave_time_to = $('#leave_time_to').val();
            
            url_data_obj['date'] = leave_date;
            url_data_obj['leave_taken_beween'] = 'time';
            url_data_obj['leave_time_from'] = leave_time_from;
            url_data_obj['leave_time_to'] = leave_time_to;
            
            var no_pay_check = $('input:checkbox[name=time_no_pay_sick_check]:checked').val();
            if(no_pay_check) no_pay_check_value = 1;
        }
        
        //var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'date_from': leave_date_from, 'date_to': leave_date_to, 'leave_day' : leave_type_day };
        //console.log(url_data_obj);
        
        $.ajax({
            url: "{$url_path}ajax_check_karense_exist.php",
            type: "POST",
            dataType: 'json',
            data: $.param(url_data_obj),
            success:function(data){
                //console.log(data);
                if(data.transaction == true){
                    if(data.karense == true){
                        if(no_pay_check_value == 1)
                            $('#karense_notify').hide().html('<div class="message">{$translate.karense_included}</div>').fadeIn('slow');
                        else
                            $('#karense_notify').hide().html('<div class="message">{$translate.karense_not_included}</div>').fadeIn('slow');
                    } else
                        $('#karense_notify').html('');
                } else
                    $('#karense_notify').html('');
            },
            error: function (xhr, ajaxOptions, thrownError){
                //alert(thrownError);
            }
        });
    } else
        $('#karense_notify').html('');
    
}

function messagePrivilege(){
    alert('{$translate.permission_denied}');
}

function editComment(){
        var textarea_value = $("#spam_comment_textarea_text").val();
        $.ajax({    //top 3 columns
        async:true,
        cache: true,
        url:"{$url_path}ajax_alloc_action_slot.php",
        data: 'id={$slot_details.id}&action=edit_comment&comment_text='+textarea_value,
        type:"POST",
        success:function(data){
        if(data == 'sucess'){
            //var textarea_value = $("#spam_comment_textarea_text").val();
           $("#have_updation").val("1");
           $("#chk_status").val("1")
            {if $slot_details.employee != '' && $slot_details.customer !=''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}&customer={$slot_details.customer}';
            {elseif $slot_details.employee != '' && $slot_details.customer ==''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}';
            {elseif $slot_details.employee == '' && $slot_details.customer !=''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&date={$slot_details.date}&customer={$slot_details.customer}';
            
            {/if}
            //var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
            $("#spam_comment p").text(textarea_value);
            $("#spam_comment_textarea").hide();
            $("#spam_comment").show();
            loadContentSlot(url_reload);
        }
                }
    });
}

function saveEmployee(url){
    var emp = $('#select_employee').val();
    if(emp != ""){
        var textarea_value = $("#spam_comment_textarea_text").val()
        var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
        if(url_obj.action == "add_emp_save"){
        var type_check = url_obj.action == "add_emp" ? 2 : 6;
            var atl_req_data = url.substring(url.indexOf('?')+1)+"&type_check=2&emp_new="+emp+"&comment="+textarea_value;
           
           check_atl_warning(atl_req_data, function(this_url){
                                wrapLoader(".slot_alocation_main"); 
//                                $('#alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader(".slot_alocation_main"); });
//                                    alert(this_url);
                                   var url_new = this_url.split("?");
                                   
                                $.ajax({
                                url: url_new[0],
                                type: "POST",
                                data: url_new[1],
                                success:function(data){
                                wrapLoader(".slot_alocation_main"); 
                                     
                                     $("#have_updation").val("1");
                                        $("#chk_status").val("1")
                                         {if $slot_details.employee != '' && $slot_details.customer !=''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}&customer={$slot_details.customer}';
                                         {elseif $slot_details.employee != '' && $slot_details.customer ==''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}';
                                         {elseif $slot_details.employee == '' && $slot_details.customer !=''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&date={$slot_details.date}&customer={$slot_details.customer}';

                                         {/if}
                                     loadContentSlot(url_reload);
                                     uwrapLoader(".slot_alocation_main");
                                }
                            });
                            }, url+"&emp_new="+emp+"&comment="+textarea_value, '#timetable_slot_assign');
        }
    }else{
        editComment();
    }
}

function saveCustomer(url){
    var cust = $('#select_customer').val();
    if(cust != ""){
        var textarea_value = $("#spam_comment_textarea_text").val()
        var url_obj = JSON.parse('{ "' + decodeURI(url.substring(url.indexOf('?')+1).replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '" }');
        if(url_obj.action == "add_cust_save"){
            var type_check = url_obj.action == "add_emp" ? 2 : 6;
            var atl_req_data = url.substring(url.indexOf('?')+1)+"&type_check=6&cust_new="+cust+"&comment="+textarea_value;
            
            check_atl_warning(atl_req_data, function(this_url){
                                wrapLoader(".slot_alocation_main"); 
                                
                                var url_new = this_url.split("?");
                                $.ajax({
                                url: url_new[0],
                                type: "POST",
                                data: url_new[1],
                                success:function(data){
                                     wrapLoader(".slot_alocation_main"); 
                                     $("#have_updation").val("1");
                                        $("#chk_status").val("1")
                                         {if $slot_details.employee != '' && $slot_details.customer !=''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}&customer={$slot_details.customer}';
                                         {elseif $slot_details.employee != '' && $slot_details.customer ==''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}';
                                         {elseif $slot_details.employee == '' && $slot_details.customer !=''}
                                             var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&date={$slot_details.date}&customer={$slot_details.customer}';

                                         {/if}
                                     loadContentSlot(url_reload);
                                      uwrapLoader(".slot_alocation_main");
                                }
                            });

                            }, url+"&cust_new="+cust+"&comment="+textarea_value, '#timetable_slot_assign');
        }
    }else{
        editComment();
    }
}

function acceptCandGSlot(){
   if(confirm('{$translate.confirm_approval_candg}')){
   var textarea_value = $("#spam_comment_textarea_text").val();
        $.ajax({    //top 3 columns
        async:true,
        cache: true,
        url:"{$url_path}ajax_alloc_action_slot.php",
        data: 'id={$slot_details.id}&action=slot_approve_candg_new&comment_text='+textarea_value,
        type:"POST",
        success:function(data){
        if(data == 'sucess'){
            //var textarea_value = $("#spam_comment_textarea_text").val();
           $("#have_updation").val("1");
           $("#chk_status").val("1")
            {if $slot_details.employee != '' && $slot_details.customer !=''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}&customer={$slot_details.customer}';
            {elseif $slot_details.employee != '' && $slot_details.customer ==''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee={$slot_details.employee}&date={$slot_details.date}';
            {elseif $slot_details.employee == '' && $slot_details.customer !=''}
                var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&date={$slot_details.date}&customer={$slot_details.customer}';
            
            {/if}
            //var url_reload = '{$url_path}gdschema_slot_manage.php?slot={$slot_details.id}&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
            
            loadContentSlot(url_reload);
        }
                }
    });
    } 
}

function manageConf(type){
    if(type == 'time'){
        if($('input:checkbox[name=chk_confirmation]:checked').prop('checked')){
           $('input:checkbox[name=chk_rejection]').attr('disabled', 'disabled');
           $('input:checkbox[name=chk_rejection]').prop('checked', false);
           $('input:checkbox[name=chk_sender]').prop('checked', true);
        }else
            $('input:checkbox[name=chk_rejection]').attr('disabled', false);
    }
    else if(type == 'date'){
        if($('input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
           $('input:checkbox[name=chk_rejection_date]').attr('disabled', 'disabled');
           $('input:checkbox[name=chk_rejection_date]').prop('checked', false);
           $('input:checkbox[name=chk_sender_date]').prop('checked', true);
        }else
            $('input:checkbox[name=chk_rejection_date]').attr('disabled', false);
    }
}

</script>
{/block}

{block name='content'}
{$message}
{assign var = 'url_val' value='' scope='global'}
{assign var = 'url_val_popup' value='' scope='global'}
{if $slot_details.employee != '' && $slot_details.customer !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$slot_details.date|cat:'&employee='|cat:$slot_details.employee|cat:'&customer='|cat:$slot_details.customer|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_slot_popup.php?date='|cat:$slot_details.date|cat:'&employee='|cat:$slot_details.employee|cat:'&customer='|cat:$slot_details.customer|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $slot_details.employee != '' && $slot_details.customer ==''}
    {$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$slot_details.date|cat:'&employee='|cat:$slot_details.employee|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_slot_popup.php?date='|cat:$slot_details.date|cat:'&employee='|cat:$slot_details.employee|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $slot_details.employee == '' && $slot_details.customer !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$slot_details.date|cat:'&customer='|cat:$slot_details.customer|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_slot_popup.php?date='|cat:$slot_details.date|cat:'&customer='|cat:$slot_details.customer|cat:'&emp_alloc='|cat:$emp_alloc}
{else if $slot_details.employee == '' && $slot_details.customer ==''}
    {$url_val = $url_path|cat:'ajax_alloc_action_slot.php?date='|cat:$slot_details.date|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_slot_popup.php?date='|cat:$slot_details.date|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}
<div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
<div id="dialog-confirm-contract" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>   
<div id="copy_multiple_save" ></div>
<div class="slot_alocation_main">
    <div class="alocation_details">
        <div class="option_head clearfix">
            <span style="float:left;">
                {if $slot_details.customer neq ''}{$slot_details.cust_name}{/if}
                {if $slot_details.employee neq '' and $slot_details.customer neq ''} - {/if}
                {if $slot_details.employee neq ''}{$slot_details.emp_name}{/if}
            </span>
            <span style="float:right;">{$translate.$day_name|cat:'  '}{$slot_details.date}</span>
        </div>
        <div class="single_allocation">
          <div id="slot_manage" style="height:128px;" class="{if $slot_details.status eq 1 and $slot_details.created_status eq 1}detail_inner_cng_accept{elseif $slot_details.type eq 10 and  $slot_details.status eq 1}detail_inner_PM{elseif $slot_details.status eq 1}detail_inner{elseif $slot_details.status eq 0}detail_inner_pending{elseif $slot_details.status eq 2}detail_inner_leave{elseif $slot_details.status eq 4}detail_inner_candg{else}detail_inner_pending{/if}">
                <div class="detail_inner_left">
                    <ul>
                        <li class="bold_li">
                            <a class="duration" href="javascript:void(0);" {if $slot_details.type == 10 &&  $slot_details.status == 1}style="background: url('{$url_path}images/per_meeting_edit_button.jpg') repeat-x scroll 0 0 #ded7f3;"{/if}{if $privilages['change_time'] == 0 || !$tl_flag}style="cursor: default;"{/if} {if $privilages['change_time'] == 1 && $tl_flag && $slot_details.status != 4}onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type={$slot_details.type}&action=edit_duration')" title="{$translate.boka_pass_edit_duration}"{/if}>{$slot_details.slot} ({$slot_details.slot_hour})</a>
                            
                            <div style="float: right">
                                <span class="duration_btn">
                                    {if $slot_details.status == 3}
                                        <a href="javascript:void(0);" {if ($emp_role == 1 || $emp_role == 6) && $slot_details.signed_in eq 0}onclick="loadAjax('{$url_val}&id={$slot_details.id}&type=2&action=direct')"{/if}><div class="sprite_alloc_popup_icons" style="background-position: 0 -363px; width: 15px; height: 15px;"></div></a>
                                    {else}
                                        {if $emp_role == 1 || $emp_role == 6}<a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$slot_details.id}&type=3&action=direct')"><div class="sprite_alloc_popup_icons" style="background-position: 0 -342px; width: 15px; height: 15px;"></div></a>{/if}
                                    {/if}
                                </span>

                                {if $slot_details.customer}
                                    {if $slot_details.status != 2 && $slot_details.signed_in == 0}
                                       <div class="fkkn_btn" style="float:right; padding-left:13px; width:35px;">
                                           <div class="fk_kn_selected">
                                                <ul class="fk_kn_dmenu" style="float: none;">
                                                    <li classs="selected_fkkn">
                                                        {if $slot_details.fkkn eq 1}<a style="display:block;" class="fk_style border_fkkn">{$translate.fk}</a>
                                                        {else if $slot_details.fkkn eq 2}<a style="display:block;" class="border_fkkn">{$translate.kn}</a>
                                                        {else if $slot_details.fkkn eq 3}<a style="display:block;" class="border_fkkn">{$translate.tu}</a>{/if}
                                                        <ul class="sub-menu">
                                                            {if $slot_details.fkkn neq 1}<li><a href="javascript:void(0);" {if $privileges_gd.fkkn eq 1 and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))}onclick="loadAjax('{$url_val}&id={$slot_details.id}&type=1&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="fk_style border_fkkn">{$translate.fk}</a>{/if}
                                                            {if $slot_details.fkkn neq 2}<li><a href="javascript:void(0);" {if $privileges_gd.fkkn eq 1 and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))}onclick="loadAjax('{$url_val}&id={$slot_details.id}&type=2&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.kn}</a></li>{/if}
                                                            {if $slot_details.fkkn neq 3}<li><a href="javascript:void(0);" {if $privileges_gd.fkkn eq 1 and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))}onclick="loadAjax('{$url_val}&id={$slot_details.id}&type=3&action=fkkn')"{else}onclick="messagePrivilege()"{/if} class="border_fkkn">{$translate.tu}</a></li>{/if}
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    {/if}
                                {/if}
                            </div>
                        </li>
                        </ul>
                            {if $slot_details.customer != ''}
                                {if $emp_role == 4 && $emp_alloc != $slot_details.customer} <span class="company_name clearfix">{$translate.works_on_another_customer}</span>{else}
                                <span class="company_name clearfix" style="margin-left:8px; width:190px; height:20px; margin-bottom:3px;">{$slot_details.cust_name}
                                    {if ($privileges_gd.remove_customer eq 1 and $slot_details.signed_in eq 0) and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))}
                                        <a href="javascript:void(0);" onclick="loadAjaxSlotConfirm('{$url_val|cat:'&id='|cat:$slot_details.id|cat:'&action=cust_remove'}',2)" class="remove" title="{$translate.boka_pass_customer_remove}"></a>
                                    {/if}
                                    {if $slot_details.status == 4 && $privilages['candg_approve'] == 1}
                                        <div id="leave_slot_approve" align="center" style="cursor: pointer;float: right" onclick="acceptCandGSlot();"><img width="20" border="0" src="{$url_path}images/icon_approve.png" alt="" title="{$translate.approve}"/></div>
                                     {/if}
                                </span>{/if}
                            {else}
                                <div class="company_name clearfix" style="margin-left:8px; width:190px; height:20px; margin-bottom:3px;">
                                    <span>
                                       {if $privileges_gd.add_customer eq 1} <select name="select_customer" id="select_customer" style="width:150px; height:20px;" >
                                            <option value="">{$translate.select}</option>
                                            {foreach $available_customers AS $customers}
                                                <option value="{$customers.username}">{if $sort_by_name == 1}{$customers.name}{elseif $sort_by_name == 2}{$customers.name_lf}{/if}</option>
                                            {/foreach}
                                        </select>{else}[ {$translate.no_customer} ]{/if}
                                    </span>    
                                </div>
                               <!-- <div class="company_name clearfix">
                                    <a href="javascript:void(0);" class="btn_add_company" {if $privileges_gd.add_customer == 1}onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&action=add_cust')" title="{$translate.boka_pass_customer_add}"{else}onclick="messagePrivilege()"{/if}>{$translate.add_company}</a>
                                </div>-->
                            {/if}
                        
                        
                            {if $slot_details.employee != ''}
                                <span class="worker_name clearfix" style="margin-left:8px; width:190px; height:20px; margin-bottom:3px;">{$slot_details.emp_name}
                                    {if  ($privileges_gd.remove_employee eq 1 and $slot_details.signed_in eq 0) and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))}
                                        <a href="javascript:void(0);" onclick="loadAjaxSlotConfirm('{$url_val|cat:'&id='|cat:$slot_details.id|cat:'&action=emp_remove'}',1)" class="remove" title="{$translate.boka_pass_employee_remove}"></a>
                                    {/if}
                                    {if $slot_details.status == 4  && $privilages['candg_approve'] == 1}
                                        <div id="leave_slot_reject_{$slot_det.id}" align="center" style="cursor: pointer;float: right" onclick="loadAjaxSlotConfirm('{$url_val}&id={$slot_details.id}&action=slot_remove',3);" ><img width="20" border="0" src="{$url_path}images/cirrus_icon_reject.png" alt="" title="{$translate.reject}" /></div>
                                     {/if}
                                </span>
                            {else}
                                <!--<div class="worker_name clearfix"><a href="javascript:void(0);" class="btn_add_worker" {if $privileges_gd.add_employee eq 1 and $emp_role eq 3}onclick="loadAdd('{$url_val}&id={$slot_details.id}&action=add_emp')" title="{$translate.boka_pass_employee_add}"{elseif $privileges_gd.add_employee == 1}onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&action=add_emp')"{else}onclick="messagePrivilege()"{/if}>{$translate.add_worker}</a></div>-->
                                <div class="worker_name clearfix" style="margin-left:8px; width:190px; height:20px;  margin-bottom:3px;">
                                    {if $privileges_gd.add_employee eq 1}<span>
                                        <select name="selct_employee" id="select_employee" style="width:150px; height:20px;">
                                            <option value="">{$translate.select}</option>
                                            {foreach $available_employees AS $employees}
                                                <option value="{$employees.username}">{if $sort_by_name == 1}{$employees.name_ff}{elseif $sort_by_name == 2}{$employees.name}{/if}</option>
                                            {/foreach}
                                        </select>{else}[ {$translate.no_employee} ]{/if}
                                        
                                    </span>
                                </div> 
                            {/if}
                        
                    
                        
                        
                        
                </div>
                {if $slot_details.status != 2}
                    <div class="detail_inner_right">
                        <div class="type_selector clearfix" style="top: 0">
                           {if $privileges_gd.slot_type eq 1 and $slot_details.status != 2 and $slot_details.status != 4 and $slot_details.signed_in eq 0 and (($emp_role eq 3 and $slot_details.employee eq $emp_alloc) or ($emp_role neq 3))} <span class="type_open" data-close-flag='close'><a href="#"></a></span>
                            <ul class="clearfix">
                                <li {if $slot_details.type eq 1}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=1&action=type');"{/if}><a title="{$translate.travel}" href="javascript:void(0);"  class="travel"></a></li>
                                <li {if $slot_details.type eq 0}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=0&action=type');"{/if}><a  title="{$translate.normal}" href="javascript:void(0);"  class="work"></a></li>
                                <li {if $slot_details.type eq 2}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=2&action=type');"{/if}><a title="{$translate.break}" href="javascript:void(0);"  class="lunch"></a></li>
                                <li {if $slot_details.type eq 3}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=3&action=type');"{/if}><a title="{$translate.oncall}" href="javascript:void(0);"  class="oncall"></a></li>
                                <li {if $slot_details.type eq 4}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=4&action=type');"{/if}><a title="{$translate.overtime}" href="javascript:void(0);"  class="overtime"></a></li>
                                <li {if $slot_details.type eq 5}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=5&action=type');"{/if}><a title="{$translate.qual_overtime}" href="javascript:void(0);"  class="qual_overtime"></a></li>
                                <li {if $slot_details.type eq 6}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=6&action=type');"{/if}><a title="{$translate.more_time}" href="javascript:void(0);"  class="more_time"></a></li>
                                <li {if $slot_details.type eq 14}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=14&action=type');"{/if}><a title="{$translate.more_oncall}" href="javascript:void(0);" class="more_oncall"></a></li>
                                <li {if $slot_details.type eq 7}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=7&action=type');"{/if}><a title="{$translate.some_other_time}" href="javascript:void(0);"  class="some_other_time"></a></li>
                                <li {if $slot_details.type eq 8}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=8&action=type');"{/if}><a title="{$translate.training_time}" href="javascript:void(0);"  class="training_time"></a></li>
                                <li {if $slot_details.type eq 9}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=9&action=type');"{/if}><a title="{$translate.call_training}" href="javascript:void(0);" class="call_training"></a></li>
                                <li {if $slot_details.type eq 10}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=10&action=type');"{/if}><a title="{$translate.personal_meeting}" href="javascript:void(0);" class="personal_meeting"></a></li>
                                <li {if $slot_details.type eq 11}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=11&action=type');"{/if}><a title="{$translate.voluntary}" href="javascript:void(0);" class="voluntary"></a></li>
                                <li {if $slot_details.type eq 12}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=12&action=type');"{/if}><a title="{$translate.complementary}" href="javascript:void(0);" class="complementary"></a></li>
                                <li {if $slot_details.type eq 13}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=13&action=type');"{/if}><a title="{$translate.complementary_oncall}" href="javascript:void(0);" class="complementary_oncall"></a></li>
                                <li {if $slot_details.type eq 15}class="selected"{else} onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&type=15&action=type');"{/if}><a title="{$translate.oncall_standby}" href="javascript:void(0);" class="oncall_standby"></a></li>
                            </ul>
                            {else}
                               <ul class="clearfix">
                                <li class="selected">
                                    {if $slot_details.type eq 1}<a title="{$translate.travel}" href="javascript:void(0);"  class="travel"></a>
                                    {elseif $slot_details.type eq 0}<a title="{$translate.normal}" href="javascript:void(0);"  class="work"></a>
                                    {elseif $slot_details.type eq 2}<a title="{$translate.break}" href="javascript:void(0);"  class="lunch"></a>
                                    {elseif $slot_details.type eq 3}<a title="{$translate.oncall}" href="javascript:void(0);"  class="oncall"></a>
                                    {elseif $slot_details.type eq 4}<a title="{$translate.overtime}" href="javascript:void(0);"  class="overtime"></a>
                                    {elseif $slot_details.type eq 5}<a title="{$translate.qual_overtime}" href="javascript:void(0);"  class="qual_overtime"></a>
                                    {elseif $slot_details.type eq 6}<a title="{$translate.more_time}" href="javascript:void(0);"  class="more_time"></a>
                                    {elseif $slot_details.type eq 14}<a title="{$translate.more_oncall}" href="javascript:void(0);"  class="more_oncall"></a>
                                    {elseif $slot_details.type eq 7}<a title="{$translate.some_other_time}" href="javascript:void(0);"  class="some_other_time"></a>
                                    {elseif $slot_details.type eq 8}<a title="{$translate.training_time}" href="javascript:void(0);"  class="training_time"></a>
                                    {elseif $slot_details.type eq 9}<a title="{$translate.call_training}" href="javascript:void(0);"  class="call_training"></a>
                                    {elseif $slot_details.type eq 10}<a title="{$translate.personal_meeting}" href="javascript:void(0);"  class="personal_meeting"></a>
                                    {elseif $slot_details.type eq 11}<a title="{$translate.voluntary}" href="javascript:void(0);"  class="voluntary"></a>
                                    {elseif $slot_details.type eq 12}<a title="{$translate.complementary}" href="javascript:void(0);"  class="complementary"></a>
                                    {elseif $slot_details.type eq 13}<a title="{$translate.complementary_oncall}" href="javascript:void(0);"  class="complementary_oncall"></a>
                                    {elseif $slot_details.type eq 15}<a title="{$translate.oncall_standby}" href="javascript:void(0);"  class="oncall_standby"></a>{/if}
                                </li>
                                
                            </ul> 
                            {/if}
                        </div>   
                    </div>
                {/if}
                <div><textarea style="width: 233px;height: 40px; margin-left:8px;" id="spam_comment_textarea_text" placeholder="{$translate.type_comment}">{$slot_details.comment}</textarea></div>
            </div>

            {if $privileges_gd.leave == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1 || $privileges_gd.swap == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1}
                <div class="detail_inner_btns">
                    {if $slot_details.employee && $privileges_gd.leave eq 1 && $tl_flag and ($slot_details.type neq 12 and $slot_details.type neq 13)}<a href="javascript:void(0);" onclick="slotAction('leave')" class="alocation_btn" title="{$translate.leave}">{$translate.leave}</a>{/if}
                    {if $privileges_gd.copy_single_slot eq 1 && $tl_flag}<a href="javascript:void(0);" onclick="loadAjaxSlot('{$url_val|cat:'&id='|cat:$slot_details.id|cat:'&action=copy'}')" class="alocation_btn" title="{$translate.boka_pass_slots_copy}">{$translate.copy}</a>{/if}
                    {if $slot_details.employee && $privileges_gd.swap == 1}<a href="javascript:void(0);" onclick="loadAjaxSlot('{$url_val|cat:'&id='|cat:$slot_details.id|cat:'&action=swap'}')"class="alocation_btn" title="{$translate.boka_pass_swap_slots_copy}">{$translate.swap_copy}</a>{/if}
                    {if $swap_button_hide != "1"}{if $slot_details.employee && $privileges_gd.swap == 1 && $swap_var != ''}<a href="javascript:void(0);" onclick="loadAjaxSlot('{$url_val|cat:'&id='|cat:$slot_details.id|cat:'&action=swap&swap=1'}')"class="alocation_btn" title="{$translate.boka_pass_swap_slot}">{$translate.swap}</a>{/if}{/if}
                    {if $privileges_gd.delete_slot == 1 && $tl_flag}<a href="javascript:void(0);" onclick="loadAjaxSlotConfirm('{$url_val}&id={$slot_details.id}&action=slot_remove',3)" class="alocation_btn" title="{$translate.boka_pass_slots_delete}">{$translate.delete}</a>{/if}
                    {if $privileges_gd.split_slot == 1 && $tl_flag}<a href="javascript:void(0);" onclick="popup_inner('{$url_val_popup}&id={$slot_details.id}&action=split')" class="alocation_btn" title="{$translate.boka_pass_slots_split}">{$translate.split}</a>{/if}
                    {if ($slot_details.employee or $slot_details.customer) and $privileges_gd.copy_single_slot_option eq 1&& $tl_flag}<a href="javascript:void(0);" onclick="slotAction('mult_copy')" title="{$translate.boka_pass_slots_copy_weekly}" class="alocation_btn mult_cop_btn">{$translate.copy_multiple}</a>{/if}
                </div>
            {/if}
            <div style="clear:both"></div>
        </div>
    </div>
    {if $slot_details.type neq 12 and $slot_details.type neq 13}
        <div id="slot_action_leave" style="display: none;">
            <fieldset><legend>{$translate.leave}</legend>
                <form name="leave_form" id="leave_form" method="post">
                    <input type="hidden" name="leave_employee" id="leave_employee" value="{$slot_details.employee}" />
                    <input type="hidden" name="slot_id" id="slot_id" value="{$slot_details.id}" />
                    <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                    <div class="leav">
                        <div class="leave_type">
                            <div class="type_list_dv">
                                <div id="leave_types">
                                    {foreach from=$leave_types key=leave_type_key item=leave_type}
                                        <input type="radio" id="leave_type{$leave_type_key}" name="leave_type" value="{$leave_type_key}" onclick="setLeaveType({$leave_type_key})" /><label for="leave_type{$leave_type_key}">{$leave_type}</label>
                                    {/foreach}
                                    <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                                </div>
                            </div>
                        </div>
                        <div id="karense_notify"></div>
                        <!--- need to copy from here -->
                        <div class="date_time">
                            <li id="date_time_time" class="date_tab selected" onclick="leaveTab('time')"><a href="javascript:void(0);">{$translate.time}</a></li>
                            <li id="date_time_date" class="date_tab" onclick="leaveTab('date')"><a href="javascript:void(0);">{$translate.date}</a></li>
                        </div>

                        <div class="time_dv" id="leave_time" >
                            <table>
                                <tr height="25">
                                    <td rowspan="2">{$translate.date}</td>
                                    <td rowspan="2"><input name="leave_date_day" id="leave_date_day" type="text" class="dte_fld" value="{$slot_details.date}" readonly="readonly" /></td>
                                    <td rowspan="2"><label for="leave_range">{$translate.time_range}</label></td>

                                </tr>
                                <tr height="25">
                                    <td><input type="text" name="leave_time_from" id="leave_time_from" value="{$time_from}" style="width: 80px; position:relative; top:-13px;left: 10px;"/></td>
                                    <td><input type="text" name="leave_time_to" id="leave_time_to"  value="{$time_to}"  style="width: 80px; position:relative; top:-13px;left: 10px;"/></td>
                                </tr>
                            </table>
                            <div id="leave_time_replacement_emps">
                                {if $user_role neq 3}
                                    <label><input type="checkbox" name="send_sms_time" id="send_sms_time" value="1"/> Send SMS</label>
                                {*if $avail_replace_employees|count gt 0*}
                                    <div id="time_replacer_nosms_tbl">
                                        <table>
                                            <tr>
                                                <td>{$translate.replacement_employee} </td>
                                                <td>
                                                    <select name="rep_employees" class="replace_employees_list" id="replace_employees_list_time">
                                                        <option value="">{$translate.none}</option>
                                                        {foreach $avail_replace_employees as $member}
                                                            <option value="{$member.username}">{if $sort_by_name == 1}{$member.name_ff}{elseif $sort_by_name == 2}{$member.name}{/if}</option>
                                                        {/foreach}
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id="time_replacer_sms_tbl" style="display: none;">
                                        <table width="100%" style="border: 1px solid #ccc; margin-top: 6px;">
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr><td><b>{$translate.replacement_employee}:</b></td></tr>
                                                        <tr>
                                                            <td>
                                                                <select name="rep_employees_sms" class="replace_employees_list_sms" multiple="multiple" style="width: 100%;">
                                                                    {foreach $avail_replace_employees as $member}
                                                                        <option value="{$member.username}">{if $sort_by_name == 1}{$member.name_ff}{elseif $sort_by_name == 2}{$member.name}{/if}</option>
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
                                {/if}     
                            </div>
                            {if $privileges_gd.no_pay_leave eq 1}
                                <div class="no_pay_sick_check_div" style="display: none;">
                                    <label><input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" checked="checked" /><span style="padding-left: 4px; color: red; font-weight: bold">{$translate.karense}</span></label>
                                </div>
                            {/if}
                        </div>

                        <div class="date_dv" id="leave_date"style="display:none;">
                            <table style="margin-top: 16px;">
                                <tr>
                                    <td>{$translate.date}</td>
                                    <td><input name="leave_date_from" id="leave_date_from" type="text" class="dte_fld" value="{$slot_details.date}" readonly="readonly" /></td>
                                    <td>{$translate.to}</td>
                                    <td><input name="leave_date_to" id="leave_date_to" type="text" class="dte_fld" value="{$slot_details.date}" readonly="readonly" /></td>
                                </tr>
                            </table>
                            <div id="leave_date_replacement_emps" style="margin-top: 9px;">
                                {if $user_role neq 3}
                                {*if $avail_replace_employees_date|count gt 0*}
                                    <label><input type="checkbox" name="send_sms_date" id="send_sms_date" value="1"/> Send SMS</label>
                                    <div id="date_replacer_nosms_tbl">
                                        <table style="margin-top: 10px;">
                                            <tr  height="25">
                                                <td>{$translate.replacement_employee} </td>
                                                <td> 
                                                    <select name="rep_date_employees" class="replace_employees_list_date" id="replace_employees_list_date">
                                                        <option value="">{$translate.none}</option>
                                                        {foreach $avail_replace_employees_date as $member}
                                                            <option value="{$member.username}">{if $sort_by_name == 1}{$member.name_ff}{elseif $sort_by_name == 2}{$member.name}{/if}</option>
                                                        {/foreach}
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                        <div id="date_replacer_sms_tbl" style="display: none;">
                                            <table width="100%" style="border: 1px solid #ccc; margin-top: 6px;">
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr><td><b>{$translate.replacement_employee}:</b></td></tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="rep_employees_sms" class="replace_employees_list_date_sms" multiple="multiple" style="width: 100%;">
                                                                        {foreach $avail_replace_employees as $member}
                                                                            <option value="{$member.username}">{if $sort_by_name == 1}{$member.name_ff}{elseif $sort_by_name == 2}{$member.name}{/if}</option>
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
                                                                    <span class="confirmation_slot"> {$translate.confirmatoin} <span class="confirmation_slot_radio"><input name="chk_confirmation_date" type="checkbox" value="" onclick="manageConf('date')"/></span></span>
                                                                    <span class="confirmation_slot"> {$translate.send_rejection} <span class="confirmation_slot_radio"><input name="chk_rejection_date" type="checkbox" value="0" /></span></span>
                                                                    <span class="confirmation_slot"> {$translate.confirmation_to_sender}<span class="confirmation_slot_radio"><input name="chk_sender_date" type="checkbox" value="0" /></span></span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                {/if}
                            </div>
                            {if $privileges_gd.no_pay_leave eq 1}
                                <div class="no_pay_sick_check_div" style="display: none;">
                                    <label><input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" checked="checked" /><span style="padding-left: 4px; color: red;">{$translate.karense}</span></label>
                                </div>
                            {/if}
                        </div>

                        <div class="date_dv">
                            <table>
                                <tr>
                                    <td>{$translate.comments}</td>
                                    <td><input name="leave_comments" id="leave_comments" type="text" class="dte_cmmnts" style="width:368px"/></td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear:both; text-align:center; margin-top: 10px;float: right;" >
                            <a style="margin-right: 10px;"href="javascript:void(0);" onclick="saveLeave('{$url_path}')" class="alocation_lvbtn">{$translate.save_leave}</a>
                            <a  style="height: 23px;padding-top: 13px;"href="javascript:void(0);" onclick="$('#timetable_slot_assign').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
                        </div>

                        <div style="clear:both; text-align: right;padding: 5px;"></div>
                    </div>
                </form>
            </fieldset>
        </div>
    {/if}
    <div id="slot_manage_copy_multiple" style="display: none;">
        <fieldset><legend>{$translate.copy_multiple}</legend>
            <form name="frm_copy" id="frm_copy" method="post">
                <div class="title_strip">
                    {$translate.copy_options}
                </div>
                <div>
                    <p>
                        {if $slot_details.employee != ''}  
                            <label>
                                <input type="radio" name="withuser" value="radio" id="withuser"  {if $slot_details.employee != ''}checked="checked"{/if}/>
                                {$translate.with_user}</label>
                            {/if}  
                            {if $slot_details.customer != ''}
                            <label>
                                <input type="radio" name="withuser" value="radio" id="withoutuser" {if $slot_details.employee == ''}checked="checked"{/if}/>
                                {$translate.without_user}</label>
                            {/if}
                    </p>
                </div>
                <div id="radio">
                    <input type="checkbox"  name="days" value="1" checked="checked"/><label for="radio">M</label>
                    <input type="checkbox"  name="days" value="2" checked="checked"/><label for="radio">T</label>
                    <input type="checkbox"  name="days" value="3" checked="checked"/><label for="radio">W</label>
                    <input type="checkbox"  name="days" value="4" checked="checked"/><label for="radio">T</label>
                    <input type="checkbox"  name="days" value="5" checked="checked"/><label for="radio">F</label>
                    <input type="checkbox"  name="days" value="6" checked="checked"/><label for="radio">S</label>
                    <input type="checkbox"  name="days" value="0" checked="checked"/><label for="radio">S</label>
                </div>
                <div class="from_to_week">
                    <div>
                        {$translate.copy_from}
                        <select class="frm_wk_selct" id="from_wk" onchange="getAfterDates()">
                            {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>
                            {/section}
                        </select>
                        <select name="from_option" id="from_option" onchange="getAfterDates()">
                            <option value="0">{$translate.every_week}</option>
                            <option value="1">{$translate.every_2}</option>
                            <option value="2">{$translate.every_3}</option>
                            <option value="3">{$translate.every_4}</option>
                        </select>
                        {$translate.copy_upto}
                        <select name="to_wk" id="to_wk"></select>
                    </div>
                </div>
            </form>
            <div style="clear:both; text-align:center; margin-top: 10px; float: right;">
                <a style="margin-right: 10px;width: 63px;padding: 3px 0px 0px 0px;height: 20px" href="javascript:void(0);" onclick="save_copy()" class="alocation_lvbtn">{$translate.copy}</a>
                <a style="width: 63px;padding: 3px 0px 0px 0px;height: 20px"href="javascript:void(0);" onclick="$('#timetable_slot_assign').dialog('close');" class="alocation_lvbtn">{$translate.cancel}</a>
            </div>
        </fieldset>
    </div>
</div>
<div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
    <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;cursor: pointer" onclick="$('#timetable_slot_assign').dialog('close');" href="javascript:void(0)" href="javascript:void(0)">{$translate.cancel}</a>
    <a class="alocation_btn" style="float:right; display:block; margin:8px 3px 0px 0px;cursor: pointer"{if $slot_details.customer != '' && $slot_details.employee == ''}onclick="saveEmployee('{$url_val}&id={$slot_details.id}&action=add_emp_save');"{elseif $slot_details.customer == '' && $slot_details.employee != ''}onclick="saveCustomer('{$url_val}&id={$slot_details.id}&action=add_cust_save');"{else}onclick="editComment();"{/if}>{$translate.save}</a>
</div>                         
{/block}