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
            <a href="{$url_path}report/work/employee/detail/{$report_year}/{$report_month}/{$employee_id}/{$customer_id}/" class="back pull-right"><span class="btn_name">{$translate.old_rpt_button}</span></a>
                <a href="{$back_url}" class="back pull-right"><span class="btn_name">{$translate.backs}</span></a>
                <a onclick="printForm()" href="javascript:void(0)" class="print pull-right"><span class="btn_name">
                 {$translate.print}</span></a>
                {* <a onclick="printForm()" href="javascript:void(0)" class="print pull-right"><span class="btn_name">{$translate.print}</span></a> *}
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
                        <div style="float:left;" class="arrow_left cursor_hand" title="{$translate.tltp_goto_previous_month}"><a style="border-radius:5px 0 0 5px;" href="{$url_path}report/work/employee/detail/new/{$prv_year}/{$prv_month}/{$employee_id}/{$customer_id}/"></a> </div>
                        <ul style="float:left;" class="weeks"><li style="width:auto; padding:2px 30px;" class="week_class"><a>{$month_name} {$report_year}</a></li></ul>
                        <div style="float:left;" class="arrow_right cursor_hand" title="{$translate.tltp_goto_next_month}"><a style="border-radius:0 5px 5px 0;" href="{$url_path}report/work/employee/detail/new/{$next_year}/{$next_month}/{$employee_id}/{$customer_id}/"></a> </div>
                    </div>
                </div>
                <div class="clearfix" colspan="1" style="float:right; width: 44px; text-align: center;" {*id="dp3" data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm"*}>
                    <span id="dp3" class="cursor_hand clearfix"  data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm" style="margin-top: 9px;"><img src="{$url_path}images/calendar_btstrap.png" alt='calendar' title="{$translate.tltp_select_year_month}"/></span>
                    {*        <i  class="icon-calendar" data-date="{$report_year|cat:'-'|cat:$report_month}" data-date-format="yyyy-mm" title="{$translate.tltp_select_year_month}" ></i>*}
                </div>
            </div>
            
            {if ($login_user_role eq 1 OR $login_user_role eq 6 OR $login_user_role eq 2 OR $login_user_role eq 3 OR $login_user_role eq 7) and ($rpt_content_normal or $rpt_content_travel or $rpt_content_break or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_voluntary or $rpt_content_complementary or $rpt_content_standby or $rpt_content_complementary_oncall or $rpt_content_more_oncall or $rpt_content_standby_oncall or $rpt_content_leave_travel or $rpt_content_leave_break or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_voluntary or $rpt_content_leave_oncall or $rpt_content_leave_calltraining or $rpt_content_leave_more_oncall or $rpt_content_leave_standby_oncall or $rpt_content_leave_standby or $rpt_content_dismissal or $rpt_content_dismissal_oncall)}    

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
                        {if $sign_status eq "false"}
                             <div class="box-wrpr span12">
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
                            </div>
                        {else if $sign_status eq "true"}
                            {if $login_user_role eq 1}
                                <div class="box-wrpr span12">
                                    <div class="signing_remove_main"> 
                                        <span class="signing signing_for_inner">
                                            {*<span id="signing_remove_message" class="signing_success"> {$translate.this_employee_already_signin}</span>*}
                                            <span class="signing_delete">{$translate.remove_signin}</span>
                                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                                             <input type="hidden" id="sign_sutl_id" value="{$signin_sutl}">
                                        </span>
                                    </div>
                                </div>
                            {/if}
                        {elseif $sign_status eq 'both'} {* Only for admin purpose *}
                            <div class="box-wrpr span12">
                            {if $login_user_role eq 1}
                                 
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
                            </div>
                        {/if}
                        
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
                {if !empty($heads) || !empty($heads_leave)}
                <div id="content_table" class="no-ml" name="content_table" style="width:100%; overflow: scroll; min-height: 400px; margin-left:6px">
                       
                        <table class="table_list" width="100%" id="cont_table">
                            <thead>
                            <tr align="center">
                                <th></th>
                                {foreach $heads as $ordered_heads}
                                    {foreach from=$ordered_heads key=type_key item=ordered_types}
                                        <th colspan="{count($ordered_types, 1)-(count($ordered_types)*2-1)}">{if $type_key == 'normal'}{$translate.normal_main_head_signing_report}{else}{$translate.$type_key}{/if}</th>
                                    {/foreach}                                    
                                {/foreach}
                                {foreach from=$heads_leave key=leave_type item=heads_main}
                                    {$sub_count = 0}
                                    {foreach $heads_main as $ordered_heads}
                                        {foreach from=$ordered_heads key=type_key item=ordered_types}

                                            {$sub_count = $sub_count + count($ordered_types, 1)-(count($ordered_types)*2-1)}
                                            {if $leave_type == 100}{$sub_count = $sub_count-1}{/if}
                                        {/foreach}
                                    {/foreach}
                                    <th colspan="{$sub_count}" style="background:#f9dddd">{if $leave_type == 100}{$translate.leave_sum}{else}{$leave_types[$leave_type]}{/if}</th>
                                {/foreach}
                                {if !empty($fkkn_slots)}
                                    {$fkkn_colspan = 0}
                                    {if !empty($fkkn_slots) && strpos(json_encode($fkkn_slots), "\"1\":") > 0}{$fkkn_colspan = 1}{/if}
                                    {if !empty($fkkn_slots) && (strpos(json_encode($fkkn_slots), "\"2\":") > 0 || strpos(json_encode($fkkn_slots), "\"3\":") > 0)}{$fkkn_colspan = $fkkn_colspan + 1}{/if}
                                    <th colspan="{$fkkn_colspan}">{$translate.fkkntu_sum}</th>
                                {/if}                                
                            </tr>
                            <tr align="center">
                                <th>{$translate.date}</th>
                                {foreach $heads as $ordered_heads}
                                    {foreach from=$ordered_heads key=type_key item=ordered_types}
                                        {foreach $ordered_types as $types}
                                            {foreach from=$types key=main_head item=head}
                                                {foreach $head as $head_item}
                                                    <th {if $head_item=='sum'}style="background:#F5BE87"{/if}>{if $head_item == $type_key || $head_item == 'sum'}{$translate.$head_item}{else}{$head_item}{/if}</th>
                                                {/foreach}   
                                            {/foreach}
                                        {/foreach}   
                                    {/foreach}
                                {/foreach}

                                {foreach from=$heads_leave key=leave_type item=heads_main}
                                    {foreach from=$heads_main key=order_key item=ordered_heads}
                                        {foreach from=$ordered_heads key=type_key item=ordered_types}
                                            {foreach $ordered_types as $types}
                                                {foreach from=$types key=main_head item=head}
                                                    {foreach $head as $head_item}
                                                        <th style="background:{if $head_item=='sum'}#F5BE87{else}#f9dddd{/if}">{if $head_item == 'sum' || ($order_key == 2 && $main_head == 'base_normal')}{$translate.$head_item}{else}{$head_item}{/if}</th>
                                                    {/foreach}   
                                                {/foreach}
                                            {/foreach}   
                                        {/foreach}
                                    {/foreach}
                                {/foreach}  
                                {if !empty($fkkn_slots) && strpos(json_encode($fkkn_slots), "\"1\":") > 0}<th style="background:#F5BE87">{$translate.fk_sum}{/if}
                                {if !empty($fkkn_slots) && (strpos(json_encode($fkkn_slots), "\"2\":") > 0 || strpos(json_encode($fkkn_slots), "\"3\":") > 0)}<th style="background:#F5BE87">{$translate.kntu_sum}{/if}
                            </tr>
                            </thead>
                            
                            <tbody align="right">
                                {$tot_fk = 0} 
                                {$tot_kntu = 0} 
                                {foreach $days_in_month as $date_key}
                                    
                                    <tr>
                                    <td><a style="border-bottom: 1px dashed #999;" title="{$translate.go_to_slots}" href="javascript:void(0);" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$date_key}&employee={$employee_id}&customer={$customer_id}&return_page=emp_work_report_new',1)">{substr($date_key,5)} {substr($translate.{$date_key|date_format:"%a"|lower},0,3)}{if in_array($date_key,$comment_dates)}<span style="color: red;">*</span>{/if}</a></td>
                                        {$contents = array()}
                                        {if array_key_exists($date_key, $results)}
                                            {$contents = $results[$date_key]}
                                        {/if}    
                                        {foreach from=$heads key=heads_key item=ordered_heads}
                                            {foreach from=$ordered_heads key=type_key item=ordered_types}
                                                {foreach from=$ordered_types key=type_order_key item=types}
                                                    {foreach from=$types key=main_head item=head}
                                                        {foreach $head as $head_item}
                                                            
                                                            {if array_key_exists($heads_key, $contents) && array_key_exists($type_key, $contents[$heads_key]) && array_key_exists($type_order_key, $contents[$heads_key][$type_key]) && array_key_exists($main_head, $contents[$heads_key][$type_key][$type_order_key]) && array_key_exists($head_item,$contents[$heads_key][$type_key][$type_order_key][$main_head])}

                                                                <td {if $head_item=='sum'}style="background:#F5BE87"{/if}>{number_format($contents[$heads_key][$type_key][$type_order_key][$main_head][$head_item],2,'.','')}
                                                                {* {$type_key|cat:'-'|cat:$type_order_key|cat:'-'|cat:$main_head|cat:'-'|cat:$head_item} *}
                                                                </td>
                                                            {else}
                                                                <td {if $head_item=='sum'}style="background:#F5BE87"{/if}></td>
                                                            {/if}   
                                                            
                                                        {/foreach}
                                                    {/foreach}
                                                {/foreach}        
                                            {/foreach}
                                        {/foreach}

                                        {if array_key_exists($date_key, $results_leave)}
                                            {$contents = $results_leave[$date_key]}
                                        {/if}


                                        {foreach from=$heads_leave key=leave_type item=heads_main}
                                            {foreach from=$heads_main key=heads_key item=ordered_heads}
                                                {foreach from=$ordered_heads key=type_key item=ordered_types}
                                                    {foreach from=$ordered_types key=type_order_key item=types}
                                                        {foreach from=$types key=main_head item=head}
                                                            {foreach $head as $head_item}                                                                                                         
                                                                {if array_key_exists($leave_type, $contents) && array_key_exists($heads_key, $contents[$leave_type]) && array_key_exists($type_key, $contents[$leave_type][$heads_key]) && array_key_exists($type_order_key, $contents[$leave_type][$heads_key][$type_key]) && array_key_exists($main_head, $contents[$leave_type][$heads_key][$type_key][$type_order_key]) && array_key_exists($head_item,$contents[$leave_type][$heads_key][$type_key][$type_order_key][$main_head])}
                                                                    
                                                                    <td style="background:{if $head_item=='sum'}#F5BE87{else}#f9dddd{/if}">{number_format($contents[$leave_type][$heads_key][$type_key][$type_order_key][$main_head][$head_item],2,'.','')}
                                                                    {* {$type_key|cat:'-'|cat:$type_order_key|cat:'-'|cat:$main_head|cat:'-'|cat:$head_item} *}
                                                                    </td>
                                                                {else}
                                                                    <td style="background:{if $head_item=='sum'}#F5BE87{else}#f9dddd{/if}"></td>
                                                                {/if}   
                                                                
                                                            {/foreach}
                                                        {/foreach}
                                                    {/foreach}        
                                                {/foreach}
                                            {/foreach}
                                        {/foreach} 
                                        {if !empty($fkkn_slots)}
                                                {if strpos(json_encode($fkkn_slots), "\"1\":") > 0}

                                                    <td style="background:#F5BE87">{if $fkkn_slots.$date_key[1]}{number_format($fkkn_slots.$date_key[1],2,'.','')}{else}&nbsp;{/if}</td>
                                                    {if $fkkn_slots.$date_key[1]}{$tot_fk = $tot_fk + $fkkn_slots.$date_key[1]}{/if}
                                                {/if}
                                                {if strpos(json_encode($fkkn_slots), "\"2\":") > 0 || strpos(json_encode($fkkn_slots), "\"3\":") > 0}
                                                    <td style="background:#F5BE87">{if $fkkn_slots.$date_key[2] || $fkkn_slots.$date_key[3]}{number_format($fkkn_slots.$date_key[2]+$fkkn_slots.$date_key[3],2,'.','')}{else}&nbsp;{/if}</td>
                                                    {if $fkkn_slots.$date_key[2]}{$tot_kntu = $tot_kntu + $fkkn_slots.$date_key[2]}{/if}
                                                    {if $fkkn_slots.$date_key[3]}{$tot_kntu = $tot_kntu + $fkkn_slots.$date_key[3]}{/if}
                                                {/if}
                                        {/if}
                                    </tr>
                                {/foreach}
                                <tr style="background: green; color: white;">
                                    <td align="center">{$translate.total}</td>
                                    {*{foreach $total as $ordered_total}
                                        {foreach $ordered_total as $total_categroy}
                                            {foreach $total_categroy as $ordered_total_categroy}
                                                {foreach $ordered_total_categroy as $temp_total_key=>$ind_total}
                                                    <td>{number_format($ind_total,2,'.','')}{if $login_user == 'dodo001'}{$temp_total_key}{/if}</td>
                                                {/foreach}
                                            {/foreach}
                                        {/foreach}
                                    {/foreach}

                                    {foreach $total_leave as $total_leave_main}
                                        {foreach $total_leave_main as $ordered_total}
                                            {foreach $ordered_total as $total_categroy}
                                                {foreach $total_categroy as $ordered_total_categroy}
                                                    {foreach $ordered_total_categroy as $ind_total}
                                                        <td>{number_format($ind_total,2,'.','')}</td>
                                                    {/foreach}
                                                {/foreach}
                                            {/foreach}
                                        {/foreach}
                                    {/foreach}*}

                                    {$contents = $total}
                                    {foreach from=$heads key=heads_key item=ordered_heads}
                                        {foreach from=$ordered_heads key=type_key item=ordered_types}
                                            {foreach from=$ordered_types key=type_order_key item=types}
                                                {foreach from=$types key=main_head item=head}
                                                    {foreach $head as $head_item}
                                                        
                                                        {if array_key_exists($heads_key, $contents) && array_key_exists($type_key, $contents[$heads_key]) && array_key_exists($type_order_key, $contents[$heads_key][$type_key]) && array_key_exists($head_item,$contents[$heads_key][$type_key][$type_order_key])}

                                                            <td >{number_format($contents[$heads_key][$type_key][$type_order_key][$head_item],2,'.','')}
                                                            
                                                            </td>
                                                        {else}
                                                            <td></td>
                                                        {/if}   
                                                        
                                                    {/foreach}
                                                {/foreach}
                                            {/foreach}        
                                        {/foreach}
                                    {/foreach}

                                    <!-- {if array_key_exists($date_key, $results_leave)}
                                            {$contents = $total_leave}
                                        {/if} -->
                                    {$contents = $total_leave}
                                    {foreach from=$heads_leave key=leave_type item=heads_main}
                                        {foreach from=$heads_main key=heads_key item=ordered_heads}
                                            {foreach from=$ordered_heads key=type_key item=ordered_types}
                                                {foreach from=$ordered_types key=type_order_key item=types}
                                                    {foreach from=$types key=main_head item=head}
                                                        {foreach $head as $head_item}  
                                                            <!-- {$leave_type} -- {$heads_key}==={$type_key}---{$type_order_key}--{$head_item}--<br> -->
                                                            {if array_key_exists($leave_type, $contents) && array_key_exists($heads_key, $contents[$leave_type]) && array_key_exists($type_key, $contents[$leave_type][$heads_key]) && array_key_exists($type_order_key, $contents[$leave_type][$heads_key][$type_key]) && array_key_exists($head_item,$contents[$leave_type][$heads_key][$type_key][$type_order_key])}

                                                                <td>{number_format($contents[$leave_type][$heads_key][$type_key][$type_order_key][$head_item],2,'.','')}
                                                                
                                                                </td>
                                                            {else}
                                                                <td>&nbsp;</td>
                                                            {/if}   
                                                            
                                                        {/foreach}
                                                    {/foreach}
                                                {/foreach}        
                                            {/foreach}
                                        {/foreach}
                                    {/foreach}

                                    {if $tot_fk}<td>{number_format($tot_fk,2,'.','')}</td>{/if}
                                    {if $tot_kntu}<td>{number_format($tot_kntu,2,'.','')}</td>{/if}
                                </tr>
                                
                            </tbody>

                        </table>
                    
                </div>
                {/if}

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

    {if ($login_user_role eq 1 OR $login_user_role eq 6 OR $login_user_role eq 2 OR $login_user_role eq 3 OR $login_user_role eq 7) and ($rpt_content_normal or $rpt_content_travel or $rpt_content_break or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_voluntary or $rpt_content_complementary or $rpt_content_complementary_oncall or $rpt_content_leave_travel or $rpt_content_leave_break or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_voluntary or $rpt_content_leave_oncall or $rpt_content_leave_calltraining or $rpt_content_standby or $rpt_content_leave_standby or $rpt_content_dismissal or $rpt_content_dismissal_oncall)}

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
                                console.log(data);

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
                    location.href = '{$url_path}report/work/employee/detail/new/{$report_year}/{$report_month}/{$employee_id}/'+selected_customer+'/';
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
                    location.href = '{$url_path}report/work/employee/detail/new/'+year+'/'+month+'/{$employee_id}/{$customer_id}/';
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