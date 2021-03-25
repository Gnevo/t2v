{block name='style'}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" type="text/css" /><!-- DATE PICKER -->
    <style type="text/css" >
        #table_list tr.active .note_number{ border-left: 5px solid;}
        #table_list tr.bolding_letters{ font-weight: bold;}
        
        #table_list.open-note-mode tr.active{ opacity: 1}
        #table_list.open-note-mode tr:not(.active){ opacity: 0.5}
        
        .btn-group{ white-space:normal !important;}
        .btn-visibility-types{ /*background: #90DCEB;*/border: 1px solid #116296; text-shadow:none !important; color: #000 !important;font-weight: 100;}
        .btn-visibility-types.active, .btn-visibility-types:hover{ background:#fff !important; color:#000 !important; }

        .contracts img, .settings img{ max-width: inherit; }
    </style>
{/block}

{block name="script"}
<script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript" src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    $(window).resize(function(){
      $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    });

    $(document).on('keyup', "#search-section #cmb_month, #search-section #cmb_year, #search-section #cust_search_list, #search-section #txt_search_word", function(e) {
        
        var code = e.keyCode || e.which;
         if(code == 13) { //Enter keycode
            get_report();
         }
    });
    
    $(".btn-cancel-right").click(function() {
        close_right_panel();
        $('#table_list tr.note_row').removeClass('active');
        $('#table_list').removeClass('open-note-mode');
        $('#delete_btn,#edit_btn').show();
    });
    
    $(".book-open").click(function() {
        close_right_panel();
        // $('.sapn12 .main-left').width("50%");
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right .view-notes-visible").removeClass('hide');
        $(".main-right .view-notes-visible #view_note_content_wrpr").addClass('hide');

        var note_id = $(this).attr('data-id');
        var current_usr =$('#current_usr').val();
        $('#note_id').val(note_id);
        $(".view-notes-visible #opened_note_id").val('');
        wrapLoader(".main-right");
        $.ajax({
            async   :false,
            url     :"{$url_path}ajax_note_actions.php",
            data    : { "note_id" : note_id },
            dataType: 'json',
            type    :"POST",
            success:function(data){
                    $('#delete_btn,#edit_btn').show();
                    // console.log(data);

                    if(data.notes_detail.editable == 1 || current_usr == data.notes_detail.created_user){
                        console.log(current_usr);
                        $('#delete_btn,#edit_btn').show();
                    }
                    else{
                        $('#delete_btn,#edit_btn').hide();
                    }
                    if(data.transaction_flag !== undefined && data.transaction_flag){
                        $(".main-right .view-notes-visible #view_note_content_wrpr").removeClass('hide');
                        
                        //hightlight opened-note from table list
                        $('#table_list').addClass('open-note-mode');
                        $('#table_list tr.note_row').removeClass('active');
                        $('#table_list tr#status_'+note_id).addClass('active');
                        
                        //remove unread indication * if exists
                        $('#table_list tr#status_'+note_id).find('.unread_indication').remove();
                        $('#table_list tr#status_'+note_id).removeClass('bolding_letters');
                        
                        $(".view-notes-visible #opened_note_id").val(note_id);
                        $(".view-notes-visible #opened_note_customer").val(data.notes_detail.cust_name);
                        $(".view-notes-visible #opened_note_title").val(data.notes_detail.title);
                        $(".view-notes-visible #opened_note_description").val(data.notes_detail.description);
                        $(".view-notes-visible #opened_note_visibility").val(data.notes_detail.visibility);
                        
                        $(".view-notes-visible #view_note_content_wrpr .nt_writer").html(data.notes_detail.emp_name);
                        $(".view-notes-visible #view_note_content_wrpr .nt_customer").html(data.customer_name);
                        $(".view-notes-visible #view_note_content_wrpr .nt_title").html(data.notes_detail.title);
                        $(".view-notes-visible #view_note_content_wrpr .nt_description").html(data.notes_detail.description);
                        $(".view-notes-visible #view_note_content_wrpr .nt_date").html(data.notes_detail.date);
                        
                        var note_visibility = '';
                        switch(data.notes_detail.visibility){
                            case '1': note_visibility = '{$translate.public}'; break;
                            case '2': note_visibility = '{$translate.private}'; break;
                            case '3': note_visibility = '{$translate.all}'; break;
                            case '4': note_visibility = '{$translate.admin_only}'; break;
                        }
                        $(".view-notes-visible #view_note_content_wrpr .nt_visibility").html(note_visibility);
                        $(".view-notes-visible #view_note_content_wrpr .nt_date").html(data.notes_detail.date);
                        
                        {if $user_role eq 1}
                            var note_status = '';
                            switch(data.notes_detail.status){
                                case '1': note_status = '{$translate.active}'; break;
                                case '0': note_status = '{$translate.forbidden}'; break;
                            }
                            $(".view-notes-visible #view_note_content_wrpr .nt_status").html(note_status);
                        {/if}
                        
                        if(data.attachment_arr.length > 0){
                            var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                    <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12">';
                            $.each(data.attachment_arr, function(i, value) {
                                new_attachment_html += '<li class="list-group-item mb span12 no-ml" style="padding-left: 0px;">{if $user_role eq 1}<i class="icon-trash pull-left cursor_hand delete_attachment" data-file-name="'+value.replace(/'/g, "\'")+'"></i>{/if}<span class="span11 ml"> <a href="javascript:window.location.href=\'{$url_path}notes/attachment/download/{$smarty.session.user_id}/'+value.replace(/'/g, "\'")+'/\'">'+value+'</a> </span></li>';
                            });
                            
                            new_attachment_html += '</ul>\n\
                                <div style="margin-top: 3px" class="span12">\n\
                                        <label><a href="javascript:window.location.href=\'{$url_path}notes/allattachment/download/{$smarty.session.user_id}/'+note_id+'/\'" style="float: left;margin-left: 5px">{$translate.download_all}</a></label>\n\
                                </div>';
                            $(".view-notes-visible #view_note_content_wrpr .nt_attachment").html(new_attachment_html);
                        }
                        else
                            $(".view-notes-visible #view_note_content_wrpr .nt_attachment").html('{$translate.no_attachment}');
                        
                    }

                    if(data.message !== 'undefined' && data.message != ''){
                        $('#right_message_wraper').html(data.message);
                    }
            }
        }).always(function(data) { 
            uwrapLoader(".main-right");
        });
    });
    
    $('.btn-addnew-notes').click(function(){
        close_right_panel();
        $('#table_list').removeClass('open-note-mode');
        $('#table_list tr.note_row').removeClass('active');
        $('#main_container').addClass('show_main_right');
        $(".main-right, .main-right .addnew-notes-box").removeClass('hide');
		
				  $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
				
				
        
        $('.addnew-notes-box #edit_note_id, .addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
        {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
            $('.addnew-notes-box #note_attachment_group').html('');
        {/if}
        
        $('.addnew-notes-box .widget-header .note_process_action').html('{$translate.add_notes}');
    });
    
    {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
        $('.addnew-notes-box #btn_add_attachment').click(function(e){
            $('.addnew-notes-box #note_attachment_group').append('<div class="span12 no-ml attachment_row">\n\
                                                <button class="btn btn-default pull-left span1 btn_attachment_remove" style="text-align: center;" type="button"><i class="icon-trash"></i></button>\n\
                                                <div class="pull-left span11 no-ml" style=""><input type="file" name="attachments[]" class="note_attach_file margin-none"></div></div>');
            e.preventDefault();
        });
        
        $(document).on('click', ".btn_attachment_remove", function(e) {
            $(this).parents('.attachment_row').remove();
            e.preventDefault();
        });
    {/if}
    
    $(document).on('click', ".delete_attachment", function(e) {
        if (confirm("{$translate.want_delete}")) {
            $('#right_message_wraper').html();
            var file_name = $(this).attr('data-file-name');
            if(file_name != ''){
                var note_id = $(".view-notes-visible #opened_note_id").val();
                var this_obj = this;
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"{$url_path}ajax_note_actions.php",
                    data    : { "note_id": note_id, 'action': 'delete_note_attachment', 'file_id': file_name },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);
                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $(this_obj).parent('li.list-group-item').remove();
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#right_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-right");
                });
            }
        }
        e.preventDefault();
    });
    
    $('input[name=save_type]').change(function(){
        $(this).attr('checked', 'checked');
        $(this).prop('checked', 'checked');
    });

    $(document).ready(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        });
    });
});

