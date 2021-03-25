{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.billing_information}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:document.location.href='{$url_path}administration/'">{$translate.backs}</button>
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm();">{$translate.print}</button>
                </div>

            </div>
            <div class="span12 widget-body-section input-group">
                <div class="span12 widget-body-section input-group" >
                    <div class="widget-body" style="padding:5px;">


                        <div class="row-fluid" style="margin-bottom:15px;">
                            <div class="span12 widget-body-section input-group">
                                <form name="bill_form" id="bill_form" method="post" action="{$url_path}billing/">
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;">{$translate.year}:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select class="form-control span12" style="margin: 0px;" name=cmb_year id=cmb_year onchange="get_bills(this.value)">
                                                <option value="" >{$translate.select_year}</option>
                                                {html_options values=$year_option_values selected=$bill_year output=$year_option_values}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span2">
                                        <label class="span12" style="float: left;" >{$translate.bills}:</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select style="margin: 0px;" class="form-control span10" name=cmb_bills id=cmb_bills onchange="get_report()">
                                                <option value="" >{$translate.select_bill}</option>
                                                {html_options values=$bill_values selected=$selected_bill output=$bill_output}
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="current_bill" name="current_bill" value="{$tbl_id}" /> 
                                    <input type="hidden" id="action" name="action" value="" /> 
                                </form>

                            </div>
                        </div>

                        <div style="" class="row-fluid">
                            {if $is_generate}
                                <div class="span12">
                                    <div class="span12">
                                        <div class="widget" style="margin: 0px ! important;">
                                            <div style="" class="span12 widget-body-section input-group">
                                                <div class="row-fluid">
                                                    <div class="span12">

                                                        <table class="table table-invoice">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 58%;">
                                                                        <div class="billing-logo">
                                                                            <img style="" class="media-object pull-left thumb billing-logo" src="../images/t2v_billing_logo.png" alt="t2v">
                                                                            <div class="media-body hidden-print">

                                                                                <div class="separator bottom"></div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div style="margin: 0px 0px 20px;" class="row-fluid">
                                                    <div class="span12">
                                                        <center>
                                                            <h1><strong>{$translate.time2ve}<br>{$translate.invoice}</strong></h1>
                                                        </center>            
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div style="padding: 0px;" class="well">
                                                            <div class="table-responsive">
                                                                <table class="table table-invoice">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width:10%; padding-left: 15px;">
                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col">{$translate.invoice_date} : <span class="pull-right">{$bill_date}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.invoice_number} : <span class="pull-right">{utf8_decode(utf8_encode($file_number))}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.pay_day} : <span class="pull-right">{$pay_date}(15 {$translate.days})</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.interest} : <span class="pull-right">10%</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.reminder_fee} : <span class="pull-right">150 {$translate.kr}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.our_reference} : <span class="pull-right"> {utf8_decode(utf8_encode($our_reference))}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.your_reference} : <span class="pull-right">{utf8_decode(utf8_encode($company_details.contact_person2))}</span></div></li>
                                                                                </ol>
                                                                            </td>
                                                                            <td style="width:10%; padding-left: 150px;">


                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col">{$translate.company_name} : <span class="pull-right">{utf8_decode(utf8_encode($company_details.name))}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.address} : <span class="pull-right">{utf8_decode(utf8_encode($company_details.address))}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.zip_code} : <span class="pull-right">{$company_details.zipcode}</span></div></li>
                                                                                    <li><div class="bill-col">{$translate.city} : <span class="pull-right">{utf8_decode(utf8_encode($company_details.city))}</span></div></li>
                                                                                </ol>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                            <thead>
                                                                <tr>

                                                                    <th class="header" style="text-align: center;">{$translate.item}</th>
                                                                    <th class="header headerSortDown" style="text-align: center;">{$translate.amount}</th>
                                                                    <th class="header" style="text-align: center;">{$translate.period}</th>
                                                                    <th class="header" style="text-align: center;">{$translate.price_unit}</th>
                                                                    <th class="header" style="text-align: center;">{$translate.total}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h5>{$translate.active_customer}</h5>
                                                                    </td>
                                                                    <td>{$no_of_customer}</td>
                                                                    <td>{$formated_bill_date}</td>
                                                                    <td style="text-align: right;">{$price_per_customer} {$translate.skr}</td>
                                                                    <td style="text-align: right;">{$no_of_customer*$price_per_customer} {$translate.skr}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><h5>{$translate.no_sms}</h5></td>
                                                                    <td>{$no_of_sms}</td>
                                                                    <td>{$formated_bill_date}</td>
                                                                    <td style="text-align: right;">{$price_per_sms} {$translate.skr}</td>
                                                                    <td style="text-align: right;">{$no_of_sms*$price_per_sms} {$translate.skr}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><h5>{$translate.no_sign}</h5></td>
                                                                    <td>{$no_of_sign}</td>
                                                                    <td>{$formated_bill_date}</td>
                                                                    <td style="text-align: right;">{$price_per_sign} {$translate.skr}</td>
                                                                    <td style="text-align: right;">{$no_of_sign*$price_per_sign} {$translate.skr}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-highlight-table-row" colspan="4" style="text-align: right;"><strong>{$translate.total}</strong></td>
                                                                    <td class="col-highlight-table-row" style="text-align: right;"><strong>{$total_amt} {$translate.skr}</strong></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="col-highlight-table-row" colspan="5" style="text-align: center;"><strong>{$translate.moms} 25%</strong></td>
                                                                    <td style="text-align: right;" class="col-highlight-table-row"><strong>{$quater_percentage} {$translate.skr}</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-highlight-table-row" colspan="5" style="text-align: center;"><strong>{$translate.summa_att_betala}</strong></td>
                                                                    <td style="text-align: right;" class="col-highlight-table-row"><strong>{$grand_total} {$translate.skr}</strong></td>
                                                                </tr></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div style="" class="span12">
                                                        <div class="span3" style="">
                                                            <div class="" style="padding: 10px;">
                                                                <p class="margin-none">
                                                                <center><strong>{$translate.address}</strong>
                                                                    <br>
                                                                    Time2view AB<br>
                                                                    Eriksbergsvägen 10<br>
                                                                    692 32 Kumla
                                                                </center>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="span3" style="">
                                                            <div class="" style="padding: 10px;">
                                                                <p class="margin-none">
                                                                <center>
                                                                    <strong>{$translate.phone}</strong><br>
                                                                    Support: 0764-210003<br>
                                                                    Info: 0704-434964
                                                                </center>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="span3" style="">
                                                            <div class="" style="padding: 10px;">
                                                                <p class="margin-none">
                                                                <center>
                                                                    <strong>{$translate.email}</strong><br>
                                                                    support@time2view.se<br>
                                                                    Info@time2view.se<br>
                                                                    www.time2view.se
                                                                </center>    
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="span3" style="">
                                                            <div class="" style="padding: 10px;">
                                                                <p class="margin-none">
                                                                <center>    
                                                                    Org. Nummer: 556872-7324<br>
                                                                    Bankgiro: 819-3054<br>
                                                                    Momsreg.nr SE556872732401
                                                                </center>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}

