{block name="script"}
    <script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
    <script src="{$url_path}js/rvacation.js" type="text/javascript" ></script>
{/block}
{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.vacation_plannning_report}</span>
        <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
    </div>

    <div id="tble_list">

        <table class="table_list">

            {if ($errormessage == 1)}
                <div style="color:red;" align="center"	>{$translate.no_access_error_message} </div>
            {else}
                <div class="option_strip">
                    <div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
                    <form method="post" action="" >
                        {$translate.customer_name} <input type="hidden" value="{$name}" name="emp" id="emp" maxlength="150" onkeyup="suggest();" autocomplete="off" /> &nbsp;:&nbsp;<span style="font-weight:bold;">{$name}</span> &nbsp;&nbsp;
                        <input type="hidden" name="url" id="url" value="{$url_path}" />
                        <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />
                        <input type="hidden" value="{$username}" name="employee-id" id="employee-id" />
                        <span id="suggest">
                        </span>
                        {$translate.from_date} : <span style="font-weight:bold;">{$frmdate}</span><input type="hidden" value="{$frmdate}" name="frmdate" id="frmdate" maxlength="11"  /> &nbsp;&nbsp; &nbsp;&nbsp;
                        {$translate.to_date} : <span style="font-weight:bold;">{$todate}</span><input type="hidden" value="{$todate}" name="todate" id="todate" maxlength="11"  />
                       <!--<input type="button" name="submit" value="{$translate.show}" onclick="adddata();" /> -->
                    </form>  
                    <span style=" float:right;">
                        <a href="javascript:void(0);" onclick="pdfdownloadPreview();" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
                    </span>

                    <center>  
                        <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
                            <img src="{$url_path}images/sgo-loading.gif"  />
                        </span>
                    </center>
                </div>

                <div id="showdata" >
                    {$previewdata}
                </div>
            {/if}  
        </table>
    </div>
{/block}