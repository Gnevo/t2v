<script>
$(document).ready(function(){
    $( "#search_cust" ).autocomplete({
        source: {$json_customers},
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#temp_search_cust").val(this.value);
             paginateDisplay('1');
    }
    });
});
</script>

<table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
    <!-- Table heading -->
    <thead>
        <tr>
            <th>{$translate.name}</th>
            <th><a href="javascript:void(0);" onclick="sortBy('CC');" style="text-decoration: underline" title="{$translate.sort_by_code}">{$translate.code}</a></th>
            <th>{$translate.social_security}</th>
            <th>{$translate.username}</th>
            <th>{$translate.mobile}</th>
            <th>{$translate.city}</th>
            {if $action == 'inact'}
                <th>{$translate.inactive_date}</th>
            {/if}
            <th class="table-col-center small-col"></th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$customer_list item=customer}
            <tr class="gradeX" onclick="edit_btn('{$customer.username}')" style="cursor: pointer;">
                <td class="large-col">
                    {if $customer.ch == 1 && !empty($customer.company)}
                        {$customer.company.name}
                    {else}
                        {if $sort_by_name == 1}
                            {$customer.first_name} {$customer.last_name}
                        {elseif $sort_by_name == 2}
                            {$customer.last_name} {$customer.first_name}
                        {/if}
                    {/if}</td>
                <td>{$customer.code}</td>
                <td>{$customer.social_security}</td>
                <td>{$customer.username}</td>
                <td>{if $customer.mobile == ""}----{else}{$customer.mobile}{/if} </td>
                <td>{$customer.city}</td>
                {if $action == 'inact'}
                    <td>{$customer.date_inactive}</td>
                {/if}
                <td class="table-col-center small-col"><button type="button" onclick="edit_btn('{$customer.username}')" class="btn btn-default" title="{$translate.edit}"><span class="icon-wrench"></span></button></td>
            </tr>
        {foreachelse}
            <tr><td colspan="7">
                    <div class="message">{$translate.no_data_available}</div>
                </td></tr>
            {/foreach}
    </tbody>
</table>