{block name='script'}
{*<script type='text/javascript' src='{$url_path}js/button.js'></script>*}
<script type="text/javascript">
$(document).ready(function (){
    $("#username").focus(); 
});
</script>
        <!--SNOW RAINING-->
{/block}

{block name="content"}
<div class="wrapper">
    <div class="widget widget-heading-simple widget-body-gray">
        {$message}
        <div class="widget-body">
            <form id="form" name="form" method="post" action="auth.php{if $redirect neq ''}?redirect={$redirect}{/if}">
                <label for="username">{$translate.username}</label>
                <input name="username" id="username" tabindex="1" autofocus="true" class="input-block-level required medium" type="text"/> 
                <label for="password">{$translate.password}</label>
                <input name="password" id="password" type="password" tabindex="2" class="input-block-level margin-none required medium"/>
                <div class="separator bottom"></div> 
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" id="loginbtn" class="btn btn-inverse logn_btn pull-right ml" value="{$translate.login}" type="submit">{$translate.login}</button>
                        <a class="password pull-left" href="forgotpassword/">{$translate.forgot_password}</a>
{*                        <div id-val="P3sYNm2a2H8=" caption="Testing Button" class="cirrus-button btn btn-inverse pull-right mr" style="background-color: #fff;border: 1px solid #e8e8e8;padding: 3px 8px;"></div>*}
                    </div>
                </div>
            </form>
        </div>
    </div>
    {*<div class="innerT center">
        <a href="{$url_path}recruitment_application.php" class="btn btn-icon-stacked btn-block btn-success"><span>{$translate.recruitment_application}</span></a>	
    </div>*}
</div>
{/block}
