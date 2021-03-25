{block name='content'}
<div class="select_skill_scrollers">
    <div class="select_skilltitle" style="padding-left: 3px;margin-bottom: 5px;text-align: left;">{$translate.employee|cat:': '|cat:$lEmployeeName}
        <div style="padding-right: 3px">{$translate.date|cat:': '|cat:$lDate}</div>
    </div>
    <form id="leave_slot_edit" name="leave_slot_edit" method="post" action="" style="margin-left: 3px;margin-bottom: 3px;">

        {$translate.unsick_from} : 
        <input type="text" name="edit_from" id="edit_from"  style="width: 80px;" value="{$lTto}" />
        <input type="hidden" name="lId" id="lId"  value="{$lId}" />
    </form>
</div>
{/block}