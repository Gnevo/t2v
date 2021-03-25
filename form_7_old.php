<?php
error_reporting(E_ERROR);
//error_reporting(E_WARNING);
ini_set('error_reporting', E_ERROR);
ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/customer_forms.php');
require_once('class/user.php');
require_once('plugins/form_pdf.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml", "forms.xml", "messages.xml", "button.xml", "month.xml"));
$messages = new message();
$customer = new customer();
$employee = new employee();
$customer_forms = new customer_forms();
$company = new company();
$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$customer_id = ($_REQUEST['customer'] ? $_REQUEST['customer'] : '');
$smarty->assign('customerid', $customer_id);
$review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : '');
$smarty->assign('reviewid', $review_id);
$smarty->assign('created_user_name', $_SESSION['user_name']);
$company_details = $company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_details', $company_details);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_role', $_SESSION['user_role']);

$customers_datas = $customer->customer_list();
$customers = array();
foreach($customers_datas as $customer_data) {
    $customers[$customer_data['username']] = $customer_data;
}
//print_r($customers);
$smarty->assign('customers', $customers);
$employees = $employee->employee_list();
$smarty->assign('employees', $employees);
$form_datas = $customer_forms->get_form_7_customer($customer_id);
$smarty->assign('form_datas', $form_datas);
//echo '<pre>' . print_r($form_datas, 1) . '</pre>';


