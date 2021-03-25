{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}

{block name='script'}
<script type="text/javascript" src="{$url_path}js/time_formats.js"></script>
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
    if($(window).height() > 300){
        //$('.main-left').css({ height: $(window).height()-56}); 
        $('#samsida_hold').css({ height: $(window).height()-109}); 
    }
    else{
        $('#samsida_hold').css({ height: $(window).height()});    
    }
        
});
    
    
function printForm(){
    //$('#action').val('print');
    //$('#forms').submit();
    if($("#cmb_employee").val() != "" && $("#lstTidStart").val() != "" && $("#lstTidSlut").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
    }else{
        alert('All Fields are required');
    }
}

function get_dates(){
    var empid=document.getElementById("cmb_employee").value;
    if(empid != ""){
        wrapLoader("#date_period");
        $.ajax({
            async:false,
            url:"{$url_path}ajax_get_time_table_dates.php",
            data:"id="+empid,
            type:"POST",
            success:function(data){
                $("#date_period").html(data);
                uwrapLoader("#date_period");
            }
        });
    }
    else
        $("#date_period").html("");

    $("#tbl_compensation tr.month_row").remove("");
    $('#worked_year').empty();
}

 // last edit sreerag 05/003/2018

function generate_section_3(){
    var empid = $("#cmb_employee").val();
    var from_range = $("#lstTidStart").val();
    var to_range = $("#lstTidSlut").val();
    $("#tbl_compensation tr.month_row").remove("");
    $('#worked_year').empty();
    if(empid != '' && from_range != '' && to_range != ''){
         wrapLoader("#main_content #external_wrapper");
        // wrapLoader("#tbl_compensation");
        $.ajax({
            // async:false,
            url:"{$url_path}ajax_get_time_table_dates.php",
            type:"POST",
            dataType: 'json',
            data: { 'sel_employee': empid, 'from_range': from_range, 'to_range': to_range, 'action': 'get_year_month_data'},
            success:function(data){
                //console.log(data);
                if(typeof data.result !== 'undefined' && data.result.length > 0){
                    $.each(data.result, function(i, value) {
                        var rowspan_count = 1;
                        if(value.others.length > 0) {
                            rowspan_count = value.others.length;
                        }
                        console.log(rowspan_count);
                        if(value.oncall_total == 0){
                            value.oncall_total = '';
                        }
                        if(value.oncall_amount == 0){
                            value.oncall_amount = '';
                        }
                        if(typeof value.others !== 'undefined' && value.others.length > 0){
                            $.each(value.others, function(j, value_data) {
                                if(value_data.amount == 0){
                                    value_data.amount = '';
                                }
                                if(j == 0) {
                                    $("#tbl_compensation").append('<tr class="month_row">\n\
                                        <td rowspan="'+rowspan_count+'">'+value.year_month+'</td>\n\
                                        <td rowspan="'+rowspan_count+'">'+value.working_days+'</td>\n\
                                        <td rowspan="'+rowspan_count+'"><input type="text" name="timer['+value.year_month+']" value="'+value.oncall_total+'" /> </td>\n\
                                        <td rowspan="'+rowspan_count+'"><input type="text" name="oncall_kr_time['+value.year_month+']" value="'+value.oncall_amount+'" /></td>\n\
                                        <td><input type="text" name="angeart['+value.year_month+'][]" value="'+value_data.desc+'" /></td>\n\
                                        <td><input type="text" name="ob_kr_time['+value.year_month+'][]" value="'+value_data.amount+'" /></td>\n\
                                    </tr>');
                                } else {
                                    $("#tbl_compensation").append('<tr class="month_row">\n\
                                        <td><input type="text" name="angeart['+value.year_month+'][]" value="'+value_data.desc+'" /></td>\n\
                                        <td><input type="text" name="ob_kr_time['+value.year_month+'][]" value="'+value_data.amount+'" /></td>\n\
                                    </tr>');
                                }
                            });
                        } else {
                            $("#tbl_compensation").append('<tr class="month_row">\n\
                                <td>'+value.year_month+'</td>\n\
                                <td>'+value.working_days+'</td>\n\
                                <td><input type="text" name="timer['+value.year_month+']" value="'+value.oncall_total+'" /> </td>\n\
                                <td><input type="text" name="oncall_kr_time['+value.year_month+']" value="'+value.oncall_amount+'" /></td>\n\
                                <td><input type="text" name="angeart['+value.year_month+'][]" value="" /></td>\n\
                                <td><input type="text" name="ob_kr_time['+value.year_month+'][]" value="" /></td>\n\
                            </tr>');
                        }
                    });
                }
            }
        });



       var new_data = [];
        var start = from_range.split('/');
        var end = to_range.split('/');
        var start_year = start[0];
        var start_month = start[1];
        var end_year = end[0];
        var end_month = end[1];
         $.ajax({
            // async:false,
            url:"{$url_path}ajax_get_time_table_dates.php",
            type:"POST",
            dataType: 'json',
            data: { 'sel_employee': empid, 'start_year': start_year, 'start_month': start_month,'end_year': end_year,'end_month': end_month, 'action': 'get_all_year_work_data'},
            success:function(data){
                if(data){
                    var generated_tables = '';
                    console.log(data);
                    $.each(data , function (index, value){
                        if(value == null){
                            value = [];
                        }
                        generated_tables += '<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">\
                            <tr class="month_row"><th colspan="5">Den redovisade tiden nedan avser '+index+'</th></tr>\n\
                            <tr class="month_row"><th>År</th>\n\
                                <th>Arbetade timmar (ejöver- mer- ellerfyllnadstid)</th>\n\
                                <th>Frånvaro</th>\n\
                                <th>Övertid</th>\n\
                                <th>Mertid Fyllnadstid</th></tr>';
                        var table_body_content = table(value,index);
                        generated_tables = generated_tables+table_body_content;
                        generated_tables += '</table><br>';
                     

                        
                    });
                    $('#worked_year').append(generated_tables);
                }
                uwrapLoader("#main_content #external_wrapper");
                // console.log('2');
                
            }
        });

    }

    
} 

