{block name='style'}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <style>
        @media screen and (max-width: 767px) { .incnvnt_dv{ float:left; width:85%;}}
        .incnvnt_dv{ background: #FFFFD1 none repeat scroll 0% 0%; padding: 5px 20px; height: 141px; overflow: auto;}
    </style>
{/block}
{block name="script"}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#ticket_mail_form").validate({
                rules: {
                    mail_subject_1: { required: true},
                    mail_body_1: { required: true},
                    mail_subject_2: { required: true},
                    mail_body_2: { required: true},
                    mail_sender_3: { required: true},
                    mail_sender_name_3: { required: true},
                    mail_subject_3: { required: true},
                    mail_body_3: { required: true},
                    mail_sender_4: { required: true},
                    mail_sender_name_4: { required: true},
                    mail_subject_4: { required: true},
                    mail_body_4: { required: true},
                    mail_subject_5: { required: true},
                    mail_body_5: { required: true},
                    mail_subject_6: { required: true},
                    mail_body_6: { required: true},
                    mail_subject_7: { required: true},
                    mail_body_7: { required: true},
                    mail_subject_8: { required: true},
                    mail_body_8: { required: true},
                    mail_subject_9: { required: true},
                    mail_body_9: { required: true},
                    mail_sender_10: { required: true},
                    mail_sender_name_10: { required: true},
                    mail_subject_10: { required: true},
                    mail_body_10: { required: true},
                    mail_sender_11: { required: true},
                    mail_sender_name_11: { required: true},
                    mail_subject_11: { required: true},
                    mail_body_11: { required: true},
                    mail_sender_12: { required: true},
                    mail_sender_name_12: { required: true},
                    mail_subject_12: { required: true},
                    mail_body_12: { required: true},
                },
                messages: {
                    mail_subject_1: "*",
                    mail_body_1: "*",
                    mail_subject_2: "*",
                    mail_body_2: "*",
                    mail_sender_3: "*",
                    mail_sender_name_3: "*",
                    mail_subject_3: "*",
                    mail_body_3: "*",
                    mail_sender_4: "*",
                    mail_sender_name_4: "*",
                    mail_subject_4: "*",
                    mail_body_4: "*",
                    mail_subject_5: "*",
                    mail_body_5: "*",
                    mail_subject_6: "*",
                    mail_body_6: "*",
                    mail_subject_7: "*",
                    mail_body_7: "*",
                    mail_subject_8: "*",
                    mail_body_8: "*",
                    mail_subject_9: "*",
                    mail_body_9: "*",
                    mail_sender_10: "*",
                    mail_sender_name_10: "*",
                    mail_subject_10: "*",
                    mail_body_10: "*",
                    mail_sender_11: "*",
                    mail_sender_name_11: "*",
                    mail_subject_11: "*",
                    mail_body_11: "*",
                    mail_sender_12: "*",
                    mail_sender_name_12: "*",
                    mail_subject_12: "*",
                    mail_body_12: "*",
                }
            });
        });
        function submit_form() {
            $('#mail_update').val(1);
            $("#ticket_mail_form").submit();
        }

        function validate() {
            $("#err_msg").html("");
            $("#sel_customer_div label.error").remove();
            $("#cmb_customer").removeClass('error');
            return true;
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
                    <h1 style="">{$translate.mails}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button onclick="submit_form()" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button">{$translate.save}</button>
                    <button onclick="javascript:location='{$url_path}supporttickets/list/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button">{$translate.backs}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <form name="ticket_mail_form" id="ticket_mail_form" method="post" onsubmit="return validate();">
            <input type="hidden" name="mail_update" id="mail_update" value="0" />
{*                email_new_internal_ticket_to_selected_admin*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_new_internal_ticket_to_selected_admin}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_1">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_1" id="mail_subject_1" value="{$email_model_1.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_1" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_1" id="mail_body_1" rows="3" class="form-control span12">{$email_model_1.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_1.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
{*                email_new_external_ticket_to_selected_admin*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_new_external_ticket_to_selected_admin}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_2">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_2" id="mail_subject_2" value="{$email_model_2.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_2" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_2" id="mail_body_2" rows="3" class="form-control span12">{$email_model_2.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_2.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_new_internal_ticket_confromation_to_creator*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_new_internal_ticket_confromation_to_creator}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_3">{$translate.ticket_sender}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_3" id="mail_sender_3" value="{$email_model_3.sender}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_name_3">{$translate.ticket_sender_name}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_name_3" id="mail_sender_name_3" value="{$email_model_3.sender_name}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_3">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_3" id="mail_subject_3" value="{$email_model_3.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_3" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_3" id="mail_body_3" rows="3" class="form-control span12">{$email_model_3.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_3.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_new_external_ticket_confromation_to_creator*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_new_external_ticket_confromation_to_creator}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_4">{$translate.ticket_sender}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_4" id="mail_sender_4" value="{$email_model_4.sender}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_name_4">{$translate.ticket_sender_name}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_name_4" id="mail_sender_name_4" value="{$email_model_4.sender_name}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_4">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_4" id="mail_subject_4" value="{$email_model_4.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_4" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_4" id="mail_body_4" rows="3" class="form-control span12">{$email_model_4.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_4.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_internal_ticket_answer_by_creator_to_admin*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_internal_ticket_answer_by_creator_to_admin}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_5">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_5" id="mail_subject_5" value="{$email_model_5.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_5" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_5" id="mail_body_5" rows="3" class="form-control span12">{$email_model_5.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_5.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_internal_ticket_answer_by_admin_to_creator*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_internal_ticket_answer_by_admin_to_creator}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_6">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_6" id="mail_subject_6" value="{$email_model_6.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_6" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_6" id="mail_body_6" rows="3" class="form-control span12">{$email_model_6.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_6.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_external_ticket_answer_by_creator_to_cirrus_support*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_external_ticket_answer_by_creator_to_cirrus_support}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_7">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_7" id="mail_subject_7" value="{$email_model_7.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_7" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_7" id="mail_body_7" rows="3" class="form-control span12">{$email_model_7.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_7.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_external_ticket_answer_by_cirrus_support_to_creator*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_external_ticket_answer_by_cirrus_support_to_creator}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_8">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_8" id="mail_subject_8" value="{$email_model_8.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_8" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_8" id="mail_body_8" rows="3" class="form-control span12">{$email_model_8.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_8.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_external_ticket_answer_by_admin_to_creator_and_cirrus_support*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_external_ticket_answer_by_admin_to_creator_and_cirrus_support}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_9">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_9" id="mail_subject_9" value="{$email_model_9.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_9" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_9" id="mail_body_9" rows="3" class="form-control span12">{$email_model_9.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_9.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_internal_ticket_automatic_close*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_internal_ticket_automatic_close}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_10">{$translate.ticket_sender}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_10" id="mail_sender_10" value="{$email_model_10.sender}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_name_10">{$translate.ticket_sender_name}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_name_10" id="mail_sender_name_10" value="{$email_model_10.sender_name}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_10">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_10" id="mail_subject_10" value="{$email_model_10.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_10" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_10" id="mail_body_10" rows="3" class="form-control span12">{$email_model_10.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_10.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
{*                email_external_ticket_automatic_close*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_external_ticket_automatic_close}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_11">{$translate.ticket_sender}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_11" id="mail_sender_11" value="{$email_model_11.sender}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_name_11">{$translate.ticket_sender_name}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_name_11" id="mail_sender_name_11" value="{$email_model_11.sender_name}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_11">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_11" id="mail_subject_11" value="{$email_model_11.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_11" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_11" id="mail_body_11" rows="3" class="form-control span12">{$email_model_11.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_11.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
{*                email_external_ticket_answer_to_answerd_user*}
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.email_external_ticket_answer_to_answerd_user}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="span9 form-left">
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_12">{$translate.ticket_sender}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_12" id="mail_sender_12" value="{$email_model_12.sender}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_sender_name_12">{$translate.ticket_sender_name}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_sender_name_12" id="mail_sender_name_12" value="{$email_model_12.sender_name}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div style="margin:0" class="span12">
                                <label style="float: left;" class="span12" for="mail_subject_12">{$translate.ticket_subject}:</label>
                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                    <input name="mail_subject_12" id="mail_subject_12" value="{$email_model_12.subject}" type="text" class="form-control span10" /> 
                                </div>
                            </div>
                            <div class="span12" style="margin:0">
                                <label for="mail_body_12" class="span12" style="margin-top:0;">{$translate.ticket_body}:</label>
                                <textarea name="mail_body_12" id="mail_body_12" rows="3" class="form-control span12">{$email_model_12.body}</textarea>
                            </div>
                        </div>
                        <div class="span3 form-right">
                            <div class="incnvnt_dv">
                                <ul>
                                    <li>{$email_model_12.help|nl2br}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  
{/block}