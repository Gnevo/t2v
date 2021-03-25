<?php /* Smarty version Smarty-3.1.8, created on 2021-01-27 14:30:49
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_privilege_employee_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22487323160117919880658-50698094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4497ab6f8f7b65b59cb02794142df7ebf724edfc' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_privilege_employee_list.tpl',
      1 => 1541661372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22487323160117919880658-50698094',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'employees_autocomplete' => 0,
    'sort_by_name' => 0,
    'employee' => 0,
    'employees' => 0,
    'url_path' => 0,
    'count' => 0,
    'total' => 0,
    'translate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_601179198ff368_72015713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601179198ff368_72015713')) {function content_601179198ff368_72015713($_smarty_tpl) {?><script>
$(function() {
    var availableTags = [
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees_autocomplete']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?>
                "<?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
)",   
            <?php }else{ ?>
                "<?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
)",   
            <?php }?>    
            <?php } ?>
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
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            var user = '<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
';
            $("#check_user_"+user).attr('checked',true);
            //added_employees('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
')
            if(selected_c == '')
                selected_c = user;
            else
                selected_c = selected_c + ','+ user;
        <?php } ?>
        if(selected == ""){
            selected = selected_c;
        }else{
             selected = selected+','+selected_c;
        }
        $("#selected_emp_to_privilege").show();
        $("#selected_emp").val(selected);
        $("#selected_emp_to_privilege").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_selected_employee_privilege.php?empl="+selected);
    }else{
         var selected_c ='';
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
            var user = '<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
';
            $("#check_user_"+user).attr('checked',false); 
//        added_employees('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
');
            if(selected_c == '')
                selected_c = user;
            else
                selected_c = selected_c + ','+ user;
        <?php } ?>
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
        $("#selected_emp_to_privilege").load("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_selected_employee_privilege.php?empl="+new_tmp_emp);
    }
        
}
</script>

        <form>
            <input type="hidden" name="count" id="count" value="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" />
            <input type="hidden" name="total_page" id="total_page" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" />
            
            <table class="table table-bordered table-condensed table-hover table-responsive table-primary recruitment-table tablesorter" style="top: 0px; margin: 0px;">
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['employees']->value){?>
                    <tr>
                        <td class="center checkbox-radiobox-col"><input name="check_user_all"  id="check_user_all" value="all" onclick="added_employees_all()" style="margin: 0px 7px ! important;" type="checkbox"></td>
                        <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</td>

                    </tr>
                <?php }?>
                <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
                    <tr>

                        <td class="center checkbox-radiobox-col"><input name="check_user_<?php echo $_smarty_tpl->tpl_vars['employee']->value['employee_username'];?>
"  id="check_user_<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
" onclick="added_employees('<?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
')" style="margin: 0px 7px ! important;" type="checkbox"></td>
                        <td><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value['first_name'];?>
<?php }?></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['code'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['username'];?>
</td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['employee']->value['role']==1){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['admin'];?>

                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==2){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['tl'];?>

                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==3){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['employee'];?>

                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==5){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['trainee'];?>

                            <?php }elseif($_smarty_tpl->tpl_vars['employee']->value['role']==7){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['super_tl'];?>

                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>    
                </tbody>
        <!-- // Table body END -->
            </table>
        </form>


        <?php }} ?>