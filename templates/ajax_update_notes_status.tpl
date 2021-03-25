<!--<td>{if $status eq 1}{$translate.active}{elseif $status eq 0}{$translate.forbidden}{/if}</td>-->
{if $status eq 1}
    <td  class="table-col-center center" style="width:15px;">
        <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(0,{$id})">
            <img width="20" height="20" border="0" title="{$translate.set_as_forbidden}" alt="" src="{$url_path}images/cirrus_icon_reject.png">
        </a>
    </td>
{*    <td><a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(0,{$id})"><img width="20" height="20" border="0" title="{$translate.set_as_forbidden}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a></td>               *}
{elseif $status eq 0}
    <td  class="table-col-center center" style="width:15px;">
        <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$id})">
            <img width="20" border="0" title="{$translate.set_as_active}" alt="" src="{$url_path}images/icon_approve.png">
        </a>
    </td>
{*    <td><a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$id})"><img width="20" border="0" title="{$translate.set_as_active}" alt="" src="{$url_path}images/icon_approve.png"></a></td>*}
{/if}