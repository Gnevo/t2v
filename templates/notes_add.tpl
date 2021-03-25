{block name="script"}
<script type="text/javascript">
    $(document).ready(function() {
        $("#radio" ).buttonset();
        $("#timing").validate({
                rules: {
                        title: { required: true },
                        description: { required: true }
                },
                    messages: { 
                        title: "*",
                        description: "*"
                    } 
        });
        {*$("#timing").validate({
                rules: {
                        title: { required: true },
                        description: { required: true },
                        cmb_customer: { required: true }
                },
                    messages: { 
                        title: "*", 
                        cmb_customer: "*", 
                        description: "*"
                    } 
        });*}
        attachment_btn = "<div class='incnvnt_dtl_dvs' style='width:100%; float:left;'>\n\
                                <div class='incnvnt_lft_nme'>&nbsp;</div>\n\
                                <div style='float:left;'>\n\
                                    <input type='button' class='attachment_more' value='{$translate.add_more}'  style='width: 80px; float:left;'/> \n\
                                </div>\n\
                            </div>";
                        
        attachment_div = "<input type='file' name='attachment[]'  style='float:left;'/>\n\
                            <input type='button' class='remove_attachment' name='removeButton' value='{$translate.remove}'  style='width: 70px; float:left;margin-left:20px;' />";
        
         $(".attachment_more").live("click",function(){
                $(this).parent().parent().parent().append(attachment_btn);
                $(this).parent().html(attachment_div);
        });
         $(".remove_attachment").live("click",function(){
                if($(this).index('.remove_attachment') == 0)
                    $(this).parent().parent().next('.incnvnt_dtl_dvs').find('.incnvnt_lft_nme').html('{$translate.attachment}');
                $(this).parent().parent().remove();
                    
        });
    });
    function submit_form(){
            $("#timing").submit();	
    }

    function reset_form(){
            document.getElementById("timing").reset();
    }

    function validate(){
            $("#err_msg").html("");
            $("#sel_customer_div label.error").remove();
            $("#cmb_customer").removeClass('error');
            {if $user_role eq '3'}
                    return true;
            {*{elseif $user_role eq '6'}
                    if($("#radio1").is(":checked") == false && $("#radio3").is(":checked") == false){
                        $("#err_msg").html("{$translate.select_one}");	
                        return false;
                    }*}
            {else}
                    var sel_customer = $.trim($('#cmb_customer').val());
                    if($("#radio1").is(":checked") == false && $("#radio3").is(":checked") == false && $("#radio4").is(":checked") == false){
                        $("#err_msg").html("{$translate.select_one}");
                        if(sel_customer == ''){
                            $("#cmb_customer").addClass('error');
                            $("#sel_customer_div").append('<label for="cmb_customer" generated="true" class="error">*</label>');
                            }
                        return false;
                    }
                    else if($("#radio1").is(":checked") == true && sel_customer == ''){
                        $("#cmb_customer").addClass('error');
                        $("#sel_customer_div").append('<label for="cmb_customer" generated="true" class="error">*</label>');
                        return false;
                    }
            {/if}
            return true;
        }
</script>
{/block}

