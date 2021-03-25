{block name="style"}
    <style type="text/css">
    a.remove{
        background: url({$url_path}images/sprite_icons/alloc_popup_icons.png) no-repeat top left;
	background-position: 0 -168px;
	width: 14px;
	height: 14px;
	height: 14px;
	width: 14px;
	display: block;
	float: left;
    }
    </style>
{/block}
{block name="script"}
<script type="text/javascript">
    $(document).ready(function() {
        {if $user_role eq 1}
            $('td a.remove').click(function(){
                $('#file_id').val($(this).parent().find('.note_lint').html());
                if($('#file_id').val() != '')
                    $('#details_form').submit();
            })
        {/if}
    });
    function delete_note(note_id) {
        if (confirm("{$translate.sure_to_delete_note_data}")) {
            document.location.href = "{$url_path}notes/detail/" + note_id + "/delete/";
        }
    }
</script>
{/block}
{block name="content"}
    <div class="tbl_hd"><span class="titles_tab">{$translate.notes_detail}</span>
{*        <a class="back" href="{$url_path}notes/list/" >{$translate.backs}</a>*}
        {if $note_delet_permission eq 'TRUE' && $back != 1}
            <a class="edit" href="{$url_path}notes/add/{$notes_detail.id}/"><span class="btn_name">{$translate.edit}</span></a>
            <a class="delete_btn" href="javascript:void(0);" onclick="delete_note({$notes_detail.id})"><span class="btn_name">{$translate.delete}</span></a>
        {/if}
{*        <a class="back" href="{$back_url}" >{$translate.backs}</a>*}
        <a class="back" {if $back == 1}href="{$url_path}customer/documentation/{$cust_note}//get/m2/"{else}href="{$url_path}notes/list/"{/if} ><span class="btn_name">{$translate.backs}</span></a>
    </div>
    {$message}
    {if $user_role eq 1}
        <form name="details_form" id="details_form" method="post">
            <input type="hidden" name="file_id" id="file_id" value="" />
        </form>
    {/if}
    <div id="tble_list">
        {if $Note_flag eq '1'}
            <div class="message">{$translate.invalid_note}</div>
        {else if $Note_flag eq '2'}
            <div class="message">{$translate.permission_denied}</div>
        {else}
        <div class="inconvenient_table">
            <table class="table_list" id="tbl1">
                <tbody>
                    <tr class="even" >
                        <td>{$translate.writer}</td><td>{$notes_detail.emp_name}</td>
                    </tr>
                    <tr class="odd">
                        <td>{$translate.customer}</td>
                        <td>{$customer_name}</td>
                    </tr>
                    <tr class="even">
                        <td>{$translate.title}</td><td>{$notes_detail.title}</td>
                    </tr>
                    <tr class="odd">	 
                        <td>{$translate.discription}</td>
                        <td>{$notes_detail.description}</td>
                    </tr>
                    <tr class="even">
                        <td>{$translate.date_written}</td>
                        <td>{$notes_detail.date}</td>
                    </tr>
                    <tr class="odd">
                        <td>{$translate.visibility}</td> 
                        <td>{if $notes_detail.visibility eq 1}{$translate.public}
                            {elseif $notes_detail.visibility eq 2}{$translate.private}
                            {elseif $notes_detail.visibility eq 3}{$translate.all}
                            {elseif $notes_detail.visibility eq 4}{$translate.admin_only}{/if}
                        </td>
                    </tr>
                    {if $user_role eq 1}
                        <tr class="even">
                                <td>{$translate.status}</td>
                                <td> {if $notes_detail.status eq 1}{$translate.active}
                                     {elseif $notes_detail.status eq 0}{$translate.forbidden}{/if}</td>
                        </tr>
                    {/if}
                    <tr class="{if $user_role eq 1}odd{else}even{/if}">
                            <td>{$translate.attachments}</td> 
                            <td>
                                {foreach from=$attachment_arr item=list_arr}
                                    <div class="single_parent">
                                        {if $user_role eq 1}
                                            <a title="{$translate.delete}" href="javascript:void(0);" class="remove"></a>
                                            &nbsp;
                                        {/if}
                                        <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href='{$url_path}notes/attachment/download/{$smarty.session.user_id}/{$list_arr|replace:"'":"\'"}/'">{$list_arr}</a>
                                    </div>
                                {foreachelse}
                                    {$translate.no_attachment}
                                {/foreach}
                                
                                {if $attachment_arr|count gt 0}<br/><br/>
                                    <a href="javascript:void()" onclick="javascript:window.location.href='{$url_path}notes/allattachment/download/{$smarty.session.user_id}/{$notes_detail.id}/'">{$translate.download_all}</a>
                                {/if}
                            </td>
                    </tr >  
                </tbody>
            </table>
        </div>
        {/if}
        <div style="clear:both"></div>
    </div>   
{/block}