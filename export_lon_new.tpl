{block name='style'}
    <style type="text/css">
        .alerts-export-wrpr { max-height: 300px; overflow: auto; overflow-x: hidden;  margin: 0 0 15px 0 !important; }
        .export-error-box {  margin: 0 !important;  }
        .export-error-box > div { background: none !important; border-bottom: 2px solid green;padding-bottom: 20px; padding-left: 0 !important; }
        .export-error-box > div:last-child { border-bottom: 0 !important;padding-bottom: 0 !important; }
        .export-error-box xmp { background: #FFF none repeat scroll 0% 0%;padding: 15px 15px 0px 0px;font-weight: bold; margin: 0 !important; }
    </style>

{/block}

{block name="content"}
    
    <div class="row-fluid">
        <div class="span12 main-left">

            <center>  
                <span style="display: none; position:absolute; left: 500px; top: 214px;z-index: 100;" id="loading">
                    <img src="{$url_path}images/sgo-loading.gif"  />
                </span>
            </center>

            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="span10"><h1>{$translate.export_title}</h1></div>
                    {if $fkkn_split}<div class="span2" ><h1 style="margin: 0px ! important; background-color:#9da0a5; text-align: center; float: left;">{$translate.fkkn_split}</h1></div>{/if}
                </div>
                
            </div>
            <div class="span12 widget-body-section input-group">



                <div class="span12">
                    <form id="customer_report" method="post">
                        <div class="span12">
                            <div class="widget" style="margin-top:0;">
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section input-group">
                                    <div class="span12">

                                        
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.customer}</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11 hasDatepicker" id="datepicker"> <span class="add-on icon-pencil" data-icon=""></span>

                                                <select class="form-control span10" name="customer" id="customer">
                                                    <option value="">{$translate.all_clients}</option>
                                                    {html_options values=$customer_list selected=$post_customer output=$customer_list_n} 
                                                </select>
                                            </div>
                                        </div>




                                        <div class="span2" style="margin: 0px;">
                                            <label class="span3" style="float: left;" for="exampleInputEmail1">{$translate.month}</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11 hasDatepicker" id="datepicker"> <span class="add-on icon icon-calendar"></span>
                                                <select class="form-control span10" name="month" id="month" onchange="javascript:this.form.submit();">
                                                    {foreach key=id from=$monthsn item=m}
                                                        <option value="{$months[$id]}" {if $month eq $months[$id]} selected="selected"{/if}>
                                                            {$id+1|string_format:"%02d"} {$translate.$m}</option>
                                                        {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.year}</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11 hasDatepicker" id="datepicker"> <span class="add-on icon icon-calendar"></span>
                                                <select class="form-control span10" id="cmb_year" name="year" onchange="javascript:this.form.submit();">
                                                    {html_options values=$years selected=$year output=$years selected=$year}    
                                                </select>
                                            </div>
                                        </div>

                                        {if $salary_code > 0}        
                                            <div class="span2" style="margin: 0px;">
                                                <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.export_type}</label>
                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11 hasDatepicker" id="datepicker"> <span class="add-on icon icon-file-text"></span>
                                                    <select class="form-control span10" id="cmb_year" name="app">
                                                        {if $salary_code == 1}
                                                            <option value="visma600">{$translate.lbl_export_visma600}</option>
                                                        {else if $salary_code == 2}    
                                                            <option value="visma">{$translate.lbl_export_visma_lon}</option>
                                                        {else if $salary_code == 3}    
                                                            <option value="hogia">{$translate.lbl_export_hogia_lon}</option>
                                                        {else if $salary_code == 4}    
                                                            <option value="crona">{$translate.lbl_export_crona}</option>
                                                        {else if $salary_code == 6}    
                                                            <option value="bl">{$translate.lbl_export_bl}</option>
                                                        {/if}    
                                                    </select>
                                                </div>
                                            </div>
                                        {/if}

                                        

                                        <div class="span3" style="margin: 0px;">
                                            <input type="hidden" name="export_data" value='{$export_data}'>
                                            <input type="hidden" name='export_data_users' value='{$export_data_users}'>
                                            {if $company_id == 14}<button class="btn btn-default  btn-margin-set" style="margin: 16px 8px 0px ! important; text-align: center;" type="submit" name="verify" value="verify">{$translate.verify}</button>{/if}
                                            <button class="{if $export_data_flag}btn btn-success{else}btn btn-default{/if}  btn-margin-set" style="margin: 16px 8px 0px ! important; text-align: center;" type="submit" name="export" value="export" {if $export_data_flag != 1}disabled{/if}>{$translate.export}</button>
                                            <a style="margin: 16px 0px 0px ! important; text-align: center; background-color:#9da0a5; display:block; padding: 4px; float: right;" href="javascript:document.location.href='{$url_path}export_lon-config/'">{$translate.config}</a>
                                            {if $company_id == 14}<button class="btn btn-default  btn-margin-set" style="margin: 16px 0px 0px ! important; text-align: center;" type="button" name="Send" disabled>{$translate.send_export}</button>{/if}
                                        </div>    
                                    </div>
                                </div>
                                <!--WIDGET BODY END-->
                            </div>
                        </div>
                    </form>                    
                </div>



                <div class="row-fluid">
                    <div class="span12">
                        <div class="span12">


                            <div class="widget" style="margin-top:0;">
                                <!--WIDGET BODY BEGIN-->




                                <div class="span12 widget-body-section input-group">
                                    {$message}
                                    
                                    <div class="alerts-export-wrpr">
                                        
                                            
                                            {$export_error}
                                        
                                    </div>
                                    
                                  <div class="row-fluid">
                                        <div class="span4 top-customer-info"><strong>{$translate.num_employees}</strong>{$num_employees}</div>
                                        <div class="span4 top-customer-info"><strong>{$translate.num_signed}</strong>{$num_signed}</div>
                                        <div class="span4 top-customer-info"><strong>{$translate.num_not_signed}</strong>{$num_not_signed}</div>
                                    </div>
                                    <div class="span7" style="padding: 0px ! important; margin: 0px ! important;">

                                        <form id="mail_sms" method="post" action="{$url_path}export_lon/">
                                            <input type="hidden" name="sms_num" id="sms_num" value="" />
                                            <input type="hidden" name="email_num" id="email_num" value="" />
                                            <input type="hidden" name="sms_month" id="sms_month" value="" />
                                            <input type="hidden" name="sms_year" id="sms_year" value="" />
                                            <div class="table-height-fix boxscroll">
                                            <table class="table table-bordered table-condensed table-hover table-responsive table-primary t" style="margin: 10px 0px 0px; top: 0px;">
                                                <!-- Table heading -->
                                                <thead>
                                                    <tr>

                                                        <th>{$translate.employee_customer}</th>
                                                        <th>{$translate.phone_mobile}</th>
                                                        <th>{$translate.sms}<br><center><input type="checkbox" name="sms_check_all" id="sms_check_all"></center></th>
                                                        <th>{$translate.email}<br><center><input type="checkbox" name="email_check_all" id="email_check_all"></center></th>
                                                        <th>{$translate.last_send}</th>
                                                        <th>{$translate.count}</th>


                                                    </tr>
                                                </thead>
                                                <!-- // Table heading END -->
                                                <!-- Table body -->
                                                <tbody>
                                                    {$not_signed}
                                                </tbody>
                                                <!-- // Table body END -->
                                            </table>
                                        </div>

                                        <div class="span12" style="margin: 0px;">
                                            <div class="widget" style="margin: 0px ! important; padding: 0px;">
                                                <!--WIDGET BODY BEGIN-->
                                                <div style="border-radius: 0px 0px 4px 4px ! important;" class="span12 widget-body-section input-group">
                                                    <div class="span8" style="margin: 0px ! important;">

                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-envelope"></span>
                                                            <input class="form-control span11" {*placeholder="Förnamn*"*} name="textfield" id="textfield" type="text"> </div>
                                                    </div>
                                                    <div class="span4">
                                                        <button class="btn btn-default span12 btn-margin-set" name="sms" type="submit" id="sms">
                                                            {$translate.btn_sms_email}<span class="icon icon-chevron-right"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--WIDGET BODY END-->
                                            </div>
                                        </div>
                                        </form>                
                                    </div>
                                    <div class="span5 table-export-info pull-left" style="padding: 0px ! important;float: left !important;">
                                    <div class="table-height-fix boxscroll">
                                        <table class="table table-bordered table-condensed table-hover table-responsive table-primary t" style="margin: 10px 0px 0px; top: 0px;">
                                            <!-- Table heading -->
                                            <thead>
                                                <tr>

                                                    <th colspan="5">{$translate.num_exported} {$num_exported}</th>
                                                </tr>
                                            </thead>
                                            <!-- // Table heading END -->
                                            <!-- Table body -->
                                            <tbody>
                                                {foreach key=id from=$existing item=export}
                                                <tr class="gradeX">

                                                    <td>
                                                        <form  id="customer_report" method="post" class="table-form">
                                                            <input type="hidden" name="month" value="{$month}" />
                                                            <input type="hidden" name="year" value="{$year}" />
                                                            <input type="hidden" name="filename" value="{$export.filename}" />
                                                            <input type="hidden" name="download" value=" {$translate.download} " />
                                                            <a id="link_{$id}" href="javascript:void(0);" onclick="$(this).parents('form').get(0).submit();" style="text-decoration:underline; cursor:pointer;" >{$export.year}{"%02d"|sprintf:$export.month}</a>
                                                        </form>
                                                    </td>
                                                    <td>{$export.employee}{if $export.customers}/{$export.customers}{/if}</td>
                                                    <td>{$export.timestamp|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                                    <td class="table-col-center small-col">
                                                        <form name="customer_report" id="customer_report" method="post"  class="table-form">
                                                            <input type="hidden" name="del_file" value="{$export.filename}" />    
                                                            <input type="hidden" name="month" value="{$month}" />
                                                            <input type="hidden" name="year" value="{$year}" />
                                                        
                                                        <button type="button" class="btn btn-default delete-exported-table-row" id="del_{$id}" onclick="sub_customer_del($(this).parents('form').get(0));" title="{$translate.btn_delete}"><span class="icon-remove"></span></button>
                                                        </form>
                                                    </td>

                                                </tr>
                                                {/foreach}
                                                <!-- // Table row END -->
                                            </tbody>
                                            <!-- // Table body END -->
                                        </table>
                                       </div>
                                    </div>






                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                            <div class="span7">
                                <div style="margin: 15px 0px 15px ! important;" class="widget">
                                    <div class="span12 top-customer-info"><strong>{$translate.employees_exported}: {count($employees_exported)}</strong></div>
                                </div>
                                <table class="table table-bordered table-primary table-condensed table-striped table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="header">{$translate.serial_no}</th>
                                            <th class="header">{$translate.employee}</th>
                                            <th class="header">{$translate.customer}</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {assign i 0}
                                        {foreach from=$employees_exported item=employee_det}
                                            {assign i $i+1}
                                            <tr class="gradeX">
                                                <td>{$i}</td>
                                                <td>{$employee_det['employee']}</td>
                                                <td>{implode(",",$employee_det['customers'])}</td>
                                                
                                            </tr>
                                        
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                        <label style="margin-bottom:10px !important;" for="exampleInputEmail1"> </label>
                    </div>
                </div>


            </div>

            

        </div>


       

        </div><!--////////////////////////////////////MAIN LEFT END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    {/block}

{block name='script'}
<script type="text/javascript" src="{$url_path}js/nice-scroll.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            
            // $('html, body').css('overflow', 'auto');
            // $("#menu").hide();
            $('.success, .message, .fail, .error').delay(10000).fadeOut();
				
				 $(".boxscroll").niceScroll({
                    cursorborder: "",
                    cursorcolor: "#B7E3EC",
                    boxzoom: true,
					zindex: 0,
                }); // First scrollable DIV
				
            $('#customer_report').submit(function() {
                //$(':submit', this).attr('disabled', 'disabled');
                $('#loading').show(); // show animation
                return true; // allow regular form submission
            });
            
            $("#mail_sms").submit(function() {
    
    
                $("#sms_month").val($("#month").val());
                $("#sms_year").val($("#cmb_year").val());

                var email = "";
                $("input[name='email[]']:checked:checked").each(function ()
                {
                    temp = $(this).val();
                    if(email.indexOf(temp) == -1){
                        if(email != "")
                            email += ","+ temp;
                        else
                            email = temp;
                    }

                });
                $('#email_num').val(email);

                var sms = "";
                $("input[name='sms[]']:checked:checked").each(function ()
                {
                    temp = $(this).val();
                    if(sms.indexOf(temp) == -1){
                        if(sms != "")
                            sms += ","+ temp;
                        else
                            sms = temp;
                    }

                });
                $('#sms_num').val(sms);

                if($('#sms_num').val() != '' || $('#email_num').val() != ''){
                    return true;
                }else{
                    alert('{$translate.check_atleast_one_mail_sms}');
                    return false;
                }
            });
            
            $("#sms_check_all").click(function () {
                $('.check_sms:checkbox').attr('checked', this.checked);
            });
            $("#email_check_all").click(function () {
                $('.check_email:checkbox').attr('checked', this.checked);
            });
            
        });
        
        function sub_customer_del(obj){
            if(confirm('{$translate.confirm_delete_file}')){
                $("#sms_month").val($("#month").val());
                $("#sms_year").val($("#cmb_year").val());
                obj.submit();
            }else{
                return false;
            }
    
}
    </script>
{/block}    
