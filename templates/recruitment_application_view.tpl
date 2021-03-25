{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
{/block}
{block name='script'}
    <script type="text/javascript" src="{$url_path}js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
    <script>
        $(document).ready(function () {

        });
        function applicant_cancel() {
            $('#action').val("cancel");
            $('#form1').submit();
        }
        
        function downloadFile(filename) {
            if (filename != '')
                document.location.href = "{$url_path}download.php?{$download_folder}/recruitment/temp/" + filename;
            else
                alert("{$translate.no_uploaded_resume}");
        }
    </script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="recruitment_wrap main_content">
        <form method="post" name="form1" id="form1" action="{$url_path}recruitment/application/">
            <input type="hidden" name="action" id="action" value="confirmed" />
            <input type="hidden" name="Century" value="{$application_data.century}" />
            <input type="hidden" name="personal_number" value="{$application_data.personal_number}" />
            <input type="hidden" name="first_name" value="{$application_data.first_name}" />
            <input type="hidden" name="last_name" value="{$application_data.last_name}" />
            <input type="hidden" name="gender" value="{$application_data.gender}" />
            <input type="hidden" name="address" value="{$application_data.address}" />
            <input type="hidden" name="post_no" value="{$application_data.post_no}" />
            <input type="hidden" name="city" value="{$application_data.city}" />
            <input type="hidden" name="telephone" value="{$application_data.telephone}" />
            <input type="hidden" name="mobile" value="{$application_data.mobile}" />
            <input type="hidden" name="email" value="{$application_data.email}" />
            <input type="hidden" name="experience" value="{$application_data.experience}" />
            <input type="hidden" name="ref_name" value="{$application_data.ref_name}" />
            <input type="hidden" name="ref_mobile" value="{$application_data.ref_mobile}" />
            <input type="hidden" name="fileField" value="{$application_data.photo}" />
            <input type="hidden" name="fileField2" value="{$application_data.resume}" />
            {foreach $application_data.skill_title as $skill_title}
                <input type="hidden" name="textfield12[]" value="{$skill_title}" />
            {/foreach}
            {foreach $application_data.skill_description as $skill_description}
                <input type="hidden" name="textarea3[]" value="{$skill_description}" />
            {/foreach}
            <div class="container form-container">
                <div style="border-bottom: 1px solid rgb(204, 204, 204); margin: 0px 0px 20px;" class="row-fluid">
                    <div class="col-xl-12"><h2 style="margin: 0px 0px 20px; line-height: 20px;">{$translate.cirrus_recruitment_application}</h2></div>
                </div>
                <div class="row-fluid">
                    {$message}
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="recruitment_form">
                            <div class="personal_info clearfix">
                                <p><strong>{$translate.personal_information}</strong></p>
                                <table style="width: 100%;">
                                    <tr>
                                        <td>{$translate.first_name}</td>
                                        <td>{$application_data.first_name}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.last_name}</td>
                                        <td>{$application_data.last_name}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.century}</td>
                                        <td>{$application_data.century}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.personal_number}</td>
                                        <td>{$application_data.personal_number}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.gender}</td>
                                        <td>
                                            {if $application_data.gender == 1}{$translate.male}{/if}
                                            {if $application_data.gender == 0}{$translate.female}{/if}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.telephone}</td>
                                        <td>{$application_data.telephone}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.mobile}</td>
                                        <td>{$application_data.mobile}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="recruitment_form">
                            <div class="personal_info clearfix">
                                <p>&nbsp;</p>
                                <table style="width: 100%">
                                    <tr>
                                        <td>{$translate.address}</td>
                                        <td>{$application_data.address}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.post_no}</td>
                                        <td>{$application_data.post_no}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.city}</td>
                                        <td>{$application_data.city}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.email}/{$translate.username}</td>
                                        <td>{$application_data.email}</td>
                                    </tr>
                                    <tr>
                                        <td>{$translate.photo}</td>
                                        <td>
                                            {if $application_data.photo != ""}
                                                <div class="profile_pic">
                                                    <img  src="{$url_path}{$download_folder}/recruitment/temp/{$application_data.photo}" width="126" height="120" />
                                                </div>
                                            {/if}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="additional_info clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid section-bottom">
                    <div style="margin: 0px;" class="span6 reference_wrap">
                        <div style="" class="resume_wrap">
                            <p><strong>{$translate.resume_details}</strong></p>
                            <table style="width: 100%;">
                                <tr>
                                    <td>{$translate.file}</td>
                                    <td>
                                        {if $application_data.resume}
                                            <div class="resumedownload_btn">
                                                <a href="javascript:void(0);" onclick="downloadFile('{$application_data.resume}')">{$translate.download_resume}</a>
                                            </div>
                                        {/if}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <p><strong>{$translate.reference}</strong></p>
                        <table>
                            <tr>
                                <td>{$translate.name}</td>
                                <td>{$application_data.ref_name}</td>
                            </tr>
                            <tr>
                                <td>{$translate.mobile}</td>
                                <td>{$application_data.ref_mobile}</td>
                            </tr>
                        </table>
                        <div style="float: left; width: 100%; margin: 10px 0px 0px; padding: 10px 0px 0px; border-top: 2px dotted rgb(198, 198, 198);" class="additional_info clearfix">
                            <p style=""><strong>{$translate.additional_information}</strong></p>
                            <table style="width: 100%">
                                <tr>
                                    <td>{$translate.experience}</td>
                                    <td>
                                        {if $application_data.experience eq 0}Mindre än 1 År{/if}
                                        {if $application_data.experience eq 1}2-3 År{/if}
                                        {if $application_data.experience eq 2}4-5 År{/if}
                                        {if $application_data.experience eq 3}6-7 År{/if}
                                        {if $application_data.experience eq 4}8-9 År{/if}
                                        {if $application_data.experience eq 5}Mer än 10 År{/if}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="span6 add_skill_wrap">
                        {if $application_data.skill_title}
                            {for $i=0 to $application_data.skill_title|@count - 1}
                                <div class="skill_hold">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td>{$translate.title}</td>
                                            <td>{$application_data.skill_title.$i}</td>
                                        </tr>
                                        <tr>
                                            <td>{$translate.description}</td>
                                            <td>{$application_data.skill_description.$i}</td>
                                        </tr>
                                    </table>
                                </div>
                            {/for}
                        {/if}
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="col-xl-12 pull-right submit-datas">
                        <input name="cancel" id="cancel" value="{$translate.cancel}" class="submit_btn" type="button" onclick="applicant_cancel()">
                        <input name="Submit" id="Submit" value="{$translate.save}" class="submit_btn" type="submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
{/block}
