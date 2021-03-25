{block name='style'}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" type="text/css" /><!-- DATE PICKER -->
{/block}


{block name="content"}
	<div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.Contract_Employee_List}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:document.location.href='{$url_path}reports/'">{$translate.backs}</button>
                    {if $contract_details}
                    	<button type="button" class="btn pull-right mr" onclick="print_pdf()"><i class="icon-print">{$translate.print}</i></button>
                    {/if}
                </div>
            </div>

            
            <div class="span12 widget-body-section input-group">
                <div class="span12 widget-body-section input-group">
                    <div class="widget-body" style="padding:5px;">

                    	 <div class="row-fluid" style="margin-bottom:15px;">
                    	 	<form name="contract_emp_form" id="contract_emp_form" method="post" action="{$url_path}contract/employee/report/list/" target="_self">
	                    	 	<input type="hidden" name="action" id="action" value="">
	                    	 	<div class="span3">
	                	 			<input type="radio" name="contract_employee" {if $type_of_contract eq 1} checked="true" {/if}  value="1">
	                	 			<span style="margin-left: 5px;">{$translate.Employee_With_Active_Contract}</span>
	                    	 	</div>
	                    	 	<div class="span3">
	                	 			<input type="radio" name="contract_employee"  value="2" {if $type_of_contract eq 2} checked="true" {/if}>
	                	 			<span style="margin-left: 5px;">{$translate.Employee_With_Contract_Expired}</span>
	                    	 	</div>
	                    	 	<div class="span3">
	                	 			<input type="radio" name="contract_employee"  value="3" {if $type_of_contract eq 3} checked="true" {/if}>
	                	 			<span style="margin-left: 5px;">{$translate.Employee_Without_Contract}</span>
	                    	 	</div>

	                    	 	<div class="span2" style="margin: 0px ! important; padding: 0px;">
                                    <!-- <label class="span12" style="float: left;">{$translate.from_date}:</label> -->
                                    <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker datepicker span10 no-padding"> 
                                        <span class="add-on icon icon-calendar"></span>
                                        <input class="form-control span12" type="text" name="expiry_date" id="expiry_date" value="{$current_date}" />
                                    </div>
                                </div>



	                    	 	<div class="span1">
	                	 			<button type="button" name="show_contract" class="btn btn-primary"  onclick="contract()">{$translate.show}</button>
	                    	 	</div>
	                    	 </form>
                    	 </div>
                    	 {if $contract_details}
	                    	 <div style="" class="row-fluid">
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
	                                                                {if $contract_details.expired_contract ||$contract_details.active_contract}
	                                                                	<th class="header">{$translate.Contract_Start_Date}</th>
	                                                                	<th class="header">{$translate.Contract_Expiry_Date}</th>
	                                                                {/if}
	                                                            </tr>
	                                                        </thead>

	                                                        <tbody>
	                                                        	{if $contract_details.expired_contract}
		                                                            {foreach from=$contract_details.expired_contract key=key item=value}
																	  <tr>
																	  	<td>{$key+1}</td>
																	  	{foreach key=key2 item=item from=$value}
																	  		{if $key2 eq 'date_from'}
																			  	<td>
																			  		<a href="{$url_path}employment/contract/pdf/{$value['employee']}/{$value['id']}/" target="_blank" style="color: #1414a5;text-decoration-line: underline;">{$item}</a>
																			  	</td>
																			{else}
																		  		<td>{$item}</td>
																			{/if}
																			{if $key2 == 'contract_expiry_date'} 		{break} 
																			{/if}
																	  	{/foreach}
																	  </tr>
																	{/foreach}
																{/if}

																{if $contract_details.active_contract}
																	{assign i 1}
		                                                            {foreach from=$contract_details.active_contract key=key item=value}
																	  <tr>
																	  	{foreach key=key2 item=item from=$value}
																	  		{if $key2 eq 'emp_name'}
																	  			{if $item neq $old_value}
																	  				<td rowspan="{$value['count']}">{$i++}</td>
																		  			<td rowspan="{$value['count']}">
																			  			{$value['emp_name']}
																			  		</td>
																			  		{assign old_value $item}
																		  		{else}
																		  		{/if}
																		  	{else}
																		  			{if $key2 eq 'date_from' }
																		  				<td>
																		  					{if $contract_privilege eq 1}<a href="{$url_path}employment/contract/pdf/{$value['employee']}/{$value['id']}/" style="color: #1414a5;text-decoration-line: underline;" target="_blank">{$item}</a>{else} {$item}{/if}
																		  					<!-- {$contract_privilege eq 1 } ? <a href="{$url_path}employment/contract/pdf/{$value['employee']}/{$value['id']}/">{$item}</a> : {$item}; -->
																		  				</td>
																		  			{else}
																		  				<td>{$item}</td>
																		  			{/if}
																			  	{if $key2 == 'contract_expiry_date'} {break} {/if}	

																			{/if}
																	  	{/foreach}
																	  </tr>
																	{/foreach}
																{/if}

																{if $contract_details.without_contract}
		                                                            {foreach from=$contract_details.without_contract key=key item=value}
																	  <tr>
																	  	<td>{$key+1}</td>
																	  	{foreach key=key2 item=item from=$value}
																		  	<td>
																		  		{$item}
																		  	</td>
																	  	{/foreach}
																	  </tr>
																	{/foreach}
																{/if}

	                                                        </tbody>

	                                                    </table>
	                                                </div>
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

	function print_pdf(){
		var f = $('#contract_emp_form');
		f.attr('target','_blank');
		$('#action').val('print_pdf');
		f.submit();
	}
	function contract(){
		var f = $('#contract_emp_form');
		f.attr('target','_self');
		$('#action').val('show_contract');
		f.submit();
	}
</script>
{/block}