{block name="script"}
    <script type="text/javascript">

        $(document).ready(function () {
            $("#ticket_form").validate({
                rules: {
                    answer: { required: true },
                    sprt_category: { required: true }
                },
                messages: {
                    answer: "*",
                    sprt_category: "*"
                }
            });
        {assign var = category_type value = 1}
        {assign var = cat_type value='I'}
        {if $ticket.last_category_type eq 'External'}
            {assign var = category_type value = 2}
            {assign var = cat_type value='C'}
        {/if}
            $('#support_category_div').load("{$url_path}ajax_ticket_category.php?cat_type={$category_type}&category_id={$ticket.last_category_id}");
                    $('.cat_type').click(function () {
                        var cat_type = $(this).val();
                        var category_id = '{$ticket.last_category_id}';
                        var company_id ='{$company_id}';
                        if (cat_type == 2) {
                            $('#answer_admin').hide();
                            $('#answer_ticket_type').show();
                        } else {
                            $('#answer_admin').show();
                            $('#answer_ticket_type').hide();
                        }
                        $('#support_category_div').html("<img src='{$url_path}images/ajax-loader_fb.gif'>");
                        if(category_id != '') {
                            $('#support_category_div').load("{$url_path}ajax_ticket_category.php?cat_type=" + cat_type + "&category_id=" + category_id + "&company_id=" + company_id);
                        } else {
                            $('#support_category_div').load("{$url_path}ajax_ticket_category.php?cat_type=" + cat_type + "&company_id=" + company_id);
                        }
                    });

        {if in_array($loggedin_user, $cirrus_admins)}
                    $('#answer_ticket_category').show();
                    $('#answer_priority').show();
                    $('#answer_ticket_type').hide();
                    $('#answer_is_hidden').show();
                    $('#answer_admin').hide();
            {if $ticket.last_category_type eq 'External'}
                    $('#answer_ticket_type').show();
            {elseif $ticket.last_category_type eq 'Internal'}
                    $('#answer_admin').show();
            {/if}
        {elseif $loggedin_user eq $ticket.created_user && $user_role eq 1}
                    $('#answer_ticket_category').hide();
                    $('#answer_priority').show();
                    $('#answer_ticket_type').hide();
                    $('#answer_admin').hide();
            {if $ticket.last_category_type eq 'Internal'}
                    $('#answer_admin').show();
            {/if}
        {elseif $loggedin_user eq $ticket.created_user}
                    $('#answer_ticket_category').hide();
                    $('#answer_priority').hide();
                    $('#answer_ticket_type').hide();
                    $('#answer_admin').hide();
        {elseif $user_role eq 1}
                    $('#answer_ticket_category').hide();
                    $('#answer_priority').show();
                    $('#answer_ticket_type').hide();
                    $('#answer_admin').hide();
            {if $ticket.last_category_type eq 'Internal'}
                    $('#answer_admin').show();
            {/if}
        {/if}
        {if $ticket.status ge $support_closed_status}
                    $('#answer_ticket_category').hide();
                    $('#answer_priority').hide();
                    $('#answer_ticket_type').hide();
                    $('#answer_admin').hide();
        {/if}
                });
                function submit_form() {
                    $("#ticket_form").submit();
                }

                function validate() {
                    $("#err_msg").html("");
                    return true;
                }
    </script>

