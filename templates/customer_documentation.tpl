{block name='style'}
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery-ui-timepicker-addon.css"/>*}
    <link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/summernote.css" />{*wysiwyg*}
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/codemirror.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/blackboard.min.css" />
    <link rel="stylesheet" href="{$url_path}js/plugins/wysiwyg/css/monokai.min.css" />
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
    .btn-toolbar .colour_strip{
        width: 50px; height: 20px;
    }
    .note_block_head {
        background-color: #D8E0F0;
        border-color: #DBD8F0;
        color: #7C4688;
        margin-bottom: 1px;
        padding: 9px 3px;
    }
</style>
{/block}
{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
{*<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>*}
{*<script type="text/javascript" src="{$url_path}js/jquery-ui-timepicker-addon.js"></script>*}
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="{$url_path}js/plugins/forms/jquery-validation/dist/additional-methods.min.js"></script>
<script src="{$url_path}js/demo/form_validator.js"></script>
{*<script src="{$url_path}js/jquery.hotkeys.js"></script>*}
{*<script src="{$url_path}js/bootstrap-wysiwyg.js"></script>*}

<!-- include libraries BS3 -->
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
<script src="{$url_path}js/plugins/wysiwyg/codemirror.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/xml.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/formatting.min.js"></script>
<script src="{$url_path}js/plugins/wysiwyg/summernote.js"></script>
<script type="text/javascript">
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
    
    $('#date_created, #date_last').datetimepicker({
        format: "yyyy-mm-dd  hh:ii:ss",
        autoclose: true,
        todayBtn: true/*,
        startDate: "2013-02-14 10:00",
        pickerPosition: "bottom-left"*/

    }); 
    var now = new Date();
    /*$('#date_created, #date_last').datetimepicker($.extend($.timepicker.regional["{$lang}"],{
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm:ss',
            hour:   now.getHours(),
            minute: now.getMinutes(),
            second: now.getSeconds(), 
            showOn: "button",                    
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true,
            regional: '{$lang}'
    }));*/
    
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
<script type="text/javascript">
    
var hides = 0;
var hide = 0;
var change_var = 0; 

$(document).ready(function() {
    
        $('.success, .message, .fail, .error').delay(10000).fadeOut();

        $("#search_element").hide();
                
        if($("#date_created").val() =='')$("#date_created").datetimepicker('setDate', new Date($.now()));  
        //if($("#date_created").val() == '') $("#date_created").datetimepicker('setDate', new Date('{date('Y-m-d H:i:s')}'));     
            
            $(".toggme").hide(400);
            $("#date_created").removeClass("required");
            $("#priority").removeClass("required");
            hide = 1;
            hides = 1;
            $("#kunder").validate({
                    rules: {
                            subject: {
                                    required: true
                            },
                            employed: {
                                    required: true
                            },
                            notes: {
                                    required: true
                            }
                    }
            });
        
     {if $data.created_date == ""}
        $(".toggme").hide();
        hide = 1;
      {/if}
          
    });
    
    function load_documentation()
    {
            var date_ids = $("#date").val();
            if(date_ids != ''){
                if(date_ids == "0"){
                    document.location.href = "{$url_path}customer/documentation/"+$('#person_num').val()+"//get/m2/";

                }else{
                    document.location.href = "{$url_path}customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/";
                }
            }else{
                new_docs();
            }
            
               
        //document.location.href = "{$url_path}customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/";
    }
    
    function new_docs()
    {
        document.location.href = "{$url_path}customer/documentation/{$customer_detail.username}/new/";
    }
    
    function toggle_form()
    {
        $(".action-list-wrpr").toggle();
    }
    function saveForm()
    {   
        if($("#subject").val() != "" || $("#employed").val() != "" || $.trim($("#notes").val()) != "" || $("#more_note").val() != ""){
            //$("#form").attr('target','self').submit();
            $("#form").submit();
        }else{

            alert("Data Not Found");
        }
    }
        
    function resetForm() {
        
        //var loc = "{$url_path}customer/documentation/{$customer_detail.username}/new/";
        document.location.reload();
    }
    function backForm() {
            //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
            window.history.back();
        }
    function validate() {
         if($("#date_created").val() > $("#date_last").val())
         {
             $(".form_err").show();
             $("#form_err").html("&nbsp;&nbsp;&nbsp;Datum slutf�rt skall vara st�rre eller lika med Datum skapat");
            return false;
         }
    }
        function toggles_form() {
        $(".search-implimentation-wrpr").toggle();
    }   
        function get_search(){
            var search_radio = $('input:radio[name=radio_search]:checked').val();
            var month = $("#search_element_month").val();
            var year = $("#search_element_year").val();
            var search_text = $("#search_element_search").val();
            var dates_from = $("#search_element_fromdate").val();
            var dates_to = $("#search_element_todate").val();
            var username = '{$customer_detail.username}';
            window.open("{$url_path}customer_documentation_print.php?search_val="+search_radio+"&month="+month+"&year="+year+"&date_from="+dates_from+"&date_to="+dates_to+"&username="+username+"&search_text="+search_text+"&type={$documentation_type}","_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=800, height=440");

        }
        
function print_data(username){
    var dt=$("#date option:selected").text();    
    var date=$("#date option:selected").val();    
    
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open("{$url_path}pdf_customer_documentation.php?username="+username+"&date="+dt+"&date_id="+date+'&_'+Date.now());
    /*var obj=document.getElementById('form');
    obj.target = '_blank';
    obj.action="{$url_path}pdf_customer_documentation.php?username="+username+"&date="+dt+"&date_id="+date;
    obj.submit();*/
}
 
function display_bydate(){
    $("#search_by_date").show();
    $("#search_by_month").hide();
}

function display_bymonth(){
    $("#search_by_date").hide();
    $("#search_by_month").show();
}

function display_byall(){
    $("#search_by_date").hide();
    $("#search_by_month").hide();
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        if(change_var == "1"){
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



function makeChange(){
    change_var = 1;
}
{*function autosave() {
        {if $note_display != "yes" && $data[0].writable != 1}
    if($("#subject").val() != '' || $.trim($("#notes").val()) != '') {
                        $.ajax({
            type: 'POST',
            url: '{$url_path}/ajax_auto_save.php',
            data: {
                tab:'3',
                username:$("#username").val(),
                subject:$("#subject").val(),
                employed:$("#employed").val(),
                date_created:$("#date_created").val(),
                date_last:$("#date_last").val(),
                note_type:$('input[name=note_type]:checked').val(),
                notes:$("#notes").val(),
                priority:$("#priority").val(),
                more_notes:$("#more_note").val(),
                status:$("input[name=status]:checked").val(),
                date:$("#date").val(),
                                read_write:$("#read_write").val()
            },
            success: function(data) {
                $('.titlebar_links').show();
                $('#autosave').html(data);
            },
            error: function(data) {
                $('.titlebar_links').hide();
                $('#autosave').html('<div class="fail">{$translate.no_internet_connection}</div>');
                
            }
        });
    }
        {else}
        return false;
        {/if}
}*}

function load_document_particular(type_num){
   
    document.location.href = "{$url_path}customer/documentation/"+$('#person_num').val()+"/"+$("#date").val()+"/get/"+type_num+"/";
}

function saveLock() {
    $('#read_write').val(1);
    //alert($('#read_write').val());
    saveForm();   
}

function deleteDocumentFile() {
    $('#file_delete').val(1);
    saveForm();     
}

function attachAnother() {
    var file_count = parseInt($('#file_count').val()) + 1;
    if(file_count > 1){
        $("#remove_file").show();
    }
    $('#file_count').val(file_count);
    $('#file_attach').append("<div class='span12 no-ml file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' class='pull-left' /></div>");
}

function removeFile(id){
    var id = $('#file_count').val();
    var file_count = parseInt(id) - 1;
    if(file_count == 1){
        $("#remove_file").hide();
    }
    $('#file_count').val(file_count);
    $('div').remove('.file_attach_row' + id);
}
function docRemove(doc) {
    $( "#dialog-confirm-delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            "{$translate.yes}": function() {
                $( this ).dialog( "close" );
                var old_del = $("#del_doc").val();               
                var old_docs = $('#tdocs').val();
                var doc_array = old_docs.split(",");
                for(var i=0; i < doc_array.length; i++) {
                    if(doc_array[i] == doc) {
                        doc_array.splice(i, 1);
                        if(old_del == ""){
                            $("#del_doc").val(doc);
                        }else{
                            $("#del_doc").val(old_del+","+doc);
                        }
                        break;
                    }
                }
                var new_array = doc_array.toString();
                $('#tdocs').val(new_array);
                $('#file_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
                $("#file_list").load("{$url_path}ajax_customer_documents.php?type=customer_document&docs=" + new_array);
            },
            "{$translate.no}": function() {
                $( this ).dialog( "close" );
            }
        }
    });
}
function downloadFile(filename){
    document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
}

{*window.setInterval(autosave,60000);*}
</script>
<script type="text/javascript">
    $(function () {
        $('#notes').summernote({
            height: 70,
            tabsize: 2,
            codemirror: {
              theme: 'monokai'
            },
            defaultFontName: 'Times New Roman',
            fontNamesIgnoreCheck: ['Times New Roman'],
            lang: '{$lang}',
            toolbar: [
                //[groupname, [button list]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link',  'hr']],
                ['view', ['fullscreen', 'codeview']]
              ]
          });
        $('#more_note').summernote({
            height: 130,
            tabsize: 2,
            codemirror: {
              theme: 'monokai'
            },
            defaultFontName: 'Times New Roman',
            fontNamesIgnoreCheck: ['Times New Roman'],
            lang: '{$lang}',
            toolbar: [
                //[groupname, [button list]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link',  'hr']],
                ['view', ['fullscreen', 'codeview']]
              ]
          });
        {*if $data[0].writable} 
                console.log('Locked');
                $('#notes').attr('contenteditable', false);
        {/if*}
    });
</script>
{/block}
{block name="content"}
    {if $access_flag == 1}
        <div id="autosave"></div>
        <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>

        </div>
        <div id="dialog-confirm-delete" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.are_you_sure}</p>

        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        {$message} 
        <div class="row-fluid">
            <div style="" class="span12 main-left">
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
                                        {if !$data[0].writable}<button class="btn btn-default btn-normal pull-right ml" type="button" {if isset($new)} onclick="saveForm('newsave')" {else} onclick="saveForm('edit')" {/if}><span class="icon-save"></span> {$translate.save}</button>{/if}
                                        <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data('{$customer_detail.username}')"><span class="icon-print"></span> {$translate.print}</button>
                                        {if !$data[0].writable}<button class="btn btn-default btn-normal pull-right rm" type="button" onclick="saveLock()"><span class="icon-lock"></span> {$translate.save_lock}</button>{/if}
                                    </div>
                                </div>
                            </div>
                                
                                
                                
                            <div class="tab-content-con boxscroll1">
                            <div class="tab-content span12" style="margin:0;">
                                 <div role="tabpanel" class="tab-pane active" id="tab-7">
                                     <form name="form" id="form" method="post" enctype="multipart/form-data" action="{$url_path}customer/documentation/{$customer_detail.username}/" class="pull-left span12">
                                <input type="hidden" name="username" id="username" value="{$customer_detail.username}" />
                                <input type="hidden" name="saves" id="saves" value="{$new}" />
                                <input type="hidden" name="vals" id="vals" value="vals" />
                                <input type="hidden" name="ids" id="ids" value="{$data[0].id}" />
                                <input type="hidden" name="new" id="new" value="{$new}" />
                                <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                <input type="hidden" name="file_delete" id="file_delete" value="0" />
                                <input type="hidden" name="read_write" id="read_write" value="{$data[0].writable}" />
                                   <div style="" class="span12 widget-body-section input-group">
                                        <div class="row-fluid">
                                             <div class="span12"><div style="margin: 0px ! important;" class="widget-header span12">
                                            <div class="widget" style="margin: 0px ! important;">
                                                <!--WIDGET BODY BEGIN-->
                                                <div class="span12 widget-body-section input-group no-padding">
                                                    <div class="row-fluid">
                                                        <div style="margin: 0px ! important;" class="widget-header span12">
                                                            <div class="span3">
                                                                <h1>{$translate.edit_existing_data}</h1>
                                                            </div>
                                                            <div style="padding-top: 8px; margin: 0px ! important;" class="span3">
                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                    <select class="form-control span12" name="date" id="date" onchange="load_documentation()">
                                                                        <option value="">{$translate.select}</option>
                                                                        {foreach from=$dates item=date}
                                                                            <option  value="{$date.id}" {if $data[0].created_date == $date.created_date} selected="selected" {/if}>{$date.created_date}{if $date.subject neq ''} - {$date.subject}{/if}</option>
                                                                        {/foreach}
                                                                        {if $documentation_type == "3"}
                                                                            <option value="0" {if $msg_notes != "0"} selected="selected" {/if}>{$translate.message_centre_notes}</option>
                                                                        {/if}
                                                                    </select>
                                                                    <input name="person_num" type="hidden" id="person_num" value="{$customer_detail.username}" />
                                                                    <input name="id" type="hidden" id="id" value="{$data[0].id}"  />
                                                                </div>
                                                            </div>
                                                            <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                                                <button class="btn btn-default btn-normal pull-right" type="button" onclick="new_docs()"><span class="icon-plus"></span> {if $documentation_type == 1}{$translate.add_new_documentation}{elseif $documentation_type == 2}{$translate.add_new_protocol}{elseif $documentation_type == 3}{$translate.add_new_note_to_self}{/if}</button>
                                                                <button class="btn btn-default btn-normal pull-right" type="button" onclick="toggles_form()"><span class="icon-search"></span> {$translate.search}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="widget" style="margin: 0px ! important;">
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div style="margin: 0px 0px 15px ! important; display: none;" class="span12 widget-body-section input-group search-implimentation-wrpr">       
                                                                <div class="span12">
                                                                    <div class="span2" style="margin-top: 10px;">
                                                                        <label style="float: left;" class="span12" for="search_element">{$translate.search_element}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span9" name="search_element" type="text" id="search_element_search" value="" /> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input class="check-box" type="radio" name="radio_search" id="search_element_all" value="1" onclick="display_byall()" checked="checked" />
                                                                        <span style="margin-left: 5px;">{$translate.all}</span>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="radio" name="radio_search" id="search_element_bydate" value="3" onclick="display_bydate()" />
                                                                        <span style="margin-left: 5px;">{$translate.by_date}</span>
                                                                        <div class="search_element_col_expand" id="search_by_date" style="display: none;">
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject">{$translate.date_from}</label>
                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                    <input class="form-control span9" name="search_element" type="text" id="search_element_fromdate" value="{$today}" />
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject">{$translate.date_to}</label>
                                                                                <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                    <input class="form-control span9" name="search_element" type="text" id="search_element_todate" value="{$today}" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input style="margin-left: 10px ! important;" type="radio" name="radio_search" id="search_element_bymonth" value="2" onclick="display_bymonth()" />
                                                                        <span style="margin-left: 5px;">{$translate.by_month}</span>
                                                                        <div class="search_element_col_expand_month"  id="search_by_month" style="display: none;">
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="search_element_month">{$translate.month}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" name="search_element_month" id="search_element_month" name="month">
                                                                                        <option value="01" {if  $smarty.now|date_format:"%m" == 1} selected = "selected" {/if} >{$translate.january}</option>
                                                                                        <option value="02" {if  $smarty.now|date_format:"%m" == 2} selected = "selected" {/if}>{$translate.february}</option>
                                                                                        <option value="03" {if  $smarty.now|date_format:"%m" == 3} selected = "selected" {/if}>{$translate.march}</option>
                                                                                        <option value="04" {if  $smarty.now|date_format:"%m" == 4} selected = "selected" {/if}>{$translate.april}</option>
                                                                                        <option value="05" {if  $smarty.now|date_format:"%m" == 5} selected = "selected" {/if}>{$translate.may}</option>
                                                                                        <option value="06" {if  $smarty.now|date_format:"%m" == 6} selected = "selected" {/if}>{$translate.june}</option>
                                                                                        <option value="07" {if  $smarty.now|date_format:"%m" == 7} selected = "selected" {/if}>{$translate.july}</option>
                                                                                        <option value="08" {if  $smarty.now|date_format:"%m" == 8} selected = "selected" {/if}>{$translate.august}</option>
                                                                                        <option value="09" {if  $smarty.now|date_format:"%m" == 9} selected = "selected" {/if}>{$translate.september}</option>
                                                                                        <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.october}</option>
                                                                                        <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.november}</option>
                                                                                        <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.december}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="Search Element_year">{$translate.year}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" name="search_element_year" id="search_element_year" name="year">
                                                                                        {foreach from=$years item=year} 
                                                                                            <option value="{$year.year}">{$year.year}</option>
                                                                                        {/foreach}
                                                                                    </select>
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 23px;">
                                                                        <input class="check-box" type="radio" name="radio_search" id="search_element_mc" value="4" onclick="display_byall()" />
                                                                        <span style="margin-left: 5px;">{$translate.message_centre_notes}</span>
                                                                    </div>
                                                                    <div class="span2" style="margin-top: 17px;">
                                                                        <button class="btn btn-default btn-margin-set btn-search-implimenation pull-right" style="margin: 0px;" type="button" name="search_element_get" id="search_element_get" value="{$translate.get}" onclick="get_search()">{$translate.get}</button>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        {*<div class="span12" style="margin:0px;">
                                                                            <label style="float: left;" class="span12" for="date">{$translate.date}</label>
                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11" > <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span12" name="date" id="date" onchange="load_documentation()">
                                                                                    <option value="">{$translate.select}</option>
                                                                                    {foreach from=$dates item=date}
                                                                                        <option  value="{$date.id}" {if $data[0].created_date == $date.created_date} selected="selected" {/if}>{$date.created_date}{if $date.subject neq ''} - {$date.subject}{/if}</option>
                                                                                    {/foreach}
                                                                                    {if $documentation_type == "3"}
                                                                                        <option value="0" {if $msg_notes != "0"} selected="selected" {/if}>{$translate.message_centre_notes}</option>
                                                                                    {/if}
                                                                                </select>
                                                                                <input name="person_num" type="hidden" id="person_num" value="{$customer_detail.username}" />
                                                                                <input name="id" type="hidden" id="id" value="{$data[0].id}"  />
                                                                            </div>
                                                                        </div>*}
                                                                        {if $note_display != "yes"}
                                                                            <div class="span6">
                                                                                <label style="float: left;" class="span12" for="employed">{$translate.employed}</label>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12" name="employed" id="employed" onchange="makeChange()" {if $data}disabled="disabled"{/if}>
                                                                                        <option value=""  >{$translate.select}</option>
                                                                                        {foreach from=$employees item=employee}
                                                                                            <option value="{$employee.username}"{if $data[0].employee != "" || $data[0].employee != null} {if $data[0].employee == $employee.username} selected="selected" {/if}{else}{if $default_user == $employee.username} selected="selected" {/if}{/if} >{$employee.last_name} {$employee.first_name}</option>
                                                                                        {/foreach}
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                        <div class="span6" style="margin:20px 0px 0px 0px;">

                                                                            <label style="margin: 0px;" for="exampleInputEmail1"></label>
                                                                            {if $data[0].note_type != ""}
                                                                                <ol class="radio-group"> 
                                                                                    <li><input  name="note_type" type="radio" class="opt" id="dokumentation" value="dokumentation" onclick="load_document_particular('1')" {if $documentation_type == 1} checked="checked" {/if}   {if $data[0].writable} readonly="readonly"{/if} />
                                                                                        <label class="label-option-and-checkbox">{$translate.documentation}</label></li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="protokoll" value="protokoll" onclick="load_document_particular('2')"  {if $documentation_type == 2} checked="checked'" {/if} {if $data[0].writable} readonly="readonly"{/if}  />
                                                                                        <label class="label-option-and-checkbox">{$translate.protocol}</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="minnesanteckning" value="minnesanteckning" onclick="load_document_particular('3')"  {if $documentation_type == 3} checked="checked'" {/if} {if $data[0].writable} readonly="readonly"{/if} />
                                                                                        <label class="label-option-and-checkbox">{$translate.note_to_self}</label>

                                                                                    </li>
                                                                                </ol>
                                                                            {else}
                                                                                <ol class="radio-group"> 
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="dokumentation" value="dokumentation" {if $documentation_type == 1} checked="checked" {/if} onclick="load_document_particular('1')"  />
                                                                                        <label class="label-option-and-checkbox">{$translate.documentation}</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input  name="note_type" type="radio" class="opt" id="protokoll" value="protokoll" onclick="load_document_particular('2')" {if $documentation_type == 2} checked="checked" {/if} />
                                                                                        <label class="label-option-and-checkbox" >{$translate.protocol}</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input name="note_type" type="radio" class="opt" id="minnesanteckning" value="minnesanteckning" onclick="load_document_particular('3')" {if $documentation_type == 3} checked="checked" {/if} />
                                                                                        <label class="label-option-and-checkbox">{$translate.note_to_self}</label>

                                                                                    </li>
                                                                                </ol> 
                                                                            {/if}
                                                                        </div>
                                                                    </div>
                                                                    <div class="span12 no-ml">
                                                                        {if $note_display != "yes"}
                                                                            <div style="margin: 0px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="subject">{$translate.subject}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span11" name="subject" type="text"  class="textarea_amne" id="subject" onchange="makeChange()" value="{$data[0].subject}" /> 
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                        <div class="span12 no-ml">
                                                                            <div class="document_strip" id="notes_display_normal">
                                                                                <label style="float: left;" class="span12" for="notes">{$translate.note}</label>
                                                                                <div class="pull-left span11 no-ml">
                                                                                    <textarea class="form-control span11" name="notes" id="notes" onchange="makeChange()" {if $data[0].writable} readonly="readonly"{/if}>{*$data[0].notes*}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {if $data[0].notes != ''}
                                                                        <div class="row-fluid">
                                                                            <div class="span11 no-ml">
                                                                                <pre class="{*prettyprint*} pull-left mt span12" style="max-height: 260px; overflow: auto;">
                                                                                    {$data[0].notes}
                                                                                </pre>
                                                                            </div>
                                                                        </div>
                                                                    {/if}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                    
                                                <div style="margin: 10px 0px 0px;" class="row-fluid action-list-wrpr">
                                                    <div class="span12">
                                                        <div class="widget" style="margin: 0px ! important;">
                                                            <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
                                                                <div class="widget option-panel-widget input-group" style="margin: 0px ! important;">
                                                                    <div class="widget-header span12">
                                                                        <div class="span4 day-slot-wrpr-header-left span6">
                                                                            <h1>{$translate.action_list}</h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span4">
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date_created">{$translate.date_created}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-calendar"></span>
                                                                                <input class="form-control span9" name="date_created" type="text" id="date_created" onchange="makeChange()" value="{$data[0].created_date}" {if $data[0].writable} readonly="readonly"{/if} /> 
                                                                            </div>
                                                                        </div>

                                                                        <div style="margin: 10px 0px ! important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.date_completed}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-calendar"></span>
                                                                                <input class="form-control span9" name="date_last" type="text" id="date_last"  onchange="makeChange()" value="{if $data[0].completed_date != '0000-00-00 00:00:00'}{$data[0].completed_date}{/if}" {if $data[0].writable} readonly="readonly"{/if} /> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="span12" style="margin:0;">
                                                                        
                                                                        <label style="margin: 0px;" for="status">
                                                                            {$translate.status} : 
                                                                            {if $data[0].status != ""}
                                                                              
                                                                                   <ol class="radio-group">
                                                                              
                                                                               <li> <input  name="status" type="radio" class="sta" id="paborjad" value="paborjad" onclick="makeChange()"  {if $data[0].status   == 'paborjad'} checked="checked" {/if}{if $data[0].writable} readonly="readonly"{/if} />
                                                                                <label class="label-option-and-checkbox">{$translate.begun}</label></li>
                                                                                <li><input  type="radio" name="status" class="sta" id="fardig" value="slutfort" onclick="makeChange()"  {if $data[0].status == "slutfort"} checked="checked" {/if} {if $data[0].writable} readonly="readonly"{/if} />
                                                                                <label class="label-option-and-checkbox" >{$translate.completed}</label></li>
                                                                                
                                                                                </ol>
                                                                                
                                                                            {else}
                                                                               <ol class="radio-group">
                                                                              
                                                                               <li>
                                                                                <input name="status" type="radio" class="sta" id="paborjad" value="paborjad" onclick="makeChange()"  checked="checked"/>
                                                                               <label class="label-option-and-checkbox" >{$translate.begun}</label></li>
                                                                               <li> <input  type="radio" name="status" class="sta" id="fardig" value="slutfort"  onclick="makeChange()"  />
                                                                                <label class="label-option-and-checkbox" >{$translate.completed}</label></li>
                                                                            {/if}
                                                                        </label>
                                                                        </ol>
                                                                     </div>   
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                            <label style="float: left;" class="span12" for="priority">{$translate.priority}:</label>
                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                                                                {if $data[0].writable}
                                                                                    <input class="form-control span11" name="data_priority" type="text" id="data_priority" value="{$data[0].priority}" onchange="makeChange()" readonly="readonly"/>
                                                                                {else}
                                                                                    <select class="form-control span11" name="priority" id="priority" onchange="makeChange()">
                                                                                        <option value="">{$translate.select}</option>
                                                                                        <option value="Låg" {if $data[0].priority == "Låg"} selected="selected" {/if} {if $data[0].writable} readonly="readonly"{/if}>{$translate.low}</option>
                                                                                        <option value="Medel" {if $data[0].priority== "Medel"} selected="selected" {/if} {if $data[0].writable} readonly="readonly"{/if}>{$translate.medium}</option>
                                                                                        <option value="Hög" {if $data[0].priority == "Hög"} selected="selected" {/if} {if $data[0].writable} readonly="readonly"{/if}>{$translate.high}</option>
                                                                                    </select>
                                                                                {/if}
                                                                            </div>
                                                                        </div>
                                                                        {*<div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="more_notes">{$translate.note}</label>
                                                                            <textarea class="form-control span11" name="more_notes" id="more_note" onchange="makeChange()" {if $data[0].writable} readonly="readonly"{/if} >{$data[0].description}</textarea>
                                                                        </div>*}
                                                                        <div style="margin: 0px ! important;" class="span12 no-ml">
                                                                            <div class="document_strip" id="notes_display_normal">
                                                                                <label style="float: left;" class="span12" for="notes">{$translate.note}</label>
                                                                                <div class="pull-left span11 no-ml">
                                                                                        <textarea class="form-control span11" name="more_notes" id="more_note" onchange="makeChange()" {if $data[0].writable} readonly="readonly"{/if}>{$data[0].description}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <input type="hidden" name="tdocs" id="tdocs" value="{$data[0].document}" />
                                                                        <input type="hidden" name="del_doc" id="del_doc" value="" />
                                                                        <div class="span12" style="margin:0">
                                                                            <div id="file_list">
                                                                                <ul class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                                                    {if $data[0].document != ""}
                                                                                        {foreach $customer_documents as $customer_document}
                                                                                            <li class="list-group-item">
                                                                                                <img src="{$url_path}images/{$customer_document.icon}" width="14" height="17" />
                                                                                                <a id="lic_1" href="javascript:void(0)" onclick="downloadFile('{$customer_document.file}')">{$customer_document.name}</a>
                                                                                                <a href="javascript:void(0);" style="float: right;" onclick="docRemove('{$customer_document.file}')" class="btn btn-danger"><span class="icon-trash"> {$translate.delete_file}</span></a>
                                                                                                <div class="clearfix"></div>
                                                                                            </li>
                                                                                        {foreachelse}
                                                                                            <li class="list-group-item">{$translate.there_are_no_files}</li>
                                                                                        {/foreach}
                                                                                    {else}
                                                                                    <li class="list-group-item"><span>{$translate.there_are_no_files}</span></li>
                                                                                    {/if}
                                                                                </ul>
                                                                            </div>
                                                                            <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file">
                                                                                <input type="hidden" name="file_count" id="file_count" value="1" />
                                                                                <div id="file_attach" class="span12 no-ml">
                                                                                    <input class="no-ml span12 pull-left" type="file" name="file_1" id="file_1" size="12"/>
                                                                                </div>
                                                                                <label>.doc, .docx, .pdf, .odt</label>
                                                                            </span>
                                                                            <div style="margin-top: 3px" class="row-fluid">
                                                                                <label class="span6"><a id="attach_file" href="javascript:void(0);" class="btn btn-default" onclick="attachAnother()" style="margin-top:15px">{$translate.upload_new_file}</a></label>
                                                                                <label class="span6"><a id="remove_file" href='javascript:void(0);' class="btn btn-default" style="margin-top:15px" onclick='removeFile()' >{$translate.delete_file}</a></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {if $note_display == "yes"}                        
                                                    <div style="margin: 10px 0px 0px;" class="row-fluid">
                                                        <div class="span12">
                                                            <div class="widget" style="margin: 0px ! important;">
                                                                {assign i 0}
                                                                <table class="table table-white table-bordered table-hover table-responsive swipe-horizontal table-primary">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{$translate.writer}</th>
                                                                            <th>{$translate.customer}</th>
                                                                            <th>{$translate.title}</th>
                                                                            <th>{$translate.discription}</th>
                                                                            <th>{$translate.date_written}</th>
                                                                            <th>{$translate.visibility}</th>
                                                                            <th>{$translate.view}</th>
                                                                                {if $user_role eq 1}
                                                                                <th>{$translate.status}</th>
                                                                                {/if}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {foreach $all_notes AS $list}
                                                                            <tr class="{cycle values="even,odd"}{if $i == 0} first{/if}" id="status_{$list.id}">

                                                                                <td>{$list.emp_name}</td>
                                                                                <td>{$list.cust_name}</td>
                                                                                <td>{htmlspecialchars($list.title)}</td>
                                                                                {assign var="cnt" value=$list.description|strlen}
                                                                                <td>{if $cnt gt 100}{htmlspecialchars($list.description|truncate:100)}{else}{htmlspecialchars($list.description)}{/if}</td>
                                                                                <td>{$list.date}</td>
                                                                                <td>{if $list.visibility eq 1}{$translate.public}
                                                                                    {elseif $list.visibility eq 2}{$translate.private}
                                                                                        {elseif $list.visibility eq 3}{$translate.all}
                                                                                            {elseif $list.visibility eq 4}{$translate.admin_only}{/if}</td>
                                                                                                <td style="width:50px;text-align:center;">
                                                                                                    {if $list.attachment neq ''}
                                                                                                        <a style="float:left;" href="{$url_path}notes/detail/{$list.id}/1/" class="btn btn-default"><i class="icon-wrench"></i></a>&nbsp;&nbsp;
                                                                                                        {else}
                                                                                                        <a href="{$url_path}notes/detail/{$list.id}/1/" class="btn btn-default"><i class="icon-wrench"></i></a>
                                                                                                        {/if} 
                                                                                                        {if $list.attachment neq ''}<a href="javascript:void(0);" class="btn btn-default" title="{$translate.attachments}"><i class="icon-wrench"></i></a>{/if}
                                                                                                </td>
                                                                                                {if $user_role eq 1}
                                                                                                    <td>{if $list.status eq 1}{$translate.active}{elseif $list.status eq 0}{$translate.forbidden}{/if}</td>
                                                                                                {/if}
                                                                                            </tr>
                                                                                            {assign i $i+1}
                                                                                            {foreachelse}
                                                                                            <td colspan="8"><div id="no_data" class="message" >{$translate.no_data_available}</div></td>
                                                                                                {/foreach}

                                                                                                </tbody>
                                                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {/if}
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
    {else}
      <div class="fail">{$translate.permission_denied}</div>      
    {/if}
{/block}
