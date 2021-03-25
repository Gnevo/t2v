{block name='script'}
<script type="text/javascript">
function addElements(username,method,super_user){
    var value = '';
    var user = '';
    var kk = 0;
    var mail_ids = $("#mail_ids").val();
    if(mail_ids == ""){
        mail_ids = $("#to").val();
    }
    else{
        mail_ids = $("#mail_ids").val();
    }
    if(method == 'c'){
        if($('#cch_'+username).attr('checked')){
            {foreach from=$employees_group item=employee}
                if(username == '{$employee.customer_username}'){
                    {foreach from=$employee.employees_customer item=empl}
                        user = '{$empl.username}';
                        $("#cech_"+user+"_"+username).attr("checked", true);
                        /*if($("#cech_"+user+"_"+username).attr("checked",false)){
                            $("#cech_"+user+"_"+username).attr("checked", true);
                        }else{
                            $("#cech_"+user+"_"+username).attr("checked", true);
                        }*/
                        value = '{$empl.first_name} {$empl.last_name}({$empl.username})';
                        if(mail_ids == ''){
                            mail_ids = value+', ';
                        }
                        else{
                            var tmp_mail_ids = mail_ids.split(",");
                            var new_tmp_mail_ids = mail_ids;
                            var j = 0;
                            var k = 0;
                            for(var i=0; i < tmp_mail_ids.length-1; i++) {
                                if(tmp_mail_ids[i] == value) {
                                    k = 1;
                                   
                                }
                            }
                            if(k == 0){
                               mail_ids = mail_ids+value+', '; 
                            }
                            
                           // mail_ids = new_tmp_mail_ids;
                        }
                    {/foreach}
                }
            {/foreach}
             $("#mail_ids").val(mail_ids);
        }
        
        else{
             {foreach from=$employees_group item=employee}
                if(username == '{$employee.customer_username}'){
                    {foreach from=$employee.employees_customer item=empl}
                        user = '{$empl.username}';
                        $("#cech_"+user+"_"+username).attr("checked", false);
                        value = '{$empl.first_name} {$empl.last_name}({$empl.username})';
                        var tmp_mail_ids = mail_ids.split(",");
                        var new_tmp_mail_ids = '';
                        var j = 0;
                        for(var i=0; i < tmp_mail_ids.length; i++) {
                            if(tmp_mail_ids[i] != value) {
                                if(j > 0){
                                    new_tmp_mail_ids += ", ";
                                }
                                new_tmp_mail_ids += tmp_mail_ids[i];
                                j++;
                            }
                        }
                        mail_ids = new_tmp_mail_ids;
                    {/foreach}
                }
            {/foreach}
             $("#mail_ids").val(mail_ids);
        } 
    }
    else if(method == 'ce'){
        if($('#cech_'+username+'_'+super_user).attr('checked')){
                value = $('#cech_'+username+'_'+super_user).val();
                if(mail_ids == ''){
                    mail_ids = value+', ';
                }
                else{
                    var tmp_mail_ids = mail_ids.split(",");
                    var new_tmp_mail_ids = '';
                    var j = 0;
                    var k = 0;
                    for(var i=0; i < tmp_mail_ids.length-1; i++) {
                        if(tmp_mail_ids[i] == value) {
                            k=1;
                        }
                    }
                    if(k == 0){
                        mail_ids = mail_ids+value+', '; 
                    }

                           // mail_ids = new_tmp_mail_ids;
                        
                }
            
             $("#mail_ids").val(mail_ids);
        }
        
        else{
             
            value = $('#cech_'+username+'_'+super_user).val();
            var tmp_mail_ids = mail_ids.split(",");
            var new_tmp_mail_ids = '';
            var j = 0;
            for(var i=0; i < tmp_mail_ids.length; i++) {
                if(tmp_mail_ids[i] != value) {
                    if(j > 0){
                        new_tmp_mail_ids += ", ";
                    }
                    new_tmp_mail_ids += tmp_mail_ids[i];
                    j++;
                }
            }
            mail_ids = new_tmp_mail_ids;
                
             $("#mail_ids").val(mail_ids);
        }
        
         
    }
    else if(method == 'ca'){
        if($('#cach_'+username).attr('checked')){
            value = $('#cach_'+username).val();
            if(mail_ids == ''){
                mail_ids = value+',';
            }
            else{
                var tmp_mail_ids = mail_ids.split(",");
                var new_tmp_mail_ids = '';
                var j = 0;
                var k = 0;
                for(var i=0; i < tmp_mail_ids.length-1; i++) {
                    if(tmp_mail_ids[i] == value) {
                        k=1;
                    }
                }
                if(k == 0){
                    mail_ids = mail_ids+value+', '; 
                }

                // mail_ids = new_tmp_mail_ids;
            }
                  
             $("#mail_ids").val(mail_ids);
        }
        
        else{
            value = $('#cach_'+username);
            var tmp_mail_ids = mail_ids.split(",");
            var new_tmp_mail_ids = '';
            var j = 0;
            for(var i=0; i < tmp_mail_ids.length; i++) {
                if(tmp_mail_ids[i] != value) {
                    if(j > 0){
                        new_tmp_mail_ids += ", ";
                    }
                    new_tmp_mail_ids += tmp_mail_ids[i];
                    j++;
                }
            }
            mail_ids = new_tmp_mail_ids;
                  
             $("#mail_ids").val(mail_ids);
        }
    }
    
}

