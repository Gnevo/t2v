{block name='style'}
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery-ui-timepicker-addon.css"/>
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
    label.label_caption{
        font-weight: bold;
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
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-ui-timepicker-addon.js"></script>

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
var hide=0;
var change_var = 0;
$(document).ready(function() {
    /*$('#search_element_fromdate, #search_element_todate').datepicker({
            showOn: "button",                    
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true

    });*/  

    
    var org_field_val = '';
    var data_id       = ''; 
    $('.edit-div').on('click', '#btn_field_save', function(e){
        var elem = $(this);
        var field_val = $(this).parent().find('#field_val').val()
        var field_name = $(this).parent().find('#field_val').attr('data-tag-field-name');
        var field_id = $(this).parent().find('#field_val').attr('data-field-id');

        $.ajax({
            url:"{$url_path}customer/implan/{$customer_username}/",
            type:"POST",
            dataType: 'json',
            data: { 'field_name': field_name, 'field_val': field_val, 'field_id': field_id, 'action': 'change_field'},
            success:function(data){
                org_field_val = field_val;
                var html_data = '<label  class="label_caption" for="'+field_name+'">'+field_val+'</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="'+field_name+'" data-id = "'+field_id+'"></i><i class="fa fa-trash-o delete-field ml" data-id ="'+field_id+'" data-name = "'+field_val+'" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>';
                elem.parent().html(html_data);
            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    $('.edit-div').on('click', '#label_edit', function(e){
        var elem = $(this).parent();
        var data_id = $(this).siblings('.delete-field').attr('data-id');
        $(this).siblings('.delete-field').remove();
        var field_name = $(this).attr('data-tag');
        var field_id = $(this).attr('data-id');
        var field_val = $(this).parent().find('label').text();
        org_field_val = field_val;
        $(this).parent().html("<input style='margin:0; height:28px;' type='text' id='field_val' value='"+field_val+"' data data-tag-field-name='"+field_name+"' data-tag-field-val='"+field_val+"' data-field-id='"+field_id+"'> <input type=button id=btn_field_save  value='Save'> <input type='button' id='btn_field_cancel' value='cancel'>");
        elem.find('#field_val').focus().select();
        e.preventDefault();
        e.stopPropagation();
    });
    

    $('.edit-div').on('click', '#btn_field_cancel', function(e){
        var field_name = $(this).parent().find('#field_val').attr('data-tag-field-name'); 
        var field_id = $(this).parent().find('#field_val').attr('data-field-id');       
        var html_data = '<label  class="label_caption" for="'+field_name+'">'+org_field_val+'</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="'+field_name+'" data-id="'+field_id+'"></i><i  class="fa fa-trash-o delete-field ml" data-id ="'+field_id+'" data-name = "'+org_field_val+'" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>';
        $(this).parent().html(html_data);
        e.preventDefault();
        e.stopPropagation();
    });

    $('.edit-div').on('click', '.delete-field', function(e){
        // event.preventDefault();
        var delete_id = $(this).attr('data-id');
        var this_var = $(this);
        var field_name = this_var.attr('data-name');
        bootbox.dialog('{$translate.do_you_want_delete_field}', [
            {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
            },
            {                       
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        url:"{$url_path}customer/implan/{$customer_username}/",
                        type:"POST",
                        dataType: 'json',
                        data: { 'delete_id': delete_id,'action': 'delete_field'},
                        success:function(data){
                            
                            if(data != null){
                                    var customers = '';
                                    data.forEach(function(value,key){
                                        customers += value.customer+',';
                                    });
                                    customers = customers.replace(/,\s*$/, "");
                                 bootbox.dialog('<div class= message> {$translate.field_exists} - ' +field_name+' ('+customers+')</div>', [
                                    {
                                        "label" : "{$translate.ok}",
                                        "class" : "btn-success",
                                    },
                                 ]);
                            }
                            else{
                                bootbox.dialog('<div class ="alert alert-success alert-dismissable no-ml no-mr text-left" ><i class="icon-ok-sign icon-large"></i> {$translate.field_deleted_successfully} - '+ field_name+'</div>', [
                                    {
                                        "label" : "{$translate.ok}",
                                        "class" : "btn-success",
                                    },
                                 ]);
                                this_var.closest('.row-fluid').detach();
                            }

                        }
                    });
                }
            }
        ]);
        e.preventDefault();
        e.stopPropagation();
    });

     $(".side_links li a,.logout").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
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
                                document.location.href = href_val;
                        }
                    }
            });
        }
        else{
            document.location.href = href_val;
        }
    
    });
    $("#search_element").hide();
			
    hide = 1;
    
    });
 function toggle_form() {
    $(".search-implimentation-wrpr").toggle();
}  
        
