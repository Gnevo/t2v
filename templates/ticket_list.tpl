{block name='style'}
    <style type="text/css" >
        .search_text{
            height: 16px;
            margin-right: 5px;
            width: 180px;
        }
    </style>
{/block}

{block name="script"}
    <script type="text/javascript">
        function get_report() {
            var status = $('#sprt_status').val();
            var priority = $('#sprt_priority').val();
            var category = $('#sprt_category').val();
            var ticket_type = $('#sprt_ticket_type').val();
            var search_key = $('#sprt_search_key').val();
            {if in_array($loggedin_user, $cirrus_admins)}
                var admin_search = $('#sprt_company').val();
            {elseif $user_role eq 1}
                var admin_search = $('#sprt_admin_user').val();
            {else}
                var admin_search = '';
            {/if}
            if (status == '')
                status = 'NULL';
            if (priority == '')
                priority = 'NULL';
            if (category == '')
                category = 'NULL';
            if (ticket_type == '')
                ticket_type = 'NULL';
            if (search_key == '')
                search_key = 'NULL';
            if (admin_search == '')
                admin_search = 'NULL';
            window.location.href = '{$url_path}tickets/list/' + status + '/' + priority + '/' + category + '/' + ticket_type + '/' + admin_search + '/' + search_key + '/';
        }
    </script>
{/block}

{block name="content"}
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.tickets}</span>
        <a class="add" href="{$url_path}tickets/add/" title="{$translate.add_new_ticket}">{$translate.add_new}</a>
        {if in_array($loggedin_user, $cirrus_admins)}<a class="mails_settings" href="{$url_path}tickets/mails/" >{$translate.ticket_mails}</a>{/if}
        {if $user_role eq 1}<a class="ticket_category" href="{$url_path}tickets/category/list/" >{$translate.ticket_category}</a>{/if}
        <a class="back" href="{$url_path}message/center/" >{$translate.backs}</a>
    </div>
    {$message}
    <div id="tble_list">
        <form name="ticket_form" id="ticket_form" method="post">
            <div class="pagention">
                <div class="alphbts" style="width: 100%;">
                    <table style="width: 100%;" cellpadding="2" cellspacing="2">
                        <tr>
                            <td>
                                {$translate.ticket_status}:
                                <select name="sprt_status" id="sprt_status">
                                    <option value="">{$translate.all}</option>
                                    {html_options options=$support_status selected=$selected_status}
                                </select>
                            </td>
                            <td>
                                {$translate.ticket_priority}:
                                <select name="sprt_priority" id="sprt_priority">
                                    <option value="">{$translate.all}</option>
                                    {html_options options=$support_priority selected=$selected_priority}
                                </select>
                            </td>
                            <td>
                                {$translate.ticket_type}:
                                <select name="sprt_ticket_type" id="sprt_ticket_type">
                                    <option value="">{$translate.all}</option>
                                    {html_options options=$support_ticket_type selected=$selected_ticket_type}
                                </select>
                            </td>
                            <td>
                                {if in_array($loggedin_user, $cirrus_admins)}
                                    {$translate.company}:
                                    <select name="sprt_company" id="sprt_company">
                                        <option value="">{$translate.all}</option>
                                        {html_options options=$companies selected=$selected_company}
                                    </select>
                                {elseif $user_role eq 1}
                                    {$translate.ticket_admin}:
                                    <select name="sprt_admin_user" id="sprt_admin_user">
                                        <option value="">{$translate.all}</option>
                                        {html_options options=$support_admin_users selected=$selected_admin_user}
                                    </select>
                                {/if}
                            </td>
                            <td><strong>{$translate.total_records} : {$total_records}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="pagention" style="border-radius:0;">
                <div class="alphbts">
                    <table style="width: 600px;" cellpadding="2" cellspacing="2">
                        <tr>
                            <td>
                                {$translate.ticket_category}:
                                <select name="sprt_category" id="sprt_category">
                                    <option value="ALL">{$translate.all}</option>
                                    {html_options options=$support_categories selected=$selected_category}
                                </select>
                            </td>
                            <td>
                                {$translate.ticket_search_key}:
                                <input type="text" name="sprt_search_key" id="sprt_search_key" class="search_text" value="{$selected_search_key}" maxlength="100" placeholder="{$translate.ticket_search_word}" />
                            </td>
                            <td>
                                <input type="button" name="go" id="go" value="{$translate.show}" onclick="get_report();" />
                            </td>
                            <td width="15%"></td>
                        </tr>
                    </table>
                </div>
                <div class="pagention_dv">
                    <div class="pagination"><ul>{$pagination}</ul></div>
                </div>
            </div>
        </form>
        <div class="inconvenient_table">
            <table class="table_list" id="tbl1">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>{$translate.ticket_date}</th>
                        {if in_array($loggedin_user, $cirrus_admins)}<th>{$translate.company}</th>{/if}
                        <th>{$translate.ticket_type}</th>
                        <th>{$translate.ticket_priority}</th>
                        {if $user_role eq 1 || in_array($loggedin_user, $cirrus_admins)}<th>{$translate.ticket_created_user}</th>{/if}
                        <th>{$translate.ticket_category}</th>
                        <th>{$translate.ticket_title}</th>
                        <th>{$translate.ticket_status}</th>
                        <th>{$translate.view}</th>
                    </tr>
                    {foreach from=$tickets_list item=list}
                        {assign var = cat_type value = 'I'}
                        {if $list.category_type eq 'External'}
                            {assign var = cat_type value = 'C'}
                        {/if}
                        <tr class="{cycle values="even,odd"}" id="status_{$list.id}" {if $list.status eq 1} style="font-weight: bold" {/if}>
                            <td>{$list.id}</td>
                            <td>{$list.date|date_format:"%Y-%m-%d %H:%M"}</td>
                            {if in_array($loggedin_user, $cirrus_admins)}<td>{$list.company}</td>{/if}
                            <td>{$support_ticket_type[$list.ticket_type]}</td>
                            <td>{$support_priority[$list.priority]}</td>
                            {if $user_role eq 1 || in_array($loggedin_user, $cirrus_admins)}<td>{$list.created_user}</td>{/if}
                            <td>{$cat_type|cat:'/'|cat:$list.category}</td>
                            <td>{$list.title}</td>
                            <td>{$support_status[$list.status]}</td>
                            <td><a href="{$url_path}tickets/detail/{$list.id}/{if in_array($loggedin_user, $cirrus_admins)}{$list.company_id}/{/if}" class="settings"><img src="{$url_path}images/icon_search.png" border="0" title="{$translate.view}" width="25" /></a></td>
                        </tr>
                    {foreachelse}
                        <tr><td {if $user_role eq 1}colspan=9{else}colspan=8{/if}><div class="message">{$translate.no_data_available}</div></td></tr>
                            {/foreach}
                </tbody>
            </table>
        </div>
        <div style="clear:both"></div>
    </div>
{/block}