{/block}
{block name="content"}
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.tickets}</span>
        <a class="back" href="{$url_path}tickets/list/"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    {$message}
    <div id="tble_list">
        <form name="ticket_form" id="ticket_form" method="post" onsubmit="return validate()" enctype="multipart/form-data" >
            <div class="inconvenient_table">
                <table class="table_list" id="tbl1">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: left;">{$translate.ticket}#{$ticket.id}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {if in_array($loggedin_user, $cirrus_admins)}
                            <tr class="odd">
                                <td width="30%">{$translate.company}</td>
                                <td>{$ticket.company}</td>
                            </tr>
                        {/if}
                        {if $user_role eq 1}
                            <tr class="even">
                                <td width="30%">{$translate.ticket_created_user}</td>
                                <td>
                            {if !$ticket.created_user_data}{$ticket.created_user}{else}{$ticket.created_user_data.first_name|cat:" "|cat:$ticket.created_user_data.last_name}{/if}</td>
                    </tr>
                {/if}
                {if isset($ticket.status)}
                    <tr class="odd">
                        <td width="30%">{$translate.ticket_status}</td>
                        <td>{$support_status[$ticket.status]}</td>
                    </tr>
                {/if}
                {if $ticket.category_type eq 'External'}
                    <tr class="even">
                        <td>{$translate.ticket_type}</td>
                        <td>{$support_ticket_type[$ticket.ticket_type]}</td>
                    </tr>
                {/if}
                {if isset($ticket.category)}
                    <tr class="even">
                        <td>{$translate.ticket_category}</td>
                        <td>{$ticket.category}</td>
                    </tr>
                {/if}
                {if $ticket.priority}
                    <tr class="odd">
                        <td>{$translate.ticket_priority}</td>
                        <td>{$support_priority[$ticket.priority]}</td>
                    </tr>
                {/if}
                {if isset($ticket.admin_user)}
                    <tr class="even">
                        <td>{$translate.ticket_admin}</td>
                        <td>{if $ticket.admin_username eq ''}{$ticket.admin_user}{else}{$ticket.admin_username}{/if}</td>
                    </tr>
                {/if}
                {if $ticket.category_type ne 'External'}
                    {if isset($ticket.affected_user)}
                        <tr class="odd">
                            <td>{$translate.affected_user}</td>
                            <td>{$ticket.affected_user_data.first_name|cat: ' '|cat: $ticket.affected_user_data.last_name}</td>
                        </tr>
                    {/if}
                    {if isset($ticket.affected_user_phone)}
                        <tr class="even">
                            <td>{$translate.affected_user_phone}</td>
                            <td>{$ticket.affected_user_phone}</td>
                        </tr>
                    {/if}
                {/if}
                <tr class="odd">
                    <td>{$translate.ticket_title}</td>
                    <td>{$ticket.title}</td>
                </tr>
                <tr class="even">	 
                    <td>{$translate.ticket_discription}</td>
                    <td>{$ticket.description|nl2br}</td>
                </tr>
                <tr class="odd">
                    <td>{$translate.ticket_attachment}</td> 
                    <td>
                        {if $ticket.attachment}
                            <div class="single_parent">
                                <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}tickets/attachment/download/{$smarty.session.user_id}/{$ticket.attachment|replace:"'":"\'"}/'">{$ticket.attachment}</a>
                            </div>
                        {else}
                            {$translate.no_attachment}
                        {/if}
                    </td>
                </tr >
                <tr class="even">
                    <td>{$translate.ticket_date}</td>
                    <td>{$ticket.date|date_format:"%Y-%m-%d %H:%M"}</td>
                </tr>
            </tbody>
        </table>
        <table class="table_list" id="tbl1">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: left;" class="scrol_down_image_pointer">{$translate.replay_for_ticket}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even" id="answer_ticket_category">
                    <td>{$translate.ticket_category}{$ticket.category_type}</td>
                    <td>
                        <div style="width: 100%; float: left;">
                            <input type="radio" name="cat_type" id="cat_type" class="cat_type" value="1" {if $ticket.last_category_type eq 'Internal'}checked="true"{/if} />
                            <label>{$translate.ticket_internal}</label>
                            <input type="radio" name="cat_type" id="cat_type" class="cat_type" value="2" {if $ticket.last_category_type eq 'External'}checked="true"{/if} />
                            <label>{$translate.ticket_external}</label>
                        </div>
                        <div style="width: 100%; float: left;" id="support_category_div"></div>
                    </td>
                </tr>
                <tr class="odd" id="answer_ticket_type">
                    <td>{$translate.ticket_type}</td>
                    <td>
                        <select name="ticket_type" id="ticket_type">
                            {html_options options=$support_ticket_type selected=$ticket.last_ticket_type}
                        </select>
                    </td>
                </tr>
                <tr class="even" id="answer_priority">
                    <td>{$translate.ticket_priority}</td>
                    <td>
                        <select name="priority" id="priority">
                            {html_options options=$support_priority selected=$ticket.last_priority}
                        </select>
                    </td>
                </tr>
                <tr class="even" id="answer_admin">
                    <td>{$translate.ticket_admin}</td>
                    <td>
                        <select name="admin[]" id="admin" multiple="true">
                            {html_options options=$support_admin_users selected=$ticket.admin_user}
                        </select>
                    </td>
                </tr>
                <tr class="odd" >
                    <td width="30%">{$translate.ticket_replay}</td>
                    <td><textarea rows="2" cols="20" name="answer" id="answer" class="notes_discription_text"></textarea></td>
                </tr>
                <tr class="even" >
                    <td>{$translate.ticket_status}</td>
                    <td>
                        <select name="status" id="status">
                            {html_options options=$support_status selected=$ticket.status}
                        </select>
                    </td>
                </tr>
                <tr class="odd">
                    <td>{$translate.ticket_attachment}</td>
                    <td><input type='file' name='attachment' id="attachment" /></td>
                </tr>
                <tr class="even" >
                    <td></td>
                    <td>
                        <div id="answer_is_hidden">
                            {if in_array($loggedin_user, $cirrus_admins) && $ticket.category_type eq 'External'}
                                <input type="checkbox" name="is_hidden" id="is_hidden" value="1" />
                                <label for="is_hidden">{$translate.is_hidden}</label>&nbsp;&nbsp;
                            {/if}
                        </div>
                        <input type="button" name="save_answer" id="save_answer" value="{$translate.save}" onclick="submit_form()" />
                    </td>
                </tr>
            </tbody>
        </table>

        {if $ticket.answers}
            {assign i $ticket.answers|@count + 1}
            {foreach from=$ticket.answers item=answer}
                {if $answer.hidden ne 1}
                    {assign i $i-1}
                    <table class="table_list" id="tbl1">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: left;">{$translate.ticket_answer}#{$ticket.id} - {$i}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="even" >
                                <td width="30%">{$translate.ticket_status}</td>
                                <td>{$support_status[$answer.status]}</td>
                            </tr>
                            {if isset($answer.category)}
                                <tr class="odd">
                                    <td>{$translate.ticket_category}</td>
                                    <td>{$answer.category}</td>
                                </tr>
                            {/if}
                            <tr class="odd">
                                <td>{$translate.ticket_priority}</td>
                                <td>{$support_priority[$answer.priority]}</td>
                            </tr>
                            {if isset($answer.admin_user)}
                                <tr class="even">
                                    <td>{$translate.ticket_admin}</td>
                                    <td>
                                        {foreach from=$answer.admin_user_data item=admin_user}
                                            {$admin_user.first_name|cat: ' '|cat: $admin_user.last_name}<br/>
                                        {/foreach}
                                    </td>
                                </tr>
                            {/if}
                            <tr class="odd">	 
                                <td>{$translate.ticket_answer}</td>
                                <td>{$answer.answer|nl2br}</td>
                            </tr>
                            <tr class="even" >
                                <td>{$translate.ticket_answer_submitted_user}</td>
                                <td>{$answer.submited_name}</td>
                            </tr>
                            {if $answer.attachment}
                                <tr class="odd">
                                    <td>{$translate.ticket_attachment}</td> 
                                    <td>
                                        <div class="single_parent">
                                            <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}tickets/attachment/download/{$smarty.session.user_id}/{$answer.attachment|replace:"'":"\'"}/'">{$answer.attachment}</a>
                                        </div>
                                    </td>
                                </tr >
                            {/if}
                            <tr class="odd" >
                                <td>{$translate.ticket_date}</td>
                                <td>{$answer.date|date_format:"%Y-%m-%d %H:%M"}</td>
                            </tr>
                        </tbody>
                    </table>
                {elseif in_array($loggedin_user, $cirrus_admins)}
                    {assign i $i-1}
                    <table class="table_list" id="tbl1">
                        <thead>
                            {if $answer.hidden eq 1}
                                <tr>
                                    <th colspan="2" style="text-align: center; color: red;">{$translate.hidden}</th>
                                </tr>
                            {/if}
                            <tr>
                                <th colspan="2" style="text-align: left;">{$translate.ticket_answer}#{$ticket.id} - {$i}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="even" >
                                <td width="30%">{$translate.ticket_status}</td>
                                <td>{$support_status[$answer.status]}</td>
                            </tr>
                            {if isset($answer.category)}
                                <tr class="odd">
                                    <td>{$translate.ticket_category}</td>
                                    <td>{$answer.category}</td>
                                </tr>
                            {/if}
                            <tr class="odd">
                                <td>{$translate.ticket_priority}</td>
                                <td>{$support_priority[$answer.priority]}</td>
                            </tr>
                            {if isset($answer.admin_user)}
                                <tr class="even">
                                    <td>{$translate.ticket_admin}</td>
                                    <td>
                                        {foreach from=$answer.admin_user_data item=admin_user}
                                            {$admin_user.first_name|cat: ' '|cat: $admin_user.last_name}<br/>
                                        {/foreach}
                                    </td>
                                </tr>
                            {/if}
                            <tr class="odd">	 
                                <td>{$translate.ticket_answer}</td>
                                <td>{$answer.answer|nl2br}</td>
                            </tr>
                            <tr class="even" >
                                <td>{$translate.ticket_answer_submitted_user}</td>
                                <td>{$answer.submited_name}</td>
                            </tr>
                            {if isset($answer.attachment)}
                                <tr class="odd">
                                    <td>{$translate.ticket_attachment}</td> 
                                    <td>
                                        <div class="single_parent">
                                            <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}tickets/attachment/download/{$smarty.session.user_id}/{$answer.attachment|replace:"'":"\'"}/'">{$answer.attachment}</a>
                                        </div>
                                    </td>
                                </tr >
                            {/if}
                            <tr class="odd" >
                                <td>{$translate.ticket_date}</td>
                                <td>{$answer.date|date_format:"%Y-%m-%d %H:%M"}</td>
                            </tr>
                        </tbody>
                    </table>
                {/if}
            {/foreach}
        {/if}
    </div>
</form>
<div style="clear:both"></div>
</div>   
{/block}