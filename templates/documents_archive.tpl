{block name='style'}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="{$url_path}css/fileupload/bootstrap.min.css">
        <!-- Generic page styles -->
        {*<link rel="stylesheet" href="{$url_path}css/style.css">*}
    <link rel="stylesheet" href="{$url_path}css/fileupload/blueimp-gallery.min.css">
    <link rel="stylesheet" href="{$url_path}css/fileupload/jquery.fileupload.css">
    <link rel="stylesheet" href="{$url_path}css/fileupload/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="{$url_path}css/fileupload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="{$url_path}css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>
    <style type="text/css">

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
    </style>
{/block}
{block name='script'}
<script type="text/javascript">

    function parent_child_show(){
        var level;
        var category_names = {$all_category|json_encode};
            $.each(category_names, function (index, value) {
                if(value.parent_category == 0 ){
                    // level = 10 ;
                    {if $login_user_role == 1 || $login_user_role == 6}
                        var space = $('#parent_'+value.parent_category).data('space');
                        space = space + 2;
                        w_space  = "&nbsp".repeat(space);
                        $('#parent_0').after('<option data-space = '+space+'  value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                        $('#upfile_0').after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                        $('#option_category0').after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                    {else}
                        if(value.id != -1) {
                            var space = $('#parent_'+value.parent_category).data('space');
                            space = space + 2;
                            w_space  = "&nbsp".repeat(space);
                            $('#parent_0').after('<option data-space = '+space+'  value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                            $('#upfile_0').after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                            $('#option_category0').after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                        }
                    {/if}
                }
                else{
                    for (var i = 0; i <index; i++) {
                        if(value.parent_category == category_names[i].id){
                             var space = $('#parent_'+value.parent_category).data('space');
                             space = space + 4;
                             w_space  = "&nbsp".repeat(space);
                             $('#parent_'+value.parent_category).after('<option data-space = '+space+' value ='+value.id+' id = parent_'+value.id+'>'+w_space+''+value.name+'</option>');
                             $('#upfile_'+value.parent_category).after('<option value ='+value.id+' id = upfile_'+value.id+'>'+w_space+''+value.name+'</option>');
                             $('#option_category'+value.parent_category).after('<option value ='+value.id+' id = option_category'+value.id+'>'+w_space+''+value.name+'</option>');
                        }
                    }
                }
            });
    }

    $(document).ready(function(){

// height set
//var windowHeight = $(window).height();
//$('.table-manage-catt').height(windowHeight);
//add_new_category

    var windowHeight = $(window).height();
    $('.cat-height').height(windowHeight);
    $(window).resize(function(){
        $('.cat-height').height(windowHeight);
     });

         // $("#add_new_category").click(function() {
         //    var manageCatAdd = $('#add_new_category_div').height();
         //    $('.manage-cat-table-height').height()-200;
         //     });




        // $('#forms_container_new').css({ height: $(window).height()-208}); 
        parent_child_show();
        var folder_id = '{$category_id}' == '' ? folder_id = 0 : folder_id = '{$category_id}' ;
        $('#upfile_'+folder_id).prop('selected','selected');
        $('#parent_'+folder_id).prop('selected','selected');
        // $( "#category_select option:selected" ).html($( "#category_select option:selected" ).html().replace(/&nbsp;/g, ''));

        $('.tbl-responsive').css({ height: $(window).height()-140});
        if($(window).height() > 600){
            $('#forms_container_new').css({ height: $(window).height()-300}); 
            $('#table_list').css({ height: 'auto'}); 
            $('.row-fluid .table-responsive').css({ height: $(window).height()-300});
            $('.main-right').css({ height: $(window).height()}); 
            $('.email-list-box').css({ height: $(window).height()-124}); 
        } else {
            $('#table_list').css({ height: 'auto'}); 
            $('#forms_container_new').css({ height: $(window).height()});    
            $('.main-right').css({ height: $(window).height()});    
            $('.email-list-box').css({ height: $(window).height()});    
        }

        $(window).resize(function(){
            $('.tbl-responsive').css({ height: $(window).height()-140});
            if($(window).height() > 600){
                $('#forms_container_new').css({ height: $(window).height()-208}); 
                $('#table_list').css({ height: 'auto'}); 
                $('.main-right').css({ height: $(window).height()}); 
                $('.email-list-box').css({ height: $(window).height()-124}); 
            }
            else{
                $('#table_list').css({ height: 'auto'}); 
                $('#forms_container_new').css({ height: $(window).height()});  
                $('.main-right').css({ height: $(window).height()});  
                $('.email-list-box').css({ height: $(window).height()});  
            }
        });  
        
       var $demo1 = $('table#table_list');
        $demo1.floatThead({
                scrollContainer: function($demo1){
                        return $demo1.closest('#forms_container_new');
                }
        });


         var $demo2 = $('table.table-manage-catt');
        $demo2.floatThead({
                scrollContainer: function($demo2){
                        return $demo2.closest('.manage-cat-table-height');
                }
        });
        
        
        var height = $("#scroll_doc").height();
        
         $("#manage_contacts").click(function(e) {
            $('#mail-recipient-list').appendTo('#set_privilege_up');
            $('#set_privilege_up').toggle();
            //close_right_panel();
            // $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-recipient-list").removeClass('hide');

            
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#mailing_list').find('.mailing_group mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);
            //e.preventDefault();
        });
        
        $(".btn-cancel-right").click(function() {
            var $demo1 = $('table#table_list');
            $demo1.floatThead();
            $demo1.floatThead('reflow');
            $('#mailing_list').find('input:checkbox').attr('checked', false);
            close_right_panel();
            $('#action').val("");
            $('.span4.main-right.category').removeClass('hide');
            $('.span4.main-right.upload_form').removeClass('hide');

        });
    });
    
    
    function editPrivilege(id, users, doc_id, elem){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $('#mail-recipient-list').appendTo('#mail-recipient');
        $(".check").children('td').css('background-color','#ffffff');
        $(elem).parent().parent().parent().children('td').css('background-color','#ccffff');

        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right #mail-recipient-list").removeClass('hide');

        $('#mailing_list').find('input:checkbox').attr('checked', false);
        if(users == '*'){
            $('#chk_public').attr('checked', false).trigger('click');
        } else {
            $('#chk_public').attr('checked', true).trigger('click');
            user_array = users.split(",");
            $('#mailing_list').find('input:checkbox').each(function(){
                if((ind = user_array.indexOf($(this).val())) != -1){
                    if(user_array[ind] == $(this).val())
                        $(this).attr('checked', true);
                }
            });

        }

        
        $('#btn_priv').html('{$translate.alter_privilege}');
        $('#action_common').val("3");
        $('#doc_id').val(doc_id);
    }
    
    
    function close_right_panel(){
        $(".check").children('td').css('background-color','#ffffff');
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right #mail-recipient-list").addClass('hide');
        $('.main-right #right_message_wraper, #left_message_wraper').html('');
    }
    
    function saveForm(){
        var error = 0;
        if($.trim($("#file").val()) == ''){
            $("#file").addClass('error');
            error = 1;
        }else{
            $("#file").removeClass('error');
        }
        if(error == 0){
//            $("#scroll_doc").html('<div class="popup_first_loading" style="height: 500px;"></div>');
            wrapLoader("#scroll_doc");
            $('#action').val("1");
            $("#form").submit();
        }
    }
    
    function downloadFile(document_id,filename){
        $.ajax({
            url:"{$url_path}documents/archive/",
            type:"POST",
            dataType: 'json',
            data: { 'document_id': document_id,'filename' : filename,'action': 'mark_read'},
            success:function(data){
                var file_array = filename.split('.');
                var extension  = file_array[(file_array.length-1)].toLowerCase();
                var image_type =['jpg','jpeg','png'];
                if(jQuery.inArray(extension, image_type) !== -1){
                    window.open('{$url_path}{$download_folder}/'+filename);
                }
                else{
                    window.open('http://docs.google.com/viewer?url={$url_path}{$download_folder}/'+filename+'&embedded=true');
                }




                // document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
            }
        });
        
    }

    function download_doc(filename){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
    }
    
    function deleteDocument(doc_id,file_name){
        $( "#dialog-confirm_delete" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                    $( this ).dialog( "close" );
                    wrapLoader("#scroll_doc");
                    $('#action_common').val("2");
                    $('#doc_id').val(doc_id);
                    $('#file_name_delete').val(file_name);
                    $("#common_form").submit();
                },
                "{$translate.no}": function() {
                        $( this ).dialog( "close" );
                }
            }
        });
    }

    function document_sign() {
        $('#action_common').val("document_sign");
        $("#common_form").submit();
    }

    function deleteSign(sign_id){
        $( "#dialog-confirm_delete" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                    $( this ).dialog( "close" );
                    wrapLoader("#scroll_doc");
                    $('#sign_id').val(sign_id);
                    $('#action_common').val("document_sign_delete");
                    $("#common_form").submit();
                },
                "{$translate.no}": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    }
   
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{$url_path}js/uploadjs/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="{$url_path}js/uploadjs/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="{$url_path}js/uploadjs/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="{$url_path}js/uploadjs/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="{$url_path}js/uploadjs/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{$url_path}js/uploadjs/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload.js"></script>


