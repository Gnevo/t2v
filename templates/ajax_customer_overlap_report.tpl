{block name='style'}
<style type="text/css">
.td_hour{
width: 21px;
overflow: hidden;
}
.line_border {
    background:url({$url_path}images/line_border.png);
    
}
</style>
{/block}
<table cellspacing="0" cellpadding="0" style=" clear:both;" class="table_list tbl_padding_fix mytable">
    <tbody>
        <tr>
            <td colspan="25" align="center" style="background: #a2dce8; height: 30px; font-size: 14px; font-weight: 900; color: #ffffff">{$translate.total_time_collide}{$time_collide}{$translate.hrs}</td>
        </tr>    
        <tr class="time_slot_table">
            <td align="center" style="word-wrap: normal; white-space: normal;">{$translate.name}</td> 
            <td align="right" ><div class="td_hour">01</div></td>
            <td align="right" ><div class="td_hour">02</div></td>
            <td align="right" ><div class="td_hour">03</div></td>
            <td align="right" ><div class="td_hour">04</div></td>
            <td align="right" ><div class="td_hour">05</div></td>
            <td align="right" ><div class="td_hour">06</div></td>
            <td align="right" ><div class="td_hour">07</div></td>
            <td align="right" ><div class="td_hour">08</div></td>
            <td align="right" ><div class="td_hour">09</div></td>
            <td align="right" ><div class="td_hour">10</div></td>
            <td align="right" ><div class="td_hour">11</div></td>
            <td align="right" ><div class="td_hour">12</div></td>
            <td align="right" ><div class="td_hour">13</div></td>
            <td align="right" ><div class="td_hour">14</div></td>
            <td align="right" ><div class="td_hour">15</div></td>
            <td align="right" ><div class="td_hour">16</div></td>
            <td align="right" ><div class="td_hour">17</div></td>
            <td align="right" ><div class="td_hour">18</div></td>
            <td align="right" ><div class="td_hour">19</div></td>
            <td align="right" ><div class="td_hour">20</div></td>
            <td align="right" ><div class="td_hour">21</div></td>
            <td align="right" ><div class="td_hour">22</div></td>
            <td align="right" ><div class="td_hour">23</div></td>
            <td align="right" ><div class="td_hour">24</div></td>
        </tr>
        {foreach $overlapped_slots AS $slot}
        <tr style="height:40px;">
            <td align="center" style="word-wrap: normal; white-space: normal;"><div style="width:295px; overflow: hidden;"></div>{if $sort_by_name == 1}{$slot.first_name} {$slot.last_name}{elseif $sort_by_name == 2}{$slot.last_name} {$slot.first_name}{/if}</div></td>
            <td colspan="24" class="line_border"><div style="width:756px;"><span title="{$slot.time_diff}{$translate.hrs}" style="height:20px; width:{$slot.width_popup}px; background:{$slot.color}; float:left; border:1px solid #CCC; margin-left:{$slot.margin_left_popup}px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;">&nbsp;</span></div></td>
            
        </tr>
        {/foreach}
        {*<tr style="height:40px;">
            <td align="center" style="word-wrap: normal; white-space: normal;"><div style="width:295px; overflow: hidden;"></div></td>
            <td colspan="24"><div style="width:756px;"><span title="FK" style="height:20px; width:64px;background:{$slot.color}; float:left; border:0px solid #CCC; margin-left:704px;">&nbsp;</span></div></td>
            
        </tr>*}  
            
    </tbody>
</table>