$(function() {
    var search_customers = [
            {foreach from=$search_cust_array item=cust}
                    {
                    value: "{$cust.cID}",
                    label: "{$cust.cName}"
                    },
            {/foreach}
    ];
    $( "#cust_search_list" ).autocomplete({
        minLength: 0,
        source: search_customers,
        focus: function( event, ui ) {
                    $( "#cust_search_list" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;

                    $("#cust_selected").val(sel_value);
                    $("#cust_search_list").val(sel_label);
                    return false;
                }
    })/*
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    }*/;

});

$(function() { // auto_complete for authers.
    var authers = [
        {foreach from=$employee_list item=emp}
            {
            value: "{$emp.username}",
            label: {if $sort_by_name eq 1} "{$emp.first_name} {$emp.last_name}" {else} "{$emp.last_name} {$emp.first_name}" {/if}
            },
        {/foreach}
    ];
    $( "#txt_auther_search" ).autocomplete({
        source: authers,
        focus: function( event, ui ) {
                    $( "#txt_auther_search" ).val( ui.item.label );
                    return false;
                },
        select: function( event, ui ) {
                    var sel_value = ui.item.value;
                    var sel_label = ui.item.label;

                    $("#emp_user_id").val(sel_value);
                    $("#txt_auther_search").val(sel_label);
                    return false;
        }
    });
});

function get_report(){
{*    $('#form').submit();*}
    var year        = $('#cmb_year').val();
    var month       = $('#cmb_month').val();
    var cust        = $('#cust_selected').val();
    var cust_name   = $('#cust_search_list').val();
    var emp_user_id = $('#emp_user_id').val();
    var emp_name    = $('#txt_auther_search').val();
    var date        = $('#datepicker').val();
    //double encode is used for escaping auto decoding this query param in php (avoid & param exploading)
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));
{*    var search_text = encodeURIComponent($.trim($('#txt_search_word').val()));*}

    if(date == '' ) date = 'NULL';
    if(year == '') year = 'NULL';
    if(month == '') month = 'NULL';
    if(cust == '' || cust_name == '' || typeof cust == 'undefined' || typeof cust_name == 'undefined') cust = 'NULL';
    if(emp_user_id == '' || emp_name == '' || typeof emp_user_id == 'undefined' || typeof emp_name == 'undefined') emp_user_id = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '{$url_path}notes/list/'+month+'/'+year+'/'+cust+'/'+search_text+'/'+emp_user_id+'/'+date+'/';
}

