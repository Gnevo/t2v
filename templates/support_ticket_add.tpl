{block name='style'}
{*    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />*}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/summernote.css" />{*wysiwyg*}
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/codemirror.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/blackboard.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/monokai.min.css" />
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
<!-- include libraries BS3 -->
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
<script src="{$url_path}js/plugins/wysiwyg/codemirror.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/xml.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/formatting.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/summernote.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            if($('#category_type:checked').val() == 1){
                {$login_user_role} == 3 ? $('#sel_customer_div').hide() : $('#sel_customer_div').show();
            }
            else if($('#category_type:checked').val() == 2){
                {if $loggedin_user|in_array:$cirrus_admins}
                    $('#sel_customer_div').show()
                {else}
                    $('#sel_customer_div').hide()
                {/if}
                $('#ticket_admin_div').hide();
                $('#support_type_div').show();
                $('.ticket_affected_user_div').hide();
                $('#sprt_ticket_type').attr("required","true");
            }

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
            $('#support_category_div').load("{$url_path}ajax_support_ticket_category.php?category_type=2&company_id={$company_id}");
            $('.category_type').click(function () {
                var category_type = $(this).val();
                // console.log(category_type);
                if (category_type == 2) {
                    {if $loggedin_user|in_array:$cirrus_admins}
                        $('#sel_customer_div').show()
                    {else}
                        $('#sel_customer_div').hide()
                    {/if}
                    $('#ticket_admin_div').hide();
                    $('#support_type_div').show();
                    $('.ticket_affected_user_div').hide();
                    $('#sprt_ticket_type').attr("required","true");
                } 
                else {
                    {$login_user_role} == 3 ? $('#sel_customer_div').hide() : $('#sel_customer_div').show();
                    $('#ticket_admin_div').show();
                    $('#support_type_div').hide();
                    $('.ticket_affected_user_div').show();
                    $('#sprt_ticket_type').attr("required","false");
                }
                $('#support_category_div').html("<img src='{$url_path}images/ajax-loader_fb.gif'>");
                $('#support_category_div').load("{$url_path}ajax_support_ticket_category.php?company_id={$company_id}&category_type=" + category_type);
            });
            
            $( "#affected_user" ).autocomplete({
                source: {$users_json},
                select: function(event, ui) {
                    $("#selected_affected_user").val(ui.item.id);
                    $("#affected_user_phone").val(ui.item.phone);
                }
            });
            
            $('.summernote').summernote({
                height: 200,
                tabsize: 2,
                codemirror: {
                  theme: 'monokai'
                },
                //  onChange: function(contents, $editable) {
                 
                // },

                // onBlur : function(){
                   
                // },

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

        });
        function submit_form() {
              var text = $('.summernote').code().replace(/<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, ' ').replace(/&amp;/g,'&');
                if( $('#title').val() == ''){
                        $('#title').val(text.substring(0, 50));
                }
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
<div class="row-fluid">
    <div class="span12 main-left">
        <img src='{$url_path}images/ajax-loader_fb.gif' style="display: none;">
        <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
        {if $msg eq 1}
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.tickets}</h1>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">{$translate.ticket_added_success}</div>
                    <div class="span12 no-ml" style="float:left;text-align:center;width:79%;">
                        <div>
                            <a href="{$url_path}supporttickets/list/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.go_to_ticket_list}</div></a>
                            <a href="{$url_path}supporttickets/add/"><div style="float:right;margin-right:10px;margin-top:0px;width:240px;" class="week_num">{$translate.add_another_ticket}</div></a>
                        </div>
                    </div>
                </div>
            </div>
        {else}
            <form name="ticket_form" id="ticket_form" method="post" onsubmit="return validate()" enctype="multipart/form-data" >
                <input type="hidden" id="user_role" name="user_role" value="{$user_role}">
                <input type="hidden" id="selected_affected_user" name="selected_affected_user" />
                
                <div style="margin: 15px 0px 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                            <h1 style="">{$translate.tickets}</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                            <button  style="margin: 0px 0px 0px 5px;" onclick="submit_form()" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.save}</button>
                            <button onclick="reset_form()" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.reset}</button>
                            <button onclick="javascript:location='{$url_path}supporttickets/list/';" style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button">{$translate.backs}</button>
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
                            <div class="span6 form-left">
                                <div class="span12" id="answer_ticket_category"  id="sel_customer_div">
                                    <label class="span12">{$translate.ticket_category}:</label>
                                    <div style="margin-left: 0px; float: left;" class="span12 mt">
                                        <label class="pull-left"><input type="radio" name="category_type" id="category_type" class="category_type" value="1" {if $category_type_radio eq 1} checked="true" {/if} style="margin: 0px 7px 0px 0px ! important;"> {$translate.ticket_internal}</label> 

                                        <label class="pull-left"><input type="radio" name="category_type" id="category_type" class="category_type"  value="2" {if $category_type_radio eq 2} checked="true" {/if} style="margin: 0px 7px ! important;"> {$translate.ticket_external}</label>

                                    </div>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11" id="support_category_div">
                                    </div>
                                </div>
                                <div style="margin:0; display: none;" class="span12" id="support_type_div">
                                    <label style="float: left;" class="span12" for="sprt_ticket_type">{$translate.ticket_type}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="sprt_ticket_type" id="sprt_ticket_type" class="span10 form-control">
                                            <option value="">{$translate.select_ticket_type}</option>
                                            {html_options options=$support_ticket_type}
                                        </select>
                                    </div>
                                </div>
                                {*{if in_array($loggedin_user, $cirrus_admins)}*}
                                    <div style="margin:0" class="span12" id="sel_customer_div">
                                        <label style="float: left;" class="span12" for="sprt_priority">{$translate.ticket_priority}:</label>
                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                            <select name="sprt_priority" id="sprt_priority" class="span10 form-control">
                                                {html_options options=$support_priority selected=2}
                                            </select>
                                        </div>
                                    </div>
                               {*{/if}*}
                                <div style="margin: 0px ! important;" class="span12"  id="ticket_admin_div">
                                    <label style="float: left;" class="span12" for="sprt_admin">{$translate.ticket_admin}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select name="sprt_admin" id="sprt_admin" class="span10 form-control">
                                            <option value="">{$translate.select_ticket_admin}</option>
                                            {html_options options=$support_admin_users}
                                        </select>
                                    </div>
                                </div>

                                <div class="span6 ticket_affected_user_div" style="margin: 0px ! important;">
                                    <label style="float: left;" class="span12" for="affected_user">{$translate.affected_user}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-user"></span>
                                        <input name="affected_user" id="affected_user" value="" type="text" class="form-control span10" /> 
                                    </div>
                                </div>
                                <div class="span6 ticket_affected_user_div" style="margin: 0px ! important;">
                                    <label class="span12 affected-user" style="" for="affected_user_phone">{$translate.affected_user_phone}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-phone"></span>
                                        <input name="affected_user_phone" id="affected_user_phone" value="" type="text" class="form-control span10" /> 
                                    </div>
                                </div>
                            </div>
                            <div class="span6 form-right">
                                <div style="margin:0" class="span12">
                                    <label style="float: left;" class="span12" for="title">{$translate.ticket_title}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="title" id="title" value_x="{$ticket_detail.title}"  type="text" class="form-control span11" /> 
                                    </div>
                                </div>
                                <div class="span12 no-ml mt mb">
                                    <label for="description" class="span12" style="margin: 5px;">{$translate.ticket_discription}:</label>
                                    <textarea name="description" id="description" rows="4" class="form-control span12 notes_discription_text summernote" ></textarea>
                                </div>
                                <div class="span6" style="margin: 10px 0px ! important;">
                                    <label class="span12 bilaga-file" style="float: left;" for="attachment">{$translate.ticket_attachment}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> 
                                        <input type='file' name='attachment' id="attachment" class="form-control span12" /> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </form>   
        {/if}
    </div>
</div>
{/block}