<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/user.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('plugins/pagination.class.php');
require_once('plugins/message.class.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml", "customer.xml", "notes.xml", "reports.xml"));

$pagination = new pagination();
$notes      = new notes();
$user       = new user();
$customer   = new customer();
$message    = new message();
$dona       = new dona();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

/* this block for finding month values  */
global $month;
$month_num=array();
$month_name=array();
foreach ($month as $m_id){
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);// take leave type from config.inc.php
/* end-- block for finding month values  */

$params = explode('&', $_SERVER['QUERY_STRING']);
// echo "<pre>".print_r($params, 1)."</pre>";
$this_month       = $params[0];
$this_year        = $params[1];
$this_customer    = $params[2];
$this_search_text = urldecode(trim($params[3]));
$emp_user_id      = $params[4];
$search_date      = $params[5];

$emp_user_id = (($emp_user_id != "" && $emp_user_id != "NULL") ? $emp_user_id : NULL);
$search_date = (($search_date != "" && $search_date != "NULL") ? $search_date : NULL);
if($emp_user_id != NULL){
    $obj_emp  = new employee();
    $smarty->assign('emp_name', $obj_emp->get_employee_name('\''.$emp_user_id.'\''));
}
// var_dump($emp_user_id,$obj_emp->get_employee_name($emp_user_id));
$smarty->assign('emp_user_id', $emp_user_id);
$smarty->assign('search_date', $search_date);


$action = isset($params[6])?$params[6]:NULL;
// echo "<pre>".print_r($params, 1)."</pre>";
//echo "<pre>".print_r($_SERVER, 1)."</pre>";
//echo $_SERVER['QUERY_STRING'];
// var_dump($action);

$pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
$current_url =  $pro."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$smarty->assign("current_url", $current_url);

//$current_process_url = $smarty->url . ''

/* this for advanced search with customers */
$sel_cust = (($this_customer != "" && $this_customer != "NULL") ? $this_customer : NULL);
$smarty->assign('sel_cust', $sel_cust);
if($sel_cust != NULL)
    $smarty->assign('sel_cust_label', $customer->getCustomerName($sel_cust));

// var_dump($customer->getCustomerName($sel_cust));
// // exit();

/* this for advanced search with search word */
$sel_search_text = (($this_search_text != "" && $this_search_text != "NULL") ? $this_search_text : NULL);
$smarty->assign('sel_search_text', $sel_search_text);
/* this block for finding year values  */
$years_combo= $notes->distinct_note_years();
$smarty->assign("year_option_values", $years_combo);
/* end-- block for finding year values  */

/* this block for set current value of combo box  */
$sel_year=($this_year != "" && $this_year != "NULL" ? $this_year : NULL );
$sel_month=($this_month != "" && $this_month != "NULL" ? $this_month : NULL);
/* end-- block for set current value of combo box  */


$per_page = 10;
$org_post=TRUE;    //used for check original post
$label=true;    //used instead of goto
$unread_notes = array();


if($action == 'read'){
    $unread_notes = $notes->get_unread_note();
    $notes_list=$notes->get_all_notes(NULL, NULL, NULL, NULL, $sel_cust, $sel_search_text,'',FALSE,$emp_user_id, $search_date);
    $updated_list=$notes->get_all_unread_notes($notes_list,$unread_notes,$note_ids);
    if(!empty($note_ids)){
        $notes->set_as_read_notes($note_ids);
    }
    $unread_notes = array();
}else{
    $unread_notes = $notes->get_unread_note(100);
}

// $smarty->assign('login_user_role', $_SESSION['user_role']);



while($label){
    $obj_emp       = new employee();
    $employee_list = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
    $smarty->assign('employee_list',$employee_list);
    // var_dump($employee_list);exit();
    $label=false;
    // exit('fddg');
    //echo "<pre>".print_r(array($sel_year,$sel_month, $sel_cust), 1)."</pre>";
    if($sel_year != NULL && $sel_month != NULL){

        $notes_list = $notes->get_all_notes($sel_year,$sel_month, NULL, NULL, $sel_cust, $sel_search_text,'',FALSE,$emp_user_id, $search_date);
        $notes_list = attach_unread_flag($notes_list, $unread_notes);
        //echo 'count-A: '.count($notes_list);
        $url_customer = ($sel_cust != NULL) ? $sel_cust : 'NULL';
        $url_year = ($sel_year != '') ? $sel_year : 'NULL';
        $url_month = ($sel_month != '') ? $sel_month : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $notes_list = $pagination->generate($notes_list, $per_page);
        $smarty->assign('pagination', $pagination->links($smarty->url . 'notes/list/'.$url_month.'/'.$url_year.'/'.$url_customer.'/'.$url_search_text.'/'));
        
        $temp_notes_list=$notes->get_all_notes($sel_year,$sel_month);
        $search_cust_array = unique_note_customer_array($temp_notes_list);        // this for advanced search with customers
        $smarty->assign('search_cust_array', $search_cust_array);
        $smarty->assign('notes_list', $notes_list);

        // var_dump($notes_list);exit('dfds');
        
        $smarty->assign('report_month', $sel_month);
        $smarty->assign('report_year', $sel_year);
        
    }
    elseif($sel_year == NULL && $sel_month == NULL && ($sel_search_text != NULL && $sel_search_text != '')) {
        $smarty->assign('report_month', '');
        $smarty->assign('report_year', '');
        $notes_list = $notes->get_all_notes(NULL, NULL, NULL, NULL, $sel_cust, $sel_search_text,'',FALSE,$emp_user_id, $search_date);

        $url_customer    = ($sel_cust != NULL) ? $sel_cust : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $notes_list    = $pagination->generate($notes_list, $per_page);
        $smarty->assign('pagination', $pagination->links($smarty->url . 'notes/list/NULL/NULL/'.$url_customer.'/'.$url_search_text.'/'));

        $temp_notes_list   = $notes->get_all_notes();
        $search_cust_array = unique_note_customer_array($temp_notes_list);        // this for advanced search with customers
        $smarty->assign('search_cust_array', $search_cust_array);
        $smarty->assign('notes_list', $notes_list);
        // var_dump($notes_list,'expression');
        // exit('fg');
    }
    elseif($sel_year == NULL && $sel_month == NULL) {
        $smarty->assign('report_month', '');
        $smarty->assign('report_year', '');
        $notes_list=$notes->get_all_notes(NULL, NULL, NULL, NULL, $sel_cust, $sel_search_text,'',FALSE,$emp_user_id, $search_date);

        $updated_list=$notes->get_all_unread_notes($notes_list,$unread_notes,$note_ids);
        
        //echo "<pre>".print_r($updated_list, 1)."</pre>";exit();
        //echo 'count-B: '.count($updated_list);
        $url_customer = ($sel_cust != NULL) ? $sel_cust : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $updated_list = $pagination->generate($updated_list, $per_page);
        $smarty->assign('pagination', $pagination->links($smarty->url . 'notes/list/NULL/NULL/'.$url_customer.'/'.$url_search_text.'/'));
        
        $temp_notes_list=$notes->get_all_notes();
        $search_cust_array = unique_note_customer_array($temp_notes_list);        // this for advanced search with customers
        $smarty->assign('search_cust_array', $search_cust_array);
        
        $smarty->assign('notes_list', $updated_list);
        // var_dump(sizeof($$unread_notes));
        // var_dump($notes_list,$updated_list,$unread_notes); exit();
        //$notes->set_as_read_notes($updated_list);
        if (empty($updated_list)){
            $sel_year = date('Y');
            $sel_month = sprintf("%1d", date('m'));
            $smarty->assign('report_month', $sel_month);
            $smarty->assign('report_year', $sel_year);
            $org_post=FALSE;
            $label=true;
        }
    }else if( $sel_year != NULL && $sel_month == NULL){
        $smarty->assign('report_month', '');
        $smarty->assign('report_year', $sel_year);

        $updated_list=$notes->get_all_notes($sel_year, NULL, NULL, NULL, $sel_cust, $sel_search_text,'',FALSE,$emp_user_id, $search_date);
        $updated_list = attach_unread_flag($updated_list, $unread_notes);
        $temp_notes_list=$notes->get_all_notes($sel_year,NULL);
        
        //echo 'count-C: '.count($updated_list);
        $url_customer = ($sel_cust != NULL) ? $sel_cust : 'NULL';
        $url_year = ($sel_year != '') ? $sel_year : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $updated_list = $pagination->generate($updated_list, $per_page);
        // var_dump($updated_list);
        // exit('fgdf');
        $smarty->assign('pagination', $pagination->links($smarty->url . 'notes/list/NULL/'.$url_year.'/'.$url_customer.'/'.$url_search_text.'/'));
        
        $search_cust_array = unique_note_customer_array($temp_notes_list);        // this for advanced search with customers
        $smarty->assign('search_cust_array', $search_cust_array);
        
        $smarty->assign('notes_list', $updated_list);
    }
        // else if($sel_search_text != NULL || $sel_search_text != ''){
        //     var_dump($sel_search_text);exit('fdg');
        // }
}



$customer_list = $customer->customer_list();
$smarty->assign('combo_customers', $customer_list);
// echo '<pre>'.print_r($customer_list, 1).'</pre>'; exit();

$attachment_add_permission = 0; 
if($_SESSION['user_role'] == 3){
        $obj_employee = new employee();
        $privileges_mc = $obj_employee->get_privileges($_SESSION['user_id'], 3);
        $attachment_add_permission = $privileges_mc['notes_attchment'];
}
 
if($_POST['action_print'] == "print"){ // pdf printing.
    $note_id = $_POST['note_id'];
    $notes_detail = $notes->get_note_detail($note_id)[0];
    if($notes_detail['cust_name'] != ''){
            $notes_detail['customer_name'] = $customer->getCustomerName($notes_detail['cust_name']);
    }
    $dona->note_pdf_genaration($notes_detail);
    // echo "</pre>".print_r($notes_detail,1)."</pre>";
    // exit();
}

$smarty->assign('attachment_add_permission',$attachment_add_permission);
$smarty->assign('current_usr',$_SESSION['user_id']);
$smarty->assign('this_page_no', $pagination->page - 1);
$smarty->assign('per_page', $per_page);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|notes_list.tpl');

function unique_note_customer_array($notes_list){
    //$customer_obj = new customer();
    //echo "<pre>".print_r($notes_list, 1)."</pre>";
    $cust_array = array();
    $cust_det_array = array();
    if(!empty($notes_list)){
        $i = 0;
        foreach ($notes_list as $note_data){
            if(!in_array($note_data['customer'], $cust_array) && $note_data['customer'] != ''){
                $cust_array[] = $note_data['customer'];
                $cust_det_array[$i]['cID'] = $note_data['customer'];
                //$cust_det_array[$i]['cName'] = $customer_obj->getCustomerName($note_data['customer']);
                if($_SESSION['company_sort_by'] == 1)
                    $cust_det_array[$i]['cName'] = $note_data['cust_name'];
                elseif($_SESSION['company_sort_by'] == 2)
                    $cust_det_array[$i]['cName'] = $note_data['cust_name_lf'];
                $i++;
            }
        }
    }
    return $cust_det_array;
}

function attach_unread_flag($notes_list, $unread_list){
    
    $notes_count = count($notes_list);
    for ($i=0 ; $i < $notes_count; $i++){
        if(in_array($notes_list[$i]['id'], $unread_list))
                $notes_list[$i]['is_unread'] = 1;
        else
                $notes_list[$i]['is_unread'] = 0;
    }
    return $notes_list;
}


?>