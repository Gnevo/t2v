{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/survey.css"/>
<style type="text/css">
        .horizontal-only {
            height: auto;
            max-height: 250px;
        }
        .textarea-responds ol li {
            border-bottom: 1px dashed brown;
            line-height: 1.5;
            padding-bottom: 4px;
            padding-top: 4px;
            white-space: pre-wrap;
        }
        .special_count_persentage{
            font-size: 10px;
            font-style: italic;
            float: right;
        }
        .graph_heading td {
            border: 1px solid #e1e1e1;
            color: #6c6c6c;
            font-size: 13px;
        }
        .report_hd {
            font-weight: bold;
        }
        .selectsurvey_date {
            font-size: 11px;
            font-style: italic;
            padding: 9px;
        }
        ol.textarea-responds li{ white-space: pre-wrap;}
</style>
{/block}
{block name="script"}
    <script type="text/javascript" >
        $(document).ready(function(){
            $("#customer").change(function() {
                var customer_id = $(this).val();
                navigatePage('{$url_path}form_2_report.php?customer=' + customer_id, 8);
            });
        });
        function goBack() {
            var customer_id = $('#customer').val();
            navigatePage('{$url_path}form_2.php?customer=' + customer_id, 8);
        }
    </script>
  
{/block}

{block name="content"}
    <div class="row-fluid">
        <div style="width: 99%; position: relative;" class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget no-ml">
                <div style="" class="widget-header span12">
                    <div class="pull-left day-slot-wrpr-header-left">
                        <h1>{$translate.form_2}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button onclick="goBack()" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.back}</button>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <div class="input-prepend pull-right" style="margin: 0px;">
                            <span class="add-on icon-pencil"></span>
                            <select class="form-control" id="customer" name="customer">
                                <option value="0">{$translate.all_customers}</option>
                                {foreach $customers as $customer}
                                    <option value="{$customer['username']}" {if $customerid eq $customer['username']}selected{/if}>{if $sort_by_name == 1}{$customer['first_name']|cat:' '|cat:$customer['last_name']}{else}{$customer['last_name']|cat:' '|cat:$customer['first_name']}{/if}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        {if $forms_datas}
                            <div class="accordion accordion-2" id="tabAccountAccordion">
                                <div class="accordion-group" data-question="{$field}">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle glyphicons right_arrow collapsed" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-{$field}">
                                            <i></i>{$translate.user_responds}
                                        </a>
                                    </div>
                                    <div style="height: 0px;" id="collapse-{$field}" class="accordion-body collapse">
                                        <div class="accordion-inner span12">
                                            <div style="padding: 10px;" class="table-responsive">
                                                <table class="table table-bordered table-condensed table-hover table-primary " style="top: 0px; margin: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;" class="center">#</th>
                                                            <th>{$translate.question}</th>
                                                            <th style="width: 10%;">{$translate.count}</th>
                                                            <th style="width: 10%;" class="center">1</th>
                                                            <th style="width: 10%;" class="center">2</th>
                                                            <th style="width: 10%;" class="center">3</th>
                                                            <th style="width: 10%;" class="center">4</th>
                                                            <th style="width: 10%;" class="center">5</th>
                                                            <th style="width: 10%;" class="center">6</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {assign var="i" value=1}
                                                        {foreach from=$forms_datas  item=forms_data}
                                                            <tr class="gradeX">
                                                                <td class="center">{$i}</td>
                                                                <td>{$forms_data.question}</td>
                                                                <td class="center">{$forms_data.count} {$translate.answer}</td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_1)}
                                                                        {assign var="percent" value=round(($forms_data.answer_1/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_1}{$forms_data.answer_1} {$translate.answer}{/if}</span>
                                                                </td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_2)}
                                                                        {assign var="percent" value=round(($forms_data.answer_2/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_2}{$forms_data.answer_2} {$translate.answer}{/if}</span>
                                                                </td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_3)}
                                                                        {assign var="percent" value=round(($forms_data.answer_3/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_3}{$forms_data.answer_3} {$translate.answer}{/if}</span>
                                                                </td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_4)}
                                                                        {assign var="percent" value=round(($forms_data.answer_4/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_4}{$forms_data.answer_4} {$translate.answer}{/if}</span>
                                                                </td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_5)}
                                                                        {assign var="percent" value=round(($forms_data.answer_5/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_5}{$forms_data.answer_5} {$translate.answer}{/if}</span>
                                                                </td>
                                                                <td style="vertical-align: bottom;">
                                                                    {assign var="percent" value=0}
                                                                    {if isset($forms_data.answer_6)}
                                                                        {assign var="percent" value=round(($forms_data.answer_6/$forms_data.count)*100, 2)}
                                                                    {/if}
                                                                    {if $percent}<span class="center">{$percent}%</span>{/if}
                                                                    <span class="span-progress-report-progressbar" style="width:100%; height: {$percent}px!important;">{if $forms_data.answer_6}{$forms_data.answer_6} {$translate.answer}{/if}</span>
                                                                </td>
                                                            </tr>
                                                            {assign var="i" value=$i+1}
                                                        {/foreach}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {if $forms_descriptions}
                                    <div class="accordion-group" data-question="descriptions">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle glyphicons right_arrow collapsed" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-descriptions">
                                                <i></i>Övriga synpunkter
                                                <span style="margin: 9px;" class="label label-success pull-right">{$translate.user_responds} ({$forms_descriptions|count})</span>
                                            </a>
                                        </div>
                                        <div style="height: 0px;" id="collapse-descriptions" class="accordion-body collapse">
                                            <div class="accordion-inner span12">
                                                <ol class="span12 user-respond-list{if $report.answer_type eq 5} textarea-responds{/if}"  style="margin-left: 15px ! important; list-style: decimal outside none ! important;">
                                                    {foreach $forms_descriptions AS $forms_description}
                                                        {if $forms_description.field_description}
                                                            <li>
                                                                <p>{$forms_description.field_description}</p>
                                                            </li>
                                                        {/if}
                                                    {/foreach}
                                                </ol> 
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                            </div>
                        {else}
                            <div class='message'>{$translate.no_responds_found}</div>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}