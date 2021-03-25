{block name='style'}
{*    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />*}
{/block}

{block name="script"}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sprt_search_key').keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    get_report();
                }
            });
        });

        function get_report() {
            var status = $('#sprt_status').val();
            var priority = $('#sprt_priority').val();
            if(typeof priority == 'undefined'){
                priority = '';
            }
            var search_key = $('#sprt_search_key').val();
            console.log(search_key);
        {if in_array($loggedin_user, $cirrus_admins)}
            var admin_search = $('#sprt_company').val();
            var category_type = $('#sprt_category_type').val();
            if ($('#is_hidden').is(':checked')) {
                var is_hidden = '1';
            } else {
                var is_hidden = '0';
            }
            var user = $('#sprt_user').val();
        {elseif $user_role eq 1 || $user_role eq 6 ||  $user_role eq 2  ||  $user_role eq 7}
            var admin_search = $('#sprt_admin_user').val();
            var category_type = $('#sprt_category_type').val();
            var is_hidden = '0';
            var user = $('#sprt_user').val();
        {else}
            var category_type = 'NULL';
            var admin_search = 'NULL';
            var is_hidden = '0';
            var user = 'NULL';
        {/if}
            if (status == '')
                status = 'NULL';
            if (priority == '')
                priority = 'NULL';
            if (category_type == '')
                category_type = 'NULL';
            if (search_key == '')
                search_key = 'NULL';
            if (admin_search == '')
                admin_search = 'NULL';
            if (user == '')
                user = 'NULL';
            //alert(category_type);
            window.location.href = '{$url_path}supporttickets/list/' + status + '/' + priority + '/' + category_type + '/' + admin_search + '/' + is_hidden + '/' + search_key + '/' + user + '/';
        }

        function goto_ticket_add(){
            var category = $('#sprt_category_type').val();
            location.href = '{$url_path}supporttickets/add/'+category+'/';
        }
    </script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.tickets}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button  style="margin: 0px 0px 0px 5px;" onclick="goto_ticket_add()" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.add_new_ticket}</button>
                        {if in_array($loggedin_user, $cirrus_admins)}<button onclick="javascript:location='{$url_path}supporttickets/mails/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button"  title="{$translate.add_new_ticket}">{$translate.ticket_mails}</button>{/if}
                        {if $user_role eq 1}<button onclick="javascript:location='{$url_path}supporttickets/category/list/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.ticket_category}</button>{/if}
                        <button onclick="javascript:location='{$url_path}message/center/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.backs}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <form name="ticket_form" id="ticket_form" method="post">
                            {if in_array($loggedin_user, $cirrus_admins) || $user_role eq 1 || $user_role eq 6 || $user_role eq 2 ||  $user_role eq 7}
                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                    <div class="span12 widget-body-section input-group">
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_status">{$translate.ticket_status}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                <select name="sprt_status" id="sprt_status" class="form-control span11">
                                                    <option value="">{$translate.all_active}</option>
                                                    {html_options options=$support_status selected=$selected_status}
                                                </select>
                                            </div>
                                        </div>
                                        {if in_array($loggedin_user, $cirrus_admins)}
                                            <div class="span1" style="margin: 0px;">
                                                <label style="float: left;" class="span12" for="sprt_priority">{$translate.ticket_priority}:</label>
                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                    <select name="sprt_priority" id="sprt_priority" class="form-control span8">
                                                        <option value="">{$translate.all}</option>
                                                        {html_options options=$support_priority selected=$selected_priority}
                                                    </select>
                                                </div>
                                            </div>
                                        {/if}

                                        {if in_array($loggedin_user, $cirrus_admins)}
                                            <div class="span2" style="margin: 0px;">
                                                <label style="float: left;" class="span12" for="sprt_company">{$translate.company}:</label>
                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                    <select name="sprt_company" id="sprt_company" class="form-control span11">
                                                        <option value="">{$translate.all}</option>
                                                        {html_options options=$companies selected=$selected_company}
                                                    </select>
                                                </div>
                                            </div>
                                        {elseif $user_role eq 1 || $user_role eq 6 || $user_role eq 2 ||  $user_role eq 7}
                                            <div class="span2" style="margin: 0px;">
                                                <label style="float: left;" class="span12" for="sprt_admin_user">{$translate.ticket_admin}:</label>
                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                    <select name="sprt_admin_user" id="sprt_admin_user" class="form-control span11">
                                                        <option value="">{$translate.all}</option>
                                                        {html_options options=$support_admin_users selected=$selected_admin_user}
                                                    </select>
                                                </div>
                                            </div>
                                        {/if}
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_user">{$translate.ticket_created_user}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                <select name="sprt_user" id="sprt_user" class="form-control span11">
                                                    <option value="">{$translate.all}</option>
                                                    {html_options options=$users selected=$selected_user}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_category_type">{$translate.ticket_category}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                <select name="sprt_category_type" id="sprt_category_type" class="form-control span11">
                                                    {html_options options=$support_category_types selected=$selected_category_type}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_search_key">{$translate.ticket_search_key}:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-search"></span>
                                                <input name="sprt_search_key" id="sprt_search_key" value="{$selected_search_key}" maxlength="100" placeholder="{$translate.ticket_search_word}" class="form-control span11" type="text"/> </div>
                                        </div>
                                        <button name="go" id="go" onclick="get_report();" class="btn btn-default span1 btn-margin-set" style="margin-top: 15px; text-align: center;" type="button">{$translate.show}</button>
                                        {if in_array($loggedin_user, $cirrus_admins)}
                                            <div class="span1 pull-right" style="margin: 25px 0px 0px;">
                                                <input name="is_hidden" id="is_hidden" value="1" {if $selected_hidden == 1} checked="true"{/if} style="margin: 0px 5px ! important;" type="checkbox" /> {$translate.hidden}
                                            </div>
                                        {/if}
                                        <div class="span2 pull-right" style="margin: 25px 0px 0px;">
                                            <label class="pull-right"><strong>{$translate.total_records}: {$total_records}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            {else}
                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                    <div class="span12 widget-body-section input-group">
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_status">{$translate.ticket_status}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                <select name="sprt_status" id="sprt_status" class="form-control span11">
                                                    <option value="">{$translate.all}</option>
                                                    {html_options options=$support_status selected=$selected_status}
                                                </select>
                                            </div>
                                        </div>
                                        {if in_array($loggedin_user, $cirrus_admins)}
                                            <div class="span1" style="margin: 0px;">
                                                <label style="float: left;" class="span12" for="sprt_priority">{$translate.ticket_priority}:</label>
                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                    <select name="sprt_priority" id="sprt_priority" class="form-control span8">
                                                        <option value="">{$translate.all}</option>
                                                        {html_options options=$support_priority selected=$selected_priority}
                                                    </select>
                                                </div>
                                            </div>
                                        {/if}
                                        <div class="span2" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="sprt_search_key">{$translate.ticket_search_key}:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-search"></span>
                                                <input name="sprt_search_key" id="sprt_search_key" value="{$selected_search_key}" maxlength="100" placeholder="{$translate.ticket_search_word}" class="form-control span11" type="text"/> </div>
                                        </div>
                                        <button name="go" id="go" onclick="get_report();" class="btn btn-default span1 btn-margin-set" style="margin-top: 15px; text-align: center;" type="button">{$translate.show}</button>
                                        <div class="span2 pull-right" style="margin: 25px 0px 0px;">
                                            <label class="pull-right"><strong>{$translate.total_records}: {$total_records}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </form>
                        <div class="span12 no-min-height no-ml mt">
                            <div class="pagination pagination-mini pagination-right pagin margin-none">
                                {if $pagination neq ''}<ul id="pagination">{$pagination}</ul>{/if}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span12 no-ml table-responsive">
                        <table class="table table-bordered table-condensed table-hover table-responsive table-primary t" style="margin: 0px ! important; top: 0px;">
                            <thead>
                                <tr>
                                    <th class="table-col-center" style="width:20px;">#</th>
                                    <th>{$translate.ticket_date}</th>
                                    {if in_array($loggedin_user, $cirrus_admins)}<th>{$translate.company}</th>{/if}
                                    <th>{$translate.ticket_priority}</th>
                                    {if $user_role eq 1 || $user_role eq 6 || in_array($loggedin_user, $cirrus_admins)}<th>{$translate.ticket_created_user}</th>{/if}
                                    <th>{$translate.ticket_category}</th>
                                    <th>{$translate.ticket_title}</th>
                                    <th>{$translate.ticket_status}</th>
                                    {if $selected_category_type eq 1}
                                        <th>{$translate.affected_user}</th>
                                    {/if}
                                    <th style="width:15px;">{$translate.view}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$tickets_list item=list}
                                    {assign var = cat_type value = 'I'}
                                    {if $list.category_type eq 'External'}{assign var = cat_type value = 'C'}{/if}
                                    <tr class="gradeX" id="status_{$list.id}" {if $list.status eq 1} style="font-weight: bold" {/if}>
                                        <td class="table-col-center" style="width:20px;">{$list.id}</td>
                                        <td>{$list.date|date_format:"%Y-%m-%d %H:%M"}</td>
                                        {if in_array($loggedin_user, $cirrus_admins)}<td>{$list.company}</td>{/if}
                                        <td>{$support_priority[$list.priority]}</td>
                                        {if $user_role eq 1 || in_array($loggedin_user, $cirrus_admins)}<td>{$list.created_user}</td>{/if}
                                        <td>{$list.category}</td>
                                        <td>{$list.title}</td>
                                        <td>{$support_status[$list.status]}</td>
                                        {if $selected_category_type eq 1}
                                            <td>{$list.affected_user}</td>
                                        {/if}
                                        <td class="table-col-center center" style="width:15px;">
                                            <button onclick="javascript:location='{$url_path}supporttickets/detail/{$list.id}/{$list.company_id}/{$selected_status}/{$selected_priority}/{$selected_category_type}/{$selected_admin_company}/{$selected_hidden}/{$selected_key}/{$selected_user}-{$selected_page}/';" class="btn btn-default span12" style="text-align: center;" type="button" title="{$translate.view}"> <i class="icon-search"></i> </button>
                                        </td>
                                    </tr>
                                {foreachelse}
                                    <tr><td {if in_array($loggedin_user, $cirrus_admins)}colspan='9'{elseif $user_role eq 1}colspan='8'{else}colspan='7'{/if}><div class="message">{$translate.no_data_available}</div></td></tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}