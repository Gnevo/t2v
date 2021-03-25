{block name='style'}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<style> .panel-title ul li{ color: #333;}</style>
{/block}

{block name='script'}
<script src="{$url_path}js/bootbox.js"></script>

<script type="text/javascript">
    
$(document).ready(function(){
    // if($(window).height() > 300)
    //     $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
    // else
    //     $('#employee_tab_content_pdf_form').css({ height: $(window).height()});  
        
    $(window).resize(function(){
        if($(window).height() > 300)
            $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
        else
            $('#employee_tab_content_pdf_form').css({ height: $(window).height()});
    }).resize();
                    
});
    
function printForm(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
        
        setTimeout(function(){ 
                navigatePage('{$url_path}pdf/payment/leave/'+$("#year").val()+'/'+$("#month").val()+'/'+$("#customer").val()+'/'+$("#employee").val()+'/',8);
            }, 9000);
    }
}

function printWorkReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printWorkReport');
        f.submit();
    }
    {*if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        f.attr('target', '__formresult');
        $('#action').val('printWorkReport');
        window.open('about:blank', '__formresult', 'menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');
        f.submit();
    }*}
}

function printSickDetailsAndWorkReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printSickDetailsAndWorkReport');
        f.submit();
    }
}

function printSickDetailsReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printSickDetailsReport');
        f.submit();
    }
    {*if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        f.attr('target', '__formresult');
        $('#action').val('printSickDetailsReport');
        window.open('about:blank', '__formresult', 'menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');
        f.submit();
    }*}
}


function printFKWorkReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printFKWorkReport');
        f.submit();
    }
}
function printFKDeviationReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printFKDeviationReport');
        f.submit();
    }
}
function printVikarie3059Report(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        f.attr('target', '_self');
        $('#action').val('printVikarie3059Report');
        f.submit();
    }
}

{*annex report only for company optimal*}
function printAnnexReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        // f.attr('target', '_self');
        $('#action').val('printAnnexReport');
        f.submit();
    }
}

function printVikarieListReport(){
    // if('{$relations}'){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('printVikarieListReport');
        f.submit();    
    // }
    // else{
    //     bootbox.dialog('{$translate.no_data_available}', [
    //         {
    //             "label" : "{$translate.ok}",
    //             "class" : "btn-danger",
    //         }
    //     ]);
    // }
    
}

function loadCustomers(){
    var year = $("#year").val();
    var month = $("#month").val();
    navigatePage('{$url_path}pdf/payment/leave/'+year+'/'+month+'/',8);
    {*$.ajax({
        async:false,
        url:"{$url_path}ajax_leave_payment_inputs.php",
        data:"month="+month+"&year="+year,
        type:"POST",
        success:function(data){
                $("#leave_inputs").html(data);
                }
    });*}
}
    
function loadEmployees(){
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    navigatePage('{$url_path}pdf/payment/leave/'+year+'/'+month+'/'+customer+'/',8);
    {*$.ajax({
        async:false,
        url:"{$url_path}ajax_leave_payment_inputs.php",
        data:"month="+month+"&year="+year+"&customer="+customer,
        type:"POST",
        success:function(data){
                    $("#leave_inputs").html(data);
                }
    });*}
}
    
function show_sicks(){
    var s_name = $("#old_pdf").val();
    if(s_name != ""){
            window.open("{$url_path}pdf_viewer.php?name="+s_name+'&rename=true');
    }
}

function submitForm(){
    $("#forms").attr('target', '_self');
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    var employee =$("#employee").val();
    navigatePage('{$url_path}pdf/payment/leave/'+year+'/'+month+'/'+customer+'/'+employee+'/',8);
    {*$.ajax({
        async:false,
        url:"{$url_path}ajax_leave_payment_inputs.php",
        data:"month="+month+"&year="+year+"&customer="+customer+"&employee="+employee,
        type:"POST",
        success:function(data){
                    $("#leave_inputs").html(data);
                }
    });*}
}
</script>

{/block}

