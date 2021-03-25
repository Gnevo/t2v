{block name="script"}
    <script type="text/javascript">

        $(document).ready(function () {
            $("#ticket_category_form").validate({
                rules: {
                    cat_type: { required: true },
                    cat_order: { required: true },
                    cat_name: { required: true },
                   },
                messages: {
                    cat_type: "*",
                    cat_order: "*",
                    cat_name: "*",
                }
            });
        });
        function submit_form() {
            $("#ticket_category_form").submit();
        }

        function reset_form() {
            document.getElementById("ticket_category_form").reset();
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
        <div class="tbl_hd"><span class="titles_tab">{$translate.ticket_category}</span></div>
            {$message}
        <div style="height:50px;">&nbsp;</div>
        <div style="text-align: center;height: 33px;font-size: 19px;" >{$translate.ticket_category_added_success}</div>
        <div style="float:left;text-align:center;width:79%;" >
            <div style="margin-left: 16%;">
                <a href="{$url_path}tickets/category/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_ticket_category_list}</div></a>
                <a href="{$url_path}tickets/category/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_ticket_category}</div></a>
            </div>
        </div>
    {else}
        <center>  
            <span style=" position: absolute;display:none; left: 700px; top: 214px;" id="loading">
                <img src="{$url_path}images/sgo-loading.gif">
            </span>
        </center>
        <form name="ticket_category_form" id="ticket_category_form" method="post" onsubmit="return validate()" >
            <input type="hidden" id="cat_id" name="cat_id" value="{$category_detail.id}">
            <div class="tbl_hd">
                <span class="titles_tab">{$translate.ticket_category}</span>
                <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
                <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
                <a class="back" href="{$url_path}tickets/category/list/" ><span class="btn_name">{$translate.backs}</span></a>
            </div>
            {$message}
            <div class="add_contract_main" style="float:left; width:873px;">
                <div class="incnvnt_dv" style="float:left; width:100%;">
                    <div class="incnvnt_dv_ttle">{$translate.add_ticket}</div>
                    <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                        <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_category_type}:</div>
                            <select name="cat_type" id="cate_type">
                                <option value="">{$translate.select_ticket_category_type}</option>
                                {foreach from=$ticket_category_type item=list}
                                    <option value="{$list.type}" {if $category_detail.type eq $list.type}selected{/if}>{$list.type}</option>
                                {/foreach}
                            </select>
                        </div>

                        <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_category_order}:</div>
                            <select name="cat_order" id="cat_order">
                                {for $i = 1 to $ticket_category_count}
                                    {if $category_detail.order}
                                            <option value="{$i}" {if $category_detail.order eq $i}selected{/if}>{$i}</option>
                                    {else}
                                            <option value="{$i}" {if $ticket_category_count eq $i}selected{/if}>{$i}</option>
                                    {/if}
                                {/for}
                            </select>
                        </div>

                        <div class="incnvnt_dtl_dvs" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_category_name}:</div>
                            <input name="cat_name" id="cat_name" value="{$category_detail.name}" type="text" class="time_fld_dt_pick"  style="width: 350px"/>
                        </div>    

                    </div>  
                </div>
            </div>
        </form>   
    {/if}
{/block}