function table(value,index){
    var i;
    var month = ['{$translate.jan}','{$translate.feb}','{$translate.mar}','{$translate.apr}','{$translate.may}','{$translate.jun}','{$translate.jul}','{$translate.aug}','{$translate.sep}','{$translate.oct}','{$translate.nov}','{$translate.dec}'];
    var table_body_content = '';
        for(i = 1;i<=12;i++){
            if(value[i] !=undefined){
                    var actual_work_hour = value[i]['actual_work_hour']?value[i]['actual_work_hour']:'';
                    var leave_hours = value[i]['leave_hours']?value[i]['leave_hours']:'';
                    var over_time = value[i]['over_time']?value[i]['over_time']:'';
                    var more_time = value[i]['more_time']?value[i]['more_time']:'';
                    table_body_content += '<tr class="month_row"><td>'+month[i-1]+'</td>\n\
                                <td><input name="work_hour['+index+']['+i+']" type="text" value="'+actual_work_hour+'"></td>\n\
                                <td><input name="leave_hours['+index+']['+i+']" type="text" value="'+leave_hours+'"></td>\n\
                                <td><input name="over_time['+index+']['+i+']" type="text" value="'+over_time+'"></td>\n\
                                <td><input name="filling_hours['+index+']['+i+']" type="text" value="'+more_time+'"></td></tr>';
            }
            else{
                    table_body_content += '<tr class="month_row"><td>'+month[i-1]+'</td>\n\
                                <td><input name="work_hour['+index+']['+i+']" type="text"></td>\n\
                                <td><input name="leave_hours['+index+']['+i+']" type="text"></td>\n\
                                <td><input name="over_time['+index+']['+i+']" type="text"></td>\n\
                                <td><input name="filling_hours['+index+']['+i+']" type="text"></td></tr>';
            }

        }
        return table_body_content;
}


       
    $(document).on('change', '#lstTidStart', function() {
        var from_range = $(this).val();
        if(from_range !=""){
            var from_range_split = from_range.split('/');
            var new_from_date = from_range_split[0]+'-'+from_range_split[1]+'-'+'01';
            $('#txtAnstTidStart').val(date('Y-m-t', new Date(new_from_date)));
            $('#txtAnstTidStart').datepicker('update', date('Y-m-t', new Date(new_from_date)));
        }
        else{
            $('#txtAnstTidStart').val('');
        }  
    });

    $(document).on('change', '#lstTidSlut', function() {
        var to_range = $(this).val();
         if(to_range !=""){
            var to_range_split = to_range.split('/');
            var new_to_date = to_range_split[0]+'-'+to_range_split[1]+'-'+25;
            $('#txtAnstTidSlut').val(date('Y-m-t', new Date(new_to_date)));
            $('#txtAnstTidSlut').datepicker('update', date('Y-m-t', new Date(new_to_date)));
        }
        else{
            $('#txtAnstTidSlut').val('');
        } 
    });

    $('.datepicker_common').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
    })
    $("#txtAnstTidStart,#txtAnstTidSlut").datepicker({ 
        format: 'yyyy-mm-dd',
        autoclose: true,
    }) 
    // last edit sreerag 05/03/2018
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                <div class="panel-heading" style="">
                    <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                        {$translate.employer_certification}
                        <ul class="pull-right">
                            <li><i class="icon-arrow-left"></i><a href="{$url_path}forms/"><span class="special_spn">{$translate.backs}</span></a></li>
                            <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}employment_certification_pdf_form.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                            <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="printForm()"><span class="special_spn">{$translate.save_n_print}</span></a></li>
                        </ul>
                    </h4>
                </div>
            </div>
            <div id="forms_container" class="span12 no-ml">
                <form name="forms" id="forms" method="post" action="{$url_path}employment_certification_pdf_form.php">

                    <input type="hidden" name="action" id="action" value="" />
                    <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />

                    <div id="samsida_hold" style="overflow:auto;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr>
                                <td>
                                    <div class="span12">
                                        <span class="span2">V&auml;lj assistent</span>
                                        <select name='cmb_employee' id="cmb_employee" onchange="get_dates()" >
                                            <option value=""  selected >{$translate.select} assistent</option>
                                            {foreach from=$E_combo item=entries}
                                                <option value={$entries.username} {if $employee_name == $entries.username} selected {/if} >{if $sort_by_name == 1}{$entries.first_name} {$entries.last_name}{elseif $sort_by_name == 2}{$entries.last_name} {$entries.first_name}{/if}</option>
                                            {/foreach}
                                        </select> 
                                    </div>
                                    <div id="date_period" class="span12 no-ml" style="height: auto;">
                                        <div class="span12 no-ml">
                                            <span class="span2">Arbetad tid avser:</span>
                                            <select name="lstTidStart" id="lstTidStart" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-right: 15px;" onchange="generate_section_3()">
                                                <option value="">{$translate.select}</option>
                                            </select>
                                            till
                                            <select name="lstTidSlut" id="lstTidSlut" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-left: 15px;" onchange="generate_section_3()">
                                                <option value="">{$translate.select}</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">2.Uppgifter om anst&auml;llning</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td>Anst&auml;llningstid Fr om</td>
                                            <td><label for="txtAnstTidStart"></label>
                                                <input type="text" name="txtAnstTidStart" id="txtAnstTidStart"/></td>
                                            <td>T o m</td>
                                            <td><input type="text" name="txtAnstTidSlut" id="txtAnstTidSlut"  /></td>
                                            <td><label><input name="chkFortfarandeAnstalld" type="checkbox" id="chkFortfarandeAnstalld" value="1" /> Fortfarande anst&auml;lld</label></td>
                                        </tr>
                                        <tr>
                                            <td>Befattning (anst&auml;lld som)</td>
                                            <td colspan="4"><input type="text" name="txtAnstBefatt" id="txtAnstBefatt" style="width:99%"/></td>
                                        </tr>
                                        <tr>
                                            <td>Tj&auml;nstledig Fr om</td>
                                            <td><input type="text" name="txTjanstledigStart" id="txTjanstledigStart" class="datepicker_common" autocomplete="off" /></td>
                                            <td>T o m</td>
                                            <td><input type="text" name="txTjanstledigSlut" id="txTjanstledigSlut" class="datepicker_common" autocomplete="off" /></td>
                                            <td>Omfattning i %
                                                <input name="txtOmfattning" type="text" id="txtOmfattning" size="4" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">3.Anst&auml;llningsform</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table width="100%" border="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td width="25%" bgcolor="#FFFFFF"><label>
                                                    <input name="chkAnstallningsformTillsvidareanstallning" type="checkbox" id="chkAnstallningsformTillsvidareanstallning" value="1" /> 
                                                    Tillsvidareanst&auml;llning </label></td>
                                            <td width="24%" bgcolor="#FFFFFF"><label><input name="chkAnstallningsformProvanstallning" type="checkbox" id="chkAnstallningsformProvanstallning" value="1" /> 
                                                Provanst&auml;llning t o m </label></td>
                                            <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="txtAnstallningsformProvanstallningDatum" id="txtAnstallningsformProvanstallningDatum" style="width:98%" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF"><label><input name="chkAnstallningsformTidsbegransad" type="checkbox" id="chkAnstallningsformTidsbegransad" value="1" /> 
                                                Tidsbegr&auml;nsad anst&auml;llning - Avtalat slutdatum</label></td>
                                            <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="txtAnstallningsformTidsbegransadDatum" id="txtAnstallningsformTidsbegransadDatum" style="width:98%" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" bgcolor="#FFFFFF"><label><input name="chkAnstallningsformIntermittent" type="checkbox" id="chkAnstallningsformIntermittent" value="1" /> 
                                                Intermittent anst&auml;llning (&quot;behovsanst&auml;llning&quot;)</label></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">4.Arbetstid</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table  class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td width="100%" bgcolor="#FFFFFF"><label><input name="chkArbetstidHeltid" type="checkbox" id="chkArbetstidHeltid" value="1" /> 
                                                Tillsvidareanst&auml;llning</label>
                                                <input name="txtArbetstidHeltid" type="text" id="txtArbetstidHeltid" size="2" />
                                                &nbsp;&nbsp;
                                                <label><input name="chkArbetstidDeltid" type="checkbox" id="chkArbetstidDeltid" value="1" /> 
                                                Deltid, ange timmar per vecka</label>
                                                <input name="txtArbetstidDeltid" type="text" id="txtArbetstidDeltid" size="2" />
                                                &nbsp;&nbsp;
                                                Vilket utg&ouml;r
                                                <input name="txtArbetstidUtgorProcent" type="text" id="txtArbetstidUtgorProcent" size="2" />
                                                % av heltidstj&auml;nst </td>
                                        </tr>
                                        <tr>
                                            <td  bgcolor="#FFFFFF"><label><input name="chkArbetstidVarierande" type="checkbox" id="chkArbetstidVarierande" value="1" /> 
                                                Varierande arbetstid (exempelvis intermittens anst&auml;llning, &quot;behovsanst&auml;llning&quot; eller liknande)</label></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">5.S&auml;rskilda upplysningar om anst&auml;llningen</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td colspan="4" bgcolor="#FFFFFF">
                                                <label style="float: left">Anst&auml;lld i bemanningsf&ouml;retag f&ouml;r uthyrning</label>
                                                <input name="chkBemanningsforetag" style="margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" />
                                                <label style="float: left">&nbsp;Ja</label>
                                                <input name="chkBemanningsforetag" style="margin-top: 3px !important; margin-left: 15px;" type="radio" value="0" checked="checked" />
                                                <label style="float: left">&nbsp;Nej</label>
                                            </td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">6.Anledning till att anställningen har upphört helt eller delvis </h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td width="88%" bgcolor="#FFFFFF"><label>
                                                    <input name="chkOpphortArbetsbrist" type="checkbox" id="chkOpphortArbetsbrist" value="1" /> 
                                                    Upps&auml;gning p.g.a arbetsbrist - Besked om upps&auml;gning l&auml;mnades till den anst&auml;llde den </label></td>
                                            <td width="12%" bgcolor="#FFFFFF"><input name="txtOpphortArbetsbrist" class="datepicker_common" type="text" id="txtOpphortArbetsbrist" size="12" autocomplete="off" /></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF"><label><input name="chkOpphortTidsbegransad" type="checkbox" id="chkOpphortTidsbegransad" value="1" /> 
                                                Avslutad tidsbegr&auml;nsad anst&auml;llning - Besked om att anst&auml;llningen inte skulle forts&auml;tta l&auml;mnat den</label></td>
                                            <td bgcolor="#FFFFFF"><input name="txtOpphortTidsbegransad" class="datepicker_common" type="text" id="txtOpphortTidsbegransad" size="12" autocomplete="off" /></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF"><label><input name="chkOpphortEgenBegaran" type="checkbox" id="chkOpphortEgenBegaran" value="1" /> 
                                                Den anst&auml;lldes egen beg&auml;ran</label></td>
                                            <td bgcolor="#FFFFFF">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF"><label><input name="chkOpphortAnnanOrsak" type="checkbox" id="chkOpphortAnnanOrsak" value="1" /> 
                                                Annan orsak - Ange vad &nbsp;</label>
                                                <label><input type="text" name="txtOpphortAnnanOrsak" id="txtOpphortAnnanOrsak" class="span6" /></label></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">7.Ers&auml;ttning med anledning av anst&auml;llningens upph&ouml;rande</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td colspan="4" bgcolor="#FFFFFF">
                                                <label style="float: left">Har avtal om avg&aring;ngsvederlag eller annan ers&auml;ttning ing&aring;tts?</label>
                                                <input name="chkAvgangsvederlag" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" />
                                                <label style="float: left">&nbsp;Ja</label>
                                                <input name="chkAvgangsvederlag" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="0" checked="checked"/>
                                                <label style="float: left">&nbsp;Nej</label>
                                            </td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">8.Erbjudande om fortsatt arbete</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td width="15%" bgcolor="#FFFFFF"><p>
                                                    
                                                    <input name="chkErbjudande" style="float: left; margin-top: 3px !important;" type="radio" value="0" checked="checked"/>
                                                    <label style="float: left">&nbsp;Nej</label>
                                                    <input name="chkErbjudande" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" />
                                                    <label style="float: left">&nbsp;Ja</label></p></td>
                                            <td width="10%" bgcolor="#FFFFFF"><label></label>
                                                Fr o m</td>
                                            <td width="25%" bgcolor="#FFFFFF"><input type="text" name="txtErbjudandeFrom" id="txtErbjudandeFrom" class="datepicker_common" autocomplete="off" /></td>
                                            <td width="10%" bgcolor="#FFFFFF">T o m</td>
                                            <td width="25%" bgcolor="#FFFFFF"><input type="text" name="txtErbjudandeTom" id="txtErbjudandeTom"  class="datepicker_common" autocomplete="off" /></td>
                                            <td  bgcolor="#FFFFFF"><label><input name="txtErbjudandeTillsvidare" type="checkbox" id="txtErbjudandeTillsvidare" value="1" /> 
                                                Tillsvidare</label></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">Heltid
                                                <label><input name="chkErbjudandeHeltid" type="checkbox" id="chkErbjudandeHeltid" value="1" /> 
                                                </label></td>
                                            <td colspan="5" bgcolor="#FFFFFF">
                                                <label>Ange timmart per vecka &nbsp;</label>
                                                <input name="txtErbjudandeHeltidTimmar" type="text" id="txtErbjudandeHeltidTimmar" size="4" /></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">Deltid
                                                <label><input name="chkErbjudandeDeltid" type="checkbox" id="chkErbjudandeDeltid" value="1" /> 
                                                </label></td>
                                                <td bgcolor="#FFFFFF" colspan="2">
                                                    <label>Ange timmart per vecka &nbsp;</label>
                                                    <input name="txtErbjudandeDeltidTimmar" type="text" id="txtErbjudandeDeltidTimmar" size="4"  /></td>
                                            <td colspan="3" bgcolor="#FFFFFF">Vilket &auml;r &nbsp;
                                                <input name="txtErbjudandeDeltidProcent" type="text" id="txtErbjudandeDeltidProcent" size="4" />
                                                &nbsp; &amp; av heltidstj&auml;nst</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><label><input name="chkErbjudandeVarierande" type="checkbox" id="chkErbjudandeVarierande" value="1" /> 
                                                Varierande arbetstid (timanst&auml;llning)</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" bgcolor="#FFFFFF">
                                                <label style="float: left;">Har arbetsgivaren accepterat</label>
                                                <input name="chkErbjudandeAccepterat" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" checked="checked"/>
                                                <label style="float: left;">&nbsp;&nbsp;Ja</label>
                                                <input name="chkErbjudandeAccepterat" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="0" />
                                                <label style="float: left;">&nbsp;&nbsp;Nej</label>
                                            </td>
                                            <td colspan="3" bgcolor="#FFFFFF">Ange datum d&aring; han/hon tackade nej&nbsp;
                                                <input type="text" name="txtErbjudandeAccepteratDatum" id="txtErbjudandeAccepteratDatum" class="datepicker_common" autocomplete="off" /></td>
                                        </tr>
                                    </table></td>
                            </tr>

                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">11. Arbetad tid </h4></span></td>
                            </tr>
                             <tr>
                                <td class="minus_padding" id="worked_year"> </td>
                                   
                            </tr>

                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">12.Uppgifter om l&ouml;nen</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding"><table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td colspan="5" bgcolor="#FFFFFF"><p>L&ouml;n avser &aring;r &nbsp;
                                                    <input type="text" name="txtLonAr" id="txtLonAr" />
                                                </p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" bgcolor="#FFFFFF">
                                                <input name="salary_type" style="float: left; margin-top: 3px !important;" type="radio" value="1" checked="checked"/>
                                                <label style="float: left;">&nbsp;M&aring;nadsl&ouml;n</label>
                                                <input name="salary_type" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="2" />
                                                <label style="float: left;">&nbsp;Veckol&ouml;n</label>
                                                <input name="salary_type" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="3" />
                                                <label style="float: left;">&nbsp;Dagl&ouml;n</label>
                                                <input name="salary_type" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="4" />
                                                <label style="float: left;">&nbsp;Timl&ouml;n</label>
                                            </td>
                                            <td width="20%" bgcolor="#FFFFFF">Belopp i kronor</td>
                                            <td width="20%" bgcolor="#FFFFFF"><input type="text" name="txtLonKronor" id="txtLonKronor" /></td>
                                        </tr>
                                        <tr>
                                            <td width="27%" bgcolor="#FFFFFF">Har timl&ouml;n f&ouml;r &ouml;vertids-, mertidseller<br />
                                                fyllnadsarbetet varierat?</td>
                                            <td colspan="2" bgcolor="#FFFFFF"><input name="chkTimlonOvertidMertid" style="margin-top: 3px !important;" type="radio" value="0" checked="checked"/>
                                                &nbsp;Nej, redovisa den timl&ouml;nen nedan</td>
                                            <td colspan="2" bgcolor="#FFFFFF"><input name="chkTimlonOvertidMertid" style="margin-top: 3px !important;" type="radio" value="1" />
                                                &nbsp;Ja - Redovisa den l&ouml;nen m&aring;nad f&ouml;r m&aring;nad p&aring;				  blanketten &quot;Komplettering till arbetsgivarintyg&quot;</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF" colspan="2">Övertid ange
                                                <input name="txtLonOvertid" type="text" id="txtLonOvertid" size="4" />
                                                kr/tim</td>
                                            <td colspan="3" bgcolor="#FFFFFF">Mertid / Fyllnadstid, ange
                                                <input name="txtLonMertid" type="text" id="txtLonMertid" size="4" />
                                                kr/tim</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF">L&ouml;n ut&ouml;ver m&aring;nads-, vecko-, dag- eller timl&ouml;n (ex joureller<br />
                                                OB-ers&auml;ttning, gage el. dyl) och andra skattepliktiga<br />
                                                ers&auml;ttningar som inte ing&aring;r i den ovan angivna l&ouml;nen?</td>
                                            <td width="9%" bgcolor="#FFFFFF">
                                                <input name="chkLonOtover" style="float: left; margin-top: 3px !important;" type="radio" value="0" checked="checked" />
                                                <label style="float: left;">&nbsp;Nej</label>
                                            </td>
                                            <td colspan="2" bgcolor="#FFFFFF">
                                                <input name="chkLonOtover" style="float: left; margin-top: 3px !important;" type="radio" value="1" />
                                                <label style="float: left;">&nbsp;Ja</label>
                                                <label style="float: left;"> - Redovisa den l&ouml;nen m&aring;nad f&ouml;r m&aring;nad<br />
                                                    p&aring; blanketten &quot;Komplettering till arbetsgivarintyg&quot;</label>
                                            </td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">13.Uppeh&aring;llsl&ouml;n och feriel&ouml;n (endast vid l&auml;s&aring;rsanknuten verksamhet)</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding"><table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td width="36%" bgcolor="#FFFFFF">
                                                <p>
                                                    <label style="float: left;">Anst&auml;lld med uppeh&aring;llsl&ouml;n</label>
                                                    <input name="chkAnstalldOppenhollslon" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="0" checked="checked" />
                                                    <label style="float: left;">&nbsp;Nej</label>
                                                    <input name="chkAnstalldOppenhollslon" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" />
                                                    <label style="float: left;">&nbsp;Ja</label>
                                                </p>
                                            </td>
                                            <td bgcolor="#FFFFFF">Ange intj&auml;nad uppeh&aring;llsl&ouml;n i kr
                                                <input name="chkAnstalldOppenhollslonIntjanad" type="text" id="chkAnstalldOppenhollslonIntjanad" /></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <label style="float: left;">Anst&auml;lld med feriel&ouml;n</label>
                                                <input name="chkAnstallFerielon" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="0" checked="checked"/>
                                                <label style="float: left;">&nbsp;Nej</label>
                                                <input name="chkAnstallFerielon" style="float: left; margin-top: 3px !important; margin-left: 15px;" type="radio" value="1" />
                                                <label style="float: left;">&nbsp;Ja</label>
                                            </td>
                                            <td bgcolor="#FFFFFF">Ange antal betalada feriedagar
                                                <input name="chkAnstallFerielonDagar" type="text" id="chkAnstallFerielonDagar" /><br/>
                                                Ange intj&auml;nad feriel&ouml;n i kr
                                                <input name="chkAnstallFerielonKronor" type="text" id="chkAnstallFerielonKronor" size="6" />
                                            </td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">14.&Ouml;vriga upplysningar</h4></span></td>
                            </tr>
                            <tr>
                                <td class="minus_padding"><table class="tbl_border" width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size: 12px;">
                                        <tr>
                                            <td bgcolor="#FFFFFF"><input name="txtOvrigt1" type="text" id="txtOvrigt1" style="width:99%" /></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF"><input name="txtOvrigt2" type="text" id="txtOvrigt2" style="width:99%"/></td>
                                        </tr>
                                    </table></td>
                            </tr>


                            <tr>
                                <td class="minus_padding">&nbsp;</td>
                            </tr>
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">2.Ersättningar som beskattas som inkomst av tjänst</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td class="minus_padding">
                                    <table  id="tbl_compensation" width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <th rowspan="2" class="text-left">År/månad (ÅÅÅÅMM)</th>
                                            <th rowspan="2" class="text-left">Antal arbetade dagar </th>
                                            <th colspan="2">Beredskap/Jourtid </th>
                                            <th colspan="2">Annan ersättning </th>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Timmar</th>
                                            <th class="text-left">Kr/månad </th>
                                            <th class="text-left">Ange art</th>
                                            <th class="text-left">Kr/månad </th>
                                        </tr>
                                        {*<tr>
                                            <td>201705</td> <!-- yearmonth -->
                                            <td>6</td>      <!-- no.of working days -->
                                            <td>15.30</td>  <!-- total oncall working hours -->
                                            <td><input type="text" name="oncall_kr_time[]" /></td>  <!-- kr/time -->
                                            <td>OB</td>     <!-- have ob exist or not -->
                                            <td><input type="text" name="ob_kr_time[]" /></td>      <!-- kr/time -->
                                        </tr>*}
                                    </table>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    {*<input type="hidden" name="skapaarbetsgivarintyg2" value="ja" />*}
                                    <span style="margin-top: 25px" class="span12 no-ml mb">
                                        <button class="btn btn-primary mr" onclick="printForm();" type="button"><i class="icon-print"></i> {$translate.save_n_print}</button>
                                    </span>
                                </td>
                            </tr>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}