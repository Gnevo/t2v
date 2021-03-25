{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />        
    <style>
        .recruitment_forms {
            background-color: #E1ECF0;
            margin: 0 6px 1px;
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
    <script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.validate.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $("#first_name").blur(function () {
                if ($("#first_name").val() == "") {
                    $("#first_name").removeClass("error");
                }
                else {
                    $("#first_name").addClass("error");
                }
            });
            $("#last_name").blur(function () {
                if ($("#last_name").val() == "") {
                    $("#last_name").addClass("error");
                }
                else {
                    $("#last_name").removeClass("error");
                }

            });

            $.mask.definitions['~'] = '[1-9]';
            $('#personal_number').mask("?999999-9999", { placeholder: " "});
            
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
                    data: "personal_number=" + security,
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
        });

        function submit_form() {
            var security = $('#personal_number').val();
            security = security.replace("-", "");
            $.ajax({
                url: "{$url_path}recruits.php",
                data: "personal_number=" + security,
                success: function (data) {
                    if ($.trim(data) === "false") {
                        $("#personal_number").css('background', '#FF5252');
                        $("#personal_number").focus();
                        return false;
                    } else {
                        $('#action').val('save');
                        $('#form1').submit();
                    }
                }
            });
        }

    </script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left"> 
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.recruitment_applicant_detail}</span>
        <a href="{$url_path}recruitment/interview/add/" class="back"><span class="btn_name">{$translate.back}</span></a>
        <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
    </div>
    {$message}
    <div id="tble_list">
        <div class="recruitment_forms clearfix">
            <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="{$url_path}add/recruitment/applicant/">
                <input type="hidden" name="action" id="action" value="" />
                <div class="row-fluid">
                <div class="recruitment span12">
                    
                    <div class="recruit_address span6">
                        <div class="row-fluid">
                        <div class="span12">
                        <h3 style="margin-top: 10px; background:#DAF2F7;  padding:10px;">{$translate.recruitment_applicant_detail}</h3>
                        <div class="recruit_bg" style="background:#F1F6F7; padding:12px 10px; border:1px solid #E8EFF1;" >
                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.first_name} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input type="text" name="first_name" id="first_name" value="{$application_data.first_name}" required="true" /> </div>
                            </div>
                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.last_name} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input type="text" name="last_name" id="last_name" value="{$application_data.last_name}" required="true" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.century} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow">
                                    <select name="century" id="century" required="true">
                                        <option value="19" {if $application_data.century eq 19}selected{/if}>19</option>
                                        <option value="20" {if $application_data.century eq 20}selected{/if}>20</option>
                                    </select>
                                </div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.personal_number} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input type="text" name="personal_number" id="personal_number" maxlength="11" value="{$application_data.personal_number}" required="true" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.gender} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow">
                                    <select name="gender" id="gender" required="true">
                                        <option value="1" {if $application_data.gender eq 1}selected{/if}>{$translate.male}</option>
                                        <option value="0" {if $application_data.gender eq 0}selected{/if}>{$translate.female}</option>
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
                                <div class="recruitments_firstrow">*{$translate.address} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow">
                                    <textarea name="address" id="address" style="height: 40px; color: #646363; font-size: 12px;" required="true">{$application_data.address}</textarea>
                                </div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.post_no} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="post_no" id="post_no" type="text" value="{$application_data.post_no}" required="true" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.city} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="city" id="city" type="text" value="{$application_data.city}" required="true" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">{$translate.telephone} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="telephone" id="telephone" type="text" value="{$application_data.telephone}" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.mobile} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="mobile" id="mobile" type="text" value="{$application_data.mobile}" required="true" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">*{$translate.email} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="email" id="email" required="true" type="text" value="{$application_data.email}" /></div>
                            </div>
                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">{$translate.experience} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow">
                                    <select name="experience" id="experience">
                                        <option value="0" {if $application_data.experience =="0"}selected{/if}>Mindre än 1 År</option>
                                        <option value="1" {if $application_data.experience =="1"}selected{/if}>2-3 År</option>
                                        <option value="2" {if $application_data.experience =="2"}selected{/if}>4-5 År</option>
                                        <option value="3" {if $application_data.experience =="3"}selected{/if}>6-7 År</option>
                                        <option value="4" {if $application_data.experience =="4"}selected{/if}>8-9 År</option>
                                        <option value="5" {if $application_data.experience =="5"}selected{/if}>Mer än 10 År</option>
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
                                <div class="recruitments_firstrow">{$translate.name} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="ref_name" id="ref_name" type="text" value="{$application_data.ref_name}" /></div>
                            </div>

                            <div class="recruitment_detailsss clearfix">
                                <div class="recruitments_firstrow">{$translate.mobile} : </div>
                                <div class="recruitments_secondrow clearfix"></div>
                                <div class="recruitments_therdrow"><input name="ref_mobile" id="ref_mobile" type="text" value="{$application_data.ref_mobile}" /></div>
                            </div>
                        </div>
                        </div>
                        </div>    
                    </div>

                    <div class="recruit_aditionelinfor span6" style="margin-left:10px;">
                        <div class="row-fluid">
                        <div class="span12">  
                        <h3 style="background:#DAF2F7;  padding:10px;">{$translate.photo}</h3>
                        <div class="recruit_bg" id="skills_div" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1; height: 65px; margin-left:0px;" >
                            <div class="skill_hold">
                                <div class="recruitment_detailsss clearfix">
                                    <div class="recruitments_firstrow">{$translate.photo} : </div>
                                    <div class="recruitments_secondrow clearfix"></div>
                                    <div class="recruitments_therdrow"><input name="photo" id="photo" type="file" /></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>            
                        <div class="row-fluid">
                        <div class="span12">              
                        <h3 style="background:#DAF2F7;  padding:20px;">{$translate.resume_details}</h3>
                        <div class="recruit_bg" id="skills_div" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1; height: 50px; margin-left:0px;" >
                            <div class="skill_hold">
                                <div class="recruitment_detailsss clearfix">
                                    <div class="recruitments_firstrow">{$translate.file} : </div>
                                    <div class="recruitments_secondrow clearfix"></div>
                                    <div class="recruitments_therdrow"><input name="resume" id="resume" type="file" /></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="row-fluid">
                        <div class="span12">              
                        <h3 style="background:#DAF2F7;  padding:20px;">{$translate.skills}</h3>
                        <div class="recruit_bg" id="skills_div" style="background:#F1F6F7; padding:10px; border:1px solid #E8EFF1;height: 100px; margin-left:0px;" >
                            <div class="skill_hold">
                                <div class="recruitment_detailsss clearfix">
                                    <div class="recruitments_firstrow">{$translate.title} : </div>
                                    <div class="recruitments_secondrow clearfix"></div>
                                    <div class="recruitments_therdrow"><input type="text" name="skill_title[]" value="{$application_data.skill_title.0}" /></div>
                                </div>
                                <div class="recruitment_detailsss clearfix">
                                    <div class="recruitments_firstrow">{$translate.description} : </div>
                                    <div class="recruitments_secondrow clearfix"></div>
                                    <div class="recruitments_therdrow">
                                        <textarea name="skill_desc[]" id="address" style="height: 40px; color: #646363; font-size: 12px;">{$application_data.skill_description.0}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>            
                    </div>
                </div>
                </div>                    
            </form>
        </div>
    </div>
    </div>
    </div>                                        
{/block}