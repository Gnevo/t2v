{block name="style"}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link href="{$url_path}css/TableCSSCode.css" rel="stylesheet" type="text/css" />
{*    <link rel="stylesheet" type="text/css" href="{$url_path}css/datepicker_btstrap.css?v={filemtime('css/datepicker_btstrap.css')}" media="all" />*}
    <style type="text/css">
        .signing_for_main{ width:234px;  padding:0px;  border:solid 1px #c9f2fb; }
        .signing_for_inner{ padding-right:10px; padding-top:5px; }
        .signing_remove_main{ padding-bottom:3px; width:234px; float:right; height:30px; border-bottom:solid 1px #c9f2fb; }
        .signing_form_label{ width:92px; float:left; display:block; padding-left:8px; }
        .signing_form_text{ float:left; width: 122px; }
        .signing_button{ padding-bottom:2px; padding-top:2px; }
        span.signed_user{ color: green; float: left; }
        span.signed_user.bankID{ color: #510080 !important; }
        span.signing_delete { color: red; float: left; font-weight: bold; padding-right: 20px; padding-top: 5px; }
        span.signing_bug { color: red; float: left; font-weight: bold; padding: 5px 20px; }
        .signing_bug_main{ padding-bottom:3px; /*width:234px;*/ float:right; height:auto; border-bottom:solid 1px #c9f2fb; }
        #kunder_info_strip .info_name { width: 31.7% !important }
        #kunder_info_strip .info_name b { margin-left: 5px; }
        ul.weeks li:hover { background-image: none; }
        .cursor_hand { cursor: pointer; }
        .box-wrpr { margin-top: 10px; background: #BEEAFF none repeat scroll 0% 0%;float: left;height: 160px;overflow: auto;overflow-x: hidden;padding: 5px;border: solid thin #7FD0EA; }
        ul.list-bank-id>li { margin: 10px; }
        ul.list-bank-id>li:nth-of-type(odd) { background-color: #FFF;}
        .box-wrpr.success-bg { background: #E4FFDA none repeat scroll 0% 0% !important;border: solid thin #A6E7A6;}
        .highlight-link { color: #2D2DCE;cursor: pointer;text-decoration: underline; }
        
        .highlight-link:hover, .highlight-link:focus { color:red; }

        .box-wrpr.type { background: #FFDBC7 none repeat scroll 0% 0% !important;border: thin solid #FFC3A1; } 

        @media screen and (max-width: 767px) { .height-auto { height: auto !important; min-height: auto !important; } }
        #leave_comments { padding: 13px 10px 5px 10px; margin: 0px; }
        #leave_comments ul li{ color: #bb5858; margin-bottom: 10px;border-bottom: 1px dashed #ccc; }
        #leave_comments ul li b{ color: #826e6e; }
        #leave_comments h4{ text-decoration: underline !important; margin-bottom: 12px; }
    </style>
{/block}

{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
    {$message}    
{if $flag_emp_access == 1}
    <div class="tbl_hd height-auto" ><span class="titles_tab">{$translate.employee_monthly_report}</span>
    <a href="{$back_url}" class="back pull-right"><span class="btn_name">{$translate.backs}</span></a>
    <a onclick="printForm()" href="javascript:void(0)" class="print pull-right"><span class="btn_name">{$translate.print}</span></a>
    <div class="clearfix"></div>
</div>

<div class="monthly_customerdetails span12 clearfix" style="padding:0px; margin:0px;">
    <div style="float:left; margin-top: 9px;">
        <p class="ml"> 
            {$translate.customer}
            <select style="width: 183px" id="cmb_customer" name="cmb_customer">
                <option value="">{$translate.select}</option>
                {foreach $list_customers as $s_customer}
                    <option value="{$s_customer.username}" {if $s_customer.username eq $customer_id}selected='selected'{/if}>{if $sort_by_name == 1}{$s_customer.first_name|cat:' '|cat:$s_customer.last_name}{elseif $sort_by_name == 2}{$s_customer.last_name|cat:' '|cat:$s_customer.first_name}{/if}</option>
                {/foreach}
            </select>
        </p>
    </div>
    <div style="float:right;margin-top: 9px;">
        <div style="border-radius:7px;" class="week_strip clearfix">
            <div style="float:left;" class="arrow_left cursor_hand" title="{$translate.tltp_goto_previous_month}"><a style="border-radius:5px 0 0 5px;" href="{$url_path}report/work/employee/detail/{$prv_year}/{$prv_month}/{$employee_id}/{$customer_id}/"></a> </div>
            <ul style="float:left;" class="weeks"><li style="width:auto; padding:2px 30px;" class="week_class"><a>{$month_name} {$report_year}</a></li></ul>
            <div style="float:left;" class="arrow_right cursor_hand" title="{$translate.tltp_goto_next_month}"><a style="border-radius:0 5px 5px 0;" href="{$url_path}report/work/employee/detail/{$next_year}/{$next_month}/{$employee_id}/{$customer_id}/"></a> </div>
        </div>
    </div>
    <div class="clearfix" colspan="1" style="float:right; width: 44px; text-align: center;" {*id="dp3" data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm"*}>
        <span id="dp3" class="cursor_hand clearfix"  data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm" style="margin-top: 9px;"><img src="{$url_path}images/calendar_btstrap.png" alt='calendar' title="{$translate.tltp_select_year_month}"/></span>
{*        <i  class="icon-calendar" data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm" title="{$translate.tltp_select_year_month}" ></i>*}
    </div>
</div>
    
{if ($login_user_role eq 1 OR $login_user_role eq 2 OR $login_user_role eq 3 OR $login_user_role eq 7) and ($rpt_content_normal or $rpt_content_travel or $rpt_content_break or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_voluntary or $rpt_content_complementary or $rpt_content_standby or $rpt_content_complementary_oncall or $rpt_content_more_oncall or $rpt_content_standby_oncall or $rpt_content_leave_travel or $rpt_content_leave_break or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_voluntary or $rpt_content_leave_oncall or $rpt_content_leave_calltraining or $rpt_content_leave_more_oncall or $rpt_content_leave_standby_oncall or $rpt_content_leave_standby or $rpt_content_dismissal or $rpt_content_dismissal_oncall)}    
    <div class="row-fluid">
    <div id="emp_login" name="emp_login" class="span12" style="overflow: hidden;">
        <div class="span5" id="signed_list">
            <div class="box-wrpr type span12">
            <span id="span_emp_sign"  class="span12 clearfix no-ml mb">
                {if $signing_details.signin_employee neq ''}
                    <span class="signed_user {if $signing_details.employee_sign neq ''}bankID{/if}">{$translate.signed_by} ({$translate.employee_wr}): {if $sort_by_name == 1}{$signing_details.signin_employee_name}{elseif $sort_by_name == 2}{$signing_details.signin_employee_name_lf}{/if} {$translate.on} {$signing_details.signin_date}{if $signing_details.employee_sign neq ''} {$translate.sign_through_bankID}&nbsp;&nbsp;<img src="{$url_path}images/banck_id_signing.jpg" style="height: 18px;">{/if}</span>
                    {*if $login_user_role eq 1 or $is_suTL}
                        <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(1,'span_emp_sign')" title="{$translate.delete}"></a>
                    {/if*}
                {else}
                    {$translate.unsigned} ({$translate.employee_wr})
                {/if}
            </span>
            <hr class="span12 no-min-height no-ml"/>
            <span id="span_TL_sign"  class="span12 clearfix no-ml mb">
                {if $signing_details.signin_tl neq ''}
                    <span class="signed_user {if $signing_details.tl_sign neq ''}bankID{/if}">{$translate.signed_by} ({$translate.tl_wr}): {if $sort_by_name == 1} {$signing_details.signin_tl_name}{elseif $sort_by_name == 2}{$signing_details.signin_tl_name_lf}{/if} {$translate.on} {$signing_details.signin_tl_date}{if $signing_details.tl_sign neq ''} {$translate.sign_through_bankID}&nbsp;&nbsp;<img src="{$url_path}images/banck_id_signing.jpg" style="height: 18px;">{/if}</span>
                    {*if $login_user_role eq 1 or $is_suTL}
                        <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(2,'span_TL_sign')" title="{$translate.delete}"></a>
                    {/if*}
                {else}
                    {$translate.unsigned} ({$translate.tl_wr})
                {/if}
            </span>
            <hr class="span12 no-min-height no-ml"/>
            <span id="span_suTL_sign" class="span12 clearfix no-ml mb">
                {if $signing_details.signin_sutl neq ''}
                    <span class="signed_user {if $signing_details.sutl_sign neq ''}bankID{/if}">{$translate.signed_by} ({$translate.super_tl_wr}): {if $sort_by_name == 1}{$signing_details.signin_sutl_name}{elseif $sort_by_name == 2}{$signing_details.signin_sutl_name_lf}{/if} {$translate.on} {$signing_details.signin_sutl_date}{if $signing_details.sutl_sign neq ''} {$translate.sign_through_bankID}&nbsp;&nbsp;<img src="{$url_path}images/banck_id_signing.jpg" style="height: 18px;">{/if}</span>
                    {*if $login_user_role eq 1 or $is_suTL}
                        <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(3,'span_suTL_sign')" title="{$translate.delete}"></a>
                    {/if*}
                {else}
                    {$translate.unsigned} ({$translate.super_tl_wr})
                {/if}
            </span>
              </div>
        </div>
        <div class="span3" >
            <div class="box-wrpr success-bg span12">
                <ul class="list-bank-id">
                    <li>{$translate.bank_id_text1}</li>
                    <li>{$translate.bank_id_text2}</li>
                    <li>{$translate.bank_id_text3}</li>
                    <li>{$translate.bank_id_text4}</li>
                    <li style="background: none !important; padding: 0 !important;"><a class="highlight-link" href="https://www.support.bankid.com/sv/bankid/vad-aer-bankid" target="_blank">{$translate.bank_id_text_link}</a></li>
                </ul>

           </div>
        </div>    
        <div id="signing" class="signing signing_for_main span4">
             <div class="box-wrpr span12">
                {if $sign_status eq "false"}
                    {if ($report_year < $now_year) || ($report_month <= $now_month and $report_year == $now_year)}
                        {if $untreated_leaves}
                            <div class="signing_bug_main"> 
                                <span class="signing signing_for_inner">
                                    <span class="signing_bug">{$translate.untreated_leave_exists_contact_TL}</span>
                                </span>
                            </div>
                        {else if $untreated_candg_slots}
                            <div class="signing_bug_main"> 
                                <span class="signing signing_for_inner">
                                    <span class="signing_bug">{$translate.untreated_candg_slot_exists}</span>
                                </span>
                            </div>
                        {else if !$is_able_to_sign and $login_user_role neq 1}
                            <div class="signing_bug_main"> 
                                <span class="signing signing_for_inner">
                                    <span class="signing_bug">{$translate.report_employee_should_be_sign_before_others_do}</span>
                                </span>
                            </div>
                        {else if $have_after_slots}
                            <div class="signing_bug_main"> 
                                <span class="signing signing_for_inner">
                                    <span class="signing_bug">{$translate.future_slots_exist_in_this_month}</span>
                                </span>
                            </div>
                        {else}
                            <span class="signing_form clearfix">
                                <div style="float:left; margin-bottom:5px; padding-top:3px;">
                                    <label for="username" class="signing_form_label">{$translate.username}</label>
                                    <input type="text" id="username" name="username" value="{$login_user}" disabled="disabled" style="background-color:  #D9D9D9;margin-left: 25px;" class="signing_form_text"/>
                                </div>
                                {if $allow_ordinary_signing}
                                <div style="float:left; margin-bottom:5px;">
                                    <label for="password" class="signing_form_label">{$translate.password}</label>
                                    <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                                </div>
                                {/if}
                                <div style="float:left; padding:0px 0px 10px 10px; width:100%;" class="clearfix">
                                    {if $allow_ordinary_signing}<a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)">{$translate.signin}</a>{/if}
                                    <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                                </div>
                                <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                                {*<a href="bankid:///?autostarttoken=numm&redirect=https%3A%2F%2Ftime2view.se%2Fcirrus-demo%2Fbank_id_return.php">Click Here</a>*}
                            </span>
                        {/if}
                    {/if}
                {else if $sign_status eq "true"}
                    {if $login_user_role eq 1 or $isGLorAdmin eq true}
                        <div class="signing_remove_main"> 
                            <span class="signing signing_for_inner">
                                {*<span id="signing_remove_message" class="signing_success"> {$translate.this_employee_already_signin}</span>*}
                                <span class="signing_delete">{$translate.remove_signin}</span>
                                <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                                <input type="hidden" id="sign_sutl_id" value="{$signin_sutl}">
                            </span>
                        </div>
                    {/if}
                {elseif $sign_status eq 'both'} {* Only for admin purpose *}
                    {if $login_user_role eq 1 or $isGLorAdmin eq true}
                         
                        <div class="signing_remove_main"> 
                            <span class="signing signing_for_inner">
                                {*<span id="signing_remove_message" class="signing_success"> {$translate.this_employee_already_signin}</span>*}
                                    <span class="signing_delete">{$translate.remove_signin}</span>
                                    <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                                    <input type="hidden" id="sign_sutl_id" value="{$signin_sutl}">
                                    
                            </span>
                        </div>
                         
                    {/if}
                     
                    {if ($report_year < $now_year) || ($report_month <= $now_month && $report_year == $now_year)}    
                        <span class="signing_form clearfix">
                            <div style="float:left; margin-bottom:5px; padding-top:3px;">
                                <label for="username" class="signing_form_label">{$translate.username}</label>
                                <input type="text" id="username" name="username" value="{$login_user}" disabled="disabled" style="background-color:  #D9D9D9; margin-left: 25px;" class="signing_form_text"/>
                            </div>
                            {if $allow_ordinary_signing}
                            <div style="float:left; margin-bottom:5px;">
                                <label for="password" class="signing_form_label">{$translate.password}</label>
                                <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                            </div>
                            {/if}
                            <div style="float:left; padding:0px 0px 10px 10px; width:100%;" class="clearfix">
                                {if $allow_ordinary_signing}<a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)">{$translate.signin}</a>{/if}
                                <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                            </div>    
                            <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                        </span>
                    {/if}
                {/if}
            </div>
        </div>
    </div>
    </div>
{/if}
<div id="tble_list"> 
    {if $show_sem_leave}
        <div id="kunder_info_strip" class="span12 no-ml" style="margin: 0 4px 4px 4px;">
            <div class="info_name"><b>{$translate.earned_days} : </b>{$sem_leave_details.this_fyear_earned_days}  </div>
            <div class="info_name"><b>{$translate.taken_vacation_days} : </b>{$sem_leave_details.this_fyear_takens_sem_leave_days}</div>
            <div class="info_name"><b>{$translate.former_year_remain_days} : </b>{$sem_leave_details.former_year_remaining_days}</div>
        </div>
    {/if}
    <div class="span12" style="padding: 0px; margin: 0px;">
        {if $report_month == ""}{$report_month = ($smarty.now|date_format:"%m")+0}{/if}
        {if $report_year == ""}{$report_year = $smarty.now|date_format:"%Y"}{/if}
        <div class="alphbts pagention" style="width: 99.5%; margin-top: 5px; height: auto !important;">
            
            <form id="form_report" method="post" class='no-mb mt'>
                
                <div class="span2">
                     {$translate.month}: {$month_name}
                </div>
                <div class="span4">  Period: {$report_year}-{$rpt_month}-01 -- {$report_year}-{$rpt_month}-{$cur_month_last_date}</div>
                
            
                {*$translate.month}:{$report_month*}
                <input type="hidden" id="sel_month" name="sel_month" value="{$report_month}">
                
                {*$translate.year}:{$report_year*}
                <input type="hidden" id="sel_year" name="sel_year" value="{$report_year}">
                
                <div class="span2 pull-right">
                    <i class="icon icon-group"></i> 
                    {$translate.employee}: {$employee_name}
                    <input type="hidden" id="sel_employee" name="sel_employee" value="{$employee_id}">
               </div>
                   <div class="span2 pull-right">
                    <i class="icon icon-user"></i> 
                    {$translate.customer}: {$customer_name}
                    <input type="hidden" id="sel_customer" name="sel_customer" value="{$customer_id}">
                </div>
                
                
                
                <input type="hidden" name="action" id="action" value="" />
            </form>
        </div>

    </div>
    <div id="content_table" class="no-ml" name="content_table" style="width:100%; overflow: scroll; min-height: 400px; margin-left:6px">
        {if $rpt_content_normal || $rpt_content_travel || $rpt_content_break || $rpt_content_oncall || $rpt_content_leave || $rpt_content_over || $rpt_content_quality || $rpt_content_more || $rpt_content_some || $rpt_content_training || $rpt_content_personal || $rpt_content_calltraining || $rpt_content_voluntary || $rpt_content_complementary || $rpt_content_complementary_oncall || $rpt_content_leave_travel || $rpt_content_leave_break || $rpt_content_leave_over || $rpt_content_leave_quality || $rpt_content_leave_more || $rpt_content_leave_some || $rpt_content_leave_training || $rpt_content_leave_personal || $rpt_content_leave_oncall || $rpt_content_leave_calltraining || $rpt_content_leave_voluntary || $rpt_content_leave_more_oncall || $rpt_content_more_oncall || $rpt_content_leave_standby || $rpt_content_standby || $rpt_content_dismissal || $rpt_content_dismissal_oncall}
            <table class="table_list" width="100%" id="cont_table">
                <thead>
                <tr align="center">
                    <th width="50px">{$translate.date}</th>

                    {foreach from=$sub_keys_normal item=entries1}  
                        <th width="50px">{$entries1}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_travel item=entries1}  
                        <th width="50px">{if $entries1 == "travel"}{$translate.travel}{else}{$entries1}<br>{$translate.travel}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_break item=entries1}  
                        <th width="50px">{if $entries1 == "break"}{$translate.break}{else}{$entries1}<br>{$translate.break}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_over item=entries1}  
                        <th width="50px">{if $entries1 == "overtime"}{$translate.overtime}{else}{$entries1}<br>{$translate.overtime}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_quality item=entries1}  
                        <th width="50px">{if $entries1 == "qual_overtime"}{$translate.qual_overtime}{else}{$entries1}<br>{$translate.qual_overtime}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_more item=entries1}  
                        <th width="50px">{if $entries1 == "more_time"}{$translate.more_time}{else}{$entries1}<br>{$translate.more_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_some item=entries1}  
                        <th width="50px">{if $entries1 == "some_other_time"}{$translate.some_other_time}{else}{$entries1}<br>{$translate.some_other_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_training item=entries1}  
                        <th width="50px">{if $entries1 == "training"}{$translate.training_time}{else}{$entries1}<br>{$translate.training_time}{/if}</th>
                    {/foreach}
                    
                    
                    
                    {foreach from=$sub_keys_voluntary item=entries1}  
                        <th width="50px">{if $entries1 == "voluntary"}{$translate.voluntary}{else}{$entries1}<br>{$translate.voluntary}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_complementary item=entries1}  
                        <th width="50px">{if $entries1 == "complementary"}{$translate.complementary}{else}{$entries1}<br>{$translate.complementary}{/if}</th>
                    {/foreach}
                    
                    
                    {foreach from=$sub_keys_standby item=entries1}  
                        <th width="50px">{if $entries1 == "standby"}{$translate.standby}{else}{$entries1}<br>{$translate.standby}{/if}</th>
                    {/foreach}
                    
                    
                    {foreach from=$sub_keys_dismissal item=entries1}  
                        
                        <th width="50px">{if $entries1 == "dismissal"}{$translate.work_for_dismissal}{else}{$entries1}<br>{$translate.work_for_dismissal}{/if}</th>
                    {/foreach}
                                        
                    {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_standby || $sub_keys_dismissal}
                        <th width="50px" style="background:#F5BE87">{$translate.work_sum_ord}</th>
                    {/if}
                    
                    {foreach from=$sub_keys_personal item=entries1}  
                        <th width="50px">{if $entries1 == "personal_meeting"}{$translate.personal_meeting}{else}{$entries1}<br>{$translate.personal_meeting}{/if}</th>
                    {/foreach}
                    {if $sub_keys_personal}
                        <th width="50px" style="background:#F5BE87">{$translate.work_sum_personal}</th>
                    {/if}
                    {foreach from=$sub_keys_oncall item=entries1}  
                        <th width="50px">{if $entries1 == 'jour'}Jour{elseif stripos(' '|cat:$entries1,'jour') || stripos(' '|cat:$entries1,'Väntetid')}{$entries1}{else}Jour<br>{$entries1}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_calltraining item=entries1}  
                        <th width="50px">{if $entries1 == 'call_training'}{$translate.call_training}{else}{$entries1}<br>{$translate.training_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_complementary_oncall item=entries1}  
                        <th width="50px">{if $entries1 == 'complementary_oncall'}{$translate.complementary_oncall}{else}{$entries1}<br>{$translate.complementary}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_more_oncall item=entries1}  
                        <th width="50px">{if $entries1 == 'more_oncall'}{$translate.more_oncall}{else}{$entries1}<br>{$translate.more_time}{/if}</th>
                    {/foreach}

                    {foreach from=$sub_keys_dismissal_oncall item=entries1}                    
                        <th width="50px">{if $entries1 == 'dismissal_oncall'}{$translate.work_for_dismissal_oncall}{else}{$entries1}<br>{$translate.work_for_dismissal}{/if}</th>
                    {/foreach}
                        
                    {if $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall || $sub_keys_more_oncall || $sub_keys_dismissal_oncall}
                        <th width="50px" style="background:#F5BE87">{$translate.work_sum_jour}</th>
                    {/if}
                    {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_standby || $sub_keys_dismissal || $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall|| $sub_keys_more_oncall || $sub_keys_dismissal_oncall}
                        <th width="50px" >{$translate.work_sum}</th>
                    {/if}
                    {foreach from=$sub_keys_leave_normal_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            {$entries2}
                            </th>
                        {/foreach}
                       
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_travel_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'travel')}{$translate.$entries2}{else}{$entries2}<br>{$translate.travel}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_break_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}
                            <br>
                            {if stripos(' '|cat:$entries2,'break')}{$translate.$entries2}{else}{$entries2}<br>{$translate.break}{/if}
                            </th>
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_over_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'overtime')}{$translate.$entries2}{else}{$entries2}<br>{$translate.overtime}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_quality_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}       
                            <br>
                            {if stripos(' '|cat:$entries2,'qual_overtime')}{$translate.$entries2}{else}{$entries2}<br>{$translate.qual_overtime}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}       
                            <br>
                            {if stripos(' '|cat:$entries2,'more_time')}{$translate.$entries2}{else}{$entries2}<br>{$translate.more_time}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_some_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'some_other_time')}{$translate.$entries2}{else}{$entries2}<br>{$translate.some_other_time}{/if}
                            </th>
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_training_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'training')}{$translate.$entries2}{else}{$entries2}<br>{$translate.training}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_personal_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}        
                            <br>
                            {if stripos(' '|cat:$entries2,'personal_meeting')}{$translate.$entries2}{else}{$entries2}<br>{$translate.personal_meeting}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_voluntary_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'voluntary')}{$translate.$entries2}{else}{$entries2}<br>{$translate.voluntary}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_standby_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}      
                            <br>
                            {if stripos(' '|cat:$entries2,'standby')}{$translate.$entries2}{else}{$entries2}<br>{$translate.standby}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {if !empty($sub_keys_leave_normal_head) || !empty($sub_keys_leave_travel_head) || !empty($sub_keys_leave_break_head) || !empty($sub_keys_leave_over_head) || !empty($sub_keys_leave_quality_head) || !empty($sub_keys_leave_more_head) || !empty($sub_keys_leave_some_head) || !empty($sub_keys_leave_training_head) || !empty($sub_keys_leave_personal_head) || !empty($sub_keys_leave_voluntary_head) || !empty($sub_keys_leave_standby_head)}<th width="50px" style="background:#F5BE87">{$translate.leave_sum_ord}</th>{/if}
                    
                    {foreach from=$sub_keys_leave_oncall_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}       
                            {$entries2}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_calltraining_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}       
                            {if stripos(' '|cat:$entries2,'call_training')}{$translate.$entries2}{else}{$entries2}<br>{$translate.training_time}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_oncall_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            <th width="50px" style="background:#F9DDDD">
                            {$leave_types.{$entries1}}       
                            {if stripos(' '|cat:$entries2,'more_oncall')}{$translate.$entries2}{else}{$entries2}<br>{$translate.more_time}{/if}
                            </th>
                        {/foreach}
                        
                    {/foreach}
                    
                    
                    
                    {if !empty($sub_keys_leave_oncall_head) || !empty($sub_keys_leave_calltraining_head) || !empty($sub_keys_leave_more_oncall_head) || !empty($sub_keys_leave_standby_oncall_head)}<th width="50px" style="background:#F5BE87">{$translate.leave_sum_oncall}</th>{/if}
                    {if !empty($sub_keys_leave_normal_head) || !empty($sub_keys_leave_travel_head) || !empty($sub_keys_leave_break_head) || !empty($sub_keys_leave_over_head) || !empty($sub_keys_leave_quality_head) || !empty($sub_keys_leave_more_head) || !empty($sub_keys_leave_some_head) || !empty($sub_keys_leave_training_head) || !empty($sub_keys_leave_personal_head) || !empty($sub_keys_leave_voluntary_head) || !empty($sub_keys_leave_standby_head) || !empty($sub_keys_leave_oncall_head) || !empty($sub_keys_leave_calltraining_head) || !empty($sub_keys_leave_more_oncall_head) || !empty($sub_keys_leave_standby_oncall_head)}<th width="50px" style="background:#F9DDDD">{$translate.leave_sum}</th>{/if}

                    {if !empty($fkkn_slots) && strpos(json_encode($fkkn_slots), "\"1\":") > 0}<th width="50px" style="background:#F5BE87">{$translate.fk_sum}{/if}
                    {if !empty($fkkn_slots) && (strpos(json_encode($fkkn_slots), "\"2\":") > 0 || strpos(json_encode($fkkn_slots), "\"3\":") > 0)}<th width="50px" style="background:#F5BE87">{$translate.kntu_sum}{/if}
            </tr>
            </thead>
            <tbody>

            {assign var=i value=0}
            {assign var=sum_sum_hour value=0}
            {assign var=sum_sum_hour_ord value=0}
            {assign var=sum_sum_hour_personal value=0}
            {assign var=sum_sum_hour_jour value=0}
            {assign var=sum_sum_hour_leave value=0}
            {assign var=sum_sum_hour_leave_oncall value=0}
            {assign var=tot_fk value=0}
            {assign var=tot_kntu value=0}
            {foreach $days_in_month as $day_in_month}
                <tr align="center">

                    {assign var=sum_hour value=0}
                    {assign var=sum_hour_ord value=0}
                    {assign var=sum_hour_personal value=0}
                    {assign var=sum_hour_jour value=0}
                    {assign var=sum_hour_leave value=0}
                    {assign var=sum_hour_leave_oncall value=0}
                    {assign var=j value=0}
                    {assign var=tot value=array() scope="global"}
                    <td width="50px" style="padding:5px 2px;"><a style="border-bottom: 1px dashed #999;" title="{$translate.go_to_slots}" href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$day_in_month}&employee={$employee_id}&customer={$customer_id}&return_page=emp_work_report',1)">{substr($day_in_month,5)} {substr($translate.{$day_in_month|date_format:"%a"|lower},0,3)}{if in_array($day_in_month,$comment_dates)}<span style="color: red;">*</span>{/if}</a></td>

                    {foreach from=$sub_keys_normal item=entries1}
                        {if $rpt_content_normal.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_normal.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_normal.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_normal.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_travel item=entries1}
                        {if $rpt_content_travel.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_travel.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_travel.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_travel.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_break item=entries1}
                        {if $rpt_content_break.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_break.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_nreak.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_break.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_over item=entries1}
                        {if $rpt_content_over.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_over.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_over.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_over.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_quality item=entries1}
                        {if $rpt_content_quality.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_quality.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_quality.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_quality.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_more item=entries1}
                        {if $rpt_content_more.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_more.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_more.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_more.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_some item=entries1}
                        {if $rpt_content_some.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_some.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_some.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_some.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_training item=entries1}
                        {if $rpt_content_training.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_training.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_training.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_training.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    
                    
                    {foreach from=$sub_keys_voluntary item=entries1}
                        {if $rpt_content_voluntary.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_voluntary.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_voluntary.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_voluntary.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_complementary item=entries1}
                        {if $rpt_content_complementary.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_complementary.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_complementary.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_complementary.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_standby item=entries1}
                        {if $rpt_content_standby.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_standby.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_standby.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_standby.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_dismissal item=entries1}
                        {if $rpt_content_dismissal.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_dismissal.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_dismissal.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_dismissal.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_standby || $sub_keys_dismissal}
                         <td style="background:#F5BE87">{if $sum_hour_ord}{round($sum_hour_ord,2)}{else}&nbsp;{/if}</td>
                        {assign var="sum_sum_hour_ord" value= ($sum_sum_hour_ord + $sum_hour_ord)}
                    {/if}
                    
                    {foreach from=$sub_keys_personal item=entries1}
                        {if $rpt_content_personal.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_personal.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_personal.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_personal" value=$sum_hour_personal + $rpt_content_personal.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {if $sub_keys_personal}
                         <td style="background:#F5BE87">{if $sum_hour_personal}{round($sum_hour_personal,2)}{else}&nbsp;{/if}</td>
                        {assign var="sum_sum_hour_personal" value= ($sum_sum_hour_personal + $sum_hour_personal)}
                    {/if}
                    
                    {foreach from=$sub_keys_oncall item=entries1}  
                        {if $rpt_content_oncall.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_oncall.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_oncall.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_oncall.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_calltraining item=entries1}  
                        {if $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_calltraining.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_complementary_oncall item=entries1}  
                        {if $rpt_content_complementary_oncall.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_complementary_oncall.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_complementary_oncall.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_complementary_oncall.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_more_oncall item=entries1}  
                        {if $rpt_content_more_oncall.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_more_oncall.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_more_oncall.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_more_oncall.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}

                    {foreach from=$sub_keys_dismissal_oncall item=entries1}  
                        {if $rpt_content_dismissal_oncall.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_dismissal_oncall.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_dismissal_oncall.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_dismissal_oncall.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                                        
                    {if $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall || $sub_keys_more_oncall || $sub_keys_dismissal_oncall}
                         <td style="background:#F5BE87">{if $sum_hour_jour}{round($sum_hour_jour,2)}{else}&nbsp;{/if}</td>
                        {assign var="sum_sum_hour_jour" value= ($sum_sum_hour_jour + $sum_hour_jour)}
                    {/if}
                    {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_dismissal || $sub_keys_standby || $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall || $sub_keys_more_oncall || $sub_keys_dismissal_oncall}
                    <td>{if $sum_hour}{round($sum_hour,2)}{else}&nbsp;{/if}</td>
                    {assign var="sum_sum_hour" value= ($sum_sum_hour + $sum_hour)}
                    {/if}
                    
                    {foreach from=$sub_keys_leave_normal_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_travel_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_travel.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_travel.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_travel.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_break_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_break.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_break.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_break.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_over_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_over.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_over.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_over.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}

                    {foreach from=$sub_keys_leave_quality_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_quality.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_quality.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_quality.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_more.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_more.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_more.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_some_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_some.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_some.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_some.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_training_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_training.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_training.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_training.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_personal_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_personal.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_personal.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_personal.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_voluntary_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_voluntary.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_voluntary.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_voluntary.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    
                    {foreach from=$sub_keys_leave_standby_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_standby.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_standby.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_standby.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {if $sub_keys_leave_normal_head || $sub_keys_leave_travel_head || $sub_keys_leave_break_head || $sub_keys_leave_over_head || $sub_keys_leave_quality_head || $sub_keys_leave_more_head || $sub_keys_leave_some_head || $sub_keys_leave_training_head || $sub_keys_leave_personal_head || $sub_keys_leave_voluntary_head || $sub_keys_leave_standby_head}
                        <td style="background:#F5BE87">{if $sum_hour_leave}{round($sum_hour_leave,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    
                    {assign var="sum_sum_hour_leave" value= ($sum_sum_hour_leave + $sum_hour_leave)}
                    
                    {foreach from=$sub_keys_leave_oncall_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_oncall.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_oncall.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave_oncall" value=$sum_hour_leave_oncall + $rpt_content_leave_oncall.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_calltraining_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave_oncall" value=$sum_hour_leave_oncall + $rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_oncall_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_more_oncall.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_more_oncall.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave_oncall" value=$sum_hour_leave_oncall + $rpt_content_leave_more_oncall.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    
                    
                    {if $sub_keys_leave_oncall_head || $sub_keys_leave_calltraining_head || $sub_keys_leave_more_oncall_head}
                        <td style="background:#F5BE87">{if $sum_hour_leave_oncall}{round($sum_hour_leave_oncall,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    {if $sub_keys_leave_normal_head || $sub_keys_leave_travel_head || $sub_keys_leave_break_head || $sub_keys_leave_over_head || $sub_keys_leave_quality_head || $sub_keys_leave_more_head || $sub_keys_leave_some_head || $sub_keys_leave_training_head || $sub_keys_leave_personal_head || $sub_keys_leave_voluntary_head || $sub_keys_leave_standby_head || $sub_keys_leave_oncall_head || $sub_keys_leave_calltraining_head || $sub_keys_leave_more_oncall_head}
                        <td style="background:#F9DDDD">{if $sum_hour_leave || $sum_hour_leave_oncall}{round($sum_hour_leave + $sum_hour_leave_oncall,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    {assign var="sum_sum_hour_leave_oncall" value= ($sum_sum_hour_leave_oncall + $sum_hour_leave_oncall)}
                    {if !empty($fkkn_slots)}
                        {if strpos(json_encode($fkkn_slots), "\"1\":") > 0}
                            <td style="background:#F5BE87">{if $fkkn_slots.$day_in_month[1]}{number_format($fkkn_slots.$day_in_month[1],2,'.','')}{else}&nbsp;{/if}</td>
                            {if $fkkn_slots.$day_in_month[1]}{$tot_fk = $tot_fk + $fkkn_slots.$day_in_month[1]}{/if}
                        {/if}

                        {if strpos(json_encode($fkkn_slots), "\"2\":") > 0 || strpos(json_encode($fkkn_slots), "\"3\":") > 0}
                            <td style="background:#F5BE87">{if $fkkn_slots.$day_in_month[2] || $fkkn_slots.$day_in_month[3]}{number_format($fkkn_slots.$day_in_month[2]+$fkkn_slots.$day_in_month[3],2,'.','')}{else}&nbsp;{/if}</td>
                            {if $fkkn_slots.$day_in_month[2]}{$tot_kntu = $tot_kntu + $fkkn_slots.$day_in_month[2]}{/if}
                            {if $fkkn_slots.$day_in_month[2]}{$tot_kntu = $tot_kntu + $fkkn_slots.$day_in_month[3]}{/if}
                        {/if}
                    {/if}    
                </tr>
            {/foreach}
            <tr align="center">
                <td>{$translate.sum}</td>
                {foreach from=$sum_normal item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_travel item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_break item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_over item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_quality item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_more item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_some item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_training item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_voluntary item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_complementary item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_standby item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_dismissal item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                
                {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_standby || $sub_keys_dismissal}
                     <td style="background:#F5BE87">{round($sum_sum_hour_ord,2)}</td>
                {/if}
                
                {foreach from=$sum_personal item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {if $sub_keys_personal}
                     <td style="background:#F5BE87">{round($sum_sum_hour_personal,2)}</td>
                {/if}
                
                {foreach from=$sum_oncall item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_calltraining item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_complementary_oncall item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_more_oncall item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_dismissal_oncall item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {if $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall || $sum_more_oncall || $sum_dismissal_oncall}
                     <td style="background:#F5BE87">{round($sum_sum_hour_jour,2)}</td>
                {/if}
                
                {if $sub_keys_normal || $sub_keys_travel || $sub_keys_break || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_voluntary || $sub_keys_complementary || $sub_keys_standby || $sub_keys_dismissal || $sub_keys_oncall || $sub_keys_calltraining || $sub_keys_complementary_oncall || $sum_more_oncall || $sum_dismissal_oncall}
                <td>{round($sum_sum_hour,2)}</td>
                {/if}
                
                {foreach from=$sub_keys_leave_normal_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_normal_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_normal_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_travel_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_travel_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                
                {foreach from=$sub_keys_leave_break_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_break_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                
                {foreach from=$sub_keys_leave_over_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_over_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_over_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                
                {foreach from=$sub_keys_leave_quality_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_quality_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_quality_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_more_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_more_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_more_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_some_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_some_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_some_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_training_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_training_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_training_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_personal_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_personal_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_personal_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_voluntary_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_voluntary_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                
                {foreach from=$sub_keys_leave_standby_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_standby_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                
                {if $sum_leave_normal_inconv || $sum_leave_travel_inconv || $sum_leave_break_inconv || $sum_leave_over_inconv || $sum_leave_quality_inconv || $sum_leave_more_inconv || $sum_leave_some_inconv || $sum_leave_training_inconv || $sum_leave_personal_inconv || $sum_leave_voluntary_inconv || $sum_leave_standby_inconv}
                    <td style="background:#F5BE87">{round($sum_sum_hour_leave,2)}</td>
                {/if}
                
                {foreach from=$sub_keys_leave_oncall_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_oncall_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_oncall_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                
                {foreach from=$sub_keys_leave_calltraining_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_calltraining_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                {*foreach from=$sum_leave_calltraining_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach*}
                {foreach from=$sub_keys_leave_more_oncall_head item=entries3}
                    {foreach from=$entries3 key=entries1 item=entries2}
                        <td style="background:#F9DDDD">{round($sum_leave_more_oncall_inconv[$entries1][$entries2],2)}</td>
                    {/foreach}
                {/foreach}
                
                
                
                {if $sum_leave_oncall_inconv || $sum_leave_calltraining_inconv || $sum_leave_more_oncall_inconv}
                    <td style="background:#F5BE87">{round($sum_sum_hour_leave_oncall,2)}</td>
                {/if}
                {if $sum_leave_normal_inconv || $sum_leave_travel_inconv || $sum_leave_break_inconv || $sum_leave_over_inconv || $sum_leave_quality_inconv || $sum_leave_more_inconv || $sum_leave_some_inconv || $sum_leave_training_inconv || $sum_leave_personal_inconv || $sum_leave_voluntary_inconv || $sum_leave_standby_inconv || $sum_leave_oncall_inconv || $sum_leave_calltraining_inconv || $sum_leave_more_oncall_inconv}
                    <td style="background:#F5BE87">{round($sum_sum_hour_leave + $sum_sum_hour_leave_oncall,2)}</td>
                {/if}
                {if $tot_fk}
                    <td style="background:#F5BE87">{number_format($tot_fk,2,'.','')}</td>
                {/if}
                {if $tot_kntu}
                    <td style="background:#F5BE87">{number_format($tot_kntu,2,'.','')}</td>
                {/if}    
            </tr>    
            </tbody>

        </table>
        {else}
            <div class="fail">{$translate.no_schedule_available}</div>   
        {/if}
    </div>

    {if $leave_comments|count gt 0}
        <div id="leave_comments" class="span12">
            <h4>{$translate.leave_comments}</h4>
            <ul class="span12 no-ml">
            {foreach $leave_comments as $lc}
                <li><b><i class="icon icon-comment"></i> {$lc.date} :</b> {$lc.comment}</li>
            {/foreach}
            </ul>
        </div>
    {/if}
</div>
{else}
<div class="fail">{$translate.permission_denied}</div>    
{/if}
</div>
    </div>
{/block}


{block name="script"}
{*<script src="{$url_path}js/datepicker_btstrap.js" type="text/javascript" ></script>*}
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script>
<script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">

function printForm(){
    if($("#sel_month").val() != "" && $("#sel_year").val() != "" && $("#sel_employee").val() != ""){
        var f = $("#form_report");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
    }
//    $('#action').val('print');
//    $('#forms').submit();
//    if($("#cmb_employee").val() != "" && $("#lstTidStart").val() != "" && $("#lstTidSlut").val() != ""){
//        var f = $("#forms");
//        f.attr('target', '_BLANK');
//        $('#action').val('print');
//        f.submit();
//    }
}

{if ($login_user_role eq 1 OR $login_user_role eq 2 OR $login_user_role eq 3 OR $login_user_role eq 7) and ($rpt_content_normal or $rpt_content_travel or $rpt_content_break or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_voluntary or $rpt_content_complementary or $rpt_content_complementary_oncall or $rpt_content_leave_travel or $rpt_content_leave_break or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_voluntary or $rpt_content_leave_oncall or $rpt_content_leave_calltraining or $rpt_content_standby or $rpt_content_leave_standby or $rpt_content_dismissal or $rpt_content_dismissal_oncall)}


    function sign_remove(){
            var signin_sutl_id  = $("#sign_sutl_id").val();
            
            if (signin_sutl_id == ''){
                sign_remove_update();
            }
            else if ('{$login_user}' == signin_sutl_id){
                  bootbox.dialog('{$translate.do_u_want_delete_report}', [
                        {
                            "label" : "{$translate.no}",
                            "class" : "btn-danger",
                        },
                         {
                            "label" : "{$translate.yes}",
                            "class" : "btn-success",
                            "callback": function() {
                                sign_remove_update('own_delete');
                            }
                         }
                  ]);
            }
            else if ('{$login_user}' != signin_sutl_id ){
                 bootbox.dialog('{$translate.do_u_want_delete_report_singed_other_admin}', [
                        {
                            "label" : "{$translate.no}",
                            "class" : "btn-danger",
                        },
                         {
                            "label" : "{$translate.yes}",
                            "class" : "btn-success",
                            "callback": function() {
                                sign_remove_update('other_delete');
                            }
                         }
                  ]);
            }
            
    }

    function sign_remove_update(_type_delete){

        var type_delete = typeof _type_delete != "undefined" ? _type_delete : null;
        var month = $("#sel_month").val();
        var year = $("#sel_year").val();
        var employee = $("#sel_employee").val();
        var customer = $("#sel_customer").val();
        if(month != "" && year != "" && employee != "" && customer != ""){
            $("#signing_message").html("");
            wrapLoader('#emp_login');
            $.ajax({
                    async:false,
                    url:"{$url_path}ajax_employee_signing_remove.php",
                    data:"type_delete="+type_delete+"&month="+month+"&year="+year+"&emp="+employee+"&customer="+customer,
                    type:"POST",
                    success:function(data){
                            $("#emp_login").html(data);
                            uwrapLoader('#emp_login');
                    }
                });
        }
    }



    {*function sign_remove_single(type, section){

        var month = $("#sel_month").val();
        var year = $("#sel_year").val();
        var employee = $("#sel_employee").val();
        if(month != "" && year != "" && employee != ""){
            $.ajax({
                    async:false,
                    url:"{$url_path}ajax_employee_signing_remove.php",
                    data:"month="+month+"&year="+year+"&emp="+employee+"&type="+type,
                    type:"POST",
                    success:function(data){
                            $("#"+section).html(data);
                    }
    //ajax_employee_signing_remove
                });
        }

    }*}
    function check(flag){           
        var uname = $("#username").val();
        var pword = $("#password").val();
        var month = $("#sel_month").val();
        var year = $("#sel_year").val();
        var employee = $("#sel_employee").val();
        var customer = $("#sel_customer").val();

        if((uname == "" || pword == "") && flag == 0){
            $("#signing_message").html("{$translate.username_or_password_missing}").addClass("signing_error").removeClass("signing_success");
        }else if(employee == ""){
            $("#signing_message").html("{$translate.select_one_employee}").addClass("signing_error").removeClass("signing_success");
        }else if(customer == ""){
            $("#signing_message").html("{$translate.select_one_customer}").addClass("signing_error").removeClass("signing_success");
        }
        else if(month != "" && year != "" && employee != "" && customer != ""){
            $("#signing_message").html("");
            wrapLoader('#emp_login');
            $.ajax({
                    async:false,
                    url:"{$url_path}ajax_employee_signing.php",
                    data:"UN="+uname+"&PW="+pword+"&month="+month+"&year="+year+"&emp="+employee+"&customer="+customer+"&consolidated="+'{$rpt_consolidated}'+'&bank_id_flag='+flag,
                    type:"POST",
                    success:function(data){
                            if(flag == 1){
                                $("#signing_message").html(data);
                            }
                            else{
                                var invalid_pword = '{$translate.invalid_username_or_password}';
                                if(data.trim().toString() == invalid_pword.trim().toString()){
                                    $("#signing_message").html(data);
                                    $("#signing_message").parents('.box-wrpr').animate({ scrollTop: $("#signing_message").parents('.box-wrpr').height()}, 800);
                                }else
                                    $("#emp_login").html(data);
                            }
                            uwrapLoader('#emp_login');
                    }

            });
        }

    }

    $(document).ready(function(){
        $(".signing_form #username, .signing_form #password").live("keyup", function(event) {
            if(event.keyCode == 13){
                $(".signing_form .signing_button").click();
            }
        });

    });
{/if}
$(document).ready(function(){
        $("#cmb_customer").change(function(){
            var selected_customer = $.trim($(this).val());
            if(selected_customer != ''){
                location.href = '{$url_path}report/work/employee/detail/{$report_year}/{$report_month}/{$employee_id}/'+selected_customer+'/';
            }
        });
        
        $("#dp3").datepicker({
            format: "yyyy-mm",
            changeMonth: true,
            changeYear: true,
            viewMode: "months", //1
            minViewMode: "months",
            autoclose: true,
            language: '{$lang}',
            //defaultDate: '2014-05',//new Date(), 
            onClose: function (dateText, inst) { }
        }).on('changeDate', function(ev){
            //if(ev.viewMode == 'months'){
                var month = $.datepicker.formatDate('mm', ev.date);
                var year = $.datepicker.formatDate('yy', ev.date);
                $("#dp3").datepicker('hide');
                location.href = '{$url_path}report/work/employee/detail/'+year+'/'+month+'/{$employee_id}/{$customer_id}/';
            //}
        });

        if($(window).height() > 600){
            $('#content_table').css({ height: Math.max($(window).innerHeight()- ($('#content_table').length > 0 ? $('#content_table').offset().top : 0), 250) });
            $(window).resize(function(){
                $('#content_table').css({ height: Math.max($(window).innerHeight()- ($('#content_table').length > 0 ? $('#content_table').offset().top : 0), 250) });
            });

            var $demo1 = $('table#cont_table');
            $demo1.floatThead({
                    scrollContainer: function($demo1){
                            return $demo1.closest('#content_table');
                    }
            });
        }

});
</script>
{/block}