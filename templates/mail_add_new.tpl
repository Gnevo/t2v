{block name='style'}
<style type="text/css">
    .new{
        display:none;
    }
</style>
{/block}
{block name="script"}
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
     
    $(function() {
        var availableTags = [
            {foreach from=$employees item=employee}
                     {if $sort_by_name == 1}
                        "{$employee.first_name} {$employee.last_name}({$employee.username})",       
                    {elseif $sort_by_name == 2}
                        "{$employee.last_name} {$employee.first_name}({$employee.username})",       
                    {/if}      
                    {/foreach}
                        ""
            
        ];
//        alert("hai");
//        for(var i=0;i<availableTags.lenght;i++){
//            
//            alert(availableTags[i]);
//        }
        function split( val ) {
                return val.split( /,\s*/ );
        }
        function extractLast( term ) {
                return split( term ).pop();
        }

        $( "#to" )
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
        var counts_file = 0;
         $("#timing").validate({

                 rules: {
                         to: {
                                 required: true
                         },
                         subject: {
                                 required: true
                         },
                         mail_body: {
                                 required: true
                         }
                 }



         });
         
         attachment_btn = "<div class='incnvnt_dtl_dvs' style='width:100%; float:left;'>\n\
                                <div class='incnvnt_lft_nme'>&nbsp;</div>\n\
                                <div style='float:left;'>\n\
                                    <input type='button' class='attachment_more' value='{$translate.add_more}'  style='width: 80px; float:left;'/> \n\
                                </div>\n\
                            </div>";
                        
        attachment_div = "<input type='file' name='attachment[]'  style='float:left;'/>\n\
                            <input type='button' class='remove_attachment' name='removeButton' value='{$translate.remove}'  style='width: 70px; float:left;margin-left:20px;' />";
        
      
     });
        
        
    function submitForm(){
        var subject = $("#subject").val();
        var message = $("#mail_body").val();
        var error = 0;
        if(subject == ""  && message == "" ){
            $("#subject").addClass("error");
            $("#mail_body").addClass("error");
             $('#subject').focus();
             error = 1;
        }
        if(subject == "" || subject == null){
            $("#subject").addClass("error");
            $('#subject').focus();
            error = 1;
        }
        else{
            $("#subject").removeClass("error");
            error = 0;
        }
         if(message == "" || message == null){
            $("#mail_body").addClass("error");
            $('#mail_body').focus();
            error = 1;
        }
        else{
            $("#mail_body").removeClass("error");
            error = 0;
        }if(error == 0){
            $("#timing").submit();
            }
    }

    function reset_form(){
            //$("#timing").reset();
            document.getElementById("timing").reset();
    }
        
    function validate(){
            /*if($("#radio1").is(":checked") == false && $("#radio3").is(":checked") == false)
                {
                $("#err_msg").html("{$translate.select_one}");	
                return false;      
                }*/
            return true;
    } 

    function popup_mail(url){
        var dialog_box_new = $("#mail_popup" );
        dialog_box_new.load(url);
        // open the dialog
        dialog_box_new.dialog({

            title: '{$translate.edit}',
            position: 'top',
            modal: true,
            resizable: false,
            minWidth: 500,
            height:550,
            closeOnEscape: false,
            dialogClass: 'no-close',
            buttons: {
                '{$translate.cancel}': function() {
                    $(this).dialog("close");
                },
                '{$translate.inserts}': function() {
                    var val = $("#mail_ids").val();
                    $("#to").val(val);
                    $("#mail_ids").val('');
                    $(this).dialog("close");
                }
            }
        });
        return false;
    }
    
    function attachAnother() { 
       var file_count = parseInt($('#file_count').val()) + 1;
       var heights = parseInt($("#attach").height());
       if(file_count == 0){
            heights = 0;
            $('#attach').append('<input style="width:273px;" type="file" name="attachments[]" id="file_'+file_count+'" class="time_fld_dt_pick"  style="width: 360px" /><input type="button" class="remove_attachment" name="removeButton_'+file_count+'" id="removeButton_'+file_count+'" value="{$translate.remove}"  style="width: 70px; float:left;margin-left:20px;" onclick="removeFile('+file_count+')"/>');
       }else{
            $('#attach').append('<input style="margin-left:175px;width:273px;" type="file" name="attachments[]" id="file_'+file_count+'" class="time_fld_dt_pick"  style="width: 360px" /><input type="button" class="remove_attachment" name="removeButton_'+file_count+'" id="removeButton_'+file_count+'" value="{$translate.remove}"  style="width: 70px; float:left;margin-left:20px;" onclick="removeFile('+file_count+')"/>');
       }
       $("#attach").height(heights+30);
       $('#file_count').val(file_count);
       
    }
    
    function removeFile(count){
        var heights = parseInt($("#attach").height());
        if(heights == 26){
            heights = 52;   
        }
        $("#attach").height(heights-30)
        $('#file_'+count).remove();
        $('#removeButton_'+count).remove();
        var file_count = parseInt($('#file_count').val()) - 1;
        $('#file_count').val(file_count);
        
    }

    function addFilenamesAttachment(fname,check_id){
        if($("#check_"+check_id).attr('checked')){
            var file_names = $("#file_names").val();
            if(file_names == "" || file_names == null){
                file_names = fname;
            }else{
                file_names = file_names+","+fname;
            }
            $("#file_names").val(file_names);
        }else{
            var file_names = $("#file_names").val();
            var tmp_file_names = file_names.split(",");
            var new_temp_files = "";
            for(var i=0;i<tmp_file_names.length;i++){
                if(tmp_file_names[i] != fname){
                    if(new_temp_files == ""){
                        new_temp_files = tmp_file_names[i];
                    }else{
                        new_temp_files = new_temp_files+","+tmp_file_names[i];
                    }
                }
            }
            $("#file_names").val(new_temp_files);
        }
    }
    function downloadFile(filename){
        document.location.href = "{$url_path}download.php?{$folder}"+filename;
    }

    </script>
{/block}