function close_window(){
    var val = $("#mail_ids").val();
    $("#to").val(val);
    $("#mail_popup").dialog("close");
   /* $( ".selector" ).dialog({
    close: function(event, ui) { }
    });*/
}


function set_all(){
     if($('#all').attr('checked')){
        var values = "";
        {foreach from=$employees item=employee}
           if(values == ""){
               values = '{$employee.first_name} {$employee.last_name}({$employee.username}'+",";
            }
            else{
                values = values+'{$employee.first_name} {$employee.last_name}({$employee.username}'+",";
            }
         {/foreach}
            {foreach from=$employees_group item=employee}
                var username = '{$employee.customer_username}';
                    {foreach from=$employee.employees_customer item=empl}
                        var user = '{$empl.username}';
                        $("#cech_"+user+"_"+username).attr("checked", true);
              {/foreach}     
            {/foreach}
            
            {foreach from=$employees_group item=employee}
            {if $employee.customer_name == 'ALL'}
                var user = '{$employee.employees.username}';
                 $("#cach_"+user).attr("checked", true);
             {/if}
            {/foreach}   
         $("#mail_ids").val(values);
         
     }
     else{
     var values = $('#to').val();
        $("#mail_ids").val(values);
        {foreach from=$employees_group item=employee}
                var username = '{$employee.customer_username}';
                    {foreach from=$employee.employees_customer item=empl}
                        var user = '{$empl.username}';
                        $("#cech_"+user+"_"+username).attr("checked", false);
              {/foreach}     
            {/foreach}
            
            {foreach from=$employees_group item=employee}
            {if $employee.customer_name == 'ALL'}
                var user = '{$employee.employees.username}';
                 $("#cach_"+user).attr("checked", false);
             {/if}
            {/foreach}   
     }
}
</script>
{/block}
{block name='content'}
<input type="hidden" name="mail_ids" id="mail_ids" value="" />
<div id="mailing_list">
  <div id="options_panel">
    <label for="select_all">{$translate.select_all}</label>
    <input type="checkbox" name="all" id="all" value="all" onclick="set_all()"/>
  </div>
    {foreach from=$employees_group item=employee}
        {if $employee.customer_name != 'ALL'}
        <div class="mailing_group">
            <ul>
                <li class="mail_grup_customer">
                    <label for="checkbox">{$employee.customer_name}</label>
                    <input type="checkbox" id="cch_{$employee.customer_username}" name="cch_{$employee.customer_username}" onclick="addElements('{$employee.customer_username}','c','0')"/>
                </li>            
            {foreach from=$employee.employees_customer item=empl}
                <li>
                    <label>{$empl.first_name} {$empl.last_name}({$empl.username})</label>
                    <span class="mail_grup_customer">
                    <input type="checkbox" id="cech_{$empl.username}_{$employee.customer_username}" name="cech_{$empl.username}_{$employee.customer_username}" onclick="addElements('{$empl.username}','ce','{$employee.customer_username}')"  value="{$empl.first_name} {$empl.last_name}({$empl.username})"/>
                    </span>
                </li>                
            {/foreach}
            </ul>
        </div>
        {/if}
    {/foreach}
    {if $roles_user == 1}
    <div class="mailing_group">
        <ul>
        <li class="mail_grup_customer_unasigned">
            <label for="checkbox">{$translate.unassigned_employees}</label>
        </li>
    
    {foreach from=$employees_group item=employee}
        {if $employee.customer_name == 'ALL'}
        <li>
            <label>{$employee.employees.first_name} {$employee.employees.last_name}({$employee.employees.username})</label>
            <span class="mail_grup_customer">
            <input type="checkbox" id="cach_{$employee.employees.username}" name="cach_{$employee.employees.username}" onclick="addElements('{$employee.employees.username}','ca','0')" value="{$employee.employees.first_name} {$employee.employees.last_name}({$employee.employees.username})"/>
            </span>
        </li>
            
        {/if}
    {/foreach}
        </ul>
    </div>
    {/if}
</div>
 
{/block}