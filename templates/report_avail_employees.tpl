{block name='style'}
    <!-- <link rel="stylesheet" href="{$url_path}css/administration.css" type="text/css" /> -->
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" type="text/css" /><!-- DATE PICKER -->
    <style type="text/css">
        table tbody tr td > .day-report{ height: auto !important;}
    </style>
{/block}

{block name='script'}
<script type="text/javascript" src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        })
        $("#pref, #non_pref").click(function(){
            $(this).parent().closest('div').find('> span').eq(1).css('font-weight','bold');
            if($(this).attr('id') == 'pref'){
                $('#non_pref').parent().closest('div').find('> span').eq(1).css('font-weight','normal');
            }else if($(this).attr('id') == 'non_pref'){
                $('#pref').parent().closest('div').find('> span').eq(1).css('font-weight','normal');
            }
        })
        $(document).off('keyup', ".time-input").on('keyup', ".time-input", function(e) {
            // get keycode of current keypress event
            var code = (e.keyCode || e.which);
            //console.log(code);
            

            // do nothing if it's an arrow key  || (code >=65 && code <= 90)
            if(code == 37 || code == 38 || code == 39 || code == 40) {
                return;
            }
            var this_val = $(this).val();
            var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
            $(this).val(new_val);
            /*$(this).val($(this).val().replace(/[^0-9.,]+/g,''));
            $(this).val($(this).val().replace(/,/g,"."));*/
        });
    });
