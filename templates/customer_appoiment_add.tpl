{block name='script'}

<script type="text/javascript">

       $(function() {

		$("#appoiment_date" ).datetimepicker({

		showOn: "button",

                dateFormat: 'yy-mm-dd',

		buttonImage: "{$url_path}images/date_pic.gif",

		buttonImageOnly: true

		});

	});



function validate_appoiment(){

    var error = 0;

    

    if ($("#appoiment_date").val() == ""){

             $("#appoiment_date").addClass("error");

             error++;

       }

       else{

            $("#appoiment_date").removeClass("error");

           /* var today = new Date("Y-m-d");alert(today);

            var datestring = $("#appoiment_date").val();

            var date = new Date(datestring);alert(datestring);

            if(date > today) {

                 //$("#appoiment_date").removeClass("error");

            }else{

                error++;

                 $("#appoiment_date").removeClass("error");

            }  

            */

     }

    /*

     if ($("#appoiment_address").val() == ""){ 

             $("#appoiment_address").addClass("error");

             error++;

       }

       else{

             $("#appoiment_address").css("style", "");

     }

     

     if ($("#phone_number").val() == ""){

             $("#phone_number").addClass("error");

             error++;

       }

       else{

             $("#phone_number").removeClass("error");

     }

     

     if ($("#reason").val() == ""){

             $("#reason").addClass("error");

             error++;

       }

       else{

             $("#reason").removeClass("error");

     }

     

     if ($("#remarks").val() == ""){

             $("#remarks").addClass("error");

             error++;

       }

       else{

             $("#remarks").removeClass("error");

     }

     

     if ($("#contact_person_name").val() == ""){

             $("#contact_person_name").addClass("error");

             error++;

       }

       else{

             $("#contact_person_name").removeClass("error");

     }

     

     if ($("#phone_number_cp").val() == ""){

             $("#phone_number_cp").addClass("error");

             error++;

       }

       else{

             $("#phone_number_cp").removeClass("error");

     }

     

     if ($("#phone_number").val() == ""){

             $("#phone_number").addClass("error");

             error++;

       }

       else{

             $("#phone_number").removeClass("error");

     }

     */

     if ($("#email_cp").val() != ""){

            var x = $("#email_cp").val();

             var dotpos=x.lastIndexOf(".");

              var atpos=x.indexOf("@");

               if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)

                  {

                       $("#email_cp").addClass("error");

                       error++;

                  }else{

                  $("#email_cp").removeClass("error");

                }

     }

     

     if($('#email_alert').attr('checked')) {

          $("#cust_email_div").show(); 

         if ($("#cust_email").val() == ""){

                 $("#cust_email").addClass("error");

                 error++;

            }

            else{

                  $("#cust_email").removeClass("error");

          }

      }else{

         $("#cust_email").removeClass("error");

         $("#cust_email_div").hide();

      } 

      

     if($('#sms_alert').attr('checked')) {

         $("#cust_phone_div").show();  

         if ($("#cust_number").val() == ""){

                 $("#cust_number").addClass("error");

                 error++;

            }

            else{

                  $("#cust_number").removeClass("error");

          }

      }else{

         $("#cust_number").removeClass("error");

         $("#cust_phone_div").hide();

     } 

     

     if($('#sms_alert').attr('checked') || $('#email_alert').attr('checked')) {

        $("#reminder_time_div").show();

        

        if ($("#reminder_before_date").val() == ""){

             $("#reminder_before_date").addClass("error");

             error++;

            }

            else{

                  $("#reminder_before_date").removeClass("error");

          }

        

     }else{

         $("#reminder_time_div").hide();

     }

     

    if(error > 0){

        return false;

    }else{

         return true;

    }

} 

email_reminder();

function email_reminder(){

     if($('#email_alert').attr('checked')) {

          $("#cust_email_div").show(); 

      }else{

         $("#cust_email_div").hide();

      } 

      

     if($('#sms_alert').attr('checked')) {

         $("#cust_phone_div").show();  

      }else{

         $("#cust_phone_div").hide();

     } 

     

     if($('#sms_alert').attr('checked') || $('#email_alert').attr('checked')) {

        $("#reminder_time_div").show();

        $("#repeat_until_due_date_div").show();

     }else{

         $("#reminder_time_div").hide();

         $("#repeat_until_due_date_div").hide();

     }



}

function tool_tip(){

	$("#tool_tip_show").show();

}

function tool_tip_out(){

	$("#tool_tip_show").hide();

}



</script>

{/block}

{block name='content'}

