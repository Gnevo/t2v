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
                    <button style="" class="btn btn-default btn-normal span2 pull-right" type="button"onclick="javascript:document.location.href='{$url_path}administration/'">{$translate.backs}</button>
                    <button style="" class="btn btn-default btn-normal span2 pull-right" type="button"onclick="javascript:document.location.href='{$url_path}administration/'" onclick="printForm()">{$translate.print}</button>
                </div>
                
            </div>
            <div class="span12 widget-body-section input-group">



                <div class="filter-bar input-group">
                   <form name="bill_form" id="bill_form" method="post" action="{$url_path}billing/">

                        <!-- Filter -->
                        <div class="span2">
                            <label>{$translate.year}:</label>
                            <div class="input-prepend span8" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                <select class="form-control span12" style="margin: 0px;" name=cmb_year id=cmb_year onchange="get_bills(this.value)">
                                     <option value="" >{$translate.select_year}</option>
                                     {html_options values=$year_option_values selected=$bill_year output=$year_option_values}
                                </select>
                           </div>
                        </div>

                        <div style="" class="span3">
                            <label>{$translate.bills}:</label>
                            <div class="input-prepend span8" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                <select style="margin: 0px;" class="form-control span10" name=cmb_bills id=cmb_bills onchange="get_report()">
                                    <option value="" >{$translate.select_bill}</option>
                                    {html_options values=$bill_values selected=$selected_bill output=$bill_output}
                                </select>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <!-- // Filter END -->

                    </form>
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
                                        <div class="span12"><center>
                                            <h1><strong>{$translate.time2ve}<br>
                                                    {$translate.invoice}</strong></h1>
                                        </center>            
                                        </div>
                                    </div>



                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div style="padding: 0px;" class="well">
                                                <table class="table table-invoice">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:50%">


                                                                <ol class="bill-list">
                                                                    <li><div class="span6">{$translate.invoice_date}</div><div class="span6">:{$bill_date}</div></li>
                                                                    <li><div class="span6">{$translate.invoice_number}</div><div class="span6">:{utf8_decode(utf8_encode($file_number))}</div></li>
                                                                    <li><div class="span6">{$translate.pay_day}</div><div class="span6">:{$pay_date}(15 {$translate.days})</div></li>
                                                                    <li><div class="span6">{$translate.interest}</div><div class="span6">:10%</div></li>
                                                                    <li><div class="span6">{$translate.reminder_fee}</div><div class="span6">:150 {$translate.kr}</div></li>
                                                                    <li><div class="span6">{$translate.our_reference}</div><div class="span6">:{utf8_decode(utf8_encode($our_reference))}</div></li>
                                                                    <li><div class="span6">{$translate.your_reference}</div><div class="span6">:{utf8_decode(utf8_encode($company_details.contact_person2))}</div></li>
                                                                </ol>
                                                            </td>
                                                            <td style="width:50%; padding-left: 20px;">


                                                                <ol class="bill-list">
                                                                    <li><div class="span6">{$translate.company_name}</div><div class="span6">:{utf8_decode(utf8_encode($company_details.name))}</div></li>
                                                                    <li><div class="span6">{$translate.address}</div><div class="span6">:{utf8_decode(utf8_encode($company_details.address))}</div></li>
                                                                    <li><div class="span6">{$translate.zip_code}</div><div class="span6">:{$company_details.zipcode}</div></li>
                                                                    <li><div class="span6">{$translate.city}</div><div class="span6">:{utf8_decode(utf8_encode($company_details.city))}</div></li>
                                                                </ol>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row-fluid">
                                        <div class="span12">
                                            <table class="table table-bordered table-primary table-striped table-vertical-center">
                                                <thead>
                                                    <tr>
                                                       
                                                        <th class="header">{$translate.item}</th>
                                                        <th class="header headerSortDown" style="width: 50px;">{$translate.amount}</th>
                                                        <th class="header" style="width: 120px;">{$translate.period}</th>
                                                        <th class="header" style="width: 80px;">{$translate.price_unit}</th>
                                                        <th class="header" style="width: 80px;">{$translate.total}</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        
                                                        <td>
                                                            <h5>{$translate.active_customer}</h5>
                                                        </td>
                                                        <td>{$no_of_customer}</td>
                                                        <td>{$formated_bill_date}</td>
                                                        <td>{$price_per_customer} {$translate.skr}</td>
                                                        <td>{$no_of_customer*$price_per_customer} {$translate.skr}</td>
                                                    </tr><tr>
                                                        
                                                        <td>
                                                            <h5>{$translate.no_sms}rs</h5>
                                                        </td>
                                                        <td>{$no_of_sms}</td>
                                                        <td>{$formated_bill_date}</td>
                                                        <td>{$price_per_sms} {$translate.skr}</td>
                                                        <td>{$no_of_sms*$price_per_sms} {$translate.skr}s</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-highlight-table-row" colspan="4" style="text-align: right;"><strong>{$translate.total}</strong></td>
                                                        <td class="col-highlight-table-row"><strong>{$total_amt} {$translate.skr}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div></div>


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
                                        </div></div>

                                    <div class="row-fluid">
                                        <div style="" class="span12">
                                            <div class="span3" style="">
                                                <div class="" style="padding: 10px;">
                                                    <p class="margin-none">
                                                        <center><strong>{$translate.address}</strong>
                                                        <br>
                                                        Time2view AB
                                                        Eriksbergsvägen 10
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
                                                        Support: 0764-210003
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
                                                        support@time2view.se
                                                        Info@time2view.se
                                                        www.time2view.se
                                                    </center>    
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="span3" style="">
                                                <div class="" style="padding: 10px;">
                                                    <p class="margin-none">
                                                    <center>    
                                                    Org. Nummer: 556872-7324
                                                    Bankgiro: 819-3054
                                                    Momsreg.nr SE556872732401
                                                    </center>
                                                    </p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                        </div>
                        <label style="" for="exampleInputEmail1"> </label>
                    </div>
                    {/if}
                </div>




            </div>

            <div style="display: none;" id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 0px; top: 0px;" oncontextmenu="return false;"><div style="line-height: 30px;" class="mCSB_dragger_bar"></div></div><div class="mCSB_draggerRail"></div></div></div>


            <!--OPTION PANEL BEGIN--><!--OPTION PANEL END-->





            <!--TABLE BEGIN--><!--TABLE END-->




        </div>
        <!--/////////////////////////////////////////////////////RIGHT FORM SECTION START\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\--> 


        </div>


{/block}

{block name='script'}
    <script src="{$url_path}js/nice-scroll.js"></script>
    <script type="text/javascript">

function get_report()
{
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

function printForm()
{
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

function get_bills(year)
{
    $("#action").val('');
    var f = $("#bill_form");
    f.attr('target', '');
    if(year != ""){
//            f.submit();
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

