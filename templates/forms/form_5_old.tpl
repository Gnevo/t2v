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
        url: 'form_5_update_label.php',
        validate: function(value) {
            if($.trim(value) == '') return 'Value shoud not empty'; 
        }
    });
    $('.labelopt').editable({
        url: 'form_5_update_label.php?opk=1',
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
                document.location.href='{$url_path}form_5.php?customer=' + customer_id;
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
    document.location.href='{$url_path}form_5.php?review=' + reviewid +'&customer=' + customer;
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        document.location.href='{$url_path}form_5.php?customer=' + customerid;
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_5.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_5}
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
                                <li><i class="icon-refresh"></i><a href="{$url_path}form_5.php"><span class="special_spn">{$translate.reset}</span></a></li>
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Avvikelserapport</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>1) När inträffade avvikelsen? (Datum)</td>
                                            <td><input type="text" class="datepicker" name="deviation_date" value="{$review_data['deviation_date']}" /></td>
                                            <td>(klockslag)</td>
                                            <td>
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text" class="form-control" name="deviation_time" id="deviation_time" value="{$review_data['deviation_time']}" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Om ”avvikelsen” inträffat under längre tid (från)</td>
                                            <td>
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text" name="error_from" id="error_from" value="{$review_data['error_from']}" />
                                                </div>
                                            </td>
                                            <td>(till)</td>
                                            <td>
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text" name="error_to" id="error_to" value="{$review_data['error_to']}" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2) Var inträffade avvikelsen?</td>
                                            <td colspan="3"><input type="text" class="span12" name="where_did_deviation" value="{$review_data['where_did_deviation']}" /></td>
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
                                            <td>3. Brukarens namn:</td>
                                            <td colspan="5"><input type="text" class="span12" name="username" value="{if $review_data['customer']}{$review_data['customer_name']}{else}{if $sort_by_name == 1}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{else}{$customers[$customerid]['last_name']} {$customers[$customerid]['first_name']}{/if}{/if}" /></td>
                                        </tr>
                                        <tr>
                                            <td>Personnummer:</td>
                                            <td colspan="2">{if $review_data['social_security']} {substr_replace($review_data['social_security'],"-",6,0)}{else}{$customers[$customerid]['century']} {substr_replace($customers[$customerid]['social_security'],"-",6,0)}{/if}</td>
                                            <td>Huvuddiagnos:</td>
                                            <td colspan="2"><input type="text" name="main_diagnosis" value="{$review_data['main_diagnosis']}" /></td>
                                        </tr>
                                        <tr>
                                            <td>Anhörig underrättad</td>
                                            <td>
                                                <input type="radio" name="relatives_informed" id="relatives_informed" value="1" {if $review_data['relatives_informed'] eq 1}checked="true"{/if}/>Ja
                                            </td>
                                            <td>
                                                <input type="radio" name="relatives_informed" id="relatives_informed" value="0" {if $review_data['relatives_informed'] neq 1 && $review_data['relatives_informed'] neq ''}checked="true"{/if}/>Nej
                                            </td>
                                            <td>God man underrättad</td>
                                            <td>
                                                <input type="radio" name="good_man_informed" id="good_man_informed" value="1" {if $review_data['good_man_informed'] eq 1}checked="true"{/if}/>Ja
                                            </td>
                                            <td>
                                                <input type="radio" name="good_man_informed" id="good_man_informed" value="0" {if $review_data['good_man_informed'] neq 1 && $review_data['good_man_informed'] neq ''}checked="true"{/if}/>Nej
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
                                            <td>4. Typ avvikelse?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="type_fall" id="type_fall" value="1" {if $review_data['type_fall'] eq 1}checked="true"{/if}/> Fall (fyll i sidan för fallavvikelse)</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="type_hot_vald" id="type_hot_vald" value="1" {if $review_data['type_hot_vald'] eq 1}checked="true"{/if}/> Hot/våld (fyll i sidan för hot/våld)</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="type_lakemedel" id="type_lakemedel" value="1" {if $review_data['type_lakemedel'] eq 1}checked="true"{/if}/> Läkemedel (fyll i sidan för läkemedelsfel)</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="type_mtp" id="type_mtp" value="1" {if $review_data['type_mtp'] eq 1}checked="true"{/if}/> MTP (tekniska hjälpmedel) (fyll i delen för MTP avvikelse)</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="type_utebliven_felaktig" id="type_utebliven_felaktig" value="1" {if $review_data['type_utebliven_felaktig'] eq 1}checked="true"{/if}/> Utebliven/felaktig LSS insats (fyll i delen för utebliven/felaktig LSS insats)</td>
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
                                            <td>5. Vad hände och varför hände det? (beskriv så detaljerat som möjligt)</td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="vad_hande_och_varfor_hande_det" id="vad_hande_och_varfor_hande_det" class="span12">{$review_data['vad_hande_och_varfor_hande_det']}</textarea></td>
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
                                            <td>6. Vad har du/ni gjort för att det inte ska ske igen?</td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen" id="vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen" class="span12">{$review_data['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen']}</textarea></td>
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
                                            <td>7. Vad blev resultatet av ovanstående åtgärder?</td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="vad_blev_resultatet_av_ovanstaende_atgarder" id="vad_blev_resultatet_av_ovanstaende_atgarder" class="span12">{$review_data['vad_blev_resultatet_av_ovanstaende_atgarder']}</textarea></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            {foreach from=$fields key=group_id item=group}
                                <tr>
                                    <td class="minus_padding">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                            <tr><td colspan="2">{$group.name|utf8_encode}</td></tr>
                                            <tr>
                                                {assign var="cols" value=1}
                                                {foreach from=$group.fields key=key_id item=field}
                                                    <td width="50%">
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                                            <tr>
                                                                <td colspan="2">
                                                                    {if $user_role eq 1 || $user_role eq 6}
                                                                        <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                    {else}
                                                                        {$field.name}
                                                                    {/if}
                                                                </td>
                                                            </tr>
                                                            {foreach from=$field.options key=option_id item=option}
                                                                {assign var="opt_val" value=$option_id+1}
                                                                <tr>
                                                                    <td width="5%"><input type="radio" name="field_{$field.id}" id="field_{$field.id}" value="{$opt_val}" {if $review_data['answers'][$field['id']] eq $opt_val}checked="true"{/if} /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$field.id}" data-name="{$option_id}" class="labelopt editable editable-click" style="display: inline;">{$option}</a>
                                                                        {else}
                                                                            {$option}
                                                                        {/if}
                                                                    </td>
                                                                </tr>
                                                            {/foreach}
                                                            {if $field.other}
                                                                {assign var=opt_val value=$opt_val+1}
                                                                <tr>
                                                                    <td><input type="radio" name="field_{$field.id}" id="field_{$field.id}" value="{$opt_val}" {if !is_numeric($review_data['answers'][$field['id']]) && $review_data['answers'][$field['id']] != ''}checked="true"{/if}/></td>
                                                                    <td>Annat <input type="text" name="field_{$field.id}_other" id="field_{$field.id}_other" value="{if !is_numeric($review_data['answers'][$field['id']])}{$review_data['answers'][$field['id']]}{/if}" /></td>
                                                                </tr>
                                                            {/if}
                                                        </table>
                                                    </td>
                                                    {assign var=cols value=$cols+1}
                                                    {if $cols%2}
                                                        </tr><tr>
                                                    {/if}
                                                {/foreach}
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            {/foreach}
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