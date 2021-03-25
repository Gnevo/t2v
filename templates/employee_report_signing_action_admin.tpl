{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    * html .ui-autocomplete { height: 200px; }
    .search_types { margin-top: 12px; }
    .search_selected { margin-top: 5px; }
    .customer_block, .employ_block, .selected_textfiled, .unsigned_rb_div { float: left; margin-right: 8px; }
    .padd_column { padding-left: 8px !important; }
    .txt_align_center { text-align: center; }
    .btn-del-sp { padding: 1px 7px; }
    .del-col { position: relative; }
    .del-col .btn-del-sp { position: absolute; right: 0; display: none; }
    .del-col .btn-del-sp i, .del-col .btn-del-sp i:before { cursor: pointer; }
    .del-col:hover .btn-del-sp { display: block; }
</style>
{/block}

{block name="script"}
<script type="text/javascript">
    function getList(){
        var year = $("#cmb_year").val();
        var month_selected = $("#cmb_month").val();
        var month_label = 'M-'+ month_selected;
       
        if(year == '')
            alert('{$translate.select_year}');
        else if(month_label == 'M-')
            alert('{$translate.select_month}');
        else
            window.location.href = '{$url_path}report/employee/signing/action/admin/'+year+'/'+month_label+'/-/';
        {*trailing '-' parameter for priventing default pagination*}
    }

    function warning_delete(dataSet, thisObj){
        if(confirm("{$translate.want_delete}")){
            // console.log(dataSet, thisObj);
            wrapLoader(".work_report");
            $.ajax({
                async:false,
                url:"{$url_path}report/employee/signing/action/admin/",
                data: { 'action': 'ACTION-ON-SIGNING', 'data': dataSet},
                type:"POST",
                dataType: 'json',
                success:function(data){
                    // console.log(data);

                    if(data.status !== 'undefined' && data.status == true){
                        $(thisObj).parents('.del-col').html('<span class="userlevel_2">{$translate.unsigned}</span>');
                    }
                }
            }).always(function(data) { 
                uwrapLoader(".work_report");
            });
            return true;
        }else
            return false;
    }
</script>
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="tbl_hd"><span class="titles_tab">{$translate.signing_report}</span>
            <a href="{$url_path}administration/" class="back"><span class="btn_name">{$translate.backs}</span></a>
        </div>
        <div id="tble_list">
            <div class="option_strip clearfix" style="padding-bottom: 10px;">
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
                    <span class="ml"><input type="button" value="{$translate.get}" onclick="getList();"/></span> 
                </div>
            </div>

            {if $request_access}
                <div class="pagention span12 no-ml clearfix">
                    <div class="pagention_dv clearfix"><div class="pagination clearfix no-mt no-mb"><ul id="pagination">{$pagination}</ul></div></div>
                </div>
                <table class="table_list work_report no-ml table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <th width="113" height="50" colspan="8" style="text-align: center;">{$translate.total_signing_count|cat:': '|cat:$total_signings_count}</th>
                        </tr>
                        <tr>
                            <th width="20%" height="50" rowspan="2">{$translate.employee}</th>
                            <th width="20%" height="50" rowspan="2">{$translate.customer}</th>
                            <th colspan="3">{$translate.signed_by}</th>
                            <th colspan="3">{$translate.employer_signing}</th>
                        </tr>
                        <tr>
                            <th width='10%'>{$translate.employee_wr}</th>
                            <th width='10%'>{$translate.tl_wr}</th>
                            <th width='10%'>{$translate.super_tl_wr}</th>
                            <th width='10%'>{$translate.fk}</th>
                            <th width='10%'>{$translate.kn}</th>
                            <th width='10%'>{$translate.tu}</th>
                        </tr>
                        {foreach from=$report_list item=employees}  
                            <tr class="{cycle values="even usertd,odd usertd"}">
                                {assign customers_count $employees.customers|count}
                                <td height="38" class="padd_column usertdname" rowspan="{$customers_count}"><span class="workreport_name">{$employees.employee_details.last_name} {$employees.employee_details.first_name}</span></td>

                                {foreach from=$employees.customers item=customer key=k}
                                    <td height="38" class="padd_column usertdname"><span class="workreport_name">{$customer.last_name} {$customer.first_name}</span></td>
                                    <td class="txt_align_center del-col">
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.signin_employee neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.signing_employee_name}</span>
                                                    {if $customer.signing_details.employee_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_date}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center del-col">
                                        {if $customer.signing_details.signin_tl neq ''}<button type="button" class="btn btn-default pull-left btn-del-sp" title="{$translate.delete}" onclick="warning_delete({ 'sign_type': 'EMPLOYEE', 'sign_mode': 'TL', 'year': '{$list_year}', 'month': '{$list_month}', 'employee': '{$employees.employee_details.user_name}', 'customer': '{$customer.user_name}' }, this);"><i class="icon-trash"></i></button>{/if}
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.signin_tl neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.signin_tl_name}</span>
                                                    {if $customer.signing_details.tl_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_tl_date}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center del-col">
                                        {if $customer.signing_details.signin_sutl neq ''}<button type="button" class="btn btn-default pull-left btn-del-sp" title="{$translate.delete}" onclick="warning_delete({ 'sign_type': 'EMPLOYEE', 'sign_mode': 'SUTL', 'year': '{$list_year}', 'month': '{$list_month}', 'employee': '{$employees.employee_details.user_name}', 'customer': '{$customer.user_name}' }, this);"><i class="icon-trash"></i></button>{/if}
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.signin_sutl neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.signin_sutl_name}</span>
                                                    {if $customer.signing_details.sutl_sign_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.signin_sutl_date}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>

                                    <td class="txt_align_center del-col">
                                        {if $customer.signing_details.employer_fk neq ''}<button type="button" class="btn btn-default pull-left btn-del-sp" title="{$translate.delete}" onclick="warning_delete({ 'sign_type': 'EMPLOYER', 'sign_mode': 'FK', 'year': '{$list_year}', 'month': '{$list_month}', 'employee': '{$employees.employee_details.user_name}', 'customer': '{$customer.user_name}' }, this);"><i class="icon-trash"></i></button>{/if}
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.employer_fk neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.employer_fk_name}</span>
                                                    {if $customer.signing_details.employer_sign_fk_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.employer_sign_date_fk}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center del-col">
                                        {if $customer.signing_details.employer_kn neq ''}<button type="button" class="btn btn-default pull-left btn-del-sp" title="{$translate.delete}" onclick="warning_delete({ 'sign_type': 'EMPLOYER', 'sign_mode': 'KN', 'year': '{$list_year}', 'month': '{$list_month}', 'employee': '{$employees.employee_details.user_name}', 'customer': '{$customer.user_name}' }, this);"><i class="icon-trash"></i></button>{/if}
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.employer_kn neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.employer_kn_name}</span>
                                                    {if $customer.signing_details.employer_sign_kn_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.employer_sign_date_kn}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    <td class="txt_align_center del-col">
                                        {if $customer.signing_details.employer_tu neq ''}<button type="button" class="btn btn-default pull-left btn-del-sp" title="{$translate.delete}" onclick="warning_delete({ 'sign_type': 'EMPLOYER', 'sign_mode': 'TU', 'year': '{$list_year}', 'month': '{$list_month}', 'employee': '{$employees.employee_details.user_name}', 'customer': '{$customer.user_name}' }, this);"><i class="icon-trash"></i></button>{/if}
                                        <a href="{$url_path}report/work/employee/detail/{$list_year}/{$list_month}/{$employees.employee_details.user_name}/{$customer.user_name}/">
                                            {if $customer.signing_details.employer_tu neq ''}
                                                <span class="userlevel_1">
                                                    <span class='pull-left pr'>{$customer.signing_details.employer_tu_name}</span>
                                                    {if $customer.signing_details.employer_sign_tu_with_bankID neq ''}<img class='pull-left' style="height: 18px;" src="{$url_path}images/banck_id_signing.jpg">{/if}
                                                    <span class='pull-left span12' style="color: teal;">{$customer.signing_details.employer_sign_date_tu}</span>
                                                </span>
                                            {else}<span class="userlevel_2">{$translate.unsigned}</span>{/if}
                                        </a>
                                    </td>
                                    {if $k+1 lt $customers_count}</tr><tr class="{cycle values="even usertd,odd usertd"}">{/if}
                                {foreachelse}
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                {/foreach}
                            </tr>
                        {foreachelse}
                            <tr><td colspan="8"><div class="message">{$translate.no_data_available}</div></td></tr>
                        {/foreach}
                    </tbody>
                </table>
            {/if}
        </div>
    </div>
</div>
{/block}