function changeDate() {

    $('#date').val();
    if($('#date').val() == ''){
        document.location.href = "{$url_path}customer/implan/{$customer_detail.username}/new/";
    }
    else{
        document.location.href = "{$url_path}customer/implan/{$customer_detail.username}/"+$('#date').val()+"/get/";
    }
}
function saveForm() {
    var i=0;
    var travels="";
    for(i=0;i<$("#type_num").val();i++){
        if($("#travel_"+i).attr('checked')){
            travels = travels+$("#travel_"+i).val()+",";
        }
    }
    $("#travels").val(travels);
    $('#val').val('save');
    var error = 0;
               /* if($('#history').val() == "")
                {
                    $('#history').addClass("error");
                    error = 1;
                    //alert("{$translate.enter_works}");
                 }else{
                    $('#history').removeClass("error");
                 }
                  if($('#diagnosis').val() == "")
                {
                    $('#diagnosis').addClass("error");
                    error = 1;
                    //alert("{$translate.enter_background_history}");
                 }else{
                    $('#diagnosis').removeClass("error");
                 }
                if($('#mission').val() == "")
                {
                    $('#mission').addClass("error");
                    error = 1;
                 }else{
                    $('#mission').removeClass("error");
                 }
                  if($('#email').val() == "")
                {
                    $('#email').addClass("error");
                    error = 1;
                 }else{
                    $('#email').removeClass("error");
                 }
                 if($('#ovrig').val() == "")
                {
                    $('#ovrig').addClass("error");
                    error = 1;
                 }else{
                    $('#ovrig').removeClass("error");
                 }
                 if($('#phone').val() == "")
                {
                    $('#phone').addClass("error");
                    error = 1;
                 }else{
                    $('#phone').removeClass("error");
                 }
                 if($('#comment_work').val() == "")
                {
                    $('#comment_work').addClass("error");
                    error = 1;
                 }else{
                    $('#comment_work').removeClass("error");
                 }
                  if($('#comment_travel').val() == "")
                {
                    $('#comment_travel').addClass("error");
                    error = 1;
                 }else{
                    $('#comment_travel').removeClass("error");
                 }
                 if(error == 0)*/ 
               var name_status = 0;
               var des_status;
               $(".cus_implannew_name").length == 0 ? name_exist = 0 : name_exist = 1;
               $(".cus_implannew_name").each(function() {
                    if($(this).val() == ''){
                        name_status = 0;
                        return false;
                    } 
                    else{
                         name_status = 1; 
                    }
                    $('#check_new_implan').val(1);
                });
                 $(".new_implan_description").each(function() {
                    if($(this).val() != ''){
                        des_status = 1;
                        return false;
                    } 
                    else{
                         des_status = 0; 
                    }
                    $('#check_new_implan').val(1);
                }); 
              if(change_var == 1 || $('#history').val() != "" || $('#diagnosis').val() != "" || $('#mission').val() != "" || $('#email').val() != ""  || $('#phone').val() != "" || $('#comment_work').val() != "" || $('#comment_travel').val() != "" || des_status == 1 ){
                    if(name_exist == 0 ){
                        $('#form').submit();
                    }
                    else{
                        name_status == 1 ? $('#form').submit() : alert('{$translate.customer_name_not_empty}');
                    }
              }
              else{
                if(name_exist == 1)
                    name_status == 1 ? $('#form').submit() : alert('{$translate.customer_name_not_empty}');
                else
                    alert('{$translate.customer_data_not_empty}');
              }
               // }
   
}


