{block name='style'}
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .box-form { border: solid thin #000; padding: 20px; }
    .box-form-wrpr {  margin-bottom: 20px; }
    .signing_form_label{ width:92px; float:left; display:block; padding-left:8px; }
    .signing_form_text{ float:left; width: 122px; }
    #login.delete { background-position:10px center; padding:5px 10px 5px 30px;float:left;line-height: 15px;}
    .signed_emp li{ display:inline-block;margin-right:10px; }
    .signed_emp li a{ color:red; }
    .display_none{ display:none; }
    .danger_input{ border:1px solid red; }
</style>
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
var change = 0; 
$(document).ready(function(){
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-254});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    var hidWidth;
    var scrollBarWidths = 40;

    $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
    });
    
    var widthOfList = function(){
      var itemsWidth = 0;
      $('.list li').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
      });
      return itemsWidth;
    };

    var widthOfHidden = function(){
      return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
      return $('.list').position().left;
    };
    var reAdjust = function(){
      if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
      }
      else {
        $('.scroller-right').hide();
      }

      if (getLeftPosi()<0) {
        $('.scroller-left').show();
      }
      else {
        $('.item').animate({ left:"-="+getLeftPosi()+"px" },'slow');
            $('.scroller-left').hide();
      }
    }


    reAdjust();

    $(window).on('resize',function(e){  
            reAdjust();
    });

    $('.scroller-right').click(function() {

      $('.scroller-left').fadeIn('slow');
      $('.scroller-right').fadeOut('slow');

      $('.list').animate({ left:"+="+widthOfHidden()+"px" },'slow',function(){

      });
    });

    $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.list').animate({ left:"-="+getLeftPosi()+"px" },'slow',function(){

            });
    });   
    

});

function load_data(){
    var selected_emp = $('#cmb_employee').val();
    $('#selected_employee').val(selected_emp);
    $('#formLoad').submit();
}

function backForm() {
            //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
            window.history.back();
        }
   
function saveForm(){
    var not=0;
    var uname = $("#signing_uname").val();
    var pword = $("#signing_password").val();
    if(uname == "" || pword == ""){
        alert("{$translate.username_or_password_missing}");
        $("#signing_password").focus();
    } else{
        $('form#frmSave').find('input').each(function(){
            if($(this).prop('required')){
                var rpt = $(this).val();
                if(typeof rpt == "undefined" || rpt == ''){
                    $(this).addClass("danger_input");
                    $(this).attr("style","border:2px solid red");
                    not++;
                }else{
                    $(this).removeClass("danger_input");
                    $(this).removeAttr("style");
                }
            } 
        });
        if(not == 0)
            $('#frmSave').submit();
        else
            alert("Fyll i alla obligatoriska fält");
    }
}
{foreach $emps_details_loaded as $emp_data}
    $('input:radio[name=is_assi_resi_outside_ees_{$emp_data.employee}]').change(function() {
        if (this.value == '1') {
            $("#assi_resi_outside_ees_{$emp_data.employee}").attr('required',true);
            //$("#changes_applies_from_{$emp_data.employee}").attr('required',true);
        }
        else if (this.value == '2') {
            $("#assi_resi_outside_ees_{$emp_data.employee}").removeAttr('required');
            //$("#changes_applies_from_{$emp_data.employee}").removeAttr('required');
        }
    });
{/foreach}
{foreach $emps_details_loaded as $emp_data}
    $('input:radio[name=is_assi_resi_outside_ees_{$emp_data.employee}]').each(function(){
        if (this.value == '1' && this.prop('checked')) {
            $("#assi_resi_outside_ees_{$emp_data.employee}").attr('required',true);
            //$("#changes_applies_from_{$emp_data.employee}").attr('required',true);
        }
        else if (this.value == '2' && this.prop('checked')) {
            $("#assi_resi_outside_ees_{$emp_data.employee}").removeAttr('required');
            //$("#changes_applies_from_{$emp_data.employee}").removeAttr('required');
        }
    });
{/foreach}
function markchange(){
    change = 1;
}

