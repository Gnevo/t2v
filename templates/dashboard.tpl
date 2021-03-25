{block name='script'}

{/block}

{block name="content"}
    <div class="tbl_hd"><span class="titles_tab">{$translate.company}</span>
    <a href="{$url_path}company/add/" class="add">{$translate.create_new}</a>
    </div>
       
    <div id="tble_list">
    
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

    <table class="table_list">
        <tr>
            <th>{$translate.logo}</th>
            <th>{$translate.name}</th>
            <th>{$translate.database}</th>
            <th>{$translate.language}</th>
            <th>{$translate.address}</th>
            <th>{$translate.phone}</th>
            <th></th>
            <th></th>
        </tr>
        {foreach from=$companies item=company}
            <tr class="{cycle values="even,odd"}">
                <td><img height="60px" width="250px" src="{$url_path}company_logo/{if $company.logo}{$company.logo}{else}defalt.png{/if}" alt="{$company.name}"/></td>
                <td>{$company.name}</td>
                <td>{$company.db_name}</td>
                <td>{$company.language}</td>
                <td>{$company.address|cat: '<br/>'|cat: $company.city}</td>
                <td>{$company.phone|cat: '<br/>'|cat: $company.mobile}</td>
                 <td><a href="{$url_path}dashboard/{$company.id}/" class="settings"><img src="{$url_path}images/settings.png" border="0" title="{$translate.edit}" width="25" /></a></td>
                 <td><a href="{$url_path}company/add/{$company.id}/" class="contracts"><img src="{$url_path}images/contracts.png" border="0" title="{$translate.contract}" width="25" /></a></td>
            </tr>
       {foreachelse}
           <tr>
               <td colspan="7"><div class="message">{$translate.no_data_available}</div></td>
           </tr>
       {/foreach}
    </table></div>

{/block}