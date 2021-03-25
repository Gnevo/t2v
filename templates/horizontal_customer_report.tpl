{block name="script"}
<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
<script src="{$url_path}js/rhorizontalcustrpt.js" type="text/javascript" ></script>
<script>
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
	
	//Get wekk number in week dropdown on page load event
	getweek({$smarty.now|date_format:"%m"});
	
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
{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <style>
    
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    * html .ui-autocomplete {
        height: 200px;
    }
</style>
{/block}  
{block name="content"} 
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd"><span class="titles_tab">{$translate.horizontal_customer_report}</span>
    <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
    </div>
       
    <div id="tble_list">   
    
    <table class="table_list">
    {if ($errormessage == 1)}
    <div style="color:red;" align="center"	>{$translate.no_access_error_message} </div>
    {else}
       <div class="row-fluid"> 
       <div class="option_strip span12">
       		<div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
                <form method="post" action="" >
                <div class="span3">    
                {$translate.customer_name}
                <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" style="width:130px;margin-bottom: 0px;"/><span style="color:#F00;">*</span>
                </div>
                <input id="employee-id" value="" type="hidden">
                
                <input type="hidden" name="url" id="url" value="{$url_path}" />
               
               <input type="hidden" id="hdn_week" name="hdn_week" value="" />
                <input type="hidden" id="hdn_table" name="hdn_table" value="" />
                <span id="suggest">
                </span>
                
         <div class="span2">    
        {$translate.year} : <select id="cmb_year" name="year" style="width:80px;">
        {html_options values=$year_option_values selected=$CurrentYear output=$year_option_values}
        </select><span style="color:#F00;">*</span>
        {if $report_year == ""}
        {$report_year = $smarty.now|date_format:"%Y"}
        {/if}
        </div>
        <div class="span2">           
        {$translate.month} 
        <select name="month" id="month" onchange="getweek(this.value);" style="width:80px;">
        {if $month == ''}
        <option value="0" {if  $smarty.now|date_format:"%m" == ''} selected = "selected" {/if} >{$translate.select}</option>
        <option value="1" {if  $smarty.now|date_format:"%m" == 1} selected = "selected" {/if} >{$translate.jan}</option>
        <option value="2" {if  $smarty.now|date_format:"%m" == 2} selected = "selected" {/if}>{$translate.feb}</option>
        <option value="3" {if  $smarty.now|date_format:"%m" == 3} selected = "selected" {/if}>{$translate.mar}</option>
        <option value="4" {if  $smarty.now|date_format:"%m" == 4} selected = "selected" {/if}>{$translate.apr}</option>
        <option value="5" {if  $smarty.now|date_format:"%m" == 5} selected = "selected" {/if}>{$translate.may}</option>
        <option value="6" {if  $smarty.now|date_format:"%m" == 6} selected = "selected" {/if}>{$translate.jun}</option>
        <option value="7" {if  $smarty.now|date_format:"%m" == 7} selected = "selected" {/if}>{$translate.jul}</option>
        <option value="8" {if  $smarty.now|date_format:"%m" == 8} selected = "selected" {/if}>{$translate.aug}</option>
        <option value="9" {if  $smarty.now|date_format:"%m" == 9} selected = "selected" {/if}>{$translate.sep}</option>
        <option value="10" {if  $smarty.now|date_format:"%m" == 10} selected = "selected" {/if}>{$translate.oct}</option>
        <option value="11" {if  $smarty.now|date_format:"%m" == 11} selected = "selected" {/if}>{$translate.nov}</option>
        <option value="12" {if  $smarty.now|date_format:"%m" == 12} selected = "selected" {/if}>{$translate.dec}</option>
        {else}
        <option value="0" {if  $month == ''} selected = "selected" {/if} >{$translate.select}</option>
        <option value="1" {if  $month == 1} selected = "selected" {/if} >{$translate.jan}</option>
        <option value="2" {if  $month == 2} selected = "selected" {/if}>{$translate.feb}</option>
        <option value="3" {if  $month == 3} selected = "selected" {/if}>{$translate.mar}</option>
        <option value="4" {if  $month == 4} selected = "selected" {/if}>{$translate.apr}</option>
        <option value="5" {if  $month == 5} selected = "selected" {/if}>{$translate.may}</option>
        <option value="6" {if  $month == 6} selected = "selected" {/if}>{$translate.jun}</option>
        <option value="7" {if  $month == 7} selected = "selected" {/if}>{$translate.jul}</option>
        <option value="8" {if  $month == 8} selected = "selected" {/if}>{$translate.aug}</option>
        <option value="9" {if  $month == 9} selected = "selected" {/if}>{$translate.sep}</option>
        <option value="10" {if  $month == 10} selected = "selected" {/if}>{$translate.oct}</option>
        <option value="11" {if  $month == 11} selected = "selected" {/if}>{$translate.nov}</option>
        <option value="12" {if  $month == 12} selected = "selected" {/if}>{$translate.dec}</option>
        {/if}
        </select><span style="color:#F00;">*</span>
        </div>
        <div class="span2">    
        {$translate.week}
        <span id="weekdiv">
        <select name="week" id="week" style="width:80px;">
        	<option value="">{$translate.select}</option>
        </select>        
        </span>
        </div>
        <div class="span2">    
      
                <input type="button" name="submit" value="{$translate.show}" onclick="adddata();" />  
          
            </form>  
            <span style=" float:right;">
            	<a href="javascript:void(0);" onclick="pdfdownload();" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
            </span>
           </div>              
            <center>  
            <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
             <img src="{$url_path}images/sgo-loading.gif"  />
           
             
             </span>
            
             </center>
             
        </div>
        </div> 
      
        <div id="showdata" >
            
            
        </div>
         {/if}
         </table>
         </div></div>
    	{/block}
    