{block name='style'}
{*    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />*}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/summernote.css" />{*wysiwyg*}
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/codemirror.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/blackboard.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/monokai.min.css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
        .icon-toggle-up:before{ content: "\f077"; }
        .icon-toggle-down:before { content: "\f078"; }
    </style>
{/block}
{block name="script"}
    <script src="{$url_path}js/jquery.validate.js" type="text/javascript" ></script>
<!-- include libraries BS3 -->
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
<script src="{$url_path}js/plugins/wysiwyg/codemirror.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/xml.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/formatting.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/summernote.js"></script>
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
            });

            $("#ticket_form").validate({
                rules: {
                    answer: { required: true},
                    sprt_category: { required: true}
                },
                messages: {
                    answer: "*",
                    sprt_category: "*"
                }
            });
            $('#support_category_div').load("{$url_path}ajax_support_ticket_category.php?category_type={$ticket.category_type}&category_id={$ticket_last.category_id}&company_id={$ticket.company_id}");
            $('.category_type').click(function () {
                var category_type = $(this).val();
                var category_id = '{$ticket_last.category_id}';
                var company_id = '{$ticket.company_id}';
                if (category_type == 2) {
                    $('#answer_admin').hide();
                    $('#answer_ticket_type').show();
                } else {
                    $('#answer_admin').show();
                    $('#answer_ticket_type').hide();
                }

                $('#support_category_div').html("<img src='{$url_path}images/ajax-loader_fb.gif'>");
                if (category_id != '') {
                    $('#support_category_div').load("{$url_path}ajax_support_ticket_category.php?category_type=" + category_type + "&category_id=" + category_id + "&company_id=" + company_id);
                } else {
                    $('#support_category_div').load("{$url_path}ajax_support_ticket_category.php?category_type=" + category_type + "&company_id=" + company_id);
                }
            });
            
            $('.summernote').summernote({
                height: 200,
                tabsize: 2,
                codemirror: {
                  theme: 'monokai'
                },
                defaultFontName: 'Times New Roman',
                fontNamesIgnoreCheck: ['Times New Roman'],
                lang: '{$lang}',
                toolbar: [
                    //[groupname, [button list]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link',  'hr']],
                    ['view', ['fullscreen', 'codeview']]
                  ]
            });
            
            {if in_array($loggedin_user, $cirrus_admins)}
                        $('#answer_ticket_category').show();
                        $('#answer_priority').show();
                        $('#answer_ticket_type').hide();
                        $('#answer_is_hidden').show();
                        $('#answer_admin').hide();
                {if $ticket.category_type eq '2'}
                        $('#answer_ticket_type').show();
                {elseif $ticket.category_type eq '1'}
                        $('#answer_admin').show();
                {/if}
            {elseif $loggedin_user eq $ticket.created_user && ($user_role eq 1 ||  $user_role eq 2 || $user_role eq 7)}
                        $('#answer_ticket_category').hide();
                        $('#answer_priority').show();
                        $('#answer_ticket_type').hide();
                        $('#answer_admin').hide();
                {if $ticket.category_type eq '1'}
                        $('#answer_admin').show();
                {/if}
            {elseif $loggedin_user eq $ticket.created_user}
                        $('#answer_ticket_category').hide();
                        $('#answer_priority').hide();
                        $('#answer_ticket_type').hide();
                        $('#answer_admin').hide();
            {elseif $user_role eq 1 ||  $user_role eq 2 || $user_role eq 7}
                        $('#answer_ticket_category').hide();
                        $('#answer_priority').show();
                        $('#answer_ticket_type').hide();
                        $('#answer_admin').hide();
                {if $ticket.category_type eq '1'}
                        $('#answer_admin').show();
                {/if}
            {/if}
            {if $ticket.status eq $support_closed_status}
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

        function collapse_remainder(obj_ref){
            $(obj_ref).toggleClass("icon-toggle-down icon-toggle-up");
            $('.collapse').collapse('toggle');
        }

        function save_remainder(){
            var data_obj = {
                subject   : $('#remainder_subject').val(),
                date      : $('#remainder_date').val(),
                action    : 'save_remainder',
                ticket_id : '{$ticket_id}'
            };
            if(data_obj.subject != "" && data_obj.date != ""){
                $.ajax({
                    url  : "{$url_path}support_ticket_detail.php",
                    type : "POST",
                    data : data_obj,
                    success : function(data){
                        data = JSON.parse(data);
                        if(data.result_flag == true){
                                location.reload();
                        }
                        else{
                            $('#left_message_wraper').html(data.error_message);
                        }
                    }
                });
            }
        }

        function remove_single_remainder(id){
            bootbox.dialog('{$translate.do_u_want_delete}', [
                {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                },
                {                          
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        if(id){
                            $.ajax({
                                url:"{$url_path}support_ticket_detail.php",
                                type:'POST',
                                data:{ 'id':id , 'action':'delete_single_remainder'},
                                success:function(data){
                                    data = JSON.parse(data);
                                    if(data.result_flag == true){
                                        location.reload();
                                    }
                                    else{
                                        $('#left_message_wraper').html(data.error_message);
                                    }
                                }
                            });
                        }
                    }
                }
            ]);
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
                    {if $page_from == 'normal'}
                        <button onclick="javascript:location='{$url_path}supporttickets/list/{$selected_status}/{$selected_priority}/{$selected_category_type}/{$selected_admin_company}/{$selected_hidden}/{$selected_key}/{$selected_user}/{$selected_page}/'" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.backs}</button>
                    {else if $page_from == 'mail'}
                        
                        <button onclick="javascript:location='{$url_path}supporttickets/list/1/NULL/{$ticket_last['category_type']}/NULL/0/NULL/NULL/1/'" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.backs}</button>
                    {/if}    
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <form name="ticket_form" id="ticket_form" method="post" onsubmit="return validate()" enctype="multipart/form-data" >
                <input type="hidden" name="selected_status" value="{$selected_status}">
                <input type="hidden" name="selected_priority" value="{$selected_priority}">
                <input type="hidden" name="selected_category_type" value="{$selected_category_type}">
                <input type="hidden" name="selected_admin_company" value="{$selected_admin_company}">
                <input type="hidden" name="selected_hidden" value="{$selected_hidden}">
                <input type="hidden" name="selected_key" value="{$selected_key}">
                <input type="hidden" name="selected_user" value="{$selected_user}">
                <input type="hidden" name="selected_page" value="{$selected_page}">
                <input type="hidden" name="company_id" value="{$company_id}">
                <div class="row-fluid">
                    <div class="span12">
                        <div style="" class="widget-header span12">
                            <div class="span4 day-slot-wrpr-header-left span6">
                                <h1>#{$ticket.id} - {$ticket.title}</h1>
                            </div>
                            {*<div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                <button style="margin: 0px 5px;" class="btn btn-default btn-normal span2 pull-right btn-reply" type="button">Reply</button>
                            </div>*}
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="row-fluid">
                                <div class="span12 table-responsive">
                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary table-ticket-open" style="margin: 0px ! important; top: 0px;">
                                        <thead>
                                            <tr>
                                                <th>{$translate.ticket}</th>
                                                <th>{$translate.ticket_priority}</th>
                                                <th>{$translate.ticket_status}</th>
                                                <th>{$translate.ticket_date}</th>
                                                <th>{$translate.company}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td>#{$ticket.id}</td>
                                                <td>{$support_priority[$ticket.priority]}</td>
                                                <td>{$support_status[$ticket_last.status]}</td>
                                                <td>{$ticket.date|date_format:"%Y-%m-%d %H:%M"}</td>
                                                <td>{$ticket.company}</td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th>{$translate.ticket_created_user}</th>
                                                {if $ticket.category_type eq 1}
                                                    <th>{$translate.ticket_category}</th>
                                                    {if $ticket.affected_user_data.first_name}
                                                        <th>{$translate.affected_user}</th>
                                                        <th>{$translate.ticket_admin}</th>
                                                    {else}
                                                        <th colspan="2">{$translate.ticket_admin}</th>
                                                    {/if}
                                                    <th>{$translate.ticket_attachment}</th>
                                                {elseif $ticket.category_type eq 2}
                                                    <th>{$translate.ticket_category}</th>
                                                    {if $ticket.ticket_type}
                                                        <th>{$translate.ticket_type}</th>
                                                        <th colspan="2">{$translate.ticket_attachment}</th>
                                                    {else}
                                                        <th colspan="3">{$translate.ticket_attachment}</th>
                                                    {/if}
                                                {/if}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td>{$ticket.created_user}<br/>{$ticket.created_user_data.first_name|cat:" "|cat:$ticket.created_user_data.last_name}</td>
                                                {if $ticket.category_type eq 1}
                                                    <td>{$ticket.category}</td>
                                                    {if $ticket.affected_user_data.first_name}
                                                        <td>{$ticket.affected_user_data.first_name|cat: ' '|cat: $ticket.affected_user_data.last_name}<br/>{$ticket.affected_user_phone}</td>
                                                        <td>{if $ticket.admin_username eq ''}{$ticket.admin_user}{else}{$ticket.admin_username}{/if}</td>
                                                    {else}
                                                        <td colspan="2">{if $ticket.admin_username eq ''}{$ticket.admin_user}{else}{$ticket.admin_username}{/if}</td>
                                                    {/if}
                                                    <td>
                                                        {if $ticket.attachment}
                                                            <div class="single_parent">
                                                                <ul>
                                                                    {foreach from=$ticket.attachment item=attachment}
                                                                        <li>
                                                                            <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}supporttickets/attachment/download/{$company_id}/{$attachment|replace:"'":"\'"}/'">{$attachment}</a>
                                                                        </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </div>
                                                        {else}
                                                            {$translate.no_attachment}
                                                        {/if}
                                                    </td>

                                                {elseif $ticket.category_type eq 2}
                                                    <td>{$ticket.category}</td>
                                                    {if $ticket.ticket_type}
                                                    <td>{$support_ticket_type[$ticket.ticket_type]}</td>
                                                    <td colspan="2">
                                                        {if $ticket.attachment}
                                                            <div class="single_parent">
                                                                <ul>
                                                                    {foreach from=$ticket.attachment item=attachment}
                                                                    <li>
                                                                        <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}supporttickets/attachment/download/{$company_id}/{$attachment|replace:"'":"\'"}/'">{$attachment}</a>
                                                                    </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </div>
                                                        {else}
                                                            {$translate.no_attachment}
                                                        {/if}
                                                    </td>
                                                    {else}
                                                        <td colspan="3">
                                                        {if $ticket.attachment}
                                                            <div class="single_parent">
                                                                <ul>
                                                                    {foreach from=$ticket.attachment item=attachment}
                                                                    <li>
                                                                        <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}supporttickets/attachment/download/{$company_id}/{$attachment|replace:"'":"\'"}/'">{$attachment}</a>
                                                                    </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </div>

                                                        {else}
                                                            {$translate.no_attachment}
                                                        {/if}
                                                    </td>
                                                    {/if}
                                                {/if}
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th colspan="5" class="" style="width:20px;">{$translate.ticket_discription}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td colspan="5" class="summernote_display">{$ticket.description|nl2br}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {if $ticket_last.status neq 5}
                        <div class="span12 no-ml mt">
                            <div class="widget-header span12" id="remainder_header">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1>{$translate.ticket_remainder}</h1>
                                </div>
                                <span class="pull-right" >
                                    <i class="span12 mr icon-toggle-down icon-toggle-remainder" style="padding:10px 5px 0px 0px;" onclick="collapse_remainder(this)"> </i>
                                </span>
                            </div>
                            <!-- <div class="wrapper-remainder span12 collapse"> -->
                                {if  $errors|@count gt 0}
                                     ... some stuff here ...
                                {/if}
                                <div class="span12 widget-body-section input-group no-min-height {if  $user_all_remainders|@count gt 0} in {/if} collapse" style="padding: 0px;">
                                    {if $user_all_remainders|@count gt 0}
                                        <div class="row-fluid" style="padding: 6px;width: 99%;">
                                            <div class="widget-header span12">
                                                <div class="span4 day-slot-wrpr-header-left span6">
                                                    <h1>{$translate.my_remainders}</h1>
                                                </div>
                                            </div>
                                            <div class="span12 widget-body-section input-group">
                                                {foreach from=$user_all_remainders item=remainder}
                                                    <span class="badge badge-secondary" title="{$remainder.subject|escape:html}">{$remainder.remainder_date|date_format:"%Y-%m-%d"} {$remainder.subject|escape:html} <span class="icon icon-remove" onclick="remove_single_remainder({$remainder.id})"></span></span>
                                                {/foreach}
                                            </div>
                                        </div>
                                    {/if}  
                                    <div class="row-fluid mt" style="padding: 6px;width: 99%;">
                                        <div style="" class="widget-header span12">
                                            <div class="span4 day-slot-wrpr-header-left span6">
                                                <h1>{$translate.add_new_remainders}</h1>
                                            </div>
                                        </div>
                                        <div class="span12 widget-body-section input-group no-min-height" >
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label for="subject" class="span12" style="margin-left: 7px;">{$translate.remainder_subject} : </label>
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-pencil"></span>
                                                        <input type="text" id="remainder_subject" class="span10">
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <label for="date" class="span12" style="margin-left: 7px;">{$translate.remainder_date} : </label>
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-calendar"></span>
                                                        <input type="text" id="remainder_date" class="span10 datepicker">
                                                    </div>
                                                </div>
                                                <div class="span4" style="margin-top: 15px;">
                                                    <button type="button" class="btn btn-primary" onclick="save_remainder()">{$translate.save_remainder}</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    {/if}

                </div>
                                            
                <br>
                {* closed/finished ticket can't able to post ticket answers *}
                {*if $ticket_last.status neq 3 and $ticket_last.status neq 4*}
                {if $ticket_last.status neq $support_closed_status}
                    <div class="row-fluid">
                        <div class="span12">
                            <div style="margin: 0px ! important;" class="widget">
                                <div class="widget-header span12">
                                    <h1>{$translate.replay_for_ticket}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span6 form-left">
                                <div class="span12" id="answer_ticket_category">
                                    <label style="float: left;" class="span12">{$translate.ticket_category}:</label>
                                    <div style="margin-left: 0px; float: left;" class="span12 mt">
                                        <label class="pull-left"><input type="radio" name="category_type" id="category_type" class="category_type" value="1" {if $ticket.category_type eq '1'}checked="true"{/if} style="margin: 0px 7px 0px 0px ! important;"> {$translate.ticket_internal}</label> 
                                        <label class="pull-left"><input type="radio" name="category_type" id="category_type" class="category_type" value="2" {if $ticket.category_type eq '2'}checked="true"{/if} style="margin: 0px 7px ! important;"> {$translate.ticket_external}</label>
                                    </div>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11" id="support_category_div">
                                    </div>
                                </div>
                                <div style="margin:0" class="span12" id="answer_ticket_type">
                                    <label style="float: left;" class="span12" for="ticket_type">{$translate.ticket_type}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="ticket_type" id="ticket_type" class="span10 form-control">
                                            {html_options options=$support_ticket_type selected=$ticket_last.ticket_type}
                                        </select>
                                    </div>
                                </div>
                                <div style="margin:0" class="span12" id="answer_admin">
                                    <label style="float: left;" class="span12" for="admin">{$translate.ticket_admin}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="admin[]" id="admin" multiple="true" class="span10 form-control">
                                            {html_options options=$support_admin_users selected=explode(',', $ticket_last.admin_user)}
                                        </select>
                                    </div>
                                </div>
                                <div class="span12 no-ml mt mb">
                                    <label for="answer" class="span12" style="margin: 5px;">{$translate.ticket_replay}:</label>
                                    <textarea name="answer" id="answer" rows="1" class="form-control span12 notes_discription_text summernote"></textarea>
                                </div>
                            </div>
                            <div class="span6 form-right">
                                {if in_array($loggedin_user, $cirrus_admins)}
                                    <div style="margin: 0px 0px 10px ! important;" class="span12" id="answer_priority">
                                        <label style="float: left;" class="span12" for="priority">{$translate.ticket_priority}:</label>
                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                            <select name="priority" id="priority" class="span10 form-control">
                                                {html_options options=$support_priority selected=$ticket_last.priority}
                                            </select>
                                        </div>
                                    </div>
                                {/if}
                                <div style="margin: 0px 0px 10px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="status">{$translate.ticket_status}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="status" id="status" class="span10 form-control">
                                            {html_options options=$support_status selected=$ticket_last.status}
                                        </select>
                                    </div>
                                </div>
                                <div class="span12" style="margin: 10px 0px ! important;">
                                    <label class="span12 bilaga-file" style="float: left;" for="attachment">{$translate.ticket_attachment}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> 
                                        <input name='attachment' id="attachment" class="form-control span10" type="file" /> 
                                    </div>
                                </div>
                                {if in_array($loggedin_user, $cirrus_admins) && $ticket.category_type eq '2'}
                                    <div class="span12" style="margin: 10px 0px ! important;" id="answer_is_hidden">
                                        <div style="margin-left: 0px; float: left;" class="span12 mt">
                                            <label class="pull-left"><input type="checkbox" name="is_hidden" id="is_hidden" value="1" style="margin: 0px 7px 0px 0px ! important;"> {$translate.is_hidden}</label>
                                        </div>
                                    </div>
                                {/if}
                            </div>
                            <div class="span12 no-ml">
                                <div class="span6 no-ml form-left">
                                    <input type="button" name="save_answer" id="save_answer" value="{$translate.save}" onclick="submit_form()" class="btn btn-success btn-block"  style="height:35px;" />
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
                            
                {if $answers}
                    {assign i $answers|@count + 1}
                    <div class="row-fluid">
                        <div style="margin: 15px 0px 0px ! important;" class="span12">
                            <div style="" class="widget-header span12">
                                <div class="day-slot-wrpr-header-left span12">
                                    <h1>{$translate.ticket_answers_head}</h1>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group widget-body-ticket-answers-height-fix">
                                {foreach from=$answers item=answer}
                                    {if $answer.hidden ne 1}
                                        {assign i $i-1}
                                        <div class="row-fluid" style="margin: 0px 0px 12px 0px ! important;">
                                            <div class="span12 table-responsive">
                                                <table class="table table-bordered table-condensed table-hover table-responsive table-primary table-ticket-open-answered" style="margin: 0px ! important; top: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8">
                                                                <ul class="tickets-answer-type-list">
                                                                    <li>{$translate.ticket_answer}#{$ticket.id} - {$i}</li>
                                                                    <li>{$answer.date|date_format:"%Y-%m-%d %H:%M"}</li>
                                                                    <li>{$translate.ticket_answer_submitted_user}: {if !empty($answer.submited_user_data) and $answer.submited_user_data.username neq ''}{$answer.submited_user_data.first_name|cat: ' '|cat: $answer.submited_user_data.last_name}{else}{$translate.support_cirrus_label}{/if}</li>
                                                                </ul>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>{$translate.ticket_status}</th>
                                                            <th>{$translate.ticket_priority}</th>
                                                            <th>{$translate.ticket_category}</th>
                                                            {if $ticket.category_type eq '1'}<th>{$translate.ticket_admin}</th>
                                                            {elseif $ticket.category_type eq '2'}<th>{$translate.ticket_type}</th>{/if}
                                                            <th>{$translate.ticket_attachment}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="gradeX">
                                                            <td>{$support_status[$answer.status]}</td>
                                                            <td>{$support_priority[$answer.priority]}</td>
                                                            <td>{$answer.category}</td>
                                                            {if $ticket.category_type eq '1'}
                                                                <td>
                                                                    {foreach from=$answer.admin_user_data item=admin_user}
                                                                        {$admin_user.first_name|cat: ' '|cat: $admin_user.last_name}<br/>
                                                                    {/foreach}
                                                                </td>
                                                            {elseif $ticket.category_type eq '2'}
                                                                <td>{$support_ticket_type[$answer.ticket_type]}</td>
                                                            {/if}
                                                            <td>
                                                                {if $answer.attachment}
                                                                    <div class="single_parent">
                                                                       <!-- <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}supporttickets/attachment/download/{$company_id}/{$answer.attachment|replace:"'":"\'"}/'">{$answer.attachment}</a> -->
                                                                       <a href="{$answer.attachment}" class="note_lint" download>{$answer.file_name}</a> 
                                                                    </div>
                                                                {else}
                                                                    {$translate.no_attachment}
                                                                {/if}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8" class="" style="width:20px;">{$translate.ticket_answer}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="gradeX">
                                                            <td colspan="8" class="summernote_display">{$answer.answer}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    {elseif in_array($loggedin_user, $cirrus_admins)}
                                        {assign i $i-1}
                                        <div class="row-fluid" style="margin: 0px 0px 12px 0px ! important;">
                                            <div class="span12 table-responsive">
                                                <table class="table table-bordered table-condensed table-hover table-responsive table-primary {if $answer.hidden eq 1}table-ticket-open-answered-hidden{else}table-ticket-open-answered{/if}" style="margin: 0px ! important; top: 0px;">
                                                    <thead>
                                                        {if $answer.hidden eq 1}
                                                            <tr><th colspan="8">{$translate.hidden}</th></tr>
                                                        {/if}
                                                        <tr>
                                                            <th colspan="8">
                                                                <ul class="tickets-answer-type-list">
                                                                    <li>{$translate.ticket_answer}#{$ticket.id} - {$i}</li>
                                                                    <li>{$answer.date|date_format:"%Y-%m-%d %H:%M"}</li>
                                                                    <li>{$translate.ticket_answer_submitted_user}: {$answer.submited_user_data.first_name|cat: ' '|cat: $answer.submited_user_data.last_name}</li>
                                                                </ul>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>{$translate.ticket_status}</th>
                                                            <th>{$translate.ticket_priority}</th>
                                                            <th>{$translate.ticket_category}</th>
                                                            {if $ticket.category_type eq '1'}<th>{$translate.ticket_admin}</th>
                                                            {elseif $ticket.category_type eq '2'}<th>{$translate.ticket_type}</th>{/if}
                                                            <th>{$translate.ticket_attachment}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="gradeX">
                                                            <td>{$support_status[$answer.status]}</td>
                                                            <td>{$support_priority[$answer.priority]}</td>
                                                            <td>{$answer.category}</td>
                                                            {if $ticket.category_type eq '1'}
                                                                <td>
                                                                    {foreach from=$answer.admin_user_data item=admin_user}
                                                                        {$admin_user.first_name|cat: ' '|cat: $admin_user.last_name}<br/>
                                                                    {/foreach}
                                                                </td>
                                                            {elseif $ticket.category_type eq '2'}
                                                                <td>{$support_ticket_type[$answer.ticket_type]}</td>
                                                            {/if}
                                                            <td>
                                                                {if $answer.attachment}
                                                                    <div class="single_parent">
                                                                       <!-- <a href="javascript:void()" class="note_lint" onclick="javascript:window.location.href = '{$url_path}supporttickets/attachment/download/{$company_id}/{$answer.attachment|replace:"'":"\'"}/'">{$answer.attachment}</a> -->
                                                                       <a href="{$answer.attachment}" class="note_lint" download>{$answer.file_name}</a> 
                                                                    </div>
                                                                {else}
                                                                    {$translate.no_attachment}
                                                                {/if}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8" class="" style="width:20px;">{$translate.ticket_answer}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="gradeX">
                                                            <td colspan="8" class="">{$answer.answer|nl2br}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    {/if}
                                {/foreach}
                            </div>

                        </div>

                    </div>
                {/if}

            </form>
        </div>
    </div>
</div>            
{/block}