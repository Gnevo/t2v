{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style>
    .ui-dialog{ z-index: 5001 !important;}
</style>
{/block}
{block name='script'}
<script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
<script type="text/javascript">


$(document).ready(function(){
$.mask.definitions['~']='[1-9]';
    $("#org_no").mask("?~99999-9999", { placeholder:" " });
//$("#org_no").mask("~999999-9999");
if($('#username1').val() == ''){
        $( "#contract_from, #contract_to" ).datepicker({
            showOn: "button",
            dateFormat: "yy-mm-dd",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
    });
}
//generating username w.r.t lastname blur
        $('#database').blur(function() {
            var data_val = $('#database').val();
            if(data_val == "1"){
                 $('#database').addClass("error");
            }else{
                 $('#database').removeClass("error");
            }
        });
        
        $('#company_name').blur(function() {
            var data_val = $('#company_name').val();
            if(data_val == ""){
                 $('#company_name').addClass("error");
            }else{
                 $('#company_name').removeClass("error");
            }
        });
        if($('#username1').val() == ''){
        $('#last_name1').blur(function() {
                var last1 = $('#last_name1').val();
                if(last1 != ""){
                     $('#last_name1').removeClass("error");
                }
                if($('#last_name1').val() != "" && $('#first_name1').val() != ""){
                $.post("{$url_path}ajax_generate_username/", { first_name : $('#first_name1').val() , last_name : $('#last_name1').val() },
                        function(data){
                                //$('#username1').val(data);
                                var username1 = $("#username2").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username1').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username1').val(data);
                            }
                                //if(parseInt(data.substring(4,7)) > 1)
                                // $('#dialog_hidden').load("{$url_path}ajax_global_check.php?ssno=" + $('#social_security').val());
        });
        }
        });
        
			
			
 //generating username w.r.t firstname blur
 //if($('#username1').val() =="") {
         $('#first_name1').blur(function() {
            var first1 = $('#first_name1').val();
                if(first1 != ""){
                    $('#first_name1').removeClass("error");
                }
             if($('#last_name1').val() != "" && $('#first_name1').val() != ""){
                  $.post("{$url_path}ajax_generate_username/", { first_name : $('#first_name1').val() , last_name : $('#last_name1').val() },
                      function(data){
                            ///$('#username1').val(data);
                            var username1 = $("#username2").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username1').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username1').val(data);
                            }
    });
    }
    });
    }
   // }
   // if($('#username2').val() =="") {
   
    $('#last_name2').blur(function() {
    var username2 = $('#username2').val();
    var setup = '{$setup}';
    if (setup != '1' || username2 == '' || username2 === null){
        var last2 = $('#last_name2').val();
                if(last2 != ""){
                    $('#last_name2').removeClass("error");
                }
            if($('#last_name2').val() != "" && $('#first_name2').val() != ""){
               $.post("{$url_path}ajax_generate_username/", { first_name : $('#first_name2').val() , last_name : $('#last_name2').val() },
                    function(data){
                             //$('#username2').val(data);
                             var username1 = $("#username1").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username2').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username2').val(data);
                            }
                             //if(parseInt(data.substring(4,7)) > 1)
                                //$('#dialog_hidden').load("{$url_path}ajax_global_check.php?ssno=" + $('#social_security').val());
    });
    }
    }
    });
    //}
			
			
 //generating username w.r.t firstname blur
 //if($('#username2').val() =="") {
         $('#first_name2').blur(function() {
         var username2 = $('#username2').val();
        var setup = '{$setup}';
        if (setup != '1' || username2 == '' || username2 === null){
         var first2 = $('#first_name2').val();
                if(first2 != ""){
                    $('#first_name2').removeClass("error");
                }
             if($('#last_name2').val() != "" && $('#first_name2').val() != ""){
                  $.post("{$url_path}ajax_generate_username/", { first_name : $('#first_name2').val() , last_name : $('#last_name2').val() },
                      function(data){
                            //$('#username2').val(data);
                            var username1 = $("#username1").val();
                            if(username1 != "" && username1 == data){
                                var temp = parseInt(username1.substring(4,7)); 
                                temp = temp+1;
                                temp = temp.toString();
                                var temp_lenght = temp.length;
                                var num_val = '';
                                if(temp_lenght == 1){
                                   num_val = '00'+ temp;
                                }else if(temp_lenght == 2){
                                    num_val = '0'+ temp;
                                }else{
                                 num_val=temp;
                                }
                                $('#username2').val(username1.substring(0,4)+num_val);
                            }else{
                                $('#username2').val(data);
                            }
    });
    }
    }
    });
    
    $('#social_security1').blur(function() {
    var ss1 = $('#social_security1').val();
    var ss2 = $('#social_security2').val();
    if(ss2 != ss1){
        if($('#last_name1').val() != "" || $('#first_name1').val() != ""){
            $.post("{$url_path}ajax_check_social_security/", { social_security : $('#social_security1').val() },
                function(data){
                    $('#soc_sec1').html(data);
                    if(data!= ""){
                        $("#social_security1").addClass("error");
                        $('#social_security1').focus();

                    }else{
                        $.post("{$url_path}ajax_check_socialsecurity_present.php", { social_security : $('#social_security1').val(), 'except_uname': '{if $employee_detail1[0].username neq ''}{$employee_detail1[0].username}{/if}' },
                            function(data1){
                                $('#soc_sec1').html(data1);
                                if(data1 != ""){
                                    $("#social_security1").addClass("error");
                                    $('#social_security1').focus();

                                }else{
                                    $("#social_security1").removeClass("error");
                                }

                        });
                    }

            });
        }}else{
            $("#social_security1").addClass("error");
            $('#social_security1').focus();
        }
        });
        
        $('#social_security2').blur(function() {
        var ss1 = $('#social_security1').val();
    var ss2 = $('#social_security2').val();
    if(ss1 != ss2){
    if($('#last_name2').val() != "" || $('#first_name2').val() != ""){
        $.post("{$url_path}ajax_check_social_security/", { social_security : $('#social_security2').val() },
            function(data){
                $('#soc_sec2').html(data);
                            if(data!= ""){
                                $("#social_security2").addClass("error");
                                $('#social_security2').focus();

                            }else{
                                $.post("{$url_path}ajax_check_socialsecurity_present.php", { social_security : $('#social_security2').val(), 'except_uname': '{if $employee_detail2[0].username neq ''}{$employee_detail2[0].username}{/if}' },
                                    function(data1){
                                        $('#soc_sec2').html(data1);
                                        if(data1 != ""){
                                        $("#social_security2").addClass("error");
                                        $('#social_security2').focus();

                                        }else{
                                            $("#social_security2").removeClass("error");
                                        }

                                });
                            }
                            

        });
        } }else{
            $("#social_security2").addClass("error");
            $('#social_security2').focus();
        }
        });
   // }
});

