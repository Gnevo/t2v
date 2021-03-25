{block name="script"}
    <script type="text/javascript">

        $(document).ready(function () {

            $("#ticket_form").validate({
                rules: {
                    sprt_category: { required: true },
                    sprt_priority: { required: true },
                    title: { required: true },
                    description: { required: true },
                    sprt_admin: { required: true }
                },
                messages: {
                    sprt_category: "*",
                    sprt_priority: "*",
                    title: "*",
                    description: "*",
                    sprt_ticket_type: "*",
                    sprt_admin: "*"
                }
            });
            $('#support_category_div').load("{$url_path}ajax_ticket_category.php?cat_type=1");
            $('.cat_type').click(function () {
                var cat_type = $(this).val();
                if (cat_type == 2) {
                    $('#ticket_admin_div').hide();
                    $('#support_type_div').show();
                    $('.ticket_affected_user_div').hide();
                    $('#sprt_ticket_type').attr("required","true");
                } else {
                    $('#ticket_admin_div').show();
                    $('#support_type_div').hide();
                    $('.ticket_affected_user_div').show();
                    $('#sprt_ticket_type').attr("required","false");
                }
                $('#support_category_div').html("<img src='{$url_path}images/ajax-loader_fb.gif'>");
                $('#support_category_div').load("{$url_path}ajax_ticket_category.php?cat_type=" + cat_type);
            });
            
            $( "#affected_user" ).autocomplete({
                source: {$users_json},
                select: function(event, ui) {
                    $("#selected_affected_user").val(ui.item.id);   
                }
            });
        });
        function submit_form() {
            $("#ticket_form").submit();
        }

        function reset_form() {
            document.getElementById("ticket_form").reset();
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
    <img src='{$url_path}images/ajax-loader_fb.gif' style="display: none;">
    {if $msg eq 1}
        <div class="tbl_hd"><span class="titles_tab">{$translate.tickets}</span></div>
            {$message}
        <div style="height:50px;">&nbsp;</div>
        <div style="text-align: center;height: 33px;font-size: 19px;" >{$translate.ticket_added_success}</div>
        <div style="float:left;text-align:center;width:79%;" >
            <div style="margin-left: 16%;">
                <a href="{$url_path}tickets/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_ticket_list}</div></a>
                <a href="{$url_path}tickets/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_ticket}</div></a>
            </div>
        </div>
    {else}
        <center>  
            <span style=" position: absolute;display:none; left: 700px; top: 214px;" id="loading">
                <img src="{$url_path}images/sgo-loading.gif">
            </span>
        </center>
        <form name="ticket_form" id="ticket_form" method="post" onsubmit="return validate()" enctype="multipart/form-data" >
            <input type="hidden" id="user_role" name="user_role" value="{$user_role}">
            <input type="hidden" id="selected_affected_user" name="selected_affected_user" />
            <div class="tbl_hd">
                <span class="titles_tab">{$translate.tickets}</span>
                <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
                <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
                <a class="back" href="{$url_path}tickets/list/" ><span class="btn_name">{$translate.backs}</span></a>
            </div>
            {$message}
            <div class="add_contract_main" style="float:left; width:873px;">
                <div class="incnvnt_dv" style="float:left; width:100%;">
                    <div class="incnvnt_dv_ttle">{$translate.add_ticket}</div>
                    <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">

                        <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%; height: auto;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_category}:</div>
                            <div style="width: 50%; float: left;">
                                <input type="radio" name="cat_type" id="cat_type" class="cat_type" value="1" checked="true" />
                                <label>{$translate.ticket_internal}</label>
                                <input type="radio" name="cat_type" id="cat_type" class="cat_type" value="2" />
                                <label>{$translate.ticket_external}</label>
                            </div>
                            <div style="width: 50%; float: left; margin: 5px 0;" id="support_category_div"></div>
                        </div>

                        <div class="incnvnt_dtl_dvs" id="support_type_div" style="float:left; width:100%; display: none;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_type}:</div>
                            <select name="sprt_ticket_type" id="sprt_ticket_type">
                                <option value="">{$translate.select_ticket_type}</option>
                                {html_options options=$support_ticket_type}
                            </select>
                        </div>

                        <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_priority}:</div>
                            <select name="sprt_priority" id="sprt_priority">
                                {html_options options=$support_priority selected=2}
                            </select>
                        </div>

                        <div class="incnvnt_dtl_dvs" id="ticket_admin_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_admin}:</div>
                            <select name="sprt_admin" id="sprt_admin">
                                <option value="">{$translate.select_ticket_admin}</option>
                                {html_options options=$support_admin_users}
                            </select>
                        </div>
                            
                        <div class="ticket_affected_user_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                                <div class="incnvnt_lft_nme">{$translate.affected_user}:</div>
                                <input name="affected_user" id="affected_user" value="" type="text" class="time_fld_dt_pick"  style="width: 150px"/>
                            </div>
                        </div>
                        <div class="ticket_affected_user_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                                <div class="incnvnt_lft_nme">{$translate.affected_user_phone}:</div>
                                <input name="affected_user_phone" id="affected_user_phone" value="" type="text" class="time_fld_dt_pick"  style="width: 150px"/>
                            </div>
                        </div>
                            
                        <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_title}:</div>
                            <input name="title" id="title" value="{$ticket_detail.title}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                        </div>    

                        <div class="notes_dtl_dvs" style="float:left; width:100%;">
                            <div class="incnvnt_lft_nme">{$translate.ticket_discription}:</div>
                            <textarea rows="2" cols="20" name="description" id="description" class="notes_discription_text"></textarea>
                        </div>

                        <div class="incnvnt_dtl_dvs" style="float:left; width:100%;">
                            <div class="incnvnt_lft_nme">{$translate.ticket_attachment}:</div>
                            <input type='file' name='attachment' id="attachment" />
                        </div>
                    </div>  
                </div>
            </div>
        </form>   
    {/if}
{/block}