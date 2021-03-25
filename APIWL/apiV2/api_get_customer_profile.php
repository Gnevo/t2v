<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$obj_user = new user();

$data = $customer->customer_detail($_REQUEST['user']);
if($data){
    if($data['mobile'] != ""){
            $length_mobile_display = (strlen($data['mobile'])-5)/2;
            $temp_mobile = '';
            $pos = 5;
            for($i=0;$i<$length_mobile_display;$i++){
                $temp_mobile = $temp_mobile." ".substr($data['mobile'], $pos,2);
                $pos = $pos +2;
            }
            $data['mobile'] = "+46".substr($data['mobile'], 0,3) . " " . substr($data['mobile'], 3,2)." ".$temp_mobile;
    }
    if($data['phone'] != ""){
        $data['phone'] = "0".substr($data['phone'], 0,2) . "-" . substr($data['phone'], 2);
    }
    if($data['social_security'] != ""){
        $obj_general = new general();
        $data['social_security'] = $data['century'].$obj_general->format_ssn($data['social_security']);
    }

    //removing unwanted data from full dataset
    $unwanted_datas = array('date_inactive', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length', 
        'map_location', 'kn_name', 'kn_address', 'kn_postno', 'kn_reference_no', 'kn_box', 'kn_city', 'fkkn', 'email_verified', 'mobile_verified', 'century');
    $data = array_diff_key($data, array_flip($unwanted_datas));

    // if(array_key_exists('kn_name', $data)) unset($data['kn_name']);
    // if(array_key_exists('kn_address', $data)) unset($data['kn_address']);
    // if(array_key_exists('kn_postno', $data)) unset($data['kn_postno']);

    $picture_path = '';
    if ($data['picture'] != '') {
        $upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/profile/';
        if(file_exists(getcwd()  . '/' . $upload_path . $data['picture']))
            $picture_path = $smarty->url.$upload_path . $data['picture'];
    }
    $data['picture'] = $picture_path;
}
$obj = new stdClass();
$obj->session_status = $session_check;
$obj->customer = $data;
$__connected_users = $employee->employees_list_for_right_click($_REQUEST['user']);
if(!empty($__connected_users)){
    foreach ($__connected_users as $key => $cuser) {
        $picture_path = '';
        if ($cuser['picture'] != '') {
            $upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/profile/';
            if(file_exists(getcwd()  . '/' . $upload_path . $cuser['picture']))
                $picture_path = $smarty->url.$upload_path . $cuser['picture'];
        }
        $__connected_users[$key]['picture'] = $picture_path;
    }
}
$obj->employees = $__connected_users;

echo json_encode($obj);
?>