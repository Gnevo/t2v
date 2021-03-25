<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/mail.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$customer = new customer();
$employee = new employee();

$customer_username = $_REQUEST['customer'];

$smarty->assign('type', $_REQUEST['action']);
$rel_msg = '';
$subject = '';
$customer_detail_main = $customer->customer_detail($customer_username);
//echo "<pre>".print_r($customer_detail_main,1)."</pre>";
if($_REQUEST['action'] == 'save'){
    
    $relative_id = $_REQUEST['id'];
    $customer->username = $customer_username;
    $customer->relative_name = $_REQUEST['name'];
    $customer->relative_relation = $_REQUEST['relation'];
    $customer->relative_address = $_REQUEST['address'];
    $customer->relative_city = $_REQUEST['city'];
    $customer->relative_phone = $_REQUEST['phone'];
    $customer->relative_work_phone = $_REQUEST['work_phone'];
    $customer->relative_mobile = $_REQUEST['mobile'];
    $customer->relative_email = $_REQUEST['email'];
    $customer->relative_other = $_REQUEST['other'];
    if($relative_id != ''){
        $customer_detail = $customer->customer_relative_details($relative_id);
        $customer->begin_transaction();
        
        if($customer->customer_relatives_update($relative_id)){
            $customer->commit_transaction();
            $subject = $smarty->translate['customer_relative_edit_mail_subject'];
            $rel_msg = $customer->relative_name != $customer_detail['name'] ? $smarty->translate['name']. ' : ' .$customer->relative_name. ($customer_detail['name'] != '' ? '('.$customer_detail['name'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_relation != $customer_detail['relation'] ? $smarty->translate['relation']. ' : ' .$customer->relative_relation. ($customer_detail['relation'] != '' ? '('.$customer_detail['relation'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_address != $customer_detail['address'] ? $smarty->translate['address']. ' : ' .$customer->relative_address. ($customer_detail['address'] != '' ? '('.$customer_detail['address'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_city != $customer_detail['city'] ? $smarty->translate['city']. ' : ' .$customer->relative_city. ($customer_detail['city'] != '' ? '('.$customer_detail['city'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_phone != $customer_detail['phone'] ? $smarty->translate['phone']. ' : ' .$customer->relative_phone. ($customer_detail['phone'] != '' ? '('.$customer_detail['phone'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_work_phone != $customer_detail['work_phone'] ? $smarty->translate['phone_work']. ' : ' .$customer->relative_work_phone. ($customer_detail['work_phone'] != '' ? '('.$customer_detail['work_phone'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_mobile != $customer_detail['mobile'] ? $smarty->translate['mobile']. ' : ' .$customer->relative_mobile. ($customer_detail['mobile'] != '' ? '('.$customer_detail['mobile'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_email != $customer_detail['email'] ? $smarty->translate['email']. ' : ' .$customer->relative_email. ($customer_detail['email'] != '' ? '('.$customer_detail['email'].')' : '' ).'<br>' : '';
            $rel_msg .= $customer->relative_other != $customer_detail['other'] ? $smarty->translate['other']. ' : ' .$customer->relative_other. ($customer_detail['other'] != '' ? '('.$customer_detail['other'].')' : '' ).'<br>' : '';
            if($rel_msg){
                $rel_msg = $smarty->translate['customer_relative_edit_body1']."<br>".$rel_msg;
            }
        } else {
            $customer->rollback_transaction();
        }
    } else {

        $customer->begin_transaction();
        if($customer->customer_relatives_add()){

            $customer->commit_transaction();
            $subject = $smarty->translate['customer_relative_add_mail_subject'];

            $rel_msg = $customer->relative_name ? $smarty->translate['name']. ' : ' .$customer->relative_name. ' <br>' : '';
            $rel_msg .= $customer->relative_relation ? $smarty->translate['relation']. ' : ' .$customer->relative_relation. '<br>' : '';
            $rel_msg .= $customer->relative_address ? $smarty->translate['address']. ' : ' .$customer->relative_address. '<br>' : '';
            $rel_msg .= $customer->relative_city ? $smarty->translate['city']. ' : ' .$customer->relative_city. '<br>' : '';
            $rel_msg .= $customer->relative_phone ? $smarty->translate['phone']. ' : ' .$customer->relative_phone. '<br>' : '';
            $rel_msg .= $customer->relative_work_phone ? $smarty->translate['phone_work']. ' : ' .$customer->relative_work_phone. '<br>' : '';
            $rel_msg .= $customer->relative_mobile ? $smarty->translate['mobile']. ' : ' .$customer->relative_mobile. '<br>' : '';
            $rel_msg .= $customer->relative_email ? $smarty->translate['email']. ' : ' .$customer->relative_email. '<br>' : '';
            $rel_msg .= $customer->relative_other ? $smarty->translate['other']. ' : ' .$customer->relative_other. '<br>' : '';

        } else {
            $customer->rollback_transaction();
        }
    }
    
} else if($_REQUEST['action'] == 'delete'){
    
    $relative_id = $_REQUEST['id'];
    $customer_detail = $customer->customer_relative_details($relative_id);
    $customer->begin_transaction();
    if($customer->customer_relative_delete($relative_id, $customer_username)){
        $customer->commit_transaction();
        $subject = $smarty->translate['customer_relative_delete_mail_subject'];
        $rel_msg = $customer->relative_name ? $smarty->translate['name']. ' : ' .$customer->name. ' <br>' : '';
    } else {
        $customer->rollback_transaction();
    }
} else if($_REQUEST['action'] == 'load') {
    
    $relative_id = $_REQUEST['id'];
    $smarty->assign('relative_details', $customer->customer_relative_details($relative_id));
} elseif ($_REQUEST['action'] == 'list') {
    
    $smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
}

if ($rel_msg) {
    $logged_employee_detail = $employee->employee_detail_main($_SESSION['user_id']);
    $compony_detail = $customer->get_company_detail($_SESSION['company_id']);
    $company_home = $compony_detail['website'];
    $cirrus_link = $company['website'];
    $contact_person = $compony_detail['contact_person1'];
    $company_name = $compony_detail['name'];
    $logged_employee_name = $_SESSION['company_sort_by'] == 1 ? $logged_employee_detail[0]['first_name']. ' '. $logged_employee_detail[0]['last_name'] : $logged_employee_detail[0]['last_name']. ' '. $logged_employee_detail[0]['first_name'];
    
    
    $msg = $rel_msg.'<br>'.$smarty->translate['profile_customer_name'] . ' : ' .  ($_SESSION['company_sort_by'] == 1 ? $$customer_detail_main['first_name']. ' '. $customer_detail_main['last_name'] : $customer_detail_main['last_name']. ' '. $customer_detail_main['first_name']).'<br>'.$smarty->translate[contact_person_in_the_office].' : '.$contact_person.'<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link.'<br>'.$smarty->translate['edited_by'] . ' : ' . $logged_employee_name;
    $mailer = new SimpleMail($subject, $msg);
    $mailer->addSender("cirrus-noreplay@time2view.se");
    $mailer->addRecipient($customer_detail_main['email'], trim($customer_detail_main['first_name']).' '.trim($customer_detail_main['last_name']));

    $recipient_mail = NULL;
    if($compony_detail['mail_send_to_contact_person'] == 1){
        if(trim($compony_detail['contact_person2_email']) != '')
            $recipient_mail = trim($compony_detail['contact_person2_email']);
        else if(trim($compony_detail['contact_person1_email']) != '')
            $recipient_mail = trim($compony_detail['contact_person1_email']);
    }
    $mailer->addRecipient($recipient_mail);

    $logged_employee_detail = $employee->employee_detail_main($_SESSION['user_id']);
    if(trim($logged_employee_detail[0]['email']) != '')
        $mailer->addRecipient($logged_employee_detail[0]['email']); 

    $mailer->send();

}

$smarty->display('ajax_customer_relative.tpl');
?>