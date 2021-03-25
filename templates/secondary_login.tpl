{block name='script'}
<script async src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
function forget_password(){
    {if $user_have_multiple_company}
        var company_id = $('#user_company').val();
        if(typeof company_id == 'undefined') company_id = '';
    {else}
        var company_id = '{$sel_company_id}';
    {/if}
    document.location = '{$url_path}secondary/login/forgotpassword/'+company_id+'/';
}
{if $cancel_button}
    function cancel_selection(){
        $("#user_company_selection_cancel").submit();
    }
{/if}
$(document).ready(function (){
    $("#password").focus();
    $('#chk_terms').click(function() {
        if({$agreement})
                $("#loginbtn").prop('disabled',!this.checked);
    });  
    {if $login_cookie}
        $("#loginbtn").prop('disabled',false);
    {/if}
});
 //bootbox.alert('{$translate.invalid_date}', function(result){  });
</script>
{/block}

{block name="content"}
<div class="wrapper">
    
    <div class="">{$message}</div>
    <div class="widget widget-heading-simple widget-body-gray clearfix">
        <div class="widget-body no-ml">
            <form id="form" name="form" method="post" action="{$url_path}secondary/login/{if isset($redirect) and $redirect neq ''}?redirect={$redirect}{/if}">
                {*<label>{$translate.selected_company}</label>
                <label class="input-block-level medium"><strong>{$company_details.name}</strong></label>
                <label class="input-block-level medium"><a class="password pull-right" href="{$url_path}select/company/">{$translate.change_company}</a></label>*}
                
                <label>{$translate.username_login_secondary}</label>
                <input name="username" id="username" value="{$smarty.session.user_id}" class="input-block-level required medium" type="text" readonly="readonly" /> 
                
                {if $current_user_role neq 0}
                    {if $user_have_multiple_company}
                        <label for="company">2. {$translate.company_login}</label>
                        <select name="user_company" id="user_company" class="input-block-level mb">
                            {foreach $user_companies as $user_company}
                                <option value="{$user_company.id}" {if isset($smarty.post.user_company) and $smarty.post.user_company eq $user_company.id}selected="selected"{else if isset($smarty.session.db_name) and $smarty.session.db_name eq $user_company.db_name}selected="selected"{/if}>{$user_company.name}</option>
                            {/foreach}
                        </select> 
                    {else}
{*                        <label class="input-block-level medium"><strong>{$company_details.name}</strong></label>*}
                        <input type="hidden" value="{$sel_company_id}" name="user_company" />
                    {/if}
                {/if}
                <label for="password">{if $user_have_multiple_company}3{else}2{/if}. {$translate.password_login}{*$translate.secondary_password*}</label>
                <input name="password" id="password" type="password" tabindex="2" class="input-block-level margin-none required medium"/>
                <div class="separator bottom"></div>

                {*if $agreement}
                    <!--<div class="row-fluid" style="margin-bottom: 15px">
                        <input type="checkbox" id="chk_terms" style="margin: -1px 5px 0 0 !important"><label for="chk_terms" style="display: contents;">{$translate.accept_terms_conditions}</label><a href="{$url_path}GDPRTime2viewAB.pdf" target="_blank">{$translate.user_terms_conditions}</a>
                    </div> -->   
                {/if*}
                
                <div class="row-fluid" style="margin-bottom: 15px">
                        <input type="checkbox" id="chk_terms" style="margin: -1px 5px 0 0 !important" {if $login_cookie} checked {/if}><label for="chk_terms" style="display: contents;">{$translate.accept_terms_conditions}</label><a href="{$url_path}GDPRTime2viewAB.pdf" target="_blank">{$translate.user_terms_conditions}</a>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" id="loginbtn" class="btn btn-inverse logn_btn pull-right ml" value="{$translate.login}" type="submit" {if $agreement}disabled="true"{/if}>{$translate.login}</button>
                        {if $cancel_button}
                            <button name="btnCancel" id="btnCancel" class="btn btn-danger logn_btn pull-right ml" value="{$translate.cancel}" type="button" onclick="cancel_selection();">{$translate.cancel}</button>
                        {else}
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="{$translate.back}" type="button" onclick="document.location.href='{$url_path}';">{$translate.back}</button>
                        {/if}
                        {if $current_user_role neq 0}<a class="password pull-left" onclick="forget_password();" href="javascript:void(0);">{$translate.forgot_password}</a>{/if}
                    </div>
                </div>
            </form>
            {if $cancel_button}
                <form id="user_company_selection_cancel" class="hide" action="{$url_path}change_company.php" method="post" name="user_company_selection_cancel">
                    <input type="hidden" name="action" value="cancel_selection" />
                </form>
            {/if}
                            
        </div>
    </div>
            
</div>
            {* <img src="{$url_path}images/login.png" style="margin: 0 auto; width:100%; border:solid 3px #fff;"/> *}
{/block}