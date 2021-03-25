{block name="style"}
{/block}
{block name="script"}
    <script type="text/javascript">
        $(document).ready(function(){
            $(window).resize(function(){
                $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
            }).resize();
        });
    </script>
{/block}
{block name="content"} 
<div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.forms}</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12 icons-group">

                        <div class="span12 icons-group">

                            <ul>
                                {if $privileges_forms.fkkn == 1 || $user_role == 4 || $privileges_general.employer_signing == 1}
                                    <li><a onclick="navigatePage('{$url_path}pdf/report/work/customer/',8);" href="javascript:void(0);"><div class="administration-icon-export"></div><label>{$translate.employee_work_report_for_customer}</label></a></li>
                                {/if}
                                {if $privileges_forms.leave == 1}
                                    <li><a onclick="navigatePage('{$url_path}pdf/payment/leave/',8);" href="javascript:void(0);"><div class="administration-icon-create-schedule-template"></div><label>{$translate.leave_report}<br></label></a></li>
                                {/if}
                                {if $privileges_forms.leave == 1}
                                    <li><a onclick="navigatePage('{$url_path}pdf/vab/leave/',8);" href="javascript:void(0);"><div class="administration-icon-create-schedule-template"></div><label>{$translate.vab_leave_report}<br></label></a></li> 
                                {/if}
                                {if $privileges_forms.certificate == 1}
                                    <li><a onclick="navigatePage('{$url_path}employment_certification_pdf_form.php',8);" href="javascript:void(0);"><div class="administration-icon-use-template-schedule"></div><label>{$translate.employer_certification}<br></label></a></li>
                                {/if}
                                {*
                                {if $privileges_forms.leave == 1}
                                    <li><a onclick="navigatePage('{$url_path}pdf/annex/leave/',8);" href="javascript:void(0);"><div class="administration-icon-create-schedule-template"></div><label>{$translate.leave_annex_report}<br></label></a></li>
                                {/if)
                                {if $privileges_forms.form_termination == 1}
                                    <li><a onclick="navigatePage('{$url_path}employee/termination/',8);" href="javascript:void(0);"><div class="administration-icon-use-work-settings"></div><label>{$translate.employee_termination_form}<br></label></a></li> 
                                {/if}
                                *}
                                {if $privileges_forms.form_1 == 1 || $privileges_forms.form_2 == 1 || $privileges_forms.form_3 == 1 || $privileges_forms.form_1_report == 1 || $privileges_forms.form_2_report == 1 || $privileges_forms.form_3_report == 1}
                                    <li><a onclick="navigatePage('{$url_path}customer_forms.php',8);" href="javascript:void(0);"><div class="administration-icon-use-work-settings"></div><label>{$translate.customer_forms}<br></label></a></li>
                                {/if}
                            </ul>               
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
{/block}