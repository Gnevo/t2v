<?php /* Smarty version Smarty-3.1.8, created on 2020-12-16 13:56:54
         compiled from "/home/time2view/public_html/cirrus/templates/leave_vab_pdf_edited.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10070650345fda1226b3c430-66850606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c20aa69f5a87a54383688f86fd90d38078fc6dfd' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/leave_vab_pdf_edited.tpl',
      1 => 1551702302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10070650345fda1226b3c430-66850606',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'message' => 0,
    'translate' => 0,
    'employee_username' => 0,
    'years_combo' => 0,
    'report_year' => 0,
    'month' => 0,
    'customers' => 0,
    'cust' => 0,
    'selected_all_customers' => 0,
    'customer' => 0,
    'sort_by_name' => 0,
    'employees' => 0,
    'emp' => 0,
    'selected_all_employees' => 0,
    'employee' => 0,
    'login_company_id' => 0,
    'relations' => 0,
    'relation' => 0,
    'below_25' => 0,
    'btwn_25_65' => 0,
    'above_65' => 0,
    'i' => 0,
    'total_vikari_hours' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fda1226cb8ea9_32156980',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fda1226cb8ea9_32156980')) {function content_5fda1226cb8ea9_32156980($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus/libs/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus/libs/plugins/modifier.date_format.php';
?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/forms_report.css" rel="stylesheet" type="text/css" />
	
	<style> .panel-title ul li{ color: #333;}</style>



<script type="text/javascript">

$(document).ready(function(){
   
    if($(window).height() > 300)
        $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
    else
        $('#employee_tab_content_pdf_form').css({ height: $(window).height()});  
        
});

function loadCustomers(){
   

    var year = $("#year").val();
    var month = $("#month").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
leave_vab_pdf_edited.php?'+year+'&'+month+'',8);
}

function loadEmployees(){
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
leave_vab_pdf_edited.php?'+year+'&'+month+'&'+customer+'',8);
}

function submitForm(){
    $("#forms").attr('target', '_self');
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    var employee =$("#employee").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
leave_vab_pdf_edited.php?'+year+'&'+month+'&'+customer+'&'+employee+'',8);
}

function printSickDetailsReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('printSickDetailsReport');
        f.submit();
    }
}

function printWorkReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_BLANK');
        $('#action').val('printWorkReport');
        f.submit();
    }
}

</script>




	<div class="row-fluid">
		<div class="span12 main-left" style="overflow:hidden; height: 623px;">
			<div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
	        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
	            <div class="panel-heading" style="">
	                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
	                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['vab_leave_report'];?>

	                    <ul class="pull-right">
	                        <li><i class="icon-arrow-left"></i><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
forms/"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a></li>
	                        <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
leave_vab_pdf_edited.php',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</span></a></li>
	                    </ul>
	                </h4>
	            </div>
	        </div>

	        <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/vab/leave/">
            	<input type="hidden" name="action" id="action" value="" />
            	<input type="hidden" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['employee_username']->value;?>
" />
            	<div class="span12 no-ml" id="forms_container" style="border: 1px solid #dcdcdc;padding: 5px;">
            		<div id="employee_tab_content_pdf_form" class="span12" style="background: none repeat scroll 0 0 #ffffff;border: 1px solid #dcdcdc;padding: 15px; overflow-y: auto;">
            			<div class="span12" name="leave_inputs" id="leave_inputs">
	                        <div class="span8">
	                            <div class="span12">
	                                <span class="span6">
	                                    <label class="pull-left span3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['year'];?>
:</label>
	                                    <select id="year" name="year" style="border:solid 1px #d9d9d9">
	                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
	                                        <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['years_combo']->value,'selected'=>$_smarty_tpl->tpl_vars['report_year']->value,'output'=>$_smarty_tpl->tpl_vars['years_combo']->value),$_smarty_tpl);?>

	                                    </select>
	                                </span>
	                                <span class="span6"> <label class="pull-left span3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['month'];?>
: </label>
	                                    <select style="border:solid 1px #d9d9d9" onchange="loadCustomers()" id="month" name="month">
	                                        <option value="" ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
	                                        <?php if ($_smarty_tpl->tpl_vars['month']->value==''){?>
	                                            <option value="01" <?php if (smarty_modifier_date_format(time(),"%m")==1){?> selected = "selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['translate']->value['jan'];?>
</option>
	                                            <option value="02" <?php if (smarty_modifier_date_format(time(),"%m")==2){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['feb'];?>
</option>
	                                            <option value="03" <?php if (smarty_modifier_date_format(time(),"%m")==3){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['mar'];?>
</option>
	                                            <option value="04" <?php if (smarty_modifier_date_format(time(),"%m")==4){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['apr'];?>
</option>
	                                            <option value="05" <?php if (smarty_modifier_date_format(time(),"%m")==5){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
	                                            <option value="06" <?php if (smarty_modifier_date_format(time(),"%m")==6){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['jun'];?>
</option>
	                                            <option value="07" <?php if (smarty_modifier_date_format(time(),"%m")==7){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['jul'];?>
</option>
	                                            <option value="08" <?php if (smarty_modifier_date_format(time(),"%m")==8){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['aug'];?>
</option>
	                                            <option value="09" <?php if (smarty_modifier_date_format(time(),"%m")==9){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sep'];?>
</option>
	                                            <option value="10" <?php if (smarty_modifier_date_format(time(),"%m")==10){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['oct'];?>
</option>
	                                            <option value="11" <?php if (smarty_modifier_date_format(time(),"%m")==11){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['nov'];?>
</option>
	                                            <option value="12" <?php if (smarty_modifier_date_format(time(),"%m")==12){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['dec'];?>
</option>
	                                        <?php }else{ ?>
	                                            <option value="01" <?php if ($_smarty_tpl->tpl_vars['month']->value==1){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['jan'];?>
</option>
	                                            <option value="02" <?php if ($_smarty_tpl->tpl_vars['month']->value==2){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['feb'];?>
</option>
	                                            <option value="03" <?php if ($_smarty_tpl->tpl_vars['month']->value==3){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['mar'];?>
</option>
	                                            <option value="04" <?php if ($_smarty_tpl->tpl_vars['month']->value==4){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['apr'];?>
</option>
	                                            <option value="05" <?php if ($_smarty_tpl->tpl_vars['month']->value==5){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['may'];?>
</option>
	                                            <option value="06" <?php if ($_smarty_tpl->tpl_vars['month']->value==6){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['jun'];?>
</option>
	                                            <option value="07" <?php if ($_smarty_tpl->tpl_vars['month']->value==7){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['jul'];?>
</option>
	                                            <option value="08" <?php if ($_smarty_tpl->tpl_vars['month']->value==8){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['aug'];?>
</option>
	                                            <option value="09" <?php if ($_smarty_tpl->tpl_vars['month']->value==9){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['sep'];?>
</option>
	                                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['month']->value==10){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['oct'];?>
</option>
	                                            <option value="11" <?php if ($_smarty_tpl->tpl_vars['month']->value==11){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['nov'];?>
</option>
	                                            <option value="12" <?php if ($_smarty_tpl->tpl_vars['month']->value==12){?> selected = "selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['dec'];?>
</option>
	                                        <?php }?>
	                                    </select>
	                                </span>
	                            </div>
	                            <div class="span12 no-ml">
	                                <span class="span6"> <label class="pull-left span3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['choose_user'];?>
</label>
	                                    <select id="customer" name="customer" onchange="loadEmployees()" style="border:solid 1px #d9d9d9">
	                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
	                                        <?php if (count($_smarty_tpl->tpl_vars['customers']->value)>1){?>
	                                            <option value="ALL" <?php if ($_smarty_tpl->tpl_vars['cust']->value=='ALL'||$_smarty_tpl->tpl_vars['selected_all_customers']->value==true){?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</option>
	                                        <?php }?>
	                                        <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
	                                            <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['cust']->value==$_smarty_tpl->tpl_vars['customer']->value['customer_id']){?>selected="selected" <?php }?> ><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['cust_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['customer']->value['cust'];?>
<?php }?></option>
	                                        <?php } ?>
	                                    </select>
	                                </span>
	                                <span class="span6"><label class="pull-left span3"><?php echo $_smarty_tpl->tpl_vars['translate']->value['choose_assistant'];?>
: </label>
	                                    <select id="employee" name="employee" onchange="submitForm()" style="border:solid 1px #d9d9d9">
	                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
	                                        <?php if (count($_smarty_tpl->tpl_vars['employees']->value)>1){?>
	                                            <option value="ALL" <?php if ($_smarty_tpl->tpl_vars['emp']->value=='ALL'||$_smarty_tpl->tpl_vars['selected_all_employees']->value==true){?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['translate']->value['all'];?>
</option>
	                                        <?php }?>
	                                        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['employee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['employees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
$_smarty_tpl->tpl_vars['employee']->_loop = true;
?>
	                                            <option value="<?php echo $_smarty_tpl->tpl_vars['employee']->value['employee_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['emp']->value==$_smarty_tpl->tpl_vars['employee']->value['employee_id']){?>selected="selected" <?php }?> ><?php if ($_smarty_tpl->tpl_vars['sort_by_name']->value==1){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['employee_ff'];?>
<?php }elseif($_smarty_tpl->tpl_vars['sort_by_name']->value==2){?><?php echo $_smarty_tpl->tpl_vars['employee']->value['employee'];?>
<?php }?></option>
	                                        <?php } ?>
	                                    </select>
	                                </span>
	                            </div>
	                        </div>
	                        <span style="" class="span4 pull-right">
	                            
	                            <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''||$_smarty_tpl->tpl_vars['selected_all_customers']->value==true){?>
	                                <button type="button" onclick="printWorkReport();" class="btn btn-primary pull-right no-mr ml"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print_work_report'];?>
</button>
	                                <button type="button" onclick="printSickDetailsReport();" class="btn btn-primary pull-right mr"><i class="icon-file-text"></i> <?php if ($_smarty_tpl->tpl_vars['login_company_id']->value==8){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['print_sick_details_report_optimal'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['translate']->value['print_vab_details_report'];?>
<?php }?></button>
	                            <?php }?>
	                        </span>
                        
	                        <?php if ($_smarty_tpl->tpl_vars['relations']->value){?>
	                            <span class="form-section-highlight span12 no-ml mt">
	                                <h5><?php echo $_smarty_tpl->tpl_vars['translate']->value['vab_period'];?>
 <?php echo $_smarty_tpl->tpl_vars['relations']->value[0]['date'];?>
 till <?php echo $_smarty_tpl->tpl_vars['relations']->value[(count($_smarty_tpl->tpl_vars['relations']->value))-1]['date'];?>
</h5>
	                                <hr>
	                                <div class="table-responsive">
	                                <table border="1px solid" cellspacing="0" cellpadding="5" class="table table-bordered table-striped" style="border-color: rgb(228, 228, 228); text-align: center;">
	                                    <tbody>
	                                        <tr>
	                                            <td width="265"><strong>Namn p&aring; vikarie</strong></td>
	                                            <td width="113"><strong>Datum</strong></td>
	                                            <td width="98"><strong>Klockslag</strong></td>
	                                            <td width="39"><strong>L&ouml;ntyp</strong></td>
	                                            <td width="49"><strong>Ant tim</strong></td>
	                                            
	                                            <td width="35"><strong>Soc.</strong></td>
	                                        </tr>
	                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
	                                        <?php  $_smarty_tpl->tpl_vars['relation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relation']->key => $_smarty_tpl->tpl_vars['relation']->value){
$_smarty_tpl->tpl_vars['relation']->_loop = true;
?>
	                                            <tr>
	                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['employee'];?>
</td>
	                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['date'];?>
</td>
	                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['time_from'];?>
 - <?php echo $_smarty_tpl->tpl_vars['relation']->value['time_to'];?>
</td>
	                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['inconv'];?>
</td>
	                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['tot_time'];?>
</td>
	                                                
	                                                
	        
	                                                <td style="padding-left: 8px"><?php if ($_smarty_tpl->tpl_vars['relation']->value['age']<25){?><?php echo $_smarty_tpl->tpl_vars['below_25']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['relation']->value['age']<65){?><?php echo $_smarty_tpl->tpl_vars['btwn_25_65']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['relation']->value['age']>=65){?><?php echo $_smarty_tpl->tpl_vars['above_65']->value;?>
<?php }?></td>
	                                            </tr> 
	                                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
	                                        <?php } ?>
	                                        <input type="hidden" name="tot_rows" id="tot_rows" value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" />
	                                    </tbody>
	                                </table>
	                                </div>
	                                <p>Summering hela m&aring;naden: <?php echo $_smarty_tpl->tpl_vars['total_vikari_hours']->value;?>
 tim</p>
	                               
	                            </span>
	                        <?php }?>
                    	</div>
            		</div>
            	</div>
            </form>
		</div>
	</div>
<?php }} ?>