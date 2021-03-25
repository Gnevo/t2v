<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();
$obj_user = new user();

$data = $employee->get_employee_detail($_REQUEST['user']);
if($data){
    if ($data['mobile'] != "") {
        $length_mobile_display = (strlen($data['mobile']) - 5) / 2;
        $temp_mobile = '';
        $pos = 5;
        for ($i = 0; $i < $length_mobile_display; $i++) {
            $temp_mobile = $temp_mobile . " " . substr($data['mobile'], $pos, 2);
            $pos = $pos + 2;
        }
        $data['mobile'] = "+46" . substr($data['mobile'], 0, 3) . " " . substr($data['mobile'], 3, 2) . " " . $temp_mobile;
    }
    if ($data['phone'] != "") {
        $data['phone'] = "0" . substr($data['phone'], 0, 2) . "-" . substr($data['phone'], 2);
    }
    if($data['social_security'] != ""){
        $obj_general = new general();
        $data['social_security'] = $data['century'].$obj_general->format_ssn($data['social_security']);
    }

    //removing unwanted data from full dataset
    $unwanted_datas = array('color', 'monthly_salary', 'date_inactive', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length', 
        'ice', 'start_day', 'remaining_sem_leave', 'sem_leave_todate', 'leave_in_advance', 'care_of', 'office_personal', 'max_hours', 'email_verified', 'mobile_verified', 'century');
    $data = array_diff_key($data, array_flip($unwanted_datas));

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
$obj->employee = $data;
$__connected_users = $employee->customers_list_for_right_click($_REQUEST['user']);
if(!empty($__connected_users)){
    $unwanted_datas = array('code', 'map_location', 'fkkn');
    foreach ($__connected_users as $key => $cuser) {
        $picture_path = '';
        if ($cuser['picture'] != '') {
            $upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/profile/';
            if(file_exists(getcwd()  . '/' . $upload_path . $cuser['picture']))
                $picture_path = $smarty->url.$upload_path . $cuser['picture'];
        }
        $__connected_users[$key]['picture'] = $picture_path;

        //removing unwanted data from full dataset
        $__connected_users[$key] = array_diff_key($__connected_users[$key], array_flip($unwanted_datas));
    }
}
$obj->customers = $__connected_users;

echo json_encode($obj);
?>