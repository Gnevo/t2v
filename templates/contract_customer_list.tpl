{block name='script'}
<script></script>
{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.customer_contract}</span>
        <!--<a href="{$url_path}customer/add/"><img class="img_add" src="{$url_path}images/add_new.png" alt="" border="0" /></a>-->
        {if $role == 1}<a href="{$url_path}list/customer/" class="back">{$translate.backs}</a>{/if}
    </div>
    
    <div class="new_table_main">
    <div class="pagention">
        <div class="alphbts">
          
        </div>
        <div class="pagention_dv">
             {if !empty($listing)}
                    {if !empty($pagination)}
                        <div class="pagination"><ul>{$pagination}</ul></div>
                    {/if}
                {/if}
           <!-- <ul>
                <li class="pgn_lft"><img src="{$url_path}images/first.png"  /></li>
                <li class="pgn_num">2</li>
                <li class="pgn_num">3</li>
                <li class="pgn_num">4</li>
                <li class="pgn_right"><img src="{$url_path}images/last.png"  /></li>
            </ul> -->
           
        </div>
    </div>
    <table class="table_list">
        <tr>
            <th>{$translate.name}</th>
            <th>{$translate.username}</th>
           
            <th>{$translate.date_from}</th>
            <th>{$translate.date_to}</th>
            <th>{$translate.hour}</th>
            {if $role == 1}<th width="25"></th>{/if}
           
        </tr>
        {foreach from=$listing item=data}
            <tr class="{cycle values="even,odd"}">
                <td>{$data.first_name} {$data.last_name}</td>
                <td>{$data.username}</td>
                
                <td>{$data.date_from}</td>
                <td>{$data.date_to}</td>
                <td>{$data.hour}</td>
                {if $role == 1}<td><a href="{$url_path}contract/customer/add/{$contract_username}/{$data.id}/" class="settings"><img src="{$url_path}images/settings.png" border="0" alt="" width="25" title="{$translate.edit}"/></a></td>{/if}
                <!--<td><a href="#" class="contracts"><img src="{$url_path}images/contracts.png" border="0" alt="" width="25" /></a></td>-->
            </tr>
        {/foreach}
    </table>
</div>
{/block}