function mark_all_read(){
    var year        = $('#cmb_year').val();
    var month       = $('#cmb_month').val();
    var cust        = $('#cust_selected').val();
    var cust_name   = $('#cust_search_list').val();
    var emp_user_id = $('#emp_user_id').val();
    var emp_name    = $('#txt_auther_search').val();
    var search_text = encodeURIComponent(encodeURIComponent($.trim($('#txt_search_word').val())));
    var date        = $('#datepicker').val();

    if(date == '' ) date = 'NULL';
    if(emp_user_id == '' || emp_name == '' || typeof emp_user_id == 'undefined' || typeof emp_name == 'undefined') emp_user_id = 'NULL';
    if(year == '') year = 'NULL';
    if(month == '') month = 'NULL';
    if(cust == '' || cust_name == '' || typeof cust == 'undefined' || typeof cust_name == 'undefined') cust = 'NULL';
    if($.trim(search_text) == '') search_text = 'NULL';
    window.location.href = '{$url_path}notes/list/'+month+'/'+year+'/'+cust+'/'+search_text+'/'+emp_user_id+'/'+date+'/read/';

}

function set_status(status,id){
    $.ajax({
        async:false,
        url:"{$url_path}ajax_update_notes_status.php",
        data:"id="+id+"&status="+status,
        type:"POST",
        success:function(data){
                $("#table_list tr#status_"+id).children("td:eq(9)").remove();
                $("#table_list tr#status_"+id).children("td:eq(8)").remove();
                $("#table_list tr#status_"+id).append(data);
                if(status == 1)
                    $("#table_list tr#status_"+id).removeClass('notes-highlight').addClass('col-highlight-primary');
                else
                    $("#table_list tr#status_"+id).removeClass('col-highlight-primary').addClass('notes-highlight');
        }
    });
}

function close_right_panel(){
    $('#main_container').removeClass('show_main_right');
    $(".main-right, .main-right .addnew-notes-box, .main-right .view-notes-visible").addClass('hide');
    $('.main-right #right_message_wraper').html('');
}

