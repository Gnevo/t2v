{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}css/jquery-editable.css" />
{/block}

{block name='script'}
<script src="{$url_path}js/jquery-1.10.1.min.js"></script>
<script src="{$url_path}js/jquery-ui-1.10.3.custom.js"></script>
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/jquery.poshytip.js"></script>
<script src="{$url_path}js/jquery-editable-poshytip.js"></script>
<script>
$.fn.editable.defaults.url = 'form_4_update_label.php';
$.fn.editable.defaults.mode = 'inline';
$(function(){
    $('.labelval').editable({
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
                document.location.href='{$url_path}form_4.php?customer=' + customer_id;
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
    var error = 0;
    var errors = 0;
    var customer = document.getElementById("customer").value;
    var datum_for_upprattandet_av_gp = $('#datum_for_upprattandet_av_gp').val();
    var deltagare_vid_upprattandet_av_gp_name1 = $('#deltagare_vid_upprattandet_av_gp_name1').val();
    var deltagare_vid_upprattandet_av_gp_roll1 = $('#deltagare_vid_upprattandet_av_gp_roll1').val();
    var dagens_datum_1 = $('#dagens_datum_1').val();
    var befattning_roll_1 = $('#befattning_roll_1').val();
    var namnfortydligande_1 = $('#namnfortydligande_1').val();
    if (customer == 0){
        $("#customer").addClass("error");
        error = 1;
    }
    if (datum_for_upprattandet_av_gp == ""){
        $("#datum_for_upprattandet_av_gp").addClass("error");
        error = 1;
    }
    if (deltagare_vid_upprattandet_av_gp_name1 == ""){
        $("#deltagare_vid_upprattandet_av_gp_name1").addClass("error");
        error = 1;
    }
    if (deltagare_vid_upprattandet_av_gp_roll1 == ""){
        $("#deltagare_vid_upprattandet_av_gp_roll1").addClass("error");
        error = 1;
    }
    if (dagens_datum_1 == ""){
        $("#dagens_datum_1").addClass("error");
        error = 1;
    }
    if (befattning_roll_1 == ""){
        $("#befattning_roll_1").addClass("error");
        error = 1;
    }
    if (namnfortydligande_1 == ""){
        $("#namnfortydligande_1").addClass("error");
        error = 1;
    }
    if(error < 1){ 
        $('#action').val('save');
        $("#forms").submit();
    } else {
        if(error != 0){
            $("#error_error").addClass('message');
            $("#error_error").html("{$translate.required_missing}");
        }
    }
}

function downloadForm(){
    $('#action').val('pdf');
    $("#forms").submit();
}


function selectReview(){
    var reviewid = document.getElementById("review").value;
    var customer = document.getElementById("customer").value;
    document.location.href='{$url_path}form_4.php?review=' + reviewid +'&customer=' + customer;
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        document.location.href='{$url_path}form_4.php?customer=' + customerid;
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}<div id="error_error" style="color: white;"></div></div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_4.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_4}
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
                                <!--<li><i class="icon-plus"></i><a href="javascript:void(0);" onclick="addNew()"><span class="special_spn">{$translate.add}</span></a></li>-->
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}customer_forms.php',8);"><span class="special_spn">{$translate.backs}</span></a></li>
                                <li><i class="icon-refresh"></i><a href="{$url_path}form_4.php"><span class="special_spn">{$translate.reset}</span></a></li>
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Genomförandeplan - myndig</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <th colspan="6">Uppgift om uppdragsgivaren</th>
                                        </tr>
                                        <tr>
                                            <td>Datum för upprättandet av GP:</td>
                                            <td colspan="3">{if $review_data}{$review_data['created_date']}{else}{$smarty.now|date_format:"%Y-%m-%d %T"}{/if}</td>
                                            <td class="center">R</td>
                                            <td class="center">S</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Fullständigt namn:</td>
                                            <td width="25%"><input type="text" class="span12" name="fullname" value="{if $review_data['fullname']}{$review_data['fullname']}{else}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{/if}" /></td>
                                            <td width="15%">Personnummer:</td>
                                            <td width="25%"><input type="text" class="span11" name="social_security" value="{if $review_data['social_security']}{$review_data['social_security']}{else}{$customers[$customerid]['century']}{$customers[$customerid]['social_security']}{/if}" /></td>
                                            <td width="5%" class="center"><input type="checkbox" name="check_r" value="1" {if $review_data['check_r']}checked="true"{/if} /></td>
                                            <td width="5%" class="center"><input type="checkbox" name="check_s" value="1" {if $review_data['check_s']}checked="true"{/if} /></td>
                                        </tr>
                                        <tr>
                                            <td>Fullständig adress:</td>
                                            <td colspan="5"><input type="text" class="span12" name="address" value="{if $review_data['address']}{$review_data['address']}{else}{$customers[$customerid]['address']}{/if}" /></td>
                                        </tr>
                                        <tr>
                                            <td>E-post :</td>
                                            <td><input type="text" class="span12" name="email" value="{if $review_data['email']}{$review_data['email']}{else}{$customers[$customerid]['email']}{/if}" /></td>
                                            <td>Telefon/Mobil:</td>
                                            <td colspan="3"><input type="text" class="span12" name="phone" value="{if $review_data['phone']}{if substr($review_data['phone'], 0, 1) != '0'}0{$review_data['phone']}{else}{$review_data['phone']}{/if}{else}{if substr($customers[$customerid]['phone'], 0, 1) != '0'}0{$customers[$customerid]['phone']}{else}{$customers[$customerid]['phone']}{/if}{/if}" /></td>
                                        </tr>
                                        <tr>
                                            <td>Önskemål angående kontakter</td>
                                            <td colspan="5"><input type="text" class="span12" name="onskemal_angaende_kontakter" value="{$review_data['onskemal_angaende_kontakter']}" /></td>
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
                                            <td></td>
                                            <td class="center">Ny uppdragsgivare</td>
                                            <td class="center">Uppföljning</td>
                                            <td class="center">Förändring</td>
                                            <td class="center">Schemalagd</td>
                                        </tr>
                                        <tr>
                                            <td>Orsak till GP</td>
                                            <td class="center"><input type="checkbox" name="ny_uppdragsgivare" value="1" {if $review_data['ny_uppdragsgivare']}checked="true"{/if} /></td>
                                            <td class="center"><input type="checkbox" name="uppfoljning" value="1" {if $review_data['uppfoljning']}checked="true"{/if} /></td>
                                            <td class="center"><input type="checkbox" name="forandring" value="1" {if $review_data['forandring']}checked="true"{/if} /></td>
                                            <td class="center"><input type="checkbox" name="schemalagd" value="1" {if $review_data['schemalagd']}checked="true"{/if} /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="center">&nbsp;Ja</td>
                                            <td class="center">&nbsp;Nej</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Samtycker till genomförandeplan</td>
                                            <td class="center"><input type="radio" name="samtycker_till_genomforandeplan" value="1" {if $review_data['samtycker_till_genomforandeplan']}checked="true"{/if} style="float: none;" /></td>
                                            <td class="center"><input type="radio" name="samtycker_till_genomforandeplan" value="0" {if $review_data['samtycker_till_genomforandeplan'] eq 0 && $review_data['samtycker_till_genomforandeplan'] neq ''}checked="true"{/if} style="float: none;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <div class="employee_details_inner clearfix">
                            <div class="list_contnts clearfix">
                                {foreach from=$fields key=group_id item=group}
                                    <div id="employee_block" name="employee_block" style="border:solid 1px #8fc6d3;" class="clearfix"><!--collaps this fold-->
                                        <div class="entity_list list clearfix">
                                            <div class="span12"><h5>{$group.name|utf8_encode}</h5></div>
                                        </div>
                                        <div  class="listed_details" style="display:none;height:auto;">
                                            <div class="tidsredov_block clearfix">
                                                <div class="ar_block clearfix span12">
                                                    <div class="anställd_block span12 no-ml">
                                                        {if $group.caption}<div class="span12"><h6>{$group.caption|utf8_encode}</h6></div>{/if}
                                                        {if $group_id eq 1}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td colspan="4"></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.0.id}" value="1" {if $review_data['answers'][$group.fields.0.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.0.id}" value="0" {if $review_data['answers'][$group.fields.0.id] eq 0 && $review_data['answers'][$group.fields.0.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.1.id}" value="1" {if $review_data['answers'][$group.fields.1.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.1.id}" value="0" {if $review_data['answers'][$group.fields.1.id] eq 0 && $review_data['answers'][$group.fields.1.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.2.id}" value="1" {if $review_data['answers'][$group.fields.2.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.2.id}" value="0" {if $review_data['answers'][$group.fields.2.id] eq 0 && $review_data['answers'][$group.fields.2.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.3.id}" value="1" {if $review_data['answers'][$group.fields.3.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.3.id}" value="0" {if $review_data['answers'][$group.fields.3.id] eq 0 && $review_data['answers'][$group.fields.3.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2">Om Ja</td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.6.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.6.name}</a>
                                                                        {else}
                                                                            {$group.fields.6.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_{$group.fields.6.id}" value="{$review_data['answers'][$group.fields.6.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.5.id}" value="{$review_data['answers'][$group.fields.5.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.7.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.7.name}</a>
                                                                        {else}
                                                                            {$group.fields.7.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_{$group.fields.7.id}" value="{$review_data['answers'][$group.fields.7.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.8.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.8.name}</a>
                                                                        {else}
                                                                            {$group.fields.8.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.8.id}" value="1" {if $review_data['answers'][$group.fields.8.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.8.id}" value="0" {if $review_data['answers'][$group.fields.8.id] eq 0 && $review_data['answers'][$group.fields.8.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2">Om Ja</td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.9.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.9.name}</a>
                                                                        {else}
                                                                            {$group.fields.9.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.9.id}" value="{$review_data['answers'][$group.fields.9.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.11.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.11.name}</a>
                                                                        {else}
                                                                            {$group.fields.11.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_{$group.fields.11.id}" value="{$review_data['answers'][$group.fields.11.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.10.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.10.name}</a>
                                                                        {else}
                                                                            {$group.fields.10.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.10.id}" value="{$review_data['answers'][$group.fields.10.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.12.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.12.name}</a>
                                                                        {else}
                                                                            {$group.fields.12.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="2"><input type="text" name="field_{$group.fields.12.id}" value="{$review_data['answers'][$group.fields.12.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.13.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.13.name}</a>
                                                                        {else}
                                                                            {$group.fields.13.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.13.id}" value="1" {if $review_data['answers'][$group.fields.13.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.13.id}" value="0" {if $review_data['answers'][$group.fields.13.id] eq 0 && $review_data['answers'][$group.fields.13.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 2}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.0.id}" value="{$review_data['answers'][$group.fields.0.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.1.id}" value="{$review_data['answers'][$group.fields.1.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.2.id}" value="{$review_data['answers'][$group.fields.2.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.3.id}" value="{$review_data['answers'][$group.fields.3.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.5.id}" value="{$review_data['answers'][$group.fields.5.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.6.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.6.name}</a>
                                                                        {else}
                                                                            {$group.fields.6.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.6.id}" value="{$review_data['answers'][$group.fields.6.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.7.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.7.name}</a>
                                                                        {else}
                                                                            {$group.fields.7.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.7.id}" value="{$review_data['answers'][$group.fields.7.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.8.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.8.name}</a>
                                                                        {else}
                                                                            {$group.fields.8.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.8.id}" value="{$review_data['answers'][$group.fields.8.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.9.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.9.name}</a>
                                                                        {else}
                                                                            {$group.fields.9.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.9.id}" value="{$review_data['answers'][$group.fields.9.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 3}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.0.id}" value="{$review_data['answers'][$group.fields.0.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.1.id}" value="{$review_data['answers'][$group.fields.1.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.2.id}" value="{$review_data['answers'][$group.fields.2.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.3.id}" value="{$review_data['answers'][$group.fields.3.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.5.id}" value="1" {if $review_data['answers'][$group.fields.5.id]}checked="true"{/if} style="float: none;" /></td>
                                                                    <td class="center"><input type="radio" name="field_{$group.fields.5.id}" value="0" {if $review_data['answers'][$group.fields.5.id] eq 0 && $review_data['answers'][$group.fields.5.id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 4}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <th colspan="4" class="left">Försäkringskassa</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.0.id}" value="{$review_data['answers'][$group.fields.0.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.1.id}" value="{$review_data['answers'][$group.fields.1.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.2.id}" value="{$review_data['answers'][$group.fields.2.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.3.id}" value="{$review_data['answers'][$group.fields.3.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <th colspan="4" class="left">Kommun</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.5.id}" value="{$review_data['answers'][$group.fields.5.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.6.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.6.name}</a>
                                                                        {else}
                                                                            {$group.fields.6.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.6.id}" value="{$review_data['answers'][$group.fields.6.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.7.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.7.name}</a>
                                                                        {else}
                                                                            {$group.fields.7.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.7.id}" value="{$review_data['answers'][$group.fields.7.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.8.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.8.name}</a>
                                                                        {else}
                                                                            {$group.fields.8.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.8.id}" value="{$review_data['answers'][$group.fields.8.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.9.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.9.name}</a>
                                                                        {else}
                                                                            {$group.fields.9.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.9.id}" value="{$review_data['answers'][$group.fields.9.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 5}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.0.id}" value="{$review_data['answers'][$group.fields.0.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.1.id}" value="{$review_data['answers'][$group.fields.1.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.2.id}" value="{$review_data['answers'][$group.fields.2.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.3.id}" value="{$review_data['answers'][$group.fields.3.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.5.id}" value="{$review_data['answers'][$group.fields.5.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 6}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.0.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.0.name}</a>
                                                                        {else}
                                                                            {$group.fields.0.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.0.id}" value="{$review_data['answers'][$group.fields.0.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.1.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.1.name}</a>
                                                                        {else}
                                                                            {$group.fields.1.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.1.id}" value="{$review_data['answers'][$group.fields.1.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.2.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.2.name}</a>
                                                                        {else}
                                                                            {$group.fields.2.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.2.id}" value="{$review_data['answers'][$group.fields.2.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.3.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.3.name}</a>
                                                                        {else}
                                                                            {$group.fields.3.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.3.id}" value="{$review_data['answers'][$group.fields.3.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.4.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.4.name}</a>
                                                                        {else}
                                                                            {$group.fields.4.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.4.id}" value="{$review_data['answers'][$group.fields.4.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.5.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.5.name}</a>
                                                                        {else}
                                                                            {$group.fields.5.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.5.id}" value="{$review_data['answers'][$group.fields.5.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.6.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.6.name}</a>
                                                                        {else}
                                                                            {$group.fields.6.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.6.id}" value="{$review_data['answers'][$group.fields.6.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.7.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.7.name}</a>
                                                                        {else}
                                                                            {$group.fields.7.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.7.id}" value="{$review_data['answers'][$group.fields.7.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.8.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.8.name}</a>
                                                                        {else}
                                                                            {$group.fields.8.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.8.id}" value="{$review_data['answers'][$group.fields.8.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.9.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.9.name}</a>
                                                                        {else}
                                                                            {$group.fields.9.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.9.id}" value="{$review_data['answers'][$group.fields.9.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.10.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.10.name}</a>
                                                                        {else}
                                                                            {$group.fields.10.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.10.id}" value="{$review_data['answers'][$group.fields.10.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.11.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.11.name}</a>
                                                                        {else}
                                                                            {$group.fields.11.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.11.id}" value="{$review_data['answers'][$group.fields.11.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.12.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.12.name}</a>
                                                                        {else}
                                                                            {$group.fields.12.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.12.id}" value="{$review_data['answers'][$group.fields.12.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.13.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.13.name}</a>
                                                                        {else}
                                                                            {$group.fields.13.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.13.id}" value="{$review_data['answers'][$group.fields.13.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.14.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.14.name}</a>
                                                                        {else}
                                                                            {$group.fields.14.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.14.id}" value="{$review_data['answers'][$group.fields.14.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.15.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.15.name}</a>
                                                                        {else}
                                                                            {$group.fields.15.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td colspan="3"><input type="text" name="field_{$group.fields.15.id}" value="{$review_data['answers'][$group.fields.15.id]}" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.16.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.16.name}</a>
                                                                        {else}
                                                                            {$group.fields.16.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.16.id}" value="{$review_data['answers'][$group.fields.16.id]}" /></td>
                                                                    <td>
                                                                        {if $user_role eq 1 || $user_role eq 6}
                                                                            <a href="#" data-type="text" data-pk="{$group.fields.17.id}" class="labelval editable editable-click" style="display: inline;">{$group.fields.17.name}</a>
                                                                        {else}
                                                                            {$group.fields.17.name}
                                                                        {/if}
                                                                    </td>
                                                                    <td><input type="text" name="field_{$group.fields.17.id}" value="{$review_data['answers'][$group.fields.17.id]}" /></td>
                                                                </tr>
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 7}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                            <textarea name="field_{$field.id}" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    {if $review_data['answers'][$field.id]}
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;">{$review_data['answers'][$field.id]}</pre>
                                                                            </td>
                                                                        </tr>
                                                                    {/if}
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 8}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                            <textarea name="field_{$field.id}" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    {if $review_data['answers'][$field.id]}
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;">{$review_data['answers'][$field.id]}</pre>
                                                                            </td>
                                                                        </tr>
                                                                    {/if}
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 9}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                            <textarea name="field_{$field.id}" class="span12"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    {if $review_data['answers'][$field.id]}
                                                                        <tr>
                                                                            <td>
                                                                                <pre class=" pull-left mt span12" style="max-height: 260px; overflow: auto;">{$review_data['answers'][$field.id]}</pre>
                                                                            </td>
                                                                        </tr>
                                                                    {/if}
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 11}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="1" {if $review_data['answers'][$field_id]}checked="true"{/if} style="float: none;" style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="0" {if $review_data['answers'][$field_id] eq 0 && $review_data['answers'][$field_id] neq ''}checked="true"{/if} style="float: none;" style="float: none;" /></td>
                                                                    </tr>
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 12}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="1" {if $review_data['answers'][$field_id]}checked="true"{/if} style="float: none;" style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="0" {if $review_data['answers'][$field_id] eq 0 && $review_data['answers'][$field_id] neq ''}checked="true"{/if} style="float: none;" style="float: none;" /></td>
                                                                    </tr>
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 13}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                        </td>
                                                                        <td><input type="text" name="field_{$field.id}" value="{$review_data['answers'][$field_id]}" /></td>
                                                                    </tr>
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 14}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;1a hand</td>
                                                                    <td class="center">&nbsp;2a hand</td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="2" {if $review_data['answers'][$field_id] eq 2}checked="true"{/if} style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="3" {if $review_data['answers'][$field_id] eq 3}checked="true"{/if} style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="1" {if $review_data['answers'][$field_id] eq 1}checked="true"{/if} style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="0" {if $review_data['answers'][$field_id] eq 0 && $review_data['answers'][$field_id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                    </tr>
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                        {if $group_id eq 15}
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl" class="tbl_border">
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="center">&nbsp;Ja</td>
                                                                    <td class="center">&nbsp;Nej</td>
                                                                </tr>
                                                                {foreach from=$group.fields key=key_id item=field}
                                                                    <tr>
                                                                        <td>
                                                                            {if $user_role eq 1 || $user_role eq 6}
                                                                                <a href="#" data-type="text" data-pk="{$field.id}" class="labelval editable editable-click" style="display: inline;">{$field.name}</a>
                                                                            {else}
                                                                                {$field.name}
                                                                            {/if}
                                                                        </td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="1" {if $review_data['answers'][$field_id]}checked="true"{/if} style="float: none;" /></td>
                                                                        <td class="center"><input type="radio" name="field_{$field.id}" value="0" {if $review_data['answers'][$field_id] eq 0 && $review_data['answers'][$field_id] neq ''}checked="true"{/if} style="float: none;" /></td>
                                                                    </tr>
                                                                {/foreach}
                                                            </table>
                                                        {/if}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        </div>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Planerad uppföljning av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td></td>
                                            <td class="center">Bokad</td>
                                            <td class="center">Genomförd</td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Datum för uppföljning:</td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_uppfoljning_bokad" value="{$review_data['datum_for_uppfoljning_bokad']}" /></td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_uppfoljning_genomford" value="{$review_data['datum_for_uppfoljning_genomford']}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Datum för ordinarie:</td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_ordinarie_bokad" value="{$review_data['datum_for_ordinarie_bokad']}" /></td>
                                            <td width="30%"><input type="text" class="span12 datepicker" name="datum_for_ordinarie_genomford" value="{$review_data['datum_for_ordinarie_genomford']}" /></td>
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
                                            <td>Datum för upprättandet av GP</td>
                                            <td><input type="text" class="span6 datepicker required" name="datum_for_upprattandet_av_gp" id="datum_for_upprattandet_av_gp" value="{if $review_data['datum_for_upprattandet_av_gp']}{$review_data['datum_for_upprattandet_av_gp']}{else}{$smarty.now|date_format:'%Y-%m-%d'}{/if}" required="true" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Deltagare vid upprättandet av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Namn</td>
                                            <td>Befattning / Roll</td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name1" id="deltagare_vid_upprattandet_av_gp_name1" value="{if $review_data['deltagare_vid_upprattandet_av_gp_name1']}{$review_data['deltagare_vid_upprattandet_av_gp_name1']}{else}{$user_fullname}{/if}" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll1" id="deltagare_vid_upprattandet_av_gp_roll1" value="{if $review_data['deltagare_vid_upprattandet_av_gp_roll1']}{$review_data['deltagare_vid_upprattandet_av_gp_roll1']}{else}{$user_rolename}{/if}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name2" value="{$review_data['deltagare_vid_upprattandet_av_gp_name2']}" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll2" value="{$review_data['deltagare_vid_upprattandet_av_gp_roll2']}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name3" value="{$review_data['deltagare_vid_upprattandet_av_gp_name3']}" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll3" value="{$review_data['deltagare_vid_upprattandet_av_gp_roll3']}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name4" value="{$review_data['deltagare_vid_upprattandet_av_gp_name4']}" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll4" value="{$review_data['deltagare_vid_upprattandet_av_gp_roll4']}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_name5" value="{$review_data['deltagare_vid_upprattandet_av_gp_name5']}" /></td>
                                            <td width="50%"><input type="text" class="span12" name="deltagare_vid_upprattandet_av_gp_roll5" value="{$review_data['deltagare_vid_upprattandet_av_gp_roll5']}" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Godkännande av GP</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="25%">Dagens datum</td>
                                            <td width="25%">Befattning / Roll</td>
                                            <td width="25%">Namnförtydligande</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="span12 datepicker" name="dagens_datum_1" id="dagens_datum_1" value="{if $review_data['dagens_datum_1']}{$review_data['dagens_datum_1']}{else}{$smarty.now|date_format:'%Y-%m-%d'}{/if}" /></td>
                                            <td><input type="text" class="span12" name="befattning_roll_1" id="befattning_roll_1" value="{if $review_data['befattning_roll_1']}{$review_data['befattning_roll_1']}{else}{$user_rolename}{/if}" /></td>
                                            <td><input type="text" class="span12" name="namnfortydligande_1" id="namnfortydligande_1" value="{if $review_data['namnfortydligande_1']}{$review_data['namnfortydligande_1']}{else}{$user_fullname}{/if}" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="span12 datepicker" name="dagens_datum_2" value="{$review_data['dagens_datum_2']}" /></td>
                                            <td><input type="text" class="span12" name="befattning_roll_2" value="{$review_data['befattning_roll_2']}" /></td>
                                            <td><input type="text" class="span12" name="namnfortydligande_2" value="{$review_data['namnfortydligande_2']}" /></td>
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