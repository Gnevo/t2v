{block name='style'}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}

{block name='script'}
<script type="text/javascript" src="{$url_path}js/date-picker.js"></script>
 <script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		if($(window).height() > 600)
        	$('.main-left').css({ height: $(window).height()-105});
    	else
        	$('.main-left').css({ height: $(window).height()});


	     $(".datepicker").datepicker({
	        autoclose: true,
	        weekStart: 1,
	        calendarWeeks: true, 
	        language: '{$lang}'
	    });
	});

	$( "#employee_select" ).change(function() {
		// console.log('{$check_employee_signed}');
		 // {$check_employee_signed} ? $('#leave_inputs').show() : $('#leave_inputs').hide();
		// $('#leave_inputs').();
 		 var empid = $('#employee_select').val();
 		 $('#termination_date,#city').removeAttr("disabled", "disabled"); 
 		  $.ajax({
            // async:false,
            url:"{$url_path}ajax_employee_termination.php",
            data:"id="+empid,
            type:"POST",
            success:function(data){
            	$('#employee_detail_row1,#employee_detail_row2').empty();
            	data = JSON.parse(data);
            	// console.log(data);
            	data.emp_sign_det == null ? $('#leave_inputs').hide() : ($('#leave_inputs').show(), $('#date_of_sign').val(data.emp_sign_det.date_of_sign), $('#city').val(data.emp_basic_det.city)); 
            	// data.emp_sign_det != null ? $('#city').val(data.emp_basic_det.city) : '' ;
            	// console.log(data);	
				// $('#date_of_sign').val(data.emp_sign_det.date_of_sign)
				if(data.emp_sign_det != null){
            		$("#termination_date").attr('value',data.emp_sign_det.date_of_termination);
            		$('#termination_date').datepicker('update', data.emp_sign_det.date_of_termination);
            	}
            	$('#employee_detail_row1').append('<td  width = "50%"><span>{$translate.address}</span><br>'+data.emp_basic_det.address+'</td><td width = "50%"><span>{$translate.social_security}</span><br>'+data.emp_basic_det.century+data.emp_basic_det.social_security+'</td>');	
            	$('#employee_detail_row2').append('<td width = "50%"><span>{$translate.post}</span><br>'+data.emp_basic_det.post+'</td><td width = "50%"><span>{$translate.city}</span><br>'+data.emp_basic_det.city+'</td><input type = hidden id="employee" value='+data.emp_basic_det.username+'>');	
                if(data.emp_sign_det){
                	$('#sign_div').empty();
                	$('#sign_div').append('<div class="row-fluid"><div class="span6" style="margin: 10px 10px 0px;"><label class="span12">{$translate.password}</label><div class="span12" style="margin:0px auto;"><input type="password" name="password" id="password" ></div></div><div class="span4" style="margin: 36px 0px 0px;"><div class="span12" style="margin:0px auto;"><button type="button" name="save_sign" id="save_sign" class="btn btn-primary" onclick="save_sign()">sign and save</button></div></div></div><div class="row-fluid" id="reject_div" style="margin-left:10px !important"><div class="span4"><button type="button" class="btn btn-danger" id = "rejection"  >{$translate.employee_reject}</button></div><div id="reject_save" style="display:none;"><div class="span12">{$translate.reject_reason}</div><div class ="span6 no-ml"><input type = "text" style="margin-top:3px;" id="reject_reason"></div><div class="span2"><button class="btn btn-success" onclick = "save_reject()"><span class="icon-save"></span>{$translate.reject_save}</button></div></div></div>');
                }
                else{
                	$('#sign_div').empty();
                	// $('#sign_div').append('<div class="span12" style="margin: 10px 10px 0px;"><label class="span12"><i>e-signering via Time2View</i></label><br><label class="span12" style="margin: auto;">'+data.emp_sign_det.appr_date+'</label><br></div>');
                }
                if(data.emp_sign_det_all){
                	$('#employee_terminations').empty();
                	$('#employee_terminations').append('<option>{$translate.select}</option>');
                	$.each(data.emp_sign_det_all.reverse(), function (index, value){
                		var reject;
                		data.emp_sign_det_all[index].reject_reason != null ? reject = '{$translate.rejected}'  : reject = ''; 
                		$('#employee_terminations').append('<option data-id ='+data.emp_sign_det_all[index].id+'  value="'+data.emp_sign_det_all[index].appr_date+'_'+data.emp_sign_det_all[index].appr_emp+'">'+data.emp_sign_det_all[index].appr_date+'&nbsp'+reject+'   </option>');
					});
                }
            }
        });
	});

	function save_sign() {
		var employee_select  = $('#employee_select').val();
		var termination_date = $('#termination_date').val();
		var sign_date        = $('#sign_date').val();
		var city             = $('#city').val();
		var password         = $('#password').val();
		var date_of_sign     = $('#date_of_sign').val();
		if(termination_date && sign_date && city && password){
			$.ajax({
			  type: "POST",
			  url: '{$url_path}ajax_employee_termination.php',
			  data: { 'date_of_sign': date_of_sign,'termination_date': termination_date, 'sign_date': sign_date, 'city': city, 'password': password,'employee_select': employee_select, 'action': 'save_sign'},
			  success:function(data){
			  	data = JSON.parse(data);
			  	if(data == 'error_password'){
			  		bootbox.dialog('{$translate.employee_termination_password_nomatch}', [
	                {
	                    "label" : "{$translate.ok}",
	                    "class" : "btn-primary",
	                },
	          		]);
			  	}
			  	else{
			  		if(data.success == 'employee_success')
			  	 		navigatePage('{$url_path}employee/termination/',8);
			  	 	else{
			  	 		$('#sign_div').empty();
			  	 		$('#sign_div').append('<div class="span12" style="margin: 10px 10px 0px;"><label class="span12"><i>e-signering via Time2View</i></label><br><label class="span12" style="margin: auto;">'+data.date+'</label><br></div>');
			  	 		$('#apprd_date').val(data.date);
			  	 	}
			  	} 
			  	
			  }
			});
		}
		else{
			bootbox.dialog('{$translate.employee_termination_feild_require}', [
	                {
	                    "label" : "{$translate.ok}",
	                    "class" : "btn-primary",
	                },
	          ]);
		}
		
	}

	 $(document).on( "focus", "#reject_reason", function(event) {
			$('#reject_reason').css('border-color','');
     });

	function save_reject(){
		var employee_select  = $('#employee_select').val();
		var termination_date = $('#termination_date').val();
		var sign_date        = $('#sign_date').val();
		var city             = $('#city').val();
		var password         = $('#password').val();
		var date_of_sign     = $('#date_of_sign').val();
		var reject_reason	 = $('#reject_reason').val();
		
		if(termination_date && sign_date && city && reject_reason){
			$.ajax({
			  type: "POST",
			  url: '{$url_path}ajax_employee_termination.php',
			  data: { 'date_of_sign': date_of_sign,'termination_date': termination_date, 'sign_date': sign_date, 'city': city, 'reject_reason': reject_reason,'employee_select': employee_select, 'action': 'reject_save'},
			  success:function(data){
			  	
			  	data = JSON.parse(data);
			  	
			  	if(data == 'error_password'){
			  		bootbox.dialog('{$translate.employee_termination_password_nomatch}', [
	                {
	                    "label" : "{$translate.ok}",
	                    "class" : "btn-primary",
	                },
	          		]);
			  	}
			  	else{
			  		if(data.success == 'reject_success'){
			  			
			  	 		$('#sign_div').empty();
			  	 		$('#sign_div').append('<div class="span12" style="margin: 10px 10px 0px;"><label class="span12">{$translate.reject_reason} : '+data.reject_reason+'</label><br><label class="span12" style="margin: auto;">'+data.date+' '+'{$translate.rejected}'+'</label><br></div>');
			  	 	}
			  	} 
			  	
			  }
			});
		}
		else{
			bootbox.dialog('{$translate.employee_termination_feild_require}', [
	                {
	                    "label" : "{$translate.ok}",
	                    "class" : "btn-primary",
	                },
	          ]);
		}

		// if(reject_reason != ''){
		// 	alert();
		// 	$('#reject_reason').css('border-color','');
		// }
		// else{
		// 	$('#reject_reason').css('border-color','red');
		// 	return false;
		// }

	}

	$( "#employee_terminations" ).change(function() {
		var sign_id = $( "#employee_terminations" ).children('option:selected').attr('data-id');
		var empid   = $('#employee_select').val();
		var appr_date = $("#employee_terminations option:selected").text();
		if(sign_id == undefined){
			$( "#employee_select").trigger("change");
		}
		else{
			wrapLoader("#employee_tab_content_pdf_form");
 		  	$.ajax({
           		// async:false,
            	url:"{$url_path}ajax_employee_termination.php",
            	data:{ 'sign_id' : sign_id, 'action' : 'get_signed_det'},
            	type:"POST",
            	success:function(data){
            		data = JSON.parse(data);
            		console.log(data);
            		var action = data.reject_reason == null ? action = '<i>e-signering via Time2View</i>'  :  action = '{$translate.reject_reason} : '+data.reject_reason+'';
            		$('#termination_date').datepicker('update', data.date_of_termination);
            		$('#termination_date,#city').attr("disabled", "disabled"); 
            		$('#sign_date').val(data.date);
            		$('#sign_div').empty();
            		$('#sign_div').append('<div class="span12" style="margin: 10px 10px 0px;"><label class="span12">'+action+'</label><br><label class="span12" style="margin: auto;">'+appr_date+'</label><br></div>');

            		uwrapLoader("#employee_tab_content_pdf_form");
            	}
         	})
 		}
		$('#leave_inputs').show();
		// $('#employee_select').trigger("change");
		// uwrapLoader("#employee_tab_content_pdf_form");
	});

	function print_pdf(){
		var f = $('#termination_from');
		f.attr('target','_blank');
		$('#action').val('print_pdf');
		f.submit();
	}


	$(document).on('click','#rejection',function(){
		$(this).parent('div').remove();
		$('#reject_save').show();
	});

	


