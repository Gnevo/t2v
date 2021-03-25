<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');

$equipment = new equipment();
$customer = new customer();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$equipments_names = $customer->get_equipments();

$smarty->assign('serial_numbers', $customer->get_serial_number());
$customers_names = $customer->customer_view();
$smarty->assign('customers', $customers_names);
$smarty->assign('equipments', $equipments_names);

$name = "";
$serial = "";
$issue = "";
$return = "";
$ids = "";
$employee = $_SESSION['user_id'];
$user_role = $_SESSION["user_role"];

if (isset($_POST['mode']) && $_POST['mode'] == 'add') {

    $arr = array();
    $arr["customer"]            = $_POST["customers"];
    $arr["appoiment_date"]      = $_POST["appoiment_date"];
    $arr["appoiment_address"]   = $_POST["appoiment_address"];
    $arr["phone_number"]        = trim_phone($_POST["phone_number"]);
    $arr["reason"]              = $_POST["reason"];
    $arr["remarks"]             = $_POST["remarks"];
    $arr["contact_person_name"] = $_POST["contact_person_name"];
    $arr["reminder_before_date"]= (int) trim($_POST["reminder_before_date"]);
    $arr["phone_number_cp"]     = trim_phone($_POST["phone_number_cp"]);
    $arr["reminder_time"]       = $_POST["reminder_time"];
    $arr["repeat_until_due_date"] = $_POST["repeat_until_due_date"];
    $arr["email_cp"]            = $_POST["email_cp"];
    $arr["cust_email"]          = $_POST["cust_email"];
    $arr["email_alert"]         = $_POST["email_alert"];
    $arr["sms_alert"]           = $_POST["sms_alert"];
    $arr["cust_number"]         = trim_phone($_POST["cust_number"]);
    
    $datas = $customer->add_appoiment($arr);
    $customers = $_POST["customers"];

    if ($user_role != 4) {
        header("location:" . $smarty->url . "customer/appoiments/" . $customers . "/");
    } else {
        header("location:" . $smarty->url . "appointments/" . $customers . "/");
    }
    exit();
}
else if (isset($_POST['mode']) && $_POST['mode'] == 'edit') {
    $arr["appoiment_date"] = $_POST["appoiment_date"];
    $id = $_POST["id"];
    $arr["customer"]            = $_POST["customers"];
    $arr["appoiment_address"]   = $_POST["appoiment_address"];
    $arr["phone_number"]        = trim_phone($_POST["phone_number"]);
    $arr["reason"]              = $_POST["reason"];
    $arr["email_cp"]            = $_POST["email_cp"];
    $arr["remarks"]             = $_POST["remarks"];
    $arr["contact_person_name"] = $_POST["contact_person_name"];
    $arr["reminder_before_date"]= (int) trim($_POST["reminder_before_date"]);
    $arr["phone_number_cp"]     = trim_phone($_POST["phone_number_cp"]);
    $arr["reminder_time"]       = $_POST["reminder_time"];
    $arr["repeat_until_due_date"] = $_POST["repeat_until_due_date"];
    $arr["cust_email"]          = $_POST["cust_email"];
    $arr["email_alert"]         = $_POST["email_alert"];
    $arr["sms_alert"]           = $_POST["sms_alert"];
    $arr["cust_number"]         = trim_phone($_POST["cust_number"]);
    $datas = $customer->update_appoiment($arr, $id);
    $customers = $_POST["customers"];

    if ($user_role != 4) {
        header("location:" . $smarty->url . "customer/appoiments/" . $customers . "/");
    } else {
        header("location:" . $smarty->url . "appointments/" . $customers . "/");
    }
    exit();
}

if (isset($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    $serial = $_REQUEST['serial'];
    $issue = $_REQUEST['issue'];
    $return = $_REQUEST['return'];
    $ids = $_REQUEST['id'];
    $customerss = $_REQUEST['cust'];
    $smarty->assign('ids', $ids);
    $smarty->assign('cust', $customerss);
    $smarty->assign('names', $name);
    $smarty->assign('serials', $serial);
    $smarty->assign('issues', $issue);
    $smarty->assign('returns', $return);
}

$mode = "";

if (isset($_REQUEST['addnew'])) {
    $mode = "add";
    $customers_uname = $_REQUEST['customers'];
    $smarty->assign('customers_uname', $customers_uname);
    $customer_arr = $customer->getCustomerData($customers_uname);
    $smarty->assign('customer_arr', $customer_arr);
}

if (isset($_REQUEST['id'])) {
    $mode = "edit";
    $id = $_REQUEST['id'];
    $customers_uname = $_REQUEST['customers'];
    $appoiments_arr = $customer->get_appoiments($customer_username, $id);
    $smarty->assign('customers_uname', $appoiments_arr[0]['customer']);
    $smarty->assign('appoiments_arr', $appoiments_arr[0]);
}

$smarty->assign('mode', $mode);
$smarty->display('extends:layouts/ajax_popup.tpl|customer_appoiment_add.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|customer_appoiments.tpl');

function trim_phone($phone){
    $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($phone));
    while (substr($phone,0,3) == '+46' && strlen($phone )>1) { $phone = substr($phone,3,9999); }
//    while (substr($phone,0,1) == '0' && strlen($phone )>1) { $phone = substr($phone,1,9999); }
    return $phone;
}
?>