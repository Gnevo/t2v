z{block name='style'}
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
        background: none repeat scroll 0 0 #e3f2f6;
    }
    #mailing_list .mailing_group ul .mail_grup_customer_unasigned {
        background: none repeat scroll 0 0 #feeded;
    }
    #mailing_list .mailing_group ul li{
        border-color: -moz-use-text-color #e8eff1 #e8eff1;
        border-style: none solid solid;
        border-width: medium 1px 1px;
        list-style: none outside none;
        margin: 0 auto;
        padding: 4px 3px 4px 5px;
    }
    #mailing_list li.mail_grup_employees{
        /*padding-left: 0 !important;*/
        border: none;
        padding-right: 15px !important;
    }
    
    

    #employee_list_div ul{
      
      /*columns: 4;
      -webkit-columns: 4;
      -moz-columns: 4;
      list-style-position: inside;*/

    }

    .customer_group .admins_list{
      
      columns: 4;
      -webkit-columns: 4;
      -moz-columns: 4;
      list-style-position: inside;
      border: 1px solid #ddd;

    }

    .list-group-item.active, #people .list-group-item.active:hover, #people .list-group-item.active:focus {
        z-index: 2;
        color: #fff;
        background-color: rgba(133, 103, 35, 0.79);
        border-color: #63340d;
    }

    .list-group-item:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 3px 15px;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .mob_chk_cls{
        margin: 0px 5px 0px 0px !important;
    }
    .sms-text-container{
        margin-bottom: 10px; 
        background:rgba(0, 0, 0, 0) linear-gradient(to bottom, rgb(145, 217, 233) 0px, rgb(144, 221, 236) 100%) repeat scroll 0 0; 
        padding: 10px; 
        text-align: center;
    }
    .customer_group { margin-bottom: 4px; }
    label.customer_name {
        overflow: hidden;
        white-space: nowrap;
        width: 70%;
        text-overflow: ellipsis;
    }
    .admins_list .list-group-item{ margin-bottom: 0px; }
    #employee_list_div_main_wrpr .toggler-class:before, #unsigned_employee_list_div_main_wrpr .toggler-class:before { content: "\f077"; }
    #employee_list_div_main_wrpr .collapsed .toggler-class:before, #unsigned_employee_list_div_main_wrpr .collapsed .toggler-class:before { content: "\f078"; }