</script>

{/block}


{block name='content'}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                	{$translate.employee_termination_form}
                    <ul class="pull-right">
                        <li> <i class="icon-arrow-left"></i> <a href="{$url_path}forms/"><span class="special_spn">{$translate.backs}</span></a></li>
                        <li> <i class="icon-refresh"></i> <a href="javascript:void(0);" onclick="navigatePage('{$url_path}employee/termination/',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                        {if $user_role == 1 || $user_role == 6}
                        	<li> <i class="icon-print"></i><a href="javascript:void(0);" onclick="print_pdf()"><span class="special_spn">{$translate.print}</span></a></li>
                        {/if}
                    </ul>
                </h4>
            </div>
        </div>
	        <div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
	        	
		           	<div id="employee_tab_content_pdf_form" class="span12" style="background: none repeat scroll 0 0 #ffffff;border: 1px solid #dcdcdc;padding: 15px;">
		           		{if $user_role == 1 || $user_role == 6}
		           		<form method="post" action="{$url_path}employee/termination/" id="termination_from" name="termination_from">
			           		<input type="hidden" name="action" id="action" value="">
			           		<input type="hidden" name="apprd_date" id= "apprd_date" value="">
			           		<div class="span12" id="select_emloyee" style="padding: 5px 0 10px 0;">
				           		<div class="span6">	
				           			<div class="span3">
				           				<span style="padding-left: 10px;">{$translate.select} {$translate.employee}</span>
				           			</div>
				    				<select name="employee_select" id="employee_select">
				            			<option>{$translate.select}</option>
				            			{foreach from=$employee_detail item=entries}
				                            <option value={$entries.employee} >{$entries.emp_name}</option>
				                        {/foreach}
				                    </select>
				                </div>
				           		<div class="span6">	
				                    <div class="span2" id="appr_date">
				           				<span style="padding-left: 10px;">{$translate.past_form}</span>
				           			</div>
					    				<select name="employee_terminations" id="employee_terminations">
					            			<option data-id = " ">{$translate.select}</option>
					            			<!-- {foreach from=$employee_detail item=entries}
					                            <option value={$entries.employee} >{$entries.emp_name}</option>
					                        {/foreach} -->
					                    </select>
				                </div>
			    			</div>
			    		</form>
			    			

			    		{/if}
		           		<div class="span12" name="leave_inputs" id="leave_inputs"  style="margin: 10px auto;{if $user_role == 1 || $user_role == 6}display: none;{/if}">
		           			<div class="span12" style="border: 2px solid #dcdcdc;padding: 5px;">
		                        <div class="span12 panel-title no-mb clearfix" style="border: 1px solid #dcdcdc;padding: 5px;">
		                        	<h4>{$translate.employer}</h4>
		                        </div>
		                        <div class="span12" style="border: 2px solid #dcdcdc;margin: 10px auto;">
		                        	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="tbl_border" >
		                                <tr> <td colspan="2"><span>{$translate.company}</span><br>{$company_detail.name}</td> </tr>
		                                <tr>
		                                	<td width="50%"><span>{$translate.address}</span><br>{$company_detail.address}</td>
		                                	<td width="50%"><span>{$translate.organization_number}</span><br>{$company_detail.org_no}</td>
		                                </tr>
		                                <tr>
		                                	<td width="50%"><span>{$translate.post}</span><br>{$company_detail.zipcode}</td>
		                                	<td width="50%"><span>{$translate.city}</span><br>{$company_detail.city}</td>
		                                </tr>
		                               
		                            </table>
		                        </div>
		                        
			                        <div class="span12 panel-title no-mb clearfix" style="border: 1px solid #dcdcdc;margin: 10px auto;">
			                        	<h4>{$translate.employee}</h4>
			                        </div>

			                        <div class="span12" style="border: 2px solid #dcdcdc;margin: 10px auto;">
			                        	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="tbl_border" >
			                               
			                                <tr id="employee_detail_row1">
			                                	<td width="50%"><span>{$translate.address}</span><br>{$login_emp_detail.address}</td>
			                                	<td width="50%"><span>{$translate.social_security}</span><br>{$login_emp_detail.century}{$login_emp_detail.social_security}</td>
			                                	
			                                </tr>
			                                <tr id="employee_detail_row2">
			                                	<td width="50%"><span>{$translate.post}</span><br>{$login_emp_detail.post}</td>
			                                	<td width="50%"><span>{$translate.city}</span><br>{$login_emp_detail.city}</td>	
			                                </tr>
			                               
			                            </table>
			                        </div>
			                   
		                    </div>
		                    <div class="span12" style="border: 2px solid #dcdcdc;margin: 10px auto;">
			                    <div class="span12" style="margin: 5px 0px 0px 10px;">
			                    	Härmed säger jag upp mig från min anställning hos  <strong>{$company_detail.name}</strong>
			                    </div>

			                    <div class="span12" style="margin: 10px 0px 0px 10px;" >
			                    	<span>och min sista anställningsdag är</span>
			                    	<input type="hidden" id="date_of_sign" value="">
			                    	<input type="text" name="termination_date" id="termination_date" class="datepicker" {if $check_employee_signed } value="{$check_employee_signed.date_of_termination}" disabled="disabled" {else} value="{$login_emp_detail.date_inactive}" {/if} style="margin: auto;">
			                    </div>
			                </div>

			                <div class="span12" style="border: 2px solid #dcdcdc;margin: 10px auto;">
			                	<div class="span6">
				                	<div class="span12" style="margin: 10px 10px 0px;">
					                	<label class="span12">{$translate.employee_termination_date}</label>
					                	<div class="span12" style="margin:0px auto;">
					                		<input type="text" name="current_date_Picker" id="sign_date" value="{$current_date}" readonly="readonly">
					                	</div>
				                	</div>

				                	<div class="span12" style="margin: 10px 10px 0px;">
					                	<label class="span12">{$translate.city}</label>
					                	<div class="span12" style="margin:0px auto;">
					                		<input type="text" name="city" id="city" value="{$login_emp_detail.city}">
					                	</div>
				                	</div>
				                </div>
				                <div class="span6 no-ml" id="sign_div" value="{$user_role}" style="margin-left:6px !important">
				                	{if $user_role eq 1 || $user_role eq 6}
				                	
						                	<!-- <div class="span12" style="margin: 10px 10px 0px;">
							                	<label class="span12">{$translate.password}</label>
							                	<div class="span12" style="margin:0px auto;">
							                		<input type="password" name="password" id="password" >
							                	</div>
						                	</div>
						                	<div class="span12" style="margin: 10px 10px 0px;">
							                	<div class="span12" style="margin:0px auto;">
							                		<button type="button" name="save_sign" id="save_sign" class="btn btn-primary" onclick="save_sign()">sign and save</button>
							                	</div>
						                	</div> -->
						               
					                {else}
					                	{if $check_employee_signed}
					                		<div class="span12" style="margin: 10px 10px 0px;">
							                	<label class="span12"><i>e-signering via Time2View</i></label><br>
							                	<label class="span12" style="margin: auto;">{$check_employee_signed.date_of_sign}</label><br>
						                	</div>
						                {else}
						                	<div class="span6" style="margin: 10px 10px 0px;">
							                	<label class="span12">{$translate.password}</label>
							                	<div class="span12" style="margin:0px auto;">
							                		<input type="password" name="password" id="password" >
							                	</div>
						                	</div>
						                	<div class="span4" style="margin: 36px 0px 0px;">
							                	<div class="span12" style="margin:0px auto;">
							                		<button type="button" name="save_sign" id="save_sign" class="btn btn-primary" onclick="save_sign()">{$translate.sign_and_save}</button>
							                	</div>
						                	</div>
						                {/if}
					                {/if}

					            	
				                </div>
			                </div>
		           		</div>
			       	
		           	</div>   
	        </div>

    </div>
</div>
{/block}
