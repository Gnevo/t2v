<script>
$(function() {
    var availableTags = [
        {foreach from=$employees_autocomplete item=employee}
            {if $sort_by_name == 2}
                "{$employee.last_name} {$employee.first_name}({$employee.code})",   
            {else}
                "{$employee.first_name} {$employee.last_name}({$employee.code})",   
            {/if}    
            {/foreach}
                ""
    ];
    $( "#pre_search" ).autocomplete({
        source: availableTags
    });
});

function added_employees_all(){
    var selected = $("#selected_emp").val();
    if($("#check_user_all").attr("checked")){
        var selected_c ='';
        {foreach from=$employees item=employee}
            var user = '{$employee.username}';
            $("#check_user_"+user).attr('checked',true);
            //added_employees('{$employee.username}')
            if(selected_c == '')
                selected_c = user;
            else
                selected_c = selected_c + ','+ user;
        {/foreach}
        if(selected == ""){
            selected = selected_c;
        }else{
             selected = selected+','+selected_c;
        }
        $("#selected_emp_to_privilege").show();
        $("#selected_emp").val(selected);
        $("#selected_emp_to_privilege").load("{$url_path}ajax_selected_employee_privilege.php?empl="+selected);
    }else{
         var selected_c ='';
        {foreach from=$employees item=employee}
            var user = '{$employee.username}';
            $("#check_user_"+user).attr('checked',false); 
//        added_employees('{$employee.username}');
            if(selected_c == '')
                selected_c = user;
            else
                selected_c = selected_c + ','+ user;
        {/foreach}
        var tmp_emp_array = selected.split(",");
        var tmp_emp_array_c = selected_c.split(",");
        var new_tmp_emp = '';
        var j=0;
       
        for(var i=0; i < tmp_emp_array.length; i++) {
            var flg = 0;
            for(var k=0; k < tmp_emp_array_c.length; k++) {
                if(tmp_emp_array[i] == tmp_emp_array_c[k]) {
                    flg = 1;
                }
            }
            if(flg == 0){
                if(tmp_emp_array[i] != ""){
                    if(new_tmp_emp == ""){
                     new_tmp_emp = tmp_emp_array[i];
                    }
                     else{
                         new_tmp_emp = new_tmp_emp+","+tmp_emp_array[i];
                     }
                 }
             }
        }
//        alert(new_tmp_emp);
        $("#selected_emp").val(new_tmp_emp);
        if(new_tmp_emp == ""){
             $("#selected_emp_to_privilege").hide();
        }
        $("#selected_emp_to_privilege").load("{$url_path}ajax_selected_employee_privilege.php?empl="+new_tmp_emp);
    }
        
}
</script>

        <form>
            <input type="hidden" name="count" id="count" value="{$count}" />
            <input type="hidden" name="total_page" id="total_page" value="{$total}" />
            
            <table class="table table-bordered table-condensed table-hover table-responsive table-primary recruitment-table tablesorter" style="top: 0px; margin: 0px;">
                <tbody>
                {if $employees}
                    <tr>
                        <td class="center checkbox-radiobox-col"><input name="check_user_all"  id="check_user_all" value="all" onclick="added_employees_all()" style="margin: 0px 7px ! important;" type="checkbox"></td>
                        <td colspan="3">{$translate.all}</td>

                    </tr>
                {/if}
                {foreach from=$employees item=employee}
                    <tr>

                        <td class="center checkbox-radiobox-col"><input name="check_user_{$employee.employee_username}"  id="check_user_{$employee.username}" value="{$employee.username}" onclick="added_employees('{$employee.username}')" style="margin: 0px 7px ! important;" type="checkbox"></td>
                        <td>{if $sort_by_name == 1}{$employee.first_name} {$employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name} {$employee.first_name}{/if}</td>
                        <td>{$employee.code}</td>
                        <td>{$employee.username}</td>
                        <td>
                            {if $employee.role == 1}{$translate.admin}
                            {elseif $employee.role == 2}{$translate.tl}
                            {elseif $employee.role == 3}{$translate.employee}
                            {elseif $employee.role == 5}{$translate.trainee}
                            {elseif $employee.role == 7}{$translate.super_tl}
                            {/if}
                        </td>
                    </tr>
                {/foreach}    
                </tbody>
        <!-- // Table body END -->
            </table>
        </form>


        