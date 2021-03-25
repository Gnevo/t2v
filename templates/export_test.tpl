{block name="script"}
    <style type="text/css">
        .h {
            font-weight: bold;
        }

        #export-config {
            float: right;
        }

        #existing {
            font-size: 10px;
        }

        #period,
        #list {
            border-collapse: collapse;
            background: #f7f7f7;
            border: 1px solid #dddddd;
        }

        #period td,
        #list td {
            margin: 0;
            padding: 2px 5px;
        }

        #sms {
            float: right;
        }

        .m:hover td {
            background: #ffffcc;
        }
    </style>
{/block}

{block name="content"}
<div id="wrapper">
<div class="tbl_hd">
    <span class="titles_tab">{$translate.export_title}</span>
</div>
    <div id="tble_list">
        {if !empty($errors)}
        <div class="errors">
        {foreach key=id from=$errors item=error}
            {$translate.$error}<br />
        {/foreach}
        </div>
        {/if}
	    <div class="option_strip">
            <a id="export-config" href="{$url_path}export_lon-config/">{$translate.config}</a>
            <form id="customer_report" method="post">
                {$translate.customer}
                <select name="customer" id="customer">
                    <!--<option value="">Välj</option>-->
                    <option value="">{$translate.all_clients}</option>
                    {html_options values=$customer_list output=$customer_list_n}
                </select>
                {$translate.month}
                <select name="month" id="month" onchange="javascript:this.form.submit();">
                    {* html_options values=$months output=$monthsn selected=$month *}
                    {foreach key=id from=$monthsn item=m}
                    	<option value="{$months[$id]}"
                    	{if $month eq $months[$id]} selected="selected"{/if}
                    	>{$id+1|string_format:"%02d"} {$translate.$m}</option>
                    {/foreach}
                </select>
                {$translate.year}
                <select id="cmb_year" name="year" onchange="javascript:this.form.submit();">
                    {html_options values=$years output=$years selected=$year}
					<!--<option value="0">0</option>-->
                </select>
                {$translate.export_type}
                <select id="cmb_year" name="app">
                    <option value="visma600">Visma 600</option>
					<option value="visma">Visma Lön</option>
                    <option value="hogia">Hogia Lön</option>
                    <option value="crona">Crona</option>
                    <!--<<option value="agda">Agda</option>-->
                    <!--<option value="bjor">Bjor Lundin</option>-->
                </select>
                <!--
                Format
                <select id="cmb_year" name="format">
                    <option value="xml" selected="selected">XML</option>
					<option value="other">Other</option>
                </select>
                -->
                <input name="export" value="{$translate.export}" type="submit">
                <!--<input name="action" id="action" value="" type="hidden">-->
            </form>
	    </div>
    </div>
    <table style="width:100%;" ><tr ><td style="width: 40%;" >
	    <form method="post" action="{$url_path}export-sms/">
	        <table id="list">
	            <tr class="tbl_hd">
	                <td><strong>{$translate.num_employees}</strong> {$num_employees}</td>
	                <td><strong>{$translate.num_signed}</strong> {$num_signed}</td>
	                <td><strong>{$translate.num_not_signed}</strong> {$num_not_signed}</td>
	                <td><input id="sms" type="button" value=" {$translate.sms} "></td>
	            </tr>
	            <tr class="h">
	                <td>{$translate.employee}</td>
	                <td>{$translate.phone_home}</td>
	                <td>{$translate.phone_mobile}</td>
	                <td>{$translate.sms}</td>
	            </tr>
	            {$not_signed}
	        </table>
	    </form>
    </td><td style="width:20%;" >&nbsp;</td><td style="width: 40%;">
        {if $done}
            {foreach key=id from=$existing item=export}
            <form id="customer_report" method="post" style="line-height:2em;" >
                <input type="hidden" name="month" value="{$month}" />
                <input type="hidden" name="year" value="{$year}" />
                <input type="hidden" name="filename" value="{$export.filename}" />
                <input type="hidden" name="download" value=" {$translate.download} ">
                {* <span id="existing">({$translate.existing} {$export.employee} {$export.timestamp}) - {$export.filename} </span><input type="submit" name="download" value=" {$translate.download} "><br/> *}
                <a id="link_{$id}" href="javascript:;" onclick="$(this).parents('form').get(0).submit();"
                	style="text-decoration:underline; cursor:pointer;" >{$export.year}{"%02d"|sprintf:$export.month}</a
                	>&nbsp;&nbsp;&nbsp;{$export.employee}&nbsp;&nbsp;&nbsp;{$export.timestamp|date_format:"%Y-%m-%d %H%M"}
            </form>
            {/foreach}
        {/if}
    </td></tr></table>
</div>
{/block}