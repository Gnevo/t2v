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
$form_datas = $customer_forms->get_form_6_customer($customer_id);
$smarty->assign('form_datas', $form_datas);
//echo '<pre>' . print_r($form_datas, 1) . '</pre>';


if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $review_data = array();
	if($review_id > 0){
	    $review_data = $customer_forms->get_form_6_by_id($review_id);
	}
    $fields = $customer_forms->form_6_fields();
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'ett_allvarligt_missforhallande' => ($_POST['ett_allvarligt_missforhallande'] != '' ? $_POST['ett_allvarligt_missforhallande'] : NULL), 
        'en_pataglig_risk_for_ett_allvarligt_missforhallande' => ($_POST['en_pataglig_risk_for_ett_allvarligt_missforhallande'] != '' ? $_POST['en_pataglig_risk_for_ett_allvarligt_missforhallande'] : NULL), 
        'avsandarens_diarienummer' => ($_POST['avsandarens_diarienummer'] != '' ? $_POST['avsandarens_diarienummer'] : NULL)
    );
    //echo '<pre>' . print_r($form_data, 1) . '</pre>'; //exit();
    $form_fild_datas = array();
    foreach($fields as $field_id => $field) {
        $field_value = (($_POST['field_' . $field_id] != '') ? $_POST['field_' . $field_id] : NULL);
        if($field_value > count($field['options']) && $field['type'] == 4) {
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
        $review_id = $customer_forms->form_6_update($review_id, $form_data);
    } else {
        $review_id = $customer_forms->form_6_insert($form_data);
    }
    if($review_id) {
        $messages->set_message("success", 'form_6_adding_success');
    } else {
        $messages->set_message("fail", 'form_6_adding_fail');
    }
    header("Location: form_6.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    $fields = $customer_forms->form_6_fields();
    $review_data = array();
    if($review_id) {
        $review_data = $customer_forms->get_form_6_by_id($review_id);
    }
    $pdf = new PDF_form();
    $pagecount = $pdf->setSourceFile('./pdf_forms/form_6.pdf');
    $pdf->AddPage();
    $tppl = $pdf->importPage(1); 
    $pdf->useTemplate($tppl, -2, 0, 210);
    $pdf->company = $company_details['name'];
    $pdf->date = ($review_data['created_date'] != '' ? $review_data['created_date'] : date('Y-m-d'));
    if($company_details['logo']) {
        $pdf->Image('./company_logo/' . $company_details['logo'], 15, 10, 60, 20);
    }

    $pdf->SetFont('Arial', '', 8);
    if($review_data['ett_allvarligt_missforhallande']) {
        $pdf->SetXY(119, 28);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }
    if($review_data['en_pataglig_risk_for_ett_allvarligt_missforhallande']) {
        $pdf->SetXY(119, 33);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(15, 45);
    $pdf->Cell(100, 4, utf8_decode($review_data['avsandarens_diarienummer']), 0, 0, 'L', FALSE);

    if($review_data['answers'][$fields[1]['id']]) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(14, 87);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(20, 87);
    $pdf->Cell(180, 4, utf8_decode($fields[2]['name'] . '  ' . $review_data['answers'][$fields[2]['id']] . '  i  ' . $review_data['answers'][$fields[3]['id']] . '   ' . $fields[3]['name']), 0, 0, 'L', FALSE);

    if($review_data['answers'][$fields[4]['id']]) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(14, 97);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(20, 97);
    $pdf->Cell(180, 4, utf8_decode($fields[5]['name'] . '  ' . $review_data['answers'][$fields[5]['id']] . '  (namnet på t.ex. bolaget, stiftelsen)'), 0, 0, 'L', FALSE);

    if($review_data['answers'][$fields[6]['id']]) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(14, 106);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(20, 106);
    $pdf->Cell(180, 4, utf8_decode($fields[6]['name']), 0, 0, 'L', FALSE);
    $starty = 118;
    for($i = 7; $i <= 14; $i++) {
        if($i%2) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetY($starty);
            $pdf->SetX(14);
            $pdf->Cell(73, 4, utf8_decode($fields[$i]['name']), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetY($starty + 4);
            $pdf->SetX(14);
            $pdf->Cell(73, 4, utf8_decode($review_data['answers'][$fields[$i]['id']]), 0, 1, 'L', FALSE);
        } else {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetY($starty);
            $pdf->SetX(87);
            $pdf->Cell(110, 4, utf8_decode($fields[$i]['name']), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetY($starty + 4);
            $pdf->SetX(87);
            $pdf->Cell(110, 4, utf8_decode($review_data['answers'][$fields[$i]['id']]), 0, 1, 'L', FALSE);
            $starty = $pdf->GetY()+1.5;
        }
    }

    $starty = 169;
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($fields[15]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($review_data['answers'][$fields[15]['id']]), 0, 0, 'L', FALSE);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(87);
    $pdf->Cell(73, 4, utf8_decode($fields[16]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(87);
    $pdf->Cell(110, 4, utf8_decode($review_data['answers'][$fields[16]['id']]), 0, 1, 'L', FALSE);
    $starty = $pdf->GetY() + 1.5;

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($fields[17]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($review_data['answers'][$fields[17]['id']]), 0, 1, 'L', FALSE);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(87);
    $pdf->Cell(44, 4, utf8_decode($fields[18]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(87);
    $pdf->Cell(44, 4, utf8_decode($review_data['answers'][$fields[18]['id']]), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(132);
    $pdf->Cell(65, 4, utf8_decode($fields[19]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(132);
    $pdf->Cell(65, 4, utf8_decode($review_data['answers'][$fields[19]['id']]), 0, 1, 'L', FALSE);
    $starty = $pdf->GetY() + 1.5;

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($fields[20]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(14);
    $pdf->Cell(73, 4, utf8_decode($review_data['answers'][$fields[20]['id']]), 0, 1, 'L', FALSE);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetY($starty);
    $pdf->SetX(87);
    $pdf->Cell(110, 4, utf8_decode($fields[21]['name']), 0, 0, 'L', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($starty + 4);
    $pdf->SetX(87);
    $pdf->Cell(110, 4, utf8_decode($review_data['answers'][$fields[21]['id']]), 0, 0, 'L', FALSE);


    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(14, 205);
    $pdf->MultiCell(185, 4, utf8_decode($fields[22]['name']), 0, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(14, 215);
    $pdf->MultiCell(185, 4, utf8_decode($review_data['answers'][$fields[22]['id']]), 0, 'L');

    if($review_data['answers'][$fields[23]['id']]) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(13, 273);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(19, 273);
    $pdf->MultiCell(185, 4, utf8_decode($fields[23]['name']), 0, 'L');


    $pdf->AddPage();
    $tppl = $pdf->importPage(2); 
    $pdf->useTemplate($tppl, -2, 0, 210);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(15, 15);
    $pdf->Cell(180, 4, utf8_decode($fields[24]['name']), 0, 0, 'L', FALSE);

    $pdf->SetFont('Arial', '', 10);
    $starty = 29;
    foreach ($fields[24]['options'] as $key => $option) {
        if($review_data['answers'][$fields[24]['id']] == ($key + 1)) {
            $pdf->SetXY(17.5, $starty);
            $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
        }
        $pdf->SetXY(22, $starty);
        $pdf->Cell(170, 4, $option, 0, 1, 'L', FALSE);
        $starty = $pdf->GetY() + 2.5;
    }
    if(!is_numeric($review_data['answers'][$fields[24]['id']]) && $review_data['answers'][$fields[24]['id']] != '') {
        $pdf->SetXY(17.5, $starty);
        $pdf->Cell(5, 4, 'X', 0, 0, 'C', FALSE);
        $pdf->SetXY(35, $starty);
        $pdf->Cell(170, 4, utf8_decode($review_data['answers'][$fields[24]['id']]), 0, 1, 'L', FALSE);
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(14, 63);
    $pdf->MultiCell(185, 4, utf8_decode($fields[25]['name']), 0, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(15, 70);
    $pdf->MultiCell(185, 4, utf8_decode($review_data['answers'][$fields[25]['id']]), 0, 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(14, 130);
    $pdf->MultiCell(185, 4, utf8_decode($fields[26]['name']), 0, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(15, 140);
    $pdf->MultiCell(185, 4, utf8_decode($review_data['answers'][$fields[26]['id']]), 0, 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(14, 197);
    $pdf->MultiCell(185, 4, utf8_decode($fields[27]['name']), 0, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(15, 207);
    $pdf->MultiCell(185, 4, utf8_decode($review_data['answers'][$fields[27]['id']]), 0, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(15, 270);
    $pdf->Cell(25, 4, date('Y-m-d', strtotime($review_data['created_date'])), 0, 0, 'L', FALSE);

    $pdf->SetXY(119, 270);
    $pdf->Cell(80, 4, utf8_decode($review_data['created_name']), 0, 0, 'L', FALSE);

    $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
    //$pdf->Output();
}

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_6_by_id($review_id);
}
$smarty->assign('review_data', $review_data);

//echo '<pre>' . print_r($review_data, 1) . '</pre>';
$fields = $customer_forms->form_6_fields();
$smarty->assign('fields', $fields);
//echo '<pre>' . print_r($fields, 1) . '</pre>'; exit();


$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|forms/form_6.tpl');
?>