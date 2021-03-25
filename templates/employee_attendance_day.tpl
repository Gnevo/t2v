{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" />
{/block} 
{block name="script"}
    <script src="{$url_path}js/date-picker.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
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

        $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
    });

    function show_datas() {
        $('#action').val('show');
        $('#data_form').submit();
    }

    function csvdownload() {
        $('#action').val('csv');
        $('#data_form').submit();
    }

    function exceldownload() {
        $('#action').val('excel');
        $('#data_form').submit();
    }
    function pdfdownload() {
        $('#action').val('pdf');
        $('#data_form').submit();
    }
    </script>
{/block}
{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="tbl_hd"><span class="titles_tab">{$translate.employee_attendance}</span>
                <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
            </div>
            <div id="tble_list">
                <div class="option_strip">
                    <div class="span10">
                        <form name="data_form" id="data_form" method="post" action="">
                             <input type="hidden" name="action" id="action" value="" />
                             <table width="100%" cellpadding="2" cellspacing="2">
                                <tr>
                                    <td width="20%">{$translate.from_date}</td>
                                    <td width="20%">{$translate.to_date}</td>
                                    <td width="10%"></td>
                                    <td width="20%">{$translate.year}</td>
                                    <td width="20%">{$translate.month}</td>
                                    <td></td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input type="text" class="span12 datepicker" name="from_date" value="{date('Y-m-d', strtotime($from_date))}" />
                                    </td>
                                    <td>
                                        <input type="text" class="span12 datepicker" name="to_date" value="{date('Y-m-d', strtotime($to_date))}" />
                                    </td>
                                    <td></td>
                                    <td style="vertical-align: top;">
                                        <select class="span12" id="year" name="year" >
                                            {foreach $years_report AS $yrs}
                                                <option value="{$yrs.year}" {if $yrs.year == $year}selected="selected"{/if}>{$yrs.year}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <select class="span12" id="month" name="month">
                                            <option value="01" {if  $month == 1} selected = "selected" {/if} >{$translate.jan}</option>
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
                                        </select>
                                     </td>
                                     <td style="vertical-align: top;"><input type="button" name="btn_submit" onclick="show_datas()" value="{$translate.show}" /></td>
                                 </tr>
                             </table>
                         </form>  
                         <div class="clearfix"></div>
                    </div>
                    <div class="span2">
                        <span style=" float:right;">
                            <a href="javascript:void(0);" onclick="csvdownload();" title="CSV" class="mr" ><img src="{$url_path}images/csv-download.png" height="30" width="30" /></a>
                            <a href="javascript:void(0);" onclick="exceldownload();" title="Excel" class="mr" ><img src="{$url_path}images/excel-download.png" height="30" width="30" /></a>
                            <a href="javascript:void(0);" onclick="pdfdownload();" title="PDF" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                 </div>
                 {if $absence_datas || $attendance_datas}
                     <div id="showdata" >
                        <div class="row-fluid">
                            <div class="span12" style="background-color: #FFF;">
                                <table class="table_list tbl_padding_fix" cellpadding="2" cellspacing="2" style="width:100%;">
                                    <tr>
                                        <th colspan="8">{$translate.employee_attendance}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8">{$translate.employee_attendance_heading_day}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" style="text-align: left;">{$translate.absence_day} : {$from_date} - {$to_date}</th>
                                        <th colspan="4" style="text-align: left;">{$translate.absence_month} : {$translate[strtolower(date('M', strtotime($search_from)))]} - {$year}</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th width="10%">{$translate.men}</th>
                                        <th width="10%">{$translate.women}</th>
                                        <th width="10%">{$translate.total}</th>
                                        <th></th>
                                        <th width="10%">{$translate.men}</th>
                                        <th width="10%">{$translate.women}</th>
                                        <th width="10%">{$translate.total}</th>
                                    </tr>
                                    {foreach from=$absence_datas item=absence_data}
                                        <tr>
                                            {foreach from=$absence_data item=absence}
                                                <td>{$absence}</td>
                                            {/foreach}
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <th colspan="4" style="text-align: left;">{$translate.attendance_day} : {$from_date} - {$to_date}</th>
                                        <th colspan="4" style="text-align: left;">{$translate.attendance_month} : {$translate[strtolower(date('M', strtotime($search_from)))]} - {$year}</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th width="10%">{$translate.men}</th>
                                        <th width="10%">{$translate.women}</th>
                                        <th width="10%">{$translate.total}</th>
                                        <th></th>
                                        <th width="10%">{$translate.men}</th>
                                        <th width="10%">{$translate.women}</th>
                                        <th width="10%">{$translate.total}</th>
                                    </tr>
                                    {foreach from=$attendance_datas item=attendance_data}
                                        <tr>
                                            {foreach from=$attendance_data item=attendance}
                                                <td>{$attendance}</td>
                                            {/foreach}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}
    
    


