<!DOCTYPE html>
<html>
    <head>
        <title>Cirrus recruitment system</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {*        <link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.ui.core.css" />*}
        <link rel="stylesheet" href="{$url_path}js/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" /><!-- JQueryUI -->
        {*        <link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.ui.autocomplete.css" />*}
        <link rel="stylesheet" href="{$url_path}css/bootstrap.css" type="text/css" async/><!-- Bootstrap -->
        <link rel="stylesheet" href="{$url_path}css/responsive.css" type="text/css" async/>
        <link rel="stylesheet" href="{$url_path}css/recruitment.css" type="text/css" media="screen">
{*        <link rel="stylesheet" href="{$url_path}css/style.css" type="text/css" async/><!-- CHILD THEME -->*}
        <style>
            .error{ background: #f8dbdb; border-color: #e77776; }
            .skill_hold p{ margin-left:8px; }
            label{ cursor: default !important;  }
        </style>

        <script type="text/javascript" src="{$url_path}js/jquery-1.10.1.min.js"></script>
        {*        <script type="text/javascript" src="{$url_path}js/jquery-1.10.2.js"></script>*}
        <script type="text/javascript" src="{$url_path}js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{$url_path}js/demo/common.js"></script><!-- Common Demo Script -->
        <script type="text/javascript" src="{$url_path}js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
        <script>
            $(document).ready(function () {
                $("#fileField").change(function () {
                    $("#fileField").css("width", "auto");
                });
                $("#fileField2").change(function () {
                    $("#fileField2").css("width", "auto");
                });

                $.mask.definitions['~'] = '[1-9]';
                $("#mobile").mask("099-999 99 99 99");
                $("#telephone").mask("099-99999999999");
                $("#post_no").mask("999-99");
                $("#mobile").on("blur", function () {
                    var last = $(this).val().substr($(this).val().indexOf("-") + 1);

                    if (last.length == 3) {
                        var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
                        var lastfour = move + last;

                        var first = $(this).val().substr(0, 9);

                        $(this).val(first + '-' + lastfour);
                    }

                });
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
                $("#email").blur(function () {
                    if ($("#email").val() == "" && $('input:radio[name=send_mail]:checked').val() == 1) {
                        $("#email").addClass("error");
                    }
                    else {
                        $("#email").removeClass("error");
                    }

                });

                $("#telephone").on("blur", function () {
                    var last = $(this).val().substr($(this).val().indexOf("-") + 1);

                    if (last.length == 3) {
                        var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
                        var lastfour = move + last;

                        var first = $(this).val().substr(0, 9);

                        $(this).val(first + '-' + lastfour);
                    }

                });
                $("#post_no").on("blur", function () {
                    var last = $(this).val().substr($(this).val().indexOf("-") + 1);

                    if (last.length == 3) {
                        var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
                        var lastfour = move + last;

                        var first = $(this).val().substr(0, 9);

                        $(this).val(first + '-' + lastfour);
                    }

                });
                $('.minus').parent().hide();
                $('.add').parent().show();
                $("#imgs").click(function () {
                    $(".add_skill_wrap").append('<div class="skill_hold"> <span><a href="javascript:void(0);"class="minus_skill"><img src="{$url_path}images/icon_minus.png"alt=""/></a></span><input name="textfield12[]" type="text" class="input-block-level" placeholder="Title"><textarea name="textarea3[]" class="input-block-level"placeholder="Description"></textarea></div>')
                });
                $('#personal_number').blur(function () {
                    var security = $('#personal_number').val();
                    //alert("yhuj");
                    $.ajax({
                        type: "POST",
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


            });

            $(document).on('click', '.minus_skill', function () {

                $(this).parent().parent('div.skill_hold').remove();


            });

            function add_company(ids) {
                $('#add_' + ids).hide();
                $('#minus_' + ids).show();
                var value = $("#hidetest").val();
                if (value == "")
                {
                    $("#hidetest").val(ids);
                }
                else
                {
                    var x = $("#hidetest").val();
                    x = x + ',' + ids;
                    $("#hidetest").val(x);

                }

            }
            function minus_company(ids) {
                $('#minus_' + ids).hide();
                $('#add_' + ids).show();
                var value = $("#hidetest").val();
                var temp = '';
                if (value != '')
                {
                    var a = value.split(",");
                    for (var y = 0; y < a.length; y++)
                    {
                        if (a[y] != ids)
                        {
                            if (temp == '')
                            {
                                temp = a[y];
                            }
                            else
                            {
                                temp = temp + ',' + a[y];
                            }
                        }

                    }
                    $("#hidetest").val(temp);
                }

            }
            function makechange() {
                change = 1;
                $("#new").val("1");
            }
            function verify_submit(){
                if(confirm('{$translate.confirm_submit_application}'))
                    return true;
                else
                    return false;
            }

        </script>
    </head>
    <body>
        <div class="recruitment_wrap main_content">
            {$message}
            <form method="post" enctype="multipart/form-data" onsubmit="return verify_submit();" name="form1" id="form1" action="recruitment_application.php">
                <input type="hidden" name="company_id" id="company_id" value="{$company_encript_id}" />
                <div id="recruitment_system" class="container form-container"> 
                    <div class="header_wrap">
                        <div class="container">
                            <div class="row-fluid">
                                <div class="span12"><a href="{$url_path}"><img src="{$url_path}images/cirrus_logo.png"  alt=""/></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="recruitment_wrap">
                        <div class="container">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="row-fluid" style="border-bottom: 1px solid rgb(204, 204, 204); margin: 0px 0px 20px;">
                                        <h2>{$translate.cirrus_recruitment_system}</h2>
                                    </div>
                                </div>
                                <div class="span6 no-ml">
                                    <div class="recruitment_form">

                                        <div class="personal_info clearfix">
                                            <p><strong>{$translate.personal_information}</strong></p>
                                            <ul>
                                                <li>
                                                    <label for="Century">{$translate.century}*</label>
                                                    <select name="Century" id="Century" required="true" >
                                                        <p></p>
                                                        <option value="19"{if $applicant_detail[0]=="19"} selected="selected"{/if}>19</option>
                                                        <option value="20"{if $applicant_detail[1]=="20"} selected="selected"{/if}>20</option>
                                                    </select>
                                                </li>
                                                <li>
                                                    <label for="personal_number">{$translate.personal_number} *</label>
                                                    <input type="text" name="personal_number" id="personal_number" value="{$applicant_detail[0].personal_number}" required="true"  maxlength="11" onchange="makechange()" >
                                                    <p></p>
                                                </li>
                                                <li>
                                                    <label for="first_name">{$translate.first_name} *</label>
                                                    <input name="first_name" type="text" id="first_name" required="true" onchange="makechange()" >
                                                    <p></p>
                                                </li>
                                                <li>
                                                    <label for="last_name">{$translate.last_name}*</label>
                                                    <input name="last_name" type="text" id="last_name"  required="true" onchange="makechange()"  >
                                                    <p></p>

                                                </li>
                                                <li>
                                                    <label for="gender">{$translate.gender}*</label>
                                                    <select name="gender" id="gender" >
                                                        <option value="1" {if $applicant_detail[0].gender=="1"} selected="selected"{/if}>{$translate.male}</option>
                                                        <option value="0" {if $applicant_detail[0].gender=="0"} selected="selected"{/if} >{$translate.female}</option>
                                                    </select>
                                                </li>
                                                <li class="block">
                                                    <label for="address">{$translate.address}</label>
                                                    <textarea name="address" id="address" value= "{$applicant_detail[0].address}"class="" onchange="makechange()"></textarea>
                                                </li>
                                                <li>
                                                    <label for="post_no">{$translate.post_no}</label>
                                                    <input name="post_no" type="text" id="post_no" onchange="makechange()">
                                                </li>
                                                <li>
                                                    <label for="city">{$translate.city}</label>
                                                    <input name="city" type="text" id="city" onchange="makechange()" >
                                                </li>
                                                <li>
                                                    <label for="telephone">{$translate.telephone}</label>
                                                    <input name="telephone" type="text" id="telephone" onchange="makechange()">

                                                </li>
                                                <li>
                                                    <label for="mobile">{$translate.mobile}</label>
                                                    <input name="mobile" type="text" id="mobile" onchange="makechange()">
                                                </li>
                                                <li class="block">
                                                    <label for="email">{$translate.email}*</label>
                                                    <input name="email" type="email" id="email"  required="true" class="" onchange="makechange()" >

                                                </li>
                                                <li>
                                                    <label for="fileField">{$translate.photo}</label>
                                                    <input type="file" name="fileField" id="fileField" style="width: 90px">
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- personal_information ended -->
                                        <div class="additional_info clearfix">
                                            <ul>
                                                <li class="block span12 no-ml">
                                                    <div class="resume_wrap clearfix" style="margin: 0px;">
                                                        <p><strong>{$translate.resume_details}</strong></p>
                                                        <ul>
                                                            <li class="block">
                                                                <label for="fileField2">{$translate.file}</label>
                                                                <input type="file" name="fileField2" id="fileField2" style="width: 90px">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="block span12 no-ml">
                                                    <div class="reference_wrap clearfix">
                                                        <p><strong>{$translate.reference}</strong></p>
                                                        <ul>
                                                            <li class='span12 no-ml'>
                                                                <label for="name">{$translate.name}</label>
                                                                <input type="text" name="ref_name" id="name" class='input-block-level' />
                                                            </li>
                                                            <li class='span12 no-ml'>
                                                                <label for="mobile">{$translate.mobile}</label>
                                                                <input type="text" name="ref_mobile" id="mobile" class='input-block-level' />
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="additional_info clearfix">
                                        <p><strong>{$translate.additional_information}</strong></p>
                                        <ul>
                                            <li class="span12 no-ml block clearfix">
                                                <label for="experience">{$translate.experience}</label>
                                                <select name="experience" id="experience">
                                                    <option value="">{$translate.select}</option>
                                                    <option value="0">{$translate.less_than} 1 {$translate.years}</option>
                                                    <option value="1">2-3 {$translate.years}</option>
                                                    <option value="2">4-5 {$translate.years}</option>
                                                    <option value="3">6-7 {$translate.years}</option>
                                                    <option value="4">8-9 {$translate.years}</option>
                                                    <option value="5">{$translate.more_than} 10 {$translate.years}</option>
                                                </select>
                                            </li>
                                            <li class="span12 no-ml block clearfix">
                                                <div class="add_skill_wrap">
                                                    <p><strong>{$translate.add_skill}</strong><a href="javascript:void(0);" class="add" id="imgs"><img src="{$url_path}images/icon_plus.png" alt=""/></a></p>
                                                    <div class="skill_hold"> 
                                                        <input name="textfield12[]" type="text" class="input-block-level skills" placeholder="{$translate.title}"/>
                                                        <textarea name="textarea3[]" class="input-block-level" placeholder="{$translate.description}"></textarea>
                                                    </div>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                                    
                                <div class="span12 no-ml">
                                    <input name="Submit" type="submit" id="Submit" value="{$translate.save}" class="submit_btn" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recruit form ended --> 
                </div>
            </form>
        </div>
    </body>
</html>