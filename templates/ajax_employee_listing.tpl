<script>
    $(document).ready(function() {
        $( "#search_emp" ).autocomplete({
                source: {$json_employees},
                select: function( event, ui ) {
                     this.value = ui.item.value;
                     $("#temp_search_emp").val(this.value);
                     paginateDisplay('1');
                }
        });
    });
</script>
<table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda recruitment-table" id="header-fixed">
   <thead>
        <tr>
            <th><a href="javascript:void(0);" onclick="sortBy('n')" style="text-decoration: underline" title="{$translate.sort_by_name}">{$translate.name}</a></th>
            <th><a href="javascript:void(0);" onclick="sortBy('ec')" style="text-decoration: underline" title="{$translate.sort_by_code}">{$translate.code}</a></th>
            <th>{$translate.social_security}</th>
            <th>{$translate.signature}</th>
            <th>
            {if $action == 'act'}
            <a href="javascript:void(0);" onclick="sortBy('lg')" style="text-decoration: underline" title="{$translate.sort_by_login}">{$translate.loggedin} ({$count_log})</a>
            {else if}
            {$translate.inactive_date}
            {/if}
            </th>
            <th><a href="javascript:void(0);" onclick="sortBy('r')" style="text-decoration: underline" title="{$translate.sort_by_role}">{$translate.role}</a></th>
            <th><a href="javascript:void(0);" onclick="sortBy('el')" style="text-decoration: underline" title="{$translate.sort_by_error_login}">{$translate.error_login}</a></th>
            <th>{$translate.mobile}</th>
            <th class="table-col-center small-col"></th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$employee_list item=employee}
            <tr class="gradeX" onclick="document.location = '{$url_path}employee/add/{$employee.username}/';" style="cursor: pointer;">
                {if $sort_by_name == 1}
                    <td class="large-col">{$employee.first_name} {$employee.last_name}</td> 
                {elseif $sort_by_name == 2}
                    <td class="large-col">{$employee.last_name} {$employee.first_name}</td>
                {/if}
                <td>{$employee.code}</td>
                <td>{$employee.social_security}</td>
                <td>{$employee.username}</td>
                <td>
                {if $action == 'act'}
                    {if $employee.login == 1}{$translate.yes}{/if}
                {else if $action == 'inact'}
                    {$employee.date_inactive}
                {/if}
                </td>
                <td>{if $employee.role == 1}{$translate.admin}{elseif $employee.role == 2}{$translate.tl}{elseif $employee.role == 3}{$translate.employee}{elseif $employee.role == 5}{$translate.trainee}{elseif $employee.role == 6}{$translate.economy}{elseif $employee.role == 7}{$translate.super_tl}{/if}</td>
                <td>{$employee.error_login}</td>
                <td>{$employee.mobile}</td>
                <td class="table-col-center small-col"><a href="{$url_path}employee/add/{$employee.username}/" class="btn btn-default"><i class="icon-wrench"></i></a></td>
            </tr>
        {foreachelse}
            <tr><td colspan="8">
                    <div class="message">{$translate.no_data_available}</div>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>