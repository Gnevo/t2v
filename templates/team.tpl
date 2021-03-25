
{block name='script'}

<script type="text/javascript">

	
</script>
{/block}

{block name="content"}
{$message}
<div id="log_hd">Team</div>
<div id="log_form">
{foreach from=$team_detail item=row}
<table>
<tr><th>{$row.name}</th></tr>
<tr><td>{$translate.team_leader}</td><td>{$row.tl}</td></tr>
<tr><td>{$translate.team_member}</td><td>{$row.members}</td></tr>
<tr><td></td><td><a href="{$url_path}team/add/{$row.id}/">{$translate.edit}</a></td></tr>
</table>
{/foreach}
</div>
    
   
     

{/block}
