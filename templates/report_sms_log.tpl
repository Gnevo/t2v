{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.sms_log_report}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:document.location.href='{$url_path}reports/'">{$translate.backs}</button>
{*                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm();">{$translate.print}</button>*}
                </div>

            </div>
            <div class="span12 widget-body-section input-group">
                <div class="span12 widget-body-section input-group" >
                    <div class="widget-body" style="padding:5px;">
                        <div class="row-fluid" style="margin-bottom:15px;">
                            <div class="span12 widget-body-section input-group">
                                <form name="sms_log_form" id="sms_log_form" method="post" action="{$url_path}report/log/sms/">
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.year}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select class="form-control span12" style="margin: 0px;" name=cmb_year id=cmb_year>
                                                <option value="" >{$translate.select_year}</option>
                                                {html_options values=$year_option_values selected=$selected_year output=$year_option_values}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span2">
                                        <label class="span12" style="float: left;" >{$translate.month}:</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select style="margin: 0px;" class="form-control span10" name=cmb_month id=cmb_month>
                                                <option value="" >{$translate.select_month}</option>
                                                {html_options values=$month_option_values selected=$selected_month output=$month_option_output_full}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <label class="span12" style="float: left;" >{$translate.sms_type}:</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                            <select style="margin: 0px;" class="form-control span10" name=cmb_type id=cmb_type>
                                                <option value="1" {if $selected_type eq 1}selected="selected"{/if} >{$translate.sms_incoming}</option>
                                                <option value="2" {if $selected_type eq 2}selected="selected"{/if}>{$translate.sms_outgoing}</option>
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
                                                        <table class="table table-invoice">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 58%;">
                                                                        <div class="billing-logo">
                                                                            <img style="" class="media-object pull-left thumb billing-logo" src="{$url_path}images/t2v_billing_logo.png" alt="t2v">
                                                                            <div class="media-body hidden-print">
                                                                                <div class="separator bottom"></div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div style="margin: 0px 0px 20px;" class="row-fluid">
                                                    <div class="span12">
                                                        <center>
                                                            <h1><strong>{$company_name}<br>{$translate.sms_log_report}</strong></h1>
                                                        </center>            
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div style="padding: 0px;" class="well mb">
                                                            <div class="table-responsive">
                                                                <table class="table table-invoice no-mb">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width:10%; padding-left: 15px;">
                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col mt">{$translate.total_sms_count} : <span>{$log_sms_count}</span></div></li>
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
                                                        {if $selected_type eq 1}
                                                            <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="header">{$translate.serial_no}</th>
                                                                        <th class="header">{$translate.date}</th>
                                                                        <th class="header">{$translate.employee}</th>
                                                                        <th class="header">{$translate.mobile}</th>
                                                                        <th class="header">{$translate.sms_message}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {assign i 0}
                                                                    {foreach from=$log_result item=sms}
                                                                        {assign i $i+1}
                                                                        <tr>
                                                                            <td>{$i}</td>
                                                                            <td>{$sms.date}</td>
                                                                            <td>{if $sort_by_name eq 1}{$sms.first_name} {$sms.last_name}{else}{$sms.last_name} {$sms.first_name}{/if}</td>
                                                                            <td>{$sms.mobile}</td>
                                                                            <td style="white-space: pre-wrap; width: 40%;">{$sms.message}</td>
                                                                        </tr>
                                                                    {foreachelse}
                                                                        <tr><td colspan="5"><div class="message">{$translate.no_data_available}</div></td></tr>
                                                                    {/foreach}
                                                                </tbody>
                                                            </table>
                                                        {else if $selected_type eq 2}
                                                            <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="header">{$translate.serial_no}</th>
                                                                        <th class="header">{$translate.date}</th>
                                                                        <th class="header">{$translate.employee}</th>
                                                                        <th class="header">{$translate.mobile}</th>
                                                                        <th class="header">{$translate.sms_message}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {assign i 0}
                                                                    {foreach from=$log_result item=sms}
                                                                        {assign i $i+1}
                                                                        <tr>
                                                                            <td>{$i}</td>
                                                                            <td>{$sms.date}</td>
                                                                            <td>{if $sort_by_name eq 1}{$sms.first_name} {$sms.last_name}{else}{$sms.last_name} {$sms.first_name}{/if}</td>
                                                                            <td>{$sms.to_no}</td>
                                                                            <td style="white-space: pre-wrap; width: 50%;">{$sms.message}</td>
                                                                        </tr>
                                                                    {foreachelse}
                                                                        <tr><td colspan="5"><div class="message">{$translate.no_data_available}</div></td></tr>
                                                                    {/foreach}
                                                                </tbody>
                                                            </table>
                                                        {/if}
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

{block name='script'}
<script type="text/javascript">

</script>
{/block}