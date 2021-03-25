{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    * html .ui-autocomplete {
        height: 200px;
    }
    .search_types {
            margin-top: 12px;
    }
    .search_selected {
            margin-top: 5px;
    }
    .customer_block, .employ_block, .selected_textfiled, .unsigned_rb_div {
            float: left;
            margin-right: 8px;
    }
    .padd_column {
            padding-left: 8px !important;
    }
    .txt_align_center {
            text-align: center;
    }
    .ui-autocomplete.ui-widget-content{ z-index: 5 !important;}
</style>
{/block}

{block name="script"}
<script type="text/javascript">
    

function select_employee(alpha){
    {if $search_user_id neq ""}
        var search_type = '';
        {if $search_type eq 'customer'}
            search_type = '1';
        {else if $search_type eq 'employee'}
            search_type = '2';
        {else if $search_type eq 'unsigned'}
            search_type = '3';
        {/if}
        window.location.href = '{$url_path}report/work/employee/list/{$list_year}/{$selected_month_pg_label}/'+search_type+'/{$search_user_id}/{$flag_show_previous_connections}/'+alpha+'/';
    {/if}
}



function getList(){
    var year = $("#cmb_year").val();
    var month_selected = $("#cmb_month").val();
    var month_label = 'M-'+ month_selected;
    
    var search_type = "";
    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
    if (search_type_rd.length > 0)
        search_type = search_type_rd.val();
    
    var search_user_id = '';
    var search_user_name = '';
    var prev_connection_flag = 'N';
    if(search_type == 1){
        search_user_id = $.trim($("#customer-id").val());
        search_user_name = $.trim($("#txt_customer").val());
        prev_connection_flag = $("input:checkbox:checked#show_prev_emps").val();
        if(typeof prev_connection_flag == 'undefined' || prev_connection_flag != 'Y')
            prev_connection_flag = 'N';
    }else if(search_type == 2){
        search_user_id = $.trim($("#employee-id").val());
        search_user_name = $.trim($("#txt_employee").val());
        prev_connection_flag = $("input:checkbox:checked#show_prev_custs").val();
        if(typeof prev_connection_flag == 'undefined' || prev_connection_flag != 'Y')
            prev_connection_flag = 'N';
    }
    
    if(search_type == ''){
        alert('{$translate.select_a_search_type}');
    } else if(search_type == 3){
        if(year == '')
            alert('{$translate.select_year}');
        else if(month_label == 'M-')
            alert('{$translate.select_month}');
        else
            window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+month_label+'/'+search_type+'/-/';
        {*trailing '-' parameter for priventing default pagination*}
    } else if(search_user_name == '' && (search_type == 1 || search_type == 2)){
        if(search_type == 1){
            alert('{$translate.select_customer}');
            $("#txt_customer").focus();
        }else if(search_type == 2){
            alert('{$translate.select_employee}');
            $("#txt_employee").focus();
        }
    } else if(search_user_name != "" && search_user_id != "" && typeof(search_user_id) != 'undefined'){
        window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+month_label+'/'+search_type+'/'+search_user_id+'/'+prev_connection_flag+'/';
    } else{
        alert('{$translate.enter_search_values}');
        //window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+month_label+'/1/';
    }
}

function form_submit(){
    $("#sign_form").submit();
}

$(function() {
        var availableCustomers = [
            {foreach from=$search_customers item=customer}  
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
        var availableEmployees = [
            {foreach from=$search_employees item=employee}  
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
        console.log(availableEmployees);
        $( "#txt_customer" ).autocomplete({
            minLength: 0,
            source: availableCustomers,
            focus: function( event, ui ) {
                $( "#txt_customer" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#txt_customer" ).val( ui.item.label );
                $( "#customer-id" ).val( ui.item.value );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };
        
        $( "#txt_employee" ).autocomplete({
            minLength: 0,
            source: availableEmployees,
            focus: function( event, ui ) {
                $( "#txt_employee" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#txt_employee" ).val( ui.item.label );
                $( "#employee-id" ).val( ui.item.value );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };

        $.extend( $.ui.autocomplete, {
            escapeRegex: function( value ) {
                return value.replace(/[-[\]{ldelim}{rdelim}()*+?.,\\^$|#\s]/g, "\\$&");
            },
            filter: function(array, term) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
                return $.grep( array, function(value) {
                    return (matcher.test( value.label ) || matcher.test(value.value));
                });
            }
        });
        
        $('#search_type_div').delegate('.search_type', 'change', function () {
                var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                if (search_type_rd.length > 0)
                    search_type = search_type_rd.val();

                if(search_type == 1){   {*customer*}
                    $('.search_type_customer_div').css('display', 'block');
                    $('.search_type_employee_div').css('display', 'none');
                    $('#txt_customer').focus();
                }else if(search_type == 2){ {*employee*}
                    $('.search_type_employee_div').css('display', 'block');
                    $('.search_type_customer_div').css('display', 'none');
                    $('#txt_employee').focus();
                }else if(search_type == 3){ {*unsigned employees*}
                    $('.search_type_employee_div').css('display', 'none');
                    $('.search_type_customer_div').css('display', 'none');
                }
        });
        
        $('#cmb_month').change(function () {
                if($("#cmb_month").val() != '')
                    $('.unsigned_rb_div').css('display', 'block');
                else{
                    $('.unsigned_rb_div').css('display', 'none');
                    
                    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                    if (search_type_rd.length > 0)
                        search_type = search_type_rd.val();
                    if(search_type == 3) {*if checked unsigned rb, and then remove month selection, it will automatically clicked to 'search with customer option' *}
                        $('#search_type_customer').trigger('click');
                }
        });
        
        if($("#cmb_month").val() != ''){
            $('.unsigned_rb_div').css('display', 'block');
        }
        $(function () {
            $("#cmb_month").change();
        });

        $('input').keypress(function (e) {
          if (e.which == 13) {
            getList();
            return false;    //<---- Add this line
          }
        });_
    });
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd"><span class="titles_tab">{$translate.time_reporting}</span>
        <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    <div id="tble_list">
        <div class="option_strip clearfix" style="padding-bottom: 10px;">
            <form id="List_form" name="List_form" action="" method="post">
                <div class="workreportform_left"  style="float:inherit;">
                    {$translate.year}:
                    <select name=cmb_year id=cmb_year>
                        {html_options values=$year_option_values selected=$list_year output=$year_option_values}
                    </select>

                    {$translate.month}:{$list_month}
                    <select name=cmb_month id=cmb_month>
                        <option value="" >{$translate.select_month}</option>
                        {html_options values=$month_option_values selected=intval($list_month) output=$month_option_output_full}
                    </select>
                    <span style="padding-left: 15px"></span> 
                </div>
                <div class="search_types">
                    <h1>{$translate.search_with}</h1>
                    <div class="search_selected span12"  id="search_type_div" >
                        <div class="clearfix" style="padding-top: 3px; float: left;">
                            <div class="unsigned_rb_div" style="display: none;">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'unsigned'}checked="checked"{/if} id="rb_unsigned_emps" name="search_type" class="search_type" value="3" /></p>
                                    <p style="float: left;">{$translate.unsigned_employees}</p>
                                </label>
                            </div>
                                    
                            <div class="customer_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'customer'}checked="checked"{/if} id="search_type_customer" name="search_type" class="search_type" value="1" /></p>
                                    <p style="float: left;">{$translate.customer}</p>
                                </label>
                            </div>
                            <div class="selected_textfiled search_type_customer_div" style="{if $search_type neq 'customer' or $search_type eq 'unsigned'}display: none;{/if}">
                                {*{$translate.customer}:*}
                                <input type="text" id="txt_customer" name="txt_customer" value="{if $search_type eq 'customer'}{$search_user_name}{/if}" placeholder="{$translate.select_customer}"/>
                                <input type="hidden" id="customer-id" value="{if $search_type eq 'customer'}{$search_user_id}{/if}"/>
                            </div>
                            
                            <div class="employ_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" {if $search_type eq 'employee'}checked="checked"{/if} id="search_type_employee" name="search_type" class="search_type" value="2" /></p>
                                    <p style="float: left;">{$translate.employee}</p>
                                </label>
                            </div>
                            <div  class="selected_textfiled search_type_employee_div" style="{if $search_type eq 'customer' or $search_type eq 'unsigned'}display: none;{/if}">
                                {*{$translate.employee}:*}
                                <input type="text" id="txt_employee" name="txt_employee" value="{if $search_type eq 'employee'}{$search_user_name}{/if}" placeholder="{$translate.select_employee}"/>
                                <input type="hidden" id="employee-id" value="{if $search_type eq 'employee'}{$search_user_id}{/if}"/>
                            </div>
                            <div class="selected_textfiled search_type_customer_div" style="margin-left: 25px;{if $search_type neq 'customer' or $search_type eq 'unsigned'}display: none;{/if}">
                                    {if $user_role != 3}
                                        <label>
                                            <p style="float: left;"><input type="checkbox" value="Y" {*$search_type eq 'customer' and *}{if $flag_show_previous_connections eq 'Y'}checked="checked"{/if} id="show_prev_emps" style="margin-right: 3px;"/></p>
                                            <p style="float: left; width: 282px;margin-left: 5px;">{$translate.show_all_connected_employees}</p>
                                        </label>
                                    {/if}
                            </div>
                            <div  class="selected_textfiled search_type_employee_div" style="margin-left: 25px;{if $search_type eq 'customer' or $search_type eq 'unsigned'}display: none;{/if}">
                                    {if $user_role != 3}
                                        <label>
                                            <p style="float: left;"><input type="checkbox" value="Y" {*$search_type eq 'employee' and *}{if $flag_show_previous_connections eq 'Y'}checked="checked"{/if} id="show_prev_custs" style="margin-right: 3px;"/></p>
                                            <p style="float: left; width: 272px;margin-left: 5px;">{$translate.show_all_connected_customers}</p>
                                        </label>
                                    {/if}
                                
                            </div>
                        </div>
                            
                        <span style="margin: 0 3px 0 2px;">
                            <input type="button" value="{$translate.get}" onclick="getList();"/>
                        </span> 
                    </div>
                </div>
            </form>
        </div>

        {if $request_access}
            <div class="pagention span12 no-ml clearfix">
                {if $search_type neq 'unsigned'}
                    {assign var='alphabets' value=','|explode:$translate.alphabets}
                    <div class="alphbts">
                        <ul>
                            {foreach from=$alphabets item=row}
                                <li><a href="javascript:void(0)" onclick="select_employee('{$row}')">{$row}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
                <div class="pagention_dv clearfix"><div class="pagination clearfix no-mt no-mb"><ul id="pagination">{$pagination}</ul></div></div>
            </div>
            
            {if $search_type neq 'unsigned'}
                <table class="table_list work_report" style="width:100%">
                    <tbody>
                        <tr>
                            <th height="50" colspan="{if $list_month eq ''}13{else}6{/if}">{$translate.total_records|cat:': '|cat:$total_records_count} /{$total_records_count_including_connected}</th>
                        </tr>
                        <tr>
                            <th height="50">{if $search_type eq 'customer'}{$translate.employee}{else if $search_type eq 'employee'}{$translate.customer}{/if}</th>
                            {foreach from=$month_option_output_short key=k item=title_months}
                                {if $list_month eq '' or ($list_month neq '' and $list_month eq $k+1)}
                                <th >{$title_months}</th>
                                {/if}
                            {/foreach}
                            {if $list_month neq ''}
                                <th>{$translate.total_working_days}</th>
                                <th>{$translate.work_sum_ord}</th>
                                <th>{$translate.work_sum_jour}</th>
                                <th>{$translate.work_sum}</th>
                            {/if}
                        </tr>
                        {foreach from=$report_list item=full_entry_list}  
                            <tr class="{cycle values="even usertd,odd usertd"}">
                                <td height="38" class="usertdname" {if $list_month neq ''}style="padding-left: 15px;"{/if}><span class="workreport_name">{if $sort_by_name == 1}{$full_entry_list.first_name}, {$full_entry_list.last_name}{elseif $sort_by_name == 2}{$full_entry_list.last_name}, {$full_entry_list.first_name}{/if}</span></td>

                                {foreach from=$full_entry_list.Sign_details item=signing_month key=m}
                                    {if $list_month eq '' or ($list_month neq '' and $list_month eq $m)}
                                        {if $list_year < $now_year ||( $m <= $now_month && $list_year == $now_year)}
                                            <td {if $list_month neq ''}style="text-align: center;"{/if}>
                                                {if $full_entry_list.have_work.$m eq 1}
                                                   
                                                    {if $search_type eq 'customer'}
                                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$m}/{$full_entry_list.username}/{$search_user_id}/">
                                                    {else if $search_type eq 'employee'}
                                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$m}/{$search_user_id}/{$full_entry_list.username}/">
                                                    {else}
                                                        <a href="#">
                                                    {/if}
                                                           
                                                    {if $signing_month.signin_employee neq ''}
                                                        <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_employee_name} {$translate.on} {$signing_month.signin_date}">{$signing_month.signin_employee}{*$translate.signed*}1</span>
                                                    {else}
                                                        <span class="userlevel_2">{$translate.unsigned}</span>
                                                    {/if}
                                                   
                                                    {if $signing_month.signin_tl neq ''}
                                                        <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_tl_name} {$translate.on} {$signing_month.signin_tl_date}">{$signing_month.signin_tl}{*$translate.signed*}2</span>
                                                    {else}
                                                        <span class="userlevel_2">{$translate.unsigned}</span>
                                                    {/if}
                                                    {if $signing_month.signin_sutl neq ''}
                                                        <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_sutl_name} {$translate.on} {$signing_month.signin_sutl_date}">{$signing_month.signin_sutl}{*$translate.signed*}3</span>
                                                    {else}
                                                        <span class="userlevel_2">{$translate.unsigned}</span>
                                                    {/if}
                                                    
                                                    </a>
                                                    
                                                {else}
                                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;">{$translate.no_work}</span>
                                                {/if}
                                            </td>
                                        {else}
                                            <td {if $list_month neq ''}style="text-align: center;"{/if}>
                                                {if $full_entry_list.have_work.$m eq 1}
                                                    {if $search_type eq 'customer'}
                                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$m}/{$full_entry_list.username}/{$search_user_id}/">
                                                    {else if $search_type eq 'employee'}
                                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$m}/{$search_user_id}/{$full_entry_list.username}/">
                                                    {else}
                                                        <a href="#">
                                                    {/if}
                                                            <span class="userlevel_1">- - - - </span>
                                                            <span class="userlevel_2">- - - - -  </span>
                                                            <span class="userlevel_3">- - - - - - </span>
                                                        </a>
                                                {else}
                                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;">{$translate.no_work}</span>
                                                {/if}
                                            </td>
                                        {/if}
                                    {/if}
                                {foreachelse}
                                    <td></td>
                                {/foreach}
                                
                                {if $list_month neq ''}
                                    <th>{$full_entry_list.work_hours.total_working_days}{*$this_month_working_days*}</th>
                                    <th>{$full_entry_list.work_hours.total_normal}</th>
                                    <th>{$full_entry_list.work_hours.total_oncall}</th>
                                    <th>{$full_entry_list.work_hours.total}</th>
                                {/if}
                            </tr>
                        {foreachelse}
                            <tr><td colspan="{if $list_month eq ''}13{else}6{/if}"><div class="message">{$translate.no_data_available}</div></td></tr>
                        {/foreach}
                    </tbody>
                </table>
            {else}{*unsigned display area*}
                <table class="table_list work_report no-ml table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <th width="113" height="50" colspan="1" style="text-align: center;">{$translate.not_signed_employee_count|cat:': '|cat:$not_signed_employee_count}</th>
                            <th width="113" height="50" colspan="1" style="text-align: center;">{$translate.not_signed_gl_count|cat:': '|cat:$not_signed_gl_count}</th>
                            <th width="113" height="50" colspan="2" style="text-align: center;">{$translate.not_signed_admin_count|cat:': '|cat:$not_signed_admin_count}</th>
                            <th width="113" height="50" colspan="1" style="text-align: center;">{$translate.total_records|cat:': '|cat:$total_records_count}</th>
                        </tr>
                        <tr>
                            <th width="150px" height="50" rowspan="2">{$translate.employee}</th>
                            <th width="150px" height="50" rowspan="2">{$translate.customer}</th>
                            <th colspan="3">{$translate.signed_by}</th>
                        </tr>
                        <tr>
                            <th width='15%'>{$translate.employee_wr}</th>
                            <th width='15%'>{$translate.tl_wr}</th>
                            <th width='15%'>{$translate.super_tl_wr}</th>
                        </tr>
                        {foreach from=$report_list item=employees}  
                            <tr class="{cycle values="even usertd,odd usertd"}">
                                {assign customers_count $employees.customers|count}
                                <td height="38" class="padd_column usertdname" rowspan="{$customers_count}"><span class="workreport_name">{$employees.employee_details.last_name} {$employees.employee_details.first_name}</span></td>

                                {foreach from=$employees.customers item=customer key=k}
                                    <td height="38" class="padd_column usertdname"><span class="workreport_name">{$customer.last_name} {$customer.first_name}</span></td>
                                    <td class="txt_align_center">
                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.employee neq ''}<span class="userlevel_1">{$customer.signing_details.employee}</span>{else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center">
                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.tl neq ''}<span class="userlevel_1">{$customer.signing_details.tl}</span>{else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center">
                                        <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.sutl neq ''}<span class="userlevel_1">{$customer.signing_details.sutl}</span>{else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    {if $k+1 lt $customers_count}</tr><tr class="{cycle values="even usertd,odd usertd"}">{/if}
                                {foreachelse}
                                    <td></td><td></td><td></td><td></td>
                                {/foreach}
                            </tr>
                        {foreachelse}
                            <tr><td colspan="5"><div class="message">{$translate.no_data_available}</div></td></tr>
                        {/foreach}
                    </tbody>
                </table>
            {/if}
        {/if}
    </div>
        </div></div>
{/block}