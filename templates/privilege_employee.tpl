{block name='style'}
    <link href="{$url_path}css/administration.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    .ui-widget-content{
        height: auto !important;
        max-height: 200px !important;
        overflow-y: auto;
    }
</style>
{/block}

{block name="content"}
     <div id="dialog-confirm_change" title="" style="display:none;">
	<br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.select_employee_atleast_one}</p>
</div> 
    <div class="row-fluid">
        <div class="span12 main-left" style="overflow-y:scroll !important">



            <div style="margin: 15px 0px 0px;" class="widget-header span12">
                <div class="span4 day-slot-wrpr-header-left span6">
                    <h1 style="margin: 5px ! important;">{$translate.employee_privilege}</h1>
                </div>
                <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                    <button style="" class="btn btn-default btn-normal pull-right" type="button" onclick="setPrivilege()">{$translate.set_privilege}</button>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">



                <div class="span12">
                    <div class="span12">
                        <div class="widget" style="margin: 0px 0px 10px ! important;">
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group">
                                <form name="frm1" id="frm1" method="post" action="{$url_path}add/privilege/employee/">
                                <div class="span12">

                                    <div class="span3" style="margin: 0px ! important;">
                                        <label style="float: left;" class="span12" for="pre_search">{$translate.search_employee}</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker span10"> <span class="add-on icon-search"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_employee}" name="pre_search" type="text" id="pre_search"> </div>
                                    </div>

                                    <div class="span2" style="">
                                        <label style="float: left;" class="span12" for="exampleInputEmail1">{$translate.role}</label>
                                        <div style="margin-left: 0px; float: left;" class="input-prepend span9"> <span class="add-on icon-pencil"></span>
                                            <select class="form-control span10" name="pre_role" id="pre_role">
                                                <option value="3" {if $emp_roles == 3}selected="selected"{/if}>{$translate.employee}</option>
                                                <option value="2" {if $emp_roles == 2}selected="selected"{/if}>{$translate.tl}</option>
                                                <!--
                                                <option value="5">{$translate.trainee}</option>-->
                                                <option value="7" {if $emp_roles == 7}selected="selected"{/if}>{$translate.super_tl}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span3" style="margin: 0px ! important;">
                                        <label style="float: left;" class="span12" for="search_cust">{$translate.search_customer}</label>
                                        <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker span9"> <span class="add-on icon-pencil"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_customer}" type="text" name="search_cust" id="search_cust"> </div>
                                            <input type="hidden" id="selected_emp" name="selected_emp" value="{$selected_emp}" />
                                            <input type="hidden" id="pre_cust" name="pre_cust" value="" />
                                            <input type="hidden" id="select_all" name="select_all" value="" />
                                    </div>

                                    <div class="pull-left" style="margin: 0px ! important;">
                                        <div style="margin: 20px 0px 0px ! important;" class="select-all-previlege-button" id="select_all_div"><input class="checkbox checkbox-select-all-previlege" type="checkbox" id="select_all_check" onclick="selectAll()"> {$translate.select_all}
                                            
                                        </div> </div>



                                    <div class="pull-right" style="margin: 15px 0px 0px;">
                                        <button class="btn btn-default btn-margin-set" style="text-align: center;" type="button" onclick="clearAllPrivilege()">{$translate.clear_all}</button>
                                    </div
                                ></div>
                                
                            </div>
                             </form>       
                            <!--WIDGET BODY END-->
                            </div>
                        </div>
                   </div>
                <div style="" class="row-fluid">
                    <div class="span12">
                        <div class="span12">
                            <div class="widget" style="margin: 0px ! important;">
                                <!--WIDGET BODY BEGIN-->
                                <div style="" class="span12 widget-body-section input-group">
                                    <div class="pull-left">
                                        <div class="pagination pagination-mini margin-none" id="alphabets">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="paginateDisplayAlphabet('A','1');">A</a></li>
                                                <li><a href="javascript:void(0);" onclick="paginateDisplayAlphabet('B','1');">B</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('C','1');">C</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('D','1');">D</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('E','1');">E</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('F','1');">F</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('G','1');">G</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('H','1');">H</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('I','1');">I</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('J','1');">J</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('K','1');">K</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('L','1');">L</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('M','1');">M</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('N','1');">N</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('O','1');">O</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('P','1');">P</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Q','1');">Q</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('R','1');">R</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('S','1');">S</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('T','1');">T</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('U','1');">U</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('V','1');">V</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('W','1');">W</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('X','1');">X</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Y','1');">Y</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Z','1');">Z</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Å','1');">Å</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Ä','1');">Ä</a></li>
                                                <li><a href="javascript:void(0)" onclick="paginateDisplayAlphabet('Ö','1');">Ö</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="pull-right">
                                        <div class="pagination pagination-mini pagination-right pagin margin-none" id="pages">
                                            <ul>
                                                {if $page_count>1}
                                                    {if $page_count>2}
                                                         <li class="active"><a  href="javascript:void(0)" onclick="paginateDisplay('1','{$page_count}');">1</a></li>
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('2','{$page_count}');">2</a></li>
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('2','{$page_count}');">&gt;</a></li>
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page_count}','{$page_count}');">&gt;&gt;</a></li>
                                                    {elseif $page_count == 2}
                                                         <li class="active"><a href="javascript:void(0)" onclick="paginateDisplay('1','{$page_count}');">1</a></li>
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('2','{$page_count}');">2</a></li> 
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('2','{$page_count}');">&gt;</a></li>
                                                         <li><a href="javascript:void(0)" onclick="paginateDisplay('2','{$page_count}');">&gt;&gt;</a></li>
                                                    {/if}

                                                {/if}
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="span12" style="padding: 0px ! important; margin: 10px 0px 0px; border-top: thin solid rgb(231, 231, 231);">

                                        <div class="row-fluid">
                                            <div class="span12 previlege-table-fix" id="privilege_present_employees">
                                                <form>
                                                    <input type="hidden" name="count" id="count" value="{$count}" />
                                                <div id="loader" style="display:none; height: 31px;width: 31px;margin: 0px auto;background: url('{$url_path}images/ajax-loader_new.gif');"></div>
                                             <div class="table-responsive">
                                                <table class="table table-bordered table-condensed table-hover table-responsive table-primary recruitment-table tablesorter" style="top: 0px; margin: 0px;">
                                                    <tbody>
                                                        {if $employees}
                                                        <tr>
                                                            <td class="center checkbox-radiobox-col" style="width:20px;"><input name="check_user_all"  id="check_user_all" value="all" onclick="added_employees_all()" style="margin: 0px 7px ! important;" type="checkbox"></td>
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
                                                </div>
                                                </form>
                                            </div>
                                        </div>




                                    </div>



                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                        </div>
                        <label style="" for="exampleInputEmail1"> </label>
                    </div>
                </div>

                <div style="margin: 10px 0px 0px;" class="row-fluid">
                    <div class="span12">
                        <div class="span12">


                            <div class="widget" style="border: 0px !important; margin: 0px ! important;">

                                <div style="display:none" class="span12 widget-body-section input-group" id="selected_emp_to_privilege">

                                    <!--WIDGET BODY END-->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>


            </div>
        </div>
        </div>


