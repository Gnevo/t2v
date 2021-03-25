<?php

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/root_operation.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
$user = new user();
$company_obj = new company();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 4));

if($_SESSION['user_id'] == 'root001'){

    /* PROCESS AJAX Actions */
    $sel_action = isset($_POST['action']) && $_POST['action'] != "" ? $_POST['action'] : NULL;
    if($sel_action != ""){
        switch ($sel_action) {
            case 'GET_CUSTOMERS':
                $input_company = isset($_POST['company']) && $_POST['company'] != "" ? $_POST['company'] : NULL;
                $data = array();
                if($input_company != ''){
                    $obj_customer = new customer();
                    $company_details = $company_obj->get_company_detail($input_company);
                    $obj_customer->select_db($company_details['db_name']);
                    $data = $obj_customer->customer_list_for_export();
                }
                echo json_encode($data);
                break;
            case 'GENERATE_FAKE':
                $input_company = isset($_POST['company']) && $_POST['company'] != "" ? $_POST['company'] : NULL;
                $input_customer = isset($_POST['customer']) && $_POST['customer'] != "" ? $_POST['customer'] : NULL;
                $data = array();
                $transaction_flag = FALSE;
                $newUser = NULL;
                if($input_company != '' && $input_customer != ''){
                    $obj_customer = new customer();
                    $obj_root_operation = new root_operation();
                    $company_details = $company_obj->get_company_detail($input_company);
                    $obj_customer->select_db($company_details['db_name']);
                    $obj_root_operation->select_db($company_details['db_name']);

                    $customer_detail = $obj_customer->customer_detail($input_customer);
                    if(!empty($customer_detail)){
                        
                        $data = array(
                            array(
                                'username'      => $customer_detail['username'],
                                'century'       => $customer_detail['century'], 
                                'code'          => $customer_detail['code'],
                                'social_security'=>$customer_detail['social_security'],
                                'first_name'    => $customer_detail['first_name'], 
                                'last_name'     => $customer_detail['last_name'], 
                                'gender'        => $customer_detail['gender'],  
                                'address'       => $customer_detail['address'], 
                                'city'          => $customer_detail['city'], 
                                'post'          => $customer_detail['post'], 
                                'phone'         => $customer_detail['phone'], 
                                'mobile'        => $customer_detail['mobile'], 
                                'email'         => $customer_detail['email'], 
                                'date'          => date('Y-m-d'), 
                                'status'        => 0, 
                                'is_genuine'    => 0
                            )
                        );

                        // echo "<pre>".print_r($data, 1)."<pre>";

                        //encode values
                        foreach($data as $key => $val){
                            foreach($val as $key_index => $data_val){
                                // $data[$key][$key_index] = encode_value($data_val);
                                
                                if($key_index == 'social_security'){
                                    if(trim($data[$key][$key_index]) != '')
                                        $data[$key][$key_index] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($data[$key][$key_index]));
                                    
                                    $temp_gender = 1;
                                    if($data[$key][$key_index] != ''){
                                        $digit_9 = (int) substr($data[$key][$key_index], 8, 1);
                                        $temp_gender = ($digit_9 % 2 == 0 ? 2 : 1);
                                    }
                                    $data[$key]['gender'] = $temp_gender;
                                }
                                
                                if($key_index == 'mobile'){
                                    $temp_mobile = NULL;
                                    if(trim($data[$key][$key_index]) != ''){
                                        $temp_mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($data[$key][$key_index]));
                                        if (substr($temp_mobile, 0, 1) === '0'){
                                            $temp_mobile = substr($temp_mobile, 1, 9999);;
                                        }
                                    }
                                    $data[$key]['mobile_modified'] = $temp_mobile;
                                }
                            }
                        }


                        $generated_unames = array();
                        $generated_unames_without_digit = array();

                        //generate username
                        foreach($data as $key => $val){
                            //    $data[$key]['Username'] = generate_username($val['FirstName'], $val['LastName'], $obj_customer);
                            $temp_uname = generate_username($val['first_name'], $val['last_name'], $obj_customer);
                            
                            $uname_name_part = substr($temp_uname, 0, 4);
                            $uname_digit_part = substr($temp_uname, (strlen($temp_uname) - 3), 3);
                            
                            //    if(in_array($temp_uname, $generated_unames)){
                            if(isset($generated_unames_without_digit[$uname_name_part])){
                                $max_count = $generated_unames_without_digit[$uname_name_part] + 1;
                                $count = sprintf('%03d', $max_count);
                                $uname_digit_part = $count;
                                $temp_uname = $uname_name_part . $count;
                            }
                            $generated_unames_without_digit[$uname_name_part] = $uname_digit_part;
                            $generated_unames[] = $temp_uname;
                            $data[$key]['username'] = $temp_uname;
                        }

                        $transaction_flag = $obj_root_operation->create_new_fake_employees($data, $input_company, $company_details['db_name']);

                        // echo "<pre>".print_r($data, 1)."</pre>";
                        $newUser = $generated_unames[0];
                    }
                }
                echo json_encode(array(
                    'result' => $transaction_flag,
                    'newUser' => $newUser
                ));
                break;
            default:
                echo json_encode(array(
                    'result' => FALSE,
                    'message'=> 'Invalid Action'
                ));
                break;
        }
        exit();
    }
    /* PROCESS AJAX Actions Endz*/

    $smarty->assign('privilege', TRUE);
    $companies = $company_obj->company_list();
    $smarty->assign('companies',$companies);

    $sel_company = isset($_POST['companies']) && $_POST['companies'] != "" ? $_POST['companies'] : "";
    $smarty->assign('selected_company', $sel_company);

    if($sel_company != ""){
        $company_details = $company_obj->get_company_detail($sel_company);
        $user->select_db($company_details['db_name']);
        $user_data = $user->get_fake_users();
       // echo "<pre>".print_r($user_data, 1)."</pre>";
    }
    $smarty->assign('users',$user_data);
    
}else
    $smarty->assign('privilege', FALSE);
    