</script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.available_employees_report}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:document.location.href='{$url_path}reports/'">{$translate.backs}</button>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="span12 widget-body-section input-group" >
                    <div class="widget-body" style="padding:5px;">
                        {$message} 
                        <div class="row-fluid" style="margin-bottom:15px;">
                            <div class="span12 widget-body-section input-group">
                                <form name="available_emp_form" id="available_emp_form" method="post" action="{$url_path}report/available/employees/">
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.from_date}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker datepicker span10 no-padding"> 
                                            <span class="add-on icon icon-calendar"></span>
                                            <input class="form-control span12" type="text" name="from_date" id="from_date" value="{$selected_from_date}" />
                                        </div>
                                    </div>
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.to_date}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker datepicker span10 no-padding"> 
                                            <span class="add-on icon icon-calendar"></span>
                                            <input class="form-control span12" type="text" name="to_date" id="to_date" value="{$selected_to_date}" />
                                        </div>
                                    </div>
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.from} {$translate.time}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend span10"> <span class="add-on icon icon-time"></span>
                                            <input class="form-control span12 time-input" type="text" style="margin: 0px;" name="from_time" id="from_time" value="{$selected_from_time}" />
                                        </div>
                                    </div>
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.to} {$translate.time}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend span10"> <span class="add-on icon icon-time"></span>
                                            <input class="form-control span12 time-input" type="text" style="margin: 0px;" name="to_time" id="to_time" value="{$selected_to_time}" />
                                        </div>
                                    </div>
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;" >{$translate.customer}:</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-user"></span>
                                            <select style="margin: 0px;" class="form-control span10" name=cmb_customer id=cmb_customer>
                                                <option value="" >{$translate.select}</option>
                                                {foreach from=$search_customers item=cust}
                                                    <option value="{$cust.username}" {if $selected_customer eq $cust.username}selected='selected'{/if}>{if $sort_by_name eq 1}{$cust.first_name} {$cust.last_name}{else}{$cust.last_name} {$cust.first_name}{/if}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">                                        
                                        <div style="float:left;  padding-top: 8px;">
                                            <span style="margin-top: 3px !important; float: left; "><input type="radio" id="pref" name="pref_selection" value="1" {if $preference_mode == 1}checked = "checked"{/if}></span>
                                            <span style="padding-left: 4px; float: left;{if $preference_mode == 1}font-weight: bold;{/if}">{$translate.preferred_time}</span>
                                        </div>
                                        <div style="float:left; clear:left;">
                                            <span style="margin-top: 3px !important; float: left"><input type="radio" id ="non_pref" name="pref_selection" value="0" {if $preference_mode == 0}checked = "checked"{/if}></span>
                                            <span style="padding-left: 4px; float: left;{if $preference_mode == 0}font-weight: bold;{/if}">{$translate.non_preferred_time}</span>
                                        </div>
                                    </div>    
                                        <button value="{$translate.get}" id="go" name="go" style="margin-top: 15px; text-align: center;" class="btn btn-default btn-margin-set" type="submit"> {$translate.get} </button>
                                    
                                </form>

                            </div>
                        </div>

                        <div style="" class="row-fluid">
                            {if $is_generate}
                                <div class="span12">
                                    <div class="span12">
                                        <div class="widget" style="margin: 0px ! important;">
                                            <div style="" class="span12 widget-body-section input-group">

                                                <!-- non preferrd employee starts -->
                                                {if $preference_mode == 0}
                                                    <div class="row-fluid">
                                                        <div class = "widget-header span12" >
                                                            <h1>{$translate.employee_non_preferred_time_heading}</h1>
                                                        </div>
                                                        <div class="span12" style="margin:5px 0px 0px 0px;">
                                                            <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="header">{$translate.serial_no}</th>
                                                                        <th class="header">{$translate.employee}</th>
                                                                        <th class="header">{$translate.code}</th>
                                                                        <th class="header">{$translate.mobile}</th>
                                                                        <th class="header">{$translate.employee_non_preferred_time}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {assign i 0}

                                                                    {foreach from=$customized_non_preferd_times  item=emp_det key=key}
                                                                        {assign i $i+1}
                                                                        <tr>
                                                                            <td>{$i}</td>
                                                                            <td>{$emp_det.name}</td>
                                                                            <td>{$emp_det.code}</td>
                                                                            <td>{$emp_det.mobile}</td>
                                                                            <td>
                                                                                {assign prev_day ''}
                                                                                {foreach from=$emp_det.days  item=value key=key}
                                                                                    {if $prev_day neq $value['day'] }
                                                                                        {if $prev_day neq $value['day']}</div>{/if}
                                                                                        <div class="day-report">
                                                                                            <h1>{$translate.{$week[$value['day']-1].day}}</h1>
                                                                                            {$value['time_from']}-{$value['time_to']} 
                                                                                        
                                                                                        {assign prev_day $value['day']}
                                                                                    {else}
                                                                                        {assign prev_day $value['day']}
                                                                                        <br/>{$value['time_from']}-{$value['time_to']} 
                                                                                    {/if}
                                                                                {/foreach}
                                                                                {assign prev_day ''}
                                                                            </td>
                                                                        </tr>
                                                                    {foreachelse}
                                                                        <tr class="gradeX">
                                                                            <td class="text-center" colspan="6">
                                                                                <div class="alert alert-info no-ml no-mr">
                                                                                    <strong><i class="icon-info-sign icon-large"></i> {$translate.message_caption_information}</strong>:  {$translate.no_non_preferred_data_found}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    {/foreach}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                {/if}
                                                {if $preference_mode == 1}
                                                    <div class="row-fluid">
                                                        <div class = "widget-header span12" >
                                                            <h1>{$translate.employee_preferred_time_heading}</h1>
                                                        </div>
                                                    <div class="span12" style="margin:5px 0px 0px 0px;">
                                                        <table id="non_preferd_time_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                                            <thead>
                                                                <tr>                
                                                                    <th>{$translate.employee}</th>
                                                                    <th style="width: 10em;">{$translate.date_range_for_employee_preferred_time}</th>
                                                                    <th style="width: 25em;">{$translate.timing_for_employee_preferred_time}</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {assign i 0}
                                                                {assign prev_day ''}
                                                                {foreach from=$preferred_time_employees_customized item=orderdAllNonPreferedTime key=employee }
                                                                <tr>
                                                                    <td class="center" rowspan="{count($orderdAllNonPreferedTime['timings'])}" style="width: 20%;">
                                                                        {$orderdAllNonPreferedTime['name']}                       
                                                                    </td>    
                                                                {assign j 0}
                                                                    {foreach from=$orderdAllNonPreferedTime['timings'] item=date_range key=group_id }
                                                                        {assign i $i+1}
                                                                        {if $j != 0}
                                                                            <tr>
                                                                        {/if}
                                                                        {assign j $j+1}
                                                                            
                                                                            
                                                                            <td class="center" style="width: 20%;">{$date_range[0]['date_from']} {$translate.to} {$date_range[0]['date_to']}</td>
                                                                            <td>
                                                                                {foreach from=$date_range  item=value key=key}
                                                                                    {if $prev_day neq $value['day']}
                                                                                        {if $prev_day neq $value['day'] && $key != 0}</div>{/if}

                                                                                        <div class="day-report" style="width:auto;">
                                                                                            <h1>{$translate.{$week[$value['day']-1].day}}
                                                                                                
                                                                                            </h1>
                                                                                            {$value['time_from']}-{$value['time_to']}
                                                                                            <a href="javascript:void(0);" onclick="handleSingleDelete({$value['id']})">
                                                                                                    <i class="icon-remove ml mr"></i>
                                                                                            </a>
                                                                                            {assign prev_day $value['day']}
                                                                                    {else}
                                                                                        {assign prev_day $value['day']}
                                                                                            <br/>{$value['time_from']}-{$value['time_to']}
                                                                                            <a href="javascript:void(0);" onclick="handleSingleDelete({$value['id']})">
                                                                                                    <i class="icon-remove ml mr"></i>
                                                                                            </a>
                                                                                    {/if}
                                                                                {/foreach}
                                                                                {assign prev_day ''}
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    {foreachelse}
                                                                        <tr class="gradeX">
                                                                            <td class="text-center" colspan="6">
                                                                                <div class="alert alert-info no-ml no-mr">
                                                                                    <strong><i class="icon-info-sign icon-large"></i> {$translate.message_caption_information}</strong>:  {$translate.no_non_preferred_data_found}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    {/foreach}
                                                                {/foreach}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {/if}

                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div style="padding: 0px;" class="well mb">
                                                            <div class="table-responsive">
                                                                <table class="table table-invoice no-mb">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width:10%; padding-left: 15px;">
                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col mt">{$translate.total_available_users_count} : <span>{$available_users_count}</span></div></li>
                                                                                </ol>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                            <thead>
                                                                <tr>
                                                                    <th class="header">{$translate.serial_no}</th>
                                                                    <th class="header">{$translate.employee}</th>
                                                                    <th class="header">{$translate.code}</th>
                                                                    <th class="header">{$translate.mobile}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {assign i 0}
                                                                {foreach from=$available_users item=au}
                                                                    {assign i $i+1}
                                                                    <tr>
                                                                        <td>{$i}</td>
                                                                        <td>{$au.ordered_name}</td>
                                                                        <td>{$au.code}</td>
                                                                        <td>{$au.mobile}</td>
                                                                    </tr>
                                                                {foreachelse}
                                                                    <tr><td colspan="4"><div class="message">{$translate.no_data_available}</div></td></tr>
                                                                {/foreach}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}