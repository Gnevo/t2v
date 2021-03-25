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
      
     /* $(function() {
		var availableTags = [
			{assign i 0}{foreach from=$employees item=employee}
                     "{$employee.first_name} {$employee.last_name}",       
                    {/foreach}
                        ""
                                
                            
		];
		$( "#item" ).autocomplete({
			source: availableTags,
                        maxWidth: 30
		});
	});*/
       $(document).ready(function() {
         /*   $( "#to" ).datepicker({
           showOn: "button",
           dateFormat: "yy-mm-dd",
           buttonImage: "{$url_path}images/date_pic.gif",
           buttonImageOnly: true
       });*/
           
	
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
        });
        
        
        function submitForm()
        {
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

        function reset_form()
        {
                //$("#timing").reset();
                document.getElementById("timing").reset();
        }
        
        function validate()
            {
                /*if($("#radio1").is(":checked") == false && $("#radio3").is(":checked") == false)
                    {
                    $("#err_msg").html("{$translate.select_one}");	
                    return false;      
                    }*/
                return true;
            } 
            
            
    function popup_mail(url)
     {
         var dialog_box_new = $("#mail_popup" );
        // var value = $("#name_"+id).val();
    // load remote content
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
    </div>
    <div class="add_contract_main">
        <div class="incnvnt_dv">
            <div class="incnvnt_dv_ttle">{$translate.compose_mail}</div>
            <div class="incnvnt_dv_dtl">
                
               
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.to}:</div>
                    <div class="time_flds_fld">
                        {if $method == 1}
                            <input name="to_reply" id="to_reply" type="text" class="time_fld_dt_pick"  style="width: 360px"  value="{$mails.from_name}" readonly="readonly"/>
                            <input name="to" id="to_reply1" type="hidden" class="time_fld_dt_pick"  style="width: 360px"  value="{$mails.from}" />
                            {else}
                    <!-- <select name="to" id="to"    style="width: 360px">
                         <option>{$translate.select}</option>
                         {foreach from=$employees item=employee}
                             <option value="{$employee.username}" {if $mails.from == $employee.username && $method == 1} selected="selected" {/if}>{$employee.first_name} {$employee.last_name} </option>       
                        {/foreach}
                    </select>-->
                        <input name="to" id="to" type="text" class="time_fld_dt_pick"  style="width: 360px" {if $method == 1}value="{$mails.from_name}({$mails.from})" {/if}/>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="popup_mail('{$url_path}mail_add_popup.php')" >{$translate.insert_mailing_ids}</a>
                    {/if}
                    <!--<input name="to" id="to" type="text" class="time_fld_dt_pick"  style="width: 360px"/>-->
                    </div>
                </div>   
                    
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.subject}:</div>
                    <input name="subject" id="subject" type="text" class="time_fld_dt_pick"  style="width: 360px" {if isset($mails) && $method == 2} value="{$mails.subject}" readonly="readonly"{/if}{if isset($mails) && $method == 1} value="RE: {$mails.subject}"{/if}/>
                </div>  
                    {if isset($mails) && $method == 2}
                    <div class="mail_dtl_dvs"> 
                        <div class="incnvnt_lft_nme" >{$translate.attach_a_file}:</div>
                        <input type="text" name="file" id="file" class="time_fld_dt_pick"  style="width: 360px"value="{$mails.attachments}" readonly="readonly"/> 
                    </div>
                {else}
                    <div class="mail_dtl_dvs"> 
                        <div class="incnvnt_lft_nme" >{$translate.attach_a_file}:</div>
                        <input type="file" name="file" id="file" class="time_fld_dt_pick"  style="width: 360px" /> 
                    </div> 
                {/if}
                    
                <div class="notes_dtl_dvs">
                    <div class="incnvnt_lft_nme">{$translate.message}:</div>
                    <textarea rows="2" cols="60" name="mail_body" id="mail_body" class="mail_body_text" {if isset($mails) && $method == 2}readonly="readonly" {/if}>{if isset($mails) && $method == 2} {$mails.message} {/if}{if isset($mails) && $method == 1} {$mails.message} {/if}</textarea>
                </div> 

                        
                        
            </div>  
        </div>

    </div>

</form>   
{/block}