if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $review_data = array();
	if($review_id > 0){
	    $review_data = $customer_forms->get_form_7_by_id($review_id);
	}
    $fields = $customer_forms->form_7_fields();
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'modified_by' => $_SESSION['user_id'], 
        'utgava' => ($_POST['utgava'] != '' ? $_POST['utgava'] : 1), 
        'r' => ($_POST['r'] != '' ? $_POST['r'] : NULL), 
        's' => ($_POST['s'] != '' ? $_POST['s'] : NULL),
        'datum_for_delgivning' => ($_POST['datum_for_delgivning'] != '' ? $_POST['datum_for_delgivning'] : NULL), 
        'manad_och_ar_for_nasta_delgivning' => ($_POST['manad_och_ar_for_nasta_delgivning'] != '' ? $_POST['manad_och_ar_for_nasta_delgivning'] : NULL), 
        'narvarande_person_1' => ($_POST['narvarande_person_1'] != '' ? $_POST['narvarande_person_1'] : NULL), 
        'narvarande_person_roll_1' => ($_POST['narvarande_person_roll_1'] != '' ? $_POST['narvarande_person_roll_1'] : NULL), 
        'narvarande_person_2' => ($_POST['narvarande_person_2'] != '' ? $_POST['narvarande_person_2'] : NULL), 
        'narvarande_person_roll_2' => ($_POST['narvarande_person_roll_2'] != '' ? $_POST['narvarande_person_roll_2'] : NULL), 
        'narvarande_person_3' => ($_POST['narvarande_person_3'] != '' ? $_POST['narvarande_person_3'] : NULL), 
        'narvarande_person_roll_3' => ($_POST['narvarande_person_roll_3'] != '' ? $_POST['narvarande_person_roll_3'] : NULL)
    );
    //echo '<pre>' . print_r($form_data, 1) . '</pre>'; //exit();
    $form_fild_datas = array();
    foreach($fields as $field_id => $field) {
        $field_value = (($_POST['field_' . $field_id] != '') ? $_POST['field_' . $field_id] : NULL);
        if($field['other'] == 1) {
            $answer = $_POST['field_' . $field_id . '_other'];
        } else {
            $answer = $field_value;
        }
        $form_fild_datas[] = array(
            'field_id' => $field_id, 
            'answer' => $answer
        );
    }
    $form_data['fields'] = $form_fild_datas;

    if($review_id) {
        $review_id = $customer_forms->form_7_update($review_id, $form_data);
    } else {
        $review_id = $customer_forms->form_7_insert($form_data);
    }
    if($review_id) {
        $messages->set_message("success", 'form_7_adding_success');
    } else {
        $messages->set_message("fail", 'form_7_adding_fail');
    }
    header("Location: form_7.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    $fields = $customer_forms->form_7_fields();
    $review_data = array();
    if($review_id) {
        $review_data = $customer_forms->get_form_7_by_id($review_id);
    }
    $pdf = new PDF_form();
    $pagecount = $pdf->setSourceFile('./pdf_forms/form_7.pdf');
    $pdf->AddPage();
    $tppl = $pdf->importPage(1); 
    $pdf->useTemplate($tppl, -2, 0, 210);
    $pdf->company = $company_details['name'];
    $pdf->date = ($review_data['created_date'] != '' ? $review_data['created_date'] : date('Y-m-d'));

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(21, 30);
    $pdf->MultiCell(66, 5, utf8_decode($review_data['created_name']), 0, 'L');
    $pdf->SetXY(88, 30);
    $pdf->MultiCell(34, 5, utf8_decode($review_data['modified_name']), 0, 'L');
    $pdf->SetXY(124, 30);
    $pdf->MultiCell(26, 5, date('Y-m-d', strtotime($review_data['created_date'])), 0, 'C');
    $pdf->SetXY(152, 30);
    $pdf->MultiCell(15, 5, utf8_decode($review_data['utgava']), 0, 'C');
    if($review_data['r']) {
        $pdf->SetXY(170.5, 30);
        $pdf->Cell(5, 5, 'X', 0, 0, 'C', FALSE);
    }
    if($review_data['s']) {
        $pdf->SetXY(175.5, 30);
        $pdf->Cell(5, 5, 'X', 0, 0, 'C', FALSE);
    }


    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(69, 66);
    $pdf->Cell(120, 5, utf8_decode($review_data['customer_name']), 0, 0, 'L', FALSE);
    $pdf->SetXY(82, 76);
    $pdf->Cell(80, 5, utf8_decode($review_data['customer_century'] . ' ' . substr_replace($review_data['customer_social_security'],"-",6,0)), 0, 0, 'L', FALSE);

    $pdf->SetFont('Arial', '', 9);
    $starty = 93;
    $other = 0;
    foreach ($fields as $field_id => $field) {
        $pdf->SetY($starty);
        $pdf->SetX(22);
        $pdf->Cell(125, 5, utf8_decode($field['name']), 0, 0, 'L', FALSE);
        if($field['other']) {
            $other++;
            if($review_data['answers'][$field_id] == 1 || ($other == 2 && !is_numeric($review_data['answers'][$field_id]) && $review_data['answers'][$field_id] != '')) {
                $pdf->SetX(153.5);
                $pdf->Cell(5, 5, 'X', 0, 1, 'C', FALSE);
            } else if($review_data['answers'][$field_id] === 0 || ($other == 1 && !is_numeric($review_data['answers'][$field_id]) && $review_data['answers'][$field_id] != '')) {
                $pdf->SetX(168.5);
                $pdf->Cell(5, 5, 'X', 0, 1, 'C', FALSE);
            } else {
                $pdf->SetX(153.5);
                $pdf->Cell(5, 5, '', 0, 1, 'C', FALSE);
            }
            $pdf->SetY($pdf->GetY());
            $pdf->SetX(22);
            $pdf->Cell(125, 4, utf8_decode($review_data['answers'][$field_id]), 0, 1, 'L', FALSE);
            $starty = $pdf->GetY() + 2;
        } else {
            if($review_data['answers'][$field_id] == 1) {
                $pdf->SetX(153.5);
                $pdf->Cell(5, 5, 'X', 0, 1, 'C', FALSE);
            } else if($review_data['answers'][$field_id] === 0) {
                $pdf->SetX(168.5);
                $pdf->Cell(5, 5, 'X', 0, 1, 'C', FALSE);
            } else {
                $pdf->SetX(153.5);
                $pdf->Cell(5, 5, '', 0, 1, 'C', FALSE);
            }
            $starty = $pdf->GetY() + 1.5;
        }
    }

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(65, 139);
    $pdf->Cell(120, 5, utf8_decode($review_data['datum_for_delgivning']), 0, 0, 'L', FALSE);
    $pdf->SetXY(86, 151);
    $pdf->Cell(80, 5, utf8_decode($review_data['manad_och_ar_for_nasta_delgivning']), 0, 0, 'L', FALSE);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetY(177);
    $pdf->SetX(22);
    $pdf->Cell(50, 5, utf8_decode($review_data['narvarande_person_1']), 0, 0, 'L', FALSE);
    $pdf->SetX(75);
    $pdf->Cell(100, 5, utf8_decode($review_data['narvarande_person_roll_1']), 0, 0, 'L', FALSE);
    $pdf->SetY(184);
    $pdf->SetX(22);
    $pdf->Cell(50, 5, utf8_decode($review_data['narvarande_person_2']), 0, 0, 'L', FALSE);
    $pdf->SetX(75);
    $pdf->Cell(100, 5, utf8_decode($review_data['narvarande_person_roll_2']), 0, 0, 'L', FALSE);
    $pdf->SetY(191);
    $pdf->SetX(22);
    $pdf->Cell(50, 5, utf8_decode($review_data['narvarande_person_3']), 0, 0, 'L', FALSE);
    $pdf->SetX(75);
    $pdf->Cell(100, 5, utf8_decode($review_data['narvarande_person_roll_3']), 0, 0, 'L', FALSE);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetY(218);
    $pdf->SetX(22);
    $pdf->Cell(25, 5, date('Y-m-d'), 0, 0, 'L', FALSE);
    $pdf->SetX(52);
    $pdf->Cell(65, 5, utf8_decode($_SESSION['user_name']), 0, 0, 'L', FALSE);

    $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
    //$pdf->Output();
}

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_7_by_id($review_id);
}
$smarty->assign('review_data', $review_data);

//echo '<pre>' . print_r($review_data, 1) . '</pre>';
$fields = $customer_forms->form_7_fields();
$smarty->assign('fields', $fields);
//echo '<pre>' . print_r($fields, 1) . '</pre>'; exit();


$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|forms/form_7.tpl');
?>