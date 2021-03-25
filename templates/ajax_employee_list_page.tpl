<ul id="pagination"> 
    {if $count>1}
        {if $page >= 2 && $page != $count}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')">&lt;&lt;</a></li>
             <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}')">&lt;</a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}')">{$page-1}</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">{$page+1}</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}')">&gt;&gt;</a></li>
        {elseif $page == $count}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1')">&lt;&lt;</a></li>
             <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}')">&lt;</a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}')">{$page-1}</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}')">{$page}</a></li>
        {elseif $page == 1}
            <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">{$page+1}</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">&gt;</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}')">&gt;&gt;</a></li>
        
        {/if}
    {/if}
 </ul>