$smarty->display('extends:layouts/root_dashboard.tpl|fake_users_list_for_root.tpl');


function encode_value($val){
    return utf8_encode($val);
}

function generate_username($first_name, $last_name, $obj_cus) {
    $first_name = strip_tags($first_name);
    $last_name = strip_tags($last_name);
    $first_remove = array();
    $last_remove = array();
    for ($i = 0; $i < strlen($first_name); $i++) {
        if ((ord(substr($first_name, $i, 1)) >= 97 && ord(substr($first_name, $i, 1)) <= 122) || (ord(substr($first_name, $i, 1)) >= 65 && ord(substr($first_name, $i, 1)) <= 90)) {
            continue;
        } else {
            $first_remove[] = substr($first_name, $i, 1);
        }
    }
    for ($i = 0; $i < count($first_remove); $i++) {
        $first_name = str_replace($first_remove[$i], "", $first_name);
    }
    for ($i = 0; $i < strlen($last_name); $i++) {
        if ((ord(substr($last_name, $i, 1)) >= 97 && ord(substr($last_name, $i, 1)) <= 122) || (ord(substr($last_name, $i, 1)) >= 65 && ord(substr($last_name, $i, 1)) <= 90)) {
            continue;
        } else {
            $last_remove[] = substr($last_name, $i, 1);
        }
    }
    for ($i = 0; $i < count($last_remove); $i++) {
        $last_name = str_replace($last_remove[$i], "", $last_name);
    }
    if ((ord(substr($first_name, 0, 1)) >= 97 && ord(substr($first_name, 0, 1)) <= 122) || (ord(substr($first_name, 0, 1)) >= 65 && ord(substr($first_name, 0, 1)) <= 90)) {
        $first_name_1 = substr($first_name, 0, 1);
    } else {
        $first_name_1 = "a";
    }
    if ((ord(substr($first_name, 1, 1)) >= 97 && ord(substr($first_name, 1, 1)) <= 122) || (ord(substr($first_name, 1, 1)) >= 65 && ord(substr($first_name, 1, 1)) <= 90)) {
        $first_name_2 = substr($first_name, 1, 1);
    } else {
        $first_name_2 = "a";
    }
    $obj_cus->first_name = $first_name_1 . $first_name_2;
    if ((ord(substr($last_name, 0, 1)) >= 97 && ord(substr($last_name, 0, 1)) <= 122) || (ord(substr($last_name, 0, 1)) >= 65 && ord(substr($last_name, 0, 1)) <= 90)) {
        $last_name_1 = substr($last_name, 0, 1);
    } else {
        $last_name_1 = "a";
    }
    if ((ord(substr($last_name, 1, 1)) >= 97 && ord(substr($last_name, 1, 1)) <= 122) || (ord(substr($last_name, 1, 1)) >= 65 && ord(substr($last_name, 1, 1)) <= 90)) {
        $last_name_2 = substr($last_name, 1, 1);
    } else {
        $last_name_2 = "0";
    }
    $obj_cus->last_name = $last_name_1 . $last_name_2;
    return $obj_cus->get_username(strtolower(substr($obj_cus->first_name, 0, 2)) . strtolower(substr($obj_cus->last_name, 0, 2)));
}
?>