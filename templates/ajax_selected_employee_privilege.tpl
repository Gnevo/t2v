{if $select_all != ""}
   <ul class="selected-previlege-list">
       {if $pre_role == 3}
        <li class="child-slots-profile-two">{$translate.all_employees}</li>
       {/if}
       {if $pre_role == 2}
        <li class="child-slots-profile-two">{$translate.all_teamleaders}</li>
       {/if}
       {if $pre_role == 7}
        <li class="child-slots-profile-two">{$translate.all_super_tl}</li>
       {/if}
    </ul> 
{else}    
    {if $cust != ""}
        <form style="margin: 0px;">
            <input type="hidden" name="selected_emp" id="selected_emp" value="{$selected}" />
        </form>
        <ul class="selected-previlege-list">
        {foreach from=$employees item=employee}
            {if $employee != ""}
                <li class="child-slots-profile-two"><a href="{$url_path}employee/privileges/{$employee.username}/">{if $sort_by_name == 1}{$employee.first_name} {$employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name} {$employee.first_name}{/if}</a></li>
            {/if}
        {foreachelse}
            {$translate.no_employee}
        {/foreach} 
        </ul>
    {else}
    <ul class="selected-previlege-list">
        {foreach from=$employees item=employee}
            {if $employee != ""}
                <li class="child-slots-profile-two"><a href="{$url_path}employee/privileges/{$employee.username}/">{if $sort_by_name == 1}{$employee.first_name} {$employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name} {$employee.first_name}{/if}</a><a href="javascript:void(0);" onclick="removeEmployee('{$employee.username}')" style="float: right; margin-left:5px;" title="{$translate.remove_employee_tooltip}"><img border="0" align="right" src="{$url_path}images/remove_pink.png" alt=""><!--remove--></a></li>
            {/if}
        {/foreach}

    </ul>
    {/if}
{/if}