<ul id="pagination"> 
    {if $count>1}
        {if $page >= 2 && $page != $count}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','{$method}')"><img src="{$url_path}images/first.png"  /></a></li>
                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$method}')"><img src="{$url_path}images/prev.png"  /></a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$method}')">{$page-1}</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}','{$method}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$method}')">{$page+1}</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$method}')"><img src="{$url_path}images/nxt.png"  /></a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}','{$method}')"><img src="{$url_path}images/last.png"  /></a></li>
        {elseif $page == $count}
             <li><a href="javascript:void(0)" onclick="paginateDisplay('1','{$method}')"><img src="{$url_path}images/first.png"  /></a></li>
                <li><a class="prev" href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$method}')"><img src="{$url_path}images/prev.png"  /></a></li>
             <li><a  href="javascript:void(0)" onclick="paginateDisplay('{$page-1}','{$method}')">{$page-1}</a></li>
             <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}')">{$page}</a></li>
        {elseif $page == 1}
            <li><a  class="selected" href="javascript:void(0)" onclick="paginateDisplay('{$page}','{$method}')">{$page}</a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$method}')">{$page+1}</a></li>
             <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}','{$method}')"><img src="{$url_path}images/nxt.png"  /></a></li>
             <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}','{$method}')"><img src="{$url_path}images/last.png"  /></a></li>
        {/if}
    {/if}
 </ul>