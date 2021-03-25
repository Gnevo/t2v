{block name="style"}
<style>
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
}
* html .ui-autocomplete {
    height: 200px;
}
</style>
{/block}

{block name="script"}
<script type="text/javascript">
    

function select_employee(alpha){
    var year = $("#cmb_year").val();
    var customer_id = $("#customer-id").val();
//    alert(year);
//   window.location.href = '{$url_path}report/work/employee/list/'+name+'/';
    {if $search_customer_id == ""}
        window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+alpha+'/';
    {else}
        window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+customer_id+'/'+alpha+'/';
    {/if}
}
    
//function reload(year){
//    window.location.href = '{$url_path}report/work/employee/list/'+year+'/1/';
//}

function getListWithCustUname(){
    var year = $("#cmb_year").val();
    var customer_id = $("#customer-id").val();
    var customer_name = $("#txt_customer").val();
    if(customer_name != "" && customer_id != "" && typeof(customer_id) != 'undefined')
        window.location.href = '{$url_path}report/work/employee/list/'+year+'/'+customer_id+'/';
    else
        window.location.href = '{$url_path}report/work/employee/list/'+year+'/1/';
}

function form_submit(){
    $("#sign_form").submit();
}

{if $user_role != 4}
$(function() {
        var availableTags = [
            {foreach from=$customers item=customer}  
                    {
                    value: "{$customer.username}",
                    label: "{$customer.last_name} {$customer.first_name}"
                    },
            {/foreach}
                
                
        ];
        $( "#txt_customer" ).autocomplete({
            minLength: 0,
            source: availableTags,
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
//        $( "#txt_customer" ).autocomplete({
//            source: availableTags
//        });
    });
{/if}
</script>
{/block}
{block name="content"}

<div class="tbl_hd"><span class="titles_tab">{$translate.time_reporting}</span>
    <a href="{$url_path}reports/" class="back"><span class="btn_name">{$translate.backs}</span></a>
</div>

    <div id="tble_list"> 
 
    <div class="option_strip">
        <form id="List_form" name="List_form" action="" method="post">
            <div class="workreportform_left">
                {$translate.year}:
                <!--<select name=cmb_year id=cmb_year onchange="reload(this.value);">-->
                <select name=cmb_year id=cmb_year>
                    {html_options values=$year_option_values selected=$list_year output=$year_option_values}
                </select>
                <!--input type="submit" value="{$translate.show}" /-->
                <span style="padding-left: 15px">
                    {if $user_role != 4}
                        {$translate.select_customer}: 
            <!--            <select name=cmb_employees id=cmb_employees onchange="">
                            {foreach from=$full_employee_list item=employees}  
                                <option>{$employees.last_name}, {$employees.first_name}</option>
                            {/foreach}
                        </select>-->
                        <input type="text" id="txt_customer" name="txt_customer" value="{$search_customer_name}"/>
                        <input type="hidden" id="customer-id" value="{$search_customer_id}"/>
                    {/if}
                    <input type="button" value="{$translate.get}" onclick="getListWithCustUname();"/>
                </span>
            </div>
        </form>  
        
    </div>

    <div class="pagention">
        {assign var='alphabets' value=','|explode:$translate.alphabets}
        <div class="alphbts">
            <ul>
                {foreach from=$alphabets item=row}
                    <li><a href="javascript:void(0)" onclick="select_employee('{$row}')">{$row}</a></li>
                {/foreach}
            </ul>


        </div>
        <div class="pagention_dv"><div class="pagination"><ul id="pagination">{$pagination}</ul></div>

        </div>
    </div>

    <table width="861" class="table_list work_report">
        <tbody><tr>
                <th width="113" height="50">{$translate.employee}</th>
                {foreach from=$month_option_output item=title_months}
                    <th width="55">{$title_months}</th> 
                {/foreach}
            </tr>
            {foreach from=$signing_details item=full_entry_list}  
                <tr class="{cycle values="even usertd,odd usertd"}">
                    <td height="38" class="usertdname"><span class="workreport_name">{$full_entry_list.last_name}, {$full_entry_list.first_name}</span></td>

                    {foreach from=$full_entry_list.Sign_details item=signing_month key=m}
                        
                        {if $list_year < $now_year ||( $m <= $now_month && $list_year == $now_year)}
                            
                            <td>
                                {if $full_entry_list.have_work.$m eq 1}
<!--                                    <form id="sign_form" name="sign_form" method="post" action="{$url_path}report/work/employee/detail/">-->
                                    <a href="{$url_path}test/test1/test2/test3/{$list_year}/{$m}/{$full_entry_list.username}/">
<!--                                    <a href="javascript:void(0)" onclick="form_submit()">
                                        <input type="hidden" id="sel_year" name="sel_year" value="{$list_year}"/>
                                        <input type="hidden" id="sel_month" name="sel_month" value="{$m}"/>
                                        <input type="hidden" id="sel_emp" name="sel_emp" value="{$full_entry_list.username}"/>-->
                                        
                                        {if $signing_month.signin_employee neq ''}
                                            <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_employee_name} {$translate.on} {$signing_month.signin_date}">{$signing_month.signin_employee}{*$translate.signed*}</span>
                                        {else}
                                            <span class="userlevel_2">{$translate.unsigned}</span>
                                        {/if}
                                        {if $signing_month.signin_tl neq ''}
                                            <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_tl_name} {$translate.on} {$signing_month.signin_tl_date}">{$signing_month.signin_tl}{*$translate.signed*}</span>
                                        {else}
                                            <span class="userlevel_2">{$translate.unsigned}</span>
                                        {/if}
                                        {if $signing_month.signin_sutl neq ''}
                                            <span class="userlevel_1" title="{$translate.signed_by} {$signing_month.signin_sutl_name} {$translate.on} {$signing_month.signin_sutl_date}">{$signing_month.signin_sutl}{*$translate.signed*}</span>
                                        {else}
                                            <span class="userlevel_2">{$translate.unsigned}</span>
                                        {/if}
                                    </a>
<!--                                    </form>-->
                                {else}
                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;">{$translate.no_work}</span>
                                {/if}
                            </td>
                        {else}
                            <td>
                                {if $full_entry_list.have_work.$m eq 1}
                                    <a href="{$url_path}test/test1/test2/test3/{$list_year}/{$m}/{$full_entry_list.username}/">
                                    <span class="userlevel_1">- - - - </span>
                                    <span class="userlevel_2">- - - - -  </span>
                                    <span class="userlevel_3">- - - - - - </span>
                                    </a>
                                {else}
                                    <span style="color: red; display: block; font-size: 10px; padding: 5px 10px; text-decoration: none;">{$translate.no_work}</span>
                                {/if}
                            </td>
                        {/if}
                        
                    {foreachelse}
                        <td></td>
                    {/foreach}
                        
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