{block name="content"}
{if $msg eq 1}
    <div class="tbl_hd"><span class="titles_tab">{$translate.notes}</span></div>
    {$message}
    <div style="height:50px;">&nbsp;</div>
    <div style="text-align: center;height: 33px;font-size: 19px;" >{$translate.note_added_success}</div>
    <div style="float:left;text-align:center;width:79%;" >
        <div style="margin-left: 16%;">
            <a href="{$url_path}notes/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_notes_list}</div></a>
            <a href="{$url_path}notes/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_not}</div></a>
        </div>
    </div>
{else}
    <center>  
        <span style=" position: absolute;display:none; left: 700px; top: 214px;" id="loading">
            <img src="{$url_path}images/sgo-loading.gif">
        </span>
    </center>
    <form name="timing" id="timing" method="post" onsubmit="return validate()" enctype="multipart/form-data" >
        <input type="hidden" id="user_role" name="user_role" value="{$user_role}">
        <input type="hidden" id="status" name="status" value="{$notes_detail.status}">
        <div class="tbl_hd"><span class="titles_tab">{$translate.notes}</span>
            <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
            {if $note_delet_permission eq 'TRUE'}<a class="delete_btn" href="{$url_path}notes/detail/{$notes_detail.id}/delete/"><span class="btn_name">{$translate.delete}</span></a>{/if}
            <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
{*            <a class="back" href="{$back_url}" ><span class="btn_name">{$translate.backs}</span></a>*}
            <a class="back" href="{$url_path}notes/list/" ><span class="btn_name">{$translate.backs}</span></a>
        </div>
        {$message}
        <div class="add_contract_main" style="float:left; width:873px;">
            <div class="incnvnt_dv" style="float:left; width:100%;">
                <div class="incnvnt_dv_ttle">{$translate.add_notes}</div>
                <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                    <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.customer}:</div>
                        <select name='cmb_customer' id="cmb_customer" {if $user_role neq '1' and $user_role neq '6'}class="required"{/if} >
                          {if $combo_customers|count neq 1 or $user_role neq '3'}<option value="" >{$translate.select_customer}</option>{/if}
{*                           <option value="" >{$translate.to_all_employees}</option>*}
                            {if $combo_customers}
                                {foreach from=$combo_customers item=entries}
                                    {if $sort_by_name == 1}
                                        <option value={$entries.username} {if $notes_detail.cust_name eq $entries.username}selected="selected"{/if}>{$entries.first_name} {$entries.last_name}</option>
                                    {elseif $sort_by_name == 2}
                                        <option value={$entries.username} {if $notes_detail.cust_name eq $entries.username}selected="selected"{/if}>{$entries.last_name} {$entries.first_name}</option>
                                    {/if}
                                    
                                {/foreach}
                            {/if}
                        </select>
                    </div>    
                    <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                        <div class="incnvnt_lft_nme">{$translate.title}:</div>
                        <input name="title" id="title" value="{$notes_detail.title}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                    </div>    
                    <div class="notes_dtl_dvs" style="float:left; width:100%;">
                        <div class="incnvnt_lft_nme">{$translate.discription}:</div>
                        <textarea rows="2" cols="20" name="description" id="description" class="notes_discription_text">{$notes_detail.description}</textarea>
                    </div>
                    {if $user_role neq '3'} 
                        <div class="incnvnt_dtl_dvs" style="height: 33px; float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.visibility}:</div>
                            <div style="float:left;">
                                <div id="radio" style="padding-left: 0px; padding-top: 0px; float:left;">
                                    <input type="radio" id="radio1" name="type" value="2" {if $notes_detail.visibility eq 2}checked="checked"{/if} /><label for="radio1">{$translate.private}hfhgfhf</label>
                                    <input type="radio" id="radio3" name="type" value="1" {if $notes_detail.visibility eq 1}checked="checked"{/if} /><label for="radio3">{$translate.public}</label>
                                    <input type="radio" id="radio4" name="type" value="4" {if $notes_detail.visibility eq 4}checked="checked"{/if} /><label for="radio4">{$translate.admin_only}</label>
                                    {*if $user_role eq '1' or $user_role eq '6'} 
                                         <input type="radio" id="radio4" name="type" value="3" {if $notes_detail.visibility eq 3}checked="checked"{/if} /><label for="radio4">{$translate.all}</label>
                                    {/if*}
                                    
                                    <span id="err_msg" style="color:#FF0000; padding-left: 4px"></span>
                                </div>
                            </div>
                        </div> 
                    {/if}
                    {if ($user_role eq '1') or ($user_role eq '3' and $permission eq 1)} 
                        <div class="incnvnt_dtl_dvs" style="width:100%; float:left;" >
                            <div class="incnvnt_lft_nme" style="float:left;">{$translate.attachments}</div>
                            <div style="float:left;">
{*                                <input type="file" name="attachment[]"  style="float:left;"/>*}
                                <input type="button" class='attachment_more' id="addButton" value="{$translate.add_more}"  style="width: 80px; float:left;"/> 
{*                                <input type="button" id="removeButton" name="removeButton" value="{$translate.remove}"  style="width: 70px; float:left;margin-left:20px;display:none;"/>*}
                            </div>
                        </div>
                    {/if}
                </div>  
            </div>
        </div>
    </form>   
{/if}
{/block}