{block name="content"}
{$message}
{if $flag_cust_access == 1}
<div class="row-fluid">
    <div class="span12 main-left" style="overflow:hidden; height: 623px;">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    {$translate.leave_report}
                    <ul class="pull-right">
                        <li><i class="icon-arrow-left"></i><a href="{$url_path}forms/"><span class="special_spn">{$translate.backs}</span></a></li>
                        <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}pdf/payment/leave/',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                        <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="printForm();"><span class="special_spn">{$translate.save_n_print}</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <form name="forms" id="forms" method="post" action="{$url_path}pdf/payment/leave/">
            <input type="hidden" name="action" id="action" value="" />
            <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />

            <div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
                <div id="employee_tab_content_pdf_form" class="span12" style="background: none repeat scroll 0 0 #ffffff;border: 1px solid #dcdcdc;padding: 15px; overflow-y: auto;">
                    <div class="span12" name="leave_inputs" id="leave_inputs">
                        <div class="span8">
                            <div class="span12">
                                <span class="span6">
                                    <label class="pull-left span3">{$translate.year}:</label>
                                    <select id="year" name="year" style="border:solid 1px #d9d9d9">
                                        <option value="">{$translate.select}</option>
                                        {html_options values=$years_combo selected=$report_year output=$years_combo}
                                    </select>
                                </span>
                                <span class="span6"> <label class="pull-left span3">{$translate.month}: </label>
                                    <select style="border:solid 1px #d9d9d9" onchange="loadCustomers()" id="month" name="month">
                                        <option value="" >{$translate.select}</option>
                                        {if $month == ''}
                                            <option value="01" {if  $smarty.now|date_format:"%m" == 1} selected = "selected" {/if} >{$translate.jan}</option>
                                            <option value="02" {if  $smarty.now|date_format:"%m" == 2} selected = "selected" {/if}>{$translate.feb}</option>
                                            <option value="03" {if  $smarty.now|date_format:"%m" == 3} selected = "selected" {/if}>{$translate.mar}</option>
                                            <option value="04" {if  $smarty.now|date_format:"%m" == 4} selected = "selected" {/if}>{$translate.apr}</option>
                                            <option value="05" {if  $smarty.now|date_format:"%m" == 5} selected = "selected" {/if}>{$translate.may}</option>
                                            <option value="06" {if  $smarty.now|date_format:"%m" == 6} selected = "selected" {/if}>{$translate.jun}</option>
                                            <option value="07" {if  $smarty.now|date_format:"%m" == 7} selected = "selected" {/if}>{$translate.jul}</option>
                                            <option value="08" {if  $smarty.now|date_format:"%m" == 8} selected = "selected" {/if}>{$translate.aug}</option>
                                            <option value="09" {if  $smarty.now|date_format:"%m" == 9} selected = "selected" {/if}>{$translate.sep}</option>
                                            <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.oct}</option>
                                            <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.nov}</option>
                                            <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.dec}</option>
                                        {else}
                                            <option value="01" {if  $month == 1} selected = "selected" {/if}>{$translate.jan}</option>
                                            <option value="02" {if  $month == 2} selected = "selected" {/if}>{$translate.feb}</option>
                                            <option value="03" {if  $month == 3} selected = "selected" {/if}>{$translate.mar}</option>
                                            <option value="04" {if  $month == 4} selected = "selected" {/if}>{$translate.apr}</option>
                                            <option value="05" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                            <option value="06" {if  $month == 6} selected = "selected" {/if}>{$translate.jun}</option>
                                            <option value="07" {if  $month == 7} selected = "selected" {/if}>{$translate.jul}</option>
                                            <option value="08" {if  $month == 8} selected = "selected" {/if}>{$translate.aug}</option>
                                            <option value="09" {if  $month == 9} selected = "selected" {/if}>{$translate.sep}</option>
                                            <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
                                            <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
                                            <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
                                        {/if}
                                    </select>
                                </span>
                            </div>
                            <div class="span12 no-ml">
                                <span class="span6"> <label class="pull-left span3">{$translate.choose_user}</label>
                                    <select id="customer" name="customer" onchange="loadEmployees()" style="border:solid 1px #d9d9d9">
                                        <option value="">{$translate.select}</option>
                                        {if $customers|count gt 1}
                                            <option value="ALL" {if $cust == 'ALL' or $selected_all_customers eq TRUE}selected="selected" {/if}>{$translate.all}</option>
                                        {/if}
                                        {foreach from=$customers item=customer}
                                            <option value="{$customer.customer_id}" {if $cust== $customer.customer_id}selected="selected" {/if} >{if $sort_by_name == 1}{$customer.cust_ff}{elseif $sort_by_name == 2}{$customer.cust}{/if}</option>
                                        {/foreach}
                                    </select>
                                </span>
                                <span class="span6"><label class="pull-left span3">{$translate.choose_assistant}: </label>
                                    <select id="employee" name="employee" onchange="submitForm()" style="border:solid 1px #d9d9d9">
                                        <option value="">{$translate.select}</option>
                                        {if $employees|count gt 1}
                                            <option value="ALL" {if $emp == 'ALL' or $selected_all_employees eq TRUE}selected="selected" {/if}>{$translate.all}</option>
                                        {/if}
                                        {foreach from=$employees item=employee}
                                            <option value="{$employee.employee_id}" {if $emp == $employee.employee_id}selected="selected" {/if} >{if $sort_by_name == 1}{$employee.employee_ff}{elseif $sort_by_name == 2}{$employee.employee}{/if}</option>
                                        {/foreach}
                                    </select>
                                </span>
                            </div>
                                    
                            {if $sicks}
                                <div class="span12 no-ml">
                                    <label class="pull-left span3">Tidigare Sjukblanketter:</label>
                                    <select style="border:solid 1px #d9d9d9" onchange="show_sicks()" id="old_pdf" name="old_pdf">
                                        <option value=""  selected >{$translate.select}</option>
                                        {foreach from=$sicks item=entries}
                                            <option value={$entries.file}>{$entries.date}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            {/if}
                        </div>
                        <span style="" class="span4 pull-right">
                            {if $cust != '' or $selected_all_customers eq TRUE}
                                <span class="span12 pull-right">
                                    {*if $show_work_report_button*}
                                    {*if (($cust != '' and $emp != '') or ($cust == 'ALL' or $selected_all_customers eq TRUE)) or ($emp != '' or $emp == 'ALL' or $selected_all_employees eq TRUE)*}
                                    
                                        <span class="span6 pull-right">
                                            <button type="button" onclick="printWorkReport();" class="btn btn-primary pull-right no-mr ml span12"><i class="icon-file-text"></i> {$translate.print_work_report}</button>
                                        </span>
                                        <span class="span6 pull-right">
                                            <button type="button" onclick="printSickDetailsReport();" class="btn btn-primary pull-right mr span12"><i class="icon-file-text"></i> {if $login_company_id eq 8}{$translate.print_sick_details_report_optimal}{else}{$translate.print_sick_details_report}{/if}</button>
                                        </span>
                                </span>  
                                
                            {/if}     
                                {*if $login_company_id eq 8*} {*annex report only for company optimal*}
                                    {* {if $cust neq '' and $employees|count gt 0} *}
                                    {*if (($cust != '' and $emp != '') or ($cust == 'ALL' or $selected_all_customers eq TRUE)) or ($emp != '' or $emp == 'ALL' or $selected_all_employees eq TRUE)*}
                            {if $cust != '' or $selected_all_customers eq TRUE}
                                <span class="span12 pull-right">
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printVikarie3059Report();" class="btn btn-primary pull-right ml mt span12" style="padding: 4px 10px;"><i class="icon-file-text"></i> {$translate.print_substitute_3059}</button>
                                    </span>
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printAnnexReport();" class="btn btn-primary pull-right mr ml mt span12" style="margin-top: 5px ! important;"><i class="icon-file-text"></i> {$translate.leave_annex_report}</button>
                                    </span>
                                </span>
                                <span class="span12 pull-right">      
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printSickDetailsAndWorkReport();" class="btn btn-primary pull-right ml mt span12" style="padding: 4px 10px;"><i class="icon-file-text"></i> {$translate.print_work_and_sick_details_report}</button>
                                    </span>
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printVikarieListReport();" class="btn btn-primary pull-right mr ml mt span12" style="margin-top: 5px ! important;"><i class="icon-file-text"></i> {$translate.print_replace_employee}</button>
                                    </span>
                               
                                        {* <button type="button" onclick="printFKWorkReport();" class="btn btn-block btn-primary pull-right ml mt" style="padding: 4px 10px; width: auto;"><i class="icon-file-text"></i> {$translate.print_fk_work_report}</button> *}
                                        {* <button type="button" onclick="printFKDeviationReport();" class="btn btn-block btn-primary pull-right ml mt" style="padding: 4px 10px; width: auto;"><i class="icon-file-text"></i> {$translate.print_fk_deviation_report}</button> *}
                                    

                                    {*if $show_work_report_button}
                                        <button type="button" onclick="printSickDetailsAndWorkReport();" class="btn btn-block btn-primary pull-right ml mt" style="padding: 4px 10px; width: auto;"><i class="icon-file-text"></i> {$translate.print_work_and_sick_details_report}</button>
                                    {/if*}
                                </span>
                            {/if}
                        </span>
                        
                        {if $relations}
                            <span class="form-section-highlight span12 no-ml mt">
                                <h5>Sjukperiod: {$relations[0]['date']} till {$relations[($relations|@count)-1]['date']} <i><b>({$translate.unmanned_slot_Karensdag} {$ker_str})</b></i>
                                
                                </h5>
                                <hr>
                                <div class="table-responsive">
                                <table border="1px solid" cellspacing="0" cellpadding="5" class="table table-bordered table-striped" style="border-color: rgb(228, 228, 228); text-align: center;">
                                    <tbody>
                                        <tr>
                                            <td width="265"><u><strong>{$translate.replacement_empl_name}</strong></u></td>
                                            <td width="100"><strong>Datum</strong></td>
                                            <td width="60"><strong>Klockslag</strong></td>
                                            <td width="39"><strong>L&ouml;netyp</strong></td>
                                            <td width="39"><strong>{$translate.unmanned_slot_header}</strong></td>
                                            <td width="55"><strong>{$translate.replaced_hours_header}</strong></td>
                                            {*<td width="25"><strong>Timl&ouml;n</strong></td>*}
                                            <td width="35"><strong>{$translate.soc_coasts}</strong></td>
                                        </tr>
                                        {assign i 0}
                                         {assign var="count" value=0}
                                        {assign var="count1" value=0}
                                        
                                        {foreach from=$relations item=relation}
                                        
                                            {if $relation.employee eq ''} {assign var="count" value=$count+$relation.tot_time}{else}{/if}
                                             {if $relation.employee neq ''} {assign var="count1" value=$count1+$relation.tot_time}{else}{/if}
                                            <tr>
                                                <!--<td>{$relation.employee}</td>-->
                                                <td>{if $relation.employee neq ''}<strong>{$relation.employee}</strong>{else}<i>{$translate.unmanned_slot}</i>{/if}</td>
                                                <td>{$relation.date}</td>
                                                <td>{$relation.time_from} - {$relation.time_to}</td>
                                                <td>{$relation.inconv}</td>
                                                 <td style="text-align: right;">{if $relation.employee eq ''}{$relation.tot_time}{else}{/if} </td>
                                                <td style="text-align: right;">{if $relation.employee neq ''}{$relation.tot_time}{else}{/if}</td>
                                                {*assign style_input ''}
                                                {if $relation.repeat eq '1'} {assign style_input 'border:solid 1px #d9d9d9; display: none;'}{else}{assign style_input 'border:solid 1px #d9d9d9;'} {/if*}
                                                {*<td style="padding-left: 8px"><input type="text" name="time_{$i}" id="time_{$i}" size="6" style="{$style_input}"/></td>*}
        {*                                            <td style="padding-left: 8px"><input type="text" name="soc[]" id="soc_{$i}" size="6"  value="{if $relation.age < 25}{$below_25}{else if $relation.age < 65}{$btwn_25_65}{else if $relation.age >= 65}{$above_65}{/if}"/></td>*}
                                                <td style="padding-left: 8px">{if $relation.age < 25}{$below_25}{else if $relation.age < 65}{$btwn_25_65}{else if $relation.age >= 65}{$above_65}{/if}</td>
                                            </tr> 
                                            {assign i $i+1}
                                        {/foreach}
                                            <tr>
                                                <td style="font-weight: bold;">Summering hela m&aring;naden</td>
                                                <td colspan="3"></td>
                                                 <td style="text-align: right;">{if $count eq "0"}-{else}{$count}{/if}</td>
                                               <!-- <td style="text-align: right;">{$total_vikari_hours}</td>-->
                                               <td style="text-align: right;">{$count1}</td>
                                                <td></td>
                                            </tr>
                                        <input type="hidden" name="tot_rows" id="tot_rows" value="{$i}" />
                                    </tbody>
                                </table>
                                </div>
                            </span>
                        {/if}
                    </div>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">&Ouml;vriga f&auml;lt</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Uppdrag</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtUppdrag" type="text" id="txtUppdrag" value="{$sick_form_defaults.uppdrag}" size="30" /></td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Fullmakt</td>
                                <td width="75%" bgcolor="#FFFFFF">
                                    <label><input name="chkFullmaktBifogas" type="checkbox" id="chkFullmaktBifogas" value="1" {if $sick_form_defaults.fullmakt_values.fullmakt1 eq 1}checked="checked"{/if}> Bifogas </label>
                                    <label class='mt mb'><input name="chkFullmaktTidigareInsant" type="checkbox" id="chkFullmaktTidigareInsant" value="1" {if $sick_form_defaults.fullmakt_values.fullmakt2 eq 1}checked="checked"{/if}> Tidigare ins&auml;nt</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Ers&auml;ttning betalas till konto</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtErsattningBetalasTillKonto" type="text" id="txtErsattningBetalasTillKonto" size="30" value="{$company_bank_account}{*$compensation_paid*}"/></td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Referensnummer</td>
                                <td width="75%" bgcolor="#FFFFFF">
                                    <!--input name="txtReferensnummer" type="text" id="txtReferensnummer" value="{*$sick_form_defaults.reference_number*}{$form_reference_number}" size="30"/-->
                                    {foreach from=$form_reference_number_set item=frns}
                                        <div class="span12 no-ml">
                                            <input name="txtReferensnummer[]" type="text" value="{$frns.ref}" size="30" class="no-mb"/>&nbsp; &nbsp; <i>{if $frns.date neq ''}{$translate.karense_days}:&nbsp;{$frns.date}{else}{$translate.no_karense}{/if} </i>
                                        </div>
                                    {/foreach}
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Kollektivavtal</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtKollektivavtal" type="text" id="txtKollektivavtal" value="{$customer_Kollectival_name}" size="30" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas1" type="checkbox" id="chkBifogas1" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas1 eq 1}checked="checked"{/if}/>
                                    Sjukfr&aring;nvaroanm&auml;lan eller annan uppgift som styrker ordinarie assistents sjukfr&aring;nvaro.</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas2" type="checkbox" id="chkBifogas2" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas2 eq 1}checked="checked"{/if}/>
                                    Kopia p&aring; l&ouml;neutbetalning eller annan uppgift som styrker att kostnaderna &auml;r utbetalda&ndash; ordinarie personlig assistent och vikarie</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas3" type="checkbox" id="chkBifogas3" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas3 eq 1}checked="checked"{/if}/>
                                    Tidrapport till f&ouml;rs&auml;kringskassan - ordinarie personlig asstistens och vikarie</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas4" type="checkbox" id="chkBifogas4" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas4 eq 1}checked="checked"{/if}/>
                                    Komplett ifyllt sammanst&auml;llning som visas att faktiskt merkostnad finns. (Styrkande av merkostnadens storlek, sid 2.)</label>
                                </td>
                            </tr>
                        </table>
                        </div>            
                    </span>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">Ord l&ouml;n kr/tim assistent</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="15%" bgcolor="#FFFFFF">Ord l&ouml;n kr/tim</td>
                                <td width="85%" bgcolor="#FFFFFF"><input name="txtAssistentOrdLon" type="text" id="txtAssistentOrdLon" size="10" value="{$employee_normal_salary}" style="border:solid 1px #d9d9d9; background-color: #D9D9D4" disabled="disabled"/></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">Kr/tim</td>
                                <td bgcolor="#FFFFFF"><input name="txtTotalKostnadPerTim" type="text" id="txtTotalKostnadPerTim" size="10" value="{$company_fk_kr_per_time}{*$sick_pay*}" />                         
                                    Redovisad kostnad till FK f&ouml;r utf&ouml;rd assistans under sjukperioden</td>
                            </tr>
                        </table>
                        </div>            
                    </span>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">F&ouml;rs&auml;kring och sociala avgifter</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="15%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="15%" bgcolor="#FFFFFF"><strong>Ord personal</strong></td>
                               
                                <td width="16%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="39%" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><strong>Pensionsf&ouml;rs&auml;kring</strong></td>{* F&ouml;rs&auml;kring *}
                                <td bgcolor="#FFFFFF"><input name="txtForsakring_Ord" type="text" id="txtForsakring_Ord" size="5" value="{$insurance_ordinary}" />%</td>
                                
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><strong>Sociala avgifter</strong></td>
                                <td bgcolor="#FFFFFF"><input name="txtSocialaAvgifter_Ord" type="text" id="txtSocialaAvgifter_Ord" size="5" value="{if $sel_employees_age < 25}{$below_25}{else if $sel_employees_age < 65}{$btwn_25_65}{else if $sel_employees_age >= 65}{$above_65}{/if}" readonly="readonly" />%</td>
                               
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                        </table>
                        </div>        
                    </span>
                      
                    <span class="span12 no-ml" style="margin-top: 25px">
                        <button type="button" onclick="printForm();" class="btn btn-primary mr"><i class="icon-file-text"></i> {$translate.save_n_print}</button>
                    </span>

                </div>
            </div>
        </form> 
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