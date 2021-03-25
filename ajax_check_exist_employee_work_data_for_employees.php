<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml',"forms.xml"), FALSE);
require_once('class/dona.php');
$dona = new dona();

$eid=$_POST['EID'];
$month=$_POST['month'];
$year=$_POST['year'];
$type=$_POST['type'];
$cust=$_POST['cust'];
//echo 'halo';
$out=array();
if($cust != "")
    $out=$dona->Customer_pdf_work_report_for_employees($eid, $month, $year, $type, $cust, 1);
else
    $out=$dona->Customer_pdf_work_report_for_employees($eid, $month, $year, $type, Null, 1);

if($out['tot_onCall']== 0 && $out['tot_Normal']== 0)
    echo ('0');
else
    echo ('1');
//$smarty->display('ajax_get_employees_for_employee.tpl');
?>