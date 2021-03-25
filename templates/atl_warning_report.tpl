{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
{/block} 

{block name='script'}
<script type="text/javascript">
    function printForm(){
        var f = $("#form_list");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
        f.attr('target', '_SELF');
        $('#action').val('');
    }
    
    
    function paginateDisplay(page,emp){
        document.location.href = "{$url_path}atl/warning/"+page+"-"+emp+"/";
    }
    $(document).ready(function(){
        {if $search_type == 2}
           $('.search_type_employee_div').css('float', 'left');
           $('.search_type_employee_div').css('padding', '0 6px');
        {elseif $search_type == 1}
           $('.search_type_customer_div').css('float', 'left'); 
           $('.search_type_customer_div').css('padding', '0 6px'); 
        {/if}
        var search_type = '';
        $("#search_emp").click(function(){
            if($("#search_emp").val() == '{$translate.search_employee}'){
                $("#search_emp").val('');
            }
        }); 
        $("#search_emp").blur(function(){
            if($("#search_emp").val() == ''){
                $("#search_emp").val('{$translate.search_employee}');
            }
        });
        $('#form_list').submit(function() {
            $(':submit',this).attr('disabled','disabled');
            $('#loading').show(); // show animation
            return true; // allow regular form submission
        });
        var search_employees = [
                {foreach from=$employees item=employee}
                    {if $sort_by_name == 1}
                        {
                        value: "{$employee.username}",
                        label: "{$employee.first_name} {$employee.last_name}"
                        },
                    {elseif $sort_by_name == 2}
                        {
                        value: "{$employee.username}",
                        label: "{$employee.last_name} {$employee.first_name}"
                        },
                    {/if}
                {/foreach}
        ];
        $( "#search_emp" ).autocomplete({
            minLength: 0,
            source: search_employees,
            focus: function( event, ui ) {
                        $( "#search_emp" ).val( ui.item.label );
                        return false;
                    },
            select: function( event, ui ) {
                        var sel_value = ui.item.value;
                        var sel_label = ui.item.label;
                        $("#emp_selected").val(sel_value);
                        $("#search_emp").val(sel_label);
                        return false;
                    }
        });
        
        var search_customers = [
                {foreach from=$customers item=customer}
                    {if $sort_by_name == 1}
                        {
                        value: "{$customer.username}",
                        label: "{$customer.first_name} {$customer.last_name}"
                        },
                    {elseif $sort_by_name == 2}
                        {
                        value: "{$customer.username}",
                        label: "{$customer.last_name} {$customer.first_name}"
                        },
                    {/if}
                {/foreach}
        ];
        $( "#txt_customer" ).autocomplete({
            minLength: 0,
            source: search_customers,
            focus: function( event, ui ) {
                        $( "#txt_customer" ).val( ui.item.label );
                        return false;
                    },
            select: function( event, ui ) {
                        var sel_value = ui.item.value;
                        var sel_label = ui.item.label;
                        $("#cust_selected").val(sel_value);
                        $("#txt_customer").val(sel_label);
                        return false;
                    }
        });
        
        $('#search_type_div').delegate('.search_type', 'change', function () {
                var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                if (search_type_rd.length > 0)
                    search_type = search_type_rd.val();

                if(search_type == 1){   {*customer*}
                    $('.search_type_customer_div').css('display', 'block');
                    $('.search_type_customer_div').css('float', 'left');
                    $('.search_type_customer_div').css('padding', '0 6px');
                    $('.search_type_employee_div').css('display', 'none');
                    $('#txt_customer').focus();
                }else if(search_type == 2){ {*employee*}
                    $('.search_type_employee_div').css('display', 'block');
                    $('.search_type_employee_div').css('float', 'left');
                    $('.search_type_employee_div').css('padding', '0 6px');
                    $('.search_type_customer_div').css('display', 'none');
                    $('#search_emp').focus();
                }else if(search_type == 3){ {*unsigned employees*}
                    $('.search_type_employee_div').css('display', 'none');
                    $('.search_type_customer_div').css('display', 'none');
                }
        });
    });
</script>
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">    
<div class="tbl_hd"><span class="titles_tab">{$translate.atl_warning}</span>
    <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    <div class="titlebar_chekbox" style="margin-top: 4px; margin-right: 12px;">
         <center>  
            <span style="display:none; position:absolute; left: 600px; top: 214px;" id="loading">
            <img src="{$url_path}images/sgo-loading.gif"  />
            </span>
         </center>
        <!--<form id="form_list" name="form_list" method="post" action="{$url_path}atl/warning/">
            <input type="hidden" name="action" id="action" value="" />
            {$translate.month}:
            <select id="month" name="month">
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
            {$translate.year}:
            <select id="year" name="year">
            
                {foreach $years_report AS $yrs}
                    <option value="{$yrs.year}" {if $yrs.year == $year}selected="selected"{/if}>{$yrs.year}</option>
                {/foreach}
            </select>
            <input type="text" name="search_emp" id="search_emp" value="{$translate.search_employee}" />
            <input type="hidden" name="emp_selected" id="emp_selected" value="" />
            <input type="submit" name="get_report" id="get_report" value="{$translate.get_report}" />
            
            
            
        </form>-->
        
        
    </div>
</div>

<div id="tble_list">
    <div class="row-fluid">
        <div class="option_strip span12" style="padding-bottom: 10px;">
            <form id="form_list" name="form_list" method="post" action="{$url_path}atl/warning/">
                <div class="workreportform_left"  style="float:inherit;" id="search_type_div">
                    <div id="year_month_search" style="float: left">
                        {$translate.year}:
                        <select id="year" name="year">
                            {foreach $years_report AS $yrs}
                                <option value="{$yrs.year}" {if $yrs.year == $year}selected="selected"{/if}>{$yrs.year}</option>
                            {/foreach}
                        </select>

                        {$translate.month}:
                        <select id="month" name="month">
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
                        <span style="padding-left: 7px"></span> 
                    </div>
                    <div id="cust_emp_search" style="float: left;margin-top: 4px;">
                        <div class="customer_block" style="float: left;padding: 0 3px;">
                            <label>
                                <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq '1'}checked="checked"{/if} id="search_type_customer" name="search_type" class="search_type" value="1" /></p>
                                <p style="float: left;">{$translate.customer}</p>
                            </label>
                        </div>
                        <div class="selected_textfiled search_type_customer_div" style="{if $search_type neq '1'}display: none;float: left;{/if}">
                            {*{$translate.customer}:*}
                            <input type="text" id="txt_customer" name="txt_customer" value="{if $search_type eq '1'}{$cust_name}{/if}" placeholder="{$translate.select_customer}"/>
                            <input type="hidden" id="cust_selected" name="cust_selected"value="{if $search_type eq '1'}{$cust_selected}{/if}"/>
                        </div>

                        <div class="employ_block" style="float: left;padding: 0 3px">
                            <label>
                                <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq '2'}checked="checked"{/if} id="search_type_employee" name="search_type" class="search_type" value="2" /></p>
                                <p style="float: left;">{$translate.employee}</p>
                            </label>
                        </div>
                        <div  class="selected_textfiled search_type_employee_div" style="{if $search_type eq '1'}display: none;float: left;{/if}">
                            {*{$translate.employee}:*}
                            <input type="text" id="search_emp" name="search_emp" value="{if $search_type eq '2'}{$emp_name}{/if}" placeholder="{$translate.select_employee}"/>
                            <input type="hidden" id="emp_selected" name="emp_selected" value="{if $search_type eq '2'}{$emp_selected}{/if}"/>
                        </div>
                    </div>
