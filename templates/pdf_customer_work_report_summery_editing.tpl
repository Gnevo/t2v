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
        {*sum1();
        sum2();*}
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
        
        {*$('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').keyup(function(){
            sum1();
        });
        $('#excl_ob_period, #ob_period, #asst_exp_period, #training_period, #staff_expense_period, #admin_period').keyup(function(){
            sum2();
        });*}

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

        $(".format_time_field").mask("99.99", { placeholder:"0" });
        
        //to format currency on page load
        $('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9  });
        $('#excl_ob_period, #ob_period, #asst_exp_period, #training_period, #staff_expense_period, #admin_period').formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9  });
        $("#total_cost").formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
        $("#total_period").formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
        
        // Format cost column input values(2nd column) while typing & warn on decimals entered, 2 decimal places 
        $('#excl_ob_period, #ob_period, #asst_exp_period, #training_period, #staff_expense_period, #admin_period').blur(function() {
                $(this).parent().find('.this_error_notify').html(null);
                $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9 });
        })
        .keyup(function(e) {
                var e = window.event || e;
                var keyUnicode = e.charCode || e.keyCode;
                if (e !== undefined) {
                        switch (keyUnicode) {
                                case 16: break; // Shift
                                case 17: break; // Ctrl
                                case 18: break; // Alt
                                case 27: this.value = ''; break; // Esc: clear entry
                                case 35: break; // End
                                case 36: break; // Home
                                case 37: break; // cursor left
                                case 38: break; // cursor up
                                case 39: break; // cursor right
                                case 40: break; // cursor down
                                case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                                case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                                case 190: break; // .
                                default: $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true, numberMaxLength: 9 });
                        }
                }
        })
        .bind('decimalsEntered', function(e, cents) {
                if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
        })
        .bind('checkMaxSize', function(e, intPart, cents) {
                {*console.log(cents);
                console.log(intPart);
                console.log(intPart.length);*}
                if(intPart.length > 9){
                        var errorMsg = 'Maximum 9 digits decimal value';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                else if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                sum2();
        });
        
        //-------------------------------------------------------------------------------------------------------------------------------
        // Format time column input values(1st column) while typing & warn on decimals entered, 2 decimal places 
        $('#excl_ob_cost, #ob_cost, #asst_exp_cost, #training_cost, #staff_expense_cost, #admin_cost').blur(function() {
                $(this).parent().find('.this_error_notify').html(null);
                $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2, numberMaxLength: 9 });
        })
        .keyup(function(e) {
                var e = window.event || e;
                var keyUnicode = e.charCode || e.keyCode;
                if (e !== undefined) {
                        switch (keyUnicode) {
                                case 16: break; // Shift
                                case 17: break; // Ctrl
                                case 18: break; // Alt
                                case 27: this.value = ''; break; // Esc: clear entry
                                case 35: break; // End
                                case 36: break; // Home
                                case 37: break; // cursor left
                                case 38: break; // cursor up
                                case 39: break; // cursor right
                                case 40: break; // cursor down
                                case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                                case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                                case 190: break; // .
                                default: $(this).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true, numberMaxLength: 9 });
                        }
                }
        })
        .bind('decimalsEntered', function(e, cents) {
                if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
        })
        .bind('checkMaxSize', function(e, intPart, cents) {
                if(intPart.length > 9){
                        var errorMsg = 'Maximum 9 digits decimal value';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                else if (String(cents).length > 2) {
                        var errorMsg = 'Please do not enter any cents (0.' + cents + ')';
                        $(this).parent().find('.this_error_notify').html(errorMsg);
                }
                sum1();
        });
        
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
    /*            
        function sum1__(){
        	var excl_ob_cost = parseFloat($("#excl_ob_cost").val());
                if($.isNumeric(excl_ob_cost) === false){
                    excl_ob_cost = 0.00;
                    $("#excl_ob_cost").val('0.00');
                }
        	var ob_cost = parseFloat($("#ob_cost").val());
                if($.isNumeric(ob_cost) === false){
                    ob_cost = 0.00;
                    $("#ob_cost").val('0.00');
                }
        	var asst_exp_cost = parseFloat($("#asst_exp_cost").val());
                if($.isNumeric(asst_exp_cost) === false){
                    asst_exp_cost = 0.00;
                    $("#asst_exp_cost").val('0.00');
                }
        	var training_cost = parseFloat($("#training_cost").val());
                if($.isNumeric(training_cost) === false){
                    training_cost = 0.00;
                    $("#training_cost").val('0.00');
                }
        	var staff_expense_cost = parseFloat($("#staff_expense_cost").val());
                if($.isNumeric(staff_expense_cost) === false){
                    staff_expense_cost = 0.00;
                    $("#staff_expense_cost").val('0.00');
                }
        	var admin_cost = parseFloat($("#admin_cost").val());
                if($.isNumeric(admin_cost) === false){
                    admin_cost = 0.00;
                    $("#admin_cost").val('0.00');
                }	
        	var total_cost_hour = parseFloat(excl_ob_cost) + parseFloat(ob_cost)
                                        + parseFloat(asst_exp_cost) + parseFloat(training_cost)
                                        + parseFloat(staff_expense_cost) + parseFloat(admin_cost); 
                total_cost_hour = parseFloat(total_cost_hour).toFixed(2);
        	$("#total_cost").html(total_cost_hour);
        }  


        function sum2__(){ 
                var excl_ob_period = parseFloat($("#excl_ob_period").val());
                
                if($.isNumeric(excl_ob_period) === false){
                    excl_ob_period = 0.00;
                    $("#excl_ob_period").val('0.00');
                }
                var ob_period = parseFloat($("#ob_period").val());
                if($.isNumeric(ob_period) === false){
                    ob_period = 0.00;
                    $("#ob_period").val('0.00');
                }
                var asst_exp_period = parseFloat($("#asst_exp_period").val());
                if($.isNumeric(asst_exp_period) === false){
                    asst_exp_period = 0.00;
                    $("#asst_exp_period").val('0.00');
                }
                var training_period = parseFloat($("#training_period").val());
                if($.isNumeric(training_period) === false){
                    training_period = 0.00;
                    $("#training_period").val('0.00');
                }
                var staff_expense_period = parseFloat($("#staff_expense_period").val());
                if($.isNumeric(staff_expense_period) === false){
                    staff_expense_period = 0.00;
                    $("#staff_expense_period").val('0.00');
                }
                var admin_period = parseFloat($("#admin_period").val());
                if($.isNumeric(admin_period) === false){
                    admin_period = 0.00;
                    $("#admin_period").val('0.00');
                }
                
        	var total_cost_for_period = parseFloat(excl_ob_period) + parseFloat(ob_period)
                                        + parseFloat(asst_exp_period) + parseFloat(training_period)
                                        + parseFloat(staff_expense_period) + parseFloat(admin_period); 
                total_cost_for_period = parseFloat(total_cost_for_period).toFixed(2);
        	$("#total_period").html(total_cost_for_period);
        }*/          
                
    function sum1(){
    	var excl_ob_cost = ($("#excl_ob_cost").val());
            excl_ob_cost =  excl_ob_cost.replace(/\s/g, '');
            excl_ob_cost =  excl_ob_cost.replace(/,/g, '.');
            if($.isNumeric(excl_ob_cost) === false){
                excl_ob_cost = 0.00;
            }
    	var ob_cost = ($("#ob_cost").val());
            ob_cost =  ob_cost.replace(/\s/g, '');
            ob_cost =  ob_cost.replace(/,/g, '.');
            if($.isNumeric(ob_cost) === false){
                ob_cost = 0.00;
            }
    	var asst_exp_cost = ($("#asst_exp_cost").val());
            asst_exp_cost =  asst_exp_cost.replace(/\s/g, '');
            asst_exp_cost =  asst_exp_cost.replace(/,/g, '.');
            if($.isNumeric(asst_exp_cost) === false){
                asst_exp_cost = 0.00;
            }
    	var training_cost = ($("#training_cost").val());
            training_cost =  training_cost.replace(/\s/g, '');
            training_cost =  training_cost.replace(/,/g, '.');
            if($.isNumeric(training_cost) === false){
                training_cost = 0.00;
            }
    	var staff_expense_cost = ($("#staff_expense_cost").val());
            staff_expense_cost =  staff_expense_cost.replace(/\s/g, '');
            staff_expense_cost =  staff_expense_cost.replace(/,/g, '.');
            if($.isNumeric(staff_expense_cost) === false){
                staff_expense_cost = 0.00;
            }
    	var admin_cost = ($("#admin_cost").val());
            admin_cost =  admin_cost.replace(/\s/g, '');
            admin_cost =  admin_cost.replace(/,/g, '.');
            if($.isNumeric(admin_cost) === false){
                admin_cost = 0.00;
            }
            
    	var total_cost_hour = parseFloat(excl_ob_cost) + parseFloat(ob_cost)
                                    + parseFloat(asst_exp_cost) + parseFloat(training_cost)
                                    + parseFloat(staff_expense_cost) + parseFloat(admin_cost); 
            total_cost_hour = parseFloat(total_cost_hour).toFixed(2);
    	$("#total_cost").html(total_cost_hour).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
    }            

    function sum2(){ 
        var excl_ob_period = $("#excl_ob_period").val();
        excl_ob_period =  excl_ob_period.replace(/\s/g, '');
        excl_ob_period =  excl_ob_period.replace(/,/g, '.');
        if($.isNumeric(excl_ob_period) === false){
            excl_ob_period = 0.00;
        }
        var ob_period = ($("#ob_period").val());
        ob_period =  ob_period.replace(/\s/g, '');
        ob_period =  ob_period.replace(/,/g, '.');
        if($.isNumeric(ob_period) === false){
            ob_period = 0.00;
        }
        var asst_exp_period = ($("#asst_exp_period").val());
        asst_exp_period =  asst_exp_period.replace(/\s/g, '');
        asst_exp_period =  asst_exp_period.replace(/,/g, '.');
        if($.isNumeric(asst_exp_period) === false){
            asst_exp_period = 0.00;
        }
        var training_period = ($("#training_period").val());
        training_period =  training_period.replace(/\s/g, '');
        training_period =  training_period.replace(/,/g, '.');
        {*console.log('training_period: '+training_period);*}
        if($.isNumeric(training_period) === false){
            training_period = 0.00;
        }
        var staff_expense_period = ($("#staff_expense_period").val());
        staff_expense_period =  staff_expense_period.replace(/\s/g, '');
        staff_expense_period =  staff_expense_period.replace(/,/g, '.');
        if($.isNumeric(staff_expense_period) === false){
            staff_expense_period = 0.00;
        }
        var admin_period =$("#admin_period").val();
        admin_period =  admin_period.replace(/\s/g, '');
        admin_period =  admin_period.replace(/,/g, '.');
        if($.isNumeric(admin_period) === false){
            admin_period = 0.00;
        }
    	var total_cost_for_period = parseFloat(excl_ob_period) + parseFloat(ob_period)
                                    + parseFloat(asst_exp_period) + parseFloat(training_period)
                                    + parseFloat(staff_expense_period) + parseFloat(admin_period); 
            total_cost_for_period = parseFloat(total_cost_for_period).toFixed(2);
    	$("#total_period").html(total_cost_for_period).formatCurrency({ colorize: true, decimalSymbol: ',', negativeFormat: '-%s%n', roundToDecimalPlace: 2});
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
                                <th align="left" width="50%" valign="top" scope="col"> Period {$year} / {$translate.$month_name} </th>
                                <td align="left" width="50%" valign="top" scope="col"> Räkningen ska ha inkommit till Försäkringskassan senast<br>
                                    den 5:e i andra månaden efter den månad som du ska<br>
                                    redovisa.
                                </td>
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
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom" scope="col"> 2.  Redovisning av all utförd assistans under månaden </th>
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
                                                    {*<tr>
                                                        <th colspan="4" align="left" valign="top">
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
                                                                                <td style="padding:0px;" width="80%">Tidredovisning Assistansersättning (3059)</td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table>
                                                        </th>
                                                    </tr>*}
                                                </table> 
                                                &nbsp;* Väntetiden räknas om till assistanstid genom att antalet faktiska timmar delas med 4.<br />
                                                ** Beredskapstiden räknas om till assistanstid genom att antalet faktiska timmar delas med 7
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
{*                            Section 3*}
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'> 3. Har assistans utförts i barnomsorg, skola eller daglig verksamhet</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" align="left" valign="top" style="padding:0px;">
                                                            <table class="tbl_border" style="border-top:0px;" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                                
                                                                <tr>
                                                                    <td colspan="3" >
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="12%" align="left" valign="middle"><label><input type="radio" name="rd_has_assistance_in_other_activities" value="1" {if $reports['has_assistance_in_other_activities'] eq 1}checked="checked"{/if} /> &nbsp;Ja</label></td>
                                                                                <td width="88%" align="left" valign="middle"><label><input type="radio" name="rd_has_assistance_in_other_activities" value="0" {if $reports['has_assistance_in_other_activities'] === '0'}checked="checked"{/if} /> &nbsp;Nej</label><br /></td>
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
                                        <tr><td colspan="2" class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
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
                                                    {*<tr>
                                                        <td colspan="5" class="no-padding">
                                                            <table class="tbl_border" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td width="25%">
                                                                        <label>
                                                                            <span style="float: left;display: block;"><input type="checkbox" name="did_u_included_hospitalized_hours" value="1" {if $reports['did_u_hostpilized_this_month'] eq 1 and $reports['did_u_included_hospitalized_hours'] eq 1}checked="checked"{/if} /></span>
                                                                            <span style="margin-left: 19px;display: block;">Jag har fått personlig assistans under tiden jag vårdades på sjukhus. Timmarna ingår i redovisningen under punkt 2.</span>
                                                                        </label>
                                                                    </td>
                                                                    <td width="25%" align="left" valign="top" scope="col"> 
                                                                        <div class="span12 no-min-height">Aktiv tid</div>
                                                                        <div class="secondary-font span12 no-ml no-min-height">
                                                                            <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                                        </div>
                                                                        <div class="span12 no-ml">
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_norm_hr']}{/if}" name="hostpitalized_hours_norm_hr" /></span>
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_norm_min']}{/if}" name="hostpitalized_hours_norm_min" /></span>
                                                                        </div></td>
                                                                    <td width="25%" align="left" valign="top" scope="col">
                                                                        <div class="span12 no-min-height">Väntetid, faktiska timmar</div>
                                                                        <div class="secondary-font span12 no-ml no-min-height">
                                                                            <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                                        </div>
                                                                        <div class="span12 no-ml">
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_oncall_hr']}{/if}" name="hostpitalized_hours_oncall_hr" /></span>
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_oncall_min']}{/if}" name="hostpitalized_hours_oncall_min" /></span>
                                                                        </div></td>
                                                                    <td width="25%" align="left" valign="top" scope="col"> 
                                                                        <div class="span12 no-min-height">Beredskapstid, faktiska timmar</div>
                                                                        <div class="secondary-font span12 no-ml no-min-height">
                                                                            <span class="span4 no-min-height">timmar</span><span class="span4 no-min-height">minuter</span>
                                                                        </div>
                                                                        <div class="span12 no-ml">
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_stdby_hr']}{/if}" name="hostpitalized_hours_stdby_hr" /></span>
                                                                            <span class="span4 no-min-height special_spn no-mt no-mb"><input type="text" class="span12" maxlength="20" value="{if $reports['did_u_included_hospitalized_hours'] eq 1}{$reports['hostpitalized_hours_stdby_min']}{/if}" name="hostpitalized_hours_stdby_min" /></span>
                                                                        </div></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>*}
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
                                        <tr><th align="left" valign="bottom">5. Har du vistats i ett land utanför EES-området och anlitat en assistent på plats?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td width="10%" align="left" valign="top"><label>
                                                            <p style="float:left"><input type="checkbox" name="section_3_choice_4" value="1" {if ($edit eq 'true' and $sec3_check_values[3] eq 1) or ($edit neq 'true' and $prev_sec3_check_values[3] eq 1)}checked="checked"{/if}/></p>
                                                            <p style="float:left; margin-left:3px;">&nbsp;Ja</p>
                                                        </label></td>
                                                        <td align="left" valign="top">Bifoga en förklaring till varför du behövde anlita en assistent på plats. Skicka också in handlingar som styrker dina uppgifter.</td>
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
                                            <th align="left" valign="bottom"> 6. Fyll i här om du har köpt assistans och fått ersättning i efterskott<br /></th>
                                        </tr>
                                        <tr>
                                            <td class="minus_padding ">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="3"><p>Har du använt föregående månads utbetalning till köp av personlig assistans?</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_1" value="1" {if $reports['have_money_left_not_to_purchase1'] eq 1}checked="checked"{/if} /> &nbsp;Ja</label></td>
                                                                    <td width="14%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_1" value="0" {if $reports['have_money_left_not_to_purchase1'] === '0'}checked="checked"{/if} /> &nbsp;Nej, det finns</label><br /></td>
                                                                    <td align="left" valign="middle"><input type="text" style="width: 100px; " maxlength="10" value="{if $edit eq 'true' and $reports['have_money_left_not_to_purchase1'] === '0'}{$reports['money_left1']}{/if}" name="txt_money_left_1" /> &nbsp;kronor kvar </td>
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
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
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
                                            <td colspan="2" class="minus_padding">&nbsp;&nbsp;Uppgifterna hanteras i Försäkringskassans datasystem. Läs mer i broschyren &quot;Försäkringskassans personregister&quot;.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
{*                            Section 9*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" valign="bottom"> 9. Redovisa dina kostnader<br /></th>
                                            <td width="35%" align="left">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                        <tr>
                                            <td>{$translate.type_of_cost}</td>
                                            <td align="left" valign="top">{$translate.cost_per_hour}</td>
                                            <td align="left" valign="top">{$translate.cost_for_period}</td>
                                        </tr>
                                        <tr>
                                            <td width="33%"><p>Lön (utom OB-tillägg) och lönebikostnader<br /></p></td>
                                            <td width="31%" align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['salary_excl_OB_cost'] neq 0.00}{$reports['salary_excl_OB_cost']}{/if}" name="excl_ob_cost" id="excl_ob_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td width="36%" align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['salary_excl_OB_period'] neq 0.00}{$reports['salary_excl_OB_period']}{/if}" name="excl_ob_period" id="excl_ob_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Lön i form av OB-tillägg</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['salary_OB_cost'] neq 0.00}{$reports['salary_OB_cost']}{/if}" name="ob_cost" id="ob_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['salary_OB_period'] neq 0.00}{$reports['salary_OB_period']}{/if}" name="ob_period" id="ob_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Assistansomkostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['assist_expenses_cost'] neq 0.00}{$reports['assist_expenses_cost']}{/if}" name="asst_exp_cost" id="asst_exp_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['assist_expenses_period'] neq 0.00}{$reports['assist_expenses_period']}{/if}" name="asst_exp_period" id="asst_exp_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Utbildningskostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['training_cost'] neq 0.00}{$reports['training_cost']}{/if}" name="training_cost" id="training_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['training_period'] neq 0.00}{$reports['training_period']}{/if}" name="training_period" id="training_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Arbetsmiljöinsatser och personalomkostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['staff_expense_cost'] neq 0.00}{$reports['staff_expense_cost']}{/if}" name="staff_expense_cost" id="staff_expense_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['staff_expense_period'] neq 0.00}{$reports['staff_expense_period']}{/if}" name="staff_expense_period" id="staff_expense_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Administrationskostnader</td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['administration_cost'] neq 0.00}{$reports['administration_cost']}{/if}" name="admin_cost" id="admin_cost" onemptied="sum1()" oninput="sum1()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                            <td align="left" valign="top"><input type="text" class="cost_input" maxlength="14" value="{if $edit eq 'true' and $reports['administration_period'] neq 0.00}{$reports['administration_period']}{/if}" name="admin_period" id="admin_period" onemptied="sum2()" oninput="sum2()" /><div class="this_error_notify span12 no-min-height"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Summa kostnad för assistansen:</td>
                                            <td align="left" valign="top"><span id="total_cost" class="special_spn">{if $edit eq 'true'}{$total_cost_hour}{/if}</span></td>
                                            <td align="left" valign="top"><span id="total_period" class="special_spn">{if $edit eq 'true'}{$total_cost_for_period}{/if}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Antal utförda timmar under perioden<br />som kostnaden är beräknad på*:<br /></td>
                                            <td align="left" valign="top"><input type="text" style="width: 100px; " maxlength="6" value="{if $total_customer_no_of_hours neq 0}{$total_customer_no_of_hours}{/if}" name="customer_hours" id="customer_hours" />{*<span id="customer_hours">{$total_customer_no_of_hours}</span>*}</td>
                                            <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">* Beräkna kostnaden på de använda timmarna men inte på fler än det antal timmar som beviljats.</td></tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
{*                            Section 10*}
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom"> 10. Fyll i här om du får ersättning i förskott</th></tr>
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'>10.a Uppgift om perioden</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table id="account_dates" class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td style=" border-right: 1px solid #DCDCDC;">
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="acc_date_from">Från och med (månad och år)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span5 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span12" value="{if $start_date neq '' and $start_date neq '0000-00-00' and $company_id ne 10}{$start_date}{/if}" maxlength="12" id="acc_date_from" name="acc_date_from" type="text" />
                                                                </div>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-append">
                                                                    <a href=""><span class="icon-calendar"></span></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: 0px ! important;height: auto;" class="span12">
                                                                <label style="float: left;" class="span12 template_label" for="acc_date_to">Till och med (månad och år)</label>
                                                                <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker">
                                                                    <span class="add-on icon-calendar"></span>
                                                                    <input class="form-control span5" value="{if $end_date neq '' and $end_date neq '0000-00-00' and $company_id ne 10}{$end_date}{/if}" maxlength="12" id="acc_date_to" name="acc_date_to" type="text"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="2" align="left" valign="top" class="minus_padding">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'> 10.b Finns det pengar kvar som du inte har använt för att köpa personlig assistans?</th></tr>
                                        <tr>
                                            <td colspan="2" class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" align="left" valign="top" style="padding:0px;">
                                                            <table class="tbl_border" style="border-top:0px;" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                                
                                                                <tr>
                                                                    <td colspan="3" >
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="8%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_2" value="0" {if $reports['money_left_not_to_purchase2'] === '0' and $company_id ne 10}checked="checked"{/if} /> &nbsp;Nej</label><br /></td>
                                                                                <td width="14%" align="left" valign="middle"><label><input type="radio" name="rd_money_left_2" value="1" {if $edit eq 'true' and $reports['money_left_not_to_purchase2'] eq 1 and $company_id ne 10}checked="checked"{/if} /> &nbsp;Ja, det finns</label></td>
                                                                                <td align="left" valign="middle"><input type="text" style="width: 100px; " maxlength="5" value="{if $edit eq 'true' and $reports['money_left_not_to_purchase2'] eq 1 and $company_id ne 10}{$reports['money_left2']}{/if}" name="txt_money_left_2" /> &nbsp;kronor kvar </td>
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
                                        <tr><td colspan="2" class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign="top" class="minus_padding">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr><th align="left" valign="bottom" class='block-sub-heading'>10.c Hur vill du betala tillbaka eventuellt för mycket utbetald ersättning?</th></tr>
                                        <tr>
                                            <td class="minus_padding">
                                                <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3" align="left" valign="top" scope="col">
                                                            <label><input type="radio" name="section_9_choice" value="1" {if $edit eq 'true' and $reports['compensation_payback'] eq 1 and $company_id ne 10}checked="checked"{/if}/>
                                                                &nbsp;Jag vill att Försäkringskassan drar av eventuellt för mycket utbetald ersättning för den här perioden på kommande utbetalningar.</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="left" valign="top">
                                                            <label><input type="radio" name="section_9_choice" value="2" {if $edit eq 'true' and $reports['compensation_payback'] eq 2 and $company_id ne 10}checked="checked"{/if}/>
                                                            &nbsp;Jag vill att Försäkringskassan prövar om jag är återbetalningsskyldig om det har utbetalats för mycket ersättning för den här perioden.</label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td class="minus_padding">&nbsp;</td></tr>
                                    </table>
                                </td>
                            </tr>
                            
                            
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