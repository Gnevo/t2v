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
        function delete_category(cat_id) {
            if (confirm("{$translate.sure_to_delete_category_data}")) {
                $('#cat_id').val(cat_id);
                $("#ticket_category_form").attr("action", "{$url_path}tickets/category/list/delete/");
                $("#ticket_category_form").submit();
            }
        }
    </script>
{/block}

{block name="content"}
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.ticket_categories}</span>
        <a class="add" href="{$url_path}tickets/category/add/" title="{$translate.add_new_ticket_category}">{$translate.add_new}</a>
        <a class="back" href="{$url_path}tickets/list/" >{$translate.backs}</a>
    </div>
    {$message}
    <div id="tble_list">
        <div class="pagention">

        </div>
        <div class="inconvenient_table">
            <form name="ticket_category_form" id="ticket_category_form" method="post">
                <input type="hidden" id="cat_id" name="cat_id" value="">
                <table class="table_list" id="tbl1">
                    <tbody>
                        <tr>
                            <th width="50">{$translate.ticket_category_order}</th>
                            <th>{$translate.ticket_category_type}</th>
                            <th>{$translate.ticket_category_name}</th>
                            <th width="50">{$translate.edit}</th>
                            <th width="50">{$translate.delete}</th>
                        </tr>
                        {foreach from=$categories_list item=list}
                            <tr class="{cycle values="even,odd"}" id="status_{$list.id}">
                                <td>{$list.order}</td>
                                <td>{$list.type}</td>
                                <td>{$list.name}</td>
                                {if $loggedin_user ne 'gine001' && $list.type eq 'External'}
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                {else}
                                    <td><a href="{$url_path}tickets/category/add/{$list.id}/" class="settings"><img src="{$url_path}images/btn_edit.gif" border="0" title="{$translate.edit}" /></a></td>
                                    <td><a href="javascript:void(0)" class="settings" onclick="delete_category({$list.id})"><img src="{$url_path}images/btn_delete.png" border="0" title="{$translate.delete}" /></a></td>
                                {/if}
                            </tr>
                        {foreachelse}
                            <tr><td colspan="5"><div class="message">{$translate.no_data_available}</div></td></tr>
                                {/foreach}
                    </tbody>
                </table>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
{/block}