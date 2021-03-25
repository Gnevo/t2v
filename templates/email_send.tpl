{block name='style'}
<link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
    }
    * html .ui-autocomplete {
            height: 200px;
    }

    #mailing_list .mailing_group ul .mail_grup_customer, #mailing_list .mailing_group ul .mail_grup_customer_unasigned{
        background: none repeat scroll 0 0 rgba(144, 205, 234, 0.47);
    }
    #mailing_list .mailing_group ul .mail_grup_customer_unasigned {
        background: none repeat scroll 0 0 #feeded;
    }
    #mailing_list .mailing_group ul li.mail_grup_customer, #mailing_list .mailing_group ul li.mail_grup_employees{
        list-style: none outside none;
        /*margin: 0 auto;*/
        padding: 4px 0px 4px 3px;
        border: 1px solid rgba(74, 177, 194, 0.91);
    }
    #mailing_list .mailing_group ul li.mail_grup_customer{
        padding: 7px 4px;
    }
    #mailing_list .mailing_group ul li.mail_grup_customer label{
        font-size: 12px !important;
        font-weight: 600 !important;
    }
    #mailing_list li.mail_grup_employees{
        /*padding-left: 0 !important;*/
        border: none;
        margin-bottom: 5px;
        /*padding-right: 15px !important;*/
    }
    #mailing_list li.mail_grup_employees li{
        padding: 6px 4px;
        border-bottom: 1px dotted #ccc;
    }
    #mailing_list li.mail_grup_employees li label{
        line-height: 17px;
    }
    #mailing_list li.mail_grup_employees li.odd{
        background-color: #e3edf0;
    }
    .mailing_group .badge{
        font-size: 10px;
        font-weight: normal;
    }
    #mailing_list li.mail_grup_customer i.toggle-icon{
        color: #7c7c7c;
    }
