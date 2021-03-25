{block name='style'}
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
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
        $(".btn-addequipment").click(function() {
            $('.addnew-equipment').addClass('addnew-skill-visible');
            $('.addnew-equipment').removeClass('addnew-equipment');
            $(".main-left").css('width', '66%');
            $(".main-right").css('width', '32%');
            $(".main-right").css('display', 'block');
            $('#method').val('add');
        });
        $(".btn-cancel-addequipment, .btn-addnew-equipment").click(function() {
            $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            $('.addnew-skill-visible').addClass('addnew-equipment');
            $(".main-left").css('width', '99%');
            $(".main-right").css('display', 'none');
        });
        function popup(url) {
            var dialog_box_new = $("#issue_popup");
            dialog_box_new.load(url);
            dialog_box_new.dialog({
                title: '{$translate.add}',
                position: 'top',
                modal: true,
                resizable: false,
                minWidth: 10
            });
            return false;
        }
        function popup_edit(id, username, equipment, serial_number, issue_date, return_date) {
        
            $('.addnew-equipment').addClass('addnew-skill-visible');
            $('.addnew-equipment').removeClass('addnew-equipment');
            $(".main-left").css('width', '66%');
            $(".main-right").css('width', '32%');
            $(".main-right").css('display', 'block');
            $('#id_equipment').val(id);
            $('#username').val(username);
            $('#equipment_names').val(equipment);
            $('#equipment_nums').val(serial_number);
            $('#issued_dates').val(issue_date);
            $('#returned_dates').val(return_date);
            $('#method').val('edit');
        }
        function print_data(username) {
            var year_txt = $("#cmb_year option:selected").text();
            var year = $("#year option:selected").val();
            var month_t = $("#cmb_month option:selected").text();
            var month = document.getElementById('cmb_month').value;

            if (!Date.now) {
                Date.now = function() { return new Date().getTime(); }
            }
            
            window.open("{$url_path}pdf_customer_equipment.php?username=" + username + "&year=" + year_txt + "&month=" + month + "&month_txt=" + month_t+'&_'+Date.now());
            
            /*var obj = document.getElementById('form1');
            obj.action = "{$url_path}pdf_customer_equipment.php?username=" + username + "&year=" + year_txt + "&month=" + month + "&month_txt=" + month_t;
            obj.submit();*/
        }

        function backForm() {
            //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
            window.history.back();
        }
        function paginateDisplay(page, method) {
            var year = $("#cmb_year").val();
            var month = $("#cmb_month").val();
            $("#pages").load('{$url_path}ajax_equipment_pages?customer={$customer_detail.username}&year=' + year + '&month=' + month + '&page=' + page + '&method=' + method);
            $('.equipment').load('{$url_path}ajax_equipment_list?customer={$customer_detail.username}&year=' + year + '&month=' + month + '&page=' + page + '&method=' + method);

        }
       /*$(function() {
		$( "#issued_dates, #returned_dates" ).datepicker({
		showOn: "button",
                dateFormat: "yy-mm-dd",
		buttonImage: "{$url_path}images/date_pic.gif",
		buttonImageOnly: true
		});
	});*/
         $(function() {
		var availableTags1 = [
			{assign i 0}{foreach from=$equipments item=itemss}
                     "{$itemss.equipment}",       
                    {/foreach}
                        ""
                                
                            
		];
                var availableTags2 = [
			{assign i 0}{foreach from=$serial_numbers item=serial_number}
                     "{$serial_number.serial_number}",       
                    {/foreach}
                        ""
                                
                            
		];
                
		$( "#equipment_names" ).autocomplete({
			source: availableTags1,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_names").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                $( "#equipment_nums" ).autocomplete({
			source: availableTags2,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val1").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val1").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_nums").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                   
	});
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
                            submitForm()
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

   
function submitForm(){
    var errors = 0;
    if($("#equipment_names").val() == "" || $("#equipment_names").val() == null){
        $("#equipment_names").addClass("error");
        errors = 1;
    }else{
        $("#equipment_names").removeClass("error");
    }
    if($("#equipment_nums").val() == "" || $("#equipment_nums").val() == null){
        $("#equipment_nums").addClass("error");
        errors = 1;
    }else{
        $("#equipment_nums").removeClass("error");
    }
    if($("#issued_dates").val() == "" || $("#issued_dates").val() == null){
        $("#issued_dates").addClass("error");
        errors = 1;
    }else{
        $("#issued_dates").removeClass("error");
    }
    if($("#returned_dates").val() != ""){
        if($("#issued_dates").val() > $("#returned_dates").val()){
            alert("{$translate.return_date_greater}");
            $("#returned_dates").addClass("error");
            errors = 1;
        }
    }else{
        $("#returned_dates").removeClass("error");
    }
    
    if(errors == 0){
      $("#forms").submit();
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
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.customer}</h1>
                                    </div>
                                        <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="print_data('{$customer_detail.username}')"><span class="icon-print"></span> {$translate.print}</button>
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm();"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                            <button class="btn btn-default btn-normal pull-right btn-addequipment" type="button"><span class="icon-plus"></span> {$translate.add_new} {$translate.equipment}</button>
                                        </div>
                                </div>
                            </div>
                            <div class="tab-content-con boxscroll">
                                  <div class="tab-content span12" style="margin:0;">
                                         <div role="tabpanel" class="tab-pane active" id="tab-8">
                                <form style ="float: left; width:100%;" id="form1" name="form1" action="{$url_path}customer/equipment/{$customer_detail.username}/" method="post" >
                                <div style="margin-left: 0px;" class="span12">
                                            <div class="span12">
                                                <div class="widget" style="margin-top:0;">
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group">
                                                        <div class="span12">
                                                            <div class="span12">
                                                                <div class="span12">
                                                                    <div class="widget" style="margin: 0px 0px 15px ! important;">
                                                                        <!--WIDGET BODY BEGIN-->
                                                                        <div class="span12 widget-body-section input-group">
                                                                            <div class="span12">
                                                                                <div class="span3" style="margin: 0px;">
                                                                                    <label class="span12" style="float: left;" for="year">{$translate.year}</label>
                                                                                    <div style="float: left; margin: 0px ! important;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                        <select class="form-control span11" id="cmb_year" name="year">
                                                                                            <option value="" >{$translate.select_year}</option>
                                                                                            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="span3" style="margin: 0px;">
                                                                                    <label class="span12" style="float: left;" for="month">{$translate.month}</label>
                                                                                    <div style="float: left; margin: 0px;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                        <select class="form-control span11" id="cmb_month" name="month">
                                                                                            <option value="" >{$translate.select_month}</option>
                                                                                            {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin: 15px 0px 0px;" class="span4">
                                                                                    <button class="btn btn-default pull-left" style="text-align: center;" type="submit" name="detail" value="{$translate.show}">{$translate.show}</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div class="span12">
                                                                    <div class="widget" style="margin-top:0;">
                                                                        <div class="span12 widget-body-section input-group">
                                                                       
                                                                              <div class="table-responsive">
                                                                                <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin-bottom: 0px; top: 0px;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>{$translate.equipment}</th>
                                                                                            <th>{$translate.serial_number}</th>
                                                                                            <th>{$translate.issue_date}</th>
                                                                                            <th>{$translate.return_date}</th>
                                                                                                {if $equipments}
                                                                                                <th class="table-col-center small-col"></th>
                                                                                                {/if}
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        {foreach from=$equipments item=equipment}
                                                                                            <tr class="gradeX">
                                                                                                <td class="large-col">{$equipment.equipment}</td>
                                                                                                <td>{$equipment.serial_number}</td>
                                                                                                <td>{$equipment.issue_date}</td>
                                                                                                <td>{$equipment.return_date}</td>
                                                                                                <td class="table-col-center small-col">
                                                                                                    <button type="button" class="btn btn-default btn-Utrustning" onclick="popup_edit('{$equipment.id}','{$customer_detail.username}','{$equipment.equipment}','{$equipment.serial_number}','{$equipment.issue_date}','{$equipment.return_date}')"><span class="icon-wrench"></span></button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        {foreachelse}	
                                                                                            <tr class="gradeX"><td style="color:#F00;" colspan="5">{$translate.no_data}</td></tr>
                                                                                            {/foreach}
                                                                                    </tbody>
                                                                                </table>
                                                              
                                                                             </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label style="margin-bottom:10px !important;" for="exampleInputEmail1"> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span4 main-right" style="margin: 20px 0px 0px 5px; padding: 10px; display: block; width: 32%;">
                <div class="row-fluid">
                    <div class="span12 addnew-equipment" style="margin-left: 0px;">
                        <div style="margin: 0px ! important;" class="widget">
                            <form name="forms" id="forms" method="post" enctype="multipart/form-data" action="{$url_path}customer_equipment_issue_popup.php">
                                <input type="hidden" name="username" id="username" value="{$customer_detail.username}" />
                                <input type="hidden" name="hiden_val" id="hiden_val" value="" />
                                <input type="hidden" name="hiden_val1" id="hiden_val1" value="" />
                                <input type="hidden" name="method" id="method" />
                                <div style="" class="widget-header span12">
                                    <div class="span5 day-slot-wrpr-header-left span6">
                                        <h1 style="">{$translate.equipment}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal span4 pull-right btn-addnew-skill" style="" type="button" onclick="submitForm()">{$translate.save}</button>
                                        <button class="btn btn-default btn-normal span4 pull-right btn-cancel-addequipment" style="" type="button">{$translate.cancel}</button>
                                    </div>
                                </div>
                                <!--WIDGET BODY BEGIN-->

                                <div class="span12 widget-body-section input-group email-list-box">
                                    <div class="row-fluid">
                                        <div id="form_err" class="form_error span12 no-min-height"></div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="equipment_names">{$translate.name}</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span11" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" type="text" name="equipment_names" id="equipment_names" class="clear required" {if $names != ""} value="{$names}" {else} value="" {/if} /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="equipment_nums">{$translate.serial_number}</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span11" type="text" name="equipment_nums" id="equipment_nums" class="clear required"  {if $serials != ""} value="{$serials}" {else} value="" {/if} /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="issued_dates">{$translate.issue_date}</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                <input class="form-control span9" type="text" name="issued_dates" id="issued_dates" class="clear required issued_date" {if $issues != ""} value="{$issues}" {else} value="" {/if} /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="returned_dates">{$translate.return_date}</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                <input class="form-control span9" type="text" name="returned_dates" id="returned_dates" class="clear returned_date"  {if $returns != ""} value="{$returns}" {else} value="" {/if} /> 
                                            </div>
                                            <input type="hidden" name="id_equipment" id="id_equipment" class="clear returned_date"  {if $ids != ""} value="{$ids}" {else} value="" {/if} />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {else}
      <div class="fail">{$translate.permission_denied}</div>      
    {/if}
{/block}
