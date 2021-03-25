{block name='style'}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
   <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" href="{$url_path}js/plugins/notifications/Gritter/css/jquery.gritter.css" type="text/css" />
{*<link href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet" />*}
<style>.tbl-action-col .btn{ padding: 3px 9px;}</style>
{/block}
{block name='script'}
    <script src="{$url_path}js/date-picker.js"></script>
    <script src="{$url_path}js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{$url_path}js/jquery.maskedinput.js" type="text/javascript" ></script>
    <script src="{$url_path}js/plugins/notifications/Gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript">
        var change_var = 0;
        $(document).ready(function() {
            
            if($(window).height() > 600)
                $('.tab-content-con').css({ height: $(window).height()-254});
            else
                $('.tab-content-con').css({ height: $(window).height()});
            
            
            $('#appoiment_date').datetimepicker({
                format: "yyyy-mm-dd  hh:ii",
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}',
                minuteStep: 30/*,
                todayBtn: true,
                startDate: "2013-02-14 10:00",
                pickerPosition: "bottom-left"*/

            });
            
            $('.main-right').css({ height: $(window).innerHeight()-50 });    // .main-right - section commented
            $(window).resize(function(){
              $('.main-right').css({ height: $(window).innerHeight()-50 });
            });
        });
        

        function print_data(username){
            var year_txt = $("#cmb_year option:selected").text();

            var year = $("#year option:selected").val();

            var month_t = $("#cmb_month option:selected").text();

            var month = document.getElementById('cmb_month').value;
            var obj = document.getElementById('form1');

            obj.action = "{$url_path}pdf_customer_equipment.php?username=" + username + "&year=" + year_txt + "&month=" + month + "&month_txt=" + month_t;

            obj.submit();

        }
        function deleteAppoinment(id) {

            var r = confirm("{$translate.are_you_sure}");

            if (id) {

                if (r) {

                    $("#delete_id").val(id);

                    $("#form").submit();

                    return true;
                }
            }
        }
    </script>
<script>
var hidWidth;
var scrollBarWidths = 40;

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

