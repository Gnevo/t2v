{block name='style'}
{*    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />*}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <style>
        .week_num {
            background: none repeat scroll 0 0 #a4deea;
            border-radius: 4px;
            font-weight: 700;
            margin: 4px auto;
            padding: 5px;
            text-align: center;
            width: 100px;
          }
    </style>
{/block}
{block name="script"}
    <script src="{$url_path}js/jquery.validate.js" type="text/javascript" ></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#ticket_category_form").validate({
                rules: {
                    cat_type: { required: true},
                    cat_order: { required: true},
                    cat_name: { required: true},
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
<div class="row-fluid">
    <div class="span12 main-left">
        <img src='{$url_path}images/ajax-loader_fb.gif' style="display: none;">
        <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
        {if $msg eq 1}
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.ticket_category}</h1>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">{$translate.ticket_category_added_success}</div>
                    <div class="span12 no-ml" style="float:left;text-align:center;width:79%;">
                        <div>
                            <a href="{$url_path}supporttickets/category/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_ticket_category_list}</div></a>
                            <a href="{$url_path}supporttickets/category/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_ticket_category}</div></a>
                        </div>
                    </div>
                </div>
            </div>
        {else}
            <form name="ticket_category_form" id="ticket_category_form" method="post" onsubmit="return validate()" >
                <input type="hidden" id="cat_id" name="cat_id" value="{$category_detail.id}">
                
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                            <h1 style="">{$translate.ticket_category}</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                            <button  style="margin: 0px 0px 0px 5px;" onclick="submit_form()" class="btn btn-default btn-normal pull-right" type="button">{$translate.save}</button>
                            <button onclick="reset_form()" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button">{$translate.reset}</button>
                            <button onclick="javascript:location='{$url_path}supporttickets/category/list/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right" type="button">{$translate.backs}</button>
                        </div>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="row-fluid">
                        <div class="span12">
                            <div style="margin: 0px ! important;" class="widget">
                                <div class="widget-header span12">
                                    <h1>{$translate.add_ticket}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span6">
                                <div style="margin:0;" class="span12">
                                    <label style="float: left;" class="span12" for="cate_type">{$translate.ticket_category_type}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="cat_type" id="cate_type" class="span10 form-control">
                                            <option value="">{$translate.select_ticket_category_type}</option>
                                            {html_options options=$ticket_category_types selected=$category_detail.type}
                                        </select>
                                    </div>
                                </div>
                                {if in_array($loggedin_user, $cirrus_admins)}
                                    <div style="margin:0" class="span12">
                                        <label style="float: left;" class="span12" for="cat_company">{$translate.company}:</label>
                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                            <select name="cat_company" id="cat_company" class="span10 form-control">
                                                <option value="0">{$translate.all}</option>
                                                {html_options options=$companies selected=$company_id}
                                            </select>
                                        </div>
                                    </div>
                                {else}
                                    <input type="hidden" name="cat_company" id="cat_company" value="{$company_id}" />
                                {/if}
                                <div style="margin: 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="cat_order">{$translate.ticket_category_order}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="cat_order" id="cat_order" class="span10 form-control">
                                            {for $i = 1 to $ticket_category_count}
                                                {if $category_detail.order}
                                                    <option value="{$i}" {if $category_detail.order eq $i}selected{/if}>{$i}</option>
                                                {else}
                                                    <option value="{$i}" {if $ticket_category_count eq $i}selected{/if}>{$i}</option>
                                                {/if}
                                            {/for}
                                        </select>
                                    </div>
                                </div>

                                <div class="span12" style="margin: 0px ! important;">
                                    <label style="float: left;" class="span12" for="cat_name">{$translate.ticket_category_name}:</label>
                                    <div style="margin: 0px;" class="input-prepend span11"> <span class="add-on icon-edit"></span>
                                        <input name="cat_name" id="cat_name" value="{$category_detail.name}" type="text" class="form-control span10" /> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </form>   
        {/if}
    </div>
</div>
    
{* ---------------------------   *}
    <div class="row-fluid">
    <div class="span12 main-left">
    <img src='{$url_path}images/ajax-loader_fb.gif' style="display: none;">
    {if $msg eq 1}
        <div class="tbl_hd"><span class="titles_tab">{$translate.ticket_category}</span></div>
            {$message}
        <div style="height:50px;">&nbsp;</div>
        <div style="text-align: center;height: 33px;font-size: 19px;" >{$translate.ticket_category_added_success}</div>
        <div style="float:left;text-align:center;width:79%;" >
            <div style="margin-left: 16%;">
                <a href="{$url_path}supporttickets/category/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_ticket_category_list}</div></a>
                <a href="{$url_path}supporttickets/category/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_ticket_category}</div></a>
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
                <a class="back" href="{$url_path}supporttickets/category/list/" ><span class="btn_name">{$translate.backs}</span></a>
            </div>
            {$message}
            <div class="row-fluid">
            <div class="add_contract_main span12" style="float:left; ">
                <div class="incnvnt_dv" style="float:left; width:100%;">
                    <div class="incnvnt_dv_ttle">{$translate.add_ticket}</div>
                    <div class="incnvnt_dv_dtl" id="attach1attach1" style="float:left; width:100%;">
                        <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                            <div class="incnvnt_lft_nme">{$translate.ticket_category_type}:</div>
                            <select name="cat_type" id="cate_type">
                                <option value="">{$translate.select_ticket_category_type}</option>
                                {html_options options=$ticket_category_types selected=$category_detail.type}
                            </select>
                        </div>
                        {if in_array($loggedin_user, $cirrus_admins)}
                            <div class="incnvnt_dtl_dvs" id="sel_customer_div" style="float:left; width:100%;"> 
                                <div class="incnvnt_lft_nme">{$translate.company}:</div>
                                <select name="cat_company" id="cat_company">
                                    <option value="0">{$translate.all}</option>
                                    {html_options options=$companies selected=$company_id}
                                </select>
                            </div>
                        {else}
                            <input type="hidden" name="cat_company" id="cat_company" value="{$company_id}" />
                        {/if}
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
            </div>
        </form>   
    {/if}
    </div></div>
{/block}