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
        if($(window).height() > 300){
            //$('.main-left').css({ height: $(window).height()-56}); 
            $('#samsida_hold').css({ height: $(window).height()-109}); 
        }
        else{
            $('#samsida_hold').css({ height: $(window).height()});    
        }
        $("#customer").change(function() {
            var customer_id = $(this).val();
            if(customer_id != "" && customer_id != 0){
                navigatePage('{$url_path}form_3.php?customer=' + customer_id, 8);
            }
            /*if (customer_id != sel_customer && customer_id != '') {
                document.getElementById('review').selectedIndex = 0;
            }
            var sub = $('#review');
            $('option', sub).filter(function(){
                if (
                     $(this).attr('data-group') === customer_id 
                  || $(this).attr('data-group') === '0'
                ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $("#forms").trigger('reset'); */
        });
        //$('#customer').trigger('change');
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
    navigatePage('{$url_path}form_3.php?review=' + reviewid +'&customer=' + customer, 8);
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        navigatePage('{$url_path}form_3.php?customer=' + customerid, 8);
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_3.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_3}
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
                                <li><i class="icon-plus"></i><a href="javascript:void(0);" onclick="addNew()"><span class="special_spn">{$translate.add}</span></a></li>
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}customer_forms.php',8);"><span class="special_spn">{$translate.backs}</span></a></li>
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}form_3.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">{$translate.form_3}</h4></span>
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
                                            <td>Vi strävar efter att leverera bästa möjliga arbetssituation för våra assistenter och en hög kvalitetsnivå för att kunna bemöta våra kunder på ett professionellt sätt.</td>
                                        </tr>
                                        <tr>
                                            <td>Nedan följer ett antal frågor med betygsättning 1-6 där 1 är sämst och 6 är bäst.</td>
                                        </tr>
                                        <tr>
                                            <td>Kryssa för det betyg som du tycker stämmer med det du har upplevt som anställd hos oss på {$company_details['name']}.</td>
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
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Får det stöd du behöver för att kunna utföra dina arbetsuppgifter på ett tillfredställande sätt?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="1" {if $review_data['field_1'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="2" {if $review_data['field_1'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="3" {if $review_data['field_1'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="4" {if $review_data['field_1'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="5" {if $review_data['field_1'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_1" id="field_1" value="6" {if $review_data['field_1'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Känner du att du i ditt arbete får använda dina kunskaper och din kompetens?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="1" {if $review_data['field_2'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="2" {if $review_data['field_2'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="3" {if $review_data['field_2'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="4" {if $review_data['field_2'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="5" {if $review_data['field_2'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_2" id="field_2" value="6" {if $review_data['field_2'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Upplever du att du har en rimlig arbetsbelastning?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="1" {if $review_data['field_3'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="2" {if $review_data['field_3'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="3" {if $review_data['field_3'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="4" {if $review_data['field_3'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="5" {if $review_data['field_3'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_3" id="field_3" value="6" {if $review_data['field_3'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Upplever du att företaget värnar om ditt bästa?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="1" {if $review_data['field_4'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="2" {if $review_data['field_4'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="3" {if $review_data['field_4'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="4" {if $review_data['field_4'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="5" {if $review_data['field_4'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_4" id="field_4" value="6" {if $review_data['field_4'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Upplever du att du har möjligheten att påverka din arbetssituation?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="1" {if $review_data['field_5'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="2" {if $review_data['field_5'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="3" {if $review_data['field_5'] eq 3}checked="true"{/if} {if $review_data['field_5'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="4" {if $review_data['field_5'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="5" {if $review_data['field_5'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_5" id="field_5" value="6" {if $review_data['field_5'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Upplever du att företaget är lyhörda om du kommer med förbättringsmöjligheter i ditt arbete?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="1" {if $review_data['field_6'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="2" {if $review_data['field_6'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="3" {if $review_data['field_6'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="4" {if $review_data['field_6'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="5" {if $review_data['field_6'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_6" id="field_6" value="6" {if $review_data['field_6'] eq 6}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Upplever du att du får den kompetensutveckling du behöver för att utföra arbetsuppgifterna?</td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="1" {if $review_data['field_7'] eq 1}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="2" {if $review_data['field_7'] eq 2}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="3" {if $review_data['field_7'] eq 3}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="4" {if $review_data['field_7'] eq 4}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="5" {if $review_data['field_7'] eq 5}checked="true"{/if} style="float: none;" /></td>
                                            <td style="text-align: center; vertical-align: middle;"><input type="radio" name="field_7" id="field_7" value="6" {if $review_data['field_7'] eq 6}checked="true"{/if} style="float: none;" /></td>
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