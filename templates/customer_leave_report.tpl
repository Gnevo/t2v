{block name="script"}
<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
<script src="{$url_path}js/rcustomerleavereport.js" type="text/javascript" ></script>
<script>
    $(document).ready(function() {


        $("#frmdate, #todate").datepicker({
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

    function select_all_types(){
        if($("#select_all_check").attr('checked')){
            $('#leave_types input.leave_type:checkbox').each(function() {
                $(this).prop('checked',true)
            });
        }else{
            $('#leave_types input.leave_type:checkbox').each(function() {
                $(this).prop('checked',false)
            });
        }
    }
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
        <div class="tbl_hd"><span class="titles_tab">{$translate.customer_absence_report}</span>
    <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
    </div>
       
    <div id="tble_list">
   
    <table class="table_list">
    {if ($errormessage == 1)}
    <div style="color:red;" align="center"	>{$translate.no_access_error_message} </div>
    {else}
        <div class="option_strip">
       		<div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>

                
                <div class="span12 no-ml" id="leave_types">
                    {foreach from=$leave_types key=leave_type_key item=leave_type}
                        <div class="clearfix mr pull-left">
                            <label><input type="checkbox" checked="checked" value="{$leave_type_key}" title="{$leave_type}" class="leave_type" /> {$leave_type}</label>
                        </div>
                    {/foreach}
                    <div class="clearfix pull-left">
                        <label style="margin-left: 25px;"><input type="checkbox" checked="checked" onclick="select_all_types()" value="1" title="{$translate.select_all_type}" id="select_all_check" name="select_all_check" style="margin-top: 5px;"> {$translate.check}</label>
                    </div>
                </div>

                {$translate.customer_name} <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" />
                <input id="employee-id" value="" type="hidden">
                <input type="hidden" name="url" id="url" value="{$url_path}" />
                <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />
                <span id="suggest">
                </span>
                
                {$translate.from_date} : <input type="text" name="frmdate" id="frmdate" maxlength="11" style="margin-top:5px;"/>
                {$translate.to_date} : <input type="text" name="todate" id="todate" maxlength="11" style="margin-top:5px;"/>
                
                
                <input type="button" name="submit" value="{$translate.show}" onclick="adddata();" />  
                     
            <span style=" float:right;">
            	<a href="javascript:void(0);" onclick="pdfdownload();" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
            </span>
           
            <center>  
            <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
             <img src="{$url_path}images/sgo-loading.gif"  />
           
             
             </span>
            
             </center>
             
        </div>
         
       <!-- <div class="week_num">{$translate.week}{$report.week}</div>-->
        <div id="showdata" >
            <div class="pagention">
                <div class="alphbts">
                    <ul>
                        <li>
                        	<a onclick="select_employee('A')" href="javascript:void(0)">A</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('B')" href="javascript:void(0)">B</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('C')" href="javascript:void(0)">C</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('D')" href="javascript:void(0)">D</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('E')" href="javascript:void(0)">E</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('F')" href="javascript:void(0)">F</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('G')" href="javascript:void(0)">G</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('H')" href="javascript:void(0)">H</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('I')" href="javascript:void(0)">I</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('J')" href="javascript:void(0)">J</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('K')" href="javascript:void(0)">K</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('L')" href="javascript:void(0)">L</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('M')" href="javascript:void(0)">M</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('N')" href="javascript:void(0)">N</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('O')" href="javascript:void(0)">O</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('P')" href="javascript:void(0)">P</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Q')" href="javascript:void(0)">Q</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('R')" href="javascript:void(0)">R</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('S')" href="javascript:void(0)">S</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('T')" href="javascript:void(0)">T</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('U')" href="javascript:void(0)">U</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('V')" href="javascript:void(0)">V</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('W')" href="javascript:void(0)">W</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('X')" href="javascript:void(0)">X</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Y')" href="javascript:void(0)">Y</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Z')" href="javascript:void(0)">Z</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Å')" id="Å" href="javascript:void(0)">Å</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Ä')" id="Ä" href="javascript:void(0)">Ä</a>
                        </li>
                        <li>
                        	<a onclick="select_employee('Ö')" id="Ö" href="javascript:void(0)">Ö</a>
                        </li>
                    </ul>
                </div>
            
                <div class="pagention_dv">
                    <div class="pagination">
                        <ul id="pagination">
                            
                        </ul>
                    </div>
                </div>
            </div>
            
        	
        </div>
         {/if}  
         </table>
         </div></div></div>
    	{/block}
    