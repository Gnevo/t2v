{block name='script'}
<script></script>
{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.employee_contract}</span>
        {if $role == 1}<a href="{$url_path}contract/employee/add/{$employee_username}/" class="add">{$translate.add_new}</a>{/if}
        <a href="{$url_path}list/employee/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    <div class="new_table_main">
    
    <table class="table_list">
    <div class="pagention">
        <div class="alphbts">
          
        </div>
        <div class="pagention_dv">
             {if !empty($listing)}
                    {if !empty($pagination)}
                        <div class="pagination"><ul>{$pagination}</ul></div>
                    {/if}
                {/if}
          
           
        </div>
    </div>
    
        <tr>
            <th>{$translate.user_name}</th>
            <th>{$translate.username}</th>
            <th>{$translate.date_from}</th>
            <th>{$translate.date_to}</th>
           <th>{$translate.hours}</th>
            {if $role == 1}<th width="25"></th>{/if}
            
        </tr>
        {foreach from=$listing item=data}
            <tr class="{cycle values="even,odd"}">
                <td>{$data.first_name} {$data.last_name}</td>
                <td>{$data.username}</td>
                <td>{$data.date_from}</td>
                <td>{$data.date_to}</td>
                <td>{$data.hour}</td>
                {if $role == 1}<td><a href="{$url_path}contract/employee/add/{$data.username}/{$data.id}/" class="settings"><img src="{$url_path}images/settings.png" border="0" alt="" width="25" title="{$translate.edit}"/></a></td>{/if}
                
            </tr>
        {/foreach}
    </table>
</div>
{/block}