function print_data(){
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    var selected_emp = $('#_selected_employee').val();
    
    window.open('{$url_path}pdf_customer_3066.php?username={$customer_detail.username}&sel_emp='+selected_emp+'&_'+Date.now());
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        document.location.href = redirectURL;
    }
}
$("#frmSave").on("change", "input[type='text']", function () {
   $(this).attr("value",$(this).val());
});
function check(flag){  
            var not = 0;
            $('form#frmSave').find('input').each(function(){
                if($(this).prop('required')){
                    var rpt = $(this).val();
                    if(typeof rpt == "undefined" || rpt == ''){
                        $(this).addClass("danger_input");
                        $(this).attr("style","border:2px solid red");
                        not++;
                    }else{
                        $(this).removeClass("danger_input");
                        $(this).removeAttr("style");
                    }
                } 
            });
            if(not != 0){
                alert("Fyll i alla obligatoriska fält och spara formulär");
            }else{
            wrapLoader('#need_employee');
                //$('#frmSave').submit();
            var employee = $("#need_employee").val();
           
            var customer = "{$customer_detail.username}";
            var security_no = "{$customer_detail.social_security}";
            var customer_name = "{$customer_detail.first_name} {$customer_detail.last_name}"
            var remove=0;
            if(employee == "" || employee == null){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en anställd').addClass("alert-danger").removeClass("display_none");
                uwrapLoader('#need_employee');
            }else if(customer == ""){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en kund').addClass("alert-danger").removeClass("display_none");
                uwrapLoader('#need_employee');
            }
            else if(employee != "" && employee != null && customer != ""){
                var n = employee.includes("all");
                if(n){
                    var optionValues = [];
                    $('#need_employee option').each(function() {
                        if($(this).val() != 'all'){
                        optionValues.push($(this).val());}
                    });
                    employee = optionValues.join(',');
                }
                $("#signing_messageb").html("");
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_employee_signing_3066.php",
                        data:"emp="+employee+"&customer="+customer+"&security_no="+security_no+"&customer_name="+customer_name+"&consolidated="+'{$rpt_consolidated}'+'&bank_id_flag='+flag,
                        type:"POST",
                        success:function(data){
                                console.log(data);
                                $("#signing_message").html(data);
                        }

                });
            }
            }
        

        }
        
        function unsign_all(employee){
            var employee = employee;
            var customer = "{$customer_detail.username}";
            var security_no = "{$customer_detail.social_security}";
            var customer_name = "{$customer_detail.first_name} {$customer_detail.last_name}"

            if(customer == ""){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en kund').addClass("alert-danger").removeClass("display_none");
            }
            else{
                $("#signing_message").html("");
                wrapLoader('#emp_login');
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_employee_signing_remove_3066.php",
                        data:"emp="+employee+"&multiple_single=multiple&customer="+customer+"&security_no="+security_no+"&customer_name="+customer_name,
                        type:"POST",
                        dataType:'json',
                        success:function(data){
                                console.log(data);

                                if(data.status == 'success'){
                                    location.reload();
                                }
                                else{
                                    $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Fel vid borttagning Försök igen.').addClass("alert-danger").removeClass("display_none");
                                }
                                uwrapLoader('#emp_login');
                        }

                });
            }
        }
        
        function sign_remove(employee){  
            var employee = employee;
            var customer = "{$customer_detail.username}";
            var security_no = "{$customer_detail.social_security}";
            var customer_name = "{$customer_detail.first_name} {$customer_detail.last_name}"

            if(employee == ""){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en anställd').addClass("alert-danger").removeClass("display_none");
            }else if(customer == ""){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en kund').addClass("alert-danger").removeClass("display_none");
            }
            else if(employee != "" && customer != ""){
                $("#signing_message").html("");
                wrapLoader('#emp_login');
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_employee_signing_remove_3066.php",
                        data:"emp="+employee+"&multiple_single=single&customer="+customer+"&security_no="+security_no+"&customer_name="+customer_name,
                        type:"POST",
                        dataType:'json',
                        success:function(data){
                                console.log(data);

                                if(data.status == 'success'){
                                    location.reload();
                                }
                                else{
                                    $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Fel vid borttagning Försök igen').addClass("alert-danger").removeClass("display_none");
                                }
                                uwrapLoader('#emp_login');
                        }

                });
            }

        }
        
        function send_to_fk(){ 
            var employee = $("#semp_employee").val();
            wrapLoader('#semp_employee');
            //alert(employee);
            var count = $("#semp_employee :selected").length;
            var customer = "{$customer_detail.username}";
            var security_no = "{$customer_detail.social_security}";
            var customer_name = "{$customer_detail.first_name} {$customer_detail.last_name}";
            var flag = 1;

            if(count == 0){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en anställd').addClass("alert-danger").removeClass("display_none");
            
                uwrapLoader('#semp_employee');
            }else if(customer == ""){
                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>Välj minst en kund').addClass("alert-danger").removeClass("display_none");
            
                uwrapLoader('#semp_employee');
            }
            else if(count>0 && customer != ""){
                var n = employee.includes("all");
                if(n){
                    var optionValues = [];
                    $('#semp_employee option').each(function() {
                        if($(this).val() != 'all'){
                        optionValues.push($(this).val());}
                    });
                    employee = optionValues.join(',');
                }
                $("#signing_message").html("");
                wrapLoader('#emp_login');
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_employee_send_fk_3066.php",
                        data:"emps="+employee+"&customer="+customer+"&security_no="+security_no+"&customer_name="+customer_name+"&consolidated="+'{$rpt_consolidated}'+'&bank_id_flag='+flag,
                        type:"POST",
                        dataType: "json",
                        success:function(data){
                            if(data.status == 'fail'){
                                $("#signing_message").html('<a href="#" data-dismiss="alert" class="close">×</a>'+data.message).addClass("alert-danger").removeClass("display_none");
                            
                                uwrapLoader('#semp_employee');
                            }else{
                                location.reload();
                            }
                        }

                });
            }

        }
