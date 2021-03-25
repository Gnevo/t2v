{block name="script"}
	<style type="text/css">
		#c {
			width: 100%;
			border-collapse: collapse;
		}
		#h {
			font-weight: bold;
		}
		.m td {
			border-bottom: 1px dashed #cccccc;
		}
		.m:hover td {
			background: #ffffcc;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function () {
			$('.m').click(function (row) {
				//alert('Click!');
			});
		});
	</script>
{/block}

{block name="content"}
	<form method="post" action="{$url_path}export-config/">
		<table id="c">
			<tr id="h" class="tbl_hd">
				<td>{$translate.internal}</td>
				<td>{$translate.external}</td>
				<td>{$translate.method}</td>
				<td>{$translate.price}</td>
			</tr>
			{$rows}
		</table>
		<br>
		<br>
		<input type="button" value=" {$translate.back} " onclick="history.back()">
		<input type="submit" value=" {$translate.save} ">
	</form>
{/block}
