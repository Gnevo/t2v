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
        <div class="span12 main-left" style="height: 1000px">

            
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


                <div class="span12 widget-body-section input-group" id="gdschema_kund">


                    <div class="row-fluid">
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

                                                        <select class="form-control span10" name="customer" id="customer" onchange="this.form.submit()">
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
                                                    <a style="margin: 16px 0px 0px ! important; text-align: center; background-color:#9da0a5; display:block; padding: 4px; float: right;" href="javascript:document.location.href='{$url_path}export_lon-config/'"
                                                    target="_blank">{$translate.config}</a>
                                                    {if $company_id == 14}<button class="btn btn-default  btn-margin-set" style="margin: 16px 0px 0px ! important; text-align: center;" type="button" name="Send" disabled>{$translate.send_export}</button>{/if}
                                                </div>    
                                            </div>
                                        </div>
                                        <!--WIDGET BODY END-->
                                    </div>
                                </div>
                            </form>                    
                        </div>
                    </div>
                    {if !empty($report_list)}
                        <div class="row-fluid">
                            <table class="table_list work_report table table-bordered table-condensed table-hover table-responsive" style="width:100%">
                                <tbody>                                   
                                    <tr>
                                            <th height="50" style="width: 50%">{if $search_type eq 'customer'}{$translate.employee}{/if}</th>
                                            <th style="width: 15%">{$translate.total_working_days}</th>
                                            <th style="width: 10%">{$translate.work_sum_ord}</th>
                                            <th style="width: 10%">{$translate.work_sum_jour}</th>
                                            <th style="width: 15%">{$translate.work_sum}</th>
                                    </tr>
                                    {foreach from=$report_list item=full_entry_list}  
                                        <tr class="{cycle values="even usertd,odd usertd"}">
                                            <td height="38" class="usertdname" {if $list_month neq ''}style="padding-left: 15px;"{/if}><span class="workreport_name">{if $sort_by_name == 1}{$full_entry_list.first_name}, {$full_entry_list.last_name}{elseif $sort_by_name == 2}{$full_entry_list.last_name}, {$full_entry_list.first_name}{/if}</span></td>
                                   
                                            {if $list_month neq ''}
                                                <td>{$full_entry_list.work_hours.total_working_days}{*$this_month_working_days*}</td>
                                                <td>{$full_entry_list.work_hours.total_normal}</td>
                                                <td>{$full_entry_list.work_hours.total_oncall}</td>
                                                <td>{$full_entry_list.work_hours.total}</td>
                                            {/if}
                                        </tr>
                                    {foreachelse}
                                        <tr><td colspan="{if $list_month eq ''}13{else}6{/if}"><div class="message">{$translate.no_data_available}</div></td></tr>
                                    {/foreach}
                                </tbody>
                            </table>        
                        </div>    
                    {/if}

                    <div class="row-fluid">    
                        <div class="span12">
                                {$message}                                        
                                <div class="alerts-export-wrpr">
                                        {$export_error}                                            
                                </div>
                                <div class="widget" style="margin-top:0;">
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span6 ">
                                                                                
                                        <div class="row-fluid" style="margin: 5px 0px 0px ! important;">
                                            <div class="span6 top-customer-info"><strong>{$translate.num_employees}</strong>{$num_employees}</div>
                                            <div class="span6 top-customer-info"><strong>{$translate.num_not_signed}</strong>{$num_not_signed}</div>
                                        </div>
                                        
                                        <div class="span12 table-export-info pull-left" style="padding: 0px ! important;float: left !important;">
                                            <div class="table-height-fix">
                                                <table class="table table-bordered table-condensed table-hover table-responsive table-primary t" style="margin: 10px 0px 0px; top: 0px;">
                                                    <thead>
                                                        <tr>

                                                            <th colspan="5">{$translate.num_exported} {$num_exported}</th>
                                                        </tr>
                                                    </thead>
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
                                                    </tbody>
                                                </table>
                                           </div>
                                        </div>
                                        <!--WIDGET BODY END-->
                                    </div>

                                    <div class="span6">
                                        <div style="margin: 5px 0px 8px ! important;" class="widget">
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
                                    
                        </div>
                        
                    </div>
                </div>
            
        </div>




        </div><!--////////////////////////////////////MAIN LEFT END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    {/block}

{block name='script'}
{* <script type="text/javascript" src="{$url_path}js/nice-scroll.js"></script> *}
    <script type="text/javascript">
        $(document).ready(function() {
            
            if($(window).height() > 600)
                $('#gdschema_kund').css({ height: $(window).height()-110}); 
            else
                $('#gdschema_kund').css({ height: $(window).height()});    

            $(window).resize(function(){
                if($(window).height() > 600)
                    $('#gdschema_kund').css({ height: $(window).height()-305}); 
                else
                    $('#gdschema_kund').css({ height: $(window).height()});  
            });  
            //$('html, body').css('overflow', 'auto');
            //$("#menu").hide();
            $('.success, .message, .fail, .error').delay(10000).fadeOut();
				
				
				
            $('#customer_report').submit(function() {
                $('#loading').show(); // show animation
                return true; // allow regular form submission
            });
            
        });

        function sub_customer_del(obj){
            if(confirm('{$translate.confirm_delete_file}')){
                obj.submit();
            }else{
                return false;
            }
    
        }
        
        
    </script>
{/block}    
