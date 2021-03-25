{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
{/block}

{block name="content"}
    <div class="row-fluid">

        <div class="span12 main-left slot-form" data-mcs-theme="dark">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.reports} </h1>
                </div>
                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                    <div class="row-fluid">
                        <div class="span6">
                            <div style="margin: 0px ! important;" class="widget">
                                <div class="widget-header span12">
                                    <h1>{$translate.employee_report}</h1>
                                </div>
                                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                                    <div class="row-fluid">
                                        <div class="span12" style="margin:0 !important;">
                                            <div class="row-fluid reporter-items-wrpr">
                                                {if $privileges_reports.employee_data == 1}<div class="span12" ><a href="{$url_path}report/data/employee/"><img src="{$url_path}images/icon-6.png"> {$translate.employee_data}</a></div>{/if}
                                                {if $privileges_reports.employee_leave == 1}<div class="span12"><a href="{$url_path}report/leave/employee/"><img src="{$url_path}images/icon-2.png">{$translate.employee_abssence_report}</a></div>{/if}
                                                {if $privileges_reports.employee_percentage == 1}<div class="span12"><a href="{$url_path}report/perofemployement/"><img src="{$url_path}images/icon-3.png">{$translate.percentage_of_employment}</a></div>{/if}
                                                {if $privileges_reports.atl_warning == 1}<div class="span12"><a href="javascript:void(0);" onclick="click_atl()" ><img src="{$url_path}images/breaking_law2.png">{$translate.atl_warning}</a></div>{/if}
                                                {if $privileges_reports.employee_schedule == 1}<div class="span12"><a href="{$url_path}report/month/week/employee/"><img src="{$url_path}images/icon-4.png">{$translate.working_hours_month}</a></div>{/if}
                                                <div class="span12" ><a href="{$url_path}report/work/employee/list/{$last_year}/M-{$last_month}/"><img src="{$url_path}images/icon-5.png">{$translate.monthly_signing}</a></div>
                                                <div class="span12" ><a href="{$url_path}employee/report/contract/{$current_year}/1/"><img src="{$url_path}images/employee_contract_report.png">{$translate.employee_contract_report}</a></div>
                                                {if $role eq 1}<div class="span12" ><a href="{$url_path}report/log/sms/"><img src="{$url_path}images/icon_sms_log_rpt.png"> {$translate.sms_log_report}</a></div>{/if}
                                                {if $role eq 1}<div class="span12" ><a href="{$url_path}report/work/employee/signed/list/"><img src="{$url_path}images/icon-5.png"> {$translate.signing_report}</a></div>{/if}
                                                {if $role eq 1}<div class="span12" ><a href="{$url_path}employee_attendance_day.php"><img src="{$url_path}images/icon-11.png"> {$translate.employee_attendance}</a></div>{/if}
                                                {if $privileges_reports.employee_available == 1}<div class="span12" ><a href="{$url_path}report/available/employees/"><img src="{$url_path}images/icon_avail_emp_rpt.png"> {$translate.available_employees_report}</a></div>
                                                {/if}

                                                {if $role eq 1 or $role eq 6}
                                                <div class="span12" ><a href="{$url_path}contract/employee/report/list/"><img src="{$url_path}images/icon_contract_emp_rpt.png">{$translate.report_contract_employees}</a></div>
                                                {/if}
                                                {if $privileges_reports.employee_skill == 1}
                                                    <div class="span12" ><a href="{$url_path}employee/cv/report/"><img src="{$url_path}images/icon_contract_emp_rpt.png">{$translate.employee_skill_report}</a></div>
                                                {/if}
                                                {if $role eq 1 or $role eq 6}
                                                    <div class="span12" ><a href="{$url_path}documents/sign/reports/"><img src="{$url_path}images/icon_contract_emp_rpt.png"> {$translate.document_sign_report}</a></div>
                                                    {*<div class="span12" ><a href="{$url_path}report/preferred/time/employees/"><img src="{$url_path}images/icon_contract_emp_rpt.png"> {$translate.employee_preferred_time}</a></div>*}
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </div><!--WIDGET BODY END-->
                            </div>
                        </div>
                        <div class="span6">
                            {if $privileges_reports.customer_data == 1 || $privileges_reports.customer_leave == 1 || $privileges_reports.customer_granded_vs_used || $privileges_reports.customer_employee_connection || $privileges_reports.customer_schedule == 1 || $role == 4 || $privileges_reports.customer_horizontal == 1 || $privileges_reports.customer_overview == 1 || $privileges_reports.customer_vacation_planning == 1 || $privileges_reports.customer_overlapping == 1}
                            <div style="margin: 0px" class="widget kund-reporter">
                                <div class="widget-header span12">
                                    <h1>{$translate.customer_report}</h1>
                                </div>
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section input-group">

                                    <div class="row-fluid">
                                        <div class="span12" style="margin:0 !important;">
                                            <div class="row-fluid reporter-items-wrpr">
                                                {if $privileges_reports.customer_data == 1}<div class="span12"><a href="{$url_path}report/data/customer/"><img src="{$url_path}images/icon-6.png">{$translate.customer_data}</a></div>{/if}
                                                {if $privileges_reports.customer_leave == 1}<div class="span12" ><a href="{$url_path}report/leave/customer/"><img src="{$url_path}images/icon-7.png">{$translate.customer_abssence_report}</a></div>{/if}
                                                {if $privileges_reports.customer_granded_vs_used == 1}<div class="span12"><a href="{$url_path}report/filter/date/customer/"><img src="{$url_path}images/icon-8.png">{$translate.granted_vs_used_hours}</a></div>{/if}
                                                {if $privileges_reports.customer_employee_connection == 1}<div class="span12"><a href="{$url_path}report/employeetocustomer/"><img src="{$url_path}images/icon-9.png">{$translate.employee_to_customer}</a></div>{/if}
                                                {if $privileges_reports.customer_schedule == 1 || $role == 4}<div class="span12"><a href="{$url_path}report/month/week/customer/"><img src="{$url_path}images/icon-4.png">{$translate.working_hoursmonth}</a></div>{/if}
                                                {if $privileges_reports.customer_horizontal == 1}<div class="span12" ><a href="{$url_path}report/horizontal/customer/"><img src="{$url_path}images/horizontal.png">{$translate.horizontal_customer_report}</a></div>{/if}
                                                {if $privileges_reports.customer_overview == 1}<div class="span12" ><a href="{$url_path}hourly/customer/report/"><img src="{$url_path}images/hour.png">{$translate.hourly_customer_report}</a></div>{/if}
                                                {if $privileges_reports.customer_vacation_planning == 1}<div class="span12"><a href="{$url_path}vacation/planning/report/"><img src="{$url_path}images/vacation.png">{$translate.vacation_plannning_report}</a></div>{/if}
                                                {if $privileges_reports.customer_overlapping == 1}<div class="span12" ><a href="{$url_path}customer/overlap/report/"><img src="{$url_path}images/overlapped_report.png">{$translate.overlapp_report}</a></div>{/if}
                                                {if $role eq 1 or $role eq 6}<div class="span12" ><a href="{$url_path}report/search/on/customer/"><img src="{$url_path}images/icon_search_cus_data.png"> {$translate.search_customer_by_data}</a></div>{/if}
                                            </div>
                                        </div><!--WIDGET BODY END-->
                                    </div>
                                </div>
                            </div>
                           {/if}                 
                        </div><!--WIDGET BODY END-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{/block}

   

{block name='script'}
<script type="text/javascript">
$(document).ready(function(){

    });
function click_atl(){
    $('#loading').show();
    //document.location.href = "{$url_path}atl/warning/";
    var win = window.open("{$url_path}atl/warning/", '_blank');
    win.focus();
}    
</script>
{/block}
