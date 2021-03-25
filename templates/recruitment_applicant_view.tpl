{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />   
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin --> 
    <style>
        .recruitment_forms {
            background-color: #E1ECF0;
            padding: 10px 14px;
        }
        .recruitmentprofile_main {
            background-color:#fff;
            padding:5px;
        }
        .profile_pic, .profile_details {
            float:left;
        }
        .profile_pic {
            margin-right:10px;
        }
        .recruitment_name {
            font-size:18px;
            color:#474747;
            font-weight:bold;
            text-transform:uppercase;
        }
        .recruitment_Secondname {
            text-transform:uppercase;
            font-size:12px;
            margin-top:3px;
        }
        .recruitment_firstrow, .recruitment_second, .recruitment_therd, .recruit_address, .recruit_aditionelinfor, .recruitments_firstrow, .recruitments_secondrow, .recruitments_therdrow {
            float:left;
        }
        .recruitment_firstrow {
            width:110px;
        }
        .recruitment_second {
            margin:0px 10px;
        }
        .deati_recruitment {
            margin-top:7px;
        }
        .recruitment {
            margin-top:10px;
        }
        .recruit_address{
            width:384px;
        }
        .recruit_aditionelinfor {
            width:448px;
        }
        .recruitments_firstrow {
            width:130px;
        }
        .recruitments_secondrow {
            margin:0px 10px;
        }
        .recruitment_detailsss {
            margin-top:13px;
        }
        .recruitment h3, .recruitment h4 {
            margin-top:10px;
            text-transform:uppercase;
        }
        .recruitment p {
            margin-top:10px;
        }
        .recruitment_coments {
            margin-top:30px;
        }
        .recruitment_coments textarea {
            margin-top:10px;
        }
        .resumedownload_btn {
            float:right;
            margin:2px 3px;
            background-color:#0072c6;
            color:#fff;
            padding:7px 5px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .resumedownload_btn a {
            color:#fff;
        }

        .recruitment_status{
            background: #7BB9C7;
            display: inline-block;
            font-weight: bold;
            color: #FFFFFF;
            margin-left: 10px;
            padding: 3px;
            text-align: center;
        }
        .summery_popup { 
            margin: 7px 3px; 
            border:solid 1px #daf2f7; 
            width: 99%; 
            text-align: center;
        }
        .summery_popup td {
            border-right: solid 1px #ffffff;
            font-size: 12px;
            background-color: #daf2f7;
            padding: 5px 4px;
            margin-bottom: 3px;
            text-align: center;
        }
        .summery_popup th {
            border-right: solid 1px #ffffff;
            font-size: 12px;
            font-weight: bold;
            background-color: #daf2f7;
            padding: 5px;
            border-bottom: solid 1px #fff;
            text-align: center;
        } 

        .ui-widget-overlay{
            background:none; 
        }
        .fixed-dialog{ position: fixed; top: 50px; left: 50px; }

        .skill_hold p{
            word-break: normal;
        }
    </style>
{/block}
{block name='script'}
    <script src="{$url_path}js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="{$url_path}js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{$url_path}js/date-picker.js"></script>
    <script src="{$url_path}js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    
    <script type="text/javascript">

        $(document).ready(function () {
            /*$("#date").datetimepicker({
                showOn: "button",
                buttonImage: "{$url_path}images/date_pic.gif",
                buttonImageOnly: true,
                dateFormat: "yy-mm-dd"
            });*/
              

            $('#date').datetimepicker({
                format: "yyyy-mm-dd hh:ii:ss",
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'/*,
                minView: 'month',
                minuteStep: 30,
                todayBtn: true,
                startDate: "2013-02-14 10:00",
                pickerPosition: "bottom-left"*/

            });

            $("#form1").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    personal_number: "required",
                    address: "required",
                    post_no: "required",
                    city: "required",
                    mobile: "required",
                    email: "required email"
                },
                messages: {
                    first_name: "",
                    last_name: "",
                    personal_number: "",
                    address: "",
                    post_no: "",
                    city: "",
                    mobile: "",
                    email: {
                        required: "",
                        email: ""
                    }
                }
            });
            $.mask.definitions['~'] = '[1-9]';
            $('#personal_number').mask("?999999-9999", { placeholder: " "});
            /*$('#skills_div').jScrollPane();
            $('.scroll-pane-arrows').jScrollPane({
                showArrows: true,
                horizontalGutter: 10
            });*/

            $('#personal_number').blur(function () {
                
                var last = $('#personal_number').val().substr($('#personal_number').val().indexOf("-") + 1);
                if (last.length == 6) {
                    var move = $('#personal_number').val().substr($('#personal_number').val().indexOf("-") - 1, 1);
                    var lastfour = move + last;

                    var first = $('#personal_number').val().substr(0, 9);

                    $('#personal_number').val(first + '-' + lastfour);
                }
                var security = $('#personal_number').val();
                security = security.replace("-", "");
                $.ajax({
                    url: "{$url_path}recruits.php",
                    data: "personal_number=" + security + "&app_id={$applicant.id}",
                    success: function (data) {
                        if ($.trim(data) === "false") {
                            $("#personal_number").css('background', '#FF5252');
                            $("#personal_number").focus();
                        } else {
                            $("#personal_number").css('background', '#FFFFFF');
                        }
                    }
                });
            });
        });

        function rescheduleInterview() {
            if ($("#date").val() == '') {
                alert("{$translate.enter_the_interview_date}");
            } else {
                $('#reschedule').val('reschedule');
                $("#form1").submit();
            }

        }

        function downloadFile(filename) {
            if (filename != '')
                document.location.href = "{$url_path}download.php?{$download_folder}/recruitment/resume/" + filename;
            else
                alert("{$translate.no_uploaded_resume}");
        }
        {if $show_prev == 1}
        function popupPreviousSchedule(app_id) {
            var dialog_box_new = $("#previous_slot");
            dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load('{$url_path}ajax_recruitment_previous_schedules.php?app_id=' + app_id);
            dialog_box_new.dialog({
                title: '{$translate.previous_schedules}',
                // position: 'top,left',
                modal: true,
                width: 516,
                minWidth: 300,
                minHeight: 100,
                closeOnEscape: true,
                sticky: true,
                dialogClass: 'fixed-dialog',
                resizable: false,
                close: function (event, ui) {
                    $(this).dialog('destroy').remove();
                    $("#external_wrapper #pop_up_themes").append('<div id="previous_slot" style="display:none;"></div>');
                },
                hide: 'slide',
                show: {
                    effect: 'slide',
                    duration: 500
                }
            });
        }



        {/if}

        function popupComment(action, comment_id) {
            var dialog_box_new = $("#comment_popup");
            dialog_box_new.load('{$url_path}ajax_recruitment_comment.php?app_id={$applicant.id}&status={$applicant.status}&action=' + action + "&comment_id=" + comment_id + '&show_all={$show_all}');
            dialog_box_new.dialog({
                title: '{$translate.comment}',
                position: 'middle',
                modal: true,
                resizable: true,
                width: 630,
                height: 250
            });
            return false;
        }


        function deleteComment(action, comment_id) {
            $.ajax({
                url: "{$url_path}ajax_recruitment_comment.php",
                type: "GET",
                data: 'app_id={$applicant.id}&status={$applicant.status}&action=' + action + '&comment_id=' + comment_id + '&show_all={$show_all}',
                success: function (data_process) {
                    if (data_process == 'deleted') {
                        location.reload();
                    }
                }
            })
        }

        function submit_form() {
            var security = $('#personal_number').val();
            security = security.replace("-", "");
            $.ajax({
                url: "{$url_path}recruits.php",
                data: "personal_number=" + security + "&app_id={$applicant.id}",
                success: function (data) {
                    if ($.trim(data) === "true") {
                        $('#action').val('update');
                        $('#form1').submit();
                    } else {
                        $("#personal_number").css('background', '#FF5252');
                        $("#personal_number").focus();
                        return false;
                    }
                }
            });
        }
        

        function changeStatus() {
            var success_url = "{$url_path}view/recruitment/applicant/{$applicant.id}-{$show_all}-1/";
            var success_url_exist = "{$url_path}view/recruitment/applicant/{$applicant.id}-{$show_all}-1-1/";
            var fail_url = "{$url_path}view/recruitment/applicant/{$applicant.id}-{$show_all}/";
            var security = $('#personal_number').val();
            $('#dialog_hidden').load("{$url_path}ajax_global_check_ssno.php?ssno=" + security + "&success_url=" + success_url + "&fail_url=" + fail_url + "&success_url_exist=" + success_url_exist);
        }
    </script>
{/block}
{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">    
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.recruitment_applicant_detail}</span>
        <a {if $show_all == "1"}href="{$url_path}recruitment/interview/add/"{else}href="{$url_path}recruitment/interview/add/{$applicant.status}/"{/if}class="back"><span class="btn_name">{$translate.back}</span></a>{*{$translate.mark_attended}*}
{*if $applicant.status != '0' && $applicant.status != '5'} <a href="#" onclick="changeStatus()" class="recruitment_change" style="padding: 4px 10px 4px 10px;"><span class="btn_name">{if $applicant.status == '1'}{$translate.mark_employee}{elseif $applicant.status == '2'}{$translate.mark_shortlisted}{elseif $applicant.status == '3'}{$translate.mark_offer_letter_send}{elseif $applicant.status == '4'}{$translate.mark_employee}{/if} </span></a>{/if*}
<a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
</div>
<div id="pop_up_themes">
    <div id="previous_slot" style="display:none;"></div>
    <div id="comment_popup" style="display:none;"></div>
