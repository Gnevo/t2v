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
require_once('configs/config.inc.php');
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
$smarty->assign('user_fullname', $_SESSION['user_name']);
$smarty->assign('user_fullname', $_SESSION['user_name']);
$smarty->assign('user_rolename', $role_swedish[$_SESSION['user_role']]);
//print_r($_SESSION);exit();
if($_POST['action'] == 'save' && $_POST['customer'] != '') {
    $review_id = ($_POST['review'] ? $_POST['review'] : 0);
    $review_data = array();
	if($review_id > 0){
	    $review_data = $customer_forms->get_form_4_by_id($review_id);
	}
    $field_groups = $customer_forms->form_4_fields();
    $form_data = array(
        'customer' => $_POST['customer'],
        'created_by' => $_SESSION['user_id'], 
        'check_r' => ($_POST['check_r'] == 1 ? $_POST['check_r'] : 0), 
        'check_s' => ($_POST['check_s'] == 1 ? $_POST['check_s'] : 0), 
        'fullname' => ($_POST['fullname'] ? $_POST['fullname'] : NULL), 
        'social_security' => ($_POST['social_security'] ? $_POST['social_security'] : NULL), 
        'address' => ($_POST['address'] ? $_POST['address'] : NULL), 
        'email' => ($_POST['email'] ? $_POST['email'] : NULL), 
        'phone' => ($_POST['phone'] ? $_POST['phone'] : NULL), 
        'onskemal_angaende_kontakter' => ($_POST['onskemal_angaende_kontakter'] ? $_POST['onskemal_angaende_kontakter'] : NULL),  
        'ny_uppdragsgivare' => ($_POST['ny_uppdragsgivare'] ? $_POST['ny_uppdragsgivare'] : NULL),  
        'uppfoljning' => ($_POST['uppfoljning'] ? $_POST['uppfoljning'] : NULL),  
        'forandring' => ($_POST['forandring'] != '' ? $_POST['forandring'] : NULL),  
        'schemalagd' => ($_POST['schemalagd'] ? $_POST['schemalagd'] : NULL),  
        'samtycker_till_genomforandeplan' => ($_POST['samtycker_till_genomforandeplan'] != '' ? $_POST['samtycker_till_genomforandeplan'] : NULL),  
        'datum_for_uppfoljning_bokad' => (strtotime($_POST['datum_for_uppfoljning_bokad']) ? date('Y-m-d', strtotime($_POST['datum_for_uppfoljning_bokad'])) : NULL),  
        'datum_for_uppfoljning_genomford' => (strtotime($_POST['datum_for_uppfoljning_genomford']) != '' ? date('Y-m-d', strtotime($_POST['datum_for_uppfoljning_genomford'])) : NULL),  
        'datum_for_ordinarie_bokad' => (strtotime($_POST['datum_for_ordinarie_bokad']) ? date('Y-m-d', strtotime($_POST['datum_for_ordinarie_bokad'])) : NULL),  
        'datum_for_ordinarie_genomford' => (strtotime($_POST['datum_for_ordinarie_genomford']) != '' ? date('Y-m-d', strtotime($_POST['datum_for_ordinarie_genomford'])) : NULL),  
        'datum_for_upprattandet_av_gp' => (strtotime($_POST['datum_for_upprattandet_av_gp']) ? date('Y-m-d', strtotime($_POST['datum_for_upprattandet_av_gp'])) : NULL),  
        'deltagare_vid_upprattandet_av_gp_name1' => ($_POST['deltagare_vid_upprattandet_av_gp_name1'] != '' ? $_POST['deltagare_vid_upprattandet_av_gp_name1'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_roll1' => ($_POST['deltagare_vid_upprattandet_av_gp_roll1'] ? $_POST['deltagare_vid_upprattandet_av_gp_roll1'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_name2' => ($_POST['deltagare_vid_upprattandet_av_gp_name2'] != '' ? $_POST['deltagare_vid_upprattandet_av_gp_name2'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_roll2' => ($_POST['deltagare_vid_upprattandet_av_gp_roll2'] ? $_POST['deltagare_vid_upprattandet_av_gp_roll2'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_name3' => ($_POST['deltagare_vid_upprattandet_av_gp_name3'] != '' ? $_POST['deltagare_vid_upprattandet_av_gp_name3'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_roll3' => ($_POST['deltagare_vid_upprattandet_av_gp_roll3'] ? $_POST['deltagare_vid_upprattandet_av_gp_roll3'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_name4' => ($_POST['deltagare_vid_upprattandet_av_gp_name4'] != '' ? $_POST['deltagare_vid_upprattandet_av_gp_name4'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_roll4' => ($_POST['deltagare_vid_upprattandet_av_gp_roll4'] ? $_POST['deltagare_vid_upprattandet_av_gp_roll4'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_name5' => ($_POST['deltagare_vid_upprattandet_av_gp_name5'] != '' ? $_POST['deltagare_vid_upprattandet_av_gp_name5'] : NULL),  
        'deltagare_vid_upprattandet_av_gp_roll5' => ($_POST['deltagare_vid_upprattandet_av_gp_roll5'] ? $_POST['deltagare_vid_upprattandet_av_gp_roll5'] : NULL),
        'dagens_datum_1' => (strtotime($_POST['dagens_datum_1']) != '' ? date('Y-m-d', strtotime($_POST['dagens_datum_1'])) : NULL),
        'dagens_datum_2' => (strtotime($_POST['dagens_datum_2']) != '' ? date('Y-m-d', strtotime($_POST['dagens_datum_2'])) : NULL),
        'befattning_roll_1' => ($_POST['befattning_roll_1'] != '' ? $_POST['befattning_roll_1'] : NULL),
        'befattning_roll_2' => ($_POST['befattning_roll_2'] != '' ? $_POST['befattning_roll_2'] : NULL),
        'namnfortydligande_1' => ($_POST['namnfortydligande_1'] != '' ? $_POST['namnfortydligande_1'] : NULL),
        'namnfortydligande_2' => ($_POST['namnfortydligande_2'] != '' ? $_POST['namnfortydligande_2'] : NULL)
    );
    $form_fild_datas = array();
    foreach($field_groups as $group) {
    	foreach($group['fields'] as $field) {
    		if($field['id']) {
    			$filed_id = $field['id'];
    			$field_value = (($_POST['field_' . $field['id']] != '') ? $_POST['field_' . $field['id']] : NULL);
    			$answer = $field_value;
    			if($field['type'] == 2) {
    				if(isset($review_data['answers'][$filed_id])) {
						$answer = $review_data['answers'][$filed_id];
					}
    				if($field_value != '') {
    					$answer = '<p class="note_block_head">Datum: ' . date('Y-m-d H:i') . '   Dokumenterat av: ' . $_SESSION['user_name'] . '</p><br/>';
    					$answer .= "<p>$field_value</p><hr/>";
    					if(isset($review_data['answers'][$filed_id])) {
    						$answer .= $review_data['answers'][$filed_id];
    					}
    				}
    			} 
	    		$form_fild_datas[] = array(
	    			'field_id' => $field['id'], 
	    			'answer' => $answer
				);
    		}
    	}
    }
    $form_data['fields'] = $form_fild_datas;
    //echo '<pre>' . print_r($form_data, 1) . '</pre>'; exit();
    if($review_id) {
        $review_id = $customer_forms->form_4_update($review_id, $form_data);
    } else {
        $review_id = $customer_forms->form_4_insert($form_data);
    }
    if($review_id) {
        $messages->set_message("success", 'form_4_adding_success');
    } else {
        $messages->set_message("fail", 'form_4_adding_fail');
    }
    header("Location: form_4.php?action=pdf&review=$review_id&customer=$customer_id");
    exit();
}
if($_POST['action'] == 'pdf') {
    $review_id = ($_REQUEST['review'] ? $_REQUEST['review'] : 0);
    $field_groups = $customer_forms->form_4_fields();
    $review_data = array();
    if($review_id) {
        $review_data = $customer_forms->get_form_4_by_id($review_id);
    }
    $pdf = new PDF_customer_form();
    $pdf->company = $company_details['name'];
    $pdf->date = ($review_data['created_date'] != '' ? $review_data['created_date'] : date('Y-m-d'));
    $pdf->check_r = $review_data['check_r'];
    $pdf->check_s = $review_data['check_s'];
    $pdf->AddPage();            
    //date
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(190, 8, utf8_decode('Datum för upprättandet av GP: ' . date('Y-m-d H:i', strtotime(($review_data['created_date'] != '' ? $review_data['created_date'] : date('Y-m-d H:i'))))), 0, 1, 'L', FALSE);

    //first heading
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(190, 10, utf8_decode('Uppgift om uppdragsgivaren'), 0, 1, 'L', FALSE);

    //Customer Details
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(120, 4, utf8_decode('Fullständigt namn'), 0, 0, 'L', FALSE);
    $pdf->SetX(130);
    $pdf->Cell(70, 4, utf8_decode('Personnummer'), 0, 1, 'L', FALSE);
    $pdf->SetFont('Arial', '', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(120, 6, utf8_decode(utf8_encode($review_data['fullname'])), 1, 0, 'L', FALSE);
    $pdf->SetX(130);
    $pdf->Cell(70, 6, utf8_encode($review_data['customer_century'] . $review_data['social_security']), 1, 1, 'L', FALSE);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(190, 4, utf8_decode('Fullständig adress'), 0, 1, 'L', FALSE);
    $pdf->SetFont('Arial', '', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(190, 6, utf8_decode(utf8_encode($review_data['address'])), 1, 1, 'L', FALSE);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(95, 4, utf8_decode('E-post'), 0, 0, 'L', FALSE);
    $pdf->SetX(105);
    $pdf->Cell(95, 4, utf8_decode('Telefon/Mobil'), 0, 1, 'L', FALSE);
    $pdf->SetFont('Arial', '', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(95, 6, utf8_encode($review_data['email']), 1, 0, 'L', FALSE);
    $pdf->SetX(105);
    $pdf->Cell(95, 6, utf8_encode($review_data['phone']), 1, 1, 'L', FALSE);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY()+2);
    $pdf->SetX(10);
    $pdf->Cell(190, 4, utf8_decode('Önskemål angående kontakter'), 0, 1, 'L', FALSE);
    $pdf->SetFont('Arial', '', 8);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(190, 6, utf8_decode(utf8_encode($review_data['onskemal_angaende_kontakter'])), 1, 1, 'L', FALSE);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setY($pdf->GetY()+5);
    $pdf->SetX(10);
    $pdf->Cell(50, 6, utf8_decode(''), 0, 0, 'L', FALSE);
    $pdf->Cell(35, 6, utf8_decode('Ny uppdragsgivare'), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, utf8_decode('Uppföljning'), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, utf8_decode('Förändring'), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, utf8_decode('Schemalagd'), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(50, 6, utf8_decode('Orsak till GP'), 1, 0, 'L', FALSE);
    $pdf->Cell(35, 6, ($review_data['ny_uppdragsgivare'] ? 'X' : ''), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, ($review_data['uppfoljning'] ? 'X' : ''), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, ($review_data['forandring'] ? 'X' : ''), 1, 0, 'C', FALSE);
    $pdf->Cell(35, 6, ($review_data['schemalagd'] ? 'X' : ''), 1, 1, 'C', FALSE);

    $pdf->setY($pdf->GetY()+5);
    $pdf->SetX(10);
    $pdf->Cell(140, 6, utf8_encode(''), 0, 0, 'L', FALSE);
    $pdf->Cell(25, 6, utf8_encode('Ja'), 1, 0, 'C', FALSE);
    $pdf->Cell(25, 6, utf8_encode('Nej'), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(140, 6, utf8_decode('Samtycker till genomförandeplan'), 1, 0, 'L', FALSE);
    $pdf->Cell(25, 6, ($review_data['samtycker_till_genomforandeplan'] ? 'X' : ''), 1, 0, 'C', FALSE);
    $pdf->Cell(25, 6, ($review_data['samtycker_till_genomforandeplan'] == 0 ? 'X' : ''), 1, 1, 'C', FALSE);

    foreach ($field_groups AS $group_id => $groups) {
    	$pdf->SetFont('Arial', '', 14);
    	$pdf->setY($pdf->GetY() + 6);
    	$pdf->SetX(10);
    	$pdf->MultiCell(190, 6, utf8_decode(utf8_encode($groups['name'])), 0, 'L');
    	if($groups['caption']) {
        	$pdf->SetFont('Arial', '', 10);
        	$pdf->setY($pdf->GetY());
        	$pdf->SetX(10);
        	$pdf->MultiCell(190, 6, utf8_decode(utf8_encode($groups['caption'])), 0, 'L');
    	}
    	if($group_id == 1) {
    		$pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_encode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Nej'), 1, 1, 'C', FALSE);
            for ($i=0; $i < 4; $i++) { 
            	$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(140, 6, utf8_decode($groups['fields'][$i]['name']), 1, 0, 'L', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][$i]['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][$i]['id']] == 0 ? 'X' : ''), 1, 1, 'C', FALSE);
            }
            $starty = $pdf->GetY();
            $pdf->setY($starty);
            $pdf->SetX(10);
            $pdf->Cell(25, 6, utf8_decode('Om Ja'), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Beräkningsperiod:'), 0, 0, 'L', FALSE);
            $pdf->Cell(55, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][4]['id']])), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Beräkningsperiod:'), 0, 0, 'L', FALSE);
            $pdf->Cell(60, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][5]['id']])), 0, 1, 'L', FALSE);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(35);
            $pdf->Cell(25, 6, utf8_decode('Antal timmar:'), 0, 0, 'L', FALSE);
            $pdf->Cell(55, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][6]['id']])), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Antal timmar:'), 0, 0, 'L', FALSE);
            $pdf->Cell(60, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][7]['id']])), 0, 1, 'L', FALSE);
            $endy = $pdf->GetY();
            $pdf->SetLineWidth(0.2);
            $pdf->Line(10, $starty, 10, $endy);
            $pdf->Line(35, $starty, 35, $endy);
            $pdf->Line(115, $starty, 115, $endy);
            $pdf->Line(200, $starty, 200, $endy);
            $pdf->Line(10, $endy , 200, $endy);

            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_decode($groups['fields'][8]['name']), 1, 0, 'L', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][8]['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][8]['id']] == 0 ? 'X' : ''), 1, 1, 'C', FALSE);
            $starty = $pdf->GetY();
            $pdf->setY($starty);
            $pdf->SetX(10);
            $pdf->Cell(25, 6, utf8_decode(utf8_encode('Om Ja')), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Beräkningsperiod:'), 0, 0, 'L', FALSE);
            $pdf->Cell(55, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][9]['id']])), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Beräkningsperiod:'), 0, 0, 'L', FALSE);
            $pdf->Cell(60, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][10]['id']])), 0, 1, 'L', FALSE);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(35);
            $pdf->Cell(25, 6, utf8_decode('Antal timmar:'), 0, 0, 'L', FALSE);
            $pdf->Cell(55, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][11]['id']])), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Antal timmar:'), 0, 0, 'L', FALSE);
            $pdf->Cell(60, 6, utf8_decode(utf8_encode($review_data['answers'][$groups['fields'][12]['id']])), 0, 1, 'L', FALSE);
            $endy = $pdf->GetY();
            $pdf->SetLineWidth(0.2);
            $pdf->Line(10, $starty, 10, $endy);
            $pdf->Line(35, $starty, 35, $endy);
            $pdf->Line(115, $starty, 115, $endy);
            $pdf->Line(200, $starty, 200, $endy);
            $pdf->Line(10, $endy , 200, $endy);

            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_decode($groups['fields'][13]['name']), 1, 0, 'L', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][13]['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][13]['id']] == 0 ? 'X' : ''), 1, 1, 'C', FALSE);
    	}
    	if($group_id == 2) {
    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][0]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][1]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][0]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][1]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][2]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][2]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][3]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][4]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][3]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][4]['id']]), 1, 1, 'L', FALSE);

            $pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY()+5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][5]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][6]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][5]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][6]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][7]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][7]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][8]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][9]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][8]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][9]['id']]), 1, 1, 'L', FALSE);
    	}
    	if($group_id == 3) {
    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][0]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][1]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][0]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][1]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][2]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][2]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][3]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][4]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][3]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][4]['id']]), 1, 1, 'L', FALSE);

            $pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_decode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, utf8_decode('Nej'), 1, 1, 'C', FALSE);
        	$pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_decode($groups['fields'][5]['name']), 1, 0, 'L', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][5]['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, ($review_data['answers'][$groups['fields'][5]['id']] == 0 ? 'X' : ''), 1, 1, 'C', FALSE);
        }
        if($group_id == 4) {
        	$pdf->SetFont('Arial', 'B', 10);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(190, 8, utf8_decode('Försäkringskassa'), 0, 1, 'L', FALSE);

    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][0]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][1]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][0]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][1]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][2]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][2]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][3]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][4]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][3]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][4]['id']]), 1, 1, 'L', FALSE);

            $pdf->SetFont('Arial', 'B', 10);
    		$pdf->setY($pdf->GetY()+5);
            $pdf->SetX(10);
            $pdf->Cell(190, 8, utf8_decode('Kommun'), 0, 1, 'L', FALSE);
            
    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][5]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][6]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][5]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][6]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][7]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][7]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][8]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][9]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][8]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][9]['id']]), 1, 1, 'L', FALSE);
        }
        if($group_id == 5) {
    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][0]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][1]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][0]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][1]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][2]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][2]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][3]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][3]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][4]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][5]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][4]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][5]['id']]), 1, 1, 'L', FALSE);
        }
        if($group_id == 6) {
    		$pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][0]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][1]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][0]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][1]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][2]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][2]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][3]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][3]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][4]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][5]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][4]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][5]['id']]), 1, 1, 'L', FALSE);

            $pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode($groups['fields'][6]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode($groups['fields'][7]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode($review_data['answers'][$groups['fields'][6]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode($review_data['answers'][$groups['fields'][7]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][8]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][8]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode($groups['fields'][9]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode($review_data['answers'][$groups['fields'][9]['id']]), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][10]['name']), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode($groups['fields'][11]['name']), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][10]['id']]), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode($review_data['answers'][$groups['fields'][11]['id']]), 1, 1, 'L', FALSE);

            $pdf->SetFont('Arial', 'B', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(120, 4, utf8_decode(($groups['fields'][12]['name'])), 0, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 4, utf8_decode(($groups['fields'][13]['name'])), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(120, 6, utf8_decode(($review_data['answers'][$groups['fields'][12]['id']])), 1, 0, 'L', FALSE);
            $pdf->SetX(130);
            $pdf->Cell(70, 6, utf8_decode(($review_data['answers'][$groups['fields'][13]['id']])), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode(($groups['fields'][14]['name'])), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode(($review_data['answers'][$groups['fields'][14]['id']])), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 4, utf8_decode(($groups['fields'][15]['name'])), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(190, 6, utf8_decode(($review_data['answers'][$groups['fields'][15]['id']])), 1, 1, 'L', FALSE);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 4, utf8_decode(($groups['fields'][16]['name'])), 0, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 4, utf8_decode(($groups['fields'][17]['name'])), 0, 1, 'L', FALSE);
            $pdf->SetFont('Arial', '', 8);
            $pdf->setY($pdf->GetY());
            $pdf->SetX(10);
            $pdf->Cell(95, 6, utf8_decode(($review_data['answers'][$groups['fields'][16]['id']])), 1, 0, 'L', FALSE);
            $pdf->SetX(105);
            $pdf->Cell(95, 6, utf8_decode(($review_data['answers'][$groups['fields'][17]['id']])), 1, 1, 'L', FALSE);
        }
        if($group_id == 7) {
        	foreach ($groups['fields'] AS $field) {
	        	$pdf->SetFont('Arial', 'B', 8);
        		$pdf->setY($pdf->GetY() + 5);
	            $pdf->SetX(10);
	            $pdf->Cell(190, 4, utf8_decode(($field['name'])), 0, 1, 'L', FALSE);
	            $pdf->SetFont('Arial', '', 8);
	            $pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->MultiCell(190, 6, str_replace(array('<p>','<p class="note_block_head">', '</p>', '<hr/>'), '', str_replace(array('<br/>', '<hr/>'), "\n", utf8_encode($review_data['answers'][$field['id']]))), 1, 'L');
        	}
        }
        if($group_id == 8) {
        	foreach ($groups['fields'] AS $field) {
	        	$pdf->SetFont('Arial', 'B', 8);
        		$pdf->setY($pdf->GetY() + 5);
	            $pdf->SetX(10);
	            $pdf->Cell(190, 4, utf8_decode(($field['name'])), 0, 1, 'L', FALSE);
	            $pdf->SetFont('Arial', '', 8);
	            $pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->MultiCell(190, 6, str_replace(array('<p>','<p class="note_block_head">', '</p>', '<hr/>'), '', str_replace(array('<br/>', '<hr/>'), "\n", utf8_encode($review_data['answers'][$field['id']]))), 1, 'L');
        	}
        }
        if($group_id == 9) {
        	foreach ($groups['fields'] AS $field) {
	        	$pdf->SetFont('Arial', 'B', 8);
        		$pdf->setY($pdf->GetY() + 5);
	            $pdf->SetX(10);
	            $pdf->Cell(190, 4, utf8_decode(($field['name'])), 0, 1, 'L', FALSE);
	            $pdf->SetFont('Arial', '', 8);
	            $pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->MultiCell(190, 6, str_replace(array('<p>','<p class="note_block_head">', '</p>', '<hr/>'), '', str_replace(array('<br/>', '<hr/>'), "\n", utf8_encode($review_data['answers'][$field['id']]))), 1, 'L');
        	}
        }
        if($group_id == 11) {
        	$pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_encode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Nej'), 1, 1, 'C', FALSE);
        	foreach ($groups['fields'] AS $field) {
            	$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(140, 6, utf8_decode(($field['name'])), 1, 0, 'L', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] === 0 ? 'X' : ''), 1, 1, 'C', FALSE);
        	}
        }
        if($group_id == 12) {
        	$pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_encode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Nej'), 1, 1, 'C', FALSE);
        	foreach ($groups['fields'] AS $field) {
            	$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(140, 6, utf8_decode(($field['name'])), 1, 0, 'L', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] === 0 ? 'X' : ''), 1, 1, 'C', FALSE);
        	}
        }
        if($group_id == 13) {
        	$pdf->setY($pdf->GetY() + 5);
        	foreach ($groups['fields'] AS $field) {
        		$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(60, 6, utf8_decode(($field['name'])), 1, 0, 'L', FALSE);
	            $pdf->Cell(130, 6, utf8_encode($review_data['answers'][$field['id']]), 1, 1, 'L', FALSE);
        	}
        }
        if($group_id == 14) {
        	$pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(130, 6, utf8_decode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(15, 6, utf8_decode('1a hand'), 1, 0, 'C', FALSE);
            $pdf->Cell(15, 6, utf8_decode('2a hand'), 1, 0, 'C', FALSE);
            $pdf->Cell(15, 6, utf8_decode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(15, 6, utf8_decode('Nej'), 1, 1, 'C', FALSE);
        	foreach ($groups['fields'] AS $field) {
            	$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(130, 6, utf8_decode(($field['name'])), 1, 0, 'L', FALSE);
	            $pdf->Cell(15, 6, ($review_data['answers'][$field['id']] === 2 ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(15, 6, ($review_data['answers'][$field['id']] === 3 ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(15, 6, ($review_data['answers'][$field['id']] === 1 ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(15, 6, ($review_data['answers'][$field['id']] === 0 ? 'X' : ''), 1, 1, 'C', FALSE);
        	}
        }
        if($group_id == 15) {
        	$pdf->SetFont('Arial', '', 8);
    		$pdf->setY($pdf->GetY() + 5);
            $pdf->SetX(10);
            $pdf->Cell(140, 6, utf8_encode(''), 0, 0, 'L', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Ja'), 1, 0, 'C', FALSE);
            $pdf->Cell(25, 6, utf8_encode('Nej'), 1, 1, 'C', FALSE);
        	foreach ($groups['fields'] AS $field) {
            	$pdf->setY($pdf->GetY());
	            $pdf->SetX(10);
	            $pdf->Cell(140, 6, utf8_decode(($field['name'])), 1, 0, 'L', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] ? 'X' : ''), 1, 0, 'C', FALSE);
	            $pdf->Cell(25, 6, ($review_data['answers'][$field['id']] === 0 ? 'X' : ''), 1, 1, 'C', FALSE);
        	}
        }
    }

    $pdf->SetFont('Arial', '', 14);
    $pdf->setY($pdf->GetY()+6);
    $pdf->SetX(10);
    $pdf->Cell(190, 6, utf8_decode('Planerad uppföljning av GP'), 0, 1, 'L', FALSE);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setY($pdf->GetY()+5);
    $pdf->SetX(10);
    $pdf->Cell(70, 6, utf8_decode(''), 0, 0, 'L', FALSE);
    $pdf->Cell(60, 6, utf8_decode('Bokad'), 1, 0, 'C', FALSE);
    $pdf->Cell(60, 6, utf8_decode('Genomförd'), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(70, 6, utf8_decode('Datum för uppföljning'), 1, 0, 'L', FALSE);
    $pdf->Cell(60, 6, utf8_decode(($review_data['datum_for_uppfoljning_bokad'])), 1, 0, 'C', FALSE);
    $pdf->Cell(60, 6, utf8_decode(($review_data['datum_for_uppfoljning_genomford'])), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(70, 6, utf8_decode('Datum för ordinarie'), 1, 0, 'L', FALSE);
    $pdf->Cell(60, 6, utf8_decode(($review_data['datum_for_ordinarie_bokad'])), 1, 0, 'C', FALSE);
    $pdf->Cell(60, 6, utf8_decode(($review_data['datum_for_ordinarie_genomford'])), 1, 1, 'C', FALSE);

    $pdf->setY($pdf->GetY()+5);
	$pdf->SetX(10);
    $pdf->Cell(70, 6, utf8_decode('Datum för upprättandet av GP'), 1, 0, 'L', FALSE);
    $pdf->Cell(120, 6, utf8_decode(($review_data['datum_for_upprattandet_av_gp'])), 1, 1, 'L', FALSE);

    $pdf->SetFont('Arial', '', 14);
    $pdf->setY($pdf->GetY()+6);
    $pdf->SetX(10);
    $pdf->Cell(190, 6, utf8_decode('Deltagare vid upprättandet av GP'), 0, 1, 'L', FALSE);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY()+5);
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode('Namn'), 0, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode('Befattning / Roll'), 0, 1, 'C', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_name1'])), 1, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_roll1'])), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_name2'])), 1, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_roll2'])), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_name3'])), 1, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_roll3'])), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_name4'])), 1, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_roll4'])), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(80, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_name5'])), 1, 0, 'C', FALSE);
    $pdf->Cell(110, 6, utf8_decode(($review_data['deltagare_vid_upprattandet_av_gp_roll5'])), 1, 1, 'C', FALSE);


    $pdf->SetFont('Arial', '', 14);
    $pdf->setY($pdf->GetY()+6);
    $pdf->SetX(10);
    $pdf->Cell(190, 6, utf8_decode('Godkännande av GP'), 0, 1, 'L', FALSE);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setY($pdf->GetY()+5);
    $pdf->SetX(10);
    $pdf->Cell(40, 8, utf8_decode('Dagens datum'), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 8, utf8_decode('Befattning / Roll'), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 8, utf8_decode('Namnförtydligande'), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 8, utf8_decode('Signatur'), 1, 1, 'C', FALSE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(40, 20, utf8_decode($review_data['dagens_datum_1']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode($review_data['befattning_roll_1']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode($review_data['namnfortydligande_1']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode(''), 1, 1, 'C', FALSE);
    $pdf->setY($pdf->GetY());
    $pdf->SetX(10);
    $pdf->Cell(40, 20, utf8_decode($review_data['dagens_datum_2']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode($review_data['befattning_roll_2']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode($review_data['namnfortydligande_2']), 1, 0, 'C', FALSE);
    $pdf->Cell(50, 20, utf8_decode(''), 1, 1, 'C', FALSE);

    $pdf->Output(date('Ymd') . '-' . $review_data['customer'] .".pdf", 'D');
    //$pdf->Output();
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
$form_datas = $customer_forms->get_form_4_customer($customer_id);
$smarty->assign('form_datas', $form_datas);
$fields = $customer_forms->form_4_fields();
$smarty->assign('fields', $fields);
//echo '<pre>' . print_r($form_datas, 1) . '</pre>';

$review_data = array();
if($review_id > 0){
    $review_data = $customer_forms->get_form_4_by_id($review_id);
}
$smarty->assign('review_data', $review_data);
//echo '<pre>' . print_r($review_data, 1) . '</pre>';

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|forms/form_4.tpl');
?>