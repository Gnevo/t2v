<?php /* Smarty version Smarty-3.1.8, created on 2021-02-24 06:44:28
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/billing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9689934926035f5cca04af2-14659330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd61d787518f9cb7b314701de0aa8a3db0d7ecc7' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/billing.tpl',
      1 => 1613804740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9689934926035f5cca04af2-14659330',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'translate' => 0,
    'year_option_values' => 0,
    'bill_year' => 0,
    'bill_values' => 0,
    'selected_bill' => 0,
    'bill_output' => 0,
    'tbl_id' => 0,
    'is_generate' => 0,
    'bill_date' => 0,
    'file_number' => 0,
    'pay_date' => 0,
    'our_reference' => 0,
    'company_details' => 0,
    'no_of_customer' => 0,
    'formated_bill_date' => 0,
    'price_per_customer' => 0,
    'no_of_sms' => 0,
    'price_per_sms' => 0,
    'no_of_sign' => 0,
    'price_per_sign' => 0,
    'total_amt' => 0,
    'quater_percentage' => 0,
    'grand_total' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6035f5ccac71c9_46759772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6035f5ccac71c9_46759772')) {function content_6035f5ccac71c9_46759772($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.html_options.php';
?>
    <link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/administration.css" rel="stylesheet" type="text/css" />



    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['billing_information'];?>
</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="javascript:document.location.href='<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
administration/'"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</button>
                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm();"><?php echo $_smarty_tpl->tpl_vars['translate']->value['print'];?>
</button>
                </div>

            </div>
            <div class="span12 widget-body-section input-group">
                <div class="span12 widget-body-section input-group" >
                    <div class="widget-body" style="padding:5px;">


                        <div class="row-fluid" style="margin-bottom:15px;">
                            <div class="span12 widget-body-section input-group">
                                <form name="bill_form" id="bill_form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
billing/">
                                    <div class="span2" style="margin: 0px ! important; padding: 0px;">
                                        <label class="span12" style="float: left;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:</label>
                                        <div style="margin: 0px; float:left" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select class="form-control span12" style="margin: 0px;" name=cmb_year id=cmb_year onchange="get_bills(this.value)">
                                                <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_year'];?>
</option>
                                                <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_option_values']->value,'selected'=>$_smarty_tpl->tpl_vars['bill_year']->value,'output'=>$_smarty_tpl->tpl_vars['year_option_values']->value),$_smarty_tpl);?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="span2">
                                        <label class="span12" style="float: left;" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['bills'];?>
:</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker span10"> <span class="add-on icon icon-calendar"></span>
                                            <select style="margin: 0px;" class="form-control span10" name=cmb_bills id=cmb_bills onchange="get_report()">
                                                <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select_bill'];?>
</option>
                                                <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['bill_values']->value,'selected'=>$_smarty_tpl->tpl_vars['selected_bill']->value,'output'=>$_smarty_tpl->tpl_vars['bill_output']->value),$_smarty_tpl);?>

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="current_bill" name="current_bill" value="<?php echo $_smarty_tpl->tpl_vars['tbl_id']->value;?>
" /> 
                                    <input type="hidden" id="action" name="action" value="" /> 
                                </form>

                            </div>
                        </div>

                        <div style="" class="row-fluid">
                            <?php if ($_smarty_tpl->tpl_vars['is_generate']->value){?>
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
                                                            <h1><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['time2ve'];?>
<br><?php echo $_smarty_tpl->tpl_vars['translate']->value['invoice'];?>
</strong></h1>
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
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['invoice_date'];?>
 : <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['bill_date']->value;?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['invoice_number'];?>
 : <span class="pull-right"><?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['file_number']->value));?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['pay_day'];?>
 : <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['pay_date']->value;?>
(15 <?php echo $_smarty_tpl->tpl_vars['translate']->value['days'];?>
)</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['interest'];?>
 : <span class="pull-right">10%</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reminder_fee'];?>
 : <span class="pull-right">150 <?php echo $_smarty_tpl->tpl_vars['translate']->value['kr'];?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['our_reference'];?>
 : <span class="pull-right"> <?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['our_reference']->value));?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['your_reference'];?>
 : <span class="pull-right"><?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['company_details']->value['contact_person2']));?>
</span></div></li>
                                                                                </ol>
                                                                            </td>
                                                                            <td style="width:10%; padding-left: 150px;">


                                                                                <ol class="bill-list">
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['company_name'];?>
 : <span class="pull-right"><?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['company_details']->value['name']));?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
 : <span class="pull-right"><?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['company_details']->value['address']));?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['zip_code'];?>
 : <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['company_details']->value['zipcode'];?>
</span></div></li>
                                                                                    <li><div class="bill-col"><?php echo $_smarty_tpl->tpl_vars['translate']->value['city'];?>
 : <span class="pull-right"><?php echo utf8_decode(utf8_encode($_smarty_tpl->tpl_vars['company_details']->value['city']));?>
</span></div></li>
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

                                                                    <th class="header" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['item'];?>
</th>
                                                                    <th class="header headerSortDown" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['amount'];?>
</th>
                                                                    <th class="header" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['period'];?>
</th>
                                                                    <th class="header" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['price_unit'];?>
</th>
                                                                    <th class="header" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['total'];?>
</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['active_customer'];?>
</h5>
                                                                    </td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['no_of_customer']->value;?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['formated_bill_date']->value;?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['price_per_customer']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['no_of_customer']->value*$_smarty_tpl->tpl_vars['price_per_customer']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_sms'];?>
</h5></td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['no_of_sms']->value;?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['formated_bill_date']->value;?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['price_per_sms']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['no_of_sms']->value*$_smarty_tpl->tpl_vars['price_per_sms']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_sign'];?>
</h5></td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['no_of_sign']->value;?>
</td>
                                                                    <td><?php echo $_smarty_tpl->tpl_vars['formated_bill_date']->value;?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['price_per_sign']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                    <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['no_of_sign']->value*$_smarty_tpl->tpl_vars['price_per_sign']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-highlight-table-row" colspan="4" style="text-align: right;"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['total'];?>
</strong></td>
                                                                    <td class="col-highlight-table-row" style="text-align: right;"><strong><?php echo $_smarty_tpl->tpl_vars['total_amt']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</strong></td>
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
                                                                    <td class="col-highlight-table-row" colspan="5" style="text-align: center;"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['moms'];?>
 25%</strong></td>
                                                                    <td style="text-align: right;" class="col-highlight-table-row"><strong><?php echo $_smarty_tpl->tpl_vars['quater_percentage']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-highlight-table-row" colspan="5" style="text-align: center;"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['summa_att_betala'];?>
</strong></td>
                                                                    <td style="text-align: right;" class="col-highlight-table-row"><strong><?php echo $_smarty_tpl->tpl_vars['grand_total']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['translate']->value['skr'];?>
</strong></td>
                                                                </tr></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div style="" class="span12">
                                                        <div class="span3" style="">
                                                            <div class="" style="padding: 10px;">
                                                                <p class="margin-none">
                                                                <center><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['address'];?>
</strong>
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
                                                                    <strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['phone'];?>
</strong><br>
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
                                                                    <strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['email'];?>
</strong><br>
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
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/nice-scroll.js"></script>
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
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
billing/",
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
                        url:"<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
billing/",
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
<?php }} ?>