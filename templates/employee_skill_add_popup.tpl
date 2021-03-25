{block name='script'}
<script type="text/javascript">
</script>
{/block}
{block name='content'}
<div>
   
    <form name="form" id="form" method="post" enctype="multipart/form-data" {if $method == 1}action="{$url_path}employee/add/{$employee}/"{else} action="{$url_path}employee_skill_add_popup.php"{/if}>
             <table>
                 <tr><td>{$translate.skill}</td><td><input type="text" name="skills" id="skills"  /></td></tr>
                 <tr><td>{$translate.description}</td><td> <textarea style="width: 280px;" name="description" id="description"></textarea></td></tr>
                 <tr><td></td><td><input name="add_skills" type="submit" value="{$translate.save}" /></td></tr>
              </table>
                       
                           
    </form>
</div>
{/block}