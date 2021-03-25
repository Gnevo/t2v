<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
require_once('class/dona.php');
$dona = new dona();

require_once('configs/config.inc.php');


/* this block for finding month values  */
global $month;
$month_num=array();
$month_name=array();

foreach ($month as $m_id)
{
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}

$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);

$years_combo= $dona->distinct_timetable_years();
$smarty->assign("year_option_values", $years_combo);

$all_employees = $dona->get_employee_details();
$smarty->assign("employee_details", $all_employees);
//$dona->get_Customer_team_members('');


/*echo "m: ".$_POST['cmb_month'] . "\n"; 
echo "yr: ".$_POST['cmb_year'] . "\n";
echo "fkkn: ".$_POST['type'] . "\n";
echo "emp: ".$_POST['cmb_employee'] . "\n";*/
//cmb_employee
if ($_POST['emp_id'] &&  $_POST['cmb_month'] && $_POST['cmb_year'])
{
    if($_POST['cmb_customer'])
        $dona->Customer_pdf_work_report_for_employees($_POST['emp_id'], $_POST['cmb_month'], $_POST['cmb_year'], $_POST['type'], $_POST['cmb_customer']);
    else
        $dona->Customer_pdf_work_report_for_employees($_POST['emp_id'], $_POST['cmb_month'], $_POST['cmb_year'], $_POST['type']);
}
//echo $_POST['cust_id']. $_POST['cmb_month']. $_POST['cmb_year']. $_POST['type'];
//print_r($data);
$smarty->assign('report_month', sprintf("%1d",date('m')));
$smarty->assign('report_year', date('Y'));
$smarty->display('extends:layouts/dashboard.tpl|pdf_customer_work_report_for_employees.tpl');
 
?>