</style>
{/block}
{block name="script"}
<script src="{$url_path}js/bootbox.js"></script>
<script src="{$url_path}js/demo/common.js?1372280934"></script><!-- Common Demo Script -->
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script><!-- Uniform Forms Plugin -->
<script src="{$url_path}js/demo/form_validator.js"></script><!-- Uniform Forms Plugin -->
<script type="text/javascript">
    
    $(document).ready(function() {
        
        
        
        //alert($(window).height());
        if($(window).height() > 600){
            $('#gdschema_kund').css({ height: $(window).height()-53}); 
            $('#employee_list_div').css({ height: $(window).height()-293}); 
        }
        else{
            $('#gdschema_kund').css({ height: $(window).height()});    
            $('#employee_list_div').css({ height: $(window).height()});    
        }

        $(window).resize(function(){
            if($(window).height() > 600){
                $('#gdschema_kund').css({ height: $(window).height()-53}); 
                $('#employee_list_div').css({ height: $(window).height()-293}); 
            }
            else{
                $('#gdschema_kund').css({ height: $(window).height()});  
                $('#employee_list_div').css({ height: $(window).height()});  
            }
        });  


        $(".check_all").change(function() {
          var val = $(this).attr('data-group');
          if(val == 'all'){
                $('input:checkbox.mob_chk_cls').prop('checked', this.checked);    
          }else{
              if( $(this).is(":checked") ) {

                $(":checkbox[data-group='"+val+"']").attr("checked", true);
              }else {
                $(":checkbox[data-group='"+val+"']").attr("checked", false);
              }
          }

        });

        $(".check_all_unsigned").change(function() {
          var val = $(this).attr('data-group');
          if(val == 'all'){
                $('input:checkbox.mob_unsigned').prop('checked', this.checked);    
          }else{
              if( $(this).is(":checked") ) {

                $(":checkbox[data-group='"+val+"']").attr("checked", true);
              }else {
                $(":checkbox[data-group='"+val+"']").attr("checked", false);
              }
          }

        });


        $('#employee_list_div .customer_group .customer_header label, #employee_list_div .customer_group .customer_header i.toggle-icon').click(function () {
            // $(this).parents('.group_box').find('li.mail_grup_employees').toggleClass('collapsed', 1000, "easeOutSine");
            $(this).parents('.customer_group').find('.customer_header i.toggle-icon').toggleClass('icon-chevron-up icon-chevron-down')
            $(this).parents('.customer_group').find('.members_list').slideToggle( "slow", function() { });
        });


    });
    
    
    
    
    function submitForm(){
            var message = $.trim($("#mail_body").val());
            var error = 0;
            if($("#timing .check-atleast-one:checked").length <= 0){
                bootbox.alert('{$translate.no_user_selected}', function(result){ });
                error = 1;
            }
            else if(message == "" || message == null){
                bootbox.alert('No message', function(result){ });
                $('#mail_body').focus();
                error = 1;
            }
            
            if(error == 0){
                $("#timing #special_action").val('SMS');
                $("#timing").submit();
            }
    }

    function submitFormPush(){
            var message = $.trim($("#mail_body").val());
            var error = 0;
            if($("#timing .check-atleast-one:checked").length <= 0){
                bootbox.alert('{$translate.no_user_selected}', function(result){ });
                error = 1;
            }
            else if(message == "" || message == null){
                bootbox.alert('No message', function(result){ });
                $('#mail_body').focus();
                error = 1;
            }
            
            if(error == 0){
                $("#timing #special_action").val('PUSH');
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

    function get_unsigned_employee(){
        var year = $("#cur_year").val();
        var month = $("#prev_month").val();
        if(year && month ){
            $.ajax({
                url:"{$url_path}sms/",
                type:"POST",
                dataType: 'json',
                data: { 'year': year, 'month': month, 'action': 'get_unsigned_employee'},
                success:function(data){
                    $('#unsignde_emp_div').empty();
                    if(data.status == true){
                        if(data.data != null){
                            $.each(data.data , function (index, value){
                            $('#unsignde_emp_div').append('<div class = "span3" id ="chunk_div'+index+'"></div>');
                              $.each(value , function (index1, value1){
                                var name = {$sort_by_name} == 1 ? value1.first_name+' '+value1.last_name : value1.last_name+' '+value1.first_name ;
                                var checkbox = value1.emp_mob != '' ? '<input class="mob_unsigned check-atleast-one pull-left" type="checkbox" name="mob_no[]" data-group="'+value1.emp_mob+'"  value="'+value1.user_name+'-'+value1.emp_mob+'" style="margin-right: 5px !important; margin-top: 3px !important;">' : '' ; 
                                $('#chunk_div'+index).append('<div class="list-group span12 no-ml customer_group">\n\
                                                                <div class="list-group-item active span12 no-ml customer_header">\n\
                                                                  '+checkbox+'  \n\
                                                                    <label class="pull-left customer_name" title="">'+name+'</label>\n\
                                                                </div>\n\
                                                                </div>');
                                });
                            });
                        }
                        else{
                            $('#unsignde_emp_div').append('<div class="span12 message">{$translate.no_data_available}</div>');
                        }
                    }
                }
            });
        }
        else{
            return false;
        }
        
    }

    $('.btn-switch-mail').click(function(){
            location.href = '{$url_path}mail/list/';
        });
</script>
{/block}


{block name="content"}
    <div class="row-fluid"  id="main_container">
        {*main left*}
        <div class="span12 main-left" id="gdschema_kund">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.sms}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button" onclick="javascript:location='{$url_path}message/center/';"><i class='icon-arrow-left'></i> {$translate.backs}</button>
                        {if $privilege_mc.cirrus_mail eq 1}
                            <button type="button" class="btn btn-default btn-switch-mail pull-right">{$translate.switch_mail}</button>
                        {/if}
                   
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px ! important;" class="widget">
                            <div class="widget-header span12">
                                <div class="span4 day-slot-wrpr-header-left span6">
                                    <h1>{$translate.compose_sms}</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal pull-right"  onclick="submitForm()" style="" type="button"><i class=' icon-location-arrow'></i> {$translate.send_sms}</button>
                                    <button class="btn btn-default btn-normal pull-right no-ml"  onclick="submitFormPush()" style="margin-right: 5px; display: none;" type="button"><i class=' icon-mobile-phone'></i> {$translate.send_push_notification}</button>
                                    <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group no-ml">
                        <form name="timing" id="timing" method="post" class="clearfix">
                            <input type="hidden" id="special_action" name="special_action" value="" />
                            <div class="span12 no-ml" style="text-align: center;">
                                <div class="span12 sms-text-container">
                                    <label for="mail_body" class="span12" style="margin-top:0;">{$translate.message}:</label>
                                    <span class="controls"><textarea name="mail_body" id="mail_body" rows="1" class="form-control span12" maxlength="160"></textarea></span>
                                </div>
                            </div>

                            <div class="span12 no-ml" id="employee_list_div" style="overflow: auto;">
                                <div class="row-fluid" style="margin-top: 15px;" id="employee_list_div_main_wrpr">
                                    <div class="span12 collapsed" data-toggle="collapse" data-target="#all_employee_list">
                                        <div style="margin: 0px ! important;" class="widget">
                                            <div class="widget-header span12">
                                                <h1 class="pull-left">{$translate.all}</h1>
                                                <span class="pull-right" style="margin: 10px;">
                                                    <i class="icon icon- toggle-icon mr toggler-class"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="no-ml span12 widget-body-section input-group collapse no-min-height" id="all_employee_list" style="padding: 0px; min-height: 0px; height: 2px;">
                                        <div class="span12 no-ml text-right" style="padding: 10px;"><span style="margin-right: 5px;">{$translate.check_all}</span><input type="checkbox" class="check_all" data-group="all" title="{$translate.check_all}"></div>
                                        <div class="clearfix"></div>
                                        {*<ul id="employee_list" class="list-group">
                                            {if !empty($employee_list['admins'])}
                                                <li class="list-group-item active">{$translate.admins}<span style="float: right"><input type="checkbox" class="check_all" data-group="admins"></span></li>
                                                {foreach $employee_list['admins'] as $employee}
                                                    <li class="list-group-item"><input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="admins" value="{$employee['user']}-{$employee['mobile']}" style="margin-right: 5px !important">{$employee['name']}</li>
                                                {/foreach}
                                            {/if}
                                            {foreach $employee_list['teams'] as $customer}
                                                <li class="list-group-item active"><input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="{$customer['mobile']}"  value="{$customer['user']}-{$customer['mobile']}" style="margin-right: 5px !important">{$customer['name']}<span style="float: right"><input type="checkbox" class="check_all" data-group="{$customer['mobile']}"></span></li>
                                                {foreach $customer['members'] as $employee_members}
                                                    <li class="list-group-item"><input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="{$customer['mobile']}" value="{$employee_members['user']}-{$employee_members['mobile']}"  style="margin-right: 5px !important">{$employee_members['name']}</li>
                                                {/foreach}
                                            {/foreach}
                                        </ul>*}
                                        <div class="span12 no-ml" style="padding: 10px;">
                                            {if !empty($employee_list['admins'])}
                                                <div class="span12" style="margin-bottom: 5px;">
                                                    <div class="list-group span12 no-ml customer_group">
                                                        <div class="list-group-item active span12 no-ml customer_header">
                                                            <label class="pull-left">{$translate.admins}</label>
                                                            <span style="float: right">
                                                                <i class="icon icon-chevron-down toggle-icon mr"></i>
                                                                <input type="checkbox" class="check_all" data-group="admins">
                                                            </span>
                                                        </div>
                                                        <div class="members_list clearfix admins_list span12 no-ml" style="display: none; padding: 5px;">
                                                            {foreach $employee_list['admins'] as $employee}
                                                                <div class="list-group-item clearfix">
                                                                    {*if $employee['mobile']}<input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="admins" value="{$employee['user']}-{$employee['mobile']}" style="margin-right: 5px !important">{$employee['name']}{else}<span style="margin-left: 25px;">{$employee['name']}</span>{/if*}
                                                                    <div class="span1 no-min-height">{if $employee['mobile']}<input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="admins" value="{$employee['user']}-{$employee['mobile']}">{else}&nbsp;{/if}</div>
                                                                    <div class="span11 no-min-height">{$employee['name']}</div>
                                                                </div>
                                                            {/foreach}
                                                        </div>
                                                    </div>
                                                </div>
                                            {/if}
                                            <div class="span12 no-ml">
                                                {foreach $splitted_teams as $teams}
                                                    <div class="span3">
                                                        {foreach $teams as $customer}
                                                            <div class="list-group span12 no-ml customer_group">
                                                                <div class="list-group-item active span12 no-ml customer_header">
                                                                    <input class="mob_chk_cls check-atleast-one pull-left" type="checkbox" name="mob_no[]" data-group="{$customer['mobile']}"  value="{$customer['user']}-{$customer['mobile']}" style="margin-right: 5px !important; margin-top: 3px !important;"> 
                                                                    <label class="pull-left customer_name" title="{$customer['name']|escape:'html'}">{$customer['name']}</label>
                                                                    <span style="float: right">
                                                                        <i class="icon icon-chevron-down toggle-icon mr"></i>
                                                                        <input type="checkbox" class="check_all" data-group="{$customer['mobile']}">
                                                                    </span>
                                                                </div>
                                                                <div class="members_list clearfix" style="display: none;">
                                                                    {foreach $customer['members'] as $employee_members}
                                                                        <div class="list-group-item span12 no-ml">
                                                                            {*if $employee_members['mobile']}<input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="{$customer['mobile']}" value="{$employee_members['user']}-{$employee_members['mobile']}"  style="margin-right: 5px !important">{$employee_members['name']}{else}<span style="margin-left: 25px;">{$employee_members['name']}</span>{/if*}
                                                                            <div class="span1 no-min-height">{if $employee_members['mobile']}<input class="mob_chk_cls check-atleast-one" type="checkbox" name="mob_no[]" data-group="{$customer['mobile']}" value="{$employee_members['user']}-{$employee_members['mobile']}">{else}&nbsp;{/if}</div>
                                                                            <div class="span11 no-min-height">{$employee_members['name']}</div>
                                                                        </div>
                                                                    {/foreach}
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row-fluid" style="margin-top: 15px;" id="unsigned_employee_list_div_main_wrpr">
                                    <div class="span12 collapsed" data-toggle="collapse" data-target="#collapse_employee">
                                        <div style="margin: 0px ! important;" class="widget">
                                            <div class="widget-header span12">
                                                <h1 class="pull-left">{$translate.unsigned_employees}</h1>
                                                <span class="pull-right" style="margin: 10px;">
                                                    <i class="icon icon- toggle-icon mr toggler-class"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span12 widget-body-section input-group collapse" id="collapse_employee" style="padding: 0px;min-height:0px;">
                                        <div class="row-fluid" style="padding: 10px;">
                                            <div class="pull-left mr">
                                                {$translate.year}:

                                                <select name=cur_year id=cur_year>
                                                    {html_options values=$year_option_values selected=$current_year output=$year_option_values}
                                                </select>
                                            </div>
                                            <div class="pull-left ml mr">
                                                {$translate.month}:
                                                <select name=prev_month id=prev_month>
                                                    <option value="" >{$translate.select_month}</option>
                                                        {html_options values=$month_option_values selected=$prev_month output=$month_option_output_full}
                                                </select>
                                            </div>
                                            <div class="pull-left ml">
                                                <button type="button" class="btn btn-primary" onclick="get_unsigned_employee()">{$translate.get_employee}</button>
                                            </div>
                                            <div class="pull-right ml mt">
                                                <div class="span12" style="padding-right: 15px;">
                                                    <span style="margin-right: 5px;">Markera alla</span><input type="checkbox" class="check_all_unsigned" data-group="all" title="Markera alla">
                                                </div>
                                            </div>
                                        </div>


                                        <div style="padding: 10px;">
                                            <div class="span12 no-ml" id="unsignde_emp_div">
                                                {if $current_unsigned_employees.status = true}
                                                    {foreach $current_unsigned_employees.data item = employee }
                                                        <div class = "span3">
                                                        {foreach $employee item = data }
                                                            <div class="list-group span12 no-ml customer_group">
                                                            <div class="list-group-item active span12 no-ml customer_header">
                                                                {if $data.emp_mob != ''} <input class="mob_unsigned check-atleast-one pull-left" type="checkbox" name="mob_no[]" data-group="{$data.emp_mob}"  value="{$data.user_name}-{$data.emp_mob}" style="margin-right: 5px !important; margin-top: 3px !important"> {else}  {/if} 
                                                                <label class="pull-left customer_name" title="">
                                                                    {if $sort_by_name == 1} {$data.first_name} {$data.last_name}   {else} {$data.last_name} {$data.first_name} {/if}
                                                                </label>
                                                            </div>
                                                            </div>
                                                        {/foreach}
                                                        </div>
                                                    {/foreach}
                                                {else}
                                                    <div class="span12 message">{$translate.no_data_available}</div>
                                                {/if}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}