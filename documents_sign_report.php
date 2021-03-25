<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
require_once('configs/config.inc.php');
require_once('plugins/message.class.php');
$obj_equipment = new equipment();
$obj_employee = new employee();
$messages      = new message();
$smarty        = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", "common.xml"));
$selected_year = date('Y');
$selected_month = date('m');
if(isset($_POST['year']) && $_POST['year']) {
    $selected_year = $_POST['year'];
}
if(isset($_POST['month']) && $_POST['month']) {
    $selected_month = $_POST['month'];
}
$flag_signed = $_POST['signed'];
$signed_documents = array();
$documents = array();
$documents = $obj_equipment->get_public_documents($selected_month, $selected_year);
$employees = $obj_equipment->get_employee_signed_document($selected_month, $selected_year);
//print_r($_SESSION);


foreach ($employees as $employee) {
    $username = $employee['username'];
    $name = ($_SESSION['company_sort_by'] == 1 ? $employee['first_name'] . ' ' . $employee['last_name'] : $employee['last_name'] . ' ' . $employee['first_name']);
    foreach ($documents as $document) {
        $document_id = $document['id'];
        if(!isset($signed_documents[$username][$document_id]['sign']) && !$flag_signed) {
            $signed_documents[$username][$document_id] = array(
                'name' => $name,
                'document' => $document['file_name'],
                'document_upload_date' => $document['date']
            );
        }
        if($document['date'] >= $employee['date_from'] && $document['date'] <= $employee['date_to']) {
            if(!isset($signed_documents[$username][$document_id]['sign'])) {
                $signed_documents[$username][$document_id] = array(
                    'name' => $name,
                    'document' => $document['file_name'],
                    'document_upload_date' => $document['date'],
                    'sign' => 1,
                    'sign_date' => $employee['date_to'] 
                );
            }
        }
    }
}

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));  
$years_combo = $obj_employee->distinct_years();
$smarty->assign("year_option_values", $years_combo);
$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);
$smarty->assign('list_year', $selected_year);
$smarty->assign("list_month", $selected_month);
$smarty->assign("flag_signed", $flag_signed);

$smarty->assign('message', $messages->show_message());
//echo "<pre>".print_r($signed_documents,1)."</pre>";exit();
$smarty->assign('signed_documents', $signed_documents);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->display('extends:layouts/dashboard.tpl|documents_sign_report.tpl');