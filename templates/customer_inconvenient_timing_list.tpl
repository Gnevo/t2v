{block name='style'}
    <link rel="stylesheet" href="{$url_path}css/jquery-ui-new.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <link rel="stylesheet" type="text/css" href="{$url_path}css/inconvenient-timings.css" media="all" />  
    <style type="text/css">
        .scroll-pane, .scroll-pane-arrows{
            width: 100%;
            height: 200px;
            overflow: auto;
        }
        .horizontal-only{
            height: auto;
            max-height: 200px;
        }
        .holidayinc_wrapper {
            border: 1px solid #DCDCDC;
        }
        .holidayinc_main {
            /*border: 1px solid #DCDCDC;*/
            margin: 5px;
        }
        .holidayinc_coloum {
            float: left;
            height: 16px;
            padding: 10px 10px;
            text-align: center;
            border-right: 1px solid #DCDCDC;
        }
        .holidayinc_row, .holidayinc_rowinner {
            border-bottom: 1px solid #DCDCDC;
        }
        .holidayinc_row .col_header {
            height:20px; 
            padding-top:18px;
            font-weight: bold;
        }

        .inconveniant_title_head{
            background-color:#A4DEEA;
            padding:5px;
        }
        .divTable {
            display: table;
            width: 100%;
            background-color: #E3EDF0;
            border: 1px solid #DCDCDC;
            border-right:none;
            border-bottom:none;
            border-spacing: 0px;/*cellspacing:poor IE support for  this*//* border-collapse:separate;*/
        }
        .headRow {
            display: table-row;
            text-align: center;
            background: #DAF2F7;
            font-weight: bold;
        }
        .headRow .divCell { /*padding: 20px 10px;*/ }
        .row_group { display: table-row-group; background: #F7FBFB; }
        .divRow { display: table-row; width: auto; text-align: center; }
        .divCell { /*float: left;fix for  buggy browsers*/ display: table-cell; min-width: 10px; border-right: 1px solid #DCDCDC; border-bottom: 1px solid #DCDCDC; padding: 8px; vertical-align: middle; }
        .option_cell { /*float: left;fix for  buggy browsers*/ padding: 5px 0 2px; }
        .tb_opt ul li { display: inline; list-style: none; margin-left: 2px;}
        .subhead_titles_tab { display: block;float: left;font: bold 12px Arial,Helvetica,sans-serif;padding-top: 4px;margin-left: 5px;}
        .scrol_down_image_pointer { background: url("{$url_path}/images/downarrow_icon.png") no-repeat scroll 39px 29px;}
        .scrol_down_image_pointer_inconv { background: url("{$url_path}/images/downarrow_icon.png") no-repeat;background-position: bottom right;}
        .inconv_table .days_inner_tbl td{ border: 1px solid #D6D6D6;padding: 3px 8px;}
        table tbody tr td > .day-report{ height: auto !important;}
    </style>
{/block}

{block name="script"}
    <script src="{$url_path}js/jquery-ui.js"></script>
    <script src="{$url_path}js/date-picker.js"></script>
    <!--RESPOSNIVE TABS-->
    <script>
        
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-279});
    else
        $('.tab-content-con').css({ height: $(window).height()});    
        
        
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
    </script>
<script type="text/javascript">
    
    $(document).ready(function() {
    
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        });
            
        /*$( "#date_from, #date_to" ).datepicker({
            dateFormat: "yy-mm-dd"
        });*/

    //replace ',' => '.' while entering time
    $(document).off('keyup', "#time_from, #time_to")
        .on('keyup', "#time_from, #time_to", function() {
                $(this).val($(this).val().replace(/,/g,"."));
    });
     
    {if $flag eq 1}
        $(".oncalls_dsip").hide();
        toggme('new');
    {/if}
    //DAYS
    var hide_show_flag = 0;
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });
        
    $("table#holidayinc_main .holiday_main td.have_child, table#inconv_table .holiday_main td.have_child").click(function() {
            $(this).parents('.holiday_main').next('.child_holi').find('tr.item_row').toggleClass('hide');
    });
    
    $(".cancel-new-equipment").click(function() {
         $(".main-left").css('width', '99%');
        $(".main-right").css('display', 'none');
    });
    
    $(".btn-addnew-inconvtiming").click(function() {  
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right, .oncall-box").css('display', 'block');
        $('#hidden_action').val('newentry');
        
        $("#hidden_cust_id").val('');
        $("#hidden_cust_code").val('');
        $("#name").val('');
        $("#date_from").val('');
        $(".date_to").hide();
        $("#time_from").val('');
        $("#time_to").val('');
        $("#salary").val('');
        $("#salary_call_training").val('');
        $("#salary_complimentary_oncall").val('');
        $("#salary_more_oncall").val('');
        $("#salary_dismissal_oncall").val('');
        $("#ltype1").prop( "checked", false );
        $("#ltype2").prop( "checked", false );
        $("#ltype" ).buttonset();
        $("#check1").prop( "checked", false );    
        $("#check2").prop( "checked", false );   
        $("#check3").prop( "checked", false );    
        $("#check4").prop( "checked", false );    
        $("#check5").prop( "checked", false );   
        $("#check6").prop( "checked", false );    
        $("#check7").prop( "checked", false ); 
        $( "#format" ).buttonset();
						
        $('html, body').animate({
            scrollTop: $(".main-right").offset().top
        }, 3000);
    });
    $(".btn_edit").click(function() {  
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right").css('display', 'block');
        $(".oncall-box").css('display', 'block');
        $('#hidden_action').val('edit');
        
        ///////////////////////////ajax////////////////////////
        
         var user_id = $(this).attr('user_id');
         var code = $(this).attr('user_name');
         //console.log(user_name);
        wrapLoader('#edit_form_section');
        $.ajax({ 
            async   :false,
            url     :"{$url_path}ajax_get_callsettings.php",
            data    : { "user_id" : user_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    //console.log(data);
                        $("#hidden_cust_id").val('');
                        $("#hidden_cust_code").val('');
                        $("#name").val('');
                        $("#date_from").val('');
                        $("#date_to").prop('disabled', true);
                        $(".date_to").hide();
                        $("#time_from").val('');
                        $("#time_to").val('');
                        $("#salary").val('');
                        $("#salary_call_training").val('');
                        $("#salary_complimentary_oncall").val('');
                        $("#salary_more_oncall").val('');
                        $("#salary_dismissal_oncall").val('');
                        $("#ltype1").prop( "checked", false );
                        $("#ltype2").prop( "checked", false );
                        
                        $("#check1").prop( "checked", false );    
                        $("#check2").prop( "checked", false );   
                        $("#check3").prop( "checked", false );    
                        $("#check4").prop( "checked", false );    
                        $("#check5").prop( "checked", false );   
                        $("#check6").prop( "checked", false );    
                        $("#check7").prop( "checked", false ); 
                    
                    if(data.transaction_flag !== undefined && data.transaction_flag){    
                        $("#hidden_cust_id").val(user_id);
                        $("#hidden_cust_code").val(code);
                        $("#name").val(data.inconvenient_detail.name);
                        $("#date_from").val(data.inconvenient_detail.effect_from);
                        if(data.inconvenient_detail.effect_to != null && data.inconvenient_detail.effect_to != ''){
                        $("#date_to").prop('disabled', false);
                        $(".date_to").show();
                        $("#date_to").val(data.inconvenient_detail.effect_to);
                        }else{
                        $("#date_to").prop('disabled', true);
                        }
                        $("#time_from").val(data.inconvenient_detail.time_from);
                        $("#time_to").val(data.inconvenient_detail.time_to);
                        $("#salary").val(data.inconvenient_detail.amount);
                        $("#salary_call_training").val(data.inconvenient_detail.sal_call_training);
                        $("#salary_complimentary_oncall").val(data.inconvenient_detail.sal_complementary_oncall);
                        $("#salary_more_oncall").val(data.inconvenient_detail.sal_more_oncall);
                        $("#salary_dismissal_oncall").val(data.inconvenient_detail.sal_dismissal_oncall);
                        if(data.inconvenient_detail.nature=='0')
                        $("#ltype1").prop( "checked", true );
                        if(data.inconvenient_detail.nature=='1')
                        $("#ltype2").prop( "checked", true );
                        $( "#ltype" ).buttonset();
                        
                        if(data.inconvenient_detail.days.mon==1)
                        $("#check1").prop( "checked", true );    
                        if(data.inconvenient_detail.days.tue==1)
                        $("#check2").prop( "checked", true );    
                        if(data.inconvenient_detail.days.wed==1)
                        $("#check3").prop( "checked", true );    
                        if(data.inconvenient_detail.days.thu==1)
                        $("#check4").prop( "checked", true );    
                        if(data.inconvenient_detail.days.fri==1)
                        $("#check5").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sat==1)
                        $("#check6").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sun==1)
                        $("#check7").prop( "checked", true );    
                        //id="check1" class="check" name="mon" value="1" {*if $days.mon eq 1}checked="checked"{/if*}
                        $( "#format" ).buttonset();
                    }     
            }
            
        }).always(function(data) { 
            uwrapLoader("#edit_form_section");
        });
        
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
    });
    $(".btn_clone").click(function() {   
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
		 
        $(".main-right").css('display', 'block');
        $(".oncall-box").css('display', 'block');
        $('#hidden_action').val('clone');
        
        ///////////////////////////ajax////////////////////////
        
         var user_id = $(this).attr('user_id');
         var code = $(this).attr('user_name');
         //console.log(user_name);
        wrapLoader('#edit_form_section');
        $.ajax({ 
            async   :false,
            url     :"{$url_path}ajax_get_callsettings.php",
            data    : { "user_id" : user_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    //console.log(data);
                    $("#hidden_cust_id").val('');
                        $("#hidden_cust_code").val('');
                        $("#name").val('');
                        $("#date_from").val('');
                        $("#date_to").prop('disabled', true);
                        $(".date_to").hide();
                        $("#time_from").val('');
                        $("#time_to").val('');
                        $("#salary").val('');
                        $("#salary_call_training").val('');
                        $("#salary_complimentary_oncall").val('');
                        $("#salary_more_oncall").val('');
                        $("#salary_dismissal_oncall").val('');
                        $("#ltype1,#ltype2").prop( "checked", false );
                        
                        $("#check1").prop( "checked", false );    
                        $("#check2").prop( "checked", false );   
                        $("#check3").prop( "checked", false );    
                        $("#check4").prop( "checked", false );    
                        $("#check5").prop( "checked", false );   
                        $("#check6").prop( "checked", false );    
                        $("#check7").prop( "checked", false ); 
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        
                        $("#hidden_cust_id").val(user_id);
                        $("#hidden_cust_code").val(code);
                        $("#name").val(data.inconvenient_detail.name);
                        $("#date_from").val(data.inconvenient_detail.effect_from);
                        if(data.inconvenient_detail.effect_to != null && data.inconvenient_detail.effect_to != ''){
                            $("#date_to").prop('disabled', false);
                            $(".date_to").show();
                            $("#date_to").val(data.inconvenient_detail.effect_to);
                        }
                        else{
                            $("#date_to").prop('disabled', true);
                        }
                        $("#time_from").val(data.inconvenient_detail.time_from);
                        $("#time_to").val(data.inconvenient_detail.time_to);
                        $("#salary").val(data.inconvenient_detail.amount);
                        $("#salary_call_training").val(data.inconvenient_detail.sal_call_training);
                        $("#salary_complimentary_oncall").val(data.inconvenient_detail.sal_complementary_oncall);
                        $("#salary_more_oncall").val(data.inconvenient_detail.sal_more_oncall);
                        $("#salary_dismissal_oncall").val(data.inconvenient_detail.sal_dismissal_oncall);
                        if(data.inconvenient_detail.nature=='0')
                        $("#ltype1").prop( "checked", true );
                        if(data.inconvenient_detail.nature=='1')
                        $("#ltype2").prop( "checked", true );
                        $( "#ltype" ).buttonset();
                        
                        
                        if(data.inconvenient_detail.days.mon==1)
                        $("#check1").prop( "checked", true );    
                        if(data.inconvenient_detail.days.tue==1)
                        $("#check2").prop( "checked", true );    
                        if(data.inconvenient_detail.days.wed==1)
                        $("#check3").prop( "checked", true );    
                        if(data.inconvenient_detail.days.thu==1)
                        $("#check4").prop( "checked", true );    
                        if(data.inconvenient_detail.days.fri==1)
                        $("#check5").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sat==1)
                        $("#check6").prop( "checked", true );    
                        if(data.inconvenient_detail.days.sun==1)
                        $("#check7").prop( "checked", true );  
                        $( "#format" ).buttonset();
                    }     
            }
            
        }).always(function(data) { 
            uwrapLoader("#edit_form_section");
        });
        
       /////////////////////////////////////////////end ajax////////////////////////////////////////// 
    });
});


