{block name='style'}
	<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
	{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
	<style> .panel-title ul li{ color: #333;}</style>
{/block}

{block name='script'}
<script type="text/javascript">

$(document).ready(function(){
   
    if($(window).height() > 300)
        $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
    else
        $('#employee_tab_content_pdf_form').css({ height: $(window).height()});  
        
});

function loadCustomers(){
   

    var year = $("#year").val();
    var month = $("#month").val();
    navigatePage('{$url_path}leave_vab_pdf_edited.php?'+year+'&'+month+'',8);
}

function loadEmployees(){
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    navigatePage('{$url_path}leave_vab_pdf_edited.php?'+year+'&'+month+'&'+customer+'',8);
}

function submitForm(){
    $("#forms").attr('target', '_self');
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    var employee =$("#employee").val();
    navigatePage('{$url_path}leave_vab_pdf_edited.php?'+year+'&'+month+'&'+customer+'&'+employee+'',8);
}

function printSickDetailsReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('printSickDetailsReport');
        f.submit();
    }
}

function printWorkReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_BLANK');
        $('#action').val('printWorkReport');
        f.submit();
    }
}

</script>
{/block}


{block name="content"}
	<div class="row-fluid">
		<div class="span12 main-left" style="overflow:hidden; height: 623px;">
			<div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
	        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
	            <div class="panel-heading" style="">
	                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
	                    {$translate.vab_leave_report}
	                    <ul class="pull-right">
	                        <li><i class="icon-arrow-left"></i><a href="{$url_path}forms/"><span class="special_spn">{$translate.backs}</span></a></li>
	                        <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}leave_vab_pdf_edited.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
	                    </ul>
	                </h4>
	            </div>
	        </div>

	        <form name="forms" id="forms" method="post" action="{$url_path}pdf/vab/leave/">
            	<input type="hidden" name="action" id="action" value="" />
            	<input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
            	<div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
            		<div id="employee_tab_content_pdf_form" class="span12" style="background: none repeat scroll 0 0 #ffffff;border: 1px solid #dcdcdc;padding: 15px; overflow-y: auto;">
            			<div class="span12" name="leave_inputs" id="leave_inputs">
	                        <div class="span8">
	                            <div class="span12">
	                                <span class="span6">
	                                    <label class="pull-left span3">{$translate.year}:</label>
	                                    <select id="year" name="year" style="border:solid 1px #d9d9d9">
	                                        <option value="">{$translate.select}</option>
	                                        {html_options values=$years_combo selected=$report_year output=$years_combo}
	                                    </select>
	                                </span>
	                                <span class="span6"> <label class="pull-left span3">{$translate.month}: </label>
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
	                            </div>
	                            <div class="span12 no-ml">
	                                <span class="span6"> <label class="pull-left span3">{$translate.choose_user}</label>
	                                    <select id="customer" name="customer" onchange="loadEmployees()" style="border:solid 1px #d9d9d9">
	                                        <option value="">{$translate.select}</option>
	                                        {if $customers|count gt 1}
	                                            <option value="ALL" {if $cust == 'ALL' or $selected_all_customers eq TRUE}selected="selected" {/if}>{$translate.all}</option>
	                                        {/if}
	                                        {foreach from=$customers item=customer}
	                                            <option value="{$customer.customer_id}" {if $cust== $customer.customer_id}selected="selected" {/if} >{if $sort_by_name == 1}{$customer.cust_ff}{elseif $sort_by_name == 2}{$customer.cust}{/if}</option>
	                                        {/foreach}
	                                    </select>
	                                </span>
	                                <span class="span6"><label class="pull-left span3">{$translate.choose_assistant}: </label>
	                                    <select id="employee" name="employee" onchange="submitForm()" style="border:solid 1px #d9d9d9">
	                                        <option value="">{$translate.select}</option>
	                                        {if $employees|count gt 1}
	                                            <option value="ALL" {if $emp == 'ALL' or $selected_all_employees eq TRUE}selected="selected" {/if}>{$translate.all}</option>
	                                        {/if}
	                                        {foreach from=$employees item=employee}
	                                            <option value="{$employee.employee_id}" {if $emp == $employee.employee_id}selected="selected" {/if} >{if $sort_by_name == 1}{$employee.employee_ff}{elseif $sort_by_name == 2}{$employee.employee}{/if}</option>
	                                        {/foreach}
	                                    </select>
	                                </span>
	                            </div>
	                        </div>
	                        <span style="" class="span4 pull-right">
	                            {*if $show_work_report_button*}
	                            {if $cust != '' or $selected_all_customers eq TRUE}
	                                <button type="button" onclick="printWorkReport();" class="btn btn-primary pull-right no-mr ml"><i class="icon-file-text"></i> {$translate.print_work_report}</button>
	                                <button type="button" onclick="printSickDetailsReport();" class="btn btn-primary pull-right mr"><i class="icon-file-text"></i> {if $login_company_id eq 8}{$translate.print_sick_details_report_optimal}{else}{$translate.print_vab_details_report}{/if}</button>
	                            {/if}
	                        </span>
                        
	                        {if $relations}
	                            <span class="form-section-highlight span12 no-ml mt">
	                                <h5>{$translate.vab_period} {$relations[0]['date']} till {$relations[($relations|@count)-1]['date']}</h5>
	                                <hr>
	                                <div class="table-responsive">
	                                <table border="1px solid" cellspacing="0" cellpadding="5" class="table table-bordered table-striped" style="border-color: rgb(228, 228, 228); text-align: center;">
	                                    <tbody>
	                                        <tr>
	                                            <td width="265"><strong>Namn p&aring; vikarie</strong></td>
	                                            <td width="113"><strong>Datum</strong></td>
	                                            <td width="98"><strong>Klockslag</strong></td>
	                                            <td width="39"><strong>L&ouml;ntyp</strong></td>
	                                            <td width="49"><strong>Ant tim</strong></td>
	                                            {*<td width="25"><strong>Timl&ouml;n</strong></td>*}
	                                            <td width="35"><strong>Soc.</strong></td>
	                                        </tr>
	                                        {assign i 0}
	                                        {foreach from=$relations item=relation}
	                                            <tr>
	                                                <td>{$relation.employee}</td>
	                                                <td>{$relation.date}</td>
	                                                <td>{$relation.time_from} - {$relation.time_to}</td>
	                                                <td>{$relation.inconv}</td>
	                                                <td>{$relation.tot_time}</td>
	                                                {*assign style_input ''}
	                                                {if $relation.repeat eq '1'} {assign style_input 'border:solid 1px #d9d9d9; display: none;'}{else}{assign style_input 'border:solid 1px #d9d9d9;'} {/if*}
	                                                {*<td style="padding-left: 8px"><input type="text" name="time_{$i}" id="time_{$i}" size="6" style="{$style_input}"/></td>*}
	        {*                                            <td style="padding-left: 8px"><input type="text" name="soc[]" id="soc_{$i}" size="6"  value="{if $relation.age < 25}{$below_25}{else if $relation.age < 65}{$btwn_25_65}{else if $relation.age >= 65}{$above_65}{/if}"/></td>*}
	                                                <td style="padding-left: 8px">{if $relation.age < 25}{$below_25}{else if $relation.age < 65}{$btwn_25_65}{else if $relation.age >= 65}{$above_65}{/if}</td>
	                                            </tr> 
	                                            {assign i $i+1}
	                                        {/foreach}
	                                        <input type="hidden" name="tot_rows" id="tot_rows" value="{$i}" />
	                                    </tbody>
	                                </table>
	                                </div>
	                                <p>Summering hela m&aring;naden: {$total_vikari_hours} tim</p>
	                               
	                            </span>
	                        {/if}
                    	</div>
            		</div>
            	</div>
            </form>
		</div>
	</div>
{/block}