<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
$smarty = new smartySetup(array("user.xml", "support.xml"), FALSE);
$support = new support();
$company_id = $_SESSION['company_id'];

$request_datas = array_unique(explode(',', $_REQUEST['data']));

$data_response = new stdClass();

if(!empty($request_datas)){
    foreach ($request_datas as $rqd) {
        switch (strtolower(trim($rqd))) {
            case 'priority':
                $data_response->priority = convert_array_index_to_attribute($support_priority, 'id', 'title');
                break;
            case 'status':
                $data_response->status = convert_array_index_to_attribute($support_status, 'id', 'title');
                break;
            case 'ticket_type':
                $data_response->ticket_type = convert_array_index_to_attribute($support_ticket_type, 'id', 'title');
                break;
            case 'category_type':
                $data_response->category_type = convert_array_index_to_attribute($support_category_type, 'id', 'title');
                break;
            case 'cirrus_user':
                $data_response->cirrus_user = $cirrus_admins;
                break;
            case 'company':
                $__company = $support->get_companies();

                //removing unwanted data from full dataset
                $data_response->company = array();
                if(!empty($__company)){
                    $unwanted_datas = array('db_name', 'upload_dir', 'email', 'phone', 'mobile', 'website');
                    foreach ($__company as $key => $comp) {
                        $data_response->company[] = array_diff_key($comp, array_flip($unwanted_datas));
                    }
                }
                break;
            case 'category':
                $category_type              = $_REQUEST['category_type'];
                $data_response->category    = $support->get_support_category_options($category_type, $company_id);
                $data_response->category    = convert_array_index_to_attribute($data_response->category, 'id', 'title');
                break;
            case 'admins':
                $data_response->admins = convert_array_index_to_attribute($support->get_support_admin_users_options($company_id), 'user_id', 'title');
                break;
            case 'users':
                $__users = $support->get_all_users($company_id);

                //removing unwanted data from full dataset
                $data_response->users = array();
                if(!empty($__users)){
                    $unwanted_datas = array('role', 'code');
                    foreach ($__users as $key => $usr) {
                        $data_response->users[] = array_diff_key($usr, array_flip($unwanted_datas));
                    }
                }
                break;
            case 'ticket_attachment_dir':
                $data = $support->get_companies($company_id);
                $upload_dir = $preference['url'] . $data[0]['upload_dir'] . "/tickets/attachment/";
                $data_response->ticket_attachment_dir = $upload_dir;
                break;
        }
    }
}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
// $main_obj->data_set = $data;
$main_obj->data_set = $data_response;
echo json_encode($main_obj);

function convert_array_index_to_attribute($cur_array, $index_label, $value_label){

    $return_array = array();
    if(!empty($cur_array)){
        foreach ($cur_array as $key => $value) {
            $return_array[] = array($index_label => $key, $value_label => $value);
        }
    }
    return $return_array;
}