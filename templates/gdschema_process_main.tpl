{block name='script'}
<script type="text/javascript">

$(document).ready(function() {
    // tabpanl scripts
    getAfterDates('{$no_of_weeks}');
    $('#div_unmanned_del').hide();
    
    
    //.selected #del_list #copy_list input:checkbox
    $('#del_list').delegate('.emp_check1', 'change', function () {
            check_is_employee_checked();
    });
    
    var tptbs = $('.tabs_holder li');
    //jQuery('.tabs_holder li:first-child').addClass('selected');
    //jQuery('.pannel_holder div.pannel:first-child').addClass('selected');
    //jQuery('.pannel_holder div.pannel:first-child').fadeIn();
    $(tptbs).click(function() {
        $('#main_process_save').html('&nbsp;');
        $(this).parent().children('li').removeClass('selected');
        $(this).addClass('selected');
        var txt = "";

        if ($(this).html() == "{$translate.copy}") {
            txt = '{$translate.copy_slots}';
            if ({$in_user_role} == 4)
                txt += '<span style="float:right; margin-right:10px">{$translate.customer}: {$in_user_details.last_name}' + ' {$in_user_details.first_name}' + '</span>';
        }
        else if ($(this).html() == "{$translate.delete}") {

            txt = '{$translate.delete_slots}';
            if ({$in_user_role} == 4)
                txt += '<span style="float:right; margin-right:10px">{$translate.customer}: {$in_user_details.last_name}' + ' {$in_user_details.first_name}' + '</span>';
            getProcessEmployees('del_list');
        }
        else if ($(this).html() == "{$translate.replace}") {
            txt = '{$translate.replace_user}';
            if ({$in_user_role} == 4)
                txt += '<span style="float:right; margin-right:10px">{$translate.customer}: {$in_user_details.last_name}' + ' {$in_user_details.first_name}' + '</span>';
            getProcessEmployees('rep_list');
        }
        else if ($(this).html() == "{$translate.leave}") {
            txt = '{$translate.make_leave}';
            if ({$in_user_role} == 4)
                txt += '<span style="float:right; margin-right:10px">{$translate.customer}: {$in_user_details.last_name}' + ' {$in_user_details.first_name}' + '</span>';
        }
        else if ($(this).html() == "{$translate.atl}") {
            txt = '{$translate.atl_check}';
            if ({$in_user_role} == 4)
                txt += '<span style="float:right; margin-right:10px">{$translate.customer}: {$in_user_details.last_name}' + ' {$in_user_details.first_name}' + '</span>';
            getProcessEmployeesAtl('atl_list');
        }
        $('#process_title').html(txt);

        $(this).parent().parent().parent().find('.pannel_holder').children('div.pannel').removeClass('selected');
        var tbIx = $(this).parent().children('li').index(this);
        var tppnls = $(this).parent().parent().parent().find('.pannel_holder').children('div.pannel');
        $(tppnls).css('display', 'none');
        $(tppnls).eq(tbIx).fadeIn();
        $(tppnls).eq(tbIx).addClass('selected');
    });
    
    $("#replace_date_from, #replace_date_to").datepicker({
        showOn: "button",
        dateFormat: "yy-mm-dd",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true,
        defaultDate: '{$week_start_date}',
        onClose: function(){
                    getProcessEmployees1('rep_list');
                }
    });

    $("#leave_types").buttonset();
    //    $("#slider-range").slider({
    //        min: 0,
    //        max: 2400,
    //        step: 5,
    //        range: true,
    //        values: [ 00, 450 ],
    //        slide: function( event, ui ) {
    //            $("#leave_range").val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
    //    }
    //    });
    //    $("#leave_range").val( $("#slider-range" ).slider( "values", 0 ) +" - " + $( "#slider-range" ).slider( "values", 1 ) );

    $("#leave_date_from, #leave_date_to, #leave_date_day").datepicker({
        showOn: "button",
        dateFormat: "yy-mm-dd",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
    
    /*$('#replace_date_from, #replace_date_to').change(function(){
        loadEmployee();
    });*/
    $('#repl_infocus').change(function(){
        loadEmployee();
    })
    
    //$('.rep_radio').unbind('change');
    $('#rep_list').delegate('.rep_radio', 'change', function(){
        if($('#replace_date_from').val() == '' || $('#replace_date_to').val() == ''){
            alert('{$translate.select_dates_before_employee}');
        }
    });
    
    //    $('#loading').hide();
});

function check_is_employee_checked(){
    var values = $('.selected #del_list #copy_list input:checkbox:checked.emp_check1').map(function () {
                    return this.value;
    }).get();
    if($.isEmptyObject(values))
        $('#outfocus').parent().find('label').html('{$translate.unmanned_process_delete}');
    else
        $('#outfocus').parent().find('label').html('{$translate.schedule}');
}
function leaveTab(tab) {

    $('#leave_date').hide();
    $('#leave_time').hide();
    if (tab == 'time') {
        $('#date_time_date').removeClass("selected");
        $("#date_time_time").addClass("selected");
        $('#leave_type_day').val(2);
        $('#leave_time').show();
    } else {
        $('#date_time_time').removeClass("selected");
        $("#date_time_date").addClass("selected");
        $('#leave_type_day').val(1);
        $('#leave_date').show();
    }
}

function NewDate(str){
        str=str.split('-');
        var date=new Date();
        date.setUTCFullYear(str[0], str[1]-1, str[2]);
        date.setUTCHours(0, 0, 0, 0);
        return date;
}

function saveLeave(base_url) {
    //    $('#loading').show();
    //    $('#loading #load_anime').html('<img src="{$url_path}images/ajax-loader.gif" />');
    var employee = $('#leave_employee').val();
    if (employee != '') {

        var leave_type = $('#leave_type_val').val();
        if (leave_type != '') {
            var leave_date_from = $('#leave_date_from').val();
            var leave_date_to = $('#leave_date_to').val();
            var leave_type_day = $('#leave_type_day').val();
            var slot_id = $('#slot_id').val();
            var leave_comments = $('#leave_comments').val();
            if (leave_type_day == '1') {
                if (leave_date_from != '' && leave_date_to != '') {
                    {*var date1 = NewDate(leave_date_from).toGMTString();
                    var date2 = NewDate(leave_date_to).toGMTString();*}
                    var date1 = NewDate(leave_date_from);
                    var date2 = NewDate(leave_date_to);
                    if (date1 <= date2) {

                        var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&date_from=' + leave_date_from + '&date_to=' + leave_date_to + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&comments=' + leave_comments + "&cur_week={$cur_week}" + "&act=process";
                        var a = base_url + 'gdschema_process_main.php?type={$type}&cur_week={$cur_year_week}&user={$in_user}';

                        wrapLoader("div.selected");
                        $('#main_process_save').load(url, function(response, status, xhr) {
                            uwrapLoader("div.selected");
                            $('#chk_status').val('1');
                        });
                        //loadContent(a);

                    } else {

                        alert('{$translate.check_the_from_and_to_date}');
                        //                            $('#loading').hide();
                    }
                } else {

                    alert('{$translate.please_select_one_date}');
                    //                    $('#loading').hide();
                }
            } else if (leave_type_day == '2') {

                var leave_date_day = $('#leave_date_day').val();
                var leave_time_from_main = $('#leave_time_from_main').val();
                var leave_time_to_main = $('#leave_time_to_main').val();
                //var leave_range = $('#leave_range').val().split(' - ');
                if (leave_date_day != '') {


                    var url = base_url + 'save_leave.php?slot_id=' + slot_id + '&employee=' + employee + '&leave_date=' + leave_date_day + '&leave_range_from=' + leave_time_from_main + '&leave_range_to=' + leave_time_to_main + '&leave_type=' + leave_type + '&leave_day=' + leave_type_day + '&comments=' + leave_comments + "&cur_week={$cur_week}" + "&act=process";
                    var a = base_url + 'gdschema_process_main.php?type=leave&cur_week={$cur_year_week}&user={$in_user}';

                    wrapLoader("div.selected");
                    $('#main_process_save').load(url, function(response, status, xhr) {
                        uwrapLoader("div.selected");
                        $('#chk_status').val('1');
                    });

                    //loadContent(a);

                } else {

                    alert('{$translate.please_select_one_date}');
                    //                    $('#loading').hide();
                }
            }
        } else {

            alert('{$translate.please_select_a_leave_type}');
            //            $('#loading').hide();
        }
    } else {

        alert('{$translate.select_employee}');
        //        $('#loading').hide();
    }
}
function setLeaveType(val) {
    $('#leave_type_val').val(val);
}
function display_unmammed(val) {
    if ({$in_user_role} == 4) {
        if (val == 1) {
            $('#div_chk_unmanned').show();
            $('#copy_list').show();
        } else {
            $('#copy_list').hide();
            $('#div_chk_unmanned').hide();
        }
    }
}
function getAfterDates(max_week_number) {
    var year_week = '{$cur_year_week}';
    var year = parseInt(year_week.substring(0, 4), 10);
    var to_week = parseInt($("#from_wk").val()) + parseInt($("#no_of_wks").val());
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
    wrapLoader("#copy_list");

    $('#copy_list').load('{$url_path}ajax_process_employees.php?from_week=' + $('#from_wk').val() + '&no_of_weeks=' + $('#no_of_wks').val() + '&cur_week={$cur_year_week}&user={$in_user_details.username}', function(response, status, xhr) {
        uwrapLoader("#copy_list");
    });


}

function  getProcessEmployeesAtl(div_id) {
    wrapLoader("#" + div_id);
    $('#' + div_id).load('{$url_path}ajax_process_employees.php?year_month=' + $('#year_month').val() + '&user={$in_user_details.username}&type=' + div_id, function(response, status, xhr) {
        uwrapLoader("#" + div_id);
    });
}
function  getProcessEmployees(div_id) {
    wrapLoader("#" + div_id);
    $('#' + div_id).load('{$url_path}ajax_process_employees.php?from_week=' + $('#from_wk_del').val() + '&no_of_weeks=' + $('#no_of_wks_del').val() + '&cur_week={$cur_year_week}&user={$in_user_details.username}&type=' + div_id, function(response, status, xhr) {
        uwrapLoader("#" + div_id);
        check_is_employee_checked();
    });
}
function  getProcessEmployees1(div_id) {

    if ($('#replace_date_from').val() != '' && $('#replace_date_to').val() != '') {
        wrapLoader("#" + div_id);
        $('#' + div_id).load('{$url_path}ajax_process_employees.php?start_date=' + $('#replace_date_from').val() + '&end_date=' + $('#replace_date_to').val() + '&user={$in_user_details.username}&type=rep', function(response, status, xhr) {
            uwrapLoader("#" + div_id);
            $('#rep_list_emp').html('');
        });
    }
}
function empCheckAll() {
    //alert('hi');
    if (document.frm_copy.all_check.checked) {
        $('input:checkbox.emp_check').each(function() {
            $(this).attr('checked', true);
        });
    } else {
        $('input:checkbox.emp_check').each(function() {
            $(this).attr('checked', false);
        });
    }
}
function empCheckAll1() {
    if (document.frm_delete.all_check1.checked) {
        $('input:checkbox.emp_check1').each(function() {
            $(this).attr('checked', true);
        });
    } else {
        $('input:checkbox.emp_check1').each(function() {
            $(this).attr('checked', false);
        });
    }
    check_is_employee_checked();
}
function empCheckAll2() {

    if (document.frm_atl.all_check2.checked) {
        $('input:checkbox.emp_check2').each(function() {
            $(this).attr('checked', true);
        });
    } else {
        $('input:checkbox.emp_check2').each(function() {
            $(this).attr('checked', false);
        });
    }
}
        
function save_copy() {
    //    $('#loading').show();
    //    $('#loading #load_anime').html('<img src="{$url_path}images/ajax-loader.gif" />');
    var days = "";
    var with_user = 1;
    var unmanned = 0;
    if ($('#unmanned').attr("checked") == "checked")
        unmanned = 1;
    for (var i = 0; i < document.frm_copy.days.length; i++) {
        if (document.frm_copy.days[i].checked)
            days += document.frm_copy.days[i].value + '-';
    }
    if (days == '') {
        alert('{$translate.select_days}');
        //        $('#loading').hide();
    } else {
        var emp = "";
        var values = $('input:checkbox:checked.emp_check').map(function() {
            return this.value;
        }).get();

        for (var i = 0; i < values.length; i++) {
            emp += values[i] + "-";
        }
        if (emp == '' && unmanned == 0) {
            alert('{$translate.select_employee}');
        } else {
            if ($('#withoutuser').attr("checked") == "checked")
                with_user = 0;
            var additional_urldata = 'from_week=' + $('#from_wk').val() + '&no_of_weeks=' + $('#no_of_wks').val() + '&to_week=' + $('#to_wk').val() + '&no_of_times=' + $('#no_of_times').val() + '&employees=' + emp + '&days=' + days + '&type=copy&cur_week={$cur_year_week}&user={$in_user}&with_user=' + with_user + '&unmanned=' + unmanned;
            if (with_user == 1) {
                var atl_req_data = additional_urldata + '&type_check=12';
                var process_url = '{$url_path}ajax_process_main.php?' + additional_urldata;
                check_atl_warning(atl_req_data, function(this_url){
                                    wrapLoader("div.selected");
                                    $('#main_process_save').load(this_url, function(response, status, xhr) {
                                        uwrapLoader("div.selected");
                                        $('#chk_status').val('1');
                                    });
                                }, process_url, '.pannel_holder div.selected');
            } else {
                wrapLoader("div.selected");
                $('#main_process_save').load('{$url_path}ajax_process_main.php?' + additional_urldata, function(response, status, xhr) {
                    uwrapLoader("div.selected");
                    $('#chk_status').val('1');
                });
            }

        }
    }

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
        
function save_replace() {

    var in_focus = 0;
    if ($('#replace_date_from').val() != '' && $('#replace_date_to').val() != '') {

        var values = $('input:radio:checked.rep_radio').map(function() {
            return this.value;
        }).get();


        var emp = '';
        if (values.length)
            emp = values[0];

        if (emp == '') {
            alert('{$translate.select_employee}');
            //            $('#loading').hide();
        } else {
            var emp_rep = "";
            var values = $('input:radio:checked.rep_radio_rep').map(function() {
                return this.value;
            }).get();

            if (values.length)
                emp_rep = values[0];


            if (emp_rep == '') {
                alert('{$translate.select_replace_employee}');
                //                $('#loading').hide();
            } else {
                if ($('#repl_infocus').attr("checked") == "checked")
                    in_focus = 1;

                wrapLoader("div.selected");
                $('#main_process_save').load('{$url_path}ajax_process_main.php?from_date=' + $('#replace_date_from').val() + '&to_date=' + $('#replace_date_to').val() + '&employee=' + emp + '&employee_rep=' + emp_rep + '&type=replace&cur_week={$cur_week}&user={$in_user}&focus=' + in_focus, function(response, status, xhr) {
                    uwrapLoader("div.selected");
                    $('#chk_status').val('1');
                });
                //$('#loading').hide();
            }
        }

    }
    else {
        alert('{$translate.please_select_one_date}');
        //        $('#loading').hide();
    }
}
function save_delete() {
    var days = "";
    var in_focus = 1;
    unmanned = 0;
    if ($('#unmanned_del').attr("checked") == "checked")
        unmanned = 1;
    for (var i = 0; i < document.frm_delete.days.length; i++) {
        if (document.frm_delete.days[i].checked)
            days += document.frm_delete.days[i].value + '-';
    }
    if (days == '') {
        alert('{$translate.select_days}');
        //            $('#loading').hide();
    } else {
        var emp = "";
        var values = $('input:checkbox:checked.emp_check1').map(function() {
            return this.value;
        }).get();

        for (var i = 0; i < values.length; i++) {
            emp += values[i] + "-";
        }

        if (emp == '' && ($('#infocus').attr("checked") == "checked" || ($('#outfocus').attr("checked") == "checked" && {$in_user_role} != 4))) {
            alert('{$translate.select_employee}');
            //                $('#loading').hide();
        } else {
            if ($('#outfocus').attr("checked") == "checked")
                in_focus = 0;

            wrapLoader("div.selected");
            $('#main_process_save').load('{$url_path}ajax_process_main.php?from_week=' + $('#from_wk_del').val() + '&no_of_weeks=' + $('#no_of_wks_del').val() + '&employees=' + emp + '&days=' + days + '&type=delet&cur_week={$cur_year_week}&user={$in_user}&focus=' + in_focus + '&unmanned=' + unmanned, function(response, status, xhr) {
                uwrapLoader("div.selected");
                $('#chk_status').val('1');
            });
            //$('#loading').hide();
        }
    }
}

function save_atl() {
    var emp = "";
    var values = $('input:checkbox:checked.emp_check2').map(function() {
        return this.value;
    }).get();

    for (var i = 0; i < values.length; i++) {
        emp += values[i] + "-";
    }

    if (emp == '' && ($('#infocus').attr("checked") == "checked" || ($('#outfocus').attr("checked") == "checked" && {$in_user_role} != 4))) {
        alert('{$translate.select_employee}');
    }else{

        var months=new Array(); 
        months[0] = '{$translate.month_1}';
        months[1] = '{$translate.month_2}';
        months[2] = '{$translate.month_3}';
        months[3] = '{$translate.month_4}';
        months[4] = '{$translate.month_5}';
        months[5] = '{$translate.month_6}';
        months[6] = '{$translate.month_7}';
        months[7] = '{$translate.month_8}';
        months[8] = '{$translate.month_9}';
        months[9] = '{$translate.month_10}';
        months[10] = '{$translate.month_11}';
        months[11] = '{$translate.month_12}';


        var month_num = parseInt(($('#year_month').val()).substring(5));

        txt = '{$translate.atl_check}' + '<span style="padding-left:10px;">' + ($('#year_month').val()).substring(0,4) + "-" + months[month_num-1] + '</span>';
        $('#process_title').html(txt);
        wrapLoader("div.selected");
        $('#inner_tab_contnt').hide();
        $('#atl_result').show();
        $('#atl_result').load('{$url_path}ajax_process_main.php?year_month=' + $('#year_month').val() + '&employees=' + emp + '&type=atl&user={$in_user}', function(response, status, xhr) {
            uwrapLoader("div.selected");
            //$('#chk_status').val('1');
        });
        $('#atl_buttons').show();
        {*var div=document.createElement("div");
        div.innerHtml = "<input type='button' value ='test'>";
        var parent_div=document.getElementById('pannel_holder');
        parent_div.appendChild(div);*}
    }
}
        
function loadAtlDefault(){
    $('#atl_result').hide();
    $('#atl_buttons').hide();
    $('#inner_tab_contnt').show();            
}    
function loadContent(url) {
    wrapLoader("#timetable_process_main");
    $('#timetable_process_main').load(url, function(response, status, xhr) {
        uwrapLoader("#timetable_process_main");
    });
}

function copy_employee_search() {
    //    $('#copy_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    wrapLoader("#copy_list");
    $("#copy_list").load("{$url_path}ajax_employee_list.php?searchkey=" + $('#copy_search').val(), function(response, status, xhr) {
        uwrapLoader("#copy_list");
    });
}
function del_employee_search() {
    //    $('#del_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    wrapLoader("#del_list");
    $("#del_list").load("{$url_path}ajax_employee_list.php?searchkey=" + $('#del_search').val(), function(response, status, xhr) {
        uwrapLoader("#del_list");
    });
}
function loadEmployee() {

    if($('.tabs_holder').find('.selected').attr('data-tab') == 'replace'){
    
        var dfrom = $('#replace_date_from').val();
        var dto = $('#replace_date_to').val();
        
        var values = $('input:radio:checked.rep_radio').map(function() {
            return this.value;
        }).get();
        var emp = values[0];
        
        var customer_checked = $('input:checkbox[name=repl_infocus]:checked').val();
        var is_customer_checked = 0;
        if (customer_checked) is_customer_checked = 1;
        
        if(dfrom != '' && dto != '' && emp != '' && typeof emp != 'undefined'){
            wrapLoader("#rep_list_emp");
            $('#rep_list_emp').load('{$url_path}ajax_process_main.php?start_date=' + dfrom + '&end_date=' + dto + '&selected_emp=' + emp + '&sel_customer={$in_user}&is_customer_checked='+is_customer_checked+'&type=rep_emp_load', function(response, status, xhr) {
                uwrapLoader("#rep_list_emp");
            });
            
        }
    }
    else{
        var values = $('input:radio:checked.rep_radio').map(function() {
            return this.value;
        }).get();
        var emp = values[0];

        wrapLoader("#rep_list_emp");
        $('#rep_list_emp').load('{$url_path}ajax_process_main.php?employee={$in_user}&type=load', function(response, status, xhr) {
            uwrapLoader("#rep_list_emp");
        });
    }
}
function op_close() {
    $(this).dialog('destroy').remove();
    $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_process_main"]').remove();
    $('#timetable_process_main').remove();

    reload_popup_themes();
    if ($('#chk_status').val() == 1) {
        reload_content();
    }
    $('#chk_status').val('0');
}
</script>
{/block}

{block name='content'}
    {$message}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div id="main_process_save"></div>
    <div class="copy_main_dv">
        <div class="copy_main_title" id="process_title">
        {if $type == 'copy'}
            {$translate.copy_slots}
            {if $in_user_role == 4}<span style="float:right; margin-right:10px">{$translate.customer|cat:": "|cat:$in_user_details.last_name|cat:" "|cat:$in_user_details.first_name}</span>{/if}
        {elseif $type == 'delet'}
            {$translate.delete_slots}
        {elseif $type == 'Replce'}
            {$translate.replace_user}
        {elseif $type == 'leave'}
            {$translate.make_leave}
        {elseif $type == 'atl'}
            {$translate.atl_check}
        {/if}
    </div>
    <div class="copy_contnts">
        <div id="tabbed_pannel">
            <div class="tabs_holder">
                <ul>
                    <li {if $type == 'copy'}class="selected"{/if} data-tab='copy'>{$translate.copy}</li>
                    <li {if $type == 'delet'}class="selected"{/if} data-tab='delete'>{$translate.delete}</li>
                    <li {if $type == 'replace'}class="selected"{/if} data-tab='replace'>{$translate.replace}</li>
                    <li {if $type == 'leave'}class="selected"{/if} data-tab='leave'>{$translate.leave}</li>
                    <li {if $type == 'leave'}class="selected"{/if} data-tab='atl'>{$translate.atl}</li>
                </ul>
            </div>
            <div class="pannel_holder" id="pannel_holder">
                <div class="pannel {if $type == 'copy'}selected{/if}" {if $type != 'copy'}style="display:none;"{/if}>
                    <form name="frm_copy" method="post">
                        <div class="inner_tab_contnt">
                            <div class="inner_tab_left">
                                <div>


                                    <label>
                                        <input type="radio" name="withuser" value="radio" id="withuser"  checked="checked" onclick="display_unmammed(1)"/>
                                        {$translate.with_user}</label>


                                    <label>
                                        <input type="radio" name="withuser" value="radio" id="withoutuser" onclick="display_unmammed(0)"/>
                                        {$translate.without_user}</label>


                                    {if $in_user_role == 4}
                                        <div style="float:right" id="div_chk_unmanned">
                                            <label>
                                                <input type="checkbox" name="unmanned" value="1" id="unmanned"  checked="checked"/>
                                                {$translate.unmanned}</label>
                                        </div>
                                    {/if}
                                </div>
                                <div class="copy_frm">
                                    <div class="copy_frm_title">{$translate.copy_from}</div>
                                    <div class="copy_frm_dtls">
                                        <div class="frm_week">{$translate.from_week}
                                            <select class="frm_wk_selct" id="from_wk" onchange="getAfterDates({$no_of_weeks})">
                                                {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                                    <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>

                                                {/section}


                                            </select>
                                            {$translate.no_of_weeks}
                                            <select class="frm_wk_selct" id="no_of_wks" onchange="getAfterDates({$no_of_weeks})">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                
                                                
                                            </select>  
                                        </div>
                                        <div class="frm_week">

                                            <div id="radio">
                                                <input type="checkbox"  name="days" value="1" checked="checked"/><label for="radio">{$week_day_names[0]}</label>
                                                <input type="checkbox"  name="days" value="2" checked="checked"/><label for="radio">{$week_day_names[1]}</label>
                                                <input type="checkbox"  name="days" value="3" checked="checked"/><label for="radio">{$week_day_names[2]}</label>
                                                <input type="checkbox"  name="days" value="4" checked="checked"/><label for="radio">{$week_day_names[3]}</label>
                                                <input type="checkbox"  name="days" value="5" checked="checked"/><label for="radio">{$week_day_names[4]}</label>
                                                <input type="checkbox"  name="days" value="6" checked="checked"/><label for="radio">{$week_day_names[5]}</label>
                                                <input type="checkbox"  name="days" value="0" checked="checked"/><label for="radio">{$week_day_names[6]}</label>
                                                <!--input type="checkbox"  name="days" value="1" checked="checked"/><label for="radio">M</label>
                                                <input type="checkbox"  name="days" value="2" checked="checked"/><label for="radio">T</label>
                                                <input type="checkbox"  name="days" value="3" checked="checked"/><label for="radio">W</label>
                                                <input type="checkbox"  name="days" value="4" checked="checked"/><label for="radio">T</label>
                                                <input type="checkbox"  name="days" value="5" checked="checked"/><label for="radio">F</label>
                                                <input type="checkbox"  name="days" value="6" checked="checked"/><label for="radio">S</label>
                                                <input type="checkbox"  name="days" value="0" checked="checked"/><label for="radio">S</label-->

                                            </div>


                                        </div>

                                    </div> 
                                </div>
                                <div class="copy_frm">
                                    <div class="copy_frm_title">{$translate.no_of_weeks}</div>
                                    <div class="copy_frm_dtls">
                                        <div class="frm_week">{$translate.from_week}
                                            <select class="frm_wk_selct" id="to_wk" style="width:auto;">

                                            </select>

                                            {$translate.no_of_times}
                                            <select class="frm_wk_selct" id="no_of_times">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>  
                                        </div>


                                    </div>

                                </div> 
                            </div>
                            <div class="inner_tab_right">
                                <!--<div class="right_search"><input name="copy_search" type="text" id="copy_search" class="right_search_fld" onkeyup="copy_employee_search()" /></div> -->

                                <div id="copy_list">

                                </div>
                            </div>
                            <input name="btn_close_copy" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                            <input name="btn_copy" type="button" class="tabbed_btn" value="{$translate.copy}" onclick="save_copy()"/>                
                            <div style="clear:both"></div>
                        </div>
                    </form>            
                </div>
                <div class="pannel {if $type == 'delet'}selected{/if}" {if $type != 'delet'}style="display:none;"{/if}>
                    <form name="frm_delete" method="post">
                        <div class="inner_tab_contnt">
                            <div class="inner_tab_left">
                                <div class="copy_frm">
                                    <div class="copy_frm_title">{$translate.delete_slots}
                                        <div style="float:right;">



                                            <div style="float:left;">
                                                <input type="radio" name="infocus" value="radio" id="infocus"  checked="checked"/>
                                                <label>{$translate.employee_processmain_delete}</label>
                                            </div>
                                            
                                            <div style="padding-left:5px;float:left;">
                                                <input type="radio" name="infocus" value="radio" id="outfocus" />
                                                <label>{$translate.schedule}</label>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="copy_frm_title" id="div_unmanned_del">
                                        {if $in_user_role == 4}
                                            <div style="float:right" >
                                                <label>
                                                    <input type="checkbox" name="unmanned_del" value="1" id="unmanned_del"  checked="checked"/>
                                                    {$translate.unmanned}</label>
                                            </div>
                                        {/if}
                                    </div>                
                                    <div class="copy_frm_dtls">
                                        <div class="frm_week">{$translate.from_week}

                                            <select class="frm_wk_selct" id="from_wk_del"  onchange="getProcessEmployees('del_list')">
                                                {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                                    <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>

                                                {/section}


                                            </select>
                                            {$translate.no_of_weeks}
                                            <select class="frm_wk_selct" id="no_of_wks_del"  onchange="getProcessEmployees('del_list')">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="9">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>  
                                        </div>
                                        <div class="frm_week">

                                            <div id="radio">
                                                <input type="checkbox"  name="days" value="1" checked="checked"/><label for="radio">{$week_day_names[0]}</label>
                                                <input type="checkbox"  name="days" value="2" checked="checked"/><label for="radio">{$week_day_names[1]}</label>
                                                <input type="checkbox"  name="days" value="3" checked="checked"/><label for="radio">{$week_day_names[2]}</label>
                                                <input type="checkbox"  name="days" value="4" checked="checked"/><label for="radio">{$week_day_names[3]}</label>
                                                <input type="checkbox"  name="days" value="5" checked="checked"/><label for="radio">{$week_day_names[4]}</label>
                                                <input type="checkbox"  name="days" value="6" checked="checked"/><label for="radio">{$week_day_names[5]}</label>
                                                <input type="checkbox"  name="days" value="0" checked="checked"/><label for="radio">{$week_day_names[6]}</label>

                                            </div>


                                        </div>

                                    </div> 
                                </div>

                            </div>

                            <div class="inner_tab_right">
                                <!--<div class="right_search"><input name="del_search" type="text" id="del_search" class="right_search_fld" onkeyup="del_employee_search()" /></div> -->
                                <div  id="del_list">

                                </div>
                            </div>

                            <div style="clear:both"></div>
                            <input name="btn_delete_close" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                            <input name="btn_delete" type="button" class="tabbed_btn" value="{$translate.delete}" onclick="save_delete()"/>

                        </div>
                    </form>
                </div>
                <div class="pannel {if $type == 'replace'}selected{/if}" {if $type != 'replace'}style="display:none;"{/if}>
                    <form name="frm_rep" method="post">
                        <div class="copy_frm_title">
                            <div style="float:right;">

                                {if $in_user_role == 4}
                                    <div style="float:left;">
                                        <label>{$translate.customer}: </label>    
                                        <input type="checkbox" name="repl_infocus" value="radio" id="repl_infocus"  checked="checked"/>
                                        {$in_user_details.first_name} {$in_user_details.last_name}</label>
                                    </div>
                                {/if}    



                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="replace_right">
                                <div class="right_search"><input name="replace_date_from" id="replace_date_from" type="text" class="right_search_fld" /></div> 
                                <div  id="rep_list" style="float:left; height:138px; width:230px; overflow: scroll">

                                </div>
                            </div>
                            <div class="replace_right">
                                <div class="right_search"><input name="replace_date_to" type="text"id="replace_date_to" class="right_search_fld" value=""/></div> 
                                <div  id="rep_list_emp" style="float:left; height:138px; width:230px; overflow: scroll">

                                </div>
                            </div>
                            <input name="btn_rep_close" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                            <input name="btn_rep" type="button" class="tabbed_btn" value="{$translate.replace}" onclick="save_replace()"/>

                        </div>
                    </form>        
                </div>
                <div class="pannel {if $type == 'leave'}selected{/if}" {if $type != 'leave'}style="display:none;"{/if}>
                    <form name="leave_form" id="leave_form" method="post">
                        <input type="hidden" name="slot_id" id="slot_id" value="{$slot_details.id}" />
                        <input type="hidden" name="leave_type_day" id="leave_type_day" value="1" />
                        <div class="leav">

                            <select name="leave_employee" id="leave_employee">
                                <option value="">{$translate.select}</option>
                                {foreach $employee_details as $employee}
                                    <option value="{$employee.username}">{$employee.first_name|cat: ' '|cat: $employee.last_name}</option>
                                {/foreach}
                            </select>

                            <div class="leave_types" style="margin-top: 10px;">
                                <div id="leave_types" title="{$translate.select_leave}">
                                    {foreach from=$leave_types key=leave_type_key item=leave_type}
                                        <input type="radio" id="leave_type{$leave_type_key}" name="leave_type" value="{$leave_type_key}" onclick="setLeaveType({$leave_type_key})" title="{$translate.select_leave}"/><label for="leave_type{$leave_type_key}">{$leave_type}</label>
                                    {/foreach}
                                    <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                                </div>
                            </div>
                            <div class="date_time">
                                <li id="date_time_date" class="date_tab selected"><a href="javascript:void(0);" onclick="leaveTab('date')">{$translate.date}</a></li>
                                <li id="date_time_time" class="date_tab"><a href="javascript:void(0);" onclick="leaveTab('time')">{$translate.time}</a></li>
                            </div>
                            <div class="date_dv" id="leave_date">
                                <table>
                                    <tr>
                                        <td>{$translate.date}</td>
                                        <td><input name="leave_date_from" id="leave_date_from" type="text" class="dte_fld" value="{$slot_details.date}" /></td>
                                        <td>{$translate.to}</td>
                                        <td><input name="leave_date_to" id="leave_date_to" type="text" class="dte_fld" value="{$slot_details.date}" /></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="time_dv" id="leave_time" style="display:none;">
                                <table>
                                    <tr height="25">
                                        <td rowspan="2">{$translate.date}</td>
                                        <td rowspan="2"><input name="leave_date_day" id="leave_date_day" type="text" class="dte_fld" value="{$slot_details.date}" /></td>
                                        <td rowspan="2"><label for="leave_range">{$translate.time_range}</label></td>

                                    </tr>
                                    <tr height="25">
                                        <td><input type="text" name="leave_time_from_main" id="leave_time_from_main" value="{$time_from}" style="width: 80px; position:relative; top:-13px;left: 10px;"/></td>
                                        <td><input type="text" name="leave_time_to_main" id="leave_time_to_main"  value="{$time_to}"  style="width: 80px; position:relative; top:-13px;left: 10px;"/></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="date_dv">
                                <table>
                                    <tr>
                                        <td>{$translate.comments}</td>
                                        <td><input name="leave_comments" id="leave_comments" type="text" class="dte_cmmnts" /></td>
                                    </tr>
                                </table>
                            </div>
                            <div style="clear:both; text-align:center;">
                                <a href="javascript:void(0);" onclick="saveLeave('{$url_path}')" class="alocation_lvbtn">{$translate.save_leave}</a>
                                <a href="javascript:void(0);" onclick="op_close()" class="alocation_lvbtn">{$translate.close}</a>


                            </div>
                            <div style="clear:both; text-align: right;padding: 5px;"></div>
                        </div>
                    </form>
                </div>
                <div class="pannel {if $type == 'atl'}selected{/if}" {if $type != 'atl'}style="display:none;"{/if}>
                    <form name="frm_atl" method="post">
                        <div class="atl_result" id="atl_result" style="display:none;height:175px; width:473px; overflow-y: scroll;"></div>
                        <div id = "atl_buttons" style="display:none; height: 25px;">
                            <input name="btn_atl_close" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                            <input name="btn_atl_clear" type="button" class="tabbed_btn" value="{$translate.back}" onclick="loadAtlDefault()"/>
                        </div>
                        <div class="inner_tab_contnt" id="inner_tab_contnt">
                            <div class="inner_tab_left">
                                <div class="copy_frm">


                                    <div class="copy_frm_dtls">
                                        <div class="frm_week">{$translate.select_month}

                                            <select class="frm_month_select" id="year_month"  onchange="getProcessEmployeesAtl('atl_list')">
                                                {foreach from=$months item=month}  
                                                    <option value="{$month.month_value}">{$month.month_name}</option>
                                                {/foreach}
                                            </select>

                                        </div>


                                    </div> 
                                </div>

                            </div>

                            <div class="inner_tab_right">
                                <!--<div class="right_search"><input name="atl_search" type="text" id="atl_search" class="right_search_fld" onkeyup="del_employee_search()" /></div> -->
                                <div  id="atl_list">

                                </div>
                            </div>

                            <div style="clear:both"></div>
                            <input name="btn_atl_close" type="button" class="tabbed_btn" value="{$translate.close}" onclick="op_close()"/>
                            <input name="btn_atl" type="button" class="tabbed_btn" value="{$translate.atl_check}" onclick="save_atl()"/>

                        </div>
                    </form>
                </div>                
            </div>

            <div style="clear:both"></div>

        </div>
    </div>
</div>
{*</div>*}
{/block}