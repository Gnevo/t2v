{block name='style'}
    <link href="{$url_path}css/color-wheel.css" rel="stylesheet" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style>
        .underline_link { text-decoration: underline;}
        .btn-precise{
        	padding : 5px !important;
        	margin  : 5px !important;
        }
        #right_panel{
        	padding-right: 10px !important;
        }
        .small-input{
			width: 50px;
			height: 30px;
        }
        table tbody tr td > .day-report{ height: auto !important;}
        #day_wrapper .toggler-class:before{ content: "\f077"; }
        #day_wrapper .collapsed .toggler-class:before { content: "\f078"; }
    </style>
{/block}

{block name='script'}
	<script src="{$url_path}js/date-picker.js"></script>
	<script async src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
	<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
	<script type="text/javascript">

	function redirectConfirm(mode){
        var redirectURL = mode.replace("%%C-UNAME%%", "{$employee_username}");
        if(redirectURL != ''){
                document.location.href = redirectURL;
        }
    }

	

	$('.btn-add-new').click(function(){
		$('#group_id').val('');
		$('#left-panel').css('width','60%');
		$('#right_panel').removeClass('hide');
		$('#right_panel').addClass('show');
		$('#right_panel').css('width','38%');
		$('.empty-all,#from_date,#to_date').val('');
		$('.remove-intervals').trigger('click');
		// $('.collapse').collapse('show');
		// $('.collapse').collapse();

		$('.day-show .panel-title:not(.collapsed)').trigger('click');

	});

	$('.btn-cancel-right').click(function(){
		$('#left-panel').css('width','100%');
		$('#right_panel').css('width','0%');
		$('#right_panel').removeClass('show');
		$('#right_panel').addClass('hide');
		$('.empty-all').val('');
		$('.remove-intervals').trigger('click');
		// $('.collapse').collapse();
		// $('.collapse').collapse({
		//     toggle: false
		// })
		// $('.collapse').collapse('hide');
	});

	$('.add-new-intervals').click(function(){
		var day  = $(this).closest('.panel-body').data('day');
		var html = '<div class="span12 row-fluid no-ml interval-div">\n\
						<div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
						<div class="span2">{$translate.emp_non_prefr_time_from}</div>\n\
						<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>\n\
						<div class="span2">{$translate.emp_non_prefr_time_to}</div>\n\
						<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>\n\
					<div>';
		$(this).closest('.panel-body').append(html);
	});

	

	$(function(){
		$(".datepicker").datepicker({
	        autoclose: true,
	        weekStart: 1,
	        calendarWeeks: true, 
	        language: '{$lang}'
    	}).on('changeDate', function(ev){
    		var fromDate = $('#from_date').val();
    		var toDate   = $('#to_date').val();
    		var daysForshow = [7,1,2,3,4,5,6]; // 7 -sunday ... 6-saturday
    		
    		if(fromDate != '' && toDate == ''){
    			var dayObj = new Date(fromDate);
    			var day = daysForshow[dayObj.getDay()];
    			$('.day-show').hide();
    			$('#day_show'+day).show();
    		}
    		else{
    			$('.day-show').hide();
				var startDate = new Date(fromDate); //YYYY-MM-DD
				var endDate   = new Date(toDate);
				var dates     = getDateArray(startDate, endDate);
				if(dates.length >= 7){
					$('.day-show').show();
				}
				else{
					dates.forEach(function(value, key){
						$('#day_show'+daysForshow[value]).show();
					});
				}
    		}
            /*if(typeof ev.date != 'undefined' && ev.date != ''){
                console.log($.datepicker.formatDate('yy-mm-dd', ev.date));
            }*/
        });
	});

	function getDateArray(start, end) {
		var days = new Array();
		var dt  = new Date(start);
	    while (dt <= end) {
	        days.push(new Date(dt).getDay());
	        dt.setDate(dt.getDate() + 1);
	    }
	    return days;
	}



	
	$(document).on("click",".remove-intervals",function() {
    	$(this).closest('.row-fluid').remove();
	});

	function handleTimeInterval(){
		var interval    = [];
		var dayInterval = {}; 
		var isOverlape  = 0 ;
		var fromDate 	= $('#from_date').val();
		var toDate 		= $('#to_date').val(); 
		if(fromDate == ''){
			bootbox.alert('{$translate.from_date_is_mandatory}', function(result){ });
		}
		else{
			toDate != '' ? toDate : toDate = fromDate ;
			$('#right_panel .interval-div').each(function( index ) {
				var timeFrom = time_to_sixty($(this).find('.time-from').val());
				var timeTo   = time_to_sixty($(this).find('.time-to').val());
				if(timeTo == 0)timeTo=24;
				var day      = $(this).closest('.panel-body').data('day'); // 1 = monday ... 7 = sunday 
				if(timeFrom !== false && timeTo !== false){
					timeFrom = parseFloat(timeFrom);
					timeTo   = parseFloat(timeTo);
					if(timeFrom < timeTo){
						if(typeof dayInterval[day] == "undefined")
							dayInterval[day] = [];
						dayInterval[day].push({ 'timeFrom':timeFrom, 'timeTo' : timeTo});
					}
				}
			});
			//console.log(dayInterval);
			if(Object.keys(dayInterval).length > 0){
				for (var key in dayInterval) { 
					dayInterval[key].sort(function(a, b){ // sorting each day increasing order of timeFrom.
				    	return a.timeFrom-b.timeFrom;
					});
					for (var i = 1; i < dayInterval[key].length; i++) { // checking for overlapping time periods.
						if(dayInterval[key][i].timeFrom < dayInterval[key][i-1].timeTo){
							isOverlape = 1;
							break;
						}
					}
					if(isOverlape == 1)
						break;
				}
				if(isOverlape == 1){
					bootbox.alert('{$translate.time_intervals_are_overlapping}', function(result){ });
				}
				else{
					var data;
					if($('#group_id').val() != ''){ // edit
						data = { 'group_id':$('#group_id').val(),'dayInterval':dayInterval ,'username':'{$employee_username}' ,'fromDate':fromDate, 'toDate':toDate,'action':'edit_time_interval', 'preference_mode': '{$preference_mode}'}
					}
					else{
						data = { 'dayInterval':dayInterval ,'username':'{$employee_username}' ,'fromDate':fromDate, 'toDate':toDate,'action':'save_time_interval', 'preference_mode': '{$preference_mode}'}
					}
					$.ajax({
						url:"{$url_path}employee_non_prefered_timings.php",
						type:'POST',
						datetype:'json',
						data:data,
						success:function(data){
							data = JSON.parse(data);
							// console.log(data);
							// return false;
							if(data.result_flag == false){
								$('#error_message').html(data.error_message);
							}
							else{
								location.href = '{$url_path}employee/non-prefered/timing/{$employee_username}/{$preference_mode}/';
							}
						}
					});
				}
			}
			else{
				bootbox.alert('{$translate.no_time_interval_is_selected}', function(result){ });
			}
		}
	}

	function delete_non_prefered_time(group_id){
		bootbox.dialog('{$translate.do_u_want_delete}', [
		{
		    "label" : "{$translate.no}",
		    "class" : "btn-danger",
		},
		 {							
		    "label" : "{$translate.yes}",
		    "class" : "btn-success",
		    "callback": function() {
				if(group_id){
					$.ajax({
						url:"{$url_path}employee_non_prefered_timings.php",
						type:'POST',
						datetype:'json',
						data:{ 'group_id':group_id , 'action':'delete_time_interval'},
						success:function(data){
							// console.log(data);
							// console.log(JSON.parse(data));
							data = JSON.parse(data);
							if(data.result_flag == true){
								location.href = '{$url_path}employee/non-prefered/timing/{$employee_username}/{$preference_mode}/';
							}
							else{
								$('#main_message').html(data.error_message);
							}
						}
					});
				}
			   }
		 	}
	  	]);
	}

	function append_new_interval(timeForm, timeTo){
		var html = '<div class="span12 row-fluid no-ml interval-div">\n\
						<div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
						<div class="span2">{$translate.emp_non_prefr_time_from}</div>\n\
						<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" value = '+timeForm+' ></div>\n\
						<div class="span2">{$translate.emp_non_prefr_time_to}</div>\n\
						<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" value = '+timeTo+' ></div>\n\
					<div>';
		return html;
	}

	function edit_non_prefered_time(dateRange,groupId){
		// $('.day-show .panel-title:not(.collapsed)').trigger('click');
		// $('.panel-title.collapsed').siblings('.in.collapse').prev('.panel-title.collapsed').trigger('click');
		
		// $('.collapse').collapse('hide');
		var prevDay = '';
		$('.panel-body').find('.no-ml.interval-div').remove();
		$('.btn-add-new').trigger('click');
		// $('.day-show .panel-title:not(.collapsed)').trigger('click');
		$('.day-show').show();
		$('#group_id').val(groupId);
		$('#from_date').val(dateRange[0].date_from);
		$('#to_date').val(dateRange[0].date_to);
		setTimeout(function(){
			dateRange.forEach(function(value ,key){
				 // console.log($('#day'+value.day).collapse('show'));
				$('.day-show#day_show'+value.day+' .panel-title').trigger('click');
				if(prevDay != value.day){
					$('#day'+value.day).find('.time-from').val(value.time_from);
					$('#day'+value.day).find('.time-to').val(value.time_to);
				}
				else{
					var html = append_new_interval(value.time_from,value.time_to)
					$('#day'+value.day).find('.panel-body').append(html);
					
				}
				prevDay = value.day;
			});
		}, 1000);
	}

	function handleSingleDelete(id){
		bootbox.dialog('{$translate.do_u_want_delete}', [
		{
		    "label" : "{$translate.no}",
		    "class" : "btn-danger",
		},
		 {							
		    "label" : "{$translate.yes}",
		    "class" : "btn-success",
		    "callback": function() {
		      if(id){
		      	$.ajax({
				url:"{$url_path}employee_non_prefered_timings.php",
				type:'POST',
				datetype:'json',
				data:{ 'id':id , 'action':'delete_single_time_interval'},
				success:function(data){
					// console.log(data);
					// console.log(JSON.parse(data));
					data = JSON.parse(data);
					if(data.result_flag == true){
						location.href = '{$url_path}employee/non-prefered/timing/{$employee_username}/{$preference_mode}/';
					}
					else{
						$('#main_message').html(data.error_message);
					}
				}
			});
		      }
		    }
		 }
	  ]);
	}

	// $('.datepicker').datepicker({
	//     onSelect: function(dateText) { 
	//     	alert();
	//     }
	// });
	

	</script>
{/block}

