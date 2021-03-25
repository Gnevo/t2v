<?php /* Smarty version Smarty-3.1.8, created on 2021-03-19 10:53:00
         compiled from "/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/leave_payment_pdf_edited.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10521858866034ec9f13fcd0-21448311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1615ea07d353a12edcd7b6395d9d3eb42c2fe4b7' => 
    array (
      0 => '/home/time2view/public_html/cirrus-r/cirrus-r-new/templates/leave_payment_pdf_edited.tpl',
      1 => 1616151151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10521858866034ec9f13fcd0-21448311',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6034ec9f32bd16_72168072',
  'variables' => 
  array (
    'url_path' => 0,
    'relations' => 0,
    'translate' => 0,
    'message' => 0,
    'flag_cust_access' => 0,
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
    'sicks' => 0,
    'entries' => 0,
    'login_company_id' => 0,
    'ker_str' => 0,
    'relation' => 0,
    'count' => 0,
    'count1' => 0,
    'below_25' => 0,
    'btwn_25_65' => 0,
    'above_65' => 0,
    'i' => 0,
    'total_vikari_hours' => 0,
    'sick_form_defaults' => 0,
    'company_bank_account' => 0,
    'form_reference_number' => 0,
    'form_reference_number_set' => 0,
    'frns' => 0,
    'customer_Kollectival_name' => 0,
    'employee_normal_salary' => 0,
    'company_fk_kr_per_time' => 0,
    'insurance_ordinary' => 0,
    'sel_employees_age' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6034ec9f32bd16_72168072')) {function content_6034ec9f32bd16_72168072($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/time2view/public_html/cirrus-r/cirrus-r-new/libs/plugins/modifier.date_format.php';
?>
<link href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/forms_report.css" rel="stylesheet" type="text/css" />

<style> .panel-title ul li{ color: #333;}</style>



<script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>

<script type="text/javascript">
    
$(document).ready(function(){
    // if($(window).height() > 300)
    //     $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
    // else
    //     $('#employee_tab_content_pdf_form').css({ height: $(window).height()});  
        
    $(window).resize(function(){
        if($(window).height() > 300)
            $('#employee_tab_content_pdf_form').css({ height: $(window).height()-109});
        else
            $('#employee_tab_content_pdf_form').css({ height: $(window).height()});
    }).resize();
                    
});
    
function printForm(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
        
        setTimeout(function(){ 
                navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/'+$("#year").val()+'/'+$("#month").val()+'/'+$("#customer").val()+'/'+$("#employee").val()+'/',8);
            }, 9000);
    }
}

function printWorkReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printWorkReport');
        f.submit();
    }
    
}

function printSickDetailsAndWorkReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printSickDetailsAndWorkReport');
        f.submit();
    }
}

function printSickDetailsReport(){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
    // if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && ($("#employee").val() != "" || $("#customer").val() == "ALL")){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        // f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printSickDetailsReport');
        f.submit();
    }
    
}


function printFKWorkReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printFKWorkReport');
        f.submit();
    }
}
function printFKDeviationReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        //f.attr('target', '_BLANK');
        f.attr('target', '_self');
        $('#action').val('printFKDeviationReport');
        f.submit();
    }
}
function printVikarie3059Report(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != "" && $("#employee").val() != ""){
        var f = $("#forms");
        f.attr('target', '_self');
        $('#action').val('printVikarie3059Report');
        f.submit();
    }
}


function printAnnexReport(){
    if($("#year").val() != "" && $("#month").val() != "" && $("#customer").val() != ""){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        // f.attr('target', '_self');
        $('#action').val('printAnnexReport');
        f.submit();
    }
}

function printVikarieListReport(){
    // if('<?php echo $_smarty_tpl->tpl_vars['relations']->value;?>
'){
        var f = $("#forms");
        f.attr('target', '_BLANK');
        $('#action').val('printVikarieListReport');
        f.submit();    
    // }
    // else{
    //     bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['no_data_available'];?>
', [
    //         {
    //             "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['ok'];?>
",
    //             "class" : "btn-danger",
    //         }
    //     ]);
    // }
    
}

function loadCustomers(){
    var year = $("#year").val();
    var month = $("#month").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/'+year+'/'+month+'/',8);
    
}
    
function loadEmployees(){
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/'+year+'/'+month+'/'+customer+'/',8);
    
}
    
function show_sicks(){
    var s_name = $("#old_pdf").val();
    if(s_name != ""){
            window.open("<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf_viewer.php?name="+s_name+'&rename=true');
    }
}

function submitForm(){
    $("#forms").attr('target', '_self');
    var year = $("#year").val();
    var month = $("#month").val();
    var customer =$("#customer").val();
    var employee =$("#employee").val();
    navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/'+year+'/'+month+'/'+customer+'/'+employee+'/',8);
    
}
</script>




<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<?php if ($_smarty_tpl->tpl_vars['flag_cust_access']->value==1){?>
<div class="row-fluid">
    <div class="span12 main-left" style="overflow:hidden; height: 623px;">
        <div id="left_message_wraper" class="span12 no-min-height"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    <?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_report'];?>

                    <ul class="pull-right">
                        <li><i class="icon-arrow-left"></i><a href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
forms/"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['backs'];?>
</span></a></li>
                        <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/',8);"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['reset'];?>
</span></a></li>
                        <li><i class="icon-print"></i><a href="javascript:void(0);" onclick="printForm();"><span class="special_spn"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_n_print'];?>
</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <form name="forms" id="forms" method="post" action="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
pdf/payment/leave/">
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
                                    
                            <?php if ($_smarty_tpl->tpl_vars['sicks']->value){?>
                                <div class="span12 no-ml">
                                    <label class="pull-left span3">Tidigare Sjukblanketter:</label>
                                    <select style="border:solid 1px #d9d9d9" onchange="show_sicks()" id="old_pdf" name="old_pdf">
                                        <option value=""  selected ><?php echo $_smarty_tpl->tpl_vars['translate']->value['select'];?>
</option>
                                        <?php  $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entries']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sicks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entries']->key => $_smarty_tpl->tpl_vars['entries']->value){
$_smarty_tpl->tpl_vars['entries']->_loop = true;
?>
                                            <option value=<?php echo $_smarty_tpl->tpl_vars['entries']->value['file'];?>
><?php echo $_smarty_tpl->tpl_vars['entries']->value['date'];?>
</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php }?>
                        </div>
                        <span style="" class="span4 pull-right">
                            <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''||$_smarty_tpl->tpl_vars['selected_all_customers']->value==true){?>
                                <span class="span12 pull-right">
                                    
                                    
                                    
                                        <span class="span6 pull-right">
                                            <button type="button" onclick="printWorkReport();" class="btn btn-primary pull-right no-mr ml span12"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print_work_report'];?>
</button>
                                        </span>
                                        <span class="span6 pull-right">
                                            <button type="button" onclick="printSickDetailsReport();" class="btn btn-primary pull-right mr span12"><i class="icon-file-text"></i> <?php if ($_smarty_tpl->tpl_vars['login_company_id']->value==8){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['print_sick_details_report_optimal'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['translate']->value['print_sick_details_report'];?>
<?php }?></button>
                                        </span>
                                </span>  
                                
                            <?php }?>     
                                 
                                    
                                    
                            <?php if ($_smarty_tpl->tpl_vars['cust']->value!=''||$_smarty_tpl->tpl_vars['selected_all_customers']->value==true){?>
                                <span class="span12 pull-right">
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printVikarie3059Report();" class="btn btn-primary pull-right ml mt span12" style="padding: 4px 10px;"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print_substitute_3059'];?>
</button>
                                    </span>
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printAnnexReport();" class="btn btn-primary pull-right mr ml mt span12" style="margin-top: 5px ! important;"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['leave_annex_report'];?>
</button>
                                    </span>
                                </span>
                                <span class="span12 pull-right">      
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printSickDetailsAndWorkReport();" class="btn btn-primary pull-right ml mt span12" style="padding: 4px 10px;"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print_work_and_sick_details_report'];?>
</button>
                                    </span>
                                    <span class="span6 pull-right">
                                        <button type="button" onclick="printVikarieListReport();" class="btn btn-primary pull-right mr ml mt span12" style="margin-top: 5px ! important;"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['print_replace_employee'];?>
</button>
                                    </span>
                               
                                        
                                        
                                    

                                    
                                </span>
                            <?php }?>
                        </span>
                        
                        <?php if ($_smarty_tpl->tpl_vars['relations']->value){?>
                            <span class="form-section-highlight span12 no-ml mt">
                                <h5>Sjukperiod: <?php echo $_smarty_tpl->tpl_vars['relations']->value[0]['date'];?>
 till <?php echo $_smarty_tpl->tpl_vars['relations']->value[(count($_smarty_tpl->tpl_vars['relations']->value))-1]['date'];?>
 <i><b>(<?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_slot_Karensdag'];?>
 <?php echo $_smarty_tpl->tpl_vars['ker_str']->value;?>
)</b></i>
                                
                                </h5>
                                <hr>
                                <div class="table-responsive">
                                <table border="1px solid" cellspacing="0" cellpadding="5" class="table table-bordered table-striped" style="border-color: rgb(228, 228, 228); text-align: center;">
                                    <tbody>
                                        <tr>
                                            <td width="265"><u><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['replacement_empl_name'];?>
</strong></u></td>
                                            <td width="100"><strong>Datum</strong></td>
                                            <td width="60"><strong>Klockslag</strong></td>
                                            <td width="39"><strong>L&ouml;netyp</strong></td>
                                            <td width="39"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_slot_header'];?>
</strong></td>
                                            <td width="55"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['replaced_hours_header'];?>
</strong></td>
                                            
                                            <td width="35"><strong><?php echo $_smarty_tpl->tpl_vars['translate']->value['soc_coasts'];?>
</strong></td>
                                        </tr>
                                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                                         <?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars["count1"] = new Smarty_variable(0, null, 0);?>
                                        
                                        <?php  $_smarty_tpl->tpl_vars['relation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relation']->key => $_smarty_tpl->tpl_vars['relation']->value){
$_smarty_tpl->tpl_vars['relation']->_loop = true;
?>
                                        
                                            <?php if ($_smarty_tpl->tpl_vars['relation']->value['employee']==''){?> <?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->tpl_vars['count']->value+$_smarty_tpl->tpl_vars['relation']->value['tot_time'], null, 0);?><?php }else{ ?><?php }?>
                                             <?php if ($_smarty_tpl->tpl_vars['relation']->value['employee']!=''){?> <?php $_smarty_tpl->tpl_vars["count1"] = new Smarty_variable($_smarty_tpl->tpl_vars['count1']->value+$_smarty_tpl->tpl_vars['relation']->value['tot_time'], null, 0);?><?php }else{ ?><?php }?>
                                            <tr>
                                                <!--<td><?php echo $_smarty_tpl->tpl_vars['relation']->value['employee'];?>
</td>-->
                                                <td><?php if ($_smarty_tpl->tpl_vars['relation']->value['employee']!=''){?><strong><?php echo $_smarty_tpl->tpl_vars['relation']->value['employee'];?>
</strong><?php }else{ ?><i><?php echo $_smarty_tpl->tpl_vars['translate']->value['unmanned_slot'];?>
</i><?php }?></td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['date'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['time_from'];?>
 - <?php echo $_smarty_tpl->tpl_vars['relation']->value['time_to'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['relation']->value['inconv'];?>
</td>
                                                 <td style="text-align: right;"><?php if ($_smarty_tpl->tpl_vars['relation']->value['employee']==''){?><?php echo $_smarty_tpl->tpl_vars['relation']->value['tot_time'];?>
<?php }else{ ?><?php }?> </td>
                                                <td style="text-align: right;"><?php if ($_smarty_tpl->tpl_vars['relation']->value['employee']!=''){?><?php echo $_smarty_tpl->tpl_vars['relation']->value['tot_time'];?>
<?php }else{ ?><?php }?></td>
                                                
                                                
        
                                                <td style="padding-left: 8px"><?php if ($_smarty_tpl->tpl_vars['relation']->value['age']<25){?><?php echo $_smarty_tpl->tpl_vars['below_25']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['relation']->value['age']<65){?><?php echo $_smarty_tpl->tpl_vars['btwn_25_65']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['relation']->value['age']>=65){?><?php echo $_smarty_tpl->tpl_vars['above_65']->value;?>
<?php }?></td>
                                            </tr> 
                                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                                        <?php } ?>
                                            <tr>
                                                <td style="font-weight: bold;">Summering hela m&aring;naden</td>
                                                <td colspan="3"></td>
                                                 <td style="text-align: right;"><?php if ($_smarty_tpl->tpl_vars['count']->value=="0"){?>-<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
<?php }?></td>
                                               <!-- <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['total_vikari_hours']->value;?>
</td>-->
                                               <td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['count1']->value;?>
</td>
                                                <td></td>
                                            </tr>
                                        <input type="hidden" name="tot_rows" id="tot_rows" value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" />
                                    </tbody>
                                </table>
                                </div>
                            </span>
                        <?php }?>
                    </div>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">&Ouml;vriga f&auml;lt</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Uppdrag</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtUppdrag" type="text" id="txtUppdrag" value="<?php echo $_smarty_tpl->tpl_vars['sick_form_defaults']->value['uppdrag'];?>
" size="30" /></td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Fullmakt</td>
                                <td width="75%" bgcolor="#FFFFFF">
                                    <label><input name="chkFullmaktBifogas" type="checkbox" id="chkFullmaktBifogas" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['fullmakt_values']['fullmakt1']==1){?>checked="checked"<?php }?>> Bifogas </label>
                                    <label class='mt mb'><input name="chkFullmaktTidigareInsant" type="checkbox" id="chkFullmaktTidigareInsant" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['fullmakt_values']['fullmakt2']==1){?>checked="checked"<?php }?>> Tidigare ins&auml;nt</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Ers&auml;ttning betalas till konto</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtErsattningBetalasTillKonto" type="text" id="txtErsattningBetalasTillKonto" size="30" value="<?php echo $_smarty_tpl->tpl_vars['company_bank_account']->value;?>
"/></td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Referensnummer</td>
                                <td width="75%" bgcolor="#FFFFFF">
                                    <!--input name="txtReferensnummer" type="text" id="txtReferensnummer" value="<?php echo $_smarty_tpl->tpl_vars['form_reference_number']->value;?>
" size="30"/-->
                                    <?php  $_smarty_tpl->tpl_vars['frns'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['frns']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form_reference_number_set']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['frns']->key => $_smarty_tpl->tpl_vars['frns']->value){
$_smarty_tpl->tpl_vars['frns']->_loop = true;
?>
                                        <div class="span12 no-ml">
                                            <input name="txtReferensnummer[]" type="text" value="<?php echo $_smarty_tpl->tpl_vars['frns']->value['ref'];?>
" size="30" class="no-mb"/>&nbsp; &nbsp; <i><?php if ($_smarty_tpl->tpl_vars['frns']->value['date']!=''){?><?php echo $_smarty_tpl->tpl_vars['translate']->value['karense_days'];?>
:&nbsp;<?php echo $_smarty_tpl->tpl_vars['frns']->value['date'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['translate']->value['no_karense'];?>
<?php }?> </i>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%" bgcolor="#FFFFFF">Kollektivavtal</td>
                                <td width="75%" bgcolor="#FFFFFF"><input name="txtKollektivavtal" type="text" id="txtKollektivavtal" value="<?php echo $_smarty_tpl->tpl_vars['customer_Kollectival_name']->value;?>
" size="30" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas1" type="checkbox" id="chkBifogas1" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['checkbox_values']['chkBifogas1']==1){?>checked="checked"<?php }?>/>
                                    Sjukfr&aring;nvaroanm&auml;lan eller annan uppgift som styrker ordinarie assistents sjukfr&aring;nvaro.</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas2" type="checkbox" id="chkBifogas2" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['checkbox_values']['chkBifogas2']==1){?>checked="checked"<?php }?>/>
                                    Kopia p&aring; l&ouml;neutbetalning eller annan uppgift som styrker att kostnaderna &auml;r utbetalda&ndash; ordinarie personlig assistent och vikarie</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas3" type="checkbox" id="chkBifogas3" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['checkbox_values']['chkBifogas3']==1){?>checked="checked"<?php }?>/>
                                    Tidrapport till f&ouml;rs&auml;kringskassan - ordinarie personlig asstistens och vikarie</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#FFFFFF">
                                    <label><input name="chkBifogas4" type="checkbox" id="chkBifogas4" value="1" <?php if ($_smarty_tpl->tpl_vars['sick_form_defaults']->value['checkbox_values']['chkBifogas4']==1){?>checked="checked"<?php }?>/>
                                    Komplett ifyllt sammanst&auml;llning som visas att faktiskt merkostnad finns. (Styrkande av merkostnadens storlek, sid 2.)</label>
                                </td>
                            </tr>
                        </table>
                        </div>            
                    </span>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">Ord l&ouml;n kr/tim assistent</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="15%" bgcolor="#FFFFFF">Ord l&ouml;n kr/tim</td>
                                <td width="85%" bgcolor="#FFFFFF"><input name="txtAssistentOrdLon" type="text" id="txtAssistentOrdLon" size="10" value="<?php echo $_smarty_tpl->tpl_vars['employee_normal_salary']->value;?>
" style="border:solid 1px #d9d9d9; background-color: #D9D9D4" disabled="disabled"/></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">Kr/tim</td>
                                <td bgcolor="#FFFFFF"><input name="txtTotalKostnadPerTim" type="text" id="txtTotalKostnadPerTim" size="10" value="<?php echo $_smarty_tpl->tpl_vars['company_fk_kr_per_time']->value;?>
" />                         
                                    Redovisad kostnad till FK f&ouml;r utf&ouml;rd assistans under sjukperioden</td>
                            </tr>
                        </table>
                        </div>            
                    </span>
                    
                    <span class="manage-form span12 no-ml" style="margin-top: 25px">
                        <h4 style="font-weight: bold;">F&ouml;rs&auml;kring och sociala avgifter</h4>
                        <hr>
                        <div class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                            <tr>
                                <td width="15%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="15%" bgcolor="#FFFFFF"><strong>Ord personal</strong></td>
                               
                                <td width="16%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="39%" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><strong>Pensionsf&ouml;rs&auml;kring</strong></td>
                                <td bgcolor="#FFFFFF"><input name="txtForsakring_Ord" type="text" id="txtForsakring_Ord" size="5" value="<?php echo $_smarty_tpl->tpl_vars['insurance_ordinary']->value;?>
" />%</td>
                                
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><strong>Sociala avgifter</strong></td>
                                <td bgcolor="#FFFFFF"><input name="txtSocialaAvgifter_Ord" type="text" id="txtSocialaAvgifter_Ord" size="5" value="<?php if ($_smarty_tpl->tpl_vars['sel_employees_age']->value<25){?><?php echo $_smarty_tpl->tpl_vars['below_25']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['sel_employees_age']->value<65){?><?php echo $_smarty_tpl->tpl_vars['btwn_25_65']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['sel_employees_age']->value>=65){?><?php echo $_smarty_tpl->tpl_vars['above_65']->value;?>
<?php }?>" readonly="readonly" />%</td>
                               
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                        </table>
                        </div>        
                    </span>
                      
                    <span class="span12 no-ml" style="margin-top: 25px">
                        <button type="button" onclick="printForm();" class="btn btn-primary mr"><i class="icon-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['save_n_print'];?>
</button>
                    </span>

                </div>
            </div>
        </form> 
    </div>
</div>
<?php }else{ ?>
    <div class="row-fluid">
        <div class="span12 main-left">
            <div class="alert alert-danger alert-dismissable">
                <strong><i class="icon-remove-sign icon-large"></i> <?php echo $_smarty_tpl->tpl_vars['translate']->value['message_caption_error'];?>
</strong>:  <?php echo $_smarty_tpl->tpl_vars['translate']->value['permission_denied'];?>

            </div>
        </div>
    </div>
<?php }?>  
<?php }} ?>