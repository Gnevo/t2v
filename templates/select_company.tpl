{block name='script'}
<script type="text/javascript">

</script>
{/block}

{block name="content"}
<div class="wrapper">
    <div class="widget widget-heading-simple widget-body-gray">
        {$message}
        <div class="widget-body">
            <form id="form" name="form" method="post" action="{$url_path}select/company/{*change_company.php*}?frm_login{if $redirect neq ''}&redirect={$redirect}{/if}">
                <label for="company">{$translate.company}</label>
                <select name="user_company" id="user_company" class="input-block-level margin-none">
                    {foreach $user_companies as $user_company}
                        <option value="{$user_company.id}" {if $db_name == $user_company.db_name}selected{/if}>{$user_company.name}</option>
                    {/foreach}
                </select> 
                <div class="separator bottom"></div> 
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" id="loginbtn" class="btn btn-inverse pull-right go" value="Go" type="submit">Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}