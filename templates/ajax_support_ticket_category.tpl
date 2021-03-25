<span class="add-on icon-pencil"></span>
<select name="sprt_category" id="sprt_category" class="span10 form-control">
    {if $selected_category eq '0'}
        <option value="">{$translate.select_ticket_category}</option>
    {/if}
    {html_options options=$support_categories selected=$selected_category}
</select>