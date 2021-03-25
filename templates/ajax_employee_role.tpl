{block name="content"}
<div class="content_inner">
    <table width="562" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
        {foreach from=$customers item=customer}
            <tr class="{cycle values="em_table_inner,em_table_inner_white"}"><td class="border">{$customer.name}</td></tr>
        {foreachelse}
           <tr><td> <div class="message">{$translate.no_data_available}</div></td></tr>
        {/foreach}
   
    </table>
</div>
{/block}