{block name='script'}
<script src="{$url_path}js/nice-scroll.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        //alert($(window).height());
        if($(window).height() > 600)
            $('.main-left').css({ height: $(window).height()-55}); 
        else
            $('.main-left').css({ height: $(window).height()});    

        $(window).resize(function(){
            if($(window).height() > 600)
                $('.main-left').css({ height: $(window).height()-55}); 
            else
                $('.main-left').css({ height: $(window).height()});  
        });  
    });

    function get_report(){
        var year = $("#cmb_year").val();
        var bill = $("#cmb_bills").val();
        $("#action").val('');
        $("#bill_form").attr('target', '');
        if(year != "" && bill != ""){
                //            $("#bill_form").submit();
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                        async:false,
                        url:"{$url_path}billing/",
                        data:"cmb_year="+year+"&cmb_bills="+bill,
                        type:"POST",
                        success:function(data){
                                $("#main_content #external_wrapper").html(data);
                                uwrapLoader("#main_content #external_wrapper");
                                }
                    });
            }
            //        var f = $("#bill_form");
            //        f.attr('target', '_SELF');
            //        if(year != "" && bill != "")
            //            f.submit();
    }

    function printForm(){
        var bill_id = $("#current_bill").val();
        var year = $("#cmb_year").val();
        var bill = $("#cmb_bills").val();
        $("#action").val(bill_id);
        if(bill_id != ""){
            var f = $("#bill_form");
            f.attr('target', '_BLANK');
            f.submit();
        }
    }

    function get_bills(year){
        //$("#action").val('');
        var f = $("#bill_form");
        f.attr('target', '');
        if(year != ""){
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                        async:false,
                        url:"{$url_path}billing/",
                        data:"cmb_year="+year,
                        type:"POST",
                        success:function(data){
                                $("#main_content #external_wrapper").html(data);
                                uwrapLoader("#main_content #external_wrapper");
                                }
                    });
            }
    }
</script>
{/block}