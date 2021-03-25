<div class="employee_allassistans">
    {$translate.customer}
    <select name=cmb_customer id=cmb_customer class="list_detail_assistance" {if $flg eq "false"}disabled="disabled"{/if}> 
        <option value="">{$translate.all_customers}</option>
        {foreach from=$customers item=entries}
            <option value="{$entries.custID}">{$entries.custName}</option>
        {/foreach}
    </select>
</div>