{block name='script'}
{*<script src="{$url_path}js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/demo/form_validator.js"></script><!-- Uniform Forms Plugin -->*}
<script async src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
                
       $("#form").submit(function (event) {
            
           if($("#old_password").val().trim().length  == 0){
               bootbox.alert('{$translate.fill_old_password}', function(result){ $("#old_password").focus(); });
               
               event.preventDefault();
           }
           else if($("#new_password").val().trim().length < 8){
               bootbox.alert('{$translate.password_new_minimum_length}', function(result){ setTimeout(function(){ $("#new_password").focus()},500);});
               event.preventDefault();
           }else if($("#re_password").val().trim().length < 8){
               bootbox.alert('{$translate.password_re_minimum_length}', function(result){ setTimeout(function(){ $("#re_password").focus()},500);});
               event.preventDefault();
           }else if($("#new_password").val() != $("#re_password").val()){
               bootbox.alert('{$translate.password_must_match}', function(result){ $("#re_password").focus(); });
               event.preventDefault();
           }
           
       });
    });
</script>
{/block}

{block name="content"}
<div class="wrapper">
    <div class="widget widget-heading-simple widget-body-gray">
        {$message}
        <div class="widget-body">
            <form id="form" name="form" method="post" action="{$url_path}change/password/" autocomplete="off" novalidate="novalidate">
                <div class="control-group">
                    <label for="old_password" class="control-label">{$translate.current_password}</label>
                    <div class="controls"><input name="old_password" id="old_password" type="password" tabindex="1" autofocus="true" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="control-group">
                    <label for="new_password" class="control-label">{$translate.new_password}</label>
                    <div class="controls"><input name="new_password" id="new_password" type="password" tabindex="2" minlength="8" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="control-group">
                    <label for="re_password" class="control-label">{$translate.retype_new_password}</label>
                    <div class="controls"><input name="re_password" id="re_password" type="password" tabindex="3" minlength="8" class="input-block-level required medium margin-none"/> </div>
                </div>
                
                <div class="separator bottom"></div> 
                <div class="row-fluid">
                    <div class="span12">
                        <button name="login" class="btn btn-inverse pull-right go" type="submit">{$translate.save}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}