<!-- The File Upload processing plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="{$url_path}js/uploadjs/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="{$url_path}js/uploadjs/main.js"></script>
<script src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script>

<script>
    $(document).ready(function(){ 
    $('#table_list').css({ height: 'auto'}); 
    var fileCount = 0, fails = 0, successes = 0;
 
    $('#fileupload').fileupload({
        url: '{$url_path}documents/archive/'
    }).bind('fileuploaddone', function(e, data) {
      fileCount++;
      successes++;
      console.log('fileuploaddone');
      // alert("1");
      if (fileCount === data.getNumberOfFiles()) {
        console.log('all done, successes: ' + successes + ', fails: ' + fails);
        // refresh page
        location.reload();
      }
    }).bind('fileuploadfail', function(e, data) {
        // this is not upload fail // shaju
      fileCount++;
      fails++;
      
      console.log('fileuploadfail');
      if($("#action").val() == "1"){
          location.reload();
      }
      {*if (fileCount === data.getNumberOfFiles()) {
        console.log('all done, successes: ' + successes + ', fails: ' + fails);
        // refresh page
        location.reload();
      }*}
    }).on('fileuploadsubmit', function(e, data) {
        //alert("1"); 
        $("#action").val("1");
        select_multi_recipients();
    });                                                                                                                                                                                                                                                         

    $("#recipient_check_all, .check_recipient_groups, #chk_public").click(function(e){
            e.stopPropagation();
    });
    $('#mail-recipient-list #recipient_check_all').click(function () {
        $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
        $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    $('#mail-recipient-list .check_recipient_groups').click(function () {
        $(this).parents('.mailing_group').find('.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
    });
    $('#chk_public').click(function () {
        if(this.checked){
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false).attr('disabled', 'disabled');
            $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false).attr('disabled', 'disabled');
            $('#recipient_check_all').attr('checked', false).attr('disabled', 'disabled');
        } else {
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').removeAttr('disabled');
            $('#mailing_list').find('.mailing_group .mail_grup_employees').find('.check_recipient_emp:checkbox').removeAttr('disabled');
            $('#recipient_check_all').removeAttr('disabled');
        }
    });
});
    
    function select_multi_recipients(){
        
            var is_public_visibility = $('#chk_public:checkbox:checked').val();
            var is_public_visibility_value = (is_public_visibility ? true : false);
            if(is_public_visibility_value){
                $("#user_privilege").val('*');
                $("#user_privilege_add").val('*');
                close_right_panel();
            }
            else{
                var selected_recipients = $('#mail-recipient-list input:checkbox:checked.check_recipient_emp').map(function () {
                    return this.value;
                }).get(); 
                if(selected_recipients.length > 0){
                    $("#user_privilege").val(selected_recipients);
                    $("#user_privilege_add").val(selected_recipients);
                    close_right_panel();
                }
            }
            if($('#action_common').val() == 3){
                $("#common_form").submit();
            }
        
    }

    function category_form(){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        var $demo2 = $('table.table-manage-catt');
        $demo2.floatThead();
        $demo2.floatThead('reflow');
        $('.category').removeClass('hide');
        $("#main_container").css('width', '55%');
        $('.category').show();
        $('.upload_form').hide();
    }

    function upload_form(id){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $('#upfile_'+id).prop('selected','selected');
        $('.upload_form').removeClass('hide');
        $("#main_container").css('width', '55%');
        $('.upload_form').show();
        $('.category').hide();
        var val = $('.focus_btn[selection="yes"]').val();
        $('select option[value='+val+']').attr("selected",true);
    }

    $('.btn-cancel-category').click(function(){
         $('.tbl-responsive').css({ height: $(window).height()-140});
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $("#main_container").css('width', '99%');
        $('.category').hide();
        $('#add_new_category_div').hide();
    });

    $('.btn-cancel-upload').click(function(){
        var $demo1 = $('table#table_list');
        $demo1.floatThead();
        $demo1.floatThead('reflow');
        $("#main_container").css('width', '99%');
        $('.upload_form').hide();
        $('#set_privilege_up').hide();
    });

    function focus_btn(id){
            $('#move_category').hide();
            // $('.folder').css("font-size","35px");
            // $('.folder').removeClass('icon-folder-open');
            // $('.folder').addClass('icon-folder-close')
            $('#category_icon'+id).css("font-size","50px");
            // $('#category_icon'+id).addClass('icon-folder-open');
            $('.focus_btn').attr('selection','no');
            $('#category'+id).attr('selection','yes');
            $('#category_select option[value='+id+']').attr("selected",true);

            document.location.href = "{$url_path}documents/archive/"+id+'/';
           
            // $('#category0').append('<input type=hidden name=folder_id value='+id+'>');
            // $('#action_common').val('5');
            // $('#common_form').submit();




                        //..............ajax old method...............//
            // $.ajax({
            //     url:"{$url_path}documents/archive/",
            //     type:"POST",
            //     dataType: 'json',
            //     data: { 'key':id,'action': 'category_filter' },
            //     success:function(data){
            //         // console.log(data);
            //         $('#table_body').empty();
            //         jQuery.each(data, function(index, value) {
            //                 var html = '<tr class=check>\n\
            //                 <td><input type="checkbox" name="categorys_to_move[]" onclick="checkbox_check()" value='+value.id+'></td>\n\
            //                 <td><div class=skilldocument_pdf><a href="javascript:void(0)" onclick="downloadFile(\''+value.id+'\',\''+value.file_name+'\')"">'+value.file_name+'</a></div></td>\n\
            //                 <td><div>'+value.last_name+' '+value.first_name+'</div></td>\n\
            //                 <td class=center><div>'+value.date+'</div></td>\n\
            //                 <td><div><a class="btn btn-danger span12" href="javascript:void(0);" title="Delete" onclick="deleteDocument(\''+value.id+'\', \''+value.file_name+'\')">\n\
            //                 <i class="icon-trash"></i>\n\
            //                 </a></div></td>\n\
            //                 <td class=center><div><a class="btn btn-danger span12" href="javascript:void(0);" title="Edit" onclick="editPrivilege(\''+value.id+'\', \''+value.users+'\', \''+value.id+'\',this)">\n\
            //                                                     <i class="icon-fixed-width icon-cogs"></i>\n\
            //                                                 </a></div></td>\n\
            //                 </tr>';
            //                 $('#table_body').append(html);
            //     });
            //     }
            // });
         
    }

    function delete_category(id){
        $( "#dialog-confirm_delete" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            $('#action_cat').val("1");
                             $('#delete_category_id').val(id);
                            $("#category_form").submit();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                            }
                    }
            });
    }
    function checkbox_check(id){
        if($('#common_form input[type=checkbox]:checked').length > 0){
            $('#move_category').show();
            $('#option_category'+id).prop('disabled','disabled');
        }
        else{
            $('#move_category').hide();
        }
    }
    function move_category_confirm(){
        $( "#dialog-confirm_move" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        $('#action_common').val('4');
                        $('#common_form').submit();
                    },
                "{$translate.no}": function() {
                        $( this ).dialog( "close" );
                        $('#option_category_move').attr('selected','true');
                    }
                }
        });
    }

    function edit_category(id,elem,name){
        var element = $(elem).parent().prev();
        var root_name = '{$translate.root}';
        element.html('');
        var parent_change = '<select name = "parent_change['+id+']" style="width:206px;"><option id="parent_change_0" value="0">'+root_name+'</option></select>';
        element.append('<div  id=edit_category_div'+id+' style = "height:55px;"><input type=text value='+name+' name=edit_category>\n\
            <button class="btn btn-sm btn-success pull-right"   type="button" onclick="edit_category_save('+id+')">{$translate.save}</button>\n\
            <input type=hidden name=edit_category_id id=edit_category_id value=>\n\
            <button class="btn btn-sm btn-danger pull-right " onclick="cancel_edit(\''+id+'\',\''+name+'\')"   type="button" style="margin-right:1px;">{$translate.cancel}</button>\n\
            '+parent_change+'\n\
            </div>');
        // $('#edit_category_div'+id).find('#parent_change_0')
        var category_names = {$all_category|json_encode};
        category_names = category_names.sort((a, b) => parseFloat(a.parent_category) - parseFloat(b.parent_category));
        // console.log(category_names);
        $.each(category_names, function (index, value) {
            if(value.parent_category == 0 ){
                $('#edit_category_div'+id).find('#parent_change_0').after('<option value ='+value.id+' id = parent_change_'+value.id+'>&nbsp&nbsp&nbsp'+value.name+'</option>');
            }
            else{
                for (var i = 0; i <index; i++) {
                    if(value.parent_category == category_names[i].id){
                         var length = $('#parent_change_'+value.parent_category).text().length;
                         var space  = "&nbsp".repeat(length);
                         $('#edit_category_div'+id).find('#parent_change_'+value.parent_category).after('<option value ='+value.id+' id = parent_change_'+value.id+'>'+space+''+value.name+'</option>');
                    }
                }
            }
        });

    }

    function cancel_edit(id,name){
        $('#edit_category_div'+id).parent().text(name);
        $('#edit_category_div'+id).remove();
        // element.text(name);
    }

    function edit_category_save(id) {
        $('#edit_id').val(id);
        $('#action_cat').val('2');
        $("#category_form").submit();
    }

    function backform(url) {
        var id_of_folder = $(".icon-folder-open").attr('id');
        if(id_of_folder == 'category_icon0'){
            window.location = url+'message/center/';
        }
        else{
            window.history.back();
        }
    }

    $('#add_new_category').click(function(event){
        event.preventDefault();
        $('#add_new_category_div').show();
        $('.tbl-responsive').css({ height: $(window).height()-292});
    });

    function goto_page(id,url){
        // console.log(id,url);
        window.location = url+'documents/archive/'+id+'/';
    }




