{block name="content"}

{if $listtype == 'toadd'}
    {foreach $employees as $employee}
        <div id="a{$employee.username}" class="span12 child-slots-profile">
            <span class="glyphicons icon-plus pull-right remove-child-slots cursor_hand" onclick="assignEmployee('{$employee.username}');" title="{$translate.assign_employee}"></span>
            <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/employee/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/CUST_ADD/{$customer}/',1);">{if $sort_by_name == 1}{$employee.first_name|cat: ' '|cat: $employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name|cat: ' '|cat: $employee.first_name}{/if}</span>
            <span class="pull-right">{$employee.code}</span>
            {if $employee.user_role == 1}
                <span class="slots-position pull-right">{$translate.admin}</span>
            {else if $employee.user_role == 2}
                <span class="slots-position pull-right">{$translate.team_leader}</span>
            {else if $employee.user_role == 5}
                <span class="slots-position pull-right">{$translate.trainee}</span>
            {else if $employee.user_role == 6}
                <span class="slots-position pull-right">{$translate.economy}</span>
            {else if $employee.user_role == 7}
                <span class="slots-position pull-right">{$translate.super_tl}</span>
            {else if $employee.substitute == 1}
                <span class="slots-position pull-right">{$translate.substitute}</span>
            {/if}

        </div><!--CHILD SLOT END-->
    {/foreach}
{else if $listtype == 'listed'}
    <ul>
    {foreach $employees as $employee}
        <li class="clearfix">
            <input type="checkbox" name="na{$employee.username}" id="na{$employee.username}" onclick="addToAssign('{$employee.username}')" checked="true" value="{$employee.username}" />
            {if $sort_by_name == 1}
            <div style="float: left;"><label for="name">{$employee.first_name|cat: ' '|cat: $employee.last_name}</label></div>
            {elseif $sort_by_name == 2}
            <div style="float: left;"><label for="name">{$employee.last_name|cat: ' '|cat: $employee.first_name}</label></div>
             
            {/if}<span style="margin-right: 5px;float: right">{$employee.code}</span>
            <div style="float: left;clear: left;margin-top: 5px"> 
               
            {if $employee.user_role == 1}
                ({$translate.admin})
            {else if $employee.user_role == 2}
                ({$translate.tl})
            {else if $employee.user_role == 3}
                ({$translate.employee})
            {else if $employee.user_role == 5}
                ({$translate.trainee})
            {else if $employee.user_role == 6}
                ({$translate.economy})
            {else if $employee.user_role == 7}
                ({$translate.super_tl})
            {/if}
            </div>
        </li>
    {/foreach}
    </ul>
{else if $listtype == 'toalloc'}
    <ul>
    {foreach $employees as $employee}
        <li class="clearfix">
            <input type="checkbox" name="na{$employee.username}" id="na{$employee.username}" checked="true" value="{$employee.username}" />
            {if $sort_by_name == 1}
                <div style="float: left;"><label for="name">{$employee.first_name|cat: ' '|cat: $employee.last_name}</label></div>
            {elseif $sort_by_name == 2}
                <div style="float: left;"><label for="name">{$employee.last_name|cat: ' '|cat: $employee.first_name}</label></div>
            {/if}
            
            <span style="margin-right: 5px;float: right">{$employee.code}</span>
            <div style="float: left;clear: left;margin-top: 5px"> 
                
            {if $employee.user_role == 1}
                ({$translate.admin})
            {else if $employee.user_role == 2}
                ({$translate.tl})
            {else if $employee.user_role == 3}
                ({$translate.employee})
            {else if $employee.user_role == 5}
                ({$translate.trainee})
            {else if $employee.user_role == 6}
                ({$translate.economy})
            {else if $employee.user_role == 7}
                ({$translate.super_tl})
            {/if}
            </div>
        </li>
    {/foreach}
    </ul>
{else if $listtype == 'allocated'}
    {foreach $employees as $employee}
        <div id="{$employee.username}"  class="span12 child-slots-profile-two">
            <span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand" onclick="removeEmployee('{$employee.username}');" title="{$translate.remove_employee}"></span>
            <span>
                <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/employee/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/CUST_ADD/{$customer}/',1);">{if $sort_by_name == 1}{$employee.name_ff}{elseif $sort_by_name == 2}{$employee.name}{/if}</span>
                <span class="pull-right">{$employee.code}</span>
            </span>
            {if $employee.user_role == 1}
                <span class="slots-position pull-right">{$translate.admin}</span>
            {else if $employee.user_role == 5}
                <span class="slots-position pull-right">{$translate.trainee}</span>
            {else if $employee.user_role == 6}
                <span class="slots-position pull-right">{$translate.economy}</span>
            {else if $employee.user_role == 7 && $employee.stl == 1}
                <span class="slots-position pull-right">{$translate.super_tl}</span>
            {else if $employee.substitute == 1}
                <span class="slots-position pull-right">{$translate.substitute}</span>
            {/if}

        {if $employee.tl == 1}<span class="slots-position pull-right">{$translate.team_leader}</span>{/if}
        {if $employee.user_role == 2 && $employee.tl == 0}
            <a href="javascript:void(0);" class="maketl" onclick="makeTl('{$employee.username}');">{$translate.make_team_leader}</a>
        {/if}
        {if $employee.user_role == 7 && $employee.stl == 0}
            <a href="javascript:void(0);" class="maketl" onclick="makeSTl('{$employee.username}');">{$translate.make_super_team_leader}</a>
        {/if}

    </div>
    {foreachelse}
    <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
    {/foreach}
{else}
    <ul>
    {foreach $employees as $employee}
        <li class="clearfix">
            <input type="checkbox" name="employees" id="employees" value="{$employee.username}" />
            {if $sort_by_name == 1}
                <label for="name">{$employee.first_name|cat: ' '|cat: $employee.last_name}</label>
            {elseif $sort_by_name == 2}
                <label for="name">{$employee.last_name|cat: ' '|cat: $employee.first_name}</label>
            {/if}
        </li>
    {/foreach}
    </ul>
{/if}

{/block}