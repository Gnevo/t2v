
<ul id="pagination">
    {if $total>1}
        {if $page >= 2 && $page != $total}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','{$total}')">&lt;&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$total}')">&lt;</a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$total}')">{$page-1}</a></li>
             <li class="active"><a  href="javascript:void(0)" onclick="paginateDisplay('{$page}','{$total}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$total}')">{$page+1}</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$total}')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$total}','{$total}')">&gt;&gt;</a></li>
        {elseif $page == $total}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','{$total}')">&lt;&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$total}')">&lt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$total}')">{$page-1}</a></li>
             <li class="active"><a href="javascript:void(0)" onclick="paginateDisplay('{$page}','{$total}')">{$page}</a></li>
        {elseif $page == 1}
             <li class="active"><a  href="javascript:void(0)" onclick="paginateDisplay('{$page}','{$total}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$total}')">{$page+1}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$total}')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$total}','{$total}')">&gt;&gt;</a></li>
        
        {/if}
    {/if}
</ul>

           