{block name='style'}
    <link href="{$url_path}css/message-center.css" rel="stylesheet" type="text/css" />
    <style type="text/css" >
        
    	.ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        * html .ui-autocomplete {
            height: 200px;
        }
        
        #mailing_list .mailing_group ul .mail_grup_customer, #mailing_list .mailing_group ul .mail_grup_customer_unasigned,#unsigned_employee .mailing_group ul .mail_grup_customer_unasigned{
            background: none repeat scroll 0 0 #e3f2f6;
              padding: 5px 4px;
        }
        #mailing_list .mailing_group ul .mail_grup_customer_unasigned, #unsigned_employee .mailing_group ul .mail_grup_customer_unasigned {
            background: none repeat scroll 0 0 #feeded;
            padding: 5px 4px;
        }
        #mailing_list .mailing_group ul , #unsigned_employee .mailing_group ul {
            /*border-color: -moz-use-text-color #e8eff1 #e8eff1;
            border-style: none solid solid;
            border-width: medium 1px 1px;
            list-style: none outside none;*/
            border: solid thin #ddd;
            margin: 0 auto;
            padding: 4px 3px 4px 5px;
        }
              #mailing_list .mailing_group ul li > ul > li{ border: 0 !important; }
        #mailing_list li.mail_grup_employees,#unsigned_employee li.mail_grup_employees{
            /*padding-left: 0 !important;*/
            border: none;
           
        }

        #mail-recipient-list .nav-tabs>li>a { font-size: 11px; }
	   .main-right{ padding: 10px 8px 10px 8px; }
       .show_main_right .main-right{ width:38%; }
       .show_main_right .main-left{ width:60%; }
       .uploaded-files-box { height: auto; overflow-y: auto; }
       .uploaded-files-box li {
            background-color: #c0c0e6;
            padding: 3px 5px !important;
            border-radius: 17px;
            vertical-align: bottom !important;
            text-align: left;
       }
       .uploaded-files-box li a i.icon-download{
            margin: auto 4px auto 5px !important;
            padding: 4px 0px;
            width: auto;
       }
       .uploaded-files-box li a .down-file-name{
            text-overflow: ellipsis; 
            max-width: 100%; 
            overflow: hidden; 
       }
       .attachment_row input[type=file].mail_attach_file {
            height: auto;
            line-height: initial;
            vertical-align: middle !important;
        }
        .input-append .add-on, .input-prepend .add-on { min-width: 5.9251741293% !important; }
        .content-col-style { max-width: calc(100vw - 57vw); }
        .content-col-style p.limit-mail-subject { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%; }
        .content-col-style p.limit-mail-subject.have_attachment { width: 95% !important; }
    </style>
{/block}

