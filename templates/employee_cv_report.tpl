{block name="style"}

{/block}


{block name="content"}
	<div class="row-fluid">
	    <div class="span12 main-left">
	        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
	        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
	            <div class="panel-heading" style="">
	                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
	                	{$translate.employee_skill_report}
	                    <ul class="pull-right">
	                        <li> <i class="icon-arrow-left"></i> <a href="{$url_path}reports/"><span class="special_spn">{$translate.backs}</span></a></li>
	                        <!-- <li> <i class="icon-refresh"></i> <a href="javascript:void(0);" onclick="navigatePage('{$url_path}employee/cv/report/',8);"><span class="special_spn">{$translate.reset}</span></a></li> -->
	                        <!-- <li> <i colspans="icon-print"></i><a href="javascript:void(0);" onclick="print_pdf()"><span class="special_spn">{$translate.print}</span></a></li> -->
	                    </ul>
	                </h4>
	            </div>
	        </div>
	        <div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
	        	<form method="post" id="show_cv_form">
	        	  <div class="row ml">
	        	  	<div class="span3">
	        	  		<label for="employee_name">{$translate.cv_employee_name}</label>
	        	  		<input type="text" class="" name="employee_name" id="employee_name" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" value="{$employee_name}">
	        	  	</div>
	        	  	<div class="span3">
	        	  		<label for="cv_title">{$translate.cv_title}/{$translate.cv_description}</label>
	        	  		<input type="text" name="cv_title" id="cv_title" value="{$cv_title}">
	        	  	</div>
	        	  	<!-- <div class="span3">
	        	  		<label for="cv_description">{$translate.cv_description}</label>
	        	  		<input type="text" name="cv_description" id="cv_description" value="{$cv_description}">
	        	  	</div> -->
	        	  	<div class="span2">
	        	  		<label for="cv_year">{$translate.skill_date_of_exam}</label>
	        	  		<select id="cv_year" name="cv_year" class="span12">
	        	  			<option value="">{$translate.select}</option>
                            {html_options values=$years_combo selected=$cv_year output=$years_combo}
	        	  		</select>
	        	  	</div>
	        	  	<div class="span1 mt">
	        	  		<input type="submit" class="btn btn-primary" name="show_cv" id="show_cv" value="{$translate.show}" style="margin-top: 10px;">
	        	  	</div>
	        	  </div>
	        	</form>
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
                                                        <th class="header" width="5%">{$translate.cv_serial_no}</th>
                                                        <th class="header" width="20%">{$translate.cv_employee_name}</th>
                                                        <th class="header" width="10%">{$translate.year}</th>
                                                    	<th class="header" width="15%">{$translate.cv_title}</th>
                                                    	<th class="header" width="30%">{$translate.cv_description}</th>
                                                    	<th class="header" width="20%">{$translate.cv_attachments}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	{foreach from=$all_cv_details key=key item=skills}
                                                		<tr>
                                                			<td>{$key+1}</td>
                                                			<td><a href="{$url_path}employee/add/{$skills.username}/" target="_blank" style="color: #1414a5;text-decoration-line: underline;">{if $company_sort_by == 1} {$skills.first_name} {$skills.last_name} {else} {$skills.last_name} {$skills.first_name} {/if} </a></td>
                                                			<td>{$skills.year}</td>
                                                			<td>{$skills.skill}</td>
                                                			<td>{$skills.description}</td>
                                                			<td>
                                                				<ul>
                                                					{if $skills.attachment1}<li title="{$skills.attachment1}" onclick="download_skill('{$skills.attachment1}')" ><i class="icon icon-download"></i>{$skills.attachment1|truncate:18}</li>{/if}
                                                					{if $skills.attachment2}<li title="{$skills.attachment2}" onclick="download_skill('{$skills.attachment2}')" ><i class="icon icon-download"></i>{$skills.attachment2|truncate:18}</li>{/if}
                                                					{if $skills.attachment3}<li title="{$skills.attachment3}" onclick="download_skill('{$skills.attachment3}')" ><i class="icon icon-download"></i>{$skills.attachment3|truncate:18}</li>{/if}
                                                				</ul>
                                                			</td>

                                                		</tr>
                                            		{foreachelse}
	                                                    <tr class="gradeX">
	                                                        <td class="text-center" colspan="6">
	                                                            <div class="alert alert-info no-ml no-mr">
	                                                                <strong><i class="icon-info-sign icon-large"></i> {$translate.message_caption_information}</strong>:  {$translate.no_cv_data_found}
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
	    </div>
	</div>
{/block}


{block name="script"}
<script type="text/javascript">
	// function submitForm(){
	//     // $("#forms").attr('target', '_self');
	//     var employee_name = $("#employee_name").val();
	//     var cv_title = $("#cv_title").val();
	//     var cv_description =$("#cv_description").val();
	//     var cv_year =$("#cv_year").val();
	//     navigatePage('{$url_path}employee_cv_report.php?'+employee_name+'&'+cv_title+'&'+cv_description+'&'+cv_year+'',8);
	// }
	function download_skill(file){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+file;
    }
    $(function() {
        var availableTags = [
            {foreach from=$employeeslist item=employee}  
                {if $company_sort_by == 1}
                    {
                    value: "{$employee.username}",
                    label: "{$employee.first_name} {$employee.last_name}"
                    },
                {elseif $company_sort_by == 2}
                    {
                    value: "{$employee.username}",
                    label: "{$employee.last_name} {$employee.first_name}"
                    },
                {/if}
            {/foreach}
        ];
        $( "#employee_name" ).autocomplete({
            minLength: 0,
            source: availableTags,
            focus: function( event, ui ) {
                $( "#employee_name" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#employee_name" ).val( ui.item.label );
                // $( "#employee-id" ).val( ui.item.value );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };
    });
</script>
{/block}