<?php /* Smarty version Smarty-3.1.8, created on 2020-12-06 14:03:34
         compiled from "/home/time2view/public_html/cirrus/templates/ajax_customer_overlap_report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11542359875fcce4b67da326-15119173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba5e0f95dec1b6bba4cb9cbf544f0dce7ccb95fa' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/ajax_customer_overlap_report.tpl',
      1 => 1515587226,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11542359875fcce4b67da326-15119173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'translate' => 0,
    'time_collide' => 0,
    'overlapped_slots' => 0,
    'sort_by_name' => 0,
    'slot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcce4b6826379_50458749',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcce4b6826379_50458749')) {function content_5fcce4b6826379_50458749($_smarty_tpl) {?>
<style type="text/css">
.td_hour{
width: 21px;
overflow: hidden;
}
.line_border {
    background:url(<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
images/line_border.png);
    
}
</style>

<table cellspacing="0" cellpadding="0" style=" clear:both;" class="table_list tbl_padding_fix mytable">
    <tbody>
        <tr>
            <td colspan="25" align="center" style="background: #a2dce8; height: 30px; font-size: 14px; font-weight: 900; color: #ffffff"><?php echo $_smarty_tpl->tpl_vars['translate']->value['total_time_collide'];?>
<?php echo $_smarty_tpl->tpl_vars['time_collide']->value;?>
<?php echo $_smarty_tpl->tpl_vars['translate']->value['hrs'];?>
</td>
        </tr>    
        <tr class="time_slot_table">
            <td align="center" style="word-wrap: normal; white-space: normal;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['name'];?>
</td> 
            <td align="right" ><div class="td_hour">01</div></td>
            <td align="right" ><div class="td_hour">02</div></td>
            <td align="right" ><div class="td_hour">03</div></td>
            <td align="right" ><div class="td_hour">04</div></td>
            <td align="right" ><div class="td_hour">05</div></td>
            <td align="right" ><div class="td_hour">06</div></td>
            <td align="right" ><div class="td_hour">07</div></td>
            <td align="right" ><div class="td_hour">08</div></td>
            <td align="right" ><div class="td_hour">09</div></td>
            <td align="right" ><div class="td_hour">10</div></td>
            <td align="right" ><div class="td_hour">11</div></td>
            <td align="right" ><div class="td_hour">12</div></td>
            <td align="right" ><div class="td_hour">13</div></td>
            <td align="right" ><div class="td_hour">14</div></td>
            <td align="right" ><div class="td_hour">15</div></td>
            <td align="right" ><div class="td_hour">16</div></td>
            <td align="right" ><div class="td_hour">17</div></td>
            <td align="right" ><div class="td_hour">18</div></td>
            <td align="right" ><div class="td_hour">19</div></td>
            <td align="right" ><div class="td_hour">20</div></td>
            <td align="right" ><div class="td_hour">21</div></td>
            <td align="right" ><div class="td_hour">22</div></td>
            <td align="right" ><div class="td_hour">23</div></td>
            <td align="right" ><div class="td_hour">24</div></td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['slot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slot']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['overlapped_slots']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slot']->key => $_smarty_tpl->tpl_vars['slot']->value){
$_smarty_tpl->tpl_vars['slot']->_loop = true;
?>
        <tr style="height:40px;">
            <td align="center" style="word-wrap: normal; white-space: normal;"><div style="width:295px; overflow: hidden;"></div><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['slot']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['slot']->value['last_name'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['slot']->value['last_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['slot']->value['first_name'];?>
<?php }?></div></td>
            <td colspan="24" class="line_border"><div style="width:756px;"><span title="<?php echo $_smarty_tpl->tpl_vars['slot']->value['time_diff'];?>
<?php echo $_smarty_tpl->tpl_vars['translate']->value['hrs'];?>
" style="height:20px; width:<?php echo $_smarty_tpl->tpl_vars['slot']->value['width_popup'];?>
px; background:<?php echo $_smarty_tpl->tpl_vars['slot']->value['color'];?>
; float:left; border:1px solid #CCC; margin-left:<?php echo $_smarty_tpl->tpl_vars['slot']->value['margin_left_popup'];?>
px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;">&nbsp;</span></div></td>
            
        </tr>
        <?php } ?>
          
            
    </tbody>
</table><?php }} ?>