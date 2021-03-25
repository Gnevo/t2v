{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
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
</style>
{/block}

{block name="script"}
<script type="text/javascript">
function getList(){
    var year = $("#cmb_year").val();
    var month_selected = $("#cmb_month").val();
    var month_label = 'M-'+ month_selected;
    var sign_level = $("#cmb_sign_level").val();
    var sign_level_label = 'SL-'+ sign_level;
    
    var sign_type_with_bankID = $("#search_type_div .sign_type_block input[type='checkbox'][name='sign_type_with_bankID']:checked").length > 0 ? 1 : 0;
    var sign_type_without_bankID = $("#search_type_div .sign_type_block input[type='checkbox'][name='sign_type_without_bankID']:checked").length > 0 ? 1 : 0;
    
   
    if(year == '')
        alert('{$translate.select_year}');
    else if(month_label == 'M-')
        alert('{$translate.select_month}');
    else if(sign_level_label == 'SL-')
        alert('{$translate.select_signing_user_level}');
    else if(sign_type_with_bankID == 0 && sign_type_without_bankID == 0)
        alert('{$translate.select_atleast_one_signing_type}');
    else
        window.location.href = '{$url_path}report/work/employee/signed/list/'+year+'/'+month_label+'/'+sign_type_with_bankID+'/'+sign_type_without_bankID+'/'+sign_level_label+'/-/';
    {*trailing '-' parameter for priventing default pagination*}
}

function get3059(slot_type){
    if(slot_type == 1)
        $('#slot_type').val('1');
    else
        $('#slot_type').val('2');
    $('#List_form').submit();
}
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd"><span class="titles_tab">{$translate.signing_report}</span>
        <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    <div id="tble_list">
        <div class="option_strip clearfix" style="padding-bottom: 10px;">
            <form id="List_form" name="List_form" action="" method="post" target="_blank" >
                <div class="workreportform_left"  style="float:inherit;">
                    {$translate.year}:
                    <select name=cmb_year id=cmb_year>
                        {html_options values=$year_option_values selected=$list_year output=$year_option_values}
                    </select>

                    {$translate.month}:
                    <select name=cmb_month id=cmb_month>
                        <option value="" >{$translate.select_month}</option>
                        {html_options values=$month_option_values selected=$list_month output=$month_option_output_full}
                    </select>
                    <span style="padding-left: 15px"></span> 
                </div>
                <div class="search_types">
                    <h1>{$translate.search_with}</h1>
                    <div class="search_selected span12"  id="search_type_div" >
                        <div class="clearfix pull-left" style="padding-top: 3px;">
                            <div class="pull-left mr">{$translate.sign_type}: </div>
                            <div class="sign_type_block ml pull-left" style="margin-top: 2px;">
                                <label class="clearfix pull-left mr">
                                    <p style="float: left;margin-right: 3px;"><input type="checkbox" {if $selected_sign_with_bankID}checked="checked"{/if} id="sign_type_with_bankID" name="sign_type_with_bankID" value="1" /></p>
                                    <p style="float: left;">{$translate.with_bankid}</p>
                                </label>
                                <label class="clearfix pull-left pl">
                                    <p style="float: left;margin-right: 3px;"><input type="checkbox" {if $selected_sign_without_bankID}checked="checked"{/if} id="sign_type_without_bankID" name="sign_type_without_bankID" value="1" /></p>
                                    <p style="float: left;">{$translate.without_bankid}</p>
                                </label>
                            </div>
                        </div>
                        <div class="clearfix pull-left mr">
                            <div style="margin-left: 25px;">
                                {$translate.sign_user_level}:
                                <select name=cmb_sign_level id=cmb_sign_level>
                                    <option value="1" {if $selected_signing_user_level eq 1}selected="selected"{/if}>{$translate.employee}</option>
                                    <option value="2" {if $selected_signing_user_level eq 2}selected="selected"{/if}>{$translate.tl}</option>
                                    <option value="3" {if $selected_signing_user_level eq 3}selected="selected"{/if}>{$translate.super_tl}</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="clearfix pull-left ml">
                            <input type="button" value="{$translate.get}" onclick="getList();"/>
                            {if $request_access and $selected_signing_user_level eq 1 and $selected_sign_without_bankID and !$selected_sign_with_bankID and $report_list|count gt 0}
                                <input type="button" value="{$translate.fk_3059}" onclick="get3059(1);"/>
                                <input type="button" value="{$translate.kn_3059}" onclick="get3059(2);"/>
                                <input type="hidden" id="slot_type" name="slot_type" value=""/>
                                <input type="hidden" name="action" value="3059"/>
                            {/if}
                        </div> 
                    </div>
                </div>
            </form>
        </div>

        {if $request_access}
            <div class="pagention span12 no-ml clearfix">
                <div class="pagention_dv clearfix"><div class="pagination clearfix no-mt no-mb"><ul id="pagination">{$pagination}</ul></div></div>
            </div>
            <table class="table_list work_report no-ml table table-bordered table-responsive">
                <tbody>
                    <tr>
                        <th width="113" height="50" colspan="1" style="text-align: center;">{$translate.total_signing_count|cat:': '|cat:$total_signings_count}</th>
                        <th width="113" height="50" colspan="2" style="text-align: center;">{$translate.signing_with_bankid_count|cat:': '|cat:$signing_with_bankID_count}</th>
                        <th width="113" height="50" colspan="2" style="text-align: center;">{$translate.signing_without_bankid_count|cat:': '|cat:$signing_without_bankID_count}</th>
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
                                        {if $customer.signing_details.signin_employee neq ''}
                                            <span class="userlevel_1">
                                                <span class='pull-left pr'>{$customer.signing_details.signing_employee_name}</span>
                                                {if $customer.signing_details.employee_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_date}</span>
                                            </span>
                                        {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                    </a>
                                </td>
                                <td class="txt_align_center">
                                    <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                        {if $customer.signing_details.signin_tl neq ''}
                                            <span class="userlevel_1">
                                                <span class='pull-left pr'>{$customer.signing_details.signin_tl_name}</span>
                                                {if $customer.signing_details.tl_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_tl_date}</span>
                                            </span>
                                        {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                    </a>
                                </td>
                                <td class="txt_align_center">
                                    <a href="{$url_path}report/work/employee/detail/new/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                        {if $customer.signing_details.signin_sutl neq ''}
                                            <span class="userlevel_1">
                                                <span class='pull-left pr'>{$customer.signing_details.signin_sutl_name}</span>
                                                {if $customer.signing_details.sutl_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_sutl_date}</span>
                                            </span>
                                        {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
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
    </div>
        </div></div>
{/block}