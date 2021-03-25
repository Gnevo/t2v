{block name='style'}
   <style type="text/css">
       #tbl_result .highlight_word{ color: rgba(191, 25, 25, 0.9); font-weight: 600; }
   </style>
{/block}

{block name='script'}
<script type="text/javascript">
    $(document).ready(function() {
        if($(window).height() > 600){
            $('#tbl_result_wraper').css({ height: Math.max($(window).innerHeight()- ($('#tbl_result_wraper').length > 0 ? $('#tbl_result_wraper').offset().top : 0), 250) });
            $(window).resize(function(){
                $('#tbl_result_wraper').css({ height: Math.max($(window).innerHeight()- ($('#tbl_result_wraper').length > 0 ? $('#tbl_result_wraper').offset().top : 0), 250) });
            });
        }
    });
</script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.search_customer_by_data}</h1>
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
                                <form name="available_emp_form" id="available_emp_form" method="post" action="{$url_path}report/search/on/customer/">
                                    <div class="span8" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.search_data} :</label>
                                        <div style="margin: 0px; float:left" class="input-prepend span11"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span12 time-input" type="text" style="margin: 0px;" name="search_data" id="search_data" value="{$search_data}" />
                                        </div>
                                    </div>
                                    <button value="{$translate.get}" id="go" name="go" style="margin-top: 15px; text-align: center;" class="btn btn-default btn-margin-set" type="submit"><i class="icon icon-search"></i> {$translate.get} </button>
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
                                                        <div style="padding: 0px;" class="well mb">
                                                            <div class="table-responsive">
                                                                <table class="table table-invoice no-mb">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width:10%; padding-left: 15px;">
                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col mt">{$translate.total_records} : <span>{$available_users_count}</span></div></li>
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
                                                    <div class="span12" style="overflow-y: auto;" id="tbl_result_wraper">
                                                        <table class="table table-bordered table-primary table-striped table-vertical-center" id="tbl_result">
                                                            <thead>
                                                                <tr>
                                                                    <th class="header" rowspan="2">{$translate.serial_no}</th>
                                                                    <th class="header" rowspan="2">{$translate.customer}</th>
                                                                    <th class="header" rowspan="2">{$translate.mobile}</th>
                                                                    <th class="header" colspan="{$max_columns}">{$translate.match_contents}</th>
                                                                </tr>
                                                                <tr>
                                                                    {foreach from=$columns item=c}
                                                                        <th class="header">{$translate.{substr($c, 0,2)}} {if $translate.{substr($c, 3)} neq ''}{$translate.{substr($c, 3)}}{else}{substr($c, 3)}{/if}</th>
                                                                    {/foreach}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {assign i 0}
                                                                {foreach from=$result item=cust}
                                                                    {assign i $i+1}
                                                                    <tr>
                                                                        <td {*if $cust.match_multirows|count gt 0}rowspan='{$cust.match_multirows}'{/if*}>{$i}</td>
                                                                        <td>{$cust.name}</td>
                                                                        <td>{$cust.mobile}</td>
                                                                        {foreach from=$columns item=c}
                                                                            {assign ikey array_search($c, $cust.match_indexes)}
                                                                            <td>
                                                                                {if in_array($c, $cust.match_indexes)}
                                                                                    {str_ireplace($search_data, '<span class="highlight_word">'|cat: $search_data|cat: '</span>', $cust.match_content[$cust.match_indexes[$c]].field_value)}
                                                                                {else}
                                                                                    {if $cust.match_multirows|count gt 0}
                                                                                        {foreach from=$cust.match_multirows item=mr}
                                                                                            {if in_array($c, $mr.match_indexes)}
                                                                                                {str_ireplace($search_data, '<span class="highlight_word">'|cat: $search_data|cat: '</span>', $mr.match_content[$mr.match_indexes[$c]].field_value)}<br/>
                                                                                            {/if}
                                                                                        {/foreach}
                                                                                    {/if}
                                                                                {/if}
                                                                            </td>
                                                                        {/foreach}
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