</script>    
{/block}
{block name="content"}
    <div style="display:none; padding-top: 20px;padding-left: 13px;" title="{$translate.confirm}" id="dialog-confirm">
        <p><span style="float:left; margin:0 7px 20px 0;" class="error_msg_icon"></span>{$translate.want_save_changes}</p>
    </div>
    <div style="display:none;" title="{$translate.confirm}" id="dialog-confirm_delete">
        <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span>{$translate.want_delete}</p>

    </div>

    <div style="display:none;" title="{$translate.confirm}" id="dialog-confirm_move">
        <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span>{$translate.do_you_want_to_move_file}</p>

    </div>

    <div style="display:none;" id="dialog_popup" class="clearfix"></div>
    <div style="display:none;" id="dialog_hidden" class="clearfix"></div>
    <form method="POST" id="common_form" action="">
        <div class="row-fluid" id="main_container">
        <div class="span12 main-left">


            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <!-- <form action="" method="post" name="form" id="fileupload" enctype="multipart/form-data" > -->
                
            {*<div class="row-fluid" style="margin: 20px 0 0 0;">
                <div  class="widget" style="margin: 0 !important;">
                    <div style=" padding: 20px;" class="widget-header span12" >
                        <div class="row-fluid">
                            <div class="span6">
                                <div id="file_input">{$translate.upload_document} <input name="file[]" type="file" style="margin-left:5px;" id="file" multiple=""><input type="button" id="manage_contacts" value="{$translate.privilge_doc_archive}"></div>
                                <div id="file_description" style="font-size: 10px;margin:5px 0; "><span>{$translate.document_archive_upload_desc}</span><!--<br><span>file size : lessthan 2MB</span>--></div>

                            </div>
                            <div class="span6">
                                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                    <a class="save  btn btn-default btn-normal pull-right"  href="javascript:void(0)" onclick="saveForm()"><span class="btn_name"><i class="icon-save"></i> {$translate.save}</span></a>
                                    <a class="btn btn-default btn-normal pull-right" style="margin-right:5px;" href="{$url_path}message/center/"><span class="btn_name"><i class="icon-arrow-left"></i> {$translate.back}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>*}

            <!-- <div class="row fileupload-buttonbar" style="margin-top: 10px;">
            <div  --><!-- class="col-lg-9"> -->
                <!-- The fileinput-button span is used to style the file input field as button -->
                <!-- <span class="btn btn-success fileinput-button" style="margin: 10px;">
                    <i class="icon icon-plus"></i>
                    <span>{$translate.add_files}</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start" id="up">
                    <i class="icon icon-upload"></i>
                    <span>{$translate.start_upload}</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon icon-remove"></i>
                    <span>{$translate.cancell_upload}</span>
                </button>
                
                <button type="button" class="btn btn-danger" id="manage_contacts">
                    <i class="icon icon-cog"></i>
                    <span>{$translate.privilge_doc_archive}</span>
                </button>
                 -->
                <!-- {*<input type="checkbox" class="toggle">*} -->
                <!-- The global file processing state -->
                <!-- <span class="fileupload-process"></span>
            </div>
            <div class="col-lg-3 fileupload-progress fade"> -->
                <!-- The global progress bar -->
                <!-- <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div> -->
                <!-- The extended global progress state -->
                <!-- <div class="progress-extended">&nbsp;</div>
            </div>    
        </div>   -->   

        <!-- <div class="category_listing span12">
            {foreach $category_names AS $key=>$category_name}
                <button class="btn btn-success focus_btn" id="category{$key}" name="category_type" value="{$category_name.name}" onclick="focus_btn('{$key}')" type="submit">{$category_name.name}</button>
                <!-- <input type="hidden" name="category_type" id="categorytype{$key}" value="{$category_name.name}"> -->
           <!--  {/foreach}
        </div> --> 


        
        <!-- The table listing the files available for upload/download -->
       <!--  <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
        <script id="template-upload" type="text/x-tmpl">
            {literal}
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="icon icon-upload"></i>
                    <span>Ladda upp</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon icon-ban-circle"></i>
                    <span>Avbryt</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
{/literal}
</script>
<!-- The template to display files available for download -->
<!-- <script id="template-download" type="text/x-tmpl">

