{block name='style'}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
        .scrol_down_image_pointer {
            background: url("{$url_path}images/downarrow_icon.png") no-repeat scroll 39px 29px !important;
        }
        .scrol_down_image_pointer_inconv {
            background: url("{$url_path}images/downarrow_icon.png") no-repeat !important;
            background-position: bottom right;
        }
        #holidayinc_main .child_holi td, #inconv_table .child_holi td{ background: none repeat scroll 0% 0% rgb(247, 244, 205); }
        /*#holidayinc_main .active_rows td{ background: none repeat scroll 0% 0% rgb(247, 244, 205); }*/
        #holidayinc_main .active_rows td.index-column{ border-left: 5px solid #9BE19B; }
        #holidayinc_main .active_rows td.action-column{ border-right: 5px solid #9BE19B; }
        td.salary_col{ padding: 5px !important;}
        table tbody tr td > .day-report{ height: auto !important;}
        .icon_disabled{ color: #ccc;}
    </style>
{/block}

{block name="script"}
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });

    $('.sort-tools .icon').click(function(e){
        e.stopPropagation();

        var sort_direction = null;
        if($(this).hasClass('icon-arrow-up')){
            sort_direction = 'up'
        }
        else if($(this).hasClass('icon-arrow-down')){
            sort_direction = 'down'
        }

        var current_position = $(this).parents('tbody.holiday_main').index('#inconv_table tbody.holiday_main');
        // console.log(sort_direction, current_position);
        if(sort_direction == 'up'){
            if(!isNaN(current_position) && current_position != 0){
                // $('#inconv_table tbody.holiday_main');

                var this_holiday_main = $(this).parents('tbody.holiday_main');
                var this_holiday_child = $(this).parents('tbody.holiday_main').next('.child_holi');
                this_holiday_main.prev().prev().before(this_holiday_main);
                this_holiday_child.prev().prev().before(this_holiday_child);
                renumbering_inconv_index_col();
            }
        }
        else if(sort_direction == 'down'){
            var total_rows = $('#inconv_table tbody.holiday_main').length;
            if(!isNaN(current_position) && current_position != total_rows - 1){
                // $('#inconv_table tbody.holiday_main');

                var this_holiday_main = $(this).parents('tbody.holiday_main');
                var this_holiday_child = $(this).parents('tbody.holiday_main').next('.child_holi');
                this_holiday_child.next().next().after(this_holiday_child);
                this_holiday_main.next().next().after(this_holiday_main);
                renumbering_inconv_index_col();
            }
        }
    });
        
    $("table#holidayinc_main .holiday_main td.have_child, table#inconv_table .holiday_main td.have_child").click(function() {
            $(this).parents('.holiday_main').next('.child_holi').find('tr.item_row').toggleClass('hide');
    });
    
    {*$(".btn-cancel-right").click(function() {
        close_right_panel();
    });
    
    $('.btn-addnew-holiday').click(function(){
        close_right_panel();
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right #holiday_form").removeClass('hide');
    });
    $('.btn-addnew-inconvtiming').click(function(){
        close_right_panel();
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right #inconvenient_form").removeClass('hide');
    });*}
});

function renumbering_inconv_index_col(){

    $('#inconv_table tbody.holiday_main .sort-tools .icon').removeClass('icon_disabled');
    var total_rows = $('#inconv_table tbody.holiday_main').length;
    $('#inconv_table tbody.holiday_main').each(function (i, el) {
        $(this).find('.row_index_val').html(i+1);
        if(i == 0)
            $(this).find('.sort-tools .icon-arrow-up').addClass('icon_disabled');
        if(i+1 == total_rows)
            $(this).find('.sort-tools .icon-arrow-down').addClass('icon_disabled');

    });
}

{*function close_right_panel(){
    $('#main_container').removeClass('show_main_right');
    $(".main-right, .main-right #holiday_form, .main-right #inconvenient_form").addClass('hide');
    $('.main-right #right_message_wraper, #left_message_wraper').html('');
}*}

function warning_delete(url){
    if(confirm("{$translate.do_you_want_to_delete_holiday}")){
        document.location = url;
        return true;
    }else
        return false;
}

function warning_delete_inconvenient(url){
    if(confirm("{$translate.want_delete}")){
        document.location = url;
        return true;
    }else
        return false;
}

