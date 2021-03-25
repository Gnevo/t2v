{block name='style'}
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-254});
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
    

});
</script>
<script language="javascript">
            var change = 0; 
            $(document).ready(function () { 
                $(".side_links li a").click(function(event){
                event.preventDefault();
                var href_val = $(this).attr('href');
                if(change == 1){
                    $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                            "{$translate.yes}": function() {
                                    $( this ).dialog( "close" );
                                    saveForm();
                                },
                                "{$translate.no}": function() {
                                        $( this ).dialog( "close" );
                                        document.location.href = href_val;
                                }
                            }
                    });
                }
                else{
                    document.location.href = href_val;
                }
             });
             
            /*$( "#fromdate, #todate" ).datepicker({
                showOn: "button",
                dateFormat: "yy-mm-dd",
                buttonImage: "{$url_path}images/date_pic.gif",
                buttonImageOnly: true
            });*/
            $(".datepicker").datepicker({
                    autoclose: true,
                    weekStart: 1,
                    calendarWeeks: true, 
                    language: '{$lang}'
            });
  
               
            });
           
function markchange(){
    change = 1;
    $("#new").val("1");
}
function attachAnother() {
    markchange();
    var file_count = parseInt($('#file_count').val()) + 1;
    $('#file_count').val(file_count);
    $('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' /></div>");
}
function removeFile(id){
    markchange();
    var id = $('#file_count').val();
    var file_count = parseInt(id) - 1;
    $('#file_count').val(file_count);
    $('div').remove('.file_attach_row' + id);
}
function calculate(username) {
    markchange();
    var hours = $('#bidrag').val();
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    
    //wrapLoader('div#houres');
{*    $("#houres").load("{$url_path}ajax_customer_contract_hours.php?hours=" + hours + "&sdate=" + date_from + "&edate=" + to_date + "&customer=" + username + "&fkkn={$fkkn}", function(response, status, xhr){ uwrapLoader('div#houres'); });*}
    $("#houres").load("{$url_path}ajax_customer_contract_hours.php?hours=" + hours + "&sdate=" + date_from + "&edate=" + to_date + "&customer=" + username + "&fkkn={$fkkn}");
    
}
function checkDates(){
    var check_date = "";
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    var user = $("#username").val();
    var hours = $('#bidrag').val();
    //var user_id = $("#user_id").val();
    if(hrs != "" & date_from != "" & date_to != "")
    {
        $.ajax({
            async:false,
            url:"{$url_path}ajax_cust_contract_check_date.php",
            data:"date_from="+date_from+"&date_to="+to_date+"&hrs="+hours+"&user="+user,
            type:"POST",
            success:function(data){
                check_date = data;
                if(data != "")
                {
                    $("#err_msg").html(data);
                    $("#err_msg").addClass("message");
                }
                else
                {
                    $("#err_msg").html("");
                    $("#err_msg").removeClass("message");
                }                        
            }
        });
                //alert(check_date);
        if(check_date != "")
            return false
        else return true;
    }
}

function saveForm() {
    var error = 0;
    
    $('#action').val('save');
    if($("#bidrag").val() == ""){
       
        $("#bidrag").addClass("error"); 
        error = 1;
        
    }else{
        $("#bidrag").removeClass("error"); 
    }
    if($("#fromdate").val() == ""){
        $("#fromdate").addClass("error");
        error = 1;
    }else{
        $("#fromdate").removeClass("error"); 
    }
    if($("#todate").val() == ""){
       $("#todate").addClass("error");
       error = 1;
    }else{
        $("#todate").removeClass("error"); 
    }
    {if $fkkn == "kn"  || $fkkn == 'te'}
    
        if($("#name").val() == ""){
            $("#name").addClass("error");
            error = 1;
        }else{
            $("#name").removeClass("error");
        }
        
        if($("#breference_no").val() == ""){
            $("#breference_no").addClass("error");
            error = 1;
        }else{
            $("#breference_no").removeClass("error");
        }
        if($("#kn_postno").val() == ""){
           $("#kn_postno").addClass("error");
           error = 1;
        }else{
            var postno = $("#kn_postno").val();
            if(isNaN(postno)){
                $("#kn_postno").addClass("error");
                $("#error1").html('{$translate.give_numeric_value}');
            }else if(postno.length != 5){
                $("#kn_postno").addClass("error");
                $("#error1").html('{$translate.give_five_numeric_characters}');
            }else{
                $("#kn_postno").removeClass("error");
                $("#error1").html('');
            }
        }
        if($("#bocity").val() == ""){
            $("#bocity").addClass("error");
            error = 1;
        }else{
            $("#bocity").removeClass("error");
        }
        if($("#bbox").val() == '' && $("#address_kn").val() == ""){ 
            $("#bbox").addClass("error");
            $("#address_kn").addClass("error");
           error = 1;
        }else{
             $("#bbox").removeClass("error");
             $("#address_kn").removeClass("error");
        }
    {/if}

    if($("#bidrag").val() != "" && $("#fromdate").val() != "" && $("#ftodate").val() != "" && error == 0) {    
        $('#form').submit();
    }
}
function selectDate() {
   $('#action').val('dates');
   $('#form').submit();
}

function print_data(username,fkkn){
    var date=document.getElementById('date').value;
    
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open("{$url_path}pdf_customer_insurance.php?username="+username+"&fkkn="+fkkn+"&date="+date+'&_'+Date.now());
 }

function docRemove(docs) { 
    markchange()
    var old_docs = $('#tdocs').val();
    var del_file = $('#delfile').val();
    
    var doc_array = old_docs.split(",");
    for(var i=0; i < doc_array.length; i++) {
        if(doc_array[i] == docs) {
            doc_array.splice(i, 1);
            break;
        }
    }
    var new_array = doc_array.toString();
    $('#tdocs').val(new_array);
    
    wrapLoader('#file_list');
    $("#file_list").load('{$url_path}ajax_customer_attatchments_insurence.php?docs='+ new_array, function(){ uwrapLoader('#file_list');});
}
            
function addLog(val,old) {
                if(val.value != old)
                {
                    markchange();
                    var tmp = document.getElementById("log_field").value.split(val.name);
                    if(tmp[1] == "" || tmp[1] == undefined)
                    {
                        document.getElementById("log_old").value = document.getElementById("log_old").value + old + ";";
                        document.getElementById("log_field").value = document.getElementById("log_field").value + val.name + ";";
    }
                }
            }
function resetForm() {
    $('#action').val('');
    $('#form').submit();
}
function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}
function addNew() {
    document.location.href = "{$url_path}customer/insurance/{$fkkn}/{$customer_detail.username}/new/";
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        var new_var = $("#new").val();
        if(new_var == "new" || change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
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



function downloadFile(filename){
    document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
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
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()"><span class="icon-save"></span> {$translate.save}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data('{$customer_username}','{$fkkn}')"><span class="icon-print"></span> {$translate.print}</button>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="2">
                                    <form name="form" id="form" method="post" enctype="multipart/form-data" action="{$url_path}customer/insurance/{$fkkn}/{$customer_detail.username}/" style="float:left;">
                                    <input type="hidden" name="username" id="username" value="{$customer_username}" />
                                    <input type="hidden" name="tdocs" id="tdocs" value="{$documents_string}" />
                                    <input type="hidden" name="delfile" id="delfile" value="" />
                                    <input type="hidden" name="file_count" id="file_count" value="1"/>
                                    <input type="hidden" name="new" id="new" value="{$new}"/>
                                    <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                   <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                <div class="span12"><div style="margin: 0px ! important;" class="widget-header span12">
                                                        <div class="pull-left">
                                                            <h1>{$translate.edit_existing_data}</h1>
                                                        </div>
                                                        <div style="padding: 5px;" class="pull-right">
                                                            <button class="btn btn-default btn-normal pull-right" name="add" id="add" value="{$translate.add_new} {if $fkkn == 'fk'}{$translate.insurance}{elseif $fkkn == 'kn'}{$translate.municipality}{elseif $fkkn == 'te'}{$translate.insurance_te}{/if}" type="button" onclick="addNew()">{$translate.add_new} {if $fkkn == 'fk'}{$translate.insurance}{elseif $fkkn == 'kn'}{$translate.municipality}{elseif $fkkn == 'te'}{$translate.insurance_te}{/if}</button>
                                                        </div>
                                                        <div class="pull-right" style="padding: 8px; margin: 0px ! important;">
                                                            <div class="input-prepend pull-right" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                <select class="form-control" id="date" name="date" onchange="selectDate()">
                                                                    <option value="">{$translate.select}</option>
                                                                    {foreach from=$periods item=period}
                                                                        <option value="{$period.id}" {if $contract_id == $period.id} selected="selected" {/if}>{$period.date_from} - {$period.date_to}</option>
                                                                    {/foreach}
                                                                </select>
                                                                <input type="hidden" name="action" id="action" value=""/>
                                                            </div>
                                                        </div>
                                                       
                                                       
                                                {if $fkkn == 'kn' || $fkkn == 'te'}
                                                <ol class="radio-group pull-left" style="margin:5px !important;">
                                                <li>   <input  type="checkbox" name="iss" id="iss" value="1" {if $contract_details[0].iss == 1} checked="checked" {/if} />
                                                <label class="label-option-and-checkbox">LSS</label></li>
                                                <li>  <input  type="checkbox" name="sol" id="sol" value="1" {if $contract_details[0].sol == 1} checked="checked" {/if} />
                                               <label class="label-option-and-checkbox">SOL</label>
                                                </li>
                                                </ol>
                                                {/if}
</div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="widget input-group" style="margin: 0px ! important;">
                                                            <div class="span12 widget-body-section">
                                                                <div style="" class="row-fluid">
                                                                    <div class="span4">
                                                                        <div style="margin: 0px;" class="row-fluid">
                                                                            <div id="decision" class="widget header-margin-set" style="margin: 0px 0px 15px ! important;">
                                                                                <div class="widget-header span12">
                                                                                    <h1>{$translate.administrator_decision}</h1>
                                                                                </div>
                                                                                <div class="span12 widget-body-section input-group">
                                                                                    <div class="row-fluid">
                                                                                        <div class="span6">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dofname">{$translate.first_name}*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dofname" id="dofname" value="{$contract_details[0].first}" onblur="addLog(this,'{$contract_details[0].first}')" onchange="markchange()" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dolname">{$translate.last_name}*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dolname" id="dolname" value="{$contract_details[0].last}" onblur="addLog(this,'{$contract_details[0].last}')" onchange="markchange()" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="dophone">{$translate.mobile}</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="dophone" id="dophone" value="{$contract_details[0].mob}" onblur="addLog(this,'{$contract_details[0].mob}')" onchange="markchange()" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="doemail">{$translate.email}</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="email" name="doemail" id="doemail" value="{$contract_details[0].mail}" onblur="addLog(this, '{$contract_details[0].mail}')" onchange="markchange()" /> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="span6">
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="docity">{$translate.location}</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="docity" id="docity" value="{$contract_details[0].cities}" onblur="addLog(this, '{$contract_details[0].cities}')" onchange="markchange()" /> </div>
                                                                                            </div>
                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="bidrag">{$translate.granded_hours}*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                    <input class="form-control span10" type="text" name="bidrag" id="bidrag" value="{$contract_details[0].hour}" onchange="calculate('{$customer_detail.username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this, '{$contract_details[0].hour}')" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.date_from}*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                                    <input class="form-control span10"  name="fromdate" type="text" class="date_pick_input" id="fromdate" value="{$contract_details[0].date_from}" onchange="calculate('{$customer_detail.username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this, '{$contract_details[0].date_from}')" /> </div>
                                                                                            </div>

                                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.date_to}*</label>
                                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                                    <input class="form-control span10" name="todate" type="text" class="date_pick_input" id="todate" value="{$contract_details[0].date_to}" onchange="calculate('{$customer_detail.username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this, '{$contract_details[0].date_to}')" /> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span3">
                                                                        <div style="" class="widget-header span12">
                                                                            <h1>{$translate.decision_authorization_agreement}</h1>
                                                                        </div>
                                                                        <ul id="file_list" class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                                            {foreach from=$documents item=document}
                                                                                <li class="list-group-item">
                                                                                    <a id="lic_1"  href="javascript:void(0)" onclick="downloadFile('{$document.file}')">{$document.name}</a>
                                                                                    <a href="javascript:void(0);"  onclick="docRemove('{$document.file}')" title="{$translate.delete_file}"><i class="icon-trash"></i></a>
                                                                                </li>
                                                                            {foreachelse}
                                                                                <li class="list-group-item"><span class="message">{$translate.there_are_no_files}</span></li>
                                                                            {/foreach}
                                                                        </ul>
                                                                        <div style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file span12 trusteeship_file_attach">
                                                                            <input type="hidden" name="log_field" id="log_field" value=""/>
                                                                            <input type="hidden" name="log_old" id="log_old" value=""/>
                                                                            <div id="file_attach" class="file_attach_row">
                                                                               <input type="file" name="file_1" id="file_1" size="12" onchange="markchange()"/>
                                                                            </div>
                                                                            <div class="row-fluid" style="margin:10px 0 0 0 !important">
                                                                                <div class="pull-left">
                                                                                    <label><a href='javascript:void(0);' title="{$translate.delete}" onclick='removeFile()' class="btn btn-danger span12"><i class="icon-trash"></i></a></label>
                                                                                </div>
                                                                                <div class="pull-left">
                                                                                    <label><a href="javascript:void(0);" title="{$translate.upload_new_file}" onclick="attachAnother()" class="btn btn-success span12"><i class="icon-plus"></i></a></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span5">
                                                                        {if $fkkn == 'kn'  || $fkkn == 'te'}
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin-top:0;">
                                                                                    <div class="widget-header span12">
                                                                                        <h1>{$translate.kn_form_administrator_behalf}</h1>
                                                                                    </div>
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <div class="row-fluid">
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="name">{$translate.kn_form_name}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="name" id="name" {if $contract_details[0].kn_name != '' } value="{$contract_details[0].kn_name}" {else} value="{$customer_kn_details.kn_name}" {/if} onblur="addLog(this, '{$contract_details[0].kn_name}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bbox">{$translate.kn_box}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12" > <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bbox" id="bbox" {if $contract_details[0].kn_box != '' } value="{$contract_details[0].kn_box}" {else} value="{$customer_kn_details.kn_box}" {/if} onblur="addLog(this, '{$contract_details[0].kn_box}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="kn_postno">{$translate.kn_form_postno}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="kn_postno" id="kn_postno" {if $contract_details[0].kn_postno != '' } value="{$contract_details[0].kn_postno}" {else} value="{$customer_kn_details.kn_postno}" {/if} onblur="addLog(this, '{$contract_details[0].kn_postno}')" onchange="markchange()" maxlength="5" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="breference_no">{$translate.kn_form_reference_no}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="breference_no" id="breference_no" {if $contract_details[0].kn_reference_no != '' } value="{$contract_details[0].kn_reference_no}" {else} value="{$customer_kn_details.kn_reference_no}" {/if} onblur="addLog(this, '{$contract_details[0].kn_reference_no}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="address_kn">{$translate.kn_form_address}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="address_kn" id="address_kn" {if $contract_details[0].kn_address != '' } value="{$contract_details[0].kn_address}" {else} value="{$customer_kn_details.kn_address}" {/if} onblur="addLog(this, '{$contract_details[0].kn_address}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bocity">{$translate.kn_form_city}*</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bocity" id="bocity" {if $contract_details[0].kn_city eq '' } value="{$contract_details[0].city}" {else} value="{$customer_kn_details.kn_city}" {/if} onblur="addLog(this, '{$contract_details[0].city}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style="margin: 10px 0px;" class="widget-header span12">
                                                                                            <h1>{$translate.night}</h1>
                                                                                        </div>
                                                                                        <input class="check-box" type="checkbox" name="oncall" id="oncall" value="1" {if $contract_details[0].oncall == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].oncall}')" /><span style="margin-left: 5px;">{$translate.emergency}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="awake" id="awake" value="1" {if $contract_details[0].awake == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].awake}')" /><span style="margin-left: 5px;">{$translate.alert}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="oncall2" id="oncall2" value="1" {if $contract_details[0].oncall2 == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].oncall2}')" /><span style="margin-left: 5px;">{$translate.preparedness}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="something" id="something" value="1" {if $contract_details[0].something == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].something}')" /><span style="margin-left: 5px;">{$translate.other}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        {else}
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin-top:0;">
                                                                                    <div class="widget-header span12">
                                                                                        <h1>{$translate.administrator_behalf}</h1>
                                                                                    </div>
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <div class="row-fluid">
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bofname">{$translate.first_name}</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="bofname" id="bofname" value="{$contract_details[0].first_name}" onblur="addLog(this, '{$contract_details[0].first_name}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bophone">{$translate.mobile}</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bophone" id="bophone" value="{$contract_details[0].mobile}" onblur="addLog(this, '{$contract_details[0].mobile}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bocity">{$translate.location}</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bocity" id="bocity" value="{$contract_details[0].city}" onblur="addLog(this, '{$contract_details[0].city}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="span6">
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="bolname">{$translate.last_name}</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10" type="text" name="bolname" id="bolname" value="{$contract_details[0].last_name}" onblur="addLog(this, '{$contract_details[0].last_name}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                                    <label style="float: left;" class="span12" for="boemail">{$translate.email}</label>
                                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                        <input class="form-control span10"  type="text" name="boemail" id="boemail" value="{$contract_details[0].email}" onblur="addLog(this, '{$contract_details[0].email}')" onchange="markchange()" /> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style="margin: 10px 0px;" class="widget-header span12">
                                                                                            <h1>{$translate.night}</h1>
                                                                                        </div>
                                                                                        <input class="check-box" type="checkbox" name="oncall" id="oncall" value="1" {if $contract_details[0].oncall == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].oncall}')" /><span style="margin-left: 5px;">{$translate.emergency}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="awake" id="awake" value="1" {if $contract_details[0].awake == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].awake}')" /><span style="margin-left: 5px;">{$translate.alert}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="oncall2" id="oncall2" value="1" {if $contract_details[0].oncall2 == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].oncall2}')" /><span style="margin-left: 5px;">{$translate.preparedness}</span>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="something" id="something" value="1" {if $contract_details[0].something == "1"} checked="checked" {/if} onclick="addLog(this, '{$contract_details[0].something}')" /><span style="margin-left: 5px;">{$translate.other}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="row-fluid">
                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                                                                    <div id="houres" style="background: none repeat scroll 0% 0% rgb(255, 255, 226); border: 1px solid rgb(246, 246, 171);" class="span12 widget-body-section">
                                                                                        <ul class="time-date-info">
                                                                                            <li>
                                                                                                {$translate.days}
                                                                                                <div class="pull-right">{$no_of_days}</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                {$translate.monthly}
                                                                                                <div class="pull-right">{$monthly_hrs}</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                {$translate.weekly}
                                                                                                <div class="pull-right">{$weekly_hrs}</div>
                                                                                            </li>
                                                                                            <li>
                                                                                                {$translate.granded_hours}
                                                                                                <div class="pull-right">{$hrs}</div>
                                                                                            </li>

                                                                                            <li>
                                                                                                {$translate.remaining_hours}
                                                                                                <div class="pull-right" {if $remaining_hrs < 0}style="color: red;"{/if}>{$remaining_hrs}</div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin-left: 0px;" class="span12">
                                                                            <div class="span12">
                                                                                <div class="widget" style="margin: 0px ! important;">
                                                                                    <!--WIDGET BODY BEGIN-->
                                                                                    <div class="span12 widget-body-section input-group">
                                                                                        <label style="margin-left: 0px;" class="span12" for="comhours">{$translate.comment_decision_hour}</label>
                                                                                        <textarea rows="1" class="form-control span12" name="comhours" id="comhours" onblur="addLog(this, '{$contract_details[0].comments_time}')" onchange="markchange()">{$contract_details[0].comments_time}</textarea>

                                                                                        <label style="margin-left: 0px;" class="span12" for="comdecision">{$translate.comment_decision_management_others}</label>
                                                                                        <textarea rows="1" class="form-control span12" name="comdecision" id="comdecision" onblur="addLog(this, '{$contract_details[0].comments_other}')" onchange="markchange()">{$contract_details[0].comments_other}</textarea>
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
                                        </div>
                                    </div>
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