{block name="content"}
	<div class="row-fluid">
    	<div class="span12 main-left" id="left-panel">
        	<div style="margin: 15px 0px 0px ! important;" class="widget">
            	<div class="widget-header span12">
                	<h1>{$translate.employee_profile}</h1>
            	</div>
        	</div>

        	<div class="span12 widget-body-section input-group">
        		<div class="row-fliud" id="main_message">
            		{$message}
            	</div>
        		{if $employee_username != ""}
	            <div class="widget option-panel-widget" style="margin: 0 !important;">
	                <div class="widget-body">
	                    <div class="row-fluid">
	                        <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].social_security}{/if}</div>
	                        <div class="span4 top-customer-info"><strong>{$translate.code} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].code}{/if}</div>
	                        {if $sort_by_name == 2}
	                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].last_name|cat: ' '|cat: $employee_detail[0].first_name}{/if}</div>
	                        {elseif $sort_by_name == 1}
	                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].first_name|cat: ' '|cat: $employee_detail[0].last_name}{/if}</div>
	                        {/if}
	                    </div>
	                </div>
	            </div>
	            {/if}

	            <div class="row-fluid" >
                	<div class="span12">
                   		<div class="tab-content-switch-con {if $employee_username eq ""}no-mt{/if}" >
                   			<div class="span12">
                            	{if $employee_username neq ''}
                                	{block name="employee_manage_tab_content"}{/block}
                            	{/if}
                            	<div class="widget-header widget-header-options tab-option mt">
	                                <div class="widget-header span12">
	                                	<div class="span3">
	                                    	<h1>{$translate.employee_non_preferred_time}</h1>
	                                    </div>
	                                    <div class="span6" style="padding-top:8px;">
	                                    	<span style="margin-top: 3px !important; float: left;"><input type="radio" name="pref_selection" value="1" {if $preference_mode == 1}checked = "checked"{/if} onclick = "document.location.href='{$url_path}employee/non-prefered/timing/{$employee_username}/1/'"></span>
	                                    	<span style="padding-left: 4px; float: left;{if $preference_mode == 1}font-weight: bold;{/if}">{$translate.preferred_time}</span>
	                                    	<span style="margin-top: 3px !important; float: left; margin-left:10px;"><input type="radio" name="pref_selection" value="0" {if $preference_mode == 0}checked = "checked"{/if} onclick = "document.location.href='{$url_path}employee/non-prefered/timing/{$employee_username}/0/'"></span>
	                                    	<span style="padding-left: 4px; float: left;{if $preference_mode == 0}font-weight: bold;{/if}">{$translate.non_preferred_time}</span>
	                                    	
	                                    </div>
	                                    <div class="pull-right span3">
	                               	 		<button type="button" class="btn btn-default btn-precise  pull-right mr " onclick="window.history.back();">
	                               	 			<span class="icon-arrow-left"></span>{$translate.emp_non_prefr_time_back}
	                               	 		</button>
	                                    	<button type="button" class="btn btn-default btn-precise btn-add-new pull-right mr">
	                               	 			<span class="icon-plus"></span>{$translate.emp_non_prefr_time_addnew}
	                                    	</button>
	                               	 	</div>
	                                </div>
	                            </div>

	                            <div class="span12 widget-body-section input-group" id="saved_non_preferd_time">
		                            <div id="inconve_message_wraper" class="span12 no-min-height no-ml"></div>
                                	<div class="table-responsive span12 no-ml">
                                		<table id="non_preferd_time_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
	                                        <thead>
	                                            <tr>
	                                                <th style="width: 20px;" class="table-col-center">#</th>
	                                                <th style="width: 10em;">{$translate.date_range}</th>
	                                                <th style="width: 25em;">{$translate.timing}</th>
	                                                <th></th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                        	{assign i 0}
	                                        	{assign prev_day ''}
	                                        	{foreach from=$orderdAllNonPreferedTime item=date_range key=group_id }
	                                        		{assign i $i+1}
	                                        		<tr>
	                                        			<td style="width: 20px;" class="table-col-center center">{$i}</td>
	                                        			<td class="center">{$date_range[0]['date_from']} {$translate.to} {$date_range[0]['date_to']}</td>
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
	                                        			<td class="table-col-center">
	                                        				<button type="button" class="btn btn-default" title="{$translate.edit}" onclick='edit_non_prefered_time({$date_range|json_encode},{$group_id})'><span class="icon-wrench"></span></button>
	                                        				<button type="button" class="btn btn-default" title="{$translate.delete}" onclick="delete_non_prefered_time('{$group_id}')"><span class="icon-trash"></span></button>
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
                            </div>
                   		</div>
                   	</div>
                </div>
        	</div>
        </div>
        <!-- right panel begins -->
	        <div class="span4 main-right " id="right_panel" >
	        	<div class="widget">
	        		<div class="widget-header span12">
	        			<div class="day-slot-wrpr-header-left pull-left">
	                        <h1 style="">{$translate.employee_non_preferred_time}</h1>
	                    </div>
	                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
	                        <button class="btn btn-default btn-normal pull-right"   type="button" onclick="handleTimeInterval()"><i class=' icon-save'></i>{$translate.emp_non_prefr_save}</button>
	                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i>{$translate.emp_non_prefr_close}</button>
	                    </div>
	                    <div class="span12 widget-body-section input-group">
	                    	<div class="row-fluid" id="error_message">
	                    	</div>
	                    	<div class="row-fluid span12 no-ml">
			                	<div class="span4">
			                			<label>{$translate.emp_non_prefr_time_from_date}</label>
			                	</div>
			                	<div class="span8">
			                		<input type="text" class="datepicker"  id="from_date" autocomplete="off" />
			                	</div>
	                    	</div>
	                    	<div class="row-fluid sapn12">
	                    		<div class="span4">
	                    			<label>{$translate.emp_non_prefr_time_to_date}</label>
	                    		</div>
	                    		<div class="span8">
	                    			<input type="text" class="datepicker" id="to_date" autocomplete="off" />
	                    		</div>
	                    	</div>
	                    	<input type="hidden" id="group_id" value="">
	                   		<div class="row-fluid mt" id="day_wrapper">
	                   			

	                   			<div class="row-fluid day-show"  id="day_show1">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day1" aria-expanded="false" aria-controls="day1">{$translate.{$week[0].day}}
	                   					<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day1">
										<div class="panel-body span12" data-day="1">
									   		<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show2">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day2" aria-expanded="false" aria-controls="day2">{$translate.{$week[1].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day2">
										<div class="panel-body span12" data-day="2">
									   		<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show3">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day3" aria-expanded="false" aria-controls="day3">{$translate.{$week[2].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day3">
										<div class="panel-body span12" data-day="3">
									   		<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show4">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day4" aria-expanded="false" aria-controls="day4">{$translate.{$week[3].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day4">
										<div class="panel-body span12" data-day="4">
									   		<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show5">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day5" aria-expanded="false" aria-controls="day5">{$translate.{$week[4].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day5">
										<div class="panel-body span12 " data-day="5">
									   		<div class="span12 row-fluid interval-div" >
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show6">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day6" aria-expanded="false" aria-controls="day6">{$translate.{$week[5].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day6" >
										<div class="panel-body span12 " data-day="6">
									   		<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
									  		</div>
									  	</div>
									</div>
	                   			</div>

	                   			<div class="row-fluid day-show"  id="day_show7">
	                   				<div class="panel-title collapsed" data-toggle="collapse" data-target="#day7" aria-expanded="false" aria-controls="day7">{$translate.{$week[6].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
									<div class="collapse mb" id="day7">
										<div class="panel-body span12" data-day="7">
											<div class="span12 row-fluid interval-div">
												<div class="span1"><span class="icon-plus add-new-intervals"></span></div>
												<div class="span2">{$translate.emp_non_prefr_time_from}</div>
												<div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
												<div class="span2">{$translate.emp_non_prefr_time_to}</div>
												<div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
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