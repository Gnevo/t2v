 <ul>{foreach from=$available_team item=row}
       <a href="javascript:void(0)" onclick="select_team('{$row.id}','{$row.name}','{$row.tl}');" ><li id="a{$row.id}">{$row.name} ( {$row.tl} )</li></a>
        {/foreach}       
    </ul>