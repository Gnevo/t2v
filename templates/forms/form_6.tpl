{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
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
        url: 'form_6_update_label.php',
        validate: function(value) {
            if($.trim(value) == '') return 'Value shoud not empty'; 
        }
    });
    $('.labelopt').editable({
        url: 'form_6_update_label.php?opk=1',
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
                document.location.href='{$url_path}form_6.php?customer=' + customer_id;
            }
        });

        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
        $.datepicker.formatDate('yy-mm-dd', ev.date);
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
    document.location.href='{$url_path}form_6.php?review=' + reviewid +'&customer=' + customer;
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        document.location.href='{$url_path}form_6.php?customer=' + customerid;
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_6.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_6}
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">ANMÄLAN – lex Sarah</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Avsändarens diarienummer</td>
                                            <td><input type="text" name="avsandarens_diarienummer" value="{$review_data['avsandarens_diarienummer']}" /></td>
                                            <td>
                                                <input type="checkbox" name="ett_allvarligt_missforhallande" value="1" {if $review_data['ett_allvarligt_missforhallande']}checked="true"{/if} />
                                                ett allvarligt missförhållande<br/>
                                                <input type="checkbox" name="en_pataglig_risk_for_ett_allvarligt_missforhallande" value="1" {if $review_data['en_pataglig_risk_for_ett_allvarligt_missforhallande']}checked="true"{/if} />
                                                en påtaglig risk för ett allvarligt missförhållande
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
                                            <th colspan="5" style="text-align: left;">Anmälan görs av</th>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="field_1" value="1" {if $review_data['answers'][$fields[1]['id']]}checked="true"{/if} /> 
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[2]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[2]['name']}</a>
                                                {else}
                                                    {$fields[2]['name']}
                                                {/if}
                                            </td>
                                            <td><input type="text" class="span12" name="field_2" value="{if $review_data['answers'][$fields[2]['id']]}{$review_data['answers'][$fields[2]['id']]}{else}{if $sort_by_name == 1}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{else}{$customers[$customerid]['last_name']} {$customers[$customerid]['first_name']}{/if}{/if}" /></td>
                                            <td>I</td>
                                            <td><input type="text" class="span12" name="field_3" value="{if $review_data['answers'][$fields[3]['id']]}{$review_data['answers'][$fields[3]['id']]}{else}{$customers[$customerid]['city']}{/if}" /></td>
                                            <td>
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[3]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[3]['name']}</a>
                                                {else}
                                                    {$fields[3]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="field_4" value="1" {if $review_data['answers'][$fields[4]['id']]}checked="true"{/if} /> 
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[5]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[5]['name']}</a>
                                                {else}
                                                    {$fields[5]['name']}
                                                {/if}
                                            </td>
                                            <td colspan="3"><input type="text" class="span12" name="field_5" value="{$review_data['answers'][$fields[5]['id']]}" /></td>
                                            <td>(namnet på t.ex. bolaget, stiftelsen)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><input type="checkbox" name="field_6" value="1" {if $review_data['answers'][$fields[6]['id']]}checked="true"{/if} /> 
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[6]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[6]['name']}</a>
                                                {else}
                                                    {$fields[6]['name']}
                                                {/if}
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
                                            {for $i=7 to 14}
                                                <td width="50%">
                                                    {if $user_role eq 1 || $user_role eq 6}
                                                        <a href="#" data-type="text" data-pk="{$fields[$i]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[$i]['name']}</a>
                                                    {else}
                                                        {$fields[$i]['name']}
                                                    {/if}
                                                    <br/>
                                                    <input type="text" class="span12" name="field_{$i}" value="{$review_data['answers'][$fields[$i]['id']]}" />
                                                </td>
                                                {if !($i%2)}
                                                    </tr><tr>
                                                {/if}
                                            {/for}
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
                                            <th colspan="2" style="text-align: left;">Var och när har det allvarliga missförhållandet inträffat eller risken för ett allvarligt missförhållande förelegat</th>
                                        </tr>
                                        <tr>
                                            {for $i=15 to 21}
                                                <td width="50%">
                                                    {if $user_role eq 1 || $user_role eq 6}
                                                        <a href="#" data-type="text" data-pk="{$fields[$i]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[$i]['name']}</a>
                                                    {else}
                                                        {$fields[$i]['name']}
                                                    {/if}
                                                    <br/>
                                                    <input type="text" class="span12" name="field_{$i}" value="{$review_data['answers'][$fields[$i]['id']]}" />
                                                </td>
                                                {if !($i%2)}
                                                    </tr><tr>
                                                {/if}
                                            {/for}
                                            <td></td>
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
                                            <td>
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[22]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[22]['name']}</a>
                                                {else}
                                                    {$fields[22]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_22" class="span12">{$review_data['answers'][$fields[22]['id']]}</textarea></td>
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
                                            <td>
                                                <input type="checkbox" name="field_23" value="1" {if $review_data['answers'][$fields[23]['id']]}checked="true"{/if} /> 
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[23]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[23]['name']}</a>
                                                {else}
                                                    {$fields[23]['name']}
                                                {/if}
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
                                            <td colspan="2">
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[24]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[24]['name']}</a>
                                                {else}
                                                    {$fields[24]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        {foreach from=$fields[24].options key=option_id item=option}
                                            {assign var="opt_val" value=$option_id+1}
                                            <tr>
                                                <td width="5%"><input type="radio" name="field_{$fields[24]['id']}" value="{$opt_val}" {if $review_data['answers'][$fields[24]['id']] eq $opt_val}checked="true"{/if} /></td>
                                                <td>
                                                    {if $user_role eq 1 || $user_role eq 6}
                                                        <a href="#" data-type="text" data-pk="{$fields[24]['id']}" data-name="{$option_id}" class="labelopt editable editable-click" style="display: inline;">{$option|unescape:"entity"}</a>
                                                    {else}
                                                        {$option|unescape:"entity"}
                                                    {/if}
                                                </td>
                                            </tr>
                                        {/foreach}
                                        {if $fields[24].other}
                                            {assign var=opt_val value=$opt_val+1}
                                            <tr>
                                                <td><input type="radio" name="field_{$fields[24]['id']}" id="field_{$fields[24]['id']}" value="{$opt_val}" {if !is_numeric($review_data['answers'][$fields[24]['id']]) && $review_data['answers'][$fields[24]['id']] != ''}checked="true"{/if}/></td>
                                                <td>Övrigt <input type="text" name="field_{$fields[24]['id']}_other" id="field_{$fields[24]['id']}_other" value="{if !is_numeric($review_data['answers'][$fields[24]['id']])}{$review_data['answers'][$fields[24]['id']]}{/if}" /></td>
                                            </tr>
                                        {/if}
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
                                            <td>
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[25]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[25]['name']}</a>
                                                {else}
                                                    {$fields[25]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_25" class="span12">{$review_data['answers'][$fields[25]['id']]}</textarea></td>
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
                                            <td>
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[26]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[26]['name']}</a>
                                                {else}
                                                    {$fields[26]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_26" class="span12">{$review_data['answers'][$fields[26]['id']]}</textarea></td>
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
                                            <td>
                                                {if $user_role eq 1 || $user_role eq 6}
                                                    <a href="#" data-type="text" data-pk="{$fields[27]['id']}" class="labelval editable editable-click" style="display: inline;">{$fields[27]['name']}</a>
                                                {else}
                                                    {$fields[26]['name']}
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="field_27" class="span12">{$review_data['answers'][$fields[27]['id']]}</textarea></td>
                                        </tr>
                                    </table>
                                </td>
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