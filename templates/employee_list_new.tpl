{block name='script'}
<script type="text/javascript">
function select_employee(action,name,page){
    $("#search_alph").val(name);
   var view = $("#search_emp").val();
   var sort_by = $("#sort_by").val();
   if(view == '{$translate.search_employee}' || view == ""){
      $("#temp_search_emp").val('');  
   }
  var search = $("#temp_search_emp").val();
    $("#temp_search_emp").val(name);
   
    $("#search_emp").val('');
   var cust = $("#cust").val();
    
    var action = $("#action").val();
    if(search != "" || cust != ""){
           
            var url1 = encodeURI("{$url_path}ajax_employee_list_page.php?page="+page+"&search="+name+"&cust="+cust+"&action="+action);
            var url2 = encodeURI("{$url_path}ajax_employee_listing.php?page="+page+"&search="+name+"&cust="+cust+"&action="+action+"&sort_by="+sort_by);
            $(".pagination").load(url1);
            $("#table_val").load(url2);
        
    }else{
        window.location.href = '{$url_path}list/employee/'+action+'/'+name+'/';
   }
}


$(document).ready(function(){
    $("#search_emp").click(function(){
        var fix = $("#search_emp").val();
        if(fix == "{$translate.search_employee}"){
           $("#search_emp").val('');
        }
        
    });
   $("#search_emp").blur(function(){
        var fix = $("#search_emp").val();
        if(fix == ""){
           $("#search_emp").val('{$translate.search_employee}');
           $("#search_alph").val('');
           paginateDisplay('1')
        }
    });
    $("#search_cust").click(function(){
        var fix = $("#search_cust").val();
        if(fix == "{$translate.search_customer}"){
           $("#search_cust").val('');
        }
        
    });
   $("#search_cust").blur(function(){
        var fix = $("#search_cust").val();
        if(fix == ""){
           $("#search_cust").val('{$translate.search_customer}');
           $("#search_alph").val('');
           paginateDisplay('1')
        }
    });
    var availableTags = [
        {foreach from=$employee_autocomplete item=employee}
             "{$employee.last_name} {$employee.first_name}({$employee.code})",       
            {/foreach}
                ""
    ];
    $( "#search_emp" ).autocomplete({
        source: availableTags,
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#temp_search_emp").val(this.value);
             paginateDisplay('1')
    }
    });
     var availTags = [
        {foreach from=$customers item=customer}
             "{$customer.last_name} {$customer.first_name}({$customer.code})",       
            {/foreach}
                ""
    ];
    $( "#search_cust" ).autocomplete({
        source: availTags,
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#cust").val(this.value);
             paginateDisplay('1')
    }   
        
    
    });
    $("input:radio[name=active]").click(function() {
    var value = $(this).val();
    window.location.href = '{$url_path}list/employee/'+value+'/';
        
    });
});

/*function getDetail(value){
    alert(value);
    $("#form_list").submit();
}*/

function paginateDisplay(page){
    var view =$("#search_emp").val();
    var view1 =$("#search_cust").val();
    if(view == '{$translate.search_employee}' || view == ""){
      $("#temp_search_emp").val('');  
   }
   if(view1 == '{$translate.search_customer}' || view1 == ""){
      $("#cust").val('');  
   }
   var search = $("#temp_search_emp").val();
   if(search == ""){
       search =  $("#search_alph").val();
   }
   var cust = $("#cust").val();
   var action = $("#action").val();
   var sort_by = $("#sort_by").val();
   if(search.lenght == 1){
        select_employee(action,search,page);
   }else{
        //if(search != "" || cust != ""){
        var urls = encodeURI("{$url_path}ajax_employee_list_page.php?page="+page+"&search="+search+"&cust="+cust+"&action="+action+"&sort_by"+sort_by);
             $(".pagination").load(urls);
             loadEmployee(page);
        /* }else{
             window.location.href = '{$url_path}list/employee/'+action+'/';
         }*/
    }   
   
}

function loadEmployee(page){
    var view =$("#search_emp").val();
    if(view == '{$translate.search_employee}' || view == ""){
      $("#temp_search_emp").val('');  
   }
   var search = $("#temp_search_emp").val();
   if(search == ""){
       search =  $("#search_alph").val();
   }
    
    var cust = $("#cust").val();
    var action = $("#action").val();
    var sort_by = $("#sort_by").val();
    var urls = encodeURI("{$url_path}ajax_employee_listing.php?page="+page+"&search="+search+"&cust="+cust+"&action="+action+"&sort_by="+sort_by);
    $("#table_val").load(urls);
}

