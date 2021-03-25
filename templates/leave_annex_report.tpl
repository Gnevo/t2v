{block name='style'}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<style> .panel-title ul li{ color: #333;}</style>
{/block}

{block name='script'}
<script type="text/javascript">
function printForm(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
    }
}

function loadCustomers(){
    var year = $("#year").val();
    var month = $("#month").val();
    navigatePage('{$url_path}pdf/annex/leave/'+year+'/'+month+'/',8);
}

function refresh(){
    //$("#forms").attr('target', '_self');
    navigatePage('{$url_path}pdf/annex/leave/',8);
}
</script>

{/block}

{block name="content"}
{$message}
{if $flag_cust_access == 1}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    {$translate.leave_annex_report}
                    <ul class="pull-right">
                        <li> <i class="icon-arrow-left"></i> <a href="{$url_path}forms/"><span class="special_spn">{$translate.backs}</span></a></li>
                        <li> <i class="icon-refresh"></i> <a href="javascript:void(0);" onclick="navigatePage('{$url_path}pdf/annex/leave/',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                        <li> <i class="icon-print"></i><a href="javascript:void(0);" onclick="printForm();"><span class="special_spn">{$translate.print}</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <form name="forms" id="forms" method="post" action="{$url_path}pdf/annex/leave/">
            <input type="hidden" name="action" id="action" value="" />

            <div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
                <div id="employee_tab_content_pdf_form" class="span12" style="background: none repeat scroll 0 0 #ffffff;border: 1px solid #dcdcdc;padding: 15px;">
                    <div class="span12" name="leave_inputs" id="leave_inputs">
                        <div class="span12">
                            <div class="span12">
                                <span class="span4">
                                    <label class="pull-left span3">{$translate.year}:</label>
                                    <select id="year" name="year" style="border:solid 1px #d9d9d9">
                                        <option value="">{$translate.select}</option>
                                        {html_options values=$years_combo selected=$report_year output=$years_combo}
                                    </select>
                                </span>
                                <span class="span4"> <label class="pull-left span3">{$translate.month}: </label>
                                    <select style="border:solid 1px #d9d9d9" onchange="loadCustomers()" id="month" name="month">
                                        <option value="" >{$translate.select}</option>
                                        {if $month == ''}
                                            <option value="01" {if  $smarty.now|date_format:"%m" == 1} selected = "selected" {/if} >{$translate.jan}</option>
                                            <option value="02" {if  $smarty.now|date_format:"%m" == 2} selected = "selected" {/if}>{$translate.feb}</option>
                                            <option value="03" {if  $smarty.now|date_format:"%m" == 3} selected = "selected" {/if}>{$translate.mar}</option>
                                            <option value="04" {if  $smarty.now|date_format:"%m" == 4} selected = "selected" {/if}>{$translate.apr}</option>
                                            <option value="05" {if  $smarty.now|date_format:"%m" == 5} selected = "selected" {/if}>{$translate.may}</option>
                                            <option value="06" {if  $smarty.now|date_format:"%m" == 6} selected = "selected" {/if}>{$translate.jun}</option>
                                            <option value="07" {if  $smarty.now|date_format:"%m" == 7} selected = "selected" {/if}>{$translate.jul}</option>
                                            <option value="08" {if  $smarty.now|date_format:"%m" == 8} selected = "selected" {/if}>{$translate.aug}</option>
                                            <option value="09" {if  $smarty.now|date_format:"%m" == 9} selected = "selected" {/if}>{$translate.sep}</option>
                                            <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.oct}</option>
                                            <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.nov}</option>
                                            <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.dec}</option>
                                        {else}
                                            <option value="01" {if  $month == 1} selected = "selected" {/if}>{$translate.jan}</option>
                                            <option value="02" {if  $month == 2} selected = "selected" {/if}>{$translate.feb}</option>
                                            <option value="03" {if  $month == 3} selected = "selected" {/if}>{$translate.mar}</option>
                                            <option value="04" {if  $month == 4} selected = "selected" {/if}>{$translate.apr}</option>
                                            <option value="05" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                            <option value="06" {if  $month == 6} selected = "selected" {/if}>{$translate.jun}</option>
                                            <option value="07" {if  $month == 7} selected = "selected" {/if}>{$translate.jul}</option>
                                            <option value="08" {if  $month == 8} selected = "selected" {/if}>{$translate.aug}</option>
                                            <option value="09" {if  $month == 9} selected = "selected" {/if}>{$translate.sep}</option>
                                            <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
                                            <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
                                            <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
                                        {/if}
                                    </select>
                                </span>
                                <span class="span4"> <label class="pull-left span3">{$translate.choose_user}</label>
                                    <select id="customer" name="customer" style="border:solid 1px #d9d9d9;">
                                        <option value="">{$translate.select}</option>
                                        {foreach from=$customers item=customer}
                                            <option value="{$customer.customer_id}" {if $cust== $customer.customer_id}selected="selected" {/if} >{if $sort_by_name == 1}{$customer.cust_ff}{elseif $sort_by_name == 2}{$customer.cust}{/if}</option>
                                        {/foreach}
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form> 
    </div>
</div>
{else}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="alert alert-danger alert-dismissable">
                <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  {$translate.permission_denied}
            </div>
        </div>
    </div>
{/if}  
{/block}