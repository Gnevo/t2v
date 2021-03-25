{block name="script"}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#ticket_mail_form").validate({
                rules: {
                    mail_sender_1: { required: true, email: true },
                    mail_sender_name_1: { required: true },
                    mail_subject_1: { required: true },
                    mail_body_1: { required: true },
                    mail_footer_1: { required: true },
                    
                    mail_sender_2: { required: true, email: true },
                    mail_sender_name_2: { required: true },
                    mail_subject_2: { required: true },
                    mail_body_2: { required: true },
                    mail_footer_2: { required: true },
                    
                    mail_sender_3: { required: true, email: true },
                    mail_sender_name_3: { required: true },
                    mail_subject_3: { required: true },
                    mail_body_3: { required: true },
                    mail_footer_3: { required: true },
                    
                    mail_sender_4: { required: true, email: true },
                    mail_sender_name_4: { required: true },
                    mail_subject_4: { required: true },
                    mail_body_4: { required: true },
                    mail_footer_4: { required: true },
                    
                    mail_sender_5: { required: true, email: true },
                    mail_sender_name_5: { required: true },
                    mail_subject_5: { required: true },
                    mail_body_5: { required: true },
                    mail_footer_5: { required: true },
                },
                messages: {
                    mail_sender_1: "*",
                    mail_sender_name_1: "*",
                    mail_subject_1: "*",
                    mail_body_1: "*",
                    mail_footer_1: "*",
                    
                    mail_sender_2: "*",
                    mail_sender_name_2: "*",
                    mail_subject_2: "*",
                    mail_body_2: "*",
                    mail_footer_2: "*",
                    
                    mail_sender_3: "*",
                    mail_sender_name_3: "*",
                    mail_subject_3: "*",
                    mail_body_3: "*",
                    mail_footer_3: "*",
                    
                    mail_sender_4: "*",
                    mail_sender_name_4: "*",
                    mail_subject_4: "*",
                    mail_body_4: "*",
                    mail_footer_4: "*",
                    
                    mail_sender_5: "*",
                    mail_sender_name_5: "*",
                    mail_subject_5: "*",
                    mail_body_5: "*",
                    mail_footer_5: "*",
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
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.mails}</span>
        <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
        <a class="back" href="{$url_path}tickets/list/" ><span class="btn_name">{$translate.backs}</span></a>
    </div>
    {$message}
    <form name="ticket_mail_form" id="ticket_mail_form" method="post" onsubmit="return validate()">
        <input type="hidden" name="mail_update" id="mail_update" value="0" />
        <div class="add_contract_main" style="float:left; width:873px;">
            <div class="incnvnt_dv" style="float:left; width:100%;">
                <div class="incnvnt_dv_ttle">{$translate.email_ticket_to_selected_admin}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_subject}:</div>
                        <input name="mail_subject_1" id="mail_subject_1" value="{$email_model_1.subject}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_body}:</div>
                        <textarea rows="5" cols="20" name="mail_body_1" id="mail_body_1" class="notes_discription_text">{$email_model_1.body}</textarea>
                    </div>
                    <div class="incnvnt_lft_nme" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_footer}:</div>
                        <textarea rows="2" cols="20" name="mail_footer_1" id="mail_footer_1" class="notes_discription_text" style="height: 60px;">{$email_model_1.footer}</textarea>
                    </div>
                </div>  
            </div>
            
            <div class="incnvnt_dv" style="float:left; width:100%; margin-top: 5px;">
                <div class="incnvnt_dv_ttle">{$translate.email_ticket_to_tech_admin}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_subject}:</div>
                        <input name="mail_subject_5" id="mail_subject_5" value="{$email_model_5.subject}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_body}:</div>
                        <textarea rows="5" cols="20" name="mail_body_5" id="mail_body_5" class="notes_discription_text">{$email_model_5.body}</textarea>
                    </div>
                    <div class="incnvnt_lft_nme" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_footer}:</div>
                        <textarea rows="2" cols="20" name="mail_footer_5" id="mail_footer_5" class="notes_discription_text" style="height: 60px;">{$email_model_5.footer}</textarea>
                    </div>
                </div>  
            </div>
                    
            <div class="incnvnt_dv" style="float:left; width:100%; margin-top: 5px;">
                <div class="incnvnt_dv_ttle">{$translate.email_confromation_on_posting}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_sender}:</div>
                        <input name="mail_sender_2" id="mail_sender_2" value="{$email_model_2.sender}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>
                    <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_sender_name}:</div>
                        <input name="mail_sender_name_2" id="mail_sender_name_2" value="{$email_model_2.sender_name}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_subject}:</div>
                        <input name="mail_subject_2" id="mail_subject_2" value="{$email_model_2.subject}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_body}:</div>
                        <textarea rows="5" cols="20" name="mail_body_2" id="mail_body_2" class="notes_discription_text">{$email_model_2.body}</textarea>
                    </div>
                    <div class="incnvnt_lft_nme" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_footer}:</div>
                        <textarea rows="2" cols="20" name="mail_footer_2" id="mail_footer_2" class="notes_discription_text" style="height: 60px;">{$email_model_2.footer}</textarea>
                    </div>
                </div>  
            </div>
                    
            <div class="incnvnt_dv" style="float:left; width:100%; margin-top: 5px;">
                <div class="incnvnt_dv_ttle">{$translate.email_ticket_answer_update}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_subject}:</div>
                        <input name="mail_subject_3" id="mail_subject_3" value="{$email_model_3.subject}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_body}:</div>
                        <textarea rows="5" cols="20" name="mail_body_3" id="mail_body_3" class="notes_discription_text">{$email_model_3.body}</textarea>
                    </div>
                    <div class="incnvnt_lft_nme" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_footer}:</div>
                        <textarea rows="2" cols="20" name="mail_footer_3" id="mail_footer_3" class="notes_discription_text" style="height: 60px;">{$email_model_3.footer}</textarea>
                    </div>
                </div>  
            </div>
                    
            <div class="incnvnt_dv" style="float:left; width:100%; margin-top: 5px;">
                <div class="incnvnt_dv_ttle">{$translate.email_automatic_close}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_sender}:</div>
                        <input name="mail_sender_4" id="mail_sender_4" value="{$email_model_4.sender}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>
                    <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_sender_name}:</div>
                        <input name="mail_sender_name_4" id="mail_sender_name_4" value="{$email_model_4.sender_name}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.ticket_subject}:</div>
                        <input name="mail_subject_4" id="mail_subject_4" value="{$email_model_4.subject}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_body}:</div>
                        <textarea rows="5" cols="20" name="mail_body_4" id="mail_body_4" class="notes_discription_text">{$email_model_4.body}</textarea>
                    </div>
                    <div class="incnvnt_lft_nme" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.ticket_footer}:</div>
                        <textarea rows="2" cols="20" name="mail_footer_4" id="mail_footer_4" class="notes_discription_text" style="height: 60px;">{$email_model_4.footer}</textarea>
                    </div>
                </div>  
            </div>
        </div>
    </form>   
{/block}