function save_inconvenients_order(){
    bootbox.dialog( '{$translate.confirm_ordering_inconvenient_entries}', [{
            "label" : "{$translate.no}",
            "class" : "btn-danger"
        }, {
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                var sort_data = [];
                $('#inconv_table tbody.holiday_main').each(function (i, el) {
                    var gid = $(this).find('input.gid').val();
                    sort_data.push({ 'gid': gid, 'order': i+1 });
                });
                // console.log(sort_data);

                wrapLoader("#wpr_inconv_table");
                $('#inconve_message_wraper').html('');
                $.ajax({
                    async:false,
                    url:"{$url_path}inconvenient_timings_list.php",
                    data: { 'action': 'sort_inconvenient_entries', 'sort_data': sort_data},
                    type:"POST",
                    dataType: 'json',
                    success:function(data){
                            // console.log(data);

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#inconve_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader("#wpr_inconv_table");
                });
            }
    }]);
}
</script>
{/block}

{block name="content"}
    <div class="row-fluid" id="main_container">
{*        main left*}
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
            <div class="span12 no-ml">
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1>{$translate.inconvenient_timings}</h1>
                    </div>
                    <div class="span12 widget-body-section input-group">
{*                        holiday section*}
                        <div style="margin: 0px ! important;" class="widget">
                            <div style="" class="widget-header span12">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1 style="">{$translate.holiday}</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <button onclick="javascript:location='{$url_path}holiday/new/';" class="btn btn-default btn-normal pull-right btn-addnew-holiday" type="button">{$translate.add_new} - {$translate.holiday}</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group">
                                <div class="table-responsive span12">
                                    <table id="holidayinc_main" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                        <thead>
                                            <tr>
                                                <th class="table-col-center" style="width:20px">#</th>
                                                <th>{utf8_encode($translate.name)}</th>
                                                <th>{utf8_encode($translate.type)}</th>
                                                <th>{$translate.date_effect_from}</th>
                                                <th>{$translate.days}</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        {assign i 0}
                                        {foreach from=$holi_timing_list item=list}
                                            {assign i $i+1}
                                            <tbody class="holiday_main {if $list.active_flag}active_rows{/if}">
                                                <tr class="gradeX{if $list.privious_versions|count gt 0} have_child{/if}">
                                                    <td style="width: 20px;" class="table-row-collapse-switch index-column center{if $list.privious_versions|count gt 0} have_child row-expander cursor_hand{/if}" {if $list.privious_versions|count gt 0}title="{$translate.click_here_to_see_previous_versions}"{/if}>{$i}</td>
                                                    <td {if $list.privious_versions|count gt 0}class="have_child cursor_hand" title="{$translate.click_here_to_see_previous_versions}"{/if}>{$list.name}</td>
                                                    <td>{$list.num_days}</td>
                                                    <td>{$list.year_from}{if $list.year_to != NULL} - {$list.year_to}{/if}</td>
                                                    <td style="min-width: 40px;">{$list.date_from} {$list.start_time}  <b> {$translate.to}  </b>{$list.date_to} {$list.end_time}</td>
                                                    <td style="width: 130px;"  class="table-col-center action-column">
                                                        <button type="button" class="btn btn-default" title="{$translate.edit}" onclick="javascript:location='{$url_path}holiday/new/{$list.id}/edit/';"><i class="icon-wrench"></i></button>
                                                        {if $list.year_to == NULL}<button type="button" class="btn btn-default" title="{$translate.clone}" onclick="javascript:location='{$url_path}holiday/new/{$list.id}/clone/';"><i class="icon-share"></i></button>{/if}
                                                        <button type="button" class="btn btn-default" title="{$translate.delete}" onclick="warning_delete('{$url_path}holiday/new/{$list.id}/delete/');"><i class="icon-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody class="child_holi">
                                                {foreach from=$list.privious_versions item=version}
                                                    <tr class="gradeX  table-row-collapse-wrpr item_row hide">
                                                        <td style="width: 20px;" class="center">*</td>
                                                        <td>{$version.name}</td>
                                                        <td>{$version.num_days}</td>
                                                        <td>{$version.year_from}{if $version.year_to != NULL} - {$version.year_to}{/if}</td>
                                                        <td style="min-width: 40px;">{$version.date_from} {$version.start_time}  <b> {$translate.to}  </b>{$version.date_to} {$version.end_time}</td>
                                                        <td style="width: 130px;" class="table-col-center">
                                                            <button type="button" class="btn btn-default" title="{$translate.edit}" onclick="javascript:location='{$url_path}holiday/new/{$version.id}/edit/';"><i class="icon-wrench"></i></button>
                                                            {if $version.year_to == NULL}<button type="button" class="btn btn-default" title="{$translate.clone}" onclick="javascript:location='{$url_path}holiday/new/{$version.id}/clone/';"><i class="icon-share"></i></button>{/if}
                                                            <button type="button" class="btn btn-default" title="{$translate.delete}" onclick="warning_delete('{$url_path}holiday/new/{$version.id}/delete/');"><i class="icon-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                {/foreach}
                                            </tbody>
                                        {/foreach}
                                    </table>
                                </div>
                            </div>
                        </div>
                                    