</script> -->        
                
 <!-- main-left -->        
            <div class="span12" style="margin:5px 0px 0px 0px;">

                    <div class="row-fluid">
                        <div class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                                <h1>{$translate.Document_Archieves}</h1>
                        </div>
                            <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                {if $privileges_mc.document_archive eq 1}
                                    <button class="btn btn-default pull-right" onclick="category_form()" type="button" style="margin-left:5px;">{$translate.Manage_Category}</button>
                                    {if $category_id eq -1 && ($login_user_role == 1 || $login_user_role == 6)}
                                        <button class="btn btn-default pull-right" type="button" onclick="upload_form('{$document.category}')" >{$translate.Upload_Files}</button>
                                    {else if $category_id neq -1}
                                        <button class="btn btn-default pull-right" type="button" onclick="upload_form('{$document.category}')" >{$translate.Upload_Files}</button>
                                    {/if}
                                    <select name="move_category" class="pull-right" style="display: none;margin-left:5px;" id="move_category" onchange="move_category_confirm()" >
                                        <option selected="true" disabled="disabled" id="option_category_move">{$translate.Move_Category}</option>
                                        <option value="0"  id="option_category0">{$translate.root}</option> 
                                        <!-- {foreach $category_names AS $key=>$category_name}
                                            <option value="{$category_name.id}" id="option_category{$category_name.id}" > {$category_name.name}</option>
                                        {/foreach} -->
                                    </select>
                                {/if}
                                    <button onclick="backform('{$url_path}')" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> Tillbaka</button>
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid" style="margin-top: 5px;">
                        <div class="widget-header span12">
                            <!-- <div class="span12"><h1>{$translate.path}</h1></div> -->
                            <!-- <div class="span12 day-slot-wrpr-header-left span6"> -->
                                    <label><h1>{$translate.path}</h1></label>
                                    <span>
                                        {foreach $path_name AS $key => $value}
                                           <a href="javascript:void(0);" onclick="goto_page('{$key}','{$url_path}')"> {if $key == 0 }{$translate.root}/{else} {$value}/ {/if}</a>
                                        {/foreach}
                                    </span>
                                    {if $category_id eq -1 && $sign_flag}
                                        <div class="pull-right day-slot-wrpr-header-left span2" style="padding: 5px;">
                                            <a style="float: right; width: 95px !important; height: 30px !important;" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in" href="javascript:void(0)" onclick="document_sign()"></a>
                                        </div>
                                    {/if}
                            <!-- </div> -->
                        </div>
                    </div>
                   

                <div class="span12 widget-body-section input-group">
                    
                    <!-- <div class="row-fluid">
                        <iframe data={$url_path}{$download_folder}/A11.pdf src='https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true' frameborder='0'></iframe> 

                        <div class="category_listing span12" style="padding:0 0 10px 5px;">
                            <ul style="display: inline;">
                                {if $count_of_categorys[0].count > 0 || $privileges_mc.document_archive eq 1 }
                                    <li style="display: inline;">
                                        <a class="btn no-bg focus_btn" id="category0"  value="0" onclick="focus_btn(0)" type="button" selection="" ><i  id="category_icon0" {if $category_id eq 0} class="icon-folder-open folder" style="font-size: 50px;" {else} class="icon-folder-close folder" style="font-size: 35px;" {/if} ></i><span style="display: block;">Root</span></a>
                                    </li>
                                {/if}
                                {foreach $category_names AS $key=>$category_name}
                                    {if $count_of_categorys[$key+1].count > 0 || $privileges_mc.document_archive eq 1 }
                                        <li style="display: inline;" >
                                            <a class="btn no-bg focus_btn" id="category{$category_name.id}"   value="{$category_name.id}" onclick="focus_btn('{$category_name.id}')" type="button" selection=""><i id="category_icon{$category_name.id}" {if $category_id eq {$category_name.id}} class="icon-folder-open folder" style="font-size: 50px;" {else} class="icon-folder-close folder" style="font-size: 35px;" {/if}></i><span style="display: block;">{$category_name.name}</span></a>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul> 
                        </div>
                    </div> -->
                    <div class="row-fluid">
                        <!-- <ifsrame data={$url_path}{$download_folder}/A11.pdf src='https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true' frameborder='0'></iframe>  -->

                        <div class="category_listing span12" style="padding:0 0 0px 5px;">
                            <ul style="display: inline;">
                                <!-- {if $count_of_categorys[$key+1].count > 0 || $privileges_mc.document_archive eq 1 } -->
                                    <li style="display: inline;">
                                        <a class="btn no-bg focus_btn" id="category0"  value={$category_id} onclick="focus_btn('{$category_id}')" type="button" selection="" style="padding: 0px;"><i  id="category_icon{$category_id}" class="icon-folder-open folder" style="font-size: 50px;" ></i><span style="display: block;">{if $category_names['parent']['id'] == 0} {$translate.root} {else}{$category_names['parent']['name']}{/if}</span></a>
                                    </li>

                                <!-- {/if} -->
                                
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span1">
                        </div>
                        <div class="span11">
                            {if $login_user_role == 1 || $login_user_role ==6}
                                {foreach $category_names['child'] AS $key=>$category_name}
                                     {*if $privileges_mc.document_archive eq 1*}
                                        <li style="display: inline;" >
                                            <a class="btn no-bg focus_btn" id="category{$category_name.id}"   value="{$category_name.id}" onclick="focus_btn('{$category_name.id}')" type="button" selection=""><i id="category_icon{$category_name.id}" class="icon-folder-close folder" style="font-size: 35px;" ></i><span style="display: block;">{$category_name.name}</span></a>
                                        </li>
                                     {*/if*}
                                    <!-- {if $count_of_categorys[$key+1].count > 0 || $privileges_mc.document_archive eq 1 } -->
                                       
                                    <!-- {/if} -->
                                {/foreach}
                            {else}
                                {foreach $category_names['child'] AS $key=>$category_name}
                                     {*if $privileges_mc.document_archive eq 1*}
                                        {if $category_name.id|in_array:$last_parent_id}
                                            <li style="display: inline;" >
                                                <a class="btn no-bg focus_btn" id="category{$category_name.id}"   value="{$category_name.id}" onclick="focus_btn('{$category_name.id}')" type="button" selection=""><i id="category_icon{$category_name.id}" class="icon-folder-close folder" style="font-size: 35px;" ></i><span style="display: block;">{$category_name.name}</span></a>
                                            </li>
                                        <!-- {if $count_of_categorys[$key+1].count > 0 || $privileges_mc.document_archive eq 1 } -->
                                           
                                        <!-- {/if} -->
                                        {/if}
                                    {*/if*}
                                {/foreach}
                            {/if}
                            </ul> 
                        </div>
                    </div>

                <div class="row-fluid">

                    <div id="forms_container_new" style=" max-height: 408px;">
                        <!--- edit here 17/05/2012 -->

                        <!-- edit here -->
                        <div class="employe_skill" >
                         <!--   <div class="skilname"><div class="skill_document" style="width: 225px">{$translate.document}</div> <div class="skill_document" style="width: 225px">{$translate.employee}</div><div class="skill_document" style="width: 225px">{$translate.dates}</div> </div>-->
                            <div class="table-responsive">
                                <table id="table_list" name="table_list" class="table table-left table-bordered table-condensed table-hover table-responsive table-primary no-margin "  >
                                    <thead>
                                        <tr>
                                            <th style="width: 2%;"></th>
                                            <th>{$translate.document}</th>
                                            <th>{$translate.mc_da_doc_owner}</th>
                                            {if $category_id eq -1}<th>{$translate.signed}</th>{/if}
                                            <th style="width:13%;">{$translate.dates}</th>
                                            <th style="width:5%;">{$translate.mc_da_delete_head}</th>
                                            {if $category_id neq -1}
                                                <th style="width:5%;">{$translate.mc_da_edit_head}</th>
                                            {/if}
                                            {*<th>{$translate.privileged_users}</th>*}
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                        {foreach $documents AS $document}
                                            <tr class="check" {* {if $document.employee != $login_user && $document.document_id == ''}style="font-weight: bold;"{/if} *}>
                                                <td>
                                                    <input type="checkbox" name="categorys_to_move[]" onclick="checkbox_check('{$document.category}')" value="{$document.id}" >
                                                </td>

                                                <td>
                                                    <div class="skilldocument_pdf notification-info-customer span6">
                                                        <a href="javascript:void(0)" onclick="downloadFile('{$document.id}','{$document.file_name}')" title="{$document.file_name}">{$document.file_name}</a>
                                                    </div> 
                                                    <div class="pull-right">
                                                       <button type="button" class="btn btn-xs btn-primary" title="Download" onclick="download_doc('{$document.file_name}')"> {$translate.download} <i class="icon-download" ></i></button>
                                                    </div>
                                                    {if $document.users == '*'}<div class="notification-info-customer span3"><div class="label label-warning" style="display: inline-block;max-width: 330px;height:15px;">{$translate.public}</div></div>{/if}
                                                    {if $login_user_role == 7 || $login_user_role == 1}
                                                        {if $document.users != '' and $document.users != '*'}<div class="notification-info-customer span3" ><div class="label label-warning" title= "{foreach $document.priv_users AS $value} {$value|substr:0:7} {/foreach}" style="display: inline-block;max-width: 330px;height:15px;"> {foreach $document.priv_users AS $value} {$value|substr:0:7} {/foreach}</div></div>{/if}
                                                    {/if}

                                                </td>
                                               
                                                <td>
                                                    <div >
                                                        {$document.last_name} {$document.first_name}
                                                    </div>
                                                </td>
                                                {if $category_id eq -1}
                                                    <td>
                                                        {if $document.signed_date}
                                                        <div class="pull-right">
                                                        <a href="javascript:void(0);" style="float: right;" onclick="deleteSign({$document.signed_id})" class="btn btn-normal"><span class="icon-trash"></span></a>
                                                        </div>
                                                        <div class="pull-right">
                                                            {$document.signed_date} through BankID&nbsp;&nbsp;<img src="{$url_path}images/banck_id_signing.jpg" style="height: 18px;">
                                                        </div>
                                                        {/if}
                                                    </td>
                                                {/if}
                                                <td>
                                                    <div>
                                                        {$document.date} </div> 
                                                </td>
                                                {*<td>
                                                    {if $login_user_role == 1 || $document.employee == $login_user}
                                                    <div class="center" >
                                                        {$document.users} </div> 
                                                    {/if}    
                                                </td>*}
                                                
                                                <td class="center">
                                                    {if $document.employee == $login_user || $login_user_role == 1 || $login_user_role == 6 || $login_user_role == 7}  
                                                    <div>
                                                        <a class="btn btn-danger span12" href="javascript:void(0);" title="{$translate.mc_da_delete_tool_tip}" onclick="deleteDocument('{$document.id}', '{$document.file_name}')">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </div>
                                                    {/if}        
                                                </td>
                                                {if $category_id neq -1}
                                                    <td class="center">
                                                        {if $document.employee == $login_user || $login_user_role == 1 || $login_user_role == 6 || $login_user_role == 7}
                                                        <div>

                                                            <a class="btn btn-danger span12" href="javascript:void(0);" title="{$translate.mc_da_edit_tool_tip}" onclick="editPrivilege('{$document.id}', '{$document.users}', '{$document.id}',this)">
                                                                <i class="icon-fixed-width icon-cogs"></i>
                                                            </a>
                                                        </div>
                                                        {/if}
                                                    </td>
                                                {/if}
                                            </tr>
                                        {foreachelse}
                                            <tr>
                                                <td colspan="6">
                                                    <div class="message">{$translate.no_data_available}</div>
                                                </td>
                                            </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                            <input type="hidden" id="action_common" name="action_common">
                            <input type="hidden" value="" id="sign_id" name="sign_id">
                            <input type="hidden" value="" id="doc_id" name="doc_id">
                            <input type="hidden" value="" id="file_name_delete" name="file_name_delete">
                            <input type="hidden" value="" id="user_privilege" name="user_privilege">

                    </div>
                </div>
                </div>
            </div>
            <!-- </form>                         -->
        </div>        
                                    
    <div class="span4 main-right hide" id="mail-recipient" style="padding: 0; border:0; background: none; overflow: hidden">
        <div class="row-fluid hide" id="mail-recipient-list">
            <div class="span12 addnew-mail-visible" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span5 day-slot-wrpr-header-left span6">
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right" id="btn_priv"  onclick="select_multi_recipients()" style="" type="button"><i class=' icon-ok'></i> {$translate.inserts}</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-arrow-left'></i> {$translate.cancel}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group email-list-box">
                        <div class="row-fluid">
                            <div class="span12 no-ml" id="mailing_list" style="width: 100% !important;">
                                <div class="span12" id="options_panel">
                                    <label class="pull-left"><input type="checkbox" value="public" id="chk_public" name="chk_public" class="mr" title="{$translate.public}"> {$translate.public}</label>
                                    <label class="pull-right"><input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all" class="mr" title="{$translate.check_all}"> {$translate.check_all}</label>
                                </div>
                                
                                    {foreach from=$employees_group item=employee}
                                        {if $employee.customer_name != 'ALL'}

                                            <div class="mailing_group span12 no-ml" >

                                            <div class="mail_grup_customer span12" style="background: #BFF4FF;  padding: 0px 0 0 10px !important; border-bottom:solid 1px #fff;">
                                                <div style="padding: 10px 0px 0px !important; min-height: 33px;">
                                                    <input type="checkbox" value="{$employee.customer_username}" name="cch_{$employee.customer_username}" id="cch_{$employee.customer_username}" class="pull-left check_recipient_groups check_recipient_emp">
                                                    <label for="cch_{$employee.customer_username}" class="pull-left" style="margin-left: 10px;width: 90%;">{$employee.customer_name}</label>
                                                </div>
                                            </div>   

                                            <div  class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt" style="background: #DEE793; padding: 10px 10px 0px !important;">
                                                {foreach from=$employee.employees_customer item=empl}
                                                    <div class=" span12 no-ml" style="border-bottom:solid 1px #fff;padding: 0px 0px 0px !important;min-height: 24px;margin-bottom: 5px;">
                                                        <input type="checkbox" value="{$empl.username}-{$employee.customer_username}" class="pull-left check_recipient_emp" id="cch_{$empl.username}_{$employee.customer_username}" name="cch_{$empl.username}_{$employee.customer_username}">

                                                        <label class="pull-left" style="margin-left: 10px; width: 90%;" for="cch_{$empl.username}_{$employee.customer_username}">{$empl.first_name} {$empl.last_name} </label>
                                                    </div>
                                                {/foreach}

                                            </div>
                                            </div>    
                                        {/if}
                                    {/foreach}
                                
                            </div>
                            {if $login_user_role eq 1 or $login_user_role eq 6}
                                <div class="mailing_group span12 no-ml">
                                    <ul class="span12 no-ml">
                                        <li class="mail_grup_customer_unasigned span12">
                                            <label for="cch_unassigned_emps" class="pull-left">{$translate.unassigned_employees}</label>
                                            <input type="checkbox" value="" name="cch_unassigned_emps" id="cch_unassigned_emps" class="pull-right check_recipient_groups">
                                        </li>            
                                        <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                            <ul class="span12">
                                                {foreach from=$employees_group item=employee}
                                                    {if $employee.customer_name == 'ALL'}
                                                        <li class=" span12 no-ml">
                                                            <label class="pull-left" for="cch_{$employee.employees.username}">{$employee.employees.first_name} {$employee.employees.last_name}</label>
                                                            <input type="checkbox" value="{$employee.employees.username}" class="pull-right check_recipient_emp" id="cch_{$employee.employees.username}" name="cch_{$employee.employees.username}">
                                                        </li>
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
</form>
                        <!-- main right create category form begins -->
            <form method="POST" action="" id="category_form">
                <div class="span4 main-right category" style="width: 45%;display: none;">
                    <div class="row-fluid">
                            <div class="span12 sigin-box" style="margin-left: 0px;">
                                <div style="margin: 0px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span6 day-slot-wrpr-header-left span6">
                                            <h1 style="">{$translate.Manage_Category}</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-cancel-category" type="button" style="margin-left: 2px;">{$translate.back}</button>
                                            <button class = "btn btn-default pull-right mr-3" id="add_new_category">
                                                {$translate.add_new_category}
                                            </button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section">


                                        <div id="add_new_category_div" class="row-fluid" style="margin-bottom: 10px;display: none;">
                                            <div style="margin: 0px ! important;" class="widget">
                                                <div class=" widget-header span12">
                                                    <div class="span4 day-slot-wrpr-header-left span6">
                                                        <h1>{$translate.Create_Category}
                                                    </div>
                                                    <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                                        <button class="btn btn-default btn-normal pull-right "  name="category_save" type="submit"> {$translate.save}</button>
                                                    </div>
                                                </div>
                                                <div class="span12 widget-body-section">
                                                    <div style="margin: 10px 0px 0px ! important;" class="row span12">
                                                        <label style="float: left;" >{$translate.select_parent}</label>
                                                        <select style="margin-left: 5px;width: 206px;" name="parent_cat">
                                                            <option data-space = 2  id="parent_0" value="0" >{$translate.root}</option>
                                                        </select>
                                                    </div>
                                                    <div class="row span12" style="margin: 10px 0px 0px ! important;">
                                                        <label  style="float: left;" >{$translate.Category} </label>
                                                        <input type="text" name="category" id="category" class="ml" style="margin-left: 33px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row-fluid manage-cat-table-height">
                                                  <div class="tbl-responsive cat-height" style="overflow-y: auto;overflow-x: hidden;">
                                                {if $all_level_child_names|@count gt 0}
                                                    <table class="table table-bordered table-condensed table-hover table-primary no-margin table-manage-catt" style="table-layout: auto;" >
                                                        <thead>
                                                            <th>{$translate.Category}</th>
                                                            <th>{$translate.edit}</th>
                                                            <th>{$translate.delete}</th>
                                                        </thead>                                              
                                                        <tbody>
                                                             {foreach $all_level_child_names AS $key=>$category_name}
                                                                    <tr>
                                                                        <td>{$category_name.name}</td>
                                                                        <td style="width: 10%"><a class="btn btn-danger span12" name="edit_category_btn"  title="Edit" onclick="edit_category('{$category_name.id}',this,'{$category_name.name}')"><i class="icon-edit"></i></a></td>
                                                                        <td style="width: 10%"><a class="btn btn-danger span12" name="delete_category_btn"  title="Delete" onclick="delete_category('{$category_name.id}')"><i class="icon-trash"></i></a></td>
                                                                    </tr>
                                                            {/foreach}
                                                        </tbody>
                                                    </table>
                                                {/if}
                                            </div>
