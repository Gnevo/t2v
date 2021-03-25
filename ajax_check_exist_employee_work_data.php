<?php
require_once('class/setup.php');
require_once('class/dona.php');
//$smarty = new smartySetup(array('messages.xml',"forms.xml"), FALSE);
$dona = new dona();


$cid    = trim($_REQUEST['CID']);
$month  = trim($_REQUEST['month']);
$year   = trim($_REQUEST['year']);
$type   = trim($_REQUEST['type']);
$emp    = trim($_REQUEST['emp']);
$out    = array();
//if($emp != "")
//    $out=$dona->Customer_pdf_work_report($cid, $month, $year, $type, NULL, NULL, NULL, $emp, 1);
//else
//    $out=$dona->Customer_pdf_work_report($cid, $month, $year, $type, NULL, NULL, NULL, Null, 1);
if($emp != "")
    $out=$dona->summery_edit($cid, $month, $year, $type, $emp);
else
    $out=$dona->summery_edit($cid, $month, $year, $type);

if($out['tot_onCall'] == 0 && $out['tot_Normal'] == 0 && $out['tot_beredskap'] == 0)
    echo ('0');
else
    echo ('1');
//$smarty->display('ajax_get_employees_for_employee.tpl');
?>