{*                        inconvenient section*}
                        <div style="margin: 20px 0px 0px;" class="widget">
                            <div class="span12" id="wpr_inconv_table">
                            <div style="" class="widget-header span12">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1 style="">{$translate.inconvenient_timings}</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <button onclick="javascript:location='{$url_path}inconvenient/timing/newentry/';" class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming ml" type="button">{$translate.add_new}</button>
                                    <button onclick="save_inconvenients_order();" class="btn btn-default btn-normal pull-right" type="button">{$translate.save_sort_order}</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group">
                                <div id="inconve_message_wraper" class="span12 no-min-height no-ml"></div>
                                <div class="table-responsive span12 no-ml">
                                    <table id="inconv_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                        <thead>
                                            <tr>
                                                <th class="table-col-center" style="width:20px">#</th>
                                                <th style="width: 100px;">{utf8_encode($translate.inconv_name)}</th>
                                                <th style="width: 20px;">{utf8_encode($translate.inconv_type)}</th>
                                                <th>{$translate.inconv_date_effect_from}</th>
                                                <th>{$translate.inconv_timing}</th>
                                                <th style="width:124px;">{$translate.inconv_salary}</th>
                                                <th style="width:124px;">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        {assign i 0}
                                        {if !empty($timing_list) and ($smarty.server.QUERY_STRING eq '' or $type eq 't1')}
                                            {foreach from=$timing_list item=list}
                                                {assign i $i+1}
                                                <tbody class="holiday_main">
                                                    <tr class="gradeX{if $list.privious_versions|count gt 0} have_child{/if}">
                                                        <td style="width: 20px;" class="table-row-collapse-switch-timings center{if $list.privious_versions|count gt 0} have_child row-expander cursor_hand{/if}" {if $list.privious_versions|count gt 0}title="{$translate.click_here_to_see_previous_versions}"{/if}>
                                                            <div class="row_index_val pull-left">{$i}</div> 
                                                            <div class="span1 pull-right sort-tools">
                                                                <i class="icon icon-arrow-up cursor_hand {if $i eq 1}icon_disabled{/if}" title="{$translate.sort_to_move_up}"></i>
                                                                <i class="icon icon-arrow-down cursor_hand {if $i eq $timing_list|count}icon_disabled{/if}" title="{$translate.sort_to_move_down}"></i>
                                                            </div>
                                                            <input type="hidden" class="gid" value="{$list.group_id}" />
                                                        </td>
                                                        <td class="table-col-center center{if $list.privious_versions|count gt 0} have_child cursor_hand{/if}" {if $list.privious_versions|count gt 0}title="{$translate.click_here_to_see_previous_versions}"{/if}>{$list.name}</td>
                                                        <td class="table-col-center center">
                                                            {if $list.type == 0 || $list.type == 3}
                                                            <ul class="slot-icons-day">
                                                                {if $list.type == 0}<li class="slot-icon-normal active"></li>
                                                                {else if $list.type == 3}<li class="slot-icon-oncall active"></li>{/if}
                                                            </ul>
                                                            {/if}
                                                        </td>
                                                        <td class="table-col-center center">{$list.effect_from}{if $list.effect_to neq ''} {$translate.to} {$list.effect_to}{/if}</td>
                                                        <td class="center">{*{$list.days}*}
                                                            {*foreach from=$list.day_time item=day_time}
                                                                <div class="day-report"><h1>{$translate.{$week[{$day_time.day-1}].label}}</h1>{$day_time.time}</div>
                                                            {/foreach*}
                                                            {foreach from=$list.day_time_merged key=day_key item=day_time}
                                                                <div class="day-report"><h1>{$translate.{$week[{$day_key-1}].label}}</h1>
                                                                    {'<br/>'|implode:$day_time}
                                                                </div>
                                                            {/foreach}
                                                        </td>
                                                        <td class="table-col-center center salary_col">
                                                            {if $list.type == 3 || $list.type == '3'}
                                                                <ol class="span12">
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> {$list.amount}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> {$list.sal_call_training}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> {$list.sal_complementary_oncall}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> {$list.sal_more_oncall}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> {$list.sal_dismissal_oncall}</div></li>
                                                                </ol>
                                                            {else}
                                                                {*$list.amount*}
                                                                <ol class="span12">
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-normal"></li></ul><div class="pull-left ml"> {$list.amount}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-training"></li></ul><div class="pull-left ml"> {$list.sal_call_training}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary"></li></ul><div class="pull-left ml"> {$list.sal_complementary_oncall}</div></li>
                                                                    <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal"></li></ul><div class="pull-left ml"> {$list.sal_dismissal_oncall}</div></li>
                                                                </ol>
                                                            {/if}
                                                        </td>
                                                        <td class="table-col-center" style="width: 200px;">
                                                            <button type="button" class="btn btn-default" title="{$translate.edit}" onclick="javascript:location='{$url_path}inconvenient/timing/{$list.id}/edit/';"><span class="icon-wrench"></span></button>
                                                            {if $list.effect_to eq ''}<button type="button" class="btn btn-default" title="{$translate.clone}" onclick="javascript:location='{$url_path}inconvenient/timing/{$list.id}/clone/';"><span class="icon-share"></span></button>{/if}
                                                            <button type="button" class="btn btn-default" title="{$translate.delete}" onclick="warning_delete_inconvenient('{$url_path}inconvenient/timing/{$list.id}/delete/');"><span class="icon-trash"></span></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="child_holi">
                                                    {foreach from=$list.privious_versions item=version}
                                                        <tr class="gradeX table-row-collapse-Timings-wrpr item_row hide">
                                                            <td class="center" style="width: 20px;">* </td>
                                                            <td class="table-col-center center">{$version.name}</td>
                                                            <td class="table-col-center center">
                                                                {if $version.type == 0 || $version.type == 3}
                                                                <ul class="slot-icons-day">
                                                                    {if $version.type == 0}<li class="slot-icon-normal active"></li>
                                                                    {else if $version.type == 3}<li class="slot-icon-oncall active"></li>{/if}
                                                                </ul>
                                                                {/if}
                                                            </td>
                                                            <td class="table-col-center center">{$version.effect_from}{if $version.effect_to neq ''} {$translate.to} {$version.effect_to}{/if}</td>
                                                            <td class="center">
                                                                {*foreach from=$version.day_time item=day_time}
                                                                    <div class="day-report"><h1>{$translate.{$week[{$day_time.day-1}].label}}</h1>{$day_time.time}</div>
                                                                {/foreach*}
                                                                {foreach from=$version.day_time_merged key=day_key item=day_time}
                                                                    <div class="day-report"><h1>{$translate.{$week[{$day_key-1}].label}}</h1>
                                                                        {'<br/>'|implode:$day_time}
                                                                    </div>
                                                                {/foreach}
                                                            </td>
                                                            <td class="table-col-center center salary_col">
                                                                {if $version.type == 3 || $version.type == '3'}
                                                                    <ol class="span12">
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> {$version.amount}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> {$version.sal_call_training}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> {$version.sal_complementary_oncall}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> {$version.sal_more_oncall}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> {$version.sal_dismissal_oncall}</div></li>
                                                                    </ol>
                                                                {else}
                                                                    {*$version.amount*}
                                                                    <ol class="span12">
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-normal"></li></ul><div class="pull-left ml"> {$version.amount}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-training"></li></ul><div class="pull-left ml"> {$version.sal_call_training}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary"></li></ul><div class="pull-left ml"> {$version.sal_complementary_oncall}</div></li>
                                                                        <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal"></li></ul><div class="pull-left ml"> {$version.sal_dismissal_oncall}</div></li>
                                                                    </ol>
                                                                {/if}
                                                            </td>
                                                            <td class="center">
                                                                <button type="button" class="btn btn-default" title="{$translate.edit}" onclick="javascript:location='{$url_path}inconvenient/timing/{$version.id}/edit/';"><span class="icon-wrench"></span></button>
                                                                {if $version.effect_to eq ''}<button type="button" class="btn btn-default" title="{$translate.clone}" onclick="javascript:location='{$url_path}inconvenient/timing/{$version.id}/clone/';"><span class="icon-share"></span></button>{/if}
                                                                <button type="button" class="btn btn-default" title="{$translate.delete}" onclick="warning_delete_inconvenient('{$url_path}inconvenient/timing/{$version.id}/delete/');"><span class="icon-trash"></span></button>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                </tbody>
                                            {/foreach}
                                        {/if}
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
{*        main right*}
        <div class="span4 main-right hide" style="margin-top: 8px; padding: 10px;">
            <div id="right_message_wraper" class="span12 no-min-height"></div>
            