</div>
                                    </div>
                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                    </div>
                </div>
                        <input type="hidden" name="action_cat" id="action_cat">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <input type="hidden"  id="delete_category_id" name="delete_category_id" value="">

            </form>

            <form action="" method="post" name="form" id="fileupload" enctype="multipart/form-data" >
                <div class="span4 main-right upload_form" style="width: 45%;display: none;">
                        <div class="row-fluid">
                            <div class="span12 sigin-box" style="margin-left: 0px;">
                                <div style="margin: 0px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span6 day-slot-wrpr-header-left span6">
                                            <h1 style="">{$translate.Upload_Files}</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-cancel-upload" type="button">{$translate.back}</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section">
                                        <div class="row-fluid">
                                             <select name="category_select" id="category_select">
                                                <option id="upfile_0" value="0" >{$translate.root}</option>
                                                 <!--{foreach $category_names AS $key=>$category_name}
                                                    {if ($login_user_role eq 1 or $login_user_role eq 6) && $category_id eq -1}
                                                        <option value="{$category_name.id}" {if $category_name.id eq $category_id} selected="true" {/if}>{$category_name.name}</option>
                                                    {else if $category_id neq -1}
                                                        <option value="{$category_name.id}" {if $category_name.id eq $category_id} selected="true" {/if}>{$category_name.name}</option>
                                                    {/if}
                                                 {/foreach}-->
                                             </select>
                                        </div>

                                        <div class="row-fluid">
                                            <div class="row fileupload-buttonbar" style="margin-top: 10px;">
                                                <div class="col-lg-12">
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                         <span class="btn btn-success fileinput-button no-ml no-mr mb" style="margin: 10px;">
                                                            <i class="icon icon-plus"></i>
                                                            <span>{$translate.add_files}</span>
                                                            <input type="file" name="files[]" multiple>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary start no-ml" id="up">
                                                            <i class="icon icon-upload"></i>
                                                            <span>{$translate.start_upload}</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning cancel no-ml">
                                                            <i class="icon icon-remove"></i>
                                                            <span>{$translate.cancell_upload}</span>
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-danger no-ml" id="manage_contacts">
                                                            <i class="icon icon-cog"></i>
                                                            <span>{$translate.privilge_doc_archive}</span>
                                                        </button>
                                                        
                                                        {*<input type="checkbox" class="toggle">*}
                                                        <!-- The global file processing state -->
                                                        <span class="fileupload-process"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row-fluid">
                                                         <!-- The table listing the files available for upload/download -->
                                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                                <script id="template-upload" type="text/x-tmpl">
                                                    {literal}
                                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                                            <tr class="template-upload fade">
                                                <td>
                                                    <span class="preview"></span>
                                                </td>
                                                <td>
                                                    <p class="name">{%=file.name%}</p>
                                                    <strong class="error text-danger"></strong>
                                                </td>
                                                <td>
                                                    <p class="size">Processing...</p>
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                                    
                                                </td>
                                                <td>
                                                    {% if (!i && !o.options.autoUpload) { %}
                                                        <button class="btn btn-primary start" disabled id="up" style="margin-bottom:5px;">
                                                            <i class="icon icon-upload"></i>
                                                            <span>Ladda upp</span>
                                                        </button>
                                                    {% } %}
                                                    {% if (!i) { %}
                                                        <button class="btn btn-warning cancel" style="margin-bottom:5px;">
                                                            <i class="icon icon-ban-circle"></i>
                                                            <span>Avbryt</span>
                                                        </button>
                                                    {% } %}
                                                </td>
                                            </tr>
                                        {% } %}
                                        {/literal}
                                        </script>
                                         
                                        <!-- The template to display files available for download -->
                                        <script id="template-download" type="text/x-tmpl">

                                        </script>

                                            <input type="hidden" value="" id="action" name="action">
                                             <input type="hidden" value="" id="user_privilege_add" name="user_privilege_add">
                                        </div>

                                        <div class="row-fluid">
                                             <div id="set_privilege_up"  style="display: none;">
                                             </div>
                                        </div>

                                    </div>
                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



               
                  
{/block}