{block name="script"}
<script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">
    jQuery.fn.removeInlineCss = (function(){
        var rootStyle = document.documentElement.style;
        var remover = 
            rootStyle.removeProperty    // modern browser
            || rootStyle.removeAttribute   // old browser (ie 6-8)
        return function removeInlineCss(properties){
            if(properties == null)
                return this.removeAttr('style');
            proporties = properties.split(/\s+/);
            return this.each(function(){
                for(var i = 0 ; i < proporties.length ; i++)
                    remover.call(this.style, proporties[i]);
            });
        };
    })();

    $(function() {
        var availableTags = [
            {foreach from=$mailable_employees item=employee}
                     {if $sort_by_name == 1}
                        "{$employee.first_name} {$employee.last_name}({$employee.username})",       
                    {elseif $sort_by_name == 2}
                        "{$employee.last_name} {$employee.first_name}({$employee.username})",       
                    {/if}      
            {/foreach}
            
        ];
        function split( val ) {
                return val.split( /,\s*/ );
        }
        function extractLast( term ) {
                return split( term ).pop();
        }

        $( "#mail-create-template #mail_send_to" )
                // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB &&
                            $( this ).data( "autocomplete" ).menu.active ) {
                            event.preventDefault();
                    }
            })
            .autocomplete({
                    minLength: 0,
                    source: function( request, response ) {
                            // delegate back to autocomplete, but extract the last term
                            response( $.ui.autocomplete.filter(
                                    availableTags, extractLast( request.term ) ) );
                    },
                    focus: function() {
                            // prevent value inserted on focus
                            return false;
                    },
                    select: function( event, ui ) {
                            var terms = split( this.value );
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push( ui.item.value );
                            // add placeholder to get the comma-and-space at the end
                            terms.push( "" );
                            this.value = terms.join( ", " );
                            return false;
                    }
            });
    });
    
    $(document).ready(function() {
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        });
        
        $(".btn-cancel-right").click(function() {
            close_right_panel();
        });
        
        $(".btn-cancel-recipient-list").click(function() {
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');
        });
        
        $('#mail-create-template #btn_add_attachment').click(function(e){
            $('#mail-create-template #mail_attachment_group').append('<div class="span12 no-ml attachment_row">\n\
                                                <button class="btn btn-default pull-left span1 btn_attachment_remove no-padding no-min-height" style="text-align: center;" type="button" title="{$translate.remove_attachment}"><i class="icon-trash"></i></button>\n\
                                                <div class="pull-left span11 no-ml" style=""><input type="file" name="attachments[]" class="mail_attach_file margin-none"></div></div>');
            e.preventDefault();
        });
        
        $('#mail-create-template #btn_load_recipient_list').click(function(e){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right #mail-recipient-list").removeClass('hide');
            
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);

            $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', false);
            $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', false);
            e.preventDefault();
        });
        
        $(document).on('click', ".btn_attachment_remove", function(e) {
            $(this).parents('.attachment_row').remove();
            e.preventDefault();
        });
        
        $('.mail-open').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right .view-mail-visible").removeClass('hide');
            $(this).parents('tr.mail-row').removeInlineCss("font-weight");
            $(this).find('span.mr').removeInlineCss("font-weight");

            var mail_id = $(this).parents('tr.mail-row').attr('data-id');
            var mail_category = $('#selected_mail_category').val();
            $(".view-mail-visible #opened_mail_id").val('');
            
            $('.main-right .view-mail-visible #view_mail_content_wrpr').addClass('hide');
            $(".view-mail-visible .open_as_reply_mode, .view-mail-visible .open_as_forward_mode").addClass('hide');
            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"{$url_path}ajax_mail_actions.php",
                data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                dataType: 'json',
                type    :"POST",
                success:function(data){
                        //console.log(data);
                        
                        if(data.transaction_flag !== undefined && data.transaction_flag){
                            $('.main-right .view-mail-visible #view_mail_content_wrpr').removeClass('hide');
                            
                            $(".view-mail-visible #opened_mail_id").val(mail_id);
                            $(".view-mail-visible .open_as_reply_mode").attr('data-mail-id', mail_id);
                            $(".view-mail-visible .open_as_forward_mode").attr('data-mail-id', mail_id);
                            $(".view-mail-visible .open_as_reply_mode, .view-mail-visible .open_as_forward_mode").removeClass('hide');
                            
                            $("#view_mail_content_wrpr .view-mail-from-to-label").html(mail_category == 1 ? '{$translate.from}' : '{$translate.to}');
                            
                            if(mail_category != 1){
                                $(".view-mail-visible .open_as_reply_mode").addClass('hide');
                            }

                            $("#view_mail_content_wrpr .view-mail-from-to-value").html({if $sort_by_name == 1}data.mail_details.from_name{elseif $sort_by_name == 2}data.mail_details.from_name_lf{/if});
                            $("#view_mail_content_wrpr .view-mail-subject").html(data.mail_details.subject);
                            $("#view_mail_content_wrpr .view-mail-message").html(data.mail_details.message);
                            $("#view_mail_content_wrpr .view-mail-attachments").html(data.mail_details.date);

                            if(data.attachments.length > 0){
                                var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                        <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12 no-padding">';
                                $.each(data.attachments, function(i, value) {
                                    new_attachment_html += '<li class="list-group-item mb span12 no-ml no-min-height" style="padding-left: 0px;"><span class="span11 ml no-min-height"> <a href="javascript:void(0);"  onclick="downloadFile(\''+value.replace(/'/g, "\'")+'\')"><i class="icon icon-download span1 no-min-height"></i><span class="span10 no-min-height down-file-name" title="'+value+'">'+value+'</span></a> </span></li>';
                                });

                                new_attachment_html += '</ul>';
                                $("#view_mail_content_wrpr .view-mail-attachments").html(new_attachment_html);
                            }
                            else
                                $("#view_mail_content_wrpr .view-mail-attachments").html('{$translate.no_attachment}');

                        }

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
            
            /*$('.addnew-notes-box #edit_note_id, .addnew-notes-box #cmb_customer, .addnew-notes-box #save_title, .addnew-notes-box #save_description').val('');
            $('.addnew-notes-box #note_attachment_group').html('');

            $('.addnew-notes-box .widget-header .note_process_action').html('{$translate.add_notes}');*/
        });
        
        $('.btn-addnew-mail').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_group').html('');
            
            $('#mail-create-template #normal_to_wrpr').removeClass('hide');
            $('#mail-create-template #reply_to_wrpr').addClass('hide');
            $('#mail-create-template #operational_mail_id, #mail-create-template #operational_mail_mode').val('');
            
            $('#mail-create-template #mail_attachment_old_group').addClass('hide');
            $('#mail-create-template #mail_attachment_group').removeClass('hide');
         
		 		  $('html, body').animate({
                    scrollTop: $(".main-right").offset().top
                }, 3000);
				
		 
		    
        });

        $('.btn-swich-sms').click(function(){
            location.href = '{$url_path}sms/';
        });
        
        $("#recipient_check_all, .check_recipient_groups").click(function(e){
                e.stopPropagation();
        });
        $('#mail-recipient-list #recipient_check_all').click(function () {
            $('#mailing_list').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            $('#mailing_list').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);

            // $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            // $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });

        $('#mail-recipient-list #recipient_check_all_unsigned').click(function () {
            $('#unsigned_employee').find('.mailing_group').find('.check_recipient_groups:checkbox').attr('checked', this.checked);
            $('#unsigned_employee').find('.mailing_group li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });


        $('#mail-recipient-list .check_recipient_groups').click(function () {
            $(this).parents('.mailing_group').find('li.mail_grup_employees').find('.check_recipient_emp:checkbox').attr('checked', this.checked);
        });
        
        $('.open_as_reply_mode').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_group').html('');

            $('#mail-create-template #mail_attachment_old_group').addClass('hide');
            $('#mail-create-template #mail_attachment_group').removeClass('hide');

            var mail_id = $.trim($(this).attr('data-mail-id'));
            if(mail_id != ''){
                $('#mail-create-template #normal_to_wrpr').addClass('hide');
                $('#mail-create-template #reply_to_wrpr').removeClass('hide');
                $('#mail-create-template #operational_mail_id').val(mail_id);
                $('#mail-create-template #operational_mail_mode').val('1');
                
                var mail_category = $('#selected_mail_category').val();
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"{$url_path}ajax_mail_actions.php",
                    data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);

                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_for_reply').val(data.mail_details.from_name);
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_id_for_reply').val(data.mail_details.from);
                                $('#mail-create-template #mail_send_subject').val('RE: '+data.mail_details.subject);
                                $('#mail-create-template #mail_send_body').val(data.mail_details.message);
                                $('#mail-create-template #mail_attachment_group').html('');
                            }

                            if(data.message !== 'undefined' && data.message != ''){
                                $('#right_message_wraper').html(data.message);
                            }
                    }
                }).always(function(data) { 
                    uwrapLoader(".main-right");
                });
            }
        });
        
        $('.open_as_forward_mode').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');

            $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
            $('#mail-create-template #mail_attachment_old_group, #mail-create-template #mail_attachment_group').html('');

            $('#mail-create-template #mail_attachment_old_group, #mail-create-template #mail_attachment_group').removeClass('hide');
            
            var mail_id = $.trim($(this).attr('data-mail-id'));
            if(mail_id != ''){
                $('#mail-create-template #normal_to_wrpr').removeClass('hide');
                $('#mail-create-template #reply_to_wrpr').addClass('hide');
                $('#mail-create-template #operational_mail_id').val(mail_id);
                $('#mail-create-template #operational_mail_mode').val('2');
                
                var mail_category = $('#selected_mail_category').val();
                wrapLoader(".main-right");
                $.ajax({
                    async   :false,
                    url     :"{$url_path}ajax_mail_actions.php",
                    data    : { "mail_id" : mail_id, "mail_category": mail_category, "action": 'get' },
                    dataType: 'json',
                    type    :"POST",
                    success:function(data){
                            //console.log(data);

                            if(data.transaction_flag !== undefined && data.transaction_flag){
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_for_reply').val(data.mail_details.from_name);
                                $('#mail-create-template #reply_to_wrpr #mail_send_to_id_for_reply').val(data.mail_details.from);
                                $('#mail-create-template #mail_send_subject').val('FWD: '+data.mail_details.subject);
                                $('#mail-create-template #mail_send_body').val(data.mail_details.message);
                                $('#mail-create-template #mail_attachment_group').html('');
                                
                                if(data.attachments.length >0){
                                    var new_attachment_html = '<div style="margin: 0px; height: auto;" class="span12">\n\
                                                <ul style="float: left;" class="list-group span12 list-group-form uploaded-files-box span12 no-padding">';
                                        $.each(data.attachments, function(i, value) {
                                            new_attachment_html += '<li class="list-group-item mb span12 no-ml no-min-height" style="padding-left: 0px;"><span class="span1 no-min-height"><input type="checkbox" checked="checked" value="'+value.replace(/'/g, "\'")+'" class="old_attachments"></span><span class="span11 no-ml no-min-height"> <a href="javascript:void(0);"  onclick="downloadFile(\''+value.replace(/'/g, "\'")+'\')"><i class="icon icon-download span1 no-min-height"></i><span class="span10 no-min-height down-file-name" title="'+value+'">'+value+'</span></a> </span></li>';
                                        });

                                        new_attachment_html += '</ul>';
                                        $("#mail-create-template #mail_attachment_old_group").html(new_attachment_html);
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
        });
    });
    
    function close_right_panel(){
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right #mail-create-template, .main-right .view-mail-visible, .main-right #mail-recipient-list").addClass('hide');
        $('.main-right #right_message_wraper, #left_message_wraper').html('');
    }
    
    function get_report(){
        $('#form').submit();
    }
    
    function downloadFile(filename){
        document.location.href = "{$url_path}download.php?{$mail_attachment_folder}"+filename;
    }
    
    function select_multi_recipients(){
        //var new_to_val = '';
        //if(old_to_val != '') new_to_val = old_to_val + ', ';
        
        var selected_recipients = $('#mail-recipient-list input:checkbox:checked.check_recipient_emp').map(function () {
            return this.value;
        }).get(); 
        
        if(selected_recipients.length == 0){
            bootbox.alert('{$translate.no_user_selected}', function(result){ });
        }
        
        else{
            var old_to_val = $.trim($('#mail-create-template #mail_send_to').val());
            
            if(old_to_val != ''){
                var old_splitted = old_to_val.split(',');
                var old_splitted_array = [];
                $.each(old_splitted, function(i, el){
                                if($.trim(el) !== '') old_splitted_array.push($.trim(el));
                            });
                //console.log(old_splitted_array);
                selected_recipients = $.merge( old_splitted_array, selected_recipients );

            }
            //removing dublicate employee values from different customers
            var uniqueRecipients = [];
            $.each(selected_recipients, function(i, el){
                if($.inArray($.trim(el), uniqueRecipients) === -1) uniqueRecipients.push($.trim(el));
            });
            //console.log(uniqueRecipients);

            var new_to_val = uniqueRecipients.join(', ');
            $('#mail-create-template #mail_send_to').val(new_to_val);
            
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right #mail-create-template").removeClass('hide');
        }
    }
    
    function reset_form(){
        $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
        $('#mail-create-template #mail_attachment_group').html('');
    }
    
    function SendMail(){
        $('#right_message_wraper').html('');
        
        var operational_mail_id = '';
        var operational_mail_mode = $('#mail-create-template #operational_mail_mode').val();    //1-reply, 2-fwd, null-new
        var action = '';
                
        //var edit_note_id= $('.addnew-notes-box #edit_note_id').val();
        var mail_to     = '';
        
        if(operational_mail_mode == 1){
            mail_to     = $.trim($('#mail-create-template #mail_send_to_id_for_reply').val());
            operational_mail_id = $('#mail-create-template #operational_mail_id').val();
            action = 'reply';
        }else if(operational_mail_mode == 2){
            mail_to     = $.trim($('#mail-create-template #mail_send_to').val());
            operational_mail_id = $('#mail-create-template #operational_mail_id').val();
            action = 'forward';
        }else{
            var mail_to  = $.trim($('#mail-create-template #mail_send_to').val());
            action = 'new';
        }
        
        var mail_subject= $.trim($('#mail-create-template #mail_send_subject').val());
        var mail_body   = $.trim($('#mail-create-template #mail_send_body').val());

        var proceed_flag = true;

        if(mail_to == ''){
            bootbox.alert('{$translate.select_mail_recipients}', function(result){ });
            $('#mail-create-template #mail_send_to').focus();
            proceed_flag = false;
        }
        else if(mail_subject == ''){
            bootbox.alert('{$translate.enter_mail_subject}', function(result){ });
            $('#mail-create-template #mail_send_subject').focus();
            proceed_flag = false;
        }
        else if(mail_body == ''){
            bootbox.alert('{$translate.enter_mail_message}', function(result){ });
            $('#mail-create-template #mail_send_body').focus();
            proceed_flag = false;
        }

        if(proceed_flag){
            var form_data = new FormData();  
            form_data.append('action', 'mail_send');
            form_data.append('sub_action', action);
            form_data.append('method', operational_mail_mode);     //1-reply, 2-forward
            form_data.append('to', mail_to);
            form_data.append('subject', mail_subject);
            form_data.append('mail_body', mail_body);
            form_data.append('id_mail', operational_mail_id);        //only for forward/replay modes
            //form_data.append('file_names', '');     //old attached file names (only for forward/replay modes)
            
            //set old files names
            if(operational_mail_mode == 2){
                
                var old_file_names_selected = [];
                $( "#mail-create-template #mail_attachment_old_group input:checkbox:checked.old_attachments" ).each(function( index, element ) {
                    if($(this).val() != ''){
                        old_file_names_selected.push($(this).val());
                    }
                });
                
                old_file_names_selected = old_file_names_selected.join(',');
                form_data.append('file_names', old_file_names_selected);
            }


            $( "#mail-create-template .mail_attach_file" ).each(function( index, element ) {
                if($(this).val() != ''){
                    var file_data = $(this).prop('files')[0];   
                    //process_data.attachments.push(file_data);
                    form_data.append('attachments[]', file_data);
                }
            });


            wrapLoader(".main-right");
            $.ajax({
                async   :false,
                url     :"{$url_path}ajax_mail_actions.php",
                data    : form_data,
                dataType: 'json',
                type    :"POST",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success:function(data){
                        //console.log(data);
                        $('#mail-create-template #mail_send_to, #mail-create-template #mail_send_subject, #mail-create-template #mail_send_body').val('');
                        $('#mail-create-template #mail_attachment_group').html('');

                        if(data.message !== 'undefined' && data.message != ''){
                            $('#right_message_wraper').html(data.message);
                        }
                }
            }).always(function(data) { 
                uwrapLoader(".main-right");
            });
        }
    }

    function get_unsigned_employee(){
        var year = $("#unsigned_employee_year").val();
        var month = $("#unsigned_employee_month").val();
        if(year && month ){
            $.ajax({
                url:"{$url_path}mail_list.php",
                type:"POST",
                dataType: 'json',
                data: { 'year': year, 'month': month, 'action': 'get_unsigned_employee'},
                success:function(data){
                    $('#unsignde_emp_div').empty();
                    if(data.status == true){
                        $('#employee_show').empty();
                        if(Object.keys(data.data).length > 0){
                            $.each(data.data , function (index, value){
                                var name = {$sort_by_name} == 1 ? value.first_name+' '+value.last_name : value.last_name+' '+value.first_name ; 
                                $('#employee_show').append('<li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">\n\
                                        <label class="pull-left">'+name+'</label>\n\
                                        <input type="checkbox" class="pull-right check_recipient_emp" value="'+name+'('+index+')" >\n\
                                    </li>');
                             
                            });
                        }
                        else{
                            $('#employee_show').append('<div class= message>{$translate.no_data_available}</div>');
                        }
                    }
                }
            });
        }
        else{
            return false;
        }
        
    }
    
</script>
{/block}

{block name="content"}
<div class="row-fluid" id="main_container">
{*    main left*}
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div style="" class="widget-header span12">
                <div class="day-slot-wrpr-header-left pull-left">
                    <h1 style="">{$translate.mail}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                    <button style="" class="btn btn-default btn-normal pull-right btn-addnew-mail ml" type="button"><i class="icon-plus"></i> {$translate.add_new_mail}</button>
                    {if $privileges_mc.sms_general == 1}
                        <button class="btn btn-default btn-normal pull-right btn-swich-sms" type="button">{$translate.switch_sms}</button>
                    {/if}
                    <button onclick="javascript:location='{$url_path}message/center/';" class="btn btn-default btn-normal pull-right" type="button"><i class="icon-arrow-left"></i> {$translate.backs}</button>
                </div>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="span12">
                <div class="span12">
                    <div class="widget" style="margin-top:0;margin-bottom: 7px !important;">
                        <div class="span12 widget-body-section input-group">
                            <form name="form" id="form" method="post">
                                <div class="span2 cmb-month" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_month">{$translate.month}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_month' id='cmb_month' class="form-control span11">
                                            <option value="" >{$translate.select_month}</option>
                                            <option value="0" {if $report_month == 0}selected="selected"{/if}>{$translate.all}</option>
                                            {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-year" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_year">{$translate.year}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_year' id='cmb_year' class="form-control span11">
                                            <option value="" >{$translate.select_year}</option>
                                            <option value="0" {if $report_year == 0}selected="selected"{/if}>{$translate.all}</option>
                                            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                        </select>
                                    </div>
                                </div>
                                <div class="span2 cmb-category" style="margin: 0px;">
                                    <label style="float: left;" class="span12" for="cmb_category">{$translate.category}:</label>
                                    <div style="margin-left: 0px; float: left;" class="input-prepend span9">
                                        <span class="add-on icon-pencil"></span>
                                        <select name='cmb_category' id='cmb_category' class="form-control span11">
                                            <option value=1 {if $report_category eq 1} selected {/if}>{$translate.inbox}</option>
                                            <option value=2 {if $report_category eq 2} selected {/if}>{$translate.send_items}</option>
                                            <option value=3 {if $report_category eq 3} selected {/if}>{$translate.draft}</option>
                                        </select>
                                    </div>
                                </div>
                                <button name="go" id="go" value="{$translate.show}" onclick="get_report();"  class="btn btn-default span2 btn-margin-set" style="margin: 15px 0 0 0; text-align: center;" type="button">{$translate.show}</button>
                            </form>
                            <input type="hidden" id="selected_mail_category" value="{$report_category}" />
                        </div>
                    </div>
                        
                    <div class="row-fluid">
                        <div class="span12 no-min-height no-ml">
                            <div class="pagination pagination-mini pagination-right pagin margin-none">
                                {if $pagination neq ''}<ul id="pagination">{$pagination}</ul>{/if}
                            </div>
                        </div>
                    </div>
                            
{*                    mail list*}
                    <div class="row-fluid">
                        <div class="span12 table-responsive">
                            <table id="table_list" name="table_list" class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 10px 0px 0px; top: 0px;">
                                <thead>
                                    <tr>
                                        {if $report_category eq 1}
                                            <th class="table-col-center center" style="width: 30px;"></th>
                                        {/if}
                                        <th></th>
                                        {if $report_category eq 1}
                                            <th>{$translate.from}</th>
                                        {elseif $report_category eq 2 or $report_category eq 3}
                                            <th>{$translate.to}</th>
                                        {/if}

                                        <th>{$translate.message}</th>
                                        <th>{$translate.date}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$mail_list item=list}
                                        <tr class="gradeX mail-row {cycle values="even,odd"}" {if $list.status eq 1}style="font-weight: bold"{/if} data-id='{$list.id}'>
                                            {if $report_category eq 1}
                                                <td class="center">
                                                    <i class="icon-mail-reply cursor_hand open_as_reply_mode" data-mail-id="{$list.id}" title="{$translate.reply}"></i>
                                                </td>
                                            {/if}
                                            <td style="width: 30px;" class="center">
                                                <i class="icon-mail-forward cursor_hand open_as_forward_mode"  data-mail-id="{$list.id}" title="{$translate.forward}"></i>
                                            </td>
                                            {if $report_category eq 1}
                                                {if $sort_by_name == 1}
                                                    <td style="width: 23%;">{$list.from_name}</td>
                                                {elseif $sort_by_name == 2}
                                                    <td style="width: 23%;">{$list.from_name_lf}</td>
                                                {/if}
                                            {elseif ($report_category eq 2) or ($report_category eq 3)}
                                                {if $sort_by_name == 1}
                                                    <td style="width: 23%;">{$list.to_name}</td>
                                                {elseif $sort_by_name == 2}
                                                    <td style="width: 23%;">{$list.to_name_lf}</td>
                                                {/if}
                                            {/if}
                                            <td class="content-col-style">
                                                <p class="mail-open limit-mail-subject pull-left no-mb cursor_hand {if $list.attachments != ""}have_attachment{/if}">
                                                    <span class="mr" style="font-size: 15px; {if $list.status eq 1}font-weight: bold;{/if}">{$list.subject}</span> 
                                                    {$list.message|truncate:120:"...":true}</p>
                                                {if $list.attachments != ""}<span class=""><i class="icon-paper-clip icon-large pull-right "></i></span>{/if}
                                            </td>
                                            <td>{$list.mail_date}</td>
                                        </tr>
                                    {foreachelse}
                                        <tr ><td colspan=8><div class="message">{$translate.no_data_available}</div></td></tr> 
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{*    main right*}
    <div class="span4 main-right hide">
        <div id="right_message_wraper" class="span12 no-min-height"></div>
        
{*        new mail template*}
        <div class="row-fluid hide" id="mail-create-template">
            <div class="span12 addnew-mail-visible" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="day-slot-wrpr-header-left pull-left">
                            <h1 style="">{$translate.compose_mail}</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="SendMail()" style="" type="button"><i class=' icon-location-arrow'></i> {$translate.send}</button>
                            <button class="btn btn-default btn-normal pull-right" onclick="reset_form()" style="margin-right: 5px;" type="button"><i class='icon-refresh'></i> {$translate.reset}</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <input type="hidden" id="operational_mail_id" name="operational_mail_id" value="" />
                        <input type="hidden" id="operational_mail_mode" name="operational_mail_mode" value="" />
                        <div class="row-fluid">
                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                <div style="margin: 0px 0px 10px ! important;" class="span12 hide no-ml" id="normal_to_wrpr">
                                    <label style="float: left;" for="mail_send_to">{$translate.to} :</label>
                                    <span class="pull-right clearfix">
                                        <span class="clearfix pull-left hide" style="padding-top: 5px; font-size: 11px;">{$translate.add_recipients}</span>
                                        <button id="btn_load_recipient_list" class="btn btn-default pull-right ml mb" title="{$translate.add_recipients}" style="font-size: 9px !important;">{$translate.add_recipients} <i class="icon-plus cursor_hand "></i></button>
                                    </span>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_to" id="mail_send_to" class="form-control span11" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12 hide no-ml" id="reply_to_wrpr">
                                    <label style="float: left;" class="span12" for="mail_send_to_for_reply">{$translate.to} :</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_to_for_reply" id="mail_send_to_for_reply" class="form-control span11" type="text" readonly="readonly" /> 
                                        <input name="mail_send_to_id_for_reply" id="mail_send_to_id_for_reply" type="hidden" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px 0px 10px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="mail_send_subject">{$translate.subject}:</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input name="mail_send_subject" id="mail_send_subject" class="form-control span11" type="text" /> 
                                    </div>
                                </div>
                                <div style="margin: 0px ! important;" class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="mail_send_body">{$translate.message}:</label>
                                    <textarea name="mail_send_body" id="mail_send_body" style="margin: 0px 0px 10px;" rows="1" class="form-control span12"></textarea>
                                </div>
                                <div class="span12 no-ml mt" style="overflow-x: auto;">
                                    <label style="float: left;" class="span12 mt pb">{$translate.attachments} <button class="btn btn-default" id="btn_add_attachment" title="{$translate.add_attachments}"><i class="icon-plus cursor_hand "></i></button></label>
                                    <div class="row-fluid span12 no-ml hide" id="mail_attachment_old_group">
                                    </div>
                                    <div style="margin: 10px 0px ! important; display: block ! important;" class="row-fluid mail-upload" id="mail_attachment_group">
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span5 form-right no-min-height" style="">
                                        <div style="margin: 0px;" class="span12 no-min-height">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
{*        mail send recipient list*}
        <div class="row-fluid hide" id="mail-recipient-list">
            <div class="span12" style="margin-left: 0px;">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="day-slot-wrpr-header-left pull-left">
                            <h1 style="">{$translate.edit}</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right"  onclick="select_multi_recipients()" style="" type="button"><i class=' icon-ok'></i> {$translate.add_new_recipient}</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-recipient-list" type="button"><i class='icon-arrow-left'></i> {$translate.cancel}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#mailing_list" aria-controls="mailing_list" role="tab" data-toggle="tab">{$translate.employee_all}</a></li>
                            <li role="presentation"><a href="#unsigned_employee" aria-controls="unsigned_employee" role="tab" data-toggle = "tab">{$translate.unsigned_employees}</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div  role="tabpanel" class="tab-pane active no-ml" id="mailing_list">
                                <div class="span12" id="options_panel">
                                    <div class="pull-right mt">
                                        <label class="pull-left" for="select_all">{$translate.select_all}</label>&nbsp
                                        <input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all">
                                    </div>
                                </div>
                               {foreach from=$employees_group item=employee}
                                    {if $employee.customer_name != 'ALL'}
                                        <div class="mailing_group no-ml">
                                            <ul class="span12 no-ml">
                                                <li class="mail_grup_customer span12">
                                                    <label for="cch_{$employee.customer_username}" class="pull-left">{$employee.customer_name}</label>
                                                    <input type="checkbox" value="{$employee.customer_username}" name="cch_{$employee.customer_username}" id="cch_{$employee.customer_username}" class="pull-right check_recipient_groups">
                                                </li>            
                                                <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                    <ul class="span12">
                                                        {foreach from=$employee.employees_customer item=empl}
                                                        <li class=" span12 no-ml">
                                                            <label class="pull-left" for="cch_{$empl.username}_{$employee.customer_username}">{$empl.first_name} {$empl.last_name}({$empl.username})</label>
                                                            <input type="checkbox" value="{$empl.first_name|escape:'html'} {$empl.last_name|escape:'html'}({$empl.username})" class="pull-right check_recipient_emp" id="cch_{$empl.username}_{$employee.customer_username}" name="cch_{$empl.username}_{$employee.customer_username}">
                                                        </li>
                                                        {/foreach}
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    {/if}
                                {/foreach}
                                {if $login_user_role eq 1}
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
                                                                <label class="pull-left" for="cch_{$employee.employees.username}">{$employee.employees.first_name} {$employee.employees.last_name}({$employee.employees.username})</label>
                                                                <input type="checkbox" value="{$employee.employees.first_name|escape:'html'} {$employee.employees.last_name|escape:'html'}({$employee.employees.username})" class="pull-right check_recipient_emp" id="cch_{$employee.employees.username}" name="cch_{$employee.employees.username}">
                                                            </li>
                                                        {/if}
                                                    {/foreach}
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                {/if}
                                </div>

                                <div role="tabpanel" class="tab-pane ml mt " id="unsigned_employee">
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <label>{$translate.year}</label>
                                        </div>
                                        <div class="span8">
                                            <select id="unsigned_employee_year" class="span12">
                                                {html_options values=$year_option_values_full selected=$current_year output=$year_option_values_full}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <label>{$translate.month}</label>
                                        </div>
                                        <div class="span8">
                                            <select id="unsigned_employee_month" class="span12">
                                                <option value="" >{$translate.select_month}</option>
                                                    {html_options values=$month_option_values selected=$prev_month output=$month_option_output_full}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- <div class="span4"></div> -->
                                        <div class="span6">
                                            <button type="button" class="btn btn-primary" onclick="get_unsigned_employee()">{$translate.get_employee}</button>
                                        </div>
                                        <div class="span6 mt">
                                            <div style="float: right;">
                                                <label  for="select_all">{$translate.select_all}</label>&nbsp
                                                <input type="checkbox" class="ml" value="all" id="recipient_check_all_unsigned" name="recipient_check_all">
                                            </div>
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="row-fluid mailing_group" >
                                        <ul id="employee_show" class="span12 no-ml">
                                            {if $current_unsigned_employees.status eq true}
                                                {if !empty($current_unsigned_employees.data)}
                                                    {foreach from = $current_unsigned_employees.data item = employee}
                                                        <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                            <label class="pull-left">{if sort_by_name == 1} {$employee.first_name} {$employee.last_name}{else} {$employee.last_name} {$employee.first_name}{/if}{$name}</label>
                                                            <input type="checkbox" class="pull-right check_recipient_emp" value="{if sort_by_name == 1} {$employee.first_name} {$employee.last_name}{else} {$employee.last_name} {$employee.first_name}{/if}({$employee.user_name})" >
                                                        </li>
                                                    {/foreach}
                                                {else}
                                                    <div class="span12 message">{$translate.no_data_available}</div>
                                                {/if}
                                            {/if}
                                        </ul>
                                    </div>

                                </div>
                        </div>


        







                      <!--   <div class="row-fluid">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">tab1</a></li>
                                <li role="presentation"><a href="#unsigned_employee" aria-controls="unsigned_employee" role="tab" data-toggle = "tab">{$translate.unsigned_employees}</a></li>
                            </ul>

                        </div> -->






   <!--
                        <div  class="tab-content row-fluid">
                          <div  role="tabpanel" class="tab-pane active span12 no-ml" id="mailing_list">
                                <div class="span12" id="options_panel">
                                    <label class="pull-left" for="select_all">{$translate.select_all}</label>
                                    <input type="checkbox" value="all" id="recipient_check_all" name="recipient_check_all" class="pull-right">
                                </div>
                               {* {foreach from=$employees_group item=employee}
                                    {if $employee.customer_name != 'ALL'}
                                        <div class="mailing_group span12 no-ml">
                                            <ul class="span12 no-ml">
                                                <li class="mail_grup_customer span12">
                                                    <label for="cch_{$employee.customer_username}" class="pull-left">{$employee.customer_name}</label>
                                                    <input type="checkbox" value="{$employee.customer_username}" name="cch_{$employee.customer_username}" id="cch_{$employee.customer_username}" class="pull-right check_recipient_groups">
                                                </li>            
                                                <li class="mail_grup_employees span12 no-ml mr no-pb no-pl no-pt">
                                                    <ul class="span12">
                                                        {foreach from=$employee.employees_customer item=empl}
                                                        <li class=" span12 no-ml">
                                                            <label class="pull-left" for="cch_{$empl.username}_{$employee.customer_username}">{$empl.first_name} {$empl.last_name}({$empl.username})</label>
                                                            <input type="checkbox" value="{$empl.first_name|escape:'html'} {$empl.last_name|escape:'html'}({$empl.username})" class="pull-right check_recipient_emp" id="cch_{$empl.username}_{$employee.customer_username}" name="cch_{$empl.username}_{$employee.customer_username}">
                                                        </li>
                                                        {/foreach}
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    {/if}
                                {/foreach}*}
                                {if $login_user_role eq 1}
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
                                                                <label class="pull-left" for="cch_{$employee.employees.username}">{$employee.employees.first_name} {$employee.employees.last_name}({$employee.employees.username})</label>
                                                                <input type="checkbox" value="{$employee.employees.first_name|escape:'html'} {$employee.employees.last_name|escape:'html'}({$employee.employees.username})" class="pull-right check_recipient_emp" id="cch_{$employee.employees.username}" name="cch_{$employee.employees.username}">
                                                            </li>
                                                        {/if}
                                                    {/foreach}
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                {/if}
                            </div> 
                            
                            <div  role="tabpanel" class="tab-pane active span12 no-ml" id="unsigned_employee">
                                fbfdhbh h
                            </div>-->

                    </div>
                </div>
            </div>
        </div>
        
{*        view mail*}
        <div class="span12 view-mail-visible no-ml hide">
            <div style="margin: 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="day-slot-wrpr-header-left pull-left">
                        <h1 style="">{$translate.mail}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button class="btn btn-default pull-right ml  open_as_forward_mode" type="button" data-mail-id=""><i class='icon-mail-forward'></i> {$translate.forward}</button>
                        <button class="btn btn-default pull-right mr open_as_reply_mode" type="button" data-mail-id=""><i class='icon-mail-reply'></i> {$translate.reply}</button>
                        <button class="btn btn-default btn-normal pull-right  btn-cancel-right" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <input type="hidden" id="opened_mail_id" value=""/>
                    <input type="hidden" id="opened_mail_subject" value=""/>
                    <input type="hidden" id="opened_mail_message" value=""/>
                    <div class="row-fluid hide" id="view_mail_content_wrpr"  style="overflow-x: auto;">
                        <table class="table table-white table-bordered table-hover table-responsive swipe-horizontal table-primary t" style="margin: 0px ! important; top: 0px; border-top: thin solid rgb(204, 204, 204);">
                            <tbody>
                                <tr class="gradeX">
                                    <td class="view-mail-from-to-label">{$translate.from}</td><td class="view-mail-from-to-value"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.subject}</td><td class="view-mail-subject"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.message}</td><td class="view-mail-message"  style="white-space: pre-wrap;"></td>
                                </tr>
                                <tr class="gradeX">
                                    <td class="">{$translate.attachments}</td><td class="view-mail-attachments"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
{/block}