function validate(){
    
    var inc_name        = $.trim($('#edit_form_section #name').val());
    var inc_start_date  = $.trim($('#edit_form_section #date_from').val());
    var inc_time_from   = $.trim($('#edit_form_section #time_from').val());
    var inc_time_to     = $.trim($('#edit_form_section #time_to').val());
    var inc_type        = $.trim($('#edit_form_section input:radio[name=ltype]:checked').val());
    //var inc_days        = $.trim($('#edit_form_section #format input:checkbox[name=ltype]:checked').val());
    
    var inc_days_selected = false;
    for(var i=1;i<=7;i++){
        if($("#check"+i).is(":checked") != false)
            inc_days_selected = true;
    }
    
    if(inc_name == '' || inc_start_date == '' ||inc_time_from == '' || inc_time_to == '' || inc_type == '' || !inc_days_selected)
        alert('{$translate.fill_required_fields}');
    else
        $('#timing').submit();
}
function check_from_date(){
    return true;    
}
function warning_delete(){
    if(confirm("{$translate.do_you_want_to_delete_holiday}"))
        return true;
    else
        return false;
}
function warning_delete_inconvenient(id,code){
    if(confirm("{$translate.want_delete}")){

        document.location.href = "{$url_path}customer/inconvenient/timing/"+code+"/"+id+"/delete/";
    }
}
var change = 0;
var confirm_ask = 0;
function markChange(){
    change = 1;
    $("#new").val("1");
}
///////////////////////////MENU FUNCTIONS///////////////////////////////////
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