{*            holiday form*}
            <div class="row-fluid addnew-hoiliday hide" id="holiday_form">
                <div class="span12" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="span4 day-slot-wrpr-header-left span6">
                                <h1 style="">{$translate.holiday} <span class="subtitle"></span></h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right"  onclick="SaveHoliday()" type="button"><i class=' icon-save'></i> {$translate.save}</button>
                                <button class="btn btn-default btn-normal pull-right" onclick="ResetHolidayForm()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                                <button class="btn btn-default btn-normal pull-right btn-cancel-right" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <input type="hidden" id="operational_holiday_id" name="operational_holiday_id" value="" />
                            <input type="hidden" id="operational_holiday_mode" name="operational_holiday_mode" value="" />
                            <div class="row-fluid">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div class="span12" style="margin: 0px;">
                                        <label class="span12" style="float: left;">{$translate.type}</label>
                                        <input name="holiday_type" value="1" id="holi_normal" style="margin: 0px 7px 0px 0px ! important;" type="radio">{$translate.normal}
                                        <input name="holiday_type" value="2" id="holi_inconv" style="margin: 0px 7px ! important;" type="radio">{$translate.inconvenient}
                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_name">{$translate.holiday} {$translate.name}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                            <input id="holiday_name" name="holiday_name" class="form-control span11" type="text" />
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_year_from">Year</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_year_from" id="holiday_year_from" placeholder="{$translate.from}" type="text"/>
                                                <span class="add-on">{$translate.to}</span>
                                                <input class="form-control span5" name="holiday_year_to" id="holiday_year_to" placeholder="{$translate.to}" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="holiday_datefrom">{$translate.date_effected} {$translate.from}</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend date hasDatepicker">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span5 datepicker" name="holiday_datefrom" id="holiday_datefrom" type="text"/>
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_timefrom" id="holiday_timefrom" type="text"/>
                                            </div>
                                        </div>
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.date_effected} {$translate.to}</label>
                                        <div class="span12" style="margin:0;">
                                            <div class="input-prepend date hasDatepicker">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span5 datepicker" name="holiday_dateto" id="holiday_dateto" type="text"/>
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" name="holiday_timeto" id="holiday_timeto" type="text"/>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <div class="btn-group holiday-days"> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">1</a> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">2</a> 
                                                        <a unselectable="on" href="javascript:;" class="btn btn-default">3</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12" style=" margin: 10px 0px 0px ! important;">
                                                <div style="margin: 0px ! important;" class="span12">
                                                    <ul class="day-info-list">
                                                        <li class="day-big">Big Day</li>
                                                        <li class="day-red">Red Day</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{*            inconvenient form*}
            <div class="row-fluid addnew-timing hide"  id="inconvenient_form">
                <div class="span12" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="row-fluid">
                                <div class="span12 day-slot-wrpr-header-left">
                                    <h1 style="padding: 3px ! important;">Inconvenient Timings - Normal</h1>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="day-slot-wrpr-header-left span12" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal span4 btn-addnew-notes" style="" type="button">Save</button>
                                    <button class="btn btn-default btn-normal span4" style="" type="button">Reset</button>
                                    <button class="btn btn-default btn-normal span3 btn-cancel-right" style="" type="button">Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="row-fluid">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Name</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Effect From</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
                                        </div>
                                    </div>


                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Inconvenient Type</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Normal</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">On call</a>
                                        </div>
                                    </div>

                                    <div style="margin: 10px 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Type</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Normal</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">On call</a>
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Time Range</label>
                                        <div class="span12" style="margin:0;">
                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker" id="datepicker">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" id="exampleInputEmail1" placeholder="Enter email" type="email">
                                                <span class="add-on icon-time"></span>
                                                <input class="form-control span5" id="exampleInputEmail1" placeholder="Enter email" type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 10px 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Days</label>
                                        <div class="btn-group leave-type">
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered List">Mon</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Tue</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Wed</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Thu</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Fri</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Sat</a>
                                            <a unselectable="on" href="javascript:;" class="btn btn-default" data-wysihtml5-command="Indent" title="Indent">Sun</a>
                                        </div>
                                    </div>

                                    <div style="margin: 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">Salary</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" placeholder="Förnamn*" id="exampleInputEmail1" type="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}