<!--                    <input type="text" name="search_emp" id="search_emp" value="{$translate.search_employee}" />
                    <span style="padding-left: 7px"></span> 
                    <input type="hidden" name="emp_selected" id="emp_selected" value="" />-->
                            <input type="submit" name="get_report" id="get_report" value="{$translate.get_report}" style="margin: 0 6px;margin-top: 3px"/>
                </div>
                
            </form>
        </div>
        {if $min_weekly_rest}
        <div class="span12">
            <b>
                <div class="span3">{$translate.max_daily_work}: {$max_daily_hour}h</div>
                <div class="span3">{$translate.min_day_rest}: {$min_daily_rest}h</div>
                <div class="span3">{$translate.min_weekly_rest}: {$min_weekly_rest}h</div>
                <div class="span3">{$translate.employee_start_day_time}: {$emp_start_day}  {$emp_start_time}</div>
            </b>
        </div>
        {/if}
    </div>

                <div class="row-fluid">
    <div id="table_val" class="span12">
    
        <table class="table_list" style="width:100%">
            
            {foreach from=$reports item=report}
               
                {assign var = 'i' value=0 scope='global'}
                
                {foreach from=$report item=warnings}
                   {assign var = 'i' value=$i+1 scope='global'}
                   {if $i==1}
                        <tr>
                            <th style="text-align: left;font-size: 12px;">{$warnings.employee_name}</th>
                        </tr>
                    {/if}    
                    <tr  class="{cycle values='even,odd'}">

                        <td style="text-align: left; font-size: 12px; padding-left: 15px;">{$i}.&nbsp;{$warnings.atl_message}</td>

                    </tr>
                {/foreach}
            {foreachelse}
                <tr><td >
                        <div class="message">{$translate.no_data_available}</div>
                    </td>
                </tr>
            {/foreach}
        </table>
    </div>
                </div></div>  
    </div>
</div>            
{/block}