</style>
{/block}
{block name="script"}
<script src="{$url_path}js/bootbox.js"></script>
<script src="{$url_path}js/demo/common.js?1372280934"></script><!-- Common Demo Script -->
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/demo/form_validator.js"></script><!-- Uniform Forms Plugin -->
<script type="text/javascript">
    $(function() {
        var availableTags = [
            {foreach from=$employees item=employee}
                    {if $sort_by_name == 1}
                        "{$employee.first_name} {$employee.last_name}<{$employee.email}>",     
                    {elseif $sort_by_name == 2}
                        "{$employee.last_name} {$employee.first_name}<{$employee.email}>",     
                    {/if}       
                    {/foreach}
                        ""
                
        ];
        function split( val ) {
                return val.split( /,\s*/ );
        }
        function extractLast( term ) {
                return split( term ).pop();
        }

        $( "#to" )
                // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB &&
                                    $( this ).data( "autocomplete" ).menu.active ) {
                            event.preventDefault();
                    }
            })
            .autocomplete({
                    minLength: 0,
                    source: function( request, response ) {
                            // delegate back to autocomplete, but extract the last term
                            response( $.ui.autocomplete.filter(
                                    availableTags, extractLast( request.term ) ) );
                    },
                    focus: function() {
                            // prevent value inserted on focus
                            return false;
                    },
                    select: function( event, ui ) {
                            var terms = split( this.value );
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push( ui.item.value );
                            // add placeholder to get the comma-and-space at the end
                            terms.push( "" );
                            this.value = terms.join( ", " );
                            return false;
                    }
            });
    });
    
    $(document).ready(function() {
        $('#to').val('');
        /*$("#timing").validate({
                 rules: {
                         to: { required: true },
                         subject: { required: true },
                         mail_body: { required: true }
                 }
         });*/ 
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        });
        
        $(".btn-cancel-right").click(function() {
            close_right_panel();
        });
        
        $(".view-mail-address-box").click(function(e) {
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-recipient-list").removeClass('hide');
            
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);
            e.preventDefault();
        });
        
        $("#recipient_check_all, .check_recipient_groups").click(function(e){
                e.stopPropagation();
        });
        $('#mail-recipient-list #recipient_check_all').click(function () {
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });
        $('#mail-recipient-list .check_recipient_groups').click(function () {
            $(this).parents('.mailing_group').find('li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });
        $('#mailing_list .mailing_group ul li.mail_grup_customer label').click(function () {
            // $(this).parents('.group_box').find('li.mail_grup_employees').toggleClass('collapsed', 1000, "easeOutSine");
            $(this).parents('.group_box').find('li.mail_grup_customer i.toggle-icon').toggleClass('icon-chevron-up icon-chevron-down')
            $(this).parents('.group_box').find('li.mail_grup_employees').slideToggle( "slow", function() {
                // Animation complete.
            });
        });
    });
    
    function close_right_panel(){
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right #mail-recipient-list").addClass('hide');
        $('.main-right #right_message_wraper, #left_message_wraper').html('');
    }
        
    function select_multi_recipients(){
        var selected_recipients = $('#mail-recipient-list input:checkbox:checked.check_recipient_emp').map(function () {
            return this.value;
        }).get(); 
        
        if(selected_recipients.length == 0){
            bootbox.alert('{$translate.no_user_selected}', function(result){ });
        }
        
        else{
            var old_to_val = $.trim($('#to').val());
            
            if(old_to_val != ''){
                var old_splitted = old_to_val.split(',');
                var old_splitted_array = [];
                $.each(old_splitted, function(i, el){
                                if($.trim(el) !== '') old_splitted_array.push($.trim(el));
                            });
                //console.log(old_splitted_array);
                selected_recipients = $.merge( old_splitted_array, selected_recipients );

            }
            //removing dublicate employee values from different customers
            var uniqueRecipients = [];
            $.each(selected_recipients, function(i, el){
                if($.inArray($.trim(el), uniqueRecipients) === -1) uniqueRecipients.push($.trim(el));
            });
            //console.log(uniqueRecipients);

            var new_to_val = uniqueRecipients.join(', ');
            $('#to').val(new_to_val);
            
            close_right_panel();
        }
    }
    
    function submitForm(){
            var to = $.trim($("#to").val());
            var subject = $.trim($("#subject").val());
            var message = $.trim($("#mail_body").val());
            var error = 0;
            if(to == ''){
                bootbox.alert('{$translate.no_user_selected}', function(result){ });
                $("#to").focus();
                error = 1;
            }
            else if(subject == "" || subject == null){
                bootbox.alert('No subject', function(result){ });
                $('#subject').focus();
                error = 1;
            }
            else if(message == "" || message == null){
                bootbox.alert('No message', function(result){ });
                $('#mail_body').focus();
                error = 1;
            }
            
            if(error == 0){
                $("#timing").submit();
            }
    }

    function reset_form(){
            //$("#timing").reset();
            document.getElementById("timing").reset();
    }
        
    function validate(){
            return true;
    } 
</script>
{/block}


{block name="content"}
    <div class="row-fluid"  id="main_container">
{*        main left*}
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.mail}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button class="btn btn-default btn-normal pull-right"  onclick="submitForm()" style="" type="button"><i class=' icon-location-arrow'></i> {$translate.send}</button>
                        <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button" onclick="javascript:location='{$url_path}message/center/';"><i class='icon-arrow-left'></i> {$translate.backs}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group" style="height: 22.5em">
                <div class="row-fluid" >
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.compose_mail}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group" style="height: 17.5em">
                        <form name="timing" id="timing" method="post">
                            <div class="span6 form-left">
                                <div style="margin: 0px 0px 10px ! important;" class="span12 control-group">
                                    <label style="float: left;" class="span12" for="to">{$translate.to}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <span class="controls"><input name="to" id="to" class="form-control span8" type="text" /></span>
                                        <span style="border-radius: 0px ! important;" class="add-on view-mail-address-box"> {$translate.insert_mailing_ids}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="span6 form-right">
                                <div style="margin: 0px 0px 10px ! important;" class="span12 control-group">
                                    <label style="float: left;" class="span12" for="subject">{$translate.subject}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <span class="controls"><input name="subject" id="subject" class="form-control span11" type="text"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span12 control-group" style="margin:0">
                                <label for="mail_body" class="span12" style="margin-top:0;">{$translate.message}:</label>
                                <span class="controls"><textarea name="mail_body" id="mail_body" rows="5" class="form-control span12" ></textarea></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
{*        main right*}
        <div class="span4 main-right hide">
            <div class="row-fluid hide" id="mail-recipient-list">
                <div class="span12 addnew-mail-visible" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="span5 day-slot-wrpr-header-left span6">
                                <h1 style="">{$translate.edit}</h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right"  onclick="select_multi_recipients()" style="" type="button"><i class=' icon-ok'></i> {$translate.inserts}</button>
                                <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-arrow-left'></i> {$translate.cancel}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group email-list-box">
                            <div class="row-fluid">
                                <div class="span12 no-ml" id="mailing_list">
                                    <div class="span12" id="options_panel">
                                        <label class="pull-left" for="select_all">{$translate.select_all}</label>
                                        <input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all" class="pull-right">
                                    </div>
                                    {foreach from=$employees_group item=employee}
                                        {if $employee.customer_name != 'ALL'}
                                            <div class="mailing_group span12 no-ml">
                                                <ul class="span12 no-ml group_box">
                                                    <li class="mail_grup_customer span12">
                                                        <label for="cch_{$employee.customer_username}" class="pull-left span11">{$employee.customer_name} <i class="pull-right icon icon-chevron-down toggle-icon"></i></label>
                                                        <input type="checkbox" value="{$employee.customer_username}" name="cch_{$employee.customer_username}" id="cch_{$employee.customer_username}" class="pull-right check_recipient_groups">
                                                    </li>            
                                                    <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt" style="display: none;">
                                                        <ul class="span12">
                                                            {foreach from=$employee.employees_customer item=empl}
                                                                {if $empl.email neq ''}
                                                                <li class="span12 no-ml {cycle values="even,odd"}">
                                                                    <label class="pull-left span11" for="cch_{$empl.username}_{$employee.customer_username}">{$empl.first_name} {$empl.last_name} <span class="badge badge-info">&lt;{$empl.email}&gt;</span></label>
                                                                    <input type="checkbox" value="{$empl.first_name|escape:'html'} {$empl.last_name|escape:'html'}<{$empl.email}>" class="pull-right check_recipient_emp" id="cch_{$empl.username}_{$employee.customer_username}" name="cch_{$empl.username}_{$employee.customer_username}">
                                                                </li>
                                                                {/if}
                                                            {/foreach}
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        {/if}
                                    {/foreach}
                                    {if $login_user_role eq 1}
                                        <div class="mailing_group span12 no-ml">
                                            <ul class="span12 no-ml no-ml group_box">
                                                <li class="mail_grup_customer_unasigned span12">
                                                    <label for="cch_unassigned_emps" class="pull-left span11">{$translate.unassigned_employees} <i class="pull-right icon icon-chevron-down toggle-icon"></i></label>
                                                    <input type="checkbox" value="" name="cch_unassigned_emps" id="cch_unassigned_emps" class="pull-right check_recipient_groups">
                                                </li>            
                                                <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt" style="display: none;">
                                                    <ul class="span12">
                                                        {foreach from=$employees_group item=employee}
                                                            {if $employee.customer_name == 'ALL'}
                                                                {if $employee.employees.email neq ''}
                                                                <li class=" span12 no-ml {cycle values="even,odd"}">
                                                                    <label class="pull-left span11" for="cch_{$employee.employees.username}">{$employee.employees.first_name} {$employee.employees.last_name} <span class="badge badge-info">&lt;{$employee.employees.email}&gt;</span></label>
                                                                    <input type="checkbox" value="{$employee.employees.first_name|escape:'html'} {$employee.employees.last_name|escape:'html'}<{$employee.employees.email}>" class="pull-right check_recipient_emp" id="cch_{$employee.employees.username}" name="cch_{$employee.employees.username}">
                                                                </li>
                                                                {/if}
                                                            {/if}
                                                        {/foreach}
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}
