{block name="script"}

<script src="{$url_path}js/rautoscheuler.js" type="text/javascript" ></script>
<script>
function closeit()
{
	document.getElementById('whitebg').style.display = 'none';
	document.getElementById('timetable_assign').style.display = 'none';		
}

function savedatatotimetable()
{
document.autoscheduleform.submit();
}

function showconfirmbox()
{
	document.getElementById('whitebg').style.display = 'block';	
	document.getElementById('confirmmessage').style.display = 'block';	
}

function hideconfirm()
{
	document.getElementById('whitebg').style.display = 'none';	
	document.getElementById('confirmmessage').style.display = 'none';	
}

function hideemployee(name,color,empid,slotId)
{
	var divid = document.getElementById('hdn_emp_id').value;	
	var empvalue = document.getElementById('emp'+divid).value;
	
	var splitname = name.split(" ");
	
	var myarr = empvalue.split(",");
	var newvalue = myarr[0] + "," + empid + "," + splitname[0] + "," + splitname[1];
	
	document.getElementById('emp'+divid).value = newvalue;
	
	//alert(empvalue);
	//alert(newvalue);
	document.getElementById('color'+divid).style.backgroundColor = color;
	document.getElementById('div'+divid).innerHTML = name;
	document.getElementById('timetable_assign').style.display = 'none';	
	document.getElementById('whitebg').style.display = 'none';	
	
	$.ajax({
		type: "POST",
		url: "temp/emp/update/",
		data: { slotId: slotId, empid:empid,  first_name: splitname[0], last_name : splitname[1]}
		}).done(function( html ) {
		//alert( "Data Saved: " + html );
		//$("#errormsg").html('');
		//$("#errormsg").html(html);
		//$("#errormsg").show();
		});
	
}


$(document).ready(function() {
	$("#frmdate").datepicker({ldelim}
	showOn: "button",
	buttonImage: "{$url_path}images/date_pic.gif",
	buttonImageOnly: true
	{rdelim});
	
	$("#todate").datepicker({ldelim}
	showOn: "button",
	buttonImage: "{$url_path}images/date_pic.gif",
	buttonImageOnly: true
	{rdelim});
	
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
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
        };
//        $( "#txt_customer" ).autocomplete({
//            source: availableTags
//        });
    });
}); 
</script>
{/block}
{block name="content"}
      {if $msg_updated neq ''}<div class="success" >{$translate.data_save_success}</div>{/if}
        <div class="tbl_hd"><span class="titles_tab">{$translate.auto_scheduling}</span>
    <a href="{$url_path}administration/" class="back">{$translate.backs}</a>
    </div>
       
    <div id="tble_list">
   
    <table class="table_list">
    {if ($errormessage == 1)}
    <div style="color:red;" align="center"	>{$translate.no_access_error_message} </div>
    {else}
        <div class="option_strip">
        	<div style="color:red; display:none;" align="left" id="emp_error" >{$translate.enter_customer_name_error}</div>
       		<div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
            <div style="color:red; display:none;" align="center" id="fromdateerrormsg" >{$translate.fromdate_error}</div>
            <form method="post" action="" name="frmautoschedule" >
                {$translate.customer_name}<span style="color:red;" >&nbsp;*</span> <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" value="{$emp_name}" class="ui-autocomplete-input" />
                <input type="hidden" name="hdn_emp_id" id="hdn_emp_id" value="{$hdn_emp_id}" value="" />
                <input id="employee-id" value="{$UserName}" type="hidden">
                <input type="hidden" name="url" id="url" value="{$url_path}" />
                <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />
                        
                
                <span id="suggest">
                </span>
             
               {$translate.from_date} : <input type="text" name="frmdate" value="{$frmdate}" id="frmdate" maxlength="11" />
                {$translate.to_date} : <input type="text" name="todate" value="{$todate}" id="todate" maxlength="11" />
                <input type="button" name="submit" value="{$translate.show}" onclick="adddata()" />  
              
            </form>  
          
            <center>  
            <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
             <img src="{$url_path}images/sgo-loading.gif"  />
           
             
             </span>
           
             </center>
             
        </div>
	
        <div id="showdata" ></div>
        	
        </div>
        
        <!-- This is confimation message popup -->
        <div id="whitebg" class="ui-widget-overlay" style="width: 1583px; height: 830px; z-index: 1001;  display:none; "></div>     
        <div id="confirmmessage" class="ui-dialog ui-widget ui-widget-content ui-corner-all no-close ui-draggable" style="display: block; z-index: 1002; outline: 0px none; height: auto; width: 247px; top: 228px; left: 731.5px;  display:none;" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-timetable_process">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
            <span id="ui-dialog-title-timetable_process" class="ui-dialog-title">{$translate.are_you_sure}</span>
                <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
                <span class="ui-icon ui-icon-closethick">close</span>
                </a>
            </div>
        	<form name="frmconfirm" action="" method="post">
            <input type="hidden" name="hdn_confirm" id="hdn_confirm" value="1" />
            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
               <span>{$translate.extra_string_message}</span>
                <div class="ui-dialog-buttonset">
                    <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false" style="float:left;" onclick="hideconfirm();">
                        <span class="ui-button-text">{$translate.label_cancel}</span>
                    </button>
                    <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false"  style="float:left;" onclick="savedatatotimetable();">
                        <span class="ui-button-text">{$translate.label_save}</span>
                    </button>
                </div>
            </div>
            </form>
        </div>
        <!-- End of confirmation popup-->
       
         {/if}  
         
          <div id="showresult"></div>
	{if $smarty.post.showdatadisp eq 'Yes'}
          <script>
				adddata();
			</script>
         {/if}   
    	{/block}
    </table>