function checking_required(){
    var company_name = $("#company_name").val();
      var database_name = $("#database").val();
      var first_name1 = $("#first_name1").val();
      var first_name2 = $("#first_name2").val();
      var last_name1 = $("#last_name1").val();
      var last_name2 = $("#last_name2").val();
     /* var social_security1 = $("#social_security1").val();
      var social_security2 = $("#social_security2").val();*/
            var error = 0;
            if(company_name == "" || company_name == null){
                $("#company_name").addClass("error");
                $('#company_name').focus();
                error = 1;
            }
            if(database_name == "1" ){
                $("#database").addClass("error");
                error = 1;
            }
            
            {if $setup != 1}
            if($('#price_per_sms').val() != '' || $('#price').val() != '' || $('#contract_from').val() != '' || $('#contract_to').val() != ''){
                if($('#price_per_sms').val() == ''){
                    $("#price_per_sms").addClass("error");
                    error = 1;
                }else{
                    $("#price_per_sms").removeClass("error");
                    error = 0;
                }
                if($('#price').val() == ''){
                    $("#price").addClass("error");
                    error = 1;
                }else{
                    $("#price").removeClass("error");
                    error = 0;
                }
                if($('#contract_from').val() == ''){
                    $("#contract_from").addClass("error");
                    error = 1;
                }else{
                    $("#contract_from").removeClass("error");
                    error = 0;
                }
                if($('#contract_to').val() == ''){
                    $("#contract_to").addClass("error");
                    error = 1;
                }else{
                    $("#contract_to").removeClass("error");
                    error = 0;
                }
            }
            {/if}
            
                if(first_name1 == "" || first_name1 == null){
                    $("#first_name1").addClass("error");
                    $('#first_name1').focus();
                    error = 1;
                }
                else{
                    $("#first_name1").removeClass("error");
                    error = 0;
                }
                if(last_name1 == "" || last_name1 == null){
                    $("#last_name1").addClass("error");
                    $('#last_name1').focus();
                    error = 1;
                }
                if($("#social_security1").val() == "" || $("#social_security1").val() == null){
                    $("#social_security1").addClass("error");
                    error = 1;
                }
                else{
                    $("#social_security1").removeClass("error");
                    error = 0;
                }
                
                Class_security1 = $("#social_security1").prop("class");
                if(Class_security1 == "error"){
                    error = 1;
                }  
                
              /*/  $.post("{$url_path}ajax_check_social_security/", { social_security : $('#social_security1').val() },
                   function(data){
                       $('#soc_sec1').html(data);
                           if(data!= ""){
                           $("#social_security1").addClass("error");
                           error = 1

                           }else{
                               $("#social_security1").removeClass("error");
                           }


               });*/
                
            
            if(first_name2 != "" || last_name2 != ""){
                if(first_name2 == "" || first_name2 == null){
                    $("#first_name2").addClass("error");
                    $('#first_name2').focus();
                    error = 1;
                }
                
                if(last_name2 == "" || last_name2 == null){
                    $("#last_name2").addClass("error");
                    $('#last_name2').focus();
                    error = 1;
                }
                Class_security2 = $("#social_security2").prop("class");
                if(Class_security2 == "error"){
                    error = 1;
                }

               /* $.post("{$url_path}ajax_check_social_security/", { social_security : $('#social_security2').val() },
                   function(data){
                       $('#soc_sec2').html(data);
                           if(data!= ""){
                           $("#social_security2").addClass("error");
                           error = 1

                           }else{
                               $("#social_security2").removeClass("error");
                           }


               });*/
            }
            
            if(error == 0){
              return 1;
                }else{
                return 0;
                }
}
function saveForm(type){
    var error = checking_required();
    if(error == 1){
        $("#company_register_form").submit();
    }
   // $("#form").submit();
}

