{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/jquery-ui-new.css" />
    <style>
        .form-group-gray{ overflow-y: auto !important;}
        #vacation_perc_slots .ui-button-text{ width: 20px; }
        #vacation_perc_slots .ui-button-text-only .ui-button-text{ padding: 0.4em 1.1em 0.4em 0.6em !important;}
    </style>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 5px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="pull-left"> <h1 >{$translate.company_information}</h1></div>
                    <div class="pull-right">
                        <button class="btn btn-default pull-right btn-default-border"  type="button" onclick="save_form()">{$translate.save}</button>
                        <button class="btn btn-default pull-right btn-default-border"  type="button" onclick="back_button()">{$translate.back}</button>
                    </div>
                </div>
            </div>
                   <div class="tab-content-con tab-content-con-companysetting">
            <div class="span12 widget-body-section input-group">
                {$message}
                <div class="span12 input-group-wrpr no-ml">
                    <form method="post" action="" name="company_form" id="company_form" class='no-mb' enctype="multipart/form-data">
                        <div class="row-fluid" style="float:left !important; margin:0 0 15px 0">
                            <div class="span4  form-group-gray">
                                <div class="span3">
                                    <img src="{$url_path}company_logo/{$company_detail.logo}"/>
                                </div>
                                <div style="margin:10px 0px 10px 10px !important" class="span5">
                                    <label style="float: left;" class="span12" for="file">{$translate.company_logo}</label>
                                    <div class="btn-file" style="padding:0;"> <i class="glyphicon glyphicon-folder-open"></i><input name="file" id="file" onchange="putFilePath()" class="file" multiple data-show-upload="false" data-show-caption="true" type="file"></div>
                                </div>

                                <div style="margin: 0 ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="name">{$translate.company_name}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_name}" class="form-control span11" value="{$company_detail.name}"  id="name" name="name" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0 !important;" class="span12">
                                    <label style="float: left;" class="span12" for="org_no">{$translate.organization_number}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.organization_number}" class="form-control span11" value="{$company_detail.org_no}"  id="org_no" name="org_no" type="text"> 
                                    </div>
                                </div>

                            </div>

                            <div class="span4  form-group-gray">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person1">{$translate.contact_person_1}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.contact_person_1}" class="form-control span11" value="{$company_detail.contact_person1}"  id="contact_person1" name="contact_person1" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person1_email">{$translate.contact_person_email_1}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.contact_person_email_1}" class="form-control span11" value="{$company_detail.contact_person1_email}"  id="contact_person1_email" name="contact_person1_email" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person2">{$translate.contact_person_2}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.contact_person_2}" class="form-control span11" value="{$company_detail.contact_person2}"  id="contact_person2" name="contact_person2" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="contact_person2_email">{$translate.contact_person_email_2}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.contact_person_email_2}" class="form-control span11" value="{$company_detail.contact_person2_email}"  id="contact_person2_email" name="contact_person2_email" type="email"> 
                                    </div>
                                </div>

                            </div>

                            <div  class="span4  form-group-gray ">
                                <div class="span12" style="margin: 0 !important;">
                                    <label style="float: left;" class="span12">{$translate.salary_system}</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" name="salary_system" id="salary_system">
                                            <option value="">{$translate.select}</option>
                                            <option value="1" {if $company_detail.salary_system == "1"}selected="selected"{/if}>{$translate.salary_type1}</option>
                                            <option value="2" {if $company_detail.salary_system == "2"}selected="selected"{/if}>{$translate.salary_type2}</option>
                                            <option value="3" {if $company_detail.salary_system == "3"}selected="selected"{/if}>{$translate.salary_type3}</option>
                                            <option value="4" {if $company_detail.salary_system == "4"}selected="selected"{/if}>{$translate.salary_type4}</option>
                                            <option value="5" {if $company_detail.salary_system == "5"}selected="selected"{/if}>{$translate.salary_type5}</option>
                                            <option value="6" {if $company_detail.salary_system == "6"}selected="selected"{/if}>{$translate.salary_type6}</option>
                                             <option value="7" {if $company_detail.salary_system == "7"}selected="selected"{/if}>{$translate.salary_type7}</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="price_per_customer">{$translate.price_per_customer}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.price_per_customer}" class="form-control span11" value="{$company_detail.price_per_customer}"  id="price_per_customer" name="price_per_customer" type="text" readonly="readonly" /> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="price_per_sms">{$translate.price_per_sms}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.price_per_sms}" class="form-control span11" value="{$company_detail.price_per_sms}"  id="price_per_sms" name="price_per_sms" type="text" readonly="readonly" /> 
                                    </div>
                                </div>
                                   
                                <div class="span12 form-left">
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.SEM_in_days}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="sem_leave_days">
                                            <button type="button" class="btn {if $company_detail.sem_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                            <button type="button" class="btn {if $company_detail.sem_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.sem_leave_days}" id="sem_leave_days" name="sem_leave_days"/>
                                    </div>
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.VAB_in_days}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="vab_leave_days">
                                            <button type="button" class="btn {if $company_detail.vab_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                            <button type="button" class="btn {if $company_detail.vab_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.vab_leave_days}" id="vab_leave_days" name="vab_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.FP_in_days}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="fp_leave_days">
                                            <button type="button" class="btn {if $company_detail.fp_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                            <button type="button" class="btn {if $company_detail.fp_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.fp_leave_days}" id="fp_leave_days" name="fp_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.NOPAY_in_days}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="nopay_leave_days">
                                            <button type="button" class="btn {if $company_detail.nopay_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                            <button type="button" class="btn {if $company_detail.nopay_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.nopay_leave_days}" id="nopay_leave_days" name="nopay_leave_days"/>
                                    </div>    
                                    <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.OTHER_in_days}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="other_leave_days">
                                            <button type="button" class="btn {if $company_detail.other_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                            <button type="button" class="btn {if $company_detail.other_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.other_leave_days}" id="other_leave_days" name="other_leave_days"/>
                                    </div>    
                                </div>    
                            </div>
                        </div>

                        <div class="row-fluid" style="float:left !important; margin:0 0 15px 0">
                            <div class="span4  form-group-gray ">
                                <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.check_atl}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="atl">
                                        <button class="btn {if $company_detail.atl_check eq 0}active btn-primary{else}btn-default{/if}" type="button" value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.atl_check eq 1}active btn-primary{else}btn-default{/if}" type="button" value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.atl_check}" id="check_atl" name="check_atl"/>
                                </div>
                                <div class="span12" style="margin: 0 !important;">
                                    <label style="float: left;" class="span12">{$translate.company_start_day}</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" name="start_day" id="start_day">
                                            <option value="1" {if $vals[0] == 1}selected="selected"{/if}>{$translate.monday}</option>
                                            <option value="2" {if $vals[0] == 2}selected="selected"{/if}>{$translate.tuesday}</option>
                                            <option value="3" {if $vals[0] == 3}selected="selected"{/if}>{$translate.wednesday}</option>
                                            <option value="4" {if $vals[0] == 4}selected="selected"{/if}>{$translate.thursday}</option>
                                            <option value="5" {if $vals[0] == 5}selected="selected"{/if}>{$translate.friday}</option>
                                            <option value="6" {if $vals[0] == 6}selected="selected"{/if}>{$translate.saturday}</option>
                                            <option value="7" {if $vals[0] == 7}selected="selected"{/if}>{$translate.sunday}</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="start_time">{$translate.company_start_time}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_start_time}" class="form-control span11" value="{$vals[1]}" id="start_time" name="start_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.split_fkkn_for_export}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="fkkn_split">
                                        <button class="btn {if $company_detail.fkkn_split eq 0}active btn-primary{else}btn-default{/if}" type="button" value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.fkkn_split eq 1}active btn-primary{else}btn-default{/if}" type="button" value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.fkkn_split}" id="fkkn_split" name="fkkn_split"/>
                                </div>
                            </div>

                            <div  class="span4  form-group-gray ">
                                <div style="margin: 0px 0px 10px 0 !important;" class="span12" id="advance_leave" {if $company_detail.sem_year_start_month == '' ||$company_detail.sem_year_start_month == null}style="display: none;"{/if}>
                                    <label style="float: left;" class="span12">{$translate.leave_in_advance}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="leave">
                                        <button id="off_btn" class="btn {if $company_detail.leave_in_advance == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button id="on_btn" class="btn {if $company_detail.leave_in_advance == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.leave_in_advance}" id="leave_in_advance" name="leave_in_advance"/>
                                </div>
                                <div class="span12" style="margin: 0 !important;" id="start_month">
                                    <label style="float: left;" class="span12">{$translate.sem_start_month}</label>
                                    <div style="margin: 0 !important; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="sem_start_month" name="sem_start_month" {if $company_detail.leave_in_advance == 0} disabled {/if}>
                                            <option value="" >{$translate.select}</option>
                                            <option value="" >{$translate.select}</option>
                                            <option value="01" {if  $company_detail.sem_year_start_month == 1} selected = "selected" {/if} >{$translate.january}</option>
                                            <option value="02" {if  $company_detail.sem_year_start_month == 2} selected = "selected" {/if}>{$translate.february}</option>
                                            <option value="03" {if  $company_detail.sem_year_start_month == 3} selected = "selected" {/if}>{$translate.march}</option>
                                            <option value="04" {if  $company_detail.sem_year_start_month == 4} selected = "selected" {/if}>{$translate.april}</option>
                                            <option value="05" {if  $company_detail.sem_year_start_month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                            <option value="06" {if  $company_detail.sem_year_start_month == 6} selected = "selected" {/if}>{$translate.june}</option>
                                            <option value="07" {if  $company_detail.sem_year_start_month == 7} selected = "selected" {/if}>{$translate.july}</option>
                                            <option value="08" {if  $company_detail.sem_year_start_month == 8} selected = "selected" {/if}>{$translate.august}</option>
                                            <option value="09" {if  $company_detail.sem_year_start_month == 9} selected = "selected" {/if}>{$translate.september}</option>
                                            <option value="10" {if  $company_detail.sem_year_start_month == 10} selected = "selected" {/if}>{$translate.october}</option>
                                            <option value="11" {if  $company_detail.sem_year_start_month == 11} selected = "selected" {/if}>{$translate.november}</option>
                                            <option value="12" {if  $company_detail.sem_year_start_month == 12} selected = "selected" {/if}>{$translate.december}</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="vacation_perc">{$translate.vacation_percentage}</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.vacation_percentage}" value="{$company_detail.vacation_percentage}" class="form-control span11" id="vacation_perc" name="vacation_perc" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="vacation_perc_slots">{$translate.vacation_percentage_slots}</label>
                                    <div style="margin: 0px;" class="span12">
                                        <div id="vacation_perc_slots" style="padding-left: 0px;">
                                            <input type="checkbox" id="chkVacationPercSlot0" name="vacation_perc_slots[0]" value="1" {if in_array(0, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot0"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-0 slot-icon-small-normal" title="{$translate.normal}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot1" name="vacation_perc_slots[1]" value="1" {if in_array(1, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot1"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-1 slot-icon-small-travel active" title="{$translate.travel}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot2" name="vacation_perc_slots[2]" value="1" {if in_array(2, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot2"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-2 slot-icon-small-break" title="{$translate.break}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot3" name="vacation_perc_slots[3]" value="1" {if in_array(3, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot3"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" title="{$translate.oncall}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot4" name="vacation_perc_slots[4]" value="1" {if in_array(4, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot4"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" title="{$translate.overtime}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot5" name="vacation_perc_slots[5]" value="1" {if in_array(5, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot5"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" title="{$translate.qual_overtime}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot6" name="vacation_perc_slots[6]" value="1" {if in_array(6, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot6"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" title="{$translate.more_time}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot14" name="vacation_perc_slots[14]" value="1" {if in_array(14, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot14"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" title="{$translate.more_oncall}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot7" name="vacation_perc_slots[7]" value="1" {if in_array(7, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot7"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" title="{$translate.some_other_time}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot8" name="vacation_perc_slots[8]" value="1" {if in_array(8, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot8"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-8 slot-icon-small-training" title="{$translate.training_time}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot9" name="vacation_perc_slots[9]" value="1" {if in_array(9, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot9"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" title="{$translate.call_training}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot10" name="vacation_perc_slots[10]" value="1" {if in_array(10, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot10"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" title="{$translate.personal_meeting}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot11" name="vacation_perc_slots[11]" value="1" {if in_array(11, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot11"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" title="{$translate.voluntary}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot12" name="vacation_perc_slots[12]" value="1" {if in_array(12, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot12"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" title="{$translate.complementary}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot13" name="vacation_perc_slots[13]" value="1" {if in_array(13, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot13"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" title="{$translate.complementary_oncall}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot15" name="vacation_perc_slots[15]" value="1" {if in_array(15, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot15"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-15 slot-icon-small-standby" title="{$translate.oncall_standby}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot16" name="vacation_perc_slots[16]" value="1" {if in_array(16, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot16"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" title="{$translate.work_for_dismissal}"></li></ul></label>
                                            <input type="checkbox" id="chkVacationPercSlot17" name="vacation_perc_slots[17]" value="1" {if in_array(17, $vacation_percentage_slots)}checked="TRUE"{/if} />
                                            <label for="chkVacationPercSlot17"><ul class="slot-type-small-icons-group"><li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" title="{$translate.work_for_dismissal_oncall}"></li></ul></label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div style="margin: 0 0 10px !important;" class="span12" id="include_sick_in_sem">
                                    <label style="float: left;" class="span12">{$translate.include_sick_in_sem_calculation}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="include_sick">
                                        <button class="btn {if $company_detail.include_sick == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.include_sick == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.include_sick}" id="include_sick" name="include_sick"/>
                                </div>    
                                <div style="margin: 0 0 10px !important;" class="span12" id="sick_annex_calculation">
                                    <label style="float: left;" class="span12">{$translate.sick_annex_calculation_mode}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="sick_annex_calculation_mode">
                                        <button class="btn {if $company_detail.sick_annex_calculation_mode == 1}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.calculation_mode_1}</button>
                                        <button class="btn {if $company_detail.sick_annex_calculation_mode == 2 or $company_detail.sick_annex_calculation_mode == ''}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.calculation_mode_2}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.sick_annex_calculation_mode}" id="sick_annex_calculation_mode" name="sick_annex_calculation_mode"/>
                                </div>        
                            </div>   

                            <div class="span4  form-group-gray">
                                <div class="span12" style="margin: 0px 0px 10px 0px !important;">
                                    <div style="margin: 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.use_inconvenient}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="inconvenient">
                                            <button class="btn {if $company_detail.inconvenient_on ==0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.inconvenient_on ==1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.inconvenient_on}"  id="chk_inconvenient_on" name="chk_inconvenient_on"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.candg_on_off}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="candg_on">
                                            <button class="btn {if $company_detail.candg_on == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.candg_on == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.candg_on}"  id="candg_on" name="candg_on"/>
                                    </div>
                                </div>
                               
                                
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12 ">
                                    <div style="margin: 0px 0px 0px 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.sort_by}</label>
                                        <div class="btn-group btn-toggle" style="float: left; margin: 0px !important;" purpose="sort">
                                            <button class="btn {if $company_detail.sort_name_by == 2}active btn-primary{else}btn-default{/if}" type="button" value="ON">{$translate.last_name_sort_by}</button>
                                            <button class="btn {if $company_detail.sort_name_by == 1}active btn-primary{else}btn-default{/if}" type="button" value="OFF">{$translate.first_name_sort_by}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.sort_name_by}" id="sortby_fn" name="sort_by"/>
                                    </div>    

                                    <div style="margin: 0px !important;" class="span6 candg_status">
            
                                        <label style="float: left;" class="span12">{$translate.come_and_go_break}</label>
                                        <div class="btn-group btn-toggle span6" style="float: left; margin: 0px !important;" purpose="candg_break">
                                            <button class="btn {if $company_detail.candg_break == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.candg_break != 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                            <input type="hidden" value="{$company_detail.candg_break}" id="candg_break_switch" name="candg_break_switch"/>
                                        </div>
                                        
                                        <div class="span6 count-slider" style="margin:0px !important" id="sliderdiv">
                                            <div class="span9" style="padding: 8px 0px 0px 5px;"><div id="slider"></div></div>                           
                                            <div class="span3"><input type="textbox" id="sliderValue" name="slider_txt_candg_break" class="textboxes count-slider-value" style="width: 100%" value="{if $company_detail.candg_break}{$company_detail.candg_break}{else}4{/if}"></div> 
                                        </div>
                                        
                                    </div>

                                </div>
                                
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">

                                    <div style="margin: 0px 0px 0px 0px !important;" class="span6">
                                        <label style="float: left;" class="span12">{$translate.include_karense_salary}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="include_karense_salary">
                                            <button class="btn {if $company_detail.include_karense_salary ==0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.include_karense_salary ==1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.include_karense_salary}"  id="chk_include_karense_salary" name="chk_include_karense_salary"/>
                                    </div>

                                    <div style="margin: 0px 0px 0px 0!important;" class="span6 candg_status">
                                        <label style="float: left;" class="span12">{$translate.candg_with_slots}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="candg">
                                            <button class="btn {if $company_detail.candg == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.candg == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.candg}"  id="candg" name="candg"/>
                                    </div>
                                </div> 
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">   
                                    <div style="margin: 0px 0px 0px 0!important;" class="span12" >
                                        <label style="float: left;" class="span12">{$translate.include_sem_2_14_oncall_salary}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="include_sem_2_14_oncall_salary">
                                            <button class="btn {if $company_detail.include_sem_2_14_oncall_salary == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.include_sem_2_14_oncall_salary == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.include_sem_2_14_oncall_salary}"  id="chk_include_sem_2_14_oncall_salary" name="chk_include_sem_2_14_oncall_salary"/>
                                    </div>
                                </div>    
                                <div style="margin: 0px 0px 10px 0!important;" class="span12" >
                                    <div style="margin: 0px 0px 0px 0!important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.sick_15_90_oncall}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="sick_15_90_oncall">
                                            <button class="btn {if $company_detail.sick_15_90_oncall eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.sick_15_90_oncall neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.sick_15_90_oncall}"  id="sick_15_90_oncall" name="sick_15_90_oncall"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.kfo}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="kfo">
                                            <button class="btn {if $company_detail.kfo == 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.kfo == 1}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.kfo}"  id="kfo" name="kfo"/>
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0!important;" class="span12" >
                                    <div style="margin: 0px 0px 0px 0!important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.karens_full}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="karens_full">
                                            <button class="btn {if $company_detail.karens_full eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.karens_full neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.karens_full}"  id="karens_full" name="karens_full"/>
                                    </div>
                                    <div style="margin: 0px !important;" class="span6" >
                                        <label style="float: left;" class="span12">{$translate.karens}</label>
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="karens">
                                            <button class="btn {if $company_detail.karens eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.karens neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.karens}"  id="karens" name="karens"/>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row-fluid">                              

                            <div class="span4  form-group-gray " id="1">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="company_box">{$translate.company_box}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_box}" class="form-control span11" value="{$company_detail.box}"  id="company_box" name="company_box" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="address">{$translate.company_address_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_address_new}" class="form-control span11" value="{$company_detail.address}"  id="address" name="address" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="city">{$translate.company_city_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_city_new}" class="form-control span11" value="{$company_detail.city}"  id="city" name="city" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="zipcode">{$translate.company_zipcode_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_zipcode_new}" class="form-control span11" value="{$company_detail.zipcode}"  id="zipcode" name="zipcode" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="land_code">{$translate.company_land_code_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_land_code_new}" class="form-control span11" value="{$company_detail.land_code}"  id="land_code" name="land_code" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="phone">{$translate.company_phone_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_phone_new}" class="form-control span11" value="{$company_detail.phone}"  id="phone" name="phone" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="mobile">{$translate.company_mobile_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_mobile_new}" class="form-control span11" value="{$company_detail.mobile}"  id="mobile" name="mobile" type="text"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="email">{$translate.company_email_new}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_email_new}" class="form-control span11" value="{$company_detail.email}"  id="email" name="email" type="email"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="website">{$translate.company_website}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.company_website}" class="form-control span11" id="website" name="website" type="text" value="{$company_detail.website}"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.bank_account}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.bank_account}" class="form-control span11" id="bank_account" name="bank_account" type="text" value="{$company_detail.bank_account}"> 
                                    </div>
                                </div>

                            </div>

                            <div  class="span4  form-group-gray">
                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="fk_kr_per_time">FK {$translate.kr_per_time}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="FK {$translate.kr_per_time}" class="form-control span11" value="{$company_detail.fk_kr_per_time}"  id="fk_kr_per_time" name="fk_kr_per_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="kn_kr_per_time">KN {$translate.kr_per_time}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="KN {$translate.kr_per_time}" class="form-control span11" value="{$company_detail.kn_kr_per_time}"  id="kn_kr_per_time" name="kn_kr_per_time" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="weekly_hour">{$translate.weekly_hour}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>

                                        <input placeholder="{$translate.weekly_hour}" class="form-control span11" value="{$company_detail.weekly_hour}"  id="weekly_hour" name="weekly_hour" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="montly_oncall_hour">{$translate.monthly_oncall_hour}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.monthly_oncall_hour}" class="form-control span11" value="{$company_detail.monthly_oncall_hour}"  id="montly_oncall_hour" name="montly_oncall_hour" type="text"> 
                                    </div>
                                </div>



                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="max_daily_hour">{$translate.max_daily_hour}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.max_daily_hour}" class="form-control span11" value="{$company_detail.max_daily_hour}"  id="max_daily_hour" name="max_daily_hour" type="text"> 
                                    </div>
                                </div>

                                <div style="margin: 0px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="max_daily_hour">{$translate.min_daily_rest}</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon icon-pencil"></span>
                                        <input placeholder="{$translate.min_daily_rest}" class="form-control span11" value="{$company_detail.min_daily_rest}"  id="min_daily_rest" name="min_daily_rest" type="text"> 
                                    </div>
                                </div>

                            </div>


                            <div class="span4  form-group-gray">
                                <div class="span12" style="margin: 0px !important;" id="contract_start_month_div">
                                    <label style="float: left;" class="span12">{$translate.employee_contract_start_month}</label>
                                    <div class="input-prepend span5" style="margin:0 !important; float: left;"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="contract_start_month" name="contract_start_month">
                                            <option value="" >{$translate.select}</option>
                                            <option value="01" {if  $company_detail.employee_contract_start_month == 1} selected = "selected" {/if} >1. {$translate.january}</option>
                                            <option value="02" {if  $company_detail.employee_contract_start_month == 2} selected = "selected" {/if}>2. {$translate.february}</option>
                                            <option value="03" {if  $company_detail.employee_contract_start_month == 3} selected = "selected" {/if}>3. {$translate.march}</option>
                                            <option value="04" {if  $company_detail.employee_contract_start_month == 4} selected = "selected" {/if}>4. {$translate.april}</option>
                                            <option value="05" {if  $company_detail.employee_contract_start_month == 5} selected = "selected" {/if}>5. {$translate.may}</option>
                                            <option value="06" {if  $company_detail.employee_contract_start_month == 6} selected = "selected" {/if}>6. {$translate.june}</option>
                                            <option value="07" {if  $company_detail.employee_contract_start_month == 7} selected = "selected" {/if}>7. {$translate.july}</option>
                                            <option value="08" {if  $company_detail.employee_contract_start_month == 8} selected = "selected" {/if}>8. {$translate.august}</option>
                                            <option value="09" {if  $company_detail.employee_contract_start_month == 9} selected = "selected" {/if}>9. {$translate.september}</option>
                                            <option value="10" {if  $company_detail.employee_contract_start_month == 10} selected = "selected" {/if}>10. {$translate.october}</option>
                                            <option value="11" {if  $company_detail.employee_contract_start_month == 11} selected = "selected" {/if}>11. {$translate.november}</option>
                                            <option value="12" {if  $company_detail.employee_contract_start_month == 12} selected = "selected" {/if}>12. {$translate.december}</option>
                                        </select>
                                    </div>

                                    <div class="input-prepend span5" style="margin: 0px !important; float: right;"> 
                                        <select class="form-control span5" id="contract_month_start_date" name="contract_month_start_date">
                                            {for $month_date=1 to 31}
                                                <option value="{$month_date}" {if  $company_detail.employee_contract_period_date eq $month_date} selected = "selected" {/if} >{$month_date}</option>
                                            {/for}
                                        </select>
                                    </div>
                                </div>

                                <div class="span12" style="margin: 0 !important;" id="emp_contract_period_length_div">
                                    <label style="float: left;" class="span12">{$translate.employee_contract_period_length}</label>
                                    <div style="margin-left: 0px; float: left; width: 50%;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="emp_contract_period_length" name="emp_contract_period_length">
                                            <option value="01" {if $company_detail.employee_contract_period_length eq 1} selected = "selected" {/if}>1</option>
                                            <option value="02" {if $company_detail.employee_contract_period_length eq 2} selected = "selected" {/if}>2</option>
                                            <option value="03" {if $company_detail.employee_contract_period_length eq 3} selected = "selected" {/if}>3</option>
                                            <option value="04" {if $company_detail.employee_contract_period_length eq 4} selected = "selected" {/if}>4</option>
                                            <option value="05" {if $company_detail.employee_contract_period_length eq 5} selected = "selected" {/if}>5</option>
                                            <option value="06" {if $company_detail.employee_contract_period_length eq 6 or $company_detail.employee_contract_period_length eq ''} selected = "selected" {/if}>6</option>
                                            <option value="07" {if $company_detail.employee_contract_period_length eq 7} selected = "selected" {/if}>7</option>
                                            <option value="08" {if $company_detail.employee_contract_period_length eq 8} selected = "selected" {/if}>8</option>
                                            <option value="09" {if $company_detail.employee_contract_period_length eq 9} selected = "selected" {/if}>9</option>
                                            <option value="10" {if $company_detail.employee_contract_period_length eq 10} selected = "selected" {/if}>10</option>
                                            <option value="11" {if $company_detail.employee_contract_period_length eq 11} selected = "selected" {/if}>11</option>
                                            <option value="12" {if $company_detail.employee_contract_period_length eq 12} selected = "selected" {/if}>12</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.check_contract}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="contract">
                                        <button class="btn {if $company_detail.contract_exceed_check eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.contract_exceed_check neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.contract_exceed_check}" id="check_contract" name="check_contract"/>
                                </div>        
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.signing_mail}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="signing">
                                        <button class="btn {if $company_detail.signing_mail eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.signing_mail neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.signing_mail}" id="signing_mail" name="signing_mail"/>
                                </div>        
                                <!-- <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.apply_max_karens}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="apply_max_karens">
                                        <button class="btn {if $company_detail.apply_max_karens eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.apply_max_karens neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.apply_max_karens}" id="apply_max_karens" name="apply_max_karens"/>
                                </div>    --> 
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.contract_auto_renewal}</label>
                                    <div class="no-ml">
                                        <div class="btn-group btn-toggle" style="float: left;" purpose="contract_auto_renewal">
                                            <button class="btn {if $company_detail.contract_auto_renewal eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                            <button class="btn {if $company_detail.contract_auto_renewal neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                        </div>
                                        <input type="hidden" value="{$company_detail.contract_auto_renewal}" id="contract_auto_renewal" name="contract_auto_renewal"/>
                                    </div>
                                        <div class="span6 ml div_contract_auto_renewal_mail" id="div_contract_auto_renewal_mail" {if $company_detail.contract_auto_renewal neq 1}style="display: none;"{/if}>
                                        <input type="email" id="contract_auto_renewal_mail" name="contract_auto_renewal_mail" class="span12" value="{if $company_detail.contract_auto_renewal eq 1}{$company_detail.contract_auto_renewal_mail}{/if}" title="{$translate.email}" placeholder="{$translate.email}"> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.day_light_saving}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="day_light_saving">
                                        <button class="btn {if $company_detail.day_light_saving eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.day_light_saving neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.day_light_saving}" id="day_light_saving" name="day_light_saving"/>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.sms_pw_recovery}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="sms_pw_recovery">
                                        <button class="btn {if $company_detail.recovery_pw_by_mobile eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.recovery_pw_by_mobile neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.recovery_pw_by_mobile}" id="sms_pw_recovery" name="sms_pw_recovery"/>
                                </div>
                                <div style="margin: 0px 0px 10px 0px !important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.contact_mail_send}</label>
                                    <div class="btn-group btn-toggle" style="float: left;" purpose="contact_mail_send">
                                        <button class="btn {if $company_detail.mail_send_to_contact_person eq 0}active btn-primary{else}btn-default{/if}" type="button"  value="OFF">{$translate.off}</button>
                                        <button class="btn {if $company_detail.mail_send_to_contact_person neq 0}active btn-primary{else}btn-default{/if}" type="button"  value="ON">{$translate.on}</button>
                                    </div>
                                    <input type="hidden" value="{$company_detail.mail_send_to_contact_person}" id="contact_mail_send" name="contact_mail_send"/>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <label style="margin-bottom:10px !important;"> </label>
    </div>
{/block}

{block name='script'}
    <script src="{$url_path}js/nice-scroll.js"></script>
    <script src="{$url_path}js/jquery-ui.js"></script>
    <script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
    <script>
        function save_form() {

            bootbox.dialog('{$translate.company_edit_save_alert_message}', [
            {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
            },
             {                          //// bootbox alert /////
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    save_form_proceed();
                }
             }
          ]);
        }

        function save_form_proceed(){
            var error = 0;
            if($('#contract_auto_renewal').val() == 1){
                if(!isEmail($.trim($('#contract_auto_renewal_mail').val()))){
                    error = 1;
                    alert('{$translate.enter_valid_email}');
                    $('#contract_auto_renewal_mail').focus();
                }
            }
            if(error == 0){
                $("#company_form").submit();
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{ldelim}2,4{rdelim})+$/;
            return regex.test(email);
        }
        function back_button() {
            document.location.href = "{$url_path}administration/";
        }

        function putFilePath() {
            var file_path = $("#file").val();
            $("#browsed").val(file_path);
        }
                            
        $(document).ready(function() {
            $('.success, .message, .fail, .error').delay(10000).fadeOut();
            $(".atgargslista").hide();
            $(".btn-Utrustning").click(function() {
                $(".Utrustning").css('display', 'block');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '38%%');
                $(".main-right").css('display', 'block');
            });
            $("#on_btn").click(function(){
                $("#sem_start_month").prop("disabled", false);
            });
        
            $("#off_btn").click(function(){
                $("#sem_start_month").prop("disabled", true);
                $('#sem_start_month').prop('selectedIndex',0);
            });
        });

        $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-primary').size() > 0) {
                $(this).find('.btn').toggleClass('btn-primary');

                if ($(this).find('.btn-primary').val() == "ON") {
                    if ($(this).attr("purpose") == "atl")
                        $('#check_atl').val(1);
                    else if ($(this).attr("purpose") == "fkkn_split")
                        $('#fkkn_split').val(1);
                    else if ($(this).attr("purpose") == "leave")
                        $('#leave_in_advance').val(1);
                    else if ($(this).attr("purpose") == "inconvenient")
                        $('#chk_inconvenient_on').val(1);
                    else if ($(this).attr("purpose") == "include_karense_salary")
                        $('#chk_include_karense_salary').val(1);
                    else if ($(this).attr("purpose") == "include_sem_2_14_oncall_salary")
                        $('#chk_include_sem_2_14_oncall_salary').val(1);
                    else if ($(this).attr("purpose") == "candg")
                        $('#candg').val(1);
                    else if ($(this).attr("purpose") == "candg_on"){
                        $('#candg_on').val(1);
                        $(".candg_status").show();
                    }
                    else if ($(this).attr("purpose") == "candg_break"){
                        $('#candg_break_switch').val(1);
                        $("#sliderdiv").show();
                    }
                    else if ($(this).attr("purpose") == "sort")
                        $('#sortby_fn').val(2);
                    else if ($(this).attr("purpose") == "contract")
                        $('#check_contract').val(1);
                    else if ($(this).attr("purpose") == "signing")
                        $('#signing_mail').val(1);
                    else if ($(this).attr("purpose") == "apply_max_karens")
                        $('#apply_max_karens').val(1);
                    else if ($(this).attr("purpose") == "day_light_saving")
                        $('#day_light_saving').val(1);
                    else if ($(this).attr("purpose") == "sms_pw_recovery")
                        $('#sms_pw_recovery').val(1);
                    else if ($(this).attr("purpose") == "contact_mail_send")
                        $('#contact_mail_send').val(1);
                    else if ($(this).attr("purpose") == "sick_15_90_oncall")
                        $('#sick_15_90_oncall').val(1);
                    else if ($(this).attr("purpose") == "contract_auto_renewal"){
                        $('#contract_auto_renewal').val(1);
                        $('#div_contract_auto_renewal_mail').show();
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "include_sick") {
                        $('#include_sick').val(1);
                    }
                    else if ($(this).attr("purpose") == "sick_annex_calculation_mode") {
                        $('#sick_annex_calculation_mode').val(2);
                    }else if ($(this).attr("purpose") == "kfo") {
                        $('#kfo').val(1);
                    }else if ($(this).attr("purpose") == "karens_full") {
                        $('#karens_full').val(1);
                    }else if ($(this).attr("purpose") == "karens") {
                        $('#karens').val(1);
                    }
                }
                else if ($(this).find('.btn-primary').val() == "OFF") {
                    if ($(this).attr("purpose") == "atl")
                        $('#check_atl').val(0);
                    else if ($(this).attr("purpose") == "fkkn_split")
                        $('#fkkn_split').val(0);
                    else if ($(this).attr("purpose") == "leave")
                        $('#leave_in_advance').val(0);
                    else if ($(this).attr("purpose") == "inconvenient")
                        $('#chk_inconvenient_on').val(0);
                    else if ($(this).attr("purpose") == "include_karense_salary")
                        $('#chk_include_karense_salary').val(0);
                    else if ($(this).attr("purpose") == "include_sem_2_14_oncall_salary")
                        $('#chk_include_sem_2_14_oncall_salary').val(0);
                    else if ($(this).attr("purpose") == "candg")
                        $('#candg').val(0);
                    else if ($(this).attr("purpose") == "candg_on"){
                        $('#candg_on').val(0);
                        $(".candg_status").hide();
                    }
                    else if ($(this).attr("purpose") == "candg_break"){
                        $('#candg_break_switch').val(0);
                        $("#sliderdiv").hide();
                    }    
                    else if ($(this).attr("purpose") == "sort")
                        $('#sortby_fn').val(1);
                    else if ($(this).attr("purpose") == "contract")
                        $('#check_contract').val(0);
                    else if ($(this).attr("purpose") == "signing")
                        $('#signing_mail').val(0);
                    else if ($(this).attr("purpose") == "apply_max_karens")
                        $('#apply_max_karens').val(0);
                    else if ($(this).attr("purpose") == "day_light_saving")
                        $('#day_light_saving').val(0);
                    else if ($(this).attr("purpose") == "sms_pw_recovery")
                        $('#sms_pw_recovery').val(0);
                    else if ($(this).attr("purpose") == "contact_mail_send")
                        $('#contact_mail_send').val(0);
                    else if ($(this).attr("purpose") == "sick_15_90_oncall")
                        $('#sick_15_90_oncall').val(0);
                    else if ($(this).attr("purpose") == "contract_auto_renewal"){
                        $('#contract_auto_renewal').val(0);
                        $('#div_contract_auto_renewal_mail').hide();
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "include_sick") {
                        $('#include_sick').val(0);
                    }
                    else if ($(this).attr("purpose") == "sick_annex_calculation_mode") {
                        $('#sick_annex_calculation_mode').val(1);
                    }else if ($(this).attr("purpose") == "kfo") {
                        $('#kfo').val(0);
                    }else if ($(this).attr("purpose") == "karens_full") {
                        $('#karens_full').val(0);
                    }else if ($(this).attr("purpose") == "karens") {
                        $('#karens').val(0);
                    }
                }
            }
            if ($(this).find('.btn-danger').size() > 0) {
                $(this).find('.btn').toggleClass('btn-danger');
            }
            if ($(this).find('.btn-success').size() > 0) {
                $(this).find('.btn').toggleClass('btn-success');
            }
            if ($(this).find('.btn-info').size() > 0) {
                $(this).find('.btn').toggleClass('btn-info');
            }
            //alert($('#apply_max_karens').val());
            $(this).find('.btn').toggleClass('btn-default');

        });

        $(document).ready(function() {
            var candg_on_show_option = '{$company_detail.candg_on}';
            var slider_show_option = '{$company_detail.candg_break}';
            var slider_init_val = 4;
            if (slider_show_option != 0){
                slider_init_val = slider_show_option;
                $("#sliderValue").val(slider_init_val);
            }
            
            $("#slider").slider({
                range: "min",
                value: slider_init_val,
                min: 1,
                max: 24,
                step: 1,
                slide: function(event, ui) {
                    $("#sliderValue").val(ui.value);

                }
            });
            
            if(candg_on_show_option == 0){
                $(".candg_status").hide();
            }else{
                $(".candg_status").show();
                
            }

            if(slider_show_option == 0){
                $("#sliderdiv").hide();
            }else{
                $("#sliderdiv").show();
                
            }
            
            $( "#vacation_perc_slots" ).buttonset();
            
            if($(window).height() > 350)
                $('.tab-content-con-companysetting').css({ height: $(window).innerHeight()-95 });
            
            $(window).resize(function(){
                if($(window).height() > 350)
                    $('.tab-content-con-companysetting').css({ height: $(window).innerHeight()-95 });
            });
        });
    </script>
{/block}