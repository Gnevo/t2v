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
        });

    });
</script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.employee_preferrred_time_report}</h1>
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
                                <form name="available_emp_form" id="available_emp_form" method="post" action="{$url_path}report/preferred/time/employees/">
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
                                            <input class="form-control span12" type="text" name="to_date" id="to_date" />
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
                                                
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <table id="non_preferd_time_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                            <thead>
                                                <tr>                
                                                    <th>{$translate.employee}</th>
                                                    <th style="width: 10em;">{$translate.date_range}</th>
                                                    <th style="width: 25em;">{$translate.timing}</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {assign i 0}
                                                {assign prev_day ''}
                                                {foreach from=$data item=orderdAllNonPreferedTime key=employee }
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