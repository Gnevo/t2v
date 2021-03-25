
{*if $remove_type eq "2"*}

    <div class="span5" id="signed_list">
        <div class="box-wrpr type span12">
            <span id="span_emp_sign" class="span12 clearfix no-ml mb">
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
            <span id="span_TL_sign" class="span12 clearfix no-ml mb">
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
                {if ($flg eq "1" or $flg eq "2") and $message neq ''}{$message}{/if}
                {if ($report_year < $now_year) || ($report_month <= $now_month && $report_year == $now_year)}
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
                            <div style="float:left; margin-bottom:5px;">
                                <label for="password" class="signing_form_label">{$translate.password}</label>
                                <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                            </div>
                            <div style="float:left; padding:0px 0px 10px 60px; width:100%;" class="clearfix">
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
                    {if ($flg eq "1" or $flg eq "2") and $message neq ''}{$message}{/if}
                    <div class="signing_remove_main"> 
                        <span class="signing signing_for_inner">
                            {*<span id="signing_remove_message" class="signing_success"> {$translate.this_employee_already_signin}</span>*}
                            <span class="signing_delete">{$translate.remove_signin}</span>
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                        </span>
                    </div>
                    {if $flg eq "3"}
                        <div class="span12 text-error mt">{$translate.employer_already_signed_cant_remove}</div>
                    {/if}
                </div>
            {/if}
        {elseif $sign_status eq 'both'} {* Only for admin purpose *}
            <div class="box-wrpr span12">
                {if ($flg eq "1" or $flg eq "2") and $message neq ''}{$message}{/if}
                {if $login_user_role eq 1 or $isGLorAdmin eq true}
                    <div class="signing_remove_main"> 
                        <span class="signing signing_for_inner">
                            {*<span id="signing_remove_message" class="signing_success"> {$translate.this_employee_already_signin}</span>*}
                                <span class="signing_delete">{$translate.remove_signin}</span>
                                <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                        </span>
                    </div>
                    {if $flg eq "3"}
                        <div class="span12 text-error mt">{$translate.employer_already_signed_cant_remove}</div>
                    {/if}
                {/if}

                {if ($report_year < $now_year) || ($report_month <= $now_month && $report_year == $now_year)}    
                    <span class="signing_form clearfix">
                        <div style="float:left; margin-bottom:5px; padding-top:3px;">
                            <label for="username" class="signing_form_label">{$translate.username}</label>
                            <input type="text" id="username" name="username" value="{$login_user}" disabled="disabled" style="background-color:  #D9D9D9; margin-left: 25px;" class="signing_form_text"/>
                        </div>
                        <div style="float:left; margin-bottom:5px;">
                            <label for="password" class="signing_form_label">{$translate.password}</label>
                            <input type="password" id="password" name="password" class="signing_form_text" style="margin-left: 25px;"/>
                        </div>
                        <div style="float:left; padding:0px 0px 10px 60px; width:100%;" class="clearfix">
                            {if $allow_ordinary_signing}<a style="margin-right: 8px; float: left;" name="login" id="login" class="signin_button_account signing_button" href="javascript:void(0)" onclick="check(0)">{$translate.signin}</a>{/if}
                            <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                        </div>    
                        <span id="signing_message" class="signing_error" style="padding-left: 8px;"></span>
                    </span>
                {/if}

        {/if}
        </div>
    </div>
{*else} 
    {if $flg eq "1"}
        {$translate.unsigned}
        {if $remove_emp_type eq '1'}
            ({$translate.employee_wr})
        {else if $remove_emp_type eq '2'}
            ({$translate.super_tl_wr})    
        {else if $remove_emp_type eq '3'}
            ({$translate.super_tl_wr})
        {/if}
    {else if $flg eq "2"}
    {/if}
{/if*}