$(document).ready(function(){
    
    $.mask.definitions['~']='[1-9]';
    $("#phone_number, #phone_number_cp, #cust_number").mask("+46?~99 99 99 99 99", { placeholder:" "});
    $("#reminder_before_date").mask("?9999", { placeholder:" "});
    
    $('#chk_same_email').click(function() {
        if($(this).is(':checked')){
            $('#cust_email').val( $('#email_cp').val());
        }
    });
    $('#chk_same_phone').click(function() {
        if($(this).is(':checked')){
            $('#cust_number').val( $('#phone_number_cp').val());
        }
    });
    
    $('#reminder_before_date').keyup(function(e) {
        // get keycode of current keypress event
        var code = (e.keyCode || e.which);

        //console.log(code);
        // (Dot, Comma, Space, a-z, A-Z)
        //if(code == 110 || code == 188 || code == 190 || code == 32 || (code >= 65 && code <= 90) || (code >= 97 && code <= 122)) {
        if((code >= 48 && code <= 57) || (code >= 96 && code <= 105)) {
            e.preventDefault();
            return false;
        }
        $.gritter.add({
            title: '{$translate.caution}',
            text: '{$translate.not_allowed_charecter}',
            image_class: true,
            /*sticky: true,*/
            time: 5000,
            class_name: 'gritter-light gritter-warning'
        });
    });
    
        $(".main-center").css('margin-top', '50px');
        $(".main-center").css('width', '100%');
        $(".main-right").css('display', 'none');
    
        $(".add-new-equipment").click(function() {
        
            $(".main-left").css('width', '66%');
            $(".main-right").css('width', '32%');
            $(".main-right").css('display', 'block');
        });
        /*MAIN-RIGHT COLLPASE*/	
        $(".cancel-new-equipment").click(function() {
            $(".main-left").css('margin-top', '0px');
            $(".main-left").css('width', '99%');
            $(".main-right").css('display', 'none');
      
        });

        $(".main-center").css('margin-top', '50px');
        $(".main-center").css('width', '100%');
        $(".main-right, .add-new-equipment-box, .add-new-appoinments-box, .oncall-box").css('display', 'none');
		  
        $(".add-new-equipment").click(function() {
		$(".add-new-equipment-box, .add-new-equipment").css('display', 'block');
                $(".add-new-appoinments-box").css('display', 'none');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '32%');
                $(".oncall-box").css('display', 'none');
                $(".main-right").css('display', 'block');

        });
		
		
        $(".btn-addnew-appoinments").click(function() { 
		$(".add-new-equipment-box").css('display', 'none');
                $(".add-new-appoinments-box").css('display', 'block');
		$(".add-new-equipment").css('display', 'block');
                $(".rightside_info_box").css('display', 'none');
                $(".rightside_add_edit_box").css('display', 'block');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '32%');
                $(".oncall-box").css('display', 'none');
                $(".main-right").css('display', 'block');
                $("#mode").val('add');
        
                        $("#data_id").val('');
                        $("#appoiment_date").val('');
                        $("#appoiment_address").val('');
                        $("#phone_number").val('');
                        $("#reason").val('');
                        $("#remarks").val('');
                        
                        $("#contact_person_name").val('');
                        $("#phone_number_cp").val('');
                        $("#email_cp").val('');
                        $("#cust_email").val('');
                        $("#cust_number").val('');
                        $("#reminder_before_date").val('');
                        
                        $("#email_alert").prop('checked', false);
                        $("#cust_email_div").hide();
                        $("#reminder_time_div").hide();
                        $("#repeat_until_due_date_div").hide();
                        $("#sms_alert").prop('checked', false);
                        $("#repeat_until_due_date").prop('checked', false);
						
                $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
        });
        
        
	 $(".btn_edit").click(function() {
		$(".add-new-equipment-box").css('display', 'none');
                $(".add-new-appoinments-box").css('display', 'block');
		$(".add-new-equipment").css('display', 'block');
                $(".rightside_info_box").css('display', 'none');
                $(".rightside_add_edit_box").css('display', 'block');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '32%');
                $(".oncall-box").css('display', 'none');
                $(".main-right").css('display', 'block');
                $("#mode").val('edit');
        
        
        ///////////////////////////ajax////////////////////////
        
        var appoinment_id = $(this).attr('data-id');
        $.ajax({ 
            async   :false,
            url     :"{$url_path}ajax_get_appoiment.php",
            data    : { "appoinment_id" : appoinment_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    //console.log(data);
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        
                        $("#data_id").val(appoinment_id);
                        $("#appoiment_date").val(data.appoiment_detail.appoiment_date);
                        $("#appoiment_address").val(data.appoiment_detail.appoiment_address);
                        $("#phone_number").val(data.appoiment_detail.phone_number);
                        $("#reason").val(data.appoiment_detail.reason);
                        $("#remarks").val(data.appoiment_detail.remarks);
                        
                        $("#contact_person_name").val(data.appoiment_detail.contact_person_name);
                        $("#phone_number_cp").val(data.appoiment_detail.phone_number_cp);
                        $("#email_cp").val(data.appoiment_detail.email_cp);
                        $("#cust_email").val(data.appoiment_detail.cust_email);
                        $("#cust_number").val(data.appoiment_detail.cust_number);
                        $("#reminder_before_date").val(data.appoiment_detail.reminder_before_date);
                        if(data.appoiment_detail.email_alert==1){
                        $("#email_alert").prop('checked', true);
                        $("#cust_email_div").show();
                        $("#reminder_time_div").show();
                        $("#repeat_until_due_date_div").show();
                       }
                       if(data.appoiment_detail.sms_alert==1){
                        $("#sms_alert").prop('checked', true);
                        $("#cust_phone_div").show();  
                        $("#reminder_time_div").show();
                        $("#repeat_until_due_date_div").show();
                       }
                       if(data.appoiment_detail.repeat_until_due_date==1){
                        $("#repeat_until_due_date").prop('checked', true);
                       } 
                       $("#reminder_time").val(data.appoiment_detail.reminder_time);
                    }

                   
            }
        });
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
    });	
        $(".btn_info").click(function() {
		$(".add-new-equipment-box").css('display', 'none');
                $(".add-new-appoinments-box").css('display', 'block');
		$(".add-new-equipment").css('display', 'block');
                $(".rightside_info_box").css('display', 'block');
                $(".rightside_add_edit_box").css('display', 'none');
                $(".main-left").css('width', '66%');
                $(".main-right").css('width', '32%');
                $(".oncall-box").css('display', 'none');
                $(".main-right").css('display', 'block');
                $("#mode").val('edit');
        ///////////////////////////ajax////////////////////////
         var appoinment_id = $(this).attr('data-id');
        $.ajax({ 
            async   :false,
            url     :"{$url_path}ajax_get_appoiment.php",
            data    : { "appoinment_id" : appoinment_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        var table_data='';
                        table_data="<div class='widget-header span12'><h1>{$translate.appoiment_detail}</h1></div>";
                        table_data="<div class='span12 no-ml mb' style='overflow-x: auto;'>";
                        table_data+="<table class='table  table-bordered table-responsive  ' style='margin: 0px ! important; top: 0px; border-top: thin solid rgb(204, 204, 204);'>";
                        table_data+="<tbody>";
                        table_data+="<tr class='gradeX'><td>{$translate.appoiment_date}</td><td>"+data.appoiment_detail.appoiment_date+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.appoiment_address}</td><td>"+data.appoiment_detail.appoiment_address+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.phone_number}</td><td>"+data.appoiment_detail.phone_number+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.appoiment_reason}</td><td>"+data.appoiment_detail.reason+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.appoiment_remarks}</td><td>"+data.appoiment_detail.remarks+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.contact_person_name}</td><td>"+data.appoiment_detail.contact_person_name+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.phone_number_cp}</td><td>"+data.appoiment_detail.phone_number_cp+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.email_cp}</td><td>"+data.appoiment_detail.email_cp+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.email}</td><td>"+data.appoiment_detail.cust_email+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.phone_number}</td><td>"+data.appoiment_detail.cust_number+"</td></tr>";
                        table_data+="<tr class='gradeX'><td>{$translate.reminder_before}</td><td>"+data.appoiment_detail.reminder_before_date+"&nbsp"+data.appoiment_detail.reminder_time+"</td></tr>";
                        table_data+='</tbody>';
                        table_data+='</table></div>';
                        table_data+="<div class='row-fluid' style='margin: 0px ! important;'>\n\
                                <div class='span12'> \n\
                                    <button class='btn btn-danger span12 no-ml pull-right' type='button' onclick='close_right();'>{$translate.cancel}</button>\n\
                                </div>\n\
                            </div>";
                        $(".rightside_info_box").html(table_data);
                    }    
            }
        });
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
        });
	$(".btn-oncall-box").click(function() {
            $(".add-new-equipment-box").css('display', 'none');
            $(".add-new-appoinments-box").css('display', 'none');
            $(".add-new-equipment").css('display', 'block');
            $(".main-left").css('width', '66%');
            $(".main-right").css('width', '32%');
            $(".oncall-box").css('display', 'block');
            $(".main-right").css('display', 'block');
        });
        /*MAIN-RIGHT COLLPASE*/	
        $(".cancel-new-equipment").click(function() {
            $(".main-left").css('margin-top', '0px');
            $(".main-left").css('width', '99%');
            $(".main-right").css('display', 'none');
      
        });
});
function close_right(){
     $(".main-left").css('margin-top', '0px').css('width', '99%');
    $(".main-right").css('display', 'none');
}
</script>
<script>
    function validate_appoiment(){
        var error = 0;
        if ($("#appoiment_date").val() == ""){
            $("#appoiment_date").addClass("error");
            error++;
        }
        else{
            $("#appoiment_date").removeClass("error");
        }
        
        var phone_number = $.trim($("#phone_number").val());
        if (phone_number == "" || phone_number == "+46"){
            $("#phone_number").addClass("error");
            error++;
        }
        else{
            $("#phone_number").removeClass("error");
        }
        
        if ($.trim($("#reason").val()) == ""){
            $("#reason").addClass("error");
            error++;
        }
        else{
            $("#reason").removeClass("error");
        }
        
        if ($.trim($("#contact_person_name").val()) == ""){
            $("#contact_person_name").addClass("error");
            error++;
        }
        else{
            $("#contact_person_name").removeClass("error");
        }
        
        var phone_number_cp = $.trim($("#phone_number_cp").val());
        if (phone_number_cp == "" || phone_number_cp == "+46"){
            $("#phone_number_cp").addClass("error");
            error++;
        }
        else{
            $("#phone_number_cp").removeClass("error");
        }
        
        if ($.trim($("#email_cp").val()) != ""){

            var x = $.trim($("#email_cp").val());
            var dotpos=x.lastIndexOf(".");
            var atpos=x.indexOf("@");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {

                $("#email_cp").addClass("error");
                error++;
            }else{
                $("#email_cp").removeClass("error");
            }
        }
        else {
            $("#email_cp").addClass("error");
            error++;
        }

        if ($('#email_alert').attr('checked')) {
            $("#cust_email_div").show();
            if ($.trim($("#cust_email").val()) == "") {
                $("#cust_email").addClass("error");
                error++;
            }
            else {
                $("#cust_email").removeClass("error");
            }
        } else {
            $("#cust_email").removeClass("error");
            $("#cust_email_div").hide();
        }
        if ($('#sms_alert').attr('checked')) {
            $("#cust_phone_div").show();
            var cust_number = $.trim($("#cust_number").val());
            if (cust_number == "" || cust_number == "+46") {
                $("#cust_number").addClass("error");
                error++;
            }
            else {
                $("#cust_number").removeClass("error");
            }
        } else {
            $("#cust_number").removeClass("error");
            $("#cust_phone_div").hide();
        }

        if ($('#sms_alert').attr('checked') || $('#email_alert').attr('checked')) {

            $("#reminder_time_div").show();
            var reminder_before_date = $.trim($("#reminder_before_date").val());
            
            if (reminder_before_date == '' || reminder_before_date == 0 || reminder_before_date == '0') {
                $("#reminder_before_date").addClass("error");
                error++;
            }
            else {
                $("#reminder_before_date").removeClass("error");
            }
        } else {
            $("#reminder_time_div").hide();
        }
        if (error > 0) {
            return false;
        } else {
            return true;
        }
    }
        
    email_reminder();
    
    function email_reminder(){
        if($('#email_alert').attr('checked')) {
        $("#cust_email_div").show(); 
        }else{
         $("#cust_email_div").hide();
        } 
        if($('#sms_alert').attr('checked')) {
         $("#cust_phone_div").show();  
        }else{
         $("#cust_phone_div").hide();
        } 
        if($('#sms_alert').attr('checked') || $('#email_alert').attr('checked')) {
        $("#reminder_time_div").show();
        $("#repeat_until_due_date_div").show();
        }else{
        $("#reminder_time_div").hide();
        $("#repeat_until_due_date_div").hide();
        }
    }
    
