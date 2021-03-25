{block name="style"}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<style type="text/css">
    #samsida_hold input[type=checkbox], #samsida_hold input[type=radio] { vertical-align: text-top; }
    #samsida_hold input[type=radio] { margin-top: 2px !important; }
    .secondary-font { font-size: 11px;}
    table tbody tr td div { height: auto !important;}
    block-sub-heading { font-size: 12px;}
</style>
{/block}
{block name="script"}
<script src="{$url_path}js/date-picker.js"></script>
{*<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>*}
<script src="{$url_path}js/jquery.formatCurrency-1.4.0.js" type="text/javascript" ></script>
<script src="{$url_path}js/jquery.maskedinput.js" type="text/javascript" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker({
                    autoclose: true
        });
        /*$("#hospital_date_from, #hospital_date_to").datepicker({ 
                autoclose: true,
                startDate: "{$year}-{$month}-01",
                endDate: "{$year}-{$month}-{$limit}"
            })
        .on('changeDate', function(ev){
            var cur_event_id = $(ev.currentTarget).attr('id');
            var selectedDate = ev.date;
            //console.log(selectedDate);
            if(cur_event_id == 'hospital_date_from')
                $( "#hospital_date_to" ).datepicker("setStartDate", selectedDate );
            else if(cur_event_id == 'hospital_date_to')
                $( "#hospital_date_from" ).datepicker("setEndDate", selectedDate );
        });*/
        $(".hospital_dates").datepicker({ 
            autoclose: true,
            startDate: "{$year}-{$month}-01",
            endDate: "{$year}-{$month}-{$limit}"
        });
        
        $("#acc_date_from, #acc_date_to").datepicker({ 
            autoclose: true,
            clearBtn: true,
            language: '{$lang}',
        })
        .on('changeDate', function(ev){
            var cur_event_id = $(ev.currentTarget).attr('id');
            var selectedDate = ev.date;
            //console.log(selectedDate);
            if(cur_event_id == 'acc_date_from')
                $( "#acc_date_to" ).datepicker("setStartDate", selectedDate );
            else if(cur_event_id == 'acc_date_to')
                $( "#acc_date_from" ).datepicker("setEndDate", selectedDate );
            
            var acc_from = $("#acc_date_from").val().trim();
            var acc_to = $("#acc_date_to").val().trim();
            
            if(acc_from != '' && acc_to != ''){
                var customer = $("#customer").val().trim();
                if(acc_from > acc_to){
                    alert('Choose correct date interval..');
                }else if(customer != ''){
                    wrapLoader("#account_dates");
                    $.ajax({
                        url:"{$url_path}ajax_get_customer_work_hours.php",
                        type:"POST",
                        data:'customer='+customer+'&acc_from='+acc_from+'&acc_to='+acc_to+'&fkkn={$rpt_type}',
                        success:function(data){
                            $("#customer_hours").val(data);
                            uwrapLoader("#account_dates");
                        }
                    });
                }
            }
        });
        

        $.mask.definitions['~']='[1-9]';
        $("#signed_customer_telephone").mask("0?~9-999 99 99 99", { placeholder:" " });
        $("#signed_customer_ssn").mask("?99999999-9999", { placeholder:" " });
        $("#section6_phone").mask("0?~9-999 99 99 99", { placeholder:" " });
        
        $('#section_3_choice_2').change(function(){
            var org_no = '';
            if($('#section_3_choice_2:checked').val() == 1){
                org_no = $('#section_3_org_no').attr('data-org-no');
            }else{
                org_no = '';
                var reseted_orgno = $('#section_3_org_no').val();
                $('#section_3_org_no').attr('data-org-no', reseted_orgno);
            }
            $('#section_3_org_no').val(org_no);
        });
        
        $('[name=who_signed]').change(function(){
            var phno = $(this).attr('data-phone');
            var name = $(this).attr('data-name');
            var ssn = $(this).attr('data-ssn');
            $('#section6_phone').val(phno);
            $('#signed_customer_telephone').val(phno);
            $('#signed_customer_ssn').val(ssn);
            $('#signed_customer_name').val(name);
            $.mask.definitions['~']='[1-9]';
            $("#section6_phone").mask("0?~9-999 99 99 99", { placeholder:" " });
            $("#signed_customer_telephone").mask("0?~9-999 99 99 99", { placeholder:" " });
            $("#signed_customer_ssn").mask("?99999999-9999", { placeholder:" " });
        });

        //to format currency on page load
        //format_time_field
        // $('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9  });
        // $("#total_cost").formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
        $(".format_time_field").mask("99.99", { placeholder:"0" });
        
    });

    (function( $ ){

        $.fn.uncheckableRadio = function() {

            return this.each(function() {
                $(this).mousedown(function() {
                    $(this).data('wasChecked', this.checked);
                });

                $(this).click(function() {
                    if ($(this).data('wasChecked'))
                        this.checked = false;
                });
            });

        };

        $('input[type=radio]').uncheckableRadio();

    })( jQuery );

        
    function saveForm(type){
        $('#save_print').val(type);
        if(type == 1)
                $("#input_form").attr('target','_blank');
         else
                $("#input_form").attr('target','_self');
         $("#input_form").submit();
         
        {*var ja = $("#ja_4_2").val();
        if(ja == 1){
                var limit = $("#date_limit").val();
                if(isNaN($("#txt_4_2_1_1").val()))
                    alert("{$translate.from_date_numeric}");
                else if(isNaN($("#txt_4_2_1_2").val()))
                    alert("{$translate.to_date_numeric}");
                else if((parseFloat($("#txt_4_2_1_1").val()) >=  parseFloat($("#txt_4_2_1_2").val()) && parseFloat($("#txt_4_2_1_2").val())!=""))
                    alert("{$translate.to_date_greater}");
                else if((parseFloat($("#txt_4_2_1_1").val()) >= limit || parseFloat($("#txt_4_2_1_2").val()) >= limit ) && parseFloat($("#txt_4_2_1_2").val())!=""  && parseFloat($("#txt_4_2_1_1").val())!="")
                    alert("{$translate.value_not_exceed} "+limit);
                else
                    $("#input_form").submit();
          }else{
                $("#input_form").submit();
          }*}
    }
