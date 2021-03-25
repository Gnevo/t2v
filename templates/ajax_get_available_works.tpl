 <ul>{foreach from=$available_works item=row}
                        <li id="a{$row.id}">{$row.name}  <a href="javascript:void(0);" onclick="change_avail('{$row.id}','{$row.name}');"><img src="{$url_path}images/add_green.png" border="0" alt="" align="right"/></a></li>
                        {foreachelse} <div id="no_data" class="message" >{$translate.no_data_available}</div>{/foreach}</ul>