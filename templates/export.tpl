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
	<a id="export-config" href="{$url_path}export-config/">{$translate.config}</a>
	<form method="post" action="{$url_path}export/">
		<table id="period">
			<tr class="h tbl_hd">
				<td>{$translate.year}</td>
				<td>{$translate.month}</td>
				<td></td>
			</tr>
			<tr>
				<td><input type="text" size="6" name="year" value="{$year}" onchange="this.form.submit()"></td>
				<td>
					<select name="month" onchange="this.form.submit()">
						{html_options values=$months output=$monthsn selected=$month}
					</select>
				</td>

				<td>
					{if $done}
						<input type="submit" name="download" value=" {$translate.download} "> <span id="existing">({$translate.existing} {$employee} {$timestamp})</span>
					{else}
						<input type="submit" name="export" value=" {$translate.export} ">
					{/if}
				</td>
			</tr>
		</table>
		<br>
		<br>
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
	</form>
{/block}
