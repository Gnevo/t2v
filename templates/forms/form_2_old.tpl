{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}

{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
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
        $("#customer").change(function() {
            var customer_id = $(this).val();
            if(customer_id != "" && customer_id != 0){
                navigatePage('{$url_path}form_2.php?customer=' + customer_id, 8);
            }
        });
        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
    });
    
    
function saveForm(){
    var customer = document.getElementById("customer").value;
    if(customer != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        $('#action').val('save');
        f.submit();
    } else {
        alert('All Fields are required');
    }
}

function downloadForm(){
    var customer = document.getElementById("customer").value;
    var review = document.getElementById("review").value;
    if(customer != "" && review != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        $('#action').val('pdf');
        f.submit();
    } else {
        alert('All Fields are required');
    }
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    navigatePage('{$url_path}form_2.php?review=' + reviewid +'&customer=' + customer, 8);
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        navigatePage('{$url_path}form_2.php?customer=' + customerid, 8);
    }
}

function goToReport() {
    var customer_id = $('#customer').val();
    navigatePage('{$url_path}form_2_report.php?customer=' + customer_id,8);
}

function goToQuesions() {
    navigatePage('{$url_path}form_2_questions.php', 8);
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_2.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_2}
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
                                        <select class="form-control span10" id="review" name="review" onchange="selectReview()">
                                            <option data-group="0" value="">{$translate.select_review}</option>
                                            {foreach $form_datas as $form_data}
                                                {if $customerid eq $form_data['customer']}
                                                    <option data-group="{$form_data['customer']}" value="{$form_data['id']}" {if $reviewid eq $form_data['id']}selected{/if}>{$form_data['created_date']}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </div>
                                </li>
                                <!--<li><i class="icon-plus"></i><a href="javascript:void(0);" onclick="addNew()"><span class="special_spn">{$translate.add}</span></a></li>-->
                                {if $privileges_forms.form_2_report == 1 ||  $user_role == 1 ||  $user_role == 6}
                                    <li><i class="icon-filter"></i><a href="javascript:void(0);" onclick="goToReport();"><span class="special_spn">{$translate.report}</span></a></li>
                                {/if}
                                {if $user_role == 1 ||  $user_role == 6}
                                    <li><i class="icon-wrench"></i><a href="javascript:void(0);" onclick="goToQuesions();"><span class="special_spn">{$translate.questions}</span></a></li>
                                {/if}
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}customer_forms.php',8);"><span class="special_spn">{$translate.backs}</span></a></li>
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}form_2.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                                <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm()"><span class="special_spn">{$translate.save}</span></a></li>
                                <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="downloadForm()"><span class="special_spn">{$translate.print}</span></a></li>
                            </ul>
                        </h4>
                    </div>
                </div>
                <div id="forms_container" class="span12 no-ml">
                    <div id="samsida_hold" style="overflow:auto;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">{$translate.form_2}</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Skapad av:</td>
                                            <td colspan="5">{$company_details['name']}</td>
                                            <td rowspan="3" width="10%"><img src="{$url_path}company_logo/{$company_details['logo']}" class="responsive" width="150px" style="max-width: 150px;" /></td>
                                        </tr>
                                        <tr>
                                            <td>Ändrad av:</td>
                                            <td colspan="3">{if $review_data}{$review_data['customer_name']}{else if $customerid}{if $sort_by_name == 1}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{else}{$customers[$customerid]['last_name']} {$customers[$customerid]['first_name']}{/if}{/if}</td>
                                            <td>R</td>
                                            <td>S</td>
                                        </tr>
                                        <tr>
                                            <td>Datum:</td>
                                            <td>{if $review_data}{$review_data['created_date']}{else}{$smarty.now|date_format:"%Y-%m-%d %T"}{/if}</td>
                                            <td>Utgåva:</td>
                                            <td><input type="text" class="form-control" name="version" id="version" value="{if $review_data['version']}{$review_data['version']}{else}1{/if}" placeholder="" maxlength="6" /></td>
                                            <td><input type="checkbox" name="check_r" value="1" {if $review_data['check_r']}checked="true"{/if} /></td>
                                            <td><input type="checkbox" name="check_s" value="1" {if $review_data['check_s']}checked="true"{/if} /></td>
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
                                            <td>Vi strävar efter att leverera bästa möjliga personliga assistans med en hög kvalitetsnivå. Nedan följer ett antal frågor med betygsättning 1-6 där 1 är sämst och 6 är bäst.
Kryssa för det betyg som du tycker stämmer med det du har upplevt som kund hos oss på {$company_details['name']}.</td>
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
                                            <th></th>
                                            <th class="center">1</th>
                                            <th class="center">2</th>
                                            <th class="center">3</th>
                                            <th class="center">4</th>
                                            <th class="center">5</th>
                                            <th class="center">6</th>
                                        </tr>
                                        {assign var="i" value=1}
                                        {foreach $form_questions as $question_id=>$question}
                                            <tr>
                                                <td>{$i}</td>
                                                <td>{$question['question']}<input type="hidden" name="questions[]" value="{$question_id}" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="1" {if $review_data['answers'][{$question_id}] eq 1}checked="true"{/if} style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="2" {if $review_data['answers'][{$question_id}] eq 2}checked="true"{/if} style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="3" {if $review_data['answers'][{$question_id}] eq 3}checked="true"{/if} style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="4" {if $review_data['answers'][{$question_id}] eq 4}checked="true"{/if} style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="5" {if $review_data['answers'][{$question_id}] eq 5}checked="true"{/if} style="float: none;" /></td>
                                                <td style="text-align: center; vertical-align: middle;"><input type="radio" name="question_{$question_id}" id="question_{$question_id}" value="6" {if $review_data['answers'][{$question_id}] eq 6}checked="true"{/if} style="float: none;" /></td>
                                            </tr>
                                            {assign var="i" value=$i+1}
                                        {foreachelse}
                                            <tr>
                                                <td colspan="8"><div class='message'>{$translate.no_responds_found}</div></td>
                                            </tr>
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
                                            <td>Övriga synpunkter:</td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_description" id="field_description" rows="3" style="width: 90%">{if $review_data['field_description']}{$review_data['field_description']}{/if}</textarea></td>
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
                                            <td>Personnummer:</td>
                                            <td>{if $review_data}{$employees[$review_data['created_by']]['century']}{$employees[$review_data['created_by']]['social_security']}{else}{$created_user_data['century']}{$created_user_data['social_security']}{/if}</td>
                                            <td>Namn:</td>
                                            <td>{if $review_data}{$review_data['created_name']}{else}{if $sort_by_name == 1}{$created_user_data['first_name']} {$created_user_data['last_name']}{else}{$created_user_data['last_name']} {$created_user_data['first_name']}{/if}{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Tack för din medverkan!</strong></td> 
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