{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left slot-form">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div class="widget-header span12">
                <h1>{$translate.message_center}</h1>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="row-fluid">
                <div class="span12 icons-group">
                    <ul>
                        {if $privileges_mc.leave_notification == 1 || $privileges_mc.leave_approval == 1 || $privileges_mc.leave_rejection == 1 || $privileges_mc.leave_edit == 1}
                            <li onclick="javascript:location='{$url_path}message/center/leave/';">
                                <div class="messagecenter-icon-leave "></div>
                                <label>{$translate.leave}{if $unread_leaves_count > 0} <span title="{$unread_leaves_count} {$translate.unread_leaves}">({$unread_leaves_count})</span>{/if}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.notes == 1 || $privileges_mc.notes_approval == 1 || $privileges_mc.notes_rejection == 1}   
                            <li onclick="javascript:location='{$url_path}notes/list/';">
                                <div class="messagecenter-icon-notes"></div>
                                <label>{$translate.notes}{if $unread_notes_count > 0} <span title="{$unread_notes_count} {$translate.unread_notes}">({$unread_notes_count})</span>{/if}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.cirrus_mail == 1}    
                            <li onclick="javascript:location='{$url_path}mail/list/';">
                                <div class="messagecenter-icon-mail"></div>
                                <label>{$translate.mail}{if $mail_count > 0} <span title="{$mail_count} {$translate.unread_mails}">({$mail_count})</span>{/if}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.external_mail == 1}
                            <li onclick="javascript:location='{$url_path}email/';">
                                <div class="messagecenter-icon-email"></div>
                                <label>{$translate.email}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.sms == 1}
                            <li onclick="javascript:location='{$url_path}leave_sms_system.php';">
                                <div class="messagecenter-icon-SMS"></div>
                                <label>{$translate.sms_leave}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.document_archive == 1 || $emp_role eq 4 || ($privileges_mc.document_archive == 0 and $count_of_categorys == TRUE)}
                            <li onclick="javascript:location='{$url_path}documents/archive/';">
                                <div class="messagecenter-icon-documents"></div>
                                <label>{$translate.documents}{if $unread_doc_count > 0 && $emp_role != 1 && $emp_role != 6} <span title="{$unread_doc_count} {$translate.unread_docs}">({$unread_doc_count})</span>{/if}</label>
                            </li>
                        {/if}
                        {if $privileges_mc.support == 1 ||  $emp_role == 1}
                            <li onclick="javascript:location='{$url_path}supporttickets/list/';">
                                <div class="messagecenter-icon-tickets"></div>
                                <label>{$translate.support}{if $open_ticket_count > 0} <span title="{$open_ticket_count} {$translate.open_tickets}">({$open_ticket_count})</span>{/if}</label>
                            </li>
                        {/if}
                        {if $emp_role neq 1 and $emp_role neq 6 and $surveys gt 0}
                            <li onclick="javascript:location='{$url_path}user/survey/';">
                                <div class="administration-icon-surveys"></div>
                                <label>{$translate.surveys} <span title="{$surveys} {$translate.unattended_surveys}">({$surveys})</span></label>
                            </li>
                        {/if}
                        {if $emp_role eq 1 or $emp_role eq 6 or $candg_on eq 1}
                            <li><a href="{$url_path}comengo/"><div class="administration-icon-come-and-go"></div><label>{$translate.comengo}<br></label></a></li>
                        {/if}
                        {*if $emp_role eq 1 or $emp_role eq 6*}{if $privileges_mc.sms_general == 1}
                            <li><a href="{$url_path}sms/"><div class="administration-icon-sms-general"></div><label>{$translate.sms}<br></label></a></li>
                        {/if}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}