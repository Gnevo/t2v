{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="{$url_path}css/jquery-editable.css" />
{/block}

{block name='script'}
<script src="{$url_path}js/jquery-1.10.1.min.js"></script>
<script src="{$url_path}js/jquery-ui-1.10.3.custom.js"></script>
<script src="{$url_path}js/jquery.poshytip.js"></script>
<script src="{$url_path}js/jquery-editable-poshytip.js"></script>
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script>
$.fn.editable.defaults.mode = 'inline';
$(function(){
    $('.labelval').editable({
        url: 'form_7_update_label.php',
        validate: function(value) {
            if($.trim(value) == '') return 'Value shoud not empty'; 
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var sel_customer = '{$customerid}';
        if($(window).height() > 400){
            $('#samsida_hold').css({ height: $(window).height()-109}); 
            $('#form_data').css({ height: $(window).height()-50});
        } else {
            $('#samsida_hold').css({ height: $(window).height()});
            $('#form_data').css({ height: $(window).height()});  
        }

        $(window).resize(function(){
           if($(window).height() > 400){
                $('#samsida_hold').css({ height: $(window).height()-109}); 
                $('#form_data').css({ height: $(window).height()-50});
           } else {
                $('#samsida_hold').css({ height: $(window).height()});
                $('#form_data').css({ height: $(window).height()});  
           }
        });  

        $(".list").click(function() {
            var thisparent = $(this).parent().children(".listed_details");
            $(".listed_details").slideUp("slow");
            if (thisparent.css("display") == 'none'){
                thisparent.slideToggle("slow");
            }
        });


        $("#customer").change(function() {
            var customer_id = $(this).val();
            if(customer_id != "" && customer_id != 0){
                document.location.href='{$url_path}form_7.php?customer=' + customer_id;
            }
        });

        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
        $('#deviation_time, #error_from, #error_to').timepicker({
            minuteStep: 5,
            showInputs: false,
            showMeridian: false
        });
    });
    
    
function saveForm(){
    $('#action').val('save');
    $("#forms").submit();
}

function downloadForm(){
    $('#action').val('pdf');
    $("#forms").submit();
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    document.location.href='{$url_path}form_7.php?review=' + reviewid +'&customer=' + customer;
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        document.location.href='{$url_path}form_7.php?customer=' + customerid;
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_7.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_7}
                            <ul class="pull-right">
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="customer" name="customer">
                                            <option value="0">{$translate.select_customer}</option>
                                            {foreach $customers as $customer}
                                                <option value="{$customer['username']}" {if $customerid eq $customer['username']}selected{/if}>{if $sort_by_name == 1}{$customer['first_name']|cat:' '|cat:$customer['last_name']}{else}{$customer['last_name']|cat:' '|cat:$customer['first_name']}{/if}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="input-prepend pull-right" style="margin: 0px;">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control" id="review" name="review" onchange="selectReview()">
                                            <option data-group="0" value="">{$translate.select_review}</option>
                                            {foreach $form_datas as $form_data}
                                                {if $customerid eq $form_data['customer']}
                                                    <option data-group="{$form_data['customer']}" value="{$form_data['id']}" {if $reviewid eq $form_data['id']}selected{/if}>{$form_data['created_date']}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </div>
                                </li>
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}customer_forms.php',8);"><span class="special_spn">{$translate.backs}</span></a></li>
                                <li><i class="icon-refresh"></i><a href="{$url_path}form_6.php"><span class="special_spn">{$translate.reset}</span></a></li>
                                <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm()"><span class="special_spn">{$translate.save}</span></a></li>
                                <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="downloadForm()"><span class="special_spn">{$translate.print}</span></a></li>
                            </ul>
                        </h4>
                    </div>
                </div>
                <div id="forms_container" class="span12 no-ml">
                    <div id="samsida_hold" style="overflow:auto; background-color: #FFFFFF;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Uppdragsgivares personakt - delgivningsintyg</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Skapad av:</td>
                                            <td>Ändrad av:</td>
                                            <td>Datum:</td>
                                            <td>Utgåva:</td>
                                            <td>R</td>
                                            <td>S</td>
                                        </tr>
                                        <tr>
                                        	<td>{if $review_data['created_by']}{$review_data['created_name']}{else}{$created_user_name}{/if}</td>
                                        	<td>{if $review_data['modified_by']}{$review_data['modified_name']}{else}{$created_user_name}{/if}</td>
                                        	<td>{if $review_data['created_date']}{$review_data['created_date']}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}</td>
                                        	<td><input type="text" name="utgava" value="{if $review_date['utgava']}{$review_date['utgava']}{else}1{/if}" /></td>
                                            <td>
                                                <input type="checkbox" name="r" value="1" {if $review_data['r']}checked="true"{/if} />
                                            </td>
                                            <td>
                                                <input type="checkbox" name="s" value="1" {if $review_data['s']}checked="true"{/if} />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <th colspan="2" style="text-align: left;">Genomgång och delgivning av uppdragsgivares personakt inkluderande pärm, kontorets dator och Cirrus.</th>
                                        </tr>
                                        <tr>
                                            <td width="40%">Uppdragsgivares namn :</td>
                                            <td>{if $review_data['customer']}{$review_data['customer_name']}{else if $customerid}{if $sort_by_name == 1}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{else}{$customers[$customerid]['last_name']} {$customers[$customerid]['first_name']}{/if}{/if}</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Uppdragsgivares personnummer :</td>
                                            <td>{if $review_data['customer']}{$review_data['customer_century']} {substr_replace($review_data['customer_social_security'],"-",6,0)}{else if $customerid}{$customers[$customerid]['century']} {substr_replace($customers[$customerid]['social_security'],"-",6,0)}{/if}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                    	<tr>
                                    		<th></th>
                                    		<th>Ja</th>
                                    		<th>Nej</th>
                                    	</tr>
                                    	{assign var="other" value=0}
                                        {foreach from=$fields item=field key=field_id}
                                        	<tr>
                                        		<td>
                                        			{if $user_role eq 1 || $user_role eq 6}
                                                        <a href="#" data-type="text" data-pk="{$field['id']}" class="labelval editable editable-click" style="display: inline;">{$field['name']}</a>
                                                    {else}
                                                        {$field['name']}
                                                    {/if}
                                        		</td>
                                        		{if $field['other']}
                                        			{assign var="other" value=$other+1}
                                        				{if $other == 1}
			                                    			<td style="text-align: center;">
			                                        			<input type="radio" class="center" name="field_{$field['id']}" value="1" {if $review_data['answers'][$field['id']] == ''}checked="true"{/if} />
			                                        		</td>
			                                        		<td style="text-align: center;">
			                                        			<input type="radio" class="center" name="field_{$field['id']}" value="0" {if $review_data['answers'][$field['id']] != ''}checked="true"{/if} />
			                                        		</td>
		                                        		{else}
		                                        			<td style="text-align: center;">
			                                        			<input type="radio" class="center" name="field_{$field['id']}" value="1" {if $review_data['answers'][$field['id']] != ''}checked="true"{/if} />
			                                        		</td>
			                                        		<td style="text-align: center;">
			                                        			<input type="radio" class="center" name="field_{$field['id']}" value="0" {if $review_data['answers'][$field['id']] == ''}checked="true"{/if} />
			                                        		</td>
		                                        		{/if}
		                                			</tr>
		                                			<tr>
		                                				<td>
		                                					{if $other ==1}
		                                						om Nej, specificera
		                                					{else}
		                                						om Ja, specificera
		                                					{/if}
		                                				</td>
		                                				<td colspan="2">
		                                					<input type="text" class="span12" name="field_{$field_id}_other" value="{$review_data['answers'][$field['id']]}" />
		                                				</td>
		                            				</tr>
                                				{else}
	                                					<td style="text-align: center;">
	                                        			<input type="radio" class="center" name="field_{$field['id']}" value="1" {if $review_data['answers'][$field['id']] == 1}checked="true"{/if} />
		                                        		</td>
		                                        		<td style="text-align: center;">
		                                        			<input type="radio" class="center" name="field_{$field['id']}" value="0" {if $review_data['answers'][$field['id']] === 0}checked="true"{/if} />
		                                        		</td>
	                                        		</tr>
                                        		{/if}
                                        {/foreach}
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="40%">Datum för delgivning :</td>
                                            <td><input type="text" class="span12 datepicker" name="datum_for_delgivning" value="{$review_data['datum_for_delgivning']}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Månad och år för nästa delgivning :</td>
                                            <td><input type="text" class="span12 datepicker" name="manad_och_ar_for_nasta_delgivning" value="{$review_data['manad_och_ar_for_nasta_delgivning']}" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                    	<tr>
                                    		<th colspan="2">Närvarande</th>
                                    	</tr>
                                        <tr>
                                        	<td>Namn</td>
                                        	<td>Befattning / Roll</td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		<input type="text" name="narvarande_person_1" value="{$review_data['narvarande_person_1']}" />
                                        	</td>
                                        	<td>
                                        		<input type="text" name="narvarande_person_roll_1" value="{$review_data['narvarande_person_roll_1']}" />
                                        	</td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		<input type="text" name="narvarande_person_2" value="{$review_data['narvarande_person_2']}" />
                                        	</td>
                                        	<td>
                                        		<input type="text" name="narvarande_person_roll_2" value="{$review_data['narvarande_person_roll_2']}" />
                                        	</td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		<input type="text" name="narvarande_person_3" value="{$review_data['narvarande_person_3']}" />
                                        	</td>
                                        	<td>
                                        		<input type="text" name="narvarande_person_roll_3" value="{$review_data['narvarande_person_roll_3']}" />
                                        	</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-top: 25px" class="span12 no-ml mb">
                                        <button class="btn btn-primary mr" onclick="saveForm();" type="button"><i class="icon-save"></i> {$translate.save}</button>
                                    </span>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </form>
        </div>
    </div>
{/block}