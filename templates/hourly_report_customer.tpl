{block name="script"}
<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
<script src="{$url_path}js/rhourlycustreport.js" type="text/javascript" ></script>
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
    });
});
</script>

{/block}
{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
 <style>
body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
} 
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
    <div class="tbl_hd"><span class="titles_tab">{$translate.hourly_customer_report}</span>
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
                        <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" style="width:130px; margin-bottom: 0px;"/><span style="color:red;">&nbsp;*</span>
                        <input id="employee-id" value="" type="hidden">
                        <input type="hidden" name="url" id="url" value="{$url_path}" />
                        <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />
                        <span id="suggest">
                        </span>
                        </div>
                        <div class="span3">
                        {$translate.from_date} : <input type="text" name="frmdate" id="frmdate" maxlength="11" value="{$FirstDateOfCurrentYear}" style="width:85px; margin-bottom: 0px;"/><span style="color:red;">&nbsp;*</span>
                        </div>
                        <div class="span3">
                        {$translate.to_date} : <input type="text" name="todate" id="todate" maxlength="11" value="{$TodatDate}" style="width:85px; margin-bottom: 0px;"/><span style="color:red;">&nbsp;*</span>
                        </div>
                        <div class="span2">
                        <input type="button" name="submit" value="{$translate.show}" onclick="adddata();" /> 
                        <span style=" float:right;">
                        <a href="javascript:void(0);" onclick="pdfdownload();" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
                    </span>
                        </div>
                    </form>  
                    

                    <center>  
                        <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
                            <img src="{$url_path}images/sgo-loading.gif"  />
                        </span>
                    </center>
                </div>
                </div>        
                <div id="showdata" >&nbsp;</div>
            {/if}  
        </table>
    </div>
    </div></div>        
{/block}