var change = 0;
var confirm_ask = 0;
function markChange(){
    change = 1;
    $("#new").val("1");
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        if(change == 1){ 
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = redirectURL;
                        }
                    }
            });
        }
        else{ 
            document.location.href = redirectURL;
        }
    }
}



function giveInactive(){
    var inact = $("#date_inactive").val();
    if(inact == "" || inact == null){
        $("#date_inactive").val("{$today}");
    }
    markChange();

}   

function giveActivation(){
    var inact = $("#date_inactive").val();
    if(inact != "" || inact != null){
        $("#date_inactive").val("");
    }
    
    markChange();

} 
function downloadFile(filename){
    document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
}

function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}

</script>
{/block}
{block name="content"}
    
    <div class="row-fluid">
        <div style="width: 99%; margin-top: 0px;" class="span12 main-left">
            <div style="margin: 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1>{$translate.personal_information}</h1>
                </div>
            </div>

            <div class="span12 widget-body-section input-group"><div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                    <div class="widget-body" style="padding:4px;">
                        <div class="row-fluid">
                            <div class="span4 top-customer-info"><strong>{$translate.social_security} </strong> : {$customer_detail.social_security}</div>
                            <div class="span4 top-customer-info"><strong>{$translate.code}</strong> {$customer_detail.code}</div>
                            {if $sort_by_name == 1}
                            <div class="span4 top-customer-info"><strong>{$translate.name}</strong> {$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
                            {elseif $sort_by_name == 2}
                            <div class="span4 top-customer-info"><strong>{$translate.name}</strong> {$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>
                            {/if}
                        </div>
                    </div>
                </div>

                 <div class="row-fluid">
                        <div class="span12">
                            <div class="tab-content-switch-con" >
                                {block name="customer_manage_tab_content"}{/block}
                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.customer} {$translate.appoiments}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                         <button class="btn btn-default btn-normal pull-right ml" onclick="backForm()" type="button"><span class="icon-arrow-left"></span> {$translate.back}</button>
                                          <button class="btn btn-default btn-normal pull-right btn-addnew-appoinments" type="button"><span class="icon-plus"></span> {$translate.add_new}</button>
                                    </div>
                                </div>
                            </div>

                        <div class="tab-content-con boxscroll">
                                  <div class="tab-content span12" style="margin:0;">
                            <!--///////////////////////////////////TAB10 BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                            <div role="tabpanel" class="tab-pane active" id="10">
                            


                                <div style="margin-left: 0px;" class="span12">
                                    <div class="span12">
                                        <div class="widget" style="margin: 0px ! important;">
                                            <!--WIDGET BODY BEGIN-->
                                            <div class="span12 widget-body-section input-group">


                                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group">
                                                        <div class="span12">
                                                            <form style ="margin-top: 4px;" id="form1" name="form1" action="{$url_path}{if $user_role neq 4}customer/appoiments{else}appointments{/if}/{$customer}/" method="post" >
                                                            {if $report_year == ""}  
                                                                {$report_year = $smarty.now|date_format:"%Y"}
                                                            {/if}
                                                            <div class="span3" style="margin: 0px;">
                                                                <label class="span12" style="float: left;" for="exampleInputEmail1">{$translate.year} : </label>
                                                                <div style="float: left; margin: 0px ! important;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                    <select id="cmb_year" name="year" class="form-control span11">
                                                                        {html_options values=$year_option_values selected=$year output=$year_option_values}
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="span3" style="margin: 0px;">
                                                                <label class="span12" style="float: left;" for="exampleInputEmail1">{$translate.month} : </label>
                                                                <div style="float: left; margin: 0px;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                    <select id="cmb_month" name="month" class="form-control span11">
                                                                        {if $month == ''}

                                                                            <option value="01" {if  $smarty.now|date_format:"%m" == 01} selected = "selected" {/if} >{$translate.january}</option>

                                                                            <option value="02" {if  $smarty.now|date_format:"%m" == 02} selected = "selected" {/if}>{$translate.february}</option>

                                                                            <option value="03" {if  $smarty.now|date_format:"%m" == 03} selected = "selected" {/if}>{$translate.march}</option>

                                                                            <option value="04" {if  $smarty.now|date_format:"%m" == 04} selected = "selected" {/if}>{$translate.april}</option>

                                                                            <option value="05" {if  $smarty.now|date_format:"%m" == 05} selected = "selected" {/if}>{$translate.may}</option>

                                                                            <option value="06" {if  $smarty.now|date_format:"%m" == 06} selected = "selected" {/if}>{$translate.june}</option>

                                                                            <option value="07" {if  $smarty.now|date_format:"%m" == 07} selected = "selected" {/if}>{$translate.july}</option>

                                                                            <option value="08" {if  $smarty.now|date_format:"%m" == 08} selected = "selected" {/if}>{$translate.august}</option>

                                                                            <option value="09" {if  $smarty.now|date_format:"%m" == 09} selected = "selected" {/if}>{$translate.september}</option>

                                                                            <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.october}</option>

                                                                            <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.november}</option>

                                                                            <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.december}</option>

                                                                        {else}

                                                                            <option value="01" {if  $month == 1} selected = "selected" {/if} >{$translate.january}</option>

                                                                            <option value="02" {if  $month == 2} selected = "selected" {/if}>{$translate.february}</option>

                                                                            <option value="03" {if  $month == 3} selected = "selected" {/if}>{$translate.march}</option>

                                                                            <option value="04" {if  $month == 4} selected = "selected" {/if}>{$translate.april}</option>

                                                                            <option value="05" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>

                                                                            <option value="06" {if  $month == 6} selected = "selected" {/if}>{$translate.june}</option>

                                                                            <option value="07" {if  $month == 7} selected = "selected" {/if}>{$translate.july}</option>

                                                                            <option value="08" {if  $month == 8} selected = "selected" {/if}>{$translate.august}</option>

                                                                            <option value="09" {if  $month == 9} selected = "selected" {/if}>{$translate.september}</option>

                                                                            <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.october}</option>

                                                                            <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.november}</option>

                                                                            <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.december}</option>

                                                                        {/if}
                                                                    </select>
                                                                </div>
                                                            </div>




                                                            <div style="margin: 15px 0px 0px;" class="span4">

                                                                <input class="btn btn-default span6" style="text-align: center;" type="submit" name="detail" value="{$translate.show}"/>
                                                            </div> 
                                                        </form>
                                                        </div>
                                                    </div>
                                                    <!--WIDGET BODY END-->
                                                </div>

                                                <form name="form" id="form" method="post" enctype="multipart/form-data" action="{$url_path}{if $user_role neq 4}customer/appoiments/{$customer}/{else}appointments/{$customer}/{/if}" class='pull-left span12 no-ml'>
                                                    
                                                    <input type="hidden" name="username" id="username" value="{$customer}" />
                                                    <input type="hidden" name="mode_delete" id="mode_delete" value="" />
                                                    <input type="hidden" name="delete_id" id="delete_id" value="" />
                                                <div class="row-fluid">
                                                <div class="table-responsive">
                                                    <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin-bottom: 0px; top: 0px;">
                                                        <!-- Table heading -->
                                                        <thead>
                                                            <tr>
                                                                <th data-class="expand">{$translate.label_date}</th>
                                                                <th data-hide="phone,tablet">{$translate.phone_number}</th>
                                                                <th data-hide="phone,tablet">{$translate.appoiment_reason}</th>
                                                                <th data-hide="phone">{$translate.contact_person_name}</th>
                                                                <th>{$translate.phone_number_cp}</th>
                                                                <th>{$translate.email_cp}</th>
                                                                <th class="table-col-center small-col" style="width: 15px;"></th>
                                                            </tr>
                                                        </thead>
                                                        <!-- // Table heading END -->
                                                        <!-- Table body -->
                                                        <tbody>
                                                            {foreach from=$appoiments_arr item=appoiments}
                                                                <tr class="gradeX">
                                                                    <td  class="large-col" height="20">{$appoiments.appoiment_date|substr:0:-3}</td>
                                                                    <td width="10%">{if $appoiments.phone_number neq 0 && $appoiments.phone_number neq ''}{$appoiments.phone_number}{/if}</td>
                                                                    <td width="17%">{$appoiments.reason|truncate:50}</td>
                                                                    <td width="15%">{$appoiments.contact_person_name}</td>
                                                                    <td width="10%">{$appoiments.phone_number_cp}</td>
                                                                    <td width="15%">{$appoiments.email_cp}</td>
                                                                    <td class="table-col-center pr pl tbl-action-col" style="padding: 5px; width: 104px;">
                                                                        <button type="button" class="btn btn-default btn_edit no-ml" data-id="{$appoiments.id}"><i class="icon icon-edit"></i> </button>
                                                                        <button type="button" class="btn btn-default btn_info no-ml" data-id="{$appoiments.id}"><i class="icon icon-eye-open"></i> </button>
                                                                        <button type="button" class="btn btn-defaultbtn_delete no-ml" onclick="deleteAppoinment({$appoiments.id});"><i class="icon icon-trash"></i> </button>
                                                                    </td>
                                                                </tr>
                                                            {foreachelse}	
                                                                <tr><td height="25" style="color:#F00;" colspan="10">{$translate.no_data}</td></tr>
                                                                {/foreach}
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                 </div>
                                                </form>                
                                                <div class="span12">

                                                </div>
                                                <label style="margin-bottom:10px !important;" for="exampleInputEmail1"> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div style="display: block;" class="span4 main-right no-mt">


                <form name="form" id="form" method="post" onsubmit="return validate_appoiment();" enctype="multipart/form-data" action="{$url_path}customer_appoiment_add.php">
                    <input type="hidden" name="id" id="data_id" value=""/>
                    <input type="hidden" name="username" id="username" value="{$cust}" />
                    <input type="hidden" name="customers" id="customers" value="{*$customers_uname*}{$customer}" />
                    <input type="hidden" name="mode" id="mode" value="add" />
                    <div class="span12 add-new-appoinments-box"  style="margin-left: 0px; display: block;">
                        <div style="margin: 0px ! important;" class="widget rightside_info_box">
                            
                        </div>
                        <div style="margin: 0px ! important;" class="widget rightside_add_edit_box">
                            <div class="widget-header span12">
                                <h1>{$translate.add}</h1>
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group">
                                <div class="row-fluid">
                                    <div class="span12 form-left" style="padding: 0px; margin: 0px;">


                                        <div style="margin: 0px;" class="span12">
                                            <label style="float: left;" class="span12" for="appoiment_date">{$translate.appoiment_date}*</label>    
                                            <div id="datetimepicker3" class="input-prepend date hasDatepicker">
                                                <span class="add-on icon-calendar"></span>
                                                <input class="form-control span10" type="text" name="appoiment_date" id="appoiment_date" {if $appoiments_arr.appoiment_date != ""} value="{$appoiments_arr.appoiment_date|substr:0:-3}" {else} value="" {/if}> 
                                            </div>    
                                        </div>    


                                        <div style="margin: 10px 0px 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="appoiment_address">{$translate.appoiment_address}</label>
                                            <textarea name="appoiment_address" style="margin: 0px 0px 10px;" rows="1" class="form-control span12" id="appoiment_address" >{$appoiments_arr.appoiment_address}</textarea>
                                        </div>

                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="phone_number">{$translate.phone_number}*</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span11" placeholder="{$translate.phone_number}" type="text" name="phone_number" id="phone_number" {if $appoiments_arr.phone_number != "" && $appoiments_arr.phone_number != 0} value="{$appoiments_arr.phone_number}" {else} value="" {/if}> 
                                            </div>
                                        </div>

                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.appoiment_reason}*</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span11" placeholder="{$translate.appoiment_reason}" type="text" name="reason" id="reason" {if $appoiments_arr.reason != ""} value="{$appoiments_arr.reason}" {else} value="" {/if}> 
                                            </div>
                                        </div>

                                        <div style="margin: 0px 0px 10px;" class="span12">
                                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.appoiment_remarks}</label>
                                            <textarea name="remarks" class="form-control span12" style="margin: 0px 0px 10px;" rows="1" id="remarks">{$appoiments_arr.remarks}</textarea>

                                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                <label style="float: left;" class="span12" for="contact_person_name">{$translate.contact_person_name}*</label>
                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                    <input class="form-control span11" placeholder="{$translate.contact_person_name}" type="text" name="contact_person_name" id="contact_person_name" {if $appoiments_arr.contact_person_name != ""} value="{$appoiments_arr.contact_person_name}" {else} value="" {/if}> 
                                                </div>
                                            </div>

                                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                <label style="float: left;" class="span12" for="phone_number_cp">{$translate.phone_number_cp}*</label>
                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-phone"></span>
                                                    <input class="form-control span11" placeholder="{$translate.phone_number_cp}" type="text" name="phone_number_cp" id="phone_number_cp" {if $appoiments_arr.phone_number_cp != ""} value="{$appoiments_arr.phone_number_cp}" {else} value="" {/if}> 
                                                </div>
                                            </div>

                                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                <label style="float: left;" class="span12" for="email_cp">{$translate.email_cp}*</label>
                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-envelope"></span>
                                                    <input class="form-control span11" placeholder="{$translate.email_cp}"  name="email_cp" id="email_cp" type="email" {if $appoiments_arr.email_cp != ""} value="{$appoiments_arr.email_cp}" {else} value="" {/if}> 
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span12">

                                                    <input onclick="email_reminder();" style="margin: 0px 5px 0px 0px ! important;" class="check-box" type="checkbox" name="email_alert" id="email_alert" {if $appoiments_arr.email_alert == 1} checked {/if} value="1">{$translate.remind_me_approintment_over_email}.
                                                </div>
                                                <div style="margin: 0px 0px 10px ! important;" id="cust_email_div" class="span12">
                                                    <div style="float: left;" class="span12">
                                                        <label class="pull-left" for="cust_email">{$translate.email}</label>
                                                        <label style="float: right !important;"><input type="checkbox" id="chk_same_email" class="check-box" /> {$translate.copy_from_contact_person}</label>
                                                    </div>
                                                    
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                        <input type="email" name="cust_email" id="cust_email"  class="form-control span11"  {if $appoiments_arr.cust_email != ""} value="{$appoiments_arr.cust_email}" {else} value="{$customer_arr[0].email}" {/if}  />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <input name="sms_alert" id="sms_alert" onclick="email_reminder();" style="margin: 0px 5px 0px 0px ! important;" class="check-box" type="checkbox" {if $appoiments_arr.sms_alert == 1} checked {/if} value="1">{$translate.remind_me_about_this_approintment_over_sms}.
                                                </div>
                                                <div style="margin: 0px 0px 10px ! important;" id="cust_phone_div" class="span12">
                                                    <div style="float: left;" class="span12">
                                                        <label class="pull-left" for="cust_number">{$translate.phone_number} ({$translate.number_where_alert_should_sent})</label>
                                                        <label style="float: right !important;"><input type="checkbox" id="chk_same_phone" class="check-box" /> {$translate.copy_from_contact_person}</label>
                                                    </div>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                        <input type="text" name="cust_number" id="cust_number" class="form-control span11"  {if $appoiments_arr.cust_number != ""} value="{$appoiments_arr.cust_number}" {else} value="{$customer_arr[0].mobile}" {/if}  />
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                <label style="float: left;" class="span12" for="equipment_nums">{$translate.reminder_before}</label>
                                                <div style="margin: 0px;" class="input-prepend span12" id="reminder_time_div"> <span class="add-on icon-pencil"></span>
                                                    <input class="form-control span6" name="reminder_before_date" id="reminder_before_date" type="text" {if $appoiments_arr.reminder_before_date != ""} value="{$appoiments_arr.reminder_before_date}" {else} value="" {/if}> 
                                                    &nbsp;&nbsp;
                                                    <select name="reminder_time" id="reminder_time"class="form-control span5" >
                                                        <option value="hours" >{$translate.label_hours}</option>
                                                        <option {if $appoiments_arr.reminder_before_date == "days"}selected{/if} value="days" >{$translate.label_days}</option>
                                                    </select>
                                                </div>
                                            </div>        


                                            <div class="row-fluid">
                                                <div class="span12" id="repeat_until_due_date_div">
                                                    <input name="repeat_until_due_date" id="repeat_until_due_date"  style="margin: 0px 5px 0px 0px ! important;" class="check-box" type="checkbox" {if $appoiments_arr.repeat_until_due_date == 1} checked {/if} value="1">{$translate.repeat_until_due_date}.
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row-fluid" style="margin: 0px ! important;">
                                <div class="span12"> 
                                    <input class="btn btn-success span6" name="add" type="submit" value="{$translate.save}"/>
                                    <button class="btn btn-danger span6 no-ml cancel-new-equipment pull-right" type="button">{$translate.cancel}</button>
                                </div>
                            </div>
                        </div>
                        <!--WIDGET BODY END-->
                    </div>
                    <div class="row-fluid">
                    </div>
                    <div class="row-fluid">
                        <div class="span12"></div>
                    </div>
                </form>
            </div> 
    
  </div>  
    
    </div>
{/block}