<?php
require_once('api_common_functions.php');
require_once('class/setup.php');
require_once('class/company.php');
$session_check = check_user_session();
$company = new company();
$data = $company->get_support_info($_SESSION['company_id']);

$main_obj = new stdClass();

$main_obj->session_status = $session_check;

$main_obj->phone = $data['phone'];
$main_obj->role = $_SESSION['user_role'];
$main_obj->support_hours = $data['suport_hours'];
$main_obj->email = $data['email'];
$main_obj->result = true;

echo json_encode($main_obj);
?>