function saveLock() {
    $('#read_write').val(1);
    //alert($('#read_write').val());
    saveForm();   
}



function get_search(){
    var search_radio = $('input:radio[name=radio_search]:checked').val();
    var month = $("#search_element_month").val();
    var year = $("#search_element_year").val();
    var search_text = $("#search_element_search").val();
    var dates_from = $("#search_element_fromdate").val();
    var dates_to = $("#search_element_todate").val();
    var username = '{$customer_username}';
    window.open("{$url_path}customer_implan_print.php?search_val="+search_radio+"&month="+month+"&year="+year+"&date_from="+dates_from+"&date_to="+dates_to+"&username="+username+"&search_text="+search_text,"_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=800, height=440");

}
function addNew() {

    document.location.href='{$url_path}customer/implan/{$customer_detail.username}/new/'
}
function resetForm() {

    $('#form').submit();
}

function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}

function print_data(username)
{
    
    var work=$("#work option:selected").text(); 
    var dt=$("#date option:selected").text();    
    var date=document.getElementById('date').value;
    
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }

    
    window.open("{$url_path}pdf_customer_implan.php?username="+username+"&date="+date+"&dt="+dt+'&_'+Date.now());
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
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_username}");
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
function autosave() {
	if($("#history").val() != '' || $("#diagnosis").val() != '' || $("#mission").val() != '' || $("#intervention").val() != '' || $("#email").val() != '') {
		$.ajax({
			type: 'POST',
			url: '{$url_path}/ajax_auto_save.php',
			data: {
				tab:            '1',
				username:       $("#username").val(),
				history:        $("#history").val(),
				diagnosis:      $("#diagnosis").val(),
				mission:        $("#mission").val(),
				intervention:   $("#intervention").val(),
				email:          $("#email").val(),
				date:           $("#date").val(),
                read_write:     $("#read_write").val()
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
}
window.setInterval(autosave,60000);
// window.setInterval(autosave,10000);
</script>
<script type="text/javascript">

    function summernote_editer(){
        $('.wysiwyg-editor').summernote({
            height: 200,
            tabsize: 2,
            codemirror: {
              theme: 'monokai'
            },
{*            defaultFontName: 'Times New Roman',*}
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
              ],
            onInit : function() {
                $('.panel-heading').height('65px');
            }
          });
        $("#remove_file").hide();
    }


    $(function () {
        summernote_editer();
    });

    function downloadFile(filename){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
    }

    function attachAnother() { 
        makeChange();           
        var file_count = parseInt($('#file_count').val()) + 1;
        if(file_count > 1){
            $("#remove_file").show();
        }
        $('#file_count').val(file_count);
        $('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' class='pull-left'/></div>");
    }

    function removeFile(){
        makeChange();
        var id = $('#file_count').val();
        var file_count = parseInt(id) - 1;
        if(file_count == 1){
            $("#remove_file").hide();
        }
        $('#file_count').val(file_count);
        $('div').remove('.file_attach_row' + id);
    }

    function docRemove(doc, this_obj) {
        bootbox.confirm('{$translate.do_you_want_to_delete_customer_implan_file}', function (result) {
            if (result) {
                makeChange()
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
                    //$('#file_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
                    //$("#file_list").load("{$url_path}ajax_customer_attachments.php?type=customer_attachment&docs=" + new_array);

                $(this_obj).parents('li.list-group-item').remove();
            } else {
                
            }

        });
    }

    $('#btn_add_new_implan').click(function(){
        var html = ' <div class="row-fluid remove_class" style="margin-top:10px;">\n\
                        <div class="edit-div" style="margin-bottom:3px;"><input style="margin:0; height:28px;" type="text" placeholder = "Name" class = "cus_implannew_name" name = "new_implan_name[]"><input type = "button" class="btn btn-default ml save_new_implan" value ="{$translate.save}" ><input type="button"  class="btn btn-default ml cancel_new_work" value="{$translate.cancel}"></div>\n\
                        <div class="pull-left span6 no-ml">\n\
                            <textarea rows="1"  class="form-control span12 wysiwyg-editor" name="new_implan_description[]" id="comment_travel" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>\n\
                        </div>\n\
                        <div class="span6 input-group" style="height: 23.5em;overflow: auto;">\n\
                            \n\
                        </div>\n\
                    </div>';
        $('#add_new_implan').before(html);
        summernote_editer();
    });

    $(document).on( "click", ".cancel_new_work", function(event) {
        $(this).closest('.remove_class').detach();
    })

    $(document).on( "click", ".save_new_implan", function(e) {
        var field_name      = $(this).siblings('.cus_implannew_name').val();
        var this_textarea   = $(this).closest('.edit-div').siblings('.pull-left.span6.no-ml').find('textarea');
        var editer_textarea = $(this).closest('.edit-div').siblings('.pull-left.span6.no-ml').find('.note-editor.panel.panel-default').find('textarea');
        var edit_div        = $(this).closest('.edit-div');
        if(field_name == ''){
            alert('{$translate.customer_name_not_empty}');
        }
        else{
           $.ajax({
                url:"{$url_path}customer_implan/",
                type:"POST",
                dataType: 'json',
                data: { 'field_name': field_name, 'action': 'save_single_field'},
                success:function(data){
                    edit_div.empty();
                    edit_div.append('<label  class="label_caption" for="travel_comment">'+field_name+'</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-id='+data+' data-field = '+field_name+'></i><i  class="fa fa-trash-o  delete-field ml" data-id ="'+data+'" data-name = "'+field_name+'" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>');
                    this_textarea.addClass('new_implan_description');
                    this_textarea.attr('name',"new_implan_update["+data+"]");
                    editer_textarea.removeClass('new_implan_description');
                    editer_textarea.removeAttr('name');
                }
            }); 
        }
        e.preventDefault();
        e.stopPropagation();
    });

    $(document).on( "click", "#label_edit", function(e) {
        var elem       = $(this).parent();
        var field_name = $(this).data('field');
        var field_id   = $(this).data('id');
        var field_val  = $(this).parent().find('label').text();
        org_field_val  = field_val;
        $(this).parent().html("<input style='margin:0; height:28px;' type='text' id='field_val' value='"+field_val+"' data data-tag-field-name='"+field_name+"' data-tag-field-val='"+field_val+"' data-field-id='"+field_id+"'> <input type=button id=btn_field_save  value='{$translate.save}'> <input type='button' id='btn_field_cancel' value='{$translate.cancel}'>");
        elem.find('#field_val').focus().select();
        e.preventDefault();
        e.stopPropagation();
    });

    $(document).on('click', '#btn_field_save', function(e){
        var elem       = $(this);
        var field_val  = $(this).parent().find('#field_val').val();
        var field_name = $(this).parent().find('#field_val').attr('data-tag-field-name');
        var field_id   = $(this).parent().find('#field_val').attr('data-field-id');

        $.ajax({
            url:"{$url_path}customer/implan/{$customer_username}/",
            type:"POST",
            dataType: 'json',
            data: { 'field_name': field_name, 'field_val': field_val, 'field_id': field_id, 'action': 'change_field'},
            success:function(data){
                org_field_val = field_val;
                var html_data = '<label  class="label_caption" for="'+field_name+'">'+field_val+'</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-field="'+field_name+'" data-id = "'+field_id+'"></i><i class="fa fa-trash-o  delete-field ml" data-id ="'+field_id+'" data-name = "'+field_val+'" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>';
                elem.parent().html(html_data);
            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    $(document).on('click', '#btn_field_cancel', function(e){
        var field_name = $(this).parent().find('#field_val').attr('data-tag-field-name'); 
        var field_id   = $(this).parent().find('#field_val').attr('data-field-id');       
        var html_data  = '<label  class="label_caption" for="'+field_name+'">'+org_field_val+'</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-field="'+field_name+'" data-id="'+field_id+'"></i><i  class="fa fa-trash-o  delete-field ml" data-id ="'+field_id+'" data-name = "'+org_field_val+'" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>';
        $(this).parent().html(html_data);
        e.preventDefault();
        e.stopPropagation();
    });

    $(document).on('click', '.delete-field', function(e){
        // event.preventDefault();
        var delete_id = $(this).attr('data-id');
        var this_var = $(this);
        var field_name = this_var.attr('data-name');
        bootbox.dialog('{$translate.do_you_want_delete_field}', [
            {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
            },
            {                       
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        url:"{$url_path}customer/implan/{$customer_username}/",
                        type:"POST",
                        dataType: 'json',
                        data: { 'delete_id': delete_id,'action': 'delete_field'},
                        success:function(data){
                            if(data != null){
                                    var customers = '';
                                    data.forEach(function(value,key){
                                        customers += value.customer+',';
                                    });
                                    customers = customers.replace(/,\s*$/, "");
                                 bootbox.dialog('<div class = message > {$translate.field_exists} - '+field_name+' ('+customers+')</div>', [
                                    {
                                        "label" : "{$translate.ok}",
                                        "class" : "btn-success",
                                    },
                                 ]);
                            }
                            else{
                                bootbox.dialog('<div class = "alert alert-success alert-dismissable no-ml no-mr text-left" ><i class="icon-ok-sign icon-large"></i> {$translate.field_deleted_successfully} - '+field_name+'</div>', [
                                    {
                                        "label" : "{$translate.ok}",
                                        "class" : "btn-success",
                                    },
                                 ]);
                                this_var.closest('.row-fluid').detach();
                            }

                        }
                    });
                }
            }
        ]);
        e.preventDefault();
        e.stopPropagation();
    });

  
    

</script>
{/block}

{block name="content"}
    {if $access_flag == 1}
        <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        <div class="hide" id="autosave"></div>
        {$message} 
        <div class="row-fluid">
            <div style="" class="span12 main-left">
                <div style="margin: 0px;" class="widget-header span12">
                    <div class="day-slot-wrpr-header-left pull-left">
                        <h1>{$translate.customer}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
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
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data('{$customer_username}')"><span class="icon-print"></span> {$translate.print}</button>
                                        <button class="btn btn-default btn-normal pull-right hide" type="button" onclick="saveLock()"><span class="icon-lock"></span> {$translate.save_lock}</button>
                                    </div>
                                </div>
                            </div>
                                   <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="tab-5">
                                    <form name="form" id="form" method="post" action="{$url_path}customer/implan/{$customer_username}/" style="float:left;" enctype="multipart/form-data">
                                        <input type="hidden" name="username" id="username" value="{$customer_username}" />
                                        <input type="hidden" name="check_new_implan" id="check_new_implan" value="">
                                        <input type="hidden" name="val" id="val" value="" />
                                        <input type="hidden" name="new" id="new" value="{$new}" />
                                        <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                        <input type="hidden" name="read_write" id="read_write" value="{$implementation.writable}" />
                            <div style="" class="span12 widget-body-section input-group">
                                        <div class="row-fluid">
                                             <div class="span12"><div style="margin: 0px ! important;" class="widget-header span12">
                                            <div class="widget" style="margin: 0px ! important;">
                                                <!--WIDGET BODY BEGIN-->
                                              
                                                    <div class="row-fluid">
                                                        <div style="margin: 0px ! important;" class="widget-header span12">
                                                            <div class="pull-left">
                                                                <h1>{$translate.implimentation_plan}</h1>
                                                            </div>
                                                            <div class="pull-right" style="padding: 5px;">
                                                                <button class="btn btn-default btn-normal pull-right btn-search-implimentation" name="search" id="search" type="button" value="{$translate.search}" onclick="toggle_form()"><span class="icon-search"></span> {$translate.search}</button>
                                                                <button class="btn btn-default btn-normal pull-right" name="add" id="add" type="button" value="{$translate.add_new} {$translate.implementation_plan}" onclick="addNew()"><span class="icon-plus"></span> {$translate.add_new} {$translate.implementation_plan}</button>
                                                            </div>
                                                            <div class="pull-left" style="padding: 8px; margin: 0px ! important;">
                                                                <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                    <select class="form-control" name="date" id="date" onchange="changeDate()" >
                                                                        <option value="">{$translate.select}</option>
                                                                        {foreach from=$implan_date item=date}
                                                                            <option value="{$date.id}" {if $date.id == $implementation.id}selected="selected"{/if}>{$date.date}</option>
                                                                        {/foreach}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="margin: 0px 0px 15px ! important; display: none;" class="span12 widget-body-section input-group search-implimentation-wrpr">       
                                                            <div class="span12">
                                                                <div class="span3" style="margin: 0px 0px 10px;">
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
                                                                <div class="span2" style="margin-top: 17px;">
                                                                    <button class="btn btn-default btn-margin-set btn-search-implimenation pull-right" style="margin: 0px;" type="button" name="search_element_get" id="search_element_get" value="{$translate.get}" onclick="get_search()">{$translate.get}</button>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="span12 widget-body-section input-group">
                                                            <div class="span12">

                                                                <div class="row-fluid">
                                                                    <div class="span12"><label  class="label_caption" for="file_upload">{$translate.implan_file_upload_head}</label></div>
                                                                    <div class="span12 widget-body-section input-group">
                                                                        <input type="hidden" name="tdocs" id="tdocs" value="{$customer_implan_document_string}" />
                                                                        <input type="hidden" name="del_doc" id="del_doc" value="" />
                                                                        <div class="span12" style="margin:0">
                                                                            <ul class="list-group list-group-form uploaded-files-box span12" style="float: left; height: 90px;">
                                                                                {if $customer_implan_document_string != ""}
                                                                                    {foreach $customer_implan_documents as $customer_document}
                                                                                        <li class="list-group-item" onchange="makeChange()" style="width: 75%">
                                                                                            <img src="{$url_path}images/{$customer_document.icon}" width="14" height="17" />
                                                                                            <a id="lic_1" href="javascript:void(0)" onclick="downloadFile('{$customer_document.file}')" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block; vertical-align: text-top;" title="{$customer_document.file}">{*$customer_document.name*}{$customer_document.file}</a>
                                                                                            <a href="javascript:void(0);"   onclick="docRemove('{$customer_document.file}', this)"  class="btn btn-danger btn-lg" style="float: right;"><span class="icon-trash" style="font-size: 12px;"> {$translate.delete_file}</span></a>
                                                                                            <div class="clearfix"></div>
                                                                                        </li>
                                                                                    {foreachelse}
                                                                                        <li class="list-group-item">{$translate.there_are_no_files}</li>
                                                                                        {/foreach}
                                                                                    {else}
                                                                                    <li class="list-group-item"><span>{$translate.there_are_no_files}</span></li>
                                                                                        {/if}
                                                                            </ul>
                                                                            <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file">
                                                                                <input type="hidden" name="file_count" id="file_count" value="1" />
                                                                                <div id="file_attach">
                                                                                    <input class="margin-none pull-left" type="file" name="file_1" id="file_1" size="12" onchange="makeChange()" />
                                                                                </div>
                                                                            </span>


                                                                            <div style="margin-top: 3px">
                                                                                <label><a id="attach_file" href="javascript:void(0);" class="btn btn-default" onclick="attachAnother()" style="margin-top:15px">{$translate.upload_new_file}</a></label>
                                                                                <label><a id="remove_file" href='javascript:void(0);' class="btn btn-default" style="margin-top:15px" onclick='removeFile()' >{$translate.delete_file}</a></label>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row-fluid mt">
                                                                    <div class="span12 widget-body-section input-group">
                                                                       <div class="row-fluid">
                                                                            <div class="span6" style="margin: 10px 0 0 0;">
                                                                                <div class="edit-div"><label  class="label_caption" for="work">{$implan_field_names['work']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="work"></i></div>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" name="work" id="work" onchange="makeChange()" {if $implementation.writable} disabled="disabled" {/if}>
                                                                                        <option value="">{$translate.select}</option>
                                                                                        {html_options options=$work_array selected=$implementation.work}
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin: 10px 0 0 0;" class="span6">
                                                                                <div class="edit-div"><label  class="label_caption" for="phone">{$implan_field_names['phone']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="phone"></i></div>
                                                                                <div style="margin-left: 15px;" class="input-prepend span12 "> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span11"  type="text" name="phone" id="phone" onchange="makeChange()" value="{$implementation.phone}" {if $implementation.writable} readonly="readonly"{/if} /> 
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                         <div class="row-fluid" style="margin-top:10px;">
                                                                            <div class="edit-div"><label  class="label_caption" for="travel">{$implan_field_names['travel']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="travel"></i></div>
                                                                            <div class="row-fluid">
                                                                                {assign i 0}
                                                                                {foreach from=$travel_type key=travel_id item=travel}
                                                                                    <div class="work_detail_check span4">
                                                                                        <label style="margin-left: 5px;">{$translate.{$travel}}</label>
                                                                                        <input style="margin-left: 10px ! important;" class="check-box" type="checkbox" name="travel_{$i}" id="travel_{$i}" onchange="makeChange()" class="clear_chek" value="{$travel_id}" {if $implementation.writable} disabled="disabled"{/if} {if $implementation.travel|count gt 0 and in_array($travel_id, $implementation.travel)} checked="checked"{/if} />
                                                                                    </div>
                                                                                    {assign i $i+1}
                                                                                {/foreach}
                                                                                <input type="hidden" name="type_num" id="type_num" value="{$i}" />
                                                                                <input type="hidden" name="travels" id="travels" value="" />
                                                                            </div>
                                                                        </div>
                                                                     </div>
                                                                </div>

                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="history">{$implan_field_names['history']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="history"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="history" id="history" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if} ></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                    {$implementation.history}
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="diagnosis">{$implan_field_names['diagnosis']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="diagnosis"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="diagnosis" id="diagnosis" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if} ></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                        {$implementation.diagnosis}
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="mission">{$implan_field_names['mission']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="mission"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor"name="mission" id="mission" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                        {$implementation.mission}
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="email">{$implan_field_names['email']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="email"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="email" id="email"  cols="32" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                        {$implementation.email}
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="intervention">{$implan_field_names['intervention']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="intervention"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="intervention" id="intervention" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                            {$implementation.intervention}
                                                                    </div>
                                                                </div>
                                                                    
                                                                
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="work_comment">{$implan_field_names['work_comment']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="work_comment"></i></div>
                                                                    
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="comment_work" id="comment_work"  cols="45" rows="5" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                        {$implementation.work_comment}
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row-fluid" style="margin-top:10px;">
                                                                    <div class="edit-div"><label  class="label_caption" for="travel_comment">{$implan_field_names['travel_comment']}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-tag="travel_comment"></i></div>
                                                                    <div class="pull-left span6 no-ml">
                                                                        <textarea rows="1" class="form-control span12 wysiwyg-editor" name="comment_travel" id="comment_travel" onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                    </div>
                                                                    <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                        {$implementation.travel_comment}
                                                                    </div>
                                                                </div>

                                                                {foreach $new_implan_fields as $key =>$value}

                                                                    <div class="row-fluid" style="margin-top:10px;">
                                                                        <div class="edit-div"><label  class="label_caption" for="travel_comment">{$value.name}</label><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;" id="label_edit" data-id="{$value.id}"></i>
                                                                            <i  class="fa fa-trash-o delete-field ml" data-id ="{$value['id']}" data-name = "{$value['name']}" aria-hidden="true" style="font-size: 1.5em; margin-left: 10px;"></i>
                                                                        </div>
                                                                        <div class="pull-left span6 no-ml">
                                                                            <textarea rows="1" class="form-control span12 wysiwyg-editor new_implan_description" name="new_implan_update[{$value.id}]"  onchange="makeChange()"{if $implementation.writable} readonly="readonly"{/if}></textarea>
                                                                        </div>
                                                                        <div class="span6 input-group" style="height: 23.5em;overflow: auto;">
                                                                            {$new_implan_description_show_div[$value['id']].description}
                                                                        </div>
                                                                    </div>

                                                                {/foreach}

                                                                {if $privilege_general.customer_doc_field eq 1}
                                                                    <div id="add_new_implan" class="row-fluid" style="margin-top:10px;">
                                                                        <button id="btn_add_new_implan" type="button" class="btn btn-default" style="float: right;">{$translate.cus_add_new}</button>
                                                                    </div>
                                                                {/if}
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
        </div>
        </div>
    {else}
      <div class="fail">{$translate.permission_denied}</div>      
    {/if}
{/block}