{block name="content"}
<div class="clearfix" id="mail_popup" style="display:none; overflow: auto;"></div>
{$message}
<form name="timing" id="timing" method="post" onsubmit="return validate()" enctype="multipart/form-data">
    <div class="tbl_hd"><span class="titles_tab">{$translate.mail}</span>
        <a class="send" href="javascript:void(0);" onclick="submitForm()"><span class="btn_name">{$translate.send}</span></a>
        <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
        <a class="back" href="{$url_path}mail/list/"><span class="btn_name">{$translate.backs}</span></a>
        <input type="hidden" name="method" value="{$method}" />
        <input type="hidden" name="id_mail" value="{$id_mail}" />
        <input type="hidden" name="file_count" id="file_count" value="-1" />
        <input type="hidden" name="file_names" id="file_names" value="{$old_files}" />
    </div>
    <div class="add_contract_main clearfix">
        <div class="incnvnt_dv">
            <div class="incnvnt_dv_ttle">{$translate.compose_mail}</div>
            <div class="incnvnt_dv_dtl clearfix">
                
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.to}:</div>
                    <div class="time_flds_fld">
                        {if $method == 1}
                            <input name="to_reply" id="to_reply" type="text" class="time_fld_dt_pick"  style="width: 250px; " value="{$mails.from_name}" readonly="readonly"/>
                            <input name="to" id="to_reply1" type="hidden" class="time_fld_dt_pick"  style="width: 250px"  value="{$mails.from}" />
                        {else}
                            <input name="to" id="to" type="text" class="time_fld_dt_pick"  style="width: 250px;" {if $method == 1}value="{$mails.from_name}({$mails.from})" {/if}/><a style="margin: 3px 0px 0px 38px; float: right;"href="javascript:void(0)" onclick="popup_mail('{$url_path}mail_add_popup.php')" >{$translate.insert_mailing_ids}</a>
                        {/if}
                    </div>
                </div>   
                    
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.subject}:</div>
                    <input name="subject" id="subject" type="text" class="time_fld_dt_pick"  style="width: 360px;" {if isset($mails) && $method == 2} value="FWD: {$mails.subject}" {/if}{if isset($mails) && $method == 1} value="RE: {$mails.subject}"{/if}/>
                </div>  
                {if isset($mails) && $method == 2 and $no_attach != 1}
                        <div class="mail_dtl_dvs"> 
                            <div class="incnvnt_lft_nme" ></div>
                            {assign i 0}
                            {foreach $attachments as $attachment}
                                <div class="time_fld_dt_pick" style="background: none;border: none;width: auto;"><input style="margin-top: 2px;float: left;" type="checkbox" name="check_{$i}" id="check_{$i}"onclick="addFilenamesAttachment('{$attachment}','{$i}')" checked="checked"/><a style="padding-left: 5px; float: left;padding-top: 3px;" href="javascript:void(0)" onclick="downloadFile('{$attachment}')">{$attachment}</a></div>
                                {assign i $i+1}
                            {/foreach}

                        </div>
                {/if}
                
                <div class="mail_dtl_dvs" id="attach"> 
                    <div class="incnvnt_lft_nme" >{$translate.attach_a_file}:</div>
                    
                   <!-- <span style="float: right; margin-right: 30px;margin-top: 5px;"> <a style="color: slateblue" href="javascript:void(0);" onclick="attachAnother()">{$translate.upload_new_file}</a> /
                        <a style="color: slateblue" href="javascript:void(0);" onclick="removeFile()">{$translate.delete_file}</a></span>-->
                </div>
                <div class='incnvnt_dtl_dvs' style='width:100%; float:left;'>
                    <div class='incnvnt_lft_nme'>&nbsp;</div>
                    <div style='float:left;'>
                        <input type='button' class='attachment_more' value='{$translate.add_more}'  style='width: 110px; float:left;' onclick="attachAnother()"/>
                    </div>
                </div>
                
                    <div class="notes_dtl_dvs" style="height: 190px;">
                    <div class="incnvnt_lft_nme">{$translate.message}:</div>
                    <textarea rows="2" cols="60" name="mail_body" id="mail_body" class="mail_body_text" >{if isset($mails) && $method == 2} {$mails.message} {/if}{if isset($mails) && $method == 1} {$mails.message} {/if}</textarea>
                </div> 
 
            </div>  
        </div>

    </div>

</form>   
{/block}
