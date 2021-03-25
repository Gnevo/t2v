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
$form_datas = $customer_forms->get_form_5_customer($customer_id);
$smarty->assign('form_datas', $form_datas);
//echo '<pre>' . print_r($form_datas, 1) . '</pre>';


if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $review_data = array();
	if($review_id > 0){
	    $review_data = $customer_forms->get_form_5_by_id($review_id);
	}
    $field_groups = $customer_forms->form_5_fields();
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'deviation_date' => ($_POST['deviation_date'] != '' ? date('Y-m-d', strtotime($_POST['deviation_date'])) : NULL), 
        'deviation_time' => ($_POST['deviation_time'] != '' ? $_POST['deviation_time'] : NULL), 
        'error_from' => ($_POST['error_from'] != '' ? $_POST['error_from'] : NULL), 
        'error_to' => ($_POST['error_to'] != '' ? $_POST['error_to'] : NULL), 
        'where_did_deviation' => ($_POST['where_did_deviation'] != '' ? $_POST['where_did_deviation'] : NULL), 
        'main_diagnosis' => ($_POST['main_diagnosis'] != '' ? $_POST['main_diagnosis'] : NULL), 
        'relatives_informed' => ($_POST['relatives_informed'] != '' ? $_POST['relatives_informed'] : NULL), 
        'good_man_informed' => ($_POST['good_man_informed'] != '' ? $_POST['good_man_informed'] : NULL),  
        'type_fall' => ($_POST['type_fall'] != '' ? $_POST['type_fall'] : NULL),  
        'type_hot_vald' => ($_POST['type_hot_vald'] != '' ? $_POST['type_hot_vald'] : NULL),  
        'type_lakemedel' => ($_POST['type_lakemedel'] != '' ? $_POST['type_lakemedel'] : NULL),  
        'type_mtp' => ($_POST['type_mtp'] ? $_POST['type_mtp'] : NULL),  
        'type_utebliven_felaktig' => ($_POST['type_utebliven_felaktig'] != '' ? $_POST['type_utebliven_felaktig'] : NULL),  
        'vad_hande_och_varfor_hande_det' => ($_POST['vad_hande_och_varfor_hande_det'] ? $_POST['vad_hande_och_varfor_hande_det'] : NULL),  
        'vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen' => ($_POST['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen'] != '' ? $_POST['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen'] : NULL),  
        'vad_blev_resultatet_av_ovanstaende_atgarder' => ($_POST['vad_blev_resultatet_av_ovanstaende_atgarder'] ? $_POST['vad_blev_resultatet_av_ovanstaende_atgarder'] : NULL)
    );
    //echo '<pre>' . print_r($form_data, 1) . '</pre>'; //exit();
    $form_fild_datas = array();
    foreach($field_groups as $group) {
        foreach($group['fields'] as $field) {
            if($field['id']) {
                $filed_id = $field['id'];
                $field_value = (($_POST['field_' . $field['id']] != '') ? $_POST['field_' . $field['id']] : NULL);
                if($field_value > count($field['options'])) {
                    $answer = $_POST['field_' . $field['id'] . '_other'];
                } else {
                    $answer = $field_value;
                }
                $form_fild_datas[] = array(
                    'field_id' => $field['id'], 
                    'answer' => $answer
                );
            }
        }
    }
    $form_data['fields'] = $form_fild_datas;

    if($review_id) {
        $review_id = $customer_forms->form_5_update($review_id, $form_data);
    } else {
        $review_id = $customer_forms->form_5_insert($form_data);
    }
    if($review_id) {
        $messages->set_message("success", 'form_5_adding_success');
    } else {
        $messages->set_message("fail", 'form_5_adding_fail');
    }
    header("Location: form_5.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    $field_groups = $customer_forms->form_5_fields();
    $review_data = array();
    if($review_id) {
        $review_data = $customer_forms->get_form_5_by_id($review_id);
    }
    $pdf = new PDF_form();
    $pagecount = $pdf->setSourceFile('./pdf_forms/form_5.pdf');
    $pdf->AddPage();
    $tppl = $pdf->importPage(1); 
    $pdf->useTemplate($tppl, -2, 0, 210);
    $pdf->company = $company_details['name'];
    $pdf->date = ($review_data['created_date'] != '' ? $review_data['created_date'] : date('Y-m-d'));
    if($company_details['logo']) {
        $pdf->Image('./company_logo/' . $company_details['logo'], 150, 22, 30, 10);
    }

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetXY(83, 40);
    $pdf->Cell(30, 4, utf8_decode($review_data['deviation_date']), 0, 0, 'L', FALSE);
    $pdf->SetXY(133, 40);
    $pdf->Cell(20, 4, utf8_decode($review_data['deviation_time'] != '' ? date('H:i', strtotime($review_data['deviation_time'])) : ''), 0, 0, 'L', FALSE);
    $pdf->SetXY(103, 47);
    $pdf->Cell(20, 4, utf8_decode($review_data['error_from']), 0, 0, 'L', FALSE);
    $pdf->SetXY(133, 47);
    $pdf->Cell(20, 4, utf8_decode($review_data['error_to']), 0, 0, 'L', FALSE);
    $pdf->SetXY(73, 54);
    $pdf->Cell(100, 4, utf8_decode($review_data['where_did_deviation']), 0, 0, 'L', FALSE);

    $pdf->SetXY(60, 78);
    $pdf->Cell(100, 4, utf8_decode($review_data['customer_name']), 0, 0, 'L', FALSE);
    $pdf->SetXY(55, 85);
    $pdf->Cell(30, 4, utf8_decode($customers[$customer_id]['century'] . ' ' . substr_replace($customers[$customer_id]['social_security'],"-",6,0)), 0, 0, 'L', FALSE);
    $pdf->SetXY(115, 85);
    $pdf->Cell(50, 4, utf8_decode($review_data['main_diagnosis']), 0, 0, 'L', FALSE);

    if($review_data['relatives_informed'] == 1) {
        $pdf->SetXY(58, 93);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    } elseif ($review_data['relatives_informed'] === '0') {
        $pdf->SetXY(70, 93);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }
    if($review_data['good_man_informed'] == 1) {
        $pdf->SetXY(124, 93);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    } elseif ($review_data['good_man_informed'] === '0') {
        $pdf->SetXY(134, 93);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }

    if($review_data['type_fall'] == 1) {
        $pdf->SetXY(34, 121);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }
    if($review_data['type_hot_vald'] == 1) {
        $pdf->SetXY(34, 126);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }
    if($review_data['type_lakemedel'] == 1) {
        $pdf->SetXY(34, 131);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }
    if($review_data['type_mtp'] == 1) {
        $pdf->SetXY(34, 137);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }
    if($review_data['type_utebliven_felaktig'] == 1) {
        $pdf->SetXY(34, 142);
        $pdf->Cell(5, 4, 'X', 0, 0, 'L', FALSE);
    }

    $pdf->SetXY(30, 167);
    $pdf->MultiCell(150, 3.5, utf8_decode($review_data['vad_hande_och_varfor_hande_det']), 0, 'L');

    $pdf->SetXY(25, 211);
    $pdf->MultiCell(155, 3.5, utf8_decode($review_data['vad_har_du_ni_gjort_for_att_det_inte_ska_ske_igen']), 0, 'L');

    $pdf->SetXY(25, 240);
    $pdf->MultiCell(155, 3.5, utf8_decode($review_data['vad_blev_resultatet_av_ovanstaende_atgarder']), 0, 'L');


    $pdf->SetXY(32, 260);
    $pdf->Cell(25, 4, date('Y-m-d H:i', strtotime($review_data['created_date'])), 0, 0, 'L', FALSE);

    $pdf->SetXY(105, 260);
    $pdf->Cell(80, 4, utf8_decode($review_data['created_name']), 0, 0, 'L', FALSE);

    foreach ($field_groups as $group_id => $groups) {
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->setY($pdf->GetY() + 10);
        $pdf->SetX(20);
        $pdf->MultiCell(180, 8, utf8_decode(utf8_encode($groups['name'])), 0, 'L');
        $start_line_y = $pdf->GetY() + 5;
        $starty = $pdf->GetY();
        $start_1_y = $start_2_y = $startey = $starty;
        $pdf->SetFont('Arial', '', 10);
        $pdf->Line(15, $starty + 5 , 200, $starty + 5);
        $field_count = 0;
        $startx = 20;
        foreach ($groups['fields'] as $key_id => $field) {
            if($field_count%2) {
                $starty = $startey;
                $startx = 110;
            } else {
                if($start_1_y > $start_2_y) {
                    $starty = $start_1_y + 10;
                } else {
                    $starty = $start_2_y + 10;
                }
                $startx = 20;
                $startey = $starty;
            }
            $pdf->setY($starty);
            $pdf->SetX($startx);
            $pdf->MultiCell(90, 6, utf8_decode($field['name']), 0, 'L');
            foreach ($field['options'] as $option_index => $option) {
                $option_val = $option_index + 1;
                $pdf->setY($pdf->GetY());
                $pdf->SetX($startx + 5);
                $pdf->MultiCell(85, 6, ($review_data['answers'][$field['id']] == $option_val ? '[X]' : '[  ]') . '  ' . utf8_decode($option), 0, 'L');
                if($field_count%2) {
                    $start_2_y = $pdf->GetY();
                } else {
                    $start_1_y = $pdf->GetY();
                }
            }
            if($field['other']) {
                $option_val = $option_index + 1;
                $pdf->setY($pdf->GetY());
                $pdf->SetX($startx + 5);
                $other_txt = (((!is_numeric($review_data['answers'][$field['id']]) && $review_data['answers'][$field['id']] != '') ? '[X]' : '[  ]') . '  ');
                $other_txt .= utf8_decode('Annat : ' . ((!is_numeric($review_data['answers'][$field['id']]) && $review_data['answers'][$field['id']] != '') ? $review_data['answers'][$field['id']] : '__________________'));
                $pdf->MultiCell(85, 6, $other_txt, 0, 'L');
                if($field_count%2) {
                    $start_2_y = $pdf->GetY();
                } else {
                    $start_1_y = $pdf->GetY();
                }
            }
            if(($field_count%2) || (count($groups['fields']) == ($field_count + 1))) {
                if($start_1_y > $start_2_y) {
                    $starty = $start_1_y + 5;
                } else {
                    $starty = $start_2_y + 5;
                }
                $pdf->Line(15, $starty , 200, $starty);
                $pdf->Line(15, $start_line_y, 15 , $starty);
                $pdf->Line(200, $start_line_y, 200 , $starty);
                $pdf->Line(105, $start_line_y, 105 , $starty);
                $start_line_y = $pdf->GetY() + 5;
            }
            $field_count++;
        }
    }
    $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
    //$pdf->Output();
}

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_5_by_id($review_id);
}
$smarty->assign('review_data', $review_data);

//echo '<pre>' . print_r($review_data, 1) . '</pre>';
$fields = $customer_forms->form_5_fields();
$smarty->assign('fields', $fields);
//echo '<pre>' . print_r($fields, 1) . '</pre>'; exit();


$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|forms/form_5.tpl');
?>