</script>
{/block}
{block name="content"}
{if $flag_cust_access == 1}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    Räkning - Assistansersättning
                    <ul class="pull-right">
                        <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm(0);"><span class="special_spn">{$translate.save}</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <div id="tble_list" class=" span12 no-ml">
            <div id="samsida_hold">
                {*<form id="input_form" name="input_form" method="post" action="{$url_path}pdf/report/work/customer/summary/{$month}/{$year}/{$customer}/{$rpt_type}/{$rpt_emp}/">*}
                <form id="input_form" name="input_form" method="post" action="">
                    <input type="hidden" name="customer" id="customer" value="{$customer}" />
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                        <tbody>
{*                            top section*}
                            <tr>
                                <td align="left" width="50%" valign="top" scope="col" style="font-size: 11px; line-height: 1.5"> 
                                        Blanketten ska skickas in varje månad i efterskott, <br/>
                                        senast den 5.e dagen i månaden, tillsammans med en <br/>
                                        kopia av tidsredovisningen för antal utförda timmar. <br/>
                                        Tidsredovisningen ska undertecknas av den enskilde/ <br/>
                                        legal ställföreträdare samt assistenter eller assistans -<br/> 
                                        anordnare. Uppgifterna utgör underlag för kommunens<br/>
                                        utbetalning. Inga fakturor tas emot.</td>
                                <td align="left" width="50%" valign="top" scope="col"> <b>Period {$year} / {$translate.$month_name} </b> </td>
                            </tr>
{*                            Section 1*}
                            <tr>
                                <th align="left" valign="bottom"> 1. Du som har personlig assistans </th>
                                <th align="left" width="50%" valign="top" scope="col">&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="75%" align="left" valign="top" scope="col">Förnamn och efternamn 
                                                <span class="special_spn">{$cust_full_name}</span></td>
                                            <td width="25%" align="left" valign="top" scope="col"> Personnummer 
                                                <span class="special_spn">{$SSN}</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr>
{*                            Section 2*}
                            <tr>
                                <th align="left" valign="bottom"> 2. Antal beviljade timmar assistans timmar </th>
                                <th align="left" width="50%" valign="top" scope="col">&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="50%" align="left" valign="top" scope="col">Antal beviljade timmar och minuter per vecka
                                                {foreach from=$cust_contract_in_this_year_month item=cust_contract}
                                                    <span class="special_spn">{$cust_contract.weekly_hours}{*$cust_contract.hour*}</span>
                                                {/foreach}
                                            </td>
                                            <td width="50%" align="left" valign="top" scope="col"> Period för beslutet F.r.o.m – T.o.m 
                                                {foreach from=$cust_contract_in_this_year_month item=cust_contract}
                                                    <span class="special_spn">{$cust_contract.date_from} -- {$cust_contract.date_to}</span>
                                                {/foreach}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr>
{*                            Section 3*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom" scope="col"> 3.  Redovisning av utförd assistans </th>
                                            <td width="50%" align="left" valign="top" scope="col"> Tidsredovisning assistansersättning (3059)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td width="33%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Aktiv tid</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            {assign var='normal_parts' value='.'|explode:$Tot_normal}
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn">{$normal_parts[0]}</span><span class="span4 no-min-height special_spn">{$normal_parts[1]}</span>{*$Tot_normal*}
                                                            </div></td>
                                                        <td width="33%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-min-height">Väntetid, faktiska timmar</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            {assign var='oncall_parts' value='.'|explode:$Tot_onCall}
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn">{$oncall_parts[0]}</span><span class="span4 no-min-height special_spn">{$oncall_parts[1]}</span>{*$Tot_onCall*}
                                                            </div></td>
                                                        <td width="33%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Beredskapstid, faktiska timmar</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">
                                                                <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                            </div>
                                                            {assign var='beredskap_parts' value='.'|explode:$Tot_beredskap}
                                                            <div class="span12 no-ml">
                                                                <span class="span4 no-min-height special_spn">{$beredskap_parts[0]}</span><span class="span4 no-min-height special_spn">{$beredskap_parts[1]}</span>{*$Tot_beredskap*}
                                                            </div></td>
                                                        {* <td width="25%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-min-height">&nbsp;</div>
                                                            <div class="secondary-font span12 no-ml no-min-height">&nbsp;</div>
                                                            <p><span class="special_spn"> {$total} </span></p></td> *}
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" align="left" valign="top">
                                                            <table width="100%"  cellspacing="0" cellpadding="0" style="padding:0px;">
                                                                <tr>
                                                                    <td style="padding:0px;"><table width="100%" cellspacing="0" cellpadding="0" style="padding-top:0px;">
                                                                            <tr>
                                                                                <td style="padding:0px;">&nbsp;</td>
                                                                                <td style="padding:0px;">antal</td>
                                                                                <td style="padding:0px;">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0px;" width="15%">Jag skickar med</td>
                                                                                <td style="padding:0px;" width="5%"><span class="special_spn">{$no_of_employees_have_slots} </span></td>
                                                                                <td style="padding:0px;" width="80%">Tidsredovisning personlig assistans</td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table>
                                                        </th>
                                                    </tr>
                                                </table> 
                                                &nbsp;* Väntetiden räknas om till assistanstid genom att antalet faktiska timmar delas med 4.<br />
                                                ** Beredskapstiden räknas om till assistanstid genom att antalet faktiska timmar delas med 7
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr>

                            <!-- <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr> -->
{*                            Section 4*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom">4. Har du vårdats på sjukhus den här månaden?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr></tr>
                                                    <tr>
                                                        <td colspan="5"><label><input type="radio" name="did_u_hostpilized_this_month" {if $reports['did_u_hostpilized_this_month'] === '0'}checked="checked"{/if} value="0" /> &nbsp;Nej</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td rowspan="3">&nbsp;<label><input type="radio" name="did_u_hostpilized_this_month" style="float:left;" value="1" {if $reports['did_u_hostpilized_this_month'] eq 1}checked="checked"{/if}/> &nbsp;Ja</label><br /></td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_from">Från och med (år, månad, dag)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_from']}{/if}" name="hospital_date_from" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Klockslag</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_from'] != null}{sprintf('%05.02f', $reports['hostpilized_time_from'])}{/if}" name="hospital_time_from"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_to">Till och med (år, månad, dag)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker ">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_to']}{/if}" id="hospital_date_to" name="hospital_date_to" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Klockslag</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_to'] != null}{sprintf('%05.02f', $reports['hostpilized_time_to'])}{/if}" name="hospital_time_to"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from2" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_from2']}{/if}" name="hospital_date_from2" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_from2'] != null}{sprintf('%05.02f', $reports['hostpilized_time_from2'])}{/if}" name="hospital_time_from2"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_to2']}{/if}" id="hospital_date_to2" name="hospital_date_to2" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_to2'] != null}{sprintf('%05.02f', $reports['hostpilized_time_to2'])}{/if}" name="hospital_time_to2"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" id="hospital_date_from3" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_from3']}{/if}" name="hospital_date_from3" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_from3'] != null}{sprintf('%05.02f', $reports['hostpilized_time_from3'])}{/if}" name="hospital_time_from3"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11 hospital_dates" value="{if $reports['did_u_hostpilized_this_month'] eq 1}{$reports['hostpilized_date_to3']}{/if}" id="hospital_date_to3" name="hospital_date_to3" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control format_time_field" maxlength="20" value="{if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['hostpilized_time_to3'] != null}{sprintf('%05.02f', $reports['hostpilized_time_to3'])}{/if}" name="hospital_time_to3"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="minus_padding">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="3"><p>Har du varit i kontakt med biståndshandläggare gällande personlig assistans under sjukhusvistelse?</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_have_received_personal_assistance" value="1" {if $reports['have_received_personal_assistance'] eq 1}checked="checked"{/if} /> &nbsp;Ja</label></td>
                                                                    <td width="85%" align="left" valign="middle"><label><input type="radio" name="rd_have_received_personal_assistance" value="2" {if $reports['have_received_personal_assistance'] eq 2}checked="checked"{/if} /> &nbsp;Nej</label><br /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" align="left" valign="top"><label>
                                                            <p style="float:left"><input type="checkbox" name="have_u_contact_with_assistant_counselors" value="1" {if $edit eq 'true' and $reports['have_u_contact_with_assistant_counselors'] eq 1}checked="checked"{/if}/></p>
                                                            <p style="float:left; margin-left:3px;">&nbsp;Jag har fått personlig assistans under tiden jag vårdades på sjukhus. Timmarna ingår i redovisningen under punkt 2.</p>
                                                        </label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
{*                            Section 5*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom">5. Har du anlitat en assistent som är bosatt utanför EES - området?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="5" width="10%" align="left" valign="top" class="no-padding">
                                                            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                                                <tr>
                                                                    <td width="10%" align="left" valign="top" style="border-right: 1px solid #ccc;"><label>
                                                                        <p style="float:left"><input type="checkbox" name="section_3_choice_4" value="1" {if ($edit eq 'true' and $sec3_check_values[3] eq 1) or ($edit neq 'true' and $prev_sec3_check_values[3] eq 1)}checked="checked"{/if}/></p>
                                                                        <p style="float:left; margin-left:3px;">&nbsp;Ja</p>
                                                                    </label></td>
                                                                    <td colspan="4" align="left" valign="top">Bifoga en förklaring till varför du behövde anlita en assistent på plats. Skicka också in handlingar som styrker dina uppgifter.</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hired_assistant_date_from">F.r.o.m <br/>&nbsp;</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11" id="hired_assistant_date_from" value="{if $edit eq 'true' and $sec3_check_values[3] eq 1}{$reports['hired_assistant_date_from']}{/if}" name="hired_assistant_date_from" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hired_assistant_date_to">T.o.m <br/>&nbsp;</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11" id="hired_assistant_date_to" value="{if $edit eq 'true' and $sec3_check_values[3] eq 1}{$reports['hired_assistant_date_to']}{/if}" name="hired_assistant_date_to" type="text" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Aktiv tid <br/>(Timmar och minuter)</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control" maxlength="20" value="{if $edit eq 'true' and $sec3_check_values[3] eq 1}{$reports['hired_assistant_normal_hours']}{/if}" name="hired_assistant_normal_hours"></span>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Väntetid, faktiska timmar <br/>(Timmar och minuter)</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control" maxlength="20" value="{if $edit eq 'true' and $sec3_check_values[3] eq 1}{$reports['hired_assistant_oncall_hours']}{/if}" name="hired_assistant_oncall_hours"></span>
                                                            </div>
                                                        </td>
                                                        <td width="10%" align="left" valign="top" scope="col">
                                                            <div class="secondary-font span12 no-ml no-min-height">Beredskapstid, faktiska timmar <br/>(Timmar och minuter)</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn no-mt no-mb"><input type="text" class="form-control" maxlength="20" value="{if $edit eq 'true' and $sec3_check_values[3] eq 1}{$reports['hired_assistant_standby_hours']}{/if}" name="hired_assistant_standby_hours"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
{*                            Section 6*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom" scope="col"> 6.  Assistansanordnare   </th>
                                            <td width="50%" align="left" valign="top" scope="col"> arbetsgivare för personlig assistans som utför beviljade assistans timmar</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td width="50%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Bolags namn och organisations nummer</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span6 no-min-height special_spn">{$company_details.name}</span><span class="span6 no-min-height special_spn">{$company_organization_no_formated}</span>
                                                            </div></td>
                                                        <td width="50%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-min-height">Telefon nummer</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn">{$company_phone_formated}</span>
                                                            </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%" align="left" valign="top" scope="col"> 
                                                            <div class="span12 no-min-height">Mejladress</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn">{$company_details.email}</span>
                                                            </div></td>
                                                        <td width="50%" align="left" valign="top" scope="col">
                                                            <div class="span12 no-min-height">Ersättningen betalas ut till kontonummer inklusive clearingnummer</div>
                                                            <div class="span12 no-ml">
                                                                <span class="span12 no-min-height special_spn">{$company_details.bank_account}</span>
                                                            </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="minus_padding">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="3"><p>Tillstånd från inspektionen för vård och omsorg (IVO)</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_permission_from_care_inspectorate" value="1" {if $reports['permission_from_care_inspectorate'] eq 1}checked="checked"{/if} /> &nbsp;Ja</label></td>
                                                                    <td width="85%" align="left" valign="middle"><label><input type="radio" name="rd_permission_from_care_inspectorate" value="2" {if $reports['permission_from_care_inspectorate'] eq 2}checked="checked"{/if} /> &nbsp;Nej</label><br /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td align="left" valign="top" class="minus_padding" colspan="2">&nbsp;</td></tr>

{*                            Section 7*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom"> &nbsp;7. Underskrift</th>
                                            <td width="35%" align="left">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="4">Jag försäkrar på heder och samvete att uppgifterna i blanketten är riktiga och fullständiga.<br/>
                                                                    När uppgifterna förändras måste jag meddela Försäkringskassan. Jag vet att det är straffbart att lämna felaktiga uppgifter, <br/>
                                                                    att utelämna något eller att inte meddela Försäkringskassan när uppgifterna jag lämnat förändras.</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="22%">
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="hospital_date_to">Datum</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span11" value="{if $edit eq 'true'}{$reports['sign_date']}{else}{$today_date}{/if}" id="sign_date" name="sign_date" type="text" maxlength="10" readonly="readonly" />
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="42%" align="left" valign="top">&nbsp;Namnteckning<br /></td>
                                                        <td width="36%" align="left" valign="top">&nbsp;Telefon, även riktnummer<br />
                                                            <input type="text" style="vertical-align: bottom;" maxlength="100" value="{if $edit eq 'true' and ($reports['signature_options'] eq 1 or $reports['signature_options'] eq 2 or $reports['signature_options'] eq 3)}{$section6_phone}{/if}" name="section6_phone" id="section6_phone" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
{*                            Section 8*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th width="61%" align="left" valign="bottom"> &nbsp;8. Fyll i här om du som skrivit under är ställföreträdare</th>
                                            <td width="39%" align="left">Om du som undertecknat ansökan är vårdnadshavare,<br /> god man eller förvaltare vill vi ha uppgifter om dig.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3">
                                                            <p>Jag är</p>
                                                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    {*<td width="20%" align="left" valign="top"><label><input type="radio" name="who_signed" value="1" {if $edit eq 'true' and $reports['signature_options'] eq 1}checked="checked"{/if} data-phone="{$customer_phone}" data-name="{$cust_full_name}" data-ssn="{$cust_ssn}" /> &nbsp;{$translate.customer_samsida}</label></td>*}
                                                                    <td width="20%" align="left" valign="top"><label><input type="radio" name="who_signed" value="1" {if $edit eq 'true' and $reports['signature_options'] eq 1}checked="checked"{/if} data-phone="{$customer_gardian_details.mobile3}" data-name="{$customer_gardian_details.first_name3|cat:' '|cat:$customer_gardian_details.last_name3}" data-ssn="{$customer_gardian_details.ssn3_formated}" /> &nbsp;{$translate.guardian3_samsida}</label></td>
                                                                    <td width="20%"><label><input type="radio" name="who_signed"  value="2" {if $edit eq 'true' and $reports['signature_options'] eq 2}checked="checked"{/if} data-phone="{$customer_gardian_details.mobile}" data-name="{$customer_gardian_details.first_name|cat:' '|cat:$customer_gardian_details.last_name}" data-ssn="{$customer_gardian_details.ssn_formated}" /> &nbsp;{$translate.guardian1_samsida}</label></td>
                                                                    <td><label><input type="radio" name="who_signed"  value="3" {if $edit eq 'true' and $reports['signature_options'] eq 3}checked="checked"{/if} data-phone="{$customer_gardian_details.mobile2}" data-name="{$customer_gardian_details.first_name2|cat:' '|cat:$customer_gardian_details.last_name2}" data-ssn="{$customer_gardian_details.ssn2_formated}" /> &nbsp;{$translate.guardian2_samsida}</label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='70%'><p>Namnförtydligande</p>
                                                            <p><input class="span12" type="text" style="vertical-align: bottom;" maxlength="100" value="{if $edit eq 'true'}{$reports['signed_employer_name']}{/if}" name="signed_customer_name" id="signed_customer_name" /></p></td>
                                                        <td width="162"><p>Personnummer (12 siffror)</p>
                                                            <p><input class="span12" type="text" style="vertical-align: bottom;" maxlength="100" value="{if $edit eq 'true'}{$reports['signed_employer_ssn']}{/if}" name="signed_customer_ssn" id="signed_customer_ssn" /></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">Uppgifterna hanteras i kommunens datasystem.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
                            
                            
                            <tr>
                                <input type="hidden"  id="save_print" value="0" name="save_print"  />
                                <td style=" margin-bottom:10px; margin-top:10px;" align="left" valign="top" class="minus_padding" colspan="2">
                                    <span class="span12">
                                        <button type="button" onclick="return saveForm(1);" class="btn btn-primary pull-right mr ml"  id=""><i class='icon-print'></i> {$translate.save_and_print}</button>
                                        <button type="button" onclick="return saveForm(0);" class="btn btn-primary pull-right mr"  id=""><i class='icon-save'></i> {$translate.save}</button>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right; padding-right:10px;" ><div style="color:#BB5613;font-weight:bold;" id="error_data" ></div></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
{else}
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="alert alert-danger alert-dismissable">
            <strong><i class="icon-remove-sign icon-large"></i> {$translate.message_caption_error}</strong>:  {$translate.permission_denied}
        </div>
    </div>
</div>
{/if}                     
{/block}