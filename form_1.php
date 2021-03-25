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
if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'version' => ($_POST['version'] ? $_POST['version'] : 1),
        'check_r' => ($_POST['check_r'] == 1 ? $_POST['check_r'] : 0), 
        'check_s' => ($_POST['check_s'] == 1 ? $_POST['check_s'] : 0), 
        'review_employee' => ($_POST['review_employee'] ? $_POST['review_employee'] : NULL),  
        'review_date' => (strtotime($_POST['review_date']) ? date('Y-m-d', strtotime($_POST['review_date'])) : NULL),  
        'review_next_date' => (strtotime($_POST['review_next_date']) ? date('Y-m-d', strtotime($_POST['review_next_date'])) : NULL),  
        'field_1_1_radio' => ($_POST['field_r_1_1'] != '' ? $_POST['field_r_1_1'] : NULL),  
        'field_1_1_val' => ($_POST['field_1_1'] ? $_POST['field_1_1'] : NULL),  
        'field_1_2_radio' => ($_POST['field_r_1_2'] != '' ? $_POST['field_r_1_2'] : NULL),  
        'field_1_2_val' => ($_POST['field_1_2'] ? $_POST['field_1_2'] : NULL),  
        'field_1_3_radio' => ($_POST['field_r_1_3'] != '' ? $_POST['field_r_1_3'] : NULL),  
        'field_1_3_val' => ($_POST['field_1_3'] ? $_POST['field_1_3'] : NULL),  
        'field_1_4_radio' => ($_POST['field_r_1_4'] != '' ? $_POST['field_r_1_4'] : NULL),  
        'field_1_4_val' => ($_POST['field_1_4'] ? $_POST['field_1_4'] : NULL),  
        'field_1_5_radio' => ($_POST['field_r_1_5'] != '' ? $_POST['field_r_1_5'] : NULL),  
        'field_1_5_val' => ($_POST['field_1_5'] ? $_POST['field_1_5'] : NULL),  
        'field_1_6_radio' => ($_POST['field_r_1_6'] != '' ? $_POST['field_r_1_6'] : NULL),  
        'field_1_6_val' => ($_POST['field_1_6'] ? $_POST['field_1_6'] : NULL),  
        'field_1_7_radio' => ($_POST['field_r_1_7'] != '' ? $_POST['field_r_1_7'] : NULL),  
        'field_1_7_val' => ($_POST['field_1_7'] ? $_POST['field_1_7'] : NULL),  
        'field_1_8_radio' => ($_POST['field_r_1_8'] != '' ? $_POST['field_r_1_8'] : NULL),  
        'field_1_8_val' => ($_POST['field_1_8'] ? $_POST['field_1_8'] : NULL),  
        'field_1_9_radio' => ($_POST['field_r_1_9'] != '' ? $_POST['field_r_1_9'] : NULL),  
        'field_1_9_val' => ($_POST['field_1_9'] ? $_POST['field_1_9'] : NULL),  
        'field_1_10_radio' => ($_POST['field_r_1_10'] != '' ? $_POST['field_r_1_10'] : NULL),  
        'field_1_10_val' => ($_POST['field_1_10'] ? $_POST['field_1_10'] : NULL),  
        'field_2_1_radio' => ($_POST['field_r_2_1'] != '' ? $_POST['field_r_2_1'] : NULL),  
        'field_2_1_val' => ($_POST['field_2_1'] ? $_POST['field_2_1'] : NULL),  
        'field_2_2_radio' => ($_POST['field_r_2_2'] != '' ? $_POST['field_r_2_2'] : NULL),  
        'field_2_2_val' => ($_POST['field_2_2'] ? $_POST['field_2_2'] : NULL),  
        'field_2_3_radio' => ($_POST['field_r_2_3'] != '' ? $_POST['field_r_2_3'] : NULL),  
        'field_2_3_val' => ($_POST['field_2_3'] ? $_POST['field_2_3'] : NULL),  
        'field_2_4_radio' => ($_POST['field_r_2_4'] != '' ? $_POST['field_r_2_4'] : NULL),  
        'field_2_4_val' => ($_POST['field_2_4'] ? $_POST['field_2_4'] : NULL),  
        'field_2_5_radio' => ($_POST['field_r_2_5'] != '' ? $_POST['field_r_2_5'] : NULL),  
        'field_2_5_val' => ($_POST['field_2_5'] ? $_POST['field_2_5'] : NULL),  
        'field_3_1_radio' => ($_POST['field_r_3_1'] != '' ? $_POST['field_r_3_1'] : NULL),  
        'field_3_1_val' => ($_POST['field_3_1'] ? $_POST['field_3_1'] : NULL),  
        'field_3_2_radio' => ($_POST['field_r_3_2'] != '' ? $_POST['field_r_3_2'] : NULL),  
        'field_3_2_val' => ($_POST['field_3_2'] ? $_POST['field_3_2'] : NULL),  
        'field_4_1_radio' => ($_POST['field_r_4_1'] != '' ? $_POST['field_r_4_1'] : NULL),  
        'field_4_1_val' => ($_POST['field_4_1'] ? $_POST['field_4_1'] : NULL),  
        'field_4_2_radio' => ($_POST['field_r_4_2'] != '' ? $_POST['field_r_4_2'] : NULL),  
        'field_4_2_val' => ($_POST['field_4_2'] ? $_POST['field_4_2'] : NULL),  
        'field_4_3_radio' => ($_POST['field_r_4_3'] != '' ? $_POST['field_r_4_3'] : NULL),  
        'field_4_3_val' => ($_POST['field_4_3'] ? $_POST['field_4_3'] : NULL),  
        'field_5_1_radio' => ($_POST['field_r_5_1'] != '' ? $_POST['field_r_5_1'] : NULL),  
        'field_5_1_val' => ($_POST['field_5_1'] ? $_POST['field_5_1'] : NULL),  
        'field_5_2_radio' => ($_POST['field_r_5_2'] != '' ? $_POST['field_r_5_2'] : NULL),  
        'field_5_2_val' => ($_POST['field_5_2'] ? $_POST['field_5_2'] : NULL),  
        'field_5_3_radio' => ($_POST['field_r_5_3'] != '' ? $_POST['field_r_5_3'] : NULL),  
        'field_5_3_val' => ($_POST['field_5_3'] ? $_POST['field_5_3'] : NULL),  
        'field_5_4_radio' => ($_POST['field_r_5_4'] != '' ? $_POST['field_r_5_4'] : NULL),  
        'field_5_4_val' => ($_POST['field_5_4'] ? $_POST['field_5_4'] : NULL),  
        'field_6_1_radio' => ($_POST['field_r_6_1'] != '' ? $_POST['field_r_6_1'] : NULL),  
        'field_6_1_val' => ($_POST['field_6_1'] ? $_POST['field_6_1'] : NULL),  
        'field_6_2_radio' => ($_POST['field_r_6_2'] != '' ? $_POST['field_r_6_2'] : NULL),  
        'field_6_2_val' => ($_POST['field_6_2'] ? $_POST['field_6_2'] : NULL),  
        'field_6_3_radio' => ($_POST['field_r_6_3'] != '' ? $_POST['field_r_6_3'] : NULL),  
        'field_6_3_val' => ($_POST['field_6_3'] ? $_POST['field_6_3'] : NULL)
    );
    if($review_id) {
        $review_id = $customer_forms->form_1_update($review_id, $form_data);
    } else {
        $review_id = $customer_forms->form_1_insert($form_data);
    }
    if($review_id) {
        $messages->set_message("success", 'form_1_adding_success');
    } else {
        $messages->set_message("fail", 'form_1_adding_fail');
    }
    header("Location: form_1.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf' && $_POST['review'] != '' && $_POST['customer'] != '') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    if($review_id) {
        $review_data = $customer_forms->get_form_1_by_id($review_id);
        if(!empty($review_data)) {
            $pdf = new PDF_form();
            $pagecount = $pdf->setSourceFile('./pdf_forms/form_1.pdf');
            $pdf->AddPage();
            $tppl = $pdf->importPage(1); 
            $pdf->useTemplate($tppl, -2, 0, 210);

            //printing Data for page 1
            //logo
            if($company_details['logo']) {
                $pdf->Image('./company_logo/' . $company_details['logo'], 160, 32, 30, 10);
            }
            //customer name
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(56, 34);
            $pdf->Cell(130, 4, utf8_decode($company_details['name']), 0, 0, 'L', FALSE);
            //reviewed by name
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(54, 37.7);
            $pdf->Cell(80, 4, utf8_decode($review_data['created_name']), 0, 0, 'L', FALSE);
            //created date
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(52, 40.8);
            $pdf->Cell(40, 4, date('Y-m-d', strtotime($review_data['created_date'])), 0, 0, 'L', FALSE);

            //version
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(100, 40.8);
            $pdf->Cell(10, 4, utf8_decode($review_data['version']), 0, 0, 'L', FALSE);

            //check box r
            if($review_data['check_r'] == 1) {
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->SetXY(108.5, 40.8);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }
            //check box s
            if($review_data['check_s'] == 1) {
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->SetXY(112.5, 40.8);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }

            //customer name
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(89, 57.5);
            $pdf->Cell(100, 4, utf8_decode($review_data['customer_name']), 0, 0, 'L', FALSE);

            //customer social security 
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(89, 65.5);
            $pdf->Cell(100, 4, utf8_decode($review_data['customer_century'] . $review_data['customer_social_security']), 0, 0, 'L', FALSE);

            //customer address
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(89, 73);
            $pdf->Cell(100, 4, utf8_decode($review_data['customer_address']), 0, 0, 'L', FALSE);

            //review employee name
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(72, 81);
            $pdf->Cell(100, 4, utf8_decode($review_data['review_name']), 0, 0, 'L', FALSE);

            //review date
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(65, 88.5);
            $pdf->Cell(20, 4, utf8_decode($review_data['review_date']), 0, 0, 'L', FALSE);

            //review date
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(132, 88.5);
            $pdf->Cell(20, 4, utf8_decode($review_data['review_next_date']), 0, 0, 'L', FALSE);

            //Filed data 1.1
            displayField($pdf, $review_data['field_1_1_radio'], $review_data['field_1_1_val'], 120);

            //Filed data 1.2
            displayField($pdf, $review_data['field_1_2_radio'], $review_data['field_1_2_val'], 138);

            //Filed data 1.3
            displayField($pdf, $review_data['field_1_3_radio'], $review_data['field_1_3_val'], 152);

            //Filed data 1.4
            displayField($pdf, $review_data['field_1_4_radio'], $review_data['field_1_4_val'], 166);

            //Filed data 1.5
            displayField($pdf, $review_data['field_1_5_radio'], $review_data['field_1_5_val'], 180);

            //Filed data 1.6
            displayField($pdf, $review_data['field_1_6_radio'], $review_data['field_1_6_val'], 194);

            //Filed data 1.7
            displayField($pdf, $review_data['field_1_7_radio'], $review_data['field_1_7_val'], 208);

            //Filed data 1.8
            displayField($pdf, $review_data['field_1_8_radio'], $review_data['field_1_8_val'], 222);

            //Filed data 1.9
            displayField($pdf, $review_data['field_1_9_radio'], $review_data['field_1_9_val'], 237);

            //Filed data 1.10
            displayField($pdf, $review_data['field_1_10_radio'], $review_data['field_1_10_val'], 254);


            $pdf->AddPage();
            $tppl = $pdf->importPage(2); 
            $pdf->useTemplate($tppl, -2, 0, 210);

            //Filed data 2.1
            displayField($pdf, $review_data['field_2_1_radio'], $review_data['field_2_1_val'], 46);

            //Filed data 2.2
            displayField($pdf, $review_data['field_2_2_radio'], $review_data['field_2_2_val'], 64);

            //Filed data 2.3
            displayField($pdf, $review_data['field_2_3_radio'], $review_data['field_2_3_val'], 82);

            //Filed data 2.4
            displayField($pdf, $review_data['field_2_4_radio'], $review_data['field_2_4_val'], 97);

            //Filed data 2.5
            displayField($pdf, $review_data['field_2_5_radio'], $review_data['field_2_5_val'], 111);


            //Filed data 3.1
            displayField($pdf, $review_data['field_3_1_radio'], $review_data['field_3_1_val'], 144);

            //Filed data 3.2
            displayField($pdf, $review_data['field_3_2_radio'], $review_data['field_3_2_val'], 158);



            //Filed data 4.1
            displayField($pdf, $review_data['field_4_1_radio'], $review_data['field_4_1_val'], 191);

            //Filed data 4.2
            displayField($pdf, $review_data['field_4_2_radio'], $review_data['field_4_2_val'], 205);

            //Filed data 4.3
            displayField($pdf, $review_data['field_4_3_radio'], $review_data['field_4_3_val'], 219);


            $pdf->AddPage();
            $tppl = $pdf->importPage(3); 
            $pdf->useTemplate($tppl, -2, 0, 210);

            //Filed data 5.1
            displayField($pdf, $review_data['field_5_1_radio'], $review_data['field_5_1_val'], 42);

            //Filed data 5.2
            displayField($pdf, $review_data['field_5_2_radio'], $review_data['field_5_2_val'], 56);

            //Filed data 5.3
            displayField($pdf, $review_data['field_5_3_radio'], $review_data['field_5_3_val'], 70);

            //Filed data 5.4
            displayField($pdf, $review_data['field_5_4_radio'], $review_data['field_5_4_val'], 84);


            //Filed data 6.1
            displayField($pdf, $review_data['field_6_1_radio'], $review_data['field_6_1_val'], 118);

            //Filed data 6.2
            displayField($pdf, $review_data['field_6_2_radio'], $review_data['field_6_2_val'], 132);

            //Filed data 6.3
            displayField($pdf, $review_data['field_6_3_radio'], $review_data['field_6_3_val'], 150);

            $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
            //$pdf->Output();
        }
    }
}
$customers_datas = $customer->customer_list();
$customers = array();
foreach($customers_datas as $customer_data) {
    $customers[$customer_data['username']] = $customer_data;
}
//print_r($customers);
$smarty->assign('customers', $customers);
$employees = $employee->employee_list();
$smarty->assign('employees', $employees);
$form_datas = $customer_forms->get_form_1();
$smarty->assign('form_datas', $form_datas);

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_1_by_id($review_id);
}
$smarty->assign('review_data', $review_data);
//print_r($company_details);

$smarty->assign('message', $messages->show_message());
if($_REQUEST['action'] == 'save' || $_REQUEST['action'] == 'pdf') {
    $smarty->display('extends:layouts/dashboard.tpl|forms/form_1.tpl');
} else {
    $smarty->display('forms/form_1.tpl');
}

function displayField($pdf, $radio = '', $value = '', $y) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetXY(44, $y);
    if($radio == 1) {
        $pdf->Cell(7, 4, 'Ja', 0, 0, 'L', FALSE);
    } else if($radio != 1 && $radio != ''){
        $pdf->Cell(7, 4, 'Nej', 0, 0, 'L', FALSE);
    }
    $strlen = strlen($value);
    $lines = ceil($strlen/85);
    if($lines == 1) {
        $pdf->SetXY(58, $y);
    } else if($lines == 2) {
        $pdf->SetXY(58, ($y - 1));
    } else if($lines == 3) {
        $pdf->SetXY(58, ($y - 1.5));
    }
    $pdf->MultiCell(135, 3.5, utf8_decode($value), 0, 'L');
}
?>