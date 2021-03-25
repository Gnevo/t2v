{block name='script'}
<script type="text/javascript">
       $(function() {
		$( "#issued_dates" ).datepicker({
		showOn: "button",
		buttonImage: "{$url_path}images/date_pic.gif",
		buttonImageOnly: true
		});
		$( "#returned_dates" ).datepicker({
		showOn: "button",
		buttonImage: "{$url_path}images/date_pic.gif",
		buttonImageOnly: true
		});
	});
         $(function() {
		var availableTags1 = [
			{assign i 0}{foreach from=$equipments item=itemss}
                     "{$itemss.equipment}",       
                    {/foreach}
                        ""
                                
                            
		];
                var availableTags2 = [
			{assign i 0}{foreach from=$serial_numbers item=serial_number}
                     "{$serial_number.serial_number}",       
                    {/foreach}
                        ""
                                
                            
		];
                
		$( "#equipment_names" ).autocomplete({
			source: availableTags1,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_names").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                $( "#equipment_nums" ).autocomplete({
			source: availableTags2,
                            
                                
                            open: function(event, ui) { 
                                          $("#hiden_val1").val(1);        
                                        },
                              close: function(event, ui) { 
                                  $("#hiden_val1").val(0);
                                    },
                            focus:function(event, ui ){
                               // $("#hiden_val").val(1);
                                    $("#equipment_nums").val(ui.item.item);
                                    //alert($("#hiden_val").val());
                                }
                                    
                                 
                        
		});
                
                   
	});
   
function submitForm(){
    var errors = 0;
    if($("#equipment_names").val() == "" || $("#equipment_names").val() == null){
        $("#equipment_names").addClass("error");
        errors = 1;
    }else{
        $("#equipment_names").removeClass("error");
    }
    if($("#equipment_nums").val() == "" || $("#equipment_nums").val() == null){
        $("#equipment_nums").addClass("error");
        errors = 1;
    }else{
        $("#equipment_nums").removeClass("error");
    }
    if($("#issued_dates").val() == "" || $("#issued_dates").val() == null){
        $("#issued_dates").addClass("error");
        errors = 1;
    }else{
        $("#issued_dates").removeClass("error");
    }
    if($("#returned_dates").val() != ""){
        if($("#issued_dates").val() > $("#returned_dates").val()){
            alert("{$translate.return_date_greater}");
            $("#returned_dates").addClass("error");
            errors = 1;
        }
    }else{
        $("#returned_dates").removeClass("error");
    }
    
    if(errors == 0){
      $("#forms").submit();
    }
    
}
        
</script>
{/block}
{block name='content'}
<div>
    <form name="forms" id="forms" method="post" enctype="multipart/form-data" action="{$url_path}customer_equipment_issue_popup.php">
            <input type="hidden" name="username" id="username" value="{$cust}" />
            <input type="hidden" name="hiden_val" id="hiden_val" value="" />
            <input type="hidden" name="hiden_val1" id="hiden_val1" value="" />
            
                       
                            <div class="equi_raw">
                                <label for="equipment_names">{$translate.name}</label>
                                <input autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" type="text" name="equipment_names" id="equipment_names" class="clear required" {if $names != ""} value="{$names}" {else} value="" {/if} />
                                
                            </div>
                            <div class="equi_raw">
                                <label for="equipment_nums">{$translate.serial_number}</label>
                                <input type="text" name="equipment_nums" id="equipment_nums" class="clear required"  {if $serials != ""} value="{$serials}" {else} value="" {/if}  />
                            </div>
                        
                          
                       
                            <div class="equi_date">
                                <label for="issueddate">{$translate.issue_date}</label>
                                <input type="text" name="issued_dates" id="issued_dates" class="clear required issued_date" {if $issues != ""} value="{$issues}" {else} value="" {/if} />
                            </div>
                             <div class="equi_date">
                                <label for="returneddate">{$translate.return_date}</label>
                                <input type="text" name="returned_dates" id="returned_dates" class="clear returned_date"  {if $returns != ""} value="{$returns}" {else} value="" {/if} />
                                <input type="hidden" name="id_equipment" id="id_equipment" class="clear returned_date"  {if $ids != ""} value="{$ids}" {else} value="" {/if} />
                                <!-- <div id="err" class="form_error" style="font-weight:normal; color:#FF0000; line-height:18px;"></div> -->
                            </div>
                            {if $names == ""}
                            
                                <div class="equipment_bu_add"><input name="add" type="button" value="{$translate.save}" onclick="submitForm()" /></div>
                                <input type="hidden" name="method" id="method" value="add" />
                            
                             
                        
                        {else} 
                            <div class="equipment_bu_add"><input name="edit" type="button" value="{$translate.save}" onclick="submitForm()" /></div>
                            <input type="hidden" name="method" id="method" value="edit" />
                        {/if}
                        
                        <div id="form_err" class="form_error"></div>              
                     
    </form>
</div>
{/block}