{/block}

{block name='script'}
{*<script src="{$url_path}js/nice-scroll.js"></script>*}
<script>
    $(document).ready(function(){
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
                source: availableTags,
                select: function( event, ui ) {  
                     this.value = ui.item.value;
                     paginateDisplay('1')
                }
        });
        var availTags = [
            {foreach from=$customers item=customer}
                {if $sort_by_name == 2}
                    "{$customer.last_name} {$customer.first_name}({$customer.code})",      
                 {else}
                    "{$customer.first_name} {$customer.last_name}({$customer.code})",  
                {/if}  
            {/foreach}
                    ""
        ];


        $( "#search_cust" ).autocomplete({
            source: availTags,
            select: function( event, ui ) {  
                 this.value = ui.item.value;
                 $("#pre_cust").val(this.value);
                 paginateDisplay('1')
            }
        });
    
        $("#pre_role").change(function(){
            $("#privilege_present_employees").hide();
            $("#loader").show();
            unselectAll();
            clearAllPrivilege();
            paginateDisplay('1');
        });
    
    });
    
    
    
    function paginateDisplay(page,total){
        //var total = $("#count").val();
        var search_name = $("#pre_search").val();
        var search_role = $("#pre_role").val();
        var search_customer = $("#pre_cust").val();
        var selected = $('#selected_emp').val();
        var urls = encodeURI("{$url_path}ajax_privilege_employee_pages.php?name="+search_name+"&role="+search_role+"&cust="+search_customer+"&selected="+selected+"&page="+page+"&total="+total);
        $("#pages").load(urls);
        findEmployees(page);
    }

    function paginateDisplayAlphabet(alphabet,page){
        //var total = $("#count").val();
        var search_name = $("#pre_search").val();
        var search_role = $("#pre_role").val();
        var search_customer = $("#pre_cust").val();
        var selected = $('#selected_emp').val();
        var urls = encodeURI("{$url_path}ajax_privilege_employee_alphabet_pages.php?name="+alphabet+"&role="+search_role+"&cust="+search_customer+"&selected="+selected+"&page="+page);
        $("#pages").load(urls);
        findEmployeesAlphabet(alphabet,page);
    }
    
    function findEmployees(page){
        var search_name = $("#pre_search").val();
        var search_role = $("#pre_role").val();
        var search_customer = $("#pre_cust").val();
        var selected = $('#selected_emp').val();
        var urls = encodeURI("{$url_path}ajax_privilege_employee_list.php?name="+search_name+"&role="+search_role+"&cust="+search_customer+"&selected="+selected+"&page="+page);
        $("#privilege_present_employees").load(urls,function(response, status, xhr){ $("#loader").hide();
            $("#privilege_present_employees").show();});

    }
    
    function findEmployeesAlphabet(alphabet,page){
        var search_role = $("#pre_role").val();
        var search_customer = $("#pre_cust").val();
        var selected = $('#selected_emp').val();
        var urls = encodeURI("{$url_path}ajax_privilege_employee_list_alphabet.php?name="+alphabet+"&role="+search_role+"&cust="+search_customer+"&selected="+selected+"&page="+page);
        $("#privilege_present_employees").load(urls);

    }
    
    function selectAll(){
        if($('#select_all_check').prop("checked")){
            $("#select_all").val('1');
            $("#selected_emp_to_privilege").show();
            var role = $("#pre_role").val();
            var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?select_all=all&role_all="+role);
            $("#selected_emp_to_privilege").load(urls);            
            
        }else{
            $("#select_all").val(''); 
            $("#selected_emp_to_privilege").hide();
            var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?select_all=''");
            $("#selected_emp_to_privilege").load(urls);
        }
    }
    
    function unselectAll(){
        $('#select_all_check').prop("checked", false);
        $("#select_all").val(''); 
        $("#selected_emp_to_privilege").hide();
        var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?select_all=''");
        $("#selected_emp_to_privilege").load(urls);
    }
    
    function clearAllPrivilege(){
        var select_all = $("#select_all").val();
        if(select_all != ""){
            $("#select_all").val('');
        }
        $("#selected_emp_to_privilege").hide();
        var selected = $("#selected_emp").val();
        $("#selected_emp").val('');
        var blank = "";
        var tmp_emp_array = selected.split(",");
        $("#check_user_all").attr("checked",false); 
        for(var i=0; i < tmp_emp_array.length; i++) {
            $("#check_user_"+tmp_emp_array[i]).attr("checked",false); 
        }
        var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+blank);
        $("#selected_emp_to_privilege").load(urls);

    }
    
    
    function added_employees(user){
        var selected = $("#selected_emp").val();
    //    alert(selected);
        if($('#check_user_'+user).attr('checked')) {

            if(selected == ""){
                $("#selected_emp").val(user);
            }else{
                $("#selected_emp").val(selected+','+user);
            }
            $("#selected_emp_to_privilege").show();
            selected = $("#selected_emp").val();
            var url1 = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+selected);
            $("#selected_emp_to_privilege").load(url1);

        }else{
           var tmp_emp = $('#selected_emp').val();
            var tmp_emp_array = tmp_emp.split(",");
            var new_tmp_emp = '';
            var j=0;

            for(var i=0; i < tmp_emp_array.length; i++) {

                if(tmp_emp_array[i] != user) {
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
            $("#selected_emp").val(new_tmp_emp);
            if(new_tmp_emp == ""){
                 $("#selected_emp_to_privilege").hide();
            }
            var url2 = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+new_tmp_emp);
            $("#selected_emp_to_privilege").load(url2);
        }
    }
    
    function removeEmployee(username){
        var tmp_emp = $('#selected_emp').val();
        var tmp_emp_array = tmp_emp.split(",");
        var new_tmp_emp = '';
        var j=0;

        for(var i=0; i < tmp_emp_array.length; i++) {

            if(tmp_emp_array[i] != username) {
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
        $("#selected_emp").val(new_tmp_emp);
        var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+new_tmp_emp);
        $("#selected_emp_to_privilege").load(urls);
        $('#check_user_'+username).attr('checked', false);
    }
    
    
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
            var urls1 = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+selected);
            $("#selected_emp_to_privilege").load(urls1);
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
            var urls = encodeURI("{$url_path}ajax_selected_employee_privilege.php?empl="+new_tmp_emp);

            $("#selected_emp_to_privilege").load(urls);
        }

    }
    
    function setPrivilege(){
        var selected = $('#selected_emp').val();
        var all_select = $("#select_all").val();
        if(selected == "" && all_select != "1"){
            $( "#dialog-confirm_change" ).dialog({
                resizable: false,
                height:140,
                modal: true
            });
        }else{
            $( "#frm1" ).submit();
        }
    }
</script>
{/block}    

