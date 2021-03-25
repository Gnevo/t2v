{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .lists { height: 200px;  overflow-x: auto; max-height: 50px; }
    .lists .badge {  margin: 5px; }
    .ui-autocomplete { max-height: 200px;overflow-y: auto;/* prevent horizontal scrollbar */ overflow-x: hidden; }
    * html .ui-autocomplete { height: 200px; }
    .search_types { margin-top: 12px; }
    .search_selected { margin-top: 5px; }
    .customer_block, .employ_block, .selected_textfiled, .all_rb_div { float: left;margin-right: 8px;}
    .padd_column { padding-left: 8px !important;}
    .txt_align_center { text-align: center;}
    .ui-autocomplete.ui-widget-content{ z-index: 5 !important;}
    #send_form.show_unsend_users_only .export_user.badge-success, #send_form.show_unsend_users_only .export_user.badge-important{ display: none;}
    /*#send_form.show_unsend_users_only .export_user.badge-success + .export_user.unsend { display: none;}*/
    #send_form .mailing_group { margin-left: 0.497513% !important; margin-right: 0.497513% !important;}
    .margin-right { margin-right:15px; }
</style>
{/block}

{block name="script"}
<script type="text/javascript">
    
function loadSearchData(){
    var sel_year = $.trim($('#cmb_year').val());
    var sel_month = $.trim($('#cmb_month').val());
    if( sel_year != '' && sel_month != ''){
        $('#action').val('GET-SEARCH-DATA');
        wrapLoader('#List_form');
        $('#List_form').submit();
    }
}

function getList(){
    var sel_year = $.trim($('#cmb_year').val());
    var sel_month = $.trim($('#cmb_month').val());
    if( sel_year != '' && sel_month != ''){
        $('#action').val('GET-DATA');
        wrapLoader('#List_form');
        $('#List_form').submit();
    }
}

function dataSend(){
    var sel_year = $.trim($('#cmb_year').val());
    var sel_month = $.trim($('#cmb_month').val());
    if( sel_year != '' && sel_month != ''){
        $('#action').val('GET-DATA');
        wrapLoader('#main-group-wraper');
        $('#send_form').submit();
    }
}

$(document).ready(function() {
    $('#cmb_employee').change(function () {
            $('#cmb_customer').val('');
    });
    $('#cmb_customer').change(function () {
            $('#cmb_employee').val('');
    });
    
    $("#recipient_check_all, .check_recipient_groups, .check_recipient_emp").click(function(e){
        e.stopPropagation();
    });
    $('#recipient_check_all').click(function () {
        $('.main-left').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
        $('.main-left').find('.export_user:not(.hide)').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    $('.check_recipient_groups').click(function () {
        $(this).parents('.mailing_group').find('.export_user:not(.hide)').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-250});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    $(window).resize(function(){
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-250});
        else
            $('.tab-content-con').css({ height: $(window).height()});
    });
    
    $('#search_type_div').delegate('.search_type', 'change', function () {
        var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
        if (search_type_rd.length > 0)
            search_type = search_type_rd.val();

        if(search_type == 1){   {*customer*}
            $('#cmb_employee').val('');
            $('.search_type_customer_div').css('display', 'block');
            $('.search_type_employee_div').css('display', 'none');
            $('#cmb_customer').focus();
        }else if(search_type == 2){ {*employee*}
            $('#cmb_customer').val('');
            $('.search_type_employee_div').css('display', 'block');
            $('.search_type_customer_div').css('display', 'none');
            $('#cmb_employee').focus();
        }else if(search_type == 3){ {*all*}
            $('#cmb_customer, #cmb_employee').val('');
            $('.search_type_employee_div').css('display', 'none');
            $('.search_type_customer_div').css('display', 'none');
        }
    });
    
    $('#chk_show_unsend_contacts_only').click(function() {
        if($(this).is(':checked')){
            //$('#send_form').addClass('show_unsend_users_only');
            $('#send_form').find('.export_user.badge-success, .export_user.badge-important').addClass('hide');
            
            $('.main-left').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('.main-left').find('.check_recipient_emp:checkbox').attr('checked', false);
            
            $('#send_form').find('.mailing_group').removeClass('hide');
            $('#send_form .mailing_group').each(function( index ) {
                // console.log($(this).find('.export_user.unsend').length);
                if($(this).find('.export_user.unsend').length > 0)
                    $(this).removeClass('hide');
                else
                    $(this).addClass('hide');
            });
        }else{
            $('#send_form').removeClass('show_unsend_users_only');
            $('#send_form').find('.mailing_group').removeClass('hide');
            $('#send_form').find('.export_user.badge-success, .export_user.badge-important').removeClass('hide');
        }
    });
});
</script>
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="tbl_hd"><span class="titles_tab">{$translate.emp_to_cust_fkkn_export}</span>
            <a href="{$url_path}administration/" class="back"><span class="btn_name">{$translate.backs}</span></a>
        </div>
        {$message} 
        <div id="main-group-wraper" class="span12 no-ml">
        <div id="tble_list">
            <div class="option_strip clearfix" style="padding-bottom: 10px;">
                <form id="List_form" name="List_form" action="" method="post" class="clearfix no-mb">
                    <input type="hidden" name="action" id="action" value="GET-SEARCH-DATA" />
                    <div class="span12">
                        <div class="span8">
                            <span class="span6">
                                <label class="pull-left span3">{$translate.year}:</label>
                                <!--<select name=cmb_year id=cmb_year onchange="loadSearchData();">-->
                                <select name=cmb_year id=cmb_year>
                                    {*html_options values=$year_option_values selected=$list_year output=$year_option_values*}
                                    {foreach $year_option_values as $lv}
                                       <option value="{$lv}" {if $lv eq $lst_year || $lv eq $list_year}selected="selected"{/if} >{$lv}</option>
                                    {/foreach}
                                </select>
                            </span>
                            <span class="span6">
                                <label class="pull-left span3">{$translate.month}:</label>
                                <!--<select name=cmb_month id=cmb_month onchange="loadSearchData();">-->
                                <select name=cmb_month id=cmb_month>
                                    <option value="" >{$translate.select_month}</option>
                                    {html_options values=$month_option_values selected=$list_month output=$month_option_output_full}
                                    {*html_options values=$month_option_values selected=$list_month output=$month_option_output_full*}
                                </select>
                            </span>
                        </div>
                        {*<div class="span12 no-ml">
                            <span class="span6">
                                <label class="pull-left span3">{$translate.employee}:</label>
                                <select name=cmb_employee id=cmb_employee>
                                    <option value="" >{$translate.all}</option>
                                    {foreach $load_employees as $le}
                                        <option value="{$le.employee_id}" {if $le.employee_id eq $sel_employee}selected="selected"{/if} >{if $sort_by_name eq 1}{$le.emp_ff}{else}{$le.emp}{/if}</option>
                                    {/foreach}
                                </select>
                            </span>
                            <span class="span6">
                                <label class="pull-left span3">{$translate.customer}:</label>
                                <select name=cmb_customer id=cmb_customer>
                                    <option value="" >{$translate.all}</option>
                                    {foreach $load_customers as $lc}
                                        <option value="{$lc.customer_id}" {if $lc.customer_id eq $sel_customer}selected="selected"{/if} >{if $sort_by_name eq 1}{$lc.cust_ff}{else}{$lc.cust}{/if}</option>
                                    {/foreach}
                                </select>
                            </span>
                        </div>*}
                        <div class="search_types span12 no-ml">
                            <h1>{$translate.search_with}</h1>
                            <div class="search_selected span12"  id="search_type_div" >
                                <div class="clearfix" style="padding-top: 3px; float: left;">
                                    <div class="all_rb_div">
                                        <label>
                                            <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'all' or $search_type eq ''}checked="checked"{/if} id="rb_all_emps" name="search_type" class="search_type" value="3" /></p>
                                            <p style="float: left;">{$translate.all}</p>
                                        </label>
                                    </div>
                                        
                                    <div class="customer_block">
                                        <label>
                                            <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'customer'}checked="checked"{/if} id="search_type_customer" name="search_type" class="search_type" value="1" /></p>
                                            <p style="float: left;">{$translate.customer}</p>
                                        </label>
                                    </div>
                                    <div class="selected_textfiled search_type_customer_div" style="{if $search_type neq 'customer'}display: none;{/if}">
                                        {*{$translate.customer}:*}
                                        <select name=cmb_customer id=cmb_customer>
                                            <option value="" >{$translate.all}</option>
                                            {foreach $load_customers as $lc}
                                                <option value="{$lc.customer_id}" {if $search_type eq 'customer' and $lc.customer_id eq $sel_customer}selected="selected"{/if} >{if $sort_by_name eq 1}{$lc.cust_ff}{else}{$lc.cust}{/if}</option>
                                            {/foreach}
                                        </select>
                                    </div>

                                    <div class="employ_block">
                                        <label>
                                            <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'employee'}checked="checked"{/if} id="search_type_employee" name="search_type" class="search_type" value="2" /></p>
                                            <p style="float: left;">{$translate.employee}</p>
                                        </label>
                                    </div>
                                    <div  class="selected_textfiled search_type_employee_div" style="{if $search_type neq 'employee'}display: none;{/if}">
                                        <select name=cmb_employee id=cmb_employee>
                                            <option value="" >{$translate.all}</option>
                                            {foreach $load_employees as $le}
                                                <option value="{$le.employee_id}" {if $search_type eq 'employee' and $le.employee_id eq $sel_employee}selected="selected"{/if} >{if $sort_by_name eq 1}{$le.emp_ff}{else}{$le.emp}{/if}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                        
                                    <span style="margin: 0 3px 0 2px;">
                                        <input type="button" value="{$translate.get}" onclick="getList();"/>
                                         {*and $smarty.cookies.debug eq true*}
                                        {*{if $employees_group|count gt 0}<input type="button" value="{$translate.send}" onclick="dataSend();"/>{/if}*}
                                    </span> 
                                </div>

                            </div>
                        </div>
                    </div>
                    {*<div class="span4 no-ml" style="margin-top: 32px;">
                        <span style="margin: 0 3px 0 2px;">
                            <input type="button" value="{$translate.get}" onclick="getList();"/>
                            {if $employees_group|count gt 0}<input type="button" value="{$translate.send}" onclick="dataSend();"/>{/if}
                        </span> 
                    </div>*}
                </form>
            </div>
        </div>
        {if $employees_group|count gt 0}
            <div class="row-fluid">
                <div class="span12">
                    <div style="margin:0px !important;" class="widget">
                        <div class="widget-header span12">
                            <div class="clearfix" style="padding: 10px !important;min-height: 15px;">
                                <input value="all" name="recipient_check_all" id="recipient_check_all" class="pull-left check_recipient_groups check_recipient_emp" type="checkbox" />
                                <label for="recipient_check_all" class="pull-left" style="margin: 0px 16px 0px 10px;">{$translate.all}</label>

                                <input type="checkbox" name="chk_show_unsend_contacts_only" id="chk_show_unsend_contacts_only" title="{$translate.show_unsend_users_only}" class="pull-left" />
                                <label for="chk_show_unsend_contacts_only" class="pull-left" style="margin: 0px 0px 0px 10px;">{$translate.show_unsend_users_only}</label>
                                
                                {if $employees_group|count gt 0}<input type="button" value="{$translate.send}" onclick="dataSend();" class="pull-right no-mb btn-success btn-small" style="margin: 0px 0px 0px 10px;"/>{/if}
                                <label class="pull-right margin-right"><b>{$translate.export_sent_users_count}: {$total_send_users_count}</b></label>
                                <label class="pull-right margin-right"><b>{$translate.export_unsent_users_count}: {$total_unsend_users_count}</b></label>
                                <label class="pull-right margin-right"><b>{$translate.export_users_count}: {$total_users_count}</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        {/if}
        {if $get_page}
            <div class="row-fluid">
                <div class="span12">
                    <div style="margin:0px !important;" class="widget">
                        <div class="widget-header span12">
                            <div class="clearfix" style="padding: 10px !important;min-height: 15px;">
                                <label class="pull-right margin-right"><b>{$translate.export_sent_users_count}: {$total_send_users_count}</b></label>
                                <label class="pull-right margin-right"><b>{$translate.export_unsent_users_count}: {$total_unsend_users_count}</b></label>
                                <label class="pull-right margin-right"><b>{$translate.export_users_count}: {$total_users_count}</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
        <div class="tab-content-con" style="border: 1px solid #e3e3e3;">
            <form id="send_form" name="send_form" action="" method="post" class="">
                <input type="hidden" name="action" value="SEND-DATA" />
                <input type="hidden" name="cmb_customer" value="{$sel_customer}" />
                <input type="hidden" name="cmb_employee" value="{$sel_employee}" />
                <input type="hidden" name="cmb_year" value="{$list_year}" />
                <input type="hidden" name="cmb_month" value="{$list_month}" />
                <input type="hidden" name="search_type" value="{if $search_type eq 'customer'}1{else if $search_type eq 'employee'}2{else}3{/if}" />
                <div class="row-fluid">
                    {foreach $employees_group as $eg_set}
                        {foreach $eg_set as $eg}
                            {if $eg.employee_customers|count gt 0}
                                <div class="span4 mailing_group" style="margin-top:5px;">
                                    <div style="margin:0px !important;" class="widget">
                                        <div class="widget-header span12">
                                            <div style="border-bottom:solid 1px #fff; padding: 10px !important;min-height: 15px;">
                                                <input value="{$eg.employee_username}" {*name="cch_{$eg.employee_username}"*} id="cch_{$eg.employee_username}" class="pull-left check_recipient_groups" type="checkbox">
                                                <label for="cch_{$eg.employee_username}" class="pull-left" style="margin: 0px 0px 0px 10px;">{if $sort_by_name eq 1}{$eg.employee_fname} {$eg.employee_lname}{else}{$eg.employee_lname} {$eg.employee_fname}{/if}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-body-section lists input-group">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                {foreach $eg.employee_customers as $egc}
                                                    <span class="export_user badge {if $egc.exported_count gt 0 and $egc.exported_count ge 2}badge-important{elseif $egc.exported_count gt 0 and $egc.last_exported_date ge $egc.employer_sign_date}badge-success{else}unsend{/if}">
                                                        {if ($egc.exported_count eq 0 or $egc.last_exported_date lt $egc.employer_sign_date) && $egc.exported_count lt 2}
                                                            <input id="cch_{$egc.username}_{$eg.employee_username}" name="send_data_set[{$eg.employee_username}][{$egc.username}]" value="{$egc.username}_{$eg.employee_username}" class="badgebox pull-left check_recipient_emp checkbox" style="margin-right: 5px;" type="checkbox"/> 
                                                        {/if}
                                                        <label class="pull-left pl" for="cch_{$egc.username}_{$eg.employee_username}">
                                                            {if $sort_by_name eq 1}{$egc.first_name} {$egc.last_name}{else}{$egc.last_name} {$egc.first_name}{/if} 
                                                            
                                                            {if $egc.last_exported_date neq ''}({$egc.exported_count})<br/><small><i>{$egc.last_exported_date}</i></small>{/if}
                                                        </label>
                                                    </span>
                                                {/foreach}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        {/foreach}
                    {/foreach}
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{/block}