function putFilePath(){
    var file_path = $("#file").val();
    $("#browsed").val(file_path);
}

function popup(url) {
    //var error = checking_required();
   // if(error == 1){
        var dialog_box_new = $("#issue_popup");
        dialog_box_new.load(url);
        dialog_box_new.dialog({
            title: '{$translate.add}',
            position: 'top',
            modal: true,
            resizable: false,
            minWidth: 10,
            close:function(event, ui) {
                $(this).dialog('close');
            }
        });
        return false;
    //}
    
}
function popup_delete(url) {
    var dialog_box_new = $("#issue_popup");
    dialog_box_new.load(url);
    dialog_box_new.dialog({
        title: '{$translate.add}',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 10,
        minHeight: 30
    });
    return false;
    
}

function generate_password(method){
    if(method == "1"){
        $("#pass").html('<input type="text"  id="password" name="password" value ="{$pass1}" >');
    }else{
        $("#pass2").html('<input type="text"  id="password2" name="password2" value ="{$pass2}" >');
    }
      
}


		
</script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="tbl_hd"><span class="titles_tab">{$translate.company}</span>
                <div class="pull-right day-slot-wrpr-header-left" style="padding: 3px;">
                    <button class="btn btn-default btn-normal" type="button" onclick="javascript:location='{$url_path}dashboard/';"><span class="icon-arrow-left"></span> {$translate.back}</button>
                    <button class="btn btn-default btn-normal" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                    <button class="btn btn-default btn-normal" type="button" onclick="saveForm()"><span class="icon-save"></span> {$translate.save}</button>
                </div>
            </div>
            <div class="clearfix" id="issue_popup" style="display:none;"></div>
            {$message}
            <form action="" method="post" name="company_register_form" id="company_register_form" enctype="multipart/form-data">
                <input type="hidden" name="setup" value="{$setup}" id="setup">
                <input type="hidden" name="dir" value="{$company.upload_dir}" id="dir">
                <div class="span12 no-ml" id="forms_container_new">
                    <div class="span12 no-ml" id="employee_tab_content1" style="padding: 5px;">
                        <div class="worker_left span4"> 
                            <div id="kund" style="width: 100%;">
                                <div class="sub_hd"><span class="titles">{$translate.company_information}</span></div>

                                <div class="td_raw">
                                    <label for="company_name">{$translate.company_name_comp}*</label>
                                    <input type="text" name="company_name" id="company_name" value="{if $company.name != ""}{$company.name}{/if}" />
                                </div>
                                {if $setup == 1}
                                    <div class="td_raw">
                                        <label for="datab">{$translate.database}*</label>
                                        <input type="text" name="datab" id="datab" value="{if $company.db_name != ""}{$company.db_name}{/if}" readonly="readonly">
                                    </div>
                                {else}
                                    <div class="td_raw">
                                        <label for="database">{$translate.database}*</label>
                                        <select name="database" id="database" style="width: 51%;">
                                            <option value="1">{$translate.select}</option>
                                            {foreach from=$databases item=database}
                                                <option value={$database}>{$database}</option>

                                            {/foreach}
                                        </select>
                                    </div>
                                {/if} 
                                <div class="td_raw">
                                    <label for="org_no">{$translate.organization_number}</label>
                                    <input type="text" name="org_no" id="org_no" value="{if $company.org_no != ""}{$company.org_no}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="company_box">{$translate.company_box}</label>
                                    <input type="text" id="company_box" name="company_box" value="{if $company.box != ""}{$company.box}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="adress">{$translate.company_address_new}</label>
                                    <input type="text" name="adress" id="adress" value="{if $company.address != ""}{$company.address}{/if}">
                                </div>

                                <div class="td_raw">
                                    <label for="adress">{$translate.company_zipcode_new}</label>
                                    <input type="text" name="zipcode" id="zipcode" value="{if $company.zipcode != ""}{$company.zipcode}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="adress">{$translate.company_city_new}</label>
                                    <input type="text" name="comp_city" id="comp_city" value="{if $company.city != ""}{$company.city}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="land_code">{$translate.company_land_code_new}</label>
                                    <input type="text" name="land_code" id="land_code" value="{if $company.land_code != ""}{$company.land_code}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="phone">{$translate.company_phone_new}</label>
                                    <input type="text" name="phone" id="phone" value="{if $company.phone != ""}{$company.phone}{/if}">
                                </div><div class="td_raw">
                                    <label for="mobile">{$translate.company_mobile_new}</label>
                                    <input type="text" maxlength="10" name="mobile" id="mobile" value="{if $company.mobile != ""}{$company.mobile}{/if}">
                                </div><div class="td_raw">
                                    <label for="email">{$translate.company_email_new}</label>
                                    <input type="text" name="email" id="email" value="{if $company.email != ""}{$company.email}{/if}">
                                </div>
                                <div class="td_raw">
                                    <label for="website">{$translate.company_website}</label>
                                    <input type="text" name="website" id="website" value="{if $company.website != ""}{$company.website}{/if}">
                                </div>
                                {if $setup != 1}
                                    <div class="td_raw">
                                        <label for="price">{$translate.price_per_customer}</label>
                                        <input type="text" name="price" id="price" value="{if $company.price_per_customer != ""}{$company.price_per_customer}{/if}">
                                    </div>
                                    <div class="td_raw">
                                        <label for="price">{$translate.price_per_sms}</label>
                                        <input type="text" name="price_per_sms" id="price_per_sms" value="{if $company.price_per_sms != ""}{$company.price_per_sms}{/if}">
                                    </div>
                                {/if}
                                    <div class="td_raw">
                                        <label for="salary_system">{$translate.salary_system}</label>
                                        <select name="salary_system" id="salary_system"  style="width: 51%;">
                                            <option value="">{$translate.select}</option>
                                            <option value="1" {if $company.salary_system == "1"}selected="selected"{/if}>{$translate.salary_type1}</option>
                                            <option value="2" {if $company.salary_system == "2"}selected="selected"{/if}>{$translate.salary_type2}</option>
                                            <option value="3" {if $company.salary_system == "3"}selected="selected"{/if}>{$translate.salary_type3}</option>
                                            <option value="4" {if $company.salary_system == "4"}selected="selected"{/if}>{$translate.salary_type4}</option>
                                            <option value="5" {if $company.salary_system == "5"}selected="selected"{/if}>{$translate.salary_type5}</option>
                                        </select>

                                    </div>
                                    {if $setup == 1}
                                        <div class="td_raw">
                                            <label for="logo">{$translate.company_logo}</label>
                                            <input type="text" name="logo" id="logo" value="{if $company.logo != ""}{$company.logo}{/if}" readonly="readonly">
                                        </div>
                                    {else}
                                        <div class="td_raw">                        
                                            <label for="file">{$translate.company_logo}</label>
                                            <div class="fakefile_container">
                                                <div class="fakefile" style="width: 170px;">
                                                    <input name="" type="text" class="image_path" id="browsed"/>
                                                    <input name="" type="button" value="Browse"  class="image_browse"/>
                                                </div>
                                            </div>
                                            <div class="fileupload_container">
                                                <div class="fileupload">
                                                    <input type="file" name="file" id="file" class="logo_browse" onchange="putFilePath();">
                                                </div>
                                            </div>  
                                        </div>
                                    {/if}
                                    <div class="td_raw">
                                        <label for="status">{$translate.company_billing_status}</label>
                                        <div class="radio_dv_main" style="margin-top: 5px;"><div class="radio_dv_a">  <input type="radio" name="bill_status" id="bill_active"  value="1" {if $company.billing_status == "1"}checked="checked"{/if}>{$translate.active_company}</div>
                                            <div class="radio_dv_b"><input type="radio" name="bill_status" id="bill_inactive" value="0" {if $company.billing_status == "0" ||$company.billing_status == ""}checked="checked"{/if}><span class="dv_cntnt">{$translate.inactive_company}</span></div> 
                                        </div>
                                    </div>
                                    {if $setup != 1}
                                        <div class="td_raw">
                                            <label for="price">{$translate.company_contract_from}</label>
                                            <input type="text" value="" id="contract_from" name="contract_from" style="width:40%">
                                        </div>
                                        <div class="td_raw">
                                            <label for="price">{$translate.company_contract_to}</label>
                                            <input type="text" value="" id="contract_to" name="contract_to" style="width:40%">
                                        </div>
                                    {/if}
                                        <div class="td_raw">
                                            <label for="email">{$translate.company_start_day}</label>
                                            <select onchange="makeChange()" name="start_day" id="start_day"  style="width: 51%;">
                                                <option value="1" {if $vals[0] == 1}selected="selected"{/if}>{$translate.monday}</option>
                                                <option value="2" {if $vals[0] == 2}selected="selected"{/if}>{$translate.tuesday}</option>
                                                <option value="3" {if $vals[0] == 3}selected="selected"{/if}>{$translate.wednesday}</option>
                                                <option value="4" {if $vals[0] == 4}selected="selected"{/if}>{$translate.thursday}</option>
                                                <option value="5" {if $vals[0] == 5}selected="selected"{/if}>{$translate.friday}</option>
                                                <option value="6" {if $vals[0] == 6}selected="selected"{/if}>{$translate.saturday}</option>
                                                <option value="7" {if $vals[0] == 7}selected="selected"{/if}>{$translate.sunday}</option>
                                            </select>
                                        </div>
                                        <div class="td_raw">
                                            <label for="email">{$translate.company_start_time}</label>
                                            <input type="text" value="{$vals[1]}" id="start_time" name="start_time" onchange="makeChange()">  
                                        </div>

                                    </div>                                                                                                  
                                </div>

                                <div class="control_users-right span8">
                                    <div class="sub_hd span12"><span class="titles">{$translate.control_users}</span></div>
                                    <div class="control_user_kund span5">
                                        <div class="sub_hd"><span class="titles">{$translate.control_user_1}</span></div>

                                        <div class="td_raw">
                                            <label for="first_name">{$translate.first_name}*</label>
                                            <input type="text" name="first_name1" id="first_name1" value="{$employee_detail1[0].first_name}">
                                        </div>

                                        <div class="td_raw">
                                            <label for="last_name">{$translate.last_name}*</label>
                                            <input type="text" name="last_name1" id="last_name1" value="{$employee_detail1[0].last_name}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="social_security1">{$translate.social_security}*</label>
                                            <input type="text" name="social_security1" id="social_security1" value="{$employee_detail1[0].social_security}" maxlength="10">

                                        </div>
                                        <div id="soc_sec1" style="color: red"></div>
                                        <div class="td_raw">
                                            <label for="adress">{$translate.address}</label>
                                            <input type="text" name="address1" id="address1" value="{$employee_detail1[0].address}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="city">{$translate.city}</label>
                                            <input type="text" name="city1" id="city1" value="{$employee_detail1[0].city}">
                                        </div><div class="td_raw">
                                            <label for="post">{$translate.post}</label>
                                            <input type="text" name="post1" id="post1" value="{$employee_detail1[0].post}">
                                        </div><div class="td_raw">
                                            <label for="phone">{$translate.phone}</label>
                                            <input type="text" name="phone1" id="phone1" value="{$employee_detail1[0].phone}">
                                        </div><div class="td_raw">
                                            <label for="mobile">{$translate.mobile}</label>
                                            <input type="text" maxlength="10" name="mobile1" id="mobile1" value="{$employee_detail1[0].mobile}">
                                        </div><div class="td_raw">
                                            <label for="email">{$translate.email}</label>
                                            <input type="text" name="email1" id="email1" value="{$employee_detail1[0].email}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="email">{$translate.username}</label>
                                            <input type="text" name="username1" id="username1" value="{$employee_detail1[0].username}" readonly="readonly">
                                        </div>
                                        <div class="td_raw">
                                            <label for="password">{$translate.password}</label>
                                            <div id="pass"> <input type="button" onclick="generate_password('1')" value="{$translate.generate_password}" id="password" name="password" class="bttn" onchange="makeChange()"></div>
                                        </div>
                                    </div>
                                    <div class="control_user_kund span5">
                                        <div class="sub_hd"><span class="titles">{$translate.control_user_2}</span></div>
                                        <div class="td_raw">
                                            <label for="first_name">{$translate.first_name}</label>
                                            <input type="text" name="first_name2" id="first_name2" value="{$employee_detail2[0].first_name}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="last_name">{$translate.last_name}</label>
                                            <input type="text" name="last_name2" id="last_name2" value="{$employee_detail2[0].last_name}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="social_security2">{$translate.social_security}</label>
                                            <input type="text" name="social_security2" id="social_security2" value="{$employee_detail2[0].social_security}" maxlength="10">

                                        </div>
                                        <div id="soc_sec2" style="color: red"></div>
                                        <div class="td_raw">
                                            <label for="adress">{$translate.address}</label>
                                            <input type="text" name="address2" id="address2" value="{$employee_detail2[0].address}">
                                        </div>
                                        <div class="td_raw">
                                            <label for="city">{$translate.city}</label>
                                            <input type="text" name="city2" id="city2" value="{$employee_detail2[0].city}">
                                        </div><div class="td_raw">
                                            <label for="post">{$translate.post}</label>
                                            <input type="text" name="post2" id="post2" value="{$employee_detail2[0].post}">
                                        </div><div class="td_raw">
                                            <label for="phone">{$translate.phone}</label>
                                            <input type="text" name="phone2" id="phone2" value="{$employee_detail2[0].phone}">
                                        </div><div class="td_raw">
                                            <label for="mobile">{$translate.mobile}</label>
                                            <input type="text"maxlength="10" name="mobile2" id="mobile2" value="{$employee_detail2[0].mobile}">
                                        </div><div class="td_raw">
                                            <label for="email">{$translate.email}</label>
                                            <input type="text" name="email2" id="email2" value="{$employee_detail2[0].email}">
                                        </div><div class="td_raw">
                                            <label for="email">{$translate.username}</label>
                                            <input type="text" name="username2" id="username2" value="{$employee_detail2[0].username}"readonly="readonly">
                                        </div>
                                        <div class="td_raw">
                                            <label for="password">{$translate.password}</label>
                                            <div id="pass2"> <input type="button" onclick="generate_password('2')" value="{$translate.generate_password}" id="password2" name="password2" class="bttn" ></div>
                                        </div>
                                    </div>                                                                                                 
                                </div>

                                {if $setup == 1}
                                    <div id="company_contrat" style="float: left" class="control_users-right span8">
                                        <div class="sub_hd" style="padding-bottom: 7px"><span class="titles">{$translate.control_users}</span>
                                            <a href="javascript:void(0);" class="add" style="margin-right: 4px" onclick="popup('{$url_path}ajax_add_company_contract.php?company_id={$company.id}&action=add')">{$translate.add_new}</a>
                                        </div>
                                        <div class="" style="padding-left: 5px; padding-right: 5px;">
                                            <table class="table_list span12 table table-white table-bordered table-hover table-responsive table-primary table-Anställda recruitment-table" style="margin-top: 5px">
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>{$translate.contract_from}</th>
                                                    <th>{$translate.contract_to}</th>
                                                    <th>{$translate.price_per_sms}</th>
                                                    <th>{$translate.price_per_customer}</th>
                                                    <th>{$translate.price_per_sign}</th>
                                                    <th width="10%"></th>
                                                </tr>
                                                {assign val 1}
                                                {foreach $company_contracts AS $contract}
                                                    <tr class="{cycle values="even,odd"}">
                                                        <td>{$val}</td>
                                                        <td>{$contract.contract_from}</td>
                                                        <td>{$contract.contract_to}</td>
                                                        <td>{$contract.price_per_sms}</td>
                                                        <td>{$contract.price_per_customer}</td>
                                                        <td>{$contract.price_per_sign}</td>
                                                        <td style="padding: 3px 4px;">
                                                            <a href="javascript:void(0);" class="settings" onclick="popup('{$url_path}ajax_add_company_contract.php?company_id={$company.id}&action=edit&contract_id={$contract.id}')"><img src="{$url_path}images/settings.png" border="0" title="{$translate.edit}" width="25"/></a>
                                                            <a href="javascript:void(0);"  class="delete" style="width: 3px; height: 3px;" onclick="popup_delete('{$url_path}ajax_add_company_contract.php?company_id={$company.id}&action=delete&contract_id={$contract.id}')" title="{$translate.delete}"></a>
                                                        </td>

                                                    </tr>
                                                    {assign val $val+1}
                                                {foreachelse}
                                                    <tr><td colspan="6">
                                                            <div class="message">{$translate.no_data_available}</div>
                                                        </td></tr>
                                                    {/foreach}
                                            </table>
                                        </div>
                                    </div>
                                {/if}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
{/block}