{if $user_role eq 1}
    function delete_note(note_id) {
        if (confirm("{$translate.sure_to_delete_note_data}")) {
            //document.location.href = "{$url_path}notes/detail/" + note_id + "/delete/";
            
            $('#right_message_wraper').html('');
            var note_id = $(".view-notes-visible #opened_note_id").val();
            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"{$url_path}ajax_note_actions.php",
                data    : { "note_id" : note_id, 'action': 'delete' },
                dataType: 'json',
                type    :"POST",
                success:function(data){
                        //console.log(data);
                        if(data.transaction_flag !== undefined && data.transaction_flag){
                            close_right_panel();
                            $(".view-notes-visible #opened_note_id").val('');
                            
                            $('#table_list tr#status_'+note_id).remove();
                            renumbering_notes_table();
                        }

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
        }
    }
    
    function edit_note(){
        close_right_panel();
        var note_id = $(".view-notes-visible #opened_note_id").val();
        if(note_id == ''){
            bootbox.alert('{$translate.invalid_note}', function(result){ });
        }else {
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right .addnew-notes-box").removeClass('hide');
            $('.addnew-notes-box .widget-header .note_process_action').html('{$translate.edit_note}');
        
            var note_customer   = $(".view-notes-visible #opened_note_customer").val();
            var note_title      = $(".view-notes-visible #opened_note_title").val();
            var note_description= $(".view-notes-visible #opened_note_description").val();
            var note_visibility = $(".view-notes-visible #opened_note_visibility").val();
        
            $('.addnew-notes-box #edit_note_id').val(note_id);
            $('.addnew-notes-box #cmb_customer').val(note_customer);
            $('.addnew-notes-box #save_title').val(note_title);
            $('.addnew-notes-box #save_description').val(note_description);
            {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
                $('.addnew-notes-box #note_attachment_group').html('');
            {/if}
            
            {if $user_role neq '3'} 
                switch(note_visibility){
                    case '1': $('.addnew-notes-box .note_visibility_options #radio3').parent('label').trigger('click'); break;
                    case '2': $('.addnew-notes-box .note_visibility_options #radio1').parent('label').trigger('click'); break;
                    case '4': $('.addnew-notes-box .note_visibility_options #radio4').parent('label').trigger('click'); break;
                }
            {/if}
        }
    }
{/if}

function reload_content(){
    window.location.href = '{$current_url}';
}

function renumbering_notes_table(){
    var count = 0;
    var record_base_no = parseInt('{$this_page_no * $per_page}');
    $( "table#table_list tr.note_row" ).each(function( index, element ) {
        count++;
        var row_record_no = parseInt(record_base_no + count);
        $(this).find('td.note_number').html(row_record_no);
    });
}

function save_note(){

    $('#right_message_wraper').html('');
    var edit_note_id= $('.addnew-notes-box #edit_note_id').val();
    var customer    = $.trim($('.addnew-notes-box #cmb_customer').val());
    var title       = $.trim($('.addnew-notes-box #save_title').val());
    var description = $.trim($('.addnew-notes-box #save_description').val());
    var visibility  = $('.addnew-notes-box .note_visibility_options input:radio[name=save_type]:checked').val();
    
    /*var process_data = {
        'action'    : 'create',
        'customer'  : customer,
        'title'     : title,
        'description': description,
        'visibility': visibility,
        'attachments': []
    };*/

    var proceed_flag = true;
    
    if(title == ''){
        bootbox.alert('{$translate.enter_note_title}', function(result){ });
        $('.addnew-notes-box #save_title').focus();
        proceed_flag = false;
    }
    else if(description == ''){
        bootbox.alert('{$translate.enter_note_description}', function(result){ });
        $('.addnew-notes-box #save_description').focus();
        proceed_flag = false;
    }
    {if $user_role neq '3'}
        if(proceed_flag){
            if(typeof visibility === 'undefined' || visibility == ''){
                bootbox.alert('{$translate.select_a_note_visibility_type}', function(result){ });
                proceed_flag = false;
            }
            else if(visibility == '2' && customer == ''){
                bootbox.alert('{$translate.select_note_customer}', function(result){ });
                $('.addnew-notes-box #cmb_customer').focus();
                proceed_flag = false;
            }
        }
    {/if}

    if(proceed_flag){
        var form_data = new FormData();  
        var editable = '';
        $('#editable').is(':checked') ? editable = 1 : editable = 0;
        form_data.append('action', 'create');
        form_data.append('customer', customer);
        form_data.append('title', title);
        form_data.append('description', description);
        form_data.append('visibility', visibility);
        form_data.append('status', '');
        form_data.append('editable', editable);

        if(edit_note_id != ''){
            form_data.append('note_id', edit_note_id);
            form_data.append('action', 'update');
        } else
            form_data.append('action', 'create');
        
        $( ".addnew-notes-box .note_attach_file" ).each(function( index, element ) {
            if($(this).val() != ''){
                var file_data = $(this).prop('files')[0];   
                //process_data.attachments.push(file_data);
                form_data.append('attachment[]', file_data);
            }
        });
        //console.log(form_data);
        //console.log(process_data);


        //return false;
        wrapLoader(".main-right");
        $.ajax({
            async   :false,
            url     :"{$url_path}ajax_note_actions.php",
            data    : form_data,
            dataType: 'json',
            type    :"POST",
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success:function(data){
                    console.log(data);
                    if(edit_note_id == ''){
                        reload_content();
                        $('.addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
                    }
                    
                    {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
                        $('.addnew-notes-box #note_attachment_group').html('');
                    {/if}
                        
                    //updated notedetails shows on table
                    if(edit_note_id != '' && typeof data.notes_detail !== 'undefined'){
                        $('#table_list tr#status_'+edit_note_id).find('.entry-customer').html(data.customer_name);
                        $('#table_list tr#status_'+edit_note_id).find('.entry-title').html(data.notes_detail.title);
                        $('#table_list tr#status_'+edit_note_id).find('.entry-description').html(data.notes_detail.description);
                        
                        var visibility_name = '';
                        switch(data.notes_detail.visibility){
                            case '1' : visibility_name = '{$translate.public}'; break;
                            case '2' : visibility_name = '{$translate.private}'; break;
                            case '3' : visibility_name = '{$translate.all}'; break;
                            case '4' : visibility_name = '{$translate.admin_only}'; break;
                        }
                        $('#table_list tr#status_'+edit_note_id).find('.entry-visibility').html(visibility_name);
                        
                        if(data.attachment_arr.length > 0){
                            $('#table_list tr#status_'+edit_note_id).find('.entry-attachment-indication').html('<span title="{$translate.attachments}"><i class="icon-paper-clip icon-large"></i></span>');
                        }
                    }

                    if(data.message !== 'undefined' && data.message != ''){
                        $('#right_message_wraper').html(data.message);
                    }
            }
        }).always(function(data) { 
            uwrapLoader(".main-right");
        });
    }
}

function refresh_note_edit(){
    $('.addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
    {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
        $('.addnew-notes-box #note_attachment_group').html('');
    {/if}
}

function print_note(){
    $('#action_print').val('print');
    $('#print_form').attr('target', '_BLANK');
    $('#print_form').submit();
}
</script>
{/block}



{block name="content"}
<div class="row-fluid" id="main_container">
{*    main left*}
    <div class="span12 main-left slot-form" >
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="">{$translate.notes_list}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button {*onclick="javascript:location='{$url_path}notes/add/';"*} class="btn btn-default btn-normal ml pull-right btn-addnew-notes" type="button" title="{$translate.add_new_note}"><i class="icon-plus"></i> {$translate.add_new}</button>
                    <button onclick="javascript:location='{$url_path}message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.backs}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget no-mb" style="margin-top:0;">
                        <div class="span12 widget-body-section input-group" id="search-section">
{*                            <form name="form" id="form" method="post" action="{$url_path}message/center/leave/">*}
                                <div class="span6">
                                    <div class="span12">
                                        <div class="span4 cmb-year" style="margin: 0px;">
                                            <label style="float: left;" class="span12" for="cmb_year">{$translate.year}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12">
                                                <span class="add-on icon-pencil"></span>
                                                <select class="form-control span11" name='cmb_year' id='cmb_year'>
                                                    <option value="" >{$translate.select_year}</option>
                                                    {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4 cmb-month" >
                                            <label style="float: left;" class="span12" for="cmb_month">{$translate.month}:</label>
                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12">
                                                <span class="add-on icon-pencil"></span>
                                                <select class="form-control span11" name='cmb_month' id='cmb_month'>
                                                    <option value="" >{$translate.select_month}</option>
                                                    {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word">{$translate.note_date_search}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-calendar"></span>
                                                <input name="datepicker" id="datepicker"  value="{$search_date}" class="form-control span11 datepicker" title="{$translate.search_comment}" type="text" maxlength="100" /> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="span12 no-ml">

                                        {if $user_role neq 3}
                                            <div class="span4 employee-search-list" >
                                                <label style="float: left;" class="span12" for="cust_search_list">{$translate.customer}:</label>
                                                <div style="margin: 0px;" class="input-prepend span12">
                                                    <span class="add-on icon-pencil"></span>
                                                    <input name="cust_search_list" id="cust_search_list" value="{$sel_cust_label}" class="form-control span11" type="text"/> 
                                                    <input type="hidden" name="cust_selected" id="cust_selected" value="{$sel_cust}" />
                                                </div>
                                            </div>
                                        {/if}

                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word">{$translate.note_auther_search}</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="txt_auther_search" id="txt_auther_search" value="{$emp_name}" class="form-control span11" title="{$translate.search_comment}" type="text" maxlength="100" /> 
                                                <input type="hidden" name="emp_user_id" id="emp_user_id" value="{$emp_user_id}" />
                                            </div>
                                        </div>

                                        <div class="span4 txt-search-word">
                                            <label style="float: left;" class="span12" for="txt_search_word">{$translate.search_comment}: </label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="txt_search_word" id="txt_search_word" value="{$sel_search_text}" class="form-control span11" title="{$translate.search_comment}" type="text" maxlength="100" /> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="span6 mt">
                                    <button onclick="get_report();" class="btn btn-default btn-margin-set" style="margin-top: 15px; margin-left: 2em; text-align: center;" name="go" id="go" value="{$translate.show}"> {$translate.show} </button>
                                
                                    <button onclick="mark_all_read();" class="btn btn-default  btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="{$translate.mark_all_notes_read}"> {$translate.mark_all_notes_read} </button>
                                </div>
                                <!-- <div class="span2"><button onclick="get_report();" class="btn btn-default btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="{$translate.show}"> {$translate.show} </button>
                                
                                <button onclick="mark_all_read();" class="btn btn-default pull-right btn-margin-set" style="margin-top: 15px; text-align: center;" name="go" id="go" value="{$translate.mark_all_notes_read}"> {$translate.mark_all_notes_read} </button>
                                </div> -->
{*                            </form>*}
                        </div>
                    </div>
                    <div class="span12 no-min-height no-ml mt">
                        <div class="pagination pagination-mini pagination-right pagin margin-none">
                            {if $pagination neq ''}<ul id="pagination">{$pagination}</ul>{/if}
                        </div>
                    </div>
                    <input type="hidden" id="vikarie_delete_key" value="1" />
                    <div class="span12 no-ml table-responsive">
                        <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-responsive table-primary t no-mt" style="margin: 10px 0px 0px; top: 0px;">
                            <thead>
                                <tr>
                                    <th class="table-col-center" style="width:20px;">#</th>
                                    <th style="width: 15%;">{$translate.writer}</th>
                                    <th>{$translate.customer}</th>
                                    <th>{$translate.title}</th>
                                    <th style="width:20%;">{$translate.discription}</th>
                                    <th width="10%">{$translate.date_written}</th>
                                    <th width="10%">{$translate.visibility}</th>
                                    <th width="7%">{$translate.view}</th>
                                    {if $user_role eq 1}<th colspan="2">{$translate.status}</th>{/if}
                                </tr>
                            </thead>
                            <tbody>
                                {assign i 0}
                                {foreach from=$notes_list item=list}
                                    {assign i $i+1}
                                    {assign record_no $this_page_no * $per_page + $i}
                                    <tr id="status_{$list.id}" class="gradeX note_row {cycle values="even,odd"} {if $list.status =='1'}col-highlight-primary{else if $list.status eq 0}notes-highlight{/if}{if $list.is_unread eq 1} bolding_letters{/if}">
                                        <td class="table-col-center note_number" style="width:20px;">{$record_no}</td>
                                        {if $sort_by_name == 1}
                                            <td>{$list.emp_name}</td>
                                            <td class="entry-customer">{$list.cust_name}</td>
                                        {elseif $sort_by_name == 2}
                                            <td>{$list.emp_name_lf}</td>
                                            <td class="entry-customer">{$list.cust_name_lf}</td>
                                        {/if}
                                        <td class="entry-title">{$list.title}</td>
                                        {assign var="cnt" value=$list.description|strip_tags|strlen}
                                        <td class="entry-description" >{if $cnt gt 35}{$list.description|strip_tags|truncate:35}{else}{$list.description|strip_tags}{/if}</td>
                                        <td>{date('Y-m-d',strtotime($list.date))}</td>
                                        <td class="entry-visibility">{if $list.visibility eq 1} {$translate.public}
                                            {elseif $list.visibility eq 2} {$translate.private}
                                            {elseif $list.visibility eq 3} {$translate.all}
                                            {elseif $list.visibility eq 4} {$translate.admin_only}{/if}</td>
                                        <td class="table-col-center center">
                                            <span title="{$translate.note_details}" class="mr cursor_hand book-open" data-id='{$list.id}'>{*{$url_path}notes/detail/{$list.id}/*}<i class='cursor_hand icon-eye-open icon-large'></i>{if $list.is_unread eq 1} <span class="unread_indication">*</span>{/if}</span>
                                            <input type="hidden" id="current_usr" value="{$current_usr}">
                                            <span class="entry-attachment-indication">{if $list.attachment neq ''}<span title="{$translate.attachments}"><i class='icon-paper-clip icon-large'></i></span>{/if}</span>
                                        </td>
                                        {if $user_role eq 1}
                                            <td  class="table-col-center center" style="width:15px;">
                                                {if $list.status eq 1}
                                                    <a id="active_inactive" class="settings" href="javascript:void(0);" onclick="set_status(0,{$list.id})">
                                                        <img width="20" height="20" border="0" title="{$translate.set_as_forbidden}" alt="" src="{$url_path}images/cirrus_icon_reject.png">
                                                    </a>
                                                {elseif $list.status eq 0}
                                                    <a id="active_inactive" class="contracts" href="javascript:void(0);" onclick="set_status(1,{$list.id})">
                                                        <img width="20" border="0" title="{$translate.set_as_active}" alt="" src="{$url_path}images/icon_approve.png">
                                                    </a>
                                                {else}
                                                    <a href="{$url_path}notes/add/{$list.id}/" class="settings" title="{$translate.edit}"><i class=" icon-cog icon-large cursor_hand"></i></a>
                                                {/if}
                                            </td> 
                                        {/if}
                                    </tr>
                                {foreachelse}
                                    <tr>
                                        <td {if $user_role eq 1}colspan=10{else}colspan=8{/if}><div class="message">{$translate.no_data_available}</div></td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

{*    main right*}
    <div class="span4 main-right hide" style="margin-top: 8px; padding: 10px;">
        <div id="right_message_wraper" class="span12 no-min-height"></div>
        
{*        new/edit note*}
        <div class="span12 addnew-notes-box hide no-ml">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1 style="">{$translate.notes} <span class="note_process_action" style="font-size: 11px;">{$translate.add_notes}</span></h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default btn-normal pull-right btn-save-notes" type="button" onclick="save_note()"><i class='icon-save'></i> {$translate.save}</button>
                        <button class="btn btn-default btn-normal pull-right" style="margin-right: 5px;" type="button" onclick="refresh_note_edit()"><i class='icon-refresh'></i> {$translate.reset}</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right no-ml" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="row-fluid">
                        <form method="post" name="note_form" id="note_form" >
                        <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                            <input type="hidden" id="edit_note_id" name="edit_note_id" value="" />
                            <div class="span12" style="margin: 0px;">
                                <label class="span12" style="float: left;" for="cmb_customer">{$translate.customer}:</label>
                                <div style="float: left; margin: 0px;" class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name='cmb_customer' id="cmb_customer" class="form-control span11 {if $user_role neq '1' and $user_role neq '6'}required{/if}">
                                        {if $combo_customers|count neq 1 or $user_role neq '3'}<option value="" >{$translate.select_customer}</option>{/if}
                                        {if $combo_customers}
                                            {foreach from=$combo_customers item=entries}
                                                {if $sort_by_name == 1}<option value={$entries.username} {if $notes_detail.cust_name eq $entries.username}selected="selected"{/if}>{$entries.first_name} {$entries.last_name}</option>
                                                {elseif $sort_by_name == 2}<option value={$entries.username} {if $notes_detail.cust_name eq $entries.username}selected="selected"{/if}>{$entries.last_name} {$entries.first_name}</option>{/if}
                                            {/foreach}
                                        {/if}
                                    </select>
                                </div>
                            </div>
                            <div style="margin: 10px 0px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="save_title">{$translate.title}:</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                    <input name="save_title" id="save_title" class="form-control span11" type="text" />
                                </div>
                            </div>
                            <div style="margin: 0px ! important;" class="span12">
                                <label style="float: left;" class="span12" for="save_description">{$translate.discription}:</label>
                                <textarea name="save_description" id="save_description" rows="1" class="form-control span12" style="margin: 0px 0px 10px;"></textarea>
                            </div>
                            {if $user_role neq '3'} 
                                <div class="span12 no-ml note_visibility_options">
                                    <div class="span12" style="margin: 0px ! important;">
                                        <label class="span12" style="float: left;">{$translate.visibility}:</label>
                                        {*<div class="btn-group leave-type"> 
                                            <a class="btn btn-default" href="javascript:;" unselectable="on">{$translate.private}</a> 
                                            <a class="btn btn-default" href="javascript:;" unselectable="on">{$translate.public}</a> 
                                            <a class="btn btn-default" href="javascript:;" unselectable="on">{$translate.admin_only}</a> 
                                        </div>*}
                                        <div class="btn-group visibility_types" data-toggle="buttons">
                                            {if ($user_role eq '1') or ($user_role eq '7')}
                                            <label class="btn btn-primary btn-visibility-types" title="{$translate.private_tooltip}">
                                                <input id="radio1" type="radio" value="2" class="hide" name="save_type">{$translate.private}
                                            </label>
                                            <label class="btn btn-primary btn-visibility-types" title="{$translate.public_tooltip}">
                                                <input id="radio3" type="radio" value="1" class="hide" name="save_type">{$translate.public}
                                            </label>
                                            {/if}
                                            <label class="btn btn-primary btn-visibility-types" title="{$translate.admin_only_tooltip}">
                                                <input id="radio4" type="radio" value="4" class="hide" name="save_type">{$translate.admin_only}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            {/if}
                                <div class="span12 mt no-ml">
                                    <label>
                                        <input type="checkbox" id="editable" name="editable" {if ($user_role neq '1') and ($user_role neq '7')}disabled{/if} checked="checked">
                                        {$translate.note_editable}
                                    </label>
                                </div>
                            {if ($user_role eq '1') or ($user_role eq '3' and $attachment_add_permission eq 1)} 
                                <div class="span12 no-ml mt" style="overflow-x: auto;">
                                    <label style="float: left;" class="span12 mt">{$translate.attachments} <button class="btn btn-default pull-right" id="btn_add_attachment"><i class="icon-plus cursor_hand "></i></button></label>
                                    <div style="margin: 10px 0px ! important; display: block ! important;" class="row-fluid notes-upload" id="note_attachment_group">
                                        {*<div class="span12 no-ml attachment_row">
                                            <button class="btn btn-default pull-left span1 btn_attachment_remove" style="text-align: center;" type="button"><i class="icon-trash"></i></button>
                                            <div class="pull-left span11" style=""><input type="file" class="margin-none"></div>
                                        </div>*}
                                    </div>
                                </div>

                            {/if}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
{*        view note*}
        <div class="span12 view-notes-visible no-ml hide">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="pull-left day-slot-wrpr-header-left ">
                        <h1 style="padding-right: 5px;">{$translate.notes_detail}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default pull-right ml" id="edit_btn" type="button" onclick="edit_note();"><i class='icon-pencil'></i> {$translate.edit}</button>
                        <button class="btn btn-danger pull-right mr" id="delete_btn" type="button" onclick="delete_note();" ><i class='icon-trash' ></i> {$translate.delete}</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                        <button class="" type="button" onclick="print_note()"><i class="icon-print"></i>{$translate.print}</button>
                        <form id="print_form" method="post" action="{$url_path}notes_list/">
                            <input type="hidden" name="action_print" id="action_print" value="">
                            <input type="hidden" name="note_id" id="note_id" value="">
                            
                        </form>

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="row-fluid hide" id="view_note_content_wrpr"  style="overflow-x: auto;">
                        <table class="table table-white table-bordered table-hover table-responsive table-primary t" style="margin: 0px ! important; top: 0px; border-top: thin solid rgb(204, 204, 204);">
                            <tbody>
                                <tr class="gradeX">
                                    <td class="">{$translate.writer}</td><td class="nt_writer"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.customer}</td><td class="nt_customer"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.title}</td><td class="nt_title"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.discription}</td><td class="nt_description" style="white-space: pre-wrap; overflow: hidden;display: block; "></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.date_written}</td><td class="nt_date"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.visibility}</td><td class="nt_visibility"></td>
                                </tr>
                                {if $user_role eq 1}
                                    <tr class="gradeX">
                                        <td>{$translate.status}</td><td class="nt_status"></td>
                                    </tr>
                                {/if}
                                <tr class="gradeX">
                                    <td class="">{$translate.attachments}</td>
                                    <td class="nt_attachment">
                                        {*<div style="margin: 0px; height: auto;" class="span12">
                                            <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12">
                                                <li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><i class="icon-trash pull-left"></i><span class="span11 ml"> File this is amazing ksldjf lsdf laskdfj sdfkjsldfjlksjdf </span></li>
                                                <li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><i class="icon-trash pull-left"></i><span class="span11 ml"> File this is amazing ksldjf lsdf laskdfj sdfkjsldfjlksjdf </span></li>
                                                <li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><i class="icon-trash pull-left"></i><span class="span11 ml"> File this is amazing ksldjf lsdf laskdfj sdfkjsldfjlksjdf </span></li>
                                                <li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><i class="icon-trash pull-left"></i><span class="span11 ml"> File this is amazing ksldjf lsdf laskdfj sdfkjsldfjlksjdf </span></li>
                                                <li class="list-group-item mb span12 no-ml" style="padding-left: 0px;"><i class="icon-trash pull-left"></i><span class="span11 ml"> File this is amazing ksldjf lsdf laskdfj sdfkjsldfjlksjdf </span></li>
                                            </ul>
                                            <div style="margin-top: 3px" class="span12">
                                                <label><a id="attach_file" href="javascript:void(0);" onclick="attachAnother()" style="float: left;margin-left: 5px">Ytterligare fil</a></label>
                                            </div>
                                        </div>*}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {if $user_role eq 1}
                        <form name="details_form" id="details_form" method="post">
                            <input type="hidden" name="file_id" id="file_id" value="" />
                        </form>
                    {/if}
                    <input type="hidden" id="opened_note_id" value=""/>
                    <input type="hidden" id="opened_note_customer" value=""/>
                    <input type="hidden" id="opened_note_title" value=""/>
                    <input type="hidden" id="opened_note_description" value=""/>
                    <input type="hidden" id="opened_note_visibility" value=""/>
                    <div class="row-fluid notes-upload" style="margin: 10px 0px ! important;">
                        <div class="span6" style="margin: 0px ! important;">
                            <input style="" class="margin-none" type="file">
                        </div>
                        <div class="span6" style="margin: 0px ! important;">
                            <button class="btn btn-default span10 pull-right btn-remove-upload" style="text-align: center;" type="button">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid"> </div>
            <div class="row-fluid"><div class="span12"></div></div>
        </div>
    </div>
</div>

{/block}