function sortBy(sort_val){
    $("#sort_by").val(sort_val);
     
    paginateDisplay('1');
}

 </script>
{/block}

{block name="content"}
    <div class="tbl_hd"><span class="titles_tab">{$translate.employee}</span>
    {if $privileges_general.add_employee}<a href="{$url_path}employee/add/" class="add">{$translate.add_new}</a>{/if}
    <a href="{$url_path}list/employee/{$action}/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    <div class="titlebar_chekbox" style="margin-top: 4px; margin-right: 12px;"> 
        <form id="form_list" name="form_list" method="post" action="{$url_path}list/employee/{$action}/"
            <label for="inactive"></label>
            <input type="text" name="search_emp" id="search_emp" value="{$translate.search_employee}" />
            <input type="hidden" name="temp_search_emp" id="temp_search_emp" />
            <input type="hidden" name="action" id="action" value="{$action}" />
            <input type="hidden" name="cust" id="cust" value="" />
            <input type="hidden" name="sort_by" id="sort_by" value="{$sort_by}" />
            <input type="hidden" name="search_alph" id="search_alph" value="{$search_alph}" />
            <label for="inactive"></label>
           <!-- <select name="cust" id="cust" onchange="paginateDisplay('1')">

                    <option value="">{$translate.select} {$translate.customer}</option>
                    {foreach from=$customers item=customer}
                        <option value="{$customer.username}">{$customer.last_name} {$customer.first_name}</option>
                    {/foreach}
            </select>-->
              <input type="text" name="search_cust" id="search_cust" value="{$translate.search_customer}" />
             <input type="radio" name="active" id="active" value="act" {if $action == "act"}checked=checked {/if}/>
            <label for="active">{$translate.active}</label>
            <input type="radio" name="active" id="inactive" value="inact" {if $action == "inact"}checked=checked {/if} />
            <label for="inactive">{$translate.inactive}</label>
        </form>
        
        
    </div>
    </div>
       
    <div id="tble_list">
    
    <div class="pagention">
    {assign var='alphabets' value=','|explode:$translate.alphabets}
        <div class="alphbts">
        <ul>
        {foreach from=$alphabets item=row}
        <li><a href="javascript:void(0)" onclick="select_employee('{$action}','{$row}','1')">{$row}</a></li>
        {/foreach}
        </ul>
           
          
        </div>
        <div class="pagention_dv"><div class="pagination"><ul id="pagination">{$pagination}</ul></div>
          
       </div>
    </div>
    <div id="table_val">
    
    <table class="table_list">
        <tr>
            <th><a href="javascript:void(0);" onclick="sortBy('n')">{$translate.name}</a></th>
            <th>{$translate.code}</th>
            <th>{$translate.signature}</th>
            <th><a href="javascript:void(0);" onclick="sortBy('r')">{$translate.role}</a></th>
            <th><a href="javascript:void(0);" onclick="sortBy('el')">{$translate.error_login}</a></th>
            <th>{$translate.loggedin}</th>
            <th>{$translate.mobile}</th>
           <th width="25"></th>
        </tr>
        {foreach from=$employee_list item=employee}
            <tr  class="{cycle values="even,odd"} {if $employee.status == 0} incon2 {/if}">
                <td>{$employee.last_name} {$employee.first_name}</td>
                <td>{$employee.code}</td>
                <td>{$employee.username}</td>
                <td>{if $employee.role == 1}{$translate.admin}
                    {elseif $employee.role == 2}{$translate.tl}
                    {elseif $employee.role == 3}{$translate.employee}
                    {elseif $employee.role == 5}{$translate.trainee}
                    {elseif $employee.role == 6}{$translate.economy}
                    {elseif $employee.role == 7}{$translate.super_tl}{/if}
                    </td>
                <td>{$employee.error_login}</td>
                <td>{if $employee.login == 1}{$translate.yes}{/if}</td>
                <td>{$employee.mobile}</td>
               <td><a href="{$url_path}employee/add/{$employee.username}/" class="settings"><img src="{$url_path}images/settings.png" border="0" title="{$translate.edit}" width="25" /></a></td>
            </tr>
       {foreachelse}
           <tr><td colspan="8">
                   <div class="message">{$translate.no_data_available}</div>
           </td></tr>
       {/foreach}
    </table></div></div>

{/block}

