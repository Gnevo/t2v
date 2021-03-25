{block name="script"}
<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
<script src="{$url_path}js/use_template.js" type="text/javascript" ></script>
<script>
$(document).ready(function() {

	$("#todate").datepicker({
            showOn: "button",
            buttonImage: "{$url_path}images/date_pic.gif",
            buttonImageOnly: true
        });
	
	$(function() {
        var availableTags = [
            {foreach from=$customerlist item=customer}  
                    {if $sort_by_name == 1}
                        {
                    value: "{$customer.username}",
                    label: "{$customer.first_name} {$customer.last_name}"
                    },
                    {elseif $sort_by_name == 2}
                    {
                    value: "{$customer.username}",
                    label: "{$customer.last_name} {$customer.first_name}"
                    },
                    {/if}
                    
            {/foreach}
        ];
        $( "#emp" ).autocomplete({
            minLength: 0,
            source: availableTags,
            focus: function( event, ui ) {
                $( "#emp" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#emp" ).val( ui.item.label );
                $( "#employee-id" ).val( ui.item.value );
                getCustomerTemplate(ui.item.value);
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };
    });
    //hide a div after 3 seconds
    setTimeout( "jQuery('.success').hide(2000);",10000 );
    
    
    $.fn.serializeObject = function()   //by shamsudheen
    {
        var o = { };
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $('.success, .message, .fail, .error').delay(10000).fadeOut();
}); 

function saveScheduleData_exist_check(){
        var url_data_obj = $('#frmadddata').serializeObject();
        wrapLoader("#tble_list #confirmmessage .ui-dialog-buttonpane");
        $.ajax({
                url: "{$url_path}ajax_check_slot_exist_for_save_schedule.php",
                type: "POST",
                data: url_data_obj,
                dataType: "json",
                success:function(data){
{*                    console.log(data);*}
                    uwrapLoader("#tble_list  #confirmmessage .ui-dialog-buttonpane");
                    if(data.exists == 'no'){
                        saveScheduleData();
                    } else {
                        var exist_msg = '{$translate.slots_are_already_existed_on_week}';
{*                        alert('length: '+data.exists_weeks.length);*}
                        $.each(data.exists_weeks, function( index, value ) {
                            if(index > 0){
                                exist_msg += ', {$translate.several}';
                                return;
                            }
                            var year_week = value.split('|');
                            exist_msg += year_week[1];
                            
                        });
                        $("#dialog-confirm p").html("<span class='error_msg_icon'></span>" + exist_msg + " " + "<br/>{$translate.do_you_want_to_continue}");
                        $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height:160,
                            modal: true,
                            buttons: {
                                "{$translate.yes}": function() {
                                        $( this ).dialog( "close" );
                                        saveScheduleData();
                                },
                                "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        }); 
                    }
                }
        }); 
}

function saveScheduleData(){
{*        var url = JSON.stringify($('#frmadddata').serializeObject());*}
        var url_data_obj = $('#frmadddata').serializeObject();
        url_data_obj.type_check = 16;
        url_data_obj.action = 'save_schedule_template';
{*        console.log(url_data_obj);*}
{*        return false;*}
        $('#atl_warnings').val('');
        {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
            wrapLoader("#tble_list #confirmmessage .ui-dialog-buttonpane");
            $.ajax({
                url: "{$url_path}ajax_check_atl_and_contract.php",
                type: "POST",
                data: url_data_obj,
                dataType: "json",
                success:function(data){
{*                        console.log(data);*}
                       uwrapLoader("#tble_list  #confirmmessage .ui-dialog-buttonpane");
                       {if $company_atl_checking_flag eq 1}
                            if(data.atl == 'success'){
                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                     jQuery('#frmadddata').submit(); 
                                {else}  /*checking contract*/
                                     if(data.contract == 'success'){
                                         jQuery('#frmadddata').submit(); 
                                     }else{
                                         {if $privilages['contract_override'] == 1}
                                             $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>"+ data.contract_params.error_msg);
                                             $( "#dialog-confirm-contract" ).dialog({
                                                     resizable: false,
                                                     width: 350,
                                                     modal: true,
                                                     buttons: {
                                                         "{$translate.yes}": function() {
                                                                 $( this ).dialog( "close" );
                                                                 jQuery('#frmadddata').submit(); 
                                                         },
                                                         "{$translate.no}": function() {
                                                             $( this ).dialog( "close" );
                                                         }
                                                     }
                                             });
                                         {else}
                                             $("#overlap_error").remove();
                                             $("#timetable_assign").prepend('<div id="overlap_error" class="message">'+ data.contract_params.error_msg +'</div>');
                                         {/if}
                                     }
                                 {/if}
                            } 
                            else {
                                var additional_params = JSON.stringify(data.atl_params);
                                $('#atl_warnings').val(additional_params);
                                {if $privilages.atl_override eq 1}
                                     $("#dialog-confirm p").html("<span class='error_msg_icon'></span>" + data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}");
                                     $( "#dialog-confirm" ).dialog({
                                         resizable: false,
                                         width: 350,
                                         modal: true,
                                         buttons: {
                                             "{$translate.yes}": function() {
                                                     $( this ).dialog( "close" );
                                                     {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                         jQuery('#frmadddata').submit(); 
                                                     {else}
                                                         if(data.contract == 'success'){
                                                              jQuery('#frmadddata').submit(); 
                                                         }else{
                                                             {if $privilages['contract_override'] eq 1}
                                                                     $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>"+ data.contract_params.error_msg);
                                                                     $( "#dialog-confirm-contract" ).dialog({
                                                                         resizable: false,
                                                                         width: 350,
                                                                         modal: true,
                                                                         buttons: {
                                                                             "{$translate.yes}": function() {
                                                                                     $( this ).dialog( "close" );
                                                                                     jQuery('#frmadddata').submit(); 
                                                                             },
                                                                             "{$translate.no}": function() {
                                                                                 $( this ).dialog( "close" );
                                                                             }
                                                                         }
                                                                     });
                                                             {else}
                                                                     $("#overlap_error").remove();
                                                                     $("#timetable_assign").prepend('<div id="overlap_error" class="message">'+ data.contract_params.error_msg +'</div>');
                                                             {/if}
                                                         }
                                                     {/if}
                                                 },
                                             "{$translate.no}": function() {
                                                 $( this ).dialog( "close" );
                                             }
                                         }
                                     }); 
                                {else} 
                                     alert(data.atl);
                                {/if}
                            }
                       {else if $company_contract_checking_flag eq 1}
                            if(data.contract == 'success'){
                                jQuery('#frmadddata').submit(); 
                            }else{
                                {if $privilages['contract_override'] == 1}
                                    $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>"+ data.contract_params.error_msg);
                                    $( "#dialog-confirm-contract" ).dialog({
                                            resizable: false,
                                            width: 350,
                                            modal: true,
                                            buttons: {
                                                "{$translate.yes}": function() {
                                                        $( this ).dialog( "close" );
                                                        jQuery('#frmadddata').submit(); 
                                                },
                                                "{$translate.no}": function() {
                                                    $( this ).dialog( "close" );
                                                }
                                            }
                                    });
                                {else}
                                    $("#overlap_error").remove();
                                    $("#timetable_assign").prepend('<div id="overlap_error" class="message">'+ data.contract_params.error_msg +'</div>');
                                {/if}
                            }
                        {/if}
                },
                error: function (xhr, ajaxOptions, thrownError){
                    uwrapLoader("#tble_list  #confirmmessage .ui-dialog-buttonpane");
                    alert(thrownError);
                }
            });
        {else}
            jQuery('#frmadddata').submit(); 
        {/if}
}

function showconfirmbox()
{ 
        jQuery('#action').val('');
	jQuery('.ui-widget-overlay').show();	
	jQuery('#confirmmessage').show();	
}

function hideconfirm()
{
	jQuery('.ui-widget-overlay').hide();	
	jQuery('#confirmmessage').hide();	
}



function deleteScheduleData()
{
	
	jQuery('#frmadddata').submit(); 
		
}

function showconfirmdelete()
{ 
        jQuery('#action').val('delete');
	jQuery('.ui-widget-overlay').show();	
	jQuery('#deletemmessage').show();	
}

function hideconfirmdelete()
{
        jQuery('#action').val('');
	jQuery('.ui-widget-overlay').hide();	
	jQuery('#deletemmessage').hide();	
}

</script>
{/block}
{block name="content"}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div id="dialog-confirm-contract" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div class="clearfix" style="width:400px;" id="issue_popup" style="display:none;"></div>
    <div class="clearfix" style="width:400px;" id="template_popup" style="display:none;"></div>

    <div class="tbl_hd">
        <span class="titles_tab">{$translate.use_template_schedule}</span>
        <a href="{$url_path}administration/" class="back">{$translate.backs}</a>
    </div>
       
    {$message}
    <div id="tble_list">
   
        <table class="table_list">
            <div class="option_strip" style="padding-bottom:10px;" >
                <div style="color:red; display:none;" align="left" id="emp_error" >{$translate.enter_customer_name_error}</div>
                <div style="color:red; display:none;" align="left" id="error_temp_msg" >{$translate.enter_template_name}</div>
                <div style="color:red; display:none;" align="left" id="error_sdate_msg" >{$translate.copy_start_date}</div>
                <form method="post" name="frmautoschedule" >
                    {$translate.customer_name}<span style="color:red;" >&nbsp;*</span> 
                    <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" value="{$emp_name}" class="ui-autocomplete-input" />
                    <input type="hidden" name="hdn_emp_id" id="hdn_emp_id" value="{$hdn_emp_id}" value="" />
                    <input id="employee-id" value="{$UserName}" type="hidden" />
                    <input type="hidden" name="url" id="url" value="{$url_path}" />
                    <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />


                    <span id="suggest"></span>

                    &nbsp;&nbsp;{$translate.select_template} <span style="color:red;" >&nbsp;*</span> 
                    <select style="border:1px solid #DDDDDD;width:150px;" name="templateList" id="templateList" >
                                <option value="">--{$translate.select_template}--</option>
                    </select>

                    &nbsp;&nbsp;{$translate.copy_start_date} <span style="color:red;" >&nbsp;*</span> 
                    <input type="text" name="statr_date" value="{$todate}" id="todate" maxlength="11" />
                    <br/><br/>

                    {$translate.schedule_map_with} : 
                    <select style="border:1px solid #DDDDDD;width:250px;" name="mapwith" id="mapwith" >
                        <option value="2">{$translate.start_in_temp_start_schedule}</option>
                        <option value="1">{$translate.day_in_template_with_schedule}</option>
                    </select>
                    &nbsp;&nbsp;&nbsp; <input type="button" name="submit" value="{$translate.show_schedule}" onclick="adddata();" />  

                </form>  

                <center>  
                    <span style="display:none; position:absolute; left: 700px; top: 214px;z-index:1111;" id="loading">
                        <img src="{$url_path}images/sgo-loading.gif"  />
                    </span>
                </center>

            </div>

            <div id="showdata" ></div> 
            <div id="whitebg" class="ui-widget-overlay" style="width: 1583px; height: 830px; z-index: 1001;  display:none; "></div>     
            <div id="confirmmessage" class="ui-dialog ui-widget ui-widget-content ui-corner-all no-close ui-draggable" style="display: block; z-index: 1002; outline: 0px none; height: auto; width: 247px; top: 228px; left: 526.5px;  display:none;" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-timetable_process">
                <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                    <span id="ui-dialog-title-timetable_process" class="ui-dialog-title">{$translate.are_you_sure}</span>
                    <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
                        <span class="ui-icon ui-icon-closethick">close</span>
                    </a>
                </div>

                <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                    <div class="ui-dialog-buttonset" style="margin-right:39px;" >
                        <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false" style="float:left;" onclick="hideconfirm();">
                            <span class="ui-button-text">{$translate.label_cancel}</span>
                        </button>
                        <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false"  style="float:left;" onclick="saveScheduleData_exist_check();">
                            <span class="ui-button-text">{$translate.label_save}</span>
                        </button>
                    </div>
                </div>
           </div>

            <div id="deletemmessage" class="ui-dialog ui-widget ui-widget-content ui-corner-all no-close ui-draggable" style="display: block; z-index: 1002; outline: 0px none; height: auto; width: 247px; top: 228px; left: 526.5px;  display:none;" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-timetable_process">
                <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                    <span id="ui-dialog-title-timetable_process" class="ui-dialog-title">{$translate.are_you_sure}</span>
                    <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
                        <span class="ui-icon ui-icon-closethick">close</span>
                    </a>
                </div>

                <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                    <div class="ui-dialog-buttonset" style="margin-right:39px;" >
                        <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false" style="float:left;" onclick="hideconfirmdelete();">
                            <span class="ui-button-text">{$translate.label_cancel}</span>
                        </button>
                        <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false"  style="float:left;" onclick="deleteScheduleData();">
                            <span class="ui-button-text">{$translate.delete}</span>
                        </button>
                    </div>
                </div>
            </div>            


            <script></script>
        </table>
    </div>
{/block}
    