</script>
{/block}

{block name="content"}
    {if $access_flag == 1}
        <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        {$message} 
        <div class="row-fluid">
            <div style="" class="span12 main-left boxscroll">
                <div style="margin: 0px;" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1>{$translate.customer}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                        {if !empty($customer_detail)}
                            <div class="widget-body" style="padding:4px;">
                                <div class="row-fluid">
                                    <div class="span4 top-customer-info"><strong>{$translate.social_security}</strong> : {$customer_detail.social_security}</div>
                                    <div class="span4 top-customer-info"><strong>{$translate.customer_code} :</strong> {$customer_detail.code}</div>
                                    {if $sort_by_name == 1}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
                                    {elseif $sort_by_name == 2}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>     
                                    {/if}
                                </div>
                            </div>
                        {/if}
                    </div>
                    
                   <div class="row-fluid">
                        <div class="span12">
                            <div class="tab-content-switch-con" >
                            {block name="customer_manage_tab_content"}{/block}
                            <div id="signing_message" class="alert alert-dismissable no-ml no-mr display_none">
                            </div>
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span2 day-slot-wrpr-header-left span2">
                                        <h1>{$translate.customer} - 3066</h1>
                                    </div>
                                        <div class="pull-right day-slot-wrpr-header-left span10" style="padding: 5px;">
                                            
                                            <label style="margin:10px 10px 0 0">{$translate.send_to_fk}</label>
                                            <div style="float: left; margin: 0 ! important;" class="input-prepend span3"> 
                                                <select class="form-control span11" id="semp_employee" name="semp_employee" multiple="multiple">
                                                    {if (count($send_to_fk) > 0)}
                                                    <option value="all">{$translate.all}</option>
                                                        {foreach $send_to_fk as $te}
                                                            <option value="{$te.employee}" {if $te.employee eq $sel_employee}selected="selected"{/if}>{$te.re_fname} {$te.re_lname}</option>
                                                        {/foreach}
                                                    {else}
                                                          <option value="">--{$translate.no_data_available}--</option>
                                                    {/if}
                                                </select>
                                            </div>
                                            <button class="btn btn-default pull-left" type="button" onclick="send_to_fk()">{$translate.send_to_fk}</button>
                                            <label class="pull-left" style="margin:10px 10px 0 20px">{$translate.sent}({count($allready_send_to_fk)})</label>
                                            
                                            <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm();"><span class="icon-save"></span> {$translate.save}</button>
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm();"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data();"><span class="icon-print"></span> {$translate.print}</button>
                                        </div>
                                </div>
                            </div>
                            <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="tab-8">
                                    <form style ="float: left; width:100%;" id="frmSave" name="frmSave" method="post" class="no-mb">
                                        <input type="hidden" id="_selected_employee" name="selected_employee" value="{$sel_employee}"/>
                                        <input type="hidden" name="selected_action" value="SAVE"/>
                                        <div style="margin-left: 0px;" class="span12">
                                            <div class="span12">
                                                <div class="widget no-mb" style="margin-top:0;">
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group">
                                                        <div class="span12" style="margin: 0px;">
                                                            <div class="widget" style="margin: 0px 0px 10px ! important;">
                                                                <!--WIDGET BODY BEGIN-->
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12">
                                                                        <div class="span3" style="margin: 0px;">
                                                                            <label class="span12" style="float: left;" for="employee">{$translate.all_send_to_fk}</label>
                                                                            <div style="float: left; margin: 0px ! important;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span11" id="cmb_employee" name="cmb_employee">
                                                                                    {if (count($allready_send_to_fk) > 0)}
                                                                                    {foreach $allready_send_to_fk as $te}
                                                                                        <option value="{$te.employee}" {if $te.employee eq $sel_employee}selected="selected"{/if}>{$te.first_name} {$te.last_name}</option>
                                                                                    {/foreach}
                                                                                    {else}
                                                                                        <option value="">--{$translate.no_data_available}--</option>
                                                                                    {/if}
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 0px;" class="span2">
                                                                            <button class="btn btn-default pull-left" style="text-align: center;" type="button" name="load_emp_data" onclick="load_data();">{$translate.get}</button>
                                                                        </div>
                                                                        <div class="span4 pull-right" style="margin: 0px;">
                                                                            <label class="span12" style="float: left;" for="employee">{$translate.need_to_sign}</label>
                                                                            <div style="float: left; margin: 0px ! important;" class="input-prepend span8">
                                                                                <select class="form-control span11" id="need_employee" name="need_employee" multiple>
                                                                                    {if (count($emp_unsigned) > 0)}
                                                                                    <option value="all">{$translate.all}</option>
                                                                                    {foreach $emp_unsigned as $te}
                                                                                        <option value="{$te.employee}">{if $sort_by_name eq 1}{$te.first_name|cat: ' '|cat: $te.last_name}{elseif $sort_by_name eq 2}{$te.last_name|cat: ' '|cat: $te.first_name}{/if}</option>
                                                                                    {/foreach}
                                                                                    {else}
                                                                                        <option value="">--{$translate.no_data_available}--</option>
                                                                                    {/if}
                                                                                </select>
                                                                            </div>
                                                                            <div class="pull-right" style="margin: -10px 0 0 0;">
                                                                                <a style="float: left;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="check(1)"></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span6 pull-right" style="margin-right:20px;">
                                                                            <span id="signing_messageb" class="signing_error"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div class="widget no-mb" style="margin-top:0;">
                                                                    
                                                                    <div class="row-fluid mb">
                                                                        <div class="span12 pl widget-body-section input-group">
                                                                            <div class="span4">
                                                                                <label for="username" class="">{$translate.username}</label>
                                                                                <input class="form-control ml" name="signing_uname" id="signing_uname" value="{$login_user}" type="text" disabled="disabled"/>
                                                                                
                                                                            </div>
                                                                            <div class="span2" style="margin: 5px 0 0 0;">
                                                                                <label>{$translate.signed_emp}({count($emp_signed)})</label>
                                                                            </div>
                                                                            {if (count($emp_signed) > 0)}
                                                                            <div class="span5" style="margin: 5px 0 0 0;">
                                                                                <ul class="signed_emp">
                                                                                {foreach $emp_signed as $te}
                                                                                        <li><a href="javascript:void(0)" onclick="sign_remove('{$te.employee}')">{$te.re_fname} {$te.re_lname} (X)</a></li>
                                                                                        {assign var="unsign_val" value=$te.employee}
                                                                                {/foreach}
                                                                                </ul>
                                                                            </div>
                                                                            <div class="span1" style="margin: 0px;">
                                                                                <a name="login" id="login" style="width:100%" class="delete" href="javascript:void(0)" onclick="unsign_all('{$unsign_val}')" title="Delete">{$translate.unsign_all}</a>
                                                                         
                                                                            </div>
                                                                            {/if}
                                                                            <div class="span3 pull-right">
                                                                                <span id="signing_message" class="signing_error"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                                
                                                                    {foreach $emps_details_loaded as $emp_data}
                                                                        <div class="span12 widget-body-section input-group mb" style="border: thin solid rgb(0, 0, 0); margin-bottom: 10px ! important;">
                                                                            <div class="box-form-wrpr">
                                                                                <h4><strong>1.Personen som har ansökt om eller har personlig assistans</strong></h4>

                                                                                <div class="box-form">
                                                                                    <div class="row-fluid">
                                                                                        <div class="span8">
                                                                                            <div class="span12 no-mb">
                                                                                                <label style="float: left;" class="span12">{$translate.name}</label>
                                                                                                <div style="margin: 0px;" class="span12"><strong>{if $sort_by_name eq 1}{$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}{elseif $sort_by_name eq 2}{$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}{/if}</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span4">
                                                                                            <div class="span12 no-mb">
                                                                                                <label style="float: left;" class="span12">{$translate.social_security} (12 siffror)</label>
                                                                                                <div style="margin: 0px;" class="span12"><strong>{$customer_detail.century}{$customer_detail.social_security}</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="box-form-wrpr">
                                                                                <h4><strong>2. Den personliga assistenten</strong></h4>

                                                                                <div class="box-form">
                                                                                    <div class="row-fluid">
                                                                                        <div class="span8">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12">Namn</label>
                                                                                                <div style="margin: 0px;" class="span12"><strong>{if $sort_by_name eq 1}{$emp_data.first_name|cat: ' '|cat: $emp_data.last_name}{elseif $sort_by_name eq 2}{$emp_data.last_name|cat: ' '|cat: $emp_data.first_name}{/if}</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span4">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12">Personnummer (12 siffror)</label>
                                                                                                <div style="margin: 0px;" class="span12"><strong>{$emp_data.century}{$emp_data.social_security}</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-fluid">
                                                                                        <div class="span4">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12">Anställningsdatum</label>
                                                                                                <div style="margin: 0px;" class="span12"><strong>{$emp_data.activation_date}</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span8">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12">Är assistenten närstående till den som har personlig assistans?</label>
                                                                                                <input class="radio pull-left" name="is_assi_have_pa_{$emp_data.employee}" id="is_assi_have_pa_nej_{$emp_data.employee}" value="2" type="radio" {if $emp_data.saved_data.is_assi_have_pa eq 2 or empty($emp_data.saved_data)}checked="checked"{/if}/>
                                                                                                <label style="margin-left: 5px;" class="pull-left" for="is_assi_have_pa_nej_{$emp_data.employee}">Nej</label>
                                                                                                <input style="margin-left: 20px ! important;" class="radio pull-left" name="is_assi_have_pa_{$emp_data.employee}" id="is_assi_have_pa_ja_{$emp_data.employee}" value="1" type="radio" {if $emp_data.saved_data.is_assi_have_pa eq 1}checked="checked"{/if}/>
                                                                                                <label style="margin-left: 5px;" class="pull-left" for="is_assi_have_pa_ja_{$emp_data.employee}">Ja</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-fluid">
                                                                                        <div class="span4">
                                                                                            <label style="float: left;" class="span12">Är assistenten bosatt utanför EES-området?</label>
                                                                                            <input class="radio pull-left" name="is_assi_resi_outside_ees_{$emp_data.employee}" id="is_assi_resi_outside_ees_nej_{$emp_data.employee}" value="2" type="radio" {if $emp_data.saved_data.is_assi_resi_outside_ees eq 2 or empty($emp_data.saved_data)}checked="checked"{/if} />
                                                                                            <label style="margin-left: 5px;" class="pull-left" for="is_assi_resi_outside_ees_nej_{$emp_data.employee}">Nej</label>
                                                                                            <input style="margin-left: 20px ! important;" class="radio pull-left" name="is_assi_resi_outside_ees_{$emp_data.employee}" id="is_assi_resi_outside_ees_ja_{$emp_data.employee}" value="1" type="radio" {if $emp_data.saved_data.is_assi_resi_outside_ees eq 1}checked="checked"{/if} />
                                                                                            <label style="margin-left: 5px;" class="pull-left" for="is_assi_resi_outside_ees_ja_{$emp_data.employee}">Ja. Fyll i till höger</label>                            
                                                                                        </div>
                                                                                        <div class="span8">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="assi_resi_outside_ees_{$emp_data.employee}">Assistentens bostadsadress i landet utanför EES-området</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" name="assi_resi_outside_ees[{$emp_data.employee}]" id="assi_resi_outside_ees_{$emp_data.employee}" value="{$emp_data.saved_data.assi_resi_outside_ees}" onchange="markchange()" type="text" /> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-fluid">
                                                                                        <div class="span12">
                                                                                            <h4><strong>Fyll i här om anmälan gäller ändrade förhållanden</strong></h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-fluid">
                                                                                        <div class="span4">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="changes_applies_from_{$emp_data.employee}">Ändringen gäller från och med (datum)</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12 date hasDatepicker datepicker"> <span class="add-on icon-calendar"></span>
                                                                                                    <input class="form-control span10" name="changes_applies_from[{$emp_data.employee}]" id="changes_applies_from_{$emp_data.employee}" value="{if $emp_data.saved_data.changes_applies_from}{$emp_data.saved_data.changes_applies_from}{else}{date('Y-m-d')}{/if}" onchange="markchange()" type="text" required/> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="box-form-wrpr {if empty($emp_data.saved_data) or $emp_data.saved_data.signing_employee eq ''}no-mb{/if}">
                                                                                <h4><strong>3. Anordnaren av personlig assistans</strong></h4>

                                                                                <div class="box-form">
                                                                                    <div class="row-fluid">
                                                                                        <div class="span12">
                                                                                            <input class="radio pull-left" name="i_own_employer[{$emp_data.employee}]" id="i_own_employer_{$emp_data.employee}" value="1" type="checkbox" {if $emp_data.saved_data.i_own_employer eq 1}checked="checked"{/if} />
                                                                                            <label style="margin-left: 5px;" class="pull-left" for="i_own_employer_{$emp_data.employee}">Jag är egen arbetsgivare och har själv anställt assistenten</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-fluid">
                                                                                        <div class="span4">
                                                                                            <input class="radio pull-left" name="hire_assi_provider[{$emp_data.employee}]" id="hire_assi_provider_{$emp_data.employee}" value="1" type="checkbox" {if $emp_data.saved_data.hire_assi_provider eq 1 or empty($emp_data.saved_data)}checked="checked"{/if} />
                                                                                            <label style="margin-left: 5px;" class="pull-left" for="hire_assi_provider_{$emp_data.employee}">Personen anlitar en assistans-anordnare</label>
                                                                                        </div>
                                                                                        <div class="span8">
                                                                                            <div class="row-fluid">
                                                                                                <div class="span8">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12">Namn på anordnaren</label>
                                                                                                        <div style="margin: 0px;" class="span12"><strong>{$company_detail.name}</strong></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="span4">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12">Organisationsnummer</label>
                                                                                                        <div style="margin: 0px;" class="span12"><strong>{$company_detail.org_no}</strong></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row-fluid">
                                                                                                <div class="span8">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12" for="company_cp_name_{$emp_data.employee}">Kontaktperson</label>
                                                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                            <input class="form-control span10" name="company_cp_name[{$emp_data.employee}]" id="company_cp_name_{$emp_data.employee}" value="{if !empty($emp_data.saved_data)}{$emp_data.saved_data.company_cp_name}{else}{$company_detail.cp_name}{/if}" onchange="markchange()" type="text"/> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="span4">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12" for="company_cp_phone_{$emp_data.employee}">Telefon, även riktnummer</label>
                                                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                            <input class="form-control span10" name="company_cp_phone[{$emp_data.employee}]" id="company_cp_phone_{$emp_data.employee}" value="{if !empty($emp_data.saved_data)}{$emp_data.saved_data.company_cp_phone}{else}{$company_detail.contact_number}{/if}" onchange="markchange()" type="text"/> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row-fluid">
                                                                                                <div class="span12">
                                                                                                    <label style="float: left;" class="span12">Är anordnaren arbetsgivare för assistenten?</label>
                                                                                                    <input class="radio pull-left" name="is_organizer_employers_assi_{$emp_data.employee}" id="is_organizer_employers_assi_ja_{$emp_data.employee}" value="1" type="radio" {if $emp_data.saved_data.is_organizer_employers_assi eq 1 or empty($emp_data.saved_data)}checked="checked"{/if} />
                                                                                                    <span style="margin-left: 5px;">Ja</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div style="margin: 27px 0px;" class="row-fluid">
                                                                                                <div class="span4">
                                                                                                    <input class="radio pull-left" name="is_organizer_employers_assi_{$emp_data.employee}" id="is_organizer_employers_assi_nej1_{$emp_data.employee}" value="2" type="radio" {if $emp_data.saved_data.is_organizer_employers_assi eq 2}checked="checked"{/if} />
                                                                                                    <span style="margin-left: 5px;">Nej, anordnaren är

                                                                                                        uppdragsgivare åt

                                                                                                        assistenten som har

                                                                                                        en annan arbetsgivare</span>
                                                                                                </div>
                                                                                                <div class="span4">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12" for="name_of_another_employer_{$emp_data.employee}">Namn på arbetsgivaren</label>
                                                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                            <input class="form-control span10" name="name_of_another_employer[{$emp_data.employee}]" id="name_of_another_employer_{$emp_data.employee}" value="{$emp_data.saved_data.name_of_another_employer}" onchange="markchange()" type="text"> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="span4">
                                                                                                    <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                        <label style="float: left;" class="span12" for="another_employer_org_no_{$emp_data.employee}">Organisationsnummer</label>
                                                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                            <input class="form-control span10" name="another_employer_org_no[{$emp_data.employee}]" id="another_employer_org_no_{$emp_data.employee}" value="{$emp_data.saved_data.another_employer_org_no}" onchange="markchange()" type="text"> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row-fluid">
                                                                                                <div class="span12">
                                                                                                    <input class="radio pull-left" name="is_organizer_employers_assi_{$emp_data.employee}" id="is_organizer_employers_assi_nej2" value="3" type="radio" {if $emp_data.saved_data.is_organizer_employers_assi eq 3}checked="checked"{/if} />
                                                                                                    <span style="margin-left: 5px;">Nej, anordnaren är uppdragsgivare åt assistenten som är egenföretagare.</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            {if !empty($emp_data.saved_data) and $emp_data.saved_data.signing_employee neq ''}
                                                                                <div class="box-form-wrpr no-mb">
                                                                                    <h4><strong>4. Underskrift av anordnaren eller egen arbetsgivare</strong></h4>
                                                                                    <div class="box-form">
                                                                                        <div class="row-fluid">
                                                                                            <div class="span12">
                                                                                                <p>Jag intygar att uppgifterna i blanketten är riktiga.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row-fluid">
                                                                                            <div class="span4">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12">Datum</label>
                                                                                                    <div style="margin: 0px;" class="span12"><strong>{$emp_data.saved_data.signing_date}</strong></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span4">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12">Namnteckning</label>
                                                                                                    <div style="margin: 0px;" class="span12"><strong>{if $sort_by_name eq 1}{$emp_data.saved_data.se_fname|cat: ' '|cat: $emp_data.saved_data.se_lname}{elseif $sort_by_name eq 2}{$emp_data.saved_data.se_lname|cat: ' '|cat: $emp_data.saved_data.se_fname}{/if}</strong></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span4">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12">Telefon, även riktnummer</label>
                                                                                                    <div style="margin: 0px;" class="span12"><strong>{if $emp_data.saved_data.se_phone}{$emp_data.saved_data.se_phone}{else if $emp_data.saved_data.se_mobile}{$emp_data.saved_data.se_mobile}{else if $emp_data.saved_data.company_cp_phone}{$emp_data.saved_data.company_cp_phone}{/if}</strong></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row-fluid">
                                                                                            <div class="span12">
                                                                                                <p>Uppgifterna hanteras i Försäkringskassans datasystem. Läs mer i broschyren "Försäkringskassans personregister".</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                        </div>
                                                                    {/foreach}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="formLoad" name="formLoad" method="post" class="hide" >
                                        <input type="hidden" name="selected_employee" id="selected_employee" value=""/>
                                        <input type="hidden" name="selected_action" value="LOAD"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {else}
      <div class="fail">{$translate.permission_denied}</div>
    {/if}
{/block}


{block name="script"}
    <script type="text/javascript">
        
    </script>
{/block}