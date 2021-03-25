{block name='script'}
<script async src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
$(document).ready(function (){
    $("#otp").focus(); 
    
     $("#otpform").submit(function (event) {
            var error = 0;
            if($('#otp'). val() == ''){
                error = 1;
                bootbox.alert('{$translate.enter_valid_otp}', function(result){  });
            }
       
            if (error == 1) {
                event.preventDefault();
            }
        });
});
{if $cancel_button}
    function cancel_selection(){
        $("#user_company_selection_cancel").submit();
    }
{/if}
 //bootbox.alert('{$translate.invalid_date}', function(result){  });

</script>
{/block}

{block name="content"}

<div class="wrapper">
    <div class="">{$message}</div>
    <div class="widget widget-heading-simple widget-body-gray clearfix">
        <div class="widget-body no-ml">
            {if $allow_pword_reset eq 'YES'}
                <form id="otpform" name="otpform" method="post" action="">

                    <input name="sel_company" type="hidden" value="{$sel_company_id}"/>
                    <input name="username" type="hidden" value="{$sel_username}"/> 
                    <input name="otp" type="hidden" value="{$sel_otp}"/> 

                    <div class="control-group">
                        <label class="control-label" for="password">{$translate.new_password}</label>
                        <div class="controls"><input name="password" id="password" type="password" tabindex="1" autocomplete="off" autofocus="true" value = "" class="input-block-level required medium" style="margin-bottom: 0px;"/> </div>
                    </div>
                    <div class="control-group">
                        <label  class="control-label" for="cpassword">{$translate.confirm_password}</label>
                        <div class="controls"><input name="cpassword" id="cpassword" type="password" tabindex="2" autocomplete="off" class="input-block-level margin-none required medium"/></div>
                    </div>
                    <div class="separator bottom"></div> 
                    <div class="row-fluid">
                        <div class="span12">
                            <input name="action" id="action" type="hidden" value="RESET-PASSWORD" />
                            <button name="btnUpdate" id="btnUpdate" class="btn btn-inverse logn_btn pull-right ml" value="{$translate.reset_password}" type="submit">{$translate.reset_password}</button>
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="{$translate.back}" type="button" onclick="document.location.href='{$url_path}';">{$translate.back_to_login}</button>
                            {*if $current_user_role neq 0}<a class="password pull-left" href="{$url_path}secondary/login/">{$translate.back_to_login}</a>{/if*}
                        </div>
                    </div>
                </form>   
            {else}
                <form id="otpform" name="otpform" method="post" action="">
                    <div class="control-group">
                        <label>{$translate.selected_company}</label>
                        <label class="input-block-level medium"><strong>{$company_details.name}</strong></label>
                        <input name="sel_company" id="sel_company" type="hidden" value="{$company_details.id}"/>
                    </div>

                    <label>{$translate.username_login_secondary}</label>
                    <input name="username" id="username" value="{$smarty.session.user_id}" class="input-block-level required medium" type="text" readonly="readonly" /> 
                    
                    <label for="otp">{$translate.otp}{*$translate.secondary_password*}</label>
                    <input name="otp" id="otp" type="text" tabindex="2" class="input-block-level margin-none required medium"/>
                    <div class="separator bottom"></div> 
                    <div class="row-fluid">
                        <div class="span12">
                            <input name="action" id="action" type="hidden" value="OTP-VALIDATION" />
                            <button name="btnOtp" id="btnOtp" class="btn btn-inverse logn_btn pull-right ml" value="{$translate.btn_validate}" type="submit">{$translate.btn_validate}</button>
                            <button name="btnBack" id="btnBack" class="btn btn-danger logn_btn pull-right ml" value="{$translate.back}" type="button" onclick="document.location.href='{$url_path}';">{$translate.back_to_login}</button>
                            {*if $current_user_role neq 0}<a class="password pull-left" href="{$url_path}secondary/login/">{$translate.back_to_login}</a>{/if*}
                        </div>
                    </div>
                </form>  
            {/if}   
        </div>
    </div>
</div>
{/block}