function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}
</script>

<script type="text/javascript" src="{$url_path}js/jquery.stickyPanel.js"></script>
<script>
	$(document).ready(function() {
            var stickyPanelOptions = {
                topPadding: 3,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };
            
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
        });
</script>
{/block}

{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
        <div style="margin: 15px 0px 0px;" class="widget-header span12">
            <div class="day-slot-wrpr-header-left pull-left">
                <h1 style="margin: 5px ! important;">{$translate.customer}</h1>
            </div>
        </div>

        <div class="span12 widget-body-section input-group">
            <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                {if !empty($customer_detail)}
                <div class="widget-body" style="padding:4px;">
                    <div class="row-fluid">
                        <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{$customer_detail.social_security}</div>
                        <div class="span4 top-customer-info"><strong>{$translate.customer_code} : </strong>{$customer_detail.code}</div>
                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong> {if $sort_by_name == 1}{$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}{elseif $sort_by_name == 2}{$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}{/if}</div>
                    </div>
                </div>
                {/if}
            </div>
            
            
            
        <div class="row-fluid">
                    <div class="span12">
                        <div class="tab-content-switch-con" >
                            {block name="customer_manage_tab_content"}{/block}
                            <div class="widget-header widget-header-options tab-option">
                                <div class="span4 day-slot-wrpr-header-left span3">
                                         <h1 style="">{$translate.inconvenient_timings}</h1>
                                </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                         <button class="btn btn-default btn-normal pull-right ml" onclick="backForm()" type="button"><span class="icon-arrow-left"></span> {$translate.back}</button>
                                   <button class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming" type="button"><span class="icon-plus" ></span> {$translate.add_new}</button>
                               </div>
                            </div>
                        </div>
                    
                                   
                                       <div class="tab-content-con boxscroll">
                                           <div class="tab-content span12" style="margin:0;">
                                               <div role="tabpanel" class="tab-pane active" id="11">
                                                   {*                        inconvenient section*}
                                                   <div style="margin: 20px 0px 0px;" class="widget">
                                                       <div class="span12 widget-body-section input-group">
                                                           <div class="table-responsive">
                                                               <table id="inconv_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                                                   <thead>
                                                                       <tr>
                                                                           <th class="table-col-center" style="width:20px">#</th>
                                                                           <th style="width: 100px;">{utf8_encode($translate.name)}</th>

                                                                           <th>{$translate.date_effect_from}</th>
                                                                           <th>{$translate.days}</th>
                                                                           <th style="width:124px;">{$translate.salary}</th>
                                                                           <th style="width:124px;">&nbsp;</th>
                                                                       </tr>
                                                                   </thead>
                                                                   {assign i 0}
                                                                   {if !empty($timing_list)}
                                                                       {foreach from=$timing_list item=list}
                                                                           {assign i $i+1}
                                                                           <tbody class="holiday_main">
                                                                               <tr class="gradeX{if $list.privious_versions|count gt 0} have_child{/if}">
                                                                                   <td style="width: 20px;" class="center{if $list.privious_versions|count gt 0} table-row-collapse-switch-timings  have_child row-expander cursor_hand{/if}" {if $list.privious_versions|count gt 0}title="{$translate.click_here_to_see_previous_versions}"{/if}>{$i}</td>
                                                                                   <td class="table-col-center center{if $list.privious_versions|count gt 0} have_child cursor_hand{/if}" {if $list.privious_versions|count gt 0}title="{$translate.click_here_to_see_previous_versions}"{/if}>{$list.name}</td>

                                                                                   <td class="table-col-center center">{$list.effect_from}{if $list.effect_to neq ''} {$translate.to} {$list.effect_to}{/if}</td>

                                                                                   <td class="center">
                                                                                       {*foreach from=$list.day_time item=day_time}
                                                                                       <div class="day-report"><h1>{$translate.{$week[{$day_time.day-1}].label}}</h1>{$day_time.time}</div>
                                                                                       {/foreach*}	
                                                                                       {foreach from=$list.day_time_merged key=day_key item=day_time}
                                                                                           <div class="day-report"><h1>{$translate.{$week[{$day_key-1}].label}}</h1>
                                                                                                   {'<br/>'|implode:$day_time}
                                                                                           </div>
                                                                                       {/foreach}
                                                                                   </td>
                                                                                   <td class="table-col-center center salary_col">
                                                                                       <ol class="span12">
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> {$list.amount}</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> {$list.sal_call_training}</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> {$list.sal_complementary_oncall}</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> {$list.sal_more_oncall}</div></li>
                                                                                           <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> {$list.sal_dismissal_oncall}</div></li>
                                                                                       </ol>
                                                                                   </td>
                                                                                   <td class="center" style="width: 130px;">
                                                                                       <button type="button" class="btn btn-default btn_edit" title="{$translate.edit}" user_id="{$list.id}" user_name="{$customer_detail.username}"><span class="icon-wrench"></span></button>
                                                                                       {if $list.effect_to eq ''}<button type="button" class="btn btn-default btn_clone" title="{$translate.clone}" user_id="{$list.id}" user_name="{$customer_detail.username}"><span class="icon-share"></span></button>{/if}
                                                                                       <button type="button"  class="btn btn-default btn_delete" title="{$translate.delete}" onclick="warning_delete_inconvenient({$list.id},'{$customer_detail.username}');"><span class="icon-trash"></span></button>
                                                                                   </td>
                                                                               </tr>
                                                                           </tbody>
                                                                           <tbody class="child_holi">
                                                                               {foreach from=$list.privious_versions item=version}
                                                                                   <tr class="gradeX table-row-collapse-Timings-wrpr item_row hide">
                                                                                       <td class="center" style="width: 20px;">* </td>
                                                                                       <td class="table-col-center center">{$version.name}</td>

                                                                                       <td class="table-col-center center">{$version.effect_from}{if $version.effect_to neq ''} {$translate.to} {$version.effect_to}{/if}</td>
                                                                                       <td class="center">
                                                                                           {foreach from=$version.day_time item=day_time}
                                                                                               <div class="day-report"><h1>{$translate.{$week[{$day_time.day-1}].label}}</h1>{$day_time.time}</div>
                                                                                                   {/foreach}
                                                                                       </td>
                                                                                       <td class="table-col-center center salary_col">

                                                                                           <ol class="span12">
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall"></li></ul><div class="pull-left ml"> {$version.amount}</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-call-training"></li></ul><div class="pull-left ml"> {$version.sal_call_training}</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-complimentary-oncall"></li></ul><div class="pull-left ml"> {$version.sal_complementary_oncall}</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-oncall-moretime"></li></ul><div class="pull-left ml"> {$version.sal_more_oncall}</div></li>
                                                                                               <li class="span12 no-ml pull-left"><ul class="pull-left slot-type-small-icons-group "><li class="slot-icon-small-dismissal-oncall"></li></ul><div class="pull-left ml"> {$version.sal_dismissal_oncall}</div></li>
                                                                                           </ol>

                                                                                       </td>
                                                                                       <td class="center">

                                                                                           <button type="button" class="btn btn-default btn_edit" title="{$translate.edit}" user_id="{$version.id}" user_name="{$customer_detail.username}"><span class="icon-wrench"></span></button>
                                                                                           {if $version.effect_to eq ''}<button type="button" class="btn btn-default btn_clone" title="{$translate.clone}" user_id="{$version.id}" user_name="{$customer_detail.username}" ><span class="icon-share"></span></button>{/if}
                                                                                           <button type="button" class="btn btn-default btn_delete" title="{$translate.delete}" onclick="warning_delete_inconvenient({$version.id},'{$customer_detail.username}');"><span class="icon-trash"></span></button>
                                                                                       </td>
                                                                                   </tr>
                                                                               {/foreach}
                                                                           </tbody>
                                                                       {/foreach}
                                                                   {/if}
                                                               </table>
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
    <div style="display: block;  margin-top: 5px;margin-left: 5px;" class="span4 main-right" id="stickyPanelParent">
        <form name="timing" id="timing" method="post">
            <div class="span12 oncall-box" style="margin-left: 0px; display: block;">
                <div style="margin: 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1>{$translate.inconv_timing_norm}</h1>
                        <input type="hidden" name="type_sal" id="type_sal" value="{$timing.type}" />
                        <input type="hidden" name="action" id="hidden_action" value="" />
                        <input type="hidden" name="cust_id" id="hidden_cust_id" value="" />
                        <input type="hidden" name="cust_code" id="hidden_cust_code" value="" />
                    </div>
                    <div class="span12 widget-body-section input-group">

                        <div class="row-fluid mb" id="btnGroupStickyPanel">
                            <div class="span12" style="margin: 0px ! important;"> 
                                <button class="btn btn-success span6" style="text-align: center;" type="button" onclick="validate();"><span class="icon-save"></span> {$translate.save}</button>
                                <button class="btn btn-danger span6 cancel-new-equipment no-ml" style="text-align: center;" type="button"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                            </div>
                        </div>
                        <div class="row-fluid" id="edit_form_section">
                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                <div class="span12" style="margin: 0px;">
                                    <label class="span12" style="float: left;" for="name">{$translate.name} </label>
                                    <div style="float: left; margin: 0px;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>

                                        <select name="name" id="name" class="form-control span11" onchange="markChange()">
                                            <option value="">{$translate.select}</option>
                                            {foreach $timing_names as $nam}
                                                {html_options  values=$nam.name output=$nam.name selected=$timing.name}
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>


                                {*<div style="margin: 10px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="date_from">{$translate.date_effect_from}</label>

                                <div id="datetimepicker6" class="input-append date">
                                <input class="form-control span10" type="text" name="date_from" id="date_from" {if $appoiments_arr.appoiment_date != ""} value="{$appoiments_arr.appoiment_date|substr:0:-3}" {else} value="" {/if}> 
                                <span class="add-on">
                                <i class="icon-th"></i>
                                </span>
                            </div>  
                                </div>*}
                                <div style="margin: 0px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="date_from">{$translate.date_effect_from}</label>
                                    <div class="span12" style="margin: 0px;">
                                        <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11"  name="date_from" id="date_from" value="{$timing.effect_from}" type="text" readonly="readonly"/>
                                        </div>
                                    </div>
                                </div> 


                             <div style="margin: 0px ! important;" class="span12 no-ml date_to">
                                <label style="float: left;" class="span12" for="date_to">{$translate.date_effect_to}</label>
                                <div class="span12" style="margin: 0px;">
                                    <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                        <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11"  name="date_to" id="date_to" value="{$timing.effect_to}" type="text" readonly="readonly"/>
                                    </div>
                                </div>
                             </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.type}</label>
                                    <div id="ltype">
                                        <input type="radio" id="ltype1" name="ltype"  value="0" onchange="markChange()"/><label for="ltype1">{$translate.discrete}</label>
                                        <input type="radio" id="ltype2" name="ltype"  value="1" onchange="markChange()" /><label for="ltype2">{$translate.continus}</label>
                                    </div>
                                </div>
                                <div style="margin: 0px;" class="span12">
                                    <label style="float: left;" class="span12" for="time_from">{$translate.time_range}</label>
                                    <div class="span12" style="margin:0;">
                                        <div class="input-prepend date">
                                            <span class="add-on icon-time"></span>
                                            <input type="text" name="time_from" id="time_from" class="form-control span5" placeholder="{$translate.from}" value="{$timing.time_from}" onchange="markChange()"/>
                                            <span class="add-on icon-time"></span>
                                            <input type="text" name="time_to" id="time_to" class="form-control span5" placeholder="{$translate.to}" value="{$timing.time_to}" onchange="markChange()"/>

                                        </div>
                                    </div>
                                </div>

                                <div style="margin: 0px;" class="span12">
                                    <label style="float: left;" class="span12">{$translate.days}</label>
                                    <div id="format">
                                        <input type="checkbox" id="check1" class="check" name="mon" value="1" {if $days.mon eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check1">{$translate.mon}</label>
                                        <input type="checkbox" id="check2" class="check" name="tue" value="2" {if $days.tue eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check2">{$translate.tue}</label>
                                        <input type="checkbox" id="check3" class="check" name="wed" value="3" {if $days.wed eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check3">{$translate.wed}</label>
                                        <input type="checkbox" id="check4" class="check" name="thu" value="4" {if $days.thu eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check4">{$translate.thu}</label>
                                        <input type="checkbox" id="check5" class="check" name="fri" value="5"  {if $days.fri eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check5">{$translate.fri}</label>
                                        <input type="checkbox" id="check6" class="check" name="sat" value="6"  {if $days.sat eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check6">{$translate.sat}</label>
                                        <input type="checkbox" id="check7" class="check" name="sun" value="7"  {if $days.sun eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check7">{$translate.sun}</label>
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary">{$translate.oncall_salary}</label>
                                    <div style="margin: 0px;" class="input-prepend date  span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary" id="salary" type="text" class="form-control span11" value="{$timing.amount}" onchange="markChange()"/>
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_call_training">{$translate.call_training_salary}</label>
                                    <div style="margin: 0px;" class="input-prepend date  span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_call_training" id="salary_call_training" type="text" class="form-control span11" value="{$timing.sal_call_training}" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_complimentary_oncall">{$translate.complimentary_oncall_salary}</label>
                                    <div style="margin: 0px;" class="input-prepend date span12" > <span class="add-on icon-pencil"></span>
                                        <input name="salary_complimentary_oncall" class="form-control span11" id="salary_complimentary_oncall" type="text" value="{$timing.sal_complementary_oncall}" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_more_oncall">{$translate.more_oncall_salary}</label>
                                    <div style="margin: 0px;" class="input-prepend date span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_more_oncall" id="salary_more_oncall" type="text"  class="form-control span11" value="{$timing.sal_more_oncall}" />
                                    </div>
                                </div>

                                <div style="margin: 10px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="salary_dismissal_oncall">{$translate.work_for_dismissal_oncall}</label>
                                    <div style="margin: 0px;" class="input-prepend date span12"> <span class="add-on icon-pencil"></span>
                                        <input name="salary_dismissal_oncall" id="salary_dismissal_oncall" type="text"  class="form-control span11" value="{$timing.sal_dismissal_oncall}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                </div>
                <div class="row-fluid">
                    <div class="span12"></div>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}