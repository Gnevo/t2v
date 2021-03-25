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
                $("#timing").submit();
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
            
            function replyMail(id){
                document.location.href = "{$url_path}mail/add/1/"+id+"/";
            }

            function forwardMail(id){
                document.location.href = "{$url_path}mail/add/2/"+id+"/";
            }
            function downloadFile(filename){
                document.location.href = "{$url_path}download.php?{$folder}"+filename;
            }
    </script>
{/block}


{block name="content"}
{$message}
<form name="timing" id="timing" method="post" onsubmit="return validate()" enctype="multipart/form-data">
    <div class="tbl_hd"><span class="titles_tab">{$translate.mail}</span>
        <a class="forward" href="javascript:void(0);" onclick="forwardMail('{$id_mail}')"><span class="btn_name">{$translate.forward}</span></a>
        {if $met == 1} <a class="reply" href="javascript:void(0);" onclick="replyMail('{$id_mail}')"><span class="btn_name">{$translate.reply}</span></a>{/if}
        <a class="back" href="{$url_path}mail/list/"><span class="btn_name">{$translate.backs}</span></a>
        <input type="hidden" name="method" value="{$method}" />
        <input type="hidden" name="id_mail" value="{$id_mail}" />
    </div>


    <div class="add_contract_main">
        <div class="incnvnt_dv">
            <div class="incnvnt_dv_ttle">{$translate.compose_mail}</div>
            <div class="incnvnt_dv_dtl">
                
               
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{if $met == 1}{$translate.from}:{else}{$translate.to}:{/if}</div>
                    <div class="time_flds_fld">
                        <input name="to" id="to" type="text" class="time_fld_dt_pick"  style="width: 360px" readonly="readonly"{if $sort_by_name == 1}value="{$mails.from_name}"{elseif $sort_by_name == 2}value="{$mails.from_name_lf}"{/if} />
                    </div>
                </div>   
                    
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.subject}:</div>
                    <input name="subject" id="subject" type="text" class="time_fld_dt_pick"  style="width: 360px" readonly="readonly" value="{$mails.subject}" />
                </div>  
                
                <div class="mail_dtl_dvs"> 
                    <div class="incnvnt_lft_nme">{$translate.attachments}:</div>
                  {if $mails.attachments != ""} 
                      {foreach $attachments as $attachment}
                          <div class="time_fld_dt_pick" style="background: none;border: none;width: auto;"><a href="javascript:void(0)" onclick="downloadFile('{$attachment}')">{$attachment}</a></div>
                {/foreach}{/if}
                </div>  
                    
                <div class="notes_dtl_dvs">
                    <div class="incnvnt_lft_nme">{$translate.message}:</div>
                    <textarea rows="2" cols="60" name="mail_body" id="mail_body" class="mail_body_text" readonly="readonly"> {$mails.message} </textarea>
                </div> 

                        
                        
            </div>  
        </div>

    </div>

</form>   
{/block}