</div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
{$message}
<div class="row-fluid">
    <div id="tble_list" class="span12">
    <div class="recruitment_forms">
        <form method="post" name="form1" id="form1" action="{$url_path}view/recruitment/applicant/{$applicant.id}/">
            
            <div class="recruitment span12">
                
                <div class="recruitmentprofile_main span12">
                    <input type="hidden" name="action" id="action" value="" />
                    <div class="profile_pic">
                        <img {if $applicant.photo != ""} src="{$url_path}{$download_folder}/recruitment/photo/{$applicant.photo}"{else}src="{$url_path}images/pre_general.png"{/if} width="126" height="120">
                    </div>
                    <div class="profile_details">
                        <div class="recruitment_name">{$applicant.last_name} {$applicant.first_name}</div>
                        <div class="recruitment_Secondname"></div>
                        <div class="recruitment_maindetail">

                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow">{$translate.personal_number}</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd">{$applicant.century} {$applicant.personal_number|substr:0:6}-{$applicant.personal_number|substr:6}</div>
                            </div>

                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow">{$translate.name}</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd">{$employee_name}</div>
                            </div>
                            {if $applicant.created_date neq ''}
                            <div class="deati_recruitment clearfix">
                                <div class="recruitment_firstrow">{$translate.created_date}</div>
                                <div class="recruitment_second">:</div>
                                <div class="recruitment_therd">{$applicant.created_date|date_format:'Y-m-d'}</div>
                            </div>
                            {/if}
                        </div>
                    </div>
                    <div class="recruitment_status">{if $applicant.status == 0}
                        {$translate.applied}
                        {elseif $applicant.status == 1}
                            {$translate.interview_called}
                            {elseif $applicant.status == 2}
                                {$translate.interview_attended}   
                                {elseif $applicant.status == 3}
                                    {$translate.shortlisted}
                                    {elseif $applicant.status == 4}
                                        {$translate.offer_letter_send}
                                        {elseif $applicant.status == 5}
                                            {$translate.employee}
                                            {/if}
                                            </div>
                                            <div class="resumedownload_btn">
                                                <a href="javascript:void(0);" onclick="downloadFile('{$applicant.attach_resume}')">{$translate.download_resume}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">        
                                    <div class="recruitment span12">
                                        <div class="recruit_address span6">
                                            <div class="row-fluid">
                                            <div class="span12">    
                                            <h3 style="margin-top: 10px; background:#DAF2F7;  padding:10px;">{$translate.recruitment_applicant_detail}</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:12px 10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.first_name}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="first_name" id="first_name" value="{$applicant.first_name}" required="true" /> </div>
                                                </div>
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.last_name}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="last_name" id="last_name" value="{$applicant.last_name}" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.century}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="century" id="century" required="true">
                                                            <option value="19" {if $applicant.century === 19}selected{/if}>19</option>
                                                            <option value="20" {if $applicant.century === 20}selected{/if}>20</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.personal_number}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input type="text" name="personal_number" id="personal_number" value="{$applicant.personal_number}" maxlength="11" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.gender}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="gender" id="gender" required="true">
                                                            <option value="1" {if $applicant.gender == 1}selected{/if}>{$translate.male}</option>
                                                            <option value="0" {if $applicant.gender == 0}selected{/if}>{$translate.female}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>            
                                            <div class="row-fluid">
                                            <div class="span12">            
                                            <h3 style="background:#DAF2F7;  padding:10px;">Address</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.address}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <textarea name="address" id="address" style="height: 40px; color: #646363; font-size: 12px;" required="true">{$applicant.address}</textarea>
                                                    </div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.post_no}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="post_no" id="post_no" type="text" value="{$applicant.post_no}" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.city}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="city" id="city" type="text" value="{$applicant.city}" required="true" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.telephone}</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="telephone" id="telephone" type="text" value="{$applicant.telephone}" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.mobile}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="mobile" id="mobile" type="text" value="{$applicant.mobile}" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.email}*</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="email" id="email" required="true" type="text" value="{$applicant.email}" /></div>
                                                </div>
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.experience}</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow">
                                                        <select name="experience" id="experience">
                                                            <option value="0" {if $applicant.experience =="0"}selected{/if}>Mindre än 1 År</option>
                                                            <option value="1" {if $applicant.experience =="1"}selected{/if}>2-3 År</option>
                                                            <option value="2" {if $applicant.experience =="2"}selected{/if}>4-5 År</option>
                                                            <option value="3" {if $applicant.experience =="3"}selected{/if}>6-7 År</option>
                                                            <option value="4" {if $applicant.experience =="4"}selected{/if}>8-9 År</option>
                                                            <option value="5" {if $applicant.experience =="5"}selected{/if}>Mer än 10 År</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div> 
                                            <div class="row-fluid">
                                            <div class="span12">       
                                            <h3 style="margin-top: 20px; background:#DAF2F7;  padding:10px;">{$translate.reference_information}</h3>
                                            <div class="recruit_bg" style="background:#F1F6F7; padding:12px 10px; border:1px solid #E8EFF1;" >
                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.name}</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="ref_name" id="ref_name" type="text" value="{$applicant.ref_name}" /></div>
                                                </div>

                                                <div class="recruitment_detailsss clearfix">
                                                    <div class="recruitments_firstrow">{$translate.mobile}</div>
                                                    <div class="recruitments_secondrow clearfix">: </div>
                                                    <div class="recruitments_therdrow"><input name="ref_mobile" id="ref_mobile" type="text" value="{$applicant.ref_mobile}" /></div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>    
                                        </div>
                                        {if $applicant.status == 1 || $applicant.status == 0}
                                            <div class="recruit_aditionelinfor span6" style="margin-left: 10px">
                                                <div class="row-fluid">
                                                <div class="span12">
                                                <h3 style="background:#DAF2F7;  padding:10px;">{$translate.interview_information}</h3>
                                                <div class="recruit_bg" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;" >
                                                    {if $applicant.status != 0}
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow">{$translate.interview_date}</div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow">{$applicant.date_of_interview} </div>
                                                        </div>
                                                    {/if}
                                                    <input type="hidden" value="" id="reschedule" name="reschedule" />
                                                    <div class="recruitment_detailsss clearfix" style="width: auto;">
                                                        <div class="recruitments_firstrow" style="width: auto;"><input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview"> </div>
                                                        <div class="recruitments_secondrow clearfix" style="width: auto;">: </div>
                                                        <div class="recruitments_therdrow" style="width: auto;">
                                                            <input name="save_new_date" type="button" id="save_new_date" value="{$translate.reschedule_date}" onclick="rescheduleInterview()" /><br/>
                                                            {if $show_prev == 1}<input type="button" name="previous_schedule" id="previous_schedule" value="{$translate.previous_schedules}" onclick="popupPreviousSchedule('{$applicant.id}');" style="margin-top: 10px;" />{/if}
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>        
                                            </div>
                                        {/if}
                                        <div class="recruit_aditionelinfor span6" style="margin-left:10px;">
                                            <div class="row-fluid">
                                            <div class="span12">
                                            <h3 style="background:#DAF2F7;  padding:10px;">{$translate.skills}</h3>
                                            <div class="recruit_bg span12" id="skills_div" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;height: 262px;margin-left:0px;" >
                                                <div class="skill_hold">
                                                    {foreach $applicant_skills AS $skill}
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow">{$translate.title} </div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow"><input type="text" name="skill_title[]" value="{$skill.title}" /></div>
                                                        </div>
                                                        <div class="recruitment_detailsss clearfix">
                                                            <div class="recruitments_firstrow">{$translate.description}   </div>
                                                            <div class="recruitments_secondrow clearfix">: </div>
                                                            <div class="recruitments_therdrow">
                                                                <textarea name="skill_desc[]" id="address"  style="height: 40px; color: #646363; font-size: 12px;">{$skill.description}</textarea>
                                                            </div>
                                                        </div>
                                                    {foreachelse}
                                                        <h4>{$translate.no_skills}</h4>   
                                                    {/foreach}
                                                </div>

                                            </div>
                                            </div>
                                            </div>    
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row-fluid">            
                                    <div class="recruitment span12">
                                        <div class="recruitment_coments">
                                            <h3 style=" margin-bottom:2px; background:#DAF2F7;  padding:10px;">{$translate.comments}</h3>
                                            <div class="comment_hold">
                                                <table class="table_list" style="width: 100%;text-align: center">
                                                    <tr><th style="width: 71px">{$translate.date}</th><th>{$translate.comment}</th><th style="width: 169px"> {$translate.status}</th><th style="width: 52px"></th></tr>
                                                            {foreach $comments AS $comment}
                                                        <tr class="{cycle values="even,odd"}">
                                                            <td>{$comment.date}</td>
                                                            <td>{$comment.comment}</td>
                                                            <td>
                                                                {if $comment.application_status == 0}
                                                                    {$translate.applied}
                                                                {elseif $comment.application_status == 1}
                                                                    {$translate.interview_called}
                                                                {elseif $comment.application_status == 5}
                                                                    {$translate.employee}
                                                                {/if}
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0);" class="settings" onclick="popupComment('2', '{$comment.id}')"><img src="{$url_path}images/settings.png" border="0" title="{$translate.edit}" width="25" /></a>
                                                                <a href="javascript:void(0);" class="contracts"onclick="deleteComment('3', '{$comment.id}')" ><img src="{$url_path}images/dlt_btn_icn.png" border="0" title="{$translate.delete}" width="25" /></a>
                                                            </td>
                                                        </tr>
                                                    {foreachelse}
                                                        <tr><td colspan="4"> <div class="message">{$translate.no_data_available}</div></td></tr>
                                                            {/foreach}

                                                </table>
                                                <div style="clear:both; margin-top:15px; "><br />
                                                    <input type="button" name="submit_form" id="submit_form" value="{$translate.add_new_comment}" onclick="popupComment('1', '0')"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>            
                                </form>
                            </div>
                        </div>
</div>
</div></div>                                                
                        {/block}