<div>

    <form name="form" id="form" method="post" onsubmit="return validate_appoiment();" enctype="multipart/form-data" action="{$url_path}customer_appoiment_add.php">

            <input type="hidden" name="username" id="username" value="{$cust}" />

            <input type="hidden" name="customers" id="customers" value="{$customers_uname}" />

            <input type="hidden" name="mode" id="mode" value="{$mode}" />

            

                       

                           <div class="equi_date">

                                <label for="issueddate">{$translate.appoiment_date}</label>

                                <input type="text" name="appoiment_date" readonly="readonly" id="appoiment_date" class="clear required appoiment_date" {if $appoiments_arr.appoiment_date != ""} value="{$appoiments_arr.appoiment_date|substr:0:-3}" {else} value="" {/if} />

                            </div>

                            <div class="equi_raw" style="height:47px;">

                                <label for="equipment_names">{$translate.appoiment_address}</label>

                                <textarea name="appoiment_address" style="width:160px;height:40px;float:left;" cols="40" rows="3" id="appoiment_address" class="" >{$appoiments_arr.appoiment_address}</textarea>

                            </div>

                            <div class="equi_raw">

                                <label for="equipment_nums">{$translate.phone_number}</label>

                                <input type="text" name="phone_number" id="phone_number" class="clear required" 
                                 {if $appoiments_arr.phone_number != "" && $appoiments_arr.phone_number != 0} value="{$appoiments_arr.phone_number}" {else} value="" {/if}  />

                            </div>

                           <div class="equi_raw">

                                <label for="equipment_nums">{$translate.appoiment_reason}</label>

                                <input type="text" name="reason" id="reason" class="clear required"  {if $appoiments_arr.reason != ""} value="{$appoiments_arr.reason}" {else} value="" {/if}  />

                            </div>

                            <div class="equi_raw" style="height:47px;">

                                <label for="equipment_names">{$translate.appoiment_remarks}</label>

                                <textarea name="remarks" style="width:160px;height:40px;float:left;" cols="40" rows="3" id="remarks" class="clear required">{$appoiments_arr.remarks}</textarea>

                            </div>

                           <div class="equi_raw">

                                <label for="equipment_nums">{$translate.contact_person_name}</label>

                                <input type="text" name="contact_person_name" id="contact_person_name" class="clear required"  {if $appoiments_arr.contact_person_name != ""} value="{$appoiments_arr.contact_person_name}" {else} value="" {/if}  />

                            </div>

                            <div class="equi_raw">

                                <label for="equipment_nums">{$translate.phone_number_cp}</label>

                                <input type="text" name="phone_number_cp" id="phone_number_cp" class="clear required"  {if $appoiments_arr.phone_number_cp != ""} value="{$appoiments_arr.phone_number_cp}" {else} value="" {/if}  />

                            </div>

                            <div class="equi_raw">

                                <label for="equipment_nums">{$translate.email_cp}</label>

                                <input type="text" name="email_cp" id="email_cp" class="clear required email"  {if $appoiments_arr.email_cp != ""} value="{$appoiments_arr.email_cp}" {else} value="" {/if}  />

                            </div>

                            <div class="equi_raw"  >

                                <input style="float:left;width:19px;margin-top:8px;" onclick="email_reminder();" type="checkbox" name="email_alert" id="email_alert"   {if $appoiments_arr.email_alert == 1} checked {/if} value="1"  />

                                <label for="equipment_nums" style="width:83%;" >{$translate.remind_me_approintment_over_email}</label>

                            </div>

                            <div class="equi_raw" id="cust_email_div" >

                                <label for="equipment_nums">{$translate.email}</label>

                                <input type="text" name="cust_email" id="cust_email"  class="clear required email"  {if $appoiments_arr.cust_email != ""} value="{$appoiments_arr.cust_email}" {else} value="{$customer_arr[0].email}" {/if}  />

                            </div>

                            <div class="equi_raw">

                                <input style="float:left;width:19px;margin-top:8px;" type="checkbox" name="sms_alert" id="sms_alert" onclick="email_reminder();"   {if $appoiments_arr.sms_alert == 1} checked {/if} value="1"  />

                                <label for="equipment_nums" style="width:83%;" >&nbsp;&nbsp;{$translate.remind_me_about_this_approintment_over_sms}

                                <img  src="{$url_path}images/tool_tip.png" style="float:left;margin-top:3px;" title="{$translate.sms_alert_chage_tooltip}"  ></label> 

                                <!--onmouseover="tool_tip();" onmouseout="tool_tip_out();"<div id="tool_tip_show"  style="margin: 0.5em 0;padding: 0.5em;border-color: 1px solid #7BB9C7;border-radius: 1em;background: url('../images/kunderhd_bg.jpg') repeat-x scroll 0 0 transparent;color: black;position: relative;" >{$translate.sms_alert_chage_tooltip}</div>-->

                            </div>

                            <div class="equi_raw" id="cust_phone_div" >

                                <label for="">{$translate.phone_number} ({$translate.number_where_alert_should_sent})</label>

                                <input type="text" name="cust_number" id="cust_number" class="clear required email"  {if $appoiments_arr.cust_number != ""} value="{$appoiments_arr.cust_number}" {else} value="{$customer_arr[0].mobile}" {/if}  />

                            </div>

                            <div class="equi_raw" id="reminder_time_div" >

                                <label for="equipment_nums">{$translate.reminder_before}</label>

                                <input type="text" style="width:30px;" name="reminder_before_date" id="reminder_before_date" class="clear required"  {if $appoiments_arr.reminder_before_date != ""} value="{$appoiments_arr.reminder_before_date}" {else} value="" {/if}  />

                                &nbsp;&nbsp;

                                <select name="reminder_time" id="reminder_time" style="margin-right:35px;width:68px;" class="clear required" >

                                    <option value="hours" >{$translate.label_hours}</option>

                                    <option {if $appoiments_arr.reminder_before_date == "days"}selected{/if} value="days" >{$translate.label_days}</option>

                                </select>

                            </div>

                             <div class="equi_raw" id="repeat_until_due_date_div" >

                                <input style="float:left;width:11px;margin-top:8px;" type="checkbox" name="repeat_until_due_date" id="repeat_until_due_date" class="clear required email"  {if $appoiments_arr.repeat_until_due_date == 1} checked {/if} value="1"  />

                                <label for="equipment_nums"  style="width:63%;">{$translate.repeat_until_due_date}</label>

                            </div>

                              <input type="hidden" name="id" id="id"  {if $appoiments_arr.id != ""} value="{$appoiments_arr.id}" {else} value="" {/if} />

                            {if $names == ""}  

                                 <div class="equipment_bu_add"><input name="add" type="submit" value="{$translate.save}" /></div>

                            {else} 

                                <div class="equipment_bu_add"><input name="edit" type="submit" value="{$translate.save}" /></div>

                            {/if}

                        </div>

                        <div id="form_err" class="form_error"></div>              

                     

    </form>

</div>

{/block}