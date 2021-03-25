<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/inconvenient_timing.php');
require_once('class/customer.php');
require_once('class/company.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("gdschema.xml", "inconvenient_timing.xml", "messages.xml", "button.xml", "month.xml", "user.xml", "customer.xml", "common.xml", "privilege.xml"));
$inc_timing = new inconvenient_timing();
$customer = new customer();
$messages = new message();
$obj_company = new company();
$datecalc = new datecalc();
$employee = new employee();
$user = new user();
$obj_general = new general();
global $customer_location_settings;

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => 'LOCATION'));
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));

define('STATIC_MAP_LOCATION_LAT', $customer_location_settings['default_lat']);
define('STATIC_MAP_LOCATION_LON', $customer_location_settings['default_lon']);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_location'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$query_string = explode("&", $_SERVER['QUERY_STRING']);
$customer_username = $query_string[0];

if (!empty($_POST)) {

    $pararms = explode('&', $_SERVER['QUERY_STRING']);
    // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    $smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
    $customer_username = trim($pararms[0]);

    $flag = ($_POST['action'] == 'newentry') ? 1 : 0;
    $smarty->assign('flag', $flag);
    $action = '';

    if ($_POST['action'] == "edit")
        $action = 'edit';
    else
        $action = 'new';

    $customer_detail = $customer->customer_detail($customer_username);
    if(!empty($customer_detail)){
        $saved_data_serialized = trim($customer_detail['map_location']);
        $saved_data_deserialized = array();
        if($saved_data_serialized != NULL) {
            $saved_data_deserialized = unserialize($saved_data_serialized);
            $saved_data_deserialized = order_map_locations($saved_data_deserialized);
        }


        if($action == 'edit'){
            $save_index = (int) trim($_POST['saved_location_index']);
            if($save_index == -1  || !isset($saved_data_deserialized[$save_index])){
                $action = 'new';
            }
        }

        if (!empty($pararms) && trim($customer_username) != "" && ($action == "edit" || $action == "new")) {

            $title = trim($_POST['location_title']);
            $lat = trim($_POST['location_lat']);
            $lon = trim($_POST['location_lon']);


            if ($title != '' && $lat != '' && $lon != '') {
                $error_flag = FALSE;
                // $final_id = '';
                $current_is_default = isset($_POST['is_default_location']) && $_POST['is_default_location'] == 1 ? TRUE : FALSE;

                // echo "<pre>".print_r($saved_data_deserialized, 1)."<pre>";
                //reset old default location if set new
                if($current_is_default && !empty($saved_data_deserialized)){
                    foreach($saved_data_deserialized as $key => $val){
                        $saved_data_deserialized[$key]['is_default'] = FALSE;
                    }
                }

                if($action == 'edit'){
                    $saved_data_deserialized[$save_index]['title']= $title;
                    $saved_data_deserialized[$save_index]['lat']  = $lat;
                    $saved_data_deserialized[$save_index]['lon']  = $lon;
                    $saved_data_deserialized[$save_index]['is_default']  = $current_is_default;
                }
                else {
                    $saved_data_deserialized[] = array(
                        'title' => $title,
                        'lat'   => $lat,
                        'lon'   => $lon,
                        'is_default' => $current_is_default
                    );
                }
                // echo "<pre>".print_r($saved_data_deserialized, 1)."<pre>"; exit();

                $flag = $customer->update_customer_map_location($customer_username, $saved_data_deserialized);

                if ($flag) {
                    $messages->set_message('success', 'customer_location_saved');
                } else {
                    $messages->set_message('fail', 'customer_location_saving_failed');
                    // echo "<pre>".print_r($flag->query_error_details, 1)."<pre>"; exit();
                }

                header('Location: ' . $smarty->url . 'customer/locations/' . $customer_username . '/');
                exit();
            } else if (!empty($_POST)) {
                $messages->set_message('fail', 'fill_required_fields');
                header('Location: ' . $smarty->url . 'customer/locations/' . $customer_username . '/');
                exit();
            }
        }

    }
}

// echo "<pre>".print_r($query_string, 1)."<pre>"; exit();
/* ---------------------------------- Delete action--------------------------------------------- */
if(count($query_string) == 3 && trim($query_string[1]) != '' && $query_string[2] == 'delete'){

    $delete_index = (int) trim($query_string[1]);
    $customer_detail = $customer->customer_detail($customer_username);
    if ($delete_index >= 0 && !empty($customer_detail)) {
        
        $saved_data_serialized = trim($customer_detail['map_location']);
        $saved_data_deserialized = array();
        if($saved_data_serialized != NULL) {
            $saved_data_deserialized = unserialize($saved_data_serialized);
            $saved_data_deserialized = order_map_locations($saved_data_deserialized);
        }

        if(isset($saved_data_deserialized[$delete_index])){
            unset($saved_data_deserialized[$delete_index]);
            $saved_data_deserialized = array_values($saved_data_deserialized);
            $flag = $customer->update_customer_map_location($customer_username, $saved_data_deserialized);

            if ($flag) {
                $messages->set_message('success', 'customer_location_saved');
            } else {
                $messages->set_message('fail', 'customer_location_saving_failed');
                // echo "<pre>".print_r($flag->query_error_details, 1)."<pre>"; exit();
            }
        }
        else
            $messages->set_message('fail', 'customer_location_saving_failed');
    }
    else
        $messages->set_message('fail', 'customer_location_saving_failed');

    header("Location: " . $smarty->url . 'customer/locations/' . $customer_username . '/');
    exit();
}




$customer_detail = $customer->customer_detail($customer_username);
// echo "<pre>".print_r($customer_detail, 1)."<pre>"; exit();

$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
$smarty->assign('customer_detail', $customer_detail);
$smarty->assign('customer_username', $customer_username);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$map_locations = (!empty($customer_detail) && $customer_detail['map_location'] != NULL) ? unserialize($customer_detail['map_location']) : array();
$map_locations = order_map_locations($map_locations);
$smarty->assign('map_locations', $map_locations);
$smarty->assign('map_locations_json', json_encode($map_locations));
// echo "<pre>".print_r($map_locations, 1)."<pre>"; 
// exit();

$smarty->assign('STATIC_MAP_LOCATION_LAT', STATIC_MAP_LOCATION_LAT);
$smarty->assign('STATIC_MAP_LOCATION_LON', STATIC_MAP_LOCATION_LON);

// $cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
// $smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|customer_locations.tpl|layouts/sub_layout_customer_tabs.tpl');

function order_map_locations($locations){
    //taken default location first
    $map_location_sorted = array();
    if(!empty($locations)){
        foreach($locations as $mKey => $ml){
            if($ml['is_default'] == 1){
                $map_location_sorted[] = $ml;
                unset($locations[$mKey]);
            }
        }
        if(!empty($locations)){
            $map_location_sorted = array_merge($map_location_sorted, $locations);
        }
        // echo "<pre>".print_r($map_location_sorted, 1)."<pre>"; 
        $locations = $map_location_sorted;
    }
    return $locations;
}
?>