<?php

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/company.php');
$company = new company();

$data = $company->set_support_info($_SESSION['company_id'],$_REQUEST);

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->result = true;

echo json_encode($main_obj);
?>