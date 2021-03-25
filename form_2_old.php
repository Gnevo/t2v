<?php
//error_reporting(E_ERROR);
//error_reporting(E_WARNING);
//ini_set('error_reporting', E_ERROR);
//ini_set("display_errors", 1);
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
$company_details = $company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_details', $company_details);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_role', $_SESSION['user_role']); // role of employee logged in

$customers_datas = $customer->customer_list();
$customers = array();
foreach($customers_datas as $customer_data) {
    $customers[$customer_data['username']] = $customer_data;
}
//print_r($customers);
$smarty->assign('customers', $customers);
$employees_datas = $employee->employee_list();
$employees = array();
foreach($employees_datas as $employee_data) {
    $employees[$employee_data['username']] = $employee_data;
}
//print_r($employees);
$smarty->assign('employees', $employees);
$created_user_data = array();
if($_SESSION['user_role'] == 4) {
    $created_user_data = $customers[$_SESSION['user_id']];
    $smarty->assign('created_user_name', $_SESSION['user_name']);
    $smarty->assign('created_user_data', $customers[$_SESSION['user_id']]);
} else {
    $created_user_data = $employees[$_SESSION['user_id']];
    $smarty->assign('created_user_name', $_SESSION['user_name']);
    $smarty->assign('created_user_data', $employees[$_SESSION['user_id']]);
}
if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $questions = $_POST['questions'];
    $answers = array();
    foreach ($questions as $question) {
        $answers[] = ($_POST['question_' . $question] != '' ? $_POST['question_' . $question] : NULL);
    }
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'version' => ($_POST['version'] ? $_POST['version'] : 1),
        'check_r' => ($_POST['check_r'] == 1 ? $_POST['check_r'] : 0), 
        'check_s' => ($_POST['check_s'] == 1 ? $_POST['check_s'] : 0),   
        'questions' => $questions,
        'answers' => $answers,
        'field_description' => ($_POST['field_description'] != '' ? $_POST['field_description'] : NULL),
    );
    $review_id = $customer_forms->form_2_insert($form_data);
    if($review_id) {
        $messages->set_message("success", 'form_2_adding_success');
    } else {
        $messages->set_message("fail", 'form_2_adding_fail');
    }
    header("Location: form_2.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf' && $_POST['review'] != '' && $_POST['customer'] != '') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    if($review_id) {
        $review_data = $customer_forms->get_form_2_by_id($review_id);
        $form_questions = $customer_forms->get_form_2_questions();
        if(!empty($review_data)) {
            $pdf = new PDF_form();
            $pdf->AddPage();
            //drowing header
            $pdf->Line(12, 15 , 198, 15);
            $pdf->Line(12, 15 , 12, 30);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(15, 17);
            $pdf->Cell(90, 4, utf8_decode('Dokumentnamn:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(15, 24);
            $pdf->Cell(90, 4, utf8_decode('Kundenkät nr 2'), 0, 0, 'L', FALSE);
            $pdf->Line(105, 15 , 105, 30);
            //logo
            if($company_details['logo']) {
                $pdf->Image('./company_logo/' . $company_details['logo'], 160, 17, 30, 10);
            }
            $pdf->Line(12, 30 , 198, 30);
            $pdf->Line(198, 15 , 198, 30);

            $pdf->Line(12, 30 , 12, 50);
            $pdf->Line(198, 30 , 198, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(15, 32);
            $pdf->Cell(50, 4, utf8_decode('Skapad av:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(15, 37);
            $pdf->MultiCell(50, 3.5, utf8_decode($company_details['name']), 0, 'L');
            $pdf->Line(65, 30 , 65, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(65, 32);
            $pdf->Cell(50, 4, utf8_decode('Ändrad av:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(65, 37);
            $pdf->MultiCell(50, 3.5, utf8_decode($review_data['created_name']), 0, 'L');
            $pdf->Line(115, 30 , 115, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(115, 32);
            $pdf->Cell(30, 4, utf8_decode('Datum:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(115, 37);
            $pdf->Cell(30, 4, date('Y-m-d', strtotime($review_data['created_date'])), 0, 0, 'L', FALSE);
            $pdf->Line(145, 30 , 145, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(145, 32);
            $pdf->Cell(30, 4, utf8_decode('Utgåva:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(145, 37);
            $pdf->Cell(30, 4, utf8_decode($review_data['version']), 0, 0, 'L', FALSE);
            $pdf->Line(175, 30 , 175, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(178, 32);
            $pdf->Cell(5, 4, utf8_decode('R'), 0, 0, 'L', FALSE);
            $pdf->SetXY(188, 32);
            $pdf->Cell(5, 4, utf8_decode('S'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            if($review_data['check_r'] == 1) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(178, 37);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }
            if($review_data['check_s'] == 1) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(188, 37);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }
            $pdf->Line(12, 50 , 198, 50);
            //printing Data for page 1

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(12, 55);
            $pdf->MultiCell(186, 6, utf8_decode('Vi strävar efter att leverera bästa möjliga personliga assistans med en hög kvalitetsnivå. Nedan följer ett antal frågor med betygsättning 1-6 där 1 är sämst och 6 är bäst.'), 0, 'L');
            $pdf->SetXY(12, 70);
            $pdf->MultiCell(186, 6, utf8_decode('Kryssa för det betyg som du tycker stämmer med det du har upplevt som kund hos oss på'), 0, 'L');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(12, 76);
            $pdf->MultiCell(186, 6, utf8_decode($company_details['name']. '.'), 0, 'L');

            $pdf->SetLineWidth(0.8);
            $pdf->Line(12, 90 , 198, 90);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(12, 92);
            $pdf->Cell(125, 6, utf8_decode(' '), 0, 0, 'L', FALSE);
            $pdf->SetXY(141, 92);
            $pdf->Cell(5, 6, utf8_decode('1'), 0, 0, 'L', FALSE);
            $pdf->SetXY(151, 92);
            $pdf->Cell(5, 6, utf8_decode('2'), 0, 0, 'L', FALSE);
            $pdf->SetXY(161, 92);
            $pdf->Cell(5, 6, utf8_decode('3'), 0, 0, 'L', FALSE);
            $pdf->SetXY(171, 92);
            $pdf->Cell(5, 6, utf8_decode('4'), 0, 0, 'L', FALSE);
            $pdf->SetXY(181, 92);
            $pdf->Cell(5, 6, utf8_decode('5'), 0, 0, 'L', FALSE);
            $pdf->SetXY(191, 92);
            $pdf->Cell(5, 6, utf8_decode('6'), 0, 1, 'L', FALSE);
            $pdf->SetLineWidth(0.2);
            $pdf->Line(12, 90, 12, $pdf->GetY());
            $pdf->Line(138, 90, 138, $pdf->GetY());
            $pdf->Line(148, 90, 148, $pdf->GetY());
            $pdf->Line(158, 90, 158, $pdf->GetY());
            $pdf->Line(168, 90, 168, $pdf->GetY());
            $pdf->Line(178, 90, 178, $pdf->GetY());
            $pdf->Line(188, 90, 188, $pdf->GetY());
            $pdf->Line(198, 90, 198, $pdf->GetY());
            $starty = $pdf->GetY();
            //Fileds
            $i = 1;
            foreach ($form_questions as $question_id=>$question) {
                $starty = displayField($pdf, $starty, $i, $question['question'], $review_data['answers'][$question_id]);
                $i++;
            }
            $pdf->Line(12, $starty , 198, $starty);

            $pdf->AddPage();
            
            //drowing header
            $pdf->Line(12, 15 , 198, 15);
            $pdf->Line(12, 15 , 12, 30);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(15, 17);
            $pdf->Cell(90, 4, utf8_decode('Dokumentnamn:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(15, 24);
            $pdf->Cell(90, 4, utf8_decode('Kundenkät nr 2'), 0, 0, 'L', FALSE);
            $pdf->Line(105, 15 , 105, 30);
            //logo
            if($company_details['logo']) {
                $pdf->Image('./company_logo/' . $company_details['logo'], 160, 17, 30, 10);
            }
            $pdf->Line(12, 30 , 198, 30);
            $pdf->Line(198, 15 , 198, 30);

            $pdf->Line(12, 30 , 12, 50);
            $pdf->Line(198, 30 , 198, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(15, 32);
            $pdf->Cell(50, 4, utf8_decode('Skapad av:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(15, 37);
            $pdf->MultiCell(50, 3.5, utf8_decode($company_details['name']), 0, 'L');
            $pdf->Line(65, 30 , 65, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(65, 32);
            $pdf->Cell(50, 4, utf8_decode('Ändrad av:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(65, 37);
            $pdf->MultiCell(50, 3.5, utf8_decode($review_data['created_name']), 0, 'L');
            $pdf->Line(115, 30 , 115, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(115, 32);
            $pdf->Cell(30, 4, utf8_decode('Datum:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(115, 37);
            $pdf->Cell(30, 4, date('Y-m-d', strtotime($review_data['created_date'])), 0, 0, 'L', FALSE);
            $pdf->Line(145, 30 , 145, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(145, 32);
            $pdf->Cell(30, 4, utf8_decode('Utgåva:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(145, 37);
            $pdf->Cell(30, 4, utf8_decode($review_data['version']), 0, 0, 'L', FALSE);
            $pdf->Line(175, 30 , 175, 50);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(178, 32);
            $pdf->Cell(5, 4, utf8_decode('R'), 0, 0, 'L', FALSE);
            $pdf->SetXY(188, 32);
            $pdf->Cell(5, 4, utf8_decode('S'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            if($review_data['check_r'] == 1) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(178, 37);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }
            if($review_data['check_s'] == 1) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(188, 37);
                $pdf->Cell(5, 4, utf8_decode('X'), 0, 0, 'L', FALSE);
            }
            $pdf->Line(12, 50 , 198, 50);
            
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(12, 55);
            $pdf->Cell(50, 4, utf8_decode('Övriga synpunkter:'), 0, 0, 'L', FALSE);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(12, 60);
            $pdf->MultiCell(186, 3.5, utf8_decode($review_data['field_description']), 0, 'L');

            $lasty = ($pdf->GetY() + 20);

            $pdf->SetFont('Arial', '', 10);
            $pdf->setY($lasty);
            $pdf->SetX(12);
            $pdf->Cell(30, 8, utf8_decode('Personnummer:'), 0, 0, 'L', FALSE);
            $pdf->SetX(42);
            $pdf->Cell(155, 8, utf8_decode($employees[$review_data['created_by']]['century'] . $employees[$review_data['created_by']]['social_security']), 0, 1, 'L', FALSE);
            $lasty = $pdf->GetY();

            $pdf->setY($lasty);
            $pdf->SetX(12);
            $pdf->Cell(15, 8, utf8_decode('Namn:'), 0, 0, 'L', FALSE);
            $pdf->SetX(28);
            $pdf->Cell(170, 8, utf8_decode(($_SESSION['company_sort_by'] == 1 ? $employees[$review_data['created_by']]['first_name'] . ' ' . $employees[$review_data['created_by']]['last_name'] : $employees[$review_data['created_by']]['last_name'] . ' ' . $employees[$review_data['created_by']]['first_name'])), 0, 1, 'L', FALSE);

            $pdf->SetFont('Arial', 'B', 12);
            $lasty = ($pdf->GetY() + 20);
            $pdf->setY($lasty);
            $pdf->SetX(12);
            $pdf->Cell(180, 10, utf8_decode('Tack för din medverkan!'), 0, 0, 'L', FALSE);
            $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
            //$pdf->Output();
        }
    }
}

$form_datas = $customer_forms->get_form_2();
$smarty->assign('form_datas', $form_datas);
$form_questions = $customer_forms->get_form_2_questions();
$smarty->assign('form_questions', $form_questions);

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_2_by_id($review_id);
}
$smarty->assign('review_data', $review_data);
//print_r($review_data);

$smarty->assign('message', $messages->show_message());
if($_REQUEST['action'] == 'save' || $_REQUEST['action'] == 'pdf') {
    $smarty->display('extends:layouts/dashboard.tpl|forms/form_2.tpl');
} else {
    $smarty->display('forms/form_2.tpl');
}

function displayField($pdf, $starty, $sl = '', $text = '', $value = '') {
    $pdf->SetLineWidth(0.2);
    $pdf->Line(12, $starty , 198, $starty);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(12, $starty);
    $pdf->MultiCell(125, 10, utf8_decode($sl . '. ' . $text), 0, 'L');
    $finaly = $pdf->GetY();
    $pdf->SetY($starty);
    switch ($value) {
        case '1':
                $pdf->SetX(141);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        case '2':
                $pdf->SetX(151);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        case '3':
                $pdf->SetX(161);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        case '4':
                $pdf->SetX(171);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        case '5':
                $pdf->SetX(181);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        case '6':
                $pdf->SetX(191);
                $pdf->Cell(5, 10, utf8_decode('X'), 0, 0, 'L', FALSE);
            break;
        default:

            break;
    }
    $pdf->Line(12, $starty, 12, $finaly);
    $pdf->Line(138, $starty, 138, $finaly);
    $pdf->Line(148, $starty, 148, $finaly);
    $pdf->Line(158, $starty, 158, $finaly);
    $pdf->Line(168, $starty, 168, $finaly);
    $pdf->Line(178, $starty, 178, $finaly);
    $pdf->Line(188, $starty, 188, $finaly);
    $pdf->Line(198, $starty, 198, $finaly);
    return $finaly;
}
?>