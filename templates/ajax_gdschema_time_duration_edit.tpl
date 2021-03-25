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