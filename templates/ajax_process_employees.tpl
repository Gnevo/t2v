{if $type == 'rep'}
    {foreach $employee_details as $employee_detail}

        <input type="radio" class = "rep_radio" name="employees" value = "{$employee_detail.username}" onclick="loadEmployee()">{$employee_detail.first_name|cat:' '|cat:$employee_detail.last_name}<br />
    {/foreach}
{else}
    
    {*<div style="float:left; height:170px; width:200px; overflow: scroll" id="copy_list">*}
        {if count($employee_details)>0}
            <input type="checkbox" {if $type == ''}name="all_check"  id="all_check"{elseif $type == 'del'}name="all_check1"  id="all_check1"{elseif $type == 'atl'}name="all_check2"  id="all_check2"{/if}  {if $type == ''}onclick="empCheckAll()"{elseif $type == 'del'}onclick="empCheckAll1()"{elseif $type == 'atl'}onclick="empCheckAll2()"{/if}><span style="font-weight:bold; margin: 0 0 0 10px;">{$translate.check_all}</span><br />
        {/if}
        {foreach $employee_details as $employee_detail}
            
            <input type="checkbox" {if $type == ''}class="emp_check"{elseif $type == 'del'}class="emp_check1"{elseif $type == 'atl'}class="emp_check2"{/if} name="employees" value = {$employee_detail.username}><span style="margin: 0 0 0 10px;">{$employee_detail.first_name|cat:' '|cat:$employee_detail.last_name}</span><br />
   
        {/foreach}      
{*    </div>*}
{/if}