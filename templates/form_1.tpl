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
                navigatePage('{$url_path}form_1.php?customer=' + customer_id, 8);
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
    navigatePage('{$url_path}form_1.php?review=' + reviewid +'&customer=' + customer, 8);
}

function addNew() {
    var customerid = document.getElementById("customer").value;
    if(customerid != "" && customerid != 0){
        navigatePage('{$url_path}form_1.php?customer=' + customerid, 8);
    }
}
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_1.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_1}
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
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}form_1.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
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
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">Arbetsmiljöbedömning hos uppdragsgivare</h4></span>
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
                                            <td colspan="3">{if $review_data}{$review_data['created_name']}{else}{$created_user_name}{/if}</td>
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
                                            <td colspan="4">Bedömning sker vid nystart, årligen eller vid förändring av bostad.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens fullständiga namn:</td>
                                            <td colspan="2">{if $review_data}{$review_data['customer_name']}{else}{if $sort_by_name == 1}{$customers[$customerid]['first_name']} {$customers[$customerid]['last_name']}{else}{$customers[$customerid]['last_name']} {$customers[$customerid]['first_name']}{/if}{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens personnummer:</td>
                                            <td colspan="2">{if $review_data}{$review_data['customer_century']}{$review_data['customer_social_security']}{else}{$customers[$customerid]['century']}{$customers[$customerid]['social_security']}{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Uppdragsgivarens fullständiga adress:</td>
                                            <td colspan="2">{if $review_data}{$review_data['customer_address']}{else}{$customers[$customerid]['address']}{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Bedömning utförd av:</td>
                                            <td colspan="2">
                                                <div class="input-prepend" style="margin: 0px;">
                                                    <span class="add-on icon-pencil"></span>
                                                    <select class="form-control" id="review_employee" name="review_employee">
                                                        <option value="">Välj</option>
                                                        {foreach $employees as $employee}
                                                            <option value="{$employee['username']}" {if $review_data}{if $review_data['review_employee'] eq $employee['username']}selected{/if}{else $employee['username'] eq $login_user}selected{/if}>{if $sort_by_name == 1}{$employee['first_name']|cat:' '|cat:$employee['last_name']}{else}{$employee['last_name']|cat:' '|cat:$employee['first_name']}{/if}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rapportdatum:</td>
                                            <td>
                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span10" name="review_date" type="text" id="review_date" value="{$review_data['review_date']}" maxlength="10" /> 
                                                </div>
                                            </td>
                                            <td>Planerat uppföljnings datum:</td>
                                            <td>
                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> 
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span10" name="review_next_date" type="text" id="review_next_date" value="{$review_data['review_next_date']}" maxlength="10" /> 
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">1. FYSISK och PSYKISK ARBETSMILJÖ</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Har information givits till personliga assistenter och anhöriga om vikten av en fungerande arbetsmiljö?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_1" id="field_r_1_1" value="1" {if $review_data['field_1_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_1" id="field_r_1_1" value="0" {if $review_data['field_1_1_radio'] neq 1 && $review_data['field_1_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_1" id="field_1_1" value="{$review_data['field_1_1_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Är uppdragsgivarens hem lokal- och utrymmesmässigt anpassad så att såväl dennes behov liksom
arbetstagarens arbetsmiljö kan tillgodoses på ett lämpligt sätt?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_2" id="field_r_1_2" value="1" {if $review_data['field_1_2_radio'] eq 1}checked="true"{/if}/>Ja</td>
                                            <td><input type="radio" name="field_r_1_2" id="field_r_1_2" value="0" {if $review_data['field_1_2_radio'] neq 1 && $review_data['field_1_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_2" id="field_1_2" value="{$review_data['field_1_2_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Är belysningen tillräcklig för alla arbetsuppgifter?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_3" id="field_r_1_3" value="1" {if $review_data['field_1_3_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_3" id="field_r_1_3" value="0" {if $review_data['field_1_3_radio'] neq 1 && $review_data['field_1_3_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_3" id="field_1_3" value="{$review_data['field_1_3_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Ges information till UG och anhöriga om arbetsmiljöaspekter, t.ex. rökning, husdjur, städning m.m.?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_4" id="field_r_1_4" value="1" {if $review_data['field_1_4_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_4" id="field_r_1_4" value="0" {if $review_data['field_1_4_radio'] neq 1 && $review_data['field_1_4_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_4" id="field_1_4" value="{$review_data['field_1_4_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">5. Ges information till UG och anhöriga om vikten av utrymme och hjälpmedel vid tunga lyft?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_5" id="field_r_1_5" value="1" {if $review_data['field_1_5_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_5" id="field_r_1_5" value="0" {if $review_data['field_1_5_radio'] neq 1 && $review_data['field_1_5_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_5" id="field_1_5" value="{$review_data['field_1_5_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">6. Är UG och anhöriga delaktiga i besluten om vilka uppgifter som ska respektive inte ska utföras?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_6" id="field_r_1_6" value="1" {if $review_data['field_1_6_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_6" id="field_r_1_6" value="0" {if $review_data['field_1_6_radio'] neq 1 && $review_data['field_1_6_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_6" id="field_1_6" value="{$review_data['field_1_6_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">7. Är el-utrustning säker?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_7" id="field_r_1_7" value="1" {if $review_data['field_1_7_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_1_7" id="field_r_1_7" value="0" {if $review_data['field_1_7_radio'] neq 1 && $review_data['field_1_7_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_7" id="field_1_7" value="{$review_data['field_1_7_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">8. Finns allergirisker? t.ex. rökning, husdjur, växter, undermålig ventilation eller dåligt klimat</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_8" id="field_r_1_8" value="0" {if $review_data['field_1_8_radio'] neq 1 && $review_data['field_1_8_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_1_8" id="field_r_1_8" value="1" {if $review_data['field_1_8_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_8" id="field_1_8" value="{$review_data['field_1_8_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">9. Är det ofta för varm, kallt eller dragit i bostaden?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_9" id="field_r_1_9" value="0" {if $review_data['field_1_9_radio'] neq 1 && $review_data['field_1_9_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_1_9" id="field_r_1_9" value="1" {if $review_data['field_1_9_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_9" id="field_1_9" value="{$review_data['field_1_9_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">10. Finns det något övrigt i den fysiska eller den psykiska arbetsmiljön som kan bli ett problem?
t.ex. olustkänsla, rädsla, trakasserier, ilska, irritation eller buller</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_1_10" id="field_r_1_10" value="0" {if $review_data['field_1_10_radio'] neq 1 && $review_data['field_1_10_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_1_10" id="field_r_1_10" value="1" {if $review_data['field_1_10_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_1_10" id="field_1_10" value="{$review_data['field_1_10_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">2. ERGONOMI</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns tillräckligt med utrymme vid förflyttning av UG?
t.ex. runt toalett, runt säng, i badrum, i hiss eller annat</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_1" id="field_r_2_1" value="1" {if $review_data['field_2_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_2_1" id="field_r_2_1" value="0" {if $review_data['field_2_1_radio'] neq 1 && $review_data['field_2_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_1" id="field_2_1" value="{$review_data['field_2_1_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns behov av utrustning eller förflyttningshjälpmedel för att arbetsuppgifterna ska kunna
utföras på ett säkert sätt och utan risk för skador? t.ex. förflyttning i säng, säng-stol eller stol-toalett</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_2" id="field_r_2_2" value="0" {if $review_data['field_2_2_radio'] neq 1 && $review_data['field_2_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_2_2" id="field_r_2_2" value="1" {if $review_data['field_2_2_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_2" id="field_2_2" value="{$review_data['field_2_2_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det något övrigt vad gäller ergonomi som kan bli ett problem?
t.ex. möbler, utrymmen, golvbeläggning, trösklar eller dörröppningar</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_3" id="field_r_2_3" value="0" {if $review_data['field_2_3_radio'] neq 1 && $review_data['field_2_3_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_2_3" id="field_r_2_3" value="1" {if $review_data['field_2_3_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_3" id="field_2_3" value="{$review_data['field_2_3_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Finns behov av individanpassad utbildning, utöver grundutbildningen, av ergonomi och arbetsteknik?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_4" id="field_r_2_4" value="0" {if $review_data['field_2_4_radio'] neq 1 && $review_data['field_2_4_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_2_4" id="field_r_2_4" value="1" {if $review_data['field_2_4_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_4" id="field_2_4" value="{$review_data['field_2_4_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">5. Finns tillgång till råd och stöd för arbetstagaren när kroppen signalerar överbelastning?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_2_5" id="field_r_2_5" value="1" {if $review_data['field_2_5_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_2_5" id="field_r_2_5" value="0" {if $review_data['field_2_5_radio'] neq 1 && $review_data['field_2_5_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_2_5" id="field_2_5" value="{$review_data['field_2_5_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">3. KEMIKALIEHANTERING</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Om farliga kemikalier förekommer, finns skyddsutrustning? t.ex. rengörings- och desinfektionsmedel</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_3_1" id="field_r_3_1" value="1" {if $review_data['field_3_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_3_1" id="field_r_3_1" value="0" {if $review_data['field_3_1_radio'] neq 1 && $review_data['field_3_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_3_1" id="field_3_1" value="{$review_data['field_3_1_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns det något övrigt som kan bli problem vad gäller kemikaliehantering? t.ex. eksem eller allergi</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_3_2" id="field_r_3_2" value="0" {if $review_data['field_3_2_radio'] neq 1 && $review_data['field_3_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_3_2" id="field_r_3_2" value="1" {if $review_data['field_3_2_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_3_2" id="field_3_2" value="{$review_data['field_3_2_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">4. HYGIEN OCH SMITTSKYDD</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns det plastförkläde och handskar?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_1" id="field_r_4_1" value="1" {if $review_data['field_4_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_4_1" id="field_r_4_1" value="0" {if $review_data['field_4_1_radio'] neq 1 && $review_data['field_4_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_1" id="field_4_1" value="{$review_data['field_4_1_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns möjlighet till god handhygien och handsprit?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_2" id="field_r_4_2" value="1" {if $review_data['field_4_2_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_4_2" id="field_r_4_2" value="0" {if $review_data['field_4_2_radio'] neq 1 && $review_data['field_4_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_2" id="field_4_2" value="{$review_data['field_4_2_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det något som kan bli problem vad gäller hygien och smittskydd? t.ex. risk för turbekulos, gulsot, HIV</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_4_3" id="field_r_4_3" value="0" {if $review_data['field_4_3_radio'] neq 1 && $review_data['field_4_3_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_4_3" id="field_r_4_3" value="1" {if $review_data['field_4_3_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_4_3" id="field_4_3" value="{$review_data['field_4_3_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">5. SÄKERHET</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns det risk för hot, våld eller hot om våld hos UG?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_1" id="field_r_5_1" value="0" {if $review_data['field_5_1_radio'] neq 1 && $review_data['field_5_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_5_1" id="field_r_5_1" value="1" {if $review_data['field_5_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_1" id="field_5_1" value="{$review_data['field_5_1_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Är hanteringen av uppdragsgivarens mediciner säker?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_2" id="field_r_5_2" value="1" {if $review_data['field_5_2_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_5_2" id="field_r_5_2" value="0" {if $review_data['field_5_2_radio'] neq 1 && $review_data['field_5_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_2" id="field_5_2" value="{$review_data['field_5_2_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns trafiksäkerhetsaspekter som bör beaktas vid transporter till och från UG? t.ex. dålig belysning</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_3" id="field_r_5_3" value="0" {if $review_data['field_5_3_radio'] neq 1 && $review_data['field_5_3_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_5_3" id="field_r_5_3" value="1" {if $review_data['field_5_3_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_3" id="field_5_3" value="{$review_data['field_5_3_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">4. Finns det något i övrigt som kan bli problem vad gäller säkerheten?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_5_4" id="field_r_5_4" value="0" {if $review_data['field_5_4_radio'] neq 1 && $review_data['field_5_4_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_5_4" id="field_r_5_4" value="1" {if $review_data['field_5_4_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_5_4" id="field_5_4" value="{$review_data['field_5_4_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">6. ÖVRIGT</h4></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td colspan="4">1. Finns språk- eller kultursvårigheter?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_1" id="field_r_6_1" value="0" {if $review_data['field_6_1_radio'] neq 1 && $review_data['field_6_1_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_6_1" id="field_r_6_1" value="1" {if $review_data['field_6_1_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_1" id="field_6_1" value="{$review_data['field_6_1_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">2. Finns det något i övrigt som kan bli problem vad gäller arbetsmiljön?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_2" id="field_r_6_2" value="0" {if $review_data['field_6_2_radio'] neq 1 && $review_data['field_6_2_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td><input type="radio" name="field_r_6_2" id="field_r_6_2" value="1" {if $review_data['field_6_2_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_2" id="field_6_2" value="{$review_data['field_6_2_val']}" placeholder="Vid JA skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">3. Finns det under jourtjänstgöring möjlighet till avskildhet så medarbetare får erforderlig vila,
samt närhet till kök, toalett och dusch?</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="field_r_6_3" id="field_r_6_3" value="1" {if $review_data['field_6_3_radio'] eq 1}checked="true"{/if}/>&nbsp;Ja</td>
                                            <td><input type="radio" name="field_r_6_3" id="field_r_6_3" value="0" {if $review_data['field_6_3_radio'] neq 1 && $review_data['field_6_3_radio'] neq ''}checked="true"{/if}/>&nbsp;Nej</td>
                                            <td>→</td>
                                            <td><input type="text" class="form-control" name="field_6_3" id="field_6_3" value="{$review_data['field_6_3_val']}" placeholder="Vid NEJ skriv åtgärd eller kommentar i Handlingplan" maxlength="100" style="width: 90%;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {*<input type="hidden" name="skapaarbetsgivarintyg2" value="ja" />*}
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